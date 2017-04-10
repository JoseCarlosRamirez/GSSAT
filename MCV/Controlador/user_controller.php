<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_controller extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	/**
	 * Controlador para el inicio de sesion. Recibe parametros por POST 
	 * @return [type] redirecciona a la vista 'map' si el logueo fue correcto
	 */
	public function iniciar_sesion(){
		if($this->input->post()){
			$nombre = $this->input->post('user');
			$pass = $this->input->post('password');
			$this->load->model('user_model');
			$usuario = $this->user_model->validar_usuario($nombre, $pass);
			if($usuario){
				$usuario_data = array(
					'id' => $usuario->id_user,
					'nombre' => $usuario->nombre_user,
					'tipo' => $usuario->tipo,
					'logueado' => TRUE
				);
				$this->session->set_userdata($usuario_data);
				//redirect('gissat/map');//Linea de codigo para redirigir a la pantalla principal del gissat
				redirect('Gissat_mty/map');
			}
			else{
				if($this->superUser_validate($nombre, $pass)){
					$usuario_data = array(
					'id' => 0,
					'nombre' => "Super Usuario",
					'tipo' => $usuario->tipo,
					'logueado' => TRUE
					);
					$this->session->set_userdata($usuario_data);
					redirect('Gissat_mty/map');
				}else{
					$this->session->set_flashdata('item', 'Nombre de usuario o contraseña incorrecto');
					redirect('','refresh');
				}
				
			}
		}
		else{
			$this->session->set_flashdata('item', 'Nombre de usuario o contraseña incorrecto');
			redirect('','refresh');
		}
	}

	/**
	 * Valida el logueo del Super Usuario para acceder al sistema
	 * @param  [type] $nombre [description]
	 * @param  [type] $pass   [description]
	 * @return [type]         [description]
	 */
	function superUser_validate($nombre, $pass){
		$this->load->library('encrypt');
		$encrypted_string = "fhNZ+rG+dtxjQRSaa3b1Xc5eFkGRxXv+wzBGBS/stqlImmHTK8yJdbHIS6hGT40xk8HiZTLnJLfcyqjiT7qy/Q==";
		$decrypted_string= $this->encrypt->decode($encrypted_string);
		if(strcmp($nombre, "root")==0 and strcmp($pass, $decrypted_string)==0){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * Funcion que cirra sesion al usuario
	 * @return [type] Cierra la sesion del usuario sin eliminar las cokies de navegacion
	 */
	public function logout(){
		$usuario_data = array(
        	'logueado' => FALSE
      	);
      	$this->session->set_userdata($usuario_data);
      	redirect('');
	}

	/**
	 * Funcion que respalda la base de datos.
	 * @return [type] [description]
	 */
	public function backup()
    {
        date_default_timezone_set("America/Mexico_City");
        // Carga la clase de utilidades de base de datos
        $this->load->dbutil();
        $fecha_hora = date("Ymd_His");

        $prefs = array(
            'tables'      => array('arrancador',
            						'bomba',
            						'capacitores',
            						'catalogo_bombas',
            						'conductor_electrico',
            						'consumo_electrico',
            						'cuenta',
            						'curva_cubicacion',
            						'curva_demanda',
            						'distrito',
            						'estadisticas_consumo_electrico',
            						'estadisticas_fuentes',
            						'estadisticas_macro',
            						'estadisticas_pozos',
            						'estadisticas_regularizacion',
            						//'estadisticas_padron',
            						'estatus_catalogo',
            						'fuentes_extraccion',
            						'horario_dias_b',
            						'horario_dias_v',
            						'infraestructura_bombeo',
            						'infraestructura_regularizacion',
            						'mantenimiento_bomba',
            						'mantenimiento_motor',
            						'medidor',
            						'motor',
            						'orden_servicio',
            						'parametros_electricos',
            						'pozos_profundos',
            						'predio',
            						'punto_macromedicion',
            						'puntos_catalogo',
            						'puntosuministro',
            						'rebombeo',
            						'sector_abastecimiento',
            						'sector_comercial',
            						'sistema_tierra',
            						'subsector',
            						'tipopuntos_catalogo',
            						'toma',
            						//'trasformador',
            						'tuberia',
            						'users',
            						'usuario',
            						'valor_curva',
            						'valvulas'),
            'ignore'      => array(),           // Lista de tablas para omitir en la copia de seguridad
            'format'      => 'zip',             // gzip, zip, txt
            'filename'    => 'backup_'.$fecha_hora.'.sql',    // Nombre de archivo - NECESARIO SOLO CON ARCHIVOS ZIP
            'add_drop'    => TRUE,              // Agregar o no la sentencia DROP TABLE al archivo de respaldo
            'add_insert'  => TRUE,              // Agregar o no datos de INSERT al archivo de respaldo
            'newline'     => "\n"               // Caracter de nueva línea usado en el archivo de respaldo
        );

        // Crea una copia de seguridad de toda la base de datos y la asigna a una variable
        $copia_de_seguridad = $this->dbutil->backup($prefs); 

        // Carga el asistente de archivos y escribe el archivo en su servidor
        $this->load->helper('file');

        if ( ! write_file('./backup/backup_'.$fecha_hora.'.zip', $copia_de_seguridad))
        {
             //$this->smarty->assign('error','No se ha podido crear la copia.');
        }
        else
        {
            //$this->smarty->assign('success','Copia creada satisfactoriamente');
        }

        // Carga el asistente de descarga y envía el archivo a su escritorio
        $this->load->helper('download');
        force_download('copia_de_seguridad.zip', $copia_de_seguridad);
        //$this->smarty->view('ajustes');
    }

    /**
     * Restaura la abse de datos apartir de un archivo sql
     * @return [NA] [Sin valor de retorno]
     */
  	function restore_db(){
    		$this->load->database();
    		$this->load->model('user_model');
    		$tipo = $_FILES['frestaurar']['type'];
			$tamanio = $_FILES['frestaurar']['size'];
			$archivotmp = $_FILES['frestaurar']['tmp_name'];
			$templine = '';
			$lines = file($archivotmp);
			foreach ($lines as $line)
			{
			if (substr($line, 0, 2) == '--' || $line == '')
    		continue;
			$templine .= $line;
			if (substr(trim($line), -1, 1) == ';')
			{	
    		$this->user_model->ejecutar($templine); //or print('Error performing query \'<strong>' . $templine . '\': '.'<br /><br />');
    		$templine = '';
			}
			}
			$this->session->set_flashdata('correcto', 'Base de datos restaurada correctamente');
			redirect(base_url()."GISSAT/ajustes");
    }
	
	/**
	* Cargar datos apartir de archivos CSV a la tabla cuentas
	* @return [type] [description]
	*/
	function loadFile_Cuentas(){
		$this->load->model('record_Model');
		$tipo = $_FILES['archivo']['type'];
		$tamanio = $_FILES['archivo']['size'];
		$archivotmp = $_FILES['archivo']['tmp_name'];

		$lineas = file($archivotmp);
		$i = 0;

		foreach ($lineas as $linea_num => $linea) {
			
			if($i != 0){
				$datos = explode(",",$linea);
				$data = array(
					//"idcuenta" => trim($datos[0]),
					"cuenta" => trim($datos[1]),
					"idtoma" => trim($datos[2]),
					"idusuario" => trim($datos[3])
					);
				$idcuenta = trim($datos[0]);
				$cuenta = trim($datos[1]);
				$idtoma = trim($datos[2]);
				$idusuario = trim($datos[3]);
				$this->record_Model->write_cuenta_csv($data);
			}
			$i++;
		}
		$this->session->set_flashdata('correcto', 'Los datos se cargaron correctamente');
		redirect(base_url()."Gissat/ajustes");
	}

	/**
	* Cargar datos apartir de archivos CSV a la tabla usuarios
	* @return [type] [description]
	*/
	function loadFile_Usuarios(){
		$this->load->model('record_Model');
		$tipo = $_FILES['archivo']['type'];
		$tamanio = $_FILES['archivo']['size'];
		$archivotmp = $_FILES['archivo']['tmp_name'];

		$lineas = file($archivotmp);
		$i = 0;

		foreach ($lineas as $linea_num => $linea) {
			
			if($i != 0){
				$datos = explode(",",$linea);
				$data = array(
					//"id_padron_u" => trim($datos[0]),
					"nombre_u" => trim($datos[7]),//agregar nuevos campos
					"tipo_servicio_u" => trim($datos[16]),
					"numero_ext_u" => trim($datos[17]),
					"numero_int_u" => trim($datos[18]),
					"colonia_u" => trim($datos[9]),
					"localidad_u" => trim($datos[8]),
					"municipio_u" => trim($datos[10]),
					"cp_u" => trim($datos[15]),
					"num_catastro_u" => trim($datos[24]),
					"estado_u" => trim($datos[19]),
					"observaciones_u" => trim($datos[20]),
					"latitud_u" => trim($datos[21]),
					"longitud_u" => trim($datos[22])
					);
				print(trim($datos[0]));
				$this->record_Model->write_usuario_csv($data);
			}
			$i++;
		}
		$this->session->set_flashdata('correcto', 'Los datos se cargaron correctamente');
		redirect(base_url()."Gissat/ajustes");
	}

	/**
	* Cargar datos apartir de archivos CSV a la tabla tomas
	* @return [type] [description]
	*/
	function loadFile_Tomas(){
		$this->load->model('record_Model');
		$tipo = $_FILES['archivo']['type'];
		$tamanio = $_FILES['archivo']['size'];
		$archivotmp = $_FILES['archivo']['tmp_name'];

		$lineas = file($archivotmp);
		$i = 0;

		foreach ($lineas as $linea_num => $linea) {
			
			if($i != 0){
				$datos = explode(",",$linea);
				$data = array(
					//"id_toma" => trim($datos[0]),
					"uso_toma" => trim($datos[1]),
					"giro_toma" => trim($datos[2]),
					"descripcion_giro_toma" => trim($datos[3]),
					"posicion_toma" => trim($datos[4]),
					"fuga_toma" => trim($datos[5]),
					"material_toma" => trim($datos[6]),
					"diametro_toma" => trim($datos[7]),
					"num_serie_toma" => trim($datos[8]),
					"marca_toma" => trim($datos[9]),
					"estado_toma" => trim($datos[10]),
					"sector_comercial_toma" => "NA",
					"ruta_toma" => trim($datos[11]),
					"observaciones_toma" => trim($datos[12]),
					"latitud_toma" => trim($datos[13]),
					"longitud_toma" => trim($datos[14]),
					"id_dis_toma" => trim($datos[15]),
					"id_sc_toma" => trim($datos[16])
					);
				$this->record_Model->write_tomas_csv($data);
			}
			$i++;
		}
		$this->session->set_flashdata('correcto', 'Los datos se cargaron correctamente');
		redirect(base_url()."Gissat/ajustes");
	}

	/**
	* Cargar datos apartir de archivos CSV a la tabla pozos
	* @return [type] [description]
	*/
	function loadFile_Pozos(){
		$this->load->model('record_Model');
		$tipo = $_FILES['archivo']['type'];
		$tamanio = $_FILES['archivo']['size'];
		$archivotmp = $_FILES['archivo']['tmp_name'];

		$lineas = file($archivotmp);
		$i = 0;

		foreach ($lineas as $linea_num => $linea) {
			
			if($i != 0){
				$datos = explode(",",$linea);
				$data = array(
					//"id_fe" => trim($datos[0]),
					"tipo_fe" => trim($datos[1]),
					"nombre_fe" => trim($datos[2]),
					"altura_manometro_fe" => trim($datos[3]),
					"observaciones_fe" => trim($datos[4]),
					"latitud_fe" => trim($datos[5]),
					"longitud_fe" => trim($datos[6]),
					"id_mac_fe" => trim($datos[7]),
					"id_dis_fe" => trim($datos[8]),
					);
				$this->record_Model->write_pozos_csv($data);
			}
			$i++;
		}
		$this->session->set_flashdata('correcto', 'Los datos se cargaron correctamente');
		redirect(base_url()."Gissat/ajustes");
	}

	/**
	* Cargar datos apartir de archivos CSV a la tabla tanques
	* @return [type] [description]
	*/
	function loadFile_Tanques(){
		$this->load->model('record_Model');
		$tipo = $_FILES['archivo']['type'];
		$tamanio = $_FILES['archivo']['size'];
		$archivotmp = $_FILES['archivo']['tmp_name'];

		$lineas = file($archivotmp);
		$i = 0;

		foreach ($lineas as $linea_num => $linea) {
			
			if($i != 0){
				$datos = explode(",",$linea);
				$data = array(
					//"id_ir" => trim($datos[0]),
					"tipo_ir" => trim($datos[1]),
					"funcion_ir" => trim($datos[2]),
					"material_ir" => trim($datos[3]),
					"nombre_ir" => trim($datos[4]),
					"elevacion_ir" => trim($datos[5]),
					"ndp_ir" => trim($datos[6]),
					"volumen_ir" => trim($datos[7]),
					"h_total_ir" => trim($datos[8]),
					"h_ir" => trim($datos[9]),
					"ni_min_ir" => trim($datos[10]),
					"fecha_ir" => trim($datos[11]),
					"efisico_ir" => trim($datos[12]),
					"observaciones_ir" => trim($datos[13]),
					"latitud_ir" => trim($datos[14]),
					"longitud_ir" => trim($datos[15]),
					//"id_cc_ir" => trim($datos[16]),
					"id_dis_ir" => trim($datos[17])
				);
				$this->record_Model->write_tanque_csv($data);
			}
			$i++;
		}
		$this->session->set_flashdata('correcto', 'Los datos se cargaron correctamente');
		redirect(base_url()."Gissat/ajustes");
	}

	/**
	* Cargar datos apartir de archivos CSV a la tabla bombas
	* @return [type] [description]
	*/
	function loadFile_Bombas(){
		$this->load->model('record_Model');
		$tipo = $_FILES['archivo']['type'];
		$tamanio = $_FILES['archivo']['size'];
		$archivotmp = $_FILES['archivo']['tmp_name'];

		$lineas = file($archivotmp);
		$i = 0;

		foreach ($lineas as $linea_num => $linea) {
			
			if($i != 0){
				$datos = explode(",",$linea);
				$data = array(
					//"id_ib" => trim($datos[0]),
					"nombre_ib" => trim($datos[1]),
					"estacion_ib" => trim($datos[2]),
					"equipo_ib" => trim($datos[3]),
					"observaciones_ib" => trim($datos[4]),
					"latitud_ib" => trim($datos[5]),
					"longitud_ib" => trim($datos[6]),
					"id_fe_ib" => trim($datos[7]),
					"id_ar_ib" => trim($datos[8]),
					"id_pr_ib" => trim($datos[9]),
					"id_dis_ib" => trim($datos[10])
				);
				$this->record_Model->write_bomba_csv($data);
			}
			$i++;
		}
		$this->session->set_flashdata('correcto', 'Los datos se cargaron correctamente');
		redirect(base_url()."Gissat/ajustes");
	}

	/**
	* Cargar datos apartir de archivos CSV a la tabla valvulas
	* @return [type] [description]
	*/
	function loadFile_Valvulas(){
		$this->load->model('record_Model');
		$tipo = $_FILES['archivo']['type'];
		$tamanio = $_FILES['archivo']['size'];
		$archivotmp = $_FILES['archivo']['tmp_name'];

		$lineas = file($archivotmp);
		$i = 0;

		foreach ($lineas as $linea_num => $linea) {
			
			if($i != 0){
				$datos = explode(",",$linea);
				$data = array(
					//"id_val" => trim($datos[0]),
					"tipo_val" => trim($datos[1]),
					//"ubicacion_val" => trim($datos[2]),
					"latitud_val" => trim($datos[3]),
					"longitud_val" => trim($datos[4]),
					"entrada_val" => trim($datos[5]),
					"salida_val" => trim($datos[6]),
					"observaciones_val" => trim($datos[7]),
					"id_entrada_val" => trim($datos[8]),
					"id_salida_val" => trim($datos[9]),
					"id_dis_val" => trim($datos[10])
				);
				$this->record_Model->write_valvula_csv($data);
			}
			$i++;
		}
		$this->session->set_flashdata('correcto', 'Los datos se cargaron correctamente');
		redirect(base_url()."Gissat/ajustes");
	}
}
