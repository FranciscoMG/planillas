-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-11-2015 a las 17:38:39
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
  `jornada` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Cursos`
--

INSERT INTO `tb_Cursos` (`sigla`, `nombre_curso`, `creditos`, `jornada`) VALUES
('prueba', 'asdas', 5, 0.25),
('rr', 'rrrr', 2, 0.5),
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
('123', 'Armando', 'apellido', 1, 1),
('1234', 'Sergio', 'apellido', 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_Proyectos`
--

INSERT INTO `tb_Proyectos` (`id_proyecto`, `nombre_proyecto`, `tipo_proyecto`, `jornada_proyecto`, `fk_encargado`, `fk_ayudante`) VALUES
(1, '1', 1, 1, '1', '1'),
(11, 'Pueblo', 1, 0, '1234', '1234'),
(12, 'Arqueologia', 1, 0, '123', '123'),
(15, 'ee', 0, 0.25, '123', '123'),
(16, 'tt', 1, 0.5, '1234', '123');

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
('admin', '202cb962ac59075b964b07152d234b70', 'Pedro', 'Rodriguez', 0, 'asdad@asd.com', 1),
('p1', '202cb962ac59075b964b07152d234b70', 'Vini', 'Rodriguez', 1, 'as@12.com', 1),
('p2', '202cb962ac59075b964b07152d234b70', 'ppp', 'ppp', 1, 'pppp@u.com', 0),
('user-docencia', '202cb962ac59075b964b07152d234b70', 'Carlos', 'Avellanos', 1, 'hdf@s.com', 1),
('user-recursos-humano', '202cb962ac59075b964b07152d234b70', 'Ana', 'Olivares', 2, 'sd@', 1);

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
-- Indices de la tabla `tb_Proyectos`
--
ALTER TABLE `tb_Proyectos`
 ADD PRIMARY KEY (`id_proyecto`), ADD KEY `fk_encargado` (`fk_encargado`), ADD KEY `fk_ayudante` (`fk_ayudante`);

--
-- Indices de la tabla `tb_Usuario`
--
ALTER TABLE `tb_Usuario`
 ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_Proyectos`
--
ALTER TABLE `tb_Proyectos`
MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_Proyectos`
--
ALTER TABLE `tb_Proyectos`
ADD CONSTRAINT `tb_Proyectos_ibfk_1` FOREIGN KEY (`fk_encargado`) REFERENCES `tb_Docente` (`cedula`),
ADD CONSTRAINT `tb_Proyectos_ibfk_2` FOREIGN KEY (`fk_ayudante`) REFERENCES `tb_Docente` (`cedula`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
