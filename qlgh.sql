-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 08:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlgh`
--

-- --------------------------------------------------------

--
-- Table structure for table `buu_cuc`
--

CREATE TABLE `buu_cuc` (
  `id` int(11) NOT NULL,
  `ten_buu_cuc` varchar(255) NOT NULL,
  `dia_chi` text NOT NULL,
  `xa_huyen_tinh` text NOT NULL,
  `vi_do` decimal(10,7) NOT NULL,
  `kinh_do` decimal(10,7) NOT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `thoi_gian_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buu_cuc`
--

INSERT INTO `buu_cuc` (`id`, `ten_buu_cuc`, `dia_chi`, `xa_huyen_tinh`, `vi_do`, `kinh_do`, `so_dien_thoai`, `thoi_gian_tao`) VALUES
(1, 'Bưu cục Lê Đức Thọ', '170 Đường Lê Đức Thọ', 'Phường 5, Quận Gò Vấp, Thành phố Hồ Chí Minh', 10.8361360, 106.6811300, '028388822223', '2025-05-15 11:39:39'),
(2, 'Bưu cục Nguyễn Thái Bình', '20 Nguyễn Thái Bình', 'Phường Nguyễn Thái Bình, Quận 1, Thành phố Hồ Chí Minh', 10.7731940, 106.6997240, '02838212345', '2025-05-15 11:39:39'),
(3, 'Bưu cục Lý Chính Thắng', '168 Lý Chính Thắn', 'Phường 7, Quận 3, Thành phố Hồ Chí Minh', 10.7872910, 106.6825390, '02839393939', '2025-05-15 11:39:39'),
(4, 'Bưu cục Tôn Đản', '180 Tôn Đản', 'Phường 8, Quận 4, Thành phố Hồ Chí Minh', 10.7644410, 106.7041140, '02838209191', '2025-05-15 11:39:39'),
(5, 'Bưu cục Trần Hưng Đạo', '523 Trần Hưng Đạo', 'Phường 14, Quận 5, Thành phố Hồ Chí Minh', 10.7540650, 106.6652340, '02838545678', '2025-05-15 11:39:39'),
(6, 'Bưu cục Hậu Giang', '85 Hậu Giang', 'Phường 5, Quận 6, Thành phố Hồ Chí Minh', 10.7468990, 106.6305810, '02839660000', '2025-05-15 11:39:39'),
(7, 'Bưu cục Nguyễn Thị Thập', '801 Nguyễn Thị Thập', 'Phường Tân Phú, Quận 7, Thành phố Hồ Chí Minh', 10.7344010, 106.7140820, '02837778888', '2025-05-15 11:39:39'),
(8, 'Bưu cục Dương Bá Trạc', '300 Dương Bá Trạc', 'Phường 1, Quận 8, Thành phố Hồ Chí Minh', 10.7394960, 106.6823880, '02838588588', '2025-05-15 11:39:39'),
(9, 'Bưu cục Thành Thái', '313 Thành Thái', 'Phường 14, Quận 10, Thành phố Hồ Chí Minh', 10.7708720, 106.6678280, '02838686666', '2025-05-15 11:39:39'),
(10, 'Bưu cục Minh Phụng', '202 Minh Phụng', 'Phường 6, Quận 11, Thành phố Hồ Chí Minh', 10.7621640, 106.6451920, '02839696666', '2025-05-15 11:39:39'),
(11, 'Bưu cục Trường Chinh', '783 Trường Chinh', 'Phường Tây Thạnh, Quận  Tân Bình, Thành phố Hồ Chí Minh', 10.8006910, 106.6200010, '02838446688', '2025-05-15 11:39:39'),
(12, 'Bưu cục Lũy Bán Bích', '1111 Lũy Bán Bích', 'Phường Tân Thành, Quận  Tân Phú, Thành phố Hồ Chí Minh', 10.7848380, 106.6354480, '02838669977', '2025-05-15 11:39:39'),
(13, 'Bưu cục Đinh Bộ Lĩnh', '156 Đinh Bộ Lĩnh', 'Phường 26, Quận  Bình Thạnh, Thành phố Hồ Chí Minh', 10.8076430, 106.7091590, '02838994411', '2025-05-15 11:39:39'),
(14, 'Bưu cục Mỹ Tho', 'Số 123, Đường Ấp Bắc', 'Phường 1, TP Mỹ Tho, Tỉnh Tiền Giang', 10.3582300, 106.3548500, '02733881234', '2025-05-15 20:00:00'),
(15, 'Bưu cục Gò Công Đông', 'Số 104, Đường Nguyễn Trãi', 'Xã Bình An, Huyện Gò Công Đông, Tỉnh Tiền Giang', 10.3580561, 106.7375484, '02733661234', '2025-05-15 20:00:00'),
(16, 'Bưu cục Tân Phước', 'Số 789, ĐT865', 'TT.Mỹ Phước, Huyện Tân Phước, Tỉnh Tiền Giang', 10.4770255, 106.1953924, '02733771234', '2025-05-15 20:00:00'),
(17, 'Bưu cục Chợ Gạo', 'Số 321, Đường 30 tháng 4', 'TT.Chợ Gạo, Huyện Chợ Gạo, Tỉnh Tiền Giang', 10.3503430, 106.4641900, '02733441234', '2025-05-15 20:00:00'),
(18, 'Bưu cục Cai Lậy', 'Số 12, Đường Thanh Tâm', 'TT.Cai Lậy, Thị xã Cai Lậy, Tỉnh Tiền Giang', 10.4061585, 106.1193273, '02733551234', '2025-05-15 20:00:00'),
(21, 'Bưu cục An Phú Đông', '37 đường An Phú Đông 3', 'Phường An Phú Đông, Quận 12, Thành phố Thành phố Hồ Chí Minh', 10.8540525, 106.7005464, '04321432123', '2025-05-17 04:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `ma_don_hang` varchar(50) NOT NULL,
  `ten_don_hang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int(10) NOT NULL,
  `trong_luong` int(10) NOT NULL,
  `ten_nguoi_gui` varchar(100) DEFAULT NULL,
  `sdt_nguoi_gui` varchar(100) DEFAULT NULL,
  `ma_khach_hang` int(11) NOT NULL,
  `ten_nguoi_nhan` varchar(100) NOT NULL,
  `sdt_nguoi_nhan` varchar(20) DEFAULT NULL,
  `dia_chi_nguoi_gui` text NOT NULL,
  `dia_chi_nguoi_gui_mac_dinh` text NOT NULL,
  `lat_nguoi_gui` text DEFAULT NULL,
  `lng_nguoi_gui` text DEFAULT NULL,
  `dia_chi_nguoi_nhan` text DEFAULT NULL,
  `dia_chi_nguoi_nhan_mac_dinh` text NOT NULL,
  `lat_nguoi_nhan` text NOT NULL,
  `lng_nguoi_nhan` text DEFAULT NULL,
  `thu_ho` int(20) DEFAULT NULL,
  `trang_thai` enum('chờ xử lý','chờ shipper tới lấy','đã lấy hàng','đang giao','đã giao','hủy') DEFAULT 'chờ xử lý',
  `phi_van_chuyen` int(10) DEFAULT 0,
  `nguoi_tra_phi` varchar(100) DEFAULT NULL,
  `ngay_tao` datetime DEFAULT current_timestamp(),
  `thoi_gian_hen_lay` varchar(50) NOT NULL,
  `ngay_giao_du_kien` text NOT NULL,
  `ghi_chu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`ma_don_hang`, `ten_don_hang`, `so_luong`, `trong_luong`, `ten_nguoi_gui`, `sdt_nguoi_gui`, `ma_khach_hang`, `ten_nguoi_nhan`, `sdt_nguoi_nhan`, `dia_chi_nguoi_gui`, `dia_chi_nguoi_gui_mac_dinh`, `lat_nguoi_gui`, `lng_nguoi_gui`, `dia_chi_nguoi_nhan`, `dia_chi_nguoi_nhan_mac_dinh`, `lat_nguoi_nhan`, `lng_nguoi_nhan`, `thu_ho`, `trang_thai`, `phi_van_chuyen`, `nguoi_tra_phi`, `ngay_tao`, `thoi_gian_hen_lay`, `ngay_giao_du_kien`, `ghi_chu`) VALUES
('DH6832039e8b9e7', 'Truyện 7 viên bi rồng', 1, 300, 'Bùi Anh Tài', '4356121331', 3, 'Đinh Quốc Kiệt', '456', '2 Tô Ngọc Vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.856703364813848', '106.66634827852252', 'Ủy Ban Hưng Thạnh', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.521277763939255', '106.28678351640703', 10000, 'đã giao', 21000, 'người nhận', '2025-05-25 00:36:30', 'Cả ngày', '28/5/2025', 'ghi chú'),
('DH68321886c506d', 'Sách 14 Ngày đẫm máu', 1, 300, 'Bùi Anh Tài', '4356121331', 3, 'Nguyễn Văn Dương', '21315431', 'số 2 đường Tô Ngọc Vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.8567084222648', '106.66634291410448', '21 Lê Đức thọ', 'Phường 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.83134089626632', '106.68242007493976', 67000, 'đã giao', 17000, 'người nhận', '2025-05-25 02:05:42', 'Cả ngày', '27/5/2025', 'ko'),
('DH6834a67b19f86', 'Ly giữ nhiệt', 1, 1000, 'Trần Gia Thuận', '4356121331', 3, 'Lê Minh Kha', '12763123', 'Số 7 Tô ngọc vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.878750109290465', '106.67749553918841', 'Y tế Hưng Thạnh', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.522158728066907', '106.28498643636705', 90000, 'hủy', 21000, 'người nhận', '2025-05-27 00:35:55', 'Cả ngày', '30/5/2025', 'ghi chú'),
('DH6834a7a3c2fb2', 'Tạ', 1, 1000, 'Bùi Anh Tuấn', '', 4, 'Tài ', '456', '8 tô ngọc vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.879314052155443', '106.67789250612262', 'a ', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520848331804906', '106.28713488578798', 0, 'đã giao', 21000, 'người gửi', '2025-05-27 00:40:51', 'Cả ngày', '30/5/2025', ''),
('DH68355697ec7b7', 'Đơn hàng ở An Phú đông', 1, 1000, 'Tô Vân', '12321', 3, 'Trần Ngọc Trân', '1231245123', 'villa an phú đông quận 12', 'Phường An Phú Đông, Quận 12, Thành phố Hồ Chí Minh', '10.853816344898052', '106.708888225895', '302 ấp hưng điền', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520574249005142', '106.28657724387021', 10000, 'đã giao', 21000, 'người gửi', '2025-05-27 13:07:19', 'Cả ngày', '30/5/2025', ''),
('DH68355eb5f2053', 'Truyện', 1, 1999, 'Bùi Anh Tài Em', '123', 3, 'Lê Minh Quí', '12321', 'L29 lê đức thọ ', 'Phường 15, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.841972888643134', '106.67650209408382', '2131', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.521712876558766', '106.291209508672', 0, 'đã giao', 25000, 'người gửi', '2025-05-27 13:41:57', 'Cả ngày', '30/5/2025', '12312');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id_khachhang` int(10) UNSIGNED NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id_khachhang`, `ho_ten`, `so_dien_thoai`, `email`, `mat_khau`, `ngay_tao`, `ngay_cap_nhat`) VALUES
(3, 'Bùi Anh Tài', '0385485869', 'buianhtai4903@gmail.com', '$2y$10$7la7hkBsOjkcSK/P4OEaUuLzrRtkELGUp51bGPjMBzyhc5Tqcoqyq', '2025-05-24 17:32:17', '2025-05-24 17:57:08'),
(4, 'Bùi Anh Tuấn', '0385485555', 'buianhtuandasdasdasd4903@gmail.com', '$2y$10$7la7hkBsOjkcSK/P4OEaUuLzrRtkELGUp51bGPjMBzyhc5Tqcoqyq', '2025-05-24 17:32:17', '2025-05-24 17:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_type` enum('shipper','khachhang') NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_type` enum('shipper','khachhang') NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipper`
--

