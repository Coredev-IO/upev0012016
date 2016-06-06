-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: localhost    Database: upev0012016
-- ------------------------------------------------------
-- Server version 5.6.20

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
  `AlumnosInscritosNSIPN` int(11) NOT NULL DEFAULT '0',
  `AlumnosExamenNSIPN` int(11) NOT NULL DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  `comprobante3` varchar(1000) DEFAULT NULL,
  `comprobante4` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idAlumnos`,`idEvaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Alumnos`
--

LOCK TABLES `Alumnos` WRITE;
/*!40000 ALTER TABLE `Alumnos` DISABLE KEYS */;
INSERT INTO `Alumnos` VALUES (1,1,0,0,0,0,0,0,0,0,'/uploads/desempeno/alumnos/1_1_less.jpg','/uploads/desempeno/alumnos/1_2_less.jpg','/uploads/desempeno/alumnos/1_3_9338635.png','/uploads/desempeno/alumnos/1_4_9338635.png');
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AlumnosInvestigacion`
--

LOCK TABLES `AlumnosInvestigacion` WRITE;
/*!40000 ALTER TABLE `AlumnosInvestigacion` DISABLE KEYS */;
INSERT INTO `AlumnosInvestigacion` VALUES (20,1,0,0,NULL),(21,2,0,0,NULL),(22,3,0,0,NULL),(23,4,0,0,NULL),(24,5,0,0,NULL),(25,6,0,0,NULL),(26,7,0,0,NULL),(27,8,0,0,NULL),(28,9,0,0,NULL),(29,10,0,0,NULL),(30,11,0,0,NULL),(31,12,0,0,NULL),(32,13,0,0,NULL),(33,14,0,0,NULL),(34,15,0,0,NULL),(35,16,0,0,NULL),(36,17,0,0,NULL),(37,18,0,0,NULL),(38,19,0,0,NULL),(39,20,0,0,NULL),(40,21,0,0,NULL),(41,22,0,0,NULL),(42,1,0,0,NULL);
/*!40000 ALTER TABLE `AlumnosInvestigacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AlumnosSup`
--

DROP TABLE IF EXISTS `AlumnosSup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AlumnosSup` (
  `idAlumnos` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosAcreditados` int(11) NOT NULL DEFAULT '0',
  `AlumnosInscritos` int(11) NOT NULL DEFAULT '0',
  `AlumnosEgresadosCohorte` int(11) NOT NULL DEFAULT '0',
  `AlumnosTotalesCohorte` int(11) NOT NULL DEFAULT '0',
  `AlumnosTituladosGeneracion` int(11) NOT NULL DEFAULT '0',
  `AlumnosEgresadosGeneracion` int(11) NOT NULL DEFAULT '0',
  `AlumnosDesfasados` int(11) NOT NULL DEFAULT '0',
  `AlumnosInscritosGeneracion` int(11) NOT NULL DEFAULT '0',
  `AlumnosLaboral` int(11) NOT NULL DEFAULT '0',
  `AlumnosTotalEgresados` int(11) NOT NULL DEFAULT '0',
  `comprobante1` varchar(1000) NOT NULL,
  `comprobante2` varchar(1000) NOT NULL,
  `comprobante3` varchar(1000) NOT NULL,
  `comprobante4` varchar(1000) NOT NULL,
  `comprobante5` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AlumnosSup`
--

LOCK TABLES `AlumnosSup` WRITE;
/*!40000 ALTER TABLE `AlumnosSup` DISABLE KEYS */;
INSERT INTO `AlumnosSup` VALUES (0,1,0,0,0,0,0,0,0,0,0,0,'','','','',''),(0,2,0,0,0,0,0,0,0,0,0,0,'','','','','');
/*!40000 ALTER TABLE `AlumnosSup` ENABLE KEYS */;
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
  `LibrosDisponibles` int(11) DEFAULT '0',
  `TotalLibrosFisicos` int(11) DEFAULT '0',
  `CapacidadInternet` int(11) DEFAULT '0',
  `UsuariosInternet` int(11) DEFAULT '0',
  `MantenimientoAtendido` int(11) DEFAULT '0',
  `MantenimientoSolicitado` int(11) DEFAULT '0',
  `LimpiezaAtendida` int(11) DEFAULT '0',
  `LimpiezaProgramada` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  `comprobante3` varchar(1000) DEFAULT NULL,
  `comprobante4` varchar(1000) DEFAULT NULL,
  `comprobante5` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idApoyoEducativo`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApoyoEducativo`
--

