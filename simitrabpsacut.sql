-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2022 pada 05.56
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simitrabpsacut`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `Kode_petugas` int(10) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(50) NOT NULL,
  `Old_password` varchar(50) DEFAULT NULL,
  `Last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `Created_at` datetime NOT NULL,
  `Updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`Kode_petugas`, `Username`, `Email`, `Password`, `Old_password`, `Last_login`, `Created_at`, `Updated_at`) VALUES
(1, 'ila', 'rahmaini@gmail.com', 'aafe26449a364e5d6b5db7dc565a9b6a', 'aafe26449a364e5d6b5db7dc565a9b6a', '2022-08-30 08:11:36', '2022-07-08 07:55:50', '2022-08-25 05:05:28'),
(23, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '2022-11-01 10:22:26', '2022-07-19 07:41:01', '2022-08-23 13:58:11'),
(61, 'firza', 'firza@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-11-01 10:12:48', '2022-08-30 09:07:31', '2022-08-30 09:09:51'),
(63, 'rizka', 'rizka@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:48:33', '2022-08-30 09:19:44', '2022-08-30 09:22:38'),
(64, 'mala', 'mala@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:49:00', '2022-08-30 09:27:43', '2022-08-30 09:29:52'),
(65, 'nisa', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:34:13', '2022-08-30 09:32:55', NULL),
(66, 'wanda', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:35:40', '2022-08-30 09:34:28', NULL),
(67, 'yuma', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:36:54', '2022-08-30 09:35:55', NULL),
(68, 'indah', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:42:23', '2022-08-30 09:39:09', NULL),
(69, 'karisma', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:44:40', '2022-08-30 09:43:37', NULL),
(70, 'angga', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-10-31 10:22:48', '2022-10-31 10:08:58', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `Id_jabatan` int(11) NOT NULL,
  `Jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`Id_jabatan`, `Jabatan`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
--

CREATE TABLE `lowongan` (
  `id` int(11) NOT NULL,
  `jenis_lowongan` varchar(200) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `persyaratan` text NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`id`, `jenis_lowongan`, `tanggal_mulai`, `tanggal_akhir`, `persyaratan`, `deskripsi`, `gambar`, `deleted`) VALUES
