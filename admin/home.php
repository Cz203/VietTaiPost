<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body  class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    ?>
    
    <div class="main-content">

    <?php
    require_once 'view/header.php';
    ?>
<div class="container px-4 pb-5">
<?php
require_once '../controller/cls-admin.php';
$admin = new clsAdmin();
$tat_ca_don_hang = $admin->layTatCaDonHang();

$thong_ke = [
    'chờ lấy' => 0,
    'đã lấy' => 0,
    'đang giao' => 0,
    'giao thành công' => 0,
    'hủy' => 0,
    'khác' => 0
];

foreach ($tat_ca_don_hang as $don) {
    $trang_thai = strtolower(trim($don['trang_thai']));
    switch ($trang_thai) {
        case 'chờ shipper tới lấy':
        case 'đợi lấy hàng':
            $thong_ke['chờ lấy']++;
            break;
        case 'đã lấy hàng':
            $thong_ke['đã lấy']++;
            break;
        case 'ở bưu cục':
        case 'đang giao':
        case 'trong xe':
            $thong_ke['đang giao']++;
            break;
        case 'đã giao':
            $thong_ke['giao thành công']++;
            break;
        case 'hủy':
            $thong_ke['hủy']++;
            break;
        default:
            $thong_ke['khác']++;
    }
}

$ngay_tao_thong_ke = [];
$thang_tao_thong_ke = [];

foreach ($tat_ca_don_hang as $don) {
    $trang_thai = strtolower(trim($don['trang_thai']));
    // Cập nhật $thong_ke như hiện tại (không thay đổi)

    // Thống kê theo ngày
    $ngay = date('Y-m-d', strtotime($don['ngay_tao']));
    if (!isset($ngay_tao_thong_ke[$ngay])) {
        $ngay_tao_thong_ke[$ngay] = 0;
    }
    $ngay_tao_thong_ke[$ngay]++;

    // Thống kê theo tháng
    $thang = date('Y-m', strtotime($don['ngay_tao']));
    if (!isset($thang_tao_thong_ke[$thang])) {
        $thang_tao_thong_ke[$thang] = 0;
    }
    $thang_tao_thong_ke[$thang]++;
}

ksort($ngay_tao_thong_ke);
ksort($thang_tao_thong_ke);
$tong_doanh_thu = $admin->layTongDoanhThuPhiVanChuyen();

?>

<div class="container px-4 pb-1 card border rounded-4 mt-5 pt-4">
 <h2 class="mb-4">Dashboard Thống kê Đơn hàng</h2>
    <div class="card-body">
            <h6 class="card-title text-success">Doanh thu vận chuyển</h6>
            <h4 class="text-success"><?= number_format($tong_doanh_thu, 0, ',', '.') ?> đ</h4>
        </div>
    <div class="row mb-4">
        <?php foreach ($thong_ke as $label => $value): ?>
        <div class="col-md-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted"><?= ucfirst($label) ?></h6>
                    <h4 class="text-primary"><?= $value ?></h4>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>
   
    <!-- <div class="row">
        <div class="col-md-6">
            <div class="card p-3 mb-3">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 mb-3">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div> -->
    <label for="timeFilter">Chọn thống kê theo:</label>
    <select id="timeFilter" class="form-select w-auto mb-3">
        <option value="day" selected>Theo ngày</option>
        <option value="month">Theo tháng</option>
    </select>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-3 mb-3">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 mb-3">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    
    
<script>
const pieChartCtx = document.getElementById('pieChart').getContext('2d');
const barChartCtx = document.getElementById('barChart').getContext('2d');

const pieData = {
    labels: <?= json_encode(array_keys($thong_ke)) ?>,
    datasets: [{
        data: <?= json_encode(array_values($thong_ke)) ?>,
        backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#28c76f', '#dc3545', '#6c757d'],
    }]
};

const dataDayLabels = <?= json_encode(array_keys($ngay_tao_thong_ke)) ?>;
const dataDayValues = <?= json_encode(array_values($ngay_tao_thong_ke)) ?>;

const dataMonthLabels = <?= json_encode(array_keys($thang_tao_thong_ke)) ?>;
const dataMonthValues = <?= json_encode(array_values($thang_tao_thong_ke)) ?>;

let pieChart;
let barChart;

function renderPieChart() {
    if(pieChart) pieChart.destroy();

    pieChart = new Chart(pieChartCtx, {
        type: 'pie',
        data: pieData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
}

function renderBarChart(type = 'day') {
    let labels, data;
    if(type === 'month') {
        labels = dataMonthLabels;
        data = dataMonthValues;
    } else {
        labels = dataDayLabels;
        data = dataDayValues;
    }

    if(barChart) {
        barChart.destroy();
    }

    barChart = new Chart(barChartCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: `Số đơn theo ${type === 'month' ? 'tháng' : 'ngày'}`,
                data: data,
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

// Khởi tạo 2 biểu đồ
renderPieChart();
renderBarChart('day');

document.getElementById('timeFilter').addEventListener('change', (e) => {
    renderBarChart(e.target.value);
});
</script>



</div>


</body>
</html>

