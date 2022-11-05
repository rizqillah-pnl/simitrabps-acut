-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Nov 2022 pada 10.28
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

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
  `deleted` int(1) DEFAULT NULL,
  `Created_at` datetime NOT NULL,
  `Updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`Kode_petugas`, `Username`, `Email`, `Password`, `Old_password`, `Last_login`, `deleted`, `Created_at`, `Updated_at`) VALUES
(1, 'ila', 'rahmaini@gmail.com', 'aafe26449a364e5d6b5db7dc565a9b6a', 'aafe26449a364e5d6b5db7dc565a9b6a', '2022-08-30 08:11:36', 0, '2022-07-08 07:55:50', '2022-08-25 05:05:28'),
(23, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '2022-11-05 16:28:20', 0, '2022-07-19 07:41:01', '2022-08-23 13:58:11'),
(61, 'firza', 'firza@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-11-05 15:39:34', 0, '2022-08-30 09:07:31', '2022-08-30 09:09:51'),
(63, 'rizka', 'rizka@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:48:33', 0, '2022-08-30 09:19:44', '2022-08-30 09:22:38'),
(64, 'mala', 'mala@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:49:00', 0, '2022-08-30 09:27:43', '2022-08-30 09:29:52'),
(65, 'nisa', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:34:13', 0, '2022-08-30 09:32:55', NULL),
(66, 'wanda', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:35:40', 0, '2022-08-30 09:34:28', NULL),
(67, 'yuma', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:36:54', 0, '2022-08-30 09:35:55', NULL),
(68, 'indah', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:42:23', 0, '2022-08-30 09:39:09', NULL),
(69, 'karisma', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-08-30 09:44:40', 0, '2022-08-30 09:43:37', NULL),
(70, 'angga', NULL, '202cb962ac59075b964b07152d234b70', NULL, '2022-10-31 10:22:48', 0, '2022-10-31 10:08:58', NULL),
(71, 'tessadas', 'asdasad@sdad.cg', '202cb962ac59075b964b07152d234b70', NULL, '2022-11-01 18:37:35', 0, '2022-11-01 18:35:45', NULL),
(72, 'rizki', 'rizqillah531@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-11-01 19:55:26', 0, '2022-11-01 19:54:40', NULL),
(73, 'tes2', 'rizqillah531@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-11-01 19:58:13', 0, '2022-11-01 19:57:47', NULL),
(74, 'tes', 'rizqillah531@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '2022-11-05 14:10:16', 0, '2022-11-05 14:09:09', NULL);

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
(4, 'Sensus Pertanian 2023', '2022-08-20', '2022-08-31', '1. Berpendidikan minimal tamat SMA/sederajat.\r\n2. Diutamakan berumur 18 s.d. 45 tahun.\r\n3. Bersedia bekerja terikat kontrak.\r\n4. Sehat jasmani dan rohani.\r\n5. Disiplin dan berkomitmen.\r\n6. Mampu berbahasa Indonesia dengan baik.\r\n7. Mampu bekerja dalam tim.\r\n8. Mampu berkomunikasi dengan masyarakat di wilayah tugasnya.\r\n9. Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei E-Commerce 2022', 'Gladi Bersih 2 Sensus Pertanian 2023', '27.png', 0),
(8, 'SUSENAS', '2022-08-30', '2022-09-29', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan SUSENAS', 'Survei data kondisi sosial ekonomi masyarakat.', '30-08-2022 08-47-45143.png', 0),
(9, 'PODES', '2022-08-30', '2022-10-13', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei PODES.', 'Pendataan potensi desa berbasis kewilayahan', '30-08-2022 08-52-50108.png', 0),
(10, 'SKGB', '2022-09-01', '2022-09-30', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei SKGB', 'Survei pertanian yang menghitung data produksi pangan dalam bentuk beras.', '30-08-2022 08-55-0662.png', 0),
(11, 'Survei Penyusunan Disagregasi PMTB', '2022-09-07', '2022-09-28', 'Bersedia mengikuti kegiatan pelatihan petugas pendataan Survei Penyusunan Disagregasi PMTB.', 'Survei untuk memperoleh gambaran PMTB dan meningkatkan kualitas data necara nasional terkait investasi fisik.', '30-08-2022 08-59-1672.png', 0),
(13, 'SUSENAS 2', '2022-11-10', '2022-11-29', 'bersedia bekerja di lapangan', 'Survei data kondisi sosial', '31-10-2022 10-05-544.png', 0),
(14, 'asdasdas', '2022-11-01', '2022-12-03', 'fsdfsd', 'sdfsdfs', '01-11-2022 20-47-51KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', 1),
(15, 'dsadas', '2022-07-06', '2022-11-11', 'adasd', 'asda', '01-11-2022 20-58-16KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', 1),
(16, 'asdasdas', '2022-11-15', '2022-12-09', 'adasd', 'asdasd', '01-11-2022 21-00-16KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', 1);

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
(70, NULL, 'angga', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(71, '12141241', 'adad', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(72, '312312', 'asdasd', NULL, 2, NULL, NULL, NULL, NULL, 'L'),
(73, '13123123', 'sadasd', '1.jpg', 2, NULL, NULL, NULL, NULL, 'L'),
(74, '13213123123', 'dasdasd', '1.jpg', 2, NULL, NULL, NULL, NULL, 'L');

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
  `tanggal_konfirmasi` datetime DEFAULT NULL,
  `id_kec` int(11) NOT NULL,
  `L_action` enum('1','2') DEFAULT NULL,
  `umur` int(2) DEFAULT NULL,
  `cv` varchar(100) DEFAULT NULL,
  `ktp` varchar(100) DEFAULT NULL,
  `ijazah` varchar(100) DEFAULT NULL,
  `suratLamaran` varchar(100) DEFAULT NULL,
  `suratDomisili` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_lowongan_user`
