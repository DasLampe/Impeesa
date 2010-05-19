-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2010 at 11:23 AM
-- Server version: 5.1.46
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `impeesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_config`
--

CREATE TABLE IF NOT EXISTS `impeesa_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `config_key` text COLLATE latin1_general_ci NOT NULL,
  `config_value` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `impeesa_config`
--

INSERT INTO `impeesa_config` (`id`, `config_key`, `config_value`) VALUES
(1, 'title', 'TestSeite Impeesa'),
(2, 'version', '0.1'),
(3, 'template', 'default'),
(4, 'meta_lang', 'de'),
(5, 'meta_description', 'impeesa test'),
(6, 'meta_keywords', 'Pfadfinder, Impeesa, CMS'),
(7, 'meta_robots', 'all'),
(8, 'meta_contenttype', 'text/html'),
(9, 'meta_charset', 'utf-8'),
(10, 'tplExtension', '.php'),
(11, 'tplFolder', 'template/default/'),
(12, 'tplCacheDir', 'cache/');

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_contentText`
--

CREATE TABLE IF NOT EXISTS `impeesa_contentText` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `headline` text COLLATE latin1_general_ci NOT NULL,
  `content` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `impeesa_contentText`
--

INSERT INTO `impeesa_contentText` (`id`, `headline`, `content`) VALUES
(1, 'Willkommen', 'Das ist die 1. Seite'),
(2, '', '<h1>Was geht ab?!</h1>'),
(3, '', '<div>Jaja, hoffentlich geht das!</div>');

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_contenttype`
--

CREATE TABLE IF NOT EXISTS `impeesa_contenttype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `extensionPath` text COLLATE latin1_general_ci NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `impeesa_contenttype`
--

INSERT INTO `impeesa_contenttype` (`id`, `extensionPath`, `name`) VALUES
(1, 'impeesaContent/text/', 'Normaler Content (HTML)'),
(2, 'impeesaNews/all/', 'News (Alle)'),
(3, 'impeesaNews/specify/', 'News (Einzeln)'),
(4, 'impeesaUser/login/', 'Login/Logout Modul'),
(5, 'impeesaNews/acp/', 'News Verwaltung'),
(6, 'impeesaPicture/acp/', 'Bilder Verwaltung');

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_debug`
--

CREATE TABLE IF NOT EXISTS `impeesa_debug` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site` text COLLATE latin1_general_ci NOT NULL,
  `loadTime` text COLLATE latin1_general_ci NOT NULL,
  `errorMessage` text COLLATE latin1_general_ci NOT NULL,
  `errorNumber` text COLLATE latin1_general_ci NOT NULL,
  `errorFile` text COLLATE latin1_general_ci NOT NULL,
  `errorRow` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=303 ;

--
-- Dumping data for table `impeesa_debug`
--

