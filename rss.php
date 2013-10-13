<?php
header ("Content-type: text/xml");

header ("Content-type: text/xml");
define('_VALID_INCLUDE', TRUE);

$ispopup = "1";
$in_pm_popup = "1";
$isrss = "1";
include "nucleo.php";
defined('_VALID_CRINC') or die();

echo ("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<rss version=\"2.0\">");

?>
<channel>
<title><?echo "$sitename"?> - Noticias</title>
<?php

$result = mysql_query("SELECT * from ccms_news order by id desc limit 10");
while ($row = mysql_fetch_array ($result)) {

$strip1 = nl2br(strip_tags ("$row[prev_news]", ''));
$strip2 = str_replace("&nbsp;", " ", $strip1);
$strip3 = str_replace("&amp;", " ", $strip2);

$news_preview = str_replace("&nbsp;", " ", $strip3);

    echo ("<item>
	<title>$row[title]</title>
	<description>$news_preview</description>
	<link>http://www.weplay360.com/story-$row[id].html</link>
	<guid>http://www.weplay360.com/story-$row[id].html</guid>
</item>");
}

mysql_free_result($result);
?>
<link>http://www.weplay360.com/</link><description>Noticias</description></channel>
</rss>