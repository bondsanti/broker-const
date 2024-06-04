-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 09:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vbeyond_broker_const`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `cus_no` varchar(10) DEFAULT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `cus_date` varchar(50) DEFAULT NULL,
  `status_date` varchar(50) DEFAULT NULL,
  `onsite_date` varchar(50) DEFAULT NULL,
  `notify_id` int(3) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `maps` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `cus_no`, `cus_name`, `tel`, `status`, `cus_date`, `status_date`, `onsite_date`, `notify_id`, `budget`, `location`, `maps`, `detail`, `remark`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'BCO-001', 'วสันต์ ศิริ', '061111023', 'เสนอแบบ', NULL, '2024-06-02', NULL, 6, 1200000, 'เกาะเต่า', 'https://maps.app.goo.gl/Lnwsu5yb3nSChFHP7', 'ทดสอบ', 'ทดสอบหมายเหตุ', '2024-05-27 05:05:18', '2024-06-02 10:43:59', NULL),
(4, 'BCO-002', 'ญาสิตา เจริญสิน', '098934120', 'อยู่ระหว่างเสนอราคา', NULL, '2024-06-02', NULL, 6, 55000, 'เชียงใหม่', 'https://maps.app.goo.gl/t2iSgwgKv5KcgPDU9', '<p><b>รายละเอียด</b></p><ol><li><b>หนึ่ง</b></li><li><b>สอง</b></li><li><b>สาม</b></li></ol>', NULL, '2024-05-27 06:09:57', '2024-06-02 10:44:25', NULL),
(5, 'BCO-003', 'ธมน ภูภาค', '09872910', 'อยู่ระหว่างเสนอราคา', NULL, '2024-06-02', NULL, 7, 800000, 'ชลบุรี', 'https://maps.app.goo.gl/U53Fe9tA43kwQEhU7', '<ol><li>ทดสอบ1</li><li><font color=\"#000000\" style=\"background-color: rgb(255, 255, 0);\">ทดสอบ2</font></li></ol>', NULL, '2024-05-03 07:37:54', '2024-06-02 13:32:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `email`, `active`, `created_at`, `updated_at`) VALUES
(2, 'sirawich.t@vbeyond.co.th', 0, '2024-05-13 22:00:10', '2024-05-19 21:28:54'),
(3, 'santi.c@vbeyond.co.th', 1, '2024-05-13 23:16:27', '2024-05-20 03:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `cus_id`, `url`, `created_at`, `updated_at`) VALUES
(3, '3', '1716786318_6654148eeeaa4.pdf', '2024-05-27 05:05:18', '2024-05-27 05:05:18'),
(4, '4', '1716790197_665423b5b7985.pdf', '2024-05-27 06:09:57', '2024-05-27 06:09:57'),
(6, '5', '1716795475_665438531a35e.pdf', '2024-05-27 07:37:55', '2024-05-27 07:37:55'),
(7, '5', '1716795770_6654397a31b7d.pdf', '2024-05-27 07:42:50', '2024-05-27 07:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(10) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `cus_id`, `url`, `created_at`, `updated_at`) VALUES
(5, '3', '1716786318_6654148eea8f4.jpg', '2024-05-27 05:05:18', '2024-05-27 05:05:18'),
(6, '3', '1716786318_6654148eed10a.png', '2024-05-27 05:05:18', '2024-05-27 05:05:18'),
(7, '3', '1716786318_6654148eedddf.jpg', '2024-05-27 05:05:18', '2024-05-27 05:05:18'),
(8, '4', '1716790197_665423b574e47.jpg', '2024-05-27 06:09:57', '2024-05-27 06:09:57'),
(9, '5', '1716795474_66543852dad00.jpg', '2024-05-27 07:37:55', '2024-05-27 07:37:55'),
(10, '5', '1716795475_6654385317e27.jpg', '2024-05-27 07:37:55', '2024-05-27 07:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 3464, 'Login', 'Login', '2024-06-02 16:34:23', '2024-06-02 16:34:23'),
(2, 3464, '', 'Logout', '2024-06-02 16:55:31', '2024-06-02 16:55:31'),
(3, 3464, 'Login', 'Login', '2024-06-02 16:55:48', '2024-06-02 16:55:48'),
(4, 3464, '', 'Logout', '2024-06-02 16:55:53', '2024-06-02 16:55:53'),
(5, 3464, '', 'Login AllowLoginConnect By vBisConnect', '2024-06-02 18:05:54', '2024-06-02 18:05:54'),
(6, 3464, '', 'Logout', '2024-06-02 18:05:57', '2024-06-02 18:05:57'),
(7, 3464, 'Login', 'Login', '2024-06-04 06:09:13', '2024-06-04 06:09:13');

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
(3, '2024_05_08_091214_create_logs_table', 1),
(4, '2024_05_08_091728_create_role_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sla` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`id`, `name`, `sla`, `created_at`, `updated_at`) VALUES
(5, 'รีโนเวท', 37, '2024-05-13 00:05:25', '2024-05-13 00:05:25'),
(6, 'ก่อสร้าง', 75, '2024-05-13 00:08:21', '2024-05-13 00:08:21'),
(7, 'ออกแบบ', 30, '2024-05-13 00:09:08', '2024-05-13 04:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_type` varchar(30) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_type`, `active`, `created_at`, `updated_at`) VALUES
(1, 3464, 'SuperAdmin', 1, '2024-05-08 03:25:04', '2024-05-08 03:25:04'),
(4, 1234, 'SuperAdmin', 1, '2024-05-09 04:49:02', '2024-05-09 04:49:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
