<?php

class edit_model extends CI_Model {
 
   public function __construct() {
      parent::__construct();
      $this->load->database();
   }

   function modificar_distritoss($id){
    $this->db->where('id_dis',$id);
    return $this->db->delete('distrito');
   }

   function update_Padron($id, $nombre, $app_u, $apm_u, $num_ext, $num_int, $colonia,$localidad, $municipio, $cp, $tipo_servicio, $estado_uso, $num_catastro, $observaciones, 	$latitud, $longitud){

   		$data = array(
			"nombre_u" => $nombre,//agregar nuevos campos
      "app_u" => $app_u,
      "apm_u" => $apm_u,
			"tipo_servicio_u" => $tipo_servicio,
			"numero_ext_u" => $num_ext,
			"numero_int_u" => $num_int,
			"colonia_u" => $colonia,
			"localidad_u" => $localidad,
			"municipio_u" => $municipio,
			"cp_u" => $cp,
			"num_catastro_u" => $num_catastro,
			"estado_u" => $estado_uso,
			"observaciones_u" => $observaciones,
			"latitud_u" => $latitud,
			"longitud_u" => $longitud
			);
   		$this->db->where("id_padron_u",$id);
		  $this->db->update('usuario', $data);
   }
/**
    * Edita un registro de distrito
    * @param  [type] $id_dis         [description]
    * @param  [type] $nombre_dis     [description]
    * @param  [type] $colorlinea_dis [description]
    * @param  [type] $colorfondo_dis [description]
    * @return [type]                 [description]
    */
   function modificar_distrito($id_dis,$nombre_dis,$colorlinea_dis, $colorfondo_dis){
    $data = array(
      'nombre_dis' => $nombre_dis,
      'colorlinea_dis' => $colorlinea_dis,
      'colorfondo_dis' => $colorfondo_dis,
      );
    $this->db->where('id_dis',$id_dis);
    return $this->db->update('distrito',$data);
   }
   /**
    * Edita un registro de subsector
    * @param  [type] $id_sub         [description]
    * @param  [type] $nombre_sub     [description]
    * @param  [type] $colorlinea_sub [description]
    * @param  [type] $colorfondo_sub [description]
    * @param  [type] $idsec          [description]
    * @return [type]                 [description]
    */
   function modificar_subsector($id_sub,$nombre_sub,$colorlinea_sub, $colorfondo_sub,$idsec){
    $data = array(
      'nombre_sub' => $nombre_sub,
      'colorlinea_sub' => $colorlinea_sub,
      'colorfondo_sub' => $colorfondo_sub,
      'id_sa_sub' => $idsec
      );
    $this->db->where('id_sub',$id_sub);
    return $this->db->update('subsector',$data);
   }
   /**
    * Edita un registro de sector abastecimiento
    * @param  [type] $id_sa         [description]
    * @param  [type] $nombre_sa     [description]
    * @param  [type] $colorlinea_sa [description]
    * @param  [type] $colorfondo_sa [description]
    * @return [type]                [description]
    */
   function modificar_sa($id_sa,$nombre_sa,$colorlinea_sa, $colorfondo_sa){
    $data = array(
      'nombre_sa' => $nombre_sa,
      'colorlinea_sa' => $colorlinea_sa,
      'colorfondo_sa' => $colorfondo_sa
      );
    $this->db->where('id_sa',$id_sa);
    return $this->db->update('sector_abastecimiento',$data);
   }
   /**
    * Edita un registro de infraestructura de regularizacion
    * @param  [type] $id            [description]
    * @param  [type] $tipo          [description]
    * @param  [type] $funcion       [description]
    * @param  [type] $material      [description]
    * @param  [type] $nombre        [description]
    * @param  [type] $elevacion     [description]
    * @param  [type] $ndp           [description]
    * @param  [type] $volumen       [description]
    * @param  [type] $h_total       [description]
    * @param  [type] $h             [description]
    * @param  [type] $ni_min        [description]
    * @param  [type] $fecha         [description]
    * @param  [type] $observaciones [description]
    * @param  [type] $latitud       [description]
    * @param  [type] $longitud      [description]
    * @param  [type] $id_dis        [description]
    * @return [type]                [description]
    */
   function modificar_tanque($id,$tipo,$funcion, $material, $nombre, $elevacion, $ndp, $volumen,$h_total,$h,$ni_min,$fecha,$observaciones,$latitud,$longitud,$id_dis){
    $data = array(
      'tipo_ir' => $tipo,
      'funcion_ir' => $funcion,
      'material_ir' => $material,
      'nombre_ir' => $nombre,
      'elevacion_ir' => $elevacion,
      'ndp_ir' => $ndp,
      'volumen_ir' => $volumen,
      'h_total_ir' => $h_total,
      'h_ir' => $h,
      'ni_min_ir' => $ni_min,
      'fecha_ir' => $fecha,
      'observaciones_ir' => $observaciones,
      'latitud_ir' => $latitud,
      'longitud_ir' => $longitud,
      'id_dis_ir' => $id_dis
      );
    $this->db->where('id_ir',$id);
    return $this->db->update('infraestructura_regularizacion',$data);
   }
   /**
    * Edita un registro de valvula
    * @param  [type] $id            [description]
    * @param  [type] $tipo          [description]
    * @param  [type] $entrada       [description]
    * @param  [type] $salida        [description]
    * @param  [type] $identrada     [description]
    * @param  [type] $idsalida      [description]
    * @param  [type] $observaciones [description]
    * @param  [type] $latitud       [description]
    * @param  [type] $longitud      [description]
    * @param  [type] $id_dis        [description]
    * @return [type]                [description]
    */
   function modificar_valvula($id,$tipo,$entrada, $salida, $identrada, $idsalida,$observaciones,$latitud,$longitud,$id_dis){
    $data = array(
      'tipo_val' => $tipo,
      'entrada_val' => $entrada,
      'salida_val' => $salida,
      'id_entrada_val' => $identrada,
      'id_salida_val' => $idsalida,
      'observaciones_val' => $observaciones,
      'latitud_val' => $latitud,
      'longitud_val' => $longitud,
      'id_dis_val' => $id_dis
      );
    $this->db->where('id_val',$id);
    return $this->db->update('valvulas',$data);
   }
   /**
    * Edita un registro de pozo profundo y fuentes de extraccion
    * @param  [type] $id1           [description]
    * @param  [type] $nombre        [description]
    * @param  [type] $alturam       [description]
    * @param  [type] $observaciones [description]
    * @param  [type] $latitud       [description]
    * @param  [type] $longitud      [description]
    * @param  [type] $mac           [description]
    * @param  [type] $dis           [description]
    * @param  [type] $id2           [description]
    * @param  [type] $fecha         [description]
    * @param  [type] $diametroc     [description]
    * @param  [type] $diametroa     [description]
    * @param  [type] $prof          [description]
    * @return [type]                [description]
    */
   function modificar_pozo($id1,$nombre, $alturam,$observaciones,$latitud,$longitud,$mac,$dis,$id2,$fecha,$diametroc,$diametroa,$prof){
    $data1 = array(
      'nombre_fe' => $nombre,
      'altura_manometro_fe' => $alturam,
      'observaciones_fe' => $observaciones,
      'latitud_fe' => $latitud,
      'longitud_fe' => $longitud,
      'id_mac_fe' => $mac,
      'id_dis_fe' => $dis
      );
     $data2 = array(
      'fcolocacion_pf' => $fecha,
      'dcolumna_pf' => $diametroc,
      'dademe_pf' => $diametroa,
      'profpozo_pf' => $prof
      );
    $this->db->where('id_fe',$id1);
    $this->db->update('fuentes_extraccion',$data1);
    $this->db->where('id_pf',$id2);
    return $this->db->update('pozos_profundos',$data2);
   }
   /**
    * Edita un registro de bombeo
    * @param  [type] $id            [description]
    * @param  [type] $nombre        [description]
    * @param  [type] $estacion      [description]
    * @param  [type] $equipo        [description]
    * @param  [type] $observaciones [description]
    * @param  [type] $latitud       [description]
    * @param  [type] $longitud      [description]
    * @param  [type] $id_fe         [description]
    * @param  [type] $id_ar         [description]
    * @param  [type] $id_pr         [description]
    * @param  [type] $id_dis        [description]
    * @return [type]                [description]
    */
   function modificar_bombeo($id,$nombre,$estacion, $equipo, $observaciones,$latitud,$longitud,$id_fe,$id_ar,$id_pr,$id_dis){
    $data = array(
      'nombre_ib' => $nombre,
      'estacion_ib' => $estacion,
      'equipo_ib' => $equipo,
      'observaciones_ib' => $observaciones,
      'latitud_ib' => $latitud,
      'longitud_ib' => $longitud,
      'id_fe_ib' => $id_fe,
      'id_ar_ib' => $id_ar,
      'id_pr_ib' => $id_pr,
      'id_dis_ib' => $id_dis
      );
    $this->db->where('id_ib',$id);
    return $this->db->update('infraestructura_bombeo',$data);
   }

