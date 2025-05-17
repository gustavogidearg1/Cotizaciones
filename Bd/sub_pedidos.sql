-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2025 a las 18:39:52
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
-- Estructura de tabla para la tabla `sub_pedidos`
--

CREATE TABLE `sub_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `subbonificacion` decimal(5,2) NOT NULL,
  `iva` decimal(5,2) NOT NULL DEFAULT 21.00,
  `cantidad` int(11) NOT NULL,
  `moneda_id` bigint(20) UNSIGNED NOT NULL,
  `sub_fecha_entrega` date NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `detalle` text DEFAULT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sub_pedidos`
--

INSERT INTO `sub_pedidos` (`id`, `producto_id`, `precio`, `subbonificacion`, `iva`, `cantidad`, `moneda_id`, `sub_fecha_entrega`, `subtotal`, `total`, `detalle`, `pedido_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 3, 10000.00, 0.00, 21.00, 1, 1, '2025-05-13', 0.00, 0.00, NULL, 1, 1, '2025-05-14 02:51:26', NULL),
(2, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 4, 1, '2025-05-17 18:16:54', '2025-05-17 18:16:54'),
(3, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 5, 1, '2025-05-17 18:27:34', '2025-05-17 18:27:34'),
(4, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 6, 1, '2025-05-17 18:41:52', '2025-05-17 18:41:52'),
(5, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 7, NULL, '2025-05-17 18:51:39', '2025-05-17 18:51:39'),
(6, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 8, 1, '2025-05-17 19:00:47', '2025-05-17 19:00:47'),
(7, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 9, 1, '2025-05-17 19:11:44', '2025-05-17 19:11:44'),
(8, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 10, 1, '2025-05-17 19:18:54', '2025-05-17 19:18:54'),
(9, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 11, NULL, '2025-05-17 19:37:46', '2025-05-17 19:37:46'),
(10, 3, 100000.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 12, NULL, '2025-05-17 19:39:00', '2025-05-17 19:39:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sub_pedidos`
--
ALTER TABLE `sub_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_pedidos_producto_id_foreign` (`producto_id`),
  ADD KEY `sub_pedidos_moneda_id_foreign` (`moneda_id`),
  ADD KEY `sub_pedidos_pedido_id_foreign` (`pedido_id`),
  ADD KEY `sub_pedidos_color_id_foreign` (`color_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sub_pedidos`
--
ALTER TABLE `sub_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
