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
  `publishing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'издатель',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Книги';

INSERT INTO `books` (`id`, `name`, `count`, `publishing`) VALUES
(1,	'Zulax',	10,	''),
(2,	'Danil',	1,	''),
(3,	'wqerfwdrftdsw',	1333,	'');

DROP TABLE IF EXISTS `readers`;
CREATE TABLE `readers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `name student` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'имя студента',
  `surname student` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'фамилия студента',
  `iin` int(12) unsigned NOT NULL COMMENT 'иин студента',
  `books count` int(10) unsigned NOT NULL COMMENT 'кол-во книг взятым студентом',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'айди',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'логин',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'пароль',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Таблица Пользователей';

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1,	'admin',	'admin');

-- 2022-12-19 06:43:33
