-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2024 at 03:46 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembayaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `bonuspembayaran`
--

CREATE TABLE `bonuspembayaran` (
  `ID` int(11) NOT NULL,
  `idPembayaran` int(11) NOT NULL,
  `idBuruh` int(45) NOT NULL,
  `Persentase` int(45) NOT NULL,
  `TotalPembayaran` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bonuspembayaran`
--

INSERT INTO `bonuspembayaran` (`ID`, `idPembayaran`, `idBuruh`, `Persentase`, `TotalPembayaran`) VALUES
(1, 4, 1, 50, 500000),
(2, 4, 2, 30, 300000),
(3, 4, 3, 10, 100000),
(4, 4, 4, 10, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `buruh`
--

CREATE TABLE `buruh` (
  `ID` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempatTinggal` varchar(255) NOT NULL,
  `posisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buruh`
--

INSERT INTO `buruh` (`ID`, `nama`, `tempatTinggal`, `posisi`) VALUES
(1, 'Ghozi Fadhillah Himma', 'Madiun', 'Fullstack web developer'),
(2, 'Rival Dwiki Indrawn', 'Pemalang', 'Database Administration'),
(3, 'Mufid Hadi', 'Tangerang', 'UI/UX'),
(4, 'Sinta astuti', 'Madiun', 'Web Programmer');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID` int(11) NOT NULL,
  `pembayaran` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`ID`, `pembayaran`, `timestamp`) VALUES
(4, 1000000, '2024-05-31 18:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(23) NOT NULL,
  `user_group_id` int(23) DEFAULT NULL,
  `user_username` varchar(23) DEFAULT NULL,
  `user_password` text,
  `user_nama` varchar(23) DEFAULT NULL,
  `kontak` varchar(16) NOT NULL,
  `user_email` varchar(90) DEFAULT NULL,
  `user_hak_akses` enum('admin','petugas','sup_admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_group_id`, `user_username`, `user_password`, `user_nama`, `kontak`, `user_email`, `user_hak_akses`) VALUES
(1, NULL, 'admin', 'mbiB9iFwmeZSb8INFrnFc69ehVoFmZMcJF6Gqn3GHJA=', 'admin', '081977309422', 'ghozifadilah97@gmail.com', 'admin'),
(2, NULL, 'petugas', 'mbiB9iFwmeZSb8INFrnFc69ehVoFmZMcJF6Gqn3GHJA=', 'petugas', '081977309422', 'petugas@gmail.com', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(23) NOT NULL,
  `company_id` int(23) DEFAULT NULL,
  `role_id` varchar(23) DEFAULT NULL,
  `username` varchar(23) DEFAULT NULL,
  `password` varchar(242) DEFAULT NULL,
  `email` varchar(243) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `role_id`, `username`, `password`, `email`) VALUES
(4, 1, '1', 'admin', 'RkdsMHFmWnduSVNoVmRSKH5zfkrsPKqubx32vIOlpA==', 'ghozifadilah97@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bonuspembayaran`
--
ALTER TABLE `bonuspembayaran`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_pembayaranID_IdPembayaran` (`idPembayaran`),
  ADD KEY `fk_buruh_BuruhID` (`idBuruh`);

--
-- Indexes for table `buruh`
--
ALTER TABLE `buruh`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bonuspembayaran`
--
ALTER TABLE `bonuspembayaran`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buruh`
--
ALTER TABLE `buruh`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(23) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bonuspembayaran`
--
ALTER TABLE `bonuspembayaran`
  ADD CONSTRAINT `fk_buruh_BuruhID` FOREIGN KEY (`idBuruh`) REFERENCES `buruh` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pembayaranID_IdPembayaran` FOREIGN KEY (`idPembayaran`) REFERENCES `pembayaran` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
