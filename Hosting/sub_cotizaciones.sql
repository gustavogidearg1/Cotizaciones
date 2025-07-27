SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


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


ALTER TABLE `sub_cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_cotizaciones_producto_id_foreign` (`producto_id`),
  ADD KEY `sub_cotizaciones_moneda_id_foreign` (`moneda_id`),
  ADD KEY `sub_cotizaciones_cotizacion_id_foreign` (`cotizacion_id`);


ALTER TABLE `sub_cotizaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `sub_cotizaciones`
  ADD CONSTRAINT `sub_cotizaciones_cotizacion_id_foreign` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cotizaciones_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cotizaciones_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
