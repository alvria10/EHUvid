-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2020 a las 03:48:19
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`nombre`, `codigo`, `estado`, `aula`) VALUES
('Técnicas de Inteligencia artificial', 1, 'Presencial', 'P3I10A'),
('Análisis y Diseño de Sistemas de Información', 2, 'Online', 'P2I5A'),
('Aspectos Profesionales de la Informática', 3, 'Online', 'P3I10A'),
('Minería de Datos', 4, 'Presencial', 'P4M5A');

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

--
-- Volcado de datos para la tabla `notificacionfecha`
--

INSERT INTO `notificacionfecha` (`ldapprofesor`, `fecha`, `codigoasignatura`, `mensaje`) VALUES
('456789', '2020-11-15', 1, 'No habrá laboratorio el jueves.'),
('456789', '2020-11-16', 1, 'No habrá laboratorio este martes.'),
('123456', '2020-11-17', 2, 'Exámen parcial el jueves a las 9:00 (llevar DNI o carnet universitario)'),
('667755', '2020-11-17', 3, 'Retraso en la clase del miércoles'),
('772255', '2020-11-09', 4, 'Suspendida la práctica de esta semana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ldap` varchar(20) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ldap`, `contrasena`, `estado`, `nombre`, `apellidos`) VALUES
('', '$2y$10$dRLvbXQPuTn575ZLYQACheDdtX5rHPiNQX8VTvoYgDQrDwkUs1nbK', 'negativo', '', ''),
('000000', '$2y$10$aB8HI0ixZJEj2/Rf0WfID.Cd3ZirgwnIl.6.bArbaE/wpy0aHaRQu', 'negativo', 'admin', 'admin'),
('833705', '$2y$10$bKfH9m0BQMKJNP8lZU9dTeKJtRzImharEzdb8c8zId076rSWmQZNO', 'negativo', 'Víctor', 'Núñez González'),
('889977', '$2y$10$/aCtS8z8my27Fe4KDPfl/uDEfdN6lm.IT65MIYTJ2cGvlV4U.UOYe', 'negativo', 'Antonio', 'Puertas Uriarte'),
('999999', '$2y$10$NOayCUQkx34Oh/lFqvWAkuEtKNbnLazgA31KwRDCAwnEQAIYXJSRy', 'positivo', 'Mikel', 'Etxebarria García');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioyasignatura`
--

CREATE TABLE `usuarioyasignatura` (
  `ldap` varchar(30) NOT NULL,
  `codigoasignatura` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarioyasignatura`
--

INSERT INTO `usuarioyasignatura` (`ldap`, `codigoasignatura`) VALUES
('833705', 1),
('833705', 2),
('833705', 3),
('889977', 3),
('889977', 4),
('999999', 1),
('999999', 4);

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
