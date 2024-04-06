-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th4 05, 2024 lúc 01:18 PM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `caycanh1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

DROP TABLE IF EXISTS `chitietgiohang`;
CREATE TABLE IF NOT EXISTS `chitietgiohang` (
  `giohang_id` int DEFAULT NULL,
  `sanpham_id` int DEFAULT NULL,
  `soluong` int DEFAULT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  KEY `giohang_id` (`giohang_id`),
  KEY `sanpham_id` (`sanpham_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietgiohang`
--

INSERT INTO `chitietgiohang` (`giohang_id`, `sanpham_id`, `soluong`, `gia`) VALUES
(1, 8, 1, '1231231.00'),
(2, 8, 1, '1231231.00'),
(3, 8, 3, '1231231.00'),
(4, 7, 1, '123123.00'),
(5, 6, 1, '12312.00'),
(6, 7, 1, '123123.00'),
(7, 8, 2, '1231231.00'),
(8, 8, 1, '1231231.00'),
(9, 8, 1, '1231231.00'),
(10, 8, 1, '1231231.00'),
(11, 7, 2, '123123.00'),
(12, 7, 2, '123123.00'),
(13, 7, 1, '123123.00'),
(13, 6, 1, '12312.00'),
(13, 5, 1, '750000.00'),
(14, 7, 1, '123123.00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

DROP TABLE IF EXISTS `giohang`;
CREATE TABLE IF NOT EXISTS `giohang` (
  `giohang_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `ngaydat` datetime DEFAULT NULL,
  `tong` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`giohang_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`giohang_id`, `user_id`, `ngaydat`, `tong`) VALUES
(1, 2, '2024-04-04 15:46:36', '1231231.00'),
(2, 2, '2024-04-04 15:49:25', '1231231.00'),
(3, 2, '2024-04-04 15:54:06', '3693693.00'),
(14, 2, '2024-04-05 09:37:44', '123123.00'),
(13, 2, '2024-04-05 09:36:05', '885435.00'),
(6, 4, '2024-04-04 16:28:07', '123123.00'),
(7, 4, '2024-04-04 16:33:31', '2462462.00'),
(8, 4, '2024-04-04 16:34:36', '1231231.00'),
(9, 4, '2024-04-04 16:38:06', '1231231.00'),
(10, 4, '2024-04-04 16:42:23', '1231231.00'),
(11, 2, '2024-04-05 07:09:56', '246246.00'),
(12, 6, '2024-04-05 09:09:53', '246246.00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

DROP TABLE IF EXISTS `loai`;
CREATE TABLE IF NOT EXISTS `loai` (
  `loai_id` int NOT NULL AUTO_INCREMENT,
  `tenloai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`loai_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`loai_id`, `tenloai`) VALUES
(1, 'Cây lọc không khí'),
(2, 'Cây phong thủy'),
(3, 'Cây cảnh để bàn'),
(4, 'Cây văn phòng'),
(5, 'Cây sân vườn'),
(6, 'Cây công trình');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `sanpham_id` int NOT NULL AUTO_INCREMENT,
  `tensanpham` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mieuta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gia` decimal(10,2) NOT NULL,
  `soluong` int NOT NULL,
  `cover_image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`sanpham_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`sanpham_id`, `tensanpham`, `mieuta`, `gia`, `soluong`, `cover_image_path`) VALUES
(5, 'Tráu Bà Lá Sẻ', 'Trầu bà lá sẻ đẹp dễ chăm tán lá to và khoẻ. Lá có màu xanh nhẹ.\r\nĐể văn phòng hay trang trí nhà cửa đều đẹp. Lọc không khí hút các khí độc hại xung quanh môi trường.\r\nChăm sóc dễ để trong phòng tuần tưới 1_2 lần.', '750000.00', 10, 'uploads/2022-10-06-07-00-43-738-300x300.jpg'),
(6, 'wewr123', '123123', '12312.00', 31231, 'uploads/60dc4e27505dd.jpg'),
(7, '123123123', '123123123', '123123.00', 12313, 'uploads/48.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham_loai`
--

DROP TABLE IF EXISTS `sanpham_loai`;
CREATE TABLE IF NOT EXISTS `sanpham_loai` (
  `id` int NOT NULL,
  `sanpham_id` int DEFAULT NULL,
  `loai_id` int DEFAULT NULL,
  KEY `sanpham_id` (`sanpham_id`),
  KEY `loai_id` (`loai_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham_loai`
--

INSERT INTO `sanpham_loai` (`id`, `sanpham_id`, `loai_id`) VALUES
(0, 5, 4),
(0, 6, 4),
(0, 7, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gmail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `diachi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `sdt` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `ten`, `pass`, `gmail`, `diachi`, `sdt`) VALUES
(1, NULL, '$2y$10$27O5SKpBzQfp7KtV80YSH.eY.caftEwE1sG75Uqluf8xv6X7WaFZu', 'hoangvtpro@gmail.com', NULL, NULL),
(2, 'admin', '$2y$10$QOW/mYfcczJeIdVpSrl5y.Pyfa/TNvf5tMgTVyDEIJwaIjBmPVlJa', 'admin@gmail.com', '123 dia trung hai ', '0384830870'),
(6, 'Mai Việt Hoàng', '', 'hoangvtpro.yahoo.com.tv@gmail.com', '123 dia trung hai ', '0384830870'),
(4, 'mai viet hoang', '$2y$10$FbXc/SLAOy1gI8KmLZ7UU.UWeuRSq.vk4SdZ24H4yQWMQLiBCN1em', 'hoangvtpro3@gmail.com', '123 dia trung hai ', '0384830870');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
