<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Desempeno extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('evaluacion', '', TRUE);
		$this->load->model('niveles', '', TRUE);
		$this->load->model('alumnos', '', TRUE);
		$this->load->model('docentes', '', TRUE);
		$this->load->helper(array('form', 'url'));
	}
	//update apartado de alumnos
	public function updateAlumnos() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/desempeno/alumnos';
			$config['upload_path']   = './uploads/desempeno/alumnos';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 4; $p++) {
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
                                                        // print_r($dataFile);
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
			// print_r($rutafiles);
			// echo $rutafiles[0];

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'AlumnosInscritos'           => $this->input->post('b1'),
				'AlumnosTotalesCohorte'      => $this->input->post('b2'),
				'AlumnosEgresadosGeneracion' => $this->input->post('b3'),
				'AlumnosExamenNSIPN'         => $this->input->post('b4'),
				'idEvaluacion'               => $eval[0]->idEvaluacion,
				'comprobante1'               => $rutafiles[0],
				'comprobante2'               => $rutafiles[1],
				'comprobante3'               => $rutafiles[2],
				'comprobante4'               => $rutafiles[3],
			);
			$this->alumnos->update_Alumnos($dataNivel1);

			// a Rendimiento BAlumnosRegulares
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BAlumnosRegulares" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BAlumnosRegulares($datos);

						}
					}
				}
			}

			// z Rendimiento BAlumnosRegulares Total
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'z') !== false) {
							$datos = array(
								"BAlumnosRegularesT" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BAlumnosRegularesT($datos);

						}
					}
				}
			}

			// b Eficiencia terminal BEficienciaTerminal
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'b') !== false) {
							$datos = array(
								"BEficienciaTerminal" => $this->input->post($row),
								"idUnidad"            => $data['datos']['idUnidad'],
								"idBloque"            => substr($row, 0, 3),
								"idEvaluacion"        => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BEficienciaTerminal($datos);

						}
					}
				}
			}

			// Y Eficiencia terminal BEficienciaTerminal
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'y') !== false) {
							$datos = array(
								"BEficienciaTerminalT" => $this->input->post($row),
								"idUnidad"             => $data['datos']['idUnidad'],
								"idBloque"             => substr($row, 0, 3),
								"idEvaluacion"         => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BEficienciaTerminalT($datos);

						}
					}
				}
			}

			// c Titulación
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'c') !== false) {
							$datos = array(
								"BAlumnosTitulados" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BAlumnosTitulados($datos);

						}
					}
				}
			}

			// c Titulación
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'x') !== false) {
							$datos = array(
								"BAlumnosTituladosT" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BAlumnosTituladosT($datos);

						}
					}
				}
			}

			// d Promoción de NMS a NS
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'd') !== false) {
							$datos = array(
								"BPromocionNS" => $this->input->post($row),
								"idUnidad"     => $data['datos']['idUnidad'],
								"idBloque"     => substr($row, 0, 3),
								"idEvaluacion" => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BPromocionNS($datos);

						}
					}
				}
			}

			// d Promoción de NMS a NS
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'w') !== false) {
							$datos = array(
								"BPromocionNST" => $this->input->post($row),
								"idUnidad"      => $data['datos']['idUnidad'],
								"idBloque"      => substr($row, 0, 3),
								"idEvaluacion"  => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BPromocionNST($datos);

						}
					}
				}
			}

			// redirect('desempeno/reg/'.$eval[0]->idEvaluacion, 'refresh');
			//
			//
			// Obtener informacion de las tablas
			$idUrl            = $eval[0]->idEvaluacion;
			$data['idUrl']    = $eval[0]->idEvaluacion;
			$data['message']  = "insert";
			$data['Alumnos']  = $this->evaluacion->getAlumnos($idUrl);
			$data['Docentes'] = $this->evaluacion->getDocentes($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(1)) {
				$nivel = $this->niveles->nivel1(1);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(1)) {
				$nivel = $this->niveles->nivel2(1);
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

			//Nivel 3 Alumnos
			if ($this->niveles->nivel3(1, 1)) {
				$nivel = $this->niveles->nivel3(1, 1);
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
					$data["nivelAlumnos"] = $a;
				}
			}

			//Nivel 3 Docentes
			if ($this->niveles->nivel3(1, 2)) {
				$nivel = $this->niveles->nivel3(1, 2);
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
					$data["nivelDocentes"] = $a;
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

			$data['main_cont'] = 'desempeno/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update apartado de alumnos SUPERIOR
	public function updateAlumnosSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/desempeno/alumnossup';
			$config['upload_path']   = './uploads/desempeno/alumnossup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 5; $p++) {
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
			// print_r($rutafiles);
			// echo $rutafiles[0];

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'idEvaluacion' => $eval[0]->idEvaluacionSup,
				'comprobante1' => $rutafiles[0],
				'comprobante2' => $rutafiles[1],
				'comprobante3' => $rutafiles[2],
				'comprobante4' => $rutafiles[3],
				'comprobante5' => $rutafiles[4],
			);
			$this->alumnos->update_AlumnosSup($dataNivel1);

			// a Rendimiento BAlumnosRegulares
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BAlumnosRegulares" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosRegularesSup($datos);

						}
					}
				}
			}

			// z Rendimiento BAlumnosRegulares Total
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'z') !== false) {
							$datos = array(
								"BAlumnosRegularesT" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosRegularesTSup($datos);

						}
					}
				}
			}

			// b Eficiencia terminal BEficienciaTerminal
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'b') !== false) {
							$datos = array(
								"BEficienciaTerminal" => $this->input->post($row),
								"idUnidad"            => $data['datos']['idUnidad'],
								"idBloque"            => substr($row, 0, 3),
								"idEvaluacion"        => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BEficienciaTerminalSup($datos);

						}
					}
				}
			}

			// Y Eficiencia terminal BEficienciaTerminal
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'y') !== false) {
							$datos = array(
								"BEficienciaTerminalT" => $this->input->post($row),
								"idUnidad"             => $data['datos']['idUnidad'],
								"idBloque"             => substr($row, 0, 3),
								"idEvaluacion"         => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BEficienciaTerminalTSup($datos);

						}
					}
				}
			}

			// c Titulación
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'c') !== false) {
							$datos = array(
								"BAlumnosTitulados" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosTituladosSup($datos);

						}
					}
				}
			}

			// c Titulación
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'x') !== false) {
							$datos = array(
								"BAlumnosTituladosT" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosTituladosTSup($datos);

						}
					}
				}
			}

			// d Promoción de NMS a NS
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'd') !== false) {
							$datos = array(
								"BAlumnosRiesgoAbandono" => $this->input->post($row),
								"idUnidad"               => $data['datos']['idUnidad'],
								"idBloque"               => substr($row, 0, 3),
								"idEvaluacion"           => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosRiesgoAbandonoSup($datos);

						}
					}
				}
			}

			// d Promoción de NMS a NS
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'w') !== false) {
							$datos = array(
								"BAlumnosRiesgoAbandonoT" => $this->input->post($row),
								"idUnidad"                => $data['datos']['idUnidad'],
								"idBloque"                => substr($row, 0, 3),
								"idEvaluacion"            => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosRiesgoAbandonoTSup($datos);

						}
					}
				}
			}

			// d Promoción de NMS a NS
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'e') !== false) {
							$datos = array(
								"BRecienEgresados" => $this->input->post($row),
								"idUnidad"         => $data['datos']['idUnidad'],
								"idBloque"         => substr($row, 0, 3),
								"idEvaluacion"     => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BRecienEgresadosSup($datos);

						}
					}
				}
			}

			// d Promoción de NMS a NS
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'v') !== false) {
							$datos = array(
								"BRecienEgresadosT" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BRecienEgresadosTSup($datos);

						}
					}
				}
			}

			// redirect('desempeno/reg/'.$eval[0]->idEvaluacion, 'refresh');
			//
			//
			// Obtener informacion de las tablas
			$idUrl            = $eval[0]->idEvaluacionSup;
			$data['idUrl']    = $eval[0]->idEvaluacionSup;
			$data['message']  = "insert";
			$data['Alumnos']  = $this->evaluacion->getAlumnosSup($idUrl);
			$data['Docentes'] = $this->evaluacion->getDocentesSup($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(1)) {
				$nivel = $this->niveles->nivel1Sup(1);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(1)) {
				$nivel = $this->niveles->nivel2Sup(1);
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

			//Nivel 3 Alumnos
			if ($this->niveles->nivel3Sup(1, 1)) {
				$nivel = $this->niveles->nivel3Sup(1, 1);
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
					$data["nivelAlumnos"] = $a;
				}
			}

			//Nivel 3 Docentes
			if ($this->niveles->nivel3Sup(1, 2)) {
				$nivel = $this->niveles->nivel3Sup(1, 2);
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
					$data["nivelDocentes"] = $a;
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

			$data['main_cont'] = 'desempeno/indexSup';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}
	//update apartado de docencia
	public function updateDocencia() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/desempeno/docentes';
			$config['upload_path']   = './uploads/desempeno/docentes';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 4; $p++) {
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
			// print_r($rutafiles);
			// echo $rutafiles[0];

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'TotalHorasReglamento'               => $this->input->post('b5'),
				'TotalDocentesContratadosAsignatura' => $this->input->post('b6'),
				'TotalProfesores'                    => $this->input->post('b7'),
				'DocentesPertenecientes'             => $this->input->post('b8'),
				'idEvaluacion'                       => $eval[0]->idEvaluacion,
				'comprobante1'                       => $rutafiles[0],
				'comprobante2'                       => $rutafiles[1],
				'comprobante3'                       => $rutafiles[2],
				'comprobante4'                       => $rutafiles[3],
			);
			$this->docentes->update_Docentes($dataNivel1);

			// e Aprovechamiento de la planta docente BHorasFrenteGrupo
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'e') !== false) {
							$datos = array(
								"BHorasFrenteGrupo" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BHorasFrenteGrupo($datos);

						}
					}
				}
			}

			// v Aprovechamiento de la planta docente BHorasFrenteGrupoT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'v') !== false) {
							$datos = array(
								"BHorasFrenteGrupoT" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BHorasFrenteGrupoT($datos);

						}
					}
				}
			}

			// f Docentes de asignatura activos en el sector productivo BProfesoresActivos
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'f') !== false) {
							$datos = array(
								"BProfesoresActivos" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BProfesoresActivos($datos);

						}
					}
				}
			}

			// u Docentes de asignatura activos en el sector productivo BProfesoresActivosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'u') !== false) {
							$datos = array(
								"BProfesoresActivosT" => $this->input->post($row),
								"idUnidad"            => $data['datos']['idUnidad'],
								"idBloque"            => substr($row, 0, 3),
								"idEvaluacion"        => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BProfesoresActivosT($datos);

						}
					}
				}
			}

			// g Docentes actualizados en el área diciplinar BProfesoresActualizados
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'g') !== false) {
							$datos = array(
								"BProfesoresActualizados" => $this->input->post($row),
								"idUnidad"                => $data['datos']['idUnidad'],
								"idBloque"                => substr($row, 0, 3),
								"idEvaluacion"            => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BProfesoresActualizados($datos);

						}
					}
				}
			}

			// t Docentes actualizados en el área diciplinar BProfesoresActualizadosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 't') !== false) {
							$datos = array(
								"BProfesoresActualizadosT" => $this->input->post($row),
								"idUnidad"                 => $data['datos']['idUnidad'],
								"idBloque"                 => substr($row, 0, 3),
								"idEvaluacion"             => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BProfesoresActualizadosT($datos);

						}
					}
				}
			}

			// h Desempeño docente por academia BEvaluacionesIndividuales
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'h') !== false) {
							$datos = array(
								"BEvaluacionesIndividuales" => $this->input->post($row),
								"idUnidad"                  => $data['datos']['idUnidad'],
								"idBloque"                  => substr($row, 0, 3),
								"idEvaluacion"              => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BEvaluacionesIndividuales($datos);

						}
					}
				}
			}

			// s Desempeño docente por academia BEvaluacionesIndividualesT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 's') !== false) {
							$datos = array(
								"BEvaluacionesIndividualesT" => $this->input->post($row),
								"idUnidad"                   => $data['datos']['idUnidad'],
								"idBloque"                   => substr($row, 0, 3),
								"idEvaluacion"               => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BEvaluacionesIndividualesT($datos);

						}
					}
				}
			}

			// redirect('desempeno/reg/'.$eval[0]->idEvaluacion, 'refresh');
			$idUrl           = $eval[0]->idEvaluacion;
			$data['idUrl']   = $eval[0]->idEvaluacion;
			$data['message'] = "insert";
			// Obtener informacion de las tablas
			$data['Alumnos']  = $this->evaluacion->getAlumnos($idUrl);
			$data['Docentes'] = $this->evaluacion->getDocentes($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(1)) {
				$nivel = $this->niveles->nivel1(1);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(1)) {
				$nivel = $this->niveles->nivel2(1);
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

			//Nivel 3 Alumnos
			if ($this->niveles->nivel3(1, 1)) {
				$nivel = $this->niveles->nivel3(1, 1);
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
					$data["nivelAlumnos"] = $a;
				}
			}

			//Nivel 3 Docentes
			if ($this->niveles->nivel3(1, 2)) {
				$nivel = $this->niveles->nivel3(1, 2);
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
					$data["nivelDocentes"] = $a;
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

			$data['main_cont'] = 'desempeno/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	public function updateDocenciaSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/desempeno/docentessup';
			$config['upload_path']   = './uploads/desempeno/docentessup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 4; $p++) {
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
			// print_r($rutafiles);
			// echo $rutafiles[0];

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(

				'idEvaluacion'                       => $eval[0]->idEvaluacionSup,
				'TotalHorasBase'                     => $this->input->post('a6'),
				'DocentesActivosProductivo'          => $this->input->post('a7'),
				'ProfesoresParaDocencias'            => $this->input->post('a8'),
				'ProfesoresActualizados'             => $this->input->post('a9'),
				'TotalHorasReglamento'               => $this->input->post('b6'),
				'TotalDocentesContratadosAsignatura' => $this->input->post('b7'),
				'TotalProfesores'                    => $this->input->post('b8'),
				'TotalPrefesores'                    => $this->input->post('b9'),
				'comprobante1'                       => $rutafiles[0],
				'comprobante2'                       => $rutafiles[1],
				'comprobante3'                       => $rutafiles[2],
				'comprobante4'                       => $rutafiles[3],
			);
			$this->docentes->update_DocentesSup($dataNivel1);

			// e Aprovechamiento de la planta docente BHorasFrenteGrupo
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'f') !== false) {
							$datos = array(
								"BHorasFrenteGrupo" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BHorasFrenteGrupoSup($datos);

						}
					}
				}
			}

			// v Aprovechamiento de la planta docente BHorasFrenteGrupoT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'u') !== false) {
							$datos = array(
								"BHorasFrenteGrupoT" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BHorasFrenteGrupoTSup($datos);

						}
					}
				}
			}

			// f Docentes de asignatura activos en el sector productivo BProfesoresActivos
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'g') !== false) {
							$datos = array(
								"BProfesoresActivos" => $this->input->post($row),
								"idUnidad"           => $data['datos']['idUnidad'],
								"idBloque"           => substr($row, 0, 3),
								"idEvaluacion"       => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BProfesoresActivosSup($datos);

						}
					}
				}
			}

			// u Docentes de asignatura activos en el sector productivo BProfesoresActivosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 't') !== false) {
							$datos = array(
								"BProfesoresActivosT" => $this->input->post($row),
								"idUnidad"            => $data['datos']['idUnidad'],
								"idBloque"            => substr($row, 0, 3),
								"idEvaluacion"        => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BProfesoresActivosTSup($datos);

						}
					}
				}
			}

			// g Docentes actualizados en el área diciplinar BProfesoresActualizados
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'h') !== false) {
							$datos = array(
								"BProfesoresActualizados" => $this->input->post($row),
								"idUnidad"                => $data['datos']['idUnidad'],
								"idBloque"                => substr($row, 0, 3),
								"idEvaluacion"            => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BProfesoresActualizadosSup($datos);

						}
					}
				}
			}

			// t Docentes actualizados en el área diciplinar BProfesoresActualizadosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 's') !== false) {
							$datos = array(
								"BProfesoresActualizadosT" => $this->input->post($row),
								"idUnidad"                 => $data['datos']['idUnidad'],
								"idBloque"                 => substr($row, 0, 3),
								"idEvaluacion"             => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BProfesoresActualizadosTSup($datos);

						}
					}
				}
			}

			// h Desempeño docente por academia BEvaluacionesIndividuales
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'i') !== false) {
							$datos = array(
								"BEvaluacionesIndividuales" => $this->input->post($row),
								"idUnidad"                  => $data['datos']['idUnidad'],
								"idBloque"                  => substr($row, 0, 3),
								"idEvaluacion"              => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BEvaluacionesIndividualesSup($datos);

						}
					}
				}
			}

			// s Desempeño docente por academia BEvaluacionesIndividualesT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'r') !== false) {
							$datos = array(
								"BEvaluacionesIndividualesT" => $this->input->post($row),
								"idUnidad"                   => $data['datos']['idUnidad'],
								"idBloque"                   => substr($row, 0, 3),
								"idEvaluacion"               => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BEvaluacionesIndividualesTSup($datos);

						}
					}
				}
			}

			// redirect('desempeno/reg/'.$eval[0]->idEvaluacion, 'refresh');
			$idUrl           = $eval[0]->idEvaluacionSup;
			$data['idUrl']   = $eval[0]->idEvaluacionSup;
			$data['message'] = "insert";
			// Obtener informacion de las tablas
			$data['Alumnos']  = $this->evaluacion->getAlumnosSup($idUrl);
			$data['Docentes'] = $this->evaluacion->getDocentesSup($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(1)) {
				$nivel = $this->niveles->nivel1Sup(1);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(1)) {
				$nivel = $this->niveles->nivel2Sup(1);
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

			//Nivel 3 Alumnos
			if ($this->niveles->nivel3Sup(1, 1)) {
				$nivel = $this->niveles->nivel3Sup(1, 1);
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
					$data["nivelAlumnos"] = $a;
				}
			}

			//Nivel 3 Docentes
			if ($this->niveles->nivel3Sup(1, 2)) {
				$nivel = $this->niveles->nivel3Sup(1, 2);
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
					$data["nivelDocentes"] = $a;
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

			$data['main_cont'] = 'desempeno/indexSup';
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

				//SE DEFINE SI LA EVALAUCION ES SUP O MED
				if ($data['datos']['Nivel'] == "MED") {
					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);

					//Si existe lo deja continuar
					if ($result) {
						// Obtener informacion de las tablas
						$data['Alumnos']  = $this->evaluacion->getAlumnos($idUrl);
						$data['Docentes'] = $this->evaluacion->getDocentes($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1(1)) {
							$nivel = $this->niveles->nivel1(1);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2(1)) {
							$nivel = $this->niveles->nivel2(1);
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

						//Nivel 3 Alumnos
						if ($this->niveles->nivel3(1, 1)) {
							$nivel = $this->niveles->nivel3(1, 1);
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
								$data["nivelAlumnos"] = $a;
							}
						}

						//Nivel 3 Docentes
						if ($this->niveles->nivel3(1, 2)) {
							$nivel = $this->niveles->nivel3(1, 2);
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
								$data["nivelDocentes"] = $a;
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

						$data['main_cont'] = 'desempeno/index';
						$this->load->view('includes/template_principal', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					//SUPERIOR
					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);

					//Si existe lo deja continuar
					if ($result) {
						// Obtener informacion de las tablas
						$data['Alumnos']  = $this->evaluacion->getAlumnosSup($idUrl);
						$data['Docentes'] = $this->evaluacion->getDocentesSup($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(1)) {
							$nivel = $this->niveles->nivel1Sup(1);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(1)) {
							$nivel = $this->niveles->nivel2Sup(1);
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

						//Nivel 3 Alumnos
						if ($this->niveles->nivel3Sup(1, 1)) {
							$nivel = $this->niveles->nivel3Sup(1, 1);
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
								$data["nivelAlumnos"] = $a;
							}
						}

						//Nivel 3 Docentes
						if ($this->niveles->nivel3Sup(1, 2)) {
							$nivel = $this->niveles->nivel3Sup(1, 2);
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
								$data["nivelDocentes"] = $a;
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

						// print_r($data['IndicadorMs']);

						$data['main_cont'] = 'desempeno/indexSup';
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
