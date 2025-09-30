CREATE DATABASE db_sierra_shop;
USE db_sierra_shop;
USE gallant_minds;
USE new_mvc_shop_db;

Create database SaloneShop;
drop database db_sierra_shop;

CREATE DATABASE new_mvc_shop_db;

CREATE TABLE `users_online` (
  `session` varchar(191) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`session`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

ALTER TABLE table_name ADD COLUMN ip VARCHAR(45) DEFAULT NULL;
UPDATE users SET user_password = '$2y$10$Hrsv2BtSdnnqVCMZ0pgSvOBp/XbhC2DRLq1MGyA1gCm8jrUsY15Fy' WHERE id = 1040;
UPDATE users SET role_id = '2' WHERE id = 1044;

select * from users;

ALTER TABLE orders 
ADD payment_method VARCHAR(20) DEFAULT 'cod',
ADD payment_status VARCHAR(20) DEFAULT 'pending',
ADD payment_time DATETIME NULL,
ADD payment_transaction_id VARCHAR(100) NULL;
