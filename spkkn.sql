-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2024 pada 02.56
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `dpl`
--

CREATE TABLE `dpl` (
  `id` bigint(18) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` bigint(18) NOT NULL,
  `kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dpl`
--

INSERT INTO `dpl` (`id`, `nama`, `nip`, `kontak`) VALUES
(1, 'Dosen, S.kom.', 12232211, '0895989891'),
(2, 'Dosen, S.kom.', 12232212, '0895989892');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` bigint(11) NOT NULL,
  `nama_mahasiswa` varchar(32) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `angkatan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama_mahasiswa`, `prodi`, `angkatan`) VALUES
(2217051019, 'M. Febri Ardiyan Saputra', 'S1 Ilmu Komputer', 2022),
(2217051024, 'Nicholas Vitto Adrianto', 'S1 Ilmu Komputer', 2022),
(2217051025, 'Afina Zahra Choirunnisa', 'S1 Ilmu Komputer', 2022),
(2217051110, 'M. Fahreza Yusuf', 'S1 Ilmu Komputer', 2022);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat`
--

CREATE TABLE `tempat` (
  `id_tempat` int(11) NOT NULL,
  `nama_tempat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tempat`
--

INSERT INTO `tempat` (`id_tempat`, `nama_tempat`) VALUES
(1, 'Desa Menturu, Kecamatan Kudu, Kabupaten Jombang, Jawa Timur'),
(2, 'Desa Sidomulyo, Kec. Sidomulyo, Kab. Lampung Selatan, Lampung Selatan'),
(3, 'Desa Srimulyo, Kec. Anak Ratu Aji, Kab. Lampung Tengah, Lampung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat_dpl`
--

CREATE TABLE `tempat_dpl` (
  `id_tempat_dpl` int(11) NOT NULL,
  `nip` bigint(18) NOT NULL,
  `id_tempat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat_mhs`
--

CREATE TABLE `tempat_mhs` (
  `id_tempat_mhs` int(11) NOT NULL,
  `npm` bigint(18) NOT NULL,
  `id_tempat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tempat_mhs`
--

INSERT INTO `tempat_mhs` (`id_tempat_mhs`, `npm`, `id_tempat`) VALUES
(1, 2217051024, 2),
(2, 2217051019, 1),
(3, 2217051025, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dpl`
--
ALTER TABLE `dpl`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indeks untuk tabel `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`id_tempat`);

--
-- Indeks untuk tabel `tempat_dpl`
--
ALTER TABLE `tempat_dpl`
  ADD PRIMARY KEY (`id_tempat_dpl`),
  ADD KEY `FK_dpl` (`nip`),
  ADD KEY `FK_tempatdpl` (`id_tempat`);

--
-- Indeks untuk tabel `tempat_mhs`
--
ALTER TABLE `tempat_mhs`
  ADD PRIMARY KEY (`id_tempat_mhs`),
  ADD KEY `FK_mhs` (`npm`),
  ADD KEY `FK_tempatmhs` (`id_tempat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dpl`
--
ALTER TABLE `dpl`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `npm` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2217051111;

--
-- AUTO_INCREMENT untuk tabel `tempat`
--
ALTER TABLE `tempat`
  MODIFY `id_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tempat_dpl`
--
ALTER TABLE `tempat_dpl`
  MODIFY `id_tempat_dpl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tempat_mhs`
--
ALTER TABLE `tempat_mhs`
  MODIFY `id_tempat_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tempat_dpl`
--
ALTER TABLE `tempat_dpl`
  ADD CONSTRAINT `FK_dpl` FOREIGN KEY (`nip`) REFERENCES `dpl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tempatdpl` FOREIGN KEY (`id_tempat`) REFERENCES `tempat` (`id_tempat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tempat_mhs`
--
ALTER TABLE `tempat_mhs`
  ADD CONSTRAINT `FK_mhs` FOREIGN KEY (`npm`) REFERENCES `mahasiswa` (`npm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tempatmhs` FOREIGN KEY (`id_tempat`) REFERENCES `tempat` (`id_tempat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
