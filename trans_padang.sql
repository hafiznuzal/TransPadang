-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for trans_padang
CREATE DATABASE IF NOT EXISTS `trans_padang` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `trans_padang`;


-- Dumping structure for table trans_padang.halte
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
  KEY `fk_halte_koridor_idx` (`koridor_id`),
  CONSTRAINT `fk_halte_koridor` FOREIGN KEY (`koridor_id`) REFERENCES `koridor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table trans_padang.kecamatan
CREATE TABLE IF NOT EXISTS `kecamatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table trans_padang.kelurahan
CREATE TABLE IF NOT EXISTS `kelurahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `Kecamatan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Kecamatan_id`),
  KEY `fk_Kelurahan_Kecamatan1_idx` (`Kecamatan_id`),
  CONSTRAINT `fk_Kelurahan_Kecamatan1` FOREIGN KEY (`Kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table trans_padang.koridor
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
  KEY `fk_koridor_Kelurahan1_idx` (`Kelurahan_id`),
  CONSTRAINT `fk_koridor_Kelurahan1` FOREIGN KEY (`Kelurahan_id`) REFERENCES `kelurahan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
