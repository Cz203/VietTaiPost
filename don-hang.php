<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="asset/js/bootstrap.bundle.min.js"></script>

</head>
<?php 

require_once 'controller/cls-khachhang.php';
$kh = new clsKhachhang();
$ma_khach_hang = 1;
// $ma_khach_hang = $_SESSION['ma_khach_hang']; // test 11
$don_hangs = $kh->layDonHangKhachHang($ma_khach_hang);

?>
<body  class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    ?>
    
    <div class="main-content">

    <?php
    require_once 'view/header.php';
    ?>
<div class="container px-4 pb-5 card border rounded-4 mt-5">
    <h3 class="mt-4">Danh sách đơn hàng</h3>
    <table class="table table-bordered table-hover mt-3">
        <thead class="table-light">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tên đơn hàng</th>
                <th>Người gửi</th>
                <th>Người nhận</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($don_hangs as $don): ?>
            <tr>
                <td><?= $don['ma_don_hang'] ?></td>
                <td><?= $don['ten_don_hang'] ?></td>
                <td><?= $don['ten_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui_mac_dinh'] ?></td>
                <td><?= $don['ten_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?></td>
                <td><?= $don['trang_thai'] ?></td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $don['ma_don_hang'] ?>">
                        Chi tiết
                    </button>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="modal<?= $don['ma_don_hang'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $don['ma_don_hang'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel<?= $don['ma_don_hang'] ?>">Chi tiết đơn hàng <?= $don['ma_don_hang'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Tên đơn hàng:</strong> <?= $don['ten_don_hang'] ?></li>
                    <li class="list-group-item"><strong>Số lượng:</strong> <?= $don['so_luong'] ?></li>
                    <li class="list-group-item"><strong>Trọng lượng:</strong> <?= $don['trong_luong'] ?> gram</li>
                    <li class="list-group-item"><strong>Người gửi:</strong> <?= $don['ten_nguoi_gui'] ?> (<?= $don['sdt_nguoi_gui'] ?>)</li>
                    <li class="list-group-item"><strong>Địa chỉ gửi:</strong> <?= $don['dia_chi_nguoi_gui'] ?> - <?= $don['dia_chi_nguoi_gui_mac_dinh'] ?></li>
                    <li class="list-group-item"><strong>Người nhận:</strong> <?= $don['ten_nguoi_nhan'] ?> (<?= $don['sdt_nguoi_nhan'] ?>)</li>
                    <li class="list-group-item"><strong>Địa chỉ nhận:</strong> <?= $don['dia_chi_nguoi_nhan'] ?> - <?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?></li>
                    <li class="list-group-item"><strong>Thu hộ:</strong> <?= number_format($don['thu_ho']) ?>đ</li>
                    <li class="list-group-item"><strong>Phí vận chuyển:</strong> <?= number_format($don['phi_van_chuyen']) ?>đ</li>
                    <li class="list-group-item"><strong>Người trả phí:</strong> <?= $don['nguoi_tra_phi'] ?></li>
                    <li class="list-group-item"><strong>Trạng thái:</strong> <?= $don['trang_thai'] ?></li>
                    <li class="list-group-item"><strong>Ngày tạo:</strong> <?= $don['ngay_tao'] ?></li>
                    <li class="list-group-item"><strong>Thời gian hẹn lấy:</strong> <?= $don['thoi_gian_hen_lay'] ?></li>
                    <li class="list-group-item"><strong>Ngày giao dự kiến:</strong> <?= $don['ngay_giao_du_kien'] ?></li>
                    <li class="list-group-item"><strong>Ghi chú:</strong> <?= $don['ghi_chu'] ?></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
                </div>
            </div>
            </div>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>


</body>
</html>


