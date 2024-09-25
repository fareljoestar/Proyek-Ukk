-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2024 pada 16.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galeryfoto2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `albumid` int(11) NOT NULL,
  `namaalbum` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggaldibuat` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`albumid`, `namaalbum`, `deskripsi`, `tanggaldibuat`, `userid`) VALUES
(11, 'WOYLAH', 'apacoba', '2024-09-04', 1),
(12, 'MOBELEJEN', 'History Legenda seluler', '2024-09-05', 5),
(13, 'Handphone', 'Merek Hp', '2024-09-22', 1),
(14, 'IOG', 'Party ML', '2024-09-23', 5),
(15, 'TV', 'Televisi', '2024-09-24', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `fotoid` int(11) NOT NULL,
  `judulfoto` varchar(255) NOT NULL,
  `deskripsifoto` text NOT NULL,
  `tanggalunggah` date NOT NULL,
  `namafile` varchar(255) NOT NULL,
  `albumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`fotoid`, `judulfoto`, `deskripsifoto`, `tanggalunggah`, `namafile`, `albumid`, `userid`) VALUES
(11, 'otak otak', 'ikan', '2024-09-23', 'Otak-otak.jpg', 11, 1),
(12, 'Siomay', 'Siomay ikhan', '2024-09-23', 'Siomay.jpg', 11, 1),
(13, 'Kagura', 'Bucinan terkuat sejagad raya', '2024-09-05', '449148224_994100318851465_600355969576208133_n.jpg', 12, 5),
(14, 'RedMagic 8s Pro', 'Worth it banget nih hape buat main game\r\n\r\nspesifikasi redmagic 8s pro:\r\n\r\nTAMPILAN :\r\nLayar	6.8\"\r\nKedalaman Piksel	400ppi\r\nResolusi Layar	1116 x 2480pixels\r\nTeknologi Layar	AMOLED\r\nSplashproof	Tidak\r\nTahan Air	Tidak\r\n\r\nKAMERA :\r\nKamera Utama	50 + 8 + 2MP\r\nKamera Selfie	16MP\r\nTipe Kamera	Triple Kamera\r\nResolusi Video	4K, Full HD, 8K\r\n\r\nMEMORI :\r\nPenyimpanan	512GB, 256GB\r\nRAM	16GB, 12GB\r\nMemori yang Dapat Diperluas	Tidak\r\n\r\nDESAIN :\r\nBerat	228g\r\nDimensi (W x H x D)	76.35 x 164 x 9.47mm\r\nMaterial Bodi	Aluminium, Kaca\r\n\r\nBATERAI :\r\nKapasitas Baterai	6000mAh\r\nCharging	Fast Charging\r\n\r\nPLATFORM :\r\nChipset	Qualcomm Snapdragon 8+ Gen 2 (4 nm)\r\nProsesor Inti	Octa Core\r\nSistem Operasi	Android\r\nVersi OS	13\r\n\r\nWARNA :\r\nWarna	Midnight, Aurora\r\n\r\nFITUR :\r\nPemindai Sidik Jari	Ya\r\nFace Recognition	Ya\r\n\r\nJARINGAN :\r\nDual SIM	Ya\r\nSIM Card	Nano-SIM\r\n\r\nKONEKSI :\r\n5G	Ya\r\nWi-Fi Standard	802.11 a/b/g/n/ac/6e/7\r\nNFC	Ya\r\nUSB Connectors	Type-C\r\n\r\nHARGA :\r\nHarga Resmi	12.999.000, 11.999.000', '2024-09-22', 'redmagic 8s pro.jpg', 13, 1),
(15, 'Partyan malam', 'ketemu orang sultan wak 💀', '2024-09-23', 'Ketemu Orang Sultan.jpg', 14, 5),
(16, 'Profil Game', 'Udah glory gw cuyy', '2024-09-23', 'WhatsApp Image 2024-09-23 at 08.02.59_9f8fd209.jpg', 12, 5),
(17, 'Nasi Goreng', 'ALAMAK 😋😋😋', '2024-09-23', 'Nasi Goreng.jpg', 11, 4),
(18, 'Snack Siang', 'Enak Bngt Makan ini Pas Siang-Siang 😋', '2024-09-23', 'Chiki Twist.jpg', 11, 4),
(23, 'TV SAMSUNG', 'tv', '2024-09-25', 'tv sharp.jpg', 15, 7),
(24, 'Dimensity dan Snapdragon', 'Xiaomi redmi 13\r\nXiaomi redmi note 13 5g\r\nIqoo Z9 5g', '2024-09-25', 'WIN_20240913_10_39_42_Pro.jpg', 13, 4),
(25, 'Reset Season', 'Season 34', '2024-09-25', 'WhatsApp Image 2024-09-25 at 08.48.15_295b6235.jpg', 12, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` date NOT NULL,
  `parentid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`komentarid`, `fotoid`, `userid`, `isikomentar`, `tanggalkomentar`, `parentid`) VALUES
