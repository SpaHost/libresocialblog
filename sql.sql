-- --------------------------------------------------------
-- Host:                         spahost.es
-- Versión del servidor:         5.1.70-cll - MySQL Community Server (GPL)
-- SO del servidor:              unknown-linux-gnu
-- HeidiSQL Versión:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para spahost_lsb
CREATE DATABASE IF NOT EXISTS `spahost_lsb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `spahost_lsb`;


-- Volcando estructura para tabla spahost_lsb.lb_cat
CREATE TABLE IF NOT EXISTS `lb_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) DEFAULT NULL,
  `title` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `description` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Categorias del blog';

-- Volcando estructura para tabla spahost_lsb.lb_config
CREATE TABLE IF NOT EXISTS `lb_config` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '',
  `subtitle` varchar(60) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `site_url` varchar(100) NOT NULL DEFAULT '',
  `lang` varchar(5) NOT NULL,
  `template` varchar(255) NOT NULL DEFAULT '',
  `mantenimiento` int(2) NOT NULL DEFAULT '0',
  `limit_home` int(2) NOT NULL DEFAULT '0',
  `limit_rss` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`title`),
  KEY `user_nicename` (`author`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Configuracion del blog';

-- Volcando datos para la tabla spahost_lsb.lb_config: 1 rows
DELETE FROM `lb_config`;
/*!40000 ALTER TABLE `lb_config` DISABLE KEYS */;
INSERT INTO `lb_config` (`id`, `title`, `subtitle`, `description`, `author`, `email`, `site_url`, `lang`, `template`, `mantenimiento`, `limit_home`, `limit_rss`) VALUES
	(1, 'Nombre de Blog', 'Subtitulo de tu blog', 'descripcion de blog', 'tu nombre', 'tu email', 'http://www.tu-web.com', 'es', 'default', 0, 10, 25);
/*!40000 ALTER TABLE `lb_config` ENABLE KEYS */;


-- Volcando estructura para tabla spahost_lsb.lb_news
CREATE TABLE IF NOT EXISTS `lb_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `news` text CHARACTER SET latin1 NOT NULL,
  `news_extend` text CHARACTER SET latin1 NOT NULL,
  `author` varchar(99) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `source` varchar(99) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `views` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `link` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `oday` varchar(2) DEFAULT NULL,
  `omonth` varchar(2) DEFAULT NULL,
  `oyear` varchar(4) DEFAULT NULL,
  `ttime` int(10) NOT NULL,
  `lsttime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `FULLTEXT` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

-- Volcando estructura para tabla spahost_lsb.lb_users
CREATE TABLE IF NOT EXISTS `lb_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` int(10) NOT NULL,
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`user_login`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla spahost_lsb.lb_users: 1 rows
DELETE FROM `lb_users`;
/*!40000 ALTER TABLE `lb_users` DISABLE KEYS */;
INSERT INTO `lb_users` (`id`, `user_login`, `user_pass`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@tuweb.com', 'http://www.tu-web.com', 1, '', 0, 'Nick a mostrar');
/*!40000 ALTER TABLE `lb_users` ENABLE KEYS */;


-- Volcando estructura para tabla spahost_lsb.lb_users_online
CREATE TABLE IF NOT EXISTS `lb_users_online` (
  `timestap` int(15) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL,
  `ttime` varchar(55) NOT NULL DEFAULT '',
  `username` varchar(55) NOT NULL DEFAULT '',
  `ip` varchar(40) NOT NULL DEFAULT '',
  `country` varchar(10) NOT NULL DEFAULT '',
  `file` varchar(100) NOT NULL DEFAULT '',
  `page_title` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `browser_ver` varchar(100) NOT NULL,
  PRIMARY KEY (`timestap`),
  KEY `ip` (`ip`),
  KEY `file` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla spahost_lsb.lb_users_online: 0 rows
DELETE FROM `lb_users_online`;
/*!40000 ALTER TABLE `lb_users_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `lb_users_online` ENABLE KEYS */;


-- Volcando estructura para tabla spahost_lsb.vt_users_online
CREATE TABLE IF NOT EXISTS `vt_users_online` (
  `timestap` int(15) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL,
  `ttime` varchar(55) NOT NULL DEFAULT '',
  `username` varchar(55) NOT NULL DEFAULT '',
  `ip` varchar(40) NOT NULL DEFAULT '',
  `country` varchar(10) NOT NULL DEFAULT '',
  `file` varchar(100) NOT NULL DEFAULT '',
  `page_title` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `browser_ver` varchar(100) NOT NULL,
  PRIMARY KEY (`timestap`),
  KEY `ip` (`ip`),
  KEY `file` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla spahost_lsb.vt_users_online: 0 rows
DELETE FROM `vt_users_online`;
/*!40000 ALTER TABLE `vt_users_online` DISABLE KEYS */;
/*!40000 ALTER TABLE `vt_users_online` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
