-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jul 10, 2023 at 03:58 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uaspwe`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kode_kategori` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nama_kategori` varchar(200) NOT NULL,
  `harga` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`, `harga`) VALUES
(1, 'KK001', 'mbem', '2000'),
(2, 'KK002', 'mobil', '40002812'),
(3, 'KK003', 'motor', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `parkir_masuk`
--

CREATE TABLE `parkir_masuk` (
  `id_masuk` int NOT NULL,
  `kode_kendaraan` varchar(200) NOT NULL,
  `plat_nomer` varchar(200) NOT NULL,
  `tanggal_masuk` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parkir_masuk`
--

INSERT INTO `parkir_masuk` (`id_masuk`, `kode_kendaraan`, `plat_nomer`, `tanggal_masuk`) VALUES
(10, 'KK001', 'B3829BTL', '2023-07-09 17:32:00'),
(11, 'KK002', 'nn324nnj', '2023-07-10 00:41:55'),
(12, 'KK002', 'B2930BTK', '2023-07-10 14:43:36'),
(13, 'KK003', 'BM924NNK', '2023-07-10 15:47:27'),
(14, 'KK002', 'BM495KK', '2023-07-10 15:48:09'),
(15, 'KK002', 'KO324PK', '2023-07-10 15:49:30'),
(16, 'KK003', 'KO324MM', '2023-07-10 15:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `noHp` varchar(20) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `username`, `password`, `alamat`, `noHp`, `role`) VALUES
(1, 'jjnjn', '1234', 'jalanjalan', '9343', 'pegawai'),
(2, 'alif', '123123', 'kalideres', '29324', 'admin'),
(4, 'dapa', 'dapa', 'kapuk', '08391212342', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `parkir_masuk`
--
ALTER TABLE `parkir_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `kode_kendaraan` (`kode_kendaraan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parkir_masuk`
--
ALTER TABLE `parkir_masuk`
  MODIFY `id_masuk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
