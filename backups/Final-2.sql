-- MySQL dump 10.13  Distrib 5.6.27, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: SIDOP
-- ------------------------------------------------------
-- Server version	5.6.27-0ubuntu0.15.04.1

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
-- Table structure for table `tb_Carrera`
--

DROP TABLE IF EXISTS `tb_Carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Carrera` (
  `id_carrera` varchar(8) NOT NULL,
  `nombre_carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Carrera`
--

LOCK TABLES `tb_Carrera` WRITE;
/*!40000 ALTER TABLE `tb_Carrera` DISABLE KEYS */;
INSERT INTO `tb_Carrera` VALUES ('1','1'),('320208','EnseÃ±anza del InglÃ©s'),('330102','DirecciÃ³n de Empresas'),('330208','AdministraciÃ³n Aduanera y Comercio Exterior'),('420201','IngenierÃ­a ElÃ©ctrica'),('600002','InformÃ¡tica Empresarial'),('600502','InformÃ¡tica y TecnologÃ­a Multimedia');
/*!40000 ALTER TABLE `tb_Carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_Cursos`
--

DROP TABLE IF EXISTS `tb_Cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Cursos` (
  `sigla` varchar(10) NOT NULL,
  `nombre_curso` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `creditos` int(11) NOT NULL,
  `jornada` double NOT NULL,
  PRIMARY KEY (`sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Cursos`
--

LOCK TABLES `tb_Cursos` WRITE;
/*!40000 ALTER TABLE `tb_Cursos` DISABLE KEYS */;
INSERT INTO `tb_Cursos` VALUES ('1','1',0,0),('IE 2100','Fundamentos de ProgramaciÃ³n',4,1),('TM1100','IntroducciÃ³n a la informÃ¡tica y tecnologÃ­a multimedia',1,1);
/*!40000 ALTER TABLE `tb_Cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_Docente`
--

DROP TABLE IF EXISTS `tb_Docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Docente` (
  `cedula` varchar(25) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grado_academico` int(11) NOT NULL,
  `tipo_contrato` int(11) NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Docente`
--

LOCK TABLES `tb_Docente` WRITE;
/*!40000 ALTER TABLE `tb_Docente` DISABLE KEYS */;
INSERT INTO `tb_Docente` VALUES ('1','1','1',1,1),('123','MÃ³nica','MuÃ±oz RamÃ­rez',1,1),('12345','AarÃ³n','Galazarga Carrillo',0,1);
/*!40000 ALTER TABLE `tb_Docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_DocenteConPermiso`
--

DROP TABLE IF EXISTS `tb_DocenteConPermiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_DocenteConPermiso` (
  `cedula` varchar(25) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grado_academico` int(11) NOT NULL,
  `tipo_contrato` int(11) NOT NULL,
  `fk_presupuesto` int(11) NOT NULL,
  `jornada_docenteConPermiso` double DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `fk_presupuesto` (`fk_presupuesto`),
  CONSTRAINT `tb_DocenteConPermiso_ibfk_1` FOREIGN KEY (`fk_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_DocenteConPermiso`
--

LOCK TABLES `tb_DocenteConPermiso` WRITE;
/*!40000 ALTER TABLE `tb_DocenteConPermiso` DISABLE KEYS */;
INSERT INTO `tb_DocenteConPermiso` VALUES ('1','1','1',1,1,1,1);
/*!40000 ALTER TABLE `tb_DocenteConPermiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_Grupos`
--

DROP TABLE IF EXISTS `tb_Grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Grupos` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(3) NOT NULL,
  `num_grupo_doble` int(3) NOT NULL,
  `jornada` double NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`),
  KEY `fk_curso` (`fk_curso`),
  CONSTRAINT `tb_Grupos_ibfk_1` FOREIGN KEY (`fk_carrera`) REFERENCES `tb_Carrera` (`id_carrera`),
  CONSTRAINT `tb_Grupos_ibfk_2` FOREIGN KEY (`fk_curso`) REFERENCES `tb_Cursos` (`sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Grupos`
--

LOCK TABLES `tb_Grupos` WRITE;
/*!40000 ALTER TABLE `tb_Grupos` DISABLE KEYS */;
INSERT INTO `tb_Grupos` VALUES ('1','1',0,0,0);
/*!40000 ALTER TABLE `tb_Grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_GruposDocentes`
--

DROP TABLE IF EXISTS `tb_GruposDocentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_GruposDocentes` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(3) NOT NULL,
  `fk_docente` varchar(25) NOT NULL,
  `tiempo_individual` double NOT NULL,
  `fk_presupuesto` int(11) NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`fk_docente`),
  KEY `fk_presupuesto` (`fk_presupuesto`),
  CONSTRAINT `tb_GruposDocentes_ibfk_1` FOREIGN KEY (`fk_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_GruposDocentes`
--

LOCK TABLES `tb_GruposDocentes` WRITE;
/*!40000 ALTER TABLE `tb_GruposDocentes` DISABLE KEYS */;
INSERT INTO `tb_GruposDocentes` VALUES ('1','1',0,'1',0,1);
/*!40000 ALTER TABLE `tb_GruposDocentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_GruposHorarios`
--

DROP TABLE IF EXISTS `tb_GruposHorarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_GruposHorarios` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(3) NOT NULL,
  `dia_semana` int(1) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`dia_semana`,`hora_inicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_GruposHorarios`
--

LOCK TABLES `tb_GruposHorarios` WRITE;
/*!40000 ALTER TABLE `tb_GruposHorarios` DISABLE KEYS */;
INSERT INTO `tb_GruposHorarios` VALUES ('1','1',0,0,'00:00:00','00:00:00');
/*!40000 ALTER TABLE `tb_GruposHorarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_Log`
--

DROP TABLE IF EXISTS `tb_Log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Log` (
  `utc` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `dia` int(11) DEFAULT NULL,
  `hora` int(11) NOT NULL,
  `minuto` int(11) NOT NULL,
  `segundo` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `navegador` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(80) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `apellido_usuario` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Log`
--

LOCK TABLES `tb_Log` WRITE;
/*!40000 ALTER TABLE `tb_Log` DISABLE KEYS */;
INSERT INTO `tb_Log` VALUES (1449526992,2015,12,7,16,23,12,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449528023,2015,12,7,16,40,23,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449528118,2015,12,7,16,41,58,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449536032,2015,12,7,18,53,52,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449538674,2015,12,7,19,37,54,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449542785,2015,12,7,20,46,25,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449542795,2015,12,7,20,46,35,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449542817,2015,12,7,20,46,57,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449545136,2015,12,7,21,25,36,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449547771,2015,12,7,22,9,31,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449547968,2015,12,7,22,12,48,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','usuario-docencia','202cb962ac59075b964b07152d234b70','Gerardo','Chinchilla'),(1449548040,2015,12,7,22,14,0,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449548079,2015,12,7,22,14,39,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','usuario-docencia','202cb962ac59075b964b07152d234b70','Gerardo','Chinchilla'),(1449549928,2015,12,7,22,45,28,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449550073,2015,12,7,22,47,53,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','usuario-docencia','202cb962ac59075b964b07152d234b70','Gerardo','Chinchilla'),(1449550595,2015,12,7,22,56,35,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449550620,2015,12,7,22,57,0,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','usuario-recursos-h','202cb962ac59075b964b07152d234b70','Ana','Yansy'),(1449550633,2015,12,7,22,57,13,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449550732,2015,12,7,22,58,52,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','usuario-recursos-h','202cb962ac59075b964b07152d234b70','Ana','Yansy'),(1449551303,2015,12,7,23,8,23,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','usuario-docencia','202cb962ac59075b964b07152d234b70','Gerardo','Chinchilla'),(1449551334,2015,12,7,23,8,54,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','usuario-recursos-h','202cb962ac59075b964b07152d234b70','Ana','Yansy'),(1449551765,2015,12,7,23,16,5,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449558117,2015,12,8,1,1,57,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado '),(1449574047,2015,12,8,5,27,27,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado ');
/*!40000 ALTER TABLE `tb_Log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_Mensaje`
--

DROP TABLE IF EXISTS `tb_Mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Mensaje` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `emisor` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `receptor` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contenido_mensaje` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Mensaje`
--

LOCK TABLES `tb_Mensaje` WRITE;
/*!40000 ALTER TABLE `tb_Mensaje` DISABLE KEYS */;
INSERT INTO `tb_Mensaje` VALUES (13,'Gerardo Chinchilla','vinird','Ya se agregaron todos los grupos, se necesita que se efectuÃ© la revisiÃ³n.','2015-12-07 22:43:23'),(14,'Michael RodrÃ­guez D','usuario-docencia','Ya se efectuÃ³ la revisiÃ³n.','2015-12-07 22:47:42'),(15,'Michael RodrÃ­guez D','usuario-recursos-h','Se envÃ­a la propuesta para asignaciÃ³n de presupuesto.','2015-12-07 22:58:34'),(16,'Ana Yansy','vinird','Se asignaron todos los presupuestos.','2015-12-07 23:15:46');
/*!40000 ALTER TABLE `tb_Mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_PlanEstudios`
--

DROP TABLE IF EXISTS `tb_PlanEstudios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_PlanEstudios` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  KEY `fk_curso` (`fk_curso`),
  KEY `fk_tb_PlanEstudios_1_idx` (`fk_carrera`),
  CONSTRAINT `tb_PlanEstudios_ibfk_1` FOREIGN KEY (`fk_carrera`) REFERENCES `tb_Carrera` (`id_carrera`),
  CONSTRAINT `tb_PlanEstudios_ibfk_2` FOREIGN KEY (`fk_curso`) REFERENCES `tb_Cursos` (`sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_PlanEstudios`
--

LOCK TABLES `tb_PlanEstudios` WRITE;
/*!40000 ALTER TABLE `tb_PlanEstudios` DISABLE KEYS */;
INSERT INTO `tb_PlanEstudios` VALUES ('600502','TM1100'),('600002','IE 2100');
/*!40000 ALTER TABLE `tb_PlanEstudios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_Presupuesto`
--

DROP TABLE IF EXISTS `tb_Presupuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Presupuesto` (
  `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_presupuesto` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo_presupuesto` double NOT NULL,
  `tiempo_sobrante` double NOT NULL,
  PRIMARY KEY (`id_presupuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Presupuesto`
--

LOCK TABLES `tb_Presupuesto` WRITE;
/*!40000 ALTER TABLE `tb_Presupuesto` DISABLE KEYS */;
INSERT INTO `tb_Presupuesto` VALUES (1,'1','1',1,1);
/*!40000 ALTER TABLE `tb_Presupuesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_PresupuestoDocente`
--

DROP TABLE IF EXISTS `tb_PresupuestoDocente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_PresupuestoDocente` (
  `fk_id_presupuesto` int(11) NOT NULL,
  `fk_docente` varchar(25) NOT NULL,
  `jornada` double NOT NULL,
  `fk_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`fk_proyecto`),
  KEY `fk_id_presupuesto` (`fk_id_presupuesto`),
  KEY `fk_docente` (`fk_docente`),
  KEY `fk_proyecto` (`fk_proyecto`),
  CONSTRAINT `tb_PresupuestoDocente_ibfk_1` FOREIGN KEY (`fk_docente`) REFERENCES `tb_Docente` (`cedula`),
  CONSTRAINT `tb_PresupuestoDocente_ibfk_2` FOREIGN KEY (`fk_id_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`),
  CONSTRAINT `tb_PresupuestoDocente_ibfk_3` FOREIGN KEY (`fk_proyecto`) REFERENCES `tb_Proyectos` (`id_proyecto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_PresupuestoDocente`
--

LOCK TABLES `tb_PresupuestoDocente` WRITE;
/*!40000 ALTER TABLE `tb_PresupuestoDocente` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_PresupuestoDocente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_Proyectos`
--

DROP TABLE IF EXISTS `tb_Proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` varchar(100) NOT NULL,
  `tipo_proyecto` int(11) NOT NULL,
  `jornada_proyecto` double NOT NULL,
  `fk_encargado` varchar(25) NOT NULL,
  `fk_ayudante` varchar(25) NOT NULL,
  PRIMARY KEY (`id_proyecto`),
  KEY `fk_encargado` (`fk_encargado`),
  KEY `fk_ayudante` (`fk_ayudante`),
  CONSTRAINT `tb_Proyectos_ibfk_1` FOREIGN KEY (`fk_encargado`) REFERENCES `tb_Docente` (`cedula`),
  CONSTRAINT `tb_Proyectos_ibfk_2` FOREIGN KEY (`fk_ayudante`) REFERENCES `tb_Docente` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Proyectos`
--

LOCK TABLES `tb_Proyectos` WRITE;
/*!40000 ALTER TABLE `tb_Proyectos` DISABLE KEYS */;
INSERT INTO `tb_Proyectos` VALUES (1,'1',1,1,'1','1');
/*!40000 ALTER TABLE `tb_Proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_RegistroActividad`
--

DROP TABLE IF EXISTS `tb_RegistroActividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_RegistroActividad` (
  `utc` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`utc`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `tb_RegistroActividad_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_Usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_RegistroActividad`
--

LOCK TABLES `tb_RegistroActividad` WRITE;
/*!40000 ALTER TABLE `tb_RegistroActividad` DISABLE KEYS */;
INSERT INTO `tb_RegistroActividad` VALUES (1449528127,'2015-12-07 16:42:07','vinird','Se habilitÃ³ al usuario: usuario-docencia'),(1449528136,'2015-12-07 16:42:16','vinird','Se habilitÃ³ al usuario: usuario-docencia'),(1449528353,'2015-12-07 16:45:53','vinird','Se habilitÃ³ al usuario: usuario-docencia'),(1449528361,'2015-12-07 16:46:01','vinird','Se deshabilitÃ³ al usuario: usuario-docencia'),(1449528393,'2015-12-07 16:46:33','vinird','Se modificÃ³ al usuario: usuario-docencia'),(1449528468,'2015-12-07 16:47:48','vinird','Se modificÃ³ al usuario: usuario-docencia'),(1449529016,'2015-12-07 16:56:56','vinird','Se agregÃ³ el curso tm11 prueba'),(1449529624,'2015-12-07 17:07:04','vinird','Se eliminÃ³ el curso tm11'),(1449529656,'2015-12-07 17:07:36','vinird','Se agregÃ³ el curso TM100 P1'),(1449529978,'2015-12-07 17:12:58','vinird','Se modificÃ³ el curso  '),(1449530298,'2015-12-07 17:18:18','vinird','Se modificÃ³ el curso TM100 P1'),(1449530311,'2015-12-07 17:18:31','vinird','Se agregÃ³ el curso ttt we'),(1449530321,'2015-12-07 17:18:41','vinird','Se modificÃ³ el curso ttt weee'),(1449530334,'2015-12-07 17:18:54','vinird','Se modificÃ³ el curso ttt weee'),(1449530352,'2015-12-07 17:19:12','vinird','Se eliminÃ³ el curso ttt'),(1449530382,'2015-12-07 17:19:42','vinird','Se agregÃ³ el curso qw qw'),(1449530595,'2015-12-07 17:23:15','vinird','Se modificÃ³ el curso TM100 P1'),(1449530658,'2015-12-07 17:24:18','vinird','Se eliminÃ³ el curso qw'),(1449530819,'2015-12-07 17:26:59','vinird','Se agregÃ³ el curso as wqe'),(1449530826,'2015-12-07 17:27:06','vinird','Se eliminÃ³ el curso as'),(1449532719,'2015-12-07 17:58:39','vinird','Se agregÃ³ el grupo: TM100 - G2'),(1449539052,'2015-12-07 19:44:12','vinird','Se agregÃ³ el grupo: TM100 - G1'),(1449539091,'2015-12-07 19:44:51','vinird','Se agregÃ³ el presupuesto: PO regular con 2 tiempos.'),(1449539096,'2015-12-07 19:44:56','vinird','Se agrego el presupuesto PO regular al grupo: TM100 - G1'),(1449540898,'2015-12-07 20:14:58','vinird','Se quitÃ³ del presupuesto PO regular el grupo: TM100 - G1'),(1449540917,'2015-12-07 20:15:17','vinird','Se eliminÃ³ el grupo: TM100 - G1'),(1449541067,'2015-12-07 20:17:47','vinird','Se agregÃ³ el grupo: TM100 - G1'),(1449541085,'2015-12-07 20:18:05','vinird','Se agrego el presupuesto PO regular al grupo: TM100 - G1'),(1449541155,'2015-12-07 20:19:15','vinird','Se agregÃ³ el grupo: TM100 - G2 y G51'),(1449541167,'2015-12-07 20:19:27','vinird','Se agrego el presupuesto PO regular al grupo: TM100 - G2 y G51'),(1449543785,'2015-12-07 21:03:05','vinird','Se agregÃ³ el curso: 12222 122'),(1449543958,'2015-12-07 21:05:58','vinird','Se eliminÃ³ el curso: 12222'),(1449543975,'2015-12-07 21:06:15','vinird','Se agregÃ³ el curso: wqw qww'),(1449544160,'2015-12-07 21:09:20','vinird','Se agregÃ³ el curso: QW WQ'),(1449544175,'2015-12-07 21:09:35','vinird','Se eliminÃ³ el curso: QW'),(1449544182,'2015-12-07 21:09:42','vinird','Se eliminÃ³ el curso: wqw'),(1449544205,'2015-12-07 21:10:05','vinird','Se agregÃ³ el curso: sss ss'),(1449544217,'2015-12-07 21:10:17','vinird','Se eliminÃ³ el curso: sss'),(1449547825,'2015-12-07 22:10:25','vinird','Se quitÃ³ del presupuesto PO regular el grupo: TM100 - G1'),(1449547833,'2015-12-07 22:10:33','vinird','Se quitÃ³ del presupuesto PO regular el grupo: TM100 - G2 y G51'),(1449547869,'2015-12-07 22:11:09','vinird','Se eliminÃ³ el grupo: TM100 - G1'),(1449547880,'2015-12-07 22:11:20','vinird','Se eliminÃ³ el grupo: TM100 - G2 y G51'),(1449547914,'2015-12-07 22:11:54','vinird','Se eliminÃ³ el curso: TM100'),(1449547935,'2015-12-07 22:12:15','vinird','Se eliminÃ³ el docente con la cÃ©dula: e'),(1449547950,'2015-12-07 22:12:30','vinird','Se habilitÃ³ al usuario: usuario-docencia'),(1449548050,'2015-12-07 22:14:10','vinird','Se eliminÃ³ el presupuesto PO regular.'),(1449548131,'2015-12-07 22:15:31','usuario-docencia','Se agregÃ³ el docente 09876543 Pedrito Fernandes Sequeira'),(1449548149,'2015-12-07 22:15:49','usuario-docencia','Se eliminÃ³ el docente con la cÃ©dula: ee'),(1449548156,'2015-12-07 22:15:56','usuario-docencia','Se eliminÃ³ el docente con la cÃ©dula: r'),(1449548245,'2015-12-07 22:17:25','usuario-docencia','Se agregÃ³ el curso: TM1100 IntroducciÃ³n a la informÃ¡tica y tecnologÃ­a multimedia'),(1449548296,'2015-12-07 22:18:16','usuario-docencia','Se agregÃ³ el curso: IE 2100 Fundamentos de ProgramaciÃ³n'),(1449548329,'2015-12-07 22:18:49','usuario-docencia','Se agregÃ³ el proyecto: Sociedad'),(1449548362,'2015-12-07 22:19:22','usuario-docencia','Se agregÃ³ el proyecto: Cultural'),(1449548434,'2015-12-07 22:20:34','usuario-docencia','Se agregÃ³ el proyecto: Natural'),(1449548632,'2015-12-07 22:23:52','usuario-docencia','Se agregÃ³ el grupo: TM1100 - G1'),(1449549263,'2015-12-07 22:34:23','usuario-docencia','Se agregÃ³ el grupo: IE 2100 - G1 y G51'),(1449549947,'2015-12-07 22:45:47','vinird','Se habilitÃ³ al usuario: usuario-recursos-hum'),(1449550604,'2015-12-07 22:56:44','vinird','Se habilitÃ³ al usuario: usuario-recursos-h'),(1449550953,'2015-12-07 23:02:33','usuario-recursos-h','Se agregÃ³ el presupuesto: PO regular con 10 tiempos.'),(1449551004,'2015-12-07 23:03:24','usuario-recursos-h','Se agrego el presupuesto PO regular al grupo: IE 2100 - G1 y G51'),(1449551073,'2015-12-07 23:04:33','usuario-recursos-h','Se agrego el presupuesto PO regular al grupo: TM1100 - G1'),(1449551150,'2015-12-07 23:05:50','usuario-recursos-h','Se ha asignado un presupuesto a un proyecto: '),(1449551177,'2015-12-07 23:06:17','usuario-recursos-h','Se ha asignado un presupuesto a un proyecto: '),(1449551542,'2015-12-07 23:12:22','usuario-recursos-h','Se eliminÃ³ el proyecto id: 16'),(1449551697,'2015-12-07 23:14:57','usuario-recursos-h','Se agregÃ³ el docente cÃ©dula 090687, nombre Malva Amarilla, asignado al presupuesto PO regular con 0.5 tiempos.'),(1449574052,'2015-12-08 05:27:32','vinird','Se quitÃ³ del presupuesto PO regular el grupo: TM1100 - G1'),(1449574400,'2015-12-08 05:33:20','vinird','Se eliminÃ³ el grupo: TM1100 - G1'),(1449574416,'2015-12-08 05:33:36','vinird','Se eliminÃ³ el grupo: IE - G2100 y G1'),(1449574436,'2015-12-08 05:33:56','vinird','Se eliminÃ³ el grupo: IE - G2100 y G1'),(1449574696,'2015-12-08 05:38:16','vinird','Se agregÃ³ el grupo: TM1100 - G1'),(1449574717,'2015-12-08 05:38:37','vinird','Se agrego el presupuesto PO regular al grupo: TM1100 - G1'),(1449574742,'2015-12-08 05:39:02','vinird','Se quitÃ³ del presupuesto PO regular el grupo: TM1100 - G1'),(1449576197,'2015-12-08 06:03:17','vinird','Se agregÃ³ el presupuesto: P3 extra con 8 tiempos.'),(1449576276,'2015-12-08 06:04:36','vinird','Se agregÃ³ el proyecto: tr'),(1449576285,'2015-12-08 06:04:45','vinird','Se ha asignado un presupuesto a un proyecto: '),(1449576317,'2015-12-08 06:05:17','vinird','Se eliminÃ³ el presupuesto PO regular del proyecto'),(1449576345,'2015-12-08 06:05:45','vinird','Se eliminÃ³ el proyecto id: 19'),(1449576373,'2015-12-08 06:06:13','vinird','Se agregÃ³ el proyecto: oo'),(1449576461,'2015-12-08 06:07:41','vinird','Se eliminÃ³ el presupuesto PO regular del proyecto'),(1449576508,'2015-12-08 06:08:28','vinird','Se ha asignado un presupuesto a un proyecto: '),(1449576947,'2015-12-08 06:15:47','vinird','Se eliminÃ³ el presupuesto PO regular del proyecto'),(1449576979,'2015-12-08 06:16:19','vinird','Se eliminÃ³ el presupuesto P3 extra del proyecto'),(1449577006,'2015-12-08 06:16:46','vinird','Se eliminÃ³ el docente con la cÃ©dula 234532, nombre Carlos Ugalde, y se eliminÃ³ 0.5 tiempos del presupuesto PO regular.'),(1449577017,'2015-12-08 06:16:57','vinird','Se eliminÃ³ el docente con la cÃ©dula Maria, nombre Malva Rodriguez, y se eliminÃ³ 1 tiempos del presupuesto PO regular.'),(1449577156,'2015-12-08 06:19:16','vinird','Se agrego el presupuesto PO regular al grupo: TM1100 - G1'),(1449577173,'2015-12-08 06:19:33','vinird','Se quitÃ³ del presupuesto PO regular el grupo: TM1100 - G1'),(1449577191,'2015-12-08 06:19:51','vinird','Se eliminÃ³ el grupo: TM1100 - G1'),(1449577286,'2015-12-08 06:21:26','vinird','Se agregÃ³ el curso: IG 1100 Integrado l'),(1449577353,'2015-12-08 06:22:33','vinird','Se eliminÃ³ el curso: IG 1100'),(1449577378,'2015-12-08 06:22:58','vinird','Se agregÃ³ el curso: IG 1100 Integrado l'),(1449577640,'2015-12-08 06:27:20','vinird','Se modificÃ³ el curso: TM1100 IntroducciÃ³n a la informÃ¡tica y tecnologÃ­a multimedia'),(1449577657,'2015-12-08 06:27:37','vinird','Se modificÃ³ el curso: IG Integrado l'),(1449577693,'2015-12-08 06:28:13','vinird','Se modificÃ³ el curso: TM1100 IntroducciÃ³n a la informÃ¡tica y tecnologÃ­a multimedia'),(1449577706,'2015-12-08 06:28:26','vinird','Se modificÃ³ el curso: TM1100 IntroducciÃ³n a la informÃ¡tica y tecnologÃ­a multimedia'),(1449577720,'2015-12-08 06:28:40','vinird','Se modificÃ³ el curso: IG Integrado l'),(1449577742,'2015-12-08 06:29:02','vinird','Se eliminÃ³ el curso: IG 1100'),(1449577758,'2015-12-08 06:29:18','vinird','Se modificÃ³ el curso: TM1100 IntroducciÃ³n a la informÃ¡tica y tecnologÃ­a multimedia'),(1449577788,'2015-12-08 06:29:48','vinird','Se agregÃ³ el curso: por qwe'),(1449577800,'2015-12-08 06:30:00','vinird','Se modificÃ³ el curso: por qwe'),(1449577822,'2015-12-08 06:30:22','vinird','Se eliminÃ³ el curso: por'),(1449577835,'2015-12-08 06:30:35','vinird','Se eliminÃ³ el presupuesto PO regular.'),(1449577850,'2015-12-08 06:30:50','vinird','Se eliminÃ³ el presupuesto P3 extra.'),(1449578118,'2015-12-08 06:35:18','vinird','Se agregÃ³ el presupuesto: PO regular con 2 tiempos.'),(1449578161,'2015-12-08 06:36:01','vinird','Se ha asignado un presupuesto a un proyecto: '),(1449578173,'2015-12-08 06:36:13','vinird','Se modificÃ³ el presupuesto: PO'),(1449578195,'2015-12-08 06:36:35','vinird','Se eliminÃ³ el presupuesto PO del proyecto'),(1449578202,'2015-12-08 06:36:42','vinird','Se eliminÃ³ el presupuesto PO.'),(1449578236,'2015-12-08 06:37:16','vinird','Se eliminÃ³ el proyecto id: 20'),(1449578308,'2015-12-08 06:38:28','vinird','Se eliminÃ³ el docente con la cÃ©dula: 1234'),(1449578439,'2015-12-08 06:40:39','vinird','Se eliminÃ³ el proyecto id: 17'),(1449578447,'2015-12-08 06:40:47','vinird','Se eliminÃ³ el proyecto id: 18'),(1449578455,'2015-12-08 06:40:55','vinird','Se eliminÃ³ el docente con la cÃ©dula: 09876543');
/*!40000 ALTER TABLE `tb_RegistroActividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_Usuario`
--

DROP TABLE IF EXISTS `tb_Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_Usuario` (
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(80) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `apellido_usuario` varchar(40) NOT NULL,
  `perfil` int(1) NOT NULL,
  `correo_usuario` varchar(40) NOT NULL,
  `habilitado` int(1) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Usuario`
--

LOCK TABLES `tb_Usuario` WRITE;
/*!40000 ALTER TABLE `tb_Usuario` DISABLE KEYS */;
INSERT INTO `tb_Usuario` VALUES ('admin','1db095afdcca96ed2ca147862ca948fe','Administrador','del SIstema',0,'-',1),('usuario-docencia','202cb962ac59075b964b07152d234b70','Gerardo','Chinchilla',1,'ejemplo@1.com',1),('usuario-recursos-h','202cb962ac59075b964b07152d234b70','Ana','Yansy',2,'ejemplo@3.com',1),('vinird','202cb962ac59075b964b07152d234b70','Michael','RodrÃ­guez Delgado ',0,'mvrd_17@hotmail.com',1);
/*!40000 ALTER TABLE `tb_Usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estadoDatos`
--

DROP TABLE IF EXISTS `tb_estadoDatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_estadoDatos` (
  `id_estadoDatos` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `revisiones` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  PRIMARY KEY (`id_estadoDatos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estadoDatos`
--

LOCK TABLES `tb_estadoDatos` WRITE;
/*!40000 ALTER TABLE `tb_estadoDatos` DISABLE KEYS */;
INSERT INTO `tb_estadoDatos` VALUES (0,0,1,0);
/*!40000 ALTER TABLE `tb_estadoDatos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-08  6:42:53
