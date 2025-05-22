<?php
require_once '../controller/cls-shipper.php';

$thong_bao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
    $mat_khau = $_POST['mat_khau'] ?? '';

    $shipper = new clsShipper();
    $result = $shipper->login($so_dien_thoai, $mat_khau);

    if ($result) {
        // Lưu thông tin shipper vào session
        session_start();
        $_SESSION['shipper'] = $result;
        header('Location: home.php');
        exit;
    } else {
        $thong_bao = 'Số điện thoại hoặc mật khẩu không đúng';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Shipper</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
</head>

<body class="d-flex justify-content-center align-items-center bg-light" style="height: 100vh;">
    <div class="card p-4 shadow" style="min-width: 350px;">
        <h4 class="mb-4 text-center">Đăng nhập Shipper</h4>
        <?php if ($thong_bao): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($thong_bao) ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="so_dien_thoai" id="so_dien_thoai" required>
            </div>
            <div class="mb-3">
                <label for="mat_khau" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" name="mat_khau" id="mat_khau" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
    </div>
</body>

</html>