<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J. Gonzalez Cabrera
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Security def
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Set time zone
date_default_timezone_set('Europe/Madrid');

// Set default settings **
$default_lang = "spanish";
$template 	  = "default";

// MySQL Database configuration
$db_host    = 'localhost';
$db_user    = '';
$db_pass    = '';
$db_daba    = '';
$db_prefix  = '';

// Llamadas a SQL
$link = mysql_connect($db_host,$db_user,$db_pass);
        mysql_select_db($db_daba,$link);
        mysql_query("SET NAMES 'utf8'");
        
?>
