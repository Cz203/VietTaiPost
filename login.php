<?php

include('models/login_process.php');

if (isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}

require_once './config/connectdb.php';
$db = new ConnectDB();
$conn = $db->connectDB1();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailorsdt = $_POST["emailorsdt"];
    $mat_khau = $_POST["mat_khau"];

    handleLogin($conn, $emailorsdt, $mat_khau);
}

?>

<!DOCTYPE html>
<html lang="vi">

<>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://viettelpost.com.vn/wp-content/uploads/2019/02/fav-icon-vtp.png">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow rounded-4">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Đăng nhập</h3>

                        <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (isset($_SESSION["error_message"])) {
                            echo "<div class='alert alert-danger text-center'>" . $_SESSION["error_message"] . "</div>";
                            unset($_SESSION["error_message"]);
                        }
                        ?>

                        <form action="" method="post" id="loginForm">
                            <div class="mb-3">
                                <label for="emailorsdt" class="form-label">Email / Số điện thoại</label>
                                <input type="text" class="form-control" id="emailorsdt" name="emailorsdt"
                                    placeholder="Nhập Email hoặc số điện thoại">
                                <span class="text-danger" id="emailorsdt_error"></span>
                            </div>

                            <div class="mb-3 position-relative">
                                <label for="mat_khau" class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="mat_khau" name="mat_khau"
                                        placeholder="Nhập mật khẩu">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="togglePassword('mat_khau')">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <span class="text-danger" id="mat_khau_error"></span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="login-remember-account">
                                    <label class="form-check-label" for="login-remember-account">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                                <a href="#" id="quen_mat_khau" class="text-danger small">Quên mật khẩu?</a>
                            </div>

                            <div class="d-grid mb-3">
                                <button class="btn btn-primary" type="submit" name="button" value="login">
                                    Đăng nhập
                                </button>
                            </div>

                            <div class="text-center">
                                <span>Bạn chưa có tài khoản? </span>
                                <a href="signup.php" class="text-primary fw-semibold">Đăng ký ngay</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <script>
    function togglePassword(inputId) {
        var input = document.getElementById(inputId);
        var icon = event.currentTarget.querySelector('i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    </script>
    <script src="asset/js/login_process.js"></script>
</body>

</html>