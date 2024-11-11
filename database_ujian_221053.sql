-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 11:20 PM
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
-- Table structure for table `mahasiswa_mata_kuliah_221053`
--

CREATE TABLE `mahasiswa_mata_kuliah_221053` (
  `id_221053` int(11) NOT NULL,
  `id_mahasiswa_221053` int(11) DEFAULT NULL,
  `id_mata_kuliah_221053` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa_mata_kuliah_221053`
--

INSERT INTO `mahasiswa_mata_kuliah_221053` (`id_221053`, `id_mahasiswa_221053`, `id_mata_kuliah_221053`) VALUES
(1, 19, 6),
(2, 19, 7),
(3, 20, 8),
(4, 20, 9),
(5, 21, 9),
(6, 21, 10),
(7, 22, 12),
(8, 22, 11),
(9, 23, 10),
(10, 23, 14),
(11, 23, 6),
(12, 20, 6),
(13, 21, 6);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah_221053`
--

CREATE TABLE `mata_kuliah_221053` (
  `id_221053` int(11) NOT NULL,
  `id_dosen_221053` int(11) NOT NULL,
  `nama_221053` varchar(255) NOT NULL,
  `kode_221053` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_kuliah_221053`
--

INSERT INTO `mata_kuliah_221053` (`id_221053`, `id_dosen_221053`, `nama_221053`, `kode_221053`) VALUES
(6, 14, 'Algoritma dan Pemrograman', 'TI101'),
(7, 14, 'Basis Data', 'TI102'),
(8, 15, 'Jaringan Komputer', 'TI103'),
(9, 15, 'Pengembangan Aplikasi Web', 'TI104'),
(10, 16, 'Rekayasa Perangkat Lunak', 'TI105'),
(11, 16, 'Struktur Data', 'TI106'),
(12, 17, 'Kecerdasan Buatan', 'TI107'),
(13, 17, 'Rekayasa Web', 'TI108'),
(14, 18, 'Sistem Operasi', 'TI109'),
(15, 18, 'Keamanan Jaringan', 'TI110');

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
  `pertanyaan_221053` text NOT NULL,
  `opsi_a_221053` varchar(255) NOT NULL,
  `opsi_b_221053` varchar(255) NOT NULL,
  `opsi_c_221053` varchar(255) NOT NULL,
  `opsi_d_221053` varchar(255) NOT NULL,
  `jawaban_benar_221053` enum('A','B','C','D') NOT NULL
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
  `status_221053` enum('aktif','nonaktif') DEFAULT 'aktif'
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
  `role_221053` enum('dosen','mahasiswa','admin') NOT NULL,
  `active_221053` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_221053`
--

INSERT INTO `users_221053` (`id_221053`, `nama_221053`, `username_221053`, `password_221053`, `role_221053`, `active_221053`) VALUES
(7, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1),
(14, 'Dr. Andi Suryanto, M.Si.', 'andi', 'ce0e5bf55e4f71749eade7a8b95c4e46', 'dosen', 1),
(15, 'Prof. Rina Susanti, Ph.D.', 'rina', '3aea9516d222934e35dd30f142fda18c', 'dosen', 1),
(16, 'Dr. Budi Santoso, M.T.', 'budi', '00dfc53ee86af02e742515cdcf075ed3', 'dosen', 1),
(17, 'Ir. Fani Pratiwi, M.Sc.', 'fani', 'ee61d621f12489791ce28b31409daee4', 'dosen', 1),
(18, 'Dr. Hendra Wijaya, M.Kom.', 'hendra', 'a04cca766a885687e33bc6b114230ee9', 'dosen', 1),
(19, 'Ahmad Fajar Pratama', 'ahmad', '61243c7b9a4022cb3f8dc3106767ed12', 'mahasiswa', 1),
(20, 'Siti Nurhaliza', 'siti', 'db04eb4b07e0aaf8d1d477ae342bdff9', 'mahasiswa', 1),
(21, 'Riko Setiawan', 'riko', '206e8e5e74a2a33379e0e2be7f2ce6d1', 'mahasiswa', 1),
(22, 'Dinda Putri Sari', 'dinda', '594280c6ddc94399a392934cac9d80d5', 'mahasiswa', 1),
(23, 'Gede Wira Pratama', 'gede', '13ad65cc032d4b04927943c33673a65d', 'mahasiswa', 1);

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
-- Indexes for table `mahasiswa_mata_kuliah_221053`
--
ALTER TABLE `mahasiswa_mata_kuliah_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD KEY `id_mahasiswa_221053` (`id_mahasiswa_221053`),
  ADD KEY `id_mata_kuliah_221053` (`id_mata_kuliah_221053`);

--
-- Indexes for table `mata_kuliah_221053`
--
ALTER TABLE `mata_kuliah_221053`
  ADD PRIMARY KEY (`id_221053`),
  ADD UNIQUE KEY `kode_221053` (`kode_221053`),
  ADD KEY `id_dosen_221053` (`id_dosen_221053`);

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
  ADD KEY `mata_kuliah_id_221053` (`mata_kuliah_id_221053`);

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
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jawaban_mahasiswa_221053`
--
ALTER TABLE `jawaban_mahasiswa_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa_mata_kuliah_221053`
--
ALTER TABLE `mahasiswa_mata_kuliah_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mata_kuliah_221053`
--
ALTER TABLE `mata_kuliah_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pilihan_221053`
--
ALTER TABLE `pilihan_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal_ujian_221053`
--
ALTER TABLE `soal_ujian_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ujian_221053`
--
ALTER TABLE `ujian_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_221053`
--
ALTER TABLE `users_221053`
  MODIFY `id_221053` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_ujian_221053`
--
ALTER TABLE `hasil_ujian_221053`
  ADD CONSTRAINT `hasil_ujian_221053_ibfk_1` FOREIGN KEY (`ujian_id_221053`) REFERENCES `ujian_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_ujian_221053_ibfk_2` FOREIGN KEY (`mahasiswa_id_221053`) REFERENCES `users_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawaban_mahasiswa_221053`
--
ALTER TABLE `jawaban_mahasiswa_221053`
  ADD CONSTRAINT `jawaban_mahasiswa_221053_ibfk_1` FOREIGN KEY (`hasil_id_221053`) REFERENCES `hasil_ujian_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_mahasiswa_221053_ibfk_2` FOREIGN KEY (`soal_id_221053`) REFERENCES `soal_ujian_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_mahasiswa_221053_ibfk_3` FOREIGN KEY (`pilihan_id_221053`) REFERENCES `pilihan_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa_mata_kuliah_221053`
--
ALTER TABLE `mahasiswa_mata_kuliah_221053`
  ADD CONSTRAINT `mahasiswa_mata_kuliah_221053_ibfk_1` FOREIGN KEY (`id_mahasiswa_221053`) REFERENCES `users_221053` (`id_221053`) ON DELETE CASCADE,
  ADD CONSTRAINT `mahasiswa_mata_kuliah_221053_ibfk_2` FOREIGN KEY (`id_mata_kuliah_221053`) REFERENCES `mata_kuliah_221053` (`id_221053`) ON DELETE CASCADE;

--
-- Constraints for table `mata_kuliah_221053`
--
ALTER TABLE `mata_kuliah_221053`
  ADD CONSTRAINT `mata_kuliah_221053_ibfk_1` FOREIGN KEY (`id_dosen_221053`) REFERENCES `users_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pilihan_221053`
--
ALTER TABLE `pilihan_221053`
  ADD CONSTRAINT `pilihan_221053_ibfk_1` FOREIGN KEY (`soal_id_221053`) REFERENCES `soal_ujian_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal_ujian_221053`
--
ALTER TABLE `soal_ujian_221053`
  ADD CONSTRAINT `soal_ujian_221053_ibfk_1` FOREIGN KEY (`ujian_id_221053`) REFERENCES `ujian_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ujian_221053`
--
ALTER TABLE `ujian_221053`
  ADD CONSTRAINT `ujian_221053_ibfk_1` FOREIGN KEY (`mata_kuliah_id_221053`) REFERENCES `mata_kuliah_221053` (`id_221053`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
