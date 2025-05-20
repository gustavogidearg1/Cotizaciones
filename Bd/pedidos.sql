-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2025 a las 01:58:12
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
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_pedido_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `fecha` date NOT NULL,
  `fecha_necesidad` date NOT NULL,
  `forma_pago_id` bigint(20) UNSIGNED NOT NULL,
  `forma_entrega` varchar(255) NOT NULL,
  `observacion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen_2` varchar(255) DEFAULT NULL,
  `flete_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bonificacion` decimal(5,2) NOT NULL DEFAULT 0.00,
  `diferencia` decimal(5,2) NOT NULL DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cliente` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `localidad_id` bigint(20) UNSIGNED NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `pais_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `tipo_pedido_id`, `fecha`, `fecha_necesidad`, `forma_pago_id`, `forma_entrega`, `observacion`, `imagen`, `imagen_2`, `flete_id`, `bonificacion`, `diferencia`, `user_id`, `created_at`, `updated_at`, `cliente`, `direccion`, `localidad_id`, `provincia_id`, `pais_id`, `telefono`, `email`, `contacto`, `categoria_id`) VALUES
(1, 1, '2025-04-17', '2025-05-13', 1, 'Ex-works (EXW) - Retiro desde planta', 'observacion', 'imagen', 'imagen_2', 2, 0.00, 0.00, 3, '2025-05-14 02:50:07', NULL, 'cliente', 'direccion', 2, 1, 1, 'telefono', 'email', 'contacto', 1),
(4, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 18:16:54', '2025-05-17 18:16:54', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1),
(5, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/f0WGT3f18axyaS4AZiemJnlK7pVMc69YGyT50vH4.png', NULL, 1, 0.00, 0.00, 3, '2025-05-17 18:27:34', '2025-05-17 18:27:34', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1),
(6, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/8jLknajmUoYseAy69Lmn1e9gry3sSk03Npi7YpCG.png', NULL, 1, 0.00, 0.00, 3, '2025-05-17 18:41:52', '2025-05-17 18:41:52', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1),
(7, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 18:51:39', '2025-05-17 18:51:39', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1),
(8, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/bNQDM0rR9Hff2nDgdE9Li0n0sBd6eDho9BBFUwa3.png', NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:00:47', '2025-05-17 19:00:47', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1),
(9, 2, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:11:44', '2025-05-17 19:11:44', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1),
(10, 1, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:18:54', '2025-05-17 19:18:54', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'grgodoy1984@gmail.com', 'Un contacto', 1),
(11, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:37:46', '2025-05-17 19:37:46', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1),
(12, 1, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:39:00', '2025-05-17 19:39:00', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1),
(13, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-18 00:05:39', '2025-05-18 00:05:39', 'Ruben Champrone', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1),
(14, 1, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 5.00, 0.00, 3, '2025-05-18 00:25:23', '2025-05-18 00:25:23', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1),
(15, 1, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 5.00, 0.00, 3, '2025-05-18 01:07:35', '2025-05-18 01:07:35', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1),
(17, 1, '2025-05-18', '2025-06-01', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 10.00, 0.00, 3, '2025-05-18 19:36:19', '2025-05-18 19:36:19', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1),
(18, 1, '2025-05-18', '2025-06-01', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 10.00, 0.00, 3, '2025-05-18 19:43:39', '2025-05-18 19:43:39', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1),
(19, 1, '2025-05-18', '2025-06-01', 1, 'Ex-works (EXW) - Retiro desde planta', 'nada', NULL, NULL, 1, 10.00, 0.00, 3, '2025-05-18 20:47:49', '2025-05-20 02:37:50', 'Gustavo Godoy', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
