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
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand">',$lb_title,'</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="/">Inicio</a>
        </li>
      </ul>
    </nav>
  </div>
</header>
<div class="clearfix"></div>



  <div class="container classic">
    <div class="row">
      <div class="header">
        <div class="row">
 	        <div class="photo span2">
            <img src="/lb-template/',$template,'/img/profile/photo.jpg" alt="">
          </div>
          <div class="title">
            <h3>',$lb_title,'</h3>
            <i>',$lb_description,'</i>
          </div>
          <div class="social-links">
            <a href=""><img src="/lb-template/',$template,'/img/social-icons/twitter.png" alt=""></a>
            <a href=""><img src="/lb-template/',$template,'/img/social-icons/facebook.png" alt=""></a>
            <a href=""><img src="/lb-template/',$template,'/img/social-icons/youtube.png" alt=""></a>
          </div>
        </div>
      </div>
    </div>
    <hr class="headhr">
    <div class="row">
      <div class="col-md-8" style="padding-left:50px">';

/**
$fq = new fourSquare("OJIEL1NY5LQHAVBGTT43DOBUML2TQBJEKXDQFJE1XQ3GKVG2");  //fetching the checkins data

?>
<div id="foursquare" style="text-align:center">
    <h2>Last known location:</h2>
    <!--displaying the foursquare logo for the venue type-->
    <img src="<?php echo $fq->venueIcon ?>" />
    <!--displaying the venue name and the venue type-->
    <?php echo $fq->venueName ?> (<?php echo $fq->venueType ?>)<?php echo $fq->date ?><br/>
    <!-- displaying the venue address -->
    <?php echo $fq->venueAddress . ", " . $fq->venueCity . ", " . $fq->venueState . ", " . $fq->venueCountry ?><br/>
    <!--Displaying the map-->
    <img src="<?php echo $fq->getMapUrl(850, 300) ?>" /><br/>
    <!-- displaying the user comment-->
    <i><?php echo $fq->comment ?></i><br>
</div>
<?php

**/

