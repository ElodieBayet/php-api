--
-- MySQL
-- Schema
-- Exécution : 1
--

USE php_api;

CREATE TABLE `period` (
    `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(32) NOT NULL,
    `begin` SMALLINT UNSIGNED NOT NULL,
    `end` SMALLINT UNSIGNED,
    `description` VARCHAR(1024),
    `tag` VARCHAR(128) NOT NULL,
    --
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `compositor` (
    `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `lastname` VARCHAR(32) NOT NULL,
    `firstname` VARCHAR(32) NOT NULL,
    `birth` DATE NOT NULL,
    `death` DATE NOT NULL,
    `origin` VARCHAR(64),
    `figure` VARCHAR(512)
    --
    PRIMARY KEY (`id`),
    UNIQUE KEY `UQ_compositor__fullname` (`lastname`, `firstname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `period_compositor` (
    `period_id` SMALLINT UNSIGNED NOT NULL,
    `compositor_id` SMALLINT UNSIGNED NOT NULL,
    --
    UNIQUE KEY `UQ_period_compositor__ids` (`period_id`, `compositor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `period_compositor`
    ADD CONSTRAINT `FK_period_compositor__period_id` FOREIGN KEY (`period_id`) REFERENCES `period`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `FK_period_compositor__compositor_id` FOREIGN KEY (`compositor_id`) REFERENCES `compositor`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
