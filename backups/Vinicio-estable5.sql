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
INSERT INTO `tb_Carrera` VALUES ('001','informatica y tecnologia multimedia'),('002','informatica empresarial'),('003','direccion de empresas');
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
INSERT INTO `tb_Cursos` VALUES ('TM1100','Introduccion a la Informatica y tecnologia Multimedi',4,0.75),('TM4200','Diseno Grafico para Multimedia',2,0.75),('TM4400','Imagen en Movimiento',2,0.75);
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
INSERT INTO `tb_Docente` VALUES ('1','1','1',1,1),('123','MÃ³nica','MuÃ±oz RamÃ­rez',1,1),('1234','Sergio','apellido',0,2),('12345','AarÃ³n','Galazarga Carrillo',0,1),('234','pedro','apellido',0,0),('333','Maria','Solis',0,0);
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
INSERT INTO `tb_DocenteConPermiso` VALUES ('1','1','1',1,1,1,1),('123','Pedro','apellidos',1,2,2,1),('44','44','44',0,0,2,0.0625);
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
  `num_grupo` int(2) NOT NULL,
  `jornada` double NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Grupos`
--

LOCK TABLES `tb_Grupos` WRITE;
/*!40000 ALTER TABLE `tb_Grupos` DISABLE KEYS */;
INSERT INTO `tb_Grupos` VALUES ('001','TM4100',1,0.125),('002','TM4200',3,0.125);
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
  `num_grupo` int(2) NOT NULL,
  `fk_docente` varchar(25) NOT NULL,
  `tiempo_individual` double NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`fk_docente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_GruposDocentes`
--

LOCK TABLES `tb_GruposDocentes` WRITE;
/*!40000 ALTER TABLE `tb_GruposDocentes` DISABLE KEYS */;
INSERT INTO `tb_GruposDocentes` VALUES ('001','TM4100',1,'12345',0.125);
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
  `num_grupo` int(2) NOT NULL,
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
INSERT INTO `tb_GruposHorarios` VALUES ('001','TM4100',1,2,'08:00:00','11:50:00'),('001','TM4100',1,3,'13:00:00','16:50:00');
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
  `hora` int(11) NOT NULL,
  `minuto` int(11) NOT NULL,
  `segundo` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `navegador` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(80) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `apellido_usuario` varchar(40) NOT NULL,
  PRIMARY KEY (`utc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Log`
--

LOCK TABLES `tb_Log` WRITE;
/*!40000 ALTER TABLE `tb_Log` DISABLE KEYS */;
INSERT INTO `tb_Log` VALUES (1449025479,2015,12,1,21,4,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','',''),(1449025671,2015,12,1,21,7,'127.0.0.1','Apache/2.4.10 (Ubuntu)','admin','123','',''),(1449026191,2015,12,1,21,16,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','123','Administrador'),(1449026297,2015,12,1,21,18,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','Administrador','del SIstema'),(1449026347,2015,12,1,21,19,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449029847,2015,12,1,22,17,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449034182,2015,12,1,23,29,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449036199,2015,12,2,0,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449036220,2015,12,2,0,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449037187,2015,12,2,0,19,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449100539,2015,12,2,17,55,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449101645,2015,12,2,18,14,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449101659,2015,12,2,18,14,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449102384,2015,12,2,18,26,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449102930,2015,12,2,18,35,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106787,2015,12,2,19,39,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106871,2015,12,2,19,41,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106969,2015,12,2,19,42,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449107039,2015,12,2,19,43,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449110687,2015,12,2,20,44,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449118730,2015,12,2,22,58,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','francisco','202cb962ac59075b964b07152d234b70','Francisco','Meléndez'),(1449119175,2015,12,2,23,6,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449119587,2015,12,2,23,13,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','francisco','202cb962ac59075b964b07152d234b70','Francisco','Meléndez'),(1449172938,2015,12,3,14,2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449172977,2015,12,3,14,2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449173010,2015,12,3,14,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449173031,2015,12,3,14,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449173065,2015,12,3,14,4,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449188840,2015,12,3,18,27,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449189413,2015,12,3,18,36,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449192456,2015,12,3,19,27,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449193136,2015,12,3,19,38,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449193224,2015,12,3,19,40,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449193695,2015,12,3,19,48,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449193783,2015,12,3,19,49,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449201450,2015,12,3,21,57,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449206241,2015,12,3,23,17,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449206654,2015,12,3,23,24,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449207059,2015,12,3,23,30,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449208001,2015,12,3,23,46,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449209562,2015,12,4,0,12,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449210035,2015,12,4,0,20,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449211109,2015,12,4,0,38,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449211298,2015,12,4,0,41,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449211335,2015,12,4,0,42,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449211344,2015,12,4,0,42,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449211388,2015,12,4,0,43,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449243851,2015,12,4,9,44,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449248337,2015,12,4,10,58,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449248494,2015,12,4,11,1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449248535,2015,12,4,11,2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449248560,2015,12,4,11,2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449249379,2015,12,4,11,16,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449250144,2015,12,4,11,29,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449250164,2015,12,4,11,29,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449250176,2015,12,4,11,29,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449250529,2015,12,4,11,35,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449250674,2015,12,4,11,37,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449250893,2015,12,4,11,41,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449251369,2015,12,4,11,49,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449251398,2015,12,4,11,49,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449251696,2015,12,4,11,54,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449251708,2015,12,4,11,55,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449251762,2015,12,4,11,56,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449251776,2015,12,4,11,56,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449251787,2015,12,4,11,56,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449251820,2015,12,4,11,57,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449251835,2015,12,4,11,57,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449251867,2015,12,4,11,57,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449251881,2015,12,4,11,58,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449251892,2015,12,4,11,58,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449251901,2015,12,4,11,58,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449251982,2015,12,4,11,59,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449251996,2015,12,4,11,59,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449252013,2015,12,4,12,0,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449252049,2015,12,4,12,0,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449252201,2015,12,4,12,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449252284,2015,12,4,12,4,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253106,2015,12,4,12,18,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449253114,2015,12,4,12,18,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449253227,2015,12,4,12,20,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253241,2015,12,4,12,20,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449253253,2015,12,4,12,20,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253267,2015,12,4,12,21,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449253285,2015,12,4,12,21,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253304,2015,12,4,12,21,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449253321,2015,12,4,12,22,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253445,2015,12,4,12,24,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449253463,2015,12,4,12,24,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253487,2015,12,4,12,24,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449253496,2015,12,4,12,24,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253510,2015,12,4,12,25,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449253521,2015,12,4,12,25,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253547,2015,12,4,12,25,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449253556,2015,12,4,12,25,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253572,2015,12,4,12,26,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449253582,2015,12,4,12,26,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449253593,2015,12,4,12,26,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449253603,2015,12,4,12,26,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449262845,2015,12,4,15,0,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449263223,2015,12,4,15,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449263237,2015,12,4,15,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449280412,2015,12,4,19,53,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449280456,2015,12,4,19,54,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449288644,2015,12,4,22,10,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449291926,2015,12,4,23,5,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449291935,2015,12,4,23,5,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449294540,2015,12,4,23,49,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449294556,2015,12,4,23,49,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449294567,2015,12,4,23,49,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449294590,2015,12,4,23,49,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449294605,2015,12,4,23,50,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos'),(1449294647,2015,12,4,23,50,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449294826,2015,12,4,23,53,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449331592,2015,12,5,10,6,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449335142,2015,12,5,11,5,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449339200,2015,12,5,12,13,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Mensaje`
--

