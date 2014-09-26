-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cominar
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


--
-- Table structure for table `_pluginNameHere__db`
--

DROP TABLE IF EXISTS `_pluginNameHere__db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_pluginNameHere__db` (
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_pluginNameHere__db`
--

LOCK TABLES `_pluginNameHere__db` WRITE;
/*!40000 ALTER TABLE `_pluginNameHere__db` DISABLE KEYS */;
INSERT INTO `_pluginNameHere__db` VALUES ('version','0');
/*!40000 ALTER TABLE `_pluginNameHere__db` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `_pluginNameHere___ctrlNameHere_s`
--

DROP TABLE IF EXISTS `_pluginNameHere___ctrlNameHere_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `_pluginNameHere___ctrlNameHere_s` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field1` varchar(128) CHARACTER SET utf8 NOT NULL,
  `field2` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='No comments.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_pluginNameHere___ctrlNameHere_s`
--

LOCK TABLES `_pluginNameHere___ctrlNameHere_s` WRITE;
/*!40000 ALTER TABLE `_pluginNameHere___ctrlNameHere_s` DISABLE KEYS */;
INSERT INTO `_pluginNameHere___ctrlNameHere_s` VALUES (1,'Data 1','Data 2','2014-06-03 14:02:52','2014-06-03 14:46:47');
/*!40000 ALTER TABLE `_pluginNameHere___ctrlNameHere_s` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-04 18:58:48
