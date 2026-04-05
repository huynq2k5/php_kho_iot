require('dotenv').config();
const dns = require('dns');
dns.setDefaultResultOrder('ipv4first');
const mqtt = require('mqtt');
const mysql = require('mysql2');
const express = require('express');
const app = express();
const nodemailer = require('nodemailer');

const ketNoiDb = mysql.createPool({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'huynq',
    password: process.env.DB_PASS || '123',
    database: process.env.DB_NAME || 'kho_iot',
    port: process.env.DB_PORT || 3306
});

const cauHinhEmail = nodemailer.createTransport({
    service: 'gmail', 
    host: 'smtp.gmail.com',
    port: 587, 
    secure: false, 
    auth: {
        user: process.env.EMAIL_USER,
        pass: process.env.EMAIL_PASS
    },
    family: 4, 
    tls: {
        rejectUnauthorized: false 
    }
});

const trangThaiCu = {};
const trangThaiCanhBao = {};

const mqttClient = mqtt.connect('mqtts://66134711837f4104800192a63e1b7f97.s1.eu.hivemq.cloud:8883', {
    username: 'huyng',
    password: 'Huy12345',
    clientId: 'node_bridge_' + Math.random().toString(16).substr(2, 8)
});

const layThoiGian = () => {
    return new Intl.DateTimeFormat('en-CA', {
        timeZone: 'Asia/Ho_Chi_Minh',
        year: 'numeric', month: '2-digit', day: '2-digit',
        hour: '2-digit', minute: '2-digit', second: '2-digit',
        hour12: false
    }).format(new Date()).replace(/,/g, '').replace(/(\d{4})-(\d{2})-(\d{2})/, '$1-$2-$3');
};

const luuLichSu = (idThietBi, duLieu) => {
    const bayGio = layThoiGian();
    const sql = `INSERT INTO lichsucambien (idThietBi, nhietDo, doAm, nongDoCo2, cuongDoAnhSang, thoiGian) VALUES (?, ?, ?, ?, ?, ?)`;
    const giaTri = [idThietBi, duLieu.t || 0, duLieu.h || 0, duLieu.co2 || 0, duLieu.as || 0, bayGio];

    ketNoiDb.query(sql, giaTri, (err) => {
        if (err) console.log(`\x1b[31m[${bayGio}] [LOI_LƯU_DB] ${err.message}\x1b[0m`);
        else console.log(`\x1b[34m[${bayGio}] [DB_OK] Da luu du lieu thiet bi ID: ${idThietBi} luc ${bayGio}\x1b[0m`);
    });
};

const xuLyCanhBao = (idThietBi, tenThietBi, duLieu) => {
    const idAdmin = 1;
    if (!trangThaiCanhBao[idThietBi]) trangThaiCanhBao[idThietBi] = {};

    const cacLoi = [
        { key: 'QUÁ NHIỆT', check: duLieu.t > 16, msg: `Nhiệt độ tại ${tenThietBi} đạt ${duLieu.t}°C.` },
        { key: 'ĐỘ ẨM THẤP', check: duLieu.h < 80, msg: `Độ ẩm tại ${tenThietBi} giảm còn ${duLieu.h}%.` },
        { key: 'CO2 CAO', check: duLieu.co2 > 1000, msg: `Nồng độ CO2 tại ${tenThietBi}: ${duLieu.co2} ppm.` },
        { key: 'ÁNH SÁNG', check: duLieu.as > 50, msg: `Phát hiện ánh sáng tại ${tenThietBi}: ${duLieu.as} lux.` }
    ];

    cacLoi.forEach(loi => {
        if (loi.check && !trangThaiCanhBao[idThietBi][loi.key]) {
            const sql = `INSERT INTO thongbao (tieuDe, noiDung, loaiThongBao, idThietBi, idNguoiDung) VALUES (?, ?, ?, ?, ?)`;
            const values = [loi.key, loi.msg, "CanhBao", idThietBi, idAdmin];

            ketNoiDb.query(sql, values, (err) => {
                if (!err) {
                    console.log(`\x1b[31m[ALARM] Da ghi canh bao: ${loi.key} cho ${tenThietBi}\x1b[0m`);
                    trangThaiCanhBao[idThietBi][loi.key] = true; 
                }
            });
        } 
        else if (!loi.check && trangThaiCanhBao[idThietBi][loi.key]) {
            trangThaiCanhBao[idThietBi][loi.key] = false; 
            console.log(`\x1b[32m[INFO] ${tenThietBi} - ${loi.key} da tro lai binh thuong\x1b[0m`);
        }
    });
};

const xuLyCamBien = (maThietBi, duLieu) => {
    const sqlTimThietBi = `SELECT idThietBi, tenThietBi FROM thietbi WHERE maThietBi = ? LIMIT 1`;

    ketNoiDb.query(sqlTimThietBi, [maThietBi], (err, ketQua) => {
        if (err || ketQua.length === 0) return;
        const { idThietBi, tenThietBi } = ketQua[0];
        
        luuLichSu(idThietBi, duLieu);
        xuLyCanhBao(idThietBi, tenThietBi, duLieu);
    });
};

