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
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `relasi` varchar(45) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `warna` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table trans_padang.koridor
CREATE TABLE IF NOT EXISTS `koridor` (
  `id` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `simbol` varchar(45) DEFAULT NULL,
  `line` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table trans_padang.point
CREATE TABLE IF NOT EXISTS `point` (
  `id` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `koridor_id` int(11) NOT NULL,
  `halte_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`koridor_id`,`halte_id`),
  KEY `fk_point_rute1_idx` (`koridor_id`),
  KEY `fk_point_halte1_idx` (`halte_id`),
  CONSTRAINT `fk_point_halte1` FOREIGN KEY (`halte_id`) REFERENCES `halte` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_point_rute1` FOREIGN KEY (`koridor_id`) REFERENCES `koridor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
