-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2024 at 01:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_presensi`
--

CREATE TABLE `riwayat_presensi` (
  `id` int NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `presensi` enum('Hadir','Izin','Alpa') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_presensi`
--

INSERT INTO `riwayat_presensi` (`id`, `nis`, `nama`, `jurusan`, `presensi`, `tanggal`) VALUES
(1, '18339', 'Fadli Akhar Zusfian', 'Rekayasa Perangkat Lunak', 'Hadir', '2024-12-19'),
(2, '18335', 'Dafiansyah Raihan Ankhesya', 'Rekayasa Perangkat Lunak', 'Alpa', '2024-12-19'),
(3, '18335', 'Dafiansyah Raihan Ankhesya', 'Rekayasa Perangkat Lunak', 'Hadir', '2024-12-19'),
(4, '18339', 'Fadli Akhar Zusfian', 'Rekayasa Perangkat Lunak', 'Alpa', '2024-12-19'),
(5, '18339', 'Fadli Akhar Zusfian', 'Rekayasa Perangkat Lunak', 'Hadir', '2024-12-20'),
(6, '18335', 'Dafiansyah Raihan Ankhesya', 'Rekayasa Perangkat Lunak', 'Izin', '2024-12-20'),
(7, '18335', 'Dafiansyah Raihan Ankhesya', 'Rekayasa Perangkat Lunak', 'Izin', '2024-12-20'),
(8, '18339', 'Fadli Akhar Zusfian', 'Rekayasa Perangkat Lunak', 'Izin', '2024-12-20'),
(9, '18339', 'Fadli Akhar Zusfian', 'Rekayasa Perangkat Lunak', 'Alpa', '2024-12-21'),
(10, '18335', 'Dafiansyah Raihan Ankhesya', 'Rekayasa Perangkat Lunak', 'Hadir', '2024-12-21'),
(11, '18339', 'Fadli Akhar Zusfian', 'Rekayasa Perangkat Lunak', 'Alpa', '2024-12-21'),
(12, '18335', 'Dafiansyah Raihan Ankhesya', 'Rekayasa Perangkat Lunak', 'Hadir', '2024-12-21'),
(13, '18339', 'Fadli Akhar Zusfian', 'Rekayasa Perangkat Lunak', 'Alpa', '2024-12-21'),
(14, '18342', 'Hanif Maulana Bramantia', 'Rekayasa Perangkat Lunak', 'Hadir', '2024-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `presensi` enum('Hadir','Izin','Alpa') NOT NULL DEFAULT 'Alpa',
  `tanggal_presensi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `jurusan`, `presensi`, `tanggal_presensi`) VALUES
(1, '18339', 'Fadli Akhar Zusfian', 'Rekayasa Perangkat Lunak', 'Alpa', '2024-12-21'),
(2, '18335', 'Dafiansyah Raihan Ankhesya', 'Rekayasa Perangkat Lunak', 'Hadir', '2024-12-21'),
(3, '18342', 'Hanif Maulana Bramantia', 'Rekayasa Perangkat Lunak', 'Hadir', '2024-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `password`) VALUES
(3, 'admin', '$2y$10$84YxQsxnFDvWNbwm3OGkdOVZ0O3Fw.oO9dPyDIk2PnY4pP8W/OmqO'),
(4, 'fadli', '$2y$10$DNoJMHldKD7QZXs0fy0tOOTxPBUT5ftc5s8SYlk7qrsDGfjtlOi2e'),
(5, 'guru', '$2y$10$oZ9qLgfv2qubmBMMx3Mbl.X3olZJvDdMEzEztYjmS3zVroNQFoSsy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `riwayat_presensi`
--
ALTER TABLE `riwayat_presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `riwayat_presensi`
--
ALTER TABLE `riwayat_presensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
