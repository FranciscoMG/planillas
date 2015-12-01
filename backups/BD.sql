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
INSERT INTO `tb_Cursos` VALUES ('1','1',1,1,'002'),('2','777',2,0.75,'002'),('toooo','s',0,0.125,'003'),('toooot','w',0,0.5,'003');
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
INSERT INTO `tb_Docente` VALUES ('1','1','1',1,1),('123','Armando','apellido',1,1),('1234','Sergio','apellido',1,1);
/*!40000 ALTER TABLE `tb_Docente` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Presupuesto`
--

LOCK TABLES `tb_Presupuesto` WRITE;
/*!40000 ALTER TABLE `tb_Presupuesto` DISABLE KEYS */;
INSERT INTO `tb_Presupuesto` VALUES (6,'aaa','aaa',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_Proyectos`
--

LOCK TABLES `tb_Proyectos` WRITE;
/*!40000 ALTER TABLE `tb_Proyectos` DISABLE KEYS */;
INSERT INTO `tb_Proyectos` VALUES (1,'1',1,1,'1','1'),(11,'Pueblo',1,0.5,'1234','1234'),(12,'Arqueologia',1,0.25,'123','123');
/*!40000 ALTER TABLE `tb_Proyectos` ENABLE KEYS */;
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
INSERT INTO `tb_Usuario` VALUES ('admin','202cb962ac59075b964b07152d234b70','Pedro','Rodriguez',0,'asdad@asd.com',1),('p1','202cb962ac59075b964b07152d234b70','Vini','Rodriguez',1,'as@12.com',1),('p2','123','ppp','ttt',1,'pppp@u.com',0),('p3','123','sodn','oooo',1,'2opwin@asd.sad',0),('user-docencia','202cb962ac59075b964b07152d234b70','Carlos','Avellanos',1,'hdf@s.com',1),('user-recursos-humano','202cb962ac59075b964b07152d234b70','Ana','Olivares',2,'sd@',1);
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

-- Dump completed on 2015-11-27 14:34:32
