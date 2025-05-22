<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('config/connectdb.php');
$db = new ConnectDB();
$conn = $db->connectDB1();
include('models/setting_account.php');
include('models/showToast.php');


showToast();

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $userInfo = getUserContactInfo($user_id, $conn);

    if ($userInfo) {
        $email = $userInfo['email'];
        $so_dien_thoai = $userInfo['so_dien_thoai'];
    } else {
        $email = "Không tìm thấy";
        $so_dien_thoai = "Không tìm thấy";
    }
} else {
    echo "Bạn chưa đăng nhập!";
}
//Đổi mật khẩu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "Bạn chưa đăng nhập!";
        header("Location: index.php");
        exit();
    }

    $id_khachhang = $_SESSION['id'];

    // XỬ LÝ ĐỔI MẬT KHẨU
    if (isset($_POST['change_password'])) {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($newPassword !== $confirmPassword) {
            $_SESSION['toast'] = [
                'type' => 'warning',
                'message' => 'Mật khẩu mới không khớp!',
                'timeout' => 3000
            ];
            header("Location: quan-li-tai-khoan.php");
            exit();
        }

        // Kiểm tra mật khẩu cũ
        $sql = "SELECT mat_khau FROM khachhang WHERE id_khachhang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_khachhang);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();



        if (!$hashedPassword || !password_verify($oldPassword, $hashedPassword)) {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Mật khẩu cũ không chính xác!',
                'timeout' => 3000
            ];
            header("Location: quan-li-tai-khoan.php");
            exit();
        }

        if ($oldPassword === $newPassword) {
            $_SESSION['toast'] = [
                'type' => 'warning',
                'message' => 'Mật khẩu cũ không được trùng mật khẩu mới!',
                'timeout' => 3000
            ];
            header("Location: quan-li-tai-khoan.php");
            exit();
        }

        // Cập nhật mật khẩu mới
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql_update = "UPDATE khachhang SET mat_khau = ? WHERE id_khachhang = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("si", $newHashedPassword, $id_khachhang);

        if ($stmt_update->execute()) {
            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'Đổi mật khẩu thành công!',
                'timeout' => 3000
            ];

            $_SESSION['show_logout_modal'] = true;
            header("Location: quan-li-tai-khoan.php");
            exit();
        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Lỗi khi cập nhật mật khẩu!',
                'timeout' => 3000
            ];
            header("Location: quan-li-tai-khoan.php");
            exit();
        }

        $stmt_update->close();
        header("Location: quan-li-tai-khoan.php");
        exit();
    }
}

// 🟢 XỬ LÝ XÁC NHẬN MẬT KHẨU ĐỂ THAY ĐỔI EMAIL
if (isset($_POST['verify_email'])) {
    $password = $_POST['password_for_email'];

    // Kiểm tra mật khẩu
    $sql = "SELECT mat_khau FROM khachhang WHERE id_khachhang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_khachhang);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    if (!$hashedPassword || !password_verify($password, $hashedPassword)) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Mật khẩu không chính xác!',
            'timeout' => 3000
        ];
        header("Location: quan-li-tai-khoan.php");
        exit();
    }

    // Nếu đúng mật khẩu, cho phép đổi email
    $_SESSION['allow_change_email'] = true;
    $_SESSION['toast'] = [
        'type' => 'info',
        'message' => 'Bạn có thể thay đổi email!',
        'timeout' => 3000
    ];
    header("Location:quan-li-tai-khoan.php");
    exit();
}

if (isset($_POST['verify_sdt'])) {
    $password = $_POST['password_for_sdt'];

    // Kiểm tra mật khẩu
    $sql = "SELECT mat_khau FROM khachhang WHERE id_khachhang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_khachhang);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    if (!$hashedPassword || !password_verify($password, $hashedPassword)) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Mật khẩu không chính xác!',
            'timeout' => 3000
        ];
        header("Location: quan-li-tai-khoan.php");
        exit();
    }

    // Nếu đúng mật khẩu, cho phép đổi email
    $_SESSION['allow_change_sdt'] = true;
    $_SESSION['toast'] = [
        'type' => 'info',
        'message' => 'Bạn có thể thay đổi số điện thoại!',
        'timeout' => 3000
    ];
    header("Location: quan-li-tai-khoan.php");
    exit();
}


