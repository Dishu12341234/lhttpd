-- MySQL dump 10.13  Distrib 5.7.24, for osx11.1 (x86_64)
--
-- Host: localhost    Database: time_it
-- ------------------------------------------------------
-- Server version	8.4.2

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
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `CurrentMonth` varchar(3) DEFAULT NULL,
  `CurrentYear` int DEFAULT NULL,
  `CurrentDayIndex` int DEFAULT NULL,
  `CurrentTime` varchar(60) DEFAULT NULL,
  `CurrentStatus` varchar(10) DEFAULT NULL,
  `TODO` varchar(255) DEFAULT NULL,
  `TimeStudied` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES ('Oct',2024,1,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,2,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,3,'22:22:50 -5.5','inactive','Enter Here',97),('Oct',2024,4,'20:55:9 -5.5','inactive','HCV',152),('Oct',2024,5,'22:58:2 -5.5','inactive','Enter Here',117),('Oct',2024,6,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,7,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,8,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,9,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,10,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,11,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,12,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,13,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,14,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,15,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,16,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,17,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,18,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,19,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,20,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,21,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,22,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,23,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,24,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,25,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,26,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,27,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,28,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,29,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,30,' 08:08:49 +05:30','Inactive','',0),('Oct',2024,31,' 08:08:49 +05:30','Inactive','',0);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-06 21:24:42
