<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Desactivar magic quotes si esta activado
if (get_magic_quotes_runtime()) set_magic_quotes_runtime(0);

// Quita las barras definidas en variables
if (get_magic_quotes_gpc()) {
  function stripslashes_array($array) {
    return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);
  }
  $_REQUEST = stripslashes_array($_REQUEST);
  $_GET     = stripslashes_array($_GET);
  $_POST    = stripslashes_array($_POST);
  $_COOKIE  = stripslashes_array($_COOKIE);
}

// Variable para peticiones
  $op       = $_REQUEST['op'];
  $cat      = $_REQUEST['cat'];
  $pag_pers = $_REQUEST['p'];
  if ($pag_pers == 'post'){
    $post_id  = $_REQUEST['id'];
  }
  $gen      = $_REQUEST['gen'];
  
// Controlar categorias
  if (!$cat) {
    $cat = '1';
   }
  if (isset($_GET["page"])) {
    $page   = $_GET["page"];
  } else {
    $page   = 1;
  }

// Quitar tildes en url
function srcc($cadena) {
  $vocalti = array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","À","È","Ì","Ò","Ù","à","è","ì","ò","ù","ç","Ç","â","ê","î","ô","û","Â","Ê","Î","Ô","Û","ü","ö","Ö","ï","ä","ë","Ü","Ï","Ä","Ë","---","º"," ","\r\n","\n","?","!"); 
  $vocales = array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","-","","-","-","-","",""); 
  $cadena = str_replace($vocalti, $vocales, $cadena); 
  return $cadena; 
}

// Funcion para paginacion
function pagination($query, $per_page = 10,$page = 1, $url = '?'){
  $query = "SELECT COUNT(*) as `num` FROM {$query}";
  $row = mysql_fetch_array(mysql_query($query));
  $total = $row['num'];
  $adjacents = "2"; 
 
  $page = ($page == 0 ? 1 : $page);
  $start = ($page - 1) * $per_page;
         
  $prev = $page - 1;
  $next = $page + 1;
  $lastpage = ceil($total/$per_page);
  $lpm1 = $lastpage - 1;
         
  $pagination = "";
  if($lastpage > 1) {   
    $pagination .= "<ul class='pagination pull-right'>";
    if ($lastpage < 7 + ($adjacents * 2)) {   
      for ($counter = 1; $counter <= $lastpage; $counter++) {
        if ($counter == $page)
          $pagination.= "<li class='active'><a href='#'>$counter</a></li>";
        else
          $pagination.= "<li><a href='/page/$counter'>$counter</a></li>";
      }
    } elseif ($lastpage > 5 + ($adjacents * 2)) {
      if($page < 1 + ($adjacents * 2)) {
        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
          if ($counter == $page)
            $pagination.= "<li class='active'><a href='#'>$counter</a></li>";
          else
            $pagination.= "<li><a href='/page/$counter'>$counter</a></li>";
        }
        $pagination.= "<li class='disabled'><a href='#'>...</a></li>";
        $pagination.= "<li><a href='/page/$lpm1'>$lpm1</a></li>";
        $pagination.= "<li><a href='/page/$lastpage'>$lastpage</a></li>";
      } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
        $pagination.= "<li><a href='/page/1'>1</a></li>";
        $pagination.= "<li><a href='/page/2'>2</a></li>";
        $pagination.= "<li class='disabled'><a href='#'>...</a></li>";
          for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
            if ($counter == $page)
              $pagination.= "<li class='active'><a href='#'>$counter</a></li>";
            else
              $pagination.= "<li><a href='/page/$counter'>$counter</a></li>";
          }
        $pagination.= "<li class='disabled'><a href='#'>...</a></li>";
        $pagination.= "<li><a href='/page/$lpm1'>$lpm1</a></li>";
        $pagination.= "<li><a href='/page/$lastpage'>$lastpage</a></li>";
      } else {
        $pagination.= "<li><a href='/page/1'>1</a></li>";
        $pagination.= "<li><a href='/page/2'>2</a></li>";
        $pagination.= "<li class='disabled'><a href='#'>...</a></li>";
          for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
            if ($counter == $page)
              $pagination.= "<li class='active'><a href='#'>$counter</a></li>";
            else
              $pagination.= "<li><a href='/page/$counter'>$counter</a></li>";
          }
      }
    }
             
    if ($page < $counter - 1) { 
      $pagination.= "<li><a href='/page/$next'>Siguiente</a></li>";
      $pagination.= "<li><a href='/page/$lastpage'>Ultima</a></li>";
    } else {
      $pagination.= "<li class='disabled'><a href='#'>Siguiente</a></li>";
      $pagination.= "<li class='disabled'><a href='#'>Ultima</a></li>";
    }
    $pagination.= "</ul>";
  }
  return $pagination;
}

?>