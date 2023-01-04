-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 06:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `id_jabatan` bigint(20) UNSIGNED NOT NULL,
  `bonus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonus_omzets`
--

INSERT INTO `bonus_omzets` (`id`, `id_cabang`, `id_jabatan`, `bonus`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 225000000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(2, 2, 1, 75000000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(3, 3, 1, 95000000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(4, 4, 1, 50000000, '2022-07-27 21:54:46', '2022-07-27 21:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `cabangs`
--

CREATE TABLE `cabangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cabangs`
--

INSERT INTO `cabangs` (`id`, `nama_cabang`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Kantin Tante Royal', 'Jl. Raya Tante Royal No.1', NULL, NULL),
(2, 'Kantin Tante DTC', 'Jl. Raya Tante DTC No.1', NULL, NULL),
(3, 'Kantin Tante Pasar Atom', 'Jl. Raya Tante Pasar Atom No.1', NULL, NULL),
(4, 'Pujasera Tante Embong wungu', 'Jl. Raya Tante Embong Wungu No.1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `golongans`
--

CREATE TABLE `golongans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tunjangan_menikah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tunjangan_anak` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `golongans`
--

INSERT INTO `golongans` (`id`, `nama_golongan`, `tunjangan_menikah`, `tunjangan_anak`, `created_at`, `updated_at`) VALUES
(1, 'Menikah', '100000', 50000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(2, 'Cerai', '50000', 50000, '2022-07-27 21:54:46', '2022-07-27 21:54:46'),
(3, 'Single', '0', 50000, '2022-07-27 21:54:46', '2022-07-27 21:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gapok` int(11) NOT NULL,
  `tunjangan_makmur` int(11) NOT NULL,
  `tunjangan_makan` int(11),
  `tunjangan_transportasi` int(11) NOT NULL,
  `tunjangan_lembur` int(11),
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
(6, 'Expeditor', 650000, 400000, 25000, 30000, 15000, 100000, 50000, 100000, '2022-07-27 21:54:46', '2022-07-27 21:54:46');

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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` date NOT NULL,
  `jumlah_anak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `nama_pegawai`, `id_jabatan`, `id_cabang`, `jenis_kelamin`, `alamat`, `status`, `tahun_masuk`, `jumlah_anak`, `created_at`, `updated_at`) VALUES
(221001, 'Rendy', 1, 1, 'Laki-laki', 'Surabaya', 'Single', '2022-12-04', '0', '2022-12-24 13:11:03', '2022-12-24 13:11:03'),
(222002, 'April', 2, 2, 'Laki-laki', 'Dekat ambengan', 'Single', '2022-12-07', '0', '2022-12-24 13:11:44', '2022-12-24 13:11:44'),
(223003, 'Faris', 3, 3, 'Laki-laki', 'Surabaya', 'Single', '2019-02-12', '0', '2022-12-24 13:12:44', '2022-12-24 13:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `perhitungans`
--

CREATE TABLE `perhitungans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `lembur` int(11) NOT NULL,
  `pelanggaran` int(11) NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `omzet` int(11) NOT NULL,
  `bonus_omzet` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alpha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perhitungans`
--

INSERT INTO `perhitungans` (`id`, `id_pegawai`, `lembur`, `pelanggaran`, `bulan`, `tahun`, `omzet`, `bonus_omzet`, `total`, `created_at`, `updated_at`, `alpha`) VALUES
(20, 221001, 1, 100, '2', '2022', 12000000, 0, 624900, '2022-12-28 02:13:38', '2022-12-28 02:13:38', '1'),
(21, 222002, 10, 100000, '4', '2022', 1000000, 0, 3900000, '2022-12-28 02:15:19', '2022-12-28 02:15:19', '1'),
(22, 223003, 20, 1000000, '7', '2022', 5000000, 0, 5820000, '2022-12-28 02:16:47', '2022-12-28 02:16:47', '4'),
(24, 224004, 30, 100000, '9', '2022', 10000000, 0, 11400000, '2022-12-28 02:19:02', '2022-12-28 02:19:02', '1'),
(25, 221001, 20, 1000, '5', '2022', 5000000, 0, 7749000, '2022-12-28 23:10:54', '2022-12-28 23:10:54', '1');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_pegawai`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2a$12$iLjOX9zIafYo3/Wnfe.Ahe..WDReuyXgN45uUEhRaPacjGASgcHmy', NULL, '2021-12-09 15:45:38', NULL),
(2, 1, 'pegawai', 'pegawai', 'pegawai@gmail.com', NULL, '$2y$10$SWD1XBml7/5HhJkrjX.8VOKL6S0Aw1t1q8EiM.Rr0tiSNWtl6YH2C', NULL, '2018-12-11 15:45:53', NULL),
(3, 1, 'owner', 'owner', 'owner@gmail.com', NULL, '$2y$10$F48IjYMTjGz7VJYpxXRWweItVN/OGHOhA2C7nj/cj/b0h4XWTqjQG', NULL, NULL, NULL),
(7, 221001, 'Rendy', 'pegawai', 'rendy@gmail.com', NULL, '$2y$10$Uocl.NDzuP7XicLyZAEgBexNZ/hWN/gGxJoKg94xMB/SdIhAmAV.e', NULL, '2022-12-24 13:11:03', '2022-12-24 13:11:03'),
(8, 222002, 'April', 'pegawai', 'april@gmail.com', NULL, '$2y$10$z1LILDIWzgnFVuiA9.k.vetCf9.t.y8OcFJ7v4LjdGEUxncM9JDcS', NULL, '2022-12-24 13:11:44', '2022-12-24 13:11:44'),
(10, 223003, 'Faris', 'pegawai', 'faris@gmail.com', NULL, '$2y$10$nfdzl6ZovcU51Jxza0cSKOvZNivTxsDumRZZhZ181kiYuwBjO9D3O', NULL, '2022-12-24 13:12:44', '2022-12-24 13:12:44'),
(11, 224004, 'Andreas', 'pegawai', 'andreas@gmail.com', NULL, '$2y$10$JF88HFhad5mmTrKyWvvVTOs/5sQx0Tm83qx6MsUxpm8J78R7NLl0e', NULL, '2022-12-24 13:13:11', '2022-12-24 13:13:11'),
(12, 221005, 'Yusuf', 'pegawai', 'yusuf@gmail.com', NULL, '$2y$10$nZYwXdBCpWM52MrD6umMUemXeum6CqK0Q64HTjrEcMklNLlsWlUEu', NULL, '2022-12-24 13:40:22', '2022-12-24 13:40:22');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cabangs`
--
ALTER TABLE `cabangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `golongans`
--
ALTER TABLE `golongans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224005;

--
-- AUTO_INCREMENT for table `perhitungans`
--
ALTER TABLE `perhitungans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
