const mysql = require("mysql2");

// Database connection
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "qlgh",
});

// Store active users
const activeUsers = new Map();

function initializeChat(io) {
  io.on("connection", (socket) => {
    console.log("User connected to chat:", socket.id);

    // Handle user authentication
    socket.on("authenticate", async (data) => {
      const { userId, userType } = data;
      activeUsers.set(socket.id, { userId, userType });
      console.log("User authenticated:", {
        socketId: socket.id,
        userId,
        userType,
      });

      // Join user's personal room
      const userRoom = `user_${userId}_${userType}`;
      socket.join(userRoom);
      console.log("User joined room:", userRoom);

      // Get unread messages
      const query = `
        SELECT * FROM messages 
        WHERE (sender_id = ? OR receiver_id = ?) 
        AND is_read = 0
        ORDER BY created_at ASC
      `;

      db.query(query, [userId, userId], (err, results) => {
        if (err) {
          console.error("Error fetching messages:", err);
          return;
        }
        console.log("Fetched unread messages:", results);
        socket.emit("unread_messages", results);
      });
    });

    // Handle private messages
    socket.on("private_message", async (data) => {
      console.log("Received private message:", data);
      const { receiverId, receiverType, message, chatRoom, userRoom } = data;
      const sender = activeUsers.get(socket.id);

      if (!sender) {
        console.error("Sender not found for socket:", socket.id);
        return;
      }

      // Kiểm tra loại người gửi và người nhận
      if (sender.userType === receiverType) {
        console.error("Cannot send message to same user type");
        socket.emit("error", "Không thể gửi tin nhắn cho cùng loại người dùng");
        return;
      }

      try {
        // Save message to database
        const query = `
          INSERT INTO messages (sender_id, sender_type, receiver_id, receiver_type, message)
          VALUES (?, ?, ?, ?, ?)
        `;

        const [result] = await db
          .promise()
          .execute(query, [
            sender.userId,
            sender.userType,
            receiverId,
            receiverType,
            message,
          ]);

        console.log("Message saved to database with ID:", result.insertId);

        const messageData = {
          id: result.insertId,
          sender_id: sender.userId,
          sender_type: sender.userType,
          receiver_id: receiverId,
          receiver_type: receiverType,
          message: message,
          created_at: new Date(),
        };

        // Emit to sender
        socket.emit("message_sent", messageData);
        console.log("Message sent to sender");

        // Emit to receiver if online
        io.to(userRoom).emit("new_message", messageData);
        console.log("Message sent to receiver room:", userRoom);

        // Emit to chat room
        io.to(chatRoom).emit("new_message", messageData);
        console.log("Message sent to chat room:", chatRoom);

        const messageClass =
          messageData.sender_type === currentUser.type ? "sent" : "received";
        const messageElement = document.createElement("div");
        messageElement.className = `message ${messageClass}`;
        messageElement.textContent = messageData.message;
        messageElement.setAttribute("data-id", messageData.id);
        messageElement.setAttribute("data-sender-id", messageData.sender_id);
        messageElement.setAttribute(
          "data-sender-type",
          messageData.sender_type
        );
        messageElement.setAttribute(
          "data-receiver-id",
          messageData.receiver_id
        );
        messageElement.setAttribute(
          "data-receiver-type",
          messageData.receiver_type
        );
        messageElement.setAttribute(
          "data-created-at",
          messageData.created_at.toISOString()
        );

        // Append message to chat container
        const chatContainer = document.querySelector(".chat-container");
        chatContainer.appendChild(messageElement);
      } catch (error) {
        console.error("Error saving message to database:", error);
        socket.emit("error", "Failed to send message");
      }
    });

    // Handle message read status
    socket.on("mark_as_read", async (messageId) => {
      console.log("Marking message as read:", messageId);
      try {
        const query = `
          UPDATE messages 
          SET is_read = 1 
          WHERE id = ?
        `;

        await db.promise().execute(query, [messageId]);
        console.log("Message marked as read:", messageId);
      } catch (error) {
        console.error("Error marking message as read:", error);
      }
    });

    // Handle disconnection
    socket.on("disconnect", () => {
      activeUsers.delete(socket.id);
      console.log("User disconnected from chat:", socket.id);
    });
  });

  db.connect((err) => {
    if (err) {
      console.error("Error connecting to database:", err);
      return;
    }
    console.log("Connected to database successfully");
  });
}

module.exports = initializeChat;
