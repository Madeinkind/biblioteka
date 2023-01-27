-- Adminer 4.8.1 MySQL 5.6.51-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'название книги',
  `count` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'кол-во',
  `publishing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'издатель',
  `about` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'о книге',
  `inventory_number` int(255) unsigned NOT NULL COMMENT 'инвентарь номер',
  `year_publishing` int(4) unsigned DEFAULT NULL COMMENT 'год издательства',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'картинка (ссылка',
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'автор',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Книги';


DROP TABLE IF EXISTS `books_readers`;
CREATE TABLE `books_readers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `reader_id` int(10) unsigned NOT NULL COMMENT 'айди читателя',
  `book_id` int(10) unsigned NOT NULL COMMENT 'айди книги',
  `date_start` datetime NOT NULL COMMENT 'дата выдачи',
  `date_end_plan` datetime NOT NULL COMMENT 'дата сдачи по плану',
  `date_end_fact` datetime NOT NULL COMMENT 'дата сдачи по факту',
  PRIMARY KEY (`id`),
  KEY `reader_id` (`reader_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `books_readers_ibfk_1` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `books_readers_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='связи таблиц - books + readers';


DROP TABLE IF EXISTS `readers`;
CREATE TABLE `readers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `fio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'имя студента',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'группа студента',
  `iin` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'иин студента',
  PRIMARY KEY (`id`),
  UNIQUE KEY `iin` (`iin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `ssid` varchar(255) NOT NULL COMMENT 'id сессии',
  `expired` datetime NOT NULL COMMENT 'дата окончания действия сессии',
  `ugmtime_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата добавления',
  `ugmtime_change` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'дата изменения',
  UNIQUE KEY `ssid` (`ssid`),
  KEY `expired` (`expired`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='сессии администратора';


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'логин',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'пароль',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Таблица Пользователей';


-- 2023-01-27 16:18:30
