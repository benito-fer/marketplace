-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: marketplace_alora
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `imagen_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (2,'Alimentaci├│n','Productos de alimentaci├│n','images/categorias/alimentacion.png','2025-05-28 04:17:23','2025-05-28 04:17:23'),(3,'Cosm├®tica','Productos de cosm├®tica','images/categorias/cosmetica.png','2025-05-28 04:17:23','2025-05-28 04:17:23'),(4,'Ropa','Productos de ropa','images/categorias/ropa.png','2025-05-28 04:17:23','2025-05-28 04:17:23'),(5,'Zapatos','Productos de zapatos','images/categorias/zapatos.png','2025-05-28 04:17:23','2025-05-28 04:17:23'),(6,'Hogar','Art├¡culos para el hogar','images/categorias/hogar.png','2025-05-28 04:17:23','2025-05-28 04:17:23'),(7,'Deportes','Art├¡culos deportivos','images/categorias/deportes.png','2025-05-28 04:17:23','2025-05-28 04:17:23'),(8,'Electr├│nica','Productos electr├│nicos','images/categorias/electronica.png','2025-05-28 04:17:23','2025-05-28 04:17:23');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contactos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_contacto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contactos_user_id_foreign` (`user_id`),
  CONSTRAINT `contactos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (1,2,'666666666','ferrobenito28@hotmail.com','2025-05-28 04:22:06','2025-05-28 04:22:06'),(2,3,'666666666','pilimun75@gmail.com','2025-05-28 04:24:24','2025-05-28 04:24:24');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_04_17_171521_create_categorias_table',1),(5,'2025_04_17_171522_create_productos_table',1),(6,'2025_05_02_074724_add_rol_to_users_table9',1),(7,'2025_05_05_111646_add_tipo_field_to_users_table',1),(8,'2025_05_10_000000_add_contact_fields_to_users_table',1),(9,'2025_05_27_100548_create_contactos_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_categoria_id_foreign` (`categoria_id`),
  KEY `productos_user_id_foreign` (`user_id`),
  CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `productos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'jersey de mujer','jersey de mujer',25.00,5,'img/productos/1748413326_6836ab8e7de9f.jpeg',4,2,'2025-05-28 04:22:06','2025-05-28 04:22:06'),(2,'zapatos de ni├▒o','zapatos de ni├▒o',20.00,5,'img/productos/1748413364_6836abb4741ce.jpg',5,2,'2025-05-28 04:22:44','2025-05-28 04:22:44'),(3,'miel la molina','miel',8.00,50,'img/productos/1748413398_6836abd6075f9.jpeg',2,2,'2025-05-28 04:23:18','2025-05-28 04:23:18'),(4,'aceitunas','aceitunas',9.00,5,'img/productos/1748413464_6836ac183babd.png',2,3,'2025-05-28 04:24:24','2025-05-28 04:24:24'),(5,'movil','samsung',200.00,5,'img/productos/1748413670.jpeg',8,3,'2025-05-28 04:24:53','2025-05-28 04:27:50'),(6,'queso de cabra','queso',6.00,10,'img/productos/1748413525_6836ac55e656f.jpg',2,3,'2025-05-28 04:25:25','2025-05-28 04:25:25'),(7,'jabon casero','jabon',5.00,55,'img/productos/1748413649_6836acd1e002c.jpeg',3,3,'2025-05-28 04:27:29','2025-05-28 04:27:29'),(8,'batidora','batidora',60.00,5,'img/productos/1748413757_6836ad3d6f11e.jpeg',6,3,'2025-05-28 04:29:17','2025-05-28 04:29:17');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('4p6QbV0pixfOttMxu9RSxfPF4b5ObrIpv9ZLbFqH',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiekprWmlla0FKalVFVUJ3dlZjaGhiTTNOTzRlbnN6eWFWSHRqN3NnYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1748434157),('5TEAugwwLQePy0c2AZMdEkUVdydwcZehcg2nRXOv',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoibjBTZU9OUnFCUWY1RFdHeTBYOThwV1ZjQ3NadWdDWTZlRHJNcHpMZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1748430053),('F0e9Eh7nWarxdzF63nMxXjs5WIFWBej0pfqSgZvF',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiR1ltRXkzdHc3RUdSZm4yemp2dDZvZXpMVjhoZ3NTRm9HdllMQ3J1bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1748639374),('rSXZPCfvFUolfioMZdiJMxvCwSsCi7Vu2urMuCK1',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiaWtXWFNoZjVsSk5xRVB1U3ZERlFvbnRrSUhxVUxlQmJvMVl1Q2NjMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1748429508),('SafkjQTBawgYqz3XoDExwmylgUotHIdmDWzIKiT6',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoidG5xMWFrcGxJRkVpclE0VDdNeThkZ3BBclc5TVFINTFaMDVvakpQYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1748425885),('tw1E7yRMCEqpBY4IcBeUJRmMpvaE7ebWIZl7wUhF',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiRmxGTlhvWGpRT0RTdHExeFE4RzFSNXkyVW81Sk9sOFhiQnZIVFgwMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1748426165),('VA6hno0BJbVQqPv67tqgOWXkLHpnh49IjPEHvqZS',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiSElvMG1IRmVsVWEwTGRHcWZ4bVJuU0diYzdNTVR4dmxVaUpVaVhoRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1748426699),('WaMzTBIisqadnbck9h3G9oudtIRO9FEfxdPm7RQw',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0tMY211QUJiaHdsZENHY1pvQm42VWMzVUpzUkFJQXFNVWpYV3NkSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=',1748434157),('XXq9gYgXQeIMis1xCwVlogeVeALiRUP1WiyMEMgN',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibTJoMjhFcjNkZ3ZhdlBBaHZZSkI5UVRKcTMwN3VNQlczOHR1cGVaTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0b3MvbWFzLXZpc3RvcyI7fX0=',1748639389);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Benito Fern├índez Mendoza','ferrobenito28@hotmail.com',NULL,NULL,NULL,'$2y$12$mJKMseFQvdx5ldMF.QkkoeF5kstFJzMzbTBijz9N/wrLqmOTB5uJC',NULL,'2025-05-28 04:21:18','2025-05-28 04:21:18','comerciante','cliente'),(3,'Pilar Mu├▒oz S├ínchez','pilimun75@gmail.com',NULL,NULL,NULL,'$2y$12$lg3BhFCr2ps7Qrv2U11aGe6EcioFmE9vLyyH4C8LkJcoR3xRudqie',NULL,'2025-05-28 04:23:49','2025-05-28 04:23:49','comerciante','cliente'),(4,'juan antonio','bntFM1977@hotmail.com',NULL,NULL,NULL,'$2y$12$1AOmPyj.Cj.ZjdcnmHwpI..RbKoLDBftDZXj9c7c5qGM1r7w3U0bm',NULL,'2025-05-28 04:29:58','2025-05-28 04:29:58','cliente','cliente'),(5,'juan','beni.fernandez34@gmail.com',NULL,NULL,NULL,'$2y$12$TG1Du4o17ZxbkYzDRi.7pecqPyZwqfxQ.RHxnbFOrOoLnt0KPac16',NULL,'2025-05-28 07:59:57','2025-05-28 07:59:57','cliente','cliente');
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

-- Dump completed on 2025-05-30 23:13:59
