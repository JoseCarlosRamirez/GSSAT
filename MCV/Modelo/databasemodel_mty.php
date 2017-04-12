<?php

class databasemodel_mty extends CI_Model {

	/**
	 * Llamada al constructor de la clase tempo para uso de las funciones
	 * @param [type] $query [description]
	 */
	public function __construct(){
		parent::__construct();
		 $this->load->database();
	}

	public function getHorario_data($id){
		$this->db->select("*");
		$this->db->from("Horario_op");
		$this->db->where("id_subsector",$id);
		$consulta = $this->db->get();
      	$resultado = $consulta->result_array();
      	return $resultado;
	}
	
}

?>