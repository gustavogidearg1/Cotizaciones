-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2025 a las 17:20:15
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
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL,
  `imagen_secundaria` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`id`, `nombre`, `imagen_principal`, `imagen_secundaria`, `created_at`, `updated_at`) VALUES
(1, 'Auto descargable', 'images/i0TrXDa0r7nIVK1dvY183C0JKcIkxhYytLhq8sN4.png', NULL, NULL, '2025-05-11 18:18:43'),
(2, 'Fertilizante', 'images/guTiS0EXo0kHJDWVJbhS83SJ7iKKvZTmlNaR6ykz.png', NULL, NULL, '2025-05-11 18:18:56'),
(3, 'Batea Volcadora', 'images/9O0jNjJbIch9cHIy4cmf5YKKi1OEGc1G9CEkiaBL.png', NULL, NULL, '2025-05-11 18:19:06'),
(4, 'Mixer Hotizontal', 'images/LXnhFdfKTNTL2uWtR0FQwsPaRYgexReiN9VkNxTp.png', NULL, NULL, '2025-05-11 18:19:14'),
(5, 'Mixer Vertical', 'images/seRsZha0aLgTSrPS2jdDmJYd4eVoi3X6ArBgUZon.png', NULL, NULL, '2025-05-11 18:19:23'),
(6, 'Acoplado Chicos', 'images/F1bRlTPqvxhEk4DZDGYVGTn6tq0Q0m2SKImoOeni.png', NULL, NULL, '2025-05-11 18:19:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
