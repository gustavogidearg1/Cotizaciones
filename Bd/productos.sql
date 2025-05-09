-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2025 a las 09:47:43
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
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `um_id` bigint(20) UNSIGNED NOT NULL,
  `detalle` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `img_1` varchar(255) DEFAULT NULL,
  `img_2` varchar(255) DEFAULT NULL,
  `img_3` varchar(255) DEFAULT NULL,
  `familia_id` bigint(20) UNSIGNED NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `tipo_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `um_id`, `detalle`, `img`, `img_1`, `img_2`, `img_3`, `familia_id`, `activo`, `tipo_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2200, 'Tolva Auto descargable de 30.000 lts', 1, NULL, '/storage/img/M1AebfGTWaJypFZSPsphtVeXMEnCoS3dosSKFp0c.png', NULL, NULL, NULL, 1, 1, 1, 3, '2025-04-26 19:58:53', '2025-04-26 19:58:53'),
(2, 5500, 'ATF Fertilizante 26', 1, NULL, '/storage/img/FA7dAWKkgHAgn3TPVP7VCcWxacOvhO1yH575uQKD.png', NULL, NULL, NULL, 3, 1, 1, 3, '2025-04-26 22:13:46', '2025-04-26 22:13:46'),
(3, 1999050, 'Balanza Magris', 1, NULL, '/storage/img/4xfowGahrqtgBkf5ZF8TDdziCvZnxSB9OpoGfHnf.png', NULL, NULL, NULL, 12, 1, 2, 3, '2025-04-28 00:57:17', '2025-04-29 03:22:07'),
(4, 19995555, 'Neumatico', 1, NULL, '/storage/img/bUByi0N72GdjFMqbHafDKI2yPy7ZysDKIl81riaU.png', NULL, NULL, NULL, 9, 1, 2, 3, '2025-04-29 02:54:40', '2025-04-29 03:22:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productos_codigo_unique` (`codigo`),
  ADD UNIQUE KEY `productos_nombre_unique` (`nombre`),
  ADD KEY `productos_um_id_foreign` (`um_id`),
  ADD KEY `productos_familia_id_foreign` (`familia_id`),
  ADD KEY `productos_tipo_id_foreign` (`tipo_id`),
  ADD KEY `productos_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_familia_id_foreign` FOREIGN KEY (`familia_id`) REFERENCES `familias` (`id`),
  ADD CONSTRAINT `productos_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`),
  ADD CONSTRAINT `productos_um_id_foreign` FOREIGN KEY (`um_id`) REFERENCES `unidades` (`id`),
  ADD CONSTRAINT `productos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
