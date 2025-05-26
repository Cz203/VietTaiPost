<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="px-3 py-2 border-bottom mb-3 shadow-sm bg-white">
      <div class="container d-flex flex-wrap justify-content-end">
        <div class="text-end">
          <?php 
            if(isset($_SESSION['admin']))
            {
                echo 'Xin Chào '.$_SESSION['admin']['ho_ten'];
                echo '<a  class="btn btn-warning m-lg-2" href="logout.php">Đăng xuất</a>';
            }
            else
            {
                echo 1;
            }
          ?>
          <a href=""></a>
        </div>
      </div>
    </div>