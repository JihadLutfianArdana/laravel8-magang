-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2025 at 01:50 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_pesertas`
--

CREATE TABLE `absensi_pesertas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `hari_tanggal` date NOT NULL,
  `waktu_masuk` time NOT NULL,
  `waktu_keluar` time DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edited_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi_pesertas`
--

INSERT INTO `absensi_pesertas` (`id`, `user_id`, `hari_tanggal`, `waktu_masuk`, `waktu_keluar`, `status`, `keterangan`, `alasan`, `bukti`, `edited_by`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-06-03', '06:52:14', '06:52:15', 'Hadir', NULL, NULL, NULL, NULL, '2025-06-02 22:52:14', '2025-06-02 22:52:15'),
(2, 2, '2025-06-15', '16:39:41', '16:39:48', 'Hadir', 'Terlambat', NULL, NULL, NULL, '2025-06-15 08:39:41', '2025-06-15 08:39:48'),
(3, 5, '2025-06-21', '13:41:14', '13:41:15', 'Hadir', 'Terlambat', NULL, NULL, NULL, '2025-06-21 05:41:14', '2025-06-21 05:41:15'),
(4, 2, '2025-06-21', '15:19:12', NULL, 'Sakit', NULL, 'Sakit Kepala', 'bukti_absensi/wx6brzUm4u92ylUiHUddtiNwtyDSSWIdDMu9WfOu.jpg', NULL, '2025-06-21 07:19:12', '2025-06-21 07:19:12'),
(5, 6, '2025-06-26', '07:41:23', '07:41:24', 'Hadir', NULL, NULL, NULL, NULL, '2025-06-25 23:41:23', '2025-06-25 23:41:24'),
(6, 7, '2025-06-26', '12:02:03', '12:02:05', 'Hadir', 'Terlambat', NULL, NULL, NULL, '2025-06-26 04:02:03', '2025-06-26 04:02:05'),
(7, 2, '2025-07-02', '07:39:30', '07:39:33', 'Hadir', NULL, NULL, NULL, NULL, '2025-07-01 23:39:30', '2025-07-01 23:39:33'),
(8, 2, '2025-07-29', '08:04:25', NULL, 'Hadir', 'Terlambat', NULL, NULL, NULL, '2025-07-29 00:04:25', '2025-07-29 00:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `detail_magangs`
--

CREATE TABLE `detail_magangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nism` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_peserta` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah_universitas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_jurusan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pembimbing` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_anggota` int NOT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_magangs`
--

INSERT INTO `detail_magangs` (`id`, `user_id`, `nism`, `nama_peserta`, `asal_sekolah_universitas`, `kelas_jurusan`, `nama_pembimbing`, `jumlah_anggota`, `status`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(1, 2, '2110010519', 'Muhammad Bintang Fatehah', 'UNISKA Banjarbaru', 'Teknik Informatika', 'Jihad Lutfian Ardana', 3, 'Aktif', '2024-09-30', '2024-11-30', '2025-06-02 22:52:03', '2025-06-26 00:13:13'),
(2, 5, '2110010520', 'Nail Ompi', 'POLIBAN', 'Teknik Informatika', 'Jihad Lutfian Ardana', 3, 'Aktif', '2024-09-30', '2024-11-30', '2025-06-21 05:41:07', '2025-07-05 08:59:08'),
(3, 6, '2110010555', 'Willy Wilson', 'UNISKA Banjarbaru', 'Teknik Informatika', 'Jihad Lutfian Ardana', 3, 'Aktif', '2024-09-30', '2024-11-30', '2025-06-25 23:41:14', '2025-06-25 23:41:14'),
(4, 7, '2110010518', 'Mail', 'POLIBAN', 'Teknik Informatika', 'Jihad Lutfian Ardana', 3, 'Aktif', '2025-06-26', '2025-06-30', '2025-06-26 04:01:52', '2025-06-26 04:01:52'),
(5, 8, '2110010512', 'Bambang', 'UNAIR', 'Teknik Informatika', 'Jihad Lutfian Ardana', 3, 'Aktif', '2024-09-30', '2024-11-30', '2025-06-26 05:52:59', '2025-07-05 08:35:36'),
(6, 14, '2110010522', 'Ebew', 'UNISKA Banjarbaru', 'Teknik Informatika', 'Jihad Lutfian Ardana', 3, 'Aktif', '2024-09-30', '2024-11-30', '2025-07-29 00:30:38', '2025-07-29 00:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_pembimbings`
--

