<?php
session_start();
include('config/connectdb.php');
$db = new ConnectDB();
$conn = $db->connectDB1();

// Hàm lấy thông tin người dùng theo email hoặc số điện thoại
function getUserByEmailOrPhone($conn, $input)
{
    // Chỉ truy vấn bảng khachhang
    $query = "SELECT id_khachhang AS id, ho_ten, email, so_dien_thoai, mat_khau 
              FROM khachhang WHERE email = ? OR so_dien_thoai = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc(); // Trả về thông tin tài khoản nếu có
}

// Hàm kiểm tra mật khẩu
function verifyPassword($inputPassword, $hashedPassword)
{
    return password_verify($inputPassword, $hashedPassword);
}

// Hàm tạo session cho người dùng sau khi đăng nhập thành công
function createSession($user)
{
    $_SESSION["id"] = $user["id"];
    $_SESSION["ho_ten"] = $user["ho_ten"];
    $_SESSION["role"] = "khachhang"; // Set cứng role là khachhang
}

// Hàm xử lý đăng nhập
function handleLogin($conn, $emailorsdt, $mat_khau)
{
    $user = getUserByEmailOrPhone($conn, $emailorsdt);

    if (!$user) {
        $_SESSION["error_message"] = "Tài khoản không tồn tại!";
        return false;
    }

    if (!verifyPassword($mat_khau, $user["mat_khau"])) {
        $_SESSION["error_message"] = "Mật khẩu không đúng!";
        return false;
    }

    createSession($user); // Tạo session sau khi đăng nhập thành công
    header("Location: http://localhost/viettaipost/");
    exit();
}