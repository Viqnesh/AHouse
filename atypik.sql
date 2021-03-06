-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: atypik
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activite`
--

DROP TABLE IF EXISTS `activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `id_domaine_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B8755515E7F87C48` (`id_domaine_id`),
  CONSTRAINT `FK_B8755515E7F87C48` FOREIGN KEY (`id_domaine_id`) REFERENCES `domaine` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activite`
--

LOCK TABLES `activite` WRITE;
/*!40000 ALTER TABLE `activite` DISABLE KEYS */;
INSERT INTO `activite` VALUES (2,'P├¬che','88e612462e12e7081ea7d8189dcf20ec.jpeg',120,'292 Rue Bluberry','dhfbldhsbfibqIF',1),(3,'Accrobranche','001e1195a81e18460f7057ca15977587.jpeg',220,'17 Rue JeanPierre','sjlfhq:fbakbfjze',1),(4,'Parc National des Pyr├®nn├®es','1631219340cad55cc31664b08b84438b.jpeg',130,'202 Rue Desaux','fbkjfbdjksbfkjs',2);
/*!40000 ALTER TABLE `activite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activite_habitat`
--

DROP TABLE IF EXISTS `activite_habitat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activite_habitat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_activite_id` int DEFAULT NULL,
  `id_habitat_id` int NOT NULL,
  `distance` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7191756DA74ADF1` (`id_habitat_id`),
  KEY `IDX_7191756DD0165F20` (`type_activite_id`),
  CONSTRAINT `FK_7191756DA74ADF1` FOREIGN KEY (`id_habitat_id`) REFERENCES `habitat` (`id`),
  CONSTRAINT `FK_7191756DD0165F20` FOREIGN KEY (`type_activite_id`) REFERENCES `activite` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activite_habitat`
--

LOCK TABLES `activite_habitat` WRITE;
/*!40000 ALTER TABLE `activite_habitat` DISABLE KEYS */;
INSERT INTO `activite_habitat` VALUES (3,2,1,300),(4,3,1,150),(5,4,2,250);
/*!40000 ALTER TABLE `activite_habitat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `begin_at` datetime NOT NULL,
  `end_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `braintree`
--

DROP TABLE IF EXISTS `braintree`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `braintree` (
  `id` int NOT NULL AUTO_INCREMENT,
  `merchant_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_key` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `private_key` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `braintree`
--

LOCK TABLES `braintree` WRITE;
/*!40000 ALTER TABLE `braintree` DISABLE KEYS */;
/*!40000 ALTER TABLE `braintree` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendrier`
--

DROP TABLE IF EXISTS `calendrier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendrier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_dispo` date NOT NULL,
  `id_habitat_id` int DEFAULT NULL,
  `etat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B2753CB9A74ADF1` (`id_habitat_id`),
  CONSTRAINT `FK_B2753CB9A74ADF1` FOREIGN KEY (`id_habitat_id`) REFERENCES `habitat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendrier`
--

