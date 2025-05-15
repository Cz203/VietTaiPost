<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo Đơn Hàng</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
</head>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
let data = [];

async function loadData() {
  const res = await axios.get("https://provinces.open-api.vn/api/?depth=3");
  data = res.data;

  // Load tỉnh cho cả người gửi và người nhận
  loadTinhOptions("tinh_gui");
  loadTinhOptions("tinh_nhan");

  // Gán sự kiện
  setupAddressSelector("tinh_gui", "huyen_gui", "xa_gui");
  setupAddressSelector("tinh_nhan", "huyen_nhan", "xa_nhan");
}

function loadTinhOptions(tinhId) {
  const tinhSelect = document.getElementById(tinhId);
  tinhSelect.innerHTML = `<option value="">-- Chọn --</option>`;
  data.forEach(t => {
    tinhSelect.innerHTML += `<option value="${t.code}">${t.name}</option>`;
  });
}

function setupAddressSelector(tinhId, huyenId, xaId) {
  const tinhSelect = document.getElementById(tinhId);
  const huyenSelect = document.getElementById(huyenId);
  const xaSelect = document.getElementById(xaId);

  tinhSelect.addEventListener("change", () => {
    const selectedTinh = data.find(t => t.code == tinhSelect.value);
    huyenSelect.innerHTML = `<option value="">-- Chọn --</option>`;
    xaSelect.innerHTML = `<option value="">-- Chọn --</option>`;
    selectedTinh?.districts.forEach(h => {
      huyenSelect.innerHTML += `<option value="${h.code}">${h.name}</option>`;
    });
  });

  huyenSelect.addEventListener("change", () => {
    const selectedTinh = data.find(t => t.code == tinhSelect.value);
    const selectedHuyen = selectedTinh?.districts.find(h => h.code == huyenSelect.value);
    xaSelect.innerHTML = `<option value="">-- Chọn --</option>`;
    selectedHuyen?.wards.forEach(x => {
      xaSelect.innerHTML += `<option value="${x.code}">${x.name}</option>`;
    });
  });
}

loadData();
</script>


<!-- Thêm CSS cho Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Thêm JavaScript cho Leaflet -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


<body  class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    ?>
    
    <div class="main-content">

    <?php
    require_once 'view/header.php';
    ?>