if ($_REQUEST[p]=='demo') {

  $post = $db->get_row("SELECT * FROM lb_news WHERE id = '$_REQUEST[id]'");
  $db->query("UPDATE lb_news SET views = views + 1 WHERE id = '$_REQUEST[id]'"); 
  $url_title3 = ucfirst(strtolower(str_replace(" ", "-",$post->title)));
  $url_title2 = htmlentities($url_title3);
  $url_title  = srcc($url_title2);
  $cat = $db->get_row("SELECT * FROM lb_cat WHERE id='$post->category'"); 

  echo '<article class="row">
  <h2><a href="/post/'.$post->id.'/'.$url_title.'">'.$post->title.'</a><small><a href="" rel="tooltip" data-original-title="',$cat->description,'">',$cat->title,'</a></h2>
  '.$post->news.'
  <hr>
  <script type="text/javascript"><!--
  google_ad_client = "ca-pub-6544321746476830";
  /* 728x90 AccesoRoot */
  google_ad_slot = "7649762504";
  google_ad_width = 468;
  google_ad_height = 60;
  //-->
  </script>
  <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
  </script>
  <hr>
  '.$post->news_extend.'

  <div class="pie_post">

    <div class="reco pull-left">

      <h6>Escrito por '.$post->author.' <small>'.fecha($post->ttime).'</small></h6>

    </div>

    <div class="com pull-right">

      <h6>Articulo <b>'.$post->views.'</b> veces visto.</h6>

    </div>

  </div>

  </article> 

<div class="clearfix"></div>
<div class="publicidad">
  <script type="text/javascript"><!--
  google_ad_client = "ca-pub-6544321746476830";
  /* 728x90 AccesoRoot */
  google_ad_slot = "7649762504";
  google_ad_width = 468;
  google_ad_height = 60;
  //-->
  </script>
  <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
  </script>
</div>
<div id="disqus_thread"></div>';

} else if ($_REQUEST[p]=='post') {
  if ($_REQUEST[oday]) {
    $title = str_replace("-", " ",$_REQUEST[coment]);
    $post = $db->get_row("SELECT * FROM lb_news WHERE MATCH (title) AGAINST ('$title') AND oday = '$_REQUEST[oday]' AND omonth = '$_REQUEST[omonth]' AND oyear = '$_REQUEST[oyear]' AND ttime < $timestamp");  
  } else {
    $post = $db->get_row("SELECT * FROM lb_news WHERE id = '$_REQUEST[id]' AND ttime < $timestamp");
  }  

      
  $db->query("UPDATE lb_news SET views = views + 1 WHERE id = '$_REQUEST[id]'"); 
  $url_title3 = ucfirst(strtolower(str_replace(" ", "-",$post->title)));
  $url_title2 = htmlentities($url_title3);
  $url_title  = srcc($url_title2);
  $cat = $db->get_row("SELECT * FROM lb_cat WHERE id='$post->category'");
  $author = $db->get_row("SELECT * FROM lb_users WHERE id='$post->author'"); 

  echo '<article class="row">
  <h2><a href="/'.$post->oyear.'/'.$post->omonth.'/'.$post->oday.'/'.$url_title.'">'.$post->title.'</a><small><a href="" rel="tooltip" data-original-title="',$cat->description,'">',$cat->title,'</a></h2>
  '.$post->news.'
  <hr>
  <script type="text/javascript">
  <!--
  google_ad_client = "ca-pub-6544321746476830";
  /* 728x90 AccesoRoot */
  google_ad_slot = "7649762504";
  google_ad_width = 468;
  google_ad_height = 60;
  //-->
  </script>
  <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>

  <hr>
  '.$post->news_extend.'
  <div class="pie_post">
    <div class="reco pull-left">
      <h6>Escrito por ',$author->display_name,' <small>'.fecha($post->ttime).'</small></h6>
    </div>
    <div class="com pull-right">
      <h6>Articulo <b>'.$post->views.'</b> veces visto.</h6>
    </div>
  </div>
  </article>
<div class="publicidad">
  <script type="text/javascript"><!--
  google_ad_client = "ca-pub-6544321746476830";
  /* 728x90 AccesoRoot */
  google_ad_slot = "7649762504";
  google_ad_width = 468;
  google_ad_height = 60;
  //-->
  </script>
  <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
  </script>
</div>
 <div id="disqus_thread"></div>



    








';



} else if ($_REQUEST[p]=='page') {

  $start_from = ($page-1) * $lb_limit;
  $results = $db->get_results("SELECT * FROM lb_news WHERE ttime < $timestamp ORDER BY ttime DESC LIMIT $start_from, $lb_limit");

  foreach ($results as $new) {
  $author = $db->get_row("SELECT * FROM lb_users WHERE id='$new->author'");
  $url_title3 = ucfirst(strtolower(str_replace(" ", "-",$new->title)));
  $url_title2 = htmlentities($url_title3);
  $url_title  = srcc($url_title2);
  $cat = $db->get_row("SELECT * FROM lb_cat WHERE id='$new->category'"); 

  echo '<article class="row">
  <h2><a href="/'.$new->oyear.'/'.$new->omonth.'/'.$new->oday.'/'.$url_title.'.html">'.$new->title.'</a></h2>
  '.$new->news.'
  <hr>
  <div class="pie_post">
    <div class="reco pull-left">
      <h6>Escrito por ',$author->display_name,' <small>'.fecha($new->ttime).'</small></h6>
    </div>
    <div class="com pull-right">
       <h6><a href="/'.$new->oyear.'/'.$new->omonth.'/'.$new->oday.'/'.$url_title.'.html#disqus_thread">0</a></h6>
    </div>
  </div>
</article>
<div class="separador"></div>
';
  }





} else {

  $start_from = ($page-1) * $lb_limit;
  $results = $db->get_results("SELECT * FROM lb_news WHERE ttime < $timestamp ORDER BY ttime DESC LIMIT $start_from, $lb_limit");

  foreach ($results as $new) {

  $url_title3 = ucfirst(strtolower(str_replace(" ", "-",$new->title)));
  $url_title = srcc($url_title3);
  $cat = $db->get_row("SELECT * FROM lb_cat WHERE id='$new->category'");
  $author = $db->get_row("SELECT * FROM lb_users WHERE id='$new->author'"); 
  echo '<article class="row">
  <h2><a href="/'.$new->oyear.'/'.$new->omonth.'/'.$new->oday.'/'.$url_title.'.html">'.$new->title.'</a><small><a href="" rel="tooltip" data-original-title="',$cat->description,'">',$cat->title,'</a></small></h2>
  '.$new->news;

  if ($new->news_extend) {
    echo '
  <div class="continuale">
    <a href="/'.$new->oyear.'/'.$new->omonth.'/'.$new->oday.'/'.$url_title.'.html">Continuar Leyendo... &rarr;</a>
  </div>
  <div class="separador"></div>';
  }

echo '

<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1" addthis:url="http://www.accesoroot.es/post/'.$new->id.'/'.$url_title.'" addthis:title="'.$url_title.'"></a>
<a class="addthis_counter addthis_bubble_style" addthis:url="http://www.accesoroot.es/post/'.$new->id.'/'.$url_title.'" addthis:title="'.$url_title.'"></a>
<a class="addthis_button_preferred_2" addthis:url="http://www.accesoroot.es/post/'.$new->id.'/'.$url_title.'" addthis:title="'.$url_title.'"></a>
<a class="addthis_counter addthis_bubble_style" addthis:url="http://www.accesoroot.es/post/'.$new->id.'/'.$url_title.'" addthis:title="'.$url_title.'"></a>
<a class="addthis_button_preferred_3" addthis:url="http://www.accesoroot.es/post/'.$new->id.'/'.$url_title.'" addthis:title="'.$url_title.'"></a>
<a class="addthis_counter addthis_bubble_style" addthis:url="http://www.accesoroot.es/post/'.$new->id.'/'.$url_title.'" addthis:title="'.$url_title.'"></a>
<a class="addthis_button_preferred_4" addthis:url="http://www.accesoroot.es/post/'.$new->id.'/'.$url_title.'" addthis:title="'.$url_title.'"></a>
<a class="addthis_counter addthis_bubble_style" addthis:url="http://www.accesoroot.es/post/'.$new->id.'/'.$url_title.'" addthis:title="'.$url_title.'"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5156665f32370b77"></script>
<!-- AddThis Button END -->


  <div class="pie_post">
    <div class="reco pull-left">
      <h6>Escrito por ',$author->display_name,' <small>'.fecha($new->ttime).'</small></h6>
    </div>
    <div class="com pull-right">
   <a href="'.$new->oyear.'/'.$new->omonth.'/'.$new->oday.'/'.$url_title.'.html#disqus_thread">0 Comentarios</a>
    </div>
  </div>
</article>
<div class="separador"></div>

';



  }

}



