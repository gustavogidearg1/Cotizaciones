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

INSERT INTO `sub_cotizaciones` (`id`, `producto_id`, `moneda_id`, `precio`, `precio_bonificado`, `descuento`, `detalle`, `cotizacion_id`, `created_at`, `updated_at`) VALUES
(1490, 4, 1, 200.00, 200.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1491, 153, 1, 467.00, 467.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1492, 3, 1, 45320.00, 45320.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1493, 4, 1, 330.00, 330.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1494, 5, 1, 1523.00, 1523.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1495, 7, 1, 33191.00, 33191.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1496, 8, 1, 17528.00, 17528.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1497, 9, 1, 19589.00, 19589.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1498, 13, 1, 29520.00, 29520.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14'),
(1499, 14, 1, 33244.00, 33244.00, 0.00, '-', 1, '2025-07-19 19:25:14', '2025-07-19 19:25:14');


ALTER TABLE `sub_cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_cotizaciones_producto_id_foreign` (`producto_id`),
  ADD KEY `sub_cotizaciones_moneda_id_foreign` (`moneda_id`),
  ADD KEY `sub_cotizaciones_cotizacion_id_foreign` (`cotizacion_id`);


ALTER TABLE `sub_cotizaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1638;


ALTER TABLE `sub_cotizaciones`
  ADD CONSTRAINT `sub_cotizaciones_cotizacion_id_foreign` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cotizaciones_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cotizaciones_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
