-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jul 15, 2023 at 01:42 PM
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
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`, `harga`) VALUES
(2, 'KK002', 'mobil', 3000),
(3, 'KK003', 'motor', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `parkir_keluar`
--

CREATE TABLE `parkir_keluar` (
  `id_keluar` int NOT NULL,
  `kode_karcis` varchar(200) NOT NULL,
  `id_masuk` int NOT NULL,
  `waktu_keluar` datetime NOT NULL,
  `durasi_parkir` int NOT NULL,
  `harga` int NOT NULL,
  `status_keluar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parkir_keluar`
--

INSERT INTO `parkir_keluar` (`id_keluar`, `kode_karcis`, `id_masuk`, `waktu_keluar`, `durasi_parkir`, `harga`, `status_keluar`) VALUES
(8, '', 32, '2023-07-13 17:22:16', 9, 18659, 0),
(10, 'KC0002', 33, '2023-07-14 07:36:16', 0, 3000, 2),
(11, 'KC0003', 34, '2023-07-14 07:52:36', 0, 3000, 2),
(12, 'KC0005', 36, '2023-07-14 09:44:57', 0, 3000, 2),
(13, 'KC0004', 35, '2023-07-14 09:51:38', 0, 0, 2),
(14, 'KC0007', 38, '2023-07-14 16:56:02', 0, 0, 2),
(15, 'KC0006', 37, '2023-07-14 16:58:26', 0, 3000, 2),
(16, 'KC0009', 40, '2023-07-15 16:36:21', 6, 7023, 2),
(17, 'KC0008', 39, '2023-07-15 16:46:29', 5, 3097, 2),
(22, 'KC0010', 41, '2023-07-15 17:35:55', 2, 1500, 2),
(32, 'KC0011', 43, '2023-07-15 18:13:59', 6, 5000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `parkir_masuk`
--

CREATE TABLE `parkir_masuk` (
  `id_masuk` int NOT NULL,
  `kode_karcis` varchar(200) NOT NULL,
  `kode_kendaraan` varchar(200) NOT NULL,
  `plat_nomer` varchar(200) NOT NULL,
  `tanggal_masuk` datetime DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parkir_masuk`
--

INSERT INTO `parkir_masuk` (`id_masuk`, `kode_karcis`, `kode_kendaraan`, `plat_nomer`, `tanggal_masuk`, `status`) VALUES
(32, 'KC0001', 'KK003', 'B4478BTK', '2023-07-13 08:02:29', 2),
(33, 'KC0002', 'KK003', 'B4635BLG', '2023-07-14 07:32:48', 2),
(34, 'KC0003', 'KK003', 'B4635BLG', '2023-07-14 07:52:28', 2),
(35, 'KC0004', 'KK002', 'B2913BTK', '2023-07-14 09:43:52', 2),
(36, 'KC0005', 'KK003', 'BN872BBK', '2023-07-14 09:44:08', 2),
(37, 'KC0006', 'KK002', 'G7349KKN', '2023-07-14 16:55:47', 2),
(38, 'KC0007', 'KK003', 'H3726BHK', '2023-07-14 16:55:55', 2),
(39, 'KC0008', 'KK003', 'B2913BTK', '2023-07-15 11:34:52', 2),
(40, 'KC0009', 'KK002', 'B4894TOP', '2023-07-15 10:34:58', 2),
(41, 'KC0010', 'KK003', 'B2913BTK', '2023-07-15 15:00:00', 2),
(43, 'KC0011', 'KK003', 'B8382BTA', '2023-07-15 12:00:50', 2),
(44, 'KC0012', 'KK002', 'B3840RAF', '2023-07-15 15:00:22', 1);

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
-- Indexes for table `parkir_keluar`
--
ALTER TABLE `parkir_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_masuk` (`id_masuk`);

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
-- AUTO_INCREMENT for table `parkir_keluar`
--
ALTER TABLE `parkir_keluar`
  MODIFY `id_keluar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `parkir_masuk`
--
ALTER TABLE `parkir_masuk`
  MODIFY `id_masuk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
