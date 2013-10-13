<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Ficheros del template
if ($set_web == '0') {
  //$cpage = cmod.$pag_pers.ext;
  include atemp.'headers'.ext;
  if ($usuario_id) {
    if (!$pag_pers) {
      include atemp.'head'.ext;
      include amod.'home'.ext;
    } else {
      include atemp.'head'.ext;
      include amod.$pag_pers.ext;
    } 
  } else {
    include amod.'login'.ext;
  }
} else {
  //$cpage = mod.$pag_pers.ext;
  include func.'html-header'.extf;
/**
 if (!$pag_pers) {
    if ($usuario_id) {
      include cmod.'home'.ext;
    } else {
      include cmod.'login'.ext;
    }
  } else {

    $cpage = mod.$pag_pers.ext;

**/

  include temp.$lb_template.'/header'.ext;
}

// Incluir cabecera
 // include temp.'cabeza'.ext;

// Incluir pagina si existe
/**
if (!$pag_pers) {
  if ($set_web == '0') {
    if ($usuario_id) {
      include cmod.'home'.ext;
    } else {
      include cmod.'login'.ext;
    }
  } else {
    //include mod.'home'.ext;
    include temp.$template.'/header'.ext;
  }

} else {

**/
  

/**
  // Mensaje de error
  if (file_exists($cpage)) {
    if ($set_web == '0') {
      if ($usuario_id) {
        include $cpage;
      } else {
        include cmod.'login'.ext;
      }
    } else if ($set_web == '8') {
      if ($usuario_id) {
        include $cpage;
      } else {
        header('Location: /cps');
      }
    } else if ($set_web == '1') {
      include $cpage;
    }
  } else {
    if ($set_web == '0' || $set_web == '8') {
      echo '
        <div class="page-header">
          <h1>Module not found!</h1>
        </div>
        <div id="content">
          <div class="alert alert-error"><strong>Informamos:</strong> La pagina que esta buscando actualmente no esta disponible. <a class="close" href="/cps/index.php">&times;</a></div>
        </div>
      </div>
    </div>';
    } else if ($set_web == '1') {
      echo '<div class="pull-right" style="margin-top:20px; margin-right:50px;">
          <h1>Module not found!</h1>
        </div>
        <div id="content" style="margin-top:120px;">
          <div class="alert alert-error"><strong>Informamos:</strong> La pagina que esta buscando actualmente no esta disponible.</div>
        </div>';
    }
  }
}

// Incluir pie de pagina
include temp.'/pie'.ext;
**/
?>