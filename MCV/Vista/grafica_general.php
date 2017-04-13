<?php 
include "components/navBar.php";
$obj = new navBar;
$correcto = $this->session->flashdata('correcto');
  if ($correcto) {
    echo 
    "<script>
    alert('".$correcto."');
    </script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Mapas</title>
  <!-- CSS  -->
  <Link rel = "stylesheet" type = "text / css" href = "../js/jChartFX/styles/Attributes/jchartfx.attributes.css" />
  <Link rel = "stylesheet" type = "text / css" href = "../js/jChartFX/styles/Attributes/jchartfx.palette.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php include "components/styles.html";?>

</head>
<body onload="">

<?php include "components/menuSecundario.html"; ?>

<?php $obj->menu() ?>

<!--  COntenido de la pagina-->
<div class="row"><!-- Start ROW-->
  <div class="col s1"> <!--Start Div3 -->
  </div><!--END  Div3-->
    

  <div class="col s10">
    <nav style="height: 30px;">
      <div class="nav-wrapper" style="background-color: #1de9b6; margin-top: 10px;">
        <div class="col s12" style="line-height: 30px">
          <a href="" class="breadcrumb text-nav-explorer" style="color:black;">Home</a>
          <a href="" class="breadcrumb text-nav-explorer" style="color:black;">Zonas de influencia</a>
          <a href="#!" class="breadcrumb text-nav-explorer" id="sustitución" style="color:black;">Detalles</a>
        </div>
      </div>
    </nav>
  
    <!--INICIO DE LAS PESTAÑAS -->
    <div class="row">
      
      <!--Caracteristicas -->
      <div id="test1" class="col s12">
      <a id="useradd" href="#extra" class="modal-action modal-close modal-trigger btn-floating halfway-fab waves-effect waves-light red" style="margin-top: 15px;" title='Carga CSV'>
        <i class="material-icons">import_export</i>
      </a>
      <a id="charts" class="btn-floating halfway-fab waves-effect waves-light red" style="margin-top: 15px;" title='Graficar'>
        <i class="material-icons">equalizer</i>
      </a>
      <a id="operation" class="btn-floating halfway-fab waves-effect waves-light red" style="margin-top: 15px;" title='Calculo'>
        <i class="material-icons">functions</i>  
      </a>
      <a id="return_map" class="btn-floating halfway-fab waves-effect waves-light red" style="margin-top: 15px;" title='Mapa'>
        <i class="material-icons">map</i>  
      </a>
      <a id="view_update_presion" href="#parametros" class="modal-action modal-close modal-trigger btn-floating halfway-fab waves-effect waves-light red right" style="margin-top: 15px; display: none;" title='Faltan datos en la presión'>
        <i class="material-icons">warning</i>
      </a>
        <table class="highchart bordered centered striped" data-graph-container-before="1" data-graph-type="line" style="font-size: 13px;">
          <thead>
            <tr>
              <th class="tablehead-2 center-align">Hora</th>
              <th class="tablehead-2 center-align">Caudal suministrado</th>
              <th class="tablehead-2 center-align">Caudal pérdidas</th>
              <th class="tablehead-2 center-align">Caudal consumo</th>
              <th class="tablehead-2 center-align">Presión</th>
            </tr>
          </thead>
          <tbody>
            <?php $a=0; foreach ($info as $item): $a++ ?>
              <tr>
                <td class="center-align tablecontent"><?php echo $item['hora']; ?></td>
                <td class="center-align tablecontent"><?php echo $item['gasto_suministrado']; ?></td>
                <td class="center-align tablecontent"><?php echo $item['volumen_perdidas']; ?></td>
                <td class="center-align tablecontent"><?php echo number_format($item['consumo_usuario'], 2, '.', ''); ?></td>
                <td class="center-align tablecontent"><?php echo number_format($item['presion_kg'], 2, '.', ''); ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

      </div>

      <!-- Eficiencia electromecanica -->
      <div id="test2" class="col s12">
        
      </div>

      <!-- Calculo de ahorro -->
      <div id="test3" class="col s12">
        
      </div>
    </div>
    <!--FIN DE LAS PESTAÑAS -->
  </div>
</div><!-- END ROW-->

<!-- Fin del contenido-->
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/materialize.min.js"></script>
  <script src="../js/Flotr2/flotr2.min.js"></script>
  <script src="../js/charts/graficastest.js"></script>
  <script src="../js/funciones.js"></script>
  <script src="../js/jqueryTreetable/jquery.treetable.js"></script>
  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="http://code.highcharttable.org/master/jquery.highchartTable-min.js"></script> 

  <script>
   $(document).ready(function() {
      $('table.highchart').highchartTable();
    });

    //$(document).ready(parpadeo);
      function parpadeo(){ $('#view_update_presion').fadeIn(500).delay(400).fadeOut(500, parpadeo); }

   function show_updatePresion(){
      $('#view_update_presion').css("display", "none");
      parpadeo();
   }
  </script>

  </body>
</html>

<?php 
$missing_data = $this->session->flashdata('missing_data');
  if ($missing_data) {
    echo 
    "<script>
    alert('".$missin_data."');
    parpadeo();
    show_updatePresion();
    alert('La falta de información provoca resultados poco fiables');
    </script>";
  }
?>
