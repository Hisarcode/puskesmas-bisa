-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2020 pada 07.10
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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nip` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `nip`) VALUES
(1, 6, '123456789012341');

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `no_antrian` varchar(128) NOT NULL,
  `tanggal` varchar(128) NOT NULL,
  `status` int(1) NOT NULL,
  `jam` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id`, `dokter_id`, `pasien_id`, `no_antrian`, `tanggal`, `status`, `jam`) VALUES
(1, 1, 4, '1', '19/06/2020', 0, '09.00'),
(2, 1, 5, '2', '19/06/2020', 0, '09.30'),
(3, 1, 1, '3', '19/06/2020', 0, '10.00'),
(4, 1, 2, '4', '19/06/2020', 0, '10.30'),
(5, 1, 2, '5', '19/06/2020', 0, '11.00'),
(6, 2, 2, '1', '19/06/2020', 0, '09.00');

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

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `user_id`, `nama_gelar`, `jenis_dokter`) VALUES
(1, 7, 'dr. Hisarman Saragih , M.Kes', 'Dokter Umum'),
(2, 13, 'drg. Dian Khairiyah , M.Kes', 'Dokter Gigi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(128) NOT NULL,
  `jenis_obat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `jenis_obat`) VALUES
(1, 'Paracetamol', 'Obat Demam'),
(2, 'Mixagrip', 'Obat Sakit Kepala'),
(3, 'Amfetamin', 'Vitamin'),
(4, 'Antangin', 'Obat Masuk Angin'),
(5, 'Bodrex', 'Obat Flu'),
(6, 'Promaag', 'Obat Maag'),
(7, 'Paramex', 'Obat Sakit Kepala'),
(8, 'Fatigon', 'Obat'),
(9, 'Antimo', 'Obat Masuk Angin'),
(10, 'Balsem', 'Obat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pekerjaan` varchar(128) NOT NULL,
  `gol_darah` varchar(4) NOT NULL,
  `rekam_medik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `user_id`, `pekerjaan`, `gol_darah`, `rekam_medik_id`) VALUES
(2, 8, 'Petani', 'O', 1),
(3, 9, 'Mahasiswa', 'B', 2),
(4, 10, 'Mahasiswa', 'AB', 3),
(5, 11, 'Swasta', 'A', 4),
(6, 12, 'Swasta', 'O', 5),
(7, 15, 'Mahasiswa', 'A', 6),
(8, 16, 'Dosen', 'AB', 7),
(9, 17, 'Polisi', 'B', 8),
(10, 18, 'Tentara', 'O', 9),
(11, 19, 'Mahasiswa', 'AB', 10),
(12, 20, 'Pegawai', 'A', 11),
(13, 21, 'Satpam', 'B', 12),
(14, 22, 'Buruh', 'AB', 13),
(15, 23, 'Petani', 'O', 14),
(16, 24, 'Peternak', 'B', 15);

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

--
-- Dumping data untuk tabel `rekam_medik`
--

INSERT INTO `rekam_medik` (`id`, `pasien_id`, `dokter_id`, `no_rekam_medik`, `date_created`, `jenis_penyakit`, `keterangan`) VALUES
(1, 8, 7, '001/PB/I/2020', '2020-05-17', 'Kanker', 'Rambut Tidak Tumbuh'),
(2, 9, 7, '002/PB/I/2020', '2020-06-18', 'Anemia', 'Susah Tidur'),
(3, 10, 7, '003/PB/I/2020', '2020-01-01', 'DBD', 'Demam'),
(4, 11, 13, '002/PB/I/2020', '2020-02-02', 'Cacar', 'Muncul Cacar'),
(5, 12, 13, '005/PB/I/2020', '2020-03-03', 'Diare', 'Buang Air Besar'),
(6, 15, 13, '006/PB/I/2020', '2020-06-05', 'Kencing Manis', 'Kencing'),
(7, 16, 7, '007/PB/I/2020', '2018-05-12', 'Asam Lambung', 'Lambung'),
(8, 17, 13, '008/PB/I/2020', '2019-11-23', 'Asam Urat', 'Urat'),
(9, 18, 13, '009/PB/I/2020', '2020-11-12', 'Insomnia', 'Sakit'),
(10, 19, 7, '010/PB/I/2020', '2020-08-11', 'Virus Corona', 'Sesak Nafas');

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
  `date_expired` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `catatan_dokter` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id`, `dokter_id`, `aturan`, `obat_id`, `pasien_id`, `date_created`, `date_expired`, `is_active`, `catatan_dokter`) VALUES