if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit();
}

// Lấy email hiện tại từ SESSION
// $email_hientai = $_SESSION['email'] ?? '';

// Xử lý cập nhật email khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "Bạn chưa đăng nhập!";
        header("Location: index.php");
        exit();
    }

    $id_khachhang = $_SESSION['id'];

    // Xử lý cập nhật email
    if (isset($_POST['save_email'])) {
        $email_moi = $_POST['email'];
        $email_hientai = $_SESSION['email']; // Lấy email hiện tại từ SESSION

        if (updateEmail($conn, $id_khachhang, $email_moi, $email_hientai)) {
            header("Location:quan-li-tai-khoan.php");
        } else {
            header("Location:quan-li-tai-khoan.php");
        }
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "Bạn chưa đăng nhập!";
        header("Location: index.php");
        exit();
    }

    $id_khachhang = $_SESSION['id'];

    // Xử lý cập nhật email
    if (isset($_POST['save_sdt'])) {
        $sdt_moi = $_POST['so_dien_thoai'];
        $sdt_hientai = $_SESSION['so_dien_thoai']; // Lấy email hiện tại từ SESSION

        if (updateSDT($conn, $id_khachhang, $sdt_moi, $sdt_hientai)) {
            header("Location:quan-li-tai-khoan.php");
            exit();
        } else {
            header("Location:quan-li-tai-khoan.php");
            exit();
        }
    }
}


// $checkEmail = checkDuplicateEmail($conn, $email);
// $checkPhone = checkDuplicatePhone($conn, $so_dien_thoai);

// if ($checkEmail) {
//     echo $checkEmail; // Email đã tồn tại
// } elseif ($checkPhone) {
//     echo $checkPhone; // Số điện thoại đã tồn tại
// } else {
//     echo "Không bị trùng, có thể tiếp tục!";
// }

$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lí tài khoản</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    .active-tab {
        color: red !important;
        /* Màu chữ đỏ */
        font-weight: bold !important;
        /* Chữ in đậm */

    }

    /* kích thước btn chổ thay đổi vs thêm */
    .btn-fixed {
        min-width: 80px;
        /* Điều chỉnh giá trị này theo mong muốn */
        text-align: center;
    }
</style>
<body  class="d-flex">
    <?php
    require_once 'view/sidebar.php';
    ?>
    
    <div class="main-content">

    <?php
    require_once 'view/header.php';
    ?>
