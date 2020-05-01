-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Bulan Mei 2020 pada 04.02
-- Versi server: 10.1.39-MariaDB
-- Versi PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskesmas_bisa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `tanggal` varchar(128) NOT NULL,
  `status` int(1) NOT NULL,
  `jam` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_gelar` varchar(128) NOT NULL,
  `jenis_dokter` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(128) NOT NULL,
  `produsen` varchar(128) NOT NULL,
  `jenis` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pekerjaan` varchar(128) NOT NULL,
  `rekam_medik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medik`
--

CREATE TABLE `rekam_medik` (
  `id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `no_rekam_medik` varchar(128) NOT NULL,
  `date_created` varchar(128) NOT NULL,
  `jenis_penyakit` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `aturan` varchar(128) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `date_created` varchar(128) NOT NULL,
  `catatan_dokter` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_rujukan`
--

CREATE TABLE `surat_rujukan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nomor_surat` varchar(128) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `tujuan` varchar(128) NOT NULL,
  `date_created` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nik` varchar(128) NOT NULL,
  `tanggallahir` varchar(128) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `username`, `password`, `nik`, `tanggallahir`, `alamat`, `role_id`, `is_active`, `date_created`) VALUES
(6, 'Gusti Muhammad Furkan Azmi', 'gusti@gmail.com', 'default.jpg', 'kopibos', '$2y$10$c69ZqGpI2JOEWsrgj3.fCuTw/S0ZjbRKVY9SYkS2JSJDCEXYQDLQm', '123456789012341', '04/28/1999', 'Jalan Parit Haji Husein', 1, 1, 1588144092),
(7, 'Hisarman Saragih', 'hisarcode@gmail.com', 'default.jpg', 'Hisaragih22', '$2y$10$d4eRy3jnL5KJ1EsqpFlnsOybQSqcVXoYkMZATgoGcunwPtXG/Oz6q', '6104173008990003', '', 'Jalan Pak Tani', 2, 1, 1588156436),
(8, 'Juan Martin Indrajaya Limas', 'martinjuan09@student.untan.ac.id', 'default.jpg', 'juanmli', '$2y$10$HN2eAE9CvLuN5JyCCGrM1ek81mDrmt8AjCsjuh8DuNclJp/0zEuJy', '123456789012345', '03/03/1999', 'Jalan Gading Garden', 3, 1, 1588280489),
(9, 'Nadya Lestari', 'nadya@gmail.com', 'default.jpg', 'nadyalestari', '$2y$10$w6ZDnbVmKYFz8QzF0dfVAuPrQopwrzxuZ7PHv/.aAIeHzZlUwu1zu', '123456789012349', '', 'Jalan Teuku Umar', 3, 1, 1588280565),
(10, 'Nur Fajriyani', 'nurfajriyani16@student.untan.ac.id', 'default.jpg', 'nurfajriyani16', '$2y$10$HN2eAE9CvLuN5JyCCGrM1ek81mDrmt8AjCsjuh8DuNclJp/0zEuJy', '123456789012322', '06/16/1999', 'Jalan Sekadau', 3, 1, 1588280887),
(11, 'Dinanda De Paguita', 'dinandadepaguita@gmail.com', 'default.jpg', 'dinandadp', '$2y$10$Iy3fo7J3PFg/rvLJNd3V2us2oHM9i53JWL2lFJV7OAjUQclpGssi6', '1234567890123455', '04/10/2020', 'Desa Kapur', 3, 1, 1588298267);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(4, 1, 3),
(8, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Dokter'),
(3, 'Menu'),
(4, 'Pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Dokter'),
(3, 'Pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-user', 1),
(2, 2, 'Dashboard', 'dokter', 'fas fa-fw fa-user', 1),
(4, 3, 'Manajemen Menu', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Manajemen Submenu', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(9, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 0),
(10, 4, 'Dashboard', 'pasien', 'fas fa-fw fa-user', 1),
(11, 4, 'Antrian', 'pasien/antrian', 'fas fa-fw fa-clipboard-list', 1),
(12, 4, 'Rekam Medik', 'pasien/rekammedik', 'fas fa-fw fa-file-medical', 1),
(13, 4, 'Resep', 'pasien/resep', 'fas fa-fw fa-pills', 1),
(14, 4, 'Surat Rujukan', 'pasien/suratrujukan', 'fas fa-fw fa-hospital', 1),
(15, 4, 'Ubah Password', 'pasien/ubahpassword', 'fas fa-fw fa-key', 1),
(16, 2, 'Data Pasien', 'dokter/datapasien', 'fas fa-fw fa-address-card', 1),
(17, 2, 'Rekam Medik Pasien', 'dokter/rekammedikpasien', 'fas fa-fw fa-file-medical', 1),
(18, 2, 'Tambah Resep', 'dokter/tambahresep', 'fas fa-fw fa-calendar-plus', 1),
(19, 2, 'Ubah Password', 'dokter/ubahpassword', 'fas fa-fw fa-key', 1),
(20, 1, 'Manajemen User', 'admin/manajemenuser', 'fas fa-fw fa-user-cog', 1),
(21, 1, 'Surat Rujukan', 'admin/suratrujukan', 'fas fa-fw fa-hospital', 1),
(22, 1, 'Rekam Medik', 'admin/rekammedik', 'fas fa-fw fa-file-medical', 1),
(23, 1, 'Ubah Password', 'admin/ubahpassword', 'fas fa-fw fa-key', 1),
(24, 1, 'Konfigurasi', 'admin/konfigurasi', 'fas fa-fw fa-tools', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekam_medik`
--
ALTER TABLE `rekam_medik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_rujukan`
--
ALTER TABLE `surat_rujukan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekam_medik`
--
ALTER TABLE `rekam_medik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat_rujukan`
--
ALTER TABLE `surat_rujukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
