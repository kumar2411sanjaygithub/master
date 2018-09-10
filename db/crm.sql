-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2018 at 06:28 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.9-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `job_title`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'php55', 'php6@cybuzzsc.com', 'editor', '$2y$10$Q.vl950Nk1KG2hXVJvqx/eGPnGEtTlgbKtMdrHxWA8cuNRZVUqs2.', '1cR5MzUrtmZaPFgEHXxyyzCsZLI7RWq9pgNIAF2GMkJslLbyroeJpMXNSkj1', '2018-09-04 18:31:23', '2018-09-04 18:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `depatment_name` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` varchar(191) DEFAULT '0',
  `deleted_at` varchar(191) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `depatment_name`, `description`, `created_at`, `created_by`, `status`, `deleted_at`, `updated_at`) VALUES
(1, 'it', 'computer', '2018-09-06 00:17:58', NULL, '0', '2018-09-06 06:02:02', '2018-09-06 00:32:02'),
(2, 'hr', 'mana', '2018-09-06 00:22:55', 1, '0', NULL, '2018-09-06 04:01:23'),
(3, 'hospital', 'cure', '2018-09-06 00:34:39', NULL, '0', '2018-09-06 06:04:51', '2018-09-06 00:34:51'),
(4, 'second', NULL, '2018-09-06 03:49:17', 1, '0', NULL, '2018-09-06 03:49:17'),
(5, NULL, 'dfff', '2018-09-06 03:49:54', 1, '0', '2018-09-06 09:20:01', '2018-09-06 03:50:01'),
(6, NULL, 'vbv', '2018-09-06 03:51:15', 1, '0', '2018-09-06 09:22:25', '2018-09-06 03:52:25'),
(7, NULL, 'ghgh', '2018-09-06 03:52:23', 1, '0', '2018-09-06 09:22:28', '2018-09-06 03:52:28'),
(8, 'AS', 'ghghgh', '2018-09-06 03:53:25', 1, '0', NULL, '2018-09-06 03:53:25'),
(9, 'ASDS', 'fdgd', '2018-09-06 03:54:17', 1, '0', NULL, '2018-09-06 03:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `employee_temp`
--

CREATE TABLE `employee_temp` (
  `id` int(11) NOT NULL,
  `employee` varchar(255) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `telephone_number` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `line1` varchar(255) NOT NULL,
  `line2` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `comm_mob` varchar(256) DEFAULT NULL,
  `comm_telephone` varchar(256) DEFAULT NULL,
  `pin_code` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` varchar(111) DEFAULT NULL,
  `approve_status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_temp`
--

INSERT INTO `employee_temp` (`id`, `employee`, `employee_id`, `designation`, `email`, `contact_number`, `telephone_number`, `user_name`, `city`, `password`, `department_id`, `line1`, `line2`, `country`, `state`, `comm_mob`, `comm_telephone`, `pin_code`, `added_by`, `updated_at`, `created_at`, `deleted_at`, `approve_status`) VALUES
(1, 'shalu', 12, 'developer', 'php11@cybuzzsc.com', NULL, '33434343434', 'asa', 'er', '123', '4', 'er', 're', 'INDIA', 'HR', NULL, NULL, 343433, NULL, '2018-09-07 01:33:01', '2018-09-06 20:02:16', '2018-09-07 12:33:01', 1),
(2, 'sanjay', 14, 'developer', 'php11@cybuzzsc.com', NULL, '33434343434', 'asa', 'er', '123', '4', 'er', 're', 'INDIA', 'HR', NULL, NULL, 343433, NULL, '2018-09-07 03:29:49', '2018-09-06 20:02:53', NULL, 1),
(6, 'ashu', NULL, 'developer', 'php5@cybuzzsc.com', NULL, '1223123123121', 'asa', 'er', '123', '8', 'er', 're', 'INDIA', 'AN', NULL, NULL, 343433, NULL, '2018-09-07 01:49:44', '2018-09-06 20:10:33', NULL, 0),
(7, 'pets', 13, 'developer', 'php55@cybuzzsc.com', '1234554321', '565656566', 'tt', 'you', '1234', '4', 'er', 'rt', 'INDIA', 'JH', '4556677889', '6754657668', 454545, NULL, '2018-09-07 06:58:15', '2018-09-07 01:27:51', NULL, 1);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_04_121050_create_clients_table', 2),
(4, '2018_09_05_105835_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$8bKXHetF0mRQa34WLIrnZ.Sa.mcYd41NQX4wokAOSetfvohZ2YHoy', '2018-09-04 04:47:05'),
('php6@cybuzzsc.com', '$2y$10$sYi552pI64Y57Xe6HL9Ksu8tA2ZgARIAMrsYWSmXoNM7P.8mb7QSW', '2018-09-04 05:39:26'),
('php5@cybuzzsc.com', '$2y$10$6S/tjBkMv74eHh/fSqNS0eKiy7i/N1qVSvwCkO5nfnLkQ7LWxoY32', '2018-09-05 04:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `permission_id`, `created_at`, `updated_at`) VALUES
(22, 'demo1_add', 'web', 2, '2018-09-07 02:44:06', '2018-09-07 02:44:06'),
(23, 'demo1_edit', 'web', 2, '2018-09-07 02:44:06', '2018-09-07 02:44:06'),
(24, 'de_view', 'web', 3, '2018-09-07 02:44:06', '2018-09-07 02:44:06'),
(25, 'de_delete', 'web', 3, '2018-09-07 03:10:03', '2018-09-07 03:10:03'),
(26, 'demo1_delete', 'web', 2, '2018-09-07 03:10:15', '2018-09-07 03:10:15'),
(27, 'de_add', 'web', 3, '2018-09-07 03:16:19', '2018-09-07 03:16:19'),
(28, 'de_approver', 'web', 3, '2018-09-07 03:16:26', '2018-09-07 03:16:26'),
(29, 'demo1_view', 'web', 2, '2018-09-07 06:49:35', '2018-09-07 06:49:35'),
(30, 'demo1_approver', 'web', 2, '2018-09-07 07:22:15', '2018-09-07 07:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `department_id`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'demo', 'web', 2, 1, '2018-09-06 05:10:34', '2018-09-06 05:54:47'),
(3, 'test', 'web', 4, 1, '2018-09-06 05:48:32', '2018-09-06 05:52:29'),
(4, 'adfaseeead', 'web', 8, 1, '2018-09-06 07:06:15', '2018-09-06 07:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(22, 2),
(28, 2),
(22, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(29, 4),
(30, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `permission_name`, `slug`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'Testss', 'Testsss', '2018-09-06 06:53:14', '2018-09-06 06:47:24', '2018-09-06 06:53:14'),
(2, 'demo1', 'demo/create1', 'thios is demo1', NULL, '2018-09-06 06:53:29', '2018-09-06 06:53:36'),
(3, 'de', 'da', 'asdfsdf', NULL, '2018-09-06 23:18:50', '2018-09-06 23:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$rGdc2uGRXcFREZ9bjVfDfuKK9XAELbZb72lCiM1qZ2EjJKk9vpZqa', 'Ny9CiUfVxKqQQVuMdwffl8JTgpYlBHg8T00OXbjtNKletroYymVxY1FudfyQ', '2018-09-04 03:50:13', '2018-09-05 02:56:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_temp`
--
ALTER TABLE `employee_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employee_temp`
--
ALTER TABLE `employee_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
