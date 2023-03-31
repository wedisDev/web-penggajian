-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2023 at 05:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `bonus_omzets`
--

CREATE TABLE `bonus_omzets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cabang` bigint(20) UNSIGNED NOT NULL,
  `id_jabatan` bigint(20) UNSIGNED DEFAULT NULL,
  `bonus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonus_omzets`
--

INSERT INTO `bonus_omzets` (`id`, `id_cabang`, `id_jabatan`, `bonus`, `created_at`, `updated_at`) VALUES
(10, 1, NULL, 120000000, '2023-01-11 08:29:32', '2023-01-11 08:29:32'),
(11, 2, NULL, 130000000, '2023-01-11 08:29:46', '2023-01-11 08:37:04'),
(12, 3, NULL, 10, '2023-01-11 08:29:52', '2023-01-11 08:36:54'),
(13, 3, NULL, 12121212, '2023-03-13 01:40:40', '2023-03-13 01:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `cabangs`
--

CREATE TABLE `cabangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `omzet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cabangs`
--

INSERT INTO `cabangs` (`id`, `nama_cabang`, `alamat`, `created_at`, `updated_at`, `omzet`) VALUES
(1, 'Kantin Tante Royal', 'Jl. Raya Tante Royal No.1', NULL, '2023-03-13 01:48:13', 121212),
(2, 'Kantin Tante DTC', 'Jl. Raya Tante DTC No.1', NULL, '2023-03-13 02:23:29', 250000000),
(3, 'Kantin Tante Pasar Atom', 'Jl. Raya Tante Pasar Atom No.1', NULL, '2023-03-13 01:51:50', 10000),
(7, 'Kantin Tante Embong Wungu', 'Jl. Embong Wungu No.1', '2023-03-25 11:37:15', '2023-03-25 11:37:15', NULL);

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
-- Table structure for table `golongans`
--

CREATE TABLE `golongans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_golongan` varchar(255) NOT NULL,
  `tunjangan_menikah` varchar(255) NOT NULL,
  `tunjangan_anak` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `golongans`
--

INSERT INTO `golongans` (`id`, `nama_golongan`, `tunjangan_menikah`, `tunjangan_anak`, `created_at`, `updated_at`) VALUES
(4, 'Menikah', '200000', 50000, '2023-01-11 06:14:58', '2023-01-11 06:14:58'),
(5, 'Single', '1000000', 25000, '2023-01-09 15:53:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `gapok` int(11) NOT NULL,
  `tunjangan_makmur` int(11) NOT NULL,
  `tunjangan_makan` int(11) DEFAULT NULL,
  `tunjangan_transportasi` int(11) NOT NULL,
  `tunjangan_lembur` int(11) DEFAULT NULL,
  `tunjangan_menikah` int(11) NOT NULL,
  `tunjangan_anak` int(11) NOT NULL,
  `bonus_tahunan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `nama_jabatan`, `gapok`, `tunjangan_makmur`, `tunjangan_makan`, `tunjangan_transportasi`, `tunjangan_lembur`, `tunjangan_menikah`, `tunjangan_anak`, `bonus_tahunan`, `created_at`, `updated_at`) VALUES
