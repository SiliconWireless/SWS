-- AssetPulse MySQL bootstrap script
-- Database: siliconcpanel_basset
-- Compatible with MySQL 8+

CREATE DATABASE IF NOT EXISTS `siliconcpanel_basset`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `siliconcpanel_basset`;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `code` VARCHAR(30) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NULL,
  `address` TEXT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organizations_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization_id` BIGINT UNSIGNED NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('super_admin','admin','user') NOT NULL DEFAULT 'user',
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_organization_id_foreign` (`organization_id`),
  CONSTRAINT `users_organization_id_foreign`
    FOREIGN KEY (`organization_id`) REFERENCES `organizations`(`id`)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization_id` BIGINT UNSIGNED NOT NULL,
  `plan_name` VARCHAR(255) NOT NULL,
  `starts_at` DATE NOT NULL,
  `ends_at` DATE NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `status` ENUM('active','expired','cancelled') NOT NULL DEFAULT 'active',
  `renewal_notes` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_organization_id_foreign` (`organization_id`),
  CONSTRAINT `subscriptions_organization_id_foreign`
    FOREIGN KEY (`organization_id`) REFERENCES `organizations`(`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `assets` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization_id` BIGINT UNSIGNED NOT NULL,
  `asset_code` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `category` VARCHAR(255) NOT NULL,
  `serial_number` VARCHAR(255) NULL,
  `ble_mac` VARCHAR(32) NULL,
  `status` ENUM('checked_in','checked_out','maintenance') NOT NULL DEFAULT 'checked_out',
  `last_seen_at` TIMESTAMP NULL DEFAULT NULL,
  `last_gateway_mac` VARCHAR(32) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `assets_organization_id_asset_code_unique` (`organization_id`, `asset_code`),
  KEY `assets_ble_mac_index` (`ble_mac`),
  CONSTRAINT `assets_organization_id_foreign`
    FOREIGN KEY (`organization_id`) REFERENCES `organizations`(`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `beacon_scans` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization_id` BIGINT UNSIGNED NULL,
  `gateway_mac` VARCHAR(32) NOT NULL,
  `ble_mac` VARCHAR(32) NOT NULL,
  `gateway_timestamp` TIMESTAMP NULL DEFAULT NULL,
  `tag_timestamp` TIMESTAMP NULL DEFAULT NULL,
  `raw_payload` JSON NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beacon_scans_organization_id_foreign` (`organization_id`),
  KEY `beacon_scans_gateway_mac_index` (`gateway_mac`),
  KEY `beacon_scans_ble_mac_index` (`ble_mac`),
  CONSTRAINT `beacon_scans_organization_id_foreign`
    FOREIGN KEY (`organization_id`) REFERENCES `organizations`(`id`)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `asset_movement_logs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` BIGINT UNSIGNED NOT NULL,
  `event_type` ENUM('check_in','check_out') NOT NULL,
  `source` VARCHAR(255) NOT NULL DEFAULT 'manual',
  `gateway_mac` VARCHAR(32) NULL,
  `event_at` TIMESTAMP NOT NULL,
  `notes` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_movement_logs_asset_id_foreign` (`asset_id`),
  CONSTRAINT `asset_movement_logs_asset_id_foreign`
    FOREIGN KEY (`asset_id`) REFERENCES `assets`(`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional starter rows (replace password hashes as needed)
INSERT INTO `users` (`organization_id`,`name`,`email`,`password`,`role`,`is_active`,`created_at`,`updated_at`)
SELECT NULL,'Super Admin','superadmin@assetpulse.test','$2y$10$ReplaceWithLaravelBcryptHash','super_admin',1,NOW(),NOW()
WHERE NOT EXISTS (
  SELECT 1 FROM `users` WHERE `email`='superadmin@assetpulse.test'
);

SET FOREIGN_KEY_CHECKS = 1;
