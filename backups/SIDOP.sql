-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-12-2015 a las 23:08:50
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

DROP TABLE IF EXISTS `tb_Carrera`;
CREATE TABLE IF NOT EXISTS `tb_Carrera` (
  `id_carrera` varchar(8) NOT NULL,
  `nombre_carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Carrera`
--

INSERT INTO `tb_Carrera` (`id_carrera`, `nombre_carrera`) VALUES
('1', '1'),
('110000', 'Sistema de Estudios Generales'),
('320208', 'EnseÃ±anza del InglÃ©s'),
('330102', 'DirecciÃ³n de Empresas'),
('330208', 'AdministraciÃ³n Aduanera y Comercio Exterior'),
('420201', 'IngenierÃ­a ElÃ©ctrica'),
('600002', 'InformÃ¡tica Empresarial'),
('600502', 'InformÃ¡tica y TecnologÃ­a Multimedia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Cursos`
--

DROP TABLE IF EXISTS `tb_Cursos`;
CREATE TABLE IF NOT EXISTS `tb_Cursos` (
  `sigla` varchar(10) NOT NULL,
  `nombre_curso` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `creditos` int(11) NOT NULL,
  `jornada` double NOT NULL,
  PRIMARY KEY (`sigla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Cursos`
--

INSERT INTO `tb_Cursos` (`sigla`, `nombre_curso`, `creditos`, `jornada`) VALUES
('1', '1', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Docente`
--

DROP TABLE IF EXISTS `tb_Docente`;
CREATE TABLE IF NOT EXISTS `tb_Docente` (
  `cedula` varchar(25) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grado_academico` int(1) NOT NULL,
  `tipo_contrato` int(1) NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Docente`
--

INSERT INTO `tb_Docente` (`cedula`, `nombre`, `apellidos`, `grado_academico`, `tipo_contrato`) VALUES
('1', '1', '1', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_DocenteAdministrativo`
--

DROP TABLE IF EXISTS `tb_DocenteAdministrativo`;
CREATE TABLE IF NOT EXISTS `tb_DocenteAdministrativo` (
  `cedula` varchar(25) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grado_academico` int(1) NOT NULL,
  `tipo_contrato` int(1) NOT NULL,
  `fk_presupuesto` int(11) NOT NULL,
  `jornada_docenteAdministrativo` double DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `fk_presupuesto` (`fk_presupuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `tb_DocenteAdministrativo`:
--   `fk_presupuesto`
--       `tb_Presupuesto` -> `id_presupuesto`
--

--
-- Volcado de datos para la tabla `tb_DocenteAdministrativo`
--

INSERT INTO `tb_DocenteAdministrativo` (`cedula`, `nombre`, `apellidos`, `grado_academico`, `tipo_contrato`, `fk_presupuesto`, `jornada_docenteAdministrativo`) VALUES
('1', '1', '1', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_DocenteConPermiso`
--

DROP TABLE IF EXISTS `tb_DocenteConPermiso`;
CREATE TABLE IF NOT EXISTS `tb_DocenteConPermiso` (
  `cedula` varchar(25) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grado_academico` int(1) NOT NULL,
  `tipo_contrato` int(1) NOT NULL,
  `fk_presupuesto` int(11) NOT NULL,
  `jornada_docenteConPermiso` double DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `fk_presupuesto` (`fk_presupuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `tb_DocenteConPermiso`:
--   `fk_presupuesto`
--       `tb_Presupuesto` -> `id_presupuesto`
--

--
-- Volcado de datos para la tabla `tb_DocenteConPermiso`
--

INSERT INTO `tb_DocenteConPermiso` (`cedula`, `nombre`, `apellidos`, `grado_academico`, `tipo_contrato`, `fk_presupuesto`, `jornada_docenteConPermiso`) VALUES
('1', '1', '1', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estadoDatos`
--

DROP TABLE IF EXISTS `tb_estadoDatos`;
CREATE TABLE IF NOT EXISTS `tb_estadoDatos` (
  `id_estadoDatos` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  `revisiones` int(11) NOT NULL,
  `periodo` int(1) NOT NULL,
  PRIMARY KEY (`id_estadoDatos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_estadoDatos`
--

INSERT INTO `tb_estadoDatos` (`id_estadoDatos`, `estado`, `revisiones`, `periodo`) VALUES
(0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Grupos`
--

DROP TABLE IF EXISTS `tb_Grupos`;
CREATE TABLE IF NOT EXISTS `tb_Grupos` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(3) NOT NULL,
  `num_grupo_doble` int(3) NOT NULL,
  `jornada` double NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`),
  KEY `fk_curso` (`fk_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `tb_Grupos`:
--   `fk_carrera`
--       `tb_Carrera` -> `id_Carrera`
--   `fk_curso`
--       `tb_Cursos` -> `sigla`
--

--
-- Volcado de datos para la tabla `tb_Grupos`
--

INSERT INTO `tb_Grupos` (`fk_carrera`, `fk_curso`, `num_grupo`, `num_grupo_doble`, `jornada`) VALUES
('1', '1', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_GruposDocentes`
--

DROP TABLE IF EXISTS `tb_GruposDocentes`;
CREATE TABLE IF NOT EXISTS `tb_GruposDocentes` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(3) NOT NULL,
  `fk_docente` varchar(25) NOT NULL,
  `tiempo_individual` double NOT NULL,
  `fk_presupuesto` int(11) NOT NULL,
  PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`fk_docente`),
  KEY `fk_presupuesto` (`fk_presupuesto`),
  KEY `fk_docente` (`fk_docente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `tb_GruposDocentes`:
--   `fk_docente`
--       `tb_Docente` -> `cedula`
--   `fk_presupuesto`
--       `tb_Presupuesto` -> `id_presupuesto`
--

--
-- Volcado de datos para la tabla `tb_GruposDocentes`
--

INSERT INTO `tb_GruposDocentes` (`fk_carrera`, `fk_curso`, `num_grupo`, `fk_docente`, `tiempo_individual`, `fk_presupuesto`) VALUES
('1', '1', 0, '1', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_GruposHorarios`
--

DROP TABLE IF EXISTS `tb_GruposHorarios`;
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
('1', '1', 0, 0, '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Log`
--

DROP TABLE IF EXISTS `tb_Log`;
CREATE TABLE IF NOT EXISTS `tb_Log` (
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
  `nombre_usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_usuario` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Mensaje`
--

DROP TABLE IF EXISTS `tb_Mensaje`;
CREATE TABLE IF NOT EXISTS `tb_Mensaje` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `emisor` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `receptor` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `contenido_mensaje` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_PlanEstudios`
--

DROP TABLE IF EXISTS `tb_PlanEstudios`;
CREATE TABLE IF NOT EXISTS `tb_PlanEstudios` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  KEY `fk_curso` (`fk_curso`),
  KEY `fk_tb_PlanEstudios_1_idx` (`fk_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `tb_PlanEstudios`:
--   `fk_carrera`
--       `tb_Carrera` -> `id_Carrera`
--   `fk_curso`
--       `tb_Cursos` -> `sigla`
--

--
-- Volcado de datos para la tabla `tb_PlanEstudios`
--

INSERT INTO `tb_PlanEstudios` (`fk_carrera`, `fk_curso`) VALUES
('1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Presupuesto`
--

DROP TABLE IF EXISTS `tb_Presupuesto`;
CREATE TABLE IF NOT EXISTS `tb_Presupuesto` (
  `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_presupuesto` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `tiempo_presupuesto` double NOT NULL,
  `tiempo_sobrante` double NOT NULL,
  PRIMARY KEY (`id_presupuesto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tb_Presupuesto`
--

INSERT INTO `tb_Presupuesto` (`id_presupuesto`, `nombre_presupuesto`, `codigo`, `tiempo_presupuesto`, `tiempo_sobrante`) VALUES
(1, '1', '1', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_PresupuestoDocente`
--

DROP TABLE IF EXISTS `tb_PresupuestoDocente`;
CREATE TABLE IF NOT EXISTS `tb_PresupuestoDocente` (
  `fk_id_presupuesto` int(11) NOT NULL,
  `fk_docente` varchar(25) NOT NULL,
  `jornada` double NOT NULL,
  `fk_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`fk_proyecto`),
  KEY `fk_id_presupuesto` (`fk_id_presupuesto`),
  KEY `fk_docente` (`fk_docente`),
  KEY `fk_proyecto` (`fk_proyecto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `tb_PresupuestoDocente`:
--   `fk_docente`
--       `tb_Docente` -> `cedula`
--   `fk_id_presupuesto`
--       `tb_Presupuesto` -> `id_presupuesto`
--   `fk_proyecto`
--       `tb_Proyectos` -> `id_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Proyectos`
--

DROP TABLE IF EXISTS `tb_Proyectos`;
CREATE TABLE IF NOT EXISTS `tb_Proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` varchar(128) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_proyecto` int(1) NOT NULL,
  `jornada_proyecto` double NOT NULL,
  `fk_encargado` varchar(25) NOT NULL,
  `fk_ayudante` varchar(25) NOT NULL,
  PRIMARY KEY (`id_proyecto`),
  KEY `fk_encargado` (`fk_encargado`),
  KEY `fk_ayudante` (`fk_ayudante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- RELACIONES PARA LA TABLA `tb_Proyectos`:
--   `fk_encargado`
--       `tb_Docente` -> `cedula`
--   `fk_ayudante`
--       `tb_Docente` -> `cedula`
--

--
-- Volcado de datos para la tabla `tb_Proyectos`
--

INSERT INTO `tb_Proyectos` (`id_proyecto`, `nombre_proyecto`, `tipo_proyecto`, `jornada_proyecto`, `fk_encargado`, `fk_ayudante`) VALUES
(1, '1', 0, 0, '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_RegistroActividad`
--

DROP TABLE IF EXISTS `tb_RegistroActividad`;
CREATE TABLE IF NOT EXISTS `tb_RegistroActividad` (
  `utc` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`utc`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Usuario`
--

DROP TABLE IF EXISTS `tb_Usuario`;
CREATE TABLE IF NOT EXISTS `tb_Usuario` (
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(80) NOT NULL,
  `nombre_usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_usuario` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `perfil` int(1) NOT NULL,
  `correo_usuario` varchar(40) NOT NULL,
  `habilitado` int(1) NOT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Usuario`
--

INSERT INTO `tb_Usuario` (`usuario`, `contrasena`, `nombre_usuario`, `apellido_usuario`, `perfil`, `correo_usuario`, `habilitado`) VALUES
('admin', 'abc93ffecd07d06922d1232c7beff0a8', 'Administrador', 'del Sistema', 0, '', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_DocenteAdministrativo`
--
ALTER TABLE `tb_DocenteAdministrativo`
  ADD CONSTRAINT `tb_DocenteAdministrativo_ibfk_1` FOREIGN KEY (`fk_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`);

--
-- Filtros para la tabla `tb_DocenteConPermiso`
--
ALTER TABLE `tb_DocenteConPermiso`
  ADD CONSTRAINT `tb_DocenteConPermiso_ibfk_1` FOREIGN KEY (`fk_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`);

--
-- Filtros para la tabla `tb_Grupos`
--
ALTER TABLE `tb_Grupos`
  ADD CONSTRAINT `tb_Grupos_ibfk_1` FOREIGN KEY (`fk_carrera`) REFERENCES `tb_Carrera` (`id_Carrera`),
  ADD CONSTRAINT `tb_Grupos_ibfk_2` FOREIGN KEY (`fk_curso`) REFERENCES `tb_Cursos` (`sigla`);

--
-- Filtros para la tabla `tb_GruposDocentes`
--
ALTER TABLE `tb_GruposDocentes`
  ADD CONSTRAINT `tb_GruposDocentes_ibfk_2` FOREIGN KEY (`fk_docente`) REFERENCES `tb_Docente` (`cedula`),
  ADD CONSTRAINT `tb_GruposDocentes_ibfk_1` FOREIGN KEY (`fk_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`);

--
-- Filtros para la tabla `tb_PlanEstudios`
--
ALTER TABLE `tb_PlanEstudios`
  ADD CONSTRAINT `tb_PlanEstudios_ibfk_1` FOREIGN KEY (`fk_carrera`) REFERENCES `tb_Carrera` (`id_Carrera`),
  ADD CONSTRAINT `tb_PlanEstudios_ibfk_2` FOREIGN KEY (`fk_curso`) REFERENCES `tb_Cursos` (`sigla`);

--
-- Filtros para la tabla `tb_PresupuestoDocente`
--
ALTER TABLE `tb_PresupuestoDocente`
  ADD CONSTRAINT `tb_PresupuestoDocente_ibfk_1` FOREIGN KEY (`fk_docente`) REFERENCES `tb_Docente` (`cedula`),
  ADD CONSTRAINT `tb_PresupuestoDocente_ibfk_2` FOREIGN KEY (`fk_id_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`),
  ADD CONSTRAINT `tb_PresupuestoDocente_ibfk_3` FOREIGN KEY (`fk_proyecto`) REFERENCES `tb_Proyectos` (`id_proyecto`);

--
-- Filtros para la tabla `tb_Proyectos`
--
ALTER TABLE `tb_Proyectos`
  ADD CONSTRAINT `tb_Proyectos_ibfk_1` FOREIGN KEY (`fk_encargado`) REFERENCES `tb_Docente` (`cedula`),
  ADD CONSTRAINT `tb_Proyectos_ibfk_2` FOREIGN KEY (`fk_ayudante`) REFERENCES `tb_Docente` (`cedula`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
