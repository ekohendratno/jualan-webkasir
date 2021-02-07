-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Feb 2021 pada 15.42
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

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
  `barang_dihapus` enum('ya','tidak') NOT NULL DEFAULT 'tidak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_kode`, `barang_nama`, `barang_berat`, `barang_stok`, `barang_harga`, `barang_kategori`, `barang_merek`, `barang_keterangan`, `barang_dihapus`) VALUES
(1, 'AB11', 'Anggur Merah', 1, 10, 10000, 'Makanan', 'Umum', '', 'tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

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
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`nota_id`, `nota_nomor`, `nota_keterangan`, `nota_tanggal`, `nota_pelanggan`, `nota_kasir`, `nota_bayar_total`, `nota_bayar`, `nota_bayar_kembalian`) VALUES
(1, '601F9CFA020D4', '', '2021-02-07 11:09:55', 'umum', 'kasir', 10000, 100000, 90000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` text NOT NULL,
  `pelanggan_namalengkap` text NOT NULL,
  `pelanggan_notelp` text NOT NULL,
  `pelanggan_alamat` text NOT NULL,
  `pelanggan_lainnya` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_namalengkap`, `pelanggan_notelp`, `pelanggan_alamat`, `pelanggan_lainnya`) VALUES
(1, 'umum', 'Umum', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `pengaturan_id` int(11) NOT NULL,
  `pengaturan_key` text NOT NULL,
  `pengaturan_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`pengaturan_id`, `pengaturan_key`, `pengaturan_value`) VALUES
(1, 'Merek', '[\"Adidas\",\"Sport E\"]'),
(2, 'Kategori', '[\"Sepatu\",\"Tas\"]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_nota` text NOT NULL,
  `penjualan_jumlah` int(11) NOT NULL,
  `penjualan_harga` int(30) NOT NULL,
  `penjualan_barang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `penjualan_nota`, `penjualan_jumlah`, `penjualan_harga`, `penjualan_barang`) VALUES
(1, '601F9CFA020D4', 1, 10000, 'AB11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `user_foto` text NOT NULL,
  `user_level` enum('admin','kasir','inventory','keuangan') DEFAULT 'kasir',
  `user_last_active` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_foto`, `user_level`, `user_last_active`) VALUES
(1, 'admin', '12345678', '', 'admin', '2020-05-02 12:33:28'),
(4, 'kasir', '12345678', '', 'kasir', '2021-02-06 14:59:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`nota_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`pengaturan_id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `pengaturan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
