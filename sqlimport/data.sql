-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 04:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_barang`
--

CREATE TABLE `table_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_barang`
--

INSERT INTO `table_barang` (`id`, `kode_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `satuan`) VALUES
(1, '51525585', 'Telur', 10000, 12500, 8, 'kg'),
(2, '90589508', 'Kopi Kapal Api', 1500, 1750, 14, 'sachet'),
(3, '53602675', 'Gula Pasir', 7500, 8000, 14, 'kg'),
(4, '53602676', 'Susu Ultramilk', 3000, 3500, 2, 'karton'),
(5, '53602677', 'Biskuit Good Day', 1000, 2000, 2, 'karton');

-- --------------------------------------------------------

--
-- Table structure for table `table_detail_penjualan`
--

CREATE TABLE `table_detail_penjualan` (
  `no_penjualan` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_detail_penjualan`
--

INSERT INTO `table_detail_penjualan` (`no_penjualan`, `nama_barang`, `harga_barang`, `jumlah_barang`, `satuan`, `sub_total`) VALUES
('PJ1584356033', 'Telur', 12500, 1, 'kg', 12500),
('PJ1584359090', 'Telur', 12500, 9, 'kg', 112500),
('PJ1584359090', 'Gula Pasir', 8000, 5, 'kg', 40000),
('PJ1584359090', 'Kopi Kapal Api', 1750, 5, 'sachet', 8750),
('PJ1584359556', 'Kopi Kapal Api', 1750, 1, 'sachet', 1750),
('PJ1584359556', 'Gula Pasir', 8000, 1, 'kg', 8000);

-- --------------------------------------------------------

--
-- Table structure for table `table_penjualan`
--

CREATE TABLE `table_penjualan` (
  `id` int(11) NOT NULL,
  `no_penjualan` varchar(50) DEFAULT NULL,
  `nama_kasir` varchar(255) DEFAULT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `jam_penjualan` time DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_penjualan`
--

INSERT INTO `table_penjualan` (`id`, `no_penjualan`, `nama_kasir`, `tgl_penjualan`, `jam_penjualan`, `total`) VALUES
(1, 'PJ1584356033', 'Nugroho', '2020-03-16', '17:53:53', 12500),
(2, 'PJ1584359090', 'Nugroho', '2020-03-16', '18:44:50', 161250),
(3, 'PJ1584359556', 'Nugroho', '2020-03-16', '18:52:36', 9750),
(4, '123', 'Aldo', '2024-07-18', '14:09:00', 50000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_barang`
--
ALTER TABLE `table_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_penjualan`
--
ALTER TABLE `table_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_barang`
--
ALTER TABLE `table_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `table_penjualan`
--
ALTER TABLE `table_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
