# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.22)
# Database: mind_power
# Generation Time: 2012-05-09 22:14:47 -0400
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

DROP TABLE IF EXISTS `average_score`;

CREATE TABLE `average_score` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `score` double(11,1) NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `average_score` WRITE;
/*!40000 ALTER TABLE `average_score` DISABLE KEYS */;

INSERT INTO `average_score` (`id`, `score`)
VALUES
	(1,111.0);

/*!40000 ALTER TABLE `average_score` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`id`, `name`, `active`)
VALUES
	(1,'Sony','A'),
	(2,'Apple','A'),
	(3,'LG','I'),
	(4,'Saks','A'),
	(5,'Typesafe','I'),
	(6,'test','I'),
	(7,'Oracle','I'),
	(8,'MindPower','A'),
	(9,'Mind 2-changes','I');

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table leadership
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leadership`;

CREATE TABLE `leadership` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_strategic_management` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `active` varchar(1) DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

LOCK TABLES `leadership` WRITE;
/*!40000 ALTER TABLE `leadership` DISABLE KEYS */;

INSERT INTO `leadership` (`id`, `id_strategic_management`, `name`, `active`)
VALUES
	(1,3,'mP Belief','A'),
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


# Dump of table questions_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `questions_answers`;

CREATE TABLE `questions_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_strategic_management` int(11) NOT NULL,
  `id_leadership` int(11) NOT NULL,
  `answer_group` int(11) NOT NULL,
  `question` varchar(3000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=416 DEFAULT CHARSET=latin1;

LOCK TABLES `questions_answers` WRITE;
/*!40000 ALTER TABLE `questions_answers` DISABLE KEYS */;

INSERT INTO `questions_answers` (`id`, `id_strategic_management`, `id_leadership`, `answer_group`, `question`)
VALUES
	(1,4,1,1,'I am principle-oriented and make certain that specific goals, plans and milestones are set'),
	(2,3,2,1,'I make people feel that they really are contributing members of a team'),
	(3,2,3,2,'I have a competitive edge and a will to win'),
	(4,2,5,2,'I have excellent observation skills and insight'),
	(5,3,2,3,'I instill confidence in others and empower them to take initiative'),
	(6,3,6,3,'I follow through on promises and commitments'),
	(7,1,2,4,'I make people feel that they really are contributing members of a team'),
	(8,1,1,4,'I act with integrity and honesty nearly all the time'),
	(9,1,3,5,'I have real business know-how and a broad perspective on how business deals are done'),
	(10,3,9,5,'I work to resolve conflict among team members by showing respect for others\' opinions'),
	(11,3,1,6,'I stand up for what is right in terms of leading and developing people even when there may be a personal cost in doing so'),
	(12,3,9,6,'I encourage and embrace diversity of thought, perception, background and experience'),
	(13,2,6,7,'I follow through on promises and commitments'),
	(14,1,2,7,'I pay attention to what people are achieving and build an infrastructure that rewards accordingly'),
	(15,2,5,8,'I constantly analyze and stay up to date with competitor\'s information'),
	(16,2,6,8,'I anticipate and prepare for problems and obstacles in a manner that enables success'),
	(17,2,6,9,'I use cost-benefit thinking to set priorities'),
	(18,3,9,9,'I am able to synergize different points of view to obtain a win-win situation'),
	(19,1,4,10,'I can feel others\' pain and think in their shoes'),
	(20,1,3,10,'I have a competitive edge and a will to win'),
	(21,3,9,11,'I involve others in shaping plans and make them function in a collaborative fashion'),
	(22,3,8,11,'I dare to take risks and embrace entrepreneurial spirit'),
	(23,3,8,12,'I take challenges proactively and use set-back as a driving force'),
	(24,1,4,12,'I have a feel for everything and am able to move others with my words and actions'),
	(25,2,7,13,'I apply creative and innovative solutions to problems in achieving my goals'),
	(26,1,3,13,'I see changes as an opportunity'),
	(27,3,9,14,'I encourage and embrace diversity of thought, perception, background and experience'),
	(28,3,1,14,'I am principle-oriented and make certain that specific goals, plans and milestones are set'),
	(29,2,7,15,'I enjoy pioneering new concepts and often think \"out-of-the-box\"'),
	(30,2,6,15,'I anticipate problems and always prepare back-up plans'),
	(31,2,5,16,'I have strong analytical power and dig deep for solutions'),
	(32,1,4,16,'I instill passion by painting a vivid picture of the future'),
	(33,2,6,17,'I am careful at assessing risk factors at work before actively seeking for solutions and taking actions'),
	(34,1,3,17,'I inspire people to achieve more than they may ever have dreamed possible'),
	(35,2,5,18,'I consider alternative solutions before making decisions'),
	(36,3,1,18,'I strengthen a value-based culture'),
	(37,3,1,19,'I make the organisation\'s interests a priority'),
	(38,2,7,19,'I encourage creative thinking and cross-functional brainstorming'),
	(39,3,9,20,'I work to resolve conflict among team members by showing respect for others\' opinions'),
	(40,1,3,20,'I am self-motivated and strive for excellence'),
	(41,3,8,21,'I have the \'edge\' to make and take tough decisions'),
	(42,3,9,21,'I involve others in shaping plans and make them function in a collaborative fashion'),
	(43,2,6,22,'I regularly review individual\'s performance and job progress both formally and informally'),
	(44,2,7,22,'I enjoy pioneering new concepts and often think \"out-of-the-box\"'),
	(45,3,1,23,'I am earnest and self-disciplined'),
	(46,1,4,23,'I connect the company vision with that of individuals'),
	(48,1,2,24,'I support others to maximise their potential'),
	(318,3,9,24,'I effectively identify and manage potential conflicts to prevent disagreements from arising'),
	(319,2,6,25,'I anticipate and prepare for problems and obstacles in a manner that enables success'),
	(320,2,5,25,'I always seek for the truth and lead others to change'),
	(321,3,8,26,'I act quickly and decisively in a crisis or other time-sensitive situation'),
	(322,1,2,26,'I support others to maximise their potential'),
	(323,2,7,27,'I give persuasive ideas and speak with energy and enthusiasm'),
	(324,1,4,27,'I see the uncommon in common things and turn them into creative inspirations to touch others'),
	(325,1,2,28,'I identify others\' development needs and utilise their strengths'),
	(326,3,8,28,'I challenge people to try new approaches'),
	(327,3,9,29,'I foster an environment that supports the smooth implementation of new approaches'),
	(328,2,5,29,'I constantly analyze and stay up to date with competitor\'s information'),
	(329,1,3,30,'I show determination to achieve goals over time and resists any pressure to be deflected from this attainment'),
	(330,3,1,30,'I am earnest and self-disciplined'),
	(331,1,4,31,'I instill passion by painting a vivid picture of the future'),
	(332,2,6,31,'I reserve sufficient resources and manpower to ensure strategic priorities can be achieved'),
	(333,3,8,32,'I dare to take risks and embrace entrepreneurial spirit'),
	(334,3,1,32,'I stand up for what is right in terms of leading and developing people even when there may be a personal cost in doing so'),
	(335,3,9,33,'I am able to synergize different points of view to obtain a win-win situation'),
	(336,2,6,33,'I regularly review individual\'s performance and job progress both formally and informally'),
	(337,2,5,34,'I am able to turn abstract concept and data into practical solutions'),
	(338,3,9,34,'I foster an environment that supports the smooth implementation of new approaches'),
	(339,1,4,35,'I connect the company vision with that of individuals'),
	(340,3,1,35,'I provide clear direction and define priorities for the team'),
	(341,1,3,36,'I inspire people to achieve more than they may ever have dreamed possible'),
	(342,2,7,36,'I apply creative and innovative solutions to problems in achieving my goals'),
	(343,3,9,37,'I effectively identify and manage potential conflicts to prevent disagreements from arising'),
	(344,1,2,37,'I coach others to identify their development needs through feedback and discussion'),
	(345,1,2,38,'I help others to navigate through change and motivate them to achieve specific goals'),
	(346,2,5,38,'I make sound decisions based on collecting and analyzing all available information'),
	(347,2,6,39,'I am responsible and make decisions for the good of the company'),
	(348,3,1,39,'I make the organisation\'s interests a priority'),
	(349,2,7,40,'I can feel others\' pain and think in their shoes'),
	(350,3,9,40,'I mediate others to see different views to reach win-win solutions'),
	(351,3,8,41,'I challenge people to try new approaches'),
	(352,1,3,41,'I have real business know-how and a broad perspective on how business deals are done'),
	(353,2,5,42,'I make sound decisions based on collecting and analyzing all available information'),
	(354,1,2,42,'I instill confidence in others and empower them to take initiative'),
	(355,1,4,43,'I come up with new ways of explaining something complex and see beyond the obvious'),
	(356,2,7,43,'I give persuasive ideas and speak with energy and enthusiasm'),
	(357,3,1,44,'I strengthen a value-based culture'),
	(358,2,6,44,'I am responsible and make decisions for the good of the company'),
	(359,3,9,45,'I have the ability to unite different parties and form a vision-aligned team'),
	(360,1,4,45,'I bring originality to the enterprise and inspire others to follow'),
	(361,2,7,46,'I am resourceful and use networks to get things done'),
	(362,1,2,46,'I identify others\' development needs and utilise their strengths'),
	(363,3,8,47,'I have good coping skills when facing difficulties and am resillient in a range of complex and demanding situations'),
	(364,2,5,47,'I am able to turn abstract concept and data into practical solutions'),
	(365,3,1,48,'I act with integrity and honesty nearly all the time'),
	(366,1,3,48,'I show determination to achieve goals over time and resists any pressure to be deflected from this attainment'),
	(367,2,6,49,'I reserve sufficient resources and manpower to ensure strategic priorities can be achieved'),
	(368,1,4,49,'I come up with new ways of explaining something complex and see beyond the obvious'),
	(369,2,5,50,'I have excellent observation skills and insight '),
	(370,1,3,50,'I am goal-oriented and am willing to go the extra mile to achieve the task'),
	(371,1,3,51,'I see changes as an opportunity'),
	(372,3,8,51,'I take challenges proactively and use set-back as a driving force'),
	(373,1,2,52,'I pay attention to what people are achieving and build an infrastructure that rewards accordingly'),
	(374,2,7,52,'I am resourceful and use networks to get things done'),
	(375,1,3,53,'I am goal-oriented and am willing to go the extra mile to achieve the task'),
	(376,2,6,53,'I am careful at assessing risk factors at work before actively seeking for solutions and taking actions'),
	(377,3,1,54,'I regularly review team performance against objectives'),
	(378,3,8,54,'I act quickly and decisively in a crisis or other time-sensitive situation'),
	(379,1,3,55,'I am self-motivated and strive for excellence'),
	(380,1,4,55,'I can feel others\' pain and think in their shoes'),
	(381,3,8,56,'I am open to receive criticism and challenges from others'),
	(382,2,7,56,'I can feel others\' pain and think in their shoes'),
	(383,1,4,57,'I bring originality to the enterprise and inspire others to follow'),
	(384,2,5,57,'I have strong analytical power and dig deep for solutions'),
	(385,1,2,58,'I coach others to identify their development needs through feedback and discussion'),
	(386,1,3,58,'I am self-assertive and driven to excel'),
	(387,3,1,59,'I provide clear direction and define priorities for the team'),
	(388,2,5,59,'I consider alternative solutions before making decisions'),
	(389,1,3,60,'I am self-assertive and driven to excel'),
	(390,1,2,60,'I understand others\' perspective and take active interest in their concerns to build long term relationship'),
	(391,1,4,61,'I have a feel for everything and am able to move others with my words and actions'),
	(392,3,9,61,'I have the ability to unite different parties and form a vision-aligned team'),
	(393,2,5,62,'I always seek for the truth and lead others to change'),
	(394,2,7,62,'I often look to the future and am able to see new opportunities'),
	(395,1,2,63,'I understand others\' perspective and take active interest in their concerns to build long term relationship'),
	(396,1,4,63,'I can touch others with my original ideas'),
	(397,3,9,64,'I mediate others to see different views to reach win-win solutions'),
	(398,2,7,64,'I remain calm and emotional competent when faced with demanding situations'),
	(399,2,5,65,'I use strong analytical skills to solve multi-dimensional problems'),
	(400,3,8,65,'I view conflict as an opportunity to learn and grow'),
	(401,1,4,66,'I can touch others with my original ideas'),
	(402,1,2,66,'I help others to navigate through change and motivate them to achieve specific goals'),
	(403,2,7,67,'I often look to the future and am able to see new opportunities'),
	(404,2,5,67,'I use strong analytical skills to solve multi-dimensional problems'),
	(405,2,6,68,'I anticipate problems and always prepare back-up plans'),
	(406,3,8,68,'I am open to receive criticism and challenges from others'),
	(407,3,8,69,'I view conflict as an opportunity to learn and grow'),
	(408,2,6,69,'I use cost-benefit thinking to set priorities'),
	(409,2,7,70,'I encourage creative thinking and cross-functional brainstorming'),
	(410,3,1,70,'I regularly review team performance against objectives'),
	(411,2,7,71,'I remain calm and emotional competent when faced with demanding situations'),
	(412,3,8,71,'I have the \'edge\' to make and take tough decisions'),
	(413,1,4,72,'I see the uncommon in common things and turn them into creative inspirations to touch others'),
	(414,3,8,72,'I have good coping skills when facing difficulties and am resillient in a range of complex and demanding situations'),
	(415,4,1,73,'New question/answer test');

/*!40000 ALTER TABLE `questions_answers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table strategic_management
# ------------------------------------------------------------

DROP TABLE IF EXISTS `strategic_management`;

CREATE TABLE `strategic_management` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `active` varchar(1) DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

LOCK TABLES `strategic_management` WRITE;
/*!40000 ALTER TABLE `strategic_management` DISABLE KEYS */;

INSERT INTO `strategic_management` (`id`, `name`, `active`)
VALUES
	(1,'Strategic People Management','A'),
	(2,'Strategic Inovation Management','A'),
	(3,'Strategic Execution Management','A');

/*!40000 ALTER TABLE `strategic_management` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

LOCK TABLES `testers` WRITE;
/*!40000 ALTER TABLE `testers` DISABLE KEYS */;

INSERT INTO `testers` (`id`, `id_company`, `title`, `name`, `email`)
VALUES
	(41,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(42,2,'Mrrr','Samuel','sirmes@gmail.com'),
	(43,2,'Sam','irmes','sirmes@gmail.com'),
	(44,2,'Mr','Louis','louis.the.best@gmail,com'),
	(45,2,'Mr','Sam','sirmes@gmail.com'),
	(46,2,'Mr','Sam','sirmes@gmail.com'),
	(47,2,'Mr','Uman','uman@work.com'),
	(48,8,'Ms','Antonia','aa@gmail.com');

/*!40000 ALTER TABLE `testers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table testers_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `testers_answers`;

CREATE TABLE `testers_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_tester` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;

LOCK TABLES `testers_answers` WRITE;
/*!40000 ALTER TABLE `testers_answers` DISABLE KEYS */;

INSERT INTO `testers_answers` (`id`, `id_question`, `id_tester`)
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
	(37,8,44),
	(38,10,45),
	(39,4,45),
	(40,6,45),
	(41,1,46),
	(42,3,46),
	(43,5,46),
	(44,7,46),
	(45,10,46),
	(46,11,46),
	(47,2,47),
	(48,4,47),
	(49,6,47),
	(50,7,47),
	(51,279,47),
	(52,282,47),
	(53,284,47),
	(54,286,47),
	(55,287,47),
	(56,289,47),
	(57,292,47),
	(58,294,47),
	(59,296,47),
	(60,298,47),
	(61,300,47),
	(62,302,47),
	(63,304,47),
	(64,306,47),
	(65,308,47),
	(66,310,47),
	(67,312,47),
	(68,314,47),
	(69,316,47),
	(70,318,47),
	(71,320,47),
	(72,322,47),
	(73,324,47),
	(74,326,47),
	(75,328,47),
	(76,330,47),
	(77,332,47),
	(78,334,47),
	(79,336,47),
	(80,338,47),
	(81,340,47),
	(82,342,47),
	(83,344,47),
	(84,346,47),
	(85,347,47),
	(86,349,47),
	(87,352,47),
	(88,354,47),
	(89,356,47),
	(90,358,47),
	(91,360,47),
	(92,362,47),
	(93,364,47),
	(94,365,47),
	(95,367,47),
	(96,369,47),
	(97,371,47),
	(98,373,47),
	(99,375,47),
	(100,377,47),
	(101,379,47),
	(102,381,47),
	(103,383,47),
	(104,385,47),
	(105,387,47),
	(106,390,47),
	(107,392,47),
	(108,394,47),
	(109,396,47),
	(110,398,47),
	(111,400,47),
	(112,402,47),
	(113,404,47),
	(114,406,47),
	(115,408,47),
	(116,410,47),
	(117,412,47),
	(118,413,47),
	(119,1,48),
	(120,3,48),
	(121,5,48),
	(122,7,48),
	(123,279,48),
	(124,281,48),
	(125,283,48),
	(126,285,48),
	(127,287,48),
	(128,289,48),
	(129,291,48),
	(130,293,48),
	(131,295,48),
	(132,297,48),
	(133,299,48),
	(134,301,48),
	(135,303,48),
	(136,305,48),
	(137,307,48),
	(138,309,48),
	(139,311,48),
	(140,313,48),
	(141,315,48),
	(142,317,48),
	(143,319,48),
	(144,321,48),
	(145,323,48),
	(146,325,48),
	(147,327,48),
	(148,329,48),
	(149,331,48),
	(150,333,48),
	(151,335,48),
	(152,337,48),
	(153,339,48),
	(154,341,48),
	(155,343,48),
	(156,345,48),
	(157,347,48),
	(158,349,48),
	(159,351,48),
	(160,353,48),
	(161,355,48),
	(162,357,48),
	(163,359,48),
	(164,361,48),
	(165,363,48),
	(166,365,48),
	(167,367,48),
	(168,369,48),
	(169,371,48),
	(170,373,48),
	(171,375,48),
	(172,377,48),
	(173,379,48),
	(174,381,48),
	(175,383,48),
	(176,385,48),
	(177,387,48),
	(178,389,48),
	(179,391,48),
	(180,393,48),
	(181,395,48),
	(182,397,48),
	(183,399,48),
	(184,401,48),
	(185,403,48),
	(186,405,48),
	(187,407,48),
	(188,409,48),
	(189,411,48),
	(190,413,48);

/*!40000 ALTER TABLE `testers_answers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table testers_answers_counts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `testers_answers_counts`;

CREATE TABLE `testers_answers_counts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_tester` int(11) NOT NULL,
  `id_strategic_management` int(11) NOT NULL,
  `id_leadership` int(11) NOT NULL,
  `leadership_count` int(11) NOT NULL,
  `leadership_percentage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

LOCK TABLES `testers_answers_counts` WRITE;
/*!40000 ALTER TABLE `testers_answers_counts` DISABLE KEYS */;

INSERT INTO `testers_answers_counts` (`id`, `id_tester`, `id_strategic_management`, `id_leadership`, `leadership_count`, `leadership_percentage`)
VALUES
	(1,46,1,2,5,30),
	(2,46,1,3,5,30),
	(3,46,2,2,5,40),
	(4,46,1,2,2,25),
	(5,46,2,2,2,25),
	(6,46,3,3,2,25),
	(7,46,2,2,2,25),
	(8,0,0,0,2,3),
	(9,0,0,0,3,4),
	(10,0,0,0,4,6),
	(11,0,0,0,5,7),
	(12,0,0,0,6,8),
	(13,0,0,0,7,10),
	(14,0,0,0,8,11),
	(15,0,0,0,9,13),
	(16,0,0,0,10,14),
	(17,48,3,1,8,11),
	(18,48,1,2,8,11),
	(19,48,1,3,8,11),
	(20,48,1,4,8,11),
	(21,48,2,5,8,11),
	(22,48,2,6,8,11),
	(23,48,2,7,8,11),
	(24,48,3,8,8,11),
	(25,48,3,9,8,11),
	(26,0,0,0,2,3),
	(27,0,0,0,3,4),
	(28,0,0,0,4,6),
	(29,0,0,0,5,7),
	(30,0,0,0,6,8),
	(31,0,0,0,7,10),
	(32,0,0,0,8,11),
	(33,0,0,0,9,13),
	(34,0,0,0,10,14);

/*!40000 ALTER TABLE `testers_answers_counts` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
