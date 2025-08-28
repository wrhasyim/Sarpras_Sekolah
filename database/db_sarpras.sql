-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Agu 2025 pada 09.40
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
(1, 'Ruang A3', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(2, 'Ruang A4', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(3, 'Ruang A7', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(4, 'Ruang A8', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(5, 'Ruang A13', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(6, 'Ruang A14', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(7, 'Ruang B1', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(8, 'Ruang B2', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(9, 'Ruang B4', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(10, 'Ruang B5', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(11, 'Ruang B7', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(12, 'Ruang B8', '2025-08-27 23:41:37', '2025-08-27 23:41:37'),
(13, 'Ruang B10', '2025-08-27 23:41:37', '2025-08-27 23:41:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `activity` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2025_08_23_032835_create_app_tables', 1),
(3, '2025_08_23_091448_create_sessions_table', 1),
(4, '2025_08_27_063109_create_rekap_sarpras_table', 1),
(5, '2025_08_27_075215_create_rekap_bulanan_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_bulanan`
--

CREATE TABLE `rekap_bulanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sarpras_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi_baik` int(11) NOT NULL,
  `kondisi_rusak_ringan` int(11) NOT NULL,
  `kondisi_rusak_berat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_sarpras`
--

CREATE TABLE `rekap_sarpras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sarpras_id` bigint(20) UNSIGNED NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi_baik` int(11) NOT NULL,
  `kondisi_rusak_ringan` int(11) NOT NULL,
  `kondisi_rusak_berat` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarpras`
--

CREATE TABLE `sarpras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi_baik` int(11) NOT NULL,
  `kondisi_rusak_ringan` int(11) NOT NULL,
  `kondisi_rusak_berat` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sarpras`
--

INSERT INTO `sarpras` (`id`, `kode_barang`, `nama_barang`, `kelas_id`, `jumlah`, `kondisi_baik`, `kondisi_rusak_ringan`, `kondisi_rusak_berat`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'MG-RA3', 'MEJA GURU', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(2, 'KG-RA3', 'KURSI GURU', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(3, 'MM-RA3', 'MEJA MURID', 1, 17, 17, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(4, 'KM-RA3', 'KURSI MURID', 1, 34, 32, 2, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(5, 'PT-RA3', 'PAPAN TULIS', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(6, 'LEMARI-RA3', 'LEMARI', 1, 0, 0, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(7, 'GBG-RA3', 'GAMBAR BURUNG GARUDA', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(8, 'FP-RA3', 'FOTO PRESIDEN', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(9, 'FWP-RA3', 'FOTO WAKIL PRESIDEN', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(10, 'JD-RA3', 'JAM DINDING', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(11, 'SAPU-RA3', 'SAPU ', 1, 4, 1, 2, 1, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(12, 'KP-RA3', 'KAIN PEL', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(13, 'TM-RA3', 'TAPLAK MEJA', 1, 1, 0, 1, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(14, 'KA-RA3', 'KIPAS ANGIN', 1, 2, 2, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(15, 'EMBE-RA3', 'EMBER', 1, 1, 1, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(16, 'WK-RA3', 'WIPER KACA', 1, 0, 0, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(17, 'LAMP-RA3', 'LAMPU', 1, 4, 4, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(18, 'JPEL-RA3', 'JADWAL PELAJARAN', 1, 2, 2, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(19, 'JPIK-RA3', 'JADWAL PIKET', 1, 2, 2, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(20, 'STOK-RA3', 'STRUKTUR ORGANISASI KELAS', 1, 2, 2, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(21, 'KK-RA3', 'KESEPAKATAN KELAS', 1, 2, 2, 0, 0, NULL, '2025-08-28 00:13:51', '2025-08-28 00:13:51'),
(22, 'MG-RA4', 'MEJA GURU', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(23, 'KG-RA4', 'KURSI GURU', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(24, 'MM-RA4', 'MEJA MURID', 2, 17, 17, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(25, 'KM-RA4', 'KURSI MURID', 2, 31, 16, 15, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(26, 'PT-RA4', 'PAPAN TULIS', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(27, 'LEMARI-RA4', 'LEMARI', 2, 0, 0, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(28, 'GBG-RA4', 'GAMBAR BURUNG GARUDA', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(29, 'FP-RA4', 'FOTO PRESIDEN', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(30, 'FWP-RA4', 'FOTO WAKIL PRESIDEN', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(31, 'JD-RA4', 'JAM DINDING', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(32, 'SAPU-RA4', 'SAPU ', 2, 3, 3, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(33, 'KP-RA4', 'KAIN PEL', 2, 2, 2, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(34, 'TM-RA4', 'TAPLAK MEJA', 2, 0, 0, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(35, 'KA-RA4', 'KIPAS ANGIN', 2, 4, 4, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(36, 'EMBE-RA4', 'EMBER', 2, 3, 3, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(37, 'WK-RA4', 'WIPER KACA', 2, 0, 0, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(38, 'LAMP-RA4', 'LAMPU', 2, 2, 2, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(39, 'JPEL-RA4', 'JADWAL PELAJARAN', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(40, 'JPIK-RA4', 'JADWAL PIKET', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(41, 'STOK-RA4', 'STRUKTUR ORGANISASI KELAS', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(42, 'KK-RA4', 'KESEPAKATAN KELAS', 2, 1, 1, 0, 0, NULL, '2025-08-28 00:16:57', '2025-08-28 00:16:57'),
(43, 'MG-RA7', 'MEJA GURU', 3, 1, 1, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(44, 'KG-RA7', 'KURSI GURU', 3, 1, 1, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(45, 'MM-RA7', 'MEJA MURID', 3, 16, 13, 0, 3, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(46, 'KM-RA7', 'KURSI MURID', 3, 32, 29, 0, 3, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(47, 'PT-RA7', 'PAPAN TULIS', 3, 1, 1, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(48, 'LEMARI-RA7', 'LEMARI', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(49, 'GBG-RA7', 'GAMBAR BURUNG GARUDA', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(50, 'FP-RA7', 'FOTO PRESIDEN', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(51, 'FWP-RA7', 'FOTO WAKIL PRESIDEN', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(52, 'JD-RA7', 'JAM DINDING', 3, 1, 1, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(53, 'SAPU-RA7', 'SAPU ', 3, 6, 6, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(54, 'KP-RA7', 'KAIN PEL', 3, 1, 1, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(55, 'TM-RA7', 'TAPLAK MEJA', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(56, 'KA-RA7', 'KIPAS ANGIN', 3, 3, 3, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(57, 'EMBE-RA7', 'EMBER', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(58, 'WK-RA7', 'WIPER KACA', 3, 1, 1, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(59, 'LAMP-RA7', 'LAMPU', 3, 6, 4, 0, 2, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(60, 'JPEL-RA7', 'JADWAL PELAJARAN', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(61, 'JPIK-RA7', 'JADWAL PIKET', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(62, 'STOK-RA7', 'STRUKTUR ORGANISASI KELAS', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(63, 'KK-RA7', 'KESEPAKATAN KELAS', 3, 0, 0, 0, 0, NULL, '2025-08-28 00:19:29', '2025-08-28 00:19:29'),
(64, 'MG-RA8', 'MEJA GURU', 4, 1, 1, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(65, 'KG-RA8', 'KURSI GURU', 4, 1, 1, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(66, 'MM-RA8', 'MEJA MURID', 4, 18, 18, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(67, 'KM-RA8', 'KURSI MURID', 4, 36, 35, 0, 1, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(68, 'PT-RA8', 'PAPAN TULIS', 4, 1, 1, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(69, 'LEMARI-RA8', 'LEMARI', 4, 0, 0, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(70, 'GBG-RA8', 'GAMBAR BURUNG GARUDA', 4, 1, 1, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(71, 'FP-RA8', 'FOTO PRESIDEN', 4, 1, 1, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(72, 'FWP-RA8', 'FOTO WAKIL PRESIDEN', 4, 1, 1, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(73, 'JD-RA8', 'JAM DINDING', 4, 1, 1, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(74, 'SAPU-RA8', 'SAPU ', 4, 5, 5, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(75, 'KP-RA8', 'KAIN PEL', 4, 3, 2, 0, 1, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(76, 'TM-RA8', 'TAPLAK MEJA', 4, 1, 1, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(77, 'KA-RA8', 'KIPAS ANGIN', 4, 4, 4, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(78, 'EMBE-RA8', 'EMBER', 4, 2, 2, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(79, 'WK-RA8', 'WIPER KACA', 4, 0, 0, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(80, 'LAMP-RA8', 'LAMPU', 4, 4, 4, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(81, 'JPEL-RA8', 'JADWAL PELAJARAN', 4, 2, 2, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(82, 'JPIK-RA8', 'JADWAL PIKET', 4, 2, 2, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(83, 'STOK-RA8', 'STRUKTUR ORGANISASI KELAS', 4, 2, 2, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(84, 'KK-RA8', 'KESEPAKATAN KELAS', 4, 2, 2, 0, 0, NULL, '2025-08-28 00:21:00', '2025-08-28 00:21:00'),
(85, 'MG-RA13', 'MEJA GURU', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(86, 'KG-RA13', 'KURSI GURU', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(87, 'MM-RA13', 'MEJA MURID', 5, 30, 10, 20, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(88, 'KM-RA13', 'KURSI MURID', 5, 31, 30, 1, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(89, 'PT-RA13', 'PAPAN TULIS', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(90, 'LEMARI-RA13', 'LEMARI', 5, 0, 0, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(91, 'GBG-RA13', 'GAMBAR BURUNG GARUDA', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(92, 'FP-RA13', 'FOTO PRESIDEN', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(93, 'FWP-RA13', 'FOTO WAKIL PRESIDEN', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(94, 'JD-RA13', 'JAM DINDING', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(95, 'SAPU-RA13', 'SAPU ', 5, 5, 3, 0, 2, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(96, 'KP-RA13', 'KAIN PEL', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(97, 'TM-RA13', 'TAPLAK MEJA', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(98, 'KA-RA13', 'KIPAS ANGIN', 5, 4, 2, 0, 2, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(99, 'EMBE-RA13', 'EMBER', 5, 0, 0, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(100, 'WK-RA13', 'WIPER KACA', 5, 0, 0, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(101, 'LAMP-RA13', 'LAMPU', 5, 4, 4, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(102, 'JPEL-RA13', 'JADWAL PELAJARAN', 5, 2, 2, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(103, 'JPIK-RA13', 'JADWAL PIKET', 5, 2, 2, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(104, 'STOK-RA13', 'STRUKTUR ORGANISASI KELAS', 5, 2, 2, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(105, 'KK-RA13', 'KESEPAKATAN KELAS', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(106, 'PTB-RA13', 'PENGUKUR TINGGI BADAN', 5, 1, 1, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(107, 'PRUL-RA13', 'PRAY RULES', 5, 2, 2, 0, 0, NULL, '2025-08-28 00:24:30', '2025-08-28 00:24:30'),
(108, 'MG-RB1', 'MEJA GURU', 7, 1, 1, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(109, 'KG-RB1', 'KURSI GURU', 7, 1, 1, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(110, 'MM-RB1', 'MEJA MURID', 7, 20, 20, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(111, 'KM-RB1', 'KURSI MURID', 7, 34, 28, 3, 3, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(112, 'PT-RB1', 'PAPAN TULIS', 7, 1, 1, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(113, 'LEMARI-RB1', 'LEMARI', 7, 0, 0, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(114, 'GBG-RB1', 'GAMBAR BURUNG GARUDA', 7, 0, 0, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(115, 'FP-RB1', 'FOTO PRESIDEN', 7, 0, 0, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(116, 'FWP-RB1', 'FOTO WAKIL PRESIDEN', 7, 0, 0, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(117, 'JD-RB1', 'JAM DINDING', 7, 1, 1, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(118, 'SAPU-RB1', 'SAPU ', 7, 5, 5, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(119, 'KP-RB1', 'KAIN PEL', 7, 1, 1, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(120, 'TM-RB1', 'TAPLAK MEJA', 7, 2, 2, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(121, 'KA-RB1', 'KIPAS ANGIN', 7, 3, 3, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(122, 'EMBE-RB1', 'EMBER', 7, 1, 1, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(123, 'WK-RB1', 'WIPER KACA', 7, 0, 0, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(124, 'LAMP-RB1', 'LAMPU', 7, 4, 4, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(125, 'JPEL-RB1', 'JADWAL PELAJARAN', 7, 2, 2, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(126, 'JPIK-RB1', 'JADWAL PIKET', 7, 2, 2, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(127, 'STOK-RB1', 'STRUKTUR ORGANISASI KELAS', 7, 2, 2, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(128, 'KK-RB1', 'KESEPAKATAN KELAS', 7, 2, 2, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(129, 'KACA-RB1', 'KACA', 7, 1, 1, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(130, 'TOSAM-RB1', 'TONG SAMPAH', 7, 2, 2, 0, 0, NULL, '2025-08-28 00:29:49', '2025-08-28 00:29:49'),
(131, 'MG-RB4', 'MEJA GURU', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(132, 'KG-RB4', 'KURSI GURU', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(133, 'MM-RB4', 'MEJA MURID', 9, 14, 0, 13, 1, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(134, 'KM-RB4', 'KURSI MURID', 9, 26, 0, 25, 1, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(135, 'PT-RB4', 'PAPAN TULIS', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(136, 'LEMARI-RB4', 'LEMARI', 9, 1, 0, 1, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(137, 'GBG-RB4', 'GAMBAR BURUNG GARUDA', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(138, 'FP-RB4', 'FOTO PRESIDEN', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(139, 'FWP-RB4', 'FOTO WAKIL PRESIDEN', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(140, 'JD-RB4', 'JAM DINDING', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(141, 'SAPU-RB4', 'SAPU ', 9, 3, 3, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(142, 'KP-RB4', 'KAIN PEL', 9, 3, 3, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(143, 'TM-RB4', 'TAPLAK MEJA', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(144, 'KA-RB4', 'KIPAS ANGIN', 9, 6, 6, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(145, 'EMBE-RB4', 'EMBER', 9, 0, 0, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(146, 'WK-RB4', 'WIPER KACA', 9, 2, 2, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(147, 'LAMP-RB4', 'LAMPU', 9, 4, 4, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(148, 'JPEL-RB4', 'JADWAL PELAJARAN', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(149, 'JPIK-RB4', 'JADWAL PIKET', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(150, 'STOK-RB4', 'STRUKTUR ORGANISASI KELAS', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(151, 'KK-RB4', 'KESEPAKATAN KELAS', 9, 1, 1, 0, 0, NULL, '2025-08-28 00:32:29', '2025-08-28 00:32:29'),
(152, 'MG-RB5', 'MEJA GURU', 10, 0, 0, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(153, 'KG-RB5', 'KURSI GURU', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(154, 'MM-RB5', 'MEJA MURID', 10, 15, 15, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(155, 'KM-RB5', 'KURSI MURID', 10, 30, 30, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(156, 'PT-RB5', 'PAPAN TULIS', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(157, 'LEMARI-RB5', 'LEMARI', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(158, 'GBG-RB5', 'GAMBAR BURUNG GARUDA', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(159, 'FP-RB5', 'FOTO PRESIDEN', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(160, 'FWP-RB5', 'FOTO WAKIL PRESIDEN', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(161, 'JD-RB5', 'JAM DINDING', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(162, 'SAPU-RB5', 'SAPU ', 10, 6, 6, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(163, 'KP-RB5', 'KAIN PEL', 10, 0, 0, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(164, 'TM-RB5', 'TAPLAK MEJA', 10, 0, 0, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(165, 'KA-RB5', 'KIPAS ANGIN', 10, 4, 2, 1, 1, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(166, 'EMBE-RB5', 'EMBER', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(167, 'WK-RB5', 'WIPER KACA', 10, 1, 1, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(168, 'LAMP-RB5', 'LAMPU', 10, 4, 4, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(169, 'JPEL-RB5', 'JADWAL PELAJARAN', 10, 2, 2, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(170, 'JPIK-RB5', 'JADWAL PIKET', 10, 2, 2, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(171, 'STOK-RB5', 'STRUKTUR ORGANISASI KELAS', 10, 2, 2, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(172, 'KK-RB5', 'KESEPAKATAN KELAS', 10, 2, 2, 0, 0, NULL, '2025-08-28 00:35:03', '2025-08-28 00:35:03'),
(173, 'MG-RB7', 'MEJA GURU', 11, 1, 1, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(174, 'KG-RB7', 'KURSI GURU', 11, 1, 1, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(175, 'MM-RB7', 'MEJA MURID', 11, 28, 27, 0, 1, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(176, 'KM-RB7', 'KURSI MURID', 11, 28, 28, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(177, 'PT-RB7', 'PAPAN TULIS', 11, 1, 1, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(178, 'LEMARI-RB7', 'LEMARI', 11, 0, 0, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(179, 'GBG-RB7', 'GAMBAR BURUNG GARUDA', 11, 0, 0, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(180, 'FP-RB7', 'FOTO PRESIDEN', 11, 0, 0, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(181, 'FWP-RB7', 'FOTO WAKIL PRESIDEN', 11, 0, 0, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(182, 'JD-RB7', 'JAM DINDING', 11, 1, 1, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(183, 'SAPU-RB7', 'SAPU ', 11, 4, 4, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(184, 'KP-RB7', 'KAIN PEL', 11, 2, 2, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(185, 'TM-RB7', 'TAPLAK MEJA', 11, 1, 1, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(186, 'KA-RB7', 'KIPAS ANGIN', 11, 2, 1, 1, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(187, 'EMBE-RB7', 'EMBER', 11, 2, 2, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(188, 'WK-RB7', 'WIPER KACA', 11, 2, 2, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(189, 'LAMP-RB7', 'LAMPU', 11, 2, 2, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(190, 'JPEL-RB7', 'JADWAL PELAJARAN', 11, 2, 2, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(191, 'JPIK-RB7', 'JADWAL PIKET', 11, 2, 2, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(192, 'STOK-RB7', 'STRUKTUR ORGANISASI KELAS', 11, 2, 2, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(193, 'KK-RB7', 'KESEPAKATAN KELAS', 11, 2, 2, 0, 0, NULL, '2025-08-28 00:37:11', '2025-08-28 00:37:11'),
(194, 'MG-RB8', 'MEJA GURU', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(195, 'KG-RB8', 'KURSI GURU', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(196, 'MM-RB8', 'MEJA MURID', 12, 19, 19, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(197, 'KM-RB8', 'KURSI MURID', 12, 29, 29, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(198, 'PT-RB8', 'PAPAN TULIS', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(199, 'LEMARI-RB8', 'LEMARI', 12, 0, 0, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(200, 'GBG-RB8', 'GAMBAR BURUNG GARUDA', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(201, 'FP-RB8', 'FOTO PRESIDEN', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(202, 'FWP-RB8', 'FOTO WAKIL PRESIDEN', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(203, 'JD-RB8', 'JAM DINDING', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(204, 'SAPU-RB8', 'SAPU ', 12, 4, 4, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(205, 'KP-RB8', 'KAIN PEL', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(206, 'TM-RB8', 'TAPLAK MEJA', 12, 0, 0, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(207, 'KA-RB8', 'KIPAS ANGIN', 12, 4, 4, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(208, 'EMBE-RB8', 'EMBER', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(209, 'WK-RB8', 'WIPER KACA', 12, 1, 1, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(210, 'LAMP-RB8', 'LAMPU', 12, 2, 2, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(211, 'JPEL-RB8', 'JADWAL PELAJARAN', 12, 0, 0, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(212, 'JPIK-RB8', 'JADWAL PIKET', 12, 0, 0, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(213, 'STOK-RB8', 'STRUKTUR ORGANISASI KELAS', 12, 0, 0, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(214, 'KK-RB8', 'KESEPAKATAN KELAS', 12, 0, 0, 0, 0, NULL, '2025-08-28 00:38:33', '2025-08-28 00:38:33'),
(215, 'MG-RB10', 'MEJA GURU', 13, 1, 0, 1, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(216, 'KG-RB10', 'KURSI GURU', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(217, 'MM-RB10', 'MEJA MURID', 13, 20, 18, 2, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(218, 'KM-RB10', 'KURSI MURID', 13, 36, 28, 7, 1, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(219, 'PT-RB10', 'PAPAN TULIS', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(220, 'LEMARI-RB10', 'LEMARI', 13, 0, 0, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(221, 'GBG-RB10', 'GAMBAR BURUNG GARUDA', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(222, 'FP-RB10', 'FOTO PRESIDEN', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(223, 'FWP-RB10', 'FOTO WAKIL PRESIDEN', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(224, 'JD-RB10', 'JAM DINDING', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(225, 'SAPU-RB10', 'SAPU ', 13, 10, 0, 9, 1, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(226, 'KP-RB10', 'KAIN PEL', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(227, 'TM-RB10', 'TAPLAK MEJA', 13, 0, 0, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(228, 'KA-RB10', 'KIPAS ANGIN', 13, 4, 4, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(229, 'EMBE-RB10', 'EMBER', 13, 4, 4, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(230, 'WK-RB10', 'WIPER KACA', 13, 0, 0, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(231, 'LAMP-RB10', 'LAMPU', 13, 4, 4, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(232, 'JPEL-RB10', 'JADWAL PELAJARAN', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(233, 'JPIK-RB10', 'JADWAL PIKET', 13, 2, 2, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(234, 'STOK-RB10', 'STRUKTUR ORGANISASI KELAS', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12'),
(235, 'KK-RB10', 'KESEPAKATAN KELAS', 13, 1, 1, 0, 0, NULL, '2025-08-28 00:40:12', '2025-08-28 00:40:12');

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
('gjy8cdikRC54YMxdpZVkkd9sOzyUMhkaEBIWQZDp', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnd5YzR2cXl0MlV0aE1CcG9OeDZ0WFo3SjljRzEzM3lJaktQenpIVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zYXJwcmFzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1756366812);

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
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$a5xhVTy/hqKDVI7Doj6UZeCnwJDqtv9loyruqmLVzujP4UAG8g1ey', 'admin', NULL, NULL, '2025-08-27 23:41:38', '2025-08-27 23:41:38'),
(2, 'Tata Usaha', 'tu@gmail.com', NULL, '$2y$12$0.OHfxwSsp8MIrqbII5jEuPyhWl4fe6Bi.cXh/htkY3.C2zqBP8r6', 'tu', NULL, NULL, '2025-08-27 23:41:38', '2025-08-27 23:41:38');

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
-- Indeks untuk tabel `rekap_bulanan`
--
ALTER TABLE `rekap_bulanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rekap_unique` (`sarpras_id`,`kelas_id`,`bulan`,`tahun`),
  ADD KEY `rekap_bulanan_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `rekap_sarpras`
--
ALTER TABLE `rekap_sarpras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekap_sarpras_sarpras_id_foreign` (`sarpras_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rekap_bulanan`
--
ALTER TABLE `rekap_bulanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekap_sarpras`
--
ALTER TABLE `rekap_sarpras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sarpras`
--
ALTER TABLE `sarpras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekap_bulanan`
--
ALTER TABLE `rekap_bulanan`
  ADD CONSTRAINT `rekap_bulanan_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekap_bulanan_sarpras_id_foreign` FOREIGN KEY (`sarpras_id`) REFERENCES `sarpras` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekap_sarpras`
--
ALTER TABLE `rekap_sarpras`
  ADD CONSTRAINT `rekap_sarpras_sarpras_id_foreign` FOREIGN KEY (`sarpras_id`) REFERENCES `sarpras` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sarpras`
--
ALTER TABLE `sarpras`
  ADD CONSTRAINT `sarpras_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
