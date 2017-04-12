<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gissat_mty extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * Funcion que permite cargar la vista map
	 * @return [type] [description]
	 */
	public function map(){
		if (!$this->session->userdata('logueado')){
			redirect('');
		}
		else{
			$this->load->model('databasemodel_mty');
			$data = array(
				"data" => 'hola mundo'
			);
			$this->load->view('map', $data);
		}
	}
	
	/**
	 * FUnción que carga la vista relacionada a las tablas con sus datos
	 * @return [type] [description]
	 */
	public function sector_info(){
		$this->load->model('databasemodel_mty');
		//$id = $this->input->post('id');
		$id = 1;
		$info = array();
		$info_tempo = $this->databasemodel_mty->getHorario_data($id);
		$info_circuito = $this->databasemodel_mty->get_circuitoInfo($id);
		$exponente = 1;

		$caudal_min = $this->databasemodel_mty->getMinGasto($id);
		$presion_corresp = $this->databasemodel_mty->getPresion_Gasto($id, $caudal_min['min']);
		$Qmin = $presion_corresp['presion']/10;
		$caudal_nocturno = $this->calculating_consumoNocturno($id);


		$evaluation_result = $this->dataInfo_validate($id);
		if(strcmp($evaluation_result,"presion")==0){
			$this->session->set_flashdata('missing_data', 'No existen información suficiente en la presión');
		}

		$gasto_anterior = 0;
		$perdidas_anterior = 0;
		if(count($info_tempo)>0){
			//array_push($info, $this->evaluate_sector($info_tempo));
			$a = 0;
			foreach ($info_tempo as $item) {
				$id_distrito = $item['id_subsector'];
				$presion_kg = $item['presion']/10;
				$perdidas = ($presion_kg/$Qmin)*($caudal_min['min']-$caudal_nocturno);
				$vol_perdidas = ((($perdidas+$perdidas_anterior)/2)*15*60)/1000;
				if($a<1){
					$circuito = array(
						"id_horario" => 0,
						"fecha_op" => $item['fecha_op'],
						"hora" => "00:00",
						"gasto_suministrado" => $item['gasto_suministrado'],
						"volumen_suministrado" => 0,
						"presion_mca" => $item['presion'],
						"presion_kg" => $presion_kg,
						"caudal_salida" => $item['caudal_salida'],
						"volumen_salida" => '0',
						"perdidas" => number_format($perdidas, 2, '.', ''),
						"volumen_perdidas" => '0',
						"consumo_usuario" => $item['gasto_suministrado']-$item['caudal_salida']-$perdidas
					);
				}
				else{
					$circuito = array(
						"id_horario" => 0,
						"fecha_op" => $item['fecha_op'],
						"hora" => "00:00",
						"gasto_suministrado" => $item['gasto_suministrado'],
						"volumen_suministrado" => ((($item['gasto_suministrado']+$gasto_anterior)/2)*15*60)/1000,
						"presion_mca" => $item['presion'],
						"presion_kg" => $presion_kg,
						"caudal_salida" => $item['caudal_salida'],
						"volumen_salida" => ((($item['caudal_salida']+$caudal_salida_anterior)/2)*15*60)/1000,
						"perdidas" => number_format($perdidas, 2, '.', ''),
						"volumen_perdidas" => number_format($vol_perdidas, 2, '.', ''),
						"consumo_usuario" => $item['gasto_suministrado']-$item['caudal_salida']-$perdidas
					);
				}

				$a++;
				array_push($info, $circuito);
				$gasto_anterior = $item['gasto_suministrado'];
				$caudal_salida_anterior = $item['caudal_salida'];
				$perdidas_anterior = $perdidas;
			}
		}
		else{
			$circuito = array(
				"id_horario" => 0,
				"fecha_op" => "0000-00-00",
				"hora" => "00:00",
				"gasto_suministrado" => '0',
				"volumen_suministrado" => 0,
				"presion_mca" => '0',
				"presion_kg" => '0',
				"caudal_salida" => '0',
				"volumen_salida" => '0',
				"perdidas" => '0',
				"volumen_perdidas" => '0',
				"consumo_usuario" => '0'
			);
			array_push($info, $circuito);
			$this->session->set_flashdata('correcto', 'No hay registros asociados, intente registrar datos usando archivos CSV');
		}
		
		$data = array(
			"info" => $info,
			"id_distrito" => $id_distrito,
			"central" => $info_circuito['nombre_sa'],
			"circuito" => $info_circuito['nombre_dis']
		);
		$this->load->view('sector_info_mty', $data);
	}

	public function load_CSVinfo(){
		$this->load->model('record_Model');
		$tipo = $_FILES['archivo']['type'];
		$tamanio = $_FILES['archivo']['size'];
		$archivotmp = $_FILES['archivo']['tmp_name'];
		$id = 1;

		$result_validate = $this->CSV_file_validate($tipo, $tamanio, $archivotmp);
		
		if($result_validate['gasto'] == false and $result_validate['presion'] == false and $result_validate['caudal'] == false){
			$this->session->set_flashdata('correcto', 'El archivo ingresado no es valido, verifiquel porfavor.');
			redirect(base_url()."Gissat_mty/sector_info");
		}

		$lineas = file($archivotmp);
		$i = 0;

		foreach ($lineas as $linea_num => $linea) {
			if($i != 0){
				$datos = explode(",",$linea);

				if($result_validate['gasto'] == true and $result_validate['presion'] == true and $result_validate['caudal'] == true){
					$data = array(
					"fecha_op" => trim($datos[0]),
					"gasto_suministrado" => trim($datos[$result_validate['px_gasto']]),
					"presion" => trim($datos[$result_validate['px_presion']]),
					"caudal_salida" => trim($datos[$result_validate['px_caudal']]),
					"id_subsector" => $id//este valor se manipulara de acuerdo al sector que se este manejando
					);
				}
				if($result_validate['gasto'] == true and $result_validate['presion'] == true and $result_validate['caudal'] == false){
					$data = array(
					"fecha_op" => trim($datos[0]),
					"gasto_suministrado" => trim($datos[$result_validate['px_gasto']]),
					"presion" => trim($datos[$result_validate['px_presion']]),
					"caudal_salida" => 0,
					"id_subsector" => $id//este valor se manipulara de acuerdo al sector que se este manejando
					);
				}
				if($result_validate['gasto'] == true and $result_validate['presion'] == false and $result_validate['caudal'] == true){
					$data = array(
					"fecha_op" => trim($datos[0]),
					"gasto_suministrado" => trim($datos[$result_validate['px_gasto']]),
					"presion" => 0,
					"caudal_salida" => trim($datos[$result_validate['px_caudal']]),
					"id_subsector" => $id//este valor se manipulara de acuerdo al sector que se este manejando
					);
				}
				if($result_validate['gasto'] == true and $result_validate['presion'] == false and $result_validate['caudal'] == false){
					$data = array(
					"fecha_op" => trim($datos[0]),
					"gasto_suministrado" => trim($datos[$result_validate['px_gasto']]),
					"presion" => 0,
					"caudal_salida" => 0,
					"id_subsector" => $id//este valor se manipulara de acuerdo al sector que se este manejando
					);
				}
				if($result_validate['gasto'] == false and $result_validate['presion'] == true and $result_validate['caudal'] == true){
					$data = array(
					"fecha_op" => trim($datos[0]),
					"gasto_suministrado" => 0,
					"presion" => trim($datos[$result_validate['px_presion']]),
					"caudal_salida" => trim($datos[$result_validate['px_caudal']]),
					"id_subsector" => $id//este valor se manipulara de acuerdo al sector que se este manejando
					);
				}
				if($result_validate['gasto'] == false and $result_validate['presion'] == true and $result_validate['caudal'] == false){
					$data = array(
					"fecha_op" => trim($datos[0]),
					"gasto_suministrado" => 0,
					"presion" => 0,
					"caudal_salida" => trim($datos[$result_validate['px_caudal']]),
					"id_subsector" => $id//este valor se manipulara de acuerdo al sector que se este manejando
					);
				}
				if($result_validate['gasto'] == false and $result_validate['presion'] == false and $result_validate['caudal'] == true){
					$data = array(
					"fecha_op" => trim($datos[0]),
					"gasto_suministrado" => 0,
					"presion" => 0,
					"caudal_salida" => trim($datos[$result_validate['px_caudal']]),
					"id_subsector" => $id//este valor se manipulara de acuerdo al sector que se este manejando
					);
				}
				
				$this->record_Model->write_info_csv($data);
			}
			$i++;
		}
		$this->session->set_flashdata('correcto', 'Datos registrados correctamente.');
		redirect(base_url()."Gissat_mty/sector_info");
	}

	public function CSV_file_validate($tipo, $tamanio, $archivotmp){
		$lineas = file($archivotmp);
		$data_exist = array(
			"gasto" => false,
			"px_gasto" => 0,
			"presion" => false,
			"px_presion" => 0,
			"caudal" => false,
			"px_caudal" => 0,
		);

		foreach ($lineas as $linea_num => $linea) {
			$datos = explode(",", $linea);
			for($a=0 ; $a<count($datos) ; $a++){
				if(strcmp("gasto", trim($datos[$a]))==0){
					$data_exist['gasto'] = true;
					$data_exist['px_gasto'] = $a;
				}
				if(strcmp("presion", trim($datos[$a]))==0){
					$data_exist['presion'] = true;
					$data_exist['px_presion'] = $a;
				}
				if(strcmp("caudal", trim($datos[$a]))==0){
					$data_exist['caudal'] = true;
					$data_exist['px_caudal'] = $a;
				}
			}
			break;
		}

		return $data_exist;

		if($data_exist["gasto"] == true and $data_exist['presion'] == true and $data_exist['caudal'] == true){
			print($data_exist['px_caudal']);
			return $data_exist;
		}

		if($data_exist["gasto"] == false and $data_exist['presion'] == false and $data_exist['caudal'] == false){
			print("El archivo no contiene ningun valor valido");
			return $data_exist;
		}

		if($data_exist["gasto"] == true and $data_exist['presion'] == false and $data_exist['caudal'] == true){
			print("El archivo no contiene ningun valor valido");
			return $data_exist;
		}
	}

	public function dataInfo_validate($id){
		$this->load->model('databasemodel_mty');
		$presion_zero = $this->databasemodel_mty->presion_count($id);
		$presion_Exist = $this->databasemodel_mty->general_count('Horario_op');
		$presion_compare = ($presion_zero['count']/$presion_Exist['count'])*100;
		if($presion_compare>=50){
			return "presion";
		}
		else{
			return false;
		}
	}

	public function calculating_consumoNocturno($id){
		$this->load->model('databasemodel_mty');
		$caudal_consumo_nocturno = 2500;
		$strStart = $this->databasemodel_mty->get_currentMeditionDate($id);
		$dteStart = new DateTime($strStart['max']); 
		$fecha = $dteStart->format('Y-m-d');
   		$strEnd   = $this->databasemodel_mty->get_startMeditionDate($id, $fecha);
   		$dteEnd   = new DateTime($strEnd['min']);

   		$dteDiff  = $dteStart->diff($dteEnd); 
   		//print $dteDiff->format("%H");
   		$horas = $dteDiff->format("%H");
   		$segundos = $horas*3600;
   		$vol_nocturno = ($caudal_consumo_nocturno*$horas)/1000;
   		//print($vol_nocturno);
   		$caudal_nocturno = ($vol_nocturno/$segundos)*1000;
   		return $caudal_nocturno;
	}
}
 