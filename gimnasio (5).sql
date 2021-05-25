-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2021 a las 14:53:23
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gimnasio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuntados`
--

CREATE TABLE `apuntados` (
  `dniMatriculado` varchar(9) NOT NULL,
  `idHorario` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `apuntados`
--

INSERT INTO `apuntados` (`dniMatriculado`, `idHorario`) VALUES
('31744838J', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `idClase` varchar(2) NOT NULL,
  `dniMonitor` varchar(9) DEFAULT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`idClase`, `dniMonitor`, `nombre`) VALUES
('k1', '84666733P', 'kickboxing'),
('p1', NULL, 'pilates'),
('y1', NULL, 'yoga'),
('z1', NULL, 'zumba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `nombreSpec` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`nombreSpec`) VALUES
('coach'),
('dance'),
('full body'),
('mindfulness');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(6) NOT NULL,
  `idClase` varchar(2) NOT NULL,
  `dia` enum('lunes','martes','miercoles','jueves','viernes','sabado','domingo') NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `idClase`, `dia`, `horaInicio`, `horaFin`) VALUES
(1, 'k1', 'lunes', '11:00:00', '12:00:00'),
(2, 'p1', 'miercoles', '16:00:00', '17:00:00'),
(3, 'z1', 'martes', '08:00:00', '09:00:00'),
(5, 'z1', 'viernes', '08:00:00', '09:00:00'),
(6, 'y1', 'jueves', '18:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idMsg` int(9) NOT NULL,
  `fromMsg` varchar(9) NOT NULL,
  `toMsg` varchar(9) NOT NULL,
  `mensaje` longtext NOT NULL,
  `fechaMsg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`idMsg`, `fromMsg`, `toMsg`, `mensaje`, `fechaMsg`) VALUES
(1, '11111111T', '31744838J', 'hola', '2021-05-11 09:21:49'),
(2, '31744838J', '11111111T', 'hola, que tal?', '2021-05-11 09:22:26'),
(3, '48990033K', '84666733P', 'buenos dias', '2021-05-11 09:39:03'),
(4, '84666733P', '48990033K', 'buenas que necesita?', '2021-05-11 09:39:21'),
(5, '11111111T', '55747383B', 'que me recomienda?', '2021-05-11 09:39:35'),
(6, '55747383B', '11111111T', 'que se calle', '2021-05-11 09:39:47'),
(7, '11111111T', '31744838J', 'bien', '2021-05-11 09:41:54'),
(8, '11111111T', '84666733P', 'hey', '2021-05-11 11:37:44'),
(13, '84666733P', '11111111T', 'hola Saul', '2021-05-17 13:03:37'),
(14, '11111111T', '84666733P', 'he estado en su clase y me ha parecido muy buena', '2021-05-21 11:51:37'),
(21, '84666733P', '11111111T', 'gracias', '2021-05-21 11:57:11'),
(22, '84666733P', '11111111T', 'te veo en la proxima :)', '2021-05-21 11:57:18'),
(23, '11111111T', '84666733P', 'perfecto', '2021-05-21 12:36:14'),
(25, '11111111T', '37855822G', 'hola', '2021-05-21 13:04:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitorspec`
--

CREATE TABLE `monitorspec` (
  `idMonitor` int(6) NOT NULL,
  `nombreSpec` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `monitorspec`
--

INSERT INTO `monitorspec` (`idMonitor`, `nombreSpec`) VALUES
(1, 'coach'),
(1, 'full body'),
(2, 'dance'),
(3, 'full body'),
(4, 'mindfulness');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apuntados`
--
ALTER TABLE `apuntados`
  ADD PRIMARY KEY (`dniMatriculado`,`idHorario`),
  ADD KEY `idClase` (`idHorario`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`idClase`),
  ADD KEY `dniMonitor` (`dniMonitor`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`nombreSpec`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idClase` (`idClase`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idMsg`),
  ADD KEY `fromMsg` (`fromMsg`,`toMsg`),
  ADD KEY `toMsg` (`toMsg`);

--
-- Indices de la tabla `monitorspec`
--
ALTER TABLE `monitorspec`
  ADD PRIMARY KEY (`idMonitor`,`nombreSpec`),
  ADD KEY `nombreSpec` (`nombreSpec`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idMsg` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apuntados`
--
ALTER TABLE `apuntados`
  ADD CONSTRAINT `apuntados_ibfk_2` FOREIGN KEY (`dniMatriculado`) REFERENCES `matriculados` (`dniMatriculado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apuntados_ibfk_3` FOREIGN KEY (`idHorario`) REFERENCES `horarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`dniMonitor`) REFERENCES `monitores` (`dniMonitor`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`idClase`) REFERENCES `clases` (`idClase`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`fromMsg`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`toMsg`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monitorspec`
--
ALTER TABLE `monitorspec`
  ADD CONSTRAINT `monitorspec_ibfk_1` FOREIGN KEY (`nombreSpec`) REFERENCES `especialidades` (`nombreSpec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitorspec_ibfk_2` FOREIGN KEY (`idMonitor`) REFERENCES `monitores` (`idMonitor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
