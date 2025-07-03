-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 01, 2025 lúc 12:21 PM
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
(21, 'Bưu cục An Phú Đông', '37 đường An Phú Đông 3', 'Phường An Phú Đông, Quận 12, Thành phố Thành phố Hồ Chí Minh', 10.8540525, 106.7005464, '04321432123', '2025-05-17 04:21:14'),
(22, 'buu cuc iuh', 'phuong 1 nguyen van bao', 'Phường 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', 10.8221838, 106.6872067, '', '2025-05-28 00:51:40');

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
('DH6832039e8b9e7', 'Truyện 7 viên bi rồng', 1, 300, 'Bùi Anh Tài', '4356121331', 3, 'Đinh Quốc Kiệt', '456', '2 Tô Ngọc Vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.856703364813848', '106.66634827852252', 'Ủy Ban Hưng Thạnh', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.521277763939255', '106.28678351640703', 10000, 'đã giao', 21000, 'người nhận', '2025-05-25 00:36:30', 'Cả ngày', '28/5/2025', 'ghi chú'),
('DH68321886c506d', 'Sách 14 Ngày đẫm máu', 1, 300, 'Bùi Anh Tài', '4356121331', 3, 'Nguyễn Văn Dương', '21315431', 'số 2 đường Tô Ngọc Vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.8567084222648', '106.66634291410448', '21 Lê Đức thọ', 'Phường 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.83134089626632', '106.68242007493976', 67000, 'đã giao', 17000, 'người nhận', '2025-05-25 02:05:42', 'Cả ngày', '27/5/2025', 'ko'),
('DH6834a67b19f86', 'Ly giữ nhiệt', 1, 1000, 'Trần Gia Thuận', '4356121331', 3, 'Lê Minh Kha', '12763123', 'Số 7 Tô ngọc vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.878750109290465', '106.67749553918841', 'Y tế Hưng Thạnh', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.522158728066907', '106.28498643636705', 90000, 'hủy', 21000, 'người nhận', '2025-05-27 00:35:55', 'Cả ngày', '30/5/2025', 'ghi chú'),
('DH6834a7a3c2fb2', 'Tạ', 1, 1000, 'Bùi Anh Tuấn', '', 4, 'Tài ', '456', '8 tô ngọc vân', 'Phường Thạnh Xuân, Quận 12, Thành phố Hồ Chí Minh', '10.879314052155443', '106.67789250612262', 'a ', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520848331804906', '106.28713488578798', 0, 'đã giao', 21000, 'người gửi', '2025-05-27 00:40:51', 'Cả ngày', '30/5/2025', ''),
('DH68355697ec7b7', 'Đơn hàng ở An Phú đông', 1, 1000, 'Tô Vân', '12321', 3, 'Trần Ngọc Trân', '1231245123', 'villa an phú đông quận 12', 'Phường An Phú Đông, Quận 12, Thành phố Hồ Chí Minh', '10.853816344898052', '106.708888225895', '302 ấp hưng điền', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520574249005142', '106.28657724387021', 10000, 'đã giao', 21000, 'người gửi', '2025-05-27 13:07:19', 'Cả ngày', '30/5/2025', ''),
('DH68355eb5f2053', 'Truyện', 1, 1999, 'Bùi Anh Tài Em', '123', 3, 'Lê Minh Quí', '12321', 'L29 lê đức thọ ', 'Phường 15, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.841972888643134', '106.67650209408382', '2131', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.521712876558766', '106.291209508672', 0, 'đã giao', 25000, 'người gửi', '2025-05-27 13:41:57', 'Cả ngày', '30/5/2025', '12312'),
('DH68356999ab9fb', 'Truyện Cười', 1, 10000, 'Bùi Văn Long', '12321', 3, '1123asd ád', '21321', 'a ', 'Phường 5, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.82657684483532', '106.6919741034508', 'qưdasd ád', 'Xã Phú Mỹ, Huyện Tân Phước, Tỉnh Tiền Giang', '10.525615331125953', '106.33601546287537', 1293421, 'chờ shipper tới lấy', 73000, 'người nhận', '2025-05-27 14:28:25', 'Cả ngày', '30/5/2025', '123'),
('DH6835ef2a257a5', 'Truyện', 1, 20000, 'Bùi Anh Tài', '4356121331', 3, 'Cao Mỹ Lệ', '1231245123', 'số 23 lê đức thọ', 'Phường 5, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.827506942358772', '106.69071078300477', 'dưới cầu chín hấn bên hưng điền', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520510866713886', '106.28749966621399', 500000, 'chờ xử lý', 133000, 'người nhận', '2025-05-27 23:58:18', 'Cả ngày', '30/5/2025', '1'),
('DH6835f5ea37432', 'abc ', 1, 10000, 'Bùi Anh Tài', '4356121331', 3, 'Đinh Quốc Kiệt', '1231245123', 'lê đức thọ 72613/123', 'Phường 15, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.850436914433548', '106.67088389396669', 'khu dân cư d1 hưng thạnh', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.522300838519113', '106.28574281930925', 200000, 'hủy', 73000, 'người nhận', '2025-05-28 00:27:06', 'Chiều 13:30 - 17:30', '31/5/2025', 'a'),
('DH6836250e5b4ff', 'Thùng nhựa Duy Tân', 2, 10, 'Việt', '0913998110', 3, 'Chí cao', '0913992110', '80/13 Đường số 8', 'Phường An Phú Đông, Quận 12, Thành phố Hồ Chí Minh', '10.857988785374413', '106.69609113510505', 'Bến đò kinh nâng, ấp hưng điền', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.520199777891367', '106.28572659240099', 50, 'chờ xử lý', 21000, 'người nhận', '2025-05-28 03:48:14', 'Cả ngày', '31/5/2025', 'Hàng to bự'),
('DH68365cb27abc6', 'Thùng nhựa Duy Tân', 2, 3000, 'Cao Dương Quốc Việt', '0913998110', 5, 'Bùi Anh Tài', '0918726466', '30/13 Đường số 8', 'Phường 11, Quận Gò Vấp, Thành phố Hồ Chí Minh', '10.838811992172754', '106.66292206696681', 'Bến đò kinh nâng', 'Xã Hưng Thạnh, Huyện Tân Phước, Tỉnh Tiền Giang', '10.52019238045293', '106.28581414740492', 30, 'đã giao', 31000, 'người gửi', '2025-05-28 07:45:38', 'Cả ngày', '31/5/2025', 'Hàng to bự');

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
(3, 'Bùi Anh Tài', '0385485869', 'buianhtai4903@gmail.com', '$2y$10$7la7hkBsOjkcSK/P4OEaUuLzrRtkELGUp51bGPjMBzyhc5Tqcoqyq', '2025-05-24 17:32:17', '2025-05-24 17:57:08'),
(4, 'Bùi Anh Tuấn', '0385485555', 'buianhtuandasdasdasd4903@gmail.com', '$2y$10$7la7hkBsOjkcSK/P4OEaUuLzrRtkELGUp51bGPjMBzyhc5Tqcoqyq', '2025-05-24 17:32:17', '2025-05-24 17:57:08'),
(5, 'Cao Dương Quốc Việt', '0913998110', 'caoduongvietquoc@gmail.com', '$2y$10$LgcSprIbZ6S43LYyTOCUFunQuQaRFg6UPepbUYwJ3XOSIpA/OynBO', '2025-05-27 11:54:37', '2025-05-28 00:43:24'),
(6, 'Cao Quốc Việt', NULL, 'caoviet@gmail.com', '$2y$10$twTXzMda4Nd2HzbY.o1MluPn//TpBWhv7QNc1BS5PHF7oSgz9.B5m', '2025-05-28 00:41:28', '2025-05-28 00:41:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
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

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `sender_type`, `receiver_id`, `receiver_type`, `message`, `is_read`, `created_at`) VALUES
(34, 5, 'khachhang', 48, 'shipper', 'Chào chị', 0, '2025-05-28 00:47:24'),
(35, 5, 'khachhang', 48, 'shipper', 'Khi nào chị tới', 0, '2025-05-28 00:47:27'),
(36, 48, 'shipper', 5, 'khachhang', 'Em chuaanr bij toi', 0, '2025-05-28 00:48:09');

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
(46, 'Bùi Anh Tài', '0385485869', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 1, 10.8462080, 106.6631168, '2025-05-24 16:14:09', '2025-05-27 21:20:09', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-28 03:24:12'),
(47, 'Bùi Anh Long', '0385485868', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 1, 10.8255500, 106.6805700, '2025-05-24 16:14:09', '2025-05-27 21:10:32', 'Không hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-28 00:17:51'),
(48, 'Cao Mỹ Lệ', '0385485867', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 1, 10.8225774, 106.6872232, '2025-05-24 16:14:09', '2025-05-28 00:49:38', 'Không hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-28 07:47:55'),
(49, 'Nguyễn Minh Nhật', '0385485866', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.8702300, 106.6369000, '2025-05-24 16:14:09', '2025-05-27 21:08:14', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-27 13:24:26'),
(50, 'Nguyễn Văn Lâm', '0385485865', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.8766335, 106.6405024, '2025-05-24 16:14:09', '2025-05-24 16:34:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(51, 'Trần Quang Vinh', '0385485864', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 21, 10.8766335, 106.6290521, '2025-05-24 16:14:09', '2025-05-24 16:34:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(52, 'Đinh Quốc Kiệt', '0385485863', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.8226188, 106.6871955, '2025-05-24 16:14:09', '2025-05-28 01:01:34', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-28 07:49:45'),
(53, 'Lê Minh Quí', '0385485862', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.5386300, 106.3341800, '2025-05-24 16:14:09', '2025-05-27 06:46:47', 'Không hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-27 13:46:35'),
(54, 'Trần Gia Thuận', '0385485861', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 16, 10.5252326, 106.3342902, '2025-05-24 16:14:09', '2025-05-27 08:05:36', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', '2025-05-27 15:01:48'),
(55, 'Nguyễn Trọng Phúc', '0385485860', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3632900, 106.3405500, '2025-05-24 16:14:09', '2025-05-24 17:28:13', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(56, 'Nguyễn Hữu Duy', '0385485859', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3898800, 106.3141200, '2025-05-24 16:14:09', '2025-05-24 17:29:26', 'Đang hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(57, 'Nguyễn Thanh Phi', '0385485858', '$2y$10$p0gTG1cjIUuKR4232XI6ceVKa7UJ9.1WXV.2meClQYZqn9ScuyWpG', 14, 10.3720400, 106.3651700, '2025-05-24 16:14:09', '2025-05-27 06:48:17', 'Không hoạt động', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', 'uploads/shipper/1748103249_5_20_2025 5_41_13 PM.png', NULL),
(58, 'Cao Quốc Việt', '0385485899', '$2y$10$OPr.9tx9Cmfluj4l0MpxWOYxXd2EPEjlgsYEWCiNVxNi6GVXKgJS6', 1, NULL, NULL, '2025-05-28 00:52:54', '2025-05-28 00:52:54', 'Không hoạt động', 'uploads/shipper/1748393574_339270412_1093103971406681_7793780546994289977_n.jpg', 'uploads/shipper/1748393574_339270412_1093103971406681_7793780546994289977_n.jpg', 'uploads/shipper/1748393574_339270412_1093103971406681_7793780546994289977_n.jpg', 'uploads/shipper/1748393574_339270412_1093103971406681_7793780546994289977_n.jpg', NULL);

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
(206, 'DH68355eb5f2053', 53, 16, 'giao thành công', '13:46 27/05/2025: Đơn hàng của bạn đã được giao thành công', '2025-05-27 13:46:41', 'đã giao hàng'),
(207, 'DH68356999ab9fb', 48, 1, 'đợi lấy hàng', '14:28 27/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-27 14:28:48', NULL),
(208, 'DH683590537c1a5', 47, 1, 'đợi lấy hàng', '17:13 27/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-27 17:13:59', NULL),
(209, 'DH683590537c1a5', 47, 1, 'đã lấy hàng', '00:24 28/05/2025: Đơn hàng đã được shipper lấy', '2025-05-28 00:24:20', NULL),
(210, 'DH683590537c1a5', 47, 1, 'ở bưu cục', '00:24 28/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục Lê Đức Thọ', '2025-05-28 00:24:24', 'đợi vận chuyển qua bưu cục khác'),
(211, 'DH683590537c1a5', NULL, 1, 'trong xe', '00:24 28/05/2025: Đơn hàng của bạn đã rời Bưu cục Lê Đức Thọ', '2025-05-28 00:24:33', NULL),
(212, 'DH683590537c1a5', NULL, 16, 'ở bưu cục', '00:24 28/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-28 00:24:38', 'đợi vận chuyển qua bưu cục khác'),
(213, 'DH683590537c1a5', NULL, 1, 'trong xe', '00:24 28/05/2025: Đơn hàng của bạn đã rời Bưu cục Lê Đức Thọ', '2025-05-28 00:24:40', NULL),
(214, 'DH6835f5ea37432', 46, 1, 'đợi lấy hàng', '00:27 28/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-28 00:27:12', NULL),
(215, 'DH6835f5ea37432', 46, 1, 'đã lấy hàng', '00:28 28/05/2025: Đơn hàng đã được shipper lấy', '2025-05-28 00:28:23', NULL),
(216, 'DH6835f5ea37432', 46, 1, 'ở bưu cục', '00:28 28/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục Lê Đức Thọ', '2025-05-28 00:28:24', 'đợi vận chuyển qua bưu cục khác'),
(217, 'DH6835f5ea37432', NULL, 1, 'trong xe', '00:28 28/05/2025: Đơn hàng của bạn đã rời Bưu cục Lê Đức Thọ', '2025-05-28 00:28:35', NULL),
(218, 'DH6835f5ea37432', NULL, 16, 'ở bưu cục', '00:28 28/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-28 00:28:41', 'có thể giao'),
(219, 'DH6835f5ea37432', 52, 16, 'đang đi giao', '00:29 28/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-28 00:29:53', 'đang đi giao'),
(220, 'DH68365cb27abc6', 48, 1, 'đợi lấy hàng', '07:46 28/05/2025: Đơn hàng đã được duyệt, chờ shipper tới lấy', '2025-05-28 07:46:09', NULL),
(221, 'DH68365cb27abc6', 48, 1, 'đã lấy hàng', '07:48 28/05/2025: Đơn hàng đã được shipper lấy', '2025-05-28 07:48:43', NULL),
(222, 'DH68365cb27abc6', 48, 1, 'ở bưu cục', '07:48 28/05/2025: Đơn hàng của bạn đang ở bưu cục Bưu cục Lê Đức Thọ', '2025-05-28 07:48:47', 'đợi vận chuyển qua bưu cục khác'),
(223, 'DH68365cb27abc6', NULL, 1, 'trong xe', '07:49 28/05/2025: Đơn hàng của bạn đã rời Bưu cục Lê Đức Thọ', '2025-05-28 07:49:14', NULL),
(224, 'DH68365cb27abc6', NULL, 7, 'ở bưu cục', '07:49 28/05/2025: Đơn hàng của bạn đã đến Bưu cục Nguyễn Thị Thập', '2025-05-28 07:49:20', 'đợi vận chuyển qua bưu cục khác'),
(225, 'DH68365cb27abc6', NULL, 1, 'trong xe', '07:49 28/05/2025: Đơn hàng của bạn đã rời Bưu cục Lê Đức Thọ', '2025-05-28 07:49:23', NULL),
(226, 'DH68365cb27abc6', NULL, 16, 'ở bưu cục', '07:49 28/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-28 07:49:27', 'có thể giao'),
(227, 'DH68365cb27abc6', 52, 16, 'đang đi giao', '07:49 28/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-28 07:49:56', 'đang đi giao'),
(228, 'DH6835f5ea37432', NULL, 16, 'ở bưu cục', '07:50 28/05/2025: Đơn hàng của bạn đã đến Bưu cục Tân Phước', '2025-05-28 07:50:02', 'có thể giao'),
(229, 'DH6835f5ea37432', 52, 16, 'đang đi giao', '07:50 28/05/2025: Đơn hàng đang được giao tới bạn', '2025-05-28 07:50:03', 'đang đi giao'),
(230, 'DH6835f5ea37432', 52, 16, 'hủy', '07:50 28/05/2025: Đơn hàng đã bị hủy vì: khach ko nghr may', '2025-05-28 07:50:18', NULL),
(231, 'DH68365cb27abc6', 52, 16, 'giao thành công', '07:50 28/05/2025: Đơn hàng của bạn đã được giao thành công', '2025-05-28 07:50:20', 'đã giao hàng');

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
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_khachhang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `shipper`
--
ALTER TABLE `shipper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `van_don`
--
ALTER TABLE `van_don`
  MODIFY `ma_van_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
