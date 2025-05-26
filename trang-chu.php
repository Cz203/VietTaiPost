<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Khách hàng</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-dashboard {
            text-align: center;
            padding: 15px 8px;         /* giảm padding */
            border-radius: 12px;       /* bo góc nhỏ hơn */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .card-dashboard:hover {
            transform: translateY(-3px);  /* hiệu ứng nhỏ hơn */
        }

        .card-dashboard i {
            font-size: 1.4rem;         /* icon nhỏ hơn */
            margin-bottom: 6px;        /* giảm margin */
        }

        .card-title {
            font-size: 0.85rem;        /* tiêu đề nhỏ hơn */
            font-weight: 600;
            margin-bottom: 3px;
        }

        .card-number {
            font-size: 1.3rem;         /* số liệu nhỏ hơn */
            font-weight: bold;
        }

        .main-content {
            flex: 1;
        }

        h3 {
            font-weight: 700;
        }
    </style>
</head>

<?php
require_once 'controller/cls-khachhang.php';
$kh = new clsKhachhang();
session_start();

$ma_khach_hang = $_SESSION['id'] ?? null;
if (!$ma_khach_hang) {
    header('Location: login.php');
    exit;
}

$tong_don_hang = $kh->layTongSoDonHang($ma_khach_hang);
$tong_don_cho_xu_ly = $kh->layTongSoDonTheoTrangThai($ma_khach_hang, 'Chờ xử lý');
$tong_don_da_giao = $kh->layTongSoDonTheoTrangThai($ma_khach_hang, 'Đã giao thành công');
$tong_phi_van_chuyen = $kh->layTongPhiVanChuyen($ma_khach_hang);
$tong_cod = $kh->layTongCOD($ma_khach_hang);

$trang_thais = [
    'Chờ xử lý',
    'Chờ shipper tới lấy',
    'Đã lấy hàng',
    'Đang giao',
    'Đã giao',
    'Hủy'
];
$thong_ke_trang_thai = [];
foreach ($trang_thais as $trang_thai) {
    $thong_ke_trang_thai[$trang_thai] = $kh->laySoDonTheoTrangThai($ma_khach_hang, $trang_thai);
}

?>
    <script type="text/javascript">
        // Load thư viện chart
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Dữ liệu cho pie chart
            var data = google.visualization.arrayToDataTable([
                ['Trạng thái', 'Số lượng'],
                <?php
                foreach ($thong_ke_trang_thai as $trang_thai => $so_luong) {
                   echo "['$trang_thai', " . (int)$so_luong . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Thống kê đơn hàng theo trạng thái',
                pieHole: 0.4,  // Biểu đồ donut, bỏ nếu không muốn
                slices: {
                    0: { color: '#f1c40f' }, // vàng cho chờ xử lý
                    1: { color: '#3498db' }, // xanh dương cho chờ shipper tới lấy
                    2: { color: '#2ecc71' }, // xanh lá cho đã lấy hàng
                    3: { color: '#e67e22' }, // cam cho đang giao
                    4: { color: '#27ae60' }, // xanh đậm cho đã giao
                    5: { color: '#e74c3c' }  // đỏ cho hủy
                },
                legend: { position: 'right', alignment: 'center' },
                chartArea: { width: '70%', height: '70%' }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
<body class="d-flex">
    <?php require_once 'view/sidebar.php'; ?>

    <div class="main-content">
        <?php require_once 'view/header.php'; ?>

        <div class="container px-4 pb-4 card border rounded-4 mt-5 pt-4">
            <h3 class="mb-4">📊 Thống kê đơn hàng của bạn</h3>

            <div class="row g-4">
                <div class="col-md-2">
                    <div class="card-dashboard bg-primary text-white">
                        <i class="fas fa-shopping-cart"></i>
                        <div class="card-title">Tổng số đơn hàng</div>
                        <div class="card-number"><?= $tong_don_hang ?></div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-dashboard bg-warning text-dark">
                        <i class="fas fa-hourglass-half"></i>
                        <div class="card-title">Đơn chờ xử lý</div>
                        <div class="card-number"><?= $tong_don_cho_xu_ly ?></div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-dashboard bg-success text-white">
                        <i class="fas fa-check-circle"></i>
                        <div class="card-title">Đã giao thành công</div>
                        <div class="card-number"><?= $tong_don_da_giao ?></div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card-dashboard bg-info text-white">
                        <i class="fas fa-truck"></i>
                        <div class="card-title">Tổng phí vận chuyển</div>
                        <div class="card-number"><?= number_format($tong_phi_van_chuyen) ?> đ</div>
                    </div>
                </div>
                <div class="col-md-2">
                <div class="card-dashboard bg-danger text-white">
                    <i class="fas fa-money-bill-wave"></i>
                    <div class="card-title">Tổng COD (Thu hộ)</div>
                    <div class="card-number"><?= number_format($tong_cod) ?> đ</div>
                </div>
            </div>
            </div>
        </div>

        <div class="container px-4 pb-4 card border rounded-4 mt-5 pt-4">
            <div id="piechart" style="width: 100%; max-width: 700px; height: 400px; "></div>
        </div>
    </div>
</body>

</html>
