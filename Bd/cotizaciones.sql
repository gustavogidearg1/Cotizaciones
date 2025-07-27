SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `cotizaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cotizacion` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `vencimiento` date NOT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cotizaciones` (`id`, `cotizacion`, `descripcion`, `vencimiento`, `observacion`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Lista 5-2025', 'descripcion', '2025-06-30', NULL, 8, '2025-05-11 21:18:01', '2025-05-11 21:18:01');


ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cotizaciones_cotizacion_unique` (`cotizacion`),
  ADD KEY `cotizaciones_user_id_foreign` (`user_id`);


ALTER TABLE `cotizaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
