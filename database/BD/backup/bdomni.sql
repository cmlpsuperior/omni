-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: bdomni
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `idAddress` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerDate` datetime NOT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idClient` int(10) unsigned NOT NULL,
  `idZone` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idAddress`),
  KEY `address_idclient_foreign` (`idClient`),
  KEY `address_idzone_foreign` (`idZone`),
  CONSTRAINT `address_idclient_foreign` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  CONSTRAINT `address_idzone_foreign` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `idClient` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `names` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fatherLastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `motherLastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` datetime DEFAULT NULL,
  `documentNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerDate` datetime NOT NULL,
  `idDocumentType` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idClient`),
  UNIQUE KEY `client_documentnumber_unique` (`documentNumber`),
  UNIQUE KEY `client_email_unique` (`email`),
  KEY `client_iddocumenttype_foreign` (`idDocumentType`),
  CONSTRAINT `client_iddocumenttype_foreign` FOREIGN KEY (`idDocumentType`) REFERENCES `documenttype` (`idDocumentType`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Genérico','Pt','Mt','1990-12-20 00:00:00','0',NULL,'Masculino',NULL,'2016-12-24 00:00:00',1);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documenttype`
--

DROP TABLE IF EXISTS `documenttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documenttype` (
  `idDocumentType` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idDocumentType`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documenttype`
--

LOCK TABLES `documenttype` WRITE;
/*!40000 ALTER TABLE `documenttype` DISABLE KEYS */;
INSERT INTO `documenttype` VALUES (1,'DNI','Documento de identidad del ciudadano peruano.'),(2,'Pasaporte','Documento de identidad de los extrajeros.');
/*!40000 ALTER TABLE `documenttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driverlicense`
--

DROP TABLE IF EXISTS `driverlicense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driverlicense` (
  `idDriverLicense` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idDriverLicense`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driverlicense`
--

LOCK TABLES `driverlicense` WRITE;
/*!40000 ALTER TABLE `driverlicense` DISABLE KEYS */;
INSERT INTO `driverlicense` VALUES (1,'A-I','Vehículos pequeños.'),(2,'A-II','Vehículos medianos.'),(3,'A-III','Vehículos pesados.');
/*!40000 ALTER TABLE `driverlicense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `idEmployee` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `names` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fatherLastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `motherLastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` datetime NOT NULL,
  `documentNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entryDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `idDocumentType` int(10) unsigned NOT NULL,
  `idDriverLicense` int(10) unsigned DEFAULT NULL,
  `idPosition` int(10) unsigned NOT NULL,
  `idUser` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idEmployee`),
  UNIQUE KEY `employee_documentnumber_unique` (`documentNumber`),
  UNIQUE KEY `employee_email_unique` (`email`),
  KEY `employee_iddocumenttype_foreign` (`idDocumentType`),
  KEY `employee_iddriverlicense_foreign` (`idDriverLicense`),
  KEY `employee_idposition_foreign` (`idPosition`),
  KEY `employee_iduser_foreign` (`idUser`),
  CONSTRAINT `employee_iddocumenttype_foreign` FOREIGN KEY (`idDocumentType`) REFERENCES `documenttype` (`idDocumentType`),
  CONSTRAINT `employee_iddriverlicense_foreign` FOREIGN KEY (`idDriverLicense`) REFERENCES `driverlicense` (`idDriverLicense`),
  CONSTRAINT `employee_idposition_foreign` FOREIGN KEY (`idPosition`) REFERENCES `position` (`idPosition`),
  CONSTRAINT `employee_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Henry Antonio','Espinoza','Torres','1990-12-20 00:00:00','46618582','henryespinozat@gmail.com','Activo','Masculino','930414373','2016-01-01 00:00:00',NULL,1,NULL,1,1);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `idItem` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(15,2) NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `realStock` double(15,2) NOT NULL,
  `availableStock` double(15,2) NOT NULL,
  `idUnit` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idItem`),
  KEY `item_idunit_foreign` (`idUnit`),
  CONSTRAINT `item_idunit_foreign` FOREIGN KEY (`idUnit`) REFERENCES `unit` (`idUnit`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Cemento sol',28.35,'Activo',0.00,0.00,1),(2,'Cemento andino',30.50,'Activo',0.00,0.00,1),(3,'Arena fina',45.00,'Activo',0.00,0.00,2),(4,'Arena gruesa',50.00,'Activo',0.00,0.00,2),(5,'Fierro de 1/2 siderperu',32.50,'Activo',0.00,0.00,4);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemxorder`
--

DROP TABLE IF EXISTS `itemxorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemxorder` (
  `idOrder` int(10) unsigned NOT NULL,
  `idItem` int(10) unsigned NOT NULL,
  `quantity` double(15,2) NOT NULL,
  `unitPrice` double(15,2) NOT NULL,
  PRIMARY KEY (`idOrder`,`idItem`),
  KEY `itemxorder_iditem_foreign` (`idItem`),
  CONSTRAINT `itemxorder_iditem_foreign` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`),
  CONSTRAINT `itemxorder_idorder_foreign` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idOrder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemxorder`
--

LOCK TABLES `itemxorder` WRITE;
/*!40000 ALTER TABLE `itemxorder` DISABLE KEYS */;
INSERT INTO `itemxorder` VALUES (2,1,4.00,28.35),(2,2,3.00,30.50),(2,4,5.00,50.00),(3,1,2.00,28.35),(3,2,1.00,30.50),(3,4,10.00,50.00),(3,5,5.00,32.50),(4,2,2.00,30.50),(4,3,4.00,45.00),(4,4,5.00,100.00),(5,1,4.00,28.35),(5,2,5.00,30.50),(5,3,5.00,80.00),(5,4,1.00,80.00),(6,1,5.00,28.35),(6,2,25.00,30.50),(6,3,5.00,80.00),(6,4,1.00,80.00),(8,3,6.00,45.00),(9,3,7.00,80.00),(9,4,7.00,80.00),(10,1,10.00,28.35),(10,2,2.00,30.50),(10,3,5.00,80.00),(10,4,4.00,80.00),(11,2,10.00,30.50),(11,4,10.00,80.00),(12,1,4.00,28.35),(12,2,6.00,30.50),(13,1,31.00,28.35),(13,2,15.00,30.50),(13,3,12.00,80.00),(13,4,5.00,80.00),(14,1,4.00,28.35),(14,2,3.00,30.50),(14,3,1.00,45.00),(14,4,2.00,100.00),(14,5,5.00,32.50),(15,1,10.00,28.35),(15,2,4.00,30.50),(15,3,2.00,45.00),(15,4,1.00,100.00),(16,3,5.00,70.00),(17,4,5.00,50.00),(18,1,10.00,28.35),(18,2,15.00,30.50),(18,3,5.00,45.00),(18,5,15.00,32.50),(19,1,10.00,28.35),(19,2,1.00,30.50),(19,3,5.00,45.00),(19,4,12.00,100.00),(21,1,1.00,28.35),(21,2,2.00,30.50),(21,5,5.00,32.50),(22,3,5.00,80.00),(22,4,5.00,80.00),(23,1,18.00,28.35),(23,2,5.00,30.50),(23,3,5.00,80.00),(24,3,5.00,80.00),(24,4,5.00,80.00);
/*!40000 ALTER TABLE `itemxorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemxzone`
--

DROP TABLE IF EXISTS `itemxzone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemxzone` (
  `idItem` int(10) unsigned NOT NULL,
  `idZone` int(10) unsigned NOT NULL,
  `price` double(15,2) NOT NULL,
  PRIMARY KEY (`idItem`,`idZone`),
  KEY `itemxzone_idzone_foreign` (`idZone`),
  CONSTRAINT `itemxzone_iditem_foreign` FOREIGN KEY (`idItem`) REFERENCES `item` (`idItem`),
  CONSTRAINT `itemxzone_idzone_foreign` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemxzone`
--

LOCK TABLES `itemxzone` WRITE;
/*!40000 ALTER TABLE `itemxzone` DISABLE KEYS */;
INSERT INTO `itemxzone` VALUES (2,2,50.00),(2,3,35.00),(3,1,50.00),(3,3,80.00),(3,4,70.00),(4,2,100.00),(4,3,80.00);
/*!40000 ALTER TABLE `itemxzone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (135,'2014_10_12_000000_create_users_table',1),(136,'2016_12_17_172211_create_position_table',1),(137,'2016_12_17_172439_create_driverLicense_table',1),(138,'2016_12_17_183311_create_documentType_table',1),(139,'2016_12_17_183411_create_employee_table',1),(140,'2016_12_20_194013_create_unit_table',1),(141,'2016_12_20_194213_create_item_table',1),(142,'2016_12_21_083440_create_zone_table',1),(143,'2016_12_21_083848_create_itemXZone_table',1),(144,'2016_12_24_105151_create_client_table',1),(145,'2016_12_24_110935_create_address_table',1),(146,'2016_12_25_201254_create_order_table',1),(147,'2016_12_25_201305_create_itemXOrder_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `idOrder` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerDate` datetime NOT NULL,
  `totalAmount` double(15,2) NOT NULL,
  `receivedAmount` double(15,2) NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idClient` int(10) unsigned DEFAULT NULL,
  `idZone` int(10) unsigned NOT NULL,
  `idEmployee` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idOrder`),
  KEY `order_idclient_foreign` (`idClient`),
  KEY `order_idzone_foreign` (`idZone`),
  KEY `order_idemployee_foreign` (`idEmployee`),
  CONSTRAINT `order_idclient_foreign` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  CONSTRAINT `order_idemployee_foreign` FOREIGN KEY (`idEmployee`) REFERENCES `employee` (`idEmployee`),
  CONSTRAINT `order_idzone_foreign` FOREIGN KEY (`idZone`) REFERENCES `zone` (`idZone`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (2,NULL,NULL,'2016-12-27 16:54:42',454.90,500.00,'Confirmado',NULL,4,1),(3,NULL,NULL,'2016-12-27 16:57:25',749.70,800.00,'Confirmado',NULL,4,1),(4,NULL,NULL,'2016-12-27 17:13:32',741.00,800.00,'Confirmado',NULL,2,1),(5,NULL,NULL,'2016-12-27 17:37:39',745.90,800.00,'Confirmado',NULL,3,1),(6,NULL,NULL,'2016-12-27 17:39:21',1384.25,1300.00,'Confirmado',NULL,3,1),(8,NULL,NULL,'2016-12-27 18:03:32',270.00,300.00,'Confirmado',NULL,2,1),(9,NULL,NULL,'2016-12-27 18:04:44',1120.00,2000.00,'Confirmado',NULL,3,1),(10,NULL,NULL,'2016-12-27 18:05:47',1064.50,1100.00,'Confirmado',NULL,3,1),(11,NULL,NULL,'2016-12-27 18:07:46',1105.00,1200.00,'Confirmado',NULL,3,1),(12,NULL,NULL,'2016-12-27 18:08:20',296.40,200.00,'Confirmado',NULL,4,1),(13,'edward','d1 lt5','2016-12-27 20:07:50',2696.35,3000.00,'Anulado',NULL,3,1),(14,NULL,NULL,'2016-12-27 21:19:15',612.40,640.00,'Anulado',NULL,2,1),(15,'henry','f4 lt11','2016-12-28 00:08:38',595.50,550.00,'Confirmado',NULL,2,1),(16,NULL,NULL,'2016-12-28 00:12:19',350.00,400.00,'Confirmado',NULL,4,1),(17,NULL,NULL,'2016-12-28 00:20:33',250.00,300.00,'Confirmado',NULL,1,1),(18,'henry','D1 LT 5','2016-12-28 10:09:08',1453.50,1500.00,'Confirmado',NULL,2,1),(19,'henry','MZ D1 LT 5','2016-12-28 10:17:21',1739.00,1500.00,'Confirmado',NULL,2,1),(21,NULL,NULL,'2016-12-28 10:42:21',251.85,270.00,'Confirmado',NULL,4,1),(22,NULL,'MZ D5 LT 6','2016-12-28 10:44:24',800.00,1000.00,'Confirmado',NULL,3,1),(23,NULL,NULL,'2016-12-28 11:26:05',1062.80,1500.00,'Confirmado',NULL,3,1),(24,NULL,NULL,'2016-12-28 14:04:22',800.00,1000.00,'Confirmado',NULL,3,1);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `idPosition` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPosition`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,'Administrador del sistema','Responsable del sistema de información.'),(2,'Administrador','Resposable del personal de la empresa.'),(3,'Chofer','Encargado de enviar los pedidos.'),(4,'Cajero','Encargado de recibir los pedidos.'),(5,'Almacenero','Encargado del almacen.');
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `idUnit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idUnit`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'bolsa'),(2,'m3'),(3,'unidad'),(4,'varilla'),(5,'otro'),(6,'kg');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'46618582','$2y$10$YnHlBfN9XLoo7bSJM8zTKu6p9Bwjlyl6ZQ6QeaCAGvZo1qDCZmCRC','fRSE0lA8e7TuIEuI0uyzUjBxPwujvYNAHqt84x6V1W4y5U4IPnjJWQJGnrSN','2016-12-26 01:38:44','2016-12-28 19:27:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zone` (
  `idZone` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shipping` double(15,2) NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idZone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zone`
--

LOCK TABLES `zone` WRITE;
/*!40000 ALTER TABLE `zone` DISABLE KEYS */;
INSERT INTO `zone` VALUES (1,'10 de octubre',0.00,'Activo'),(2,'Platanitos',20.00,'Activo'),(3,'Cristo rey',10.00,'Activo'),(4,'Casa blanca',5.00,'Activo');
/*!40000 ALTER TABLE `zone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-28 15:29:15
