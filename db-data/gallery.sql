-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: projectDB
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artwork`
--

DROP TABLE IF EXISTS `artwork`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artwork` (
  `id` int NOT NULL AUTO_INCREMENT,
  `artist_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completion_date` datetime NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_views` int NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `artwork_url` longtext COLLATE utf8mb4_unicode_ci,
  `artwork_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_881FC576B7970CF8` (`artist_id`),
  CONSTRAINT `FK_881FC576B7970CF8` FOREIGN KEY (`artist_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artwork`
--

LOCK TABLES `artwork` WRITE;
/*!40000 ALTER TABLE `artwork` DISABLE KEYS */;
INSERT INTO `artwork` VALUES (1,1,'Wonderland','2022-01-01 00:00:00','<div><strong>Wonderland is inspired by the famous story \"Alice in Wonderland\"</strong></div><div><em>The great wonderland in our fairytale is finally demonstrated in anime style.</em></div>',306,1,'https://img1.goodfon.com/wallpaper/nbig/7/66/anime-oboi-fen-shuy-igrushki.jpg',NULL),(2,1,'Cherry Blossom','2022-11-30 00:00:00','<div><strong>Welcome spring with the impressive scenery of cherry blossoms!<br></strong>Hope you guys like this!</div>',3,1,'https://images.hdqwalls.com/download/landscape-fantasy-art-2j-3840x2400.jpg',NULL),(3,1,'Yggdrasil','2022-11-30 00:00:00','<h1><strong>Fantasy World never stops to attract my mind~</strong></h1><div>Ends up drawing it.</div>',19,1,'https://i.pinimg.com/originals/14/bf/85/14bf85f638265c603d6cb5370d5b5047.jpg',NULL),(4,1,'Fairyland','2022-11-30 00:00:00','<div><strong>I am obsessed with this. </strong><br><br></div>',7,1,'https://wallup.net/wp-content/uploads/2018/09/28/953999-fantasy-adventure-kingdom-kingdoms-art-artwork-artistic.jpg',NULL),(5,1,'Night of Neon','2022-11-30 00:00:00','<div>Space is always mysterious, though it\'s quiet.</div>',1,1,'https://wallpaperforu.com/wp-content/uploads/2020/07/space-wallpaper-20070715385714.jpg',NULL),(6,1,'Paradise','2022-11-30 00:00:00','<div>Never gonna give it up...</div>',6,1,'https://wallpaperaccess.com/full/29816.jpg',NULL),(7,2,'Tree And Space','2022-12-02 00:00:00','<p><i><strong>The tree is alone. But its sky is too big to feel lonely...</strong></i></p>',20,1,NULL,'tree-and-space-1670064125.jpg'),(8,5,'Sakura Site','2022-12-02 00:00:00','<div><em>The way this world looked to me.</em></div>',40,1,NULL,'hd-wallpaper-nature-bridge-anime-girls-waterfall-fantasy-art-cherry-blossom-1669976076.jpg'),(25,2,'Light Butterflies','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',7,1,NULL,'HD wallpaper_ glowing butterflies in jar wallpaper, beautiful, blur, bokeh-1670092937.jpg'),(26,2,'Flower Garden','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',1,1,NULL,'HD wallpaper_ river near houses painting, summer, bridge, picture, art, Thomas Kinkade-1670093496.jpg'),(27,2,'Lone Tree','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',1,1,NULL,'High_resolution_wallpaper_background_ID_77701301160-1670093539.jpg'),(28,2,'Starry Night','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',2,1,NULL,'reflection_space_planet_stars_5000x3400-1670093704.jpg'),(29,2,'Filled of White','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',1,1,NULL,'HD wallpaper_ mountains landscapes nature switzerland lakes alpine alps meadows white flowers 2560x1600 wallpap Nature Flowers HD Art-1670093746.jpg'),(30,2,'Blue Butterflies','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',0,1,NULL,'HD wallpaper_ butterfly, blurry, blurred, bright, mushroom, butterflies-1670095191.jpg'),(31,2,'Lavender Mountain','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',2,1,NULL,'HD wallpaper_ computer  desktop background hd nature images 1920x1200, mountain-1670095245.jpg'),(32,2,'Red Lake','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',0,1,NULL,'HD wallpaper_ digital, digital art, artwork, illustration, photography, Photoshop-1670095735.jpg'),(33,2,'In the late Noon','2022-12-04 00:00:00','<div><em>The artist left nothing...</em></div>',0,1,NULL,'HD wallpaper_ field of white petaled flowers, nature, landscape, trees, white flowers-1670095768.jpg'),(34,2,'Autumn','2022-12-04 00:00:00','<div>How romantic it is, how wonderful it means...</div>',0,1,NULL,'autumn-blog-1670097441.jpg'),(35,4,'Night City','2022-12-04 00:00:00','<div><em>This artist left nothing.</em></div>',0,1,'https://free4kwallpapers.com/uploads/originals/2020/01/29/neon-city-wallpaper.jpg',NULL),(36,4,'Cyber Dark City','2022-12-04 00:00:00','<div><em>This artist left nothing.</em></div>',0,1,'https://wallpaperaccess.com/full/5330348.jpg',NULL),(38,1,'Colorful Night','2022-12-04 00:00:00','<em>This artist left nothing.</em>',0,1,'https://wallpaperaccess.com/full/2727225.jpg',NULL),(39,1,'Magic Land','2022-12-04 00:00:00','<div><em>This artist left nothing.</em></div>',0,1,'https://img.freepik.com/premium-photo/3d-render-digital-art-fantasy-natural-environment-high-quality-wallpaper_685067-887.jpg?w=2000',NULL);
/*!40000 ALTER TABLE `artwork` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `artwork_category`
--

DROP TABLE IF EXISTS `artwork_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artwork_category` (
  `artwork_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`artwork_id`,`category_id`),
  KEY `IDX_FA06D53FDB8FFA4` (`artwork_id`),
  KEY `IDX_FA06D53F12469DE2` (`category_id`),
  CONSTRAINT `FK_FA06D53F12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FA06D53FDB8FFA4` FOREIGN KEY (`artwork_id`) REFERENCES `artwork` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artwork_category`
--

LOCK TABLES `artwork_category` WRITE;
/*!40000 ALTER TABLE `artwork_category` DISABLE KEYS */;
INSERT INTO `artwork_category` VALUES (1,1),(1,2),(1,3),(1,4),(1,15),(1,21),(2,1),(2,4),(2,15),(2,19),(2,22),(3,1),(3,4),(3,22),(4,1),(4,4),(4,15),(4,19),(4,22),(5,2),(5,7),(5,15),(5,20),(6,1),(6,4),(6,11),(6,15),(7,1),(7,4),(7,7),(7,15),(7,20),(7,22),(8,1),(8,4),(8,15),(8,19),(8,22),(25,1),(25,4),(25,15),(25,20),(25,23),(26,1),(26,14),(26,19),(26,22),(27,1),(27,7),(27,20),(27,22),(28,4),(28,7),(28,20),(29,1),(29,15),(29,19),(30,1),(30,4),(30,15),(30,20),(30,23),(31,1),(31,15),(31,19),(32,1),(32,2),(32,4),(32,13),(32,15),(32,19),(32,22),(33,1),(33,11),(33,15),(34,1),(34,15),(34,22),(35,20),(35,24),(36,20),(36,24),(38,20),(38,24),(39,4),(39,15),(39,22);
/*!40000 ALTER TABLE `artwork_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Nature'),(2,'People'),(3,'Animal'),(4,'Fantasy'),(7,'Space'),(11,'Sky'),(13,'Abstract'),(14,'Architecture'),(15,'Landscape'),(19,'Flower'),(20,'Night'),(21,'Anime'),(22,'Tree'),(23,'Butterfly'),(24,'City'),(26,'Others');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `artwork_id` int NOT NULL,
  `comment_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526CDB8FFA4` (`artwork_id`),
  CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_9474526CDB8FFA4` FOREIGN KEY (`artwork_id`) REFERENCES `artwork` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (5,2,'<div>It\'s nice!</div>',8,'2022-12-02 11:43:27'),(7,2,'<p>I like it!</p>',8,'2022-12-02 18:50:23'),(8,2,'<p>It\'s so wonderful!! Thanks for your hard work!</p>',3,'2022-12-02 22:45:44'),(9,2,'<p>Hope you enjoy your day~</p>',3,'2022-12-02 22:46:11'),(10,1,'<p>Hello~</p>',1,'2022-12-03 23:53:15'),(11,2,'<p><strong>New style!</strong></p>',8,'2022-12-04 01:30:41'),(12,9,'<div>Hi :3</div>',1,'2022-12-05 22:54:14');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20221127162833','2022-11-27 16:28:39',343),('DoctrineMigrations\\Version20221127174153','2022-11-27 17:42:09',390),('DoctrineMigrations\\Version20221128205418','2022-11-28 20:54:32',1303),('DoctrineMigrations\\Version20221129082710','2022-11-29 08:27:26',577),('DoctrineMigrations\\Version20221130094310','2022-11-30 10:46:02',1076),('DoctrineMigrations\\Version20221130104238','2022-11-30 10:48:04',1234),('DoctrineMigrations\\Version20221201100336','2022-12-02 10:52:19',81),('DoctrineMigrations\\Version20221202113347','2022-12-02 11:34:02',564),('DoctrineMigrations\\Version20221202114017','2022-12-02 11:40:48',703),('DoctrineMigrations\\Version20221203165757','2022-12-03 16:58:06',2166);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like`
