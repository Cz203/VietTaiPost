<?php
session_start();
require_once './config/connectdb.php';
$db = new ConnectDB();
$conn = $db->connectDB1();
// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Lấy thông tin người dùng từ session nếu có
$userId = isset($_SESSION['id_khachhang']) ? $_SESSION['id_khachhang'] : (isset($_SESSION['id']) ? $_SESSION['id'] : null);
$userType = isset($_SESSION['id_khachhang']) ? 'khachhang' : (isset($_SESSION['id']) ? 'shipper' : 'guest');

// Debug: In ra thông tin session
echo "Debug - Session Info:<br>";
echo "User ID: " . $userId . "<br>";
echo "User Type: " . $userType . "<br>";
echo "Session Data: <pre>" . print_r($_SESSION, true) . "</pre><br>";

// Lấy thông tin người nhận từ URL
$receiverId = isset($_GET['receiver_id']) ? $_GET['receiver_id'] : null;
$receiverType = isset($_GET['receiver_type']) ? $_GET['receiver_type'] : null;

// Lấy danh sách người dùng để chat
$users = [];
if ($userType === 'shipper') {
    // Nếu là shipper, lấy danh sách khách hàng có đơn hàng đang giao
    $query = "SELECT DISTINCT k.id_khachhang as id, k.ho_ten as name, 'khachhang' as type 
              FROM khachhang k 
              INNER JOIN don_hang dh ON k.id_khachhang = dh.ma_khach_hang 
              INNER JOIN van_don vd ON dh.ma_don_hang = vd.ma_don_hang 
              WHERE vd.id_shipper = ? 
              AND dh.trang_thai IN ('đang giao', 'chờ shipper tới lấy')";

    // Debug: In ra câu query và tham số
    echo "Debug - Shipper Query:<br>";
    echo "Query: " . $query . "<br>";
    echo "User ID: " . $userId . "<br>";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debug: In ra số lượng kết quả
    echo "Number of results: " . $result->num_rows . "<br>";

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else if ($userType === 'khachhang') {
    // Nếu là khách hàng, lấy danh sách shipper đang giao hàng
    $query = "SELECT DISTINCT s.id, s.ho_ten as name, 'shipper' as type 
              FROM shipper s 
              INNER JOIN van_don vd ON s.id = vd.id_shipper 
              INNER JOIN don_hang dh ON vd.ma_don_hang = dh.ma_don_hang 
              WHERE dh.ma_khach_hang = ? 
              AND dh.trang_thai IN ('đang giao', 'chờ shipper tới lấy')";

    // Debug: In ra câu query và tham số
    echo "Debug - Customer Query:<br>";
    echo "Query: " . $query . "<br>";
    echo "User ID: " . $userId . "<br>";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debug: In ra số lượng kết quả
    echo "Number of results: " . $result->num_rows . "<br>";

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Debug: In ra danh sách users
echo "Debug - Users Array:<br>";
echo "<pre>" . print_r($users, true) . "</pre><br>";

// Get user information based on user type if logged in
if ($userId && $userType !== 'guest') {
    if ($userType === 'shipper') {
        // Query for shipper using 'id'
        $userQuery = "SELECT * FROM shipper WHERE id = ?";
    } else {
        // Query for khachhang using 'id_khachhang'
        $userQuery = "SELECT * FROM khachhang WHERE id_khachhang = ?";
    }

    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}

// Get receiver information
if ($receiverId && $receiverType) {
    if ($receiverType === 'shipper') {
        // Query for shipper using 'id'
        $receiverQuery = "SELECT * FROM shipper WHERE id = ?";
    } else {
        // Query for khachhang using 'id_khachhang'
        $receiverQuery = "SELECT * FROM khachhang WHERE id_khachhang = ?";
    }

    $stmt = $conn->prepare($receiverQuery);
    $stmt->bind_param('i', $receiverId);
    $stmt->execute();
    $receiver = $stmt->get_result()->fetch_assoc();
}

// Tạo room ID cho cuộc trò chuyện
$chatRoomId = $userId ? "chat_{$userId}_{$receiverId}" : "chat_guest_{$receiverId}";
// Tạo room ID cho người dùng
$userRoomId = $userId ? "user_{$userId}_{$userType}" : "user_guest_" . uniqid();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - VietTaiPost</title>
    <link rel="stylesheet" href="asset/css/chat.css">
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
</head>

<body>
    <div class="chat-container">
        <?php if (!$receiverId || !$receiverType): ?>
        <!-- Hiển thị danh sách người dùng nếu chưa chọn người nhận -->
        <div class="user-list">
            <h2>Danh sách chat</h2>
            <div class="user-list-container">
                <?php if (empty($users)): ?>
                <div class="no-users">Không có người dùng để chat</div>
                <?php else: ?>
                <?php foreach ($users as $user): ?>
                <a href="?receiver_id=<?php echo $user['id']; ?>&receiver_type=<?php echo $user['type']; ?>"
                    class="user-item">
                    <div class="user-name"><?php echo htmlspecialchars($user['name']); ?></div>
                    <div class="user-type"><?php echo $user['type'] === 'shipper' ? 'Shipper' : 'Khách hàng'; ?></div>
                </a>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php else: ?>
        <!-- Hiển thị chat box nếu đã chọn người nhận -->
        <div class="chat-header">
            <a href="chat.php" class="back-button">← Quay lại</a>
            <div class="receiver-info">
                <?php if ($receiver): ?>
                <h3><?php echo htmlspecialchars($receiver['ho_ten']); ?></h3>
                <span class="user-type"><?php echo $receiverType === 'shipper' ? 'Shipper' : 'Khách hàng'; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div id="chat-box">
            <div id="chat-messages"></div>
            <div class="chat-input-container">
                <input type="text" id="message-input" placeholder="Nhập tin nhắn...">
                <button id="send-button" data-receiver-id="<?php echo htmlspecialchars($receiverId); ?>"
                    data-receiver-type="<?php echo htmlspecialchars($receiverType); ?>"
                    data-chat-room="<?php echo htmlspecialchars($chatRoomId); ?>"
                    data-user-room="<?php echo htmlspecialchars($userRoomId); ?>">
                    Gửi
                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
    // Truyền thông tin người nhận vào biến global
    window.receiverInfo = {
        id: <?php echo json_encode($receiverId); ?>,
        type: <?php echo json_encode($receiverType); ?>,
        chatRoom: <?php echo json_encode($chatRoomId); ?>,
        userRoom: <?php echo json_encode($userRoomId); ?>
    };
    </script>
    <script src="asset/js/chat.js"></script>
    <script>
    // Initialize chat when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initChat(
            <?php echo json_encode($userId); ?>,
            <?php echo json_encode($userType); ?>,
            <?php echo json_encode($chatRoomId); ?>,
            <?php echo json_encode($userRoomId); ?>
        );
    });
    </script>
</body>

</html>