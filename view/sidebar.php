<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "khachhang") {
  header("Location: login.php");
  exit();
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <svg class="bi me-2" width="40" height="32">
      <use xlink:href="#bootstrap"></use>
    </svg>
    <span class="fs-4">VIETTAI-POST</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="trang-chu.php" class="nav-link text-white" aria-current="page">
        <svg class="bi me-2" width="16" height="16">
          <use xlink:href="#home"></use>
        </svg>
        Trang chủ
      </a>
    </li>
    <li>
      <a href="tao-don.php" class="nav-link text-white">
        <svg class="bi me-2" width="16" height="16">
          <use xlink:href="#speedometer2"></use>
        </svg>
        Tạo đơn
      </a>
    </li>
    <li>
      <a href="don-hang.php" class="nav-link text-white">
        <svg class="bi me-2" width="16" height="16">
          <use xlink:href="#table"></use>
        </svg>
        Đơn của tôi
      </a>
    </li>
    <li>
      <a href="buu-cuc.php" class="nav-link text-white">
        <svg class="bi me-2" width="16" height="16">
          <use xlink:href="#grid"></use>
        </svg>
        Tra cứu bưu cục
      </a>
    </li>
    <li>
      <a href="quan-li-tai-khoan.php" class="nav-link text-white">
        <svg class="bi me-2" width="16" height="16">
          <use xlink:href="#grid"></use>
        </svg>
        Quản lí tài khoản
      </a>
    </li>
    <li>
      <a href="chatbox_khachhang.php" class="nav-link text-white">
        <svg class="bi me-2" width="16" height="16">
          <use xlink:href="#grid"></use>
        </svg>
        Chat
      </a>
    </li>
  </ul>
  <hr>

</div> -->
<style>
.sidebar-custom .nav-link {
  color: #adb5bd;
  transition: background-color 0.2s, color 0.2s;
  border-radius: 8px;
  margin-bottom: 5px;
  padding: 10px 12px;
}

.sidebar-custom .nav-link:hover,
.sidebar-custom .nav-link.active {
  background-color: #495057;
  color: #fff;
}

.sidebar-custom .nav-link svg {
  margin-right: 8px;
  vertical-align: middle;
  fill: currentColor;
}
</style>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark sidebar-custom" style="width: 280px; min-height: 100vh;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <svg class="bi me-2" width="40" height="32">
      <use xlink:href="#bootstrap"></use>
    </svg>
    <span class="fs-4 fw-semibold">VIETTAI-POST</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="trang-chu.php" class="nav-link">
        <svg class="bi" width="20" height="20"><use xlink:href="#home"></use></svg>
        Trang chủ
      </a>
    </li>
    <li>
      <a href="tao-don.php" class="nav-link">
        <svg class="bi" width="20" height="20"><use xlink:href="#file-plus"></use></svg>
        Tạo đơn
      </a>
    </li>
    <li>
      <a href="don-hang.php" class="nav-link">
        <svg class="bi" width="20" height="20"><use xlink:href="#box-seam"></use></svg>
        Đơn của tôi
      </a>
    </li>
    <li>
      <a href="buu-cuc.php" class="nav-link">
        <svg class="bi" width="20" height="20"><use xlink:href="#geo-alt"></use></svg>
        Tra cứu bưu cục
      </a>
    </li>
    <li>
      <a href="quan-li-tai-khoan.php" class="nav-link">
        <svg class="bi" width="20" height="20"><use xlink:href="#person-circle"></use></svg>
        Quản lí tài khoản
      </a>
    </li>
    <!-- <li>
      <a href="chatbox_khachhang.php" class="nav-link">
        <svg class="bi" width="20" height="20"><use xlink:href="#chat-dots"></use></svg>
        Chat
      </a>
    </li> -->
  </ul>
  <hr>
</div>
