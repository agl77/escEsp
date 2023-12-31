-- MariaDB dump 10.19  Distrib 10.11.4-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: teste
-- ------------------------------------------------------
-- Server version	10.11.4-MariaDB-1~deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cadastro`
--

DROP TABLE IF EXISTS `cadastro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cadastro` (
  `idcadastro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `formado` tinyint(1) DEFAULT NULL,
  `instituicao` varchar(60) DEFAULT NULL,
  `periodo` int(11) DEFAULT NULL,
  `especialidade` varchar(45) DEFAULT NULL,
  `CPF` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(17) DEFAULT NULL,
  `aceite` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idcadastro`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `esp_valor`
--

DROP TABLE IF EXISTS `esp_valor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esp_valor` (
  `idespvalor` int(11) NOT NULL AUTO_INCREMENT,
  `idcadastro` int(11) DEFAULT NULL,
  `liked` varchar(300) DEFAULT NULL,
  `disliked` varchar(300) DEFAULT NULL,
  `selectedValues` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idespvalor`),
  KEY `esp_valor_FK` (`idcadastro`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `idquestion` int(11) NOT NULL AUTO_INCREMENT,
  `idcadastro` int(11) DEFAULT NULL,
  `pergunta001` varchar(2) DEFAULT NULL,
  `pergunta002` varchar(2) DEFAULT NULL,
  `pergunta003` varchar(2) DEFAULT NULL,
  `pergunta004` varchar(2) DEFAULT NULL,
  `pergunta005` varchar(2) DEFAULT NULL,
  `pergunta006` varchar(2) DEFAULT NULL,
  `pergunta007` varchar(2) DEFAULT NULL,
  `pergunta008` varchar(2) DEFAULT NULL,
  `pergunta009` varchar(2) DEFAULT NULL,
  `pergunta010` varchar(2) DEFAULT NULL,
  `pergunta011` varchar(2) DEFAULT NULL,
  `pergunta012` varchar(2) DEFAULT NULL,
  `pergunta013` varchar(2) DEFAULT NULL,
  `pergunta014` varchar(2) DEFAULT NULL,
  `pergunta015` varchar(2) DEFAULT NULL,
  `pergunta016` varchar(2) DEFAULT NULL,
  `pergunta017` varchar(2) DEFAULT NULL,
  `pergunta018` varchar(2) DEFAULT NULL,
  `pergunta019` varchar(2) DEFAULT NULL,
  `pergunta020` varchar(2) DEFAULT NULL,
  `pergunta021` varchar(2) DEFAULT NULL,
  `pergunta022` varchar(2) DEFAULT NULL,
  `pergunta023` varchar(2) DEFAULT NULL,
  `pergunta024` varchar(2) DEFAULT NULL,
  `pergunta025` varchar(2) DEFAULT NULL,
  `pergunta026` varchar(2) DEFAULT NULL,
  `pergunta027` varchar(2) DEFAULT NULL,
  `pergunta028` varchar(2) DEFAULT NULL,
  `pergunta029` varchar(2) DEFAULT NULL,
  `pergunta030` varchar(2) DEFAULT NULL,
  `pergunta031` varchar(2) DEFAULT NULL,
  `pergunta032` varchar(2) DEFAULT NULL,
  `pergunta033` varchar(2) DEFAULT NULL,
  `pergunta034` varchar(2) DEFAULT NULL,
  `pergunta035` varchar(2) DEFAULT NULL,
  `pergunta036` varchar(2) DEFAULT NULL,
  `pergunta037` varchar(2) DEFAULT NULL,
  `pergunta038` varchar(2) DEFAULT NULL,
  `pergunta039` varchar(2) DEFAULT NULL,
  `pergunta040` varchar(2) DEFAULT NULL,
  `pergunta041` varchar(2) DEFAULT NULL,
  `pergunta042` varchar(2) DEFAULT NULL,
  `pergunta043` varchar(2) DEFAULT NULL,
  `pergunta044` varchar(2) DEFAULT NULL,
  `pergunta045` varchar(2) DEFAULT NULL,
  `pergunta046` varchar(2) DEFAULT NULL,
  `pergunta047` varchar(2) DEFAULT NULL,
  `pergunta048` varchar(2) DEFAULT NULL,
  `pergunta049` varchar(2) DEFAULT NULL,
  `pergunta050` varchar(2) DEFAULT NULL,
  `pergunta051` varchar(2) DEFAULT NULL,
  `pergunta052` varchar(2) DEFAULT NULL,
  `pergunta053` varchar(2) DEFAULT NULL,
  `pergunta054` varchar(2) DEFAULT NULL,
  `pergunta055` varchar(2) DEFAULT NULL,
  `pergunta056` varchar(2) DEFAULT NULL,
  `pergunta057` varchar(2) DEFAULT NULL,
  `pergunta058` varchar(2) DEFAULT NULL,
  `pergunta059` varchar(2) DEFAULT NULL,
  `pergunta060` varchar(2) DEFAULT NULL,
  `pergunta061` varchar(2) DEFAULT NULL,
  `pergunta062` varchar(2) DEFAULT NULL,
  `pergunta063` varchar(2) DEFAULT NULL,
  `pergunta064` varchar(2) DEFAULT NULL,
  `pergunta065` varchar(2) DEFAULT NULL,
  `pergunta066` varchar(2) DEFAULT NULL,
  `pergunta067` varchar(2) DEFAULT NULL,
  `pergunta068` varchar(2) DEFAULT NULL,
  `pergunta069` varchar(2) DEFAULT NULL,
  `pergunta070` varchar(2) DEFAULT NULL,
  `pergunta071` varchar(2) DEFAULT NULL,
  `pergunta072` varchar(2) DEFAULT NULL,
  `pergunta073` varchar(2) DEFAULT NULL,
  `pergunta074` varchar(2) DEFAULT NULL,
  `pergunta075` varchar(2) DEFAULT NULL,
  `pergunta076` varchar(2) DEFAULT NULL,
  `pergunta077` varchar(2) DEFAULT NULL,
  `pergunta078` varchar(2) DEFAULT NULL,
  `pergunta079` varchar(2) DEFAULT NULL,
  `pergunta080` varchar(2) DEFAULT NULL,
  `pergunta081` varchar(2) DEFAULT NULL,
  `pergunta082` varchar(2) DEFAULT NULL,
  `pergunta083` varchar(2) DEFAULT NULL,
  `pergunta084` varchar(2) DEFAULT NULL,
  `pergunta085` varchar(2) DEFAULT NULL,
  `pergunta086` varchar(2) DEFAULT NULL,
  `pergunta087` varchar(2) DEFAULT NULL,
  `pergunta088` varchar(2) DEFAULT NULL,
  `pergunta089` varchar(2) DEFAULT NULL,
  `pergunta090` varchar(2) DEFAULT NULL,
  `pergunta091` varchar(2) DEFAULT NULL,
  `pergunta092` varchar(2) DEFAULT NULL,
  `pergunta093` varchar(2) DEFAULT NULL,
  `pergunta094` varchar(2) DEFAULT NULL,
  `pergunta095` varchar(2) DEFAULT NULL,
  `pergunta096` varchar(2) DEFAULT NULL,
  `pergunta097` varchar(2) DEFAULT NULL,
  `pergunta098` varchar(2) DEFAULT NULL,
  `pergunta099` varchar(2) DEFAULT NULL,
  `pergunta100` varchar(2) DEFAULT NULL,
  `pergunta101` varchar(2) DEFAULT NULL,
  `pergunta102` varchar(2) DEFAULT NULL,
  `pergunta103` varchar(2) DEFAULT NULL,
  `pergunta104` varchar(2) DEFAULT NULL,
  `pergunta105` varchar(2) DEFAULT NULL,
  `pergunta106` varchar(2) DEFAULT NULL,
  `pergunta107` varchar(2) DEFAULT NULL,
  `pergunta108` varchar(2) DEFAULT NULL,
  `pergunta109` varchar(2) DEFAULT NULL,
  `pergunta110` varchar(2) DEFAULT NULL,
  `pergunta111` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`idquestion`),
  KEY `question_FK` (`idcadastro`),
  CONSTRAINT `question_FK` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `idrange` int(11) NOT NULL AUTO_INCREMENT,
  `idcadastro` int(11) DEFAULT NULL,
  `qrange1` varchar(2) DEFAULT NULL,
  `qrange2` varchar(2) DEFAULT NULL,
  `qrange3` varchar(2) DEFAULT NULL,
  `qrange4` varchar(2) DEFAULT NULL,
  `qrange5` varchar(2) DEFAULT NULL,
  `qrange6` varchar(2) DEFAULT NULL,
  `qrange7` varchar(2) DEFAULT NULL,
  `qrange8` varchar(2) DEFAULT NULL,
  `qrange9` varchar(2) DEFAULT NULL,
  `qrange10` varchar(2) DEFAULT NULL,
  `qrange11` varchar(2) DEFAULT NULL,
  `qrange12` varchar(2) DEFAULT NULL,
  `qrange13` varchar(2) DEFAULT NULL,
  `qrange14` varchar(2) DEFAULT NULL,
  `qrange15` varchar(2) DEFAULT NULL,
  `qrange16` varchar(2) DEFAULT NULL,
  `qrange17` varchar(2) DEFAULT NULL,
  `qrange18` varchar(2) DEFAULT NULL,
  `qrange19` varchar(2) DEFAULT NULL,
  `qrange20` varchar(2) DEFAULT NULL,
  `qrange21` varchar(2) DEFAULT NULL,
  `qrange22` varchar(2) DEFAULT NULL,
  `qrange23` varchar(2) DEFAULT NULL,
  `qrange24` varchar(2) DEFAULT NULL,
  `qrange25` varchar(2) DEFAULT NULL,
  `qrange26` varchar(2) DEFAULT NULL,
  `qrange27` varchar(2) DEFAULT NULL,
  `qrange28` varchar(2) DEFAULT NULL,
  `qrange29` varchar(2) DEFAULT NULL,
  `qrange30` varchar(2) DEFAULT NULL,
  `qrange31` varchar(2) DEFAULT NULL,
  `qrange32` varchar(2) DEFAULT NULL,
  `qrange33` varchar(2) DEFAULT NULL,
  `qrange34` varchar(2) DEFAULT NULL,
  `qrange35` varchar(2) DEFAULT NULL,
  `qrange36` varchar(2) DEFAULT NULL,
  `qrange37` varchar(2) DEFAULT NULL,
  `qrange38` varchar(2) DEFAULT NULL,
  `qrange39` varchar(2) DEFAULT NULL,
  `qrange40` varchar(2) DEFAULT NULL,
  `qrange41` varchar(2) DEFAULT NULL,
  `qrange42` varchar(2) DEFAULT NULL,
  `qrange43` varchar(2) DEFAULT NULL,
  `qrange44` varchar(2) DEFAULT NULL,
  `qrange45` varchar(2) DEFAULT NULL,
  `qrange46` varchar(2) DEFAULT NULL,
  `qrange47` varchar(2) DEFAULT NULL,
  `qrange48` varchar(2) DEFAULT NULL,
  `qrange49` varchar(2) DEFAULT NULL,
  `qrange50` varchar(2) DEFAULT NULL,
  `qrange51` varchar(2) DEFAULT NULL,
  `qrange52` varchar(2) DEFAULT NULL,
  `qrange53` varchar(2) DEFAULT NULL,
  `qrange54` varchar(2) DEFAULT NULL,
  `qrange55` varchar(2) DEFAULT NULL,
  `qrange56` varchar(2) DEFAULT NULL,
  `qrange57` varchar(2) DEFAULT NULL,
  `qrange58` varchar(2) DEFAULT NULL,
  `qrange59` varchar(2) DEFAULT NULL,
  `qrange60` varchar(2) DEFAULT NULL,
  `qrange61` varchar(2) DEFAULT NULL,
  `qrange62` varchar(2) DEFAULT NULL,
  `qrange63` varchar(2) DEFAULT NULL,
  `qrange64` varchar(2) DEFAULT NULL,
  `qrange65` varchar(2) DEFAULT NULL,
  `qrange66` varchar(2) DEFAULT NULL,
  `qrange67` varchar(2) DEFAULT NULL,
  `qrange68` varchar(2) DEFAULT NULL,
  `qrange69` varchar(2) DEFAULT NULL,
  `qrange70` varchar(2) DEFAULT NULL,
  `qrange71` varchar(2) DEFAULT NULL,
  `qrange72` varchar(2) DEFAULT NULL,
  `qrange73` varchar(2) DEFAULT NULL,
  `qrange74` varchar(2) DEFAULT NULL,
  `qrange75` varchar(2) DEFAULT NULL,
  `qrange76` varchar(2) DEFAULT NULL,
  `qrange77` varchar(2) DEFAULT NULL,
  `qrange78` varchar(2) DEFAULT NULL,
  `qrange79` varchar(2) DEFAULT NULL,
  `qrange80` varchar(2) DEFAULT NULL,
  `qrange81` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`idrange`),
  KEY `slide_FK` (`idcadastro`),
  CONSTRAINT `slide_FK` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`idcadastro`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-17 10:41:47
