-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2025 a las 19:53:07
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
-- Base de datos: `bd_cotizacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `pais_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id`, `localidad`, `cp`, `provincia_id`, `pais_id`, `created_at`, `updated_at`) VALUES
(1, 'Monte Buey', '2589', 1, 1, '2025-04-26 17:52:31', NULL),
(2, 'Irriville', '2587', 1, 1, '2025-04-26 17:52:31', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `localidad_localidad_unique` (`localidad`),
  ADD KEY `localidad_provincia_id_foreign` (`provincia_id`),
  ADD KEY `localidad_pais_id_foreign` (`pais_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `localidad_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`),
  ADD CONSTRAINT `localidad_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
