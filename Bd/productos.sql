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

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `um_id`, `detalle`, `img`, `img_1`, `img_2`, `img_3`, `links`, `volumen_carga_m3`, `potencia_requerida_hp`, `toma_potencia_tom`, `tiempo_descarga_aprx_min`, `balanza`, `camaras`, `altura_maxima_mm`, `altura_carga_mm`, `longitud_total_mm`, `peso_vacio_kg`, `de_serie`, `opcional`, `colores`, `familia_id`, `activo`, `tipo_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 2200, 'TA-30 \"INNOVA X-TREME\"', 1, 'Cap. 30.000 L (24-25 Tn.) - Ruedas 23-1x30\r\nMedidas totales: Largo 8.500 mm. - Ancho 3.315 mm. - Alto 3.335 mm.\r\nModelos: de 2 ejes\r\nTren giratorio con plato a bolitas - \"SISTEMA BASCULANTE CENTRAL\" - TUBO DE DESCARGA 450 mm Sistema AGDP incoporado - Cámara y Tablet', '/storage/img/F6NsIj1ntjqe5cqNahrtr5YcdpNZksvtDxvKrVQY.png', '/storage/img/4WDbdCiYqd23IT4XfBtcIdVz1O6LU76yTt2j0mZ1.jpg', '/storage/img/NMeSKJMQlYnWfu2Us2x1LeM9Y3W7LakxNXw65zkL.jpg', '/storage/img/y65iKR8MdmvAz9mNzWBiK3tHeZDHmJs9hgmxQgHD.jpg', 'https://comofrasrl.com.ar/tolvas-autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-11 21:16:49', '2025-07-04 02:10:10'),
(4, 199, 'DIFERENCIA DE LLANTAS 20x30x5/8\" (23-1x30) POR 21x32x5/8\" (24-5x32)', 1, NULL, '/storage/img/Fi8mrbG0q5IWFCLHHtURTPcE2S4o1HiKW6WkQOdq.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, 23, 5, '2025-05-17 22:24:14', '2025-05-30 12:28:55'),
(5, 19904073, 'Neumatico 23:1x30 - BKT - 16 T. - P/ACOP. TA-17,5 - TA-26 Y TA-30', 1, NULL, '/storage/img/XiSfMlOPrWO0iKsWuS9SaKus8U94qUoEpHOmIVk0.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 1, 14, 5, '2025-05-17 22:26:42', '2025-05-29 20:57:49'),
(6, 177, 'Rueda', 1, NULL, '/storage/img/mFntUIURSD4d9FyioQ11Zpio7jmcQeY0ZGclKoLm.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 1, 2, 3, '2025-05-17 22:34:33', '2025-05-17 22:36:26'),
(7, 5500, 'ATF 26000 L TUBO DESCARGA CON SIN FIN', 1, 'MODELOS ATF - LINEA QUANTUM\r\nACOPLADO TOLVA PARA SEMILLAS Y FERTILIZANTES A GRANEL\r\nEquipados con kits de luces Led, lona destape rápido, divisorio central, doble boquillas y escaleras tubo descarga 190 mm., cabezal giratorio, motor hidráulico 200 mm. transmisión a engranjes y cadena, Fondo y Pintura tipo EPOXI - ALTO SOLIDO.\r\nModelo ATF 26000 L - Capacidad 26.000 LITROS (20-22 Tn.) - Ruedas 275/80x22,5\r\nMedidas Caja: Largo 5.500 mm. - Ancho 2.900 mm. - Alto 3.570 mm. -', '/storage/img/qt5rfr59ueAh6JBPxE7QaYfZEswCvoL2DEGBeFHS.png', NULL, NULL, NULL, 'https://drive.google.com/file/d/1oHggEanwQT2EyxroTP18uLK8vqItRY2Q/view?usp=drive_link', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 1, 5, '2025-05-17 22:37:03', '2025-05-28 20:40:41'),
(8, 16200, 'Batea V-7,5', 1, 'Modelo BV-7,5 - Volumen Caja 7,5 m3. - Capacidad Maxima Carga 8 Tn. - Eje TIPO BALANCIN - Ruedas 275/80x22,5 - Medidas Caja: Largo 4.300 mm. - Ancho 2.200 mm. - Alto 800 mm.', '/storage/img/WhsdkFRtO4KWSmxUlJwlIPjLtoHpNc0Eg2XIv0CG.png', '/storage/img/ySD23IVQzVoeAhxItkBoY9EcDj5OSuiFf3QLNOYo.png', '/storage/img/wZr0Yn0yLi2q2YFEH0gWUzDCprCNjGmMoSAOA3ay.jpg', '', 'https://comofrasrl.com.ar/bateas-volcadoras/', 7.53, '80 cv', NULL, NULL, NULL, NULL, NULL, 800.00, 4300.00, NULL, NULL, 'RODADO 275-80- 22,5', NULL, 3, 1, 1, 5, '2025-05-22 02:34:25', '2025-07-19 00:08:25'),
(9, 16400, 'Batea V-9,5', 1, 'Modelo BV-9,5 - Volumen Caja 9,5 m3. - Capacidad Maxima Carga 12 Tn. - Eje TIPO BALANCIN - Ruedas 275/80x22,5 - Medidas Caja: Largo 4.300 mm. - Ancho 2.400 mm. - Alto 900 mm.', '/storage/img/tEKhraAkxuwSZ0OyPy8raGLoYDxNWbwUhfUDE4gK.png', '/storage/img/IZ39xKxFLlPUlXnc9Iwrexye6Bu3HxKAlFX23YkG.png', '/storage/img/VkFkND1VxnzgLOo0TcrIY4DjiMaiV0O8yOky1sgR.png', '/storage/img/PbB7vjiRN36cbPi2CuAzftcpBNMVVINjXoLnvmpV.png', 'https://comofrasrl.com.ar/bateas-volcadoras/', 12.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Todos los colores', 3, 1, 1, 7, '2025-05-27 02:52:08', '2025-05-29 19:38:27'),
(13, 1600, 'TA-17,5 \"PRO-ACTION\"', 1, 'Cap. 17.500 LITROS (14-15 Tn.) - Ruedas 23-1x30\r\nMedidas totales: Largo 7.060 mm. - Ancho 3.088 mm. - Alto 3.274 mm. - \r\nTUBO DESCARGA 450 mm', NULL, NULL, NULL, NULL, 'https://comofrasrl.com.ar/autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-28 16:34:57', '2025-05-28 16:34:57'),
(14, 1700, 'TA-21,5 \"PRO-ACTION\"', 1, 'Cap. 21.500 LITROS (16-18 Tn.) - Ruedas 23,1X30\r\nMedidas totales: Largo 7.060 mm. - Ancho 3.461 mm. - Alto 3.458 mm\r\nTUBO DESCARGA 450 mm', NULL, NULL, NULL, NULL, 'https://comofrasrl.com.ar/autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-28 16:36:03', '2025-05-28 16:36:03'),
(15, 2100, 'TA-26 \"INNOVA X-TREME\"', 1, 'Cap. 26.000 L (20-22 Tn.) - Ruedas 23-1x30\r\nMedidas totales: Largo 8.500 mm. - Ancho 3.315 mm. - Alto 3.335 mm.\r\nModelos: de 2 ejes\r\nTren giratorio con plato a bolitas - \"SISTEMA BASCULANTE CENTRAL\" - TUBO DE DESCARGA 450 mm Sistema AGDP incoporado - Cámara y Tablet', '/storage/img/3nthyLvLPWLzx2R8GyZyx0aSWLRu2yYmR1q8QQEf.png', NULL, NULL, NULL, 'https://comofrasrl.com.ar/tolvas-autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-28 16:38:03', '2025-07-04 02:11:58'),
(16, 2300, 'TA-35 \"INNOVA X-TREME \"', 1, 'Cap. 35.000 L (26-28 Tn.) - Ruedas 24-5x32\r\nMedidas totales: Largo 8.500 mm. - Ancho 3.315 mm. - Alto 3.335 mm.\r\nModelos: de 2 ejes\r\nTren giratorio con plato a bolitas - \"SISTEMA BASCULANTE CENTRAL\" - TUBO DE DESCARGA 450 mm Sistema AGDP incoporado - Cámara y Tablet', '/storage/img/wEBXFs1c5Kyr7hgyrAdYiMZ7KyONPy3y3KAktiEs.png', NULL, NULL, NULL, 'https://comofrasrl.com.ar/tolvas-autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-28 16:40:03', '2025-07-04 02:12:09'),
(17, 2400, 'TA-35 \"BUHO X-TREME\"', 1, 'Cap. 35.000 L (26-28 Tn.) - Ruedas 24-5x32\r\nMedidas totales: Largo 8.500 mm. - Ancho 3.545 mm. - Alto 3.722 mm. -\r\nModelos: de 2 ejes\r\nTren giratorio con plato a bolitas - \"SISTEMA BASCULANTE CENTRAL\" - TUBO DE DESCARGA 515 mm Sistema AGDP incoporado - Cámara y Tablet', '/storage/img/Reu3jvw6KF3ZZJnr3MgfaKtGPzflqJmF0h8j8uK7.png', NULL, NULL, NULL, 'https://comofrasrl.com.ar/tolvas-autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-28 16:41:48', '2025-07-04 02:12:19'),
(18, 2600, 'TA-38 \"BUHO X-TREME \"', 1, 'Cap. - 38.000 L (28-30 Tn.) Con Ruedas 24-5x32 \r\nMedidas totales: Largo 9.145 mm. - Ancho 3.726 mm. - Alto 3.738 mm. -\r\nTren giratorio con plato a bolitaa-SISTEMA BASCULANTE CENTRAL -TUBO DESCARGA Ø515 mm\r\nSistema AGDP incoporado. Cámara y Tablet', '/storage/img/H1mnf0zgHLDb5AHzbZeOmqJFK89QIO1Z1VSmjKeC.png', NULL, NULL, NULL, 'https://comofrasrl.com.ar/tolvas-autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-28 16:43:14', '2025-07-04 02:12:35'),
(19, 2800, 'TA-45 \"BUHO X-TREME\"', 1, 'Cap. 45.000 L. (34-36 Tn.) - DUALES TRASERAS\r\nRuedas: delanteras 28-Lx26 y traseras duales 23-1x26\r\nMedidas totales: Largo 10.100 mm. - Ancho 3.650 mm. - Alto 3.650 mm.\r\nMEGA ACOPLADO - 35 Tn.: Dotado de sistema \"ANTI-INCENDIO\" compuesto por tanque de agua 310 L\r\nbomba eléctrica y mangueras con picos rociadores, fondo \"AUTO-LIMPIANTE\" accionamiento hidráulico', '/storage/img/ttxaSJOZd63LPLEg0X0UZwRNyQiVkmfXgohp3QrO.png', NULL, NULL, NULL, 'https://comofrasrl.com.ar/tolvas-autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-28 16:44:47', '2025-07-04 02:12:47'),
(20, 2801, 'TA-45 \" BUHO X-TREME\"', 1, 'Cap. 45.000 L. (34-36 Tn.) - SIMPLE TRASERAS\r\nRuedas: delanteras 28-Lx26 y traseras 30,5 LR32 Ó 900/65 R32\r\nMedidas totales: Largo 10.100 mm. - Ancho 3.650 mm. - Alto 3.650 mm.\r\nMEGA ACOPLADO - 35 Tn.: Dotado de sistema \"ANTI-INCENDIO\" compuesto por tanque de agua 310 L\r\nbomba eléctrica y mangueras con picos rociadores, fondo \"AUTO-LIMPIANTE\" accionamiento hidráulico', '/storage/img/IzEHFKlh4SPxJnxPu7HGl6EwcCpEZs1Nbc25E7ld.png', NULL, NULL, NULL, 'https://comofrasrl.com.ar/autodescargables/', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 5, '2025-05-28 16:45:44', '2025-05-28 23:43:52'),
(21, 909171, 'MOVIMIENTO TRANSVERSAL ELECTRICO BOQUILLA DESCARGA', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, 21, 5, '2025-05-28 16:48:21', '2025-05-30 12:29:34'),
(22, 909117, 'CONJUNTO CAMISA - TUBO DIAMETRO 450 mm.', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, 21, 5, '2025-05-28 16:49:41', '2025-05-30 12:25:11'),
(23, 609085, 'CONJUNTO CAMISA - TUBO DIAMETRO 515 mm.', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, 21, 5, '2025-05-28 16:50:14', '2025-05-30 12:26:27'),
(24, 909123, 'CONJUNTO CAMISA \"ACERO INOXIDABLE\" - TUBO DIAMETRO 450 mm', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 1, 2, 5, '2025-05-28 16:50:34', '2025-05-28 16:51:25'),
(25, 609087, 'CONJUNTO CAMISA \"ACERO INOXIDABLE\" - TUBO DIAMETRO 515 mm.', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, 21, 5, '2025-05-28 16:50:48', '2025-05-30 12:26:42');


ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productos_codigo_unique` (`codigo`),
  ADD UNIQUE KEY `productos_nombre_unique` (`nombre`),
  ADD KEY `productos_um_id_foreign` (`um_id`),
  ADD KEY `productos_familia_id_foreign` (`familia_id`),
  ADD KEY `productos_tipo_id_foreign` (`tipo_id`),
  ADD KEY `productos_user_id_foreign` (`user_id`);


ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
