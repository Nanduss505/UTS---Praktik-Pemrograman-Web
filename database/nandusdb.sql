-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2026 pada 01.36
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
-- Database: `nandusdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(6) UNSIGNED NOT NULL,
  `namafile` varchar(100) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `namafile`, `uploaded_at`) VALUES
(2, 'uploads/Pas_Foto.jpeg', '2026-10-19 04:36:20'),
(4, 'uploads/LogoPolnep.png', '2026-10-19 04:52:33'),
(5, 'uploads/hero.jpeg', '2026-10-19 05:11:10'),
(6, 'uploads/Screenshot 2026-07-09 230201.png', '2026-10-19 05:15:35'),
(7, 'uploads/Screenshot 2026-07-09 211435.png', '2026-10-19 05:48:47'),
(8, 'uploads/Screenshot 2025-12-03 142931.png', '2026-10-19 05:51:49'),
(9, 'uploads/Screenshot 2026-10-20 154203.png', '2026-10-25 16:41:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_mahasiswa`
--

CREATE TABLE `nilai_mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama_mhsw` varchar(30) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `nilai_akhir` float NOT NULL,
  `nilai_huruf` varchar(5) DEFAULT NULL,
  `predikat` varchar(20) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_mahasiswa`
--

INSERT INTO `nilai_mahasiswa` (`nim`, `nama_mhsw`, `foto_profil`, `nilai_akhir`, `nilai_huruf`, `predikat`, `reg_date`, `modify_date`) VALUES
('0831255756', 'Mbapexxx', NULL, 98.99, 'A', 'Sangat Memuaskan', '2026-10-16 02:14:47', '2026-10-25 16:30:11'),
('2233445566', 'Bruno Mars', NULL, 67, 'B', 'Memuaskan', '2026-10-16 03:28:23', '2026-10-16 03:28:23'),
('3202416022', 'Sintyaa', NULL, 32, 'E', 'Tidak Lulus', '2026-10-25 19:18:28', '2026-10-25 19:18:28'),
('3202416027', 'Jamilah', NULL, 99, 'A', 'Sangat Memuaskan', '2026-10-26 00:36:07', '2026-10-26 00:36:07'),
('3202416033', 'Yakop', NULL, 20, 'E', 'Tidak Lulus', '2026-10-25 19:17:28', '2026-10-25 19:17:28'),
('3202416044', 'Udin Gepeng', NULL, 55, 'C', 'Cukup', '2026-10-25 19:18:06', '2026-10-25 19:18:06'),
('3202416049', 'Nufianti', NULL, 67, 'B', 'Memuaskan', '2026-10-26 00:35:30', '2026-10-26 00:35:30'),
('3202416050', 'Josep', NULL, 50, 'D', 'Kurang', '2026-10-25 19:16:34', '2026-10-25 19:16:34'),
('3202416052', 'Jamal', NULL, 10, 'E', 'Tidak Lulus', '2026-10-25 19:16:14', '2026-10-25 19:16:14'),
('3202416053', 'Santi', NULL, 89, 'A', 'Sangat Memuaskan', '2026-10-25 19:17:03', '2026-10-25 19:17:03'),
('3202416054', 'Nanda Oktaviano', 'uploads/1792950118_Pas_Foto.jpeg', 88, 'A', 'Sangat Memuaskan', '2026-10-25 17:41:58', '2026-10-25 17:41:58'),
('3202416066', 'Yamal', 'uploads/1792955935_LogoPolnep.png', 66, 'B', 'Memuaskan', '2026-10-25 19:18:55', '2026-10-25 19:30:48'),
('3202416077', 'Mardian', NULL, 66, 'B', 'Memuaskan', '2026-10-26 00:35:49', '2026-10-26 00:35:49'),
('3202416088', 'Mukti', NULL, 34, 'E', 'Tidak Lulus', '2026-10-25 19:28:52', '2026-10-25 19:28:52'),
('4455667788', 'Dudung Ermawan', NULL, 78, 'B', 'Memuaskan', '2026-10-12 07:28:50', '2026-10-16 04:05:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_mahasiswa`
--
ALTER TABLE `nilai_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
