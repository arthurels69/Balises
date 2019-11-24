-- MySQL dump 10.16  Distrib 10.2.29-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: balises
-- ------------------------------------------------------
-- Server version	10.2.29-MariaDB-log

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
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20191124165821','2019-11-24 16:59:06'),('20191124174344','2019-11-24 17:44:02');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `non_balises_theater`
--

DROP TABLE IF EXISTS `non_balises_theater`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `non_balises_theater` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `non_balises_theater`
--

LOCK TABLES `non_balises_theater` WRITE;
/*!40000 ALTER TABLE `non_balises_theater` DISABLE KEYS */;
/*!40000 ALTER TABLE `non_balises_theater` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `param`
--

DROP TABLE IF EXISTS `param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resale_coeff` double NOT NULL,
  `redistributed_coeff` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `param`
--

LOCK TABLES `param` WRITE;
/*!40000 ALTER TABLE `param` DISABLE KEYS */;
INSERT INTO `param` VALUES (1,3,1);
/*!40000 ALTER TABLE `param` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `show_date`
--

DROP TABLE IF EXISTS `show_date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `show_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id_id` int(11) DEFAULT NULL,
  `date_show` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7669E1B97DF5FA8B` (`show_id_id`),
  CONSTRAINT `FK_7669E1B97DF5FA8B` FOREIGN KEY (`show_id_id`) REFERENCES `spectacle` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `show_date`
--

LOCK TABLES `show_date` WRITE;
/*!40000 ALTER TABLE `show_date` DISABLE KEYS */;
INSERT INTO `show_date` VALUES (1,1,'2019-11-25 19:30:00'),(2,1,'2019-11-26 19:30:00'),(3,2,'2019-11-26 19:30:00'),(4,2,'2019-11-27 19:30:00'),(5,3,'2019-11-29 19:30:00'),(6,3,'2019-11-30 19:30:00');
/*!40000 ALTER TABLE `show_date` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `show_rate`
--

DROP TABLE IF EXISTS `show_rate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `show_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_date_id` int(11) DEFAULT NULL,
  `free_places_number` int(11) DEFAULT NULL,
  `discounted_rate` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_31BE9FADFC51B88` (`show_date_id`),
  CONSTRAINT `FK_31BE9FADFC51B88` FOREIGN KEY (`show_date_id`) REFERENCES `show_date` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `show_rate`
--

LOCK TABLES `show_rate` WRITE;
/*!40000 ALTER TABLE `show_rate` DISABLE KEYS */;
INSERT INTO `show_rate` VALUES (1,1,30,12),(2,2,30,12),(3,3,30,12),(4,4,30,12),(5,5,30,12),(6,6,30,12);
/*!40000 ALTER TABLE `show_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spectacle`
--

DROP TABLE IF EXISTS `spectacle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spectacle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theater_id_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `distribution` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `mandatory_infos` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_credits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_infos` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_balise` tinyint(1) NOT NULL,
  `offer_type` smallint(6) DEFAULT NULL,
  `mapado_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_rate` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E55076F44ECC313E` (`theater_id_id`),
  CONSTRAINT `FK_E55076F44ECC313E` FOREIGN KEY (`theater_id_id`) REFERENCES `theater` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spectacle`
--

LOCK TABLES `spectacle` WRITE;
/*!40000 ALTER TABLE `spectacle` DISABLE KEYS */;
INSERT INTO `spectacle` VALUES (1,1,'Les chevaliers','Ils sont quatre. Ce sont des chevaliers, avec des plumes et des armures. Un barde les accompagne, il sera garant de l’aspect épique du spectacle. Un narrateur est présent, il sera garant de l’aspect éthique du spectacle. C’est une pièce sur l’héroïsme donc c’est une pièce sur l’impuissance. Pour être un héros, il faut être courageux mais pour être courageux il faut savoir où se trouve le courage, où se trouve la mission. Le principal obstacle est que ces chevaliers sont tout prêts de se faire déborder par le monde. Ils développent un bataillon de stratégies et de parades afin de repousser le moment où ils constateront fatalement qu’il n’y a pas de mission. Quand ce moment arrive, poussés dans leurs derniers retranchements, ils en inventent l’apocalypse. On pourrait dire que c’est du théâtre absurdo comique involontairement engagé ou plutôt une farce politique malencontreusement divertissante.','texte et mise en scène : Guillaume Bailliart\r\njeu : Guillaume Bailliart, Mélanie Bestel, Mélanie Bourgeois, Laurent Dratler, Pierre-Jean Etienne, Aurélie Pitrat, Gérald Robert-Tissot',NULL,'2e65b18b89a661eb8a5cf3570b752e1e.jpeg',NULL,NULL,0,NULL,NULL,12),(2,1,'La première ville de l’histoire de l’humanité','Au centre de ce texte, il y a le personnage de Jennifer, femme opaque, volatile, somme vide de tous les silences. Autour d’elle, un monde s’agite, et met tout en œuvre pour la sauver. La sauver de quoi ? La sauver pourquoi ? Aucun de ses preux chevaliers ne le sait exactement, mais considère simplement que prendre possession d’elle suffira à assurer son bonheur. La première ville de l’histoire de l’Humanité raconte cette guerre pour la possession, une guerre qui se cache derrière une surenchère de bonnes intentions et de sentiments purs. C’est une histoire de couple, et donc une histoire de pouvoir mais la plus grande aliénation ne vient pas des hommes, elle réside en eux, sans même qu’ils s’en aperçoivent, instruments et victimes de leur propre tyrannie. Il y a un peu plus de 10,000 ans, les Hommes se sédentarisaient et construisaient les premières villes, autour de leur foyer. Ils matérialisaient, en élevant des murs, un carcan de domination qui n’a pas été abattu depuis. Circonscrite pendant des siècles dans une unité de lieu hermétique, Jennifer, la Femme, est la victime consentante de cette dictature domestique, surtout parce que toutes les options proposées par ses sauveurs ne sont finalement que d’autres cellules de sa même prison intime.','Grégoire Courtois ; mise en scène, Florent Fichot ; création costumes, Nadine Allibert ; création maquillage, Coralie Paon ; création lumière, Benjamin Champy ; régies, Amélie Verjat ; avec Julien Boutier, Jeanne Gogny et Steeve Gonçalves',NULL,'7dc3c19b40d56b25a2d8284d438e3b84.jpeg',NULL,NULL,1,2,NULL,12),(3,1,'Éloge de la motivation','Trois spécialistes du travail viennent nous faire l\'apologie de la réussite par le travail à tout prix. C\'est à travers une conférence où se mêleront entretiens, simulations, discours et invités surprises.... qu\'ils tenteront de nous convaincre que pour s\'en sortir, il faut travailler et pour travailler il faut tout donner... Il s\'agit d\'essayer encore de tenter de rire de l\'insupportable en abordant le thème délicat et paradoxal qu\'est le travail par la forme burlesque. Les sources littéraires qui ont inspiré ce projet sont idéologiquement opposées. En effet il y a d\'un côté toute une littérature faisant l\'apologie des méthodes de management et de coaching radicales ; on y apprend notamment à licencier en douceur , à travailler son leadership, à maitriser ses émotions... De l\'autre côté on trouve des écrits dénonçant la souffrance au travail.','mise en scène, Agnès Larroque ; avec Frédérique Moreau de Bellaing, Laure Seguette et Chritian Scelles ; décors : Audrey Gonod',NULL,'e07385dfe71a6e2b5a1d3fa61cf46175.jpeg',NULL,NULL,1,1,NULL,12);
/*!40000 ALTER TABLE `spectacle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theater`
--

DROP TABLE IF EXISTS `theater`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theater` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_rate` double DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_46DD8154A76ED395` (`user_id`),
  CONSTRAINT `FK_46DD8154A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theater`
--

LOCK TABLES `theater` WRITE;
/*!40000 ALTER TABLE `theater` DISABLE KEYS */;
INSERT INTO `theater` VALUES (1,2,'Théâtre de l\'Élysée','theatre@lelysee.com','14 rue Basse-Combalot',NULL,69007,'Lyon','04 78 58 88 25','46ac397216d5b894e1ae72081cd24c63','https://lelysee.com',12,45.7551234,4.8420688,NULL),(2,3,'Théâtre de la Renaissance','mailbidon@renaissance.com','7 rue Orsel',NULL,69600,'Oullins','04 72 39 74 91','e3e1222e2e18172241cb0e3d62d1c14e','https://www.theatrelarenaissance.com',25,45.7164218,4.8107958,NULL),(3,4,'Théâtre des Clochards Célestes','mailbidon@clochardscelestes.com','51 rue des Tables Claudiennes',NULL,69001,'Lyon','04 78 28 34 43','03ac307e99fee44348caab4c1f4a45ca','http://clochardscelestes.com/',12,45.771046,4.8340379,NULL);
/*!40000 ALTER TABLE `theater` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'balises@felinn.org','[\"ROLE_ADMIN\"]','$argon2i$v=19$m=65536,t=4,p=1$ZXZqUU0vaVhZS09SR2xxdA$isonrC7z7EBPKVbKDrAQyzyHvfrWaF/2wGXnc01FcZs',NULL),(2,'theatre@lelysee.com','[\"ROLE_THEATER\"]','$argon2id$v=19$m=65536,t=2,p=1$YektpXbzWotfF6g/Aal61w$rpGbOgdpiLfx+TfDISygOm9c+ThGf79iAVw5HQxEUD0',NULL),(3,'mailbidon@renaissance.com','[\"ROLE_THEATER\"]','$argon2id$v=19$m=65536,t=2,p=1$Mii2Jywk+//cPW9MDdc5wg$/VpIR2WQRVgn7x/NM4O1ApEXsDr3+VQe5YRU7kvgtXE',NULL),(4,'mailbidon@clochardscelestes.com','[\"ROLE_THEATER\"]','$argon2id$v=19$m=65536,t=2,p=1$JcyNczNxroHkF7913iG/Sg$sMJi1SDRQA23IFZsRFGulX1tHkAOqygwQ2aM9DwoNBQ',NULL);
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

-- Dump completed on 2019-11-24 19:16:39
