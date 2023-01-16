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
  `count` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'кол-во',
  `publishing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'издатель',
  `about` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'о книге',
  `inventory_number` int(255) unsigned NOT NULL COMMENT 'инвентарь номер',
  `year_publishing` int(4) unsigned NOT NULL COMMENT 'год издательства',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'картинка (ссылка',
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'автор',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Книги';

INSERT INTO `books` (`id`, `name`, `count`, `publishing`, `about`, `inventory_number`, `year_publishing`, `img`, `author`) VALUES
(3,	'dsadsa',	1,	'abai',	'',	0,	0,	'',	''),
(4,	'dsadsa',	1,	'',	'',	0,	0,	'',	''),
(5,	'dsadsa',	1,	'',	'',	0,	0,	'',	''),
(6,	'dsadsa',	1,	'',	'',	0,	0,	'',	''),
(7,	'dsadsa',	1,	'',	'',	0,	0,	'',	''),
(8,	'dsadsa',	1,	'',	'',	0,	0,	'',	''),
(9,	'Books One',	1,	'Abaiding',	'Abai',	0,	0,	'',	''),
(10,	'loloshka',	1,	'shoping',	'abain',	4294967295,	0,	'',	'');

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

INSERT INTO `books_readers` (`id`, `reader_id`, `book_id`, `date_start`, `date_end_plan`, `date_end_fact`) VALUES
(3,	2,	3,	'2022-12-22 05:34:56',	'2022-12-22 05:34:56',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `readers`;
CREATE TABLE `readers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `fio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'имя студента',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'группа студента',
  `iin` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'иин студента',
  PRIMARY KEY (`id`),
  UNIQUE KEY `iin` (`iin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `readers` (`id`, `fio`, `group`, `iin`) VALUES
(2,	'Палагута Данил',	'vtipob-42',	'4294967294'),
(3,	'MrZulax',	'https://www.youtube.com/@MrZulax',	'222222');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'логин',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'пароль',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Таблица Пользователей';

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1,	'admin',	'admin'),
(2,	'93d4554c-9230-11ed-9054-d85ed3a48331',	'*7C0AF5FB327EEB77757AC592EB3A0551550478CF'),
(3,	'9441a255-92e3-11ed-9643-d85ed3a48331',	'*00A51F3F48415C7D4E8908980D443C29C69B60C9');

-- 2023-01-16 04:37:12
