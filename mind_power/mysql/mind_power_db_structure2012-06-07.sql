# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.22)
# Database: mind_power
# Generation Time: 2012-06-07 09:07:46 -0400
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table average_score
# ------------------------------------------------------------

CREATE TABLE `average_score` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `score` double(11,1) NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table companies
# ------------------------------------------------------------

CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table leadership
# ------------------------------------------------------------

CREATE TABLE `leadership` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_strategic_management` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `active` varchar(1) DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table questions_answers
# ------------------------------------------------------------

CREATE TABLE `questions_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_strategic_management` int(11) NOT NULL,
  `id_leadership` int(11) NOT NULL,
  `answer_group` int(11) NOT NULL,
  `question` varchar(3000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table strategic_management
# ------------------------------------------------------------

CREATE TABLE `strategic_management` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `active` varchar(1) DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table testers
# ------------------------------------------------------------

CREATE TABLE `testers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `title` varchar(4) DEFAULT '',
  `name` varchar(120) NOT NULL DEFAULT '',
  `given_names` varchar(120) NOT NULL DEFAULT '',
  `gender` varchar(6) NOT NULL DEFAULT '',
  `email` varchar(120) NOT NULL DEFAULT '',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table testers_add_more
# ------------------------------------------------------------

CREATE TABLE `testers_add_more` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_tester` int(11) NOT NULL,
  `mobile` varchar(30) NOT NULL DEFAULT '',
  `job_title` varchar(120) NOT NULL DEFAULT '',
  `company_type` varchar(120) NOT NULL DEFAULT '',
  `country` varchar(120) NOT NULL DEFAULT '',
  `industry` varchar(120) NOT NULL DEFAULT '',
  `challenges` varchar(500) NOT NULL DEFAULT '',
  `goal` varchar(500) NOT NULL DEFAULT '',
  `passcode` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table testers_answers
# ------------------------------------------------------------

CREATE TABLE `testers_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_tester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table testers_answers_counts
# ------------------------------------------------------------

CREATE TABLE `testers_answers_counts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_tester` int(11) NOT NULL,
  `id_strategic_management` int(11) NOT NULL,
  `id_leadership` int(11) NOT NULL,
  `leadership_count` int(11) NOT NULL,
  `leadership_percentage` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