CREATE TABLE `evaluasi_pembimbings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `keterampilan_arahan` int NOT NULL,
  `kepedulian_sikap` int NOT NULL,
  `membimbing_solusi` int NOT NULL,
  `disiplin_tanggung_jawab` int NOT NULL,
  `kesiapan_materi` int NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `tanggal_penilaian` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jadwal_magangs`
--

CREATE TABLE `jadwal_magangs` (
  `id` bigint UNSIGNED NOT NULL,
  `detail_magang_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ruangan_id` bigint UNSIGNED NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_magangs`
--

INSERT INTO `jadwal_magangs` (`id`, `detail_magang_id`, `user_id`, `ruangan_id`, `tanggal_awal`, `tanggal_akhir`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '2024-09-30', '2024-10-30', '2025-06-26 13:27:49', '2025-06-26 13:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_magangs`
--

CREATE TABLE `kegiatan_magangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `deskripsi_kegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_kegiatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dok_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revisi` text COLLATE utf8mb4_unicode_ci,
  `status_revisi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_selesai` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan_magangs`
--

INSERT INTO `kegiatan_magangs` (`id`, `user_id`, `nama_kegiatan`, `tanggal_kegiatan`, `deskripsi_kegiatan`, `lokasi_kegiatan`, `dok_kegiatan`, `revisi`, `status_revisi`, `created_at`, `updated_at`, `status_selesai`) VALUES
(1, 2, 'Pembukaan Pelatihan Kesehatan', '2025-06-03', 'Pembukaan Pelatihan', 'Aula Balai Pelatihan Kesehatan', 'dokumen-kegiatan/hpA7qaD8d9b46autSgVmy03qcMOx2Bs0QV4tLwiX.jpg', NULL, '-', '2025-06-02 22:52:51', '2025-06-21 05:42:55', 1),
(2, 2, 'Penutupan Pelatihan', '2025-06-21', 'Penutupan Pelatihan Kesehatan', 'Aula Balai Pelatihan Kesehatan', NULL, NULL, '-', '2025-06-21 05:40:21', '2025-07-29 05:50:37', 1),
(3, 5, 'Pembukaan Pelatihan', '2025-06-21', 'Pembukaan Pelatihan', 'Qmall', NULL, NULL, '-', '2025-06-21 05:41:40', '2025-06-21 05:43:08', 1),
(4, 5, 'Penutupan Pelatihan', '2025-06-21', 'Penutupan Pelatihan', 'Qmall', NULL, NULL, '-', '2025-06-21 05:41:54', '2025-06-21 05:43:09', 1),
(5, 6, 'Pembukaan Pelatihan', '2025-06-26', 'Pembukaan Pelatihan', 'Aula Balai Pelatihan Kesehatan', 'dokumen-kegiatan/RbQLT42H5lCckVHkiPJuF9Tm379PjiS6z6uedDld.jpg', NULL, '-', '2025-06-25 23:42:00', '2025-06-25 23:42:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_grafik`
--

CREATE TABLE `laporan_grafik` (
  `id` bigint UNSIGNED NOT NULL,
  `asal_sekolah_universitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `tanggal_mulai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_grafik`
--

INSERT INTO `laporan_grafik` (`id`, `asal_sekolah_universitas`, `jumlah`, `tanggal_mulai`, `created_at`, `updated_at`) VALUES
(1, 'UNISKA Banjarbaru', 7, '2024-09-30', '2025-06-02 22:52:03', '2025-07-29 00:31:16'),
(2, 'POLIBAN', 2, '2024-09-30', '2025-06-21 05:41:07', '2025-07-05 08:59:08'),
(3, 'UNISKA Banjarbaru', 1, '2025-06-23', '2025-06-23 13:43:57', '2025-06-23 13:43:57'),
(4, 'POLIBAN', 2, '2025-06-26', '2025-06-26 00:13:45', '2025-06-26 04:01:52'),
(5, 'UNAIR', 1, '2025-06-26', '2025-06-26 05:52:59', '2025-06-26 05:52:59'),
(6, 'UNAIR', 1, '2024-09-30', '2025-07-05 08:35:36', '2025-07-05 08:35:36');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2024_11_28_150110_create_profile_pesertas_table', 1),
(5, '2024_11_28_151509_create_detail_magangs_table', 1),
(6, '2024_11_28_151952_create_kegiatan_magangs_table', 1),
(7, '2024_12_03_235715_create_absensi_pesertas_table', 1),
(8, '2024_12_11_212205_add_approved_by_to_users_table', 1),
(9, '2024_12_14_142000_create_ruangans_table', 1),
(10, '2024_12_14_143024_create_jadwal_magangs_table', 1),
(11, '2024_12_19_205433_create_pendaftaran_pesertas_table', 1),
(12, '2025_01_12_151246_create_penilaian_pesertas_table', 1),
(13, '2025_01_15_071900_create_surat_balasan_magangs_table', 1),
(14, '2025_01_15_090329_create_surat_balasan_peserta_table', 1),
(15, '2025_01_15_171606_remove_pendaftaran_peserta_id_from_surat_balasan_magangs', 1),
(16, '2025_01_18_090201_add_pendaftaran_id_to_users_table', 1),
(17, '2025_03_14_005037_create_evaluasi_pembimbings_table', 1),
(18, '2025_05_29_125731_add_status_selesai_to_kegiatan_magangs_table', 1),
(19, '2025_05_30_140337_create_laporan_grafik_table', 1),
(20, '2025_06_03_063741_add_status_and_approval_date_to_pendaftaran_pesertas_table', 1),
(21, '2025_06_21_201930_add_tanggal_penilaian_to_penilaian_pesertas_table', 2),
(22, '2025_06_23_070711_create_penilaian_pembimbings_table', 3),
(23, '2025_06_23_101028_add_tanggal_penilaian_to_penilaian_pembimbings_table', 4),
(24, '2025_06_26_125153_add_nilai_saw_to_penilaian_pesertas_table', 5),
(25, '2025_07_02_073146_change_hari_tanggal_column_type_in_absensi_pesertas_table', 6),
(26, '2025_07_03_134448_drop_surat_balasan_peserta_table', 7),
(27, '2025_07_05_082836_add_nomor_sertifikat_to_penilaian_pesertas_table', 8),
(28, '2025_07_05_091936_add_tanggal_sertifikat_to_penilaian_pesertas_table', 9),
(29, '2025_07_05_132918_add_tanggal_perangkingan_to_penilaian_pesertas_table', 10);

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
-- Table structure for table `pendaftaran_pesertas`
--

CREATE TABLE `pendaftaran_pesertas` (
  `id` bigint UNSIGNED NOT NULL,
  `nism` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah_universitas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_jurusan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `surat_pengantar_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_checked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `tanggal_disetujui` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftaran_pesertas`
--

INSERT INTO `pendaftaran_pesertas` (`id`, `nism`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_telepon`, `email`, `asal_sekolah_universitas`, `kelas_jurusan`, `tanggal_mulai`, `tanggal_selesai`, `surat_pengantar_path`, `is_checked`, `created_at`, `updated_at`, `status`, `tanggal_disetujui`) VALUES
(1, '2110010519', 'Muhammad Bintang Fatehah', 'Banjarbaru', '2002-04-19', 'Laki-laki', 'JL . Golf', '62895700745598', 'bintang@gmail.com', 'UNISKA Banjarbaru', 'Teknik Informatika', '2024-09-30', '2024-09-30', 'surat_pengantar/jMmKO3gepwRmWmDuM28eZo64YAJNNXXccnqYrtdd.pdf', 0, '2025-06-02 22:50:39', '2025-07-29 05:59:06', 'Pending', NULL),
(2, '2110010520', 'Nail Ompi', 'Banjarmasin', '2002-09-28', 'Laki-laki', 'JL . Golf', '62895700745598', 'nail@gmail.com', 'POLIBAN', 'Teknik Informatika', '2024-09-30', '2024-11-30', 'surat_pengantar/TXSE2ecV6OvUGanPeYLpu4nHVeTSKGFuk0hi582W.pdf', 1, '2025-06-21 05:37:48', '2025-06-21 05:38:20', 'Disetujui', '2025-06-21 05:38:20'),
(3, '2110010555', 'Willy Wilson', 'Martapura', '2002-07-14', 'Laki-laki', 'JL . Golf', '62895700745598', 'willy123@gmail.com', 'UNISKA Banjarbaru', 'Teknik Informatika', '2024-09-30', '2024-11-30', 'surat_pengantar/4ilquUJx5xBDa2XCinC7lt9sNjGvXpZsyAAknjmn.pdf', 1, '2025-06-25 23:40:15', '2025-06-25 23:40:40', 'Disetujui', '2025-06-25 23:40:40'),
(4, '2110010518', 'Mail', 'Banjarmasin', '2002-07-15', 'Laki-laki', 'JL . Golf', '62895700745598', 'mail123@gmail.com', 'POLIBAN', 'Teknik Informatika', '2025-06-26', '2025-06-30', 'surat_pengantar/IMs0I9eWWGS5YBslYrJtJquGnt8olz9hlufdoTZw.pdf', 1, '2025-06-26 04:01:06', '2025-07-03 13:15:25', 'Disetujui', '2025-07-03 13:15:25'),
(6, '2110010522', 'Ebew', 'Martapura', '2004-07-13', 'Perempuan', 'JL . Golf', '62895700745598', 'ebew@gmail.com', 'UNISKA Banjarbaru', 'Teknik Informatika', '2024-09-30', '2024-11-30', 'surat_pengantar/KiKUTNt7WbOlWz6Y7bnKJYZcUp1LFlaAoDqRsKRv.pdf', 1, '2025-07-28 23:24:10', '2025-07-29 00:30:07', 'Disetujui', '2025-07-29 00:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_pembimbings`
--

CREATE TABLE `penilaian_pembimbings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nip_pembimbing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saran` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_penilaian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaian_pembimbings`
--

INSERT INTO `penilaian_pembimbings` (`id`, `user_id`, `nip_pembimbing`, `poin_1`, `poin_2`, `poin_3`, `poin_4`, `poin_5`, `saran`, `created_at`, `updated_at`, `tanggal_penilaian`) VALUES
(5, 5, 'P01', 'Baik', 'Baik', 'Baik', 'Baik', 'Sangat Baik', NULL, '2025-06-23 01:29:16', '2025-06-23 05:47:18', '2025-06-23'),
(6, 2, 'P01', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Baik', 'Sangat Baik', 'Mantap', '2025-06-23 02:19:48', '2025-06-23 12:52:11', '2025-06-23'),
(7, 6, 'P01', 'Kurang', 'Kurang', 'Cukup', 'Kurang', 'Kurang', NULL, '2025-07-02 12:36:59', '2025-07-02 12:36:59', '2025-07-02'),
(8, 7, 'P01', 'Sangat Baik', 'Kurang', 'Baik', 'Sangat Baik', 'Cukup', NULL, '2025-07-02 12:45:29', '2025-07-02 12:45:29', '2025-07-02'),
(9, 14, 'P01', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Sangat Baik', 'Baik', NULL, '2025-07-29 00:31:48', '2025-07-29 00:33:34', '2025-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_pesertas`
--

CREATE TABLE `penilaian_pesertas` (
  `id` bigint UNSIGNED NOT NULL,
  `detail_magang_id` bigint UNSIGNED NOT NULL,
  `nilai_kehadiran` int NOT NULL,
  `nilai_kegiatan` int NOT NULL,
  `nilai_sikap` int NOT NULL,
  `nilai_kedisiplinan` int NOT NULL,
  `nilai_kerjasama` int NOT NULL,
  `nilai_komunikasi` int NOT NULL,
  `nilai_tanggung_jawab` int NOT NULL,
  `nilai_saw` double(8,4) DEFAULT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `nomor_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_penilaian_selesai` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal_perangkingan` date DEFAULT NULL,
  `edited_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_penilaian` date DEFAULT NULL,
  `tanggal_sertifikat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaian_pesertas`
--

INSERT INTO `penilaian_pesertas` (`id`, `detail_magang_id`, `nilai_kehadiran`, `nilai_kegiatan`, `nilai_sikap`, `nilai_kedisiplinan`, `nilai_kerjasama`, `nilai_komunikasi`, `nilai_tanggung_jawab`, `nilai_saw`, `komentar`, `nomor_sertifikat`, `is_penilaian_selesai`, `tanggal_perangkingan`, `edited_by`, `created_at`, `updated_at`, `tanggal_penilaian`, `tanggal_sertifikat`) VALUES
(24, 1, 50, 50, 100, 100, 80, 100, 80, 1.0000, NULL, 'SM/BP-KES/VII/2025', 1, '2025-07-07', 4, '2025-07-06 23:49:47', '2025-07-29 05:54:20', '2025-07-29', '2025-07-07'),
(25, 2, 50, 50, 100, 100, 70, 100, 70, 0.9750, NULL, 'SM/BP-KES/VII/2025', 1, '2025-07-07', 4, '2025-07-06 23:50:17', '2025-07-07 00:10:43', '2025-07-07', '2025-07-07'),
(26, 3, 50, 50, 100, 100, 60, 100, 60, 0.9500, NULL, 'SM/BP-KES/VII/2025', 1, '2025-07-07', 4, '2025-07-06 23:55:29', '2025-07-07 00:10:48', '2025-07-07', '2025-07-07'),
(27, 5, 50, 50, 100, 100, 50, 100, 50, 0.9250, NULL, 'SM/BP-KES/VII/2025', 1, '2025-07-07', 4, '2025-07-06 23:55:46', '2025-07-07 00:11:00', '2025-07-07', '2025-07-07'),
(28, 4, 100, 100, 100, 100, 100, 100, 100, 1.0000, NULL, 'SM/BP-KES/VII/2025', 1, '2025-07-29', 4, '2025-07-07 00:04:39', '2025-07-29 06:40:55', '2025-07-07', '2025-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `profile_peserta`
--

CREATE TABLE `profile_peserta` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nism` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_peserta` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `asal_sekolah_universitas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_peserta`
--

INSERT INTO `profile_peserta` (`id`, `user_id`, `nism`, `nama_peserta`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `asal_sekolah_universitas`, `no_telepon`, `email`, `alamat`, `foto`, `created_at`, `updated_at`) VALUES
(1, 2, '2110010519', 'Muhammad Bintang Fatehah', 'Laki-laki', 'Banjarbaru', '2002-04-19', 'UNISKA Banjarbaru', '62895700745598', 'bintang@gmail.com', 'JL . Golf', 'images/LO1P91xqGMpmwUPFpWzP8jLNKozjWztVsGMrk5Xe.jpg', '2025-06-02 22:51:54', '2025-07-28 05:37:31'),
(2, 5, '2110010520', 'Nail Ompi', 'Laki-laki', 'Banjarmasin', '2002-09-28', 'POLIBAN', '62895700745598', 'nail@gmail.com', 'JL . Golf', NULL, '2025-06-21 05:40:59', '2025-06-21 05:40:59'),
(3, 6, '2110010555', 'Willy Wilson', 'Laki-laki', 'Martapura', '2002-07-14', 'UNISKA Banjarbaru', '62895700745598', 'willy123@gmail.com', 'JL . Golf', NULL, '2025-06-25 23:41:06', '2025-06-25 23:41:06'),
(4, 7, '2110010518', 'Mail', 'Laki-laki', 'Banjarmasin', '2002-07-15', 'POLIBAN', '62895700745598', 'mail123@gmail.com', 'JL . Golf', NULL, '2025-06-26 04:01:43', '2025-06-26 04:01:43'),
(5, 8, '2110010512', 'Bambang', 'Laki-laki', 'Banjar', '2002-07-11', 'UNAIR', '62895700745598', 'bambang@gmail.com', 'JL . Golf', NULL, '2025-06-26 05:52:50', '2025-06-26 05:52:50'),
(6, 14, '2110010522', 'Ebew', 'Perempuan', 'Martapura', '2004-07-13', 'UNISKA Banjarbaru', '62895700745598', 'ebew@gmail.com', 'JL . Golf', NULL, '2025-07-29 00:30:27', '2025-07-29 00:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pegawai` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `nama_ruangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `peran_khusus` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id`, `nip`, `nama_pegawai`, `jabatan`, `nama_ruangan`, `peran_khusus`, `created_at`, `updated_at`) VALUES
(1, 'P01', 'Jihad Lutfian Ardana', 'KADIS Bapelkes', 'Ruang Kepala Bapelkes', 'Pembimbing Lapangan', '2025-06-02 22:51:11', '2025-06-02 22:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `surat_balasan_magangs`
--

CREATE TABLE `surat_balasan_magangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pendaftaran_peserta_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `nomor_surat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hal` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_surat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kalimat_pembuka` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kalimat_penutup` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_balasan_magangs`
--

INSERT INTO `surat_balasan_magangs` (`id`, `user_id`, `pendaftaran_peserta_id`, `tanggal`, `nomor_surat`, `lampiran`, `hal`, `alamat_surat`, `kalimat_pembuka`, `kalimat_penutup`, `created_at`, `updated_at`) VALUES
(6, 3, 1, '2025-07-03', '001/BP-KES/07/2025', '-', 'Fasilitasi Praktek Kerja Mahasiswa', 'Yth. Dekan Fakultas Teknologi Informasi\r\nUniversitas Islam Kalimantan (UNISKA)\r\nMuhammad Arsyad Al-Banjari\r\ndi\r\nBanjarmasin', 'Menindaklanjuti surat dari Dekan Fakultas Teknologi Informasi Universitas Islam Kalimantan (UNISKA) di Banjarmasin, Nomor: 016/UNISKA-FTI/WA.15/IX/2024, tanggal 22 September 2024, Perihal Mohon kesediaan menerima praktek kerja mahasiswa, dengan ini kami sampaikan bahwa:', 'Dapat difasilitasi untuk melakukan praktek kerja di Balai Pelatihan Kesehatan Provinsi Kalimantan Selatan pada tanggal 30 September 2024 sampai dengan 30 November 2024, dengan syarat mengikuti ketentuan yang ada di Balai Pelatihan Kesehatan.\r\n\r\nDemikian kami sampaikan atas perhatian dan kerjasamanya kami ucapkan terima kasih.', '2025-07-03 06:23:39', '2025-07-03 13:06:47'),
(7, 3, 2, '2025-07-03', '002/BP-KES/07/2025', '-', 'Fasilitasi Praktek Kerja Mahasiswa (PKL)', 'Yth. Dekan Fakultas Teknologi Informasi\r\nUniversitas Islam Kalimantan (UNISKA)\r\nMuhammad Arsyad Al-Banjari\r\ndi\r\nBanjarmasin', 'Menindaklanjuti surat dari Dekan Fakultas Teknologi Informasi Universitas Islam Kalimantan (UNISKA) di Banjarmasin, Nomor: 016/UNISKA-FTI/WA.15/IX/2024, tanggal 22 September 2024, Perihal Mohon kesediaan menerima praktek kerja mahasiswa, dengan ini kami sampaikan bahwa:', 'Dapat difasilitasi untuk melakukan praktek kerja di Balai Pelatihan Kesehatan Provinsi Kalimantan Selatan pada tanggal 30 September 2024 sampai dengan 30 November 2024, dengan syarat mengikuti ketentuan yang ada di Balai Pelatihan Kesehatan.\r\n\r\nDemikian kami sampaikan atas perhatian dan kerjasamanya kami ucapkan terima kasih.', '2025-07-03 07:04:27', '2025-07-03 13:06:57'),
(9, 3, 3, '2025-07-03', '003/BP-KES/07/2025', '-', 'Fasilitasi Praktek Kerja Mahasiswa', 'Yth. Dekan Fakultas Teknologi Informasi\r\nUniversitas Islam Kalimantan (UNISKA)\r\nMuhammad Arsyad Al-Banjari\r\ndi\r\nBanjarmasin', 'Menindaklanjuti surat dari Dekan Fakultas Teknologi Informasi Universitas Islam Kalimantan (UNISKA) di Banjarmasin, Nomor: 016/UNISKA-FTI/WA.15/IX/2024, tanggal 22 September 2024, Perihal Mohon kesediaan menerima praktek kerja mahasiswa, dengan ini kami sampaikan bahwa:', 'Dapat difasilitasi untuk melakukan praktek kerja di Balai Pelatihan Kesehatan Provinsi Kalimantan Selatan pada tanggal 30 September 2024 sampai dengan 30 November 2024, dengan syarat mengikuti ketentuan yang ada di Balai Pelatihan Kesehatan.\r\n\r\nDemikian kami sampaikan atas perhatian dan kerjasamanya kami ucapkan terima kasih.', '2025-07-03 13:16:32', '2025-07-03 13:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int NOT NULL DEFAULT '0',
  `status_verifikasi` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_pendaftaran` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `is_admin`, `status_verifikasi`, `approved_by`, `remember_token`, `created_at`, `updated_at`, `id_pendaftaran`) VALUES
(1, 'Jihad Lutfian Ardana', 'lutfianjihadjizy@gmail.com', NULL, '$2y$10$z3p4NiX/vhiQU/sBvpZ98OG6F3nkeTIhE3D3nyiSp0IEjTDc8drCG', 1, 'verified', NULL, NULL, '2025-06-02 22:49:56', '2025-06-02 22:49:56', NULL),
(2, 'Muhammad Bintang Fatehah', 'bintang@gmail.com', NULL, '$2y$10$EWqEyYIJcNcYt/DmWiNqo.aywJimL7iV5HUxZkF/950AiwDUIKEXG', 0, 'verified', 1, NULL, '2025-06-02 22:50:55', '2025-06-02 22:51:32', NULL),
(3, 'Ahmad Wafi Dhiya', 'Ahmad@gmail.com', NULL, '$2y$10$ZXlmCmSE8LS4Om48LreNtupn6dP4Q8XRom2ueDy1qHV1mKLZwqTwO', 2, 'verified', NULL, NULL, '2025-06-02 22:53:32', '2025-06-02 22:53:32', NULL),
(4, 'Ihsan Ali Abdie', 'ihsangalon@gmail.com', NULL, '$2y$10$t3iMeP1GEC9l.hK32NbZXu.6TXIaHLDqm4WsL5N5y7dNJ4j14hRP2', 3, 'verified', NULL, NULL, '2025-06-02 22:53:49', '2025-06-02 22:53:49', NULL),
(5, 'Nail Ompi', 'nail@gmail.com', NULL, '$2y$10$l0nxIkXm/MSif.FJhpIq4eL4S18gm8R6.HfsaM2T.4jQ4jYM1fhBW', 0, 'verified', 3, NULL, '2025-06-21 05:38:00', '2025-06-21 05:38:27', NULL),
(6, 'Willy Wilson', 'willy123@gmail.com', NULL, '$2y$10$pz4uKOvY.gjHTL2cuSiHG.yrJZcXHLxME1TU4dYbbQFAEUrKvJqsC', 0, 'verified', 3, NULL, '2025-06-25 23:40:28', '2025-06-25 23:40:47', NULL),
(7, 'Mail', 'mail123@gmail.com', NULL, '$2y$10$MlH4TWg0.ew6R.RnhydQBuSuwh.a0SaZCeDTUR4di3mIlO5gc92Pe', 0, 'verified', 3, NULL, '2025-06-26 04:01:14', '2025-06-26 04:01:28', NULL),
(8, 'Bambang', 'bambang@gmail.com', NULL, '$2y$10$xwvCWsay/ivdc37f6EaSLeGRcOLVy9fSIM.pOllbaSJ7MeRy3yUae', 0, 'verified', 3, NULL, '2025-06-26 05:52:13', '2025-06-26 05:52:27', NULL),
(14, 'Ebew', 'ebew@gmail.com', NULL, '$2y$10$7qjD/t6ZslthbyTQEWL7E.ld0RTw1l7EYhmHGyHxHx7ixCvtc4.AO', 0, 'verified', 3, NULL, '2025-07-28 23:25:28', '2025-07-29 06:20:31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_pesertas`
--
ALTER TABLE `absensi_pesertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_pesertas_user_id_foreign` (`user_id`),
  ADD KEY `absensi_pesertas_edited_by_foreign` (`edited_by`);

--
-- Indexes for table `detail_magangs`
--
ALTER TABLE `detail_magangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `detail_magangs_user_id_unique` (`user_id`);

--
-- Indexes for table `evaluasi_pembimbings`
--
ALTER TABLE `evaluasi_pembimbings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluasi_pembimbings_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_magangs`
--
ALTER TABLE `jadwal_magangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_magangs_detail_magang_id_foreign` (`detail_magang_id`),
  ADD KEY `jadwal_magangs_user_id_foreign` (`user_id`),
  ADD KEY `jadwal_magangs_ruangan_id_foreign` (`ruangan_id`);

--
-- Indexes for table `kegiatan_magangs`
--
ALTER TABLE `kegiatan_magangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_magangs_user_id_foreign` (`user_id`);

--
-- Indexes for table `laporan_grafik`
--
ALTER TABLE `laporan_grafik`
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
-- Indexes for table `pendaftaran_pesertas`
--
ALTER TABLE `pendaftaran_pesertas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pendaftaran_pesertas_nism_unique` (`nism`),
  ADD UNIQUE KEY `pendaftaran_pesertas_email_unique` (`email`);

--
-- Indexes for table `penilaian_pembimbings`
--
ALTER TABLE `penilaian_pembimbings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_pembimbings_user_id_foreign` (`user_id`),
  ADD KEY `penilaian_pembimbings_nip_pembimbing_foreign` (`nip_pembimbing`);

--
-- Indexes for table `penilaian_pesertas`
--
ALTER TABLE `penilaian_pesertas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_pesertas_detail_magang_id_foreign` (`detail_magang_id`),
  ADD KEY `penilaian_pesertas_edited_by_foreign` (`edited_by`);

--
-- Indexes for table `profile_peserta`
--
ALTER TABLE `profile_peserta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profile_peserta_nism_unique` (`nism`),
  ADD UNIQUE KEY `profile_peserta_email_unique` (`email`),
  ADD KEY `profile_peserta_user_id_foreign` (`user_id`);

--
-- Indexes for table `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruangans_nip_unique` (`nip`);

--
-- Indexes for table `surat_balasan_magangs`
--
ALTER TABLE `surat_balasan_magangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pendaftaran` (`pendaftaran_peserta_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_approved_by_foreign` (`approved_by`),
  ADD KEY `users_id_pendaftaran_foreign` (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_pesertas`
--
ALTER TABLE `absensi_pesertas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_magangs`
--
ALTER TABLE `detail_magangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `evaluasi_pembimbings`
--
ALTER TABLE `evaluasi_pembimbings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_magangs`
--
ALTER TABLE `jadwal_magangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatan_magangs`
--
ALTER TABLE `kegiatan_magangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laporan_grafik`
--
ALTER TABLE `laporan_grafik`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pendaftaran_pesertas`
--
ALTER TABLE `pendaftaran_pesertas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penilaian_pembimbings`
--
ALTER TABLE `penilaian_pembimbings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penilaian_pesertas`
--
ALTER TABLE `penilaian_pesertas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `profile_peserta`
--
ALTER TABLE `profile_peserta`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_balasan_magangs`
--
ALTER TABLE `surat_balasan_magangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi_pesertas`
--
ALTER TABLE `absensi_pesertas`
  ADD CONSTRAINT `absensi_pesertas_edited_by_foreign` FOREIGN KEY (`edited_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `absensi_pesertas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_magangs`
--
ALTER TABLE `detail_magangs`
  ADD CONSTRAINT `detail_magangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `evaluasi_pembimbings`
--
ALTER TABLE `evaluasi_pembimbings`
  ADD CONSTRAINT `evaluasi_pembimbings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_magangs`
--
ALTER TABLE `jadwal_magangs`
  ADD CONSTRAINT `jadwal_magangs_detail_magang_id_foreign` FOREIGN KEY (`detail_magang_id`) REFERENCES `detail_magangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_magangs_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_magangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kegiatan_magangs`
--
ALTER TABLE `kegiatan_magangs`
  ADD CONSTRAINT `kegiatan_magangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian_pembimbings`
--
ALTER TABLE `penilaian_pembimbings`
  ADD CONSTRAINT `penilaian_pembimbings_nip_pembimbing_foreign` FOREIGN KEY (`nip_pembimbing`) REFERENCES `ruangans` (`nip`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_pembimbings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian_pesertas`
--
ALTER TABLE `penilaian_pesertas`
  ADD CONSTRAINT `penilaian_pesertas_detail_magang_id_foreign` FOREIGN KEY (`detail_magang_id`) REFERENCES `detail_magangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_pesertas_edited_by_foreign` FOREIGN KEY (`edited_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `profile_peserta`
--
ALTER TABLE `profile_peserta`
  ADD CONSTRAINT `profile_peserta_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surat_balasan_magangs`
--
ALTER TABLE `surat_balasan_magangs`
  ADD CONSTRAINT `fk_pendaftaran` FOREIGN KEY (`pendaftaran_peserta_id`) REFERENCES `pendaftaran_pesertas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_id_pendaftaran_foreign` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran_pesertas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
