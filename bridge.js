const mqtt = require('mqtt');
const mysql = require('mysql2');
const express = require('express');
const app = express();

// 1. Cấu hình Database (Chỉ để ĐỌC kịch bản, không ghi log vào đây)
const db = mysql.createPool({
    host: process.env.DB_HOST || 'localhost', // Trên Cloud sẽ là địa chỉ của DB
    user: process.env.DB_USER || 'huynq',
    password: process.env.DB_PASS || '123',
    database: process.env.DB_NAME || 'kho_iot',
    port: process.env.DB_PORT || 3306
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

const updateDeviceConnectionStatus = (maThietBi, statusValue) => {
    const time = getTimestamp();
    const statusText = statusValue === 1 ? "ONLINE" : "OFFLINE";
    const color = statusValue === 1 ? "\x1b[32m" : "\x1b[31m";
    const sql = `UPDATE thietbi SET trangThai = ? WHERE maThietBi = ?`;

    db.query(sql, [statusValue, maThietBi], (err, result) => {
        if (err) {
            console.log(`\x1b[31m[${time}] [STATUS_ERROR] ${err.message}\x1b[0m`);
            return;
        }
        if (result.affectedRows > 0) {
            console.log(`${color}[${time}] [STATUS_UPDATE] ${maThietBi} is now ${statusText}\x1b[0m`);
        }
    });
};

const handleSensorData = (deviceId, payload) => {
    const time = getTimestamp();
    const idAdmin = 1;

    const findDeviceSql = `SELECT idThietBi, tenThietBi FROM thietbi WHERE maThietBi = ? LIMIT 1`;

    db.query(findDeviceSql, [deviceId], (err, results) => {
        if (err || results.length === 0) return;

        const idThietBi = results[0].idThietBi;
        const tenThietBi = results[0].tenThietBi;

        const insertSensorSql = `
            INSERT INTO lichsucambien (idThietBi, nhietDo, doAm, nongDoCo2, cuongDoAnhSang)
            VALUES (?, ?, ?, ?, ?)`;
        
        const sensorValues = [
            idThietBi,
            payload.t || 0,
            payload.h || 0,
            payload.co2 || 0,
            payload.as || 0
        ];

        db.query(insertSensorSql, sensorValues, (err) => {
            if (err) console.log(`\x1b[31m[ERROR] Lỗi lưu cảm biến: ${err.message}\x1b[0m`);
            else console.log(`\x1b[34m[${time}] [DB_SAVED] Dữ liệu từ ${deviceId} đã lưu.\x1b[0m`);
        });

        const alerts = [];
        if (payload.t > 16) {
            alerts.push(["QUÁ NHIỆT", `Nhiệt độ tại ${tenThietBi} đạt ${payload.t}°C.`, "CanhBao"]);
        }
        if (payload.h < 80) {
            alerts.push(["ĐỘ ẨM THẤP", `Độ ẩm tại ${tenThietBi} giảm còn ${payload.h}%.`, "CanhBao"]);
        }
        if (payload.co2 > 1000) {
            alerts.push(["CO2 CAO", `Nồng độ CO2 tại ${tenThietBi}: ${payload.co2} ppm.`, "CanhBao"]);
        }
        if (payload.as > 50) {
            alerts.push(["ÁNH SÁNG", `Phát hiện ánh sáng tại ${tenThietBi}: ${payload.as} lux.`, "CanhBao"]);
        }

        if (alerts.length > 0) {
            const insertAlertSql = `
                INSERT INTO thongbao (tieuDe, noiDung, loaiThongBao, idThietBi, idNguoiDung)
                VALUES ?`;
            
            const alertValues = alerts.map(a => [a[0], a[1], a[2], idThietBi, idAdmin]);

            db.query(insertAlertSql, [alertValues], (err) => {
                if (err) console.log(`\x1b[31m[ERROR] Lỗi lưu cảnh báo: ${err.message}\x1b[0m`);
                else console.log(`\x1b[31m[ALARM] >>> Đã ghi ${alerts.length} cảnh báo vào hệ thống!\x1b[0m`);
            });
        }
    });
};

// 4. Lắng nghe tin nhắn từ MQTT
client.on('connect', () => {
    console.log(`\x1b[32m[${getTimestamp()}] >>> Đã kết nối HiveMQ thành công\x1b[0m`);
    client.subscribe('kho_iot/#');
});

client.on('message', (topic, message) => {
    try {
        const payload = JSON.parse(message.toString());
        const topicParts = topic.split('/');
        const deviceId = topicParts[1];

        if (topic.endsWith('/status')) {
            if (payload.s !== undefined) {
                updateDeviceConnectionStatus(deviceId, payload.s);
            }
        } else if (topic === `kho_iot/${deviceId}`) {
            handleSensorData(deviceId, payload);
        } else if (topicParts[2] === 'log') {
            console.log(`\x1b[33m[${getTimestamp()}] [DEVICE_LOG] ${deviceId}: ${payload.action} -> ${payload.detail}\x1b[0m`);
        } else if (topicParts[2] === 'ack') {
            console.log(`\x1b[36m[${getTimestamp()}] [DEVICE_ACK] ${deviceId}: Kịch bản đã được áp dụng.\x1b[0m`);
        }
    } catch (e) {}
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
