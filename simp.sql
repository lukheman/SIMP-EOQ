-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql11.serv00.com
-- Generation Time: Jun 09, 2025 at 02:51 AM
-- Server version: 8.0.39
-- PHP Version: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m11290_simp`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_pemesanan_produk`
--

CREATE TABLE `biaya_pemesanan_produk` (
  `id` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `biaya` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biaya_pemesanan_produk`
--

INSERT INTO `biaya_pemesanan_produk` (`id`, `id_produk`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 1, 900000.00, '2025-06-04 21:42:49', '2025-06-07 20:22:28'),
(2, 2, 900000.00, '2025-06-08 06:08:34', '2025-06-08 06:08:34'),
(3, 3, 900000.00, '2025-06-08 06:11:36', '2025-06-08 06:11:36'),
(4, 4, 900000.00, '2025-06-08 06:16:05', '2025-06-08 06:16:05'),
(5, 5, 900000.00, '2025-06-08 06:20:49', '2025-06-08 06:20:49'),
(6, 6, 900000.00, '2025-06-08 08:00:46', '2025-06-08 08:00:46'),
(7, 7, 900000.00, '2025-06-08 08:02:57', '2025-06-08 08:02:57'),
(8, 8, 900000.00, '2025-06-08 08:07:18', '2025-06-08 08:07:18'),
(9, 9, 900000.00, '2025-06-08 08:09:28', '2025-06-08 08:09:28'),
(10, 10, 900000.00, '2025-06-08 08:11:38', '2025-06-08 08:11:38'),
(11, 11, 900000.00, '2025-06-08 08:18:39', '2025-06-08 08:18:39'),
(12, 12, 900000.00, '2025-06-08 08:22:03', '2025-06-08 08:22:03'),
(13, 13, 900000.00, '2025-06-08 08:24:13', '2025-06-08 08:24:13'),
(14, 14, 900000.00, '2025-06-08 08:27:04', '2025-06-08 08:27:04'),
(15, 15, 900000.00, '2025-06-08 08:30:38', '2025-06-08 08:30:38'),
(16, 16, 900000.00, '2025-06-08 10:49:30', '2025-06-08 10:49:30'),
(17, 17, 900000.00, '2025-06-08 10:51:14', '2025-06-08 10:51:14'),
(18, 18, 900000.00, '2025-06-08 10:52:33', '2025-06-08 10:52:33'),
(19, 19, 900000.00, '2025-06-08 10:54:00', '2025-06-08 10:54:00'),
(20, 20, 900000.00, '2025-06-08 10:56:19', '2025-06-08 10:56:19'),
(21, 21, 900000.00, '2025-06-08 10:58:37', '2025-06-08 10:58:37'),
(22, 22, 900000.00, '2025-06-08 11:00:26', '2025-06-08 11:00:26'),
(23, 23, 900000.00, '2025-06-08 11:02:09', '2025-06-08 11:02:09'),
(24, 24, 900000.00, '2025-06-08 11:04:55', '2025-06-08 11:04:55'),
(25, 25, 900000.00, '2025-06-08 11:07:20', '2025-06-08 11:07:20'),
(26, 26, 900000.00, '2025-06-08 11:09:12', '2025-06-08 11:09:12'),
(27, 27, 900000.00, '2025-06-08 11:11:37', '2025-06-08 11:11:37'),
(28, 28, 900000.00, '2025-06-08 11:14:14', '2025-06-08 11:14:14'),
(29, 29, 900000.00, '2025-06-08 11:17:34', '2025-06-08 11:17:34'),
(30, 30, 900000.00, '2025-06-08 11:20:05', '2025-06-08 11:20:05'),
(31, 31, 900000.00, '2025-06-08 11:21:40', '2025-06-08 11:21:40'),
(32, 32, 900000.00, '2025-06-08 11:24:29', '2025-06-08 11:24:29'),
(33, 33, 900000.00, '2025-06-08 11:27:17', '2025-06-08 11:27:17'),
(34, 34, 900000.00, '2025-06-08 11:29:22', '2025-06-08 11:29:22'),
(35, 35, 900000.00, '2025-06-08 11:31:03', '2025-06-08 11:31:03'),
(36, 36, 900000.00, '2025-06-08 11:33:08', '2025-06-08 21:44:51'),
(37, 37, 900000.00, '2025-06-08 11:34:53', '2025-06-08 21:46:32'),
(38, 38, 900000.00, '2025-06-08 11:36:49', '2025-06-08 21:50:01'),
(39, 39, 900000.00, '2025-06-08 11:38:15', '2025-06-08 21:42:43'),
(40, 40, 900000.00, '2025-06-08 11:39:49', '2025-06-08 22:37:47'),
(41, 41, 900000.00, '2025-06-08 11:41:55', '2025-06-08 11:41:55'),
(42, 42, 900000.00, '2025-06-08 11:43:43', '2025-06-08 21:52:13'),
(43, 43, 900000.00, '2025-06-08 11:46:08', '2025-06-08 22:46:13'),
(44, 44, 900000.00, '2025-06-08 11:48:06', '2025-06-08 21:55:11'),
(45, 45, 900000.00, '2025-06-08 20:36:42', '2025-06-08 20:36:42'),
(46, 46, 900000.00, '2025-06-08 20:38:19', '2025-06-08 20:38:19'),
(47, 47, 900000.00, '2025-06-08 20:39:59', '2025-06-08 20:39:59'),
(48, 48, 900000.00, '2025-06-08 20:41:11', '2025-06-08 20:41:11'),
(49, 49, 900000.00, '2025-06-08 20:42:24', '2025-06-08 20:42:24'),
(50, 50, 900000.00, '2025-06-08 20:44:19', '2025-06-08 20:44:19'),
(51, 51, 900000.00, '2025-06-08 20:45:41', '2025-06-08 20:45:41'),
(52, 52, 900000.00, '2025-06-08 20:47:13', '2025-06-08 20:47:13'),
(53, 53, 900000.00, '2025-06-08 20:48:35', '2025-06-08 20:48:35'),
(54, 54, 900000.00, '2025-06-08 20:51:46', '2025-06-08 20:51:46'),
(55, 55, 900000.00, '2025-06-08 20:53:04', '2025-06-08 20:53:04'),
(56, 56, 900000.00, '2025-06-08 20:54:42', '2025-06-08 20:54:42'),
(57, 57, 900000.00, '2025-06-08 20:56:06', '2025-06-08 20:56:06'),
(58, 58, 900000.00, '2025-06-08 20:57:12', '2025-06-08 20:57:12'),
(59, 59, 900000.00, '2025-06-08 20:59:33', '2025-06-08 20:59:33'),
(60, 60, 900000.00, '2025-06-08 21:00:57', '2025-06-08 21:00:57'),
(61, 61, 900000.00, '2025-06-08 21:02:46', '2025-06-08 21:02:46'),
(62, 62, 900000.00, '2025-06-08 21:04:49', '2025-06-08 21:04:49'),
(63, 63, 900000.00, '2025-06-08 21:06:55', '2025-06-08 21:06:55'),
(64, 64, 900000.00, '2025-06-08 21:08:33', '2025-06-08 21:08:33'),
(65, 65, 900000.00, '2025-06-08 21:10:26', '2025-06-08 21:32:06'),
(66, 66, 900000.00, '2025-06-08 21:13:08', '2025-06-08 21:13:08'),
(67, 67, 900000.00, '2025-06-08 21:15:14', '2025-06-08 21:15:14'),
(68, 68, 9000000.00, '2025-06-08 21:17:07', '2025-06-08 21:17:07'),
(69, 69, 900000.00, '2025-06-08 21:19:02', '2025-06-08 21:19:02'),
(70, 70, 900000.00, '2025-06-08 21:21:12', '2025-06-08 21:21:12'),
(71, 71, 900000.00, '2025-06-08 21:22:38', '2025-06-08 21:22:38'),
(72, 72, 900000.00, '2025-06-08 21:24:52', '2025-06-08 21:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_penyimpanan_produk`
--

CREATE TABLE `biaya_penyimpanan_produk` (
  `id` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `biaya` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biaya_penyimpanan_produk`
--

INSERT INTO `biaya_penyimpanan_produk` (`id`, `id_produk`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 1, 100000.00, '2025-06-04 21:42:49', '2025-06-07 20:22:28'),
(2, 2, 100000.00, '2025-06-08 06:08:34', '2025-06-08 06:08:34'),
(3, 3, 100000.00, '2025-06-08 06:11:36', '2025-06-08 06:11:36'),
(4, 4, 100000.00, '2025-06-08 06:16:05', '2025-06-08 06:16:05'),
(5, 5, 100000.00, '2025-06-08 06:20:49', '2025-06-08 06:20:49'),
(6, 6, 100000.00, '2025-06-08 08:00:46', '2025-06-08 08:00:46'),
(7, 7, 100000.00, '2025-06-08 08:02:57', '2025-06-08 08:02:57'),
(8, 8, 100000.00, '2025-06-08 08:07:18', '2025-06-08 08:07:18'),
(9, 9, 100000.00, '2025-06-08 08:09:28', '2025-06-08 08:09:28'),
(10, 10, 100000.00, '2025-06-08 08:11:38', '2025-06-08 08:11:38'),
(11, 11, 100000.00, '2025-06-08 08:18:39', '2025-06-08 08:18:39'),
(12, 12, 100000.00, '2025-06-08 08:22:03', '2025-06-08 08:22:03'),
(13, 13, 100000.00, '2025-06-08 08:24:13', '2025-06-08 08:24:13'),
(14, 14, 100000.00, '2025-06-08 08:27:04', '2025-06-08 08:27:04'),
(15, 15, 100000.00, '2025-06-08 08:30:38', '2025-06-08 08:30:38'),
(16, 16, 100000.00, '2025-06-08 10:49:30', '2025-06-08 10:49:30'),
(17, 17, 100000.00, '2025-06-08 10:51:14', '2025-06-08 10:51:14'),
(18, 18, 100000.00, '2025-06-08 10:52:33', '2025-06-08 10:52:33'),
(19, 19, 100000.00, '2025-06-08 10:54:00', '2025-06-08 10:54:00'),
(20, 20, 100000.00, '2025-06-08 10:56:19', '2025-06-08 10:56:19'),
(21, 21, 100000.00, '2025-06-08 10:58:37', '2025-06-08 10:58:37'),
(22, 22, 100000.00, '2025-06-08 11:00:26', '2025-06-08 11:00:26'),
(23, 23, 100000.00, '2025-06-08 11:02:09', '2025-06-08 11:02:09'),
(24, 24, 100000.00, '2025-06-08 11:04:55', '2025-06-08 11:04:55'),
(25, 25, 100000.00, '2025-06-08 11:07:20', '2025-06-08 11:07:20'),
(26, 26, 100000.00, '2025-06-08 11:09:12', '2025-06-08 11:09:12'),
(27, 27, 100000.00, '2025-06-08 11:11:37', '2025-06-08 11:11:37'),
(28, 28, 100000.00, '2025-06-08 11:14:14', '2025-06-08 11:14:14'),
(29, 29, 100000.00, '2025-06-08 11:17:34', '2025-06-08 11:17:34'),
(30, 30, 100000.00, '2025-06-08 11:20:05', '2025-06-08 11:20:05'),
(31, 31, 100000.00, '2025-06-08 11:21:40', '2025-06-08 11:21:40'),
(32, 32, 100000.00, '2025-06-08 11:24:29', '2025-06-08 11:24:29'),
(33, 33, 100000.00, '2025-06-08 11:27:17', '2025-06-08 11:27:17'),
(34, 34, 100000.00, '2025-06-08 11:29:22', '2025-06-08 11:29:22'),
(35, 35, 100000.00, '2025-06-08 11:31:03', '2025-06-08 11:31:03'),
(36, 36, 100000.00, '2025-06-08 11:33:08', '2025-06-08 21:44:51'),
(37, 37, 100000.00, '2025-06-08 11:34:53', '2025-06-08 21:46:32'),
(38, 38, 100000.00, '2025-06-08 11:36:49', '2025-06-08 21:50:01'),
(39, 39, 100000.00, '2025-06-08 11:38:15', '2025-06-08 21:42:43'),
(40, 40, 100000.00, '2025-06-08 11:39:49', '2025-06-08 22:37:47'),
(41, 41, 100000.00, '2025-06-08 11:41:55', '2025-06-08 11:41:55'),
(42, 42, 100000.00, '2025-06-08 11:43:43', '2025-06-08 21:52:13'),
(43, 43, 100000.00, '2025-06-08 11:46:08', '2025-06-08 22:46:13'),
(44, 44, 100000.00, '2025-06-08 11:48:06', '2025-06-08 21:55:11'),
(45, 45, 100000.00, '2025-06-08 20:36:42', '2025-06-08 20:36:42'),
(46, 46, 100000.00, '2025-06-08 20:38:19', '2025-06-08 20:38:19'),
(47, 47, 100000.00, '2025-06-08 20:39:59', '2025-06-08 20:39:59'),
(48, 48, 100000.00, '2025-06-08 20:41:11', '2025-06-08 20:41:11'),
(49, 49, 100000.00, '2025-06-08 20:42:24', '2025-06-08 20:42:24'),
(50, 50, 100000.00, '2025-06-08 20:44:19', '2025-06-08 20:44:19'),
(51, 51, 100000.00, '2025-06-08 20:45:41', '2025-06-08 20:45:41'),
(52, 52, 100000.00, '2025-06-08 20:47:13', '2025-06-08 20:47:13'),
(53, 53, 100000.00, '2025-06-08 20:48:35', '2025-06-08 20:48:35'),
(54, 54, 100000.00, '2025-06-08 20:51:46', '2025-06-08 20:51:46'),
(55, 55, 100000.00, '2025-06-08 20:53:04', '2025-06-08 20:53:04'),
(56, 56, 100000.00, '2025-06-08 20:54:42', '2025-06-08 20:54:42'),
(57, 57, 100000.00, '2025-06-08 20:56:06', '2025-06-08 20:56:06'),
(58, 58, 100000.00, '2025-06-08 20:57:12', '2025-06-08 20:57:12'),
(59, 59, 100000.00, '2025-06-08 20:59:33', '2025-06-08 20:59:33'),
(60, 60, 100000.00, '2025-06-08 21:00:57', '2025-06-08 21:00:57'),
(61, 61, 100000.00, '2025-06-08 21:02:46', '2025-06-08 21:02:46'),
(62, 62, 100000.00, '2025-06-08 21:04:49', '2025-06-08 21:04:49'),
(63, 63, 100000.00, '2025-06-08 21:06:55', '2025-06-08 21:06:55'),
(64, 64, 100000.00, '2025-06-08 21:08:33', '2025-06-08 21:08:33'),
(65, 65, 100000.00, '2025-06-08 21:10:26', '2025-06-08 21:32:06'),
(66, 66, 100000.00, '2025-06-08 21:13:08', '2025-06-08 21:13:08'),
(67, 67, 100000.00, '2025-06-08 21:15:14', '2025-06-08 21:15:14'),
(68, 68, 100000.00, '2025-06-08 21:17:07', '2025-06-08 21:17:07'),
(69, 69, 100000.00, '2025-06-08 21:19:02', '2025-06-08 21:19:02'),
(70, 70, 100000.00, '2025-06-08 21:21:12', '2025-06-08 21:21:12'),
(71, 71, 100000.00, '2025-06-08 21:22:38', '2025-06-08 21:22:38'),
(72, 72, 100000.00, '2025-06-08 21:24:52', '2025-06-08 21:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-06-07 09:53:42', '2025-06-07 09:53:42'),
(2, 8, '2025-06-07 14:25:41', '2025-06-07 14:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_02_16_041446_create_users_table', 1),
(4, '2025_02_16_050305_create_sessions_table', 1),
(5, '2025_02_16_092346_create_produk_table', 1),
(6, '2025_02_18_121818_create_transaksi_table', 1),
(7, '2025_02_23_085349_create_keranjang_table', 1),
(8, '2025_03_03_065359_create_mutasi_table', 1),
(9, '2025_03_15_043406_create_pesanan_table', 1),
(10, '2025_04_30_124735_create_restock_table', 1),
(11, '2025_05_07_140439_create_biaya_pemesanan_table', 1),
(12, '2025_05_07_140447_create_biaya_penyimpanan_table', 1),
(13, '2025_05_07_155322_create_persediaan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal` date NOT NULL DEFAULT '2025-06-05',
  `jenis` enum('masuk','keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mutasi`
--

INSERT INTO `mutasi` (`id`, `id_produk`, `jumlah`, `tanggal`, `jenis`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 1, 50, '2025-04-01', 'keluar', NULL, NULL, NULL),
(4, 1, 20, '2025-05-10', 'masuk', NULL, NULL, NULL),
(5, 1, 25, '2025-05-05', 'keluar', NULL, NULL, NULL),
(6, 1, 30, '2025-05-15', 'keluar', NULL, NULL, NULL),
(7, 11, 25, '2025-06-05', 'masuk', NULL, '2025-06-08 21:27:25', '2025-06-08 21:27:25'),
(8, 65, 50, '2025-06-05', 'masuk', NULL, '2025-06-08 21:33:29', '2025-06-08 21:33:29'),
(9, 40, 40, '2025-06-05', 'masuk', NULL, '2025-06-08 21:40:50', '2025-06-08 21:40:50'),
(10, 39, 30, '2025-06-05', 'masuk', NULL, '2025-06-08 21:43:21', '2025-06-08 21:43:21'),
(11, 36, 50, '2025-06-05', 'masuk', NULL, '2025-06-08 21:45:45', '2025-06-08 21:45:45'),
(12, 37, 40, '2025-06-05', 'masuk', NULL, '2025-06-08 21:49:24', '2025-06-08 21:49:24'),
(13, 38, 50, '2025-06-05', 'masuk', NULL, '2025-06-08 21:50:53', '2025-06-08 21:50:53'),
(14, 42, 45, '2025-06-05', 'masuk', NULL, '2025-06-08 21:52:58', '2025-06-08 21:52:58'),
(15, 43, 45, '2025-06-05', 'masuk', NULL, '2025-06-08 21:54:22', '2025-06-08 21:54:22'),
(16, 44, 40, '2025-06-05', 'masuk', NULL, '2025-06-08 21:55:53', '2025-06-08 21:55:53'),
(17, 46, 45, '2025-06-05', 'masuk', NULL, '2025-06-08 22:08:08', '2025-06-08 22:08:08'),
(18, 46, 50, '2025-06-05', 'masuk', NULL, '2025-06-08 22:12:09', '2025-06-08 22:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `persediaan`
--

CREATE TABLE `persediaan` (
  `id` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persediaan`
--

INSERT INTO `persediaan` (`id`, `id_produk`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 30, '2025-06-04 21:42:49', '2025-06-04 21:42:49'),
(2, 2, 0, '2025-06-08 06:08:34', '2025-06-08 06:08:34'),
(3, 3, 0, '2025-06-08 06:11:36', '2025-06-08 06:11:36'),
(4, 4, 0, '2025-06-08 06:16:05', '2025-06-08 06:16:05'),
(5, 5, 0, '2025-06-08 06:20:49', '2025-06-08 06:20:49'),
(6, 6, 0, '2025-06-08 08:00:46', '2025-06-08 08:00:46'),
(7, 7, 0, '2025-06-08 08:02:57', '2025-06-08 08:02:57'),
(8, 8, 0, '2025-06-08 08:07:18', '2025-06-08 08:07:18'),
(9, 9, 0, '2025-06-08 08:09:28', '2025-06-08 08:09:28'),
(10, 10, 0, '2025-06-08 08:11:38', '2025-06-08 08:11:38'),
(11, 11, 25, '2025-06-08 08:18:39', '2025-06-08 21:27:25'),
(12, 12, 0, '2025-06-08 08:22:03', '2025-06-08 08:22:03'),
(13, 13, 0, '2025-06-08 08:24:13', '2025-06-08 08:24:13'),
(14, 14, 0, '2025-06-08 08:27:04', '2025-06-08 08:27:04'),
(15, 15, 0, '2025-06-08 08:30:38', '2025-06-08 08:30:38'),
(16, 16, 0, '2025-06-08 10:49:30', '2025-06-08 10:49:30'),
(17, 17, 0, '2025-06-08 10:51:14', '2025-06-08 10:51:14'),
(18, 18, 0, '2025-06-08 10:52:33', '2025-06-08 10:52:33'),
(19, 19, 0, '2025-06-08 10:54:00', '2025-06-08 10:54:00'),
(20, 20, 0, '2025-06-08 10:56:19', '2025-06-08 10:56:19'),
(21, 21, 0, '2025-06-08 10:58:37', '2025-06-08 10:58:37'),
(22, 22, 0, '2025-06-08 11:00:26', '2025-06-08 11:00:26'),
(23, 23, 0, '2025-06-08 11:02:09', '2025-06-08 11:02:09'),
(24, 24, 0, '2025-06-08 11:04:55', '2025-06-08 11:04:55'),
(25, 25, 0, '2025-06-08 11:07:20', '2025-06-08 11:07:20'),
(26, 26, 0, '2025-06-08 11:09:12', '2025-06-08 11:09:12'),
(27, 27, 0, '2025-06-08 11:11:37', '2025-06-08 11:11:37'),
(28, 28, 0, '2025-06-08 11:14:14', '2025-06-08 11:14:14'),
(29, 29, 0, '2025-06-08 11:17:34', '2025-06-08 11:17:34'),
(30, 30, 0, '2025-06-08 11:20:05', '2025-06-08 11:20:05'),
(31, 31, 0, '2025-06-08 11:21:40', '2025-06-08 11:21:40'),
(32, 32, 0, '2025-06-08 11:24:29', '2025-06-08 11:24:29'),
(33, 33, 0, '2025-06-08 11:27:17', '2025-06-08 11:27:17'),
(34, 34, 0, '2025-06-08 11:29:22', '2025-06-08 11:29:22'),
(35, 35, 0, '2025-06-08 11:31:03', '2025-06-08 11:31:03'),
(36, 36, 50, '2025-06-08 11:33:08', '2025-06-08 21:45:45'),
(37, 37, 40, '2025-06-08 11:34:53', '2025-06-08 21:49:24'),
(38, 38, 50, '2025-06-08 11:36:49', '2025-06-08 21:50:53'),
(39, 39, 30, '2025-06-08 11:38:15', '2025-06-08 21:43:21'),
(40, 40, 40, '2025-06-08 11:39:49', '2025-06-08 21:40:50'),
(41, 41, 0, '2025-06-08 11:41:55', '2025-06-08 11:41:55'),
(42, 42, 45, '2025-06-08 11:43:43', '2025-06-08 21:52:58'),
(43, 43, 45, '2025-06-08 11:46:08', '2025-06-08 21:54:22'),
(44, 44, 40, '2025-06-08 11:48:06', '2025-06-08 21:55:53'),
(45, 45, 0, '2025-06-08 20:36:42', '2025-06-08 20:36:42'),
(46, 46, 95, '2025-06-08 20:38:19', '2025-06-08 22:12:09'),
(47, 47, 0, '2025-06-08 20:39:59', '2025-06-08 20:39:59'),
(48, 48, 0, '2025-06-08 20:41:11', '2025-06-08 20:41:11'),
(49, 49, 0, '2025-06-08 20:42:24', '2025-06-08 20:42:24'),
(50, 50, 0, '2025-06-08 20:44:19', '2025-06-08 20:44:19'),
(51, 51, 0, '2025-06-08 20:45:41', '2025-06-08 20:45:41'),
(52, 52, 0, '2025-06-08 20:47:13', '2025-06-08 20:47:13'),
(53, 53, 0, '2025-06-08 20:48:35', '2025-06-08 20:48:35'),
(54, 54, 0, '2025-06-08 20:51:46', '2025-06-08 20:51:46'),
(55, 55, 0, '2025-06-08 20:53:04', '2025-06-08 20:53:04'),
(56, 56, 0, '2025-06-08 20:54:42', '2025-06-08 20:54:42'),
(57, 57, 0, '2025-06-08 20:56:06', '2025-06-08 20:56:06'),
(58, 58, 0, '2025-06-08 20:57:12', '2025-06-08 20:57:12'),
(59, 59, 0, '2025-06-08 20:59:33', '2025-06-08 20:59:33'),
(60, 60, 0, '2025-06-08 21:00:57', '2025-06-08 21:00:57'),
(61, 61, 0, '2025-06-08 21:02:46', '2025-06-08 21:02:46'),
(62, 62, 0, '2025-06-08 21:04:49', '2025-06-08 21:04:49'),
(63, 63, 0, '2025-06-08 21:06:55', '2025-06-08 21:06:55'),
(64, 64, 0, '2025-06-08 21:08:33', '2025-06-08 21:08:33'),
(65, 65, 50, '2025-06-08 21:10:26', '2025-06-08 21:33:29'),
(66, 66, 0, '2025-06-08 21:13:08', '2025-06-08 21:13:08'),
(67, 67, 0, '2025-06-08 21:15:14', '2025-06-08 21:15:14'),
(68, 68, 0, '2025-06-08 21:17:07', '2025-06-08 21:17:07'),
(69, 69, 0, '2025-06-08 21:19:02', '2025-06-08 21:19:02'),
(70, 70, 0, '2025-06-08 21:21:12', '2025-06-08 21:21:12'),
(71, 71, 0, '2025-06-08 21:22:38', '2025-06-08 21:22:38'),
(72, 72, 0, '2025-06-08 21:24:52', '2025-06-08 21:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `id_transaksi` bigint UNSIGNED DEFAULT NULL,
  `id_keranjang` bigint UNSIGNED DEFAULT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_produk`, `id_user`, `id_transaksi`, `id_keranjang`, `total_harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 8, NULL, 2, 12000.00, 1, '2025-06-07 14:25:56', '2025-06-07 14:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` decimal(10,2) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `lead_time` int NOT NULL DEFAULT '0',
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `kode_produk`, `harga_beli`, `harga_jual`, `lead_time`, `deskripsi`, `gambar`, `exp`, `created_at`, `updated_at`) VALUES
(1, 'Minyak Sabrina', '2616885672904', 10000.00, 12000.00, 5, 'Minyak kemasan 1 kilo', 'images/rFHU474MMPXwKJlYNa4aJs4RlbV0bMNfBlOKXNwG.jpg', '2025-06-24', '2025-06-04 21:42:48', '2025-06-07 20:22:28'),
(2, 'Minyak sedaap 1 Liter', '8998866501026', 235000.00, 240000.00, 0, 'Minyak sedaap kemasan 1 Liter \r\nNote*\r\nHarga Perdos', NULL, '2027-06-18', '2025-06-08 06:08:34', '2025-06-08 06:08:34'),
(3, 'Minyak Fitri 400ml', '8992946533662', 105000.00, 110000.00, 0, 'Minyak Fitri kemasan 400ml', NULL, '2027-03-26', '2025-06-08 06:11:36', '2025-06-08 06:11:36'),
(4, 'Minyak Fitri 200ml', '8992946534676', 55000.00, 60000.00, 0, 'Minyak Fitri kemasan 200ml\r\nNote* Harga Perdos', NULL, '2026-09-20', '2025-06-08 06:16:05', '2025-06-08 06:16:05'),
(5, 'Le Minerale kemasan 1.5 L', '8996001600399', 65000.00, 70000.00, 0, 'Le Minerale isi 1.5 L\r\nNote*Harga Perdos', NULL, '2028-08-31', '2025-06-08 06:20:49', '2025-06-08 06:20:49'),
(6, 'Aqua 600 ml', '8886008101053', 60000.00, 65000.00, 0, 'Aqua 600ml', NULL, '2027-01-23', '2025-06-08 08:00:46', '2025-06-08 08:00:46'),
(7, 'Teh pucuk harum 350ml', '8996001600146', 63000.00, 66000.00, 0, 'Teh pucuk harum 350ml', NULL, '2026-02-11', '2025-06-08 08:02:57', '2025-06-08 08:02:57'),
(8, 'Floridina 350ml', '8998866500708', 30000.00, 34000.00, 0, 'Floridina 350ml\r\nNote* harga Perdos', NULL, '2025-09-28', '2025-06-08 08:07:18', '2025-06-08 08:07:18'),
(9, 'YouC Jeruk Orange', '8997009510055', 100000.00, 110000.00, 0, 'Note*harga Perdos', NULL, '2025-11-06', '2025-06-08 08:09:28', '2025-06-08 08:09:28'),
(10, 'Nestle susu beruang', '8992696404441', 120000.00, 115000.00, 0, 'Note*harga Perdos', NULL, '2026-04-16', '2025-06-08 08:11:38', '2025-06-08 08:11:38'),
(11, 'Larutan cap kaki tiga', '8995227500278', 6000.00, 7000.00, 1, NULL, NULL, '2028-02-13', '2025-06-08 08:18:39', '2025-06-08 21:27:25'),
(12, 'Brilian sardines in tomato sauce 155 gram', '697478746341', 7000.00, 9000.00, 0, NULL, NULL, '2028-02-22', '2025-06-08 08:22:03', '2025-06-08 08:22:03'),
(13, 'Milano 500gram', '9555678902022', 12000.00, 14000.00, 0, NULL, NULL, '2026-03-12', '2025-06-08 08:24:13', '2025-06-08 08:24:13'),
(14, 'Frisian flag cokelat 370gr', '8992753102204', 12000.00, 15000.00, 0, NULL, NULL, '2025-11-14', '2025-06-08 08:27:04', '2025-06-08 08:27:04'),
(15, 'Cap enak kental manis 370gr', '8992702000025', 15000.00, 54000.00, 0, NULL, NULL, '2026-01-28', '2025-06-08 08:30:38', '2025-06-08 08:30:38'),
(16, 'Frisian flag Putih 370gr', '8992753101207', 10000.00, 20000.00, 0, NULL, NULL, '2026-01-08', '2025-06-08 10:49:30', '2025-06-08 10:49:30'),
(17, 'Mama Lemon 1500ml', '8998866106092', 15000.00, 10000.00, 0, NULL, NULL, '2030-06-08', '2025-06-08 10:51:14', '2025-06-08 10:51:14'),
(18, 'Mama Lemon 950ml', '8998866109864', 15000.00, 198000.00, 0, NULL, NULL, '2031-06-28', '2025-06-08 10:52:33', '2025-06-08 10:52:33'),
(19, 'Sunlight 400ml', '8999999585297', 16000.00, 19000.00, 0, NULL, NULL, '2032-06-29', '2025-06-08 10:54:00', '2025-06-08 10:54:00'),
(20, 'Roma kelapa cream susu vanila', '8996001305249', 15000.00, 12000.00, 0, NULL, NULL, '2025-09-11', '2025-06-08 10:56:19', '2025-06-08 10:56:19'),
(21, 'Rose cream chocolate cream biscuit', '8992839004224', 15000.00, 12000.00, 0, NULL, NULL, '2026-05-09', '2025-06-08 10:58:37', '2025-06-08 10:58:37'),
(22, 'Roma Sandwich chocolate', '8996001305041', 7000.00, 80000.00, 0, NULL, NULL, '2026-03-01', '2025-06-08 11:00:26', '2025-06-08 11:00:26'),
(23, 'Slai O\'lai selai Nanas', '8996001304020', 90000.00, 10000.00, 0, NULL, NULL, '2026-04-01', '2025-06-08 11:02:09', '2025-06-08 11:02:09'),
(24, 'Nabati Wafer krim cokelat 100g', '8993175557733', 6000.00, 7000.00, 0, NULL, NULL, '2026-02-04', '2025-06-08 11:04:55', '2025-06-08 11:04:55'),
(25, 'Sedaap kecap Manis 725g', '8998866202268', 22000.00, 23000.00, 0, NULL, NULL, '2027-03-14', '2025-06-08 11:07:20', '2025-06-08 11:07:20'),
(26, 'Kecap manis nasional', '8991976000755', 17000.00, 19000.00, 0, NULL, NULL, '2027-10-11', '2025-06-08 11:09:12', '2025-06-08 11:09:12'),
(27, 'Kecap sedaap manis 700g', '8998866608084', 18000.00, 19000.00, 0, NULL, NULL, '2026-03-12', '2025-06-08 11:11:37', '2025-06-08 11:11:37'),
(28, 'Sariwangi teh asli', '8999999195649', 60000.00, 770000.00, 0, NULL, NULL, '2027-03-11', '2025-06-08 11:14:14', '2025-06-08 11:14:14'),
(29, 'Teh Sosro celup 30 kantong teh', '8886007811076', 5000.00, 7000.00, 0, NULL, NULL, '2027-03-10', '2025-06-08 11:17:34', '2025-06-08 11:17:34'),
(30, 'Dua Pedang 1Kg', '8995333060796', 12000.00, 13000.00, 0, NULL, NULL, '2026-01-17', '2025-06-08 11:20:05', '2025-06-08 11:20:05'),
(31, 'Gatotkaca 1kg', '8995333032113', 10000.00, 12000.00, 0, NULL, NULL, '2026-01-17', '2025-06-08 11:21:40', '2025-06-08 11:21:40'),
(32, 'KukuBima Ener-G rasa anggur', '8998898830125', 15000.00, 17000.00, 0, NULL, NULL, '2027-03-01', '2025-06-08 11:24:29', '2025-06-08 11:24:29'),
(33, 'Extrajoss isi 12 sachet', '8993058105013', 17000.00, 180000.00, 0, NULL, NULL, '2026-12-01', '2025-06-08 11:27:17', '2025-06-08 11:27:17'),
(34, 'M Susu', '8995150101696', 8000.00, 9000.00, 0, NULL, NULL, '2027-06-10', '2025-06-08 11:29:22', '2025-06-08 11:29:22'),
(35, 'NoMos obat nyamuk', '8997027300072', 4000.00, 5000.00, 0, NULL, NULL, '2026-06-20', '2025-06-08 11:31:03', '2025-06-08 11:31:03'),
(36, 'Indomie rasa Coto Makassar', '0089686043051', 118000.00, 120000.00, 1, NULL, NULL, '2026-08-14', '2025-06-08 11:33:08', '2025-06-08 21:45:45'),
(37, 'Indomie rasa soto Lamongan r', '0089686043419', 150000.00, 160000.00, 1, NULL, NULL, '2025-11-06', '2025-06-08 11:34:53', '2025-06-08 21:49:24'),
(38, 'Indomie rasa mie goreng ayam geprek', '0089686043433', 15000.00, 155000.00, 1, NULL, NULL, '2025-11-27', '2025-06-08 11:36:49', '2025-06-08 21:50:53'),
(39, 'Indomie rasa mie goreng sambal rica-rica', '0089686043273', 155000.00, 160000.00, 1, NULL, NULL, '2026-02-11', '2025-06-08 11:38:15', '2025-06-08 21:43:21'),
(40, 'Indomie rasa mie goreng', '0089686010824', 150000.00, 16000.00, 1, NULL, 'images/8AJgYplRFGV9TzLkMXfRhAm4GLpfVFEPXZnzdQx2.png', '2026-01-14', '2025-06-08 11:39:49', '2025-06-08 22:37:47'),
(41, 'Mie Sedaap Goreng', '8998866200301', 30000.00, 20000.00, 0, NULL, NULL, '2026-09-17', '2025-06-08 11:41:55', '2025-06-08 11:41:55'),
(42, 'Intermie goreng', '0089686021219', 55000.00, 60000.00, 1, NULL, NULL, '2025-10-24', '2025-06-08 11:43:43', '2025-06-08 21:52:58'),
(43, 'Intermie Rasa Soto', '0089686021141', 55000.00, 60000.00, 1, NULL, 'images/6HZsuvJFpJHZk19kZgNuJMWKYx8Klgwt8HeCEbhl.png', '2025-12-25', '2025-06-08 11:46:08', '2025-06-08 22:46:13'),
(44, 'Intermie Rasa Kaldu ayam', '0089686021103', 45000.00, 50000.00, 1, NULL, NULL, '2025-12-27', '2025-06-08 11:48:06', '2025-06-08 21:55:53'),
(45, 'Pop mie sedaap goreng', '8998866200813', 5000.00, 6000.00, 0, NULL, NULL, '2025-12-12', '2025-06-08 20:36:42', '2025-06-08 20:36:42'),
(46, 'Pop mie sedaap rawit bangit rasa ayam jerit', '8998866202930', 40000.00, 50000.00, 1, NULL, NULL, '2025-12-23', '2025-06-08 20:38:19', '2025-06-08 22:08:08'),
(47, 'Pop mie sedaap Rawit bangit rasa bakso bleduk', '8998866203258', 5000.00, 4000.00, 0, NULL, NULL, '2026-02-10', '2025-06-08 20:39:59', '2025-06-08 20:39:59'),
(48, 'Pop Mie Rasa ayam', '089686060027', 5000.00, 6000.00, 0, NULL, NULL, '2026-01-15', '2025-06-08 20:41:11', '2025-06-08 20:41:11'),
(49, 'Pop mie rasa soto ayam', '089686060362', 5000.00, 6000.00, 0, NULL, NULL, '2026-01-13', '2025-06-08 20:42:24', '2025-06-08 20:42:24'),
(50, 'Masako rasa ayam 250g', '8992770034151', 10000.00, 11000.00, 0, NULL, NULL, '2026-09-16', '2025-06-08 20:44:19', '2025-06-08 20:44:19'),
(51, 'Masako rasa ayam 100g', '8992770034175', 5000.00, 6000.00, 0, NULL, NULL, '2026-03-04', '2025-06-08 20:45:41', '2025-06-08 20:45:41'),
(52, 'Sajiku serbaguna 220g', '8992770084064', 6000.00, 7000.00, 0, NULL, NULL, '2026-10-16', '2025-06-08 20:47:13', '2025-06-08 20:47:13'),
(53, 'Sajiku serbaguna 75g', '8992770061010', 2000.00, 3000.00, 0, NULL, NULL, '2026-05-14', '2025-06-08 20:48:35', '2025-06-08 20:48:35'),
(54, 'Ajinomoto micin 250g', '8992770011091', 10000.00, 12000.00, 0, NULL, NULL, '2033-06-25', '2025-06-08 20:51:46', '2025-06-08 20:51:46'),
(55, 'Ajinomoto micin 100g', '8992770011084', 6000.00, 7000.00, 0, NULL, NULL, '2032-06-26', '2025-06-08 20:53:04', '2025-06-08 20:53:04'),
(56, 'Ajinomoto micin 16g', '8992770011152', 500.00, 1000.00, 0, NULL, NULL, '2032-06-26', '2025-06-08 20:54:42', '2025-06-08 20:54:42'),
(57, 'Ekomie', '8998866200561', 9000.00, 10000.00, 0, NULL, NULL, '2025-12-12', '2025-06-08 20:56:06', '2025-06-08 20:56:06'),
(58, 'Bihun jagung bijag 300g', '8997011700123', 6000.00, 7000.00, 0, NULL, NULL, '2026-10-25', '2025-06-08 20:57:12', '2025-06-08 20:57:12'),
(59, 'ABC Squash Delight Nanas', '711844150027', 13000.00, 14000.00, 0, NULL, NULL, '2026-04-09', '2025-06-08 20:59:33', '2025-06-08 20:59:33'),
(60, 'ABC Squash Delight Jeruk Floridina', '711844150003', 13000.00, 14000.00, 0, NULL, NULL, '2027-09-30', '2025-06-08 21:00:57', '2025-06-08 21:00:57'),
(61, 'Sirup rasa pisang Ambon', '8997018720018', 9000.00, 6000.00, 0, NULL, NULL, '2026-12-01', '2025-06-08 21:02:46', '2025-06-08 21:02:46'),
(62, 'Baby Happy body fit pants ukuran M', '8998866500463', 11000.00, 12000.00, 0, NULL, NULL, '2027-11-19', '2025-06-08 21:04:49', '2025-06-08 21:04:49'),
(63, 'Hers protex Sachet 23Cm', '8998866500357', 5000.00, 6000.00, 0, NULL, NULL, '2027-06-25', '2025-06-08 21:06:55', '2025-06-08 21:06:55'),
(64, 'Hers protex naturals daun sirih 23,5cm', '8998866627047', 5000.00, 6000.00, 0, NULL, NULL, '2028-01-28', '2025-06-08 21:08:33', '2025-06-08 21:08:33'),
(65, 'Hers protex comfort night Sachet 30Cm', '8998866615174', 9000.00, 10000.00, 1, NULL, NULL, '2028-01-14', '2025-06-08 21:10:26', '2025-06-08 21:33:29'),
(66, 'Prochiz gold cheddar 160g', '8997014450216', 15000.00, 17000.00, 0, NULL, NULL, '2026-03-10', '2025-06-08 21:13:08', '2025-06-08 21:13:08'),
(67, 'Antaka bumbu rasa balado', '8997028630017', 22000.00, 25000.00, 0, NULL, NULL, '2026-09-26', '2025-06-08 21:15:14', '2025-06-08 21:15:14'),
(68, 'MaxCreamer 500g', '9311931183160', 25000.00, 27000.00, 0, NULL, NULL, '2026-10-22', '2025-06-08 21:17:07', '2025-06-08 21:17:07'),
(69, 'Swallow Lily sachet o color', '8991689890384', 45000.00, 47000.00, 0, NULL, NULL, '2027-07-24', '2025-06-08 21:19:02', '2025-06-08 21:19:02'),
(70, 'Posh deo lotion whitening sachet', '8998866202374', 15000.00, 17000.00, 0, NULL, NULL, '2027-11-19', '2025-06-08 21:21:12', '2025-06-08 21:21:12'),
(71, 'Tora moka kopi susu sachet', '8996001410042', 15000.00, 1000.00, 0, NULL, NULL, '2025-11-01', '2025-06-08 21:22:38', '2025-06-08 21:22:38'),
(72, 'Nabati Wafer krim cokelat 37g', '8993175535885', 3000.00, 4000.00, 0, NULL, NULL, '2026-01-10', '2025-06-08 21:24:52', '2025-06-08 21:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `restock`
--

CREATE TABLE `restock` (
  `id` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restock`
--

INSERT INTO `restock` (`id`, `id_produk`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-06-05 01:26:44', '2025-06-05 01:26:44'),
(2, 1, '2025-06-07 20:14:21', '2025-06-07 20:14:21'),
(4, 2, '2025-06-08 21:25:52', '2025-06-08 21:25:52'),
(5, 12, '2025-06-08 21:26:07', '2025-06-08 21:26:07'),
(15, 41, '2025-06-08 22:01:16', '2025-06-08 22:01:16'),
(18, 48, '2025-06-08 22:13:43', '2025-06-08 22:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AUnfX3MKWnDYcTp9OE1c6nQbjeG7McztPWublMjp', NULL, '182.5.6.201', 'Mozilla/5.0 (X11; Linux x86_64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaERYclh0dGFnNjVXbk1XOHpDRklJaG5aQnR1d2lvbkxHamNKaGRaVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdWR0b2tvZGl2YS5jeW91L2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1749428936),
('di5EQqyM0SzpDyGV1EdRVFEyyz7GWgxRufiZsrcP', NULL, '182.5.6.201', 'Mozilla/5.0 (X11; Linux x86_64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia2lUTFlnYkplOXd2SEJDTGZ6ZG9CejdINFhqb0FiQlRBcmM4NjI3SyI7czo1OiJlcnJvciI7czozMToiU2lsYWhrYW4gbG9naW4gdGVybGViaWggZGFodWx1LiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjU6ImVycm9yIjt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQyOiJodHRwczovL3VkdG9rb2RpdmEuY3lvdS9hZG1pbmd1ZGFuZy9wcm9kdWsiO319', 1749429551),
('ll8NdKDTMtA3sDzoeKGw0AjGEK24xMkLwnSix9R2', NULL, '182.5.6.201', 'Mozilla/5.0 (X11; Linux x86_64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiemd4R2hPMXZNcXVtWkJRVWlTUnBXVU5yTVNZTTVxS2Uwck9JT25vWSI7czo1OiJlcnJvciI7czozMToiU2lsYWhrYW4gbG9naW4gdGVybGViaWggZGFodWx1LiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjU6ImVycm9yIjt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwczovL3VkdG9rb2RpdmEuY3lvdS9yZXNlbGxlci9rYXRhbG9nIjt9fQ==', 1749428935),
('TiBE4qqMPWYJmR6h73que4D2Y9E2k2KuKz2J27ej', 4, '182.5.9.99', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieTdnZVVjYjNqVk9hUnVFbnp6ekJsN2txYTFoYUR0bTIzeVhDZ3pWSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vdWR0b2tvZGl2YS5jeW91L2FkbWluZ3VkYW5nL2JhcmFuZy1tYXN1ayI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1749428268),
('ulf5IaEVjJEsKyuGtoqyKU8Y3RrlDgqAv8cl1uLv', 1, '182.5.6.201', 'Mozilla/5.0 (X11; Linux x86_64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibWFCRDBKVWtVS2o5RmpCTmw0SVM3ejBFV1FRaGxMSFpqNzJvQmVlcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vdWR0b2tvZGl2YS5jeW91L3Jlc2VsbGVyL2thdGFsb2c/cT1pbnRlcm1pZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1749430164),
('VpljEEuAhXlPbw0HfEh1BTTNmsSRaFWFXeGVxNwt', 4, '182.5.6.201', 'Mozilla/5.0 (X11; Linux x86_64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib3RZVlpXdzdpZENzRElpbDlxT0xNblRpbjV4cGRlR2haS0xtTXdpdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vdWR0b2tvZGl2YS5jeW91L2FkbWluZ3VkYW5nL3Byb2R1ayI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1749430209);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `id_kurir` bigint UNSIGNED DEFAULT NULL,
  `status` enum('pending','diproses','dikirim','ditolak','diterima','selesai','batal') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status_pembayaran` enum('belum_bayar','lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_bayar',
  `metode_pembayaran` enum('cod','transfer','tunai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admintoko','admingudang','pemiliktoko','reseller','kurir') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role`, `phone`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'reseller1@example.com', 'Reseller 1', '$2y$12$lU0Uh6hRF4SkRSujI1wsVet07SVDzG8x95RcGNg3cjFEe37YFbc7G', 'reseller', '082005491471', NULL, NULL, '2025-06-04 21:42:46', '2025-06-04 21:42:46'),
(2, 'reseller2@example.com', 'Reseller 2', '$2y$12$iiyKjfNGoPqtU7CAQspQ2eqo/FkKmYkOzMWaHL1VWi23xrkyplViy', 'reseller', '082053389136', NULL, NULL, '2025-06-04 21:42:46', '2025-06-04 21:42:46'),
(3, 'admintoko@example.com', 'admin toko', '$2y$12$OPg/BZZbB6aERDyyMb/WOe1j6vWgt3Wli4aqx/xt46w42EBpUC0N.', 'admintoko', '082075300170', NULL, NULL, '2025-06-04 21:42:47', '2025-06-04 21:42:47'),
(4, 'admingudang@example.com', 'admin gudang', '$2y$12$leWMKbk6swNKcIJx/Nns9Osjkdaw.eVJeYS.RYoF0WJkV/G9wqCle', 'admingudang', '082051675999', NULL, 'foto/WqBnO1JPJ4IjZukaBIGUrNVxRJ8EshPBm7LN1NN4.jpg', '2025-06-04 21:42:47', '2025-06-04 21:42:47'),
(5, 'pemiliktoko@example.com', 'pemilik toko', '$2y$12$LgTzywZ3CXUpY4XHIbvvYu/QPuasaedvAbdWMnWJAV1FhogNABx4K', 'pemiliktoko', '082032654702', NULL, NULL, '2025-06-04 21:42:48', '2025-06-04 21:42:48'),
(6, 'kurir1@example.com', 'Kurir 1', '$2y$12$sE33cXViEzWhw8qtaUXBEuTwyQGuUmHqbZKG3MlmUWMPT4p6v/2XG', 'kurir', '082006524838', NULL, NULL, '2025-06-04 21:42:48', '2025-06-04 21:42:48'),
(7, 'kurir2@example.com', 'Kurir 2', '$2y$12$u84tf5z7oNgjguWOxO0O..pBgtNViJgrMKZoCinz5qrJfD24oTaTm', 'kurir', '082001325804', NULL, NULL, '2025-06-04 21:42:48', '2025-06-04 21:42:48'),
(8, 'anisahandayani2303@gmail.com', 'Nisa', '$2y$12$LqN2T.S47SDicTnyIHgs4.nUDqAgcEPth2avhV71Q6WoLFDRYsJp6', 'reseller', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_pemesanan_produk`
--
ALTER TABLE `biaya_pemesanan_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biaya_pemesanan_produk_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `biaya_penyimpanan_produk`
--
ALTER TABLE `biaya_penyimpanan_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biaya_penyimpanan_produk_id_produk_foreign` (`id_produk`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjang_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mutasi_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `persediaan`
--
ALTER TABLE `persediaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persediaan_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id_produk_foreign` (`id_produk`),
  ADD KEY `pesanan_id_user_foreign` (`id_user`),
  ADD KEY `pesanan_id_transaksi_foreign` (`id_transaksi`),
  ADD KEY `pesanan_id_keranjang_foreign` (`id_keranjang`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produk_kode_produk_unique` (`kode_produk`);

--
-- Indexes for table `restock`
--
ALTER TABLE `restock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restock_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id_user_foreign` (`id_user`),
  ADD KEY `transaksi_id_kurir_foreign` (`id_kurir`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya_pemesanan_produk`
--
ALTER TABLE `biaya_pemesanan_produk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `biaya_penyimpanan_produk`
--
ALTER TABLE `biaya_penyimpanan_produk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `persediaan`
--
ALTER TABLE `persediaan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `restock`
--
ALTER TABLE `restock`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biaya_pemesanan_produk`
--
ALTER TABLE `biaya_pemesanan_produk`
  ADD CONSTRAINT `biaya_pemesanan_produk_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `biaya_penyimpanan_produk`
--
ALTER TABLE `biaya_penyimpanan_produk`
  ADD CONSTRAINT `biaya_penyimpanan_produk_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `persediaan`
--
ALTER TABLE `persediaan`
  ADD CONSTRAINT `persediaan_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_id_keranjang_foreign` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restock`
--
ALTER TABLE `restock`
  ADD CONSTRAINT `restock_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_kurir_foreign` FOREIGN KEY (`id_kurir`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