LOCK TABLES `tb_Mensaje` WRITE;
/*!40000 ALTER TABLE `tb_Mensaje` DISABLE KEYS */;
INSERT INTO `tb_Mensaje` VALUES (7,'admin','francisco','Prueba de mensaje para Fran\r\n','2015-12-02 22:58:40'),(8,'francisco','admin','pppppppppppppppppppppppppppppppppppp','2015-12-02 23:06:05'),(9,'admin','francisco','segunda prueba yyyyyyyyyyyyyyyyyyyy','2015-12-02 23:12:56'),(10,'admin','user-docencia','Prueba de mensaje: contenido.','2015-12-03 14:04:12');
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
INSERT INTO `tb_PlanEstudios` VALUES ('002','TM4200'),('002','TM1100');
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
  PRIMARY KEY (`id_presupuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Presupuesto`
--

LOCK TABLES `tb_Presupuesto` WRITE;
/*!40000 ALTER TABLE `tb_Presupuesto` DISABLE KEYS */;
INSERT INTO `tb_Presupuesto` VALUES (1,'1','1',1),(2,'Ordinario','001',2.0625);
/*!40000 ALTER TABLE `tb_Presupuesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_PresupuestoDocente`
--

DROP TABLE IF EXISTS `tb_PresupuestoDocente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_PresupuestoDocente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_presupuesto` int(11) NOT NULL,
  `fk_docente` varchar(25) NOT NULL,
  `jornada` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_presupuesto` (`fk_id_presupuesto`),
  KEY `fk_docente` (`fk_docente`),
  CONSTRAINT `tb_PresupuestoDocente_ibfk_1` FOREIGN KEY (`fk_docente`) REFERENCES `tb_Docente` (`cedula`),
  CONSTRAINT `tb_PresupuestoDocente_ibfk_2` FOREIGN KEY (`fk_id_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_PresupuestoDocente`
--

LOCK TABLES `tb_PresupuestoDocente` WRITE;
/*!40000 ALTER TABLE `tb_PresupuestoDocente` DISABLE KEYS */;
INSERT INTO `tb_PresupuestoDocente` VALUES (1,1,'1',1),(4,2,'123',0);
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
INSERT INTO `tb_RegistroActividad` VALUES (1449193161,'2015-12-03 19:39:21','admin','Se habilitÃ³ al usuario: asd'),(1449193233,'2015-12-03 19:40:33','admin','Se habilitÃ³ al usuario: asd'),(1449193245,'2015-12-03 19:40:45','admin','Se deshabilitÃ³ al usuario: user-docencia'),(1449193293,'2015-12-03 19:41:33','admin','Se habilitÃ³ al usuario: user-docencia'),(1449193303,'2015-12-03 19:41:43','admin','Se deshabilitÃ³ al usuario: asd'),(1449193313,'2015-12-03 19:41:53','admin','Se habilitÃ³ al usuario: francisco'),(1449193340,'2015-12-03 19:42:20','admin','Se habilitÃ³ al usuario: asd'),(1449193433,'2015-12-03 19:43:53','admin','Se modificÃ³ al usuario: '),(1449193492,'2015-12-03 19:44:52','admin','Se modificÃ³ al usuario: asd'),(1449193569,'2015-12-03 19:46:09','admin','Se eliminÃ³ al usuario: asd'),(1449193757,'2015-12-03 19:49:17','admin','Se habilitÃ³ al usuario: a'),(1449194038,'2015-12-03 19:53:58','admin','Se eliminÃ³ el curso TM4400'),(1449195202,'2015-12-03 20:13:22','admin','Se agregÃ³ el proyecto: aa'),(1449195219,'2015-12-03 20:13:39','admin','Se modificÃ³ el proyecto: aa'),(1449195231,'2015-12-03 20:13:51','admin','Se eliminÃ³ el proyecto: 16'),(1449195661,'2015-12-03 20:21:01','admin','Se agregÃ³ el presupuesto: aa'),(1449195673,'2015-12-03 20:21:13','admin','Se eliminÃ³ el presupuesto id: 7'),(1449196063,'2015-12-03 20:27:43','admin','Se modificÃ³ el grupo: '),(1449196412,'2015-12-03 20:33:32','admin','Se modificÃ³ el grupo: '),(1449248548,'2015-12-04 11:02:28','admin','Se habilitÃ³ al usuario: user-recursos-humano'),(1449273441,'2015-12-04 17:57:21','admin','Se agregÃ³ el presupuesto: Ordinario'),(1449288814,'2015-12-04 22:13:34','admin','Se agregÃ³ el curso yy yy'),(1449288827,'2015-12-04 22:13:47','admin','Se eliminÃ³ el curso yy'),(1449289068,'2015-12-04 22:17:48','admin','Se agregÃ³ el curso ee ee'),(1449289514,'2015-12-04 22:25:14','admin','Se agregÃ³ el curso ff ff'),(1449289529,'2015-12-04 22:25:29','admin','Se eliminÃ³ el curso ee'),(1449289542,'2015-12-04 22:25:42','admin','Se eliminÃ³ el curso ff'),(1449289631,'2015-12-04 22:27:11','admin','Se eliminÃ³ el curso rr'),(1449289639,'2015-12-04 22:27:19','admin','Se agregÃ³ el curso cc cc'),(1449289651,'2015-12-04 22:27:31','admin','Se eliminÃ³ el curso cc'),(1449289784,'2015-12-04 22:29:44','admin','Se agregÃ³ el curso a a'),(1449290156,'2015-12-04 22:35:56','admin','Se eliminÃ³ el curso prueba'),(1449290163,'2015-12-04 22:36:03','admin','Se eliminÃ³ el curso a'),(1449290204,'2015-12-04 22:36:44','admin','Se agregÃ³ el curso a a'),(1449290300,'2015-12-04 22:38:20','admin','Se modificÃ³ el curso a a'),(1449290317,'2015-12-04 22:38:37','admin','Se modificÃ³ el curso a a'),(1449290351,'2015-12-04 22:39:11','admin','Se eliminÃ³ el curso a'),(1449290760,'2015-12-04 22:46:00','admin','Se agregÃ³ el docente v v v'),(1449290773,'2015-12-04 22:46:13','admin','Se eliminÃ³ el docente con la cÃ©dula: v'),(1449290963,'2015-12-04 22:49:23','admin','Se agregÃ³ el docente b bbb bb'),(1449290977,'2015-12-04 22:49:37','admin','Se eliminÃ³ el docente con la cÃ©dula: b'),(1449292175,'2015-12-04 23:09:35','admin','Se agregÃ³ el grupo: TM4200 - 3'),(1449339873,'2015-12-05 12:24:33','admin','Se agregÃ³ el proyecto: '),(1449341356,'2015-12-05 12:49:16','admin','Se agregÃ³ el proyecto: ');
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
INSERT INTO `tb_Usuario` VALUES ('a','202cb962ac59075b964b07152d234b70','a','a',1,'ada@sda.com',1),('admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema',0,'prueba@prueba.com',1),('b','202cb962ac59075b964b07152d234b70','bbbbb','bbbb',1,'bb@b.bb',0),('francisco','202cb962ac59075b964b07152d234b70','Francisco','Melï¿½ndez',0,'a@a.com',1),('user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 ',1,'ada@sda.com',1),('user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos','humanos',2,'ada@sda.com',1);
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

-- Dump completed on 2015-12-05 12:52:55
