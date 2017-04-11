<?php 
include "components/navBar.php";
$obj = new navBar;
$correcto = $this->session->flashdata('correcto');
    if ($correcto) 
    {
      echo "<script>alert('".$correcto."');</script>";
    }
$actualizado = $this->session->flashdata('actualizado');
    if ($actualizado) 
    {
      echo "<script>alert('".$actualizado."');</script>";
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Mapa</title>
  <!-- CSS  -->
<?php include "components/styles.html";?>
</head>
<body>
<?php 
  $user_type = $this->session->userdata('tipo');
  if(strcmp($user_type,'Admin')==0){
    include "components/menuSecundario.html"; 
  }
?>
<?php $obj->map() ?>

<!--  COntenido de la pagina-->
<div class="row"><!-- Start ROW-->
  <div class="col s3"> <!--Start Div3 -->

    <nav style="height: 30px;">
      <div class="nav-wrapper teal accent-3" style="margin-top: 10px;">
        <form>
          <div class="input-field">
            <input id="search" type="search" required="">
            <label for="search" class=""><i style="line-height: 30px;" class="material-icons">search</i></label>
            <i style="line-height: 30px;" class="material-icons">close</i>
          </div>
        </form>
      </div>
    </nav>

<!-- Start OVERFLOW-->
    <div class="overflow"> 
      <ul class="collapsible" data-collapsible="expandable">
        <li>
        <!--Cabecera ZONAS DE INFLUENCIA -->
          <div class="collapsible-header">
            <p class="format">
              <input name="zonas" type="checkbox" id="zonas" data-seccion="zona">
              <label for="zonas" style="top: 7px;">Zonas de influencia</label>
              <i class="material-icons" style="margin-right: 0px;"><img src="../img/system/sectores.png" class="img-general"></i>
            </p>
          </div>
          <!--FIN Cabecera ZONAS INFLUENCIA -->
          <!--START Zonas de Influencia -->
          <div class="collapsible-body filas" style="margin-left: 10px;">
            <ul class="collapsible" data-collapsible="expandable">
              <?php
              foreach ($sector as $sec) { //Inicio primer ciclo, Sectores
                ?> <li><?php
                echo "
                  <div class='collapsible-header'>
                    <p class='format'>
                      <input name=".$sec['nombre_sector']." class='zonas' type='checkbox' data-seccion='sector' id=".$sec['nombre_sector']." data-id=".$sec['id_sector']." \">
                      <label for=".$sec['nombre_sector']." style='top: 7px;'>".str_replace("_", " ", $sec['nombre_sector'])."</label>
                      <i class='material-icons' style='margin-right: 0px;'><img src='../img/system/subsector.png' class='img-general'></i>
                    </p>
                  </div>";
                ?> 
                <div class="collapsible-body" style="margin-left: 10px;">
                <ul class="collapsible" data-collapsible="expandable">
                <?php foreach ($subsector as $sub) {//Inicio segundo ciclo subsectores
                  ?> <li><?php
                  if(strcmp($sec['id_sector'], $sub['id_sector'])==0){
                    if(strcmp($sub['nombre_subsector'],'null')!=0){
                     echo "
                      <div class='collapsible-header'>
                        <p class='format'>
                          <input name=".$sub['nombre_subsector']." type='checkbox' class=".$sec['nombre_sector']." data-seccion='subsector' id=".$sub['nombre_subsector']." data-id=".$sub['id_subsector'].">
                          <label for=".$sub['nombre_subsector']." style='top: 7px;'>".str_replace("_", " ", $sub['nombre_subsector'])."</label>
                          <i class='material-icons' style='margin-right: 0px;'><img src='../img/system/subsectores.png' class='img-general'></i>
                        </p>
                      </div>"; 
                    }else{
                       echo "
                      <div  class='collapsible-header'>
                        <p  style='display:none' class='format'>
                          <input name=".$sub['nombre_sub']." type='checkbox' class=".$sec['nombre_sa']." data-seccion='subsector' id=".$sub['nombre_subsector']." data-id=".$sub['id_subsector'].">
                          <label for=".$sub['nombre_subsector']." style='top: 7px;'>".str_replace("_", " ", $sub['nombre_subsector'])."</label>
                          <i class='material-icons' style='margin-right: 0px;'><img src='../img/system/subsectores.png' class='img-general'></i>
                        </p>
                      </div>"; 
                    }
                    
                    ?>
                    <?php
                  }
                  ?></li><?php
                }//FIN segundo ciclo subsectores
                ?></ul></div></li><?php
              }//FIN primer ciclo, Sectores
              ?>



            </ul>
          </div>
        </li>
        <!-- END Zonas de influencia-->

         <!--Infraestructura-->
        <li>
          <div class="collapsible-header">
          <p class="format">
            <input type="checkbox" name="infraestructura" id="infraestructura" onclick="">
            <label for="infraestructura" style="top: 7px;">Infraestructura</label>
            <i class="material-icons" style="margin-right: 0px;"><img src="../img/system/infraestructura.png" class="img-general"></i>
          </p>
          </div>

          <div class="collapsible-body">
          <ul class="collapsible" data-collapsible="expandable">
           <li>
            <div class="collapsible-header"> 
            <p class="format espDist">
              <input  name="pozo" class="infraestructura" type="checkbox" id="pozo" onclick="">
              <label style="top: 9px;" for="pozo" style="bottom: 4px">Pozos</label>
              <i class="material-icons " style="margin-right: 1px;"><img src="../img/system/pozo.png" class="img-general"></i>
            </p>
            </div>
            </li>
           <li>  
          <div class="collapsible-header">
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/tanque.png" class="img-general"></i>
              <input name="tanque" class="infraestructura" type="checkbox" id="tanque" onclick="recorrido_zona(this.id);">
              <label style="top: 9px;" for="tanque" style="bottom: 4px">Tanques</label>
            </p>

            </div>
             </li>
             
             <li> 
            <div class="collapsible-header">
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/bomba.png" class="img-general"></i>
              <input name="bomba" class="infraestructura" type="checkbox" id="bomba" onclick="recorrido_zona(this.id);">
              <label style="top: 9px;" for="bomba" style="bottom: 4px">Bombas</label>
            </p>
            </div>
             </li>
              <li>  
            <div class="collapsible-header">
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/valvula.png" class="img-general"></i>
              <input name="valvula" class="infraestructura" type="checkbox" id="valvula" onclick="recorrido_zona(this.id);">
              <label style="top: 9px;" for="valvula" style="bottom: 4px">Valvula</label>
            </p>
            </div>
             </li>
              <li>  
            <div class="collapsible-header">
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/usuarios.png" class="img-general"></i>
              <input name="usuarios" class="infraestructura" type="checkbox" id="usuarios" name="">
              <label style="top: 9px;" for="usuarios" style="bottom: 4px">Usuarios</label>
            </p>
            </div>
             </li> 
           </ul> 
          </div>

        </li>
        <!--FIN Infraestructura -->

        <!-- Parametros -->
        <li>
          <div class="collapsible-header">
          <p class="format">
            <input type="checkbox" name="" id="parametros">
            <label for="parametros" style="top: 7px;">Parametros</label>
            <i class="material-icons" style="margin-right: 0px;"><img src="../img/system/parametros.png" class="img-general"></i>
          </p>
          </div>

          <div class="collapsible-body">
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/caudall.png" class="img-general"></i>
              <input name="caudal" type="checkbox" id="caudal" name="">
              <label for="caudal" style="bottom: 4px">Caudal</label>
            </p>
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/presion.png" class="img-general"></i>
              <input name="presion" type="checkbox" id="presion" name="">
              <label for="presion" style="bottom: 4px">Presión</label>
            </p>
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/nivel.png" class="img-general"></i>
              <input name="nivel" type="checkbox" id="lv" name="">
              <label for="lv" style="bottom: 4px">Nivel</label>
            </p>
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/volumen.png" class="img-general"></i>
              <input name="volumen" type="checkbox" id="vol" name="">
              <label for="vol" style="bottom: 4px">Volumen</label>
            </p>
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/consumoagua.png" class="img-general"></i>
              <input name="c-agua" type="checkbox" id="agua" name="">
              <label for="agua" style="bottom: 4px">Consumo de agua</label>
            </p>
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/consumoenergetico.png" class="img-general"></i>
              <input name="c-energia" type="checkbox" id="energia" name="">
              <label for="energia" style="bottom: 4px">Consumo Energetico</label>
            </p>
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/fugass.png" class="img-general"></i>
              <input name="fugas" type="checkbox" id="fuga" name="">
              <label for="fuga" style="bottom: 4px">Fugas</label>
            </p>
            <p class="format espDist">
              <i class="material-icons" style="margin-right: 1px;"><img src="../img/system/perdidas.png" class="img-general"></i>
              <input name="perdidas" type="checkbox" id="perdida" name="">
              <label for="perdida" style="bottom: 4px">Perdidas</label>
            </p>
          </div>
        </li>
        <!-- FIN Parametros-->

      </ul>
    </div> 
  <!-- END OVERFLOW -->
      <div id="opcsp" class="center-align">
        <a href="#agre" class="modal-trigger disabled" title="Añadir" onclick="Materialize.toast('', 10000)" id="agregar">
          <i class="small material-icons" style="margin-right:10px;">add</i>
        </a>
        <a href="#!" title="Eliminar" disabled="true" id="eliminar"><i onclick="Materialize.toast('Toca el elemento en el mapa para eliminarlo', 10000);  borrarsel(); " class="small material-icons disabled" style="margin-right:10px;">delete</i></a>

        <a href="#!" title="Editar" id="Editar_elemento" ><i onclick="editarsel();  Materialize.toast('Toca el elemento en el mapa para editarlo', 10000);" class="small material-icons disabled" style="margin-right:10px;">mode_edit</i></a>
        <a href="#!" title="Listar" id="Listar"><i class="small material-icons disabled" style="margin-right:10px;">view_list</i></a>
        
      </div>

      <div class="center-align" style="display: none" id="opcspoli">
       <a href="#aceptar1" class="modal-trigger" title="Añadir"  id="aceptarpoly">
          <i class="small material-icons" style="margin-right:10px;">done</i>
        </a>
        <a href="#!" title="Borrar ultimo" id="Borrar ultimo" onclick="BorrarUltimo(path,markers)"><i class="small material-icons" style="margin-right:10px;">delete</i></a>
        <a href="#cancelar1" title="Cancelar Polígono" id="Cancelar Polígono" class="modal-trigger"><i class="small material-icons" style="margin-right:10px;">cancelar</i></a> 
 
      </div>

    </div><!--END  Div3-->
    

  <div class="col s9">
    <div class="google-maps map" id="map"></div>
  </div>
</div><!-- END ROW-->

<!-- Modal -->
<div id="agre" class="modal modal-fixed-footer" style="max-height:40%; width: 35% ">
  <div class="modal-content">
    <p class="tituloOpc">Seleccione el elemento a insertar</p>
    <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Zonas de influencia</a>
    <ul id='dropdown1' class='dropdown-content'>
    <li>
      <p class="opcRadio">
      <input type="radio" name="grupo" id="Sector-r">
      <label for="Sector-r">Sector</label>
      </p>
    </li>
    <li>
      <p class="opcRadio">
      <input type="radio" name="grupo" id="Subsector-r">
      <label for="Subsector-r">Subsector</label>
      </p>
    </li>
    <li>
      <p class="opcRadio">
      <input type="radio" name="grupo" id="Distrito-r">
      <label for="Distrito-r">Distrito</label>
      </p>
    </li>
  </ul>
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Pozo-r">
      <label for="Pozo-r">Pozo</label>
    </p>
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Tanque-r">
      <label for="Tanque-r">Tanque</label>
    </p>
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Bombeo-r">
      <label for="Bombeo-r">Bomba</label>
    </p>
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Valvula-r">
      <label for="Valvula-r">Valvula</label>
    </p>
   <!-- Pendiente de recolocacion
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Arrancador-r">
      <label for="Arrancador-r">Arrancador</label>
    </p>
     <p class="opcRadio">
      <input type="radio" name="grupo" id="Bomba-r">
      <label for="Bomba-r">Bomba</label>
    </p>
     <p class="opcRadio">
      <input type="radio" name="grupo" id="Capacitores-r">
      <label for="Capacitores-r">Capacitores</label>
    </p>
     <p class="opcRadio">
      <input type="radio" name="grupo" id="ConductorElectrico-r">
      <label for="ConductorElectrico-r">Conductor Eléctrico</label>
    </p>
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Bombeo-r">
      <label for="Bombeo-r">Bombeo</label>
    </p>
     -->
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat cancel"  style="color:red;">Cancelar</a>
    <a href="#!"onclick="loadmapOptions('grupo');" class="modal-action modal-close waves-effect waves-green btn-flat" style="color:blue;">Aceptar</a>
  </div>
</div>
<!--End Modal -->

<!--opcion Extra -->
<div id="extra" class="modal modal-fixed-footer" style="max-height:40%; width: 35% ">
  <div class="modal-content">
    <p class="tituloOpc">Antes de continuar.</p>
    <p>¿Cuenta con las coordenadas del elemento a insertar?</p>
  </div>
  <div class="modal-footer">
    <a href="#!" onclick="mostrarM()" class=" modal-action modal-close waves-effect waves-red btn-flat" id="cancelar" style="color:red;">No</a> 
     <a href="#!" onclick="abrirfpoli()" style="color:blue;" class="modal-action modal-close waves-effect waves-green btn-flat button-collapse">Si</a>
  </div>
</div>

<div id="aceptar1" class="modal modal-fixed-footer" style="max-height:40%; width: 35% ">
  <div class="modal-content">
    <p class="tituloOpc">Guardar</p>
    <p>¿Desea guardar el polígono actual?</p>
  </div>
  <div class="modal-footer">
    <a href="#!"  class=" modal-action modal-close waves-effect waves-red btn-flat" id="cancelar" style="color:red;">No</a>
     <a href="#!"  onclick="ocultarpanel1()" style="color:blue;" class="modal-action modal-close waves-effect waves-green btn-flat button-collapse"><input id="apoligono" value="" type="text" name="" style="display: none;">Si</a>
  </div>
</div>

<div id="cancelar1" class="modal modal-fixed-footer" style="max-height:40%; width: 35% ">
  <div class="modal-content">
    <p class="tituloOpc">Borrar</p>
    <p>¿Desea cancelar el polígono actual?</p>
  </div>
  <div class="modal-footer">
    <a href="#!"  class=" modal-action modal-close waves-effect waves-red btn-flat" id="cancelar" style="color:red;">No</a>
     <a href="#!" onclick="cancelpoly()" style="color:blue;" class="modal-action modal-close waves-effect waves-green btn-flat button-collapse">Si</a>
  </div>
</div>
<!--END opcion Extra -->
<a href="#aceptar2" class="modal-trigger" id="aceptarM" name="aceptarM"></a>
<div id="aceptar2" class="modal modal-fixed-footer" style="max-height:40%; width: 35% ">
  <div class="modal-content">
    <p class="tituloOpc">Guardar</p>
    <p>¿Desea guardar el elemento agregado al mapa?</p>
  </div>
  <div class="modal-footer">
  <a href="#!"  class=" modal-action modal-close waves-effect waves-red btn-flat" id="" onclick="CancelarM()" style="color:red;">Cancelar</a>
    <a href="#!"  class=" modal-action modal-close waves-effect waves-red btn-flat" id="cancelar" onclick="QuitarM()" style="color:red;">No</a> 
    <a href="#!"  onclick="aceptarM()" style="color:blue;" class="modal-action modal-close waves-effect waves-green btn-flat button-collapse"><input id="" value="" type="text" name="" style="display: none;">Si</a>
</div>
</div>


<!-- Section para CargarPolis-->
<div >
  <ul  id="" style="display:none;">
    <div>
      <?php
      $count=0;  
      foreach($subsector as $sub){
      $count=$count+1; 
      $coord='';
      $ban=0;  
      $s="Polis/".$sub['id_subsector'].$sub['nombre_subsector'].".txt";
      echo "".$s."";
      $fp = fopen($s, "r");
      while ($line = fgets($fp)) {
        if($ban==0){
         $coord=$line;
         $ban=1;
        }else
        $coord=$coord."\n".$line;
        
      }
      fclose($fp);
      ?>
      <input type="number" id="<?php echo 'subsectores'.$count; ?>" value="<?php echo $sub['id_subsector'];?>">
      <textarea linea1="<?php echo $sub['color_linea']; ?>" linea2="<?php echo $sub['color_fondo']; ?>" id="<?php echo 'sub'.$sub['id_subsector']; ?>" name="<?php echo $sub['nombre_subsector']; ?>" value=""><?php echo $coord; ?></textarea>
      <input type="text" id="<?php echo 'lsub'.$sub['id_subsector']; ?>" value="<?php echo $sub['color_linea']; ?>">
      <input type="text" id="<?php echo 'fsub'.$sub['id_subsector']; ?>" value="<?php echo $sub['color_fondo']; ?>">
      <?php
      }
      ?>
      <input type="number" id="sub" value="<?php echo $count; ?>">

      <button id="cargarpolismapa" onclick="mostrartodopolis()"></button>
    </div>
  </ul>
</div>
<!-- END  CargarPolis-->




<!-- Anuncios al usuario-->
<a  title="" onclick="Materialize.toast('Haga clic en el mapa para agregar elemento', 10000)" id="agregarM"></a>
<!-- END  Anuncios al usuario-->

<!-- Inicio de anclas para formularios-->
<a href="#extra" style="display: none" class="modal modal-action modal-close modal-trigger" id="irextra"></a>
<a href="#!" data-activates="create-tanque" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-tanque"></a>
<a href="#!" data-activates="create-arrancador" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-arrancador"></a>
<a href="#!" data-activates="create-bomba" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-bomba"></a>
<a href="#!" data-activates="create-capacitores" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-capacitores"></a>
<a href="#!" data-activates="create-conductorelectrico" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-conductorelectrico"></a>
<a href="#!" data-activates="create-bombeo" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-bombeo"></a>
<a href="#!" data-activates="create-valvula" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-valvula"></a>
<a href="#!" data-activates="create-pozo" style="display: none" class="modal-action modal-close button-collapse" id="abre-pozo"></a>
<a href="#!" data-activates="create-distrito" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-distrito"></a>
<a href="#!" data-activates="create-subsector" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-subsector"></a>
<a href="#!" data-activates="create-sector" style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-sector"></a>
<a href="#elimpoli" style="display: none" class="modal modal-action modal-trigger" id="irelimpoli"></a>
<a id="eliminarpoligono" href="#!" name="eliminarpoligono" style="display: none"></a>
<!-- END  anclas para formularios-->

<!-- Fin del contenido-->
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/funciones_map.js"></script>
  <script src="../js/materialize.min.js"></script>
  <script src="../js/jscolor-2.0.4/jscolor.min.js"></script>
<!-- MAP -->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9of83BBAodWNqORjW4ug9Jw6dXwQnV7M"></script>
   <script src="../js/API/map_mty.js"></script>
<!-- Script del mapa-->
  </body>
</html>


