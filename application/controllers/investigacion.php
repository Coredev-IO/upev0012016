<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Investigacion extends CI_Controller {

	function __construct() {
		parent::__construct();

		$data['datos'] = $this->session->userdata('logged_in');
		$this->load->library('verify');
		$this->verify->seccion(2, $data['datos']['idRoles']);

		$this->load->model('evaluacion', '', TRUE);
		$this->load->model('niveles', '', TRUE);
		$this->load->model('investigacionmodel', '', TRUE);
	}

	//update apartado de update_Becas
	public function update_Profesores() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacion;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/investigacion/docente';
			$config['upload_path']   = './uploads/investigacion/docente';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
				$new_name            = $eval[0]->idEvaluacion."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							//echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						//echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'DocentesInvestigacion' => $this->input->post('a23'),
				'TotalDocentes'         => $this->input->post('b23'),
				'idEvaluacion'          => $eval[0]->idEvaluacion,
				'comprobante1'          => $rutafiles[0],
			);
			$this->investigacionmodel->update_id($dataNivel1);

			// redirect('investigacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacion;
			$data['idUrl']   = $eval[0]->idEvaluacion;
			$data['message'] = "insert";

			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
			$data['ApoyoDocenciaServ']         = $this->evaluacion->getApoyoDocencia($idUrl);
			$data['ParticipacionAlmunnosServ'] = $this->evaluacion->getParticipacionAlmunnos($idUrl);
			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(5)) {
				$nivel = $this->niveles->nivel1(5);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(5)) {
				$nivel = $this->niveles->nivel2(5);
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

			//Nivel 3 Apoyo de la investigacion a la docencia
			if ($this->niveles->nivel3(5, 11)) {
				$nivel = $this->niveles->nivel3(5, 11);
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
					$data["ApoyoDocencia"] = $a;
				}
			}

			//Nivel 3 Participación de los alumnos en investigaciones
			if ($this->niveles->nivel3(5, 12)) {
				$nivel = $this->niveles->nivel3(5, 12);
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
					$data["ParticipacionAlmunnos"] = $a;
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


                        $arrayUpdate = array(
                                'idEvaluacion' => $idUrl,
                                'cn11' => 1
                        );
                        $this->evaluacion->updateStatus($arrayUpdate);

			$data['main_cont'] = 'investigacion/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update apartado de update_Becas
	public function update_ProfesoresSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacionSup;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/investigacion/docenteSup';
			$config['upload_path']   = './uploads/investigacion/docenteSup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
				$new_name            = $eval[0]->idEvaluacionSup."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							//echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						//echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'DocentesInvestigacion' => $this->input->post('a23'),
				'TotalDocentes'         => $this->input->post('b23'),
				'idEvaluacion'          => $eval[0]->idEvaluacionSup,
				'comprobante1'          => $rutafiles[0],
			);
			$this->investigacionmodel->update_idSup($dataNivel1);

			// redirect('investigacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacionSup;
			$data['idUrl']   = $eval[0]->idEvaluacionSup;
			$data['message'] = "insert";

			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
			$data['ApoyoDocenciaServ']         = $this->evaluacion->getApoyoDocenciaSup($idUrl);
			$data['ParticipacionAlmunnosServ'] = $this->evaluacion->getParticipacionAlmunnosSup($idUrl);
			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(5)) {
				$nivel = $this->niveles->nivel1Sup(5);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(5)) {
				$nivel = $this->niveles->nivel2Sup(5);
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

			//Nivel 3 Apoyo de la investigacion a la docencia
			if ($this->niveles->nivel3Sup(5, 12)) {
				$nivel = $this->niveles->nivel3Sup(5, 12);
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
					$data["ApoyoDocencia"] = $a;
				}
			}

			//Nivel 3 Participación de los alumnos en investigaciones
			if ($this->niveles->nivel3Sup(5, 13)) {
				$nivel = $this->niveles->nivel3Sup(5, 13);
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
					$data["ParticipacionAlmunnos"] = $a;
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

                        $arrayUpdate = array(
                                'idEvaluacionSup' => $idUrl,
                                'cn11' => 1
                        );
                        $this->evaluacion->updateStatusSup($arrayUpdate);

			$data['main_cont'] = 'investigacion/indexSup';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	public function update_Alumnos() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacion;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/investigacion/alumnos';
			$config['upload_path']   = './uploads/investigacion/alumnos';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
				$new_name            = $eval[0]->idEvaluacion."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							//echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						//echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'AlumnosCoautores'       => $this->input->post('a24'),
				'ProfesoresConProyectos' => $this->input->post('b24'),
				'idEvaluacion'           => $eval[0]->idEvaluacion,
				'comprobante1'           => $rutafiles[0],
			);
			$this->investigacionmodel->update_ia($dataNivel1);

			// redirect('investigacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacion;
			$data['idUrl']   = $eval[0]->idEvaluacion;
			$data['message'] = "insert";

			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
			$data['ApoyoDocenciaServ']         = $this->evaluacion->getApoyoDocencia($idUrl);
			$data['ParticipacionAlmunnosServ'] = $this->evaluacion->getParticipacionAlmunnos($idUrl);
			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(5)) {
				$nivel = $this->niveles->nivel1(5);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(5)) {
				$nivel = $this->niveles->nivel2(5);
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

			//Nivel 3 Apoyo de la investigacion a la docencia
			if ($this->niveles->nivel3(5, 11)) {
				$nivel = $this->niveles->nivel3(5, 11);
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
					$data["ApoyoDocencia"] = $a;
				}
			}

			//Nivel 3 Participación de los alumnos en investigaciones
			if ($this->niveles->nivel3(5, 12)) {
				$nivel = $this->niveles->nivel3(5, 12);
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
					$data["ParticipacionAlmunnos"] = $a;
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


                        $arrayUpdate = array(
                                'idEvaluacion' => $idUrl,
                                'cn12' => 1
                        );
                        $this->evaluacion->updateStatus($arrayUpdate);

			$data['main_cont'] = 'investigacion/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	public function update_AlumnosSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                        $idUrl            = $eval[0]->idEvaluacionSup;
                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
			if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/investigacion/alumnosSup';
			$config['upload_path']   = './uploads/investigacion/alumnosSup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 1; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
				$new_name            = $eval[0]->idEvaluacionSup."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if (strlen($this->input->post('dataSrc'.$indicadorFile)) > 0) {
					// echo "trae archivo";
					$rutafiles[$p] = $this->input->post('dataSrc'.$indicadorFile);
					if (strlen($_FILES['datafile'.$indicadorFile]['name']) > 0) {
						// echo "Nombre input nuevo";
						$rutafiles[$p] = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$indicadorFile."_".str_replace(' ', '',$_FILES['datafile'.$indicadorFile]['name']);;
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							//echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				} else {

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						//echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'InnovacionesIncubadas'    => $this->input->post('a24'),
				'InnovacionesIncubadasAnt' => $this->input->post('b24'),
				'idEvaluacion'             => $eval[0]->idEvaluacionSup,
				'comprobante1'             => $rutafiles[0],
			);
			$this->investigacionmodel->update_iaSup($dataNivel1);

			// redirect('investigacion/reg/'.$eval[0]->idEvaluacion, 'refresh');

			$idUrl           = $eval[0]->idEvaluacionSup;
			$data['idUrl']   = $eval[0]->idEvaluacionSup;
			$data['message'] = "insert";

			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
			$data['ApoyoDocenciaServ']         = $this->evaluacion->getApoyoDocenciaSup($idUrl);
			$data['ParticipacionAlmunnosServ'] = $this->evaluacion->getParticipacionAlmunnosSup($idUrl);
			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(5)) {
				$nivel = $this->niveles->nivel1Sup(5);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(5)) {
				$nivel = $this->niveles->nivel2Sup(5);
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

			//Nivel 3 Apoyo de la investigacion a la docencia
			if ($this->niveles->nivel3Sup(5, 12)) {
				$nivel = $this->niveles->nivel3Sup(5, 12);
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
					$data["ApoyoDocencia"] = $a;
				}
			}

			//Nivel 3 Participación de los alumnos en investigaciones
			if ($this->niveles->nivel3Sup(5, 13)) {
				$nivel = $this->niveles->nivel3Sup(5, 13);
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
					$data["ParticipacionAlmunnos"] = $a;
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


                        $arrayUpdate = array(
                                'idEvaluacionSup' => $idUrl,
                                'cn12' => 1
                        );
                        $this->evaluacion->updateStatusSup($arrayUpdate);

			$data['main_cont'] = 'investigacion/indexSup';
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
				if ($data['datos']['Nivel'] == "MED") {//++++++++++++++++++++MEDIO SUPERIOR++++++++++++++++++++

					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						// Obtener informacion de las tablas
						// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
						// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
						$data['ApoyoDocenciaServ']         = $this->evaluacion->getApoyoDocencia($idUrl);
						$data['ParticipacionAlmunnosServ'] = $this->evaluacion->getParticipacionAlmunnos($idUrl);
						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1(5)) {
							$nivel = $this->niveles->nivel1(5);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2(5)) {
							$nivel = $this->niveles->nivel2(5);
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

						//Nivel 3 Apoyo de la investigacion a la docencia
						if ($this->niveles->nivel3(5, 11)) {
							$nivel = $this->niveles->nivel3(5, 11);
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
								$data["ApoyoDocencia"] = $a;
							}
						}

						//Nivel 3 Participación de los alumnos en investigaciones
						if ($this->niveles->nivel3(5, 12)) {
							$nivel = $this->niveles->nivel3(5, 12);
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
								$data["ParticipacionAlmunnos"] = $a;
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

						$data['main_cont'] = 'investigacion/index';
						$this->load->view('includes/template_principal', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {//++++++++++++++++++++++++++SUPERIOR++++++++++++++++++++++++++++++++++++
					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						$data['ApoyoDocenciaServ']         = $this->evaluacion->getApoyoDocenciaSup($idUrl);
						$data['ParticipacionAlmunnosServ'] = $this->evaluacion->getParticipacionAlmunnosSup($idUrl);
						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(5)) {
							$nivel = $this->niveles->nivel1Sup(5);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(5)) {
							$nivel = $this->niveles->nivel2Sup(5);
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

						//Nivel 3 Apoyo de la investigacion a la docencia
						if ($this->niveles->nivel3Sup(5, 12)) {
							$nivel = $this->niveles->nivel3Sup(5, 12);
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
								$data["ApoyoDocencia"] = $a;
							}
						}

						//Nivel 3 Participación de los alumnos en investigaciones
						if ($this->niveles->nivel3Sup(5, 13)) {
							$nivel = $this->niveles->nivel3Sup(5, 13);
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
								$data["ParticipacionAlmunnos"] = $a;
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

						$data['main_cont'] = 'investigacion/indexSup';
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
