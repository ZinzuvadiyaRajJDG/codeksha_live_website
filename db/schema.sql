-- ============================================================================
-- Codeksha admin panel + analytics — database schema (MySQL / MariaDB)
--
-- Local:   "C:\xampp\mysql\bin\mysql.exe" -uroot < db/schema.sql
-- cPanel:  create the DB + user first, then import this file in phpMyAdmin
--          with that database selected. You may delete the two lines below.
-- ============================================================================
CREATE DATABASE IF NOT EXISTS `codeksha_admin` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `codeksha_admin`;

-- ---------------------------------------------------------------------------
-- Visitors — one row per anonymous person (first-party cookie `ck_vid`)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `visitors` (
  `id`                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`               CHAR(36)        NOT NULL,
  `first_seen`        DATETIME        NOT NULL,
  `last_seen`         DATETIME        NOT NULL,
  `visits`            INT UNSIGNED    NOT NULL DEFAULT 1,
  `pageviews`         INT UNSIGNED    NOT NULL DEFAULT 0,
  `first_landing`     VARCHAR(512)    NULL,
  `first_referrer`    VARCHAR(512)    NULL,
  `first_referrer_host` VARCHAR(191)  NULL,
  `first_utm_source`  VARCHAR(128)    NULL,
  `first_utm_medium`  VARCHAR(128)    NULL,
  `first_utm_campaign` VARCHAR(191)   NULL,
  `first_utm_term`    VARCHAR(191)    NULL,
  `first_utm_content` VARCHAR(191)    NULL,
  `ip`                VARCHAR(45)     NULL,
  `country`           VARCHAR(2)      NULL,
  `region`            VARCHAR(96)     NULL,
  `city`              VARCHAR(96)     NULL,
  `ua`                VARCHAR(512)    NULL,
  `browser`           VARCHAR(64)     NULL,
  `browser_version`   VARCHAR(32)     NULL,
  `os`                VARCHAR(64)     NULL,
  `device_type`       VARCHAR(16)     NULL,       -- desktop / mobile / tablet / bot
  `is_bot`            TINYINT(1)      NOT NULL DEFAULT 0,
  `excluded`          TINYINT(1)      NOT NULL DEFAULT 0,   -- internal / filtered traffic
  `screen_w`          SMALLINT UNSIGNED NULL,
  `screen_h`          SMALLINT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`),
  KEY `first_seen` (`first_seen`),
  KEY `last_seen` (`last_seen`),
  KEY `flags` (`is_bot`,`excluded`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- Sessions — a visit (gap of >30 min starts a new one)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sessions` (
  `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `sid`           CHAR(36)        NOT NULL,
  `visitor_id`    BIGINT UNSIGNED NOT NULL,
  `started_at`    DATETIME        NOT NULL,
  `last_activity` DATETIME        NOT NULL,
  `duration_sec`  INT UNSIGNED    NOT NULL DEFAULT 0,
  `pageviews`     INT UNSIGNED    NOT NULL DEFAULT 0,
  `events`        INT UNSIGNED    NOT NULL DEFAULT 0,
  `entry_path`    VARCHAR(512)    NULL,
  `exit_path`     VARCHAR(512)    NULL,
  `referrer`      VARCHAR(512)    NULL,
  `referrer_host` VARCHAR(191)    NULL,
  `utm_source`    VARCHAR(128)    NULL,
  `utm_medium`    VARCHAR(128)    NULL,
  `utm_campaign`  VARCHAR(191)    NULL,
  `channel`       VARCHAR(24)     NULL,           -- direct / organic / social / referral / paid / email
  `is_bounce`     TINYINT(1)      NOT NULL DEFAULT 1,
  `is_bot`        TINYINT(1)      NOT NULL DEFAULT 0,
  `excluded`      TINYINT(1)      NOT NULL DEFAULT 0,
  `country`       VARCHAR(2)      NULL,
  `device_type`   VARCHAR(16)     NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sid` (`sid`),
  KEY `visitor_id` (`visitor_id`),
  KEY `started_at` (`started_at`),
  KEY `last_activity` (`last_activity`),
  KEY `flags` (`is_bot`,`excluded`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- Page views
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pageviews` (
  `id`               BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pvid`             CHAR(36)        NOT NULL,
  `session_id`       BIGINT UNSIGNED NOT NULL,
  `visitor_id`       BIGINT UNSIGNED NOT NULL,
  `path`             VARCHAR(512)    NOT NULL,
  `query`            VARCHAR(512)    NULL,
  `title`            VARCHAR(255)    NULL,
  `referrer`         VARCHAR(512)    NULL,
  `created_at`       DATETIME        NOT NULL,
  `time_on_page_sec` INT UNSIGNED    NULL,
  `max_scroll_pct`   TINYINT UNSIGNED NULL,
  `viewport_w`       SMALLINT UNSIGNED NULL,
  `viewport_h`       SMALLINT UNSIGNED NULL,
  `is_entry`         TINYINT(1)      NOT NULL DEFAULT 0,
  `is_bot`           TINYINT(1)      NOT NULL DEFAULT 0,
  `excluded`         TINYINT(1)      NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pvid` (`pvid`),
  KEY `session_id` (`session_id`),
  KEY `visitor_id` (`visitor_id`),
  KEY `created_at` (`created_at`),
  KEY `path` (`path`(191)),
  KEY `flags` (`is_bot`,`excluded`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- Events — clicks, outbound links, tel/mailto, form start / abandon / submit,
--          scroll milestones
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `events` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id`  BIGINT UNSIGNED NOT NULL,
  `visitor_id`  BIGINT UNSIGNED NOT NULL,
  `pageview_id` BIGINT UNSIGNED NULL,
  `type`        VARCHAR(32)     NOT NULL,
  `label`       VARCHAR(255)    NULL,
  `detail`      VARCHAR(512)    NULL,
  `path`        VARCHAR(512)    NULL,
  `created_at`  DATETIME        NOT NULL,
  `is_bot`      TINYINT(1)      NOT NULL DEFAULT 0,
  `excluded`    TINYINT(1)      NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `visitor_id` (`visitor_id`),
  KEY `type` (`type`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- Form submissions — contact + become-an-instructor
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `form_submissions` (
  `id`          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_type`   VARCHAR(32)     NOT NULL,        -- contact / instructor / demo
  `name`        VARCHAR(191)    NULL,
  `email`       VARCHAR(191)    NULL,
  `phone`       VARCHAR(20)     NULL,
  `field1`      VARCHAR(191)    NULL,            -- instructor: subject  | demo: course
  `field2`      VARCHAR(191)    NULL,            -- demo: preferred timing
  `message`     TEXT            NULL,            -- contact: question / instructor: message / demo: notes
  `extra_json`  LONGTEXT        NULL,
  `visitor_id`  BIGINT UNSIGNED NULL,
  `session_id`  BIGINT UNSIGNED NULL,
  `page_path`   VARCHAR(512)    NULL,
  `ip`          VARCHAR(45)     NULL,
  `country`     VARCHAR(2)      NULL,
  `ua`          VARCHAR(512)    NULL,
  `status`      ENUM('new','read','replied','spam') NOT NULL DEFAULT 'new',
  `admin_notes` TEXT            NULL,
  `created_at`  DATETIME        NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_type` (`form_type`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- Admin users
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id`                   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username`             VARCHAR(64)  NOT NULL,
  `password_hash`        VARCHAR(255) NOT NULL,
  `role`                 ENUM('admin','viewer') NOT NULL DEFAULT 'admin',
  `is_active`            TINYINT(1)   NOT NULL DEFAULT 1,
  `force_password_change` TINYINT(1)  NOT NULL DEFAULT 0,
  `last_login_at`        DATETIME     NULL,
  `last_login_ip`        VARCHAR(45)  NULL,
  `created_at`           DATETIME     NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- Login attempts (rate limiting) + admin activity log
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin_login_attempts` (
  `id`       BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip`       VARCHAR(45)  NOT NULL,
  `username` VARCHAR(64)  NULL,
  `ok`       TINYINT(1)   NOT NULL,
  `at`       DATETIME     NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip_at` (`ip`,`at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `admin_activity` (
  `id`             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id`       INT UNSIGNED NULL,
  `admin_username` VARCHAR(64)  NULL,
  `action`         VARCHAR(128) NOT NULL,
  `detail`         VARCHAR(512) NULL,
  `ip`             VARCHAR(45)  NULL,
  `at`             DATETIME     NOT NULL,
  PRIMARY KEY (`id`),
  KEY `at` (`at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------------------------
-- Blocked IPs + key/value settings
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `blocked_ips` (
  `ip`         VARCHAR(45)  NOT NULL,
  `reason`     VARCHAR(255) NULL,
  `created_at` DATETIME     NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `settings` (
  `k` VARCHAR(64)  NOT NULL,
  `v` TEXT         NULL,
  PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`k`,`v`) VALUES
  ('retention_days','90'),
  ('exclude_ips',''),
  ('alert_email',''),
  ('alert_enabled','0'),
  ('smtp_host',''),
  ('smtp_port','587'),
  ('smtp_secure','tls'),
  ('smtp_user',''),
  ('smtp_pass',''),
  ('smtp_from',''),
  ('smtp_from_name','Codeksha Website'),
  ('last_cleanup','')
ON DUPLICATE KEY UPDATE `k`=`k`;

-- ---------------------------------------------------------------------------
-- Geo lookup cache (one network call per IP, then reused)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `geo_cache` (
  `ip`          VARCHAR(45) NOT NULL,
  `country`     VARCHAR(2)  NULL,
  `region`      VARCHAR(96) NULL,
  `city`        VARCHAR(96) NULL,
  `resolved_at` DATETIME    NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
