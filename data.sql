-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: localhost    Database: upev0012016
-- ------------------------------------------------------
-- Server version	5.6.20

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
  PRIMARY KEY (`idAlumnos`,`idEvaluacion`),
  KEY `fk_Alumnos_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `idEvaluacion` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Alumnos`
--

LOCK TABLES `Alumnos` WRITE;
/*!40000 ALTER TABLE `Alumnos` DISABLE KEYS */;
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
  PRIMARY KEY (`idAlumnosInvestigacion`,`idEvaluacion`),
  KEY `fk_AlumnosInvestigacion_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_AlumnosInvestigacion_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AlumnosInvestigacion`
--

LOCK TABLES `AlumnosInvestigacion` WRITE;
/*!40000 ALTER TABLE `AlumnosInvestigacion` DISABLE KEYS */;
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
  `LibrosDisponibles` int(11) DEFAULT '0',
  `TotalLibrosFisicos` int(11) DEFAULT '0',
  `CapacidadInternet` int(11) DEFAULT '0',
  `UsuariosInternet` int(11) DEFAULT '0',
  `MantenimientoAtendido` int(11) DEFAULT '0',
  `MantenimientoSolicitado` int(11) DEFAULT '0',
  `LimpiezaAtendida` int(11) DEFAULT '0',
  `LimpiezaProgramada` int(11) DEFAULT '0',
  PRIMARY KEY (`idApoyoEducativo`,`idEvaluacion`),
  KEY `fk_ApoyoEducativo_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_ApoyoEducativo_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApoyoEducativo`
--

LOCK TABLES `ApoyoEducativo` WRITE;
/*!40000 ALTER TABLE `ApoyoEducativo` DISABLE KEYS */;
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
  PRIMARY KEY (`idBecas`,`idEvaluacion`),
  KEY `fk_Becas_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_Becas_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Becas`
--

LOCK TABLES `Becas` WRITE;
/*!40000 ALTER TABLE `Becas` DISABLE KEYS */;
/*!40000 ALTER TABLE `Becas` ENABLE KEYS */;
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
  PRIMARY KEY (`idDocentes`,`idEvaluacion`),
  KEY `fk_Docentes_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_Docentes_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Docentes`
--

