<?php
require_once 'controller/cls-khachhang.php';
$kh = new clsKhachhang();
$don_hangs = [];
session_start();
if (isset($_GET['ma_don_hang'])) {
    $ma_don_hang = $_GET['ma_don_hang'];
    $don_hangs = $kh->layDonHangTheoMa($ma_don_hang);
    //echo "<pre>"; print_r($don_hangs); echo "</pre>";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Viettaipost - Chào mừng</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<!-- Header -->
<header class="bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center">
    <h1 class="m-0">Viettaipost</h1>
    <div>
    <?php 
        if(isset($_SESSION['id']))
        {
            echo '<a href="trang-chu.php" class="btn btn-light me-2">Trang của tôi</a>';
            echo ' <a href="logout.php" class="btn btn-warning">Đăng Xuất</a>';
        }
        else 
        {
            echo '<a href="login.php" class="btn btn-light me-2">Đăng nhập</a>
                  <a href="signup.php" class="btn btn-warning">Đăng ký</a>';
        }
    ?>
        
    </div>
</header>

<!-- Main content -->
<main class="container py-5">
    <div class="text-center mb-5">
        <h2 class="mb-3">Chào mừng đến với Viettaipost</h2>
        <p class="lead">Hệ thống giao hàng nhanh chóng, an toàn, thuận tiện trên toàn quốc.</p>
    </div>

    <!-- Form tra cứu vận đơn -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h4 class="mb-3">Tra cứu vận đơn</h4>
            <form method="GET" action="index.php">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="ma_don_hang" placeholder="Nhập mã đơn hàng..." required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Tra cứu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($don_hangs)): ?>
        <div class="card p-4 shadow-sm border mb-4">
            <h4 class="mb-4">Kết quả tra cứu</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên đơn hàng</th>
                            <th>Người gửi</th>
                            <th>Người nhận</th>
                            <th>Trạng thái</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($don_hangs as $don): ?>
                        <tr>
                            <td><?= $don['ma_don_hang'] ?></td>
                            <td><?= $don['ten_don_hang'] ?></td>
                            <td><?= $don['ten_nguoi_gui'] ?><br><?= $don['dia_chi_nguoi_gui'] ?></td>
                            <td><?= $don['ten_nguoi_nhan'] ?><br><?= $don['dia_chi_nguoi_nhan'] ?></td>
                            <td><span class="badge bg-info"><?= $don['trang_thai'] ?></span></td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $don['ma_don_hang'] ?>">Chi tiết</button>
                            </td>
                        </tr>

                        <!-- Modal chi tiết đơn -->
                        <div class="modal fade" id="modal<?= $don['ma_don_hang'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Chi tiết đơn hàng <?= $don['ma_don_hang'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><strong>Tên đơn hàng:</strong>
                                                        <?= $don['ten_don_hang'] ?></li>
                                                    <li class="list-group-item"><strong>Số lượng:</strong> <?= $don['so_luong'] ?></li>
                                                    <li class="list-group-item"><strong>Trọng lượng:</strong> <?= $don['trong_luong'] ?>
                                                        gram</li>
                                                    <li class="list-group-item"><strong>Người gửi:</strong> <?= $don['ten_nguoi_gui'] ?>
                                                        (<?= $don['sdt_nguoi_gui'] ?>)</li>
                                                    <li class="list-group-item"><strong>Địa chỉ gửi:</strong>
                                                        <?= $don['dia_chi_nguoi_gui'] ?> - <?= $don['dia_chi_nguoi_gui_mac_dinh'] ?>
                                                    </li>
                                                    <li class="list-group-item"><strong>Người nhận:</strong>
                                                        <?= $don['ten_nguoi_nhan'] ?> (<?= $don['sdt_nguoi_nhan'] ?>)</li>
                                                    <li class="list-group-item"><strong>Địa chỉ nhận:</strong>
                                                        <?= $don['dia_chi_nguoi_nhan'] ?> - <?= $don['dia_chi_nguoi_nhan_mac_dinh'] ?>
                                                    </li>
                                                    <li class="list-group-item"><strong>Thu hộ:</strong>
                                                        <?= number_format($don['thu_ho']) ?>đ</li>
                                                    <li class="list-group-item"><strong>Phí vận chuyển:</strong>
                                                        <?= number_format($don['phi_van_chuyen']) ?>đ</li>
                                                    <li class="list-group-item"><strong>Người trả phí:</strong>
                                                        <?= $don['nguoi_tra_phi'] ?></li>
                                                    <li class="list-group-item"><strong>Trạng thái:</strong> <?= $don['trang_thai'] ?>
                                                    </li>
                                                    <li class="list-group-item"><strong>Ngày tạo:</strong> <?= $don['ngay_tao'] ?></li>
                                                    <li class="list-group-item"><strong>Thời gian hẹn lấy:</strong>
                                                        <?= $don['thoi_gian_hen_lay'] ?></li>
                                                    <li class="list-group-item"><strong>Ngày giao dự kiến:</strong>
                                                        <?= $don['ngay_giao_du_kien'] ?></li>
                                                    <li class="list-group-item"><strong>Ghi chú:</strong> <?= $don['ghi_chu'] ?></li>
                                                </ul>
                                            </div>
                                        <div class="col-md-5">
                                            <div class="card border shadow-sm">
                                                <div class="card-header bg-primary text-white">Theo dõi kiện hàng</div>
                                                <div class="card-body">
                                                    <?php
                                                        $van_dons = $kh->layVanDonTheoMaDon($don['ma_don_hang']);
                                                        $hasTracking = false;

                                                        foreach ($van_dons as $vd) {
                                                            switch ($vd['trang_thai']) {
                                                                case 'đợi lấy hàng':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🕐 Đợi lấy hàng:</strong><br>📌 {$vd['lich_su']}<br>👤 Shipper: {$vd['ten_shipper']} ({$vd['sdt_shipper']})</p><hr>";
                                                                    break;
                                                                case 'đã lấy hàng':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>✅ Đã lấy hàng:</strong><br>📌 {$vd['lich_su']}</p><hr>";
                                                                    break;
                                                                case 'ở bưu cục':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🏢 Đang ở bưu cục:</strong><br>📌 {$vd['lich_su']}<br></p><hr>";
                                                                    break;
                                                                case 'trong xe':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🚚 Đang giao:</strong><br>📌 {$vd['lich_su']}<br></p><hr>";
                                                                    break;
                                                                case 'đang đi giao':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🚚 Đang giao:</strong><br>📌 {$vd['lich_su']}<br>👤 Shipper: {$vd['ten_shipper']} ({$vd['sdt_shipper']})</p><hr>";
                                                                    break;
                                                                case 'hủy':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>❌ Đã bị hủy:</strong><br>📌 {$vd['lich_su']}</p>";
                                                                    break;
                                                                case 'giao thành công':
                                                                    $hasTracking = true;
                                                                    echo "<p><strong>🎉 Đã giao thành công:</strong><br>📌 {$vd['lich_su']}<br>👤 Shipper: {$vd['ten_shipper']} ({$vd['sdt_shipper']})</p>";
                                                                    break;
                                                            }
                                                        }

                                                        if (!$hasTracking) {
                                                            echo "<p class='text-muted'>Chưa có thông tin theo dõi.</p>";
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <div class="container card shadow-sm ">
    <h4 class="my-4">Ước tính cước phí vận chuyển</h4>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label fw-bold">Tỉnh gửi</label>
        <select id="tinh_gui" class="form-select" required></select>
      </div>
      <div class="col-md-6">
        <label class="form-label fw-bold">Tỉnh nhận</label>
        <select id="tinh_nhan" class="form-select" required></select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Trọng lượng (gram)</label>
        <input type="number" id="trong_luong" class="form-control" min="100" step="100" oninput="handleInputWeight()">
      </div>
      <div class="col-md-4">
        <label class="form-label">Phí vận chuyển (VNĐ)</label>
        <input type="text" id="phi_van_chuyen_hienthi" class="form-control" readonly>
        <input type="hidden" id="shippingCost">
      </div>
      <div class="col-md-4 mb-4">
        <label class="form-label">Ngày giao dự kiến</label>
        <input type="text" id="deliveryDate" class="form-control" readonly>
      </div>
    </div>
  </div>


</main>
  <script>
    async function loadTinh() {
      const res = await axios.get("https://provinces.open-api.vn/api/?depth=1");
      const data = res.data;
      const tinhGui = document.getElementById("tinh_gui");
      const tinhNhan = document.getElementById("tinh_nhan");

      [tinhGui, tinhNhan].forEach(select => {
        select.innerHTML = `<option value="">--Chọn tỉnh--</option>`;
        data.forEach(p => {
          select.innerHTML += `<option value="${p.name}">${p.name}</option>`;
        });
      });
    }

    async function calculateShippingCostAndDate() {
      const weight = parseFloat(document.getElementById('trong_luong').value);
      const provinceSender = document.getElementById('tinh_gui').value;
      const provinceReceiver = document.getElementById('tinh_nhan').value;

      if (!weight || !provinceSender || !provinceReceiver) return;

      const regionMap = {
        "Miền Bắc": ["Hà Nội", "Hải Phòng", "Quảng Ninh", "Bắc Ninh", "Bắc Giang", "Vĩnh Phúc", "Hưng Yên", "Hà Nam", "Nam Định", "Ninh Bình", "Thái Bình", "Lạng Sơn", "Cao Bằng", "Bắc Kạn", "Tuyên Quang", "Hà Giang", "Yên Bái", "Lào Cai", "Sơn La", "Lai Châu", "Điện Biên", "Hòa Bình", "Phú Thọ", "Thái Nguyên"],
        "Miền Trung": ["Thanh Hóa", "Nghệ An", "Hà Tĩnh", "Quảng Bình", "Quảng Trị", "Thừa Thiên Huế", "Đà Nẵng", "Quảng Nam", "Quảng Ngãi", "Bình Định", "Phú Yên", "Khánh Hòa", "Ninh Thuận", "Bình Thuận", "Kon Tum", "Gia Lai", "Đắk Lắk", "Đắk Nông", "Lâm Đồng"],
        "Miền Nam": ["TP. Hồ Chí Minh", "Bình Dương", "Đồng Nai", "Bà Rịa - Vũng Tàu", "Tây Ninh", "Bình Phước", "Long An", "Tiền Giang", "Bến Tre", "Trà Vinh", "Vĩnh Long", "Đồng Tháp", "An Giang", "Cần Thơ", "Hậu Giang", "Kiên Giang", "Sóc Trăng", "Bạc Liêu", "Cà Mau"]
      };

      function getRegion(province) {
        for (let region in regionMap) {
          if (regionMap[region].includes(province)) return region;
        }
        return null;
      }

      const senderRegion = getRegion(provinceSender);
      const receiverRegion = getRegion(provinceReceiver);

      let zone = "";
      if (provinceSender === provinceReceiver) zone = "nội_tỉnh";
      else if (senderRegion === receiverRegion) zone = "nội_miền";
      else zone = "liên_miền";

      let cost = 0;
      if (zone === "nội_tỉnh") {
        if (weight <= 2000) cost = 17000;
        else cost = 17000 + Math.ceil((weight - 1000) / 500) * 2500;
      } else if (zone === "nội_miền") {
        if (weight <= 1000) cost = 21000;
        else if (weight <= 2000) cost = 25000;
        else cost = 25000 + Math.ceil((weight - 2000) / 500) * 3000;
      } else {
        if (weight <= 1000) cost = 21000;
        else if (weight <= 2000) cost = 26000;
        else cost = 26000 + Math.ceil((weight - 2000) / 500) * 4500;
      }

      document.getElementById('phi_van_chuyen_hienthi').value = cost.toLocaleString('vi-VN');
      document.getElementById('shippingCost').value = cost;

      // Ước tính ngày giao
      const today = new Date();
      if (zone === "nội_tỉnh") today.setDate(today.getDate() + 2.5);
      else if (zone === "nội_miền") today.setDate(today.getDate() + 3);
      else today.setDate(today.getDate() + 4);

      document.getElementById('deliveryDate').value = today.toLocaleDateString('vi-VN');
    }

    let weightTimeout;
    function handleInputWeight() {
      clearTimeout(weightTimeout);
      weightTimeout = setTimeout(calculateShippingCostAndDate, 200);
    }

    document.getElementById('tinh_gui').addEventListener('change', calculateShippingCostAndDate);
    document.getElementById('tinh_nhan').addEventListener('change', calculateShippingCostAndDate);

    loadTinh();
  </script>
<script src="asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>
