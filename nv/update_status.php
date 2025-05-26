<?php
session_start();
require_once '../config/connectdb.php';

if (isset($_SESSION['shipper']) && isset($_POST['status'])) {
    $db = new ConnectDB();
    $conn = $db->connectDB1();

    $status = $_POST['status'] === 'offline' ? 'Không hoạt động' : 'Đang hoạt động';

    // Cập nhật trạng thái
    $sql = "UPDATE shipper SET trang_thai = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$status, $_SESSION['shipper']['id']]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}