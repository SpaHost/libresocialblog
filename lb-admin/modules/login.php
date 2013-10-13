<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Navbar
echo '
  <style>
body {
    overflow:hidden;
}
    body { padding-bottom: 40px; color: #5a5a5a; }
    .navbar .navbar-inner { border: 0; -webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25); -moz-box-shadow: 0 2px 10px rgba(0,0,0,.25); box-shadow: 0 2px 10px rgba(0,0,0,.25); }
    .navbar .nav > li > a { padding: 15px 20px; }
    .navbar .btn-navbar { margin-top: 10px; }

    /* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */
    /* Carousel base class */

    .login .container {
      position: relative;
      margin-top: 230px
    }
 
    .login-wall {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      min-width: 100%;
    }

.boton-log {
  margin: -30px 0px 0px -30px;
}
.login  h1,
.login  .lead {
      margin: 0;
      line-height: 1.25;
      color: #fff;
      text-align: center;
      text-shadow: 0 1px 4px rgba(0,0,0,.4);
    }

.leadi {
        max-width: 300px;
        padding: 0 29px 29px;
        margin: 0 auto 20px;
}

.fofoter {
      position: fixed;
      font-size: 0.75em;
      color: #fff;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      text-decoration: none;
      bottom: 5px;
      left: 25px;
}

.fofoter a:hover {
      text-decoration: none;
    }
.leadi a,
.leadi a:hover{
      margin: 0;
      font-size: 0.85em;
      color: #fff;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      text-decoration: none;
      margin: 0 auto;

    }


     .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 7px rgba(0,0,0,.5);
           -moz-box-shadow: 0 1px 7px rgba(0,0,0,.5);
                box-shadow: 0 1px 7px rgba(0,0,0,.5);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

.alert {
	margin-top: -50px;
	width:70%;
	margin-left: 10%;
	        -webkit-box-shadow: 0 1px 7px rgba(0,0,0,.5);
           -moz-box-shadow: 0 1px 7px rgba(0,0,0,.5);
                box-shadow: 0 1px 7px rgba(0,0,0,.5);
}



    /* RESPONSIVE CSS
    -------------------------------------------------- */

    @media (max-width: 979px) {

      .container.navbar-wrapper { margin-bottom: 0; width: auto; }
      .navbar-inner { border-radius: 0; margin: -20px 0; }
      .login .container { position: relative; margin-top: 175px }
      .login-wall { width: auto; height: 400px; }

    }


    @media (max-width: 767px) {

      .navbar-inner {
        margin: -20px;
      }

      .login {
        margin-left: -20px;
        margin-right: -20px;
      }
      .login .container {

      }

      .login-wall {
        width: 100%;
        height: 300px;
      }
      .login .container{
        width: 65%;
        padding: 0 70px;
        margin-top: 80px;
      }
      .login .container h1 {
        font-size: 30px;
      }
.form-signin { margin-top: 10px;}
.leadi a {
        font-color:#000;
}

    }



    </style>


  <div class="login">
    <img class="login-wall" src="/lb-admin/template/img/wall.jpg" alt="">
    <div class="container">';

    if($_SESSION['msg']['login-err']) {
  echo '<div class="alert alert-error fade in">'.$_SESSION['msg']['login-err'].'<a class="close" data-dismiss="alert" href="#">&times;</a></div>';
  unset($_SESSION['msg']['login-err']);
}
    echo '
      <div class="row">
        <div class="col-md-6">
          <img src="/lb-admin/template/img/logo.png" alt="lsb backgroud">
          <h1>Tu espacio personal</h1>
          <p class="lead">Administra tu blog libre desde aquí.</p>
        </div>
        <div class="col-md-6">
          <form class="form-signin" action="/lb-admin/index.php" method="post">
          <h2 class="form-signin-heading">Identificación</h2>
          <input type="text" class="input-block-level" name="username" id="username" placeholder="Nombre Usuario">
          <input type="password" class="input-block-level" name="password" id="password" placeholder="Contraseña">
          <label class="checkbox">
            <input type="checkbox" value="rememberme"> Recordar sesión
          </label>
          <button class="btn btn-large btn-primary pull-right boton-log" type="submit" name="submit" id="login" value="Entrar" >Entrar</button>
          </form>
          <p class="leadi"><a href="/">« Volver a ',$lb_title,'</a></p>
        </div>
      </div><footer><p class="fofoter">Powered by Libre Social Blog ',$ver_web,'<br><a href="">About Us</a> | <a href="">Contact</a> | <a href="">Share it!</a></p></footer>
    </div>

  </div>

  <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
  <![endif]-->
  <script src="/js/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  </body>
</html>';

?>