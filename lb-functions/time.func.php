<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Convertimos la hora y minutos con un cero a la izquierda siempre
function convhoramin($valor, $n) {
   return str_pad((int) $valor, $n, "0", STR_PAD_LEFT);
}


// Sacar dias del mes
function getMonthDays($Month, $Year) {
  //Si la extensión que mencioné está instalada, usamos esa.
  if( is_callable("cal_days_in_month")) {
    return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
  } else {
    //Lo hacemos a mi manera.
    return date("d",mktime(0,0,0,$Month+1,0,$Year));
  }
}

// Sacar nombre del mes
function getmonth($num) {
  if ($num=="1") $current1="Enero";
  if ($num=="2") $current1="Febrero";
  if ($num=="3") $current1="Marzo";
  if ($num=="4") $current1="Abril";
  if ($num=="5") $current1="Mayo";
  if ($num=="6") $current1="Junio";
  if ($num=="7") $current1="Julio";
  if ($num=="8") $current1="Agosto";
  if ($num=="9") $current1="Septiembre";
  if ($num=="10") $current1="Octubre";
  if ($num=="11") $current1="Noviembre";
  if ($num=="12") $current1="Diciembre";
  $fecha = $current1;
  return $fecha;
}

// Sacar nombre de dia
function getdayname($num, $nom, $nam) {
  $date = $nam.'/'.$nom.'/'.$num;
  $ndai = date('l', strtotime($date));

  if ($ndai=="Monday") $current1="Lunes";
  if ($ndai=="Tuesday") $current1="Martes";
  if ($ndai=="Wednesday") $current1="Miercoles";
  if ($ndai=="Thursday") $current1="Jueves";
  if ($ndai=="Friday") $current1="Viernes";
  if ($ndai=="Saturday") $current1="Sabado";
  if ($ndai=="Sunday") $current1="Domingo";
  $nombredia = $current1;
  return $nombredia;
}

// Fecha actual en variables
$diahoy  = date("j");
$meshoy  = date("n");
$anohoy  = date("Y");
$mesante = date("F");

$fechatipo = date("d").'/'.date("m").'/'.date("Y");

// Variables para Home
  if ($_REQUEST['dia']) {
    $dia  = $_REQUEST['dia'];
  } else {
    $dia = $diahoy;
  }

  if ($_REQUEST['mes']) {
    $mes  = $_REQUEST['mes'];
  } else {
    $mes = $meshoy;
  }

  if ($_REQUEST['ano']) {
    $ano  = $_REQUEST['ano'];
  } else {
    $ano = $anohoy;
  }

// Año mas y menos
$anoant = $ano-1;
$anosig = $ano+1;

// Dias del mes actual
$dias = getMonthDays($mes, $ano);

// Tiempo actual en timestamp
$timestamp = time();

// Generador de numeros seguidos
function genformhora($max, $tipe){
  $i = 00;
  do {
  $num = convhoramin($i, 2);
  $date = date($tipe);
    if ($date == $num){
      echo '                <option value="'.$num.'" selected="selected">'.$num.'</option>
                ';
    } else {
      echo '                <option value="'.$num.'">'.$num.'</option>
                ';
    }
    continue;
  } while( ++$i < $max);
}

function connum($valor, $n) {
   return str_pad((int) $valor, $n, "0", STR_PAD_LEFT);
}

// Sacar nombre de dia
function fecha($timestamp) {
    $ndai = date('l', $timestamp);
    $del_dia = date('j', $timestamp);
    $del_mes = date('n', $timestamp);
    $del_ano = date('Y', $timestamp);

  if ($ndai=="Monday") $current1="Lunes";
  if ($ndai=="Tuesday") $current1="Martes";
  if ($ndai=="Wednesday") $current1="Miercoles";
  if ($ndai=="Thursday") $current1="Jueves";
  if ($ndai=="Friday") $current1="Viernes";
  if ($ndai=="Saturday") $current1="Sabado";
  if ($ndai=="Sunday") $current1="Domingo";
  $nombredia = $current1.' - '.connum($del_dia, 2).'/'.connum($del_mes, 2).'/'.connum($del_ano, 2);
  return $nombredia;
}

// Sacar nombre de dia
function fecharss($timestamp) {
    $darss = date('D, d M Y H:i:s', $timestamp);
  return $darss;
}

?>