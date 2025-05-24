<?php
require_once '../controller/cls-admin.php';
$admin = new clsAdmin();

// Tìm kiếm
$search = $_GET['search'] ?? '';
if ($search !== '') {
    $shippers = $admin->timShipper($search); // bạn cần viết hàm này
} else {
    $shippers = $admin->getTatCaShipper(); // bạn cần viết hàm này
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý shipper</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../asset/css/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="d-flex">
    <?php require_once 'view/sidebar.php'; ?>

    <div class="main-content">
        <?php require_once 'view/header.php'; ?>

        <div class="container py-4 card border rounded-4 p-3">
            <h3 class="mb-4">Vị trí các shipper</h3>

            <div class="row">
                <!-- Danh sách shipper -->
                <div class="col-md-4">
                    <h5>Danh sách shipper</h5>
                    <form method="get" class="mb-3 d-flex">
                        <input type="text" class="form-control me-2" name="search" placeholder="VD: Nguyễn Văn A"
                            value="<?= htmlspecialchars($search) ?>">
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>
                    <div style="max-height: 500px; overflow-y: auto;">
                        <ul class="list-group">
                            <?php foreach ($shippers as $shipper): ?>
                            <li class="list-group-item">
                                <strong><?= htmlspecialchars($shipper['ho_ten']) ?></strong><br>
                                📞 <?= htmlspecialchars($shipper['so_dien_thoai']) ?><br>
                                🏢 <?= htmlspecialchars($shipper['ten_buu_cuc'] ?? 'Chưa có bưu cục') ?><br>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Bản đồ -->
                <div class="col-md-8">
                    <h5>Bản đồ vị trí shipper</h5>
                    <div id="map" style="height: 550px;" class="shadow-sm"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
    var map = L.map('map').setView([10.75, 106.7], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Tạo icon hình shipper
    var shipperIcon = L.icon({
        iconUrl: '../asset/img/iconshipper.png', // thay bằng ảnh icon PNG thật sự
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    var markers = [];
    var markerMap = {}; // Thêm object để lưu trữ marker theo ID

    <?php foreach ($shippers as $s): ?>
    var marker = L.marker([<?= $s['vi_do'] ?>, <?= $s['kinh_do'] ?>], {
            icon: shipperIcon
        })
        .bindPopup(`<strong><?= addslashes(htmlspecialchars($s['ho_ten'])) ?></strong><br>
                📞 <?= addslashes(htmlspecialchars($s['so_dien_thoai'])) ?><br>
                🏢 Thuộc <?= htmlspecialchars($s['ten_buu_cuc'] ?? 'Chưa có bưu cục') ?>`);
    marker.addTo(map);
    markers.push(marker);
    markerMap[<?= $s['id'] ?>] = marker; // Lưu marker theo ID
    <?php endforeach; ?>

    if (markers.length > 0) {
        var group = L.featureGroup(markers);
        map.fitBounds(group.getBounds());
    }

    // Kết nối WebSocket
    const ws = new WebSocket('ws://localhost:8080');

    ws.onmessage = function(event) {
        const data = JSON.parse(event.data);
        const {
            id,
            vi_do,
            kinh_do
        } = data;

        // Cập nhật vị trí marker trực tiếp từ markerMap
        if (markerMap[id]) {
            markerMap[id].setLatLng([vi_do, kinh_do]);
        }
    };

    ws.onerror = function(error) {
        console.error('WebSocket error:', error);
    };

    ws.onclose = function() {
        console.log('WebSocket connection closed');
    };
    </script>

</body>

</html>