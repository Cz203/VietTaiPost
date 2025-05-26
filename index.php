<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viettel Post -Tổng Công ty cổ phần bưu chính Viettel</title>
    <link rel="shortcut icon" href="https://viettelpost.com.vn/wp-content/themes/viettel/images/favicon.ico"
        type="image/x-icon" />
    <link href="https://viettelpost.com.vn/wp-content/themes/viettel/assets/fonts/css/font-awesome.min.css"
        rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://viettelpost.com.vn/wp-content/themes/viettel/style.css" rel="stylesheet" type="text/css" />
    <link href="https://viettelpost.com.vn/wp-content/themes/viettel/assets/css/support_fixed.css" rel="stylesheet"
        type="text/css" />
</head>
<style>
body {
    font-family: Arial, sans-serif;
}

.user-menu {
    position: relative;
    display: inline-block;
}

.user-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #ccc;
    margin-top: 11px;
    margin-left: 20px;
    margin-bottom: 10px;
    border: none;
}

.dropdown {
    display: none;
    position: absolute;
    right: 0;
    background: white;
    min-width: 150px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    overflow: hidden;
    z-index: 100;
}

.dropdown a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: black;
}

.dropdown a:hover {
    background: #f1f1f1;
}
</style>

<body>
    <header>
        <div class="top-hd">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 cot1">
                        <span id="mn">MENU</span>
                    </div>
                    <div class="col-md-6 logo">
                        <a href="/" alt="">
                            <img src="https://viettelpost.com.vn/wp-content/uploads/2022/03/Group-5934.png">
                        </a>
                    </div>
                    <div class="col-md-3 form-hd col-right">
                        <form action="/" method="get">
                            <input type="text" placeholder="Tìm kiếm" name="s">
                            <button type="submit" value=""><i class="fa fa-search"></i></button>
                        </form>
                        <?php

                        if (isset($_SESSION['id'])) {
                            $id = $_SESSION['id'];
                        } else {
                            $id = null; // Hoặc giá trị mặc định khác
                        }

                        if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
                            $role = $_SESSION['role']; // Lấy vai trò của user
                            echo '<div class="user-menu">
                                    <img src="/Transport_Management/assets/images/icon-user.png" alt="User" class="user-icon" onclick="toggleDropdown()">
                                    <div class="dropdown" id="userDropdown">';

                            // Nếu là khách hàng
                            if ($role === 'khachhang') {
                                echo '<a href="/viettaipost/trang-chu.php" target="_blank">Trang cá nhân</a>';
                            }
                            // Nếu là admin
                            elseif ($role === 'admin') {
                                echo '<a href="/viettaipost/admin/dashboard.php" target="_blank">Trang cá nhân</a>';
                                echo '<a href="/viettaipost/admin/quan-li-shipper.php">Trang quản lý</a>';
                            }
                            // Nếu là nhân viên
                            elseif ($role === 'nhanvien') {
                                echo '<a href="/Transport_Management/view/employees/dashboard.php" target="_blank">Trang cá nhân</a>';
                                echo '<a href="/Transport_Management/view/employees/orders.php">Quản lý đơn hàng</a>';
                            }

                            // Nút đăng xuất chung cho tất cả vai trò
                            echo '<a href="logout.php" style="color:red;">Đăng xuất</a>
                                  </div>
                                  </div>';
                        } else {
                            echo '<ul class="login">';
                            echo '<li><a href="login.php" target="_blank">Đăng ký / Đăng nhập</a></li>';
                        }
                        echo '</ul>';


                        ?>

                    </div>
                </div>

            </div>
        </div>
        <div class="menu">
            <div class="container">
                <div class="menu-main-menu-container">
                    <ul id="menu-main-menu" class="main-mn position-relative">
                        <li id="menu-item-9498"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-816 current_page_item menu-item-9498">
                            <a href="https://viettelpost.com.vn/" aria-current="page">Trang chủ</a>
                        </li>
                        <li id="menu-item-12490"
                            class="megaparent menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12490">
                            <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/">Dịch vụ</a>
                            <ul class="sub-menu">
                                <li id="menu-item-15898"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-15898">
                                    <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-trong-nuoc/">Dịch
                                        vụ trong nước</a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-12487"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12487">
                                            <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-tai-lieu/">Chuyển
                                                phát nhanh hàng hóa, tài liệu</a>
                                        </li>
                                        <li id="menu-item-12060"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12060">
                                            <a href="https://viettelpost.com.vn/dich_vu/van-chuyen-hoa-toc/">Chuyển phát
                                                Hoả tốc, hẹn giờ</a>
                                        </li>
                                        <li id="menu-item-13510"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-13510">
                                            <a
                                                href="https://viettelpost.com.vn/dich_vu/chuyen-phat-thuong-mai-dien-tu/">Chuyển
                                                phát Thương mại điện tử</a>
                                        </li>
                                        <li id="menu-item-13511"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-13511">
                                            <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-tiet-kiem/">Chuyển
                                                phát Tiết kiệm hàng hóa</a>
                                        </li>
                                        <li id="menu-item-13509"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-13509">
                                            <a href="https://viettelpost.com.vn/dich_vu/phan-loai-hang-dac-biet/">Phân
                                                loại hàng hóa đặc biệt</a>
                                        </li>
                                        <li id="menu-item-12488"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12488">
                                            <a href="https://viettelpost.com.vn/dich_vu/dich-vu-cong-them/">Dịch vụ cộng
                                                thêm</a>
                                        </li>
                                        <li id="menu-item-15979"
                                            class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-15979">
                                            <a
                                                href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/quan-ly-chat-luong-dich-vu/">Quản
                                                lý chất lượng dịch vụ</a>
                                        </li>
                                        <li id="menu-item-12074"
                                            class="mega_more menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12074">
                                            <a
                                                href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-trong-nuoc/">Xem
                                                thêm</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id="menu-item-12492"
                                    class="mega menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12492">
                                    <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-quoc-te/">Dịch
                                        vụ quốc tế</a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-13966"
                                            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-13966">
                                            <a href="https://viettelpost.com.vn/tin-moi-nhat/">men mới nhất</a>
                                        </li>
                                        <li id="menu-item-12957"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12957">
                                            <a
                                                href="https://viettelpost.com.vn/dich_vu/chuyen-phat-quoc-te-chi-dinh-hang-ups/">Chuyển
                                                Phát Quốc Tế UPS</a>
                                        </li>
                                        <li id="menu-item-12062"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12062">
                                            <a
                                                href="https://viettelpost.com.vn/dich_vu/chuyen-phat-quoc-te-chi-dinh-hang/">Chuyển
                                                phát Quốc tế DHL</a>
                                        </li>
                                        <li id="menu-item-12063"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12063">
                                            <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-quoc-te-nhanh/">Chuyển
                                                phát Quốc tế VQN</a>
                                        </li>
                                        <li id="menu-item-14730"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14730">
                                            <a href="https://viettelpost.com.vn/dich-vu-thong-quan/">Dịch vụ thông
                                                quan</a>
                                        </li>
                                        <li id="menu-item-12076"
                                            class="mega_more menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12076">
                                            <a
                                                href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-quoc-te/">Xem
                                                thêm</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id="menu-item-12491"
                                    class="mega menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12491">
                                    <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/">Dịch
                                        vụ logistic</a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-12509"
                                            class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12509">
                                            <a
                                                href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/dich-vu-kho/kho-thuong-duoi-500m2/">Kho
                                                thường dưới 500m2</a>
                                        </li>
                                        <li id="menu-item-12510"
                                            class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12510">
                                            <a
                                                href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/dich-vu-kho/kho-thuong-tren-500m2/">Kho
                                                thường trên 500m2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id="menu-item-12494"
                                    class="mega menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12494">
                                    <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/thuong-mai-dien-tu/">Thương
                                        mại điện tử</a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-12066"
                                            class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12066">
                                            <a href="https://viettelpost.com.vn/dich_vu/dich-vu-ban-ve-may-bay-vtbay/">Dịch
                                                vụ bán vé máy bay (VTBay)</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li id="menu-item-14785"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-14785">
                            <a href="#">Viettel++</a>
                            <ul class="sub-menu">
                                <li id="menu-item-14788"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14788"><a
                                        href="https://viettelpost.com.vn/gioi-thieu-viettel/">Giới thiệu Viettel++</a>
                                </li>
                                <li id="menu-item-14786"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14786"><a
                                        href="https://viettelpost.com.vn/tieu-chi-xet-hang-hoi-vien/">Tiêu chí xét
                                        hạng</a></li>
                                <li id="menu-item-14787"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14787"><a
                                        href="https://viettelpost.com.vn/quyen-loi-hoi-vien/">Quyền lợi hội viên</a>
                                </li>
                            </ul>
                        </li>
                        <li id="menu-item-9439"
                            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-9439">
                            <a href="https://viettelpost.com.vn/tin-tuc/">Tin tức</a>
                            <ul class="sub-menu">
                                <li id="menu-item-9442"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9442">
                                    <a href="https://viettelpost.com.vn/tin-hoat-dong/">Tin hoạt động</a>
                                </li>
                                <li id="menu-item-9441"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9441">
                                    <a href="https://viettelpost.com.vn/tin-khuyen-mai/">Tin khuyến mãi</a>
                                </li>
                                <li id="menu-item-9440"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9440">
                                    <a href="https://viettelpost.com.vn/tin-dau-thau/">Tin đấu thầu</a>
                                </li>
                                <li id="menu-item-9443"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9443">
                                    <a href="https://viettelpost.com.vn/huong-dan-su-dung/">Hướng dẫn sử dụng</a>
                                </li>
                                <li id="menu-item-17551"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-17551">
                                    <a href="https://viettelpost.com.vn/tin-tuc/bi-kip-trieu-don/">Bí kíp triệu đơn</a>
                                </li>
                            </ul>
                        </li>
                        <li id="menu-item-9471"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9471">
                            <a href="#">Ứng dụng số</a>
                            <ul class="sub-menu">
                                <li id="menu-item-9474"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9474"><a
                                        target="_blank" href="https://appviettelpost.page.link/app">ViettelPost App</a>
                                </li>
                                <li id="menu-item-9475"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9475"><a
                                        target="_blank" href="https://viettelsale.com/">ViettelSale</a></li>
                                <li id="menu-item-9476"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9476"><a
                                        target="_blank" href="https://ads.viettelsale.com/">Quảng cáo số</a></li>
                            </ul>
                        </li>
                        <li id="menu-item-9479"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9479">
                            <a href="#">Hỗ trợ khách hàng</a>
                            <ul class="sub-menu">
                                <li id="menu-item-12219"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12219"><a
                                        href="https://viettelpost.com.vn/page-huong-dan-su-dung/">Hướng dẫn sử dụng</a>
                                </li>
                                <li id="menu-item-12414"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12414"><a
                                        href="https://viettelpost.com.vn/gui-khieu-nai/">Gửi thông tin khiếu nại</a>
                                </li>
                                <li id="menu-item-12417"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12417"><a
                                        href="https://viettelpost.com.vn/gop-y/">Góp ý sản phẩm dịch vụ</a></li>
                                <li id="menu-item-9676"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9676"><a
                                        href="https://viettelpost.com.vn/lien-he/">Liên hệ</a></li>
                                <li id="menu-item-16022"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-16022"><a
                                        href="https://viettelpost.com.vn/thong-tin-ho-tro-khach-hang/">Thông tin hỗ trợ
                                        khách hàng</a></li>
                            </ul>
                        </li>
                        <li id="menu-item-9444"
                            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-9444">
                            <a href="https://viettelpost.com.vn/quan-he-co-dong/">Quan hệ cổ đông</a>
                            <ul class="sub-menu">
                                <li id="menu-item-9433"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9433"><a
                                        href="https://viettelpost.com.vn/gioi-thieu/">Về ViettelPost</a></li>
                                <li id="menu-item-9445"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9445">
                                    <a href="https://viettelpost.com.vn/dai-hoi-dong-co-dong/">Đại hội đồng cổ đông</a>
                                </li>
                                <li id="menu-item-9446"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9446">
                                    <a href="https://viettelpost.com.vn/dieu-le-tong-cong-ty/">Điều lệ tổng công ty</a>
                                </li>
                                <li id="menu-item-9447"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9447">
                                    <a href="https://viettelpost.com.vn/bao-cao-tai-chinh/">Báo cáo tài chính</a>
                                </li>
                                <li id="menu-item-9448"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9448">
                                    <a href="https://viettelpost.com.vn/bao-cao-thuong-nien/">Báo cáo thường niên</a>
                                </li>
                                <li id="menu-item-13129"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-13129">
                                    <a href="https://viettelpost.com.vn/bao-cao-quan-tri-cong-ty/">Báo cáo quản trị công
                                        ty</a>
                                </li>
                                <li id="menu-item-9450"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9450">
                                    <a href="https://viettelpost.com.vn/tin-co-dong/">Tin cổ đông</a>
                                </li>
                                <li id="menu-item-9449"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9449">
                                    <a href="https://viettelpost.com.vn/thong-tin-bao-chi/">Thông tin báo chí</a>
                                </li>
                                <li id="menu-item-9451"
                                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9451">
                                    <a href="https://viettelpost.com.vn/tin-doanh-nghiep/">Tin doanh nghiệp</a>
                                </li>
                            </ul>
                        </li>
                        <li id="menu-item-9452"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9452"><a
                                href="https://viettelpost.com.vn/tuyen-dung/">Tuyển dụng</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://viettelpost.com.vn/wp-content/themes/viettel/assets/css/home.css" rel="stylesheet"
        type="text/css" />
    <link href="https://viettelpost.com.vn/wp-content/themes/viettel/css/danhmucdichvu.css" rel="stylesheet"
        type="text/css" />
    <section id="bn">
        <div class="owl-carousel owl-theme" data-item="1" data-dot="true" data-autoplay="true">
            <div class="item">
                <a href="https://viettelpost.com.vn/tin-hoat-dong/giao-hang-xuyen-tet-2025-tet-tuoi-co-vipo/">
                    <img src="https://viettelpost.com.vn/wp-content/uploads/2025/01/web-banner.jpg" alt=""
                        class="lz"></a>
                </a>
            </div>
            <div class="item">
                <a
                    href="https://viettelpost.com.vn/tin-tuc/dam-bao-dong-tien-voi-tinh-nang-rut-tien-cod-tu-viettel-post/">
                    <img src="https://viettelpost.com.vn/wp-content/uploads/2025/01/Banner-web-1920x600-1.png" alt=""
                        class="lz"></a>
                </a>
            </div>
            <div class="item">
                <a href="https://viettelpost.com.vn/tin-tuc/vtp_gttt_goglobal/">
                    <img src="https://viettelpost.com.vn/wp-content/uploads/2024/10/BANNER-WEB.png" alt=""
                        class="lz"></a>
                </a>
            </div>
            <div class="item">
                <a
                    href="https://viettelpost.com.vn/tin-tuc/dich-vu-hoan-cuoc-viettel-post-hoan-100-voi-moi-nguyen-nhan/">
                    <img src="https://viettelpost.com.vn/wp-content/uploads/2024/11/Banner-web-scaled.jpg" alt=""
                        class="lz"></a>
                </a>
            </div>
            <div class="item">
                <a href="https://viettelpost.com.vn/tin-hoat-dong/so-hoa-hop-dong-giao-don-cod-an-tam/">
                    <img src="https://viettelpost.com.vn/wp-content/uploads/2024/07/banner-web.png" alt=""
                        class="lz"></a>
                </a>
            </div>
        </div>
    </section>
    <img src="./assets/images/Banner-web-1920x600-1.png" alt="">
    <section id="s1">
        <div class="container">
            <ul class="u1">
                <li class="att acti" data-title="one">Tra cứu </li>
                <li class="att" data-title="two">Dịch vụ</li>
            </ul>
            <div class="ct-tracuu one">
                <ul class="u2">
                    <li data-title="ct1" class="active">
                        Tra cứu vận đơn
                    </li>
                    <li data-title="ct2">
                        Ước tính cước phí
                    </li>
                    <li data-title="ct3">
                        Tìm kiếm bưu cục
                    </li>
                    <li data-title="ct5">
                        Câu hỏi thường gặp FAQs
                    </li>
                    <li data-title="ct4">
                        Đăng ký đại lý thu gom
                    </li>
                </ul>
                <div class="ct-u2 ct1 tab1">
                    <iframe id="trackingIframe"
                        src="https://viettelpost.com.vn/viettelpost-iframe/tra-cuu-hanh-trinh-don-hang-v3-recaptcha"
                        width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div><!-- ct2 -->

                <div class="ct-u2 ct4">
                    <div>
                        <div>
                            <p>
                                <strong>Đăng ký làm đại lý thu gom</strong> <br> <br>
                                Viettel Post là doanh nghiệp hàng đầu cung cấp dịch vụ chuyển phát hàng hoá, bưu kiện
                                trong nước và quốc tế tại Việt Nam. Với mạng lưới rộng khắp 63 tỉnh thành trong nước.
                                Bưu chính Viettel cam kết cung cấp mọi giải phảp vận chuyển tối ưu nhất cho khách hàng
                                với phương châm “NHANH, AN TOÀN, HIỆU QUẢ”.<br />
                                <br />
                                Nhằm mục đích mở rộng mạng lưới phủ trên toàn quốc. Bưu chính Viettel tuyển dụng đơn vị,
                                cá nhân có mặt bằng phù hợp để làm đại lý nhận, chuyển phát hàng hoá trên toàn quốc.
                            </p>
                            <a href="/dang-ky-dai-ly-thu-gom/">
                                <button type="submit" class="d-send">Đăng ký</button>
                            </a>
                        </div>
                        <img src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/img2.png">
                    </div>
                </div><!-- ct3 -->
                <div class="ct-u2 ct5" style="display:none">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 style="font-size:24px;font-weight:bold" class="mb-2">
                                Câu hỏi thường gặp FAQs
                            </h2>
                            <p class="mb-5">
                                Giải đáp những câu hỏi/ thắc mắc thường gặp của khách hàng tại Viettel Post
                            </p>
                            <a href="/cau-hoi-thuong-gap/">
                                <button type="submit" class="btn-danger-lg">Xem ngay</button>
                            </a>
                        </div>
                        <img src="https://viettelpost.com.vn/wp-content/uploads/2024/05/customer-package.png"
                            width="320px">
                    </div>
                </div>
            </div><!-- ct-tracuu -->
            <div class="ct-tracuu two">
                <div class="row">
                    <div class="col-md-8">
                        <div class="search-group">
                            <input type="text" name="" placeholder="Tìm kiếm..." id="ipt-search-service">
                            <button id="btn-search-service">
                                <img src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon2.png">
                            </button>
                        </div>
                        <div class="list-item service">
                            <div class="item">
                                <div>
                                    <img
                                        src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon1.png">
                                    <p class="p1">Chuyển phát nhanh hàng hóa, tài liệu</p>
                                    <p class="p2">
                                        Là dịch vụ nhận gửi, vận chuyển và phát các loại thư, tài liệu, thư từ trong
                                        nước theo chỉ tiêu thời gian tiêu chuẩn. Không áp dụng với các đơn hàng có thu
                                        hộ COD. </p>
                                    <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-tai-lieu/">
                                        <span>Chi tiết</span>
                                        <img
                                            src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon3.png">
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div>
                                    <img src="https://viettelpost.com.vn/wp-content/uploads/2017/07/Group-905.png">
                                    <p class="p1">Chuyển phát Hoả tốc, hẹn giờ</p>
                                    <p class="p2">
                                        Là dịch vụ nhận gửi, vận chuyển và phát nhanh chứng từ hàng hóa, vật phẩm có thứ
                                        tự ưu tiên cao nhất trong các dịch vụ chuyển phát với chỉ tiêu thời gian toàn
                                        trình không quá 24 giờ. </p>
                                    <a href="https://viettelpost.com.vn/dich_vu/van-chuyen-hoa-toc/">
                                        <span>Chi tiết</span>
                                        <img
                                            src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon3.png">
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div>
                                    <img
                                        src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon1.png">
                                    <p class="p1">Chuyển phát Tiết kiệm</p>
                                    <p class="p2">
                                        I. ĐỊNH NGHĨA Dịch vụ Chuyển phát tiết kiệm là dịch vụ nhận gửi, vận chuyển và
                                        phát các loại hàng hóa, bưu phẩm, bưu kiện trong nước, không giới hạn mức trọng
                                        lượng, theo chỉ tiêu thời gian tiêu chuẩn, giá cước hợp lý. Bảng giá không áp
                                        dụng với các đơn hàng có thu [&hellip;] </p>
                                    <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-tiet-kiem/">
                                        <span>Chi tiết</span>
                                        <img
                                            src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon3.png">
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div>
                                    <img
                                        src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon1.png">
                                    <p class="p1">Chuyển phát Thương mại điện tử</p>
                                    <p class="p2">
                                        I. ĐỊNH NGHĨA Dịch vụ Chuyển phát Thương mại điện tử là dịch vụ giao hàng thu
                                        tiền, nhận gửi, vận chuyển hàng hóa, vật phẩm với thời gian tối ưu, áp dụng cho
                                        khách hàng kinh doanh online và offline trên toàn quốc. Dịch vụ cung cấp nhiều
                                        ưu đãi liên quan đến phí thu [&hellip;] </p>
                                    <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-thuong-mai-dien-tu/">
                                        <span>Chi tiết</span>
                                        <img
                                            src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon3.png">
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div>
                                    <img
                                        src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon1.png">
                                    <p class="p1">Phân loại hàng hóa đặc biệt</p>
                                    <p class="p2">
                                        I. ĐỊNH NGHĨA Bảng phân loại hàng hóa đặc biệt là danh sách phân loại các hàng
                                        hóa đặc biệt trong quá trình tiếp nhận, vận chuyển và phát tới tay khách hàng.
                                        Quy định nêu rõ về các loại hình hàng hóa đặc biệt, quá trình tiếp nhận, đóng
                                        gói, quy định về tem [&hellip;] </p>
                                    <a href="https://viettelpost.com.vn/dich_vu/phan-loai-hang-dac-biet/">
                                        <span>Chi tiết</span>
                                        <img
                                            src="https://viettelpost.com.vn/wp-content/themes/viettel/images/home/icon3.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sidebar-header">Danh mục dịch vụ</div>
                        <div class="sidebar-service">
                            <div class="menu-menu-dich-vu-container">
                                <ul id="service-menu" class="service-menu ml-0 pl-0">
                                    <li id="menu-item-12795"
                                        class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12795">
                                        <a
                                            href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-trong-nuoc/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2021/11/trongnuoc.png"
                                                alt="Dịch vụ trong nước">Dịch vụ trong nước</a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-12673"
                                                class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12673">
                                                <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-tai-lieu/">Chuyển
                                                    phát nhanh hàng hóa, tài liệu</a>
                                            </li>
                                            <li id="menu-item-12041"
                                                class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12041">
                                                <a href="https://viettelpost.com.vn/dich_vu/van-chuyen-hoa-toc/">Chuyển
                                                    phát Hoả tốc (VHT)</a>
                                            </li>
                                            <li id="menu-item-12676"
                                                class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12676">
                                                <a href="https://viettelpost.com.vn/dich_vu/dich-vu-cong-them/">Dịch vụ
                                                    cộng thêm</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-12796"
                                        class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12796">
                                        <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-quoc-te/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2021/11/quocte.png"
                                                alt="Dịch vụ quốc tế">Dịch vụ quốc tế</a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-12043"
                                                class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12043">
                                                <a
                                                    href="https://viettelpost.com.vn/dich_vu/chuyen-phat-quoc-te-chi-dinh-hang/">Chuyển
                                                    phát Quốc tế DHL</a>
                                            </li>
                                            <li id="menu-item-12046"
                                                class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12046">
                                                <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-quoc-te-nhanh/">Chuyển
                                                    phát quốc tế nhanh (VQN)</a>
                                            </li>
                                            <li id="menu-item-12045"
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12045">
                                                <a
                                                    href="https://viettelpost.com.vn/dich-vu-thong-quan-quoc-te-chieu-ve/">Dịch
                                                    vụ thông quan quốc tế chiều về</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-12048"
                                        class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12048">
                                        <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2021/11/logistics.png"
                                                alt="Dịch vụ logistic">Dịch vụ logistic</a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-12679"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12679">
                                                <a
                                                    href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/dich-vu-kho/kho-thuong-tren-500m2/">Kho
                                                    thường trên 500m2</a>
                                            </li>
                                            <li id="menu-item-12678"
                                                class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12678">
                                                <a
                                                    href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/dich-vu-kho/kho-thuong-duoi-500m2/">Kho
                                                    thường dưới 500m2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-12051"
                                        class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12051">
                                        <a
                                            href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/thuong-mai-dien-tu/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2021/11/transform.png"
                                                alt="Thương mại điện tử">Thương mại điện tử</a>
                                        <ul class="sub-menu">
                                            <li id="menu-item-12052"
                                                class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12052">
                                                <a
                                                    href="https://viettelpost.com.vn/dich_vu/dich-vu-ban-ve-may-bay-vtbay/">Dịch
                                                    vụ bán vé máy bay (VTBay)</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li id="menu-item-15977"
                                        class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-15977">
                                        <a
                                            href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/quan-ly-chat-luong-dich-vu/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2023/12/qlcldv.png"
                                                alt="Quản lý chất lượng dịch vụ">Quản lý chất lượng dịch vụ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="s2">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="tit-tt">Tin tức ViettelPost</h3>
                </div>
                <div class="col-md-6">
                    <ul class="ul-tt">
                        <li class="on" data-title="onone">Tất cả</li>
                        <li data-title="ontwo">Tin khuyến mại</li>
                        <li data-title="onthree">Hướng dẫn sử dụng </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <a class="view-all" href="/tin-tuc">Xem tất cả</a>
                </div>
            </div><!-- row -->
            <div class="ct-tt onone">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-tt">
                            <div class="img-tt">
                                <a
                                    href="https://viettelpost.com.vn/tin-hoat-dong/giao-hang-xuyen-tet-2025-tet-tuoi-co-vipo/"><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2024/12/avatar-web.jpg"
                                        alt="" class="lz"></a>
                            </div>
                            <div class="des-tt">
                                <div class="top-des">
                                    <a
                                        href="https://viettelpost.com.vn/tin-hoat-dong/giao-hang-xuyen-tet-2025-tet-tuoi-co-vipo/">
                                        <h5>GIAO HÀNG XUYÊN TẾT 2025 &#8211; TẾT TƯƠI CÓ VIPO</h5>
                                    </a>
                                    <span><i class="fas fa-clock"></i> 20 Tháng mười hai, 2024</span>
                                </div>
                                <h4><a
                                        href="https://viettelpost.com.vn/tin-hoat-dong/giao-hang-xuyen-tet-2025-tet-tuoi-co-vipo/">Để
                                        đáp ứng nhu cầu giao gửi của Quý khách hàng trong dịp nghỉ lễ Tết...</a></h4>
                                <a class="xct"
                                    href="https://viettelpost.com.vn/tin-hoat-dong/giao-hang-xuyen-tet-2025-tet-tuoi-co-vipo/"><img
                                        src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                        alt="" class="lz"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box-two">
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <div class="img-tt">
                                        <a href="https://viettelpost.com.vn/tin-tuc/vtp_gttt_goglobal/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2024/10/AVA-WEB.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class="des-tt">
                                        <div class="top-des">
                                            <a href="https://viettelpost.com.vn/tin-tuc/vtp_gttt_goglobal/">
                                                <h5>GIAO TRỌN TRÁI TIM &#8211; CÙNG HÀNG VIỆT TIẾN BƯỚC TOÀN CẦU</h5>
                                            </a>
                                            <span><i class="fas fa-clock"></i> 10 Tháng mười, 2024</span>
                                        </div>
                                        <h4><a href="https://viettelpost.com.vn/tin-tuc/vtp_gttt_goglobal/">Với tầm nhìn
                                                hướng đến tương lai chuyển đổi số và mục tiêu khẳng định vai trò...</a>
                                        </h4>
                                        <a class="xct" href="https://viettelpost.com.vn/tin-tuc/vtp_gttt_goglobal/"><img
                                                src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-two">
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <div class="img-tt">
                                        <a
                                            href="https://viettelpost.com.vn/tin-tuc/linh-hoat-dong-tien-tai-chinh-chu-dong/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2024/05/avata-web.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class="des-tt">
                                        <div class="top-des">
                                            <a
                                                href="https://viettelpost.com.vn/tin-tuc/linh-hoat-dong-tien-tai-chinh-chu-dong/">
                                                <h5>LINH HOẠT DÒNG TIỀN &#8211; TÀI CHÍNH CHỦ ĐỘNG</h5>
                                            </a>
                                            <span><i class="fas fa-clock"></i> 20 Tháng năm, 2024</span>
                                        </div>
                                        <h4><a
                                                href="https://viettelpost.com.vn/tin-tuc/linh-hoat-dong-tien-tai-chinh-chu-dong/">Đối
                                                với các doanh nghiệp, chủ shop, việc linh hoạt luồng tiền trong kinh
                                                doanh giúp rút...</a></h4>
                                        <a class="xct"
                                            href="https://viettelpost.com.vn/tin-tuc/linh-hoat-dong-tien-tai-chinh-chu-dong/"><img
                                                src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-two">
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <div class="img-tt">
                                        <a
                                            href="https://viettelpost.com.vn/tin-hoat-dong/giai-phap-kinh-doanh-viet-nam-myanmar-toan-dien-de-dang-cung-viettel-post/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2024/04/avatar-web-1-log.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class="des-tt">
                                        <div class="top-des">
                                            <a
                                                href="https://viettelpost.com.vn/tin-hoat-dong/giai-phap-kinh-doanh-viet-nam-myanmar-toan-dien-de-dang-cung-viettel-post/">
                                                <h5>GIẢI PHÁP KINH DOANH VIỆT NAM &#8211; MYANMAR TOÀN DIỆN, DỄ DÀNG
                                                    CÙNG VIETTEL POST</h5>
                                            </a>
                                            <span><i class="fas fa-clock"></i> 8 Tháng tư, 2024</span>
                                        </div>
                                        <h4><a
                                                href="https://viettelpost.com.vn/tin-hoat-dong/giai-phap-kinh-doanh-viet-nam-myanmar-toan-dien-de-dang-cung-viettel-post/">Đối
                                                với các doanh nghiệp xuất khẩu, việc quản lý hàng hóa và vận chuyển tới
                                                khách...</a></h4>
                                        <a class="xct"
                                            href="https://viettelpost.com.vn/tin-hoat-dong/giai-phap-kinh-doanh-viet-nam-myanmar-toan-dien-de-dang-cung-viettel-post/"><img
                                                src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </div><!-- ct-tt-on1 -->
            <div class="ct-tt ontwo">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-tt">
                            <div class="img-tt">
                                <a href="https://viettelpost.com.vn/tin-tuc/linh-hoat-dong-tien-tai-chinh-chu-dong/"><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2024/05/avata-web.png" alt=""
                                        class="lz"></a>
                            </div>
                            <div class="des-tt">
                                <div class="top-des">
                                    <a
                                        href="https://viettelpost.com.vn/tin-tuc/linh-hoat-dong-tien-tai-chinh-chu-dong/">
                                        <h5>LINH HOẠT DÒNG TIỀN &#8211; TÀI CHÍNH CHỦ ĐỘNG</h5>
                                    </a>
                                    <span><i class="fas fa-clock"></i> 20 Tháng năm, 2024</span>
                                </div>
                                <h4><a
                                        href="https://viettelpost.com.vn/tin-tuc/linh-hoat-dong-tien-tai-chinh-chu-dong/">Đối
                                        với các doanh nghiệp, chủ shop, việc linh hoạt luồng tiền trong kinh doanh
                                        giúp...</a></h4>
                                <a class="xct"
                                    href="https://viettelpost.com.vn/tin-tuc/linh-hoat-dong-tien-tai-chinh-chu-dong/"><img
                                        src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                        alt="" class="lz"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">


                    </div>
                </div><!-- row -->
            </div><!-- ct-tt-on2 -->

            <div class="ct-tt onthree">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-tt">
                            <div class="img-tt">
                                <a
                                    href="https://viettelpost.com.vn/khong-phan-loai/viettel-post-cap-nhat-nhieu-tinh-nang-moi-tai-phien-ban-app-moi-nhat/"><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2023/01/ava.jpg" alt=""
                                        class="lz"></a>
                            </div>
                            <div class="des-tt">
                                <div class="top-des">
                                    <a
                                        href="https://viettelpost.com.vn/khong-phan-loai/viettel-post-cap-nhat-nhieu-tinh-nang-moi-tai-phien-ban-app-moi-nhat/">
                                        <h5>Viettel Post cập nhật nhiều tính năng mới tại phiên bản APP mới nhất</h5>
                                    </a>
                                    <span><i class="fas fa-clock"></i> 14 Tháng Một, 2023</span>
                                </div>
                                <h4><a
                                        href="https://viettelpost.com.vn/khong-phan-loai/viettel-post-cap-nhat-nhieu-tinh-nang-moi-tai-phien-ban-app-moi-nhat/">VIETTEL
                                        POST CẬP NHẬT NHIỀU TÍNH NĂNG MỚI TẠI PHIÊN BẢN APP MỚI NHẤT Để phục...</a></h4>
                                <a class="xct"
                                    href="https://viettelpost.com.vn/khong-phan-loai/viettel-post-cap-nhat-nhieu-tinh-nang-moi-tai-phien-ban-app-moi-nhat/"><img
                                        src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                        alt="" class="lz"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box-two">
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <div class="img-tt">
                                        <a
                                            href="https://viettelpost.com.vn/huong-dan-su-dung/huong-dan-tao-don-tren-website-viettelpost-vn/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2019/01/logo-vtp-new-03.jpg"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class="des-tt">
                                        <div class="top-des">
                                            <a
                                                href="https://viettelpost.com.vn/huong-dan-su-dung/huong-dan-tao-don-tren-website-viettelpost-vn/">
                                                <h5>HƯỚNG DẪN TẠO ĐƠN TRÊN WEBSITE VIETTELPOST.VN</h5>
                                            </a>
                                            <span><i class="fas fa-clock"></i> 31 Tháng Một, 2023</span>
                                        </div>
                                        <h4><a
                                                href="https://viettelpost.com.vn/huong-dan-su-dung/huong-dan-tao-don-tren-website-viettelpost-vn/">Nhằm
                                                hỗ trợ Quý khách hàng đăng ký sử dụng dịch vụ và TẠO ĐƠN GỬI
                                                HÀNG,...</a></h4>
                                        <a class="xct"
                                            href="https://viettelpost.com.vn/huong-dan-su-dung/huong-dan-tao-don-tren-website-viettelpost-vn/"><img
                                                src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-two">
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <div class="img-tt">
                                        <a
                                            href="https://viettelpost.com.vn/huong-dan-su-dung/huong-dan-tra-cuu-hanh-trinh-don-hang-tai-viettel-post/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2019/01/logo-vtp-new-03.jpg"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class="des-tt">
                                        <div class="top-des">
                                            <a
                                                href="https://viettelpost.com.vn/huong-dan-su-dung/huong-dan-tra-cuu-hanh-trinh-don-hang-tai-viettel-post/">
                                                <h5>Hướng dẫn tra cứu hành trình đơn hàng tại Viettel Post</h5>
                                            </a>
                                            <span><i class="fas fa-clock"></i> 31 Tháng Một, 2023</span>
                                        </div>
                                        <h4><a
                                                href="https://viettelpost.com.vn/huong-dan-su-dung/huong-dan-tra-cuu-hanh-trinh-don-hang-tai-viettel-post/">Với
                                                tiêu chí luôn lắng nghe ý kiến khách hàng nhằm nâng cao chất lượng dịch
                                                vụ,...</a></h4>
                                        <a class="xct"
                                            href="https://viettelpost.com.vn/huong-dan-su-dung/huong-dan-tra-cuu-hanh-trinh-don-hang-tai-viettel-post/"><img
                                                src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-two">
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <div class="img-tt">
                                        <a
                                            href="https://viettelpost.com.vn/huong-dan-su-dung/cac-kenh-huong-dan-tra-cuu-thong-tin-buu-cuc-viettel-post/"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2020/03/logo-380x270.jpg"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class="des-tt">
                                        <div class="top-des">
                                            <a
                                                href="https://viettelpost.com.vn/huong-dan-su-dung/cac-kenh-huong-dan-tra-cuu-thong-tin-buu-cuc-viettel-post/">
                                                <h5>Hướng dẫn cách tra cứu thông tin bưu cục Viettel Post</h5>
                                            </a>
                                            <span><i class="fas fa-clock"></i> 31 Tháng Một, 2023</span>
                                        </div>
                                        <h4><a
                                                href="https://viettelpost.com.vn/huong-dan-su-dung/cac-kenh-huong-dan-tra-cuu-thong-tin-buu-cuc-viettel-post/">Viettel
                                                Post luôn lắng nghe ý kiến khách hàng để không ngừng nâng cao chất lượng
                                                dịch...</a></h4>
                                        <a class="xct"
                                            href="https://viettelpost.com.vn/huong-dan-su-dung/cac-kenh-huong-dan-tra-cuu-thong-tin-buu-cuc-viettel-post/"><img
                                                src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-arrow.png"
                                                alt="" class="lz"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="/huong-dan-su-dung" class="readmore"><span class="pr-2">Xem thêm</span>→</a>
                    </div>
                </div><!-- row -->
            </div><!-- ct-tt-on3 -->
        </div>
    </section>
    <section id="s3">
        <div class="row">
            <div class="col-md-4">
                <h4>Mạng lưới bưu cục <br />
                    trên 63 tỉnh thành </h4>
                <a href="https://apps.apple.com/us/app/viettelpost-chuy%E1%BB%83n-ph%C3%A1t-nhanh/id1398283517">
                    <img src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/app.png" alt=""
                        class="lz">
                </a>
                <a href="https://play.google.com/store/apps/details?id=com.viettel.ViettelPost">
                    <img src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/gg.png" alt=""
                        class="lz">
                </a>
            </div>
            <div class="col-md-8">
                <ul class="coutdown">
                    <li>
                        <h5 class="count-tk"><span class="timer counter-number appear" data-from="24" data-to="990"
                                data-speed="3000"></span>.<span class="timer counter-number appear" data-from="24"
                                data-to="870" data-speed="3000"></span><span>+</span></h5>
                        <p>KHÁCH HÀNG TIN DÙNG</p>
                    </li>
                    <li>
                        <h5 class="count-tk"><span class="timer counter-number appear" data-from="24" data-to="483"
                                data-speed="3000"></span>.<span class="timer counter-number appear" data-from="24"
                                data-to="870" data-speed="3000"></span><span>+</span></h5>
                        <p>ĐƠN HÀNG ĐANG VẬN CHUYỂN</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section id="s4" class="ph-pc">
        <div id="kh">
            <div class="row row4">
                <div class="col-md-5">
                    <div class="slide-kh owl-carousel owl-theme btw" data-item="2" data-nav="true" data-autoplay="true">
                        <div class="item btf" data-filter="kh1" data-number="1"><a href="javascript:void(0)"><img
                                    src="https://viettelpost.com.vn/wp-content/uploads/2021/11/Thiết-kế-không-tên.jpg"
                                    alt="" class="lz"></a></div>
                        <div class="item btf" data-filter="kh2" data-number="2"><a href="javascript:void(0)"><img
                                    src="https://viettelpost.com.vn/wp-content/uploads/2021/11/2.jpg" alt=""
                                    class="lz"></a></div>
                        <div class="item btf" data-filter="kh3" data-number="3"><a href="javascript:void(0)"><img
                                    src="https://viettelpost.com.vn/wp-content/uploads/2021/11/3.jpg" alt=""
                                    class="lz"></a></div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="slide-ct-kh owl-carousel owl-theme" data-item="1" data-dot="true" data-autoplay="false"
                        data-drag="true" data-autoheight="true">
                        <div class="item kh1" data-hash="">
                            <div class="row">
                                <div class="img-kh col-md-5"><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2021/11/Thiết-kế-không-tên.jpg"
                                        alt="" class="lz"></div>
                                <div class="info-kh col-md-7">
                                    <h5>Khách hàng</h5>
                                    <h3>Khách hàng nói về ViettelPost</h3>
                                    <div class="ct-kh">
                                        <div class="img-kh-mb"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2021/11/Thiết-kế-không-tên.jpg"
                                                alt="" class="lz"></div>
                                        <h4>“”</h4>
                                        <p>Đồng hành với Viettel Post 4 năm rồi và chưa bao giờ thấy mình lựa chọn sai.
                                            Các bạn giao hàng rất nhiệt tình và lễ phép, lấy hàng quen thành ra mấy mấy
                                            chị em cũng hay hỏi thăm nhau. </p>
                                        <div class="box-kh">
                                            <div>
                                                <h4>Chị Liên</h4>
                                                <p class="vitri">Khách hàng HCM</p>
                                            </div>
                                            <img src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/Star.png"
                                                alt="" class="lz">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div><!-- item -->
                        <div class="item kh2" data-hash="">
                            <div class="row">
                                <div class="img-kh col-md-5"><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2021/11/2.jpg" alt=""
                                        class="lz"></div>
                                <div class="info-kh col-md-7">
                                    <h5>Khách hàng</h5>
                                    <h3>Khách hàng nói về ViettelPost</h3>
                                    <div class="ct-kh">
                                        <div class="img-kh-mb"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2021/11/2.jpg" alt=""
                                                class="lz"></div>
                                        <h4>“”</h4>
                                        <p>Điều đầu tiên khiến mình chọn Viettel Post là tác phong quân đội rất chuẩn
                                            chỉnh! Đúng giờ và tuân thủ rất nghiêm các quy định về hàng hóa, giao nhận.
                                            Doanh nghiệp mình vì thế mà cũng được KH đánh giá cao trong khâu vận chuyển
                                            hàng. Tương lai mong Viettel Post sẽ ngày càng lớn mạnh và thành công hơn
                                            nữa, vì sự tự tế của các bạn là điều mà chúng tôi luôn công nhận!</p>
                                        <div class="box-kh">
                                            <div>
                                                <h4>Chú Thịnh</h4>
                                                <p class="vitri">Khách hàng Hà Nội</p>
                                            </div>
                                            <img src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/Star.png"
                                                alt="" class="lz">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div><!-- item -->
                        <div class="item kh3" data-hash="">
                            <div class="row">
                                <div class="img-kh col-md-5"><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2021/11/3.jpg" alt=""
                                        class="lz"></div>
                                <div class="info-kh col-md-7">
                                    <h5>Khách hàng</h5>
                                    <h3>Khách hàng nói về ViettelPost</h3>
                                    <div class="ct-kh">
                                        <div class="img-kh-mb"><img
                                                src="https://viettelpost.com.vn/wp-content/uploads/2021/11/3.jpg" alt=""
                                                class="lz"></div>
                                        <h4>“”</h4>
                                        <p>Chị kinh doanh và hay mua bán online lắm. Từ ngày dịch dã đến lại càng phải
                                            dùng tới dịch vụ của Viettel Post nhiều hơn. Cảm ơn các đồng chí Viettel
                                            Post rất nhiều, chị thấy hài lòng về dịch vụ bên mình.</p>
                                        <div class="box-kh">
                                            <div>
                                                <h4>Chị Thanh</h4>
                                                <p class="vitri">Khách hàng Đà Nẵng</p>
                                            </div>
                                            <img src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/Star.png"
                                                alt="" class="lz">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div><!-- item -->
                    </div>
                </div>
            </div><!-- row -->
        </div>
    </section>
    <footer>
        <!-- <section id="ftop">
			<div class="container">
				<div class="dt">
															<img src="https://viettelpost.com.vn/wp-content/uploads/2021/02/dt11.jpg" alt="" class="lz">
										<img src="https://viettelpost.com.vn/wp-content/uploads/2021/02/dt21.jpg" alt="" class="lz">
										<img src="https://viettelpost.com.vn/wp-content/uploads/2021/02/dt31.jpg" alt="" class="lz">
										<img src="https://viettelpost.com.vn/wp-content/uploads/2021/02/dt41.jpg" alt="" class="lz">
										<img src="https://viettelpost.com.vn/wp-content/uploads/2021/02/dt51.jpg" alt="" class="lz">
										<img src="https://viettelpost.com.vn/wp-content/uploads/2021/02/dt61.jpg" alt="" class="lz">
										<img src="https://viettelpost.com.vn/wp-content/uploads/2021/02/dt71.jpg" alt="" class="lz">
									</div>
				
			</div>			
		</section> -->
        <section class="line-footer"></section>
        <section id="fbot">
            <div class="container">
                <div class="row position-relative" style="background: #212D33">
                    <div class="col-md-5">
                        <div>
                            <h3>TỔNG CÔNG TY CỔ PHẦN BƯU CHÍNH VIETTEL</h3>
                            <p>Viettel Post là doanh nghiệp hàng đầu cung cấp dịch vụ chuyển phát nhanh hàng hoá, bưu
                                kiện trong nước, quốc tế tại Việt Nam.</p>
                            <p><i class="fa fa-paper-plane"></i>
                                Giấy chứng nhận Đăng ký Kinh doanh số: 0104093672 do Sở KHDT thành phố Hà Nội cấp lần
                                đầu ngày 03/07/2009, cấp thay đổi lần thứ 24 ngày 16/10/2023
                            </p>
                            <p><i class="fa fa-paper-plane"></i>
                                Giấy phép bưu chính số 229/GP-BTTTT do Bộ TTTT cấp ngày 28/08/2024
                            </p>
                            <p><i class="fa fa-paper-plane"></i>
                                Văn bản xác nhận thông báo hoạt động bưu chính số 3712/XN-BTTTT do Bộ TTTT cấp ngày
                                05/09/2024
                            </p>

                            <h3 class="second">THÔNG TIN LIÊN HỆ</h3>
                            <p><i class="fa fa-map-marker"></i>VP giao dịch: Toà nhà Viettel Post, Ngõ 15 Duy Tân, Cầu
                                Giấy, Hà Nội</p>
                            <ul><i class="fa fa-envelope"></i><a style="color:white"
                                    href="mailto:cskh@viettelpost.com.vn">cskh@viettelpost.com.vn</a></ul>
                            <p class="hotline"><img
                                    src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-phone.png"
                                    alt="">
                                <a href="tel:19008095" style="color: #fff;">
                                    19008095 </a>
                            </p>
                        </div><br>
                        <div>
                            <h4>Kết nối cùng ViettelPost</h4>
                            <ul class="soical">
                                <a href="https://www.facebook.com/viettelpost" title=""><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2021/02/fb1.png" alt=""></a>
                                <a href="mailto:support@viettelpost.com.vn" title=""><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2021/04/Vector-4.png"
                                        alt=""></a>
                                <a href="https://zalo.me/428184826361302827" title=""><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2021/11/Group-5897.png"
                                        alt=""></a>
                                <a href="https://www.linkedin.com/company/viettel-post/" title=""><img
                                        src="https://viettelpost.com.vn/wp-content/uploads/2021/02/in1.png" alt=""></a>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-3">
                                <h4>Về ViettelPost</h4>
                                <ul>
                                    <li><a href="/gioi-thieu/">Giới thiệu</a></li>
                                    <li><a href="/tin-tuc">Tin tức</a></li>
                                    <li><a href="/tim-kiem-buu-cuc/">Mạng lưới bưu cục</a></li>
                                    <li><a href="/tuyen-dung/">Tuyển dụng</a></li>
                                    <li><a href="/dang-ky-dai-ly-thu-gom/">Hợp tác</a></li>
                                    <li><a href="https://partner.viettelpost.vn/">Kết nối API</a></li>
                                </ul>
                            </div>
                            <div class="col-4">
                                <h4>Hỗ trợ khách hàng</h4>
                                <ul>
                                    <li><a href="https://m.me/viettelpost">Chat online với CSKH</a></li>
                                    <li><a href="https://viettelpost.com.vn/page-huong-dan-su-dung/">Hướng dẫn sử dụng
                                            dịch vụ</a></li>
                                    <li><a href="https://viettelpost.com.vn/cau-hoi-thuong-gap/">Câu hỏi thường gặp</a>
                                    </li>
                                    <li><a
                                            href="https://viettelpost.com.vn/dieu-khoan-su-dung/chi-tiet-dieu-khoan-su-dung/">Điều
                                            khoản sử dụng</a></li>
                                    <li><a
                                            href="wp-content/uploads/2023/10/PL1.-Chinh-sach-bao-mat-và-bao-ve-du-lieu-ca-nhan.pdf">Chính
                                            sách bảo mật thông tin</a></li>
                                    <li><a href="https://viettelpost.com.vn/chinh-sach-van-chuyen/">Chính sách vận
                                            chuyển</a></li>
                                    <li><a href="https://viettelpost.com.vn/gop-y/">Góp ý sản phẩm dịch vụ</a></li>
                                    <li><a
                                            href="https://viettelpost.com.vn/wp-content/uploads/2023/10/PL2.-QUY-%C4%90%E1%BB%8ANH-V%E1%BB%80-CH%C3%8DNH-S%C3%81CH-B%E1%BB%92I-TH%C6%AF%E1%BB%9CNG.pdf">Quy
                                            định về Bồi thường thiệt hại</a></li>
                                    <li><a
                                            href="https://viettelpost.com.vn/wp-content/uploads/2023/10/PL3.-Quy-%C4%91%E1%BB%8Bnh-h%C3%A0ng-c%E1%BA%A5m-g%E1%BB%ADi-g%E1%BB%ADi-c%C3%B3-%C4%91i%E1%BB%81u-ki%E1%BB%87n.pdf">Quy
                                            định hàng cấm gửi, gửi có điều kiện</a></li>
                                </ul>
                            </div>
                            <div class="col-5">
                                <div class="connect mb-3">

                                    <a style="display: flex;align-items: baseline;" href="tel:0862235888">
                                        <img class="mr-2"
                                            src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-phone.png"
                                            alt="0862235888">
                                        <span>0862235888</span>
                                    </a>
                                    <a style="display: flex;align-items: baseline;" href="maito:b2b@viettelpost.com.vn"
                                        title="b2b@viettelpost.com.vn" class="text-link">
                                        <i class="fa fa-envelope"></i>
                                        <span>b2b@viettelpost.com.vn</span>
                                    </a>
                                </div>
                                <div class="connect">
                                    <h4>Hợp tác khách hàng cá nhân</h4>
                                    <a href="tel:0983653311" style="display: flex;align-items: baseline;">
                                        <img class="mr-2"
                                            src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/ic-phone.png"
                                            alt="0983653311">
                                        <span>0983653311</span>
                                    </a>
                                    <a style="display: flex;align-items: baseline;"
                                        href="maito:kinhdoanh@viettelpost.com.vn" title="kinhdoanh@viettelpost.com.vn"
                                        class="text-link">
                                        <i class="fa fa-envelope"></i>
                                        <span>kinhdoanh@viettelpost.com.vn</span>
                                    </a>
                                </div>
                                <div class="l4" style="padding-top: 15px;">
                                    <ul>
                                        <p style="text-align: center;">Liên hệ ngay</p>
                                        <a href="https://viettelpost.com.vn/lien-he/">
                                            <img width="110px"
                                                src="https://viettelpost.com.vn/wp-content/uploads/2022/03/qr-hotline-kinh-doanh.jpg"
                                                alt="">
                                        </a>
                                    </ul>
                                    <ul>
                                        <p style="text-align: center;">Tải app ViettelPost</p>
                                        <a href="https://appviettelpost.page.link/app">
                                            <img width="110px"
                                                src="https://viettelpost.com.vn/wp-content/themes/viettel/images/qr-code-tai-app.png"
                                                alt="">
                                        </a>
                                    </ul>
                                </div>
                                <div class="l4" style="max-width:70%; padding-top:25px">
                                    <a href="">
                                        <img src="https://viettelpost.com.vn/wp-content/themes/viettel/images/ico-vt-verrify.png"
                                            alt="">
                                    </a>
                                    <a href="http://online.gov.vn/Home/WebDetails/10034" target="_blank">
                                        <img
                                            src="https://viettelpost.com.vn/wp-content/themes/viettel/images/bocongthuong.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </div><!-- container -->
        </section>
        <section id="copyight">
            <div class="container">
                ©ViettelPost 2020. All rights reserved
            </div>
        </section>
        <div class="go_top"><a href="javascript:void(0)"
                onclick="jQuery('html,body').animate({scrollTop: 0},1000);"><img
                    src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/back-top.png"
                    alt="bactop" /></a><span>Về đầu trang</span>
        </div>
    </footer>
    <div class="menu_mb">
        <div class="divmm">
            <span id="close"><img src="https://viettelpost.com.vn/wp-content/themes/viettel/assets/images/close.png"
                    alt=""></span>
            <div class="menu-main-menu-container">
                <ul id="menu-main-menu-1" class="main-mn">
                    <li
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-816 current_page_item menu-item-9498">
                        <a href="https://viettelpost.com.vn/" aria-current="page">Trang chủ</a>
                    </li>
                    <li
                        class="megaparent menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12490">
                        <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/">Dịch vụ</a>
                        <ul class="sub-menu">
                            <li
                                class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-15898">
                                <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-trong-nuoc/">Dịch
                                    vụ trong nước</a>
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12487">
                                        <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-tai-lieu/">Chuyển phát
                                            nhanh hàng hóa, tài liệu</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12060">
                                        <a href="https://viettelpost.com.vn/dich_vu/van-chuyen-hoa-toc/">Chuyển phát Hoả
                                            tốc, hẹn giờ</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-13510">
                                        <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-thuong-mai-dien-tu/">Chuyển
                                            phát Thương mại điện tử</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-13511">
                                        <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-tiet-kiem/">Chuyển phát
                                            Tiết kiệm hàng hóa</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-13509">
                                        <a href="https://viettelpost.com.vn/dich_vu/phan-loai-hang-dac-biet/">Phân loại
                                            hàng hóa đặc biệt</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12488">
                                        <a href="https://viettelpost.com.vn/dich_vu/dich-vu-cong-them/">Dịch vụ cộng
                                            thêm</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-15979">
                                        <a
                                            href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/quan-ly-chat-luong-dich-vu/">Quản
                                            lý chất lượng dịch vụ</a>
                                    </li>
                                    <li
                                        class="mega_more menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12074">
                                        <a
                                            href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-trong-nuoc/">Xem
                                            thêm</a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="mega menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12492">
                                <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-quoc-te/">Dịch vụ
                                    quốc tế</a>
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-13966">
                                        <a href="https://viettelpost.com.vn/tin-moi-nhat/">Tin mới nhất</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12957">
                                        <a
                                            href="https://viettelpost.com.vn/dich_vu/chuyen-phat-quoc-te-chi-dinh-hang-ups/">Chuyển
                                            Phát Quốc Tế UPS</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12062">
                                        <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-quoc-te-chi-dinh-hang/">Chuyển
                                            phát Quốc tế DHL</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12063">
                                        <a href="https://viettelpost.com.vn/dich_vu/chuyen-phat-quoc-te-nhanh/">Chuyển
                                            phát Quốc tế VQN</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14730">
                                        <a href="https://viettelpost.com.vn/dich-vu-thong-quan/">Dịch vụ thông quan</a>
                                    </li>
                                    <li
                                        class="mega_more menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12076">
                                        <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-quoc-te/">Xem
                                            thêm</a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="mega menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12491">
                                <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/">Dịch vụ
                                    logistic</a>
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12509">
                                        <a
                                            href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/dich-vu-kho/kho-thuong-duoi-500m2/">Kho
                                            thường dưới 500m2</a>
                                    </li>
                                    <li
                                        class="menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-12510">
                                        <a
                                            href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/dich-vu-logistic/dich-vu-kho/kho-thuong-tren-500m2/">Kho
                                            thường trên 500m2</a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="mega menu-item menu-item-type-taxonomy menu-item-object-danh_muc_dich_vu menu-item-has-children menu-item-12494">
                                <a href="https://viettelpost.com.vn/danh_muc_dich_vu/dich-vu/thuong-mai-dien-tu/">Thương
                                    mại điện tử</a>
                                <ul class="sub-menu">
                                    <li
                                        class="menu-item menu-item-type-post_type menu-item-object-dich_vu menu-item-12066">
                                        <a href="https://viettelpost.com.vn/dich_vu/dich-vu-ban-ve-may-bay-vtbay/">Dịch
                                            vụ bán vé máy bay (VTBay)</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-14785">
                        <a href="#">Viettel++</a>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14788"><a
                                    href="https://viettelpost.com.vn/gioi-thieu-viettel/">Giới thiệu Viettel++</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14786"><a
                                    href="https://viettelpost.com.vn/tieu-chi-xet-hang-hoi-vien/">Tiêu chí xét hạng</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14787"><a
                                    href="https://viettelpost.com.vn/quyen-loi-hoi-vien/">Quyền lợi hội viên</a></li>
                        </ul>
                    </li>
                    <li
                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-9439">
                        <a href="https://viettelpost.com.vn/tin-tuc/">Tin tức</a>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9442"><a
                                    href="https://viettelpost.com.vn/tin-hoat-dong/">Tin hoạt động</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9441"><a
                                    href="https://viettelpost.com.vn/tin-khuyen-mai/">Tin khuyến mãi</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9440"><a
                                    href="https://viettelpost.com.vn/tin-dau-thau/">Tin đấu thầu</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9443"><a
                                    href="https://viettelpost.com.vn/huong-dan-su-dung/">Hướng dẫn sử dụng</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-17551"><a
                                    href="https://viettelpost.com.vn/tin-tuc/bi-kip-trieu-don/">Bí kíp triệu đơn</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9471">
                        <a href="#">Ứng dụng số</a>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9474"><a
                                    target="_blank" href="https://appviettelpost.page.link/app">ViettelPost App</a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9475"><a
                                    target="_blank" href="https://viettelsale.com/">ViettelSale</a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9476"><a
                                    target="_blank" href="https://ads.viettelsale.com/">Quảng cáo số</a></li>
                        </ul>
                    </li>
                    <li
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9479">
                        <a href="#">Hỗ trợ khách hàng</a>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12219"><a
                                    href="https://viettelpost.com.vn/page-huong-dan-su-dung/">Hướng dẫn sử dụng</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12414"><a
                                    href="https://viettelpost.com.vn/gui-khieu-nai/">Gửi thông tin khiếu nại</a></li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12417"><a
                                    href="https://viettelpost.com.vn/gop-y/">Góp ý sản phẩm dịch vụ</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9676"><a
                                    href="https://viettelpost.com.vn/lien-he/">Liên hệ</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-16022"><a
                                    href="https://viettelpost.com.vn/thong-tin-ho-tro-khach-hang/">Thông tin hỗ trợ
                                    khách hàng</a></li>
                        </ul>
                    </li>
                    <li
                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-9444">
                        <a href="https://viettelpost.com.vn/quan-he-co-dong/">Quan hệ cổ đông</a>
                        <ul class="sub-menu">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9433"><a
                                    href="https://viettelpost.com.vn/gioi-thieu/">Về ViettelPost</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9445"><a
                                    href="https://viettelpost.com.vn/dai-hoi-dong-co-dong/">Đại hội đồng cổ đông</a>
                            </li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9446"><a
                                    href="https://viettelpost.com.vn/dieu-le-tong-cong-ty/">Điều lệ tổng công ty</a>
                            </li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9447"><a
                                    href="https://viettelpost.com.vn/bao-cao-tai-chinh/">Báo cáo tài chính</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9448"><a
                                    href="https://viettelpost.com.vn/bao-cao-thuong-nien/">Báo cáo thường niên</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-13129"><a
                                    href="https://viettelpost.com.vn/bao-cao-quan-tri-cong-ty/">Báo cáo quản trị công
                                    ty</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9450"><a
                                    href="https://viettelpost.com.vn/tin-co-dong/">Tin cổ đông</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9449"><a
                                    href="https://viettelpost.com.vn/thong-tin-bao-chi/">Thông tin báo chí</a></li>
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9451"><a
                                    href="https://viettelpost.com.vn/tin-doanh-nghiep/">Tin doanh nghiệp</a></li>
                        </ul>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9452"><a
                            href="https://viettelpost.com.vn/tuyen-dung/">Tuyển dụng</a></li>
                </ul>
            </div>
            <div class="hotline">
                <a href="tel:19008095">HOTLINE: 19008095</a>
            </div>
            <ul class="soical-mn">
                <a href="https://www.facebook.com/viettelpost" title=""><img
                        src="https://viettelpost.com.vn/wp-content/uploads/2021/02/fb1.png" alt=""></a>
                <a href="mailto:support@viettelpost.com.vn" title=""><img
                        src="https://viettelpost.com.vn/wp-content/uploads/2021/04/Vector-4.png" alt=""></a>
                <a href="https://zalo.me/428184826361302827" title=""><img
                        src="https://viettelpost.com.vn/wp-content/uploads/2021/11/Group-5897.png" alt=""></a>
                <a href="https://www.linkedin.com/company/viettel-post/" title=""><img
                        src="https://viettelpost.com.vn/wp-content/uploads/2021/02/in1.png" alt=""></a>
            </ul>
        </div>
    </div>

    <div class="btn-show-lk">
        <img src="https://viettelpost.com.vn/wp-content/themes/viettel/images/icon-send.png">
        <span>Tiện ích</span>
    </div>

    <div id="arcontactus" class="hidden-md hidden-lg">
        <div class=""></div>
    </div>
    <script>
    function toggleDropdown() {
        var dropdown = document.getElementById("userDropdown");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    // Đóng dropdown khi click ra ngoài
    document.addEventListener("click", function(event) {
        var userMenu = document.querySelector(".user-menu");
        if (!userMenu.contains(event.target)) {
            document.getElementById("userDropdown").style.display = "none";
        }
    });
    </script>