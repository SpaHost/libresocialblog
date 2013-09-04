<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J. Gonzalez Cabrera
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Carpeta del programa
if (function_exists ( 'realpath' ) and @realpath ( dirname ( __FILE__ ) ) !== FALSE) {
	$c_s = str_replace ( '', '/', realpath ( dirname ( __FILE__ ) ) );
}

// Variables de carpetas usuario
define ( 'ext',		'.' . pathinfo ( __FILE__, PATHINFO_EXTENSION ) );       // Extension
define ( 'extf',	'.func.' . pathinfo ( __FILE__, PATHINFO_EXTENSION ) );  // Extension de Funcion
define ( 'basedir',	$c_s . '/' ); // Carpeta root
define ( 'func',	$c_s . '/lb-functions/' );
define ( 'temp',	$c_s . '/lb-template/' );
define ( 'gene',    $c_s . '/lb-functions/generators/' );                    // Carpeta Generadores
define ( 'apis',    $c_s . '/lb-functions/apis/' );                          // Carpeta Generadores

// Variables de carpetas administracion
define ( 'atemp',	$c_s . '/lb-admin/template/' );
define ( 'amod',	$c_s . '/lb-admin/modules/' );

// Insertamos datos configurables
include basedir.'config.php';

// Configuracion Principal
$ver_web        = 'v0.10';

// Functions
include func.'selkey'.extf;
include func.'http-headers'.extf;
include func.'secure'.extf;
include func.'mysql-nucleo'.extf;
include func.'mysql-handler'.extf;
include func.'load-param'.extf;

include func.'time'.extf;
include func.'userinfo'.extf;
include func.'sessions'.extf;
  include apis.'foursquare'.ext;
  include apis.'google-analytics'.ext;
include func.'generador'.extf;

// Funciones
//include func.'language'.extf;
//include func.'headers'.extf;

// Template set
include func.'template'.extf;

?>