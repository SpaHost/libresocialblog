<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Fijar Headers
header("Status: 200");
header("Content-type: text/HTML; charset: UTF-8");
header('X-UA-Compatible: IE=8,IE=Edge,chrome=1');

// Fijamos Cache
header("Cache-Control: must-revalidate");
  $offset = 60 * 60 * 24 * 3;
  $ExpStr = "Expires: " .
  gmdate("D, d M Y H:i:s",
  time() - $offset) . " GMT";
header($ExpStr);
header("Pragma: public");

// Miscelanea
header("Server: LSB");
header("X-Powered-By: Libre Social Blog");

// Fijar debug
@set_time_limit(5);
@ini_set('memory_limit', '128M');
@ini_set('display_errors', 'Off');
error_reporting(0);

// Funcion forzar descarga
function forzar_descarga ($file) {
  $file_name = $file;
  $mime = 'application/force-download';
  header('Pragma: public');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Cache-Control: private',false);
  header('Content-Type: '.$mime);
  header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
  header('Content-Transfer-Encoding: binary');
  header('Connection: close');
  readfile($file_name);
  exit();
}

?>