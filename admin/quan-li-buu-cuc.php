<?php
require_once '../controller/cls-admin.php';
$admin = new clsAdmin();
// Xử lý sửa bưu cục
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'sua') {
    $id = $_POST['id'] ?? null;
    $ten = $_POST['ten'] ?? '';
    $sdt = $_POST['sdt'] ?? '';

    if ($id && $ten !== '') {
        $result = $admin->suaBuuCuc($id, $ten, $sdt);
        if ($result) {
            header('Location: quan-li-buu-cuc.php?status=sua_thanh_cong');
        } else {
            header('Location: quan-li-buu-cuc.php?status=sua_that_bai');
        }
    } else {
        header('Location: quan-li-buu-cuc.php?status=sua_that_bai');
    }
    exit;
}

// Xử lý xóa bưu cục
if (isset($_GET['action']) && $_GET['action'] === 'xoa' && isset($_GET['ma_buu_cuc'])) {
    $id = $_GET['ma_buu_cuc'];
    $result = $admin->xoaBuuCuc($id);
    if ($result) {
        header('Location: quan-li-buu-cuc.php?status=xoa_thanh_cong');
    } else {
        header('Location: quan-li-buu-cuc.php?status=xoa_that_bai');
    }
    exit;
}


$search = $_GET['search'] ?? '';

if ($search !== '') {
    // Giả sử trong clsAdmin có hàm tìm bưu cục theo tên hoặc địa chỉ
    $buuCucs = $admin->timBuuCuc($search);
} else {
    $buuCucs = $admin->getTatCaBuuCuc();
}

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

        <div class="container py-4 card border rounded-4 p-3">
            <h3 class="mb-4">Quản lý bưu cục</h3>

            <div class="row">
                <!-- Danh sách bưu cục -->
                <div class="col-md-4">
                    
                    <h5>Danh sách bưu cục</h5>
                    <form method="get" class="mb-3 d-flex">
                        <input type="text" class="form-control me-2" id="search" name="search" 
                            placeholder="VD: Hồ Chí Minh" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>
                    <div style="max-height: 500px; overflow-y: auto;">
                        <ul class="list-group">
                            <?php foreach ($buuCucs as $buuCuc): ?>
                                <li class="list-group-item position-relative" style="min-height: 100px;">
                                    <div>
                                        <strong><?= htmlspecialchars($buuCuc['ten_buu_cuc']) ?></strong><br>
                                        <?= htmlspecialchars($buuCuc['dia_chi'] . ', ' . $buuCuc['xa_huyen_tinh']) ?><br>
                                        📞 <?= htmlspecialchars($buuCuc['so_dien_thoai'] ?? 'Không có') ?>
                                    </div>

                                    <div class="position-absolute bottom-0 end-0 m-2 text-end">
                                        <button class="btn btn-sm btn-primary btn-edit"
                                            data-id="<?= $buuCuc['id'] ?>"
                                            data-ten="<?= htmlspecialchars($buuCuc['ten_buu_cuc'], ENT_QUOTES) ?>"
                                            data-sdt="<?= htmlspecialchars($buuCuc['so_dien_thoai'], ENT_QUOTES) ?>">
                                            Chỉnh sửa
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-delete"
                                            data-id="<?= $buuCuc['id'] ?>"
                                            data-ten="<?= htmlspecialchars($buuCuc['ten_buu_cuc'], ENT_QUOTES) ?>">
                                            Xóa
                                        </button>
                                    </div>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Bản đồ bưu cục -->
                <div class="col-md-8">
                    <h5>Bản đồ bưu cục</h5>
                    <div class="shadow-sm" id="map" style="height: 550px;"></div>
                </div>
            </div>
        </div>
    </div>

<script>
    var map = L.map('map').setView([10.75, 106.7], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var Icon = L.icon({
        iconUrl: '../asset/img/home.png', // thay bằng ảnh icon PNG thật sự
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    var markers = [];

    <?php foreach ($buuCucs as $row): ?>
        var marker = L.marker([<?= $row['vi_do'] ?>, <?= $row['kinh_do'] ?>], { icon: Icon })
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

<!-- Modal chỉnh sửa bưu cục -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Chỉnh sửa bưu cục</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="action" value="sua">
          <input type="hidden" name="id" id="edit-ma-buu-cuc" />
          <div class="mb-3">
              <label for="edit-ten" class="form-label">Tên bưu cục</label>
              <input type="text" name="ten" id="edit-ten" class="form-control" required />
          </div>
          <div class="mb-3">
              <label for="edit-sdt" class="form-label">Số điện thoại</label>
              <input type="text" name="sdt" id="edit-sdt" class="form-control" />
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-success">Lưu</button>
      </div>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const ten = this.dataset.ten;
            const sdt = this.dataset.sdt;

            document.getElementById('edit-ma-buu-cuc').value = id;
            document.getElementById('edit-ten').value = ten;
            document.getElementById('edit-sdt').value = sdt;

            editModal.show();
        });
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const ten = this.dataset.ten;
            if (confirm(`Bạn có chắc chắn muốn xóa bưu cục "${ten}" không?`)) {
                window.location.href = `quan-li-buu-cuc.php?action=xoa&ma_buu_cuc=${id}`;
            }
        });
    });
</script>


</body>
</html>

<script>
    const params = new URLSearchParams(window.location.search);
    const status = params.get('status');

    if (status) {
        let message = '';
        switch (status) {
            case 'sua_thanh_cong':
                message = 'Sửa bưu cục thành công!';
                break;
            case 'sua_that_bai':
                message = 'Sửa bưu cục thất bại!';
                break;
            case 'xoa_thanh_cong':
                message = 'Xóa bưu cục thành công!';
                break;
            case 'xoa_that_bai':
                message = 'Xóa bưu cục thất bại!';
                break;
        }

        if (message) {
            alert(message);
        }

        // Xóa tham số URL để không hiện lại sau khi refresh
        window.history.replaceState({}, document.title, window.location.pathname);
    }
</script>
