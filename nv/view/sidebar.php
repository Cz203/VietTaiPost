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
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
    }

    .sidebar-custom .nav-link:hover,
    .sidebar-custom .nav-link.active {
        background-color: #343a40;
        color: #fff;
    }

    .sidebar-custom .nav-link .badge {
        font-size: 0.75rem;
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
<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
<script src="../asset/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../asset/css/style.css">

<div class="d-flex flex-column flex-shrink-0 p-3 sidebar-custom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i class="bi bi-box-seam fs-4 me-2"></i>
        <span class="fs-4">VIETTAI-POST</span>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="home.php" class="nav-link">
                <i class="bi bi-house-door-fill me-2"></i> Trang chủ
            </a>
        </li>

        <div class="section-title">Đơn hàng</div>
        <ul class="nav flex-column mb-2 ps-3">
            <li>
                <a href="don-hang-can-lay.php" class="nav-link d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-box-arrow-in-down me-2"></i> Đơn hàng cần lấy</span>
                </a>
            </li>
            <li>
                <a href="don-hang-can-giao.php" class="nav-link">
                    <i class="bi bi-truck me-2"></i> Đơn hàng cần giao
                </a>
            </li>
        </ul>
        <hr>

        <!-- <div class="section-title">Cài đặt</div>
    <ul class="nav flex-column ps-3">
      <li>
        <a href="duyet-don.php" class="nav-link">
          <i class="bi bi-person-gear me-2"></i> Quản lí tài khoản
        </a>
      </li>
      <li>
        <a href="chatbox_shipper.php" class="nav-link">
          <i class="bi bi-chat-dots me-2"></i> Chat
        </a>
      </li>
    </ul> -->
    </ul>
    <hr>
</div>