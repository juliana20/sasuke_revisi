-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2019 at 02:30 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kode_surat`
--

CREATE TABLE `tb_kode_surat` (
  `id` int(11) NOT NULL,
  `kode_id` char(10) NOT NULL,
  `kode_surat` char(50) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kode_surat`
--

INSERT INTO `tb_kode_surat` (`id`, `kode_id`, `kode_surat`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'KD001', 'S.1', 'Penerimaan Siswa', '2019-08-03 13:57:55', '2019-08-03 13:57:55'),
(2, 'KD002', 'S.2', 'Mutasi Siswa', '2019-08-05 13:18:51', '2019-08-05 13:18:51'),
(3, 'KD003', 'S.3', 'Absensi dan Teguran', '2019-08-05 13:19:22', '2019-08-05 13:19:22'),
(4, 'KD004', 'S.4', 'Kegiatan Extra', '2019-08-05 13:20:09', '2019-08-05 13:20:09'),
(5, 'KD005', 'S.5', 'Bimbingan dan Penyuluhan', '2019-08-05 13:20:31', '2019-08-05 13:20:31'),
(6, 'KD006', 'S.6', 'Surat Keterangan', '2019-08-05 13:20:50', '2019-08-05 13:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_keluar`
--

CREATE TABLE `tb_surat_keluar` (
  `id` int(11) NOT NULL,
  `surat_keluar_id` char(10) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal_dikirim` date DEFAULT NULL,
  `kode_surat_keluar` char(50) DEFAULT NULL,
  `no_surat_keluar` char(50) DEFAULT NULL,
  `tujuan_surat` char(100) DEFAULT NULL,
  `perihal_surat_keluar` varchar(255) DEFAULT NULL,
  `tanggal_surat_keluar` date DEFAULT NULL,
  `keterangan_surat_keluar` text,
  `status_surat` char(50) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `bukti_pengiriman_surat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat_keluar`
--

INSERT INTO `tb_surat_keluar` (`id`, `surat_keluar_id`, `user_id`, `tanggal_dikirim`, `kode_surat_keluar`, `no_surat_keluar`, `tujuan_surat`, `perihal_surat_keluar`, `tanggal_surat_keluar`, `keterangan_surat_keluar`, `status_surat`, `file`, `bukti_pengiriman_surat`, `created_at`, `updated_at`) VALUES
(1, 'SK001', 6, '2019-08-07', '1', '023/SMK Farmasi/S1/VII/2017', 'SMK Farmasi 3 Denpasar', 'Menggunakan Lapangan Basket', '2019-08-07', '-', 'Belum Dikirim', 'Ijazah Terakhir Wearnes.jpg', '20180916_101109.jpg', '2019-11-22 13:24:35', '2019-11-22 13:24:35'),
(2, 'SK002', 6, '2019-10-14', '2', '023/SMK Militer/S1/VII/2017', 'SMK Farmasi 3 Gianyar', 'Mutasi Siswa SMK', '2019-10-05', 'Sip deh', 'Dikirim', '20180906_155037.jpg', '20180904_081941.jpg', '2019-11-22 13:24:23', '2019-11-22 13:24:23'),
(4, 'SK003', 8, NULL, NULL, '023/SMK 1 Klungkung /S1/VII/2017', NULL, NULL, NULL, NULL, NULL, '20180904_070343.jpg', NULL, '2019-11-21 03:40:11', '2019-11-21 03:40:11'),
(6, 'SK004', 8, NULL, NULL, '023/SMK Kesehatan Sanjiwani/S1/VII/2017', NULL, NULL, NULL, NULL, NULL, '20190316_104830.jpg', NULL, '2019-11-21 03:53:03', '2019-11-21 03:53:02'),
(7, 'SK005', 13, NULL, NULL, '045/SMA 1 Amlapura/S1/VII/2019', NULL, NULL, NULL, NULL, NULL, '20180916_101050.jpg', NULL, '2019-11-21 04:00:08', '2019-11-21 04:00:08'),
(8, 'SK006', 6, '2019-11-22', '3', '023/SMK Farmasi/S1/VII/2017', 'SMK Farmasi 3 Denpasar', 'Menggunakan Lapangan Basket', '2019-11-22', 'sip deh', 'Dikirim', '20180904_070343.jpg', '20180904_081857.jpg', '2019-11-22 13:27:48', '2019-11-22 13:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat_masuk`
--

CREATE TABLE `tb_surat_masuk` (
  `id` int(11) NOT NULL,
  `surat_masuk_id` char(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `kode_surat_masuk` int(11) NOT NULL,
  `no_surat_masuk` varchar(250) NOT NULL,
  `asal_surat_masuk` char(100) NOT NULL,
  `perihal_surat_masuk` varchar(255) NOT NULL,
  `tanggal_surat_masuk` date NOT NULL,
  `disposisi` varchar(255) NOT NULL,
  `keterangan_surat_masuk` text NOT NULL,
  `validasi` char(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tindak_lanjut` varchar(250) NOT NULL,
  `sudah_dibaca` int(11) NOT NULL,
  `status_dikirim` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat_masuk`
--

INSERT INTO `tb_surat_masuk` (`id`, `surat_masuk_id`, `user_id`, `tanggal_terima`, `kode_surat_masuk`, `no_surat_masuk`, `asal_surat_masuk`, `perihal_surat_masuk`, `tanggal_surat_masuk`, `disposisi`, `keterangan_surat_masuk`, `validasi`, `file`, `tindak_lanjut`, `sudah_dibaca`, `status_dikirim`, `created_at`, `updated_at`) VALUES
(1, 'SM001', 1, '2019-08-07', 4, '023/SMK Kesehatan /S1/VII/2017', 'SMK 3 Kesehatan', 'Menggunakan Lapangan Voli', '2019-08-07', '0', 'Coba coba', '0', 'Transkrip Nilai Ijazah SMK.jpg', '0', 0, 0, '2019-09-27 12:50:19', '2019-09-27 12:50:19'),
(2, 'SM002', 1, '2019-08-05', 3, '023/SMK Farmasi/S1/VII/2017', 'SMK 3 Farmasi Denpasar', 'Menggunakan Lapangan Basket', '2019-08-05', '0', '-', '0', 'creepy-yondaime-vs--kyuubi-naruto-shippuuden-634129_1024_768.jpg', '0', 0, 0, '2019-09-27 12:48:48', '2019-09-27 12:45:03'),
(3, 'SM003', 1, '2019-08-05', 6, '023/SMA Negeri 1 Gianyar /S6/VII/2019', 'SMA Negeri 1 Gianyar', 'Undangan Porseni SMA', '2019-08-05', '0', '-', '0', 'Ijazah Terakhir Wearnes.jpg', '0', 0, 0, '2019-09-14 02:15:16', '2019-08-12 04:49:14'),
(4, 'SM004', 1, '2019-08-05', 4, '023/SMK Negeri 1 Gianyar/S4/VII/2019', 'SMK Negeri 1 Gianyar', 'Undangan Uji Coba Pemain Voli', '2019-08-05', '0', '-', '0', 'ijazah SMK.jpg', '0', 0, 0, '2019-09-14 02:15:18', '2019-08-12 04:42:27'),
(5, 'SM005', 1, '2019-08-12', 4, '023/SMK PGRI 1 Gianyar/S1/VII/2017', 'SMK PGRI 1 Gianyar', 'Undangan tanding uji coba bola voli', '2019-08-12', '1', '-', '0', '496.jpg', '13', 1, 0, '2019-11-21 04:15:52', '2019-11-21 04:15:52'),
(6, 'SM006', 1, '2019-09-12', 2, '023/SMK Kesehatan/S1/VII/2017', 'SMK 3 Kesehatan Denpasar', 'Menggunakan Lapangan Voli', '2019-09-12', '1', 'coba', '0', 'farmasi.png', '8', 1, 1, '2019-09-14 04:08:11', '2019-09-14 04:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `user_id` char(10) NOT NULL,
  `nama_pegawai` char(50) NOT NULL,
  `jabatan` char(50) NOT NULL,
  `username` char(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` char(50) NOT NULL,
  `user_tipe` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `user_id`, `nama_pegawai`, `jabatan`, `username`, `password`, `status`, `user_tipe`, `foto`, `created_at`, `updated_at`) VALUES
(6, 'AD001', 'Hendrastuti', 'Admin', 'admin', '$2y$10$Hdj7q7hj73SW/5AQ6wvV2Ol4reSHmZfBmiyg.Orw7fRvEde5c.qhe', 'Aktif', 'Admin', '834.jpg', '2019-09-27 12:41:34', '2019-09-27 12:41:34'),
(8, 'WK001', 'Nyoman Suriati', 'Waka Kurikulum', 'wakil', '$2y$10$SqDLMVni6EtsmiveK/eX5O532KmTUuil5Ahe5bhGIR8WPuOUHE1Oa', 'Aktif', 'Wakil Kepala', '221.jpg', '2019-09-14 01:03:52', '2019-08-08 08:32:48'),
(9, 'KS001', 'Wayan Sugra S.Pd, M.M', 'Kepala Sekolah', 'kepala', '$2y$10$X/HPR9hPHagepJ.f5epaS.aN9lMf6pEUO7iJvQmmVkCDayNtaK4XW', 'Aktif', 'Kepala Sekolah', '937.jpg', '2019-08-08 08:32:26', '2019-08-08 08:32:26'),
(11, 'WK003', 'I Wayan Waka', 'Waka Sarana Prasarana', 'sarana', '$2y$10$uNQ5wbKvFZMV5Q0ZXMa6Xu5giekIABAMC3AZIsSRukEn66iZyRkPi', 'Aktif', 'Wakil Kepala', 'Batur.jpg', '2019-09-14 01:38:51', '2019-09-14 01:38:51'),
(10, 'WK002', 'Wayan Mati', 'Waka Kesiswaan', 'wakamati', '$2y$10$1xigxKDxJzProdCdF1suhO6CKFnHGu.ii9XKWyGHg1da8sn9tOxQ.', 'Aktif', 'Wakil Kepala', '841.jpg', '2019-09-27 12:41:48', '2019-09-27 12:41:48'),
(12, 'WK004', 'Ni Made Dewi', 'Waka Humas', 'dewi', '$2y$10$41EpJ2NZK8IqwNOJmh/E8OG6uf6yLyZ1reZh81uwxmscD9d2wAEgG', 'Aktif', 'Wakil Kepala', 'default_user.jpg', '2019-09-15 09:51:01', '2019-09-15 09:51:01'),
(13, 'WK005', 'I Wayan Saka', 'Kaprog AK', 'saka', '$2y$10$OvSS4Ss73nW6soepPzhbmuhKmmCRRt1txKM75uHPFWvUAb/aPyyPO', 'Aktif', 'Wakil Kepala', 'default_user.jpg', '2019-09-15 09:51:18', '2019-09-15 09:51:18'),
(14, 'WK006', 'I Putu Yudi', 'Kaprog AP', 'yudi', '$2y$10$jUpWNya.f.57f.YEA6wCL.TGuDN4Zf5NLgvvRWmP41ncou3CTuZZm', 'Aktif', 'Wakil Kepala', 'default_user.jpg', '2019-09-15 09:51:42', '2019-09-15 09:51:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kode_surat`
--
ALTER TABLE `tb_kode_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kode_surat`
--
ALTER TABLE `tb_kode_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
