<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Vinculacion extends CI_Controller {

	function __construct() {
		parent::__construct();

		$data['datos'] = $this->session->userdata('logged_in');
		$this->load->library('verify');
		$this->verify->seccion(2, $data['datos']['idRoles']);

		$this->load->model('evaluacion', '', TRUE);
		$this->load->model('niveles', '', TRUE);
		$this->load->model('modelvinculacion', '', TRUE);
	}

	//update apartado de update_ServicioSocial
	public function update_ServicioSocial() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacion;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/vinculacion/servicio';
			$config['upload_path']   = './uploads/vinculacion/servicio';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$new_name            = $eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							// echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						// echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'AlumnosServicioAnterior' => $this->input->post('b20'),
				'idEvaluacion'            => $eval[0]->idEvaluacion,
				'comprobante1'            => $rutafiles[0],
			);
			$this->modelvinculacion->update_ss($dataNivel1);

			// a Rendimiento BAlumnosServicioSocial
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BAlumnosServicioSocial" => $this->input->post($row),
								"idUnidad"               => $data['datos']['idUnidad'],
								"idBloque"               => substr($row, 0, 3),
								"idEvaluacion"           => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BAlumnosServicioSocial($datos);

						}
					}
				}
			}

			// Z Rendimiento BAlumnosServicioSocialT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'z') !== false) {
							$datos = array(
								"BAlumnosServicioSocialT" => $this->input->post($row),
								"idUnidad"                => $data['datos']['idUnidad'],
								"idBloque"                => substr($row, 0, 3),
								"idEvaluacion"            => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BAlumnosServicioSocialT($datos);

						}
					}
				}
			}

			// redirect('vinculacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacion;
			$data['idUrl']   = $eval[0]->idEvaluacion;
			$data['message'] = "insert";

			$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocial($idUrl);
			$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolares($idUrl);
			$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculados($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(4)) {
				$nivel = $this->niveles->nivel1(4);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(4)) {
				$nivel = $this->niveles->nivel2(4);
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

			//Nivel 3 ServicioSocial
			if ($this->niveles->nivel3(4, 8)) {
				$nivel = $this->niveles->nivel3(4, 8);
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
					$data["ServicioSocial"] = $a;
				}
			}

			//Nivel 3 VisitasEscolares
			if ($this->niveles->nivel3(4, 9)) {
				$nivel = $this->niveles->nivel3(4, 9);
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
					$data["VisitasEscolares"] = $a;
				}
			}

			//Nivel 3 ProyectosVinculados
			if ($this->niveles->nivel3(4, 10)) {
				$nivel = $this->niveles->nivel3(4, 10);
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
					$data["ProyectosVinculados"] = $a;
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


                        $arrayUpdate = array(
                                'idEvaluacion' => $idUrl,
                                'cn8' => 1
                        );
                        $this->evaluacion->updateStatus($arrayUpdate);

			$data['main_cont'] = 'vinculacion/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update apartado de update_ServicioSocial
	public function update_ServicioSocialSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacionSup;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/vinculacion/servicioSup';
			$config['upload_path']   = './uploads/vinculacion/servicioSup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$new_name            = $eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							// echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						// echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'AlumnosInscritosServicio' => $this->input->post('b20'),
				'idEvaluacion'             => $eval[0]->idEvaluacionSup,
				'comprobante1'             => $rutafiles[0],
			);
			$this->modelvinculacion->update_ssSup($dataNivel1);

			// a Rendimiento BAlumnosServicioSocial
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BAlumnosSerSoc" => $this->input->post($row),
								"idUnidad"       => $data['datos']['idUnidad'],
								"idBloque"       => substr($row, 0, 3),
								"idEvaluacion"   => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosServicioSocialSup($datos);

						}
					}
				}
			}

			// Z Rendimiento BAlumnosServicioSocialT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'z') !== false) {
							$datos = array(
								"BAlumnosSerSocT" => $this->input->post($row),
								"idUnidad"        => $data['datos']['idUnidad'],
								"idBloque"        => substr($row, 0, 3),
								"idEvaluacion"    => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosServicioSocialTSup($datos);

						}
					}
				}
			}

			// redirect('vinculacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacionSup;
			$data['idUrl']   = $eval[0]->idEvaluacionSup;
			$data['message'] = "insert";

			$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocialSup($idUrl);
			$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolaresSup($idUrl);
			$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculadosSup($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(4)) {
				$nivel = $this->niveles->nivel1Sup(4);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(4)) {
				$nivel = $this->niveles->nivel2Sup(4);
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

			//Nivel 3 ServicioSocial
			if ($this->niveles->nivel3Sup(4, 9)) {
				$nivel = $this->niveles->nivel3Sup(4, 9);
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
					$data["ServicioSocial"] = $a;
				}
			}

			//Nivel 3 VisitasEscolares
			if ($this->niveles->nivel3Sup(4, 10)) {
				$nivel = $this->niveles->nivel3Sup(4, 10);
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
					$data["VisitasEscolares"] = $a;
				}
			}

			//Nivel 3 ProyectosVinculados
			if ($this->niveles->nivel3Sup(4, 11)) {
				$nivel = $this->niveles->nivel3Sup(4, 11);
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
					$data["ProyectosVinculados"] = $a;
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
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

                        $arrayUpdate = array(
                                'idEvaluacionSup' => $idUrl,
                                'cn8' => 1
                        );
                        $this->evaluacion->updateStatusSup($arrayUpdate);

			$data['main_cont'] = 'vinculacion/indexSup';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update apartado de update_VisitasEscolares
	public function update_VisitasEscolares() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacion;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/vinculacion/visitas';
			$config['upload_path']   = './uploads/vinculacion/visitas';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$new_name            = $eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							// echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						// echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'TotalMatricula' => $this->input->post('b21'),
				'idEvaluacion'   => $eval[0]->idEvaluacion,
				'comprobante1'   => $rutafiles[0],
			);
			$this->modelvinculacion->update_vs($dataNivel1);

			// b BALumnosVisitas
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'b') !== false) {
							$datos = array(
								"BALumnosVisitas" => $this->input->post($row),
								"idUnidad"        => $data['datos']['idUnidad'],
								"idBloque"        => substr($row, 0, 3),
								"idEvaluacion"    => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BALumnosVisitas($datos);

						}
					}
				}
			}

			// y BALumnosVisitasT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'y') !== false) {
							$datos = array(
								"BALumnosVisitasT" => $this->input->post($row),
								"idUnidad"         => $data['datos']['idUnidad'],
								"idBloque"         => substr($row, 0, 3),
								"idEvaluacion"     => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BALumnosVisitasT($datos);

						}
					}
				}
			}

			// redirect('vinculacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacion;
			$data['idUrl']   = $eval[0]->idEvaluacion;
			$data['message'] = "insert";

			$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocial($idUrl);
			$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolares($idUrl);
			$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculados($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(4)) {
				$nivel = $this->niveles->nivel1(4);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(4)) {
				$nivel = $this->niveles->nivel2(4);
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

			//Nivel 3 ServicioSocial
			if ($this->niveles->nivel3(4, 8)) {
				$nivel = $this->niveles->nivel3(4, 8);
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
					$data["ServicioSocial"] = $a;
				}
			}

			//Nivel 3 VisitasEscolares
			if ($this->niveles->nivel3(4, 9)) {
				$nivel = $this->niveles->nivel3(4, 9);
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
					$data["VisitasEscolares"] = $a;
				}
			}

			//Nivel 3 ProyectosVinculados
			if ($this->niveles->nivel3(4, 10)) {
				$nivel = $this->niveles->nivel3(4, 10);
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
					$data["ProyectosVinculados"] = $a;
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

                        $arrayUpdate = array(
                                'idEvaluacion' => $idUrl,
                                'cn9' => 1
                        );
                        $this->evaluacion->updateStatus($arrayUpdate);

			$data['main_cont'] = 'vinculacion/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update apartado de update_VisitasEscolares
	public function update_VisitasEscolaresSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacionSup;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/vinculacion/visitasSup';
			$config['upload_path']   = './uploads/vinculacion/visitasSup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$new_name            = $eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							// echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						// echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'idEvaluacion' => $eval[0]->idEvaluacionSup,
				'comprobante1' => $rutafiles[0],
			);
			$this->modelvinculacion->update_vsSup($dataNivel1);

			// b BALumnosVisitas
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'b') !== false) {
							$datos = array(
								"BAlumnosPractProf" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BALumnosVisitasSup($datos);

						}
					}
				}
			}

			// y BALumnosVisitasT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'y') !== false) {
							$datos = array(
								"BAlumnosPractProfT" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BALumnosVisitasTSup($datos);

						}
					}
				}
			}

			// redirect('vinculacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacionSup;
			$data['idUrl']   = $eval[0]->idEvaluacionSup;
			$data['message'] = "insert";

			$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocialSup($idUrl);
			$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolaresSup($idUrl);
			$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculadosSup($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(4)) {
				$nivel = $this->niveles->nivel1Sup(4);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(4)) {
				$nivel = $this->niveles->nivel2Sup(4);
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

			//Nivel 3 ServicioSocial
			if ($this->niveles->nivel3Sup(4, 9)) {
				$nivel = $this->niveles->nivel3Sup(4, 9);
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
					$data["ServicioSocial"] = $a;
				}
			}

			//Nivel 3 VisitasEscolares
			if ($this->niveles->nivel3Sup(4, 10)) {
				$nivel = $this->niveles->nivel3Sup(4, 10);
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
					$data["VisitasEscolares"] = $a;
				}
			}

			//Nivel 3 ProyectosVinculados
			if ($this->niveles->nivel3Sup(4, 11)) {
				$nivel = $this->niveles->nivel3Sup(4, 11);
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
					$data["ProyectosVinculados"] = $a;
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
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);


                        $arrayUpdate = array(
                                'idEvaluacionSup' => $idUrl,
                                'cn9' => 1
                        );
                        $this->evaluacion->updateStatusSup($arrayUpdate);

			$data['main_cont'] = 'vinculacion/indexSup';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	public function update_ProyectosVinculados() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacion;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/vinculacion/proyectos';
			$config['upload_path']   = './uploads/vinculacion/proyectos';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$new_name            = $eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							// echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						// echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'ProyectosVinculadosAct' => $this->input->post('a22'),
				'ProyectosVinculadosAnt' => $this->input->post('b22'),
				'idEvaluacion'           => $eval[0]->idEvaluacion,
				'comprobante1'           => $rutafiles[0],
			);
			$this->modelvinculacion->update_pv($dataNivel1);

			// redirect('vinculacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacion;
			$data['idUrl']   = $eval[0]->idEvaluacion;
			$data['message'] = "insert";

			$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocial($idUrl);
			$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolares($idUrl);
			$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculados($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(4)) {
				$nivel = $this->niveles->nivel1(4);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(4)) {
				$nivel = $this->niveles->nivel2(4);
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

			//Nivel 3 ServicioSocial
			if ($this->niveles->nivel3(4, 8)) {
				$nivel = $this->niveles->nivel3(4, 8);
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
					$data["ServicioSocial"] = $a;
				}
			}

			//Nivel 3 VisitasEscolares
			if ($this->niveles->nivel3(4, 9)) {
				$nivel = $this->niveles->nivel3(4, 9);
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
					$data["VisitasEscolares"] = $a;
				}
			}

			//Nivel 3 ProyectosVinculados
			if ($this->niveles->nivel3(4, 10)) {
				$nivel = $this->niveles->nivel3(4, 10);
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
					$data["ProyectosVinculados"] = $a;
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


                        $arrayUpdate = array(
                                'idEvaluacion' => $idUrl,
                                'cn10' => 1
                        );
                        $this->evaluacion->updateStatus($arrayUpdate);

			$data['main_cont'] = 'vinculacion/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	public function update_ProyectosVinculadosSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacionSup;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/vinculacion/proyectosSup';
			$config['upload_path']   = './uploads/vinculacion/proyectosSup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$new_name            = $eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							// echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						// echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'ProyectosVinculadosAct' => $this->input->post('a22'),
				'ProyectosVinculadosAnt' => $this->input->post('b22'),
				'idEvaluacion'           => $eval[0]->idEvaluacionSup,
				'comprobante1'           => $rutafiles[0],
			);
			$this->modelvinculacion->update_pvSup($dataNivel1);

			// redirect('vinculacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacionSup;
			$data['idUrl']   = $eval[0]->idEvaluacionSup;
			$data['message'] = "insert";

			$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocialSup($idUrl);
			$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolaresSup($idUrl);
			$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculadosSup($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(4)) {
				$nivel = $this->niveles->nivel1Sup(4);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(4)) {
				$nivel = $this->niveles->nivel2Sup(4);
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

			//Nivel 3 ServicioSocial
			if ($this->niveles->nivel3Sup(4, 9)) {
				$nivel = $this->niveles->nivel3Sup(4, 9);
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
					$data["ServicioSocial"] = $a;
				}
			}

			//Nivel 3 VisitasEscolares
			if ($this->niveles->nivel3Sup(4, 10)) {
				$nivel = $this->niveles->nivel3Sup(4, 10);
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
					$data["VisitasEscolares"] = $a;
				}
			}

			//Nivel 3 ProyectosVinculados
			if ($this->niveles->nivel3Sup(4, 11)) {
				$nivel = $this->niveles->nivel3Sup(4, 11);
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
					$data["ProyectosVinculados"] = $a;
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
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);


                        $arrayUpdate = array(
                                'idEvaluacionSup' => $idUrl,
                                'cn10' => 1
                        );
                        $this->evaluacion->updateStatusSup($arrayUpdate);

			$data['main_cont'] = 'vinculacion/indexSup';
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

				if ($data['datos']['Nivel'] == "MED") {

					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocial($idUrl);
						$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolares($idUrl);
						$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculados($idUrl);
						// Obtener informacion de las tablas
						// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
						// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1(4)) {
							$nivel = $this->niveles->nivel1(4);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2(4)) {
							$nivel = $this->niveles->nivel2(4);
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

						//Nivel 3 ServicioSocial
						if ($this->niveles->nivel3(4, 8)) {
							$nivel = $this->niveles->nivel3(4, 8);
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
								$data["ServicioSocial"] = $a;
							}
						}

						//Nivel 3 VisitasEscolares
						if ($this->niveles->nivel3(4, 9)) {
							$nivel = $this->niveles->nivel3(4, 9);
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
								$data["VisitasEscolares"] = $a;
							}
						}

						//Nivel 3 ProyectosVinculados
						if ($this->niveles->nivel3(4, 10)) {
							$nivel = $this->niveles->nivel3(4, 10);
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
								$data["ProyectosVinculados"] = $a;
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

						$data['main_cont'] = 'vinculacion/index';
						$this->load->view('includes/template_principal', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					// ++++++++++++++++++++++++++++++++++++++++++SUPERIOR++++++++++++++++++++++++++++++++++
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					if ($result) {
						$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocialSup($idUrl);
						$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolaresSup($idUrl);
						$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculadosSup($idUrl);
						// Obtener informacion de las tablas
						// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
						// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(4)) {
							$nivel = $this->niveles->nivel1Sup(4);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(4)) {
							$nivel = $this->niveles->nivel2Sup(4);
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

						//Nivel 3 ServicioSocial
						if ($this->niveles->nivel3Sup(4, 9)) {
							$nivel = $this->niveles->nivel3Sup(4, 9);
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
								$data["ServicioSocial"] = $a;
							}
						}

						//Nivel 3 VisitasEscolares
						if ($this->niveles->nivel3Sup(4, 10)) {
							$nivel = $this->niveles->nivel3Sup(4, 10);
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
								$data["VisitasEscolares"] = $a;
							}
						}

						//Nivel 3 ProyectosVinculados
						if ($this->niveles->nivel3Sup(4, 11)) {
							$nivel = $this->niveles->nivel3Sup(4, 11);
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
								$data["ProyectosVinculados"] = $a;
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
						$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

						$data['main_cont'] = 'vinculacion/indexSup';
						$this->load->view('includes/template_principal', $data);
					} else {
						redirect('login', 'refresh');
					}
				}
			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}

	}

}
