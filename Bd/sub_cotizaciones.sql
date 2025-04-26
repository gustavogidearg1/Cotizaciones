-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2025 a las 01:30:52
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
-- Estructura de tabla para la tabla `sub_cotizaciones`
--

CREATE TABLE `sub_cotizaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `moneda_id` bigint(20) UNSIGNED NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `precio_bonificado` decimal(12,2) NOT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `cotizacion_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sub_cotizaciones`
--

INSERT INTO `sub_cotizaciones` (`id`, `producto_id`, `moneda_id`, `precio`, `precio_bonificado`, `descuento`, `detalle`, `cotizacion_id`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 0.00, 0.00, 0.00, NULL, 2, '2025-04-14 02:02:05', '2025-04-14 02:02:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sub_cotizaciones`
--
ALTER TABLE `sub_cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_cotizaciones_producto_id_foreign` (`producto_id`),
  ADD KEY `sub_cotizaciones_moneda_id_foreign` (`moneda_id`),
  ADD KEY `sub_cotizaciones_cotizacion_id_foreign` (`cotizacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sub_cotizaciones`
--
ALTER TABLE `sub_cotizaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sub_cotizaciones`
--
ALTER TABLE `sub_cotizaciones`
  ADD CONSTRAINT `sub_cotizaciones_cotizacion_id_foreign` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cotizaciones_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cotizaciones_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
