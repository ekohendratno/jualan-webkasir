-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2021 at 10:37 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jualan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_kode` text NOT NULL,
  `barang_nama` text NOT NULL,
  `barang_berat` int(11) NOT NULL,
  `barang_stok` int(30) NOT NULL,
  `barang_harga` int(30) NOT NULL,
  `barang_kategori` text NOT NULL,
  `barang_merek` text NOT NULL,
  `barang_keterangan` text NOT NULL,
  `barang_tanggal_masuk` date NOT NULL DEFAULT current_timestamp(),
  `barang_dihapus` enum('ya','tidak') NOT NULL DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_kode`, `barang_nama`, `barang_berat`, `barang_stok`, `barang_harga`, `barang_kategori`, `barang_merek`, `barang_keterangan`, `barang_tanggal_masuk`, `barang_dihapus`) VALUES(1, 'AB11', 'Anggur Merah', 1, 10, 10000, 'Makanan', 'Umum', '', '2021-08-10', 'tidak');
INSERT INTO `barang` (`barang_id`, `barang_kode`, `barang_nama`, `barang_berat`, `barang_stok`, `barang_harga`, `barang_kategori`, `barang_merek`, `barang_keterangan`, `barang_tanggal_masuk`, `barang_dihapus`) VALUES(3, 'AB12', 'Anggur Putih', 30, 10, 50000, 'Makanan', 'Umum', '', '2021-08-10', 'tidak');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota` (
  `nota_id` int(11) NOT NULL,
  `nota_nomor` varchar(30) NOT NULL,
  `nota_keterangan` text NOT NULL,
  `nota_tanggal` datetime NOT NULL,
  `nota_pelanggan` text NOT NULL,
  `nota_kasir` text NOT NULL,
  `nota_bayar_total` int(30) NOT NULL,
  `nota_bayar` int(30) NOT NULL,
  `nota_bayar_kembalian` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`nota_id`, `nota_nomor`, `nota_keterangan`, `nota_tanggal`, `nota_pelanggan`, `nota_kasir`, `nota_bayar_total`, `nota_bayar`, `nota_bayar_kembalian`) VALUES(1, '601F9CFA020D4', '', '2021-02-07 11:09:55', 'umum', 'kasir', 10000, 100000, 90000);
INSERT INTO `nota` (`nota_id`, `nota_nomor`, `nota_keterangan`, `nota_tanggal`, `nota_pelanggan`, `nota_kasir`, `nota_bayar_total`, `nota_bayar`, `nota_bayar_kembalian`) VALUES(2, '610AABF8BC898', '', '2021-08-04 22:02:16', 'umum', 'admin', 60000, 100000, 40000);
INSERT INTO `nota` (`nota_id`, `nota_nomor`, `nota_keterangan`, `nota_tanggal`, `nota_pelanggan`, `nota_kasir`, `nota_bayar_total`, `nota_bayar`, `nota_bayar_kembalian`) VALUES(3, '61118C5999E4E', '', '2021-08-10 03:13:13', 'umum', 'admin', 110000, 200000, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` text NOT NULL,
  `pelanggan_namalengkap` text NOT NULL,
  `pelanggan_notelp` text NOT NULL,
  `pelanggan_alamat` text NOT NULL,
  `pelanggan_lainnya` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_namalengkap`, `pelanggan_notelp`, `pelanggan_alamat`, `pelanggan_lainnya`) VALUES(1, 'umum', 'Umum', '08888', 'aa', 'sasda');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan` (
  `pengaturan_id` int(11) NOT NULL,
  `pengaturan_key` text NOT NULL,
  `pengaturan_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`pengaturan_id`, `pengaturan_key`, `pengaturan_value`) VALUES(1, 'Merek', '[\"Adidas\",\"Sport E\"]');
INSERT INTO `pengaturan` (`pengaturan_id`, `pengaturan_key`, `pengaturan_value`) VALUES(2, 'Kategori', '[\"Sepatu\",\"Tas\"]');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_nota` text NOT NULL,
  `penjualan_jumlah` int(11) NOT NULL,
  `penjualan_harga` int(30) NOT NULL,
  `penjualan_barang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `penjualan_nota`, `penjualan_jumlah`, `penjualan_harga`, `penjualan_barang`) VALUES(1, '601F9CFA020D4', 1, 10000, 'AB11');
INSERT INTO `penjualan` (`penjualan_id`, `penjualan_nota`, `penjualan_jumlah`, `penjualan_harga`, `penjualan_barang`) VALUES(2, '610AABF8BC898', 5, 10000, 'AB11');
INSERT INTO `penjualan` (`penjualan_id`, `penjualan_nota`, `penjualan_jumlah`, `penjualan_harga`, `penjualan_barang`) VALUES(3, '610AABF8BC898', 1, 10000, 'AB11');
INSERT INTO `penjualan` (`penjualan_id`, `penjualan_nota`, `penjualan_jumlah`, `penjualan_harga`, `penjualan_barang`) VALUES(4, '61118C5999E4E', 1, 10000, 'AB11');
INSERT INTO `penjualan` (`penjualan_id`, `penjualan_nota`, `penjualan_jumlah`, `penjualan_harga`, `penjualan_barang`) VALUES(5, '61118C5999E4E', 2, 50000, 'AB12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `user_foto` text NOT NULL,
  `user_level` enum('admin','kasir','inventory','keuangan') DEFAULT 'kasir',
  `user_last_active` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_foto`, `user_level`, `user_last_active`) VALUES(1, 'admin', '12345678', '', 'admin', '2020-05-02 12:33:28');
INSERT INTO `users` (`user_id`, `username`, `password`, `user_foto`, `user_level`, `user_last_active`) VALUES(4, 'kasir', '12345678', '', 'kasir', '2021-08-09 20:28:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`nota_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`pengaturan_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `pengaturan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
