-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bobby_holidays
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Current Database: `bobby_holidays`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bobby_holidays` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `bobby_holidays`;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cta_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `video_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_poster` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `starts_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banners_position_index` (`position`),
  KEY `banners_is_active_index` (`is_active`),
  KEY `banners_sort_order_index` (`sort_order`),
  KEY `banners_starts_at_index` (`starts_at`),
  KEY `banners_ends_at_index` (`ends_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Journeys Designed Around You','Personalised holidays, thoughtfully planned','Considered itineraries across India and selected international destinations, supported from enquiry to return.','Explore Holidays','/domestic-packages','assets/frontend/images/demo/destination-kashmir.webp','assets/frontend/images/demo/destination-kashmir.webp','image',NULL,NULL,'homepage_hero',1,1,NULL,NULL,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_logs`
--

DROP TABLE IF EXISTS `booking_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_logs_record_id_index` (`record_id`),
  KEY `booking_logs_user_id_index` (`user_id`),
  KEY `booking_logs_action_index` (`action`),
  KEY `booking_logs_created_at_index` (`created_at`),
  CONSTRAINT `booking_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_logs`
--

LOCK TABLES `booking_logs` WRITE;
/*!40000 ALTER TABLE `booking_logs` DISABLE KEYS */;
INSERT INTO `booking_logs` VALUES (1,1,NULL,'created','Booking created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(2,2,NULL,'created','Booking created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(3,3,NULL,'created','Booking created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(4,1,NULL,'updated','Updated: travel_date, return_date','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"return_date\": \"2026-10-25T00:00:00.000000Z\", \"travel_date\": \"2026-10-20T00:00:00.000000Z\"}','{\"return_date\": \"2026-10-26 00:00:00\", \"travel_date\": \"2026-10-21 00:00:00\"}','127.0.0.1','2026-09-15 21:05:06'),(5,2,NULL,'updated','Updated: travel_date, return_date','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"return_date\": \"2026-11-05T00:00:00.000000Z\", \"travel_date\": \"2026-11-01T00:00:00.000000Z\"}','{\"return_date\": \"2026-11-06 00:00:00\", \"travel_date\": \"2026-11-02 00:00:00\"}','127.0.0.1','2026-09-15 21:05:07'),(6,3,NULL,'updated','Updated: travel_date, return_date','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"return_date\": \"2026-11-17T00:00:00.000000Z\", \"travel_date\": \"2026-11-13T00:00:00.000000Z\"}','{\"return_date\": \"2026-11-18 00:00:00\", \"travel_date\": \"2026-11-14 00:00:00\"}','127.0.0.1','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `booking_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_sequences`
--

DROP TABLE IF EXISTS `booking_sequences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_sequences` (
  `year` smallint unsigned NOT NULL,
  `last_number` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_sequences`
--

LOCK TABLES `booking_sequences` WRITE;
/*!40000 ALTER TABLE `booking_sequences` DISABLE KEYS */;
INSERT INTO `booking_sequences` VALUES (2026,3);
/*!40000 ALTER TABLE `booking_sequences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_status_histories`
--

DROP TABLE IF EXISTS `booking_status_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_status_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned DEFAULT NULL,
  `changed_by` bigint unsigned DEFAULT NULL,
  `old_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_status_histories_booking_id_index` (`booking_id`),
  KEY `booking_status_histories_changed_by_index` (`changed_by`),
  KEY `booking_status_histories_old_status_index` (`old_status`),
  KEY `booking_status_histories_new_status_index` (`new_status`),
  KEY `booking_status_histories_created_at_index` (`created_at`),
  CONSTRAINT `booking_status_histories_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `booking_status_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_status_histories`
--

LOCK TABLES `booking_status_histories` WRITE;
/*!40000 ALTER TABLE `booking_status_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking_status_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quotation_id` bigint unsigned DEFAULT NULL,
  `enquiry_id` bigint unsigned DEFAULT NULL,
  `tour_id` bigint unsigned DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `adults` tinyint unsigned NOT NULL DEFAULT '1',
  `children` tinyint unsigned NOT NULL DEFAULT '0',
  `infants` tinyint unsigned NOT NULL DEFAULT '0',
  `total_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `paid_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `balance_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'confirmed',
  `cancellation_reason` text COLLATE utf8mb4_unicode_ci,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `special_requests` text COLLATE utf8mb4_unicode_ci,
  `internal_notes` text COLLATE utf8mb4_unicode_ci,
  `assigned_to` bigint unsigned DEFAULT NULL,
  `gst_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_booking_ref_unique` (`booking_ref`),
  UNIQUE KEY `bookings_quotation_id_unique` (`quotation_id`),
  KEY `bookings_quotation_id_index` (`quotation_id`),
  KEY `bookings_enquiry_id_index` (`enquiry_id`),
  KEY `bookings_tour_id_index` (`tour_id`),
  KEY `bookings_assigned_to_index` (`assigned_to`),
  KEY `bookings_status_index` (`status`),
  KEY `bookings_travel_date_index` (`travel_date`),
  KEY `bookings_created_at_index` (`created_at`),
  KEY `bookings_status_created_composite` (`status`,`created_at`),
  KEY `bookings_status_balance_composite` (`status`,`balance_amount`),
  CONSTRAINT `bookings_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_enquiry_id_foreign` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'UW-2026-000001',1,1,1,'Arjun & Nisha Mehta','arjun.mehta@demo.test','+91 98250 11001','2026-10-21','2026-10-26',2,0,0,87250.00,30000.00,57250.00,'INR','partial_paid',NULL,NULL,'Vegetarian breakfast and adjacent rooms where applicable.',NULL,4,NULL,0.00,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,'UW-2026-000002',2,2,5,'The Shah Family','shah.family@demo.test','+91 98250 11002','2026-11-02','2026-11-06',2,1,0,224700.00,0.00,224700.00,'INR','confirmed',NULL,NULL,'Vegetarian breakfast and adjacent rooms where applicable.',NULL,4,NULL,0.00,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(3,'UW-2026-000003',3,3,7,'Riya and Dev Patel','riya.patel@demo.test','+91 98250 11003','2026-11-14','2026-11-18',2,0,0,309800.00,309800.00,0.00,'INR','fully_paid',NULL,NULL,'Vegetarian breakfast and adjacent rooms where applicable.',NULL,4,NULL,0.00,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0','i:4;',1789832931),('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer','i:1789832931;',1789832931),('laravel-cache-nav.bookings.active','i:2;',1789832939),('laravel-cache-nav.enquiries.new','N;',1789832957),('laravel-cache-nav.quotations.draft','i:1;',1789832939),('laravel-cache-report.sales','a:5:{s:8:\"pipeline\";a:5:{s:3:\"new\";i:0;s:9:\"contacted\";i:1;s:6:\"quoted\";i:1;s:9:\"converted\";i:3;s:4:\"lost\";i:0;}s:7:\"sources\";a:5:{s:7:\"website\";i:1;s:8:\"referral\";i:1;s:9:\"instagram\";i:1;s:8:\"whatsapp\";i:1;s:6:\"walkin\";i:1;}s:14:\"quotationStats\";a:5:{s:10:\"total_sent\";i:4;s:8:\"accepted\";i:3;s:8:\"rejected\";i:0;s:7:\"expired\";i:0;s:9:\"avg_value\";s:13:\"207250.000000\";}s:15:\"topDestinations\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:18:\"App\\Models\\Enquiry\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"enquiries\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:14:\"destination_id\";i:1;s:13:\"enquiry_count\";i:1;}s:11:\"\0*\0original\";a:2:{s:14:\"destination_id\";i:1;s:13:\"enquiry_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:12:{s:11:\"travel_date\";s:4:\"date\";s:14:\"flexible_dates\";s:7:\"boolean\";s:13:\"duration_days\";s:7:\"integer\";s:6:\"adults\";s:7:\"integer\";s:8:\"children\";s:7:\"integer\";s:7:\"infants\";s:7:\"integer\";s:10:\"budget_min\";s:7:\"integer\";s:10:\"budget_max\";s:7:\"integer\";s:17:\"last_contacted_at\";s:8:\"datetime\";s:12:\"follow_up_at\";s:8:\"datetime\";s:19:\"privacy_accepted_at\";s:8:\"datetime\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:11:\"destination\";O:22:\"App\\Models\\Destination\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"destinations\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:21:{s:2:\"id\";i:1;s:4:\"slug\";s:7:\"kashmir\";s:4:\"name\";s:7:\"Kashmir\";s:7:\"country\";s:5:\"India\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:8:\"Domestic\";s:17:\"short_description\";s:111:\"Himalayan valleys, Dal Lake houseboats and alpine day trips, planned around the season and your preferred pace.\";s:11:\"description\";s:350:\"<p>Kashmir rewards travellers who leave space to absorb the landscape. Base your journey around Srinagar, then add Gulmarg and Pahalgam for mountain views, meadow walks and seasonal snow experiences.</p><p>We help balance driving time with local experiences, selecting stays and excursions that suit families, couples and multi-generation groups.</p>\";s:10:\"highlights\";s:211:\"[{\"highlight\": \"Dal Lake shikara ride and carefully selected houseboat stay\"}, {\"highlight\": \"Season-sensitive planning for Gulmarg and Pahalgam\"}, {\"highlight\": \"Private transfers with realistic travel times\"}]\";s:10:\"hero_image\";s:52:\"assets/frontend/images/demo/destination-kashmir.webp\";s:7:\"gallery\";s:56:\"[\"assets/frontend/images/demo/destination-kashmir.webp\"]\";s:10:\"meta_title\";s:59:\"Kashmir Holiday Packages & Travel Guide | UniWorld Holidays\";s:16:\"meta_description\";s:146:\"Plan a personalised Kashmir holiday covering Srinagar, Gulmarg and Pahalgam with curated stays, private transfers and practical seasonal guidance.\";s:8:\"og_image\";s:52:\"assets/frontend/images/demo/destination-kashmir.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:0;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:11:\"\0*\0original\";a:21:{s:2:\"id\";i:1;s:4:\"slug\";s:7:\"kashmir\";s:4:\"name\";s:7:\"Kashmir\";s:7:\"country\";s:5:\"India\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:8:\"Domestic\";s:17:\"short_description\";s:111:\"Himalayan valleys, Dal Lake houseboats and alpine day trips, planned around the season and your preferred pace.\";s:11:\"description\";s:350:\"<p>Kashmir rewards travellers who leave space to absorb the landscape. Base your journey around Srinagar, then add Gulmarg and Pahalgam for mountain views, meadow walks and seasonal snow experiences.</p><p>We help balance driving time with local experiences, selecting stays and excursions that suit families, couples and multi-generation groups.</p>\";s:10:\"highlights\";s:211:\"[{\"highlight\": \"Dal Lake shikara ride and carefully selected houseboat stay\"}, {\"highlight\": \"Season-sensitive planning for Gulmarg and Pahalgam\"}, {\"highlight\": \"Private transfers with realistic travel times\"}]\";s:10:\"hero_image\";s:52:\"assets/frontend/images/demo/destination-kashmir.webp\";s:7:\"gallery\";s:56:\"[\"assets/frontend/images/demo/destination-kashmir.webp\"]\";s:10:\"meta_title\";s:59:\"Kashmir Holiday Packages & Travel Guide | UniWorld Holidays\";s:16:\"meta_description\";s:146:\"Plan a personalised Kashmir holiday covering Srinagar, Gulmarg and Pahalgam with curated stays, private transfers and practical seasonal guidance.\";s:8:\"og_image\";s:52:\"assets/frontend/images/demo/destination-kashmir.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:0;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:6:{s:10:\"highlights\";s:5:\"array\";s:7:\"gallery\";s:5:\"array\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"sort_order\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:17:{i:0;s:4:\"slug\";i:1;s:4:\"name\";i:2;s:7:\"country\";i:3;s:5:\"state\";i:4;s:4:\"city\";i:5;s:9:\"continent\";i:6;s:17:\"short_description\";i:7;s:11:\"description\";i:8;s:10:\"highlights\";i:9;s:10:\"hero_image\";i:10;s:7:\"gallery\";i:11;s:10:\"meta_title\";i:12;s:16:\"meta_description\";i:13;s:8:\"og_image\";i:14;s:11:\"is_featured\";i:15;s:9:\"is_active\";i:16;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:30:{i:0;s:7:\"tour_id\";i:1;s:14:\"destination_id\";i:2;s:4:\"name\";i:3;s:5:\"email\";i:4;s:5:\"phone\";i:5;s:7:\"country\";i:6;s:7:\"address\";i:7;s:17:\"destination_other\";i:8;s:10:\"tour_other\";i:9;s:11:\"travel_date\";i:10;s:14:\"flexible_dates\";i:11;s:13:\"duration_days\";i:12;s:6:\"adults\";i:13;s:8:\"children\";i:14;s:7:\"infants\";i:15;s:12:\"budget_range\";i:16;s:10:\"budget_min\";i:17;s:10:\"budget_max\";i:18;s:7:\"message\";i:19;s:6:\"status\";i:20;s:6:\"source\";i:21;s:11:\"assigned_to\";i:22;s:17:\"last_contacted_at\";i:23;s:12:\"follow_up_at\";i:24;s:14:\"internal_notes\";i:25;s:10:\"ip_address\";i:26;s:10:\"user_agent\";i:27;s:19:\"privacy_accepted_at\";i:28;s:22:\"privacy_policy_version\";i:29;s:14:\"consent_source\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:1;O:18:\"App\\Models\\Enquiry\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"enquiries\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:14:\"destination_id\";i:4;s:13:\"enquiry_count\";i:1;}s:11:\"\0*\0original\";a:2:{s:14:\"destination_id\";i:4;s:13:\"enquiry_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:12:{s:11:\"travel_date\";s:4:\"date\";s:14:\"flexible_dates\";s:7:\"boolean\";s:13:\"duration_days\";s:7:\"integer\";s:6:\"adults\";s:7:\"integer\";s:8:\"children\";s:7:\"integer\";s:7:\"infants\";s:7:\"integer\";s:10:\"budget_min\";s:7:\"integer\";s:10:\"budget_max\";s:7:\"integer\";s:17:\"last_contacted_at\";s:8:\"datetime\";s:12:\"follow_up_at\";s:8:\"datetime\";s:19:\"privacy_accepted_at\";s:8:\"datetime\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:11:\"destination\";O:22:\"App\\Models\\Destination\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"destinations\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:21:{s:2:\"id\";i:4;s:4:\"slug\";s:9:\"rajasthan\";s:4:\"name\";s:9:\"Rajasthan\";s:7:\"country\";s:5:\"India\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:8:\"Domestic\";s:17:\"short_description\";s:103:\"Forts, palaces, desert landscapes and living culture woven into an elegant, well-paced private journey.\";s:11:\"description\";s:358:\"<p>Rajasthan offers extraordinary variety across Jaipur, Jodhpur, Udaipur, Jaisalmer and smaller heritage towns. A considered circuit balances landmark visits with local markets, regional cuisine and time within characterful hotels.</p><p>We select the route according to your available days rather than compressing every city into one hurried programme.</p>\";s:10:\"highlights\";s:199:\"[{\"highlight\": \"Private heritage sightseeing with local context\"}, {\"highlight\": \"Palace, haveli and modern hotel options\"}, {\"highlight\": \"Efficient city sequence with optional desert experiences\"}]\";s:10:\"hero_image\";s:54:\"assets/frontend/images/demo/destination-rajasthan.webp\";s:7:\"gallery\";s:58:\"[\"assets/frontend/images/demo/destination-rajasthan.webp\"]\";s:10:\"meta_title\";s:62:\"Rajasthan Holiday Packages & Private Tours | UniWorld Holidays\";s:16:\"meta_description\";s:132:\"Plan a private Rajasthan journey through Jaipur, Jodhpur, Udaipur and the desert with curated heritage stays and guided sightseeing.\";s:8:\"og_image\";s:54:\"assets/frontend/images/demo/destination-rajasthan.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:3;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:11:\"\0*\0original\";a:21:{s:2:\"id\";i:4;s:4:\"slug\";s:9:\"rajasthan\";s:4:\"name\";s:9:\"Rajasthan\";s:7:\"country\";s:5:\"India\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:8:\"Domestic\";s:17:\"short_description\";s:103:\"Forts, palaces, desert landscapes and living culture woven into an elegant, well-paced private journey.\";s:11:\"description\";s:358:\"<p>Rajasthan offers extraordinary variety across Jaipur, Jodhpur, Udaipur, Jaisalmer and smaller heritage towns. A considered circuit balances landmark visits with local markets, regional cuisine and time within characterful hotels.</p><p>We select the route according to your available days rather than compressing every city into one hurried programme.</p>\";s:10:\"highlights\";s:199:\"[{\"highlight\": \"Private heritage sightseeing with local context\"}, {\"highlight\": \"Palace, haveli and modern hotel options\"}, {\"highlight\": \"Efficient city sequence with optional desert experiences\"}]\";s:10:\"hero_image\";s:54:\"assets/frontend/images/demo/destination-rajasthan.webp\";s:7:\"gallery\";s:58:\"[\"assets/frontend/images/demo/destination-rajasthan.webp\"]\";s:10:\"meta_title\";s:62:\"Rajasthan Holiday Packages & Private Tours | UniWorld Holidays\";s:16:\"meta_description\";s:132:\"Plan a private Rajasthan journey through Jaipur, Jodhpur, Udaipur and the desert with curated heritage stays and guided sightseeing.\";s:8:\"og_image\";s:54:\"assets/frontend/images/demo/destination-rajasthan.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:3;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:6:{s:10:\"highlights\";s:5:\"array\";s:7:\"gallery\";s:5:\"array\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"sort_order\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:17:{i:0;s:4:\"slug\";i:1;s:4:\"name\";i:2;s:7:\"country\";i:3;s:5:\"state\";i:4;s:4:\"city\";i:5;s:9:\"continent\";i:6;s:17:\"short_description\";i:7;s:11:\"description\";i:8;s:10:\"highlights\";i:9;s:10:\"hero_image\";i:10;s:7:\"gallery\";i:11;s:10:\"meta_title\";i:12;s:16:\"meta_description\";i:13;s:8:\"og_image\";i:14;s:11:\"is_featured\";i:15;s:9:\"is_active\";i:16;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:30:{i:0;s:7:\"tour_id\";i:1;s:14:\"destination_id\";i:2;s:4:\"name\";i:3;s:5:\"email\";i:4;s:5:\"phone\";i:5;s:7:\"country\";i:6;s:7:\"address\";i:7;s:17:\"destination_other\";i:8;s:10:\"tour_other\";i:9;s:11:\"travel_date\";i:10;s:14:\"flexible_dates\";i:11;s:13:\"duration_days\";i:12;s:6:\"adults\";i:13;s:8:\"children\";i:14;s:7:\"infants\";i:15;s:12:\"budget_range\";i:16;s:10:\"budget_min\";i:17;s:10:\"budget_max\";i:18;s:7:\"message\";i:19;s:6:\"status\";i:20;s:6:\"source\";i:21;s:11:\"assigned_to\";i:22;s:17:\"last_contacted_at\";i:23;s:12:\"follow_up_at\";i:24;s:14:\"internal_notes\";i:25;s:10:\"ip_address\";i:26;s:10:\"user_agent\";i:27;s:19:\"privacy_accepted_at\";i:28;s:22:\"privacy_policy_version\";i:29;s:14:\"consent_source\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:2;O:18:\"App\\Models\\Enquiry\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"enquiries\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:14:\"destination_id\";i:5;s:13:\"enquiry_count\";i:1;}s:11:\"\0*\0original\";a:2:{s:14:\"destination_id\";i:5;s:13:\"enquiry_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:12:{s:11:\"travel_date\";s:4:\"date\";s:14:\"flexible_dates\";s:7:\"boolean\";s:13:\"duration_days\";s:7:\"integer\";s:6:\"adults\";s:7:\"integer\";s:8:\"children\";s:7:\"integer\";s:7:\"infants\";s:7:\"integer\";s:10:\"budget_min\";s:7:\"integer\";s:10:\"budget_max\";s:7:\"integer\";s:17:\"last_contacted_at\";s:8:\"datetime\";s:12:\"follow_up_at\";s:8:\"datetime\";s:19:\"privacy_accepted_at\";s:8:\"datetime\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:11:\"destination\";O:22:\"App\\Models\\Destination\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"destinations\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:21:{s:2:\"id\";i:5;s:4:\"slug\";s:5:\"dubai\";s:4:\"name\";s:5:\"Dubai\";s:7:\"country\";s:20:\"United Arab Emirates\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:11:\"Middle East\";s:17:\"short_description\";s:123:\"Contemporary landmarks, desert experiences and waterfront evenings arranged with efficient transfers and pre-booked access.\";s:11:\"description\";s:351:\"<p>Dubai works equally well for first international holidays, family breaks and premium short stays. A balanced programme can combine Downtown landmarks, Old Dubai, the marina, a desert evening and relaxed time for dining or shopping.</p><p>We coordinate attraction timings and neighbourhood-based stays to reduce avoidable travel across the city.</p>\";s:10:\"highlights\";s:176:\"[{\"highlight\": \"Downtown Dubai and Burj Khalifa planning\"}, {\"highlight\": \"Considered desert experience options\"}, {\"highlight\": \"Family, couple and premium hotel categories\"}]\";s:10:\"hero_image\";s:50:\"assets/frontend/images/demo/destination-dubai.webp\";s:7:\"gallery\";s:54:\"[\"assets/frontend/images/demo/destination-dubai.webp\"]\";s:10:\"meta_title\";s:53:\"Dubai Holiday Packages from India | UniWorld Holidays\";s:16:\"meta_description\";s:138:\"Plan a personalised Dubai holiday with well-located hotels, airport transfers, city highlights and a carefully selected desert experience.\";s:8:\"og_image\";s:50:\"assets/frontend/images/demo/destination-dubai.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:4;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:11:\"\0*\0original\";a:21:{s:2:\"id\";i:5;s:4:\"slug\";s:5:\"dubai\";s:4:\"name\";s:5:\"Dubai\";s:7:\"country\";s:20:\"United Arab Emirates\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:11:\"Middle East\";s:17:\"short_description\";s:123:\"Contemporary landmarks, desert experiences and waterfront evenings arranged with efficient transfers and pre-booked access.\";s:11:\"description\";s:351:\"<p>Dubai works equally well for first international holidays, family breaks and premium short stays. A balanced programme can combine Downtown landmarks, Old Dubai, the marina, a desert evening and relaxed time for dining or shopping.</p><p>We coordinate attraction timings and neighbourhood-based stays to reduce avoidable travel across the city.</p>\";s:10:\"highlights\";s:176:\"[{\"highlight\": \"Downtown Dubai and Burj Khalifa planning\"}, {\"highlight\": \"Considered desert experience options\"}, {\"highlight\": \"Family, couple and premium hotel categories\"}]\";s:10:\"hero_image\";s:50:\"assets/frontend/images/demo/destination-dubai.webp\";s:7:\"gallery\";s:54:\"[\"assets/frontend/images/demo/destination-dubai.webp\"]\";s:10:\"meta_title\";s:53:\"Dubai Holiday Packages from India | UniWorld Holidays\";s:16:\"meta_description\";s:138:\"Plan a personalised Dubai holiday with well-located hotels, airport transfers, city highlights and a carefully selected desert experience.\";s:8:\"og_image\";s:50:\"assets/frontend/images/demo/destination-dubai.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:4;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:6:{s:10:\"highlights\";s:5:\"array\";s:7:\"gallery\";s:5:\"array\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"sort_order\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:17:{i:0;s:4:\"slug\";i:1;s:4:\"name\";i:2;s:7:\"country\";i:3;s:5:\"state\";i:4;s:4:\"city\";i:5;s:9:\"continent\";i:6;s:17:\"short_description\";i:7;s:11:\"description\";i:8;s:10:\"highlights\";i:9;s:10:\"hero_image\";i:10;s:7:\"gallery\";i:11;s:10:\"meta_title\";i:12;s:16:\"meta_description\";i:13;s:8:\"og_image\";i:14;s:11:\"is_featured\";i:15;s:9:\"is_active\";i:16;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:30:{i:0;s:7:\"tour_id\";i:1;s:14:\"destination_id\";i:2;s:4:\"name\";i:3;s:5:\"email\";i:4;s:5:\"phone\";i:5;s:7:\"country\";i:6;s:7:\"address\";i:7;s:17:\"destination_other\";i:8;s:10:\"tour_other\";i:9;s:11:\"travel_date\";i:10;s:14:\"flexible_dates\";i:11;s:13:\"duration_days\";i:12;s:6:\"adults\";i:13;s:8:\"children\";i:14;s:7:\"infants\";i:15;s:12:\"budget_range\";i:16;s:10:\"budget_min\";i:17;s:10:\"budget_max\";i:18;s:7:\"message\";i:19;s:6:\"status\";i:20;s:6:\"source\";i:21;s:11:\"assigned_to\";i:22;s:17:\"last_contacted_at\";i:23;s:12:\"follow_up_at\";i:24;s:14:\"internal_notes\";i:25;s:10:\"ip_address\";i:26;s:10:\"user_agent\";i:27;s:19:\"privacy_accepted_at\";i:28;s:22:\"privacy_policy_version\";i:29;s:14:\"consent_source\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:3;O:18:\"App\\Models\\Enquiry\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"enquiries\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:14:\"destination_id\";i:6;s:13:\"enquiry_count\";i:1;}s:11:\"\0*\0original\";a:2:{s:14:\"destination_id\";i:6;s:13:\"enquiry_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:12:{s:11:\"travel_date\";s:4:\"date\";s:14:\"flexible_dates\";s:7:\"boolean\";s:13:\"duration_days\";s:7:\"integer\";s:6:\"adults\";s:7:\"integer\";s:8:\"children\";s:7:\"integer\";s:7:\"infants\";s:7:\"integer\";s:10:\"budget_min\";s:7:\"integer\";s:10:\"budget_max\";s:7:\"integer\";s:17:\"last_contacted_at\";s:8:\"datetime\";s:12:\"follow_up_at\";s:8:\"datetime\";s:19:\"privacy_accepted_at\";s:8:\"datetime\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:11:\"destination\";O:22:\"App\\Models\\Destination\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"destinations\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:21:{s:2:\"id\";i:6;s:4:\"slug\";s:4:\"bali\";s:4:\"name\";s:4:\"Bali\";s:7:\"country\";s:9:\"Indonesia\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:4:\"Asia\";s:17:\"short_description\";s:115:\"Temple landscapes, rice terraces and coastal stays combined in a calm itinerary for couples and curious travellers.\";s:11:\"description\";s:312:\"<p>Bali is best experienced as more than one setting. Pair the culture and greenery of Ubud with a coastal stay in Seminyak, Nusa Dua, Uluwatu or Sanur according to your preferred atmosphere.</p><p>We plan transfers and experience days carefully so the journey remains restorative rather than over-scheduled.</p>\";s:10:\"highlights\";s:201:\"[{\"highlight\": \"Ubud culture, temples and rice-terrace landscapes\"}, {\"highlight\": \"Coastal area selected for your travel style\"}, {\"highlight\": \"Private villa and resort options for milestone trips\"}]\";s:10:\"hero_image\";s:49:\"assets/frontend/images/demo/destination-bali.webp\";s:7:\"gallery\";s:53:\"[\"assets/frontend/images/demo/destination-bali.webp\"]\";s:10:\"meta_title\";s:53:\"Bali Holiday & Honeymoon Packages | UniWorld Holidays\";s:16:\"meta_description\";s:135:\"Design a Bali holiday combining Ubud and the coast with curated villas, private transfers, temples and personalised couple experiences.\";s:8:\"og_image\";s:49:\"assets/frontend/images/demo/destination-bali.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:5;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:11:\"\0*\0original\";a:21:{s:2:\"id\";i:6;s:4:\"slug\";s:4:\"bali\";s:4:\"name\";s:4:\"Bali\";s:7:\"country\";s:9:\"Indonesia\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:4:\"Asia\";s:17:\"short_description\";s:115:\"Temple landscapes, rice terraces and coastal stays combined in a calm itinerary for couples and curious travellers.\";s:11:\"description\";s:312:\"<p>Bali is best experienced as more than one setting. Pair the culture and greenery of Ubud with a coastal stay in Seminyak, Nusa Dua, Uluwatu or Sanur according to your preferred atmosphere.</p><p>We plan transfers and experience days carefully so the journey remains restorative rather than over-scheduled.</p>\";s:10:\"highlights\";s:201:\"[{\"highlight\": \"Ubud culture, temples and rice-terrace landscapes\"}, {\"highlight\": \"Coastal area selected for your travel style\"}, {\"highlight\": \"Private villa and resort options for milestone trips\"}]\";s:10:\"hero_image\";s:49:\"assets/frontend/images/demo/destination-bali.webp\";s:7:\"gallery\";s:53:\"[\"assets/frontend/images/demo/destination-bali.webp\"]\";s:10:\"meta_title\";s:53:\"Bali Holiday & Honeymoon Packages | UniWorld Holidays\";s:16:\"meta_description\";s:135:\"Design a Bali holiday combining Ubud and the coast with curated villas, private transfers, temples and personalised couple experiences.\";s:8:\"og_image\";s:49:\"assets/frontend/images/demo/destination-bali.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:5;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:6:{s:10:\"highlights\";s:5:\"array\";s:7:\"gallery\";s:5:\"array\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"sort_order\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:17:{i:0;s:4:\"slug\";i:1;s:4:\"name\";i:2;s:7:\"country\";i:3;s:5:\"state\";i:4;s:4:\"city\";i:5;s:9:\"continent\";i:6;s:17:\"short_description\";i:7;s:11:\"description\";i:8;s:10:\"highlights\";i:9;s:10:\"hero_image\";i:10;s:7:\"gallery\";i:11;s:10:\"meta_title\";i:12;s:16:\"meta_description\";i:13;s:8:\"og_image\";i:14;s:11:\"is_featured\";i:15;s:9:\"is_active\";i:16;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:30:{i:0;s:7:\"tour_id\";i:1;s:14:\"destination_id\";i:2;s:4:\"name\";i:3;s:5:\"email\";i:4;s:5:\"phone\";i:5;s:7:\"country\";i:6;s:7:\"address\";i:7;s:17:\"destination_other\";i:8;s:10:\"tour_other\";i:9;s:11:\"travel_date\";i:10;s:14:\"flexible_dates\";i:11;s:13:\"duration_days\";i:12;s:6:\"adults\";i:13;s:8:\"children\";i:14;s:7:\"infants\";i:15;s:12:\"budget_range\";i:16;s:10:\"budget_min\";i:17;s:10:\"budget_max\";i:18;s:7:\"message\";i:19;s:6:\"status\";i:20;s:6:\"source\";i:21;s:11:\"assigned_to\";i:22;s:17:\"last_contacted_at\";i:23;s:12:\"follow_up_at\";i:24;s:14:\"internal_notes\";i:25;s:10:\"ip_address\";i:26;s:10:\"user_agent\";i:27;s:19:\"privacy_accepted_at\";i:28;s:22:\"privacy_policy_version\";i:29;s:14:\"consent_source\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}i:4;O:18:\"App\\Models\\Enquiry\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:9:\"enquiries\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:2:{s:14:\"destination_id\";i:7;s:13:\"enquiry_count\";i:1;}s:11:\"\0*\0original\";a:2:{s:14:\"destination_id\";i:7;s:13:\"enquiry_count\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:12:{s:11:\"travel_date\";s:4:\"date\";s:14:\"flexible_dates\";s:7:\"boolean\";s:13:\"duration_days\";s:7:\"integer\";s:6:\"adults\";s:7:\"integer\";s:8:\"children\";s:7:\"integer\";s:7:\"infants\";s:7:\"integer\";s:10:\"budget_min\";s:7:\"integer\";s:10:\"budget_max\";s:7:\"integer\";s:17:\"last_contacted_at\";s:8:\"datetime\";s:12:\"follow_up_at\";s:8:\"datetime\";s:19:\"privacy_accepted_at\";s:8:\"datetime\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:11:\"destination\";O:22:\"App\\Models\\Destination\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:12:\"destinations\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:21:{s:2:\"id\";i:7;s:4:\"slug\";s:8:\"maldives\";s:4:\"name\";s:8:\"Maldives\";s:7:\"country\";s:8:\"Maldives\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:4:\"Asia\";s:17:\"short_description\";s:121:\"Private-island stays selected by transfer type, villa category, meal plan, reef access and the experience you value most.\";s:11:\"description\";s:329:\"<p>Choosing the right Maldives resort depends on more than the villa photograph. Transfer time, house reef, dining plan, island size and activity programme all shape the experience.</p><p>We compare these details clearly and recommend resorts that match your budget, celebration and preferred balance of privacy and activity.</p>\";s:10:\"highlights\";s:208:\"[{\"highlight\": \"Resort comparison by reef, meal plan and transfer type\"}, {\"highlight\": \"Beach, overwater and split-stay villa options\"}, {\"highlight\": \"Honeymoon and celebration inclusions where available\"}]\";s:10:\"hero_image\";s:53:\"assets/frontend/images/demo/destination-maldives.webp\";s:7:\"gallery\";s:57:\"[\"assets/frontend/images/demo/destination-maldives.webp\"]\";s:10:\"meta_title\";s:56:\"Maldives Resort & Honeymoon Packages | UniWorld Holidays\";s:16:\"meta_description\";s:137:\"Compare Maldives resorts and plan a personalised island holiday with suitable transfers, meal plans and beach or overwater villa options.\";s:8:\"og_image\";s:53:\"assets/frontend/images/demo/destination-maldives.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:6;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:11:\"\0*\0original\";a:21:{s:2:\"id\";i:7;s:4:\"slug\";s:8:\"maldives\";s:4:\"name\";s:8:\"Maldives\";s:7:\"country\";s:8:\"Maldives\";s:5:\"state\";N;s:4:\"city\";N;s:9:\"continent\";s:4:\"Asia\";s:17:\"short_description\";s:121:\"Private-island stays selected by transfer type, villa category, meal plan, reef access and the experience you value most.\";s:11:\"description\";s:329:\"<p>Choosing the right Maldives resort depends on more than the villa photograph. Transfer time, house reef, dining plan, island size and activity programme all shape the experience.</p><p>We compare these details clearly and recommend resorts that match your budget, celebration and preferred balance of privacy and activity.</p>\";s:10:\"highlights\";s:208:\"[{\"highlight\": \"Resort comparison by reef, meal plan and transfer type\"}, {\"highlight\": \"Beach, overwater and split-stay villa options\"}, {\"highlight\": \"Honeymoon and celebration inclusions where available\"}]\";s:10:\"hero_image\";s:53:\"assets/frontend/images/demo/destination-maldives.webp\";s:7:\"gallery\";s:57:\"[\"assets/frontend/images/demo/destination-maldives.webp\"]\";s:10:\"meta_title\";s:56:\"Maldives Resort & Honeymoon Packages | UniWorld Holidays\";s:16:\"meta_description\";s:137:\"Compare Maldives resorts and plan a personalised island holiday with suitable transfers, meal plans and beach or overwater villa options.\";s:8:\"og_image\";s:53:\"assets/frontend/images/demo/destination-maldives.webp\";s:11:\"is_featured\";i:1;s:9:\"is_active\";i:1;s:10:\"sort_order\";i:6;s:10:\"deleted_at\";N;s:10:\"created_at\";s:19:\"2026-09-15 22:26:04\";s:10:\"updated_at\";s:19:\"2026-09-19 14:57:43\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:6:{s:10:\"highlights\";s:5:\"array\";s:7:\"gallery\";s:5:\"array\";s:11:\"is_featured\";s:7:\"boolean\";s:9:\"is_active\";s:7:\"boolean\";s:10:\"sort_order\";s:7:\"integer\";s:10:\"deleted_at\";s:8:\"datetime\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:17:{i:0;s:4:\"slug\";i:1;s:4:\"name\";i:2;s:7:\"country\";i:3;s:5:\"state\";i:4;s:4:\"city\";i:5;s:9:\"continent\";i:6;s:17:\"short_description\";i:7;s:11:\"description\";i:8;s:10:\"highlights\";i:9;s:10:\"hero_image\";i:10;s:7:\"gallery\";i:11;s:10:\"meta_title\";i:12;s:16:\"meta_description\";i:13;s:8:\"og_image\";i:14;s:11:\"is_featured\";i:15;s:9:\"is_active\";i:16;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:30:{i:0;s:7:\"tour_id\";i:1;s:14:\"destination_id\";i:2;s:4:\"name\";i:3;s:5:\"email\";i:4;s:5:\"phone\";i:5;s:7:\"country\";i:6;s:7:\"address\";i:7;s:17:\"destination_other\";i:8;s:10:\"tour_other\";i:9;s:11:\"travel_date\";i:10;s:14:\"flexible_dates\";i:11;s:13:\"duration_days\";i:12;s:6:\"adults\";i:13;s:8:\"children\";i:14;s:7:\"infants\";i:15;s:12:\"budget_range\";i:16;s:10:\"budget_min\";i:17;s:10:\"budget_max\";i:18;s:7:\"message\";i:19;s:6:\"status\";i:20;s:6:\"source\";i:21;s:11:\"assigned_to\";i:22;s:17:\"last_contacted_at\";i:23;s:12:\"follow_up_at\";i:24;s:14:\"internal_notes\";i:25;s:10:\"ip_address\";i:26;s:10:\"user_agent\";i:27;s:19:\"privacy_accepted_at\";i:28;s:22:\"privacy_policy_version\";i:29;s:14:\"consent_source\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:16:\"\0*\0forceDeleting\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:16:\"monthlyEnquiries\";a:6:{i:0;a:3:{s:5:\"month\";s:3:\"Apr\";s:5:\"count\";i:0;s:9:\"converted\";i:0;}i:1;a:3:{s:5:\"month\";s:3:\"May\";s:5:\"count\";i:0;s:9:\"converted\";i:0;}i:2;a:3:{s:5:\"month\";s:3:\"Jun\";s:5:\"count\";i:0;s:9:\"converted\";i:0;}i:3;a:3:{s:5:\"month\";s:3:\"Jul\";s:5:\"count\";i:0;s:9:\"converted\";i:0;}i:4;a:3:{s:5:\"month\";s:3:\"Aug\";s:5:\"count\";i:0;s:9:\"converted\";i:0;}i:5;a:3:{s:5:\"month\";s:3:\"Sep\";s:5:\"count\";i:5;s:9:\"converted\";i:3;}}}',1789833196),('laravel-cache-setting_company_city','s:9:\"Ahmedabad\";',1789833206),('laravel-cache-setting_company_email','s:27:\"hello@uniworldholidays.test\";',1789833206),('laravel-cache-setting_company_name','s:17:\"UniWorld Holidays\";',1789833206),('laravel-cache-setting_company_phone','s:15:\"+91 98765 43210\";',1789833206),('laravel-cache-setting_company_whatsapp','s:15:\"+91 98765 43210\";',1789833206),('laravel-cache-setting_google_analytics_id','N;',1789833422),('laravel-cache-setting_seo_description','s:155:\"Plan personalised holidays across India and selected international destinations with considered itineraries, clear proposals and dependable travel support.\";',1789833206),('laravel-cache-setting_seo_title','s:62:\"Tailor-Made India & International Holidays | UniWorld Holidays\";',1789833206),('laravel-cache-setting_site_logo','N;',1789833422),('laravel-cache-setting_social_facebook','N;',1789833422),('laravel-cache-setting_social_instagram','N;',1789833422),('laravel-cache-setting_social_linkedin','N;',1789833422),('laravel-cache-setting_social_youtube','N;',1789833422),('laravel-cache-spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:102:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:17:\"view_destinations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:19:\"create_destinations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"edit_destinations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:19:\"delete_destinations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:20:\"restore_destinations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:25:\"force_delete_destinations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:10:\"view_tours\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"create_tours\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:10:\"edit_tours\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"delete_tours\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"restore_tours\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:18:\"force_delete_tours\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"duplicate_tours\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:13:\"publish_tours\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:17:\"view_tour_pricing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:19:\"create_tour_pricing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:17:\"edit_tour_pricing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:19:\"delete_tour_pricing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:20:\"restore_tour_pricing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:14:\"view_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:16:\"create_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:14:\"edit_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:16:\"delete_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:17:\"restore_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:16:\"assign_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:24:\"mark_contacted_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:19:\"mark_lost_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:17:\"convert_enquiries\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"view_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:17:\"create_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:15:\"edit_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:17:\"delete_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:18:\"restore_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:15:\"send_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:23:\"download_pdf_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:25:\"create_version_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:17:\"accept_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:17:\"reject_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:26:\"request_changes_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:27:\"copy_public_link_quotations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:20:\"view_quotation_items\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:22:\"create_quotation_items\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:20:\"edit_quotation_items\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:22:\"delete_quotation_items\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:23:\"restore_quotation_items\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:13:\"view_bookings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:15:\"create_bookings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:13:\"edit_bookings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:15:\"delete_bookings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:16:\"restore_bookings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:15:\"cancel_bookings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:17:\"complete_bookings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:16:\"confirm_bookings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:13:\"view_payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:15:\"create_payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:13:\"edit_payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:15:\"delete_payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:16:\"restore_payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:15:\"refund_payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:15:\"view_travellers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:17:\"create_travellers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:15:\"edit_travellers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:17:\"delete_travellers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:18:\"restore_travellers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:10:\"view_pages\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:12:\"create_pages\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:10:\"edit_pages\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:12:\"delete_pages\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:13:\"restore_pages\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:13:\"publish_pages\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:10:\"view_posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:12:\"create_posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:10:\"edit_posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:12:\"delete_posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:13:\"restore_posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:13:\"publish_posts\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:12:\"view_banners\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:14:\"create_banners\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:12:\"edit_banners\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:14:\"delete_banners\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:15:\"restore_banners\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:17:\"view_testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:19:\"create_testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:17:\"edit_testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:19:\"delete_testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:20:\"restore_testimonials\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:9:\"view_faqs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:11:\"create_faqs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:9:\"edit_faqs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:11:\"delete_faqs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:12:\"restore_faqs\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:13:\"view_settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:13:\"edit_settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:10:\"view_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:12:\"create_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:10:\"edit_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:96;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:12:\"delete_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:97;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:13:\"restore_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:98;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:10:\"view_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:99;a:4:{s:1:\"a\";i:100;s:1:\"b\";s:12:\"create_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:100;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:10:\"edit_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:101;a:4:{s:1:\"a\";i:102;s:1:\"b\";s:12:\"delete_roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:7:\"content\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"sales\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:10:\"operations\";s:1:\"c\";s:3:\"web\";}}}',1789918623);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
-- Table structure for table `destinations`
--

DROP TABLE IF EXISTS `destinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destinations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `continent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `highlights` json DEFAULT NULL,
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `destinations_slug_unique` (`slug`),
  KEY `destinations_slug_index` (`slug`),
  KEY `destinations_is_active_index` (`is_active`),
  KEY `destinations_is_featured_index` (`is_featured`),
  KEY `destinations_country_index` (`country`),
  KEY `destinations_continent_index` (`continent`),
  KEY `destinations_sort_order_index` (`sort_order`),
  KEY `destinations_country_state_city_index` (`country`,`state`,`city`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinations`
--

LOCK TABLES `destinations` WRITE;
/*!40000 ALTER TABLE `destinations` DISABLE KEYS */;
INSERT INTO `destinations` VALUES (1,'kashmir','Kashmir','India',NULL,NULL,'Domestic','Himalayan valleys, Dal Lake houseboats and alpine day trips, planned around the season and your preferred pace.','<p>Kashmir rewards travellers who leave space to absorb the landscape. Base your journey around Srinagar, then add Gulmarg and Pahalgam for mountain views, meadow walks and seasonal snow experiences.</p><p>We help balance driving time with local experiences, selecting stays and excursions that suit families, couples and multi-generation groups.</p>','[{\"highlight\": \"Dal Lake shikara ride and carefully selected houseboat stay\"}, {\"highlight\": \"Season-sensitive planning for Gulmarg and Pahalgam\"}, {\"highlight\": \"Private transfers with realistic travel times\"}]','assets/frontend/images/demo/destination-kashmir.webp','[\"assets/frontend/images/demo/destination-kashmir.webp\"]','Kashmir Holiday Packages & Travel Guide | UniWorld Holidays','Plan a personalised Kashmir holiday covering Srinagar, Gulmarg and Pahalgam with curated stays, private transfers and practical seasonal guidance.','assets/frontend/images/demo/destination-kashmir.webp',1,1,0,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(2,'goa','Goa','India',NULL,NULL,'Domestic','A flexible coastal escape combining well-located stays, beaches, heritage neighbourhoods and unhurried evenings.','<p>Goa is more rewarding when the itinerary reflects the kind of coast you enjoy. Choose North Goa for energy and entertainment, South Goa for quieter resorts, or combine both with Old Goa and Panaji.</p><p>We recommend the right beach belt, hotel style and transfer plan for couples, families, friends and short celebrations.</p>','[{\"highlight\": \"Hotel options matched to the right beach neighbourhood\"}, {\"highlight\": \"Portuguese heritage and Panaji walking experiences\"}, {\"highlight\": \"Flexible leisure time for dining and sunsets\"}]','assets/frontend/images/demo/destination-goa.webp','[\"assets/frontend/images/demo/destination-goa.webp\"]','Goa Holiday Packages & Beach Escapes | UniWorld Holidays','Design a Goa holiday with the right beach area, curated hotel, private transfers and optional heritage and water-sport experiences.','assets/frontend/images/demo/destination-goa.webp',1,1,1,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(3,'kerala','Kerala','India',NULL,NULL,'Domestic','Tea-country scenery, wildlife, backwaters and the coast connected through a comfortable, thoughtfully paced route.','<p>Kerala brings together distinct landscapes within one journey—from Munnar and Thekkady to Alleppey, Kumarakom and the coast. The best routes account for road conditions and avoid packing too many stops into each day.</p><p>We shape the itinerary around nature, wellness, food and family interests, with appropriate stays at every stage.</p>','[{\"highlight\": \"Munnar tea country and scenic drives\"}, {\"highlight\": \"Private backwater or houseboat experience\"}, {\"highlight\": \"Route planning that limits unnecessary hotel changes\"}]','assets/frontend/images/demo/destination-kerala.webp','[\"assets/frontend/images/demo/destination-kerala.webp\"]','Kerala Holiday Packages & Backwater Tours | UniWorld Holidays','Explore Kerala with a personalised route through Munnar, Thekkady and the backwaters, including curated stays and private transfers.','assets/frontend/images/demo/destination-kerala.webp',1,1,2,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(4,'rajasthan','Rajasthan','India',NULL,NULL,'Domestic','Forts, palaces, desert landscapes and living culture woven into an elegant, well-paced private journey.','<p>Rajasthan offers extraordinary variety across Jaipur, Jodhpur, Udaipur, Jaisalmer and smaller heritage towns. A considered circuit balances landmark visits with local markets, regional cuisine and time within characterful hotels.</p><p>We select the route according to your available days rather than compressing every city into one hurried programme.</p>','[{\"highlight\": \"Private heritage sightseeing with local context\"}, {\"highlight\": \"Palace, haveli and modern hotel options\"}, {\"highlight\": \"Efficient city sequence with optional desert experiences\"}]','assets/frontend/images/demo/destination-rajasthan.webp','[\"assets/frontend/images/demo/destination-rajasthan.webp\"]','Rajasthan Holiday Packages & Private Tours | UniWorld Holidays','Plan a private Rajasthan journey through Jaipur, Jodhpur, Udaipur and the desert with curated heritage stays and guided sightseeing.','assets/frontend/images/demo/destination-rajasthan.webp',1,1,3,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(5,'dubai','Dubai','United Arab Emirates',NULL,NULL,'Middle East','Contemporary landmarks, desert experiences and waterfront evenings arranged with efficient transfers and pre-booked access.','<p>Dubai works equally well for first international holidays, family breaks and premium short stays. A balanced programme can combine Downtown landmarks, Old Dubai, the marina, a desert evening and relaxed time for dining or shopping.</p><p>We coordinate attraction timings and neighbourhood-based stays to reduce avoidable travel across the city.</p>','[{\"highlight\": \"Downtown Dubai and Burj Khalifa planning\"}, {\"highlight\": \"Considered desert experience options\"}, {\"highlight\": \"Family, couple and premium hotel categories\"}]','assets/frontend/images/demo/destination-dubai.webp','[\"assets/frontend/images/demo/destination-dubai.webp\"]','Dubai Holiday Packages from India | UniWorld Holidays','Plan a personalised Dubai holiday with well-located hotels, airport transfers, city highlights and a carefully selected desert experience.','assets/frontend/images/demo/destination-dubai.webp',1,1,4,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(6,'bali','Bali','Indonesia',NULL,NULL,'Asia','Temple landscapes, rice terraces and coastal stays combined in a calm itinerary for couples and curious travellers.','<p>Bali is best experienced as more than one setting. Pair the culture and greenery of Ubud with a coastal stay in Seminyak, Nusa Dua, Uluwatu or Sanur according to your preferred atmosphere.</p><p>We plan transfers and experience days carefully so the journey remains restorative rather than over-scheduled.</p>','[{\"highlight\": \"Ubud culture, temples and rice-terrace landscapes\"}, {\"highlight\": \"Coastal area selected for your travel style\"}, {\"highlight\": \"Private villa and resort options for milestone trips\"}]','assets/frontend/images/demo/destination-bali.webp','[\"assets/frontend/images/demo/destination-bali.webp\"]','Bali Holiday & Honeymoon Packages | UniWorld Holidays','Design a Bali holiday combining Ubud and the coast with curated villas, private transfers, temples and personalised couple experiences.','assets/frontend/images/demo/destination-bali.webp',1,1,5,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(7,'maldives','Maldives','Maldives',NULL,NULL,'Asia','Private-island stays selected by transfer type, villa category, meal plan, reef access and the experience you value most.','<p>Choosing the right Maldives resort depends on more than the villa photograph. Transfer time, house reef, dining plan, island size and activity programme all shape the experience.</p><p>We compare these details clearly and recommend resorts that match your budget, celebration and preferred balance of privacy and activity.</p>','[{\"highlight\": \"Resort comparison by reef, meal plan and transfer type\"}, {\"highlight\": \"Beach, overwater and split-stay villa options\"}, {\"highlight\": \"Honeymoon and celebration inclusions where available\"}]','assets/frontend/images/demo/destination-maldives.webp','[\"assets/frontend/images/demo/destination-maldives.webp\"]','Maldives Resort & Honeymoon Packages | UniWorld Holidays','Compare Maldives resorts and plan a personalised island holiday with suitable transfers, meal plans and beach or overwater villa options.','assets/frontend/images/demo/destination-maldives.webp',1,1,6,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43');
/*!40000 ALTER TABLE `destinations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enquiries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned DEFAULT NULL,
  `tour_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_id` bigint unsigned DEFAULT NULL,
  `destination_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `travel_date` date DEFAULT NULL,
  `flexible_dates` tinyint(1) NOT NULL DEFAULT '0',
  `duration_days` smallint unsigned DEFAULT NULL,
  `adults` tinyint unsigned NOT NULL DEFAULT '1',
  `children` tinyint unsigned NOT NULL DEFAULT '0',
  `infants` tinyint unsigned NOT NULL DEFAULT '0',
  `budget_range` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget_min` int unsigned DEFAULT NULL,
  `budget_max` int unsigned DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'website',
  `assigned_to` bigint unsigned DEFAULT NULL,
  `last_contacted_at` timestamp NULL DEFAULT NULL,
  `follow_up_at` timestamp NULL DEFAULT NULL,
  `internal_notes` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `privacy_accepted_at` timestamp NULL DEFAULT NULL,
  `privacy_policy_version` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consent_source` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enquiries_tour_id_index` (`tour_id`),
  KEY `enquiries_destination_id_index` (`destination_id`),
  KEY `enquiries_assigned_to_index` (`assigned_to`),
  KEY `enquiries_status_index` (`status`),
  KEY `enquiries_source_index` (`source`),
  KEY `enquiries_travel_date_index` (`travel_date`),
  KEY `enquiries_follow_up_at_index` (`follow_up_at`),
  KEY `enquiries_created_at_index` (`created_at`),
  KEY `enquiries_status_created_composite` (`status`,`created_at`),
  KEY `enquiries_budget_min_budget_max_index` (`budget_min`,`budget_max`),
  CONSTRAINT `enquiries_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `enquiries_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `enquiries_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiries`
--

LOCK TABLES `enquiries` WRITE;
/*!40000 ALTER TABLE `enquiries` DISABLE KEYS */;
INSERT INTO `enquiries` VALUES (1,1,NULL,1,NULL,'Arjun & Nisha Mehta','arjun.mehta@demo.test','+91 98250 11001','India',NULL,'2026-10-21',1,6,2,0,0,'₹75,000 - ₹3,50,000',NULL,NULL,'Interested in Kashmir Valley Retreat; prefers comfortable hotels and private transfers.','converted','website',3,'2026-09-10 21:05:06',NULL,'Demo record: client priorities and next action are documented.',NULL,NULL,'2026-09-09 21:05:06','2026-09-16','demo-import',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,5,NULL,5,NULL,'The Shah Family','shah.family@demo.test','+91 98250 11002','India',NULL,'2026-11-02',0,5,2,1,0,'₹75,000 - ₹3,50,000',NULL,NULL,'Interested in Dubai Signature Experience; prefers comfortable hotels and private transfers.','converted','referral',3,'2026-09-11 21:05:06',NULL,'Demo record: client priorities and next action are documented.',NULL,NULL,'2026-09-10 21:05:06','2026-09-16','demo-import',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(3,7,NULL,7,NULL,'Riya and Dev Patel','riya.patel@demo.test','+91 98250 11003','India',NULL,'2026-11-14',1,5,2,0,0,'₹75,000 - ₹3,50,000',NULL,NULL,'Interested in Maldives Overwater Luxury; prefers comfortable hotels and private transfers.','converted','instagram',3,'2026-09-12 21:05:07',NULL,'Demo record: client priorities and next action are documented.',NULL,NULL,'2026-09-11 21:05:07','2026-09-16','demo-import',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(4,6,NULL,6,NULL,'Ananya Rao','ananya.rao@demo.test','+91 98250 11004','India',NULL,'2026-11-26',0,6,2,0,0,'₹75,000 - ₹3,50,000',NULL,NULL,'Interested in Romantic Bali Hideaway; prefers comfortable hotels and private transfers.','quoted','whatsapp',3,'2026-09-13 21:05:07','2026-09-20 06:05:07','Demo record: client priorities and next action are documented.',NULL,NULL,'2026-09-12 21:05:07','2026-09-16','demo-import',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(5,4,NULL,4,NULL,'Kunal Joshi','kunal.joshi@demo.test','+91 98250 11005','India',NULL,'2026-12-08',1,8,2,0,0,'₹75,000 - ₹3,50,000',NULL,NULL,'Interested in Royal Rajasthan Circuit; prefers comfortable hotels and private transfers.','contacted','walkin',3,'2026-09-14 21:05:07','2026-09-21 06:05:07','Demo record: client priorities and next action are documented.',NULL,NULL,'2026-09-13 21:05:07','2026-09-16','demo-import',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `enquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiry_logs`
--

DROP TABLE IF EXISTS `enquiry_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enquiry_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enquiry_logs_record_id_index` (`record_id`),
  KEY `enquiry_logs_user_id_index` (`user_id`),
  KEY `enquiry_logs_action_index` (`action`),
  KEY `enquiry_logs_created_at_index` (`created_at`),
  CONSTRAINT `enquiry_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiry_logs`
--

LOCK TABLES `enquiry_logs` WRITE;
/*!40000 ALTER TABLE `enquiry_logs` DISABLE KEYS */;
INSERT INTO `enquiry_logs` VALUES (1,1,NULL,'created','Enquiry created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(2,2,NULL,'created','Enquiry created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(3,3,NULL,'created','Enquiry created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(4,4,NULL,'created','Enquiry created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(5,5,NULL,'created','Enquiry created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(6,1,NULL,'updated','Updated: travel_date, last_contacted_at, privacy_accepted_at, privacy_policy_version, consent_source','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"travel_date\": \"2026-10-20T00:00:00.000000Z\", \"consent_source\": null, \"last_contacted_at\": \"2026-09-10T22:26:04.000000Z\", \"privacy_accepted_at\": null, \"privacy_policy_version\": null}','{\"travel_date\": \"2026-10-21 00:00:00\", \"consent_source\": \"demo-import\", \"last_contacted_at\": \"2026-09-11 02:35:06\", \"privacy_accepted_at\": \"2026-09-10 02:35:06\", \"privacy_policy_version\": \"2026-09-16\"}','127.0.0.1','2026-09-15 21:05:06'),(7,2,NULL,'updated','Updated: travel_date, last_contacted_at, privacy_accepted_at, privacy_policy_version, consent_source','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"travel_date\": \"2026-11-01T00:00:00.000000Z\", \"consent_source\": null, \"last_contacted_at\": \"2026-09-11T22:26:04.000000Z\", \"privacy_accepted_at\": null, \"privacy_policy_version\": null}','{\"travel_date\": \"2026-11-02 00:00:00\", \"consent_source\": \"demo-import\", \"last_contacted_at\": \"2026-09-12 02:35:06\", \"privacy_accepted_at\": \"2026-09-11 02:35:06\", \"privacy_policy_version\": \"2026-09-16\"}','127.0.0.1','2026-09-15 21:05:06'),(8,3,NULL,'updated','Updated: travel_date, last_contacted_at, privacy_accepted_at, privacy_policy_version, consent_source','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"travel_date\": \"2026-11-13T00:00:00.000000Z\", \"consent_source\": null, \"last_contacted_at\": \"2026-09-12T22:26:04.000000Z\", \"privacy_accepted_at\": null, \"privacy_policy_version\": null}','{\"travel_date\": \"2026-11-14 00:00:00\", \"consent_source\": \"demo-import\", \"last_contacted_at\": \"2026-09-13 02:35:07\", \"privacy_accepted_at\": \"2026-09-12 02:35:07\", \"privacy_policy_version\": \"2026-09-16\"}','127.0.0.1','2026-09-15 21:05:07'),(9,4,NULL,'updated','Updated: travel_date, last_contacted_at, follow_up_at, privacy_accepted_at, privacy_policy_version, consent_source','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"travel_date\": \"2026-11-25T00:00:00.000000Z\", \"follow_up_at\": \"2026-09-19T11:26:04.000000Z\", \"consent_source\": null, \"last_contacted_at\": \"2026-09-13T22:26:04.000000Z\", \"privacy_accepted_at\": null, \"privacy_policy_version\": null}','{\"travel_date\": \"2026-11-26 00:00:00\", \"follow_up_at\": \"2026-09-20 11:35:07\", \"consent_source\": \"demo-import\", \"last_contacted_at\": \"2026-09-14 02:35:07\", \"privacy_accepted_at\": \"2026-09-13 02:35:07\", \"privacy_policy_version\": \"2026-09-16\"}','127.0.0.1','2026-09-15 21:05:07'),(10,5,NULL,'updated','Updated: travel_date, last_contacted_at, follow_up_at, privacy_accepted_at, privacy_policy_version, consent_source','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"travel_date\": \"2026-12-07T00:00:00.000000Z\", \"follow_up_at\": \"2026-09-20T11:26:04.000000Z\", \"consent_source\": null, \"last_contacted_at\": \"2026-09-14T22:26:04.000000Z\", \"privacy_accepted_at\": null, \"privacy_policy_version\": null}','{\"travel_date\": \"2026-12-08 00:00:00\", \"follow_up_at\": \"2026-09-21 11:35:07\", \"consent_source\": \"demo-import\", \"last_contacted_at\": \"2026-09-15 02:35:07\", \"privacy_accepted_at\": \"2026-09-14 02:35:07\", \"privacy_policy_version\": \"2026-09-16\"}','127.0.0.1','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `enquiry_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exports`
--

DROP TABLE IF EXISTS `exports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exporter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_rows` int unsigned NOT NULL DEFAULT '0',
  `total_rows` int unsigned NOT NULL,
  `successful_rows` int unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exports_user_id_foreign` (`user_id`),
  CONSTRAINT `exports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exports`
--

LOCK TABLES `exports` WRITE;
/*!40000 ALTER TABLE `exports` DISABLE KEYS */;
/*!40000 ALTER TABLE `exports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_import_rows`
--

DROP TABLE IF EXISTS `failed_import_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_import_rows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `data` json NOT NULL,
  `import_id` bigint unsigned NOT NULL,
  `validation_error` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `failed_import_rows_import_id_foreign` (`import_id`),
  CONSTRAINT `failed_import_rows_import_id_foreign` FOREIGN KEY (`import_id`) REFERENCES `imports` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_import_rows`
--

LOCK TABLES `failed_import_rows` WRITE;
/*!40000 ALTER TABLE `failed_import_rows` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_import_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faqs_category_index` (`category`),
  KEY `faqs_is_active_index` (`is_active`),
  KEY `faqs_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'Can the itinerary be customised?','<p>Yes. We can adjust the route, number of nights, hotel category, room requirements, transfers, sightseeing and free time before you confirm.</p>','Planning',0,1,NULL,'2026-09-15 16:56:04','2026-09-19 08:59:54'),(2,'How much is required to confirm a booking?','<p>The deposit depends on the fare and supplier conditions in your proposal. We show the exact payment schedule and non-refundable components before you pay.</p>','Payments',1,1,NULL,'2026-09-15 16:56:04','2026-09-19 08:59:54'),(3,'Do you assist during the trip?','<p>Confirmed travellers receive an operations contact for urgent coordination involving services booked through UniWorld Holidays.</p>','Support',2,1,NULL,'2026-09-15 16:56:04','2026-09-19 08:59:54'),(4,'Are package prices final?','<p>Displayed prices are indicative starting points. Your final proposal reflects travel dates, availability, party size, room type and selected inclusions.</p>','Pricing',3,1,NULL,'2026-09-19 08:59:54','2026-09-19 08:59:54'),(5,'Can you arrange visas?','<p>We provide documentation guidance and application coordination for supported destinations. Visa approval is solely at the discretion of the relevant authority.</p>','Documents',4,1,NULL,'2026-09-19 08:59:54','2026-09-19 08:59:54'),(6,'What happens if I need to cancel?','<p>Cancellation charges depend on the airline, hotel and other supplier terms accepted at confirmation. We explain applicable conditions in the proposal.</p>','Changes',5,1,NULL,'2026-09-19 08:59:54','2026-09-19 08:59:54'),(7,'Is travel insurance included?','<p>Insurance is included only when stated in the proposal. We recommend suitable cover and ask travellers to review policy limits and exclusions carefully.</p>','Documents',6,1,NULL,'2026-09-19 08:59:54','2026-09-19 08:59:54'),(8,'When should I start planning?','<p>For peak dates and international journeys, earlier planning usually provides better flight and hotel choice. Complex group travel may require additional lead time.</p>','Planning',7,1,NULL,'2026-09-19 08:59:54','2026-09-19 08:59:54');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follow_ups`
--

DROP TABLE IF EXISTS `follow_ups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `follow_ups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `enquiry_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `next_follow_up_at` timestamp NULL DEFAULT NULL,
  `duration_seconds` smallint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `follow_ups_enquiry_id_index` (`enquiry_id`),
  KEY `follow_ups_created_by_index` (`created_by`),
  KEY `follow_ups_scheduled_at_index` (`scheduled_at`),
  KEY `follow_ups_next_follow_up_at_index` (`next_follow_up_at`),
  KEY `follow_ups_status_index` (`status`),
  KEY `follow_ups_type_index` (`type`),
  CONSTRAINT `follow_ups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `follow_ups_enquiry_id_foreign` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow_ups`
--

LOCK TABLES `follow_ups` WRITE;
/*!40000 ALTER TABLE `follow_ups` DISABLE KEYS */;
INSERT INTO `follow_ups` VALUES (1,1,3,'call','completed','Discovery call completed; preferences documented.','2026-09-11 21:05:06','2026-09-11 21:23:06',NULL,1080,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,2,3,'call','completed','Discovery call completed; preferences documented.','2026-09-11 21:05:06','2026-09-11 21:23:06',NULL,1080,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(3,3,3,'call','completed','Discovery call completed; preferences documented.','2026-09-11 21:05:07','2026-09-11 21:23:07',NULL,1080,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(4,4,3,'call','completed','Discovery call completed; preferences documented.','2026-09-11 21:05:07','2026-09-11 21:23:07',NULL,1080,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(5,4,3,'whatsapp','callback','Review quotation and confirm travel dates.','2026-09-20 06:05:07',NULL,'2026-09-20 06:05:07',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(6,5,3,'call','completed','Discovery call completed; preferences documented.','2026-09-11 21:05:07','2026-09-11 21:23:07',NULL,1080,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(7,5,3,'whatsapp','callback','Review quotation and confirm travel dates.','2026-09-21 06:05:07',NULL,'2026-09-21 06:05:07',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `follow_ups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imports`
--

DROP TABLE IF EXISTS `imports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `completed_at` timestamp NULL DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `importer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processed_rows` int unsigned NOT NULL DEFAULT '0',
  `total_rows` int unsigned NOT NULL,
  `successful_rows` int unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `imports_user_id_foreign` (`user_id`),
  CONSTRAINT `imports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imports`
--

LOCK TABLES `imports` WRITE;
/*!40000 ALTER TABLE `imports` DISABLE KEYS */;
/*!40000 ALTER TABLE `imports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'default','{\"uuid\":\"3c241894-c2af-44ef-a0ce-96eeeacc3d11\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:57:\\\"Arjun & Nisha Mehta (+91 98250 11001) — Source: website\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"70352631-85b7-46ed-a49c-89ae3f379c5c\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(2,'default','{\"uuid\":\"fb760ba4-83bf-4df6-b422-42149c57c6d3\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:57:\\\"Arjun & Nisha Mehta (+91 98250 11001) — Source: website\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"259573db-d870-4fa9-aeeb-ff1817ce4ca7\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(3,'default','{\"uuid\":\"793a3b49-0bb4-42a5-b81e-1c6001f601f2\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:77:\\\"₹30,000 received for UW-2026-000001 (Arjun & Nisha Mehta) via bank_transfer\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:25:\\\"heroicon-o-currency-rupee\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:16:\\\"Payment Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"4a61ebac-c9df-4689-a2af-470cbde4396d\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(4,'default','{\"uuid\":\"9e96f24f-a8ca-4c75-bc65-b55162134fe8\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:77:\\\"₹30,000 received for UW-2026-000001 (Arjun & Nisha Mehta) via bank_transfer\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:25:\\\"heroicon-o-currency-rupee\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:16:\\\"Payment Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"73437284-0ddd-4182-b8d9-073a0a76e30e\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(5,'default','{\"uuid\":\"b8f67eab-da53-4137-9945-40a1d4e8c4e8\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:54:\\\"The Shah Family (+91 98250 11002) — Source: referral\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"86daa1e2-0401-4dec-992f-7108a2eaedcb\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(6,'default','{\"uuid\":\"8e45567b-44f4-439a-94b0-441ad0837e68\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:54:\\\"The Shah Family (+91 98250 11002) — Source: referral\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"dcca689d-2779-450c-9a48-f66b1599333c\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(7,'default','{\"uuid\":\"2eaee1af-0012-4feb-8671-08d944b876d4\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:58:\\\"Riya and Dev Patel (+91 98250 11003) — Source: instagram\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"18a037e2-b615-4a70-a463-ca2e9523b94a\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(8,'default','{\"uuid\":\"0cb350d0-395c-42a1-aff3-d0e735119d53\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:58:\\\"Riya and Dev Patel (+91 98250 11003) — Source: instagram\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"9d02ab02-f342-4bf4-8a98-5afa215d7d08\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(9,'default','{\"uuid\":\"1f99f644-4c6c-4565-a75e-6299c47615c3\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:70:\\\"₹309,800 received for UW-2026-000003 (Riya and Dev Patel) via online\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:25:\\\"heroicon-o-currency-rupee\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:16:\\\"Payment Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"c01c658b-934d-4810-b15b-564fea96b939\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(10,'default','{\"uuid\":\"c0b40e1e-51d6-4c3b-9e2a-bb9b9bb0bf39\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:4;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:70:\\\"₹309,800 received for UW-2026-000003 (Riya and Dev Patel) via online\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:25:\\\"heroicon-o-currency-rupee\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:16:\\\"Payment Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"8a4ce331-562c-4a5a-aee6-02d70d53d55a\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(11,'default','{\"uuid\":\"6d7addfd-10c4-4f75-bc22-02359d4881ee\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:49:\\\"Ananya Rao (+91 98250 11004) — Source: whatsapp\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"f4f36af4-11a3-44d1-b34b-3d4439fd60ab\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(12,'default','{\"uuid\":\"6d4b362f-6d13-4240-b460-5f14ee364168\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:49:\\\"Ananya Rao (+91 98250 11004) — Source: whatsapp\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"3a7e4f4c-0612-4346-b72b-a5c9f40e7cbf\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(13,'default','{\"uuid\":\"fd742e85-d806-41a8-a2d4-3af52bdfaf49\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:2;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:48:\\\"Kunal Joshi (+91 98250 11005) — Source: walkin\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"2afc987e-c1a1-449d-bef1-f745347209be\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164),(14,'default','{\"uuid\":\"dbf64a3f-5604-424a-894c-4da44de704b8\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"deleteWhenMissingModels\":false,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:48:\\\"Kunal Joshi (+91 98250 11005) — Source: walkin\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:33:\\\"heroicon-o-chat-bubble-left-right\\\";s:9:\\\"iconColor\\\";s:4:\\\"info\\\";s:6:\\\"status\\\";s:4:\\\"info\\\";s:5:\\\"title\\\";s:20:\\\"New Enquiry Received\\\";s:4:\\\"view\\\";N;s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"468d52bd-2f53-4212-8124-850e14373154\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\",\"batchId\":null},\"createdAt\":1789511164,\"delay\":null}',0,NULL,1789511164,1789511164);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_06_12_000001_create_destinations_table',1),(5,'2026_06_12_125814_create_media_table',1),(6,'2026_06_12_130123_create_permission_tables',1),(7,'2026_06_12_141405_create_tours_table',1),(8,'2026_06_12_141412_create_tour_pricing_table',1),(9,'2026_06_12_141619_create_enquiries_table',1),(10,'2026_06_12_141630_create_quotations_table',1),(11,'2026_06_12_141653_create_quotation_sections_table',1),(12,'2026_06_12_141704_create_quotation_items_table',1),(13,'2026_06_12_141709_create_quotation_histories_table',1),(14,'2026_06_12_142100_create_bookings_table',1),(15,'2026_06_12_142200_create_payments_table',1),(16,'2026_06_12_142300_create_travellers_table',1),(17,'2026_06_12_142400_create_booking_status_histories_table',1),(18,'2026_06_12_142500_create_payment_histories_table',1),(19,'2026_06_13_000003_create_notifications_table',1),(20,'2026_06_13_074357_create_pages_table',1),(21,'2026_06_13_074407_create_posts_table',1),(22,'2026_06_13_074423_create_banners_table',1),(23,'2026_06_13_074453_create_testimonials_table',1),(24,'2026_06_13_074506_create_faqs_table',1),(25,'2026_06_13_074526_create_settings_table',1),(26,'2026_06_30_192218_create_follow_ups_table',1),(27,'2026_06_30_215934_create_activity_logs_table',1),(28,'2026_06_30_215937_create_online_payments_table',1),(29,'2026_06_30_222144_create_module_activity_logs_tables',1),(30,'2026_07_01_000001_create_booking_sequences_table',1),(31,'2026_07_01_000002_add_soft_deletes_to_payment_tables',1),(32,'2026_07_01_000003_add_type_to_pages_table',1),(33,'2026_07_15_000001_add_composite_indexes_for_reports',1),(34,'2026_09_16_000001_create_payment_activity_log_tables',1),(35,'2026_09_16_000002_create_filament_action_tables',1),(36,'2026_09_16_000003_harden_online_payment_idempotency',1),(37,'2026_09_16_000004_enforce_one_booking_per_quotation',2),(38,'2026_09_16_000005_create_setting_activity_log_table',3),(39,'2026_09_16_000006_add_privacy_consent_to_enquiries',4),(40,'2026_09_19_000001_enhance_enquiries_and_destinations_for_admin_workflow',5),(41,'2026_09_19_000002_add_video_support_to_banners',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',2),(2,'App\\Models\\User',3),(3,'App\\Models\\User',4),(4,'App\\Models\\User',5);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` json NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `online_payment_logs`
--

DROP TABLE IF EXISTS `online_payment_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `online_payment_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `online_payment_logs_record_id_index` (`record_id`),
  KEY `online_payment_logs_user_id_index` (`user_id`),
  KEY `online_payment_logs_action_index` (`action`),
  KEY `online_payment_logs_created_at_index` (`created_at`),
  CONSTRAINT `online_payment_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `online_payment_logs`
--

LOCK TABLES `online_payment_logs` WRITE;
/*!40000 ALTER TABLE `online_payment_logs` DISABLE KEYS */;
INSERT INTO `online_payment_logs` VALUES (1,1,NULL,'created','OnlinePayment created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(2,1,NULL,'updated','Updated: paid_at','{\"paid_at\": \"2026-09-14T22:26:04.000000Z\", \"updated_at\": \"2026-09-15T22:26:04.000000Z\"}','{\"paid_at\": \"2026-09-15 02:35:07\"}','127.0.0.1','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `online_payment_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `online_payments`
--

DROP TABLE IF EXISTS `online_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `online_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned DEFAULT NULL,
  `quotation_id` bigint unsigned DEFAULT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'razorpay',
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'created',
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `gateway_response` json DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `online_payments_payment_id_unique` (`payment_id`),
  UNIQUE KEY `online_payments_gateway_order_id_unique` (`gateway`,`order_id`),
  KEY `online_payments_booking_id_index` (`booking_id`),
  KEY `online_payments_quotation_id_index` (`quotation_id`),
  KEY `online_payments_payment_id_index` (`payment_id`),
  KEY `online_payments_status_index` (`status`),
  KEY `online_payments_created_at_index` (`created_at`),
  CONSTRAINT `online_payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `online_payments_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `online_payments`
--

LOCK TABLES `online_payments` WRITE;
/*!40000 ALTER TABLE `online_payments` DISABLE KEYS */;
INSERT INTO `online_payments` VALUES (1,3,3,'razorpay','order_demo_3','pay_demo_3',NULL,309800.00,'INR','captured','Riya and Dev Patel','riya.patel@demo.test','+91 98250 11003',NULL,'{\"demo\": true, \"status\": \"captured\"}','2026-09-14 21:05:07',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `online_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_logs`
--

DROP TABLE IF EXISTS `page_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_logs_record_id_index` (`record_id`),
  KEY `page_logs_user_id_index` (`user_id`),
  KEY `page_logs_action_index` (`action`),
  KEY `page_logs_created_at_index` (`created_at`),
  CONSTRAINT `page_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_logs`
--

LOCK TABLES `page_logs` WRITE;
/*!40000 ALTER TABLE `page_logs` DISABLE KEYS */;
INSERT INTO `page_logs` VALUES (1,1,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(2,2,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(3,3,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(4,1,NULL,'updated','Updated: slug, short_description, published_at','{\"slug\": \"about-us\", \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\", \"short_description\": \"We plan thoughtful holidays with clear communication, trusted partners and support from enquiry to return.\"}','{\"slug\": \"travel-designed-around-you\", \"published_at\": \"2026-08-16 02:35:06\", \"short_description\": \"We plan thoughtful holidays with clear communication, trusted partners and support from enquiry to return.\"}','127.0.0.1','2026-09-15 21:05:06'),(5,2,NULL,'updated','Updated: short_description, published_at','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\", \"short_description\": \"Document guidance, appointment preparation and status coordination for supported destinations.\"}','{\"published_at\": \"2026-08-16 02:35:06\", \"short_description\": \"Document guidance, appointment preparation and status coordination for supported destinations.\"}','127.0.0.1','2026-09-15 21:05:06'),(6,3,NULL,'updated','Updated: short_description, published_at','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\", \"short_description\": \"Responsive travel planning for teams, incentives, conferences and executive journeys.\"}','{\"published_at\": \"2026-08-16 02:35:06\", \"short_description\": \"Responsive travel planning for teams, incentives, conferences and executive journeys.\"}','127.0.0.1','2026-09-15 21:05:06'),(7,4,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-19 08:59:54'),(8,5,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-19 08:59:54'),(9,6,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-19 08:59:54'),(10,7,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-19 08:59:54'),(11,2,NULL,'updated','Updated: slug, short_description, title, content, meta_title, meta_description, published_at','{\"slug\": \"visa-assistance\", \"title\": \"Visa Assistance\", \"content\": \"<p>Document guidance, appointment preparation and status coordination for supported destinations.</p>\", \"meta_title\": null, \"updated_at\": \"2026-09-16T02:35:06.000000Z\", \"published_at\": \"2026-08-16T02:35:06.000000Z\", \"meta_description\": null, \"short_description\": \"Document guidance, appointment preparation and status coordination for supported destinations.\"}','{\"slug\": \"visa-documentation-guidance\", \"title\": \"Visa Documentation Guidance\", \"content\": \"<h2>Structured documentation support</h2><p>Visa decisions remain solely with the relevant embassy or immigration authority. Our role is to help you understand the current process and prepare an orderly application.</p><h3>Support may include</h3><ul><li>Application-specific document checklist</li><li>Form and supporting-document review</li><li>Appointment guidance where applicable</li><li>Status coordination through the authorised channel</li><li>Pre-departure document check</li></ul>\", \"meta_title\": \"Visa Documentation Guidance | UniWorld Holidays\", \"published_at\": \"2026-08-19 14:29:54\", \"meta_description\": \"Destination-specific checklists, application review and appointment coordination for supported visa categories.\", \"short_description\": \"Destination-specific checklists, application review and appointment coordination for supported visa categories.\"}','127.0.0.1','2026-09-19 08:59:54'),(12,8,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-19 08:59:54'),(13,3,NULL,'updated','Updated: slug, short_description, title, content, meta_title, meta_description, published_at','{\"slug\": \"corporate-travel\", \"title\": \"Corporate Travel\", \"content\": \"<p>Responsive travel planning for teams, incentives, conferences and executive journeys.</p>\", \"meta_title\": null, \"updated_at\": \"2026-09-16T02:35:06.000000Z\", \"published_at\": \"2026-08-16T02:35:06.000000Z\", \"meta_description\": null, \"short_description\": \"Responsive travel planning for teams, incentives, conferences and executive journeys.\"}','{\"slug\": \"corporate-mice-travel\", \"title\": \"Corporate & MICE Travel\", \"content\": \"<h2>Structured travel for organisations</h2><p>We coordinate business travel with clear ownership, documented approvals and practical support for travellers and organisers.</p><h3>Capabilities</h3><ul><li>Executive flight, hotel and transfer arrangements</li><li>Meetings and conference logistics</li><li>Incentive journeys and team offsites</li><li>Group movement and rooming-list coordination</li><li>GST-aligned documentation where applicable</li></ul>\", \"meta_title\": \"Corporate & MICE Travel | UniWorld Holidays\", \"published_at\": \"2026-08-19 14:29:54\", \"meta_description\": \"Accountable coordination for business trips, meetings, incentives, conferences and executive movements.\", \"short_description\": \"Accountable coordination for business trips, meetings, incentives, conferences and executive movements.\"}','127.0.0.1','2026-09-19 08:59:54'),(14,9,NULL,'created','Page created',NULL,NULL,'127.0.0.1','2026-09-19 08:59:54');
/*!40000 ALTER TABLE `page_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`),
  KEY `pages_is_published_index` (`is_published`),
  KEY `pages_published_at_index` (`published_at`),
  KEY `pages_type_index` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'travel-designed-around-you','page',0,NULL,'We plan thoughtful holidays with clear communication, trusted partners and support from enquiry to return.','Travel Designed Around You','<p>We plan thoughtful holidays with clear communication, trusted partners and support from enquiry to return.</p>',NULL,NULL,NULL,1,'2026-08-15 21:05:06',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,'visa-assistance','service',1,NULL,'Destination-specific checklists, application review and appointment coordination for supported visa categories.','Visa Documentation Guidance','<h2>Structured documentation support</h2><p>Visa decisions remain solely with the relevant embassy or immigration authority. Our role is to help you understand the current process and prepare an orderly application.</p><h3>Support may include</h3><ul><li>Application-specific document checklist</li><li>Form and supporting-document review</li><li>Appointment guidance where applicable</li><li>Status coordination through the authorised channel</li><li>Pre-departure document check</li></ul>','Visa Documentation Guidance | UniWorld Holidays','Destination-specific checklists, application review and appointment coordination for supported visa categories.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(3,'corporate-travel','service',2,NULL,'Accountable coordination for business trips, meetings, incentives, conferences and executive movements.','Corporate & MICE Travel','<h2>Structured travel for organisations</h2><p>We coordinate business travel with clear ownership, documented approvals and practical support for travellers and organisers.</p><h3>Capabilities</h3><ul><li>Executive flight, hotel and transfer arrangements</li><li>Meetings and conference logistics</li><li>Incentive journeys and team offsites</li><li>Group movement and rooming-list coordination</li><li>GST-aligned documentation where applicable</li></ul>','Corporate & MICE Travel | UniWorld Holidays','Accountable coordination for business trips, meetings, incentives, conferences and executive movements.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(4,'about-us','page',0,NULL,'Personalised holidays, explained clearly and coordinated by one accountable travel team.','Travel Planning Built Around You','<h2>A more considered way to plan</h2><p>UniWorld Holidays designs journeys for families, couples, groups and organisations across India and selected international destinations. We begin by understanding who is travelling, what matters to them and how they want each day to feel.</p><h3>Clarity before commitment</h3><p>Your proposal sets out the route, stay category, inclusions, exclusions and payment schedule so you can make an informed decision. Where options exist, we explain the practical trade-offs rather than presenting a one-size-fits-all package.</p><h3>Support that stays connected</h3><p>Our planning and operations teams coordinate the journey from enquiry to return, including supplier confirmations and assistance when travel plans change.</p>','About UniWorld Holidays | Personalised Travel Planning','Learn how UniWorld Holidays creates personalised itineraries through thoughtful advice, clear proposals and dependable travel coordination.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 08:59:54','2026-09-19 09:27:43'),(5,'holiday-packages','service',0,NULL,'Tailor-made India and international journeys designed around your dates, interests, pace and preferred investment.','Holiday Planning','<h2>Travel designed around your priorities</h2><p>Begin with one of our proven routes or start with a blank page. We coordinate destination sequencing, hotel categories, transfers, experiences and leisure time into one coherent itinerary.</p><h3>What your proposal can include</h3><ul><li>Destination and seasonal guidance</li><li>Hotel and room-category options</li><li>Private or shared transfers</li><li>Guided visits and bookable experiences</li><li>Clear inclusions, exclusions and payment milestones</li></ul>','Holiday Planning | UniWorld Holidays','Tailor-made India and international journeys designed around your dates, interests, pace and preferred investment.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 08:59:54','2026-09-19 09:27:43'),(6,'hotel-booking','service',0,NULL,'Hotels, resorts and distinctive stays shortlisted for location, comfort, service standards and value.','Curated Hotel Selection','<h2>The right stay for the journey</h2><p>We evaluate more than the headline rate. Location, room layout, meal plan, transfer time and suitability for your party all influence the recommendation.</p><h3>Stay categories</h3><ul><li>Reliable value and comfort hotels</li><li>Premium city and resort properties</li><li>Heritage stays, villas and houseboats</li><li>Family rooms and connected-room options</li><li>Celebration and honeymoon upgrades where available</li></ul>','Curated Hotel Selection | UniWorld Holidays','Hotels, resorts and distinctive stays shortlisted for location, comfort, service standards and value.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 08:59:54','2026-09-19 09:27:43'),(7,'flights','service',0,NULL,'Domestic and international flight options aligned with your itinerary, baggage needs, connections and arrival times.','Flight Planning','<h2>Flights that work with the complete plan</h2><p>We compare practical routing, total journey time, baggage allowance and change conditions—not only the lowest displayed fare.</p><h3>Planning support</h3><ul><li>Domestic, international and multi-city routing</li><li>Connection and transit-time review</li><li>Baggage, seat and meal coordination where supported</li><li>Group fare enquiries</li><li>Rebooking assistance subject to airline rules</li></ul>','Flight Planning | UniWorld Holidays','Domestic and international flight options aligned with your itinerary, baggage needs, connections and arrival times.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 08:59:54','2026-09-19 09:27:43'),(8,'cruise','service',0,NULL,'Cruise recommendations based on route, sailing date, cabin type, onboard style and traveller needs.','Cruise Holidays','<h2>Choose the right ship and sailing</h2><p>A cruise holiday is shaped by the ship, cabin, itinerary and fare conditions. We compare these elements and coordinate pre- or post-cruise stays where useful.</p><h3>Planning considerations</h3><ul><li>Suitable cruise line and ship style</li><li>Interior, ocean-view, balcony and suite cabins</li><li>Port schedule and optional shore experiences</li><li>Visa and embarkation guidance</li><li>Flights and hotel nights around the sailing</li></ul>','Cruise Holidays | UniWorld Holidays','Cruise recommendations based on route, sailing date, cabin type, onboard style and traveller needs.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 08:59:54','2026-09-19 09:27:43'),(9,'travel-insurance','service',0,NULL,'Help comparing suitable travel insurance options for destination requirements and traveller circumstances.','Travel Insurance Guidance','<h2>Protection suited to the journey</h2><p>Coverage, limits and exclusions vary by insurer and policy. We help identify relevant options, while the final policy wording remains the authoritative document.</p><h3>Areas to review</h3><ul><li>Emergency medical and evacuation cover</li><li>Trip cancellation or interruption benefits</li><li>Baggage loss and delay provisions</li><li>Age, activity and pre-existing-condition terms</li><li>Destination-specific insurance requirements</li></ul>','Travel Insurance Guidance | UniWorld Holidays','Help comparing suitable travel insurance options for destination requirements and traveller circumstances.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 08:59:54','2026-09-19 09:27:43'),(10,'gallery','page',0,NULL,'A visual introduction to journeys across India and selected international destinations.','Travel Inspiration','<p>A visual introduction to journeys across India and selected international destinations.</p>','Travel Inspiration | UniWorld Holidays','A visual introduction to journeys across India and selected international destinations.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 09:27:43','2026-09-19 09:27:43'),(11,'privacy-policy','page',0,NULL,'How UniWorld Holidays collects, uses and safeguards information shared for travel enquiries and bookings.','Privacy Policy','<p>How UniWorld Holidays collects, uses and safeguards information shared for travel enquiries and bookings.</p>','Privacy Policy | UniWorld Holidays','How UniWorld Holidays collects, uses and safeguards information shared for travel enquiries and bookings.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 09:27:43','2026-09-19 09:27:43'),(12,'terms-conditions','page',0,NULL,'The booking, payment, cancellation and traveller responsibilities that apply to UniWorld Holidays services.','Booking Terms & Conditions','<p>The booking, payment, cancellation and traveller responsibilities that apply to UniWorld Holidays services.</p>','Booking Terms & Conditions | UniWorld Holidays','The booking, payment, cancellation and traveller responsibilities that apply to UniWorld Holidays services.',NULL,1,'2026-08-19 09:27:43',NULL,'2026-09-19 09:27:43','2026-09-19 09:27:43');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
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
-- Table structure for table `payment_histories`
--

DROP TABLE IF EXISTS `payment_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` bigint unsigned DEFAULT NULL,
  `booking_id` bigint unsigned DEFAULT NULL,
  `changed_by` bigint unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_amount` decimal(12,2) DEFAULT NULL,
  `new_amount` decimal(12,2) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_histories_payment_id_index` (`payment_id`),
  KEY `payment_histories_booking_id_index` (`booking_id`),
  KEY `payment_histories_changed_by_index` (`changed_by`),
  KEY `payment_histories_event_index` (`event`),
  KEY `payment_histories_created_at_index` (`created_at`),
  CONSTRAINT `payment_histories_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payment_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payment_histories_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_histories`
--

LOCK TABLES `payment_histories` WRITE;
/*!40000 ALTER TABLE `payment_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_logs`
--

DROP TABLE IF EXISTS `payment_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_logs_record_id_index` (`record_id`),
  KEY `payment_logs_user_id_index` (`user_id`),
  KEY `payment_logs_action_index` (`action`),
  KEY `payment_logs_created_at_index` (`created_at`),
  CONSTRAINT `payment_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_logs`
--

LOCK TABLES `payment_logs` WRITE;
/*!40000 ALTER TABLE `payment_logs` DISABLE KEYS */;
INSERT INTO `payment_logs` VALUES (1,1,NULL,'created','Payment created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(2,2,NULL,'created','Payment created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(3,1,NULL,'updated','Updated: payment_date','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"payment_date\": \"2026-09-13T00:00:00.000000Z\"}','{\"payment_date\": \"2026-09-14 00:00:00\"}','127.0.0.1','2026-09-15 21:05:06'),(4,2,NULL,'updated','Updated: payment_date','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"payment_date\": \"2026-09-14T00:00:00.000000Z\"}','{\"payment_date\": \"2026-09-15 00:00:00\"}','127.0.0.1','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `payment_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned DEFAULT NULL,
  `online_payment_id` bigint unsigned DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'received',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `receipt_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recorded_by` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_online_payment_id_unique` (`online_payment_id`),
  KEY `payments_booking_id_index` (`booking_id`),
  KEY `payments_recorded_by_index` (`recorded_by`),
  KEY `payments_status_index` (`status`),
  KEY `payments_method_index` (`method`),
  KEY `payments_payment_date_index` (`payment_date`),
  KEY `payments_reference_number_index` (`reference_number`),
  KEY `payments_status_date_composite` (`status`,`payment_date`),
  CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payments_online_payment_id_foreign` FOREIGN KEY (`online_payment_id`) REFERENCES `online_payments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `payments_recorded_by_foreign` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,NULL,30000.00,'INR','bank_transfer','DEMO-NEFT-1','2026-09-14','received','Demo advance received by bank transfer',NULL,4,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,3,1,309800.00,'INR','online','pay_demo_3','2026-09-15','received','Demo Razorpay payment',NULL,4,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_destinations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(2,'create_destinations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(3,'edit_destinations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(4,'delete_destinations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(5,'restore_destinations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(6,'force_delete_destinations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(7,'view_tours','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(8,'create_tours','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(9,'edit_tours','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(10,'delete_tours','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(11,'restore_tours','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(12,'force_delete_tours','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(13,'duplicate_tours','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(14,'publish_tours','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(15,'view_tour_pricing','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(16,'create_tour_pricing','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(17,'edit_tour_pricing','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(18,'delete_tour_pricing','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(19,'restore_tour_pricing','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(20,'view_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(21,'create_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(22,'edit_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(23,'delete_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(24,'restore_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(25,'assign_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(26,'mark_contacted_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(27,'mark_lost_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(28,'convert_enquiries','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(29,'view_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(30,'create_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(31,'edit_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(32,'delete_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(33,'restore_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(34,'send_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(35,'download_pdf_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(36,'create_version_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(37,'accept_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(38,'reject_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(39,'request_changes_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(40,'copy_public_link_quotations','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(41,'view_quotation_items','web','2026-09-15 16:56:01','2026-09-15 16:56:01'),(42,'create_quotation_items','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(43,'edit_quotation_items','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(44,'delete_quotation_items','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(45,'restore_quotation_items','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(46,'view_bookings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(47,'create_bookings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(48,'edit_bookings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(49,'delete_bookings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(50,'restore_bookings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(51,'cancel_bookings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(52,'complete_bookings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(53,'confirm_bookings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(54,'view_payments','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(55,'create_payments','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(56,'edit_payments','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(57,'delete_payments','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(58,'restore_payments','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(59,'refund_payments','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(60,'view_travellers','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(61,'create_travellers','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(62,'edit_travellers','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(63,'delete_travellers','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(64,'restore_travellers','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(65,'view_pages','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(66,'create_pages','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(67,'edit_pages','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(68,'delete_pages','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(69,'restore_pages','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(70,'publish_pages','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(71,'view_posts','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(72,'create_posts','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(73,'edit_posts','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(74,'delete_posts','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(75,'restore_posts','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(76,'publish_posts','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(77,'view_banners','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(78,'create_banners','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(79,'edit_banners','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(80,'delete_banners','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(81,'restore_banners','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(82,'view_testimonials','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(83,'create_testimonials','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(84,'edit_testimonials','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(85,'delete_testimonials','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(86,'restore_testimonials','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(87,'view_faqs','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(88,'create_faqs','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(89,'edit_faqs','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(90,'delete_faqs','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(91,'restore_faqs','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(92,'view_settings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(93,'edit_settings','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(94,'view_users','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(95,'create_users','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(96,'edit_users','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(97,'delete_users','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(98,'restore_users','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(99,'view_roles','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(100,'create_roles','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(101,'edit_roles','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(102,'delete_roles','web','2026-09-15 16:56:02','2026-09-15 16:56:02');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `author_id` bigint unsigned DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` json DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_time_minutes` tinyint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_author_id_index` (`author_id`),
  KEY `posts_category_index` (`category`),
  KEY `posts_is_published_index` (`is_published`),
  KEY `posts_published_at_index` (`published_at`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'the-best-time-to-visit-kashmir','The Best Time to Visit Kashmir','Practical advice from planning and budgeting to experiences, timing and local travel.','<p>A successful holiday starts with realistic pacing, clear inclusions and time for spontaneous discoveries. This guide explains the choices that matter most.</p><h2>Plan with confidence</h2><p>Confirm travel dates, expected weather, entry requirements and cancellation terms before making non-refundable commitments.</p>',5,'assets/frontend/images/demo/destination-kashmir.webp','Destination Guide','[\"planning\", \"travel tips\", \"holidays\"]',1,'2026-09-05 21:05:06',NULL,NULL,NULL,5,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,'planning-a-memorable-maldives-honeymoon','Planning a Memorable Maldives Honeymoon','Practical advice from planning and budgeting to experiences, timing and local travel.','<p>A successful holiday starts with realistic pacing, clear inclusions and time for spontaneous discoveries. This guide explains the choices that matter most.</p><h2>Plan with confidence</h2><p>Confirm travel dates, expected weather, entry requirements and cancellation terms before making non-refundable commitments.</p>',5,'assets/frontend/images/demo/destination-maldives.webp','Honeymoon','[\"planning\", \"travel tips\", \"holidays\"]',1,'2026-09-05 21:05:06',NULL,NULL,NULL,5,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(3,'a-practical-dubai-family-holiday-guide','A Practical Dubai Family Holiday Guide','Practical advice from planning and budgeting to experiences, timing and local travel.','<p>A successful holiday starts with realistic pacing, clear inclusions and time for spontaneous discoveries. This guide explains the choices that matter most.</p><h2>Plan with confidence</h2><p>Confirm travel dates, expected weather, entry requirements and cancellation terms before making non-refundable commitments.</p>',5,'assets/frontend/images/demo/destination-dubai.webp','Family Travel','[\"planning\", \"travel tips\", \"holidays\"]',1,'2026-09-05 21:05:06',NULL,NULL,NULL,5,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation_histories`
--

DROP TABLE IF EXISTS `quotation_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quotation_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quotation_id` bigint unsigned DEFAULT NULL,
  `changed_by` bigint unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_total` decimal(12,2) DEFAULT NULL,
  `new_total` decimal(12,2) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotation_histories_quotation_id_index` (`quotation_id`),
  KEY `quotation_histories_changed_by_index` (`changed_by`),
  KEY `quotation_histories_event_index` (`event`),
  KEY `quotation_histories_created_at_index` (`created_at`),
  CONSTRAINT `quotation_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `quotation_histories_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_histories`
--

LOCK TABLES `quotation_histories` WRITE;
/*!40000 ALTER TABLE `quotation_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotation_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation_items`
--

DROP TABLE IF EXISTS `quotation_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quotation_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quotation_id` bigint unsigned NOT NULL,
  `section_id` bigint unsigned DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `nights` tinyint unsigned DEFAULT NULL,
  `unit_cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(10,2) NOT NULL DEFAULT '1.00',
  `total_cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_included_in_total` tinyint(1) NOT NULL DEFAULT '1',
  `is_optional` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotation_items_quotation_id_index` (`quotation_id`),
  KEY `quotation_items_section_id_index` (`section_id`),
  KEY `quotation_items_type_index` (`type`),
  KEY `quotation_items_sort_order_index` (`sort_order`),
  KEY `quotation_items_is_included_in_total_index` (`is_included_in_total`),
  KEY `quotation_items_is_optional_index` (`is_optional`),
  CONSTRAINT `quotation_items_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quotation_items_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `quotation_sections` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_items`
--

LOCK TABLES `quotation_items` WRITE;
/*!40000 ALTER TABLE `quotation_items` DISABLE KEYS */;
INSERT INTO `quotation_items` VALUES (1,1,1,1,'package','Kashmir Valley Retreat','Accommodation, transfers and sightseeing as detailed in the itinerary.',5,87250.00,1.00,87250.00,1,0,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04'),(2,2,2,1,'package','Dubai Signature Experience','Accommodation, transfers and sightseeing as detailed in the itinerary.',4,224700.00,1.00,224700.00,1,0,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04'),(3,3,3,1,'package','Maldives Overwater Luxury','Accommodation, transfers and sightseeing as detailed in the itinerary.',4,309800.00,1.00,309800.00,1,0,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04'),(4,4,4,1,'package','Romantic Bali Hideaway','Accommodation, transfers and sightseeing as detailed in the itinerary.',5,165800.00,1.00,165800.00,1,0,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04'),(5,5,5,1,'package','Royal Rajasthan Circuit','Accommodation, transfers and sightseeing as detailed in the itinerary.',7,97800.00,1.00,97800.00,1,0,NULL,'2026-09-15 16:56:05','2026-09-15 16:56:05');
/*!40000 ALTER TABLE `quotation_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation_logs`
--

DROP TABLE IF EXISTS `quotation_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quotation_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotation_logs_record_id_index` (`record_id`),
  KEY `quotation_logs_user_id_index` (`user_id`),
  KEY `quotation_logs_action_index` (`action`),
  KEY `quotation_logs_created_at_index` (`created_at`),
  CONSTRAINT `quotation_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_logs`
--

LOCK TABLES `quotation_logs` WRITE;
/*!40000 ALTER TABLE `quotation_logs` DISABLE KEYS */;
INSERT INTO `quotation_logs` VALUES (1,1,NULL,'created','Quotation created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(2,2,NULL,'created','Quotation created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(3,3,NULL,'created','Quotation created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(4,4,NULL,'created','Quotation created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(5,5,NULL,'created','Quotation created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(6,1,NULL,'updated','Updated: travel_date, return_date, validity_date, sent_at, viewed_at, accepted_at','{\"sent_at\": \"2026-09-13T22:26:04.000000Z\", \"viewed_at\": \"2026-09-14T22:26:04.000000Z\", \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"accepted_at\": \"2026-09-14T22:26:04.000000Z\", \"return_date\": \"2026-10-25T00:00:00.000000Z\", \"travel_date\": \"2026-10-20T00:00:00.000000Z\", \"validity_date\": \"2026-09-22T00:00:00.000000Z\"}','{\"sent_at\": \"2026-09-14 02:35:06\", \"viewed_at\": \"2026-09-15 02:35:06\", \"accepted_at\": \"2026-09-15 02:35:06\", \"return_date\": \"2026-10-26 00:00:00\", \"travel_date\": \"2026-10-21 00:00:00\", \"validity_date\": \"2026-09-23 02:35:06\"}','127.0.0.1','2026-09-15 21:05:06'),(7,2,NULL,'updated','Updated: travel_date, return_date, validity_date, sent_at, viewed_at, accepted_at','{\"sent_at\": \"2026-09-13T22:26:04.000000Z\", \"viewed_at\": \"2026-09-14T22:26:04.000000Z\", \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"accepted_at\": \"2026-09-14T22:26:04.000000Z\", \"return_date\": \"2026-11-05T00:00:00.000000Z\", \"travel_date\": \"2026-11-01T00:00:00.000000Z\", \"validity_date\": \"2026-09-22T00:00:00.000000Z\"}','{\"sent_at\": \"2026-09-14 02:35:07\", \"viewed_at\": \"2026-09-15 02:35:07\", \"accepted_at\": \"2026-09-15 02:35:07\", \"return_date\": \"2026-11-06 00:00:00\", \"travel_date\": \"2026-11-02 00:00:00\", \"validity_date\": \"2026-09-23 02:35:07\"}','127.0.0.1','2026-09-15 21:05:07'),(8,3,NULL,'updated','Updated: travel_date, return_date, validity_date, sent_at, viewed_at, accepted_at','{\"sent_at\": \"2026-09-13T22:26:04.000000Z\", \"viewed_at\": \"2026-09-14T22:26:04.000000Z\", \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"accepted_at\": \"2026-09-14T22:26:04.000000Z\", \"return_date\": \"2026-11-17T00:00:00.000000Z\", \"travel_date\": \"2026-11-13T00:00:00.000000Z\", \"validity_date\": \"2026-09-22T00:00:00.000000Z\"}','{\"sent_at\": \"2026-09-14 02:35:07\", \"viewed_at\": \"2026-09-15 02:35:07\", \"accepted_at\": \"2026-09-15 02:35:07\", \"return_date\": \"2026-11-18 00:00:00\", \"travel_date\": \"2026-11-14 00:00:00\", \"validity_date\": \"2026-09-23 02:35:07\"}','127.0.0.1','2026-09-15 21:05:07'),(9,4,NULL,'updated','Updated: travel_date, return_date, validity_date, sent_at','{\"sent_at\": \"2026-09-13T22:26:04.000000Z\", \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"return_date\": \"2026-11-30T00:00:00.000000Z\", \"travel_date\": \"2026-11-25T00:00:00.000000Z\", \"validity_date\": \"2026-09-22T00:00:00.000000Z\"}','{\"sent_at\": \"2026-09-14 02:35:07\", \"return_date\": \"2026-12-01 00:00:00\", \"travel_date\": \"2026-11-26 00:00:00\", \"validity_date\": \"2026-09-23 02:35:07\"}','127.0.0.1','2026-09-15 21:05:07'),(10,5,NULL,'updated','Updated: travel_date, return_date, validity_date','{\"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"return_date\": \"2026-12-14T00:00:00.000000Z\", \"travel_date\": \"2026-12-07T00:00:00.000000Z\", \"validity_date\": \"2026-09-25T00:00:00.000000Z\"}','{\"return_date\": \"2026-12-15 00:00:00\", \"travel_date\": \"2026-12-08 00:00:00\", \"validity_date\": \"2026-09-26 02:35:07\"}','127.0.0.1','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `quotation_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation_sections`
--

DROP TABLE IF EXISTS `quotation_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quotation_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quotation_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotation_sections_quotation_id_index` (`quotation_id`),
  KEY `quotation_sections_sort_order_index` (`sort_order`),
  CONSTRAINT `quotation_sections_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_sections`
--

LOCK TABLES `quotation_sections` WRITE;
/*!40000 ALTER TABLE `quotation_sections` DISABLE KEYS */;
INSERT INTO `quotation_sections` VALUES (1,1,'Package Summary','Core services included in the proposed holiday.',1,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04'),(2,2,'Package Summary','Core services included in the proposed holiday.',1,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04'),(3,3,'Package Summary','Core services included in the proposed holiday.',1,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04'),(4,4,'Package Summary','Core services included in the proposed holiday.',1,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04'),(5,5,'Package Summary','Core services included in the proposed holiday.',1,NULL,'2026-09-15 16:56:04','2026-09-15 16:56:04');
/*!40000 ALTER TABLE `quotation_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotations`
--

DROP TABLE IF EXISTS `quotations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quotations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `public_id` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enquiry_id` bigint unsigned DEFAULT NULL,
  `version` smallint unsigned NOT NULL DEFAULT '1',
  `parent_quotation_id` bigint unsigned DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travel_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `adults` tinyint unsigned NOT NULL DEFAULT '1',
  `children` tinyint unsigned NOT NULL DEFAULT '0',
  `infants` tinyint unsigned NOT NULL DEFAULT '0',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `subtotal_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `validity_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `personalised_message` text COLLATE utf8mb4_unicode_ci,
  `internal_notes` text COLLATE utf8mb4_unicode_ci,
  `terms_and_conditions` text COLLATE utf8mb4_unicode_ci,
  `prepared_by` bigint unsigned DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL,
  `view_count` int unsigned NOT NULL DEFAULT '0',
  `accepted_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quotations_public_id_unique` (`public_id`),
  UNIQUE KEY `quotations_access_token_unique` (`access_token`),
  KEY `quotations_enquiry_id_index` (`enquiry_id`),
  KEY `quotations_parent_quotation_id_index` (`parent_quotation_id`),
  KEY `quotations_prepared_by_index` (`prepared_by`),
  KEY `quotations_status_index` (`status`),
  KEY `quotations_travel_date_index` (`travel_date`),
  KEY `quotations_validity_date_index` (`validity_date`),
  KEY `quotations_created_at_index` (`created_at`),
  CONSTRAINT `quotations_enquiry_id_foreign` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `quotations_parent_quotation_id_foreign` FOREIGN KEY (`parent_quotation_id`) REFERENCES `quotations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `quotations_prepared_by_foreign` FOREIGN KEY (`prepared_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotations`
--

LOCK TABLES `quotations` WRITE;
/*!40000 ALTER TABLE `quotations` DISABLE KEYS */;
INSERT INTO `quotations` VALUES (1,'XWYL8MOBBNMJ','BAbviS2Pd0VvYulgJqxltvkDoF958lDxdguLrTDLEwpVUCcIUt2lJlsbpWWxfWrc',1,1,NULL,'Arjun & Nisha Mehta','arjun.mehta@demo.test','+91 98250 11001','Kashmir Valley Retreat','2026-10-21','2026-10-26',2,0,0,'INR',87250.00,0.00,0.00,87250.00,'2026-09-23','accepted','Dear Arjun & Nisha Mehta, we have designed this journey around your preferences.',NULL,'A 30% deposit confirms the booking. Final payment is due before departure. Supplier cancellation terms apply.',3,'2026-09-13 21:05:06','2026-09-14 21:05:06',2,'2026-09-14 21:05:06',NULL,NULL,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,'BSKZ17IZ3DUZ','4hglE45LpVCvB53hLbeQLXylQRl6ablv48ZiHKTpbZJBlKWiN8MUuyO8Xt7ZYq1W',2,1,NULL,'The Shah Family','shah.family@demo.test','+91 98250 11002','Dubai Signature Experience','2026-11-02','2026-11-06',2,1,0,'INR',224700.00,0.00,0.00,224700.00,'2026-09-23','accepted','Dear The Shah Family, we have designed this journey around your preferences.',NULL,'A 30% deposit confirms the booking. Final payment is due before departure. Supplier cancellation terms apply.',3,'2026-09-13 21:05:07','2026-09-14 21:05:07',2,'2026-09-14 21:05:07',NULL,NULL,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(3,'E9LAUGIQYWWO','hyK4VhW01PgLM73MMtaApHwIPjCiXlnNB0sETZaHcux0UlpMjg7FoT2JdtUXmAai',3,1,NULL,'Riya and Dev Patel','riya.patel@demo.test','+91 98250 11003','Maldives Overwater Luxury','2026-11-14','2026-11-18',2,0,0,'INR',309800.00,0.00,0.00,309800.00,'2026-09-23','accepted','Dear Riya and Dev Patel, we have designed this journey around your preferences.',NULL,'A 30% deposit confirms the booking. Final payment is due before departure. Supplier cancellation terms apply.',3,'2026-09-13 21:05:07','2026-09-14 21:05:07',2,'2026-09-14 21:05:07',NULL,NULL,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(4,'JFQOYCI7PO71','Cku1gc51EhNcjGYg0ZcuUVgr0qYNRvegd6CLzR7VhFELQCQ05EEHlTe1V4owofJ2',4,1,NULL,'Ananya Rao','ananya.rao@demo.test','+91 98250 11004','Romantic Bali Hideaway','2026-11-26','2026-12-01',2,0,0,'INR',165800.00,0.00,0.00,165800.00,'2026-09-23','sent','Dear Ananya Rao, we have designed this journey around your preferences.',NULL,'A 30% deposit confirms the booking. Final payment is due before departure. Supplier cancellation terms apply.',3,'2026-09-13 21:05:07',NULL,0,NULL,NULL,NULL,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(5,'KBMJ2GCDOSRD','xwrDbCh3QSJ8v5aEFvELyD6EKix1EHpSnbDrmqVyVo6bSffaiJxkMhl3beETxpBf',5,1,NULL,'Kunal Joshi','kunal.joshi@demo.test','+91 98250 11005','Royal Rajasthan Circuit','2026-12-08','2026-12-15',2,0,0,'INR',97800.00,0.00,0.00,97800.00,'2026-09-26','draft','Dear Kunal Joshi, we have designed this journey around your preferences.',NULL,'A 30% deposit confirms the booking. Final payment is due before departure. Supplier cancellation terms apply.',3,NULL,NULL,0,NULL,NULL,NULL,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `quotations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1),(95,1),(96,1),(97,1),(98,1),(99,1),(100,1),(101,1),(102,1),(20,2),(21,2),(22,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(34,2),(35,2),(36,2),(40,2),(46,2),(47,2),(48,2),(54,2),(60,2),(29,3),(35,3),(46,3),(47,3),(48,3),(51,3),(52,3),(53,3),(54,3),(55,3),(56,3),(60,3),(61,3),(62,3),(1,4),(2,4),(3,4),(4,4),(5,4),(7,4),(8,4),(9,4),(10,4),(11,4),(13,4),(14,4),(15,4),(16,4),(17,4),(18,4),(19,4),(65,4),(66,4),(67,4),(68,4),(69,4),(70,4),(71,4),(72,4),(73,4),(74,4),(75,4),(76,4),(77,4),(78,4),(79,4),(80,4),(81,4),(82,4),(83,4),(84,4),(85,4),(86,4),(87,4),(88,4),(89,4),(90,4),(91,4);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(2,'sales','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(3,'operations','web','2026-09-15 16:56:02','2026-09-15 16:56:02'),(4,'content','web','2026-09-15 16:56:02','2026-09-15 16:56:02');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('4WnSfbVWYmDhQVdXzcUKl1aKjiq5EUZ1NneNjTrx',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJBYkpTVXphb05VdHJxdnZkYTdZODdDS0NyTkVGVW5uNGN6Q3pRZ0FMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2RvbWVzdGljLXBhY2thZ2VzIiwicm91dGUiOiJmcm9udGVuZC5kb21lc3RpYyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789830902),('5RbWmKRmbyMFJz5dG1zqeGxIT2CRs2lQgpaxItYN',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJCRGw4clhjZDRHaUp4ZjdhQjZPOVQzTUU2dVBFWmY3VTFoZG54TnhQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3QiLCJyb3V0ZSI6ImZyb250ZW5kLmhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789831850),('AeJx9MAueRlJvXaUrmQYhIhii7m3rUlBoECJAikz',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJBRVNxN1pCWjk1SEk0djBMdDBMaDFLTzhCcW5TdGlIRW1IU21sckllIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL3NlcnZpY2VzXC9mbGlnaHRzIiwicm91dGUiOiJmcm9udGVuZC5zZXJ2aWNlLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MiwidGFibGVzIjp7ImFhZDAxZWI3NzBmOTY4OGExMDIzNzgyMGZlOGI0MTlkX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzb3VyY2UiLCJsYWJlbCI6IlNvdXJjZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGF0dXMiLCJsYWJlbCI6IlN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJSZWNlaXZlZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiNmNhZjBhZWZiMTBkZDkxNmM3MWE5M2E2NjEzY2FlYWVfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0eXBlIiwibGFiZWwiOiJUeXBlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRpdGxlIiwibGFiZWwiOiJUaXRsZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJmaXJzdF9uYW1lIiwibGFiZWwiOiJOYW1lIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImRhdGVfb2ZfYmlydGgiLCJsYWJlbCI6IkRPQiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwYXNzcG9ydF9udW1iZXIiLCJsYWJlbCI6IlBhc3Nwb3J0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InBhc3Nwb3J0X2V4cGlyeSIsImxhYmVsIjoiUGFzc3BvcnQgRXhwLiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYXRpb25hbGl0eSIsImxhYmVsIjoiTmF0aW9uYWxpdHkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfV0sImJlYzgwMjAzZWQ1MmFmNTI5ZTlkNjliNGI3ODMxYzgxX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGF5bWVudF9kYXRlIiwibGFiZWwiOiJQYXltZW50IGRhdGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiYW1vdW50IiwibGFiZWwiOiJBbW91bnQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibWV0aG9kIiwibGFiZWwiOiJNZXRob2QiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicmVmZXJlbmNlX251bWJlciIsImxhYmVsIjoiUmVmZXJlbmNlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InN0YXR1cyIsImxhYmVsIjoiU3RhdHVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InJlY29yZGVkQnkubmFtZSIsImxhYmVsIjoiUmVjb3JkZWQgQnkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfV0sIjZjNjUwNTM3MTc5MjY4ODc2MjgyMmI4ZDE2NGU0MWRlX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaGVyb19pbWFnZSIsImxhYmVsIjoiSGVybyBpbWFnZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1lIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNvdW50cnkiLCJsYWJlbCI6IkNvdW50cnkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY29udGluZW50IiwibGFiZWwiOiJDb250aW5lbnQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfZmVhdHVyZWQiLCJsYWJlbCI6IklzIGZlYXR1cmVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpmYWxzZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2FjdGl2ZSIsImxhYmVsIjoiQWN0aXZlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InNvcnRfb3JkZXIiLCJsYWJlbCI6IlNvcnQgb3JkZXIiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOmZhbHNlfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiQ3JlYXRlZCBhdCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9XSwiMzZjMDFjY2UyMThlZGFiZTY3M2FhMDUyZTk2MDY0M2VfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJoZXJvX2ltYWdlIiwibGFiZWwiOiIiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidGl0bGUiLCJsYWJlbCI6IlRpdGxlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNhdGVnb3J5IiwibGFiZWwiOiJDYXRlZ29yeSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6ZmFsc2V9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJkdXJhdGlvbl9kYXlzIiwibGFiZWwiOiJEdXJhdGlvbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGFydGluZ19wcmljZSIsImxhYmVsIjoiUHJpY2UiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfZmVhdHVyZWQiLCJsYWJlbCI6IkZlYXR1cmVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpmYWxzZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2FjdGl2ZSIsImxhYmVsIjoiQWN0aXZlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InB1Ymxpc2hlZF9hdCIsImxhYmVsIjoiUHVibGlzaGVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpmYWxzZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IkNyZWF0ZWQgYXQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfV0sIjUyYTlhZjlkYzU3MWY1MWVhNmI5NWY0MjIzZjk1N2JkX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJkZXN0aW5hdGlvbi5uYW1lIiwibGFiZWwiOiJEZXN0aW5hdGlvbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6ZmFsc2V9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0b3VyLnRpdGxlIiwibGFiZWwiOiJUb3VyIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOmZhbHNlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6dHJ1ZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRyYXZlbF9kYXRlIiwibGFiZWwiOiJUcmF2ZWwgZGF0ZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJidWRnZXRfcmFuZ2UiLCJsYWJlbCI6IkJ1ZGdldCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6ZmFsc2V9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJhZHVsdHMiLCJsYWJlbCI6IlBheCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6ZmFsc2V9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGF0dXMiLCJsYWJlbCI6IlN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzb3VyY2UiLCJsYWJlbCI6IlNvdXJjZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJhc3NpZ25lZFRvLm5hbWUiLCJsYWJlbCI6IkFzc2lnbmVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpmYWxzZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImZvbGxvd191cF9hdCIsImxhYmVsIjoiRm9sbG93LXVwIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IlJlY2VpdmVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCI5ODQ5OTI5NzVjODhlMTg1YmRiY2JiMmJmNjQzY2FiY19jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InR5cGUiLCJsYWJlbCI6IlR5cGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic3RhdHVzIiwibGFiZWwiOiJTdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibm90ZXMiLCJsYWJlbCI6Ik5vdGVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InNjaGVkdWxlZF9hdCIsImxhYmVsIjoiV2hlbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkQnkubmFtZSIsImxhYmVsIjoiQnkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmV4dF9mb2xsb3dfdXBfYXQiLCJsYWJlbCI6Ik5leHQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfV0sImZjYzZiYmI1ZGJkMzNjNTJjOTdiNDFkNTQ2NTM3MTZkX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicHVibGljX2lkIiwibGFiZWwiOiJJRCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjbGllbnRfbmFtZSIsImxhYmVsIjoiQ2xpZW50IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRpdGxlIiwibGFiZWwiOiJUaXRsZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0cmF2ZWxfZGF0ZSIsImxhYmVsIjoiVHJhdmVsIGRhdGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidG90YWxfYW1vdW50IiwibGFiZWwiOiJUb3RhbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdGF0dXMiLCJsYWJlbCI6IlN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ2ZXJzaW9uIiwibGFiZWwiOiJ2IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOmZhbHNlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6dHJ1ZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InByZXBhcmVkQnkubmFtZSIsImxhYmVsIjoiUHJlcGFyZWQgQnkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidmFsaWRpdHlfZGF0ZSIsImxhYmVsIjoiRXhwaXJlcyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6ZmFsc2V9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ2aWV3X2NvdW50IiwibGFiZWwiOiJWaWV3cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJDcmVhdGVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCJiOTBmNmM4MTM1MmZkZTE4ZTk2ZDBhYzQ4NWJkMjk4Nl9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InR5cGUiLCJsYWJlbCI6IlR5cGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidGl0bGUiLCJsYWJlbCI6IlRpdGxlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InVuaXRfY29zdCIsImxhYmVsIjoiVW5pdCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJxdWFudGl0eSIsImxhYmVsIjoiUXR5IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRvdGFsX2Nvc3QiLCJsYWJlbCI6IlRvdGFsIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2luY2x1ZGVkX2luX3RvdGFsIiwibGFiZWwiOiJJbmNsLiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpc19vcHRpb25hbCIsImxhYmVsIjoiT3B0LiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9XSwiODE1YTI2YjZmNmJlMTJiMTcwNWY1M2Q5NmIwNGNkODNfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJlbnF1aXJ5Lm5hbWUiLCJsYWJlbCI6IkNsaWVudCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJlbnF1aXJ5LmRlc3RpbmF0aW9uLm5hbWUiLCJsYWJlbCI6IkRlc3RpbmF0aW9uIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InR5cGUiLCJsYWJlbCI6IlR5cGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic3RhdHVzIiwibGFiZWwiOiJTdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic2NoZWR1bGVkX2F0IiwibGFiZWwiOiJTY2hlZHVsZWQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmV4dF9mb2xsb3dfdXBfYXQiLCJsYWJlbCI6Ik5leHQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibm90ZXMiLCJsYWJlbCI6Ik5vdGVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOmZhbHNlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6dHJ1ZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRCeS5uYW1lIiwibGFiZWwiOiJCeSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9XSwiMzUzMzZhODA4Nzc4ODM0Zjg5NDE3NDcxMTJjMjY0M2VfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJSb2xlIE5hbWUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGVybWlzc2lvbnNfY291bnQiLCJsYWJlbCI6IlBlcm1pc3Npb25zIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InVzZXJzX2NvdW50IiwibGFiZWwiOiJVc2VycyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJDcmVhdGVkIGF0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOmZhbHNlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6dHJ1ZX1dLCI5ZjZlNzIzMjEzNjdlNWNiMzNlODk0MzRkNWZkOGYwY19jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImltYWdlIiwibGFiZWwiOiJJbWFnZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0aXRsZSIsImxhYmVsIjoiVGl0bGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicG9zaXRpb24iLCJsYWJlbCI6IlBvc2l0aW9uIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2FjdGl2ZSIsImxhYmVsIjoiSXMgYWN0aXZlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InN0YXJ0c19hdCIsImxhYmVsIjoiU3RhcnRzIGF0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImVuZHNfYXQiLCJsYWJlbCI6IkVuZHMgYXQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic29ydF9vcmRlciIsImxhYmVsIjoiU29ydCBvcmRlciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiM2RmZmQzM2U4NGViNGNkMjEwYWFhYTU0MzAyY2Q1Y2VfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0aXRsZSIsImxhYmVsIjoiVGl0bGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic2x1ZyIsImxhYmVsIjoiU2x1ZyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpc19wdWJsaXNoZWQiLCJsYWJlbCI6IlB1Ymxpc2hlZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ1cGRhdGVkX2F0IiwibGFiZWwiOiJMYXN0IFVwZGF0ZWQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfV0sImRiYjA5YzRkNDQ5MDYzMzNlMGNjNWQ2MjgyNzJlMzgwX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibGFiZWwiLCJsYWJlbCI6IkxhYmVsIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InByaWNlX3Blcl9wZXJzb24iLCJsYWJlbCI6IlByaWNlIHBlciBwZXJzb24iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY2hpbGRfcHJpY2UiLCJsYWJlbCI6IkNoaWxkIHByaWNlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImluZmFudF9wcmljZSIsImxhYmVsIjoiSW5mYW50IHByaWNlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InZhbGlkX2Zyb20iLCJsYWJlbCI6IlZhbGlkIGZyb20iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidmFsaWRfdW50aWwiLCJsYWJlbCI6IlZhbGlkIHVudGlsIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2FjdGl2ZSIsImxhYmVsIjoiSXMgYWN0aXZlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCIyODZiZDQwNTRkNzIwYjkyMjkwMjkzZTUxYTIyNjhjZl9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImJvb2tpbmdfcmVmIiwibGFiZWwiOiJSZWYiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY2xpZW50X25hbWUiLCJsYWJlbCI6IkNsaWVudCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0b3VyLnRpdGxlIiwibGFiZWwiOiJUb3VyIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpmYWxzZX0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRyYXZlbF9kYXRlIiwibGFiZWwiOiJUcmF2ZWwgZGF0ZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJhZHVsdHMiLCJsYWJlbCI6IlBheCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0b3RhbF9hbW91bnQiLCJsYWJlbCI6IlRvdGFsIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImJhbGFuY2VfYW1vdW50IiwibGFiZWwiOiJCYWxhbmNlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InN0YXR1cyIsImxhYmVsIjoiU3RhdHVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImFzc2lnbmVkVG8ubmFtZSIsImxhYmVsIjoiQXNzaWduZWQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiQ3JlYXRlZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9XSwiYTYwN2NkYTczY2JkZTQ0NmY4YmI2NGNjZDc1NjA2ZWVfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJmZWF0dXJlZF9pbWFnZSIsImxhYmVsIjoiRmVhdHVyZWQgaW1hZ2UiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidGl0bGUiLCJsYWJlbCI6IlRpdGxlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNhdGVnb3J5IiwibGFiZWwiOiJDYXRlZ29yeSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJhdXRob3IubmFtZSIsImxhYmVsIjoiQXV0aG9yIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX3B1Ymxpc2hlZCIsImxhYmVsIjoiUHVibGlzaGVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InB1Ymxpc2hlZF9hdCIsImxhYmVsIjoiUHVibGlzaGVkIGF0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IkNyZWF0ZWQgYXQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfV0sIjZjNDQ0MzI0MmNhMjcxM2M0N2ExZmNiMDAwNjJiNWQzX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiYXZhdGFyIiwibGFiZWwiOiIiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJyYXRpbmciLCJsYWJlbCI6IlJhdGluZyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjb250ZW50IiwibGFiZWwiOiJDb250ZW50IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRvdXIudGl0bGUiLCJsYWJlbCI6IlRvdXIiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfZmVhdHVyZWQiLCJsYWJlbCI6IkZlYXR1cmVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2FjdGl2ZSIsImxhYmVsIjoiQWN0aXZlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dfX0=',1789833122),('Ak5pDHxlECnUzI2gBDSWVuAkFJOTYxY2wyUPgVP9',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJPRzZiVTZXbnRjNXA5TndQb3pRTXFycjRpZ3hEclo1eFNOeUNESWYzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2ludGVybmF0aW9uYWwtcGFja2FnZXMiLCJyb3V0ZSI6ImZyb250ZW5kLmludGVybmF0aW9uYWwifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830901),('BfbtCJ5CHQMSgJ2qzqDuesBhk4hJO37VGNHx3iHl',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJOMEwzUHhWSFJJUDh5UktubVVXYlgycndLZVh6VGZKQlZVVlZVZzc4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL3BhY2thZ2VzXC9kb21lc3RpYyIsInJvdXRlIjoiZnJvbnRlbmQudG91ci5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1789830877),('bHgbSv8YvYX1rIBM7gbXeAiuOB8v6UtHK0wQMZeK',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiI1dENYa202cTMwRUdFa1BIS3lvSEZKQlUwdktwZG5GMjFWRGhRaEJBIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvYm9iYnktaG9saWRheXMudGVzdFwvYWRtaW5cL2Rlc3RpbmF0aW9ucyJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvYm9iYnktaG9saWRheXMudGVzdFwvYWRtaW5cL2Rlc3RpbmF0aW9ucyIsInJvdXRlIjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLmRlc3RpbmF0aW9ucy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789831851),('bvEvUKO0rM4gbYf7wZUwiKJaFxfVqSRdn83ztNdQ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJDcmNaaGY3dXlMMENtYkpuanBZNnV4UGdFRXBmY3RTbVNyTGVMbFFuIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2RvbWVzdGljLXBhY2thZ2VzIiwicm91dGUiOiJmcm9udGVuZC5kb21lc3RpYyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789830930),('eTdr7aUgealAeFJ5WBDYHG9ADqEDO6ZkOcQ7j6Bk',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiI3NDZTZko1YURaYnJzZzlBUHpVOW1VeXQzM2x3TG8wbGp4WFZVczZ2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2ludGVybmF0aW9uYWwtcGFja2FnZXMiLCJyb3V0ZSI6ImZyb250ZW5kLmludGVybmF0aW9uYWwifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830902),('fHeTaFb7UmiZ0LEo9fm1dKnQk1fhWPkb4IjslnZj',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiI4aTh0SVJzUVFWZDZqV1FKOE4yZ2FFalZDVDk2Sm9kR3dIMENJWG9qIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3QiLCJyb3V0ZSI6ImZyb250ZW5kLmhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789831877),('fkI9mMD8vBVvzDPmAep4Ec03ENiZC55Q2mBYyBhk',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJrSjRmUm5FaW1pbkZURFFobEliVVZsdFcxcmpBcGtxcVk5MEtEN1BzIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvYm9iYnktaG9saWRheXMudGVzdFwvYWRtaW5cL2Rlc3RpbmF0aW9ucyJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvYm9iYnktaG9saWRheXMudGVzdFwvYWRtaW5cL2xvZ2luIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5hdXRoLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1789827170),('gM9dAyY1j08lmwTTXwVVDJRn7OQM3ahekc6zrR3P',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiI5a1ZJcTNza3pKQlRZMDhETk9aTm95QUNkUE1ubXZFSWtZRm1ORFJ2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3QiLCJyb3V0ZSI6ImZyb250ZW5kLmhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789829959),('JmqYulOuUJhvPgypE0hv5rxiy25eoIMo0uwbhMJC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJxN0FjQUdWbHMyVG9CM1QyUUNGdXZHY3VSc01WcnBvaFdrT0FRd01hIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2dhbGxlcnkiLCJyb3V0ZSI6ImZyb250ZW5kLmdhbGxlcnkifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830879),('kVGgTsBObkrVa9g2DILcndKTwpNQLiCKXqZKPNb8',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJqMnZrSnFxcVZKWERORG4yMVZDR2dudUV4bnpHdGZSa205cW5QRnhFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3QiLCJyb3V0ZSI6ImZyb250ZW5kLmhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830900),('Ky9Jo0zDg9wiM5WKkNr5uSPM1a9ShdyaM1CMQu1l',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJPY3hDcWQyblFxR3hHbWRPTHpTaDBwMWpnM0M2YnBqSzd4YnJLZHZIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2dhbGxlcnkiLCJyb3V0ZSI6ImZyb250ZW5kLmdhbGxlcnkifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830878),('N7m94RWiIPF0IiSx2SxnIxWL1hQ92JfpCL92htLf',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJQRWhKZ2xoOUhtcmQxRXhDNm9nYjBGaGJFZnd4NlQ3ZllJYzIwV2xNIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvYm9iYnktaG9saWRheXMudGVzdFwvYWRtaW5cL2Rlc3RpbmF0aW9ucyJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvYm9iYnktaG9saWRheXMudGVzdFwvYWRtaW5cL2Rlc3RpbmF0aW9ucyIsInJvdXRlIjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLmRlc3RpbmF0aW9ucy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789831866),('nlUIksSCDbdy9GaUno81IPYyp9OVFX1LwWsepAit',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiIySVVKYzhOR0tuS3JZQmliTU5KWW5pMFMxa0RQT1pvMmFkR3lMOHpQIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvYm9iYnktaG9saWRheXMudGVzdFwvYWRtaW5cL2Rlc3RpbmF0aW9ucyJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvYm9iYnktaG9saWRheXMudGVzdFwvYWRtaW5cL2Rlc3RpbmF0aW9ucyIsInJvdXRlIjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLmRlc3RpbmF0aW9ucy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789831877),('nT8yBF3SrSgvtJsxbYjlkPdVZBnVURehOFxoVIMN',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJWNkQwTDc3Sjlmc08yY1JPdm9ZQjlUdG9BcFV4NThDTnQ5VDRlc3RlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL3BhY2thZ2VzXC9kb21lc3RpYyIsInJvdXRlIjoiZnJvbnRlbmQudG91ci5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1789830879),('PBosz4DbHELlnsPqVLTWsxWCxhcZqVnIkqDwvrlm',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJWanozQ0w2c2hXdjlKaTJQaWJKaENkcjV1Qml4a1NsSkVadU5IelhYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3QiLCJyb3V0ZSI6ImZyb250ZW5kLmhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789831865),('PvNL0sE3qQYhMuVhCuLvqGTDH3IKaQWXiL6PwFCs',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJhQmhWZ1I3NmNqOGplOFpPYU56SDFXR2t0TXFaS1hhRTVkZ1FqaGhQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3QiLCJyb3V0ZSI6ImZyb250ZW5kLmhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830877),('t4JLZxcE6iA2NCeiQIvBM5zlOvCWl2slvIxbsvng',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJJYXBVaXRMWm5CS1Z4dDlNZnNSQTNlWGZZV3laanQ0M3FUOUk0ZFZwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL3BhY2thZ2VzXC9pbnRlcm5hdGlvbmFsIiwicm91dGUiOiJmcm9udGVuZC50b3VyLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830878),('x3SZl4HjmDO4PHAuo4jnQzhoxm2EO7uCt0W9B8FV',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJSQ0VkRDRHR2pCQXJMa2F4eGNMRGhVT3lTbngwYjd3OEc0d0FhbjczIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2ludGVybmF0aW9uYWwtcGFja2FnZXMiLCJyb3V0ZSI6ImZyb250ZW5kLmludGVybmF0aW9uYWwifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830931),('xBddDMmjpqzuQKCo61WqDMlDjNzVQDa5dO61grmH',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJxSmNjNHJETThhTmxNNXRVY0ptdWtTVHZudFhUTGxlTEpFTTA1S2dDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2dhbGxlcnkiLCJyb3V0ZSI6ImZyb250ZW5kLmdhbGxlcnkifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830902),('yCJ4369rwqqriVUJujkweJDFnOirivt7aNbnsoa1',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiJ5aHpiaXk3SzBEQThuT3BEeDJMU0NzcFNEN2NHQmVDRUV0S0pMaWw2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL3BhY2thZ2VzXC9pbnRlcm5hdGlvbmFsIiwicm91dGUiOiJmcm9udGVuZC50b3VyLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1789830879),('YY5xeD7T3SgqSO3N2AKRzOi67XEDixve5YtIL8bV',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Microsoft Windows 10.0.26200; en-IN) PowerShell/7.6.5','eyJfdG9rZW4iOiIyZktGMG53b25BOEUxZVQ3a2lyd1hDemg0WFJNb2dmUVFHSExMelk2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2JvYmJ5LWhvbGlkYXlzLnRlc3RcL2RvbWVzdGljLXBhY2thZ2VzIiwicm91dGUiOiJmcm9udGVuZC5kb21lc3RpYyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789830901);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_logs`
--

DROP TABLE IF EXISTS `setting_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `setting_logs_record_id_index` (`record_id`),
  KEY `setting_logs_user_id_index` (`user_id`),
  KEY `setting_logs_action_index` (`action`),
  KEY `setting_logs_created_at_index` (`created_at`),
  CONSTRAINT `setting_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_logs`
--

LOCK TABLES `setting_logs` WRITE;
/*!40000 ALTER TABLE `setting_logs` DISABLE KEYS */;
INSERT INTO `setting_logs` VALUES (1,2,NULL,'updated','Updated: value','{\"value\": \"Journeys worth remembering\", \"updated_at\": \"2026-09-15T22:26:05.000000Z\"}','{\"value\": \"Personalised holidays, thoughtfully planned\"}','127.0.0.1','2026-09-19 08:59:54'),(2,9,NULL,'created','Setting created',NULL,NULL,'127.0.0.1','2026-09-19 08:59:54'),(3,10,NULL,'created','Setting created',NULL,NULL,'127.0.0.1','2026-09-19 08:59:54');
/*!40000 ALTER TABLE `setting_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`),
  KEY `settings_group_index` (`group`),
  KEY `settings_type_index` (`type`),
  KEY `settings_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'company_name','UniWorld Holidays','text','company','Company Name',0,'2026-09-15 16:56:05','2026-09-15 16:56:05'),(2,'company_tagline','Personalised holidays, thoughtfully planned','text','company','Company Tagline',0,'2026-09-15 16:56:05','2026-09-19 08:59:54'),(3,'company_phone','+91 98765 43210','text','company','Company Phone',0,'2026-09-15 16:56:05','2026-09-15 16:56:05'),(4,'company_whatsapp','+91 98765 43210','text','company','Company Whatsapp',0,'2026-09-15 16:56:05','2026-09-15 16:56:05'),(5,'company_email','hello@uniworldholidays.test','text','company','Company Email',0,'2026-09-15 16:56:05','2026-09-15 16:56:05'),(6,'company_city','Ahmedabad','text','company','Company City',0,'2026-09-15 16:56:05','2026-09-15 16:56:05'),(7,'quotation_validity_days','7','text','quotation','Quotation Validity Days',0,'2026-09-15 16:56:05','2026-09-15 16:56:05'),(8,'razorpay_enabled','false','text','razorpay','Razorpay Enabled',0,'2026-09-15 16:56:05','2026-09-15 16:56:05'),(9,'seo_title','Tailor-Made India & International Holidays | UniWorld Holidays','text','seo','Seo Title',0,'2026-09-19 08:59:54','2026-09-19 08:59:54'),(10,'seo_description','Plan personalised holidays across India and selected international destinations with considered itineraries, clear proposals and dependable travel support.','text','seo','Seo Description',0,'2026-09-19 08:59:54','2026-09-19 08:59:54');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint unsigned NOT NULL DEFAULT '5',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_id` bigint unsigned DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonials_tour_id_index` (`tour_id`),
  KEY `testimonials_is_featured_index` (`is_featured`),
  KEY `testimonials_is_active_index` (`is_active`),
  KEY `testimonials_sort_order_index` (`sort_order`),
  CONSTRAINT `testimonials_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Mehta Family','Ahmedabad',NULL,5,'The route worked beautifully for three generations. Transfer timings were clear, the hotels suited our family and the houseboat evening felt genuinely special.',1,1,1,0,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(2,'Riya & Dev','Vadodara',NULL,5,'The resort comparison helped us understand the real differences between meal plans and villa types. We chose confidently and every confirmed detail was delivered.',7,1,1,1,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(3,'Shah Family','Surat',NULL,5,'Our Dubai days were grouped intelligently, so we never felt rushed across the city. The desert experience and family hotel recommendation were exactly right for us.',5,1,1,2,NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_logs`
--

DROP TABLE IF EXISTS `tour_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_logs_record_id_index` (`record_id`),
  KEY `tour_logs_user_id_index` (`user_id`),
  KEY `tour_logs_action_index` (`action`),
  KEY `tour_logs_created_at_index` (`created_at`),
  CONSTRAINT `tour_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_logs`
--

LOCK TABLES `tour_logs` WRITE;
/*!40000 ALTER TABLE `tour_logs` DISABLE KEYS */;
INSERT INTO `tour_logs` VALUES (1,1,NULL,'created','Tour created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(2,2,NULL,'created','Tour created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(3,3,NULL,'created','Tour created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(4,4,NULL,'created','Tour created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(5,5,NULL,'created','Tour created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(6,6,NULL,'created','Tour created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(7,7,NULL,'created','Tour created',NULL,NULL,'127.0.0.1','2026-09-15 16:56:04'),(8,1,NULL,'updated','Updated: itinerary, published_at','{\"itinerary\": [{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and welcome\", \"description\": \"Private transfer and relaxed check-in.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 2\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 3\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 4\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 5\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 6, \"meals\": \"Breakfast\", \"title\": \"Departure\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"\"}], \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\"}','{\"itinerary\": \"[{\\\"day\\\":1,\\\"title\\\":\\\"Arrival and welcome\\\",\\\"description\\\":\\\"Private transfer and relaxed check-in.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":2,\\\"title\\\":\\\"Curated experience day 2\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":3,\\\"title\\\":\\\"Curated experience day 3\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":4,\\\"title\\\":\\\"Curated experience day 4\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":5,\\\"title\\\":\\\"Curated experience day 5\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":6,\\\"title\\\":\\\"Departure\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"\\\"}]\", \"published_at\": \"2026-08-16 02:35:06\"}','127.0.0.1','2026-09-15 21:05:06'),(9,2,NULL,'updated','Updated: itinerary, published_at','{\"itinerary\": [{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and welcome\", \"description\": \"Private transfer and relaxed check-in.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 2\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 3\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Departure\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"\"}], \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\"}','{\"itinerary\": \"[{\\\"day\\\":1,\\\"title\\\":\\\"Arrival and welcome\\\",\\\"description\\\":\\\"Private transfer and relaxed check-in.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":2,\\\"title\\\":\\\"Curated experience day 2\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":3,\\\"title\\\":\\\"Curated experience day 3\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":4,\\\"title\\\":\\\"Departure\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"\\\"}]\", \"published_at\": \"2026-08-16 02:35:06\"}','127.0.0.1','2026-09-15 21:05:06'),(10,3,NULL,'updated','Updated: itinerary, published_at','{\"itinerary\": [{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and welcome\", \"description\": \"Private transfer and relaxed check-in.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 2\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 3\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 4\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 5\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 6, \"meals\": \"Breakfast\", \"title\": \"Departure\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"\"}], \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\"}','{\"itinerary\": \"[{\\\"day\\\":1,\\\"title\\\":\\\"Arrival and welcome\\\",\\\"description\\\":\\\"Private transfer and relaxed check-in.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":2,\\\"title\\\":\\\"Curated experience day 2\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":3,\\\"title\\\":\\\"Curated experience day 3\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":4,\\\"title\\\":\\\"Curated experience day 4\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":5,\\\"title\\\":\\\"Curated experience day 5\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":6,\\\"title\\\":\\\"Departure\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"\\\"}]\", \"published_at\": \"2026-08-16 02:35:06\"}','127.0.0.1','2026-09-15 21:05:06'),(11,4,NULL,'updated','Updated: itinerary, published_at','{\"itinerary\": [{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and welcome\", \"description\": \"Private transfer and relaxed check-in.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 2\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 3\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 4\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 5\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 6, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 6\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 7, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 7\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 8, \"meals\": \"Breakfast\", \"title\": \"Departure\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"\"}], \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\"}','{\"itinerary\": \"[{\\\"day\\\":1,\\\"title\\\":\\\"Arrival and welcome\\\",\\\"description\\\":\\\"Private transfer and relaxed check-in.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":2,\\\"title\\\":\\\"Curated experience day 2\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":3,\\\"title\\\":\\\"Curated experience day 3\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":4,\\\"title\\\":\\\"Curated experience day 4\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":5,\\\"title\\\":\\\"Curated experience day 5\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":6,\\\"title\\\":\\\"Curated experience day 6\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":7,\\\"title\\\":\\\"Curated experience day 7\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":8,\\\"title\\\":\\\"Departure\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"\\\"}]\", \"published_at\": \"2026-08-16 02:35:06\"}','127.0.0.1','2026-09-15 21:05:06'),(12,5,NULL,'updated','Updated: itinerary, published_at','{\"itinerary\": [{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and welcome\", \"description\": \"Private transfer and relaxed check-in.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 2\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 3\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 4\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Departure\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"\"}], \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\"}','{\"itinerary\": \"[{\\\"day\\\":1,\\\"title\\\":\\\"Arrival and welcome\\\",\\\"description\\\":\\\"Private transfer and relaxed check-in.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":2,\\\"title\\\":\\\"Curated experience day 2\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":3,\\\"title\\\":\\\"Curated experience day 3\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":4,\\\"title\\\":\\\"Curated experience day 4\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":5,\\\"title\\\":\\\"Departure\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"\\\"}]\", \"published_at\": \"2026-08-16 02:35:06\"}','127.0.0.1','2026-09-15 21:05:06'),(13,6,NULL,'updated','Updated: itinerary, published_at','{\"itinerary\": [{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and welcome\", \"description\": \"Private transfer and relaxed check-in.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 2\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 3\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 4\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 5\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 6, \"meals\": \"Breakfast\", \"title\": \"Departure\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"\"}], \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\"}','{\"itinerary\": \"[{\\\"day\\\":1,\\\"title\\\":\\\"Arrival and welcome\\\",\\\"description\\\":\\\"Private transfer and relaxed check-in.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":2,\\\"title\\\":\\\"Curated experience day 2\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":3,\\\"title\\\":\\\"Curated experience day 3\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":4,\\\"title\\\":\\\"Curated experience day 4\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":5,\\\"title\\\":\\\"Curated experience day 5\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":6,\\\"title\\\":\\\"Departure\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"\\\"}]\", \"published_at\": \"2026-08-16 02:35:06\"}','127.0.0.1','2026-09-15 21:05:06'),(14,7,NULL,'updated','Updated: itinerary, published_at','{\"itinerary\": [{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and welcome\", \"description\": \"Private transfer and relaxed check-in.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 2\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 3\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Curated experience day 4\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"Handpicked hotel\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Departure\", \"description\": \"Guided highlights with flexible leisure time.\", \"accommodation\": \"\"}], \"updated_at\": \"2026-09-15T22:26:04.000000Z\", \"published_at\": \"2026-08-15T22:26:04.000000Z\"}','{\"itinerary\": \"[{\\\"day\\\":1,\\\"title\\\":\\\"Arrival and welcome\\\",\\\"description\\\":\\\"Private transfer and relaxed check-in.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":2,\\\"title\\\":\\\"Curated experience day 2\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":3,\\\"title\\\":\\\"Curated experience day 3\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":4,\\\"title\\\":\\\"Curated experience day 4\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"Handpicked hotel\\\"},{\\\"day\\\":5,\\\"title\\\":\\\"Departure\\\",\\\"description\\\":\\\"Guided highlights with flexible leisure time.\\\",\\\"meals\\\":\\\"Breakfast\\\",\\\"accommodation\\\":\\\"\\\"}]\", \"published_at\": \"2026-08-16 02:35:06\"}','127.0.0.1','2026-09-15 21:05:06');
/*!40000 ALTER TABLE `tour_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_pricing`
--

DROP TABLE IF EXISTS `tour_pricing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_pricing` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tour_id` bigint unsigned NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_per_person` decimal(12,2) NOT NULL,
  `child_price` decimal(12,2) DEFAULT NULL,
  `infant_price` decimal(12,2) DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `valid_from` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tour_pricing_tour_id_index` (`tour_id`),
  KEY `tour_pricing_is_active_index` (`is_active`),
  KEY `tour_pricing_valid_from_index` (`valid_from`),
  KEY `tour_pricing_valid_until_index` (`valid_until`),
  CONSTRAINT `tour_pricing_tour_id_foreign` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_pricing`
--

LOCK TABLES `tour_pricing` WRITE;
/*!40000 ALTER TABLE `tour_pricing` DISABLE KEYS */;
INSERT INTO `tour_pricing` VALUES (1,1,'Comfort',34900.00,24430.00,0.00,'INR','2026-01-01','2027-12-31',1,0,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,1,'Premium',47115.00,32981.00,0.00,'INR','2026-01-01','2027-12-31',1,1,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(3,2,'Comfort',18900.00,13230.00,0.00,'INR','2026-01-01','2027-12-31',1,0,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(4,2,'Premium',25515.00,17861.00,0.00,'INR','2026-01-01','2027-12-31',1,1,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(5,3,'Comfort',32900.00,23030.00,0.00,'INR','2026-01-01','2027-12-31',1,0,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(6,3,'Premium',44415.00,31090.00,0.00,'INR','2026-01-01','2027-12-31',1,1,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(7,4,'Comfort',48900.00,34230.00,0.00,'INR','2026-01-01','2027-12-31',1,0,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(8,4,'Premium',66015.00,46211.00,0.00,'INR','2026-01-01','2027-12-31',1,1,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(9,5,'Comfort',74900.00,52430.00,0.00,'INR','2026-01-01','2027-12-31',1,0,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(10,5,'Premium',101115.00,70781.00,0.00,'INR','2026-01-01','2027-12-31',1,1,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(11,6,'Comfort',82900.00,58030.00,0.00,'INR','2026-01-01','2027-12-31',1,0,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(12,6,'Premium',111915.00,78341.00,0.00,'INR','2026-01-01','2027-12-31',1,1,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(13,7,'Comfort',154900.00,108430.00,0.00,'INR','2026-01-01','2027-12-31',1,0,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(14,7,'Premium',209115.00,146381.00,0.00,'INR','2026-01-01','2027-12-31',1,1,NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06');
/*!40000 ALTER TABLE `tour_pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tours`
--

DROP TABLE IF EXISTS `tours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tours` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` bigint unsigned DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_days` smallint unsigned NOT NULL DEFAULT '1',
  `duration_nights` smallint unsigned NOT NULL DEFAULT '0',
  `overview` longtext COLLATE utf8mb4_unicode_ci,
  `highlights` json DEFAULT NULL,
  `inclusions` json DEFAULT NULL,
  `exclusions` json DEFAULT NULL,
  `itinerary` json DEFAULT NULL,
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` json DEFAULT NULL,
  `starting_price` decimal(12,2) DEFAULT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'per_person',
  `min_group_size` smallint unsigned NOT NULL DEFAULT '1',
  `max_group_size` smallint unsigned DEFAULT NULL,
  `difficulty_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tours_slug_unique` (`slug`),
  KEY `tours_destination_id_index` (`destination_id`),
  KEY `tours_slug_index` (`slug`),
  KEY `tours_category_index` (`category`),
  KEY `tours_is_featured_index` (`is_featured`),
  KEY `tours_is_active_index` (`is_active`),
  KEY `tours_published_at_index` (`published_at`),
  KEY `tours_sort_order_index` (`sort_order`),
  CONSTRAINT `tours_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tours`
--

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;
INSERT INTO `tours` VALUES (1,1,'kashmir-valley-retreat','Kashmir Valley Retreat','Six days across Srinagar, Gulmarg and Pahalgam with private transfers and a measured family-friendly pace.',6,5,'<p>This private Kashmir journey connects the valley’s essential experiences without turning every day into a long checklist. Begin beside Dal Lake, spend time among Srinagar’s gardens, and take scenic day journeys to Gulmarg and Pahalgam.</p><p>Hotel category, room combinations and seasonal activities can be adapted before confirmation.</p>','[{\"text\": \"Private arrival transfer\"}, {\"text\": \"Daily breakfast\"}, {\"text\": \"Curated sightseeing\"}, {\"text\": \"24/7 trip support\"}]','[{\"text\": \"Accommodation\"}, {\"text\": \"Breakfast\"}, {\"text\": \"Transfers\"}, {\"text\": \"Sightseeing\"}]','[{\"text\": \"Flights unless specified\"}, {\"text\": \"Personal expenses\"}, {\"text\": \"Travel insurance\"}]','[{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrive in Srinagar and settle beside Dal Lake\", \"description\": \"Meet your transfer representative, continue to your stay and review the journey ahead.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Srinagar gardens, old city and shikara experience\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Gulmarg mountain excursion\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Travel to Pahalgam through the valley\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Pahalgam scenery and flexible local exploration\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 6, \"meals\": \"Breakfast\", \"title\": \"Return transfer and departure\", \"description\": \"Check out after breakfast and continue to the airport or your onward arrangement.\", \"accommodation\": \"\"}]','assets/frontend/images/demo/destination-kashmir.webp','[\"assets/frontend/images/demo/destination-kashmir.webp\"]',34900.00,'per_person',2,12,'easy','family',1,1,0,'6-Day Kashmir Valley Holiday Package | UniWorld Holidays','Explore Srinagar, Gulmarg and Pahalgam on a six-day private Kashmir itinerary with curated stays, transfers and flexible seasonal experiences.','assets/frontend/images/demo/destination-kashmir.webp','2026-08-15 21:05:06',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(2,2,'goa-coastal-escape','Goa Coastal Escape','Four relaxed days with a well-located coastal stay, private airport transfers and time to experience Goa your way.',4,3,'<p>A short Goa break should feel spacious, not rushed. This flexible escape combines a carefully chosen beach area with an optional heritage drive, water activities and generous time for restaurants, cafés and the coast.</p>','[{\"text\": \"Private arrival transfer\"}, {\"text\": \"Daily breakfast\"}, {\"text\": \"Curated sightseeing\"}, {\"text\": \"24/7 trip support\"}]','[{\"text\": \"Accommodation\"}, {\"text\": \"Breakfast\"}, {\"text\": \"Transfers\"}, {\"text\": \"Sightseeing\"}]','[{\"text\": \"Flights unless specified\"}, {\"text\": \"Personal expenses\"}, {\"text\": \"Travel insurance\"}]','[{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and private transfer to your coastal stay\", \"description\": \"Meet your transfer representative, continue to your stay and review the journey ahead.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"North or South Goa experience based on your hotel area\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Heritage, water activities or an unhurried leisure day\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Breakfast and airport departure\", \"description\": \"Check out after breakfast and continue to the airport or your onward arrangement.\", \"accommodation\": \"\"}]','assets/frontend/images/demo/destination-goa.webp','[\"assets/frontend/images/demo/destination-goa.webp\"]',18900.00,'per_person',2,12,'easy','leisure',1,1,1,'4-Day Goa Coastal Holiday Package | UniWorld Holidays','Plan a four-day Goa escape with a curated beach hotel, private airport transfers and optional heritage, dining and water-sport experiences.','assets/frontend/images/demo/destination-goa.webp','2026-08-15 21:05:06',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(3,3,'kerala-backwater-journey','Kerala Backwater Journey','A six-day route through Munnar, Thekkady and the backwaters, designed to balance scenery, culture and rest.',6,5,'<p>This Kerala journey moves from the tea-covered hills of Munnar to the spice country around Thekkady and a quiet backwater finale. Private transfers and sensible departure times keep the route comfortable.</p>','[{\"text\": \"Private arrival transfer\"}, {\"text\": \"Daily breakfast\"}, {\"text\": \"Curated sightseeing\"}, {\"text\": \"24/7 trip support\"}]','[{\"text\": \"Accommodation\"}, {\"text\": \"Breakfast\"}, {\"text\": \"Transfers\"}, {\"text\": \"Sightseeing\"}]','[{\"text\": \"Flights unless specified\"}, {\"text\": \"Personal expenses\"}, {\"text\": \"Travel insurance\"}]','[{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival in Kochi and scenic drive to Munnar\", \"description\": \"Meet your transfer representative, continue to your stay and review the journey ahead.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Munnar tea country and viewpoints\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Travel to Thekkady and spice-region experience\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Nature, culture and optional activities in Thekkady\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Backwater stay in Alleppey or Kumarakom\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 6, \"meals\": \"Breakfast\", \"title\": \"Kochi transfer and departure\", \"description\": \"Check out after breakfast and continue to the airport or your onward arrangement.\", \"accommodation\": \"\"}]','assets/frontend/images/demo/destination-kerala.webp','[\"assets/frontend/images/demo/destination-kerala.webp\"]',32900.00,'per_person',2,12,'easy','family',1,1,2,'6-Day Kerala Backwater Holiday Package | UniWorld Holidays','Travel through Munnar, Thekkady and Kerala’s backwaters on a six-day private itinerary with curated hotels and comfortable transfers.','assets/frontend/images/demo/destination-kerala.webp','2026-08-15 21:05:06',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(4,4,'royal-rajasthan-circuit','Royal Rajasthan Circuit','Eight days of forts, palaces, regional cuisine and heritage stays across a carefully sequenced Rajasthan route.',8,7,'<p>A private cultural circuit linking Jaipur, Jodhpur and Udaipur with guided landmark visits and space for markets, local food and hotel experiences. The route can be extended to Jaisalmer or shortened around your flights.</p>','[{\"text\": \"Private arrival transfer\"}, {\"text\": \"Daily breakfast\"}, {\"text\": \"Curated sightseeing\"}, {\"text\": \"24/7 trip support\"}]','[{\"text\": \"Accommodation\"}, {\"text\": \"Breakfast\"}, {\"text\": \"Transfers\"}, {\"text\": \"Sightseeing\"}]','[{\"text\": \"Flights unless specified\"}, {\"text\": \"Personal expenses\"}, {\"text\": \"Travel insurance\"}]','[{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrive in Jaipur\", \"description\": \"Meet your transfer representative, continue to your stay and review the journey ahead.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Amber Fort and Jaipur heritage\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Markets, museums and a flexible Jaipur afternoon\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Drive to Jodhpur\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Mehrangarh Fort and the Blue City\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 6, \"meals\": \"Breakfast\", \"title\": \"Travel to Udaipur\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 7, \"meals\": \"Breakfast\", \"title\": \"Udaipur palaces, lake and old city\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 8, \"meals\": \"Breakfast\", \"title\": \"Departure or onward extension\", \"description\": \"Check out after breakfast and continue to the airport or your onward arrangement.\", \"accommodation\": \"\"}]','assets/frontend/images/demo/destination-rajasthan.webp','[\"assets/frontend/images/demo/destination-rajasthan.webp\"]',48900.00,'per_person',2,12,'easy','cultural',1,1,3,'8-Day Royal Rajasthan Private Tour | UniWorld Holidays','Discover Jaipur, Jodhpur and Udaipur on an eight-day private Rajasthan tour with heritage stays, guided sightseeing and flexible extensions.','assets/frontend/images/demo/destination-rajasthan.webp','2026-08-15 21:05:06',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(5,5,'dubai-signature-experience','Dubai Signature Experience','Five well-planned days combining modern Dubai, the old city, a desert evening and waterfront leisure.',5,4,'<p>Designed for first-time and returning visitors, this Dubai itinerary groups experiences by area to make better use of each day. Attraction levels, hotel neighbourhood and free time can all be tailored.</p>','[{\"text\": \"Private arrival transfer\"}, {\"text\": \"Daily breakfast\"}, {\"text\": \"Curated sightseeing\"}, {\"text\": \"24/7 trip support\"}]','[{\"text\": \"Accommodation\"}, {\"text\": \"Breakfast\"}, {\"text\": \"Transfers\"}, {\"text\": \"Sightseeing\"}]','[{\"text\": \"Flights unless specified\"}, {\"text\": \"Personal expenses\"}, {\"text\": \"Travel insurance\"}]','[{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and private hotel transfer\", \"description\": \"Meet your transfer representative, continue to your stay and review the journey ahead.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Old Dubai, Creek and contemporary city highlights\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Downtown Dubai and Burj Khalifa district\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Flexible morning and considered desert experience\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Breakfast and airport departure\", \"description\": \"Check out after breakfast and continue to the airport or your onward arrangement.\", \"accommodation\": \"\"}]','assets/frontend/images/demo/destination-dubai.webp','[\"assets/frontend/images/demo/destination-dubai.webp\"]',74900.00,'per_person',2,12,'easy','luxury',1,1,4,'5-Day Dubai Holiday Package from India | UniWorld Holidays','Experience Downtown Dubai, the old city, marina and desert on a five-day holiday with coordinated hotel, transfers and attraction planning.','assets/frontend/images/demo/destination-dubai.webp','2026-08-15 21:05:06',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(6,6,'romantic-bali-hideaway','Romantic Bali Hideaway','Six days pairing Ubud’s cultural landscape with a coastal retreat and thoughtful time for two.',6,5,'<p>This couple-focused Bali journey combines inland scenery, temples and local culture with a relaxed coastal stay. Villa category, celebration arrangements and activity level can be personalised.</p>','[{\"text\": \"Private arrival transfer\"}, {\"text\": \"Daily breakfast\"}, {\"text\": \"Curated sightseeing\"}, {\"text\": \"24/7 trip support\"}]','[{\"text\": \"Accommodation\"}, {\"text\": \"Breakfast\"}, {\"text\": \"Transfers\"}, {\"text\": \"Sightseeing\"}]','[{\"text\": \"Flights unless specified\"}, {\"text\": \"Personal expenses\"}, {\"text\": \"Travel insurance\"}]','[{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrival and private transfer to Ubud\", \"description\": \"Meet your transfer representative, continue to your stay and review the journey ahead.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Ubud culture, craft and rice-terrace landscapes\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Temple and countryside experience\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Transfer to your selected coastal area\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Leisure, spa or optional island experience\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 6, \"meals\": \"Breakfast\", \"title\": \"Private transfer and departure\", \"description\": \"Check out after breakfast and continue to the airport or your onward arrangement.\", \"accommodation\": \"\"}]','assets/frontend/images/demo/destination-bali.webp','[\"assets/frontend/images/demo/destination-bali.webp\"]',82900.00,'per_person',2,12,'easy','honeymoon',1,1,5,'6-Day Bali Honeymoon & Couple Package | UniWorld Holidays','Combine Ubud and the Bali coast on a six-day couple holiday with private transfers, curated villas, temples and flexible romantic experiences.','assets/frontend/images/demo/destination-bali.webp','2026-08-15 21:05:06',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43'),(7,7,'maldives-overwater-luxury','Maldives Overwater Luxury','Five days at a carefully matched private-island resort with an overwater stay and a clear meal-plan choice.',5,4,'<p>A refined Maldives escape built around the resort rather than a generic package. We compare transfer method, lagoon, reef access, dining, villa privacy and included activities before recommending the right island.</p>','[{\"text\": \"Private arrival transfer\"}, {\"text\": \"Daily breakfast\"}, {\"text\": \"Curated sightseeing\"}, {\"text\": \"24/7 trip support\"}]','[{\"text\": \"Accommodation\"}, {\"text\": \"Breakfast\"}, {\"text\": \"Transfers\"}, {\"text\": \"Sightseeing\"}]','[{\"text\": \"Flights unless specified\"}, {\"text\": \"Personal expenses\"}, {\"text\": \"Travel insurance\"}]','[{\"day\": 1, \"meals\": \"Breakfast\", \"title\": \"Arrive in Malé and transfer to your island resort\", \"description\": \"Meet your transfer representative, continue to your stay and review the journey ahead.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 2, \"meals\": \"Breakfast\", \"title\": \"Lagoon leisure and resort experiences\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 3, \"meals\": \"Breakfast\", \"title\": \"Snorkelling, spa or optional marine activity\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 4, \"meals\": \"Breakfast\", \"title\": \"Unhurried island day and sunset experience\", \"description\": \"A thoughtfully paced day with confirmed services and appropriate time at leisure.\", \"accommodation\": \"Selected hotel or resort\"}, {\"day\": 5, \"meals\": \"Breakfast\", \"title\": \"Resort checkout and airport transfer\", \"description\": \"Check out after breakfast and continue to the airport or your onward arrangement.\", \"accommodation\": \"\"}]','assets/frontend/images/demo/destination-maldives.webp','[\"assets/frontend/images/demo/destination-maldives.webp\"]',154900.00,'per_person',2,12,'easy','luxury',1,1,6,'5-Day Maldives Overwater Villa Package | UniWorld Holidays','Plan a five-day Maldives resort holiday with an overwater villa, suitable meal plan, island transfers and personalised celebration options.','assets/frontend/images/demo/destination-maldives.webp','2026-08-15 21:05:06',NULL,'2026-09-15 16:56:04','2026-09-19 09:27:43');
/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travellers`
--

DROP TABLE IF EXISTS `travellers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travellers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_expiry` date DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travellers_booking_id_index` (`booking_id`),
  KEY `travellers_type_index` (`type`),
  KEY `travellers_passport_number_index` (`passport_number`),
  CONSTRAINT `travellers_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travellers`
--

LOCK TABLES `travellers` WRITE;
/*!40000 ALTER TABLE `travellers` DISABLE KEYS */;
INSERT INTO `travellers` VALUES (1,1,'adult',NULL,'Arjun','Traveller',NULL,NULL,'1994-09-16',NULL,NULL,'Indian','Demo traveller; passport details intentionally omitted.',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(2,1,'adult',NULL,'Guest','Traveller',NULL,NULL,'1994-09-16',NULL,NULL,'Indian','Demo traveller; passport details intentionally omitted.',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06'),(3,2,'adult',NULL,'The','Traveller',NULL,NULL,'1994-08-07',NULL,NULL,'Indian','Demo traveller; passport details intentionally omitted.',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(4,2,'adult',NULL,'Guest','Traveller',NULL,NULL,'1994-08-07',NULL,NULL,'Indian','Demo traveller; passport details intentionally omitted.',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(5,3,'adult',NULL,'Riya','Traveller',NULL,NULL,'1994-06-28',NULL,NULL,'Indian','Demo traveller; passport details intentionally omitted.',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07'),(6,3,'adult',NULL,'Guest','Traveller',NULL,NULL,'1994-06-28',NULL,NULL,'Indian','Demo traveller; passport details intentionally omitted.',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:07');
/*!40000 ALTER TABLE `travellers` ENABLE KEYS */;
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
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Aditi Kapoor','demo.admin@uniworld.test','2026-09-15 21:05:05','$2y$12$dZyDBQ6y6awwRmklFGw5DO90qBwkZM8KYKNyWBm.nuW6MS2qiy.Du',NULL,'2026-09-15 16:56:03','2026-09-15 21:05:05'),(3,'Rohan Desai','demo.sales@uniworld.test','2026-09-15 21:05:05','$2y$12$KqV399cHPVfasMb6hZ.jIOhYo/nxu9EDTKEDtGIGJh1neDdU3io.a',NULL,'2026-09-15 16:56:03','2026-09-15 21:05:06'),(4,'Meera Nair','demo.operations@uniworld.test','2026-09-15 21:05:06','$2y$12$nAz3BJHy0mSRgoxRUsjyH.dVbMzKMcF2nGh342qnd6hVjehQt.Rgq',NULL,'2026-09-15 16:56:03','2026-09-15 21:05:06'),(5,'Kabir Shah','demo.content@uniworld.test','2026-09-15 21:05:06','$2y$12$MtAIxwqnuB3NT7FJBoVxAOrP1aT1zqhaLQsBSiCsd/xfZ.7BkDHHq',NULL,'2026-09-15 16:56:04','2026-09-15 21:05:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bobby_holidays'
--

--
-- Dumping routines for database 'bobby_holidays'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-19 21:28:29