<div class="container px-4 pb-5">
    <h2 class="mb-4">Tạo đơn hàng mới</h2>
    <form method="POST">
        <div class="row g-4">
            <!-- Cột trái -->
            <div class="col-md-5">
                <!-- Thông tin đơn hàng -->
                <div class="card border rounded-4 p-3">
                    <h5>Thông tin đơn hàng</h5>
                    <div class="mb-3">
                        <label class="form-label">Tên đơn hàng</label>
                        <input type="text" name="ten_don_hang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số lượng</label>
                        <input type="number" name="so_luong" class="form-control" required>
                    </div>
                    <label class="form-label">Trọng lượng gram</label>
                    <input type="number" name="trong_luong" id="trong_luong" class="form-control" step="0.1" min="0.1" required oninput="handleInputWeight()">

                </div>

                <!-- Thông tin thanh toán -->
                <div class="card border rounded-4 p-3 mt-1">
                    <h5>Thanh toán & Ghi chú</h5>
                    <div class="mb-3">
                        <label class="form-label">Tiền thu hộ (VNĐ)</label>
                        <input type="number" name="thu_ho" class="form-control" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Người trả phí</label>
                        <select name="nguoi_tra_phi" class="form-select">
                            <option value="người gửi">Người gửi</option>
                            <option value="người nhận">Người nhận</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="ghi_chu" class="form-control"></textarea>
                    </div>
                </div>

                <div class="card border rounded-4 p-3 mt-1">

                <div class="d-flex align-items-end flex-wrap gap-3">
                    <!-- Tổng phí vận chuyển -->
                    <div class="mb-0">
                        <label class="form-label">Tổng phí vận chuyển (VNĐ)</label>
                        <input type="text" name="phi_van_chuyen" class="form-control" id="shippingCost" value="0" readonly>
                        
                    </div>

                    <!-- Ngày giao dự kiến -->
                    <div class="mb-0">
                        <label class="form-label">Ngày giao dự kiến</label>
                        <input type="text" name="ngay_giao_du_kien" class="form-control" id="deliveryDate" readonly>
                    </div>

                    <!-- Nút submit -->
                    <div class="mb-0">
                        <input type="hidden" name="ma_khach_hang" value="1"> <!-- Gán cứng demo -->
                        <button type="submit" class="btn btn-primary px-4">Tạo đơn hàng</button>
                    </div>
                </div>
                </div>

            </div>

            <!-- Cột phải -->   
            <div class="col-md-7">
                <!-- Thông tin người gửi -->
                <div class="card border rounded-4 p-3">
                    <h5>Thông tin người gửi</h5>

                    <div class="mb-3">
                        <label class="form-label">Tên người gửi</label>
                        <input type="text" name="ten_nguoi_gui" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SĐT người gửi</label>
                        <input type="text" name="sdt_nguoi_gui" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ người gửi</label>
                        <textarea name="dia_chi_nguoi_gui" class="form-control" placeholder="Ghi đầy đủ và mô tả thêm nếu cần cho shipper dễ định vị hơn" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tỉnh/Thành phố</label>
                            <select id="tinh_gui" class="form-select" required></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quận/Huyện</label>
                            <select id="huyen_gui" class="form-select" required></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Xã/Phường</label>
                            <select id="xa_gui" class="form-select" required></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Đường/Thôn/Xóm</label>
                            <input type="text" name="duong_gui" class="form-control" placeholder="Ấp, đường, xóm, số nhà..." required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <button type="button" class="btn btn-secondary" onclick="openMapPopup()">Chọn vị trí trên bản đồ</button>
                            <div id="previewLocation" class="text-muted small">
                                <strong>Chưa chọn vị trí.</strong>
                            </div>
                            <input type="hidden" name="vi_do" id="vi_do">
                            <input type="hidden" name="kinh_do" id="kinh_do">
                        </div>

                        <!-- Popup modal chọn vị trí -->
                        <div id="mapModal" style="display:none; position:fixed; z-index:1000; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5)">
                            <div style="width: 80%; height: 80%; margin: 5% auto; background:white; position:relative; border-radius:10px; overflow:hidden;">
                                <div id="leafletMap" style="width:100%; height:100%"></div>
                                <button onclick="closeMapPopup()" style="position:absolute; top:10px; right:10px; z-index:1001;" class="btn btn-danger">Đóng</button>
                            </div>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thời gian hẹn lấy</label>
                        <select name="thoi_gian_hen_lay" class="form-select" required>
                            <option value="ca_ngay">Cả ngày</option>
                            <option value="sang">Sáng 8:00 - 12:00</option>
                            <option value="chieu">Chiều 13:30 - 17:30</option>
                            <option value="toi">Tối 18:30 - 20:30</option>
                        </select>
                    </div>
                </div>

                <!-- Thông tin người nhận -->
                <div class="card border rounded-4 p-3 mt-1">
                    <h5>Thông tin người nhận</h5>
                    <div class="mb-3">
                        <label class="form-label">Tên người nhận</label>
                        <input type="text" name="ten_nguoi_nhan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SĐT người nhận</label>
                        <input type="text" name="sdt_nguoi_nhan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ người nhận</label>
                        <textarea name="dia_chi_nguoi_nhan" class="form-control" placeholder="Ghi đầy đủ và mô tả thêm nếu cần cho shipper dễ định vị hơn" required></textarea>
                    </div>  
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tỉnh/Thành phố</label>
                            <select id="tinh_nhan" class="form-select" required></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quận/Huyện</label>
                            <select id="huyen_nhan" class="form-select" required></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Xã/Phường</label>
                            <select id="xa_nhan" class="form-select" required></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Đường/Thôn/Xóm</label>
                            <input type="text" name="duong_nhan" class="form-control" placeholder="Ấp, đường, xóm, số nhà..." required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <button type="button" class="btn btn-secondary" onclick="openReceiverMapPopup()">Chọn vị trí trên bản đồ</button>
                            <div id="receiverPreviewLocation" class="text-muted small">
                                <strong>Chưa chọn vị trí.</strong>
                            </div>
                            <input type="hidden" name="nguoi_nhan_vi_do" id="receiver_vi_do">
                            <input type="hidden" name="nguoi_nhan_kinh_do" id="receiver_kinh_do">
                        </div>

                        <!-- Popup modal chọn vị trí -->
                        <div id="receiverMapModal" style="display:none; position:fixed; z-index:1000; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5)">
                            <div style="width: 80%; height: 80%; margin: 5% auto; background:white; position:relative; border-radius:10px; overflow:hidden;">
                                <div id="receiverLeafletMap" style="width:100%; height:100%"></div>
                                <button onclick="closeReceiverMapPopup()" style="position:absolute; top:10px; right:10px; z-index:1001;" class="btn btn-danger">Đóng</button>
                            </div>
                        </div>

                    </div>

                </div>

                

            </div>
        </div>
    </form>