<div class="container px-4 pb-5">

                <div class="vtp-main Container100">

                    <iv class="my-3">
                        <h4 class="title-header">Cấu hình tài khoản</h4>
                    </iv>

                    <div class="row">
                        <div class="col-md-2 col-sm-12 cau-hinh-tai-khoan mb-3">
                            <div class="list-group">
                                <a id="toggleUserInfo" class="list-group-item tab-button">
                                    <i class="fa fa-user"></i> Thông tin tài khoản
                                </a>
                                <a class="list-group-item tab-button" id="toggleTransactionHistory"><i
                                        class="fa fa-lock"></i> Đổi mật khẩu tài khoản </a>

                                <a id="toggleSenderInfo" class="list-group-item tab-button"> <i
                                        class="fa fa-address-card"></i> Cài đặt thông tin người gửi
                                </a>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12">
                            <!---->

                            <!-----------------------------  Thông tin tài khoản ------------------------------------------>
                            <app-user-info id="userInfoSection" style="display: none;" class="ng-star-inserted">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="thong-tin-tai-khoan">

                                            <div class="vicc-title mb-2"> Thông tin tài khoản </div>
                                            <div class="mb-3">
                                                <label class="bold" for="ho_ten">Họ tên</label>
                                                <div class="input-group">
                                                    <input value="<?= htmlspecialchars($_SESSION['ho_ten']) ?>"
                                                        class="form-control" id="ho_ten" name="ho_ten">
                                                </div>
                                            </div>
                                            <!-------------------- input lưu email  ----------------->
                                            <form action="quan-li-tai-khoan.php" method="POST" id="emailForm">
                                                <div class="mb-3">
                                                    <label class="bold" for="email">Email</label>
                                                    <div class="input-group">
                                                        <input value="<?= htmlspecialchars(string: $email) ?>"
                                                            class="form-control" id="email" name="email" type="email"
                                                            <?= isset($_SESSION['allow_change_email']) && $_SESSION['allow_change_email'] ? '' : 'readonly'; ?>
                                                            oninput="toggleSaveButtonEmail()" onblur="validateGmail()">

                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary"
                                                                type="button" id="openModalBtn">
                                                                <?php
                                                                if (empty(htmlspecialchars(string: $email))) {
                                                                    echo 'Thêm';
                                                                } else {
                                                                    echo 'Thay đổi';
                                                                }
                                                                ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span id="emailError" style="color: red; font-size: 14px;"></span>
                                                    <button id="saveEmailBtn" type="submit" name="save_email"
                                                        class="btn btn-success mt-2" style="display: none;">
                                                        Lưu Email
                                                    </button>
                                                </div>
                                            </form>

                                            <!-------------------- input lưu SDT  ----------------->
                                            <form action="quan-li-tai-khoan.php" method="POST" id="phoneForm">
                                                <div class="mb-3">
                                                    <label class="bold" for="so_dien_thoai">Số điện thoại</label>
                                                    <div class="input-group">
                                                        <input value="<?= htmlspecialchars(string: $so_dien_thoai) ?>"
                                                            class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                                                            type="tel"
                                                            <?= isset($_SESSION['allow_change_sdt']) && $_SESSION['allow_change_sdt'] ? '' : 'readonly'; ?>
                                                            oninput="toggleSaveButtonSDT()"
                                                            onblur="validatePhoneNumber()">

                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary"
                                                                type="button" id="openModalBtnSDT">
                                                                <?php
                                                                if (empty(htmlspecialchars(string: $so_dien_thoai))) {
                                                                    echo 'Thêm';
                                                                } else {
                                                                    echo 'Thay đổi';
                                                                }
                                                                ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <span id="phoneError" style="color: red; font-size: 14px;"></span>
                                                    <button id="saveSDTBtn" type="submit" name="save_sdt"
                                                        class="btn btn-success mt-2" style="display: none;">
                                                        Lưu SĐT
                                                    </button>
                                                </div>
                                            </form>
                                            </form>
                                            <div class="form-group"><button class="btn btn-primary">
                                                    <!----> Lưu
                                                </button></div>
                                            <vtp-dialog-confirm>
                                                <!-- //modal thay đổi email -->
                                                <div class="modal fade" id="confirmOtpEmailOrPhone">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <label for="password_for_email"><strong
                                                                        style="font-size: 20px;">Nhập mật khẩu để thay
                                                                        đổi email</strong></label>
                                                                <button class="btn-close" type="button"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="quan-li-tai-khoan.php">
                                                                    <div
                                                                        class="form-group icon-addon addon-right text-left">
                                                                        <input class="form-control mb-0"
                                                                            id="password_for_email"
                                                                            name="password_for_email" maxlength="20"
                                                                            type="password">
                                                                        <button type="button"
                                                                            style="border:none; background:none;"
                                                                            class="fa fa-eye"
                                                                            onclick="togglePassword('password_for_email')"></button>
                                                                    </div>
                                                                    <div class="form-group text-end">
                                                                        <button type="submit" name="verify_email"
                                                                            class="btn btn-outline-danger">Xác
                                                                            nhận</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal thay đổi Số Điện Thoại -->
                                                <div class="modal fade" id="confirmPhone">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <label for="matkhaucu1"><strong
                                                                        style="font-size: 20px;">Nhập
                                                                        mật khẩu để thay
                                                                        đổi</strong></label>
                                                                <button class="btn-close" type="button"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="quan-li-tai-khoan.php" method="POST">
                                                                    <div
                                                                        class="form-group icon-addon addon-right text-left">
                                                                        <input class="form-control mb-0"
                                                                            name="password_for_sdt"
                                                                            id="password_for_sdt" maxlength="20"
                                                                            type="password">
                                                                        <button type="button"
                                                                            style="border:none; background:none;"
                                                                            class="fa fa-eye"
                                                                            onclick="togglePassword('password_for_sdt')"></button>

                                                                    </div>
                                                                    <div class="form-group text-end">
                                                                        <button type="submit"
                                                                            class="btn btn-outline-danger"
                                                                            name="verify_sdt">Xác
                                                                            nhận</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </vtp-dialog-confirm>
                                        </div>

                                    </div>
                                </div>
                            </app-user-info>



                            <div class="col-md-10 col-sm-12" id="transactionHistory" style="display: none;">
                                <change-pass class="ng-star-inserted">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="doi-mat-khau">
                                                <div class="vicc-title mb-2">
                                                    <!----><span class="ng-star-inserted">Thay đổi
                                                        mật khẩu</span>
                                                    <!---->
                                                </div>

                                                <form autocomplete="off" id="userInfoForm" action="quan-li-tai-khoan.php"
                                                    method="POST">
                                                    <div class="form-group">
                                                        <label for="oldPassword">Mật khẩu cũ</label>
                                                        <div class="form-group icon-addon addon-right text-left">
                                                            <input class="form-control mb-0" name="oldPassword"
                                                                id="oldPassword" maxlength="20" type="password">
                                                            <button type="button" style="border:none; background:none;"
                                                                class="fa fa-eye"
                                                                onclick="togglePassword('oldPassword')"></button>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="newPassword">Mật khẩu mới</label>
                                                        <div class="form-group icon-addon addon-right text-left">
                                                            <input class="form-control mb-0" name="newPassword"
                                                                id="newPassword" maxlength="20" type="password"
                                                                onfocus="validatePassword()" onblur="validatePassword()"
                                                                oninput="validatePassword()">
                                                            <button type="button" style="border:none; background:none;"
                                                                class="fa fa-eye"
                                                                onclick="togglePassword('newPassword')"></button>

                                                            <div class="text-danger" id="password_error"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="confirmPassword">Nhập lại mật khẩu mới</label>
                                                        <div class="form-group icon-addon addon-right text-left">
                                                            <input class="form-control mb-0" name="confirmPassword"
                                                                id="confirmPassword" maxlength="20" type="password">
                                                            <button type="button" style="border:none; background:none;"
                                                                class="fa fa-eye"
                                                                onclick="togglePassword('confirmPassword')"></button>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" name="change_password"
                                                            class="btn btn-viettel">Lưu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </change-pass>
                            </div>

                            <!------------------------------- Cập nhật thông tin người gửi ------------------------------->

                            <div class="card" id="senderInfoSettings" style="display: none;">
                                <div class="card-body">
                                    <div class="cau-hinh-kho-hang">
                                        <div class="row mb-3">
                                            <div class="form-group col-md-3">
                                                <div
                                                    class="dropdown bootstrap-select form-control customselect ng-untouched ng-pristine ng-valid">
                                                    <select
                                                        class="form-control selectpicker customselect ng-untouched ng-pristine ng-valid"
                                                        tabindex="-98">
                                                        <option class="vtp-fs-15" value="1">Đang hoạt động </option>
                                                        <option class="vtp-fs-15" value="0">Dừng hoạt động </option>
                                                    </select><button type="button" class="btn dropdown-toggle btn-light"
                                                        data-toggle="dropdown" role="combobox" aria-owns="bs-select-2"
                                                        aria-haspopup="listbox" aria-expanded="false"
                                                        title="Đang hoạt động">
                                                        <div class="filter-option">
                                                            <div class="filter-option-inner">
                                                                <div class="filter-option-inner-inner">Đang hoạt động
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <div class="dropdown-menu "
                                                        style="max-height: 679.4px; overflow: hidden; min-height: 0px;">
                                                        <div class="inner show" role="listbox" id="bs-select-2"
                                                            tabindex="-1" aria-activedescendant="bs-select-2-0"
                                                            style="max-height: 663.4px; overflow-y: auto; min-height: 0px;">
                                                            <ul class="dropdown-menu inner show" role="presentation"
                                                                style="margin-top: 0px; margin-bottom: 0px;">
                                                                <li class="selected active"><a role="option"
                                                                        class="vtp-fs-15 dropdown-item active selected"
                                                                        id="bs-select-2-0" tabindex="0" aria-setsize="2"
                                                                        aria-posinset="1" aria-selected="true"><span
                                                                            class="text">Đang hoạt động </span></a></li>
                                                                <li><a role="option" class="vtp-fs-15 dropdown-item"
                                                                        id="bs-select-2-1" tabindex="0"><span
                                                                            class="text">Dừng hoạt động </span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group vtpsearchcustom col-md-3 d-flex"><img alt=""
                                                    src="/assets/images/icon/search-zoom-in.svg"><input
                                                    class="form-control vtpinputcustom ng-untouched ng-pristine ng-valid"
                                                    placeholder="Nhập họ tên, sđt để tìm kiếm" type="text"></div>
                                            <!---->
                                            <div class="form-group col-md-6 row justify-content-end ng-star-inserted">
                                                <button class="btn btnviettelCmt btnExcelCmt mr-3"><svg fill="none"
                                                        height="20" viewBox="0 0 20 20" width="20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_7895_12766)">
                                                            <path
                                                                d="M4.72925 0.833984C3.59831 0.833984 2.66675 1.76555 2.66675 2.89648V17.1048C2.66675 18.2358 3.59831 19.1673 4.72925 19.1673H15.2709C16.4019 19.1673 17.3334 18.2358 17.3334 17.1048V7.47982C17.3334 7.29749 17.2609 7.12265 17.132 6.99373L17.1248 6.98657L11.1737 1.0354C11.0448 0.906469 10.8699 0.834019 10.6876 0.833984H4.72925ZM4.72925 2.20898H10.0001V6.10482C10.0001 7.23576 10.9316 8.16732 12.0626 8.16732H15.9584V17.1048C15.9584 17.4928 15.6589 17.7923 15.2709 17.7923H4.72925C4.34127 17.7923 4.04175 17.4928 4.04175 17.1048V2.89648C4.04175 2.50851 4.34127 2.20898 4.72925 2.20898ZM11.3751 3.18115L14.9862 6.79232H12.0626C11.6746 6.79232 11.3751 6.4928 11.3751 6.10482V3.18115ZM8.41382 9.54232C8.28144 9.53879 8.14617 9.5736 8.0262 9.64974C7.70629 9.8537 7.61234 10.2783 7.81584 10.5986L9.18547 12.7507L7.81584 14.9027C7.61234 15.223 7.70629 15.6476 8.0262 15.8516C8.14079 15.924 8.26852 15.959 8.39502 15.959C8.62189 15.959 8.84537 15.8465 8.97599 15.6412L10.0001 14.0317L11.0242 15.6403C11.1557 15.8461 11.3783 15.959 11.6051 15.959C11.7316 15.959 11.8589 15.9244 11.9731 15.8516C12.293 15.6476 12.3878 15.2221 12.1843 14.9018L10.8156 12.7507L12.1843 10.5995C12.3878 10.2792 12.293 9.8537 11.9731 9.64974C11.6536 9.44624 11.2286 9.54017 11.0242 9.861L10.0001 11.4696L8.97599 9.86011C8.84852 9.65959 8.63446 9.5482 8.41382 9.54232Z"
                                                                fill="#336D49"></path>
                                                        </g>
                                                        <defs <clipPath id="clip0_7895_12766">
                                                            <rect fill="white" height="20" width="20"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg> &nbsp; Đẩy file excel </button><button
                                                    class="btn btnviettelCmt btnSampleCmt mr-3"><svg fill="none"
                                                        height="20" viewBox="0 0 20 20" width="20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.50008 18.3327H12.5001C16.6667 18.3327 18.3334 16.666 18.3334 12.4993V7.49935C18.3334 3.33268 16.6667 1.66602 12.5001 1.66602H7.50008C3.33341 1.66602 1.66675 3.33268 1.66675 7.49935V12.4993C1.66675 16.666 3.33341 18.3327 7.50008 18.3327Z"
                                                            stroke="#3B7CEC" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="1.5"></path>
                                                        <path d="M7.5 9.5918L10 12.0918L12.5 9.5918" stroke="#3B7CEC"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"></path>
                                                        <path d="M10 12.0924V5.42578" stroke="#3B7CEC"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"></path>
                                                        <path d="M5 13.7598C8.24167 14.8431 11.7583 14.8431 15 13.7598"
                                                            stroke="#3B7CEC" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="1.5"></path>
                                                    </svg> &nbsp; Tải file mẫu </button><button
                                                    class="btnAction btn btnviettelCmt btnAddCmt"><svg fill="none"
                                                        height="20" viewBox="0 0 21 20" width="21"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10.4998 6.66602V13.3327M13.8332 9.99935H7.1665M10.4998 18.3327C15.1022 18.3327 18.8332 14.6017 18.8332 9.99935C18.8332 5.39698 15.1022 1.66602 10.4998 1.66602C5.89746 1.66602 2.1665 5.39698 2.1665 9.99935C2.1665 14.6017 5.89746 18.3327 10.4998 18.3327Z"
                                                            stroke="#EE0033" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="1.5"></path>
                                                    </svg> &nbsp; Thêm người gửi </button>
                                            </div>
                                        </div>
                                        <!---->
                                        <div class="row">
                                            <!---->
                                            <div class="col-md-6 form-group ng-star-inserted">
                                                <div class="card cardCtm">
                                                    <div class="cardHeader p-3">
                                                        <div class="float-left"><svg fill="none" height="20"
                                                                viewBox="0 0 20 20" width="20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="10" cy="10" fill="#EE0033" r="10"></circle>
                                                                <path clip-rule="evenodd"
                                                                    d="M5.19967 13.1536V9.55652L4.64742 10.0023C4.58313 10.0577 4.50847 10.0994 4.42786 10.1252C4.34725 10.1509 4.26235 10.16 4.17818 10.152C4.09401 10.1439 4.01231 10.1189 3.9379 10.0784C3.8635 10.0379 3.79792 9.98276 3.74506 9.91619C3.69219 9.84963 3.65312 9.77303 3.63016 9.69094C3.6072 9.60885 3.60083 9.52294 3.61141 9.43832C3.62199 9.35369 3.64931 9.27207 3.69176 9.19831C3.73421 9.12454 3.79091 9.06013 3.8585 9.0089L5.42814 7.74171L9.42704 4.28339C9.65585 4.0854 9.94734 3.97656 10.2488 3.97656C10.5502 3.97656 10.8417 4.0854 11.0705 4.28339L15.0694 7.74108L16.6391 9.00826C16.7038 9.06052 16.7577 9.12514 16.7977 9.19842C16.8376 9.2717 16.8629 9.3522 16.8721 9.43534C16.8812 9.51848 16.874 9.60262 16.8509 9.68296C16.8279 9.76329 16.7893 9.83826 16.7375 9.90357C16.6857 9.96888 16.6217 10.0233 16.549 10.0636C16.4764 10.1039 16.3966 10.1294 16.3142 10.1387C16.2318 10.1479 16.1484 10.1406 16.0688 10.1173C15.9892 10.0941 15.9149 10.0552 15.8501 10.0029L15.2979 9.55716V12.3958C14.5375 13.7646 13.1651 14.8 11.5111 15.1988V12.6895C11.5111 12.3517 11.3781 12.0278 11.1413 11.7889C10.9046 11.5501 10.5836 11.4159 10.2488 11.4159C9.914 11.4159 9.59294 11.5501 9.35622 11.7889C9.11949 12.0278 8.9865 12.3517 8.9865 12.6895V15.2999C7.43799 15.0578 6.09355 14.2671 5.19967 13.1536Z"
                                                                    fill="white" fill-rule="evenodd"></path>
                                                            </svg> &nbsp; <span class="bold">Cao Việt Đẹo</span></div>
                                                        <div class="float-right d-flex">
                                                            <div mattooltipclass="tool-tip"
                                                                aria-describedby="cdk-describedby-message-17"
                                                                cdk-describedby-host=""
                                                                style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                                                <button class="btnAction" style="border: none;"><svg
                                                                        fill="none" height="24" viewBox="0 0 24 24"
                                                                        width="24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M3 21H21M13.7844 5.31171C13.7844 5.31171 13.7844 6.94634 15.419 8.58096C17.0537 10.2156 18.6883 10.2156 18.6883 10.2156M7.31963 17.9881L10.7523 17.4977C11.2475 17.4269 11.7064 17.1975 12.06 16.8438L20.3229 8.58096C21.2257 7.67818 21.2257 6.21449 20.3229 5.31171L18.6883 3.67708C17.7855 2.77431 16.3218 2.77431 15.419 3.67708L7.15616 11.94C6.80248 12.2936 6.57305 12.7525 6.50231 13.2477L6.01193 16.6804C5.90295 17.4432 6.5568 18.097 7.31963 17.9881Z"
                                                                            stroke="#3B7CEC" stroke-linecap="round"
                                                                            stroke-width="1.5"></path>
                                                                    </svg></button>
                                                            </div>
                                                            <!---->
                                                            <mat-menu class="">
                                                                <!---->
                                                            </mat-menu>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group"><svg fill="none" height="20"
                                                                viewBox="0 0 20 20" width="20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.5 15.8333V14.4617C17.5 13.7802 17.0851 13.1674 16.4523 12.9143L14.7572 12.2362C13.9524 11.9143 13.0352 12.263 12.6475 13.0383L12.5 13.3333C12.5 13.3333 10.4167 12.9167 8.75 11.25C7.08333 9.58333 6.66667 7.5 6.66667 7.5L6.96168 7.35249C7.73698 6.96484 8.08571 6.04761 7.76379 5.2428L7.08574 3.54768C6.83263 2.91492 6.21979 2.5 5.53828 2.5H4.16667C3.24619 2.5 2.5 3.24619 2.5 4.16667C2.5 11.5305 8.46954 17.5 15.8333 17.5C16.7538 17.5 17.5 16.7538 17.5 15.8333Z"
                                                                    stroke="#828282" stroke-linejoin="round"
                                                                    stroke-width="1.5"></path>
                                                            </svg> 0913998110 </div>
                                                        <div class="form-group"><svg fill="none" height="20"
                                                                viewBox="0 0 20 20" width="20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.5 9.07342C17.5 13.1644 12.8125 18.3327 10 18.3327C7.1875 18.3327 2.5 13.1644 2.5 9.07342C2.5 4.98242 5.85786 1.66602 10 1.66602C14.1421 1.66602 17.5 4.98242 17.5 9.07342Z"
                                                                    stroke="#828282" stroke-width="1.5"></path>
                                                                <path
                                                                    d="M12.5 9.16602C12.5 10.5467 11.3807 11.666 10 11.666C8.61929 11.666 7.5 10.5467 7.5 9.16602C7.5 7.7853 8.61929 6.66602 10 6.66602C11.3807 6.66602 12.5 7.7853 12.5 9.16602Z"
                                                                    stroke="#828282" stroke-width="1.5"></path>
                                                            </svg> 51/16A Phạm Văn Chiêu, 51/16A Phạm Văn Chiêu, P.14,
                                                            Q.Gò Vấp, TP.Hồ Chí Minh </div>
                                                        <div class="form-group d-flex">
                                                            <!---->
                                                            <div class="defaultAd mr-2 ng-star-inserted">Địa chỉ mặc
                                                                định</div>
                                                            <!---->
                                                            <div class="adActive ng-star-inserted">Đang hoạt động</div>
                                                            <!---->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>

