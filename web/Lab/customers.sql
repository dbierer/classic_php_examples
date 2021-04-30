-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: zend
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `products_purchased` varchar(128) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `password` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'George','Stevenson','[\"77777\",\"16795\",\"16787\",\"88899\",\"16786\"]','gstevenson@nationaltech.net','$2y$10$q/ZscFf8lHnw6HWZj.4hdOiaik1fhlpMRCTzDAjOpffnoXjZyzj4u'),(2,'Janet','Levitz','[\"16781\",\"16776\",\"16779\",\"16756\",\"16771\",\"16789\"]','jlevitz@northwestcomm.com','$2y$10$O9kfkbbNNBbWpsdvWupev.G1XA8jGatQuWGRcDZqYihlB1Cu5Ykva'),(3,'Jason','Flores','[\"16768\",\"16795\",\"16802\",\"16786\",\"16762\",\"16770\",\"16778\",\"15752\",\"16761\"]','jflores@nationaltech.net','$2y$10$n1vQcvaJTN5pRffs4asIB.Xx3reRjsfebVVtEF1xCRt7v8.vmD6/2'),(4,'Susan','Chu','[\"16756\"]','schu@consolidatedtelco.com','$2y$10$MjP9i3TkqvF.AJKcW3dIz.rvMeWtXbUL/Nhcpe89aKzKkMJ325qcW'),(5,'Thomas','White','[\"16755\",\"16762\",\"77767\",\"16782\",\"16805\",\"16765\"]','twhite@nationalmedia.net','$2y$10$oBkpuGd3c9HCAjs3RNoO9OcdhAHoaYnIpNVRuUCrmVmRrMD/ZxEse'),(6,'Mark','Whitney','[\"16754\",\"14665\",\"16804\",\"16772\",\"16789\",\"16789\",\"15755\",\"16797\",\"77777\",\"16755\",\"16768\"]','mwhitney@southerntech.com','$2y$10$71LtA9XnQd2EXOf1/6A1eO/mr1c0Y1IyD3uCI8hWeluOgtPX9thSW');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'zend'
--

--
-- Dumping routines for database 'zend'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-28 12:36:28
