-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 08:00 PM
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
('DH6832039e8b9e7', 'Truyện 7 viên bi rồng', 1, 300, 'Bùi Anh Tài', '4356121331', 3, 'Đinh Quốc Kiệt', '456', '2 Tô Ngọc Vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.856703364813848', '106.66634827852252', 'Ủy Ban Hưng Thạnh', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.521277763939255', '106.28678351640703', 10000, 'đã giao', 21000, 'người nhận', '2025-05-25 00:36:30', 'Cả ngày', '28/5/2025', 'ghi chú');

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
(3, 'Bùi Anh Tài', '0385485869', 'buianhtai4903@gmail.com', '$2y$10$7la7hkBsOjkcSK/P4OEaUuLzrRtkELGUp51bGPjMBzyhc5Tqcoqyq', '2025-05-24 17:32:17', '2025-05-24 17:57:08');

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
(47, 'Bùi Anh Long', '0385485868', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 1, 10.8532660, 106.6630058, '2025-05-24 16:14:09', '2025-05-24 16:34:10', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(48, 'Cao Mỹ Lệ', '0385485867', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 1, 10.8280738, 106.6859282, '2025-05-24 16:14:09', '2025-05-24 16:34:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(49, 'Nguyễn Minh Nhật', '0385485866', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.8797165, 106.6786617, '2025-05-24 16:14:09', '2025-05-24 16:34:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(50, 'Nguyễn Văn Lâm', '0385485865', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.8766335, 106.6405024, '2025-05-24 16:14:09', '2025-05-24 16:34:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(51, 'Trần Quang Vinh', '0385485864', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.8766335, 106.6290521, '2025-05-24 16:14:09', '2025-05-24 16:34:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(52, 'Đinh Quốc Kiệt', '0385485863', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.4882700, 106.2268100, '2025-05-24 16:14:09', '2025-05-24 17:08:52', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(53, 'Lê Minh Quí', '0385485862', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.5386300, 106.3341800, '2025-05-24 16:14:09', '2025-05-24 17:08:52', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(54, 'Trần Gia Thuận', '0385485861', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.5510700, 106.1976600, '2025-05-24 16:14:09', '2025-05-24 17:08:52', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(55, 'Nguyễn Trọng Phúc', '0385485860', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3632900, 106.3405500, '2025-05-24 16:14:09', '2025-05-24 17:28:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(56, 'Nguyễn Hữu Duy', '0385485859', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3898800, 106.3141200, '2025-05-24 16:14:09', '2025-05-24 17:29:26', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(57, 'Nguyễn Thanh Phi', '0385485858', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3720400, 106.3651700, '2025-05-24 16:14:09', '2025-05-24 17:29:26', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL);

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
(157, 'DH6832039e8b9e7', 52, 16, 'giao thành công', '00:58 25/05/2025: Đơn hàng của bạn đã được giao thành công', '2025-05-25 00:58:40', 'đã giao hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `sender_type` enum('shipper','khachhang') NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `receiver_type` enum('shipper','khachhang') NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_khachhang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `van_don`
--
ALTER TABLE `van_don`
  MODIFY `ma_van_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
