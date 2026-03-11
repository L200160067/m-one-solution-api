/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `alumnis`;
CREATE TABLE `alumnis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;
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

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `media`;
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `author_id` bigint unsigned DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_author_id_foreign` (`author_id`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `order_column` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `full_description` longtext COLLATE utf8mb4_unicode_ci,
  `features` json DEFAULT NULL,
  `benefits` json DEFAULT NULL,
  `keywords` json DEFAULT NULL,
  `order_column` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
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

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE `team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_github` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint unsigned NOT NULL DEFAULT '5',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `alumnis` (`id`, `name`, `school`, `batch_period`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'Bastian', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2025', 1, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(2, 'Boneta P', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2025', 2, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(3, 'Daffa F', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2025', 3, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(4, 'Denisa R', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2025', 4, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(5, 'Faza', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2025', 5, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(6, 'Haikal', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2025', 6, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(7, 'Iyan', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2025', 7, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(8, 'Zaydan', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2025', 8, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(9, 'Abby', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 1, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(10, 'Afif', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 2, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(11, 'Arkan', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 3, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(12, 'Daffa D', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 4, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(13, 'Dzakwan', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 5, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(14, 'Habib', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 6, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(15, 'Hanif', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 7, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(16, 'Shabri', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 8, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(17, 'Yudha', 'SMK Muhammadiyah 1 Sukoharjo', 'Batch 2024', 9, '2026-03-09 22:15:13', '2026-03-09 22:15:13');


INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'web-development', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(2, 'Mobile App', 'mobile-app', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(3, 'Tips & Trik', 'tips-trik', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(4, 'Digital Marketing', 'digital-marketing', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(5, 'Design', 'design', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(6, 'Security', 'security', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(7, 'Cloud', 'cloud', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(8, 'Data', 'data', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(9, 'Management', 'management', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(10, 'Technology', 'technology', '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(11, 'dummy', 'dummy', '2026-03-10 05:27:40', '2026-03-10 05:27:40');


INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"977bd53e-a630-4a9c-805d-e9b0207ed6d9\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:1;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217293,\"delay\":null}', 0, NULL, 1773217293, 1773217293),
(2, 'default', '{\"uuid\":\"438bc6ba-b7fa-42c1-9b68-c91e0d241bdc\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:2;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217295,\"delay\":null}', 0, NULL, 1773217295, 1773217295),
(3, 'default', '{\"uuid\":\"ffac80cf-b64d-47af-bb3a-65cf1f94126c\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:3;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217297,\"delay\":null}', 0, NULL, 1773217297, 1773217297),
(4, 'default', '{\"uuid\":\"c9fb7788-b607-4d3a-ba9e-d3b94cd01852\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:4;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217300,\"delay\":null}', 0, NULL, 1773217300, 1773217300),
(5, 'default', '{\"uuid\":\"830b7359-d980-46e0-9900-30816ea5b8dd\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:5;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217302,\"delay\":null}', 0, NULL, 1773217302, 1773217302),
(6, 'default', '{\"uuid\":\"d57bd772-8018-43de-8434-45db1cbeec18\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:6;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217304,\"delay\":null}', 0, NULL, 1773217304, 1773217304),
(7, 'default', '{\"uuid\":\"1742105a-eccc-42e7-b395-db336b564d56\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:7;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217306,\"delay\":null}', 0, NULL, 1773217306, 1773217306),
(8, 'default', '{\"uuid\":\"dbae332c-875b-4892-8292-20714e67595b\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:8;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217309,\"delay\":null}', 0, NULL, 1773217309, 1773217309),
(9, 'default', '{\"uuid\":\"e9a0f630-6c33-460b-a2c3-17d4483132a1\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:9;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217311,\"delay\":null}', 0, NULL, 1773217311, 1773217311),
(10, 'default', '{\"uuid\":\"3827335b-4aca-474a-9abe-6cc72525bf97\",\"displayName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\RevalidateFrontendCacheJob\\\":3:{s:10:\\\"modelClass\\\";s:18:\\\"App\\\\Models\\\\Setting\\\";s:7:\\\"modelId\\\";i:10;s:4:\\\"tags\\\";a:1:{i:0;s:8:\\\"settings\\\";}}\",\"batchId\":null},\"createdAt\":1773217313,\"delay\":null}', 0, NULL, 1773217313, 1773217313);
INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\TeamMember', 1, '7eebc992-1aa0-41bb-a055-3846d4e95fe2', 'avatar', 'Alfarez', '01KKAC8TYGH1503J772WMEKGVC.webp', 'image/webp', 'public', 'public', 359350, '[]', '[]', '[]', '[]', 1, '2026-03-09 22:42:48', '2026-03-09 22:42:48'),
(3, 'App\\Models\\Alumni', 1, '81d5b7ff-a883-4f9a-81b5-074d669b53cf', 'photo', 'Bastian', '01KKAD8HRX6SDZ667A79Q20B3M.webp', 'image/webp', 'public', 'public', 397612, '[]', '[]', '[]', '[]', 1, '2026-03-09 23:00:07', '2026-03-09 23:00:07'),
(4, 'App\\Models\\Post', 10, '48e4252e-b0d5-4080-ab50-3e88ddce2c60', 'cover', 'IMG_20260221_092630', '01KKADZY5SRF61G385ZAZJ18ZD.jpg', 'image/jpeg', 'public', 'public', 1626058, '[]', '[]', '{\"thumb\": true}', '[]', 1, '2026-03-09 23:12:53', '2026-03-10 05:34:09'),
(6, 'App\\Models\\Alumni', 2, '5e52e0fd-59fc-41b7-8718-5bf71ef0b9cc', 'photo', 'Boneta-P', '01KKAG27Z711YVE2XF5X9KQYBV.webp', 'image/webp', 'public', 'public', 359516, '[]', '[]', '[]', '[]', 1, '2026-03-09 23:49:06', '2026-03-09 23:49:06'),
(7, 'App\\Models\\Post', 1, '2eb44894-09de-4d81-ab2b-f55a1e702d8c', 'cover', 'IMG_20260103_064423', '01KKAGB2ANGQRDHVRNEZCQF5FE.jpg', 'image/jpeg', 'public', 'public', 1018344, '[]', '[]', '{\"thumb\": true}', '[]', 1, '2026-03-09 23:53:55', '2026-03-10 05:34:09'),
(8, 'App\\Models\\Post', 2, '81119d5c-e955-4cdb-a05e-fd6011b48056', 'cover', 'IMG_20260221_091840', '01KKAGBQ0CXERMEDPC8H49VS3R.jpg', 'image/jpeg', 'public', 'public', 1110387, '[]', '[]', '{\"thumb\": true}', '[]', 1, '2026-03-09 23:54:16', '2026-03-10 05:34:10'),
(9, 'App\\Models\\Service', 1, '87dc649d-6ed2-489c-9760-148b14af1346', 'image', 'IMG_20260221_092506', '01KKAGC8PXA2YQ0ZCB9EY2S3EM.jpg', 'image/jpeg', 'public', 'public', 1982725, '[]', '[]', '{\"thumb\": true}', '[]', 1, '2026-03-09 23:54:35', '2026-03-10 05:34:10'),
(10, 'App\\Models\\Alumni', 3, '65c337ce-eff2-4552-a639-8de055a0f004', 'photo', 'Daffa-F', '01KKAGDYT093BYAF5AH2KSEKR0.webp', 'image/webp', 'public', 'public', 198708, '[]', '[]', '[]', '[]', 1, '2026-03-09 23:55:30', '2026-03-09 23:55:30'),
(11, 'App\\Models\\Alumni', 4, 'db5f6d48-60f0-44ec-ba63-4c3e355e09a3', 'photo', 'Denisa-R', '01KKAGJT03CWS53HT4BZ899S3D.webp', 'image/webp', 'public', 'public', 211240, '[]', '[]', '[]', '[]', 1, '2026-03-09 23:58:09', '2026-03-09 23:58:09'),
(12, 'App\\Models\\Alumni', 5, '7e05b300-71a6-4405-8fa4-09ee0404e26c', 'photo', 'Faza', '01KKB3BX5R3CQB6JCPQH6YH8MD.webp', 'image/webp', 'public', 'public', 189908, '[]', '[]', '[]', '[]', 1, '2026-03-10 05:26:27', '2026-03-10 05:26:27'),
(13, 'App\\Models\\Post', 11, '5246e7c3-1445-4992-b66f-e0e75e6e5b56', 'cover', 'IMG_20260221_092506', '01KKB3FD9DXBNEXK37H1MBQQ1X.jpg', 'image/jpeg', 'public', 'public', 1982725, '[]', '[]', '{\"thumb\": true}', '[]', 1, '2026-03-10 05:28:21', '2026-03-10 05:34:13'),
(14, 'App\\Models\\Post', 12, '7450cd68-44c8-441d-b6bc-3450ee515ad8', 'cover', 'IMG_20260221_092526', '01KKB5G13NN7VDRJ91GM9P6MK3.jpg', 'image/jpeg', 'public', 'public', 1977169, '[]', '[]', '{\"thumb\": true}', '[]', 1, '2026-03-10 06:03:38', '2026-03-10 06:03:40'),
(15, 'App\\Models\\Alumni', 6, 'cba2ded1-e045-4456-b578-4605a54ccabe', 'photo', 'Haikal', '01KKB5T46807JCVSCE7AV55Z4K.webp', 'image/webp', 'public', 'public', 308704, '[]', '[]', '[]', '[]', 1, '2026-03-10 06:09:09', '2026-03-10 06:09:09'),
(16, 'App\\Models\\Post', 3, '013cf4f7-f3ca-4e73-9096-fc902c9a34a2', 'cover', 'IMG_20260221_092924', '01KKC5VV90MTTCF83MB4DSP0WW.jpg', 'image/jpeg', 'public', 'public', 1823929, '[]', '[]', '[]', '[]', 1, '2026-03-10 15:29:20', '2026-03-10 15:29:20'),
(17, 'App\\Models\\Post', 9, '21140677-8386-4fea-bc5a-5097d71376d7', 'cover', 'IMG_20260221_093801', '01KKC5XQRT3JSXTAJ4P9W6WA8T.jpg', 'image/jpeg', 'public', 'public', 1750416, '[]', '[]', '[]', '[]', 1, '2026-03-10 15:30:22', '2026-03-10 15:30:22'),
(18, 'App\\Models\\Post', 8, 'b945b140-153f-4bfc-8363-5fe811c5403a', 'cover', 'IMG_20260224_095005', '01KKC60TYA1NY4943PWASH8C3T.jpg', 'image/jpeg', 'public', 'public', 2544978, '[]', '[]', '[]', '[]', 1, '2026-03-10 15:32:03', '2026-03-10 15:32:03'),
(19, 'App\\Models\\Post', 13, '99f73336-ee89-4b57-b734-26814c13751b', 'cover', 'Mutuharjo Cyber Security', '01KKC6276S3DGKGF6Q6XDJQPJD.jpg', 'image/jpeg', 'public', 'public', 742332, '[]', '[]', '[]', '[]', 1, '2026-03-10 15:32:48', '2026-03-10 15:32:48'),
(20, 'App\\Models\\Post', 14, 'da84a28d-505f-4a37-92ee-ccf23b661c54', 'cover', 'IMG_20260224_095214', '01KKC6BC9NF4R83CSN3MJ52D2V.jpg', 'image/jpeg', 'public', 'public', 2692234, '[]', '[]', '[]', '[]', 1, '2026-03-10 15:37:49', '2026-03-10 15:37:49'),
(21, 'App\\Models\\Post', 7, 'e541dc07-bb86-49e4-a29a-4734109cfd3d', 'cover', 'IMG_20260221_092244', '01KKC6DN02WHYTVD1AJX36F25K.jpg', 'image/jpeg', 'public', 'public', 1913533, '[]', '[]', '[]', '[]', 1, '2026-03-10 15:39:03', '2026-03-10 15:39:03'),
(22, 'App\\Models\\Post', 15, '25808c32-79e4-4f72-93c9-8a1d0ca9d8e2', 'cover', 'IMG_20260221_092506', '01KKC74XD4QVQ1AZH5BNB64N2X.jpg', 'image/jpeg', 'public', 'public', 1982725, '[]', '[]', '[]', '[]', 1, '2026-03-10 15:51:45', '2026-03-10 15:51:45'),
(23, 'App\\Models\\Post', 4, 'acc99952-be98-44dc-96fd-3a5a35d56890', 'cover', 'IMG_20260221_093903', '01KKC7EPJHMXFV3FZYNJHA627K.jpg', 'image/jpeg', 'public', 'public', 1634772, '[]', '[]', '[]', '[]', 1, '2026-03-10 15:57:06', '2026-03-10 15:57:06'),
(24, 'App\\Models\\Post', 16, 'bcca102d-f6fe-4faf-b360-444f99c4ae03', 'cover', 'IMG_20260221_092400', '01KKC87CXH7CYS9XA584FCZ9DN.jpg', 'image/jpeg', 'public', 'public', 2643949, '[]', '[]', '[]', '[]', 1, '2026-03-10 23:10:35', '2026-03-10 23:10:35'),
(25, 'App\\Models\\Alumni', 7, 'ab3f317d-aca5-47e7-acbf-70b31572a03e', 'photo', 'Iyan', '01KKC8M656NV6SPA3Z7DR6X6DA.webp', 'image/webp', 'public', 'public', 243740, '[]', '[]', '[]', '[]', 1, '2026-03-10 23:17:34', '2026-03-10 23:17:34'),
(26, 'App\\Models\\Alumni', 8, 'c9f157f3-094b-4f13-b934-3cc8289bc5b8', 'photo', 'Zaydan', '01KKC8ZTXK196YSXS607HJSZC8.webp', 'image/webp', 'public', 'public', 264220, '[]', '[]', '[]', '[]', 1, '2026-03-10 23:23:56', '2026-03-10 23:23:56'),
(27, 'App\\Models\\Alumni', 9, 'cb977804-e0f6-4fd8-9114-7466c354d40e', 'photo', 'Abby', '01KKC9NANV0G1ADYC3KC983WHR.webp', 'image/webp', 'public', 'public', 209438, '[]', '[]', '[]', '[]', 1, '2026-03-10 23:35:40', '2026-03-10 23:35:40'),
(28, 'App\\Models\\Alumni', 10, '9ce8c418-e6e2-4f78-b606-aff32df97525', 'photo', 'Afif', '01KKC9WT4AQQX7A97V7G20XQK4.webp', 'image/webp', 'public', 'public', 231834, '[]', '[]', '[]', '[]', 1, '2026-03-10 23:39:46', '2026-03-10 23:39:46'),
(29, 'App\\Models\\TeamMember', 2, '1ce2a93c-98e6-452c-9f4a-10373ccb38f7', 'avatar', 'Boneta-P', '01KKC9XNJMBX2Q1111YB3ZS7BT.webp', 'image/webp', 'public', 'public', 359516, '[]', '[]', '[]', '[]', 1, '2026-03-10 23:40:14', '2026-03-10 23:40:14'),
(30, 'App\\Models\\Alumni', 11, 'c3a093f4-b511-495f-9ec4-2cd44073fb53', 'photo', 'Arkan', '01KKCCEHEYNXMCK6XAMHVRQ8T2.webp', 'image/webp', 'public', 'public', 245582, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:24:24', '2026-03-11 00:24:24'),
(31, 'App\\Models\\Alumni', 12, '0ef16fad-29d5-4a91-88f1-86a973918bcc', 'photo', 'Daffa-D', '01KKCCF6A0QVF5S842ZEC1QXV3.webp', 'image/webp', 'public', 'public', 245472, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:24:45', '2026-03-11 00:24:45'),
(32, 'App\\Models\\Alumni', 13, 'fa9d99d7-4eb8-4eff-bba5-61361cdd8e7e', 'photo', 'Dzakwan', '01KKCCFN5DW3WSB8ZWJV1BSQ8K.webp', 'image/webp', 'public', 'public', 255246, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:25:00', '2026-03-11 00:25:00'),
(33, 'App\\Models\\Alumni', 14, '3caa99ee-073a-4986-96ec-e4eb3a7976b7', 'photo', 'Habib', '01KKCCGAMDCRMHWGYF9GZKRZ5E.webp', 'image/webp', 'public', 'public', 259630, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:25:22', '2026-03-11 00:25:22'),
(34, 'App\\Models\\Alumni', 15, 'c48b0a51-6901-4805-be6b-28bcb83c0acd', 'photo', 'Hanif', '01KKCCGTGRCM54DW5EESYGMB68.webp', 'image/webp', 'public', 'public', 238026, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:25:38', '2026-03-11 00:25:38'),
(35, 'App\\Models\\Alumni', 16, '6b2fa477-3831-44ae-853b-bad4f380454d', 'photo', 'Shabri', '01KKCCHA99B70N5VBSA1MAT0JP.webp', 'image/webp', 'public', 'public', 241562, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:25:55', '2026-03-11 00:25:55'),
(36, 'App\\Models\\Alumni', 17, 'd1cc9027-4405-4923-a690-40907c5f3e29', 'photo', 'Yudha', '01KKCCHYY2CD9CQPPF8YW2K023.webp', 'image/webp', 'public', 'public', 214662, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:26:16', '2026-03-11 00:26:16'),
(37, 'App\\Models\\Partner', 1, '1ca6e411-5dd5-46b7-b005-f737951fb62e', 'logo', 'partner-1', '01KKCCK8DMPC20XY3Y57P2S01V.webp', 'image/webp', 'public', 'public', 207152, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:26:58', '2026-03-11 00:26:58'),
(38, 'App\\Models\\Partner', 2, '17ad92b3-89dc-456e-8345-b532ede00f55', 'logo', 'partner-2', '01KKCCM2RFFXE8MQXZ3HR8ZF5V.webp', 'image/webp', 'public', 'public', 268610, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:27:25', '2026-03-11 00:27:25'),
(39, 'App\\Models\\Partner', 3, 'ec125f57-8d30-4b16-9e53-21aa27a1c79a', 'logo', 'partner-3', '01KKCCN3QMZEXWAXR4RHSGS1ZT.webp', 'image/webp', 'public', 'public', 258108, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:27:59', '2026-03-11 00:27:59'),
(40, 'App\\Models\\Partner', 4, '8ce4a1b0-a7c7-47d9-9e79-90cacea38f75', 'logo', 'partner-4', '01KKCCP1DVS4R653TBM2WKMJF5.webp', 'image/webp', 'public', 'public', 879484, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:28:29', '2026-03-11 00:28:29'),
(41, 'App\\Models\\Partner', 5, '0cbfb031-de44-4e0e-9565-e6e72f99cc49', 'logo', 'partner-5', '01KKCCQA8QV83FDY8D9ZS1RBDV.webp', 'image/webp', 'public', 'public', 260082, '[]', '[]', '[]', '[]', 1, '2026-03-11 00:29:11', '2026-03-11 00:29:11'),
(42, 'App\\Models\\Partner', 6, '121c8701-692f-426f-840b-02fec71ab807', 'logo', 'partner-6', '01KKCXA9ET4VXRK354TY69B8QR.webp', 'image/webp', 'public', 'public', 451668, '[]', '[]', '[]', '[]', 1, '2026-03-11 05:19:10', '2026-03-11 05:19:10'),
(43, 'App\\Models\\Partner', 7, 'ae82e6f9-857f-46d8-9b7c-61d0907be48d', 'logo', 'partner-7', '01KKCXB5CNZXEQHH8H108PA2Z4.webp', 'image/webp', 'public', 'public', 753536, '[]', '[]', '[]', '[]', 1, '2026-03-11 05:19:39', '2026-03-11 05:19:39'),
(44, 'App\\Models\\Project', 1, 'ef70fe32-603f-4a19-8238-1eda4019b7a4', 'image', '43', '01KKD1CCKS205RY6EAKNYKGV3Z.png', 'image/png', 'public', 'public', 3237477, '[]', '[]', '{\"webp\": true, \"thumb\": true}', '[]', 1, '2026-03-11 06:30:13', '2026-03-11 06:30:15'),
(45, 'App\\Models\\TeamMember', 3, 'b3381d5f-ecd5-49e8-a9b0-b405935e6372', 'avatar', 'Arkan', '01KKDFVQKKBSX0A1D28YPKQQ51.webp', 'image/webp', 'public', 'public', 245582, '[]', '[]', '{\"webp\": true}', '[]', 1, '2026-03-11 10:43:18', '2026-03-11 10:43:20'),
(46, 'App\\Models\\TeamMember', 4, '5e8d94f0-2b30-46cd-8662-ec55ca37de9e', 'avatar', 'Denisa-R', '01KKDFY65WPMQ0WCCPM9CSEDNB.webp', 'image/webp', 'public', 'public', 211240, '[]', '[]', '{\"webp\": true}', '[]', 1, '2026-03-11 10:44:37', '2026-03-11 10:44:37'),
(47, 'App\\Models\\TeamMember', 5, '0bd204be-78e4-48f9-8655-644512900a61', 'avatar', 'Habib', '01KKDG1TQFDTRHGHNM8M0F2KWR.webp', 'image/webp', 'public', 'public', 259630, '[]', '[]', '{\"webp\": true}', '[]', 1, '2026-03-11 10:46:36', '2026-03-11 10:46:37'),
(49, 'App\\Models\\TeamMember', 7, 'e97405ad-f625-4dc7-b933-947e521cbe0d', 'avatar', 'Afif', '01KKDH1TKKVCR50XFVZW7M4N4G.webp', 'image/webp', 'public', 'public', 231834, '[]', '[]', '{\"webp\": true}', '[]', 1, '2026-03-11 11:04:04', '2026-03-11 11:04:05');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_09_212547_create_permission_tables', 1),
(5, '2026_03_09_212549_create_media_table', 1),
(6, '2026_03_09_212713_create_categories_table', 1),
(7, '2026_03_09_212715_create_posts_table', 1),
(8, '2026_03_09_212718_create_services_table', 1),
(9, '2026_03_09_212720_create_projects_table', 1),
(10, '2026_03_09_212722_create_team_members_table', 1),
(11, '2026_03_09_212724_create_alumnis_table', 1),
(12, '2026_03_09_212727_create_testimonials_table', 1),
(13, '2026_03_09_212729_create_partners_table', 1),
(14, '2026_03_09_212731_create_settings_table', 1),
(15, '2026_03_11_061914_create_personal_access_tokens_table', 1);

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);
INSERT INTO `partners` (`id`, `name`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'SD N Cabeyan 2 Sukoharjo', 1, '2026-03-09 22:15:13', '2026-03-11 00:26:58'),
(2, 'SDII Nurul Musthofa', 2, '2026-03-09 22:15:13', '2026-03-11 00:27:25'),
(3, 'Pengus Daerah Muhammadiyah Sukoharjo', 3, '2026-03-09 22:15:13', '2026-03-11 00:27:59'),
(4, 'MI Muhammadiyah Toriyo', 4, '2026-03-09 22:15:13', '2026-03-11 00:28:29'),
(5, 'MI Muhammadiyah Bendungan', 5, '2026-03-11 00:29:09', '2026-03-11 00:29:09'),
(6, 'MI Muhammadiyah Karanglo', 6, '2026-03-11 05:19:10', '2026-03-11 05:19:10'),
(7, 'MI Muhammadiyah PK Sukoharjo', 0, '2026-03-11 05:19:39', '2026-03-11 05:19:39');



INSERT INTO `posts` (`id`, `title`, `slug`, `excerpt`, `content`, `category_id`, `author_id`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pentingnya Website Profesional untuk Bisnis di Era Digital', 'pentingnya-website-untuk-bisnis', 'Di era digital ini, memiliki website bukan lagi pilihan, melainkan keharusan bagi setiap bisnis yang ingin berkembang.', 'Di era digital ini, memiliki website bukan lagi pilihan, melainkan keharusan bagi setiap bisnis yang ingin berkembang. Website berfungsi sebagai etalase digital yang buka 24/7, memungkinkan calon pelanggan menemukan produk atau layanan Anda kapan saja dan di mana saja. Selain itu, website profesional meningkatkan kredibilitas bisnis Anda di mata konsumen. Dengan desain yang menarik, navigasi yang mudah, dan informasi yang lengkap, website dapat menjadi alat pemasaran yang sangat efektif. M-One Solution siap membantu Anda mewujudkan website impian yang tidak hanya indah dipandang, tetapi juga fungsional dan mampu mendorong pertumbuhan bisnis Anda.', 1, 1, '2023-10-12 08:00:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(2, 'Tren Pengembangan Aplikasi Mobile di Tahun 2024', 'tren-aplikasi-mobile-2024', 'Dunia pengembangan aplikasi mobile terus berkembang pesat. Mari kita lihat tren apa saja yang akan mendominasi di tahun 2024.', 'Dunia pengembangan aplikasi mobile terus berkembang pesat. Pertama, integrasi kecerdasan buatan (AI) dan machine learning (ML) akan semakin masif, memberikan pengalaman pengguna yang lebih personal dan cerdas. Kedua, pengembangan aplikasi lintas platform (cross-platform) menggunakan framework seperti React Native dan Flutter akan terus populer karena efisiensi waktu dan biaya. Ketiga, fokus pada keamanan data dan privasi pengguna akan menjadi prioritas utama, seiring dengan meningkatnya kesadaran akan pentingnya perlindungan informasi pribadi.', 2, 1, '2023-11-05 09:00:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(3, 'Tips Memilih Software House yang Tepat untuk Proyek Anda', 'tips-memilih-software-house', 'Memilih partner teknologi yang tepat adalah kunci kesuksesan proyek digital Anda.', 'Memilih partner teknologi yang tepat adalah kunci kesuksesan proyek digital Anda. Pertama, periksa portofolio mereka untuk melihat kualitas dan jenis proyek yang pernah mereka kerjakan. Kedua, pastikan mereka memiliki tim yang kompeten dan berpengalaman dalam teknologi yang relevan dengan kebutuhan Anda. Ketiga, perhatikan cara mereka berkomunikasi dan merespons pertanyaan Anda; komunikasi yang baik sangat penting untuk kelancaran proyek.', 3, 1, '2023-12-20 10:00:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(4, 'Manfaat SEO untuk Meningkatkan Trafik Website Anda', 'manfaat-seo-untuk-website', 'SEO adalah strategi penting untuk memastikan website Anda mudah ditemukan di mesin pencari seperti Google.', 'SEO (Search Engine Optimization) adalah strategi penting untuk memastikan website Anda mudah ditemukan di mesin pencari seperti Google. Dengan menerapkan teknik SEO yang tepat, Anda dapat meningkatkan peringkat website Anda di hasil pencarian, yang pada gilirannya akan meningkatkan jumlah pengunjung organik. Hal ini sangat penting karena sebagian besar pengguna internet hanya mengklik hasil pencarian di halaman pertama.', 4, 1, '2024-01-15 07:00:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(5, 'Mengenal Perbedaan UI dan UX Design', 'mengenal-ui-ux-design', 'UI dan UX seringkali dianggap sama, padahal keduanya memiliki peran yang berbeda dalam pengembangan produk digital.', 'UI (User Interface) dan UX (User Experience) seringkali dianggap sama, padahal keduanya memiliki peran yang berbeda dalam pengembangan produk digital. UI berfokus pada tampilan visual, seperti warna, tipografi, dan tata letak elemen. Sementara itu, UX berfokus pada pengalaman pengguna secara keseluruhan, termasuk kemudahan penggunaan, efisiensi, dan kepuasan pengguna.', 5, 1, '2024-02-02 08:30:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(6, 'Pentingnya Keamanan Siber untuk Melindungi Bisnis Anda', 'keamanan-siber-untuk-bisnis', 'Ancaman keamanan siber semakin meningkat. Pelajari cara melindungi data dan sistem bisnis Anda dari serangan siber.', 'Ancaman keamanan siber semakin meningkat. Serangan siber dapat menyebabkan kerugian finansial yang besar, kerusakan reputasi, dan hilangnya kepercayaan pelanggan. Oleh karena itu, sangat penting bagi setiap bisnis untuk menerapkan langkah-langkah keamanan siber yang kuat, seperti menggunakan firewall, mengenkripsi data sensitif, dan memberikan pelatihan kesadaran keamanan kepada karyawan.', 6, 1, '2024-02-20 09:00:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(7, 'Meningkatkan Efisiensi Bisnis dengan Cloud Computing', 'cloud-computing-untuk-efisiensi', 'Cloud computing menawarkan banyak manfaat bagi bisnis, termasuk fleksibilitas, skalabilitas, dan efisiensi biaya.', 'Cloud computing menawarkan banyak manfaat bagi bisnis, termasuk fleksibilitas, skalabilitas, dan efisiensi biaya. Dengan menggunakan layanan cloud, Anda tidak perlu lagi berinvestasi dalam infrastruktur TI fisik yang mahal. Anda dapat mengakses data dan aplikasi Anda dari mana saja dan kapan saja, asalkan terhubung ke internet.', 7, 1, '2024-03-10 08:00:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(8, 'Mengapa Data Analytics Penting untuk Pengambilan Keputusan', 'pentingnya-data-analytics', 'Data analytics dapat memberikan wawasan berharga yang membantu Anda membuat keputusan bisnis yang lebih baik.', 'Data analytics dapat memberikan wawasan berharga yang membantu Anda membuat keputusan bisnis yang lebih baik. Dengan menganalisis data pelanggan, penjualan, dan operasional, Anda dapat mengidentifikasi tren, pola, dan peluang baru. Hal ini memungkinkan Anda untuk mengoptimalkan strategi pemasaran, meningkatkan efisiensi operasional, dan mengembangkan produk atau layanan baru yang sesuai dengan kebutuhan pelanggan.', 8, 1, '2024-03-25 09:30:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(9, 'Tips Membangun Tim Developer yang Solid dan Produktif', 'membangun-tim-developer-yang-solid', 'Tim developer yang solid adalah kunci kesuksesan proyek perangkat lunak.', 'Tim developer yang solid adalah kunci kesuksesan proyek perangkat lunak. Pertama, rekrut orang-orang dengan keterampilan dan pengalaman yang tepat. Kedua, ciptakan budaya kerja yang positif dan kolaboratif. Ketiga, berikan pelatihan dan pengembangan berkelanjutan kepada anggota tim. Keempat, gunakan alat dan metodologi pengembangan yang tepat, seperti Agile atau Scrum.', 9, 1, '2024-04-05 08:00:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(10, 'Masa Depan Kecerdasan Buatan (AI) di Berbagai Industri', 'masa-depan-kecerdasan-buatan', 'Kecerdasan buatan (AI) sedang mengubah cara kita hidup dan bekerja.', 'Kecerdasan buatan (AI) sedang mengubah cara kita hidup dan bekerja. Di bidang kesehatan, AI dapat digunakan untuk mendiagnosis penyakit, mengembangkan obat baru, dan memberikan perawatan yang lebih personal. Di bidang keuangan, AI dapat digunakan untuk mendeteksi penipuan, mengelola risiko, dan memberikan layanan pelanggan yang lebih baik.', 10, 1, '2024-04-18 10:00:00', '2026-03-09 22:15:12', '2026-03-09 22:15:12', NULL),
(11, 'Dummy', 'dummy', 'dummy post', '<p>ini adalah dummy post</p>', 11, NULL, '2026-03-10 12:27:43', '2026-03-10 05:28:20', '2026-03-10 15:28:54', '2026-03-10 15:28:54'),
(12, 'test', 'test', 'kjhkhkj', '<p>dasdsadas</p>', 7, NULL, '2026-03-10 13:03:07', '2026-03-10 06:03:38', '2026-03-10 15:28:45', '2026-03-10 15:28:45'),
(13, 'Dummy -Data', 'dummy-data', 'asdasdasd', '<p>dadasdsad</p>', 8, NULL, '2026-03-10 22:40:13', '2026-03-10 15:32:48', '2026-03-10 16:01:27', '2026-03-10 16:01:27'),
(14, 'my bini', 'my-bini', 'asdasdasd', '<p>asdasdas</p>', 5, NULL, '2026-03-10 22:40:49', '2026-03-10 15:37:48', '2026-03-11 05:17:54', '2026-03-11 05:17:54'),
(15, 'uh uh', 'uh-uh', 'adasdasd', '<p>asdasda</p>', 4, NULL, '2026-03-10 22:54:23', '2026-03-10 15:51:45', '2026-03-11 05:17:54', '2026-03-11 05:17:54'),
(16, 'masuk angin', 'masuk-angin', 'dasdasd', '<p>asdasdas</p>', 10, NULL, '2026-03-10 23:10:20', '2026-03-10 23:10:35', '2026-03-11 05:17:49', '2026-03-11 05:17:49');
INSERT INTO `projects` (`id`, `title`, `slug`, `category`, `description`, `client_name`, `project_url`, `is_featured`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'Website Sekolah', 'website-sekolah', 'Web Development', 'Platform digital interaktif untuk institusi pendidikan yang mencakup manajemen konten, berita sekolah, dan galeri foto.', 'SMK Muhammadiyah 1 Sukoharjo', NULL, 1, 1, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(2, 'Aplikasi Organisasi', 'aplikasi-organisasi', 'Mobile App', 'Sistem manajemen terpadu untuk efisiensi organisasi, mencakup manajemen anggota, agenda, dan pelaporan.', 'Organisasi Pemuda Sukoharjo', NULL, 1, 2, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(3, 'E-Commerce Platform', 'ecommerce-platform', 'Web App', 'Solusi toko online modern dengan fitur lengkap: manajemen produk, keranjang belanja, pembayaran, dan laporan penjualan.', 'Batik Berkah', NULL, 1, 3, '2026-03-09 22:15:12', '2026-03-09 22:15:12');

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2026-03-11 15:21:30', '2026-03-11 15:21:30'),
(2, 'editor', 'web', '2026-03-11 15:21:30', '2026-03-11 15:21:30');
INSERT INTO `services` (`id`, `title`, `slug`, `category`, `short_description`, `full_description`, `features`, `benefits`, `keywords`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'web-development', 'Development', 'Pembuatan website profesional yang responsif, cepat, dan dioptimalkan untuk mesin pencari (SEO).', 'Layanan Web Development kami mencakup pembuatan website dari awal hingga peluncuran. Kami menggunakan teknologi terbaru untuk memastikan website Anda tidak hanya terlihat menarik, tetapi juga memiliki performa tinggi, aman, dan mudah diakses dari berbagai perangkat. Cocok untuk bisnis skala kecil hingga besar yang ingin meningkatkan kehadiran digital mereka.', '[\"Desain Responsif (Mobile-Friendly)\", \"Optimasi SEO Dasar\", \"Integrasi CMS (Content Management System)\", \"Keamanan Tingkat Lanjut\", \"Performa Cepat & Optimal\", \"Dukungan Teknis & Pemeliharaan\"]', '[\"Meningkatkan kredibilitas bisnis Anda di dunia digital.\", \"Menjangkau lebih banyak calon pelanggan secara online.\", \"Memberikan pengalaman pengguna (UX) yang memuaskan.\", \"Mudah dikelola dan diperbarui kontennya.\"]', '[\"jasa pembuatan website\", \"web development\", \"bikin web\", \"jasa web SEO\", \"website responsif\", \"jasa website profesional\"]', 1, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(2, 'Sistem Informasi Sekolah', 'sistem-informasi-sekolah', 'Sistem Informasi', 'Platform digital terpadu untuk mengelola administrasi, akademik, dan komunikasi di lingkungan sekolah.', 'Sistem Informasi Sekolah (SIS) kami dirancang khusus untuk memenuhi kebutuhan institusi pendidikan modern. Platform ini mengintegrasikan berbagai modul mulai dari penerimaan siswa baru, manajemen nilai, absensi, hingga keuangan. Dengan antarmuka yang ramah pengguna, SIS memudahkan guru, staf administrasi, siswa, dan orang tua untuk berinteraksi dan mengakses informasi secara real-time.', '[\"Manajemen Data Siswa & Guru\", \"Sistem Absensi Digital\", \"Portal Nilai & Rapor Online\", \"Manajemen Keuangan & Pembayaran SPP\", \"Jadwal Pelajaran & Kalender Akademik\", \"Portal Komunikasi Orang Tua & Sekolah\"]', '[\"Meningkatkan efisiensi administrasi sekolah.\", \"Memudahkan pemantauan perkembangan akademik siswa.\", \"Transparansi keuangan dan kemudahan pembayaran.\", \"Meningkatkan komunikasi antara sekolah dan orang tua.\"]', '[\"sistem informasi sekolah\", \"aplikasi sekolah\", \"software sekolah\", \"manajemen sekolah\", \"sistem akademik\", \"e-learning sekolah\"]', 2, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(3, 'Company Profile Website', 'company-profile-website', 'Profil Perusahaan', 'Website profil perusahaan yang elegan dan profesional untuk membangun citra merek yang kuat.', 'Website Company Profile adalah wajah digital bisnis Anda. Kami merancang website yang secara efektif mengkomunikasikan nilai, visi, misi, dan layanan perusahaan Anda kepada audiens target. Dengan desain yang elegan dan struktur informasi yang jelas, website ini akan membantu Anda membangun kepercayaan dan kredibilitas di mata klien, mitra, dan investor.', '[\"Desain Kustom & Profesional\", \"Halaman Tentang Kami, Visi & Misi\", \"Galeri Portofolio & Proyek\", \"Formulir Kontak & Integrasi Maps\", \"Integrasi Media Sosial\", \"Optimasi Kecepatan Muat\"]', '[\"Membangun citra profesional dan terpercaya.\", \"Memudahkan calon klien menemukan informasi tentang perusahaan.\", \"Meningkatkan peluang kerja sama bisnis.\", \"Menjadi pusat informasi resmi perusahaan di internet.\"]', '[\"jasa website company profile\", \"website profil perusahaan\", \"bikin web perusahaan\", \"desain web corporate\", \"website bisnis\"]', 3, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(4, 'Custom Web Application', 'custom-web-application', 'Aplikasi Khusus', 'Pengembangan aplikasi web kustom yang disesuaikan dengan kebutuhan dan proses bisnis spesifik Anda.', 'Setiap bisnis memiliki keunikan dan tantangan tersendiri. Layanan Custom Web Application kami hadir untuk memberikan solusi perangkat lunak yang dirancang khusus untuk mengatasi masalah spesifik dan mengoptimalkan proses bisnis Anda. Mulai dari sistem manajemen inventaris, CRM, ERP, hingga platform e-learning, kami membangun aplikasi yang scalable, aman, dan mudah digunakan.', '[\"Analisis Kebutuhan Bisnis Mendalam\", \"Arsitektur Perangkat Lunak Scalable\", \"Pengembangan Frontend & Backend Kustom\", \"Integrasi API Pihak Ketiga\", \"Pengujian Keamanan & Kualitas (QA)\", \"Pelatihan Pengguna & Dokumentasi\"]', '[\"Solusi yang 100% sesuai dengan alur kerja bisnis Anda.\", \"Otomatisasi proses manual untuk meningkatkan efisiensi.\", \"Keamanan data yang lebih terjamin dengan kontrol penuh.\", \"Skalabilitas tinggi untuk mendukung pertumbuhan bisnis di masa depan.\"]', '[\"custom web application\", \"jasa pembuatan aplikasi web\", \"software house\", \"bikin aplikasi custom\", \"pengembangan sistem informasi\", \"aplikasi ERP custom\"]', 4, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(5, 'Pembuatan Mobile Apps', 'pembuatan-mobile-apps', 'Software', ';sakd;kas;d', '<p>lasdl;s;da;</p>', '[]', '[]', '[]', 6, '2026-03-11 11:08:29', '2026-03-11 11:08:29');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cuw2IJjeoXnICwnt7ZBvLx2Uqt98IFJmxdN3y9Hj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo2OntzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9tLW9uZS1zb2x1dGlvbi1hcGkudGVzdC9hZG1pbi9hbHVtbmlzIjtzOjU6InJvdXRlIjtzOjM4OiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMuYWx1bW5pcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjoiX3Rva2VuIjtzOjQwOiJOc1FLeThxSzA0N1Z0bDVaVTRGV2hEa09abFNwdFd6RU5XZW9wMlNhIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiJjYWRlMjY4ZDNiZTk0MDAxZmE4M2VlYWJhZjBhOTk3NDY4YzgwNGUwN2VhN2U0MTRmY2E3MzBhN2Y4ZGE1Njg2Ijt9', 1773217557);
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'M-One Solution', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(2, 'company_address', 'Jl. Contoh No.1, Kota Anda', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(3, 'contact_email', 'info@m-one-solution.com', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(4, 'contact_phone', '+62 xxx xxxx xxxx', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(5, 'whatsapp_number', '628xxxxxxxxxx', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(6, 'facebook_url', '', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(7, 'instagram_url', '', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(8, 'tiktok_url', '', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(9, 'youtube_url', '', '2026-03-09 21:55:44', '2026-03-09 21:55:44'),
(10, 'linkedin_url', '', '2026-03-09 21:55:44', '2026-03-09 21:55:44');
INSERT INTO `team_members` (`id`, `name`, `role`, `social_linkedin`, `social_github`, `social_instagram`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'Alfarez Syahputra Kuri, S.Kom', 'Manajer & Founder', 'https://www.linkedin.com/in/alfarez-syahputra-kuri-b53bab231', 'https://github.com/L200160067', 'https://www.instagram.com/alfarezkuri/', 1, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(2, 'Siti Rahmawati', 'Lead Developer', NULL, NULL, NULL, 2, '2026-03-09 22:15:12', '2026-03-10 23:40:14'),
(3, 'Agus Pratama', 'UI/UX Designer', NULL, NULL, NULL, 3, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(4, 'Dewi Lestari', 'Project Manager', NULL, NULL, NULL, 4, '2026-03-09 22:15:12', '2026-03-09 22:15:12'),
(5, 'Habib', 'Administrator', NULL, NULL, NULL, 5, '2026-03-11 10:46:36', '2026-03-11 10:46:36'),
(7, 'Afif', 'Server Admin', NULL, NULL, NULL, 6, '2026-03-11 11:04:04', '2026-03-11 11:04:04');
INSERT INTO `testimonials` (`id`, `name`, `role`, `company`, `content`, `rating`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', 'Kepala Sekolah', 'SMA Negeri 1 Jaya', 'Sistem Informasi Akademik yang dibuat oleh M-One Solution sangat membantu dalam mendigitalisasi proses belajar mengajar di sekolah kami. Antarmukanya intuitif dan mudah digunakan oleh guru maupun siswa.', 5, 1, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(2, 'Andi Wijaya', 'Direktur', 'PT Maju Terus', 'Pembuatan Company Profile berjalan sangat lancar. Desainnya modern dan sesuai dengan yang kami harapkan. Tim M-One juga responsif terhadap revisi.', 5, 1, '2026-03-09 22:15:13', '2026-03-09 22:15:13'),
(3, 'Siti Aminah', 'Pemilik', 'Batik Berkah', 'Aplikasi e-commerce custom yang dibangun sangat fungsional. Kami bisa mengelola stok dan pesanan dengan lebih efisien sekarang. Terima kasih M-One Solution!', 5, 1, '2026-03-09 22:15:13', '2026-03-09 22:15:13');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin M-One Solution', 'admin@m-one-solution.com', NULL, '$2y$12$YrqGCPg./Yq4cQdaUQCb6uNaDPmW6Cdxxz0f9WJSVCOcIGHVIUdLS', NULL, '2026-03-09 21:55:44', '2026-03-09 21:55:44');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;