<script>
        function toggleSaveButtonEmail() {
            let emailInput = document.getElementById("email");
            let saveBtn = document.getElementById("saveEmailBtn");

            if (emailInput.value.trim() !== "") {
                saveBtn.style.display = "block"; // Hiện nút lưu
            } else {
                saveBtn.style.display = "none"; // Ẩn nếu không có email
            }
        }

        function toggleSaveButtonSDT() {
            let SDTInput = document.getElementById("so_dien_thoai");
            let saveBtn = document.getElementById("saveSDTBtn");

            if (SDTInput.value.trim() !== "") {
                saveBtn.style.display = "block"; // Hiện nút lưu
            } else {
                saveBtn.style.display = "none"; // Ẩn nếu không có email
            }
        }
    </script>
    <script src="asset/js/setting_account.js"></script>


    <!-- Modal xác nhận đăng xuất -->
    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Xác nhận
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn muốn duy trì đăng nhập hay đăng xuất?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Duy trì đăng nhập</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='../../logout.php'">Đăng
                        xuất</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        <?php if (isset($_SESSION['show_logout_modal']) && $_SESSION['show_logout_modal']): ?>
            document.addEventListener('DOMContentLoaded', function() {
                var confirmModal = new bootstrap.Modal(document.getElementById('confirmLogoutModal'));
                confirmModal.show();
                <?php unset($_SESSION['show_logout_modal']); ?>
            });
        <?php endif; ?>
    </script>

</body>
</html>


