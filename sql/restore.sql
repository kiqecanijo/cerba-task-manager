-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2016 a las 07:23:53
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cerba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrier`
--

CREATE TABLE `carrier` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `college` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `college`) VALUES
(2, 'Matematicas', 5),
(3, 'Historia', 4),
(4, 'Filosofia', 7),
(5, 'Literatura', 9),
(7, 'humanidades', 6),
(8, 'Lenguas extrangeras', 5),
(9, 'Historia del Arte', 7),
(10, 'Actuaria', 6),
(59, 'electronica', 81),
(60, 'Agronomia', 83),
(61, 'agricultura', 84),
(66, 'MatemÃ¡ticas Aplicadas y ComputaciÃ³n', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `college`
--

CREATE TABLE `college` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `college`
--

INSERT INTO `college` (`id`, `name`) VALUES
(4, 'CCH ascapozalco'),
(3, 'CCH Naucalpan'),
(12, 'Colegio de bachilleres 19 aeropuerto'),
(5, 'Colegio de Bachilleres plantel 20 del valle'),
(82, 'colegio de ciencias y humanidades 6'),
(7, 'Colegio de Ciencias Y humanidades 7'),
(84, 'colegio Miguel de Cerbantes'),
(9, 'Facultad de estudios superiores Aragon'),
(10, 'FES acatlan'),
(8, 'FES Izatacala'),
(81, 'matiasRomero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE `subject` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `carrier` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`id`, `name`, `carrier`) VALUES
(1, 'Redes', 2),
(12, 'ingles', 5),
(13, 'aleman', 2),
(14, 'calculo', 4),
(15, 'algoritmos', 3),
(16, 'seminario etica', 4),
(17, 'literatura', 2),
(18, 'Historia de mexico', 10),
(19, 'Ruso', 4),
(20, 'Ensenanza del menor', 4),
(21, 'Educacion especial', 4),
(56, 'Educacion especial superior', 59),
(62, 'derecho penal', 2),
(63, 'Hortalizas', 60),
(64, 'estudio del suelo', 61),
(69, 'IngenierÃ­a de Software', 66);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task`
--

CREATE TABLE `task` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `subject` int(255) NOT NULL,
  `date` bigint(255) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `task`
--

INSERT INTO `task` (`id`, `name`, `user`, `subject`, `date`, `descripcion`, `status`, `visible`) VALUES
(76, 'jh', 59, 20, 1484283600000, 'mk', 1, 1),
(77, 'Maqueta', 59, 18, 1480521600000, 'Hacer', 1, 1),
(81, 'klmÃ±k', 57, 66, 1479877200000, 'knk,', 1, 1);
----------------------------------------------------------
--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `lastnamea` varchar(20) NOT NULL,
  `lastnameb` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `type`, `email`, `pass`, `lastnamea`, `lastnameb`) VALUES
(55, 'Enrique', 1, 'test@enrique.com', 'qwert123', 'eSerrano', 'Teran');

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `college` (`college`);

--
-- Indices de la tabla `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `subject` (`carrier`);

--
-- Indices de la tabla `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `user` (`user`),
  ADD KEY `subject` (`subject`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `college`
--
ALTER TABLE `college`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT de la tabla `task`
--
ALTER TABLE `task`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrier`
--
ALTER TABLE `carrier`
  ADD CONSTRAINT `carrier_ibfk_1` FOREIGN KEY (`college`) REFERENCES `college` (`id`);

--
-- Filtros para la tabla `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`carrier`) REFERENCES `carrier` (`id`);

--
-- Filtros para la tabla `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
