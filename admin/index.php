<?php
require_once '../controller/cls-admin.php';

session_start();
$thong_bao = '';

if (isset($_SESSION['admin'])) {
    header('Location: home.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $ten_dang_nhap = $_POST['ten_dang_nhap'] ?? '';
    $mat_khau = $_POST['mat_khau'] ?? '';

    if ($ten_dang_nhap === 'adminvippro' && $mat_khau === 'adminadmin') {
        // Gán thông tin admin vào session
        $_SESSION['admin'] = [
            'ho_ten' => 'Admin One', 
        ];

        header('Location: home.php');
        exit;
    } else {
        $thong_bao = 'Tên đăng nhập hoặc mật khẩu không đúng';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center bg-light" style="height: 100vh;">
    <div class="card p-4 shadow" style="min-width: 350px;">
        <h4 class="mb-4 text-center">Đăng nhập Admin</h4>

        <?php if ($thong_bao): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($thong_bao) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="ten_dang_nhap" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" name="ten_dang_nhap" id="ten_dang_nhap" required>
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