--

DROP TABLE IF EXISTS `like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `like` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `artwork_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC6340B3A76ED395` (`user_id`),
  KEY `IDX_AC6340B3DB8FFA4` (`artwork_id`),
  CONSTRAINT `FK_AC6340B3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_AC6340B3DB8FFA4` FOREIGN KEY (`artwork_id`) REFERENCES `artwork` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like`
--

LOCK TABLES `like` WRITE;
/*!40000 ALTER TABLE `like` DISABLE KEYS */;
INSERT INTO `like` VALUES (28,2,6),(30,2,8),(31,2,25),(32,2,4),(34,9,1),(37,2,1),(38,2,28);
/*!40000 ALTER TABLE `like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'free_artists@gmail.com','[]','$2y$13$OSa6o32To4N3j9K.04Sdv.LHwLNUkE0H9Vnu2vIBLfEp3c.nazina','Free Artists','free_artists'),(2,'belemon@gmail.com','[\"ROLE_ADMIN\"]','$2y$13$8IWKkGtF71FPZ6An/Xi.vOUuYDBx1rKrp75M4uKHCpyl3AE1ZUN5a','Đặng Quỳnh Trang','belemon'),(4,'moderator@gmail.com','[\"ROLE_MOD\"]','$2y$13$wTfaPV/geAyPmANtEsUVlOw3dEs7sqawDFq6gnPUPBGpou5g8k8rG','Mod-chan','mod'),(5,'sakura@gmail.com','[]','$2y$13$I2U8zOUlFAnPjx.8D8uXye/z7Rijams1cRg5F5M2c30KE98T2rpPS','Sakura Kinomoto','cardcaptor'),(6,'tester@gmail.com','[]','$2y$13$JB4hCUzB6fICRP3kuUrSrOQiDyXD.TRRjIo.oYcbtQWrXCWICiFzy','Tester-chan','tester123'),(7,'user@gmail.com','[]','$2y$13$Hb5.bp88XvYGylU9GLMryureI18a1U06l/LTrc/CGZlgdVKhTboJy','User-chan','user123'),(8,'esther_seirenia@gmail.com','[]','$2y$13$qGTWwYAYSMAh3u08laSIvepuzelPfx1Fp57jY/G8djKdHk1f4WD0e','Esther Seirenia','esther_se'),(9,'abc@gmail.com','[]','$2y$13$ThycDZ6TBTxi6qQUCZ5M5evV9vE90/maa/jnUhsQiA7i05KDCglY2','ABC','abc'),(10,'namtt@gmail.com','[]','$2y$13$i4EmrGiyM9hUncN3Sf8jOuO9om/4lD0MFucGsqPWiDqc16Bavu1Bu','namtt','namtt'),(11,'hello@gmail.com','[]','$2y$13$aMdc6x/UgmwmDGv6XLcC1uTklSkza0.NH1DpfsYRMywqGyLCw0tnO','hello','hello');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-20 22:15:33
