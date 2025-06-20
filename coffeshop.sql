-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2025 pada 16.29
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'Snack'),
(4, 'Dessert'),
(5, 'Paket'),
(6, 'Kopi'),
(7, 'Teh'),
(8, 'Jus'),
(9, 'Roti'),
(10, 'Sup');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) DEFAULT '0',
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `stok`, `id_kategori`) VALUES
(1, 'Nasi Goreng', '20000.00', 10, 1),
(2, 'Es Teh Manis', '8000.00', 20, 7),
(3, 'Kopi Hitam', '12000.00', 15, 6),
(4, 'Jus Alpukat', '15000.00', 12, 8),
(5, 'Burger Mini', '18000.00', 10, 3),
(6, 'Roti Bakar', '10000.00', 25, 9),
(7, 'Paket Komplit', '35000.00', 8, 5),
(8, 'Es Krim Coklat', '12000.00', 14, 4),
(9, 'Ayam Bakar', '25000.00', 9, 1),
(10, 'Sup Ayam', '16000.00', 11, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `tanggal_order` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_harga` decimal(10,2) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_pembeli` varchar(100) COLLATE utf8mb4_german2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `tanggal_order`, `total_harga`, `id_user`, `nama_pembeli`) VALUES
(1, '2025-06-20 21:26:42', '20000.00', 2, 'Rahmat'),
(2, '2025-06-20 21:26:42', '35000.00', 2, 'Nurul'),
(3, '2025-06-20 21:26:42', '15000.00', 3, 'Ali'),
(4, '2025-06-20 21:26:42', '8000.00', 4, 'Bima'),
(5, '2025-06-20 21:26:42', '12000.00', 5, 'Citra'),
(6, '2025-06-20 21:26:42', '18000.00', 6, 'Dian'),
(7, '2025-06-20 21:26:42', '10000.00', 7, 'Eko'),
(8, '2025-06-20 21:26:42', '25000.00', 8, 'Farah'),
(9, '2025-06-20 21:26:42', '16000.00', 9, 'Gilang'),
(10, '2025-06-20 21:26:42', '12000.00', 10, 'Hana');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id_item` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id_item`, `id_order`, `id_menu`, `jumlah`, `subtotal`) VALUES
(1, 1, 1, 1, '20000.00'),
(2, 2, 7, 1, '35000.00'),
(3, 3, 4, 1, '15000.00'),
(4, 4, 2, 1, '8000.00'),
(5, 5, 3, 1, '12000.00'),
(6, 6, 5, 1, '18000.00'),
(7, 7, 6, 1, '10000.00'),
(8, 8, 9, 1, '25000.00'),
(9, 9, 10, 1, '16000.00'),
(10, 10, 8, 1, '12000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id_payment` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `metode` enum('cash','qris','e-wallet') COLLATE utf8mb4_german2_ci NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `waktu_bayar` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id_payment`, `id_order`, `metode`, `jumlah_bayar`, `waktu_bayar`) VALUES
(1, 1, 'cash', '20000.00', '2025-06-20 21:26:55'),
(2, 2, 'qris', '35000.00', '2025-06-20 21:26:55'),
(3, 3, 'e-wallet', '15000.00', '2025-06-20 21:26:55'),
(4, 4, 'cash', '8000.00', '2025-06-20 21:26:55'),
(5, 5, 'qris', '12000.00', '2025-06-20 21:26:55'),
(6, 6, 'cash', '18000.00', '2025-06-20 21:26:55'),
(7, 7, 'e-wallet', '10000.00', '2025-06-20 21:26:55'),
(8, 8, 'cash', '25000.00', '2025-06-20 21:26:55'),
(9, 9, 'qris', '16000.00', '2025-06-20 21:26:55'),
(10, 10, 'cash', '12000.00', '2025-06-20 21:26:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_toko` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_german2_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_german2_ci DEFAULT NULL,
  `qris` varchar(255) COLLATE utf8mb4_german2_ci DEFAULT NULL,
  `pajak` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `nama_toko`, `alamat`, `logo`, `qris`, `pajak`) VALUES
(1, 'Coffee Omwari', 'Jl. Kopi No.1', NULL, NULL, '10.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_bahan`
--

CREATE TABLE `stok_bahan` (
  `id_stok` int(11) NOT NULL,
  `nama_bahan` varchar(100) COLLATE utf8mb4_german2_ci NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Dumping data untuk tabel `stok_bahan`
--

INSERT INTO `stok_bahan` (`id_stok`, `nama_bahan`, `jumlah`, `satuan`) VALUES
(1, 'Biji Kopi', '200.00', 'gram'),
(2, 'Gula', '1000.00', 'gram'),
(3, 'Susu', '10.00', 'liter'),
(4, 'Tepung', '1500.00', 'gram'),
(5, 'Mentega', '500.00', 'gram'),
(6, 'Coklat Bubuk', '300.00', 'gram'),
(7, 'Keju', '200.00', 'gram'),
(8, 'Roti Tawar', '100.00', 'slice'),
(9, 'Ayam', '5.00', 'kg'),
(10, 'Sayur', '3.00', 'kg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_german2_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_german2_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_german2_ci DEFAULT NULL,
  `role` enum('admin','kasir') COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'Kasir', 'kasir', 'de28f8f7998f23ab4194b51a6029416f', 'kasir'),
(3, 'Rina', 'rina', 'e10adc3949ba59abbe56e057f20f883e', 'kasir'),
(4, 'Budi', 'budi', 'e10adc3949ba59abbe56e057f20f883e', 'kasir'),
(5, 'Sari', 'sari', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
(6, 'Agus', 'agus', 'e10adc3949ba59abbe56e057f20f883e', 'kasir'),
(7, 'Dina', 'dina', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
(8, 'Tono', 'tono', 'e10adc3949ba59abbe56e057f20f883e', 'kasir'),
(9, 'Lina', 'lina', 'e10adc3949ba59abbe56e057f20f883e', 'kasir'),
(10, 'Maya', 'maya', 'e10adc3949ba59abbe56e057f20f883e', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `idx_tanggal_order` (`tanggal_order`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_order` (`id_order`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `stok_bahan`
--
ALTER TABLE `stok_bahan`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stok_bahan`
--
ALTER TABLE `stok_bahan`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
