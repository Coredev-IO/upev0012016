<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Oferta extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('evaluacion', '', TRUE);
		$this->load->model('niveles', '', TRUE);
		$this->load->model('programas', '', TRUE);
		$this->load->model('infraestructura', '', TRUE);
	}

	//update apartado de programas academicos
	public function updateProgramasAcademicos() {
		if ($this->session->userdata('logged_in')) {
			$data['datos']   = $this->session->userdata('logged_in');
			$data['message'] = "insert";
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/oferta/programas';
			$config['upload_path']   = './uploads/oferta/programas';
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
				'TotalProgramas' => $this->input->post('b9'),
				'idEvaluacion'   => $eval[0]->idEvaluacion,
				'comprobante1'   => $rutafiles[0],
			);
			$this->programas->update($dataNivel1);

			// a  BProgramasAcademicos
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BProgramasAcademicos" => $this->input->post($row),
								"idUnidad"             => $data['datos']['idUnidad'],
								"idBloque"             => substr($row, 0, 3),
								"idEvaluacion"         => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BProgramasAcademicos($datos);

						}
					}
				}
			}

			// z  BProgramasAcademicosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'z') !== false) {
							$datos = array(
								"BProgramasAcademicosT" => $this->input->post($row),
								"idUnidad"              => $data['datos']['idUnidad'],
								"idBloque"              => substr($row, 0, 3),
								"idEvaluacion"          => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BProgramasAcademicosT($datos);

						}
					}
				}
			}

			// Obtener informacion de las tablas
			$idUrl                       = $eval[0]->idEvaluacion;
			$data['idUrl']               = $eval[0]->idEvaluacion;
			$data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			$data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(2)) {
				$nivel = $this->niveles->nivel1(2);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(2)) {
				$nivel = $this->niveles->nivel2(2);
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

			//Nivel 3 ProgramasAcademicos
			if ($this->niveles->nivel3(2, 3)) {
				$nivel = $this->niveles->nivel3(2, 3);
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
					$data["nivelProgramasAcademicos"] = $a;
				}
			}

			//Nivel 3 Infraestructura
			if ($this->niveles->nivel3(2, 4)) {
				$nivel = $this->niveles->nivel3(2, 4);
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
					$data["nivelInfraestructura"] = $a;
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

			$data['main_cont'] = 'oferta/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update apartado de programas academicos Superior
	public function updateProgramasAcademicosSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos']   = $this->session->userdata('logged_in');
			$data['message'] = "insert";
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/oferta/programassup';
			$config['upload_path']   = './uploads/oferta/programassup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 2; $p++) {
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
				'comprobante2' => $rutafiles[1],
			);
			$this->programas->updateSup($dataNivel1);

			// a  BProgramasAcademicos
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BProgramasAcedAcred" => $this->input->post($row),
								"idUnidad"            => $data['datos']['idUnidad'],
								"idBloque"            => substr($row, 0, 3),
								"idEvaluacion"        => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BProgramasAcademicosSup($datos);

						}
					}
				}
			}

			// z  BProgramasAcademicosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'z') !== false) {
							$datos = array(
								"BProgramasAcedAcredT" => $this->input->post($row),
								"idUnidad"             => $data['datos']['idUnidad'],
								"idBloque"             => substr($row, 0, 3),
								"idEvaluacion"         => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BProgramasAcademicosTSup($datos);

						}
					}
				}
			}

			// a  BProgramasAcademicos
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'b') !== false) {
							$datos = array(
								"BProgramasAcualizados" => $this->input->post($row),
								"idUnidad"              => $data['datos']['idUnidad'],
								"idBloque"              => substr($row, 0, 3),
								"idEvaluacion"          => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BProgramasAcademicosActSup($datos);

						}
					}
				}
			}

			// z  BProgramasAcademicosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'y') !== false) {
							$datos = array(
								"BProgramasAcualizadosT" => $this->input->post($row),
								"idUnidad"               => $data['datos']['idUnidad'],
								"idBloque"               => substr($row, 0, 3),
								"idEvaluacion"           => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BProgramasAcademicosActTSup($datos);

						}
					}
				}
			}

			// Obtener informacion de las tablas
			$idUrl                       = $eval[0]->idEvaluacionSup;
			$data['idUrl']               = $eval[0]->idEvaluacionSup;
			$data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicosSup($idUrl);
			$data['Infraestructura']     = $this->evaluacion->getInfraestructuraSup($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(2)) {
				$nivel = $this->niveles->nivel1Sup(2);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(2)) {
				$nivel = $this->niveles->nivel2Sup(2);
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

			//Nivel 3 ProgramasAcademicos
			if ($this->niveles->nivel3Sup(2, 3)) {
				$nivel = $this->niveles->nivel3Sup(2, 3);
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
					$data["nivelProgramasAcademicos"] = $a;
				}
			}

			//Nivel 3 Infraestructura
			if ($this->niveles->nivel3Sup(2, 5)) {
				$nivel = $this->niveles->nivel3Sup(2, 5);
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
					$data["nivelInfraestructura"] = $a;
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

			$data['main_cont'] = 'oferta/indexSup';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}

	//update laboratorios
	public function update_Laboratorios() {
		if ($this->session->userdata('logged_in')) {
			$data['datos']   = $this->session->userdata('logged_in');
			$data['message'] = "insert";
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/oferta/infraestructura';
			$config['upload_path']   = './uploads/oferta/infraestructura';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 3; $p++) {
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
				'AlumnosInscritos'   => $this->input->post('a10'),
				'CapacidadInstalada' => $this->input->post('b10'),
				'AulasEquipadas'     => $this->input->post('a11'),
				'TotalAulas'         => $this->input->post('b11'),
				'TotalLaboratorios'  => $this->input->post('b12'),
				'idEvaluacion'       => $eval[0]->idEvaluacion,
				'comprobante1'       => $rutafiles[0],
				'comprobante2'       => $rutafiles[1],
				'comprobante3'       => $rutafiles[2],
			);
			$this->infraestructura->update($dataNivel1);

			// b  BLaboratoriosEquipados
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'b') !== false) {
							$datos = array(
								"BLaboratoriosEquipados" => $this->input->post($row),
								"idUnidad"               => $data['datos']['idUnidad'],
								"idBloque"               => substr($row, 0, 3),
								"idEvaluacion"           => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BLaboratoriosEquipados($datos);

						}
					}
				}
			}

			// y  BLaboratoriosEquipadosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'y') !== false) {
							$datos = array(
								"BLaboratoriosEquipadosT" => $this->input->post($row),
								"idUnidad"                => $data['datos']['idUnidad'],
								"idBloque"                => substr($row, 0, 3),
								"idEvaluacion"            => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BLaboratoriosEquipadosT($datos);

						}
					}
				}
			}

			// Obtener informacion de las tablas
			$idUrl                       = $eval[0]->idEvaluacion;
			$data['idUrl']               = $eval[0]->idEvaluacion;
			$data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			$data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1(2)) {
				$nivel = $this->niveles->nivel1(2);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2(2)) {
				$nivel = $this->niveles->nivel2(2);
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

			//Nivel 3 ProgramasAcademicos
			if ($this->niveles->nivel3(2, 3)) {
				$nivel = $this->niveles->nivel3(2, 3);
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
					$data["nivelProgramasAcademicos"] = $a;
				}
			}

			//Nivel 3 Infraestructura
			if ($this->niveles->nivel3(2, 4)) {
				$nivel = $this->niveles->nivel3(2, 4);
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
					$data["nivelInfraestructura"] = $a;
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

			$data['main_cont'] = 'oferta/index';
			$this->load->view('includes/template_principal', $data);

		} else {
			redirect('login', 'refresh');
		}

	}


	//update laboratorios SUP
	public function update_LaboratoriosSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos']   = $this->session->userdata('logged_in');
			$data['message'] = "insert";
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile             = '/uploads/oferta/infraestructurasup';
			$config['upload_path']   = './uploads/oferta/infraestructurasup';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 3; $p++) {
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
				'CapacidadInstalada'   => $this->input->post('a12'),
				'NumeroAulas' => $this->input->post('a13'),
				'TotalAulas'     => $this->input->post('b13'),
				'NumeroLaboratorios'         => $this->input->post('a14'),
				'TotalLaboratorios'  => $this->input->post('b14'),
				'idEvaluacion'       => $eval[0]->idEvaluacionSup,
				'comprobante1'       => $rutafiles[0],
				'comprobante2'       => $rutafiles[1],
				'comprobante3'       => $rutafiles[2],
			);
			$this->infraestructura->updateSup($dataNivel1);


			// Obtener informacion de las tablas
			$idUrl                       = $eval[0]->idEvaluacionSup;
			$data['idUrl']               = $eval[0]->idEvaluacionSup;
			$data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicosSup($idUrl);
			$data['Infraestructura']     = $this->evaluacion->getInfraestructuraSup($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(2)) {
				$nivel = $this->niveles->nivel1Sup(2);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(2)) {
				$nivel = $this->niveles->nivel2Sup(2);
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

			//Nivel 3 ProgramasAcademicos
			if ($this->niveles->nivel3Sup(2, 3)) {
				$nivel = $this->niveles->nivel3Sup(2, 3);
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
					$data["nivelProgramasAcademicos"] = $a;
				}
			}

			//Nivel 3 Infraestructura
			if ($this->niveles->nivel3Sup(2, 5)) {
				$nivel = $this->niveles->nivel3Sup(2, 5);
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
					$data["nivelInfraestructura"] = $a;
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

			$data['main_cont'] = 'oferta/indexSup';
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
						$data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
						$data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1(2)) {
							$nivel = $this->niveles->nivel1(2);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2(2)) {
							$nivel = $this->niveles->nivel2(2);
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

						//Nivel 3 ProgramasAcademicos
						if ($this->niveles->nivel3(2, 3)) {
							$nivel = $this->niveles->nivel3(2, 3);
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
								$data["nivelProgramasAcademicos"] = $a;
							}
						}

						//Nivel 3 Infraestructura
						if ($this->niveles->nivel3(2, 4)) {
							$nivel = $this->niveles->nivel3(2, 4);
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
								$data["nivelInfraestructura"] = $a;
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

						$data['main_cont'] = 'oferta/index';
						$this->load->view('includes/template_principal', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					// SUPERIOR
					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);

					//Si existe lo deja continuar
					if ($result) {
						// Obtener informacion de las tablas
						$data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicosSup($idUrl);
						$data['Infraestructura']     = $this->evaluacion->getInfraestructuraSup($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(2)) {
							$nivel = $this->niveles->nivel1Sup(2);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(2)) {
							$nivel = $this->niveles->nivel2Sup(2);
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

						//Nivel 3 ProgramasAcademicos
						if ($this->niveles->nivel3Sup(2, 3)) {
							$nivel = $this->niveles->nivel3Sup(2, 3);
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
								$data["nivelProgramasAcademicos"] = $a;
							}
						}

						//Nivel 3 Infraestructura
						if ($this->niveles->nivel3Sup(2, 5)) {
							$nivel = $this->niveles->nivel3Sup(2, 5);
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
								$data["nivelInfraestructura"] = $a;
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

						$data['main_cont'] = 'oferta/indexSup';
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
