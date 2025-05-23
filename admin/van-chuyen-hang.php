
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Vận đơn hàng</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<?php 
require_once '../controller/cls-admin.php';
$admin = new clsAdmin();
$tat_ca_don_hang_trong_xe = $admin->layTatCaDonHangTrongXe();
$danh_sach_buu_cuc = $admin->lay_danh_sach_buu_cuc();

$id_buu_cuc_chon = isset($_GET['buu_cuc']) && $_GET['buu_cuc'] !== '' ? $_GET['buu_cuc'] : null;
$tat_ca_don_hang_theo_bc = [];

if ($id_buu_cuc_chon !== null) 
{
    $tat_ca_don_hang_theo_bc = $admin->lay_don_hang_theo_buu_cuc($id_buu_cuc_chon);
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ma_don_hang']) && isset($_POST['action'])) {
        if ($_POST['action'] === 'lay_hang_len_xe') {
            if ($admin->layHangLenXe($_POST['ma_don_hang'])) 
            {
                $id_buu_cuc = $_POST['id_buu_cuc'] ?? '';
                header("Location: van-chuyen-hang.php?buu_cuc=$id_buu_cuc");
                exit();
            }
        } elseif ($_POST['action'] === 'tra_ve_buu_cuc') {
            if ($admin->traHangVeBuuCuc($_POST['ma_don_hang'], $_POST['id_buu_cuc'])) 
            {
                $id_buu_cuc = $_POST['id_buu_cuc'] ?? '';
                header("Location: van-chuyen-hang.php?buu_cuc=$id_buu_cuc");
                exit();
            }
        }
    }
}
?>
<body  class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    ?>
    
    <div class="main-content">

    <?php
    require_once 'view/header.php';
    ?>
<div class="container pb-5 mt-5">
    <div class="row">
        <div class="col-md-6 pb-5 card border rounded-4">
            <h3 class="mt-4">Hàng trong xe</h3>
                <?php foreach ($tat_ca_don_hang_trong_xe as $don): ?>
                <div class="border rounded p-3 mb-3">
                    <!-- Dòng trên: Mã, tên đơn hàng, trạng thái, nút -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>Mã ĐH: </strong><?= $don['ma_don_hang'] ?> <br>
                        </div>
                        <div>
                            <strong>Tên ĐH:</strong> <?= $don['ten_don_hang'] ?>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $don['ma_don_hang'] ?>">
                            Chi tiết
                        </button>
                        <?php if (!empty($_GET['buu_cuc'])): ?>
                        <form method="POST" action="" class="d-inline">
                            <input type="hidden" name="ma_don_hang" value="<?= $don['ma_don_hang'] ?>">
                            <input type="hidden" name="id_buu_cuc" value="<?= $_GET['buu_cuc'] ?>">
                            <input type="hidden" name="action" value="tra_ve_buu_cuc">
                            <button type="submit" class="btn btn-warning btn-sm">Trả về bưu cục</button>
                        </form>
                        <?php else: ?>
                        <button class="btn btn-light btn-sm" disabled title="Vui lòng chọn bưu cục để trả hàng">Trả về bưu cục</button>
                        <?php endif; ?>
                    </div>

                    <!-- Dòng dưới: Người gửi - người nhận -->
                    <div class="row small">
                        <div class="col">
                            <strong>Người gửi:</strong> <br>
                            <?= $don['ten_nguoi_gui'] ?> 
                            <?= $don['dia_chi_nguoi_gui'] ?> <br>
                            <?= $don['dia_chi_nguoi_gui_mac_dinh'] ?>
                        </div>
                        <div class="col">
                            <strong>Người nhận:</strong> <br>
                            <?= $don['ten_nguoi_nhan'] ?> 
                            <?= $don['dia_chi_nguoi_nhan'] ?> <br>
                            <?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?>
                        </div>
                    </div>
                </div>
                


                <!-- Modal -->
                <div class="modal fade" id="modal<?= $don['ma_don_hang'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $don['ma_don_hang'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?= $don['ma_don_hang'] ?>">Chi tiết đơn hàng <?= $don['ma_don_hang'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class = "col-md">
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
                                </div>     
                            </div>

                            

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
        <div class="col-md-6 card border rounded-4">
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <h3 class="mb-0">Hàng ở bưu cục cần di chuyển</h3>
                <form method="GET" action="" class="d-flex align-items-center">
                    <select name="buu_cuc" class="form-select form-select-sm me-2"  onchange="this.form.submit()">
                        <option value="">-- Chọn bưu cục --</option>
                        <?php foreach ($danh_sach_buu_cuc as $buu_cuc): ?>
                            <option value="<?= $buu_cuc['id'] ?>" <?= isset($_GET['buu_cuc']) && $_GET['buu_cuc'] == $buu_cuc['id'] ? 'selected' : '' ?>>
                                <?= $buu_cuc['ten_buu_cuc'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <tbody>
                <?php foreach ($tat_ca_don_hang_theo_bc as $don): ?>
                <div class="border rounded p-3 mb-3">
                    <!-- Dòng trên: Mã, tên đơn hàng, trạng thái, nút -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>Mã ĐH: </strong><?= $don['ma_don_hang'] ?> <br>
                        </div>
                        <div>
                            <strong>Tên ĐH:</strong> <?= $don['ten_don_hang'] ?>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $don['ma_don_hang'] ?>">
                            Chi tiết
                        </button>
                        <form method="POST" action="" class="d-inline">
                            <input type="hidden" name="ma_don_hang" value="<?= $don['ma_don_hang'] ?>">
                            <input type="hidden" name="action" value="lay_hang_len_xe">
                            <input type="hidden" name="id_buu_cuc" value="<?= $id_buu_cuc_chon ?>">
                            <button type="submit" class="btn btn-success btn-sm ">Lấy hàng lên xe</button>
                        </form>
                    </div>

                    <!-- Dòng dưới: Người gửi - người nhận -->
                    <div class="row small">
                        <div class="col">
                            <strong>Người gửi:</strong> <br>
                            <?= $don['ten_nguoi_gui'] ?> 
                            <?= $don['dia_chi_nguoi_gui'] ?> <br>
                            <?= $don['dia_chi_nguoi_gui_mac_dinh'] ?>
                        </div>
                        <div class="col">
                            <strong>Người nhận:</strong> <br>
                            <?= $don['ten_nguoi_nhan'] ?> 
                            <?= $don['dia_chi_nguoi_nhan'] ?> <br>
                            <?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal<?= $don['ma_don_hang'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $don['ma_don_hang'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?= $don['ma_don_hang'] ?>">Chi tiết đơn hàng <?= $don['ma_don_hang'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class = "col-md">
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
                                </div>     
                            </div>

                            

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>


