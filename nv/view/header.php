<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['shipper'])) {
  header('Location: /viettaipost/nv/login.php');
  exit;
}

$shipper = $_SESSION['shipper'];
?>

<div class="px-3 py-2 border-bottom mb-3 shadow-sm bg-white">
    <div class="container d-flex flex-wrap justify-content-end">
        <div class="text-end">
            Xin chào nhân viên <?= htmlspecialchars($shipper['ho_ten']) ?>!
            <!-- <button type="button" class="btn btn-light text-dark me-2">Đăng nhập</button> -->
            <button type="button" class="btn btn-primary"><a class="text-white" href="/viettaipost/nv/logout.php">Đăng
                    xuất</a></button>
        </div>
    </div>
</div>

<script>
    const idShipper = <?php echo $shipper['id']; ?>;
    const socket = new WebSocket('ws://localhost:8080'); // đổi port nếu khác

    socket.onopen = () => {
        console.log('Đã kết nối WebSocket');

        // Cập nhật vị trí mỗi 5 giây
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(position => {
                const data = {
                    id: idShipper,
                    vi_do: position.coords.latitude,
                    kinh_do: position.coords.longitude
                };
                socket.send(JSON.stringify(data));
            });
        }, 5000);
    };

    socket.onerror = (err) => {
        console.error('Lỗi WebSocket:', err);
    };
</script>
