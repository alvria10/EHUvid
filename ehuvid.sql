-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2020 a las 16:05:36
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ehuvid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `nombre` varchar(50) NOT NULL,
  `codigo` int(9) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `aula` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horaydia`
--

CREATE TABLE `horaydia` (
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `codigoasignatura` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacionfecha`
--

CREATE TABLE `notificacionfecha` (
  `ldapprofesor` varchar(40) NOT NULL,
  `fecha` date NOT NULL,
  `codigoasignatura` int(9) NOT NULL,
  `mensaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ldap` varchar(20) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ldap`, `contrasena`, `estado`, `nombre`, `apellidos`) VALUES
('700497', '1234', 'negativo', 'diego', 'vesga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioyasignatura`
--

CREATE TABLE `usuarioyasignatura` (
  `ldap` varchar(30) NOT NULL,
  `codigoasignatura` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `horaydia`
--
ALTER TABLE `horaydia`
  ADD PRIMARY KEY (`dia`,`hora`,`codigoasignatura`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ldap`(9));

--
-- Indices de la tabla `usuarioyasignatura`
--
ALTER TABLE `usuarioyasignatura`
  ADD PRIMARY KEY (`ldap`,`codigoasignatura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
