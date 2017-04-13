<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class edit_controller extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * [modificar_distrito description]
	 * @return [type] [description]
	 */
	function modificar_distrito(){
		$id = $this->input->post('nombre_dis');
		$nombre = $this->input->post('id_sub_dis');
		$this->load->model('edit_model');

		$edit = $this->edit_model->modificar_distrito($id);
		$this->session->set_flashdata('actualizado', 'El distrito se registro correctamente');
		redirect(base_url().'gissat/temporal');
	}

/**
	 * Edita un distrito
	 * @return [type] [description]
	 */
	function editar_distrito(){
		$id_dis = $this->input->post('id_dis');
		$nombre_dis = $this->input->post('nombre_dis');
		$colorlinea_dis=$this->input->post('clinea1_1');
		$colorfondo_dis=$this->input->post('crrelleno1_1');
		$s="Polis/".$id_dis.$nombre_dis.".txt";
		$fp = fopen($s, "w");
		$coord= $this->input->post('acoordenadas1');
		fputs($fp,$coord);
		fclose($fp);
		$this->load->model('edit_model');
		$edit = $this->edit_model->modificar_distrito($id_dis,$nombre_dis,$colorlinea_dis, $colorfondo_dis);
		$this->session->set_flashdata('actualizado', 'El distrito se actualizó correctamente');
		redirect(base_url().'gissat/map');
	}
	/**
	 * Edita el subsector
	 * @return [type] [description]
	 */
	function editar_subsector(){
		$id_sub = $this->input->post('id_sub_edit');
		$nombre_sub = $this->input->post('nombre_sub');
		$colorlinea_sub=$this->input->post('clinea2_1');
		$colorfondo_sub=$this->input->post('crrelleno2_1');
		$s="Polis/".$id_sub.$nombre_sub.".txt";
		$fp = fopen($s, "w");
		$coord= $this->input->post('acoordenadas2');
		fputs($fp,$coord);
		fclose($fp);
		$idsec=$this->input->post('id_sa_sub');
		$this->load->model('edit_model');
		$edit = $this->edit_model->modificar_subsector($id_sub,$nombre_sub,$colorlinea_sub, $colorfondo_sub,$idsec);
		$this->session->set_flashdata('actualizado', 'El subsector se actualizó correctamente');
		redirect(base_url().'gissat/map');
	}
	/**
	 * Edita el sector abastecimiento
	 * @return [type] [description]
	 */
	function editar_sector(){
		$id_sa = $this->input->post('id_sa');
		$nombre_sa = $this->input->post('nombre_sa');
		$colorlinea_sa=$this->input->post('clinea3_1');
		$colorfondo_sa=$this->input->post('crrelleno3_1');
		$s="Polis/".$id_sa.$nombre_sa.".txt";
		$fp = fopen($s, "w");
		$coord= $this->input->post('acoordenadas3');
		fputs($fp,$coord);
		fclose($fp);
		$this->load->model('edit_model');
		$edit = $this->edit_model->modificar_sa($id_sa,$nombre_sa,$colorlinea_sa, $colorfondo_sa);
		$this->session->set_flashdata('actualizado', 'El sector se actualizó correctamente');
		redirect(base_url().'gissat/map');
	}
	/**
	 * Edita el tanque
	 * @return [type] [description]
	 */
	function editar_tanque(){
		$id = $this->input->post('id_edit_ir');
		$tipo = $this->input->post('tipo_ir');
		$funcion = $this->input->post('funcion_ir');
		$material = $this->input->post('material_ir');
		$nombre = $this->input->post('nombre_ir');
		$elevacion = $this->input->post('elevacion_ir');
		$ndp = $this->input->post('ndp_ir');
		$volumen = $this->input->post('volumen_ir');
		$h_total = $this->input->post('h_total_ir');
		$h = $this->input->post('h_ir');
		$ni_min = $this->input->post('ni_min_ir');
		$fecha = $this->input->post('fecha_ir');
		$observaciones = $this->input->post('observaciones_ir');
		$latitud = $this->input->post('latitud_ir');
		$longitud = $this->input->post('longitud_ir');
		$id_dis = $this->input->post('id_dis_ir');
		$this->load->model('edit_model');
		$edit = $this->edit_model->modificar_tanque($id,$tipo,$funcion, $material, $nombre, $elevacion, $ndp, $volumen,$h_total,$h,$ni_min,$fecha,$observaciones,$latitud,$longitud,$id_dis);
		if($edit==true){
		}
		elseif($edit==false)
		{
			
		}	
		$this->session->set_flashdata('actualizado', 'El tanque se actualizó correctamente');
		 
		redirect(base_url().'gissat/map');
	}
	/**
	 * Edita la válvula
	 * @return [type] [description]
	 */
	function editar_valvula(){
		$id = $this->input->post('id_edit_val');
		$tipo = $this->input->post('tipo_val');
		$entrada = $this->input->post('entrada_val');
		$salida = $this->input->post('salida_val');
		$identrada = $this->input->post('id_entrada_val');
		$idsalida = $this->input->post('id_salida_val');
		$observaciones = $this->input->post('observaciones_val');
		$latitud = $this->input->post('latitud_val');
		$longitud = $this->input->post('longitud_val');
		$id_dis = $this->input->post('id_dis_val');
		$this->load->model('edit_model');
		$edit = $this->edit_model->modificar_valvula($id,$tipo,$entrada, $salida, $identrada, $idsalida,$observaciones,$latitud,$longitud,$id_dis);
		$this->session->set_flashdata('actualizado', 'La válvula se actualizó correctamente');
		redirect(base_url().'gissat/map');
	}
	/**
	 * Edita el pozo
	 * @return [type] [description]
	 */
	function editar_pozo(){
		$id1= $this->input->post('id_edit_fe');
		$nombre = $this->input->post('nombre_fe1');
		$alturam=$this->input->post('altura_manometro_fe1');
		$observaciones=$this->input->post('observaciones_fe1');
		$latitud=$this->input->post('latitud_fe1');
		$longitud=$this->input->post('longitud_fe1');
		$mac=$this->input->post('id_mac_fe1');
		$dis=$this->input->post('id_dis_fe1');
		
		$id2= $this->input->post('id_edit_pozo');
		$fecha=$this->input->post('fcolocacion_pf');
		$diametroc=$this->input->post('dcolumna_pf');
		$diametroa=$this->input->post('dademe_pf');
		$prof=$this->input->post('profpozo_pf');
		$this->load->model('edit_model');
		$edit = $this->edit_model->modificar_pozo($id1,$nombre, $alturam,$observaciones,$latitud,$longitud,$mac,$dis,$id2,$fecha,$diametroc,$diametroa,$prof);
		$this->session->set_flashdata('actualizado', 'El pozo se actualizó correctamente');
		redirect(base_url().'gissat/map');
	}
	/**
	 * Edita el bombeo
	 * @return [type] [description]
	 */
	function editar_bombeo(){
		$id = $this->input->post('id_edit_ib');
		$nombre = $this->input->post('nombre_ib');
		$estacion = $this->input->post('estacion_ib');
		$equipo = $this->input->post('equipo_ib');
		$observaciones = $this->input->post('observaciones_ib');
		$latitud = $this->input->post('latitud_ib');
		$longitud = $this->input->post('longitud_ib');
		$id_fe = $this->input->post('id_fe_ib');
		$id_ar = $this->input->post('id_ar_ib');
		$id_pr = $this->input->post('id_pr_ib');
		$id_dis = $this->input->post('id_dis_ib');

		$this->load->model('edit_model');
		$edit = $this->edit_model->modificar_bombeo($id,$nombre,$estacion, $equipo, $observaciones,$latitud,$longitud,$id_fe,$id_ar,$id_pr,$id_dis);
		$this->session->set_flashdata('actualizado', 'El bombeo se actualizó correctamente');
		redirect(base_url().'gissat/map');
	}

	/**
	 * Actualiza la información de la tabla usuarios
	 * @return [NA] [Sin valor de retorno]
	 */
	function update_padron(){
		$this->load->model('edit_model');
		$id = $this->input->post('id_padron');
		$nombre_u = $this->input->post('nombre_u');
		$apellido_m = $this->input->post('apellido_m');
		$apellido_p = $this->input->post('apellido_p');

		$nombre = $nombre_u.$apellido_m.$apellido_p; //quitar y agregar al modelo
		$num_ext = $this->input->post('num_ext');
		$num_int = $this->input->post('num_int');
		$colonia = $this->input->post('colonia');
		$localidad = $this->input->post('localidad');
		$municipio = $this->input->post('municipio');
		$cp = $this->input->post('cp');
		$tipo_servicio = $this->input->post('tipo_servicio');
		$estado_uso = $this->input->post('estado_uso');
		$num_catastro = $this->input->post('num_catastro');
		$observaciones = $this->input->post('observaciones');
		$latitud = 0;
		$longitud = 0;
		$this->edit_model->update_Padron($id, $nombre_u, $apellido_p, $apellido_m, $num_ext, $num_int, $colonia,$localidad, $municipio, $cp, $tipo_servicio, $estado_uso, $num_catastro, $observaciones, $latitud, $longitud);
		$this->session->set_flashdata('correcto', 'El registro se ha actualizado correctamente');
		redirect(base_url()."Gissat/ver_usuarios");
	}

	/**
	 * Actualiza los campos de la tabla fuentes de extracción
	 * @return [NA] [Sin valor de retorno]
	 */
	function update_fuentes_extraccion(){
		$this->load->model('edit_model');
		$id = $this->input->post('id_fuente');
		$data = array(
			"tipo_fe" => $this->input->post('tipo_fe'),
			"nombre_fe" => $this->input->post('nombre_fe'),
			"altura_manometro_fe" => $this->input->post('altura_manometro_fe'),
			"observaciones_fe" => $this->input->post('observaciones_fe'),
			"latitud_fe" => $this->input->post('latitud_fe'),
			"longitud_fe" => $this->input->post('longitud_fe'),
			"id_mac_fe" => 1,
			"id_dis_fe" => $this->input->post('id_dis'),
			);
		$this->edit_model->update_fuentes_extraccion($id, $data);
		$this->session->set_flashdata('correcto', 'El registro se ha actualizado correctamente');
		redirect(base_url()."Gissat/ver_fuentes_extraccion");
	}
	
	/**
	 * Actualiza los campos de la tabla infraestructura_bombeo
	 * @return [NA] [Sin valor de retorno]
	 */
	function update_infraestructura_bombeo(){
		$this->load->model('edit_model');
		$id = $this->input->post('id_bombeo');

		$data = array(
				"nombre_ib" => $this->input->post('nombre_ib'),
				"estacion_ib" => $this->input->post('estacion_ib'),
				"equipo_ib" => $this->input->post('equipo_ib'),
				"observaciones_ib" => $this->input->post('observaciones_ib'),
				"latitud_ib" => $this->input->post('latitud_ib'),
				"longitud_ib" => $this->input->post('longitud_ib'),
				"id_fe_ib" => $this->input->post('id_fe_ib'),
				"id_ar_ib" => $this->input->post('id_ar_ib'),
				"id_pr_ib" => $this->input->post('id_pr_ib'),
				"id_dis_ib" => $this->input->post('id_dis_ib')
			);
		$this->edit_model->update_infraestructura_bombeo($id, $data);
		$this->session->set_flashdata('correcto', 'El registro se ha actualizado correctamente');
		redirect(base_url()."Gissat/ver_infraestructura_bombeo");
	}

	/**
	 * Actualiza los campos de la tabla infraestructura_regularizacion
	 * @return [NA] [Sin valor de retorno]
	 */
	function update_infraestructura_regularizacion(){
		$this->load->model('edit_model');
		$id = $this->input->post('id_regulacion');

		$data = array(
				"tipo_ir" => $this->input->post('tipo_ir'),
				"funcion_ir" => $this->input->post('funcion_ir'),
				"material_ir" => $this->input->post('material_ir'),
				"nombre_ir" => $this->input->post('nombre_ir'),
				"elevacion_ir" => $this->input->post('elevacion_ir'),
				"ndp_ir" => $this->input->post('npd_ir'),
				"volumen_ir" => $this->input->post('volumen_ir'),
				"h_total_ir" => $this->input->post('h_total_ir'),
				"h_ir" => $this->input->post('h_ir'),
				"ni_min_ir" => $this->input->post('ni_min_ir'),
				//"fecha_ir" => $this->input->post('fecha_ir'),
				"efisico_ir" => $this->input->post('efisico_ir'),
				"observaciones_ir" => $this->input->post('observaciones_ir'),
				"latitud_ir" => $this->input->post('latitud_ir'),
				"longitud_ir" => $this->input->post('longitud_ir'),
				//"id_cc_ir" => $this->input->post('id_cc_ir'),
				"id_dis_ir" => $this->input->post('id_dis_ir')
			);
		$this->edit_model->update_infraestructura_regulacion($id, $data);
		$this->session->set_flashdata('correcto', 'El registro se ha actualizado correctamente');
		redirect(base_url()."Gissat/ver_infraestructura_regulacion");
	}

	/**
	 * Actualiza la información de la tabla valvulas
	 * @return [NA] [Sin valor de retorno]
	 */
	function update_valvula(){
		$this->load->model('edit_model');
		$id = $this->input->post('id_valvula');

		$data = array(
				"tipo_val" => $this->input->post('tipo_val'),
				"ubicacion_val" => $this->input->post('ubicacion_val'),
				"latitud_val" => $this->input->post('latitud_val'),
				"longitud_val" => $this->input->post('latitud_val'),
				"entrada_val" => $this->input->post('entrada_val'),
				"salida_val" => $this->input->post('salida_val'),
				"observaciones_val" => $this->input->post('observaciones_val'),
				"id_entrada_val" => 1,
				"id_salida_val" => 1,
				"id_dis_val" => $this->input->post('id_dis_val')
			);
		$this->edit_model->update_valvula($id, $data);
		$this->session->set_flashdata('correcto', 'El registro se ha actualizado correctamente');
		redirect(base_url()."Gissat/ver_valvula");
	}

	/**
	 * Actualiza la información de usuarios del sistema
	 * @return [NA] [Sin valor de retorno]
	 */
	function update_user(){
		$this->load->model('edit_model');
		$id = $this->input->post('id_user');

		$data = array(
				"nombre_user" => $this->input->post('Ename'),
				"password" => $this->input->post('Epass'),
				"tipo" => $this->input->post('Etipo_user'),
				"email" => $this->input->post('Ecorreo'),
			);
		$this->edit_model->update_user($id, $data);
		$this->session->set_flashdata('correcto', 'El registro se ha actualizado correctamente');
		redirect(base_url()."Gissat/ajustes");
	}

	/**
	 * Actualiza la informacion de la tabla tuberia
	 * @return [NA] [Sin valor de retorno]
	 */
	function update_tube(){
		$this->load->model('edit_model');
		$id = $this->input->post('id_user');

		$data = array(
				"diametro_tuberia" => $this->input->post('Ediametro'),
				"material_tuberia" => $this->input->post('Ematerial'),
				"longitud_tuberia" => $this->input->post('Elong'),
				"tipo_tuberia" => $this->input->post('Etipo'),
				//"fcolocacion_tuberia" => $this->input->post('Ecorreo'),
				"edofisico_tuberia" => $this->input->post('Eestado'),
				"dis_tuberia" => $this->input->post('id_dis'),
				"comentarios_tuberia" => $this->input->post('Ecoment'),
			);
		$this->edit_model->update_tube($id, $data);
		$this->session->set_flashdata('correcto', 'El registro se ha actualizado correctamente');
		redirect(base_url()."Gissat/ver_tuberias");
	}

	/////// FUNCIONES NUEVAS PARA LA NUEVA SECCION DEL GISSAT V.TMP
	
	function update_allPresion(){
		$this->load->model('edit_model');
		$id = $this->input->post('id_sub');

		$data = array(
				"presion" => $this->input->post('presion_ind')
			);
		$this->edit_model->update_allPesion($id, $data);
		$this->session->set_flashdata('correcto', 'El registro se ha actualizado correctamente');
		redirect(base_url()."Gissat_mty/sector_info");
	}
}
