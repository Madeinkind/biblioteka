-- Adminer 4.8.1 MySQL 5.6.51-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `biblioteka` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `biblioteka`;

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'название книги',
  `count` int(10) unsigned NOT NULL COMMENT 'кол-во',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Книги';

INSERT INTO `books` (`id`, `name`, `count`) VALUES
(1,	'Zulax',	10),
(2,	'Danil',	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'логин',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'пароль',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Таблица Пользователей';


-- 2022-12-13 04:39:14
