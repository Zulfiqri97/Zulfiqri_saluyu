-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 15 Jul 2021 pada 04.05
-- Versi server: 10.3.29-MariaDB-cll-lve
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zues865_db_sis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` text NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `religion` enum('islam','protestant','catholic','hindu','buddha','kong hu cu') DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `nik`, `name`, `dob`, `address`, `gender`, `religion`, `phone`, `image`, `status`) VALUES
(10001, '3216140109010001', 'Diki', '1997-04-01', 'Ujung harapan Rt001/014 Bekasi', 'male', 'islam', '0819-9923-9320', NULL, 0),
(10002, '3216140104970009', 'Ilham Hidayat', '1997-04-01', ' Bekasi', 'male', 'islam', '0819-9923-9326', NULL, 0),
(10005, '3216141011790004', 'Dadang Sunandar', '1997-04-01', 'Bekasi', 'male', 'islam', '0213-3244-4171', NULL, 1),
(10007, '123425251', 'pak wisnu', '2021-07-07', 'bekasi', 'male', 'islam', '1111-1111-1111', NULL, 0),
(10008, '32161401049700041', 'Zulfiqri', '1997-04-01', 'bekasi', 'male', 'islam', '0819-9923-9221', NULL, 1),
(10009, '123456789', 'Pak wisnu', '2021-07-08', 'bekasi', 'male', 'islam', '081_-____-____', NULL, 0),
(10010, '32161445210830002', 'Siti Mulsanih', '1997-04-01', ' Bekasi', 'male', 'islam', '0813-3244-4170', NULL, 1),
(10011, '3216140104970005', 'Abdul Kholik', '1997-04-01', 'Tasik', 'male', 'islam', '0813-3244-4180', NULL, 1),
(10012, '3216140104970019', 'Bagus Saputra', '1997-04-01', 'Bekasi', 'male', 'islam', '0813-3244-3160', NULL, 1),
(10013, '3216140104970009', 'Dosen', '1997-04-01', 'Bekasi', 'male', 'islam', '0213-3244-4110', NULL, 1),
(10014, '3216140104970001', 'Mahasiswa', '1997-04-01', 'Bekasi', 'male', 'islam', '0213-3244-4190', NULL, 1),
(10015, '32161401049700099', 'Diki', '1997-04-01', 'Bekasi', 'male', 'islam', '0819-9992-3932', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `status`) VALUES
(7, 'Kerupuk Kulit E-2rb (15pcs)', 20000, 1),
(8, 'Kerupuk Kulit E-5rb (12pcs)', 41000, 1),
(9, 'Kerupuk Kulit E-10rb (10pcs)', 7200, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `deposit` int(11) NOT NULL DEFAULT 0,
  `deposit_date` date DEFAULT NULL,
  `request_status` enum('pending','accepted','rejected','deposited') NOT NULL DEFAULT 'pending',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `requests`
--

INSERT INTO `requests` (`id`, `employee_id`, `product_id`, `total`, `date`, `deposit`, `deposit_date`, `request_status`, `status`) VALUES
(46, 10015, 7, 20, '2021-07-14 22:53:36', 300000, '2021-07-14', 'deposited', 1),
(47, 10015, 8, 30, '2021-07-14 22:53:45', 1230000, '2021-07-14', 'deposited', 1),
(48, 10015, 9, 10, '2021-07-14 22:53:54', 72000, '2021-07-14', 'deposited', 1),
(49, 10015, 7, 10, '2021-07-14 22:58:00', 0, NULL, 'rejected', 1),
(50, 10015, 8, 10, '2021-07-14 22:58:18', 0, NULL, 'accepted', 1),
(51, 10015, 7, 50, '2021-07-15 03:21:59', 0, NULL, 'accepted', 1),
(52, 10015, 7, 5, '2021-07-15 03:36:30', 0, NULL, 'pending', 1),
(53, 10015, 8, 5, '2021-07-15 03:36:41', 0, NULL, 'pending', 1),
(54, 10015, 9, 5, '2021-07-15 03:36:51', 0, NULL, 'pending', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `google_map_url` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `stores`
--

INSERT INTO `stores` (`id`, `name`, `address`, `google_map_url`, `status`) VALUES
(11, 'Arifudin', 'Pondok ungu permai B J12 No4', 'https://www.google.com/maps/preview', 1),
(12, 'Achmad rifai', 'Pondok ungu permai B J1 N02', 'https://www.google.com/maps/preview', 1),
(13, 'Zudi zulkarnain', 'Pondok ungu permai B J1 No7', 'https://www.google.com/maps/@-6.2611998,107.0421327,15z', 1),
(14, 'H. ahmad', 'Pondok ungu permai B K1 No2', 'https://www.google.com/maps/@-6.2611998,107.0421327,15', 1),
(15, 'levina', 'Pondok ungu permai B J12 No1', 'https://www.google.com/maps/@-6.2611998,107.0421327,15z', 1),
(16, 'Hakim', 'Pondok ungu permai B H5 No05', 'https://www.google.com/maps/@-6.2611998,107.0421327,15z', 1),
(17, 'Viki', 'Pondok ungu permai B H5 No01', 'https://www.google.com/maps/@-6.2611998,107.0421327,15z', 1),
(18, 'M ahmad', 'Pondok ungu permai B H5 No9', 'https://www.google.com/maps/@-6.2611998,107.0421327,15z', 1),
(19, 'Sandy', 'Pondok ungu permai B H5 No01', 'https://www.google.com/maps/@-6.2611998,107.0421327,15z', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplies`
--

