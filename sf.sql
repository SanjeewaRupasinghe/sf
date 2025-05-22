-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `ap_blog_categories`;
CREATE TABLE `ap_blog_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ap_blog_categories_name_unique` (`name`),
  UNIQUE KEY `ap_blog_categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `ap_blog_posts`;
CREATE TABLE `ap_blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `ap_blog_category_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `publish` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `ar_description` longtext DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `ar_tags` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_key` text DEFAULT NULL,
  `meta_des` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ap_blog_posts_slug_unique` (`slug`),
  KEY `ap_blog_posts_ap_blog_category_id_foreign` (`ap_blog_category_id`),
  CONSTRAINT `ap_blog_posts_ap_blog_category_id_foreign` FOREIGN KEY (`ap_blog_category_id`) REFERENCES `ap_blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `ap_categories`;
CREATE TABLE `ap_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `meta_title` text DEFAULT NULL,
  `meta_key` text DEFAULT NULL,
  `meta_des` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ap_categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `ap_courses`;
CREATE TABLE `ap_courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ap_category_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `extras` longtext DEFAULT NULL,
  `ar_extras` longtext DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `requirements` longtext DEFAULT NULL,
  `ar_requirements` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `ar_description` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `meta_title` text DEFAULT NULL,
  `meta_key` text DEFAULT NULL,
  `meta_des` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ap_courses_slug_unique` (`slug`),
  KEY `ap_courses_ap_category_id_foreign` (`ap_category_id`),
  CONSTRAINT `ap_courses_ap_category_id_foreign` FOREIGN KEY (`ap_category_id`) REFERENCES `ap_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_categories_name_unique` (`name`),
  UNIQUE KEY `blog_categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `blog_category_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `publish` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `ar_description` longtext DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `ar_tags` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_key` text DEFAULT NULL,
  `meta_des` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  KEY `blog_posts_blog_category_id_foreign` (`blog_category_id`),
  CONSTRAINT `blog_posts_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `meta_title` text DEFAULT NULL,
  `meta_key` text DEFAULT NULL,
  `meta_des` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `ar_duration` varchar(255) DEFAULT NULL,
  `lastupdate` date DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `ar_requirements` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `ar_description` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `meta_title` text DEFAULT NULL,
  `meta_key` text DEFAULT NULL,
  `meta_des` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_slug_unique` (`slug`),
  KEY `courses_category_id_foreign` (`category_id`),
  CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `course_calendars`;
CREATE TABLE `course_calendars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_calendars_course_id_foreign` (`course_id`),
  CONSTRAINT `course_calendars_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_acfw_store_credits`;
