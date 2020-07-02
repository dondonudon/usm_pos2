-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2020 at 02:44 AM
-- Server version: 8.0.20-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usm_pos2`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` varchar(2) NOT NULL COMMENT 'A=notrans, B=stock_opname, C=master_stok_kasir, D=retur_kasir',
  `counter` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `counter`) VALUES
('A', 1),
('B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `kode_m_kasir` varchar(10) DEFAULT NULL,
  `id_barang` int NOT NULL,
  `qty` int NOT NULL,
  `tipe` varchar(1) NOT NULL COMMENT 'A=po, B=penjualan',
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_barang`
--

CREATE TABLE `mst_barang` (
  `id` int NOT NULL,
  `id_kategori` int NOT NULL,
  `barang` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ukuran` varchar(10) NOT NULL,
  `stok` int DEFAULT '0',
  `use_stok` int NOT NULL DEFAULT '0',
  `harga` int DEFAULT '0',
  `use_pricelist` int NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_barang`
--

INSERT INTO `mst_barang` (`id`, `id_kategori`, `barang`, `ukuran`, `stok`, `use_stok`, `harga`, `use_pricelist`, `datetime`) VALUES
(1, 1, 'HVS 80 gr', '80 gr', 0, 0, 0, 1, '2020-07-02 23:16:24'),
(2, 1, 'HVS 100 gr', '100 gr', 0, 0, 0, 1, '2020-07-02 23:46:47'),
(3, 1, 'MATTE PAPER', '-', 0, 0, 0, 1, '2020-07-02 23:47:30'),
(4, 1, 'CTS 150 gr', '150 gr', 0, 0, 0, 1, '2020-07-02 23:48:18'),
(5, 1, 'IVORY 230 gr', '230 gr', 0, 0, 0, 1, '2020-07-02 23:49:53'),
(6, 1, 'IVORY 260 gr', '260 gr', 0, 0, 0, 1, '2020-07-02 23:50:27'),
(7, 1, 'BC 200 gr', '200 gr', 0, 0, 0, 1, '2020-07-02 23:52:32'),
(8, 1, 'SPLENDORGEL', '-', 0, 0, 0, 1, '2020-07-02 23:52:49'),
(9, 1, 'RASTER', '-', 0, 0, 0, 1, '2020-07-02 23:53:45'),
(10, 1, 'ST. WHITE GLOSSY', '-', 0, 0, 8000, 0, '2020-07-02 23:54:11'),
(11, 1, 'ST. TRANSPARANT', '-', 0, 0, 8000, 0, '2020-07-02 23:54:41'),
(12, 2, 'MMT 280 gr (Bahan China)', '280 gr', 0, 0, 18000, 0, '2020-07-03 01:13:52'),
(13, 2, 'MMT 440 gr (Bahan Korea)', '440 gr', 0, 0, 30000, 0, '2020-07-03 01:14:54'),
(14, 2, 'MMT 340 gr (Bahan China)', '340 gr', 0, 0, 24000, 0, '2020-07-03 01:15:47'),
(15, 2, 'X BANNER 280 gr', '280 gr', 0, 0, 75000, 0, '2020-07-03 01:16:28'),
(16, 2, 'X BANNER 340 gr', '340 gr', 0, 0, 85000, 0, '2020-07-03 01:16:52'),
(17, 2, 'X BANNER 440 gr', '440 gr', 0, 0, 95000, 0, '2020-07-03 01:17:28'),
(18, 2, 'Y BANNER 280 gr', '280 gr', 0, 0, 85000, 0, '2020-07-03 01:18:44'),
(19, 2, 'Y BANNER 340 gr', '340 gr', 0, 0, 95000, 0, '2020-07-03 01:19:12'),
(20, 2, 'Roll Banner 280 gr', '280 gr', 0, 0, 235000, 0, '2020-07-03 01:19:34'),
(21, 2, 'Roll Banner 340 gr', '340 gr', 0, 0, 250000, 0, '2020-07-03 01:19:57'),
(22, 2, 'Roll Banner 440 gr', '440 gr', 0, 0, 265000, 0, '2020-07-03 01:25:43'),
(23, 2, 'Roll Banner 80 x 200', '80 x 200', 0, 0, 275000, 0, '2020-07-03 01:26:04'),
(24, 2, 'Roll Banner 85 x 200', '85 x 200', 0, 0, 325000, 0, '2020-07-03 01:26:22'),
(25, 2, 'Backlite', '-', 0, 0, 50000, 0, '2020-07-03 01:26:36'),
(26, 2, 'Oneway', '-', 0, 0, 60000, 0, '2020-07-03 01:26:50'),
(27, 3, 'Easy Banner', '-', 0, 0, 85000, 0, '2020-07-03 01:27:19'),
(28, 3, 'Photo Paper', '-', 0, 0, 75000, 0, '2020-07-03 01:27:38'),
(29, 3, 'Luster', '-', 0, 0, 70000, 0, '2020-07-03 01:27:51'),
(30, 3, 'Albatros', '-', 0, 0, 70000, 0, '2020-07-03 01:28:04'),
(31, 3, 'Vinyl', '-', 0, 0, 60000, 0, '2020-07-03 01:28:19'),
(32, 3, 'Print & Cut Vinyl', '-', 0, 0, 105000, 0, '2020-07-03 01:28:34'),
(33, 3, 'Backlite PET', '-', 0, 0, 115000, 0, '2020-07-03 01:28:47'),
(34, 3, 'Greyback', '-', 0, 0, 65000, 0, '2020-07-03 01:29:00'),
(35, 3, 'Sticker Camel', '-', 0, 0, 65000, 0, '2020-07-03 01:29:32'),
(36, 3, 'Sticker Ritrama', '-', 0, 0, 80000, 0, '2020-07-03 01:29:57'),
(37, 3, 'Orajet Blockout', '-', 0, 0, 80000, 0, '2020-07-03 01:30:30'),
(38, 3, 'Easy Banner', '-', 0, 0, 90000, 0, '2020-07-03 01:31:37'),
(39, 3, 'Canvas', '-', 0, 0, 145000, 0, '2020-07-03 01:31:54'),
(40, 4, 'HVS 1 Warna 1 Sisi', '-', 0, 0, 150000, 0, '2020-07-03 01:32:15'),
(41, 4, 'HVS 1 Warna 2 Sisi', '-', 0, 0, 300000, 0, '2020-07-03 01:32:31'),
(42, 4, 'HVS (warna) 1 Sisi', '-', 0, 0, 325000, 0, '2020-07-03 01:32:55'),
(43, 4, 'HVS (warna) 2 Sisi', '-', 0, 0, 650000, 0, '2020-07-03 01:33:11'),
(44, 4, 'CTS A4 150 gr 1 Sisi', '-', 0, 0, 500000, 0, '2020-07-03 01:33:42'),
(45, 4, 'CTS A4 150 gr 2 Sisi', '-', 0, 0, 800000, 0, '2020-07-03 01:54:43'),
(46, 4, 'CTS A5 150 gr 1 Sisi', '-', 0, 0, 250000, 0, '2020-07-03 02:31:04'),
(47, 4, 'CTS A5 150 gr 2 Sisi', '-', 0, 0, 500000, 0, '2020-07-03 02:31:25'),
(48, 4, 'Matte Paper A4 1 Sisi', '-', 0, 0, 550000, 0, '2020-07-03 02:31:42'),
(49, 4, 'Matte Paper A4 2 Sisi', '-', 0, 0, 850000, 0, '2020-07-03 02:32:09'),
(50, 4, 'Matte Paper A5 1 Sisi', '-', 0, 0, 255000, 0, '2020-07-03 02:32:29'),
(51, 4, 'Matte Paper A5 2 Sisi', '-', 0, 0, 550000, 0, '2020-07-03 02:32:48'),
(52, 5, 'PVC ID CARD', '-', 0, 0, 5000, 0, '2020-07-03 02:33:16'),
(53, 5, 'Bolpoin Tali (&lt;50)', '-', 0, 0, 6000, 0, '2020-07-03 02:33:39'),
(54, 5, 'Bolpoin Tali (>50)', '-', 0, 0, 5500, 0, '2020-07-03 02:33:55'),
(55, 5, 'Kartu Nama (1 Sisi)', '-', 0, 0, 30000, 0, '2020-07-03 02:34:12'),
(56, 5, 'Kartu Nama (2 Sisi)', '-', 0, 0, 35000, 0, '2020-07-03 02:34:29'),
(57, 5, 'Kop Surat', '-', 0, 0, 250000, 0, '2020-07-03 02:34:41'),
(58, 5, 'Amplop', '-', 0, 0, 135000, 0, '2020-07-03 02:34:51'),
(59, 6, 'HVS A0 Hitam Putih', '-', 0, 0, 20000, 0, '2020-07-03 02:35:28'),
(60, 6, 'HVS A1 Hitam Putih', '-', 0, 0, 15000, 0, '2020-07-03 02:35:47'),
(61, 6, 'HVS A2 Hitam Putih', '-', 0, 0, 10000, 0, '2020-07-03 02:36:12'),
(62, 6, 'Manila A0 Hitam Putih', '-', 0, 0, 30000, 0, '2020-07-03 02:36:25'),
(63, 6, 'Manila A1 Hitam Putih', '-', 0, 0, 25000, 0, '2020-07-03 02:36:38'),
(64, 6, 'Manila A2 Hitam Putih', '-', 0, 0, 15000, 0, '2020-07-03 02:36:54'),
(65, 6, 'Kalkir A0 Hitam Putih', '-', 0, 0, 25000, 0, '2020-07-03 02:37:08'),
(66, 6, 'Kalkir A1 Hitam Putih', '-', 0, 0, 18000, 0, '2020-07-03 02:37:30'),
(67, 6, 'Kalkir A2 Hitam Putih', '-', 0, 0, 15000, 0, '2020-07-03 02:37:55'),
(68, 6, 'Photopaper A0 Hitam Putih', '-', 0, 0, 25000, 0, '2020-07-03 02:38:08'),
(69, 6, 'Photopaper A1 Hitam Putih', '-', 0, 0, 15000, 0, '2020-07-03 02:38:24'),
(70, 6, 'Photopaper A2 Hitam Putih', '-', 0, 0, 12000, 0, '2020-07-03 02:38:38'),
(71, 6, 'HVS A0 Warna', '-', 0, 0, 40000, 0, '2020-07-03 02:39:41'),
(72, 6, 'HVS A1 Warna', '-', 0, 0, 35000, 0, '2020-07-03 02:39:58'),
(73, 6, 'HVS A2 Warna', '-', 0, 0, 30000, 0, '2020-07-03 02:40:31'),
(74, 6, 'Manila A0 Warna', '-', 0, 0, 45000, 0, '2020-07-03 02:40:47'),
(75, 6, 'Manila A1 Warna', '-', 0, 0, 40000, 0, '2020-07-03 02:41:08'),
(76, 6, 'Manila A2 Warna', '-', 0, 0, 30000, 0, '2020-07-03 02:41:23'),
(77, 6, 'Photopaper A0 Warna', '-', 0, 0, 70000, 0, '2020-07-03 02:41:37'),
(78, 6, 'Photopaper A1 Warna', '-', 0, 0, 55000, 0, '2020-07-03 02:42:10'),
(79, 6, 'Photopaper A2 Warna', '-', 0, 0, 35000, 0, '2020-07-03 02:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `mst_customer`
--

CREATE TABLE `mst_customer` (
  `id` int NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_customer`
--

INSERT INTO `mst_customer` (`id`, `nama`, `alamat`, `telp`, `datetime`) VALUES
(1, 'nama1', 'alamat1', 'telp1', '2020-06-24 03:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori`
--

CREATE TABLE `mst_kategori` (
  `id` int NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_kategori`
--

INSERT INTO `mst_kategori` (`id`, `kategori`, `datetime`) VALUES
(1, 'A3+ Color', '2020-06-24 03:26:34'),
(2, 'Outdoor', '2020-07-02 22:56:07'),
(3, 'Indoor', '2020-07-02 22:56:12'),
(4, 'Brosur', '2020-07-02 22:56:24'),
(5, 'Office Kit', '2020-07-02 22:56:39'),
(6, 'Plotter', '2020-07-02 22:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `id` int NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `jumlah` int NOT NULL,
  `ket` varchar(50) NOT NULL,
  `id_user` int NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `po_detail`
--

CREATE TABLE `po_detail` (
  `id` int NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `id_barang` int NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pricelist`
--

CREATE TABLE `pricelist` (
  `id` int NOT NULL,
  `id_barang` int DEFAULT NULL,
  `range_pricelist` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `keterangan` varbinary(225) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `range_pricelist`
--

CREATE TABLE `range_pricelist` (
  `id` int NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `qty_a` int DEFAULT NULL,
  `qty_b` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `range_pricelist`
--

INSERT INTO `range_pricelist` (`id`, `nama`, `keterangan`, `qty_a`, `qty_b`, `datetime`) VALUES
(1, '1-9', '1-9', 1, 9, '2020-07-02 23:00:02'),
(2, '10-20', '10-20', 10, 20, '2020-07-02 22:59:53'),
(3, '21-50', '21-50', 21, 50, '2020-07-02 23:00:34'),
(4, '51-99', '51-99', 51, 99, '2020-07-02 23:00:48'),
(5, '100+', '100+', 100, 999999999, '2020-07-02 23:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int NOT NULL,
  `id_user_level` int NOT NULL,
  `id_menu` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(15, 1, 1),
(19, 1, 3),
(24, 1, 9),
(30, 1, 2),
(31, 2, 10),
(32, 2, 11),
(33, 2, 12),
(34, 2, 13),
(35, 2, 14),
(36, 2, 15),
(37, 2, 16),
(38, 2, 17),
(39, 3, 10),
(42, 3, 15),
(43, 3, 17),
(44, 2, 30),
(45, 2, 19),
(46, 2, 20),
(47, 2, 21),
(48, 2, 22),
(51, 3, 12),
(52, 3, 13),
(53, 3, 14),
(54, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int NOT NULL,
  `urutan` int NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `urutan`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 0, 'y'),
(7, 'Customer', 'mst_customer', 'fa fa-users', 0, 1, 'y'),
(8, '', 'welcome', '', 0, 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 0, 'y'),
(10, 'Customer', 'mst_customer', 'fa fa-users', 19, 3, 'y'),
(11, 'Master Barang', 'mst_barang', 'fa fa-barcode', 19, 2, 'y'),
(12, 'Transaksi', '#', 'fa fa-cc-mastercard', 0, 2, 'y'),
(13, 'Barang Masuk', 'po', 'fa fa-shopping-basket', 12, 1, 'y'),
(14, 'Penjualan', 'trans', 'fa fa-shopping-cart', 12, 2, 'y'),
(15, 'Laporan', '#', 'fa fa-file-o', 0, 3, 'y'),
(16, 'Barang Masuk', 'laporan_masuk', 'fa fa-shopping-basket', 15, 1, 'y'),
(17, 'Penjualan', 'laporan_keluar', 'fa fa-shopping-cart', 15, 2, 'y'),
(19, 'Master', '#', 'fa fa-database', 0, 1, 'y'),
(20, 'Master Kategori', 'mst_kategori', 'fa fa-bars', 19, 1, 'y'),
(21, 'Pricelist', 'pricelist', 'fa fa-money', 19, 5, 'y'),
(22, 'Range Pricelist', 'range_pricelist', 'fa fa-money', 19, 4, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'super', 'super@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 'y'),
(2, 'admin', 'admin@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 2, 'y'),
(3, 'kasir', 'kasir@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 3, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `temp_po`
--

CREATE TABLE `temp_po` (
  `id` int NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `id_barang` int NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp_trans`
--

CREATE TABLE `temp_trans` (
  `id` int NOT NULL,
  `notrans` varchar(15) NOT NULL,
  `id_barang` int NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_trans`
--

INSERT INTO `temp_trans` (`id`, `notrans`, `id_barang`, `qty`, `harga`, `jumlah`, `datetime`) VALUES
(21, '8B2020070002', 44, 2, 500000, 1000000, '2020-07-03 01:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `id` int NOT NULL,
  `notrans` varchar(15) NOT NULL,
  `id_customer` int NOT NULL,
  `jumlah` int DEFAULT NULL,
  `ket` varchar(50) NOT NULL,
  `id_user` int NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trans_detail`
--

CREATE TABLE `trans_detail` (
  `id` int NOT NULL,
  `notrans` varchar(15) NOT NULL,
  `id_barang` int NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `mst_barang`
--
ALTER TABLE `mst_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_customer`
--
ALTER TABLE `mst_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_detail`
--
ALTER TABLE `po_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricelist`
--
ALTER TABLE `pricelist`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `range_pricelist`
--
ALTER TABLE `range_pricelist`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- Indexes for table `temp_po`
--
ALTER TABLE `temp_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_trans`
--
ALTER TABLE `temp_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans`
--
ALTER TABLE `trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_detail`
--
ALTER TABLE `trans_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mst_barang`
--
ALTER TABLE `mst_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `mst_customer`
--
ALTER TABLE `mst_customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `po_detail`
--
ALTER TABLE `po_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pricelist`
--
ALTER TABLE `pricelist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `range_pricelist`
--
ALTER TABLE `range_pricelist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temp_po`
--
ALTER TABLE `temp_po`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `temp_trans`
--
ALTER TABLE `temp_trans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trans_detail`
--
ALTER TABLE `trans_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