CREATE TABLE `supplies` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` enum('in','out') NOT NULL DEFAULT 'in',
  `source` enum('production','unsold') NOT NULL DEFAULT 'production',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `supplies`
--

INSERT INTO `supplies` (`id`, `product_id`, `total`, `date`, `type`, `source`, `status`) VALUES
(35, 7, 100, '2021-06-17 08:11:18', 'in', 'production', 1),
(36, 8, 150, '2021-06-17 08:11:31', 'in', 'production', 1),
(37, 9, 50, '2021-06-17 08:12:07', 'in', 'production', 1),
(38, 9, 5, '2021-06-17 08:14:44', 'out', 'production', 1),
(39, 7, 10, '2021-07-07 17:19:14', 'out', 'production', 1),
(40, 7, 1000, '2021-07-14 03:55:08', 'in', 'production', 1),
(41, 8, 1000, '2021-07-14 03:55:23', 'in', 'production', 1),
(42, 9, 500, '2021-07-14 03:55:34', 'in', 'production', 1),
(43, 9, 10, '2021-07-14 22:54:10', 'out', 'production', 1),
(44, 8, 30, '2021-07-14 22:54:15', 'out', 'production', 1),
(45, 7, 20, '2021-07-14 22:54:25', 'out', 'production', 1),
(46, 8, 10, '2021-07-15 03:18:41', 'out', 'production', 1),
(47, 7, 50, '2021-07-15 03:22:15', 'out', 'production', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `total_product` int(11) NOT NULL,
  `type` enum('give','take') NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `request_id`, `store_id`, `total_product`, `type`, `date`, `status`) VALUES
(38, 48, 14, 10, 'give', '2021-07-14 22:55:25', 1),
(39, 47, 13, 30, 'give', '2021-07-14 22:55:40', 1),
(40, 46, 11, 20, 'give', '2021-07-14 22:56:13', 1),
(41, 51, 11, 50, 'give', '2021-07-15 03:34:00', 1),
(42, 51, 11, 45, 'take', '2021-07-15 03:34:39', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `employee_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('super admin','admin','sales') NOT NULL DEFAULT 'sales',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `employee_id`, `username`, `password`, `user_type`, `status`) VALUES
(20, 10008, 'zulfi10008', '7b9fd8ad93597b72f9c61d8a982008e4', 'admin', 1),
(22, 10015, 'diki10015', '7b9fd8ad93597b72f9c61d8a982008e4', 'sales', 1),
(25, 10014, 'mahas10014', '7b9fd8ad93597b72f9c61d8a982008e4', 'sales', 1),
(26, 10005, 'dadan10005', '7b9fd8ad93597b72f9c61d8a982008e4', 'super admin', 1),
(27, 10011, 'abdul10011', '7b9fd8ad93597b72f9c61d8a982008e4', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10016;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
