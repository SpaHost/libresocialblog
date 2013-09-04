<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Empezamos la sesion y la hacemos valida por 1 semana
session_name('lsb_');
session_set_cookie_params(7*24*60*60);
session_start();

// Se cierra sesion por seguridad (si no existe cookie ni "remember me")
if ($_SESSION['id'] && !isset($_COOKIE['lb_Remember']) && !$_SESSION['lb_rememberMe']) {
  // Cerramos la sesion
  $_SESSION = array();
  session_destroy();
}

// Cerrar la sesion al salir
if (isset($_GET['salir'])) {
  $db->query("DELETE FROM lb_users_online WHERE user_login='$_SESSION[username]'");
  $_SESSION = array();
  session_destroy();
  header("Location: /index.php");
  exit;
}

// Verificando los datos de login
if ($_POST['submit']=='Entrar') {

  // Marcamos si hay errores
  $err = array();

  // Si falta algun campo sin rellenar
  if (!$_POST['username'] || !$_POST['password']){
    $err[] = 'Rellena todos los campos!';
  }

  // Si no hay errores
  if (!count($err)) {
    $_POST['username'] = mysql_real_escape_string($_POST['username']);
    $_POST['password'] = mysql_real_escape_string($_POST['password']);

    // Buscando los datos en SQL
    $user = $db->get_row("SELECT id, user_login FROM lb_users WHERE user_login='{$_POST['username']}' AND user_pass='".md5($_POST['password'])."'");
    // Si se encuentra usuario
    if ($user->user_login) {
      // Se guardan algunos datos en la sesion
      $_SESSION['username']     = $user->user_login;
      $_SESSION['id']           = $user->id;
      $_SESSION['lb_rememberMe']   = '1';

      setcookie('username', $user->user_login);
      setcookie('lb_Remember','1');
    }
    else $err[]= 'Error, <strong>Usuario</strong> o <strong>contraseña</strong> incorrectos!';
  }

  // Guardamos en sesion los errores
  if ($err){
    $_SESSION['msg']['login-err'] = implode('<br />',$err);
  }

  // Borramos nuestro user como invitado
  $db->query("DELETE FROM lb_users_online where user_login='Invitado' AND ip='$_SERVER[REMOTE_ADDR]'");

  // Mandamos a la pagina principal
  header("Location: /lb-admin/index.php");
  exit;
}

// Sacamos informacion del usuario y la guardamos en variables
if (isset($_SESSION['id'])) {
  $select_userinfo = $db->get_row("SELECT * FROM lb_users WHERE id='".$_SESSION['id']."'");

  $usuario_id     = $select_userinfo->id;
  $usuario_login  = $select_userinfo->user_login;
  $usuario_email  = $select_userinfo->user_email;
  $usuario_url    = $select_userinfo->user_url;
  $usuario_reg    = $select_userinfo->user_registrered;
  $usuario_key    = $select_userinfo->user_activation_key;
  $usuario_stat   = $select_userinfo->user_status;
  $usuario_nick   = $select_userinfo->display_name;
}
/**
if ($usuario_cl == '1') { $usuario_scl = '1'; }

// Insertar ultima vez logeado
if (isset($usuario_id)) {
  $timenow = date ('Y-m-d H:i:s');
  $db->query("UPDATE vt_users SET last_login='$timenow', last_seen='$_SERVER[QUERY_STRING]', ip='$_SERVER[REMOTE_ADDR]', navigator='$explorer' WHERE id='$usuario_id' ");
}

// Sacamos la informacion de rango
if ($usuario_id) {
  $select_useraccess = $db->get_row("SELECT * FROM vt_users_rank WHERE rank='$usuario_rank' ");

  $staff_title        = $select_useraccess->title;
  $staff_icon         = $select_useraccess->icon;
  $staff_access       = $select_useraccess->staff;
  $access_orders      = $select_useraccess->access_orders;
  $access_invoices    = $select_useraccess->access_invoices;
  $access_documents   = $select_useraccess->access_documents;
  $access_customers   = $select_useraccess->access_customers;
  $access_guides      = $select_useraccess->access_guides;
  $access_places      = $select_useraccess->access_places;
  $access_offices     = $select_useraccess->access_offices;
  $access_stocks      = $select_useraccess->access_stocks;
  $access_messaging   = $select_useraccess->access_messaging;
  $access_web_config  = $select_useraccess->access_web_config;
  $access_shoutbox    = $select_useraccess->access_shoutbox;
} else {
  $staff_access       = '0';
  $access_orders      = '0';
  $access_invoices    = '0';
  $access_documents   = '0';
  $access_customers   = '0';
  $access_guides      = '0';
  $access_places      = '0';
  $access_offices     = '0';
  $access_stocks      = '0';
  $access_messaging   = '0';
  $access_web_config  = '0';
  $access_shoutbox    = '0';
}

// Tiempo de inactividad
$timeoutseconds       = '900';
$timeoutidle          = '900';
$timeoutseconds_chat  = '86400';
$timestamp            = time();
$timeout_chat         = $timestamp - $timeoutseconds_chat;
$timeout              = $timestamp - $timeoutseconds;
$timeout_idle         = $timestamp - $timeoutidle;
$cur_place = $_SERVER['REQUEST_URI'];

// Proteger sql por culpa del chat
if (!$_GET['daction']){

  // Insertamos por SQL la actividad del usuario y si esta online
  if ($usuario_id) {
    $delete = mysql_query ("DELETE FROM vt_users_online where username='$usuario_nick' ");
    $ttime = date ('g:i A');
    $db->query("INSERT INTO vt_users_online SET timestap='$timestamp', status='0', ttime='$ttime', username='$usuario_nick', ip='$_SERVER[REMOTE_ADDR]', country='".get_location($_SERVER[REMOTE_ADDR], 'country')."', file='$cur_place', page_title='".ucwords($pag_subs)."', os='".get_os()."', browser='".$getbrowser['name']."', browser_ver='".$getbrowser['version']."' ");
  } else {
    $delete = mysql_query ("DELETE FROM vt_users_online where username='Invitado' ");
    $ttime = date ('g:i A');
    $db->query("INSERT INTO vt_users_online SET timestap='$timestamp', status='0', ttime='$ttime', username='Invitado', ip='$_SERVER[REMOTE_ADDR]', country='".get_location($_SERVER[REMOTE_ADDR], 'country')."', file='$cur_place', page_title='".ucwords($pag_subs)."', os='".get_os()."', browser='".$getbrowser['name']."', browser_ver='".$getbrowser['version']."' ");    
  }

  // Cada vez que se actualice pagina se comprueba el estado
  $db->query('DELETE FROM vt_users_online WHERE timestap<'.$timeout);
  $db->query('UPDATE vt_users_online SET status=\'1\' WHERE timestap<'.$timeout_idle);

  // Borramos chat si pasan 24h
  $db->query('DELETE FROM vt_chat WHERE timestap<'.$timeout_chat);
}

// Sacamos info de usuarios online
$sqlasb = $db->get_var("SELECT count(*) FROM vt_users_online");
$sqlasw = $db->get_results("SELECT * FROM vt_users_online ORDER BY username ASC");
$conect_chat = $sqlasb-1;

**/

?>