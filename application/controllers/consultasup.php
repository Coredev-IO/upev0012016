<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Consultasup extends CI_Controller {

	function __construct() {
		parent::__construct();
                //SE VERIFICA LA SESION
                $data['datos'] = $this->session->userdata('logged_in');
                $this->load->library('verify');
                $this->verify->seccion(4, $data['datos']['idRoles']);
                $this->load->model('unidades', '', TRUE);
                $this->load->model('evaluacion', '', TRUE);


                $this->load->model('niveles', '', TRUE);
                $this->load->model('alumnos', '', TRUE);
                $this->load->model('docentes', '', TRUE);
                $this->load->helper(array('form', 'url'));

                $this->load->model('programas', '', TRUE);
                $this->load->model('infraestructura', '', TRUE);

                $this->load->model('becas', '', TRUE);
                $this->load->model('tutorias', '', TRUE);
                $this->load->model('apoyoserv', '', TRUE);

		$this->load->model('modelvinculacion', '', TRUE);
                $this->load->model('investigacionmodel', '', TRUE);
                $this->load->model('recursos', '', TRUE);
	}



        public function index() {
                $data['datos'] = $this->session->userdata('logged_in');
                $data['unidades'] = $this->unidades->getUnidades('SUP');
                $data['main_cont'] = 'consultasup/index';
                $this->load->view('includes/template_consultasup', $data);
        }


        public function check() {
                $data['datos'] = $this->session->userdata('logged_in');
                $urlRed = "consultasup/rev/".$this->input->post('idUnidad');
		redirect($urlRed, 'refresh');
        }


        public function rev() {
                $data['datos'] = $this->session->userdata('logged_in');
                $data['evaluaciones'] = $this->evaluacion->getEvaluacionesSuperiorEscuela($this->uri->segment(3));
                $data['unidad'] = $this->unidades->getUnidad($this->uri->segment(3));
                $data['main_cont'] = 'consultasup/rev';
                $this->load->view('includes/template_consultasup', $data);
        }


        public function consulta1() {

		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "SUP";
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				//Escuela
				//Se obtiene id de la url
				$idUrl         = $this->uri->segment(4);
				$data['idUrl'] = $idUrl;

				//SE DEFINE SI LA EVALAUCION ES SUP O MED
				if ($data['datos']['Nivel'] == "MED") {
					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

						$data['main_cont'] = 'desempeno/consultasup';
						$this->load->view('includes/template_consulta_rev_sup', $data);
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

        public function consulta2() {
                if ($this->session->userdata('logged_in')) {
                        $data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "SUP";
                        if ($data['datos']['idRoles'] == 1) {
                                //Admin
                                echo "Permiso denegado";

                        } else {
                                //Escuela
                                //Se obtiene id de la url
                                $idUrl         = $this->uri->segment(4);
                                $data['idUrl'] = $idUrl;

                                //SE DEFINE SI LA EVALAUCION ES SUP O MED
                                if ($data['datos']['Nivel'] == "MED") {

                                        //Se valida si el registro pertenece a la unidad
                                        $result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

                                                $data['main_cont'] = 'oferta/consultams';
                                                $this->load->view('includes/template_consulta_rev', $data);
                                        } else {
                                                redirect('login', 'refresh');
                                        }
                                } else {
                                        // SUPERIOR
                                        //Se valida si el registro pertenece a la unidad
                                        $result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

                                                $data['main_cont'] = 'oferta/consultasup';
                                                $this->load->view('includes/template_consulta_rev_sup', $data);
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

        public function consulta3() {
                if ($this->session->userdata('logged_in')) {
                        $data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "SUP";
                        if ($data['datos']['idRoles'] == 1) {
                                //Admin
                                echo "Permiso denegado";

                        } else {
                                //Escuela
                                //Se obtiene id de la url
                                $idUrl         = $this->uri->segment(4);
                                $data['idUrl'] = $idUrl;

                                if ($data['datos']['Nivel'] == "MED") {
                                        //Se valida si el registro pertenece a la unidad
                                        $result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

                                                $data['main_cont'] = 'apoyo/consultams';
                                                $this->load->view('includes/template_consulta_rev', $data);
                                        } else {
                                                redirect('login', 'refresh');
                                        }
                                } else {

                                        // ++++++++++++++++++++++++++++++SUPERIOR+++++++++++++++++++++++++++++++++++++++++++
                                        $result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

                                                $data['main_cont'] = 'apoyo/consultasup';
                                                // print_r($data['BecasArr']);
                                                $this->load->view('includes/template_consulta_rev_sup', $data);
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

        public function consulta4() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "SUP";
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				//Escuela
				//Se obtiene id de la url
				$idUrl         = $this->uri->segment(4);
				$data['idUrl'] = $idUrl;

				if ($data['datos']['Nivel'] == "MED") {

					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

						$data['main_cont'] = 'vinculacion/consultams';
						$this->load->view('includes/template_consulta_rev', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					// ++++++++++++++++++++++++++++++++++++++++++SUPERIOR++++++++++++++++++++++++++++++++++
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

						$data['main_cont'] = 'vinculacion/consultasup';
						$this->load->view('includes/template_consulta_rev_sup', $data);
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

        public function consulta5() {
                if ($this->session->userdata('logged_in')) {
                        $data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "SUP";
                        if ($data['datos']['idRoles'] == 1) {
                                //Admin
                                echo "Permiso denegado";

                        } else {
                                //Escuela
                                //Se obtiene id de la url
                                $idUrl         = $this->uri->segment(4);
                                $data['idUrl'] = $idUrl;
                                if ($data['datos']['Nivel'] == "MED") {//++++++++++++++++++++MEDIO SUPERIOR++++++++++++++++++++

                                        //Se valida si el registro pertenece a la unidad
                                        $result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

                                                $data['main_cont'] = 'investigacion/consultams';
                                                $this->load->view('includes/template_consulta_rev', $data);
                                        } else {
                                                redirect('login', 'refresh');
                                        }
                                } else {//++++++++++++++++++++++++++SUPERIOR++++++++++++++++++++++++++++++++++++
                                        //Se valida si el registro pertenece a la unidad
                                        $result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

                                                $data['main_cont'] = 'investigacion/consultasup';
                                                $this->load->view('includes/template_consulta_rev_sup', $data);
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

        public function consulta6() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "SUP";
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				//Escuela
				//Se obtiene id de la url
				$idUrl         = $this->uri->segment(4);
				$data['idUrl'] = $idUrl;
				if ($data['datos']['Nivel'] == "MED") {

					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

						$data['main_cont'] = 'gestion/consultams';
						$this->load->view('includes/template_consulta_rev', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					// SUPERIOR
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}
					//Si existe lo deja continuar
					if ($result) {
						$data['gestion'] = $this->evaluacion->getGestionSup($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(6)) {
							$nivel = $this->niveles->nivel1Sup(6);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(6)) {
							$nivel = $this->niveles->nivel2Sup(6);
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
						if ($this->niveles->nivel3Sup(6, 14)) {
							$nivel = $this->niveles->nivel3Sup(6, 14);
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

						$data['main_cont'] = 'gestion/consultasup';
						$this->load->view('includes/template_consulta_rev_sup', $data);
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



        public function updatecomentario(){

                $objeto = array(
                        'tabla'           => $this->input->post('tabla'),
                        'idEvaluacion'           => $this->input->post('idEvaluacion'),
                        'idUnidad'           => $this->input->post('idUnidad'),
                        'comentarios'           => $this->input->post('comentarios'),
                );

                $this->evaluacion->update_comentarios($objeto);


                $longitud =  strlen(str_replace(' ', '', $this->input->post('comentarios')));


                if($longitud==0){
                        $objeto2 = array(
                                'columna'           => $this->input->post('comentario'),
                                'idEvaluacion'           => $this->input->post('idEvaluacion'),
                                'cn' => 1
                        );
                        $this->evaluacion->update_cn_sup($objeto2);
                }else{
                        $objeto2 = array(
                                'columna'           => $this->input->post('comentario'),
                                'idEvaluacion'           => $this->input->post('idEvaluacion'),
                                'cn' => 2
                        );
                        $this->evaluacion->update_cn_sup($objeto2);
                }


                redirect($this->input->post('redirect'),'refresh');
        }



        public function updateEstadoSup(){

                $data = array(
                        'idEvaluacionSup'     =>  $this->uri->segment(3),
                        'estado'     =>  'ACT'
                );

                print_r($data);

                $this->evaluacion->update_ev_sup($data);

                redirect('consultasup', 'refresh');
        }

        public function finalizarEstadoSup(){

                $data = array(
			'idEvaluacionSup'     =>  $this->uri->segment(3),
                        'estado'     =>  'FIN'
		);

                print_r($data);

                $this->evaluacion->update_ev_sup($data);

                redirect('consultasup', 'refresh');
        }

}