   /**
    * Recibe y actualiza la informacion a la tabla "fuentes_extraccion" de la base de datos
    * @param  [int] $id   [identificador del elemento a actualizar]
    * @param  [Array] $data [Arreglo de elementos a actualizar]
    * @return [NA]       [Sin valor de retorno]
    */
   function update_fuentes_extraccion($id,$data){
	   	$this->db->where("id_fe",$id);
		  $this->db->update('fuentes_extraccion', $data);
   }

   /**
    * Recibe y actualiza la informacion a la tabla "infraestructura_bombeo" de la base de datos
    * @param  [int] $id   [identificador del elemento a actualizar]
    * @param  [Array] $data [Arreglo de elementos a actualizar]
    * @return [NA]       [Sin valor de retorno]
    */
   function update_infraestructura_bombeo($id,$data){
	   	$this->db->where("id_ib",$id);
		  $this->db->update('infraestructura_bombeo', $data);
   }

   /**
    * Recibe y actualiza la informacion a la tabla "infraestructura_regularizacion" de la base de datos
    * @param  [int] $id   [identificador del elemento a actualizar]
    * @param  [Array] $data [Arreglo de elementos a actualizar]
    * @return [NA]       [Sin valor de retorno]
    */
   function update_infraestructura_regulacion($id,$data){
	   	$this->db->where("id_ir",$id);
		  $this->db->update('infraestructura_regularizacion', $data);
   }

