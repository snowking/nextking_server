# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.9)
# Database: king
# Generation Time: 2012-10-26 07:14:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table nk_attachment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nk_attachment`;

CREATE TABLE `nk_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` int(11) unsigned DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `play_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table nk_randa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nk_randa`;

CREATE TABLE `nk_randa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) unsigned NOT NULL,
  `att_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table nk_record
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nk_record`;

CREATE TABLE `nk_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `uid` int(11) unsigned DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `content` varchar(512) DEFAULT NULL,
  `client` varchar(64) DEFAULT NULL,
  `create_time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table nk_relation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nk_relation`;

CREATE TABLE `nk_relation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `friend_uid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table nk_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nk_user`;

CREATE TABLE `nk_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(11) NOT NULL DEFAULT '',
  `search_key` varchar(255) DEFAULT NULL,
  `sign` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `birthday` bigint(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `company` varchar(64) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `create_time` bigint(20) DEFAULT NULL,
  `create_ip` varchar(255) DEFAULT NULL,
  `status` tinyint(6) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `nk_user` WRITE;
/*!40000 ALTER TABLE `nk_user` DISABLE KEYS */;

INSERT INTO `nk_user` (`id`, `account`, `password`, `name`, `search_key`, `sign`, `avatar`, `birthday`, `gender`, `company`, `location`, `city`, `mobile`, `email`, `create_time`, `create_ip`, `status`)
VALUES
	(1,'18602195219','decc8686654b465e5313259325149a86','king',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1350974281,'0.0.0.0',1),
	(2,'18658869960','decc8686654b465e5313259325149a86','fuying',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1350980463,'0.0.0.0',1);

/*!40000 ALTER TABLE `nk_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
