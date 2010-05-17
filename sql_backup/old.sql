-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 19. Februar 2010 um 10:34
-- Server Version: 5.1.42
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
  `extensionClass` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `impeesa_contenttype`
--

INSERT INTO `impeesa_contenttype` (`id`, `extensionPath`, `name`, `extensionClass`) VALUES
(1, 'impeesaContent/text/', 'Normaler Content (HTML)', 'impeesaContentText'),
(2, 'impeesaNews/all/', 'News (Alle)', 'impeesaNewsAll'),
(3, 'impeesaNews/specify/', 'News (Einzeln)', 'impeesaNewsSpecify');

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

INSERT INTO `impeesa_group` (`id`, `name`, `enabled`) VALUES
(1, 'Admin', 1),
(2, 'Gast', 1),
(3, 'User', 1);

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

INSERT INTO `impeesa_group_affiliation` (`id`, `userid`, `groupid`) VALUES
(1, 1, 2),
(2, 2, 1),
(7, 2, 3),
(6, 3, 3);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `impeesa_news`
--

INSERT INTO `impeesa_news` (`id`, `headline`, `content`, `startDate`, `endDate`, `userId`) VALUES
(1, 'Das ist ein Test', 'Mal sehen ob das geht!', 1260987300, 0, 2),
(2, 'Jaja', 'Ach Keine Ahnung!!', 1260988260, 0, 2),
(3, '123', '2', 1261524840, 0, 2),
(4, 'Ajax Test', 'Mal sehen!', 1261525320, 0, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_newsTagAffiliation`
--

CREATE TABLE IF NOT EXISTS `impeesa_newsTagAffiliation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `impeesa_newsTagAffiliation`
--

INSERT INTO `impeesa_newsTagAffiliation` (`id`, `tagId`, `newsId`) VALUES
(1, 10, 2),
(2, 11, 2),
(3, 12, 2),
(4, 13, 2),
(5, 14, 3),
(6, 15, 4),
(7, 15, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_newsTags`
--

CREATE TABLE IF NOT EXISTS `impeesa_newsTags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `impeesa_newsTags`
--

INSERT INTO `impeesa_newsTags` (`id`, `name`) VALUES
(11, 'Noch ein Test'),
(10, 'TestTag'),
(9, 'Keine Ahnung'),
(8, 'Pfadfinder'),
(7, 'Hallo'),
(12, ' Blog'),
(13, ' Yeeehaa'),
(14, '123'),
(15, 'Ajax');

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
  `uri` text COLLATE latin1_general_ci NOT NULL,
  `uriAttachment` text COLLATE latin1_general_ci NOT NULL,
  `route` text COLLATE latin1_general_ci NOT NULL,
  `toppage` int(11) NOT NULL,
  `visibleMenu` int(11) NOT NULL,
  `inherit_rights` int(11) NOT NULL DEFAULT '1',
  `position` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `impeesa_pageConfig`
--

INSERT INTO `impeesa_pageConfig` (`id`, `siteName`, `pageTitle`, `menuTitle`, `enabled`, `uri`, `uriAttachment`, `route`, `toppage`, `visibleMenu`, `inherit_rights`, `position`) VALUES
(1, '', 'Seite', '', 1, '/', '', '/home', 0, 0, 0, 0),
(2, '', 'Intern', '', 1, '/intern', '', '/intern/home', 0, 0, 0, 0),
(3, 'home', 'Startseite', 'Startseite', 1, '/home', '', '', 1, 1, 1, 1),
(15, 'news', 'Neuigkeiten', 'Neuigkeiten', 1, '', '', '', 1, 1, 1, 2),
(14, 'newsEntry', 'Neuigkeiten', '', 1, '', '', '', 15, 0, 1, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `impeesa_pageElements`
--

INSERT INTO `impeesa_pageElements` (`id`, `pageid`, `contenttype`, `contentid`, `position`) VALUES
(1, 3, 1, 1, 1),
(12, 14, 3, 0, 1),
(13, 15, 2, 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_pageRights`
--

CREATE TABLE IF NOT EXISTS `impeesa_pageRights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `right_read` int(11) NOT NULL,
  `right_write` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `pageId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `impeesa_pageRights`
--

INSERT INTO `impeesa_pageRights` (`id`, `right_read`, `right_write`, `groupid`, `pageId`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 0, 2, 1),
(3, 1, 0, 3, 1),
(4, 1, 1, 1, 3),
(5, 0, 0, 2, 3),
(6, 0, 0, 3, 3),
(7, 1, 1, 1, 2),
(8, 0, 0, 2, 2),
(9, 0, 0, 3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `impeesa_user`
--

CREATE TABLE IF NOT EXISTS `impeesa_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `impeesa_user`
--

INSERT INTO `impeesa_user` (`id`, `username`, `password`, `admin`) VALUES
(3, 'Andre', '68eacb97d86f0c4621fa2b0e17cabd8c', 0),
(2, 'DasLampe', '68eacb97d86f0c4621fa2b0e17cabd8c', 1),
(1, 'Gast', '', 0);