LOCK TABLES `Docentes` WRITE;
/*!40000 ALTER TABLE `Docentes` DISABLE KEYS */;
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
  PRIMARY KEY (`idEvaluacion`,`idUnidad`),
  KEY `idUnidadFK_idx` (`idUnidad`),
  CONSTRAINT `idUnidad2` FOREIGN KEY (`idUnidad`) REFERENCES `Unidad` (`idUnidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evaluacion`
--

LOCK TABLES `Evaluacion` WRITE;
/*!40000 ALTER TABLE `Evaluacion` DISABLE KEYS */;
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
  PRIMARY KEY (`idFuncion`,`idEvaluacion`),
  KEY `funcion1_idx` (`idEvaluacion`),
  CONSTRAINT `funcion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
INSERT INTO `Indicador2` VALUES (1,1,'Alumnos',NULL,50),(2,1,'Pefil Docente',NULL,50),(3,2,'Programas académicos',NULL,50),(4,2,'Infraestructura',NULL,50),(5,3,'Becas',NULL,33),(6,3,'Tutorías',NULL,33),(7,3,'Servicio de apoyo educativo',NULL,34),(8,4,'Servicio social',NULL,30),(9,4,'Visitas escolares',NULL,35),(10,4,'Proyectos vinculados',NULL,35),(11,5,'Apoyo de la investigación a la docencia',NULL,40),(12,5,'Participación de los alumnos en investigaciones',NULL,30),(13,5,'Innovación e investigación educativa',NULL,30),(14,6,'Recursos autogenerados',NULL,100);
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
  `Valor` float DEFAULT NULL,
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
INSERT INTO `Indicador3` VALUES (1,1,1,'Rendimiento','Alumnos en situación escolar regular','Porcentaje de alumnos que han aprobado todas las unidades de aprendizaje en las que han estado inscritos por Unidad  académica',35),(2,1,1,'Eficiencia terminal','Eficiencia  termina','Porcentaje de alumnos que egresan por cohorte generacional por programa académico ',25),(3,1,1,'Titulación','Alumnos titulados ','Porcentaje de alumnos titulados hasta tres años después de egresar por programa académico',5),(4,1,1,'Promoción de NMS a NS','Promoción  de alumnos por nivel educativo','Porcentaje de alumnos de NMS del IPN que concluyeron el último semestre y presentaron examen de admision  y ocuparon un lugar en NS del IPN',35),(5,2,1,'Aprovechamiento de la planta docente','Aprovechamiento de la Planta Docente','Total de horas frente a grupo por profesores de base por academia  25%',20),(6,2,1,'Docentes de asignatura activos en el sector productivo','Docentes de Asignatura activos en el Sector Productivo','Porcentaje de docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen 25%',15),(7,2,1,'Docentes actualizados en el área diciplinar','Docentes actualizados en el Área Disciplinar','Porcentaje de profesores con por  lo menos una acción de actualización en su área disciplinar en los últimos dos años   25%',25),(8,2,1,'Desempeño docente por academia','Desempeño Docente ','Promedio de las evaluaciones individuales del cuestionario de apreciación estudiantil \r25%',40),(9,3,2,'Programas académicos evaluados','Programas Académicos Evaluados','Porcentaje de   programas académicos con evaluación favorable en los últimos 4 años ',100),(10,4,2,'Capacidad de atención alumnos en relación a talleres y laboratorios','Capacidad de atención alumnos en relación a talleres y laboratorios','Capacidad de atención a alumnos por talleres y laboratorios por unidad académica y semestre\rSuma de Capacidad instalada de atención en laboratorios y talleres por el total de semestres, identificando la capacidad del taller o laboratotio con menor capacidad de cada semestre\r ',35),(11,4,2,'Aulas Equipadas','Aulas Equipadas','Aulas equipadas conforme al modelo ideal por unidad académica \r(Cañon, Internet, CPU, Pantalla, Pizarron, Butacas, Escritorio)\r',35),(12,4,2,'Laboratorios Equipado','Laboratorios Equipado','Laboratorios equipados conforme currícula por programa académico por unidad académica y año',30),(13,5,3,'Becas de Manutención ','Becas','Porcentaje de alumnos que cuentan con algun tipo de beca registrada en el SIBA por año por unidad académca ',100),(14,6,3,'Alumnos Tutorados','Alumnos Tutorados','Porcentaje de alumnos tutorados por periodo semestral y  programa académico ',100),(15,7,3,'Bibliotecas','Títulos Actualizados','Porcentaje de alumnos tutorados por periodo semestral y  programa académico ',17.5),(16,7,3,'Bibliotecas ','Número de libros por alumno','Total de ejemplares por programa académico 50%',17.5),(17,7,3,'Equipo de cómputo','Cobertura de Acceso a Internet ','Capacidad instalada de acceso a internet en la unidad académica',30),(18,7,3,'Mantenimiento y limpieza','Cumplimiento del programa de mantenimiento','Porcentaje de cumpliemito del programa de mantenimiento 50%',17.5),(19,7,3,'Mantenimiento y limpieza','Cumplimiento del programa de limpieza','Porcentaje de cumpliemito del programa de limpieza 50%',17.5),(20,8,4,'Alumnos Inscritos Participando en Servicio Social','Alumnos Inscritos Participando en Servicio Social','Número de alumnos inscritos en alguno de los programas de servicio social por unidad académica ',100),(21,9,4,'Alumnos en Visitas Escolares','Porcentaje de Alumnos en Visitas Escolares','Número de alumnos  realizando visitas escolares por unidad académica por semestre',100),(22,10,4,'Proyectos Vinculados','Proyectos Vinculados','Número de proyectos vinculados por unidad académica',100),(23,11,5,'Profesores de carrera que están involucrados en investigaciones','Profesores de carrera realizando investigación','Profesores contratados con dictamén de carrera (1/2, 3/4 y T.Completo) que participan en Proyectos de Investigación avalados por la SIP ',100),(24,12,5,'Profesores que presentan trabajos en eventos de investigación con la participación de alumnos','Profesores que presentan trabajos en eventos de investigación con la participación de alumnos','Profesores que presentan trabajos en congresos, coloquios, siposiums, entre otros con la participación de alumnos como coautores',100),(25,13,5,'Innovaciones Educativas','Innovaciones Educativas','Tasa de variación del  número de Innovaciones educativas identificadas, incubadas o escaladas por unidad académica 50%',50),(26,13,5,'Investigaciones Educativas de impacto en el aula','Investigaciones Educativas de impacto en el aula','Tasa de variación del número de investigaciones educativas publicadas con impacto en el aula por unidad académica y por año',50),(27,14,6,'Inversión de los recursos autogenerados','% de  Recursos autogenerados dedicados al  mantenimiento del inmueble y mantenimiento del equipo','Monto de los recursos netos autogenerados que se destinan al pago de Servicios de mantenimiento del inmueble y mantenimiento del equipo ',100);
/*!40000 ALTER TABLE `Indicador3` ENABLE KEYS */;
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
  PRIMARY KEY (`idInfraestructura`,`idEvaluacion`),
  KEY `fk_Infraestructura_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_Infraestructura_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Infraestructura`
--

LOCK TABLES `Infraestructura` WRITE;
/*!40000 ALTER TABLE `Infraestructura` DISABLE KEYS */;
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
  `InvestigacionesPublicadas` int(11) DEFAULT '0',
  `InvestigacionesPublicadasAnt` int(11) DEFAULT '0',
  PRIMARY KEY (`idInnovacionEducativa`,`idEvaluacion`),
  KEY `fk_InnovacionEducativa_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_InnovacionEducativa_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InnovacionEducativa`
--

LOCK TABLES `InnovacionEducativa` WRITE;
/*!40000 ALTER TABLE `InnovacionEducativa` DISABLE KEYS */;
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
  PRIMARY KEY (`idInvestigacionDocencia`,`idEvaluacion`),
  KEY `fk_InvestigacionDocencia_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_InvestigacionDocencia_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InvestigacionDocencia`
--

LOCK TABLES `InvestigacionDocencia` WRITE;
/*!40000 ALTER TABLE `InvestigacionDocencia` DISABLE KEYS */;
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
  PRIMARY KEY (`idProgramasAcademicos`,`idEvaluacion`),
  KEY `fk_ProgramasAcademicos_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_ProgramasAcademicos_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProgramasAcademicos`
--

LOCK TABLES `ProgramasAcademicos` WRITE;
/*!40000 ALTER TABLE `ProgramasAcademicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ProgramasAcademicos` ENABLE KEYS */;
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
  PRIMARY KEY (`idProyectosVinculados`,`idEvaluacion`),
  KEY `fk_ProyectosVinculados_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_ProyectosVinculados_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProyectosVinculados`
--

LOCK TABLES `ProyectosVinculados` WRITE;
/*!40000 ALTER TABLE `ProyectosVinculados` DISABLE KEYS */;
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
  PRIMARY KEY (`idRecursosAutogenerados`,`idEvaluacion`),
  KEY `fk_RecursosAutogenerados_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_RecursosAutogenerados_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RecursosAutogenerados`
--

LOCK TABLES `RecursosAutogenerados` WRITE;
/*!40000 ALTER TABLE `RecursosAutogenerados` DISABLE KEYS */;
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
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`idRoles`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Roles`
--

LOCK TABLES `Roles` WRITE;
/*!40000 ALTER TABLE `Roles` DISABLE KEYS */;
INSERT INTO `Roles` VALUES (1,'Admin','');
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
  PRIMARY KEY (`idServicioSocial`,`idEvaluacion`),
  KEY `fk_ServicioSocial_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_ServicioSocial_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ServicioSocial`
--

LOCK TABLES `ServicioSocial` WRITE;
/*!40000 ALTER TABLE `ServicioSocial` DISABLE KEYS */;
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
  PRIMARY KEY (`idTutorias`,`idEvaluacion`),
  KEY `fk_Tutorias_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_Tutorias_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tutorias`
--

LOCK TABLES `Tutorias` WRITE;
/*!40000 ALTER TABLE `Tutorias` DISABLE KEYS */;
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
  `Nombre` varchar(200) NOT NULL,
  `Siglas` varchar(45) NOT NULL,
  `Extension` int(11) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idUnidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Unidad`
--

LOCK TABLES `Unidad` WRITE;
/*!40000 ALTER TABLE `Unidad` DISABLE KEYS */;
INSERT INTO `Unidad` VALUES (1,'Escuela Test','TEST',22,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES (1,1,1,'Admin','',NULL,'admin','21232f297a57a5a743894a0e4a801fc3','',NULL);
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
  PRIMARY KEY (`idVisitasEscolares`,`idEvaluacion`),
  KEY `fk_VisitasEscolares_Evaluacion1_idx` (`idEvaluacion`),
  CONSTRAINT `fk_VisitasEscolares_Evaluacion1` FOREIGN KEY (`idEvaluacion`) REFERENCES `Evaluacion` (`idEvaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VisitasEscolares`
--

LOCK TABLES `VisitasEscolares` WRITE;
/*!40000 ALTER TABLE `VisitasEscolares` DISABLE KEYS */;
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

-- Dump completed on 2016-03-27  4:56:39