// Paginacion



      $rs_result = $db->get_var("SELECT COUNT(id) FROM lb_news");

      $total_records = $rs_result;

      $total_pages = ceil($total_records / $lb_limit);



      echo pagination('lb_news', $lb_limit, $page);





echo '

    </div>

    <div class="col-md-3">


<div class="row">
<div class="span3" style="margin-left: 40px;">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="8ECSSKMAQDN46">
<input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
</div>


      <div class="row">

    <script type="text/javascript"><!--

google_ad_client = "ca-pub-6544321746476830";

/* Rectangulo AccesoRoot */

google_ad_slot = "9489214907";

google_ad_width = 336;

google_ad_height = 280;

//-->

</script>

<script type="text/javascript"

src="http://pagead2.googlesyndication.com/pagead/show_ads.js">

</script>

      </div>

      <div class="row">

        <legend>Categorias</legend>';





function category_list( $category_parent_id = 0 ) 

{ 



    // build our category list only once 

    static $cats; 



    if ( ! is_array( $cats ) ) 

    { 



        $sql  = 'SELECT * FROM `lb_cat`'; 

        $res  = mysql_query( $sql ); 

        $cats = array(); 

         

        while ( $cat = mysql_fetch_assoc( $res ) ) 

        { 

            $cats[] = $cat; 

        } 



    } 



    // populate a list items array 

    $list_items = array(); 



    foreach ( $cats as $cat ) 

    { 

      $url_title = ucfirst(strtolower(str_replace(" ", "-",$cat['title'])));

        // if not a match, move on 

        if ( ( int ) $cat['sub_id'] !== ( int ) $category_parent_id ) 

        { 

            continue; 

        } 



        // open the list item 

        $list_items[] = '<li>'; 



        // construct the category link 

        $list_items[] = '<a href="/category/'.$cat['id'].'/'.$url_title.'" rel="tooltip" data-original-title="'.$cat['description'].'">'; 

        $list_items[] = $cat['title']; 

        $list_items[] = '</a>'; 



        // recurse into the child list 

        $list_items[] = category_list( $cat['id'] ); 



        // close the list item 

        $list_items[] = '</li>'; 



    } 



    // convert to a string 

    $list_items = implode( '', $list_items ); 



    // if empty, no list items! 

    if ( '' == trim( $list_items ) ) 

    { 

        return ''; 

    } 



    // ...otherwise, return the list 

    return '<ul>' . $list_items . '</ul>'; 

}

echo category_list();

echo '
      </div>
      <div class="row">
        <legend>Ultimos comentarios</legend>
        <div id="recentcomments" class="dsq-widget"><script type="text/javascript" src="http://accesoroot.disqus.com/recent_comments_widget.js?num_items=6&hide_avatars=0&avatar_size=32&excerpt_length=200"></script>
        </div>
      </div>
    </div>
  </div>
    <hr class="headhr">
    <div class="row">
      <div class="span12">
      <footer>
        <p class="footer">Scripted By <a href="http://www.spahost.es/" target="_Blank">Spahost</a>. Libre Social Blog W.I.P <a href="https://github.com/SpaHost/libresocialblog" target="_Blank">',$ver_web,'</a></p>
      </footer>
    </div></div>
  </div>
</body>
  <!--[if lt IE 9]>
    <script src="/lb-template/',$lb_template,'/js/html5shiv.js"></script>
    <script src="/lb-template/',$lb_template,'/js/respond.min.js"></script>
  <![endif]-->
  <script src="/lb-template/',$lb_template,'/js/jquery.js"></script>
  <script src="/lb-template/',$lb_template,'/js/prettify.js"></script>
  <script src="/lb-template/',$lb_template,'/js/bootstrap.min.js"></script>';

if ($pag_pers === 'post') {

echo "
<script type=\"text/javascript\">
    var disqus_shortname = 'accesoroot'; // Required - Replace example with your forum shortname
    var disqus_identifier = '$post->id http://www.accesoroot.es/$post->oyear/$post->omonth/$post->oday/$url_title.html';
    var disqus_title = '$post->title';
    var disqus_url = 'http://www.accesoroot.es/$post->oyear/$post->omonth/$post->oday/$url_title.html#disqus_thread';
    var disqus_developer = 0; // or 1 based on if you\'re looking to skip URL authentication

    /* * * DON\'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>";

} else {

echo "
  <script type=\"text/javascript\">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'accesoroot'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>";
} 

?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39534373-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>