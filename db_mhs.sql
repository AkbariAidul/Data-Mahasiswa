-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2025 pada 16.42
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
-- Database: `db_mhs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(13) NOT NULL,
  `id_mhs` int(225) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `jurusan` varchar(40) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `id_mhs`, `nama`, `jenis_kelamin`, `jurusan`, `alamat`) VALUES
('24302011', 1, 'Lailatul Mubarokah', 'P', 'D3 TEKNIK INFORMATIKA', 'Sinar Baru'),
('24302012', 2, 'Muhammad Amin', 'L', 'D3 TEKNIK OTOMOTIF', 'Sungai Gampa Muhara'),
('24302004', 3, 'Sandriana Ariani', 'P', 'D4 TEKNOLOGI REKAYASA MULTIMEDIA', 'Wanaraya'),
('24302013', 4, 'Aidul Akbari', 'L', 'D3 BUDIDAYA TANAMAN PERKEBUNAN', 'Mandastana'),
('24302014', 5, 'Alvina', 'P', 'D4 BISNIS DIGITAL', 'Marabahan'),
('24302008', 6, 'Raudhatul Hasanah', 'P', 'D4 MANAJEMEN PEMASARAN INTERNASIONAL', 'Marabahan'),
('24302015', 7, 'Muhammad Amin Badali', 'L', 'D4 AKUNTANSI BISNIS DIGITAL', 'Margasari'),
('24302016', 8, 'Fatimah', 'P', 'D3 TEKNIK INFORMATIKA', 'Margasari'),
('24302017', 9, 'Halimatus Sa\'diah', 'P', 'D3 TEKNIK OTOMOTIF', 'Margasari'),
('24302006', 10, 'Naimah', 'P', 'D4 TEKNOLOGI REKAYASA MULTIMEDIA', 'Margasari'),
('24302018', 11, 'Nurul Wafa', 'P', 'D3 BUDIDAYA TANAMAN PERKEBUNAN', 'Margasari'),
('24302019', 12, 'Siti Nor Hafipah', 'P', 'D4 BISNIS DIGITAL', 'Margasari'),
('24302020', 13, 'Rabiatul Munawarah', 'P', 'D4 BISNIS DIGITAL', 'Margasari'),
('24302021', 14, 'Siti Aisyah', 'P', 'D4 AKUNTANSI BISNIS DIGITAL', 'Margasari'),
('24302024', 15, 'Syifa Nur Ardianie', 'P', 'D3 TEKNIK INFORMATIKA', 'Alalak'),
('24302025', 16, 'Raudah', 'P', 'D3 TEKNIK OTOMOTIF', 'Sungai Salai'),
('24302026', 17, 'Muhammad Arif', 'L', 'D4 TEKNOLOGI REKAYASA MULTIMEDIA', 'Sungai Lulut'),
('24302027', 18, 'Muhammad Haikal', 'L', 'D3 BUDIDAYA TANAMAN PERKEBUNAN', 'Tamban'),
('24302028', 19, 'Arsyifa', 'P', 'D4 BISNIS DIGITAL', 'Belawang'),
('24302029', 20, 'Noor Hidayah', 'P', 'D4 MANAJEMEN PEMASARAN INTERNASIONAL', 'Belawang'),
('24302030', 21, 'Kharunnisa', 'P', 'D4 AKUNTANSI BISNIS DIGITAL', 'Mandastana'),
('24302031', 22, 'Muhamad Hidayat', 'L', 'D3 TEKNIK INFORMATIKA', 'Belawang'),
('24302032', 23, 'Farras Dwie Cahyani', 'P', 'D3 TEKNIK OTOMOTIF', 'Danda Jaya'),
('24302043', 24, 'Iqbal Rupawan', 'L', 'D4 TEKNOLOGI REKAYASA MULTIMEDIA', 'Banjarmasin'),
('24302057', 25, 'Muhammad Abdi', 'L', 'D3 BUDIDAYA TANAMAN PERKEBUNAN', 'Sungai Tabuk'),
('24302040', 26, 'Muhammad Basirun Arafi', 'L', 'D4 BISNIS DIGITAL', 'Marabahan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mhs`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mhs` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
