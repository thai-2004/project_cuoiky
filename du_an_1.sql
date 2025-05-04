-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `du_an_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `binh_luan`
--

CREATE TABLE `binh_luan` (
  `id_binh_luan` int NOT NULL,
  `id_kh` int NOT NULL COMMENT 'Id user',
  `id_san_pham` int NOT NULL COMMENT 'Id sản phẩm',
  `noi_dung` text COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Nội dung bình luận',
  `ngay_bl` date NOT NULL COMMENT 'Ngày bình luận',
  `display_binh_luan` int NOT NULL DEFAULT '1' COMMENT 'Trạng thái hiện thị (Xoá mềm)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `binh_luan`
--

INSERT INTO `binh_luan` (`id_binh_luan`, `id_kh`, `id_san_pham`, `noi_dung`, `ngay_bl`, `display_binh_luan`) VALUES
(5, 5, 23, 'Sản phẩm tuyệt vời lắm ~', '2025-04-20', 1),
(6, 5, 23, 'Sản phẩm 102\\đ', '2025-04-20', 1),
(7, 5, 23, '!0', '2025-04-20', 0),
(8, 5, 23, '012', '2025-04-20', 0),
(9, 5, 23, '10đ', '2025-04-20', 0),
(10, 8, 23, 'qweqweqweqwcvcsd', '2025-04-20', 1),
(11, 13, 39, 'Sản phẩm này còn không?', '2025-04-20', 0),
(12, 13, 39, 'Sản phẩm thật tuyệt nhỉ\n', '2025-04-20', 1),
(13, 13, 39, 'Hello', '2025-04-20', 1),
(14, 13, 39, 'Tuyệt vời ', '2025-04-20', 1),
(15, 13, 39, 'hello\n', '2025-04-20', 1),
(16, 13, 37, 'Sản phẩm này còn không\n', '2025-04-20', 1),
(17, 13, 37, 'Có chống nước không vậy', '2025-04-20', 1),
(18, 13, 35, 'Ngay từ cái nhìn đầu tiên, Olym Pianus OP990-45ADGS-GL-X mặt xanh mang hơi thở tiểu Hublot đã ghi dấu ấn tượng với giới mộ điệu. Mặc dù có size mặt 42mm khá lớn nhưng dây cao su mềm, kích cỡ vừa phải khiến sản phẩm vẫn tạo ra sự gọn gàng trên cổ tay 15 - 18cm của nam giới.', '2025-04-20', 1),
(19, 13, 35, ' Hublot đã ghi dấu ấn tượng với giới mộ điệu. Mặc dù có size mặt 42mm khá lớn nhưng dây cao su mềm, kích cỡ vừa phải khiến sản phẩm vẫn tạo ra sự gọn gàng trên cổ tay 15 - 18cm của nam giới.', '2025-04-20', 1),
(20, 13, 33, 'Ngay từ cái nhìn đầu tiên, Olym Pianus OP990-45ADGS-GL-X mặt xanh mang hơi thở tiểu Hublot đã ghi dấu ấn tượng với giới mộ điệu. Mặc dù có size mặt 42mm khá lớn nhưng dây cao su mềm, kích cỡ vừa phải khiến sản phẩm vẫn tạo ra sự gọn gàng trên cổ tay 15 - 18cm của nam giới.', '2025-04-20', 1),
(21, 5, 39, 'bvcccác', '2025-04-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id_chat` int NOT NULL COMMENT 'Id cuộc trò chuyện',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id_chat`, `time`) VALUES
(15272, '2025-04-20 01:34:49'),
(15628, '2025-04-20 23:33:32'),
(25864, '2025-04-20 02:21:35'),
(37269, '2025-04-20 01:34:16'),
(41229, '2025-04-20 01:42:56'),
(42647, '2025-04-20 01:34:16'),
(51959, '2025-04-20 01:34:16'),
(83078, '2025-04-20 01:34:16'),
(83658, '2025-04-20 09:30:01'),
(92204, '2025-04-20 01:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id_chi_tiet_don_hang` int NOT NULL,
  `id_don_hang` int NOT NULL COMMENT 'Id đơn hàng',
  `id_chi_tiet_san_pham` int NOT NULL COMMENT 'Id chi tiết sản phẩm',
  `so_luong` int NOT NULL COMMENT 'Số lượng sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id_chi_tiet_don_hang`, `id_don_hang`, `id_chi_tiet_san_pham`, `so_luong`) VALUES
