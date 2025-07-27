SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `sub_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `subbonificacion` decimal(5,2) NOT NULL,
  `descuento_2` decimal(5,2) NOT NULL DEFAULT 0.00,
  `descuento_3` decimal(5,2) NOT NULL DEFAULT 0.00,
  `descuento_4` decimal(5,2) NOT NULL DEFAULT 0.00,
  `diferencia` decimal(6,2) DEFAULT 0.00,
  `iva` decimal(5,2) NOT NULL DEFAULT 21.00,
  `cantidad` int(11) NOT NULL,
  `moneda_id` bigint(20) UNSIGNED NOT NULL,
  `forma_pago_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_fecha_entrega` date NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `detalle` text DEFAULT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `sub_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_pedidos_producto_id_foreign` (`producto_id`),
  ADD KEY `sub_pedidos_moneda_id_foreign` (`moneda_id`),
  ADD KEY `sub_pedidos_pedido_id_foreign` (`pedido_id`),
  ADD KEY `sub_pedidos_color_id_foreign` (`color_id`),
  ADD KEY `sub_pedidos_forma_pago_id_foreign` (`forma_pago_id`);


ALTER TABLE `sub_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;


ALTER TABLE `sub_pedidos`
  ADD CONSTRAINT `sub_pedidos_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colores` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sub_pedidos_forma_pago_id_foreign` FOREIGN KEY (`forma_pago_id`) REFERENCES `forma_pagos` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
