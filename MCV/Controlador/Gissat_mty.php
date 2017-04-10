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
			$this->load->model('databaseModel');
			$data = array(
				"sector" => $this->databaseModel->getTabla('sector_abastecimiento'),
				"subsector" => $this->databaseModel->getTabla('subsector'),
				"distrito" => $this->databaseModel->getTabla('distrito'),
				"infrab" =>$this->databaseModel->getTabla('infraestructura_bombeo'),
				"arranc" =>$this->databaseModel->getTabla('arrancador'),
				"tomas" =>$this->databaseModel->getTabla('toma'),
				"usuarios" =>$this->databaseModel->getTabla('usuario'),
				"puntosmac" =>$this->databaseModel->getTabla('punto_macromedicion'),
				"valvuls" =>$this->databaseModel->getTabla('valvulas'),
				"fuentes" =>$this->databaseModel->getTabla('fuentes_extraccion'),
				"predios" =>$this->databaseModel->getTabla('predio'),
				"bombas" =>$this->databaseModel->getTabla('bomba'),
				"motores" =>$this->databaseModel->getTabla('motor'),
				"capacitoress" =>$this->databaseModel->getTabla('capacitores'),
				"sistemast" =>$this->databaseModel->getTabla('sistema_tierra'),
				"infrar" =>$this->databaseModel->getTabla('infraestructura_regularizacion'),
				"sectorc" =>$this->databaseModel->getTabla('sector_comercial')

			);
			$this->load->view('map', $data);
		}
	}
	
}
