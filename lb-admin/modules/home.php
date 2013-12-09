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
  <div class="page-header">
          <h1>Dashboard</h1>
        </div>
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
    <script src="/lb-template/default/js/html5shiv.js"></script>
    <script src="/lb-template/default/js/respond.min.js"></script>
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