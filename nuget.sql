-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2021 at 09:03 PM
-- Server version: 10.3.31-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bermainapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1 = ADMIN\r\n2 = CS'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `level`) VALUES
(5, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1');

-- --------------------------------------------------------

--
-- Table structure for table `autoreply`
--

CREATE TABLE `autoreply` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `response` varchar(255) NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `case_sensitive` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `autoreply`
--

INSERT INTO `autoreply` (`id`, `keyword`, `response`, `media`, `case_sensitive`) VALUES
(7, 'harga', 'harga Rp. 300.000', NULL, '0'),
(8, 'hari', 'hari ini saya kirim ', NULL, '0'),
(9, 'jkw', 'Joko Widodo', NULL, '0'),
(10, 'api', 'api media', 'https://api.umarsolution.com/uploads/16294032071332760293.png', '0'),
(12, 'harisa', 'ased', 'https://api.umarsolution.com/uploads/1629405120949707970.jpg', '0'),
(13, 'ws', 'walaikumsalam', NULL, '0'),
(16, 'daftarharga', 'Berikut adalah daftar harga kami', 'https://api.umarsolution.com/uploads/117336203.jpg', '0'),
(17, 'saya mau daftar', 'Silahkan daftarkan diri Anda dengan mengisi formulir berikut :\r\n\r\nNama :\r\nAlamat :\r\n\r\nAtau melalui link berikut ini : https://youtube.com', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `blast`
--

CREATE TABLE `blast` (
  `id` int(11) NOT NULL,
  `nomor` text NOT NULL,
  `pesan` text NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `jadwal` datetime NOT NULL,
  `make_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blast`
--

INSERT INTO `blast` (`id`, `nomor`, `pesan`, `media`, `jadwal`, `make_by`) VALUES
(29, 'a:2:{i:0;s:12:\"082245598567\";i:1;s:12:\"082256698567\";}', 'jk', NULL, '2021-08-09 02:33:00', 'admin'),
(30, 'a:3:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"082246633567\";}', 'ter', NULL, '2021-08-14 01:04:00', 'admin'),
(31, 'a:4:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"082246633567\";i:3;s:12:\"082246698554\";}', 'Ini Adalah Isi Template Promo Ramadhanku\r\njuag', NULL, '2021-08-17 04:31:00', 'admin'),
(32, 'a:4:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"082246633567\";i:3;s:12:\"082246698554\";}', 'Ini Adalah Isi Template Promo Ramadhanku\r\njuag', NULL, '2021-08-14 04:34:00', 'admin'),
(33, 'a:4:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"082246633567\";i:3;s:12:\"082246698554\";}', 'iya and I will ', NULL, '2021-08-14 06:50:00', 'admin'),
(34, 'a:4:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"082246633567\";i:3;s:12:\"082246698554\";}', 'Ini Adalah Isi Template Promo Ramadhanku\r\njuag', NULL, '2021-08-14 06:50:00', 'admin'),
(35, 'a:3:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"082246698554\";}', 'cxbcx', 'https://api.umarsolution.com/uploads/16294084871698238030.png', '2021-08-20 04:32:00', 'admin'),
(36, 'a:6:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"085156084240\";i:3;s:12:\"089907277663\";i:4;s:12:\"085156084233\";i:5;s:12:\"082246698567\";}', 'isi promo tahun baru', 'https://api.umarsolution.com/uploads/16295258591345032454.png', '2021-08-21 13:05:00', 'admin'),
(37, 'a:2:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";}', 'isi promo tahun baru', 'https://api.umarsolution.com/uploads/16296292621038425154.jpg', '2021-08-22 17:49:00', 'admin'),
(38, 'a:2:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";}', 'Dalam Rangka Kemerdekaan Republik Indonesia ke 76, kami memberikan diskon 40% untuk setiap produk di toko kami.', 'https://api.umarsolution.com/uploads/1629638789486942190.jpg', '2021-08-22 20:27:00', 'admin'),
(39, 'a:3:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"082120998599\";}', 'Dalam Rangka Kemerdekaan Republik Indonesia ke 76, kami memberikan diskon 40% untuk setiap produk di toko kami.', 'https://api.umarsolution.com/uploads/16296388911152121339.jpg', '2021-08-22 20:28:00', 'admin'),
(40, 'a:3:{i:0;s:12:\"082256698567\";i:1;s:11:\"08990727766\";i:2;s:12:\"082120998599\";}', 'Dalam Rangka Kemerdekaan Republik Indonesia ke 76, kami memberikan diskon 40% untuk setiap produk di toko kami.', 'https://api.umarsolution.com/uploads/16296391412021018228.jpg', '2021-08-22 20:33:00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(4) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(4, 'Pelanggan'),
(6, 'Penjual'),
(9, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `nomor`
--

CREATE TABLE `nomor` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `nama_kategori` varchar(60) NOT NULL,
  `make_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomor`
--

INSERT INTO `nomor` (`id`, `nama`, `nomor`, `nama_kategori`, `make_by`) VALUES
(188, 'Sulfi', '082256698567', 'Pelanggan', 'admin'),
(189, 'Daniel', '08990727766', 'Pelanggan', 'admin'),
(199, 'Steven', '082120998599', 'Test', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `chunk` int(11) NOT NULL,
  `wa_gateway_url` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL DEFAULT '310ea2abbaafe1844ac63f57ff20860b78e77c40',
  `callback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `chunk`, `wa_gateway_url`, `nomor`, `api_key`, `callback`) VALUES
(1, 30, 'https://api.umarsolution.com/', '', '514074', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `id_blast` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `media` varchar(255) DEFAULT NULL,
  `status` enum('MENUNGGU JADWAL','GAGAL','TERKIRIM') NOT NULL DEFAULT 'MENUNGGU JADWAL',
  `jadwal` datetime NOT NULL,
  `tiap_bulan` enum('0','1') NOT NULL DEFAULT '0',
  `last_month` varchar(255) DEFAULT NULL,
  `make_by` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `id_blast`, `nomor`, `pesan`, `media`, `status`, `jadwal`, `tiap_bulan`, `last_month`, `make_by`, `time`) VALUES
(374, '15', '081387109685', 'Telekonsul rs permata keluarga karawang', 'https://api.umarsolution.com/uploads/16278340591455411971.jpg', 'MENUNGGU JADWAL', '2021-08-01 23:08:00', '1', '08', 'admin', '2021-08-01 16:09:04'),
(375, '15', '083815537745', 'Telekonsul rs permata keluarga karawang', 'https://api.umarsolution.com/uploads/16278340591455411971.jpg', 'MENUNGGU JADWAL', '2021-08-01 23:08:00', '1', '08', 'admin', '2021-08-01 16:11:05'),
(397, '32', '082246698554', 'Ini Adalah Isi Template Promo Ramadhanku\r\njuag', NULL, 'GAGAL', '2021-08-14 04:34:00', '0', '07', 'admin', '2021-08-13 21:34:03'),
(398, '33', '082256698567', 'iya and I will ', NULL, 'GAGAL', '2021-08-14 06:50:00', '0', '07', 'admin', '2021-08-13 23:50:05'),
(401, '34', '082246698554', 'Ini Adalah Isi Template Promo Ramadhanku\r\njuag', NULL, 'GAGAL', '2021-08-14 06:50:00', '0', '07', 'admin', '2021-08-13 23:50:07'),
(402, '34', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-15 17:35:41'),
(403, '34', '012', 'fghfg', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-15 17:48:17'),
(404, '34', '082246698567', 'sss', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 10:44:36'),
(405, '34', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 11:28:02'),
(406, '34', '082246698567', 'test button', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 11:29:39'),
(407, '34', '082246698567', 'test api sending button', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 11:42:38'),
(408, '34', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:04:51'),
(409, '34', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:05:22'),
(410, '34', '082246698567', 'test api sending ', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:19:34'),
(411, '34', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:20:39'),
(412, '34', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:21:35'),
(413, '34', '082246698567', '', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:24:51'),
(414, '34', '082246698567', 'testvbu', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:26:07'),
(415, '34', '082246698567', 'testvbu', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:31:36'),
(416, '34', '082246698567', 'testvbu', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:32:25'),
(417, '34', '082246698567', 'testvbu', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:36:39'),
(418, '34', '082246698567', 'testvbu', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:38:33'),
(419, '34', '082246698567', 'testvbu', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:38:44'),
(420, '34', '082246698567', 'testvbu', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 12:40:16'),
(421, '34', '081224993382', 'test pesan button ', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 13:57:02'),
(422, '34', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-17 17:46:15'),
(423, '34', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-19 18:23:55'),
(424, '34', '082246698567', 'test pesan button ', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-19 18:24:18'),
(426, '35', '085261103136', 'test pesan button ', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-20 09:35:55'),
(427, '36', '082246698567', 'isi promo tahun baru', 'https://api.umarsolution.com/uploads/16295258591345032454.png', 'TERKIRIM', '2021-08-21 13:05:00', '0', '07', 'admin', '2021-08-21 06:05:05'),
(428, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:04:27'),
(429, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:05:45'),
(430, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:07:51'),
(431, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:12:01'),
(432, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:12:21'),
(433, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:12:59'),
(434, '36', '082246698567', 'gdg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:15:41'),
(435, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:16:58'),
(436, '36', '012', 'fghfg', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:17:51'),
(437, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:22:27'),
(438, '36', '082246698567', 'testvbu', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:22:38'),
(439, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:28:25'),
(440, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:29:40'),
(441, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:31:47'),
(442, '36', '012', 'fghfg', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:32:36'),
(443, '36', '012', 'fghfg', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:33:22'),
(444, '36', '082246698567', 'fghfg', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:33:56'),
(445, '36', '082246698567', 'Config vars change the way your app behaves. In addition to creating your own, some add-ons come with their own.', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:46:52'),
(446, '36', '012', 'Config vars change the way your app behaves. In addition to creating your own, some add-ons come with their own.', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:58:22'),
(447, '36', '082246698567', 'sss', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 09:58:35'),
(448, '36', '085793122278', 'tes ya', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-21 20:39:18'),
(449, '36', '082120998599', 'test', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-22 10:21:26'),
(450, '36', '082120998599', 'Daftar sekarang webinar gratis', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-22 10:22:29'),
(451, '37', '082256698567', 'isi promo tahun baru', 'https://api.umarsolution.com/uploads/16296292621038425154.jpg', 'GAGAL', '2021-08-22 17:49:00', '0', '07', 'admin', '2021-08-22 10:49:01'),
(452, '37', '08990727766', 'isi promo tahun baru', 'https://api.umarsolution.com/uploads/16296292621038425154.jpg', 'GAGAL', '2021-08-22 17:49:00', '0', '07', 'admin', '2021-08-22 10:49:01'),
(456, '39', '012', 'Config vars change the way your app behaves. In addition to creating your own, some add-ons come with their own.', NULL, 'GAGAL', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-22 13:28:56'),
(457, '39', '082120998599', 'Daftar sekarang webinar gratis', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-22 13:30:57'),
(458, '40', '082120998599', 'Dalam Rangka Kemerdekaan Republik Indonesia ke 76, kami memberikan diskon 40% untuk setiap produk di toko kami.', 'https://api.umarsolution.com/uploads/16296391412021018228.jpg', 'TERKIRIM', '2021-08-22 20:33:00', '0', '07', 'admin', '2021-08-22 13:33:05'),
(459, '40', '082120998599', 'Daftar sekarang webinar gratis', NULL, 'TERKIRIM', '0000-00-00 00:00:00', '0', NULL, NULL, '2021-08-22 13:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id_template` int(4) NOT NULL,
  `nama_template` varchar(20) NOT NULL,
  `isi_template` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id_template`, `nama_template`, `isi_template`) VALUES
(6, 'Promo Tahun Baru', 'isi promo tahun baru'),
(7, 'Promo Ramadhan', 'Ini Adalah Isi Template Promo Ramadhanku\r\njuag'),
(9, 'Promo Agustus', '$nomor$nomor$nomor'),
(10, 'Promo Kemerdekaan', 'Dalam Rangka Kemerdekaan Republik Indonesia ke 76, kami memberikan diskon 40% untuk setiap produk di toko kami.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autoreply`
--
ALTER TABLE `autoreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blast`
--
ALTER TABLE `blast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `nomor`
--
ALTER TABLE `nomor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id_template`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `autoreply`
--
ALTER TABLE `autoreply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `blast`
--
ALTER TABLE `blast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nomor`
--
ALTER TABLE `nomor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id_template` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
