const WebSocket = require('ws');
const mysql = require('mysql2');

const wss = new WebSocket.Server({ port: 8080 });
console.log("WebSocket server đang chạy tại ws://localhost:8080");

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'qlgh'
});

wss.on('connection', (ws) => {
    ws.on('message', (message) => {
        try {
            const data = JSON.parse(message);
            const { id, vi_do, kinh_do } = data;

            db.query(
                'UPDATE shipper SET vi_do = ?, kinh_do = ? WHERE id = ?',
                [vi_do, kinh_do, id],
                (err) => {
                    if (err) console.error('Lỗi khi cập nhật vị trí:', err);
                    else console.log(`Cập nhật vị trí shipper ${id}: (${vi_do}, ${kinh_do})`);
                }
            );
        } catch (err) {
            console.error('Lỗi xử lý dữ liệu:', err);
        }
    });
});
