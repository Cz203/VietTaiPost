<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ nhân viên</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    require_once '../controller/cls-shipper.php';

    // Xử lý toggle trạng thái
    if (isset($_POST['toggle_status'])) {
        $shipper = new clsShipper();
        $id = $_POST['id'];
        $trang_thai = $_POST['trang_thai'];
        $result = $shipper->toggleTrangThaiHoatDong($id, $trang_thai);

        if ($result['success']) {
            echo "<script>alert('" . $result['message'] . "');</script>";
            // Chuyển hướng để tránh resubmit form
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<script>alert('" . $result['message'] . "');</script>";
        }
    }
    ?>

    <div class="main-content">
        <?php
        require_once 'view/header.php';
        ?>
        <div class="container px-4 pb-5">
            <div class="row">
                <div class="col-12">
                    <h2>Quản lý trạng thái hoạt động</h2>
                    <?php
                    $shipper = new clsShipper();
                    $conn = $shipper->connect();
                    $stmt = $conn->query("SELECT * FROM shipper where id = " . $_SESSION['shipper']['id']);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $is_active = $row['trang_thai'] === 'Đang hoạt động';
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-0">Trạng thái hiện tại:
                                        <span class="badge <?= $is_active ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $row['trang_thai'] ?>
                                        </span>
                                    </h5>
                                </div>
                                <form method="POST"
                                    onsubmit="return confirm('Bạn có chắc muốn <?= $is_active ? 'tắt' : 'bật' ?> hoạt động?');">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="trang_thai" value="<?= $is_active ? 0 : 1 ?>">
                                    <button type="submit" name="toggle_status"
                                        class="btn btn-lg <?= $is_active ? 'btn-warning' : 'btn-success' ?>">
                                        <i class="fas <?= $is_active ? 'fa-toggle-off' : 'fa-toggle-on' ?>"></i>
                                        <?= $is_active ? 'Tắt hoạt động' : 'Bật hoạt động' ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../asset/js/bootstrap.bundle.min.js"></script>
</body>

</html>