-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: Upev2016_Sup
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.10-MariaDB

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
-- Table structure for table `Alumnos`
--

DROP TABLE IF EXISTS `Alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Alumnos` (
  `idAlumnos` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosAcreditados` int(11) NOT NULL DEFAULT '0',
  `AlumnosInscritos` int(11) NOT NULL DEFAULT '0',
  `AlumnosEgresadosCohorte` int(11) NOT NULL DEFAULT '0',
  `AlumnosTotalesCohorte` int(11) NOT NULL DEFAULT '0',
  `AlumnosTituladosGeneracion` int(11) NOT NULL DEFAULT '0',
  `AlumnosEgresadosGeneracion` int(11) NOT NULL DEFAULT '0',
  `AlumnosConAdeudos` int(11) DEFAULT '0',
  `TotalMatriculasPorPrograma` int(11) DEFAULT '0',
  `AlumnosMercadoLaboral` int(11) DEFAULT '0',
  `TotalAlumnosEgresoAcademico` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  `comprobante3` varchar(1000) DEFAULT NULL,
  `comprobante4` varchar(1000) DEFAULT NULL,
  `comprobante5` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idAlumnos`,`idEvaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Alumnos`
--

LOCK TABLES `Alumnos` WRITE;
/*!40000 ALTER TABLE `Alumnos` DISABLE KEYS */;
INSERT INTO `Alumnos` VALUES (1,1,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(2,2,0,200,0,300,0,400,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(3,3,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(4,4,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(5,5,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(6,6,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(7,7,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(8,8,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(9,9,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(10,10,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(11,11,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(12,12,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(13,13,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(14,14,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(15,15,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(16,16,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(17,17,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(18,18,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(19,19,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(20,23,0,23,0,12,0,12,0,0,0,0,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AlumnosInvestigacion`
--

DROP TABLE IF EXISTS `AlumnosInvestigacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AlumnosInvestigacion` (
  `idAlumnosInvestigacion` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosCoautores` int(11) DEFAULT '0',
  `ProfesoresConProyectos` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idAlumnosInvestigacion`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AlumnosInvestigacion`
--

LOCK TABLES `AlumnosInvestigacion` WRITE;
/*!40000 ALTER TABLE `AlumnosInvestigacion` DISABLE KEYS */;
INSERT INTO `AlumnosInvestigacion` VALUES (1,1,0,0,NULL),(2,2,34,893,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,23,2,3,NULL);
/*!40000 ALTER TABLE `AlumnosInvestigacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ApoyoEducativo`
--

DROP TABLE IF EXISTS `ApoyoEducativo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ApoyoEducativo` (
  `idApoyoEducativo` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `LibrosActualizados` int(11) DEFAULT '0',
  `TotalAcervoLibros` int(11) DEFAULT '0',
  `MantenimientoAtendido` int(11) DEFAULT '0',
  `MantenimientoSolicitado` int(11) DEFAULT '0',
  `LimpiezaAtendida` int(11) DEFAULT '0',
  `LimpiezaProgramada` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  `comprobante3` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idApoyoEducativo`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApoyoEducativo`
--

LOCK TABLES `ApoyoEducativo` WRITE;
/*!40000 ALTER TABLE `ApoyoEducativo` DISABLE KEYS */;
INSERT INTO `ApoyoEducativo` VALUES (1,1,0,0,0,0,0,0,NULL,NULL,NULL),(2,2,0,900,54,45,56,45,NULL,NULL,NULL),(3,3,0,0,0,0,0,0,NULL,NULL,NULL),(4,4,0,0,0,0,0,0,NULL,NULL,NULL),(5,5,0,0,0,0,0,0,NULL,NULL,NULL),(6,6,0,0,0,0,0,0,NULL,NULL,NULL),(7,7,0,0,0,0,0,0,NULL,NULL,NULL),(8,8,0,0,0,0,0,0,NULL,NULL,NULL),(9,9,0,0,0,0,0,0,NULL,NULL,NULL),(10,10,0,0,0,0,0,0,NULL,NULL,NULL),(11,11,0,0,0,0,0,0,NULL,NULL,NULL),(12,12,0,0,0,0,0,0,NULL,NULL,NULL),(13,13,0,0,0,0,0,0,NULL,NULL,NULL),(14,14,0,0,0,0,0,0,NULL,NULL,NULL),(15,15,0,0,0,0,0,0,NULL,NULL,NULL),(16,16,0,0,0,0,0,0,NULL,NULL,NULL),(17,17,0,0,0,0,0,0,NULL,NULL,NULL),(18,18,0,0,0,0,0,0,NULL,NULL,NULL),(19,19,0,0,0,0,0,0,NULL,NULL,NULL),(20,23,0,0,0,0,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ApoyoEducativo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Becas`
--

DROP TABLE IF EXISTS `Becas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Becas` (
  `idBecas` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosBeca` int(11) DEFAULT '0',
  `TotalAlumnos` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idBecas`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Becas`
--

LOCK TABLES `Becas` WRITE;
/*!40000 ALTER TABLE `Becas` DISABLE KEYS */;
INSERT INTO `Becas` VALUES (1,1,0,0,NULL),(2,2,2,20,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,23,0,0,NULL);
/*!40000 ALTER TABLE `Becas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bloques`
--

DROP TABLE IF EXISTS `Bloques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bloques` (
  `idBloques` int(11) NOT NULL AUTO_INCREMENT,
  `idUnidad` int(11) NOT NULL,
  `Nombre` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idBloques`)
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bloques`
--

LOCK TABLES `Bloques` WRITE;
/*!40000 ALTER TABLE `Bloques` DISABLE KEYS */;
INSERT INTO `Bloques` VALUES (124,1,'	Tronco Común 	'),(125,1,'	Técnico en Construcción	'),(126,1,'	Técnico en Procesos Industriales	'),(127,1,'	Técnico en Sistemas de Control Eléctrico	'),(128,1,'	Técnico en Sistemas Digitales	'),(129,2,'	Tronco Común 	'),(130,2,'	Técnico en Aeronáutica	'),(131,2,'	Técnico en Dibujo Asistido por Computadora	'),(132,2,'	Técnico en Diseño Grafico Digital	'),(133,2,'	Técnico en Máquinas con Sistemas Automatizados	'),(134,2,'	Técnico en Metalurgia	'),(135,2,'	Técnico en Sistemas Automotrices	'),(136,3,'	Tronco Común 	'),(137,3,'	Técnico en Aeronáutica	'),(138,3,'	Técnico en Computación	'),(139,3,'	Técnico en Manufactura Asistida por Computadora	'),(140,3,'	Técnico en Sistemas Automotrices	'),(141,3,'	Técnico en Sistemas de Control Eléctrico	'),(142,3,'	Técnico en Sistemas Digitales	'),(143,4,'	Tronco Común 	'),(144,4,'	Técnico en Aeronáutica	'),(145,4,'	Técnico en Construcción	'),(146,4,'	Técnico en Instalaciones y Mantenimiento Eléctricos	'),(147,4,'	Técnico en Procesos Industriales	'),(148,4,'	Técnico en Sistemas Automotrices	'),(149,7,'	Tronco Común 	'),(150,7,'	Técnico en Aeronáutica	'),(151,7,'	Técnico en Construcción	'),(152,7,'	Técnico en Instalaciones y Mantenimiento Eléctricos	'),(153,7,'	Técnico en Mantenimiento Industrial	'),(154,7,'	Técnico en Sistemas Automotrices	'),(155,7,'	Técnico en Soldadura Industrial	'),(156,8,'	Tronco Común 	'),(157,8,'	Técnico en Computación	'),(158,8,'	Técnico en Mantenimiento Industrial	'),(159,8,'	Técnico en Plásticos	'),(160,8,'	Técnico en Sistemas Automotrices	'),(161,9,'	Tronco Común 	'),(162,9,'	Técnico en Máquinas con Sistemas Automatizados	'),(163,9,'	Técnico en Programación	'),(164,9,'	Técnico en Sistemas Digitales	'),(165,10,'	Tronco Común 	'),(166,10,'	Técnico en Diagnóstico y Mejoramiento Ambiental	'),(167,10,'	Técnico en Metrología y Control de Calidad	'),(168,10,'	Técnico en Telecomunicaciones	'),(169,11,'	Tronco Común 	'),(170,11,'	Técnico en Construcción	'),(171,11,'	Técnico en Instalaciones y Mantenimiento Eléctricos	'),(172,11,'	Técnico en Procesos Industriales	'),(173,11,'	Técnico en Telecomunicaciones	'),(174,18,'	Tronco Común 	'),(175,18,'	Técnico en Automatización y Control Eléctrico Industrial	'),(176,18,'	Técnico en Redes de Cómputo	'),(177,18,'	Técnico en Sistemas Automotrices	'),(178,18,'	Técnico en Sistemas Constructivos Asistidos por Computadora	'),(179,18,'	Técnico en Sistemas Mecánicos Industriales	'),(180,6,'	Tronco Común 	'),(181,6,'	Técnico en Laboratorista Clínico	'),(182,6,'	Técnico en Ecología	'),(183,6,'	Técnico en Enfermería	'),(184,6,'	Técnico  Laboratorista Químico	'),(185,15,'	Tronco Común 	'),(186,15,'	Técnico en Alimentos	'),(187,15,'	Técnico  Laboratorista Clínico	'),(188,15,'	Técnico en Nutrición Humana 	'),(189,12,'	Tronco Común 	'),(190,12,'	Técnico en Administración	'),(191,12,'	Técnico en Contaduría	'),(192,12,'	Técnico en Informática	'),(193,13,'	Tronco Común 	'),(194,13,'	Técnico en Administración	'),(195,13,'	Técnico en Contaduría	'),(196,13,'	Técnico en Informática	'),(197,13,'	Técnico en Administraciòn de Empresas Turìsticas	'),(198,5,'	Tronco Común 	'),(199,5,'	Técnico en Comercio Internacional	'),(200,5,'	Técnico en Contaduría	'),(201,5,'	Técnico en Informática	'),(202,14,'	Tronco Común 	'),(203,14,'	Técnico en Contaduría	'),(204,14,'	Técnico en Informática	'),(205,14,'	Técnico en Mercadotecnia	'),(206,16,'	Tronco Común 	'),(207,16,'	Técnico en Mantenimiento Industrial	'),(208,16,'	Técnico en Procesos Industriales	'),(209,16,'	Técnico en Máquinas con Sistemas Automatizados	'),(210,16,'	Técnico en Enfermería	'),(211,16,'	Técnico en Laboratorista Clínico	'),(212,16,'	Técnico en Comercio Internacional	'),(213,16,'	Técnico en Administración	'),(214,17,'	Tronco Común 	'),(215,17,'	Técnico en Aeronáutica	'),(216,17,'	Técnico en Sistemas Automotrices	'),(217,17,'	Técnico en Metrología y Control de Calidad	'),(218,17,'	Técnico en Alimentos	'),(219,17,'	Técnico en Administracion de  Empresas Turisticas	'),(220,17,'	Técnico en Comercio Internacional	'),(221,19,'Ingeniería en Comunicaciones y Electrónica'),(222,19,'Ingeniería en Control y Automatización'),(223,19,'Ingeniería Eléctrica'),(224,19,'Ingeniería en Sistemas Automotrices'),(225,20,'Ingeniería en Computación'),(226,20,'Ingeniería en Comunicaciones y Electrónica'),(227,20,'Ingeniería Mecánica'),(228,20,'Ingeniería en Sistemas Automotrices'),(229,21,'Ingeniería Mecánica'),(230,21,'Ingeniería en Robótica Industrial'),(231,21,'Ingeniería en Sistemas Automotrices'),(232,22,'Ingeniería en Aeronáutica'),(233,22,'Ingeniería en Sistemas Automotrices'),(234,23,'Ingeniería Civil'),(235,24,'Ingeniero Arquitecto'),(236,25,'Ingeniería Petrolera'),(237,25,'Ingeniería Geológica'),(238,25,'Ingeniería Geofísica'),(239,25,'Ingeniería Topográfica y Fotogramétrica'),(240,26,'Ingeniería Textil'),(241,27,'Ingeniería Química Industrial'),(242,27,'Ingeniería Química Petrolera '),(243,27,'Ingeniería Metalurgia Y Materiales'),(244,28,'Ingeniería Matemática'),(245,28,'Licenciatura en Física y Matemáticas'),(246,29,'Ingeniería en Sistemas Computacionales'),(247,29,'Ingeniería en Sistemas Automotrices'),(248,30,'Licenciatura en Administración Industrial'),(249,30,'Ingeniería Industrial'),(250,30,'Ingeniería en Informática'),(251,30,'Licenciatura en Ciencias de la Informática'),(252,30,'Ingeniería en Transporte'),(253,30,'Ingeniería en Sistemas Automotrices'),(254,31,'Ingeniería Telemática'),(255,31,'Ingeniería Mecatrónica'),(256,31,'Ingeniería Biónica'),(257,31,'Ingeniería en Sistemas Automotrices'),(258,32,'Ingeniería en Alimentos'),(259,32,'Ingeniería Ambiental'),(260,32,'Ingeniería Biomédica'),(261,32,'Ingeniería Biotecnológica'),(262,32,'Ingeniería Farmacéutica'),(263,33,'Ingeniería Biotecnológica'),(264,33,'Ingeniería en Aeronáutica'),(265,33,'Ingeniería en Sistemas Automotrices'),(266,33,'Ingeniería Farmacéutica'),(267,33,'Ingeniería Industrial'),(268,34,'Ingeniería Mecatrónica'),(269,34,'Ingeniería en Alimentos'),(270,34,'Ingeniería en Sistemas Computacionales'),(271,34,'Ingeniería Ambiental'),(272,34,'Ingeniería Metalurgia '),(273,35,'Ingeniería Mecatrónica'),(274,35,'Ingeniería en Sistemas Automotrices'),(275,36,'Licenciatura en Biología'),(276,36,'Ingeniería Bioquímica'),(277,36,'Ingeniería en Sistemas Ambientales'),(278,36,'Químico Bacteriólogo Parasitólogo'),(279,36,'Químico Farmacéutico Industrial'),(280,37,'Médico Cirujano y Partero'),(281,38,'Médico Cirujano y Partero'),(282,38,'Médico Cirujano y Homeópata'),(283,39,'Licenciatura en Enfermería'),(284,39,'Licenciatura en Enfermería y Obstetricia'),(285,40,'Licenciatura en Enfermería'),(286,40,'Médico Cirujano y Partero'),(287,40,'Licenciatura en Nutrición'),(288,40,'Licenciatura en Odontología'),(289,40,'Licenciatura en Optometría'),(290,40,'Licenciatura en Trabajo Social'),(291,41,'Licenciatura en Odontología'),(292,41,'Licenciatura en Optometría'),(293,41,'Licenciatura en Psicología'),(294,42,'Contaduría Pública'),(295,42,'Licenciatura en Negocios Internacionales'),(296,42,'Licenciatura en Relaciones Comerciales'),(297,42,'Licenciatura en Administración y Desarrollo Empresarial ??'),(298,43,'Contaduría Pública'),(299,43,'Licenciatura en Negocios Internacionales'),(300,43,'Licenciatura en Relaciones Comerciales'),(301,45,'Licenciatura en Economía'),(302,46,'Licenciatura en Turismo');
/*!40000 ALTER TABLE `Bloques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dimension`
--

DROP TABLE IF EXISTS `Dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Dimension` (
  `idDimension` int(11) NOT NULL AUTO_INCREMENT,
  `idFuncion` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Valor` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`idDimension`,`idFuncion`,`idEvaluacion`),
  KEY `fk_Dimension_Funcion1_idx` (`idFuncion`,`idEvaluacion`),
  CONSTRAINT `fk_Dimension_Funcion1` FOREIGN KEY (`idFuncion`, `idEvaluacion`) REFERENCES `Funcion` (`idFuncion`, `idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dimension`
--

LOCK TABLES `Dimension` WRITE;
/*!40000 ALTER TABLE `Dimension` DISABLE KEYS */;
/*!40000 ALTER TABLE `Dimension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Docentes`
--

DROP TABLE IF EXISTS `Docentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Docentes` (
  `idDocentes` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `TotalHorasBase` int(11) DEFAULT '0',
  `TotalHorasReglamento` int(11) DEFAULT '0',
  `DocentesActivosProductivo` int(11) DEFAULT '0',
  `TotalDocentesContratadosAsignatura` int(11) DEFAULT '0' COMMENT '	',
  `ProfesoresActualizacion` int(11) DEFAULT '0',
  `TotalProfesores` int(11) DEFAULT '0',
  `EvaluacionIndividual` int(11) DEFAULT '0',
  `DocentesPertenecientes` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  `comprobante3` varchar(1000) DEFAULT NULL,
  `comprobante4` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idDocentes`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Docentes`
--

LOCK TABLES `Docentes` WRITE;
/*!40000 ALTER TABLE `Docentes` DISABLE KEYS */;
INSERT INTO `Docentes` VALUES (1,1,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(2,2,0,14444,0,11,0,788,0,78,NULL,NULL,NULL,NULL),(3,3,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(4,4,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(5,5,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(6,6,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(7,7,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(8,8,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(9,9,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(10,10,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(11,11,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(12,12,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(13,13,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(14,14,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(15,15,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(16,16,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(17,17,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(18,18,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(19,19,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL),(20,23,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Docentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Elementos`
--

DROP TABLE IF EXISTS `Elementos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Elementos` (
  `idElementos` int(11) NOT NULL AUTO_INCREMENT,
  `idDimension` int(11) NOT NULL,
  `idFuncion` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Valor` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`idElementos`,`idDimension`,`idFuncion`,`idEvaluacion`),
  KEY `fk_Elementos_Dimension1_idx` (`idDimension`,`idFuncion`,`idEvaluacion`),
  CONSTRAINT `fk_Elementos_Dimension1` FOREIGN KEY (`idDimension`, `idFuncion`, `idEvaluacion`) REFERENCES `Dimension` (`idDimension`, `idFuncion`, `idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Elementos`
--

LOCK TABLES `Elementos` WRITE;
/*!40000 ALTER TABLE `Elementos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Elementos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Evaluacion`
--

DROP TABLE IF EXISTS `Evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Evaluacion` (
  `idEvaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `idUnidad` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Al_rendimiento` float DEFAULT '0',
  `Al_eficiencia` float DEFAULT '0',
  `Al_titulacion` float DEFAULT '0',
  `Al_promocion` float DEFAULT '0',
  `Al_cal_rendimiento` int(11) DEFAULT '0' COMMENT '\n',
  `Al_cal_eficiencia` int(11) DEFAULT '0',
  `Al_cal_titulacion` int(11) DEFAULT '0',
  `Al_cal_promocion` int(11) DEFAULT '0',
  `Al_Total` float DEFAULT '0',
  `Do_aprovechamiento` float DEFAULT '0',
  `Do_activos` float DEFAULT '0',
  `Do_actualizados` float DEFAULT '0',
  `Do_desempeno` float DEFAULT '0',
  `Do_cal_aprovechamiento` int(11) DEFAULT '0',
  `Do_cal_activos` int(11) DEFAULT '0',
  `Do_cal_actualizados` int(11) DEFAULT '0',
  `Do_cal_desempeno` int(11) DEFAULT '0',
  `Do_Total` float DEFAULT '0',
  `Pr_evaluados` float DEFAULT '0',
  `Pr_cal_evaluados` int(11) DEFAULT '0',
  `Pr_Total` float DEFAULT '0',
  `In_talleres` float DEFAULT '0',
  `In_aulas` float DEFAULT '0',
  `In_laboratorios` float DEFAULT '0',
  `In_cal_talleres` int(11) DEFAULT '0',
  `In_cal_aulas` int(11) DEFAULT '0',
  `In_cal_laboratorios` int(11) DEFAULT '0',
  `In_Total` float DEFAULT '0',
  `Bc_manutencion` float DEFAULT '0',
  `Bc_cal_manutencion` int(11) DEFAULT '0',
  `Bc_Total` float DEFAULT '0',
  `Tu_alumnos` float DEFAULT '0',
  `Tu_cal_alumnos` int(11) DEFAULT '0',
  `Tu_Total` float DEFAULT '0',
  `Se_bibliotecas_actualizados` float DEFAULT '0',
  `Se_bibliotecas_alumnos` float DEFAULT '0',
  `Se_computo` float DEFAULT '0',
  `Se_ml_mantenimiento` float DEFAULT '0',
  `Se_ml_limpieza` float DEFAULT '0',
  `Se_cal_bibliotecas_actualizados` int(11) DEFAULT '0',
  `Se_cal_bibliotecas_alumnos` int(11) DEFAULT '0',
  `Se_cal_computo` int(11) DEFAULT '0',
  `Se_cal_ml_mantenimiento` int(11) DEFAULT '0',
  `Se_cal_ml_limpieza` int(11) DEFAULT '0',
  `Se_Total` float DEFAULT '0',
  `Ss_inscritos` float DEFAULT '0',
  `Ss_cal_inscritos` int(11) DEFAULT '0',
  `Ss_Total` float DEFAULT '0',
  `Ve_alumnos` float DEFAULT '0',
  `Ve_cal_alumnos` int(11) DEFAULT '0',
  `Ve_Total` float DEFAULT '0',
  `Pv_proyectos` float DEFAULT '0',
  `Pv_cal_proyectos` int(11) DEFAULT '0',
  `Pv_Total` float DEFAULT '0',
  `Ai_profesores` float DEFAULT '0',
  `Ai_cal_profesores` int(11) DEFAULT '0',
  `Ai_Total` float DEFAULT '0',
  `Pa_investigacion` float DEFAULT '0',
  `Pa_cal_investigacion` int(11) DEFAULT '0',
  `Pa_Total` float DEFAULT '0',
  `Ie_inovaciones` float DEFAULT '0',
  `Ie_investigaciones` float DEFAULT '0',
  `Ie_cal_inovaciones` int(11) DEFAULT '0',
  `Ie_cal_investigaciones` int(11) DEFAULT '0',
  `Ie_Total` float DEFAULT '0',
  `Ra_inversion` float DEFAULT '0',
  `Ra_cal_inversion` int(11) DEFAULT '0',
  `Ra_Total` float DEFAULT '0',
  `CreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idEvaluacion`,`idUnidad`),
  KEY `idUnidadFK_idx` (`idUnidad`),
  CONSTRAINT `idUnidad2` FOREIGN KEY (`idUnidad`) REFERENCES `Unidad` (`idUnidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evaluacion`
--

LOCK TABLES `Evaluacion` WRITE;
/*!40000 ALTER TABLE `Evaluacion` DISABLE KEYS */;
INSERT INTO `Evaluacion` VALUES (1,13,'Periodo2016','Periodo2016',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-08 04:11:06'),(2,2,'Periodo2016',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-08 08:18:32'),(3,1,'1',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(4,3,'3',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(5,4,'4',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(6,5,'5',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(7,6,'6',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(8,7,'7',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(9,8,'8',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(10,9,'9',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(11,10,'10',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(12,11,'11',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(13,12,'12',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(14,13,'13',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(15,14,'14',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(16,15,'15',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(17,16,'16',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(18,17,'17',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(19,18,'18',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-11 04:41:39'),(23,30,'30',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-04-15 00:02:04');
/*!40000 ALTER TABLE `Evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Funcion`
--

DROP TABLE IF EXISTS `Funcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Funcion` (
  `idFuncion` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Valor` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`idFuncion`,`idEvaluacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Funcion`
--

LOCK TABLES `Funcion` WRITE;
/*!40000 ALTER TABLE `Funcion` DISABLE KEYS */;
/*!40000 ALTER TABLE `Funcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Indicador1`
--

DROP TABLE IF EXISTS `Indicador1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Indicador1` (
  `idIndicador1` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(1000) DEFAULT NULL,
  `Descripcion` varchar(1000) DEFAULT NULL,
  `Valor` float DEFAULT NULL,
  PRIMARY KEY (`idIndicador1`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Indicador1`
--

LOCK TABLES `Indicador1` WRITE;
/*!40000 ALTER TABLE `Indicador1` DISABLE KEYS */;
INSERT INTO `Indicador1` VALUES (1,'Desempeño',NULL,25),(2,'Oferta educativa',NULL,25),(3,'Apoyo',NULL,15),(4,'Vinculación',NULL,15),(5,'Investigación',NULL,10),(6,'Gestión administrativa',NULL,10);
/*!40000 ALTER TABLE `Indicador1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Indicador2`
--

DROP TABLE IF EXISTS `Indicador2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Indicador2` (
  `idIndicador2` int(11) NOT NULL AUTO_INCREMENT,
  `idIndicador1` int(11) NOT NULL,
  `Nombre` varchar(1000) DEFAULT NULL,
  `Descripcion` varchar(1000) DEFAULT NULL,
  `Valor` float DEFAULT NULL,
  PRIMARY KEY (`idIndicador2`,`idIndicador1`),
  KEY `idIndicador1_idx` (`idIndicador1`),
  CONSTRAINT `idIndicador1` FOREIGN KEY (`idIndicador1`) REFERENCES `Indicador1` (`idIndicador1`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Indicador2`
--

LOCK TABLES `Indicador2` WRITE;
/*!40000 ALTER TABLE `Indicador2` DISABLE KEYS */;
INSERT INTO `Indicador2` VALUES (1,1,'Alumno',NULL,50),(2,1,'Perfil Docente',NULL,50),(3,2,'Programas Acreditados',NULL,25),(4,2,'Programas Académicos',NULL,25),(5,2,'Infraestructura',NULL,50),(6,3,'Becas',NULL,33),(7,3,'Tutorias',NULL,33),(8,3,'Servicios de apoyo educativo',NULL,34),(9,4,'Servicio Social',NULL,35),(10,4,'Practicas Profesionales',NULL,35),(11,4,'Proyectos Vinculados',NULL,30),(12,5,'Apoyo de la investigación a la docencia',NULL,50),(13,5,'Innovación e investigación educativa',NULL,50),(14,6,'Recursos Autogenerados',NULL,100);
/*!40000 ALTER TABLE `Indicador2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Indicador3`
--

DROP TABLE IF EXISTS `Indicador3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Indicador3` (
  `idIndicador3` int(11) NOT NULL AUTO_INCREMENT,
  `idIndicador2` int(11) NOT NULL,
  `idIndicador1` int(11) NOT NULL,
  `Nombre` varchar(1000) DEFAULT NULL,
  `Indicadores` varchar(200) NOT NULL,
  `Descripcion` varchar(1000) DEFAULT NULL,
  `Despegable` tinyint(1) NOT NULL,
  `Metodo` varchar(500) NOT NULL,
  `Valor` float DEFAULT NULL,
  `campo1` varchar(400) DEFAULT NULL,
  `campo1id` varchar(50) DEFAULT NULL,
  `campo2` varchar(400) DEFAULT NULL,
  `campo2id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idIndicador3`,`idIndicador2`,`idIndicador1`),
  KEY `fk_Indicador3_Indicador21_idx` (`idIndicador2`,`idIndicador1`),
  CONSTRAINT `fk_Indicador3_Indicador21` FOREIGN KEY (`idIndicador2`, `idIndicador1`) REFERENCES `Indicador2` (`idIndicador2`, `idIndicador1`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Indicador3`
--

LOCK TABLES `Indicador3` WRITE;
/*!40000 ALTER TABLE `Indicador3` DISABLE KEYS */;
INSERT INTO `Indicador3` VALUES (1,1,1,'Rendimiento','Alumno en situación escolar regular ','Porcentaje de alumnos que han aprobado todas las unidades de aprendizaje en las que han estado inscritos por Unidad  académica  ',1,'(Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos  / Total de matrícula inscrita)*100',20,'Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos por programa académico ','a1','Total de matrícula inscrita por programa académico*100','b1'),(2,1,1,'Eficiencia Terminal','Eficiencia Terminal','Porcentaje de alumnos que egresan por cohorte generacional por programa académico',1,'(Sumatoria-Número de alumnos del cohorte A que egresan  en el año n / total de alumnos en el cohorte A)',20,'Sumatoria-Número de alumnos del cohorte A que egresan  en el año n por programa académico','a2','Total de alumnos admitidos al programa académico en el cohorte A','b2'),(3,1,1,'Titulación','Alumnos titulados ','Porcentaje de alumnos titulados hasta tres años después de egresar por programa académico',1,'(Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico /total de la matrícula de egreso del mismo periodo por programa académico)*100',20,'Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico','a3','Total de la matrícula de egreso del mismo periodo por programa académico*100','b3'),(4,1,1,'Fuera de Reglamento','Alumno en riesgo de abandono por situación académica.','Porcentaje de alumnos con unidades de aprendizaje con adeudo, defasadas por 2 o más periodos escolares. ',1,'(Número de alumnos con unidades de aprendizaje con adeudo, desfasadas por 2 0 más periodos escolares / Total de matrícula inscrita por programa académico) *100',20,'Número de alumnos con unidades de aprendizaje defasadas por 2 o más periodos escolares','a4','Total de matrícula inscrita por programa académico por semestre*100','b4'),(5,1,1,'Inserción Laboral ','Recien egresados en inserción laboral','Porcentaje de egresados que se insertan al mercado laboral en coincidencia con el programa académico de formación, en 1 año posterior a su egreso.',1,'(Número de alumnos que se insertan al mercado laboral en coincidencia con el programa académico de egreso en un tiempo máximo de un 1 año/total de alumnos de egreso del programa académico del mismo periodo)*100',20,'Número de alumnos que se insertan al mercado laboral en coincidencia con el programa académico de egreso en un tiempo máximo de un 1 año','a5','Total de alumnos de egreso del programa académico del mismo periodo*100','b5'),(6,2,1,'Aprovechamiento de la planta docente ','Aprovechamiento de la Planta Docente','Total de horas frente a grupo por profesores de base por academia  20%',0,'(Total de horas frente a grupo por profesores de base por periodo semestral por academia/  cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia)',20,'Total de horas frente a grupo por profesores de base por periodo semestral por academia','a6','Cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia','b6'),(7,2,1,'Docentes de Asignatura activos en el Sector Productivo','Docentes de Asignatura activos en el Sector Productivo','Porcentaje de docentes de asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen 20%',0,'(Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica/total de docentes contratados por asignatura  por unidad académica)*100',20,'Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica','a7','Total de docentes contratados por asignatura  por unidad académica *100','b7'),(8,2,1,'Profesores en educación continua para la docencia','Profesores formados para la docencia y/o en educación continua para la docencia en los ultimos 5 años','Porcentaje de profesores actualizados  para la docencia con al menos una acción formativa por año en la unidad académica 20%',0,'(Número de profesores formados para la docencia con por lo menos una acción de formación   por año por unidad académica / total de la planta docente)*100',20,'Número de profesores formados para la docencia con por lo menos una acción de formación   por año por unidad académica','a8','Total de la planta docente *100','b8'),(9,2,1,'Docentes actualizados en el Área Disciplinar ','Docentes actualizados en el Área Disciplinar en los ultimos 2 años.','Porcentaje de profesores con por  lo menos una acción de actualización en su área disciplinar   20%',0,'(Número de profesores con por  lo menos una acción de actualización en su área disciplinar  / total de los profesores)*100',20,'Número de profesores con por  lo menos una acción de actualización en su área disciplinar','a9','Total de los profesores *100','b9'),(10,3,2,'Programas Académicos Acreditados','Programas Académicos Acreditados','Porcentaje de programas académicos acreditados por organismos externos 50%',1,'(Número de programas académicos acreditados por organismos externos por unidad académica/Número de programas académicos ofertados por Unidad Académica) *100 ',50,'Número de programas académicos acreditados por organismos externos por unidad académica/','a10','Número de programas académicos ofertados por Unidad Académica *100 ','b10'),(11,4,2,'Programas Académicos Actualizados','Programas Académicos Actualizados o Rediseñados','Porcentaje de   programas de estudio  actualizados por programa académico en los últimos 4 años 50%',1,'(Número de programas de estudio actualizados/Total de progrmas de estudio de los programas académicos de la Unidad Académica) *100 ',50,'Número de programas de estudio actualizados','a11','Total de progrmas de estudio de los programas académicos de la Unidad Académica *100 ','b11'),(12,5,2,'Capacidad de atención alumnos en relación a talleres y laboratorios','Capacidad de atención a alumnos en relación a talleres y laboratorios','Capacidad de atención a alumnos por talleres y laboratorios por unidad académica y semestre 30%',0,'(Capacidad instalada de atención en laboratorios y talleres por el total de semestres, identificando la capacidad del taller o laboratotio con menor capacidad) ',30,'Capacidad instalada de atención en laboratorios y talleres','a12','Por el total de semestres, identificando la capacidad del taller o laboratotio con menor capacidad','b12'),(13,5,2,'Aulas Equipadas','Aulas Equpadas','Aulas equipadas conforme al modelo ideal por unidad académica (Cañon, Internet, Pantalla, Pizarron, Butacas, Escritorio) 35',0,'(Número de aulas equipadas por unidad académica/el total de aulas)*100',35,'Número de aulas equipadas por unidad académica','a13','El total de aulas *100','b13'),(14,5,2,'Laboratorios Equipado','Laboratorios Equipado','Laboratorios equipados conforme currícula por programa académico por unidad académica y año 35%',0,'(Número de laboratorios equipados conforme currícula por programa académico / total de laboratorios por programa académico)*100',35,'Número de laboratorios equipados conforme currícula por programa académico','a14','Total de laboratorios por programa académico *100','b14'),(15,6,3,'Becas  de Manutención','Becas','Porcentaje de alumnos beneficiados con algun tipo  de beca rgistrada den el SIBA, por año y unidad académica.',1,'(Número de alumnos beneficiados con  algun tipo de beca  rgistrada den el SIBA, por año y unidad académica/matrícula total por unidad académica)*100',100,'Número de alumnos beneficiados con  algun tipo de beca  rgistrada den el SIBA, por año y unidad académica','a15','Matrícula total por unidad académica *100','b15'),(16,7,3,'Alumnos Tutorados ','Alumnos Tutorados ','Porcentaje de alumnos tutorados por periodo escolar y  programa académico ',1,'(Número de alumnos tutorados por periodo escolar / matrícula total )*100',100,'Número de alumnos tutorados por periodo escolar','a16','Matrícula total *100','b16'),(17,8,3,'Bibliotecas','Títulos Actualizados','Porcentaje det títulos impresos y/o digitales disponibles con edición en un tiempo no mayor a 5 años a la fecha 50%',0,'(Número de títulos actualizados impresos o digitales por programa académico / Total del acervo bibliográfico por programa académico)*100',50,'Número de títulos actualizados impresos o digitales por programa académico','a17',' Total del acervo bibliográfico por programa académico *100','b17'),(18,8,3,'Mantenimiento y limpieza','Cumplimiento del programa de mantenimiento','Porcentaje de cumpliemito del programa de mantenimiento 50%',0,'(Número de servicios atendidos / Total servicios solicitados o programados por semestre)*100',50,'Número de servicios atendidos','a18','Total servicios solicitados o programados por semestre *100','b18'),(19,8,3,'Mantenimiento y limpieza','Cumplimiento del programa de limpieza','Porcentaje de cumpliemito del programa de limpieza 50%',0,'(Número de servicios atendidos / Total servicios programados por semestre)*100',50,'Número de servicios atendidos','a19','Total servicios programados por semestre *100','b19'),(20,9,4,'Alumnos Inscritos Participando en Servicio Social','Alumnos Participando en Servicio Social','Porcentaje  de alumnos  en alguno de los programas de servicio social por unidad académica ',1,'(Número de alumnos participando en sevicio social  por programa académico por año  / total de alumnos que deben hacer servicio social por programa académico)*100',35,'Número de alumnos participando en sevicio social  por programa académico por año','a20','Total de alumnos que deben hacer servicio social por programa académico *100','b20'),(21,10,4,'Alumnos insritos Realizando Prácticas Profesionales','Alumnos  Realizando Prácticas Profesionales','Porcentaje  de alumnos realizando prácticas profesionales por programa académico por año',1,'(Número de alumnos realizando prácticas profesionales  por programa académico por año  / total de alumnos que deben hacer prácticas profesionales por programa académico)*100',35,'Número de alumnos realizando prácticas profesionales  por programa académico por año','a21','Total de alumnos que deben hacer prácticas profesionales por programa académico *100','b21'),(22,11,4,'Proyectos Vinculados','Proyectos Vinculados','Tasa de variación del número de  proyectos vinculados por unidad académica. ',0,'(Número de proyectos vinculados por unidad académica por año  / Número de proyectos vinculados por unidad académica en el año inmediato anterior)-1)*100',30,'Número de proyectos vinculados por unidad académica por año','a22','Número de proyectos vinculados por unidad académica en el año inmediato anterior)-1)*100','b22'),(23,12,5,'Profesores de carrera que están involucrados en investigaciones','Profesores de carrera realizando investigación','Profesores  con dictamén de carrera (1/2, 3/4 y T.Completo) que participan en Proyectos de Investigación avalados por la SIP ',0,'(Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP/Total de Profesoress de carrera de la Unidad Académica)*100',100,'Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP','a23','Total de Profesoress de carrera de la Unidad Académica *100','b23'),(24,13,5,'Innovaciones Educativas ','Innovaciones Educativas','Tasa de variación del  número de Innovaciones educativas identificadas, incubadas o escaladas por unidad académica ',0,'(Número de innovaciones educativas identificadas,  incubadas o escaladas por unidad académica y por año/ el total de innovaciones educativas identificadas, incubadas o escaladas por unidad académica del año inmediato anterior) -1)*100',100,'Número de innovaciones educativas identificadas,  incubadas o escaladas por unidad académica y por año','a24','El total de innovaciones educativas identificadas, incubadas o escaladas por unidad académica del año inmediato anterior) -1)*100','b24'),(25,14,6,'Inversión de los recursos autogenerados','Porcentaje de recursos autogenerados netos dedicados al  mantenimiento del inmueble y mantenimiento del equipo','Monto de los recursos autogenerados que se destinan al pago de Servicios de mantenimiento del inmueble y mantenimiento del equipo',0,'(Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo / total de los recursos autogenerados anualmente)*100',100,'Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo','a25','Rotal de los recursos autogenerados anualmente *100','b25');
/*!40000 ALTER TABLE `Indicador3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IndicadorMs`
--

DROP TABLE IF EXISTS `IndicadorMs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IndicadorMs` (
  `idIndicadorMs` int(11) NOT NULL AUTO_INCREMENT,
  `idUnidad` int(11) NOT NULL,
  `idBloque` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  `idCampo` varchar(1000) NOT NULL,
  `BAlumnosRegulares` int(11) DEFAULT NULL,
  `BEficienciaTerminal` int(11) DEFAULT NULL,
  `BAlumnosTitulados` int(11) DEFAULT NULL,
  `BPromocionNS` int(11) DEFAULT NULL,
  `BHorasFrenteGrupo` int(11) DEFAULT NULL,
  `BProfesoresActivos` int(11) DEFAULT NULL,
  `BProfesoresActualizados` int(11) DEFAULT NULL,
  `BEvaluacionesIndividuales` int(11) DEFAULT NULL,
  `BProgramasAcademicos` int(11) DEFAULT NULL,
  `BLaboratoriosEquipados` int(11) DEFAULT NULL,
  `BAlumnosTutorados` int(11) DEFAULT NULL,
  `BlibrosTitulosEditados` int(11) DEFAULT NULL,
  `BTotalEjemplares` int(11) DEFAULT NULL,
  `BAlumnosServicioSocial` int(11) DEFAULT NULL,
  `BALumnosVisitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`idIndicadorMs`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IndicadorMs`
--

LOCK TABLES `IndicadorMs` WRITE;
/*!40000 ALTER TABLE `IndicadorMs` DISABLE KEYS */;
INSERT INTO `IndicadorMs` VALUES (1,13,193,1,'b1',10,8,123,3411,21,12,1,5,100,23,12,1,11,12,45),(2,13,194,1,'b2',6,23,24,25,111,31,2,4,6,9,11,3,5,22,5),(3,13,195,1,'b3',7,24,65,345,234343,141,3,3,7,12,14,9,4,9,6),(4,13,196,1,'b4',8,56,345,23232,56,15,4,2,9,11,8,8,3,8,7),(5,13,197,1,'b5',9,11,199,866,121,16,5,1,7,19,9,7,2,7,8),(6,2,129,2,'b1',1,0,0,9,1,45,34,6545,1,12,3,1,9,1,4),(7,2,130,2,'b2',2,0,0,8,2,45,545,544,2,23,2,2,98,2,5),(8,2,131,2,'b3',3,0,0,7,1,45,32,45,3,34,4,3,87,2,6),(9,2,132,2,'b4',4,0,29,6,1,43,322,454,4,43,5,1,76,3,7),(10,2,133,2,'b5',5,31,0,5,1,2,23,45,5,2,6,23,5,4,89),(11,2,134,2,'b6',6,0,0,4,1,2,323,445,6,22,7,4,3,4,33),(12,2,135,2,'b7',7,0,0,3,1,22,32,45,2,22,8,5,2,44,9),(13,18,174,19,'b1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,18,175,19,'b2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,18,176,19,'b3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,18,177,19,'b4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,18,178,19,'b5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,18,179,19,'b6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,30,248,23,'b1',10,88,10,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,12),(20,30,249,23,'b2',11,99,10,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,88,32),(21,30,250,23,'b3',22,11,12,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,789),(22,30,251,23,'b4',22,11,12,23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,87,7),(23,30,252,23,'b5',0,10,11,21,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,98,6),(24,30,253,23,'b6',2,10,11,33,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,8);
/*!40000 ALTER TABLE `IndicadorMs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Infraestructura`
--

DROP TABLE IF EXISTS `Infraestructura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Infraestructura` (
  `idInfraestructura` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosInscritos` int(11) DEFAULT '0',
  `CapacidadInstalada` int(11) DEFAULT '0',
  `AulasEquipadas` int(11) DEFAULT '0',
  `TotalAulas` int(11) DEFAULT '0',
  `LaboratoriosEquipados` int(11) DEFAULT '0',
  `TotalLaboratorios` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  `comprobante3` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idInfraestructura`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Infraestructura`
--

LOCK TABLES `Infraestructura` WRITE;
/*!40000 ALTER TABLE `Infraestructura` DISABLE KEYS */;
INSERT INTO `Infraestructura` VALUES (1,1,0,0,0,0,0,0,NULL,NULL,NULL),(2,2,21,121,34,344,0,122,NULL,NULL,NULL),(3,3,0,0,0,0,0,0,NULL,NULL,NULL),(4,4,0,0,0,0,0,0,NULL,NULL,NULL),(5,5,0,0,0,0,0,0,NULL,NULL,NULL),(6,6,0,0,0,0,0,0,NULL,NULL,NULL),(7,7,0,0,0,0,0,0,NULL,NULL,NULL),(8,8,0,0,0,0,0,0,NULL,NULL,NULL),(9,9,0,0,0,0,0,0,NULL,NULL,NULL),(10,10,0,0,0,0,0,0,NULL,NULL,NULL),(11,11,0,0,0,0,0,0,NULL,NULL,NULL),(12,12,0,0,0,0,0,0,NULL,NULL,NULL),(13,13,0,0,0,0,0,0,NULL,NULL,NULL),(14,14,0,0,0,0,0,0,NULL,NULL,NULL),(15,15,0,0,0,0,0,0,NULL,NULL,NULL),(16,16,0,0,0,0,0,0,NULL,NULL,NULL),(17,17,0,0,0,0,0,0,NULL,NULL,NULL),(18,18,0,0,0,0,0,0,NULL,NULL,NULL),(19,19,0,0,0,0,0,0,NULL,NULL,NULL),(20,23,0,0,0,0,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Infraestructura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `InnovacionEducativa`
--

DROP TABLE IF EXISTS `InnovacionEducativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `InnovacionEducativa` (
  `idInnovacionEducativa` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `InnovacionesIncubadas` int(11) DEFAULT '0',
  `InnovacionesIncubadasAnt` int(11) DEFAULT '0',
  PRIMARY KEY (`idInnovacionEducativa`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InnovacionEducativa`
--

LOCK TABLES `InnovacionEducativa` WRITE;
/*!40000 ALTER TABLE `InnovacionEducativa` DISABLE KEYS */;
INSERT INTO `InnovacionEducativa` VALUES (1,1,0,0),(2,2,0,0),(3,3,0,0),(4,4,0,0),(5,5,0,0),(6,6,0,0),(7,7,0,0),(8,8,0,0),(9,9,0,0),(10,10,0,0),(11,11,0,0),(12,12,0,0),(13,13,0,0),(14,14,0,0),(15,15,0,0),(16,16,0,0),(17,17,0,0),(18,18,0,0),(19,19,0,0),(20,23,0,0);
/*!40000 ALTER TABLE `InnovacionEducativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `InvestigacionDocencia`
--

DROP TABLE IF EXISTS `InvestigacionDocencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `InvestigacionDocencia` (
  `idInvestigacionDocencia` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `DocentesInvestigacion` int(11) DEFAULT '0',
  `TotalDocentes` int(11) DEFAULT '0',
  PRIMARY KEY (`idInvestigacionDocencia`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InvestigacionDocencia`
--

LOCK TABLES `InvestigacionDocencia` WRITE;
/*!40000 ALTER TABLE `InvestigacionDocencia` DISABLE KEYS */;
INSERT INTO `InvestigacionDocencia` VALUES (1,1,0,0),(2,2,23,90),(3,3,0,0),(4,4,0,0),(5,5,0,0),(6,6,0,0),(7,7,0,0),(8,8,0,0),(9,9,0,0),(10,10,0,0),(11,11,0,0),(12,12,0,0),(13,13,0,0),(14,14,0,0),(15,15,0,0),(16,16,0,0),(17,17,0,0),(18,18,0,0),(19,19,0,0),(20,23,1,5);
/*!40000 ALTER TABLE `InvestigacionDocencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Limites`
--

DROP TABLE IF EXISTS `Limites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Limites` (
  `idLimites` int(11) NOT NULL AUTO_INCREMENT,
  `Nivel` int(11) NOT NULL,
  `idIndicador` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Valor` int(11) NOT NULL DEFAULT '0',
  `Inferior` float NOT NULL DEFAULT '0',
  `Superior` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLimites`,`Nivel`,`idIndicador`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Limites`
--

LOCK TABLES `Limites` WRITE;
/*!40000 ALTER TABLE `Limites` DISABLE KEYS */;
INSERT INTO `Limites` VALUES (1,1,1,'Deficiente','Se identifican áreas de atención urgente',1,0,50),(2,1,1,'Regular','Se necesitan mejorar controles',2,50,75),(3,1,1,'Bueno','Se sugiere implementar acciones de mejora',3,75,85),(4,1,1,'Muy bueno','Tomar medidas que permitan consolidar',4,85,95),(5,1,1,'Excelente ','Felicidades - Compartir buenas practicas',5,95,100),(6,3,1,'Malo',NULL,1,0.1,29.99),(7,3,1,'Suficiente',NULL,2,30,39.99),(8,3,1,'Regular',NULL,3,40,49.99),(9,3,1,'Bueno',NULL,4,50,59.99),(10,3,1,'Muy bueno',NULL,5,60,100),(11,3,2,'Malo',NULL,1,0.1,24.99),(12,3,2,'Suficiente',NULL,2,25,34.99),(13,3,2,'Regular',NULL,3,35,44.99),(14,3,2,'Bueno',NULL,4,45,59.99),(15,3,2,'Muy bueno',NULL,5,60,100),(16,3,3,'Malo',NULL,1,0.1,29.99),(17,3,3,'Suficiente',NULL,2,30,39.99),(18,3,3,'Regular',NULL,3,40,49.99),(19,3,3,'Bueno',NULL,4,50,59.99),(20,3,3,'Muy bueno',NULL,5,60,100),(21,3,4,'Malo',NULL,1,0.1,49.99),(22,3,4,'Suficiente',NULL,2,50,59.99),(23,3,4,'Regular',NULL,3,60,69.99),(24,3,4,'Bueno',NULL,4,70,84.99),(25,3,4,'Muy bueno',NULL,5,85,100),(26,3,5,'Malo',NULL,1,0.1,69.99),(27,3,5,'Suficiente',NULL,2,70,74.99),(28,3,5,'Regular',NULL,3,75,79.99),(29,3,5,'Bueno',NULL,4,80,84.99),(30,3,5,'Muy bueno',NULL,5,85,100),(31,3,6,'Malo',NULL,1,0.1,49.99),(32,3,6,'Suficiente',NULL,2,50,59.99),(33,3,6,'Regular',NULL,3,60,69.99),(34,3,6,'Bueno',NULL,4,70,79.99),(35,3,6,'Muy bueno',NULL,5,80,100),(36,3,7,'Malo',NULL,1,0.1,29.99),(37,3,7,'Suficiente',NULL,2,30,39.99),(38,3,7,'Regular',NULL,3,40,49.99),(39,3,7,'Bueno',NULL,4,50,59.99),(40,3,7,'Muy bueno',NULL,5,60,100),(41,3,8,'Malo',NULL,1,0.1,59.99),(42,3,8,'Suficiente',NULL,2,60,79.99),(43,3,8,'Regular',NULL,3,80,84.99),(44,3,8,'Bueno',NULL,4,85,89.99),(45,3,8,'Muy bueno',NULL,5,90,100),(46,3,9,'Malo',NULL,1,0.1,49.99),(47,3,9,'Suficiente',NULL,2,50,59.99),(48,3,9,'Regular',NULL,3,60,79.99),(49,3,9,'Bueno',NULL,4,80,89.99),(50,3,9,'Muy bueno',NULL,5,90,100),(51,3,10,'Malo',NULL,1,0.1,74.99),(52,3,10,'Regular',NULL,3,75,94.99),(53,3,10,'Muy bueno',NULL,5,95,105),(54,3,10,'Malo',NULL,2,105.01,120),(55,3,10,'Muy malo',NULL,1,120.01,200),(56,3,11,'Malo',NULL,1,0.1,49.99),(57,3,11,'Suficiente',NULL,2,50,59.99),(58,3,11,'Regular',NULL,3,60,69.99),(59,3,11,'Bueno',NULL,4,70,84.99),(60,3,11,'Muy bueno',NULL,5,85,200),(61,3,12,'Malo',NULL,1,0.1,79.99),(62,3,12,'Suficiente',NULL,2,80,84.99),(63,3,12,'Regular',NULL,3,85,89.99),(64,3,12,'Bueno',NULL,4,90,94.99),(65,3,12,'Muy bueno',NULL,5,95,200),(66,1,2,'Deficiente','Se identifican áreas de atención urgente',1,0,50),(67,1,2,'Regular','Se necesitan mejorar controles',2,50,75),(68,1,2,'Bueno','Se sugiere implementar acciones de mejora',3,75,85),(69,1,2,'Muy bueno','Tomar medidas que permitan consolidar',4,85,95),(70,1,2,'Excelente ','Felicidades - Compartir buenas practicas',5,95,100),(71,1,3,'Deficiente','Se identifican áreas de atención urgente',1,0,50),(72,1,3,'Regular','Se necesitan mejorar controles',2,50,75),(73,1,3,'Bueno','Se sugiere implementar acciones de mejora',3,75,85),(74,1,3,'Muy bueno','Tomar medidas que permitan consolidar',4,85,95),(75,1,3,'Excelente ','Felicidades - Compartir buenas practicas',5,95,100),(76,3,13,'Malo',NULL,1,0.1,19.99),(77,3,13,'Suficiente',NULL,2,20,29.99),(78,3,13,'Regular',NULL,3,30,39.99),(79,3,13,'Bueno',NULL,4,40,49.99),(80,3,13,'Muy bueno',NULL,5,50,100),(81,3,14,'Malo',NULL,1,0.1,19.99),(82,3,14,'Suficiente',NULL,2,20,29.99),(83,3,14,'Regular',NULL,3,30,39.99),(84,3,14,'Bueno',NULL,4,40,49.99),(85,3,14,'Muy bueno',NULL,5,50,100),(86,3,15,'Malo',NULL,1,0.1,19.99),(87,3,15,'Suficiente',NULL,2,20,29.99),(88,3,15,'Regular',NULL,3,30,39.99),(89,3,15,'Bueno',NULL,4,40,49.99),(90,3,15,'Muy bueno',NULL,5,50,100),(91,3,16,'Malo',NULL,1,0.1,1.99),(92,3,16,'Suficiente',NULL,2,2,3.99),(93,3,16,'Regular',NULL,3,4,7.99),(94,3,16,'Bueno',NULL,4,8,11.99),(95,3,16,'Muy bueno',NULL,5,12,100),(96,3,17,'Malo',NULL,1,0.1,54.99),(97,3,17,'Suficiente',NULL,2,55,64.99),(98,3,17,'Regular',NULL,3,65,74.99),(99,3,17,'Bueno',NULL,4,75,84.99),(100,3,17,'Muy bueno',NULL,5,85,100),(101,3,18,'Malo',NULL,1,0.1,59.99),(102,3,18,'Suficiente',NULL,2,60,69.99),(103,3,18,'Regular',NULL,3,70,79.99),(104,3,18,'Bueno',NULL,4,80,89.99),(105,3,18,'Muy bueno',NULL,5,90,100),(106,3,19,'Malo',NULL,1,0.1,1.99),(107,3,19,'Suficiente',NULL,2,2,3.99),(108,3,19,'Regular',NULL,3,4,7.99),(109,3,19,'Bueno',NULL,4,8,11.99),(110,3,19,'Muy bueno',NULL,5,12,100),(111,3,20,'Malo',NULL,1,-100,-0.1),(112,3,20,'Suficiente',NULL,2,0.1,0.9),(113,3,20,'Regular',NULL,3,1,4.9),(114,3,20,'Bueno',NULL,4,5,14.9),(115,3,20,'Muy bueno',NULL,5,15,100),(116,3,21,'Malo',NULL,1,0.1,9.99),(117,3,21,'Suficiente',NULL,2,10,19.99),(118,3,21,'Regular',NULL,3,20,29.99),(119,3,21,'Bueno',NULL,4,30,39.99),(120,3,21,'Muy bueno',NULL,5,40,100),(121,3,22,'Malo',NULL,1,-100,-0.1),(122,3,22,'Suficiente',NULL,2,0.1,0.9),(123,3,22,'Regular',NULL,3,1,100),(124,3,22,'Bueno',NULL,4,100.1,200),(125,3,22,'Muy bueno',NULL,5,200.1,100),(126,1,4,'Deficiente','Se identifican áreas de atención urgente',1,0,50),(127,1,4,'Regular','Se necesitan mejorar controles',2,50,75),(128,1,4,'Bueno','Se sugiere implementar acciones de mejora',3,75,85),(129,1,4,'Muy bueno','Tomar medidas que permitan consolidar',4,85,95),(130,1,4,'Excelente ','Felicidades - Compartir buenas practicas',5,95,100),(131,1,5,'Deficiente','Se identifican áreas de atención urgente',1,0,50),(132,1,5,'Regular','Se necesitan mejorar controles',2,50,75),(133,1,5,'Bueno','Se sugiere implementar acciones de mejora',3,75,85),(134,1,5,'Muy bueno','Tomar medidas que permitan consolidar',4,85,95),(135,1,5,'Excelente ','Felicidades - Compartir buenas practicas',5,95,100),(136,3,23,'Malo',NULL,1,0.1,4.99),(137,3,23,'Suficiente',NULL,2,5,9.99),(138,3,23,'Regular',NULL,3,10,19.99),(139,3,23,'Bueno',NULL,4,20,29.99),(140,3,23,'Muy bueno',NULL,5,30,100),(141,3,24,'Malo',NULL,1,0.1,59.99),(142,3,24,'Suficiente',NULL,2,60,69.99),(143,3,24,'Regular',NULL,3,70,79.99),(144,3,24,'Bueno',NULL,4,80,89.99),(145,3,24,'Muy bueno',NULL,5,90,100),(146,3,25,'Malo',NULL,1,0.1,19.99),(147,3,25,'Suficiente',NULL,2,20,29.99),(148,3,25,'Regular',NULL,3,30,39.99),(149,3,25,'Bueno',NULL,4,40,49.99),(150,3,25,'Muy bueno',NULL,5,50,100),(151,3,26,'Malo',NULL,1,0.1,0.1),(152,3,26,'Suficiente',NULL,2,20,29.99),(153,3,26,'Regular',NULL,3,30,39.99),(154,3,26,'Bueno',NULL,4,40,49.99),(155,3,26,'Muy bueno',NULL,5,50,100),(156,1,6,'Deficiente','Se identifican áreas de atención urgente',1,0,50),(157,1,6,'Regular','Se necesitan mejorar controles',2,50,75),(158,1,6,'Bueno','Se sugiere implementar acciones de mejora',3,75,85),(159,1,6,'Muy bueno','Tomar medidas que permitan consolidar',4,85,95),(160,1,6,'Excelente ','Felicidades - Compartir buenas practicas',5,95,100),(161,3,27,'Malo',NULL,1,0.1,39.99),(162,3,27,'Suficiente',NULL,2,40,59.99),(163,3,27,'Regular',NULL,3,60,79.99),(164,3,27,'Bueno',NULL,4,80,89.99),(165,3,27,'Muy bueno',NULL,5,90,100);
/*!40000 ALTER TABLE `Limites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PracticasProfesionales`
--

DROP TABLE IF EXISTS `PracticasProfesionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PracticasProfesionales` (
  `idVisitasEscolares` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosPracticas` int(11) DEFAULT '0',
  `TotalAlumnosPracticas` int(11) DEFAULT '0',
  PRIMARY KEY (`idVisitasEscolares`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PracticasProfesionales`
--

LOCK TABLES `PracticasProfesionales` WRITE;
/*!40000 ALTER TABLE `PracticasProfesionales` DISABLE KEYS */;
INSERT INTO `PracticasProfesionales` VALUES (1,1,0,0),(2,2,0,234),(3,3,0,0),(4,4,0,0),(5,5,0,0),(6,6,0,0),(7,7,0,0),(8,8,0,0),(9,9,0,0),(10,10,0,0),(11,11,0,0),(12,12,0,0),(13,13,0,0),(14,14,0,0),(15,15,0,0),(16,16,0,0),(17,17,0,0),(18,18,0,0),(19,19,0,0),(20,23,0,87);
/*!40000 ALTER TABLE `PracticasProfesionales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProgramasAcademicos`
--

DROP TABLE IF EXISTS `ProgramasAcademicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProgramasAcademicos` (
  `idProgramasAcademicos` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `ProgramasEvaluados` int(11) DEFAULT '0',
  `TotalProgramas` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idProgramasAcademicos`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProgramasAcademicos`
--

LOCK TABLES `ProgramasAcademicos` WRITE;
/*!40000 ALTER TABLE `ProgramasAcademicos` DISABLE KEYS */;
INSERT INTO `ProgramasAcademicos` VALUES (1,1,0,0,NULL,NULL),(2,2,0,21,NULL,NULL),(3,3,0,0,NULL,NULL),(4,4,0,0,NULL,NULL),(5,5,0,0,NULL,NULL),(6,6,0,0,NULL,NULL),(7,7,0,0,NULL,NULL),(8,8,0,0,NULL,NULL),(9,9,0,0,NULL,NULL),(10,10,0,0,NULL,NULL),(11,11,0,0,NULL,NULL),(12,12,0,0,NULL,NULL),(13,13,0,0,NULL,NULL),(14,14,0,0,NULL,NULL),(15,15,0,0,NULL,NULL),(16,16,0,0,NULL,NULL),(17,17,0,0,NULL,NULL),(18,18,0,0,NULL,NULL),(19,19,0,0,NULL,NULL),(20,23,0,0,NULL,NULL);
/*!40000 ALTER TABLE `ProgramasAcademicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProgramasAcreditados`
--

DROP TABLE IF EXISTS `ProgramasAcreditados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProgramasAcreditados` (
  `idProgramasAcreditados` int(11) NOT NULL DEFAULT '0',
  `idEvaluacion` int(11) DEFAULT '0',
  `AcademicosAcreditados` int(11) DEFAULT '0',
  `OfertadosPorUnidadAcademica` int(11) DEFAULT '0',
  PRIMARY KEY (`idProgramasAcreditados`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProgramasAcreditados`
--

LOCK TABLES `ProgramasAcreditados` WRITE;
/*!40000 ALTER TABLE `ProgramasAcreditados` DISABLE KEYS */;
/*!40000 ALTER TABLE `ProgramasAcreditados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProyectosVinculados`
--

DROP TABLE IF EXISTS `ProyectosVinculados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProyectosVinculados` (
  `idProyectosVinculados` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `ProyectosVinculadosAct` int(11) DEFAULT '0',
  `ProyectosVinculadosAnt` int(11) DEFAULT '0',
  PRIMARY KEY (`idProyectosVinculados`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProyectosVinculados`
--

LOCK TABLES `ProyectosVinculados` WRITE;
/*!40000 ALTER TABLE `ProyectosVinculados` DISABLE KEYS */;
INSERT INTO `ProyectosVinculados` VALUES (1,1,0,0),(2,2,34,333),(3,3,0,0),(4,4,0,0),(5,5,0,0),(6,6,0,0),(7,7,0,0),(8,8,0,0),(9,9,0,0),(10,10,0,0),(11,11,0,0),(12,12,0,0),(13,13,0,0),(14,14,0,0),(15,15,0,0),(16,16,0,0),(17,17,0,0),(18,18,0,0),(19,19,0,0),(20,23,8,20);
/*!40000 ALTER TABLE `ProyectosVinculados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RecursosAutogenerados`
--

DROP TABLE IF EXISTS `RecursosAutogenerados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RecursosAutogenerados` (
  `idRecursosAutogenerados` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `RecursosEjercidos` int(11) DEFAULT '0',
  `RecursosAutogenerados` int(11) DEFAULT '0',
  PRIMARY KEY (`idRecursosAutogenerados`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RecursosAutogenerados`
--

LOCK TABLES `RecursosAutogenerados` WRITE;
/*!40000 ALTER TABLE `RecursosAutogenerados` DISABLE KEYS */;
INSERT INTO `RecursosAutogenerados` VALUES (1,1,0,0),(2,2,34,89),(3,3,0,0),(4,4,0,0),(5,5,0,0),(6,6,0,0),(7,7,0,0),(8,8,0,0),(9,9,0,0),(10,10,0,0),(11,11,0,0),(12,12,0,0),(13,13,0,0),(14,14,0,0),(15,15,0,0),(16,16,0,0),(17,17,0,0),(18,18,0,0),(19,19,0,0),(20,23,90,9);
/*!40000 ALTER TABLE `RecursosAutogenerados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Roles`
--

DROP TABLE IF EXISTS `Roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Roles` (
  `idRoles` int(11) NOT NULL AUTO_INCREMENT,
  `NombreRol` varchar(200) DEFAULT NULL,
  `Descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`idRoles`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
INSERT INTO `Roles` VALUES (1,'Admin',''),(2,'Escuela','');
/*!40000 ALTER TABLE `Roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ServicioSocial`
--

DROP TABLE IF EXISTS `ServicioSocial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ServicioSocial` (
  `idServicioSocial` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosInscritosServicio` int(11) DEFAULT '0',
  `AlumnosServicioAnterior` int(11) DEFAULT '0',
  PRIMARY KEY (`idServicioSocial`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ServicioSocial`
--

LOCK TABLES `ServicioSocial` WRITE;
/*!40000 ALTER TABLE `ServicioSocial` DISABLE KEYS */;
INSERT INTO `ServicioSocial` VALUES (1,1,0,0),(2,2,0,300),(3,3,0,0),(4,4,0,0),(5,5,0,0),(6,6,0,0),(7,7,0,0),(8,8,0,0),(9,9,0,0),(10,10,0,0),(11,11,0,0),(12,12,0,0),(13,13,0,0),(14,14,0,0),(15,15,0,0),(16,16,0,0),(17,17,0,0),(18,18,0,0),(19,19,0,0),(20,23,0,0);
/*!40000 ALTER TABLE `ServicioSocial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tutorias`
--

DROP TABLE IF EXISTS `Tutorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tutorias` (
  `idTutorias` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosTutorados` int(11) DEFAULT '0',
  `TotalAlumnos` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idTutorias`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tutorias`
--

LOCK TABLES `Tutorias` WRITE;
/*!40000 ALTER TABLE `Tutorias` DISABLE KEYS */;
INSERT INTO `Tutorias` VALUES (1,1,0,0,NULL),(2,2,0,100,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,23,0,0,NULL);
/*!40000 ALTER TABLE `Tutorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Unidad`
--

DROP TABLE IF EXISTS `Unidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Unidad` (
  `idUnidad` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUnidad` varchar(200) DEFAULT NULL,
  `Siglas` varchar(45) NOT NULL,
  `Extension` int(11) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Nivel` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`idUnidad`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Unidad`
--

LOCK TABLES `Unidad` WRITE;
/*!40000 ALTER TABLE `Unidad` DISABLE KEYS */;
INSERT INTO `Unidad` VALUES (1,'CECyT 1 GVV','CECyT 1 GVV',22,NULL,'MED'),(2,'CECyT 2 MB','CECyT 2 MB',23,NULL,'MED'),(3,'CECyT 3 ERR','CECyT 3 ERR',NULL,NULL,'MED'),(4,'CECyT 4 LC','CECyT 4 LC',NULL,NULL,'MED'),(5,'CECyT 5','CECyT 5',NULL,NULL,'MED'),(6,'CECyT 6','CECyT 6',NULL,NULL,'MED'),(7,'CECyT 7','CECyT 7',NULL,NULL,'MED'),(8,'CECyT 8','CECyT 8',NULL,NULL,'MED'),(9,'CECyT 9','CECyT 9',NULL,NULL,'MED'),(10,'CECyT 10','CECyT 10',NULL,NULL,'MED'),(11,'CECyT 11','CECyT 11',NULL,NULL,'MED'),(12,'CECyT 12','CECyT 12',NULL,NULL,'MED'),(13,'CECyT 13','CECyT 413',NULL,NULL,'MED'),(14,'CECyT 14','CECyT 14',NULL,NULL,'MED'),(15,'CECyT 15','CECyT 15',NULL,NULL,'MED'),(16,'CECyT 16','CECyT 16',NULL,NULL,'MED'),(17,'CECyT 17','CECyT 17',NULL,NULL,'MED'),(18,'CET 1','CET 1',NULL,NULL,'MED'),(19,'ESIME ZACATENCO','ESIME ZACATENCO',NULL,NULL,'SUP'),(20,'ESIME CULHUACAN','ESIME CULHUACAN',NULL,NULL,'SUP'),(21,'ESIME AZCAPOTZALCO','ESIME AZCAPOTZALCO',NULL,NULL,'SUP'),(22,'ESIME TICOMAN','ESIME TICOMAN',NULL,NULL,'SUP'),(23,'ESIA ZACATENCO','ESIA ZACATENCO',NULL,NULL,'SUP'),(24,'ESIA TECAMACHALCO','ESIA TECAMACHALCO',NULL,NULL,'SUP'),(25,'ESIA TICOMAN','ESIA TICOMAN',NULL,NULL,'SUP'),(26,'ESIT','ESIT',NULL,NULL,'SUP'),(27,'ESIQIE','ESIQIE',NULL,NULL,'SUP'),(28,'ESFM','ESFM',NULL,NULL,'SUP'),(29,'ESCOM','ESCOM',NULL,NULL,'SUP'),(30,'UPIICSA','UPIICSA',NULL,NULL,'SUP'),(31,'UPIITA','UPIITA',NULL,NULL,'SUP'),(32,'UPIBI','UPIBI',NULL,NULL,'SUP'),(33,'UPIIG','UPIIG',NULL,NULL,'SUP'),(34,'UPIIZ','UPIIZ',NULL,NULL,'SUP'),(35,'UPIIH','UPIIH',NULL,NULL,'SUP'),(36,'ENCB','ENCB',NULL,NULL,'SUP'),(37,'ESM','ESM',NULL,NULL,'SUP'),(38,'ENMH','ENMH',NULL,NULL,'SUP'),(39,'ESEO','ESEO',NULL,NULL,'SUP'),(40,'CICS MILPA ALTA','CICS MILPA ALTA',NULL,NULL,'SUP'),(41,'CICS SANTO TOMAS','CICS SANTO TOMAS',NULL,NULL,'SUP'),(42,'ESCA SANTO TOMAS','ESCA SANTO TOMAS',NULL,NULL,'SUP'),(43,'ESCA TEPEPAN','ESCA TEPEPAN',NULL,NULL,'SUP'),(44,'ESE','ESE',NULL,NULL,'SUP'),(45,'EST','EST',NULL,NULL,'SUP');
/*!40000 ALTER TABLE `Unidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `idRoles` int(11) NOT NULL,
  `idUnidad` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `ApellidoPaterno` varchar(45) NOT NULL,
  `ApellidoMaterno` varchar(45) DEFAULT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefono` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarios`),
  KEY `idUnidad_idx` (`idUnidad`),
  KEY `idRoles_idx` (`idRoles`),
  CONSTRAINT `idRoles` FOREIGN KEY (`idRoles`) REFERENCES `Roles` (`idRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idUnidad` FOREIGN KEY (`idUnidad`) REFERENCES `Unidad` (`idUnidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (21,2,19,'ESIME ZACATENCO','',NULL,'esimezac','8f52d59b5498d54822627d01e0ebd7b1','ipn@ipn.mx',345),(22,2,20,'ESIME CULHUACAN','',NULL,'esimecul','dc5228484f9e78af0bd9236ca839aa25','ipn@ipn.mx',345),(23,2,21,'ESIME AZCAPOTZALCO','',NULL,'esimeazc','8160388c418d3b7c8339d58dba211d96','ipn@ipn.mx',345),(24,2,22,'ESIME TICOMAN','',NULL,'esimetic','3d923bc92c0e5a65eaf4ad6f26b7dcb8','ipn@ipn.mx',345),(25,2,23,'ESIA ZACATENCO','',NULL,'esiazac','ca3f4e3a10576d20a015a2c0aa0b858d','ipn@ipn.mx',345),(26,2,24,'ESIA TECAMACHALCO','',NULL,'esiatec','e7fadfdcf739a98425bac75e71d3a146','ipn@ipn.mx',345),(27,2,25,'ESIA TICOMAN','',NULL,'esiatic','bc5afe19bda352d8d1bf4e0e5c2f0fcf','ipn@ipn.mx',345),(28,2,26,'ESIT','',NULL,'esit','4981cba4a0f563237cef7f84f9d87f4c','ipn@ipn.mx',345),(29,2,27,'ESIQIE','',NULL,'esiqie','9259022f13d285b7c96fee2557ac93c6','ipn@ipn.mx',345),(30,2,28,'ESFM','',NULL,'esfm','feb2adf96e764b99965c00d5bfc73af3','ipn@ipn.mx',345),(31,2,29,'ESCOM','',NULL,'escom','2adb768b56c36e66a71438f31f1e706a','ipn@ipn.mx',345),(32,2,30,'UPIICSA','',NULL,'upiicsa','74f15c9a7ddaefeecdb607a04407d1b5','ipn@ipn.mx',345),(33,2,31,'UPIITA','',NULL,'upiita','9f5699ef9a16d76cfc88612d8269e219','ipn@ipn.mx',345),(34,2,32,'UPIBI','',NULL,'upibi','55a62bdc84760d7e240d0315999d877e','ipn@ipn.mx',345),(35,2,33,'UPIIG','',NULL,'upiig','ea3c128b6f9357aca9b76ebd2c69b06e','ipn@ipn.mx',345),(36,2,34,'UPIIZ','',NULL,'upiiz','f0e963db2e9b1fa7476fc23593d056d4','ipn@ipn.mx',345),(37,2,35,'UPIIH','',NULL,'upiih','5f03d80751d669d9ba34724f10fd331f','ipn@ipn.mx',345),(38,2,36,'ENCB','',NULL,'encb','7ee60bf477d9c58ff7b6da2328943e66','ipn@ipn.mx',345),(39,2,37,'ESM','',NULL,'esm','218a42548aff025d8feea023a7cc7081','ipn@ipn.mx',345),(40,2,38,'ENMH','',NULL,'enmh','c1fd178010eacd60cb8ed7dfcc2ca63d','ipn@ipn.mx',345),(41,2,39,'ESEO','',NULL,'eso','27d73db252390920d52fd3267ab6117a','ipn@ipn.mx',345),(42,2,40,'CICS MILPA ALTA','',NULL,'cicsma','f23b5c23bb2b51c4cb6b1145ccf01294','ipn@ipn.mx',345),(43,2,41,'CICS SANTO TOMAS','',NULL,'cicsst','bb4747adee224b2423f0e53e27fd7015','ipn@ipn.mx',345),(44,2,42,'ESCA SANTO TOMAS','',NULL,'escast','29ba7c4d91918822d51aef173bd3445d','ipn@ipn.mx',345),(45,2,43,'ESCA TEPEPAN','',NULL,'escatp','de5e5e00aa1c116c5b86b0281cf57b36','ipn@ipn.mx',345),(46,2,44,'ESE','',NULL,'ese','910ff191b0a39beebf59ea89ef4f017d','ipn@ipn.mx',345),(47,2,45,'EST','',NULL,'est','690979f83c6a1dbc067fb75695089f80','ipn@ipn.mx',345);
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-18 12:09:04
