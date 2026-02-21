-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2026 at 05:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `category_id`, `user_id`, `approved_by`, `title`, `short_description`, `description`, `price`, `discount_price`, `level`, `language`, `meta_keywords`, `video_promo_path`, `total_duration`, `is_published`, `slug`, `thumbnail`, `status`, `submitted_at`, `approved_at`, `admin_feedback`, `created_at`, `updated_at`) VALUES
(4, 1, 5, 1, 'Laravel 12 – Complete Web Development Course (Beginner to Advanced)', 'Learn Laravel 12 from scratch and build real-world web applications using modern PHP, MVC architecture, REST APIs, authentication, CRUD, and best practices.', 'This Laravel 12 Web Development Course is designed to help beginners and working developers master Laravel from the ground up.\n\nYou’ll start with Laravel fundamentals like routing, controllers, Blade templates, and database migrations. Then move on to advanced concepts such as authentication, authorization, RESTful APIs, validation, file uploads, pagination, and deployment.\n\nBy the end of this course, you will be able to build secure, scalable, and production-ready web applications using Laravel 12.\n\nWhat you’ll learn:\n\nLaravel 12 installation & project structure\nMVC architecture explained clearly\nBlade templating & reusable components\nDatabase migrations, seeders & Eloquent ORM\nAuthentication, roles & permissions\nCRUD operations with validation\nREST API development & Postman testing\nReal-world project development\nBest practices & performance optimization\n\nPerfect for students, freshers, and PHP developers who want to upgrade their skills.', 4999.00, 2999.00, 'intermediate', 'English (with Hindi explanations)', 'Laravel 12 course, Laravel web development, PHP Laravel framework, Laravel beginner course, Laravel API development, Laravel MVC, Laravel full stack, Laravel India', 'https://www.youtube.com/watch?v=laravel12-intro', 0, 0, 'laravel-12-complete-web-development-course-beginner-to-advanced', 'thumbnails/hWTVzxXcj9bOqoVxht2BMGoB7fm2N3j3Yr9bP983.png', 2, NULL, '2026-02-07 12:24:03', NULL, '2026-02-07 11:36:14', '2026-02-08 04:11:13'),
(5, 1, 5, 1, 'Web Developement ', 'Learn full stack web development from scratch using HTML, CSS, JavaScript, PHP, and Laravel. Build real-world projects and become job-ready.', 'This comprehensive Full Stack Web Development course is designed for beginners who want to build modern, responsive, and dynamic web applications.\n\nYou’ll start with the fundamentals of HTML and CSS, move on to JavaScript for interactivity, and then dive into backend development using PHP and Laravel. The course includes real-world projects, best practices, and hands-on coding to help you gain practical experience.\n\nWhat you’ll learn:\n\nHTML5, CSS3 & Responsive Design\n\nJavaScript fundamentals & DOM manipulation\n\nBackend development with PHP\n\nLaravel MVC framework\n\nAuthentication & CRUD applications\n\nDatabase integration (MySQL)\n\nProject-based learning\n\nBy the end of this course, you’ll be confident in building full stack web applications and ready to apply for junior developer roles or freelance projects.', 9999.00, 3999.00, 'beginner', 'English', 'web development course, full stack web development, html css javascript course, laravel course, php web development, beginner web developer', NULL, 0, 0, 'web-developement', 'thumbnails/etUwP1WdUVwdoQOCiWyss03vOiEYXEAEBAxDxU19.jpg', 2, NULL, '2026-02-07 12:22:37', NULL, '2026-02-07 11:43:37', '2026-02-08 04:08:48'),
(7, 1, 5, 1, 'Full Stack Web Development', 'Learn full stack web development from scratch using HTML, CSS, JavaScript, PHP, and Laravel. Perfect for beginners.', 'This Full Stack Web Development course is designed for beginners who want to become professional web developers.\n\nYou will learn frontend technologies like HTML, CSS, Bootstrap, and JavaScript, along with backend development using PHP and Laravel.\n\nBy the end of this course, you will be able to build complete dynamic web applications, REST APIs, and deploy real-world projects confidently.', 4999.00, 2999.00, 'beginner', 'English + Hindi', 'full stack web development, laravel course, php developer, web development course india, backend developer, frontend developer', 'https://www.youtube.com/watch?v=AbCdEf12345', 0, 0, 'full-stack-web-development', 'thumbnails/BLHzy4Fl8fF7TDdbRWiaFl2SByL12dqho0m7uZV5.jpg', 2, '2026-02-07 12:29:42', '2026-02-07 12:29:49', NULL, '2026-02-07 12:29:32', '2026-02-08 04:03:03'),
(8, 7, 3, 1, 'Accounting ', NULL, NULL, 0.00, NULL, 'beginner', 'English', NULL, NULL, 0, 0, 'accounting', 'thumbnails/Ycbxcw6Kgz6SS7ln8NDppqgRbFp7d3pPwAlVRKTI.jpg', 2, '2026-02-07 12:34:45', '2026-02-07 12:34:50', NULL, '2026-02-07 12:34:22', '2026-02-07 12:34:50'),
(9, 1, 3, 1, 'Html + Css + Javascript Web Developement', NULL, NULL, 0.00, NULL, 'beginner', 'English', NULL, NULL, 0, 0, 'html-css-javascript-web-developement', 'thumbnails/iz3ufD0uh9C7Wza4sH8UbpmC9FkB4Mgfv4oyEZhK.jpg', 2, '2026-02-07 12:48:24', '2026-02-07 12:48:28', NULL, '2026-02-07 12:48:08', '2026-02-07 12:48:28'),
(10, 5, 1, 1, 'Software Engineering', NULL, NULL, 0.00, NULL, 'beginner', 'English', NULL, NULL, 0, 0, 'software-engineering', 'thumbnails/DSXW43xUMsproPqK87iClWXEwyifHt9w7UvDb4NP.jpg', 2, '2026-02-07 13:48:11', '2026-02-07 13:48:37', NULL, '2026-02-07 13:47:49', '2026-02-07 13:48:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `courses_approved_by_foreign` (`approved_by`),
  ADD KEY `courses_status_index` (`status`),
  ADD KEY `courses_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
