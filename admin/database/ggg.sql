select * from reports;
select * from regions;
select * from districts;
select * from chiefdoms;
select * from users;
DESCRIBE users;
INSERT INTO `users` (`username`, `password`, `role`) VALUES
('superadmin', '$2y$10$zP.UO2R.iB8.b.9pXoI6A.5/5t.zL7.jE1k9.Q1j2oI3eR1oN0tIu', 'super_admin');
-- SQL Script for creating the Citiguard database and all related tables.
-- Version: 2.0 (Final - Adopting hierarchical region structure)
-- Database Name: citiguard_db

-- Create the database if it doesn't already exist
CREATE DATABASE IF NOT EXISTS `citiguard_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the created database
USE `citiguard_db`;

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL COMMENT 'Store securely hashed passwords only',
  `role` ENUM('ADMIN', 'SUPER_ADMIN') NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- --------------------------------------------------------

-- Table structure for table `regions` (Top-level: e.g., Eastern, Northern)
CREATE TABLE `regions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- --------------------------------------------------------

-- Table structure for table `districts` (Mid-level: e.g., Kenema, Bo)
CREATE TABLE `districts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `region_id` INT NOT NULL,
  FOREIGN KEY (`region_id`) REFERENCES `regions`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- --------------------------------------------------------

-- Table structure for table `chiefdoms` (Lowest-level: e.g., Nongowa)
CREATE TABLE `chiefdoms` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `district_id` INT NOT NULL,
  FOREIGN KEY (`district_id`) REFERENCES `districts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- --------------------------------------------------------

-- Table structure for table `reports`
CREATE TABLE `reports` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `report_type` ENUM('VOICE', 'TEXT') NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'New',
  `region_id` INT NULL,
  `district_id` INT NULL,
  `chiefdom_id` INT NULL,
  `location_lat` DECIMAL(10, 8) NULL,
  `location_lon` DECIMAL(11, 8) NULL,
  `location_desc` TEXT NULL,
  `incident_desc_text` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` TIMESTAMP NULL COMMENT 'For soft deletes.',
  FOREIGN KEY (`region_id`) REFERENCES `regions`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`district_id`) REFERENCES `districts`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`chiefdom_id`) REFERENCES `chiefdoms`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

-- Table structure for table `evidence`
CREATE TABLE `evidence` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `report_id` INT NOT NULL,
  `file_type` VARCHAR(50) NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`report_id`) REFERENCES `reports`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- --------------------------------------------------------

-- Table structure for table `audit_log`
CREATE TABLE `audit_log` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `action` VARCHAR(255) NOT NULL,
  `target_id` INT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- POPULATE LOCATION DATA
--

-- Populate `regions`
INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'Eastern'),
(2, 'Northern'),
(3, 'Northwest'),
(4, 'Southern'),
(5, 'Western Area');

-- Populate `districts`
INSERT INTO `districts` (`id`, `name`, `region_id`) VALUES
(1, 'Kailahun', 1), (2, 'Kenema', 1), (3, 'Kono', 1),
(4, 'Bombali', 2), (5, 'Tonkolili', 2), (6, 'Falaba', 2),
(7, 'Bo', 4), (8, 'Moyamba', 4), (9, 'Pujehun', 4), (10, 'Bonthe', 4),
(11, 'Western Area Urban', 5), (12, 'Western Area Rural', 5),
(13, 'Port Loko', 3), (14, 'Kambia', 3), (15, 'Karene', 3);

-- Populate `chiefdoms`
INSERT INTO `chiefdoms` (`id`, `name`, `district_id`) VALUES
(1, 'Dea', 1), (2, 'Luawa', 1), (3, 'Jaluahun', 1),
(4, 'Nongowa', 2), (5, 'Tunkia', 2), (6, 'Dama', 2),
(7, 'Tankoro', 3), (8, 'Gbense', 3), (9, 'Kamara', 3),
(10, 'Makeni', 4), (11, 'Biriwa', 4), (12, 'Paki Masabong', 4),
(13, 'Magburaka', 5), (14, 'Kunike', 5), (15, 'Kholifa Rowalla', 5),
(16, 'Mongo', 6), (17, 'Wara Wara', 6), (18, 'Sinkunia', 6),
(19, 'Bo City', 7), (20, 'Kakua', 7), (21, 'Badjia', 7),
(22, 'Kaiyamba', 8), (23, 'Bumpeh', 8), (24, 'Ribbi', 8),
(25, 'Pujehun', 9), (26, 'Gallines', 9), (27, 'Soro Gbema', 9),
(28, 'Bonthe', 10), (29, 'Jong', 10), (30, 'Sittia', 10),
(31, 'Freetown', 11), (32, 'Central', 11), (33, 'Mountain', 11),
(34, 'Waterloo', 12), (35, 'Koya', 12), (36, 'Western Rural', 12),
(37, 'Kafu Bullom', 13), (38, 'Masimera', 13), (39, 'Loko Massama', 13),
(40, 'Magbema', 14), (41, 'Tonko Limba', 14), (42, 'Mambolo', 14),
(43, 'Sanda Loko', 15), (44, 'Sella Limba', 15), (45, 'Gbanti', 15);


-- Set AUTO_INCREMENT values to continue after inserted data
ALTER TABLE `regions` AUTO_INCREMENT = 6;
ALTER TABLE `districts` AUTO_INCREMENT = 16;
ALTER TABLE `chiefdoms` AUTO_INCREMENT = 46;

--
-- End of script.
--