(1, 'Chef', 1000000, 450000, 20000, 10000, 25000, 100000, 50000, 120000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(2, 'Pramusaji', 500000, 250000, 15000, 10000, 15000, 100000, 50000, 50000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(3, 'Kasir', 750000, 380000, 15000, 10000, 15000, 100000, 50000, 50000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(4, 'Outlet Manager', 1300000, 500000, 20000, 10000, 5000, 100000, 50000, 150000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(5, 'Cook Helper', 400000, 150000, 15000, 5000, 15000, 100000, 50000, 50000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(6, 'Expeditor', 650000, 400000, 25000, 30000, 15000, 100000, 50000, 100000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(9, 'marketing', 2500000, 200000, 10000, 200000, 15000, 0, 0, 200000, '2023-01-04 00:32:29', '2023-01-04 00:32:29'),
(10, 'data analyst', 3000000, 200000, 10000, 300000, 15000, 0, 0, 250000, '2023-01-11 03:54:57', '2023-01-11 03:54:57');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_09_125635_create_jabatans_table', 1),
(6, '2022_07_09_125802_create_pegawais_table', 1),
(7, '2022_07_09_125829_create_perhitungans_table', 1),
(8, '2022_07_09_125841_create_golongans_table', 1),
(9, '2022_07_22_151816_create_cabangs_table', 1),
(10, '2022_07_22_152718_create_bonus_omzets_table', 1),
(11, '2022_12_27_154827_add_alpha_perhitungan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tahun_masuk` date NOT NULL,
  `jumlah_anak` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `nama_pegawai`, `id_jabatan`, `id_cabang`, `jenis_kelamin`, `alamat`, `status`, `tahun_masuk`, `jumlah_anak`, `created_at`, `updated_at`) VALUES
(221001, 'Rendy', 1, 1, '', '', 'Menikah', '0000-00-00', '0', '2022-12-24 13:11:03', '2023-03-11 23:33:58'),
(222002, 'April', 2, 2, 'Laki-laki', 'Dekat ambengan', 'Single', '2022-12-07', '0', '2022-12-24 13:11:44', '2022-12-24 13:11:44'),
(223003, 'Faris', 3, 3, 'Laki-laki', 'Surabaya', 'Single', '2019-02-12', '0', '2022-12-24 13:12:44', '2022-12-24 13:12:44'),
(231004, 'Andini', 9, 1, '', '', 'Single', '0000-00-00', '2', '2023-01-04 00:36:08', '2023-03-11 23:33:52'),
(231006, 'Jannaq', 1, 1, '', '', 'Single', '0000-00-00', '2', '2023-01-11 03:56:33', '2023-01-11 07:51:01'),
(231106, 'idner', 2, 1, 'Laki-laki', 'surabaya indah', 'Menikah', '1222-12-12', '0', '2023-03-13 00:22:29', '2023-03-13 00:22:29'),
(233006, 'amiin', 4, 3, 'Laki-laki', 'surabaya', 'Menikah', '2023-03-22', '1', '2023-03-11 23:48:13', '2023-03-11 23:48:13'),
(235005, 'bambang', 5, 5, 'Perempuan', 'Mekar indah no 7', 'Single', '2001-12-12', '0', '2023-01-07 22:33:33', '2023-01-07 22:33:33'),
(2311006, 'chico', 1, 1, 'Laki-laki', 'indoa', 'Menikah', '0122-02-21', '1', '2023-03-13 00:25:32', '2023-03-13 00:25:32'),
(2311007, 'agung', 1, 1, 'Laki-laki', 'dasa', 'Menikah', '1221-12-12', '1', '2023-03-13 00:25:50', '2023-03-13 00:25:50'),
(2311008, 'nahnu', 1, 1, 'Laki-laki', '1212', 'Menikah', '0012-12-12', '1', '2023-03-13 00:26:11', '2023-03-13 00:26:11'),
(2311009, 'aguna', 1, 1, 'Laki-laki', '12', 'Menikah', '0122-12-12', '1', '2023-03-13 00:26:56', '2023-03-13 00:26:56'),
(2311010, '1212', 1, 1, 'Laki-laki', '12', 'Menikah', '0012-12-12', '1', '2023-03-13 00:27:12', '2023-03-13 00:27:12'),
(2311011, '12', 1, 1, 'Laki-laki', '12', 'Menikah', '2121-12-12', '1', '2023-03-13 00:27:26', '2023-03-13 00:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `perhitungans`
--

CREATE TABLE `perhitungans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `lembur` int(11) NOT NULL,
  `pelanggaran` int(11) NOT NULL,
  `bulan` int(255) NOT NULL,
  `tahun` int(255) NOT NULL,
  `omzet` int(11) NOT NULL,
  `bonus_omzet` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alpha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perhitungans`
--

INSERT INTO `perhitungans` (`id`, `id_pegawai`, `lembur`, `pelanggaran`, `bulan`, `tahun`, `omzet`, `bonus_omzet`, `total`, `created_at`, `updated_at`, `alpha`) VALUES
(21, 222002, 10, 100000, 4, 2022, 1000000, 0, 3900000, '2022-12-28 02:15:19', '2022-12-28 02:15:19', '1'),
(22, 223003, 20, 1000000, 7, 2022, 5000000, 0, 5820000, '2022-12-28 02:16:47', '2022-12-28 02:16:47', '4'),
(24, 224004, 30, 100000, 9, 2022, 10000000, 0, 11400000, '2022-12-28 02:19:02', '2022-12-28 02:19:02', '1'),
(32, 231004, 3, 50000, 10, 2023, 132000000, 200000, 3535000, '2023-01-11 05:49:25', '2023-01-11 05:49:25', '2'),
(33, 231006, 2, 300000, 6, 2023, 30000000, 0, 3680000, '2023-01-11 06:10:18', '2023-01-11 06:10:18', '1'),
(34, 231004, 12, 1, 2, 2023, 121212, 0, 3639999, '2023-01-16 01:11:55', '2023-01-16 01:11:55', '0'),
(35, 231004, 0, 0, 2, 2023, 12, 12, 3460012, '2023-01-16 01:17:13', '2023-01-16 01:17:13', '0'),
(36, 231004, 123, 123, 2, 2023, 123, 0, 4074877, '2023-02-04 03:22:50', '2023-02-04 03:22:50', '123'),
(37, 222002, 123123, 123, 1, 2023, 2147483647, 130000000, 1635000, '2023-02-04 03:23:12', '2023-02-04 03:31:33', '123'),
(39, 231004, 0, 0, 1, 2023, 1, 0, 3460000, '2023-03-11 22:27:46', '2023-03-11 22:27:46', '0'),
(40, 223003, 20, 1, 3, 2023, 1, 0, 2689999, '2023-03-11 22:31:27', '2023-03-11 22:31:27', '1'),
(41, 223003, 10, 10, 12, 2023, 100, 10, 2899910, '2023-03-11 23:11:38', '2023-03-11 23:11:38', '10'),
(42, 221001, 10, 10000, 2, 2023, 121212, 0, 2050000, '2023-03-30 01:43:22', '2023-03-30 01:43:22', '1');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `id_pegawai`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2a$12$iLjOX9zIafYo3/Wnfe.Ahe..WDReuyXgN45uUEhRaPacjGASgcHmy', NULL, '2021-12-09 15:45:38', NULL),
(2, 2, 'pegawai', 'pegawai', 'pegawai@gmail.com', NULL, '$2y$10$SWD1XBml7/5HhJkrjX.8VOKL6S0Aw1t1q8EiM.Rr0tiSNWtl6YH2C', NULL, '2018-12-11 15:45:53', NULL),
(3, 3, 'owner', 'owner', 'owner@gmail.com', NULL, '$2y$10$F48IjYMTjGz7VJYpxXRWweItVN/OGHOhA2C7nj/cj/b0h4XWTqjQG', NULL, NULL, NULL),
(7, 221001, 'Rendy', 'pegawai', 'rendy@gmail.com', NULL, '$2y$10$Uocl.NDzuP7XicLyZAEgBexNZ/hWN/gGxJoKg94xMB/SdIhAmAV.e', NULL, '2022-12-24 13:11:03', '2022-12-24 13:11:03'),
(8, 222002, 'April', 'pegawai', 'april@gmail.com', NULL, '$2y$10$z1LILDIWzgnFVuiA9.k.vetCf9.t.y8OcFJ7v4LjdGEUxncM9JDcS', NULL, '2022-12-24 13:11:44', '2022-12-24 13:11:44'),
(10, 223003, 'Faris', 'pegawai', 'faris@gmail.com', NULL, '$2y$10$nfdzl6ZovcU51Jxza0cSKOvZNivTxsDumRZZhZ181kiYuwBjO9D3O', NULL, '2022-12-24 13:12:44', '2022-12-24 13:12:44'),
(11, 224004, 'Andreas', 'pegawai', 'andreas@gmail.com', NULL, '$2y$10$JF88HFhad5mmTrKyWvvVTOs/5sQx0Tm83qx6MsUxpm8J78R7NLl0e', NULL, '2022-12-24 13:13:11', '2022-12-24 13:13:11'),
(12, 221005, 'Yusuf', 'pegawai', 'yusuf@gmail.com', NULL, '$2y$10$nZYwXdBCpWM52MrD6umMUemXeum6CqK0Q64HTjrEcMklNLlsWlUEu', NULL, '2022-12-24 13:40:22', '2022-12-24 13:40:22'),
(13, 231006, 'Andini', 'pegawai', 'andini@gmail.com', NULL, '$2y$10$41piMxEh2TSRVXNRXWwuPOvsmYFBwBXPYQnTgvXXYvxUF9W3nUkcy', NULL, '2023-01-04 00:36:08', '2023-01-04 00:36:08'),
(39, 231106, 'idner', 'pegawai', 'idner@gmail.com', NULL, '$2y$10$7XH6dzL7lp8UzD23H3fXE.T2S0wsBHzZ3eKoZ0zk1b6DKxcQaLc5y', NULL, '2023-03-13 00:22:29', '2023-03-13 00:22:29'),
(42, 2311006, 'chico', 'pegawai', 'chico@gmail.com', NULL, '$2y$10$Hww10uUra65QODoGLHCvWeWOipR4UM9a5aqQTvQnShzdqJrI/Vwnu', NULL, '2023-03-13 00:25:32', '2023-03-13 00:25:32'),
(43, 2311007, 'agung', 'pegawai', 'agung@gmail.com', NULL, '$2y$10$8CeYZPozbR56bVonj4ye5uZ0nHY8MhcnvvpWrleCV/4L5hddOsIDi', NULL, '2023-03-13 00:25:50', '2023-03-13 00:25:50'),
(44, 2311008, 'nahnu', 'pegawai', 'nahnu@gmail.com', NULL, '$2y$10$vooj8x0lVR4ns0y1iBYcn.R6JJW.qAPWQIP3GAcVWuFfG3CbNqU5K', NULL, '2023-03-13 00:26:11', '2023-03-13 00:26:11'),
(45, 2311009, 'aguna', 'pegawai', 'aguna@gmail.com', NULL, '$2y$10$KQRsO3R8Qi3f8INWvmq7EOkGVF92J3XMwNoqo9zzwNFxvn4T0XArK', NULL, '2023-03-13 00:26:56', '2023-03-13 00:26:56'),
(46, 2311010, '1212', 'pegawai', '1212@gmail.com', NULL, '$2y$10$/gLkwWZoZZlWU7Nl9Lsii.ACdgzGiFj2cgGEf7T5vBNClzCoonpZG', NULL, '2023-03-13 00:27:12', '2023-03-13 00:27:12'),
(47, 2311011, '12', 'pegawai', '12@gmail.com', NULL, '$2y$10$1ElEidPJq1AY2TIxwbCuJ.1RhcS14fgUIsR0sPEWHe6ug0xCrj8Jy', NULL, '2023-03-13 00:27:26', '2023-03-13 00:27:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonus_omzets`
--
ALTER TABLE `bonus_omzets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabangs`
--
ALTER TABLE `cabangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `golongans`
--
ALTER TABLE `golongans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
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
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perhitungans`
--
ALTER TABLE `perhitungans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `bonus_omzets`
--
ALTER TABLE `bonus_omzets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cabangs`
--
ALTER TABLE `cabangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `golongans`
--
ALTER TABLE `golongans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2311012;

--
-- AUTO_INCREMENT for table `perhitungans`
--
ALTER TABLE `perhitungans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