LOCK TABLES `ApoyoEducativo` WRITE;
/*!40000 ALTER TABLE `ApoyoEducativo` DISABLE KEYS */;
INSERT INTO `ApoyoEducativo` VALUES (20,1,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(21,2,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(22,3,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(23,4,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(24,5,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(25,6,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(26,7,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(27,8,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(28,9,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(29,10,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(30,11,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(31,12,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(32,13,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(33,14,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(34,15,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(35,16,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(36,17,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(37,18,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(38,19,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(39,20,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(40,21,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(41,22,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL),(42,1,0,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Becas`
--

LOCK TABLES `Becas` WRITE;
/*!40000 ALTER TABLE `Becas` DISABLE KEYS */;
INSERT INTO `Becas` VALUES (20,1,0,0,NULL),(21,2,0,0,NULL),(22,3,0,0,NULL),(23,4,0,0,NULL),(24,5,0,0,NULL),(25,6,0,0,NULL),(26,7,0,0,NULL),(27,8,0,0,NULL),(28,9,0,0,NULL),(29,10,0,0,NULL),(30,11,0,0,NULL),(31,12,0,0,NULL),(32,13,0,0,NULL),(33,14,0,0,NULL),(34,15,0,0,NULL),(35,16,0,0,NULL),(36,17,0,0,NULL),(37,18,0,0,NULL),(38,19,0,0,NULL),(39,20,0,0,NULL),(40,21,0,0,NULL),(41,22,0,0,NULL),(42,1,0,0,NULL);
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
INSERT INTO `Bloques` VALUES (124,1,' Tronco Común  '),(125,1,' Técnico en Construcción '),(126,1,' Técnico en Procesos Industriales  '),(127,1,' Técnico en Sistemas de Control Eléctrico  '),(128,1,' Técnico en Sistemas Digitales '),(129,2,' Tronco Común  '),(130,2,' Técnico en Aeronáutica  '),(131,2,' Técnico en Dibujo Asistido por Computadora  '),(132,2,' Técnico en Diseño Grafico Digital '),(133,2,' Técnico en Máquinas con Sistemas Automatizados  '),(134,2,' Técnico en Metalurgia '),(135,2,' Técnico en Sistemas Automotrices  '),(136,3,' Tronco Común  '),(137,3,' Técnico en Aeronáutica  '),(138,3,' Técnico en Computación  '),(139,3,' Técnico en Manufactura Asistida por Computadora '),(140,3,' Técnico en Sistemas Automotrices  '),(141,3,' Técnico en Sistemas de Control Eléctrico  '),(142,3,' Técnico en Sistemas Digitales '),(143,4,' Tronco Común  '),(144,4,' Técnico en Aeronáutica  '),(145,4,' Técnico en Construcción '),(146,4,' Técnico en Instalaciones y Mantenimiento Eléctricos '),(147,4,' Técnico en Procesos Industriales  '),(148,4,' Técnico en Sistemas Automotrices  '),(149,7,' Tronco Común  '),(150,7,' Técnico en Aeronáutica  '),(151,7,' Técnico en Construcción '),(152,7,' Técnico en Instalaciones y Mantenimiento Eléctricos '),(153,7,' Técnico en Mantenimiento Industrial '),(154,7,' Técnico en Sistemas Automotrices  '),(155,7,' Técnico en Soldadura Industrial '),(156,8,' Tronco Común  '),(157,8,' Técnico en Computación  '),(158,8,' Técnico en Mantenimiento Industrial '),(159,8,' Técnico en Plásticos  '),(160,8,' Técnico en Sistemas Automotrices  '),(161,9,' Tronco Común  '),(162,9,' Técnico en Máquinas con Sistemas Automatizados  '),(163,9,' Técnico en Programación '),(164,9,' Técnico en Sistemas Digitales '),(165,10,'  Tronco Común  '),(166,10,'  Técnico en Diagnóstico y Mejoramiento Ambiental '),(167,10,'  Técnico en Metrología y Control de Calidad  '),(168,10,'  Técnico en Telecomunicaciones '),(169,11,'  Tronco Común  '),(170,11,'  Técnico en Construcción '),(171,11,'  Técnico en Instalaciones y Mantenimiento Eléctricos '),(172,11,'  Técnico en Procesos Industriales  '),(173,11,'  Técnico en Telecomunicaciones '),(174,18,'  Tronco Común  '),(175,18,'  Técnico en Automatización y Control Eléctrico Industrial  '),(176,18,'  Técnico en Redes de Cómputo '),(177,18,'  Técnico en Sistemas Automotrices  '),(178,18,'  Técnico en Sistemas Constructivos Asistidos por Computadora '),(179,18,'  Técnico en Sistemas Mecánicos Industriales  '),(180,6,' Tronco Común  '),(181,6,' Técnico en Laboratorista Clínico  '),(182,6,' Técnico en Ecología '),(183,6,' Técnico en Enfermería '),(184,6,' Técnico  Laboratorista Químico  '),(185,15,'  Tronco Común  '),(186,15,'  Técnico en Alimentos  '),(187,15,'  Técnico  Laboratorista Clínico  '),(188,15,'  Técnico en Nutrición Humana   '),(189,12,'  Tronco Común  '),(190,12,'  Técnico en Administración '),(191,12,'  Técnico en Contaduría '),(192,12,'  Técnico en Informática  '),(193,13,'  Tronco Común  '),(194,13,'  Técnico en Administración '),(195,13,'  Técnico en Contaduría '),(196,13,'  Técnico en Informática  '),(197,13,'  Técnico en Administraciòn de Empresas Turìsticas  '),(198,5,' Tronco Común  '),(199,5,' Técnico en Comercio Internacional '),(200,5,' Técnico en Contaduría '),(201,5,' Técnico en Informática  '),(202,14,'  Tronco Común  '),(203,14,'  Técnico en Contaduría '),(204,14,'  Técnico en Informática  '),(205,14,'  Técnico en Mercadotecnia  '),(206,16,'  Tronco Común  '),(207,16,'  Técnico en Mantenimiento Industrial '),(208,16,'  Técnico en Procesos Industriales  '),(209,16,'  Técnico en Máquinas con Sistemas Automatizados  '),(210,16,'  Técnico en Enfermería '),(211,16,'  Técnico en Laboratorista Clínico  '),(212,16,'  Técnico en Comercio Internacional '),(213,16,'  Técnico en Administración '),(214,17,'  Tronco Común  '),(215,17,'  Técnico en Aeronáutica  '),(216,17,'  Técnico en Sistemas Automotrices  '),(217,17,'  Técnico en Metrología y Control de Calidad  '),(218,17,'  Técnico en Alimentos  '),(219,17,'  Técnico en Administracion de  Empresas Turisticas '),(220,17,'  Técnico en Comercio Internacional '),(221,19,'Ingeniería en Comunicaciones y Electrónica'),(222,19,'Ingeniería en Control y Automatización'),(223,19,'Ingeniería Eléctrica'),(224,19,'Ingeniería en Sistemas Automotrices'),(225,20,'Ingeniería en Computación'),(226,20,'Ingeniería en Comunicaciones y Electrónica'),(227,20,'Ingeniería Mecánica'),(228,20,'Ingeniería en Sistemas Automotrices'),(229,21,'Ingeniería Mecánica'),(230,21,'Ingeniería en Robótica Industrial'),(231,21,'Ingeniería en Sistemas Automotrices'),(232,22,'Ingeniería en Aeronáutica'),(233,22,'Ingeniería en Sistemas Automotrices'),(234,23,'Ingeniería Civil'),(235,24,'Ingeniero Arquitecto'),(236,25,'Ingeniería Petrolera'),(237,25,'Ingeniería Geológica'),(238,25,'Ingeniería Geofísica'),(239,25,'Ingeniería Topográfica y Fotogramétrica'),(240,26,'Ingeniería Textil'),(241,27,'Ingeniería Química Industrial'),(242,27,'Ingeniería Química Petrolera '),(243,27,'Ingeniería Metalurgia Y Materiales'),(244,28,'Ingeniería Matemática'),(245,28,'Licenciatura en Física y Matemáticas'),(246,29,'Ingeniería en Sistemas Computacionales'),(247,29,'Ingeniería en Sistemas Automotrices'),(248,30,'Licenciatura en Administración Industrial'),(249,30,'Ingeniería Industrial'),(250,30,'Ingeniería en Informática'),(251,30,'Licenciatura en Ciencias de la Informática'),(252,30,'Ingeniería en Transporte'),(253,30,'Ingeniería en Sistemas Automotrices'),(254,31,'Ingeniería Telemática'),(255,31,'Ingeniería Mecatrónica'),(256,31,'Ingeniería Biónica'),(257,31,'Ingeniería en Sistemas Automotrices'),(258,32,'Ingeniería en Alimentos'),(259,32,'Ingeniería Ambiental'),(260,32,'Ingeniería Biomédica'),(261,32,'Ingeniería Biotecnológica'),(262,32,'Ingeniería Farmacéutica'),(263,33,'Ingeniería Biotecnológica'),(264,33,'Ingeniería en Aeronáutica'),(265,33,'Ingeniería en Sistemas Automotrices'),(266,33,'Ingeniería Farmacéutica'),(267,33,'Ingeniería Industrial'),(268,34,'Ingeniería Mecatrónica'),(269,34,'Ingeniería en Alimentos'),(270,34,'Ingeniería en Sistemas Computacionales'),(271,34,'Ingeniería Ambiental'),(272,34,'Ingeniería Metalurgia '),(273,35,'Ingeniería Mecatrónica'),(274,35,'Ingeniería en Sistemas Automotrices'),(275,36,'Licenciatura en Biología'),(276,36,'Ingeniería Bioquímica'),(277,36,'Ingeniería en Sistemas Ambientales'),(278,36,'Químico Bacteriólogo Parasitólogo'),(279,36,'Químico Farmacéutico Industrial'),(280,37,'Médico Cirujano y Partero'),(281,38,'Médico Cirujano y Partero'),(282,38,'Médico Cirujano y Homeópata'),(283,39,'Licenciatura en Enfermería'),(284,39,'Licenciatura en Enfermería y Obstetricia'),(285,40,'Licenciatura en Enfermería'),(286,40,'Médico Cirujano y Partero'),(287,40,'Licenciatura en Nutrición'),(288,40,'Licenciatura en Odontología'),(289,40,'Licenciatura en Optometría'),(290,40,'Licenciatura en Trabajo Social'),(291,41,'Licenciatura en Odontología'),(292,41,'Licenciatura en Optometría'),(293,41,'Licenciatura en Psicología'),(294,42,'Contaduría Pública'),(295,42,'Licenciatura en Negocios Internacionales'),(296,42,'Licenciatura en Relaciones Comerciales'),(297,42,'Licenciatura en Administración y Desarrollo Empresarial ??'),(298,43,'Contaduría Pública'),(299,43,'Licenciatura en Negocios Internacionales'),(300,43,'Licenciatura en Relaciones Comerciales'),(301,45,'Licenciatura en Economía'),(302,46,'Licenciatura en Turismo');
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
  `TotalDocentesContratadosAsignatura` int(11) DEFAULT '0' COMMENT '  ',
  `ProfesoresActualizacion` int(11) DEFAULT '0',
  `TotalProfesores` int(11) DEFAULT '0',
  `EvaluacionIndividual` int(11) DEFAULT '0',
  `DocentesPertenecientes` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  `comprobante3` varchar(1000) DEFAULT NULL,
  `comprobante4` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idDocentes`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Docentes`
--

LOCK TABLES `Docentes` WRITE;
/*!40000 ALTER TABLE `Docentes` DISABLE KEYS */;
INSERT INTO `Docentes` VALUES (1,1,0,0,0,0,0,0,0,0,'/uploads/desempeno/docentes/1_1_9338635.png','/uploads/desempeno/docentes/1_2_less.jpg','/uploads/desempeno/docentes/1_3_less.jpg','/uploads/desempeno/docentes/1_4_less.jpg');
/*!40000 ALTER TABLE `Docentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DocentesSup`
--

DROP TABLE IF EXISTS `DocentesSup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DocentesSup` (
  `idDocentes` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  `TotalHorasBase` int(11) DEFAULT '0',
  `TotalHorasReglamento` int(11) DEFAULT '0',
  `DocentesActivosProductivo` int(11) DEFAULT '0',
  `TotalDocentesContratadosAsignatura` int(11) DEFAULT '0' COMMENT '  ',
  `ProfesoresParaDocencias` int(11) DEFAULT '0',
  `TotalProfesores` int(11) DEFAULT '0',
  `ProfesoresActualizados` int(11) DEFAULT '0',
  `TotalPrefesores` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) NOT NULL,
  `comprobante2` varchar(1000) NOT NULL,
  `comprobante3` varchar(1000) NOT NULL,
  `comprobante4` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DocentesSup`
--

LOCK TABLES `DocentesSup` WRITE;
/*!40000 ALTER TABLE `DocentesSup` DISABLE KEYS */;
INSERT INTO `DocentesSup` VALUES (0,1,0,0,0,0,0,0,0,0,'','','',''),(0,2,0,0,0,0,0,0,0,0,'','','','');
/*!40000 ALTER TABLE `DocentesSup` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evaluacion`
--

LOCK TABLES `Evaluacion` WRITE;
/*!40000 ALTER TABLE `Evaluacion` DISABLE KEYS */;
INSERT INTO `Evaluacion` VALUES (1,1,'',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-06-05 06:57:54');
/*!40000 ALTER TABLE `Evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EvaluacionSup`
--

DROP TABLE IF EXISTS `EvaluacionSup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EvaluacionSup` (
  `idEvaluacionSup` int(11) NOT NULL AUTO_INCREMENT,
  `idUnidad` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Al_rendimiento` float DEFAULT '0',
  `Al_eficiencia` float DEFAULT '0',
  `Al_titulacion` float DEFAULT '0',
  `Al_abandono` float DEFAULT '0',
  `Al_laboral` float DEFAULT '0',
  `Al_cal_rendimiento` int(11) DEFAULT '0' COMMENT '\n',
  `Al_cal_eficiencia` int(11) DEFAULT '0',
  `Al_cal_titulacion` int(11) DEFAULT '0',
  `Al_cal_abandono` float DEFAULT '0',
  `Al_cal_laboral` float DEFAULT '0',
  `Al_Total` float DEFAULT '0',
  `Do_aprovechamiento` float DEFAULT '0',
  `Do_activos` float DEFAULT '0',
  `Do_formados` float DEFAULT '0',
  `Do_actualizados` float DEFAULT '0',
  `Do_cal_aprovechamiento` int(11) DEFAULT '0',
  `Do_cal_activos` int(11) DEFAULT '0',
  `Do_cal_formados` int(11) DEFAULT '0',
  `Do_cal_actualizados` int(11) DEFAULT '0',
  `Do_Total` float DEFAULT '0',
  `CreateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idEvaluacionSup`),
  KEY `idUnidadFK_idx` (`idUnidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EvaluacionSup`
--

LOCK TABLES `EvaluacionSup` WRITE;
/*!40000 ALTER TABLE `EvaluacionSup` DISABLE KEYS */;
INSERT INTO `EvaluacionSup` VALUES (1,26,'',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-06-05 22:10:53'),(2,30,'',NULL,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'2016-06-05 23:19:40');
/*!40000 ALTER TABLE `EvaluacionSup` ENABLE KEYS */;
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
-- Table structure for table `Indicador1Sup`
--

DROP TABLE IF EXISTS `Indicador1Sup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Indicador1Sup` (
  `idIndicador1Sup` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(1000) DEFAULT NULL,
  `Descripcion` varchar(1000) DEFAULT NULL,
  `Valor` float DEFAULT NULL,
  PRIMARY KEY (`idIndicador1Sup`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Indicador1Sup`
--

LOCK TABLES `Indicador1Sup` WRITE;
/*!40000 ALTER TABLE `Indicador1Sup` DISABLE KEYS */;
INSERT INTO `Indicador1Sup` VALUES (1,'Desempeño',NULL,25),(2,'Oferta educativa',NULL,25),(3,'Apoyo',NULL,15),(4,'Vinculación',NULL,15),(5,'Investigación',NULL,10),(6,'Gestión administrativa',NULL,10);
/*!40000 ALTER TABLE `Indicador1Sup` ENABLE KEYS */;
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
INSERT INTO `Indicador2` VALUES (1,1,'Alumnos',NULL,50),(2,1,'Pefil Docente',NULL,50),(3,2,'Programas académicos',NULL,50),(4,2,'Infraestructura',NULL,50),(5,3,'Becas',NULL,33),(6,3,'Tutorías',NULL,33),(7,3,'Servicio de apoyo educativo',NULL,34),(8,4,'Servicio social',NULL,30),(9,4,'Visitas escolares',NULL,35),(10,4,'Proyectos vinculados',NULL,35),(11,5,'Apoyo de la investigación a la docencia',NULL,40),(12,5,'Participación de los alumnos en investigaciones',NULL,30),(13,5,'Innovación e investigación educativa',NULL,30),(14,6,'Recursos autogenerados',NULL,100);
/*!40000 ALTER TABLE `Indicador2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Indicador2Sup`
--

DROP TABLE IF EXISTS `Indicador2Sup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Indicador2Sup` (
  `Indicador2Sup` int(11) NOT NULL AUTO_INCREMENT,
  `idIndicador1Sup` int(11) NOT NULL,
  `Nombre` varchar(1000) DEFAULT NULL,
  `Descripcion` varchar(1000) DEFAULT NULL,
  `Valor` float DEFAULT NULL,
  PRIMARY KEY (`Indicador2Sup`,`idIndicador1Sup`),
  KEY `idIndicador1Sup_idx` (`idIndicador1Sup`),
  CONSTRAINT `idIndicador1Sup` FOREIGN KEY (`idIndicador1Sup`) REFERENCES `Indicador1Sup` (`idIndicador1Sup`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Indicador2Sup`
--

LOCK TABLES `Indicador2Sup` WRITE;
/*!40000 ALTER TABLE `Indicador2Sup` DISABLE KEYS */;
INSERT INTO `Indicador2Sup` VALUES (1,1,'Alumno',NULL,50),(2,1,'Perfil Docente',NULL,50),(3,2,'Programas Acreditados',NULL,25),(4,2,'Programas Académicos',NULL,25),(5,2,'Infraestructura',NULL,50),(6,3,'Becas',NULL,33),(7,3,'Tutorias',NULL,33),(8,3,'Servicios de apoyo educativo',NULL,34),(9,4,'Servicio Social',NULL,35),(10,4,'Practicas Profesionales',NULL,35),(11,4,'Proyectos Vinculados',NULL,30),(12,5,'Apoyo de la investigación a la docencia',NULL,50),(13,5,'Innovación e investigación educativa',NULL,50),(14,6,'Recursos Autogenerados',NULL,100);
/*!40000 ALTER TABLE `Indicador2Sup` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Indicador3`
--

LOCK TABLES `Indicador3` WRITE;
/*!40000 ALTER TABLE `Indicador3` DISABLE KEYS */;
INSERT INTO `Indicador3` VALUES (1,1,1,'Rendimiento','Alumnos en situación escolar regular','Porcentaje de alumnos que han aprobado todas las unidades de aprendizaje en las que han estado inscritos por Unidad  académica',1,'(Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos  / Total de matrícula inscrita)*100',35,'Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos en la unidad adadémica','a1','Total de matrícula inscrita','b1'),(2,1,1,'Eficiencia terminal','Eficiencia  terminal','Porcentaje de alumnos que egresan por cohorte generacional por programa académico ',1,'( ? 1 n   Número de alumnos del cohorte A que egresan  en el año n / total de alumnos en el cohorte A)',25,'Número de alumnos del cohorte A que egresan  en el año \"n\" ','a2','Total de alumnos en el cohorte A','b2'),(3,1,1,'Titulación','Alumnos titulados ','Porcentaje de alumnos titulados hasta tres años después de egresar por programa académico',1,'(Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico /total de la matrícula de egreso del mismo periodo por programa académico)*100',5,'Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico ','a3','Total de la matrícula de egreso del mismo periodo por programa académico','b3'),(4,1,1,'Promoción de NMS a NS','Promoción  de alumnos por nivel educativo','Porcentaje de alumnos de NMS del IPN que concluyeron el último semestre y presentaron examen de admision  y ocuparon un lugar en NS del IPN',1,'(Número de alumnos de NMS del IPN que concluyeron el último semestre y presentaron examen de admision  y ocuparon un lugar en NS del IPN por programa académico / Total de alumnos del NMS del IPN que presentaron examen de ingreso al NS del IPN)*100',35,'Número de alumnos de NMS del IPN que concluyeron el último semestre y presentaron examen de admisión  y ocuparon un lugar en NS del IPN por programa académico','a4','Total de alumnos del NMS del IPN que presentaron examen de ingreso al NS del IPN','b4'),(5,2,1,'Aprovechamiento de la Planta Docente','Aprovechamiento de la Planta Docente','Total de horas frente a grupo por profesores de base por academia  25%',1,'( total de horas frente a grupo por profesores de base por periodo semestral por academia/  cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia)',20,'Total de horas frente a grupo por profesores de base por periodo semestral por academia','a5','Cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia','b5'),(6,2,1,'Docentes de asignatura activos en el sector productivo','Docentes de Asignatura activos en el Sector Productivo','Porcentaje de docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen 25%',1,'(Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica/total de docentes contratados por asignatura  por unidad académica)*100',15,'Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica','a6','Total de docentes contratados por asignatura  por unidad académica','b6'),(7,2,1,'Docentes actualizados en el Área Disciplinar','Docentes actualizados en el Área Disciplinar','Porcentaje de profesores con por  lo menos una acción de actualización en su área disciplinar en los últimos dos años   25%',1,'(Número de profesores con por  lo menos una acción de actualización en su área disciplinar  / total de los profesores)*100',25,'Número de profesores con por  lo menos una acción de actualización en su área disciplinar','a7','Total de los profesores','b7'),(8,2,1,'Desempeño docente','Desempeño Docente','Promedio de las evaluaciones individuales del cuestionario de apreciación estudiantil \r25%',1,'(la suma de la evaluación individual del cuestionario de apreciación estudiantil por docente por periodo semestral  por unidad académica/ entre el total del número docentes perteneciente, por periodo semestral por unidad académica)*100',40,'La suma de la evaluación individual del cuestionario de apreciación estudiantil por docente por periodo semestral  por unidad académica','a8','Total del número docentes perteneciente, por periodo semestral por unidad académica','b8'),(9,3,2,'Programas académicos evaluados','Programas Académicos Evaluados','Porcentaje de   programas académicos con evaluación favorable en los últimos 4 años ',1,'(Número de programas académicos evaluados/Total de programas académicos de la Unidad Académica) *100 ',100,'Número de programas académicos evaluados','a9','Total de programas académicos de la Unidad Académica','b9'),(10,4,2,'Capacidad de atención alumnos en relación a talleres y laboratorios','Capacidad de atención alumnos en relación a talleres y laboratorios','Capacidad de atención a alumnos por talleres y laboratorios por unidad académica y semestre\rSuma de Capacidad instalada de atención en laboratorios y talleres por el total de semestres, identificando la capacidad del taller o laboratotio con menor capacidad de cada semestre\r ',0,'(Total de alumnos inscritos por Unidad Académica/(Capacidad instalada))*100 ',35,'Total de alumnos inscritos por Unidad Académica','a10','Capacidad instalada','b10'),(11,4,2,'Aulas Equipadas','Aulas Equipadas','Aulas equipadas conforme al modelo ideal por unidad académica \r(Cañon, Internet, CPU, Pantalla, Pizarron, Butacas, Escritorio)\r',0,'(Número de aulas equipadas por unidad académica/el total de aulas)*100',35,'Número de aulas equipadas por unidad académica','a11','Total de aulas','b11'),(12,4,2,'Laboratorios Equipado','Laboratorios Equipado','Laboratorios equipados conforme currícula por programa académico por unidad académica y año',1,'(Número de laboratorios equipados conforme currícula por programa académico / total de laboratorios por programa académico)*100',30,'Número de laboratorios equipados conforme currícula por programa académico','a12','Total de laboratorios por programa académico','b12'),(13,5,3,'Becas ','Becas','Porcentaje de alumnos que cuentan con algun tipo de beca registrada en el SIBA por año por unidad académca ',0,'(Número de alumnos que cuentan con beca registrada en el SIBA por año por unidad académica/matrícula total por unidad académica)*100',100,'Número de alumnos que cuentan con beca registrada en el SIBA por año por unidad académica','a13','Matrícula total por unidad académica','b13'),(14,6,3,'Alumnos Tutorados','Alumnos Tutorados','Porcentaje de alumnos tutorados por periodo semestral y  programa académico ',1,'(Número de alumnos tutorados por periodo semestral / matrícula total)*100',100,'Número de alumnos tutorados por periodo semestre','a14','Matrícula total','b14'),(15,7,3,'Bibliotecas','Títulos Actualizados','Porcentaje de alumnos tutorados por periodo semestral y  programa académico ',1,'(Número de títulos actualizados impresos o digitales por semestre / Total del acervo bibliográfico por semestre)*100',17.5,'Número de títulos actualizados impresos o digitales por semestre','a15','Total del acervo bibliográfico por semestre','b15'),(16,7,3,'Bibliotecas ','Número de libros por alumno','Total de ejemplares por programa académico 50%',1,'(Número de ejemplares disponibles en sala por semestre/ total de matricula por semestre)',17.5,'Número de ejemplares disponibles en sala por semestre','a16','Total de matricula por semestre','b16'),(17,7,3,'Equipo de cómputo','Cobertura de Acceso a Internet ','Capacidad instalada de acceso a internet en la unidad académica',0,'(Capacidad instalada de acceso a internet / número de usuarios del turno con mayor número de personas de la unidad académica)*100',30,'Capacidad instalada de acceso a internet ','a17','Número de usuarios del turno con mayor número de personas de la unidad académica','b17'),(18,7,3,'Mantenimiento y limpieza','Cumplimiento del programa de mantenimiento','Porcentaje de cumpliemito del programa de mantenimiento 50%',0,'(Número de servicios atendidos / Total servicios solicitados o programados por semestre)*100',17.5,'Número de servicios atendidos','a18','Total servicios solicitados o programados por semestre','b18'),(19,7,3,'Mantenimiento y limpieza','Cumplimiento del programa de limpieza','Porcentaje de cumpliemito del programa de limpieza 50%',0,'(Número de servicios atendidos / Total servicios programados por semestre)*100',17.5,'Número de servicios atendidos ','a19','Total servicios programados por semestre','b19'),(20,8,4,'Alumnos Inscritos Participando en Servicio Social','Alumnos Inscritos Participando en Servicio Social','Número de alumnos inscritos en alguno de los programas de servicio social por unidad académica ',1,'(Número de alumnos inscritos realizando servicio social por unidad académica por año  / Número de alumnos inscritos realizando servicio social por unidad académica en el año inmediato anterior) -1)*100',100,'Número de alumnos inscritos realizando servicio social por unidad académica por año','a20','Número de alumnos inscritos realizando servicio social por unidad académica en el año inmediato anterior','b20'),(21,9,4,'Alumnos en Visitas Escolares','Porcentaje de Alumnos en Visitas Escolares','Número de alumnos  realizando visitas escolares por unidad académica por semestre',1,'(Número de alumnos realizando visitas escolares por unidad académica por semestre  / .total de la matrícula)*100',100,'Número de alumnos realizando visitas escolares por unidad académica por semestre','a21','Total de la matrícula','b21'),(22,10,4,'Proyectos Vinculados','Proyectos Vinculados','Número de proyectos vinculados por unidad académica',0,'(Número de proyectos vinculados por unidad académica por año  / Número de proyectos vinculados por unidad académica en el año inmediato anterior)-1)*100',100,'Número de proyectos vinculados por unidad académica por año','a22','Número de proyectos vinculados por unidad académica en el año inmediato anterior','b22'),(23,11,5,'Profesores de carrera que están involucrados en investigaciones','Profesores de carrera realizando investigación','Profesores contratados con dictamén de carrera (1/2, 3/4 y T.Completo) que participan en Proyectos de Investigación avalados por la SIP ',0,'(Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP/Total de Profesoress de carrera de la Unidad Académica)*100',100,'Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP','a23','Total de Profesores de carrera de la Unidad Académica','b23'),(24,12,5,'Profesores que presentan trabajos en eventos de investigación con la participación de alumnos','Profesores que presentan trabajos en eventos de investigación con la participación de alumnos','Profesores que presentan trabajos en congresos, coloquios, siposiums, entre otros con la participación de alumnos como coautores',0,'(Número de profesores que presentan trabajos en congresos, coloquios, siposiums, entre otros con la participación de alumnos como coautores / total de profesores que tienen proyectos registrados en la SIP)*100',100,'Número de profesores que presentan trabajos en congresos, coloquios, siposiums, entre otros con la participación de alumnos como coautores','a24','Total de profesores que tienen proyectos registrados en la SIP','b24'),(25,13,5,'Innovaciones Educativas','Innovaciones Educativas','Tasa de variación del  número de Innovaciones educativas identificadas, incubadas o escaladas por unidad académica 50%',0,'(Número de innovaciones educativas identificadas,  incubadas o escaladas por unidad académica y por año/ el total de innovaciones educativas identificadas, incubadas o escaladas por unidad académica del año inmediato anterior) -1)*100',50,'Número de innovaciones educativas identificadas,  incubadas o escaladas por unidad académica y por año','a25',' Total de innovaciones educativas identificadas, incubadas o escaladas por unidad académica del año inmediato anterior','b25'),(26,13,5,'Investigaciones Educativas de impacto en el aula','Investigaciones Educativas de impacto en el aula','Tasa de variación del número de investigaciones educativas publicadas con impacto en el aula por unidad académica y por año',0,'(Número de investigaciones educativas publicadas con impacto en el aula por unidad académica y por año/ Número de investigaciones educativas publicadas con impacto en el aula por unidad académica del año inmediato anterior) -1)*100',50,'Número de investigaciones educativas publicadas con impacto en el aula por unidad académica y por año','a26',' Número de investigaciones educativas publicadas con impacto en el aula por unidad académica del año inmediato anterior','b26'),(27,14,6,'% de  Recursos autogenerados dedicados al  mantenimiento del inmueble y mantenimiento del equipo','Porcentaje de  Recursos autogenerados dedicados al  mantenimiento del inmueble y mantenimiento del equipo','Monto de los recursos netos autogenerados que se destinan al pago de Servicios de mantenimiento del inmueble y mantenimiento del equipo ',0,'(Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo / total de los recursos autogenerados anualmente)*100\r(Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo / total de los recursos autogenerados anualmente)*100',100,'Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo','a27','Total de los recursos autogenerados anualmente','b27');
/*!40000 ALTER TABLE `Indicador3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Indicador3Sup`
--

DROP TABLE IF EXISTS `Indicador3Sup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Indicador3Sup` (
  `idIndicador3Sup` int(11) NOT NULL AUTO_INCREMENT,
  `idIndicador2Sup` int(11) NOT NULL,
  `idIndicador1Sup` int(11) NOT NULL,
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
  PRIMARY KEY (`idIndicador3Sup`,`idIndicador2Sup`,`idIndicador1Sup`),
  KEY `fk_Indicador3Sup_Indicador21Sup_idx` (`idIndicador2Sup`,`idIndicador1Sup`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Indicador3Sup`
--

LOCK TABLES `Indicador3Sup` WRITE;
/*!40000 ALTER TABLE `Indicador3Sup` DISABLE KEYS */;
INSERT INTO `Indicador3Sup` VALUES (1,1,1,'Rendimiento','Alumno en situación escolar regular ','Porcentaje de alumnos que han aprobado todas las unidades de aprendizaje en las que han estado inscritos por Unidad  académica  ',1,'(Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos  / Total de matrícula inscrita)*100',20,'Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos por programa académico ','a1','Total de matrícula inscrita por programa académico*100','b1'),(2,1,1,'Eficiencia Terminal','Eficiencia Terminal','Porcentaje de alumnos que egresan por cohorte generacional por programa académico',1,'(Sumatoria-Número de alumnos del cohorte A que egresan  en el año n / total de alumnos en el cohorte A)',20,'Sumatoria-Número de alumnos del cohorte A que egresan  en el año n por programa académico','a2','Total de alumnos admitidos al programa académico en el cohorte A','b2'),(3,1,1,'Titulación','Alumnos titulados ','Porcentaje de alumnos titulados hasta tres años después de egresar por programa académico',1,'(Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico /total de la matrícula de egreso del mismo periodo por programa académico)*100',20,'Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico','a3','Total de la matrícula de egreso del mismo periodo por programa académico*100','b3'),(4,1,1,'Fuera de Reglamento','Alumno en riesgo de abandono por situación académica.','Porcentaje de alumnos con unidades de aprendizaje con adeudo, defasadas por 2 o más periodos escolares. ',1,'(Número de alumnos con unidades de aprendizaje con adeudo, desfasadas por 2 0 más periodos escolares / Total de matrícula inscrita por programa académico) *100',20,'Número de alumnos con unidades de aprendizaje defasadas por 2 o más periodos escolares','a4','Total de matrícula inscrita por programa académico por semestre*100','b4'),(5,1,1,'Inserción Laboral','Recien egresados en inserción laboral','Porcentaje de egresados que se insertan al mercado laboral en coincidencia con el programa académico de formación, en 1 año posterior a su egreso.',1,'(Número de alumnos que se insertan al mercado laboral en coincidencia con el programa académico de egreso en un tiempo máximo de un 1 año/total de alumnos de egreso del programa académico del mismo periodo)*100',20,'Número de alumnos que se insertan al mercado laboral en coincidencia con el programa académico de egreso en un tiempo máximo de un 1 año','a5','Total de alumnos de egreso del programa académico del mismo periodo*100','b5'),(6,2,1,'Aprovechamiento de la planta docente ','Aprovechamiento de la Planta Docente','Total de horas frente a grupo por profesores de base por academia  20%',0,'(Total de horas frente a grupo por profesores de base por periodo semestral por academia/  cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia)',20,'Total de horas frente a grupo por profesores de base por periodo semestral por academia','a6','Cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia.','b6'),(7,2,1,'Docentes de Asignatura activos en el Sector Productivo','Docentes de Asignatura activos en el Sector Productivo','Porcentaje de docentes de asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen 20%',0,'(Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica/total de docentes contratados por asignatura  por unidad académica)*100',20,'Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica.','a7','Total de docentes contratados por asignatura  por unidad académica.','b7'),(8,2,1,'Profesores en educación continua para la docencia','Profesores formados para la docencia y/o en educación continua para la docencia en los ultimos 5 años','Porcentaje de profesores actualizados  para la docencia con al menos una acción formativa por año en la unidad académica 20%',0,'(Número de profesores formados para la docencia con por lo menos una acción de formación   por año por unidad académica / total de la planta docente)*100',20,'Número de profesores formados para la docencia con por lo menos una acción de formación   por año por unidad académica.','a8','Total de la planta docente.','b8'),(9,2,1,'Docentes actualizados en el Área Disciplinar ','Docentes actualizados en el Área Disciplinar en los ultimos 2 años.','Porcentaje de profesores con por  lo menos una acción de actualización en su área disciplinar   20%',0,'(Número de profesores con por  lo menos una acción de actualización en su área disciplinar  / total de los profesores)*100',20,'Número de profesores con por  lo menos una acción de actualización en su área disciplinar.','a9','Total de los profesores.','b9'),(10,3,2,'Programas Académicos Acreditados','Programas Académicos Acreditados','Porcentaje de programas académicos acreditados por organismos externos 50%',1,'(Número de programas académicos acreditados por organismos externos por unidad académica/Número de programas académicos ofertados por Unidad Académica) *100 ',50,'Número de programas académicos acreditados por organismos externos por unidad académica','a10','Número de programas académicos ofertados por Unidad Académica','b10'),(11,3,2,'Programas Académicos Actualizados','Programas Académicos Actualizados o Rediseñados','Porcentaje de   programas de estudio  actualizados por programa académico en los últimos 4 años 50%',1,'(Número de programas de estudio actualizados/Total de progrmas de estudio de los programas académicos de la Unidad Académica) *100 ',50,'Número de programas de estudio actualizados','a11','Total de programas de estudio de los programas académicos de la Unidad Académica','b11'),(12,5,2,'Capacidad de atención de alumnos en relación a talleres y laboratorios','Capacidad de atención a alumnos en relación a talleres y laboratorios','Capacidad de atención a alumnos por talleres y laboratorios por unidad académica y semestre 30%',0,'(Capacidad instalada de atención en laboratorios y talleres por el total de semestres, identificando la capacidad del taller o laboratotio con menor capacidad) ',30,'Capacidad instalada de atención en laboratorios y talleres por el total de semestres, identificando la capacidad del taller o laboratorio con menor capacidad.','a12','','b12'),(13,5,2,'Aulas Equipadas','Aulas Equpadas','Aulas equipadas conforme al modelo ideal por unidad académica (Cañon, Internet, Pantalla, Pizarron, Butacas, Escritorio) 35',0,'(Número de aulas equipadas por unidad académica/el total de aulas)*100',35,'Número de aulas equipadas por unidad académica.','a13','Total de aulas.','b13'),(14,5,2,'Laboratorios Equipado','Laboratorios Equipado','Laboratorios equipados conforme currícula por programa académico por unidad académica y año 35%',0,'(Número de laboratorios equipados conforme currícula por programa académico / total de laboratorios por programa académico)*100',35,'Número de laboratorios equipados conforme currícula por programa académico.','a14','Total de laboratorios por programa académico.','b14'),(15,6,3,'Becas  de Manutención','Becas','Porcentaje de alumnos beneficiados con algun tipo  de beca rgistrada den el SIBA, por año y unidad académica.',1,'(Número de alumnos beneficiados con  algun tipo de beca  rgistrada den el SIBA, por año y unidad académica/matrícula total por unidad académica)*100',100,'Número de alumnos beneficiados con  algun tipo de beca  rgistrada den el SIBA, por año y unidad académica','a15','Matrícula total por unidad académica *100','b15'),(16,7,3,'Alumnos Tutorados ','Alumnos Tutorados ','Porcentaje de alumnos tutorados por periodo escolar y  programa académico ',1,'(Número de alumnos tutorados por periodo escolar / matrícula total )*100',100,'Número de alumnos tutorados por periodo escolar','a16','Matrícula total *100','b16'),(17,8,3,'Bibliotecas','Títulos Actualizados','Porcentaje det títulos impresos y/o digitales disponibles con edición en un tiempo no mayor a 5 años a la fecha 50%',0,'(Número de títulos actualizados impresos o digitales por programa académico / Total del acervo bibliográfico por programa académico)*100',50,'Número de títulos actualizados impresos o digitales por programa académico','a17',' Total del acervo bibliográfico por programa académico *100','b17'),(18,8,3,'Mantenimiento y limpieza','Cumplimiento del programa de mantenimiento','Porcentaje de cumpliemito del programa de mantenimiento 50%',0,'(Número de servicios atendidos / Total servicios solicitados o programados por semestre)*100',50,'Número de servicios atendidos','a18','Total servicios solicitados o programados por semestre *100','b18'),(19,8,3,'Mantenimiento y limpieza','Cumplimiento del programa de limpieza','Porcentaje de cumpliemito del programa de limpieza 50%',0,'(Número de servicios atendidos / Total servicios programados por semestre)*100',50,'Número de servicios atendidos','a19','Total servicios programados por semestre *100','b19'),(20,9,4,'Alumnos Inscritos Participando en Servicio Social','Alumnos Participando en Servicio Social','Porcentaje  de alumnos  en alguno de los programas de servicio social por unidad académica ',1,'(Número de alumnos participando en sevicio social  por programa académico por año  / total de alumnos que deben hacer servicio social por programa académico)*100',35,'Número de alumnos participando en sevicio social  por programa académico por año','a20','Total de alumnos que deben hacer servicio social por programa académico *100','b20'),(21,10,4,'Alumnos insritos Realizando Prácticas Profesionales','Alumnos  Realizando Prácticas Profesionales','Porcentaje  de alumnos realizando prácticas profesionales por programa académico por año',1,'(Número de alumnos realizando prácticas profesionales  por programa académico por año  / total de alumnos que deben hacer prácticas profesionales por programa académico)*100',35,'Número de alumnos realizando prácticas profesionales  por programa académico por año','a21','Total de alumnos que deben hacer prácticas profesionales por programa académico *100','b21'),(22,11,4,'Proyectos Vinculados','Proyectos Vinculados','Tasa de variación del número de  proyectos vinculados por unidad académica. ',0,'(Número de proyectos vinculados por unidad académica por año  / Número de proyectos vinculados por unidad académica en el año inmediato anterior)-1)*100',30,'Número de proyectos vinculados por unidad académica por año','a22','Número de proyectos vinculados por unidad académica en el año inmediato anterior)-1)*100','b22'),(23,12,5,'Profesores de carrera que están involucrados en investigaciones','Profesores de carrera realizando investigación','Profesores  con dictamén de carrera (1/2, 3/4 y T.Completo) que participan en Proyectos de Investigación avalados por la SIP ',0,'(Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP/Total de Profesoress de carrera de la Unidad Académica)*100',100,'Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP','a23','Total de Profesoress de carrera de la Unidad Académica *100','b23'),(24,13,5,'Innovaciones Educativas ','Innovaciones Educativas','Tasa de variación del  número de Innovaciones educativas identificadas, incubadas o escaladas por unidad académica ',0,'(Número de innovaciones educativas identificadas,  incubadas o escaladas por unidad académica y por año/ el total de innovaciones educativas identificadas, incubadas o escaladas por unidad académica del año inmediato anterior) -1)*100',100,'Número de innovaciones educativas identificadas,  incubadas o escaladas por unidad académica y por año','a24','El total de innovaciones educativas identificadas, incubadas o escaladas por unidad académica del año inmediato anterior) -1)*100','b24'),(25,14,6,'Inversión de los recursos autogenerados','Porcentaje de recursos autogenerados netos dedicados al  mantenimiento del inmueble y mantenimiento del equipo','Monto de los recursos autogenerados que se destinan al pago de Servicios de mantenimiento del inmueble y mantenimiento del equipo',0,'(Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo / total de los recursos autogenerados anualmente)*100',100,'Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo','a25','Rotal de los recursos autogenerados anualmente *100','b25');
/*!40000 ALTER TABLE `Indicador3Sup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IndicadorMs`
--

DROP TABLE IF EXISTS `IndicadorMs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IndicadorMs` (
  `idIndicadorMs` int(11) NOT NULL,
  `idUnidad` int(11) NOT NULL,
  `idBloque` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  `idCampo` varchar(1000) NOT NULL,
  `BAlumnosRegulares` int(11) DEFAULT NULL,
  `BAlumnosRegularesT` int(11) DEFAULT NULL,
  `BEficienciaTerminal` int(11) DEFAULT NULL,
  `BEficienciaTerminalT` int(11) DEFAULT NULL,
  `BAlumnosTitulados` int(11) DEFAULT NULL,
  `BAlumnosTituladosT` int(11) DEFAULT NULL,
  `BPromocionNS` int(11) DEFAULT NULL,
  `BPromocionNST` int(11) DEFAULT NULL,
  `BHorasFrenteGrupo` int(11) DEFAULT NULL,
  `BHorasFrenteGrupoT` int(11) DEFAULT NULL,
  `BProfesoresActivos` int(11) DEFAULT NULL,
  `BProfesoresActivosT` int(11) DEFAULT NULL,
  `BProfesoresActualizados` int(11) DEFAULT NULL,
  `BProfesoresActualizadosT` int(11) DEFAULT NULL,
  `BEvaluacionesIndividuales` int(11) DEFAULT NULL,
  `BEvaluacionesIndividualesT` int(11) DEFAULT NULL,
  `BProgramasAcademicos` int(11) DEFAULT NULL,
  `BProgramasAcademicosT` int(11) DEFAULT NULL,
  `BLaboratoriosEquipados` int(11) DEFAULT NULL,
  `BLaboratoriosEquipadosT` int(11) DEFAULT NULL,
  `BAlumnosTutorados` int(11) DEFAULT NULL,
  `BAlumnosTutoradosT` int(11) DEFAULT NULL,
  `BlibrosTitulosEditados` int(11) DEFAULT NULL,
  `BlibrosTitulosEditadosT` int(11) DEFAULT NULL,
  `BTotalEjemplares` int(11) DEFAULT NULL,
  `BTotalEjemplaresT` int(11) DEFAULT NULL,
  `BAlumnosServicioSocial` int(11) DEFAULT NULL,
  `BAlumnosServicioSocialT` int(11) DEFAULT NULL,
  `BALumnosVisitas` int(11) DEFAULT NULL,
  `BALumnosVisitasT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IndicadorMs`
--

LOCK TABLES `IndicadorMs` WRITE;
/*!40000 ALTER TABLE `IndicadorMs` DISABLE KEYS */;
INSERT INTO `IndicadorMs` VALUES (0,1,124,1,'b1',454545,433,345,3,43,43,4,34,34,34,65,65656544,4,564,78,78,6,56,545,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(0,1,125,1,'b2',43,4,543,45,4,34,3,43,3,43,34,34,68,4,7,8,65,6,45,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(0,1,126,1,'b3',34,34,345,3,343,43,4,345,4,345,3,43,54,5,8,78,56,5,4,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(0,1,127,1,'b4',3,53,543,54,4,34,345,3,345,3,56,54,46,4,7,87,65,678,6,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(0,1,128,1,'b5',543,543,34,34,34,3,8,5,8,5,45,45,45,6485,8,78,6,5,7,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `IndicadorMs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IndicadorSup`
--

DROP TABLE IF EXISTS `IndicadorSup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IndicadorSup` (
  `idIndicadorSup` int(11) NOT NULL AUTO_INCREMENT,
  `idUnidad` int(11) NOT NULL,
  `idBloque` int(11) NOT NULL,
  `idEvaluacion` int(11) NOT NULL,
  `idCampo` varchar(1000) NOT NULL,
  `BAlumnosRegulares` int(11) DEFAULT NULL,
  `BAlumnosRegularesT` int(11) DEFAULT NULL,
  `BEficienciaTerminal` int(11) DEFAULT NULL,
  `BEficienciaTerminalT` int(11) DEFAULT NULL,
  `BAlumnosTitulados` int(11) DEFAULT NULL,
  `BAlumnosTituladosT` int(11) DEFAULT NULL,
  `BAlumnosRiesgoAbandono` int(11) DEFAULT NULL,
  `BAlumnosRiesgoAbandonoT` int(11) DEFAULT NULL,
  `BRecienEgresados` int(11) DEFAULT NULL,
  `BRecienEgresadosT` int(11) DEFAULT NULL,
  `BAprovechamientoPlanta` int(11) DEFAULT NULL,
  `BAprovechamientoPlantaT` int(11) DEFAULT NULL,
  `BDocentesActivosSecProd` int(11) DEFAULT NULL,
  `BDocentesActivosSecProdT` int(11) DEFAULT NULL,
  `BProfesoresFormados` int(11) DEFAULT NULL,
  `BProfesoresFormadosT` int(11) DEFAULT NULL,
  `BDocentesActualizados` int(11) DEFAULT NULL,
  `BDocentesActualizadosT` int(11) DEFAULT NULL,
  `BProgramasAcedAcred` int(11) DEFAULT NULL,
  `BProgramasAcedAcredT` int(11) DEFAULT NULL,
  `BProgramasAcualizados` int(11) DEFAULT NULL,
  `BProgramasAcualizadosT` int(11) DEFAULT NULL,
  `BCapacidadAtencionAlumnos` int(11) DEFAULT NULL,
  `BCapacidadAtencionAlumnosT` int(11) DEFAULT NULL,
  `BAulasEquipadas` int(11) DEFAULT NULL,
  `BAulasEquipadasT` int(11) DEFAULT NULL,
  `BLaboratoriosEquipados` int(11) DEFAULT NULL,
  `BLaboratoriosEquipadosT` int(11) DEFAULT NULL,
  `BBecas` int(11) DEFAULT NULL,
  `BBecasT` int(11) DEFAULT NULL,
  `BALumnosTutorados` int(11) DEFAULT NULL,
  `BALumnosTutoradosT` int(11) DEFAULT NULL,
  `BTitulosAct` int(11) DEFAULT NULL,
  `BTitulosActT` int(11) DEFAULT NULL,
  `BCumplimientoMant` int(11) DEFAULT NULL,
  `BCumplimientoMantT` int(11) DEFAULT NULL,
  `BCumplimientoProgLimp` int(11) DEFAULT NULL,
  `BCumplimientoProgLimpT` int(11) DEFAULT NULL,
  `BAlumnosSerSoc` int(11) DEFAULT NULL,
  `BAlumnosSerSocT` int(11) DEFAULT NULL,
  `BAlumnosPractProf` int(11) DEFAULT NULL,
  `BAlumnosPractProfT` int(11) DEFAULT NULL,
  `BProyectosVinculados` int(11) DEFAULT NULL,
  `BProyectosVinculadosT` int(11) DEFAULT NULL,
  `BInovaEduc` int(11) DEFAULT NULL,
  `BInovaEducT` int(11) DEFAULT NULL,
  `BPorcRecAut` int(11) DEFAULT NULL,
  `BPorcRecAutT` int(11) DEFAULT NULL,
  PRIMARY KEY (`idIndicadorSup`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IndicadorSup`
--

LOCK TABLES `IndicadorSup` WRITE;
/*!40000 ALTER TABLE `IndicadorSup` DISABLE KEYS */;
INSERT INTO `IndicadorSup` VALUES (1,26,240,1,'b1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,189,34,9,94,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,30,248,2,'b1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,7,56,87,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,30,249,2,'b2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,45,7,67,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,30,250,2,'b3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,54,9,443,44,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,30,251,2,'b4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,4,343,898,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,30,252,2,'b5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,98,65,54,656,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,30,253,2,'b6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,45,544,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `IndicadorSup` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Infraestructura`
--

LOCK TABLES `Infraestructura` WRITE;
/*!40000 ALTER TABLE `Infraestructura` DISABLE KEYS */;
INSERT INTO `Infraestructura` VALUES (20,1,656765767,656,54,454,0,0,'/uploads/oferta/infraestructura/1_1_','/uploads/oferta/infraestructura/1_2_','/uploads/oferta/infraestructura/1_3_'),(21,2,0,0,0,0,0,0,NULL,NULL,NULL),(22,3,0,0,0,0,0,0,NULL,NULL,NULL),(23,4,0,0,0,0,0,0,NULL,NULL,NULL),(24,5,0,0,0,0,0,0,NULL,NULL,NULL),(25,6,0,0,0,0,0,0,NULL,NULL,NULL),(26,7,0,0,0,0,0,0,NULL,NULL,NULL),(27,8,0,0,0,0,0,0,NULL,NULL,NULL),(28,9,0,0,0,0,0,0,NULL,NULL,NULL),(29,10,0,0,0,0,0,0,NULL,NULL,NULL),(30,11,0,0,0,0,0,0,NULL,NULL,NULL),(31,12,0,0,0,0,0,0,NULL,NULL,NULL),(32,13,0,0,0,0,0,0,NULL,NULL,NULL),(33,14,0,0,0,0,0,0,NULL,NULL,NULL),(34,15,0,0,0,0,0,0,NULL,NULL,NULL),(35,16,0,0,0,0,0,0,NULL,NULL,NULL),(36,17,0,0,0,0,0,0,NULL,NULL,NULL),(37,18,0,0,0,0,0,0,NULL,NULL,NULL),(38,19,0,0,0,0,0,0,NULL,NULL,NULL),(39,20,0,0,0,0,0,0,NULL,NULL,NULL),(40,21,0,0,0,0,0,0,NULL,NULL,NULL),(41,22,0,0,0,0,0,0,NULL,NULL,NULL),(42,1,656765767,656,54,454,0,0,'/uploads/oferta/infraestructura/1_1_','/uploads/oferta/infraestructura/1_2_','/uploads/oferta/infraestructura/1_3_');
/*!40000 ALTER TABLE `Infraestructura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `InfraestructuraSup`
--

DROP TABLE IF EXISTS `InfraestructuraSup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `InfraestructuraSup` (
  `idInfraestructuraSup` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `CapacidadInstalada` int(11) DEFAULT '0',
  `NumeroAulas` int(11) DEFAULT '0',
  `TotalAulas` int(11) DEFAULT '0',
  `NumeroLaboratorios` int(11) DEFAULT '0',
  `TotalLaboratorios` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  `comprobante3` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idInfraestructuraSup`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InfraestructuraSup`
--

LOCK TABLES `InfraestructuraSup` WRITE;
/*!40000 ALTER TABLE `InfraestructuraSup` DISABLE KEYS */;
INSERT INTO `InfraestructuraSup` VALUES (1,1,12,67,6,56,59,'/uploads/oferta/infraestructurasup/1_1_9338635.png','/uploads/oferta/infraestructurasup/1_2_less.jpg','/uploads/oferta/infraestructurasup/1_3_9338635.png'),(2,2,56,56,32,98,57,'/uploads/oferta/infraestructurasup/2_1_','/uploads/oferta/infraestructurasup/2_2_','/uploads/oferta/infraestructurasup/2_3_');
/*!40000 ALTER TABLE `InfraestructuraSup` ENABLE KEYS */;
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
  `InvestigacionesPublicadas` int(11) DEFAULT '0',
  `InvestigacionesPublicadasAnt` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idInnovacionEducativa`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InnovacionEducativa`
--

LOCK TABLES `InnovacionEducativa` WRITE;
/*!40000 ALTER TABLE `InnovacionEducativa` DISABLE KEYS */;
INSERT INTO `InnovacionEducativa` VALUES (20,1,0,0,0,0,NULL,NULL),(21,2,0,0,0,0,NULL,NULL),(22,3,0,0,0,0,NULL,NULL),(23,4,0,0,0,0,NULL,NULL),(24,5,0,0,0,0,NULL,NULL),(25,6,0,0,0,0,NULL,NULL),(26,7,0,0,0,0,NULL,NULL),(27,8,0,0,0,0,NULL,NULL),(28,9,0,0,0,0,NULL,NULL),(29,10,0,0,0,0,NULL,NULL),(30,11,0,0,0,0,NULL,NULL),(31,12,0,0,0,0,NULL,NULL),(32,13,0,0,0,0,NULL,NULL),(33,14,0,0,0,0,NULL,NULL),(34,15,0,0,0,0,NULL,NULL),(35,16,0,0,0,0,NULL,NULL),(36,17,0,0,0,0,NULL,NULL),(37,18,0,0,0,0,NULL,NULL),(38,19,0,0,0,0,NULL,NULL),(39,20,0,0,0,0,NULL,NULL),(40,21,0,0,0,0,NULL,NULL),(41,22,0,0,0,0,NULL,NULL),(42,1,0,0,0,0,NULL,NULL);
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
  `comprobante1` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idInvestigacionDocencia`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InvestigacionDocencia`
--

LOCK TABLES `InvestigacionDocencia` WRITE;
/*!40000 ALTER TABLE `InvestigacionDocencia` DISABLE KEYS */;
INSERT INTO `InvestigacionDocencia` VALUES (1,1,0,0,NULL),(2,2,0,0,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,20,0,0,NULL),(21,21,0,0,NULL),(22,22,0,0,NULL),(23,1,0,0,NULL);
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
  PRIMARY KEY (`idProgramasAcademicos`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProgramasAcademicos`
--

LOCK TABLES `ProgramasAcademicos` WRITE;
/*!40000 ALTER TABLE `ProgramasAcademicos` DISABLE KEYS */;
INSERT INTO `ProgramasAcademicos` VALUES (1,1,0,0,'/uploads/oferta/programas/1_1_9338635.png'),(2,2,0,0,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,20,0,0,NULL),(21,21,0,0,NULL),(22,22,0,0,NULL),(23,1,0,0,'/uploads/oferta/programas/1_1_9338635.png');
/*!40000 ALTER TABLE `ProgramasAcademicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProgramasAcademicosSup`
--

DROP TABLE IF EXISTS `ProgramasAcademicosSup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProgramasAcademicosSup` (
  `idProgramasAcademicosSup` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `ProgramasAcreditados` int(11) DEFAULT '0',
  `ProgramasOfertados` int(11) DEFAULT '0',
  `ProgramasActualizados` int(11) DEFAULT '0',
  `TotalProgramasEstudio` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  `comprobante2` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idProgramasAcademicosSup`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProgramasAcademicosSup`
--

LOCK TABLES `ProgramasAcademicosSup` WRITE;
/*!40000 ALTER TABLE `ProgramasAcademicosSup` DISABLE KEYS */;
INSERT INTO `ProgramasAcademicosSup` VALUES (1,1,0,0,0,0,'/uploads/oferta/programassup/1_1_less.jpg','/uploads/oferta/programassup/1_2_9338635.png'),(2,2,0,0,0,0,'/uploads/oferta/programassup/2_1_','/uploads/oferta/programassup/2_2_');
/*!40000 ALTER TABLE `ProgramasAcademicosSup` ENABLE KEYS */;
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
  `comprobante1` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idProyectosVinculados`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProyectosVinculados`
--

LOCK TABLES `ProyectosVinculados` WRITE;
/*!40000 ALTER TABLE `ProyectosVinculados` DISABLE KEYS */;
INSERT INTO `ProyectosVinculados` VALUES (1,1,0,0,NULL),(2,2,0,0,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,20,0,0,NULL),(21,21,0,0,NULL),(22,22,0,0,NULL),(23,1,0,0,NULL);
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
  `comprobante1` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idRecursosAutogenerados`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RecursosAutogenerados`
--

LOCK TABLES `RecursosAutogenerados` WRITE;
/*!40000 ALTER TABLE `RecursosAutogenerados` DISABLE KEYS */;
INSERT INTO `RecursosAutogenerados` VALUES (1,1,0,0,NULL),(2,2,0,0,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,20,0,0,NULL),(21,21,0,0,NULL),(22,22,0,0,NULL),(23,1,0,0,NULL);
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
  `comprobante1` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idServicioSocial`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ServicioSocial`
--

LOCK TABLES `ServicioSocial` WRITE;
/*!40000 ALTER TABLE `ServicioSocial` DISABLE KEYS */;
INSERT INTO `ServicioSocial` VALUES (1,1,0,0,NULL),(2,2,0,0,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,20,0,0,NULL),(21,21,0,0,NULL),(22,22,0,0,NULL),(23,1,0,0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tutorias`
--

LOCK TABLES `Tutorias` WRITE;
/*!40000 ALTER TABLE `Tutorias` DISABLE KEYS */;
INSERT INTO `Tutorias` VALUES (1,1,0,0,NULL),(2,2,0,0,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,20,0,0,NULL),(21,21,0,0,NULL),(22,22,0,0,NULL),(23,1,0,0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Unidad`
--

LOCK TABLES `Unidad` WRITE;
/*!40000 ALTER TABLE `Unidad` DISABLE KEYS */;
INSERT INTO `Unidad` VALUES (1,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 01 \"GONZALO VÁZQUEZ VELA\"','CECyT 1 GVV',22,NULL,'MED'),(2,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 02 \"MIGUEL BERNARD\"','CECyT 2 MB',23,NULL,'MED'),(3,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 03 \"ESTANISLAO RAMÍREZ RUÍZ\"','CECyT 3 ERR',NULL,NULL,'MED'),(4,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 04 \"LÁZARO CÁRDENAS\"','CECyT 4 LC',NULL,NULL,'MED'),(5,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 05 \"BENITO JUÁREZ\"','CECyT 5',NULL,NULL,'MED'),(6,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 06 \"MIGUEL OTHÓN DE MENDIZABAL\"','CECyT 6',NULL,NULL,'MED'),(7,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 07 \"CUAUHTÉMOC\"','CECyT 7',NULL,NULL,'MED'),(8,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 08 \"NARCISSO BASSOLS\"','CECyT 8',NULL,NULL,'MED'),(9,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 09 \"JUAN DE DIOS BATÍZ\"','CECyT 9',NULL,NULL,'MED'),(10,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 10 \"CARLOS VALLEJO MARQUÉZ\"','CECyT 10',NULL,NULL,'MED'),(11,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 11 \"WILFRIDO MASSIEU\"','CECyT 11',NULL,NULL,'MED'),(12,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 12 \"JOSÉ MARIA MORELOS Y PAVÓN\"','CECyT 12',NULL,NULL,'MED'),(13,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 13 \"RICARDO FLORES MAGÓN\"','CECyT 413',NULL,NULL,'MED'),(14,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 14 \"LUIS ENRIQUE ERRO\"','CECyT 14',NULL,NULL,'MED'),(15,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 15 \"DIÓDORO ANTÚNEZ ECHEGARAY\"','CECyT 15',NULL,NULL,'MED'),(16,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 16 \"HIDALGO\"','CECyT 16',NULL,NULL,'MED'),(17,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 17 \"LEÓN GUANAJUATO\"','CECyT 17',NULL,NULL,'MED'),(18,'CENTRO DE ESTUDIOS TECNOLÓGICOS NO. 01 \"WALTER CROSS BUCHANAN\"','CET 1',NULL,NULL,'MED'),(19,'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA (ESIME) UNIDAD ZACATENCO','ESIME ZACATENCO',NULL,NULL,'SUP'),(20,'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA (ESIME) UNIDAD CULHUACÁN','ESIME CULHUACAN',NULL,NULL,'SUP'),(21,'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA (ESIME) UNIDAD AZCAPOTZALCO','ESIME AZCAPOTZALCO',NULL,NULL,'SUP'),(22,'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA (ESIME) UNIDAD TICOMÁN','ESIME TICOMAN',NULL,NULL,'SUP'),(23,'ESCUELA SUPERIOR DE INGENIERÍA Y ARQUITECTURA (ESIA) UNIDAD ZACATENCO','ESIA ZACATENCO',NULL,NULL,'SUP'),(24,'ESCUELA SUPERIOR DE INGENIERÍA Y ARQUITECTURA (ESIA) UNIDAD TECAMACHALCO','ESIA TECAMACHALCO',NULL,NULL,'SUP'),(25,'ESCUELA SUPERIOR DE INGENIERÍA Y ARQUITECTURA (ESIA) UNIDAD TICOMÁN','ESIA TICOMAN',NULL,NULL,'SUP'),(26,'ESCUELA SUPERIOR DE INGENIERÍA TEXTIL ESIT','ESIT',NULL,NULL,'SUP'),(27,'ESCUELA SUPERIOR DE INGENIERÍA QUÍMICA E INDUSTRIAS EXTRACTIVAS ESIQIE','ESIQIE',NULL,NULL,'SUP'),(28,'ESCUELA SUPERIOR DE FÍSICA MATEMÁTICAS ESFM','ESFM',NULL,NULL,'SUP'),(29,'ESCUELA SUPERIOR DE CÓMPUTO ESCOM','ESCOM',NULL,NULL,'SUP'),(30,'UNIDAD PROFESIONAL INTERDISCIPLINARIA Y CIENCIAS SOCIALES Y ADMIBNISTRATIVAS UPIICSA','UPIICSA',NULL,NULL,'SUP'),(31,'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA Y TECNOLOGÍAS AVANZADAS UPIITA','UPIITA',NULL,NULL,'SUP'),(32,'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE BIOTECNOLOGÍA UPIBI','UPIBI',NULL,NULL,'SUP'),(33,'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA CAMPUS GUANAJUATO (UPIIG)','UPIIG',NULL,NULL,'SUP'),(34,'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA CAMPUS ZACATECAS (UPIIZ)','UPIIZ',NULL,NULL,'SUP'),(35,'UPIIH','UPIIH',NULL,NULL,'SUP'),(36,'ESCUELA NACIONAL DE CIENCIAS BIOLÓGICAS ENCB','ENCB',NULL,NULL,'SUP'),(37,'ESCUELA SUPERIOR DE MEDICINA ESM','ESM',NULL,NULL,'SUP'),(38,'ESCUELA NACIONAL DE MEDICINA Y HOMEOPATÍA ENMYH','ENMH',NULL,NULL,'SUP'),(39,'ESCUELA SUPERIOR DE ENFERMERÍA Y OBSTETRICIA ESEO','ESEO',NULL,NULL,'SUP'),(40,'CENTRO INTERDISCIPLINARIO DE CIENCIAS DE LA SALUD - UNIDAD MILPA ALTA (CICS - UMA)','CICS MILPA ALTA',NULL,NULL,'SUP'),(41,'CENTRO INTERDISCIPLINARIO DE CIENCIAS DE LA SALUD - UNIDAD SANTO TOMÁS (CICS - UST)','CICS SANTO TOMAS',NULL,NULL,'SUP'),(42,'ESCUELA SUPERIOR DE COMERCIO Y ADMINISTRACIÓN UNIDAD SANTO TOMÁS','ESCA SANTO TOMAS',NULL,NULL,'SUP'),(43,'ESCUELA SUPERIOR DE COMERCIO Y ADMINISTRACIÓN UNIDAD TEPEPAN','ESCA TEPEPAN',NULL,NULL,'SUP'),(44,'ESCUELA SUPERIOR DE ECONOMÍA ESE','ESE',NULL,NULL,'SUP'),(45,'ESCUELA SUPERIOR DE TURISMO EST','EST',NULL,NULL,'SUP'),(46,'CENTRO DE ESTUDIOS CIENTÍFICOS Y TECNOLÓGICOS NO. 18 \"ZACATECAS\"','CECYT 18',NULL,NULL,'MED');
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (3,2,1,'CECYT1','CECYT1','CECYT1','cecyt1','463ec3251d8569ccdffcb6ae5446abcb','cecy1@ipn.mx',345),(4,2,2,'CECYT2','CECYT','CECYT2','cecyt2','55ef2670525e1d5282e2652dc9446e3b','cecy2@ipn.mx',345),(5,2,3,'CECYT3','CECYT','CECYT3','cecyt3','fc32576f6aa63a2afd791749b0cad9db','cecy3@ipn.mx',345),(6,2,4,'CECYT4','CECYT','CECYT4','cecyt4','f76c3942d3b3975f8061c43cb9dec38f','cecy4@ipn.mx',345),(7,2,5,'CECYT5','CECYT','CECYT5','cecyt5','6e65c027535978ca51e1bde014e33f96','cecy5@ipn.mx',345),(8,2,6,'CECYT6','CECYT','CECYT6','cecyt6','bec28112040e24cb2ecef43e7a079365','cecy6@ipn.mx',345),(9,2,7,'CECYT7','CECYT','CECYT7','cecyt7','f229d75823b80ee2e1ce2d9ec76d13db','cecy7@ipn.mx',345),(10,2,8,'CECYT8','CECYT','CECYT8','cecyt8','33c1f80fcb8fdf85d656e9b37a5a6cfe','cecy8@ipn.mx',345),(11,2,9,'CECYT9','CECYT','CECYT9','cecyt9','a938fabce8fff817955a84eccbe5e12a','cecy9@ipn.mx',345),(12,2,10,'CECYT10','CECYT','CECYT10','cecyt10','369539fe397a2df865f11e4993517566','cecy10@ipn.mx',345),(13,2,11,'CECYT11','CECYT','CECYT11','cecyt11','782026ae776ee12310fa6fc725bf8a63','cecy11@ipn.mx',345),(14,2,12,'CECYT12','CECYT','CECYT12','cecyt12','22e966bb9c165a64ac129c040bdb6a13','cecy12@ipn.mx',345),(15,2,13,'CECYT13','CECYT','CECYT13','cecyt13','72e133cb105a3f46bd4671d60c0df649','cecy13@ipn.mx',345),(16,2,14,'CECYT14','CECYT','CECYT14','cecyt14','8727ce7bd9fc9d0a936b964f5554054a','cecy14@ipn.mx',345),(17,2,15,'CECYT15','CECYT','CECYT15','cecyt15','839838df157423bb87c0e6f270fa8e82','cecy15@ipn.mx',345),(18,2,16,'CECYT16','CECYT','CECYT16','cecyt16','ce0e0c64e0f477df911dd49752eaed78','cecy16@ipn.mx',345),(19,2,17,'CECYT17','CECYT','CECYT17','cecyt17','dc3f0e21b3610c72d1b7f5192b8d0c38','cecy17@ipn.mx',345),(20,2,18,'CET1','CET1','CET1','cet1','c3724470faeb0795262c98619954dceb','cet1@ipn.mx',345),(21,2,19,'ESIME ZACATENCO','',NULL,'esimezac','8f52d59b5498d54822627d01e0ebd7b1','ipn@ipn.mx',345),(22,2,20,'ESIME CULHUACAN','',NULL,'esimecul','dc5228484f9e78af0bd9236ca839aa25','ipn@ipn.mx',345),(23,2,21,'ESIME AZCAPOTZALCO','',NULL,'esimeazc','8160388c418d3b7c8339d58dba211d96','ipn@ipn.mx',345),(24,2,22,'ESIME TICOMAN','',NULL,'esimetic','3d923bc92c0e5a65eaf4ad6f26b7dcb8','ipn@ipn.mx',345),(25,2,23,'ESIA ZACATENCO','',NULL,'esiazac','ca3f4e3a10576d20a015a2c0aa0b858d','ipn@ipn.mx',345),(26,2,24,'ESIA TECAMACHALCO','',NULL,'esiatec','e7fadfdcf739a98425bac75e71d3a146','ipn@ipn.mx',345),(27,2,25,'ESIA TICOMAN','',NULL,'esiatic','bc5afe19bda352d8d1bf4e0e5c2f0fcf','ipn@ipn.mx',345),(28,2,26,'ESIT','',NULL,'esit','4981cba4a0f563237cef7f84f9d87f4c','ipn@ipn.mx',345),(29,2,27,'ESIQIE','',NULL,'esiqie','9259022f13d285b7c96fee2557ac93c6','ipn@ipn.mx',345),(30,2,28,'ESFM','',NULL,'esfm','feb2adf96e764b99965c00d5bfc73af3','ipn@ipn.mx',345),(31,2,29,'ESCOM','',NULL,'escom','2adb768b56c36e66a71438f31f1e706a','ipn@ipn.mx',345),(32,2,30,'UPIICSA','',NULL,'upiicsa','74f15c9a7ddaefeecdb607a04407d1b5','ipn@ipn.mx',345),(33,2,31,'UPIITA','',NULL,'upiita','9f5699ef9a16d76cfc88612d8269e219','ipn@ipn.mx',345),(34,2,32,'UPIBI','',NULL,'upibi','55a62bdc84760d7e240d0315999d877e','ipn@ipn.mx',345),(35,2,33,'UPIIG','',NULL,'upiig','ea3c128b6f9357aca9b76ebd2c69b06e','ipn@ipn.mx',345),(36,2,34,'UPIIZ','',NULL,'upiiz','f0e963db2e9b1fa7476fc23593d056d4','ipn@ipn.mx',345),(37,2,35,'UPIIH','',NULL,'upiih','5f03d80751d669d9ba34724f10fd331f','ipn@ipn.mx',345),(38,2,36,'ENCB','',NULL,'encb','7ee60bf477d9c58ff7b6da2328943e66','ipn@ipn.mx',345),(39,2,37,'ESM','',NULL,'esm','218a42548aff025d8feea023a7cc7081','ipn@ipn.mx',345),(40,2,38,'ENMH','',NULL,'enmh','c1fd178010eacd60cb8ed7dfcc2ca63d','ipn@ipn.mx',345),(41,2,39,'ESEO','',NULL,'eso','27d73db252390920d52fd3267ab6117a','ipn@ipn.mx',345),(42,2,40,'CICS MILPA ALTA','',NULL,'cicsma','f23b5c23bb2b51c4cb6b1145ccf01294','ipn@ipn.mx',345),(43,2,41,'CICS SANTO TOMAS','',NULL,'cicsst','bb4747adee224b2423f0e53e27fd7015','ipn@ipn.mx',345),(44,2,42,'ESCA SANTO TOMAS','',NULL,'escast','29ba7c4d91918822d51aef173bd3445d','ipn@ipn.mx',345),(45,2,43,'ESCA TEPEPAN','',NULL,'escatp','de5e5e00aa1c116c5b86b0281cf57b36','ipn@ipn.mx',345),(46,2,44,'ESE','',NULL,'ese','910ff191b0a39beebf59ea89ef4f017d','ipn@ipn.mx',345),(47,2,45,'EST','',NULL,'est','690979f83c6a1dbc067fb75695089f80','ipn@ipn.mx',345),(48,2,46,'CECYT18','',NULL,'cecyt18','8347d79799007c559991f8c489d3a830','cecyt18@ipn.mx',NULL);
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VisitasEscolares`
--

DROP TABLE IF EXISTS `VisitasEscolares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VisitasEscolares` (
  `idVisitasEscolares` int(11) NOT NULL AUTO_INCREMENT,
  `idEvaluacion` int(11) NOT NULL,
  `AlumnosVisita` int(11) DEFAULT '0',
  `TotalMatricula` int(11) DEFAULT '0',
  `comprobante1` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`idVisitasEscolares`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VisitasEscolares`
--

LOCK TABLES `VisitasEscolares` WRITE;
/*!40000 ALTER TABLE `VisitasEscolares` DISABLE KEYS */;
INSERT INTO `VisitasEscolares` VALUES (1,1,0,0,NULL),(2,2,0,0,NULL),(3,3,0,0,NULL),(4,4,0,0,NULL),(5,5,0,0,NULL),(6,6,0,0,NULL),(7,7,0,0,NULL),(8,8,0,0,NULL),(9,9,0,0,NULL),(10,10,0,0,NULL),(11,11,0,0,NULL),(12,12,0,0,NULL),(13,13,0,0,NULL),(14,14,0,0,NULL),(15,15,0,0,NULL),(16,16,0,0,NULL),(17,17,0,0,NULL),(18,18,0,0,NULL),(19,19,0,0,NULL),(20,20,0,0,NULL),(21,21,0,0,NULL),(22,22,0,0,NULL),(23,1,0,0,NULL);
/*!40000 ALTER TABLE `VisitasEscolares` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-05 20:40:32



DELIMITER $$
USE upev0012016$$
CREATE DEFINER = CURRENT_USER TRIGGER upev0012016.Evaluacion_AFTER_INSERT AFTER INSERT ON Evaluacion FOR EACH ROW
BEGIN

  INSERT INTO upev0012016.Alumnos (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.ApoyoEducativo (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.Docentes (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.ProgramasAcademicos (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.Tutorias (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.Becas (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.Infraestructura (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.ServicioSocial (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.VisitasEscolares (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.ProyectosVinculados (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.RecursosAutogenerados (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.InvestigacionDocencia (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.AlumnosInvestigacion (idEvaluacion) VALUES (NEW.idEvaluacion);
  INSERT INTO upev0012016.InnovacionEducativa (idEvaluacion) VALUES (NEW.idEvaluacion);

END
$$

DELIMITER ;


DELIMITER $$
USE upev0012016$$
CREATE DEFINER = CURRENT_USER TRIGGER upev0012016.EvaluacionSup_AFTER_INSERT AFTER INSERT ON EvaluacionSup FOR EACH ROW
BEGIN

  INSERT INTO upev0012016.AlumnosSup (idEvaluacion) VALUES (NEW.idEvaluacionSup);
  INSERT INTO upev0012016.DocentesSup (idEvaluacion) VALUES (NEW.idEvaluacionSup);
  INSERT INTO upev0012016.ProgramasAcademicosSup (idEvaluacion) VALUES (NEW.idEvaluacionSup);
  INSERT INTO upev0012016.InfraestructuraSup (idEvaluacion) VALUES (NEW.idEvaluacionSup);


END
$$

DELIMITER ;