<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

// Load Header
$load_head = $db->get_row("SELECT * FROM lb_config WHERE id='1'");

$lb_title        = $load_head->title;
$lb_subtitle     = $load_head->subtitle;
$lb_description  = $load_head->description;
$lb_author       = $load_head->author;
$lb_template     = $load_head->template;
$lb_lang         = $load_head->lang;
$lb_limit        = $load_head->limit_home;
$lb_limit_rss    = $load_head->limit_rss;

// Notice loader
if ($pag_pers == 'post'){
  if ($_REQUEST[oday]) {
    $title = str_replace("-", " ",$_REQUEST[coment]);
    $load_notice = $db->get_row("SELECT * FROM lb_news WHERE MATCH (title) AGAINST ('$title') AND oday = '$_REQUEST[oday]' AND omonth = '$_REQUEST[omonth]' AND oyear = '$_REQUEST[oyear]'");  
  } else {
    $load_notice = $db->get_row("SELECT * FROM lb_news WHERE id='$post_id'");
  }

  $params['content'] = $load_notice->news; //page content
  $params['content'] .= $load_notice->news_extend; //page content 
} else {
  $start_from = ($page-1) * $lb_limit;
  $load_notice = $db->get_results("SELECT * FROM lb_news ORDER BY id DESC LIMIT $start_from, $lb_limit");
  foreach ( $load_notice as $pload ) {
    $params['content'] .= $pload->news; //page content 
  }
}

// Fijamos longitud de las palabras
$params['min_word_length'] = 2;  //minimum length of single words
$params['min_word_occur']  = 1;  //minimum occur of single words

$params['min_2words_length']        = 4; //minimum length of words for 2 word phrases
$params['min_2words_phrase_length'] = 7; //minimum length of 2 word phrases
$params['min_2words_phrase_occur']  = 2; //minimum occur of 2 words phrase

$params['min_3words_length']        = 4; //minimum length of words for 3 word phrases
$params['min_3words_phrase_length'] = 7; //minimum length of 3 word phrases
$params['min_3words_phrase_occur']  = 4; //minimum occur of 3 words phrase

$keyword = new autokeyword($params, "UTF-8"); 

$lb_post_title   = $load_notice->title;
$lb_post_desc    = (str_replace("&nbsp", "",$keyword->get_keywords()));

?>