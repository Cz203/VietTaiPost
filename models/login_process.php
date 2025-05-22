<?php
session_start();
include('config/connectdb.php');
$db = new ConnectDB();
$conn = $db->connectDB1();

// Hàm lấy thông tin người dùng theo email hoặc số điện thoại
function getUserByEmailOrPhone($conn, $input)
{
    // Truy vấn kiểm tra tài khoản trong 3 bảng (admin, khachhang, nhanvien)
    $query = "SELECT id_khachhang AS id, ho_ten, email, so_dien_thoai, mat_khau, 'khachhang' AS role FROM khachhang WHERE email = ? OR so_dien_thoai = ?";

    $stmt = $conn->prepare($query);
    // $stmt->bind_param("ssssss", $input, $input, $input, $input, $input, $input);
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc(); // Trả về thông tin tài khoản nếu có
}


// Hàm kiểm tra mật khẩu
function verifyPassword($inputPassword, $hashedPassword)
{
    return password_verify($inputPassword, $hashedPassword); // So sánh mật khẩu người dùng nhập vào với mật khẩu đã mã hóa trong database
}

// Hàm tạo session cho người dùng sau khi đăng nhập thành công
function createSession($user)
{
    $_SESSION["id"] = $user["id"]; // Lưu ID chung (có thể là id_admin, id_khachhang, id_nhanvien)
    $_SESSION["ho_ten"] = $user["ho_ten"]; // Lưu họ tên
    $_SESSION["role"] = $user["role"]; // Lưu vai trò (admin, khachhang, nhanvien)

}


// Hàm xử lý đăng nhập
function handleLogin($conn, $emailorsdt, $mat_khau)
{
    $user = getUserByEmailOrPhone($conn, $emailorsdt); // Tìm kiếm người dùng trong database

    if (!$user) {
        $_SESSION["error_message"] = "Tài khoản không tồn tại!";
        return false;
    }

    if (!verifyPassword($mat_khau, $user["mat_khau"])) {
        $_SESSION["error_message"] = "Mật khẩu không đúng!";
        return false;
    }

    //Kiểm tra trạng thái tài khoản nếu là nhân viên
    if ($user["role"] === "nhanvien") {
        $sql = "SELECT trang_thai FROM nhanvien WHERE id_nhanvien = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user["id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $employee = $result->fetch_assoc();

        if ($employee && $employee["trang_thai"] === "Khóa tài khoản") {
            echo "<script>alert('Tài khoản của bạn đã bị khóa!'); window.location.href='/Transport_Management/login.php';</script>";
            return false;
        }

        // Cập nhật trạng thái và thời gian đăng nhập cuối cùng
        $updateSql = "UPDATE nhanvien SET trang_thai = 'Đang hoạt động', last_login = NOW() WHERE id_nhanvien = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $user["id"]);
        $updateStmt->execute();
    }

    createSession($user); // Tạo session sau khi đăng nhập thành công

    // Điều hướng theo vai trò
    switch ($user["role"]) {
        // case "admin":
        //     header("Location: /Transport_Management/view/admin/dashboard.php");
        //     break;
        case "khachhang":
            header("Location:http://localhost/viettaipost/");
            break;
        // case "nhanvien":
        //     header("Location: /Transport_Management/view/employees/dashboard.php");
        //     break;
        default:
            $_SESSION["error_message"] = "Vai trò không hợp lệ!";
            header("Location:http://localhost/viettaipost/");
            break;
    }
    exit();
}