-- Adminer 4.7.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `books` (`id`, `name`, `author`, `year`, `registredIn`, `pdfPath`, `imgPath`) VALUES
(1,	'Gilės nuotykiai Ydų šalyje',	'Vytautas Petkevičius',	2009,	'2018-10-29 00:00:00',	NULL,	'http://www.almalittera.lt/image.php?image=/img/uploads/virseliai/Giles-nuotykiai-Ydu-salyje.jpg'),
(3,	'Doriano Grėjaus Portretas',	'Oskaras Vaildas',	1890,	'2018-12-21 18:54:29',	NULL,	'https://www.knyguklubas.lt/media/catalog/product/cache/e4d64343b1bc593f1c5348fe05efa4a6/0/0/000000000002112284-59de80f297644-asset-knyguklubas-cdb_doriano-grejaus-portretas-virselis_p1.jpg'),
(4,	'Kuprelis',	'Ignas Šeinius',	1913,	'2018-12-21 18:55:20',	'http://www.xn--altiniai-4wb.info/files/literatura/LH00/Ignas_%C5%A0einius._Kuprelis.LHM800.pdf',	'http://www.patogupirkti.lt/out/pictures/1/9986-06-037-0(2).gif'),
(5,	'Mažasis Princas',	'Antanas de Sent Egziuperi',	1943,	'2018-12-21 18:56:34',	'http://ebiblioteka.mkp.emokykla.lt/kuriniai/mazasis_princas/,format.pdf',	'https://www.knyguklubas.lt/media/catalog/product/cache/e4d64343b1bc593f1c5348fe05efa4a6/0/0/000000000001101494-59de81b9e41b6-asset-knyguklubas-cdb_ma%C5%BEasis-princas_p1.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `lr` (`id`, `uid`, `ip`, `pwtrue`, `ltype`, `dat`, `tim`) VALUES
(1,	1,	'82.135.245.242',	1,	1,	'2018-12-10',	'12:44:05'),
(2,	1,	'193.219.160.136',	1,	1,	'2018-12-11',	'08:40:05'),
(3,	2,	'193.219.160.136',	1,	1,	'2018-12-12',	'13:07:24'),
(4,	2,	'82.135.245.242',	1,	1,	'2018-12-13',	'11:31:15'),
(5,	2,	'193.219.160.136',	1,	1,	'2018-12-13',	'13:51:34'),
(7,	2,	'192.168.0.101',	1,	1,	'2018-12-21',	'18:35:16');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `registredIn` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `hash`, `registredIn`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'2018-11-23'),
(2,	'asda',	'7815696ecbf1c96e6894b779456d330e',	'2018-12-12');

-- 2018-12-21 17:20:53