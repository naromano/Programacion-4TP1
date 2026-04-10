-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2026 a las 21:39:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `utn_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_utn`
--

CREATE TABLE `usuarios_utn` (
  `id` bigint(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `bloqueado` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_utn`
--

INSERT INTO `usuarios_utn` (`id`, `usuario`, `clave`, `apellido`, `nombre`, `bloqueado`) VALUES
(1, 'mjmartinez', '123456', 'Martinez', 'Juan', 'N'),
(2, 'rcsiri', '123456', 'SIRI', 'Rocio Cecilia', 'N'),
(3, 'mfsilvestre', '123456', 'SILVESTRE', 'Maria Florencia', 'N'),
(4, 'apessina', '123456', 'PESSINA', 'Alcides Norman', 'N'),
(5, 'mesposito', '123456', 'ESPOSITO', 'Marcela Liliana', 'N'),
(6, 'martinl', 'martin', 'Lepez', 'Martin', 'Y'),
(7, 'martinF', '123456', 'Fernandez', 'martin', 'N');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios_utn`
--
ALTER TABLE `usuarios_utn`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios_utn`
--
ALTER TABLE `usuarios_utn`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
