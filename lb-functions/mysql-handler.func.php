<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

  /**********************************************************************
  *  Author: Justin Vincent (jv@jvmultimedia.com)
  *  Web...: http://twitter.com/justinvincent
  *  Name..: ezSQL_mysql
  *  Desc..: mySQL component (part of ezSQL databse abstraction library)
  *
  */

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Almacenamos errores
$MySQL_mysql_str = array (
	1 => 'Se requiere $dbuser y $dbpassword para conectar a la base de datos',
	2 => 'Error al establecer una conexion a la base de datos. Usuario/Password incorrectos?',
	3 => 'Se requiere $dbname a elegir para conectar a la base de datos',
	4 => 'La conexion a la base de datos no esta activa',
	5 => 'Error inesperado al intentar conectar a la base de datos'
);

// Especificamos clases
if (!function_exists ('mysql_connect')) die('<b>Error:</b> MySQLcore requere que la libreria MySQL este compilada e integrada en la configuracion de PHP');
if (!class_exists ('MySQLcore')) die('<b>Error:</b> MySQLcore requiere que el nucleo este incluido en el programa');

class MySQL_mysql extends MySQLcore {
  var $dbuser      = false;
  var $dbpassword  = false;
  var $dbname      = false;
  var $dbhost      = false;

  // Funcion de inicio
  function MySQL_mysql($dbuser='', $dbpassword='', $dbname='', $dbhost='localhost') {
   $this->dbuser      = $dbuser;
   $this->dbpassword  = $dbpassword;
   $this->dbname      = $dbname;
   $this->dbhost      = $dbhost;
  }

  // Conexion rapida
  function quick_connect($dbuser='', $dbpassword='', $dbname='', $dbhost='localhost') {
    $return_val = false;
    if (!$this->connect ($dbuser, $dbpassword, $dbhost,true));
    else if (!$this->select($dbname));
    else $return_val = true;
    return $return_val;
  }

  // Conectamos a la db
  function connect($dbuser='', $dbpassword='', $dbhost='localhost') {
    global $MySQL_mysql_str; $return_val = false;
    $this->timer_start('db_connect_time');
    if (!$dbuser) {
      $this->register_error($MySQL_mysql_str[1].' in '.__FILE__.' on line '.__LINE__);
      $this->show_errors ? trigger_error($MySQL_mysql_str[1],E_USER_WARNING) : null;
    } else if (!$this->dbh = @mysql_connect($dbhost,$dbuser,$dbpassword,true,131074)) {
      $this->register_error($MySQL_mysql_str[2].' in '.__FILE__.' on line '.__LINE__);
      $this->show_errors ? trigger_error($MySQL_mysql_str[2],E_USER_WARNING) : null;
    } else {
      $this->dbuser      = $dbuser;
      $this->dbpassword  = $dbpassword;
      $this->dbhost      = $dbhost;
      $return_val        = true;
    }
    return $return_val;
  }

  // Intentamos elegir una base de datos
  function select($dbname='') {
    global $MySQL_mysql_str; $return_val = false;
    if (!$dbname ) {
      $this->register_error($MySQL_mysql_str[3].' in '.__FILE__.' on line '.__LINE__);
      $this->show_errors ? trigger_error($MySQL_mysql_str[3],E_USER_WARNING) : null;
    } else if (!$this->dbh) {
        $this->register_error($MySQL_mysql_str[4].' in '.__FILE__.' on line '.__LINE__);
         $this->show_errors ? trigger_error($MySQL_mysql_str[4],E_USER_WARNING) : null;
    } else if (!@mysql_select_db($dbname,$this->dbh)) {
      if ( !$str = @mysql_error($this->dbh))
        $str = $MySQL_mysql_str[5];
        $this->register_error($str.' in '.__FILE__.' on line '.__LINE__);
        $this->show_errors ? trigger_error($str,E_USER_WARNING) : null;
      } else {
        $this->dbname  = $dbname;
        $return_val    = true;
      }
      return $return_val;
    }

    // Formateamos la solicitud por seguridad
    function escape($str) {
      if (!isset($this->dbh) || !$this->dbh) {
        $this->connect($this->dbuser, $this->dbpassword, $this->dbhost);
        $this->select($this->dbname);
      }
    return mysql_real_escape_string(stripslashes($str));
    }

    // Fecha del sistema
    function sysdate() {
      return 'NOW()';
    }

    // Hacemos la llamada a sql
    function query($query) {
    // This keeps the connection alive for very long running scripts
    if ( $this->num_queries >= 500 ) {
      $this->disconnect();
      $this->quick_connect($this->dbuser,$this->dbpassword,$this->dbname,$this->dbhost);
    }
    $return_val = 0;
    $this->flush();
    $query = trim($query);
    $this->func_call = "\$db->query(\"$query\")";
    $this->last_query = $query;
    $this->num_queries++;
    $this->timer_start($this->num_queries);
    if ($cache = $this->get_cache($query)) {
      $this->timer_update_global($this->num_queries);
      if ($this->use_trace_log) {
        $this->trace_log[] = $this->debug(false);
      }
      return $cache;
    }
    if (!isset($this->dbh) || !$this->dbh) {
      $this->connect($this->dbuser, $this->dbpassword, $this->dbhost);
      $this->select($this->dbname);
    }
    $this->result = @mysql_query($query,$this->dbh);
    if ($str = @mysql_error($this->dbh)) {
      $is_insert = true;
      $this->register_error($str);
      $this->show_errors ? trigger_error($str,E_USER_WARNING) : null;
      return false;
    }
    $is_insert = false;
    if (preg_match("/^(insert|delete|update|replace|truncate|drop|create|alter)\s+/i",$query)) {
      $this->rows_affected = @mysql_affected_rows($this->dbh);
      if (preg_match("/^(insert|replace)\s+/i",$query)) {
        $this->insert_id = @mysql_insert_id($this->dbh);
      }
      $return_val = $this->rows_affected;
    } else {
      $i=0;
      while ($i < @mysql_num_fields($this->result)) {
        $this->col_info[$i] = @mysql_fetch_field($this->result);
        $i++;
      }
      $num_rows=0;
      while ($row = @mysql_fetch_object($this->result)) {
        $this->last_result[$num_rows] = $row;
        $num_rows++;
      }
      @mysql_free_result($this->result);
      $this->num_rows = $num_rows;
      $return_val = $this->num_rows;
    }
    $this->store_cache($query,$is_insert);
    $this->trace || $this->debug_all ? $this->debug() : null ;
    $this->timer_update_global($this->num_queries);
    if ($this->use_trace_log) {
      $this->trace_log[] = $this->debug(false);
    }
    return $return_val;
  }

  // Desconectamos de la db
  function disconnect() {
    @mysql_close($this->dbh);
  }
}

// Conectamos a la db y fijamos utf como charset
$db = new MySQL_mysql($db_user,$db_pass,$db_daba,$db_host);
$db->query("SET NAMES 'utf8'");

?>