-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Mai 2010 um 14:16
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `impeesa`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_config`
--

CREATE TABLE IF NOT EXISTS `impeesa_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `config_key` text COLLATE latin1_general_ci NOT NULL,
  `config_value` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `impeesa_config`
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
-- Tabellenstruktur für Tabelle `impeesa_contentText`
--

CREATE TABLE IF NOT EXISTS `impeesa_contentText` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `headline` text COLLATE latin1_general_ci NOT NULL,
  `content` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `impeesa_contentText`
--

INSERT INTO `impeesa_contentText` (`id`, `headline`, `content`) VALUES
(1, 'Willkommen', 'Das ist die 1. Seite'),
(2, '', '<h1>Was geht ab?!</h1>'),
(3, '', '<div>Jaja, hoffentlich geht das!</div>');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_contenttype`
--

CREATE TABLE IF NOT EXISTS `impeesa_contenttype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `extensionPath` text COLLATE latin1_general_ci NOT NULL,
  `name` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `impeesa_contenttype`
--

INSERT INTO `impeesa_contenttype` (`id`, `extensionPath`, `name`) VALUES
(1, 'impeesaContent/text/', 'Normaler Content (HTML)'),
(2, 'impeesaNews/all/', 'News (Alle)'),
(3, 'impeesaNews/specify/', 'News (Einzeln)'),
(4, 'impeesaUser/login/', 'Login/Logout Modul'),
(5, 'impeesaNews/acp/', 'News Verwaltung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_error`
--

CREATE TABLE IF NOT EXISTS `impeesa_error` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` text COLLATE latin1_general_ci NOT NULL,
  `message` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `impeesa_error`
--

INSERT INTO `impeesa_error` (`id`, `status`, `message`) VALUES
(1, '404', 'Seite ist nicht vorhanden!');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_group`
--

CREATE TABLE IF NOT EXISTS `impeesa_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `enabled` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `impeesa_group`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_group_affiliation`
--

CREATE TABLE IF NOT EXISTS `impeesa_group_affiliation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `impeesa_group_affiliation`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_log`
--

CREATE TABLE IF NOT EXISTS `impeesa_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulFile` text COLLATE latin1_general_ci NOT NULL,
  `logMessage` text COLLATE latin1_general_ci NOT NULL,
  `logTime` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=49 ;

--
-- Daten für Tabelle `impeesa_log`
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
(48, '/Applications/XAMPP/xamppfiles/htdocs/lib/extension/impeesaNews/acp/impeesaNewsAcp.class.php', 'INSERT NEWS ID: 0', 1273928452, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_news`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

--
-- Daten für Tabelle `impeesa_news`
--

INSERT INTO `impeesa_news` (`id`, `headline`, `content`, `startDate`, `endDate`, `userId`, `newsStatus`, `permaLink`) VALUES
(26, 'News System ist fertig!', 'Als erstes ist un das News System fertig.<br><br>Funktionen: News erstellen, News löschen, News bearbeiten.<br>Das alles kann nur von Usern gemacht werden, welche einer Rolle angehören, welche Rechte für diese hat!', 1273881600, 0, 2, 1, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_newsTagAffiliation`
--

CREATE TABLE IF NOT EXISTS `impeesa_newsTagAffiliation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=141 ;

--
-- Daten für Tabelle `impeesa_newsTagAffiliation`
--

INSERT INTO `impeesa_newsTagAffiliation` (`id`, `tagId`, `newsId`) VALUES
(140, 27, 26),
(139, 26, 26);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_newsTags`
--

CREATE TABLE IF NOT EXISTS `impeesa_newsTags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=28 ;

--
-- Daten für Tabelle `impeesa_newsTags`
--

INSERT INTO `impeesa_newsTags` (`id`, `name`, `count`) VALUES
(25, 'LR', 1),
(24, 'Solingen', 1),
(23, '123', 1),
(22, 'Test', 1),
(26, 'Homepage', 1),
(27, 'Entwicklung', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_pageConfig`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;

--
-- Daten für Tabelle `impeesa_pageConfig`
--

INSERT INTO `impeesa_pageConfig` (`id`, `siteName`, `pageTitle`, `menuTitle`, `enabled`, `toppage`, `visibleMenu`, `position`, `isAdminPage`) VALUES
(3, 'home', 'Startseite', 'Startseite', 1, 0, 1, 1, 0),
(15, 'news', 'Neuigkeiten', 'Neuigkeiten', 1, 0, 1, 2, 0),
(16, 'login', 'Login', 'An-/Abmelden', 1, 0, 1, 99, 0),
(14, 'newsEntry', 'Neuigkeiten', '', 1, 15, 0, 0, 0),
(17, 'home', 'Startseite', 'Startseite', 1, 0, 0, 1, 1),
(18, 'news', 'News Verwalten', 'News Verwalten', 1, 0, 1, 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_pageElements`
--

CREATE TABLE IF NOT EXISTS `impeesa_pageElements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pageid` int(11) NOT NULL,
  `contenttype` int(11) NOT NULL,
  `contentid` int(11) NOT NULL,
  `position` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `impeesa_pageElements`
--

INSERT INTO `impeesa_pageElements` (`id`, `pageid`, `contenttype`, `contentid`, `position`) VALUES
(1, 3, 1, 1, 1),
(12, 14, 3, 0, 1),
(13, 15, 2, 0, 1),
(14, 16, 4, 1, 1),
(15, 18, 5, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_pageRights`
--

CREATE TABLE IF NOT EXISTS `impeesa_pageRights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rights` int(1) NOT NULL,
  `roleId` int(3) NOT NULL,
  `pageId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `impeesa_pageRights`
--

INSERT INTO `impeesa_pageRights` (`id`, `rights`, `roleId`, `pageId`) VALUES
(11, 28, 4, 18),
(10, 7, 4, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_role`
--

CREATE TABLE IF NOT EXISTS `impeesa_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `impeesa_role`
--

INSERT INTO `impeesa_role` (`id`, `name`) VALUES
(1, 'Gast'),
(2, 'Leiter'),
(3, 'Webteam'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_user`
--

CREATE TABLE IF NOT EXISTS `impeesa_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `role` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `impeesa_user`
--

INSERT INTO `impeesa_user` (`id`, `username`, `password`, `role`) VALUES
(3, 'André', '68eacb97d86f0c4621fa2b0e17cabd8c', 0),
(2, 'DasLampe', '68eacb97d86f0c4621fa2b0e17cabd8c', 4),
(1, 'Gast', '', 0);
