-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 09:48 PM
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
(1, 'Bưu cục Lê Đức Thọ', '170 Đường Lê Đức Thọ', 'Phường 5, Gò Vấp, Hồ Chí Minh', 10.8361360, 106.6811300, '02838882222', '2025-05-15 18:39:39'),
(2, 'Bưu cục Nguyễn Thái Bình', '20 Nguyễn Thái Bình', 'Phường Nguyễn Thái Bình, Quận 1, Hồ Chí Minh', 10.7731940, 106.6997240, '02838212345', '2025-05-15 18:39:39'),
(3, 'Bưu cục Lý Chính Thắng', '168 Lý Chính Thắn', 'Phường 7, Quận 3, Hồ Chí Minh', 10.7872910, 106.6825390, '02839393939', '2025-05-15 18:39:39'),
(4, 'Bưu cục Tôn Đản', '180 Tôn Đản', 'Phường 8, Quận 4, Hồ Chí Minh', 10.7644410, 106.7041140, '02838209191', '2025-05-15 18:39:39'),
(5, 'Bưu cục Trần Hưng Đạo', '523 Trần Hưng Đạo', 'Phường 14, Quận 5, Hồ Chí Minh', 10.7540650, 106.6652340, '02838545678', '2025-05-15 18:39:39'),
(6, 'Bưu cục Hậu Giang', '85 Hậu Giang', 'Phường 5, Quận 6, Hồ Chí Minh', 10.7468990, 106.6305810, '02839660000', '2025-05-15 18:39:39'),
(7, 'Bưu cục Nguyễn Thị Thập', '801 Nguyễn Thị Thập', 'Phường Tân Phú, Quận 7, Hồ Chí Minh', 10.7344010, 106.7140820, '02837778888', '2025-05-15 18:39:39'),
(8, 'Bưu cục Dương Bá Trạc', '300 Dương Bá Trạc', 'Phường 1, Quận 8, Hồ Chí Minh', 10.7394960, 106.6823880, '02838588588', '2025-05-15 18:39:39'),
(9, 'Bưu cục Thành Thái', '313 Thành Thái', 'Phường 14, Quận 10, Hồ Chí Minh', 10.7708720, 106.6678280, '02838686666', '2025-05-15 18:39:39'),
(10, 'Bưu cục Minh Phụng', '202 Minh Phụng', 'Phường 6, Quận 11, Hồ Chí Minh', 10.7621640, 106.6451920, '02839696666', '2025-05-15 18:39:39'),
(11, 'Bưu cục Trường Chinh', '783 Trường Chinh', 'Phường Tây Thạnh, Tân Bình, Hồ Chí Minh', 10.8006910, 106.6200010, '02838446688', '2025-05-15 18:39:39'),
(12, 'Bưu cục Lũy Bán Bích', '1111 Lũy Bán Bích', 'Phường Tân Thành, Tân Phú, Hồ Chí Minh', 10.7848380, 106.6354480, '02838669977', '2025-05-15 18:39:39'),
(13, 'Bưu cục Đinh Bộ Lĩnh', '156 Đinh Bộ Lĩnh', 'Phường 26, Bình Thạnh, Hồ Chí Minh', 10.8076430, 106.7091590, '02838994411', '2025-05-15 18:39:39');

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
  `trang_thai` enum('chờ xử lý','đang giao','đã giao','hủy') DEFAULT 'chờ xử lý',
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
('DH68261025c284f', 'Truyện Cười', 1, 10000, 'Bùi Anh Tài', '123', 1, 'Quốc Việt', '456', '10000', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520405408797245', '106.28664135932924', 'xyz', 'Phường Mỹ Xuyên, Thành phố Long Xuyên, Tỉnh An Giang', '10.378136653741322', '105.43715357780458', 10000, 'chờ xử lý', 73000, 'người nhận', '2025-05-15 23:02:45', 'Cả ngày', '18/5/2025', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_khach_hang` int(11) NOT NULL,
  `ten_khach_hang` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi` text DEFAULT NULL,
  `ngay_tao` datetime DEFAULT current_timestamp(),
  `trang_thai` enum('hoat_dong','khoa') DEFAULT 'hoat_dong'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `van_don`
--

CREATE TABLE `van_don` (
  `ma_van_don` int(11) NOT NULL,
  `ma_don_hang` varchar(50) NOT NULL,
  `trang_thai` varchar(100) NOT NULL,
  `thoi_gian_cap_nhat` datetime DEFAULT current_timestamp(),
  `ghi_chu` text DEFAULT NULL
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
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_khach_hang`);

--
-- Indexes for table `van_don`
--
ALTER TABLE `van_don`
  ADD PRIMARY KEY (`ma_van_don`),
  ADD KEY `ma_don_hang` (`ma_don_hang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buu_cuc`
--
ALTER TABLE `buu_cuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `ma_khach_hang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `van_don`
--
ALTER TABLE `van_don`
  MODIFY `ma_van_don` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
