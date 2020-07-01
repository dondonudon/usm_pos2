-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2020 at 05:54 AM
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
('A', 5),
('B', 0);

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

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `ket`, `kode_m_kasir`, `id_barang`, `qty`, `tipe`, `datetime`) VALUES
(10, '2A2020060005', NULL, 6, 10, 'A', '2020-06-27 16:15:20'),
(9, '2A2020060005', NULL, 3, 10, 'A', '2020-06-27 16:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `mst_barang`
--

CREATE TABLE `mst_barang` (
  `id` int NOT NULL,
  `id_kategori` int NOT NULL,
  `barang` varchar(20) DEFAULT NULL,
  `ukuran` varchar(10) NOT NULL,
  `stok` int DEFAULT '0',
  `use_stok` int NOT NULL DEFAULT '0',
  `harga` int DEFAULT NULL,
  `use_pricelist` int NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mst_barang`
--

INSERT INTO `mst_barang` (`id`, `id_kategori`, `barang`, `ukuran`, `stok`, `use_stok`, `harga`, `use_pricelist`, `datetime`) VALUES
(3, 1, 'a', 'a4', 10, 1, NULL, 1, '2020-06-24 03:56:34'),
(4, 1, 'b', 'a4', 0, 0, 1000, 0, '2020-06-24 04:03:02'),
(5, 1, 'c', 'a4', 0, 0, NULL, 1, '2020-06-24 04:03:23'),
(6, 1, 'd', 'a4', 10, 1, 1000, 0, '2020-06-24 04:04:44');

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
(1, 'tes1', '2020-06-24 03:26:34');

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

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `no_po`, `jumlah`, `ket`, `id_user`, `datetime`) VALUES
(9, '2A2020060005', 0, 'asdasd', 2, '2020-06-27 16:15:20');

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

--
-- Dumping data for table `po_detail`
--

INSERT INTO `po_detail` (`id`, `no_po`, `id_barang`, `qty`, `harga`, `jumlah`, `datetime`) VALUES
(18, '2A2020060005', 3, 10, 1000, 10000, '2020-06-27 16:15:03'),
(19, '2A2020060005', 6, 10, 1000, 10000, '2020-06-27 16:15:18');

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

--
-- Dumping data for table `pricelist`
--

INSERT INTO `pricelist` (`id`, `id_barang`, `range_pricelist`, `harga`, `keterangan`, `datetime`) VALUES
(1, 3, 1, 3000, NULL, '2020-06-24 04:46:51'),
(2, 3, 2, 2000, NULL, '2020-06-24 04:46:51'),
(3, 3, 3, 1000, NULL, '2020-06-24 04:46:51'),
(4, 4, 1, 3500, NULL, '2020-06-24 04:47:46'),
(5, 4, 2, 2500, NULL, '2020-06-24 04:47:46'),
(6, 4, 3, 1500, NULL, '2020-06-24 04:47:46');

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
(1, '1-10', '1-10', 1, 10, '2020-06-24 04:31:51'),
(2, '2-20', '2-20', 2, 20, '2020-06-24 04:32:43'),
(3, '3-999999999', '3-999999999', 3, 999999999, '2020-06-24 04:32:59');

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
(40, 3, 12),
(41, 3, 14),
(42, 3, 15),
(43, 3, 17),
(44, 2, 8),
(45, 2, 19),
(46, 2, 20),
(47, 2, 21),
(48, 2, 22);

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
(8, 'Overview', 'welcome', 'fa fa-tachometer', 0, 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 0, 'y'),
(10, 'Customer', 'mst_customer', 'fa fa-users', 19, 3, 'y'),
(11, 'Master Barang', 'mst_barang', 'fa fa-barcode', 19, 2, 'y'),
(12, 'Transaksi', '#', 'fa fa-cc-mastercard', 0, 2, 'y'),
(13, 'Barang Masuk', 'po', 'fa fa-shopping-basket', 12, 1, 'y'),
(14, 'Penjualan', 'trans', 'fa fa-shopping-cart', 12, 2, 'y'),
(15, 'Laporan', '#', 'fa fa-file-o', 0, 3, 'y'),
(16, 'Barang Masuk', '#', 'fa fa-shopping-basket', 15, 1, 'y'),
(17, 'Penjualan', '#', 'fa fa-shopping-cart', 15, 2, 'y'),
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
(3, 'admin', 'admin@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 2, 'y'),
(7, 'kasir', 'kasir@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 3, 'y');

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
  `id_customer` int NOT NULL,
  `id_barang` int NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trans`
--

CREATE TABLE `trans` (
  `id` int NOT NULL,
  `notrans` varchar(15) NOT NULL,
  `jumlah` int NOT NULL,
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
  `id_customer` int NOT NULL,
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
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_barang`
--
ALTER TABLE `mst_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_customer`
--
ALTER TABLE `mst_customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `range_pricelist`
--
ALTER TABLE `range_pricelist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temp_po`
--
ALTER TABLE `temp_po`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `temp_trans`
--
ALTER TABLE `temp_trans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans`
--
ALTER TABLE `trans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_detail`
--
ALTER TABLE `trans_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
