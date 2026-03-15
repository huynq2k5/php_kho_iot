const mqtt = require('mqtt');
const mysql = require('mysql2');

// 1. Cấu hình Database Pool
const db = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'kho_iot',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// 2. Cấu hình MQTT HiveMQ Cloud
const client = mqtt.connect('mqtts://66134711837f4104800192a63e1b7f97.s1.eu.hivemq.cloud:8883', {
    username: 'huyng',
    password: 'Huy12345',
    clientId: 'node_bridge_' + Math.random().toString(16).substr(2, 8)
});

client.on('connect', () => {
    console.log('--- [HỆ THỐNG] Đã kết nối HiveMQ thành công ---');
    client.subscribe('kho_iot/#', (err) => {
        if (!err) console.log('--- [HỆ THỐNG] Đang lắng nghe topic: kho_iot/# ---');
    });
});

client.on('message', (topic, message) => {
    try {
        const payload = JSON.parse(message.toString());
        const maThietBi = topic.split('/').pop();

        console.log(`--- [MQTT] Nhận từ ${maThietBi}:`, payload);

        // Truy vấn ID thiết bị từ Mã thiết bị
        db.query('SELECT idThietBi FROM thietbi WHERE maThietBi = ?', [maThietBi], (err, results) => {
            if (err) {
                console.error('Lỗi SQL (SELECT):', err.message);
                return;
            }

            if (results.length > 0) {
                const idThietBi = results[0].idThietBi;

                // ÁNH XẠ DỮ LIỆU TỪ JSON NÉN SANG CỘT DATABASE
                const sql = `INSERT INTO lichsucambien (idThietBi, nhietDo, doAm, nongDoCo2, cuongDoAnhSang, thoiGian) 
                             VALUES (?, ?, ?, ?, ?, NOW())`;
                
                const values = [
                    idThietBi,
                    payload.t ?? 0,   // "t" từ ESP32 -> nhietDo
                    payload.h ?? 0,   // "h" từ ESP32 -> doAm
                    payload.co2 ?? 0, // "co2" từ ESP32 -> nongDoCo2
                    payload.as ?? 0   // "as" từ ESP32 -> cuongDoAnhSang
                ];

                db.query(sql, values, (err, result) => {
                    if (err) {
                        console.error('Lỗi SQL (INSERT):', err.message);
                    } else {
                        console.log(`=> Đã lưu: T:${payload.t}°C | H:${payload.h}% | CO2:${payload.co2} | AS:${payload.as}`);
                    }
                });
            } else {
                console.warn('Cảnh báo: Không tìm thấy Mã thiết bị này trong DB:', maThietBi);
            }
        });
    } catch (e) {
        console.error('Lỗi định dạng JSON:', e.message);
    }
});