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
<?php foreach ($distrito as $dis) {
  
?>
    <nav style="height: 30px;">
      <div class="nav-wrapper teal accent-3" style="margin-top: 10px;">
      <h6 style="line-height: 30px;" colspan="4"  class="black-text center-align"><?php echo str_replace("_", " ", $dis['nombre_dis']);?></h6>
      </div>
    </nav>

<!-- Start OVERFLOW-->
    <div class="overflow"> 
     <div class="col s3" style="width: 100%;">
          <table class="bordered responsive-table">
            <thead>
              <tr>
                <th colspan="2" class="center-align tablehead-1">Datos generales</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: left;" class="tablecontent left">Población</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format ($dis['poblacion']) ?> Hab</td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Usuarios</td>
                <td style="text-align: right;" class="tablecontent "><?php echo number_format($dis['usuarios']) ?> Tomas</td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Tomas domiciliarias</td>
                <td style="text-align: right;" class="tablecontent "><?php echo number_format($dis['tomas_domiciliarias']) ?> Tomas</td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Punto de suministro</td>
                <td style="text-align: right;" class="tablecontent"><?php echo $dis['punto_suministro'] ?></td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Tipo de servicio</td>
                <td style="text-align: right;" class="tablecontent"><?php $dis['tipo_servicio'] ?></td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Cobertura de macromedición</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($dis['cobertura'],2) ?>%</td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Área</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format( $dis['area'],2) ?> Km</td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Elevación máxima</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($dis['elevacion_max'],2) ?> m</td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Elevación media</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($dis['elevacion_med'],2) ?> m</td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Elevación minima</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($dis['elevacion_min'],2) ?> m</td>
              </tr>
            </tbody>
          </table>
           <table class="bordered responsive-table">
            <thead>
              <tr>
                <th colspan="2"  class="center-align tablehead-1">Longitud de red por diámetro</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: left;" class="tablecontent">2"</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($tuberia[0],3)?> Km</td>
              </tr>
               <tr>
                <td style="text-align: left;" class="tablecontent">3"</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($tuberia[1],3) ?> Km</td>
              </tr>
                <td style="text-align: left;" class="tablecontent">4"</td>
                <td style="text-align: right;"class="tablecontent"><?php echo number_format($tuberia[2],3) ?> Km</td>
               <tr>
                <td style="text-align: left;" class="tablecontent">6"</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($tuberia[3],3) ?> Km</td>
              </tr>
               <tr>
                <td style="text-align: left;" class="tablecontent">8"</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($tuberia[4],3) ?> Km</td>
              </tr>
               <tr>
                <td style="text-align: left;" class="tablecontent">12"</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($tuberia[5],3) ?> Km</td>
              </tr>
            </tbody>
          </table>
           <table class="bordered responsive-table">
            <thead>
              <tr>
                <th colspan="2" class="center-align tablehead-1">Promedio de Fugas por año</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: left;" class="tablecontent">En red</td>
                <td style="text-align: right;" class="tablecontent"><?php echo $dis['fugas_red'] ?></td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">En tomas</td>
                <td style="text-align: right;" class="tablecontent"><?php echo $dis['fugas_toma'] ?></td>
              </tr>
            </tbody>
          </table>
           <table class="bordered responsive-table">
            <thead>
              <tr>
                <th colspan="4" class="center-align tablehead-1">Consumo anual promedio</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <tr>
                <td></td><td style="text-align: right;" >Volumen m³/año</td><td style="text-align: right;">Caudal L/s</td>
                </tr> 
                <td style="text-align: left;"class="tablecontent">Servicio medido</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($dis['servicio_medido_vol'],2) ?></td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($dis['servicio_medido_caudal'],2) ?></td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Servicio de cuota fija</td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($dis['servicio_cf_vol'],2) ?></td>
                <td style="text-align: right;" class="tablecontent"><?php echo number_format($dis['servicio_cf_caudal'],2) ?></td>
              </tr>
              <tr>
                <td style="text-align: left;" class="tablecontent">Totales</td>
                <td style="text-align: right;" class="tablecontent"><?php $sum=$dis['servicio_cf_vol']+$dis['servicio_medido_vol'];  echo number_format( $sum ,2)?></td>
                <td style="text-align: right;" class="tablecontent"><?php $sum1= $dis['servicio_medido_caudal']+ $dis['servicio_cf_caudal']; echo number_format($sum1,2)?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col s3">
         
        </div>   
    </div>
    
  <!-- END OVERFLOW -->
<?php } ?>
    </div><!--END  Div3-->
    

  <div class="col s9">
    <div class="google-maps map" id="map">
      
    </div>
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
   <script src="../js/API/map_mty_detalle.js"></script>
<!-- Script del mapa-->
  </body>
</html>


