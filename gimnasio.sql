-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2021 a las 15:31:32
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
('298774893', 3),
('298774893', 5),
('298774893', 23),
('298774893', 28),
('298774893', 29),
('298774893', 30),
('298774893', 31),
('298774893', 39),
('298774893', 40),
('298774893', 41),
('298774893', 42),
('31744838J', 1),
('31744838J', 22),
('31744838J', 23),
('31744838J', 24),
('31744838J', 44),
('31744838J', 45),
('31744838J', 46),
('398223409', 25),
('398223409', 26),
('398223409', 27),
('398223409', 32),
('398223409', 33),
('398223409', 34),
('398223409', 35),
('398223409', 42),
('48990033K', 37),
('48990033K', 38),
('48990033K', 41),
('678224536', 1),
('678224536', 16),
('678224536', 23),
('678224536', 29),
('678224536', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `idClase` int(6) NOT NULL,
  `dniMonitor` varchar(9) DEFAULT NULL,
  `nombre` varchar(20) NOT NULL,
  `img` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`idClase`, `dniMonitor`, `nombre`, `img`) VALUES
(1, '74556390R', 'kickboxing', 'kickboxing.jpg'),
(2, '84666733P', 'pilates', 'pilates.jpg'),
(3, '37855822G', 'yoga', 'yoga.jpg'),
(4, '55747383B', 'zumba', 'zumba.jpg'),
(19, '90544326M', 'Hipopresivos', 'hipopresivos.jpg'),
(20, '54558785H', 'Total Body', 'totalbody.jpg'),
(21, '74556390R', 'Body Pump', 'bodypump.jpg');

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
('cardio box'),
('ciclo indoor'),
('coach'),
('dance'),
('fitness'),
('full body'),
('funcional'),
('mindfulness');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(6) NOT NULL,
  `idClase` int(6) NOT NULL,
  `dia` enum('lunes','martes','miercoles','jueves','viernes','sabado','domingo') NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `idClase`, `dia`, `horaInicio`, `horaFin`) VALUES
