-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Bulan Mei 2020 pada 11.25
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_input`
--

CREATE TABLE `tb_input` (
  `no` int(11) NOT NULL,
  `id_user_input` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `id_tipe` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `memori` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_input`
--

INSERT INTO `tb_input` (`no`, `id_user_input`, `serial_number`, `id_tipe`, `warna`, `memori`, `harga_beli`, `harga_jual`) VALUES
(1, 'lab0001', '1588523349422000', 'VIV0002', 'knight black', '4/64', 2500000, 2900000),
(2, 'lab0001', '1588523355315000', 'VIV0002', 'fancy sky', '4/64', 2500000, 2900000),
(3, 'lab0001', '1588523361370000', 'VIV0002', 'fancy sky', '8/128', 3249000, 3600000),
(4, 'lab0001', '1588523369183000', 'VIV0002', 'knight black', '8/128', 3249000, 3600000),
(5, 'lab0002', '1588525406694000', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(6, 'lab0002', '1588525406694001', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(7, 'lab0002', '1588525406694002', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(8, 'lab0002', '1588525406694003', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(9, 'lab0002', '1588525406694004', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(10, 'lab0002', '1588525406694005', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(11, 'lab0003', '1588744347394001', 'OPP0002', 'mirror black', '3/64', 2200000, 2500000),
(12, 'lab0003', '1588744347394002', 'OPP0002', 'mirror black', '3/64', 2200000, 2500000),
(13, 'lab0003', '1588744355700000', 'OPP0002', 'dazzling white', '3/64', 2200000, 2500000),
(14, 'lab0003', '1588744355700001', 'OPP0002', 'dazzling white', '3/64', 2200000, 2500000),
(15, 'lab0003', '1588744382687000', 'OPP0003', 'space purple', '8/128', 3699000, 3800000),
(16, 'lab0003', '1588744382688001', 'OPP0003', 'space purple', '8/128', 3699000, 3800000),
(17, 'lab0003', '1588744388797000', 'OPP0003', 'marine green', '8/128', 3699000, 3800000),
(18, 'lab0003', '1588744388797001', 'OPP0003', 'marine green', '8/128', 3699000, 3800000),
(19, 'lab0004', '1588744503851000', 'XIA0001', 'emas', '2/16', 1160000, 1300000),
(20, 'lab0004', '1588744503851001', 'XIA0001', 'emas', '2/16', 1160000, 1300000),
(21, 'lab0004', '1588744503851002', 'XIA0001', 'emas', '2/16', 1160000, 1300000),
(23, 'lab0005', '1588926131887000', 'XIA0003', 'kuning', '3/32', 2000000, 2300000),
(24, 'lab0005', '1588926131887001', 'XIA0003', 'kuning', '3/32', 2000000, 2300000),
(25, 'lab0005', '1588926137933000', 'XIA0003', 'hijau', '3/32', 2000000, 2300000),
(26, 'lab0006', '1588958982602000', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(27, 'lab0006', '1588958982602001', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(28, 'lab0006', '1588958982602002', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(29, 'lab0007', '1589300825182000', 'VIV0002', 'knight black', '4/64', 2500000, 2900000),
(30, 'lab0007', '1589300825182001', 'VIV0002', 'knight black', '4/64', 2500000, 2900000),
(31, 'lab0008', '1589304194284000', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(32, 'lab0008', '1589304194284001', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(33, 'lab0008', '1589304194284002', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
(34, 'kak0001', '1589355575310000', 'OPP0002', 'mirror black', '3/64', 2200000, 2500000),
(35, 'kak0001', '1589355575310002', 'OPP0002', 'mirror black', '3/64', 2200000, 2500000),
(36, 'kak0001', '1589355575311003', 'OPP0002', 'mirror black', '3/64', 2200000, 2500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_memori_harga`
--

CREATE TABLE `tb_memori_harga` (
  `no` int(11) NOT NULL,
  `id_tipe` varchar(255) NOT NULL,
  `memori` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_memori_harga`
--

INSERT INTO `tb_memori_harga` (`no`, `id_tipe`, `memori`, `harga_beli`, `harga_jual`) VALUES
(1, 'VIV0001', '4/64', 2500000, 2900000),
(2, 'VIV0001', '6/128', 2999000, 3300000),
(3, 'VIV0002', '4/64', 2500000, 2900000),
(4, 'VIV0002', '8/128', 3249000, 3600000),
(5, 'VIV0003', '8/128', 4425000, 5000000),
(6, 'OPP0001', '2/32', 1990000, 2200000),
(7, 'OPP0001', '4/64', 2500000, 2900000),
(9, 'OPP0003', '8/128', 3699000, 3800000),
(10, 'XIA0001', '2/16', 1160000, 1300000),
(12, 'XIA0002', '2/32', 2000000, 2100000),
(13, 'XIA0002', '4/64', 3000000, 3100000),
(14, 'XIA0002', '8/64', 4000000, 4100000),
(15, 'XIA0002', '8/128', 5000000, 5100000),
(50, 'ASU0001', '8/128', 8199000, 8300000),
(56, 'XIA0003', '3/32', 2000000, 2300000),
(57, 'XIA0003', '4/64', 2500000, 2600000),
(59, 'OPP0002', '3/64', 2200000, 2500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_merek`
--

CREATE TABLE `tb_merek` (
  `id_merek` int(11) NOT NULL,
  `merek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_merek`
--

INSERT INTO `tb_merek` (`id_merek`, `merek`) VALUES
(14, 'ASUS'),
(2, 'OPPO'),
(1, 'VIVO'),
(3, 'XIAOMI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_output`
--

CREATE TABLE `tb_output` (
  `no` int(11) NOT NULL,
  `id_user_output` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `id_tipe` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `memori` varchar(255) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_output`
--

INSERT INTO `tb_output` (`no`, `id_user_output`, `serial_number`, `id_tipe`, `warna`, `memori`, `harga_jual`) VALUES
(3, 'lab0001', '1588744503851000', 'XIA0001', 'emas', '2/16', 1300000),
(4, 'lab0001', '1588744503851001', 'XIA0001', 'emas', '2/16', 1300000),
(5, 'lab0002', '1588525406694000', 'ASU0001', 'hitam', '8/128', 8300000),
(6, 'lab0002', '1588525406694001', 'ASU0001', 'hitam', '8/128', 8300000),
(7, 'lab0002', '1588744347394001', 'OPP0002', 'mirror black', '3/64', 2500000),
(8, 'lab0002', '1588744347394002', 'OPP0002', 'mirror black', '3/64', 2500000),
(9, 'lab0003', '1588744382687000', 'OPP0003', 'space purple', '8/128', 3800000),
(10, 'lab0003', '1588525406694002', 'ASU0001', 'hitam', '8/128', 8300000),
(11, 'lab0004', '1588525406694003', 'ASU0001', 'hitam', '8/128', 8300000),
(12, 'lab0005', '1588926131887000', 'XIA0003', 'kuning', '3/32', 2300000),
(13, 'lab0005', '1588523349422000', 'VIV0002', 'knight black', '4/64', 2900000),
(14, 'lab0006', '1588523355315000', 'VIV0002', 'fancy sky', '4/64', 2900000),
(15, 'lab0006', '1588523361370000', 'VIV0002', 'fancy sky', '8/128', 3600000),
(16, 'lab0007', '1588744382688001', 'OPP0003', 'space purple', '8/128', 3800000),
(17, 'lab0008', '1588525406694004', 'ASU0001', 'hitam', '8/128', 8300000),
(18, 'lab0008', '1588525406694005', 'ASU0001', 'hitam', '8/128', 8300000),
(19, 'lab0008', '1588958982602000', 'ASU0001', 'hitam', '8/128', 8300000),
(20, 'lab0008', '1588744355700000', 'OPP0002', 'dazzling white', '3/64', 2500000),
(21, 'kak0001', '1588958982602001', 'ASU0001', 'hitam', '8/128', 8300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stok_barang`
--

CREATE TABLE `tb_stok_barang` (
  `serial_number` varchar(255) NOT NULL,
  `id_tipe` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `memori` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_stok_barang`
--

INSERT INTO `tb_stok_barang` (`serial_number`, `id_tipe`, `warna`, `memori`, `harga_beli`, `harga_jual`) VALUES
('1588523369183000', 'VIV0002', 'knight black', '8/128', 3249000, 3600000),
('1588744355700001', 'OPP0002', 'dazzling white', '3/64', 2200000, 2500000),
('1588744388797000', 'OPP0003', 'marine green', '8/128', 3699000, 3800000),
('1588744388797001', 'OPP0003', 'marine green', '8/128', 3699000, 3800000),
('1588744503851002', 'XIA0001', 'emas', '2/16', 1160000, 1300000),
('1588926131887001', 'XIA0003', 'kuning', '3/32', 2000000, 2300000),
('1588926137933000', 'XIA0003', 'hijau', '3/32', 2000000, 2300000),
('1588958982602002', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
('1589300825182000', 'VIV0002', 'knight black', '4/64', 2500000, 2900000),
('1589300825182001', 'VIV0002', 'knight black', '4/64', 2500000, 2900000),
('1589304194284000', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
('1589304194284001', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
('1589304194284002', 'ASU0001', 'hitam', '8/128', 8199000, 8300000),
('1589355575310000', 'OPP0002', 'mirror black', '3/64', 2200000, 2500000),
('1589355575310002', 'OPP0002', 'mirror black', '3/64', 2200000, 2500000),
('1589355575311003', 'OPP0002', 'mirror black', '3/64', 2200000, 2500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tipe`
--

CREATE TABLE `tb_tipe` (
  `id_tipe` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tipe`
--

INSERT INTO `tb_tipe` (`id_tipe`, `merek`, `tipe`) VALUES
('ASU0001', 'ASUS', 'ROG PHONE II ZS660KL'),
('OPP0001', 'OPPO', 'A5S'),
('OPP0002', 'OPPO', 'A5'),
('OPP0003', 'OPPO', 'A9'),
('VIV0001', 'VIVO', 'Y19'),
('VIV0002', 'VIVO', 'S1 PRO'),
('VIV0003', 'VIVO', 'V17 PRO'),
('XIA0001', 'XIAOMI', 'NOTE 5A'),
('XIA0002', 'XIAOMI', 'NOTE 8 PRO'),
('XIA0003', 'XIAOMI', 'NOTE 5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'ika.jpg',
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`, `nama`, `no_hp`, `photo`, `status`) VALUES
('kakaka', '$2y$10$57EVBGRlh2MagQyNElL8x.LXYYiScoUTw1hePOdCgeVKLgeGPFW5O', 'Bambang', '0813251627187', '5ebba36779998.png', NULL),
('labbaika', '$2y$10$j.UXkVuj1HISyWIePQ34Oe3QVslqTEUfodbdzbib2d8NI.Vrx7am2', 'Labbaika Asri', '0813701086046', '5ebba5472210d.jpeg', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_input`
--

CREATE TABLE `tb_user_input` (
  `id_user_input` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user_input`
--

INSERT INTO `tb_user_input` (`id_user_input`, `username`, `date`, `keterangan`) VALUES
('kak0001', 'kakaka', '2020-05-13 14:39:38', 'asasasa'),
('lab0001', 'labbaika', '2020-05-03 23:29:40', 'data bambang'),
('lab0002', 'labbaika', '2020-05-04 00:03:29', ''),
('lab0003', 'labbaika', '2020-05-06 12:53:12', ''),
('lab0004', 'labbaika', '2020-05-06 12:55:07', ''),
('lab0005', 'labbaika', '2020-05-08 15:22:27', ''),
('lab0006', 'labbaika', '2020-05-09 00:29:44', 'Heum'),
('lab0007', 'labbaika', '2020-05-12 23:27:06', 'kaikua'),
('lab0008', 'labbaika', '2020-05-13 00:23:25', 'awowkowkowkok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_output`
--

CREATE TABLE `tb_user_output` (
  `id_user_output` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `pembeli` varchar(255) DEFAULT 'unknown',
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user_output`
--

INSERT INTO `tb_user_output` (`id_user_output`, `username`, `date`, `pembeli`, `keterangan`) VALUES
('kak0001', 'kakaka', '2020-05-13 14:38:09', 'jajaaj', 'asasas'),
('lab0001', 'labbaika', '2020-05-06 00:00:00', 'Bambang', 'Hallo'),
('lab0002', 'labbaika', '2020-05-06 16:32:07', 'SUEIB', ''),
('lab0003', 'labbaika', '2020-05-06 16:36:10', 'SUKI', ''),
('lab0004', 'labbaika', '2020-05-08 16:25:16', 'Koit', 'koit beli hp baru yang bisa main dota2'),
('lab0005', 'labbaika', '2020-05-09 23:01:53', 'Kolosoron', 'Bantasrena'),
('lab0006', 'labbaika', '2020-05-12 23:31:27', 'Koloriput', 'Klalik'),
('lab0007', 'labbaika', '2020-05-12 23:41:00', 'asaasa', 'lalalal'),
('lab0008', 'labbaika', '2020-05-13 00:48:17', 'kakaka', 'hayyuuuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warna`
--

CREATE TABLE `tb_warna` (
  `no` int(11) NOT NULL,
  `id_tipe` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_warna`
--

INSERT INTO `tb_warna` (`no`, `id_tipe`, `warna`) VALUES
(1, 'VIV0001', 'magnetik black'),
(2, 'VIV0001', 'spring white'),
(3, 'VIV0002', 'knight black'),
(4, 'VIV0002', 'fancy sky'),
(5, 'VIV0003', 'crystal black'),
(6, 'VIV0003', 'crystal sky'),
(7, 'VIV0003', 'midnight ocean'),
(8, 'OPP0001', 'hitam'),
(9, 'OPP0001', 'merah'),
(10, 'OPP0001', 'emas'),
(11, 'OPP0001', 'hijau'),
(14, 'OPP0003', 'marine green'),
(15, 'OPP0003', 'space purple'),
(16, 'XIA0001', 'emas'),
(17, 'XIA0001', 'abu-abu'),
(18, 'XIA0001', 'pink'),
(20, 'XIA0002', 'black'),
(21, 'XIA0002', 'red'),
(22, 'XIA0002', 'blue'),
(23, 'XIA0002', 'white'),
(24, 'XIA0002', 'twilight orange'),
(64, 'ASU0001', 'hitam'),
(65, 'ASU0001', 'merah'),
(72, 'XIA0003', 'kuning'),
(73, 'XIA0003', 'hijau'),
(75, 'OPP0002', 'mirror black'),
(76, 'OPP0002', 'dazzling white'),
(77, 'OPP0002', 'black');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_input`
--
ALTER TABLE `tb_input`
  ADD PRIMARY KEY (`no`),
  ADD KEY `id_user_input` (`id_user_input`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- Indeks untuk tabel `tb_memori_harga`
--
ALTER TABLE `tb_memori_harga`
  ADD PRIMARY KEY (`no`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- Indeks untuk tabel `tb_merek`
--
ALTER TABLE `tb_merek`
  ADD PRIMARY KEY (`id_merek`),
  ADD UNIQUE KEY `merek` (`merek`);

--
-- Indeks untuk tabel `tb_output`
--
ALTER TABLE `tb_output`
  ADD PRIMARY KEY (`no`),
  ADD KEY `id_user_output` (`id_user_output`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- Indeks untuk tabel `tb_stok_barang`
--
ALTER TABLE `tb_stok_barang`
  ADD PRIMARY KEY (`serial_number`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- Indeks untuk tabel `tb_tipe`
--
ALTER TABLE `tb_tipe`
  ADD PRIMARY KEY (`id_tipe`),
  ADD KEY `id_merek` (`merek`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indeks untuk tabel `tb_user_input`
--
ALTER TABLE `tb_user_input`
  ADD PRIMARY KEY (`id_user_input`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `tb_user_output`
--
ALTER TABLE `tb_user_output`
  ADD PRIMARY KEY (`id_user_output`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `tb_warna`
--
ALTER TABLE `tb_warna`
  ADD PRIMARY KEY (`no`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_input`
--
ALTER TABLE `tb_input`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tb_memori_harga`
--
ALTER TABLE `tb_memori_harga`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `tb_merek`
--
ALTER TABLE `tb_merek`
  MODIFY `id_merek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_output`
--
ALTER TABLE `tb_output`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_warna`
--
ALTER TABLE `tb_warna`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_input`
--
ALTER TABLE `tb_input`
  ADD CONSTRAINT `tb_input_ibfk_1` FOREIGN KEY (`id_user_input`) REFERENCES `tb_user_input` (`id_user_input`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_input_ibfk_2` FOREIGN KEY (`id_tipe`) REFERENCES `tb_tipe` (`id_tipe`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_memori_harga`
--
ALTER TABLE `tb_memori_harga`
  ADD CONSTRAINT `tb_memori_harga_ibfk_1` FOREIGN KEY (`id_tipe`) REFERENCES `tb_tipe` (`id_tipe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_output`
--
ALTER TABLE `tb_output`
  ADD CONSTRAINT `tb_output_ibfk_1` FOREIGN KEY (`id_tipe`) REFERENCES `tb_tipe` (`id_tipe`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_output_ibfk_2` FOREIGN KEY (`id_user_output`) REFERENCES `tb_user_output` (`id_user_output`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_stok_barang`
--
ALTER TABLE `tb_stok_barang`
  ADD CONSTRAINT `tb_stok_barang_ibfk_2` FOREIGN KEY (`id_tipe`) REFERENCES `tb_tipe` (`id_tipe`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_tipe`
--
ALTER TABLE `tb_tipe`
  ADD CONSTRAINT `tb_tipe_ibfk_1` FOREIGN KEY (`merek`) REFERENCES `tb_merek` (`merek`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_user_input`
--
ALTER TABLE `tb_user_input`
  ADD CONSTRAINT `tb_user_input_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tb_user` (`username`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_user_output`
--
ALTER TABLE `tb_user_output`
  ADD CONSTRAINT `tb_user_output_ibfk_1` FOREIGN KEY (`username`) REFERENCES `tb_user` (`username`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_warna`
--
ALTER TABLE `tb_warna`
  ADD CONSTRAINT `tb_warna_ibfk_1` FOREIGN KEY (`id_tipe`) REFERENCES `tb_tipe` (`id_tipe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
