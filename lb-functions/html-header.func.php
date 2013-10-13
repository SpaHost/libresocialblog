<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Headers html5
echo '<!DOCTYPE html>
<html lang="',$lb_lang,'">
<head>
  <meta charset="utf-8">
';

if ($pag_pers == 'post'){
  echo '  <title>',$lb_title,' - ',$lb_post_title,'</title>
  <meta name="description" content="',$lb_post_title,'">';
} else {
  echo '  <title>',$lb_title,' - ',$lb_subtitle,'</title>
  <meta name="description" content="',$lb_description,'">';
}

echo '
  <meta name="author" content="',$lb_author,'">
  <meta name="keywords" content="',$lb_post_desc,'">
  <link rel="alternate" type="application/rss+xml" title="',$lb_title,' (RSS 2.0)"" href="http://',$_SERVER["HTTP_HOST"],'/feed" />
  <link rel="shortcut icon" href="http://',$_SERVER["HTTP_HOST"],'/favicon.png" type="image/png" />
  <link rel="stylesheet" media="screen" href="/lb-template/',$lb_template,'/css/bootstrap.min.css" />
  <link rel="stylesheet" media="screen" href="/lb-template/',$lb_template,'/css/datepicker.css" />
  <link rel="stylesheet" media="screen" href="/lb-template/',$lb_template,'/css/prettify.css" />
  <link rel="stylesheet" media="screen" href="/lb-template/',$lb_template,'/css/wysihtml5.css" />
  <link rel="stylesheet" media="screen" href="/lb-template/',$lb_template,'/style.css" />
</head>
<!-- Termina la cabecera -->
<body onload="prettyPrint()" bgcolor="white">';

?>