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
  `id_Carrera` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_Carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_Carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Carrera`
--

LOCK TABLES `tb_Carrera` WRITE;
/*!40000 ALTER TABLE `tb_Carrera` DISABLE KEYS */;
INSERT INTO `tb_Carrera` VALUES ('001','Informatica y Tecnologia Multimedia'),('002','Informatica empresarial'),('003','Direccion de empresas');
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
  `nombre_curso` varchar(100) NOT NULL,
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
INSERT INTO `tb_Cursos` VALUES ('1','1',0,0),('TM1100','Introducción a la Informática y Tecnología Multimedia',4,0.5),('TM4100','Desarrollo de aplicaciones interactivas',3,0.75),('TM4200','Diseño Gráfico para Multimedia',2,0.75),('TM4400','Imagen en Movimiento',2,0.75);
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
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
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
INSERT INTO `tb_Docente` VALUES ('1','1','1',1,1),('123','MÃ³nica','MuÃ±oz RamÃ­rez',1,1),('1234','Sergio','apellido',0,2),('12345','AarÃ³n','Galazarga Carrillo',0,1);
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
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
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
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Grupos`
--

LOCK TABLES `tb_Grupos` WRITE;
/*!40000 ALTER TABLE `tb_Grupos` DISABLE KEYS */;
INSERT INTO `tb_Grupos` VALUES ('002','TM1100',3,51,0.125);
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
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`fk_docente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_GruposDocentes`
--