</div>
  
</body>
</html>

<script>
let map, marker;

function openMapPopup() {
  document.getElementById('mapModal').style.display = 'block';

  setTimeout(() => {
    if (!map) {
      map = L.map('leafletMap').setView([16.047079, 108.206230], 6);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

      map.on('click', function (e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // Cập nhật marker
        if (marker) map.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(map);

        // Gán vào input ẩn
        document.getElementById('vi_do').value = lat;
        document.getElementById('kinh_do').value = lng;

        console.log("Vĩ độ người gửi:", document.getElementById('vi_do').value);
        console.log("Kinh độ người gửi:", document.getElementById('kinh_do').value);


        // Gọi reverse geocoding
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
            } else {
              preview.textContent = 'Không tìm thấy địa chỉ phù hợp.';
            }
          });
      });
    }

    // Zoom đến Tỉnh/Huyện/Xã
    const tinhText = document.getElementById("tinh_gui").selectedOptions[0]?.text || "";
    const huyenText = document.getElementById("huyen_gui").selectedOptions[0]?.text || "";
    const xaText = document.getElementById("xa_gui").selectedOptions[0]?.text || "";
    const diaChiFull = `${xaText}, ${huyenText}, ${tinhText}`;

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(diaChiFull)}`)
      .then(res => res.json())
      .then(data => {
        if (data.length > 0) {
          const lat = parseFloat(data[0].lat);
          const lon = parseFloat(data[0].lon);
          map.setView([lat, lon], 16);
        }
      });
  }, 300);
}

function closeMapPopup() {
  document.getElementById('mapModal').style.display = 'none';
  calculateShippingCostAndDate();
}
</script>



<script>
let receiverMap, receiverMarker;

function openReceiverMapPopup() {
  document.getElementById('receiverMapModal').style.display = 'block';

  setTimeout(() => {
    if (!receiverMap) {
      receiverMap = L.map('receiverLeafletMap').setView([16.047079, 108.206230], 6);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(receiverMap);

      receiverMap.on('click', function (e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        // Cập nhật marker
        if (receiverMarker) receiverMap.removeLayer(receiverMarker);
        receiverMarker = L.marker(e.latlng).addTo(receiverMap);

        // Gán vào input ẩn
        document.getElementById('receiver_vi_do').value = lat;
        document.getElementById('receiver_kinh_do').value = lng;

        console.log("Vĩ độ người nhận:", document.getElementById('receiver_vi_do').value);
        console.log("Kinh độ người nhận:", document.getElementById('receiver_kinh_do').value);

        // Reverse geocoding
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
          .then(res => res.json())
          .then(data => {
            const preview = document.getElementById('receiverPreviewLocation');
            if (data && data.display_name) {
              preview.innerHTML = `
                <strong>Vị trí đã chọn:</strong><br>
                Kinh độ: ${lng.toFixed(6)}, Vĩ độ: ${lat.toFixed(6)}<br>
                <em>${data.display_name}</em>
              `;
            } else {
              preview.textContent = 'Không tìm thấy địa chỉ phù hợp.';
            }
          });
      });
    }

     // Zoom đến Tỉnh/Huyện/Xã
    const tinhText = document.getElementById("tinh_nhan").selectedOptions[0]?.text || "";
    const huyenText = document.getElementById("huyen_nhan").selectedOptions[0]?.text || "";
    const xaText = document.getElementById("xa_nhan").selectedOptions[0]?.text || "";
    const diaChiFull = `${xaText}, ${huyenText}, ${tinhText}`;

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(diaChiFull)}`)
      .then(res => res.json())
      .then(data => {
        if (data.length > 0) {
          const lat = parseFloat(data[0].lat);
          const lon = parseFloat(data[0].lon);
          receiverMap.setView([lat, lon], 16);
        }
      });
  }, 300);
}

