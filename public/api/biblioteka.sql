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
  `publishing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'издатель',
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
  `namestudent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'имя студента',
  `surnamestudent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'фамилия студента',
  `iin` int(12) unsigned NOT NULL COMMENT 'иин студента',
  `bookscount` int(10) unsigned NOT NULL COMMENT 'кол-во книг взятым студентом',
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

-- 2022-12-21 04:43:56
