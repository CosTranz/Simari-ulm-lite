-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Okt 2023 pada 02.26
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_akademik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `nip` varchar(13) NOT NULL,
  `nama_dosen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_dosen`
--

INSERT INTO `tb_dosen` (`nip`, `nama_dosen`) VALUES
('2103212021', 'Pa Rudi'),
('2193201', 'Pa Friska');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` varchar(13) NOT NULL,
  `nama_mhs` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `nama_mhs`, `jenis_kelamin`, `tgl_lahir`, `alamat`) VALUES
('2111016210011', 'Hafiz Ilhami', 'Laki-Laki', '2004-02-13', 'GH Ilkom 21'),
('2111016210015', 'Kayalina', 'Perempuan', '2001-02-12', 'GH Ilkom 21'),
('2111016210017', 'Jaya', 'Laki-Laki', '2001-02-12', 'GH Ilkom 21'),
('2111016210029', 'KIYI', 'Perempuan', '2002-02-12', 'GH Ilkom 21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matakuliah`
--

CREATE TABLE `tb_matakuliah` (
  `kode_mk` varchar(13) NOT NULL,
  `nama_mk` varchar(255) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_matakuliah`
--

INSERT INTO `tb_matakuliah` (`kode_mk`, `nama_mk`, `sks`, `semester`) VALUES
('2000110', 'Pemograman Web Lanjut', 4, 5),
('212212', 'Bahasa Indonesia', 3, 5),
('212332', 'Pemograman Web Dasar', 4, 4),
('JFK212', 'Kalkulus', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perkuliahan`
--

CREATE TABLE `tb_perkuliahan` (
  `id_perkuliahan` int(11) NOT NULL,
  `nim` varchar(13) DEFAULT NULL,
  `kode_mk` varchar(13) DEFAULT NULL,
  `nip` varchar(13) DEFAULT NULL,
  `ruangan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_perkuliahan`
--

INSERT INTO `tb_perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nip`, `ruangan`) VALUES
(36, '2111016210011', '2000110', '2103212021', 'MIPA II 3.2'),
(32, '2111016210015', '212332', '2193201', 'MIPA II 3.2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tb_matakuliah`
--
ALTER TABLE `tb_matakuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indeks untuk tabel `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
  ADD PRIMARY KEY (`id_perkuliahan`),
  ADD KEY `nim` (`nim`,`kode_mk`,`nip`,`ruangan`),
  ADD KEY `tb_perkuliahan_ibfk_2` (`kode_mk`),
  ADD KEY `tb_perkuliahan_ibfk_3` (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
  MODIFY `id_perkuliahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
  ADD CONSTRAINT `tb_perkuliahan_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_perkuliahan_ibfk_2` FOREIGN KEY (`kode_mk`) REFERENCES `tb_matakuliah` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_perkuliahan_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `tb_dosen` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_perkuliahan_id_perkuliahan` FOREIGN KEY (`kode_mk`) REFERENCES `tb_matakuliah` (`kode_mk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
