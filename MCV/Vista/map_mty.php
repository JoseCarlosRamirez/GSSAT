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
              <input name="zonas" type="checkbox" id="zonas" data-seccion="zona" onclick="checked_all(this.id); ">
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
                      <input name=".$sec['nombre_sa']." class='zonas' type='checkbox' data-seccion='sector' id=".$sec['nombre_sa']." data-id=".$sec['id_sa']." onclick=\"indetAction(this.id); select_sector(this.id,this.id); polihandler1(this.id);\">
                      <label for=".$sec['nombre_sa']." style='top: 7px;'>".str_replace("_", " ", $sec['nombre_sa'])."</label>
                      <i class='material-icons' style='margin-right: 0px;'><img src='../img/system/subsector.png' class='img-general'></i>
                    </p>
                  </div>";
                ?> 
                <div class="collapsible-body" style="margin-left: 10px;">
                <ul class="collapsible" data-collapsible="expandable">
                <?php foreach ($subsector as $sub) {//Inicio segundo ciclo subsectores
                  ?> <li><?php
                  if(strcmp($sec['id_sa'], $sub['id_sa_sub'])==0){
                    if(strcmp($sub['nombre_sub'],'null')!=0){
                     echo "
                      <div class='collapsible-header'>
                        <p class='format'>
                          <input name=".$sub['nombre_sub']." type='checkbox' class=".$sec['nombre_sa']." data-seccion='subsector' id=".$sub['nombre_sub']." data-id=".$sub['id_sub']." onclick=\" indetAction(this.id);select_random(this.id,this.id);  polihandler1(this.id);\">
                          <label for=".$sub['nombre_sub']." style='top: 7px;'>".str_replace("_", " ", $sub['nombre_sub'])."</label>
                          <i class='material-icons' style='margin-right: 0px;'><img src='../img/system/subsectores.png' class='img-general'></i>
                        </p>
                      </div>"; 
                    }else{
                       echo "
                      <div  class='collapsible-header'>
                        <p  style='display:none' class='format'>
                          <input name=".$sub['nombre_sub']." type='checkbox' class=".$sec['nombre_sa']." data-seccion='subsector' id=".$sub['nombre_sub']." data-id=".$sub['id_sub']." onclick=\" indetAction(this.id);select_random(this.id,this.id);  polihandler1(this.id);\">
                          <label for=".$sub['nombre_sub']." style='top: 7px;'>".str_replace("_", " ", $sub['nombre_sub'])."</label>
                          <i class='material-icons' style='margin-right: 0px;'><img src='../img/system/subsectores.png' class='img-general'></i>
                        </p>
                      </div>"; 
                    }
                    
                    ?>
                    <div class="collapsible-body" style="margin-left: 10px;">
                    <?php foreach ($distrito as $dis) { //INICIO tercer ciclo distritos
                      if (strcmp($sub['id_sub'], $dis['id_sub_dis'])==0){?>
                        <p class='format espDist'>
                          <input name='<?php echo $dis['nombre_dis']?>' type='checkbox' class="<?php echo $sub['nombre_sub']?>" data-seccion='distrito' id="<?php echo $dis['nombre_dis']?>" data-id='<?php echo $dis['id_dis']?>' onclick="indetAction(this.id); polihandler1(this.id);">
                          <label for="<?php echo $dis['nombre_dis']?>"><?php echo str_replace("_", " ", $dis['nombre_dis']);?></label>
                        </p>
                      <?php }
                    }//FIN tercer ciclo distritos
                    ?></div><?php
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
            <input type="checkbox" name="infraestructura" id="infraestructura" onclick="recorrido_zona(this.id);">
            <label for="infraestructura" style="top: 7px;">Infraestructura</label>
            <i class="material-icons" style="margin-right: 0px;"><img src="../img/system/infraestructura.png" class="img-general"></i>
          </p>
          </div>

          <div class="collapsible-body">
          <ul class="collapsible" data-collapsible="expandable">
           <li>
            <div class="collapsible-header"> 
            <p class="format espDist">
              <input  name="pozo" class="infraestructura" type="checkbox" id="pozo" onclick="recorrido_zona(this.id);">
              <label style="top: 9px;" for="pozo" style="bottom: 4px">Pozos</label>
              <i class="material-icons " style="margin-right: 1px;"><img src="../img/system/pozo.png" class="img-general"></i>
            </p>
            </div> 
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
        <a href="#agre" class="modal-trigger modal-close" title="Añadir" onclick="Materialize.toast('', 10000)" id="agregar">
          <i class="small material-icons" style="margin-right:10px;">add</i>
        </a>
        <a href="#!" title="Eliminar" id="eliminar"><i onclick="Materialize.toast('Toca el elemento en el mapa para eliminarlo', 10000);  borrarsel(); " class="small material-icons" style="margin-right:10px;">delete</i></a>

        <a href="#!" title="Editar" id="Editar_elemento" ><i onclick="editarsel();  Materialize.toast('Toca el elemento en el mapa para editarlo', 10000);" class="small material-icons" style="margin-right:10px;">mode_edit</i></a>
        <a href="<?php echo base_url() ?>Gissat_mty/map_mty_detalle" title="Listar" id="Listar"><i class="small material-icons" style="margin-right:10px;">view_list</i></a>
        
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
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Sector-r">
      <label for="Sector-r">Sector</label>
    </p>
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Subsector-r">
      <label for="Subsector-r">Subsector</label>
    </p>
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Distrito-r">
      <label for="Distrito-r">Distrito</label>
    </p>
    <p class="opcRadio">
      <input type="radio" name="grupo" id="Tuberia-r">
      <label for="Tuberia-r">Tuberia</label>
    </p>
<!-- Pendiente de recolocacion
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

<!-- Section to insert Distrito-->
<div>
<form id="fdis" method="post" name="fdis" action="<?php echo base_url()?>record_controller/registrar_dis">
  <ul id="create-distrito" class="side-nav" style="width: 420px;">
    <p id="titdis" class="tituloOpc">Formulario de Distritos</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="nombre_dis" name="nombre_dis" style="height: 25px;">
        <label for="temporal">Nombre del distrito</label> 
      </div>
    </div>
     <div class="row col s9" style="margin-bottom: 0px;">
      <label style="margin-left: 10px;">El distrito es parte de un</label>
      <select class="browser-default" id="id_per" name="id_per" >
        <option value="" disabled selected>Seleccione una opcion...</option>
        <option value="Sector">Sector</option>
        <option value="Subsector">Subsector</option>
      </select>
    </div>
    <div class="row col s9" style="display:none; margin-bottom: 0px;" id="idss">
      <label style="margin-left: 10px;">Subsector</label>
      <select class="browser-default" id="id_sub" name="id_sub">
        <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($subsector as $sub){ ?>
          <option value="<?php echo $sub['id_sub']; ?>"><?php echo $sub['nombre_sub']; ?></option>
          <?php
          }
        ?>  
      </select>
    </div>
    <div class="row col s9" style="display:none; margin-bottom: 0px;" id="ids">
      <label style="margin-left: 10px;">Sector</label>
      <select class="browser-default" id="id_sect" name="id_sect">
        <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($sector as $sec){ ?>
          <option value="<?php echo $sec['id_sa']; ?>"><?php echo $sec['nombre_sa']; ?></option>
          <?php
          }
        ?>  
      </select>
    </div>
    <div class="row col s6" style="margin-bottom: 0px;">
      <label style="margin-left: 10px;">Coordenadas del polígono</label>
      <!--<input type="text" colspan=> -->
      <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="acoordenadas1" id="acoordenadas1" value=""></textarea><br>
    </div>
    <div class="row col s6" style="margin-bottom: 0px; overflow-x: auto;">
      <label style="margin-left: 10px;">Color de linea </label><br>
      <button class="jscolor  {valueElement:clinea1_1,onFineChange:'updates(this)'}"  id="clinea1"  value="#ff0000" style="width:25%; height:25%;"> Elije un color</button><br>
      <label style="margin-left: 10px;">Color de relleno</label><br>
      <button class="jscolor  {valueElement:crrelleno1_1,onFineChange:'updatef(this)'}"  id="crrelleno1" value="#ff0000" style="width:25%; height:25%;">Elije un color</button>
    </div>
   <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="poblacion" name="poblacion" style="height: 25px;">
        <label for="temporal">Población</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="usuarios" name="usuarios" style="height: 25px;">
        <label for="temporal">Usuarios</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="tomas_domiciliarias" name="tomas_domiciliarias" style="height: 25px;">
        <label for="temporal">Tomas domiciliarias</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="punto_suministro" name="punto_suministro" style="height: 25px;">
        <label for="temporal">Punto de suministro</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="tipo_suministro" name="tipoo_suministro" style="height: 25px;">
        <label for="temporal">Tipo de suministro</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="tipo_servicio" name="tipo_servicio" style="height: 25px;">
        <label for="temporal">Tipo de servicio</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0" max="100" class="validate" id="cobertura" name="cobertura" style="height: 25px;">
        <label for="temporal">Cobertura</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0" max="100" class="validate" id="cobertura" name="cobertura" style="height: 25px;">
        <label for="temporal">Cobertura</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0" class="validate" id="area" name="area" style="height: 25px;">
        <label for="temporal">Área</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0" class="validate" id="elevacion_maxima" name="elevacion_maxima" style="height: 25px;">
        <label for="temporal">Elevación máxima</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0"  class="validate" id="elevacion_med" name="elevacion_med" style="height: 25px;">
        <label for="temporal">Elevación media</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0"  class="validate" id="elevacion_min" name="elevacion_min" style="height: 25px;">
        <label for="temporal">Elevación mínima</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0"  class="validate" id="fugas_red" name="fugas_red" style="height: 25px;">
        <label for="temporal">Fugas en red por año</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0"  class="validate" id="fugas_toma" name="fugas_toma" style="height: 25px;">
        <label for="temporal">Fugas en tomas por año</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0" class="validate" id="servicio_medido_vol" name="servicio_medido_vol" style="height: 25px;">
        <label for="temporal">Servicio medido en volumen</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0"  class="validate" id="servicio_medido_caudal" name="servicio_medido_caudal" style="height: 25px;">
        <label for="temporal">Servicio medido en caudal</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0"  class="validate" id="servicio_cf_vol" name="servicio_cf_vol" style="height: 25px;">
        <label for="temporal">Servicio cuota fija medido en volumen</label> 
      </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="number" step="any" min="0"  class="validate" id="servicio_cf_caudal" name="servicio_cf_caudal" style="height: 25px;">
        <label for="temporal">Servicio de cuota fija medido en caudal</label> 
      </div>
    </div>
    <input type:"text" value="#ff0000" name="clinea1_1" id="clinea1_1" style="display:none;">
    <input type:"text" value="#ff0000" name="crrelleno1_1" id="crrelleno1_1" style="display:none;">
    <div>
      <button  id="editdis" onclick="enviardis()">Registrar</button>
      <input id="Canceldis" type="button" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide'); cancelpoly();" value="Cancelar">
    </div>
  </ul>
  <input  type="number" class="validate" id="id_dis" name="id_dis" style="display:none;">
  <input  type="number" class="validate" id="idper" name="idper" style="display:none;">
  <input  type="number" class="validate" id="band" name="band" style="display:none;">
  </form>
</div>
<!-- END insert Distrito-->

<!-- Section to insert Subsector-->
<div>
<form method="post" id="fsub" name="fsub" action="<?php echo base_url()?>record_controller/registrar_sub">
  <ul id="create-subsector" class="side-nav" style="width: 420px;">
    <p id="titsub" class="tituloOpc">Formulario de Subsectores</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="nombre_sub" name="nombre_sub" style="height: 25px;">
        <label for="temporal">Nombre del Subsector</label> 
      </div>
    </div>
    <div class="row col s9" style="margin-bottom: 0px;">
      <label style="margin-left: 10px;">Sector</label>
      <select class="browser-default" id="id_sa_sub" name="id_sa_sub">
        <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($sector as $sec){ ?>
          <option value="<?php echo $sec['id_sa']; ?>"><?php echo $sec['nombre_sa']; ?></option>
          <?php
          }
        ?>  
      </select>
    </div>
    <div class="row col s6" style="margin-bottom: 0px;">
      <label style="margin-left: 10px;">Coordenadas del polígono</label>
      <!--<input type="text" colspan=> -->
      <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="acoordenadas2" id="acoordenadas2" value=""></textarea><br>
    </div>
    <div class="row col s6" style="margin-bottom: 0px; overflow-x: auto;">
      <label style="margin-left: 10px;">Color de linea </label><br>
      <button class="jscolor  {valueElement:clinea2_1,onFineChange:'updates(this)'}"  id="clinea2"  value="#ff0000" style="width:25%; height:25%;"> Elije un color</button><br>
      <label style="margin-left: 10px;">Color de relleno</label><br>
      <button class="jscolor  {valueElement:crrelleno2_1,onFineChange:'updatef(this)'}"  id="crrelleno2" value="#ff0000" style="width:25%; height:25%;">Elije un color</button>
    </div>
    <input type:"text" value="#ff0000" name="clinea2_1" id="clinea2_1" style="display:none;">
    <input type:"text" value="#ff0000" name="crrelleno2_1" id="crrelleno2_1" style="display:none;">
    <div>
      <button id="editsub" onclick="asigncolor(2)" >Registrar</button>
      <input id="Cancelsub" type="button" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide'); cancelpoly();" value="Cancelar">
    </div>
  </ul>
  <input  type="number" class="validate" id="id_sub_edit" name="id_sub_edit" style="display:none;">
  </form>
</div>
<!-- END insert Subsector-->

<!-- Section to insert Sector-->
<div>
<form method="post"  id="fsa" name="fsa" action="<?php echo base_url()?>record_controller/registrar_sa">
  <ul id="create-sector" class="side-nav" style="width: 420px;">
    <p id="titsec" class="tituloOpc">Formulario de Sectores</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="nombre_sa" name="nombre_sa" style="height: 25px;">
        <label for="temporal">Nombre del Sector</label> 
      </div>
    </div>
    <div class="row col s6" style="margin-bottom: 0px;">
      <label style="margin-left: 10px;">Coordenadas del polígono</label>
      <!--<input type="text" colspan=> -->
      <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="acoordenadas3" id="acoordenadas3" value=""></textarea><br>
    </div>
    <div class="row col s6" style="margin-bottom: 0px; overflow-x: auto;">
      <label style="margin-left: 10px;">Color de linea </label><br>
      <button class="jscolor  {valueElement:clinea3_1,onFineChange:'updates(this)'}"  name="clinea3" id="clinea3"  value="#ff0000" style="width:25%; height:25%;"> Elije un color</button><br>
      <label style="margin-left: 10px;">Color de relleno</label><br>
      <button class="jscolor  {valueElement:crrelleno3_1,onFineChange:'updatef(this)'}"  name="crrelleno3" id="crrelleno3" value="#ff0000" style="width:25%; height:25%;">Elije un color</button>
    </div>
    <input type:"text" value="#ff0000" name="clinea3_1" id="clinea3_1" style="display:none;">
    <input type:"text" value="#ff0000" name="crrelleno3_1" id="crrelleno3_1" style="display:none;">
    <div>
      <button id="editsec" onclick="asigncolor(3)" >Registrar</button>
      <input id="Cancelsec" type="button" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide'); cancelpoly();" value="Cancelar">
    </div>
  </ul>
  <input  type="number" class="validate" id="id_sa" name="id_sa" style="display:none;">
  </form>
</div>
<!-- END insert Sector-->

<!-- Section to insert Arrancador-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-arrancador" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Arrancador</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="tipo_ar" name="tipo_ar" style="height: 25px;">
        <label for="temporal">Tipo de arrancador</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" type="text" class="validate" id="marca_ar" name="marca_ar" style="height: 25px;">
        <label for="temporal">Marca del arrancador</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="capacidad_ar" name="capacidad_ar" style="height: 25px;">
        <label for="temporal">Capacidad del arrancador</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="voltaje_ar" name="voltaje_ar" style="height: 25px;">
        <label for="temporal">Voltaje del arrancador</label>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <input type="button" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');" value="Cancelar">
    </div>
  </ul>
  </form>
</div>
<!-- END insert Arrancador-->

<!-- Section to insert Bomba-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-bomba" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Bomba</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="marca_bomba" name="marca_bomba" style="height: 25px;">
        <label for="temporal">Marca de la bomba</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" type="text" class="validate" id="modelo_bomba" name="modelo_bomba" style="height: 25px;">
        <label for="temporal">Modelo de la bomba</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="presion_bomba" name="presion_bomba" style="height: 25px;">
        <label for="temporal">Presión de la bomba</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="caudal_bomba" name="caudal_bomba" style="height: 25px;">
        <label for="temporal">Caudal de la bomba</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" type="text" class="validate" id="tipo_bomba" name="tipo_bomba" style="height: 25px;">
        <label for="temporal">Tipo de bomba</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="eficiencianominal_bomba" name="eficiencianominal_bomba" style="height: 25px;">
        <label for="temporal">Eficiencia nominal de la bomba</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="eficienciaminima_bomba" name="eficienciaminima_bomba" style="height: 25px;"><label for="temporal">Eficiencia mínima de la bomba</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="num_pasos_bomba" name="num_pasos_bomba" style="height: 25px;"><label for="temporal">Número de pasos de la bomba</label>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Infraestructura de bombeo</label>
        <select class="browser-default" id="id_ib_bomba" name="id_ib_bomba">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($infrab as $ib){ ?>
          <option value="<?php echo $ib['id_ib']; ?>"><?php echo $ib['nombre_ib']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <input type="button" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');" value="Cancelar">
    </div>
  </ul>
  </form>
</div>
<!-- END insert Bomba-->

<!-- Section to insert Capacitores-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-capacitores" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Capacitores</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="potencia_Ct" name="potencia_Ct" style="height: 25px;">
        <label for="temporal">Potencia</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="tension_Ct" name="tension_Ct" style="height: 25px;">
        <label for="temporal">Tensión</label>
      </div>
    </div>
    <div>
      <li><button type="submit" value="">Registrar</button></li>
      <li> <input type="button" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');" value="Cancelar"></li>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Capacitores-->

<!-- Section to insert Conductor eléctrico-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-conductorelectrico" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Conductor Eléctrico</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="calibre_cte" name="calibre_cte" style="height: 25px;">
        <label for="temporal">Calibre</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="control_cte" name="calibre_cte" style="height: 25px;">
        <label for="temporal">Número de control</label>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Arrancador</label>
        <select class="browser-default" id="id_ar_cte" name="id_ar_cte">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($arranc as $arran){ ?>
          <option value="<?php echo $arran['id_ar']; ?>"><?php echo $arran['marca_ar']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <input type="button" value="Cancelar" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">
    </div>
  </ul>
  </form>
</div>
<!-- END insert Conductor eléctrico-->

<!-- Section to insert Cuenta-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-cuenta" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de cuenta</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="cuenta" name="cuenta" style="height: 25px;">
        <label for="temporal">Número de cuenta</label>
      </div>
      <div class="row col s6">
        <label style="margin-left: 10px;">Usuario</label>
        <select class="browser-default" id="id_ar_ce" name="id_ar_ce">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($usuarios as $usu){ ?>
          <option value="<?php echo $usu['id_padron_u']; ?>"><?php echo $usu['nombre_u']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
      <div class="row col s6">
        <label style="margin-left: 10px;">Toma</label>
        <select class="browser-default" id="id_ar_ce" name="id_ar_ce">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($tomas as $tom){ ?>
            <option value="<?php echo $tom['id_toma']; ?>"><?php echo $tom['num_serie_toma']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <input type="button" value="Cancelar" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">
    </div>
  </ul>
  </form>
</div>
<!-- END insert Cuenta-->

<!-- Section to insert Curva de cubicación-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-curvacu" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Curva de cubicación</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="nivel_cc" name="nivel_cc" style="height: 25px;">
        <label for="temporal">Nivel</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="volumen_cc" name="volumen_cc" style="height: 25px;">
        <label for="temporal">Volumen</label>
      </div>
      <div class="row col s6">
        <label style="margin-left: 10px;">Distrito</label>
        <select class="browser-default" id="id_ar_ce" name="id_ar_ce">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($distrito as $dis){ ?>
          <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Curva de cubicación-->

<!-- Section to insert Curva de demanda-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-curvade" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Curva de demanda</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="nombre_cd" name="nombre_cd" style="height: 25px;">
        <label for="temporal">Nombre de la curva</label>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Curva de cubicación-->

<!-- Section to insert Fuentes de extracción-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-fuente" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Fuentes de extracción</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="tipo_fe" name="tipo_fe" style="height: 25px;">
        <label for="temporal">Tipo de fuente</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" type="text" class="validate" id="nombre_fe" name="nombre_fe" style="height: 25px;">
        <label for="temporal">Nombre de la fuente</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="altura_manometro_fe" name="altura_manometro_fe" style="height: 25px;">
        <label for="temporal">Altura del manómetro</label>
      </div>
      <div class="input-field col s9">
        <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="observaciones_fe" id="observaciones_fe" value=""></textarea>
        <label for="temporal">Observaciones</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" step="any" type="number" class="validate" id="latitud_fe" name="latitud_fe" style="height: 25px;">
        <label for="temporal">Latitud de la fuente (coordenada)</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" step="any" type="number" class="validate" id="longitud_fe" name="longitud_fe" style="height: 25px;">
        <label for="temporal">Longitud de la fuente (coordenada)</label>
      </div>
      <div class="row col s6">
        <label style="margin-left: 10px;">Punto de macromedción</label>
        <select class="browser-default" id="id_mac_fe" name="id_mac_fe">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($puntosmac as $mac){ ?>
          <option value="<?php echo $mac['id_mac']; ?>"><?php echo $mac['id_mac']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
      <div class="row col s6">
        <label style="margin-left: 10px;">Distrito</label>
        <select class="browser-default" id="id_ib_bomba" name="id_ib_bomba">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($distrito as $dis){ ?>
          <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Fuentes de extracción-->

<!-- Section to insert Horario Bomba-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-horariobomba" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de horario de la bomba</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="date" class="validate" id="fecha_b" name="fecha_b" style="height: 25px;">
        <label for="temporal">Fecha de hoy</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" type="time" class="validate" id="hora_in_b" name="hora_in_b" style="height: 25px;">
        <label for="temporal">Hora incial</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="time" class="validate" id="hora_fn_b" name="hora_fn_b" style="height: 25px;">
        <label for="temporal">Hora final</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="dias_op_b" name="dias_op_b" style="height: 25px;">
        <label for="temporal">Dias operación</label>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Infraestructura de bombeo</label>
        <select class="browser-default" id="id_ib_b" name="id_ib_b">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($infrab as $ib){ ?>
          <option value="<?php echo $ib['id_ib']; ?>"><?php echo $ib['nombre_ib']; ?></option>
          <?php
          }
          ?>  
      </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Horario Bomba-->

<!-- Section to insert Horario Valvula-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-horariovalvula" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de horario de la valvula</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="date" class="validate" id="fecha_v" name="fecha_v" style="height: 25px;">
        <label for="temporal">Fecha de hoy</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" type="time" class="validate" id="hora_in_v" name="hora_in_v" style="height: 25px;">
        <label for="temporal">Hora incial</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="time" class="validate" id="hora_fn_v" name="hora_fn_v" style="height: 25px;">
        <label for="temporal">Hora final</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="dias_op_v" name="dias_op_v" style="height: 25px;">
        <label for="temporal">Dias operación</label>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Válvula</label>
        <select class="browser-default" id="id_val_v" name="id_val_v">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($valvuls as $val){ ?>
            <option value="<?php echo $val['id_val']; ?>"><?php echo $val['id_val']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Horario Valvula-->

<!-- Section to insert Infraesctructura de bombeo-->
<div >
<form method="post" id="fbombeo" action="<?php echo base_url()?>record_controller/registrar_bombeo">
  <ul  id="create-bombeo" class="side-nav" style="width: 420px;">
    <p id="titbombeo" class="tituloOpc">Formulario de Infraestructura de bombeo</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="input-field col s9">
          <input placeholder="" type="text" class="validate" id="nombre_ib" name="nombre_ib" style="height: 25px;">
          <label for="temporal">Nombre de la infraestructura</label>
        </div>
        <div class="input-field col s9"> 
          <input placeholder="" type="number" class="validate" id="estacion_ib" name="estacion_ib" style="height: 25px;">
          <label for="temporal">Número de estación</label>
        </div>
        <div class="input-field col s9">
          <input placeholder="" type="number" class="validate" id="equipo_ib" name="equipo_ib" style="height: 25px;">
          <label for="temporal">Número de equipo</label>
        </div>
        <div class="input-field col s9">
          <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="observaciones_ib" id="observaciones_ib" value=""></textarea>
          <label for="temporal">Observaciones</label>
        </div>
        <div class="input-field col s9">
          <input placeholder="" step="any" type="number" class="validate" id="latitud_ib" name="latitud_ib" style="height: 25px;">
          <label for="temporal">Latitud de la infraestructura (coordenada)</label>
        </div>
        <div class="input-field col s9"> 
          <input placeholder="" step="any" type="number" class="validate" id="longitud_ib" name="longitud_ib" style="height: 25px;">
          <label for="temporal">Longitud de la infraestructura (coordenada)</label>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Fuente de extracción</label>
          <select class="browser-default" id="id_fe_ib" name="id_fe_ib">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($fuentes as $fue){ ?>
            <option value="<?php echo $fue['id_fe']; ?>"><?php echo $fue['nombre_fe']; ?></option>
            <?php
            }
             ?>  
          </select>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Arrancador</label>
          <select class="browser-default" id="id_ar_ib" name="id_ar_ib">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($arranc as $arran){ ?>
            <option value="<?php echo $arran['id_ar']; ?>"><?php echo $arran['marca_ar']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Predio</label>
          <select class="browser-default" id="id_pr_ib" name="id_pr_ib">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($predios as $pred){ ?>
            <option value="<?php echo $pred['id_pr']; ?>"><?php echo $pred['nombre_pr']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Distritos</label>
            <select class="browser-default" id="id_dis_ib" name="id_dis_ib">
              <option value="" disabled selected>Seleccione una opcion...</option>
              <?php 
              foreach($distrito as $dis){ ?>
              <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
              <?php
              }
              ?>  
            </select>
        </div>
      </div>  
      <div>
        <button id="editbombeo" type="submit" >Registrar</button>
        <input id="cancelbombeo" type="button" value="Cancelar" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">
      </div>
      <input type="number" class="validate" id="id_edit_ib" name="id_edit_ib" style="display:none;">
  </ul>
  </form>
</div>
<!-- END insert Infraesctructura de bombeo-->

<!-- section to insert Infraesctructura de regularización-->
<div>
<form  method="post" id="fir" action="<?php echo base_url()?>record_controller/registrar_tanque">
  <ul id="create-tanque" class="side-nav" style="width: 420px;">
    <p id="titir" class="tituloOpc">Formulario de Infraesctructura de regularización</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="tipo_ir" name="tipo_ir" style="height: 25px;">
        <label for="temporal">Tipo de infraestructura</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="funcion_ir" name="funcion_ir" style="height: 25px;">
        <label for="temporal">Función</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="material_ir" name="material_ir" style="height: 25px;">
        <label for="temporal">Material</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="text" class="validate" id="nombre_ir" name="nombre_ir" style="height: 25px;">
        <label for="temporal">Nombre</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="elevacion_ir" name="elevacion_ir" style="height: 25px;">
        <label for="temporal">Elevacion</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="ndp_ir" name="ndp_ir" style="height: 25px;">
        <label for="temporal">Nivel de desplante</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="volumen_ir" name="volumen_ir" style="height: 25px;">
        <label for="temporal">Volumen</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="h_total_ir" name="h_total_ir" style="height: 25px;">
        <label for="temporal">Altura total</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="h_ir" name="h_ir" style="height: 25px;">
        <label for="temporal">Nivel máximo</label> 
      </div>
      <div class="input-field col s6">
        <input placeholder="" type="number" class="validate" id="ni_min_ir" name="ni_min_ir" style="height: 25px;">
        <label for="temporal">Nivel mínimo</label> 
      </div>
      <div class="input-field col s9">
        <label for="fecha_ir">Fecha de hoy</label><br>
        <input placeholder="" type="date" class="validate" id="fecha_ir" name="fecha_ir" style="height: 25px;">
      </div>
      <div class="input-field col s9">
        <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" placeholder="Observaciones" name="observaciones_ir" id="observaciones_ir" value=""></textarea>
      </div>
      <div class="input-field col s9">
        <input placeholder="" step="any" type="number" class="validate" id="latitud_ir" name="latitud_ir" style="height: 25px;">
        <label for="temporal">Latitud del tanque (coordenada)</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" step="any" type="number" class="validate" id="longitud_ir" name="longitud_ir" style="height: 25px;">
        <label for="temporal">Longitud del tanque (coordenada)</label>
      </div> 
      <div class="row col s6">
        <label style="margin-left: 10px;">Distritos</label>
        <select class="browser-default" id="id_dis_ir" name="id_dis_ir">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
           foreach($distrito as $dis){ ?>
            <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
        <button id="editir" type="submit" >Registrar</button>
        <input id="cancelir" type="button" value="Cancelar" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">
    </div>
    <input id="id_edit_ir" name="id_edit_ir" type="number" class="validate" style="display:none;">
  </ul>
  </form>
</div>
<!--END insert Infraesctructura de regularización -->

<!-- Section to insert Mantenimiento de la bomba -->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-manteb" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de mantenimiento de la bomba</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="date" class="validate" id="fecha_m_b" name="fecha_m_b" style="height: 25px;">
        <label for="temporal">Fecha de mantenimiento</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="eficiencia_b" name="eficiencia_b" style="height: 25px;">
        <label for="temporal">Eficiencia medida</label>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Bomba</label>
        <select class="browser-default" id="id_bomba_b" name="id_bomba_b">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
         foreach($bombas as $bomb){ ?>
            <option value="<?php echo $bomb['id_bomba']; ?>"><?php echo $bomb['num_serie_bomba']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Mantenimiento de la bomba-->

<!-- Section to insert Mantenimiento del motor -->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-mantem" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de mantenimiento del motor</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="date" class="validate" id="fecha_m_m" name="fecha_m_m" style="height: 25px;">
        <label for="temporal">Fecha de mantenimiento</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="eficiencia_m" name="eficiencia_m" style="height: 25px;">
        <label for="temporal">Eficiencia medida</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="num_bobinados_m" name="num_bobinados_m" style="height: 25px;">
        <label for="temporal">Numero de bobinados</label>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Motor</label>
        <select class="browser-default" id="id_motor_m" name="id_motor_m">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($motores as $mot){ ?>
          <option value="<?php echo $mot['id_motor']; ?>"><?php echo $mot['num_serie_motor']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Mantenimiento del motor-->

<!-- Section to insert Medidor-->
<div>
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-medidores" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Medidores</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="marca_med" name="marca_med" style="height: 25px;">
        <label for="temporal">Marca</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" type="text" class="validate" id="modelo_med" name="modelo_med" style="height: 25px;">
        <label for="temporal">Modelo</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="diametro_med" name="diametro_med" style="height: 25px;">
        <label for="temporal">Diámetro</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" type="text" class="validate" id="tipo_med" name="tipo_med" style="height: 25px;">
        <label for="temporal">Tipo</label>
      </div>
      <div class="input-field col s9"> 
        <label style="margin-left: 10px;">Clase metrológica</label>
        <select placeholder="" type="text" class="validate" id="clasemetro_mac" name="clasemetro_mac" style="height: 25px;">
          <option value="A"  selected>A</option>
          <option value="B"  selected>B</option>
          <option value="C"  selected>C</option>
          <option value="D"  selected>D</option>
        </select>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Punto de macromedción</label>
        <select class="browser-default" id="id_mac" name="id_mac">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($puntosmac as $mac){ ?>
            <option value="<?php echo $mac['id_mac']; ?>"><?php echo $mac['id_mac']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Medidor-->

<!-- Section to insert Motor -->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-motor" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de motor</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="tipo_motor" name="tipo_motor" style="height: 25px;">
        <label for="temporal">Tipo de motor</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="eficiencianominal_motor" name="eficiencianominal_motor" style="height: 25px;">
        <label for="temporal">Eficiencia nominal</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="eficienciaminima_motor" name="eficienciaminima_motor" style="height: 25px;">
        <label for="temporal">Eficiencia mínima</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="marca_motor" name="marca_motor" style="height: 25px;">
        <label for="temporal">Marca del motor</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="modelo_motor" name="modelo_motor" style="height: 25px;">
        <label for="temporal">Modelo del motor</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="hp_motor" name="hp_motor" style="height: 25px;">
        <label for="temporal">Potencia del motor (HP)</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="rpm_motor" name="hp_motor" style="height: 25px;">
        <label for="temporal">Revoluciones por minuto</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="voltaje_motor" name="voltaje_motor" style="height: 25px;">
        <label for="temporal">Voltaje</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="num_serie_motor" name="num_serie_motor" style="height: 25px;">
        <label for="temporal">Número de serie</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="armazon_motor" name="armazon_motor" style="height: 25px;">
        <label for="temporal">Armazón</label>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Bomba</label>
        <select class="browser-default" id="id_bomba_motor" name="id_bomba_motor">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($bombas as $bomb){ ?>
            <option value="<?php echo $bomb['id_bomba']; ?>"><?php echo $bomb['num_serie_bomba']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class="modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Motor-->

<!-- Section to insert Pozos profundos -->
<div >
<form id="fpozo" name="fpozo" method="post" action="<?php echo base_url()?>record_controller/registrar_pozo">
  <ul  id="create-pozo" class="side-nav" style="width: 420px;">
    <p id="titpozo" class="tituloOpc">Formulario de Pozos profundos</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9"> 
        <input placeholder="" type="text" class="validate" id="nombre_fe1" name="nombre_fe1" style="height: 25px;">
        <label for="temporal">Nombre del pozo</label>
      </div>
       <div class="input-field col s9">
        <input placeholder="" step="any" type="number" class="validate" id="latitud_fe1" name="latitud_fe1" style="height: 25px;">
        <label for="temporal">Latitud de la fuente (coordenada)</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" step="any" type="number" class="validate" id="longitud_fe1" name="longitud_fe1" style="height: 25px;">
        <label for="temporal">Longitud de la fuente (coordenada)</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="altura_manometro_fe1" name="altura_manometro_fe1" style="height: 25px;">
        <label for="temporal">Altura del manómetro</label>
      </div>
      <div class="input-field col s9">
        <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="observaciones_fe1" id="observaciones_fe1" value=""></textarea>
        <label for="temporal">Observaciones</label>
      </div>
      <div class="row col s6">
        <label style="margin-left: 10px;">Punto de macromedción</label>
        <select class="browser-default" id="id_mac_fe1" name="id_mac_fe1">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($puntosmac as $mac){ ?>
          <option value="<?php echo $mac['id_mac']; ?>"><?php echo $mac['id_mac']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
      <div class="row col s6">
        <label style="margin-left: 10px;">Distrito</label>
        <select class="browser-default" id="id_dis_fe1" name="id_dis_fe1">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($distrito as $dis){ ?>
          <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
       <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="profpozo_pf" name="profpozo_pf" style="height: 25px;">
        <label for="temporal">Profundidad del pozo en metros</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="date" class="validate" id="fcolocacion_pf" name="fcolocacion_pf" style="height: 25px;">
        <label for="temporal">Fecha de colocación</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="dcolumna_pf" name="dcolumna_pf" style="height: 25px;">
        <label for="temporal">Diámetro de columna</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="number" class="validate" id="dademe_pf" name="dademe_pf" style="height: 25px;">
        <label for="temporal">Diámetro de ademe</label>
      </div>
    </div>
    <div>
      <button id="edit_pozo" type="submit" >Registrar</button>
      <input id="cancel_pozo" type="button" value="Cancelar" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">
    </div>
    <input type="number" class="validate" id="id_edit_pozo" name="id_edit_pozo" style="display: none;">
     <input type="number" class="validate" id="id_edit_fe" name="id_edit_fe" style="display: none;">
  </ul>
  </form>
</div>
<!-- END insert Pozos profundos-->

<!-- Section to insert Predio -->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-predio" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de predio</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="nombre_pr" name="nombre_pr" style="height: 25px;">
        <label for="temporal">Nombre del predio</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" step="any" type="number" class="validate" id="latitud_pr" name="latitud_pr" style="height: 25px;">
        <label for="temporal">Latitud del predio (coordenada)</label>
      </div>
      <div class="input-field col s9"> 
        <input placeholder="" step="any" type="number" class="validate" id="longitud_ir" name="longitud_ir" style="height: 25px;">
        <label for="temporal">Longitud del predio (coordenada)</label>
      </div> 
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Banco de capacitores</label>
        <select class="browser-default" id="id_ct" name="id_ct">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($capacitoress as $capa){ ?>
          <option value="<?php echo $capa['id_ct']; ?>"><?php echo $capa['id_ct']; ?></option>
          <?php
          }
          ?>  
        </select>
      </div>
      <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Sistema tierra</label>
        <select class="browser-default" id="id_st" name="id_st">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($sistemast as $sis){ ?>
          <option value="<?php echo $sis['id_st']; ?>"><?php echo $sis['id_st']; ?></option>
          <?php
          }
        ?>  
      </select>
    </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Predio-->

<!-- Section to insert Punto macromedición -->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-puntomac" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de punto de macromedción</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="tipotoma_mac" name="tipotoma_mac" style="height: 25px;">
        <label for="temporal">Tipo de toma</label>
        </div>
        <div class="input-field col s9">
        <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="observaciones_mac" id="observaciones_mac" value=""></textarea>
        <label for="temporal">Observaciones</label>
        </div>
        <div class="input-field col s9">
        <input placeholder="" step="any" type="number" class="validate" id="latitud_mac" name="latitud_mac" style="height: 25px;">
        <label for="temporal">Latitud del punto (coordenada)</label>
        </div>
        <div class="input-field col s9"> 
        <input placeholder="" step="any" type="number" class="validate" id="longitud_mac" name="longitud_mac" style="height: 25px;">
        <label for="temporal">Longitud del punto (coordenada)</label>
        </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Punto de macromedción -->


<!-- Section to insert Punto de suministro -->
<div>
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-puntosum" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de punto de suministro</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="tipo_ps" name="tipo_ps" style="height: 25px;">
        <label for="temporal">Tipo de punto de suministro</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="entrada_ps" name="entrada_ps" style="height: 25px;">
        <label for="temporal">Entrada</label>
      </div>
      <div class="input-field col s9">
        <input placeholder="" step="any" type="number" class="validate" id="latitud_mac" name="latitud_mac" style="height: 25px;">
        <label for="temporal">Latitud del punto (coordenada)</label>
        </div>
        <div class="input-field col s9"> 
        <input placeholder="" step="any" type="number" class="validate" id="longitud_mac" name="longitud_mac" style="height: 25px;">
        <label for="temporal">Longitud del punto (coordenada)</label>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
        <label style="margin-left: 10px;">Distrito</label>
      <select class="browser-default" id="id_dis_ps" name="id_dis_ps">
        <option value="" disabled selected>Seleccione una opcion...</option>
       <?php 
          foreach($distrito as $dis){ ?>
            <option value="<?php echo $dis['id_dis']; ?>"><?php echo $ib['nombre_dis']; ?></option>
          <?php
          }
        ?>  
      </select>
    </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Punto de suministro -->

<!-- Section to insert Rebombeo-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-rebombeo" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de rebombeo</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="input-field col s9">
          <input placeholder="" type="text" class="validate" id="nombre_rb" name="nombre_rb" style="height: 25px;">
          <label for="temporal">Nombre del rebombeo</label>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Infraesctructura de bombeo</label>
          <select class="browser-default" id="id_ib" name="id_ib">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
          foreach($infrab as $inf){ ?>
            <option value="<?php echo $inf['id_ib']; ?>"><?php echo $inf['nombre_ib']; ?></option>
            <?php
          }
        ?>  
      </select>
    </div>
    <div class="row col s6" style="margin-bottom: 0px;">
      <label style="margin-left: 10px;">Infraesctructura de regularización</label>
        <select class="browser-default" id="id_ir" name="id_ir">
          <option value="" disabled selected>Seleccione una opcion...</option>
          <?php 
          foreach($infrar as $infr){ ?>
            <option value="<?php echo $infr['id_ir']; ?>"><?php echo $infr['nombre_ir']; ?></option>
          <?php
          }
        ?>  
      </select>
    </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Rebombeo -->

<!-- Section to insert Sistema Tierra-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-sistemat" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Sistema tierra</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="caracteristicas_st" name="caracteristicas_st" style="height: 25px;">
        <label for="temporal">Características</label>
        </div>
    </div>
    <div>
      <button type="submit" >Registrar</button>
      <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Sistema tierra -->

<!-- Section to insert Toma-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-Toma" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Toma</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">Uso de la toma</label>
            <select placeholder="" type="text" class="validate" id="uso_toma" name="uso_toma" style="height: 25px;">
              <option value="Domestico"  selected>Doméstico</option>
              <option value="Comercial"  selected>Comercial</option>
              <option value="Industrial"  selected>Industrial</option>
              <option value="Mixto"  selected>Mixto</option>
            </select>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">Giro de la toma</label>
            <select placeholder="" type="text" class="validate" id="giro_toma" name="giro_toma" style="height: 25px;">
              <option value="Alimentos"  selected>Doméstico</option>
              <option value="Ventas"  selected>Comercial</option>
              <option value="Oficina"  selected>Industrial</option>
              <option value="Publico"  selected>Público</option>
              <option value="Servicios"  selected>Servicios</option>
            </select>
        </div>
        <div class="input-field col s9"> 
        <input placeholder="" type="text" class="validate" id="descripcion_giro_toma" name="descripcion_giro_toma" style="height: 25px;">
        <label for="temporal">Descripción del giro de la toma</label>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">Posición de la toma</label>
            <select placeholder="" type="text" class="validate" id="posicion_toma" name="posicion_toma" style="height: 25px;">
              <option value="No Accesible"  selected>No Accesible</option>
              <option value="Protegido"  selected>Protegido</option>
              <option value="No protegido"  selected>No protegido</option>
            </select>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">¿Tiene fuga?</label>
          <select placeholder="" type="text" class="validate" id="fuga_toma" name="fuga_toma" style="height: 25px;">
            <option value="0"  selected>Sin fuga</option>
            <option value="1"  selected>Con fuga</option>
          </select>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">Material</label>
          <select placeholder="" type="text" class="validate" id="material_toma" name="material_toma" style="height: 25px;">
            <option value="Cobre"  selected>Cobre</option>
            <option value="Galvanizado"  selected>Galvanizado</option>
            <option value="PVC"  selected>PVC</option>
            <option value="Manguera"  selected>Manguera</option>
            <option value="Otro"  selected>Otro</option>
          </select>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">Diámetro</label>
          <select placeholder="" type="text" class="validate" id="diametro_toma" name="diametro_toma" style="height: 25px;">
            <option value="1/2"  selected>1/2"</option>
            <option value="3/4"  selected>3/4"</option>
            <option value="1"  selected>1"</option>
            <option value="1 1/2"  selected>1 1/2"</option>
            <option value="2"  selected>2"</option>
            <option value="3"  selected>3"</option>
            <option value="4"  selected>4"</option>
          </select>
        </div>
        <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="num_serie_toma" name="num_serie_toma" style="height: 25px;">
        <label for="temporal">Número de serie</label>
        </div>
        <div class="input-field col s9">
        <input placeholder="" type="text" class="validate" id="marca_toma" name="marca_toma" style="height: 25px;">
        <label for="temporal">Marca</label>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">Estado físico</label>
          <select placeholder="" type="text" class="validate" id="estado_toma" name="estado_toma" style="height: 25px;">
            <option value="Bueno"  selected>Bueno</option>
            <option value="Regular"  selected>Regular</option>
            <option value="Malo"  selected>Malo</option>
            <option value="No Sirve"  selected>No Sirve</option>
          </select>
        </div>
        <div class="input-field col s9">
          <input placeholder="" type="text" class="validate" id="ruta_toma" name="ruta_toma" style="height: 25px;">
          <label for="temporal">Ruta</label>
        </div>
        <div class="input-field col s9">
          <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="observaciones_toma" id="observaciones_toma" value=""></textarea>
          <label for="temporal">Observaciones</label>
        </div>
        <div class="input-field col s9">
          <input placeholder="" step="any" type="number" class="validate" id="latitud_toma" name="latitud_toma" style="height: 25px;">
          <label for="temporal">Latitud de la fuente (coordenada)</label>
        </div>
        <div class="input-field col s9"> 
          <input placeholder=""  step="any" type="number" class="validate" id="longitud_toma" name="longitud_toma" style="height: 25px;">
          <label for="temporal">Longitud de la fuente (coordenada)</label>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Sector comercial</label>
          <select class="browser-default" id="id_sc_toma" name="id_sc_toma">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($sectorc as $sec){ ?>
            <option value="<?php echo $sec['id_sc']; ?>"><?php echo $sec['nombre_sc']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Distrito</label>
          <select class="browser-default" id="id_dis_toma" name="id_dis_toma">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($distrito as $dis){ ?>
            <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
    </div>
    <div>
        <button type="submit" >Registrar</button>
        <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Toma-->

<!-- Section to insert Transformador-->
<div >
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-Transformador" class="side-nav" style="width: 420px;">
    <p class="tituloOpc">Formulario de Transformador</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="input-field col s9"> 
          <input placeholder="" type="text" class="validate" id="tipo_tr" name="tipo_tr" style="height: 25px;">
          <label for="temporal">Tipo de transformador</label>
        </div>
        <div class="input-field col s9"> 
          <input placeholder="" type="text" class="validate" id="marca_tr" name="marca_tr" style="height: 25px;">
          <label for="temporal">Marca</label>
        </div>
        <div class="input-field col s9"> 
          <input placeholder="" type="text" class="validate" id="capacidad_tr" name="capacidad_tr" style="height: 25px;">
          <label for="temporal">Capacidad</label>
        </div>
        <div class="input-field col s9">
          <input placeholder="" type="text" class="validate" id="modelo_tr" name="modelo_tr" style="height: 25px;">
          <label for="temporal">Modelo</label>
        </div>
        <div class="input-field col s9">
          <input placeholder="" type="number" class="validate" id="talta_tr" name="talta_tr" style="height: 25px;">
          <label for="temporal">Tensión alta</label>
        </div>
        <div class="input-field col s9">
          <input placeholder="" type="number" class="validate" id="tbaja_tr" name="tbaja_tr" style="height: 25px;">
          <label for="temporal">Tensión baja</label>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">¿Es activo?</label>
          <select placeholder="" type="text" class="validate" id="activo_tr" name="activo_tr" style="height: 25px;">
            <option value="1"  selected>Si</option>
            <option value="0"  selected>No</option>
          </select>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">Estado físico</label>
          <select placeholder="" type="text" class="validate" id="edofisico_tuberia" name="edofisico_tuberia" style="height: 25px;">
            <option value="Bueno"  selected>Bueno</option>
            <option value="Regular"  selected>Regular</option>
            <option value="Malo"  selected>Malo</option>
            <option value="No Sirve"  selected>No Sirve</option>
          </select>
        </div>
        <div class="input-field col s9">
          <textarea placeholder="Observaciones" style="width: 90%; height: 100px; overflow:auto;resize:none" name="observaciones_fe" id="observaciones_fe" value=""></textarea>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Punto de macromedción</label>
          <select class="browser-default" id="id_mac_fe" name="id_mac_fe">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($puntosmac as $mac){ ?>
            <option value="<?php echo $mac['id_mac']; ?>"><?php echo $mac['id_mac']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Distrito</label>
          <select class="browser-default" id="id_dis_sc" name="id_ib_bomba">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($distrito as $dis){ ?>
            <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
    </div>
    <div>
        <button type="submit" >Registrar</button>
        <button class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END insert Transformador-->

<!-- Section to insert Tubería-->
<div>
<form method="post" action="<?php echo base_url()?>record_controller/">
  <ul  id="create-tuberia" class="side-nav " style="width: 420px;">
    <p class="tituloOpc">Formulario de Tuberías</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
         <div class="row col s9" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Diámetro</label>
          <select placeholder="" type="text" class="browser-default" id="diametro_tuberia" name="diametro_tuberia" " required>
            <option value="2"  selected>2"</option>
            <option value="3"  selected>3"</option>
            <option value="4"  selected>4"</option>
            <option value="6"  selected>6"</option>
            <option value="8"  selected>8"</option>
            <option value="12"  selected>12"</option>
          </select>
        </div>
        <div class="input-field col s9"> 
          <input placeholder="" type="number" min="0" step="any" class="validate" id="longitud_tuberia" name="longitud_tuberia" style="height: 25px;" required>
          <label for="temporal">Longitud total</label>
        </div>
        <div class="row col s9" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Distrito</label>
          <select class="browser-default" id="dis_tuberia" name="dis_tuberia" required>
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($distrito as $dis){ ?>
            <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
    </div>
    <div>
      <button  id="" onclick="">Registrar</button>
      <input id="" type="button" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');" value="Cancelar">
      <input id="opacidad1" type="button" class="" onclick="opacidad();" value="Ver">
    </div>
  </ul>
  </form>
</div>
<!-- END insert Tubería-->
 
<!-- Section to insert Valvulas-->
<div>
<form id="fvalvula" method="post" name="fvalvula" action="<?php echo base_url()?>record_controller/registrar_valvula">
  <ul  id="create-valvula" class="side-nav" style="width: 420px;">
    <p id="titval" class="tituloOpc">Formulario de Valvulas</p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="input-field col s9"> 
          <input placeholder="" type="text" class="validate" id="tipo_val" name="tipo_val" style="height: 25px;">
          <label for="temporal">Tipo</label>
        </div>
        <div class="row col s9"> 
          <label style="margin-left: 10px;">Entrada</label>
          <select placeholder="" class="browser-default" type="text" class="validate" id="entrada_val" name="entrada_val" style="height: 30px;">
            <option value="Bomba"  selected>Bomba</option>
            <option value="Tanque"  selected>Tanque</option>
            <option value="Sector"  selected>Sector</option>
            <option value="Subsector"  selected>Subsector</option>
            <option value="Distrito"  selected>Distrito</option>
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_1_1">
          <label style="margin-left: 10px;">Bomba</label>
          <select class="browser-default" id="id1_1" name="id1_1">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($bombas as $bomb){ ?>
            <option value="<?php echo $bomb['id_bomba']; ?>"><?php echo $bomb['num_serie_bomba']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_1_2">
          <label style="margin-left: 10px;">Infraesctructura de regularización</label>
          <select class="browser-default" id="id1_2" name="id1_2">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($infrar as $infr){ ?>
            <option value="<?php echo $infr['id_ir']; ?>"><?php echo $infr['nombre_ir']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_1_3">
          <label style="margin-left: 10px;">Sector</label>
          <select class="browser-default" id="id1_3" name="id1_3">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($sector as $sec){ ?>
            <option value="<?php echo $sec['id_sa']; ?>"><?php echo $sec['nombre_sa']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_1_4">
          <label style="margin-left: 10px;">Subesector</label>
          <select class="browser-default" id="id1_4" name="id1_4">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($subsector as $sub){ ?>
            <option value="<?php echo $sub['id_sub']; ?>"><?php echo $sub['nombre_sub']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_1_5">
          <label style="margin-left: 10px;">Distrito</label>
          <select class="browser-default" id="id1_5" name="id1_5">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($distrito as $dis){ ?>
            <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="input-field col s9"> 
          <label style="margin-left: 10px;">Salida</label><br>
          <select placeholder="" class="browser-default" type="text" class="validate" id="salida_val" name="salida_val" style="height: 30px;">
            <option value="Bomba"  selected>Bomba</option>
            <option value="Tanque"  selected>Tanque</option>
            <option value="Sector"  selected>Sector</option>
            <option value="Subsector"  selected>Subsector</option>
            <option value="Distrito"  selected>Distrito</option>
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_2_1">
          <label style="margin-left: 10px;">Bomba</label>
          <select class="browser-default" id="id2_1" name="id2_1">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($bombas as $bomb){ ?>
            <option value="<?php echo $bomb['id_bomba']; ?>"><?php echo $bomb['num_serie_bomba']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_2_2">
          <label style="margin-left: 10px;">Infraesctructura de regularización</label>
          <select class="browser-default" id="id2_2" name="id2_2">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($infrar as $infr){ ?>
            <option value="<?php echo $infr['id_ir']; ?>"><?php echo $infr['nombre_ir']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_2_3">
          <label style="margin-left: 10px;">Sector</label>
          <select class="browser-default" id="id2_3" name="id2_3">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($sector as $sec){ ?>
            <option value="<?php echo $sec['id_sa']; ?>"><?php echo $sec['nombre_sa']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_2_4">
          <label style="margin-left: 10px;">Subesector</label>
          <select class="browser-default" id="id2_4" name="id2_4">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($subsector as $sub){ ?>
            <option value="<?php echo $sub['id_sub']; ?>"><?php echo $sub['nombre_sub']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="row col s9" style="display:none; margin-bottom: 0px;" id="id_2_5">
          <label style="margin-left: 10px;">Distrito</label>
          <select class="browser-default" id="id2_5" name="id2_5">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($distrito as $dis){ ?>
            <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <div class="input-field col s9">
          <textarea style="width: 90%; height: 100px; overflow:auto;resize:none" name="observaciones_toma" id="observaciones_toma" value=""></textarea>
          <label for="temporal">Observaciones</label>
        </div>
        <div class="input-field col s9">
          <input placeholder="" step="any" type="number" class="validate" id="latitud_val" name="latitud_val" style="height: 25px;">
          <label for="temporal">Latitud de la valvula (coordenada)</label>
        </div>
        <div class="input-field col s9"> 
          <input placeholder="" step="any" type="number" class="validate" id="longitud_val" name="longitud_val" style="height: 25px;">
          <label for="temporal">Longitud de la fuente (coordenada)</label>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
          <label style="margin-left: 10px;">Distrito</label>
          <select class="browser-default" id="id_dis_val" name="id_dis_val">
            <option value="" disabled selected>Seleccione una opcion...</option>
            <?php 
            foreach($distrito as $dis){ ?>
            <option value="<?php echo $dis['id_dis']; ?>"><?php echo $dis['nombre_dis']; ?></option>
            <?php
            }
            ?>  
          </select>
        </div>
        <input  type="number" class="validate" id="id_entr" name="id_entr" style="display:none;">
        <input  type="number" class="validate" id="id_sal" name="id_sal" style="display:none;">
    </div>
    <div>
        <button id="edit_val" onclick="enviarval()">Registrar</button>
        <button id="cancel_val" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
    <input  type="number" class="validate" id="id_edit_val" name="id_edit_val" style="display:none;">
  </ul>
  </form>
</div>
<!-- END insert Valvulas-->

<!-- Section Mostrar información de distritos-->
<div>
<form id="" method="post" name="">
  <ul  id="mostrar-distrito" class="side-nav" style="width: 420px;">
    <p id="Mdis" class="tituloOpc"></p>
    <div class="divider"></div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="input-field col s9"> 
          <input placeholder="" type="text" class="validate" id="tipo_val" name="tipo_val" style="height: 25px;">
          <label for="temporal">Tipo</label>
        </div>
        <div class="row col s6" style="margin-bottom: 0px;">
         <table>
        <thead>
          <tr>
              <th>Name</th>
              <th>Item Name</th>
              <th>Item Price</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>
            <td>$0.87</td>
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
            <td>$3.76</td>
          </tr>
          <tr>
            <td>Jonathan</td>
            <td>Lollipop</td>
            <td>$7.00</td>
          </tr>
        </tbody>
      </table>
        </div>
    </div>
    <div>
        <button id="" onclick="">Registrar</button>
        <button id="" class=" modal-close cancel" onclick="$('.button-collapse').sideNav('hide');">Cancelar</button>
    </div>
  </ul>
  </form>
</div>
<!-- END Mostrar información de distritos-->

<!-- Section para CargarPolis-->
<div >
  <ul  id="" style="display:none;">
    <div>
     <?php
      $count=0;  
      foreach($sector as $sec){
      $count=$count+1; 
      $coord='';
      $ban=0; 
      $nom=$sec['nombre_sa'];
      $s="Polis/".$sec['id_sa'].$sec['nombre_sa'].".txt";
      $fp = fopen($s, "r");
      while ($line = fgets($fp)) {
        if($ban==0){
         $coord=$line;
         $ban=1;
        }else
        $coord=$coord."\n".$line;
        
      }
      echo "$count = $nom";
      fclose($fp);
      ?>
      <input type="number" id="<?php echo 'sectores'.$count; ?>" value="<?php echo $sec['id_sa'];?>">
      <textarea linea1="<?php echo $sec['colorlinea_sa']; ?>" linea2="<?php echo $sec['colorfondo_sa']; ?>" id="<?php echo 'sec'.$sec['id_sa']; ?>" name="<?php echo $sec['nombre_sa']; ?>" value=""><?php echo $coord; ?></textarea>
      <input type="text" id="<?php echo 'lsec'.$sec['id_sa']; ?>" value="<?php echo $sec['colorlinea_sa']; ?>">
      <input type="text" id="<?php echo 'fsec'.$sec['id_sa']; ?>" value="<?php echo $sec['colorfondo_sa']; ?>">
      <?php
      }
      ?>
      <input type="number" id="sec" value="<?php echo $count; ?>">

      <?php
      $count=0;  
      foreach($subsector as $sub){
      $count=$count+1; 
      $coord='';
      $ban=0;  
      $s="Polis/".$sub['id_sub'].$sub['nombre_sub'].".txt";
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
      <input type="number" id="<?php echo 'subsectores'.$count; ?>" value="<?php echo $sub['id_sub'];?>">
      <textarea linea1="<?php echo $sub['colorlinea_sub']; ?>" linea2="<?php echo $sub['colorfondo_sub']; ?>" id="<?php echo 'sub'.$sub['id_sub']; ?>" name="<?php echo $sub['nombre_sub']; ?>" value=""><?php echo $coord; ?></textarea>
      <input type="text" id="<?php echo 'lsub'.$sub['id_sub']; ?>" value="<?php echo $sub['colorlinea_sub']; ?>">
      <input type="text" id="<?php echo 'fsub'.$sub['id_sub']; ?>" value="<?php echo $sub['colorfondo_sub']; ?>">
      <?php
      }
      ?>
      <input type="number" id="sub" value="<?php echo $count; ?>">

      <?php
      $count=0;  
      foreach($distrito as $dis){
      $count=$count+1; 
      $coord='';
      $ban=0;  
      $s="Polis/".$dis['id_dis'].$dis['nombre_dis'].".txt";
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
      <input type="number" id="<?php echo 'distritos'.$count; ?>" value="<?php echo $dis['id_dis'];?>">
      <textarea linea1="<?php echo $dis['colorlinea_dis']; ?>" linea2="<?php echo $dis['colorfondo_dis']; ?>" id="<?php echo 'dis'.$dis['id_dis']; ?>" name="<?php echo $dis['nombre_dis']; ?>" value=""><?php echo $coord; ?></textarea>
      <input type="text" id="<?php echo 'ldis'.$dis['id_dis']; ?>" value="<?php echo $dis['colorlinea_dis']; ?>">
      <input type="text" id="<?php echo 'fdis'.$dis['id_dis']; ?>" value="<?php echo $dis['colorfondo_dis']; ?>">
      <?php
      }
      ?>
      <input type="number" id="dis" value="<?php echo $count; ?>">

      <button id="cargarpolismapa" onclick="mostrartodopolis()"></button>
    </div>
  </ul>
</div>
<!-- END  CargarPolis-->
<form method="post" action="<?php echo base_url()?>Gissat_mty/map_mty_detalle" style="display: none">
  <input type="number" min="0" id="detalledis" name="detalledis">
  <button id="buttondetalledis" type="submit"></button>
</form>

<!--Eliminar Poligono-->
<div id="elimpoli" class="modal modal-fixed-footer" style="max-height:40%; width: 35% ">
  <div class="modal-content">
    <p class="tituloOpc">Eliminar</p>
    <p>¿Desea eliminar el Elemento siguiente?</p>
    <div class="modal-content">
    <label id="tipoPoli"></label><br>
    <label id="idPoli"></label><br>
    <label id="nombrePoli"></label><br>
    <label style="display:none;" id="id2" value=" "></label><br>
  </div>
  </div>
  
  <div class="modal-footer">
    
    <a href="#!"  class=" modal-action modal-close waves-effect waves-red btn-flat" id="" onclick="cancelborrarsel();" style="color:red;">Cancelar</a>
    <a href="#!"  class=" modal-action modal-close waves-effect waves-red btn-flat" id="" style="color:red;">No</a>
     <a href="#!"  onclick="elimpoli()" style="color:blue;" class="modal-action modal-close waves-effect waves-green btn-flat button-collapse"><input id="" value="" type="text" name="" style="display: none;">Si</a>
  </div>
</div>
<!-- END  Eliminar Poligono-->

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
<a href="#!" data-activates="create-tuberia"  style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="abre-tuberia"></a>
<a href="#!" data-activates="mostrar-distrito"  style="display: none" class="modal modal-action modal-trigger modal-close button-collapse" id="muestra-distrito"></a>
<a href="#elimpoli" style="display: none" class="modal modal-action modal-trigger" id="irelimpoli"></a>
<a id="eliminarpoligono" href="#!" name="eliminarpoligono" style="display: none"></a>
<!-- END  anclas para formularios-->

<!-- Fin del contenido-->
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/funciones_map_mty.js"></script>
  <script src="../js/materialize.min.js"></script>
  <script src="../js/jscolor-2.0.4/jscolor.min.js"></script>
<!-- MAP -->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9of83BBAodWNqORjW4ug9Jw6dXwQnV7M"></script>
   <script src="../js/API/map_mty.js"></script>
<!-- Script del mapa-->
  </body>
</html>


