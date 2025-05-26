const mysql = require("mysql2/promise");

// Tạo kết nối database
const pool = mysql.createPool({
  host: "localhost",
  user: "root",
  password: "",
  database: "qlgh",
});

function initializeChat(io) {
  // Lưu trữ thông tin người dùng đang online
  const onlineUsers = new Map();

  io.on("connection", (socket) => {
    console.log("User connected:", socket.id);

    // Xử lý khi người dùng tham gia chat
    socket.on("join_chat", async (data) => {
      const { userId, userType, chatRoom, userRoom } = data;

      // Lưu thông tin người dùng
      onlineUsers.set(socket.id, {
        userId,
        userType,
        chatRoom,
        userRoom,
      });

      // Tham gia vào phòng chat
      socket.join(chatRoom);
      socket.join(userRoom);

      // Lấy lịch sử chat
      try {
        const [messages] = await pool.query(
          `SELECT * FROM messages 
                    WHERE (sender_id = ? AND sender_type = ? AND receiver_id = ? AND receiver_type = ?)
                    OR (sender_id = ? AND sender_type = ? AND receiver_id = ? AND receiver_type = ?)
                    ORDER BY created_at ASC`,
          [
            userId,
            userType,
            data.receiverId,
            data.receiverType,
            data.receiverId,
            data.receiverType,
            userId,
            userType,
          ]
        );

        socket.emit("chat_history", messages);
      } catch (error) {
        console.error("Error fetching chat history:", error);
      }
    });

    // Xử lý tin nhắn mới
    socket.on("send_message", async (data) => {
      const { message, receiverId, receiverType, chatRoom } = data;
      const user = onlineUsers.get(socket.id);

      if (!user) return;

      try {
        // Lưu tin nhắn vào database
        const [result] = await pool.query(
          `INSERT INTO messages (sender_id, sender_type, receiver_id, receiver_type, message) 
                    VALUES (?, ?, ?, ?, ?)`,
          [user.userId, user.userType, receiverId, receiverType, message]
        );

        const messageData = {
          id: result.insertId,
          sender_id: user.userId,
          sender_type: user.userType,
          receiver_id: receiverId,
          receiver_type: receiverType,
          message: message,
          created_at: new Date(),
        };

        // Gửi tin nhắn đến phòng chat
        io.to(chatRoom).emit("new_message", messageData);

        // Kiểm tra trạng thái đơn hàng
        const [orders] = await pool.query(
          `SELECT * FROM don_hang 
                    WHERE ma_khach_hang = ? AND trang_thai = 'chờ shipper tới lấy'`,
          [user.userType === "khachhang" ? user.userId : receiverId]
        );

        if (orders.length > 0) {
          // Gửi thông báo về trạng thái đơn hàng
          io.to(chatRoom).emit("order_status", {
            orderId: orders[0].ma_don_hang,
            status: orders[0].trang_thai,
          });
        }
      } catch (error) {
        console.error("Error sending message:", error);
      }
    });

    // Xử lý khi người dùng đánh dấu tin nhắn đã đọc
    socket.on("mark_as_read", async (data) => {
      const { messageId } = data;
      try {
        await pool.query("UPDATE messages SET is_read = 1 WHERE id = ?", [
          messageId,
        ]);
      } catch (error) {
        console.error("Error marking message as read:", error);
      }
    });

    // Xử lý khi người dùng ngắt kết nối
    socket.on("disconnect", () => {
      const user = onlineUsers.get(socket.id);
      if (user) {
        onlineUsers.delete(socket.id);
        console.log("User disconnected:", user.userId);
      }
    });
  });
}

module.exports = initializeChat;