CREATE TABLE `wp_acfw_store_credits` (
  `entry_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `entry_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `entry_type` varchar(20) NOT NULL,
  `entry_action` varchar(20) NOT NULL,
  `entry_amount` varchar(255) NOT NULL,
  `object_id` bigint(20) NOT NULL,
  `entry_note` text DEFAULT NULL,
  PRIMARY KEY (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_actionscheduler_actions`;
CREATE TABLE `wp_actionscheduler_actions` (
  `action_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hook` varchar(191) NOT NULL,
  `status` varchar(20) NOT NULL,
  `scheduled_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `scheduled_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  `args` varchar(191) DEFAULT NULL,
  `schedule` longtext DEFAULT NULL,
  `group_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `attempts` int(11) NOT NULL DEFAULT 0,
  `last_attempt_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `last_attempt_local` datetime DEFAULT '0000-00-00 00:00:00',
  `claim_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `extended_args` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`action_id`),
  KEY `hook` (`hook`),
  KEY `status` (`status`),
  KEY `scheduled_date_gmt` (`scheduled_date_gmt`),
  KEY `args` (`args`),
  KEY `group_id` (`group_id`),
  KEY `last_attempt_gmt` (`last_attempt_gmt`),
  KEY `claim_id` (`claim_id`),
  KEY `claim_id_status_scheduled_date_gmt` (`claim_id`,`status`,`scheduled_date_gmt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_actionscheduler_claims`;
CREATE TABLE `wp_actionscheduler_claims` (
  `claim_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`claim_id`),
  KEY `date_created_gmt` (`date_created_gmt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_actionscheduler_groups`;
CREATE TABLE `wp_actionscheduler_groups` (
  `group_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `slug` (`slug`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_actionscheduler_logs`;
CREATE TABLE `wp_actionscheduler_logs` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` bigint(20) unsigned NOT NULL,
  `message` text NOT NULL,
  `log_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `log_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`log_id`),
  KEY `action_id` (`action_id`),
  KEY `log_date_gmt` (`log_date_gmt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_berocket_termmeta`;
CREATE TABLE `wp_berocket_termmeta` (
  `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `berocket_term_id` bigint(20) NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  UNIQUE KEY `meta_id` (`meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bv_fw_requests`;
CREATE TABLE `wp_bv_fw_requests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT 0,
  `time` bigint(20) NOT NULL DEFAULT 1388516401,
  `path` varchar(100) NOT NULL DEFAULT '',
  `host` varchar(100) NOT NULL DEFAULT '',
  `method` varchar(100) NOT NULL DEFAULT '',
  `resp_code` int(6) NOT NULL DEFAULT 0,
  `category` int(1) NOT NULL DEFAULT 4,
  `referer` varchar(200) NOT NULL DEFAULT '',
  `user_agent` varchar(200) NOT NULL DEFAULT '',
  `filenames` text DEFAULT NULL,
  `query_string` text DEFAULT NULL,
  `rules_info` text DEFAULT NULL,
  `request_id` varchar(200) DEFAULT NULL,
  `matched_rules` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bv_ip_store`;
CREATE TABLE `wp_bv_ip_store` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `start_ip_range` varbinary(16) NOT NULL,
  `end_ip_range` varbinary(16) NOT NULL,
  `is_fw` tinyint(1) NOT NULL,
  `is_lp` tinyint(1) NOT NULL,
  `type` int(1) NOT NULL,
  `is_v6` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `ip_range` (`start_ip_range`,`end_ip_range`)
) ENGINE=InnoDB DEFAULT CHARSET=binary;


DROP TABLE IF EXISTS `wp_bv_lp_requests`;
CREATE TABLE `wp_bv_lp_requests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT 0,
  `username` varchar(50) NOT NULL DEFAULT '',
  `message` varchar(100) NOT NULL DEFAULT '',
  `category` int(1) NOT NULL DEFAULT 0,
  `time` bigint(20) NOT NULL DEFAULT 1388516401,
  `request_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bwf_actions`;
CREATE TABLE `wp_bwf_actions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `c_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `e_time` int(12) NOT NULL DEFAULT 0,
  `hook` varchar(255) NOT NULL,
  `args` longtext DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 - Pending | 1 - Running',
  `recurring_interval` int(10) NOT NULL DEFAULT 0,
  `group_slug` varchar(255) NOT NULL DEFAULT 'woofunnels',
  `claim_id` bigint(20) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `e_time` (`e_time`),
  KEY `hook` (`hook`(191)),
  KEY `status` (`status`),
  KEY `group_slug` (`group_slug`(191)),
  KEY `claim_id` (`claim_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bwf_action_claim`;
CREATE TABLE `wp_bwf_action_claim` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bwf_contact`;
CREATE TABLE `wp_bwf_contact` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `wpid` int(12) NOT NULL,
  `uid` varchar(35) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT 'lead',
  `last_modified` datetime NOT NULL,
  `timezone` varchar(50) DEFAULT '',
  `source` varchar(100) DEFAULT '',
  `points` bigint(20) unsigned NOT NULL DEFAULT 0,
  `tags` longtext DEFAULT NULL,
  `lists` longtext DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `wpid` (`wpid`),
  KEY `uid` (`uid`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bwf_contact_meta`;
CREATE TABLE `wp_bwf_contact_meta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(50) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bwf_funnelmeta`;
CREATE TABLE `wp_bwf_funnelmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bwf_funnel_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `bwf_funnel_id` (`bwf_funnel_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bwf_funnels`;
CREATE TABLE `wp_bwf_funnels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `desc` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `steps` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bwf_optin_entries`;
CREATE TABLE `wp_bwf_optin_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `step_id` bigint(20) unsigned NOT NULL,
  `funnel_id` bigint(20) unsigned NOT NULL,
  `cid` bigint(20) unsigned NOT NULL,
  `opid` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data` varchar(255) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_bwf_wc_customers`;
CREATE TABLE `wp_bwf_wc_customers` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(12) NOT NULL,
  `l_order_date` datetime NOT NULL,
  `total_order_count` int(7) NOT NULL,
  `total_order_value` double NOT NULL,
  `purchased_products` longtext DEFAULT NULL,
  `purchased_products_cats` longtext DEFAULT NULL,
  `purchased_products_tags` longtext DEFAULT NULL,
  `used_coupons` longtext DEFAULT NULL,
  `f_order_date` datetime NOT NULL,
  `aov` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_cartflows_ca_cart_abandonment`;
CREATE TABLE `wp_cartflows_ca_cart_abandonment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `checkout_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cart_contents` longtext DEFAULT NULL,
  `cart_total` decimal(10,2) DEFAULT NULL,
  `session_id` varchar(60) NOT NULL,
  `other_fields` longtext DEFAULT NULL,
  `order_status` enum('normal','abandoned','completed','lost') NOT NULL DEFAULT 'normal',
  `unsubscribed` tinyint(1) DEFAULT 0,
  `coupon_code` varchar(50) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`session_id`),
  UNIQUE KEY `session_id_UNIQUE` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_cartflows_ca_email_history`;
CREATE TABLE `wp_cartflows_ca_email_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `template_id` bigint(20) NOT NULL,
  `ca_session_id` varchar(60) DEFAULT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `scheduled_time` datetime DEFAULT NULL,
  `email_sent` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `ca_session_id` (`ca_session_id`),
  CONSTRAINT `wp_cartflows_ca_email_history_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `wp_cartflows_ca_email_templates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wp_cartflows_ca_email_history_ibfk_2` FOREIGN KEY (`ca_session_id`) REFERENCES `wp_cartflows_ca_cart_abandonment` (`session_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_cartflows_ca_email_templates`;
CREATE TABLE `wp_cartflows_ca_email_templates` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `template_name` text NOT NULL,
  `email_subject` text NOT NULL,
  `email_body` mediumtext NOT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 0,
  `frequency` int(11) NOT NULL,
  `frequency_unit` enum('MINUTE','HOUR','DAY') NOT NULL DEFAULT 'MINUTE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_cartflows_ca_email_templates_meta`;
CREATE TABLE `wp_cartflows_ca_email_templates_meta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email_template_id` bigint(20) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email_template_id` (`email_template_id`),
  CONSTRAINT `wp_cartflows_ca_email_templates_meta_ibfk_1` FOREIGN KEY (`email_template_id`) REFERENCES `wp_cartflows_ca_email_templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_commentmeta`;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_comments`;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT 0,
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10)),
  KEY `woo_idx_comment_type` (`comment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_e_events`;
CREATE TABLE `wp_e_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_data` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_frmt_form_entry`;
CREATE TABLE `wp_frmt_form_entry` (
  `entry_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `entry_type` varchar(191) NOT NULL,
  `draft_id` varchar(12) DEFAULT NULL,
  `form_id` bigint(20) unsigned NOT NULL,
  `is_spam` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`entry_id`),
  KEY `entry_is_spam` (`is_spam`),
  KEY `entry_type` (`entry_type`),
  KEY `entry_form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_frmt_form_entry_meta`;
CREATE TABLE `wp_frmt_form_entry_meta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `entry_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(191) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`meta_id`),
  KEY `meta_key` (`meta_key`),
  KEY `meta_entry_id` (`entry_id`),
  KEY `meta_key_object` (`entry_id`,`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_frmt_form_reports`;
CREATE TABLE `wp_frmt_form_reports` (
  `report_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `report_value` longtext NOT NULL,
  `status` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_frmt_form_views`;
CREATE TABLE `wp_frmt_form_views` (
  `view_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) unsigned NOT NULL,
  `page_id` bigint(20) unsigned NOT NULL,
  `ip` varchar(191) DEFAULT NULL,
  `count` mediumint(8) unsigned NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`view_id`),
  KEY `view_form_id` (`form_id`),
  KEY `view_ip` (`ip`),
  KEY `view_form_object` (`form_id`,`view_id`),
  KEY `view_form_object_ip` (`form_id`,`view_id`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_jet_smart_filters_indexer`;
CREATE TABLE `wp_jet_smart_filters_indexer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `filter_key` text DEFAULT NULL,
  `filter_posts` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_links`;
CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_maxbuttonsv3`;
CREATE TABLE `wp_maxbuttonsv3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `cache` text DEFAULT NULL,
  `responsive` text DEFAULT NULL,
  `color` text DEFAULT NULL,
  `basic` text DEFAULT NULL,
  `dimension` text DEFAULT NULL,
  `border` text DEFAULT NULL,
  `gradient` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `container` text DEFAULT NULL,
  `advanced` text DEFAULT NULL,
  `meta` text DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wp_maxbuttons_collections`;
CREATE TABLE `wp_maxbuttons_collections` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL,
  `collection_key` varchar(255) DEFAULT NULL,
  `collection_value` text DEFAULT NULL,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wp_maxbuttons_collections_trans`;
CREATE TABLE `wp_maxbuttons_collections_trans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `wp_mec_attendees`;
CREATE TABLE `wp_mec_attendees` (
  `attendee_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `event_id` bigint(20) NOT NULL,
  `occurrence` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `data` text DEFAULT NULL,
  `count` int(11) DEFAULT 1,
  `verification` int(1) DEFAULT 0,
  `confirmation` int(1) DEFAULT 0,
  PRIMARY KEY (`attendee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_mec_bookings`;
CREATE TABLE `wp_mec_bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `transaction_id` varchar(20) DEFAULT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `ticket_ids` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `all_occurrences` tinyint(4) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`,`ticket_ids`(191),`status`,`confirmed`,`verified`,`date`),
  KEY `booking_id` (`booking_id`),
  KEY `timestamp` (`timestamp`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_mec_dates`;
CREATE TABLE `wp_mec_dates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `dstart` date NOT NULL,
  `dend` date NOT NULL,
  `tstart` int(11) unsigned NOT NULL DEFAULT 0,
  `tend` int(11) unsigned NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT 'publish',
  `public` int(4) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `tstart` (`tstart`),
  KEY `tend` (`tend`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_mec_events`;
CREATE TABLE `wp_mec_events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `repeat` tinyint(4) NOT NULL DEFAULT 0,
  `rinterval` varchar(10) DEFAULT NULL,
  `year` varchar(80) DEFAULT NULL,
  `month` varchar(80) DEFAULT NULL,
  `day` varchar(80) DEFAULT NULL,
  `week` varchar(80) DEFAULT NULL,
  `weekday` varchar(80) DEFAULT NULL,
  `weekdays` varchar(80) DEFAULT NULL,
  `days` text NOT NULL,
  `not_in_days` text NOT NULL,
  `time_start` int(10) NOT NULL DEFAULT 0,
  `time_end` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID` (`id`),
  UNIQUE KEY `post_id` (`post_id`),
  KEY `start` (`start`,`end`,`repeat`,`rinterval`,`year`,`month`,`day`,`week`,`weekday`,`weekdays`,`time_start`,`time_end`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_mec_occurrences`;
CREATE TABLE `wp_mec_occurrences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `occurrence` int(10) unsigned NOT NULL,
  `params` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `occurrence` (`occurrence`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_mec_users`;
CREATE TABLE `wp_mec_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(127) NOT NULL,
  `reg` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_mondula_form_wizards`;
CREATE TABLE `wp_mondula_form_wizards` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `json` mediumtext NOT NULL,
  `version` varchar(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_mp_timetable_data`;
CREATE TABLE `wp_mp_timetable_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `column_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_start` time NOT NULL,
  `event_end` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_ms_snippets`;
CREATE TABLE `wp_ms_snippets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `code` longtext NOT NULL,
  `tags` longtext NOT NULL,
  `scope` varchar(15) NOT NULL DEFAULT 'global',
  `priority` smallint(6) NOT NULL DEFAULT 10,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_options`;
CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_postmeta`;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_posts`;
CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(255) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_email_templates`;
CREATE TABLE `wp_promag_email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmpl_name` varchar(600) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_body` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_fields`;
CREATE TABLE `wp_promag_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(255) NOT NULL,
  `field_desc` longtext DEFAULT NULL,
  `field_type` varchar(255) NOT NULL,
  `field_options` longtext DEFAULT NULL,
  `field_icon` int(11) DEFAULT NULL,
  `associate_group` int(11) NOT NULL DEFAULT 0,
  `associate_section` int(11) NOT NULL DEFAULT 0,
  `show_in_signup_form` int(11) NOT NULL DEFAULT 0,
  `is_required` int(11) NOT NULL DEFAULT 0,
  `is_editable` int(11) NOT NULL DEFAULT 0,
  `display_on_profile` int(11) NOT NULL DEFAULT 0,
  `display_on_group` int(11) NOT NULL DEFAULT 0,
  `visibility` int(11) NOT NULL DEFAULT 0,
  `ordering` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_friends`;
CREATE TABLE `wp_promag_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `action_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_groups`;
CREATE TABLE `wp_promag_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `group_desc` longtext DEFAULT NULL,
  `group_icon` int(11) DEFAULT NULL,
  `is_group_limit` int(11) NOT NULL DEFAULT 0,
  `group_limit` int(11) NOT NULL DEFAULT 0,
  `group_limit_message` longtext DEFAULT NULL,
  `associate_role` varchar(255) NOT NULL,
  `is_group_leader` int(11) NOT NULL DEFAULT 0,
  `leader_username` varchar(255) NOT NULL,
  `group_leaders` longtext DEFAULT NULL,
  `leader_rights` longtext DEFAULT NULL,
  `group_slug` varchar(255) DEFAULT NULL,
  `show_success_message` int(11) NOT NULL DEFAULT 0,
  `success_message` longtext DEFAULT NULL,
  `group_options` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_group_requests`;
CREATE TABLE `wp_promag_group_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `options` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_msg_conversation`;
CREATE TABLE `wp_promag_msg_conversation` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `content` longtext DEFAULT NULL,
  `timestamp` datetime NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `msg_desc` longtext DEFAULT NULL,
  PRIMARY KEY (`m_id`),
  KEY `t_id` (`t_id`),
  CONSTRAINT `wp_promag_msg_conversation_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `wp_promag_msg_threads` (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_msg_threads`;
CREATE TABLE `wp_promag_msg_threads` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `thread_desc` longtext DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_notification`;
CREATE TABLE `wp_promag_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` int(11) NOT NULL,
  `meta` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_paypal_log`;
CREATE TABLE `wp_promag_paypal_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(600) NOT NULL,
  `log` longtext NOT NULL,
  `posted_date` datetime NOT NULL,
  `gid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `pay_processor` varchar(255) NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_promag_sections`;
CREATE TABLE `wp_promag_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `section_name` varchar(600) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `section_options` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_qcld_conversion_tracker`;
CREATE TABLE `wp_qcld_conversion_tracker` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `action_reference` smallint(5) NOT NULL COMMENT '1=WoowBot,5=Others',
  `action_for` smallint(5) NOT NULL COMMENT '1=Add to Cart,2=Checkout,3=Order Completed',
  `action_data` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rank_math_404_logs`;
CREATE TABLE `wp_rank_math_404_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `accessed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `times_accessed` bigint(20) unsigned NOT NULL DEFAULT 1,
  `referer` varchar(255) NOT NULL DEFAULT '',
  `user_agent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uri` (`uri`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_rank_math_analytics_gsc`;
CREATE TABLE `wp_rank_math_analytics_gsc` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `query` varchar(1000) NOT NULL,
  `page` varchar(500) NOT NULL,
  `clicks` mediumint(6) NOT NULL,
  `impressions` mediumint(6) NOT NULL,
  `position` double NOT NULL,
  `ctr` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `analytics_query` (`query`(191)),
  KEY `analytics_page` (`page`(191)),
  KEY `clicks` (`clicks`),
  KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `wp_rank_math_analytics_objects`;
CREATE TABLE `wp_rank_math_analytics_objects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` text NOT NULL,
  `page` varchar(500) NOT NULL,
  `object_type` varchar(100) NOT NULL,
  `object_subtype` varchar(100) NOT NULL,
  `object_id` bigint(20) unsigned NOT NULL,
  `primary_key` varchar(255) NOT NULL,
  `seo_score` tinyint(4) NOT NULL DEFAULT 0,
  `page_score` tinyint(4) NOT NULL DEFAULT 0,
  `is_indexable` tinyint(1) NOT NULL DEFAULT 1,
  `schemas_in_use` varchar(500) DEFAULT NULL,
  `desktop_interactive` double DEFAULT 0,
  `desktop_pagescore` double DEFAULT 0,
  `mobile_interactive` double DEFAULT 0,
  `mobile_pagescore` double DEFAULT 0,
  `pagespeed_refreshed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `analytics_object_page` (`page`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;


DROP TABLE IF EXISTS `wp_rank_math_internal_links`;
CREATE TABLE `wp_rank_math_internal_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `target_post_id` bigint(20) unsigned NOT NULL,
  `type` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `link_direction` (`post_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_rank_math_internal_meta`;
CREATE TABLE `wp_rank_math_internal_meta` (
  `object_id` bigint(20) unsigned NOT NULL,
  `internal_link_count` int(10) unsigned DEFAULT 0,
  `external_link_count` int(10) unsigned DEFAULT 0,
  `incoming_link_count` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_rank_math_redirections`;
CREATE TABLE `wp_rank_math_redirections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sources` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `url_to` text NOT NULL,
  `header_code` smallint(4) unsigned NOT NULL,
  `hits` bigint(20) unsigned NOT NULL DEFAULT 0,
  `status` varchar(25) NOT NULL DEFAULT 'active',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_accessed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_rank_math_redirections_cache`;
CREATE TABLE `wp_rank_math_redirections_cache` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `redirection_id` bigint(20) unsigned NOT NULL,
  `object_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `object_type` varchar(10) NOT NULL DEFAULT 'post',
  `is_redirected` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `redirection_id` (`redirection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_revslider_css`;
CREATE TABLE `wp_revslider_css` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `handle` text NOT NULL,
  `settings` longtext DEFAULT NULL,
  `hover` longtext DEFAULT NULL,
  `advanced` longtext DEFAULT NULL,
  `params` longtext NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `handle_index` (`handle`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_css_bkp`;
CREATE TABLE `wp_revslider_css_bkp` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `handle` text NOT NULL,
  `settings` longtext DEFAULT NULL,
  `hover` longtext DEFAULT NULL,
  `advanced` longtext DEFAULT NULL,
  `params` longtext NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_layer_animations`;
CREATE TABLE `wp_revslider_layer_animations` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `handle` text NOT NULL,
  `params` text NOT NULL,
  `settings` text DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_layer_animations_bkp`;
CREATE TABLE `wp_revslider_layer_animations_bkp` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `handle` text NOT NULL,
  `params` text NOT NULL,
  `settings` text DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_navigations`;
CREATE TABLE `wp_revslider_navigations` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `handle` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `css` longtext NOT NULL,
  `markup` longtext NOT NULL,
  `settings` longtext DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_navigations_bkp`;
CREATE TABLE `wp_revslider_navigations_bkp` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `handle` varchar(191) NOT NULL,
  `type` varchar(191) NOT NULL,
  `css` longtext NOT NULL,
  `markup` longtext NOT NULL,
  `settings` longtext DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_sliders`;
CREATE TABLE `wp_revslider_sliders` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `alias` tinytext DEFAULT NULL,
  `params` longtext NOT NULL,
  `settings` text DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`),
  KEY `type_index` (`type`(8))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_sliders_bkp`;
CREATE TABLE `wp_revslider_sliders_bkp` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `alias` tinytext DEFAULT NULL,
  `params` longtext NOT NULL,
  `settings` text DEFAULT NULL,
  `type` varchar(191) NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_slides`;
CREATE TABLE `wp_revslider_slides` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `slider_id` int(9) NOT NULL,
  `slide_order` int(11) NOT NULL,
  `params` longtext NOT NULL,
  `layers` longtext NOT NULL,
  `settings` text NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `slider_id_index` (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_slides_bkp`;
CREATE TABLE `wp_revslider_slides_bkp` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `slider_id` int(9) NOT NULL,
  `slide_order` int(11) NOT NULL,
  `params` longtext NOT NULL,
  `layers` longtext NOT NULL,
  `settings` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_static_slides`;
CREATE TABLE `wp_revslider_static_slides` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `slider_id` int(9) NOT NULL,
  `params` longtext NOT NULL,
  `layers` longtext NOT NULL,
  `settings` text NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `slider_id_index` (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_revslider_static_slides_bkp`;
CREATE TABLE `wp_revslider_static_slides_bkp` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `slider_id` int(9) NOT NULL,
  `params` longtext NOT NULL,
  `layers` longtext NOT NULL,
  `settings` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_custom_status`;
CREATE TABLE `wp_rm_custom_status` (
  `cus_status_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `status_index` int(6) DEFAULT NULL,
  `submission_id` int(6) DEFAULT NULL,
  `form_id` int(6) DEFAULT NULL,
  PRIMARY KEY (`cus_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_fields`;
CREATE TABLE `wp_rm_fields` (
  `field_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(6) DEFAULT NULL,
  `page_no` int(6) unsigned NOT NULL DEFAULT 1,
  `field_label` text DEFAULT NULL,
  `field_type` text DEFAULT NULL,
  `field_value` mediumtext DEFAULT NULL,
  `field_order` int(6) DEFAULT NULL,
  `field_show_on_user_page` tinyint(1) DEFAULT NULL,
  `is_field_primary` tinyint(1) NOT NULL DEFAULT 0,
  `field_is_editable` tinyint(1) NOT NULL DEFAULT 0,
  `is_deletion_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `field_options` mediumtext DEFAULT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_forms`;
CREATE TABLE `wp_rm_forms` (
  `form_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `form_name` varchar(1000) DEFAULT NULL,
  `form_type` int(6) DEFAULT NULL,
  `form_user_role` varchar(1000) DEFAULT NULL,
  `default_user_role` varchar(255) DEFAULT NULL,
  `form_should_send_email` tinyint(1) DEFAULT NULL,
  `form_redirect` varchar(10) DEFAULT NULL,
  `form_redirect_to_page` varchar(500) DEFAULT NULL,
  `form_redirect_to_url` varchar(500) DEFAULT NULL,
  `form_should_auto_expire` tinyint(1) DEFAULT NULL,
  `form_options` text DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(6) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(6) DEFAULT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_front_users`;
CREATE TABLE `wp_rm_front_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `otp_code` varchar(255) NOT NULL,
  `last_activity_time` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `attempts` int(3) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_login`;
CREATE TABLE `wp_rm_login` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `m_key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_login_log`;
CREATE TABLE `wp_rm_login_log` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `username_used` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `ban` int(1) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `failure_reason` varchar(255) DEFAULT NULL,
  `ban_til` datetime DEFAULT NULL,
  `login_url` varchar(255) DEFAULT NULL,
  `social_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_notes`;
CREATE TABLE `wp_rm_notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `submission_id` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `publication_date` datetime NOT NULL,
  `published_by` bigint(20) DEFAULT NULL,
  `last_edit_date` datetime DEFAULT NULL,
  `last_edited_by` bigint(20) DEFAULT NULL,
  `note_options` longtext DEFAULT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_paypal_fields`;
CREATE TABLE `wp_rm_paypal_fields` (
  `field_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `class` varchar(256) DEFAULT NULL,
  `option_label` longtext DEFAULT NULL,
  `option_price` longtext DEFAULT NULL,
  `option_value` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `require` longtext DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `extra_options` longtext DEFAULT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_paypal_logs`;
CREATE TABLE `wp_rm_paypal_logs` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `submission_id` int(6) DEFAULT NULL,
  `form_id` int(6) DEFAULT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `txn_id` varchar(600) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `log` longtext DEFAULT NULL,
  `posted_date` varchar(50) DEFAULT NULL,
  `pay_proc` varchar(50) DEFAULT NULL,
  `bill` longtext DEFAULT NULL,
  `ex_data` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_resources`;
CREATE TABLE `wp_rm_resources` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `data` longtext DEFAULT NULL,
  `meta` longtext DEFAULT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_rules`;
CREATE TABLE `wp_rm_rules` (
  `rule_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(6) DEFAULT NULL,
  `attr_name` varchar(255) DEFAULT NULL,
  `attr_value` varchar(1000) DEFAULT NULL,
  `operator` varchar(20) DEFAULT NULL,
  `meta` text DEFAULT NULL,
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_sent_mails`;
CREATE TABLE `wp_rm_sent_mails` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `to` varchar(255) DEFAULT NULL,
  `sub` longtext DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `sent_on` datetime DEFAULT NULL,
  `headers` varchar(255) DEFAULT NULL,
  `form_id` int(11) DEFAULT NULL,
  `exdata` varchar(255) DEFAULT NULL,
  `is_read_by_user` tinyint(1) NOT NULL DEFAULT 0,
  `was_sent_success` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_sessions`;
CREATE TABLE `wp_rm_sessions` (
  `id` varchar(128) NOT NULL,
  `data` mediumtext NOT NULL,
  `timestamp` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_stats`;
CREATE TABLE `wp_rm_stats` (
  `stat_id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(6) DEFAULT NULL,
  `user_ip` varchar(50) DEFAULT NULL,
  `ua_string` varchar(255) DEFAULT NULL,
  `browser_name` varchar(50) DEFAULT NULL,
  `visited_on` varchar(50) DEFAULT NULL,
  `submitted_on` varchar(50) DEFAULT NULL,
  `time_taken` int(11) DEFAULT NULL,
  `submission_id` int(6) DEFAULT NULL,
  PRIMARY KEY (`stat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_submissions`;
CREATE TABLE `wp_rm_submissions` (
  `submission_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(6) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `user_email` varchar(250) DEFAULT NULL,
  `child_id` int(6) NOT NULL DEFAULT 0,
  `last_child` int(6) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `submitted_on` datetime DEFAULT NULL,
  `unique_token` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`submission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_submission_fields`;
CREATE TABLE `wp_rm_submission_fields` (
  `sub_field_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `submission_id` int(6) DEFAULT NULL,
  `field_id` int(6) DEFAULT NULL,
  `form_id` int(6) DEFAULT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`sub_field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_tasks`;
CREATE TABLE `wp_rm_tasks` (
  `task_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(6) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(1000) DEFAULT NULL,
  `must_rules` text DEFAULT NULL,
  `any_rules` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `actions` text DEFAULT NULL,
  `task_order` int(6) DEFAULT NULL,
  `meta` text DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rm_task_exe_log`;
CREATE TABLE `wp_rm_task_exe_log` (
  `texe_log_id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(6) DEFAULT NULL,
  `action` int(6) DEFAULT NULL,
  `sub_ids` longtext DEFAULT NULL,
  `user_ids` longtext DEFAULT NULL,
  `meta` text DEFAULT NULL,
  PRIMARY KEY (`texe_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_rsssl_csp_log`;
CREATE TABLE `wp_rsssl_csp_log` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `documenturi` text NOT NULL,
  `violateddirective` text NOT NULL,
  `blockeduri` text NOT NULL,
  `inpolicy` text NOT NULL,
  `hide` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_sgpb_subscribers`;
CREATE TABLE `wp_sgpb_subscribers` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subscriptionType` int(12) DEFAULT NULL,
  `cDate` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `unsubscribed` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `wp_sgpb_subscription_error_log`;
CREATE TABLE `wp_sgpb_subscription_error_log` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) DEFAULT NULL,
  `popupType` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `wp_shopmagic_automation_outcome`;
CREATE TABLE `wp_shopmagic_automation_outcome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `execution_id` varchar(48) NOT NULL,
  `automation_id` int(11) NOT NULL,
  `automation_name` varchar(255) NOT NULL,
  `action_index` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `customer_email` varchar(255) NOT NULL,
  `success` tinyint(1) DEFAULT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_shopmagic_automation_outcome_logs`;
CREATE TABLE `wp_shopmagic_automation_outcome_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `execution_id` varchar(48) NOT NULL,
  `note` text NOT NULL,
  `created` datetime NOT NULL,
  `note_context` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `execution_id` (`execution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_shopmagic_guest`;
CREATE TABLE `wp_shopmagic_guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `tracking_key` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_shopmagic_guest_meta`;
CREATE TABLE `wp_shopmagic_guest_meta` (
  `meta_id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_id` int(11) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `guest_id` (`guest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_shopmagic_optin_email`;
CREATE TABLE `wp_shopmagic_optin_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `communication_type` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `subscribe` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_smush_dir_images`;
CREATE TABLE `wp_smush_dir_images` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `path` text NOT NULL,
  `path_hash` char(32) DEFAULT NULL,
  `resize` varchar(55) DEFAULT NULL,
  `lossy` varchar(55) DEFAULT NULL,
  `error` varchar(55) DEFAULT NULL,
  `image_size` int(10) unsigned DEFAULT NULL,
  `orig_size` int(10) unsigned DEFAULT NULL,
  `file_time` int(10) unsigned DEFAULT NULL,
  `last_scan` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `meta` text DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `path_hash` (`path_hash`),
  KEY `image_size` (`image_size`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_snippets`;
CREATE TABLE `wp_snippets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `code` longtext NOT NULL,
  `tags` longtext NOT NULL,
  `scope` varchar(15) NOT NULL DEFAULT 'global',
  `priority` smallint(6) NOT NULL DEFAULT 10,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_termmeta`;
CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_terms`;
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_term_relationships`;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_term_taxonomy`;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_usermeta`;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_users`;
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_vxc_zoho_accounts`;
CREATE TABLE `wp_vxc_zoho_accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `data` longtext DEFAULT NULL,
  `meta` longtext DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `time` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_vxc_zoho_log`;
CREATE TABLE `wp_vxc_zoho_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `feed_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `crm_id` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `object` varchar(250) NOT NULL,
  `event` varchar(200) NOT NULL,
  `meta` varchar(250) NOT NULL,
  `data` text DEFAULT NULL,
  `response` text DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wc_admin_notes`;
CREATE TABLE `wp_wc_admin_notes` (
  `note_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `locale` varchar(20) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `icon` varchar(200) NOT NULL DEFAULT 'info',
  `content_data` longtext DEFAULT NULL,
  `status` varchar(200) NOT NULL,
  `source` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_reminder` datetime DEFAULT NULL,
  `is_snoozable` tinyint(1) NOT NULL DEFAULT 0,
  `layout` varchar(20) NOT NULL DEFAULT '',
  `image` varchar(200) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_admin_note_actions`;
CREATE TABLE `wp_wc_admin_note_actions` (
  `action_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `query` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `actioned_text` varchar(255) NOT NULL,
  `nonce_action` varchar(255) DEFAULT NULL,
  `nonce_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`action_id`),
  KEY `note_id` (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_category_lookup`;
CREATE TABLE `wp_wc_category_lookup` (
  `category_tree_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`category_tree_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_cleveradwords`;
CREATE TABLE `wp_wc_cleveradwords` (
  `account_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wc_customer_lookup`;
CREATE TABLE `wp_wc_customer_lookup` (
  `customer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `username` varchar(60) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `date_last_active` timestamp NULL DEFAULT NULL,
  `date_registered` timestamp NULL DEFAULT NULL,
  `country` char(2) NOT NULL DEFAULT '',
  `postcode` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `state` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_download_log`;
CREATE TABLE `wp_wc_download_log` (
  `download_log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `user_ip_address` varchar(100) DEFAULT '',
  PRIMARY KEY (`download_log_id`),
  KEY `permission_id` (`permission_id`),
  KEY `timestamp` (`timestamp`),
  CONSTRAINT `fk_wp_wc_download_log_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `wp_woocommerce_downloadable_product_permissions` (`permission_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_gpf_render_cache`;
CREATE TABLE `wp_wc_gpf_render_cache` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `composite_cache_idx` (`post_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wc_order_coupon_lookup`;
CREATE TABLE `wp_wc_order_coupon_lookup` (
  `order_id` bigint(20) unsigned NOT NULL,
  `coupon_id` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `discount_amount` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_id`,`coupon_id`),
  KEY `coupon_id` (`coupon_id`),
  KEY `date_created` (`date_created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_order_product_lookup`;
CREATE TABLE `wp_wc_order_product_lookup` (
  `order_item_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `variation_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_qty` int(11) NOT NULL,
  `product_net_revenue` double NOT NULL DEFAULT 0,
  `product_gross_revenue` double NOT NULL DEFAULT 0,
  `coupon_amount` double NOT NULL DEFAULT 0,
  `tax_amount` double NOT NULL DEFAULT 0,
  `shipping_amount` double NOT NULL DEFAULT 0,
  `shipping_tax_amount` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `customer_id` (`customer_id`),
  KEY `date_created` (`date_created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_order_stats`;
CREATE TABLE `wp_wc_order_stats` (
  `order_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `num_items_sold` int(11) NOT NULL DEFAULT 0,
  `total_sales` double NOT NULL DEFAULT 0,
  `tax_total` double NOT NULL DEFAULT 0,
  `shipping_total` double NOT NULL DEFAULT 0,
  `net_total` double NOT NULL DEFAULT 0,
  `returning_customer` tinyint(1) DEFAULT NULL,
  `status` varchar(200) NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `date_created` (`date_created`),
  KEY `customer_id` (`customer_id`),
  KEY `status` (`status`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_order_tax_lookup`;
CREATE TABLE `wp_wc_order_tax_lookup` (
  `order_id` bigint(20) unsigned NOT NULL,
  `tax_rate_id` bigint(20) unsigned NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `shipping_tax` double NOT NULL DEFAULT 0,
  `order_tax` double NOT NULL DEFAULT 0,
  `total_tax` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`order_id`,`tax_rate_id`),
  KEY `tax_rate_id` (`tax_rate_id`),
  KEY `date_created` (`date_created`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_product_attributes_lookup`;
CREATE TABLE `wp_wc_product_attributes_lookup` (
  `product_id` bigint(20) NOT NULL,
  `product_or_parent_id` bigint(20) NOT NULL,
  `taxonomy` varchar(32) NOT NULL,
  `term_id` bigint(20) NOT NULL,
  `is_variation_attribute` tinyint(1) NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  PRIMARY KEY (`product_or_parent_id`,`term_id`,`product_id`,`taxonomy`),
  KEY `is_variation_attribute_term_id` (`is_variation_attribute`,`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wc_product_meta_lookup`;
CREATE TABLE `wp_wc_product_meta_lookup` (
  `product_id` bigint(20) NOT NULL,
  `sku` varchar(100) DEFAULT '',
  `virtual` tinyint(1) DEFAULT 0,
  `downloadable` tinyint(1) DEFAULT 0,
  `min_price` decimal(19,4) DEFAULT NULL,
  `max_price` decimal(19,4) DEFAULT NULL,
  `onsale` tinyint(1) DEFAULT 0,
  `stock_quantity` double DEFAULT NULL,
  `stock_status` varchar(100) DEFAULT 'instock',
  `rating_count` bigint(20) DEFAULT 0,
  `average_rating` decimal(3,2) DEFAULT 0.00,
  `total_sales` bigint(20) DEFAULT 0,
  `tax_status` varchar(100) DEFAULT 'taxable',
  `tax_class` varchar(100) DEFAULT '',
  PRIMARY KEY (`product_id`),
  KEY `virtual` (`virtual`),
  KEY `downloadable` (`downloadable`),
  KEY `stock_status` (`stock_status`),
  KEY `stock_quantity` (`stock_quantity`),
  KEY `onsale` (`onsale`),
  KEY `min_max_price` (`min_price`,`max_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_rate_limits`;
CREATE TABLE `wp_wc_rate_limits` (
  `rate_limit_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rate_limit_key` varchar(200) NOT NULL,
  `rate_limit_expiry` bigint(20) unsigned NOT NULL,
  `rate_limit_remaining` smallint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rate_limit_id`),
  UNIQUE KEY `rate_limit_key` (`rate_limit_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wc_reserved_stock`;
CREATE TABLE `wp_wc_reserved_stock` (
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `stock_quantity` double NOT NULL DEFAULT 0,
  `timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expires` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_tax_rate_classes`;
CREATE TABLE `wp_wc_tax_rate_classes` (
  `tax_rate_class_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`tax_rate_class_id`),
  UNIQUE KEY `slug` (`slug`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wc_webhooks`;
CREATE TABLE `wp_wc_webhooks` (
  `webhook_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(200) NOT NULL,
  `name` text NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `delivery_url` text NOT NULL,
  `secret` text NOT NULL,
  `topic` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_version` smallint(4) NOT NULL,
  `failure_count` smallint(10) NOT NULL DEFAULT 0,
  `pending_delivery` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`webhook_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wfacp_stats`;
CREATE TABLE `wp_wfacp_stats` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `wfacp_id` bigint(20) unsigned NOT NULL,
  `total_revenue` varchar(255) NOT NULL DEFAULT '0',
  `cid` bigint(20) unsigned NOT NULL DEFAULT 0,
  `fid` bigint(20) unsigned NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`),
  KEY `oid` (`order_id`),
  KEY `bid` (`wfacp_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wfco_report_views`;
CREATE TABLE `wp_wfco_report_views` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `no_of_sessions` int(11) NOT NULL DEFAULT 1,
  `object_id` bigint(20) DEFAULT 0,
  `type` tinyint(2) NOT NULL DEFAULT 1 COMMENT '1 - Abandonment 2 - Landing visited 3 - Landing converted 4 - Aero visited 5- Thank you visited 6 - NextMove 7 - Funnel session 8-Optin visited 9-Optin converted 10- Optin thank you visited 11- Optin thank you converted',
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `object_id` (`object_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_woobe_history`;
CREATE TABLE `wp_woobe_history` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `field_key` varchar(32) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prev_val` text DEFAULT NULL,
  `mod_date` int(11) NOT NULL COMMENT 'modification time',
  `bulk_key` varchar(16) DEFAULT NULL COMMENT 'is changed in the bulk flow?',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `bulk_key` (`bulk_key`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_woobe_history_bulk`;
CREATE TABLE `wp_woobe_history_bulk` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `bulk_key` varchar(16) NOT NULL,
  `state` enum('completed','terminated') NOT NULL DEFAULT 'terminated',
  `started` int(11) DEFAULT NULL,
  `finished` int(11) DEFAULT NULL,
  `products_count` int(11) DEFAULT 0,
  `set_of_keys` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bulk_key` (`bulk_key`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_woocommerce_api_keys`;
CREATE TABLE `wp_woocommerce_api_keys` (
  `key_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `permissions` varchar(10) NOT NULL,
  `consumer_key` char(64) NOT NULL,
  `consumer_secret` char(43) NOT NULL,
  `nonces` longtext DEFAULT NULL,
  `truncated_key` char(7) NOT NULL,
  `last_access` datetime DEFAULT NULL,
  PRIMARY KEY (`key_id`),
  KEY `consumer_key` (`consumer_key`),
  KEY `consumer_secret` (`consumer_secret`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_attribute_taxonomies`;
CREATE TABLE `wp_woocommerce_attribute_taxonomies` (
  `attribute_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(200) NOT NULL,
  `attribute_label` varchar(200) DEFAULT NULL,
  `attribute_type` varchar(20) NOT NULL,
  `attribute_orderby` varchar(20) NOT NULL,
  `attribute_public` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`attribute_id`),
  KEY `attribute_name` (`attribute_name`(20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_downloadable_product_permissions`;
CREATE TABLE `wp_woocommerce_downloadable_product_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `download_id` varchar(36) NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `order_key` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `downloads_remaining` varchar(9) DEFAULT NULL,
  `access_granted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access_expires` datetime DEFAULT NULL,
  `download_count` bigint(20) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`permission_id`),
  KEY `download_order_key_product` (`product_id`,`order_id`,`order_key`(16),`download_id`),
  KEY `download_order_product` (`download_id`,`order_id`,`product_id`),
  KEY `order_id` (`order_id`),
  KEY `user_order_remaining_expires` (`user_id`,`order_id`,`downloads_remaining`,`access_expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_gpf_google_taxonomy`;
CREATE TABLE `wp_woocommerce_gpf_google_taxonomy` (
  `taxonomy_term` text DEFAULT NULL,
  `search_term` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_woocommerce_log`;
CREATE TABLE `wp_woocommerce_log` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `level` smallint(4) NOT NULL,
  `source` varchar(200) NOT NULL,
  `message` longtext NOT NULL,
  `context` longtext DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `level` (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_order_itemmeta`;
CREATE TABLE `wp_woocommerce_order_itemmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `order_item_id` (`order_item_id`),
  KEY `meta_key` (`meta_key`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_order_items`;
CREATE TABLE `wp_woocommerce_order_items` (
  `order_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_name` text NOT NULL,
  `order_item_type` varchar(200) NOT NULL DEFAULT '',
  `order_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_payment_tokenmeta`;
CREATE TABLE `wp_woocommerce_payment_tokenmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_token_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `payment_token_id` (`payment_token_id`),
  KEY `meta_key` (`meta_key`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_payment_tokens`;
CREATE TABLE `wp_woocommerce_payment_tokens` (
  `token_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gateway_id` varchar(200) NOT NULL,
  `token` text NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `type` varchar(200) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`token_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_sessions`;
CREATE TABLE `wp_woocommerce_sessions` (
  `session_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_key` char(32) NOT NULL,
  `session_value` longtext NOT NULL,
  `session_expiry` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`session_id`),
  UNIQUE KEY `session_key` (`session_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_shipping_zones`;
CREATE TABLE `wp_woocommerce_shipping_zones` (
  `zone_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(200) NOT NULL,
  `zone_order` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_shipping_zone_locations`;
CREATE TABLE `wp_woocommerce_shipping_zone_locations` (
  `location_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zone_id` bigint(20) unsigned NOT NULL,
  `location_code` varchar(200) NOT NULL,
  `location_type` varchar(40) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `location_id` (`location_id`),
  KEY `location_type_code` (`location_type`(10),`location_code`(20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_shipping_zone_methods`;
CREATE TABLE `wp_woocommerce_shipping_zone_methods` (
  `zone_id` bigint(20) unsigned NOT NULL,
  `instance_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `method_id` varchar(200) NOT NULL,
  `method_order` bigint(20) unsigned NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`instance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_tax_rates`;
CREATE TABLE `wp_woocommerce_tax_rates` (
  `tax_rate_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tax_rate_country` varchar(2) NOT NULL DEFAULT '',
  `tax_rate_state` varchar(200) NOT NULL DEFAULT '',
  `tax_rate` varchar(8) NOT NULL DEFAULT '',
  `tax_rate_name` varchar(200) NOT NULL DEFAULT '',
  `tax_rate_priority` bigint(20) unsigned NOT NULL,
  `tax_rate_compound` int(1) NOT NULL DEFAULT 0,
  `tax_rate_shipping` int(1) NOT NULL DEFAULT 1,
  `tax_rate_order` bigint(20) unsigned NOT NULL,
  `tax_rate_class` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`tax_rate_id`),
  KEY `tax_rate_country` (`tax_rate_country`),
  KEY `tax_rate_state` (`tax_rate_state`(2)),
  KEY `tax_rate_class` (`tax_rate_class`(10)),
  KEY `tax_rate_priority` (`tax_rate_priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_tax_rate_locations`;
CREATE TABLE `wp_woocommerce_tax_rate_locations` (
  `location_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location_code` varchar(200) NOT NULL,
  `tax_rate_id` bigint(20) unsigned NOT NULL,
  `location_type` varchar(40) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `tax_rate_id` (`tax_rate_id`),
  KEY `location_type_code` (`location_type`(10),`location_code`(20))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_tpay`;
CREATE TABLE `wp_woocommerce_tpay` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `wooId` mediumint(9) NOT NULL,
  `midId` mediumint(9) NOT NULL,
  `client_language` varchar(2) NOT NULL DEFAULT 'pl',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woocommerce_tpay_clients`;
CREATE TABLE `wp_woocommerce_tpay_clients` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `clientId` mediumint(9) NOT NULL,
  `cliAuth` varchar(40) NOT NULL,
  `cardNoShort` varchar(20) NOT NULL,
  `midId` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_woo_followemail_tempaltes`;
CREATE TABLE `wp_woo_followemail_tempaltes` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(290) NOT NULL,
  `followup_days` int(11) NOT NULL,
  `subject` varchar(290) NOT NULL,
  `message` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sent_count` bigint(20) NOT NULL DEFAULT 0,
  `open_count` bigint(20) NOT NULL DEFAULT 0,
  `return_count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_woo_reminder_list`;
CREATE TABLE `wp_woo_reminder_list` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `itime` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_id` bigint(20) NOT NULL,
  `c_name` varchar(250) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `prod_id` bigint(20) NOT NULL,
  `prod_name` text DEFAULT NULL,
  `mail_date` datetime DEFAULT NULL,
  `mail_sents` varchar(255) NOT NULL DEFAULT '[]',
  `rmdr_logs` text DEFAULT NULL,
  `rmdr_roid` bigint(20) DEFAULT NULL,
  `rmdr_status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wpfm_backup`;
CREATE TABLE `wp_wpfm_backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_name` text DEFAULT NULL,
  `backup_date` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wpforms_entries`;
CREATE TABLE `wp_wpforms_entries` (
  `entry_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `viewed` tinyint(1) DEFAULT 0,
  `starred` tinyint(1) DEFAULT 0,
  `fields` longtext NOT NULL,
  `meta` longtext NOT NULL,
  `date` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `ip_address` varchar(128) NOT NULL,
  `user_agent` varchar(256) NOT NULL,
  `user_uuid` varchar(36) NOT NULL,
  PRIMARY KEY (`entry_id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wpforms_entry_fields`;
CREATE TABLE `wp_wpforms_entry_fields` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entry_id` bigint(20) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_id` (`entry_id`),
  KEY `form_id` (`form_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wpforms_entry_meta`;
CREATE TABLE `wp_wpforms_entry_meta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entry_id` bigint(20) NOT NULL,
  `form_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `data` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_id` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wpforms_tasks_meta`;
CREATE TABLE `wp_wpforms_tasks_meta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wpmailsmtp_debug_events`;
CREATE TABLE `wp_wpmailsmtp_debug_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text DEFAULT NULL,
  `initiator` text DEFAULT NULL,
  `event_type` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wpmailsmtp_tasks_meta`;
CREATE TABLE `wp_wpmailsmtp_tasks_meta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `wp_wpmm_subscribers`;
CREATE TABLE `wp_wpmm_subscribers` (
  `id_subscriber` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `insert_date` datetime NOT NULL,
  PRIMARY KEY (`id_subscriber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_wt_iew_action_history`;
CREATE TABLE `wp_wt_iew_action_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_type` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `status_text` varchar(255) NOT NULL,
  `offset` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `wp_wt_iew_cron`;
CREATE TABLE `wp_wt_iew_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT 0,
  `old_status` int(11) NOT NULL DEFAULT 0,
  `action_type` varchar(255) NOT NULL,
  `schedule_type` varchar(50) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  `start_time` int(11) NOT NULL,
  `cron_data` text NOT NULL,
  `last_run` int(11) NOT NULL,
  `next_offset` int(11) NOT NULL DEFAULT 0,
  `history_id_list` text NOT NULL,
  `history_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `wp_wt_iew_ftp`;
CREATE TABLE `wp_wt_iew_ftp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `port` int(11) NOT NULL DEFAULT 21,
  `ftps` int(11) NOT NULL DEFAULT 0,
  `is_sftp` int(11) NOT NULL DEFAULT 0,
  `passive_mode` int(11) NOT NULL DEFAULT 0,
  `export_path` varchar(255) NOT NULL,
  `import_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `wp_wt_iew_mapping_template`;
CREATE TABLE `wp_wt_iew_mapping_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_type` varchar(255) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `wp_yith_wcwl`;
CREATE TABLE `wp_yith_wcwl` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `wishlist_id` bigint(20) DEFAULT NULL,
  `position` int(11) DEFAULT 0,
  `original_price` decimal(9,3) DEFAULT NULL,
  `original_currency` char(3) DEFAULT NULL,
  `dateadded` timestamp NOT NULL DEFAULT current_timestamp(),
  `on_sale` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_yith_wcwl_lists`;
CREATE TABLE `wp_yith_wcwl_lists` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `wishlist_slug` varchar(200) NOT NULL,
  `wishlist_name` text DEFAULT NULL,
  `wishlist_token` varchar(64) NOT NULL,
  `wishlist_privacy` tinyint(1) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `dateadded` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiration` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `wishlist_token` (`wishlist_token`),
  KEY `wishlist_slug` (`wishlist_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_yoast_indexable`;
CREATE TABLE `wp_yoast_indexable` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `permalink` longtext DEFAULT NULL,
  `permalink_hash` varchar(191) DEFAULT NULL,
  `object_id` int(11) unsigned DEFAULT NULL,
  `object_type` varchar(32) NOT NULL,
  `object_sub_type` varchar(32) DEFAULT NULL,
  `author_id` int(11) unsigned DEFAULT NULL,
  `post_parent` int(11) unsigned DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `breadcrumb_title` text DEFAULT NULL,
  `post_status` varchar(20) DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `is_protected` tinyint(1) DEFAULT 0,
  `has_public_posts` tinyint(1) DEFAULT NULL,
  `number_of_pages` int(11) unsigned DEFAULT NULL,
  `canonical` longtext DEFAULT NULL,
  `primary_focus_keyword` varchar(191) DEFAULT NULL,
  `primary_focus_keyword_score` int(3) DEFAULT NULL,
  `readability_score` int(3) DEFAULT NULL,
  `is_cornerstone` tinyint(1) DEFAULT 0,
  `is_robots_noindex` tinyint(1) DEFAULT 0,
  `is_robots_nofollow` tinyint(1) DEFAULT 0,
  `is_robots_noarchive` tinyint(1) DEFAULT 0,
  `is_robots_noimageindex` tinyint(1) DEFAULT 0,
  `is_robots_nosnippet` tinyint(1) DEFAULT 0,
  `twitter_title` text DEFAULT NULL,
  `twitter_image` longtext DEFAULT NULL,
  `twitter_description` longtext DEFAULT NULL,
  `twitter_image_id` varchar(191) DEFAULT NULL,
  `twitter_image_source` text DEFAULT NULL,
  `open_graph_title` text DEFAULT NULL,
  `open_graph_description` longtext DEFAULT NULL,
  `open_graph_image` longtext DEFAULT NULL,
  `open_graph_image_id` varchar(191) DEFAULT NULL,
  `open_graph_image_source` text DEFAULT NULL,
  `open_graph_image_meta` mediumtext DEFAULT NULL,
  `link_count` int(11) DEFAULT NULL,
  `incoming_link_count` int(11) DEFAULT NULL,
  `prominent_words_version` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blog_id` bigint(20) NOT NULL DEFAULT 1,
  `language` varchar(32) DEFAULT NULL,
  `region` varchar(32) DEFAULT NULL,
  `schema_page_type` varchar(64) DEFAULT NULL,
  `schema_article_type` varchar(64) DEFAULT NULL,
  `has_ancestors` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `object_type_and_sub_type` (`object_type`,`object_sub_type`),
  KEY `permalink_hash` (`permalink_hash`),
  KEY `object_id_and_type` (`object_id`,`object_type`),
  KEY `subpages` (`post_parent`,`object_type`,`post_status`,`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_yoast_indexable_hierarchy`;
CREATE TABLE `wp_yoast_indexable_hierarchy` (
  `indexable_id` int(11) unsigned NOT NULL,
  `ancestor_id` int(11) unsigned NOT NULL,
  `depth` int(11) unsigned DEFAULT NULL,
  `blog_id` bigint(20) NOT NULL DEFAULT 1,
  PRIMARY KEY (`indexable_id`,`ancestor_id`),
  KEY `indexable_id` (`indexable_id`),
  KEY `ancestor_id` (`ancestor_id`),
  KEY `depth` (`depth`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_yoast_migrations`;
CREATE TABLE `wp_yoast_migrations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wp_yoast_migrations_version` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_yoast_primary_term`;
CREATE TABLE `wp_yoast_primary_term` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `term_id` int(11) unsigned NOT NULL,
  `taxonomy` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blog_id` bigint(20) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `post_taxonomy` (`post_id`,`taxonomy`),
  KEY `post_term` (`post_id`,`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_yoast_seo_links`;
CREATE TABLE `wp_yoast_seo_links` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `target_post_id` bigint(20) unsigned NOT NULL,
  `type` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `link_direction` (`post_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `wp_yoast_seo_meta`;
CREATE TABLE `wp_yoast_seo_meta` (
  `object_id` bigint(20) unsigned NOT NULL,
  `internal_link_count` int(10) unsigned DEFAULT NULL,
  `incoming_link_count` int(10) unsigned DEFAULT NULL,
  UNIQUE KEY `object_id` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=DYNAMIC;


-- 2025-05-22 08:56:59


-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'superadmin',	'$2y$10$1CwBZ0LiscUc0di19p9sUuIFp/ZaBken6XsyvXx6ljj5fwlRSnZgO',	'SA',	1,	'2022-07-24 19:44:14',	'2022-07-24 19:44:14');

INSERT INTO `ap_blog_categories` (`id`, `name`, `ar_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1,	'Complete Appraisal',	NULL,	'complete-appraisal',	1,	'2023-11-21 05:44:34',	'2023-11-21 05:44:34'),
(6,	'Rush Appraisal',	NULL,	'rush-appraisal',	1,	'2023-11-21 05:47:45',	'2023-11-21 05:47:45'),
(7,	'Concierge Services',	NULL,	'concierge-services',	1,	'2023-11-21 05:48:14',	'2023-11-21 05:48:14');

INSERT INTO `ap_blog_posts` (`id`, `name`, `ar_name`, `slug`, `ap_blog_category_id`, `image`, `publish`, `description`, `ar_description`, `tags`, `ar_tags`, `meta_title`, `meta_key`, `meta_des`, `status`, `created_at`, `updated_at`) VALUES
(1,	'5 Productive Training Ideas for the Hospitality Industry',	NULL,	'5-productive-training-ideas-for-the-hospitality-industry',	1,	'1700566491.png',	'2023-11-07',	'<p>&nbsp;cvbcvbcvb cvbcv</p>',	NULL,	'BLS, Fire Safety, First Aid',	NULL,	NULL,	NULL,	NULL,	1,	'2023-11-21 06:04:51',	'2023-11-21 06:04:51');

INSERT INTO `ap_categories` (`id`, `name`, `ar_name`, `slug`, `parent_id`, `image`, `status`, `meta_title`, `meta_key`, `meta_des`, `created_at`, `updated_at`) VALUES
(1,	'Complete Appraisal Services',	'',	'complete-appraisal',	NULL,	NULL,	1,	'Complete Appraisal Service',	'Complete Appraisal Service',	'Complete Appraisal Service',	'2023-11-20 23:48:20',	'2023-12-06 06:08:58'),
(2,	'Revalidation Services',	'',	'revalidation',	NULL,	NULL,	1,	'Revalidation Service',	'Revalidation Service',	'Revalidation Service',	'2023-11-20 23:48:52',	'2023-12-06 06:09:08'),
(3,	'Concierge Services',	'',	'concierge',	NULL,	NULL,	1,	'Concierge Services',	'Concierge Services',	'Concierge Services',	'2023-11-20 23:49:14',	'2023-12-06 06:09:18');

INSERT INTO `ap_courses` (`id`, `name`, `ar_name`, `slug`, `ap_category_id`, `image`, `extras`, `ar_extras`, `price`, `requirements`, `ar_requirements`, `description`, `ar_description`, `status`, `meta_title`, `meta_key`, `meta_des`, `created_at`, `updated_at`) VALUES
(1,	'Complete Appraisal Service',	'',	'complete-appraisal-service',	1,	'Complete Appraisal Service.jpg',	'Designated Body Connection,Pre-Chek of MAG form,Virtual Appraisal',	NULL,	'3,999',	'Summary of latest appraisal (if you have previous appraisal),CPD Events,Significant declaration if any,Patients & Colleagues feedback,CME certificates, and other supporting documents you want to submit.,MAG form',	NULL,	'<h4 style=\"color: #f00;\">About&nbsp;</h4>\r\n<p>The GMC Medical Appraisal is a process overseen by the General Medical Council in the UK. It involves regular reviews for doctors, fostering reflection on their practice, receiving feedback, and planning professional development. Conducted by an appraiser, the discussion covers various aspects of a doctor\'s practice to identify strengths and areas for improvement, ultimately supporting ongoing skill enhancement and patient care. For the latest details, it\'s advisable to check the official General Medical Council website.</p>\r\n<h4 class=\"mt-5\" style=\"color: #f00;\">Procedure</h4>\r\n<p>Arranging your appraisal with Safety First is quick and easy. Just follow these simple steps</p>\r\n<p>Step 1: Send us your details (GMC No. Current GMC Status, Contact No.,) Confirm your payment and registration. You will receive an email confirmation, then you will be provided with the access to MAG form (Medical Appraisal Guide)</p>\r\n<p>Step 2: Complete your MAG form. Our team and appraiser can provide additional assistance for completing your form. Doctors without Designated Body will be provided by additional forms (REV12, UD8 Form)</p>\r\n<p>Step 3: Book a date and time for your appraisal. Appraisal meetings can take through the working day, in the evenings or during weekends to accommodate your schedule. Then the appraisal process is completed and signed off and shared with your Responsible Officer.</p>',	NULL,	1,	NULL,	NULL,	NULL,	'2023-11-21 00:09:43',	'2023-12-06 12:22:55'),
(2,	'Revalidation Service',	'',	'revalidation-service',	2,	'Revalidation Services.jpg',	'Responsible Officer Recommendation,Portfolio review',	NULL,	'4,499',	'Copies of all full appraisal reports from within your revalidation cycle,Evidence of quality improvement activities undertaken within your revalidation cycle. – if not included within your appraisals,Evidence of patient and colleagues feedback and reflection within this revalidation cycle,24 patient and 16 colleague’s feedback,Signed declaration of concerns forms – to be sent after,Photo ID – Passport copy,References,',	NULL,	'<h4 style=\"color: #f00;\">About Revalidation</h4>\r\n<p>Medical revalidation is the process by which the General Medical Council (GMC) confirms the continuation of a doctor&rsquo;s licence to practise in the UK every 5 years. All doctors who wish to retain their licence to practise need to participate in revalidation. The purpose of revalidation is to provide greater assurance to patients and the public, employers and other healthcare professionals that licensed doctors are up-to-date and fit to practise. It is a key component of a range of measures designed to improve the quality of care for patients.</p>\r\n<p>The responsible officer makes a recommendation about the doctor&rsquo;s fitness to practise to the GMC. The recommendation will be based on the outcome of the doctor&rsquo;s annual appraisals over the course of five years, combined with information drawn from the organisational clinical governance systems.</p>\r\n<p>Following the responsible officer&rsquo;s recommendation, the GMC decides whether to renew the doctor&rsquo;s licence.</p>\r\n<h4 class=\"mt-5\" style=\"color: #f00;\">Revalidation Procedure.</h4>\r\n<p>Step 1: Send us your details (GMC No. Current GMC Status, Contact No.) Provide your revalidation date and confirm your Designated Body (If this is your first sign up, we must connect you to our Designated Body) Payment must confirm first.</p>\r\n<p>Step 2: Complete the required documents. Our team will assist you and collate all the documents and review and will forward it to our agency in the UK. R.O. will review and submit your documents to the GMC, and you will receive an email from GMC regarding your revalidation completion.</p>',	NULL,	1,	NULL,	NULL,	NULL,	'2023-11-21 00:15:49',	'2023-12-06 12:23:06'),
(3,	'Designated Body Alignment',	'',	'designated-body-alignment',	3,	'Designated Body Connection.jpg',	'Designated Body Connection',	NULL,	'1,999',	'Practicing or experience in the UK before,British nationality',	NULL,	'<h4 style=\"color: #f00;\">About Designated Body Alignment</h4>\r\n<p>A GMC Designated Body is an organisation that has been approved by the General Medical Council to be responsible for the revalidation of doctors who are licensed to practice medicine in the United Kingdom. The designated body is usually the healthcare entity where they are employed or with which they are contracted. If a doctors is not able to be connected with a designated body, they may be able to find a suitable person to connect with. It&rsquo;s important for doctors to know who their designated body is, as they must engage with it for their appraisal and revalidation.</p>\r\n<h4 class=\"mt-5\" style=\"color: #f00;\">Designated Body Alignment Procedure</h4>\r\n<p>Step 1: Confirm with us if you are able to have a Designated Body. Contact our representative or check our list of requirements. And we will inform you if we are able to connect you.</p>\r\n<p>Step 2: Once confirm. You can process the payment and will proceed for the connection. It will take 2-3 working days to complete.</p>',	NULL,	1,	NULL,	NULL,	NULL,	'2023-11-21 00:18:00',	'2023-12-06 12:23:18'),
(4,	'REV12 Appraisal (Annual Return Process)',	'',	'rev12-appraisal-annual-return-process',	3,	'REV12 Appraisal.jpg',	'Pre check MAG form,REV12 Form Submission,Virtual Appraisal',	NULL,	'3,599',	'MAG form,CME/CPD certificates,REV12 Form (To be filled by appraiser)',	NULL,	'<h4 style=\"color: #f00;\">About&nbsp;</h4>\r\n<p>Doctors who don&rsquo;t have a designated body or suitable person must provide evidence for their revalidation by providing an annual return to GMC. As part of the annual return, the doctor has to provide information and evidence to show they are having an annual appraisal that meets our criteria. They do this by providing an appraiser report form (REV12).</p>\r\n<h4 class=\"mt-5\" style=\"color: #f00;\">Procedure:</h4>\r\n<p>Step 1: Confirm with us if you need to have an appraisal REV12. Contact our representative for confirmation. And once confirm.</p>\r\n<p>Step 2: Proceed with the payment our team will send you the required form to be filled.</p>\r\n<p>Step 3: Schedule and complete your appraisal and the appraiser will guide you on how to submit your annual return to your GMC account directly.</p>',	NULL,	1,	NULL,	NULL,	NULL,	'2023-11-21 00:20:42',	'2023-12-06 12:23:41'),
(5,	'MAG Form Completion',	'',	'mag-form-completion-2',	3,	'Photos 4.jpg',	'MAG form Completion,Pre-check prior to complete appraisal',	NULL,	'899',	'Copies of previous appraisals (If you have),Significant declaration if any,Patients & Colleagues feedback,CME certificates, and other supporting documents you want to submit.',	NULL,	'<h4 style=\"color: #f00;\">About</h4>\r\n<p>Your appraisal form is called a MAG form. The Medical Appraisal Guide Model Appraisal Form (MAG Form) has provided an option as a working appraisal vehicle, given the limited availability of other formats, since the commencement of revalidation in 2014. The MAG form is a dynamic, interactive PDF file type (not e.g. MS Word or MS Excel). It can only be opened (with full functionality) in Adobe Reader. You may need to install Adobe Acrobat Reader, if not already available.</p>\r\n<h4 class=\"mt-5\" style=\"color: #f00;\">Procedure Test</h4>\r\n<p>Step 1: Confirm the payment for the service.</p>\r\n<p>Step 2: Our representative will contact you for the required details/certificates.</p>\r\n<p>Step 3: The MAG form will be completed, and our representative will send you the copy for your review.</p>',	NULL,	1,	NULL,	NULL,	NULL,	'2023-11-21 00:22:29',	'2023-12-06 12:23:57');

INSERT INTO `blog_categories` (`id`, `name`, `ar_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1,	'American Heart Association',	'',	'american-heart-association',	1,	'2022-07-25 00:20:20',	'2023-11-14 07:17:36'),
(3,	'Highfield',	'',	'highfield',	1,	'2023-11-14 07:17:48',	'2023-11-14 07:17:48'),
(4,	'Continuing Medical Education',	'',	'continuing-medical-education',	1,	'2023-11-14 07:18:25',	'2023-11-15 04:50:49'),
(5,	'American Safety Health Institute',	'',	'american-safety-health-institute',	1,	'2023-11-14 07:19:21',	'2023-11-14 07:19:21');

INSERT INTO `blog_posts` (`id`, `name`, `ar_name`, `slug`, `blog_category_id`, `image`, `publish`, `description`, `ar_description`, `tags`, `ar_tags`, `meta_title`, `meta_key`, `meta_des`, `status`, `created_at`, `updated_at`) VALUES
(2,	'Productive Training Ideas for the Hospitality Industry',	'',	'productive-training-ideas-for-the-hospitality-industry',	1,	'1700635058.jpg',	'2023-11-13',	'<p>The hospitality industry is one of the fastest-growing sectors in the world. It has also proven its resilience as it bounces back after Covid 19. Even in the face of a global pandemic, with the rise of newer variants, the market is expected to reach $5297.78 billion in 2025 at a CAGR of 6%, according to the Hospitality Global Market Report 2021. In the UAE, Dubai airport is also anticipating another busy period with passenger numbers expected to hit over 1 million, translating to high hotel demands. This has experts in the tourism industry optimistic about a continued recovery for the hospitality sector.</p>\r\n<p>However, it does have its share of unique problems as well. An unexpected effect occurred with lockdown measures hitting all industries during 2020 and 2021. Employees were forced to slow down and, in the process, figured out how overworked and undervalued they felt. Enter- The Great Resignation! According to a McKinsey report, 47% of the hospitality workforce is resigning or will have left in the next six months. This questions the methods with which industry leaders have been managing their workforce so far. And brings to light another question- How can strong coaching, mentoring,&nbsp;<strong>training, and upskilling</strong>&nbsp;help bring about change?</p>\r\n<h3>Let&rsquo;s first take a look at why training is essential in the hospitality industry:</h3>\r\n<h3>1. Robust Training + Remarkable Service = Returns on Investment</h3>\r\n<p>The value of an effective training program can be seen in how hospitality providers execute their services. A simple example of excellent service, which is a key performance indicator for most workers in the hospitality industry, is the use of stick words. These are words used to give a professional greeting, getting contact information immediately and correctly, using the guest&rsquo;s name politely throughout the conversation, subliminal cues that leave the guests feeling valued. Studies show that using stick words increases the likelihood of securing a booking by 2.5 times! Excellent service will invariably get great returns.</p>\r\n<h3>2. Converting Attrition into Attraction</h3>\r\n<p>Employee satisfaction is key in how a worker performs their service. A recent worker survey showed that 94% of employees say they would stay at a company longer if it invested in their learning and development. The employee turnover rate in hospitality can be as high as 70-75% per year!</p>\r\n<p>Robust&nbsp;<strong>training modules</strong>&nbsp;that offer value to the employee beyond their role in the organisation make them feel like the company is interested in their personal growth. It&rsquo;s a great way to instill loyalty in the long run.</p>\r\n<h3>Types of Training in the Hospitality Industry</h3>\r\n<p>In hospitality, there is a wide range of&nbsp;<strong>training methods</strong>&nbsp;that have proven to be successful. These include:</p>\r\n<ul>\r\n<li>Orientation and Onboarding training is required for all employees to understand the company&rsquo;s vision, mission, and brand values.</li>\r\n<li>Technical skills training is required for specialist roles.</li>\r\n<li>Product/service training, needed for employees to be highly familiar with the services or products they are providing</li>\r\n<li>Compliance training, needed by local authorities like workplace safety and sexual harassment training</li>\r\n</ul>\r\n<h3>Once these traditional and basic training models are executed well, here are 5 ways the hospitality industry can update its training programs for the future.</h3>\r\n<h3>1. Franchisee Training</h3>\r\n<p>The opportunities in building franchises are tremendous. This business model encourages companies to sell the rights to their business to owners and operators who, for a cost, operate their business using the company&rsquo;s brand. High performing employees often show great promise in running franchises for the hospitality industry. Giving the right employees the proper knowledge and tools to succeed through robust training is a win-win situation for both!</p>\r\n<h3>2. Soft Skills Training</h3>\r\n<p>Soft skills training is an underrated but essential investment for service roles in hospitality for any organisation. A happy customer keeps coming back for more, which is excellent for business. But soft skills also have a critical place in managerial training. Leaders who are adept at soft skills can manage their teams with empathy, leading to employee satisfaction and retention. After all, it is often said that people leave bad bosses, not bad jobs!</p>\r\n<h3>3. Managerial and Leadership Training</h3>\r\n<p>Employees who are invited for managerial and leadership training feel valued and appreciated. They have confidence in the organisation and their continued career path with them. Other employees witnessing the possibilities that may open up for them are then motivated to work harder and train better to get the same opportunity.</p>\r\n<h3>4. Personal Safety and Mental Health Training</h3>\r\n<p>COVID-19 also brought an increased need for personal safety and hygiene training, especially to those at the customer-facing side of service delivery in the hospitality industry. The World Health Organization published extensive guidelines to help organisations train their employees in food preparation and services and other roles to limit the spread of the virus. The pandemic also had another nasty by-product as it ran rampant &ndash; its effect on mental health. Employees in hospitality and tourism faced job uncertainty, unemployment, and fear for their safety. Organisations that paid attention to these unique needs and tried to deliver educational sessions on physical and mental health won the hearts of their employees as they felt that they were being looked after.</p>\r\n<h3>5. Use of E-Learning Platforms</h3>\r\n<p>The technology boom affected how training is delivered to employees, and the&nbsp;<strong>hospitality industry</strong>&nbsp;was no exception. Organisations are investing in e-Learning platforms to enhance their workers&rsquo; performance while decreasing the cost of in-person training. With the spread of COVID-19 over the last few years, online training has become the safest option. With the use of entirely customizable platforms, organisations can deliver interactive modules that employees can access from the comfort of their own homes. There are options for testing, practical tools and gamified courses that make learning fun. The added advantage of getting an immersive&nbsp;<strong>training experience</strong>&nbsp;that engages their employees is just the proverbial cherry on top!</p>\r\n<p>The past 18 months have offered some great learning lessons. Employees in the&nbsp;<strong>hospitality industry</strong>&nbsp;crave the investment their companies make in the human aspects of work. They prefer if their organisations and managers value their efforts with meaningful interactions, not just transactions. This means that&nbsp;<strong>companies in hospitality</strong>&nbsp;who choose to invest in their employees&rsquo; growth through&nbsp;<strong>upskilling and training</strong>&nbsp;have the most to gain. After all, loyal workers give the best return on investment!</p>',	NULL,	'BLS, Fire Safety, First Aid',	NULL,	'First Blog1',	'First Blog1',	'First Blog1',	1,	'2022-07-26 04:32:52',	'2023-11-22 01:07:38'),
(3,	'5 Productive Training Ideas for the Hospitality Industry',	'',	'5-productive-training-ideas-for-the-hospitality-industry',	1,	'1700635100.png',	'2023-11-13',	'<p>The hospitality industry is one of the fastest-growing sectors in the world. It has also proven its resilience as it bounces back after Covid 19. Even in the face of a global pandemic, with the rise of newer variants, the market is expected to reach $5297.78 billion in 2025 at a CAGR of 6%, according to the Hospitality Global Market Report 2021. In the UAE, Dubai airport is also anticipating another busy period with passenger numbers expected to hit over 1 million, translating to high hotel demands. This has experts in the tourism industry optimistic about a continued recovery for the hospitality sector.</p>\r\n<p>However, it does have its share of unique problems as well. An unexpected effect occurred with lockdown measures hitting all industries during 2020 and 2021. Employees were forced to slow down and, in the process, figured out how overworked and undervalued they felt. Enter- The Great Resignation! According to a McKinsey report, 47% of the hospitality workforce is resigning or will have left in the next six months. This questions the methods with which industry leaders have been managing their workforce so far. And brings to light another question- How can strong coaching, mentoring,&nbsp;<strong>training, and upskilling</strong>&nbsp;help bring about change?</p>\r\n<h3>Let&rsquo;s first take a look at why training is essential in the hospitality industry:</h3>\r\n<h3>1. Robust Training + Remarkable Service = Returns on Investment</h3>\r\n<p>The value of an effective training program can be seen in how hospitality providers execute their services. A simple example of excellent service, which is a key performance indicator for most workers in the hospitality industry, is the use of stick words. These are words used to give a professional greeting, getting contact information immediately and correctly, using the guest&rsquo;s name politely throughout the conversation, subliminal cues that leave the guests feeling valued. Studies show that using stick words increases the likelihood of securing a booking by 2.5 times! Excellent service will invariably get great returns.</p>\r\n<h3>2. Converting Attrition into Attraction</h3>\r\n<p>Employee satisfaction is key in how a worker performs their service. A recent worker survey showed that 94% of employees say they would stay at a company longer if it invested in their learning and development. The employee turnover rate in hospitality can be as high as 70-75% per year!</p>\r\n<p>Robust&nbsp;<strong>training modules</strong>&nbsp;that offer value to the employee beyond their role in the organisation make them feel like the company is interested in their personal growth. It&rsquo;s a great way to instill loyalty in the long run.</p>\r\n<h3>Types of Training in the Hospitality Industry</h3>\r\n<p>In hospitality, there is a wide range of&nbsp;<strong>training methods</strong>&nbsp;that have proven to be successful. These include:</p>\r\n<ul>\r\n<li>Orientation and Onboarding training is required for all employees to understand the company&rsquo;s vision, mission, and brand values.</li>\r\n<li>Technical skills training is required for specialist roles.</li>\r\n<li>Product/service training, needed for employees to be highly familiar with the services or products they are providing</li>\r\n<li>Compliance training, needed by local authorities like workplace safety and sexual harassment training</li>\r\n</ul>\r\n<h3>Once these traditional and basic training models are executed well, here are 5 ways the hospitality industry can update its training programs for the future.</h3>\r\n<h3>1. Franchisee Training</h3>\r\n<p>The opportunities in building franchises are tremendous. This business model encourages companies to sell the rights to their business to owners and operators who, for a cost, operate their business using the company&rsquo;s brand. High performing employees often show great promise in running franchises for the hospitality industry. Giving the right employees the proper knowledge and tools to succeed through robust training is a win-win situation for both!</p>\r\n<h3>2. Soft Skills Training</h3>\r\n<p>Soft skills training is an underrated but essential investment for service roles in hospitality for any organisation. A happy customer keeps coming back for more, which is excellent for business. But soft skills also have a critical place in managerial training. Leaders who are adept at soft skills can manage their teams with empathy, leading to employee satisfaction and retention. After all, it is often said that people leave bad bosses, not bad jobs!</p>\r\n<h3>3. Managerial and Leadership Training</h3>\r\n<p>Employees who are invited for managerial and leadership training feel valued and appreciated. They have confidence in the organisation and their continued career path with them. Other employees witnessing the possibilities that may open up for them are then motivated to work harder and train better to get the same opportunity.</p>\r\n<h3>4. Personal Safety and Mental Health Training</h3>\r\n<p>COVID-19 also brought an increased need for personal safety and hygiene training, especially to those at the customer-facing side of service delivery in the hospitality industry. The World Health Organization published extensive guidelines to help organisations train their employees in food preparation and services and other roles to limit the spread of the virus. The pandemic also had another nasty by-product as it ran rampant &ndash; its effect on mental health. Employees in hospitality and tourism faced job uncertainty, unemployment, and fear for their safety. Organisations that paid attention to these unique needs and tried to deliver educational sessions on physical and mental health won the hearts of their employees as they felt that they were being looked after.</p>\r\n<h3>5. Use of E-Learning Platforms</h3>\r\n<p>The technology boom affected how training is delivered to employees, and the&nbsp;<strong>hospitality industry</strong>&nbsp;was no exception. Organisations are investing in e-Learning platforms to enhance their workers&rsquo; performance while decreasing the cost of in-person training. With the spread of COVID-19 over the last few years, online training has become the safest option. With the use of entirely customizable platforms, organisations can deliver interactive modules that employees can access from the comfort of their own homes. There are options for testing, practical tools and gamified courses that make learning fun. The added advantage of getting an immersive&nbsp;<strong>training experience</strong>&nbsp;that engages their employees is just the proverbial cherry on top!</p>\r\n<p>The past 18 months have offered some great learning lessons. Employees in the&nbsp;<strong>hospitality industry</strong>&nbsp;crave the investment their companies make in the human aspects of work. They prefer if their organisations and managers value their efforts with meaningful interactions, not just transactions. This means that&nbsp;<strong>companies in hospitality</strong>&nbsp;who choose to invest in their employees&rsquo; growth through&nbsp;<strong>upskilling and training</strong>&nbsp;have the most to gain. After all, loyal workers give the best return on investment!</p>',	NULL,	'BLS, Fire Safety, First Aid',	NULL,	NULL,	NULL,	NULL,	1,	'2023-11-13 03:40:42',	'2023-11-22 01:08:20');

INSERT INTO `categories` (`id`, `name`, `ar_name`, `slug`, `parent_id`, `image`, `status`, `meta_title`, `meta_key`, `meta_des`, `created_at`, `updated_at`) VALUES
(1,	'American Heart Association',	'',	'american-heart-association',	NULL,	NULL,	1,	'American Heart Association',	'American Heart Association',	'American Heart Association',	'2023-11-09 23:58:02',	'2023-11-09 23:58:02'),
(2,	'Highfield Awarding Body',	'',	'highfield',	NULL,	NULL,	1,	'Highfield',	'Highfield',	'Highfield',	'2023-11-09 23:58:42',	'2023-11-09 23:58:42'),
(3,	'Continuing Medical Education',	'',	'continuing-medical-association',	NULL,	NULL,	1,	NULL,	NULL,	NULL,	'2023-11-09 23:59:05',	'2023-11-09 23:59:05'),
(4,	'American Safety Health Institute',	'',	'american-safety-health-institute',	NULL,	NULL,	1,	'American Safety Health Institute',	'American Safety Health Institute',	'American Safety Health Institute',	'2023-11-09 23:59:28',	'2023-11-09 23:59:28');

INSERT INTO `courses` (`id`, `name`, `ar_name`, `slug`, `category_id`, `image`, `duration`, `ar_duration`, `lastupdate`, `requirements`, `ar_requirements`, `description`, `ar_description`, `status`, `meta_title`, `meta_key`, `meta_des`, `created_at`, `updated_at`) VALUES
(7,	'AHA Basic Life Support Provider (BLS)',	'',	'aha-basic-life-support-provider-bls',	1,	'First_Aid_Training.jpg',	'5 Hours',	NULL,	NULL,	'Written Evaluation: Required for all students as per the AHA policy, Skill Evaluation: Students must performed required skills competently without assistance',	NULL,	'<p>About Course:&nbsp;</p>\r\n<p>The AHA&rsquo;s BLS Course provides the foundation for saving lives from cardiac arrest. It teaches&nbsp;<br />both single-rescuer and team basic life support skills for application in both prehospital and&nbsp;<br />in-facility environments, with a focus on high-quality CPR and team dynamics.&nbsp;<br />The AHA&rsquo;s BLS Provider Course reflects science and education from the 2020 Guidelines Update for CPR and ECC. . It teaches both single-rescuer and team basic life support skills for application&nbsp;<br />in both prehospital and in-facility environments, with a focus on high-quality CPR and team&nbsp;<br />dynamics.<br />In the Instructor-led course, students participate in simulated clinical scenarios and learning&nbsp;<br />stations. Students work with an AHA BLS Instructor to complete BLS skills practice and skills&nbsp;<br />testing. Students also complete a written exam.</p>\r\n<p>Course Content:</p>\r\n<p><br />&bull; The importance of high-quality CPR and its impact on survival<br />&bull; All of the steps of the Chain of Survival and apply the BLS concepts of the Chain of Survival<br />&bull; Recognize the signs of someone needing CPR<br />&bull; Perform high-quality CPR for adults, children and infants<br />&bull; The importance of early use of an AED and demonstrate its use<br />&bull; Provide effective ventilations by using a barrier device<br />&bull; The importance of teams in multi-rescuer resuscitation and perform as an effective team&nbsp;<br />member during multi-rescuer CPR<br />&bull; The technique for relief of foreign-body airway obstruction (choking) for adults and infants&nbsp;</p>',	NULL,	1,	'AHA Basic Life Support Provider (BLS)',	'AHA Basic Life Support Provider (BLS)',	'AHA Basic Life Support Provider (BLS)',	'2023-11-15 05:53:11',	'2023-11-22 01:25:17'),
(8,	'AHA Advanced Cardiac Life Support Provider (ACLS)',	'',	'aha-advanced-cardiac-life-support-provider-acls',	1,	'ACLS.jpg',	'7 Hours (2 Days)',	NULL,	NULL,	'Written Evaluation: Required for all students as per the AHA policy, Skill Evaluation: Students must performed required skills competently without assistance',	NULL,	'<p>About Course:&nbsp;</p>\r\n<p>Medical professionals who respond to cardiovascular emergencies in and out of the hospital enhance their&nbsp;<br />treatment knowledge and skills through the AHA&rsquo;s ACLS training courses.<br />AHA&rsquo;s ACLS offerings highlight the importance of team dynamics and communication, systems of care&nbsp;<br />and immediate post-cardiac arrest care. They also cover airway management and related pharmacology.<br />ACLS is an advanced, Instructor-led classroom course that highlights the importance of team dynamics&nbsp;<br />and communication, systems of care and immediate post-cardiac arrest care. It also covers airway&nbsp;<br />management and related pharmacology. In this course, skills are taught in large, group sessions and&nbsp;<br />small, group learning and testing stations where case-based scenarios are presented.</p>\r\n<p><br />Course Content:</p>\r\n<p>After successfully completing the ACLS Course, students should be able to&nbsp;<br />1. Apply the BLS, Primary, and Secondary Assessments sequence for a systematic evaluation of&nbsp;<br />adult patients&nbsp;<br />2. Perform prompt, high-quality BLS, including prioritizing early chest compressions and integrating&nbsp;<br />early automated external defibrillator (AED) use&nbsp;<br />3. Recognize and perform early management of respiratory arrest&nbsp;<br />4. Discuss early recognition and management of ACS and stroke, including appropriate disposition&nbsp;<br />5. Recognize and perform early management of bradyarrhythmias and tachyarrhythmias that may&nbsp;<br />result in cardiac arrest or complicate resuscitation outcome&nbsp;<br />6. Recognize and perform early management of cardiac arrest until termination of resuscitation or&nbsp;<br />transfer of care, including immediate post&ndash;cardiac arrest care&nbsp;<br />7. Model effective communication as a member or leader of a high-performance team&nbsp;<br />8. Evaluate resuscitative efforts during a cardiac arrest through continuous assessment of CPR&nbsp;<br />quality, monitoring the patient&rsquo;s physiologic response, and delivering real-time feedback to the&nbsp;<br />team&nbsp;<br />9. Recognize the impact of team dynamics on overall team performance&nbsp;<br />10. Discuss how the use of a rapid response team or medical emergency team may improve patient&nbsp;<br />outcomes&nbsp;<br />11. Define systems of care</p>',	NULL,	1,	'AHA Advanced Cardiac Life Support Provider (ACLS)',	'AHA Advanced Cardiac Life Support Provider (ACLS)',	'AHA Advanced Cardiac Life Support Provider (ACLS)',	'2023-11-15 05:56:35',	'2023-11-22 01:13:15'),
(9,	'AHA Pediatric Advanced Life Support Provider (PALS)',	'',	'aha-pediatric-advanced-life-support-provider-pals',	1,	'PALS 1.jpg',	'7 Hours (2 Days)',	NULL,	NULL,	'Written Evaluation: Required for all students as per the AHA policy, Skill Evaluation: Students must performed required skills competently without assistance',	NULL,	'<p>About Course:&nbsp;</p>\r\n<p>The AHA&rsquo;s PALS Course is for healthcare providers who respond to emergencies in infants and&nbsp;<br />children. The goal of PALS is to improve the quality of care provided to seriously ill or injured&nbsp;<br />children, resulting in improved outcomes.&nbsp;<br />The AHA&rsquo;s PALS Course has been updated to reflect new science in the 2020 AHA Guidelines Update for CPR and ECC. This classroom, Instructor-led course uses a series of videos and&nbsp;<br />simulated pediatric emergencies to reinforce the important concepts of a systematic approach&nbsp;<br />to pediatric assessment, basic life support, PALS treatment algorithms, effective resuscitation,&nbsp;<br />and team dynamics. The goal of the PALS Course is to improve the quality of care provided to&nbsp;<br />seriously ill or injured children, resulting in improved outcomes.</p>\r\n<p>Course Content:</p>\r\n<p>At the end of this course, participants should be able to:</p>\r\n<p>1. Describe the timely recognition and interventions required to prevent respiratory and&nbsp;<br />cardiac arrest in any pediatric patient.<br />2. Describe the systematic approach to pediatric assessment by using the initial impression,&nbsp;<br />primary and secondary assessments, and diagnostic tests.<br />3. Describe priorities and specific interventions for infants and children with respiratory and&nbsp;<br />/or circulatory emergencies.<br />4. Explain the importance of effective team dynamics, including individual roles and&nbsp;<br />responsibilities, during a pediatric resuscitation.<br />5. Describe the key elements of postresuscitation management.<br />6. Perform effective, high-quality cardiopulmonary resuscitation (CPR) when appropriate.<br />7. Perform effective respiratory management within scope of practice.<br />8. Select and apply appropriate cardiorespiratory monitoring.<br />9. Select and administer the appropriate medications and electrical therapies when&nbsp;<br />presented with an arrhythmia scenario.<br />10. Establish rapid vascular access to administer fluid and medications.<br />11. Demonstrate effective communication and team dynamics both as a team member and&nbsp;<br />as a team leader.<br />12. Verbalize and demonstrate the initial trauma assessment and stabilization of the injured&nbsp;<br />infant and child.</p>',	NULL,	1,	'AHA Pediatric Advanced Life Support Provider (PALS)',	'AHA Pediatric Advanced Life Support Provider (PALS)',	'AHA Pediatric Advanced Life Support Provider (PALS)',	'2023-11-15 06:01:07',	'2023-12-06 05:53:37'),
(10,	'AHA Heartsaver First Aid CPR AED Provider',	'',	'aha-heartsaver-first-aid-cpr-aed-provider',	1,	'15580376838_2537b6e492_b-1.jpg',	'6 Hours',	NULL,	NULL,	'Skill Evaluation: Students must performed required skills competently without assistance',	NULL,	'<p>About Course:</p>\r\n<p>For anyone with limited or no medical training who needs to learn how to respond to and manage a first&nbsp;<br />aid, choking or sudden cardiac arrest emergency in the first few minutes until emergency responders or&nbsp;<br />healthcare professionals take over. Students learn skills such as how to treat bleeding, sprains, broken&nbsp;<br />bones, shock and other first aid emergencies. This course also teaches adult CPR and AED use.<br />The AHA\'s Heartsaver First Aid CPR AED Course is a classroom, Instructor-led course designed to prepare&nbsp;<br />students to provide first aid, CPR, and use an automated external defibrillator (AED) use in a safe, timely,&nbsp;<br />and effective manner.<br />Upon successful completion of the course, including a first aid skills demonstration and a CPR and AED&nbsp;<br />skills test, students receive a Heartsaver First Aid CPR AED course completion card, valid for two years.</p>\r\n<p>Course Content:&nbsp;</p>\r\n<p>After successfully completing this course, students should be able to:</p>\r\n<p> List the priorities, roles, and responsibilities of first aid rescuers<br /> Describe the key steps in first aid<br /> Remove protective gloves<br /> Find the problem<br /> Describe the assessment and first aid actions for the following life-threatening&nbsp;<br />conditions: heart attack, difficulty breathing, choking, severe bleeding, shock, and&nbsp;<br />stroke<br /> Describe when and how to help a choking adult or child<br /> Demonstrate how to help a choking infant<br /> Use an epinephrine pen<br /> Control bleeding and bandaging<br /> Recognize elements of common injuries<br /> Recognize elements of common illnesses<br /> Describe how to find information on preventing illness and injury<br /> Recognize the legal questions that apply to first aid rescuers<br /> Describe how high-quality CPR improves survival<br /> Explain the concepts of the Chain of Survival<br /> Recognize when someone needs CPR<br /> Perform high-quality CPR for an adult<br /> Describe how to perform CPR with help from others<br /> Give effective breaths using mouth-to-mouth or a mask for all age groups<br /> Demonstrate how to use an AED on an adult<br /> Perform high-quality CPR for a child*<br /> Demonstrate how to use an AED on a child*<br /> Perform high-quality CPR for an infant*<br /> Describe when and how to help a choking adult or child<br /> Demonstrate how to help a choking infant*</p>',	NULL,	1,	'AHA Heartsaver First Aid CPR AED Provider',	'AHA Heartsaver First Aid CPR AED Provider',	'AHA Heartsaver First Aid CPR AED Provider',	'2023-11-15 06:04:28',	'2023-12-06 05:54:29'),
(11,	'AHA Heartsaver First Aid Only',	'',	'aha-heartsaver-first-aid-only',	1,	'First Aid CPR AED.jpg',	'4 Hours',	NULL,	NULL,	'Skill Evaluation: Students must performed required skills competently without assistance',	NULL,	'<p>About Course:&nbsp;</p>\r\n<p>For anyone with limited or no medical training who needs to learn how to respond to and manage a first&nbsp;<br />aid, choking or sudden cardiac arrest emergency in the first few minutes until emergency responders or&nbsp;<br />healthcare professionals take over. Students learn skills such as how to treat bleeding, sprains, broken&nbsp;<br />bones, shock and other first aid emergencies.&nbsp;</p>\r\n<p>The AHA\'s Heartsaver First Aid Course is a classroom, Instructor-led course designed to prepare&nbsp;<br />students to provide first aid use in a safe, timely, and effective manner.</p>\r\n<p>Course Content:&nbsp;</p>\r\n<p>After successfully completing this course, students should be able to:</p>\r\n<p><br /> List the priorities, roles, and responsibilities of first aid rescuers<br /> Describe the key steps in first aid<br /> Remove protective gloves<br /> Find the problem<br /> Describe the assessment and first aid actions for the following life-threatening&nbsp;<br />conditions: heart attack, difficulty breathing, choking, severe bleeding, shock, and&nbsp;<br />stroke<br /> Describe when and how to help a choking adult or child<br /> Demonstrate how to help a choking infant<br /> Use an epinephrine pen<br /> Control bleeding and bandaging<br /> Recognize elements of common injuries<br /> Recognize elements of common illnesses<br /> Describe how to find information on preventing illness and injury<br /> Recognize the legal questions that apply to first aid rescuers</p>',	NULL,	1,	'AHA Heartsaver First Aid Only',	'AHA Heartsaver First Aid Only',	NULL,	'2023-11-15 06:08:50',	'2023-12-06 05:36:33'),
(12,	'AHA Heartsaver CPR AED Only',	'',	'aha-heartsaver-cpr-aed-only',	1,	'AHA-BASIC-LIFE-SUPPORT-768x768.jpg',	'4 Hours',	NULL,	NULL,	'Skill Evaluation: Students must performed required skills competently without assistance',	NULL,	'<p>About Course:&nbsp;</p>\r\n<p>For anyone with limited or no medical training who needs to learn how to respond to and manage a sudden cardiac arrest emergency in the first few minutes until emergency responders or&nbsp;<br />healthcare professionals take over.</p>\r\n<p>The AHA\'s Heartsaver CPR AED Course is a classroom, Instructor-led course designed to prepare&nbsp;<br />students to provide CPR, and use an automated external defibrillator (AED) use in a safe, timely,&nbsp;<br />and effective manner.&nbsp;</p>\r\n<p>Upon successful completion of the course, including a CPR and AED&nbsp;<br />skills test, students receive a Heartsaver CPR AED course completion card, valid for two years.&nbsp;</p>\r\n<p>Course Content:&nbsp;</p>\r\n<p>After successfully completing this course, students should be able to:&nbsp;</p>\r\n<p> Describe how high-quality CPR improves survival<br /> Explain the concepts of the Chain of Survival<br /> Recognize when someone needs CPR<br /> Perform high-quality CPR for an adult<br /> Describe how to perform CPR with help from others<br /> Give effective breaths using mouth-to-mouth or a mask for all age groups<br /> Demonstrate how to use an AED on an adult<br /> Perform high-quality CPR for a child*<br /> Demonstrate how to use an AED on a child*<br /> Perform high-quality CPR for an infant*<br /> Describe when and how to help a choking adult or child<br /> Demonstrate how to help a choking infant*</p>',	NULL,	1,	'AHA Heartsaver CPR AED Only',	'AHA Heartsaver CPR AED Only',	NULL,	'2023-11-15 06:15:19',	'2023-12-06 05:34:11'),
(13,	'AHA Heartsaver Pediatric First Aid CPR AED Provider',	'',	'aha-heartsaver-pediatric-first-aid-cpr-aed-provider',	1,	'ER3q_8qWkAU4lis.jpg',	'6 Hours',	NULL,	NULL,	'Skill Evaluation: Students must performed required skills competently without assistance',	NULL,	'<p>About Course:&nbsp;</p>\r\n<p>The Heartsaver Pediatric First Aid CPR AED Course is designed to meet the regulatory&nbsp;<br />requirements for child care workers in all 50 U.S. states. It teaches child care providers and&nbsp;<br />others to respond to illnesses and injuries in a child or infant in the first few minutes until&nbsp;<br />professional help arrives.<br />The course covers child/infant CPR, child/infant AED, child/infant choking, and pediatric first&nbsp;<br />aid. Adult modules in CPR, AED and choking are optional.<br />Upon successful completion of the course, including a first aid skills demonstration and a CPR&nbsp;<br />and AED skills test, students receive a Heartsaver Pediatric First Aid CPR AED course completion&nbsp;<br />card, valid for two years.&nbsp;</p>\r\n<p>Course Content:&nbsp;</p>\r\n<p>First Aid Basics: Duties and Key Steps<br />Illnesses and injuries</p>\r\n<p><br /> Controlling Bleeding and Bandaging<br /> Using a Tourniquet<br /> Shock<br /> Internal bleeding<br /> Burns and electrical injuries<br /> Allergic Reactions<br /> Using an epinephrine pen<br /> Breathing problems<br /> Choking<br /> Dehydration<br /> Diabetes and low blood sugar<br /> Heat-related emergencies<br /> Cold-related emergencies<br /> Amputations<br /> Bites and stings<br /> Broken bones and sprains<br /> Eye injuries<br /> Bleeding from the nose<br /> Fainting<br /> Head, neck, and spine Injuries<br /> Penetrating and puncturing injuries<br /> Poison emergencies<br /> Seizure<br /> Mouth and cheek injuries<br /> Preventing Illness and Injury</p>\r\n<p>&nbsp;</p>',	NULL,	1,	'AHA Heartsaver Pediatric First Aid CPR AED Provider',	'AHA Heartsaver Pediatric First Aid CPR AED Provider',	NULL,	'2023-11-15 06:19:50',	'2023-11-22 01:18:16'),
(14,	'Advance Infection Control (AIC)',	'',	'advance-infection-control-aic',	3,	'group003686_original_1200Wx1200H_8821162278942.jfif',	'5 Hours',	NULL,	NULL,	'Skill Evaluation: Pre-Test and Post Test will be provided, Skill Evaluation: Students must perform required skills competently without assistance',	NULL,	'<p>About Course:</p>\r\n<p>The Advanced Certificate in Infection Prevention and Control is an advanced program aimed at health&nbsp;<br />professionals interested in infection prevention or considering a career in the field of infection&nbsp;<br />prevention and control. The &ldquo;Advanced Certificate in Infection Prevention and Control&rdquo; is upgraded to&nbsp;<br />cover astute guidelines and components of infection prevention and control. This course helps in&nbsp;<br />understanding the basic concepts of healthcare-associated infections enabling the practitioners to serve&nbsp;<br />the communities better.</p>\r\n<p>After completing a course student will get 5 CME points for Doh.&nbsp;</p>\r\n<p>Course Content:</p>\r\n<p>1. Basic of Infection Control<br />2. Nosocomial Infections<br />3. Use of Personal Protective Equipment&rsquo;s<br />4. Hand Hygiene<br />5. Cleaning, Disinfection, Sterilization<br />6. Staff Health, immunization, and Training<br />7. Surveillance and Reporting<br />8. Common Healthcare Associated Infections<br />9. Communicable Disease Outbreaks<br />10. Additional Precautions</p>',	NULL,	1,	'Advance Infection Control (AIC)',	'Advance Infection Control (AIC)',	'Advance Infection Control (AIC)',	'2023-11-15 06:25:25',	'2023-11-22 01:26:17'),
(15,	'Basic Infection Control (BIC)',	'',	'basic-infection-control-bic',	3,	'thumb_basic_infection.png',	'5 Hours',	NULL,	NULL,	'Skill Evaluation: Pre-Test and Post Test will be provided',	NULL,	'<p>About Course:</p>\r\n<p>This training will teach you about the protection of all service users, service providers and the wider&nbsp;<br />community. It explains the requirements for infection prevention, describing micro-organisms, and&nbsp;<br />infection prevention procedures that include hand decontamination and standard precautions.<br />Additionally, it covers discussions on listing relevant legislation applicable to work in a care setting and&nbsp;<br />stating sources of useful additional information.</p>\r\n<p>After completing a course student will get 5 CME points for Doh.</p>\r\n<p><br />Course Content:</p>\r\n<p>1. Basic of Infection Control<br />2. Principles of Infection Control<br />3. Nosocomial Infection<br />4. Preventing and Controlling of HCAI<br />5. Mandatory Immunization&nbsp;</p>',	NULL,	1,	'Basic Infection Control (BIC)',	'Basic Infection Control (BIC)',	NULL,	'2023-11-15 06:27:14',	'2023-12-06 05:50:37'),
(16,	'Sterilization and Disinfection (CSSD)',	'',	'sterilization-and-disinfection-cssd',	3,	'thumb_sterization.png',	'6 Hours',	NULL,	NULL,	'Skill Evaluation: Pre-Test and Post Test will be provided',	NULL,	'<p>About Course:</p>\r\n<p>This program aims to improve the skills and knowledge of CSSD professionals and gain the necessary&nbsp;<br />knowledge to perform their duties as central service professionals, participants learn how to work in&nbsp;<br />CSSD with high quality and play a key role in maintaining the sterility assurance level of instruments in&nbsp;<br />collaboration with involved healthcare workers.</p>\r\n<p>After completing a course student will get 6 CME points for Doh.</p>\r\n<p><br />Course Content:</p>\r\n<p>1. Sterilization and Disinfection<br />2. Methods of Sterilization<br />3. Autoclave Machine<br />4. Packing the Autoclaved Items<br />5. Operating Autoclave Machine<br />6. Radiation Sterilization</p>',	NULL,	1,	'Sterilization and Disinfection (CSSD)',	'Sterilization and Disinfection (CSSD)',	NULL,	'2023-11-15 06:32:25',	'2023-12-06 05:51:33'),
(17,	'Iv Therapy and Cannulation',	'',	'iv-therapy-and-cannulation',	3,	'thumb_iv.png',	'7 Hours',	NULL,	NULL,	'Skill Evaluation: Pre-Test and Post Test will be provided, Skill Evaluation: Students must perform required skills competently without assistance',	NULL,	'<p>About Course:</p>\r\n<p>This program includes a thorough overview and introduction of IV Therapy for nurses and other&nbsp;<br />interested healthcare personnel.<br />It covers the legal aspects, special patient populations, current standards of practice, review of current&nbsp;<br />peripheral venous access devices and the peripheral IV catheter insertion procedure, IV Complication&nbsp;<br />and management, maintenance recommendations, and site care.</p>\r\n<p>After completing a course, student will get 7 CME points for Doh.</p>\r\n<p><br />Course Content:</p>\r\n<p>1. Principles of Venipuncture<br />2. Common Sites of Venipuncture<br />3. How to Prepare the Equipment&rsquo;s and how to use them.<br />4. Purposes and Uses of Intravenous Therapy<br />5. Understand the Initiation and administration of IV solutions and their complications.<br />6. Types of Access Sites<br />7. Importance of maintaining intake ad output<br />8. Implication of intake and output measurements<br />9. Proper insertion of IV line<br />10. Practice insertion IV line<br />11. Administration of Blood Products<br />12. Types of blood components<br />13. Types of blood donations and compatibility<br />14. Discussion of infusion pumps and blood warmers<br />15. Review the precautions and nursing responsibilities.<br />16. Discussion on the Complications<br />17. Demonstration how to properly administer blood products.</p>',	NULL,	1,	'Iv Therapy and Cannulation',	'Iv Therapy and Cannulation',	'Iv Therapy and Cannulation',	'2023-11-15 06:34:52',	'2023-12-06 05:52:22'),
(19,	'Highfield Level 3 International Award in Emergency First Aid at  Work',	'',	'highfield-level-3-international-award-in-emergency-first-aid-at-work',	2,	'thumb_FA3.jpg',	'6 Hours',	NULL,	NULL,	NULL,	NULL,	'<p>About Course:</p>\r\n<p>This qualification has been developed for those already working, or preparing to work, in the&nbsp;<br />industry and who have been identified in the company&rsquo;s first aid risk assessment as being required&nbsp;<br />to provide first aid in the workplace.<br />This international qualification would be typically delivered to learners through a 1-day training&nbsp;<br />course (6 hours).<br />Topics covered include the role and responsibilities of a first-aider, assessing an incident,&nbsp;<br />unresponsive casualties (breathing and not breathing), choking, shock and minor injuries.</p>\r\n<p>Course Content:</p>\r\n<p>1. Adult First Aid | Adult CPR AED<br />2. Adult First Aid | Adult/Child CPR AED<br />3. Adult First Aid | Adult/Infant CPR AED<br />4. Adult First Aid | Adult/Child/Infant CPR AED<br />5. Adult First Aid<br />6. Adult CPR AED<br />7. Adult/Child CPR AED<br />8. Adult/Infant CPR AED<br />9. Adult/Child/Infant CPR AED&nbsp;</p>',	NULL,	1,	'Highfield Level 3 International Award in Emergency First Aid at  Work',	'Highfield Level 3 International Award in Emergency First Aid at  Work',	NULL,	'2023-11-15 06:44:32',	'2023-12-06 05:46:57'),
(20,	'Highfield Level 3 International Award in Emergency First Aid,  Use of an AED with CPR for All Ages',	'',	'highfield-level-3-international-award-in-emergency-first-aid-use-of-an-aed-with-cpr-for-all-ages',	2,	'thumb_business-team-meeting-around-board-table-presenti-2022-12-16-02-07-37-utc.jpg',	'7 Hours',	NULL,	NULL,	'Skill Evaluation: Students must performed required skills competently without assistance.',	NULL,	'<p>About Course:&nbsp;</p>\r\n<p>The Level 3 International Award in Emergency First Aid, Defibrillation and CPR is a qualification&nbsp;<br />aimed at providing learners with the necessary knowledge, understanding and skills to conduct&nbsp;<br />emergency first aid and to use a defibrillator. The Highfield Level 3 International Award in Emergency&nbsp;<br />First Aid, Defib and CPR is accredited and recognised internationally and has been developed to&nbsp;<br />protect customers, brand reputation and profits.</p>\r\n<p>This qualification is usually obtained by taking a 1-day (7 hours) classroom-based course.</p>\r\n<p>Course Content:&nbsp;</p>\r\n<p>1. Adult First Aid | Adult CPR AED<br />2. Adult First Aid | Adult/Child CPR AED<br />3. Adult First Aid | Adult/Infant CPR AED<br />4. Adult First Aid | Adult/Child/Infant CPR AED<br />5. Adult First Aid<br />6. Adult CPR AED<br />7. Adult/Child CPR AED<br />8. Adult/Infant CPR AED<br />9. Adult/Child/Infant CPR AED&nbsp;</p>',	NULL,	1,	'Highfield Level 3 International Award in Emergency First Aid,  Use of an AED with CPR for All Ages',	'Highfield Level 3 International Award in Emergency First Aid,  Use of an AED with CPR for All Ages',	NULL,	'2023-11-15 06:50:37',	'2023-12-06 05:48:24'),
(21,	'Highfield Level 3 International Award in Paediatric First Aid and Safe  Use of an Automated External Defibrillator',	'',	'highfield-level-3-international-award-in-paediatric-first-aid-and-safe-use-of-an-automated-external-defibrillator',	2,	'Paediatric-First-Aid-1200x565.jpg',	'7 Hours',	NULL,	NULL,	'Skill Evaluation: Students must perform required skills competently without assistance',	NULL,	'<p>About Course:&nbsp;</p>\r\n<p>The Highfield Level 3 International Award in Paediatric First Aid and Safe use of an Automated External&nbsp;<br />Defibrillator is a qualification developed by Highfield, the Middle East&rsquo;s leading supplier of compliance based qualifications. The qualification developed by Highfield has been designed with sector experts&nbsp;<br />specifically for international learners who wish to become paediatric first aiders. It has taken into&nbsp;<br />account recognised best-practice principles of paediatric first aid and covers areas such as&nbsp;<br />understanding the role of paediatric first aider; being able to assess an emergency situation; providing&nbsp;<br />first aid to a child or infant and sage use of AED. The qualification provides an excellent basis for&nbsp;<br />international learners who may wish to undertake further first aid qualifications.&nbsp;</p>\r\n<p>Course Content:&nbsp;</p>\r\n<p>1. Pediatric First Aid<br />2. Child and Infant CPR AED<br />3. Child, Infant, and Adult CPR AED<br />4. Pediatric First Aid | Child and Infant CPR AED<br />5. Pediatric First Aid | Child, Infant, and Adult CPR AED&nbsp;</p>',	NULL,	1,	'Highfield Level 3 International Award in Paediatric First Aid and Safe  Use of an Automated External Defibrillator',	'Highfield Level 3 International Award in Paediatric First Aid and Safe  Use of an Automated External Defibrillator',	NULL,	'2023-11-15 06:54:52',	'2023-12-06 05:58:13');

-- 2025-05-22 08:58:03

-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

INSERT INTO `course_calendars` (`id`, `course_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(102,	10,	'2024-05-21',	1,	'2024-03-20 05:01:03',	'2024-03-20 05:01:03'),
(103,	10,	'2024-05-23',	1,	'2024-03-20 05:01:03',	'2024-03-20 05:01:03'),
(104,	10,	'2024-05-28',	1,	'2024-03-20 05:01:03',	'2024-03-20 05:01:03'),
(105,	10,	'2024-05-30',	1,	'2024-03-20 05:01:03',	'2024-03-20 05:01:03'),
(117,	7,	'2024-05-15',	1,	'2024-05-09 06:02:26',	'2024-05-09 06:02:26'),
(118,	7,	'2024-05-22',	1,	'2024-05-09 06:02:26',	'2024-05-09 06:02:26'),
(119,	7,	'2024-05-29',	1,	'2024-05-09 06:02:26',	'2024-05-09 06:02:26'),
(120,	7,	'2024-06-05',	1,	'2024-05-09 06:02:26',	'2024-05-09 06:02:26'),
(121,	7,	'2024-06-12',	1,	'2024-05-09 06:02:26',	'2024-05-09 06:02:26'),
(122,	7,	'2024-06-19',	1,	'2024-05-09 06:02:26',	'2024-05-09 06:02:26'),
(123,	7,	'2024-06-26',	1,	'2024-05-09 06:02:26',	'2024-05-09 06:02:26'),
(124,	9,	'2024-05-30',	1,	'2024-05-09 06:05:02',	'2024-05-09 06:05:02'),
(125,	9,	'2024-05-31',	1,	'2024-05-09 06:05:02',	'2024-05-09 06:05:02'),
(126,	9,	'2024-05-18',	1,	'2024-05-09 06:05:17',	'2024-05-09 06:05:17'),
(127,	9,	'2024-05-19',	1,	'2024-05-09 06:05:17',	'2024-05-09 06:05:17'),
(128,	8,	'2024-05-21',	1,	'2024-05-09 06:05:35',	'2024-05-09 06:05:35'),
(129,	8,	'2024-05-22',	1,	'2024-05-09 06:05:35',	'2024-05-09 06:05:35'),
(130,	7,	'2024-06-07',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(131,	7,	'2024-06-14',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(132,	7,	'2024-06-21',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(133,	7,	'2024-06-28',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(134,	7,	'2024-07-05',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(135,	7,	'2024-07-12',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(136,	7,	'2024-07-19',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(137,	7,	'2024-07-26',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(138,	7,	'2024-07-03',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(139,	7,	'2024-07-10',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(140,	7,	'2024-07-17',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(141,	7,	'2024-07-24',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(142,	7,	'2024-07-31',	1,	'2024-05-09 06:07:21',	'2024-05-09 06:07:21'),
(143,	10,	'2024-06-04',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(144,	10,	'2024-06-06',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(145,	10,	'2024-06-11',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(146,	10,	'2024-06-18',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(147,	10,	'2024-06-25',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(148,	10,	'2024-06-13',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(149,	10,	'2024-06-20',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(150,	10,	'2024-06-27',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(151,	10,	'2024-07-02',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(152,	10,	'2024-07-04',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(153,	10,	'2024-07-09',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(154,	10,	'2024-07-16',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(155,	10,	'2024-07-23',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(156,	10,	'2024-07-30',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(157,	10,	'2024-07-11',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(158,	10,	'2024-07-18',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(159,	10,	'2024-07-25',	1,	'2024-05-09 06:07:59',	'2024-05-09 06:07:59'),
(161,	7,	'2024-08-02',	1,	'2024-07-30 07:35:19',	'2024-07-30 07:35:19'),
(162,	7,	'2024-08-09',	1,	'2024-07-30 07:36:09',	'2024-07-30 07:36:09'),
(163,	7,	'2024-08-16',	1,	'2024-07-30 07:36:09',	'2024-07-30 07:36:09'),
(164,	7,	'2024-08-23',	1,	'2024-07-30 07:36:09',	'2024-07-30 07:36:09'),
(165,	7,	'2024-08-30',	1,	'2024-07-30 07:36:09',	'2024-07-30 07:36:09'),
(166,	10,	'2024-08-06',	1,	'2024-07-30 07:40:46',	'2024-07-30 07:40:46'),
(167,	10,	'2024-08-13',	1,	'2024-07-30 07:40:46',	'2024-07-30 07:40:46'),
(168,	10,	'2024-08-20',	1,	'2024-07-30 07:40:46',	'2024-07-30 07:40:46'),
(169,	10,	'2024-08-27',	1,	'2024-07-30 07:40:46',	'2024-07-30 07:40:46'),
(170,	7,	'2024-09-06',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(171,	7,	'2024-09-13',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(172,	7,	'2024-09-20',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(173,	7,	'2024-09-27',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(174,	7,	'2024-10-04',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(175,	7,	'2024-09-10',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(176,	7,	'2024-09-17',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(177,	7,	'2024-09-24',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(178,	7,	'2024-10-01',	1,	'2024-08-18 16:34:18',	'2024-08-18 16:34:18'),
(179,	10,	'2024-09-04',	1,	'2024-08-18 16:38:15',	'2024-08-18 16:38:15'),
(180,	10,	'2024-09-11',	1,	'2024-08-18 16:38:15',	'2024-08-18 16:38:15'),
(181,	10,	'2024-09-18',	1,	'2024-08-18 16:38:15',	'2024-08-18 16:38:15'),
(182,	10,	'2024-09-25',	1,	'2024-08-18 16:38:15',	'2024-08-18 16:38:15'),
(183,	7,	'2025-02-28',	1,	'2025-02-11 12:08:57',	'2025-02-11 12:08:57'),
(184,	7,	'2025-03-07',	1,	'2025-02-11 12:11:56',	'2025-02-11 12:11:56'),
(185,	7,	'2025-03-12',	1,	'2025-02-11 12:11:56',	'2025-02-11 12:11:56'),
(186,	7,	'2025-03-17',	1,	'2025-02-11 12:11:56',	'2025-02-11 12:11:56'),
(187,	7,	'2025-03-27',	1,	'2025-02-11 12:11:56',	'2025-02-11 12:11:56'),
(188,	8,	'2025-03-05',	1,	'2025-02-11 12:13:35',	'2025-02-11 12:13:35'),
(189,	8,	'2025-03-06',	1,	'2025-02-11 12:13:35',	'2025-02-11 12:13:35'),
(190,	8,	'2025-03-19',	1,	'2025-02-11 12:13:35',	'2025-02-11 12:13:35'),
(191,	8,	'2025-03-20',	1,	'2025-02-11 12:13:35',	'2025-02-11 12:13:35'),
(192,	8,	'2025-03-28',	1,	'2025-02-11 12:13:35',	'2025-02-11 12:13:35'),
(193,	8,	'2025-03-29',	1,	'2025-02-11 12:13:35',	'2025-02-11 12:13:35');

INSERT INTO `images` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1,	'1700563105.jpg',	1,	'2023-11-21 05:08:26',	'2023-11-21 05:08:26'),
(2,	'1700563119.jpg',	1,	'2023-11-21 05:08:40',	'2023-11-21 05:08:40'),
(3,	'1700563129.jpg',	1,	'2023-11-21 05:08:50',	'2023-11-21 05:08:50'),
(4,	'1700563143.jpg',	1,	'2023-11-21 05:09:04',	'2023-11-21 05:09:04'),
(5,	'1701936651.png',	1,	'2023-12-07 08:10:51',	'2023-12-07 08:10:51'),
(6,	'1701936674.png',	1,	'2023-12-07 08:11:14',	'2023-12-07 08:11:14'),
(7,	'1701936694.png',	1,	'2023-12-07 08:11:34',	'2023-12-07 08:11:34');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2022_07_25_060635_create_admins_table',	1),
(3,	'2022_07_25_100352_create_blog_categories_table',	2),
(4,	'2022_07_25_122010_create_blog_posts_table',	3),
(5,	'2022_07_26_160926_create_work_categories_table',	4),
(6,	'2022_07_26_163909_create_work_projects_table',	5),
(8,	'2022_07_26_193651_create_work_images_table',	6),
(9,	'2022_08_01_055610_add_columns_to_work_categories_table',	7),
(10,	'2023_11_10_045320_create_categories_table',	8),
(11,	'2023_11_10_061230_create_courses_table',	9),
(12,	'2023_11_13_115353_create_course_calendars_table',	10);

-- 2025-05-22 08:58:39