(1, 1, 'lunes', '11:00:00', '12:00:00'),
(3, 4, 'martes', '08:00:00', '09:00:00'),
(5, 4, 'viernes', '08:00:00', '09:00:00'),
(16, 2, 'martes', '10:00:00', '11:00:00'),
(17, 2, 'jueves', '10:00:00', '11:00:00'),
(22, 1, 'miercoles', '11:00:00', '12:00:00'),
(23, 1, 'viernes', '11:00:00', '12:00:00'),
(24, 1, 'sabado', '11:00:00', '12:00:00'),
(25, 20, 'martes', '18:00:00', '19:00:00'),
(26, 20, 'jueves', '18:00:00', '19:00:00'),
(27, 20, 'sabado', '18:00:00', '19:00:00'),
(28, 21, 'lunes', '15:00:00', '16:00:00'),
(29, 21, 'miercoles', '15:00:00', '16:00:00'),
(30, 21, 'viernes', '15:00:00', '16:00:00'),
(31, 21, 'domingo', '15:00:00', '16:00:00'),
(32, 20, 'miercoles', '12:00:00', '13:00:00'),
(33, 20, 'domingo', '12:00:00', '13:00:00'),
(34, 2, 'sabado', '10:00:00', '11:00:00'),
(35, 2, 'domingo', '10:00:00', '11:00:00'),
(36, 19, 'lunes', '20:00:00', '21:00:00'),
(37, 19, 'miercoles', '20:00:00', '21:00:00'),
(38, 19, 'viernes', '20:00:00', '21:00:00'),
(39, 19, 'domingo', '20:00:00', '21:00:00'),
(40, 4, 'miercoles', '08:00:00', '09:00:00'),
(41, 4, 'lunes', '08:00:00', '09:00:00'),
(42, 4, 'jueves', '08:00:00', '09:00:00'),
(43, 3, 'martes', '13:00:00', '14:00:00'),
(44, 3, 'jueves', '13:00:00', '14:00:00'),
(45, 3, 'viernes', '13:00:00', '14:00:00'),
(46, 3, 'sabado', '13:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculados`
--

CREATE TABLE `matriculados` (
  `dniMatriculado` varchar(9) NOT NULL,
  `peso` int(3) DEFAULT NULL,
  `altura` int(3) DEFAULT NULL,
  `imc` float(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matriculados`
--

INSERT INTO `matriculados` (`dniMatriculado`, `peso`, `altura`, `imc`) VALUES
('298774893', 102, 188, 28.86),
('31744838J', 89, 175, 29.06),
('398223409', 66, 174, 21.80),
('48990033K', 120, 180, 37.04),
('675831011', 98, 198, 25.00),
('678224536', 49, 163, 18.44);

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
(3, '48990033K', '84666733P', 'buenos dias', '2021-05-11 09:39:03'),
(4, '84666733P', '48990033K', 'buenas que necesita?', '2021-05-11 09:39:21'),
(36, '84666733P', '55747383B', 'hola maria', '2021-05-26 10:52:57'),
(55, '298774893', '74556390R', 'hola', '2021-06-06 15:18:29'),
(56, '298774893', '84666733P', 'hey', '2021-06-06 15:18:51'),
(60, '298774893', '74556390R', 'que dieta me recomienda?', '2021-06-06 15:19:27'),
(61, '298774893', '84666733P', 'a que hora son sus entrenamientos?', '2021-06-06 15:19:37'),
(62, '74556390R', '298774893', 'una dieta saludable', '2021-06-06 15:19:52'),
(63, '74556390R', '298774893', '5 comidas al dia', '2021-06-06 15:19:57'),
(64, '84666733P', '298774893', 'lo puede ver en el calendario', '2021-06-06 15:20:18'),
(66, '678224536', '37855822G', 'buenas tardes', '2021-06-06 15:21:17'),
(67, '678224536', '37855822G', 'la clase de hoy no podré asistir', '2021-06-06 15:21:36'),
(68, '37855822G', '678224536', 'no pasa nada, para el proximo dia', '2021-06-06 15:21:56'),
(69, '398223409', '54558785H', 'buenas alvaro', '2021-06-06 15:22:44'),
(70, '398223409', '54558785H', 'el coach personal?', '2021-06-06 15:22:52'),
(71, '54558785H', '398223409', 'ese soy yo', '2021-06-06 15:23:05'),
(72, '54558785H', '398223409', 'que necesita?', '2021-06-06 15:23:13'),
(74, '675831011', '90544326M', 'hola', '2021-06-06 15:23:50'),
(75, '675831011', '55747383B', 'buenas tardes', '2021-06-06 15:25:10'),
(76, '675831011', '55747383B', 'la clase de zumba que dias son?', '2021-06-06 15:25:27'),
(77, '90544326M', '675831011', 'buenos dias', '2021-06-06 15:25:46'),
(78, '90544326M', '675831011', 'que necesita?', '2021-06-06 15:25:49'),
(79, '55747383B', '84666733P', 'hola lucia', '2021-06-06 15:26:09'),
(80, '55747383B', '675831011', 'de lunes a viernes a primera hora', '2021-06-06 15:26:33'),
(81, '48990033K', '84666733P', 'consejos para bajar de peso', '2021-06-06 15:27:39'),
(82, '31744838J', '74556390R', 'hola', '2021-06-06 15:28:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitores`
--

CREATE TABLE `monitores` (
  `idMonitor` int(6) NOT NULL,
  `dniMonitor` varchar(9) NOT NULL,
  `titulacion` varchar(20) DEFAULT NULL,
  `img` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `monitores`
--

INSERT INTO `monitores` (`idMonitor`, `dniMonitor`, `titulacion`, `img`) VALUES
(1, '37855822G', 'Fisioterapia', 'david.png'),
(2, '55747383B', 'Master: Farmacologia', 'maria.png'),
(3, '74556390R', 'TAFAZ', 'victor.png'),
(4, '84666733P', 'Psicologia', 'lucia.png'),
(5, '54558785H', 'Master: Musculacion ', 'alvaro.png'),
(7, '90544326M', 'Fisioterapia', 'paula.png');

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
(1, 'cardio box'),
(1, 'coach'),
(1, 'full body'),
(2, 'cardio box'),
(2, 'dance'),
(2, 'funcional'),
(3, 'ciclo indoor'),
(3, 'full body'),
(4, 'dance'),
(4, 'fitness'),
(4, 'mindfulness'),
(5, 'coach'),
(5, 'full body'),
(7, 'fitness'),
(7, 'mindfulness');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `sexo` enum('M','F') NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `telefono` int(9) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `user` varchar(10) NOT NULL,
  `pass` longtext NOT NULL,
  `rol` enum('asistente','matriculado','monitor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellido`, `sexo`, `fechaNacimiento`, `telefono`, `mail`, `user`, `pass`, `rol`) VALUES
('11111111A', 'Guillermo', 'Lopez Fernandez', 'M', '1968-10-28', 666747474, 'asistente@gmail.com', 'asistente', '0a058503bd115da9fbdd7b99ba4ba2cf8abdc0723dea5f80ee05c810d8063091b7fdcd9e9faa642eab24674e257ebf39bcce0dc3f907d8f2d43a2cb1b30249a0', 'asistente'),
('298774893', 'Javier', 'Lorenzo Hernandez', 'M', '1995-08-17', 959448588, 'javier@gmail.com', 'javier', '153db9ded974110844b3dd103ded6aedef5f30538f573d110788a4540fbeaced1256703cd57ae55e2c43b56d796684c902688cdfb31150c3e79dc88bd3ac7402', 'matriculado'),
('31744838J', 'Antonio', 'Ortega Garcia', 'M', '1975-09-02', 669407248, 'antonioog@gmail.com', 'antonio', 'fd639ec6b49abb161161e58505e2479e6a4b6b87b445c65736b692ea5fd7a4ef252e2217c9111940dede5d75e91e7078c80fdd780eb19ae22761335e555f1e32', 'matriculado'),
('37855822G', 'David', 'Garcia Fernandez', 'M', '1989-07-17', 609938500, 'davidgf@gmail.com', 'david', 'e8f069b5f1740011ad6a73ace05529252003d96b098b28fab5d38eaab271c98ce2074e129519544ea8c82acc5c83b2cda96a2fff4124fee743dab9dcc5cd913c', 'monitor'),
('398223409', 'Victoria', 'Perez Garcia', 'F', '1984-02-14', 868584477, 'victoria@gmail.com', 'victoria', 'ef8d306b13328859fdbcbe1e2bff81dacebed27b1e54c36c415c8c2dd97f8917083aa5373933284989e476f0146e737c48fa75e90bf242588a030183efa6939b', 'matriculado'),
('48990033K', 'Alejandro', 'Gonzalez Rivera', 'M', '1995-12-31', 667435465, 'alejandro@gmail.com', 'alejandro', '3f500c961a79e2cc32125ae595581aaa3c598970d2657e2b43da60a184b5b21f4dc040ec6c5462349bc42db91323ca8f4f62a72f0070246ae79072d5158f7d1b', 'matriculado'),
('54558785H', 'Alvaro', 'Gonzalez Mata', 'M', '1991-06-03', 788403032, 'alvaro@gmail.com', 'alvaro', '9e613673d46bc93e87d5f8a1af7f4a3153eca29da7ea36cb1e4b9bfcbb3e054f9da13e7c99c9bd41adf298f61c822ab76be2fb5061d6c3b036675dd3e998780f', 'monitor'),
('55747383B', 'Maria', 'Alonso Prieto', 'F', '1995-04-21', 699050544, 'mariaap@gmail.com', 'maria', 'ddd4c7a7fe38ec9ab1520bd8abcbade25618f4daa9e8660a4aa6b657f3e8af389f8b8734ecd733ec18ea5df8ef290f9276766ef729690a340b35d9511c22d54a', 'monitor'),
('675831011', 'Marcos', 'Manzanar Dominguez', 'M', '2000-07-02', 586889433, 'marcos@gmail.com', 'marcos', '6ef9ee716a00376ab61663fa7187e1288fe373d1bd6160e25e646a028af629f9b34f3ca1ba26eacd8dd1997e85fa4002d01668521e99e3fabfd25d9fc1ea886f', 'matriculado'),
('678224536', 'Yolanda', 'Hernandez Rivas', 'F', '1980-12-27', 577334788, 'yolanda@gmail.com', 'yolanda', '94d9e53ec42df62bedb590cc3fe42afd27e482e34dd3c1c6579a2eea1d352751d48112537d61f340339f12cd2d5b8f1bd2587f8f0a52a97abd30bc08bfd75358', 'matriculado'),
('74556390R', 'Victor', 'Perez Gonzalez', 'M', '1985-08-14', 616235008, 'victorgs@gmail.com', 'victor', '1a327ed06e157a8ef70f0c8f92ad91eea9a5a6028b1c5ffa7f7b305dbe9f6bcac50758708b4cc08c35dd12edbcf2065d4fe49af7f30929489316e50ec374d7bb', 'monitor'),
('84666733P', 'Lucia', 'Gonzalez Salas', 'F', '1998-10-15', 655228312, 'luciags@gmail.com', 'lucia', '7682a4e6a26a14c42d41861b7966687a2a14675f50f091645ab799ca7692f554f6d3f776bdc50762f72117540d46183d17204c5c4367dac477ec7293933102a0', 'monitor'),
('90544326M', 'Paula', 'Romero Lopez', 'F', '1989-12-17', 543557283, 'paula@gmail.com', 'paula', 'f0ae86b9211e4fa016859eaae295fb67df0b1bb4acf6f9a4948075feef898d51eef35c4b0da57940fc7f6b864fe09c2fce6e62fb678b4bae10a96475cfbec92f', 'monitor');

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
-- Indices de la tabla `matriculados`
--
ALTER TABLE `matriculados`
  ADD PRIMARY KEY (`dniMatriculado`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idMsg`),
  ADD KEY `fromMsg` (`fromMsg`,`toMsg`),
  ADD KEY `toMsg` (`toMsg`);

--
-- Indices de la tabla `monitores`
--
ALTER TABLE `monitores`
  ADD PRIMARY KEY (`idMonitor`),
  ADD KEY `dniMonitor` (`dniMonitor`);

--
-- Indices de la tabla `monitorspec`
--
ALTER TABLE `monitorspec`
  ADD PRIMARY KEY (`idMonitor`,`nombreSpec`),
  ADD KEY `nombreSpec` (`nombreSpec`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `idClase` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idMsg` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `monitores`
--
ALTER TABLE `monitores`
  MODIFY `idMonitor` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Filtros para la tabla `matriculados`
--
ALTER TABLE `matriculados`
  ADD CONSTRAINT `matriculados_ibfk_1` FOREIGN KEY (`dniMatriculado`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`fromMsg`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`toMsg`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `monitores`
--
ALTER TABLE `monitores`
  ADD CONSTRAINT `monitores_ibfk_1` FOREIGN KEY (`dniMonitor`) REFERENCES `usuarios` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

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
