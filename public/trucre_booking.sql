-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2024 at 08:02 AM
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
-- Table structure for table `bookingDetail`
--

CREATE TABLE `bookingDetail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `startAt` timestamp NOT NULL DEFAULT '2024-11-29 08:38:41',
  `endAt` timestamp NOT NULL DEFAULT '2024-11-29 08:38:41',
  `loop` enum('no','yes') NOT NULL DEFAULT 'no',
  `totalDays` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tax` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `frequency` enum('daily','weekly','monthly','yearly') NOT NULL DEFAULT 'daily',
  `repeat_count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
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
(1, 1, 'VTC ACADEMY', 'Trung tâm giảng dạy CNTT và TKĐH lớn nhất tại Đà Nẵng', '130 Điện Biên Phủ, Chính Gián, Thanh Khê, TP. Đà Nẵng', 'Việt Nam', 'This is map', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, '2024_12_12_033503_drop_table_types_and_categories', 2);

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
-- Table structure for table `pricing_rules`
--

CREATE TABLE `pricing_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recurring_bookings`
--

CREATE TABLE `recurring_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `is_holiday` tinyint(1) NOT NULL DEFAULT 0,
  `is_weekend` tinyint(1) NOT NULL DEFAULT 0,
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
  `images` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
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
  `weekPrice` int(11) NOT NULL DEFAULT 0,
  `monthPrice` int(11) NOT NULL DEFAULT 0,
  `yearPrice` int(11) NOT NULL DEFAULT 0,
  `weekendPrice` int(11) NOT NULL DEFAULT 0,
  `holidayPrice` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `building_id`, `name`, `price`, `comparePrice`, `images`, `description`, `maxChair`, `maxTable`, `maxPeople`, `tags`, `startAt`, `endAt`, `status`, `created_at`, `updated_at`, `furniture`, `weekPrice`, `monthPrice`, `yearPrice`, `weekendPrice`, `holidayPrice`) VALUES
