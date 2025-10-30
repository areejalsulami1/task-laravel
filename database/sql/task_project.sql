-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2025 at 10:07 PM
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
-- Database: `task_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `details`, `created_at`, `updated_at`) VALUES
(1, 1, 'logout', 'User logged out', '2025-10-28 16:47:20', '2025-10-28 16:47:20'),
(2, 1, 'login', 'User logged in via AJAX', '2025-10-28 16:47:34', '2025-10-28 16:47:34'),
(3, 1, 'add_user', 'Added user #12 (areej)', '2025-10-28 17:04:49', '2025-10-28 17:04:49'),
(4, 1, 'edit_user', 'Edited user #12', '2025-10-28 17:04:55', '2025-10-28 17:04:55'),
(5, 1, 'edit_user', 'Edited user #12', '2025-10-28 17:05:01', '2025-10-28 17:05:01'),
(6, 1, 'delete_user', 'Deleted user #12 (areej)', '2025-10-28 17:05:07', '2025-10-28 17:05:07'),
(7, 1, 'edit_user', 'Edited user #11', '2025-10-28 17:06:42', '2025-10-28 17:06:42'),
(8, 1, 'edit_user', 'Edited user #9', '2025-10-28 17:07:03', '2025-10-28 17:07:03'),
(9, 1, 'logout', 'User logged out', '2025-10-28 17:07:30', '2025-10-28 17:07:30'),
(10, 1, 'login', 'User logged in via AJAX', '2025-10-28 17:07:48', '2025-10-28 17:07:48'),
(11, 1, 'add_user', 'Added user #13 (areej)', '2025-10-28 17:08:34', '2025-10-28 17:08:34'),
(12, 1, 'edit_user', 'Edited user #13', '2025-10-28 17:08:38', '2025-10-28 17:08:38'),
(13, 1, 'logout', 'User logged out', '2025-10-28 17:09:12', '2025-10-28 17:09:12'),
(14, 13, 'login', 'User logged in via AJAX', '2025-10-28 17:09:23', '2025-10-28 17:09:23'),
(15, 13, 'logout', 'User logged out', '2025-10-28 17:37:00', '2025-10-28 17:37:00'),
(16, 13, 'login', 'User logged in via AJAX', '2025-10-28 17:37:19', '2025-10-28 17:37:19'),
(17, 13, 'edit_user', 'Edited user #13', '2025-10-28 17:37:43', '2025-10-28 17:37:43'),
(18, 13, 'logout', 'User logged out', '2025-10-28 17:38:20', '2025-10-28 17:38:20'),
(19, 13, 'login', 'User logged in via AJAX', '2025-10-28 17:38:37', '2025-10-28 17:38:37'),
(20, 13, 'edit_user', 'Edited user #13', '2025-10-28 17:40:20', '2025-10-28 17:40:20'),
(21, 13, 'logout', 'User logged out', '2025-10-28 17:41:39', '2025-10-28 17:41:39'),
(22, 1, 'login', 'User logged in via AJAX', '2025-10-28 17:49:04', '2025-10-28 17:49:04'),
(23, 1, 'add_user', 'Added user #14 (reema)', '2025-10-28 17:50:15', '2025-10-28 17:50:15'),
(24, 1, 'logout', 'User logged out', '2025-10-28 17:50:23', '2025-10-28 17:50:23');

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_28_165606_add_username_age_to_users_table', 2),
(5, '2025_10_28_165645_create_logs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `age`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin User', 28, 'admin@example.com', NULL, '$2y$12$H8pwMqDF5qeMXG4nZ4GdK.vH/ADMJCG7d1/PCz9fQOHkV1R9G6hVy', NULL, '2025-10-28 15:05:38', '2025-10-28 15:05:38'),
(13, 'areej', 'areejsulami', 25, 'areejalsulami@hotmail.com', NULL, '$2y$12$k1/ykhvc2/31P.0OlUBcuOTAK87cEvSAcstSWBFLV71.3ljm5vSe.', NULL, '2025-10-28 17:08:34', '2025-10-28 17:40:20'),
(14, 'reema', 'reemas', 20, 'reema@hotmail.com', NULL, '$2y$12$.iPqwff1ZtBaOQ/u769WVOEVDXl4Jpn/2.fRZK5m4Kqd912gg7Dmm', NULL, '2025-10-28 17:50:15', '2025-10-28 17:50:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
