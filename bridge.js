const mqtt = require('mqtt');
const mysql = require('mysql2');
const express = require('express');
const app = express();

// 1. Cấu hình Database (Chỉ để ĐỌC kịch bản, không ghi log vào đây)
const db = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'kho_iot',
    waitForConnections: true,
    connectionLimit: 10
});

// 2. Cấu hình MQTT HiveMQ
const client = mqtt.connect('mqtts://66134711837f4104800192a63e1b7f97.s1.eu.hivemq.cloud:8883', {
    username: 'huyng',
    password: 'Huy12345',
    clientId: 'node_bridge_' + Math.random().toString(16).substr(2, 8)
});

const getTimestamp = () => new Date().toLocaleString('vi-VN');

// 3. Hàm xử lý gửi kịch bản xuống ESP32
const pushRulesToDevice = (idKichBan) => {
    const time = getTimestamp();
    
    // Tìm mã thiết bị liên quan đến kịch bản này
    const findDeviceSql = `
        SELECT DISTINCT t.maThietBi 
        FROM thietbi t 
        JOIN thanhphan_thietbi tp ON t.idThietBi = tp.idThietBi 
        JOIN kichban_tudong k ON (k.idThanhPhanVao = tp.idThanhPhan OR k.idThanhPhanRa = tp.idThanhPhan) 
        WHERE k.idKichBan = ?`;

    db.query(findDeviceSql, [idKichBan], (err, devices) => {
        if (err) {
            console.log(`\x1b[31m[${time}] [DB_ERROR] ${err.message}\x1b[0m`);
            return;
        }

        if (devices.length === 0) {
            console.log(`\x1b[33m[${time}] [WARN] Không tìm thấy thiết bị cho kịch bản ID: ${idKichBan}\x1b[0m`);
            return;
        }

        devices.forEach(device => {
            const maThietBi = device.maThietBi;
            
            // Lấy tất cả kịch bản đang kích hoạt của thiết bị này
            const getRulesSql = `
                SELECT k.*, tpV.maThanhPhan AS loaiVao, tpR.maThanhPhan AS loaiRa
                FROM kichban_tudong k
                LEFT JOIN thanhphan_thietbi tpV ON k.idThanhPhanVao = tpV.idThanhPhan
                JOIN thanhphan_thietbi tpR ON k.idThanhPhanRa = tpR.idThanhPhan
                JOIN thietbi t ON tpR.idThietBi = t.idThietBi
                WHERE t.maThietBi = ? AND k.kichHoat = 1`;

            db.query(getRulesSql, [maThietBi], (err, rules) => {
                if (err) return;

                const payload = {
                    cmd: "UPDATE_RULES",
                    data: rules.map(r => ({
                        type: r.loaiKichBan,
                        in: r.loaiVao,
                        op: r.dieuKien,
                        val: r.giaTriNguong,
                        out: r.loaiRa,
                        act: r.hanhDong,
                        start: r.thoiGianBat,
                        end: r.thoiGianTat
                    }))
                };

                // Gửi qua MQTT
                client.publish(`kho_iot/kichban/${maThietBi}`, JSON.stringify(payload), { qos: 1, retain: true });
                console.log(`\x1b[35m[${time}] [SERVER_PUSH] >>> Đã gửi ${rules.length} kịch bản tới: ${maThietBi}\x1b[0m`);
            });
        });
    });
};

// 4. Lắng nghe tin nhắn từ MQTT
client.on('connect', () => {
    console.log(`\x1b[32m[${getTimestamp()}] >>> Đã kết nối HiveMQ thành công\x1b[0m`);
    client.subscribe('kho_iot/#');
});

client.on('message', (topic, message) => {
    const time = getTimestamp();
    try {
        const payload = JSON.parse(message.toString());
        const topicParts = topic.split('/');
        const deviceId = topicParts.pop(); // Ví dụ: "TB01"
        const subTopic = topicParts[1];

        if (subTopic === 'log') {
            console.log(`\x1b[33m[${time}] [DEVICE_LOG] ${deviceId}: ${payload.action} -> ${payload.detail}\x1b[0m`);
        } else if (subTopic === 'ack') {
            console.log(`\x1b[36m[${time}] [DEVICE_ACK] ${deviceId}: Thiết bị đã áp dụng kịch bản mới.\x1b[0m`);
        } else if (topic === `kho_iot/${deviceId}`) {
            // 1. Log ra terminal để theo dõi nhanh
            console.log(`\x1b[34m[${time}] [SENSOR_DATA] ${deviceId}: Temp: ${payload.t}°C, Hum: ${payload.h}%\x1b[0m`);

            // 2. Lưu vào Database
            const insertSql = `
                INSERT INTO lichsucambien (idThietBi, nhietDo, doAm, nongDoCo2, cuongDoAnhSang)
                SELECT idThietBi, ?, ?, ?, ? 
                FROM thietbi 
                WHERE maThietBi = ? 
                LIMIT 1`;

            const values = [
                payload.t || null,              // nhietDo
                payload.h || null,              // doAm
                payload.co2 || null,            // nongDoCo2
                payload.as || null,             // cuongDoAnhSang
                deviceId                        // maThietBi dùng để tìm idThietBi
            ];

            db.query(insertSql, values, (err, result) => {
                if (err) {
                    console.log(`\x1b[31m[${time}] [SAVE_ERROR] Lỗi lưu DB: ${err.message}\x1b[0m`);
                } else if (result.affectedRows > 0) {
                    // Log nhẹ để biết đã lưu thành công
                    console.log(`\x1b[32m[${time}] [DB_SAVED] Đã lưu dữ liệu cho ${deviceId}\x1b[0m`);
                } else {
                    console.log(`\x1b[33m[${time}] [DB_WARN] Không tìm thấy mã thiết bị ${deviceId} trong bảng thietbi\x1b[0m`);
                }
            });
        }
    } catch (e) {
        // Không spam terminal nếu payload không phải JSON
    }
});

// 5. API Router
app.get('/capnhatkichban', (req, res) => {
    const id = req.query.id;
    const time = getTimestamp();
    
    console.log(`\x1b[35m[${time}] [API_CALL] Yêu cầu cập nhật kịch bản ID: ${id}\x1b[0m`);
    
    if (id) {
        pushRulesToDevice(id); // Gọi hàm xử lý MQTT
        res.send('Processing update...');
    } else {
        res.status(400).send('Missing ID');
    }
});

app.listen(3001, () => {
    console.log('\n\x1b[1m=== BRIDGE MONITORING SYSTEM ONLINE (PORT 3001) ===\x1b[0m\n');
});