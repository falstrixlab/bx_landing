-- Migration: Create tbl_partnership table
-- Run this SQL in your MySQL database (admbxsea_bxsea)

CREATE TABLE IF NOT EXISTS `tbl_partnership` (
  `partnership_id` int(11) NOT NULL AUTO_INCREMENT,
  `partnership_name` varchar(255) NOT NULL,
  `partnership_email` varchar(255) DEFAULT NULL,
  `partnership_phone` varchar(50) DEFAULT NULL,
  `partnership_desc` text DEFAULT NULL,
  `partnership_pict` varchar(255) DEFAULT NULL,
  `partnership_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `partnership_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`partnership_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add article_category column to tbl_article if not exists (for whats new tabs)
ALTER TABLE `tbl_article` 
  ADD COLUMN IF NOT EXISTS `article_category` int(11) DEFAULT 1 COMMENT '1=News, 2=Awards, 3=Conservation';
