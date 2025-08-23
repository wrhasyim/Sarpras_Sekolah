-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Agu 2025 pada 07.18
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
-- Database: `db_sarpras`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'Kelas 10-A', NULL, NULL),
(2, 'Kelas 10-B', NULL, NULL),
(3, 'Kelas 11-A', NULL, NULL),
(4, 'Kelas 11-B', NULL, NULL),
(5, 'Ruang Guru', NULL, NULL),
(6, 'Perpustakaan', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `aktivitas`, `created_at`, `updated_at`) VALUES
(1, 1, 'Menghapus barang: ', '2025-08-22 21:54:57', '2025-08-22 21:54:57'),
(2, 1, 'Menambahkan barang baru: 1', '2025-08-22 21:55:13', '2025-08-22 21:55:13'),
(3, 1, 'Menghapus barang: ', '2025-08-22 21:55:16', '2025-08-22 21:55:16'),
(4, 1, 'Menghapus barang: 1', '2025-08-22 21:56:31', '2025-08-22 21:56:31'),
(5, 1, 'Mengubah data barang: Meja Siswa', '2025-08-22 21:56:37', '2025-08-22 21:56:37'),
(6, 1, 'Mengubah data barang: Meja Siswa', '2025-08-22 21:56:42', '2025-08-22 21:56:42'),
(7, 1, 'Menghapus barang: Lampu Neon', '2025-08-22 21:56:54', '2025-08-22 21:56:54'),
(8, 1, 'Menambahkan barang baru: 1', '2025-08-22 21:58:38', '2025-08-22 21:58:38'),
(9, 1, 'Menghapus barang: 1', '2025-08-22 21:58:42', '2025-08-22 21:58:42'),
(10, 3, 'Mengubah data barang: Kursi Siswa', '2025-08-22 22:06:52', '2025-08-22 22:06:52'),
(11, 3, 'Mengubah data barang: Meja Siswa', '2025-08-22 22:06:59', '2025-08-22 22:06:59'),
(12, 1, 'Mengubah data barang: Kursi Siswa', '2025-08-22 22:07:54', '2025-08-22 22:07:54');

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
(2, '2025_08_23_032835_create_app_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarpras`
--

CREATE TABLE `sarpras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` enum('baik','rusak_ringan','rusak_berat') NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sarpras`
--

INSERT INTO `sarpras` (`id`, `kode_barang`, `nama_barang`, `jumlah`, `kondisi`, `kelas_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'KRS-10A-001', 'Kursi Siswa', 30, 'baik', 1, 'Kursi kayu', NULL, '2025-08-22 22:07:54'),
(2, 'MJA-10A-001', 'Meja Siswa', 12, 'rusak_ringan', 1, 'Meja untuk 2 siswa', NULL, '2025-08-22 21:56:42');

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
('i7Ipi2mNXfv4X5LSvBiYiYPlzUiGx01rkRlHpvXD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidjJPU2k3eDZPSzBCZ3FOZ1JHN293YmVZNndZUmtkZ1B1YzZHVW9WTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYXBvcmFuL2V4Y2VsIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1755926236);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','tu','wali_kelas') NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `kelas_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'admin@sarpras.com', NULL, '$2y$12$MYaPV6Z/XwkhFdqDyYQ0AOGDL9ByA8zKXZP/incXfsb8sz.LKJTSq', 'admin', NULL, NULL, NULL, '2025-08-22 21:46:33'),
(2, 'Staf Tata Usaha', 'tu@sarpras.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tu', NULL, NULL, NULL, NULL),
(3, 'Budi (Wali 10-A)', 'walikelas@sarpras.com', NULL, '$2y$12$LhZMkfcvqD8tK5MNYHie7ewMN3XC.D/xlonnV.dOpin0q.4EygeXm', 'wali_kelas', 1, NULL, NULL, '2025-08-22 22:06:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sarpras`
--
ALTER TABLE `sarpras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sarpras_kode_barang_unique` (`kode_barang`),
  ADD KEY `sarpras_kelas_id_foreign` (`kelas_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sarpras`
--
ALTER TABLE `sarpras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sarpras`
--
ALTER TABLE `sarpras`
  ADD CONSTRAINT `sarpras_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
