SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


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
  `links` varchar(255) DEFAULT NULL,
  `volumen_carga_m3` decimal(8,2) DEFAULT NULL,
  `potencia_requerida_hp` varchar(50) DEFAULT NULL,
  `toma_potencia_tom` varchar(50) DEFAULT NULL,
  `tiempo_descarga_aprx_min` varchar(50) DEFAULT NULL,
  `balanza` varchar(50) DEFAULT NULL,
  `camaras` varchar(50) DEFAULT NULL,
  `altura_maxima_mm` decimal(8,2) DEFAULT NULL,
  `altura_carga_mm` decimal(8,2) DEFAULT NULL,
  `longitud_total_mm` decimal(8,2) DEFAULT NULL,
  `peso_vacio_kg` decimal(8,2) DEFAULT NULL,
  `de_serie` varchar(255) DEFAULT NULL,
  `opcional` varchar(255) DEFAULT NULL,
  `colores` varchar(255) DEFAULT NULL,
  `familia_id` bigint(20) UNSIGNED NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `tipo_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productos_codigo_unique` (`codigo`),
  ADD UNIQUE KEY `productos_nombre_unique` (`nombre`),
  ADD KEY `productos_um_id_foreign` (`um_id`),
  ADD KEY `productos_familia_id_foreign` (`familia_id`),
  ADD KEY `productos_tipo_id_foreign` (`tipo_id`),
  ADD KEY `productos_user_id_foreign` (`user_id`);


ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
