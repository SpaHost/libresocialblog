<?php

//

// Libre Social Blog / 2013

// Autor       : Lorenzo J Gonzalez

// Web         : http://www.spahost.es

// Email       : soporte@spahost.es

//



// Definicion de seguridad

if(!defined('lsb_')) die('No esta permitido acceder a esta pagina.');



echo '

  <div class="page-header">

          <h1>Dashboard</h1>

        </div>';



















      

$page_loc = $_REQUEST[post];

if ($page_loc) {



      } else {



echo '

      <form action="?p=news&post=1" method="post">

        <legend>Postear Noticia</legend>

        <label>Titulo</label>

        <input type="text" name="title" placeholder="Titulo"><br><br>

        <label>Portada</label>

        <textarea class="textarea-post span8" name="news" id="news" placeholder="Portada" style="color: rgb(0, 0, 0); cursor: auto; text-decoration: initial; text-rendering: auto; word-break: normal; word-wrap: break-word; word-spacing: 0px; width: 726px; height: 300px"></textarea><br><br>

        <label>Extendido</label>

        <textarea class="textarea-extend span8" name="news_extend" id="news_extend" placeholder="Noticia extendida" style="color: rgb(0, 0, 0); cursor: auto; text-decoration: initial; text-rendering: auto; word-break: normal; word-wrap: break-word; word-spacing: 0px; width: 726px; height: 300px"></textarea><br><br>



          <label class="control-label" for="input01">Programar Noticia</label>

          <div class="controls date form-inline" data-date-format="dd-mm-yyyy">

            <input type="text" class="span2" value="'.date("d-m-Y").'" name="date" id="dp1">

            <span class="help-inline">Hora</span>

              <select class="span1" name="hour">';



genformhora('24', 'H');





echo '

              </select>

              <select class="span1" name="min">';



genformhora('60', 'i');



echo '

            </select>

            <span class="help-inline">*</span>

          </div><br>

   



      







        <select class="span3" name="category">';



  $log_comp = mysql_query("SELECT * FROM lb_cat WHERE sub_id IS NULL ORDER BY id");

  while ($row = mysql_fetch_assoc($log_comp)) {

    echo '<option value="'.$row["id"].'">'.$row["title"].'</option>';



    $sec_log_comp = mysql_query("SELECT * FROM lb_cat WHERE sub_id = $row[id] ORDER BY id");

    while ($rowa = mysql_fetch_assoc($sec_log_comp)) {

      echo '<option value="'.$rowa["id"].'"> -- '.$rowa["title"].'</option>';



      $ter_log_comp = mysql_query("SELECT * FROM lb_cat WHERE sub_id = $rowa[id] ORDER BY id");

      while ($rowe = mysql_fetch_assoc($ter_log_comp)) {

        echo '<option value="'.$rowe["id"].'"> ---- '.$rowe["title"].'</option>';



        $tir_log_comp = mysql_query("SELECT * FROM lb_cat WHERE sub_id = $rowe[id] ORDER BY id");

        while ($rowi = mysql_fetch_assoc($tir_log_comp)) {

          echo '<option value="'.$rowi["id"].'"> ---- '.$rowi["title"].'</option>';



          $tor_log_comp = mysql_query("SELECT * FROM lb_cat WHERE sub_id = $rowi[id] ORDER BY id");

          while ($rowo = mysql_fetch_assoc($tor_log_comp)) {

            echo '<option value="'.$rowo["id"].'"> ---- '.$rowo["title"].'</option>';



            $tur_log_comp = mysql_query("SELECT * FROM lb_cat WHERE sub_id = $rowo[id] ORDER BY id");

            while ($rowu = mysql_fetch_assoc($tur_log_comp)) {

              echo '<option value="'.$rowu["id"].'"> ---- '.$rowu["title"].'</option>';

            }

          }

        }

      }

    }

  }



      echo '  

        </select>

          <br><br>

        <button type="submit" name="submit" id="editar_auth" value="editar_auth" class="btn btn-info">Publicar</button>

        <button type="reset" class="btn">Cancelar</button>

      </form>';

  }





  if ($_POST['submit']=='editar_auth') {

    $data1       = $_POST['title'];

    $data2       = '<p>'.$_POST['news'].'</p>';

    $data3       = '<p>'.$_POST['news_extend'].'</p>';

    $data5       = $_POST['category'];

  

  $timestamp = strtotime($_POST['date'].' '.$_POST['hour'].':'.$_POST['min'].':00 +0200');



    echo $data1.'<br>';

    echo $data2.'<br>';

    echo $data3.'<br>';

    echo $data4.'<br>';

    echo $data5.'<br>';

    echo $timestamp.'<br>';



if ($data3 == '<p></p>') {

  $data3 = '';

}
  if ($_POST['title']){

    $ttdia = date('d', $timestamp);
    $ttmes = date('m', $timestamp);
    $ttano = date('Y', $timestamp);

    $db->query("INSERT INTO lb_news SET title='$data1', news='$data2', news_extend='$data3', author='$usuario_id', category='$data5', oday='$ttdia', omonth='$ttmes', oyear='$ttano', ttime='$timestamp' ");
  }

  }



?>
    </div>
    <div class="span4">
      sadfas
    </div>
  </div>
    <hr class="headhr">
    <div class="row">
      <footer>
        <p class="footer">Scripted By <a href="http://www.spahost.es/" target="_Blank">Spahost</a>. Libre Social Blog W.I.P <a href="https://github.com/SpaHost/libresocialblog" target="_Blank">v0.1</a></p>
      </footer>
    </div>
  </div>
</body>
  <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
  <![endif]-->
<script src="/lb-template/default/js/wysihtml5-0.3.0.js"></script>
<script src="/lb-template/default/js/jquery.js"></script>
<script src="/lb-template/default/js/prettify.js"></script>
<script src="/lb-template/default/js/bootstrap.min.js"></script>
<script src="/lb-template/default/js/bootstrap-datepicker.js"></script>
<script src="/lb-template/default/js/wysihtml5.js"></script>
<script src="/lb-template/default/js/wysihtml5-es.js"></script>
<script>
  $('.textarea-post').wysihtml5({
  'font-styles': true, //Font styling, e.g. h1, h2, etc. Default true
  'emphasis': true, //Italics, bold, etc. Default true
  'lists': true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
  'html': true, //Button which allows you to edit the generated HTML. Default false
  'link': true, //Button to insert a link. Default true
  'image': true, //Button to insert an image. Default true,
  'color': true //Button to change color of font
  });

  $('.textarea-extend').wysihtml5({
  'font-styles': true, //Font styling, e.g. h1, h2, etc. Default true
  'emphasis': true, //Italics, bold, etc. Default true
  'lists': true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
  'html': true, //Button which allows you to edit the generated HTML. Default false
  'link': true, //Button to insert a link. Default true
  'image': true, //Button to insert an image. Default true,
  'color': true //Button to change color of font
  });</script>
<script type="text/javascript" charset="utf-8">
  $(prettyPrint);
</script>
</html>