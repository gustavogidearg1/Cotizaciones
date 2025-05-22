-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2025 a las 00:39:59
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
(3, 2200, 'Auto descargable', 1, NULL, '/storage/img/F6NsIj1ntjqe5cqNahrtr5YcdpNZksvtDxvKrVQY.png', NULL, NULL, NULL, 1, 1, 1, 3, '2025-05-11 21:16:49', '2025-05-11 21:16:49'),
(4, 199, 'Caja', 1, NULL, '/storage/img/A4ESSq0uC1Ry3e3fbZ9KfiXH15BbpfUga8UppkBg.jpg', NULL, NULL, NULL, 7, 1, 2, 3, '2025-05-17 22:24:14', '2025-05-17 22:24:14'),
(5, 188, 'Neumatico', 1, NULL, '/storage/img/XiSfMlOPrWO0iKsWuS9SaKus8U94qUoEpHOmIVk0.png', NULL, NULL, NULL, 8, 1, 2, 3, '2025-05-17 22:26:42', '2025-05-17 22:36:07'),
(6, 177, 'Rueda', 1, NULL, '/storage/img/mFntUIURSD4d9FyioQ11Zpio7jmcQeY0ZGclKoLm.png', NULL, NULL, NULL, 8, 1, 2, 3, '2025-05-17 22:34:33', '2025-05-17 22:36:26'),
(7, 5500, 'ATF-26', 1, NULL, '/storage/img/qt5rfr59ueAh6JBPxE7QaYfZEswCvoL2DEGBeFHS.png', NULL, NULL, NULL, 2, 1, 1, 3, '2025-05-17 22:37:03', '2025-05-17 22:37:03');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
