-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2026 at 09:36 PM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql_pucang2_si_sppg_egiehariansyah_my_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `namalengkap`) VALUES
(1, 'ethan', '$2y$12$PBoMxQhq1k8jxE9FR7Ro9uHaSwVkazl3gDx3ruVHfxdC5V8r97EHG', 'Ethan Timmy Van Harry'),
(2, 'ndra', '$2y$12$4n2f6lUBoYPp/wXlLYHFu.UG8IqCVSJFBeT8hcV82c6oqlU0ZOeI.', 'Wahyu Indra Setiawan'),
(3, 'dlione', '$2y$12$r55BmLQjqoxzMy2ucPJPQOdYYm0gtCxxhWXEgkOWaWKjConsJJ1CW', 'Ahmad Nadliful Ngizza'),
(4, 'bin', '$2y$12$khq.pgerJiT33uW0gvXqyeid555qug3TLSPGq69luTxn3XF0ZwjhW', 'Rizky Setiawan'),
(5, 'dinda', '$2y$12$OSbztb/DFZRFBFrvPDnaD.wQ0uhxmNgphvkf/uMYVe4.eEozzJUTe', 'Yasmine Ayu Adinda'),
(6, 'hana', '$2y$12$Yvfl9vDr3SvOyL/HazOkdeCqxEo5CrifIVWV1DuyZBvkSd5JAjtCS', 'Hana Adlilia Rifaie');

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
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namamenu` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `menu_utama` varchar(255) DEFAULT NULL,
  `lauk` varchar(255) DEFAULT NULL,
  `saus` varchar(255) DEFAULT NULL,
  `dessert` varchar(255) DEFAULT NULL,
  `energi_besar` varchar(255) DEFAULT NULL,
  `protein_besar` varchar(255) DEFAULT NULL,
  `lemak_besar` varchar(255) DEFAULT NULL,
  `karbo_besar` varchar(255) DEFAULT NULL,
  `energi_kecil` varchar(255) DEFAULT NULL,
  `protein_kecil` varchar(255) DEFAULT NULL,
  `lemak_kecil` varchar(255) DEFAULT NULL,
  `karbo_kecil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `namamenu`, `tanggal`, `foto`, `menu_utama`, `lauk`, `saus`, `dessert`, `energi_besar`, `protein_besar`, `lemak_besar`, `karbo_besar`, `energi_kecil`, `protein_kecil`, `lemak_kecil`, `karbo_kecil`) VALUES
(1, 'Nasi Rendang Ikan', '2026-05-26', 'rendang-ikan-tongkol-foto-resep-utama.jpg', 'Nasi, Ikan tongkol', 'Tomat, Timun', NULL, 'Buah Melon', '300', '15', '10', '100', '250', '12', '8', '90');

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
(4, '2026_05_20_235247_create_admin_table', 1),
(5, '2026_05_20_235254_create_menu_table', 1),
(6, '2026_05_20_235255_create_pelayanan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('2KTjM4PxP64ZYGZizLN7inmSVmo9u2bZ5JjKfjez', NULL, '103.144.170.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMG1Za3E5VHdaNU93SFJMbGhVNVp1UENVUXF6dXNYNVF1MFB2YWlCWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkL21lbnUiO3M6NToicm91dGUiO3M6NDoibWVudSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779687777),
('6uHVJkQD0O80svfFRT5O2LOjWtnNASjwx2KdC2GJ', NULL, '45.154.98.214', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQW01eWg1aXNQdE8yY25MTUFUZG9adXBvU1cxTHdadUp6dXZqbEducCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9wdWNhbmcyLnNpLXNwcGcuZWdpZWhhcmlhbnN5YWgubXkuaWQiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779714570),
('7gydlSm4UWRV9pUEIZ4QHhss9nfsf9ATyca1ZH8U', NULL, '36.50.157.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWG8xWDJwaVMyN1lVMGVkYU82ZlZZTkVTSkhvdnJoNlFwSkZaT0FlViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2MzoiaHR0cHM6Ly9wdWNhbmcyLnNpLXNwcGcuZWdpZWhhcmlhbnN5YWgubXkuaWQvYWRtaW4vdGFtYmFoX2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkL2FkbWluL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779683650),
('A2oy0V8zxJSA2iyjO5MiD74h9cWQxrjF8d1hbCre', NULL, '34.221.43.244', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.7778.178 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXZFcVZFN0tBTWtWMmJRVFdKNnFna01nR3ZiNzVxZVlnWVN2RVdyTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1779695872),
('DIKljLObmqJqDWFTtaaNRAIwpyOZX27hvdv9rrhW', NULL, '185.247.137.119', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTBlclBoY0tCQW1qNkt1NVhpRnNESWhjNElldktORG9tSzdNYnZYRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1779688463),
('GQli8kLzP5aorrq8pvNxqIjK1O7dE0djIEi3KTlY', NULL, '141.148.153.213', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGcyVFh3dnBTcG9nTFZtbHoyVUpRUzI1ZE9GQ1R4NDgxVUZKM2RvNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1779693333),
('JsnvKRcRE1PJYtGvS8vWCT72gR6muw3NCmsMRPkm', NULL, '54.87.247.130', 'python-requests/2.31.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiY3NtSDBKSGR4UHBvQXNvcHVPR250cmxWeHRmTG45eVo1MUdEWE13SCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779692423),
('jym3nv4SCd9EnH7D0nGplrGBrD50z8uCDmofbqkk', NULL, '87.236.176.92', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUpmZEVQcmVOZ2Rtd2pQTEdwYWh2VnJmOUEwNGpLUUlVVkdmU2J4aSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9wdWNhbmcyLnNpLXNwcGcuZWdpZWhhcmlhbnN5YWgubXkuaWQiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1779714227),
('k3XzHonW6VoS4kH3bgQHYfduj8QfBsIySeJ2Vfh5', 2, '103.144.170.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibURSUTllaVRHTklsTVg0c293UG1PREVzallVZHZzUXA1aDBydnN4ZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkL2FkbWluIjtzOjU6InJvdXRlIjtzOjE1OiJhZG1pbi5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1779690118),
('NiQPFdIRFc7rxlGkZUk3J9ZtqgOJAvPe1qBYjAUI', NULL, '117.103.171.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiem5sVWFoY251VndqeUxTaTlrc1R6OUc2TFRNSG5wRG5KaU5xRGpLdCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NzoiaHR0cHM6Ly9wdWNhbmcyLnNpLXNwcGcuZWdpZWhhcmlhbnN5YWgubXkuaWQvYWRtaW4vcHJvZmlsIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkL2FkbWluL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779689302),
('qneb8TlWroM9dJXEsNNGVh3hpxGIO0gPYPWvf2YE', NULL, '36.73.34.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFdkNHNLTVp4VUFPcTl4WUwyWTJIWmtKSEplWWttUmZkS21uVldPWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1779716080),
('RYowkfyjbuw2TZrjozpwhmLkdtDOP5TUgSGIahY0', NULL, '103.116.13.229', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRnpFRDh3NHBydERHUklPUFI1M1JmVkgySVFJQUpXZkVLRnJnWE42QiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2MDoiaHR0cHM6Ly9wdWNhbmcyLnNpLXNwcGcuZWdpZWhhcmlhbnN5YWgubXkuaWQvYWRtaW4vcGVsYXlhbmFuIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vcHVjYW5nMi5zaS1zcHBnLmVnaWVoYXJpYW5zeWFoLm15LmlkL2FkbWluL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779683645);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

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
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