CREATE TABLE `shipper` (
  `id` int(11) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `mat_khau` text NOT NULL,
  `id_buu_cuc` int(11) NOT NULL,
  `vi_do` decimal(10,7) DEFAULT NULL,
  `kinh_do` decimal(10,7) DEFAULT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp(),
  `ngay_cap_nhat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `trang_thai` enum('Đang hoạt động','Không hoạt động','Đã nghỉ việc','Khóa tài khoản') NOT NULL DEFAULT 'Không hoạt động',
  `cccd_truoc` varchar(255) DEFAULT NULL,
  `cccd_sau` varchar(255) DEFAULT NULL,
  `bang_lai_xe` varchar(255) DEFAULT NULL,
  `giay_dk_xe` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipper`
--

INSERT INTO `shipper` (`id`, `ho_ten`, `so_dien_thoai`, `mat_khau`, `id_buu_cuc`, `vi_do`, `kinh_do`, `ngay_tao`, `ngay_cap_nhat`, `trang_thai`, `cccd_truoc`, `cccd_sau`, `bang_lai_xe`, `giay_dk_xe`, `last_login`) VALUES
(46, 'Bùi Anh Tài', '0385485869', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 1, 10.8399293, 106.6466813, '2025-05-24 16:14:09', '2025-05-24 16:34:07', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(47, 'Bùi Anh Long', '0385485868', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 1, 10.8532660, 106.6630058, '2025-05-24 16:14:09', '2025-05-24 20:02:09', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-25 03:02:09'),
(48, 'Cao Mỹ Lệ', '0385485867', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 1, 10.8280738, 106.6859282, '2025-05-24 16:14:09', '2025-05-27 06:44:28', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-27 13:44:28'),
(49, 'Nguyễn Minh Nhật', '0385485866', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.4857710, 106.2112824, '2025-05-24 16:14:09', '2025-05-27 06:48:12', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-27 13:24:26'),
(50, 'Nguyễn Văn Lâm', '0385485865', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.8766335, 106.6405024, '2025-05-24 16:14:09', '2025-05-24 16:34:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(51, 'Trần Quang Vinh', '0385485864', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.8766335, 106.6290521, '2025-05-24 16:14:09', '2025-05-24 16:34:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(52, 'Đinh Quốc Kiệt', '0385485863', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.4857710, 106.2112824, '2025-05-24 16:14:09', '2025-05-27 06:47:57', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-27 13:33:58'),
(53, 'Lê Minh Quí', '0385485862', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.5386300, 106.3341800, '2025-05-24 16:14:09', '2025-05-27 06:46:47', 'Không hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-27 13:46:35'),
(54, 'Trần Gia Thuận', '0385485861', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.4857710, 106.2112824, '2025-05-24 16:14:09', '2025-05-27 06:48:02', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-27 13:33:34'),
(55, 'Nguyễn Trọng Phúc', '0385485860', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3632900, 106.3405500, '2025-05-24 16:14:09', '2025-05-24 17:28:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(56, 'Nguyễn Hữu Duy', '0385485859', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3898800, 106.3141200, '2025-05-24 16:14:09', '2025-05-24 17:29:26', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(57, 'Nguyễn Thanh Phi', '0385485858', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3720400, 106.3651700, '2025-05-24 16:14:09', '2025-05-27 06:48:17', 'Không hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `van_don`
--

CREATE TABLE `van_don` (
  `ma_van_don` int(11) NOT NULL,
  `ma_don_hang` varchar(50) NOT NULL,
  `id_shipper` int(10) DEFAULT NULL,
  `id_buu_cuc` int(11) DEFAULT NULL,
  `trang_thai` varchar(100) DEFAULT NULL,
  `lich_su` text DEFAULT NULL,
  `thoi_gian_cap_nhat` datetime DEFAULT current_timestamp(),
  `ghi_chu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `van_don`
--

INSERT INTO `van_don` (`ma_van_don`, `ma_don_hang`, `id_shipper`, `id_buu_cuc`, `trang_thai`, `lich_su`, `thoi_gian_cap_nhat`, `ghi_chu`) VALUES
(140, 'DH6832039e8b9e7', 47, 1, 'đợi lấy hàng', '00:39 25/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-25 00:39:18', NULL),
(143, 'DH6832039e8b9e7', 47, 1, 'đã lấy hàng', '00:43 25/05/2025: Đơn hàng đã được shipper lấy', '2025-05-25 00:43:35', NULL),
(144, 'DH6832039e8b9e7', 47, 1, 'ở bưu cục', '00:43 25/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục Lê Đức Thọ', '2025-05-25 00:43:41', 'đợi vận chuyển qua bưu cục khác'),
(147, 'DH6832039e8b9e7', NULL, 1, 'trong xe', '00:44 25/05/2025: Đơn hàng của bạn đã rời Bưu cục Lê Đức Thọ', '2025-05-25 00:44:51', NULL),
(155, 'DH6832039e8b9e7', NULL, 16, 'ở bưu cục', '00:58 25/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-25 00:58:31', 'có thể giao'),
(156, 'DH6832039e8b9e7', 52, 16, 'đang đi giao', '00:58 25/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-25 00:58:35', 'đang đi giao'),
(157, 'DH6832039e8b9e7', 52, 16, 'giao thành công', '00:58 25/05/2025: Đơn hàng của bạn đã được giao thành công', '2025-05-25 00:58:40', 'đã giao hàng'),
(162, 'DH68321886c506d', 47, 1, 'đợi lấy hàng', '02:51 25/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-25 02:51:18', NULL),
(163, 'DH68321886c506d', 47, 1, 'đã lấy hàng', '03:02 25/05/2025: Đơn hàng đã được shipper lấy', '2025-05-25 03:02:23', NULL),
(164, 'DH68321886c506d', 47, 1, 'ở bưu cục', '03:02 25/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục Lê Đức Thọ', '2025-05-25 03:02:25', 'có thể giao'),
(167, 'DH68321886c506d', 47, 1, 'đang đi giao', '03:04 25/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-25 03:04:33', 'đang đi giao'),
(168, 'DH68321886c506d', 47, 1, 'giao thành công', '03:04 25/05/2025: Đơn hàng của bạn đã được giao thành công', '2025-05-25 03:04:36', 'đã giao hàng'),
(169, 'DH6834a67b19f86', 49, 21, 'đợi lấy hàng', '00:36 27/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-27 00:45:25', NULL),
(170, 'DH6834a7a3c2fb2', 49, 21, 'đợi lấy hàng', '00:41 27/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-27 00:41:10', NULL),
(171, 'DH68355697ec7b7', 49, 21, 'đợi lấy hàng', '13:19 27/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-27 13:19:20', NULL),
(172, 'DH6834a7a3c2fb2', 49, 21, 'đã lấy hàng', '13:29 27/05/2025: Đơn hàng đã được shipper lấy', '2025-05-27 13:29:14', NULL),
(173, 'DH6834a67b19f86', 49, 21, 'đã lấy hàng', '13:29 27/05/2025: Đơn hàng đã được shipper lấy', '2025-05-27 13:29:16', NULL),
(174, 'DH68355697ec7b7', 49, 21, 'đã lấy hàng', '13:29 27/05/2025: Đơn hàng đã được shipper lấy', '2025-05-27 13:29:16', NULL),
(175, 'DH6834a67b19f86', 49, 21, 'ở bưu cục', '13:29 27/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục An Phú Đông', '2025-05-27 13:29:18', 'đợi vận chuyển qua bưu cục khác'),
(176, 'DH6834a7a3c2fb2', 49, 21, 'ở bưu cục', '13:29 27/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục An Phú Đông', '2025-05-27 13:29:19', 'đợi vận chuyển qua bưu cục khác'),
(177, 'DH68355697ec7b7', 49, 21, 'ở bưu cục', '13:29 27/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục An Phú Đông', '2025-05-27 13:29:20', 'đợi vận chuyển qua bưu cục khác'),
(178, 'DH6834a67b19f86', NULL, 21, 'trong xe', '13:29 27/05/2025: Đơn hàng của bạn đã rời Bưu cục An Phú Đông', '2025-05-27 13:29:37', NULL),
(179, 'DH6834a7a3c2fb2', NULL, 21, 'trong xe', '13:29 27/05/2025: Đơn hàng của bạn đã rời Bưu cục An Phú Đông', '2025-05-27 13:29:38', NULL),
(180, 'DH6834a67b19f86', NULL, 21, 'ở bưu cục', '13:29 27/05/2025: Đơn hàng của bạn đã đến Bưu cục An Phú Đông', '2025-05-27 13:29:40', 'đợi vận chuyển qua bưu cục khác'),
(181, 'DH68355697ec7b7', NULL, 21, 'trong xe', '13:29 27/05/2025: Đơn hàng của bạn đã rời Bưu cục An Phú Đông', '2025-05-27 13:29:49', NULL),
(182, 'DH6834a67b19f86', NULL, 21, 'trong xe', '13:29 27/05/2025: Đơn hàng của bạn đã rời Bưu cục An Phú Đông', '2025-05-27 13:29:51', NULL),
(183, 'DH6834a7a3c2fb2', NULL, 17, 'ở bưu cục', '13:30 27/05/2025: Đơn hàng của bạn đã đến Bưu cục Chợ Gạo', '2025-05-27 13:30:05', 'đợi vận chuyển qua bưu cục khác'),
(184, 'DH68355697ec7b7', NULL, 17, 'ở bưu cục', '13:30 27/05/2025: Đơn hàng của bạn đã đến Bưu cục Chợ Gạo', '2025-05-27 13:30:06', 'đợi vận chuyển qua bưu cục khác'),
(185, 'DH6834a67b19f86', NULL, 17, 'ở bưu cục', '13:30 27/05/2025: Đơn hàng của bạn đã đến Bưu cục Chợ Gạo', '2025-05-27 13:30:07', 'đợi vận chuyển qua bưu cục khác'),
(186, 'DH68355697ec7b7', NULL, 21, 'trong xe', '13:31 27/05/2025: Đơn hàng của bạn đã rời Bưu cục An Phú Đông', '2025-05-27 13:31:09', NULL),
(187, 'DH6834a7a3c2fb2', NULL, 21, 'trong xe', '13:31 27/05/2025: Đơn hàng của bạn đã rời Bưu cục An Phú Đông', '2025-05-27 13:31:10', NULL),
(188, 'DH6834a67b19f86', NULL, 21, 'trong xe', '13:31 27/05/2025: Đơn hàng của bạn đã rời Bưu cục An Phú Đông', '2025-05-27 13:31:10', NULL),
(189, 'DH68355697ec7b7', NULL, 16, 'ở bưu cục', '13:31 27/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-27 13:31:14', 'có thể giao'),
(190, 'DH6834a67b19f86', NULL, 16, 'ở bưu cục', '13:31 27/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-27 13:31:14', 'có thể giao'),
(191, 'DH6834a7a3c2fb2', NULL, 16, 'ở bưu cục', '13:31 27/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-27 13:31:15', 'có thể giao'),
(192, 'DH6834a7a3c2fb2', 54, 16, 'đang đi giao', '13:33 27/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-27 13:33:39', 'đang đi giao'),
(193, 'DH68355697ec7b7', 54, 16, 'đang đi giao', '13:33 27/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-27 13:33:39', 'đang đi giao'),
(194, 'DH6834a67b19f86', 54, 16, 'đang đi giao', '13:33 27/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-27 13:33:40', 'đang đi giao'),
(195, 'DH6834a67b19f86', 54, 16, 'hủy', '13:33 27/05/2025: Đơn hàng đã bị hủy vì: khách ko nghe\r\n', '2025-05-27 13:33:49', NULL),
(196, 'DH6834a7a3c2fb2', NULL, 16, 'ở bưu cục', '13:33 27/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-27 13:33:52', 'có thể giao'),
(197, 'DH68355697ec7b7', 54, 16, 'giao thành công', '13:33 27/05/2025: Đơn hàng của bạn đã được giao thành công', '2025-05-27 13:33:54', 'đã giao hàng'),
(198, 'DH6834a7a3c2fb2', 52, 16, 'đang đi giao', '13:34 27/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-27 13:34:00', 'đang đi giao'),
(199, 'DH6834a7a3c2fb2', 52, 16, 'giao thành công', '13:34 27/05/2025: Đơn hàng của bạn đã được giao thành công', '2025-05-27 13:34:02', 'đã giao hàng'),
(200, 'DH68355eb5f2053', 48, 1, 'đợi lấy hàng', '13:42 27/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-27 13:42:01', NULL),
(201, 'DH68355eb5f2053', 48, 1, 'đã lấy hàng', '13:44 27/05/2025: Đơn hàng đã được shipper lấy', '2025-05-27 13:44:42', NULL),
(202, 'DH68355eb5f2053', 48, 1, 'ở bưu cục', '13:44 27/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục Lê Đức Thọ', '2025-05-27 13:44:45', 'đợi vận chuyển qua bưu cục khác'),
(203, 'DH68355eb5f2053', NULL, 1, 'trong xe', '13:45 27/05/2025: Đơn hàng của bạn đã rời Bưu cục Lê Đức Thọ', '2025-05-27 13:45:30', NULL),
(204, 'DH68355eb5f2053', NULL, 16, 'ở bưu cục', '13:45 27/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-27 13:45:32', 'có thể giao'),
(205, 'DH68355eb5f2053', 53, 16, 'đang đi giao', '13:46 27/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-27 13:46:38', 'đang đi giao'),
(206, 'DH68355eb5f2053', 53, 16, 'giao thành công', '13:46 27/05/2025: Đơn hàng của bạn đã được giao thành công', '2025-05-27 13:46:41', 'đã giao hàng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buu_cuc`
--
ALTER TABLE `buu_cuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`ma_don_hang`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_khachhang`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `van_don`
--
ALTER TABLE `van_don`
  ADD PRIMARY KEY (`ma_van_don`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buu_cuc`
--
ALTER TABLE `buu_cuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_khachhang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `van_don`
--
ALTER TABLE `van_don`
  MODIFY `ma_van_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
