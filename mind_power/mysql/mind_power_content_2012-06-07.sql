# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.22)
# Database: mind_power
# Generation Time: 2012-06-07 09:10:39 -0400
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table leadership
# ------------------------------------------------------------

LOCK TABLES `leadership` WRITE;
/*!40000 ALTER TABLE `leadership` DISABLE KEYS */;

INSERT INTO `leadership` (`id`, `id_strategic_management`, `name`, `active`)
VALUES
	(1,3,'mP Value','A'),
	(2,1,'mP Empathy','A'),
	(3,1,'mP Excellence','A'),
	(4,1,'mP Touch','A'),
	(5,2,'mP Truth','A'),
	(6,2,'mP Assessment','A'),
	(7,2,'mP Abundance','A'),
	(8,3,'mP Valor','A'),
	(9,3,'mP Unity','A');

/*!40000 ALTER TABLE `leadership` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table strategic_management
# ------------------------------------------------------------

LOCK TABLES `strategic_management` WRITE;
/*!40000 ALTER TABLE `strategic_management` DISABLE KEYS */;

INSERT INTO `strategic_management` (`id`, `name`, `active`)
VALUES
	(1,'Self & People Management','A'),
	(2,'Business Innovation','A'),
	(3,'Strategic Execution','A');

/*!40000 ALTER TABLE `strategic_management` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
