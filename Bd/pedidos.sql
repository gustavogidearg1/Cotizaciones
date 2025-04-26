-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2025 a las 19:51:53
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
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo_pedido_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `fecha` date NOT NULL,
  `fecha_necesidad` date NOT NULL,
  `forma_pago_id` bigint(20) UNSIGNED NOT NULL,
  `forma_entrega` varchar(255) NOT NULL,
  `plazo_entrega` varchar(100) DEFAULT NULL,
  `solicitante` varchar(100) NOT NULL,
  `observacion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen_2` varchar(255) DEFAULT NULL,
  `flete_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bonificacion` decimal(5,2) NOT NULL DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cliente` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `localidad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provincia_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pais_id` bigint(20) UNSIGNED DEFAULT 1,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `categoria_id` bigint(20) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_forma_pago_id_foreign` (`forma_pago_id`),
  ADD KEY `pedidos_user_id_foreign` (`user_id`),
  ADD KEY `pedidos_tipo_pedido_id_foreign` (`tipo_pedido_id`),
  ADD KEY `pedidos_flete_id_foreign` (`flete_id`),
  ADD KEY `pedidos_localidad_id_foreign` (`localidad_id`),
  ADD KEY `pedidos_provincia_id_foreign` (`provincia_id`),
  ADD KEY `pedidos_pais_id_foreign` (`pais_id`),
  ADD KEY `pedidos_categoria_id_foreign` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `pedidos_flete_id_foreign` FOREIGN KEY (`flete_id`) REFERENCES `fletes` (`id`),
  ADD CONSTRAINT `pedidos_forma_pago_id_foreign` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pagos` (`id`),
  ADD CONSTRAINT `pedidos_localidad_id_foreign` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`),
  ADD CONSTRAINT `pedidos_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`),
  ADD CONSTRAINT `pedidos_provincia_id_foreign` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`),
  ADD CONSTRAINT `pedidos_tipo_pedido_id_foreign` FOREIGN KEY (`tipo_pedido_id`) REFERENCES `tipo_pedidos` (`id`),
  ADD CONSTRAINT `pedidos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
