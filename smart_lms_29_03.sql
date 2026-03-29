-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2026 at 04:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.29

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Smart LMS', 'admin@smartlms.com', '$2y$12$jKmPJZ92B.rGieLjMRmz8uTmmsPynNb1NQpy/Z2s3Fk0g3Fa/91S2', 1, '2026-01-30 21:31:29', '2026-01-31 07:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order_priority` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `button_text`, `button_url`, `image`, `order_priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master tomorrow\'s skills today', 'Power up your AI, career, and life skills with the most up-to-date, expert-led learning.', 'Get Stated', 'http://localhost:8000/', 'banners/UrRdHkc526Yf2ccCt6JgXYVuYmnhhglwFGDSd7fA.jpg', 4, 1, '2026-02-02 23:20:43', '2026-02-03 11:05:52'),
(2, 'Smart AI Learning', 'Good Instructor & Good Learning Platform.', 'Click here', 'http://localhost:8000/', 'banners/DRlJ28W6A0G6B6PzCOpt2j0sttovmqgyYEelAiMX.jpg', 3, 1, '2026-02-03 11:01:22', '2026-02-03 12:06:24'),
(3, 'Get certified and get ahead in your career', 'Prep for certifications with comprehensive courses, practice tests, and special offers on exam vouchers.', 'Click Here', 'http://localhost:8000', 'banners/7quWBE7svQdOl5uVHNaW7ThWOOVPPE1yjytByyzi.jpg', 2, 1, '2026-02-03 12:04:00', '2026-02-03 12:07:13'),
(5, 'Learn AI with Google’s experts', 'Get the skills employers need now and earn a Google AI Professional Certificate to show what you know — all with one plan.', 'Explain Plan', 'http://localhost:8000/categories/course/artifical-inteligence?id=3', 'banners/6crEMz5bz6IpetGpRF53DgNJ3CEP3EegX2w8hZXC.png', 1, 1, '2026-02-22 00:36:45', '2026-02-22 00:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `created_by`, `status`, `order_priority`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'web-development', NULL, 1, 1, 1, '2026-02-01 01:38:46', '2026-02-01 06:14:29'),
(2, 'ReactJs', 'reactjs', 1, 1, 1, 1, '2026-02-01 01:40:14', '2026-02-01 01:40:14'),
(3, 'Artifical Inteligence', 'artifical-inteligence', NULL, 1, 1, 2, '2026-02-01 01:54:05', '2026-02-01 06:14:50'),
(4, 'Learn AI Fundamental', 'learn-ai-fundamental', 3, 1, 1, 2, '2026-02-01 01:54:56', '2026-02-01 01:54:56'),
(5, 'IT & Software', 'it-software', NULL, 1, 1, 3, '2026-02-01 03:28:16', '2026-02-01 03:28:16'),
(6, 'Business', 'business', NULL, 1, 1, 4, '2026-02-01 03:29:59', '2026-02-01 03:29:59'),
(7, 'Fianance & Accounting', 'fianance-accounting', NULL, 1, 1, 5, '2026-02-01 03:30:32', '2026-02-01 03:30:32'),
(8, 'AngularJs', 'angularjs', 1, 1, 1, 2, '2026-02-01 03:41:20', '2026-02-01 03:41:20'),
(9, 'Health & Fitness', 'health-fitness', NULL, 1, 1, 6, '2026-02-01 06:34:36', '2026-02-01 06:34:36'),
(10, 'Software Testing', 'software-testing', NULL, 1, 1, 7, '2026-02-04 11:38:03', '2026-02-04 11:38:03'),
(12, 'NextJS', 'nextjs', 1, 1, 1, 3, '2026-02-21 11:44:39', '2026-02-21 11:44:39'),
(13, 'TypeScript', 'typescript', 1, 1, 1, 4, '2026-02-21 11:46:06', '2026-02-21 11:46:06'),
(14, 'NodeJS', 'nodejs', 1, 1, 1, 5, '2026-02-21 11:46:23', '2026-02-21 11:46:23'),
(15, 'Html', 'html', 1, 1, 1, 7, '2026-02-21 12:19:05', '2026-02-21 12:19:11'),
(16, 'Css', 'css', 1, 1, 1, 8, '2026-02-21 12:19:56', '2026-02-21 12:19:56'),
(17, 'Mobile Developement', 'mobile-developement', NULL, 1, 1, 8, '2026-02-28 11:41:36', '2026-02-28 11:43:30'),
(18, 'React Native', 'react-native', 17, 1, 1, 1, '2026-02-28 11:41:58', '2026-02-28 11:41:58');

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
(4, 1, 5, 1, 'Laravel 12 – Complete Web Development Course (Beginner to Advanced)', 'Learn Laravel 12 from scratch and build real-world web applications using modern PHP, MVC architecture, REST APIs, authentication, CRUD, and best practices.', 'This Laravel 12 Web Development Course is designed to help beginners and working developers master Laravel from the ground up.\n\nYou’ll start with Laravel fundamentals like routing, controllers, Blade templates, and database migrations. Then move on to advanced concepts such as authentication, authorization, RESTful APIs, validation, file uploads, pagination, and deployment.\n\nBy the end of this course, you will be able to build secure, scalable, and production-ready web applications using Laravel 12.\n\nWhat you’ll learn:\n\nLaravel 12 installation & project structure\nMVC architecture explained clearly\nBlade templating & reusable components\nDatabase migrations, seeders & Eloquent ORM\nAuthentication, roles & permissions\nCRUD operations with validation\nREST API development & Postman testing\nReal-world project development\nBest practices & performance optimization\n\nPerfect for students, freshers, and PHP developers who want to upgrade their skills.', 4999.00, 2999.00, 'intermediate', 'Hindi', 'Laravel 12 course, Laravel web development, PHP Laravel framework, Laravel beginner course, Laravel API development, Laravel MVC, Laravel full stack, Laravel India', 'https://www.youtube.com/watch?v=laravel12-intro', 0, 0, 'laravel-12-complete-web-development-course-beginner-to-advanced', 'thumbnails/hWTVzxXcj9bOqoVxht2BMGoB7fm2N3j3Yr9bP983.png', 2, NULL, '2026-02-07 12:24:03', NULL, '2026-02-07 11:36:14', '2026-03-01 05:30:04'),
(5, 1, 5, 1, 'Web Developement ', 'Learn full stack web development from scratch using HTML, CSS, JavaScript, PHP, and Laravel. Build real-world projects and become job-ready.', 'This comprehensive Full Stack Web Development course is designed for beginners who want to build modern, responsive, and dynamic web applications.\n\nYou’ll start with the fundamentals of HTML and CSS, move on to JavaScript for interactivity, and then dive into backend development using PHP and Laravel. The course includes real-world projects, best practices, and hands-on coding to help you gain practical experience.\n\nWhat you’ll learn:\n\nHTML5, CSS3 & Responsive Design\n\nJavaScript fundamentals & DOM manipulation\n\nBackend development with PHP\n\nLaravel MVC framework\n\nAuthentication & CRUD applications\n\nDatabase integration (MySQL)\n\nProject-based learning\n\nBy the end of this course, you’ll be confident in building full stack web applications and ready to apply for junior developer roles or freelance projects.', 9999.00, 3999.00, 'beginner', 'English', 'web development course, full stack web development, html css javascript course, laravel course, php web development, beginner web developer', NULL, 0, 0, 'web-developement', 'thumbnails/etUwP1WdUVwdoQOCiWyss03vOiEYXEAEBAxDxU19.jpg', 2, NULL, '2026-02-07 12:22:37', NULL, '2026-02-07 11:43:37', '2026-02-08 04:08:48'),
(7, 1, 5, 1, 'Full Stack Web Development', 'Learn full stack web development from scratch using HTML, CSS, JavaScript, PHP, and Laravel. Perfect for beginners.', 'This Full Stack Web Development course is designed for beginners who want to become professional web developers.\n\nYou will learn frontend technologies like HTML, CSS, Bootstrap, and JavaScript, along with backend development using PHP and Laravel.\n\nBy the end of this course, you will be able to build complete dynamic web applications, REST APIs, and deploy real-world projects confidently.', 4999.00, 2999.00, 'beginner', 'English + Hindi', 'full stack web development, laravel course, php developer, web development course india, backend developer, frontend developer', 'https://www.youtube.com/watch?v=AbCdEf12345', 0, 0, 'full-stack-web-development', 'thumbnails/BLHzy4Fl8fF7TDdbRWiaFl2SByL12dqho0m7uZV5.jpg', 2, '2026-02-07 12:29:42', '2026-02-07 12:29:49', NULL, '2026-02-07 12:29:32', '2026-02-08 04:03:03'),
(8, 7, 3, 1, 'Accounting ', 'This course provides a complete overview of accounting fundamentals, including financial statements, journal entries, ledgers, and practical bookkeeping.', 'Learn the basics of accounting, including financial statements, bookkeeping, journal entries, and balance sheets. This course provides a clear understanding of how to track income, expenses, assets, and liabilities — essential knowledge for students, entrepreneurs, and business professionals.', 5999.00, 2999.00, 'beginner', 'English', 'Accounting, Bookkeeping, Financial Statements, Ledger, Accounting Course, Beginner Accounting', NULL, 0, 0, 'accounting', 'thumbnails/Ycbxcw6Kgz6SS7ln8NDppqgRbFp7d3pPwAlVRKTI.jpg', 2, '2026-02-07 12:34:45', '2026-02-07 12:34:50', NULL, '2026-02-07 12:34:22', '2026-02-22 09:26:17'),
(9, 1, 3, 1, 'Html + Css + Javascript Web Developement', 'This course covers complete front-end web development using HTML, CSS, and JavaScript with practical examples. ', 'Learn the fundamentals of modern web development by mastering HTML for structure, CSS for styling, and JavaScript for interactivity. This course guides you step-by-step in building responsive, dynamic, and professional websites from scratch — perfect for beginners who want to start their journey as a web developer', 3999.00, 1999.00, 'beginner', 'English', NULL, NULL, 0, 0, 'html-css-javascript-web-developement', 'thumbnails/iz3ufD0uh9C7Wza4sH8UbpmC9FkB4Mgfv4oyEZhK.jpg', 2, '2026-02-07 12:48:24', '2026-02-07 12:48:28', NULL, '2026-02-07 12:48:08', '2026-02-22 09:25:15'),
(10, 5, 1, 1, 'Software Engineering', 'Learn the fundamentals of software engineering, including system design, coding standards, and best practices to build scalable and efficient applications.', NULL, 0.00, NULL, 'beginner', 'English', NULL, NULL, 0, 0, 'software-engineering', 'thumbnails/DSXW43xUMsproPqK87iClWXEwyifHt9w7UvDb4NP.jpg', 2, '2026-02-07 13:48:11', '2026-02-07 13:48:37', NULL, '2026-02-07 13:47:49', '2026-02-07 13:48:37'),
(11, 14, 3, 1, 'Complete Node.js Bootcamp – Build Real-World APIs & Web Apps', 'Learn Node.js from scratch and build powerful REST APIs, authentication systems, and real-world backend applications using Express and MongoDB.', 'Master backend development with Node.js and build production-ready applications from the ground up.\n\nThis comprehensive course takes you step-by-step through Node.js fundamentals and moves toward advanced backend development concepts. Whether you\'re a beginner or someone looking to strengthen backend skills, this course will give you practical, job-ready experience.', 3999.00, 1999.00, 'all_levels', 'English + Hindi', 'Node.js course, Learn Node.js, Node.js tutorial, Node.js for beginners, Backend development with Node.js, Express.js course, REST API development, MongoDB with Node.js, Full stack development, JavaScript backend', 'https://yourplatform.com/videos/nodejs-complete-bootcamp-promo.mp4', 0, 0, 'complete-nodejs-bootcamp-build-real-world-apis-web-apps', 'thumbnails/rARSOwAs54esoNruACB1oelCy0xBS9j5YcoQoo7Y.jpg', 2, '2026-02-21 11:53:12', '2026-02-21 11:53:21', NULL, '2026-02-21 11:52:56', '2026-02-28 11:39:17'),
(12, 8, 3, 1, 'Complete AngularJS Masterclass – Build Dynamic Single Page Applications', 'Learn AngularJS from scratch and build powerful single-page web applications using controllers, directives, services, and routing with real-world projects.', 'Master front-end development with AngularJS and build dynamic, responsive single-page applications (SPAs) from the ground up.\n\nThis course is designed to help you understand AngularJS fundamentals and advanced concepts step by step. You will learn how to structure applications using MVC architecture and build interactive web apps used in real-world projects.', 3499.00, 2999.00, 'intermediate', 'Hindi', 'AngularJS Masterclass, AngularJS Course Online, Learn AngularJS, AngularJS Tutorial, AngularJS for Beginners, AngularJS Single Page Application, Build SPA with AngularJS, AngularJS Web Development, Frontend Development Course, JavaScript Frameworks, MVC JavaScript Framework, AngularJS Projects, Dynamic Web Applications, SPA Development Course, AngularJS Certification Training, Web App Development with AngularJS, Complete AngularJS Masterclass for Beginners, Build Dynamic Single Page Applications with AngularJS, AngularJS from Scratch, Advanced AngularJS Concepts, AngularJS Routing Tutorial, AngularJS Dependency Injection, AngularJS Real World Projects', 'https://yourplatform.com/videos/angularjs-complete-course-promo.mp4', 0, 1, 'complete-angularjs-masterclass-build-dynamic-single-page-applications', 'thumbnails/qGDvnshaOUAaT8LqfyIzMJKmiSerNmChiJBFh5l0.jpg', 2, '2026-02-21 11:59:49', '2026-02-21 11:59:53', NULL, '2026-02-21 11:59:28', '2026-02-22 09:20:10'),
(13, 18, 3, 1, 'Master React Native: Build Cross-Platform Mobile Apps', 'Learn React Native from scratch and build high-quality cross-platform mobile apps for iOS and Android. Master components, navigation, APIs, and deployment.', '- Learn how to use ReactJS to build real native mobile apps for iOS and Android\n- Develop cross-platform (iOS and Android) mobile apps without knowing Swift, Objective-C or Java/Android\n- Explore React Native basics and advanced features\n- Learn how to use key mobile app features like Google Maps or the device camera\n- Build beautiful and responsive user interfaces for mobile apps\n- Understand navigation and routing in React Native applications\n- Manage app state using modern React tools like Hooks and Context API\n- Integrate REST APIs and fetch data from remote servers\n- Store data locally using AsyncStorage and other storage solutions\n- Debug and test React Native apps efficiently\n- Deploy and publish your apps to the Apple App Store and Google Play Store\n- Optimize mobile app performance for better user experience\n- Use third-party libraries to add advanced features quickly\n- Implement authentication and secure user login systems\n- Work with animations and gestures to create interactive apps', 5999.00, 3999.00, 'all_levels', 'Hindi', 'React Native course, Mobile app development, Cross-platform apps, Learn React Native, iOS and Android development, Expo, React Navigation, Build apps, Publish apps, Mobile development online course', 'https://example.com/videos/react-native-intro.mp4', 0, 0, 'master-react-native-build-cross-platform-mobile-apps', 'thumbnails/a0tkSD2W9jThwNcc84elfpqmsYpDG1babSJ17T8w.png', 2, '2026-02-28 11:45:17', '2026-02-28 11:45:23', NULL, '2026-02-28 11:44:12', '2026-03-07 06:31:12'),
(15, 1, 3, NULL, 'Test Demo - Smart E-learning', 'Hello', 'Hello', 0.00, 0.00, 'beginner', 'English', 'hello', NULL, 0, 0, 'test-demo-smart-e-learning', 'thumbnails/h2wDhrmDMZdNRTmz6UBGRSDnI0zpTFtXZcuvmOn4.png', 0, NULL, NULL, NULL, '2026-03-01 10:22:59', '2026-03-01 10:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `course_faqs`
--

CREATE TABLE `course_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_faqs`
--

INSERT INTO `course_faqs` (`id`, `course_id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 'Will this course cover both iOS and Android app development?', 'Yes! This course is designed for cross-platform mobile development using frameworks like React Native. You will learn to build apps that run on both iOS and Android from a single codebase, so you don’t need to write separate code for each platform.', 1, '2026-03-07 07:15:20', '2026-03-07 07:15:20'),
(2, 13, 'Do you teach integration with APIs like Firebase or REST APIs?', 'Yes! This course covers API integration in mobile apps. You’ll learn how to connect your app with REST APIs to fetch and send data, and also how to use Firebase services like authentication, real-time database, and cloud storage to enhance your app’s functionality.', 1, '2026-03-07 07:19:18', '2026-03-07 07:19:18'),
(4, 4, 'Is this course suitable for complete beginners in PHP or Laravel?', 'Yes, the course starts with basic PHP and Laravel fundamentals, so beginners can follow along easily.', 1, '2026-03-08 01:17:42', '2026-03-08 01:21:27'),
(5, 4, 'What software do I need before starting this course?', 'You will need PHP 8.2+, Composer, a local server such as XAMPP or Laravel Sail, and a code editor like VS Code.', 1, '2026-03-08 01:24:34', '2026-03-08 01:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `course_lectures`
--

CREATE TABLE `course_lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_section_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `duration` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_preview` tinyint(1) NOT NULL DEFAULT 0,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_lectures`
--

INSERT INTO `course_lectures` (`id`, `course_section_id`, `title`, `video_path`, `duration`, `is_preview`, `order`, `created_at`, `updated_at`) VALUES
(251, 69, 'Welcome to the Laravel Course', 'https://youtu.be/rXleVXyp-kk?si=arHS8Q7ssx-NY7HE', 8, 1, 1, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(252, 69, 'What is Laravel & Why Choose It?', '', 5, 0, 2, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(253, 69, 'Setting Up Development Environment', '', 10, 0, 3, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(254, 69, 'Overview of MVC Architecture in Laravel', '', 15, 0, 4, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(255, 70, 'Routing in Laravel', '', 4, 0, 1, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(256, 70, 'Controllers and Views', '', 5, 0, 2, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(257, 70, 'Blade Templating Engine Basics', '', 8, 0, 3, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(258, 70, 'Passing Data to Views', '', 12, 0, 4, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(259, 70, 'Basic CRUD Operations', '', 16, 0, 5, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(260, 71, 'Setting Up Database & Migrations', '', 15, 0, 1, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(261, 71, 'Eloquent Models Explained', '', 12, 0, 2, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(262, 71, 'Relationships in Laravel (One-to-One, One-to-Many)', '', 10, 0, 3, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(263, 71, 'Query Builder & Advanced Queries', '', 11, 0, 4, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(264, 71, 'Database Seeding & Factories', '', 15, 0, 5, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(265, 72, 'Authentication & Authorization', '', 8, 0, 1, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(266, 72, 'Middleware & Route Protection', '', 18, 0, 2, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(267, 72, 'File Uploads & Storage', '', 15, 0, 3, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(268, 72, 'Sending Emails & Notifications', '', 12, 0, 4, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(269, 72, 'API Development with Laravel', '', 11, 0, 5, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(270, 73, 'Building a Real-World Project (E-Commerce Example)', '', 25, 0, 1, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(271, 73, 'Debugging & Error Handling', '', 6, 0, 2, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(272, 73, 'Testing Laravel Applications', '', 12, 0, 3, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(273, 73, 'Deployment on Hosting / Cloud (e.g., Laravel Forge)', '', 50, 0, 4, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(274, 73, 'Final Thoughts & Next Steps', '', 5, 0, 5, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(313, 84, 'Welcome to the Course', 'https://youtu.be/kGtEax1WQFg?si=Sx_F-2A358VjDPxC', 5, 1, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(314, 84, ' Installing Environment', '', 3, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(315, 85, 'What is React Native', '', 1, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(316, 85, 'Components & JSX', '', 2, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(317, 85, 'Styling in React Native', '', 3, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(318, 85, 'Navigation Basics', '', 5, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(319, 86, 'useState & useEffect', '', 4, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(320, 86, 'Context API', '', 6, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(321, 86, 'Redux Toolkit Basics', '', 8, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(322, 86, 'Handling Async Data', '', 10, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(323, 87, 'REST API Integration', '', 6, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(324, 87, 'Authentication Flow', '', 10, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(325, 87, 'Secure Token Storage', '', 14, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(326, 87, 'Error Handling', '', 18, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(327, 88, 'Creating Login Screen', '', 10, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(328, 88, 'Building Dashboard UI', '', 20, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(329, 88, 'Preparing App for Production', '', 40, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(330, 88, 'Deploy to Play Store', '', 50, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(331, 89, 'Using React Native Reanimated', '', 5, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(332, 89, 'Creating Smooth Transitions', '', 20, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(333, 89, 'Gesture Handling', '', 10, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(334, 89, 'Building Custom Components', '', 14, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(335, 90, 'Improving App Performance', '', 4, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(336, 90, 'Avoiding Unnecessary Re-renders', '', 6, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(337, 90, 'Optimizing Images & Assets', '', 8, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(338, 90, 'Debugging Performance Issues', '', 10, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(339, 91, 'Debugging with React Native Debugger', '', 5, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(340, 91, 'Writing Unit Tests', '', 6, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(341, 91, 'Testing Components', '', 8, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(342, 91, 'Handling Runtime Errors', '', 10, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(343, 92, 'Accessing Camera', '', 3, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(344, 92, 'Using Location Services', '', 5, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(345, 92, 'Push Notifications', '', 13, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(346, 92, 'Working with Device Storage', '', 16, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(347, 93, 'App Store Deployment', '', 5, 0, 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(348, 93, 'Play Store Deployment', '', 19, 0, 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(349, 93, 'Version Updates Strategy', '', 15, 0, 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(350, 93, 'Post-Launch Maintenance', '', 14, 0, 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_reviews`
--

INSERT INTO `course_reviews` (`id`, `course_id`, `user_id`, `rating`, `review`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 5, 'This course is Awesome & Outstanding for best SmartLMS platfrom Instructor.', 1, '2026-03-08 01:51:46', '2026-03-08 02:09:29'),
(2, 4, 1, 4, 'SmartLMS platfrom is more secure and good E-Learning Platform.', 1, '2026-03-08 02:11:21', '2026-03-08 02:11:32'),
(3, 4, 2, 3, 'Comprehensive and beginner-friendly, covers everything from basics to advanced Laravel features.', 1, '2026-03-08 09:57:22', '2026-03-08 09:58:35'),
(4, 13, 1, 5, 'Excellent app, very smooth and easy to use.\nLoved the experience, highly recommended!', 1, '2026-03-29 03:06:31', '2026-03-29 03:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `course_sections`
--

CREATE TABLE `course_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_sections`
--

INSERT INTO `course_sections` (`id`, `course_id`, `title`, `order`, `created_at`, `updated_at`) VALUES
(69, 4, 'Introduction', 1, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(70, 4, 'Basics of Laravel', 2, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(71, 4, 'Database & Eloquent ORM', 3, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(72, 4, 'Advanced Laravel Features', 4, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(73, 4, 'Project & Deployment', 5, '2026-03-01 05:30:04', '2026-03-01 05:30:04'),
(84, 13, 'Introduction', 1, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(85, 13, ' React Native Fundamentals', 2, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(86, 13, 'State Management', 3, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(87, 13, 'Working with APIs & Backend', 4, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(88, 13, 'Build & Deploy Real App', 5, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(89, 13, 'Advanced UI & Animations', 6, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(90, 13, 'Performance Optimization', 7, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(91, 13, 'Testing & Debugging', 8, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(92, 13, 'Native Modules & Device Features', 9, '2026-03-07 06:31:12', '2026-03-07 06:31:12'),
(93, 13, 'Publishing & Maintenance', 10, '2026-03-07 06:31:12', '2026-03-07 06:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'active', '2026-03-29 01:06:45', '2026-03-29 01:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `marketing_opt_in` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `role_id`, `name`, `email`, `password`, `status`, `marketing_opt_in`, `created_at`, `updated_at`) VALUES
(1, 2, 'Test Demo', 'testdemo01@gmail.com', '$2y$12$gBmxxx94y9d5B1dLIl6k5eiVJEvyn.FT/2Ew.XicVHrYf.xwcik06', '1', 0, '2026-01-30 21:39:02', '2026-01-30 22:38:38'),
(3, 2, 'Chandrakant Modi', 'cmodi119@gmail.com', '$2y$12$dBCJjgI7bM3iZpV/OgZONOaN80snOFdeo1KGQa1NNdOxvHSa3Djci', '1', 0, '2026-01-31 05:41:05', '2026-01-31 05:41:26'),
(4, 2, 'Tech web Modi', 'techwebumang@gmail.com', '$2y$12$W378jRPRI3e4WOKrvmLRceMSByuiJbwGc5lvoOiQpah52JhcEbhcW', '1', 0, '2026-01-31 05:47:27', '2026-01-31 05:47:51'),
(5, 2, 'PinkeyBen Modi', 'pinkeymodi83@gmail.com', '$2y$12$nACXhrIrM09V9mlxMb8RO.UK/riiGCXr.2dalaQQ/JobOwqz9hu7m', '1', 0, '2026-01-31 07:04:49', '2026-01-31 07:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_details`
--

CREATE TABLE `instructor_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructor_details`
--

INSERT INTO `instructor_details` (`id`, `instructor_id`, `avatar`, `headline`, `bio`, `website`, `facebook_url`, `instagram_url`, `linkedin_url`, `youtube_url`, `created_at`, `updated_at`) VALUES
(4, 3, 'images/huB4Ejt2b3CqGtXFXjbGVtDuXr4xk6kL8jN9bX1G.webp', ' Full Stack Developer | Expert in Laravel & Livewire', 'Hello, I am Chandrakant Modi. I have over 10 years of experience in web development and software architecture. My passion lies in teaching complex coding concepts in a simple, easy-to-understand way. I have helped thousands of students launch their careers in the IT industry.', 'https://chandrakantmodi.me', 'https://facebook.com/chandrakant.modi', 'https://linkedin.com/in/chandrakantmodi', 'https://linkedin.com/chandrakantmodi', 'https://youtube.com/c/ChandrakantModiTech', '2026-01-31 11:27:51', '2026-01-31 12:04:46'),
(5, 5, 'images/ZuGV5UYjoT9XpeQCdf9xZ1jjHCPqZslEAhfEas7Q.png', 'Full Stack Developer', 'Hello, I am Pinkeyben Modi. I have over 5 years of experience in web development and software architecture. My passion lies in teaching complex coding concepts in a simple, easy-to-understand way. I have helped thousands of students launch their careers in the IT industry.', 'https://pinkeymodi.me', 'https://facebook.com/pinkeymodi', 'https://linkedin.com/in/pinkeymodi.', 'https://linkedin.com/pinkeymodi.', 'https://youtube.com/c/pinkeymodi.Tech', '2026-02-01 00:14:13', '2026-02-01 00:14:13'),
(6, 1, 'images/eAZbpOeDkQitXHWSh6zf7PSxRg8OINpv2uFjF305.png', 'Senior Software Engineer', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-28 00:44:46', '2026-02-28 00:44:46'),
(7, 4, 'images/JTGHlt2eMxiR2aS5H5wlEKHnOM8ej82I5fGHW9yR.jpg', 'Junior PHP Full Stack Developer', NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-28 00:48:30', '2026-02-28 00:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_18_094532_create_personal_access_tokens_table', 1),
(5, '2026_01_18_095529_create_roles_table', 1),
(6, '2026_01_18_095604_create_user_roles_table', 1),
(7, '2026_01_18_115440_create_user_otp_table', 1),
(8, '2026_01_20_173509_create_role_permission_table', 2),
(9, '2026_01_21_170802_create_users_profile_table', 2),
(10, '2026_01_24_102117_create_role_id_to_users_table', 2),
(11, '2026_01_29_160024_create_admin_table', 2),
(12, '2026_01_29_164740_create_instructor_table', 2),
(13, '2026_01_29_173917_create_instructor_details_table', 2),
(14, '2026_02_01_063027_create_categories_table', 3),
(15, '2026_02_03_041105_create_banners_table', 4),
(16, '2026_02_04_172409_create_courses_table', 5),
(17, '2026_02_05_043626_add_role_id_to_users_profile', 6),
(18, '2026_02_07_170405_fix_courses_foreign_key', 7),
(19, '2026_02_08_091217_add_course_details_to_courses_table', 8),
(20, '2026_03_01_063105_create_course_sections_table', 9),
(21, '2026_03_01_063157_create_course_lectures_table', 9),
(22, '2026_03_07_120940_create_course_faqs_table', 10),
(23, '2026_03_08_070146_create_course_reviews_table', 11),
(24, '2026_03_14_125638_create_telescope_entries_table', 12),
(25, '2026_03_14_141134_create_enrollments_table', 13),
(26, '2026_03_15_065102_create_permissions_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Admin', 1, 'api_token', 'ca7c82eab9764048d5089b60057e6abba482bf99a1aa05238efd91a23b2569d3', '[\"*\"]', '2026-01-31 05:09:50', NULL, '2026-01-31 05:08:22', '2026-01-31 05:09:50'),
(2, 'App\\Models\\User', 1, 'api_token', '76ab566a092ac044c5a04650a58f977b34d137f3dfd189ff5c1e12d7af233f45', '[\"*\"]', NULL, NULL, '2026-01-31 07:07:42', '2026-01-31 07:07:42'),
(3, 'App\\Models\\Instructor', 5, 'instructor_token', 'a21157ecb0ad7974264fad97819386a25de2229e99a2c6266182a548e8d7b6df', '[\"*\"]', NULL, NULL, '2026-02-01 00:23:51', '2026-02-01 00:23:51'),
(4, 'App\\Models\\Instructor', 5, 'instructor_token', '5404d69fb1e2d96293514889907ad74f62a7e3b59cda5d8b63f8fdbf07f39df0', '[\"*\"]', NULL, NULL, '2026-02-01 00:39:25', '2026-02-01 00:39:25'),
(5, 'App\\Models\\Admin', 1, 'api_token', '5d794225d19738bfb3f3899de58f807fab8294dcb857f67d3803b3bcfb381554', '[\"*\"]', '2026-03-01 09:58:44', NULL, '2026-02-01 06:24:28', '2026-03-01 09:58:44'),
(6, 'App\\Models\\Instructor', 5, 'instructor_token', '2e2a4442661a33e9c7a6210b6efe9c6c744c7cb08e8ae6cad8ddba5facb5e595', '[\"*\"]', NULL, NULL, '2026-03-08 05:32:21', '2026-03-08 05:32:21'),
(7, 'App\\Models\\Instructor', 3, 'instructor_token', 'e2f4ae58c40eacc9ba5924e6b955b86ea71af80685aa1d030ceb42b8586f8f33', '[\"*\"]', NULL, NULL, '2026-03-08 05:33:44', '2026-03-08 05:33:44'),
(8, 'App\\Models\\User', 1, 'api_token', 'ec2afc49578132e563fbcc691469b29c60c824c7c53ce58c1e0c00b0cbb74903', '[\"*\"]', NULL, NULL, '2026-03-29 03:42:49', '2026-03-29 03:42:49'),
(9, 'App\\Models\\Admin', 1, 'api_token', '9dfbf61a84e6b6f0c9279833d1789022aff40f293d251e5ca0805b68e385c714', '[\"*\"]', '2026-03-29 08:27:00', NULL, '2026-03-29 08:24:05', '2026-03-29 08:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', '2026-01-30 21:31:29', '2026-01-30 21:31:29'),
(2, 'instructor', '2026-01-30 21:31:29', '2026-01-30 21:31:29'),
(3, 'student', '2026-01-30 21:31:29', '2026-01-30 21:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fdn9VunX1WNHze5BuapDTx5UB4x7bq2z8Oo4dkJG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGZIdEkxUGx6bEJTTmdpekhBWEl1cjloQjlCemlaVzh5dnNyaVJ3VSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb3Vyc2UvbWFzdGVyLXJlYWN0LW5hdGl2ZS1idWlsZC1jcm9zcy1wbGF0Zm9ybS1tb2JpbGUtYXBwcyI7czo1OiJyb3V0ZSI7czoxNDoiY291cnNlLWRldGFpbHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774801588),
('jgwLFfp6xL6wNK8I44lLpRWXW6THVUBnxSIyUQWQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRnF4YlV6a0NtbDU3WWRyQWJmZ2dZTTE5WTlOM2xJU2I2MEs0dXpXdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774792762),
('PY9noPZZ2cyjwEHP9Pb4lrA9s5P7XLypipYB1o8o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjhkOVU5N0VZZWpPMVBKRk9UZnBRZTM0dFYwZUZOclBaU2ZpbzV6OCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb3Vyc2UvbWFzdGVyLXJlYWN0LW5hdGl2ZS1idWlsZC1jcm9zcy1wbGF0Zm9ybS1tb2JpbGUtYXBwcyI7czo1OiJyb3V0ZSI7czoxNDoiY291cnNlLWRldGFpbHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774801589),
('PYOKeyczfqrPyewQ1mXXabNzPNNiVq1L9FF7BaON', 1, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSnVjQnl5VzltcjlNcUZKNk5PSWFFdUtPcFlhdTFpMzZaVnpMRXU4RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb3Vyc2UvbWFzdGVyLXJlYWN0LW5hdGl2ZS1idWlsZC1jcm9zcy1wbGF0Zm9ybS1tb2JpbGUtYXBwcyI7czo1OiJyb3V0ZSI7czoxNDoiY291cnNlLWRldGFpbHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE0OiJvdHBfdXNlcl9lbWFpbCI7czoyMjoidW1hbmdtb2RpMDAzQGdtYWlsLmNvbSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImNhcnQiO2E6MDp7fX0=', 1774774286);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Umang Modi', 'umangmodi003@gmail.com', NULL, '$2y$12$qF0yT67XeJGASZa14vd2SuvPErFN.NPHBGnqIiiqzgTGk63aIEEkW', NULL, '2026-01-30 21:34:04', '2026-01-30 21:34:04', 3),
(2, 'Chandrakant Modi', 'cmodi119@gmail.com', NULL, '$2y$12$ndkan9fIzHsOO9T.HaglxewT0QCVodw.sgRCwrPbxB3bLHdM4.VuW', NULL, '2026-03-08 09:50:57', '2026-03-08 09:50:57', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `user_id`, `role_id`, `dob`, `gender`, `country`, `city`, `language`, `bio`, `avatar`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2026-01-15', 'Male', 'India', 'Patan', 'English', 'I\'m Full Stack Developer..', 'images/LPu6B5tjP1eP7z6mH7HEs7MwRE5sDqY4trLIy7hO.jpg', '9313744239', '2026-01-31 07:06:47', '2026-02-04 23:19:40'),
(3, 1, 1, '2026-02-05', 'Male', 'India', 'Ahmedabad', 'English', 'I\'m System Administrator.', 'images/gOOethGrvp3nF5dnBO9lpWyTRTu57ydfI2aWWnlx.png', '9313744240', '2026-02-04 23:14:42', '2026-02-04 23:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_otp`
--

CREATE TABLE `user_otp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `otp_code` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`),
  ADD KEY `admin_role_id_foreign` (`role_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_order_priority_index` (`order_priority`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_created_by_foreign` (`created_by`);

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
-- Indexes for table `course_faqs`
--
ALTER TABLE `course_faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_faqs_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_lectures_course_section_id_order_index` (`course_section_id`,`order`);

--
-- Indexes for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_reviews_course_id_foreign` (`course_id`),
  ADD KEY `course_reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `course_sections`
--
ALTER TABLE `course_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_sections_course_id_order_index` (`course_id`,`order`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_user_id_foreign` (`user_id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instructor_email_unique` (`email`),
  ADD KEY `instructor_role_id_foreign` (`role_id`);

--
-- Indexes for table `instructor_details`
--
ALTER TABLE `instructor_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_details_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permission_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_profile_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_otp`
--
ALTER TABLE `user_otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_otp_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_roles_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `course_faqs`
--
ALTER TABLE `course_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_lectures`
--
ALTER TABLE `course_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_sections`
--
ALTER TABLE `course_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructor_details`
--
ALTER TABLE `instructor_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_otp`
--
ALTER TABLE `user_otp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_faqs`
--
ALTER TABLE `course_faqs`
  ADD CONSTRAINT `course_faqs_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD CONSTRAINT `course_lectures_course_section_id_foreign` FOREIGN KEY (`course_section_id`) REFERENCES `course_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD CONSTRAINT `course_reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_sections`
--
ALTER TABLE `course_sections`
  ADD CONSTRAINT `course_sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `instructor_details`
--
ALTER TABLE `instructor_details`
  ADD CONSTRAINT `instructor_details_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD CONSTRAINT `users_profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_otp`
--
ALTER TABLE `user_otp`
  ADD CONSTRAINT `user_otp_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