(1, 1, '3 Kali Sehari', 1, 2, '2020-05-17', '2020-05-18', 1, 'Diminum sehabis makan'),
(2, 1, '2 Kali Sehari', 2, 3, '2020-06-18', '2020-06-19', 1, 'Diminum setelah satu jam makan'),
(3, 1, '2 Kali Sehari', 3, 4, '2020-01-01', '2020-01-02', 1, 'Diminum setelah satu jam makan'),
(4, 2, '3 Kali Sehari', 4, 5, '2020-02-02', '2020-02-03', 1, 'Diminum Sebelum Makan'),
(5, 2, '1 Kali Sehari', 5, 6, '2020-03-03', '2020-03-04', 1, 'Diminum Setelah Makan'),
(6, 2, '2 Kali Sehari', 6, 7, '2020-06-05', '2020-06-06', 1, 'Diminum Sebelum Tidur'),
(7, 1, '3 Kali Seminggu', 7, 8, '2018-05-12', '2018-05-13', 1, 'Diminum Sesudah Tidur'),
(8, 2, '1 Kali Sehari', 8, 9, '2019-11-23', '2019-11-24', 1, 'Diminum Sebelum Makan'),
(9, 2, '3 Kali Sehari', 9, 10, '2020-11-12', '2020-11-13', 1, 'Diminum Setelah Dua Jam Makan'),
(10, 1, '2 Kali Sehari', 10, 11, '2020-08-11', '2020-08-12', 1, 'Diminum Sebelum Makan');

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
  `date_expired` varchar(128) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_rujukan`
--

INSERT INTO `surat_rujukan` (`id`, `user_id`, `nomor_surat`, `dokter_id`, `tujuan`, `date_created`, `date_expired`, `keterangan`, `is_active`) VALUES
(1, 2, '001/PB/V/2020', 1, 'Rumah Sakit Soedarso', '2020-05-17', '2021-05-17', 'Memerlukan Perawatan Lebih Lanjut', 1),
(2, 3, '002/PB/V/2020', 1, 'Rumah Sakit Soedarso', '2020-06-18 ', '2021-06-18', 'Pasien Perlu untuk Tidur', 1),
(3, 4, '003/PB/V/2020', 1, 'Rumah Sakit Soedarso', '2020-01-01', '2020-02-01', 'Pasien Perlu Istirahat Yang Cukup', 1),
(4, 5, '004/PB/V/2020', 2, 'Lab Cacar Indonesia', '2020-02-02', '2020-03-02', 'Perawatan Cacar Diperlukan Untuk Pasien', 1),
(5, 6, '005/PB/VI/2020', 2, 'Rumah Sakit Antonius', '2020-03-03', '2020-04-03', 'Pasien Dilarang Makan Cabe', 1),
(6, 7, '006/PB/VI/2020', 2, 'Rumah Sakit Soedarso', '2020-06-05', '2020-07-05', 'Jangan Minum yang Manis-Manis', 1),
(7, 8, '007/PB/VI/2020', 1, 'Rumah Sakit Soedarso', '2018-05-12', '2018-06-12', 'Pasien Dilarang Memakan Makanan Berlemak', 1),
(8, 9, '008/PB/VI/2020', 2, 'Rumah Sakit Soedarso', '2019-11-23', '2019-12-23', 'Pasien Sudah Tua', 1),
(9, 10, '009/PB/VI/2020', 2, 'Rumah Sakit Antonius', '2020-11-12', '2020-12-12', 'Insomnia', 1),
(10, 11, '010/PB/VI/2020', 1, 'Rumah Sakit Teuku Umar', '2020-08-11', '2020-09-11', 'Sesak Nafas', 1),
(13, 11, '011/PB/VI/2020', 1, 'Rumah Sakit Soedarso', '2020-06-18 ', '2020-07-18', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `nomor_telepon` varchar(128) NOT NULL,
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

INSERT INTO `user` (`id`, `nama`, `email`, `nomor_telepon`, `image`, `username`, `password`, `nik`, `tanggallahir`, `alamat`, `role_id`, `is_active`, `date_created`) VALUES
(6, 'Gusti Muhammad Furkan Azmi', 'gusti@gmail.com', '085599004422', 'default.jpg', 'kopibos', '$2y$10$brWz5N5q2ASCOeiZE6T2XO61My3TxfXdXnbTWM/3CKnOesqLIXOe.', '123456789012341', '04/28/1999', 'Jalan Parit Haji Husein', 1, 1, 1588144092),
(7, 'Hisarman Saragih', 'hisarcode@gmail.com', '083913405945', 'default.jpg', 'Hisaragih22', '$2y$10$65QWBgjHb79DlFdBf9zfIO2nEvDrO2.0y3HeSUzvxUNR0ynrb7I7W', '6104173008990003', '08/30/1990', 'Jalan Pak Tani', 2, 1, 1588156436),
(8, 'Juan Martin Indrajaya Limas', 'martinjuan09@student.untan.ac.id', '082495035651', 'default.jpg', 'juanmli', '$2y$10$KxHQIqwLAEQEri44JT0gIuAjhCiUsVsvWTzyRbiWfHGRKjcHJu1RG', '123456789012345', '03/03/1999', 'Jalan Gading Garden', 3, 1, 1588280489),
(9, 'Nadya Lestari', 'nadya@gmail.com', '083494032343', 'default.jpg', 'nadyalestari', '$2y$10$w6ZDnbVmKYFz8QzF0dfVAuPrQopwrzxuZ7PHv/.aAIeHzZlUwu1zu', '123456789012349', '06/17/1998', 'Jalan Teuku Umar', 3, 1, 1588280565),
(10, 'Nur Fajriyani', 'nurfajriyani16@student.untan.ac.id', '083343432342', 'default.jpg', 'nurfajriyani16', '$2y$10$HN2eAE9CvLuN5JyCCGrM1ek81mDrmt8AjCsjuh8DuNclJp/0zEuJy', '123456789012322', '06/16/1999', 'Jalan Sekadau', 3, 1, 1588280887),
(11, 'Dinanda De Paguita', 'dinandadepaguita@gmail.com', '085529309849', 'default.jpg', 'dinandadp', '$2y$10$Iy3fo7J3PFg/rvLJNd3V2us2oHM9i53JWL2lFJV7OAjUQclpGssi6', '1234567890123455', '04/10/2020', 'Desa Kapur', 3, 1, 1588298267),
(12, 'Mario', 'hisarce@gmail.com', '082747838022', 'default.jpg', 'mariokr', '$2y$10$1Bzi3iBoUv95/MPzqjTbz.LTAm0yoD.qq9aRCPRUQbkEZudtOIs1K', '123456789012367', '05/03/2001', 'Jalan Apel', 3, 1, 1588302706),
(13, 'Dian Khairiyah', 'diaen@gmail.com', '089312345678', 'default.jpg', 'diankhry', '$2y$10$lrRW.tGyZnKBQjO91S66EeyqNoKoslqZ/kewBX4uNLrkzdOSeoqh6', '6104173008990078', '04/24/1990', 'Jalan Pak Gunung Sahara', 2, 1, 1588156436),
(15, 'Mario Kristen', 'masrsbebox@gmail.com', '083762728364', 'default.jpg', 'mario', '$2y$10$NgpUscO2vXlNcq0J7qZUI.rohmWJmSWoopreFfa3I0HB0szK70tSy', '61711236578', '18/05/1980', 'Jalan Kesehatan', 3, 1, 1592493479),
(16, 'Faris Ruswandi', 'farisruswandi@gmail.com', '084626384933', 'default.jpg', 'faris', '$2y$10$jCDEpSbhdHMDbWPm1oloA.W48gb7DORCyPCFRO8FHRWFkYn1GAJU6', '748932801828', '06/09/1999', 'Komplek Pilar Emas', 3, 1, 1592497952),
(17, 'Alda Dwi Melinda', 'alda@gmail.com', '083637647367', 'default.jpg', 'alda', '$2y$10$SpzLTE3yBTua0VJcVCnsPO.KbUjjcTkDofEwoO.JP/EJN1OJri2YS', '2247799200288', '12/13/1990', 'Jalan Veteran', 3, 1, 1592498206),
(18, 'Ainayyah Pratiwi', 'ainayyah@gmail.com', '081273648374', 'default.jpg', 'ai', '$2y$10$SYbERlc/kaWMQCv4M74s/eVHLEJq/XeoOAPwG0EGLQ2lCafiiGUkW', '434359504694583', '07/11/1996', 'Jalan Jawa', 3, 1, 1592498273),
(19, 'Mutiara Fitri Ramadhanty', 'mutiara@gmail.com', '083637262384', 'default.jpg', 'muti', '$2y$10$4fwTj98XLXbYYGlOHwzMCeta1N8b0ytMGzkOTovO.uV9HJzER/uL6', '242466334242677', '03/03/1998', 'Jalan Sungai Raya Dalam', 3, 1, 1592498418),
(20, 'Gientry Rachma Ditami', 'gientry@gmail.com', '082489523948', 'default.jpg', 'dita', '$2y$10$iBmTj8/goRihHWtOfCoybetZkrdZMK5OR6yE1533TtN5E6IHG2dVC', '124244546768787', '03/03/1999', 'Jalan Perdana', 3, 1, 1592498999),
(21, 'Firja Febrian Praditya', 'firja@gmail.com', '083495838495', 'default.jpg', 'balpir', '$2y$10$Q7NUFn5ldAD6xmYU0IWpqu26d3mR6tFkmMyq395IzpI2//2xs2DN.', '29284758993059', '02/29/2000', 'Jalan Sepakat 2', 3, 1, 1592499117),
(22, 'Raihan Ramadhan', 'raihan@gmail.com', '081384756472', 'default.jpg', 'om', '$2y$10$tBCRLkxZRnunLy2ARmcoMuREmaPi7Hjg5IBsOqknnaLURON4uIFMC', '26485972639744', '05/03/2000', 'Jalan Rasio', 3, 1, 1592499232),
(23, 'Rachman Dwi Putra', 'rachman@gmail.com', '088593837293', 'default.jpg', 'maman', '$2y$10$VqDOC09irNyioolbZujEJOkyuQWZ6cJf9/NEsfPuNwvLqj8GJSXZe', '239685638392724', '06/17/1999', 'Jalan Sungai Jawi', 3, 1, 1592499307),
(24, 'Muhammad Lutfi', 'lutfi@gmail.com', '082738481923', 'default.jpg', 'lutfi', '$2y$10$AChePGhuKazDYgtteR/Hxeyvzoaw.NAe6q6B4drmIFLLZOcZD937y', '24567323424646', '10/25/1999', 'Jalan Ayani', 3, 1, 1592499436);

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
(8, 3, 4),
(9, 1, 6);

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
(10, 4, 'Dashboard', 'pasien', 'fas fa-fw fa-user', 1),
(11, 4, 'Antrian', 'pasien/antrian', 'fas fa-fw fa-clipboard-list', 1),
(12, 4, 'Rekam Medik', 'pasien/rekammedik', 'fas fa-fw fa-file-medical', 1),
(13, 4, 'Resep', 'pasien/resep', 'fas fa-fw fa-pills', 1),
(14, 4, 'Surat Rujukan', 'pasien/suratrujukan', 'fas fa-fw fa-hospital', 1),
(15, 4, 'Ubah Password', 'auth/ubahpassword', 'fas fa-fw fa-key', 1),
(16, 2, 'Data Pasien', 'dokter/datapasien', 'fas fa-fw fa-address-card', 1),
(17, 2, 'Rekam Medik Pasien', 'dokter/rekammedikpasien', 'fas fa-fw fa-file-medical', 1),
(18, 2, 'Tambah Resep', 'dokter/tambahresep', 'fas fa-fw fa-calendar-plus', 1),
(19, 2, 'Ubah Password', 'auth/ubahpassword', 'fas fa-fw fa-key', 1),
(20, 1, 'Manajemen User', 'admin/manajemenuser', 'fas fa-fw fa-user-cog', 1),
(22, 1, 'Rekam Medik', 'admin/rekammedik', 'fas fa-fw fa-file-medical', 1),
(23, 1, 'Ubah Password', 'auth/ubahpassword', 'fas fa-fw fa-key', 1),
(24, 1, 'Konfigurasi', 'admin/konfigurasi', 'fas fa-fw fa-tools', 1),
(29, 1, 'Surat Rujukan', 'suratrujukan', 'fas fa-fw fa-hospital', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `rekam_medik`
--
ALTER TABLE `rekam_medik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `surat_rujukan`
--
ALTER TABLE `surat_rujukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
