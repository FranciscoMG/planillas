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
  `fk_carrera` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`sigla`),
  KEY `fk_carrera` (`fk_carrera`),
  CONSTRAINT `tb_Cursos_ibfk_1` FOREIGN KEY (`fk_carrera`) REFERENCES `tb_Carrera` (`id_Carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Cursos`
--

LOCK TABLES `tb_Cursos` WRITE;
/*!40000 ALTER TABLE `tb_Cursos` DISABLE KEYS */;
INSERT INTO `tb_Cursos` VALUES ('1','1',0,0,'001'),('TM1100','Introducción a la Informática y Tecnología Multimedia',4,0.5,'001'),('TM4100','Desarrollo de aplicaciones interactivas',3,0.75,'001'),('TM4200','Diseño Gráfico para Multimedia',2,0.75,'001');
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
INSERT INTO `tb_Docente` VALUES ('1','1','1',1,1),('123','MÃ³nica','MuÃ±oz RamÃ­rez',1,1),('1234','Sergio','apellido',0,2),('12345','AarÃ³n','Galazarga Carrillo',0,1),('234','pedro','apellido',0,0);
/*!40000 ALTER TABLE `tb_Docente` ENABLE KEYS */;
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
INSERT INTO `tb_Grupos` VALUES ('001','TM4100',1,0.125);
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
INSERT INTO `tb_Log` VALUES (1449025479,2015,12,1,21,4,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','',''),(1449025671,2015,12,1,21,7,'127.0.0.1','Apache/2.4.10 (Ubuntu)','admin','123','',''),(1449026191,2015,12,1,21,16,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','123','Administrador'),(1449026297,2015,12,1,21,18,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','Administrador','del SIstema'),(1449026347,2015,12,1,21,19,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449029847,2015,12,1,22,17,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449034182,2015,12,1,23,29,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449036199,2015,12,2,0,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449036220,2015,12,2,0,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449037187,2015,12,2,0,19,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449100539,2015,12,2,17,55,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449101645,2015,12,2,18,14,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449101659,2015,12,2,18,14,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449102384,2015,12,2,18,26,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449102930,2015,12,2,18,35,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106787,2015,12,2,19,39,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106871,2015,12,2,19,41,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106969,2015,12,2,19,42,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449107039,2015,12,2,19,43,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449110687,2015,12,2,20,44,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449118730,2015,12,2,22,58,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','francisco','202cb962ac59075b964b07152d234b70','Francisco','Meléndez'),(1449119175,2015,12,2,23,6,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449119587,2015,12,2,23,13,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','francisco','202cb962ac59075b964b07152d234b70','Francisco','Meléndez'),(1449172938,2015,12,3,14,2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449172977,2015,12,3,14,2,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449173010,2015,12,3,14,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449173031,2015,12,3,14,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449173065,2015,12,3,14,4,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449188840,2015,12,3,18,27,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449189413,2015,12,3,18,36,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449192456,2015,12,3,19,27,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449193136,2015,12,3,19,38,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449193224,2015,12,3,19,40,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449193695,2015,12,3,19,48,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449193783,2015,12,3,19,49,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema');
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
  PRIMARY KEY (`id_presupuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Presupuesto`
--

LOCK TABLES `tb_Presupuesto` WRITE;
/*!40000 ALTER TABLE `tb_Presupuesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_Presupuesto` ENABLE KEYS */;
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
INSERT INTO `tb_RegistroActividad` VALUES (1449193161,'2015-12-03 19:39:21','admin','Se habilitÃ³ al usuario: asd'),(1449193233,'2015-12-03 19:40:33','admin','Se habilitÃ³ al usuario: asd'),(1449193245,'2015-12-03 19:40:45','admin','Se deshabilitÃ³ al usuario: user-docencia'),(1449193293,'2015-12-03 19:41:33','admin','Se habilitÃ³ al usuario: user-docencia'),(1449193303,'2015-12-03 19:41:43','admin','Se deshabilitÃ³ al usuario: asd'),(1449193313,'2015-12-03 19:41:53','admin','Se habilitÃ³ al usuario: francisco'),(1449193340,'2015-12-03 19:42:20','admin','Se habilitÃ³ al usuario: asd'),(1449193433,'2015-12-03 19:43:53','admin','Se modificÃ³ al usuario: '),(1449193492,'2015-12-03 19:44:52','admin','Se modificÃ³ al usuario: asd'),(1449193569,'2015-12-03 19:46:09','admin','Se eliminÃ³ al usuario: asd'),(1449193757,'2015-12-03 19:49:17','admin','Se habilitÃ³ al usuario: a'),(1449194038,'2015-12-03 19:53:58','admin','Se eliminÃ³ el curso TM4400'),(1449195202,'2015-12-03 20:13:22','admin','Se agregÃ³ el proyecto: aa'),(1449195219,'2015-12-03 20:13:39','admin','Se modificÃ³ el proyecto: aa'),(1449195231,'2015-12-03 20:13:51','admin','Se eliminÃ³ el proyecto: 16'),(1449195661,'2015-12-03 20:21:01','admin','Se agregÃ³ el presupuesto: aa'),(1449195673,'2015-12-03 20:21:13','admin','Se eliminÃ³ el presupuesto id: 7'),(1449196063,'2015-12-03 20:27:43','admin','Se modificÃ³ el grupo: '),(1449196412,'2015-12-03 20:33:32','admin','Se modificÃ³ el grupo: ');
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
INSERT INTO `tb_Usuario` VALUES ('a','202cb962ac59075b964b07152d234b70','a','a',1,'ada@sda.com',1),('admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema',0,'prueba@prueba.com',1),('b','202cb962ac59075b964b07152d234b70','bbbbb','bbbb',1,'bb@b.bb',0),('francisco','202cb962ac59075b964b07152d234b70','Francisco','Melï¿½ndez',0,'a@a.com',1),('user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 ',1,'ada@sda.com',1);
/*!40000 ALTER TABLE `tb_Usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-03 20:33:52
