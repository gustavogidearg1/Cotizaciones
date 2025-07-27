SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `tipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tipos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Implemento', '2025-04-26 19:51:32', NULL),
(2, 'Accesorio', '2025-04-28 00:56:16', NULL),
(3, 'Accesorios MV', '2025-05-28 17:17:46', NULL),
(4, 'Accesorios MH', '2025-05-28 17:17:46', NULL),
(5, 'Accesorios ATF', '2025-05-28 17:22:51', NULL),
(6, 'Accesorios TA', '2025-05-28 17:22:51', NULL),
(7, 'Accesorios BV', '2025-05-29 09:13:46', NULL),
(8, 'Accesorios IC', NULL, NULL),
(9, 'Accesorios Balanza', NULL, NULL),
(10, 'Balanza MV', NULL, NULL),
(11, 'Balanza MH', NULL, NULL),
(12, 'Balanza ATF', NULL, NULL),
(13, 'Balanza TA', NULL, NULL),
(14, 'Neumatico TA', '2025-05-29 15:24:21', NULL),
(15, 'Neumatico MH', '2025-05-29 15:31:24', NULL),
(16, 'Neumatico MV', '2025-05-29 15:34:15', NULL),
(17, 'Neumatico Varios', '2025-05-29 15:35:57', NULL),
(18, 'Componentes IC', '2025-05-30 09:13:30', NULL),
(19, 'Componentes IC', '2025-05-30 09:21:33', NULL),
(20, 'Componentes MV', '2025-05-30 09:21:33', NULL),
(21, 'Componentes TA', '2025-05-30 09:21:58', NULL),
(22, 'Componentes ATF', '2025-05-30 09:21:58', NULL),
(23, 'Componentes', '0000-00-00 00:00:00', NULL),
(24, 'Componentes BV', '2025-05-30 09:22:25', NULL),
(25, 'Ruedas MV', '2025-05-30 09:22:25', NULL),
(26, 'Ruedas AC', '2025-05-30 09:22:47', NULL),
(27, 'Ruedas', '2025-05-30 09:22:47', NULL);


ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
