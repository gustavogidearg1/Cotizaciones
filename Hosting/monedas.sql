SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `monedas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `moneda` varchar(50) NOT NULL,
  `desc_ampliada` varchar(150) DEFAULT NULL,
  `tipo_cambio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `monedas` (`id`, `moneda`, `desc_ampliada`, `tipo_cambio`, `created_at`, `updated_at`) VALUES
(1, 'Dolares', 'Dolar Estadounidense, tipo de cambio BNA', 1210.00, '2025-05-11 18:09:31', '2025-07-11 18:47:55'),
(2, 'Pesos', NULL, 0.00, '2025-05-11 18:09:31', NULL);


ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monedas_moneda_unique` (`moneda`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
