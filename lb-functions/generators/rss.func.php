<?php
//
// Libre Social Blog / 2013
// Autor       : Lorenzo J Gonzalez
// Web         : http://www.spahost.es
// Email       : soporte@spahost.es
//

// Definicion de seguridad
if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');

header ("Content-type: text/xml; charset=UTF-8");

echo '<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" version="2.0">
  <channel>
    <title>',$lb_title,' - ',$lb_subtitle,'</title>
    <description>',$lb_title,' feed</description>
    <link>http://',$_SERVER["HTTP_HOST"],'/</link>
    <atom:link href="http://',$_SERVER["HTTP_HOST"],'/feed" rel="self" type="application/rss+xml" />
    <copyright>Copyright (C) 2013 ',$_SERVER["HTTP_HOST"],'</copyright>';

$results = $db->get_results("SELECT * FROM lb_news WHERE ttime < $timestamp ORDER BY id DESC LIMIT 0, $lb_limit_rss");
foreach ($results as $new) {
  $auth = $db->get_row("SELECT * FROM lb_users WHERE id='$new->author'");
  $cat = $db->get_row("SELECT * FROM lb_cat WHERE id='$new->category'");
  $url_title2 = ucfirst(strtolower(str_replace(" ", "-",$new->title)));
  $url_title = srcc($url_title2);

  $news3 = $new->news;
  $news2 = htmlspecialchars($news3, ENT_QUOTES, 'ISO-8859-1');
  $news = str_replace('?', '',$news2);

  echo '
    <item>
      <title>'.$new->title.'</title>
      <description>'.$news2.'</description>
      <author>noreply@accesoroot.es ('.$auth->display_name.')</author>
      <category>',$cat->title,'</category>
      <link>http://',$_SERVER["HTTP_HOST"],'/'.$new->oyear.'/'.$new->omonth.'/'.$new->oday.'/'.$url_title.'.html</link>
      <guid>http://',$_SERVER["HTTP_HOST"],'/'.$new->oyear.'/'.$new->omonth.'/'.$new->oday.'/'.$url_title.'.html</guid>
      <pubDate>'.fecharss($new->ttime).' GMT</pubDate>
    </item>';
  }

echo '
  </channel>
</rss>';

// Cerramos Generador
break;

?>