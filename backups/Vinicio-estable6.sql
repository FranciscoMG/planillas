-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2015 a las 13:48:28
-- Versión del servidor: 5.6.27-0ubuntu0.15.04.1
-- Versión de PHP: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `SIDOP`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Carrera`
--

CREATE TABLE IF NOT EXISTS `tb_Carrera` (
  `id_Carrera` varchar(8) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_Carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Carrera`
--

INSERT INTO `tb_Carrera` (`id_Carrera`, `nombre_Carrera`) VALUES
('001', 'informatica y tecnologia multimedia'),
('002', 'informatica empresarial'),
('003', 'direccion de empresas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Cursos`
--

CREATE TABLE IF NOT EXISTS `tb_Cursos` (
  `sigla` varchar(10) NOT NULL,
  `nombre_curso` varchar(100) NOT NULL,
  `creditos` int(11) NOT NULL,
  `jornada` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Cursos`
--

INSERT INTO `tb_Cursos` (`sigla`, `nombre_curso`, `creditos`, `jornada`) VALUES
('TM1100', 'Introduccion a la Informatica y tecnologia Multimedi', 4, 0.75),
('TM4200', 'Diseno Grafico para Multimedia', 2, 0.75),
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
  `tipo_contrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Docente`
--

INSERT INTO `tb_Docente` (`cedula`, `nombre`, `apellidos`, `grado_academico`, `tipo_contrato`) VALUES
('1', '1', '1', 1, 1),
('123', 'MÃ³nica', 'MuÃ±oz RamÃ­rez', 1, 1),
('1234', 'Sergio', 'apellido', 0, 2),
('12345', 'AarÃ³n', 'Galazarga Carrillo', 0, 1),
('234', 'pedro', 'apellido', 0, 0),
('333', 'Maria', 'Solis', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_DocenteConPermiso`
--

CREATE TABLE IF NOT EXISTS `tb_DocenteConPermiso` (
  `cedula` varchar(25) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `grado_academico` int(11) NOT NULL,
  `tipo_contrato` int(11) NOT NULL,
  `fk_presupuesto` int(11) NOT NULL,
  `jornada_docenteConPermiso` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_DocenteConPermiso`
--

INSERT INTO `tb_DocenteConPermiso` (`cedula`, `nombre`, `apellidos`, `grado_academico`, `tipo_contrato`, `fk_presupuesto`, `jornada_docenteConPermiso`) VALUES
('1', '1', '1', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estadoDatos`
--

CREATE TABLE IF NOT EXISTS `tb_estadoDatos` (
  `id_estadoDatos` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `revisiones` int(11) NOT NULL,
  `periodo` int(11) NOT NULL
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
  `num_grupo` int(2) NOT NULL,
  `jornada` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Grupos`
--

INSERT INTO `tb_Grupos` (`fk_carrera`, `fk_curso`, `num_grupo`, `jornada`) VALUES
('001', 'TM4100', 1, 0.125),
('002', 'TM4200', 3, 0.125);

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
  `fk_presupuesto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_GruposDocentes`
--

INSERT INTO `tb_GruposDocentes` (`fk_carrera`, `fk_curso`, `num_grupo`, `fk_docente`, `tiempo_individual`, `fk_presupuesto`) VALUES
('1', '1', 1, '1', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_GruposHorarios`
--

CREATE TABLE IF NOT EXISTS `tb_GruposHorarios` (
  `fk_carrera` varchar(8) NOT NULL,
  `fk_curso` varchar(10) NOT NULL,
  `num_grupo` int(2) NOT NULL,
  `dia_semana` int(1) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_GruposHorarios`
--

INSERT INTO `tb_GruposHorarios` (`fk_carrera`, `fk_curso`, `num_grupo`, `dia_semana`, `hora_inicio`, `hora_fin`) VALUES
('001', 'TM4100', 1, 2, '08:00:00', '11:50:00'),
('001', 'TM4100', 1, 3, '13:00:00', '16:50:00');

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
  `apellido_usuario` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Log`
--

INSERT INTO `tb_Log` (`utc`, `anio`, `mes`, `hora`, `minuto`, `segundo`, `ip`, `navegador`, `usuario`, `contrasena`, `nombre_usuario`, `apellido_usuario`) VALUES
(1449025479, 2015, 12, 1, 21, 4, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '123', '', ''),
(1449025671, 2015, 12, 1, 21, 7, '127.0.0.1', 'Apache/2.4.10 (Ubuntu)', 'admin', '123', '', ''),
(1449026191, 2015, 12, 1, 21, 16, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '123', '123', 'Administrador'),
(1449026297, 2015, 12, 1, 21, 18, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '123', 'Administrador', 'del SIstema'),
(1449026347, 2015, 12, 1, 21, 19, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449029847, 2015, 12, 1, 22, 17, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449034182, 2015, 12, 1, 23, 29, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos h', 'apellido'),
(1449036199, 2015, 12, 2, 0, 3, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449036220, 2015, 12, 2, 0, 3, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449037187, 2015, 12, 2, 0, 19, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449100539, 2015, 12, 2, 17, 55, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449101645, 2015, 12, 2, 18, 14, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos h', 'apellido'),
(1449101659, 2015, 12, 2, 18, 14, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos h', 'apellido'),
(1449102384, 2015, 12, 2, 18, 26, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449102930, 2015, 12, 2, 18, 35, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449106787, 2015, 12, 2, 19, 39, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449106871, 2015, 12, 2, 19, 41, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449106969, 2015, 12, 2, 19, 42, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449107039, 2015, 12, 2, 19, 43, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449110687, 2015, 12, 2, 20, 44, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449118730, 2015, 12, 2, 22, 58, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'francisco', '202cb962ac59075b964b07152d234b70', 'Francisco', 'Meléndez'),
(1449119175, 2015, 12, 2, 23, 6, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449119587, 2015, 12, 2, 23, 13, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'francisco', '202cb962ac59075b964b07152d234b70', 'Francisco', 'Meléndez'),
(1449172938, 2015, 12, 3, 14, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449172977, 2015, 12, 3, 14, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449173010, 2015, 12, 3, 14, 3, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449173031, 2015, 12, 3, 14, 3, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449173065, 2015, 12, 3, 14, 4, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449188840, 2015, 12, 3, 18, 27, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449189413, 2015, 12, 3, 18, 36, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449192456, 2015, 12, 3, 19, 27, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449193136, 2015, 12, 3, 19, 38, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449193224, 2015, 12, 3, 19, 40, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449193695, 2015, 12, 3, 19, 48, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449193783, 2015, 12, 3, 19, 49, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449201450, 2015, 12, 3, 21, 57, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449206241, 2015, 12, 3, 23, 17, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449206654, 2015, 12, 3, 23, 24, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449207059, 2015, 12, 3, 23, 30, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449208001, 2015, 12, 3, 23, 46, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449209562, 2015, 12, 4, 0, 12, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449210035, 2015, 12, 4, 0, 20, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449211109, 2015, 12, 4, 0, 38, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449211298, 2015, 12, 4, 0, 41, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449211335, 2015, 12, 4, 0, 42, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449211344, 2015, 12, 4, 0, 42, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449211388, 2015, 12, 4, 0, 43, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449243851, 2015, 12, 4, 9, 44, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449248337, 2015, 12, 4, 10, 58, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449248494, 2015, 12, 4, 11, 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449248535, 2015, 12, 4, 11, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449248560, 2015, 12, 4, 11, 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449249379, 2015, 12, 4, 11, 16, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449250144, 2015, 12, 4, 11, 29, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449250164, 2015, 12, 4, 11, 29, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449250176, 2015, 12, 4, 11, 29, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449250529, 2015, 12, 4, 11, 35, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449250674, 2015, 12, 4, 11, 37, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449250893, 2015, 12, 4, 11, 41, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449251369, 2015, 12, 4, 11, 49, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449251398, 2015, 12, 4, 11, 49, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449251696, 2015, 12, 4, 11, 54, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449251708, 2015, 12, 4, 11, 55, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449251762, 2015, 12, 4, 11, 56, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449251776, 2015, 12, 4, 11, 56, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449251787, 2015, 12, 4, 11, 56, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449251820, 2015, 12, 4, 11, 57, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449251835, 2015, 12, 4, 11, 57, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449251867, 2015, 12, 4, 11, 57, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449251881, 2015, 12, 4, 11, 58, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449251892, 2015, 12, 4, 11, 58, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449251901, 2015, 12, 4, 11, 58, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449251982, 2015, 12, 4, 11, 59, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449251996, 2015, 12, 4, 11, 59, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449252013, 2015, 12, 4, 12, 0, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449252049, 2015, 12, 4, 12, 0, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449252201, 2015, 12, 4, 12, 3, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449252284, 2015, 12, 4, 12, 4, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253106, 2015, 12, 4, 12, 18, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449253114, 2015, 12, 4, 12, 18, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449253227, 2015, 12, 4, 12, 20, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253241, 2015, 12, 4, 12, 20, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449253253, 2015, 12, 4, 12, 20, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253267, 2015, 12, 4, 12, 21, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449253285, 2015, 12, 4, 12, 21, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253304, 2015, 12, 4, 12, 21, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449253321, 2015, 12, 4, 12, 22, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253445, 2015, 12, 4, 12, 24, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449253463, 2015, 12, 4, 12, 24, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253487, 2015, 12, 4, 12, 24, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449253496, 2015, 12, 4, 12, 24, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253510, 2015, 12, 4, 12, 25, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449253521, 2015, 12, 4, 12, 25, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253547, 2015, 12, 4, 12, 25, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449253556, 2015, 12, 4, 12, 25, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253572, 2015, 12, 4, 12, 26, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449253582, 2015, 12, 4, 12, 26, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449253593, 2015, 12, 4, 12, 26, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449253603, 2015, 12, 4, 12, 26, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449262845, 2015, 12, 4, 15, 0, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449263223, 2015, 12, 4, 15, 7, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449263237, 2015, 12, 4, 15, 7, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449280412, 2015, 12, 4, 19, 53, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449280456, 2015, 12, 4, 19, 54, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449288644, 2015, 12, 4, 22, 10, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449291926, 2015, 12, 4, 23, 5, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449291935, 2015, 12, 4, 23, 5, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449294540, 2015, 12, 4, 23, 49, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449294556, 2015, 12, 4, 23, 49, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449294567, 2015, 12, 4, 23, 49, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 '),
(1449294590, 2015, 12, 4, 23, 49, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449294605, 2015, 12, 4, 23, 50, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos'),
(1449294647, 2015, 12, 4, 23, 50, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449294826, 2015, 12, 4, 23, 53, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449331592, 2015, 12, 5, 10, 6, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449335142, 2015, 12, 5, 11, 5, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449339200, 2015, 12, 5, 12, 13, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449356819, 2015, 12, 5, 17, 6, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449373510, 2015, 12, 5, 21, 45, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449378749, 2015, 12, 5, 23, 12, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449379777, 2015, 12, 5, 23, 29, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449426612, 2015, 12, 6, 12, 30, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema'),
(1449426621, 2015, 12, 6, 12, 30, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/53', 'admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Mensaje`
--

CREATE TABLE IF NOT EXISTS `tb_Mensaje` (
`id_mensaje` int(11) NOT NULL,
  `emisor` varchar(20) NOT NULL,
  `receptor` varchar(20) NOT NULL,
  `contenido_mensaje` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Mensaje`
--

INSERT INTO `tb_Mensaje` (`id_mensaje`, `emisor`, `receptor`, `contenido_mensaje`, `fecha`) VALUES
(7, 'admin', 'francisco', 'Prueba de mensaje para Fran\r\n', '2015-12-02 22:58:40'),
(8, 'francisco', 'admin', 'pppppppppppppppppppppppppppppppppppp', '2015-12-02 23:06:05'),
(9, 'admin', 'francisco', 'segunda prueba yyyyyyyyyyyyyyyyyyyy', '2015-12-02 23:12:56'),
(10, 'admin', 'user-docencia', 'Prueba de mensaje: contenido.', '2015-12-03 14:04:12');

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
('1', 'TM4200'),
('002', 'TM1100');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Presupuesto`
--

CREATE TABLE IF NOT EXISTS `tb_Presupuesto` (
`id_presupuesto` int(11) NOT NULL,
  `nombre_presupuesto` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo_presupuesto` double NOT NULL,
  `tiempo_sobrante` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_Presupuesto`
--

INSERT INTO `tb_Presupuesto` (`id_presupuesto`, `nombre_presupuesto`, `codigo`, `tiempo_presupuesto`, `tiempo_sobrante`) VALUES
(1, '1', '1', 1, NULL),
(22, 'PO', 'sd', 0.5, 0.4375);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_PresupuestoDocente`
--

CREATE TABLE IF NOT EXISTS `tb_PresupuestoDocente` (
  `fk_id_presupuesto` int(11) NOT NULL,
  `fk_docente` varchar(25) NOT NULL,
  `jornada` double NOT NULL,
  `fk_proyecto` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_PresupuestoDocente`
--

INSERT INTO `tb_PresupuestoDocente` (`fk_id_presupuesto`, `fk_docente`, `jornada`, `fk_proyecto`) VALUES
(1, '1', 99, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_Proyectos`
--

CREATE TABLE IF NOT EXISTS `tb_Proyectos` (
`id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(100) NOT NULL,
  `tipo_proyecto` int(11) NOT NULL,
  `jornada_proyecto` double NOT NULL,
  `fk_encargado` varchar(25) NOT NULL,
  `fk_ayudante` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Proyectos`
--

INSERT INTO `tb_Proyectos` (`id_proyecto`, `nombre_proyecto`, `tipo_proyecto`, `jornada_proyecto`, `fk_encargado`, `fk_ayudante`) VALUES
(1, '1', 1, 1, '1', '1'),
(16, 'Social', 0, 0.0625, '123', '123'),
(19, 'Investigacion', 1, 0.0625, '12345', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_RegistroActividad`
--

CREATE TABLE IF NOT EXISTS `tb_RegistroActividad` (
  `utc` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_RegistroActividad`
--

INSERT INTO `tb_RegistroActividad` (`utc`, `fecha`, `usuario`, `descripcion`) VALUES
(1449193161, '2015-12-03 19:39:21', 'admin', 'Se habilitÃ³ al usuario: asd'),
(1449193233, '2015-12-03 19:40:33', 'admin', 'Se habilitÃ³ al usuario: asd'),
(1449193245, '2015-12-03 19:40:45', 'admin', 'Se deshabilitÃ³ al usuario: user-docencia'),
(1449193293, '2015-12-03 19:41:33', 'admin', 'Se habilitÃ³ al usuario: user-docencia'),
(1449193303, '2015-12-03 19:41:43', 'admin', 'Se deshabilitÃ³ al usuario: asd'),
(1449193313, '2015-12-03 19:41:53', 'admin', 'Se habilitÃ³ al usuario: francisco'),
(1449193340, '2015-12-03 19:42:20', 'admin', 'Se habilitÃ³ al usuario: asd'),
(1449193433, '2015-12-03 19:43:53', 'admin', 'Se modificÃ³ al usuario: '),
(1449193492, '2015-12-03 19:44:52', 'admin', 'Se modificÃ³ al usuario: asd'),
(1449193569, '2015-12-03 19:46:09', 'admin', 'Se eliminÃ³ al usuario: asd'),
(1449193757, '2015-12-03 19:49:17', 'admin', 'Se habilitÃ³ al usuario: a'),
(1449194038, '2015-12-03 19:53:58', 'admin', 'Se eliminÃ³ el curso TM4400'),
(1449195202, '2015-12-03 20:13:22', 'admin', 'Se agregÃ³ el proyecto: aa'),
(1449195219, '2015-12-03 20:13:39', 'admin', 'Se modificÃ³ el proyecto: aa'),
(1449195231, '2015-12-03 20:13:51', 'admin', 'Se eliminÃ³ el proyecto: 16'),
(1449195661, '2015-12-03 20:21:01', 'admin', 'Se agregÃ³ el presupuesto: aa'),
(1449195673, '2015-12-03 20:21:13', 'admin', 'Se eliminÃ³ el presupuesto id: 7'),
(1449196063, '2015-12-03 20:27:43', 'admin', 'Se modificÃ³ el grupo: '),
(1449196412, '2015-12-03 20:33:32', 'admin', 'Se modificÃ³ el grupo: '),
(1449248548, '2015-12-04 11:02:28', 'admin', 'Se habilitÃ³ al usuario: user-recursos-humano'),
(1449273441, '2015-12-04 17:57:21', 'admin', 'Se agregÃ³ el presupuesto: Ordinario'),
(1449288814, '2015-12-04 22:13:34', 'admin', 'Se agregÃ³ el curso yy yy'),
(1449288827, '2015-12-04 22:13:47', 'admin', 'Se eliminÃ³ el curso yy'),
(1449289068, '2015-12-04 22:17:48', 'admin', 'Se agregÃ³ el curso ee ee'),
(1449289514, '2015-12-04 22:25:14', 'admin', 'Se agregÃ³ el curso ff ff'),
(1449289529, '2015-12-04 22:25:29', 'admin', 'Se eliminÃ³ el curso ee'),
(1449289542, '2015-12-04 22:25:42', 'admin', 'Se eliminÃ³ el curso ff'),
(1449289631, '2015-12-04 22:27:11', 'admin', 'Se eliminÃ³ el curso rr'),
(1449289639, '2015-12-04 22:27:19', 'admin', 'Se agregÃ³ el curso cc cc'),
(1449289651, '2015-12-04 22:27:31', 'admin', 'Se eliminÃ³ el curso cc'),
(1449289784, '2015-12-04 22:29:44', 'admin', 'Se agregÃ³ el curso a a'),
(1449290156, '2015-12-04 22:35:56', 'admin', 'Se eliminÃ³ el curso prueba'),
(1449290163, '2015-12-04 22:36:03', 'admin', 'Se eliminÃ³ el curso a'),
(1449290204, '2015-12-04 22:36:44', 'admin', 'Se agregÃ³ el curso a a'),
(1449290300, '2015-12-04 22:38:20', 'admin', 'Se modificÃ³ el curso a a'),
(1449290317, '2015-12-04 22:38:37', 'admin', 'Se modificÃ³ el curso a a'),
(1449290351, '2015-12-04 22:39:11', 'admin', 'Se eliminÃ³ el curso a'),
(1449290760, '2015-12-04 22:46:00', 'admin', 'Se agregÃ³ el docente v v v'),
(1449290773, '2015-12-04 22:46:13', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: v'),
(1449290963, '2015-12-04 22:49:23', 'admin', 'Se agregÃ³ el docente b bbb bb'),
(1449290977, '2015-12-04 22:49:37', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: b'),
(1449292175, '2015-12-04 23:09:35', 'admin', 'Se agregÃ³ el grupo: TM4200 - 3'),
(1449339873, '2015-12-05 12:24:33', 'admin', 'Se agregÃ³ el proyecto: '),
(1449341356, '2015-12-05 12:49:16', 'admin', 'Se agregÃ³ el proyecto: '),
(1449345763, '2015-12-05 14:02:43', 'admin', 'Se agregÃ³ el proyecto: '),
(1449345808, '2015-12-05 14:03:28', 'admin', 'Se agregÃ³ el proyecto: '),
(1449346126, '2015-12-05 14:08:46', 'admin', 'Se agregÃ³ el proyecto: '),
(1449346290, '2015-12-05 14:11:30', 'admin', 'Se agregÃ³ el proyecto: '),
(1449346342, '2015-12-05 14:12:22', 'admin', 'Se agregÃ³ el proyecto: '),
(1449346413, '2015-12-05 14:13:33', 'admin', 'Se agregÃ³ el proyecto: '),
(1449346460, '2015-12-05 14:14:20', 'admin', 'Se agregÃ³ el proyecto: '),
(1449346508, '2015-12-05 14:15:08', 'admin', 'Se agregÃ³ el proyecto: '),
(1449346564, '2015-12-05 14:16:04', 'admin', 'Se agregÃ³ el proyecto: '),
(1449346629, '2015-12-05 14:17:09', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347153, '2015-12-05 14:25:53', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347214, '2015-12-05 14:26:54', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347534, '2015-12-05 14:32:14', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347624, '2015-12-05 14:33:44', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347728, '2015-12-05 14:35:28', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347747, '2015-12-05 14:35:47', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347795, '2015-12-05 14:36:35', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347882, '2015-12-05 14:38:02', 'admin', 'Se agregÃ³ el proyecto: '),
(1449347908, '2015-12-05 14:38:28', 'admin', 'Se agregÃ³ el proyecto: '),
(1449348011, '2015-12-05 14:40:11', 'admin', 'Se agregÃ³ el proyecto: '),
(1449348407, '2015-12-05 14:46:47', 'admin', 'Se agregÃ³ el proyecto: '),
(1449348544, '2015-12-05 14:49:04', 'admin', 'Se agregÃ³ el proyecto: '),
(1449348626, '2015-12-05 14:50:26', 'admin', 'Se agregÃ³ el proyecto: '),
(1449348639, '2015-12-05 14:50:39', 'admin', 'Se agregÃ³ el proyecto: '),
(1449349183, '2015-12-05 14:59:43', 'admin', 'Se agregÃ³ el proyecto: '),
(1449349216, '2015-12-05 15:00:16', 'admin', 'Se agregÃ³ el proyecto: '),
(1449349229, '2015-12-05 15:00:29', 'admin', 'Se agregÃ³ el proyecto: '),
(1449349248, '2015-12-05 15:00:48', 'admin', 'Se agregÃ³ el proyecto: '),
(1449349262, '2015-12-05 15:01:02', 'admin', 'Se agregÃ³ el proyecto: '),
(1449349276, '2015-12-05 15:01:16', 'admin', 'Se agregÃ³ el proyecto: '),
(1449349310, '2015-12-05 15:01:50', 'admin', 'Se agregÃ³ el proyecto: '),
(1449351361, '2015-12-05 15:36:01', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449351375, '2015-12-05 15:36:15', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449354190, '2015-12-05 16:23:10', 'admin', 'Se modificÃ³ el curso TM4400 Imagen en Movimiento'),
(1449354212, '2015-12-05 16:23:32', 'admin', 'Se modificÃ³ el curso TM4400 Imagen en Movimiento'),
(1449355333, '2015-12-05 16:42:13', 'admin', 'Se modificÃ³ el curso TM4200 Diseno Grafico para Multimedia'),
(1449355944, '2015-12-05 16:52:24', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449356848, '2015-12-05 17:07:28', 'admin', 'Se eliminÃ³ el proyecto id: 15'),
(1449356857, '2015-12-05 17:07:37', 'admin', 'Se eliminÃ³ el proyecto id: 11'),
(1449356864, '2015-12-05 17:07:44', 'admin', 'Se eliminÃ³ el proyecto id: 12'),
(1449356879, '2015-12-05 17:07:59', 'admin', 'Se agregÃ³ el proyecto: Social'),
(1449356897, '2015-12-05 17:08:17', 'admin', 'Se agregÃ³ el proyecto: Cultural'),
(1449356943, '2015-12-05 17:09:03', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449356977, '2015-12-05 17:09:37', 'admin', 'Se agregÃ³ el proyecto: Investigacion'),
(1449357226, '2015-12-05 17:13:46', 'admin', 'Se eliminÃ³ el proyecto id: 18'),
(1449357245, '2015-12-05 17:14:05', 'admin', 'Se agregÃ³ el proyecto: Investigacion'),
(1449357261, '2015-12-05 17:14:21', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449357351, '2015-12-05 17:15:51', 'admin', 'Se modificÃ³ el proyecto: Investigacion'),
(1449357371, '2015-12-05 17:16:11', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449358046, '2015-12-05 17:27:26', 'admin', 'Se modificÃ³ el proyecto: Investigacion'),
(1449358246, '2015-12-05 17:30:46', 'admin', 'Se eliminÃ³ el proyecto id: 19'),
(1449359581, '2015-12-05 17:53:01', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449359596, '2015-12-05 17:53:16', 'admin', 'Se eliminÃ³ el proyecto id: 19'),
(1449359718, '2015-12-05 17:55:18', 'admin', 'Se eliminÃ³ el proyecto id: 17'),
(1449362165, '2015-12-05 18:36:05', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449362356, '2015-12-05 18:39:16', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449362858, '2015-12-05 18:47:38', 'admin', 'Se eliminÃ³ el proyecto id: 17'),
(1449363785, '2015-12-05 19:03:05', 'admin', 'Se eliminÃ³ el proyecto id: 17'),
(1449364015, '2015-12-05 19:06:55', 'admin', 'Se eliminÃ³ el proyecto id: 17'),
(1449364088, '2015-12-05 19:08:08', 'admin', 'Se eliminÃ³ el proyecto id: 17'),
(1449364196, '2015-12-05 19:09:56', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449364217, '2015-12-05 19:10:17', 'admin', 'Se eliminÃ³ el proyecto id: 17'),
(1449364250, '2015-12-05 19:10:50', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449364416, '2015-12-05 19:13:36', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449364492, '2015-12-05 19:14:52', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449364507, '2015-12-05 19:15:07', 'admin', 'Se eliminÃ³ el proyecto id: 19'),
(1449365528, '2015-12-05 19:32:08', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449365630, '2015-12-05 19:33:50', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449365700, '2015-12-05 19:35:00', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449365708, '2015-12-05 19:35:08', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449365729, '2015-12-05 19:35:29', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449365858, '2015-12-05 19:37:38', 'admin', 'Se eliminÃ³ el proyecto id: 19'),
(1449365954, '2015-12-05 19:39:14', 'admin', 'Se eliminÃ³ el proyecto id: 19'),
(1449365983, '2015-12-05 19:39:43', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449366103, '2015-12-05 19:41:43', 'admin', 'Se eliminÃ³ el proyecto id: 19'),
(1449366477, '2015-12-05 19:47:57', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449366672, '2015-12-05 19:51:12', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449366707, '2015-12-05 19:51:47', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449366719, '2015-12-05 19:51:59', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449366734, '2015-12-05 19:52:14', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449366751, '2015-12-05 19:52:31', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449366787, '2015-12-05 19:53:07', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449366809, '2015-12-05 19:53:29', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449366940, '2015-12-05 19:55:40', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449366949, '2015-12-05 19:55:49', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449368507, '2015-12-05 20:21:47', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449368519, '2015-12-05 20:21:59', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449368528, '2015-12-05 20:22:08', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449368849, '2015-12-05 20:27:29', 'admin', 'Se eliminÃ³ el proyecto id: 17'),
(1449370188, '2015-12-05 20:49:48', 'admin', 'Se agregÃ³ el presupuesto: Extraordinario'),
(1449370554, '2015-12-05 20:55:54', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449373523, '2015-12-05 21:45:23', 'admin', 'Se eliminÃ³ el proyecto id: 17'),
(1449373616, '2015-12-05 21:46:56', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449373862, '2015-12-05 21:51:02', 'admin', 'Se eliminÃ³ el proyecto id: 19'),
(1449373980, '2015-12-05 21:53:00', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449373993, '2015-12-05 21:53:13', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449374052, '2015-12-05 21:54:12', 'admin', 'Se eliminÃ³ el proyecto id: 16'),
(1449374092, '2015-12-05 21:54:52', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449375467, '2015-12-05 22:17:47', 'admin', 'Se eliminÃ³ el proyecto id: '),
(1449375479, '2015-12-05 22:17:59', 'admin', 'Se eliminÃ³ el proyecto id: '),
(1449375567, '2015-12-05 22:19:27', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449376280, '2015-12-05 22:31:20', 'admin', 'Se eliminÃ³ el proyecto id: '),
(1449376817, '2015-12-05 22:40:17', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449376828, '2015-12-05 22:40:28', 'admin', 'Se eliminÃ³ el proyecto id: '),
(1449380387, '2015-12-05 23:39:47', 'admin', 'Se agregÃ³ el presupuesto: xx'),
(1449380399, '2015-12-05 23:39:59', 'admin', 'Se eliminÃ³ el presupuesto id: 4'),
(1449380941, '2015-12-05 23:49:01', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449381217, '2015-12-05 23:53:37', 'admin', 'Se agregÃ³ el presupuesto: ee'),
(1449381354, '2015-12-05 23:55:54', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449381664, '2015-12-06 00:01:04', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449381689, '2015-12-06 00:01:29', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449381873, '2015-12-06 00:04:33', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449381931, '2015-12-06 00:05:31', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382086, '2015-12-06 00:08:06', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382110, '2015-12-06 00:08:30', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382138, '2015-12-06 00:08:58', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382207, '2015-12-06 00:10:07', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382336, '2015-12-06 00:12:16', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382368, '2015-12-06 00:12:48', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382581, '2015-12-06 00:16:21', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382613, '2015-12-06 00:16:53', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382648, '2015-12-06 00:17:28', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382711, '2015-12-06 00:18:31', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382737, '2015-12-06 00:18:57', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382753, '2015-12-06 00:19:13', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382821, '2015-12-06 00:20:21', 'admin', 'Se agregÃ³ el presupuesto: '),
(1449382997, '2015-12-06 00:23:17', 'admin', 'Se agregÃ³ el presupuesto: ww'),
(1449383056, '2015-12-06 00:24:16', 'admin', 'Se eliminÃ³ el presupuesto id: 23'),
(1449417549, '2015-12-06 09:59:09', 'admin', 'Se agregÃ³ el presupuesto: rr'),
(1449417837, '2015-12-06 10:03:57', 'admin', 'Se modificÃ³ el presupuesto: rr'),
(1449417854, '2015-12-06 10:04:14', 'admin', 'Se modificÃ³ el presupuesto: rr'),
(1449417894, '2015-12-06 10:04:54', 'admin', 'Se modificÃ³ el presupuesto: rr'),
(1449418021, '2015-12-06 10:07:01', 'admin', 'Se modificÃ³ el presupuesto: rr'),
(1449418514, '2015-12-06 10:15:14', 'admin', 'Se modificÃ³ el presupuesto: Ordinario'),
(1449418539, '2015-12-06 10:15:39', 'admin', 'Se modificÃ³ el presupuesto: rr'),
(1449418660, '2015-12-06 10:17:40', 'admin', 'Se eliminÃ³ el presupuesto id: 4'),
(1449418991, '2015-12-06 10:23:11', 'admin', 'Se agregÃ³ el presupuesto: cc'),
(1449420503, '2015-12-06 10:48:23', 'admin', 'Se eliminÃ³ el presupuesto id: 5'),
(1449420514, '2015-12-06 10:48:34', 'admin', 'Se agregÃ³ el presupuesto: qq'),
(1449420544, '2015-12-06 10:49:04', 'admin', 'Se ha asignado un presupuesto a un proyecto: '),
(1449420581, '2015-12-06 10:49:41', 'admin', 'Se eliminÃ³ el proyecto id: '),
(1449420591, '2015-12-06 10:49:51', 'admin', 'Se eliminÃ³ el presupuesto id: 6'),
(1449420974, '2015-12-06 10:56:14', 'admin', 'Se agregÃ³ el presupuesto: aa'),
(1449421024, '2015-12-06 10:57:04', 'admin', 'Se agregÃ³ el docente 33334 pedrito con permiso'),
(1449421084, '2015-12-06 10:58:04', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: 33334'),
(1449421096, '2015-12-06 10:58:16', 'admin', 'Se eliminÃ³ el presupuesto id: 7'),
(1449422074, '2015-12-06 11:14:34', 'admin', 'Se agregÃ³ el presupuesto: aa'),
(1449422176, '2015-12-06 11:16:16', 'admin', 'Se eliminÃ³ el presupuesto id: 8'),
(1449422606, '2015-12-06 11:23:26', 'admin', 'Se agregÃ³ el presupuesto: tt'),
(1449422622, '2015-12-06 11:23:42', 'admin', 'Se eliminÃ³ el presupuesto id: '),
(1449422721, '2015-12-06 11:25:21', 'admin', 'Se agregÃ³ el presupuesto: qq'),
(1449422740, '2015-12-06 11:25:40', 'admin', 'Se eliminÃ³ el presupuesto '),
(1449422858, '2015-12-06 11:27:38', 'admin', 'Se agregÃ³ el presupuesto: gg'),
(1449422866, '2015-12-06 11:27:46', 'admin', 'Se eliminÃ³ el presupuesto '),
(1449423003, '2015-12-06 11:30:03', 'admin', 'Se agregÃ³ el presupuesto: cc'),
(1449423016, '2015-12-06 11:30:16', 'admin', 'Se eliminÃ³ el presupuesto '),
(1449423038, '2015-12-06 11:30:38', 'admin', 'Se agregÃ³ el presupuesto: vv'),
(1449423101, '2015-12-06 11:31:41', 'admin', 'Se eliminÃ³ el presupuesto vv'),
(1449423242, '2015-12-06 11:34:02', 'admin', 'Se agregÃ³ el presupuesto: ss con 74 3/4 tiempos'),
(1449423368, '2015-12-06 11:36:08', 'admin', 'Se agregÃ³ el presupuesto: ss con 15 5/8 tiempos.'),
(1449423394, '2015-12-06 11:36:34', 'admin', 'Se eliminÃ³ el presupuesto ss.'),
(1449423530, '2015-12-06 11:38:50', 'admin', 'Se modificÃ³ el presupuesto: '),
(1449423576, '2015-12-06 11:39:36', 'admin', 'Se modificÃ³ el presupuesto: ss'),
(1449426264, '2015-12-06 12:24:24', 'admin', 'Se agregÃ³ el presupuesto: zz con 1/8 tiempos.'),
(1449426292, '2015-12-06 12:24:52', 'admin', 'Se agregÃ³ el docente 123123123 prueba para presupuesto s'),
(1449426354, '2015-12-06 12:25:54', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: 123123123'),
(1449426415, '2015-12-06 12:26:55', 'admin', 'Se agregÃ³ el docente PRUABA A A'),
(1449426433, '2015-12-06 12:27:13', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: PRUABA'),
(1449426648, '2015-12-06 12:30:48', 'admin', 'Se eliminÃ³ el presupuesto ss.'),
(1449427185, '2015-12-06 12:39:45', 'admin', 'Se agregÃ³ el docente qwe qwe we'),
(1449427532, '2015-12-06 12:45:32', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: qwe'),
(1449427585, '2015-12-06 12:46:25', 'admin', 'Se eliminÃ³ el presupuesto zz.'),
(1449427604, '2015-12-06 12:46:44', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: 123'),
(1449427611, '2015-12-06 12:46:51', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: 44'),
(1449427619, '2015-12-06 12:46:59', 'admin', 'Se eliminÃ³ el presupuesto Ordinario.'),
(1449427627, '2015-12-06 12:47:07', 'admin', 'Se eliminÃ³ el presupuesto Extraordinario.'),
(1449427800, '2015-12-06 12:50:00', 'admin', 'Se agregÃ³ el presupuesto: PO normal con 1/8 tiempos.'),
(1449427980, '2015-12-06 12:53:00', 'admin', 'Se agregÃ³ el docente 12213 Maria Carmen'),
(1449428021, '2015-12-06 12:53:41', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: 12213'),
(1449428131, '2015-12-06 12:55:31', 'admin', 'Se eliminÃ³ el presupuesto PO normal.'),
(1449428149, '2015-12-06 12:55:49', 'admin', 'Se agregÃ³ el presupuesto: POhh con 1/8 tiempos.'),
(1449428181, '2015-12-06 12:56:21', 'admin', 'Se agregÃ³ el docente rrrerere rr rrr'),
(1449428199, '2015-12-06 12:56:39', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: rrrerere'),
(1449428379, '2015-12-06 12:59:39', 'admin', 'Se eliminÃ³ el presupuesto POhh.'),
(1449428487, '2015-12-06 13:01:27', 'admin', 'Se agregÃ³ el presupuesto: PO tt con 1/8 tiempos.'),
(1449428507, '2015-12-06 13:01:47', 'admin', 'Se agregÃ³ el docente ASDA2 ASD AS'),
(1449428527, '2015-12-06 13:02:07', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: ASDA2'),
(1449428899, '2015-12-06 13:08:19', 'admin', 'Se eliminÃ³ el presupuesto PO tt.'),
(1449428915, '2015-12-06 13:08:35', 'admin', 'Se agregÃ³ el presupuesto: PO con 1/2 tiempos.'),
(1449428939, '2015-12-06 13:08:59', 'admin', 'Se agregÃ³ el docente ll Maria Carmes'),
(1449428953, '2015-12-06 13:09:13', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: ll'),
(1449428980, '2015-12-06 13:09:40', 'admin', 'Se eliminÃ³ el presupuesto PO.'),
(1449428993, '2015-12-06 13:09:53', 'admin', 'Se agregÃ³ el presupuesto: PO con 1/2 tiempos.'),
(1449429028, '2015-12-06 13:10:28', 'admin', 'Se agregÃ³ el docente ODNO MARI APE'),
(1449429131, '2015-12-06 13:12:11', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: ODNO'),
(1449429185, '2015-12-06 13:13:05', 'admin', 'Se agregÃ³ el docente werll MAS ASD'),
(1449429200, '2015-12-06 13:13:20', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: werll'),
(1449429245, '2015-12-06 13:14:05', 'admin', 'Se agregÃ³ el docente QD SD ASD'),
(1449429259, '2015-12-06 13:14:19', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: QD'),
(1449429331, '2015-12-06 13:15:31', 'admin', 'Se eliminÃ³ el presupuesto PO.'),
(1449429345, '2015-12-06 13:15:45', 'admin', 'Se agregÃ³ el presupuesto: PO con 1/2 tiempos.'),
(1449429361, '2015-12-06 13:16:01', 'admin', 'Se agregÃ³ el docente mnbv MARIA R'),
(1449429375, '2015-12-06 13:16:15', 'admin', 'Se eliminÃ³ el docente con la cÃ©dula: mnbv');

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
  `habilitado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Usuario`
--

INSERT INTO `tb_Usuario` (`usuario`, `contrasena`, `nombre_usuario`, `apellido_usuario`, `perfil`, `correo_usuario`, `habilitado`) VALUES
('a', '202cb962ac59075b964b07152d234b70', 'a', 'a', 1, 'ada@sda.com', 1),
('admin', '202cb962ac59075b964b07152d234b70', 'Administrador', 'del SIstema', 0, 'prueba@prueba.com', 1),
('b', '202cb962ac59075b964b07152d234b70', 'bbbbb', 'bbbb', 1, 'bb@b.bb', 0),
('francisco', '202cb962ac59075b964b07152d234b70', 'Francisco', 'Melï¿½ndez', 0, 'a@a.com', 1),
('user-docencia', '202cb962ac59075b964b07152d234b70', 'Nombre', 'Apellido1 apellido2 ', 1, 'ada@sda.com', 1),
('user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'recursos', 'humanos', 2, 'ada@sda.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_Carrera`
--
ALTER TABLE `tb_Carrera`
 ADD PRIMARY KEY (`id_Carrera`);

--
-- Indices de la tabla `tb_Cursos`
--
ALTER TABLE `tb_Cursos`
 ADD PRIMARY KEY (`sigla`);

--
-- Indices de la tabla `tb_Docente`
--
ALTER TABLE `tb_Docente`
 ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `tb_DocenteConPermiso`
--
ALTER TABLE `tb_DocenteConPermiso`
 ADD PRIMARY KEY (`cedula`), ADD KEY `fk_presupuesto` (`fk_presupuesto`);

--
-- Indices de la tabla `tb_estadoDatos`
--
ALTER TABLE `tb_estadoDatos`
 ADD PRIMARY KEY (`id_estadoDatos`);

--
-- Indices de la tabla `tb_Grupos`
--
ALTER TABLE `tb_Grupos`
 ADD PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`);

--
-- Indices de la tabla `tb_GruposDocentes`
--
ALTER TABLE `tb_GruposDocentes`
 ADD PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`fk_docente`);

--
-- Indices de la tabla `tb_GruposHorarios`
--
ALTER TABLE `tb_GruposHorarios`
 ADD PRIMARY KEY (`fk_carrera`,`fk_curso`,`num_grupo`,`dia_semana`,`hora_inicio`);

--
-- Indices de la tabla `tb_Log`
--
ALTER TABLE `tb_Log`
 ADD PRIMARY KEY (`utc`);

--
-- Indices de la tabla `tb_Mensaje`
--
ALTER TABLE `tb_Mensaje`
 ADD PRIMARY KEY (`id_mensaje`), ADD KEY `emisor` (`emisor`), ADD KEY `receptor` (`receptor`);

--
-- Indices de la tabla `tb_Presupuesto`
--
ALTER TABLE `tb_Presupuesto`
 ADD PRIMARY KEY (`id_presupuesto`);

--
-- Indices de la tabla `tb_PresupuestoDocente`
--
ALTER TABLE `tb_PresupuestoDocente`
 ADD PRIMARY KEY (`fk_proyecto`), ADD KEY `fk_id_presupuesto` (`fk_id_presupuesto`), ADD KEY `fk_docente` (`fk_docente`);

--
-- Indices de la tabla `tb_Proyectos`
--
ALTER TABLE `tb_Proyectos`
 ADD PRIMARY KEY (`id_proyecto`), ADD KEY `fk_encargado` (`fk_encargado`), ADD KEY `fk_ayudante` (`fk_ayudante`);

--
-- Indices de la tabla `tb_RegistroActividad`
--
ALTER TABLE `tb_RegistroActividad`
 ADD PRIMARY KEY (`utc`), ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `tb_Usuario`
--
ALTER TABLE `tb_Usuario`
 ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_Mensaje`
--
ALTER TABLE `tb_Mensaje`
MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `tb_Presupuesto`
--
ALTER TABLE `tb_Presupuesto`
MODIFY `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `tb_Proyectos`
--
ALTER TABLE `tb_Proyectos`
MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_DocenteConPermiso`
--
ALTER TABLE `tb_DocenteConPermiso`
ADD CONSTRAINT `tb_DocenteConPermiso_ibfk_1` FOREIGN KEY (`fk_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`);

--
-- Filtros para la tabla `tb_Mensaje`
--
ALTER TABLE `tb_Mensaje`
ADD CONSTRAINT `tb_Mensaje_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `tb_Usuario` (`usuario`),
ADD CONSTRAINT `tb_Mensaje_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `tb_Usuario` (`usuario`);

--
-- Filtros para la tabla `tb_PresupuestoDocente`
--
ALTER TABLE `tb_PresupuestoDocente`
ADD CONSTRAINT `tb_PresupuestoDocente_ibfk_1` FOREIGN KEY (`fk_docente`) REFERENCES `tb_Docente` (`cedula`),
ADD CONSTRAINT `tb_PresupuestoDocente_ibfk_2` FOREIGN KEY (`fk_id_presupuesto`) REFERENCES `tb_Presupuesto` (`id_presupuesto`);

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
