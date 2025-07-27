-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-06-2025 a las 23:55:34
-- Versión del servidor: 10.6.20-MariaDB-cll-lve
-- Versión de PHP: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comofras_bd_cotizacion`
--

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
(22, 1, '2025-05-22', '2025-06-05', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/3ULiEt330m1NeaqyJIBu5UtBlh4j7iE6UOLMU2Se.png', NULL, 1, 0.00, 0.00, 3, '2025-05-22 11:26:52', '2025-05-22 11:26:52', 'Gustavo Godoy', '', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, '43c0e612-40d0-46e6-92ff-12a0d95a90e5', 1),
(23, 1, '2025-05-22', '2025-06-05', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/XrgKVlUzJUjTtllRNSFOlu5Z3DsiAZpaIvWZIgs7.png', NULL, 1, 0.00, 10.00, 4, '2025-05-22 17:06:48', '2025-05-24 02:19:27', 'Seba', '20302806285', 'General Paz 745', 1, 1, 1, '03534191741', 'administracionventas@comofrasrl.com.ar', NULL, 1, '0d05a5e2-9100-4bc0-b9e9-ff33df77ed7e', 1),
(24, 1, '2025-05-27', '2025-06-18', 2, 'Ex-works (EXW) - Retiro desde planta', 'No aplica', NULL, NULL, 1, 0.00, 0.00, 6, '2025-05-27 22:03:52', '2025-05-27 22:03:52', 'HECTOR STRADA', '20199909907', 'LAVALLE 510', 1, 1, 1, '+5493467587600', 'ventas@comofrasrl.com.ar', NULL, 1, 'a66b9253-5ecf-465c-b38d-f81d98995734', 1),
(25, 1, '2025-05-27', '2025-06-30', 2, 'Ex-works (EXW) - Retiro desde planta', 'CON BALANZA Y NEUMATICOS.', '/storage/pedidos/fwNvdTg3Hz3vUwrBSZZERere4yJCQJ2zTEJ3YmJt.png', NULL, 1, 0.00, 0.00, 7, '2025-05-27 22:15:23', '2025-05-29 03:35:03', 'SEBASTIAN BOVO', '20434126143', 'SARMIENTO 665', 1, 1, 1, '03467445775', 'administracionventas@comofrasrl.com.ar', NULL, 1, '08a89b14-f666-43fb-8053-a891a2deb209', 1),
(26, 1, '2025-05-29', '2025-06-12', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 5.00, 0.00, 5, '2025-05-29 20:05:12', '2025-05-29 20:05:12', 'Hector Strada', '20268578022', '9 de julio', 1, 1, 1, '03467587600', 'ventas@comofrasrl.com.ar', NULL, 1, 'bf6c91f4-cd06-4a59-b702-762991563863', 1),
(27, 1, '2025-05-30', '2025-06-13', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 8, '2025-05-30 14:24:02', '2025-05-30 14:24:02', 'HECTOR LUIS STRADA', '20185510973', '9 DE JULIO 166', 1, 1, 1, '3467-587600', 'ventas@comofrasrl.com.ar', NULL, 1, '394816ac-2e16-43f4-a991-3d49570dd52f', 1),
(28, 1, '2025-05-30', '2025-06-13', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/BGMPCl09Mg8p3PeohZTj9cgvdFXiEv2FXdYn43cV.jpg', NULL, 1, 0.00, 0.00, 4, '2025-05-30 18:12:57', '2025-05-30 18:12:57', 'Ruben Loiacono', '20268578022', 'Ruta 6', 1, 1, 1, '03467587600', 'guillermolerda.ventas@gmail.com', NULL, 1, '1f78930d-1a36-4b55-9770-353c343423aa', 1),
(29, 1, '2025-05-30', '2025-06-13', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 14.50, 0.00, 4, '2025-05-30 18:29:52', '2025-05-30 18:29:52', 'Ruben Loiacono', '20268578022', 'Ruta 6', 1, 1, 1, '03467587600', 'ind.comofrasrl@gmail.com', NULL, 1, '3c26f237-46b2-4054-80ec-f187aaa96584', 1),
(30, 1, '2025-05-30', '2025-06-28', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/Pio7E8jB9kkpr4tLQ5Gq9RpzCIsEifayMyhLyg46.jpg', NULL, 1, 10.00, -5.00, 4, '2025-05-30 18:41:27', '2025-06-01 23:28:43', 'Hector Strada', '20268578022', 'Ruta 6', 1, 1, 1, '03467587600', 'ind.comofrasrl@gmail.com', NULL, 1, 'f9b06d5b-7618-4647-8500-d3e5c616345a', 1),
(31, 1, '2025-06-01', '2025-06-22', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 5, '2025-06-02 01:28:13', '2025-06-02 01:28:13', 'Gustavo Godoy', '20434126143', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, '12076e03-5088-470c-8c7f-0c3ddbd676cf', 1),
(32, 1, '2025-06-01', '2025-06-22', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 5, '2025-06-02 01:29:30', '2025-06-02 01:29:30', 'Gustavo Godoy', '20302806285', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, '37f8cd18-166f-47b2-8081-b578695a66a1', 1),
(33, 1, '2025-06-01', '2025-06-22', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 8, '2025-06-02 01:34:58', '2025-06-02 01:34:58', 'Pirin Strada', '20185510973', 'Federico Hudson', 1, 1, 1, '3467587600', 'ventas@comofrasrl.com.ar', NULL, 1, 'bbddd754-5ee6-4713-a96d-8d0d4744dea1', 1),
(34, 1, '2025-06-01', '2025-06-22', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 5, '2025-06-02 01:34:59', '2025-06-02 01:34:59', 'Gustavo Godoy', '20302806285', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, '387dfb97-9347-4638-9a1f-3f2896c811bf', 1),
(35, 1, '2025-06-02', '2025-07-10', 1, 'Ex-works (EXW) - Retiro desde planta', 'PUESTA EN FABRICA', NULL, NULL, 1, 10.00, 0.00, 8, '2025-06-02 03:12:41', '2025-06-02 03:18:19', 'EUGENIO STRADA', '30503529919', 'LAS HERAS N° 252', 1, 1, 1, '3467587600', 'ventas@comofrasrl.com.ar', NULL, 1, '1bc5dbe0-4b69-4560-b202-c5545876b979', 1),
(36, 1, '2025-06-02', '2025-08-12', 1, 'Ex-works (EXW) - Retiro desde planta', 'PUESTA EN FABRICA', NULL, NULL, 1, 0.00, 0.00, 8, '2025-06-02 03:27:40', '2025-06-02 03:27:40', 'JOAQUIN STRADA', '20351438782', 'LAPRIDA N° 155', 1, 1, 1, '03467587600', 'ventas@comofrasrl.com.ar', NULL, 1, 'fe8a69e0-56e1-4fd4-a546-ab709da585ac', 1),
(37, 1, '2025-06-02', '2025-06-23', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 10.00, 0.00, 8, '2025-06-02 14:10:44', '2025-06-02 14:10:44', 'Hector Pirin', '20185510973', 'Las Heras n°454', 15, 1, 1, '3467587600', 'ventas@comofrasrl.com.ar', NULL, 1, '406cc531-f936-42c0-9b56-8102066576c7', 1),
(38, 1, '2025-06-02', '2025-06-23', 1, 'Ex-works (EXW) - Retiro desde planta', 'PUESTA EN FABRICA', NULL, NULL, 1, 5.00, 0.00, 8, '2025-06-02 14:24:47', '2025-06-02 14:24:47', 'Luis JOSE', '20351438782', 'San MARTIN 455', 17, 1, 1, '03467587600', 'ventas@comofrasrl.com.ar', NULL, 1, '5f93e4bd-c902-4de1-832d-910a27989822', 1),
(39, 1, '2025-06-02', '2025-08-06', 1, 'Ex-works (EXW) - Retiro desde planta', 'PUESTA EN FABRICA', '/storage/pedidos/YPeRYwPYahinw5n7iHd1T8Mm6qtZgnz6vm4TTYrg.jpg', NULL, 1, 10.00, -5.00, 8, '2025-06-02 20:36:23', '2025-06-02 21:57:40', 'SEBATIAN CORTADO VERDE', '20351438782', 'SAVEEDRA', 1, 1, 1, '03467587600', 'ventas@comofrasrl.com.ar', NULL, 1, 'e55240fe-70ef-4f70-82ba-3df6924b6ef4', 1),
(40, 1, '2025-06-02', '2025-06-23', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 10.00, 0.00, 5, '2025-06-02 22:12:00', '2025-06-02 22:12:00', 'Gustavo Godoy', '20302806285', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, 'ae20c36a-0012-46f9-b99f-524ecc2ed789', 1),
(41, 1, '2025-06-02', '2025-06-23', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 5, '2025-06-03 02:56:30', '2025-06-03 02:56:30', 'Ruben Champrone', '20302806285', 'General Paz 747 Monte Buey Cordoba', 1, 1, 1, '03534191741', 'grgodoy1984@gmail.com', NULL, 1, 'f56fe85d-f808-4279-ae29-c6f165fbdfe6', 1),
(42, 1, '2025-06-03', '2025-06-24', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 5, '2025-06-03 03:27:57', '2025-06-03 03:27:57', 'Gustavo Godoy', '20302806285', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, '2d85c43b-7a57-46b4-bc6a-ec23a7088b1f', 1),
(43, 1, '2025-06-03', '2025-06-24', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/XTFVPaPJU1o5zPmO6cVXpFneLLlU5Axr1dUyoTzd.jpg', NULL, 1, 0.00, 0.00, 5, '2025-06-03 16:44:09', '2025-06-03 16:44:09', 'Hector Strada', '20302806285', 'Ruta 6', 1, 1, 1, '03467587600', 'administracionventas@comofrasrl.com.ar', NULL, 1, '3665cb1a-d088-4fa4-a03c-4040225b7c3f', 1),
(44, 1, '2025-06-03', '2025-06-24', 2, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 7, '2025-06-03 17:09:32', '2025-06-03 17:09:32', 'Prueba234234234', '23423423423', 'Direcionn', 1, 1, 1, '234234234234', 'gustavog@live.com.ar', NULL, 1, 'a45e7b72-62bc-42b5-99e5-9d8dcf7e0685', 1),
(45, 1, '2025-06-03', '2025-06-24', 4, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 13, '2025-06-03 18:16:51', '2025-06-03 18:16:51', 'PruebaCompras', '20163166772', 'Direcionn Compras', 1, 1, 1, '123132', 'compras@comofrasrl.com.ar', NULL, 1, 'd3e8ba03-50b8-46ee-8f4a-3357c88052a7', 1),
(46, 1, '2025-06-03', '2025-06-24', 3, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 7, '2025-06-03 18:35:11', '2025-06-03 18:35:11', 'Hector Strada', '30503529919', 'Ruta 6', 1, 1, 1, '03467587600', 'ind.comofrasrl@gmail.com', NULL, 1, '64df29f2-2d4b-43fd-8237-bbcb6619741f', 1),
(47, 1, '2025-06-03', '2025-06-27', 1, 'Ex-works (EXW) - Retiro desde planta', 'PUESTA EN FABRICA', NULL, NULL, 1, 5.00, 0.00, 8, '2025-06-03 18:38:52', '2025-06-03 18:38:52', 'JUAN TEYO', '30503529919', 'VELEZ SARSFIELD', 2175, 1, 1, '3467587600', 'ventas@comofrasrl.com.ar', NULL, 1, '09843551-531d-4299-8fa3-f1ed23a60033', 1),
(48, 1, '2025-06-03', '2025-06-24', 4, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 7, '2025-06-03 21:37:28', '2025-06-03 21:37:28', 'Ruben Champrone', '20302806285', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, '4fadd2fb-6e13-4fbb-b45f-eab5e3d0460d', 1),
(49, 1, '2025-06-03', '2025-06-24', 3, 'Ex-works (EXW) - Retiro desde planta', NULL, '/storage/pedidos/sTwylH2aGjOAA1CpxCvPBnER3qBlAdLZJLuGLULm.jpg', NULL, 1, 0.00, 0.00, 6, '2025-06-03 21:39:11', '2025-06-03 21:39:11', 'Ruben Champrone', '20302806285', 'General Paz 745', 1, 1, 1, '03534191741', 'gustavog@live.com.ar', NULL, 1, 'd498064c-1596-41ae-bd65-817571bc4a01', 1),
(50, 1, '2025-06-03', '2025-06-24', 1, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 7, '2025-06-03 21:49:48', '2025-06-03 21:49:48', 'VICTOR BOVO', '30709558907', '202 RUTA PROVINCIAL N6', 1, 1, 1, '3467445775', 'gustavog@live.com.ar', NULL, 1, '08b9b96d-e8fd-466d-9e35-be428dd79934', 1),
(51, 1, '2025-06-03', '2025-06-24', 5, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 7, '2025-06-03 21:51:42', '2025-06-03 21:51:42', 'VICTOR BOVO', '30709558907', '202 RUTA PROVINCIAL N6', 1, 1, 1, '3467445775', 'sebabovo3@gmail.com', NULL, 1, '0b38ca93-77ac-41c2-b56e-d1382ec6ed6f', 1),
(52, 1, '2025-06-03', '2025-06-24', 5, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 7, '2025-06-03 21:56:15', '2025-06-03 21:56:15', 'VICTOR BOVO', '30709558907', '202 RUTA PROVINCIAL N6', 1, 1, 1, '03467445775', 'sebabovo3@gmail.com', NULL, 1, '69bcf889-e584-458a-996b-2faa2c828cd1', 1),
(53, 1, '2025-06-03', '2025-06-24', 5, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 7, '2025-06-03 21:58:37', '2025-06-03 21:58:37', 'VICTOR BOVO', '12345678910', '202 RUTA PROVINCIAL N6', 1, 1, 1, '03467445775', 'sebabovo3@gmail.com', NULL, 1, '3399de57-ca86-4b87-bc4a-2f162bcf323b', 1),
(54, 1, '2025-06-03', '2025-06-30', 4, 'Ex-works (EXW) - Retiro desde planta', NULL, NULL, NULL, 1, 0.00, 0.00, 6, '2025-06-03 22:31:56', '2025-06-03 22:31:56', 'Rubén Champrone', '20135905837', 'General Paz 535', 2207, 1, 1, '3468414117', 'rdchamprone@gmail.com', NULL, 1, 'db1a0ca7-8e61-4aef-bfc4-7a2216e5bc7d', 1);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
