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

?>