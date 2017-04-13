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

	public function getMinGasto($id){
		$this->db->select("min(gasto_suministrado)");
		$this->db->from("Horario_op");
		$this->db->where("id_subsector",$id);
		$consulta = $this->db->get();
      	$resultado = $consulta->row_array();
      	return $resultado;
	}

	public function getPresion_Gasto($id, $gasto){
		$this->db->select("presion");
		$this->db->from("Horario_op");
		$this->db->where("gasto_suministrado = ",$gasto);
		$this->db->where("id_subsector",$id);
		$consulta = $this->db->get();
      	$resultado = $consulta->row_array();
      	return $resultado;
	}
	
	public function presion_count($id){
		$this->db->select("count(*)");
		$this->db->from("Horario_op");
		$this->db->where("presion = ", 0);
		$this->db->where("id_subsector = ", $id);
		$consulta = $this->db->get();
      	$resultado = $consulta->row_array();
      	return $resultado;
	}

	public function general_count($table){
		$this->db->select("count(*)");
		$this->db->from($table);
		$consulta = $this->db->get();
      	$resultado = $consulta->row_array();
      	return $resultado;
	}

	public function get_circuitoInfo($id){
		$this->db->select("nombre_sa, nombre_dis");
		$this->db->from("distrito");
		$this->db->join("subsector","distrito.id_sub_dis = subsector.id_sub");
		$this->db->join("sector_abastecimiento","subsector.id_sa_sub = sector_abastecimiento.id_sa");
		$this->db->where("id_dis",$id);
		$consulta = $this->db->get();
		$resultado = $consulta->row_array();
		return $resultado;
	}

	public function get_currentMeditionDate($id){
		$this->db->select("max(fecha_op)");
		$this->db->from("Horario_op");
		$this->db->where("id_subsector",$id);
		$consulta = $this->db->get();
		$resultado = $consulta->row_array();
		return $resultado;
	}

	public function get_startMeditionDate($id, $date){
		$this->db->select("min(fecha_op)");
		$this->db->from("Horario_op");
		$this->db->where("fecha_op >= ",$date);
		$this->db->where("id_subsector",$id);
		$consulta = $this->db->get();
		$resultado = $consulta->row_array();
		return $resultado;
	}
}

?>