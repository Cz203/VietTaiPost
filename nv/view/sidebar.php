<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">VIETTAI-POST</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

       <li class="nav-item">
        <span class="nav-link text-white"><b><a class="text-white" href="home.php">Trang chủ</a></b></span>
      </li>
      <hr>

       <li class="nav-item">
        <span class="nav-link text-white"><b>Đơn hàng</b></span>
        <ul style="list-style:none; padding-left: 1rem; margin-top: 0.5rem;">
          <li>
            <a class="nav-link text-white" href="don-hang-trong-bc.php">Đơn hàng trong bưu cục</a>
          </li>
          <!-- <li>
            <a class="nav-link text-white" href="don-hang-can-lay.php">Đơn hàng cần lấy</a>
          </li> -->
         
          <?php 
          if (session_status() == PHP_SESSION_NONE) {
              session_start();
          }
          $shipper = $_SESSION['shipper'] ?? null;
          require_once '../controller/cls-shipper.php';
          $donhang = new clsShipper();
          $tat_ca_don_hang = $donhang->layTatCaDonHang();
          $so_don = $donhang->demDonHangCanLay($shipper['id']);
          ?>

          <li>
            <a class="nav-link text-white d-flex align-items-center justify-content-between" href="don-hang-can-lay.php">
              Đơn hàng cần lấy
              <?php if ($so_don > 0): ?>
                <span class="badge bg-danger ms-2"><?= $so_don ?></span>
              <?php endif; ?>
            </a>
          </li>

           <li>
            <a class="nav-link text-white" href="don-hang-can-giao.php">Đơn hàng cần giao</a>
          </li>
        </ul>
      </li>
      <hr>

      </li>
       <li class="nav-item">
        <span class="nav-link text-white"><b>Cài đặt</b></span>
        <ul style="list-style:none; padding-left: 1rem; margin-top: 0.5rem;">
          <li>
            <a class="nav-link text-white" href="duyet-don.php">Quản lí tài khoản</a>
          </li>
        </ul>
      </li>
      <hr>

    </ul>
    <hr>
    
  </div>
   <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <script src="../asset/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../asset/css/style.css">