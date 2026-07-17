-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 17, 2026 at 12:15 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drivecheck`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checking_points`
--

DROP TABLE IF EXISTS `checking_points`;
CREATE TABLE IF NOT EXISTS `checking_points` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incharge_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `police_station` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checking_points`
--

INSERT INTO `checking_points` (`id`, `name`, `incharge_name`, `police_station`, `created_at`, `updated_at`) VALUES
(52, 'Railway Crossing Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(51, 'Bus Stand Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(50, 'Rajkot Road Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(49, 'Shiv Mandir Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(48, 'Ramji Mandir Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(47, 'Taluka Panchayat Gate', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(46, 'Market Yard Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(45, 'Court Circle Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(44, 'Hospital Chowk Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(43, 'Ambedkar Circle Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(42, 'Railway Station Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(41, 'Bus Stand Vallabhipur', NULL, 'Vallabhipur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(40, 'Bhavnagar Road Gadhada', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(39, 'Ramdev Nagar Gadhada', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(38, 'Taluka Panchayat Chowk', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(37, 'Market Yard Gadhada', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(36, 'Court Road Gadhada', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(35, 'Hospital Circle Gadhada', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(34, 'Ambika Chowk Gadhada', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(33, 'Railway Crossing Gadhada', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(32, 'Bus Stand Gadhada', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(31, 'Swaminarayan Mandir Gate', NULL, 'Gadhada Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(30, 'Rajkot Road Ranpur', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(29, 'Market Yard Ranpur', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(28, 'Ramji Mandir Ranpur', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(27, 'Hospital Gate Ranpur', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(26, 'Court Chowk Ranpur', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(25, 'Shivaji Circle Ranpur', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(24, 'Ambedkar Nagar Ranpur', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(23, 'Ranpur Chowk Bazaar', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(22, 'Ranpur Railway Station', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(21, 'Ranpur Bus Depot', NULL, 'Ranpur Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(20, 'Barwala Talaja Road', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(19, 'Barwala GIDC Gate', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(18, 'Hospital Circle', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(17, 'Court Road Junction', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(16, 'Shiv Mandir Gate', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(15, 'Ambika Nagar Chowk', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(14, 'Barwala Market Yard', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(13, 'Taluka Panchayat Circle', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(12, 'Barwala Railway Crossing', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(11, 'Barwala Bus Stand', NULL, 'Barwala Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(10, 'Bhavnagar Road Gate', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(9, 'Ramdev Nagar Cross', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(8, 'Court Circle', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(7, 'Market Yard Entry', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(6, 'Ambedkar Circle', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(5, 'Hospital Chowk', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(4, 'College Road Junction', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(3, 'Railway Station Gate', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(2, 'Bus Stand Circle', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(1, 'Station Road Chowk', NULL, 'Botad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(53, 'Ambika Chowk Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(54, 'Hospital Circle Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(55, 'Court Road Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(56, 'Market Yard Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(57, 'Taluka Panchayat Chowk', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(58, 'Ramdev Nagar Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(59, 'Bhavnagar Road Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(60, 'Rajkot Road Paliyad', NULL, 'Paliyad Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(61, 'Botad Rural Bus Stand', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(62, 'Botad Rural Railway Crossing', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(63, 'Ambika Chowk Rural', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(64, 'Hospital Circle Rural', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(65, 'Court Road Rural', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(66, 'Market Yard Rural', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(67, 'Taluka Panchayat Rural', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(68, 'Ramdev Nagar Rural', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(69, 'Bhavnagar Road Rural', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(70, 'Rajkot Road Rural', NULL, 'Botad Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(71, 'Bus Stand Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(72, 'Railway Crossing Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(73, 'Ambika Chowk Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(74, 'Hospital Circle Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(75, 'Court Road Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(76, 'Market Yard Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(77, 'Taluka Panchayat Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(78, 'Ramdev Nagar Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(79, 'Bhavnagar Road Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(80, 'Rajkot Road Gadhada Rural', NULL, 'Gadhada Rural Police Station', '2026-07-09 19:05:54', '2026-07-09 19:05:54'),
(81, 'ertyui', 'ertfyhuji', 'sedfghj', '2026-07-17 05:57:50', '2026-07-17 05:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '0000_00_00_000000_create_user_types_table', 1),
(17, '0001_01_01_000000_create_users_table', 1),
(18, '0001_01_01_000001_create_cache_table', 1),
(19, '0001_01_01_000002_create_jobs_table', 1),
(20, '2026_07_06_081532_add_profile_fields_to_users_table', 2),
(21, '2026_07_06_091431_create_checking_points_table', 3),
(22, '2026_07_06_091431_create_vehicle_checks_table', 3),
(23, '2026_07_09_185222_add_police_station_to_checking_points_table', 4),
(24, '2026_07_09_191759_alter_shift_type_in_vehicle_checks_table', 5),
(25, '2026_07_09_200406_add_duty_time_to_users_table', 6),
(26, '2026_07_14_023805_change_duty_time_to_start_end_in_users_table', 7),
(27, '2026_07_17_112549_add_incharge_name_to_checking_points_table', 8),
(28, '2026_07_17_114758_add_roster_name_to_users_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roster_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` bigint UNSIGNED NOT NULL DEFAULT '2',
  `employee_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policestation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assigned_shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_checking_point_id` bigint UNSIGNED DEFAULT NULL,
  `duty_start_time` time DEFAULT NULL,
  `duty_end_time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_type_id_foreign` (`user_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `roster_name`, `email`, `profile_photo`, `dob`, `email_verified_at`, `password`, `user_type_id`, `employee_id`, `policestation`, `mobile_no`, `is_active`, `remember_token`, `created_at`, `updated_at`, `assigned_shift`, `assigned_checking_point_id`, `duty_start_time`, `duty_end_time`) VALUES
(1, 'Super Admin', NULL, 'admin@drivecheck.com', NULL, NULL, NULL, '$2y$12$ZDHq3pqwbdf4H.0FmXPVgeS6ON/wswrIhGV13ANgBpuq/jDQZu9/m', 1, NULL, NULL, NULL, 1, NULL, '2026-07-04 07:44:47', '2026-07-04 07:44:47', NULL, NULL, NULL, NULL),
(2, 'okokokoko', NULL, 'employee@drivecheck.com', NULL, NULL, NULL, '$2y$12$ONWIVMhX3ABCGLHjA1F2B.n28eVMXXZKiE60vsmoOIr68VQ00KKJ6', 2, 'EMP001', 'Botad HQ', '1234567898', 0, NULL, '2026-07-04 07:44:47', '2026-07-17 06:15:26', 'Morning', 69, '12:00:00', '11:50:00'),
(3, 'Admin', NULL, 'admin123@gmail.com', 'profile_photos/4of1hUGaH2uJIc80VtbYK6Tf98nyVA97h5d2y88C.jpg', NULL, NULL, '$2y$12$4Wk80yuIT2XkPq8GIYrLE.iL1APswcrEOp1HQD9ZUYu2ZFrtwIZTy', 1, 'Admin123', 'qwerty', '1234567890', 1, NULL, '2026-07-06 02:21:14', '2026-07-06 03:34:48', NULL, NULL, NULL, NULL),
(4, 'Employee1212', 'qwerty123', 'employee123@gmail.com', 'profile_photos/5xmufglRfC85bJKnMr2ojFbtGozx8cl4M1Pf6EEd.jpg', '2026-07-16', NULL, '$2y$12$3X7wUqEWdkvBm/0S0l9DtObgQIKy.jSdD757bMvoLzASgoAGT.dri', 2, 'Employee3636363', 'Botad', '1234567897', 1, NULL, '2026-07-06 02:24:09', '2026-07-17 06:22:36', 'Morning', 37, '12:00:00', '14:15:00'),
(6, 'ewrtfyui', NULL, 'sedfghjk@gmail.com', NULL, NULL, NULL, '$2y$12$S0cr8gkrQ/JzkVp3V.J4..T3/dWHASFD1953ZqhmHgsYYIwANUxY.', 2, 'wertyu', 'sedfghjk', '3456789876', 1, NULL, '2026-07-06 03:27:22', '2026-07-17 06:31:50', 'Night', 37, '00:00:00', '12:00:00'),
(7, 'newwwwwww', NULL, 'newwwwwww@gmail.com', NULL, NULL, NULL, '$2y$12$jlo38x/HAIZVOsCB.JvtDedPT7nV1ZE/8GVFfOOmt9Dh2vgOU1DwS', 2, 'newwwwwww', 'awsdfghjkl', '1234567823', 1, NULL, '2026-07-06 03:29:43', '2026-07-06 03:29:57', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2026-07-04 07:44:47', '2026-07-04 07:44:47'),
(2, 'Employee', '2026-07-04 07:44:47', '2026-07-04 07:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_checks`
--

DROP TABLE IF EXISTS `vehicle_checks`;
CREATE TABLE IF NOT EXISTS `vehicle_checks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `checking_point_id` bigint UNSIGNED NOT NULL,
  `person_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_date` date NOT NULL,
  `shift_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checking_time` time NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_checks_user_id_foreign` (`user_id`),
  KEY `vehicle_checks_checking_point_id_foreign` (`checking_point_id`)
) ENGINE=MyISAM AUTO_INCREMENT=277 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_checks`
--

INSERT INTO `vehicle_checks` (`id`, `user_id`, `checking_point_id`, `person_name`, `shift_date`, `shift_type`, `vehicle_no`, `employee_id_no`, `vehicle_photo`, `checking_time`, `remark`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 'swasdfghjk', '2026-07-06', 'Night', '123456789', '45678', 'vehicle_photos/Zp8EjdvF8uCFqEs4wQkYF96RO6KdXCrtRfbJZvLe.jpg', '02:56:00', 'gbfdsxdfghjk', '2026-07-06 03:57:04', '2026-07-06 04:01:27'),
(2, 4, 4, 'dsfghjnm', '2026-07-06', 'Night', 'dfghjkl4567', 'ertyuio', 'vehicle_photos/ntcQ6gkgYvSAvO8XhXwFSgfntYFBh5MurmpMDmwy.jpg', '15:17:00', NULL, '2026-07-06 04:17:59', '2026-07-06 04:42:35'),
(3, 4, 1, 'Frida Daugherty', '2026-01-12', 'Night', 'GJ-UF-1431', 'EMP-4469', NULL, '17:47:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(4, 2, 1, 'Rodrick Erdman', '2026-01-05', 'Night', 'GJ-YK-9791', 'EMP-1640', NULL, '11:34:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(5, 4, 3, 'Dayana Oberbrunner', '2025-09-27', 'Night', 'GJ-NC-0398', 'EMP-1063', 'vehicle_photos/c3Ln9EQMSHldOxUdDL7HT1mjS2Lyhzulu0xGiuHv.jpg', '06:17:00', 'vahiacl img', '2026-07-06 04:30:19', '2026-07-17 05:47:40'),
(6, 2, 5, 'Mr. Abe Luettgen', '2025-07-24', 'Night', 'GJ-VY-6150', 'EMP-4705', NULL, '14:32:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(7, 2, 1, 'Jaylin Koelpin MD', '2025-09-21', 'Morning', 'GJ-MQ-5928', 'EMP-5352', NULL, '05:21:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(8, 4, 3, 'Elenora Waelchi', '2025-08-24', 'Morning', 'GJ-DV-9865', 'EMP-4018', NULL, '05:41:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(9, 2, 3, 'Elenor Kautzer', '2025-12-11', 'Night', 'GJ-BQ-4344', NULL, NULL, '10:57:00', 'Aliquam perspiciatis ratione eaque ea odio quas.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(10, 6, 5, 'Sabina Stroman', '2025-09-13', 'Morning', 'GJ-WD-6944', 'EMP-3706', NULL, '14:25:00', 'Ea aut tempore et pariatur aut quas et odit.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(11, 7, 4, 'Brendan Beahan MD', '2026-02-25', 'Morning', 'GJ-MB-6104', NULL, NULL, '03:40:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(12, 2, 1, 'Dr. Kristian Gislason', '2026-06-27', 'Morning', 'GJ-DA-8500', 'EMP-1817', NULL, '22:16:00', 'Rerum possimus sequi ipsum ut.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(13, 2, 4, 'Ms. Chanel Williamson DDS', '2026-04-04', 'Night', 'GJ-JI-9653', NULL, NULL, '09:56:00', 'Enim tempore quae optio quia adipisci sit asperiores.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(14, 6, 4, 'Aleen Bernhard', '2026-04-14', 'Night', 'GJ-BZ-9695', NULL, NULL, '13:46:00', 'Consequuntur deleniti quod asperiores illo eveniet ipsa earum culpa.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(15, 7, 1, 'Dr. Sadye Becker I', '2026-06-20', 'Night', 'GJ-AV-0313', NULL, NULL, '23:27:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(16, 4, 4, 'Aileen Kessler PhD', '2025-07-17', 'Morning', 'GJ-ZL-4644', 'EMP-7437', 'vehicle_photos/aSEJFo6U5ad2NFT7PLOzQgHLGqzU6ZChzOUsPdTx.png', '13:10:00', 'Nostrum vitae velit voluptates harum.', '2026-07-06 04:30:19', '2026-07-17 04:53:58'),
(17, 7, 1, 'Dr. Francisca Durgan Jr.', '2025-09-05', 'Night', 'GJ-MO-8872', 'EMP-4118', NULL, '20:30:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(18, 6, 4, 'Dane Thompson Sr.', '2026-07-06', 'Morning', 'GJ-HG-0301', 'EMP-8779', NULL, '09:16:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(19, 2, 3, 'Dave Pfeffer IV', '2026-06-28', 'Morning', 'GJ-MV-8716', 'EMP-5150', NULL, '17:29:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(20, 2, 5, 'Shea Labadie', '2025-11-02', 'Night', 'GJ-WA-8035', 'EMP-8424', NULL, '18:08:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(21, 4, 5, 'Hanna Schowalter', '2026-05-22', 'Morning', 'GJ-TL-2937', 'EMP-1812', NULL, '06:56:00', 'Distinctio praesentium ex quae qui ut quibusdam dolor molestiae.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(22, 4, 5, 'Lura Jacobs', '2026-04-17', 'Morning', 'GJ-EJ-2680', NULL, NULL, '01:05:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(23, 2, 4, 'Ardella Towne', '2026-06-02', 'Night', 'GJ-DD-3932', NULL, NULL, '08:41:00', 'Eum in ad rerum.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(24, 7, 1, 'Shemar Mayer', '2026-03-12', 'Night', 'GJ-IZ-4116', 'EMP-4533', NULL, '20:42:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(25, 6, 5, 'Clair White', '2026-06-26', 'Morning', 'GJ-ZS-7078', NULL, NULL, '13:54:00', 'Nam qui nesciunt quo odio provident expedita ad.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(26, 4, 3, 'Dr. Wilhelm White DDS', '2026-05-22', 'Night', 'GJ-EX-2830', NULL, NULL, '23:50:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(27, 4, 3, 'Shany Altenwerth', '2025-09-25', 'Night', 'GJ-ZA-1633', 'EMP-9150', NULL, '04:45:00', 'Necessitatibus temporibus rerum quis a assumenda id.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(28, 7, 5, 'Tremayne Tremblay', '2025-11-15', 'Morning', 'GJ-FN-1986', 'EMP-3289', NULL, '09:57:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(29, 2, 4, 'Dayna Mills MD', '2026-04-01', 'Morning', 'GJ-UV-8444', 'EMP-0873', NULL, '07:28:00', 'Repudiandae odio voluptatem aliquid nostrum iure vero.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(30, 7, 3, 'Jalyn Maggio', '2025-09-17', 'Morning', 'GJ-NC-1296', NULL, NULL, '23:23:00', 'Voluptatibus a libero maxime qui eligendi eaque.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(31, 2, 1, 'Pasquale Sporer', '2026-05-08', 'Night', 'GJ-PK-9055', 'EMP-8496', NULL, '20:23:00', 'Voluptatibus quam modi quis voluptates.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(32, 6, 5, 'Catherine Gottlieb', '2026-03-31', 'Night', 'GJ-UB-0728', NULL, NULL, '22:40:00', 'Nihil consequuntur consequuntur officiis inventore architecto.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(33, 7, 1, 'Maymie Schimmel', '2025-07-21', 'Night', 'GJ-RO-9391', NULL, NULL, '09:59:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(34, 4, 1, 'Eriberto Lynch', '2026-03-29', 'Morning', 'GJ-TN-3801', NULL, NULL, '03:22:00', 'Veniam nisi at officiis cumque est aut.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(35, 7, 5, 'Prof. Clifford Roberts', '2026-06-06', 'Morning', 'GJ-QY-7532', 'EMP-7972', NULL, '15:24:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(36, 7, 1, 'Prof. Adonis Hauck II', '2026-02-13', 'Morning', 'GJ-JN-0581', NULL, NULL, '13:19:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(37, 2, 3, 'Candida Price', '2026-01-21', 'Night', 'GJ-OU-4872', 'EMP-3065', NULL, '02:00:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(38, 7, 1, 'Dr. Antwan Kirlin', '2025-07-25', 'Night', 'GJ-MQ-3027', NULL, NULL, '23:54:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(39, 4, 1, 'Frank Thompson DVM', '2026-04-30', 'Night', 'GJ-JE-6141', NULL, NULL, '17:32:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(40, 2, 5, 'Mr. Orlo Funk DDS', '2026-06-01', 'Night', 'GJ-JX-6235', 'EMP-3879', NULL, '17:03:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(41, 2, 5, 'Nicholaus Veum', '2025-09-13', 'Morning', 'GJ-AC-5195', 'EMP-8994', NULL, '10:00:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(42, 4, 5, 'Rusty Haley DVM', '2026-01-04', 'Night', 'GJ-HS-4457', 'EMP-0673', NULL, '12:11:00', 'Totam consectetur qui ducimus libero laborum neque voluptatem.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(43, 4, 5, 'Mrs. Annabelle Bernier', '2025-11-02', 'Night', 'GJ-AI-6860', 'EMP-5162', NULL, '11:58:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(44, 7, 5, 'Torrance Mayert', '2025-08-21', 'Morning', 'GJ-SF-1136', 'EMP-3671', NULL, '22:49:00', 'Nobis aspernatur omnis qui dolorem repellat.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(45, 2, 1, 'Ms. Karen Zemlak II', '2026-06-03', 'Morning', 'GJ-PI-8897', NULL, NULL, '11:38:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(46, 7, 4, 'Gus Kihn PhD', '2026-03-14', 'Morning', 'GJ-GY-1619', NULL, NULL, '11:14:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(47, 6, 1, 'Dangelo Dicki V', '2026-04-30', 'Night', 'GJ-ME-2883', NULL, NULL, '07:41:00', 'Id voluptatum dolorem recusandae aut labore iste.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(48, 6, 1, 'Dorcas Doyle', '2025-08-23', 'Night', 'GJ-HS-9293', 'EMP-0839', NULL, '10:55:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(49, 2, 1, 'Beth Lockman', '2026-06-08', 'Morning', 'GJ-NN-6320', 'EMP-2318', NULL, '04:20:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(50, 2, 3, 'Christiana Krajcik', '2026-03-24', 'Night', 'GJ-YU-1503', 'EMP-4177', NULL, '07:39:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(51, 7, 3, 'Ms. Victoria Nolan IV', '2025-07-12', 'Night', 'GJ-OA-5832', 'EMP-0883', NULL, '10:48:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(52, 7, 1, 'Giles Ryan PhD', '2026-04-24', 'Morning', 'GJ-UE-0459', 'EMP-0757', NULL, '14:47:00', 'Nisi recusandae facere sequi velit.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(53, 7, 5, 'Terence Franecki II', '2025-10-12', 'Night', 'GJ-QW-1741', NULL, NULL, '17:57:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(54, 4, 1, 'Lauren Herman', '2025-09-17', 'Morning', 'GJ-SA-7746', NULL, NULL, '10:08:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(55, 4, 4, 'Jimmy Auer', '2026-03-06', 'Morning', 'GJ-HW-7697', 'EMP-6124', NULL, '07:36:00', 'Reiciendis rem illo sed veniam tempore aut incidunt.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(56, 4, 1, 'Dr. Lizeth Fahey', '2026-01-01', 'Morning', 'GJ-OU-6302', 'EMP-5055', NULL, '14:48:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(57, 4, 3, 'Miss Carmela Price', '2025-09-21', 'Night', 'GJ-OB-5168', 'EMP-3807', NULL, '17:55:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(58, 4, 1, 'Mrs. Sister Langosh III', '2026-03-27', 'Morning', 'GJ-VM-6813', 'EMP-0566', NULL, '00:52:00', 'Ut animi ipsam vero.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(59, 4, 4, 'Mina Runte Sr.', '2025-09-04', 'Morning', 'GJ-IZ-6060', 'EMP-5400', NULL, '04:08:00', 'Et qui id odio et iusto a ut ratione.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(60, 2, 3, 'Nicola Zboncak', '2026-06-09', 'Night', 'GJ-PV-0021', NULL, NULL, '08:33:00', 'Et a quis ad ipsam.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(61, 6, 1, 'Mr. Adelbert Boyle', '2025-08-21', 'Night', 'GJ-NP-7420', NULL, NULL, '11:48:00', 'Et quidem recusandae beatae modi laborum.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(275, 4, 13, 'qwerfghj', '2026-07-17', 'Morning', 'ertyui', 'ertyu', 'vehicle_photos/n1b3X9cZmohKlJUBFSn1sQ6QXHcotaDnRN9THqdj.jpg', '15:52:00', NULL, '2026-07-17 04:53:11', '2026-07-17 04:53:11'),
(63, 2, 5, 'Mable Schuster DVM', '2025-09-16', 'Night', 'GJ-FT-9520', NULL, NULL, '19:09:00', 'Soluta rerum quo dolorem provident.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(64, 2, 1, 'Hayden Aufderhar', '2025-12-03', 'Night', 'GJ-GR-9883', NULL, NULL, '17:00:00', 'Minus et distinctio omnis cumque.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(65, 6, 1, 'Prof. Joan Hilpert IV', '2026-03-10', 'Morning', 'GJ-GF-7502', 'EMP-3026', NULL, '18:26:00', 'Nesciunt consequuntur ut dolor et unde.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(66, 6, 3, 'Dr. Reagan Reilly Jr.', '2026-01-31', 'Night', 'GJ-UH-2467', 'EMP-1285', NULL, '09:23:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(67, 2, 3, 'Mollie Schmitt', '2025-09-07', 'Morning', 'GJ-SC-3675', NULL, NULL, '04:12:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(68, 7, 1, 'Nash Wolf', '2026-02-01', 'Night', 'GJ-DJ-2208', 'EMP-7461', NULL, '22:23:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(69, 7, 5, 'Davonte Franecki V', '2025-11-19', 'Night', 'GJ-CI-6212', 'EMP-2188', NULL, '16:51:00', 'In ab ratione consectetur assumenda eos.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(70, 2, 4, 'Lempi Glover', '2026-02-24', 'Morning', 'GJ-AL-8472', 'EMP-7803', NULL, '21:58:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(71, 4, 4, 'Claude Schoen', '2025-07-22', 'Morning', 'GJ-PV-9543', 'EMP-2314', NULL, '00:17:00', 'Placeat unde placeat nesciunt eos iure eius.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(72, 4, 3, 'Edythe Bernhard IV', '2026-06-26', 'Night', 'GJ-AY-4103', NULL, NULL, '05:48:00', 'In ut consequatur quia quia.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(73, 7, 4, 'Lou Rohan', '2026-03-18', 'Night', 'GJ-UV-8424', 'EMP-6080', NULL, '06:41:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(74, 6, 3, 'Meda Considine', '2025-08-01', 'Morning', 'GJ-DH-2520', NULL, NULL, '03:13:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(75, 7, 5, 'Dakota Bahringer Jr.', '2025-12-28', 'Morning', 'GJ-NP-1668', 'EMP-1673', NULL, '04:36:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(76, 4, 1, 'Janessa Morissette II', '2025-09-03', 'Morning', 'GJ-TG-9480', NULL, NULL, '03:00:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(77, 7, 4, 'Prof. Filiberto Turcotte', '2025-10-07', 'Morning', 'GJ-OA-6807', 'EMP-8652', NULL, '00:54:00', 'Odit nostrum ut necessitatibus animi eaque suscipit fugiat qui.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(78, 4, 4, 'Dr. Alex Fadel', '2026-03-29', 'Morning', 'GJ-SG-8336', 'EMP-3054', NULL, '13:38:00', 'Mollitia eos consequatur et veritatis voluptatem et omnis.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(79, 7, 3, 'Josefina Davis', '2025-11-23', 'Morning', 'GJ-YK-0111', 'EMP-4029', NULL, '15:33:00', 'Aut ad eveniet mollitia sint deleniti.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(80, 6, 4, 'Mrs. Clemmie Stokes', '2026-02-06', 'Night', 'GJ-QO-7578', NULL, NULL, '04:43:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(81, 6, 1, 'Nathanial Ward II', '2025-09-17', 'Night', 'GJ-MU-8488', NULL, NULL, '13:11:00', 'Aut fugit modi ex illum.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(82, 7, 1, 'Estella Daniel', '2026-04-20', 'Morning', 'GJ-EK-8116', NULL, NULL, '10:13:00', 'Modi culpa aliquam aut odit nihil reprehenderit.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(83, 7, 1, 'Dr. Rey Boehm IV', '2025-12-20', 'Morning', 'GJ-UE-8155', NULL, NULL, '12:56:00', 'Minima dolorem id consequatur voluptates et inventore facilis.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(84, 2, 4, 'Marco Pouros', '2025-08-10', 'Morning', 'GJ-FI-4512', NULL, NULL, '14:28:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(85, 7, 3, 'Jacinto Kautzer', '2025-07-20', 'Night', 'GJ-RB-7966', NULL, NULL, '03:27:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(86, 7, 5, 'Nya Ernser', '2026-06-11', 'Night', 'GJ-JM-3818', NULL, NULL, '22:11:00', 'Saepe nemo delectus omnis quo aliquid provident.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(87, 6, 3, 'Prof. Roma Zulauf', '2025-07-23', 'Night', 'GJ-QX-0652', 'EMP-9246', NULL, '05:13:00', 'Quod illum numquam perspiciatis ea exercitationem fugiat debitis aspernatur.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(88, 4, 3, 'Mr. Quinten Nolan DVM', '2025-12-10', 'Morning', 'GJ-PJ-3812', 'EMP-4143', NULL, '06:25:00', 'Reprehenderit veniam qui quia et ut.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(89, 7, 1, 'Prof. Jeanie Mraz Jr.', '2026-04-12', 'Night', 'GJ-ZK-9901', 'EMP-8829', NULL, '23:14:00', 'Qui mollitia quia est.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(90, 4, 5, 'Sven Boyer MD', '2025-09-02', 'Night', 'GJ-EI-8832', NULL, NULL, '01:43:00', 'Illo ex expedita esse voluptatem voluptas.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(91, 7, 5, 'Ines Hill', '2025-07-08', 'Night', 'GJ-OK-0974', 'EMP-0415', NULL, '15:33:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(92, 7, 3, 'Miss Lavonne Von IV', '2025-12-08', 'Night', 'GJ-YY-5940', NULL, NULL, '01:27:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(93, 2, 4, 'Vernie Sipes', '2025-07-08', 'Night', 'GJ-FJ-3590', NULL, NULL, '21:56:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(94, 6, 4, 'Miss Tressie Glover Jr.', '2026-04-23', 'Morning', 'GJ-TA-7020', NULL, NULL, '05:18:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(95, 2, 1, 'Kennith Abernathy', '2026-01-06', 'Night', 'GJ-DA-3404', NULL, NULL, '07:52:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(96, 6, 3, 'Willard Mann', '2026-02-07', 'Night', 'GJ-SV-7334', 'EMP-9312', NULL, '10:03:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(97, 6, 4, 'Emma Terry', '2025-12-20', 'Night', 'GJ-FV-1873', NULL, NULL, '16:25:00', 'Quia ea ea id et.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(98, 2, 3, 'Fred Beahan', '2025-09-25', 'Morning', 'GJ-JW-4645', 'EMP-1588', NULL, '02:39:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(99, 2, 5, 'Mabel Gutkowski', '2025-09-30', 'Night', 'GJ-HX-7596', NULL, NULL, '23:52:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(100, 6, 5, 'Giovani Lueilwitz', '2026-02-15', 'Night', 'GJ-YO-3984', 'EMP-4031', NULL, '01:13:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(101, 4, 1, 'Dr. Tianna Lubowitz', '2026-01-08', 'Morning', 'GJ-TM-8682', NULL, NULL, '19:08:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(102, 6, 5, 'Ola Lesch', '2025-11-13', 'Night', 'GJ-TB-5689', NULL, NULL, '22:07:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(103, 6, 5, 'Michaela Grant', '2026-01-06', 'Night', 'GJ-YU-4369', NULL, NULL, '05:00:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(104, 2, 4, 'Nathaniel Berge V', '2025-07-12', 'Morning', 'GJ-OY-4188', 'EMP-8392', NULL, '08:56:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(105, 2, 3, 'Dr. Duncan Zulauf', '2025-08-29', 'Night', 'GJ-VG-1629', 'EMP-2450', NULL, '12:56:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(106, 4, 5, 'Merle Dietrich', '2025-08-18', 'Morning', 'GJ-QY-7099', 'EMP-5949', NULL, '10:12:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(107, 2, 1, 'Elody Harvey', '2025-11-21', 'Night', 'GJ-ZV-3712', 'EMP-1047', NULL, '17:16:00', 'Dignissimos nobis reprehenderit eligendi possimus.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(108, 2, 5, 'Ms. Piper Schuster', '2025-10-15', 'Morning', 'GJ-GE-2481', NULL, NULL, '04:21:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(109, 4, 1, 'Keegan Cormier', '2026-04-10', 'Morning', 'GJ-PP-9772', 'EMP-7119', NULL, '18:35:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(110, 2, 5, 'Jovan Ebert V', '2026-06-03', 'Morning', 'GJ-KB-4726', NULL, NULL, '16:03:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(111, 2, 4, 'Dr. Vaughn Keeling II', '2026-03-17', 'Morning', 'GJ-RF-8322', 'EMP-4537', NULL, '15:55:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(112, 4, 5, 'Howell Lubowitz', '2025-07-26', 'Morning', 'GJ-ML-4856', 'EMP-4968', NULL, '15:36:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(113, 2, 1, 'Fiona Gaylord', '2025-09-20', 'Night', 'GJ-MZ-1915', 'EMP-4239', NULL, '04:03:00', 'Consequuntur enim eos ut nihil.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(114, 2, 5, 'Godfrey Moen', '2026-07-02', 'Morning', 'GJ-XZ-5582', 'EMP-9468', NULL, '04:10:00', 'Fuga voluptatum accusamus tenetur dolores.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(115, 4, 5, 'Greta Keeling', '2026-04-22', 'Morning', 'GJ-IX-8724', 'EMP-9056', NULL, '10:53:00', 'Vel quod commodi veniam vitae similique distinctio.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(116, 4, 1, 'Laurel Mitchell Jr.', '2026-05-06', 'Night', 'GJ-ZV-8122', 'EMP-1591', NULL, '19:07:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(117, 7, 3, 'Dee Lang MD', '2026-07-03', 'Night', 'GJ-XT-1915', 'EMP-1893', NULL, '20:31:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(118, 2, 4, 'Ethelyn Lebsack', '2026-03-23', 'Night', 'GJ-RA-3719', 'EMP-6947', NULL, '00:08:00', 'Porro officia id corrupti facere rerum eos consequatur.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(119, 6, 5, 'Dr. Kole Sauer', '2025-12-11', 'Morning', 'GJ-QY-0540', 'EMP-7322', NULL, '16:27:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(120, 2, 5, 'Mr. Ted Schulist Sr.', '2026-04-23', 'Morning', 'GJ-HD-1016', 'EMP-6956', NULL, '20:39:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(121, 2, 4, 'Dr. Judge Nicolas', '2026-02-17', 'Morning', 'GJ-XB-0919', 'EMP-5944', NULL, '14:28:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(122, 7, 5, 'Melyssa Haag', '2026-03-23', 'Morning', 'GJ-US-7178', 'EMP-9861', NULL, '23:39:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(123, 4, 1, 'Prof. Lemuel Roberts MD', '2025-08-03', 'Night', 'GJ-BS-5097', 'EMP-2936', NULL, '16:20:00', 'Expedita mollitia et fugiat fuga.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(124, 4, 1, 'Kathlyn Welch', '2026-02-23', 'Morning', 'GJ-WM-1078', NULL, NULL, '18:12:00', 'Quidem est voluptatem rerum magnam asperiores ducimus.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(125, 6, 4, 'Abigayle Heaney', '2025-07-11', 'Morning', 'GJ-DT-0871', 'EMP-7366', NULL, '13:35:00', 'Tempore atque earum facilis aut et saepe.bhnm', '2026-07-06 04:30:19', '2026-07-13 02:46:10'),
(126, 7, 5, 'Bruce Deckow Jr.', '2025-12-25', 'Morning', 'GJ-WE-9164', NULL, NULL, '00:37:00', 'Similique ratione voluptatem et sapiente non aperiam.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(127, 4, 1, 'Elvera Paucek', '2025-12-16', 'Night', 'GJ-IC-9266', 'EMP-2387', NULL, '23:36:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(128, 4, 5, 'Miss Karianne Turcotte', '2026-05-20', 'Morning', 'GJ-EG-1560', NULL, NULL, '23:44:00', 'Nihil accusamus optio ratione odit reiciendis enim voluptatibus.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(129, 4, 4, 'Shayne Mohr', '2025-12-10', 'Night', 'GJ-AA-5830', 'EMP-6637', NULL, '08:47:00', 'Nobis id illo nihil provident.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(130, 6, 1, 'Rahsaan Ritchie', '2025-11-05', 'Night', 'GJ-DW-6720', 'EMP-9835', NULL, '19:00:00', 'Minus commodi quia ut quas.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(131, 6, 4, 'Sandra Eichmann', '2025-07-25', 'Night', 'GJ-BK-2932', 'EMP-6887', NULL, '18:35:00', 'Dolorum quis illum fugit et consequatur optio expedita quasi.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(132, 2, 5, 'Dudley Fritsch', '2026-03-28', 'Morning', 'GJ-UV-4382', 'EMP-9281', NULL, '19:40:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(133, 7, 5, 'Peyton Weber', '2026-05-13', 'Night', 'GJ-SI-2841', NULL, NULL, '01:18:00', 'Saepe beatae dolor quisquam aliquam beatae.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(134, 2, 4, 'Brionna Stiedemann', '2025-08-10', 'Night', 'GJ-ZV-3655', 'EMP-3532', NULL, '15:22:00', 'Quia est officia ut iusto amet.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(136, 4, 3, 'Ted Wiegand', '2025-07-29', 'Night', 'GJ-HY-3979', 'EMP-0474', NULL, '07:50:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(137, 4, 3, 'Wade Rutherford', '2025-11-30', 'Morning', 'GJ-LW-8886', 'EMP-5240', NULL, '05:44:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(138, 6, 4, 'Miss Tatyana Heller DDS', '2025-09-14', 'Night', 'GJ-GJ-0464', 'EMP-9420', NULL, '07:04:00', 'Et blanditiis voluptas nostrum.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(139, 6, 1, 'Johnathon Kertzmann', '2026-02-25', 'Night', 'GJ-YG-9091', 'EMP-4071', NULL, '16:24:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(140, 6, 3, 'Miss Isobel Shanahan III', '2026-03-18', 'Night', 'GJ-UK-2434', 'EMP-3724', NULL, '20:29:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(141, 6, 1, 'Sophie Beier', '2026-04-27', 'Night', 'GJ-QW-7075', 'EMP-4655', NULL, '07:19:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(142, 6, 5, 'Ms. Susana Bins V', '2026-06-26', 'Morning', 'GJ-UX-2586', 'EMP-8075', NULL, '16:38:00', 'Eligendi voluptatem voluptas voluptatem sit ut commodi quis.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(143, 7, 3, 'Benton Erdman DVM', '2025-08-31', 'Night', 'GJ-IT-0980', NULL, NULL, '12:24:00', 'Eaque sint sed atque tempore temporibus aut est ratione.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(144, 4, 3, 'Mrs. Amaya Turcotte', '2026-03-27', 'Morning', 'GJ-HI-4870', NULL, NULL, '22:32:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(145, 7, 4, 'Dr. Lenora Schiller', '2026-01-24', 'Morning', 'GJ-UL-8483', 'EMP-5411', NULL, '02:58:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(146, 6, 5, 'Mr. Bennie Bernier', '2025-10-30', 'Morning', 'GJ-LZ-5040', 'EMP-6227', NULL, '19:26:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(147, 6, 1, 'Lexie Larson', '2025-08-21', 'Night', 'GJ-KA-4330', NULL, NULL, '14:22:00', 'Et quas voluptatum sint magni.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(148, 7, 1, 'Sallie Jerde I', '2025-08-14', 'Morning', 'GJ-VR-9393', 'EMP-8526', NULL, '07:14:00', 'Quia neque eius excepturi earum esse.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(149, 6, 1, 'Kitty Leffler', '2025-08-08', 'Night', 'GJ-RX-3506', 'EMP-3540', NULL, '14:34:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(150, 4, 3, 'Presley Hauck', '2026-03-11', 'Morning', 'GJ-QS-5294', 'EMP-2764', NULL, '20:45:00', 'Et et voluptatem est provident.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(151, 4, 1, 'Josie Sauer', '2025-11-27', 'Night', 'GJ-YW-1426', 'EMP-1427', NULL, '15:35:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(152, 2, 4, 'Wyman Kovacek', '2026-01-19', 'Morning', 'GJ-ZV-6141', 'EMP-8843', NULL, '20:58:00', 'Facilis placeat quod doloremque deserunt.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(153, 6, 4, 'Maudie Will', '2026-01-22', 'Night', 'GJ-LL-2331', 'EMP-5975', NULL, '06:06:00', 'Molestiae non ad laborum quia dolor rem quidem ratione.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(154, 2, 4, 'Jayce Effertz', '2026-02-02', 'Night', 'GJ-EI-5127', NULL, NULL, '15:15:00', 'Dolorum qui consequatur incidunt error eaque voluptatem quo.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(155, 2, 1, 'Prof. Rodrick Pollich Jr.', '2025-09-24', 'Morning', 'GJ-IK-8686', 'EMP-1867', NULL, '01:43:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(156, 2, 5, 'Mrs. Mellie Schimmel DVM', '2025-11-18', 'Morning', 'GJ-IS-0795', 'EMP-3390', NULL, '17:39:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(157, 2, 5, 'Prof. Salvador Klein V', '2025-11-06', 'Night', 'GJ-AT-3154', 'EMP-2107', NULL, '09:21:00', 'Animi est rerum aliquam et.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(158, 2, 5, 'Dr. Maurine Reichert Jr.', '2026-03-20', 'Morning', 'GJ-MN-7008', NULL, NULL, '05:45:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(159, 2, 4, 'Friedrich Kuvalis', '2025-08-29', 'Morning', 'GJ-AN-1064', 'EMP-9405', NULL, '20:59:00', 'Neque molestias debitis autem corporis ullam voluptate.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(160, 7, 5, 'Kristoffer Lubowitz IV', '2025-12-25', 'Morning', 'GJ-UC-7316', 'EMP-8960', NULL, '06:03:00', 'In itaque temporibus sunt odit dolores quas.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(161, 6, 3, 'Mrs. Concepcion Runolfsdottir DVM', '2025-12-02', 'Night', 'GJ-OZ-4106', 'EMP-5092', NULL, '07:20:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(162, 6, 4, 'Dave Weber', '2025-12-09', 'Morning', 'GJ-IV-0571', NULL, NULL, '00:28:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(163, 4, 4, 'Justina Durgan', '2026-03-10', 'Night', 'GJ-FH-5447', 'EMP-2046', NULL, '22:50:00', 'Quia voluptas tempora rerum error quod.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(164, 4, 1, 'Mr. Jeramy Lesch Jr.', '2026-05-08', 'Night', 'GJ-IF-9913', NULL, NULL, '16:08:00', 'Eligendi sit est aut.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(165, 4, 4, 'Miss Ayana Russel I', '2026-03-11', 'Night', 'GJ-LC-8665', 'EMP-1791', NULL, '03:44:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(166, 7, 1, 'Valerie Hamill', '2025-10-21', 'Night', 'GJ-EA-0552', NULL, NULL, '11:01:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(167, 2, 1, 'Miss Janiya Funk IV', '2026-01-12', 'Morning', 'GJ-ZK-8391', 'EMP-5358', NULL, '01:26:00', 'Reprehenderit consequatur soluta ut et cupiditate neque et.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(168, 7, 5, 'Gussie Lehner', '2026-02-05', 'Morning', 'GJ-PJ-2039', 'EMP-0344', NULL, '19:47:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(169, 4, 4, 'Dr. Carole Howell', '2026-06-28', 'Morning', 'GJ-UJ-5088', 'EMP-9821', NULL, '05:58:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(170, 2, 3, 'Kelton Stamm', '2025-09-07', 'Night', 'GJ-ZI-1612', 'EMP-9627', NULL, '08:27:00', 'Voluptas fugit totam placeat voluptatum in fugiat veniam.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(171, 2, 1, 'Prof. Ewell O\'Connell', '2026-04-01', 'Night', 'GJ-BU-1754', NULL, NULL, '16:50:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(172, 7, 4, 'Monserrat Larson V', '2025-09-11', 'Night', 'GJ-HI-8462', 'EMP-3816', NULL, '00:00:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(173, 2, 4, 'Marguerite Kozey', '2026-01-09', 'Morning', 'GJ-EN-7183', NULL, NULL, '07:20:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(174, 4, 4, 'Dr. Neha Murazik', '2026-03-28', 'Night', 'GJ-IN-1710', 'EMP-7725', NULL, '08:05:00', 'Eum fugit quo et nemo dolores dicta.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(175, 2, 1, 'Charley Bahringer', '2025-07-16', 'Night', 'GJ-HT-6631', 'EMP-7047', NULL, '08:43:00', 'Non enim deleniti non incidunt nostrum.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(176, 4, 3, 'Mr. Kennith Stanton I', '2025-10-17', 'Morning', 'GJ-VA-7247', NULL, NULL, '03:28:00', 'Nostrum aut ut doloribus ad quo rem.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(177, 2, 5, 'Miss Kelli Hintz II', '2026-03-25', 'Morning', 'GJ-WT-5341', 'EMP-2043', NULL, '01:43:00', 'Vero enim eligendi placeat voluptas similique eos.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(178, 7, 3, 'Terrill Schowalter', '2025-12-14', 'Morning', 'GJ-CI-2606', 'EMP-9541', NULL, '03:35:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(179, 7, 1, 'Darby Smith', '2026-07-03', 'Morning', 'GJ-BH-8848', NULL, NULL, '20:25:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(180, 4, 1, 'Joel Bahringer', '2025-07-17', 'Morning', 'GJ-AR-3389', 'EMP-4297', NULL, '16:57:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(181, 6, 5, 'Audrey Beatty', '2026-01-09', 'Night', 'GJ-OS-4141', 'EMP-3510', NULL, '07:38:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(182, 2, 3, 'Rosalind Corkery V', '2026-06-23', 'Night', 'GJ-YS-8467', 'EMP-5797', NULL, '14:03:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(183, 7, 3, 'Tremayne Roberts', '2025-12-08', 'Night', 'GJ-GD-7829', 'EMP-0733', NULL, '04:11:00', 'Delectus et exercitationem ipsam maxime.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(184, 7, 4, 'Ms. Yoshiko Terry', '2026-06-08', 'Night', 'GJ-GP-7286', 'EMP-4000', NULL, '01:50:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(185, 4, 5, 'Sigmund Jacobson', '2026-03-20', 'Morning', 'GJ-SC-3691', 'EMP-3360', NULL, '22:13:00', 'Pariatur cupiditate magni consectetur sequi recusandae dolores et.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(186, 6, 5, 'Mr. Jovani Kautzer', '2026-03-18', 'Night', 'GJ-LQ-1987', 'EMP-2468', NULL, '23:11:00', 'Dignissimos iste omnis iste.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(187, 4, 3, 'Fabiola Abshire', '2025-07-20', 'Night', 'GJ-VL-9893', 'EMP-6281', NULL, '21:00:00', 'Exercitationem quae molestiae quaerat ut recusandae vel.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(188, 2, 5, 'Mrs. Margaret Towne II', '2026-07-03', 'Night', 'GJ-MT-6896', NULL, NULL, '13:37:00', 'Voluptas ut molestias saepe officia magni maiores.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(189, 6, 1, 'Moses Carroll', '2026-03-10', 'Night', 'GJ-IY-3825', 'EMP-2896', NULL, '21:10:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(190, 6, 4, 'Alec Wilderman', '2025-08-23', 'Morning', 'GJ-TF-5340', NULL, NULL, '05:42:00', 'Labore dolores nesciunt consequatur eum porro dolorem.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(191, 2, 1, 'Dr. Brent Feeney MD', '2025-07-10', 'Morning', 'GJ-RH-9991', NULL, NULL, '01:02:00', 'Voluptatem ipsam aut quia temporibus.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(192, 7, 5, 'Della Olson MD', '2025-09-19', 'Morning', 'GJ-PU-0936', NULL, NULL, '06:15:00', 'Atque ullam distinctio sunt voluptas nihil harum soluta.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(193, 7, 3, 'Carlee Wolff', '2026-01-07', 'Night', 'GJ-OP-2620', 'EMP-5761', NULL, '21:39:00', 'Voluptates odit ea sint debitis omnis doloremque.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(194, 4, 4, 'Barbara Wilderman', '2026-03-02', 'Night', 'GJ-PZ-1577', NULL, NULL, '02:31:00', 'Ab facilis aspernatur aut animi.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(195, 6, 3, 'Naomie Walker', '2025-09-22', 'Night', 'GJ-LO-9435', NULL, NULL, '17:39:00', 'Maiores et consequuntur quo sed.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(196, 4, 1, 'Mr. Darius Harvey V', '2025-07-15', 'Night', 'GJ-LA-2347', 'EMP-3688', NULL, '04:08:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(197, 4, 3, 'Savanna Veum', '2025-09-21', 'Night', 'GJ-TR-9828', NULL, NULL, '15:26:00', 'Amet dolore dolores ut et consequatur voluptas aut sint.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(198, 7, 5, 'Hillard Abshire', '2025-08-24', 'Night', 'GJ-IU-3709', NULL, NULL, '14:42:00', 'Omnis repellat veritatis id expedita.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(199, 7, 3, 'Jailyn Dach', '2026-05-11', 'Night', 'GJ-IJ-5618', 'EMP-5215', NULL, '16:53:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(200, 7, 3, 'Kiera Zemlak', '2025-10-21', 'Night', 'GJ-JK-3666', 'EMP-8277', NULL, '16:16:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(201, 6, 5, 'Mr. Julius Adams', '2025-11-13', 'Night', 'GJ-ZM-1031', 'EMP-9558', NULL, '15:09:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(202, 7, 4, 'Beverly Schaden MD', '2026-03-20', 'Night', 'GJ-TJ-3759', 'EMP-2092', NULL, '00:12:00', 'Nihil quia nostrum quam voluptatibus incidunt voluptas rerum.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(204, 6, 4, 'Serenity Grimes', '2025-10-02', 'Night', 'GJ-IB-1421', 'EMP-3763', NULL, '11:41:00', 'Officia ipsa debitis sint temporibus.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(205, 4, 1, 'Eldred Powlowski IV', '2026-03-15', 'Night', 'GJ-RZ-7347', 'EMP-3359', NULL, '13:06:00', 'Aut quis cumque natus delectus voluptatum id.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(206, 2, 1, 'Maverick Krajcik', '2026-01-15', 'Morning', 'GJ-VE-8828', NULL, NULL, '04:06:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(207, 7, 4, 'Michale Howell II', '2026-03-28', 'Morning', 'GJ-QS-4450', NULL, NULL, '06:30:00', 'Tenetur aliquam qui dolorem consequatur est.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(208, 2, 1, 'Selena Hickle', '2026-02-04', 'Morning', 'GJ-IY-1840', 'EMP-6748', NULL, '11:31:00', 'Et excepturi sed nam maxime dolor accusamus ut.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(209, 7, 5, 'Alexandrine Bosco MD', '2025-10-10', 'Morning', 'GJ-SZ-0311', NULL, NULL, '15:46:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(210, 6, 3, 'Jameson Schoen', '2025-08-15', 'Morning', 'GJ-GZ-9902', NULL, NULL, '16:36:00', 'Et culpa sed deserunt ex et veritatis dolorem.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(211, 7, 4, 'Maeve Huels', '2026-05-14', 'Morning', 'GJ-PK-1167', 'EMP-4048', NULL, '21:10:00', 'Modi adipisci natus omnis.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(212, 2, 3, 'Mrs. Marlen Mante', '2026-04-04', 'Night', 'GJ-XU-9409', 'EMP-6159', NULL, '03:33:00', 'Eum nihil quae natus sed eum nam esse.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(213, 4, 1, 'Prof. Roderick Cormier', '2025-11-26', 'Night', 'GJ-QV-3912', 'EMP-8012', NULL, '05:19:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(214, 4, 1, 'Herta Hyatt Jr.', '2026-03-17', 'Night', 'GJ-BM-3679', 'EMP-8698', NULL, '03:41:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(215, 7, 4, 'Camden Heaney', '2025-08-15', 'Night', 'GJ-VA-5535', NULL, NULL, '00:48:00', 'Nisi voluptas eum repudiandae aut totam.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(216, 7, 3, 'Justine Halvorson', '2026-05-12', 'Morning', 'GJ-XL-2427', NULL, NULL, '04:25:00', 'Quaerat velit ut aut omnis porro.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(217, 7, 1, 'Quentin Boehm DVM', '2026-01-21', 'Morning', 'GJ-WQ-9923', 'EMP-5767', NULL, '07:36:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(218, 7, 1, 'Moises Rutherford', '2026-01-16', 'Morning', 'GJ-XC-2699', NULL, NULL, '01:11:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(219, 7, 5, 'Isaac Harvey', '2025-10-13', 'Morning', 'GJ-KT-9637', 'EMP-4582', NULL, '23:24:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(220, 6, 4, 'Reba Renner', '2025-10-31', 'Morning', 'GJ-YL-7195', NULL, NULL, '15:34:00', 'Autem dolore tempore quia in.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(221, 7, 4, 'Hailey Reilly', '2025-08-06', 'Morning', 'GJ-LG-6906', NULL, NULL, '19:26:00', 'Voluptate quam explicabo sed beatae vero.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(222, 6, 1, 'Reese Mertz', '2025-09-14', 'Night', 'GJ-NB-7180', NULL, NULL, '13:23:00', 'Sit consequatur aliquid unde eos cum consectetur.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(223, 4, 3, 'Adell Murray', '2026-04-06', 'Morning', 'GJ-QQ-9085', 'EMP-2725', NULL, '15:13:00', 'Temporibus sit at qui similique vel.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(224, 2, 3, 'Jeffrey Sauer', '2026-02-19', 'Night', 'GJ-RK-0306', 'EMP-6843', NULL, '20:29:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(225, 7, 3, 'Prof. Flo Feeney IV', '2025-09-16', 'Night', 'GJ-XC-9975', 'EMP-2675', NULL, '22:11:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(226, 2, 3, 'Kameron Streich', '2026-01-16', 'Morning', 'GJ-YH-5380', 'EMP-6950', NULL, '19:45:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(227, 2, 5, 'Mr. Marlon Lakin MD', '2025-12-28', 'Night', 'GJ-WM-3577', 'EMP-8548', NULL, '06:49:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(228, 7, 4, 'Dr. Linda Hills', '2026-05-24', 'Morning', 'GJ-SX-4964', 'EMP-9742', NULL, '20:35:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(229, 7, 4, 'Joseph Deckow MD', '2026-03-23', 'Night', 'GJ-SO-7681', 'EMP-0573', NULL, '16:44:00', 'Enim ducimus aspernatur qui.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(230, 2, 3, 'Monte Cummerata', '2025-07-24', 'Night', 'GJ-ML-0440', 'EMP-7751', NULL, '21:11:00', 'At id quas provident.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(231, 7, 5, 'Theresa Eichmann', '2025-08-05', 'Morning', 'GJ-JE-5785', 'EMP-3929', NULL, '18:31:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(232, 4, 1, 'Vinnie Runolfsson IV', '2026-04-22', 'Morning', 'GJ-SZ-3820', NULL, NULL, '06:03:00', 'Molestiae inventore laudantium sit minima ea est.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(233, 7, 3, 'Paxton Cummerata', '2026-06-27', 'Night', 'GJ-KP-8941', 'EMP-6907', NULL, '04:44:00', 'Voluptas vitae voluptas sunt perspiciatis in iure.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(234, 6, 1, 'Dr. Conor Heaney V', '2026-01-02', 'Night', 'GJ-OG-8030', 'EMP-8532', NULL, '09:53:00', 'Inventore facere id voluptatem perferendis placeat quis dicta.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(235, 6, 3, 'Jamir Walter DDS', '2025-09-25', 'Night', 'GJ-QM-1813', 'EMP-7795', NULL, '09:06:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(236, 4, 5, 'Sabryna Skiles', '2026-01-08', 'Morning', 'GJ-HM-6328', NULL, NULL, '19:13:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(237, 6, 5, 'Titus Gutkowski DDS', '2026-01-06', 'Night', 'GJ-IQ-4571', 'EMP-8489', NULL, '00:21:00', 'Rem quibusdam voluptatem necessitatibus ab recusandae.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(238, 6, 1, 'Freddie Johnston', '2026-05-17', 'Night', 'GJ-KJ-0416', 'EMP-2344', NULL, '06:53:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(239, 4, 5, 'Prof. Brenda Schinner', '2025-08-23', 'Night', 'GJ-VN-5752', 'EMP-0559', NULL, '03:36:00', 'Facere provident suscipit vel molestiae.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(240, 2, 1, 'Dillon Considine', '2025-12-16', 'Night', 'GJ-FH-1020', NULL, NULL, '11:59:00', 'Assumenda rerum sunt eligendi laudantium et.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(241, 7, 5, 'Lorenzo Hegmann V', '2025-08-25', 'Night', 'GJ-UI-5466', 'EMP-4198', NULL, '11:18:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(242, 4, 5, 'Burley Kertzmann', '2026-03-17', 'Morning', 'GJ-SJ-6146', 'EMP-4186', NULL, '02:30:00', 'Iusto ratione praesentium voluptas dolor.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(243, 6, 1, 'Mr. Dereck Toy', '2026-05-09', 'Night', 'GJ-JP-3108', 'EMP-7799', NULL, '01:36:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(244, 4, 5, 'Elena Skiles', '2025-12-24', 'Morning', 'GJ-JB-5322', 'EMP-9323', NULL, '14:30:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(245, 4, 3, 'Keyshawn Johns', '2026-02-10', 'Night', 'GJ-ZK-5275', 'EMP-4902', NULL, '00:42:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(246, 2, 3, 'Mrs. Jewell Gutkowski Jr.', '2025-07-15', 'Night', 'GJ-OF-3398', 'EMP-7354', NULL, '23:03:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(247, 7, 4, 'Prof. Alford Mosciski V', '2025-11-04', 'Night', 'GJ-TM-3594', 'EMP-2812', NULL, '19:38:00', 'Quaerat vel voluptatem illo magnam facere.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(248, 7, 5, 'Emilie Hoeger', '2025-07-11', 'Night', 'GJ-QA-2798', 'EMP-0563', NULL, '18:30:00', 'Ab nesciunt reprehenderit et voluptas ab.', '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(249, 2, 4, 'Mr. Jerrod Cronin IV', '2026-05-12', 'Morning', 'GJ-KT-1140', 'EMP-6240', NULL, '00:26:00', NULL, '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(250, 6, 5, 'Prof. Jesse Hill', '2025-08-27', 'Morning', 'GJ-FP-4527', 'EMP-3309', NULL, '10:10:00', 'Sed aut doloribus natus incidunt nulla.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(251, 7, 4, 'Neal Schuster', '2026-05-06', 'Morning', 'GJ-MY-5452', 'EMP-5973', NULL, '19:24:00', 'Recusandae qui sunt sed vitae est.', '2026-07-06 04:30:19', '2026-07-09 13:50:08'),
(252, 4, 3, 'Mrs. Leilani Renner PhD', '2025-08-05', 'Night', 'GJ-DD-1782', 'EMP-7991', NULL, '12:43:00', NULL, '2026-07-06 04:30:19', '2026-07-06 04:30:19'),
(253, 4, 4, 'fghjk,', '2026-07-08', 'Morning', '1234567ui', 'wsdfghj', 'vehicle_photos/3wvdHO3JsNUFZOMh8U5ENNbrju5Wwq6Wpovtjhxu.jpg', '16:30:00', 'sdfghjkl', '2026-07-08 05:31:15', '2026-07-09 13:50:08'),
(254, 4, 19, 'dsdfghjk', '2026-07-09', 'Night', '234567', 'dfghm', 'vehicle_photos/PjF7cLRUCDWtJga5e9LtQgj1dmFzhZtuiFjMrK2I.jpg', '06:07:00', NULL, '2026-07-09 14:04:07', '2026-07-09 14:04:07'),
(255, 4, 11, 'sedfghjn', '2026-07-13', 'Morning', '345678', 'sdfghj', 'vehicle_photos/UKsvVVDDce5WFgVgnVTUxBk0Jpeit56kbh1cdvIG.jpg', '13:54:00', NULL, '2026-07-13 02:55:05', '2026-07-13 02:55:05'),
(256, 2, 1, 'Sanjay Dabhi', '2026-07-14', 'Evening', 'GJ-33-AB-1234', 'DL-GJ33-001', NULL, '16:10:05', 'Routine check, all vehicle documents verified and clear.', '2026-07-14 10:40:05', '2026-07-14 10:40:05'),
(257, 2, 2, 'Ramesh Koli', '2026-07-14', 'Evening', 'GJ-33-XY-9876', 'AADHAR-8899', NULL, '16:25:30', 'Over speeding warning given. Driver instructed to slow down.', '2026-07-14 10:55:30', '2026-07-14 10:55:30'),
(258, 3, 3, 'Vijay Parmar', '2026-07-14', 'Evening', 'GJ-01-MN-4567', 'DL-GJ01-445', NULL, '16:40:15', 'Checked trunk luggage, nothing suspicious found.', '2026-07-14 11:10:15', '2026-07-14 11:10:15'),
(259, 3, 1, 'Amit Shah', '2026-07-14', 'Evening', 'GJ-33-PQ-1122', 'DL-GJ33-992', NULL, '17:05:44', 'Missing PUC certificate. E-Challan issued on the spot.', '2026-07-14 11:35:44', '2026-07-14 11:35:44'),
(260, 4, 4, 'Rakesh Gohil', '2026-07-14', 'Evening', 'GJ-33-LM-3344', 'PAN-ABCDE12', NULL, '17:22:10', 'No driving license available. Vehicle temporarily detained.', '2026-07-14 11:52:10', '2026-07-14 11:52:10'),
(261, 2, 2, 'Sunil Rathod', '2026-07-14', 'Evening', 'GJ-05-CR-7788', 'DL-GJ05-112', NULL, '17:45:00', 'Standard protocol check. All clear.', '2026-07-14 12:15:00', '2026-07-14 12:15:00'),
(262, 4, 1, 'Mahesh Makwana', '2026-07-14', 'Evening', 'GJ-33-ZZ-9999', 'AADHAR-1122', NULL, '18:15:20', 'Suspicious activity noted. Detailed physical search conducted.', '2026-07-14 12:45:20', '2026-07-14 12:45:20'),
(263, 3, 3, 'Prakash Vaghela', '2026-07-14', 'Evening', 'GJ-33-EE-5544', 'DL-GJ33-774', NULL, '18:30:11', 'Triple riding on two-wheeler. Issued memo and warned.', '2026-07-14 13:00:11', '2026-07-14 13:00:11'),
(264, 2, 4, 'Hardik Patel', '2026-07-14', 'Evening', 'GJ-09-AB-2233', 'DL-GJ09-556', NULL, '19:05:05', 'Routine evening checkpoint stop. Documents valid.', '2026-07-14 13:35:05', '2026-07-14 13:35:05'),
(265, 4, 2, 'Kishan Bharvad', '2026-07-14', 'Evening', 'GJ-33-DF-6677', 'AADHAR-7744', NULL, '19:40:50', 'Driver seemed intoxicated. Breathalyzer test passed (Negative).', '2026-07-14 14:10:50', '2026-07-14 14:10:50'),
(266, 3, 1, 'Ashish Chauhan', '2026-07-14', 'Evening', 'GJ-33-JK-8811', 'DL-GJ33-221', NULL, '20:10:15', 'Illegal dark film on windows. Film removed on site and fined.', '2026-07-14 14:40:15', '2026-07-14 14:40:15'),
(267, 2, 3, 'Nirav Desai', '2026-07-14', 'Evening', 'GJ-33-RT-4455', 'DL-GJ33-990', NULL, '20:35:40', 'Proper RC book and License shown. Cleared.', '2026-07-14 15:05:40', '2026-07-14 15:05:40'),
(268, 4, 4, 'Jignesh Solanki', '2026-07-14', 'Evening', 'GJ-01-WE-3322', 'AADHAR-5533', NULL, '21:00:25', 'Checked for illegal transport. Vehicle empty.', '2026-07-14 15:30:25', '2026-07-14 15:30:25'),
(269, 3, 2, 'Bhavin Joshi', '2026-07-14', 'Evening', 'GJ-33-TY-7766', 'DL-GJ33-005', NULL, '21:25:10', 'Expired vehicle insurance. Strictly warned to renew immediately.', '2026-07-14 15:55:10', '2026-07-14 15:55:10'),
(270, 2, 1, 'Chetan Zala', '2026-07-14', 'Evening', 'GJ-33-UI-5588', 'DL-GJ33-441', NULL, '21:55:00', 'Commercial vehicle checked. Goods manifest verified.', '2026-07-14 16:25:00', '2026-07-14 16:25:00'),
(271, 4, 3, 'Darshan Pandya', '2026-07-14', 'Evening', 'GJ-10-OP-1199', 'DL-GJ10-887', NULL, '22:20:30', 'Night patrol routine stop. Identity verified.', '2026-07-14 16:50:30', '2026-07-14 16:50:30'),
(272, 3, 4, 'Manoj Barot', '2026-07-14', 'Evening', 'GJ-33-AS-3377', 'AADHAR-9911', NULL, '22:45:45', 'Suspicious wrapped boxes found. Inspected and cleared.', '2026-07-14 17:15:45', '2026-07-14 17:15:45'),
(273, 2, 2, 'Yashwant Sinh', '2026-07-14', 'Evening', 'GJ-33-GH-2244', 'DL-GJ33-772', NULL, '23:15:10', 'Late-night standard protocol check. No issues found.', '2026-07-14 17:45:10', '2026-07-14 17:45:10'),
(274, 4, 11, 'wdsefgbh', '2026-07-17', 'Morning', 'sdfg2345', '2345', 'vehicle_photos/Mwa2VWPwitxkOoEQVbOtQfNrxgHYCldNJwPacHt9.jpg', '12:42:00', 'qwer', '2026-07-17 01:42:32', '2026-07-17 01:42:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
