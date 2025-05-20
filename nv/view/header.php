<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['shipper'])) {
    header("Location: login.php");
    exit();
}

$shipper = $_SESSION['shipper'];
?>

<div class="px-3 py-2 border-bottom mb-3 shadow-sm bg-white">
      <div class="container d-flex flex-wrap justify-content-end">
        <div class="text-end">
          Xin chào nhân viên <?= htmlspecialchars($shipper['ho_ten']) ?>!
          <!-- <button type="button" class="btn btn-light text-dark me-2">Đăng nhập</button> -->
          <button type="button" class="btn btn-primary"><a class="text-white" href="logout.php">Đăng xuất</a></button>
        </div>
      </div>
    </div>