   /**
    * Recibe y actualiza la informacion a la tabla "valvulas" de la base de datos
    * @param  [int] $id   [identificador del elemento a actualizar]
    * @param  [Array] $data [Arreglo de elementos a actualizar]
    * @return [NA]       [Sin valor de retorno]
    */
   function update_valvula($id,$data){
	   	$this->db->where("id_val",$id);
		  $this->db->update('valvulas', $data);
   }

   /**
    * Recibe y actualiza la informacion a la tabla "users" de la base de datos
    * @param  [int] $id   [identificador del elemento a actualizar]
    * @param  [Array] $data [Arreglo de elementos a actualizar]
    * @return [NA]       [Sin valor de retorno]
    */
   function update_user($id,$data){
	   	$this->db->where("id_user",$id);
		  $this->db->update('users', $data);
   }

   /**
    * Recibe y actualiza la informacion a la tabla "tuberias" de la base de datos
    * @param  [int] $id   [identificador del elemento a actualizar]
    * @param  [Array] $data [Arreglo de elementos a actualizar]
    * @return [NA]       [Sin valor de retorno]
    */
   function update_tube($id,$data){
      $this->db->where("idtuberia",$id);
      $this->db->update('tuberia', $data);
   }


   //////////////// NUEVAS FUNCIONES DE UPDATE PARA LA NUEVA SECCION DE GISSAT
   
   function update_allPesion($id, $data){
      $this->db->where("id_subsector",$id);
      $this->db->update('Horario_op', $data);
   }
}