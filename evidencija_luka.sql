-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 09:39 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evidencija_luka`
--

-- --------------------------------------------------------

--
-- Table structure for table `brodovi`
--

CREATE TABLE `brodovi` (
  `id` int(11) NOT NULL,
  `nazivBroda` varchar(255) NOT NULL,
  `zemljaPorekla` varchar(255) NOT NULL,
  `vrstaBroda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brodovi`
--

INSERT INTO `brodovi` (`id`, `nazivBroda`, `zemljaPorekla`, `vrstaBroda`) VALUES
(1, 'Pegasus', 'Malta', 'Putnicki'),
(2, 'Nikolaos', 'Grcka', 'Jahta'),
(3, 'Kalipso', 'Hrvatska', 'Trgovacki');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `datumRodjenja` date NOT NULL,
  `pol` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `password`, `ime`, `prezime`, `datumRodjenja`, `pol`) VALUES
(1, 'admin', 'admin', 'Katarina', 'Ninkovic', '2000-05-05', 'Z');

-- --------------------------------------------------------

--
-- Table structure for table `luke`
--

CREATE TABLE `luke` (
  `id` int(11) NOT NULL,
  `nazivLuke` varchar(255) NOT NULL,
  `grad` varchar(255) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `brod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `luke`
--

INSERT INTO `luke` (`id`, `nazivLuke`, `grad`, `korisnik_id`, `brod_id`) VALUES
(1, 'Luka Valletta', 'Malta', 1, 1),
(2, 'luka Solun', 'Solun', 1, 2),
(3, 'luka Dubrovnik', 'Dubrovnik', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brodovi`
--
ALTER TABLE `brodovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `luke`
--
ALTER TABLE `luke`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brod` (`brod_id`),
  ADD KEY `korisnik` (`korisnik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brodovi`
--
ALTER TABLE `brodovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `luke`
--
ALTER TABLE `luke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `luke`
--
ALTER TABLE `luke`
  ADD CONSTRAINT `brod` FOREIGN KEY (`brod_id`) REFERENCES `brodovi` (`id`),
  ADD CONSTRAINT `korisnik` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnici` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