(2, 1, 'Conference room at VTC ACADEMY', 1000, 2000, '', 'Super large Conference room at VTC ACADEMY', 100, 20, 100, '', '2024-11-29 08:38:41', '2024-11-29 08:38:41', 'waiting', NULL, NULL, NULL, 2000, 2000, 2000, 2000, 2000);

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
('gBtJgi3eSgvqoabwJzK1OSpinjOQpEjEXys7juoi', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMlZkVWZFQXJ6M0pFUWk0blNsQTduZXJXU1hrSlRyZFNaQWZwMWx3dCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2J1aWxkaW5ncyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734392458),
('qsbGagzegQJKAmvFJtbHddMtdeGbw9JpveRuaTGB', 17, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUXdjRnRjWE1tTGs3WTJCMHpBZkVHVzF4UzVybnFja3dFS2I5V0l0ZCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vYnVpbGRpbmdzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTc7fQ==', 1734364229);

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
  `phone` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff','user','owner') NOT NULL DEFAULT 'user',
  `point` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `dayOfBirth`, `gender`, `password`, `email`, `email_verified_at`, `phone`, `photo`, `address`, `country`, `username`, `role`, `point`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', '2024-12-16 11:31:30', 'male', '$2y$12$2Xte.pRnKyueEEgqNYK.CuV1MGERYU6bhnzXPc2UVvQnLlmHMtuxW', 'admin@gmail.com', '2024-11-29 08:38:41', '0123456789', NULL, '130 Điện Biên Phủ', 'Việt Nam', 'admin', 'admin', 0, 'active', 'ky2ghH0Y7TKMjLpxBzEkTjiWBnzY8le0SJdt14tGmxZ5XDO5YTeT8N2hDR5K', '2024-11-29 08:38:41', '2024-12-14 10:43:36'),
(2, 'Staff', '1', '2024-12-16 11:32:04', 'male', '$2y$12$WniqOzU4BeR.3WqTKRheL.OCCUQKOPCpWqiUbnGrGxPG1FjVPH5/i', 'staff@gmail.com', '2024-11-29 08:38:42', '0123456789', NULL, NULL, 'Việt Nam', 'staff1', 'staff', 0, 'active', 'qvWd7NGRtapo7BjXsQ9FrKojltq3D8JfiaQ4SAR4RqidWy1frsLVPrJajraM', '2024-11-29 08:38:42', NULL),
(3, 'User', '1', '2024-11-28 17:00:00', 'male', '12345678', 'user1@gmail.com', '2024-11-29 08:38:42', '0123456789', NULL, 'ĐN', 'Việt Nam', 'user1', 'user', 0, 'active', 'jZpsQ7YjkX', '2024-11-29 08:38:42', '2024-12-13 10:17:15'),
(4, 'Hillary', 'Tromp', '1993-02-27 17:00:00', 'male', '$2y$12$5m7jHHNMjFjUWxsppa59iuVXKOsfAOfG59xAmXiawS.A/.Vk45T3W', 'goyette.keyshawn@example.com', '2024-11-29 08:38:42', '(872) 416-5136', NULL, NULL, 'Jordan', 'xdamore', 'user', 0, 'active', 'KUo6Xwy2fU', '2024-11-29 08:38:42', '2024-11-29 08:38:45'),
(5, 'Sylvester', 'Windler', '2024-12-14 19:22:06', 'male', '$2y$12$TmP3C/7GEptA7opkxL9P0eGKCNw.0S2MKOvYDRXat1K73nxigSajy', 'windler.dayna@example.org', '2024-11-29 08:38:42', '810-756-8000', NULL, NULL, 'Netherlands Antilles', 'roger62', 'user', 0, 'inactive', 'UwoyJU2T2h', '2024-11-29 08:38:42', '2024-12-14 12:22:06'),
(6, 'Alexandre', 'Auer', '1985-09-06 17:00:00', 'male', '$2y$12$/6F6rjy6cRW6BoWmRdL2p.IMLGR61Ti5OOOD0t9XfiYfru.xEWMfK', 'darrion.stamm@example.org', '2024-11-29 08:38:43', '973.230.3672', NULL, NULL, 'Taiwan', 'antonetta07', 'owner', 0, 'active', 'vDC7PHwcEB', '2024-11-29 08:38:43', '2024-11-29 08:38:45'),
(7, 'Bianka', 'Murphy', '2021-05-23 17:00:00', 'male', '$2y$12$/MXy1diJcXiANxjJnWBcKeUGYg2JWowoZDcbqcpnorANpHtak32/u', 'morissette.rusty@example.com', '2024-11-29 08:38:43', '+1.959.909.1117', NULL, NULL, 'American Samoa', 'simonis.kimberly', 'owner', 0, 'active', 'UrrhZbBTLB', '2024-11-29 08:38:43', '2024-11-29 08:38:45'),
(8, 'Florine', 'Zulauf', '1998-05-03 17:00:00', 'male', '$2y$12$AfkvWwVdnRP8L9SqDWMCSO06jbIBMVTWqJ/TbvSEc55.U7mxwbSTW', 'seamus96@example.net', '2024-11-29 08:38:43', '+1.463.990.3567', NULL, NULL, 'Tonga', 'wschmitt', 'user', 0, 'active', 'EQNU6CiTAt', '2024-11-29 08:38:43', '2024-11-29 08:38:45'),
(9, 'Sydni', 'Murphy', '2022-10-07 17:00:00', 'male', '$2y$12$UYr1Bynx8xBuuye/8KaW3etvN/kmENUd0nRqHZR6ChSXoNlXhJJM2', 'anderson.devante@example.net', '2024-11-29 08:38:44', '+1.312.427.8258', NULL, NULL, 'Puerto Rico', 'sierra50', 'owner', 0, 'active', 'NHcJVp7aEg', '2024-11-29 08:38:44', '2024-11-29 08:38:45'),
(10, 'Norris', 'Terry', '1979-06-01 17:00:00', 'male', '$2y$12$bs4TFJD4rOfSwZboEBPWd.jJH/s7J4J45JJGE/pz5ElSoyi/7zVy.', 'aufderhar.tyshawn@example.net', '2024-11-29 08:38:44', '1-678-227-7319', NULL, NULL, 'United Arab Emirates', 'deon38', 'owner', 0, 'active', 'kcL5WZL6WZ', '2024-11-29 08:38:44', '2024-11-29 08:38:45'),
(11, 'Darrick', 'Schuppe', '1974-10-24 16:00:00', 'female', '$2y$12$xgDiUbINI7h6hU2xNJlL8uUjlkkpgdLuYX0U06jST/jZkFURT08qa', 'rempel.nathanial@example.org', '2024-11-29 08:38:44', '539-303-3948', NULL, NULL, 'Wallis and Futuna', 'windler.golda', 'user', 0, 'active', 'hOiYeID6HG', '2024-11-29 08:38:44', '2024-11-29 08:38:45'),
(12, 'Jamar', 'Yost', '2019-10-06 17:00:00', 'male', '$2y$12$/.RKKuU3H6ITh1WK1/CBWOKCr0bVIL6Ap7rIrAY6S0Uk93zsYfmFK', 'bethany54@example.net', '2024-11-29 08:38:44', '+1.909.762.4687', NULL, NULL, 'Central African Republic', 'ole.yundt', 'user', 0, 'active', 'WN4vDjmMCP', '2024-11-29 08:38:44', '2024-11-29 08:38:45'),
(13, 'Bethany', 'Hamill', '2023-12-11 17:00:00', 'female', '$2y$12$0TRCQDyIbzOwhRSpXOIPherDnARbUtQeh2Z1iVVixGwvoo6J0jQgy', 'twiegand@example.net', '2024-11-29 08:38:45', '(660) 703-4142', NULL, NULL, 'Panama', 'gleason.eliezer', 'user', 0, 'active', 'gZGrIICuzf', '2024-11-29 08:38:45', '2024-11-29 08:38:45'),
(14, 'Tinh', 'Luu', '1997-05-05 17:00:00', 'male', '$2y$12$XTN0sm6uhS.UG1kSg6tUSOPf2uWT4voG9X.9D74jbDswtkY06vgy2', 'luuquangtinh6597@gmail.com', NULL, '0385835634', NULL, 'Ha Noi', 'Việt Nam', 'luuquangtinh6597', 'admin', 0, 'active', NULL, '2024-12-12 23:45:37', '2024-12-12 23:45:37'),
(15, 'Nguyễn Thị', 'Cẩm Tiên', '1999-12-31 17:00:00', 'female', '$2y$12$fC75W5/Cv3ycGMRjqRE.lu9xiCRD9FIw/0isVmnomL4zjo6U49.Be', 'nguyenthicamtien@gmail.com', NULL, '012345678', NULL, '130 Điện Biên Phủ, Thanh Khê, Đà Nẵng', 'Việt Nam', 'nguyenthicamtien', 'user', 0, 'active', NULL, '2024-12-12 23:48:00', '2024-12-12 23:48:00'),
(16, 'Nguyễn', 'Văn A', '2024-12-13 17:42:31', 'male', '$2y$12$mtjQ5/PE8ovptR9K/Ctlve52.47I.hXsdv25BBIBEr2fQKrNleP5u', 'nguyenvana@gmail.com', NULL, '012345678', NULL, '123 Trần Cao Vân, Đà Nẵng', 'Việt Nam', 'nguyenvana', 'user', 0, 'inactive', NULL, '2024-12-13 02:38:34', '2024-12-13 10:42:31'),
(17, 'Owner', 'Account', '2024-12-16 10:30:10', 'male', '$2y$12$WniqOzU4BeR.3WqTKRheL.OCCUQKOPCpWqiUbnGrGxPG1FjVPH5/i', 'owner@gmail.com', '2016-12-15 10:23:25', '0123456789', NULL, '130 Điện Biên Phủ, Thanh Khê, Đà Nẵng', 'Việt Nam', 'owner', 'owner', 100, 'active', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookingDetail`
--
ALTER TABLE `bookingDetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookingdetail_booking_id_foreign` (`booking_id`),
  ADD KEY `bookingdetail_room_id_foreign` (`room_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

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
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pricing_rules`
--
ALTER TABLE `pricing_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pricing_rules_room_id_foreign` (`room_id`);

--
-- Indexes for table `recurring_bookings`
--
ALTER TABLE `recurring_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recurring_bookings_booking_id_foreign` (`booking_id`),
  ADD KEY `recurring_bookings_room_id_foreign` (`room_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookingDetail`
--
ALTER TABLE `bookingDetail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing_rules`
--
ALTER TABLE `pricing_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recurring_bookings`
--
ALTER TABLE `recurring_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookingDetail`
--
ALTER TABLE `bookingDetail`
  ADD CONSTRAINT `bookingdetail_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `bookingdetail_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
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
-- Constraints for table `pricing_rules`
--
ALTER TABLE `pricing_rules`
  ADD CONSTRAINT `pricing_rules_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recurring_bookings`
--
ALTER TABLE `recurring_bookings`
  ADD CONSTRAINT `recurring_bookings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recurring_bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_building_id_foreign` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
