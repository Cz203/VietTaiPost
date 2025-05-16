<?php
require_once '../controller/cls-admin.php';
$admin = new clsAdmin();

$buuCucs = $admin->getTatCaBuuCuc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Quản lý bưu cục</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../asset/css/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="d-flex">
    <?php require_once 'view/sidebar.php'; ?>

    <div class="main-content">
        <?php require_once 'view/header.php'; ?>

        <div class="container py-4">
            <h3 class="mb-4">Quản lý bưu cục</h3>

            <div class="row">
                <!-- Danh sách bưu cục -->
                <div class="col-md-4">
                    <h5>Danh sách bưu cục</h5>
                    <div style="max-height: 500px; overflow-y: auto;">
                        <ul class="list-group">
                            <?php foreach ($buuCucs as $buuCuc): ?>
                                <li class="list-group-item">
                                    <strong><?= htmlspecialchars($buuCuc['ten_buu_cuc']) ?></strong><br>
                                    <?= htmlspecialchars($buuCuc['dia_chi'] . ', ' . $buuCuc['xa_huyen_tinh']) ?><br>
                                    📞 <?= htmlspecialchars($buuCuc['so_dien_thoai'] ?? 'Không có') ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Bản đồ bưu cục -->
                <div class="col-md-8">
                    <h5>Bản đồ bưu cục</h5>
                    <div id="map" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Khởi tạo bản đồ Leaflet
    var map = L.map('map').setView([10.75, 106.7], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var markers = [];

    <?php foreach ($buuCucs as $row): ?>
        var marker = L.marker([<?= $row['vi_do'] ?>, <?= $row['kinh_do'] ?>])
            .bindPopup(`<strong><?= addslashes(htmlspecialchars($row['ten_buu_cuc'])) ?></strong><br>
                <?= addslashes(htmlspecialchars($row['dia_chi'] . ', ' . $row['xa_huyen_tinh'])) ?><br>
                📞 <?= addslashes(htmlspecialchars($row['so_dien_thoai'] ?? 'Không có')) ?>`);
        marker.addTo(map);
        markers.push(marker);
    <?php endforeach; ?>

    if (markers.length > 0) {
        var group = L.featureGroup(markers);
        map.fitBounds(group.getBounds());
    }
</script>
</body>
</html>
