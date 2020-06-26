-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 26 Jun 2020 pada 23.34
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Adetiya', '0', '$2y$10$X5MFzzPgXRkxQDDPnvKaJOSTTbxbY8CwY8ZtHqgzP6gj0m3meWrjm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar_produk`
--

CREATE TABLE `tb_gambar_produk` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `tgl` datetime NOT NULL,
  `status` enum('Menunggu Pembayaran','Proses','Pembayaran Dikonfirmasi','Dikirim','Selesai','Dibatalkan') NOT NULL,
  `payment` tinytext NOT NULL,
  `total` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_invoice`
--

INSERT INTO `tb_invoice` (`id`, `email`, `invoice`, `tgl`, `status`, `payment`, `total`, `gambar`) VALUES
(1, 'member1@member.com', 'HMP-2706200001', '2020-06-27 04:22:57', 'Menunggu Pembayaran', 'Transfer Bank', 9600000, ''),
(2, 'member1@member.com', 'HMP-2706200002', '2020-06-27 04:24:40', 'Proses', 'Cash on Delivery', 5000000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori_produk`
--

CREATE TABLE `tb_kategori_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori_produk`
--

INSERT INTO `tb_kategori_produk` (`id`, `nama`, `gambar`, `slug`) VALUES
(1, 'HENNA', '7a8965a4cea80fdd09a63b30a99c5b67.jpg', 'henna'),
(2, 'MAKE UP', 'd2dda3a1b8996e6d7ea21bdad1e13b49.jpg', 'make-up'),
(3, 'DEKORASI', '5abb9f4c36f2b490eca1bde025ed1dc0.jpg', 'dekorasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`id`, `nama`, `slug`, `email`, `no_telp`, `alamat`, `password`) VALUES
(1, 'Akun Member 1', 'member-1', 'member1@member.com', '081234567890', 'Jalan Gusti Hamzah No.14', '$2y$10$0sgld.XXXjW7iPIRbIyD0.Vc8HY.eKFvAXRL8QBzo7KWI/ZY8CFbe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_orders`
--

CREATE TABLE `tb_orders` (
  `id` int(11) NOT NULL,
  `code_invoice` varchar(50) NOT NULL,
  `qty` int(3) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` bigint(8) NOT NULL,
  `gambar_produk` varchar(255) NOT NULL,
  `tgl_booking` date NOT NULL,
  `slug` varchar(50) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_orders`
--

INSERT INTO `tb_orders` (`id`, `code_invoice`, `qty`, `nama_produk`, `harga_produk`, `gambar_produk`, `tgl_booking`, `slug`, `nama_vendor`) VALUES
(1, 'HMP-2706200001', 1, 'Makeup Artis', 2000000, 'dfa72e79ec97799147d49bea8f3bd193.jpg', '2020-07-11', 'makeup-artis', 'Vendor 1'),
(2, 'HMP-2706200001', 1, 'Dekorasi Biasa', 7500000, '7fc01ab246c562bdc39d11940add47c8.jpg', '2020-07-11', 'dekorasi-biasa', 'Vendor 3'),
(3, 'HMP-2706200001', 1, 'Henna Sederhana', 100000, 'fe6b5868482deaece9d68f3556a7c742.jpg', '2020-07-11', 'henna-sederhana', 'Vendor 3'),
(4, 'HMP-2706200002', 1, 'Dekorasi Standart', 5000000, 'ed405d3e06401d8311021a2ad3ab4136.jpg', '2020-07-25', 'dekorasi-standart', 'Vendor 1');

--
-- Trigger `tb_orders`
--
DELIMITER $$
CREATE TRIGGER `stok` AFTER INSERT ON `tb_orders` FOR EACH ROW BEGIN
 UPDATE tb_produk SET kuantitas_penjualan=kuantitas_penjualan-NEW.qty
 WHERE slug=NEW.slug;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_vendor` int(11) DEFAULT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `kuantitas_penjualan` int(2) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tgl` date NOT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id`, `id_kategori`, `id_vendor`, `nama`, `harga`, `kuantitas_penjualan`, `deskripsi`, `gambar`, `tgl`, `slug`) VALUES
(1, 1, 1, 'Henna Kualitas 1', 450000, 9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '0c26c61e98da8d77ae63055aba3a545e.jpg', '2020-06-05', 'henna-kualitas-1'),
(2, 3, 1, 'Dekorasi Standart', 5000000, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.				                        ', 'ed405d3e06401d8311021a2ad3ab4136.jpg', '2020-06-27', 'dekorasi-standart'),
(3, 3, 1, 'Dekorasi Mewah', 12000000, -1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '6dca69ea4b3702916602ec97f85cf9e1.jpg', '2020-06-15', 'dekorasi-mewah'),
(4, 1, 3, 'Henna Sederhana', 100000, 9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'fe6b5868482deaece9d68f3556a7c742.jpg', '2020-06-21', 'henna-sederhana'),
(5, 2, 1, 'Makeup Artis', 2000000, 7, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'dfa72e79ec97799147d49bea8f3bd193.jpg', '2020-06-27', 'makeup-artis'),
(6, 3, 3, 'Dekorasi Biasa', 7500000, 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.				                        				                        				                        ', '7fc01ab246c562bdc39d11940add47c8.jpg', '2020-06-27', 'dekorasi-biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ulasan`
--

CREATE TABLE `tb_ulasan` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ulasan` text NOT NULL,
  `rating_1` int(1) NOT NULL,
  `rating_2` int(1) NOT NULL,
  `rating_3` int(1) NOT NULL,
  `rating_4` int(1) NOT NULL,
  `rating_5` int(1) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vendor`
--

CREATE TABLE `tb_vendor` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Menunggu','Diterima') NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_vendor`
--

INSERT INTO `tb_vendor` (`id`, `nama`, `slug`, `email`, `no_telp`, `alamat`, `password`, `status`, `gambar`) VALUES
(1, 'Vendor 1', 'vendor-1', 'vendor1@vendor.com', '081234567890', 'Jalan Ayani 2                        ', '$2y$10$BWzc5mn7Y6fIApqQpHcCROGI/RrQR8oFQnkUdBdd5d0D20Tr3CICG', 'Diterima', '4a2813f55d870685f47e34c6f67c0c76.jpg'),
(2, 'Vendor 2', '', 'vendor2@vendor.com', '080987654321', 'Jalan H.R.A.Rahman                                                ', '$2y$10$.q72Whwk8pf0qBdALGLGtuWcGdHeTqrbpCkIzVC0/yPD/oGxsLUkC', 'Menunggu', 'ba043cab9d91f5af0bac9cfa125eea80.jpg'),
(3, 'Vendor 3', 'vendor-3', 'vendor3@vendor.com', '089669432192', 'Jalan Sulawesi', '$2y$10$7Snc8SrxvPVBgSnwYIlj2ORNXKheKvqnXei05xLskJnPXjQT4aGom', 'Diterima', 'e494f866f4660b05e4f9392bcd595260.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_gambar_produk`
--
ALTER TABLE `tb_gambar_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice` (`invoice`) USING BTREE,
  ADD KEY `email` (`email`);

--
-- Indeks untuk tabel `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_invoice` (`code_invoice`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_vendor` (`id_vendor`);

--
-- Indeks untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `tb_vendor`
--
ALTER TABLE `tb_vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_gambar_produk`
--
ALTER TABLE `tb_gambar_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_orders`
--
ALTER TABLE `tb_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_vendor`
--
ALTER TABLE `tb_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_gambar_produk`
--
ALTER TABLE `tb_gambar_produk`
  ADD CONSTRAINT `tb_gambar_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD CONSTRAINT `tb_invoice_ibfk_1` FOREIGN KEY (`email`) REFERENCES `tb_member` (`email`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD CONSTRAINT `tb_orders_ibfk_1` FOREIGN KEY (`code_invoice`) REFERENCES `tb_invoice` (`invoice`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori_produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_produk_ibfk_2` FOREIGN KEY (`id_vendor`) REFERENCES `tb_vendor` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD CONSTRAINT `tb_ulasan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
