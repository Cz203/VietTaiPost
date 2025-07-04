<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Duyệt đơn hàng</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
</head>

<?php
require_once '../controller/cls-admin.php';

require_once __DIR__ . '/../config/congifmail.php';



$admin = new clsAdmin();
$don_cho_xu_ly = $admin->layDonTheoTrangThai("chờ xử lý"); // Cần hàm này trong cls-admin4


$toName = 'Khách hàng';
$subject = 'Xác nhận đơn hàng';

$thong_bao = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ma_don = $_POST['ma_don_hang'] ?? null;
    $action = $_POST['action'] ?? null;
    $toEmail = $admin->layEmailKhachHangTheoMaDon($ma_don);
    $body = '<!DOCTYPE html>
        <html lang="vi">
        <head>
        <meta charset="UTF-8" />
        <title>Xác nhận đơn hàng</title>
        </head>
        <body style="margin:0; padding:0; font-family: Arial, sans-serif; background:#f4f4f4;">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f4f4f4; padding: 20px 0;">
            <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" border="0" width="600" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                
                <!-- Header -->
                <tr>
                    <td style="background:#007bff; color:#ffffff; padding:20px; text-align:center; font-size:24px; font-weight:bold;">
                    Viettaipost
                    </td>
                </tr>
                
                <!-- Body -->
                <tr>
                    <td style="padding: 30px; color:#333333; font-size:16px; line-height:1.5;">
                    <h2 style="color:#007bff;">Đơn hàng ' . $ma_don . ' của bạn đã được duyệt!</h2>
                    <p>Cảm ơn bạn đã đặt hàng tại Viettaipost. Đơn hàng của bạn đã được duyệt!</p>
                    <p>Shipper sẽ đến lấy hàng trong thời gian sớm nhất.</p>
                    <p>Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại.</p>
                    <br />
                    <p>Trân trọng,<br />Đội ngũ Viettaipost</p>
                    </td>
                </tr>
                
                <!-- Footer -->
                <tr>
                    <td style="background:#f1f1f1; color:#777777; font-size:12px; text-align:center; padding:15px;">
                    © 2025 Viettaipost. All rights reserved.<br />
                    Email này được gửi tự động, vui lòng không trả lời.
                    </td>
                </tr>
                </table>
            </td>
            </tr>
        </table>
        </body>
        </html>';

    if ($ma_don && $action) {

        if ($action === 'duyet') {
            $admin->capNhatTrangThaiDon($ma_don, 'duyệt');
            sendMail($toEmail, $toName, $subject, $body);
            $thong_bao = 'Đã duyệt đơn hàng thành công.';
        } elseif ($action === 'huy') {
            $admin->capNhatTrangThaiDon($ma_don, 'hủy');
            $thong_bao = 'Đã hủy đơn hàng thành công.';
        }

        // Sau khi cập nhật trạng thái, load lại danh sách đơn
        $don_cho_xu_ly = $admin->layDonTheoTrangThai("Chờ xử lý");
    }
}

?>



<body class="d-flex">
    <?php require_once 'view/sidebar.php'; ?>
    <div class="main-content">
        <?php require_once 'view/header.php'; ?>

        <?php if (!empty($thong_bao)): ?>
        <div class="alert alert-success alert-dismissible fade show mx-4 mt-3" role="alert">
            <?= $thong_bao ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
        <?php endif; ?>
        <div class="container px-4 pb-5 card border rounded-4 mt-5">
            <h3 class="mt-4">Duyệt đơn hàng</h3>
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-light">
                    <tr>
                        <th>Mã ĐH</th>
                        <th>Tên ĐH</th>
                        <th>Người gửi</th>
                        <th>Người nhận</th>
                        <th>Chi tiết</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($don_cho_xu_ly as $don): ?>
                    <tr>
                        <td><?= $don['ma_don_hang'] ?></td>
                        <td><?= $don['ten_don_hang'] ?></td>
                        <td><?= $don['ten_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui_mac_dinh'] ?>
                        </td>
                        <td><?= $don['ten_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn" data-bs-toggle="modal"
                                data-bs-target="#modal<?= $don['ma_don_hang'] ?>">
                                Chi tiết
                            </button>
                        </td>
                        <td>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="ma_don_hang" value="<?= $don['ma_don_hang'] ?>">
                                <input type="hidden" name="action" value="duyet">
                                <button type="submit" class="btn btn-success btn m-1">Duyệt</button>
                            </form>

                            <form method="post" style="display: inline;"
                                onsubmit="return confirm('Bạn có chắc muốn hủy đơn này?');">
                                <input type="hidden" name="ma_don_hang" value="<?= $don['ma_don_hang'] ?>">
                                <input type="hidden" name="action" value="huy">
                                <button type="submit" class="btn btn-danger btn m-1">Hủy</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal chi tiết -->
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
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Tên đơn hàng:</strong>
                                        <?= $don['ten_don_hang'] ?></li>
                                    <li class="list-group-item"><strong>Số lượng:</strong> <?= $don['so_luong'] ?></li>
                                    <li class="list-group-item"><strong>Trọng lượng:</strong> <?= $don['trong_luong'] ?>
                                        gram</li>
                                    <li class="list-group-item"><strong>Người gửi:</strong> <?= $don['ten_nguoi_gui'] ?>
                                        (<?= $don['sdt_nguoi_gui'] ?>)</li>
                                    <li class="list-group-item"><strong>Địa chỉ gửi:</strong>
                                        <?= $don['dia_chi_nguoi_gui'] ?> - <?= $don['dia_chi_nguoi_gui_mac_dinh'] ?>
                                    </li>
                                    <li class="list-group-item"><strong>Người nhận:</strong>
                                        <?= $don['ten_nguoi_nhan'] ?> (<?= $don['sdt_nguoi_nhan'] ?>)</li>
                                    <li class="list-group-item"><strong>Địa chỉ nhận:</strong>
                                        <?= $don['dia_chi_nguoi_nhan'] ?> - <?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?>
                                    </li>
                                    <li class="list-group-item"><strong>Thu hộ:</strong>
                                        <?= number_format($don['thu_ho']) ?>đ</li>
                                    <li class="list-group-item"><strong>Phí vận chuyển:</strong>
                                        <?= number_format($don['phi_van_chuyen']) ?>đ</li>
                                    <li class="list-group-item"><strong>Người trả phí:</strong>
                                        <?= $don['nguoi_tra_phi'] ?></li>
                                    <li class="list-group-item"><strong>Trạng thái:</strong> <?= $don['trang_thai'] ?>
                                    </li>
                                    <li class="list-group-item"><strong>Ngày tạo:</strong> <?= $don['ngay_tao'] ?></li>
                                    <li class="list-group-item"><strong>Thời gian hẹn lấy:</strong>
                                        <?= $don['thoi_gian_hen_lay'] ?></li>
                                    <li class="list-group-item"><strong>Ngày giao dự kiến:</strong>
                                        <?= $don['ngay_giao_du_kien'] ?></li>
                                    <li class="list-group-item"><strong>Ghi chú:</strong> <?= $don['ghi_chu'] ?></li>
                                </ul>
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
    </div>
</body>

</html>