LOCK TABLES `tb_GruposDocentes` WRITE;
/*!40000 ALTER TABLE `tb_GruposDocentes` DISABLE KEYS */;
INSERT INTO `tb_GruposDocentes` VALUES ('0','0',0,'0',0,0);
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
INSERT INTO `tb_GruposHorarios` VALUES ('002','TM1100',3,0,'07:00:00','07:00:00'),('002','TM1100',51,0,'07:00:00','07:00:00');
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
INSERT INTO `tb_Log` VALUES (1449510064,2015,12,7,11,41,4,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema');
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
  `emisor` varchar(20) NOT NULL,
  `receptor` varchar(20) NOT NULL,
  `contenido_mensaje` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_mensaje`),
  KEY `emisor` (`emisor`),
  KEY `receptor` (`receptor`),
  CONSTRAINT `tb_Mensaje_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `tb_Usuario` (`usuario`),
  CONSTRAINT `tb_Mensaje_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `tb_Usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Mensaje`
--

LOCK TABLES `tb_Mensaje` WRITE;
/*!40000 ALTER TABLE `tb_Mensaje` DISABLE KEYS */;
INSERT INTO `tb_Mensaje` VALUES (1,'admin','admin','.','2015-12-01 00:00:00');
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
  `fk_curso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_PlanEstudios`
--

LOCK TABLES `tb_PlanEstudios` WRITE;
/*!40000 ALTER TABLE `tb_PlanEstudios` DISABLE KEYS */;
INSERT INTO `tb_PlanEstudios` VALUES ('001','TM1100'),('002','TM4200'),('001','TM4400'),('002','TM1100'),('001','TM4100');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Presupuesto`
--

LOCK TABLES `tb_Presupuesto` WRITE;
/*!40000 ALTER TABLE `tb_Presupuesto` DISABLE KEYS */;
INSERT INTO `tb_Presupuesto` VALUES (1,'1','1',1,1),(2,'Prueba','123456',1,0.25);
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
INSERT INTO `tb_PresupuestoDocente` VALUES (2,'123',0.25,15);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Proyectos`
--

LOCK TABLES `tb_Proyectos` WRITE;
/*!40000 ALTER TABLE `tb_Proyectos` DISABLE KEYS */;
INSERT INTO `tb_Proyectos` VALUES (1,'1',1,1,'1','1'),(11,'Pueblo',1,0,'1234','1234'),(12,'Arqueologia',1,0,'123','123'),(15,'ee',0,0.25,'123','123');
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
INSERT INTO `tb_RegistroActividad` VALUES (1449266939,'2015-12-04 16:08:59','admin','Se modificÃ³ el grupo: '),(1449276571,'2015-12-04 18:49:31','francisco','Se eliminÃ³ el grupo: '),(1449276648,'2015-12-04 18:50:48','francisco','Se agregÃ³ el grupo: TM4100 - 1'),(1449276876,'2015-12-04 18:54:36','francisco','Se eliminÃ³ el grupo: '),(1449276941,'2015-12-04 18:55:41','francisco','Se agregÃ³ el grupo: TM4100 - 1'),(1449277095,'2015-12-04 18:58:15','francisco','Se eliminÃ³ el grupo: '),(1449277194,'2015-12-04 18:59:54','francisco','Se agregÃ³ el grupo: TM4100 - 1'),(1449279484,'2015-12-04 19:38:04','francisco','Se agregÃ³ el grupo: TM4100 - 2'),(1449280639,'2015-12-04 19:57:19','francisco','Se agregÃ³ el grupo: TM4100 - 3'),(1449291047,'2015-12-04 22:50:47','admin','Se agregÃ³ el grupo: TM1100 - 4'),(1449297877,'2015-12-05 00:44:37','admin','Se eliminÃ³ el grupo: '),(1449298148,'2015-12-05 00:49:08','admin','Se eliminÃ³ el grupo: '),(1449298217,'2015-12-05 00:50:17','admin','Se modificÃ³ el grupo: '),(1449298282,'2015-12-05 00:51:22','admin','Se modificÃ³ el grupo: '),(1449298850,'2015-12-05 01:00:50','admin','Se modificÃ³ el grupo: '),(1449298952,'2015-12-05 01:02:32','admin','Se eliminÃ³ el grupo: '),(1449342179,'2015-12-05 13:02:59','francisco','Se agregÃ³ el grupo: TM4200 - 1'),(1449342209,'2015-12-05 13:03:29','francisco','Se modificÃ³ el grupo: '),(1449342245,'2015-12-05 13:04:05','francisco','Se eliminÃ³ el grupo: '),(1449342359,'2015-12-05 13:05:59','francisco','Se agregÃ³ el grupo: 0 - 0'),(1449342489,'2015-12-05 13:08:09','francisco','Se eliminÃ³ el grupo: '),(1449345839,'2015-12-05 14:03:59','francisco','Se agregÃ³ el grupo: TM4400 - 1'),(1449345883,'2015-12-05 14:04:43','francisco','Se agregÃ³ el grupo: TM4100 - 1'),(1449345978,'2015-12-05 14:06:18','francisco','Se eliminÃ³ el grupo: '),(1449346851,'2015-12-05 14:20:51','francisco','Se agregÃ³ el grupo: TM4400 - 2'),(1449346896,'2015-12-05 14:21:36','francisco','Se agregÃ³ el grupo: TM4200 - 4'),(1449347162,'2015-12-05 14:26:02','francisco','Se agregÃ³ el grupo: TM1100 - 2'),(1449347186,'2015-12-05 14:26:26','francisco','Se agregÃ³ el grupo: TM1100 - 3'),(1449347570,'2015-12-05 14:32:50','francisco','Se agregÃ³ el grupo: TM1100 - 2'),(1449347599,'2015-12-05 14:33:19','francisco','Se eliminÃ³ el grupo: '),(1449353474,'2015-12-05 16:11:14','francisco','Se agregÃ³ el grupo: TM4400 - 2'),(1449353534,'2015-12-05 16:12:14','francisco','Se agregÃ³ el grupo: TM1100 - 2'),(1449353755,'2015-12-05 16:15:55','francisco','Se eliminÃ³ el grupo: '),(1449353765,'2015-12-05 16:16:05','francisco','Se eliminÃ³ el grupo: '),(1449353791,'2015-12-05 16:16:31','francisco','Se agregÃ³ el grupo: TM4400 - 2'),(1449353852,'2015-12-05 16:17:32','francisco','Se agregÃ³ el grupo: TM1100 - 1'),(1449353868,'2015-12-05 16:17:48','francisco','Se eliminÃ³ el grupo: '),(1449353878,'2015-12-05 16:17:58','francisco','Se eliminÃ³ el grupo: '),(1449353994,'2015-12-05 16:19:54','francisco','Se agregÃ³ el grupo: TM4100 - 3'),(1449354047,'2015-12-05 16:20:47','francisco','Se eliminÃ³ el grupo: '),(1449354090,'2015-12-05 16:21:30','francisco','Se agregÃ³ el grupo: TM4200 - 2'),(1449354134,'2015-12-05 16:22:14','francisco','Se agregÃ³ el grupo: TM4100 - 2'),(1449354166,'2015-12-05 16:22:46','francisco','Se agregÃ³ el grupo: TM1100 - 2'),(1449354772,'2015-12-05 16:32:52','francisco','Se agregÃ³ el grupo: TM1100 - 2'),(1449354824,'2015-12-05 16:33:44','francisco','Se agregÃ³ el grupo: TM1100 - 2'),(1449354905,'2015-12-05 16:35:05','francisco','Se agregÃ³ el grupo: TM4100 - 1'),(1449354989,'2015-12-05 16:36:29','francisco','Se agregÃ³ el grupo: TM4200 - 2'),(1449355021,'2015-12-05 16:37:01','francisco','Se eliminÃ³ el grupo: '),(1449355029,'2015-12-05 16:37:09','francisco','Se eliminÃ³ el grupo: '),(1449355043,'2015-12-05 16:37:23','francisco','Se eliminÃ³ el grupo: '),(1449355055,'2015-12-05 16:37:35','francisco','Se eliminÃ³ el grupo: '),(1449355090,'2015-12-05 16:38:10','francisco','Se modificÃ³ el grupo: '),(1449356771,'2015-12-05 17:06:11','francisco','Se eliminÃ³ el grupo: TM4100 - 7'),(1449356793,'2015-12-05 17:06:33','francisco','Se agregÃ³ el grupo: TM1100 - G2'),(1449356826,'2015-12-05 17:07:06','francisco','Se agregÃ³ el grupo: TM4100 - G7'),(1449356857,'2015-12-05 17:07:37','francisco','Se modificÃ³ el grupo: TM4100 - 7'),(1449356902,'2015-12-05 17:08:22','francisco','Se agregÃ³ el grupo: TM1100 - G5 y G52'),(1449356964,'2015-12-05 17:09:24','francisco','Se modificÃ³ el grupo: TM4100 - 7'),(1449357004,'2015-12-05 17:10:04','francisco','Se modificÃ³ el grupo: TM1100 - G5 y G0'),(1449357050,'2015-12-05 17:10:50','francisco','Se modificÃ³ el grupo: TM1100 - G5 y G0'),(1449357080,'2015-12-05 17:11:20','francisco','Se agregÃ³ el grupo: TM4200 - G8 y G58'),(1449357230,'2015-12-05 17:13:50','francisco','Se eliminÃ³ el grupo: TM4200 - 8'),(1449357242,'2015-12-05 17:14:02','francisco','Se eliminÃ³ el grupo: TM1100 - 2'),(1449357252,'2015-12-05 17:14:12','francisco','Se eliminÃ³ el grupo: TM4100 - 7'),(1449357468,'2015-12-05 17:17:48','francisco','Se agregÃ³ el grupo: TM1100 - G3'),(1449357509,'2015-12-05 17:18:29','francisco','Se modificÃ³ el grupo: TM1100 - G3'),(1449358383,'2015-12-05 17:33:03','francisco','Se eliminÃ³ el grupo: TM1100 - 3'),(1449358513,'2015-12-05 17:35:13','francisco','Se agregÃ³ el grupo: TM4400 - G2'),(1449358829,'2015-12-05 17:40:29','francisco','Se eliminÃ³ el grupo: TM1100 - G5'),(1449358951,'2015-12-05 17:42:31','francisco','Se agregÃ³ el grupo: TM4400 - G2 y G52'),(1449359012,'2015-12-05 17:43:32','francisco','Se agregÃ³ el grupo: TM4400 - G3 y G53'),(1449359029,'2015-12-05 17:43:49','francisco','Se eliminÃ³ el grupo: TM4400 - G3 y G0'),(1449359084,'2015-12-05 17:44:44','francisco','Se agregÃ³ el grupo: TM4400 - G5 y G52'),(1449359107,'2015-12-05 17:45:07','francisco','Se modificÃ³ el grupo: TM4400 - G5 y G52'),(1449359122,'2015-12-05 17:45:22','francisco','Se eliminÃ³ el grupo: TM4400 - G2'),(1449359131,'2015-12-05 17:45:31','francisco','Se eliminÃ³ el grupo: TM4400 - G5 y G52'),(1449359425,'2015-12-05 17:50:25','francisco','Se agregÃ³ el grupo: TM4400 - G4'),(1449359459,'2015-12-05 17:50:59','francisco','Se modificÃ³ el grupo: TM4400 - G4'),(1449376596,'2015-12-05 22:36:36','francisco','Se agregÃ³ el grupo: TM4200 - G5'),(1449376947,'2015-12-05 22:42:27','francisco','Se eliminÃ³ el grupo: TM4200 - G5'),(1449430738,'2015-12-06 13:38:58','francisco','Se agregÃ³ el presupuesto: Prueba presup con 1 tiempos.'),(1449436677,'2015-12-06 15:17:57','francisco','Se agregÃ³ el presupuesto: Prueba con 1 tiempos.'),(1449452509,'2015-12-06 19:41:49','francisco','Se agrego el presupuesto del grupo: TM4400 - G4'),(1449458229,'2015-12-06 21:17:09','francisco','Se agrego el presupuesto del grupo: TM4400 - G4'),(1449458407,'2015-12-06 21:20:07','francisco','Se agrego el presupuesto del grupo: TM4400 - G4'),(1449459377,'2015-12-06 21:36:17','francisco','Se agrego el presupuesto del grupo: TM4400 - G4'),(1449459414,'2015-12-06 21:36:54','francisco','Se agrego el presupuesto del grupo: TM4100 - G1 y G'),(1449459499,'2015-12-06 21:38:19','francisco','Se agrego el presupuesto del grupo: TM4100 - G1 y G'),(1449459876,'2015-12-06 21:44:36','francisco','Se agrego el presupuesto del grupo: TM4100 - G1 y G51'),(1449467786,'2015-12-06 23:56:26','francisco','Se quitÃ³ del presupuesto Prueba el grupo: TM4100 - G1 y G51'),(1449467955,'2015-12-06 23:59:15','francisco','Se agrego el presupuesto Prueba al grupo: TM4400 - G4'),(1449467961,'2015-12-06 23:59:21','francisco','Se quitÃ³ del presupuesto Prueba el grupo: TM4400 - G4'),(1449468592,'2015-12-07 00:09:52','francisco','Se eliminÃ³ el grupo: TM4100 - G1 y G51'),(1449468603,'2015-12-07 00:10:03','francisco','Se eliminÃ³ el grupo: TM4400 - G4'),(1449469130,'2015-12-07 00:18:50','admin','Se agregÃ³ el grupo: TM4200 - G1'),(1449469177,'2015-12-07 00:19:37','admin','Se agregÃ³ el grupo: TM1100 - G3 y G51'),(1449505782,'2015-12-07 10:29:42','admin','Se agregÃ³ el grupo: TM4200 - G1'),(1449505943,'2015-12-07 10:32:23','admin','Se agrego el presupuesto Prueba al grupo: TM4200 - G1'),(1449505984,'2015-12-07 10:33:04','admin','Se quitÃ³ del presupuesto Prueba el grupo: TM4200 - G1'),(1449507970,'2015-12-07 11:06:10','admin','Se ha asignado un presupuesto a un proyecto: '),(1449508058,'2015-12-07 11:07:38','admin','Se eliminÃ³ el presupuesto Prueba del proyecto'),(1449508290,'2015-12-07 11:11:30','admin','Se ha asignado un presupuesto a un proyecto: '),(1449508305,'2015-12-07 11:11:45','admin','Se eliminÃ³ el presupuesto Prueba del proyecto'),(1449509319,'2015-12-07 11:28:39','admin','Se agregÃ³ el grupo: TM1100 - G1 y G51'),(1449509335,'2015-12-07 11:28:55','admin','Se agrego el presupuesto Prueba al grupo: TM1100 - G1 y G51'),(1449509363,'2015-12-07 11:29:23','admin','Se agrego el presupuesto Prueba al grupo: TM4200 - G1'),(1449509381,'2015-12-07 11:29:41','admin','Se quitÃ³ del presupuesto Prueba el grupo: TM1100 - G1 y G51'),(1449509391,'2015-12-07 11:29:51','admin','Se quitÃ³ del presupuesto Prueba el grupo: TM4200 - G1'),(1449510246,'2015-12-07 11:44:06','admin','Se eliminÃ³ el grupo: TM4200 - G1'),(1449510255,'2015-12-07 11:44:15','admin','Se eliminÃ³ el grupo: TM1100 - G1 y G51'),(1449510337,'2015-12-07 11:45:37','admin','Se agregÃ³ el grupo: TM4200 - G2'),(1449510391,'2015-12-07 11:46:31','admin','Se eliminÃ³ el grupo: TM4200 - G2'),(1449511820,'2015-12-07 12:10:20','admin','Se ha asignado un presupuesto a un proyecto: '),(1449513151,'2015-12-07 12:32:31','admin','Se ha asignado un presupuesto a un proyecto: '),(1449513383,'2015-12-07 12:36:23','admin','Se ha asignado un presupuesto a un proyecto: '),(1449513409,'2015-12-07 12:36:49','admin','Se ha asignado un presupuesto a un proyecto: '),(1449513641,'2015-12-07 12:40:41','admin','Se eliminÃ³ el presupuesto Prueba del proyecto'),(1449513652,'2015-12-07 12:40:52','admin','Se ha asignado un presupuesto a un proyecto: '),(1449514147,'2015-12-07 12:49:07','admin','Se ha asignado un presupuesto a un proyecto: '),(1449514168,'2015-12-07 12:49:28','admin','Se eliminÃ³ el presupuesto Prueba del proyecto'),(1449514188,'2015-12-07 12:49:48','admin','Se ha asignado un presupuesto a un proyecto: ');
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
INSERT INTO `tb_Usuario` VALUES ('admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema',0,'prueba@prueba.com',1),('franAdmin','202cb962ac59075b964b07152d234b70','Francisco','MelÃ©ndez',2,'test@prueba.com',1),('francisco','202cb962ac59075b964b07152d234b70','Francisco','Meléndez',0,'a@a.com',1),('franDocencia','202cb962ac59075b964b07152d234b70','Francisco','MelÃ©ndez',1,'test@prueba.com',1);
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

-- Dump completed on 2015-12-07 12:50:22
