<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Apoyo extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('evaluacion', '', TRUE);
		$this->load->model('niveles', '', TRUE);
		$this->load->model('becas', '', TRUE);
		$this->load->model('tutorias', '', TRUE);
		$this->load->model('apoyoserv', '', TRUE);
	}

	//update apartado de update_Becas
	public function update_Becas() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'AlumnosBeca'  => $this->input->post('a13'),
				'TotalAlumnos' => $this->input->post('b13'),
				'idEvaluacion' => $eval[0]->idEvaluacion,
			);
			$this->becas->update($dataNivel1);

			// redirect('apoyo/reg/'.$eval[0]->idEvaluacion, 'refresh');
			$idUrl             = $eval[0]->idEvaluacion;
			$data['idUrl']     = $eval[0]->idEvaluacion;
			$data['message']   = "insert";
			$data['BecasArr']  = $this->evaluacion->getBecas($idUrl);
			$data['Tutorias']  = $this->evaluacion->getTutorias($idUrl);
			$data['Servicios'] = $this->evaluacion->getServicios($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(3)) {
				$nivel = $this->niveles->nivel1(3);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(3)) {
				$nivel = $this->niveles->nivel2(3);
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

			//Nivel 3 Becas
			if ($this->niveles->nivel3(3, 5)) {
				$nivel = $this->niveles->nivel3(3, 5);
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
					$data["Becas"] = $a;
				}
			}

			//Nivel 3 Tutoría
			if ($this->niveles->nivel3(3, 6)) {
				$nivel = $this->niveles->nivel3(3, 6);
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
					$data["Tutoria"] = $a;
				}
			}

			//Nivel 3 Servicio de apoyo educativo
			if ($this->niveles->nivel3(3, 7)) {
				$nivel = $this->niveles->nivel3(3, 7);
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
					$data["ServicioApoyo"] = $a;
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

			//Se obtine el registro de los valores del subnivel
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltro($data['datos']['idUnidad'], $idUrl);

			$data['main_cont'] = 'apoyo/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update apartado de update_Tutorias
	public function update_Tutorias() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

			$dataNivel1 = array(
				'TotalAlumnos' => $this->input->post('b14'),
				'idEvaluacion' => $eval[0]->idEvaluacion,
			);
			$this->tutorias->update($dataNivel1);

			// a Rendimiento BAlumnosRegulares
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BAlumnosTutorados" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BAlumnosTutorados($datos);

						}
					}
				}
			}
			// redirect('apoyo/reg/'.$eval[0]->idEvaluacion, 'refresh');
			$idUrl             = $eval[0]->idEvaluacion;
			$data['idUrl']     = $eval[0]->idEvaluacion;
			$data['message']   = "insert";
			$data['BecasArr']  = $this->evaluacion->getBecas($idUrl);
			$data['Tutorias']  = $this->evaluacion->getTutorias($idUrl);
			$data['Servicios'] = $this->evaluacion->getServicios($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(3)) {
				$nivel = $this->niveles->nivel1(3);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(3)) {
				$nivel = $this->niveles->nivel2(3);
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

			//Nivel 3 Becas
			if ($this->niveles->nivel3(3, 5)) {
				$nivel = $this->niveles->nivel3(3, 5);
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
					$data["Becas"] = $a;
				}
			}

			//Nivel 3 Tutoría
			if ($this->niveles->nivel3(3, 6)) {
				$nivel = $this->niveles->nivel3(3, 6);
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
					$data["Tutoria"] = $a;
				}
			}

			//Nivel 3 Servicio de apoyo educativo
			if ($this->niveles->nivel3(3, 7)) {
				$nivel = $this->niveles->nivel3(3, 7);
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
					$data["ServicioApoyo"] = $a;
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

			//Se obtine el registro de los valores del subnivel
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltro($data['datos']['idUnidad'], $idUrl);

			$data['main_cont'] = 'apoyo/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update apartado de update_ServicioApoyo
	public function update_ServicioApoyo() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

			$dataNivel1 = array(
				'TotalAcervoLibros'       => $this->input->post('b15'),
				'TotalLibrosFisicos'      => $this->input->post('b16'),
				'CapacidadInternet'       => $this->input->post('a17'),
				'UsuariosInternet'        => $this->input->post('b17'),
				'MantenimientoAtendido'   => $this->input->post('a18'),
				'MantenimientoSolicitado' => $this->input->post('b18'),
				'LimpiezaAtendida'        => $this->input->post('a19'),
				'LimpiezaProgramada'      => $this->input->post('b19'),
				'idEvaluacion'            => $eval[0]->idEvaluacion,
			);
			$this->apoyoserv->update($dataNivel1);

			// a Rendimiento BAlumnosRegulares
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'b') !== false) {
							$datos = array(
								"BlibrosTitulosEditados" => $this->input->post($row),
								"idUnidad"               => $data['datos']['idUnidad'],
								"idBloque"               => substr($row, 0, 3),
								"idEvaluacion"           => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BlibrosTitulosEditados($datos);

						}
					}
				}
			}
			//BTotalEjemplares
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'c') !== false) {
							$datos = array(
								"BTotalEjemplares" => $this->input->post($row),
								"idUnidad"         => $data['datos']['idUnidad'],
								"idBloque"         => substr($row, 0, 3),
								"idEvaluacion"     => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BTotalEjemplares($datos);

						}
					}
				}
			}

			// redirect('apoyo/reg/'.$eval[0]->idEvaluacion, 'refresh');
			$idUrl             = $eval[0]->idEvaluacion;
			$data['idUrl']     = $eval[0]->idEvaluacion;
			$data['message']   = "insert";
			$data['BecasArr']  = $this->evaluacion->getBecas($idUrl);
			$data['Tutorias']  = $this->evaluacion->getTutorias($idUrl);
			$data['Servicios'] = $this->evaluacion->getServicios($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(3)) {
				$nivel = $this->niveles->nivel1(3);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(3)) {
				$nivel = $this->niveles->nivel2(3);
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

			//Nivel 3 Becas
			if ($this->niveles->nivel3(3, 5)) {
				$nivel = $this->niveles->nivel3(3, 5);
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
					$data["Becas"] = $a;
				}
			}

			//Nivel 3 Tutoría
			if ($this->niveles->nivel3(3, 6)) {
				$nivel = $this->niveles->nivel3(3, 6);
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
					$data["Tutoria"] = $a;
				}
			}

			//Nivel 3 Servicio de apoyo educativo
			if ($this->niveles->nivel3(3, 7)) {
				$nivel = $this->niveles->nivel3(3, 7);
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
					$data["ServicioApoyo"] = $a;
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

			//Se obtine el registro de los valores del subnivel
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltro($data['datos']['idUnidad'], $idUrl);

			$data['main_cont'] = 'apoyo/index';
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

				$data['BecasArr']  = $this->evaluacion->getBecas($idUrl);
				$data['Tutorias']  = $this->evaluacion->getTutorias($idUrl);
				$data['Servicios'] = $this->evaluacion->getServicios($idUrl);

				//Se valida si el registro pertenece a la unidad
				$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);

				//Si existe lo deja continuar
				if ($result) {
					// Obtener informacion de las tablas
					// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
					// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

					//Obtiene informacion de los titulos
					// Nivel 1
					if ($this->niveles->nivel1(3)) {
						$nivel = $this->niveles->nivel1(3);
						foreach ($nivel as $row) {
							$array = array(
								'Nombre' => $row->Nombre,
								'Valor'  => $row->Valor,
							);
							$data["nivel1"] = $array;
						}
					}

					//Nivel 2
					if ($this->niveles->nivel2(3)) {
						$nivel = $this->niveles->nivel2(3);
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

					//Nivel 3 Becas
					if ($this->niveles->nivel3(3, 5)) {
						$nivel = $this->niveles->nivel3(3, 5);
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
							$data["Becas"] = $a;
						}
					}

					//Nivel 3 Tutoría
					if ($this->niveles->nivel3(3, 6)) {
						$nivel = $this->niveles->nivel3(3, 6);
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
							$data["Tutoria"] = $a;
						}
					}

					//Nivel 3 Servicio de apoyo educativo
					if ($this->niveles->nivel3(3, 7)) {
						$nivel = $this->niveles->nivel3(3, 7);
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
							$data["ServicioApoyo"] = $a;
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

					//Se obtine el registro de los valores del subnivel
					$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltro($data['datos']['idUnidad'], $idUrl);

					$data['main_cont'] = 'apoyo/index';
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
