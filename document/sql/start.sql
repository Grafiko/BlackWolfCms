-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 29 May 2012, 18:53
-- Wersja serwera: 5.5.16
-- Wersja PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `bwcms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `admin_panel_menu`
--

CREATE TABLE IF NOT EXISTS `admin_panel_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `is_removable` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `admin_panel_menu`
--

INSERT INTO `admin_panel_menu` (`id`, `module_id`, `name`, `sort`, `is_removable`) VALUES
(1, 0, 'kreator stron:', 0, 0),
(2, 0, 'multimedia:', 1, 0),
(3, 0, 'zarządzaj:', 0, 99);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `admin_panel_menu_i18n`
--

CREATE TABLE IF NOT EXISTS `admin_panel_menu_i18n` (
  `id` int(10) unsigned NOT NULL,
  `language` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `admin_panel_menu_i18n`
--

INSERT INTO `admin_panel_menu_i18n` (`id`, `language`, `name`) VALUES
(1, 'en', 'wizard pages:'),
(1, 'pl', 'kreator stron:'),
(2, 'pl', 'multimedia:'),
(3, 'pl', 'zarządzaj:');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `admin_panel_menu_item`
--

CREATE TABLE IF NOT EXISTS `admin_panel_menu_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_panel_menu_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned DEFAULT NULL,
  `link_name` varchar(255) NOT NULL,
  `link_run_module` varchar(255) NOT NULL,
  `link_run_show` varchar(255) DEFAULT NULL,
  `action_name` varchar(255) DEFAULT NULL,
  `action_title` varchar(255) DEFAULT NULL,
  `action_run_module` varchar(255) DEFAULT NULL,
  `action_run_show` varchar(255) DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `admin_panel_menu_id` (`admin_panel_menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `admin_panel_menu_item`
--

INSERT INTO `admin_panel_menu_item` (`id`, `admin_panel_menu_id`, `module_id`, `link_name`, `link_run_module`, `link_run_show`, `action_name`, `action_title`, `action_run_module`, `action_run_show`, `sort`) VALUES
(1, 3, NULL, 'użytkownicy', 'user', 'list', NULL, NULL, NULL, NULL, 0),
(2, 3, NULL, 'system', 'system', NULL, NULL, NULL, NULL, NULL, 1),
(3, 2, NULL, 'Menadżer plików', 'fileManager', 'fileList', 'dodaj', NULL, 'fileManager', 'add', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `admin_panel_menu_item_i18n`
--

CREATE TABLE IF NOT EXISTS `admin_panel_menu_item_i18n` (
  `id` int(10) unsigned NOT NULL,
  `language` char(5) NOT NULL,
  `link_name` varchar(255) NOT NULL,
  `action_name` varchar(255) DEFAULT NULL,
  `action_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `files_category`
--

CREATE TABLE IF NOT EXISTS `files_category` (
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `is_activ` tinyint(4) NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created_user_id` int(10) unsigned DEFAULT NULL,
  `updated_user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `parent_id` (`parent_id`),
  KEY `updated_user_id` (`updated_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Zrzut danych tabeli `files_category`
--

INSERT INTO `files_category` (`created_at`, `updated_at`, `id`, `parent_id`, `name`, `description`, `is_activ`, `sort`, `created_user_id`, `updated_user_id`) VALUES
('2012-05-25 15:52:24', NULL, 27, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 15:52:51', NULL, 28, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:00:39', NULL, 29, NULL, 'dfgdfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:01:15', NULL, 30, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:02:14', NULL, 31, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:02:42', NULL, 32, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:03:39', NULL, 33, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:04:19', NULL, 34, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:07:04', NULL, 35, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:07:44', NULL, 36, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:08:07', NULL, 37, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:10:14', NULL, 38, NULL, 'dfg', NULL, 1, 1, 2, NULL),
('2012-05-25 16:13:09', '2012-05-29 15:26:15', 40, NULL, 'Ala', NULL, 1, 1, 2, 2),
('2012-05-25 16:29:11', NULL, 42, NULL, '\\" Miś uszatek pierdzi w kwiatek \\" \\''\\''\\''/', NULL, 1, 1, 2, NULL),
('2012-05-25 16:32:26', NULL, 43, NULL, 'Moja galeria zdjęć', NULL, 1, 1, 2, NULL),
('2012-05-25 16:53:29', NULL, 44, NULL, 'Nowa kategoria', NULL, 1, 6, 2, NULL),
('2012-05-25 16:58:09', NULL, 47, NULL, 'Nowa kategoria', NULL, 1, 6, 2, NULL),
('2012-05-25 16:58:53', NULL, 48, NULL, 'Nowa kategoria', NULL, 1, 6, 2, NULL),
('2012-05-25 16:59:13', NULL, 49, NULL, 'Nowa kategoria', NULL, 1, 6, 2, NULL),
('2012-05-25 16:59:33', NULL, 50, NULL, 'dfsfsdf', NULL, 1, 1, 2, NULL),
('2012-05-26 14:14:54', NULL, 51, NULL, 'asd', NULL, 1, 1, 2, NULL),
('2012-05-27 11:46:48', '2012-05-28 16:36:58', 52, NULL, 'Moja kategoria 3er', NULL, 1, 1, 2, 2),
('2012-05-29 12:31:44', '2012-05-29 12:34:49', 55, NULL, 'Galeria zdjęć 3', NULL, 1, 1, 2, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `files_category_i18n`
--

CREATE TABLE IF NOT EXISTS `files_category_i18n` (
  `id` int(10) unsigned NOT NULL,
  `language` char(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `files_category_i18n`
--

INSERT INTO `files_category_i18n` (`id`, `language`, `name`, `description`) VALUES
(40, 'pl', 'Ala', NULL),
(52, 'de', 'Niemiecka nazwa', NULL),
(52, 'pl', 'Moja kategoria 3er', NULL),
(52, 'ru', 'Ruski nazwy 6 s', NULL),
(52, 'sk', 'Moja kategoria', NULL),
(55, 'de', 'Galeria zdjęć 4 3', NULL),
(55, 'pl', 'Galeria zdjęć 3', NULL),
(55, 'sk', 'gas', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `files_item`
--

CREATE TABLE IF NOT EXISTS `files_item` (
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `files_category_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `filename` varchar(255) NOT NULL,
  `filesize` varchar(50) NOT NULL,
  `fileextension` char(4) NOT NULL,
  `is_activ` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL,
  `created_user_id` int(10) unsigned DEFAULT NULL,
  `updated_user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`),
  KEY `files_category_id` (`files_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `native` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `is_activ` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `is_admin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_editable` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_removable` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `language`
--

INSERT INTO `language` (`created_at`, `updated_at`, `id`, `name`, `native`, `code`, `is_activ`, `is_default`, `is_admin`, `is_editable`, `is_removable`) VALUES
('0000-00-00 00:00:00', '2011-07-05 19:38:33', 1, 'Polish', 'Polski', 'pl', 1, 1, 1, 0, 0),
('0000-00-00 00:00:00', '2011-07-05 19:38:33', 2, 'English', 'English', 'en', 1, 0, 1, 1, 0),
('0000-00-00 00:00:00', '2011-07-05 21:46:06', 3, 'Polish', 'Polski', 'pl', 0, 1, 0, 0, 0),
('0000-00-00 00:00:00', '2011-07-06 08:30:51', 4, 'Russian', 'Русский', 'ru', 0, 0, 0, 1, 1),
('0000-00-00 00:00:00', '2011-07-06 08:30:51', 5, 'Slovak', 'Slovenčina', 'sk', 0, 0, 0, 1, 1),
('0000-00-00 00:00:00', NULL, 6, 'German', 'Deutsch', 'de', 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `created_at` datetime NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(16) NOT NULL,
  `content` text,
  `module` varchar(255) NOT NULL,
  `is_admin_panel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_user_id` (`created_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Zrzut danych tabeli `log`
--

INSERT INTO `log` (`created_at`, `id`, `type`, `content`, `module`, `is_admin_panel`, `created_user_id`) VALUES
('2012-05-29 16:47:22', 1, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,39.html\\";i:1;s:124:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,39.html\\">\\" Miś uszatek pierdzi w kwiatek 62 3</a>\\";i:2;s:2:\\"sk\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 16:56:08', 2, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\";i:1;s:103:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\">Nowa kategoria s</a>\\";i:2;s:2:\\"ru\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 16:56:55', 3, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\";i:1;s:103:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\">Nowa kategoria s</a>\\";i:2;s:2:\\"ru\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 16:57:51', 4, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\";i:1;s:103:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\">Nowa kategoria s</a>\\";i:2;s:2:\\"ru\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 16:58:59', 5, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\";i:1;s:103:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\">Nowa kategoria s</a>\\";i:2;s:2:\\"ru\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 16:59:38', 6, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\";i:1;s:103:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\">Nowa kategoria s</a>\\";i:2;s:2:\\"ru\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 16:59:52', 7, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\";i:1;s:103:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\">Nowa kategoria s</a>\\";i:2;s:2:\\"ru\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 17:00:43', 8, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\";i:1;s:103:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\">Nowa kategoria s</a>\\";i:2;s:2:\\"ru\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 17:00:45', 9, 'update', 'a:2:{s:3:\\"msg\\";s:19:\\"log_update_category\\";s:10:\\"parameters\\";a:3:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\";i:1;s:103:\\"<a href=\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,54.html\\">Nowa kategoria s</a>\\";i:2;s:2:\\"ru\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 18:45:39', 10, 'delete', 'a:2:{s:3:\\"msg\\";s:19:\\"log_delete_category\\";s:10:\\"parameters\\";a:2:{i:0;N;i:1;s:37:\\"\\" Miś uszatek pierdzi w kwiatek 62 3\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 18:46:27', 11, 'delete', 'a:2:{s:3:\\"msg\\";s:19:\\"log_delete_category\\";s:10:\\"parameters\\";a:2:{i:0;s:60:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit.html\\";i:1;s:16:\\"Nowa kategoria s\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 18:47:24', 12, 'delete', 'a:2:{s:3:\\"msg\\";s:19:\\"log_delete_category\\";s:10:\\"parameters\\";a:2:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,45.html\\";i:1;s:14:\\"Nowa kategoria\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 18:48:12', 13, 'delete', 'a:2:{s:3:\\"msg\\";s:19:\\"log_delete_category\\";s:10:\\"parameters\\";a:2:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,46.html\\";i:1;s:14:\\"Nowa kategoria\\";}}', 'Module_FileManager_Admin', 1, 2),
('2012-05-29 18:48:57', 14, 'delete', 'a:2:{s:3:\\"msg\\";s:19:\\"log_delete_category\\";s:10:\\"parameters\\";a:2:{i:0;s:72:\\"http://bwcms.tomek/__admin/run,fileManager-categoryEdit,category,53.html\\";i:1;s:11:\\"Jakaś nowa\\";}}', 'Module_FileManager_Admin', 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `updated_at` datetime DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `var` varchar(256) NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  `updated_user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_user_id` (`updated_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `setting`
--

INSERT INTO `setting` (`updated_at`, `id`, `var`, `value`, `updated_user_id`) VALUES
('2012-05-22 15:05:17', 1, 'smtp_server', 'mail.emeto.eu', 2),
('2012-03-31 09:47:50', 2, 'smtp_email', 'test@emeto.eu', 2),
('2012-05-22 15:03:44', 3, 'smtp_pass', 'q401ROlJ', 2),
('2012-03-31 09:47:50', 4, 'smtp_send_perminute', '999', 2),
('2012-03-31 09:47:50', 5, 'email_from', 'test@emeto.eu', 2),
('2012-03-31 09:47:50', 6, 'email_name', 'Biuro', 2),
('2012-04-04 13:28:44', 7, 'favicon', NULL, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_user_id` int(10) unsigned DEFAULT NULL,
  `updated_user_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `user_role_id` int(10) unsigned DEFAULT NULL,
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `is_editable` tinyint(1) NOT NULL,
  `is_removable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `login` (`email`,`passwd`),
  KEY `user_role_id` (`user_role_id`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`created_at`, `updated_at`, `id`, `created_user_id`, `updated_user_id`, `email`, `passwd`, `user_role_id`, `state`, `name`, `fullname`, `is_editable`, `is_removable`) VALUES
('0000-00-00 00:00:00', '2011-07-08 09:46:37', 2, NULL, NULL, 'tomasz@laboratoriumartystyczne.pl', '16d7a4fca7442dda3ad93c9a726597e4', 5, 2, 'Tomasz', 'Juśkiewicz', 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `user_archive_login`
--

CREATE TABLE IF NOT EXISTS `user_archive_login` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login` text,
  `user_id` int(10) unsigned DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(32) NOT NULL,
  `browser` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userID` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=149 ;

--
-- Zrzut danych tabeli `user_archive_login`
--

INSERT INTO `user_archive_login` (`id`, `login`, `user_id`, `time`, `ip`, `browser`) VALUES
(1, '', NULL, '2012-05-11 14:15:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(2, '', NULL, '2012-05-11 14:20:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(3, '', NULL, '2012-05-11 14:21:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(4, '', NULL, '2012-05-11 14:21:18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(5, '', NULL, '2012-05-11 14:21:18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(6, '', NULL, '2012-05-11 14:21:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(7, '', NULL, '2012-05-11 14:21:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(8, 'hjk', NULL, '2012-05-11 14:21:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(9, '', NULL, '2012-05-11 14:22:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(10, '', NULL, '2012-05-11 14:22:34', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(11, '', NULL, '2012-05-11 14:23:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(12, '', NULL, '2012-05-11 14:23:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(13, '', NULL, '2012-05-11 14:23:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(14, '', NULL, '2012-05-11 14:23:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(15, '', NULL, '2012-05-11 14:23:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(16, '', NULL, '2012-05-11 14:24:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(17, '', NULL, '2012-05-11 14:24:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(18, '', NULL, '2012-05-11 14:25:44', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(19, '', NULL, '2012-05-11 14:25:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(20, '', NULL, '2012-05-11 14:25:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(21, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-11 14:26:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(22, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-11 14:26:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(23, '', NULL, '2012-05-11 14:26:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(24, '', NULL, '2012-05-11 14:26:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(25, '', NULL, '2012-05-11 14:26:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(26, '', NULL, '2012-05-11 14:27:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(27, '', NULL, '2012-05-11 14:28:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(28, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-11 14:28:38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(29, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-11 14:29:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(30, '', NULL, '2012-05-11 14:29:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(31, '', NULL, '2012-05-11 14:30:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(32, '', NULL, '2012-05-11 14:31:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(33, '', NULL, '2012-05-11 14:32:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(34, '', NULL, '2012-05-11 15:04:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(35, '', NULL, '2012-05-11 15:13:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(36, '', NULL, '2012-05-11 15:13:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(37, '', NULL, '2012-05-11 15:17:38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(38, '', NULL, '2012-05-11 15:38:51', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(39, '', NULL, '2012-05-12 13:26:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(40, '', NULL, '2012-05-12 13:30:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(41, '', NULL, '2012-05-12 14:19:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(42, '', NULL, '2012-05-12 15:59:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(43, '', NULL, '2012-05-12 16:03:55', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(44, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-12 16:04:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(45, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-12 16:05:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(46, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-12 16:05:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(47, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-12 16:14:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(48, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-12 16:29:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(49, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-12 18:21:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(50, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-12 18:21:34', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(51, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-12 18:21:36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(52, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-12 18:21:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(53, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-12 18:21:41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(54, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-12 18:21:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(55, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-13 10:55:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(56, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-13 12:30:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(57, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-13 14:02:41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(58, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-13 14:40:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(59, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-13 15:31:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(60, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-13 19:56:39', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(61, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-13 22:55:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(62, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-14 08:37:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(63, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-14 10:29:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(64, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-14 12:59:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(65, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-14 15:07:10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(66, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-16 09:49:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(67, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-16 09:56:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(68, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-16 10:01:25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(69, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-16 11:53:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(70, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-17 11:09:55', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(71, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-17 13:10:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(72, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-17 15:57:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(73, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-18 08:16:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(74, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-18 09:07:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(75, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-18 09:10:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(76, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-18 10:29:34', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(77, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-18 12:32:44', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(78, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-18 13:13:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(79, 'tomasz@laboratoriumartystyczne.pl4', NULL, '2012-05-19 10:11:02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(80, 'tomasz@laboratoriumartystyczne.pl2', NULL, '2012-05-19 10:47:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(81, 'tomasz@laboratoriumartystyczne.ply', NULL, '2012-05-19 10:49:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(82, 'tomasz@laboratoriumartystyczne.plrtyrty', NULL, '2012-05-19 10:49:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(83, '', NULL, '2012-05-19 10:49:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(84, '', NULL, '2012-05-19 10:50:41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(85, '', NULL, '2012-05-19 10:51:22', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(86, '', NULL, '2012-05-19 10:51:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(87, '', NULL, '2012-05-19 10:52:17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(88, '', NULL, '2012-05-19 10:52:54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(89, '', NULL, '2012-05-19 10:53:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(90, '', NULL, '2012-05-19 10:53:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(91, '', NULL, '2012-05-19 10:54:02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(92, '', NULL, '2012-05-19 10:54:36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(93, 'tomasz@laboratoriumartystyczne.plr', NULL, '2012-05-19 11:51:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(94, 'tomasz@laboratoriumartystyczne.plr', NULL, '2012-05-19 12:00:27', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(95, 'tomasz@laboratoriumartystyczne.plr', NULL, '2012-05-19 12:01:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(96, 'tomasz@laboratoriumartystyczne.plr', NULL, '2012-05-19 12:01:51', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(97, 'tomasz@laboratoriumartystyczne.plr', NULL, '2012-05-19 12:02:43', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(98, 'tomasz@laboratoriumartystyczne.plh', NULL, '2012-05-19 12:02:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(99, 'tomasz@laboratoriumartystyczne.plh', NULL, '2012-05-19 12:02:54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(100, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-19 12:03:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(101, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-19 12:03:22', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(102, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-19 12:04:44', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(103, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-19 12:05:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(104, 'tomasz@laboratoriumartystyczne.pl', NULL, '2012-05-19 12:06:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(105, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-19 12:06:33', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(106, 'tomasz@laboratoriumartystyczne.pl2', NULL, '2012-05-19 12:06:53', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(107, 'tomasz@laboratoriumartystyczne.pl2', NULL, '2012-05-19 12:06:58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(108, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-19 12:07:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(109, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-19 14:46:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(110, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-19 15:25:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(111, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-19 16:59:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(112, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-21 09:47:39', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(113, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-21 12:30:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(114, 'tomasz.juskiewicz@grafiko.pl', NULL, '2012-05-21 15:04:06', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
(115, 'tomasz.juskiewicz@grafiko.pl', NULL, '2012-05-21 15:04:11', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
(116, 'tomasz.juskiewicz@grafiko.pl', NULL, '2012-05-21 15:04:16', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
(117, 'tomasz.juskiewicz@grafiko.pl', NULL, '2012-05-21 15:04:22', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
(118, 'tomasz.juskiewicz@grafiko.pl', NULL, '2012-05-21 15:04:28', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
(119, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-21 15:05:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(120, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-21 15:05:10', '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
(121, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-21 16:45:53', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(122, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-21 18:26:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(123, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-22 07:47:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(124, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-22 09:03:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(125, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-22 09:57:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(126, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-22 12:08:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(127, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-23 11:37:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(128, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-24 07:30:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(129, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-24 09:06:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(130, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-24 12:24:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(131, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-24 15:00:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(132, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-24 17:55:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(133, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-25 08:05:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(134, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-25 08:49:17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(135, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-25 11:13:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(136, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-25 12:00:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(137, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-25 17:05:58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(138, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-25 20:42:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(139, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-26 07:11:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(140, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-26 10:22:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(141, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-26 12:14:39', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(142, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-27 09:46:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(143, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-27 10:35:10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(144, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-27 14:18:58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(145, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-28 08:46:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(146, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-28 16:05:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(147, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-29 10:31:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0'),
(148, 'tomasz@laboratoriumartystyczne.pl', 2, '2012-05-29 16:02:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `hash` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `is_selectable` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_editable` tinyint(1) NOT NULL DEFAULT '0',
  `is_removable` tinyint(1) NOT NULL DEFAULT '0',
  `count_user` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `user_role`
--

INSERT INTO `user_role` (`created_at`, `updated_at`, `id`, `parent_id`, `hash`, `name`, `description`, `sort`, `is_selectable`, `is_editable`, `is_removable`, `count_user`) VALUES
('0000-00-00 00:00:00', '2011-07-08 14:42:12', 1, NULL, 'niezalogowany', 'Niezalogowany', NULL, 15, 0, 1, 0, 0),
('0000-00-00 00:00:00', '2011-07-08 15:48:51', 2, 1, 'registred', 'Zarejestrowany', NULL, 13, 1, 1, 0, 0),
('0000-00-00 00:00:00', '2011-07-08 14:42:12', 3, 1, 'edytor', 'Edytor', NULL, 14, 1, 1, 0, 0),
('0000-00-00 00:00:00', NULL, 4, 3, 'administrator', 'Administrator', NULL, 0, 1, 0, 0, 0),
('2011-09-17 15:44:53', NULL, 5, 4, 'super_administrator', 'Super Administrator', NULL, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `user_session`
--

CREATE TABLE IF NOT EXISTS `user_session` (
  `user_id` int(10) unsigned DEFAULT NULL,
  `session_id` char(32) NOT NULL,
  `save_path` varchar(255) NOT NULL,
  `name` varchar(32) NOT NULL,
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `session_data` text,
  PRIMARY KEY (`session_id`,`save_path`,`name`),
  KEY `userID` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user_session`
--

INSERT INTO `user_session` (`user_id`, `session_id`, `save_path`, `name`, `modified`, `lifetime`, `session_data`) VALUES
(2, 'v64ii5u84dcjt57d6qiuaopse5', 'D:\\Server\\xampp\\tmp', 'PHPSESSID', 1338310141, 1800, 'setting|a:2:{s:16:"language_default";s:2:"pl";s:8:"language";s:2:"pl";}Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":5:{s:2:"id";s:1:"2";s:5:"email";s:33:"tomasz@laboratoriumartystyczne.pl";s:12:"user_role_id";s:1:"5";s:5:"state";s:1:"2";s:7:"aclRole";s:19:"super_administrator";}}__ZF|a:1:{s:9:"Zend_Auth";a:1:{s:3:"ENT";i:1338311941;}}');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `admin_panel_menu_item`
--
ALTER TABLE `admin_panel_menu_item`
  ADD CONSTRAINT `admin_panel_menu_item_ibfk_1` FOREIGN KEY (`admin_panel_menu_id`) REFERENCES `admin_panel_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `files_category`
--
ALTER TABLE `files_category`
  ADD CONSTRAINT `files_category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `files_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `files_category_i18n`
--
ALTER TABLE `files_category_i18n`
  ADD CONSTRAINT `files_category_i18n_ibfk_1` FOREIGN KEY (`id`) REFERENCES `files_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `files_item`
--
ALTER TABLE `files_item`
  ADD CONSTRAINT `files_item_ibfk_1` FOREIGN KEY (`files_category_id`) REFERENCES `files_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_item_ibfk_2` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `files_item_ibfk_3` FOREIGN KEY (`updated_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `setting`
--
ALTER TABLE `setting`
  ADD CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`updated_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`updated_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `user_archive_login`
--
ALTER TABLE `user_archive_login`
  ADD CONSTRAINT `user_archive_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `user_session`
--
ALTER TABLE `user_session`
  ADD CONSTRAINT `user_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