--

INSERT INTO `tb_lowongan_user` (`id`, `id_lowongan`, `id_petugas`, `tanggal_daftar`, `tanggal_konfirmasi`, `id_kec`, `L_action`, `umur`, `cv`, `ktp`, `ijazah`, `suratLamaran`, `suratDomisili`) VALUES
(1, 1, 72, '2022-11-01 19:55:18', '2022-11-05 01:23:30', 1111010, '1', 17, '01-11-2022 19-55-18KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 19-55-18KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 19-55-18KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 19-55-18KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 19-55-18KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(2, 1, 73, '2022-11-01 19:58:08', '2022-11-05 01:23:33', 1111010, '2', 16, '01-11-2022 19-58-08KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 19-58-08KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 19-58-08KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 19-58-08KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 19-58-08KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(3, 1, 61, '2022-11-01 20:54:19', '2022-11-05 01:23:38', 1111010, '1', 15, '01-11-2022 20-54-19KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-19KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-19KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-19KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-19KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(4, 2, 61, '2022-11-01 20:54:37', '2022-11-05 01:23:35', 1111010, '2', 15, '01-11-2022 20-54-37KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-37KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-37KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-37KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-37KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(5, 3, 61, '2022-11-01 20:54:53', '2022-11-05 01:23:40', 1111010, '2', 15, '01-11-2022 20-54-53KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-53KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-53KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-53KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-54-53KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(6, 4, 61, '2022-11-01 20:55:45', '2022-11-05 01:23:27', 1111010, '1', 15, '01-11-2022 20-55-45KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-55-45KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-55-45KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-55-45KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '01-11-2022 20-55-45KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(7, 8, 61, '2022-11-05 13:57:02', NULL, 1111010, NULL, 15, '05-11-2022 13-57-02KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 13-57-02KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 13-57-02KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 13-57-02KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 13-57-02KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(8, 16, 61, '2022-11-05 13:57:28', NULL, 1111010, NULL, 15, '05-11-2022 13-57-28KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 13-57-28KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 13-57-28KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 13-57-28KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 13-57-28KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(9, 1, 74, '2022-11-05 14:09:36', NULL, 1111010, NULL, 15, '05-11-2022 14-09-36KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-09-36KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-09-36KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-09-36KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-09-36KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(10, 2, 74, '2022-11-05 14:09:52', NULL, 1111010, NULL, 15, '05-11-2022 14-09-52KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-09-52KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-09-52KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-09-52KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-09-52KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg'),
(11, 3, 74, '2022-11-05 14:10:11', NULL, 1111010, NULL, 15, '05-11-2022 14-10-11KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-10-11KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-10-11KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-10-11KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg', '05-11-2022 14-10-11KORIGENGI-Shibuya  Fate Grand Order Diamong.jpg');

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
  MODIFY `Kode_petugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `Id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_lowongan_user`
--
ALTER TABLE `tb_lowongan_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
