-- Adminer 4.7.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `lib`;
CREATE DATABASE `lib` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lib`;

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `registredIn` date NOT NULL,
  `pdfPath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgPath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `books` (`id`, `name`, `author`, `year`, `registredIn`, `pdfPath`, `imgPath`) VALUES
(1,	'Gilės nuotykiai Ydų šalyje',	'Vytautas Petkevičius',	2009,	'2018-10-29',	NULL,	'http://www.almalittera.lt/image.php?image=/img/uploads/virseliai/Giles-nuotykiai-Ydu-salyje.jpg'),
(2,	'Math book',	'Iam',	2018,	'2018-10-29',	NULL,	NULL);

DROP TABLE IF EXISTS `lr`;
CREATE TABLE `lr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `pwtrue` int(1) NOT NULL DEFAULT '1',
  `ltype` int(1) NOT NULL DEFAULT '1',
  `dat` date NOT NULL,
  `tim` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `lr` (`id`, `uid`, `ip`, `pwtrue`, `ltype`, `dat`, `tim`) VALUES
(1,	1,	'82.135.245.242',	1,	1,	'2018-12-10',	'12:44:05'),
(2,	1,	'193.219.160.136',	1,	1,	'2018-12-11',	'08:40:05'),
(3,	2,	'193.219.160.136',	1,	1,	'2018-12-12',	'13:07:24'),
(4,	2,	'82.135.245.242',	1,	1,	'2018-12-13',	'11:31:15'),
(5,	2,	'193.219.160.136',	1,	1,	'2018-12-13',	'13:51:34');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `registredIn` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `hash`, `registredIn`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'2018-11-23'),
(2,	'asda',	'7815696ecbf1c96e6894b779456d330e',	'2018-12-12');

-- 2018-12-13 19:17:22
