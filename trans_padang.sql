-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2016 at 03:39 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trans_padang`
--

-- --------------------------------------------------------

--
-- Table structure for table `halte`
--

CREATE TABLE IF NOT EXISTS `halte` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `latitute` float DEFAULT NULL,
  `longitute` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `koridor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`koridor_id`),
  KEY `fk_halte_koridor_idx` (`koridor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `halte`
--

INSERT INTO `halte` (`id`, `nama`, `latitute`, `longitute`, `created_at`, `updated_at`, `deleted_at`, `koridor_id`) VALUES
(1, 'SJS', -0.902942, 100.358, '2016-04-09 22:01:14', '2016-04-09 22:01:16', NULL, 1),
(2, 'Rumah Hafiz', -0.903358, 100.361, '2016-04-09 22:59:50', '2016-04-09 22:59:50', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE IF NOT EXISTS `kecamatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nanggalo', '2016-04-09 21:52:00', '2016-04-09 21:52:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE IF NOT EXISTS `kelurahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `Kecamatan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Kecamatan_id`),
  KEY `fk_Kelurahan_Kecamatan1_idx` (`Kecamatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`, `Kecamatan_id`) VALUES
(1, 'Lapai', '2016-04-09 21:52:51', '2016-04-09 21:52:52', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `koridor`
--

CREATE TABLE IF NOT EXISTS `koridor` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `detail` varchar(45) DEFAULT NULL,
  `peta` varchar(45) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `simbol` varchar(50) DEFAULT NULL,
  `line` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `Kelurahan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Kelurahan_id`),
  KEY `fk_koridor_Kelurahan1_idx` (`Kelurahan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `koridor`
--

INSERT INTO `koridor` (`id`, `nama`, `detail`, `peta`, `color`, `simbol`, `line`, `created_at`, `updated_at`, `deleted_at`, `Kelurahan_id`) VALUES
(1, 'Koridor 1', 'Apa aja boleg', NULL, '#ff0000', 'rail-metro', 'blue', '2016-04-09 21:56:40', '2016-04-09 21:56:41', NULL, 1),
(2, 'Koridor 2', 'a', NULL, '#0000ff', 'rail-metro', 'red', '2016-04-09 23:13:56', '2016-04-09 23:13:56', NULL, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `halte`
--
ALTER TABLE `halte`
  ADD CONSTRAINT `fk_halte_koridor` FOREIGN KEY (`koridor_id`) REFERENCES `koridor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `fk_Kelurahan_Kecamatan1` FOREIGN KEY (`Kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `koridor`
--
ALTER TABLE `koridor`
  ADD CONSTRAINT `fk_koridor_Kelurahan1` FOREIGN KEY (`Kelurahan_id`) REFERENCES `kelurahan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
