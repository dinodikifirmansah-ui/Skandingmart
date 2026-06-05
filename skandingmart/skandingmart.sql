-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2026 at 08:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skandingmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status_baca` enum('0','1') DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `pesan`, `status_baca`, `created_at`) VALUES
(1, 3, 'Produk baru berhasil ditambahkan', '0', '2026-05-10 19:57:38'),
(2, 3, 'Pesanan baru masuk', '0', '2026-05-10 20:11:16'),
(3, 3, 'Pesanan baru masuk', '0', '2026-05-10 20:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_harga`, `status`, `alamat`, `metode_pembayaran`, `bukti_transfer`, `created_at`) VALUES
(1, 2, 10000, 'Diproses', 'kelas xi rpl 1', 'COD', NULL, '2026-05-10 19:48:01'),
(2, 2, 3000, 'Diproses', 'X RPL 1', 'COD', NULL, '2026-05-10 19:50:45'),
(3, 2, 6000, 'Diproses', 'x rpl 2', 'COD', NULL, '2026-05-10 19:58:02'),
(4, 2, 6000, 'Diproses', 'ruang guru', 'COD', NULL, '2026-05-10 20:03:54'),
(5, 2, 6000, 'Diproses', 'TU', 'COD', NULL, '2026-05-10 20:07:25'),
(6, 2, 6000, 'Diproses', 'TU', 'COD', NULL, '2026-05-10 20:11:16'),
(7, 5, 6000, 'Diproses', 'SATPAM', 'COD', NULL, '2026-05-10 20:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `subtotal`) VALUES
(1, 6, 3, 1, 6000),
(2, 7, 3, 1, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `nama_produk`, `deskripsi`, `harga`, `stok`, `gambar`, `kategori`, `status`, `created_at`) VALUES
(1, 2, 'Cihu', '', 5000, 5, 'WhatsApp_Image_2025-06-08_at_17.42.35_3c568866-removebg-preview.png', 'makanan', 'Tersedia', '2026-05-10 19:45:40'),
(2, 3, 'Cihu', '', 3000, 5, 'RPL.png', '', 'Tersedia', '2026-05-10 19:50:19'),
(3, 3, 'Gorengan', 'enak', 6000, 8, '1778443058_TITL.png', 'Makanan', 'Tersedia', '2026-05-10 19:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('pelanggan','penjual','admin') DEFAULT 'pelanggan',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `foto`, `created_at`) VALUES
(1, 'DIKI FIRMANSAH', 'diki@gmail.com', '$2y$10$khxy1jIqBMZGRXQWC6t8MubUkUKiWmhC.QIqaQsvNrCh7S.d21o6u', 'pelanggan', NULL, '2026-05-10 19:40:17'),
(2, 'DANI', 'dani@gmail.com', '$2y$10$wPXK/sjnuHFVQn0RrQYVyOcIYO/sGU3OWsWCSQ6vjkAUHU4ieWDc6', 'penjual', NULL, '2026-05-10 19:44:37'),
(3, 'Robi', 'robi@gmail.com', '$2y$10$y4ud8Auy7mTpY2s9NcfJfen1QFkcYUeUwM8Qr4G3jcSfkhQtXHv4y', 'penjual', NULL, '2026-05-10 19:48:35'),
(4, 'Anggit', 'anggit@gmail.com', '$2y$10$CjD0gtrFtOCtAyqH4urOM.cGmVKTmsfvb059argFBQLHD/NUkN/i.', 'pelanggan', NULL, '2026-05-10 20:14:41'),
(5, 'Sugeng', 'sugeng@gmail.com', '$2y$10$8TmWOlBW56PrBEX5jOKmIOoRFZ34emF7JF9K.R177jsTuOrvO7nEK', 'pelanggan', NULL, '2026-05-10 20:16:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