(8, 12, 1, 'OH MYYY ', '2024-09-05', NULL),
(11, 13, 2, 'awokwkwokwk bucinan silper', '2024-09-05', NULL),
(13, 12, 2, 'IYH', '2024-09-05', NULL),
(26, 11, 2, 'nekko', '2024-09-06', NULL),
(29, 14, 1, 'ANKSHJFKJWS', '2024-09-22', NULL),
(32, 14, 5, 'WHEN YAH AKU PUNYA NIH HAPE :( ??', '2024-09-22', 29),
(33, 14, 1, 'When when xixixi', '2024-09-22', 29),
(34, 14, 4, 'Fav banget sih ini 😍😍😍😍', '2024-09-22', 29),
(41, 11, 1, 'p', '2024-09-23', NULL),
(42, 11, 1, 'p', '2024-09-23', NULL),
(43, 11, 1, 'gg', '2024-09-23', 41),
(44, 11, 1, 'gg', '2024-09-23', NULL),
(45, 11, 1, 'rel', '2024-09-23', NULL),
(48, 11, 1, 'gg rel', '2024-09-23', NULL),
(52, 14, 1, 'Mahal bngt gilaaakkkk', '2024-09-23', NULL),
(53, 14, 1, 'iyalah orng hp gaming', '2024-09-23', 52),
(54, 12, 1, 'enak bngt tuh', '2024-09-23', NULL),
(55, 12, 1, '', '2024-09-23', NULL),
(56, 12, 1, 'Beli siomay yang enak dimana ya :( ??', '2024-09-23', NULL),
(57, 15, 4, 'Busett Bang 💀', '2024-09-23', NULL),
(58, 16, 4, 'Anjayy Congrats Cuy', '2024-09-23', NULL),
(59, 14, 4, 'Hp Gw Sekarang Tuh 😁', '2024-09-23', NULL),
(60, 18, 4, '😋😋😍😍🥰🥰🥰', '2024-09-23', NULL),
(61, 18, 4, 'Yummy', '2024-09-23', 60),
(62, 18, 1, '🗿🗿', '2024-09-23', NULL),
(63, 16, 1, 'Kelass King 🥶🥶', '2024-09-23', NULL),
(64, 15, 1, 'Grangernya Sultan Bngt itu njrr ', '2024-09-23', NULL),
(67, 17, 1, 'Bagi Dong Plss 🥹🥹', '2024-09-23', NULL),
(68, 17, 1, 'Aku jg mw 🥺🥺🥺', '2024-09-23', 67),
(69, 15, 5, 'Untung Gw Jago 😎', '2024-09-23', 57),
(70, 13, 5, 'wlee', '2024-09-23', 11),
(71, 15, 1, 'gg', '2024-09-23', NULL),
(72, 15, 1, 'keren gtu bng', '2024-09-23', 71),
(73, 16, 2, 'ANJAAYYYY', '2024-09-23', NULL),
(74, 15, 2, 'SHHEEESSHHH', '2024-09-23', NULL),
(75, 15, 5, '😎😎😎😎😎', '2024-09-23', 74),
(76, 15, 5, 'YOII 😎😎😎😎', '2024-09-23', 71),
(78, 12, 5, 'uhuy', '2024-09-23', 8),
(80, 12, 5, 'Di cokro ada mas,saya kesana kemarin rasanya enak bngt trss jg murah bngt harganya gilaa dari harga siomay pada umunya', '2024-09-23', 56),
(81, 17, 5, 'Aku Mw Tak terhingga 😋😋😋😋😋', '2024-09-23', NULL),
(84, 14, 5, 'WOW', '2024-09-25', 59),
(85, 18, 5, 'Aku Mintaa pliss', '2024-09-25', NULL),
(86, 24, 7, 'Aku Cinta Xiaomi', '2024-09-25', NULL),
(87, 12, 5, '😋', '2024-09-25', 54),
(88, 25, 1, 'gg bngt bng udh glory', '2024-09-25', NULL),
(89, 25, 7, 'yoi', '2024-09-25', 88);

