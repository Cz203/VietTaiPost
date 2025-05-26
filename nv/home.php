<?php
require_once '../controller/cls-shipper.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['shipper'])) {
    header("Location: login.php");
    exit();
}


$shipper = $_SESSION['shipper'];
$id_shipper = $shipper['id'] ?? 1;
// Lấy số liệu thống kê
$donhang = new clsShipper();
$so_don_da_giao = $donhang->demDonDaGiaoThanhCongTrongThang($id_shipper);
$so_don_can_lay = $donhang->demDonHangCanLay($id_shipper);
$so_don_can_giao = $donhang->demDonCanGiao($id_shipper);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Shipper</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
</head>

<body class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    ?>
    <div class="main-content">
        <?php
        require_once 'view/header.php';
        ?>
<div class="container px-4 pb-5 card border rounded-4 mt-5 py-4">
        <h1>Thống kê đơn hàng cho Shipper</h1>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Đơn đã giao thành công (Tháng này)</div>
                    <div class="card-body">
                        <h3 class="card-title"><?= $so_don_da_giao ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Đơn cần lấy</div>
                    <div class="card-body">
                        <h3 class="card-title"><?= $so_don_can_lay ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Đơn cần giao</div>
                    <div class="card-body">
                        <h3 class="card-title"><?= $so_don_can_giao ?></h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    
</body>

</html>
