-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Agu 2022 pada 16.41
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitkepam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_santri`
--

CREATE TABLE `absensi_santri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `santri_id` int(11) NOT NULL,
  `kehadiran_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi_santri`
--

INSERT INTO `absensi_santri` (`id`, `tanggal`, `santri_id`, `kehadiran_id`, `created_at`, `updated_at`) VALUES
(1, '2022-07-24', 2020210001, 1, '2022-07-24 19:54:42', '2022-07-24 19:54:42'),
(3, '2022-07-25', 2020210002, 1, '2022-07-25 03:56:55', '2022-07-25 03:56:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_ustadz`
--

CREATE TABLE `absensi_ustadz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `ustadz_id` int(11) NOT NULL,
  `kehadiran_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensi_ustadz`
--

INSERT INTO `absensi_ustadz` (`id`, `tanggal`, `ustadz_id`, `kehadiran_id`, `created_at`, `updated_at`) VALUES
(1, '2022-07-12', 1, 6, '2022-07-12 14:15:46', '2022-07-12 14:15:46'),
(3, '2022-07-14', 1, 1, '2022-07-14 04:43:41', '2022-07-14 04:43:41'),
(4, '2022-08-04', 1, 1, '2022-08-04 16:09:44', '2022-08-04 16:09:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_hari` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id`, `nama_hari`, `created_at`, `updated_at`) VALUES
(1, 'Senin', '2022-07-12 13:35:20', '2022-07-12 13:35:20'),
(2, 'Selasa', '2022-07-12 13:35:20', '2022-07-12 13:35:20'),
(3, 'Rabu', '2022-07-12 13:35:20', '2022-07-12 13:35:20'),
(4, 'Kamis', '2022-07-12 13:35:20', '2022-07-12 13:35:20'),
(5, 'Jum\'at', '2022-07-12 13:35:20', '2022-07-12 13:35:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `ustadz_id` int(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruang_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `hari_id`, `kelas_id`, `mapel_id`, `ustadz_id`, `jam_mulai`, `jam_selesai`, `ruang_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, 1, 1, '20:30:08', '20:30:20', 1, '2022-07-12 14:07:51', '2022-07-13 12:01:55', NULL),
(2, 1, 1, 2, 2, '08:00:00', '09:00:00', 1, '2022-07-13 16:45:28', '2022-07-13 16:49:25', NULL),
(3, 4, 1, 3, 3, '09:00:00', '10:00:00', 1, '2022-07-20 04:05:19', '2022-07-20 04:08:57', '2022-07-20 04:08:57'),
(4, 4, 1, 3, 3, '09:00:00', '10:00:00', 1, '2022-07-20 04:09:28', '2022-07-20 04:10:35', '2022-07-20 04:10:35'),
(5, 4, 1, 3, 3, '09:00:00', '10:00:00', 1, '2022-07-20 04:12:22', '2022-07-20 04:12:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL,
  `nama_kamar` varchar(200) NOT NULL,
  `nama_pj` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id`, `nama_kamar`, `nama_pj`) VALUES
(2, 'ArRahamn', 'Ustadz Rohim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ket` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kehadiran`
--

INSERT INTO `kehadiran` (`id`, `ket`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Hadir', '3C0', '2022-07-12 13:35:21', '2022-07-12 13:35:21'),
(2, 'Izin', '0CF', '2022-07-12 13:35:21', '2022-07-12 13:35:21'),
(4, 'Sakit', 'FF0', '2022-07-12 13:35:21', '2022-07-12 13:35:21'),
(6, 'Tanpa Keterangan', 'F00', '2022-07-12 13:35:21', '2022-07-12 13:35:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paket_id` int(11) NOT NULL,
  `ustadz_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `paket_id`, `ustadz_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UTSMAN 1', 9, 1, '2022-07-12 14:00:44', '2022-07-12 14:00:44', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mapel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paket_id` int(11) NOT NULL,
  `kelompok` enum('A','B','C') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `nama_mapel`, `paket_id`, `kelompok`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Khulasoh', 9, 'A', '2022-07-12 13:56:09', '2022-07-13 16:44:56', NULL),
(2, 'Fiqih 1', 9, 'A', '2022-07-13 16:44:02', '2022-07-13 16:44:02', NULL),
(3, 'Bahasa Arab 1', 9, 'C', '2022-07-20 03:58:38', '2022-07-20 03:58:38', NULL),
(4, 'ss', 2, 'A', '2022-07-24 17:37:36', '2022-07-24 17:37:48', '2022-07-24 17:37:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_12_092809_create_hari_table', 1),
(5, '2020_03_12_092854_create_guru_table', 1),
(6, '2020_03_12_092926_create_absensi_guru_table', 1),
(7, '2020_03_12_092941_create_jadwal_table', 1),
(8, '2020_03_12_092953_create_kehadiran_table', 1),
(9, '2020_03_12_093010_create_kelas_table', 1),
(10, '2020_03_12_093018_create_mapel_table', 1),
(11, '2020_03_12_093027_create_nilai_table', 1),
(12, '2020_03_12_093036_create_paket_table', 1),
(13, '2020_03_12_093050_create_pengumuman_table', 1),
(14, '2020_03_12_093102_create_rapot_table', 1),
(15, '2020_03_12_093117_create_ruang_table', 1),
(16, '2020_03_12_093130_create_siswa_table', 1),
(17, '2020_03_16_102220_create_ulangan_table', 1),
(18, '2020_04_07_094355_create_sikap_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ustadz_id` int(11) NOT NULL,
  `kkm` int(11) NOT NULL DEFAULT 70,
  `deskripsi_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_c` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_d` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `ustadz_id`, `kkm`, `deskripsi_a`, `deskripsi_b`, `deskripsi_c`, `deskripsi_d`, `created_at`, `updated_at`) VALUES
(1, 1, 70, 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', '2022-07-12 13:59:14', '2022-07-12 14:19:10'),
(2, 2, 70, 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', '2022-07-13 16:48:48', '2022-07-13 17:20:16'),
(3, 3, 70, 'Sangat Baik', 'Baik', 'Cukup', 'Kurang', '2022-07-20 04:00:34', '2022-07-24 04:50:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ket` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id`, `ket`, `created_at`, `updated_at`) VALUES
(1, 'Tahfidz', '2022-07-12 13:35:21', '2022-07-12 13:35:21'),
(2, 'Kitab Kuning', '2022-07-12 13:35:21', '2022-07-12 13:35:21'),
(3, 'Bahasa', '2022-07-12 13:35:21', '2022-07-12 13:35:21'),
(9, 'Semua', '2022-07-12 03:35:20', '2022-07-12 13:35:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opsi` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `opsi`, `isi`, `created_at`, `updated_at`) VALUES
(1, 'pengumuman', 'pengumuman', '2022-07-12 13:35:21', '2022-07-12 13:35:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rapot`
--

CREATE TABLE `rapot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `ustadz_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `p_nilai` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_predikat` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `k_nilai` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `k_predikat` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `k_deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rapot`
--

INSERT INTO `rapot` (`id`, `santri_id`, `kelas_id`, `ustadz_id`, `mapel_id`, `p_nilai`, `p_predikat`, `p_deskripsi`, `k_nilai`, `k_predikat`, `k_deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '83', 'B', 'Baik', '85', 'B', 'Baik', '2022-07-12 14:29:43', '2022-07-12 14:30:41'),
(2, 1, 1, 2, 2, '85', 'B', 'Baik', '85', 'B', 'Baik', '2022-07-13 17:21:29', '2022-07-13 17:23:50'),
(3, 2, 1, 2, 2, '85', 'B', 'Baik', '85', 'B', 'Baik', '2022-07-13 17:21:50', '2022-07-13 17:23:54'),
(4, 2, 1, 1, 1, '84', 'B', 'Baik', '88', 'B', 'Baik', '2022-07-14 04:31:25', '2022-07-14 04:32:26'),
(5, 1, 1, 3, 3, '82', 'B', 'Baik', NULL, NULL, NULL, '2022-07-24 04:53:14', '2022-07-24 04:53:14'),
(6, 2, 1, 3, 3, '82', 'B', 'Baik', NULL, NULL, NULL, '2022-07-24 14:46:09', '2022-07-24 14:46:09'),
(7, 1, 1, 3, 3, '82', 'B', 'Baik', NULL, NULL, NULL, '2022-07-24 15:07:17', '2022-07-24 15:07:17'),
(8, 2, 1, 3, 3, '82', 'B', 'Baik', NULL, NULL, NULL, '2022-07-24 15:14:06', '2022-07-24 15:14:06'),
(9, 2, 1, 3, 3, '80', 'C', 'Cukup', NULL, NULL, NULL, '2022-07-24 15:50:49', '2022-07-24 15:50:49'),
(10, 2, 1, 3, 3, '80', 'C', 'Cukup', NULL, NULL, NULL, '2022-07-24 15:53:03', '2022-07-24 15:53:03'),
(11, 2, 1, 3, 3, '80', 'C', 'Cukup', NULL, NULL, NULL, '2022-07-24 16:05:05', '2022-07-24 16:05:05'),
(12, 1, 1, 3, 3, '83', 'B', 'Baik', NULL, NULL, NULL, '2022-07-24 17:44:54', '2022-07-24 17:44:54'),
(13, 2, 1, 3, 3, '79', 'C', 'Cukup', NULL, NULL, NULL, '2022-07-24 17:52:48', '2022-07-24 17:52:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id`, `nama_ruang`, `created_at`, `updated_at`) VALUES
(1, 'Ruang 01', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(2, 'Ruang 02', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(3, 'Ruang 03', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(4, 'Ruang 04', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(5, 'Ruang 05', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(6, 'Ruang 06', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(7, 'Ruang 07', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(8, 'Ruang 08', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(9, 'Ruang 09', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(10, 'Ruang 10', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(11, 'Ruang 11', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(12, 'Ruang 12', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(13, 'Ruang 13', '2022-07-12 13:35:22', '2022-07-12 13:35:22'),
(14, 'Ruang 14', '2022-07-12 13:35:23', '2022-07-12 13:35:23'),
(15, 'Ruang 15', '2022-07-12 13:35:23', '2022-07-12 13:35:23'),
(16, 'Ruang 16', '2022-07-12 13:35:23', '2022-07-12 13:35:23'),
(17, 'Ruang 17', '2022-07-12 13:35:23', '2022-07-12 13:35:23'),
(18, 'Ruang 18', '2022-07-12 13:35:23', '2022-07-12 13:35:23'),
(19, 'Ruang 19', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(20, 'Ruang 20', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(21, 'Ruang 21', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(22, 'Ruang 22', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(23, 'Ruang 23', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(24, 'Ruang 24', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(25, 'Ruang 25', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(26, 'Ruang 26', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(27, 'Ruang 27', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(28, 'Ruang 28', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(29, 'Ruang 29', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(30, 'Ruang 30', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(31, 'Ruang 31', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(32, 'Ruang 32', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(33, 'Ruang 33', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(34, 'Ruang 34', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(35, 'Ruang 35', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(36, 'Ruang 36', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(37, 'Ruang 37', '2022-07-12 13:35:24', '2022-07-12 13:35:24'),
(38, 'Ruang 38', '2022-07-12 13:35:25', '2022-07-12 13:35:25'),
(39, 'Ruang 39', '2022-07-12 13:35:25', '2022-07-12 13:35:25'),
(40, 'Ruang 40', '2022-07-12 13:35:25', '2022-07-12 13:35:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

CREATE TABLE `santri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_induk` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_santri` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_kamar` int(11) NOT NULL,
  `tahun_masuk` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smt` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`id`, `no_induk`, `nis`, `nama_santri`, `jk`, `telp`, `tmp_lahir`, `tgl_lahir`, `foto`, `kelas_id`, `created_at`, `updated_at`, `deleted_at`, `id_kamar`, `tahun_masuk`, `smt`) VALUES
(1, '2020210001', '2020210001', 'Farhan M Aminudin', 'L', '088', 'Cianjur', '2008-10-12', 'uploads/santri/46022112072022_foto_ibi_page-0001.jpg', 1, '2022-07-12 14:02:46', '2022-07-12 14:02:46', NULL, 0, '', ''),
(2, '2020210002', '2020210002', 'Rizaldi Ahmad', 'L', '08782', 'Sukabumi', '2006-12-12', 'uploads/santri/52471919042020_male.jpg', 1, '2022-07-13 16:46:39', '2022-07-13 16:46:39', NULL, 0, '', ''),
(3, '112233', '221133', 'Rudiansyah', 'L', '022212', 'Cianjur', '2007-02-02', 'uploads/santri/30352118082022_de1ecd55c76f4d5fc200fbc03b7e040f.jpg', 1, '2022-08-18 14:35:30', '2022-08-18 14:35:30', NULL, 2, '2022', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sikap`
--

CREATE TABLE `sikap` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `ustadz_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `sikap_1` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sikap_2` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sikap_3` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sikap`
--

INSERT INTO `sikap` (`id`, `santri_id`, `kelas_id`, `ustadz_id`, `mapel_id`, `sikap_1`, `sikap_2`, `sikap_3`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 2, 2, '3', '3', '3', '2022-07-13 17:22:37', '2022-07-13 17:22:37'),
(3, 2, 1, 2, 2, '3', '3', '3', '2022-07-13 17:22:43', '2022-07-13 17:22:43'),
(4, 2, 1, 2, 2, '3', '3', '3', '2022-07-13 17:22:58', '2022-07-13 17:22:58'),
(5, 2, 1, 2, 2, '3', '3', '3', '2022-07-13 17:23:03', '2022-07-13 17:23:03'),
(6, 2, 1, 1, 1, '4', '4', '4', '2022-07-14 04:31:59', '2022-07-14 04:31:59'),
(8, 1, 1, 3, 3, '4', '4', '4', '2022-07-24 16:38:24', '2022-07-24 16:38:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulangan`
--

CREATE TABLE `ulangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `santri_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `ustadz_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `ulha_1` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ulha_2` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uts` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ulha_3` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uas` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ulangan`
--

INSERT INTO `ulangan` (`id`, `santri_id`, `kelas_id`, `ustadz_id`, `mapel_id`, `ulha_1`, `ulha_2`, `uts`, `ulha_3`, `uas`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '80', '80', '90', '80', '85', '2022-07-12 14:29:04', '2022-07-12 14:29:04'),
(3, 2, 1, 2, 2, '80', '83', '85', '86', '88', '2022-07-13 17:21:50', '2022-07-13 17:21:50'),
(4, 2, 1, 1, 1, '75', '80', '85', '85', '90', '2022-07-14 04:31:26', '2022-07-14 04:31:26'),
(7, 1, 1, 3, 3, '88', '88', '80', '84', '80', '2022-07-24 15:07:17', '2022-07-24 17:44:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Ustadz','Santri') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_induk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `no_induk`, `id_card`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$aSBe/2hr7WpLFrrYI8mqJ.YVGvueqeC1Fgq9DuVIuoZpTsW7u0Jti', 'Admin', NULL, NULL, NULL, '2022-07-12 13:35:26', '2022-07-12 13:35:26', NULL),
(2, 'Rosidah Saadah', 'rosidah@gmail.com', NULL, '$2y$10$GdPkqrzVxzpUDcZblgCiBuJyiS.QWcFg3kzlxRlfwu/cIwNHczQG.', 'Ustadz', NULL, '00001', NULL, '2022-07-12 14:10:25', '2022-07-12 14:10:25', NULL),
(3, 'farhan m aminudin', 'hanfarhan@gmail.com', NULL, '$2y$10$zsFQ6Uv.WV/mBZc.odSxKOuxSDvDMIiokJMOO.Af5lL9DwMPodcbC', 'Santri', '2020210001', NULL, NULL, '2022-07-12 14:11:50', '2022-07-12 14:11:50', NULL),
(5, 'Salman Alfaritsi', 'salman@gmail.com', NULL, '$2y$10$AA8FSmpBaDbZ3anInjsYNuJ56eyYsfb59RJZpTbc43Qq3lcy5.o5y', 'Ustadz', NULL, '00002', NULL, '2022-07-13 16:50:20', '2022-07-13 16:50:20', NULL),
(6, 'Rohmat', 'rohmat@gmail.com', NULL, '$2y$10$Xfx.d492aToPbEanuFjWxevCvKBy4EX4G25Fg4jZHsqFRfDBcaSnC', 'Ustadz', NULL, '00003', NULL, '2022-07-20 04:20:45', '2022-07-20 04:20:45', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ustadz`
--

CREATE TABLE `ustadz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_card` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ustadz` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `kode` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmp_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ustadz`
--

INSERT INTO `ustadz` (`id`, `id_card`, `nip`, `nama_ustadz`, `mapel_id`, `kode`, `jk`, `telp`, `tmp_lahir`, `tgl_lahir`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '00001', '123456', 'Rosidah Saadah', 1, 'R01', 'P', '088', 'Cianjur', '1989-08-02', 'uploads/ustadz/14592012072022_2de8291bec10f48a5c03abec108584e4_page-0001.jpg', '2022-07-12 13:59:14', '2022-07-12 13:59:14', NULL),
(2, '00002', '123456', 'Salman Alfaritsi', 2, 'R02', 'L', '088', 'Bandung', '1980-02-06', 'uploads/ustadz/35251431012020_male.jpg', '2022-07-13 16:48:48', '2022-07-13 16:48:48', NULL),
(3, '00003', '123456222', 'Rohmat', 3, 'R03', 'L', '08888', 'Cianjur', '1988-05-02', 'uploads/ustadz/34001120072022_455e47b872676beeb320499273d3c08f_page-0001.jpg', '2022-07-20 04:00:34', '2022-07-20 04:00:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi_santri`
--
ALTER TABLE `absensi_santri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absensi_ustadz`
--
ALTER TABLE `absensi_ustadz`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rapot`
--
ALTER TABLE `rapot`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sikap`
--
ALTER TABLE `sikap`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ulangan`
--
ALTER TABLE `ulangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `ustadz`
--
ALTER TABLE `ustadz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi_santri`
--
ALTER TABLE `absensi_santri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `absensi_ustadz`
--
ALTER TABLE `absensi_ustadz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rapot`
--
ALTER TABLE `rapot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `santri`
--
ALTER TABLE `santri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sikap`
--
ALTER TABLE `sikap`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ulangan`
--
ALTER TABLE `ulangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ustadz`
--
ALTER TABLE `ustadz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
