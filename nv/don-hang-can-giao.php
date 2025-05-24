<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đon hàng cần giao</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>

</head>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['shipper'])) {
    header("Location: login.php");
    exit();
}

$shipper = $_SESSION['shipper'];
?>

<?php 

require_once '../controller/cls-shipper.php';
$donhang = new clsShipper();
$tat_ca_don_hang = $donhang->layTatCaDonHangTrongBuuCuu($shipper['id_buu_cuc']);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hanh_dong'], $_POST['ma_don'])) 
{
    $ma_don = $_POST['ma_don'];
    $hanh_dong = $_POST['hanh_dong'];

    if ($hanh_dong === 'lay_don_hang') 
    {
        $donhang->capNhatTrangThaiDon($ma_don, 'Lấy đơn hàng', $shipper['id'], $shipper['id_buu_cuc'], 'Đơn hàng đang được giao tới bạn');
        echo "<script>alert('Đã xác nhận lấy đơn hàng.');</script>";
        header("Location: don-hang-can-giao.php");
        exit();
    } 
    elseif ($hanh_dong === 'huy' && !empty($_POST['ly_do'])) 
    {
        $ly_do = $_POST['ly_do'];
        $donhang->capNhatTrangThaiDon($ma_don, 'hủy', $shipper['id'], $shipper['id_buu_cuc'], 'Đơn hàng đã bị hủy vì: ' . $ly_do);
        echo "<script>alert('Đã hủy đơn hàng.');</script>";
        header("Location: don-hang-can-giao.php");
        exit();
    }
    elseif ($hanh_dong === 'tra_ve_buu_cuc') 
    {
        $donhang->capNhatTrangThaiDon($ma_don, 'trả về bưu cục', $shipper['id'], $shipper['id_buu_cuc'], 'Đơn hàng đang được giao tới bạn');
        echo "<script>alert('Đã trả về bưu cục.');</script>";
        header("Location: don-hang-can-giao.php");
        exit();
    }
    elseif ($hanh_dong === 'giao_thanh-cong') 
    {
        $donhang->capNhatTrangThaiDon($ma_don, 'giao thành công', $shipper['id'], $shipper['id_buu_cuc'], 'Đơn hàng của bạn đã được giao ');
        echo "<script>alert('Xác nhận giao thành công.');</script>";
        header("Location: don-hang-can-giao.php");
        exit();
    }
}

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
        <h3 class="mt-4">Danh sách đơn hàng được giao trong bưu cục của bạn </h3>
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-light">
                <tr>
                    <th>Mã ĐH</th>
                    <th>Tên ĐH</th>
                    <th>Người gửi</th>
                    <th>Người nhận</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tat_ca_don_hang as $don) : ?>
                
                <tr> 
                    <td><?= $don['ma_don_hang'] ?></td>
                    <td><?= $don['ten_don_hang'] ?></td>
                    <td><?= $don['ten_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui_mac_dinh'] ?></td>
                    <td><?= $don['ten_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?></td>
                    <td><?= $don['trang_thai'] ?></td>
                    <td>
                        <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modal<?= $don['ma_don_hang'] ?>">
                            Chi tiết
                        </button>
        
                        <!-- Tuy chon huy va xac nhan lay hang -->
                        <div class="btn-group m-1">

                            <form method="post" class="d-inline">
                                <input type="hidden" name="ma_don" value="<?= $don['ma_don_hang'] ?>">
                                <input type="hidden" name="hanh_dong" value="lay_don_hang">
                                <button type="submit" class="btn btn-warning ">Lấy đơn hàng</button>
                            </form>
                        </div>

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
            </tbody>
        </table>
</div>

<?php 
$tat_ca_don_hang_di_giao = $donhang->layTatCaDonHangCuaBan($shipper['id']);
?>
<div class="container px-4 pb-5 card border rounded-4 mt-5">
        <h3 class="mt-4">Danh sách đơn hàng cần đi giao </h3>
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-light">
                <tr>
                    <th>Mã ĐH</th>
                    <th>Tên ĐH</th>
                    <th>Người gửi</th>
                    <th>Người nhận</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tat_ca_don_hang_di_giao as $don) : ?>
                
                <tr> 
                    <td><?= $don['ma_don_hang'] ?></td>
                    <td><?= $don['ten_don_hang'] ?></td>
                    <td><?= $don['ten_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui_mac_dinh'] ?></td>
                    <td><?= $don['ten_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?></td>
                    <td><?= $don['trang_thai'] ?></td>
                    <td>
                        <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modal<?= $don['ma_don_hang'] ?>">
                            Chi tiết
                        </button>
        
                        <!-- Tuy chon huy va xac nhan lay hang -->
                         <?php
                            $lat_shipper = $shipper['vi_do'];//demo sẽ lấy vi do theo gps
                            $lng_shipper = $shipper['kinh_do'];//demo sẽ lấy kinh do theo gps
                            $lat_don = $don['lat_nguoi_nhan'];
                            $lng_don = $don['lng_nguoi_nhan'];
                            $url_google_maps = "https://www.google.com/maps/dir/$lat_shipper,$lng_shipper/$lat_don,$lng_don";
                        ?>
                         </button>
                       <a href="<?= $url_google_maps ?>" target="_blank" class="btn btn-success m-1">
                            Chỉ đường
                        </a>
                        <div class="btn-group m-1">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Tùy chọn
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="ma_don" value="<?= $don['ma_don_hang'] ?>">
                                        <input type="hidden" name="hanh_dong" value="giao_thanh-cong">
                                        <button type="submit" class="dropdown-item">Xác nhận đã giao thành công</button>
                                    </form>
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalHuy<?= $don['ma_don_hang'] ?>">
                                        Hủy đơn hàng
                                    </button>
                                </li>
                                <li>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="ma_don" value="<?= $don['ma_don_hang'] ?>">
                                        <input type="hidden" name="hanh_dong" value="tra_ve_buu_cuc">
                                        <button type="submit" class="dropdown-item text-primary">Trả về bưu cục</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="modal fade" id="modalHuy<?= $don['ma_don_hang'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <form method="post" class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hủy đơn hàng #<?= $don['ma_don_hang'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ma_don" value="<?= $don['ma_don_hang'] ?>">
                                        <input type="hidden" name="hanh_dong" value="huy">
                                        <div class="mb-3">
                                            <label for="ly_do_huy<?= $don['ma_don_hang'] ?>" class="form-label">Lý do hủy:</label>
                                            <textarea class="form-control" name="ly_do" id="ly_do_huy<?= $don['ma_don_hang'] ?>" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </form>
                            </div>
                        </div>

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
            </tbody>
        </table>
</div>
</body>
</html>



