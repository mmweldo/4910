-- MySQL dump 10.13  Distrib 5.6.42, for Linux (x86_64)
--
-- Host: db-group-instance.cp7roxttzlg6.us-east-1.rds.amazonaws.com    Database: website
-- ------------------------------------------------------
-- Server version	5.6.40

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
-- Current Database: `website`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `website` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `website`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `profile_img` varchar(100) DEFAULT 'https://iaia.edu/wp-content/uploads/female_silhouette.png',
  PRIMARY KEY (`user_id`),
  KEY `fk_admins_password_users_password` (`password`),
  KEY `ix_user_id` (`user_id`),
  KEY `ix_sponsor_username` (`username`),
  CONSTRAINT `fk_admins_password_users_password` FOREIGN KEY (`password`) REFERENCES `users` (`password`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_admins_userid_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_admins_username_user_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'testAdmin','$2y$10$X1f9v1dp4V9qavP3wOygkefoHMfQ5fIiZQzBVObPvgztn/I5hDMJ6','test','Test','https://iaia.edu/wp-content/uploads/female_silhouette.png'),(52,'admin1','$2y$10$OcUehV4bn8Mcv32pD2qXsOgcYOHgCPKOhxXl1D21g4d0OOfSau2XW','admin','admin','https://iaia.edu/wp-content/uploads/female_silhouette.png');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `sponsor_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  PRIMARY KEY (`sponsor_id`,`driver_id`),
  KEY `FK_app_driverid_drivers_userid` (`driver_id`),
  CONSTRAINT `FK_app_driverid_drivers_userid` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`user_id`),
  CONSTRAINT `FK_app_sponsorid_sponsors_userid` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (46,47,'approved'),(46,48,'approved'),(46,53,'approved');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `sponsor_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `price` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`driver_id`,`sponsor_id`,`title`),
  KEY `fk_cart_sponsorid_sponsors_userid` (`sponsor_id`),
  KEY `fk_cart_title_products_title` (`title`),
  KEY `ix_amount` (`amount`),
  CONSTRAINT `fk_cart_driverid_drivers_userid` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_sponsorid_sponsors_userid` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cart_title_products_title` FOREIGN KEY (`title`) REFERENCES `products` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (46,48,'Wireless Bluetooth Keyboard For iOS Android Windows Mac OS PC Tablet Smartphone',2,'13.99');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver_list`
--

DROP TABLE IF EXISTS `driver_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver_list` (
  `sponsor_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `driver_username` varchar(30) NOT NULL,
  `total_points` double NOT NULL DEFAULT '0',
  `current_points` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`sponsor_id`,`driver_id`),
  KEY `fk_dl_driverid_drivers_id` (`driver_id`),
  KEY `fk_dl_drivername_drivers_username` (`driver_username`),
  KEY `ix_driver_totalpoints` (`total_points`),
  KEY `ix_driver_currentpoints` (`current_points`),
  CONSTRAINT `fk_dl_driverid_drivers_id` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dl_drivername_drivers_username` FOREIGN KEY (`driver_username`) REFERENCES `drivers` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dl_sponsorid_sponsors_id` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver_list`
--

LOCK TABLES `driver_list` WRITE;
/*!40000 ALTER TABLE `driver_list` DISABLE KEYS */;
INSERT INTO `driver_list` VALUES (46,47,'mom',0,0),(46,48,'pap',0,0),(46,53,'testdriver',0,0);
/*!40000 ALTER TABLE `driver_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drivers` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `street_address` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postal_code` varchar(30) NOT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `total_spent` double NOT NULL DEFAULT '0',
  `profile_img` varchar(100) DEFAULT 'https://iaia.edu/wp-content/uploads/female_silhouette.png',
  PRIMARY KEY (`user_id`),
  KEY `fk_drivers_sponsorid_sponsors_id` (`sponsor_id`),
  KEY `fk_drivers_password_users_password` (`password`),
  KEY `ix_user_id` (`user_id`),
  KEY `ix_driver_username` (`username`),
  KEY `ix_streetaddress` (`street_address`),
  KEY `ix_country` (`country`),
  KEY `ix_postal_code` (`postal_code`),
  CONSTRAINT `fk_drivers_password_users_password` FOREIGN KEY (`password`) REFERENCES `users` (`password`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_drivers_sponsorid_sponsors_id` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_drivers_userid_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_drivers_username_users_username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (47,'mom','mom','mom','1 Elm Street, Clemson, SC','United States','29632',NULL,'$2y$10$Q0YZvTVizzKcEZOO9xRwVOdcjgC8ZzgykYXT7Z0dS9Mhscq3Kbc0W',0,'https://iaia.edu/wp-content/uploads/female_silhouette.png'),(48,'pap','pap','pap','3 Elm Street, Clemson, SC','United States','29631',NULL,'$2y$10$Omw7lDT.X6v4qdNTbWDL5.wa433n4VB52wMImq5xRIJ9v2BgrNF.u',0,'https://iaia.edu/wp-content/uploads/female_silhouette.png'),(53,'test','test','testdriver','test','test','11111',NULL,'$2y$10$US3RfaKwWT.1M1/dayMIEOQJigwcwxr5kFnMlvvqNO/ipoLq.MlYC',0,'https://iaia.edu/wp-content/uploads/female_silhouette.png');
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` varchar(280) DEFAULT NULL,
  `sent_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (26,1,'hello','2019-04-09 17:17:08'),(26,1,'hello','2019-04-09 17:17:23'),(26,1,'hello','2019-04-09 17:17:25'),(26,1,'bmw','2019-04-09 17:20:26'),(26,2,'hi','2019-04-09 17:26:39'),(26,1,'Please dont be null','2019-04-09 17:30:22'),(26,26,'heyman','2019-04-09 17:50:08'),(26,26,'Does it update','2019-04-09 18:31:37'),(26,1,'You are dense','2019-04-09 18:55:23'),(26,1,'hello','2019-04-09 21:18:19'),(20,17,'hi there','2019-04-09 21:25:55'),(26,21,'hey how has your dad been','2019-04-11 21:22:39'),(21,26,'ok','2019-04-11 21:42:51'),(21,26,'ok','2019-04-11 21:42:52'),(48,NULL,'ergeg','2019-04-14 20:37:31'),(46,29,'bug','2019-04-15 01:32:12'),(46,47,'ALERT: You have been added by lemon','2019-04-15 15:47:52');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `points_history`
--

DROP TABLE IF EXISTS `points_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points_history` (
  `sponsor_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `point_amount` double NOT NULL DEFAULT '0',
  `comment` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`,`driver_id`,`date_created`),
  KEY `fk_ph_driverid_drivers_id` (`driver_id`),
  CONSTRAINT `fk_ph_driverid_drivers_id` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ph_sponsorid_sponsors_id` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points_history`
--

LOCK TABLES `points_history` WRITE;
/*!40000 ALTER TABLE `points_history` DISABLE KEYS */;
INSERT INTO `points_history` VALUES (46,48,'2019-04-14 20:13:24',-27.98,NULL);
/*!40000 ALTER TABLE `points_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `sponsor_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(200) DEFAULT NULL,
  `pic` varchar(500) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`,`title`),
  KEY `ix_title` (`title`),
  KEY `ix_price` (`price`),
  CONSTRAINT `fk_products_sponsorid_sponsors_userid` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (46,'Wireless Bluetooth Keyboard For iOS Android Windows Mac OS PC Tablet Smartphone','','http://thumbs1.ebaystatic.com/pict/322395494996404000000004_2.jpg','http://www.ebay.com/itm/Wireless-Bluetooth-Keyboard-iOS-Android-Windows-Mac-OS-PC-Tablet-Smartphone-/322395494996?var=512323723364','13.99'),(46,'Women Ladies classic Authentic Trainer Low High Top Shoes Casual Canvas Sneakers','','http://thumbs1.ebaystatic.com/pict/264213580324404000000020_1.jpg','http://www.ebay.com/itm/Women-Ladies-classic-Authentic-Trainer-Low-High-Top-Shoes-Casual-Canvas-Sneakers-/264213580324?var=563774952858','16.88');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_bought`
--

DROP TABLE IF EXISTS `products_bought`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_bought` (
  `order_id` int(11) NOT NULL,
  `sponsor_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `price` varchar(20) DEFAULT NULL,
  `point_cost` varchar(20) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`order_id`,`title`),
  KEY `fk_productsbought_driverid_drivers_userid` (`driver_id`),
  KEY `fk_productsbought_sponsorid_sponsors_userid` (`sponsor_id`),
  KEY `fk_productsbought_price_products_price` (`price`),
  KEY `fk_productsbought_title_products_title` (`title`),
  CONSTRAINT `fk_productsbought_driverid_drivers_userid` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productsbought_orderid_purchase_orderid` FOREIGN KEY (`order_id`) REFERENCES `purchase` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productsbought_price_products_price` FOREIGN KEY (`price`) REFERENCES `products` (`price`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productsbought_sponsorid_sponsors_userid` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productsbought_title_products_title` FOREIGN KEY (`title`) REFERENCES `products` (`title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_bought`
--

LOCK TABLES `products_bought` WRITE;
/*!40000 ALTER TABLE `products_bought` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_bought` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_cost_points` int(11) NOT NULL,
  `total_cost_dollars` int(11) NOT NULL,
  `street_address` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postal_code` varchar(30) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_purchase_driverid_drivers_userid` (`driver_id`),
  KEY `fk_purchase_streetaddress_drivers_streetaddress` (`street_address`),
  KEY `fk_purchase_country_drivers_country` (`country`),
  KEY `fk_purchase_postalcode_drivers_postalcode` (`postal_code`),
  KEY `ix_orderid` (`order_id`),
  CONSTRAINT `fk_purchase_country_drivers_country` FOREIGN KEY (`country`) REFERENCES `drivers` (`country`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_driverid_drivers_userid` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_postalcode_drivers_postalcode` FOREIGN KEY (`postal_code`) REFERENCES `drivers` (`postal_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_purchase_streetaddress_drivers_streetaddress` FOREIGN KEY (`street_address`) REFERENCES `drivers` (`street_address`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sponsors`
--

DROP TABLE IF EXISTS `sponsors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sponsors` (
  `user_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_img` varchar(100) DEFAULT 'https://iaia.edu/wp-content/uploads/female_silhouette.png',
  `dollar_ratio` double NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `fk_sp_password_user_password` (`password`),
  KEY `ix_user_id` (`user_id`),
  CONSTRAINT `fk_sp_password_user_password` FOREIGN KEY (`password`) REFERENCES `users` (`password`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_sp_userid_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sponsors`
--

LOCK TABLES `sponsors` WRITE;
/*!40000 ALTER TABLE `sponsors` DISABLE KEYS */;
INSERT INTO `sponsors` VALUES (46,'lemon','$2y$10$OoZFgpl7jHZ/eoXb3WZtEuK/H253wzvB5BWEX8S1/2YaL4XzZxoXO','https://iaia.edu/wp-content/uploads/female_silhouette.png',1);
/*!40000 ALTER TABLE `sponsors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_type` varchar(10) DEFAULT 'driver',
  `answer` varchar(1000) DEFAULT NULL,
  `question` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_user_id` (`id`),
  KEY `ix_username` (`username`),
  KEY `ix_password` (`password`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'testAdmin','$2y$10$X1f9v1dp4V9qavP3wOygkefoHMfQ5fIiZQzBVObPvgztn/I5hDMJ6','test@test.com','2019-04-14 22:38:12','admin','Fido','First Dog Name'),(29,'bugAdmin','placeholder','placeholder@email.com','2019-04-15 01:28:32','admin',NULL,NULL),(46,'lemon','$2y$10$OoZFgpl7jHZ/eoXb3WZtEuK/H253wzvB5BWEX8S1/2YaL4XzZxoXO','lemon@lemon.com','2019-04-14 18:52:09','sponsor','NYC','Where are you from '),(47,'mom','$2y$10$Q0YZvTVizzKcEZOO9xRwVOdcjgC8ZzgykYXT7Z0dS9Mhscq3Kbc0W','mom@mom.com','2019-04-14 18:54:39','driver','Clemson','Where were you born'),(48,'pap','$2y$10$Omw7lDT.X6v4qdNTbWDL5.wa433n4VB52wMImq5xRIJ9v2BgrNF.u','pap@pap.com','2019-04-14 18:58:20','driver','Clemson','Where were you born'),(49,'driver1','$2y$10$I/uF7.MVH8zDwKQI.4XVh.NYvhPKILZ3uZesub161CVm0GEiEvW8C','driver1@driver.com','2019-04-14 19:04:49','driver','Clemson','Where were you born'),(52,'admin1','$2y$10$OcUehV4bn8Mcv32pD2qXsOgcYOHgCPKOhxXl1D21g4d0OOfSau2XW','admin1@admin.com','2019-04-14 20:52:11','admin',NULL,NULL),(53,'testdriver','$2y$10$US3RfaKwWT.1M1/dayMIEOQJigwcwxr5kFnMlvvqNO/ipoLq.MlYC','tester@test.com','2019-04-14 23:32:20','driver',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-15 16:21:40
