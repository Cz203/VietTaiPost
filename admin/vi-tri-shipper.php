<?php
require_once '../controller/cls-admin.php';
$admin = new clsAdmin();

// Tìm kiếm
$search = $_GET['search'] ?? '';
if ($search !== '') {
    $shippers = $admin->timShipper($search);
} else {
    $shippers = $admin->getTatCaShipper();
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
    <style>
    .status-badge {
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
    }

    .status-active {
        background-color: #28a745;
        color: white;
    }

    .status-inactive {
        background-color: #dc3545;
        color: white;
    }

    .last-update {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
    </style>
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
                        <ul class="list-group" id="shipperList">
                            <?php foreach ($shippers as $shipper): ?>
                            <li class="list-group-item" data-shipper-id="<?= $shipper['id'] ?>" style="cursor: pointer;"
                                onclick="zoomToShipper(<?= $shipper['id'] ?>)">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong><?= htmlspecialchars($shipper['ho_ten']) ?></strong><br>
                                        📞 <?= htmlspecialchars($shipper['so_dien_thoai']) ?><br>
                                        🏢 <?= htmlspecialchars($shipper['ten_buu_cuc'] ?? 'Chưa có bưu cục') ?>
                                    </div>

                                    <span class="status-badge">
                                        <?= htmlspecialchars($shipper['trang_thai']) ?>
                                    </span>
                                </div>
                                <div class="last-update">Cập nhật: <span class="update-time"><?= date('H:i:s') ?></span>
                                </div>
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
        iconUrl: '../asset/img/iconshipper.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    // Tạo icon cho shipper không hoạt động
    var inactiveShipperIcon = L.icon({
        iconUrl: '../asset/img/shipperoff.png', // Bạn cần tạo icon này với màu xám
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    var markers = [];
    var markerMap = {};

    function updateShipperStatus() {
        fetch('get-shipper-status.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    data.shippers.forEach(shipper => {
                        // Cập nhật trạng thái trong danh sách
                        const listItem = document.querySelector(`[data-shipper-id="${shipper.id}"]`);
                        if (listItem) {
                            const statusBadge = listItem.querySelector('.status-badge');
                            const updateTime = listItem.querySelector('.update-time');

                            statusBadge.className =
                                `status-badge ${shipper.trang_thai === 'Đang hoạt động' ? 'status-active' : 'status-inactive'}`;
                            statusBadge.textContent = shipper.trang_thai;
                            updateTime.textContent = new Date().toLocaleTimeString();

                            // Cập nhật marker trên bản đồ
                            if (shipper.vi_do && shipper.kinh_do) {
                                if (markerMap[shipper.id]) {
                                    // Cập nhật vị trí và icon của marker
                                    markerMap[shipper.id].setLatLng([shipper.vi_do, shipper.kinh_do]);
                                    markerMap[shipper.id].setIcon(shipper.trang_thai === 'Đang hoạt động' ?
                                        shipperIcon : inactiveShipperIcon);

                                    // Cập nhật popup content
                                    markerMap[shipper.id].setPopupContent(
                                        `<strong>${shipper.ho_ten}</strong><br>
                                        📞 ${shipper.so_dien_thoai}<br>
                                        🏢 Thuộc ${shipper.ten_buu_cuc || 'Chưa có bưu cục'}<br>
                                        <span class="status-badge ${shipper.trang_thai === 'Đang hoạt động' ? 'status-active' : 'status-inactive'}">${shipper.trang_thai}</span>`
                                    );
                                } else {
                                    // Tạo marker mới nếu chưa có
                                    const marker = L.marker([shipper.vi_do, shipper.kinh_do], {
                                        icon: shipper.trang_thai === 'Đang hoạt động' ?
                                            shipperIcon : inactiveShipperIcon
                                    }).bindPopup(
                                        `<strong>${shipper.ho_ten}</strong><br>
                                        📞 ${shipper.so_dien_thoai}<br>
                                        🏢 Thuộc ${shipper.ten_buu_cuc || 'Chưa có bưu cục'}<br>
                                        <span class="status-badge ${shipper.trang_thai === 'Đang hoạt động' ? 'status-active' : 'status-inactive'}">${shipper.trang_thai}</span>`
                                    );
                                    marker.addTo(map);
                                    markers.push(marker);
                                    markerMap[shipper.id] = marker;
                                }
                            }
                        }
                    });

                    // Cập nhật view của bản đồ
                    if (markers.length > 0) {
                        const group = L.featureGroup(markers);
                        map.fitBounds(group.getBounds());
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching shipper status:', error);
            });
    }

    // Khởi tạo markers ban đầu
    <?php foreach ($shippers as $s): ?>
    <?php if ($s['vi_do'] && $s['kinh_do']): ?>
    var marker = L.marker([<?= $s['vi_do'] ?>, <?= $s['kinh_do'] ?>], {
            icon: <?= $s['trang_thai'] === 'Đang hoạt động' ? 'shipperIcon' : 'inactiveShipperIcon' ?>
        })
        .bindPopup(
            `<strong><?= addslashes(htmlspecialchars($s['ho_ten'])) ?></strong><br>
                    📞 <?= addslashes(htmlspecialchars($s['so_dien_thoai'])) ?><br>
                    🏢 Thuộc <?= htmlspecialchars($s['ten_buu_cuc'] ?? 'Chưa có bưu cục') ?><br>
                    <span class="status-badge <?= $s['trang_thai'] === 'Đang hoạt động' ? 'status-active' : 'status-inactive' ?>"><?= htmlspecialchars($s['trang_thai']) ?></span>`
        );
    marker.addTo(map);
    markers.push(marker);
    markerMap[<?= $s['id'] ?>] = marker;
    <?php endif; ?>
    <?php endforeach; ?>

    if (markers.length > 0) {
        var group = L.featureGroup(markers);
        map.fitBounds(group.getBounds());
    }

    // Cập nhật trạng thái mỗi 5 giây
    setInterval(updateShipperStatus, 5000);
    // Cập nhật ngay lần đầu tiên
    updateShipperStatus();

    // Kết nối WebSocket
    const ws = new WebSocket('ws://localhost:8080');

    ws.onmessage = function(event) {
        const data = JSON.parse(event.data);
        const {
            id,
            vi_do,
            kinh_do
        } = data;

        // Chỉ cập nhật vị trí nếu shipper đang hoạt động
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

    function zoomToShipper(shipperId) {
        const marker = markerMap[shipperId];
        if (marker) {
            const latlng = marker.getLatLng();
            map.setView(latlng, 15);
            marker.openPopup();
        }
    }
    </script>

</body>

</html>