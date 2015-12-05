-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-12-2015 a las 13:14:50
-- Versión del servidor: 5.5.46-0ubuntu0.14.04.2
-- Versión de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `SIDOP`
--
CREATE DATABASE IF NOT EXISTS `SIDOP` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `SIDOP`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Carrera`
--

CREATE TABLE IF NOT EXISTS `tb_Carrera` (
  `id_Carrera` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_Carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_Carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Carrera`
--

INSERT INTO `tb_Carrera` (`id_Carrera`, `nombre_Carrera`) VALUES
('001', 'Informatica y Tecnologia Multimedia'),
('002', 'Informatica empresarial'),
('003', 'Direccion de empresas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Cursos`
--

CREATE TABLE IF NOT EXISTS `tb_Cursos` (
  `sigla` varchar(10) NOT NULL,
  `nombre_curso` varchar(100) NOT NULL,
  `creditos` int(11) NOT NULL,
  `jornada` double NOT NULL,
  PRIMARY KEY (`sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Cursos`
--

INSERT INTO `tb_Cursos` (`sigla`, `nombre_curso`, `creditos`, `jornada`) VALUES
('1', '1', 0, 0),
('TM1100', 'Introducción a la Informática y Tecnología Multimedia', 4, 0.5),
('TM4100', 'Desarrollo de aplicaciones interactivas', 3, 0.75),
('TM4200', 'Diseño Gráfico para Multimedia', 2, 0.75),
('TM4400', 'Imagen en Movimiento', 2, 0.75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Docente`
--

CREATE TABLE IF NOT EXISTS `tb_Docente` (
  `cedula` varchar(25) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `grado_academico` int(11) NOT NULL,
  `tipo_contrato` int(11) NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Docente`
--

INSERT INTO `tb_Docente` (`cedula`, `nombre`, `apellidos`, `grado_academico`, `tipo_contrato`) VALUES
('1', '1', '1', 1, 1),
('123', 'MÃ³nica', 'MuÃ±oz RamÃ­rez', 1, 1),
('1234', 'Sergio', 'apellido', 0, 2),
('12345', 'AarÃ³n', 'Galazarga Carrillo', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estadoDatos`
--

CREATE TABLE IF NOT EXISTS `tb_estadoDatos` (
  `id_estadoDatos` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `revisiones` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  PRIMARY KEY (`id_estadoDatos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_estadoDatos`
--

INSERT INTO `tb_estadoDatos` (`id_estadoDatos`, `estado`, `revisiones`, `periodo`) VALUES
(0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Grupos`
--

CREATE TABLE IF NOT EXISTS `tb_Grupos` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(3) NOT NULL,
  `num_grupo_doble` int(3) NOT NULL,
  `jornada` double NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Grupos`
--

INSERT INTO `tb_Grupos` (`fk_carrera`, `fk_curso`, `num_grupo`, `num_grupo_doble`, `jornada`) VALUES
('001', 'TM4100', 1, 51, 0.25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_GruposDocentes`
--

CREATE TABLE IF NOT EXISTS `tb_GruposDocentes` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(3) NOT NULL,
  `fk_docente` varchar(25) NOT NULL,
  `tiempo_individual` double NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`fk_docente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_GruposDocentes`
--

INSERT INTO `tb_GruposDocentes` (`fk_carrera`, `fk_curso`, `num_grupo`, `fk_docente`, `tiempo_individual`) VALUES
('001', 'TM4100', 1, '12345', 0.125),
('001', 'TM4100', 51, '12345', 0.125);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_GruposHorarios`
--

CREATE TABLE IF NOT EXISTS `tb_GruposHorarios` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(3) NOT NULL,
  `dia_semana` int(1) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`dia_semana`,`hora_inicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_GruposHorarios`
--

INSERT INTO `tb_GruposHorarios` (`fk_carrera`, `fk_curso`, `num_grupo`, `dia_semana`, `hora_inicio`, `hora_fin`) VALUES
('001', 'TM4100', 1, 1, '08:00:00', '11:50:00'),
('001', 'TM4100', 51, 3, '13:00:00', '16:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Log`
--

CREATE TABLE IF NOT EXISTS `tb_Log` (
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

--
-- Volcado de datos para la tabla `tb_Log`
--

INSERT INTO `tb_Log` (`utc`, `anio`, `mes`, `hora`, `minuto`, `segundo`, `ip`, `navegador`, `usuario`, `contrasena`, `nombre_usuario`, `apellido_usuario`) VALUES
(1449254603, 2015, 12, 4, 12, 43, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449254690, 2015, 12, 4, 12, 44, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'franDocencia', '202cb962ac59075b964b07152d234b70', 'Francisco', 'MelÃ©ndez'),
(1449254804, 2015, 12, 4, 12, 46, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'franAdmin', '202cb962ac59075b964b07152d234b70', 'Francisco', 'MelÃ©ndez'),
(1449254828, 2015, 12, 4, 12, 47, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449255012, 2015, 12, 4, 12, 50, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'franDocencia', '202cb962ac59075b964b07152d234b70', 'Francisco', 'MelÃ©ndez'),
(1449255031, 2015, 12, 4, 12, 50, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449255108, 2015, 12, 4, 12, 51, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'franAdmin', '202cb962ac59075b964b07152d234b70', 'Francisco', 'MelÃ©ndez'),
(1449255130, 2015, 12, 4, 12, 52, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449255426, 2015, 12, 4, 12, 57, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449259899, 2015, 12, 4, 14, 11, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449263648, 2015, 12, 4, 15, 14, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449272440, 2015, 12, 4, 17, 40, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'francisco', '202cb962ac59075b964b07152d234b70', 'Francisco', 'Meléndez'),
(1449290994, 2015, 12, 4, 22, 49, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449342095, 2015, 12, 5, 13, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:42.0) Gecko/20100101 Firefox/42.0', 'francisco', '202cb962ac59075b964b07152d234b70', 'Francisco', 'Meléndez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Mensaje`
--

CREATE TABLE IF NOT EXISTS `tb_Mensaje` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `emisor` varchar(20) NOT NULL,
  `receptor` varchar(20) NOT NULL,
  `contenido_mensaje` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_mensaje`),
  KEY `emisor` (`emisor`),
  KEY `receptor` (`receptor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `tb_Mensaje`
--

INSERT INTO `tb_Mensaje` (`id_mensaje`, `emisor`, `receptor`, `contenido_mensaje`, `fecha`) VALUES
(11, 'franDocencia', 'franAdmin', 'SMGASNGSNS', '2015-12-04 12:46:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_PlanEstudios`
--

CREATE TABLE IF NOT EXISTS `tb_PlanEstudios` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_PlanEstudios`
--

INSERT INTO `tb_PlanEstudios` (`fk_carrera`, `fk_curso`) VALUES
('001', 'TM1100'),
('002', 'TM4200'),
('001', 'TM4400'),
('002', 'TM1100'),
('001', 'TM4100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Proyectos`
--

CREATE TABLE IF NOT EXISTS `tb_Proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` varchar(100) NOT NULL,
  `tipo_proyecto` int(11) NOT NULL,
  `jornada_proyecto` double NOT NULL,
  `fk_encargado` varchar(25) NOT NULL,
  `fk_ayudante` varchar(25) NOT NULL,
  PRIMARY KEY (`id_proyecto`),
  KEY `fk_encargado` (`fk_encargado`),
  KEY `fk_ayudante` (`fk_ayudante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `tb_Proyectos`
--

INSERT INTO `tb_Proyectos` (`id_proyecto`, `nombre_proyecto`, `tipo_proyecto`, `jornada_proyecto`, `fk_encargado`, `fk_ayudante`) VALUES
(1, '1', 1, 1, '1', '1'),
(11, 'Pueblo', 1, 0, '1234', '1234'),
(12, 'Arqueologia', 1, 0, '123', '123'),
(15, 'ee', 0, 0.25, '123', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_RegistroActividad`
--

CREATE TABLE IF NOT EXISTS `tb_RegistroActividad` (
  `utc` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`utc`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_RegistroActividad`
--

INSERT INTO `tb_RegistroActividad` (`utc`, `fecha`, `usuario`, `descripcion`) VALUES
(1449266939, '2015-12-04 16:08:59', 'admin', 'Se modificÃ³ el grupo: '),
(1449276571, '2015-12-04 18:49:31', 'francisco', 'Se eliminÃ³ el grupo: '),
(1449276648, '2015-12-04 18:50:48', 'francisco', 'Se agregÃ³ el grupo: TM4100 - 1'),
(1449276876, '2015-12-04 18:54:36', 'francisco', 'Se eliminÃ³ el grupo: '),
(1449276941, '2015-12-04 18:55:41', 'francisco', 'Se agregÃ³ el grupo: TM4100 - 1'),
(1449277095, '2015-12-04 18:58:15', 'francisco', 'Se eliminÃ³ el grupo: '),
(1449277194, '2015-12-04 18:59:54', 'francisco', 'Se agregÃ³ el grupo: TM4100 - 1'),
(1449279484, '2015-12-04 19:38:04', 'francisco', 'Se agregÃ³ el grupo: TM4100 - 2'),
(1449280639, '2015-12-04 19:57:19', 'francisco', 'Se agregÃ³ el grupo: TM4100 - 3'),
(1449291047, '2015-12-04 22:50:47', 'admin', 'Se agregÃ³ el grupo: TM1100 - 4'),
(1449297877, '2015-12-05 00:44:37', 'admin', 'Se eliminÃ³ el grupo: '),
(1449298148, '2015-12-05 00:49:08', 'admin', 'Se eliminÃ³ el grupo: '),
(1449298217, '2015-12-05 00:50:17', 'admin', 'Se modificÃ³ el grupo: '),
(1449298282, '2015-12-05 00:51:22', 'admin', 'Se modificÃ³ el grupo: '),
(1449298850, '2015-12-05 01:00:50', 'admin', 'Se modificÃ³ el grupo: '),
(1449298952, '2015-12-05 01:02:32', 'admin', 'Se eliminÃ³ el grupo: '),
(1449342179, '2015-12-05 13:02:59', 'francisco', 'Se agregÃ³ el grupo: TM4200 - 1'),
(1449342209, '2015-12-05 13:03:29', 'francisco', 'Se modificÃ³ el grupo: '),
(1449342245, '2015-12-05 13:04:05', 'francisco', 'Se eliminÃ³ el grupo: '),
(1449342359, '2015-12-05 13:05:59', 'francisco', 'Se agregÃ³ el grupo: 0 - 0'),
(1449342489, '2015-12-05 13:08:09', 'francisco', 'Se eliminÃ³ el grupo: ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Usuario`
--

CREATE TABLE IF NOT EXISTS `tb_Usuario` (
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(80) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `apellido_usuario` varchar(40) NOT NULL,
  `perfil` int(1) NOT NULL,
  `correo_usuario` varchar(40) NOT NULL,
  `habilitado` int(1) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Usuario`
--

INSERT INTO `tb_Usuario` (`usuario`, `contrasena`, `nombre_usuario`, `apellido_usuario`, `perfil`, `correo_usuario`, `habilitado`) VALUES
('admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema', 0, 'prueba@prueba.com', 1),
('franAdmin', '202cb962ac59075b964b07152d234b70', 'Francisco', 'MelÃ©ndez', 2, 'test@prueba.com', 1),
('francisco', '202cb962ac59075b964b07152d234b70', 'Francisco', 'Meléndez', 0, 'a@a.com', 1),
('franDocencia', '202cb962ac59075b964b07152d234b70', 'Francisco', 'MelÃ©ndez', 1, 'test@prueba.com', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_Mensaje`
--
ALTER TABLE `tb_Mensaje`
  ADD CONSTRAINT `tb_Mensaje_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `tb_Usuario` (`usuario`),
  ADD CONSTRAINT `tb_Mensaje_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `tb_Usuario` (`usuario`);

--
-- Filtros para la tabla `tb_Proyectos`
--
ALTER TABLE `tb_Proyectos`
  ADD CONSTRAINT `tb_Proyectos_ibfk_1` FOREIGN KEY (`fk_encargado`) REFERENCES `tb_Docente` (`cedula`),
  ADD CONSTRAINT `tb_Proyectos_ibfk_2` FOREIGN KEY (`fk_ayudante`) REFERENCES `tb_Docente` (`cedula`);

--
-- Filtros para la tabla `tb_RegistroActividad`
--
ALTER TABLE `tb_RegistroActividad`
  ADD CONSTRAINT `tb_RegistroActividad_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `tb_Usuario` (`usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
