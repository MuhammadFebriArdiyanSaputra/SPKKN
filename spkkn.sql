-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 04:52 PM
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
-- Database: `spkkn`
--

-- --------------------------------------------------------

--
-- Table structure for table `dpl`
--

CREATE TABLE `dpl` (
  `nip` bigint(18) NOT NULL,
  `nama_dpl` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dpl`
--

INSERT INTO `dpl` (`nip`, `nama_dpl`) VALUES
(1990081720200410, 'Budi');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` bigint(11) NOT NULL,
  `nama_mahasiswa` varchar(32) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `angkatan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama_mahasiswa`, `prodi`, `angkatan`) VALUES
(2217051019, 'M. Febri Ardiyan Saputra', 'S1 Ilmu Komputer', 2022),
(2217051024, 'Nicholas Vitto Adrianto', 'S1 Ilmu Komputer', 2022),
(2217051025, 'Afina Zahra Choirunnisa', 'S1 Ilmu Komputer', 2022),
(2217051110, 'M. Fahreza Yusuf', 'S1 Ilmu Komputer', 2022);

-- --------------------------------------------------------

--
-- Stand-in structure for view `penempatan_dpl`
-- (See below for the actual view)
--
CREATE TABLE `penempatan_dpl` (
`id_tempat_dpl` int(11)
,`nip` bigint(18)
,`nama_dpl` varchar(32)
,`id_tempat` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `penempatan_mhs`
-- (See below for the actual view)
--
CREATE TABLE `penempatan_mhs` (
`id_tempat_mhs` int(11)
,`npm` bigint(11)
,`nama_mahasiswa` varchar(32)
,`nama_tempat` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE `tempat` (
  `id_tempat` int(11) NOT NULL,
  `nama_tempat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`id_tempat`, `nama_tempat`) VALUES
(1, 'Desa Menturus, Kecamatan Kudu, Kabupaten Jombang, Jawa Timur'),
(2, 'Desa Sidomulyo, Kec. Sidomulyo, Kab. Lampung Selatan, Lampung Selatan'),
(3, 'Desa Srimulyo, Kec. Anak Ratu Aji, Kab. Lampung Tengah, Lampung');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_dpl`
--

CREATE TABLE `tempat_dpl` (
  `id_tempat_dpl` int(11) NOT NULL,
  `nip` bigint(18) NOT NULL,
  `id_tempat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat_dpl`
--

INSERT INTO `tempat_dpl` (`id_tempat_dpl`, `nip`, `id_tempat`) VALUES
(1, 1990081720200410, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tempat_mhs`
--

CREATE TABLE `tempat_mhs` (
  `id_tempat_mhs` int(11) NOT NULL,
  `npm` bigint(18) NOT NULL,
  `id_tempat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat_mhs`
--

INSERT INTO `tempat_mhs` (`id_tempat_mhs`, `npm`, `id_tempat`) VALUES
(1, 2217051024, 2),
(2, 2217051019, 1),
(3, 2217051025, 2);

-- --------------------------------------------------------

--
-- Structure for view `penempatan_dpl`
--
DROP TABLE IF EXISTS `penempatan_dpl`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `penempatan_dpl`  AS SELECT `tempat_dpl`.`id_tempat_dpl` AS `id_tempat_dpl`, `dpl`.`nip` AS `nip`, `dpl`.`nama_dpl` AS `nama_dpl`, `tempat`.`id_tempat` AS `id_tempat` FROM ((`tempat_dpl` join `dpl`) join `tempat`) WHERE `tempat_dpl`.`nip` = `dpl`.`nip` AND `tempat_dpl`.`id_tempat` = `tempat`.`id_tempat` ;

-- --------------------------------------------------------

--
-- Structure for view `penempatan_mhs`
--
DROP TABLE IF EXISTS `penempatan_mhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `penempatan_mhs`  AS SELECT `tempat_mhs`.`id_tempat_mhs` AS `id_tempat_mhs`, `mahasiswa`.`npm` AS `npm`, `mahasiswa`.`nama_mahasiswa` AS `nama_mahasiswa`, `tempat`.`nama_tempat` AS `nama_tempat` FROM ((`mahasiswa` join `tempat`) join `tempat_mhs`) WHERE `tempat_mhs`.`npm` = `mahasiswa`.`npm` AND `tempat_mhs`.`id_tempat` = `tempat`.`id_tempat` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dpl`
--
ALTER TABLE `dpl`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`id_tempat`);

--
-- Indexes for table `tempat_dpl`
--
ALTER TABLE `tempat_dpl`
  ADD PRIMARY KEY (`id_tempat_dpl`),
  ADD KEY `FK_dpl` (`nip`),
  ADD KEY `FK_tempatdpl` (`id_tempat`);

--
-- Indexes for table `tempat_mhs`
--
ALTER TABLE `tempat_mhs`
  ADD PRIMARY KEY (`id_tempat_mhs`),
  ADD KEY `FK_mhs` (`npm`),
  ADD KEY `FK_tempatmhs` (`id_tempat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dpl`
--
ALTER TABLE `dpl`
  MODIFY `nip` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1990081720200411;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `npm` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2217051111;

--
-- AUTO_INCREMENT for table `tempat`
--
ALTER TABLE `tempat`
  MODIFY `id_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tempat_dpl`
--
ALTER TABLE `tempat_dpl`
  MODIFY `id_tempat_dpl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tempat_mhs`
--
ALTER TABLE `tempat_mhs`
  MODIFY `id_tempat_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tempat_dpl`
--
ALTER TABLE `tempat_dpl`
  ADD CONSTRAINT `FK_dpl` FOREIGN KEY (`nip`) REFERENCES `dpl` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tempatdpl` FOREIGN KEY (`id_tempat`) REFERENCES `tempat` (`id_tempat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tempat_mhs`
--
ALTER TABLE `tempat_mhs`
  ADD CONSTRAINT `FK_mhs` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tempatmhs` FOREIGN KEY (`id_tempat`) REFERENCES `tempat` (`id_tempat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
