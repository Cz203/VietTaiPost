<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['shipper'])) {
    // Nếu chưa đăng nhập, chuyển hướng về trang login
    header('Location: /viettaipost/nv/login.php');
    exit;
}

// Kiểm tra xem session có hợp lệ không
$shipper = $_SESSION['shipper'];
if (!isset($shipper['id']) || !isset($shipper['so_dien_thoai'])) {
    // Nếu session không hợp lệ, xóa session và chuyển hướng về trang login
    session_destroy();
    header('Location: /viettaipost/nv/login.php');
    exit;
}