const guiMailThongBao = (maThietBi, trangThai) => {
    const chuDe = trangThai === 1 ? `[ONLINE] Thiết bị ${maThietBi} đã kết nối` : `[OFFLINE] Thiết bị ${maThietBi} mất kết nối`;
    const noiDung = `
        <h3>Thông báo trạng thái thiết bị</h3>
        <p><b>Mã thiết bị:</b> ${maThietBi}</p>
        <p><b>Trạng thái:</b> ${trangThai === 1 ? '<span style="color: green;">Hoạt động</span>' : '<span style="color: red;">Mất kết nối</span>'}</p>
        <p><b>Thời gian:</b> ${layThoiGian()}</p>
        <hr>
        <p>Hệ thống giám sát kho thông minh.</p>
    `;

    const options = {
        from: 'Hệ thống giám sát kho thông minh',
        to: '23004224@st.vlute.edu.vn',
        subject: chuDe,
        html: noiDung
    };

    cauHinhEmail.sendMail(options, (err, info) => {
        if (err) console.log(`\x1b[31m[MAIL_ERR] ${err.message}\x1b[0m`);
        else console.log(`\x1b[32m[MAIL_OK] Da gui thong bao cho ${maThietBi}\x1b[0m`);
    });
};

const capNhatTrangThai = (maThietBi, trangThai) => {
    if (trangThaiCu[maThietBi] !== trangThai) {
        guiMailThongBao(maThietBi, trangThai);
        trangThaiCu[maThietBi] = trangThai;

        const sql = `UPDATE thietbi SET trangThai = ? WHERE maThietBi = ?`;
        const mau = trangThai === 1 ? "\x1b[32m" : "\x1b[31m";
        const chu = trangThai === 1 ? "ONLINE" : "OFFLINE";

        ketNoiDb.query(sql, [trangThai, maThietBi], (err, kq) => {
            if (!err && kq.affectedRows > 0) {
                console.log(`${mau}[${layThoiGian()}] [STATUS] ${maThietBi} hien tai ${chu}\x1b[0m`);
            }
        });
    }
};

const dayKichBan = (idKichBan) => {
    const sqlTimThietBi = `
        SELECT DISTINCT t.maThietBi FROM thietbi t 
        JOIN thanhphan_thietbi tp ON t.idThietBi = tp.idThietBi 
        JOIN kichban_tudong k ON (k.idThanhPhanVao = tp.idThanhPhan OR k.idThanhPhanRa = tp.idThanhPhan) 
        WHERE k.idKichBan = ?`;

    ketNoiDb.query(sqlTimThietBi, [idKichBan], (err, dsThietBi) => {
        if (err || dsThietBi.length === 0) return;

        dsThietBi.forEach(tb => {
            const sqlLayKichBan = `
                SELECT k.*, tpV.maThanhPhan AS loaiVao, tpR.maThanhPhan AS loaiRa
                FROM kichban_tudong k
                LEFT JOIN thanhphan_thietbi tpV ON k.idThanhPhanVao = tpV.idThanhPhan
                JOIN thanhphan_thietbi tpR ON k.idThanhPhanRa = tpR.idThanhPhan
                JOIN thietbi t ON tpR.idThietBi = t.idThietBi
                WHERE t.maThietBi = ? AND k.kichHoat = 1`;

            ketNoiDb.query(sqlLayKichBan, [tb.maThietBi], (err, dsKichBan) => {
                if (err) return;
                const goiTin = {
                    cmd: "UPDATE_RULES",
                    data: dsKichBan.map(k => ({
                        type: k.loaiKichBan, in: k.loaiVao, op: k.dieuKien, val: k.giaTriNguong,
                        out: k.loaiRa, act: k.hanhDong
                    }))
                };
                mqttClient.publish(`kho_iot/kichban/${tb.maThietBi}`, JSON.stringify(goiTin), { qos: 1, retain: true });
                console.log(`\x1b[35m[PUSH] Da cap nhat ${dsKichBan.length} kich ban cho: ${tb.maThietBi}\x1b[0m`);
            });
        });
    });
};

mqttClient.on('connect', () => {
    console.log(`\x1b[32m[${layThoiGian()}] >>> KET NOI HIVEMQ THANH CONG\x1b[0m`);
    mqttClient.subscribe('kho_iot/#');
});

mqttClient.on('message', (topic, message) => {
    try {
        const duLieu = JSON.parse(message.toString());
        const phanTopic = topic.split('/');
        const maThietBi = phanTopic[1];

        if (topic.endsWith('/status')) {
            if (duLieu.s !== undefined) capNhatTrangThai(maThietBi, duLieu.s);
        } else if (topic === `kho_iot/${maThietBi}`) {
            xuLyCamBien(maThietBi, duLieu);
        } else if (phanTopic[2] === 'log') {
            console.log(`\x1b[33m[LOG] ${maThietBi}: ${duLieu.action} -> ${duLieu.detail}\x1b[0m`);
        } else if (phanTopic[2] === 'ack') {
            console.log(`\x1b[36m[ACK] ${maThietBi}: Da ap dung kich ban.\x1b[0m`);
        }
    } catch (e) {}
});

app.get('/capnhatkichban', (req, res) => {
    const id = req.query.id;
    if (id) {
        dayKichBan(id);
        res.send('Dang xu ly...');
    } else {
        res.status(400).send('Thieu ID');
    }
});

app.listen(3001, () => {
    console.log('\n\x1b[1m=== SERVER PHU (PORT 3001) ===\x1b[0m\n');
});
