<?php
require_once '../controller/cls-admin.php';

session_start();

// Kiểm tra quyền admin
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}



// Xử lý AJAX request để lấy thông tin chi tiết shipper
if (isset($_GET['ajax']) && $_GET['ajax'] === 'getShipperDetail' && isset($_GET['id'])) {
    header('Content-Type: application/json');
    $admin = new clsAdmin();
    $shipper = $admin->getShipperDetail($_GET['id']);

    if ($shipper) {
        echo json_encode(['success' => true, 'shipper' => $shipper]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy thông tin shipper']);
    }
    exit;
}

$admin = new clsAdmin();
$shippers = $admin->getTatCaShipper();
$buuCucs = $admin->getTatCaBuuCuc();

// Xử lý hiển thị thông báo
if (isset($_GET['success']) && $_GET['success'] === 'add') {
    $_SESSION['toast'] = [
        'type' => 'success',
        'message' => 'Thêm shipper thành công!'
    ];
    // Xóa tham số success khỏi URL
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
} elseif (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'upload':
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Lỗi khi tải lên file!'
            ];
            break;
        case 'exists':
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Số điện thoại đã tồn tại!'
            ];
            break;
        default:
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Có lỗi xảy ra!'
            ];
    }
    // Xóa tham số error khỏi URL
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
}


include('../models/showToast.php');
showToast();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/images/logo-viettel.png" type="image/x-icon" />
    <title>Quản lý Shipper - Viettel Post</title>
    <link rel="stylesheet" href="../../assets/boostrap_css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/admincss.css">
    <style>
    .shipper-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .shipper-table th,
    .shipper-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .shipper-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-active {
        background-color: #28a745;
        color: white;
    }

    .status-inactive {
        background-color: #6c757d;
        color: white;
    }

    .status-blocked {
        background-color: #dc3545;
        color: white;
    }

    .search-box {
        margin-bottom: 20px;
    }

    .action-buttons .btn {
        margin-right: 5px;
    }
    </style>
</head>

