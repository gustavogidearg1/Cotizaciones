-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bd_cotizacion
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoria_categoria_unique` (`categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Categoria 1','','2025-05-11 18:09:59',NULL),(2,'Categoria 2','','2025-05-11 18:09:59',NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colores`
--

DROP TABLE IF EXISTS `colores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `colores_nombre_unique` (`nombre`),
  UNIQUE KEY `colores_descripcion_unique` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colores`
--

LOCK TABLES `colores` WRITE;
/*!40000 ALTER TABLE `colores` DISABLE KEYS */;
INSERT INTO `colores` VALUES (1,'Amarillo Comofra','#FF9900','2025-04-27 19:41:01',NULL),(2,'Verde VJD','MCF230','2025-04-27 19:41:01',NULL),(3,'No lleva color',NULL,'2025-05-14 03:35:05',NULL);
/*!40000 ALTER TABLE `colores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizaciones`
--

DROP TABLE IF EXISTS `cotizaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotizaciones` (
  `id` bigint(20) unsigned NOT NULL,
  `cotizacion` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `vencimiento` date NOT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cotizaciones_cotizacion_unique` (`cotizacion`),
  KEY `cotizaciones_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones`
--

LOCK TABLES `cotizaciones` WRITE;
/*!40000 ALTER TABLE `cotizaciones` DISABLE KEYS */;
INSERT INTO `cotizaciones` VALUES (1,'Lista 2','descripcion','2025-06-11',NULL,3,'2025-05-11 21:18:01','2025-05-11 21:18:01');
/*!40000 ALTER TABLE `cotizaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familias`
--

DROP TABLE IF EXISTS `familias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `familias` (
  `id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL,
  `imagen_secundaria` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familias`
--

LOCK TABLES `familias` WRITE;
/*!40000 ALTER TABLE `familias` DISABLE KEYS */;
INSERT INTO `familias` VALUES (1,'Auto descargable','images/i0TrXDa0r7nIVK1dvY183C0JKcIkxhYytLhq8sN4.png',NULL,NULL,'2025-05-11 21:18:43'),(2,'Fertilizante','images/guTiS0EXo0kHJDWVJbhS83SJ7iKKvZTmlNaR6ykz.png',NULL,NULL,'2025-05-11 21:18:56'),(3,'Batea Volcadora','images/9O0jNjJbIch9cHIy4cmf5YKKi1OEGc1G9CEkiaBL.png',NULL,NULL,'2025-05-11 21:19:06'),(4,'Mixer Hotizontal','images/LXnhFdfKTNTL2uWtR0FQwsPaRYgexReiN9VkNxTp.png',NULL,NULL,'2025-05-11 21:19:14'),(5,'Mixer Vertical','images/seRsZha0aLgTSrPS2jdDmJYd4eVoi3X6ArBgUZon.png',NULL,NULL,'2025-05-11 21:19:23'),(6,'Acoplado Chicos','images/F1bRlTPqvxhEk4DZDGYVGTn6tq0Q0m2SKImoOeni.png',NULL,NULL,'2025-05-11 21:19:32');
/*!40000 ALTER TABLE `familias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fletes`
--

DROP TABLE IF EXISTS `fletes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fletes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fletes`
--

LOCK TABLES `fletes` WRITE;
/*!40000 ALTER TABLE `fletes` DISABLE KEYS */;
INSERT INTO `fletes` VALUES (1,'A cargo del cliente',NULL,NULL),(2,'A cargo de la empresa',NULL,NULL),(3,'Mitad y mitad',NULL,NULL);
/*!40000 ALTER TABLE `fletes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pagos`
--

DROP TABLE IF EXISTS `forma_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pagos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `diferencia` decimal(5,2) NOT NULL DEFAULT 0.00,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pagos`
--

LOCK TABLES `forma_pagos` WRITE;
/*!40000 ALTER TABLE `forma_pagos` DISABLE KEYS */;
INSERT INTO `forma_pagos` VALUES (1,'Contado',NULL,0.00,1,'2025-05-08 21:58:21',NULL),(2,'En 12 cuotas',NULL,10.00,1,'2025-05-08 21:58:21',NULL);
/*!40000 ALTER TABLE `forma_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localidad`
--

DROP TABLE IF EXISTS `localidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localidad` (
  `id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `provincia_id` bigint(20) unsigned NOT NULL,
  `pais_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `localidad_localidad_unique` (`nombre`),
  KEY `localidad_provincia_id_foreign` (`provincia_id`),
  KEY `localidad_pais_id_foreign` (`pais_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localidad`
--

LOCK TABLES `localidad` WRITE;
/*!40000 ALTER TABLE `localidad` DISABLE KEYS */;
INSERT INTO `localidad` VALUES (1,'Monte Buey','2589',1,1,'2025-05-08 19:00:20',NULL),(2,'Irriville','2587',1,1,'2025-05-08 19:00:20',NULL);
/*!40000 ALTER TABLE `localidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_04_10_000045_create_roles_table',1),(5,'2025_04_10_002307_add_role_id_to_users_table',1),(6,'2025_04_12_104504_create_unidades_table',1),(7,'2025_04_12_104618_create_familias_table',1),(8,'2025_04_12_104645_create_tipos_table',1),(9,'2025_04_12_104715_create_productos_table',1),(10,'2025_04_13_124234_create_pais_table',1),(11,'2025_04_13_124346_create_provincia_table',1),(12,'2025_04_13_124425_create_localidad_table',1),(13,'2025_04_13_124502_create_categoria_table',1),(14,'2025_04_13_124523_create_cliente_table',1),(15,'2025_04_13_182534_create_monedas_table',1),(16,'2025_04_13_182601_create_cotizaciones_table',1),(17,'2025_04_13_182619_create_sub_cotizaciones_table',1),(18,'2025_04_14_235007_create_forma_pagos_table',1),(19,'2025_04_14_235010_create_pedidos_table',1),(20,'2025_04_14_235010_create_sub_pedidos_table',1),(21,'2025_04_19_005646_create_tipo_pedidos_table',1),(22,'2025_04_19_005652_create_fletes_table',1),(23,'2025_04_19_005708_update_pedidos_and_sub_pedidos_tables',1),(24,'2025_04_25_222247_add_image_fields_to_familias_table',1),(25,'2025_04_26_153107_update_pedidos_table',1),(26,'2025_04_26_175751_fix_pedidos_relations',1),(27,'2025_04_26_180332_add_cp_to_localidad_table',1),(28,'2025_04_26_180615_update_localidad_cp_column',1),(29,'2025_04_27_131836_create_colores_table',1),(30,'2025_04_27_132514_add_color_id_to_pedidos_table',1),(31,'2025_04_27_135455_move_color_id_to_sub_pedidos',1),(32,'2025_05_09_232941_add_diferencia_to_forma_pagos_table',1),(33,'2025_05_09_233817_add_activo_to_forma_pagos_table',1),(34,'2025_05_10_151433_remove_plazo_entrega_and_solicitante_from_pedidos_table',1),(35,'2025_05_10_192011_rename_localidad_to_nombre_in_localidades_table',1),(36,'2025_05_11_150546_create_provincias_table',2),(39,'2025_05_11_150623_create_localidades_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monedas`
--

DROP TABLE IF EXISTS `monedas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monedas` (
  `id` bigint(20) unsigned NOT NULL,
  `moneda` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `monedas_moneda_unique` (`moneda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monedas`
--

LOCK TABLES `monedas` WRITE;
/*!40000 ALTER TABLE `monedas` DISABLE KEYS */;
INSERT INTO `monedas` VALUES (1,'Dolares','2025-05-11 18:09:31',NULL),(2,'Pesos','2025-05-11 18:09:31',NULL);
/*!40000 ALTER TABLE `monedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `id` bigint(20) unsigned NOT NULL,
  `pais` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pais_pais_unique` (`pais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'Argentina','2025-04-26 19:50:56',NULL),(2,'Uruguay','2025-04-26 19:50:56',NULL);
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_pedido_id` bigint(20) unsigned NOT NULL DEFAULT 1,
  `fecha` date NOT NULL,
  `fecha_necesidad` date NOT NULL,
  `forma_pago_id` bigint(20) unsigned NOT NULL,
  `forma_entrega` varchar(255) NOT NULL,
  `observacion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen_2` varchar(255) DEFAULT NULL,
  `flete_id` bigint(20) unsigned DEFAULT NULL,
  `bonificacion` decimal(5,2) NOT NULL DEFAULT 0.00,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cliente` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `localidad_id` bigint(20) unsigned NOT NULL,
  `provincia_id` bigint(20) unsigned NOT NULL,
  `pais_id` bigint(20) unsigned NOT NULL DEFAULT 1,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `categoria_id` bigint(20) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `pedidos_forma_pago_id_foreign` (`forma_pago_id`),
  KEY `pedidos_user_id_foreign` (`user_id`),
  KEY `pedidos_tipo_pedido_id_foreign` (`tipo_pedido_id`),
  KEY `pedidos_flete_id_foreign` (`flete_id`),
  KEY `pedidos_localidad_id_foreign` (`localidad_id`),
  KEY `pedidos_provincia_id_foreign` (`provincia_id`),
  KEY `pedidos_pais_id_foreign` (`pais_id`),
  KEY `pedidos_categoria_id_foreign` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,1,'2025-04-17','2025-05-13',1,'Ex-works (EXW) - Retiro desde planta','observacion','imagen','imagen_2',2,0.00,3,'2025-05-14 02:50:07',NULL,'cliente','direccion',2,1,1,'telefono','email','contacto',1),(4,1,'2025-05-17','2025-05-31',1,'Ex-works (EXW) - Retiro desde planta',NULL,NULL,NULL,1,0.00,3,'2025-05-17 18:16:54','2025-05-17 18:16:54','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','gustavog@live.com.ar','Un contacto',1),(5,1,'2025-05-17','2025-05-31',1,'Ex-works (EXW) - Retiro desde planta',NULL,'/storage/pedidos/f0WGT3f18axyaS4AZiemJnlK7pVMc69YGyT50vH4.png',NULL,1,0.00,3,'2025-05-17 18:27:34','2025-05-17 18:27:34','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','gustavog@live.com.ar',NULL,1),(6,1,'2025-05-17','2025-05-31',1,'Ex-works (EXW) - Retiro desde planta',NULL,'/storage/pedidos/8jLknajmUoYseAy69Lmn1e9gry3sSk03Npi7YpCG.png',NULL,1,0.00,3,'2025-05-17 18:41:52','2025-05-17 18:41:52','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','gustavog@live.com.ar',NULL,1),(7,1,'2025-05-17','2025-05-31',1,'Ex-works (EXW) - Retiro desde planta',NULL,NULL,NULL,1,0.00,3,'2025-05-17 18:51:39','2025-05-17 18:51:39','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','gustavog@live.com.ar','Un contacto',1),(8,1,'2025-05-17','2025-05-31',1,'Ex-works (EXW) - Retiro desde planta',NULL,'/storage/pedidos/bNQDM0rR9Hff2nDgdE9Li0n0sBd6eDho9BBFUwa3.png',NULL,1,0.00,3,'2025-05-17 19:00:47','2025-05-17 19:00:47','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','gustavog@live.com.ar',NULL,1),(9,2,'2025-05-17','2025-05-31',2,'Ex-works (EXW) - Retiro desde planta',NULL,NULL,NULL,1,0.00,3,'2025-05-17 19:11:44','2025-05-17 19:11:44','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','gustavog@live.com.ar','Un contacto',1),(10,1,'2025-05-17','2025-05-31',2,'Ex-works (EXW) - Retiro desde planta',NULL,NULL,NULL,1,0.00,3,'2025-05-17 19:18:54','2025-05-17 19:18:54','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','grgodoy1984@gmail.com','Un contacto',1),(11,1,'2025-05-17','2025-05-31',1,'Ex-works (EXW) - Retiro desde planta',NULL,NULL,NULL,1,0.00,3,'2025-05-17 19:37:46','2025-05-17 19:37:46','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','gustavog@live.com.ar','Un contacto',1),(12,1,'2025-05-17','2025-05-31',2,'Ex-works (EXW) - Retiro desde planta',NULL,NULL,NULL,1,0.00,3,'2025-05-17 19:39:00','2025-05-17 19:39:00','Gustavo Godoy','General Paz 745',1,1,1,'03534191741','gustavog@live.com.ar','Un contacto',1);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `um_id` bigint(20) unsigned NOT NULL,
  `detalle` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `img_1` varchar(255) DEFAULT NULL,
  `img_2` varchar(255) DEFAULT NULL,
  `img_3` varchar(255) DEFAULT NULL,
  `familia_id` bigint(20) unsigned NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `tipo_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_codigo_unique` (`codigo`),
  UNIQUE KEY `productos_nombre_unique` (`nombre`),
  KEY `productos_um_id_foreign` (`um_id`),
  KEY `productos_familia_id_foreign` (`familia_id`),
  KEY `productos_tipo_id_foreign` (`tipo_id`),
  KEY `productos_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (3,2200,'Auto descargable',1,NULL,'/storage/img/F6NsIj1ntjqe5cqNahrtr5YcdpNZksvtDxvKrVQY.png',NULL,NULL,NULL,1,1,1,3,'2025-05-11 21:16:49','2025-05-11 21:16:49');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provincia` (
  `id` bigint(20) unsigned NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `pais_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provincia_provincia_unique` (`provincia`),
  KEY `provincia_pais_id_foreign` (`pais_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` VALUES (1,'Cordoba',1,'2025-04-26 19:52:31',NULL),(2,'Santa Fe',1,'2025-04-26 19:52:31',NULL);
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador',NULL,'2025-04-26 19:49:19',NULL),(2,'Editor',NULL,'2025-04-26 19:49:19',NULL),(3,'Invitado',NULL,'2025-04-26 19:49:48',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('5E521cRuuBnFQnSALhUh2tEWTb8YAnFjIBEPGB6h',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoid2ptVjJqcDQyNFpWZjc4VUQ3eUlTdFl0MDV0c2huNmJmYWxwN2plTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZWRpZG9zLzEyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDc0OTM2Nzk7fX0=',1747499946);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_cotizaciones`
--

DROP TABLE IF EXISTS `sub_cotizaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_cotizaciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `moneda_id` bigint(20) unsigned NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `precio_bonificado` decimal(12,2) NOT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `cotizacion_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_cotizaciones_producto_id_foreign` (`producto_id`),
  KEY `sub_cotizaciones_moneda_id_foreign` (`moneda_id`),
  KEY `sub_cotizaciones_cotizacion_id_foreign` (`cotizacion_id`),
  CONSTRAINT `sub_cotizaciones_cotizacion_id_foreign` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizaciones` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sub_cotizaciones_moneda_id_foreign` FOREIGN KEY (`moneda_id`) REFERENCES `monedas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sub_cotizaciones_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_cotizaciones`
--

LOCK TABLES `sub_cotizaciones` WRITE;
/*!40000 ALTER TABLE `sub_cotizaciones` DISABLE KEYS */;
INSERT INTO `sub_cotizaciones` VALUES (1,3,1,100000.00,100000.00,0.00,'-',1,'2025-05-11 21:18:01','2025-05-11 21:18:01');
/*!40000 ALTER TABLE `sub_cotizaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_pedidos`
--

DROP TABLE IF EXISTS `sub_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) unsigned NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `subbonificacion` decimal(5,2) NOT NULL,
  `iva` decimal(5,2) NOT NULL DEFAULT 21.00,
  `cantidad` int(11) NOT NULL,
  `moneda_id` bigint(20) unsigned NOT NULL,
  `sub_fecha_entrega` date NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `detalle` text DEFAULT NULL,
  `pedido_id` bigint(20) unsigned NOT NULL,
  `color_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_pedidos_producto_id_foreign` (`producto_id`),
  KEY `sub_pedidos_moneda_id_foreign` (`moneda_id`),
  KEY `sub_pedidos_pedido_id_foreign` (`pedido_id`),
  KEY `sub_pedidos_color_id_foreign` (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_pedidos`
--

LOCK TABLES `sub_pedidos` WRITE;
/*!40000 ALTER TABLE `sub_pedidos` DISABLE KEYS */;
INSERT INTO `sub_pedidos` VALUES (1,3,10000.00,0.00,21.00,1,1,'2025-05-13',0.00,0.00,NULL,1,1,'2025-05-14 02:51:26',NULL),(2,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,4,1,'2025-05-17 18:16:54','2025-05-17 18:16:54'),(3,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,5,1,'2025-05-17 18:27:34','2025-05-17 18:27:34'),(4,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,6,1,'2025-05-17 18:41:52','2025-05-17 18:41:52'),(5,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,7,NULL,'2025-05-17 18:51:39','2025-05-17 18:51:39'),(6,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,8,1,'2025-05-17 19:00:47','2025-05-17 19:00:47'),(7,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,9,1,'2025-05-17 19:11:44','2025-05-17 19:11:44'),(8,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,10,1,'2025-05-17 19:18:54','2025-05-17 19:18:54'),(9,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,11,NULL,'2025-05-17 19:37:46','2025-05-17 19:37:46'),(10,3,100000.00,0.00,10.50,1,1,'2025-05-31',100000.00,110500.00,NULL,12,NULL,'2025-05-17 19:39:00','2025-05-17 19:39:00');
/*!40000 ALTER TABLE `sub_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_pedidos`
--

DROP TABLE IF EXISTS `tipo_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_pedidos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_pedidos`
--

LOCK TABLES `tipo_pedidos` WRITE;
/*!40000 ALTER TABLE `tipo_pedidos` DISABLE KEYS */;
INSERT INTO `tipo_pedidos` VALUES (1,'Cotizacion',NULL,NULL),(2,'Pedido',NULL,NULL);
/*!40000 ALTER TABLE `tipo_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'Implemento','2025-04-26 19:51:32',NULL),(2,'Accesorio','2025-04-28 00:56:16',NULL);
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidades` (
  `id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'Unidad','2025-05-11 18:11:09',NULL);
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Gustavo Godoy','gustavog@live.com.ar',NULL,'$2y$12$XNeKY3UaXegT4LaGxhhOM.kNgJJNDJhGFDo8iQhulVQCT7mzZorsm',NULL,'2025-04-26 22:50:17','2025-04-26 22:50:17',1),(4,'Godoy Gustavo','grgodoy1984@gmail.com',NULL,'$2y$12$z8qEGLYZQbXAmoPCXo5MF.AoqAsuPMEtLwPiXWKSfQF2G7Fkbp93C',NULL,'2025-05-03 20:41:55','2025-05-03 20:41:55',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-17 13:40:49
