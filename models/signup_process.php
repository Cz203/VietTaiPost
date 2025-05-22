<?php
session_start();

// Hàm kiểm tra mật khẩu và mật khẩu xác nhận có khớp không
function validatePasswords($password, $confirmPassword)
{
    if ($password !== $confirmPassword) {
        setErrorAndRedirect("Mật khẩu xác nhận không khớp!", "signup.php"); // Lưu lỗi và chuyển hướng về trang đăng ký
    }
}

// Hàm kiểm tra đầu vào có phải email hay số điện thoại hợp lệ không
function validateEmailOrPhone($input)
{
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) { // Kiểm tra xem có phải email hợp lệ không
        return [$input, NULL]; // Trả về email, số điện thoại là NULL
    } elseif (preg_match('/^[0-9]{10,11}$/', $input)) { // Kiểm tra xem có phải số điện thoại hợp lệ không (10-11 chữ số)
        return [NULL, $input]; // Trả về số điện thoại, email là NULL
    }
    // Nếu không phải email hoặc số điện thoại hợp lệ, lưu lỗi và chuyển hướng
    setErrorAndRedirect("Số điện thoại hoặc email không hợp lệ!", "signup.php");
}

function checkDuplicateEmailOrPhone($conn, $emailorsdt)
{
    $query = "SELECT email, so_dien_thoai FROM khachhang WHERE email = ? OR so_dien_thoai = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $emailorsdt, $emailorsdt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['email'] === $emailorsdt) {
            return "Email đã tồn tại!";
        } elseif ($row['so_dien_thoai'] === $emailorsdt) {
            return "Số điện thoại đã được đăng ký!";
        }
    }
    return false; // Không trùng
}



// Hàm đăng ký người dùng vào database

function registerUser($conn, $ho_ten, $so_dien_thoai, $email, $mat_khau)
{
    // Kiểm tra xem email hoặc số điện thoại đã tồn tại chưa
    $duplicateError = checkDuplicateEmailOrPhone($conn, $email ?? $so_dien_thoai);
    if ($duplicateError) {
        setErrorAndRedirect($duplicateError, "signup.php"); // Chuyển hướng nếu trùng
    }

    $query = "INSERT INTO khachhang (ho_ten, so_dien_thoai, email, mat_khau) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $hashedPassword = password_hash($mat_khau, PASSWORD_BCRYPT);
    $stmt->bind_param("ssss", $ho_ten, $so_dien_thoai, $email, $hashedPassword);

    try {
        $stmt->execute();
        showAlertAndRedirect("Đăng ký thành công", "login.php");
        header("Location: login.php"); // Chuyển hướng sau khi đăng ký thành công
        exit();
    } catch (mysqli_sql_exception $e) {
        // Ghi log hoặc hiển thị thông báo lỗi chi tiết (chỉ cho mục đích phát triển)
        error_log($e->getMessage());
        setErrorAndRedirect("Có lỗi xảy ra: " . $e->getMessage(), "signup.php");
    }
}


// Hàm hiển thị thông báo bằng alert và chuyển hướng trang (Sử dụng JavaScript)
function showAlertAndRedirect($message, $redirectPage)
{
    echo '<script type="text/javascript">
        alert("' . $message . '"); // Hiển thị thông báo lỗi bằng JavaScript
        window.location.href = "' . $redirectPage . '"; // Chuyển hướng đến trang khác
    </script>';
    exit();
}

// Hàm lưu thông báo lỗi vào session và chuyển hướng trang 
function setErrorAndRedirect($message, $redirectPage)
{
    $_SESSION['error_message'] = $message; // Lưu lỗi vào session
    header("Location: $redirectPage");
    exit();
}