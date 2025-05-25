-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2025 a las 16:51:17
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
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Categoria 1', '', '2025-05-11 18:09:59', NULL),
(2, 'Categoria 2', '', '2025-05-11 18:09:59', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Amarillo Comofra', '#FF9900', '2025-04-27 19:41:01', NULL),
(2, 'Verde VJD', 'MCF230', '2025-04-27 19:41:01', NULL),
(3, 'No lleva color', NULL, '2025-05-14 03:35:05', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

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

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `cotizacion`, `descripcion`, `vencimiento`, `observacion`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Lista 2', 'descripcion', '2025-06-11', NULL, 3, '2025-05-11 21:18:01', '2025-05-11 21:18:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Auto descargable', 'images/i0TrXDa0r7nIVK1dvY183C0JKcIkxhYytLhq8sN4.png', NULL, NULL, '2025-05-11 21:18:43'),
(2, 'Fertilizante', 'images/guTiS0EXo0kHJDWVJbhS83SJ7iKKvZTmlNaR6ykz.png', NULL, NULL, '2025-05-11 21:18:56'),
(3, 'Batea Volcadora', 'images/9O0jNjJbIch9cHIy4cmf5YKKi1OEGc1G9CEkiaBL.png', NULL, NULL, '2025-05-11 21:19:06'),
(4, 'Mixer Hotizontal', 'images/LXnhFdfKTNTL2uWtR0FQwsPaRYgexReiN9VkNxTp.png', NULL, NULL, '2025-05-11 21:19:14'),
(5, 'Mixer Vertical', 'images/seRsZha0aLgTSrPS2jdDmJYd4eVoi3X6ArBgUZon.png', NULL, NULL, '2025-05-11 21:19:23'),
(6, 'Acoplado Chicos', 'images/F1bRlTPqvxhEk4DZDGYVGTn6tq0Q0m2SKImoOeni.png', NULL, NULL, '2025-05-11 21:19:32'),
(7, 'Componentes', 'images/XEHTfjYmTXrHoYafeVtOsAATfrnl3ikjoBh2Y2l9.jpg', NULL, '2025-05-17 22:15:15', '2025-05-17 22:15:15'),
(8, 'Accesorios', 'images/zOSQUqjPhPMUvPP730l3kwaw1kNnGId7e6XbL2Xc.png', NULL, '2025-05-17 22:16:36', '2025-05-17 22:16:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fletes`
--

CREATE TABLE `fletes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fletes`
--

INSERT INTO `fletes` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'A cargo del cliente', NULL, NULL),
(2, 'A cargo de la empresa', NULL, NULL),
(3, 'Mitad y mitad', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pagos`
--

CREATE TABLE `forma_pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `diferencia` decimal(5,2) NOT NULL DEFAULT 0.00,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `forma_pagos`
--

INSERT INTO `forma_pagos` (`id`, `nombre`, `descripcion`, `diferencia`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Contado', NULL, -5.00, 1, '2025-05-08 21:58:21', '2025-05-18 17:46:06'),
(2, 'En 12 cuotas', NULL, 10.00, 1, '2025-05-08 21:58:21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `pais_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id`, `nombre`, `cp`, `provincia_id`, `pais_id`, `created_at`, `updated_at`) VALUES
(1, 'Monte Buey', '2589', 1, 1, '2025-05-08 19:00:20', NULL),
(2, 'Irriville', '2587', 1, 1, '2025-05-08 19:00:20', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_10_000045_create_roles_table', 1),
(5, '2025_04_10_002307_add_role_id_to_users_table', 1),
(6, '2025_04_12_104504_create_unidades_table', 1),
(7, '2025_04_12_104618_create_familias_table', 1),
(8, '2025_04_12_104645_create_tipos_table', 1),
(9, '2025_04_12_104715_create_productos_table', 1),
(10, '2025_04_13_124234_create_pais_table', 1),
(11, '2025_04_13_124346_create_provincia_table', 1),
(12, '2025_04_13_124425_create_localidad_table', 1),
(13, '2025_04_13_124502_create_categoria_table', 1),
(14, '2025_04_13_124523_create_cliente_table', 1),
(15, '2025_04_13_182534_create_monedas_table', 1),
(16, '2025_04_13_182601_create_cotizaciones_table', 1),
(17, '2025_04_13_182619_create_sub_cotizaciones_table', 1),
(18, '2025_04_14_235007_create_forma_pagos_table', 1),
(19, '2025_04_14_235010_create_pedidos_table', 1),
(20, '2025_04_14_235010_create_sub_pedidos_table', 1),
(21, '2025_04_19_005646_create_tipo_pedidos_table', 1),
(22, '2025_04_19_005652_create_fletes_table', 1),
(23, '2025_04_19_005708_update_pedidos_and_sub_pedidos_tables', 1),
(24, '2025_04_25_222247_add_image_fields_to_familias_table', 1),
(25, '2025_04_26_153107_update_pedidos_table', 1),
(26, '2025_04_26_175751_fix_pedidos_relations', 1),
(27, '2025_04_26_180332_add_cp_to_localidad_table', 1),
(28, '2025_04_26_180615_update_localidad_cp_column', 1),
(29, '2025_04_27_131836_create_colores_table', 1),
(30, '2025_04_27_132514_add_color_id_to_pedidos_table', 1),
(31, '2025_04_27_135455_move_color_id_to_sub_pedidos', 1),
(32, '2025_05_09_232941_add_diferencia_to_forma_pagos_table', 1),
(33, '2025_05_09_233817_add_activo_to_forma_pagos_table', 1),
(34, '2025_05_10_151433_remove_plazo_entrega_and_solicitante_from_pedidos_table', 1),
(35, '2025_05_10_192011_rename_localidad_to_nombre_in_localidades_table', 1),
(36, '2025_05_11_150546_create_provincias_table', 2),
(39, '2025_05_11_150623_create_localidades_table', 3),
(40, '2025_05_12_224509_add_foreign_key_to_color_id_in_sub_pedidos', 4),
(41, '2025_05_12_224648_fix_color_id_in_sub_pedidos', 4),
(42, '2025_05_15_000323_add_iva_and_total_to_sub_pedidos_table', 5),
(43, '2025_05_15_001231_fix_sub_pedidos_color_foreign_key', 5),
(44, '2025_05_20_013316_add_token_to_pedidos_table', 5),
(45, '2025_05_21_224757_add_campos_tecnicos_to_productos_table', 6),
(46, '2025_05_22_073449_add_campos_to_monedas_table', 7),
(47, '2025_05_22_081059_add_moneda_id_to_pedidos_table', 8),
(48, '2025_05_23_230708_add_cuit_to_pedidos_table', 9),
(49, '2025_05_23_233134_add_nom_corto_to_users_table', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `moneda` varchar(50) NOT NULL,
  `desc_ampliada` varchar(150) DEFAULT NULL,
  `tipo_cambio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id`, `moneda`, `desc_ampliada`, `tipo_cambio`, `created_at`, `updated_at`) VALUES
(1, 'Dolares', 'Dolar Estadounidense, tipo de cambio BNA', 0.00, '2025-05-11 18:09:31', '2025-05-22 10:50:12'),
(2, 'Pesos', NULL, 0.00, '2025-05-11 18:09:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pais` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `pais`, `created_at`, `updated_at`) VALUES
(1, 'Argentina', '2025-04-26 19:50:56', NULL),
(2, 'Uruguay', '2025-04-26 19:50:56', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_pedido_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `fecha` date NOT NULL,
  `fecha_necesidad` date NOT NULL,
  `forma_pago_id` bigint(20) UNSIGNED NOT NULL,
  `forma_entrega` varchar(255) NOT NULL,
  `observacion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen_2` varchar(255) DEFAULT NULL,
  `flete_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bonificacion` decimal(5,2) NOT NULL DEFAULT 0.00,
  `diferencia` decimal(5,2) NOT NULL DEFAULT 0.00,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cliente` varchar(255) NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `localidad_id` bigint(20) UNSIGNED NOT NULL,
  `provincia_id` bigint(20) UNSIGNED NOT NULL,
  `pais_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `token` varchar(255) DEFAULT NULL,
  `moneda_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `tipo_pedido_id`, `fecha`, `fecha_necesidad`, `forma_pago_id`, `forma_entrega`, `observacion`, `imagen`, `imagen_2`, `flete_id`, `bonificacion`, `diferencia`, `user_id`, `created_at`, `updated_at`, `cliente`, `cuit`, `direccion`, `localidad_id`, `provincia_id`, `pais_id`, `telefono`, `email`, `contacto`, `categoria_id`, `token`, `moneda_id`) VALUES
(1, 1, '2025-04-17', '2025-05-13', 1, 'Ex-works (EXW) - Retiro desde planta', 'observacion', 'imagen', 'imagen_2', 2, 0.00, 0.00, 3, '2025-05-14 02:50:07', NULL, 'cliente', '', 'direccion', 2, 1, 1, 'telefono', 'email', 'contacto', 1, NULL, NULL),
(4, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 18:16:54', '2025-05-17 18:16:54', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(5, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/f0WGT3f18axyaS4AZiemJnlK7pVMc69YGyT50vH4.png', NULL, 1, 0.00, 0.00, 3, '2025-05-17 18:27:34', '2025-05-17 18:27:34', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, NULL, NULL),
(6, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/8jLknajmUoYseAy69Lmn1e9gry3sSk03Npi7YpCG.png', NULL, 1, 0.00, 0.00, 3, '2025-05-17 18:41:52', '2025-05-17 18:41:52', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, NULL, NULL),
(7, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 18:51:39', '2025-05-17 18:51:39', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(8, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/bNQDM0rR9Hff2nDgdE9Li0n0sBd6eDho9BBFUwa3.png', NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:00:47', '2025-05-17 19:00:47', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, NULL, NULL),
(9, 2, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:11:44', '2025-05-17 19:11:44', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(10, 1, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:18:54', '2025-05-17 19:18:54', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'grgodoy1984@gmail.com', 'Un contacto', 1, NULL, NULL),
(11, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:37:46', '2025-05-17 19:37:46', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(12, 1, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-17 19:39:00', '2025-05-17 19:39:00', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(13, 1, '2025-05-17', '2025-05-31', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 3, '2025-05-18 00:05:39', '2025-05-18 00:05:39', 'Ruben Champrone', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(14, 1, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 5.00, 0.00, 3, '2025-05-18 00:25:23', '2025-05-18 00:25:23', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(15, 1, '2025-05-17', '2025-05-31', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 5.00, 0.00, 3, '2025-05-18 01:07:35', '2025-05-18 01:07:35', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, '11', NULL),
(17, 1, '2025-05-18', '2025-06-01', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 10.00, 0.00, 3, '2025-05-18 19:36:19', '2025-05-18 19:36:19', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, NULL, NULL),
(18, 1, '2025-05-18', '2025-06-01', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 10.00, 0.00, 3, '2025-05-18 19:43:39', '2025-05-18 19:43:39', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(19, 1, '2025-05-18', '2025-06-01', 1, 'Ex-works (EXW) - Retiro desde planta', 'nada', NULL, NULL, 1, 10.00, -5.00, 3, '2025-05-18 20:47:49', '2025-05-20 03:56:14', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, NULL, NULL),
(20, 1, '2025-05-20', '2025-06-03', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 10.00, 3, '2025-05-20 04:16:27', '2025-05-20 04:23:10', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, NULL, NULL),
(21, 1, '2025-05-20', '2025-06-03', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/6KY13XzTzolPATO3b76xdoxgR3a81ds2fQzbaIws.png', '/storage/pedidos/llCufwvwgyGt2L1M8uQQmIZhOl89cNzfToQcH0gn.png', 1, 0.00, 10.00, 3, '2025-05-20 04:46:00', '2025-05-22 03:05:26', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', 'Un contacto', 1, 'ad7f7f57-d2d4-4af7-a953-c2e17cb29753', 1),
(22, 1, '2025-05-22', '2025-06-05', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/3ULiEt330m1NeaqyJIBu5UtBlh4j7iE6UOLMU2Se.png', NULL, 1, 0.00, 0.00, 3, '2025-05-22 11:26:52', '2025-05-22 11:26:52', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, '43c0e612-40d0-46e6-92ff-12a0d95a90e5', 1),
(23, 1, '2025-05-22', '2025-06-05', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/XrgKVlUzJUjTtllRNSFOlu5Z3DsiAZpaIvWZIgs7.png', NULL, 1, 0.00, 10.00, 4, '2025-05-22 17:06:48', '2025-05-24 02:19:27', 'Seba', '20302806285', 'General Paz 745', 1, 1, 1, '03534191741', 'administracionventas@comofrasrl.com.ar', NULL, 1, '0d05a5e2-9100-4bc0-b9e9-ff33df77ed7e', 1);

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

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `um_id`, `detalle`, `img`, `img_1`, `img_2`, `img_3`, `links`, `volumen_carga_m3`, `potencia_requerida_hp`, `toma_potencia_tom`, `tiempo_descarga_aprx_min`, `balanza`, `camaras`, `altura_maxima_mm`, `altura_carga_mm`, `longitud_total_mm`, `peso_vacio_kg`, `de_serie`, `opcional`, `colores`, `familia_id`, `activo`, `tipo_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 2200, 'Auto descargable 30000Lts', 1, 'El acoplado Autodescargable modelo INNOVA en todas sus capacidades, posee una longitud de la Caja de Cereal de 5.900 mm, esto facilita el transporte en carretones y disminuye el radio de giro. El abulonado de la mayor parte de sus componentes permite lograr una mejor absorción de esfuerzos y una mejor terminación a la unidad. La elección de neumáticos de igual dimensión logra una mejor compactación del suelo. Tubo de descarga de 450 mm., permite una rápida descarga. Cuchilla de descarga con mando hidráulico. Sistema basculante en eje delantero permite copiar las irregularidades del terreno logrando una excelente transitabilidad y estabilidad. Confiable en el giro y en el transporte de la unidad al utilizar aro giratorio a bolitas. Lanza con registro en altura para compensar el uso de diferentes neumáticos (23.1.30, 28L26, 24.5.32). Punta de lanza rebatible, permite ahorro de espacio.\r\n\r\nEnganche con amortiguador de impacto con anillos de goma. Maza de rueda construidas en fundición nodular con rodamientos gemelos HM518 445-410 y punta de eje desmontable. Sistema de limpieza inferior que cubre la longitud de la unidad, distribuidas con puertas de apertura independientes mediante manijas individuales y traba de seguridad. Sinfín barredor y de descarga cementados. Lona de cobertura de caja de cereal, con sistema de destape rápido. Escalera trasera externa e interna. Depósito de agua para lavamanos. Cajón portaherramientas en plástico rotomoldeado. Luces LED traseras reglamentarias. Luz en tubo de descarga. Triángulo reflectivos traseros de grandes dimensiones. Paragolpe reforzado rebatible, en chapa plegada. Integramente pintada con fondo y esmalte poliuretano.', '/storage/img/F6NsIj1ntjqe5cqNahrtr5YcdpNZksvtDxvKrVQY.png', NULL, NULL, NULL, 'https://comofrasrl.com.ar/autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 3, '2025-05-11 21:16:49', '2025-05-22 03:16:52'),
(4, 199, 'Caja', 1, NULL, '/storage/img/A4ESSq0uC1Ry3e3fbZ9KfiXH15BbpfUga8UppkBg.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, 2, 3, '2025-05-17 22:24:14', '2025-05-17 22:24:14'),
(5, 188, 'Neumatico', 1, NULL, '/storage/img/XiSfMlOPrWO0iKsWuS9SaKus8U94qUoEpHOmIVk0.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 1, 2, 3, '2025-05-17 22:26:42', '2025-05-17 22:36:07'),
(6, 177, 'Rueda', 1, NULL, '/storage/img/mFntUIURSD4d9FyioQ11Zpio7jmcQeY0ZGclKoLm.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 1, 2, 3, '2025-05-17 22:34:33', '2025-05-17 22:36:26'),
(7, 5500, 'ATF-26', 1, NULL, '/storage/img/qt5rfr59ueAh6JBPxE7QaYfZEswCvoL2DEGBeFHS.png', NULL, NULL, NULL, 'https://drive.google.com/file/d/1oHggEanwQT2EyxroTP18uLK8vqItRY2Q/view?usp=drive_link', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 1, 3, '2025-05-17 22:37:03', '2025-05-25 15:21:13'),
(8, 16200, 'Batea volcadora de 8', 1, 'Estas bateas volcadoras de 8 y 12 toneladas están diseñadas para el manejo y transporte eficiente de una variedad de productos, ya sean secos, húmedos, livianos o pesados. Son prácticas y versátiles, ofreciendo comodidad y durabilidad con un costo muy satisfactorio, lo cual las convierte en una excelente inversión para realizar trabajos con el máximo rendimiento.\r\n\r\nEstán construidas completamente en chapa de acero al carbono y cuentan con una caja de carga tipo semi-monocasco reforzada con laterales envolventes. Su chasis reforzado, de estructura simple y resistente, está elaborado en chapa estampada de gran robustez y rigidez, brindando una larga vida útil y resistencia en las condiciones de trabajo más exigentes.\r\n\r\nEl enganche con rótula oscilante proporciona mayor seguridad en el transporte, y el portón trasero está diseñado también para apertura tipo libro, aportando flexibilidad en la descarga. La ubicación del eje cerca del centro de gravedad transfiere parte del peso a la barra de tiro del tractor, lo que es indispensable para mantener la estabilidad durante el transporte.\r\n\r\nSistema de ejes: ofrece opciones de rodado (11L16), (275/80 x 22,5), (385/65 x 22,5), y (400/60 x 22,5). En configuración de un solo eje, se incluye rodado 750 x 16 dual o 275/80 x 22,5.\r\n\r\nSistema hidráulico: equipado con un cilindro telescópico de 4 o 5 etapas que permite elevar la batea a un ángulo superior a 45°, facilitando la descarga completa y rápida de materiales.\r\n\r\nVENTAJAS:\r\n\r\nBajo costo de mantenimiento\r\nFácil operación\r\nAlta resistencia para una mayor vida útil', '/storage/img/WhsdkFRtO4KWSmxUlJwlIPjLtoHpNc0Eg2XIv0CG.png', '/storage/img/ySD23IVQzVoeAhxItkBoY9EcDj5OSuiFf3QLNOYo.png', '/storage/img/NzAoSzyIJbHTcXNWhJOpwxe6bJAyPmdf8Godn6So.png', '/storage/img/FshV6q36tDzn9DeSPi23hRJPd7QIPy4WyK91CHLB.png', 'https://comofrasrl.com.ar/bateas-volcadoras/', 7.53, '80 cv', NULL, NULL, NULL, NULL, NULL, 800.00, 4300.00, NULL, NULL, 'RODADO 275-80- 22,5', NULL, 3, 1, 1, 3, '2025-05-22 02:34:25', '2025-05-22 02:49:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `pais_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `provincia`, `pais_id`, `created_at`, `updated_at`) VALUES
(1, 'Cordoba', 1, '2025-04-26 19:52:31', NULL),
(2, 'Santa Fe', 1, '2025-04-26 19:52:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', NULL, '2025-04-26 19:49:19', NULL),
(2, 'Editor', NULL, '2025-04-26 19:49:19', NULL),
(3, 'Invitado', NULL, '2025-04-26 19:49:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dtVeHij9Me0SAika1yUpOijx2QMPeJZNDVKeXOiK', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib0xubzNxRFJUNGlMZU5DbGJpYkZoVkVaV28xNlFvRlF2Z28zUFk1MSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZWRpZG9zIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDgxNzgyMzk7fX0=', 1748183865);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_cotizaciones`
--

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

--
-- Volcado de datos para la tabla `sub_cotizaciones`
--

INSERT INTO `sub_cotizaciones` (`id`, `producto_id`, `moneda_id`, `precio`, `precio_bonificado`, `descuento`, `detalle`, `cotizacion_id`, `created_at`, `updated_at`) VALUES
(16, 3, 1, 100050.00, 100000.00, 0.00, '-', 1, '2025-05-24 19:18:57', '2025-05-24 19:18:57'),
(17, 7, 1, 50000.00, 50000.00, 0.00, '-', 1, '2025-05-24 19:18:57', '2025-05-24 19:18:57'),
(18, 4, 1, 200.00, 200.00, 0.00, '-', 1, '2025-05-24 19:18:57', '2025-05-24 19:18:57'),
(19, 5, 1, 1000.00, 1000.00, 0.00, '-', 1, '2025-05-24 19:18:57', '2025-05-24 19:18:57'),
(20, 6, 1, 300.00, 300.00, 0.00, '-', 1, '2025-05-24 19:18:57', '2025-05-24 19:18:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_pedidos`
--

CREATE TABLE `sub_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `subbonificacion` decimal(5,2) NOT NULL,
  `diferencia` decimal(6,2) DEFAULT 0.00,
  `iva` decimal(5,2) NOT NULL DEFAULT 21.00,
  `cantidad` int(11) NOT NULL,
  `moneda_id` bigint(20) UNSIGNED NOT NULL,
  `sub_fecha_entrega` date NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `detalle` text DEFAULT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sub_pedidos`
--

INSERT INTO `sub_pedidos` (`id`, `producto_id`, `precio`, `subbonificacion`, `diferencia`, `iva`, `cantidad`, `moneda_id`, `sub_fecha_entrega`, `subtotal`, `total`, `detalle`, `pedido_id`, `created_at`, `updated_at`, `color_id`) VALUES
(1, 3, 10000.00, 0.00, 0.00, 21.00, 1, 1, '2025-05-13', 0.00, 0.00, NULL, 1, '2025-05-14 02:51:26', NULL, NULL),
(2, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 4, '2025-05-17 18:16:54', '2025-05-17 18:16:54', NULL),
(3, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 5, '2025-05-17 18:27:34', '2025-05-17 18:27:34', NULL),
(4, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 6, '2025-05-17 18:41:52', '2025-05-17 18:41:52', NULL),
(5, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 7, '2025-05-17 18:51:39', '2025-05-17 18:51:39', NULL),
(6, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 8, '2025-05-17 19:00:47', '2025-05-17 19:00:47', NULL),
(7, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 9, '2025-05-17 19:11:44', '2025-05-17 19:11:44', NULL),
(8, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 10, '2025-05-17 19:18:54', '2025-05-17 19:18:54', NULL),
(9, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 11, '2025-05-17 19:37:46', '2025-05-17 19:37:46', NULL),
(10, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-05-31', 100000.00, 110500.00, NULL, 12, '2025-05-17 19:39:00', '2025-05-17 19:39:00', NULL),
(11, 3, 100000.00, 0.00, 0.00, 10.50, 2, 1, '2025-05-31', 200000.00, 221000.00, NULL, 13, '2025-05-18 00:05:39', '2025-05-18 00:05:39', NULL),
(16, 7, 50000.00, 5.00, 0.00, 10.50, 1, 1, '2025-05-31', 47500.00, 52487.50, NULL, 15, '2025-05-18 16:18:38', '2025-05-18 16:18:38', NULL),
(17, 3, 100000.00, 5.00, 0.00, 10.50, 1, 1, '2025-05-31', 95000.00, 104975.00, NULL, 14, '2025-05-18 16:27:00', '2025-05-18 16:27:00', NULL),
(18, 4, 200.00, 5.00, 0.00, 10.50, 1, 1, '2025-05-31', 190.00, 209.95, NULL, 14, '2025-05-18 16:27:00', '2025-05-18 16:27:00', NULL),
(19, 5, 1000.00, 5.00, 0.00, 10.50, 1, 1, '2025-05-31', 950.00, 1049.75, NULL, 14, '2025-05-18 16:27:00', '2025-05-18 16:27:00', NULL),
(21, 3, 100000.00, 10.00, 0.00, 10.50, 1, 1, '2025-06-01', 90000.00, 99450.00, NULL, 17, '2025-05-18 19:36:19', '2025-05-18 19:36:19', NULL),
(22, 3, 100000.00, 10.00, 0.00, 10.50, 1, 1, '2025-06-01', 90000.00, 99450.00, NULL, 18, '2025-05-18 19:43:39', '2025-05-18 19:43:39', NULL),
(23, 4, 200.00, 10.00, 0.00, 10.50, 1, 1, '2025-06-01', 180.00, 198.90, NULL, 18, '2025-05-18 19:43:39', '2025-05-18 19:43:39', NULL),
(24, 5, 1000.00, 0.00, 0.00, 10.50, 1, 1, '2025-06-01', 1000.00, 1105.00, NULL, 18, '2025-05-18 19:43:39', '2025-05-18 19:43:39', NULL),
(67, 3, 100000.00, 10.00, -5.00, 10.50, 1, 1, '2025-06-01', 90000.00, 99450.00, NULL, 19, '2025-05-20 03:56:14', '2025-05-20 03:56:14', NULL),
(68, 5, 1000.00, 0.00, 0.00, 10.50, 1, 1, '2025-06-01', 1000.00, 1105.00, NULL, 19, '2025-05-20 03:56:14', '2025-05-20 03:56:14', NULL),
(72, 3, 100000.00, 0.00, 10.00, 10.50, 1, 1, '2025-06-03', 100000.00, 110500.00, NULL, 20, '2025-05-20 04:23:10', '2025-05-20 04:23:10', NULL),
(73, 4, 200.00, 0.00, 10.00, 10.50, 1, 1, '2025-06-03', 200.00, 221.00, NULL, 20, '2025-05-20 04:23:10', '2025-05-20 04:23:10', NULL),
(74, 5, 1000.00, 0.00, 0.00, 10.50, 1, 1, '2025-06-03', 1000.00, 1105.00, NULL, 20, '2025-05-20 04:23:10', '2025-05-20 04:23:10', NULL),
(79, 3, 100000.00, 0.00, 10.00, 10.50, 1, 1, '2025-06-03', 100000.00, 110500.00, NULL, 21, '2025-05-22 03:05:26', '2025-05-22 03:05:26', NULL),
(80, 4, 200.00, 0.00, 10.00, 10.50, 1, 1, '2025-06-03', 200.00, 221.00, NULL, 21, '2025-05-22 03:05:26', '2025-05-22 03:05:26', NULL),
(81, 3, 100000.00, 0.00, 0.00, 10.50, 1, 1, '2025-06-05', 100000.00, 110500.00, NULL, 22, '2025-05-22 11:26:52', '2025-05-22 11:26:52', 1),
(82, 4, 200.00, 0.00, 0.00, 10.50, 1, 1, '2025-06-05', 200.00, 221.00, NULL, 22, '2025-05-22 11:26:52', '2025-05-22 11:26:52', NULL),
(83, 5, 1000.00, 0.00, 0.00, 10.50, 1, 1, '2025-06-05', 1000.00, 1105.00, NULL, 22, '2025-05-22 11:26:52', '2025-05-22 11:26:52', NULL),
(90, 3, 100000.00, 0.00, 10.00, 10.50, 1, 1, '2025-06-05', 100000.00, 110500.00, NULL, 23, '2025-05-24 02:19:27', '2025-05-24 02:19:27', 1),
(91, 4, 200.00, 0.00, 10.00, 10.50, 1, 1, '2025-06-05', 200.00, 221.00, NULL, 23, '2025-05-24 02:19:28', '2025-05-24 02:19:28', NULL),
(92, 5, 1000.00, 0.00, 0.00, 10.50, 4, 1, '2025-06-05', 4000.00, 4420.00, NULL, 23, '2025-05-24 02:19:28', '2025-05-24 02:19:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Implemento', '2025-04-26 19:51:32', NULL),
(2, 'Accesorio', '2025-04-28 00:56:16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pedidos`
--

CREATE TABLE `tipo_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_pedidos`
--

INSERT INTO `tipo_pedidos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Cotizacion', NULL, NULL),
(2, 'Pedido', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Unidad', '2025-05-11 18:11:09', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nom_corto` varchar(2) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `nom_corto`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(4, 'Godoy Gustavo', 'GG', 'grgodoy1984@gmail.com', NULL, '$2y$12$z8qEGLYZQbXAmoPCXo5MF.AoqAsuPMEtLwPiXWKSfQF2G7Fkbp93C', NULL, '2025-05-03 20:41:55', '2025-05-24 02:45:19', 3),
(5, 'Gustavo Godoy', 'GG', 'gustavog@live.com.ar', NULL, '$2y$12$tthHQqMbYABYggngJOkpdeAHzZeNyDwxjE0BivR79BRdazzGkM02K', NULL, '2025-05-24 03:13:02', '2025-05-24 03:13:02', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria_categoria_unique` (`categoria`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colores_nombre_unique` (`nombre`),
  ADD UNIQUE KEY `colores_descripcion_unique` (`descripcion`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cotizaciones_cotizacion_unique` (`cotizacion`),
  ADD KEY `cotizaciones_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fletes`
--
ALTER TABLE `fletes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `forma_pagos`
--
ALTER TABLE `forma_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `localidad_localidad_unique` (`nombre`),
  ADD KEY `localidad_provincia_id_foreign` (`provincia_id`),
  ADD KEY `localidad_pais_id_foreign` (`pais_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monedas_moneda_unique` (`moneda`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pais_pais_unique` (`pais`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pedidos_token_unique` (`token`),
  ADD KEY `pedidos_forma_pago_id_foreign` (`forma_pago_id`),
  ADD KEY `pedidos_user_id_foreign` (`user_id`),
  ADD KEY `pedidos_tipo_pedido_id_foreign` (`tipo_pedido_id`),
  ADD KEY `pedidos_flete_id_foreign` (`flete_id`),
  ADD KEY `pedidos_localidad_id_foreign` (`localidad_id`),
  ADD KEY `pedidos_provincia_id_foreign` (`provincia_id`),
  ADD KEY `pedidos_pais_id_foreign` (`pais_id`),
  ADD KEY `pedidos_categoria_id_foreign` (`categoria_id`),
  ADD KEY `pedidos_moneda_id_foreign` (`moneda_id`);

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
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provincia_provincia_unique` (`provincia`),
  ADD KEY `provincia_pais_id_foreign` (`pais_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `sub_cotizaciones`
--
ALTER TABLE `sub_cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_cotizaciones_producto_id_foreign` (`producto_id`),
  ADD KEY `sub_cotizaciones_moneda_id_foreign` (`moneda_id`),
  ADD KEY `sub_cotizaciones_cotizacion_id_foreign` (`cotizacion_id`);

--
-- Indices de la tabla `sub_pedidos`
--
ALTER TABLE `sub_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_pedidos_producto_id_foreign` (`producto_id`),
  ADD KEY `sub_pedidos_moneda_id_foreign` (`moneda_id`),
  ADD KEY `sub_pedidos_pedido_id_foreign` (`pedido_id`),
  ADD KEY `sub_pedidos_color_id_foreign` (`color_id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_pedidos`
--
ALTER TABLE `tipo_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `fletes`
--
ALTER TABLE `fletes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `forma_pagos`
--
ALTER TABLE `forma_pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sub_cotizaciones`
--
ALTER TABLE `sub_cotizaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `sub_pedidos`
--
ALTER TABLE `sub_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_pedidos`
--
ALTER TABLE `tipo_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`);

--
-- Filtros para la tabla `sub_cotizaciones`
--
ALTER TABLE `sub_cotizaciones`
  ADD CONSTRAINT `sub_cotizaciones_cotizacion_id_foreign` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cotizaciones_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_cotizaciones_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sub_pedidos`
--
ALTER TABLE `sub_pedidos`
  ADD CONSTRAINT `sub_pedidos_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colores` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Volcado de datos para la tabla `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"bd_cotizacion\",\"table\":\"pais\"},{\"db\":\"bd_cotizacion\",\"table\":\"pedidos\"},{\"db\":\"bd_cotizacion\",\"table\":\"cotizaciones\"},{\"db\":\"bd_cotizacion\",\"table\":\"users\"},{\"db\":\"bd_cotizacion\",\"table\":\"monedas\"},{\"db\":\"bd_cotizacion\",\"table\":\"roles\"},{\"db\":\"bd_cotizacion\",\"table\":\"productos\"},{\"db\":\"bd_cotizacion\",\"table\":\"sub_pedidos\"},{\"db\":\"bd_cotizacion\",\"table\":\"provincia\"},{\"db\":\"bd_cotizacion\",\"table\":\"forma_pagos\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'bd_cotizacion', 'pedidos', '{\"sorted_col\":\"`id` DESC\"}', '2025-05-25 12:20:30'),
('root', 'bd_cotizacion', 'sub_pedidos', '{\"sorted_col\":\"`id` DESC\"}', '2025-05-18 16:09:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Volcado de datos para la tabla `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-05-25 14:50:07', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"es\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indices de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indices de la tabla `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indices de la tabla `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indices de la tabla `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indices de la tabla `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indices de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indices de la tabla `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indices de la tabla `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indices de la tabla `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indices de la tabla `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indices de la tabla `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indices de la tabla `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
