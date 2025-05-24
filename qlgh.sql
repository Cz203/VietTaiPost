-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2025 lúc 01:05 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlgh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buu_cuc`
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
-- Đang đổ dữ liệu cho bảng `buu_cuc`
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
-- Cấu trúc bảng cho bảng `don_hang`
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
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`ma_don_hang`, `ten_don_hang`, `so_luong`, `trong_luong`, `ten_nguoi_gui`, `sdt_nguoi_gui`, `ma_khach_hang`, `ten_nguoi_nhan`, `sdt_nguoi_nhan`, `dia_chi_nguoi_gui`, `dia_chi_nguoi_gui_mac_dinh`, `lat_nguoi_gui`, `lng_nguoi_gui`, `dia_chi_nguoi_nhan`, `dia_chi_nguoi_nhan_mac_dinh`, `lat_nguoi_nhan`, `lng_nguoi_nhan`, `thu_ho`, `trang_thai`, `phi_van_chuyen`, `nguoi_tra_phi`, `ngay_tao`, `thoi_gian_hen_lay`, `ngay_giao_du_kien`, `ghi_chu`) VALUES
('DH68305000a7e9b', 'Iphone 16 Promax', 2, 500, 'Việt', '0913998110', 2, 'Tài buồi ', '09139981101', '133, Nguyễn Văn Lượng', 'Phường 17, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.838469624030708', '106.66995558634784', '133, bến đò King Răng', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520240135176973', '106.28569712962617', 40, 'đã lấy hàng', 21000, 'người gửi', '2025-05-23 17:37:52', 'Cả ngày', '26/5/2025', 'hàng dễ vỡ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
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
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`id_khachhang`, `ho_ten`, `so_dien_thoai`, `email`, `mat_khau`, `ngay_tao`, `ngay_cap_nhat`) VALUES
(1, 'Bùi Anh Tài', '0385485869', 'buianhtai4903@gmail.com', '$2y$10$OaUOsA.AnqzgaJ9fa45on.Ullkc8SUQ/mNZjRG28pII2udkcHm/EK', '2025-05-22 17:07:30', '2025-05-22 18:46:20'),
(2, 'Cao Dương Quốc Việt', NULL, 'caoduongvietquoc@gmail.com', '$2y$10$0G.g4g0gHoQfbRSt7PTER.CSMWJbIisSCgX95ZBVdJkoq62V3NbMG', '2025-05-22 21:48:53', '2025-05-22 21:48:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipper`
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
-- Đang đổ dữ liệu cho bảng `shipper`
--

INSERT INTO `shipper` (`id`, `ho_ten`, `so_dien_thoai`, `mat_khau`, `id_buu_cuc`, `vi_do`, `kinh_do`, `ngay_tao`, `ngay_cap_nhat`, `trang_thai`, `cccd_truoc`, `cccd_sau`, `bang_lai_xe`, `giay_dk_xe`, `last_login`) VALUES
(44, 'Cao Việt', '0913998110', '$2y$10$P2rGitLYF4.ESrWqjLM5NOBXZNliL.cT6Tote8O.ctvNlMCas.gMi', 1, 10.8375080, 106.6806626, '2025-05-23 10:22:09', '2025-05-23 10:31:17', 'Không hoạt động', 'uploads/shipper/1747995729_trước.jpg', 'uploads/shipper/1747995729_sau.jpg', 'uploads/shipper/1747995729_xe.jpg', 'uploads/shipper/1747995729_giáy phép.jpg', NULL),
(45, 'Tài ngu', '1234567901', '$2y$10$t6R6hulxCKnM0u9u7w.wkOglRx4d7yDrQMkS3hbq5DVoOHpIpIpee', 1, 10.8387210, 106.6652630, '2025-05-23 10:32:24', '2025-05-23 10:34:09', 'Không hoạt động', 'uploads/shipper/1747996344_giáy phép.jpg', 'uploads/shipper/1747996344_giáy phép.jpg', 'uploads/shipper/1747996344_giáy phép.jpg', 'uploads/shipper/1747996344_sau.jpg', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `van_don`
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
-- Đang đổ dữ liệu cho bảng `van_don`
--

INSERT INTO `van_don` (`ma_van_don`, `ma_don_hang`, `id_shipper`, `id_buu_cuc`, `trang_thai`, `lich_su`, `thoi_gian_cap_nhat`, `ghi_chu`) VALUES
(14, 'DH68305000a7e9b', 45, 1, 'đợi lấy hàng', '17:38 23/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-23 17:38:05', NULL),
(15, 'DH68305000a7e9b', 45, 1, 'đã lấy hàng', '2025-05-23 17:43:09 - Đơn hàng đã được shipper lấy', '2025-05-23 17:43:09', NULL);

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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `buu_cuc`
--
ALTER TABLE `buu_cuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`ma_don_hang`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_khachhang`);

--
-- Chỉ mục cho bảng `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `van_don`
--
ALTER TABLE `van_don`
  ADD PRIMARY KEY (`ma_van_don`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `buu_cuc`
--
ALTER TABLE `buu_cuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_khachhang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `shipper`
--
ALTER TABLE `shipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `van_don`
--
ALTER TABLE `van_don`
  MODIFY `ma_van_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
