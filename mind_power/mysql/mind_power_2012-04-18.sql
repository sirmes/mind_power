# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.22)
# Database: mind_power
# Generation Time: 2012-04-18 13:45:51 -0400
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `answers`;

CREATE TABLE `answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_tester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;

INSERT INTO `answers` (`id`, `id_question`, `id_tester`)
VALUES
	(1,3,3),
	(2,0,0),
	(3,0,0),
	(4,0,0),
	(5,2,30),
	(6,4,30),
	(15,2,38),
	(16,4,38),
	(17,6,38),
	(18,2,39),
	(19,4,39),
	(20,6,39),
	(21,2,40),
	(22,4,40),
	(23,6,40),
	(24,2,41),
	(25,4,41),
	(26,6,41),
	(27,2,42),
	(28,4,42),
	(29,6,42),
	(30,1,43),
	(31,3,43),
	(32,5,43),
	(33,2,44),
	(34,4,44),
	(35,6,44),
	(36,7,44),
	(37,8,44);

/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `active` varchar(1) DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`, `active`)
VALUES
	(1,'Strategic People Management','A'),
	(2,'Strategic Inovation Management','A'),
	(3,'Strategic Execution Management','A');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `name`, `active`)
VALUES
	(1,'Sony','A'),
	(2,'Apple','A'),
	(3,'LG','I'),
	(4,'Saks',''),
	(5,'Typesafe',''),
	(6,'test',''),
	(7,'Oracle','A');

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `id_sub_category` int(11) NOT NULL,
  `group_break` int(11) NOT NULL,
  `question` varchar(3000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;

INSERT INTO `questions` (`id`, `id_category`, `id_sub_category`, `group_break`, `question`)
VALUES
	(1,1,1,1,'I am principle-oriented and make certain that specific goals, plans and milestones are set\rI am principle-oriented and make certain that specific goals, plans and milestones are set'),
	(2,1,2,1,'I make people feel that they really are contributing members of a team'),
	(3,2,3,2,'I have a competitive edge and a will to win'),
	(4,2,5,2,'I have excellent observation skills and insight'),
	(5,3,2,3,'I instill confidence in others and empower them to take initiative'),
	(6,3,6,3,'I follow through on promises and commitments'),
	(7,1,2,4,'I make people feel that they really are contributin members of a team'),
	(8,1,1,4,'I act with integrity and honesty nearly all the time');

/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sub_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sub_categories`;

CREATE TABLE `sub_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `active` varchar(1) DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;

INSERT INTO `sub_categories` (`id`, `id_category`, `name`, `active`)
VALUES
	(1,1,'mP Excellence','A'),
	(2,1,'mP Empathy','A'),
	(3,1,'mP Touch','A'),
	(4,2,'mP Assessment','A'),
	(5,2,'mP Abundance','A'),
	(6,2,'mP Truth','A'),
	(7,3,'mP Valor','A'),
	(8,3,'mP Belief','A'),
	(9,3,'mP Unity','A');

/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table testers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `testers`;

CREATE TABLE `testers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `title` varchar(4) DEFAULT '',
  `name` varchar(120) NOT NULL DEFAULT '',
  `email` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `testers` WRITE;
/*!40000 ALTER TABLE `testers` DISABLE KEYS */;

INSERT INTO `testers` (`id`, `id_company`, `title`, `name`, `email`)
VALUES
	(1,0,'aaa','bb','ccc'),
	(2,0,'aaa','bb','ccc'),
	(3,0,'aaa','bb','ccc'),
	(4,2,'Sam','Irmes','sirmes@gmail.com'),
	(5,2,'Sam','Irmes','sirmes@gmail.com'),
	(6,2,'Sam','Irmes','sirmes@gmail.com'),
	(7,2,'Sam','Irmes','sirmes@gmail.com'),
	(8,2,'Sam','Irmes','sirmes@gmail.com'),
	(9,2,'Sam','Irmes','sirmes@gmail.com'),
	(10,2,'Sam','Irmes','sirmes@gmail.com'),
	(11,2,'Sam','Irmes','sirmes@gmail.com'),
	(12,2,'Sam','Irmes','sirmes@gmail.com'),
	(13,2,'Sam','Irmes','sirmes@gmail.com'),
	(14,2,'Sam','Irmes','sirmes@gmail.com'),
	(15,2,'Sam','Irmes','sirmes@gmail.com'),
	(16,2,'Sam','Irmes','sirmes@gmail.com'),
	(17,2,'Sam','Irmes','sirmes@gmail.com'),
	(18,2,'Sam','Irmes','sirmes@gmail.com'),
	(19,2,'Sam','Irmes','sirmes@gmail.com'),
	(20,2,'Sam','Irmes','sirmes@gmail.com'),
	(21,2,'Sam','Irmes','sirmes@gmail.com'),
	(22,2,'Sam','Irmes','sirmes@gmail.com'),
	(23,2,'Sam','Irmes','sirmes@gmail.com'),
	(24,2,'Sam','Irmes','sirmes@gmail.com'),
	(25,2,'Sam','Irmes','sirmes@gmail.com'),
	(26,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(27,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(28,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(29,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(30,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(31,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(32,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(33,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(34,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(35,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(36,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(37,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(38,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(39,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(40,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(41,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(42,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(43,2,'Sam','irmes','sirmes@gmail.com'),
	(44,2,'Mr','Louis','louis.the.best@gmail,com');

/*!40000 ALTER TABLE `testers` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