LOCK TABLES `calendrier` WRITE;
/*!40000 ALTER TABLE `calendrier` DISABLE KEYS */;
INSERT INTO `calendrier` VALUES (1,'2021-06-16',2,'D'),(2,'2021-06-30',2,'O'),(18,'2021-07-01',2,'D');
/*!40000 ALTER TABLE `calendrier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendrier_domaine`
--

DROP TABLE IF EXISTS `calendrier_domaine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendrier_domaine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_domaine_id` int DEFAULT NULL,
  `date_dispo` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9B752E1DE7F87C48` (`id_domaine_id`),
  CONSTRAINT `FK_9B752E1DE7F87C48` FOREIGN KEY (`id_domaine_id`) REFERENCES `domaine` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendrier_domaine`
--

LOCK TABLES `calendrier_domaine` WRITE;
/*!40000 ALTER TABLE `calendrier_domaine` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendrier_domaine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user_id` int DEFAULT NULL,
  `id_habitat_id_commentaire` int DEFAULT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_activite_habitat_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BCA74ADF1` (`id_habitat_id_commentaire`),
  KEY `IDX_67F068BCB5E42F98` (`id_activite_habitat_id`),
  KEY `UNIQ_67F068BC79F37AE5` (`id_user_id`) USING BTREE,
  CONSTRAINT `FK_67F068BC79F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_67F068BCB5E42F98` FOREIGN KEY (`id_activite_habitat_id`) REFERENCES `activite_habitat` (`id`),
  CONSTRAINT `FK_67F068BCB600200A` FOREIGN KEY (`id_habitat_id_commentaire`) REFERENCES `habitat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaire`
--

LOCK TABLES `commentaire` WRITE;
/*!40000 ALTER TABLE `commentaire` DISABLE KEYS */;
INSERT INTO `commentaire` VALUES (4,2,1,'Prot├®ger les femmes est un combat. Nous le portons ensemble. Comme au G7 de Biarritz ou au Forum #G├®n├®ration├ëgalit├® ├á Paris. Au moment de nous retrouver ici, en Irak, et demain aux c├┤t├®s de vos s┼ôurs kurdes, y├®zidies, je redis avec force : nous ne l├ócherons rien.','ceci',NULL),(8,1,2,'Ce commentaire provient de l\'app Postman','Commementaire PostMan',NULL),(10,1,2,'Ce commentaire provient de l\'app Postman','Commementaire PostMan',NULL),(11,2,2,'Ce commentaire provient de l\'app Postman','Commementaire PostMan',NULL),(12,2,2,'Ce commentaire provient de l\'app Postman','Commementaire PostMan',NULL),(13,2,2,'Ce commentaire provient de l\'app Postman','Commementaire PostMan',NULL),(14,2,2,'fgfgfdgf','titre',NULL);
/*!40000 ALTER TABLE `commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contenu_controller`
--

DROP TABLE IF EXISTS `contenu_controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contenu_controller` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenu_controller`
--

LOCK TABLES `contenu_controller` WRITE;
/*!40000 ALTER TABLE `contenu_controller` DISABLE KEYS */;
/*!40000 ALTER TABLE `contenu_controller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordonnees`
--

DROP TABLE IF EXISTS `coordonnees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coordonnees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  `adresse` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` int NOT NULL,
  `ville` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civilite` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordonnees`
--

LOCK TABLES `coordonnees` WRITE;
/*!40000 ALTER TABLE `coordonnees` DISABLE KEYS */;
/*!40000 ALTER TABLE `coordonnees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dispo_domaine`
--

DROP TABLE IF EXISTS `dispo_domaine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dispo_domaine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_domaine_id` int NOT NULL,
  `date_dispo` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F536B14E7F87C48` (`id_domaine_id`),
  CONSTRAINT `FK_F536B14E7F87C48` FOREIGN KEY (`id_domaine_id`) REFERENCES `domaine` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dispo_domaine`
--

LOCK TABLES `dispo_domaine` WRITE;
/*!40000 ALTER TABLE `dispo_domaine` DISABLE KEYS */;
INSERT INTO `dispo_domaine` VALUES (1,2,'2021-06-30'),(2,2,'2021-06-16'),(5,2,'2021-07-01');
/*!40000 ALTER TABLE `dispo_domaine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domaine`
--

DROP TABLE IF EXISTS `domaine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domaine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_proprietaire_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arrive` time NOT NULL,
  `depart` time NOT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_78AF0ACC9F9BCDC2` (`id_proprietaire_id`),
  KEY `IDX_78AF0ACC98260155` (`region_id`),
  CONSTRAINT `FK_78AF0ACC98260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`),
  CONSTRAINT `FK_78AF0ACC9F9BCDC2` FOREIGN KEY (`id_proprietaire_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domaine`
--

LOCK TABLES `domaine` WRITE;
/*!40000 ALTER TABLE `domaine` DISABLE KEYS */;
INSERT INTO `domaine` VALUES (1,2,'Cabanes Tr├®sors de Campagne','Partagez un moment insolite, romantique ou familial dans les Cabanes Tr├®sors de Campagne !\r\nLa beaut├® de ces lieux saura ├®merveiller petits et grands gr├óce ├á sa faune et sa flore qui habillent les environs.\r\nFor├¬ts de ch├¬nes, prairies, orchid├®es et pelous','0f3aecd82a81ad87c1979e2db0d3edc5.jpeg','07:24:00','16:24:00','25 Rue du Chateauroux','Villarzel Du Raz├¿s','France',2),(2,4,'Le Perchoir des Pyr├®n├®es','Vous ├¬tes d├®sireux de vivre une exp├®rience insolite ├á deux, entre amis ou en famille ? Venez d├®couvrir la Bulle Transparente et la Tente Sibley.\r\nTr├¿s prochainement, vous pourrez profitez d\'une escapade insolite pour dormir dans un pigeonnier en pierres a','f3f44987bdbd574836b8784817364667.jpeg','10:02:00','13:03:00','1 Rue Saint Sauveur','Verdun','France',11);
/*!40000 ALTER TABLE `domaine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domaine_equipement`
--

DROP TABLE IF EXISTS `domaine_equipement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domaine_equipement` (
  `domaine_id` int NOT NULL,
  `equipement_id` int NOT NULL,
  PRIMARY KEY (`domaine_id`,`equipement_id`),
  KEY `IDX_23C6DFED4272FC9F` (`domaine_id`),
  KEY `IDX_23C6DFED806F0F5C` (`equipement_id`),
  CONSTRAINT `FK_23C6DFED4272FC9F` FOREIGN KEY (`domaine_id`) REFERENCES `domaine` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_23C6DFED806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domaine_equipement`
--

LOCK TABLES `domaine_equipement` WRITE;
/*!40000 ALTER TABLE `domaine_equipement` DISABLE KEYS */;
INSERT INTO `domaine_equipement` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(2,1),(2,2),(2,4);
/*!40000 ALTER TABLE `domaine_equipement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipement`
--

LOCK TABLES `equipement` WRITE;
/*!40000 ALTER TABLE `equipement` DISABLE KEYS */;
INSERT INTO `equipement` VALUES (1,'Wi-Fi','images/equipement/wifi.png'),(2,'Chaise','images/equipement/chair.png'),(3,'Chauffage','images/equipement/heater.png'),(4,'Caf├®ti├¿re','images/equipement/cafetiere.png'),(5,'Plaque de Cuisson','images/equipement/plaque.png'),(6,'Lave-Vaisselle','images/equipement/vaisselle.png');
/*!40000 ALTER TABLE `equipement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habitat`
--

DROP TABLE IF EXISTS `habitat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habitat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_type_habitat_id` int DEFAULT NULL,
  `id_domaine_id` int NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_couchages` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacite` int NOT NULL,
  `prix` double NOT NULL,
  `pays` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_publication` date NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3B37B2E8E7F87C48` (`id_domaine_id`),
  KEY `IDX_3B37B2E85BA3388B` (`id_type_habitat_id`),
  CONSTRAINT `FK_3B37B2E85BA3388B` FOREIGN KEY (`id_type_habitat_id`) REFERENCES `type_habitat` (`id`),
  CONSTRAINT `FK_3B37B2E8E7F87C48` FOREIGN KEY (`id_domaine_id`) REFERENCES `domaine` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitat`
--

LOCK TABLES `habitat` WRITE;
/*!40000 ALTER TABLE `habitat` DISABLE KEYS */;
INSERT INTO `habitat` VALUES (1,1,1,'Cabane Spa du Potager','2',4,248,'France','Villarzel Du Raz├¿s','Non loin des all├®es du verger-mara├«cher et au c┼ôur du jardin de permaculture, laissez-vous s├®duire par le parfum des aromatiques !\r\nLa Cabane Spa du Potager est id├®ale pour vivre un s├®jour insolite en couple, en famille ou entre amis.\r\nPour une petite douceur, go├╗tez aux fraises, framboises et petites tomates qui naissent ├á quelques pas de la cabane. \r\nInstallez-vous ensuite dans le spa privatif sur la terrasse et admirez l\'environnement qui vous entoure !','2020-12-27','27a6ef77c1f52e27c51442d8dfd3deaf.jpeg',2),(2,2,2,'La Big\'Bulle Transparente','6',5,170,'France','Gerde','La Big\'Bulle est une bulle un peu plus grande que la moyenne qui fera le bonheur des couples et des familles. \r\nTotalement modulable en fonction du nombre d\'occupant, elle saura vous accueillir comme il se doit !','2021-04-01','83d479cebbf77f675fbec84799467ed4.jpeg',0);
/*!40000 ALTER TABLE `habitat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `habitat_propriete`
--

DROP TABLE IF EXISTS `habitat_propriete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `habitat_propriete` (
  `habitat_id` int NOT NULL,
  `propriete_id` int NOT NULL,
  PRIMARY KEY (`habitat_id`,`propriete_id`),
  KEY `IDX_59FFF4DCAFFE2D26` (`habitat_id`),
  KEY `IDX_59FFF4DC18566CAF` (`propriete_id`),
  CONSTRAINT `FK_59FFF4DC18566CAF` FOREIGN KEY (`propriete_id`) REFERENCES `propriete` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_59FFF4DCAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `habitat_propriete`
--

LOCK TABLES `habitat_propriete` WRITE;
/*!40000 ALTER TABLE `habitat_propriete` DISABLE KEYS */;
/*!40000 ALTER TABLE `habitat_propriete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_controller`
--

DROP TABLE IF EXISTS `home_controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `home_controller` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_controller`
--

LOCK TABLES `home_controller` WRITE;
/*!40000 ALTER TABLE `home_controller` DISABLE KEYS */;
/*!40000 ALTER TABLE `home_controller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user_locataire` int DEFAULT NULL,
  `id_habitat_id_location` int DEFAULT NULL,
  `date_reservation` datetime NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `statut` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appreciation` tinyint(1) DEFAULT NULL,
  `nb_personnes` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E9E89CB79F37AE5` (`id_user_locataire`),
  KEY `IDX_5E9E89CBA74ADF1` (`id_habitat_id_location`),
  CONSTRAINT `FK_5E9E89CB79273E71` FOREIGN KEY (`id_habitat_id_location`) REFERENCES `habitat` (`id`),
  CONSTRAINT `FK_5E9E89CBF9FAC609` FOREIGN KEY (`id_user_locataire`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (9,3,2,'2021-08-17 19:01:16','2021-08-01 19:01:16','2021-08-08 19:01:16','V',NULL,3);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anniversaire` date DEFAULT NULL,
  `region_id` int NOT NULL,
  `hebergement_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7E8585C898260155` (`region_id`),
  KEY `IDX_7E8585C823BB0F66` (`hebergement_id`),
  CONSTRAINT `FK_7E8585C823BB0F66` FOREIGN KEY (`hebergement_id`) REFERENCES `type_habitat` (`id`),
  CONSTRAINT `FK_7E8585C898260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` VALUES (1,'gfdgf@gmail.com','fdsf','2021-06-25',5,3);
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_type_habitat` int DEFAULT NULL,
  `titre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_publication` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_typehabitat` (`id_type_habitat`),
  CONSTRAINT `FK_BF5476CA30D7A86F` FOREIGN KEY (`id_type_habitat`) REFERENCES `type_habitat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour lesCabane','0000-00-00'),(2,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour lesCabane','0000-00-00'),(3,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour lesCabane','2021-01-04'),(4,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour lesCabane','2021-01-04'),(5,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour lesCabane','2021-01-08'),(6,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour lesCabane','2021-01-08'),(7,3,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour lesRoulotte','2021-01-08'),(8,7,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Tiny House','2021-01-08'),(9,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-04-01'),(10,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-04-01'),(11,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-20'),(12,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-23'),(13,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Cabane','2021-05-23'),(14,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-23'),(15,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-23'),(16,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-24'),(17,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-24'),(18,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-24'),(19,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-29'),(20,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-29'),(21,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-29'),(22,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-29'),(23,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-29'),(24,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-29'),(25,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-29'),(26,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-30'),(27,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-05-30'),(28,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Cabane','2021-07-21'),(29,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-21'),(30,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-21'),(31,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-21'),(32,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-22'),(33,1,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Cabane','2021-07-22'),(34,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-22'),(35,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-22'),(36,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-22'),(37,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-22'),(38,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-22'),(39,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-22'),(40,2,'Ajout d\'un param├¿tre','Un nouveau param├¿tre ├á ├®t├® ajout├® pour les Bulle','2021-07-22');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_habitat`
--

DROP TABLE IF EXISTS `notification_habitat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification_habitat` (
  `notification_id` int NOT NULL,
  `habitat_id` int NOT NULL,
  PRIMARY KEY (`notification_id`,`habitat_id`),
  KEY `IDX_2E29385FEF1A9D84` (`notification_id`),
  KEY `IDX_2E29385FAFFE2D26` (`habitat_id`),
  CONSTRAINT `FK_2E29385FAFFE2D26` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2E29385FEF1A9D84` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_habitat`
--

LOCK TABLES `notification_habitat` WRITE;
/*!40000 ALTER TABLE `notification_habitat` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_habitat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupant`
--

DROP TABLE IF EXISTS `occupant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `occupant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_location_id` int NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E7D9DBCA1E5FEC79` (`id_location_id`),
  CONSTRAINT `FK_E7D9DBCA1E5FEC79` FOREIGN KEY (`id_location_id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupant`
--

LOCK TABLES `occupant` WRITE;
/*!40000 ALTER TABLE `occupant` DISABLE KEYS */;
/*!40000 ALTER TABLE `occupant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paypal`
--

DROP TABLE IF EXISTS `paypal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paypal` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paypal`
--

LOCK TABLES `paypal` WRITE;
/*!40000 ALTER TABLE `paypal` DISABLE KEYS */;
/*!40000 ALTER TABLE `paypal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prise_de_vue`
--

DROP TABLE IF EXISTS `prise_de_vue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prise_de_vue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_habitat_id_prisedevue` int DEFAULT NULL,
  `id_activite_habitat_id` int DEFAULT NULL,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3EAEED81B5E42F98` (`id_activite_habitat_id`),
  KEY `IDX_3EAEED81A74ADF1` (`id_habitat_id_prisedevue`),
  CONSTRAINT `FK_3EAEED81950274EC` FOREIGN KEY (`id_habitat_id_prisedevue`) REFERENCES `habitat` (`id`),
  CONSTRAINT `FK_3EAEED81B5E42F98` FOREIGN KEY (`id_activite_habitat_id`) REFERENCES `activite_habitat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prise_de_vue`
--

LOCK TABLES `prise_de_vue` WRITE;
/*!40000 ALTER TABLE `prise_de_vue` DISABLE KEYS */;
INSERT INTO `prise_de_vue` VALUES (25,1,NULL,'39338e970751c7b867adccbad274c0ab.jpeg'),(26,2,NULL,'a741cadeeee8ec472cb1c9451b6dc7c8.jpg'),(27,2,NULL,'ad8ea48b789eee8746b7d45e8d9fafe7.jpg'),(28,2,NULL,'b8a3d7d00b4a70390a40a43bc03f8c52.jpg'),(29,2,NULL,'06176f3182aeff6222cf539022172baa.jpg'),(30,2,NULL,'8a0d0d4128b2c5ec1f14586203650457.jpg'),(31,2,NULL,'9e1df934e7cdbde3c00d802fe7658cbb.jpg'),(32,2,NULL,'52b90251c23f988295006a29c95baea7.jpg'),(33,2,NULL,'2c4d0d819fa8f7d574cc61d80b5b7c0b.jpg');
/*!40000 ALTER TABLE `prise_de_vue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propriete`
--

DROP TABLE IF EXISTS `propriete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propriete` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_type_habitat_id` int DEFAULT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obligatoire` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73A85B935BA3388B` (`id_type_habitat_id`),
  CONSTRAINT `FK_73A85B935BA3388B` FOREIGN KEY (`id_type_habitat_id`) REFERENCES `type_habitat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propriete`
--

LOCK TABLES `propriete` WRITE;
/*!40000 ALTER TABLE `propriete` DISABLE KEYS */;
INSERT INTO `propriete` VALUES (29,1,'fgdfgfdgdfgfd','chaine',1,'images/proprietes/2.png'),(30,2,'qsqs','chaine',1,'images/proprietes/2.png'),(31,2,'ezeaeaz','chaine',1,'images/proprietes/2.png'),(32,2,'kjkjk','chaine',1,'images/proprietes/2.png'),(33,2,'ygygy','chaine',1,'images/proprietes/2.png'),(34,1,'ddz','chaine',1,'images/proprietes/2.png'),(35,2,'grrgrgre','chaine',1,'images/proprietes/2.png'),(36,2,'tretreter','chaine',1,'images/proprietes/2.png'),(37,2,'ggfdgdf','chaine',1,'images/proprietes/2.png'),(38,2,'ggrger','chaine',1,'images/proprietes/2.png'),(39,2,'trtretre','chaine',1,'images/proprietes/2.png'),(40,2,'rezrezr','chaine',1,'images/proprietes/2.png'),(41,2,'dsdsdqs','chaine',1,'images/proprietes/2.png');
/*!40000 ALTER TABLE `propriete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propriete_habitat`
--

DROP TABLE IF EXISTS `propriete_habitat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propriete_habitat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_propriete_id` int NOT NULL,
  `valeur_propriete` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_habitat_propriete_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_849F54563B9719DD` (`id_propriete_id`),
  KEY `IDX_849F5456B3F033AD` (`id_habitat_propriete_id`),
  CONSTRAINT `FK_849F54563B9719DD` FOREIGN KEY (`id_propriete_id`) REFERENCES `propriete` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_849F5456B3F033AD` FOREIGN KEY (`id_habitat_propriete_id`) REFERENCES `habitat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propriete_habitat`
--

LOCK TABLES `propriete_habitat` WRITE;
/*!40000 ALTER TABLE `propriete_habitat` DISABLE KEYS */;
/*!40000 ALTER TABLE `propriete_habitat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `region` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (1,'Auvergne-Rh├┤ne-Alpes','images/typehabitat/Auvergne.jpg'),(2,'Bourgogne-Franche-Comt├®','images/typehabitat/Bourgogne.jpg'),(3,'Bretagne','images/typehabitat/Bretagne.jpg'),(4,'Centre-Val de Loire','images/typehabitat/Val-De-Loire.jpg'),(5,'Corse','images/typehabitat/Corse.jpg'),(6,'Grand Est','images/typehabitat/Grand-Est.jpg'),(7,'Hauts-de-France','images/typehabitat/Grand-Est.jpg'),(8,'├Äle-de-France','images/typehabitat/Grand-Est.jpg'),(9,'Normandie','images/typehabitat/Grand-Est.jpg'),(10,'Nouvelle-Aquitaine','images/typehabitat/Grand-Est.jpg'),(11,'Occitanie','images/typehabitat/Grand-Est.jpg'),(12,'Pays de la Loire','images/typehabitat/Grand-Est.jpg'),(13,'Provence-Alpes-C├┤te-d\'Azur','images/typehabitat/Grand-Est.jpg');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stripe`
--

DROP TABLE IF EXISTS `stripe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stripe` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stripe`
--

LOCK TABLES `stripe` WRITE;
/*!40000 ALTER TABLE `stripe` DISABLE KEYS */;
/*!40000 ALTER TABLE `stripe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_habitat`
--

DROP TABLE IF EXISTS `type_habitat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_habitat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_habitat`
--

LOCK TABLES `type_habitat` WRITE;
/*!40000 ALTER TABLE `type_habitat` DISABLE KEYS */;
INSERT INTO `type_habitat` VALUES (1,'Cabane','├Ç jamais associ├®e ├á l\'enfance, il est d├®sormais possible de r├®aliser ce r├¬ve. ├Ç vous de choisir le niveau de confort : minimal pour un esprit authentique et sauvage ou haut de gamme pour vivre l\'aventure sans concession.','images/typehabitat/cabane.jpg'),(2,'Bulle','Passer une nuit dans une bulle c\'est la promesse d\'un voyage hors du temps. Toute en transparence, plus aucune barri├¿re entre vous et le r├¬ve. Une nuit ├á la belle ├®toile n\'a jamais aussi bien port├® son nom.','images/typehabitat/bulle.jpg'),(3,'Roulotte','Moyen de locomotion autant que de vie pour les gens du voyage, la roulotte est un h├®bergement convivial et chaleureux. Tzigane, Irlandaise ou m├¬me Gitane... ├á vous de choisir le style.','images/typehabitat/roulotte.jpg'),(4,'D├┤me','Le D├┤me derri├¿re son aspect simple est un concept ing├®nieux. R├®sistance aux intemp├®ries, facile ├á chauffer : tout est imagin├® pour votre bien-├¬tre.','images/typehabitat/dome.jpg'),(6,'Yourte','La yourte est sans doute l\'h├®bergement qui vous fera voyager. Envie d\'authenticit├® ? Fa├«tes un bond en Asie et vivez ├á la fa├ºon des Mongols, tous les codes sont respect├®s pour vous y croire. Adepte de modernit├® ? Les versions revisit├®es vous plairont !','images/typehabitat/yourte.jpg'),(7,'Tiny House','Une tiny house est, comme son nom l\'indique, une petite maison en bois. Ce concept, n├® du d├®sir de vivre d\'une mani├¿re simple mais confortable en pleine nature, nous vient des ├ëtats-Unis.','images/typehabitat/tiny.jpg'),(8,'Tente','Les tentes n\'ont plus rien de commun quand elles sont suspendues. Offrez une nouvelle dimension insolite ├á ce type d\'h├®bergement, en apesanteur votre ├®quilibre sera la nature !','images/typehabitat/tente.jpg'),(9,'Bateau','Dormir sur un bateau, quoi de plus insolite ? Ajoutez une dimension exceptionnelle ├á votre exp├®rience. Calme et ├®vasion sont les ma├«tres mots, berc├® par les flots votre nuit n\'en sera que plus douce.','images/typehabitat/bateau.jpg');
/*!40000 ALTER TABLE `type_habitat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` int NOT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  `biographie` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Isabelle','[\"ROLE_USER\"]','mdpasse','Isabelle','Durand','202 Rue Desaix','Evry',91000,'images/userDefault.png','vignesht.pro@gmail.com','2016-11-30','F├®minin',646437355,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley'),(2,'Cyril','[\"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$Ukk1UXI2Qk9uTHNkMUQwLg$vXCu0l0NZh96OLS03kl1plZO3JLDZjUPeejV+1/dqEA','Hanouna','Vignesh','202 Rue Desaix','Evry',91000,'98578201a0c75eb665fa3dcdcc636144.jpeg','howtobe@gmail.com','2016-01-01','Homme',646437355,NULL),(3,'zeno','[\"ROLE_USER\"]','mdpasse','Tillai','Vignesh','202 Rue','Evry',91000,'','vignesht.pro@mail.com','2021-03-16','Homme',646437355,NULL),(4,'eshwar','[\"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$Y1R0TkNtU3pvQzkvQVpZTg$LYFIBjeudNV1i6zw6BTs8FE2+984IJXnLllwu0AH2wc','eshwar','tillai','202 Rue Desaix','Evry',72000,'images/userDefault.png','eshwar@gmail.com','2021-03-28','Homme',646437355,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries');
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

-- Dump completed on 2021-09-25 18:14:14
