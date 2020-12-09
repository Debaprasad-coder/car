-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 07:56 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_cart`
--

CREATE TABLE `car_cart` (
  `id` int(11) NOT NULL COMMENT 'AI,PK',
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT 'user id',
  `car_id` int(11) NOT NULL DEFAULT 0 COMMENT 'car id',
  `car_qty` int(11) NOT NULL DEFAULT 0 COMMENT 'car quantity',
  `car_unit_price` int(10) NOT NULL DEFAULT 0 COMMENT 'car unit price',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'created at',
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'updated at',
  `status` enum('pending','process','shipped','delivered','canceled') NOT NULL COMMENT 'cart_status'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `car_cart_address`
--

CREATE TABLE `car_cart_address` (
  `id` int(11) NOT NULL COMMENT 'AI,PK',
  `cart_id` int(11) NOT NULL COMMENT 'cart id',
  `bill_name` char(100) NOT NULL COMMENT 'billing name',
  `bill_email` char(100) NOT NULL COMMENT 'billing email',
  `bil_mobile` char(15) NOT NULL COMMENT 'billing mobile',
  `bill_address` varchar(255) NOT NULL COMMENT 'billing address',
  `ship_name` char(100) NOT NULL COMMENT 'shipping name',
  `ship_email` char(100) NOT NULL COMMENT 'shipping email',
  `ship_mobile` char(15) NOT NULL COMMENT 'shipping mobile',
  `ship_address` varchar(255) NOT NULL COMMENT 'shipping address',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'created at',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'updated at'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `car_model`
--

CREATE TABLE `car_model` (
  `id` int(11) NOT NULL COMMENT 'AI,PK',
  `car_brand` char(25) NOT NULL COMMENT 'car brnad name',
  `car_name` char(25) NOT NULL COMMENT 'car name',
  `car_image` char(10) DEFAULT NULL COMMENT 'car image',
  `car_price` int(10) DEFAULT NULL COMMENT 'car price',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'created at',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'updated at'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `car_model`
--

INSERT INTO `car_model` (`id`, `car_brand`, `car_name`, `car_image`, `car_price`, `created_at`, `updated_at`) VALUES
(1, 'MARUTI', 'Maruti Suzuki Echo', '1.jpg', 450000, '2020-07-03 06:39:54', '2020-08-18 09:37:44'),
(2, 'MARUTI', 'Maruti Suzuki Alto', '2.jpg', 350000, '2020-07-03 06:39:54', '2020-08-18 13:06:55'),
(3, 'MARUTI', 'Maruti-800', '3.jpg', 350000, '2020-07-03 06:39:54', '0000-00-00 00:00:00'),
(4, 'MARUTI', 'Maruti Suzuki Dezire', '4.jpg', 750000, '2020-07-03 06:43:21', '0000-00-00 00:00:00'),
(5, 'BMW', 'BMW X5', '5.jpg', 7500065, '2020-07-03 06:43:25', '2020-08-18 09:39:56'),
(6, 'BMW', 'BMW X6', '6.jpg', 5500000, '2020-07-03 06:43:25', '0000-00-00 00:00:00'),
(7, 'BMW', 'BMW X8', '7.jpg', 4500000, '2020-07-03 06:43:25', '0000-00-00 00:00:00'),
(8, 'BMW', 'BMW X 10', '8.jpg', 4500000, '2020-07-03 06:43:25', '0000-00-00 00:00:00'),
(9, 'MAHINDRA', 'MAHINDRA XUV', '9.jpg', 1500000, '2020-07-03 06:46:40', '0000-00-00 00:00:00'),
(10, 'MAHINDRA', 'MAHINDRA BOLREO', '10.jpg', 650000, '2020-07-03 06:46:40', '0000-00-00 00:00:00'),
(11, 'MAHINDRA', 'MAHINDRA SCORPIO', '11.jpg', 1500000, '2020-07-03 06:49:53', '0000-00-00 00:00:00'),
(12, 'MAHINDRA', 'MAHINDRA RENAULT', '12.jpg', 1200000, '2020-07-03 06:46:40', '0000-00-00 00:00:00'),
(24, 'TOYOTA', 'Toyota Innova Crysta', '24.jpg', 1500000, '2020-08-17 16:21:19', '2020-08-17 10:51:19'),
(26, 'TOYOTA', 'Toyota Glanza', '26.jpg', 4500000, '2020-08-17 16:22:38', '2020-08-17 10:52:38'),
(28, 'TATA', 'Tata Nexon EV', '28.jpg', 700000, '2020-08-17 16:25:41', '2020-08-17 10:55:41'),
(29, 'TATA', 'Tata Harrier', '29.jpg', 550000, '2020-08-17 16:26:23', '2020-08-17 10:56:23'),
(30, 'TATA', 'Tata Yodha Pickup', '30.jpg', 8000000, '2020-08-17 16:33:48', '2020-08-17 11:03:48'),
(32, 'TATA', 'Tata Tigor', '32.jpg', 650000, '2020-08-18 15:56:41', '2020-08-18 10:26:41'),
(33, 'TOYOTA', 'INNOVA', '33.jpg', 4500000, '2020-12-05 06:04:40', '2020-12-05 00:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_11_000000_create_roles_table', 1),
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_13_000000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nickname` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nickname`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, NULL),
(2, 'user', 'User', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'AI,PK',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'user name',
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'user code',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'user email',
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'user phone',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'user password',
  `role_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 2,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `code`, `email`, `phone`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'DEBAPRASAD MAITY', 'CAR-5fcb21e377708', 'debaprasad.maity@yahoo.com', '9474758548', '$2y$10$T7mI5PtvffTnqksa0Y8DLewtlUyB0OADMWJRtlcZFV.vEDgnEL/76', 1, '0c3WdF8tAvNQipZvG68BXK9njQuNQF1AiWZNioc4zeD3GpFrO8GHLQZf3COy', '2020-12-05 00:30:03', '2020-12-05 00:30:03'),
(2, 'Asit Das', 'CAR-5fcb233d6271b', 'dmparision@gmail.com', '1234567456', '$2y$10$.8TUrRXPNXwH/rHH8v.OC.izCbkM/rrSedav3XyP5OUCiTdPBxLM6', 2, 'EMdpidWWmiVOuQ7ZawZ1WsuLRLzYJG9oIn6Xg4OfYZjyL7CfeTSUQ6fWtN0m', '2020-12-05 00:35:49', '2020-12-05 00:35:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_cart`
--
ALTER TABLE `car_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_cart_address`
--
ALTER TABLE `car_cart_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_model`
--
ALTER TABLE `car_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_code_unique` (`code`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_cart`
--
ALTER TABLE `car_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AI,PK';

--
-- AUTO_INCREMENT for table `car_cart_address`
--
ALTER TABLE `car_cart_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AI,PK';

--
-- AUTO_INCREMENT for table `car_model`
--
ALTER TABLE `car_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'AI,PK', AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'AI,PK', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
