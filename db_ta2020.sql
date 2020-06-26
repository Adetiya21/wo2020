-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2020 at 03:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ta2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Adetiya', '0', '$2y$10$mCvO3/2I3E/..MiIw/9W0OWql7rhnid7TLVeEQDTRoPV8cboKk0M6');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `nip` varchar(12) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `id_mapel` int(4) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenkel` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Kong Hu Cu') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`nip`, `id_kelas`, `id_mapel`, `nama`, `jenkel`, `agama`, `alamat`, `no_telp`, `password`) VALUES
('3201616021', 101, 1011, 'Adetiya BP', 'Laki-Laki', 'Islam', 'Karet Indah', '089669432192', '$2y$10$Uczd1hI0TnOXU.IRsJ3w6.SAHbPyz/yBEFa0XqI69Phnrwa6.H3d2'),
('3201616022', 101, 1012, 'Putri', 'Perempuan', 'Islam', 'Karet', '089669432192', '$2y$10$Uczd1hI0TnOXU.IRsJ3w6.SAHbPyz/yBEFa0XqI69Phnrwa6.H3d2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(3) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `nama_kelas`) VALUES
(101, 'Kelas 1'),
(102, 'Kelas 2'),
(103, 'Kelas 3'),
(104, 'Kelas 4'),
(105, 'Kelas 5'),
(106, 'Kelas 6');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id` int(4) NOT NULL,
  `nama_mapel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id`, `nama_mapel`) VALUES
(1011, 'Bahasa Indonesia'),
(1012, 'Matematika'),
(1013, 'Bahasa Inggris'),
(1014, 'Pendidikan Agama'),
(1015, 'IPA'),
(1016, 'IPS'),
(1017, 'Penjaskes'),
(1018, 'Seni Budaya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilaisiswa`
--

CREATE TABLE `tb_nilaisiswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(12) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `id_mapel` int(4) DEFAULT NULL,
  `h1` int(3) NOT NULL DEFAULT '0',
  `h2` int(3) NOT NULL DEFAULT '0',
  `h3` int(3) NOT NULL DEFAULT '0',
  `uts` int(3) NOT NULL DEFAULT '0',
  `uas` int(3) NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `rata` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilaisiswa`
--

INSERT INTO `tb_nilaisiswa` (`id`, `nis`, `id_kelas`, `id_mapel`, `h1`, `h2`, `h3`, `uts`, `uas`, `total`, `rata`) VALUES
(1, '195410244', 101, 1011, 100, 100, 100, 95, 98, 493, 98.6),
(2, '195410244', 101, 1012, 90, 80, 85, 80, 90, 425, 85),
(3, '195410244', 101, 1013, 0, 0, 0, 0, 0, 0, 0),
(4, '195410244', 101, 1014, 0, 0, 0, 0, 0, 0, 0),
(5, '195410244', 101, 1015, 0, 0, 0, 0, 0, 0, 0),
(6, '195410244', 101, 1016, 0, 0, 0, 0, 0, 0, 0),
(7, '195410244', 101, 1017, 0, 0, 0, 0, 0, 0, 0),
(8, '195410244', 101, 1018, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` varchar(12) NOT NULL,
  `id_kelas` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tmp_lahir` varchar(20) NOT NULL,
  `jenkel` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Kong Hu Cu') NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `id_kelas`, `nama`, `tgl_lahir`, `tmp_lahir`, `jenkel`, `agama`, `alamat`, `password`) VALUES
('0', 102, '0', '2020-06-20', '0', 'Laki-Laki', 'Kristen', '0', '$2y$10$zDuWIqO3dPMg5Zri4qJhfuvKgpCLC1w9rEi7ijPt3t4L9MSHIsqmW'),
('195410244', 101, 'ADETIYA BURHASAN PUTRA', '2020-06-23', 'Pontianak', 'Laki-Laki', 'Islam', 'Jalan', '$2y$10$hbIgRgeOg13p40FGVYmNWOcU7fAS6SsvLhBpl8yGSdKEV1.dbQL1W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilaisiswa`
--
ALTER TABLE `tb_nilaisiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_mapel` (`id_mapel`) USING BTREE,
  ADD KEY `id_kelas` (`id_kelas`) USING BTREE;

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tb_nilaisiswa`
--
ALTER TABLE `tb_nilaisiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD CONSTRAINT `tb_guru_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`),
  ADD CONSTRAINT `tb_guru_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id`);

--
-- Constraints for table `tb_nilaisiswa`
--
ALTER TABLE `tb_nilaisiswa`
  ADD CONSTRAINT `tb_nilaisiswa_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_nilaisiswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`),
  ADD CONSTRAINT `tb_nilaisiswa_ibfk_3` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
