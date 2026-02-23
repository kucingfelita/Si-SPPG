-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 08:50 AM
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
-- Database: `db_si_sppg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(75) NOT NULL,
  `namalengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `namalengkap`) VALUES
(1, 'ethan', 'eith123', 'Ethan Timmy Van Harry'),
(2, 'ndra', 'ndra123', 'Wahyu Indra Setiawan'),
(3, 'dlione', 'dlione123', 'Ahmad Nadliful Ngizza'),
(4, 'bin', 'bin123', 'Rizky Setiawan'),
(5, 'dinda', 'dinda123', 'Yasmine Ayu Adinda'),
(6, 'hana', 'hana123', 'Hana Adlilia Rifaie');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `namamenu` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `menu_utama` varchar(255) NOT NULL,
  `lauk` varchar(255) DEFAULT 'Tidak Ada',
  `saus` varchar(255) DEFAULT 'Tidak Ada',
  `dessert` varchar(255) DEFAULT 'Tidak Ada',
  `energi_besar` varchar(100) DEFAULT 'Tidak Ada',
  `protein_besar` varchar(100) DEFAULT 'Tidak Ada',
  `lemak_besar` varchar(100) DEFAULT 'Tidak Ada',
  `karbo_besar` varchar(100) DEFAULT 'Tidak Ada',
  `energi_kecil` double NOT NULL,
  `protein_kecil` double NOT NULL,
  `lemak_kecil` double NOT NULL,
  `karbo_kecil` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT 'Pengirim Rahasia',
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis` enum('Request','Keluhan') NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
