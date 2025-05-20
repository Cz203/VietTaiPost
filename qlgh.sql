-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 07:20 PM
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
(1, 'Bưu cục Lê Đức Thọ', '170 Đường Lê Đức Thọ', 'Phường 5, Gò Vấp, Hồ Chí Minh', 10.8361360, 106.6811300, '028388822223', '2025-05-15 18:39:39'),
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
(13, 'Bưu cục Đinh Bộ Lĩnh', '156 Đinh Bộ Lĩnh', 'Phường 26, Bình Thạnh, Hồ Chí Minh', 10.8076430, 106.7091590, '02838994411', '2025-05-15 18:39:39'),
(14, 'Bưu cục Mỹ Tho', 'Số 123, Đường Ấp Bắc', 'Phường 1, TP Mỹ Tho, tỉnh Tiền Giang', 10.3582300, 106.3548500, '02733881234', '2025-05-16 03:00:00'),
(15, 'Bưu cục Gò Công Đông', 'Số 104, Đường Nguyễn Trãi', 'Xã Bình An, Huyện Gò Công Đông, tỉnh Tiền Giang', 10.3580561, 106.7375484, '02733661234', '2025-05-16 03:00:00'),
(16, 'Bưu cục Tân Phước', 'Số 789, ĐT865', 'TT.Mỹ Phước, Huyện Tân Phước, tỉnh Tiền Giang', 10.4770255, 106.1953924, '02733771234', '2025-05-16 03:00:00'),
(17, 'Bưu cục Chợ Gạo', 'Số 321, Đường 30 tháng 4', 'TT.Chợ Gạo, Huyện Chợ Gạo, tỉnh Tiền Giang', 10.3503430, 106.4641900, '02733441234', '2025-05-16 03:00:00'),
(18, 'Bưu cục Cai Lậy', 'Số 12, Đường Thanh Tâm', 'TT.Cai Lậy, Thị xã Cai Lậy, tỉnh Tiền Giang', 10.4061585, 106.1193273, '02733551234', '2025-05-16 03:00:00'),
(21, 'Bưu cục An Phú Đông', '37 đường An Phú Đông 3', 'Phường An Phú Đông, Quận 12, Thành phố Hồ Chí Minh', 10.8540525, 106.7005464, '04321432123', '2025-05-17 11:21:14');

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
('DH682773fa3bdcd', 'Đắc Nhân Tâm', 1, 10000, 'Bùi Anh Tài', '123', 1, 'Quốc Việt', '456', 'Số 7 Hẻm 58', 'Phường 12, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.83987705756259', '106.64259101258725', 'Bến đò kinh năng (cũ), ĐT.865', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520312732242738', '106.28609150648118', 20000, 'đã lấy hàng', 73000, 'người gửi', '2025-05-17 00:20:58', 'Cả ngày', '20/5/2025', 'Ghi chú'),
('DH682ca0362a280', 'Cốc giữ nhiệt', 1, 200, 'Bùi Anh Tài Em', '123123123', 1, 'Đinh Quốc Kiệt', '321312321', '40 Đ. Trần Thái Tông ', 'Phường 15, Quận Tân Bình, Thành phố Hồ Chí Minh', '10.818346761214785', '106.63289040327074', 'Ủy ban nhân dân xã Hưng Thạnh', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.521277663055036', '106.28678351640703', 400000, 'đang giao', 21000, 'người nhận', '2025-05-20 22:31:02', 'Cả ngày', '23/5/2025', 'cốc'),
('DH682cb7564930f', 'Tai nghe', 1, 1000, 'Bùi Văn Long', '4356121331', 1, 'Cao Mỹ Lệ', '567214967', '55 Đ. Phạm Văn Bạch', 'Phường 15, Quận Tân Bình, Thành phố Hồ Chí Minh', '10.815027097826146', '106.63443535566333', 'Tạp Hóa Dũng Thanh', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.52067635217251', '106.28718584775928', 0, 'chờ shipper tới lấy', 21000, 'người nhận', '2025-05-21 00:09:42', 'Cả ngày', '24/5/2025', '1');

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
-- Table structure for table `shipper`
--

CREATE TABLE `shipper` (
  `id` int(11) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `mat_khau` text NOT NULL,
  `id_buu_cuc` int(11) NOT NULL,
  `vi_do` decimal(10,7) DEFAULT NULL,
  `kinh_do` decimal(10,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipper`
--

INSERT INTO `shipper` (`id`, `ho_ten`, `so_dien_thoai`, `mat_khau`, `id_buu_cuc`, `vi_do`, `kinh_do`) VALUES
(1, 'Nguyễn Văn A', '0901234567', '123', 1, 10.8365000, 106.6805000),
(2, 'Trần Thị B', '0902345678', '123', 1, 10.8410000, 106.6860000),
(3, 'Lê Văn C', '0903456789', '123', 1, 10.8455000, 106.6915000),
(4, 'Phạm Thị D', '0911234567', '123', 2, 10.7731000, 106.6998000),
(5, 'Ngô Văn E', '0912345678', '123', 2, 10.7776000, 106.7053000),
(6, 'Đinh Thị F', '0913456789', '123', 2, 10.7821000, 106.7108000),
(7, 'Trịnh Văn G', '0921234567', '123', 3, 10.7875000, 106.6822000),
(8, 'Hoàng Thị H', '0922345678', '123', 3, 10.7920000, 106.6877000),
(9, 'Phan Văn I', '0923456789', '123', 3, 10.7965000, 106.6932000),
(10, 'Bùi Thị K', '0931234567', '123', 4, 10.7641000, 106.7040000),
(11, 'Võ Văn L', '0932345678', '123', 4, 10.7686000, 106.7095000),
(12, 'Nguyễn Thị M', '0933456789', '123', 4, 10.7731000, 106.7150000),
(13, 'Trần Văn N', '0941234567', '123', 5, 10.7541000, 106.6650000),
(14, 'Lê Thị O', '0942345678', '123', 5, 10.7586000, 106.6705000),
(15, 'Phạm Văn P', '0943456789', '123', 5, 10.7631000, 106.6760000),
(16, 'Vũ Thị Q', '0951234567', '123', 6, 10.7469000, 106.6308000),
(17, 'Đặng Văn R', '0952345678', '123', 6, 10.7514000, 106.6363000),
(18, 'Nguyễn Thị S', '0953456789', '123', 6, 10.7559000, 106.6418000),
(19, 'Lý Văn T', '0961234567', '123', 7, 10.7345000, 106.7142000),
(20, 'Tô Thị U', '0962345678', '123', 7, 10.7390000, 106.7197000),
(21, 'Cao Văn V', '0963456789', '123', 7, 10.7435000, 106.7252000),
(22, 'Hồ Thị X', '0971234567', '123', 8, 10.7396000, 106.6824000),
(23, 'Châu Văn Y', '0972345678', '123', 8, 10.7441000, 106.6879000),
(24, 'Phùng Thị Z', '0973456789', '123', 8, 10.7486000, 106.6934000),
(25, 'Ngô Văn AA', '0981234567', '123', 9, 10.7709000, 106.6675000),
(26, 'Trịnh Thị BB', '0982345678', '123', 9, 10.7754000, 106.6730000),
(27, 'Lê Văn CC', '0983456789', '123', 9, 10.7799000, 106.6785000),
(28, 'Đào Thị DD', '0991234567', '123', 10, 10.7622000, 106.6453000),
(29, 'Nguyễn Văn EE', '0992345678', '123', 10, 10.7667000, 106.6508000),
(30, 'Trần Thị FF', '0993456789', '123', 10, 10.7712000, 106.6563000),
(31, 'Phạm Văn GG', '0909123456', '123', 11, 10.8005000, 106.6198000),
(32, 'Hoàng Thị HH', '0909234567', '123', 11, 10.8050000, 106.6253000),
(33, 'Vũ Văn II', '0909345678', '123', 11, 10.8095000, 106.6308000),
(34, 'Nguyễn Văn JJ', '0909456789', '123', 12, 10.7849000, 106.6351000),
(35, 'Trần Thị KK', '0909567890', '123', 12, 10.7894000, 106.6406000),
(36, 'Lê Văn LL', '0909678901', '123', 12, 10.7939000, 106.6461000),
(37, 'Phan Thị MM', '0909789012', '123', 13, 10.8075000, 106.7090000),
(38, 'Bùi Văn NN', '0909890123', '123', 13, 10.8120000, 106.7145000),
(39, 'Nguyễn Thị OO', '0909901234', '123', 13, 10.8165000, 106.7200000);

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
(1, 'DH682773fa3bdcd', 33, 11, 'đợi lấy hàng', '13:31 17/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-17 18:31:45', NULL),
(2, 'DH682ca0362a280', 33, 11, 'đợi lấy hàng', '17:31 20/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-20 22:31:19', NULL),
(5, 'DH682ca0362a280', 33, 11, 'đã lấy hàng', '2025-05-20 18:24:27 - Đơn hàng đã được shipper lấy', '2025-05-20 23:24:27', NULL),
(6, 'DH682ca0362a280', 33, 11, 'đang giao', '2025-05-20 18:53:31 - Đơn hàng của bạn đang ở bưu cục Bưu cục Trường Chinh', '2025-05-20 23:53:31', NULL),
(10, 'DH682773fa3bdcd', 33, 11, 'đã lấy hàng', '2025-05-20 19:04:56 - Đơn hàng đã được shipper lấy', '2025-05-21 00:04:56', NULL),
(11, 'DH682cb7564930f', 33, 11, 'đợi lấy hàng', '19:10 20/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-21 00:10:07', NULL);

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
-- AUTO_INCREMENT for table `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `ma_khach_hang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `van_don`
--
ALTER TABLE `van_don`
  MODIFY `ma_van_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