function closeReceiverMapPopup() {
  document.getElementById('receiverMapModal').style.display = 'none';
  calculateShippingCostAndDate();
}
</script>

<script>
async function calculateShippingCostAndDate() {
    
    const weight = parseFloat(document.getElementById('trong_luong').value); 

    const weightKg = weight / 1000;
    const provinceSender = document.getElementById('tinh_gui').value;
    const provinceReceiver = document.getElementById('tinh_nhan').value;

    const regionMap = {
        "Miền Bắc": ["Hà Nội", "Hải Phòng", "Quảng Ninh", "Bắc Ninh", "Bắc Giang", "Vĩnh Phúc", "Hưng Yên", "Hà Nam", "Nam Định", "Ninh Bình", "Thái Bình", "Lạng Sơn", "Cao Bằng", "Bắc Kạn", "Tuyên Quang", "Hà Giang", "Yên Bái", "Lào Cai", "Sơn La", "Lai Châu", "Điện Biên", "Hòa Bình", "Phú Thọ", "Thái Nguyên"],
        "Miền Trung": ["Thanh Hóa", "Nghệ An", "Hà Tĩnh", "Quảng Bình", "Quảng Trị", "Thừa Thiên Huế", "Đà Nẵng", "Quảng Nam", "Quảng Ngãi", "Bình Định", "Phú Yên", "Khánh Hòa", "Ninh Thuận", "Bình Thuận", "Kon Tum", "Gia Lai", "Đắk Lắk", "Đắk Nông", "Lâm Đồng"],
        "Miền Nam": ["TP. Hồ Chí Minh", "Bình Dương", "Đồng Nai", "Bà Rịa - Vũng Tàu", "Tây Ninh", "Bình Phước", "Long An", "Tiền Giang", "Bến Tre", "Trà Vinh", "Vĩnh Long", "Đồng Tháp", "An Giang", "Cần Thơ", "Hậu Giang", "Kiên Giang", "Sóc Trăng", "Bạc Liêu", "Cà Mau"]
    };

    function getRegion(province) {
        for (let region in regionMap) {
            if (regionMap[region].includes(province)) {
                return region;
            }
        }
        return null;
    }

    const senderRegion = getRegion(provinceSender);
    const receiverRegion = getRegion(provinceReceiver);

    let zone = "";
    if (provinceSender === provinceReceiver) {
        zone = "nội_tỉnh";
    } else if (senderRegion === receiverRegion) {
        zone = "nội_miền";
    } else {
        zone = "liên_miền";
    }

    let cost = 0;
    if (zone === "nội_tỉnh") {
        if (weight <= 2000) cost = 17000;
        else {
            cost = 17000 + Math.ceil((weight - 1000) / 500) * 2500;
        }
    } else if (zone === "nội_miền") {
        if (weight <= 1000) cost = 21000;
        else if (weight <= 2000) cost = 25000;
        else {
            cost = 25000 + Math.ceil((weight - 2000) / 500) * 3000;
        }
    } else if (zone === "liên_miền") {
        if (weight <= 1000) cost = 21000;
        else if (weight <= 2000) cost = 26000  ;
        else {
            cost = 26000 + Math.ceil((weight - 2000) / 500) * 4500;
        }
    }

    document.getElementById('shippingCost').value = cost.toLocaleString('vi-VN');

    // Ước tính ngày giao hàng theo zone
    const today = new Date();
    if (zone === "nội_tỉnh") today.setDate(today.getDate() + 2.5);
    else if (zone === "nội_miền") today.setDate(today.getDate() + 3);
    else today.setDate(today.getDate() + 4);

    const deliveryDate = today.toLocaleDateString('vi-VN');
    document.getElementById('deliveryDate').value = deliveryDate;
}

calculateShippingCostAndDate();
</script>

<script>
let weightTimeout;
function handleInputWeight() {
    clearTimeout(weightTimeout);
    weightTimeout = setTimeout(() => {
        calculateShippingCostAndDate();
    }, 200); // chỉ gọi hàm nếu không gõ gì thêm trong 0.5 giây
}
</script>

<script>
document.getElementById('tinh_gui').addEventListener('change', calculateShippingCostAndDate);
document.getElementById('tinh_nhan').addEventListener('change', calculateShippingCostAndDate);
</script>

