-- Visitors Tracking Table
-- Run this SQL in phpMyAdmin to create the visitors tracking table

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `visit_date` date NOT NULL,
  `visit_time` datetime NOT NULL,
  `user_agent` text,
  `referrer` varchar(500),
  `page_url` varchar(500),
  `is_unique_visitor` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visit_date` (`visit_date`),
  KEY `session_id` (`session_id`),
  KEY `ip_address` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create an index for faster queries on date-based reports
CREATE INDEX idx_visit_date ON visitors(visit_date);

