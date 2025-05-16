<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tra cứu bưu cục</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<?php 

require_once 'controller/cls-khachhang.php';
$kh = new clsKhachhang();

$search= $_GET['search'] ?? '';
if (!empty($search)) {
    $buuCucs = $kh->getBuuCucTheoTimKiem($search);
} else {
    $buuCucs = $kh->getTatCaBuuCuc();
}


?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<body  class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    ?>
    
    <div class="main-content">

    <?php
    require_once 'view/header.php';
    ?>
<div class="container-fluid px-4 pb-5">
    <h4 class="mt-3 mb-3">Bản đồ bưu cục</h4>
    <div class="row">
        
        <!-- Cột trái: Danh sách bưu cục cuộn -->
        <div class="col-md-4">
            <form method="GET" action="">
            <div class="mb-3 input-group">
                <input type="text" class="form-control" id="search" name="search" 
                placeholder="VD: Hồ Chí Minh" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit" class="btn btn-primary">Tìm</button>
            </div>
            </form>

            <div class="list-group" style="height: 550px; overflow-y: auto;">
                <?php foreach ($buuCucs as $buuCuc): ?>
                    <div class="list-group-item">
                        <h6 class="mb-1"><?= htmlspecialchars($buuCuc['ten_buu_cuc']) ?></h6>
                        <small><?= htmlspecialchars($buuCuc['dia_chi']) ?>, <?= htmlspecialchars($buuCuc['xa_huyen_tinh']) ?></small><br>
                        <span class="text-muted">📞 <?= $buuCuc['so_dien_thoai'] ?? 'Không có' ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Cột phải: Bản đồ -->
        <div class="col-md-8">
            <div id="map" style="height: 600px;"></div>
        </div>
    </div>
</div>

<script>
    var map = L.map('map').setView([10.77584, 106.700806], 13); 

    // Thêm tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tạo mảng lưu marker
    var markers = [];

    <?php foreach($buuCucs as $row): ?>
        var marker = L.marker([<?= $row['vi_do'] ?>, <?= $row['kinh_do'] ?>])
            .bindPopup(`<?= addslashes(htmlspecialchars($row['ten_buu_cuc'])) ?>`);
        marker.addTo(map);
        markers.push(marker);
    <?php endforeach; ?>

    // Tạo nhóm marker và zoom vừa đủ chứa tất cả
    var group = L.featureGroup(markers);
    map.fitBounds(group.getBounds());
</script>

<script>
<?php foreach($buuCucs as $row): ?>
    L.marker([<?= $row['vi_do'] ?>, <?= $row['kinh_do'] ?>]).addTo(map)
        .bindPopup(`<?= addslashes('<strong>' . htmlspecialchars($row['ten_buu_cuc']) 
        . '</strong><hr>
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>' . htmlspecialchars($row['dia_chi']) 
        . '<br><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
        ' . htmlspecialchars($row['xa_huyen_tinh']) 
        . '<br><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>' 
        . ($row['so_dien_thoai'] ?? 'Không có')) ?>`);
<?php endforeach; ?>
</script>

</body>
</html>


