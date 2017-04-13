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
      <a id="charts" href="<?php echo base_url() ?>Gissat_mty/chart_desing_view" class="btn-floating halfway-fab waves-effect waves-light red" style="margin-top: 15px;" title='Graficar'>
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
        <table class="bordered centered striped" style="font-size: 13px;">
          <thead>
          <tr>
            <th colspan="17" class="center-align tablehead-1" style="font-size: 14px;">CENTRAL <?php echo $central ?> - CIRCUITO <?php echo $circuito ?></th>
          </tr>
            <tr>
              <td class="center-align tablehead-2" style="background-color: rgba(0, 255, 255, 0.39);">Fecha</td>
              <td class="center-align tablehead-2" style="background-color: rgba(0, 255, 255, 0.39);">Hora</td>
              <td class="center-align tablehead-2" style="background-color: rgba(0, 255, 255, 0.39);">Gasto<br>Suministrado<br>(L/s)</td>
              <td class="center-align tablehead-2" style="background-color: rgba(0, 255, 255, 0.39);">Volumen<br>Suministrado<br>(m3)</td>
              <td class="center-align tablehead-2" style="background-color: rgba(0, 255, 255, 0.39);">Presión<br>(mca)</td>
              <td class="center-align tablehead-2" style="background-color: rgba(0, 255, 255, 0.39);">Presión<br>(Kg/cm2)</td>
              <td class="center-align tablehead-2" style="background-color: rgba(0, 255, 255, 0.39);">Caudal de <br>Salida<br>(L/s)</td>
              <td class="center-align tablehead-2" style="background-color: rgba(0, 255, 255, 0.39);">Volumen de<br>agua de salida<br>(m3)</td>
              <td class="center-align tablehead-2" style="background-color: rgba(175, 11, 11, 0.31);">Q pérdidas<br>(L/s)</td>
              <td class="center-align tablehead-2" style="background-color: rgba(175, 11, 11, 0.31);">Volumen pérdidas<br>(m3)</td>
              <td class="center-align tablehead-2" style="background-color: rgba(175, 11, 11, 0.31);">Q consumo <br>Usuarios<br>(L/s)</td>
            </tr>
            <tr>
             
            </tr>
          </thead>
          <tbody>
            <?php $a=0; foreach ($info as $item): $a++; ?>
              <tr>
                <td class="center-align tablecontent"> <?php echo $item['fecha_op']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['hora']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['gasto_suministrado']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['volumen_suministrado']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['presion_mca']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['presion_kg']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['caudal_salida']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['volumen_salida']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['perdidas']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['volumen_perdidas']; ?></td>
                <td class="center-align tablecontent"> <?php echo $item['consumo_usuario']; ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>

      <div id="extra" class="modal modal-fixed-footer" style="max-height:40%; width: 35% ">
        <div class="modal-content">
          <p class="tituloOpc">Carga de datos CSV</p>
          <p>Seleccione el archivo</p>
            <form id="tbCuentas" action="<?php echo base_url() ?>Gissat_mty/load_CSVinfo"  enctype="multipart/form-data" method="post" style="">
            <div class="file-field input-field col s6">
              <div class="btn">
                <span>File</span>
                <input type="file" accept=".csv" name="archivo">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
            <div class="col s1" style="margin-top: 20px">
              <input name="MAX_FILE_SIZE" type="hidden" value="20000"/> 
              <input class="btn waves-effect" name="enviar" type="submit" value="Cargar datos"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" id="cancelar" style="color:red;">Cancelar</a> 
        </div>
      </div>

      <div id="parametros" class="modal" style="max-height:40%; width:35%;">
        <div class="modal-content">
          <p class="tituloOpc">Ingrese el siguiente dato</p>
          <p>El sistema ha detectado la falta de información en el campo de "presión". A continuación puede ingresar un valor y este afectara a todos los campos de la columna "presión"</p>
          <form method="post" action="<?php echo base_url()?>edit_controller/update_allPresion">
          <input type="text" name="id_sub" id="id_sub" style="display: none;" value="<?php echo $id_distrito; ?>">
            <div class="input-field col s12">
              <input placeholder="Presión (mca)" type="number" step="any" class="validate" id="presion_ind" name="presion_ind" required>
              <label for="presion_ind">Presión</label>
            </div>
            <button style="margin-right: 5px;" type="submit" class="btn waves-effect">Aceptar
              <i class="material-icons left">send</i>
            </button>
            <button style="background-color: rgba(146, 3, 3, 0.79);" class="btn waves-effect modal-action modal-close"> Cancelar
              <i class="material-icons right">cancel</i>
            </button>
          </form>
        </div>
      </div>

      <!-- Eficiencia electromecanica -->
      <div id="test2" class="col s12">
        
      </div>

      <!-- Calculo de ahorro -->
      <div id="test3" class="col s12">
        
        </table>
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
    alert('".$missing_data."');
    parpadeo();
    show_updatePresion();
    alert('La falta de información provoca resultados poco fiables');
    </script>";
  }
?>
