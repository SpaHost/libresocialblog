<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

?>
  <style>
  #container { margin-top: 20px; padding: 25px; background: white; -webkit-box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5); -moz-box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5); box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5);}
.sidebar-nav { padding: 9px 0; }
* { margin: 0; padding: 0; }
body { margin-top: 50px; padding-bottom: 40px; min-width:780px; font-size: 13px; line-height: 18px; font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; background: url('/images/web/back.jpg'); }

/* Dividor de cabecera */
.group-menu .divider-vertical { }
.navbar .divider-vertical { width: 1px; margin: 0 9px; overflow: hidden; background-color: #222; border-right: 1px solid #333; }
.dropdown-menu .modal-body a.link-modal { padding: 3px 23px 3px 0; float: left; color: #4572A7; }

/* Subnav */
.subnav { width: 100%; height: 37px; background-color: #ffffff; }
.subnav .nav { margin-bottom: 0; }
.subnav .nav > li > a { margin: 0; padding-top: 11px; padding-bottom: 11px; border-right: 1px solid #e5e5e5; -webkit-border-radius: 0; -moz-border-radius: 0; border-radius: 0; }
.subnav .nav > .active > a, .subnav .nav > .active > a:hover { padding-left: 13px; color: #777; background-color: #e9e9e9; border-right-color: #ddd; border-left: 0; -webkit-box-shadow: inset 0 3px 5px rgba(0,0,0,.05); -moz-box-shadow: inset 0 3px 5px rgba(0,0,0,.05); box-shadow: inset 0 3px 5px rgba(0,0,0,.05); }
.subnav .nav > .active > a .caret, .subnav .nav > .active > a:hover .caret { border-top-color: #777; }
.subnav .nav > li:first-child > a, .subnav .nav > li:first-child > a:hover { border-left: 0; padding-left: 12px; -webkit-border-radius: 4px 0 0 4px; -moz-border-radius: 4px 0 0 4px; border-radius: 4px 0 0 4px; }
.subnav .nav > li:last-child > a { border-right: 0; }
.subnav .dropdown-menu { -webkit-border-radius: 0 0 4px 4px; -moz-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px; }
.subnav-fixed { position: relative; top: 40px; left: 0; right: 0; z-index: 1020; -webkit-box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5); -moz-box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5); box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5); }
.subnav-fixed .nav { width: 100%; margin: 0 auto; padding: 0 1px; background-color: #FFFFFF; }
.subnav .nav > li:first-child > a, .subnav .nav > li:first-child > a:hover { -webkit-border-radius: 0; -moz-border-radius: 0; border-radius: 0; }


/* Nueva nav */
.navbar .nav > li > a:hover { background-color: #3a87ad; color: #ffffff; text-shadow: none; }
.nav-pills > .active > a, .nav-pills > .active > a:hover { background-color: #3a87ad; color: #ffffff; }
.navbar .btn-navbar-left{display:none;float:left;padding:7px 10px;margin-right:5px;margin-left:5px;color:#fff;text-shadow:0 -1px 0 rgba(0,0,0,0.25);background-color:#ededed;*background-color:#e5e5e5;background-image:-moz-linear-gradient(top,#f2f2f2,#e5e5e5);background-image:-webkit-gradient(linear,0 0,0 100%,from(#f2f2f2),to(#e5e5e5));background-image:-webkit-linear-gradient(top,#f2f2f2,#e5e5e5);background-image:-o-linear-gradient(top,#f2f2f2,#e5e5e5);background-image:linear-gradient(to bottom,#f2f2f2,#e5e5e5);background-repeat:repeat-x;border-color:#e5e5e5 #e5e5e5 #bfbfbf;border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff2f2f2',endColorstr='#ffe5e5e5',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,0.1),0 1px 0 rgba(255,255,255,0.075);-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,0.1),0 1px 0 rgba(255,255,255,0.075);box-shadow:inset 0 1px 0 rgba(255,255,255,0.1),0 1px 0 rgba(255,255,255,0.075)}
.navbar .btn-navbar-left:hover,
.navbar .btn-navbar-left:active,
.navbar .btn-navbar-left.active,
.navbar .btn-navbar-left.disabled,
.navbar .btn-navbar-left[disabled]{color:#fff;background-color:#e5e5e5;*background-color:#d9d9d9}
.navbar .btn-navbar-left:active,
.navbar .btn-navbar-left.active{background-color:#ccc \9}
.navbar .btn-navbar-left .icon-bar{display:block;width:18px;height:2px;background-color:#f5f5f5;-webkit-border-radius:1px;-moz-border-radius:1px;border-radius:1px;-webkit-box-shadow:0 1px 0 rgba(0,0,0,0.25);-moz-box-shadow:0 1px 0 rgba(0,0,0,0.25);box-shadow:0 1px 0 rgba(0,0,0,0.25)}
.btn-navbar-left .icon-bar+.icon-bar{margin-top:3px}

/* Subnav */
.subnav { width: 100%; height: 37px; 
background-color: #3a87ad;
background-image: -moz-linear-gradient(top, #256593, #3a87ad);
background-image: -ms-linear-gradient(top, #256593, #3a87ad);
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#256593), to(#3a87ad));
background-image: -webkit-linear-gradient(top, #256593, #3a87ad);
background-image: -o-linear-gradient(top, #256593, #3a87ad);
background-image: linear-gradient(top, #256593, #3a87ad);
 }
.subnav a { color: #fff;}
.subnav .nav > li > a:hover { background-color: #256593;}
.subnav .nav { margin-bottom: 0; }
.subnav .nav > li > a { margin: 0; padding-top: 11px; padding-bottom: 11px; border-right: 1px solid #256593; -webkit-border-radius: 0; -moz-border-radius: 0; border-radius: 0; }
.subnav .nav > .active > a, .subnav .nav > .active > a:hover { padding-left: 13px; color: #fff; background-color: #256593;
background-image: -moz-linear-gradient(top, #3a87ad, #256593);
background-image: -ms-linear-gradient(top, #3a87ad, #256593);
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#3a87ad), to(#256593));
background-image: -webkit-linear-gradient(top, #3a87ad, #256593);
background-image: -o-linear-gradient(top, #3a87ad, #256593);
background-image: linear-gradient(top, #3a87ad, #256593);
 border-right-color: #256593; border-left: 0; -webkit-box-shadow: inset 0 3px 5px rgba(37,101,147,.05); -moz-box-shadow: inset 0 3px 5px rgba(37,101,147,.05); box-shadow: inset 0 3px 5px rgba(37,101,147,.05); }
.subnav .nav > .active > a .caret, .subnav .nav > .active > a:hover .caret { border-top-color: #256593; }
.subnav .nav > li:first-child > a, .subnav .nav > li:first-child > a:hover { border-left: 0; padding-left: 12px; -webkit-border-radius: 4px 0 0 4px; -moz-border-radius: 4px 0 0 4px; border-radius: 4px 0 0 4px; }
.subnav .nav > li:last-child > a { border-right: 0; }
.subnav .dropdown-menu { color: #256593;-webkit-border-radius: 0 0 4px 4px; -moz-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px; }

@media(max-width:979px){ body { margin-top:-1px } .brand img { padding-left: 20px } .subnav-fixed { position: absolute; top: 50px; left: 0; right: 0; z-index: 1020; }}
@media(min-width:980px){.subnav-fixed { position: fixed; top: 41px; left: 0; right: 0; z-index: 1020 }}


.subnav-fixed .nav { width: 100%; margin: 0 auto; padding: 0 1px; background-color: #3a87ad;
background-image: -moz-linear-gradient(top, #256593, #3a87ad);
background-image: -ms-linear-gradient(top, #256593, #3a87ad);
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#256593), to(#3a87ad));
background-image: -webkit-linear-gradient(top, #256593, #3a87ad);
background-image: -o-linear-gradient(top, #256593, #3a87ad);
background-image: linear-gradient(top, #256593, #3a87ad); }
.subnav .nav > li:first-child > a, .subnav .nav > li:first-child > a:hover { -webkit-border-radius: 0; -moz-border-radius: 0; border-radius: 0; }
.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, .nav > li.dropdown.open.active > a:hover { color: black; background-color: #fff; border-color: #fff; }
.subnav .dropdown-menu a { display: block; padding: 3px 20px; clear: both; font-weight: normal; line-height: 20px; color: black; white-space: nowrap; }
.caret_white { border-top-color: white !important; border-bottom-color: white !important; }
.copyright { margin-top:160px; margin: 0 auto }
.copyright a { color: #fff; -webkit-text-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5); -moz-text-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5); text-shadow: 0px 3px 5px rgba(0, 0, 0, 0.5);}
.copyright a:hover { text-decoration: none}

::-webkit-scrollbar {
    width: 10px;
    height: 15px;
}

::-webkit-scrollbar-button:Start:Decrement {
    height: 0px;
    display: block;
}

::-webkit-scrollbar-button:end:increment {
    height: 0px;
    display: block;
}

::-webkit-scrollbar-track-piece {
    background-color: #3b3b3b;
    -webkit-border-radius: 1px;
}

::-webkit-scrollbar-thumb:vertical {
    height: 50px;
    background-color: #666;
    border: 1px solid #333;
    -webkit-border-radius: 6px;
}

 </style>
<?
echo '
  <!-- Navbar
  ================================================== -->
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="brand" href="/lb-admin/">',$lb_title,'</a><a class="brand" style="margin:3px 0 -5px -35px; font-size:0.8em" href="/">Ver sitio...</a>
        <div class="nav-collapse collapse">
          <ul class="nav hidden-tablet hidden-desktop">
            <li class="active">
              <a href="/">Inicio</a>
            </li>
            <li class="">
              <a href="./getting-started.html">Get started</a>
            </li>
            <li class="">
              <a href="./scaffolding.html">Scaffolding</a>
            </li>
            <li class="">
              <a href="./base-css.html">Base CSS</a>
            </li>
            <li class="">
              <a href="./components.html">Components</a>
            </li>
            <li class="">
              <a href="./javascript.html">JavaScript</a>
            </li>
            <li class="">
              <a href="./customize.html">Customize</a>
            </li>
          </ul>
          <ul class="nav pull-right">
            <li class="divider-vertical"></li>
            <li><img alt="" src="/lb-template/default/img/profile/photo.jpg" style="padding-top:5px; width:30px"></li>
            <li class="dropdown">
              <a data-toggle="dropdown" href="#">'.ucwords($usuario_nick).' <b class="icon-caret caret_white icon-white"></b></a>
              <ul class="dropdown-menu">
                <li>
                  <div class="modal-header">
                    <h4>'.ucwords($usuario_nick).' <small>'.$staff_title.'</small></4>
                  </div>
                  <div class="modal-body span3">
                    <div class="row">
                      <div class="span1 pull-left"><img src="/lb-template/default/img/profile/photo.jpg" alt="avatar"></div>
                      <div class="span2 pull-right" style="right:0px;">
                        <h5>'.$usuario_email.'</h5>
                        <a href="#" class="link-modal">Cuenta</a> <a href="#" class="link-modal">Configuracion</a>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="/lb-admin/index.php?p=profile" class="btn btn-small pull-left">Mostrar Perfil</a>
                    <a class="btn btn-small" href="/lb-admin/index.php?salir">Salir</a>
                  </div>
                </li>
              </ul>
            </li>
        </div>
      </div>
    </div>
  </div>
  <div class="subnav subnav-fixed">
    <div class="container">
      <ul class="nav nav-pills">
        <li class="active"><a href="/lb-admin/index.php?p=home"><i class="glyphicon glyphicon-home">h</i> Principal</a></li>
        <li class="active"><a href="/lb-admin/index.php?p=news"><i class="glyphicon glyphicon-home">x</i> Noticias</a></li>
      </ul>
    </div>
  </div>
  <div class="container" id="container" style="margin-top:60px;">
';

?>