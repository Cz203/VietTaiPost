<?php
session_start();
include('../config/connectdb.php');
$db = new ConnectDB();
$conn = $db->connectDB1();
$ma_don_hang = $_GET['ma_don_hang'];
// Debug session chi tiết

// Kiểm tra đăng nhập
if (!isset($_SESSION['shipper'])) {

    header('Location: login.php');
    exit();
}

$userId = $_SESSION['shipper']['id'];
$userName = $_SESSION['shipper']['ho_ten'];
$userType = 'shipper';

// Lấy thông tin khách hàng đang chờ shipper
$sql = "SELECT 
            k.*, 
            d.ma_don_hang,
            vd.trang_thai as trang_thai_van_don,
            vd.ghi_chu as ghi_chu_van_don
        FROM khachhang k 
        JOIN don_hang d ON k.id_khachhang = d.ma_khach_hang 
        JOIN van_don vd ON d.ma_don_hang = vd.ma_don_hang
        WHERE vd.trang_thai = 'đợi lấy hàng'
        AND vd.id_shipper = ? and vd.ma_don_hang = ?
        ORDER BY vd.thoi_gian_cap_nhat DESC
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $userId,$ma_don_hang);
$stmt->execute();
$result = $stmt->get_result();
$chatPartner = $result->fetch_assoc();

// Tạo ID phòng chat
$chatRoomId = "chat_" . min($userId, $chatPartner['id_khachhang']) . "_" . max($userId, $chatPartner['id_khachhang']);
$userRoomId = "user_" . $userId . "_shipper";


?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - VietTaiPost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../asset/css/chatbox.css">
</head>

<body>
    <div class="chat-container">
        <div class="chat-header">
            <div class="receiver-info">
                <img src="../asset/img/user-avatar.png" alt="Avatar">
                <div>
                    <h5 class="mb-0"><?php echo htmlspecialchars($chatPartner['ho_ten']); ?></h5>
                    <span class="user-type">Khách hàng</span>
                </div>
            </div>
            <div class="status-badge">
                <i class="fas fa-circle"></i> Online
            </div>
        </div>

        <div class="chat-messages" id="chat-messages">
            <!-- Messages will be loaded here -->
        </div>

        <div class="chat-input-container">
            <input type="text" class="chat-input" id="message-input" placeholder="Nhập tin nhắn...">
            <button class="send-button" id="send-button">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    <script>
    const socket = io('http://localhost:3000');

    // Xử lý thu gọn/mở rộng chat box
    const chatContainer = document.querySelector('.chat-container');
    const chatHeader = document.querySelector('.chat-header');

    chatHeader.addEventListener('click', () => {
        chatContainer.classList.toggle('minimized');
    });

    // Truyền thông tin người dùng vào biến global
    window.userInfo = {
        id: <?php echo json_encode($userId); ?>,
        type: <?php echo json_encode($userType); ?>,
        name: <?php echo json_encode($userName); ?>,
        chatRoom: <?php echo json_encode($chatRoomId); ?>,
        userRoom: <?php echo json_encode($userRoomId); ?>
    };

    // Tham gia phòng chat khi trang được tải
    socket.emit('join_chat', {
        userId: window.userInfo.id,
        userType: window.userInfo.type,
        receiverId: <?php echo json_encode($chatPartner['id_khachhang']); ?>,
        receiverType: 'khachhang',
        chatRoom: window.userInfo.chatRoom,
        userRoom: window.userInfo.userRoom
    });

    // Xử lý lịch sử chat
    socket.on('chat_history', (messages) => {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.innerHTML = '';
        messages.forEach(message => {
            appendMessage(message);
        });
        scrollToBottom();
    });

    // Xử lý tin nhắn mới
    socket.on('new_message', (message) => {
        appendMessage(message);
        scrollToBottom();
    });

    // Xử lý trạng thái đơn hàng
    socket.on('order_status', (data) => {
        const statusBadge = document.querySelector('.status-badge');
        statusBadge.innerHTML = `<i class="fas fa-box"></i> ${data.status}`;
    });

    // Hàm thêm tin nhắn vào giao diện
    function appendMessage(message) {
        const chatMessages = document.getElementById('chat-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${message.sender_id == window.userInfo.id ? 'sent' : 'received'}`;

        const time = new Date(message.created_at).toLocaleTimeString('vi-VN', {
            hour: '2-digit',
            minute: '2-digit'
        });

        messageDiv.innerHTML = `
            <div class="message-content">${message.message}</div>
            <div class="message-time">${time}</div>
        `;

        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }

    // Hàm cuộn xuống tin nhắn mới nhất
    function scrollToBottom() {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Xử lý gửi tin nhắn
    document.getElementById('send-button').addEventListener('click', sendMessage);
    document.getElementById('message-input').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    function sendMessage() {
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value.trim();

        if (message) {
            socket.emit('send_message', {
                message: message,
                receiverId: <?php echo json_encode($chatPartner['id_khachhang']); ?>,
                receiverType: 'khachhang',
                chatRoom: window.userInfo.chatRoom
            });

            messageInput.value = '';
        }
    }
    </script>
</body>

</html>