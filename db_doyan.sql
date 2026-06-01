-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2026 pada 14.24
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_doyan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'B1pmgymplOJrxKjT3Ui5IyFI9L2SR7OersSF206m', NULL, '2026-05-08 21:09:06', '2026-05-08 21:09:06'),
(9, 'tCq4NVqRb010qbWWG6OAjOr6wubvBXaW8Tlnqqb6', NULL, '2026-05-11 21:50:29', '2026-05-11 21:50:29'),
(10, 'Nvke4eFC4vgGmBCmlkNg7AY1CQIUZRL2J3hmKU8z', NULL, '2026-05-21 06:01:05', '2026-05-21 06:01:05'),
(13, NULL, 3, '2026-05-21 06:32:23', '2026-05-21 06:32:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 10, '2026-05-08 21:09:06', '2026-05-08 21:09:06'),
(9, 9, 10, 1, '2026-05-11 21:50:29', '2026-05-11 21:50:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_04_034350_create_carts_table', 1),
(5, '2026_05_04_034350_create_products_table', 1),
(6, '2026_05_04_034351_create_cart_items_table', 1),
(7, '2026_05_05_140628_add_roles_and_stock_and_orders_tables', 1),
(8, '2026_05_09_034919_add_customer_details_to_orders_table', 2),
(9, '2026_05_10_114809_add_payment_method_to_orders_table', 3),
(10, '2026_05_11_203900_add_customer_email_to_orders_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `total_price`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, NULL, NULL, NULL, 890000.00, 'completed', NULL, '2026-05-08 20:45:38', '2026-05-08 20:53:57'),
(2, 3, 'yoga', '12312321321', NULL, 'asfafadsfafdsfa', 1780000.00, 'pending', NULL, '2026-05-08 21:09:48', '2026-05-08 21:09:48'),
(3, 3, 'saya', '23123123123', NULL, 'asdasdasda', 250000.00, 'pending', 'Transfer Bank', '2026-05-11 05:24:58', '2026-05-11 05:24:58'),
(4, 3, 'ghgfh', '213123', NULL, 'asdadsasd', 178000.00, 'pending', 'BCA', '2026-05-11 06:37:53', '2026-05-11 06:37:53'),
(5, 3, 'fghfghf', '1231231', NULL, 'asdadsad', 355000.00, 'pending', 'COD', '2026-05-11 06:38:21', '2026-05-11 06:38:21'),
(6, 3, 'test', '123124344', 'asdsad@fsd', 'asdadasda', 250000.00, 'pending', 'COD', '2026-05-11 06:56:18', '2026-05-11 06:56:18'),
(7, 3, 'mamat', '3143434', 'sada@sad', 'asdwqdqw', 197000.00, 'completed', 'E-Wallet', '2026-05-11 21:58:11', '2026-05-21 06:12:16'),
(8, 3, 'rafif', '12909022', 'asdsad@fsd', 'amamkas', 355000.00, 'pending', 'COD', '2026-05-21 06:24:01', '2026-05-21 06:24:01'),
(9, 3, 'rafif2', '08123993393', 'asda@fafa', 'asdasd', 197000.00, 'pending', 'COD', '2026-05-21 06:31:26', '2026-05-21 06:31:26'),
(10, 4, 'rafif3', '12312321321', 'rafif.nafy@gmail.com', 'madukoro kajoran', 449000.00, 'cancelled', 'COD', '2026-05-21 06:36:44', '2026-05-21 06:39:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 178000.00, '2026-05-08 20:45:38', '2026-05-08 20:45:38'),
(2, 2, 1, 10, 178000.00, '2026-05-08 21:09:48', '2026-05-08 21:09:48'),
(3, 3, 2, 1, 250000.00, '2026-05-11 05:24:58', '2026-05-11 05:24:58'),
(4, 4, 1, 1, 178000.00, '2026-05-11 06:37:53', '2026-05-11 06:37:53'),
(5, 5, 3, 1, 355000.00, '2026-05-11 06:38:21', '2026-05-11 06:38:21'),
(6, 6, 2, 1, 250000.00, '2026-05-11 06:56:18', '2026-05-11 06:56:18'),
(7, 7, 6, 1, 197000.00, '2026-05-11 21:58:11', '2026-05-11 21:58:11'),
(8, 8, 3, 1, 355000.00, '2026-05-21 06:24:01', '2026-05-21 06:24:01'),
(9, 9, 6, 1, 197000.00, '2026-05-21 06:31:26', '2026-05-21 06:31:26'),
(10, 10, 4, 1, 449000.00, '2026-05-21 06:36:44', '2026-05-21 06:36:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `weight` int(11) DEFAULT NULL COMMENT 'in grams',
  `price_per_gram` decimal(10,2) DEFAULT NULL,
  `vector` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`vector`)),
  `category` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `weight`, `price_per_gram`, `vector`, `category`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Paket 2 (2-3 Orang)', 'Nikmati pengalaman grill premium di rumah bersama keluarga atau teman! Paket lengkap ini sudah termasuk daging berkualitas, pelengkap, saus khas Doyan, hingga margarin. Siap masak dan praktis!\r\n\r\nIsi Paket:\r\n- 500 gr beef slice\r\n- 250 gr chicken slice\r\n- 1 pack side dish\r\n- 1 pack onion + selada\r\n- 2 cups sauce\r\n- 1 cup margarin', 178000.00, 49, 750, 237.33, '[178000,750]', 'grill', 'products/BY3XSiydGAzw4SQvo6Q7cOGXKN5GOBW5LyJQWnBD.jpg', '2026-05-08 20:37:23', '2026-06-01 03:53:10'),
(2, 'Paket 4 (4-5 Orang)', 'Nikmati pengalaman grill premium di rumah bersama keluarga atau teman! Paket lengkap ini sudah termasuk daging berkualitas, pelengkap, saus khas Doyan, hingga margarin. Siap masak dan praktis!\r\n\r\nIsi Paket:\r\n- 500 gr beef slice\r\n- 250 gr chicken slice\r\n- 250 gr saikoro wagyu\r\n- 2 packs side dish\r\n- 1 pack onion + selada\r\n- 4 cups sauce\r\n- 1 cup margarin', 250000.00, 48, 1000, 250.00, '[250000,1000]', 'grill', 'products/3UDTpA2JM1dxGkKSP0RrA4RKrh2lBrIYuNxTBRDD.jpg', '2026-05-08 20:37:23', '2026-06-01 03:53:27'),
(3, 'Paket 6 (6-7 Orang)', 'Nikmati pengalaman grill premium di rumah bersama keluarga atau teman! Paket lengkap ini sudah termasuk daging berkualitas, pelengkap, saus khas Doyan, hingga margarin. Siap masak dan praktis!\r\n\r\nIsi Paket:\r\n- 500 gr beef slice\r\n- 500 gr chicken slice\r\n- 500 gr saikoro wagyu\r\n- 3 packs side dish\r\n- 2 packs union + selada\r\n- 6 cups sauce\r\n- 2 cups margarin', 355000.00, 48, 1500, 236.67, '[355000,1500]', 'grill', 'products/iATvKbjdMmWk2UShovgozxHHMoh9QGJV9Wp8Yc95.jpg', '2026-05-08 20:37:23', '2026-06-01 03:53:41'),
(4, 'Paket 8 (8-9 Orang)', 'Nikmati pengalaman grill premium di rumah bersama keluarga atau teman! Paket lengkap ini sudah termasuk daging berkualitas, pelengkap, saus khas Doyan, hingga margarin. Siap masak dan praktis!\r\n\r\nIsi Paket:\r\n- 1000 gr beef slice\r\n- 500 gr chicken slice\r\n- 500 gr saikoro wagyu\r\n- 4 packs side dish\r\n- 2 packs union + selada\r\n- 6 cups sauce\r\n- 2 cups margarin', 449000.00, 49, 2000, 224.50, '[449000,2000]', 'grill', 'products/HSNBN3o6DGZmvK5p436mx8DY7HT3PcCcIiUR048I.jpg', '2026-05-08 20:37:23', '2026-06-01 03:53:58'),
(5, 'US Beef Marinated 500gr', NULL, 99000.00, 50, 500, 198.00, '[99000,500]', 'frozen', 'products/nWiKMC9XcJf9iWhCIU5gwfdNfX5Rewxejilr1qVN.png', '2026-05-08 20:37:23', '2026-06-01 04:34:57'),
(6, 'US Beef Marinated 1000gr', NULL, 197000.00, 48, 1000, 197.00, '[197000,1000]', 'frozen', 'products/NoJTyEioTzdzQLirIJFdlW7mU4uD5lsk8CcJis9N.png', '2026-05-08 20:37:23', '2026-06-01 04:35:24'),
(7, 'US Beef Plain 250gr', NULL, 48500.00, 50, 250, 194.00, '[48500,250]', 'frozen', 'products/dfsW63UBJDpLZvXs9Xa3k6ffoTHGeIlhER9oBERs.png', '2026-05-08 20:37:23', '2026-06-01 04:35:42'),
(8, 'US Beef Plain 500gr', NULL, 93000.00, 50, 500, 186.00, '[93000,500]', 'frozen', 'products/6vn5ruFqMEQcbrKgDllbKIUGnskCBiuAeb0YK3n1.png', '2026-05-08 20:37:23', '2026-06-01 04:36:02'),
(9, 'US Beef Plain 1000gr', NULL, 187000.00, 50, 1000, 187.00, '[187000,1000]', 'frozen', 'products/K54HcVBDBlOBgpUpGyvuxrsLSl3wrJo5bbaLoNCg.png', '2026-05-08 20:37:23', '2026-06-01 04:36:14'),
(10, 'Chicken Marinated 500gr', NULL, 60000.00, 50, 500, 120.00, '[60000,500]', 'frozen', 'products/xSbkgieH9JMAA51L40CngAM2gTJRiGt2bQVBDWbX.png', '2026-05-08 20:37:23', '2026-06-01 04:44:37'),
(11, 'Chicken Marinated 1000gr', NULL, 106000.00, 50, 1000, 106.00, '[106000,1000]', 'frozen', 'products/xyYYANzqTUuCVBJdFErgo0oxCs78I97e5O5VUk6r.png', '2026-05-08 20:37:23', '2026-06-01 04:44:53'),
(12, 'Chicken Plain 250gr', NULL, 25000.00, 50, 250, 100.00, '[25000,250]', 'frozen', 'products/lpwN2yM9OXrD6RCSJwwdIRfD1unUD7qcqYuXEYmA.png', '2026-05-08 20:37:23', '2026-06-01 04:45:17'),
(13, 'Chicken Plain 500gr', NULL, 50000.00, 50, 500, 100.00, '[50000,500]', 'frozen', 'products/vU8OYrIj6YK9IbHDumTDD047xtheNHcJ9lLZosWy.png', '2026-05-08 20:37:23', '2026-06-01 04:45:30'),
(14, 'Chicken Plain 1000gr', NULL, 96000.00, 50, 1000, 96.00, '[96000,1000]', 'frozen', 'products/C4ZpXKSXJPd4CNwDCy3xjAERTOWaWUHSmX2BQr4L.png', '2026-05-08 20:37:24', '2026-06-01 04:45:42'),
(15, 'Saikoro Wagyu 250gr', NULL, 49500.00, 50, 250, 198.00, '[49500,250]', 'frozen', 'products/CiqWuc3l2qmCi2YZClon4X6qw5OYhC7ddwLLoUVR.png', '2026-05-08 20:37:24', '2026-06-01 04:22:20'),
(16, 'Saikoro Wagyu 500gr', NULL, 99000.00, 50, 500, 198.00, '[99000,500]', 'frozen', 'products/ybiVYLMgYeL5l80VwONeHjCoSyPspqRcyrWOtmW1.png', '2026-05-08 20:37:24', '2026-06-01 04:22:40'),
(17, 'Saikoro Wagyu 1000gr', NULL, 195000.00, 50, 1000, 195.00, '[195000,1000]', 'frozen', 'products/hbwdZYIHLCxTk1EbIaG9XSqNEPaKJPpjCKcJKH0Q.png', '2026-05-08 20:37:24', '2026-06-01 04:22:53'),
(22, 'Meatball & Sausage', NULL, 15000.00, 50, NULL, NULL, NULL, 'frozen', 'products/DVGaT5sk8QlT2iaoxaeGpYQklK31PLBPZ2zxGzpi.png', '2026-06-01 04:24:26', '2026-06-01 04:24:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('l9iU6yUqyxCUbc5Ro3I5wVrcXr87n1bogBNs04Jh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 OPR/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoielIydGVtYnFNaGNpTUdJZGYxUVRxdHQ2aFltTVZsT2IxcjZKSHR6RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1780315763);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Doyan', 'admin@doyan.com', '2026-05-08 20:37:22', 'admin', '$2y$12$KzTFkFKGPLzTMfIGnXe7XenIQ6c6mUpotWmDQ5Spc1gMA3kthD8t6', 'ARqBROUbsaa4xdlpm7CY6vUmyPwwdYXiNmcWCp6OHPBi9o9VmiZ8TqA3l0bq', '2026-05-08 20:37:23', '2026-05-08 20:37:23'),
(2, 'User Biasa', 'user@example.com', '2026-05-08 20:37:23', 'user', '$2y$12$yjk4bQrDDpd6k5IC.30u6uYw6hLfUT2I3E5FL0EIDoQ9ydQeVWToO', 'CnJ1dWAfhH', '2026-05-08 20:37:23', '2026-05-08 20:37:23'),
(3, 'rann', 'abc@gg', NULL, 'user', '$2y$12$xwM.9.92rKcmpJ4gPwNQV.8eCWQh2u/mM2ZwokSG5.r3W453af9A2', NULL, '2026-05-08 20:45:09', '2026-05-08 20:45:09'),
(4, 'rafif', 'rafif@gmail.com', NULL, 'user', '$2y$12$oYTL7seqEDqvvMcMl2RQ5eUerfKod7Jge3xKsTZtg4k.H9TL7gY.y', NULL, '2026-05-21 06:34:22', '2026-05-21 06:34:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
