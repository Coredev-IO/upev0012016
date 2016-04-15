<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Gestion extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('evaluacion', '', TRUE);
		$this->load->model('niveles', '', TRUE);
		$this->load->model('recursos', '', TRUE);
	}

	public function update_rcursos() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'RecursosEjercidos'     => $this->input->post('a27'),
				'RecursosAutogenerados' => $this->input->post('b27'),
				'idEvaluacion'          => $eval[0]->idEvaluacion,
			);
			$this->recursos->update($dataNivel1);

			// redirect('gestion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl            = $eval[0]->idEvaluacion;
			$data['idUrl']    = $eval[0]->idEvaluacion;
			$data['message']  = "insert";

			// Obtener informacion de las tablas
					// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
					// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
					$data['gestion'] = $this->evaluacion->getGestion($idUrl);
					//Obtiene informacion de los titulos
					// Nivel 1
					if ($this->niveles->nivel1(6)) {
						$nivel = $this->niveles->nivel1(6);
						foreach ($nivel as $row) {
							$array = array(
								'Nombre' => $row->Nombre,
								'Valor'  => $row->Valor,
							);
							$data["nivel1"] = $array;
						}
					}

					//Nivel 2
					if ($this->niveles->nivel2(6)) {
						$nivel = $this->niveles->nivel2(6);
						$a     = array();
						foreach ($nivel as $row) {
							$array = array(
								'Nombre' => $row->Nombre,
								'Valor'  => $row->Valor,
							);
							array_push($a, $array);
							$data["nivel2"] = $a;
						}
					}

					//Nivel 3 Recursos autogenerados
					if ($this->niveles->nivel3(6, 14)) {
						$nivel = $this->niveles->nivel3(6, 14);
						$a     = array();
						foreach ($nivel as $row) {
							$array = array(
								'Nombre'      => $row->Nombre,
								'Indicadores' => $row->Indicadores,
								'Descripcion' => $row->Descripcion,
								'Valor'       => $row->Valor,
								'campo1'      => $row->campo1,
								'campo1id'    => $row->campo1id,
								'campo2'      => $row->campo2,
								'campo2id'    => $row->campo2id,
								'Despegable'  => $row->Despegable
							);
							array_push($a, $array);
							$data["Recursos"] = $a;
						}
					}
					//Bloque
					if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
						$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
						$a      = array();
						foreach ($bloque as $row) {
							$array = array(
								'idBloques' => $row->idBloques,
								'Nombre'    => $row->Nombre,
							);
							array_push($a, $array);
							$data["bloques"] = $a;
						}
					}

					$data['main_cont'] = 'gestion/index';
					$this->load->view('includes/template_principal', $data);
				

		} else {
			redirect('login', 'refresh');
		}

	}

	public function reg() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				//Escuela
				//Se obtiene id de la url
				$idUrl         = $this->uri->segment(3);
				$data['idUrl'] = $idUrl;

				//Se valida si el registro pertenece a la unidad
				$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);

				//Si existe lo deja continuar
				if ($result) {
					// Obtener informacion de las tablas
					// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
					// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
					$data['gestion'] = $this->evaluacion->getGestion($idUrl);
					//Obtiene informacion de los titulos
					// Nivel 1
					if ($this->niveles->nivel1(6)) {
						$nivel = $this->niveles->nivel1(6);
						foreach ($nivel as $row) {
							$array = array(
								'Nombre' => $row->Nombre,
								'Valor'  => $row->Valor,
							);
							$data["nivel1"] = $array;
						}
					}

					//Nivel 2
					if ($this->niveles->nivel2(6)) {
						$nivel = $this->niveles->nivel2(6);
						$a     = array();
						foreach ($nivel as $row) {
							$array = array(
								'Nombre' => $row->Nombre,
								'Valor'  => $row->Valor,
							);
							array_push($a, $array);
							$data["nivel2"] = $a;
						}
					}

					//Nivel 3 Recursos autogenerados
					if ($this->niveles->nivel3(6, 14)) {
						$nivel = $this->niveles->nivel3(6, 14);
						$a     = array();
						foreach ($nivel as $row) {
							$array = array(
								'Nombre'      => $row->Nombre,
								'Indicadores' => $row->Indicadores,
								'Descripcion' => $row->Descripcion,
								'Valor'       => $row->Valor,
								'campo1'      => $row->campo1,
								'campo1id'    => $row->campo1id,
								'campo2'      => $row->campo2,
								'campo2id'    => $row->campo2id,
								'Despegable'  => $row->Despegable
							);
							array_push($a, $array);
							$data["Recursos"] = $a;
						}
					}
					//Bloque
					if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
						$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
						$a      = array();
						foreach ($bloque as $row) {
							$array = array(
								'idBloques' => $row->idBloques,
								'Nombre'    => $row->Nombre,
							);
							array_push($a, $array);
							$data["bloques"] = $a;
						}
					}

					$data['main_cont'] = 'gestion/index';
					$this->load->view('includes/template_principal', $data);
				} else {
					redirect('login', 'refresh');
				}
			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}

	}

}