(1, 'Survei E-Commerce 2022', '2022-08-20', '2022-08-31', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei E-Commerce 2022', 'Survei E-Commerce 2022 bertugas di lapangan', '4.png', 0),
(2, 'Long Form SP2020', '2022-08-20', '2022-08-31', 'Mampu berkomunikasi dengan masyarakat di wilayah tugasnya.', 'Pengolahan (C2 dan V - Editing Coding)', '13.png', 0),
(3, 'Long Form SP2020 2', '2022-08-20', '2022-08-31', 'Mampu berkomunikasi dengan masyarakat di wilayah tugasnya.', 'Pengolahan (C2 dan V - Entri)', '5.png', 0),
(4, 'Sensus Pertanian 2023', '2022-08-20', '2022-08-31', '1. Berpendidikan minimal tamat SMA/sederajat.\r\n2. Diutamakan berumur 18 s.d. 45 tahun.\r\n3. Bersedia bekerja terikat kontrak.\r\n4. Sehat jasmani dan rohani.\r\n5. Disiplin dan berkomitmen.\r\n6. Mampu berbahasa Indonesia dengan baik.\r\n7. Mampu bekerja dalam tim.\r\n8. Mampu berkomunikasi dengan masyarakat di wilayah tugasnya.\r\n9. Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei E-Commerce 2022', 'Gladi Bersih 2 Sensus Pertanian 2023', '27.png', 1),
(8, 'SUSENAS', '2022-08-30', '2022-09-29', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan SUSENAS', 'Survei data kondisi sosial ekonomi masyarakat.', '30-08-2022 08-47-45143.png', 0),
(9, 'PODES', '2022-08-30', '2022-10-13', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei PODES.', 'Pendataan potensi desa berbasis kewilayahan', '30-08-2022 08-52-50108.png', 0),
(10, 'SKGB', '2022-09-01', '2022-09-30', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei SKGB', 'Survei pertanian yang menghitung data produksi pangan dalam bentuk beras.', '30-08-2022 08-55-0662.png', 0),
(11, 'Survei Penyusunan Disagregasi PMTB', '2022-09-07', '2022-09-28', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei Penyusunan Disagregasi PMTB.', 'Survei untuk memperoleh gambaran PMTB dan meningkatkan kualitas data necara nasional terkait investasi fisik.', '30-08-2022 08-59-1672.png', 0),
(13, 'SUSENAS 2', '2022-11-10', '2022-11-29', 'bersedia bekerja di lapangan', 'Survei data kondisi sosial', '31-10-2022 10-05-544.png', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `Kode_petugas` int(12) NOT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `Nama` varchar(50) NOT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Jabatan` int(5) NOT NULL,
  `Tempat_lahir` varchar(150) DEFAULT NULL,
  `Tanggal_lahir` date DEFAULT NULL,
  `Alamat` varchar(150) DEFAULT NULL,
  `NoHP` varchar(15) DEFAULT NULL,
  `Jkel` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`Kode_petugas`, `NIK`, `Nama`, `Foto`, `Jabatan`, `Tempat_lahir`, `Tanggal_lahir`, `Alamat`, `NoHP`, `Jkel`) VALUES
(1, '1108080503010003', 'Rahmaini', '2022-08-20 14-39-053.jpg', 2, '', '2001-07-04', 'Jalan Pemuda No.34, Banda Sakti, Kampung Kramat', '081364011325', 'P'),
(23, '1233213214', 'Admin', '2022-08-20 16-07-37admin.png', 1, 'Aceh Utara', '2000-07-27', 'Indonesia', '081144667755', 'L'),
(61, '1110203040500', 'Firza Rahmatul Ula', '2022-08-30 09-09-511.jpg', 2, 'Lhoksukon', '2001-07-04', 'Lhoksukon', '086090809012', 'L'),
(63, '1110203040501', 'Rizka Rahmadini Salim', '2022-08-30 09-22-384.jpg', 2, 'Rantauprapat', '2001-09-01', 'Lhokseumawe', '089510469913', 'L'),
(64, '1110203040502', 'Nurmala Hayati', '2022-08-30 09-29-526.jpg', 2, 'Cot Laba', '1999-09-09', 'Sampoiniet', '089510469919', 'L'),
(65, NULL, 'nisa', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(66, NULL, 'wanda', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(67, NULL, 'yuma', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(68, NULL, 'indah', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(69, NULL, 'karisma', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(70, NULL, 'angga', NULL, 2, NULL, NULL, NULL, NULL, 'L');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kecamatan`
--

CREATE TABLE `tb_kecamatan` (
  `id` int(11) NOT NULL,
  `nama_kec` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kecamatan`
--

INSERT INTO `tb_kecamatan` (`id`, `nama_kec`) VALUES
(1111010, 'Sawang'),
(1111020, 'Nisam'),
(1111021, 'Nisam Antara'),
(1111022, 'Banda Baro'),
(1111030, 'Kuta Makmur'),
(1111031, 'Simpang Keramat'),
(1111040, 'Syamtalira Bayu'),
(1111041, 'Geureudong Pase'),
(1111050, 'Meurah Mulia'),
(1111060, 'Matangkuli'),
(1111061, 'Paya Bakong'),
(1111062, 'Pirak Timu'),
(1111070, 'Cot Girek'),
(1111080, 'Tanah Jambo Aye'),
(1111081, 'Langkahan'),
(1111090, 'Seunuddon'),
(1111100, 'Baktiya'),
(1111101, 'Baktiya Barat'),
(1111110, 'Lhoksukon'),
(1111120, 'Tanah Luas'),
(1111121, 'Nibong'),
(1111130, 'Samudera'),
(1111140, 'Syamtalira Aron'),
(1111150, 'Tanah Pasir'),
(1111151, 'Lapang'),
(1111160, 'Muara Batu'),
(1111170, 'Dewantara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lowongan_user`
--

CREATE TABLE `tb_lowongan_user` (
  `id` int(11) NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `id_petugas` int(12) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `id_kec` int(11) NOT NULL,
  `L_action` enum('LULUS','TIDAK LULUS') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_lowongan_user`
--

INSERT INTO `tb_lowongan_user` (`id`, `id_lowongan`, `id_petugas`, `tanggal_daftar`, `id_kec`, `L_action`) VALUES
(21, 9, 63, '2022-08-30 09:23:11', 1111010, 'TIDAK LULUS'),
(22, 3, 63, '2022-08-30 09:23:26', 1111010, 'TIDAK LULUS'),
(24, 11, 63, '2022-08-30 09:25:20', 1111010, 'TIDAK LULUS'),
(28, 2, 64, '2022-08-30 09:30:24', 1111101, 'TIDAK LULUS'),
(29, 1, 64, '2022-08-30 09:31:56', 1111101, 'TIDAK LULUS'),
(30, 10, 64, '2022-08-30 09:32:13', 1111101, 'TIDAK LULUS'),
(31, 4, 65, '2022-08-30 09:33:15', 1111021, 'TIDAK LULUS'),
(32, 9, 65, '2022-08-30 09:33:28', 1111061, 'LULUS'),
(33, 10, 65, '2022-08-30 09:33:37', 1111080, 'TIDAK LULUS'),
(34, 11, 66, '2022-08-30 09:34:47', 1111080, 'LULUS'),
(35, 10, 66, '2022-08-30 09:35:00', 1111040, 'TIDAK LULUS'),
(36, 9, 66, '2022-08-30 09:35:10', 1111041, 'TIDAK LULUS'),
(37, 8, 66, '2022-08-30 09:35:27', 1111160, 'TIDAK LULUS'),
(38, 8, 67, '2022-08-30 09:36:17', 1111090, 'TIDAK LULUS'),
(39, 3, 67, '2022-08-30 09:36:29', 1111022, 'LULUS'),
(40, 1, 67, '2022-08-30 09:36:42', 1111031, 'LULUS'),
(41, 9, 68, '2022-08-30 09:39:51', 1111021, 'TIDAK LULUS'),
(42, 1, 68, '2022-08-30 09:41:40', 1111100, 'TIDAK LULUS'),
(43, 11, 68, '2022-08-30 09:41:58', 1111160, 'TIDAK LULUS'),
(44, 8, 68, '2022-08-30 09:42:10', 1111070, 'TIDAK LULUS'),
(45, 9, 69, '2022-08-30 09:43:56', 1111062, 'TIDAK LULUS'),
(46, 1, 69, '2022-08-30 09:44:04', 1111041, 'TIDAK LULUS'),
(47, 10, 69, '2022-08-30 09:44:17', 1111050, 'TIDAK LULUS'),
(48, 3, 69, '2022-08-30 09:44:32', 1111031, 'LULUS'),
(52, 1, 63, '2022-08-30 09:48:21', 1111010, 'TIDAK LULUS'),
(53, 9, 64, '2022-08-30 09:48:51', 1111101, 'TIDAK LULUS'),
(55, 1, 70, '2022-10-31 10:09:22', 1111061, 'LULUS'),
(59, 1, 61, '2022-11-01 10:12:21', 1111022, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`Kode_petugas`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`Id_jabatan`);

--
-- Indeks untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`Kode_petugas`),
  ADD KEY `Jabatan` (`Jabatan`);

--
-- Indeks untuk tabel `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kec_hub` (`id_kec`),
  ADD KEY `lowongan_hub` (`id_lowongan`),
  ADD KEY `petugas_hub` (`id_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `Kode_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `Id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `Auth` FOREIGN KEY (`Kode_petugas`) REFERENCES `auth` (`Kode_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Jabatan` FOREIGN KEY (`Jabatan`) REFERENCES `jabatan` (`Id_jabatan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  ADD CONSTRAINT `kec_hub` FOREIGN KEY (`id_kec`) REFERENCES `tb_kecamatan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lowongan_hub` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_hub` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`Kode_petugas`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
