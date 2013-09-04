<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Obtener informacion del sistema operativo
function get_os() {
  $userAgent = $_SERVER['HTTP_USER_AGENT'];
  $oses = array (
    'iPhone' => '(iPhone)',
    'Windows 3.11' => 'Win16',
    'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
    'Windows 98' => '(Windows 98)|(Win98)',
    'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
    'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
    'Windows 2003' => '(Windows NT 5.2)',
    'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
    'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
    'Windows 8' => '(Windows NT 6.2)|(Windows 8)',
    'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
    'Windows ME' => 'Windows ME',
    'Open BSD'=>'OpenBSD',
    'Sun OS'=>'SunOS',
    'Linux'=>'(Linux)|(X11)',
    'Safari' => '(Safari)',
    'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
    'QNX'=>'QNX',
    'BeOS'=>'BeOS',
    'OS/2'=>'OS/2',
    'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
  );

  foreach($oses as $os=>$pattern){
    if(eregi($pattern, $userAgent)) {
      return $os;
    }
  }
    return 'Desconocido';
}

// Obtener informacion del navegador web
function getBrowser() {
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  } else if (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  } else if (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  } else if(preg_match('/Firefox/i',$u_agent)) {
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  } else if(preg_match('/Chrome/i',$u_agent)) {
    $bname = 'Google Chrome';
    $ub = "Chrome";
  } else if(preg_match('/Safari/i',$u_agent)) {
    $bname = 'Apple Safari';
    $ub = "Safari";
  } else if(preg_match('/Opera/i',$u_agent)) {
    $bname = 'Opera';
    $ub = "Opera";
  } else if(preg_match('/Netscape/i',$u_agent)) {
    $bname = 'Netscape';
    $ub = "Netscape";
  }

  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) { }
  $i = count($matches['browser']);
  if ($i != 1) {
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)) {
      $version= $matches['version'][0];
    } else {
      $version= $matches['version'][1];
    }
  } else {
    $version= $matches['version'][0];
  }

  if ($version==null || $version=="") { 
    $version="?";
  }
  return array(
      'userAgent' => $u_agent,
      'name'      => $bname,
      'version'   => $version,
      'platform'  => $platform,
      'pattern'   => $pattern
  );
} 

// Obtenemos el explorador del usuario
$getbrowser = getBrowser();
$explorer = $getbrowser['name'].' '.$getbrowser['version'];

// Obtener localizacion del usuario
function get_location($ip, $get) {
  $default = '';
  if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
  $ip = '8.8.8.8';
  $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
  $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
  $ch = curl_init();

  $curl_opt = array(
    CURLOPT_FOLLOWLOCATION  => 1,
    CURLOPT_HEADER          => 0,
    CURLOPT_RETURNTRANSFER  => 1,
    CURLOPT_USERAGENT       => $curlopt_useragent,
    CURLOPT_URL             => $url,
    CURLOPT_TIMEOUT         => 1,
    CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
  );

  curl_setopt_array($ch, $curl_opt);
  $content = curl_exec($ch);

  if (!is_null($curl_info)) {
    $curl_info = curl_getinfo($ch);
  }

  curl_close($ch);

  if (preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs)) {
    $city = $regs[1];
  }
  if (preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs)) {
    $state = $regs[1];
  }
  if (preg_match('{<li>Country : ([^<]*) <img src}i', $content, $regs)) {
    $country = $regs[1];
  }

  if ($get == 'city') {
    if( $city!='' ){
      $location = $city;
      return $location;
    }
  } else if ($get == 'state') {
    if( $state!='' ){
      $location = $state;
      return $location;
    }
  } else if ($get == 'country') {
    if( $country!='' ){
      $location = $country;
      return $location;
    }
  } else {
    return $default;
  }
}

// Obtener pagina actual del usuario
function curPageURL() {
  $pageURL = 'http';
  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
    return $pageURL;
}

?>