-- --------------------------------------------------------

--
-- Struktur dari tabel `likefoto`
--

CREATE TABLE `likefoto` (
  `likeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggallike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `likefoto`
--

INSERT INTO `likefoto` (`likeid`, `fotoid`, `userid`, `tanggallike`) VALUES
(41, 11, 1, '2024-09-05'),
(42, 11, 5, '2024-09-05'),
(44, 13, 2, '2024-09-05'),
(46, 11, 2, '2024-09-05'),
(47, 12, 2, '2024-09-05'),
(48, 12, 5, '2024-09-06'),
(52, 14, 1, '2024-09-22'),
(53, 14, 4, '2024-09-22'),
(55, 15, 4, '2024-09-23'),
(56, 16, 4, '2024-09-23'),
(57, 12, 4, '2024-09-23'),
(59, 18, 4, '2024-09-23'),
(60, 18, 1, '2024-09-23'),
(61, 16, 1, '2024-09-23'),
(62, 15, 1, '2024-09-23'),
(63, 17, 1, '2024-09-23'),
(64, 13, 5, '2024-09-23'),
(65, 16, 2, '2024-09-23'),
(66, 15, 2, '2024-09-23'),
(67, 17, 5, '2024-09-23'),
(68, 12, 7, '2024-09-24'),
(70, 14, 5, '2024-09-25'),
(71, 18, 5, '2024-09-25'),
(73, 24, 7, '2024-09-25'),
(74, 25, 1, '2024-09-25'),
(75, 25, 7, '2024-09-25'),
(76, 16, 7, '2024-09-25'),
(77, 12, 1, '2024-09-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reply_komentar`
--

CREATE TABLE `reply_komentar` (
  `id_reply` int(11) NOT NULL,
  `komentarid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `isireply` text DEFAULT NULL,
  `tanggalreply` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`, `profile_picture`) VALUES
(1, 'Eza', '202cb962ac59075b964b07152d234b70', 'fareruu0@gmail.com', 'faeyza affiq putra margianto', 'Jl Mastrip Gg Keleng Keng', 'uploads/profile_pictures/♡ ۪  ୭ ⋆˚.jpeg'),
(2, 'Julian', 'f899139df5e1059396431415e770c6dd', 'juli@gmail.com', 'Julianto', 'Jl Mastrip Gg Keleng Keng', 'uploads/profile_pictures/255429693_417464006515102_6375660617366464661_n.jpg'),
(4, 'Minji', 'e8c0653fea13f91bf3c48159f7c24f78', 'minji@gmail.com', 'minji', 'Jl Mastrip Gg Keleng Keng', 'uploads/profile_pictures/♡ ۪  ୭ ⋆˚.jpeg'),
(5, 'Kelly', '42810cb02db3bb2cbb428af0d8b0376e', 'kelly30@gmail.com', 'Kelly Silvia Putri', 'Jl Slamet riyadi Gg Semar', 'uploads/profile_pictures/saki tenma.webp'),
(6, 'Purify', '698d51a19d8a121ce581499d7b701668', 'purify@gmail.com', 'farel putra ', 'Jl serayu Gg A', NULL),
(7, 'Nevermind', '202cb962ac59075b964b07152d234b70', 'terserah@gmail.com', 'Reyhan Bhustami', 'Jl Mastrip Gg Keleng Keng', 'uploads/profile_pictures/download (3).jpeg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoid`),
  ADD KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`komentarid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`likeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `reply_komentar`
--
ALTER TABLE `reply_komentar`
  ADD PRIMARY KEY (`id_reply`),
  ADD KEY `komentarid` (`komentarid`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `reply_komentar`
--
ALTER TABLE `reply_komentar`
  MODIFY `id_reply` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_3` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reply_komentar`
--
ALTER TABLE `reply_komentar`
  ADD CONSTRAINT `reply_komentar_ibfk_1` FOREIGN KEY (`komentarid`) REFERENCES `komentar` (`komentarid`),
  ADD CONSTRAINT `reply_komentar_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
