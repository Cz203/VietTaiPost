<?php

require_once './config/connectdb.php';
include('models/signup_process.php'); // Nhúng file chứa các function

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new ConnectDB();
    $conn = $db->connectDB1();

    $ho_ten = trim($_POST['ho_ten']);
    $emailorsdt = trim($_POST['emailorsdt']);
    $mat_khau = $_POST['mat_khau'];
    $password_confirm = $_POST['password_confirm'];

    validatePasswords($mat_khau, $password_confirm);
    list($email, $so_dien_thoai) = validateEmailOrPhone($emailorsdt);
    registerUser($conn, $ho_ten, $so_dien_thoai, $email, $mat_khau);


    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Đăng ký</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <link rel="icon" href="https://viettelpost.com.vn/wp-content/uploads/2019/02/fav-icon-vtp.png" />

    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="asset/js/bootstrap.bundle.min.js"></script>

    <link href="./assets/css/site.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow rounded-4">
                    <!-- <p class="signup-title">Tạo tài khoản mới</p> -->
                    <div class="font-size-13 margin-bottom-15 text-semibold margin-bottom-30">
                        <!-- Bạn đã có tài khoản?
                        <a class="color-blue text-semibold" href="login.php">Đăng nhập ngay</a> -->
                        <?php
                        if (!empty($error_message)) {
                            echo '<div class="error-message" style="color: red; margin-top: 10px; text-align:center">' . $error_message . '</div>';
                        }
                        ?>
                        <?php

                        if (isset($_SESSION['error_message'])) {
                            echo '<p style="color: red; text-align:center; margin-top: 5px;">' . $_SESSION['error_message'] . '</p>';
                            unset($_SESSION['error_message']); // Xóa thông báo sau khi hiển thị
                        }
                        ?>
                    </div>
                    <!-- <form method="post" action="" id="registerForm">
                        <div class="login-input-item">
                            <label for="ho_ten">Họ và tên</label>
                            <input type="text" id="ho_ten" tabindex="1" class="form-control" placeholder="Nhập họ và tên" name="ho_ten" />
                            <span class="text-danger" id="user_error"></span>
                        </div>

                        <div class="login-input-item">
                            <label for="emailorsdt">Email / Số điện thoại</label>
                            <div class="position-relative">
                                <input type="text" id="emailorsdt" tabindex="2" class="form-control" placeholder="Nhập email hoặc số điện thoại" name="emailorsdt" oninput="validateLoginInput()" />
                                <div class="text-danger" id="login_error"></div>
                            </div>
                        </div>

                        <div class="login-input-item">
                            <label for="mat_khau">Mật khẩu</label>
                            <div class="position-relative form-group icon-addon addon-right text-left">
                                <input tabindex="3" type="password" id="mat_khau" class="form-control" placeholder="Nhập mật khẩu" name="mat_khau" oninput="validatePassword()" />
                                <button type="button" style="border:none; background:none;" class="fa fa-eye" onclick="togglePassword('mat_khau')"></button>
                                <div class="text-danger" id="password_error"></div>
                            </div>
                        </div>

                        <div class="login-input-item">
                            <label for="password_confirm">Nhập lại mật khẩu</label>
                            <div class="position-relative">
                                <input tabindex="4" type="password" id="password_confirm" class="form-control" placeholder="Nhập mật khẩu" name="password_confirm" />
                                <button type="button" style="border:none; background:none;" class="fa fa-eye" onclick="togglePassword('password_confirm')"></button>
                                <div class="text-danger" id="confirm_password_error"></div>
                            </div>
                        </div>

                        <div class="login-btn">
                            <button type="submit" class="btn">Đăng ký ngay</button>
                        </div>

                        <div class="font-size-12 color-green text-semibold">
                            Nếu quý khách không đăng ký được thông tin tài khoản, vui lòng
                            liên hệ Chăm sóc khách hàng của ViettelPost (1900 8095) để được hỗ trợ.
                        </div>
                        <div class="margin-bottom-30 hide-pc"></div>
                        <div class="font-size-12">
                            Khi nhấn Đăng ký, bạn đã đồng ý thực hiện mọi giao dịch mua bán theo
                            <a class="color-blue" id="dieu_kien_su_dung" href="Dieu-khoan-va-dieu-kien-su-dung-dich-vu.pdf" target="_blank">Điều kiện sử dụng &
                                chính sách</a>
                            của bưu chính Viettel.
                        </div>
                    </form> -->
                    <form method="post" action="" id="registerForm" class="container py-4">
                        <h3 class="text-center mb-4">Tạo tài khoản mới</h3>

                        <!-- Họ và tên -->
                        <div class="mb-3">
                            <label for="ho_ten" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="ho_ten" name="ho_ten" placeholder="Nhập họ và tên" />
                            <div id="user_error" class="form-text text-danger"></div>
                        </div>

                        <!-- Email / Số điện thoại -->
                        <div class="mb-3">
                            <label for="emailorsdt" class="form-label">Email / Số điện thoại</label>
                            <input type="text" class="form-control" id="emailorsdt" name="emailorsdt" placeholder="Nhập email hoặc số điện thoại" oninput="validateLoginInput()" />
                            <div id="login_error" class="form-text text-danger"></div>
                        </div>

                        <!-- Mật khẩu -->
                        <div class="mb-3">
                            <label for="mat_khau" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu" oninput="validatePassword()" />
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('mat_khau')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <div id="password_error" class="form-text text-danger"></div>
                        </div>

                        <!-- Nhập lại mật khẩu -->
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Nhập lại mật khẩu</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Nhập lại mật khẩu" />
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirm')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <div id="confirm_password_error" class="form-text text-danger"></div>
                        </div>

                        <!-- Nút đăng ký -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Đăng ký ngay</button>
                        </div>

                        <!-- Ghi chú hỗ trợ -->
                        <div class="text-center text-success small mb-3 fw-semibold">
                            Nếu quý khách không đăng ký được tài khoản, vui lòng liên hệ Chăm sóc khách hàng ViettelPost (1900 8095).
                        </div>

                        <!-- Điều khoản -->
                        <div class="text-center small">
                            Khi nhấn Đăng ký, bạn đồng ý với
                            <a href="Dieu-khoan-va-dieu-kien-su-dung-dich-vu.pdf" target="_blank" class="text-decoration-underline text-primary">Điều kiện sử dụng & chính sách</a>
                            của bưu chính Viettel.
                        </div>

                        <!-- Nếu đã có tài khoản -->
                        <div class="text-center mt-4">
                            <span>Bạn đã có tài khoản?</span>
                            <a class="text-decoration-underline text-primary fw-semibold" href="login.php">Đăng nhập ngay</a>
                        </div>

                        <!-- Hiển thị lỗi -->
                        <?php if (!empty($error_message)) : ?>
                            <div class="text-center text-danger mt-3"><?= $error_message ?></div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error_message'])) : ?>
                            <div class="text-center text-danger mt-2"><?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
                        <?php endif; ?>
                    </form>


                </div>
            </div>
        </div>

        <!-- <?php
        include './view/layout/footer.html'
        ?> -->
    </div>
    <script src="asset/js/signup_process.js"></script>
    <script>
        function togglePassword(inputId) {
            var input = document.getElementById(inputId);
            var icon = event.currentTarget; // Lấy chính button được click

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash"); // Đổi icon thành "ẩn"
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye"); // Đổi icon thành "hiện"
            }
        }
    </script>
</body>

</html>