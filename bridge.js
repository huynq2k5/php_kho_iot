const mqtt = require('mqtt');
const mysql = require('mysql2');
const express = require('express');
const app = express();

const db = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'kho_iot',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

const client = mqtt.connect('mqtts://66134711837f4104800192a63e1b7f97.s1.eu.hivemq.cloud:8883', {
    username: 'huyng',
    password: 'Huy12345',
    clientId: 'node_bridge_' + Math.random().toString(16).substr(2, 8)
});

const pushRulesToDevice = (idKichBan) => {
    const findDeviceSql = `
        SELECT DISTINCT t.maThietBi 
        FROM thietbi t 
        JOIN thanhphan_thietbi tp ON t.idThietBi = tp.idThietBi 
        JOIN kichban_tudong k ON (k.idThanhPhanVao = tp.idThanhPhan OR k.idThanhPhanRa = tp.idThanhPhan) 
        WHERE k.idKichBan = ?`;

    db.query(findDeviceSql, [idKichBan], (err, devices) => {
        if (err || devices.length === 0) return;

        devices.forEach(device => {
            const maThietBi = device.maThietBi;
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

                // SỬA TẠI ĐÂY: Thêm retain: true
                client.publish(`kho_iot/kichban/${maThietBi}`, JSON.stringify(payload), { qos: 1, retain: true });
                console.log(`---> Đã lưu kịch bản (Retained) cho: ${maThietBi}`);
            });
        });
    });
};

app.get('/capnhatkichban', (req, res) => {
    const idKichBan = req.query.id;
    if (idKichBan) {
        pushRulesToDevice(idKichBan);
        res.send('OK');
    } else {
        res.status(400).send('Missing ID');
    }
});

app.listen(3001, () => {
    console.log('--- [HỆ THỐNG] Bridge lắng nghe lệnh tại port 3001 ---');
});

client.on('connect', () => {
    console.log('--- [HỆ THỐNG] Đã kết nối HiveMQ thành công ---');
    client.subscribe('kho_iot/#');
});

client.on('message', (topic, message) => {
    try {
        const payload = JSON.parse(message.toString());
        const topicParts = topic.split('/');
        const maThietBi = topicParts.pop();
        const subTopic = topicParts[1]; // Lấy phần 'ack' hoặc 'kichban' nếu có

        // --- CHỖ THÊM MỚI: Xử lý xác nhận (ACK) từ ESP32 ---
        if (subTopic === 'ack') {
            console.log(`[ACK] Thiết bị ${maThietBi} đã áp dụng kịch bản thành công.`);
            
            // Cập nhật ngày đồng bộ vào database cho các kịch bản đang kích hoạt của thiết bị này
            const updateSyncSql = `
                UPDATE kichban_tudong k
                JOIN thanhphan_thietbi tp ON k.idThanhPhanRa = tp.idThanhPhan
                JOIN thietbi t ON tp.idThietBi = t.idThietBi
                SET k.ngayDongBo = NOW() 
                WHERE t.maThietBi = ? AND k.kichHoat = 1`;

            db.query(updateSyncSql, [maThietBi], (err) => {
                if (err) console.error('Lỗi cập nhật ngày đồng bộ:', err.message);
            });
            return; // Thoát ra, không chạy xuống phần lưu cảm biến bên dưới
        }

        // --- PHẦN CŨ: Lưu dữ liệu cảm biến (giữ nguyên logic của bạn nhưng bọc trong else hoặc check topic) ---
        if (topic === `kho_iot/${maThietBi}`) {
            db.query('SELECT idThietBi FROM thietbi WHERE maThietBi = ?', [maThietBi], (err, results) => {
                if (err || results.length === 0) return;

                const idThietBi = results[0].idThietBi;
                const sql = `INSERT INTO lichsucambien (idThietBi, nhietDo, doAm, nongDoCo2, cuongDoAnhSang, thoiGian) 
                             VALUES (?, ?, ?, ?, ?, NOW())`;
                
                const values = [idThietBi, payload.t ?? 0, payload.h ?? 0, payload.co2 ?? 0, payload.as ?? 0];

                db.query(sql, values, (err) => {
                    if (!err) console.log(`=> Đã lưu dữ liệu từ: ${maThietBi}`);
                });
            });
        }
    } catch (e) {
        console.error('Lỗi JSON:', e.message);
    }
});