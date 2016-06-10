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

			//Se prepara para adjuntar el archivo
			$nameurlfile = '/uploads/apoyo/becas';
			$config['upload_path']   = './uploads/apoyo/becas';
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

				if(strlen($this->input->post('dataSrc'.$indicadorFile))>0){
					// echo "trae archivo";
					$rutafiles[$p]       = $this->input->post('dataSrc'.$indicadorFile);
					if(strlen($_FILES['datafile'.$indicadorFile]['name'])>0){
						// echo "Nombre input nuevo";
						$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				}else{

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
			$dataNivel1 = array(
				'AlumnosBeca'  => $this->input->post('a13'),
				'TotalAlumnos' => $this->input->post('b13'),
				'idEvaluacion' => $eval[0]->idEvaluacion,
				'comprobante1'               => $rutafiles[0],
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

                        // redirect('apoyo', 'refresh');

		} else {
			redirect('login', 'refresh');
		}

	}

	// Update_BecasSup
	public function update_BecasSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile = '/uploads/apoyo/becasSup';
			$config['upload_path']   = './uploads/apoyo/becasSup';
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

				if(strlen($this->input->post('dataSrc'.$indicadorFile))>0){
					// echo "trae archivo";
					$rutafiles[$p]       = $this->input->post('dataSrc'.$indicadorFile);
					if(strlen($_FILES['datafile'.$indicadorFile]['name'])>0){
						// echo "Nombre input nuevo";
						$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				}else{

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			//Se obtienen valores del primer nivel
                        //Solo se sube el archivo no se necesitan mas campos de primer nivel
			$dataNivel1 = array(
				'idEvaluacion' => $eval[0]->idEvaluacionSup,
				'comprobante1'               => $rutafiles[0],
			);
			$this->becas->updateBecSup($dataNivel1);

			// redirect('apoyo/reg/'.$eval[0]->idEvaluacion, 'refresh');
			$idUrl             = $eval[0]->idEvaluacionSup;
			$data['idUrl']     = $eval[0]->idEvaluacionSup;
			$data['message']   = "insert";
			$data['BecasArr']  = $this->evaluacion->getBecasSup($idUrl);
			$data['Tutorias']  = $this->evaluacion->getTutoriasSup($idUrl);
			$data['Servicios'] = $this->evaluacion->getServiciosSup($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

                        // a  BProgramasAcademicos
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BBecas" => $this->input->post($row),
								"idUnidad"            => $data['datos']['idUnidad'],
								"idBloque"            => substr($row, 0, 3),
								"idEvaluacion"        => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BBecas($datos);

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
								"BBecasT" => $this->input->post($row),
								"idUnidad"             => $data['datos']['idUnidad'],
								"idBloque"             => substr($row, 0, 3),
								"idEvaluacion"         => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BBecasT($datos);

						}
					}
				}
			}

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(3)) {
				$nivel = $this->niveles->nivel1Sup(3);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(3)) {
				$nivel = $this->niveles->nivel2Sup(3);
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
			if ($this->niveles->nivel3Sup(3, 6)) {
				$nivel = $this->niveles->nivel3Sup(3, 6);
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
			if ($this->niveles->nivel3Sup(3, 6)) {
				$nivel = $this->niveles->nivel3Sup(3, 6);
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
			if ($this->niveles->nivel3Sup(3, 7)) {
				$nivel = $this->niveles->nivel3Sup(3, 7);
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
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

			$data['main_cont'] = 'apoyo/indexSup';
                        // print_r($data["Becas"]);
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

			//Se prepara para adjuntar el archivo
			$nameurlfile = '/uploads/apoyo/tutorias';
			$config['upload_path']   = './uploads/apoyo/tutorias';
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

				if(strlen($this->input->post('dataSrc'.$indicadorFile))>0){
					// echo "trae archivo";
					$rutafiles[$p]       = $this->input->post('dataSrc'.$indicadorFile);
					if(strlen($_FILES['datafile'.$indicadorFile]['name'])>0){
						// echo "Nombre input nuevo";
						$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				}else{

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			$dataNivel1 = array(
				'TotalAlumnos' => $this->input->post('b14'),
				'idEvaluacion' => $eval[0]->idEvaluacion,
				'comprobante1'               => $rutafiles[0],
			);
			$this->tutorias->update($dataNivel1);

			// a Rendimiento BAlumnosTutorados
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

			// z Rendimiento BAlumnosTutoradosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'z') !== false) {
							$datos = array(
								"BAlumnosTutoradosT" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BAlumnosTutoradosT($datos);

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

	//update Tutorias Sup
	public function update_TutoriasSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile = '/uploads/apoyo/tutoriasSup';
			$config['upload_path']   = './uploads/apoyo/tutoriasSup';
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

				if(strlen($this->input->post('dataSrc'.$indicadorFile))>0){
					// echo "trae archivo";
					$rutafiles[$p]       = $this->input->post('dataSrc'.$indicadorFile);
					if(strlen($_FILES['datafile'.$indicadorFile]['name'])>0){
						// echo "Nombre input nuevo";
						$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				}else{

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}

			$dataNivel1 = array(
				'idEvaluacion' => $eval[0]->idEvaluacionSup,
				'comprobante1'               => $rutafiles[0],
			);
			$this->tutorias->updateTutoSup($dataNivel1);

			// a Rendimiento BAlumnosTutorados
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'a') !== false) {
							$datos = array(
								"BAlumnosTutorados" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosTutoradosSup($datos);

						}
					}
				}
			}

			// z Rendimiento BAlumnosTutoradosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'z') !== false) {
							$datos = array(
								"BAlumnosTutoradosT" => $this->input->post($row),
								"idUnidad"          => $data['datos']['idUnidad'],
								"idBloque"          => substr($row, 0, 3),
								"idEvaluacion"      => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BAlumnosTutoradosTSup($datos);

						}
					}
				}
			}

			// redirect('apoyo/reg/'.$eval[0]->idEvaluacion, 'refresh');
			$idUrl             = $eval[0]->idEvaluacionSup;
			$data['idUrl']     = $eval[0]->idEvaluacionSup;
			$data['message']   = "insert";
			$data['BecasArr']  = $this->evaluacion->getBecasSup($idUrl);
			$data['Tutorias']  = $this->evaluacion->getTutoriasSup($idUrl);
			$data['Servicios'] = $this->evaluacion->getServiciosSup($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(3)) {
				$nivel = $this->niveles->nivel1Sup(3);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(3)) {
				$nivel = $this->niveles->nivel2Sup(3);
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
			if ($this->niveles->nivel3Sup(3, 6)) {
				$nivel = $this->niveles->nivel3Sup(3, 6);
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
			if ($this->niveles->nivel3Sup(3, 7)) {
				$nivel = $this->niveles->nivel3Sup(3, 7);
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
			if ($this->niveles->nivel3Sup(3, 8)) {
				$nivel = $this->niveles->nivel3Sup(3, 8);
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
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

			$data['main_cont'] = 'apoyo/indexSup';
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

			//Se prepara para adjuntar el archivo
			$nameurlfile = '/uploads/apoyo/apoyoEducativo';
			$config['upload_path']   = './uploads/apoyo/apoyoEducativo';
			$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|docx|xlsx|ppt|pptx|txt';
			$config['overwrite']     = TRUE;
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload');

			$rutafiles     = array();
			$indicadorFile = 1;

			//SE RECORRE LA CANTIDAD DE ARCHIVOS POR NIVEL NECESARIOS
			for ($p = 0; $p < 5; $p++) {
				$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$new_name            = $eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
				$config['file_name'] = $new_name;

				//Initialize
				$this->upload->initialize($config);

				if(strlen($this->input->post('dataSrc'.$indicadorFile))>0){
					// echo "trae archivo";
					$rutafiles[$p]       = $this->input->post('dataSrc'.$indicadorFile);
					if(strlen($_FILES['datafile'.$indicadorFile]['name'])>0){
						// echo "Nombre input nuevo";
						$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacion."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				}else{

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}


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
				'comprobante1'               => $rutafiles[0],
				'comprobante2'               => $rutafiles[1],
				'comprobante3'               => $rutafiles[2],
				'comprobante4'               => $rutafiles[3],
				'comprobante5'               => $rutafiles[4],
			);
			$this->apoyoserv->update($dataNivel1);

			// b Rendimiento BlibrosTitulosEditados
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

			// y Rendimiento BlibrosTitulosEditadosT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'y') !== false) {
							$datos = array(
								"BlibrosTitulosEditadosT" => $this->input->post($row),
								"idUnidad"               => $data['datos']['idUnidad'],
								"idBloque"               => substr($row, 0, 3),
								"idEvaluacion"           => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BlibrosTitulosEditadosT($datos);

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

			//c BTotalEjemplaresT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'x') !== false) {
							$datos = array(
								"BTotalEjemplaresT" => $this->input->post($row),
								"idUnidad"         => $data['datos']['idUnidad'],
								"idBloque"         => substr($row, 0, 3),
								"idEvaluacion"     => $eval[0]->idEvaluacion,

							);
							$this->evaluacion->update_BTotalEjemplaresT($datos);

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

	//update_ServicioApoyo Superior
	public function update_ServicioApoyoSup() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			// print_r(array_keys($this->input->post()));
			$keys = array_keys($this->input->post());
			$eval = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);

			//Se prepara para adjuntar el archivo
			$nameurlfile = '/uploads/apoyo/apoyoEducativosup';
			$config['upload_path']   = './uploads/apoyo/apoyoEducativosup';
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

				if(strlen($this->input->post('dataSrc'.$indicadorFile))>0){
					// echo "trae archivo";
					$rutafiles[$p]       = $this->input->post('dataSrc'.$indicadorFile);
					if(strlen($_FILES['datafile'.$indicadorFile]['name'])>0){
						// echo "Nombre input nuevo";
						$rutafiles[$p]       = $nameurlfile."/".$eval[0]->idEvaluacionSup."_".$indicadorFile."_".$_FILES['datafile'.$indicadorFile]['name'];
						if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
							echo $this->upload->display_errors();

						} else {
							$dataFile = array('upload_data' => $this->upload->data());
						}

					}

				}else{

					if (!$this->upload->do_upload('datafile'.$indicadorFile)) {
						echo $this->upload->display_errors();

					} else {
						$dataFile = array('upload_data' => $this->upload->data());
					}
				}

				$indicadorFile++;

			}


			$dataNivel1 = array(
				'LibrosActualizados'       => $this->input->post('b15'),
				'TotalAcervoLibros'      => $this->input->post('b16'),
				'MantenimientoAtendido'   => $this->input->post('a18'),
				'MantenimientoSolicitado' => $this->input->post('b18'),
				'LimpiezaAtendida'        => $this->input->post('a19'),
				'LimpiezaProgramada'      => $this->input->post('b19'),
				'idEvaluacion'            => $eval[0]->idEvaluacionSup,
				'comprobante1'               => $rutafiles[0],
				'comprobante2'               => $rutafiles[1],
				'comprobante3'               => $rutafiles[2],
			);
			$this->apoyoserv->update_ApoyoSup($dataNivel1);

			// b Titulados
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'b') !== false) {
							$datos = array(
								"BTitulosAct" => $this->input->post($row),
								"idUnidad"               => $data['datos']['idUnidad'],
								"idBloque"               => substr($row, 0, 3),
								"idEvaluacion"           => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BTitulosAct($datos);

						}
					}
				}
			}

			// y BTitulosActT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'y') !== false) {
							$datos = array(
								"BTitulosActT" => $this->input->post($row),
								"idUnidad"               => $data['datos']['idUnidad'],
								"idBloque"               => substr($row, 0, 3),
								"idEvaluacion"           => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BTitulosActT($datos);

						}
					}
				}
			}

			//   BCumplimientoMant
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'c') !== false) {
							$datos = array(
								"BCumplimientoMant" => $this->input->post($row),
								"idUnidad"         => $data['datos']['idUnidad'],
								"idBloque"         => substr($row, 0, 3),
								"idEvaluacion"     => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BCumplimientoMant($datos);

						}
					}
				}
			}

			//c BCumplimientoMantT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'x') !== false) {
							$datos = array(
								"BCumplimientoMantT" => $this->input->post($row),
								"idUnidad"         => $data['datos']['idUnidad'],
								"idBloque"         => substr($row, 0, 3),
								"idEvaluacion"     => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BCumplimientoMantT($datos);

						}
					}
				}
			}

			//   BCumplimientoProgLimp
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'd') !== false) {
							$datos = array(
								"BCumplimientoProgLimp" => $this->input->post($row),
								"idUnidad"         => $data['datos']['idUnidad'],
								"idBloque"         => substr($row, 0, 3),
								"idEvaluacion"     => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BCumplimientoProgLimp($datos);

						}
					}
				}
			}

			//c BCumplimientoProgLimpT
			foreach ($keys as $row) {
				if (strlen($row) <= 8) {
					if (strpos($row, '-') !== false) {
						if (strpos($row, 'w') !== false) {
							$datos = array(
								"BCumplimientoProgLimpT" => $this->input->post($row),
								"idUnidad"         => $data['datos']['idUnidad'],
								"idBloque"         => substr($row, 0, 3),
								"idEvaluacion"     => $eval[0]->idEvaluacionSup,

							);
							$this->evaluacion->update_BCumplimientoProgLimpT($datos);

						}
					}
				}
			}

			// redirect('apoyo/reg/'.$eval[0]->idEvaluacion, 'refresh');
			$idUrl             = $eval[0]->idEvaluacionSup;
			$data['idUrl']     = $eval[0]->idEvaluacionSup;
			$data['message']   = "insert";
			$data['BecasArr']  = $this->evaluacion->getBecasSup($idUrl);
			$data['Tutorias']  = $this->evaluacion->getTutoriasSup($idUrl);
			$data['Servicios'] = $this->evaluacion->getServiciosSup($idUrl);
			// Obtener informacion de las tablas
			// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
			// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

			//Obtiene informacion de los titulos
			// Nivel 1
			if ($this->niveles->nivel1Sup(3)) {
				$nivel = $this->niveles->nivel1Sup(3);
				foreach ($nivel as $row) {
					$array = array(
						'Nombre' => $row->Nombre,
						'Valor'  => $row->Valor,
					);
					$data["nivel1"] = $array;
				}
			}

			//Nivel 2
			if ($this->niveles->nivel2Sup(3)) {
				$nivel = $this->niveles->nivel2Sup(3);
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
			if ($this->niveles->nivel3Sup(3, 5)) {
				$nivel = $this->niveles->nivel3Sup(3, 5);
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
			if ($this->niveles->nivel3Sup(3, 6)) {
				$nivel = $this->niveles->nivel3Sup(3, 6);
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
			if ($this->niveles->nivel3Sup(3, 7)) {
				$nivel = $this->niveles->nivel3Sup(3, 7);
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
			$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

			$data['main_cont'] = 'apoyo/indexSup';
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

					//Si existe lo deja continuar
					if ($result) {

						$data['BecasArr']  = $this->evaluacion->getBecas($idUrl);
						$data['Tutorias']  = $this->evaluacion->getTutorias($idUrl);
						$data['Servicios'] = $this->evaluacion->getServicios($idUrl);

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
				} else {

					// SUPERIOR
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);

					//Si existe lo deja continuar
					if ($result) {

						$data['BecasArr']  = $this->evaluacion->getBecasSup($idUrl);
						$data['Tutorias']  = $this->evaluacion->getTutoriasSup($idUrl);
						$data['Servicios'] = $this->evaluacion->getServiciosSup($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(3)) {
							$nivel = $this->niveles->nivel1Sup(3);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(3)) {
							$nivel = $this->niveles->nivel2Sup(3);
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
						if ($this->niveles->nivel3Sup(3, 6)) {
							$nivel = $this->niveles->nivel3Sup(3, 6);
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
						if ($this->niveles->nivel3Sup(3, 7)) {
							$nivel = $this->niveles->nivel3Sup(3, 7);
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
						if ($this->niveles->nivel3Sup(3, 8)) {
							$nivel = $this->niveles->nivel3Sup(3, 8);
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
						$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

						$data['main_cont'] = 'apoyo/indexSup';
						// print_r($data['BecasArr']);
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
