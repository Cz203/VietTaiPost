const WebSocket = require("ws");
const mysql = require("mysql2");

const wss = new WebSocket.Server({ port: 8080 });
console.log("WebSocket server đang chạy tại ws://localhost:8080");

const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "qlgh",
});

wss.on("connection", (ws) => {
  ws.on("message", (message) => {
    try {
      const data = JSON.parse(message);
      const { id, vi_do, kinh_do } = data;

      // Kiểm tra trạng thái hoạt động của shipper
      db.query(
        "SELECT trang_thai FROM shipper WHERE id = ?",
        [id],
        (err, results) => {
          if (err) {
            console.error("Lỗi khi kiểm tra trạng thái shipper:", err);
            return;
          }

          if (results.length === 0) {
            console.error(`Không tìm thấy shipper với id ${id}`);
            return;
          }

          const trang_thai = results[0].trang_thai;

          // Chỉ cập nhật vị trí nếu shipper đang hoạt động
          if (trang_thai === "Đang hoạt động") {
            db.query(
              "UPDATE shipper SET vi_do = ?, kinh_do = ? WHERE id = ?",
              [vi_do, kinh_do, id],
              (err) => {
                if (err) {
                  console.error("Lỗi khi cập nhật vị trí:", err);
                } else {
                  console.log(
                    `Cập nhật vị trí shipper ${id}: (${vi_do}, ${kinh_do})`
                  );
                  // Gửi dữ liệu cập nhật đến tất cả các client đang kết nối
                  wss.clients.forEach((client) => {
                    if (client.readyState === WebSocket.OPEN) {
                      client.send(JSON.stringify({ id, vi_do, kinh_do }));
                    }
                  });
                }
              }
            );
          } else {
            console.log(`Shipper ${id} không hoạt động, không cập nhật vị trí`);
          }
        }
      );
    } catch (err) {
      console.error("Lỗi xử lý dữ liệu:", err);
    }
  });
});
