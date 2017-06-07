-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 06:49 PM
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
(0, 1, 'rawat_inap', 1, 'sudah_dilayani', '2017-05-14 16:07:31'),
(1, 1, 'rawat_jalan', 1, 'belum_dilayani', '2017-05-12 12:26:34'),
(2, 1, 'rawat_jalan', 1, 'sudah_dilayani', '2017-05-14 16:27:45'),
(6, 1, 'rawat_jalan', 1, 'sudah_dilayani', '2017-05-14 17:47:33'),
(7, 1, 'rawat_jalan', 1, 'sudah_dilayani', '2017-05-14 17:48:02'),
(8, 1, 'rawat_jalan', 1, 'sudah_dilayani', '2017-05-14 17:48:10'),
(9, 1, 'rawat_jalan', 1, 'sudah_dilayani', '2017-05-15 13:30:06'),
(10, 1, 'rawat_jalan', 1, 'belum_dilayani', '2017-05-15 18:30:52'),
(11, 1, 'rawat_jalan', 1, 'belum_dilayani', '2017-06-07 21:40:04'),
(14, 5, 'rawat_jalan', 2, 'belum_dilayani', '2017-06-07 23:45:18');

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
(1, '3x1'),
(2, '3x2'),
(5, '3x2'),
(6, '3x2'),
(7, '2x1');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `grup_barang_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `tanggal_pencatatan` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `nama_barang`, `grup_barang_id`, `satuan_id`, `tanggal_pencatatan`) VALUES
(2, 'Parasetamol', 1, 1, '2017-05-15 22:02:32'),
(3, 'AB Vask 10 mg tab', 1, 1, '2017-05-16 14:56:27'),
(5, 'Abbocath 16', 1, 1, '2017-05-16 15:21:26'),
(6, 'ssss', 1, 1, '2017-05-25 22:17:18');

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
(35, 'Agung Prasetyo Hidayatullah', '1', '0001-01-01', '1', 'Laki-laki', 'O', '1', '1', 1, '2017-06-07 22:40:16');

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
  `no_batch` int(11) NOT NULL,
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
(1, 'PT. Kalbe Farma', 1, '21312223', '2017-05-20', '', 3, 2, 21312323, '2017-08-04', 12000, 9000, 11, '2017-05-20 14:28:42'),
(5, 'PT. Kalbe Farma', 1, '9922883', '2017-02-20', '', 3, 2, 29222992, '2017-02-20', 2000, 1000, 23, '2017-05-20 14:38:06'),
(6, 'sd', 1, '11111', '2017-05-25', '', 3, 3, 11111, '2017-05-25', 2000, 3000, 25, '2017-05-25 20:48:58'),
(7, 'sd', 1, '1', '2017-05-25', '', 3, 3, 11, '2017-05-25', 2000, 3000, 6, '2017-05-25 20:49:58'),
(9, 'sd', 1, '1', '2017-05-25', '', 3, 6, 11, '2017-05-25', 2, 2, 5, '2017-05-25 22:14:32'),
(10, 'sd', 1, '1', '2017-05-25', '', 3, 5, 11, '2017-05-25', 2, 2, 2, '2017-05-25 22:15:21'),
(11, 'sd', 1, '', '2017-05-25', '', 3, 6, 22, '2017-05-25', 2, 9, 14, '2017-05-25 22:16:20'),
(13, 'asd', 1, '1', '2017-05-25', '', 3, 5, 2, '2017-05-25', 2, 2, 10, '2017-05-25 22:21:05');

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
  `tanggal_keluar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran_barang`
--

INSERT INTO `pengeluaran_barang` (`pengeluaran_barang_id`, `untuk_unit_id`, `dari_unit_id`, `barang_id`, `no_batch`, `jumlah_pengeluaran`, `tanggal_keluar`) VALUES
(2, 2, 3, 6, '8993172960499', 13, '2017-05-24 21:52:23'),
(3, 2, 3, 6, '8993172960499', 29, '2017-05-24 21:52:43'),
(5, 2, 3, 6, '222232323', 2, '2017-05-24 22:09:31'),
(7, 2, 3, 2, '12121212', 1, '2017-05-25 22:13:50'),
(8, 2, 3, 6, '1', 1, '2017-05-25 22:17:43'),
(9, 2, 3, 2, '2', 5, '2017-05-25 22:20:05'),
(10, 2, 3, 3, '2', 1, '2017-05-25 22:22:39');

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
(1, 'Agung', '135150200111139', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Daffa', '135150522000014', 'daffa', '21232f297a57a5a743894a0e4a801fc3', 'deporajal'),
(3, 'Daisy', '135150522000014', 'daisy', 'df4b892324bbb648f27734b55c206b4b', 'loket');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_stok`
--

CREATE TABLE `permintaan_stok` (
  `permintaan_stok_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `dari_unit_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan_tambahan` text NOT NULL,
  `tanggal_permintaan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_stok`
--

INSERT INTO `permintaan_stok` (`permintaan_stok_id`, `barang_id`, `dari_unit_id`, `jumlah`, `status`, `keterangan_tambahan`, `tanggal_permintaan`) VALUES
(1, 2, 2, 100, 'sudah_dilayani', '', '2017-05-23 13:11:32'),
(2, 2, 2, 100, 'belum_dilayani', '-', '2017-05-24 14:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `resep_id` int(11) NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `nomor_transaksi` varchar(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `aturan_pakai` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_resep` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`resep_id`, `transaksi_id`, `nomor_transaksi`, `barang_id`, `aturan_pakai`, `jumlah`, `tanggal_resep`) VALUES
(1, 1, '2405171', 2, '3x1', 10, '2017-05-24 14:51:17'),
(2, 1, '2405171', 2, '3x2', 10, '2017-05-24 14:52:06'),
(3, 1, '2405171', 2, '3x1', 10, '2017-05-24 17:06:53');

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
(1, 2, 3, 3, '2017-05-16 16:32:45'),
(2, 3, 3, 11, '2017-05-16 17:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_obat`
--

CREATE TABLE `transaksi_obat` (
  `transaksi_obat_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nomor_transaksi` varchar(255) DEFAULT NULL,
  `total_tagihan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_obat`
--

INSERT INTO `transaksi_obat` (`transaksi_obat_id`, `pasien_id`, `status`, `tanggal_transaksi`, `nomor_transaksi`, `total_tagihan`) VALUES
(1, 1, 'belum_lunas', '2017-05-24 14:46:13', '2405171', 10000),
(2, 1, 'belum_lunas', '2017-05-24 19:48:38', '2405172', 120000),
(3, 1, 'belum_lunas', '2017-05-24 19:49:51', '2405173', 120000);

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
(6, 'Laboratoriumm');

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
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

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
  MODIFY `antrian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `aturan_pakai`
--
ALTER TABLE `aturan_pakai`
  MODIFY `aturan_pakai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `pasien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  MODIFY `pengadaan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pengeluaran_barang`
--
ALTER TABLE `pengeluaran_barang`
  MODIFY `pengeluaran_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permintaan_stok`
--
ALTER TABLE `permintaan_stok`
  MODIFY `permintaan_stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `resep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi_obat`
--
ALTER TABLE `transaksi_obat`
  MODIFY `transaksi_obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`),
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi_obat` (`transaksi_obat_id`);

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
