-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2017 at 11:38 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `antrian_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `jenis_kunjungan` varchar(255) NOT NULL,
  `unit_id_tujuan` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tanggal_antrian` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`antrian_id`, `pasien_id`, `jenis_kunjungan`, `unit_id_tujuan`, `status`, `tanggal_antrian`) VALUES
(1, 7, 'rawat_jalan', 1, 'belum_dilayani', '2017-06-08 12:26:34'),
(8, 1, 'rawat_jalan', 1, 'sudah_dilayani', '2017-06-08 17:48:10'),
(10, 13, 'rawat_jalan', 1, 'belum_dilayani', '2017-06-08 18:30:52'),
(11, 8, 'rawat_jalan', 2, 'belum_dilayani', '2017-06-08 21:40:04'),
(14, 5, 'rawat_jalan', 3, 'belum_dilayani', '2017-06-08 10:45:18'),
(16, 1, 'rawat_jalan', 5, 'belum_dilayani', '2017-06-08 14:14:38'),
(24, 30, 'lainnya', 4, 'belum_dilayani', '2017-06-08 19:46:16'),
(25, 18, 'lainnya', 5, 'belum_dilayani', '2017-06-08 19:46:35'),
(26, 22, 'rawat_jalan', 1, 'belum_dilayani', '2017-06-08 20:07:41'),
(27, 19, 'rawat_jalan', 1, 'belum_dilayani', '2017-06-06 20:44:03'),
(28, 36, 'rawat_jalan', 2, 'sudah_dilayani', '2017-06-08 21:23:42'),
(29, 35, 'rawat_jalan', 3, 'belum_dilayani', '2017-06-08 21:24:06'),
(30, 20, 'rawat_jalan', 1, 'belum_dilayani', '2017-06-08 21:24:20'),
(31, 34, 'rawat_jalan', 2, 'belum_dilayani', '2017-06-10 21:41:36'),
(32, 36, 'rawat_jalan', 1, 'sudah_dilayani', '2017-06-10 13:09:14'),
(33, 35, 'rawat_jalan', 1, 'belum_dilayani', '2017-06-10 17:07:23'),
(34, 36, 'rawat_jalan', 2, 'sudah_dilayani', '2017-06-11 01:32:59'),
(35, 36, 'rawat_jalan', 2, 'sudah_dilayani', '2017-06-13 23:13:51'),
(36, 36, 'rawat_jalan', 2, 'sudah_dilayani', '2017-06-14 00:06:24'),
(37, 36, 'rawat_jalan', 2, 'sudah_dilayani', '2017-06-15 00:38:47'),
(38, 36, 'rawat_jalan', 2, 'sudah_dilayani', '2017-06-15 00:56:38'),
(39, 36, 'rawat_jalan', 2, 'sudah_dilayani', '2017-06-15 04:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `aturan_pakai`
--

CREATE TABLE `aturan_pakai` (
  `aturan_pakai_id` int(11) NOT NULL,
  `nama_aturan_pakai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aturan_pakai`
--

INSERT INTO `aturan_pakai` (`aturan_pakai_id`, `nama_aturan_pakai`) VALUES
(1, '3 x 1'),
(2, '3 x 2'),
(5, '3 x 2'),
(6, '3 x 2'),
(7, '2 x 1'),
(8, '1 x 1');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `grup_barang_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `merek_model_ukuran` varchar(255) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `tanggal_pencatatan` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `nama_barang`, `grup_barang_id`, `satuan_id`, `merek_model_ukuran`, `harga_jual`, `tanggal_pencatatan`) VALUES
(2, 'Parasetamol', 1, 1, NULL, 2000, '2017-05-15 22:02:32'),
(3, 'AB Vask 10 mg tab', 1, 1, NULL, 1000, '2017-05-16 14:56:27'),
(5, 'Abbocath 16', 1, 1, NULL, 5000, '2017-05-16 15:21:26'),
(6, 'Alkohol', 1, 1, NULL, 6000, '2017-05-25 22:17:18'),
(7, 'Keyboard', 1, 1, 'Razer S', 12000, '2017-06-09 23:52:01'),
(8, 'Monitor', 2, 1, 'LG 24 inch', 100000, '2017-06-13 13:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `grup_barang`
--

CREATE TABLE `grup_barang` (
  `grup_barang_id` int(11) NOT NULL,
  `nama_grup_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grup_barang`
--

INSERT INTO `grup_barang` (`grup_barang_id`, `nama_grup_barang`) VALUES
(1, 'Farmasi'),
(2, 'Inventaris'),
(3, 'Depo');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pasien`
--

CREATE TABLE `jenis_pasien` (
  `jenis_pasien_id` int(11) NOT NULL,
  `nama_jenis_pasien` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pasien`
--

INSERT INTO `jenis_pasien` (`jenis_pasien_id`, `nama_jenis_pasien`) VALUES
(1, 'Umum'),
(2, 'BPJS'),
(3, 'Khusus');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_penerimaan`
--

CREATE TABLE `jenis_penerimaan` (
  `jenis_penerimaan_id` int(11) NOT NULL,
  `nama_jenis_penerimaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_penerimaan`
--

INSERT INTO `jenis_penerimaan` (`jenis_penerimaan_id`, `nama_jenis_penerimaan`) VALUES
(1, 'APBN'),
(2, 'BLUD');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `pasien_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `golongan_darah` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `nomor_RM` varchar(255) NOT NULL,
  `jenis_pasien_id` int(11) NOT NULL,
  `tanggal_daftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`pasien_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `golongan_darah`, `agama`, `nomor_RM`, `jenis_pasien_id`, `tanggal_daftar`) VALUES
(1, 'Agung', 'Surakarta', '1995-04-24', 'Malang', 'L', 'O', 'Islam', '131312223300', 1, '2017-05-12 15:23:20'),
(4, 'Belaa', 'Lombokk', '1995-04-23', 'Malangg', 'Lainnya', 'AB', 'HinduA', '13322244555A', 1, '2017-05-20 13:49:52'),
(5, 'Faat', 'Kaltim', '1995-10-12', 'Malang', 'L', 'B', 'Islam', '12312232993', 1, '2017-05-28 09:38:31'),
(7, 'Arin', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:39:41'),
(8, 'Endah', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:08'),
(9, 'Yuwilda', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:10'),
(10, 'Tiara', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:10'),
(11, 'Taftin', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:11'),
(12, 'Dikka', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:11'),
(13, 'Putri', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:12'),
(14, 'Prasetyo', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:12'),
(15, 'Hidayatullah', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:13'),
(16, 'Pramesthi', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:13'),
(17, 'Debora', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:13'),
(18, 'Wilantikasari', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:14'),
(19, 'Muhammad', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:14'),
(20, 'Utik', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:14'),
(21, 'Syafirra', 'Manado', '1995-09-22', 'Malang', 'P', 'AB', 'Kristen', '12992923993', 1, '2017-05-28 09:41:15'),
(22, 'Belaa', 'Lombokk', '1995-04-23', 'Malangg', 'P', 'A', 'Hindu', '13322244555A', 2, '2017-05-28 20:13:32'),
(23, 'Agung', 'Kalimantan Tengah', '1995-09-22', 'Malang', 'L', 'O', 'Islam', '1111555545', 1, '2017-05-28 20:14:13'),
(30, 'Bela', 'Lombok', '1995-04-23', 'Malang', 'P', 'A', 'Hindu', '13322244555', 2, '2017-06-04 21:04:52'),
(34, 'Agung', 'Solo', '2001-06-06', 'Solo', 'L', 'O', 'Islam', '1202002', 3, '2017-06-06 13:04:03'),
(35, 'Agung Prasetyo Hidayatullah', '1', '0001-01-01', '1', 'Laki-laki', 'O', '1', '1', 2, '2017-06-07 22:40:16'),
(36, 'Lina', '1', '2010-05-01', '1', 'Laki-laki', 'O', '1', '1', 1, '2017-06-08 18:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_barang`
--

CREATE TABLE `pengadaan_barang` (
  `pengadaan_barang_id` int(11) NOT NULL,
  `terima_dari` varchar(255) NOT NULL,
  `jenis_penerimaan_id` int(11) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_faktur` date NOT NULL,
  `keterangan` text NOT NULL,
  `untuk_unit_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `no_batch` varchar(255) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `tanggal_masuk` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan_barang`
--

INSERT INTO `pengadaan_barang` (`pengadaan_barang_id`, `terima_dari`, `jenis_penerimaan_id`, `no_faktur`, `tanggal_faktur`, `keterangan`, `untuk_unit_id`, `barang_id`, `no_batch`, `tanggal_kadaluarsa`, `harga_jual`, `harga_beli`, `jumlah_barang`, `tanggal_masuk`) VALUES
(1, 'PT. Kalbe Farma', 1, '21312223', '2017-05-20', '', 3, 2, '21312323', '2017-08-04', 12000, 9000, 11, '2017-05-20 14:28:42'),
(5, 'PT. Kalbe Farma', 1, '9922883', '2017-02-20', '', 3, 2, '29222992', '2017-02-20', 2000, 1000, 23, '2017-05-20 14:38:06'),
(6, 'sd', 1, '11111', '2017-05-25', '', 3, 3, '11111', '2017-05-25', 2000, 3000, 25, '2017-05-25 20:48:58'),
(7, 'sd', 1, '1', '2017-05-25', '', 3, 3, '11', '2017-05-25', 2000, 3000, 6, '2017-06-10 20:49:58'),
(9, 'sd', 1, '1', '2017-05-25', '', 3, 6, '11', '2017-05-25', 2, 2, 5, '2017-06-10 22:14:32'),
(10, 'sd', 1, '1', '2017-05-25', '', 3, 5, '11', '2017-05-25', 2, 2, 2, '2017-06-10 22:15:21'),
(11, 'sd', 1, '', '2017-05-25', '', 3, 6, '22', '2017-05-25', 2, 9, 14, '2017-06-10 22:16:20'),
(13, 'asd', 1, '1', '2017-05-25', '', 3, 5, '2', '2017-05-25', 2, 2, 10, '2017-06-10 22:21:05'),
(14, 'Kalbe Farma', 1, '1', '2017-05-25', '', 3, 2, '112222', '2017-05-25', 100, 200, 10, '2017-06-10 00:29:51'),
(15, 'PT ABCD', 1, 'asd3d31d', '2017-06-06', '-', 3, 7, 'asd31r32sd', '2017-06-28', 2000, 1000, 10, '2017-06-12 14:07:17'),
(16, '232', 1, '2', '2222-02-22', '', 3, 3, '232132sasd', '2333-02-23', 800, 1000, 2, '2017-06-12 14:11:30'),
(17, '2', 1, '2', '0002-02-02', '', 3, 2, '2', '0002-02-02', 2, 2, 2, '2017-06-12 14:12:43'),
(18, '2', 1, '2', '0002-02-02', '2', 3, 2, '2', '0002-02-02', 2, 2, 2, '2017-06-12 14:15:02'),
(19, '3123', 1, '2322', '0004-02-03', '12321', 3, 2, '232', '0003-02-02', 21312321, 213123, 1, '2017-06-12 14:16:50'),
(20, '3123', 1, '2322', '0004-02-03', '12321', 3, 5, '32', '0003-02-03', 3322, 1223, 50, '2017-06-12 14:16:50'),
(21, '2', 1, '2', '0002-02-02', '2', 3, 2, '2', '2222-02-22', 2, 2, 2, '2017-06-12 16:25:45'),
(23, '', 1, '', '0000-00-00', '', 3, 2, '2', '0000-00-00', 2, 1, 1, '2017-06-13 15:14:52'),
(25, '1', 1, '1', '0001-01-01', '1', 3, 5, '1', '0001-01-01', 1, 1, 1, '2017-06-13 15:16:49'),
(30, '1', 1, '1', '2017-01-18', 'A', 3, 7, '1', '2017-06-06', 1, 1, 1, '2017-06-13 15:34:04'),
(35, '', 1, '', '0000-00-00', '', 3, 7, '', '0000-00-00', 0, 0, 1, '2017-06-13 15:44:12'),
(36, '', 1, '', '0000-00-00', '', 3, 7, '', '0000-00-00', 0, 0, 1, '2017-06-13 15:45:24'),
(37, '', 1, '', '0000-00-00', '', 3, 6, '', '0000-00-00', 0, 0, 1, '2017-06-13 15:45:54'),
(38, '', 1, '', '0000-00-00', '', 3, 8, '', '0000-00-00', 0, 0, 1, '2017-06-13 15:47:12'),
(39, '', 1, '', '0000-00-00', '', 3, 7, '', '0000-00-00', 0, 0, 1, '2017-06-13 15:47:41'),
(40, '', 1, '', '0000-00-00', '', 3, 7, '', '0000-00-00', 0, 0, 1, '2017-06-13 16:05:38'),
(41, '', 1, '', '0000-00-00', '', 3, 3, '', '0000-00-00', 0, 0, 1, '2017-06-13 16:07:12'),
(42, '', 2, '', '0000-00-00', '', 3, 8, '', '0000-00-00', 0, 0, 1, '2017-06-13 16:08:02'),
(43, '', 1, '', '0000-00-00', '', 3, 7, '', '0000-00-00', 0, 0, 1, '2017-06-13 16:08:27'),
(44, '', 1, '', '0000-00-00', '', 3, 3, '', '0000-00-00', 0, 0, 1, '2017-06-13 16:30:23'),
(45, '1', 1, '1', '2017-05-13', '-', 4, 7, '1', '2017-06-30', 1, 1, 1, '2017-06-13 16:42:37'),
(46, '', 1, '', '0000-00-00', '', 4, 5, '', '2017-06-14', 0, 0, 1, '2017-06-14 13:20:33'),
(47, 'a', 1, 'a', '2017-06-14', '1', 3, 6, '1', '2017-06-14', 1, 1, 1, '2017-06-14 17:10:14'),
(48, '', 1, '', '0000-00-00', '', 4, 8, '1', '2017-06-14', 1000, 2000, 1, '2017-06-14 17:11:42'),
(49, '', 1, '', '0000-00-00', '', 3, 3, '', '0000-00-00', 0, 0, 1, '2017-06-14 22:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_barang`
--

CREATE TABLE `pengeluaran_barang` (
  `pengeluaran_barang_id` int(11) NOT NULL,
  `untuk_unit_id` int(11) NOT NULL,
  `dari_unit_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `no_batch` varchar(255) NOT NULL,
  `jumlah_pengeluaran` int(11) NOT NULL,
  `nama_penerima` varchar(255) DEFAULT NULL,
  `tanggal_keluar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran_barang`
--

INSERT INTO `pengeluaran_barang` (`pengeluaran_barang_id`, `untuk_unit_id`, `dari_unit_id`, `barang_id`, `no_batch`, `jumlah_pengeluaran`, `nama_penerima`, `tanggal_keluar`) VALUES
(95, 2, 3, 2, '', 1, NULL, '2017-06-10 16:27:16'),
(96, 2, 3, 2, '', 2, NULL, '2017-06-10 16:27:23'),
(97, 2, 3, 2, '', 1, NULL, '2014-01-10 16:27:52'),
(98, 2, 3, 3, '', 1, NULL, '2017-06-10 16:27:52'),
(99, 2, 3, 5, '', 1, NULL, '2017-06-10 16:27:52'),
(100, 2, 3, 2, '', 1, NULL, '2014-03-10 16:28:06'),
(101, 2, 3, 3, '', 1, NULL, '2014-02-10 16:28:06'),
(102, 2, 3, 5, '', 1, NULL, '2014-04-10 16:28:07'),
(103, 2, 3, 2, '', 1, NULL, '2014-05-10 16:28:13'),
(104, 2, 3, 3, '', 1, NULL, '2014-06-10 16:28:14'),
(105, 2, 3, 5, '', 1, NULL, '2014-06-10 16:28:14'),
(106, 2, 3, 2, '', 1, NULL, '2014-09-10 16:28:39'),
(107, 2, 3, 3, '', 1, NULL, '2014-08-10 16:28:39'),
(108, 2, 3, 5, '', 1, NULL, '2017-10-18 16:28:39'),
(109, 2, 3, 2, '', 1, NULL, '2014-10-10 16:32:53'),
(110, 2, 3, 3, '', 1, NULL, '2014-11-10 16:32:53'),
(111, 2, 3, 5, '', 1, NULL, '2014-12-10 16:32:53'),
(112, 2, 3, 2, '', 1, NULL, '2017-06-10 16:32:58'),
(113, 2, 3, 3, '', 1, NULL, '2017-06-10 16:32:58'),
(114, 2, 3, 5, '', 1, NULL, '2014-01-10 16:32:58'),
(115, 2, 3, 2, '', 1, NULL, '2017-08-23 16:33:03'),
(116, 2, 3, 3, '', 1, NULL, '2017-06-10 16:33:04'),
(117, 2, 3, 5, '', 1, NULL, '2017-06-10 16:33:04'),
(118, 2, 3, 2, '', 1, NULL, '2017-06-10 17:06:00'),
(119, 2, 3, 2, '', 15, NULL, '2017-06-10 17:06:06'),
(120, 4, 3, 3, '', 3, NULL, '2017-06-10 17:08:35'),
(121, 2, 3, 2, '', 1, NULL, '2016-09-01 01:32:31'),
(122, 2, 3, 5, '1', 1, NULL, '2017-05-01 12:58:53'),
(123, 1, 3, 5, '', 23, NULL, '2017-05-01 12:59:31'),
(124, 1, 3, 5, '', 23, NULL, '2017-03-01 13:00:18'),
(125, 1, 3, 5, '1', 1, NULL, '2014-04-05 13:00:18'),
(126, 1, 3, 5, '1', 1, NULL, '2017-04-01 13:00:18'),
(127, 1, 3, 5, '1', 1, NULL, '2016-06-01 13:00:38'),
(128, 1, 3, 5, '1', 1, NULL, '2017-06-11 13:00:38'),
(129, 1, 3, 5, '1', 1, NULL, '2017-06-11 13:00:47'),
(130, 1, 3, 5, '1', 1, NULL, '2017-06-11 13:00:47'),
(131, 1, 3, 5, '', 0, NULL, '2017-06-11 13:00:57'),
(132, 1, 3, 5, '1', 1, NULL, '2017-05-11 13:00:58'),
(133, 1, 3, 5, '1', 1, NULL, '2017-06-11 13:00:58'),
(134, 8, 3, 2, '1', 1, NULL, '2017-06-11 13:20:59'),
(135, 8, 3, 3, '12', 1, NULL, '2016-05-11 13:22:30'),
(136, 8, 3, 2, '1', 1, NULL, '2017-06-11 13:22:31'),
(137, 1, 3, 3, '', 1, NULL, '2016-11-01 13:23:41'),
(138, 1, 3, 3, '', 1, NULL, '2017-06-11 13:23:41'),
(139, 1, 3, 2, '1', 1, NULL, '2017-06-11 13:23:41'),
(140, 1, 3, 5, '1', 1, NULL, '2017-06-11 13:25:33'),
(141, 2, 3, 3, '2', 2, NULL, '2017-06-11 13:42:03'),
(142, 1, 3, 2, '23', 2, NULL, '2017-06-11 19:16:09'),
(143, 2, 3, 2, '', 1, NULL, '2017-06-11 19:53:46'),
(144, 2, 3, 2, '', 1, NULL, '2017-06-11 21:39:34'),
(145, 2, 3, 2, '2', 1, 'Agung', '2017-06-13 12:44:23'),
(146, 2, 3, 2, '232', 1, 'Agung', '2017-06-13 12:50:19'),
(147, 2, 3, 2, '', 1, 'otomatis dari sistem', '2017-06-13 12:50:34'),
(148, 4, 3, 3, '', 1, 'otomatis dari sistem', '2017-06-13 12:50:49'),
(149, 1, 3, 7, '', 1, '', '2017-06-13 15:38:30'),
(150, 1, 3, 7, '', 1, '', '2017-06-13 16:09:34'),
(151, 1, 3, 6, '', 1, '', '2017-06-13 16:10:45'),
(152, 1, 3, 5, '', 1, '', '2017-06-13 16:30:12'),
(153, 2, 4, 3, '1', 1, '1', '2017-06-13 16:38:11'),
(154, 2, 3, 2, '', 1, 'otomatis dari sistem', '2017-06-14 13:17:55'),
(155, 1, 4, 3, '1', 1, '', '2017-06-14 13:21:00'),
(156, 2, 4, 5, 'a', 1, '1', '2017-06-14 17:04:21'),
(157, 5, 4, 3, '1', 1, '1', '2017-06-14 17:05:33'),
(158, 2, 3, 3, 'a', 1, '1', '2017-06-14 17:07:02'),
(159, 1, 3, 2, 'a', 1, '1', '2017-06-14 17:08:39'),
(160, 9, 2, 2, '', 1, 'Lina', '2017-06-14 20:15:06'),
(161, 9, 2, 2, '', 1, 'Lina', '2017-06-14 20:15:51'),
(162, 9, 2, 3, '', 1, 'Lina', '2017-06-14 20:22:08'),
(163, 9, 2, 2, '', 1, 'Lina', '2017-06-14 20:22:26'),
(164, 9, 2, 5, '', 4, 'Lina', '2017-06-14 21:38:18'),
(165, 9, 2, 5, '', 1, 'Lina', '2017-06-14 21:38:18'),
(166, 9, 2, 5, '', 1, 'Lina', '2017-06-14 22:08:31'),
(167, 9, 2, 5, '', 1, 'Lina', '2017-06-14 22:37:40'),
(168, 9, 2, 5, '', 1, 'Lina', '2017-06-14 22:37:50'),
(173, 1, 3, 6, '', 1, '1', '2017-06-14 22:52:44'),
(174, 9, 2, 3, '', 2, 'Lina', '2017-06-14 23:02:36'),
(175, 9, 2, 2, 'a', 2, 'Lina', '2017-06-14 23:02:36'),
(176, 9, 2, 3, '', 1, 'Lina', '2017-06-15 00:05:18'),
(177, 9, 2, 3, '', 1, 'Lina', '2017-06-15 00:05:39'),
(178, 9, 2, 3, '', 1, 'Lina', '2017-06-15 00:06:52'),
(179, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:08:57'),
(180, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:11:18'),
(181, 9, 2, 2, '', 2, 'Lina', '2017-06-15 00:11:41'),
(182, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:11:42'),
(183, 9, 2, 3, '', 1, 'Lina', '2017-06-15 00:12:10'),
(184, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:12:31'),
(185, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:13:27'),
(186, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:15:19'),
(187, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:15:32'),
(188, 9, 2, 2, '', 1, 'Lina', '2017-06-15 00:28:17'),
(189, 9, 2, 3, '', 1, 'Lina', '2017-06-15 00:29:55'),
(190, 9, 2, 3, '', 1, 'Lina', '2017-06-15 00:32:09'),
(191, 9, 2, 3, '', 2, 'Lina', '2017-06-15 00:37:25'),
(192, 9, 2, 2, '', 1, 'Lina', '2017-06-15 00:37:25'),
(193, 9, 2, 2, '', 1, 'Lina', '2017-06-15 00:43:26'),
(194, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:43:26'),
(195, 9, 2, 3, '', 1, 'Lina', '2017-06-15 00:43:26'),
(196, 9, 2, 5, '', 1, 'Lina', '2017-06-15 00:46:26'),
(197, 9, 2, 3, '', 1, 'Lina', '2017-06-15 00:46:26'),
(198, 9, 2, 2, '', 1, 'Lina', '2017-06-15 00:56:28'),
(199, 9, 2, 2, '', 1, 'Lina', '2017-06-15 00:56:50'),
(200, 9, 2, 2, '', 1, 'Lina', '2017-06-15 04:21:43'),
(201, 2, 3, 6, '', 1, 'unit_request', '2017-06-15 04:26:43'),
(202, 4, 3, 5, '1', 1, '1', '2017-06-15 04:28:27'),
(203, 2, 3, 2, '', 1, 'unit_request', '2017-06-15 04:28:43'),
(204, 2, 3, 2, '', 1, NULL, '2017-06-15 04:30:12'),
(205, 2, 3, 6, '', 1, NULL, '2017-06-15 04:30:41'),
(206, 2, 3, 8, '', 1, NULL, '2017-06-15 04:30:41'),
(207, 2, 3, 2, '', 1, NULL, '2017-06-15 04:31:36'),
(208, 2, 3, 2, '', 1, NULL, '2017-06-15 04:32:30'),
(209, 2, 3, 3, '', 1, NULL, '2017-06-15 04:32:31'),
(210, 2, 3, 5, '', 1, NULL, '2017-06-15 04:32:31'),
(211, 2, 3, 6, '', 1, NULL, '2017-06-15 04:32:31'),
(212, 2, 3, 7, '', 1, NULL, '2017-06-15 04:32:31'),
(213, 2, 3, 2, '', 1, NULL, '2017-06-15 04:32:43'),
(214, 2, 3, 3, '', 1, NULL, '2017-06-15 04:32:44'),
(215, 2, 3, 5, '', 1, NULL, '2017-06-15 04:32:44'),
(216, 2, 3, 6, '', 1, NULL, '2017-06-15 04:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `pengguna_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`pengguna_id`, `nama`, `nip`, `username`, `password`, `role`) VALUES
(1, 'Hidayatullah Agung Prasetyo', '135150200111139', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Daffa', '135150522000014', 'daffa', '21232f297a57a5a743894a0e4a801fc3', 'deporajal'),
(3, 'Daisy', '135150522000014', 'daisy', 'df4b892324bbb648f27734b55c206b4b', 'loket');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_stok`
--

CREATE TABLE `permintaan_stok` (
  `permintaan_stok_id` int(11) NOT NULL,
  `nomor_permintaan` varchar(255) DEFAULT NULL,
  `barang_id` int(11) NOT NULL,
  `dari_unit_id` int(11) NOT NULL,
  `jumlah_permintaan` int(11) NOT NULL,
  `jumlah_disetujui` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `tanggal_permintaan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_stok`
--

INSERT INTO `permintaan_stok` (`permintaan_stok_id`, `nomor_permintaan`, `barang_id`, `dari_unit_id`, `jumlah_permintaan`, `jumlah_disetujui`, `status`, `tanggal_permintaan`) VALUES
(1, 'DEPPAR17C040', 2, 2, 100, 1, 'sudah_dilayani', '2017-05-23 13:11:32'),
(2, 'DEPPAR17CE58', 2, 2, 100, 1, 'belum_dilayani', '2017-05-24 14:38:55'),
(6, 'DEPPAR17CE58', 6, 2, 10, 1, 'belum_dilayani', '2017-06-09 14:15:15'),
(7, 'DEPPAR17CE58', 6, 2, 10, 0, 'belum_dilayani', '2017-06-09 14:15:23'),
(8, 'DEPPAR17CE58', 6, 2, 10, 0, 'belum_dilayani', '2017-06-09 14:15:24'),
(9, 'DEPPAR17CE58', 6, 2, 10, 0, 'belum_dilayani', '2017-06-09 14:15:25'),
(10, 'DEPPAR17CE58', 6, 2, 10, 0, 'belum_dilayani', '2017-06-09 14:15:25'),
(11, 'DEPPAR17CE58', 6, 2, 10, 0, 'belum_dilayani', '2017-06-09 14:15:26'),
(12, 'DEPPAR17CE58', 6, 2, 10, 0, 'belum_dilayani', '2017-06-09 14:15:26'),
(13, 'DEPPAR17CE58', 6, 2, 10, 0, 'belum_dilayani', '2017-06-09 14:15:27'),
(14, 'DEPPAR17CE58', 5, 2, 10, 1, 'belum_dilayani', '2017-06-09 14:15:27'),
(15, 'DEPPAR17CE58', 3, 2, 10, 1, 'belum_dilayani', '2017-06-09 14:15:28'),
(16, 'DEPPAR17CE41', 5, 2, 10, 1, 'belum_dilayani', '2017-06-09 14:15:39'),
(17, 'DEPPAR17CE41', 6, 2, 10, 1, 'belum_dilayani', '2017-06-09 14:15:39'),
(18, 'DEPPAR17CE41', 3, 2, 10, 1, 'belum_dilayani', '2017-06-09 14:15:40'),
(19, 'DEPPAR17CE41', 2, 2, 10, 1, 'belum_dilayani', '2017-06-09 14:15:40'),
(20, 'DEPPAR17CE41', 7, 2, 10, 1, 'belum_dilayani', '2017-06-09 14:15:41'),
(21, 'DESDAR17CE58', 6, 4, 10, 0, 'sudah_dilayani', '2017-06-10 14:16:54'),
(22, 'DESDAR17CE52', 3, 4, 10, 1, 'belum_dilayani', '2017-06-10 14:16:55'),
(23, '1', 2, 1, 1, 1, '1', '2017-06-15 04:11:04'),
(24, '12121', 2, 2, 10, 0, 'belum_dilayani', '2017-06-15 04:15:02'),
(25, 'RQ140617C7635B', 3, 2, 1, 0, 'belum_dilayani', '2017-06-15 04:24:26'),
(26, 'RQ140617C21002', 5, 2, 1, 0, 'belum_dilayani', '2017-06-15 04:25:13'),
(27, 'RQ140617678A14', 8, 2, 1, 1, 'belum_dilayani', '2017-06-15 04:25:57'),
(28, 'RQ140617678A14', 6, 2, 1, 1, 'belum_dilayani', '2017-06-15 04:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `resep_id` int(11) NOT NULL,
  `nomor_transaksi` varchar(255) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `aturan_pakai` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_resep` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`resep_id`, `nomor_transaksi`, `barang_id`, `aturan_pakai`, `jumlah`, `tanggal_resep`) VALUES
(1, '2405171', 2, '3x1', 10, '2017-05-24 14:51:17'),
(2, '2405171', 2, '3x2', 10, '2017-05-24 14:52:06'),
(3, '2405171', 2, '3x1', 10, '2017-05-24 17:06:53'),
(4, '23232', 2, '3 x 1', 1, '2017-06-14 20:31:44'),
(5, '', 5, '', 4, '2017-06-14 21:38:18'),
(6, '', 5, '', 1, '2017-06-14 21:38:18'),
(7, '1', 5, '', 1, '2017-06-14 22:08:31'),
(8, '1', 5, '', 1, '2017-06-14 22:37:40'),
(9, '1', 5, '', 1, '2017-06-14 22:37:51'),
(14, '1', 3, '', 2, '2017-06-14 23:02:36'),
(15, '1', 2, '3 x 1', 2, '2017-06-14 23:02:36'),
(16, 'RJ140617A7E', 3, '3 x 1', 1, '2017-06-15 00:05:18'),
(17, 'RJ140617A7E', 3, '', 1, '2017-06-15 00:05:39'),
(18, 'RJ140617A7E', 3, '', 1, '2017-06-15 00:06:52'),
(19, 'RJ140617A7E', 5, '', 1, '2017-06-15 00:08:57'),
(20, 'RJ140617A7E', 5, '', 1, '2017-06-15 00:11:18'),
(21, 'RJ140617A7E', 2, '', 2, '2017-06-15 00:11:41'),
(22, 'RJ140617A7E', 5, '', 1, '2017-06-15 00:11:42'),
(23, 'RJ140617A7E', 3, '', 1, '2017-06-15 00:12:10'),
(24, 'RJ140617A7E', 5, '', 1, '2017-06-15 00:12:31'),
(25, 'RJ140617A7E', 5, '', 1, '2017-06-15 00:13:27'),
(26, 'RJ140617D9E', 5, '', 1, '2017-06-15 00:15:19'),
(27, 'RJ1406175E6', 5, '', 1, '2017-06-15 00:15:32'),
(28, 'RJ140617296', 2, '', 1, '2017-06-15 00:28:17'),
(29, 'RJ140617D6B', 3, '', 1, '2017-06-15 00:29:55'),
(30, 'RJ140617F28', 3, '', 1, '2017-06-15 00:32:09'),
(31, 'RJ140617014', 3, '', 2, '2017-06-15 00:37:25'),
(32, 'RJ140617014', 2, '', 1, '2017-06-15 00:37:25'),
(33, 'RJ14061767D', 2, '', 1, '2017-06-15 00:43:26'),
(34, 'RJ14061767D', 5, '', 1, '2017-06-15 00:43:26'),
(35, 'RJ14061767D', 3, '', 1, '2017-06-15 00:43:26'),
(36, 'RJ14061772DA7F', 5, '', 1, '2017-06-15 00:46:26'),
(37, 'RJ14061772DA7F', 3, '', 1, '2017-06-15 00:46:26'),
(38, 'RJ14061796EA64', 2, '', 1, '2017-06-15 00:56:28'),
(39, 'RJ14061796EA64', 2, '', 1, '2017-06-15 00:56:51'),
(40, 'RJ140617A8240C', 2, '', 1, '2017-06-15 04:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `satuan_id` int(11) NOT NULL,
  `nama_satuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`satuan_id`, `nama_satuan`) VALUES
(1, 'TAB'),
(2, 'KAP'),
(3, 'CAIR');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `stok_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pencatatan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`stok_id`, `barang_id`, `unit_id`, `jumlah`, `tanggal_pencatatan`) VALUES
(1, 2, 3, 56, '2017-05-16 16:32:45'),
(2, 3, 3, 171, '2017-05-16 17:27:32'),
(3, 5, 3, 1311, '2017-06-10 14:33:11'),
(15, 2, 2, 28, '2017-06-10 16:18:45'),
(16, 3, 2, 230, '2017-06-10 16:18:45'),
(17, 5, 2, 50, '2017-06-10 16:18:45'),
(18, 3, 4, 1, '2017-06-10 17:08:35'),
(19, 3, 8, 2, '2017-06-11 13:20:59'),
(20, 2, 8, 2, '2017-06-11 13:20:59'),
(21, 3, 1, 5, '2017-06-11 13:23:41'),
(22, 2, 1, 4, '2017-06-11 13:23:41'),
(23, 5, 1, 3, '2017-06-11 13:25:33'),
(24, 5, 5, 1, '2017-06-13 12:48:45'),
(28, 7, 3, 8, '2017-06-13 15:24:19'),
(29, 7, 1, 2, '2017-06-13 15:38:30'),
(30, 6, 3, 229, '2017-06-13 15:45:54'),
(31, 8, 3, 1, '2017-06-13 15:47:12'),
(32, 6, 1, 2, '2017-06-13 16:10:45'),
(33, 7, 4, 1, '2017-06-13 16:42:37'),
(34, 5, 4, 2, '2017-06-14 13:20:33'),
(35, 3, 5, 1, '2017-06-14 17:05:33'),
(36, 8, 4, 1, '2017-06-14 17:11:42'),
(37, 6, 2, 4, '2017-06-15 04:26:43'),
(38, 8, 2, 1, '2017-06-15 04:30:41'),
(39, 7, 2, 1, '2017-06-15 04:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_obat`
--

CREATE TABLE `transaksi_obat` (
  `transaksi_obat_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nomor_transaksi` varchar(255) DEFAULT NULL,
  `total_tagihan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_obat`
--

INSERT INTO `transaksi_obat` (`transaksi_obat_id`, `pasien_id`, `tanggal_transaksi`, `nomor_transaksi`, `total_tagihan`) VALUES
(1, 1, '2017-05-24 14:46:13', '2405171', 10000),
(2, 1, '2017-05-24 19:48:38', '2405172', 120000),
(3, 1, '2017-05-24 19:49:51', '2405173', 120000),
(4, 1, '2017-06-14 20:33:38', '23232', 10000),
(5, 1, '2017-06-14 21:38:18', '', 10000),
(6, 1, '2017-06-14 22:03:46', '1', 0),
(7, 1, '2017-06-14 22:05:45', '1', 0),
(8, 1, '2017-06-14 22:07:10', '1', 0),
(9, 1, '2017-06-14 22:08:31', '1', 0),
(10, 1, '2017-06-14 22:10:15', '1', 0),
(11, 1, '2017-06-14 22:10:55', '1', 0),
(12, 1, '2017-06-14 22:10:58', '1', 0),
(13, 1, '2017-06-14 22:11:17', '1', 0),
(14, 1, '2017-06-14 22:12:26', '1', 0),
(15, 1, '2017-06-14 22:12:42', '1', 0),
(16, 1, '2017-06-14 22:16:37', '1', 0),
(17, 1, '2017-06-14 22:17:49', '1', 0),
(18, 1, '2017-06-14 22:18:40', '1', 0),
(19, 1, '2017-06-14 22:18:57', '1', 0),
(20, 1, '2017-06-14 22:20:41', '1', 0),
(21, 1, '2017-06-14 22:32:34', '1', 0),
(22, 1, '2017-06-14 22:33:14', '1', 0),
(23, 1, '2017-06-14 22:37:06', '1', 0),
(24, 1, '2017-06-14 22:37:40', '1', 0),
(25, 1, '2017-06-14 22:37:51', '1', 0),
(26, 1, '2017-06-14 22:41:25', '1', 0),
(27, 1, '2017-06-14 22:42:32', '1', 0),
(28, 1, '2017-06-14 22:42:58', '1', 0),
(29, 1, '2017-06-14 23:02:36', '1', 0),
(30, 1, '2017-06-15 00:05:19', 'RJ140617A7EC01', 0),
(31, 1, '2017-06-15 00:05:39', 'RJ140617A7EC01', 0),
(32, 1, '2017-06-15 00:06:52', 'RJ140617A7EC01', 0),
(33, 1, '2017-06-15 00:08:57', 'RJ140617A7EC01', 0),
(34, 36, '2017-06-15 00:11:18', 'RJ140617A7EC01', 5000),
(35, 36, '2017-06-15 00:11:42', 'RJ140617A7EC01', 9000),
(36, 36, '2017-06-15 00:12:11', 'RJ140617A7EC01', 0),
(37, 36, '2017-06-15 00:12:31', 'RJ140617A7EC01', 0),
(38, 36, '2017-06-15 00:13:27', 'RJ140617A7EC01', 5000),
(39, 36, '2017-06-15 00:15:19', 'RJ140617D9E69D', 5000),
(40, 36, '2017-06-15 00:15:32', 'RJ1406175E6965', 5000),
(41, 36, '2017-06-15 00:28:17', 'RJ140617296C86', 0),
(42, 36, '2017-06-15 00:29:55', 'RJ140617D6BB33', 1000),
(43, 36, '2017-06-15 00:32:09', 'RJ140617F28EE0', 1000),
(44, 36, '2017-06-15 00:37:25', 'RJ140617014732', 4000),
(45, 36, '2017-06-15 00:43:26', 'RJ14061767D96D', 8000),
(46, 36, '2017-06-15 00:46:26', 'RJ14061772DA7F', 6000),
(47, 36, '2017-06-15 00:56:28', 'RJ14061796EA64', 2000),
(48, 36, '2017-06-15 00:56:51', 'RJ14061796EA64', 2000),
(49, 36, '2017-06-15 04:21:43', 'RJ140617A8240C', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `nama_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `nama_unit`) VALUES
(1, 'Poli Umum'),
(2, 'Depo Rajal'),
(3, 'Gudang Farmasi'),
(4, 'Gudang Inventaris'),
(5, 'Poli Gigi'),
(6, 'Laboratoriumm'),
(7, 'Poli Mata'),
(8, 'THT'),
(9, 'Pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`antrian_id`),
  ADD KEY `pasien_id` (`pasien_id`),
  ADD KEY `unit_id_tujuan` (`unit_id_tujuan`);

--
-- Indexes for table `aturan_pakai`
--
ALTER TABLE `aturan_pakai`
  ADD PRIMARY KEY (`aturan_pakai_id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `grup_barang_id` (`grup_barang_id`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indexes for table `grup_barang`
--
ALTER TABLE `grup_barang`
  ADD PRIMARY KEY (`grup_barang_id`);

--
-- Indexes for table `jenis_pasien`
--
ALTER TABLE `jenis_pasien`
  ADD PRIMARY KEY (`jenis_pasien_id`);

--
-- Indexes for table `jenis_penerimaan`
--
ALTER TABLE `jenis_penerimaan`
  ADD PRIMARY KEY (`jenis_penerimaan_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`pasien_id`),
  ADD KEY `jenis_pasien_id` (`jenis_pasien_id`);

--
-- Indexes for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  ADD PRIMARY KEY (`pengadaan_barang_id`),
  ADD KEY `jenis_penerimaan_id` (`jenis_penerimaan_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `untuk_unit_id` (`untuk_unit_id`);

--
-- Indexes for table `pengeluaran_barang`
--
ALTER TABLE `pengeluaran_barang`
  ADD PRIMARY KEY (`pengeluaran_barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`pengguna_id`);

--
-- Indexes for table `permintaan_stok`
--
ALTER TABLE `permintaan_stok`
  ADD PRIMARY KEY (`permintaan_stok_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `dari_unit` (`dari_unit_id`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`resep_id`),
  ADD KEY `nomor_transaksi` (`nomor_transaksi`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`stok_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `transaksi_obat`
--
ALTER TABLE `transaksi_obat`
  ADD PRIMARY KEY (`transaksi_obat_id`),
  ADD KEY `nomor_transaksi` (`nomor_transaksi`),
  ADD KEY `pasien_id` (`pasien_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `antrian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `aturan_pakai`
--
ALTER TABLE `aturan_pakai`
  MODIFY `aturan_pakai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `grup_barang`
--
ALTER TABLE `grup_barang`
  MODIFY `grup_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jenis_pasien`
--
ALTER TABLE `jenis_pasien`
  MODIFY `jenis_pasien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jenis_penerimaan`
--
ALTER TABLE `jenis_penerimaan`
  MODIFY `jenis_penerimaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `pasien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  MODIFY `pengadaan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `pengeluaran_barang`
--
ALTER TABLE `pengeluaran_barang`
  MODIFY `pengeluaran_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permintaan_stok`
--
ALTER TABLE `permintaan_stok`
  MODIFY `permintaan_stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `resep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `transaksi_obat`
--
ALTER TABLE `transaksi_obat`
  MODIFY `transaksi_obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`pasien_id`),
  ADD CONSTRAINT `antrian_ibfk_2` FOREIGN KEY (`unit_id_tujuan`) REFERENCES `unit` (`unit_id`);

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`grup_barang_id`) REFERENCES `grup_barang` (`grup_barang_id`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`satuan_id`);

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`jenis_pasien_id`) REFERENCES `jenis_pasien` (`jenis_pasien_id`) ON UPDATE CASCADE;

--
-- Constraints for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  ADD CONSTRAINT `pengadaan_barang_ibfk_1` FOREIGN KEY (`jenis_penerimaan_id`) REFERENCES `jenis_penerimaan` (`jenis_penerimaan_id`),
  ADD CONSTRAINT `pengadaan_barang_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`),
  ADD CONSTRAINT `pengadaan_barang_ibfk_4` FOREIGN KEY (`untuk_unit_id`) REFERENCES `unit` (`unit_id`);

--
-- Constraints for table `pengeluaran_barang`
--
ALTER TABLE `pengeluaran_barang`
  ADD CONSTRAINT `pengeluaran_barang_ibfk_4` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `permintaan_stok`
--
ALTER TABLE `permintaan_stok`
  ADD CONSTRAINT `permintaan_stok_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`),
  ADD CONSTRAINT `permintaan_stok_ibfk_2` FOREIGN KEY (`dari_unit_id`) REFERENCES `unit` (`unit_id`);

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`);

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_obat`
--
ALTER TABLE `transaksi_obat`
  ADD CONSTRAINT `transaksi_obat_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`pasien_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
