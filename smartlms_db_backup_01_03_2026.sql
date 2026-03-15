-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: smart_lms
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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_email_unique` (`email`),
  KEY `admin_role_id_foreign` (`role_id`),
  CONSTRAINT `admin_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Smart LMS','admin@smartlms.com','$2y$12$jKmPJZ92B.rGieLjMRmz8uTmmsPynNb1NQpy/Z2s3Fk0g3Fa/91S2',1,'2026-01-30 21:31:29','2026-01-31 07:30:06');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order_priority` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banners_order_priority_index` (`order_priority`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Master tomorrow\'s skills today','Power up your AI, career, and life skills with the most up-to-date, expert-led learning.','Get Stated','http://localhost:8000/','banners/UrRdHkc526Yf2ccCt6JgXYVuYmnhhglwFGDSd7fA.jpg',4,1,'2026-02-02 23:20:43','2026-02-03 11:05:52'),(2,'Smart AI Learning','Good Instructor & Good Learning Platform.','Click here','http://localhost:8000/','banners/DRlJ28W6A0G6B6PzCOpt2j0sttovmqgyYEelAiMX.jpg',3,1,'2026-02-03 11:01:22','2026-02-03 12:06:24'),(3,'Get certified and get ahead in your career','Prep for certifications with comprehensive courses, practice tests, and special offers on exam vouchers.','Click Here','http://localhost:8000','banners/7quWBE7svQdOl5uVHNaW7ThWOOVPPE1yjytByyzi.jpg',2,1,'2026-02-03 12:04:00','2026-02-03 12:07:13'),(5,'Learn AI with Google’s experts','Get the skills employers need now and earn a Google AI Professional Certificate to show what you know — all with one plan.','Explain Plan','http://localhost:8000/categories/course/artifical-inteligence?id=3','banners/6crEMz5bz6IpetGpRF53DgNJ3CEP3EegX2w8hZXC.png',1,1,'2026-02-22 00:36:45','2026-02-22 00:36:45');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `cache` VALUES ('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba','i:1;',1772298800),('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1772298800;',1772298800);
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  KEY `categories_created_by_foreign` (`created_by`),
  CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Web Development','web-development',NULL,1,1,1,'2026-02-01 01:38:46','2026-02-01 06:14:29'),(2,'ReactJs','reactjs',1,1,1,1,'2026-02-01 01:40:14','2026-02-01 01:40:14'),(3,'Artifical Inteligence','artifical-inteligence',NULL,1,1,2,'2026-02-01 01:54:05','2026-02-01 06:14:50'),(4,'Learn AI Fundamental','learn-ai-fundamental',3,1,1,2,'2026-02-01 01:54:56','2026-02-01 01:54:56'),(5,'IT & Software','it-software',NULL,1,1,3,'2026-02-01 03:28:16','2026-02-01 03:28:16'),(6,'Business','business',NULL,1,1,4,'2026-02-01 03:29:59','2026-02-01 03:29:59'),(7,'Fianance & Accounting','fianance-accounting',NULL,1,1,5,'2026-02-01 03:30:32','2026-02-01 03:30:32'),(8,'AngularJs','angularjs',1,1,1,2,'2026-02-01 03:41:20','2026-02-01 03:41:20'),(9,'Health & Fitness','health-fitness',NULL,1,1,6,'2026-02-01 06:34:36','2026-02-01 06:34:36'),(10,'Software Testing','software-testing',NULL,1,1,7,'2026-02-04 11:38:03','2026-02-04 11:38:03'),(12,'NextJS','nextjs',1,1,1,3,'2026-02-21 11:44:39','2026-02-21 11:44:39'),(13,'TypeScript','typescript',1,1,1,4,'2026-02-21 11:46:06','2026-02-21 11:46:06'),(14,'NodeJS','nodejs',1,1,1,5,'2026-02-21 11:46:23','2026-02-21 11:46:23'),(15,'Html','html',1,1,1,7,'2026-02-21 12:19:05','2026-02-21 12:19:11'),(16,'Css','css',1,1,1,8,'2026-02-21 12:19:56','2026-02-21 12:19:56'),(17,'Mobile Developement','mobile-developement',NULL,1,1,8,'2026-02-28 11:41:36','2026-02-28 11:43:30'),(18,'React Native','react-native',17,1,1,1,'2026-02-28 11:41:58','2026-02-28 11:41:58');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_lectures`
