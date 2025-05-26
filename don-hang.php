<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đơn hàng</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <style>
    .status-badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-weight: 500;
        display: inline-block;
    }

    .status-pending {
        background-color: #ffd700;
        color: #000;
    }

    .status-waiting {
        background-color: #87ceeb;
        color: #000;
    }

    .status-picked {
        background-color: #98fb98;
        color: #000;
    }

    .status-delivering {
        background-color: #ffa500;
        color: #000;
    }

    .status-delivered {
        background-color: #90ee90;
        color: #000;
    }

    .status-cancelled {
        background-color: #ff6b6b;
        color: #fff;
    }
    </style>
</head>
<?php

require_once 'controller/cls-khachhang.php';
$kh = new clsKhachhang();
session_start();
$ma_khach_hang = $_SESSION['id']; // test 11
$don_hangs = $kh->layDonHangKhachHang($ma_khach_hang);

?>

<body class="d-flex">
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
                        <td><?= $don['ten_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui_mac_dinh'] ?>
                        </td>
                        <td><?= $don['ten_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?>
                        </td>
                        <td>
                            <?php
                                // $statusClass = '';
                                // switch (strtolower($don['trang_thai'])) {
                                //     case 'chờ xử lý':
                                //         $statusClass = 'status-pending';
                                //         break;
                                //     case 'chờ shipper tới lấy':
                                //         $statusClass = 'status-waiting';
                                //         break;
                                //     case 'đã lấy hàng':
                                //         $statusClass = 'status-picked';
                                //         break;
                                //     case 'đang giao':
                                //         $statusClass = 'status-delivering';
                                //         break;
                                //     case 'đã giao':
                                //         $statusClass = 'status-delivered';
                                //         break;
                                //     case 'hủy':
                                //         $statusClass = 'status-cancelled';
                                //         break;
                                // }
                                ?>
                            <span class="status-badge <?= $statusClass ?>"><?= $don['trang_thai'] ?></span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#modal<?= $don['ma_don_hang'] ?>">Chi tiết
                                </button>
                                <?php if (strtolower($don['trang_thai']) == 'chờ xử lý'): ?>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#cancelModal<?= $don['ma_don_hang'] ?>">
                                    Hủy đơn
                                </button>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex gap-2 mt-2">
                                <a href="chatbox_khachhang.php" class="btn btn-info">
                                    <i class="fas fa-comments"></i>Chat
                                </a>
                            </div>
                        </td>

                    </tr>

                    <!-- Modal Hủy đơn -->
                    <div class="modal fade" id="cancelModal<?= $don['ma_don_hang'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Xác nhận hủy đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Đóng"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn hủy đơn hàng <strong><?= $don['ma_don_hang'] ?></strong>?
                                    </p>
                                    <p class="text-danger">Lưu ý: Hành động này không thể hoàn tác.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <form action="controller/cls-khachhang.php" method="POST">
                                        <input type="hidden" name="ma_don_hang" value="<?= $don['ma_don_hang'] ?>">
                                        <button type="submit" name="huy_don_hang" class="btn btn-danger">Xác nhận
                                            hủy</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal<?= $don['ma_don_hang'] ?>" tabindex="-1"
                        aria-labelledby="modalLabel<?= $don['ma_don_hang'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel<?= $don['ma_don_hang'] ?>">Chi tiết đơn hàng
                                        <?= $don['ma_don_hang'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Đóng"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <!-- Chi tiết đơn hàng -->
                                        <div class="col-md-7">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>Tên đơn hàng:</strong>
                                                    <?= $don['ten_don_hang'] ?></li>
                                                <li class="list-group-item"><strong>Số lượng:</strong>
                                                    <?= $don['so_luong'] ?></li>
                                                <li class="list-group-item"><strong>Trọng lượng:</strong>
                                                    <?= $don['trong_luong'] ?> gram</li>
                                                <li class="list-group-item"><strong>Người gửi:</strong>
                                                    <?= $don['ten_nguoi_gui'] ?> (<?= $don['sdt_nguoi_gui'] ?>)</li>
                                                <li class="list-group-item"><strong>Địa chỉ gửi:</strong>
                                                    <?= $don['dia_chi_nguoi_gui'] ?> -
                                                    <?= $don['dia_chi_nguoi_gui_mac_dinh'] ?></li>
                                                <li class="list-group-item"><strong>Người nhận:</strong>
                                                    <?= $don['ten_nguoi_nhan'] ?> (<?= $don['sdt_nguoi_nhan'] ?>)</li>
                                                <li class="list-group-item"><strong>Địa chỉ nhận:</strong>
                                                    <?= $don['dia_chi_nguoi_nhan'] ?> -
                                                    <?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?></li>
                                                <li class="list-group-item"><strong>Thu hộ:</strong>
                                                    <?= number_format($don['thu_ho']) ?>đ</li>
                                                <li class="list-group-item"><strong>Phí vận chuyển:</strong>
                                                    <?= number_format($don['phi_van_chuyen']) ?>đ</li>
                                                <li class="list-group-item"><strong>Người trả phí:</strong>
                                                    <?= $don['nguoi_tra_phi'] ?></li>
                                                <li class="list-group-item"><strong>Trạng thái:</strong>
                                                    <?= $don['trang_thai'] ?></li>
                                                <li class="list-group-item"><strong>Ngày tạo:</strong>
                                                    <?= $don['ngay_tao'] ?></li>
                                                <li class="list-group-item"><strong>Thời gian hẹn lấy:</strong>
                                                    <?= $don['thoi_gian_hen_lay'] ?></li>
                                                <li class="list-group-item"><strong>Ngày giao dự kiến:</strong>
                                                    <?= $don['ngay_giao_du_kien'] ?></li>
                                                <li class="list-group-item"><strong>Ghi chú:</strong>
                                                    <?= $don['ghi_chu'] ?></li>
                                            </ul>
                                        </div>

                                        <!-- Theo dõi kiện hàng -->
                                        <div class="col-md-5">
                                            <div class="card border shadow-sm">
                                                <div class="card-header bg-primary text-white">Theo dõi kiện hàng</div>
                                                <div class="card-body">
                                                    <?php
                                                        $van_dons = $kh->layVanDonTheoMaDon($don['ma_don_hang']);
                                                        $hasTracking = false;

                                                        foreach ($van_dons as $vd) {
                                                            switch ($vd['trang_thai']) {
                                                                case 'đợi lấy hàng':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🕐 Đợi lấy hàng:</strong><br>📌 {$vd['lich_su']}<br>👤 Shipper: {$vd['ten_shipper']} ({$vd['sdt_shipper']})</p><hr>";
                                                                    break;
                                                                case 'đã lấy hàng':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>✅ Đã lấy hàng:</strong><br>📌 {$vd['lich_su']}</p><hr>";
                                                                    break;
                                                                case 'ở bưu cục':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🏢 Đang ở bưu cục:</strong><br>📌 {$vd['lich_su']}<br></p><hr>";
                                                                    break;
                                                                case 'trong xe':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🚚 Đang giao:</strong><br>📌 {$vd['lich_su']}<br></p><hr>";
                                                                    break;
                                                                case 'đang đi giao':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🚚 Đang giao:</strong><br>📌 {$vd['lich_su']}<br>👤 Shipper: {$vd['ten_shipper']} ({$vd['sdt_shipper']})</p><hr>";
                                                                    break;
                                                                case 'hủy':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>❌ Đã bị hủy:</strong><br>📌 {$vd['lich_su']}</p>";
                                                                    break;
                                                                case 'giao thành công':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🎉 Đã giao thành công:</strong><br>📌 {$vd['lich_su']}<br>👤 Shipper: {$vd['ten_shipper']} ({$vd['sdt_shipper']})</p>";
                                                                    break;
                                                            }
                                                        }

                                                        if (!$hasTracking) {
                                                            echo "<p class='text-muted'>Chưa có thông tin theo dõi.</p>";
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
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