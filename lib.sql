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
  `registredIn` datetime NOT NULL,
  `pdfPath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgPath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `books` (`id`, `name`, `author`, `year`, `registredIn`, `pdfPath`, `imgPath`) VALUES
(1,	'Gilės nuotykiai Ydų šalyje',	'Vytautas Petkevičius',	2009,	'2018-10-29 00:00:00',	NULL,	'http://www.almalittera.lt/image.php?image=/img/uploads/virseliai/Giles-nuotykiai-Ydu-salyje.jpg'),
(3,	'Doriano Grėjaus Portretas',	'Oskaras Vaildas',	1890,	'2018-12-21 18:54:29',	NULL,	'https://www.knyguklubas.lt/media/catalog/product/cache/e4d64343b1bc593f1c5348fe05efa4a6/0/0/000000000002112284-59de80f297644-asset-knyguklubas-cdb_doriano-grejaus-portretas-virselis_p1.jpg'),
(4,	'Kuprelis',	'Ignas Šeinius',	1913,	'2018-12-21 18:55:20',	'http://www.xn--altiniai-4wb.info/files/literatura/LH00/Ignas_%C5%A0einius._Kuprelis.LHM800.pdf',	'http://www.patogupirkti.lt/out/pictures/1/9986-06-037-0(2).gif'),
(5,	'Mažasis Princas',	'Antanas de Sent Egziuperi',	1943,	'2018-12-21 18:56:34',	'http://ebiblioteka.mkp.emokykla.lt/kuriniai/mazasis_princas/,format.pdf',	'https://www.knyguklubas.lt/media/catalog/product/cache/e4d64343b1bc593f1c5348fe05efa4a6/0/0/000000000001101494-59de81b9e41b6-asset-knyguklubas-cdb_ma%C5%BEasis-princas_p1.jpg'),
(6,	'Broliai Liūtaširdžiai',	'Astrid Lindgren',	1973,	'2018-12-24 18:55:46',	NULL,	'https://www.knyguklubas.lt/media/catalog/product/cache/e4d64343b1bc593f1c5348fe05efa4a6/0/0/000000000002118430-59de821cbc76c-asset-knyguklubas-cdb_broliai-liutasirdziai_p1.jpg'),
(7,	'Ronja Plėšiko Duktė',	'Astrid Lingren',	1981,	'2018-12-24 18:59:27',	NULL,	'https://elektronines.com/wp-content/uploads/astrid-lindgren-ronja-plesiko-dukte.jpg'),
(8,	'Poliana',	'Eleanor Emily Hodgman',	1913,	'2018-12-24 19:02:13',	'http://ebiblioteka.mkp.emokykla.lt/kuriniai/poliana/,format.pdf',	'https://www.knyguklubas.lt/media/catalog/product/cache/e4d64343b1bc593f1c5348fe05efa4a6/0/0/000000000001106191-65106-asset-knyguklubas-cdb_kk_07eb59922d5561a1cec0039047b36926_p1.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `lr` (`id`, `uid`, `ip`, `pwtrue`, `ltype`, `dat`, `tim`) VALUES
(1,	1,	'82.135.245.242',	1,	1,	'2018-12-10',	'12:44:05'),
(2,	1,	'193.219.160.136',	1,	1,	'2018-12-11',	'08:40:05'),
(3,	2,	'193.219.160.136',	1,	1,	'2018-12-12',	'13:07:24'),
(4,	2,	'82.135.245.242',	1,	1,	'2018-12-13',	'11:31:15'),
(5,	2,	'193.219.160.136',	1,	1,	'2018-12-13',	'13:51:34'),
(7,	2,	'192.168.0.101',	1,	1,	'2018-12-21',	'18:35:16'),
(8,	1,	'127.0.0.1',	1,	1,	'2018-12-23',	'20:12:52'),
(9,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'15:56:14'),
(10,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'15:59:04'),
(11,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'17:58:54'),
(12,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:04:36'),
(13,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:05:20'),
(14,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:06:53'),
(15,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:07:26'),
(16,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:08:50'),
(17,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:08:51'),
(18,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:09:26'),
(19,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:11:54'),
(20,	2,	'127.0.0.1',	1,	1,	'2018-12-24',	'18:14:14');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `registredIn` date NOT NULL,
  `type` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `hash`, `registredIn`, `type`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'2018-11-23',	'admin'),
(2,	'asda',	'7815696ecbf1c96e6894b779456d330e',	'2018-12-12',	'normal');

-- 2018-12-25 13:27:10