(9, 71974, 25, 3),
(10, 71974, 23, 2),
(11, 25386, 25, 2),
(12, 25386, 23, 3),
(13, 85286, 20, 1),
(14, 101766, 21, 1),
(15, 20351, 25, 1),
(16, 22059, 20, 2),
(17, 22059, 25, 2),
(18, 31287, 25, 2),
(19, 31287, 20, 3),
(20, 31287, 22, 5),
(22, 108260, 25, 2),
(23, 14848, 25, 1),
(24, 36126, 25, 1),
(25, 55825, 25, 1),
(26, 87178, 25, 1),
(27, 96804, 25, 1),
(28, 21323, 24, 1),
(29, 14611, 17, 1),
(30, 63103, 17, 1),
(31, 91389, 23, 1),
(32, 78860, 25, 1),
(33, 50466, 25, 1),
(34, 14877, 16, 1),
(35, 106594, 16, 1),
(36, 98082, 25, 1),
(37, 104243, 25, 1),
(38, 100485, 25, 1),
(39, 67452, 25, 1),
(40, 75831, 25, 1),
(41, 60877, 25, 1),
(42, 33712, 25, 1),
(43, 87838, 25, 1),
(44, 104205, 25, 1),
(45, 108383, 25, 1),
(46, 38077, 25, 1),
(47, 97641, 25, 1),
(48, 67845, 25, 1),
(49, 37438, 25, 1),
(50, 80792, 25, 1),
(51, 29452, 25, 1),
(52, 58872, 23, 1),
(53, 24297, 21, 1),
(54, 52338, 25, 1),
(55, 52878, 25, 1),
(56, 101188, 25, 1),
(57, 84189, 25, 1),
(58, 101194, 25, 1),
(59, 42653, 25, 1),
(60, 30132, 25, 1),
(61, 16100, 25, 1),
(62, 25717, 20, 1),
(63, 58397, 22, 1),
(64, 24381, 23, 1),
(65, 24381, 23, 1),
(66, 105158, 23, 1),
(67, 105158, 23, 1),
(68, 66635, 23, 1),
(69, 66635, 23, 1),
(70, 59616, 23, 1),
(71, 59616, 23, 1),
(72, 63887, 23, 1),
(73, 63887, 23, 1),
(74, 30246, 25, 1),
(75, 30246, 25, 1),
(76, 17286, 23, 1),
(77, 17286, 23, 1),
(78, 34417, 25, 1),
(79, 34417, 25, 1),
(80, 86378, 23, 1),
(81, 86378, 23, 1),
(82, 65233, 23, 1),
(83, 65233, 23, 1),
(84, 38548, 23, 1),
(85, 38548, 23, 1),
(86, 44536, 23, 1),
(87, 44536, 23, 1),
(88, 44122, 23, 1),
(89, 44122, 23, 1),
(90, 104429, 23, 1),
(91, 104429, 23, 1),
(92, 72010, 23, 1),
(93, 72010, 23, 1),
(94, 82322, 23, 1),
(95, 82322, 23, 1),
(96, 12400, 23, 1),
(97, 12400, 23, 1),
(98, 36694, 23, 1),
(99, 36694, 23, 1),
(100, 77820, 23, 1),
(101, 77820, 23, 1),
(102, 74401, 23, 1),
(103, 74401, 23, 1),
(104, 108850, 23, 1),
(105, 108850, 23, 1),
(106, 65167, 23, 1),
(107, 65167, 23, 1),
(108, 24776, 23, 1),
(109, 24776, 23, 1),
(110, 68137, 23, 1),
(111, 68137, 23, 1),
(112, 65316, 23, 1),
(113, 65316, 23, 1),
(114, 57873, 23, 1),
(115, 57873, 23, 1),
(116, 35300, 23, 1),
(117, 35300, 23, 1),
(118, 21103, 23, 1),
(119, 21103, 23, 1),
(120, 104656, 23, 1),
(121, 104656, 23, 1),
(122, 70926, 23, 1),
(123, 70926, 23, 1),
(124, 53703, 23, 1),
(125, 53703, 23, 1),
(126, 28549, 23, 1),
(127, 28549, 23, 1),
(128, 76628, 23, 1),
(129, 76628, 23, 1),
(130, 40064, 23, 1),
(131, 40064, 23, 1),
(132, 106032, 23, 1),
(133, 73575, 23, 1),
(134, 62876, 23, 1),
(135, 71531, 23, 1),
(136, 82577, 23, 1),
(137, 15626, 23, 1),
(138, 59383, 23, 1),
(139, 59383, 25, 1),
(140, 76817, 23, 1),
(141, 53297, 23, 1),
(142, 31260, 21, 1),
(143, 57563, 25, 1),
(144, 82661, 25, 1),
(145, 32226, 25, 2),
(146, 32226, 23, 2),
(147, 100703, 25, 1),
(148, 58714, 35, 1),
(149, 97278, 34, 1),
(150, 34310, 34, 1),
(151, 90710, 34, 1),
(152, 99235, 34, 1),
(153, 43721, 34, 1),
(154, 76534, 25, 3),
(155, 76534, 23, 2),
(156, 76534, 21, 1),
(157, 76534, 19, 2),
(158, 76534, 17, 1),
(159, 76534, 34, 1),
(160, 16450, 34, 1),
(161, 110099, 12, 1),
(162, 25986, 34, 1),
(163, 101612, 34, 1),
(164, 46852, 34, 1),
(165, 18905, 34, 1),
(166, 105437, 34, 1),
(167, 73946, 42, 1),
(168, 17636, 49, 1),
(169, 104847, 46, 5),
(170, 38134, 36, 1),
(171, 92651, 49, 1),
(172, 18572, 16, 1),
(173, 107215, 34, 1),
(174, 80124, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_san_pham`
--

CREATE TABLE `chi_tiet_san_pham` (
  `id_chi_tiet_san_pham` int NOT NULL,
  `so_luong` int NOT NULL DEFAULT '1' COMMENT 'Số lượng sản phẩm',
  `ngay_nhap` datetime NOT NULL COMMENT 'Ngày nhập',
  `display_detail_san_pham` int NOT NULL DEFAULT '1' COMMENT 'Trạng thái hiện thị (Xoá mềm)',
  `id_san_pham` int NOT NULL COMMENT 'Id sản phẩm',
  `id_size` int NOT NULL COMMENT 'Id size',
  `id_mau` int NOT NULL COMMENT 'Id màu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `chi_tiet_san_pham`
--

INSERT INTO `chi_tiet_san_pham` (`id_chi_tiet_san_pham`, `so_luong`, `ngay_nhap`, `display_detail_san_pham`, `id_san_pham`, `id_size`, `id_mau`) VALUES
(11, 119, '2025-04-17 09:51:02', 1, 12, 6, 1),
(12, 88, '2025-04-17 09:51:02', 1, 12, 4, 3),
(13, 68, '2025-04-17 09:51:02', 1, 13, 7, 1),
(14, 120, '2025-04-17 09:51:02', 1, 13, 4, 3),
(15, 86, '2025-04-17 09:51:02', 1, 14, 4, 1),
(16, 105, '2025-04-17 09:51:02', 1, 14, 5, 2),
(17, 39, '2025-04-17 09:51:02', 1, 15, 5, 1),
(18, 210, '2025-04-17 09:51:02', 1, 16, 6, 3),
(19, 219, '2025-04-19 09:51:02', 1, 17, 4, 1),
(20, 74, '2025-04-19 09:51:02', 1, 18, 5, 3),
(21, 19, '2025-04-19 09:51:02', 1, 19, 5, 3),
(22, 17, '2025-04-19 09:51:02', 1, 20, 3, 1),
(23, 96, '2025-04-19 09:51:02', 1, 21, 4, 3),
(24, 56, '2025-04-19 09:51:02', 1, 22, 5, 1),
(25, 88, '2025-04-19 09:51:02', 1, 23, 5, 2),
(26, 29, '2025-04-19 09:51:02', 1, 23, 5, 2),
(27, 45, '2023-11-11 09:51:02', 1, 24, 4, 2),
(28, 43, '2025-04-19 09:51:02', 1, 24, 5, 1),
(29, 48, '2025-04-19 09:51:02', 1, 25, 5, 1),
(30, 12, '2025-04-19 09:51:02', 1, 25, 4, 3),
(31, 23, '2025-04-20 09:51:02', 1, 26, 4, 2),
(32, 123, '2025-04-19 09:51:02', 1, 26, 3, 3),
(33, 12, '2025-04-19 09:51:02', 1, 36, 5, 1),
(34, 32, '2025-04-20 09:51:02', 1, 39, 4, 2),
(35, 42, '2025-04-20 09:51:02', 1, 38, 5, 1),
(36, 36, '2025-04-20 09:51:02', 1, 37, 4, 3),
(37, 37, '2025-04-20 09:51:02', 1, 37, 6, 1),
(38, 78, '2025-04-20 09:51:02', 1, 36, 5, 1),
(39, 372, '2025-04-20 09:51:02', 1, 35, 5, 2),
(40, 56, '2025-04-20 09:51:02', 1, 34, 4, 2),
(41, 453, '2025-04-20 09:51:02', 1, 33, 4, 1),
(42, 42, '2025-04-20 09:51:02', 1, 31, 4, 2),
(43, 45, '2025-04-20 09:51:02', 1, 24, 4, 1),
(44, 44, '2025-04-20 09:51:02', 1, 30, 6, 3),
(45, 134, '2025-04-20 09:51:02', 1, 29, 4, 2),
(46, 18, '2025-04-20 09:51:02', 1, 35, 5, 1),
(47, 233, '2025-04-20 09:51:02', 1, 34, 5, 1),
(48, 45, '2025-04-20 09:51:02', 1, 33, 7, 1),
(49, 43, '2025-04-20 09:51:02', 1, 32, 3, 2),
(50, 45, '2025-04-20 09:51:02', 1, 30, 6, 1),
(51, 65, '2025-04-20 09:51:02', 1, 33, 5, 2),
(52, 173, '2025-04-20 09:51:02', 1, 28, 4, 1),
(53, 95, '2025-04-20 09:51:02', 1, 27, 6, 2),
(54, 26, '2025-04-20 09:51:02', 1, 41, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia`
--

CREATE TABLE `danh_gia` (
  `id_danh_gia` int NOT NULL,
  `id_kh` int NOT NULL COMMENT 'Id user',
  `id_san_pham` int NOT NULL COMMENT 'Id sản phẩm',
  `danh_gia` int NOT NULL COMMENT 'Số sao đánh giá',
  `noi_dung` text COLLATE utf8mb3_vietnamese_ci COMMENT 'Nội dung đánh giá',
  `ngay_danh_gia` date NOT NULL COMMENT 'Ngày đánh giá',
  `display_danh_gia` int NOT NULL DEFAULT '1' COMMENT 'Trạng thái hiện thi(Xoá mềm)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `danh_gia`
--

INSERT INTO `danh_gia` (`id_danh_gia`, `id_kh`, `id_san_pham`, `danh_gia`, `noi_dung`, `ngay_danh_gia`, `display_danh_gia`) VALUES
(3, 5, 18, 4, 'Sản phẩm tốt', '2025-04-17', 0),
(4, 5, 18, 4, 'qweqwr', '2025-04-17', 1),
(5, 5, 15, 4, 'Đồng hồ LW-204-4ADF 5*', '2025-04-17', 1),
(6, 5, 17, 4, 'asssssssssssssssssssssssss', '2025-04-17', 1),
(7, 13, 32, 4, 'Phục vụ tốt, tư vấn nhiệt tình, chu đáo. Cảm thấy hài lòng', '2025-04-17', 1),
(9, 13, 31, 5, 'Phục vụ tốt, tư vấn nhiệt tình, chu đáo. Cảm thấy hài lòng', '2025-04-17', 1),
(10, 13, 35, 5, 'Phục vụ tốt, tư vấn nhiệt tình, chu đáo. Cảm thấy hài lòng', '2025-04-17', 1),
(11, 13, 37, 4, 'Sản phẩm tốt ', '2025-04-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id_danh_muc` int NOT NULL COMMENT 'Id danh mục',
  `ten_danh_muc` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Name danh mục',
  `display_danh_muc` int NOT NULL DEFAULT '1' COMMENT 'Trạng thái hiện thị (Xoá mềm)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `danh_muc`
--

INSERT INTO `danh_muc` (`id_danh_muc`, `ten_danh_muc`, `display_danh_muc`) VALUES
(21, 'Đồng Hồ Casio', 1),
(22, 'Đồng Hồ Orient', 1),
(23, 'Đồng Hồ Tommy Hilfiger', 1),
(24, 'Đồng hồ Epos Swiss', 0);

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id_don_hang` int NOT NULL,
  `id_kh` int DEFAULT NULL COMMENT 'Id user',
  `phone` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Số điện thoại người nhận',
  `dia_chi_giao` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Địa chỉ giao hàng',
  `id_trang_thai_don` int NOT NULL COMMENT 'Trạng thái đơn hàng',
  `ngay_tao` date NOT NULL COMMENT 'Ngày tạo đơn',
  `ngay_update` date DEFAULT NULL COMMENT 'Ngày cập nhập đơn hàng',
  `payment_method` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Phương thức thanh toán',
  `note` text COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Ghi chú đơn hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id_don_hang`, `id_kh`, `phone`, `dia_chi_giao`, `id_trang_thai_don`, `ngay_tao`, `ngay_update`, `payment_method`, `note`) VALUES
(12400, NULL, '0385521231', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Văn Môn', 4, '2025-04-20', '2025-04-20', 'Thanh toán Online', '05563'),
(14611, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-20', '2025-04-20', 'Thanh toán khi nhận hàng', '1562'),
(14848, NULL, '0987215123', 'Thành phố Hà Nội, Quận Hoàn Kiếm, Phường Hàng Mã', 1, '2025-04-20', '2025-04-20', 'Thanh toán khi nhận hàng', '0147'),
(14877, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-20', '2025-04-20', 'Thanh toán khi nhận hàng', '3:49 25-11-23'),
(15626, 5, '099999991', 'Tỉnh Phú Thọ, Huyện Thanh Thuỷ, Xã Đoan Hạ', 2, '2025-04-20', '2025-04-20', 'Thanh toán Online', 'ádáđasavds'),
(16100, 5, '099999991', 'Thành phố Hải Phòng, Huyện Tiên Lãng, Xã Tiên Minh', 1, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', '.12.'),
(16450, 5, '099999991', 'Tỉnh Hải Dương, Huyện Tứ Kỳ, Xã Văn Tố', 6, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', '9638jknjk'),
(17286, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Huyện Yên Lạc, Xã Liên Châu', 1, '2025-04-21', '2025-04-21', 'Thanh toán Online', 'đasad'),
(17636, 13, '0385521231', 'Tỉnh Vĩnh Phúc, Thành phố Phúc Yên, Xã Cao Minh', 5, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', 'Ngay từ cái nhìn đầu tiên'),
(18572, NULL, '0385521231', 'Tỉnh Bắc Giang, Thành phố Bắc Giang, Xã Tân Mỹ', 1, '2025-04-21', '2025-04-21', 'Thanh toán Online', 'cá'),
(18905, NULL, '0987215123', 'Tỉnh Bắc Ninh, Huyện Tiên Du, Xã Tri Phương', 1, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', 'a'),
(20351, 8, '088888883', 'Tỉnh Hải Dương, Huyện Tứ Kỳ, Xã Tân Kỳ', 1, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', 'vdbdfb'),
(21103, NULL, '0385521231', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Long Châu', 1, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', 'fa'),
(21323, NULL, '0385521231', 'Thành phố Hà Nội, Quận Ba Đình, Phường Vĩnh Phúc', 1, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', 'vdfbdfb'),
(22059, 5, '099999991', 'Tỉnh Cao Bằng, Huyện Hà Quảng, Xã Sóc Hà', 6, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', 'sfdsfsd'),
(24297, 5, '099999991', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Văn Môn', 1, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', '74'),
(24381, NULL, '0385521231', 'Tỉnh Hải Dương, Huyện Ninh Giang, Xã Hiệp Lực', 1, '2025-04-21', '2025-04-21', 'Thanh toán Online', 'cas'),
(24776, NULL, '08888888', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Văn Môn', 1, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', '1565'),
(25386, 5, '099999991', 'Tỉnh Yên Bái, Thị xã Nghĩa Lộ, Phường Cầu Thia', 6, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', 'sấdsàdsf'),
(25717, 5, '099999991', 'Tỉnh Phú Thọ, Huyện Thanh Thuỷ, Xã Bảo Yên', 1, '2025-04-21', '2025-04-21', 'Thanh toán khi nhận hàng', '963'),
(25986, 12, '1231', 'Thành phố Hà Nội, Quận Nam Từ Liêm, Phường Cầu Diễn', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'xin 5 củ'),
(28549, NULL, '0385521231', 'Tỉnh Bắc Giang, Huyện Việt Yên, Xã Ninh Sơn', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', '156'),
(29452, NULL, '0385521231', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Hạp Lĩnh', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', '98'),
(30132, 5, '099999991', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Nam Sơn', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', '2581'),
(30246, NULL, '0385521231', 'Tỉnh Phú Thọ, Huyện Lâm Thao, Xã Thạch Sơn', 1, '2025-04-22', '2025-04-22', 'Thanh toán Online', 'csa'),
(30994, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Thành phố Vĩnh Yên, Phường Đồng Tâm', 1, '2025-04-22', '2025-04-22', 'Thanh toán Online', '2:53 27/11'),
(31260, NULL, '0385521231', 'Tỉnh Thái Nguyên, Huyện Đồng Hỷ, Thị trấn Hóa Thượng', 1, '2025-04-22', '2025-04-22', 'Thanh toán Online', 'vsdvsd'),
(31287, 5, '099999991', 'Thành phố Hải Phòng, Huyện Vĩnh Bảo, Xã Vinh Quang', 6, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'fghfgh'),
(32226, 5, '099999991', 'Tỉnh Bắc Giang, Thành phố Bắc Giang, Xã Dĩnh Trì', 6, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'hvhv'),
(33712, NULL, '08888888', 'Thành phố Hà Nội, Quận Hoàn Kiếm, Phường Phúc Tân', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'vfd'),
(34310, NULL, '0987215123', 'Tỉnh Hà Giang, Thành phố Hà Giang, Phường Quang Trung', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', '796'),
(34417, NULL, '0385521231', 'Tỉnh Phú Thọ, Huyện Tam Nông, Xã Quang Húc', 1, '2025-04-22', '2025-04-22', 'Thanh toán Online', 'vfdv'),
(35300, NULL, '08888888', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Văn Môn', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'csa'),
(36126, 5, '099999991', 'Thành phố Hà Nội, Thị xã Sơn Tây, Xã Cổ Đông', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'Mua ngay Login'),
(36694, NULL, '0385521231', 'Thành phố Hải Phòng, Huyện Vĩnh Bảo, Xã Tam Đa', 1, '2025-04-22', '2025-04-22', 'Thanh toán Online', 'vfdb'),
(37438, NULL, '0385521231', 'Tỉnh Bắc Giang, Huyện Yên Dũng, Xã Đồng Việt', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'vf'),
(38077, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Huyện Vĩnh Tường, Xã Thượng Trưng', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'vdfb'),
(38134, 13, '0385521231', 'Tỉnh Vĩnh Phúc, Thành phố Vĩnh Yên, Phường Khai Quang', 5, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', 'with contrasting foreground'),
(38548, NULL, 'vsdv', 'Thành phố Hải Phòng, Huyện Cát Hải, Xã Hiền Hào', 1, '2025-04-22', '2025-04-22', 'Thanh toán Online', 'vsd'),
(40064, NULL, '08888888', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Văn Môn', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', '65'),
(42653, NULL, '0385521231', 'Tỉnh Hải Dương, Huyện Ninh Giang, Xã Hiệp Lực', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', '9870'),
(43721, NULL, '0385521231', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', '75331'),
(44122, NULL, '0385521231', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Văn Môn', 1, '2025-04-22', '2025-04-22', 'Thanh toán Online', 'hmj'),
(44536, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Huyện Vĩnh Tường, Xã Thượng Trưng', 1, '2025-04-22', '2025-04-22', 'Thanh toán Online', '51'),
(46852, NULL, '0987215123', 'Tỉnh Vĩnh Phúc, Huyện Tam Đảo, Thị trấn Đại Đình', 1, '2025-04-22', '2025-04-22', 'Thanh toán khi nhận hàng', '12'),
(50466, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', '3:48 25/11/23'),
(52338, 5, '099999991', 'Tỉnh Vĩnh Phúc, Huyện Vĩnh Tường, Xã Tân Phú', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', 'áđ'),
(52878, 5, '099999991', 'Tỉnh Hải Dương, Huyện Ninh Giang, Xã Văn Hội', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', '123'),
(53297, NULL, '0987215123', 'Tỉnh Vĩnh Phúc, Thành phố Phúc Yên, Phường Nam Viêm', 1, '2025-04-17', '2025-04-17', 'Thanh toán Online', '4539'),
(53703, NULL, '0987215123', 'Tỉnh Hải Dương, Huyện Tứ Kỳ, Xã Minh Đức', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', '698'),
(55825, NULL, '08888888', 'Tỉnh Bắc Giang, Huyện Yên Thế, Thị trấn Bố Hạ', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', 'QWE'),
(57563, NULL, '0385521231', 'Tỉnh Hà Giang, Huyện Đồng Văn, Xã Hố Quáng Phìn', 1, '2025-04-17', '2025-04-17', 'Thanh toán Online', 'déw'),
(57873, NULL, '08888888', 'Tỉnh Phú Thọ, Huyện Thanh Thuỷ, Xã Đồng Trung', 1, '2025-04-17', '2025-04-18', 'Thanh toán khi nhận hàng', '5156'),
(58397, 5, '099999991', 'Tỉnh Phú Thọ, Huyện Thanh Thuỷ, Xã Đoan Hạ', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', '78963'),
(58714, NULL, '4324234', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-17', '2025-04-17', 'Thanh toán Online', 'ds'),
(58872, 5, '099999991', 'Tỉnh Vĩnh Phúc, Huyện Vĩnh Tường, Xã Thượng Trưng', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', '245'),
(59383, 5, '099999991', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', '2hjkbjkbjkbjkbjkjk'),
(59616, NULL, '0385521231', 'Tỉnh Hải Dương, Huyện Ninh Giang, Xã Hồng Phúc', 1, '2025-04-17', '2025-04-17', 'Thanh toán Online', '4156'),
(60877, NULL, '0385521231', 'Thành phố Hà Nội, Quận Hoàn Kiếm, Phường Phúc Tân', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '9:14 27/11/23'),
(62876, NULL, '0987215123', 'Tỉnh Phú Thọ, Huyện Tam Nông, Xã Tề Lễ', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', 'dqwd'),
(63103, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '1562'),
(63887, NULL, '0987215123', 'Tỉnh Vĩnh Phúc, Huyện Sông Lô, Xã Đồng Thịnh', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', 'vsd'),
(65167, NULL, '08888888', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Nam Sơn', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '96676'),
(65233, NULL, '0385521231', 'Tỉnh Phú Thọ, Huyện Tân Sơn, Xã Long Cốc', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', 'vsdv'),
(65316, NULL, '0987215123', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Hạp Lĩnh', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '159898'),
(66635, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Huyện Yên Lạc, Xã Liên Châu', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', 'ngh'),
(67452, NULL, '0385521231', 'Tỉnh Bắc Giang, Huyện Yên Dũng, Xã Đức Giang', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', '10:27 26/11/23'),
(67845, NULL, '0385521231', 'Tỉnh Bắc Giang, Huyện Yên Dũng, Xã Đồng Việt', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', 'vf'),
(68137, NULL, '08888888', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Văn Môn', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '1565'),
(70926, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Huyện Vĩnh Tường, Xã Thượng Trưng', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '2'),
(71531, 5, '099999991', 'Tỉnh Hải Dương, Huyện Tứ Kỳ, Xã Minh Đức', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '45378'),
(71974, 5, '099999991', 'Tỉnh Bắc Kạn, Huyện Chợ Đồn, Xã Đại Sảo', 6, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', 'bkjbjk'),
(72010, NULL, '0385521231', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Nam Sơn', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', '`nkl'),
(73575, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Huyện Vĩnh Tường, Xã Tân Phú', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '256'),
(73946, 13, '0987215123', 'Tỉnh Hưng Yên, Thành phố Hưng Yên, Xã Hùng Cường', 5, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', 'Ngay từ cái nhìn đầu tiên'),
(74401, NULL, '08888888', 'Tỉnh Vĩnh Phúc, Huyện Yên Lạc, Xã Trung Kiên', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', '156'),
(75831, NULL, '0385521231', 'Tỉnh Phú Thọ, Huyện Thanh Sơn, Xã Thắng Sơn', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '8:50 27/11/23'),
(76534, 5, '099999991', 'Thành phố Hà Nội, Quận Hoàn Kiếm, Phường Phúc Tân', 5, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '546645'),
(76628, NULL, '0385521231', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Nam Sơn', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '156'),
(76817, 5, '099999991', 'Tỉnh Hà Giang, Thành phố Hà Giang, Phường Quang Trung', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', '89789\n'),
(77820, NULL, '0385521231', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Khắc Niệm', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', '213123'),
(78860, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '3:48 25/11/23'),
(80124, NULL, '0385521231', 'Tỉnh Phú Thọ, Huyện Thanh Sơn, Xã Hương Cần', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', 'nklnkl'),
(80792, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Huyện Yên Lạc, Xã Đại Tự', 1, '2025-04-18', '2023-11-27', 'Thanh toán khi nhận hàng', '15'),
(82322, NULL, '0385521231', 'Thành phố Hải Phòng, Huyện Vĩnh Bảo, Xã Hưng Nhân', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', '4:01 27/11'),
(82577, 5, '099999991', 'Tỉnh Lạng Sơn, Huyện Văn Quan, Xã Bình Phúc', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', '453354'),
(82661, NULL, '0385521231', 'Tỉnh Bắc Giang, Huyện Yên Thế, Xã Tân Sỏi', 1, '2025-04-18', '2025-04-18', 'Thanh toán Online', 'bj'),
(84189, 5, '099999991', 'Tỉnh Vĩnh Phúc, Huyện Vĩnh Tường, Xã Tân Phú', 1, '2025-04-18', '2025-04-18', 'Thanh toán khi nhận hàng', 'v987'),
(85286, 5, '099999991', 'Tỉnh Bắc Ninh, Thị xã Quế Võ, Xã Yên Giả', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', 'czxcxz'),
(86378, NULL, '0385521231', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Nam Sơn', 1, '2025-04-19', '2025-04-19', 'Thanh toán Online', 'fsdf'),
(87178, NULL, '0385521231', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', 'czxcxz'),
(87838, NULL, '08888888', 'Tỉnh Phú Thọ, Huyện Thanh Thuỷ, Xã Đoan Hạ', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', '9:41 Shipcod 27/11'),
(90710, NULL, '0987215123', 'Tỉnh Hà Giang, Thành phố Hà Giang, Phường Quang Trung', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', '796'),
(91389, NULL, '0385521231', 'Thành phố Hà Nội, Quận Hoàn Kiếm, Phường Phúc Tân', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', 'hgmh'),
(92081, NULL, '0385521231', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Khắc Niệm', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', '64'),
(92651, 13, '0987215123', 'Tỉnh Hưng Yên, Thành phố Hưng Yên, Xã Hùng Cường', 5, '2025-04-19', '2025-04-19', 'Thanh toán Online', 'ORDER BY don_hang.ngay_tao DESC'),
(96804, NULL, '08888888', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Nam Sơn', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', 'vdsvdf'),
(97278, NULL, '0987215123', 'Tỉnh Hà Giang, Thành phố Hà Giang, Phường Quang Trung', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', '796'),
(97641, NULL, '0385521231', 'Tỉnh Bắc Giang, Huyện Yên Dũng, Xã Đồng Việt', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', 'vf'),
(98082, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', '3:51 25-11-23'),
(99235, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', '45'),
(100485, 5, '099999991', 'Tỉnh Quảng Ninh, Huyện Đầm Hà, Xã Quảng Lâm', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', 'kj'),
(100703, 5, '099999991', 'Tỉnh Bắc Ninh, Huyện Yên Phong, Xã Văn Môn', 1, '2025-04-19', '2025-04-19', 'Thanh toán khi nhận hàng', 'b'),
(101188, 5, '099999991', 'Tỉnh Vĩnh Phúc, Huyện Yên Lạc, Xã Liên Châu', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', 'qwe123'),
(101194, NULL, '0385521231', 'Tỉnh Bắc Giang, Huyện Sơn Động, Xã Dương Hưu', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', '32\n'),
(101612, NULL, '0385521231', 'Tỉnh Phú Thọ, Huyện Thanh Sơn, Xã Đông Cửu', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', 'bjhkjk'),
(101766, 5, '099999991', 'Tỉnh Vĩnh Phúc, Huyện Lập Thạch, Xã Đình Chu', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', 'bcv vc '),
(104205, NULL, '08888888', 'Tỉnh Vĩnh Phúc, Thành phố Vĩnh Yên, Phường Khai Quang', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', 'dq'),
(104243, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', '3:51 25-11-23'),
(104429, NULL, '0385521231', 'Tỉnh Bắc Giang, Huyện Việt Yên, Xã Vân Trung', 1, '2025-04-13', '2025-04-13', 'Thanh toán Online', 'cacs'),
(104656, NULL, '0987215123', 'Tỉnh Vĩnh Phúc, Huyện Tam Đảo, Thị trấn Đại Đình', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', '6'),
(104847, 13, '0987215123', 'Tỉnh Hà Giang, Thành phố Hà Giang, Phường Quang Trung', 5, '2025-04-13', '2025-04-13', 'Thanh toán Online', 'Mặc dù có size mặt 42mm khá lớn nhưng dây cao su mềm'),
(105158, NULL, '0385521231', 'Tỉnh Phú Thọ, Huyện Thanh Thuỷ, Xã Đồng Trung', 1, '2025-04-13', '2025-04-13', 'Thanh toán Online', 'vdf'),
(105437, NULL, '0385521231', 'Tỉnh Vĩnh Phúc, Huyện Vĩnh Tường, Xã Bình Dương', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', 'njk'),
(106032, NULL, '0987215123', 'Tỉnh Phú Thọ, Huyện Thanh Sơn, Xã Tân Lập', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', '893'),
(106594, NULL, '0987215123', 'Thành phố Hà Nội, Quận Ba Đình, Phường Phúc Xá', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', '3:49 25-11-23'),
(107215, 5, '099999991', 'Tỉnh Sơn La, Huyện Mộc Châu, Xã Chiềng Khừa', 2, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', 'as'),
(108260, 5, '098662514', 'Thành phố Hà Nội, Quận Ba Đình, Phường Kim Mã', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', 'Ship tận giường'),
(108383, NULL, '0385521231', 'Tỉnh Bắc Ninh, Thành phố Bắc Ninh, Phường Nam Sơn', 1, '2025-04-13', '2025-04-13', 'Thanh toán khi nhận hàng', 'ca'),
(108850, NULL, '4324234', 'Tỉnh Vĩnh Phúc, Huyện Yên Lạc, Xã Trung Kiên', 1, '2025-04-13', '2025-04-13', 'Thanh toán Online', '245'),
(110099, 12, '113', 'Thành phố Hà Nội, Quận Hoàn Kiếm, Phường Tràng Tiền', 1, '2025-04-17', '2025-04-17', 'Thanh toán khi nhận hàng', 'giam gia đi');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_gio_hang` int NOT NULL,
  `id_kh` int NOT NULL,
  `id_chi_tiet_san_pham` int NOT NULL,
  `so_luong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mau`
--

CREATE TABLE `mau` (
  `id_mau` int NOT NULL,
  `mau` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Màu sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `mau`
--

INSERT INTO `mau` (`id_mau`, `mau`) VALUES
(1, 'Trắng'),
(2, 'Vàng'),
(3, 'Đen');

-- --------------------------------------------------------

--
-- Table structure for table `ma_giam_gia`
--

CREATE TABLE `ma_giam_gia` (
  `id_ma_giam_gia` int NOT NULL,
  `code` varchar(25) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `giam_gia` int NOT NULL,
  `so_luong` int NOT NULL,
  `ngay_het_han` date NOT NULL,
  `display_gg` int NOT NULL DEFAULT '1' COMMENT 'Trạng thái hiện thị (Xoá mềm)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `ma_giam_gia`
--

INSERT INTO `ma_giam_gia` (`id_ma_giam_gia`, `code`, `giam_gia`, `so_luong`, `ngay_het_han`, `display_gg`) VALUES
(1, 'QPLK4AC2', 11, 5, '2025-04-28', 0),
(2, 'X6K1ALK', 20, 3, '2025-04-28', 1),
(3, 'PKLAS12', 16, 25, '2025-04-28', 1),
(4, 'MNA4QA', 23, 16, '2025-04-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int NOT NULL COMMENT 'Id đoạn chat',
  `id_chat` int NOT NULL COMMENT 'Id đoạn chat',
  `id_send` int NOT NULL COMMENT 'Id người gửi (0: User - 1: Admin',
  `content` text COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Nội dung',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_message`, `id_chat`, `id_send`, `content`, `time`) VALUES
(2, 51959, 0, 'Có ai không?', '2025-04-20 08:32:57'),
(3, 51959, 0, 'Hello', '2025-04-20 08:36:22'),
(4, 51959, 1, 'Có', '2025-04-20 09:13:59'),
(5, 51959, 1, 'Tôi có thể giúp gì cho bạn?', '2025-04-20 09:17:13'),
(6, 51959, 0, 'Bạn tên gì', '2025-04-20 09:17:34'),
(7, 51959, 0, 'Bạn bao nhiu tuổi', '2025-04-20 09:18:52'),
(8, 51959, 1, '19', '2025-04-20 14:32:30'),
(9, 51959, 0, 'Chắc chứ', '2025-04-20 14:34:29'),
(10, 51959, 1, 'Không', '2025-04-20 14:38:05'),
(11, 51959, 0, '...', '2025-04-20 14:38:21'),
(12, 51959, 0, '?', '2025-04-20 14:40:31'),
(13, 51959, 0, '.', '2025-04-20 14:42:11'),
(14, 51959, 0, '.', '2025-04-20 14:51:55'),
(15, 51959, 1, 'Tôi có thể giúp gì cho bạn', '2025-04-20 14:52:27'),
(16, 51959, 0, 'Không gì', '2025-04-20 14:54:27'),
(17, 42647, 0, 'Hello', '2025-04-20 14:54:52'),
(18, 42647, 1, 'XIn chào', '2025-04-20 15:01:49'),
(19, 42647, 0, 'Không thích', '2025-04-20 15:02:08'),
(20, 42647, 1, '...', '2025-04-20 15:03:54'),
(21, 42647, 1, '147', '2025-04-20 15:05:39'),
(22, 42647, 0, '258', '2025-04-20 15:05:47'),
(23, 42647, 1, '369', '2025-04-20 15:13:55'),
(24, 83078, 0, 'Có ai không?', '2025-04-20 15:14:32'),
(25, 83078, 1, 'Không có đâu', '2025-04-20 15:36:09'),
(26, 92204, 0, 'alooooo', '2025-04-20 01:23:02'),
(27, 92204, 1, 'Không nghe', '2025-04-20 01:23:32'),
(28, 37269, 0, 'Nhắn cái gi', '2025-04-20 01:26:37'),
(29, 37269, 1, 'GÌ cũng dc', '2025-04-20 01:27:23'),
(30, 15272, 0, 'ht', '2025-04-20 01:34:49'),
(31, 15272, 1, 'qww', '2025-04-20 01:36:14'),
(32, 41229, 0, 'hello', '2025-04-20 01:42:56'),
(33, 41229, 0, 'aiiisa', '2025-04-20 01:43:13'),
(34, 41229, 1, 'helloooooô', '2025-04-20 01:44:04'),
(35, 41229, 0, 'có ai không', '2025-04-20 01:44:04'),
(36, 41229, 1, 'Không', '2025-04-20 01:44:10'),
(37, 41229, 0, 'ngon', '2025-04-20 01:44:12'),
(38, 25864, 0, 'a', '2025-04-20 02:21:35'),
(39, 25864, 1, 'a', '2025-04-20 02:21:41'),
(40, 25864, 1, 'Bạn cần hỗ trợ gì?', '2025-04-20 02:37:07'),
(41, 83658, 0, 'Hiện tại có thể nhắn không?', '2025-04-20 09:30:01'),
(42, 83658, 1, 'Có', '2025-04-20 09:30:19'),
(43, 83658, 1, 'Tôi có thể giúp gì cho bạn', '2025-04-20 09:30:27'),
(44, 83658, 0, 'Làm nào để giàu nhanh', '2025-04-20 09:30:55'),
(45, 83658, 1, 'Đi cướp', '2025-04-20 09:31:09'),
(46, 83658, 1, 'Hello', '2025-04-20 23:33:16'),
(47, 15628, 0, 'Hellooo', '2025-04-20 23:33:32'),
(48, 15628, 1, 'Tôi có thể giúp gì cho bạn', '2025-04-20 23:33:47'),
(49, 15628, 0, 'vsd', '2025-04-20 03:05:43'),
(50, 15628, 1, 'vds', '2025-04-20 03:06:16'),
(51, 15628, 0, '123', '2025-04-20 17:34:06'),
(52, 15628, 1, 'nkl', '2025-04-20 17:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int NOT NULL COMMENT 'Id thanh toán',
  `id_don_hang` int NOT NULL COMMENT 'Id đơn hàng',
  `amount` float NOT NULL COMMENT 'Số tiền thanh toán',
  `payment_method` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Phương thức thanh toán',
  `payment_status` int NOT NULL DEFAULT '0' COMMENT 'Trạng thái(Đã thanh toán, chưa thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `id_don_hang`, `amount`, `payment_method`, `payment_status`) VALUES
(26, 67452, 933000, 'Thanh toán Online', 1),
(27, 75831, 933000, 'Thanh toán khi nhận hàng', 0),
(28, 60877, 933000, 'Thanh toán khi nhận hàng', 0),
(29, 33712, 933000, 'Thanh toán khi nhận hàng', 0),
(30, 87838, 933000, 'Thanh toán khi nhận hàng', 0),
(31, 104205, 933000, 'Thanh toán khi nhận hàng', 0),
(32, 108383, 933000, 'Thanh toán khi nhận hàng', 0),
(33, 38077, 933000, 'Thanh toán khi nhận hàng', 0),
(34, 97641, 933000, 'Thanh toán khi nhận hàng', 0),
(35, 67845, 933000, 'Thanh toán khi nhận hàng', 0),
(36, 37438, 933000, 'Thanh toán khi nhận hàng', 0),
(37, 80792, 933000, 'Thanh toán khi nhận hàng', 0),
(38, 29452, 933000, 'Thanh toán khi nhận hàng', 0),
(39, 58872, 2468000, 'Thanh toán khi nhận hàng', 0),
(40, 24297, 870000, 'Thanh toán khi nhận hàng', 0),
(41, 52878, 933000, 'Thanh toán khi nhận hàng', 0),
(42, 101188, 933000, 'Thanh toán khi nhận hàng', 0),
(43, 84189, 933000, 'Thanh toán khi nhận hàng', 0),
(44, 101194, 933000, 'Thanh toán khi nhận hàng', 0),
(45, 42653, 933000, 'Thanh toán khi nhận hàng', 0),
(46, 30132, 933000, 'Thanh toán khi nhận hàng', 0),
(47, 16100, 933000, 'Thanh toán khi nhận hàng', 0),
(48, 25717, 372000, 'Thanh toán khi nhận hàng', 0),
(49, 58397, 1756000, 'Thanh toán khi nhận hàng', 0),
(55, 106032, 2468000, 'Thanh toán khi nhận hàng', 0),
(56, 73575, 2468000, 'Thanh toán khi nhận hàng', 0),
(57, 62876, 2468000, 'Thanh toán Online', 1),
(58, 71531, 2468000, 'Thanh toán khi nhận hàng', 0),
(59, 82577, 2468000, 'Thanh toán khi nhận hàng', 0),
(60, 15626, 2468000, 'Thanh toán Online', 1),
(61, 59383, 3401000, 'Thanh toán khi nhận hàng', 0),
(62, 76817, 2468000, 'Thanh toán Online', 1),
(63, 53297, 2468000, 'Thanh toán Online', 1),
(64, 31260, 870000, 'Thanh toán Online', 1),
(65, 57563, 933000, 'Thanh toán Online', 1),
(66, 82661, 933000, 'Thanh toán Online', 1),
(67, 32226, 6802000, 'Thanh toán khi nhận hàng', 0),
(68, 100703, 933000, 'Thanh toán khi nhận hàng', 0),
(69, 58714, 990000, 'Thanh toán Online', 1),
(70, 43721, 1638000, 'Thanh toán khi nhận hàng', 0),
(71, 76534, 10568900, 'Thanh toán khi nhận hàng', 0),
(72, 16450, 1501500, 'Thanh toán khi nhận hàng', 0),
(73, 110099, 1306000, 'Thanh toán khi nhận hàng', 0),
(74, 25986, 1501500, 'Thanh toán khi nhận hàng', 0),
(75, 101612, 1950000, 'Thanh toán khi nhận hàng', 0),
(76, 46852, 1950000, 'Thanh toán khi nhận hàng', 0),
(77, 18905, 1950000, 'Thanh toán khi nhận hàng', 0),
(78, 105437, 1950000, 'Thanh toán khi nhận hàng', 0),
(79, 73946, 11288000, 'Thanh toán khi nhận hàng', 0),
(80, 17636, 10154600, 'Thanh toán khi nhận hàng', 0),
(81, 104847, 39578000, 'Thanh toán Online', 1),
(82, 38134, 990000, 'Thanh toán khi nhận hàng', 0),
(83, 92651, 9308380, 'Thanh toán Online', 1),
(84, 18572, 1503000, 'Thanh toán Online', 1),
(85, 107215, 1638000, 'Thanh toán khi nhận hàng', 0),
(86, 80124, 1950000, 'Thanh toán Online', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reply_comment`
--

CREATE TABLE `reply_comment` (
  `id_reply_comment` int NOT NULL COMMENT 'Id phản hổi',
  `id_binh_luan` int NOT NULL COMMENT 'Id bình luận',
  `content` text COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Nội dung',
  `id_kh` int NOT NULL COMMENT 'Id khách hàng',
  `ngay_reply` date NOT NULL COMMENT 'Ngày trả lời'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `reply_comment`
--

INSERT INTO `reply_comment` (`id_reply_comment`, `id_binh_luan`, `content`, `id_kh`, `ngay_reply`) VALUES
(2, 10, 'test', 5, '2025-04-17'),
(3, 10, '626207', 5, '2025-04-17'),
(4, 10, '789', 5, '2025-04-17'),
(5, 6, 'test', 5, '2025-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_roles` int NOT NULL,
  `ten_vai_tro` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_roles`, `ten_vai_tro`) VALUES
(1, 'Khách hàng'),
(2, 'Nhân viên'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id_san_pham` int NOT NULL,
  `ten_san_pham` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Tên sản phẩm',
  `price` float NOT NULL,
  `mo_ta` text CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Mô tả sản phẩm',
  `hinh_anh` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `luot_xem` int NOT NULL DEFAULT '0' COMMENT 'Số lượt xem sản phẩm',
  `ngay_nhap` datetime NOT NULL COMMENT 'Ngày nhập',
  `display_san_pham` int NOT NULL DEFAULT '0' COMMENT 'Trạng thái hiện thị (Xoá mềm)',
  `id_danh_muc` int NOT NULL COMMENT 'Sản phẩm của danh mục'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id_san_pham`, `ten_san_pham`, `price`, `mo_ta`, `hinh_anh`, `luot_xem`, `ngay_nhap`, `display_san_pham`, `id_danh_muc`) VALUES
(12, 'Đồng Hồ Casio  AE-1200WHD-1AVDF', 1306000, 'Không quá khi nhận định rằng đồng hồ Casio AE-1200WHD-1AVDF là một trong số những mẫu “ăn khách” nhất Việt Nam. Bởi sản phẩm chỉ có mức giá tầm trung nhưng sở hữu đa chức năng tiện lợi và độ bền “khủng” đến khó tin cùng thiết kế cực “ngầu” với phái mạnh.\r\n\r\nVới những chiếc đồng hồ thuộc Series Casio AE1200 truyền thống, NSX đã thực hiện đúng phương châm “liên tục tạo ra những thứ quan trọng nhất đối với người dùng”. Vì sản phẩm giúp bạn tập trung tốt hơn vào việc xác định giờ giấc siêu chuẩn, cụ thể đến từng giây. ', '01.webp', 7, '2025-04-18 09:51:02', 1, 21),
(13, 'Đồng Hồ Casio  MTP-1374L-1AVDF ', 2094000, 'Trẻ trung, cá tính nhưng không kém phần thanh lịch và sang trọng; đó là 4 cụm từ mô tả chính xác về diện mạo của đồng hồ Casio MTP-1374L-1AVDF. Sản phẩm điện tử được mệnh danh là “lựa chọn mới cho phân khúc giá rẻ” này rất đáng để bất cứ ai trải nghiệm.\r\n\r\nNằm trong dòng Casio Dress, đồng hồ nam Casio MTP (viết tắt của Men’s Timepiece) được thiết kế dành riêng cho các anh em đam mê thể thao. Tất cả những yêu cầu cơ bản mà phái mạnh mong muốn như đồng hồ 6 kim, vòng benzel lớn, chịu nước tốt đều có thể tìm thấy ở chiếc đồng hồ Best Seller này.', '02.webp', 5, '2025-04-18 09:51:02', 1, 21),
(14, 'Đồng Hồ Casio  EFV-600L-2AVUDF', 1503000, 'Casio là một thương hiệu đồng hồ của Nhật Bản khai sinh năm 1946. Thương hiệu do ông Tadao Kashio sáng lập. Các dòng nổi bật của Casio phải kể đến như “G - Shock, Baby - G, Casio MTP,...”', '03.webp', 9, '2023-11-11 09:51:02', 1, 21),
(15, 'Đồng Hồ Casio LW-204-4ADF', 451000, 'Tuy không quý phái như dòng Sheen cũng không trẻ trung như Baby-G nhưng Casio LW-204-4ADF vẫn rất được lòng phái đẹp bởi vẻ cuốn hút kỳ lạ. Sản phẩm xua tan nỗi lo phối đồ cho các bạn gái dù ở trường học nghiêm trang hay nơi công sở lịch thiệp.\r\n\r\nNằm trong series Casio LW-204, model LW-204-4ADF Vintage tông hồng sáng thanh lịch kết hợp màn hình kỹ thuật số hiện đại mang lại phong thái cực sang chảnh cho các nàng. Mẫu đồng hồ này đáp ứng được sở thích của nữ giới với những chức năng quan trọng nhưng lại không khiến bạn phải tốn quá nhiều chi phí.', '04.webp', 14, '2023-11-11 09:51:02', 1, 21),
(16, 'Đồng Hồ Casio   MTP-VT01L-1BUDF', 725000, 'Bên cạnh dòng đồng hồ nam nổi tiếng như G-Shock thì Casio MTP-VT01L-1BUDF cũng là mẫu “làm mưa, làm gió” trên thị trường vừa qua. Sản phẩm thuộc phân khúc bình dân dành cho giới văn phòng nhưng vẫn sở hữu cấu tạo ấn tượng với các chức năng nổi bật.\r\n\r\nCùng một cặp với đồng hồ nữ LTP-VT01L-1BUDF tinh tế, đồng hồ nam MTP-VT01L-1BUDF lịch lãm còn là gợi ý đáng cân nhắc để phái đẹp gửi tặng người thương. Diện mạo cực thời trang của sản phẩm mang lại tính ứng dụng cao và phù hợp đeo trong nhiều sự kiện', '05.webp', 5, '2023-11-11 09:51:02', 1, 21),
(17, 'Đồng Hồ Casio  MTP-1375L-1AVDF', 788000, 'Năng động, trẻ trung, mạnh mẽ là 3 tính từ mô tả chính xác về chiếc đồng hồ nam Casio MTP-1375L-1AVDF. Sản phẩm được thiết kế dựa trên nguồn cảm hứng về các dòng Sport Watch nên mang đậm nét khỏe khoắn, phù hợp để tôn lên vẻ đẹp của đấng mày râu.\r\n\r\nAnh em có niềm đam mê với các môn thể thao nhưng ngại dùng đồng hồ nhiều tính năng phức tạp và giá thành cao sẽ được thỏa mãn với model MTP-1375L-1AVDF. Phụ kiện đeo tay này “cân” được mọi phong cách và đảm bảo độ bền “khủng” đến mức khó tin.', '06.webp', 3, '2023-11-11 09:51:02', 1, 21),
(18, 'Đồng Hồ Casio   GA-2100-1A1DR', 372000, 'Casio là một thương hiệu đồng hồ của Nhật Bản khai sinh năm 1946. Thương hiệu do ông Tadao Kashio sáng lập. Các dòng nổi bật của Casio phải kể đến như “G - Shock, Baby - G, Casio MTP,...”', '07.webp', 17, '2023-11-11 09:51:02', 1, 21),
(19, 'Đồng Hồ Casio F-91W-1DG', 870000, 'Casio là một thương hiệu đồng hồ của Nhật Bản khai sinh năm 1946. Thương hiệu do ông Tadao Kashio sáng lập. Các dòng nổi bật của Casio phải kể đến như “G - Shock, Baby - G, Casio MTP,...”', '08.webp', 10, '2023-11-11 09:51:02', 1, 21),
(20, 'Đồng Hồ Casio  LTP-V007L-7B1UDF', 1756000, 'So với dòng Casio MTP lịch lãm dành cho nam thì Casio LTP-V007L-7B1UDF thuộc bộ sưu tập Casio LTP (Lady Timepiece) lại là model tinh tế dành riêng cho nữ giới. Với thiết kế đơn giản, thanh lịch và dễ dùng; sản phẩm là lựa chọn thích hợp cho những cô nàng theo đuổi phong cách trang nhã.\r\n\r\nTrên thị trường cạnh tranh khốc liệt hiện nay, mẫu đồng hồ quốc dân LTP-V007L-7B1UDF vẫn tỏa sáng và được nhiều người dùng săn đón do sở hữu gam màu đen - trắng kinh điển, không bao giờ lỗi thời. Khi đeo phụ kiện này trên tay, phái đẹp được tôn lên vẻ thời thượng pha chút phá cách mới mẻ.', '09.webp', 7, '2023-11-11 09:51:02', 1, 21),
(21, 'Đồng Hồ Casio   MTP-1374D-1AVDF', 2468000, 'Hội tụ đầy đủ từ thiết kế đẹp, bền bỉ, tính năng đa dạng cùng mức giá phải chăng, đồng hồ Casio MTP-1374D-1AVDF là một lựa chọn mà phái mạnh rất nên tham khảo. Model này thuộc series Casio MTP-1374 nên kế thừa các nét thể thao khỏe khoắn kết hợp hài hòa với phong cách thanh lịch gây ấn tượng mạnh cho nhiều anh em, trong đó có giới văn phòng và các doanh nhân.', '10.webp', 95, '2023-11-11 09:51:02', 1, 21),
(22, 'Đồng Hồ Casio  Nam MTP-VT01D-1BUDF', 2468000, 'Ngay từ ánh nhìn đầu tiên, Casio MTP-VT01D-1BUDF đã làm xiêu lòng các chàng chuộng phong cách thanh lịch và tối giản. Sản phẩm tiếp tục khẳng định vị thế bá chủ của Casio trong phân khúc đồng hồ giá rẻ với mức chi phí “học sinh” nhưng chất lượng “phụ huynh”.\r\n\r\nLà một cặp với đồng hồ Casio LTP-VT01D-1BUDF, model MTP-VT01D-1BUDF “nổi đình đám” nhờ kiểu cách không quá cầu kỳ nhưng vẫn vô cùng sang trọng. Phụ kiện đơn giản mà mang đậm nét trang nhã này rất phù hợp với những người yêu thích vẻ đẹp mộc mạc, tinh tế.', '11.webp', 12, '2023-11-11 09:51:02', 1, 21),
(23, 'Đồng Hồ Casio  Nam MTP-1384L-1AVDF', 933000, 'Từ trước đến nay, Casio luôn nổi tiếng là dòng đồng hồ có chất lượng, mẫu mã đẹp và giá cả vô cùng phải chăng. Casio MTP-1384L-1AVDF chính là một trong những chiếc đồng hồ Casio được bán chạy nhất hiện nay, hãy cùng WatchStore khám phá chi tiết em đồng hồ này của nhà Casio nhé!', '12.webp', 614, '2023-11-11 09:51:02', 1, 21),
(24, 'Đồng hồ Orient Bambino  RA-AK0801S10B', 11130000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', '001.jpg', 0, '2023-11-11 09:51:02', 1, 22),
(25, 'Đồng hồ Orient Bambino   RA-AK0802S10B', 10570000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', '02.jpg', 2, '2023-11-11 09:51:02', 1, 22),
(26, 'Đồng hồ Orient Bambino  RA-AK0803Y10B ', 10570000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', '03.jpg', 0, '2023-11-11 09:51:02', 1, 22),
(27, 'Đồng hồ Orient Bambino  RA-AK0804Y10B ', 10570000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', '04.jpg', 2, '2023-11-11 09:51:02', 1, 22),
(28, 'Đồng hồ Orient Mako RA-AA0818L19B ', 8976000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', '05.jpg', 0, '2023-11-11 09:51:02', 1, 22),
(29, 'Đồng hồ Orient Star RE-AV0B09N00B ', 23624000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', 'o06.jpg', 1, '2023-11-11 09:51:02', 1, 22),
(30, 'Đồng hồ Orient Star  RE-AV0B08L00B ', 21144000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', 'o07.jpg', 1, '2023-11-11 09:51:02', 1, 22),
(31, 'Đồng hồ Orient Sun & Moon  RA-AS0011S10B', 11288000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', 'o08.jpg', 3, '2023-11-11 09:51:02', 1, 22),
(32, 'Đồng hồ Orient Sun & Moon  RA-AS0010S10B', 12088800, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', 'o09.jpg', 7, '2023-11-11 09:51:02', 1, 22),
(33, 'Đồng hồ Orient Sun & Moon  RA-AK0010B10B', 9920000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', 'o10.jpg', 5, '2023-11-11 09:51:02', 1, 22),
(34, 'Đồng hồ ORIENT Sun & Moon 41.5 mm Nam RA-AS0103A10B ', 9192000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', 'o11.jpg', 6, '2023-11-11 09:51:02', 1, 22),
(35, 'Đồng hồ ORIENT Sun & Moon  RA-AS0101S10B', 10280000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', 'o12.jpg', 10, '2023-11-11 09:51:02', 1, 22),
(36, 'Đồng hồ Orient Mako 41.8 mm Nam RA-AA0820R19B ', 8976000, 'Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nhìn một cách nhanh chóng. Đồng hồ Orient với những chất liệu cao cấp bóng bẩy nâng tầm đẳng cấp cho người sở hữu, phù hợp với doanh nhân thành đạt, dân văn phòng hay các giám đốc công ty. Phong cách thời thượng, sang trọng đầy sức thu hút đến từ đồng hồ Orient chắc chắn sẽ khiến bạn luôn hãnh diện với những người xung quanh.', 'o13.jpg', 9, '2023-11-11 09:51:02', 1, 22),
(37, 'Đồng hồ TOMMY HILFIGER  1782283', 990000, 'Sản phẩm đồng hồ mang thương hiệu Tommy Hilfiger, mang phong cách Mỹ cổ điển đầy phá cách. Những chiếc đồng hồ này được sản xuất vô cùng tỉ mỉ, chi tiết và thời trang.', 't1.jpg', 18, '2023-11-11 09:51:02', 1, 23),
(38, 'Đồng hồ TOMMY HILFIGER Skylar 1782263 ', 990000, 'Sản phẩm đồng hồ mang thương hiệu Tommy Hilfiger, mang phong cách Mỹ cổ điển đầy phá cách. Những chiếc đồng hồ này được sản xuất vô cùng tỉ mỉ, chi tiết và thời trang.', 't2.jpg', 5, '2023-11-11 09:51:02', 1, 23),
(39, 'Đồng hồ TOMMY HILFIGER  1782115', 1950000, 'Sản phẩm đồng hồ mang thương hiệu Tommy Hilfiger, mang phong cách Mỹ cổ điển đầy phá cách. Những chiếc đồng hồ này được sản xuất vô cùng tỉ mỉ, chi tiết và thời trang.', 't3.jpg', 118, '2023-11-11 09:51:02', 1, 23),
(41, 'Đồng hồ 0', 11130000, 'Đồng hồ lặn thể thao đầu tiên của Montblanc, Montblanc 1858 Iced Sea Automatic Date có mặt số hoa văn sông băng tạo ấn tượng như đang nhìn vào độ sâu của sông băng. Mặt số có hoa văn băng đen này được lấy cảm hứng từ Mer de Glace – Sea of ​​Ice – sông băng chính của Mont-Blanc Massif. Kết cấu của nó đã đạt được bằng cách sử dụng một kỹ thuật gần như bị lãng quên gọi là gratté-boisé. Chiếc đồng hồ này đi kèm với viền benzen bằng gốm ceramic hai màu một chiều, một mặt sau của vỏ được khắc và một vòng đeo tay bằng thép không gỉ có thể hoán đổi được thuôn nhọn với khả năng điều chỉnh tốt để phù hợp chính xác. Chiếc đồng hồ này đạt tiêu chuẩn ISO 6425 dành cho đồng hồ lặn và có khả năng chống nước ở độ sâu 300 mét.', 'o08.jpg', 2, '2023-11-11 09:51:02', 0, 22);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id_size` int NOT NULL,
  `size` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Kích thước size',
  `kich_thuoc` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Kích thước size '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id_size`, `size`, `kich_thuoc`) VALUES
(3, 'S', '23mm-25mm'),
(4, 'M', '26mm-29mm'),
(5, 'L', '34mm-36mm'),
(6, 'XL', '37mm-39mm'),
(7, 'XXL', '40mm-42mm'),
(8, '3XL', '45mm trở lên');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_don`
--

CREATE TABLE `trang_thai_don` (
  `id_trang_thai_don` int NOT NULL,
  `name_trang_thai_don` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `trang_thai_don`
--

INSERT INTO `trang_thai_don` (`id_trang_thai_don`, `name_trang_thai_don`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang xử lý'),
(4, 'Đang vận chuyển'),
(5, 'Giao thành công'),
(6, 'Đã huỷ'),
(8, 'Chờ thanh toán'),
(9, 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_kh` int NOT NULL COMMENT 'Id khách hàng',
  `ho_ten` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Họ và tên',
  `ten_dang_nhap` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Tên đăng nhập',
  `mat_khau` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Mật khẩu',
  `email` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL COMMENT 'Email',
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL COMMENT 'Số điện thoại',
  `hinh_anh` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT 'no-avatar.jpg' COMMENT 'Hình ảnh',
  `trang_thai` int DEFAULT '1' COMMENT 'Trạng thái hoạt động',
  `dia_chi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci DEFAULT NULL COMMENT 'Địa chỉ',
  `kich_hoat` int DEFAULT '1' COMMENT 'Khoá or kích hoạt',
  `display_user` int NOT NULL DEFAULT '1' COMMENT 'Trạng thái hiện thị (Xoá mềm)',
  `id_roles` int NOT NULL DEFAULT '1' COMMENT 'Khách hàng với vai trò'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_kh`, `ho_ten`, `ten_dang_nhap`, `mat_khau`, `email`, `phone`, `hinh_anh`, `trang_thai`, `dia_chi`, `kich_hoat`, `display_user`, `id_roles`) VALUES
(5, 'Nguyễn Huy Tới', 'abc', '123', 'nguyenhoang2510204@gmail.com', '099999991', '4b.jpg', 1, 'Hà Nội 36 Phố Phường', 1, 1, 2),
(8, 'Nguyễn Văn H', 'qwer', '123', 'qwe0@gmail.com', '088888883', '9070071.png', 1, 'Hà Nội', 1, 1, 1),
(9, 'Nguyễn Huy Tới', 'toinh', '123', 'toinh@gmail.com', '', 'no-avatar.jpg', 1, '', 1, 1, 1),
(10, 'Admin', 'admin', '123', 'toinhph33994@gmail.com', '0385521231', 'no-avatar.jpg', 1, NULL, 1, 1, 3),
(11, 'Nguyễn công trang', 'trangnc', '12345', 'trangncph44249@fpt.edu.vn', '', 'no-avatar.jpg', 1, '', 1, 1, 1),
(12, 'phamhieu', 'hieu', '1', 'hieu@gmail.com', '', 'no-avatar.jpg', 1, '', 1, 1, 1),
(13, 'Mai Anh ', 'kh01', '123', 'abc@gmail.com', '', 'no-avatar.jpg', 1, '', 1, 1, 1),
(14, 'Nguyễn Huy Tới', 'toinh204', '123', 'toidz25102004@gmail.com', '', 'no-avatar.jpg', 1, '', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`id_binh_luan`),
  ADD KEY `id_kh` (`id_kh`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id_chi_tiet_don_hang`),
  ADD KEY `chi_tiet_don_hang_ibfk_2` (`id_chi_tiet_san_pham`),
  ADD KEY `id_don_hang` (`id_don_hang`);

--
-- Indexes for table `chi_tiet_san_pham`
--
ALTER TABLE `chi_tiet_san_pham`
  ADD PRIMARY KEY (`id_chi_tiet_san_pham`),
  ADD KEY `id_mau` (`id_mau`),
  ADD KEY `id_size` (`id_size`),
  ADD KEY `chi_tiet_san_pham_ibfk_1` (`id_san_pham`);

--
-- Indexes for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`id_danh_gia`),
  ADD KEY `id_kh` (`id_kh`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Indexes for table `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id_danh_muc`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id_don_hang`),
  ADD KEY `id_kh` (`id_kh`),
  ADD KEY `id_trang_thai_don` (`id_trang_thai_don`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id_gio_hang`),
  ADD KEY `id_kh` (`id_kh`),
  ADD KEY `gio_hang_ibfk_2` (`id_chi_tiet_san_pham`);

--
-- Indexes for table `mau`
--
ALTER TABLE `mau`
  ADD PRIMARY KEY (`id_mau`);

--
-- Indexes for table `ma_giam_gia`
--
ALTER TABLE `ma_giam_gia`
  ADD PRIMARY KEY (`id_ma_giam_gia`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_chat` (`id_chat`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `id_don_hang` (`id_don_hang`);

--
-- Indexes for table `reply_comment`
--
ALTER TABLE `reply_comment`
  ADD PRIMARY KEY (`id_reply_comment`),
  ADD KEY `id_binh_luan` (`id_binh_luan`),
  ADD KEY `id_kh` (`id_kh`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_san_pham`),
  ADD KEY `id_danh_muc` (`id_danh_muc`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id_size`);

--
-- Indexes for table `trang_thai_don`
--
ALTER TABLE `trang_thai_don`
  ADD PRIMARY KEY (`id_trang_thai_don`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_kh`),
  ADD KEY `id_roles` (`id_roles`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `id_binh_luan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id_chi_tiet_don_hang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `chi_tiet_san_pham`
--
ALTER TABLE `chi_tiet_san_pham`
  MODIFY `id_chi_tiet_san_pham` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `id_danh_gia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `id_danh_muc` int NOT NULL AUTO_INCREMENT COMMENT 'Id danh mục', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id_gio_hang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `mau`
--
ALTER TABLE `mau`
  MODIFY `id_mau` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ma_giam_gia`
--
ALTER TABLE `ma_giam_gia`
  MODIFY `id_ma_giam_gia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int NOT NULL AUTO_INCREMENT COMMENT 'Id đoạn chat', AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT COMMENT 'Id thanh toán', AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `reply_comment`
--
ALTER TABLE `reply_comment`
  MODIFY `id_reply_comment` int NOT NULL AUTO_INCREMENT COMMENT 'Id phản hổi', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_san_pham` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id_size` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trang_thai_don`
--
ALTER TABLE `trang_thai_don`
  MODIFY `id_trang_thai_don` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_kh` int NOT NULL AUTO_INCREMENT COMMENT 'Id khách hàng', AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_ibfk_1` FOREIGN KEY (`id_kh`) REFERENCES `user` (`id_kh`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `binh_luan_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`id_chi_tiet_san_pham`) REFERENCES `chi_tiet_san_pham` (`id_chi_tiet_san_pham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_3` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id_don_hang`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `chi_tiet_san_pham`
--
ALTER TABLE `chi_tiet_san_pham`
  ADD CONSTRAINT `chi_tiet_san_pham_ibfk_1` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `chi_tiet_san_pham_ibfk_2` FOREIGN KEY (`id_mau`) REFERENCES `mau` (`id_mau`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `chi_tiet_san_pham_ibfk_3` FOREIGN KEY (`id_size`) REFERENCES `size` (`id_size`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `danh_gia_ibfk_1` FOREIGN KEY (`id_kh`) REFERENCES `user` (`id_kh`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `danh_gia_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`id_kh`) REFERENCES `user` (`id_kh`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `don_hang_ibfk_2` FOREIGN KEY (`id_trang_thai_don`) REFERENCES `trang_thai_don` (`id_trang_thai_don`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`id_kh`) REFERENCES `user` (`id_kh`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`id_chi_tiet_san_pham`) REFERENCES `chi_tiet_san_pham` (`id_chi_tiet_san_pham`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hang` (`id_don_hang`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reply_comment`
--
ALTER TABLE `reply_comment`
  ADD CONSTRAINT `reply_comment_ibfk_1` FOREIGN KEY (`id_binh_luan`) REFERENCES `binh_luan` (`id_binh_luan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reply_comment_ibfk_2` FOREIGN KEY (`id_kh`) REFERENCES `user` (`id_kh`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_muc` (`id_danh_muc`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
