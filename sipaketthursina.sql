-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2025 at 08:45 AM
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
-- Database: `sipaketthursina`
--

-- --------------------------------------------------------

--
-- Table structure for table `asramas`
--

CREATE TABLE `asramas` (
  `id_asrama` bigint UNSIGNED NOT NULL,
  `nama_asrama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gedung` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asramas`
--

INSERT INTO `asramas` (`id_asrama`, `nama_asrama`, `gedung`, `created_at`, `updated_at`) VALUES
(1, 'Al-Azhar', 'Gedung Putri', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(2, 'Harvard', 'Gedung Putri', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(3, 'Cambridge', 'Gedung Putri', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(4, 'Sevilla', 'Gedung Putri', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(5, 'Granada', 'Gedung Putra', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(6, 'Cordoba', 'Gedung Putra', '2025-05-14 08:38:51', '2025-05-14 08:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pakets`
--

CREATE TABLE `kategori_pakets` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_pakets`
--

INSERT INTO `kategori_pakets` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Makanan Basah', NULL, NULL),
(2, 'Makanan Kering (Snack)', NULL, NULL),
(3, 'Non Makanan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_groups`
--

CREATE TABLE `menu_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_groups`
--

INSERT INTO `menu_groups` (`id`, `name`, `permission_name`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', NULL, NULL),
(2, 'Master Management', 'master.management', 'fas fa-cogs', NULL, NULL),
(3, 'Transaksi Management', 'transaksi.management', 'fas fa-exchange-alt', NULL, NULL),
(4, 'Laporan Management', 'laporan.management', 'fas fa-file-alt', NULL, NULL),
(5, 'Users Management', 'user.management', 'fas fa-users', NULL, NULL),
(6, 'Role Management', 'role.permission.management', 'fas fa-user-tag', NULL, NULL),
(7, 'Menu Management', 'menu.management', 'fas fa-bars', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_group_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `route`, `permission_name`, `menu_group_id`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', 'dashboard', 1, NULL, NULL),
(2, 'Asrama List', 'master-management/asrama', 'asrama.index', 2, NULL, NULL),
(3, 'Kategori Paket List', 'master-management/kategori-paket', 'kategori-paket.index', 2, NULL, NULL),
(4, ' Paket List', 'transaksi-management/paket', 'paket.index', 3, NULL, NULL),
(5, 'Laporan', 'laporan-management/laporan', 'laporan.index', 4, NULL, NULL),
(6, 'Santri List', 'user-management/santri', 'santri.index', 5, NULL, NULL),
(7, 'User List', 'user-management/user', 'user.index', 5, NULL, NULL),
(8, 'Role List', 'role-and-permission/role', 'role.index', 6, NULL, NULL),
(9, 'Permission List', 'role-and-permission/permission', 'permission.index', 6, NULL, NULL),
(10, 'Permission To Role', 'role-and-permission/assign', 'assign.index', 6, NULL, NULL),
(11, 'User To Role', 'role-and-permission/assign-user', 'assign.user.index', 6, NULL, NULL),
(12, 'Menu Group', 'menu-management/menu-group', 'menu-group.index', 7, NULL, NULL),
(13, 'Menu Item', 'menu-management/menu-item', 'menu-item.index', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_02_06_125449_create_menu_groups_table', 1),
(7, '2025_02_06_125514_create_menu_items_table', 1),
(8, '2025_02_06_125515_create_permission_tables', 1),
(9, '2025_05_13_043027_create_asramas_table', 1),
(10, '2025_05_13_043141_create_kategori_pakets_table', 1),
(11, '2025_05_13_043222_create_santris_table', 1),
(12, '2025_05_13_043932_create_pakets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pakets`
--

CREATE TABLE `pakets` (
  `id_paket` bigint UNSIGNED NOT NULL,
  `nama_paket` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `penerima_paket` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengirim_paket` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_paket_yang_disita` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_paket` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', '2025-05-14 08:38:49', '2025-05-14 08:38:49'),
(2, 'master.management', 'web', '2025-05-14 08:38:49', '2025-05-14 08:38:49'),
(3, 'transaksi.management', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(4, 'laporan.management', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(5, 'user.management', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(6, 'role.permission.management', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(7, 'menu.management', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(8, 'user.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(9, 'user.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(10, 'user.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(11, 'user.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(12, 'user.import', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(13, 'user.export', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(14, 'role.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(15, 'role.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(16, 'role.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(17, 'role.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(18, 'role.import', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(19, 'role.export', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(20, 'permission.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(21, 'permission.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(22, 'permission.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(23, 'permission.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(24, 'permission.import', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(25, 'permission.export', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(26, 'assign.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(27, 'assign.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(28, 'assign.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(29, 'assign.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(30, 'assign.user.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(31, 'assign.user.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(32, 'assign.user.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(33, 'menu-group.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(34, 'menu-group.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(35, 'menu-group.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(36, 'menu-group.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(37, 'menu-item.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(38, 'menu-item.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(39, 'menu-item.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(40, 'menu-item.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(41, 'asrama.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(42, 'asrama.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(43, 'asrama.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(44, 'asrama.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(45, 'kategori-paket.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(46, 'kategori-paket.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(47, 'kategori-paket.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(48, 'kategori-paket.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(49, 'paket.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(50, 'paket.create', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(51, 'paket.edit', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(52, 'paket.destroy', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(53, 'santri.index', 'web', '2025-05-14 08:38:50', '2025-05-14 08:38:50'),
(54, 'santri.create', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(55, 'santri.edit', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(56, 'santri.destroy', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(57, 'laporan.index', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(58, 'laporan.create', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(59, 'laporan.edit', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(60, 'laporan.destroy', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51'),
(2, 'super-admin', 'web', '2025-05-14 08:38:51', '2025-05-14 08:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(5, 1),
(8, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2);

-- --------------------------------------------------------

--
-- Table structure for table `santris`
--

CREATE TABLE `santris` (
  `nis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_santri` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_asrama` bigint UNSIGNED NOT NULL,
  `total_paket_diterima` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'superadmin', 'superadmin@gmail.com', '2025-05-14 08:38:49', '$2y$12$i0R97dsJ5/2xzh7I3/Zz3OIg5evcKpi9whImwreTTaXxF9g4RZUH6', NULL, NULL, NULL, NULL, '2025-05-14 08:38:49', '2025-05-14 08:38:49'),
(2, 'user', 'user', 'user@gmail.com', '2025-05-14 08:38:49', '$2y$12$VKLCTHK.MXe7/OSPRk6NPe59Ixhu2.oHCcqLpuW7wzR05AdC3QaLW', NULL, NULL, NULL, NULL, '2025-05-14 08:38:49', '2025-05-14 08:38:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asramas`
--
ALTER TABLE `asramas`
  ADD PRIMARY KEY (`id_asrama`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori_pakets`
--
ALTER TABLE `kategori_pakets`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menu_groups`
--
ALTER TABLE `menu_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_groups_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_items_name_unique` (`name`),
  ADD UNIQUE KEY `menu_items_route_unique` (`route`),
  ADD KEY `menu_items_menu_group_id_foreign` (`menu_group_id`);

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
-- Indexes for table `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `pakets_id_kategori_foreign` (`id_kategori`),
  ADD KEY `pakets_penerima_paket_foreign` (`penerima_paket`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `santris`
--
ALTER TABLE `santris`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `santris_id_asrama_foreign` (`id_asrama`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asramas`
--
ALTER TABLE `asramas`
  MODIFY `id_asrama` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_pakets`
--
ALTER TABLE `kategori_pakets`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_groups`
--
ALTER TABLE `menu_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id_paket` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_group_id_foreign` FOREIGN KEY (`menu_group_id`) REFERENCES `menu_groups` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `pakets`
--
ALTER TABLE `pakets`
  ADD CONSTRAINT `pakets_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_pakets` (`id_kategori`) ON DELETE CASCADE,
  ADD CONSTRAINT `pakets_penerima_paket_foreign` FOREIGN KEY (`penerima_paket`) REFERENCES `santris` (`nis`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `santris`
--
ALTER TABLE `santris`
  ADD CONSTRAINT `santris_id_asrama_foreign` FOREIGN KEY (`id_asrama`) REFERENCES `asramas` (`id_asrama`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
