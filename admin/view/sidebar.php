<?php 
require_once 'auth.php';
kiemTraDangNhapAdmin();
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
.sidebar-custom {
  width: 280px;
  min-height: 100vh;
  background-color: #212529;
  color: #fff;
}

.sidebar-custom .nav-link {
  color: #adb5bd;
  border-radius: 8px;
  padding: 8px 12px;
  transition: all 0.2s ease-in-out;
}

.sidebar-custom .nav-link:hover,
.sidebar-custom .nav-link.active {
  background-color: #343a40;
  color: #fff;
}

.sidebar-custom .nav-link i {
  margin-right: 8px;
}

.sidebar-custom .section-title {
  font-weight: bold;
  color: #fff;
  padding-left: 12px;
  margin-top: 1rem;
}

.sidebar-custom hr {
  margin: 0.5rem 0;
}
</style>

<div class="d-flex flex-column flex-shrink-0 p-3 sidebar-custom">
  <a href="/" class="d-flex align-items-center mb-3 text-white text-decoration-none">
    <i class="bi bi-box-seam fs-4 me-2"></i>
    <span class="fs-4">VIETTAI-POST</span>
  </a>
  <hr>

  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="home.php" class="nav-link">
        <i class="bi bi-house-door-fill"></i> Trang chủ
      </a>
    </li>

    <div class="section-title">Đơn hàng</div>
    <ul class="nav flex-column ps-3">
      <li>
        <a class="nav-link" href="duyet-don.php">
          <i class="bi bi-hourglass-split"></i> Đợi duyệt
        </a>
      </li>
      <li>
        <a class="nav-link" href="don-hang.php">
          <i class="bi bi-list-ul"></i> Danh sách đơn hàng
        </a>
      </li>
    </ul>
    <hr>

    <div class="section-title">Shipper</div>
    <ul class="nav flex-column ps-3">
      <li>
        <a class="nav-link" href="vi-tri-shipper.php">
          <i class="bi bi-geo-alt-fill"></i> Vị trí shipper
        </a>
      </li>
      <li>
        <a class="nav-link" href="quan-li-shipper.php">
          <i class="bi bi-people-fill"></i> Quản lí shipper
        </a>
      </li>
    </ul>
    <hr>

    <div class="section-title">Bưu cục</div>
    <ul class="nav flex-column ps-3">
      <li>
        <a class="nav-link" href="them-buu-cuc.php">
          <i class="bi bi-plus-square-fill"></i> Thêm bưu cục
        </a>
      </li>
      <li>
        <a class="nav-link" href="quan-li-buu-cuc.php">
          <i class="bi bi-building"></i> Quản lí bưu cục
        </a>
      </li>
    </ul>
    <hr>

    <div class="section-title">Vận chuyển hàng</div>
    <ul class="nav flex-column ps-3">
      <li>
        <a class="nav-link" href="van-chuyen-hang.php">
          <i class="bi bi-arrow-left-right"></i> Vận chuyển hàng qua các bưu cục
        </a>
      </li>
    </ul>
  </ul>
  <hr>
</div>

<!-- Bootstrap & Custom CSS/JS -->
<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../asset/css/style.css">
<script src="../asset/js/bootstrap.bundle.min.js"></script>
