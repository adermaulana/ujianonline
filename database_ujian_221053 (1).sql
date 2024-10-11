-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 04:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_ujian_221053`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ujian_221053`
--

CREATE TABLE `hasil_ujian_221053` (
  `id_221053` int(11) NOT NULL,
  `ujian_id_221053` int(11) NOT NULL,
  `mahasiswa_id_221053` int(11) NOT NULL,
  `nilai_221053` decimal(5,2) DEFAULT 0.00,
  `dikumpulkan_pada_221053` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_mahasiswa_221053`
--

CREATE TABLE `jawaban_mahasiswa_221053` (
  `id_221053` int(11) NOT NULL,
  `hasil_id_221053` int(11) NOT NULL,
  `soal_id_221053` int(11) NOT NULL,
  `jawaban_teks_221053` text DEFAULT NULL,
  `pilihan_id_221053` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah_221053`
--

CREATE TABLE `mata_kuliah_221053` (
  `id_221053` int(11) NOT NULL,
  `nama_221053` varchar(255) NOT NULL,
  `kode_221053` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pilihan_221053`
--

CREATE TABLE `pilihan_221053` (
  `id_221053` int(11) NOT NULL,
  `soal_id_221053` int(11) NOT NULL,
  `teks_pilihan_221053` text NOT NULL,
  `benar_221053` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal_ujian_221053`
--

CREATE TABLE `soal_ujian_221053` (
  `id_221053` int(11) NOT NULL,
  `ujian_id_221053` int(11) NOT NULL,
  `teks_soal_221053` text NOT NULL,
  `tipe_soal_221053` enum('pilihan_ganda','essay') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ujian_221053`
--

CREATE TABLE `ujian_221053` (
  `id_221053` int(11) NOT NULL,
  `mata_kuliah_id_221053` int(11) NOT NULL,
  `judul_221053` varchar(255) NOT NULL,
  `waktu_mulai_221053` datetime NOT NULL,
  `waktu_selesai_221053` datetime NOT NULL,
  `status_221053` enum('aktif','nonaktif') DEFAULT 'aktif',
  `users_id_221053` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_221053`
--

CREATE TABLE `users_221053` (
  `id_221053` int(11) NOT NULL,
  `nama_221053` varchar(255) NOT NULL,
  `username_221053` varchar(255) NOT NULL,
  `password_221053` varchar(255) NOT NULL,
  `role_221053` enum('dosen','mahasiswa') NOT NULL,
  `active_221053` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_221053`
--

INSERT INTO `users_221053` (`id_221053`, `nama_221053`, `username_221053`, `password_221053`, `role_221053`, `active_221053`) VALUES
(1, 'admin', 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', 1),
(2, 'madun', 'madun', '827ccb0eea8a706c4c34a16891f84e7b', 'dosen', 0),
(3, 'ultra', 'ultra', '827ccb0eea8a706c4c34a16891f84e7b', 'mahasiswa', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_ujian_221053`
--
ALTER TABLE `hasil_ujian_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD KEY `ujian_id_221053` (`ujian_id_221053`),
  ADD KEY `mahasiswa_id_221053` (`mahasiswa_id_221053`);

--
-- Indexes for table `jawaban_mahasiswa_221053`
--
ALTER TABLE `jawaban_mahasiswa_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD KEY `hasil_id_221053` (`hasil_id_221053`),
  ADD KEY `soal_id_221053` (`soal_id_221053`),
  ADD KEY `pilihan_id_221053` (`pilihan_id_221053`);

--
-- Indexes for table `mata_kuliah_221053`
--
ALTER TABLE `mata_kuliah_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD UNIQUE KEY `kode_221053` (`kode_221053`);

--
-- Indexes for table `pilihan_221053`
--
ALTER TABLE `pilihan_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD KEY `soal_id_221053` (`soal_id_221053`);

--
-- Indexes for table `soal_ujian_221053`
--
ALTER TABLE `soal_ujian_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD KEY `ujian_id_221053` (`ujian_id_221053`);

--
-- Indexes for table `ujian_221053`
--
ALTER TABLE `ujian_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD KEY `mata_kuliah_id_221053` (`mata_kuliah_id_221053`),
  ADD KEY `users_id_221053` (`users_id_221053`);

--
-- Indexes for table `users_221053`
--
ALTER TABLE `users_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD UNIQUE KEY `username_221053` (`username_221053`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_ujian_221053`
--
ALTER TABLE `hasil_ujian_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban_mahasiswa_221053`
--
ALTER TABLE `jawaban_mahasiswa_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_kuliah_221053`
--
ALTER TABLE `mata_kuliah_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pilihan_221053`
--
ALTER TABLE `pilihan_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal_ujian_221053`
--
ALTER TABLE `soal_ujian_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ujian_221053`
--
ALTER TABLE `ujian_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_221053`
--
ALTER TABLE `users_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_ujian_221053`
--
ALTER TABLE `hasil_ujian_221053`
  ADD CONSTRAINT `hasil_ujian_221053_ibfk_1` FOREIGN KEY (`ujian_id_221053`) REFERENCES `ujian_221053` (`id_221053`),
  ADD CONSTRAINT `hasil_ujian_221053_ibfk_2` FOREIGN KEY (`mahasiswa_id_221053`) REFERENCES `users_221053` (`id_221053`);

--
-- Constraints for table `jawaban_mahasiswa_221053`
--
ALTER TABLE `jawaban_mahasiswa_221053`
  ADD CONSTRAINT `jawaban_mahasiswa_221053_ibfk_1` FOREIGN KEY (`hasil_id_221053`) REFERENCES `hasil_ujian_221053` (`id_221053`),
  ADD CONSTRAINT `jawaban_mahasiswa_221053_ibfk_2` FOREIGN KEY (`soal_id_221053`) REFERENCES `soal_ujian_221053` (`id_221053`),
  ADD CONSTRAINT `jawaban_mahasiswa_221053_ibfk_3` FOREIGN KEY (`pilihan_id_221053`) REFERENCES `pilihan_221053` (`id_221053`);

--
-- Constraints for table `pilihan_221053`
--
ALTER TABLE `pilihan_221053`
  ADD CONSTRAINT `pilihan_221053_ibfk_1` FOREIGN KEY (`soal_id_221053`) REFERENCES `soal_ujian_221053` (`id_221053`);

--
-- Constraints for table `soal_ujian_221053`
--
ALTER TABLE `soal_ujian_221053`
  ADD CONSTRAINT `soal_ujian_221053_ibfk_1` FOREIGN KEY (`ujian_id_221053`) REFERENCES `ujian_221053` (`id_221053`);

--
-- Constraints for table `ujian_221053`
--
ALTER TABLE `ujian_221053`
  ADD CONSTRAINT `ujian_221053_ibfk_1` FOREIGN KEY (`mata_kuliah_id_221053`) REFERENCES `mata_kuliah_221053` (`id_221053`),
  ADD CONSTRAINT `ujian_221053_ibfk_2` FOREIGN KEY (`users_id_221053`) REFERENCES `users_221053` (`id_221053`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
