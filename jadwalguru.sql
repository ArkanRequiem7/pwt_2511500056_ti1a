-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Bulan Mei 2026 pada 04.57
-- Versi server: 8.0.44
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwalguru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `Nama_lengkap` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `Nama_lengkap`, `Username`, `Password`) VALUES
(1, 'Muhammad Arkan Ramadhan', 'Arkan', 'Arkan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekstra_056`
--

CREATE TABLE `ekstra_056` (
  `id_ekstra056` varchar(5) NOT NULL,
  `nama_ekstra056` varchar(50) DEFAULT NULL,
  `ket056` varchar(20) DEFAULT NULL,
  `semester056` int DEFAULT NULL,
  `thn_ajaran056` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `ekstra_056`
--

INSERT INTO `ekstra_056` (`id_ekstra056`, `nama_ekstra056`, `ket056`, `semester056`, `thn_ajaran056`) VALUES
('E001', 'Badminton9', 'Sport1', 1, '2025/2026'),
('j1', 'jq', 'q', 1, '2025/2026');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `Kd_guru` varchar(5) NOT NULL,
  `Nm_guru` varchar(50) NOT NULL,
  `Jenkel` varchar(10) NOT NULL,
  `Pend_terakhir` varchar(20) NOT NULL,
  `Hp` varchar(13) NOT NULL,
  `Alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`Kd_guru`, `Nm_guru`, `Jenkel`, `Pend_terakhir`, `Hp`, `Alamat`) VALUES
('Ren12', 'Renn Mla', 'Perempuan', 'Strata 1', '999999999999', 'Mentok'),
('Ren99', 'Renn ZO', 'Perempuan', 'Strata 2', '3131131333131', 'Mentok'),
('Renn1', 'Renn ZM', 'Laki-laki', 'Strata 2', '999999999999', 'Mentok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `kd_mapel` varchar(10) NOT NULL,
  `kd_guru` varchar(10) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `thn_ajaran` varchar(20) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_kelas`, `kd_mapel`, `kd_guru`, `hari`, `jam`, `thn_ajaran`, `semester`) VALUES
(3, '1', 'M-001', 'Ren12', 'Senin', '07:00-9:30', '2024/2025', 'Ganjil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `Id_kelas` varchar(10) NOT NULL,
  `Nm_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`Id_kelas`, `Nm_kelas`) VALUES
('1', 'IPA'),
('2', 'Agama'),
('3', 'IPS');

--
-- Trigger `kelas`
--
DELIMITER $$
CREATE TRIGGER `tg_kode_kelas` BEFORE INSERT ON `kelas` FOR EACH ROW BEGIN
    DECLARE s_id INT;
    SELECT CAST(SUBSTRING(MAX(Id_kelas), 3) AS UNSIGNED) INTO s_id FROM `kelas`;
    
    IF s_id IS NULL THEN
        SET NEW.Id_kelas = 'K-001';
    ELSE
        SET NEW.Id_kelas = CONCAT('K-', LPAD(s_id + 1, 3, '0'));
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `kd_mapel` varchar(5) NOT NULL,
  `nm_mapel` varchar(35) NOT NULL,
  `kkm` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nm_mapel`, `kkm`) VALUES
('M-001', 'Buku Hitam Prabowo', 76),
('M-002', 'Agama', 75),
('M-003', 'Buku Hitam Prabowo Bab 2', 90),
('M-004', 'Sejarah Hiroshima', 90);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `Nis` varchar(10) NOT NULL,
  `Nm_siswa` varchar(50) NOT NULL,
  `Jenkel` varchar(10) NOT NULL,
  `Hp` varchar(13) NOT NULL,
  `Id_Kelas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`Nis`, `Nm_siswa`, `Jenkel`, `Hp`, `Id_Kelas`) VALUES
('2511500050', 'Renn', 'Perempuan', '999999999999', 2),
('2511500056', 'Arkan', 'Laki-laki', '8888888888', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `Username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `Username`, `Password`, `role`, `session_id`) VALUES
(1, 'Arkan Ramadhan', 'Arkan', 'admin', NULL),
(2, 'Renn', 'Renn1', 'guru', NULL),
(3, 'Malik', 'Malik1', 'siswa', NULL),
(4, 'Ren99', 'Renn12', 'guru', NULL),
(5, '2511500056', 'arkan', 'siswa', NULL),
(6, 'Renn1', '1234', 'guru', NULL),
(7, '2511500050', '1234', 'siswa', NULL),
(8, '2511500056', '1234', 'siswa', NULL),
(9, '2511500056', '1234', 'siswa', NULL),
(10, '2511500050', '1234', 'siswa', NULL),
(11, '2511500056', '1234', 'siswa', NULL),
(12, '2511500056', '1234', 'siswa', NULL),
(13, 'Renn1', '1234', 'guru', NULL),
(14, 'Ren12', '1234', 'guru', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `ekstra_056`
--
ALTER TABLE `ekstra_056`
  ADD PRIMARY KEY (`id_ekstra056`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`Kd_guru`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`Id_kelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`Nis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
