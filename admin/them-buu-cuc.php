<?php
require_once '../controller/cls-admin.php';
$admin = new clsAdmin();
$thongBao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten = $_POST['ten_buu_cuc'];
    $dia_chi = $_POST['dia_chi'];
    $xa_huyen_tinh = $_POST['xa_huyen_tinh'];
    $vi_do = $_POST['vi_do'];
    $kinh_do = $_POST['kinh_do'];
    $sdt = $_POST['so_dien_thoai'];

    
   if ($admin->themBuuCuc($ten, $dia_chi, $xa_huyen_tinh, $vi_do, $kinh_do, $sdt)) {
        $thongBao = "Thêm bưu cục thành công!";
    } else {
        $thongBao = "Thêm thất bại. Vui lòng kiểm tra lại thông tin.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm bưu cục</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body class="d-flex">
<?php require_once 'view/sidebar.php'; ?>

<div class="main-content">
<?php require_once 'view/header.php'; ?>

<?php if ($thongBao): ?>
    <div class="alert alert-info alert-dismissible fade show mx-4 my-3" role="alert">
        <?= htmlspecialchars($thongBao) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="container py-4 card border rounded-4 p-3">
    <h3 class="mb-4">Thêm bưu cục mới</h3>

    <form method="POST" class="row g-3 mb-4">
        <div class="col-md-6">
            <label class="form-label">Tên bưu cục</label>
            <input type="text" name="ten_buu_cuc" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="so_dien_thoai" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="dia_chi" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Tỉnh/Thành</label>
            <select id="tinh" class="form-select" required></select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Quận/Huyện</label>
            <select id="huyen" class="form-select" required></select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Xã/Phường</label>
            <select id="xa" class="form-select" name="xa_huyen_tinh" required></select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Vị trí trên bản đồ</label><br>
            <button type="button" onclick="openMapPopup()" class="btn btn-outline-primary">Chọn vị trí</button>
            <div id="previewLocation" class="mt-2 text-muted small"></div>
        </div>

        <div class="col-md-3">
            <label class="form-label">Vĩ độ</label>
            <input type="text" name="vi_do" id="vi_do" class="form-control" readonly required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Kinh độ</label>
            <input type="text" name="kinh_do" id="kinh_do" class="form-control" readonly required>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success">Thêm bưu cục</button>
            <a href="quan-li-buu-cuc.php" class="btn btn-secondary ms-2">Quay lại</a>
        </div>
    </form>
</div>
</div>

<!-- Modal bản đồ -->
<div id="mapModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:#000000a0; z-index:9999;">
  <div style="position:relative; margin:5% auto; width:90%; max-width:800px; background:white; padding:1rem; border-radius:8px;">
    <div id="leafletMap" style="height: 500px;"></div>
    <div class="text-end mt-2">
      <button class="btn btn-secondary" onclick="closeMapPopup()">Đóng</button>
    </div>
  </div>
</div>

<script>
let dataTinh;

async function loadDiaChiVN() {
    const res = await axios.get("https://provinces.open-api.vn/api/?depth=3");
    dataTinh = res.data;

    const tinhSelect = document.getElementById("tinh");
    tinhSelect.innerHTML = '<option value="">--Chọn tỉnh--</option>';
    dataTinh.forEach(t => {
        const opt = new Option(t.name, t.code);
        tinhSelect.appendChild(opt);
    });
}

document.getElementById("tinh").addEventListener("change", function () {
    const tinh = dataTinh.find(t => t.code == this.value);
    const huyenSelect = document.getElementById("huyen");
    huyenSelect.innerHTML = '<option value="">--Chọn huyện--</option>';
    document.getElementById("xa").innerHTML = '<option value="">--Chọn xã--</option>';

    tinh.districts.forEach(h => {
        const opt = new Option(h.name, h.code);
        huyenSelect.appendChild(opt);
    });
});

document.getElementById("huyen").addEventListener("change", function () {
    const tinh = dataTinh.find(t => t.code == document.getElementById("tinh").value);
    const huyen = tinh.districts.find(h => h.code == this.value);
    const xaSelect = document.getElementById("xa");
    xaSelect.innerHTML = "";

    huyen.wards.forEach(x => {
        const opt = new Option(x.name, `${x.name}, ${huyen.name}, ${tinh.name}`);
        xaSelect.appendChild(opt);
    });
});

loadDiaChiVN();

let mapPopup, marker;

function openMapPopup() {
  document.getElementById('mapModal').style.display = 'block';

  setTimeout(() => {
    if (!mapPopup) {
      mapPopup = L.map('leafletMap').setView([16.047079, 108.206230], 6);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(mapPopup);

      mapPopup.on('click', function (e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        if (marker) mapPopup.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(mapPopup);

        document.getElementById('vi_do').value = lat;
        document.getElementById('kinh_do').value = lng;

        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
          .then(res => res.json())
          .then(data => {
            const preview = document.getElementById('previewLocation');
            if (data && data.display_name) {
              preview.innerHTML = `
                <strong>Vị trí đã chọn:</strong><br>
                Kinh độ: ${lng.toFixed(6)}, Vĩ độ: ${lat.toFixed(6)}<br>
                <em>${data.display_name}</em>
              `;

              const addr = data.address || {};
              if (addr.state) selectOptionByText('tinh', addr.state);
              if (addr.county || addr.district) selectOptionByText('huyen', addr.county || addr.district);
              if (addr.village || addr.suburb || addr.town) selectOptionByText('xa', addr.village || addr.suburb || addr.town);
            } else {
              preview.textContent = 'Không tìm thấy địa chỉ phù hợp.';
            }
          });
      });
    }

    mapPopup.invalidateSize();

    const tinhText = document.getElementById("tinh")?.selectedOptions[0]?.text || "";
    const huyenText = document.getElementById("huyen")?.selectedOptions[0]?.text || "";
    const xaText = document.getElementById("xa")?.selectedOptions[0]?.text || "";
    const diaChiFull = `${xaText}, ${huyenText}, ${tinhText}`;

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(diaChiFull)}`)
      .then(res => res.json())
      .then(data => {
        if (data.length > 0) {
          const lat = parseFloat(data[0].lat);
          const lon = parseFloat(data[0].lon);
          mapPopup.setView([lat, lon], 16);
        }
      });

  }, 300);
}

function closeMapPopup() {
    document.getElementById('mapModal').style.display = 'none';
}
  
function selectOptionByText(selectId, text) {
    const select = document.getElementById(selectId);
    if (!select) return;
    for (let i = 0; i < select.options.length; i++) {
        if (select.options[i].text.toLowerCase() === text.toLowerCase()) {
            select.selectedIndex = i;
            select.dispatchEvent(new Event('change'));
            break;
        }
    }
}
</script>

</body>
</html>

