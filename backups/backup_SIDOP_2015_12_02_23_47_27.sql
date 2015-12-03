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
INSERT INTO `tb_Grupos` VALUES ('001','TM1100',1,0.125),('001','TM4100',1,0.125);
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
INSERT INTO `tb_GruposDocentes` VALUES ('001','TM1100',1,'123',0.0625),('001','TM4100',1,'12345',0.125);
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
INSERT INTO `tb_GruposHorarios` VALUES ('001','TM1100',1,0,'07:00:00','07:00:00'),('001','TM4100',1,2,'08:00:00','11:50:00'),('001','TM4100',1,3,'13:00:00','16:50:00');
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
INSERT INTO `tb_Log` VALUES (1449025479,2015,12,1,21,4,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','',''),(1449025671,2015,12,1,21,7,'127.0.0.1','Apache/2.4.10 (Ubuntu)','admin','123','',''),(1449026191,2015,12,1,21,16,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','123','Administrador'),(1449026297,2015,12,1,21,18,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','123','Administrador','del SIstema'),(1449026347,2015,12,1,21,19,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449029847,2015,12,1,22,17,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449034182,2015,12,1,23,29,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449036199,2015,12,2,0,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449036220,2015,12,2,0,3,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449037187,2015,12,2,0,19,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449100539,2015,12,2,17,55,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449101645,2015,12,2,18,14,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449101659,2015,12,2,18,14,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-recursos-humano','202cb962ac59075b964b07152d234b70','recursos h','apellido'),(1449102384,2015,12,2,18,26,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449102930,2015,12,2,18,35,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106787,2015,12,2,19,39,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106871,2015,12,2,19,41,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449106969,2015,12,2,19,42,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','user-docencia','202cb962ac59075b964b07152d234b70','Nombre','Apellido1 apellido2 '),(1449107039,2015,12,2,19,43,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449110687,2015,12,2,20,44,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449118730,2015,12,2,22,58,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','francisco','202cb962ac59075b964b07152d234b70','Francisco','Meléndez'),(1449119175,2015,12,2,23,6,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema'),(1449119587,2015,12,2,23,13,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53','francisco','202cb962ac59075b964b07152d234b70','Francisco','Meléndez');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Mensaje`
--

LOCK TABLES `tb_Mensaje` WRITE;
/*!40000 ALTER TABLE `tb_Mensaje` DISABLE KEYS */;
INSERT INTO `tb_Mensaje` VALUES (7,'admin','francisco','Prueba de mensaje para Fran\r\n','2015-12-02 22:58:40'),(8,'francisco','admin','pppppppppppppppppppppppppppppppppppp','2015-12-02 23:06:05'),(9,'admin','francisco','segunda prueba yyyyyyyyyyyyyyyyyyyy','2015-12-02 23:12:56');
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
INSERT INTO `tb_RegistroActividad` VALUES (1449030193,'2015-12-01 22:23:13','admin','Prueba de descripcion');
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
INSERT INTO `tb_Usuario` VALUES ('admin','202cb962ac59075b964b07152d234b70','Administrador','del SIstema',0,'prueba@prueba.com',1),('francisco','202cb962ac59075b964b07152d234b70','Francisco','Meléndez',0,'a@a.com',1);
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

-- Dump completed on 2015-12-02 23:47:27
