-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2025 at 03:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trucre_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `tax` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPhone` varchar(255) NOT NULL,
  `payment_method` enum('vnpay','momo','paypal') NOT NULL,
  `startAt` date NOT NULL,
  `endAt` date NOT NULL,
  `bookingType` enum('All day','Session') NOT NULL DEFAULT 'All day',
  `sessionType` enum('All day','Morning','Afternoon','Evening') NOT NULL DEFAULT 'All day',
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `tax`, `totalPrice`, `status`, `created_at`, `updated_at`, `userName`, `userEmail`, `userPhone`, `payment_method`, `startAt`, `endAt`, `bookingType`, `sessionType`, `currency`) VALUES
(467, 1, 16, 0, 300000, 'approved', '2024-12-28 10:35:17', '2024-12-28 10:35:17', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634', 'vnpay', '0000-00-00', '0000-00-00', 'All day', 'All day', 'VND'),
(468, 3, 16, 60000, 600000, 'approved', '2025-01-02 11:26:36', '2025-01-02 11:26:36', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634', 'vnpay', '0000-00-00', '0000-00-00', 'All day', 'All day', 'VND'),
(469, 1, 16, 12000, 120000, 'approved', '2025-01-03 04:47:37', '2025-01-03 04:47:37', 'Hiếu Nguyễn', 'luuquangtinh6597@gmail.com', '0385835634', 'vnpay', '0000-00-00', '0000-00-00', 'All day', 'All day', 'VND'),
(470, 17, 16, 48000, 480000, 'approved', '2025-01-03 18:51:31', '2025-01-03 18:51:31', 'Thành Tài', 'luuquangtinh6597@gmail.com', '0336335465', 'vnpay', '0000-00-00', '0000-00-00', 'All day', 'All day', 'VND'),
(472, 17, 16, 90000, 900000, 'approved', '2025-01-03 21:59:08', '2025-01-03 21:59:08', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634', 'vnpay', '0000-00-00', '0000-00-00', 'All day', 'All day', 'VND'),
(473, 17, 16, 60000, 600000, 'approved', '2025-01-03 22:06:52', '2025-01-03 22:06:52', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456', 'vnpay', '2025-01-01', '2025-01-03', 'All day', 'All day', 'VND'),
(474, 3, 16, 7604316, 76043160, 'approved', '2025-01-07 06:09:17', '2025-01-07 06:09:17', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789', 'vnpay', '2025-01-10', '2025-01-12', 'All day', 'All day', 'VND'),
(477, 3, 16, 837830, 8378304, 'approved', '2025-01-09 07:53:05', '2025-01-09 07:53:05', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0123456789', 'vnpay', '2025-02-04', '2025-02-04', 'Session', 'Evening', 'VND'),
(482, 14, 29, 837102, 8447121, 'approved', '2025-01-11 17:54:19', '2025-01-11 17:54:19', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634', 'vnpay', '2025-01-21', '2025-01-23', 'Session', 'Afternoon', 'VND'),
(483, 14, 29, 279034, 2815707, 'approved', '2025-01-11 17:57:16', '2025-01-11 17:57:16', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634', 'vnpay', '2025-01-12', '2025-01-12', 'Session', 'Evening', 'VND'),
(485, 14, 16, 1674204, 16742042, 'approved', '2025-01-11 18:04:35', '2025-01-11 18:04:35', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634', 'vnpay', '2025-02-01', '2025-02-02', 'Session', 'Morning', 'VND'),
(486, 14, 16, 5073346, 50733460, 'approved', '2025-01-11 18:35:26', '2025-01-11 18:35:26', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634', 'vnpay', '2025-01-24', '2025-01-25', 'All day', 'All day', 'VND'),
(491, 3, 16, 33, 330, 'approved', '2025-01-14 05:53:01', '2025-01-14 05:53:01', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1', 'paypal', '2025-01-14', '2025-01-14', 'Session', 'Evening', 'USD'),
(492, 3, 16, 33, 330, 'approved', '2025-01-14 05:53:57', '2025-01-14 05:53:57', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1', 'paypal', '2025-01-31', '2025-01-31', 'Session', 'Evening', 'USD'),
(493, 3, 16, 66, 660, 'approved', '2025-01-14 05:56:41', '2025-01-14 05:56:41', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1', 'paypal', '2025-01-28', '2025-01-29', 'Session', 'Morning', 'USD'),
(494, 14, 16, 33, 330, 'approved', '2025-01-14 05:59:09', '2025-01-14 05:59:09', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '2', 'paypal', '2025-02-26', '2025-02-26', 'Session', 'Afternoon', 'USD'),
(495, 14, 29, 761332, 7613322, 'approved', '2025-01-14 12:20:12', '2025-01-14 12:20:12', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789', 'vnpay', '2025-01-31', '2025-01-31', 'All day', 'All day', 'VND'),
(496, 14, 28, 15, 150, 'approved', '2025-01-14 12:25:29', '2025-01-14 12:25:29', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1234567890', 'paypal', '2025-01-14', '2025-01-14', 'All day', 'All day', 'USD'),
(497, 14, 16, 5076952, 50769520, 'approved', '2025-01-16 03:11:59', '2025-01-16 03:11:59', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1234567890', 'vnpay', '2025-01-21', '2025-01-22', 'All day', 'All day', 'VND'),
(498, 1, 27, 105, 1050, 'approved', '2025-01-16 03:28:13', '2025-01-16 03:28:13', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789', 'paypal', '2025-01-16', '2025-01-18', 'All day', 'All day', 'USD'),
(499, 14, 16, 300, 3000, 'approved', '2025-01-16 03:29:23', '2025-01-16 03:29:23', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1234567890', 'paypal', '2025-02-05', '2025-02-07', 'All day', 'All day', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `map` varchar(255) NOT NULL,
  `status` enum('waiting','active','inactive') NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `user_id`, `name`, `description`, `address`, `country`, `map`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'VTC ACADEMY', 'Trung tâm giảng dạy CNTT và TKĐH lớn nhất tại Đà Nẵng', '130 Điện Biên Phủ, Chính Gián, Thanh Khê, TP. Đà Nẵng', 'Việt Nam', 'This is map', 'active', NULL, NULL),
(49, 17, 'VNG Building', 'Công Ty Cổ Phần Ứng Dụng VNG', '15 Hùng Vương, Hải Châu 1, Hải Châu, Đà Nẵng 550000', 'Việt Nam', 'This is map', 'active', '2024-12-18 13:14:54', '2024-12-21 08:05:01'),
(50, 17, 'FPT Building', 'Phổ thông Cao đẳng FPT Polytechnic Đà Nẵng', '137 Đường Nguyễn Thị Thập, Thanh Khê Tây, Liên Chiểu, Đà Nẵng', 'Việt Nam', 'https://maps.app.goo.gl/J2reUGegvSKBkWBaA', 'active', '2024-12-18 13:16:30', '2024-12-21 08:06:38'),
(52, 10, 'HAI AU BUILDING', 'Toà nhà Hải Âu', '39B Đ. Trường Sơn, Phường 2, Tân Bình, Hồ Chí Minh', 'Việt Nam', 'https://maps.app.goo.gl/XFQEoWf93wSAEABaA', 'active', '2025-01-11 07:39:41', '2025-01-11 07:39:41'),
(53, 6, 'An Phú Plaza', 'An Phu Plaza is a complex building consisting of an office for lease and apartment. Contact Maison Office to get the exact rental area and prices of this building.', '117 - 119 Ly Chinh Thang, Ward 7, Dist 3, Ho Chi Minh city', 'Việt Nam', 'https://maps.app.goo.gl/HbanzDX3qoFFGHRR7', 'active', '2025-01-11 08:18:19', '2025-01-11 08:18:19'),
(54, 7, 'Cachet Group Building', 'Cachet Group', '65 Kent Street Sydney, NSW 2000', 'Australia', 'https://maps.app.goo.gl/VytbToJ8T1McDvhJ8', 'active', '2025-01-11 08:36:56', '2025-01-11 08:36:56'),
(55, 9, 'Pullman Danang Beach Resort', 'Pullman Danang Beach Resort', '101 Vo Nguyen Giap Street, Khue My Ward, Ngu Hanh Son District, 550000 Danang', 'Việt Nam', 'https://maps.app.goo.gl/GTYJ6TgnXNnWxRFm8', 'active', '2025-01-14 18:20:49', '2025-01-15 08:43:19'),
(56, 9, 'Sonadezi Long Bình', 'Sonadezi Long Bình', '1 Đ. 3A, KCN Biên, Biên Hòa, Đồng Nai', 'Việt Nam', 'https://maps.app.goo.gl/yp4FH51AZxAc7yYF8', 'active', '2025-01-15 05:40:15', '2025-01-15 08:36:40'),
(57, 17, 'Connexion Conferrence & Event Centre (Grand Nexus Ballroom)', 'Connexion Conferrence & Event Centre (Grand Nexus Ballroom)', 'No 8, Jalan Kerinchi, Bangsar South, 59200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia', 'Malaysia', 'https://maps.app.goo.gl/viiH8SbXUzKHGneu8', 'active', '2025-01-15 19:19:41', '2025-01-15 19:20:06'),
(58, 17, 'MATRADE Exhibition | Convention Centre - Hall ABC Lobby', 'MATRADE Exhibition and Convention Centre is a trade centre, exhibition hall, and convention centre in the suburb of Segambut, Kuala Lumpur, Malaysia. MECC, established by MATRADE, provides convention facilities, exhibition halls, and meeting rooms.', 'Menara Matrade, Jalan Sultan Haji Ahmad Shah, Segambut, 50480 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia', 'Malaysia', 'https://maps.app.goo.gl/FBTPdGr1FMEp6Sqg6', 'active', '2025-01-15 19:38:03', '2025-01-15 19:39:00'),
(59, 9, 'myOfficeLife', 'myOfficeLife', '2806 Speer Blvd, Denver, CO 80211, United States', 'United States', 'https://maps.app.goo.gl/o4Wf8xnyTrYNBccC8', 'active', '2025-01-15 20:07:31', '2025-01-15 20:07:31'),
(60, 6, 'Edina OffiCenter', 'Edina OffiCenter', '5200 Willson Rd Ste 150, Edina, MN 55424, United States', 'United States', 'https://maps.app.goo.gl/5zmVXeYuqC6wPT6u5', 'active', '2025-01-15 20:38:15', '2025-01-15 20:38:15'),
(61, 6, 'Studio #337', 'Zilker, Austin, TX', '400 Grand Blvd, Kansas City, MO 64106, United States', 'United States', 'https://maps.app.goo.gl/caDP3UmLKtaptizx9', 'active', '2025-01-15 21:06:13', '2025-01-15 21:06:13'),
(62, 9, 'Fraser Place Central Seoul', 'Fraser Place Central Seoul', '78 Tongil-ro, Jung District, Seoul, South Korea', 'South Korea', 'https://maps.app.goo.gl/dYFWLrAcqUUH5YKG7', 'active', '2025-01-15 21:19:29', '2025-01-15 21:19:29'),
(63, 7, 'Paper Shanghai', 'Paper Shanghai', 'https://maps.app.goo.gl/y8QqN6e4xbHnY9KF9', 'China', 'https://maps.app.goo.gl/y8QqN6e4xbHnY9KF9', 'active', '2025-01-15 21:32:19', '2025-01-15 21:32:19'),
(64, 10, 'O2Work - Collyer Quay Center', 'O2Work - Collyer Quay Center', 'Income@Raffles, Level 12 16 Collyer Quay, Singapore 049318', 'Singapore', 'https://maps.app.goo.gl/jbx5C1Uqg3VCradT9', 'active', '2025-01-16 00:20:20', '2025-01-16 00:20:20'),
(65, 7, 'Linuxx Serviced Offices', 'Linuxx Serviced Offices', '29 Chit Lom Rd, Lumphini, Pathum Wan, Vanissa Building, #25, 10330, Bangkok', 'Thailand', 'https://maps.app.goo.gl/PHrZKjRMC8iptzRC9', 'active', '2025-01-16 03:17:55', '2025-01-16 03:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('exchange_rate_USD_USD', 'i:1;', 1737168654);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `building_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 55, 'certificates/1736878849-55-0.png', NULL, NULL),
(2, 56, 'certificates/1736919615-56-0.png', NULL, NULL),
(3, 57, 'certificates/1736968781-57-0.png', NULL, NULL),
(4, 58, 'certificates/1736969883-58-0.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `room_id`, `url`, `created_at`, `updated_at`) VALUES
(11, 16, 'images/1734770677-16-0.webp', NULL, NULL),
(12, 16, 'images/1734770677-16-1.webp', NULL, NULL),
(13, 16, 'images/1734770677-16-2.webp', NULL, NULL),
(15, 26, 'images/1736579472-26-0.jpg', NULL, NULL),
(16, 26, 'images/1736579472-26-1.jpg', NULL, NULL),
(17, 26, 'images/1736579472-26-2.jpg', NULL, NULL),
(18, 27, 'images/1736581633-27-0.jpg', NULL, NULL),
(19, 27, 'images/1736581633-27-1.jpg', NULL, NULL),
(20, 27, 'images/1736581633-27-2.jpg', NULL, NULL),
(21, 27, 'images/1736581633-27-3.jpg', NULL, NULL),
(22, 28, 'images/1736583884-28-0.jpg', NULL, NULL),
(23, 28, 'images/1736583884-28-1.jpg', NULL, NULL),
(24, 28, 'images/1736583884-28-2.jpg', NULL, NULL),
(25, 29, 'images/1736585314-29-0.jpg', NULL, NULL),
(26, 29, 'images/1736585314-29-1.jpg', NULL, NULL),
(27, 29, 'images/1736585314-29-2.jpg', NULL, NULL),
(28, 29, 'images/1736585314-29-3.jpg', NULL, NULL),
(29, 29, 'images/1736585314-29-4.jpg', NULL, NULL),
(30, 29, 'images/1736585314-29-5.jpg', NULL, NULL),
(31, 30, 'images/1736881251-30-0.jpg', NULL, NULL),
(32, 30, 'images/1736881251-30-1.jpg', NULL, NULL),
(33, 30, 'images/1736881251-30-2.jpg', NULL, NULL),
(34, 30, 'images/1736881251-30-3.jpg', NULL, NULL),
(35, 31, 'images/1736929420-31-0.jpg', NULL, NULL),
(36, 31, 'images/1736929420-31-1.jpg', NULL, NULL),
(37, 31, 'images/1736929420-31-2.jpg', NULL, NULL),
(38, 31, 'images/1736929420-31-3.jpg', NULL, NULL),
(39, 31, 'images/1736929420-31-4.jpg', NULL, NULL),
(40, 31, 'images/1736929420-31-5.jpg', NULL, NULL),
(41, 31, 'images/1736929420-31-6.jpg', NULL, NULL),
(42, 31, 'images/1736929420-31-7.jpg', NULL, NULL),
(43, 32, 'images/1736969507-32-0.jpg', NULL, NULL),
(44, 32, 'images/1736969507-32-1.jpg', NULL, NULL),
(45, 32, 'images/1736969507-32-2.jpg', NULL, NULL),
(46, 32, 'images/1736969507-32-3.jpg', NULL, NULL),
(47, 33, 'images/1736970312-33-0.jpg', NULL, NULL),
(48, 33, 'images/1736970312-33-1.jpg', NULL, NULL),
(49, 33, 'images/1736970312-33-2.jpg', NULL, NULL),
(50, 33, 'images/1736970312-33-3.jpg', NULL, NULL),
(51, 33, 'images/1736970312-33-4.jpg', NULL, NULL),
(52, 33, 'images/1736970312-33-5.jpg', NULL, NULL),
(53, 34, 'images/1736972216-34-0.webp', NULL, NULL),
(54, 34, 'images/1736972216-34-1.webp', NULL, NULL),
(55, 34, 'images/1736972216-34-2.webp', NULL, NULL),
(56, 34, 'images/1736972216-34-3.webp', NULL, NULL),
(57, 34, 'images/1736972216-34-4.webp', NULL, NULL),
(58, 34, 'images/1736972216-34-5.webp', NULL, NULL),
(59, 35, 'images/1736973755-35-0.webp', NULL, NULL),
(60, 35, 'images/1736973755-35-1.webp', NULL, NULL),
(61, 35, 'images/1736973755-35-2.webp', NULL, NULL),
(62, 35, 'images/1736973755-35-3.webp', NULL, NULL),
(63, 35, 'images/1736973755-35-4.webp', NULL, NULL),
(64, 35, 'images/1736973755-35-5.webp', NULL, NULL),
(65, 35, 'images/1736973755-35-6.webp', NULL, NULL),
(66, 36, 'images/1736975444-36-0.webp', NULL, NULL),
(67, 36, 'images/1736975444-36-1.webp', NULL, NULL),
(68, 36, 'images/1736975444-36-2.webp', NULL, NULL),
(69, 36, 'images/1736975444-36-3.webp', NULL, NULL),
(70, 36, 'images/1736975444-36-4.webp', NULL, NULL),
(71, 36, 'images/1736975444-36-5.webp', NULL, NULL),
(72, 36, 'images/1736975444-36-6.webp', NULL, NULL),
(73, 36, 'images/1736975444-36-7.webp', NULL, NULL),
(74, 36, 'images/1736975444-36-8.webp', NULL, NULL),
(75, 36, 'images/1736975444-36-9.webp', NULL, NULL),
(76, 36, 'images/1736975444-36-10.webp', NULL, NULL),
(77, 37, 'images/1736975663-37-0.webp', NULL, NULL),
(78, 37, 'images/1736975663-37-1.webp', NULL, NULL),
(79, 37, 'images/1736975663-37-2.webp', NULL, NULL),
(80, 37, 'images/1736975663-37-3.webp', NULL, NULL),
(81, 37, 'images/1736975663-37-4.webp', NULL, NULL),
(82, 37, 'images/1736975663-37-5.webp', NULL, NULL),
(83, 37, 'images/1736975663-37-6.webp', NULL, NULL),
(84, 38, 'images/1736976241-38-0.jpg', NULL, NULL),
(85, 38, 'images/1736976241-38-1.jpg', NULL, NULL),
(86, 38, 'images/1736976241-38-2.jpg', NULL, NULL),
(87, 38, 'images/1736976241-38-3.jpg', NULL, NULL),
(88, 38, 'images/1736976241-38-4.jpg', NULL, NULL),
(89, 39, 'images/1736976425-39-0.jpg', NULL, NULL),
(90, 39, 'images/1736976425-39-1.jpg', NULL, NULL),
(91, 39, 'images/1736976425-39-2.jpg', NULL, NULL),
(92, 39, 'images/1736976425-39-3.jpg', NULL, NULL),
(93, 39, 'images/1736976425-39-4.jpg', NULL, NULL),
(94, 39, 'images/1736976425-39-5.jpg', NULL, NULL),
(95, 39, 'images/1736976425-39-6.jpg', NULL, NULL),
(96, 39, 'images/1736976425-39-7.jpg', NULL, NULL),
(97, 39, 'images/1736976425-39-8.jpg', NULL, NULL),
(98, 40, 'images/1736976591-40-0.jpg', NULL, NULL),
(99, 40, 'images/1736976591-40-1.jpg', NULL, NULL),
(100, 40, 'images/1736976591-40-2.jpg', NULL, NULL),
(101, 40, 'images/1736976591-40-3.jpg', NULL, NULL),
(102, 40, 'images/1736976591-40-4.jpg', NULL, NULL),
(103, 41, 'images/1736982620-41-0.jpg', NULL, NULL),
(104, 41, 'images/1736982620-41-1.jpg', NULL, NULL),
(105, 41, 'images/1736982620-41-2.jpg', NULL, NULL),
(106, 41, 'images/1736982620-41-3.jpg', NULL, NULL),
(107, 42, 'images/1736986033-42-0.jpg', NULL, NULL),
(108, 42, 'images/1736986033-42-1.jpg', NULL, NULL),
(109, 42, 'images/1736986033-42-2.jpg', NULL, NULL),
(110, 42, 'images/1736986033-42-3.png', NULL, NULL),
(111, 43, 'images/1736986146-43-0.jpg', NULL, NULL),
(112, 43, 'images/1736986146-43-1.jpg', NULL, NULL),
(113, 43, 'images/1736986146-43-2.jpg', NULL, NULL),
(114, 43, 'images/1736986146-43-3.jpg', NULL, NULL),
(115, 43, 'images/1736986146-43-4.png', NULL, NULL),
(116, 44, 'images/1736986453-44-0.jpg', NULL, NULL),
(117, 44, 'images/1736986453-44-1.jpg', NULL, NULL),
(118, 45, 'images/1736986617-45-0.webp', NULL, NULL),
(119, 45, 'images/1736986617-45-1.webp', NULL, NULL),
(120, 45, 'images/1736986617-45-2.webp', NULL, NULL),
(121, 45, 'images/1736986617-45-3.webp', NULL, NULL),
(122, 46, 'images/1736987178-46-0.jpg', NULL, NULL),
(123, 47, 'images/1736987732-47-0.png', NULL, NULL),
(124, 47, 'images/1736987732-47-1.png', NULL, NULL),
(125, 47, 'images/1736987732-47-2.png', NULL, NULL),
(126, 48, 'images/1736997941-48-0.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2024_11_28_153544_create_rooms_table', 1),
(4, '2024_11_28_171643_create_bookings_table', 1),
(7, '2024_12_12_033503_drop_table_types_and_categories', 2),
(8, '2024_12_27_164717_create_transactions_table', 3),
(9, '2024_12_28_155311_add_booking_info_to_transactions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$WzHXl7Pvn0DSjXWEIxi64ujhtOgV6i2xubatoa9NlxhnX.GNBzq5y', '2024-12-14 10:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `building_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('waiting','active','inactive') NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `comparePrice` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `maxChair` int(11) NOT NULL,
  `maxTable` int(11) NOT NULL,
  `maxPeople` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `startAt` timestamp NOT NULL DEFAULT '2024-11-29 08:38:41',
  `endAt` timestamp NOT NULL DEFAULT '2024-11-29 08:38:41',
  `status` enum('waiting','active','inactive') NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `furniture` varchar(255) DEFAULT NULL,
  `allDayPrice` int(11) NOT NULL DEFAULT 0,
  `sessionPrice` int(11) NOT NULL DEFAULT 0,
  `type` enum('Meeting room','Conference room') NOT NULL DEFAULT 'Meeting room'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `building_id`, `name`, `price`, `comparePrice`, `description`, `maxChair`, `maxTable`, `maxPeople`, `tags`, `startAt`, `endAt`, `status`, `created_at`, `updated_at`, `furniture`, `allDayPrice`, `sessionPrice`, `type`) VALUES
(16, 50, 'Meeting room - FPT Arena', 1000, 1200, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 10, 3, 10, 'Meeting room', '2024-12-11 17:00:00', '2026-12-11 17:00:00', 'active', '2024-12-21 08:44:37', '2024-12-21 08:44:37', 'projection screen, water, air conditioner', 1000, 330, 'Meeting room'),
(26, 1, 'VTC ACADEMY EVENT HALL', 200, 250, 'Covering approximately 300 sqm with a capacity of up to 500 guests, the venue is suitable for hosting meetings between businesses and their customers, student workshops and gatherings in which enterprises can get together to share their industry knowledge and market information.\r\n\r\nSpecifically, with an open, modern, youthful and full of technology spirit space designed in compliance with the architectural standards of many technology academies in the world, VTC Academy event hall is a good place for technology and digital content-related events including technological product launches, new technology introductions, game promotions, mobile applications, websites, etc.', 600, 300, 600, 'Conference room, VTC ACADEMY', '2025-01-10 17:00:00', '2026-01-10 17:00:00', 'active', '2025-01-11 07:11:12', '2025-01-15 23:19:54', 'Television, basic facilities', 200, 80, 'Conference room'),
(27, 52, 'Luxury meeting room at Tan Binh district, HCM city', 350, 450, 'If your company is seeking a high-quality office for rent in Tan Binh District within a reasonable budget, Hai Au Building is an option you shouldn\'t miss. Located in one of the fastest-growing and most dynamic areas in Ho Chi Minh City, this building is home to numerous reputable domestic and international companies with diverse business activities. As a result, setting up an office here provides ample opportunities for dynamic and flexible growth.\r\n\r\nFurthermore, the building features a comprehensive infrastructure system designed to meet all of the clients\' working needs. With its international-standard professional workspace at a highly reasonable rental price, Hai Au Building confidently meets all business criteria and is a very attractive option for consideration.', 20, 6, 20, 'Meeting room, luxury meeting room, HCM City, Viet Nam', '2025-01-10 17:00:00', '2026-01-10 17:00:00', 'active', '2025-01-11 07:47:13', '2025-01-11 07:47:13', 'Television, Car parking, Motorcycle Parking, Cooling, Restrooms', 350, 105, 'Meeting room'),
(28, 53, 'Meeting room at eSmart An Phu Plaza HCM', 150, 222, '–  There are 10 floors designated for office (from 2nd to 11th)\n\n–  On each floor, a free-column office space of 815 – 838 sqm giving the advantage of natural light together with international grade B standard of service will offer a comfortable, dynamic, and creative working environment for your business.', 20, 20, 20, 'Meeting room, Việt Nam, HCM city', '2025-01-10 17:00:00', '2026-01-10 17:00:00', 'active', '2025-01-11 08:24:44', '2025-01-11 08:24:44', 'AC System, Elevators, Car parking, Motorbike parking, AC electricity,', 150, 60, 'Meeting room'),
(29, 54, 'Modern meeting room at Akcelo Offices', 300, 450, 'To keep up with their recent growth, Akcelo aimed to create their first dedicated Sydney workplace to give employees a sense of wellbeing, collaboration, and culture. Cachet Group was tasked with designing the Akcelo offices to match the business values and culture in Sydney, Australia.\n\nAkcelo, an award-winning advertising agency, were making a mark, delivering exceptional work for companies like Netflix, McDonald’s, TikTok and Tinder. Within just two years of launching, Akcelo quickly grew to a team of over 130 staff.\n\nSoon enough, the agency was ready to vacate their co-working environments and engaged Cachet Group to design and construct their first dedicated Sydney workplace – a space designed to further ignite the high performance, collaborative culture Akcelo’s worked so hard to build.', 30, 25, 30, 'Meeting room, Australia', '2025-01-10 17:00:00', '2026-01-10 17:00:00', 'active', '2025-01-11 08:48:34', '2025-01-11 08:48:34', 'AC System, Elevators, Car parking, Motorbike parking, AC electricity, Television', 300, 111, 'Meeting room'),
(30, 55, 'Pullman Magnolia room', 450, 500, 'Come to Pullman Danang Beach Resort and pick your perfect meeting room in Danang. Five sophisticated indoor function rooms for a 5-star resort. High tech and versatile, all designed with streamlined performance in mind. Elegant design and furnishings provide a serene backdrop for business or socializing. Because Pullman makes your event its top priority.\r\nPullman Danang Beach Resort provides a wide selection of outdoor & indoor venues combined with high-tech & elegant furnishing concepts.\r\n\r\nThe brand’s Meet/Play concept ensures you have an expert team of one-stop contacts on call at all times. The dedicated IT Solutions Manager takes care of the technical side of things. Talented chefs see to the catering. Pullman’s Event Manager takes care of everything so your occasion runs seamlessly.\r\n\r\nOrchid, Hibiscus, Jasmine, and Magnolia, the fragrant flowers of Vietnam lend their names to the meeting rooms. The smallest measures 48 sq m (516 sq ft) and can accommodate up to 48 people. The grand Lotus Ballroom hosts up to 650 privileged guests in its impressive 720 sq m (7,750 sq ft) stylish space. It can also be divided into three separate meeting rooms for even more versatility.', 120, 60, 120, 'Conference room, Việt Nam, Đà Nẵng, Pullman', '2025-01-14 17:00:00', '2025-01-16 17:00:00', 'active', '2025-01-14 19:00:51', '2025-01-14 19:00:51', 'Free water, monitor, television', 450, 120, 'Conference room'),
(31, 56, 'Hall - Conference room for rent', 200, 280, 'With modern design and accessible location, nearby the economic quadrangle area Dong Nai- Binh Duong – Vung Tau – Tp. HCM, Sonadezi Service Center Building provides convenience workplace, a suitable place for meeting, speech and training space ….\r\n\r\nSonadezi Service Center Building serves the hall and conference space for lease with capacity up to 156 guest, fully equipped and flexible in rental time will be an indispensable choice to meet your needs of customer. Besides, teabreak service, tea, and coffee is always ready for serving.', 100, 100, 100, 'Conference room, Việt Nam', '2025-01-14 17:00:00', '2025-01-16 17:00:00', 'active', '2025-01-15 08:23:40', '2025-01-15 08:23:40', 'Projector – screen, LED screen, Flipchart, white board + marker, Sound and Lighting system, air-conditioner, wifi\r\nPodium, Tranning Information on standee at lobby', 200, 80, 'Conference room'),
(32, 57, 'Nexus Ballroom', 175, 230, 'Splendid Venues for Spectacular Events. All about versatile and accommodative spaces, we have an outstanding range of rooms with various capacities to fit your needs. Whether a private meeting for twenty or a grand event for eight hundred or more, we’ve got just the space for you here at Connexion Conference & Event Centre (CCEC).\r\n\r\nNexus Ballroom is a fully equiped versatile event space which can be divided into three pillarless ballrooms; Nexus 1, 2 and 3. These three ballrooms can be combined into the pillarless Grand Ballroom of up to 2,600 seating capacity for large scale events including banquets and weddings.', 600, 600, 600, 'Conference room, Malaysia', '2025-01-14 17:00:00', '2025-01-19 17:00:00', 'active', '2025-01-15 19:31:47', '2025-01-15 19:31:47', 'Car Park, Stairs, Elevator, Wi-Fi, Ice Cream Live Station, Photo Booth, Event Crew', 175, 68, 'Conference room'),
(33, 58, 'Matrade Hall, MEEC', 300, 450, 'MATRADE\'S mission to promote Malaysia\'s export has enabled many local companies to carve new frontiers in global markets. Today as we continue to put the spotlight on capable Malaysian companies on the international stage, we are helping make the phrase \'Made-in-Malaysia\' synonymous with excellence, reliability and trustworthiness.\r\n\r\nThe Matrade Hall, located at MATRADE Exhibition and Convention Centre is a sophisticated and elegant event space. This venue is able to fit up to 2,000 guests, makes it an ideal choice for hosting large corporate and private events such as exhibitions, bazaars, talks, team buildings conferences, company annual dinners and weddings.', 2000, 2000, 2000, 'Conference room, Malaysia', '2025-01-15 17:00:00', '2025-01-24 17:00:00', 'active', '2025-01-15 19:45:12', '2025-01-15 19:45:12', 'Live Band, Printing, Car Park, Bathrooms, Basic lighting, Food Truck', 300, 120, 'Conference room'),
(34, 59, 'Meeting room at myOfficeLife', 100, 160, 'Fully Equipped 10-person conference room for your next meeting, presentation, or remote work. \r\n\r\nAre you launching a start-up? Ready to take your business to the next level and pitch your clients in a modern professional space? Or Just need to separate your home and your work-life?! Whatever your need or your reason we have the innovative, modern, industrially chic office space for you to showcase your ambition, do what you love and to look good while doing it! Awesome Highland/ Lo-HI Location and minutes from local and trendy restaurants and shops Gather with friends after work or take-a soul quenching Yoga class, all just minutes from your new office. We offer something for everyone from Workshare spaces, to dedicated desks and Private offices, you will also have access to 2 fully equipped kitchens, 3 conference rooms and reserved uncovered and covered parking options. “It’s time to get back to work!”', 20, 20, 20, 'Meeting room, United States', '2025-01-15 17:00:00', '2025-01-17 17:00:00', 'active', '2025-01-15 20:16:56', '2025-01-15 20:16:56', 'WiFi, Screen, Printer, Coffee, Restrooms,', 100, 33, 'Meeting room'),
(35, 60, 'Luxury meeting room at Edina OffiCenter, United States', 300, 345, 'This listing is for private access to our beautiful 6 person conference room conveniently located just south of Minneapolis in Edina, MN. There will be a staff member present during your stay and you\'ll have shared access to the rest of the facility amenities such as the lounge, restrooms and kitchenette area.', 6, 6, 6, 'Meeting room, United States', '2025-01-15 17:00:00', '2025-01-19 17:00:00', 'active', '2025-01-15 20:42:35', '2025-01-15 20:42:35', 'WiFi, TV, Whiteboard, VOIP Phone, Free Parking, Free Airport Shuttle Service, Coffee, Water, Tea, Lounge Area, Refrigerator, Office Manager', 300, 100, 'Meeting room'),
(36, 61, 'Studio #337', 320, 400, '- History of our Space -\r\nBuilt in 1910, the Livestock Exchange Building was seen as a fortress of commerce for Kansas City and the western territory. With 475 offices, the building housed the Stockyards Company, telegraph offices, banks, restaurants, railroad and packing house representatives, and government agencies. It was the largest livestock exchange building in the world and one of the largest office buildings in Kansas City. \r\n\r\n- Neighborhood Details -\r\nSurrounded by an eclectic mix of businesses, the West Bottoms are home to many artists, architecture studios, and antique dealers. If your looking for a fun bar and unique bar experience after a long day of shooting or workshops, The Campground is right across the street. Next door to that is a favorite of ours, Lucky Boys, and the beautiful KC restaurant Voltaire. \r\n\r\n- Logistics + Space Set up -\r\nWe have a very versatile studio space set up that is easily rearranged to encourage creative freedom. Feel free to move our furniture / tables to get the exact feel you want for your photo/video shoot/ workshop. We have a TV, small refrigerator, conference table with a monitor, and bluetooth speaker that you can use. Please help yourself to drinks and snacks!\r\n\r\n- Special Rates Associated with Booking the Space -\r\nWe have additional rates for shoots over 7 people, weekends, and late hours. \r\n\r\n- Information about Past Bookings -\r\nWe have had a great deal of success with previous people and businesses who have booked our space! Don\'t take it from us though, check out our reviews!', 30, 30, 30, 'Meeting room. United States', '2025-01-15 17:00:00', '2025-01-19 17:00:00', 'active', '2025-01-15 21:10:44', '2025-01-15 21:10:44', 'WiFi, Tables, Chair, Screen, White-board, Monitor, Printer, Apple TV, Coffee', 320, 111, 'Meeting room'),
(37, 61, 'Studio #338', 290, 340, 'Our large meeting room / boardroom seats up to 16 people very comfortably and is stylized with formal furnishings and excellent acoustics for presentations.\r\n\r\nIncluded in the room:\r\n\r\n~ High speed Google Fiber\r\n~ 70\" LED HD Display with HDMI & Display Port inputs\r\n~ Quartet infinity glass \"white\" boards\r\n~ Coffee & water setup\r\n\r\n**Please inquire about weekend pricing', 25, 25, 25, 'Meeting room, United States', '2025-01-15 17:00:00', '2025-05-15 17:00:00', 'active', '2025-01-15 21:14:23', '2025-01-15 21:14:23', 'WiFi, Tables, Chairs, Whiteboard, Conference Phone, Printer, Coffee, Projector, Restrooms, Wheelchair Accessible, iconKitchen, Outdoor Area', 290, 100, 'Meeting room'),
(38, 62, 'Luxury meeting room Fraser Place Central Seoul', 300, 370, '5 meeting rooms are available on rent at Fraser Place Central Seoul. The meeting facilities can accommodate between 10 to 100 delegates. You can see room specific details by clicking \"show details\" link on the meeting rooms.\r\n\r\nThis venue is ideal for all kinds of corporate events - from meetings, to trainings, to seminars. WiFi is available at the venue, availability of other services depends on the selected room, please consult the room descriptions for details.\r\n\r\nThe venue is conveniently located in central Seoul and well served by public transport. Located near a railway station, this venue is easily accessible by train. When organising an event for international guests, this venue is the perfect choice. Located close to the airport, your guests will be able to count on a smooth and stress free arrival. Those who\'re staying the night can get hotel rooms at the venue as well.\r\n\r\nProximity to motorway and availability of parking makes it easy to reach the venue by car.', 40, 40, 40, 'Meeting room, South Korea', '2025-01-15 17:00:00', '2025-02-15 17:00:00', 'active', '2025-01-15 21:24:01', '2025-01-15 21:24:01', 'Laundry Services, Business Centre, Accessible Facilities, Heating / Air Conditioning, Helicopter platform/ Helipad, Garden, Free Wi-Fi', 300, 100, 'Meeting room'),
(39, 62, 'Four Points by Sheraton Seoul Station', 400, 550, 'Four Points by Sheraton Seoul Station features 4 different meeting rooms available for rent. The rooms can accommodate from 6 to 60 participants.\r\n\r\nThis venue is suitable for most types of events from company meetings to training and seminar events. WiFi available at the venue. Please see the room descriptions for additional facilities.\r\n\r\nLocated conveniently in central Seoul with easy access to public transportation. Take advantage of the close located train station when traveling to the venue. It\'s convenient location near the airport makes it easy for international participants to reach. Those looking to stay the night can find hotel rooms at the venue.\r\n\r\nClose to the motorway and with ample parking, the venue is easy to reach by car.', 60, 60, 60, 'Meeting room, South Korea', '2025-06-14 17:00:00', '2026-01-14 17:00:00', 'active', '2025-01-15 21:27:05', '2025-01-15 21:27:05', 'Laundry Services, Business Centre, Accessible Facilities, Heating / Air Conditioning, Helicopter platform/ Helipad, Garden, Free Wi-Fi', 400, 133, 'Meeting room'),
(40, 62, 'Aloft Seoul Gangnam', 300, 310, '3 meeting rooms are available on rent at Aloft Seoul Gangnam. The meeting facilities can accommodate between 6 to 20 delegates. You can see room specific details by clicking \"show details\" link on the meeting rooms.\n\nGiven its moderately sized meeting rooms, this venue caters mainly to small meetings and events. WiFi available at the venue. Please see the room descriptions for additional facilities.\n\nConveniently located in central Seoul, the venue can be easily accessed by public transport. Visitors can quickly reach the venue by train from the nearby railway station. It\'s convenient location near the airport makes it easy for international participants to reach. Vistors who need to stay overnight can get a hotel room at the venue.\n\nSituated close to the motorway, this venue is easily accessible by car and also offers parking facilities.', 20, 20, 20, 'Meeting room, South Korea', '2025-02-14 17:00:00', '2025-04-15 17:00:00', 'active', '2025-01-15 21:29:51', '2025-01-15 21:29:51', 'Laundry Services, Business Centre, Accessible Facilities, Heating / Air Conditioning, Helicopter platform/ Helipad, Garden, Free Wi-Fi', 300, 111, 'Meeting room'),
(41, 63, 'Paper Shanghai', 400, 432, 'Paper is the new communal workspace, social club and private oasis for the modern thinker. For the dreamer who seeks structure, the creative who needs tools, and the influencer who wants company, welcome to your new work oasis.', 25, 25, 25, 'Meeting room, China', '2025-02-14 17:00:00', '2025-02-14 17:00:00', 'active', '2025-01-15 21:34:20', '2025-01-15 23:10:02', 'Tea & coffee only, Tea & coffee with biscuits/cookies, Hot buffet, LCD Projector, Projection Screen, Flipchart', 400, 130, 'Meeting room'),
(42, 63, 'Executive Centre - The Center, Shanghai', 400, 500, 'The Executive Centre at The Center offers a cutting-edge design flooded with natural light, unbeatable views with floor-to-ceiling windows and an office environment to be envied.', 20, 20, 20, 'Meeting room, China', '2025-02-19 17:00:00', '2025-02-19 17:00:00', 'active', '2025-01-16 00:07:13', '2025-01-16 00:07:13', 'Tea & coffee only, Tea & coffee with biscuits/cookies, Hot buffet, LCD Projector, Projection Screen, Flipchart', 400, 130, 'Meeting room'),
(43, 63, 'Park Hyatt Shanghai', 500, 600, 'Occupying floors 79 to 93 of the Shanghai World Financial Center (SWFC), otherwise known as The Vertical Complex City, makes it one of the highest hotels in the world. Soaring above this metropolis, guests can take in sweeping views of the city skyline and Huangpu River from any of its 174 luxury rooms & suites or enjoy a choice of some of the most well-known Shanghai restaurants.', 400, 400, 400, 'Meeting room, China', '2025-02-19 17:00:00', '2025-02-19 17:00:00', 'active', '2025-01-16 00:09:06', '2025-01-16 00:09:06', 'Tea & coffee only, Tea & coffee with biscuits/cookies, Hot buffet, LCD Projector, Projection Screen, Flipchart', 500, 200, 'Meeting room'),
(44, 63, 'Le Royal Méridien Shanghai', 600, 700, 'Le Royal Meridien Shanghai has approximately 2,000 square meters of conference space, including: two Grand Ballrooms with natural light, five meeting rooms and one VIP room. Full conference facilities include simultaneous translation system, state of', 30, 30, 30, 'Meeting room, China', '2025-02-18 17:00:00', '2025-02-18 17:00:00', 'active', '2025-01-16 00:13:55', '2025-01-16 00:14:13', 'Tea & coffee only, Tea & coffee with biscuits/cookies, Hot buffet, LCD Projector, Projection Screen, Flipchart', 600, 200, 'Meeting room'),
(45, 63, 'Beijing Yintai Centre', 100, 120, '3 meeting rooms are available on rent at Aloft Seoul Gangnam. The meeting facilities can accommodate between 6 to 20 delegates. You can see room specific details by clicking \"show details\" link on the meeting rooms.\r\n\r\nGiven its moderately sized meeting rooms, this venue caters mainly to small meetings and events. WiFi available at the venue. Please see the room descriptions for additional facilities.\r\n\r\nConveniently located in central Seoul, the venue can be easily accessed by public transport. Visitors can quickly reach the venue by train from the nearby railway station. It\'s convenient location near the airport makes it easy for international participants to reach. Vistors who need to stay overnight can get a hotel room at the venue.\r\n\r\nSituated close to the motorway, this venue is easily accessible by car and also offers parking facilities.', 10, 10, 10, 'Meeting room, China', '2025-02-19 17:00:00', '2025-02-19 17:00:00', 'active', '2025-01-16 00:16:57', '2025-01-16 00:16:57', 'Tea & coffee only, Tea & coffee with biscuits/cookies, Hot buffet, LCD Projector, Projection Screen, Flipchart', 100, 33, 'Meeting room'),
(46, 64, 'Event Space at O2 Work @ Odeon Towers', 300, 330, 'mpress your guests with our attractive event space and picturesque views. We make hosting your next seminar, product launch, or networking event both easy and hassle-free with our fully equipped, read to book event spaces. Whether it’s for a seminar or conference, our versatile event rooms for rental are able to accommodate your requirements. Our flexibility lets you run the event the way you want to!\n\nOur flexible event space for rental makes it the perfect location for your next internal event in Singapore. Leave the right impression on your guests with our insta-worthy views and our aesthetically pleasing design. Planning an event? Host it at O2Work!\n\nO2Work event space rental in Singapore can hold up to fifty-seventy (50-70)people in a theater-style setting. Temporary Limited to 25pax to follow Safe measurements.\n\nOur event spaces are able to host a range of events, whether it’s for a seminar, product launch, workshop, networking event, wine tasting or a conference, our versatile event space for rental are able to accommodate to your needs.', 50, 50, 50, 'Meeting room, Singapore', '2025-02-14 17:00:00', '2025-02-14 17:00:00', 'active', '2025-01-16 00:23:55', '2025-01-16 00:26:18', 'Wi-Fi, Projector, PA system / speakers, Air conditioning, Natural light, Paid parking is available on-site', 300, 100, 'Meeting room'),
(47, 64, '10 Pax Conference Room at O2 Work @ Odeon Towers', 200, 230, 'mpress your guests with our attractive event space and picturesque views. We make hosting your next seminar, product launch, or networking event both easy and hassle-free with our fully equipped, read to book event spaces. Whether it’s for a seminar or conference, our versatile event rooms for rental are able to accommodate your requirements. Our flexibility lets you run the event the way you want to!\r\n\r\nOur flexible event space for rental makes it the perfect location for your next internal event in Singapore. Leave the right impression on your guests with our insta-worthy views and our aesthetically pleasing design. Planning an event? Host it at O2Work!\r\n\r\nO2Work event space rental in Singapore can hold up to fifty-seventy (50-70)people in a theater-style setting. Temporary Limited to 25pax to follow Safe measurements.\r\n\r\nOur event spaces are able to host a range of events, whether it’s for a seminar, product launch, workshop, networking event, wine tasting or a conference, our versatile event space for rental are able to accommodate to your needs.', 20, 20, 20, 'Meeting room, Singapore', '2025-02-15 17:00:00', '2025-02-15 17:00:00', 'active', '2025-01-16 00:29:36', '2025-01-16 00:35:32', 'Wi-Fi, Projector, PA system / speakers, Air conditioning, Natural light, Paid parking is available on-site', 200, 80, 'Meeting room'),
(48, 65, 'Boardroom', 300, 350, 'Boardroom', 20, 20, 20, 'Meeting room', '2025-02-09 17:00:00', '2025-02-09 17:00:00', 'active', '2025-01-16 03:25:41', '2025-01-16 03:25:41', 'Speaker', 300, 100, 'Meeting room');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('62V4Nvz0JyQMHekjdphhOmkX3FnEvvq8rB5C71hJ', 17, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWTROSEhLM09CNUY3VjhPV3JOYWxveldZbXFPeGFUWEVTaUJyU21BbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yb29tcy8xNiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE3O30=', 1736998819),
('8r3HQ3pQCzI1gpwmD8JobHKcDqGVSgciDyIfUCcz', 14, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRWxGQzdsa3U0Zm5JcjVZN0VuYkF4OUNacTU5dnpUb3psTVZJNTMxbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGF5bWVudC9wYXlwYWw/X3Rva2VuPUVsRkM3bGt1NGZuSXI1WTdFbmJBeDlDWnE1OXZ6VG96bE1WSTUzMW4mYm9va2luZ1R5cGU9QWxsJTIwZGF5JmVuZEF0PTAxJTJGMTclMkYyMDI1JnBheW1lbnRfbWV0aG9kPXBheXBhbCZwcmljZT0xMDAwJnJvb21faWQ9MTYmc2Vzc2lvblR5cGU9QWxsJTIwZGF5JnN0YXJ0QXQ9MDElMkYxNyUyRjIwMjUmdGF4PTEwMCZ0b3RhbFByaWNlPTEwMDAmdXNlckVtYWlsPWx1dXF1YW5ndGluaDY1OTclNDBnbWFpbC5jb20mdXNlck5hbWU9TCVDNiVCMHUlMjBRdWFuZyUyMFQlQzMlQURuaCZ1c2VyUGhvbmU9MSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6ODoiY3VycmVuY3kiO3M6MzoiVVNEIjtzOjE5OiJnb29nbGVfYWNjZXNzX3Rva2VuIjthOjc6e3M6MTI6ImFjY2Vzc190b2tlbiI7czoyMjI6InlhMjkuYTBBUlc1bTc0ZXhzNEN3Z3ZGVkJHZW9JZVUwbDA4c0JJamJZSWtrY2E2bE41SXZxSktxc244RWpNU0VjclN4V1d4V2Z5aVNjZHlENVhtSEo3aUM0d25GR3dUby1HWlNOMWw1VmFfV2llQ1lxNkx2S0dGS0pxQmprQmVOcnEzS0J6bVFvZzlWZ1dYMDJMbk81ZzA3eEVFTDZ5Z3ZudWVwbG8tZFByUFQ1TGphQ2dZS0FVb1NBUklTRlFIR1gyTWlVSnVYLWdYUU1zMlVtR3I3ZVBQd0ZRMDE3NSI7czoxMDoiZXhwaXJlc19pbiI7aTozNTk5O3M6MTM6InJlZnJlc2hfdG9rZW4iO3M6MTAzOiIxLy8wZUVyZVVHaW9jQmY0Q2dZSUFSQUFHQTRTTndGLUw5SXJrMUFYME9CSWNRZnR4bDV6NHN2cmVERXl2cDlmLVcwcjVGUmF3MUtDVTBDRTFVZm5RVGN6NkRLTzVQNFoxRmkwcF9RIjtzOjU6InNjb3BlIjtzOjE0MzoiaHR0cHM6Ly93d3cuZ29vZ2xlYXBpcy5jb20vYXV0aC91c2VyaW5mby5wcm9maWxlIG9wZW5pZCBodHRwczovL3d3dy5nb29nbGVhcGlzLmNvbS9hdXRoL3VzZXJpbmZvLmVtYWlsIGh0dHBzOi8vd3d3Lmdvb2dsZWFwaXMuY29tL2F1dGgvY2FsZW5kYXIiO3M6MTA6InRva2VuX3R5cGUiO3M6NjoiQmVhcmVyIjtzOjg6ImlkX3Rva2VuIjtzOjExNjk6ImV5SmhiR2NpT2lKU1V6STFOaUlzSW10cFpDSTZJbVJrTVRJMVpEVm1ORFl5Wm1Kak5qQXhOR0ZsWkdGaU9ERmtaR1l6WW1ObFpHRmlOekE0TkRjaUxDSjBlWEFpT2lKS1YxUWlmUS5leUpwYzNNaU9pSm9kSFJ3Y3pvdkwyRmpZMjkxYm5SekxtZHZiMmRzWlM1amIyMGlMQ0poZW5BaU9pSXhPVGM0TkRJMk16UTFOalF0ZEc1c2JUaHdhMmhwYkc1MFpXbHpaR3RtWVdOeWFIRnRaMnd5T1hFeGIyZ3VZWEJ3Y3k1bmIyOW5iR1YxYzJWeVkyOXVkR1Z1ZEM1amIyMGlMQ0poZFdRaU9pSXhPVGM0TkRJMk16UTFOalF0ZEc1c2JUaHdhMmhwYkc1MFpXbHpaR3RtWVdOeWFIRnRaMnd5T1hFeGIyZ3VZWEJ3Y3k1bmIyOW5iR1YxYzJWeVkyOXVkR1Z1ZEM1amIyMGlMQ0p6ZFdJaU9pSXhNVEF3T1RZNE1URTJOekUzTlRJek16ZzJORGNpTENKbGJXRnBiQ0k2SW14MWRYRjFZVzVuZEdsdWFEWTFPVGRBWjIxaGFXd3VZMjl0SWl3aVpXMWhhV3hmZG1WeWFXWnBaV1FpT25SeWRXVXNJbUYwWDJoaGMyZ2lPaUp5TkhwbVZUZHZZemt3VTFCWGVFcGlhV3hQWTJabklpd2libUZ0WlNJNklsVERyVzVvSUV6R3NIVWdVWFZoYm1jaUxDSndhV04wZFhKbElqb2lhSFIwY0hNNkx5OXNhRE11WjI5dloyeGxkWE5sY21OdmJuUmxiblF1WTI5dEwyRXZRVU5uT0c5alMxaElSMnBWTVdwNGVGWlpVRGxUU0V0Wk9YUlhka3hYVUVWTmJtTk5kV2xDYlhkUVdHUk5PR2x5UkMxd1lrWlFURkU5Y3prMkxXTWlMQ0puYVhabGJsOXVZVzFsSWpvaVZNT3RibWdpTENKbVlXMXBiSGxmYm1GdFpTSTZJa3pHc0hVZ1VYVmhibWNpTENKcFlYUWlPakUzTXpjeE1qUTVNekFzSW1WNGNDSTZNVGN6TnpFeU9EVXpNSDAuVklqb2VZU1Roamt0NTNNNVY4QUk4am1RUEZ4cEJ3M28yaW9ieFotOVdpcl9IWjhCZ2dsMXV3Q1lSVlkzcldhMWJLbzV6WU1IVGItMjdiQ29UYjF6ckoxRnJPalcxU1FtWmNsdlpDZFZfQ21odHViZUJBa245RE9rbGpUSVVGODRWWHFTOVZNdElNOTFuanpuMlgwZGdmLVVJODFNSnNmTm84emJBN2hvRWhKall0cUV1Zm13X19vSjVVYTE2b1RRd3RPczdkWUpuM0pZWWRHcEhsMXhvOXNqLUNPYmd3VWhPYmpwajdnTDV4ZmxXUHZPS3UyVVZuQUpNWHp2YmZXSmFkMnhkUDlGdU1aNmdrVVBXTzBRdEh5WmRFcV9TWFhhNVpMdjMwdjBVUkxKT2Njbi1TSmRFS1V2NHhaWThtOXQ0aFlKUnNUcm9zZndUeV9lWm5TdDdRIjtzOjc6ImNyZWF0ZWQiO2k6MTczNzEyNDkzMDt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTQ7fQ==', 1737125539);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_method` enum('vnpay','momo','paypal') NOT NULL,
  `totalPrice` bigint(20) NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'VND',
  `status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `payment_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `startAt` date DEFAULT NULL,
  `endAt` date DEFAULT NULL,
  `bookingType` enum('All day','Session') NOT NULL DEFAULT 'All day',
  `sessionType` enum('All day','Morning','Afternoon','Evening') NOT NULL DEFAULT 'All day',
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPhone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `booking_id`, `transaction_id`, `payment_method`, `totalPrice`, `currency`, `status`, `payment_data`, `created_at`, `updated_at`, `room_id`, `price`, `tax`, `startAt`, `endAt`, `bookingType`, `sessionType`, `userName`, `userEmail`, `userPhone`) VALUES
(4, 1, NULL, 'b76e3516-7cb8-4b93-ab1a-d8f56da7c14e', 'vnpay', 300000, 'VND', 'pending', NULL, '2024-12-28 09:14:11', '2024-12-28 09:14:11', 16, 300000.00, 0.00, '2024-12-28', '2024-12-28', 'All day', 'All day', '', '', ''),
(6, 1, 467, 'a0dbd095-d38c-401e-978a-9f908b29ab71', 'vnpay', 300000, 'VND', 'success', '{\"vnp_Amount\":\"30000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14773136\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don a0dbd095-d38c-401e-978a-9f908b29ab71\",\"vnp_PayDate\":\"20241228170508\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14773136\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"a0dbd095-d38c-401e-978a-9f908b29ab71\",\"vnp_SecureHash\":\"351a71fd9a22a1b806f94f8127b0951c64a1c3fa338cf5d8bed4833654093d9b3e5ff049f2847a133c05dc74a8136eb20672b33a5a80b2a194fe50b14578c2e0\"}', '2024-12-28 10:05:09', '2024-12-28 10:35:17', 16, 300000.00, 0.00, '2024-12-28', '2024-12-28', 'All day', 'All day', '', '', ''),
(9, 1, NULL, 'ce4672bc-5cf4-495c-98f3-aa7b1b36940d', 'vnpay', 300000, 'VND', 'pending', NULL, '2024-12-31 05:47:46', '2024-12-31 05:47:46', 16, 300000.00, 0.00, '2024-12-31', '2024-12-31', 'All day', 'All day', '', '', ''),
(10, 3, 468, 'ea491f0c-c18c-4f9d-9860-20235f93ab2b', 'vnpay', 600000, 'VND', 'success', '{\"vnp_Amount\":\"60000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14778160\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don ea491f0c-c18c-4f9d-9860-20235f93ab2b\",\"vnp_PayDate\":\"20250102182352\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14778160\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"ea491f0c-c18c-4f9d-9860-20235f93ab2b\",\"vnp_SecureHash\":\"0e92dc6458c4d27274331c057a65614a8487b3a4d5614011300ed8fe6aac60735666cc65f10a92f03b526bd269f50c2dbc29a0e9c912cb55c06be7ef8f3d9b34\"}', '2025-01-02 11:22:37', '2025-01-02 11:26:36', 16, 120000.00, 60000.00, '2025-01-03', '2025-01-07', 'Session', 'Afternoon', '', '', ''),
(11, 1, 469, '987a1f2c-cb03-456c-893f-4787cca95c8a', 'vnpay', 120000, 'VND', 'success', '{\"vnp_Amount\":\"12000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14778998\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 987a1f2c-cb03-456c-893f-4787cca95c8a\",\"vnp_PayDate\":\"20250103114711\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14778998\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"987a1f2c-cb03-456c-893f-4787cca95c8a\",\"vnp_SecureHash\":\"3554f95db3086860b6f67e0720f4babda110cf0b4442e069a73af1636dd43da3da99842794448a1e3726b22578e908c4bc79e0acdb79f6d8a8795d62dc86066f\"}', '2025-01-03 04:46:49', '2025-01-03 04:47:37', 16, 120000.00, 12000.00, '2025-01-10', '2025-01-10', 'Session', 'Morning', 'Hiếu Nguyễn', 'luuquangtinh6597@gmail.com', '0385835634'),
(12, 17, 470, '242c4b35-1b57-43ec-9b18-9c7ec6dc400c', 'vnpay', 480000, 'VND', 'success', '{\"vnp_Amount\":\"48000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14779944\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 242c4b35-1b57-43ec-9b18-9c7ec6dc400c\",\"vnp_PayDate\":\"20250104015104\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14779944\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"242c4b35-1b57-43ec-9b18-9c7ec6dc400c\",\"vnp_SecureHash\":\"4c946885aa73d7847c0ce72fa3fef28da16a109c93bb695837d69d77e1f2909ec0f9772faefeed96bcd5aa3e30b2d920c1abc773c68beb83b8d1c739a0b2c535\"}', '2025-01-03 18:50:29', '2025-01-03 18:51:31', 16, 120000.00, 48000.00, '2025-01-13', '2025-01-16', 'Session', 'Evening', 'Thành Tài', 'luuquangtinh6597@gmail.com', '0336335465'),
(13, 17, 472, 'bb237ec1-7c20-4247-91b4-1179fe8f3b60', 'vnpay', 900000, 'VND', 'success', '{\"vnp_Amount\":\"90000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14780022\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don bb237ec1-7c20-4247-91b4-1179fe8f3b60\",\"vnp_PayDate\":\"20250104045429\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14780022\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"bb237ec1-7c20-4247-91b4-1179fe8f3b60\",\"vnp_SecureHash\":\"eac8dd60ba930be7a1ea06fad7823ceb54de7236b6b026a25d19861c09a5a9947a3895ef9326156451422acb95445b01f60e60aef31176d0ec0fad6bcf8abcc0\"}', '2025-01-03 21:54:10', '2025-01-03 21:59:08', 16, 300000.00, 90000.00, '2025-01-21', '2025-01-23', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634'),
(14, 17, 473, '55455364-2cb9-4200-8fee-b0aface0a7fb', 'vnpay', 600000, 'VND', 'success', '{\"vnp_Amount\":\"60000000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14780023\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 55455364-2cb9-4200-8fee-b0aface0a7fb\",\"vnp_PayDate\":\"20250104050625\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14780023\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"55455364-2cb9-4200-8fee-b0aface0a7fb\",\"vnp_SecureHash\":\"5c9aaefbe8fcd72204d35192c40b455834e6704602a70ef22e365ffee225abea071625673c62a4dab2904cbe749f8e6bc611430a8b72fd1eb47db06cfbcd0d58\"}', '2025-01-03 22:06:22', '2025-01-03 22:06:52', 16, 300000.00, 60000.00, '2025-01-27', '2025-01-28', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456'),
(15, 3, NULL, 'fdfc0a9b-10b1-4807-962c-2207f61cc965', 'vnpay', 330, 'VND', 'pending', NULL, '2025-01-07 04:44:55', '2025-01-07 04:44:55', 16, 330.00, 33.00, '2025-01-07', '2025-01-07', 'Session', 'Morning', 'Tinh', 'luuquangtinh6597@gmail.com', '0385835634'),
(16, 3, NULL, 'd072ef40-a904-4c4e-8faa-5d8f6d4551a2', 'vnpay', 25094243, 'VND', 'pending', NULL, '2025-01-07 05:13:05', '2025-01-07 05:13:05', 16, 8364748.00, 99.00, '2025-01-29', '2025-01-31', 'Session', 'Morning', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(17, 3, NULL, 'ef3a816b-a442-41f6-9240-4c59bf3fa452', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:14:28', '2025-01-07 05:14:28', 16, 25347720.00, 300.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(18, 3, NULL, 'db5a6d2b-4cef-4af7-8bbd-7c4f1b381ea9', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:17:11', '2025-01-07 05:17:11', 16, 25347720.00, 300.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(19, 3, NULL, '4d9836a4-7801-4317-b769-07a784620cd3', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:19:34', '2025-01-07 05:19:34', 16, 25347720.00, 300.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(20, 3, NULL, 'ff7efdfa-18f0-40cd-9e32-8e7468c57f48', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:19:54', '2025-01-07 05:19:54', 16, 25347720.00, 300.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(21, 3, NULL, '8a0cb107-7055-4c2e-8724-0a557b73b69a', 'vnpay', 3000, 'VND', 'pending', NULL, '2025-01-07 05:20:41', '2025-01-07 05:20:41', 16, 1000.00, 300.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(22, 3, NULL, '161ceea3-330f-4830-b28b-bedd5437234b', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:44:22', '2025-01-07 05:44:22', 16, 25347720.00, 7604316.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(23, 3, NULL, 'c051716b-447f-48bf-ac31-d5e4a417418d', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:45:50', '2025-01-07 05:45:50', 16, 25347720.00, 7604316.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(24, 3, NULL, 'af79e559-a22d-42c6-862d-06dc882d65f2', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:46:09', '2025-01-07 05:46:09', 16, 25347720.00, 7604316.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(25, 3, NULL, '5e414a65-3052-44f1-af24-c40f6edb4f78', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:46:18', '2025-01-07 05:46:18', 16, 25347720.00, 7604316.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(26, 3, NULL, '6eaa2de5-918a-4890-97a7-66b793e94782', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:47:58', '2025-01-07 05:47:58', 16, 25347720.00, 7604316.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0123456789'),
(27, 3, NULL, '39d055e3-bd73-4e62-925d-71d0feffa488', 'vnpay', 76043160, 'VND', 'pending', NULL, '2025-01-07 05:48:08', '2025-01-07 05:48:08', 16, 25347720.00, 7604316.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0123456789'),
(28, 3, NULL, '9f8c25ee-20cf-44de-b2f3-dfb16c8e216d', 'vnpay', 76043160, 'VND', 'failed', '{\"vnp_Amount\":\"7604316000\",\"vnp_BankCode\":\"VNPAY\",\"vnp_BankTranNo\":null,\"vnp_CardType\":\"QRCODE\",\"vnp_OrderInfo\":\"Thanh toan hoa don 9f8c25ee-20cf-44de-b2f3-dfb16c8e216d\",\"vnp_PayDate\":\"20250107125314\",\"vnp_ResponseCode\":\"24\",\"vnp_SecureHash\":\"133fcde81cc420533752983ed68928b8f06bfb09db021153311652def48f66e7b5dc1f90c424e02c750ed46c6407a8d5c6c83fecca53266981d35bc27f1ea025\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"0\",\"vnp_TransactionStatus\":\"02\",\"vnp_TxnRef\":\"9f8c25ee-20cf-44de-b2f3-dfb16c8e216d\"}', '2025-01-07 05:53:35', '2025-01-07 05:53:40', 16, 25347720.00, 7604316.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(29, 3, 474, 'a007919f-d7e6-4a35-8e1d-4830e73e9229', 'vnpay', 76043160, 'VND', 'success', '{\"vnp_Amount\":\"7604316000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14783082\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don a007919f-d7e6-4a35-8e1d-4830e73e9229\",\"vnp_PayDate\":\"20250107130847\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14783082\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"a007919f-d7e6-4a35-8e1d-4830e73e9229\",\"vnp_SecureHash\":\"9a3b93e123b70987e8d07bc81d5950960a7b7c3d6a0b4b2519b75c561abeffed6bbf19b00ba94f9ef277ef6099ffafb8a2037637254fa33de81337aca49da457\"}', '2025-01-07 06:08:42', '2025-01-07 06:09:17', 16, 25347720.00, 7604316.00, '2025-01-29', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(30, 3, NULL, 'eaf9df90-3bc9-4388-b331-df0176d3aa44', 'vnpay', 330, 'VND', 'pending', NULL, '2025-01-09 07:13:29', '2025-01-09 07:13:29', 16, 330.00, 33.00, '2025-02-04', '2025-02-04', 'Session', 'Evening', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634'),
(31, 3, 477, '3cea397c-ec94-411a-9af6-5e705e2925b7', 'vnpay', 8378304, 'VND', 'success', '{\"vnp_Amount\":\"837830400\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14786385\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 3cea397c-ec94-411a-9af6-5e705e2925b7\",\"vnp_PayDate\":\"20250109145025\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14786385\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"3cea397c-ec94-411a-9af6-5e705e2925b7\",\"vnp_SecureHash\":\"255716ff74b2cd808e5e486d3ebe1cb27ffafb421f62a3ea982d31fe9e6a7226024ebcb6f857a86620e032ce14894de4119634816db5d259a7196345f8e537d8\"}', '2025-01-09 07:50:32', '2025-01-09 07:53:05', 16, 8378304.00, 837830.40, '2025-02-04', '2025-02-04', 'Session', 'Evening', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0123456789'),
(32, 14, 482, '2cfaca1b-b692-414a-8d66-3999624cb326', 'vnpay', 8447121, 'VND', 'success', '{\"vnp_Amount\":\"844712100\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14789318\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 2cfaca1b-b692-414a-8d66-3999624cb326\",\"vnp_PayDate\":\"20250112004520\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14789318\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"2cfaca1b-b692-414a-8d66-3999624cb326\",\"vnp_SecureHash\":\"ece053eb3ba048a0b3a099dc7e30ffb9072ab5473a28b3c4464709ab8c0af7689532f6892517dbe6ae6dd4daad3d3ab491906df319a358cec74a8594be6b10cc\"}', '2025-01-11 17:44:36', '2025-01-11 17:54:19', 29, 2815707.03, 837102.09, '2025-01-21', '2025-01-23', 'Session', 'Afternoon', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634'),
(33, 14, 483, '0eab5ad7-efae-437a-ae44-2711b64d000a', 'vnpay', 2815707, 'VND', 'success', '{\"vnp_Amount\":\"281570700\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14789322\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 0eab5ad7-efae-437a-ae44-2711b64d000a\",\"vnp_PayDate\":\"20250112005647\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14789322\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"0eab5ad7-efae-437a-ae44-2711b64d000a\",\"vnp_SecureHash\":\"5dd21f3151afc1d0306b13b9e2a36f6bcbf40b249617640759b8fea872004929e29983e1fe8751814a47e2d488ef992e72ec508295e81ca80592b364ec6d474e\"}', '2025-01-11 17:56:46', '2025-01-11 17:57:16', 29, 2815707.03, 279034.03, '2025-01-12', '2025-01-12', 'Session', 'Evening', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634'),
(34, 14, 485, '5d17b758-14e0-4720-97d6-74c781141fd3', 'vnpay', 16742042, 'VND', 'success', '{\"vnp_Amount\":\"1674204100\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14789324\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 5d17b758-14e0-4720-97d6-74c781141fd3\",\"vnp_PayDate\":\"20250112010347\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14789324\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"5d17b758-14e0-4720-97d6-74c781141fd3\",\"vnp_SecureHash\":\"281b29f255602b27737d3ac92033e628bf11dee313227af283a77a271bb68975aa855f69db6c601a1666994ff6c941e8af879fa69125b19bce63630d18f32d71\"}', '2025-01-11 18:03:50', '2025-01-11 18:04:35', 16, 8371020.90, 1674204.18, '2025-02-01', '2025-02-02', 'Session', 'Morning', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634'),
(35, 14, 486, 'eb9a053f-e7d5-4140-bf60-d90847700d00', 'vnpay', 50733460, 'VND', 'success', '{\"vnp_Amount\":\"5073346000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14789338\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don eb9a053f-e7d5-4140-bf60-d90847700d00\",\"vnp_PayDate\":\"20250112013455\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14789338\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"eb9a053f-e7d5-4140-bf60-d90847700d00\",\"vnp_SecureHash\":\"5f985161a24d92ba6f12f5f958cd70392bbc9d1250f40918de4b5be4471272e8980d827dde277f2364d8e1e0c2fd963dd3b2a27e5879dc83cd5616462c190f01\"}', '2025-01-11 18:35:03', '2025-01-11 18:35:26', 16, 25366730.00, 5073346.00, '2025-01-24', '2025-01-25', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '0385835634'),
(36, 3, NULL, '76a38ccb-99db-44b8-8874-cd088c66f14b', 'vnpay', 16745018, 'VND', 'pending', NULL, '2025-01-13 20:36:39', '2025-01-13 20:36:39', 16, 8372509.20, 1674501.84, '2025-01-30', '2025-01-31', 'Session', 'Evening', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1'),
(37, 3, NULL, 'PAYID-M6C7QKA3DR9480407322164K', 'paypal', 111, 'USD', 'pending', NULL, '2025-01-14 05:37:44', '2025-01-14 05:37:44', 29, 111.00, 11.00, '2025-01-14', '2025-01-14', 'Session', 'Afternoon', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1'),
(38, 3, NULL, 'PAYID-M6C7QVQ3XP1945576820664U', 'paypal', 111, 'USD', 'pending', NULL, '2025-01-14 05:38:30', '2025-01-14 05:38:30', 29, 111.00, 11.00, '2025-01-14', '2025-01-14', 'Session', 'Afternoon', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1'),
(39, 3, 491, 'PAYID-M6C7VCI353078357R522472B', 'paypal', 330, 'USD', 'success', '{\"id\":\"PAYID-M6C7VCI353078357R522472B\",\"intent\":\"sale\",\"state\":\"approved\",\"cart\":\"71G234875J889423G\",\"payer\":{\"payment_method\":\"paypal\",\"status\":\"VERIFIED\",\"payer_info\":{\"email\":\"sb-o2o6p36678232@personal.example.com\",\"first_name\":\"John\",\"last_name\":\"Doe\",\"payer_id\":\"AE4S3W8Z85VGY\",\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"},\"country_code\":\"US\"}},\"transactions\":[{\"amount\":{\"total\":\"330.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"330.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payee\":{\"merchant_id\":\"E8NCB8UTS32TN\",\"email\":\"sb-qvtxi34426810@business.example.com\"},\"item_list\":{\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"related_resources\":[{\"sale\":{\"id\":\"7SM40524692635721\",\"state\":\"completed\",\"amount\":{\"total\":\"330.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"330.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payment_mode\":\"INSTANT_TRANSFER\",\"protection_eligibility\":\"ELIGIBLE\",\"protection_eligibility_type\":\"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE\",\"transaction_fee\":{\"value\":\"13.17\",\"currency\":\"USD\"},\"receivable_amount\":{\"value\":\"249.21\",\"currency\":\"GBP\"},\"exchange_rate\":\"0.78658122172\",\"parent_payment\":\"PAYID-M6C7VCI353078357R522472B\",\"create_time\":\"2025-01-14T05:48:01Z\",\"update_time\":\"2025-01-14T05:48:01Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/7SM40524692635721\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/7SM40524692635721\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6C7VCI353078357R522472B\",\"rel\":\"parent_payment\",\"method\":\"GET\"}]}}]}],\"failed_transactions\":[],\"create_time\":\"2025-01-14T05:47:52Z\",\"update_time\":\"2025-01-14T05:48:01Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6C7VCI353078357R522472B\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2025-01-14 05:47:53', '2025-01-14 05:53:01', 16, 330.00, 33.00, '2025-01-14', '2025-01-14', 'Session', 'Evening', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1'),
(40, 3, 492, 'PAYID-M6C7X2A6WH71224AP2226253', 'paypal', 330, 'USD', 'success', '{\"id\":\"PAYID-M6C7X2A6WH71224AP2226253\",\"intent\":\"sale\",\"state\":\"approved\",\"cart\":\"3AT90262XG1466926\",\"payer\":{\"payment_method\":\"paypal\",\"status\":\"VERIFIED\",\"payer_info\":{\"email\":\"sb-o2o6p36678232@personal.example.com\",\"first_name\":\"John\",\"last_name\":\"Doe\",\"payer_id\":\"AE4S3W8Z85VGY\",\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"},\"country_code\":\"US\"}},\"transactions\":[{\"amount\":{\"total\":\"330.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"330.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payee\":{\"merchant_id\":\"E8NCB8UTS32TN\",\"email\":\"sb-qvtxi34426810@business.example.com\"},\"item_list\":{\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"related_resources\":[{\"sale\":{\"id\":\"1KC11120UE901544V\",\"state\":\"completed\",\"amount\":{\"total\":\"330.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"330.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payment_mode\":\"INSTANT_TRANSFER\",\"protection_eligibility\":\"ELIGIBLE\",\"protection_eligibility_type\":\"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE\",\"transaction_fee\":{\"value\":\"13.17\",\"currency\":\"USD\"},\"receivable_amount\":{\"value\":\"249.21\",\"currency\":\"GBP\"},\"exchange_rate\":\"0.78658122172\",\"parent_payment\":\"PAYID-M6C7X2A6WH71224AP2226253\",\"create_time\":\"2025-01-14T05:53:57Z\",\"update_time\":\"2025-01-14T05:53:57Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/1KC11120UE901544V\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/1KC11120UE901544V\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6C7X2A6WH71224AP2226253\",\"rel\":\"parent_payment\",\"method\":\"GET\"}]}}]}],\"failed_transactions\":[],\"create_time\":\"2025-01-14T05:53:43Z\",\"update_time\":\"2025-01-14T05:53:57Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6C7X2A6WH71224AP2226253\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2025-01-14 05:53:44', '2025-01-14 05:53:57', 16, 330.00, 33.00, '2025-01-31', '2025-01-31', 'Session', 'Evening', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1'),
(41, 3, 493, 'PAYID-M6C7ZCY1GM02074SP615481F', 'paypal', 660, 'USD', 'success', '{\"id\":\"PAYID-M6C7ZCY1GM02074SP615481F\",\"intent\":\"sale\",\"state\":\"approved\",\"cart\":\"61E0604152345112M\",\"payer\":{\"payment_method\":\"paypal\",\"status\":\"VERIFIED\",\"payer_info\":{\"email\":\"sb-o2o6p36678232@personal.example.com\",\"first_name\":\"John\",\"last_name\":\"Doe\",\"payer_id\":\"AE4S3W8Z85VGY\",\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"},\"country_code\":\"US\"}},\"transactions\":[{\"amount\":{\"total\":\"660.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"660.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payee\":{\"merchant_id\":\"E8NCB8UTS32TN\",\"email\":\"sb-qvtxi34426810@business.example.com\"},\"item_list\":{\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"related_resources\":[{\"sale\":{\"id\":\"70634970YX644844J\",\"state\":\"completed\",\"amount\":{\"total\":\"660.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"660.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payment_mode\":\"INSTANT_TRANSFER\",\"protection_eligibility\":\"ELIGIBLE\",\"protection_eligibility_type\":\"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE\",\"transaction_fee\":{\"value\":\"26.04\",\"currency\":\"USD\"},\"receivable_amount\":{\"value\":\"498.66\",\"currency\":\"GBP\"},\"exchange_rate\":\"0.78658122172\",\"parent_payment\":\"PAYID-M6C7ZCY1GM02074SP615481F\",\"create_time\":\"2025-01-14T05:56:41Z\",\"update_time\":\"2025-01-14T05:56:41Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/70634970YX644844J\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/70634970YX644844J\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6C7ZCY1GM02074SP615481F\",\"rel\":\"parent_payment\",\"method\":\"GET\"}]}}]}],\"failed_transactions\":[],\"create_time\":\"2025-01-14T05:56:26Z\",\"update_time\":\"2025-01-14T05:56:41Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6C7ZCY1GM02074SP615481F\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2025-01-14 05:56:27', '2025-01-14 05:56:41', 16, 330.00, 66.00, '2025-01-28', '2025-01-29', 'Session', 'Morning', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1'),
(42, 14, 494, 'PAYID-M6C72JA370128007K804200G', 'paypal', 330, 'USD', 'success', '{\"id\":\"PAYID-M6C72JA370128007K804200G\",\"intent\":\"sale\",\"state\":\"approved\",\"cart\":\"9CD17262WN473541T\",\"payer\":{\"payment_method\":\"paypal\",\"status\":\"VERIFIED\",\"payer_info\":{\"email\":\"sb-o2o6p36678232@personal.example.com\",\"first_name\":\"John\",\"last_name\":\"Doe\",\"payer_id\":\"AE4S3W8Z85VGY\",\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"},\"country_code\":\"US\"}},\"transactions\":[{\"amount\":{\"total\":\"330.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"330.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payee\":{\"merchant_id\":\"E8NCB8UTS32TN\",\"email\":\"sb-qvtxi34426810@business.example.com\"},\"item_list\":{\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"related_resources\":[{\"sale\":{\"id\":\"3TW426081R086472W\",\"state\":\"completed\",\"amount\":{\"total\":\"330.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"330.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payment_mode\":\"INSTANT_TRANSFER\",\"protection_eligibility\":\"ELIGIBLE\",\"protection_eligibility_type\":\"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE\",\"transaction_fee\":{\"value\":\"13.17\",\"currency\":\"USD\"},\"receivable_amount\":{\"value\":\"249.21\",\"currency\":\"GBP\"},\"exchange_rate\":\"0.78658122172\",\"parent_payment\":\"PAYID-M6C72JA370128007K804200G\",\"create_time\":\"2025-01-14T05:59:08Z\",\"update_time\":\"2025-01-14T05:59:08Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/3TW426081R086472W\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/3TW426081R086472W\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6C72JA370128007K804200G\",\"rel\":\"parent_payment\",\"method\":\"GET\"}]}}]}],\"failed_transactions\":[],\"create_time\":\"2025-01-14T05:58:59Z\",\"update_time\":\"2025-01-14T05:59:08Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6C72JA370128007K804200G\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2025-01-14 05:59:00', '2025-01-14 05:59:09', 16, 330.00, 33.00, '2025-02-26', '2025-02-26', 'Session', 'Afternoon', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '2'),
(43, 14, 495, '642dcbef-fb9f-42ab-a1fd-47665258e4d8', 'vnpay', 7613322, 'VND', 'success', '{\"vnp_Amount\":\"761332200\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14792598\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 642dcbef-fb9f-42ab-a1fd-47665258e4d8\",\"vnp_PayDate\":\"20250114191940\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14792598\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"642dcbef-fb9f-42ab-a1fd-47665258e4d8\",\"vnp_SecureHash\":\"5e4f3c2c3f83216890bc93783e6b3f1eeafab6cb14a60d4cda857e9787c6f378abbf12e6a24592b2e54a4292c5096f04c0f6cf424085155ca851bc5f94ff3417\"}', '2025-01-14 12:19:32', '2025-01-14 12:20:12', 29, 7613322.00, 761332.00, '2025-01-31', '2025-01-31', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(44, 14, 496, 'PAYID-M6DFO7Y77735926RX587561M', 'paypal', 150, 'USD', 'success', '{\"id\":\"PAYID-M6DFO7Y77735926RX587561M\",\"intent\":\"sale\",\"state\":\"approved\",\"cart\":\"92W63395TF636541H\",\"payer\":{\"payment_method\":\"paypal\",\"status\":\"VERIFIED\",\"payer_info\":{\"email\":\"sb-o2o6p36678232@personal.example.com\",\"first_name\":\"John\",\"last_name\":\"Doe\",\"payer_id\":\"AE4S3W8Z85VGY\",\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"},\"country_code\":\"US\"}},\"transactions\":[{\"amount\":{\"total\":\"150.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"150.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payee\":{\"merchant_id\":\"E8NCB8UTS32TN\",\"email\":\"sb-qvtxi34426810@business.example.com\"},\"item_list\":{\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"related_resources\":[{\"sale\":{\"id\":\"54X821125S572864Y\",\"state\":\"completed\",\"amount\":{\"total\":\"150.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"150.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payment_mode\":\"INSTANT_TRANSFER\",\"protection_eligibility\":\"ELIGIBLE\",\"protection_eligibility_type\":\"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE\",\"transaction_fee\":{\"value\":\"6.15\",\"currency\":\"USD\"},\"receivable_amount\":{\"value\":\"113.15\",\"currency\":\"GBP\"},\"exchange_rate\":\"0.78658122172\",\"parent_payment\":\"PAYID-M6DFO7Y77735926RX587561M\",\"create_time\":\"2025-01-14T12:25:28Z\",\"update_time\":\"2025-01-14T12:25:28Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/54X821125S572864Y\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/54X821125S572864Y\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6DFO7Y77735926RX587561M\",\"rel\":\"parent_payment\",\"method\":\"GET\"}]}}]}],\"failed_transactions\":[],\"create_time\":\"2025-01-14T12:24:31Z\",\"update_time\":\"2025-01-14T12:25:28Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6DFO7Y77735926RX587561M\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2025-01-14 12:24:31', '2025-01-14 12:25:29', 28, 150.00, 15.00, '2025-01-14', '2025-01-14', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1234567890'),
(45, 14, NULL, '3f308d11-56ff-48b7-9545-0c907097f957', 'vnpay', 2000, 'VND', 'pending', NULL, '2025-01-16 03:09:59', '2025-01-16 03:09:59', 16, 1000.00, 200.00, '2025-01-21', '2025-01-22', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1234567890'),
(46, 14, 497, '445cc4a9-7e8a-4e2c-92e5-a2e3a50e534a', 'vnpay', 50769520, 'VND', 'success', '{\"vnp_Amount\":\"5076952000\",\"vnp_BankCode\":\"NCB\",\"vnp_BankTranNo\":\"VNP14794964\",\"vnp_CardType\":\"ATM\",\"vnp_OrderInfo\":\"Thanh toan hoa don 445cc4a9-7e8a-4e2c-92e5-a2e3a50e534a\",\"vnp_PayDate\":\"20250116101128\",\"vnp_ResponseCode\":\"00\",\"vnp_TmnCode\":\"WXTK4S85\",\"vnp_TransactionNo\":\"14794964\",\"vnp_TransactionStatus\":\"00\",\"vnp_TxnRef\":\"445cc4a9-7e8a-4e2c-92e5-a2e3a50e534a\",\"vnp_SecureHash\":\"2f5d22fd7fc0a580fb75715a36ea80fa325d4a13164b0448cad8d064dd47ebb0b4e52ff2196baa79aaedde76ea5dba0194447c8272b02cf0bc0045432ed56a5f\"}', '2025-01-16 03:11:26', '2025-01-16 03:11:59', 16, 25384760.00, 5076952.00, '2025-01-21', '2025-01-22', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1234567890'),
(47, 1, 498, 'PAYID-M6EHZQA7KK69563XJ4606502', 'paypal', 1050, 'USD', 'success', '{\"id\":\"PAYID-M6EHZQA7KK69563XJ4606502\",\"intent\":\"sale\",\"state\":\"approved\",\"cart\":\"9LA51378UA2820035\",\"payer\":{\"payment_method\":\"paypal\",\"status\":\"VERIFIED\",\"payer_info\":{\"email\":\"sb-o2o6p36678232@personal.example.com\",\"first_name\":\"John\",\"last_name\":\"Doe\",\"payer_id\":\"AE4S3W8Z85VGY\",\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"},\"country_code\":\"US\"}},\"transactions\":[{\"amount\":{\"total\":\"1050.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"1050.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payee\":{\"merchant_id\":\"E8NCB8UTS32TN\",\"email\":\"sb-qvtxi34426810@business.example.com\"},\"item_list\":{\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"related_resources\":[{\"sale\":{\"id\":\"8PM53802H84449508\",\"state\":\"completed\",\"amount\":{\"total\":\"1050.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"1050.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payment_mode\":\"INSTANT_TRANSFER\",\"protection_eligibility\":\"ELIGIBLE\",\"protection_eligibility_type\":\"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE\",\"transaction_fee\":{\"value\":\"41.25\",\"currency\":\"USD\"},\"receivable_amount\":{\"value\":\"793.46\",\"currency\":\"GBP\"},\"exchange_rate\":\"0.78658122172\",\"parent_payment\":\"PAYID-M6EHZQA7KK69563XJ4606502\",\"create_time\":\"2025-01-16T03:28:12Z\",\"update_time\":\"2025-01-16T03:28:12Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/8PM53802H84449508\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/8PM53802H84449508\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6EHZQA7KK69563XJ4606502\",\"rel\":\"parent_payment\",\"method\":\"GET\"}]}}]}],\"failed_transactions\":[],\"create_time\":\"2025-01-16T03:28:00Z\",\"update_time\":\"2025-01-16T03:28:12Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6EHZQA7KK69563XJ4606502\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2025-01-16 03:28:00', '2025-01-16 03:28:13', 27, 350.00, 105.00, '2025-01-16', '2025-01-18', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '123456789'),
(48, 14, 499, 'PAYID-M6EH2DA6W9334988E7250639', 'paypal', 3000, 'USD', 'success', '{\"id\":\"PAYID-M6EH2DA6W9334988E7250639\",\"intent\":\"sale\",\"state\":\"approved\",\"cart\":\"53W2359188428672X\",\"payer\":{\"payment_method\":\"paypal\",\"status\":\"VERIFIED\",\"payer_info\":{\"email\":\"sb-o2o6p36678232@personal.example.com\",\"first_name\":\"John\",\"last_name\":\"Doe\",\"payer_id\":\"AE4S3W8Z85VGY\",\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"},\"country_code\":\"US\"}},\"transactions\":[{\"amount\":{\"total\":\"3000.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"3000.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payee\":{\"merchant_id\":\"E8NCB8UTS32TN\",\"email\":\"sb-qvtxi34426810@business.example.com\"},\"item_list\":{\"shipping_address\":{\"recipient_name\":\"John Doe\",\"line1\":\"1 Main St\",\"city\":\"San Jose\",\"state\":\"CA\",\"postal_code\":\"95131\",\"country_code\":\"US\"}},\"related_resources\":[{\"sale\":{\"id\":\"5PD542870E027830C\",\"state\":\"completed\",\"amount\":{\"total\":\"3000.00\",\"currency\":\"USD\",\"details\":{\"subtotal\":\"3000.00\",\"shipping\":\"0.00\",\"insurance\":\"0.00\",\"handling_fee\":\"0.00\",\"shipping_discount\":\"0.00\",\"discount\":\"0.00\"}},\"payment_mode\":\"INSTANT_TRANSFER\",\"protection_eligibility\":\"ELIGIBLE\",\"protection_eligibility_type\":\"ITEM_NOT_RECEIVED_ELIGIBLE,UNAUTHORIZED_PAYMENT_ELIGIBLE\",\"transaction_fee\":{\"value\":\"117.30\",\"currency\":\"USD\"},\"receivable_amount\":{\"value\":\"2267.48\",\"currency\":\"GBP\"},\"exchange_rate\":\"0.78658122172\",\"parent_payment\":\"PAYID-M6EH2DA6W9334988E7250639\",\"create_time\":\"2025-01-16T03:29:23Z\",\"update_time\":\"2025-01-16T03:29:23Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/5PD542870E027830C\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/sale\\/5PD542870E027830C\\/refund\",\"rel\":\"refund\",\"method\":\"POST\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6EH2DA6W9334988E7250639\",\"rel\":\"parent_payment\",\"method\":\"GET\"}]}}]}],\"failed_transactions\":[],\"create_time\":\"2025-01-16T03:29:15Z\",\"update_time\":\"2025-01-16T03:29:23Z\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v1\\/payments\\/payment\\/PAYID-M6EH2DA6W9334988E7250639\",\"rel\":\"self\",\"method\":\"GET\"}]}', '2025-01-16 03:29:16', '2025-01-16 03:29:23', 16, 1000.00, 300.00, '2025-02-05', '2025-02-07', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1234567890'),
(49, 14, NULL, 'PAYID-M6FG5GQ6U964010XV2786905', 'paypal', 1000, 'USD', 'pending', NULL, '2025-01-17 14:52:10', '2025-01-17 14:52:10', 16, 1000.00, 100.00, '2025-01-17', '2025-01-17', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '2'),
(50, 14, NULL, 'PAYID-M6FG5IY75M360174S4858052', 'paypal', 1000, 'USD', 'pending', NULL, '2025-01-17 14:52:19', '2025-01-17 14:52:19', 16, 1000.00, 100.00, '2025-01-17', '2025-01-17', 'All day', 'All day', 'Lưu Quang Tính', 'luuquangtinh6597@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `dayOfBirth` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff','user','owner') NOT NULL DEFAULT 'user',
  `point` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_refresh_token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `dayOfBirth`, `gender`, `password`, `email`, `email_verified_at`, `phone`, `photo`, `address`, `country`, `username`, `role`, `point`, `status`, `remember_token`, `created_at`, `updated_at`, `google_refresh_token`) VALUES
(1, 'Super', 'Admin', '2025-01-16 03:28:33', 'male', '$2y$12$2Xte.pRnKyueEEgqNYK.CuV1MGERYU6bhnzXPc2UVvQnLlmHMtuxW', 'admin@gmail.com', '2024-11-29 08:38:41', '0123456789', NULL, '130 Điện Biên Phủ', 'Việt Nam', 'admin', 'admin', 0, 'active', 'yBslVGgZGbjLhcF6xxCdgpPkudOUhliDyXRkKUI8e380EUrLNcMWxIh84w3Z', '2024-11-29 08:38:41', '2024-12-14 10:43:36', ''),
(2, 'Staff', '1', '2024-12-16 11:32:04', 'male', '$2y$12$WniqOzU4BeR.3WqTKRheL.OCCUQKOPCpWqiUbnGrGxPG1FjVPH5/i', 'staff@gmail.com', '2024-11-29 08:38:42', '0123456789', NULL, NULL, 'Việt Nam', 'staff1', 'staff', 0, 'active', 'qvWd7NGRtapo7BjXsQ9FrKojltq3D8JfiaQ4SAR4RqidWy1frsLVPrJajraM', '2024-11-29 08:38:42', NULL, ''),
(3, 'User', '1', '2025-01-14 05:58:08', 'male', '$2y$12$2Xte.pRnKyueEEgqNYK.CuV1MGERYU6bhnzXPc2UVvQnLlmHMtuxW', 'user1@gmail.com', '2024-11-29 08:38:42', '0123456789', NULL, 'ĐN', 'Việt Nam', 'user1', 'user', 0, 'active', 'hJ7S2dZFVmR4IHEeCvuJ9wo4uiW8TTFnz9coQmmDUkMDnYvn5XGopUhPQYBB', '2024-11-29 08:38:42', '2024-12-13 10:17:15', ''),
(4, 'Hillary', 'Tromp', '1993-02-27 17:00:00', 'male', '$2y$12$5m7jHHNMjFjUWxsppa59iuVXKOsfAOfG59xAmXiawS.A/.Vk45T3W', 'goyette.keyshawn@example.com', '2024-11-29 08:38:42', '(872) 416-5136', NULL, NULL, 'Jordan', 'xdamore', 'user', 0, 'active', 'KUo6Xwy2fU', '2024-11-29 08:38:42', '2024-11-29 08:38:45', ''),
(5, 'Sylvester', 'Windler', '2024-12-14 19:22:06', 'male', '$2y$12$TmP3C/7GEptA7opkxL9P0eGKCNw.0S2MKOvYDRXat1K73nxigSajy', 'windler.dayna@example.org', '2024-11-29 08:38:42', '810-756-8000', NULL, NULL, 'Netherlands Antilles', 'roger62', 'user', 0, 'inactive', 'UwoyJU2T2h', '2024-11-29 08:38:42', '2024-12-14 12:22:06', ''),
(6, 'Alexandre', 'Auer', '1985-09-06 17:00:00', 'male', '$2y$12$/6F6rjy6cRW6BoWmRdL2p.IMLGR61Ti5OOOD0t9XfiYfru.xEWMfK', 'darrion.stamm@example.org', '2024-11-29 08:38:43', '973.230.3672', NULL, NULL, 'Taiwan', 'antonetta07', 'owner', 0, 'active', 'vDC7PHwcEB', '2024-11-29 08:38:43', '2024-11-29 08:38:45', ''),
(7, 'Bianka', 'Murphy', '2021-05-23 17:00:00', 'male', '$2y$12$/MXy1diJcXiANxjJnWBcKeUGYg2JWowoZDcbqcpnorANpHtak32/u', 'morissette.rusty@example.com', '2024-11-29 08:38:43', '+1.959.909.1117', NULL, NULL, 'American Samoa', 'simonis.kimberly', 'owner', 0, 'active', 'UrrhZbBTLB', '2024-11-29 08:38:43', '2024-11-29 08:38:45', ''),
(8, 'Florine', 'Zulauf', '1998-05-03 17:00:00', 'male', '$2y$12$AfkvWwVdnRP8L9SqDWMCSO06jbIBMVTWqJ/TbvSEc55.U7mxwbSTW', 'seamus96@example.net', '2024-11-29 08:38:43', '+1.463.990.3567', NULL, NULL, 'Tonga', 'wschmitt', 'user', 0, 'active', 'EQNU6CiTAt', '2024-11-29 08:38:43', '2024-11-29 08:38:45', ''),
(9, 'Sydni', 'Murphy', '2022-10-07 17:00:00', 'male', '$2y$12$UYr1Bynx8xBuuye/8KaW3etvN/kmENUd0nRqHZR6ChSXoNlXhJJM2', 'anderson.devante@example.net', '2024-11-29 08:38:44', '+1.312.427.8258', NULL, NULL, 'Puerto Rico', 'sierra50', 'owner', 0, 'active', 'NHcJVp7aEg', '2024-11-29 08:38:44', '2024-11-29 08:38:45', ''),
(10, 'Norris', 'Terry', '1979-06-01 17:00:00', 'male', '$2y$12$bs4TFJD4rOfSwZboEBPWd.jJH/s7J4J45JJGE/pz5ElSoyi/7zVy.', 'aufderhar.tyshawn@example.net', '2024-11-29 08:38:44', '1-678-227-7319', NULL, NULL, 'United Arab Emirates', 'deon38', 'owner', 0, 'active', 'kcL5WZL6WZ', '2024-11-29 08:38:44', '2024-11-29 08:38:45', ''),
(11, 'Darrick', 'Schuppe', '1974-10-24 16:00:00', 'female', '$2y$12$xgDiUbINI7h6hU2xNJlL8uUjlkkpgdLuYX0U06jST/jZkFURT08qa', 'rempel.nathanial@example.org', '2024-11-29 08:38:44', '539-303-3948', NULL, NULL, 'Wallis and Futuna', 'windler.golda', 'user', 0, 'active', 'hOiYeID6HG', '2024-11-29 08:38:44', '2024-11-29 08:38:45', ''),
(12, 'Jamar', 'Yost', '2019-10-06 17:00:00', 'male', '$2y$12$/.RKKuU3H6ITh1WK1/CBWOKCr0bVIL6Ap7rIrAY6S0Uk93zsYfmFK', 'bethany54@example.net', '2024-11-29 08:38:44', '+1.909.762.4687', NULL, NULL, 'Central African Republic', 'ole.yundt', 'user', 0, 'active', 'WN4vDjmMCP', '2024-11-29 08:38:44', '2024-11-29 08:38:45', ''),
(13, 'Bethany', 'Hamill', '2023-12-11 17:00:00', 'female', '$2y$12$0TRCQDyIbzOwhRSpXOIPherDnARbUtQeh2Z1iVVixGwvoo6J0jQgy', 'twiegand@example.net', '2024-11-29 08:38:45', '(660) 703-4142', NULL, NULL, 'Panama', 'gleason.eliezer', 'user', 0, 'active', 'gZGrIICuzf', '2024-11-29 08:38:45', '2024-11-29 08:38:45', ''),
(14, 'Tinh', 'Luu', '2025-01-16 03:14:13', 'male', '$2y$12$XoP9hD3pT/6QIRDc1TN7/uzEgmlLZKrXkZBxYSXcs9FvSu5Wv6vFu', 'luuquangtinh6597@gmail.com', NULL, '0385835634', NULL, 'Ha Noi', 'Việt Nam', 'luuquangtinh6597', 'admin', 0, 'active', NULL, '2024-12-12 23:45:37', '2025-01-16 03:14:13', '1//0ee02Jk5trg1GCgYIARAAGA4SNwF-L9IrvqkFohdbn37GPUjrex_FdRJO5hH4etfmT23Rmjg3hfx9RM2weW_IrbbeytEN0qBMNqo'),
(15, 'Nguyễn Thị', 'Cẩm Tiên', '1999-12-31 17:00:00', 'female', '$2y$12$fC75W5/Cv3ycGMRjqRE.lu9xiCRD9FIw/0isVmnomL4zjo6U49.Be', 'nguyenthicamtien@gmail.com', NULL, '012345678', NULL, '130 Điện Biên Phủ, Thanh Khê, Đà Nẵng', 'Việt Nam', 'nguyenthicamtien', 'user', 0, 'active', NULL, '2024-12-12 23:48:00', '2024-12-12 23:48:00', ''),
(16, 'Nguyễn', 'Văn A', '2024-12-13 17:42:31', 'male', '$2y$12$mtjQ5/PE8ovptR9K/Ctlve52.47I.hXsdv25BBIBEr2fQKrNleP5u', 'nguyenvana@gmail.com', NULL, '012345678', NULL, '123 Trần Cao Vân, Đà Nẵng', 'Việt Nam', 'nguyenvana', 'user', 0, 'inactive', NULL, '2024-12-13 02:38:34', '2024-12-13 10:42:31', ''),
(17, 'Owner', 'Account', '2024-12-16 10:30:10', 'male', '$2y$12$WniqOzU4BeR.3WqTKRheL.OCCUQKOPCpWqiUbnGrGxPG1FjVPH5/i', 'owner@gmail.com', '2016-12-15 10:23:25', '0123456789', NULL, '130 Điện Biên Phủ, Thanh Khê, Đà Nẵng', 'Việt Nam', 'owner', 'owner', 100, 'active', NULL, NULL, NULL, ''),
(21, 'Tính', 'Lưu Quang', '2025-01-04 16:48:22', 'female', '$2y$12$dDNj1aSkpqmJsVpHCu3/AOXgQaVUqv6y6EryR/7H5YcBgw0AcmrUy', 'tinhlq.144010123028@vtc.edu.vn', '2025-01-04 09:16:29', NULL, NULL, NULL, 'Việt Nam', NULL, 'user', 0, 'active', NULL, '2025-01-04 09:16:29', '2025-01-04 14:05:33', '1//0e2BhsM42USnYCgYIARAAGA4SNwF-L9IrAJOKtlxJFpaEQeAR-uTk-tqph1DVqRFNWHKrYq9Sl4NIpO0Btvfe8YFDERMcSOBoSik'),
(22, 'Quang Tính', 'Lưu', '2025-01-04 09:18:08', 'male', '$2y$12$b73qxk7CVd36003xfEthZe4EFraPBvXeBBr2DlfSUVfceTD3Cy0/S', 'luuquangtinh1997@gmail.com', '2025-01-04 09:18:08', NULL, NULL, NULL, 'Việt Nam', 'quang_tinh_luu', 'user', 0, 'active', NULL, '2025-01-04 09:18:08', '2025-01-04 09:18:08', '1//0eH60rzoF62zoCgYIARAAGA4SNwF-L9Ir36S1AqPP0B5GfLjvLvG5UZPmdAsTXURFjdeJAomCNe32-k57I1rXLYiDrCPIRSiIVps'),
(23, 'Trucre', 'Contact', '2025-01-04 21:31:38', 'male', '$2y$12$r10ErqK1dkHIhuKgLEgqku0ZDDekHTGh35P8vi/j7D0lbN2QF.3zq', 'contact.trucre@gmail.com', '2025-01-04 21:31:38', NULL, NULL, NULL, 'Việt Nam', 'trucre_contact', 'user', 0, 'active', NULL, '2025-01-04 21:31:38', '2025-01-04 21:31:38', '1//0eoLGyZPF0dVzCgYIARAAGA4SNwF-L9Ir5_f6xwvJSPhVAWvDnbuXiXP7dfRyM8Yffo08rQTUBiXvKfIIiaQ8FJWI_74nvo5b_X8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_room_id_foreign` (`room_id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buildings_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificates_building_id_foreign` (`building_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_room_id_foreign` (`room_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_building_id_foreign` (`building_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_building_id_foreign` (`building_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_booking_id_foreign` (`booking_id`),
  ADD KEY `transactions_room_id_foreign` (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`),
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `transactions_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
