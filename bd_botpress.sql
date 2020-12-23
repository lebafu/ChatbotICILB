-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-12-2020 a las 14:08:54
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_botpress`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `answer`
--

INSERT INTO `answer` (`id`, `nombre`) VALUES
(1, '#!builtin_image-Za01G8'),
(2, 'Esta información está en este link : https://www.gob.cl/coronavirus/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nlu_name`
--

CREATE TABLE `nlu_name` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nlu_name`
--

INSERT INTO `nlu_name` (`id`, `nombre`) VALUES
(1, 'contacto-carrera'),
(2, 'despedida'),
(3, 'mallas'),
(4, 'perfil-de-egreso\r\n'),
(5, 'renunciar'),
(6, 'sitio-web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nlu_questions`
--

CREATE TABLE `nlu_questions` (
  `id` int(11) NOT NULL,
  `respuestas` varchar(200) NOT NULL,
  `nlu_name_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nlu_questions`
--

INSERT INTO `nlu_questions` (`id`, `respuestas`, `nlu_name_id`) VALUES
(1, 'despedida', 2),
(2, 'Adióooos', 2),
(3, 'Que estés bien', 2),
(4, 'Chao', 2),
(5, 'Cuidate', 2),
(6, 'byeeee byeeee', 2),
(7, 'Despedida', 2),
(8, 'Hasta mañana', 2),
(9, 'que estés bien', 2),
(10, 'chao', 2),
(11, 'cuidate', 2),
(12, 'Contacto carrera', 1),
(13, 'Necesito información de contactos de mi carrera', 1),
(14, 'Contactarme con jefe de carrera', 1),
(15, 'Contacto de secretaria de carrera', 1),
(16, 'Correo electrónico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(100) NOT NULL,
  `id_answers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id`, `pregunta`, `id_answers`) VALUES
(1, '¿Donde está ubicada mi sala?', 1),
(2, 'Necesito encontrar una sala', 1),
(3, 'Quiero ver algun mapa del campus', 1),
(4, 'Plano del campus', 1),
(5, 'Recursos contra el Covid-19', 2),
(6, 'Necesito información sobre lo que se hace contra el Covid-19', 2),
(7, 'Prevencion del Coronavirus-19', 2),
(8, 'Covid-19', 2),
(9, '¿Hay información sobre el Covid-19?', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nlu_name`
--
ALTER TABLE `nlu_name`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nlu_questions`
--
ALTER TABLE `nlu_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nlu_name_id` (`nlu_name_id`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_answers` (`id_answers`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nlu_name`
--
ALTER TABLE `nlu_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nlu_questions`
--
ALTER TABLE `nlu_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `nlu_questions`
--
ALTER TABLE `nlu_questions`
  ADD CONSTRAINT `nlu_questions_ibfk_1` FOREIGN KEY (`nlu_name_id`) REFERENCES `nlu_name` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`id_answers`) REFERENCES `answer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