<body class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    ?>

    <div class="main-content">
        <!-- Sidebar -->

        <?php
        require_once 'view/header.php';
        ?>


        <!-- Main Content -->
        <div class="container px-4 pb-5 card border rounded-5 mt-5">
            <!-- Header -->
            <!-- Content Area -->
            <div class="text-center mt-4">
                <h2>Danh sách Shipper</h2>
                <hr>
            </div>

            <div class="mb-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addShipperModal">
                    <i class="fas fa-plus"></i> Thêm Shipper
                </button>
            </div>

            <!-- Shipper Table -->
            <div class="table-responsive">
                <table class="shipper-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ và tên</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Lần đăng nhập cuối</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($shippers as $index => $shipper): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($shipper['ho_ten']); ?></td>
                            <td><?php echo htmlspecialchars($shipper['so_dien_thoai']); ?></td>
                            <td>
                                <?php
                                    $statusClass = '';
                                    switch ($shipper['trang_thai']) {
                                        case 'Đang hoạt động':
                                            $statusClass = 'status-active';
                                            break;
                                        case 'Không hoạt động':
                                            $statusClass = 'status-inactive';
                                            break;
                                    }
                                    ?>
                                <span id="status-<?php echo $shipper['id']; ?>"
                                    class="status-badge <?php echo $statusClass; ?>">
                                    <?php echo htmlspecialchars($shipper['trang_thai']); ?>
                                </span>
                            </td>
                            <td><?php
                                    echo $shipper['last_login']
                                        ? date('d/m/Y H:i', strtotime($shipper['last_login']))
                                        : 'Chưa đăng nhập';
                                    ?></td>

                            </td>
                            <td class="action-buttons">
                                <button class="btn btn-info btn-sm"
                                    onclick="viewShipper(<?php echo $shipper['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Shipper -->
    <div class="modal fade" id="addShipperModal" tabindex="-1" aria-labelledby="addShipperModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addShipperModalLabel">Thêm Shipper Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../models/admin/listEmployees.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="hoTen" class="form-label">Họ và tên <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="hoTen" name="ho_ten" required>
                            </div>
                            <div class="col-md-6">
                                <label for="soDienThoai" class="form-label">Số điện thoại <span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="soDienThoai" name="so_dien_thoai"
                                    pattern="[0-9]{10}" required>
                                <div class="form-text">Nhập 10 chữ số</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="matKhau" class="form-label">Mật khẩu <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="matKhau" name="mat_khau" minlength="6"
                                    required>
                                <div class="form-text">Tối thiểu 6 ký tự</div>
                            </div>
                            <div class="col-md-6">
                                <label for="xacNhanMatKhau" class="form-label">Xác nhận mật khẩu <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="xacNhanMatKhau" name="xac_nhan_mat_khau"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cccdTruoc" class="form-label">CCCD mặt trước <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="cccdTruoc" name="cccd_truoc"
                                    accept="image/*" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cccdSau" class="form-label">CCCD mặt sau <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="cccdSau" name="cccd_sau" accept="image/*"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="bangLaiXe" class="form-label">Bằng lái xe <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="bangLaiXe" name="bang_lai_xe"
                                    accept="image/*" required>
                            </div>
                            <div class="col-md-6">
                                <label for="giayDkXe" class="form-label">Giấy đăng ký xe <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="giayDkXe" name="giay_dk_xe" accept="image/*"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="id_buu_cuc" class="form-label">Chọn bưu cục</label>
                            <select class="form-select" id="id_buu_cuc" name="id_buu_cuc">
                                <?php foreach ($buuCucs as $buuCuc): ?>
                                <option value="<?= htmlspecialchars($buuCuc['id']) ?>">
                                    <?= htmlspecialchars($buuCuc['ten_buu_cuc']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Lưu ý:
                                    <ul class="mb-0">
                                        <li>Tất cả các trường có dấu <span class="text-danger">*</span> là bắt buộc</li>
                                        <li>Ảnh phải rõ ràng, không bị mờ hoặc che khuất thông tin</li>
                                        <li>Kích thước ảnh tối đa: 5MB</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Thêm Shipper</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Xem Chi Tiết Shipper -->
    <div class="modal fade" id="viewShipperModal" tabindex="-1" aria-labelledby="viewShipperModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewShipperModalLabel">Thông Tin Chi Tiết Shipper</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Họ và tên:</label>
                            <p id="view_ho_ten"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Số điện thoại:</label>
                            <p id="view_so_dien_thoai"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Bưu cục:</label>
                            <p id="view_buu_cuc"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Trạng thái:</label>
                            <p id="view_trang_thai"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">CCCD mặt trước:</label>
                            <img id="view_cccd_truoc" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">CCCD mặt sau:</label>
                            <img id="view_cccd_sau" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Bằng lái xe:</label>
                            <img id="view_bang_lai_xe" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Giấy đăng ký xe:</label>
                            <img id="view_giay_dk_xe" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../../assets/boostrap_js/bootstrap.bundle.min.js"></script>
    <script>
    // Hàm xem chi tiết shipper
    function viewShipper(id) {
        // Gọi AJAX để lấy thông tin shipper
        fetch(`?ajax=getShipperDetail&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const shipper = data.shipper;
                    // Hiển thị thông tin
                    document.getElementById('view_ho_ten').textContent = shipper.ho_ten;
                    document.getElementById('view_so_dien_thoai').textContent = shipper.so_dien_thoai;
                    document.getElementById('view_buu_cuc').textContent = shipper.ten_buu_cuc;
                    document.getElementById('view_trang_thai').textContent = shipper.trang_thai;

                    // Hiển thị hình ảnh
                    document.getElementById('view_cccd_truoc').src = '../' + shipper.cccd_truoc;
                    document.getElementById('view_cccd_sau').src = '../' + shipper.cccd_sau;
                    document.getElementById('view_bang_lai_xe').src = '../' + shipper.bang_lai_xe;
                    document.getElementById('view_giay_dk_xe').src = '../' + shipper.giay_dk_xe;

                    // Hiển thị modal
                    new bootstrap.Modal(document.getElementById('viewShipperModal')).show();
                } else {
                    alert('Không thể lấy thông tin shipper');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi lấy thông tin shipper');
            });
    }

    // Hàm sửa thông tin shipper
    function editShipper(id) {
        // Implement edit functionality
        console.log('Edit shipper:', id);
    }

    // Hàm xóa shipper
    function deleteShipper(id) {
        if (confirm('Bạn có chắc chắn muốn xóa shipper này?')) {
            // Implement delete functionality
            console.log('Delete shipper:', id);
        }
    }

    // Xử lý tìm kiếm
    document.querySelector('.search-box input').addEventListener('input', function(e) {
        const searchText = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.shipper-table tbody tr');

        rows.forEach(row => {
            const name = row.children[1].textContent.toLowerCase();
            const phone = row.children[2].textContent.toLowerCase();

            if (name.includes(searchText) || phone.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Kiểm tra mật khẩu khớp nhau
    document.getElementById('xacNhanMatKhau').addEventListener('input', function() {
        const matKhau = document.getElementById('matKhau').value;
        const xacNhanMatKhau = this.value;

        if (matKhau !== xacNhanMatKhau) {
            this.setCustomValidity('Mật khẩu không khớp');
        } else {
            this.setCustomValidity('');
        }
    });

    // Kiểm tra kích thước file
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) { // 5MB
                    alert('Kích thước file không được vượt quá 5MB');
                    this.value = '';
                }
            }
        });
    });


    // Reload trang mỗi 5 giây
    setTimeout(function() {
        window.location.reload();
    }, 5000);
    </script>
</body>

</html>