INSERT INTO `impeesa_debug` (`id`, `site`, `loadTime`, `errorMessage`, `errorNumber`, `errorFile`, `errorRow`) VALUES
(1, 'acp/picture/upload', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(2, 'acp/picture/upload', '', 'Undefined index: submit', '8', '/var/www/Freizeit/impeesa/lib/extension/impeesaPicture/acp/impeesaPictureAcp.class.php', 56),
(3, 'resource/template-default-css-main.color.css', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(4, 'resource/template-default-css-main.position.css', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(5, 'resource/template-default-css-main.autoContent.css', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(6, 'resource/template-default-css-main.img.css', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(7, 'resource/template-default-css-main.else.css', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(8, 'resource/template-default-css-jquery.ui.css', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(9, 'resource/lib-js-jquery.min.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(10, 'resource/lib-js-jquery.ui.min.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(11, 'resource/lib-js-jquery.autoResize.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(12, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(13, 'resource/template-default-js-main.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(14, 'resource/lib-extension-impeesaPicture-lib-js-swfupload.queue.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(15, 'resource/lib-extension-impeesaPicture-lib-js-fileprogress.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(16, 'resource/lib-extension-impeesaPicture-lib-js-handlers.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(17, 'resource/lib-extension-impeesaPicture-lib-_uploadConfig.js', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(18, 'resource/template-default-img-dpsg_logo.jpg', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(19, 'resource/template-default-img-banner_stammtenkterer.jpg', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(20, 'resource/template-default-img-a_link.gif', '18.05.2010 - 17:22:52', 'no', '', '', 0),
(21, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '18.05.2010 - 17:22:53', 'no', '', '', 0),
(22, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '18.05.2010 - 17:22:53', 'no', '', '', 0),
(23, 'resource/template-default-img-XPButtonUploadText_61x22.png', '18.05.2010 - 17:22:53', 'no', '', '', 0),
(24, 'acp/picture/upload/upload', '18.05.2010 - 17:22:58', 'EXTRA', '', '', 0),
(25, 'acp/picture/upload/upload', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(26, 'acp/picture/upload', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(27, 'acp/picture/upload', '', 'Undefined index: submit', '8', '/var/www/Freizeit/impeesa/lib/extension/impeesaPicture/acp/impeesaPictureAcp.class.php', 56),
(28, 'resource/template-default-css-main.color.css', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(29, 'resource/template-default-css-main.position.css', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(30, 'resource/template-default-css-main.autoContent.css', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(31, 'resource/template-default-css-main.img.css', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(32, 'resource/template-default-css-main.else.css', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(33, 'resource/template-default-css-jquery.ui.css', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(34, 'resource/lib-js-jquery.min.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(35, 'resource/lib-js-jquery.ui.min.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(36, 'resource/lib-js-jquery.autoResize.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(37, 'resource/template-default-js-main.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(38, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(39, 'resource/lib-extension-impeesaPicture-lib-js-swfupload.queue.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(40, 'resource/lib-extension-impeesaPicture-lib-js-fileprogress.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(41, 'resource/lib-extension-impeesaPicture-lib-js-handlers.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(42, 'resource/lib-extension-impeesaPicture-lib-_uploadConfig.js', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(43, 'resource/template-default-img-dpsg_logo.jpg', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(44, 'resource/template-default-img-banner_stammtenkterer.jpg', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(45, 'resource/template-default-img-a_link.gif', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(46, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(47, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '18.05.2010 - 17:23:31', 'no', '', '', 0),
(48, 'resource/template-default-img-XPButtonUploadText_61x22.png', '18.05.2010 - 17:23:32', 'no', '', '', 0),
(49, 'resource/template-default-img-a_hover.gif', '18.05.2010 - 17:23:35', 'no', '', '', 0),
(50, 'acp/picture/upload', '19.05.2010 - 09:56:22', 'no', '', '', 0),
(51, 'acp/picture/upload', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(52, 'acp/picture/upload', '19.05.2010 - 10:46:25', 'no', '', '', 0),
(53, 'acp/picture/upload', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(54, 'acp/picture', '19.05.2010 - 10:47:14', 'no', '', '', 0),
(55, 'acp/picture', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(56, 'acp/picture/upload', '19.05.2010 - 10:47:16', 'no', '', '', 0),
(57, 'acp/picture/upload', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(58, 'acp/picture/upload', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(59, 'acp/picture/upload', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(60, 'acp/picture/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(61, 'acp/picture/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(62, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(63, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(64, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(65, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(66, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(67, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(68, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(69, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(70, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(71, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(72, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(73, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(74, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(75, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(76, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(77, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(78, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(79, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(80, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(81, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(82, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(83, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(84, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(85, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(86, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(87, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(88, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(89, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(90, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(91, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(92, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(93, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(94, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(95, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(96, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(97, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(98, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '19.05.2010 - 10:53:54', 'no', '', '', 0),
(99, 'acp/picture/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/MAIN_LINK/content/login/', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(100, 'acp/picture/upload', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(101, 'acp/picture/upload', '', 'Undefined index: submenu', '8', '/var/www/Freizeit/impeesa/tmp/layout.php', 33),
(102, 'content/login/', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(103, 'resource/template-default-css-main.color.css', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(104, 'resource/template-default-css-main.position.css', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(105, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(106, 'resource/template-default-css-main.img.css', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(107, 'resource/template-default-css-main.else.css', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(108, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(109, 'resource/lib-js-jquery.min.js', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(110, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(111, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(112, 'resource/template-default-js-main.js', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(113, 'resource/lib-extension-impeesaUser-template-js-login.ajax.js', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(114, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(115, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(116, 'resource/template-default-img-a_link.gif', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(117, 'resource/template-default-img-a_hover.gif', '19.05.2010 - 10:54:25', 'no', '', '', 0),
(118, 'content/login/login', '19.05.2010 - 10:54:33', 'no', '', '', 0),
(119, 'content/home', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(120, 'resource/template-default-css-main.color.css', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(121, 'resource/template-default-css-main.position.css', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(122, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(123, 'resource/template-default-css-main.img.css', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(124, 'resource/template-default-css-main.else.css', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(125, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(126, 'resource/lib-js-jquery.min.js', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(127, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(128, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(129, 'resource/template-default-js-main.js', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(130, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(131, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(132, 'resource/template-default-img-a_link.gif', '19.05.2010 - 10:54:36', 'no', '', '', 0),
(133, 'acp/', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(134, 'acp/home', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(135, 'resource/template-default-css-main.color.css', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(136, 'resource/template-default-css-main.position.css', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(137, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(138, 'resource/template-default-css-main.img.css', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(139, 'resource/template-default-css-main.else.css', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(140, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(141, 'resource/lib-js-jquery.min.js', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(142, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(143, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(144, 'resource/template-default-js-main.js', '19.05.2010 - 10:54:38', 'no', '', '', 0),
(145, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 10:54:39', 'no', '', '', 0),
(146, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 10:54:39', 'no', '', '', 0),
(147, 'resource/template-default-img-a_link.gif', '19.05.2010 - 10:54:39', 'no', '', '', 0),
(148, 'resource/template-default-img-a_hover.gif', '19.05.2010 - 10:54:39', 'no', '', '', 0),
(149, 'acp/news', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(150, 'acp/news', '', 'Non-static method impeesaUserInfo::getUsername() should not be called statically, assuming $this from incompatible context', '2048', '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 143),
(151, 'acp/news', '', 'Non-static method impeesaUserInfo::getUsername() should not be called statically, assuming $this from incompatible context', '2048', '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 143),
(152, 'resource/template-default-css-main.color.css', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(153, 'resource/template-default-css-main.position.css', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(154, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(155, 'resource/template-default-css-main.img.css', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(156, 'resource/template-default-css-main.else.css', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(157, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(158, 'resource/lib-extension-impeesaNews-template-css-newsAcp.css', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(159, 'resource/lib-js-jquery.min.js', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(160, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(161, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(162, 'resource/template-default-js-main.js', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(163, 'resource/lib-extension-impeesaNews-template-js-newsAcp.js', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(164, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(165, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(166, 'resource/template-default-img-a_link.gif', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(167, 'resource/template-default-img-news_back.png', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(168, 'resource/template-default-img-a_hover.gif', '19.05.2010 - 10:54:40', 'no', '', '', 0),
(169, 'acp/picture', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(170, 'resource/template-default-css-main.color.css', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(171, 'resource/template-default-css-main.position.css', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(172, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(173, 'resource/template-default-css-main.img.css', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(174, 'resource/template-default-css-main.else.css', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(175, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(176, 'resource/lib-js-jquery.min.js', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(177, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(178, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(179, 'resource/template-default-js-main.js', '19.05.2010 - 10:54:41', 'no', '', '', 0),
(180, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(181, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(182, 'resource/template-default-img-a_link.gif', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(183, 'acp/picture/upload', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(184, 'acp/picture/upload', '', 'Undefined index: submit', '8', '/var/www/Freizeit/impeesa/lib/extension/impeesaPicture/acp/impeesaPictureAcp.class.php', 56),
(185, 'resource/template-default-css-main.color.css', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(186, 'resource/template-default-css-main.position.css', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(187, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(188, 'resource/template-default-css-main.img.css', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(189, 'resource/template-default-css-main.else.css', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(190, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 10:54:42', 'no', '', '', 0),
(191, 'resource/lib-js-jquery.min.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(192, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(193, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(194, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(195, 'resource/lib-extension-impeesaPicture-lib-js-swfupload.queue.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(196, 'resource/template-default-js-main.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(197, 'resource/lib-extension-impeesaPicture-lib-js-handlers.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(198, 'resource/lib-extension-impeesaPicture-lib-js-fileprogress.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(199, 'resource/lib-extension-impeesaPicture-lib-_uploadConfig.js', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(200, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(201, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(202, 'resource/template-default-img-a_link.gif', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(203, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(204, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(205, 'resource/template-default-img-XPButtonUploadText_61x22.png', '19.05.2010 - 10:54:43', 'no', '', '', 0),
(206, 'resource/template-default-img-a_hover.gif', '19.05.2010 - 11:04:40', 'no', '', '', 0),
(207, 'acp/picture/upload', '19.05.2010 - 11:04:40', 'no', '', '', 0),
(208, 'acp/picture/upload', '', 'Undefined index: submit', '8', '/var/www/Freizeit/impeesa/lib/extension/impeesaPicture/acp/impeesaPictureAcp.class.php', 56),
(209, 'resource/template-default-css-main.color.css', '19.05.2010 - 11:04:40', 'no', '', '', 0),
(210, 'resource/template-default-css-main.position.css', '19.05.2010 - 11:04:40', 'no', '', '', 0),
(211, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 11:04:40', 'no', '', '', 0),
(212, 'resource/template-default-css-main.else.css', '19.05.2010 - 11:04:40', 'no', '', '', 0),
(213, 'resource/template-default-css-main.img.css', '19.05.2010 - 11:04:40', 'no', '', '', 0),
(214, 'resource/lib-js-jquery.min.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(215, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(216, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(217, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(218, 'resource/template-default-js-main.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(219, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(220, 'resource/lib-extension-impeesaPicture-lib-js-fileprogress.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(221, 'resource/lib-extension-impeesaPicture-lib-js-swfupload.queue.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(222, 'resource/lib-extension-impeesaPicture-lib-_uploadConfig.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(223, 'resource/lib-extension-impeesaPicture-lib-js-handlers.js', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(224, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(225, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(226, 'resource/template-default-img-a_link.gif', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(227, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(228, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(229, 'resource/template-default-img-XPButtonUploadText_61x22.png', '19.05.2010 - 11:04:41', 'no', '', '', 0),
(230, 'resource/template-default-img-a_hover.gif', '19.05.2010 - 11:04:45', 'no', '', '', 0),
(231, 'acp/picture/upload', '19.05.2010 - 11:06:07', 'no', '', '', 0),
(232, 'acp/picture/upload', '', 'Undefined index: submit', '8', '/var/www/Freizeit/impeesa/lib/extension/impeesaPicture/acp/impeesaPictureAcp.class.php', 56),
(233, 'resource/template-default-css-main.color.css', '19.05.2010 - 11:06:07', 'no', '', '', 0),
(234, 'resource/template-default-css-main.position.css', '19.05.2010 - 11:06:07', 'no', '', '', 0),
(235, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 11:06:07', 'no', '', '', 0),
(236, 'resource/template-default-css-main.img.css', '19.05.2010 - 11:06:07', 'no', '', '', 0),
(237, 'resource/template-default-css-main.else.css', '19.05.2010 - 11:06:07', 'no', '', '', 0),
(238, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 11:06:07', 'no', '', '', 0),
(239, 'resource/lib-js-jquery.min.js', '19.05.2010 - 11:06:07', 'no', '', '', 0),
(240, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(241, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(242, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.js', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(243, 'resource/template-default-js-main.js', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(244, 'resource/lib-extension-impeesaPicture-lib-js-fileprogress.js', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(245, 'resource/lib-extension-impeesaPicture-lib-js-swfupload.queue.js', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(246, 'resource/lib-extension-impeesaPicture-lib-js-handlers.js', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(247, 'resource/lib-extension-impeesaPicture-lib-_uploadConfig.js', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(248, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(249, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(250, 'resource/template-default-img-a_link.gif', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(251, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(252, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(253, 'resource/template-default-img-XPButtonUploadText_61x22.png', '19.05.2010 - 11:06:08', 'no', '', '', 0),
(254, 'resource/template-default-img-a_hover.gif', '19.05.2010 - 11:06:14', 'no', '', '', 0),
(255, 'acp/picture/upload', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(256, 'acp/picture/upload', '', 'Undefined index: submit', '8', '/var/www/Freizeit/impeesa/lib/extension/impeesaPicture/acp/impeesaPictureAcp.class.php', 56),
(257, 'resource/template-default-css-main.color.css', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(258, 'resource/template-default-css-main.position.css', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(259, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(260, 'resource/template-default-css-main.img.css', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(261, 'resource/template-default-css-main.else.css', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(262, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(263, 'resource/lib-js-jquery.min.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(264, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(265, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(266, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(267, 'resource/template-default-js-main.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(268, 'resource/lib-extension-impeesaPicture-lib-js-swfupload.queue.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(269, 'resource/lib-extension-impeesaPicture-lib-js-fileprogress.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(270, 'resource/lib-extension-impeesaPicture-lib-js-handlers.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(271, 'resource/lib-extension-impeesaPicture-lib-_uploadConfig.js', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(272, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(273, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(274, 'resource/template-default-img-a_link.gif', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(275, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(276, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(277, 'resource/template-default-img-XPButtonUploadText_61x22.png', '19.05.2010 - 11:09:38', 'no', '', '', 0),
(278, 'resource/template-default-img-a_hover.gif', '19.05.2010 - 11:09:42', 'no', '', '', 0),
(279, 'acp/picture/upload', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(280, 'acp/picture/upload', '', 'Undefined index: submit', '8', '/var/www/Freizeit/impeesa/lib/extension/impeesaPicture/acp/impeesaPictureAcp.class.php', 56),
(281, 'resource/template-default-css-main.color.css', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(282, 'resource/template-default-css-main.position.css', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(283, 'resource/template-default-css-main.autoContent.css', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(284, 'resource/template-default-css-main.img.css', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(285, 'resource/template-default-css-main.else.css', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(286, 'resource/template-default-css-jquery.ui.css', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(287, 'resource/lib-js-jquery.min.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(288, 'resource/lib-js-jquery.ui.min.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(289, 'resource/lib-js-jquery.autoResize.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(290, 'resource/template-default-js-main.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(291, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(292, 'resource/lib-extension-impeesaPicture-lib-js-swfupload.queue.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(293, 'resource/lib-extension-impeesaPicture-lib-js-fileprogress.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(294, 'resource/lib-extension-impeesaPicture-lib-js-handlers.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(295, 'resource/lib-extension-impeesaPicture-lib-_uploadConfig.js', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(296, 'resource/template-default-img-dpsg_logo.jpg', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(297, 'resource/template-default-img-banner_stammtenkterer.jpg', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(298, 'resource/template-default-img-a_link.gif', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(299, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(300, 'resource/lib-extension-impeesaPicture-lib-swfupload-swfupload.swf', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(301, 'resource/template-default-img-XPButtonUploadText_61x22.png', '19.05.2010 - 11:15:17', 'no', '', '', 0),
(302, 'resource/template-default-img-a_hover.gif', '19.05.2010 - 11:15:21', 'no', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_error`
--

CREATE TABLE IF NOT EXISTS `impeesa_error` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` text COLLATE latin1_general_ci NOT NULL,
  `message` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `impeesa_error`
--

INSERT INTO `impeesa_error` (`id`, `status`, `message`) VALUES
(1, '404', 'Seite ist nicht vorhanden!');

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_group`
--

CREATE TABLE IF NOT EXISTS `impeesa_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `enabled` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `impeesa_group`
--


-- --------------------------------------------------------

--
-- Table structure for table `impeesa_group_affiliation`
--

CREATE TABLE IF NOT EXISTS `impeesa_group_affiliation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `impeesa_group_affiliation`
--


-- --------------------------------------------------------

--
-- Table structure for table `impeesa_log`
--

CREATE TABLE IF NOT EXISTS `impeesa_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulFile` text COLLATE latin1_general_ci NOT NULL,
  `logMessage` text COLLATE latin1_general_ci NOT NULL,
  `logTime` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=55 ;

--
-- Dumping data for table `impeesa_log`
--

INSERT INTO `impeesa_log` (`id`, `modulFile`, `logMessage`, `logTime`, `userId`) VALUES
(12, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 5', 1273237758, 2),
(11, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273237727, 2),
(10, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: ', 1273237690, 2),
(9, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: ', 1273237594, 2),
(8, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: ', 1273237580, 2),
(13, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 6', 1273237785, 2),
(14, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 7', 1273237814, 2),
(15, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273237879, 2),
(16, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273237928, 2),
(17, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'UPDATE NEWS ID: 1', 1273237951, 2),
(18, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'UPDATE NEWS ID: 1', 1273237964, 2),
(19, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'UPDATE NEWS ID: 1', 1273237991, 2),
(20, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:1', 1273239116, 0),
(21, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:2', 1273239288, 2),
(22, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:3', 1273239742, 2),
(23, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:3', 1273239790, 2),
(24, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:3', 1273239826, 2),
(25, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:4', 1273513903, 2),
(26, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:9', 1273513994, 2),
(27, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273514225, 2),
(28, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:10', 1273514235, 2),
(29, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:5', 1273514241, 2),
(30, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:6', 1273514242, 2),
(31, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:7', 1273514243, 2),
(32, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:8', 1273514245, 2),
(33, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273591686, 2),
(34, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273591827, 2),
(35, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273591848, 2),
(36, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273591897, 2),
(37, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273591913, 2),
(38, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273591964, 2),
(39, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273592042, 2),
(40, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273592052, 2),
(41, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273592056, 2),
(42, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273592105, 2),
(43, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273592116, 2),
(44, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273592163, 2),
(45, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:24', 1273592248, 2),
(46, '/Applications/XAMPP/xamppfiles/htdocs/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:25', 1273763914, 2),
(47, '/Applications/XAMPP/xamppfiles/htdocs/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'DELETE NEWS ID:23', 1273763919, 2),
(48, '/Applications/XAMPP/xamppfiles/htdocs/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273928452, 2),
(49, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1274099157, 2),
(50, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1274099244, 2),
(51, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1274099318, 2),
(52, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1274099345, 2),
(53, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'UPDATE NEWS ID: 26', 1274104272, 2),
(54, '/var/www/Freizeit/impeesa/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'UPDATE NEWS ID: 26', 1274104318, 2);

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_news`
--

CREATE TABLE IF NOT EXISTS `impeesa_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `headline` text COLLATE latin1_general_ci NOT NULL,
  `content` text COLLATE latin1_general_ci NOT NULL,
  `startDate` int(11) NOT NULL,
  `endDate` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `newsStatus` int(11) NOT NULL,
  `permaLink` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `impeesa_news`
--

INSERT INTO `impeesa_news` (`id`, `headline`, `content`, `startDate`, `endDate`, `userId`, `newsStatus`, `permaLink`) VALUES
(26, 'News System ist fertig!', 'Als erstes ist un das News System fertig.<br><br>Funktionen: News erstellen, News löschen, News bearbeiten.<br>Das alles kann nur von Usern gemacht werden, welche einer Rolle angehören, welche Rechte für diese hat!', 1273874400, 0, 2, 1, 'news-system-ist-fertig'),
(29, 'Test Hallo! Was geht ab?', 'Das ist ein Test mal sehen wie der so ist!!', 1274047200, 0, 2, 1, 'test-hallo-was-geht-ab');

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_newsTagAffiliation`
--

CREATE TABLE IF NOT EXISTS `impeesa_newsTagAffiliation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=149 ;

--
-- Dumping data for table `impeesa_newsTagAffiliation`
--

INSERT INTO `impeesa_newsTagAffiliation` (`id`, `tagId`, `newsId`) VALUES
(148, 26, 26),
(147, 27, 26),
(141, 28, 0),
(142, 28, 27),
(143, 28, 28),
(144, 28, 29);

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_newsTags`
--

CREATE TABLE IF NOT EXISTS `impeesa_newsTags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `impeesa_newsTags`
--

INSERT INTO `impeesa_newsTags` (`id`, `name`, `count`) VALUES
(25, 'LR', 1),
(24, 'Solingen', 1),
(23, '123', 1),
(22, 'Test', 1),
(26, 'Homepage', 1),
(27, 'Entwicklung', 1),
(28, '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_pageConfig`
--

CREATE TABLE IF NOT EXISTS `impeesa_pageConfig` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteName` text COLLATE latin1_general_ci NOT NULL,
  `pageTitle` text COLLATE latin1_general_ci NOT NULL,
  `menuTitle` text COLLATE latin1_general_ci NOT NULL,
  `enabled` int(11) NOT NULL,
  `toppage` int(11) NOT NULL,
  `visibleMenu` int(11) NOT NULL,
  `position` float NOT NULL,
  `isAdminPage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `impeesa_pageConfig`
--

INSERT INTO `impeesa_pageConfig` (`id`, `siteName`, `pageTitle`, `menuTitle`, `enabled`, `toppage`, `visibleMenu`, `position`, `isAdminPage`) VALUES
(3, 'home', 'Startseite', 'Startseite', 1, 0, 1, 1, 0),
(15, 'news', 'Neuigkeiten', 'Neuigkeiten', 1, 0, 1, 2, 0),
(16, 'login', 'Login', 'An-/Abmelden', 1, 0, 1, 99, 0),
(14, 'newsEntry', 'Neuigkeiten', '', 1, 15, 0, 0, 0),
(17, 'home', 'Startseite', 'Startseite', 1, 0, 0, 1, 1),
(18, 'news', 'News Verwalten', 'News Verwalten', 1, 0, 1, 2, 1),
(19, 'picture', 'Bilder Verwaltung', 'Bilder Verwaltung', 1, 0, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_pageElements`
--

CREATE TABLE IF NOT EXISTS `impeesa_pageElements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pageid` int(11) NOT NULL,
  `contenttype` int(11) NOT NULL,
  `contentid` int(11) NOT NULL,
  `position` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `impeesa_pageElements`
--

INSERT INTO `impeesa_pageElements` (`id`, `pageid`, `contenttype`, `contentid`, `position`) VALUES
(1, 3, 1, 1, 1),
(12, 14, 3, 0, 1),
(13, 15, 2, 0, 1),
(14, 16, 4, 1, 1),
(15, 18, 5, 1, 1),
(16, 19, 6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_pageRights`
--

CREATE TABLE IF NOT EXISTS `impeesa_pageRights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rights` int(1) NOT NULL,
  `roleId` int(3) NOT NULL,
  `pageId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `impeesa_pageRights`
--

INSERT INTO `impeesa_pageRights` (`id`, `rights`, `roleId`, `pageId`) VALUES
(11, 28, 4, 18),
(10, 7, 4, 1),
(12, 28, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_picture`
--

CREATE TABLE IF NOT EXISTS `impeesa_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `impeesa_picture`
--

INSERT INTO `impeesa_picture` (`id`, `test`) VALUES
(17, '86tdj78fg334hvjq06qmudfbk2'),
(16, '<?php echo session_id(); ?>'),
(15, '5q4kbposdneberh5s3ogb6vk63'),
(14, '<?php echo session_id(); ?>'),
(18, ''),
(19, 'FAIL!!'),
(20, 'idlqkrudth7ukal1tcj67ippq2'),
(21, 'q3ls730slnb3vbpn0a8nkpq3u1');

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_role`
--

CREATE TABLE IF NOT EXISTS `impeesa_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `impeesa_role`
--

INSERT INTO `impeesa_role` (`id`, `name`) VALUES
(1, 'Gast'),
(2, 'Leiter'),
(3, 'Webteam'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `impeesa_user`
--

CREATE TABLE IF NOT EXISTS `impeesa_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `role` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `impeesa_user`
--

INSERT INTO `impeesa_user` (`id`, `username`, `password`, `role`) VALUES
(3, 'André', '68eacb97d86f0c4621fa2b0e17cabd8c', 0),
(2, 'DasLampe', '68eacb97d86f0c4621fa2b0e17cabd8c', 4),
(1, 'Gast', '', 0);
