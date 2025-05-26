<?php
session_start();
require_once '../config/connectdb.php';

if (isset($_SESSION['shipper'])) {
    $db = new ConnectDB();
    $conn = $db->connectDB1();

    // Cập nhật trạng thái thành không hoạt động
    $sql = "UPDATE shipper SET trang_thai = 'Không hoạt động' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['shipper']['id']]);

    // Chỉ xóa session của shipper
    unset($_SESSION['shipper']);
}

// Chuyển hướng về trang login
header('Location: login.php');
exit();