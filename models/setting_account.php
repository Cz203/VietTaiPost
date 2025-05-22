<?php
// include('config/connectdb.php');
// $db = new ConnectDB();
// $conn = $db->connectDB1();


function getUserContactInfo($user_id, $conn)
{
    $sql = "SELECT email, so_dien_thoai FROM khachhang WHERE id_khachhang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Trả về mảng chứa email và số điện thoại
    }
    return null; // Trả về null nếu không tìm thấy
}

function updateEmail($conn, $id_khachhang, $email_moi, $email_hientai)
{
    $email_moi = trim($email_moi);

    // Kiểm tra email hợp lệ
    if (empty($email_moi) || !filter_var($email_moi, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['toast'] = [
            'type' => 'warning',
            'message' => 'Vui lòng nhập email hợp lệ!',
            'timeout' => 3000
        ];
        return false;
    }

    if ($email_moi === $email_hientai) {
        $_SESSION['toast'] = [
            'type' => 'warning',
            'message' => 'Email mới trùng với email cũ!',
            'timeout' => 3000
        ];
        return false;
    }

    // Kiểm tra số điện thoại đã tồn tại chưa (ngoại trừ chính khách hàng đang cập nhật)
    $sql_check = "SELECT id_khachhang FROM khachhang WHERE email = ? AND id_khachhang != ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("si", $email_moi, $id_khachhang);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $_SESSION['toast'] = [
            'type' => 'warning',
            'message' => 'Email đã tồn tại!',
            'timeout' => 3000
        ];
        $stmt_check->close();
        return false;
    }
    $stmt_check->close();
    // Cập nhật email trong database
    $sql = "UPDATE khachhang SET email = ? WHERE id_khachhang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email_moi, $id_khachhang);

    if ($stmt->execute()) {
        $_SESSION['email'] = $email_moi; // Cập nhật SESSION
        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Cập nhật email thành công!',
            'timeout' => 3000
        ];
        $_SESSION['allow_change_email'] = false;
        $stmt->close();
        return true;
    } else {
        $_SESSION['error_update_email'] = "Lỗi khi cập nhật email!";
        $stmt->close();
        return false;
    }
}

function updateSDT($conn, $id_khachhang, $SDT_moi, $SDT_hientai)
{
    $SDT_moi = trim($SDT_moi);

    // Kiểm tra số điện thoại hợp lệ (chỉ chứa số, từ 10-11 chữ số)
    if (empty($SDT_moi) || !preg_match('/^(0[2-9]|84[2-9])[0-9]{8,9}$/', $SDT_moi)) {
        $_SESSION['toast'] = [
            'type' => 'warning',
            'message' => 'Vui lòng nhập số điện thoại hợp lệ!',
            'timeout' => 3000
        ];
        return false;
    }

    if ($SDT_moi === $SDT_hientai) {
        $_SESSION['toast'] = [
            'type' => 'warning',
            'message' => 'Số điện thoại mới trùng với số cũ!',
            'timeout' => 3000
        ];
        return false;
    }
    // Kiểm tra số điện thoại đã tồn tại chưa (ngoại trừ chính khách hàng đang cập nhật)
    $sql_check = "SELECT id_khachhang FROM khachhang WHERE so_dien_thoai = ? AND id_khachhang != ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("si", $SDT_moi, $id_khachhang);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $_SESSION['toast'] = [
            'type' => 'warning',
            'message' => 'Số điện thoại đã tồn tại!',
            'timeout' => 3000
        ];
        $stmt_check->close();
        return false;
    }
    $stmt_check->close();

    // Cập nhật số điện thoại trong database
    $sql = "UPDATE khachhang SET so_dien_thoai = ? WHERE id_khachhang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $SDT_moi, $id_khachhang);

    if ($stmt->execute()) {
        $_SESSION['so_dien_thoai'] = $SDT_moi; // Cập nhật SESSION
        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Cập nhật số điện thoại thành công!',
            'timeout' => 3000
        ];
        $_SESSION['allow_change_sdt'] = false;
        $stmt->close();
        return true;
    } else {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Lỗi khi cập nhật số điện thoại!',
            'timeout' => 3000
        ];
        $stmt->close();
        return false;
    }
}

// function checkDuplicateEmail($conn, $email)
// {
//     $query = "SELECT id_khachhang FROM khachhang WHERE email = ?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("s", $email);
//     $stmt->execute();
//     $stmt->store_result();

//     if ($stmt->num_rows > 0) {
//         $stmt->close();
//         return "Email đã tồn tại!";
//     }

//     $stmt->close();
//     return false; // Không trùng
// }
// function checkDuplicatePhone($conn, $so_dien_thoai)
// {
//     $query = "SELECT id_khachhang FROM khachhang WHERE so_dien_thoai = ?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("s", $so_dien_thoai);
//     $stmt->execute();
//     $stmt->store_result();

//     if ($stmt->num_rows > 0) {
//         $stmt->close();
//         return "Số điện thoại đã được đăng ký!";
//     }

//     $stmt->close();
//     return false; // Không trùng
// }