--

DROP TABLE IF EXISTS `course_lectures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_lectures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_section_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `duration` int(10) unsigned NOT NULL DEFAULT 0,
  `is_preview` tinyint(1) NOT NULL DEFAULT 0,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_lectures_course_section_id_order_index` (`course_section_id`,`order`),
  CONSTRAINT `course_lectures_course_section_id_foreign` FOREIGN KEY (`course_section_id`) REFERENCES `course_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_lectures`
--

LOCK TABLES `course_lectures` WRITE;
/*!40000 ALTER TABLE `course_lectures` DISABLE KEYS */;
INSERT INTO `course_lectures` VALUES (213,59,'Welcome to the Course','https://youtu.be/kGtEax1WQFg?si=Sx_F-2A358VjDPxC',5,1,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(214,59,' Installing Environment','',3,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(215,60,'What is React Native','',1,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(216,60,'Components & JSX','',2,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(217,60,'Styling in React Native','',3,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(218,60,'Navigation Basics','',5,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(219,61,'useState & useEffect','',4,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(220,61,'Context API','',6,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(221,61,'Redux Toolkit Basics','',8,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(222,61,'Handling Async Data','',10,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(223,62,'REST API Integration','',6,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(224,62,'Authentication Flow','',10,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(225,62,'Secure Token Storage','',14,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(226,62,'Error Handling','',18,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(227,63,'Creating Login Screen','',10,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(228,63,'Building Dashboard UI','',20,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(229,63,'Preparing App for Production','',40,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(230,63,'Deploy to Play Store','',50,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(231,64,'Using React Native Reanimated','',5,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(232,64,'Creating Smooth Transitions','',20,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(233,64,'Gesture Handling','',10,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(234,64,'Building Custom Components','',14,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(235,65,'Improving App Performance','',4,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(236,65,'Avoiding Unnecessary Re-renders','',6,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(237,65,'Optimizing Images & Assets','',8,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(238,65,'Debugging Performance Issues','',10,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(239,66,'Debugging with React Native Debugger','',5,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(240,66,'Writing Unit Tests','',6,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(241,66,'Testing Components','',8,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(242,66,'Handling Runtime Errors','',10,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(243,67,'Accessing Camera','',3,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(244,67,'Using Location Services','',5,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(245,67,'Push Notifications','',13,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(246,67,'Working with Device Storage','',16,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(247,68,'App Store Deployment','',5,0,1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(248,68,'Play Store Deployment','',19,0,2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(249,68,'Version Updates Strategy','',15,0,3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(250,68,'Post-Launch Maintenance','',14,0,4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(251,69,'Welcome to the Laravel Course','https://youtu.be/rXleVXyp-kk?si=arHS8Q7ssx-NY7HE',8,1,1,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(252,69,'What is Laravel & Why Choose It?','',5,0,2,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(253,69,'Setting Up Development Environment','',10,0,3,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(254,69,'Overview of MVC Architecture in Laravel','',15,0,4,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(255,70,'Routing in Laravel','',4,0,1,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(256,70,'Controllers and Views','',5,0,2,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(257,70,'Blade Templating Engine Basics','',8,0,3,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(258,70,'Passing Data to Views','',12,0,4,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(259,70,'Basic CRUD Operations','',16,0,5,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(260,71,'Setting Up Database & Migrations','',15,0,1,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(261,71,'Eloquent Models Explained','',12,0,2,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(262,71,'Relationships in Laravel (One-to-One, One-to-Many)','',10,0,3,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(263,71,'Query Builder & Advanced Queries','',11,0,4,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(264,71,'Database Seeding & Factories','',15,0,5,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(265,72,'Authentication & Authorization','',8,0,1,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(266,72,'Middleware & Route Protection','',18,0,2,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(267,72,'File Uploads & Storage','',15,0,3,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(268,72,'Sending Emails & Notifications','',12,0,4,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(269,72,'API Development with Laravel','',11,0,5,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(270,73,'Building a Real-World Project (E-Commerce Example)','',25,0,1,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(271,73,'Debugging & Error Handling','',6,0,2,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(272,73,'Testing Laravel Applications','',12,0,3,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(273,73,'Deployment on Hosting / Cloud (e.g., Laravel Forge)','',50,0,4,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(274,73,'Final Thoughts & Next Steps','',5,0,5,'2026-03-01 05:30:04','2026-03-01 05:30:04');
/*!40000 ALTER TABLE `course_lectures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_sections`
--

DROP TABLE IF EXISTS `course_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_sections_course_id_order_index` (`course_id`,`order`),
  CONSTRAINT `course_sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_sections`
--

LOCK TABLES `course_sections` WRITE;
/*!40000 ALTER TABLE `course_sections` DISABLE KEYS */;
INSERT INTO `course_sections` VALUES (59,13,'Introduction',1,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(60,13,' React Native Fundamentals',2,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(61,13,'State Management',3,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(62,13,'Working with APIs & Backend',4,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(63,13,'Build & Deploy Real App',5,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(64,13,'Advanced UI & Animations',6,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(65,13,'Performance Optimization',7,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(66,13,'Testing & Debugging',8,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(67,13,'Native Modules & Device Features',9,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(68,13,'Publishing & Maintenance',10,'2026-03-01 05:16:25','2026-03-01 05:16:25'),(69,4,'Introduction',1,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(70,4,'Basics of Laravel',2,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(71,4,'Database & Eloquent ORM',3,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(72,4,'Advanced Laravel Features',4,'2026-03-01 05:30:04','2026-03-01 05:30:04'),(73,4,'Project & Deployment',5,'2026-03-01 05:30:04','2026-03-01 05:30:04');
/*!40000 ALTER TABLE `course_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `approved_by` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `level` enum('beginner','intermediate','advanced','all_levels') NOT NULL DEFAULT 'beginner',
  `language` varchar(50) NOT NULL DEFAULT 'English',
  `meta_keywords` text DEFAULT NULL,
  `video_promo_path` varchar(255) DEFAULT NULL,
  `total_duration` int(11) NOT NULL DEFAULT 0 COMMENT 'Total seconds',
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `admin_feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_slug_unique` (`slug`),
  KEY `courses_category_id_foreign` (`category_id`),
  KEY `courses_approved_by_foreign` (`approved_by`),
  KEY `courses_status_index` (`status`),
  KEY `courses_user_id_foreign` (`user_id`),
  CONSTRAINT `courses_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (4,1,5,1,'Laravel 12 – Complete Web Development Course (Beginner to Advanced)','Learn Laravel 12 from scratch and build real-world web applications using modern PHP, MVC architecture, REST APIs, authentication, CRUD, and best practices.','This Laravel 12 Web Development Course is designed to help beginners and working developers master Laravel from the ground up.\n\nYou’ll start with Laravel fundamentals like routing, controllers, Blade templates, and database migrations. Then move on to advanced concepts such as authentication, authorization, RESTful APIs, validation, file uploads, pagination, and deployment.\n\nBy the end of this course, you will be able to build secure, scalable, and production-ready web applications using Laravel 12.\n\nWhat you’ll learn:\n\nLaravel 12 installation & project structure\nMVC architecture explained clearly\nBlade templating & reusable components\nDatabase migrations, seeders & Eloquent ORM\nAuthentication, roles & permissions\nCRUD operations with validation\nREST API development & Postman testing\nReal-world project development\nBest practices & performance optimization\n\nPerfect for students, freshers, and PHP developers who want to upgrade their skills.',4999.00,2999.00,'intermediate','Hindi','Laravel 12 course, Laravel web development, PHP Laravel framework, Laravel beginner course, Laravel API development, Laravel MVC, Laravel full stack, Laravel India','https://www.youtube.com/watch?v=laravel12-intro',0,0,'laravel-12-complete-web-development-course-beginner-to-advanced','thumbnails/hWTVzxXcj9bOqoVxht2BMGoB7fm2N3j3Yr9bP983.png',2,NULL,'2026-02-07 12:24:03',NULL,'2026-02-07 11:36:14','2026-03-01 05:30:04'),(5,1,5,1,'Web Developement ','Learn full stack web development from scratch using HTML, CSS, JavaScript, PHP, and Laravel. Build real-world projects and become job-ready.','This comprehensive Full Stack Web Development course is designed for beginners who want to build modern, responsive, and dynamic web applications.\n\nYou’ll start with the fundamentals of HTML and CSS, move on to JavaScript for interactivity, and then dive into backend development using PHP and Laravel. The course includes real-world projects, best practices, and hands-on coding to help you gain practical experience.\n\nWhat you’ll learn:\n\nHTML5, CSS3 & Responsive Design\n\nJavaScript fundamentals & DOM manipulation\n\nBackend development with PHP\n\nLaravel MVC framework\n\nAuthentication & CRUD applications\n\nDatabase integration (MySQL)\n\nProject-based learning\n\nBy the end of this course, you’ll be confident in building full stack web applications and ready to apply for junior developer roles or freelance projects.',9999.00,3999.00,'beginner','English','web development course, full stack web development, html css javascript course, laravel course, php web development, beginner web developer',NULL,0,0,'web-developement','thumbnails/etUwP1WdUVwdoQOCiWyss03vOiEYXEAEBAxDxU19.jpg',2,NULL,'2026-02-07 12:22:37',NULL,'2026-02-07 11:43:37','2026-02-08 04:08:48'),(7,1,5,1,'Full Stack Web Development','Learn full stack web development from scratch using HTML, CSS, JavaScript, PHP, and Laravel. Perfect for beginners.','This Full Stack Web Development course is designed for beginners who want to become professional web developers.\n\nYou will learn frontend technologies like HTML, CSS, Bootstrap, and JavaScript, along with backend development using PHP and Laravel.\n\nBy the end of this course, you will be able to build complete dynamic web applications, REST APIs, and deploy real-world projects confidently.',4999.00,2999.00,'beginner','English + Hindi','full stack web development, laravel course, php developer, web development course india, backend developer, frontend developer','https://www.youtube.com/watch?v=AbCdEf12345',0,0,'full-stack-web-development','thumbnails/BLHzy4Fl8fF7TDdbRWiaFl2SByL12dqho0m7uZV5.jpg',2,'2026-02-07 12:29:42','2026-02-07 12:29:49',NULL,'2026-02-07 12:29:32','2026-02-08 04:03:03'),(8,7,3,1,'Accounting ','This course provides a complete overview of accounting fundamentals, including financial statements, journal entries, ledgers, and practical bookkeeping.','Learn the basics of accounting, including financial statements, bookkeeping, journal entries, and balance sheets. This course provides a clear understanding of how to track income, expenses, assets, and liabilities — essential knowledge for students, entrepreneurs, and business professionals.',5999.00,2999.00,'beginner','English','Accounting, Bookkeeping, Financial Statements, Ledger, Accounting Course, Beginner Accounting',NULL,0,0,'accounting','thumbnails/Ycbxcw6Kgz6SS7ln8NDppqgRbFp7d3pPwAlVRKTI.jpg',2,'2026-02-07 12:34:45','2026-02-07 12:34:50',NULL,'2026-02-07 12:34:22','2026-02-22 09:26:17'),(9,1,3,1,'Html + Css + Javascript Web Developement','This course covers complete front-end web development using HTML, CSS, and JavaScript with practical examples. ','Learn the fundamentals of modern web development by mastering HTML for structure, CSS for styling, and JavaScript for interactivity. This course guides you step-by-step in building responsive, dynamic, and professional websites from scratch — perfect for beginners who want to start their journey as a web developer',3999.00,1999.00,'beginner','English',NULL,NULL,0,0,'html-css-javascript-web-developement','thumbnails/iz3ufD0uh9C7Wza4sH8UbpmC9FkB4Mgfv4oyEZhK.jpg',2,'2026-02-07 12:48:24','2026-02-07 12:48:28',NULL,'2026-02-07 12:48:08','2026-02-22 09:25:15'),(10,5,1,1,'Software Engineering',NULL,NULL,0.00,NULL,'beginner','English',NULL,NULL,0,0,'software-engineering','thumbnails/DSXW43xUMsproPqK87iClWXEwyifHt9w7UvDb4NP.jpg',2,'2026-02-07 13:48:11','2026-02-07 13:48:37',NULL,'2026-02-07 13:47:49','2026-02-07 13:48:37'),(11,14,3,1,'Complete Node.js Bootcamp – Build Real-World APIs & Web Apps','Learn Node.js from scratch and build powerful REST APIs, authentication systems, and real-world backend applications using Express and MongoDB.','Master backend development with Node.js and build production-ready applications from the ground up.\n\nThis comprehensive course takes you step-by-step through Node.js fundamentals and moves toward advanced backend development concepts. Whether you\'re a beginner or someone looking to strengthen backend skills, this course will give you practical, job-ready experience.',3999.00,1999.00,'all_levels','English + Hindi','Node.js course, Learn Node.js, Node.js tutorial, Node.js for beginners, Backend development with Node.js, Express.js course, REST API development, MongoDB with Node.js, Full stack development, JavaScript backend','https://yourplatform.com/videos/nodejs-complete-bootcamp-promo.mp4',0,0,'complete-nodejs-bootcamp-build-real-world-apis-web-apps','thumbnails/rARSOwAs54esoNruACB1oelCy0xBS9j5YcoQoo7Y.jpg',2,'2026-02-21 11:53:12','2026-02-21 11:53:21',NULL,'2026-02-21 11:52:56','2026-02-28 11:39:17'),(12,8,3,1,'Complete AngularJS Masterclass – Build Dynamic Single Page Applications','Learn AngularJS from scratch and build powerful single-page web applications using controllers, directives, services, and routing with real-world projects.','Master front-end development with AngularJS and build dynamic, responsive single-page applications (SPAs) from the ground up.\n\nThis course is designed to help you understand AngularJS fundamentals and advanced concepts step by step. You will learn how to structure applications using MVC architecture and build interactive web apps used in real-world projects.',3499.00,2999.00,'intermediate','Hindi','AngularJS Masterclass, AngularJS Course Online, Learn AngularJS, AngularJS Tutorial, AngularJS for Beginners, AngularJS Single Page Application, Build SPA with AngularJS, AngularJS Web Development, Frontend Development Course, JavaScript Frameworks, MVC JavaScript Framework, AngularJS Projects, Dynamic Web Applications, SPA Development Course, AngularJS Certification Training, Web App Development with AngularJS, Complete AngularJS Masterclass for Beginners, Build Dynamic Single Page Applications with AngularJS, AngularJS from Scratch, Advanced AngularJS Concepts, AngularJS Routing Tutorial, AngularJS Dependency Injection, AngularJS Real World Projects','https://yourplatform.com/videos/angularjs-complete-course-promo.mp4',0,1,'complete-angularjs-masterclass-build-dynamic-single-page-applications','thumbnails/qGDvnshaOUAaT8LqfyIzMJKmiSerNmChiJBFh5l0.jpg',2,'2026-02-21 11:59:49','2026-02-21 11:59:53',NULL,'2026-02-21 11:59:28','2026-02-22 09:20:10'),(13,18,3,1,'Master React Native: Build Cross-Platform Mobile Apps','Learn React Native from scratch and build high-quality cross-platform mobile apps for iOS and Android. Master components, navigation, APIs, and deployment.','- Learn how to use ReactJS to build real native mobile apps for iOS and Android\n- Develop cross-platform (iOS and Android) mobile apps without knowing Swift, ObjectiveC or Java/ Android\n- Explore React Native basics and advanced features!\n- Learn how to use key mobile app features like Google maps or the device camera',5999.00,3999.00,'all_levels','Hindi','React Native course, Mobile app development, Cross-platform apps, Learn React Native, iOS and Android development, Expo, React Navigation, Build apps, Publish apps, Mobile development online course','https://example.com/videos/react-native-intro.mp4',0,0,'master-react-native-build-cross-platform-mobile-apps','thumbnails/a0tkSD2W9jThwNcc84elfpqmsYpDG1babSJ17T8w.png',2,'2026-02-28 11:45:17','2026-02-28 11:45:23',NULL,'2026-02-28 11:44:12','2026-03-01 04:40:10');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
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
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructor` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `marketing_opt_in` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `instructor_email_unique` (`email`),
  KEY `instructor_role_id_foreign` (`role_id`),
  CONSTRAINT `instructor_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor`
--

LOCK TABLES `instructor` WRITE;
/*!40000 ALTER TABLE `instructor` DISABLE KEYS */;
INSERT INTO `instructor` VALUES (1,2,'Test Demo','testdemo01@gmail.com','$2y$12$gBmxxx94y9d5B1dLIl6k5eiVJEvyn.FT/2Ew.XicVHrYf.xwcik06','1',0,'2026-01-30 21:39:02','2026-01-30 22:38:38'),(3,2,'Chandrakant Modi','cmodi119@gmail.com','$2y$12$dBCJjgI7bM3iZpV/OgZONOaN80snOFdeo1KGQa1NNdOxvHSa3Djci','1',0,'2026-01-31 05:41:05','2026-01-31 05:41:26'),(4,2,'Tech web Modi','techwebumang@gmail.com','$2y$12$W378jRPRI3e4WOKrvmLRceMSByuiJbwGc5lvoOiQpah52JhcEbhcW','1',0,'2026-01-31 05:47:27','2026-01-31 05:47:51'),(5,2,'PinkeyBen Modi','pinkeymodi83@gmail.com','$2y$12$nACXhrIrM09V9mlxMb8RO.UK/riiGCXr.2dalaQQ/JobOwqz9hu7m','1',0,'2026-01-31 07:04:49','2026-01-31 07:09:39');
/*!40000 ALTER TABLE `instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_details`
--

DROP TABLE IF EXISTS `instructor_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructor_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint(20) unsigned NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instructor_details_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `instructor_details_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_details`
--

LOCK TABLES `instructor_details` WRITE;
/*!40000 ALTER TABLE `instructor_details` DISABLE KEYS */;
INSERT INTO `instructor_details` VALUES (4,3,'images/huB4Ejt2b3CqGtXFXjbGVtDuXr4xk6kL8jN9bX1G.webp',' Full Stack Developer | Expert in Laravel & Livewire','Hello, I am Chandrakant Modi. I have over 10 years of experience in web development and software architecture. My passion lies in teaching complex coding concepts in a simple, easy-to-understand way. I have helped thousands of students launch their careers in the IT industry.','https://chandrakantmodi.me','https://facebook.com/chandrakant.modi','https://linkedin.com/in/chandrakantmodi','https://linkedin.com/chandrakantmodi','https://youtube.com/c/ChandrakantModiTech','2026-01-31 11:27:51','2026-01-31 12:04:46'),(5,5,'images/ZuGV5UYjoT9XpeQCdf9xZ1jjHCPqZslEAhfEas7Q.png','Full Stack Developer','Hello, I am Pinkeyben Modi. I have over 5 years of experience in web development and software architecture. My passion lies in teaching complex coding concepts in a simple, easy-to-understand way. I have helped thousands of students launch their careers in the IT industry.','https://pinkeymodi.me','https://facebook.com/pinkeymodi','https://linkedin.com/in/pinkeymodi.','https://linkedin.com/pinkeymodi.','https://youtube.com/c/pinkeymodi.Tech','2026-02-01 00:14:13','2026-02-01 00:14:13'),(6,1,'images/eAZbpOeDkQitXHWSh6zf7PSxRg8OINpv2uFjF305.png','Senior Software Engineer',NULL,NULL,NULL,NULL,NULL,NULL,'2026-02-28 00:44:46','2026-02-28 00:44:46'),(7,4,'images/JTGHlt2eMxiR2aS5H5wlEKHnOM8ej82I5fGHW9yR.jpg','Junior PHP Full Stack Developer',NULL,NULL,NULL,NULL,NULL,NULL,'2026-02-28 00:48:30','2026-02-28 00:48:30');
/*!40000 ALTER TABLE `instructor_details` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_01_18_094532_create_personal_access_tokens_table',1),(5,'2026_01_18_095529_create_roles_table',1),(6,'2026_01_18_095604_create_user_roles_table',1),(7,'2026_01_18_115440_create_user_otp_table',1),(8,'2026_01_20_173509_create_role_permission_table',2),(9,'2026_01_21_170802_create_users_profile_table',2),(10,'2026_01_24_102117_create_role_id_to_users_table',2),(11,'2026_01_29_160024_create_admin_table',2),(12,'2026_01_29_164740_create_instructor_table',2),(13,'2026_01_29_173917_create_instructor_details_table',2),(14,'2026_02_01_063027_create_categories_table',3),(15,'2026_02_03_041105_create_banners_table',4),(16,'2026_02_04_172409_create_courses_table',5),(17,'2026_02_05_043626_add_role_id_to_users_profile',6),(18,'2026_02_07_170405_fix_courses_foreign_key',7),(19,'2026_02_08_091217_add_course_details_to_courses_table',8),(20,'2026_03_01_063105_create_course_sections_table',9),(21,'2026_03_01_063157_create_course_lectures_table',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\Admin',1,'api_token','ca7c82eab9764048d5089b60057e6abba482bf99a1aa05238efd91a23b2569d3','[\"*\"]','2026-01-31 05:09:50',NULL,'2026-01-31 05:08:22','2026-01-31 05:09:50'),(2,'App\\Models\\User',1,'api_token','76ab566a092ac044c5a04650a58f977b34d137f3dfd189ff5c1e12d7af233f45','[\"*\"]',NULL,NULL,'2026-01-31 07:07:42','2026-01-31 07:07:42'),(3,'App\\Models\\Instructor',5,'instructor_token','a21157ecb0ad7974264fad97819386a25de2229e99a2c6266182a548e8d7b6df','[\"*\"]',NULL,NULL,'2026-02-01 00:23:51','2026-02-01 00:23:51'),(4,'App\\Models\\Instructor',5,'instructor_token','5404d69fb1e2d96293514889907ad74f62a7e3b59cda5d8b63f8fdbf07f39df0','[\"*\"]',NULL,NULL,'2026-02-01 00:39:25','2026-02-01 00:39:25'),(5,'App\\Models\\Admin',1,'api_token','5d794225d19738bfb3f3899de58f807fab8294dcb857f67d3803b3bcfb381554','[\"*\"]','2026-02-22 00:39:53',NULL,'2026-02-01 06:24:28','2026-02-22 00:39:53');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permission_role_id_foreign` (`role_id`),
  CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permission`
--

LOCK TABLES `role_permission` WRITE;
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','2026-01-30 21:31:29','2026-01-30 21:31:29'),(2,'instructor','2026-01-30 21:31:29','2026-01-30 21:31:29'),(3,'student','2026-01-30 21:31:29','2026-01-30 21:31:29');
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
INSERT INTO `sessions` VALUES ('g3BIriJQq7ZwlAU61JYaU1g57ZYPm1t4IffwTsQi',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaWh2WWNkOWFnVmx3VVNMaXB3bGRiaFNMYk9xOWFHU2VWMFJZaTBmeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTA4OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY291cnNlL21hc3Rlci1yZWFjdC1uYXRpdmUtYnVpbGQtY3Jvc3MtcGxhdGZvcm0tbW9iaWxlLWFwcHM/Y2F0ZWdvcnlfc2x1Zz1yZWFjdC1uYXRpdmUiO3M6NToicm91dGUiO3M6MTQ6ImNvdXJzZS1kZXRhaWxzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NzoibG9naW5faW5zdHJ1Y3Rvcl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czo0OiJjYXJ0IjthOjA6e319',1772365015),('OdBC710kjlF4jG3kF6aA4TVq5HmXxWsBlNboP8JL',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:147.0) Gecko/20100101 Firefox/147.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoieVBBbDdFOGhkaVRHa1BMMTJaeW1nMXdqeHlSbGF6endnSWh3djhSYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTQ6Im90cF91c2VyX2VtYWlsIjtzOjIyOiJ1bWFuZ21vZGkwMDNAZ21haWwuY29tIjtzOjU3OiJsb2dpbl9pbnN0cnVjdG9yXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9',1772362280);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_otp`
--

DROP TABLE IF EXISTS `user_otp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_otp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `otp_code` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_otp_user_id_foreign` (`user_id`),
  CONSTRAINT `user_otp_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_otp`
--

LOCK TABLES `user_otp` WRITE;
/*!40000 ALTER TABLE `user_otp` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_otp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_roles_user_id_role_id_unique` (`user_id`,`role_id`),
  KEY `user_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
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
  `role_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Umang Modi','umangmodi003@gmail.com',NULL,'$2y$12$qF0yT67XeJGASZa14vd2SuvPErFN.NPHBGnqIiiqzgTGk63aIEEkW',NULL,'2026-01-30 21:34:04','2026-01-30 21:34:04',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_profile`
--

DROP TABLE IF EXISTS `users_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_profile` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_profile_user_id_foreign` (`user_id`),
  CONSTRAINT `users_profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_profile`
--

LOCK TABLES `users_profile` WRITE;
/*!40000 ALTER TABLE `users_profile` DISABLE KEYS */;
INSERT INTO `users_profile` VALUES (1,1,3,'2026-01-15','Male','India','Patan','English','I\'m Full Stack Developer..','images/LPu6B5tjP1eP7z6mH7HEs7MwRE5sDqY4trLIy7hO.jpg','9313744239','2026-01-31 07:06:47','2026-02-04 23:19:40'),(3,1,1,'2026-02-05','Male','India','Ahmedabad','English','I\'m System Administrator.','images/gOOethGrvp3nF5dnBO9lpWyTRTu57ydfI2aWWnlx.png','9313744240','2026-02-04 23:14:42','2026-02-04 23:20:09');
/*!40000 ALTER TABLE `users_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-01 17:16:04
