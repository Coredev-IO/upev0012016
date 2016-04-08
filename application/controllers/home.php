<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

session_start();//we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('evaluacion', '', TRUE);
	}

	function index() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";
				// $result                  = $this->evaluacion->getEvaluaciones();
				// $data['AllEvaluaciones'] = $result;

			} else {
				//Escuela
				$data['AllEvaluacionesUnidad'] = $this->evaluacion->getEvaluacionUnidad($data['datos']['idUnidad']);
				$data['main_cont']             = 'home/index';
				// Se obtiene si la escuela tiene una evaluacion en curso
				if ($this->evaluacion->getLastEvaluacion($data['datos']['idUnidad'])) {
					$eval = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
					//Se verifica se la evaluacion ya tiene los subniveles por bloque
					if ($this->evaluacion->getLastEvaluacion($data['datos']['idUnidad'])) {

						if ($this->evaluacion->getEvaluacionSubnivel($data['datos']['idUnidad'])) {
							// Ya hay subnivel
						} else {
							//Se obtienen bloques
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
							$i      = 1;
							foreach ($bloque as $row) {
								$datos = array(
									"idUnidad"     => $data['datos']['idUnidad'],
									"idBloque"     => $row->idBloques,
									"idEvaluacion" => $eval[0]->idEvaluacion,
									"idCampo"      => 'b'.$i,
								);

								$i = $i+1;
								$this->evaluacion->insert_subnivel($datos);

							}
						}

					}
					redirect('desempeno/reg/'.$eval[0]->idEvaluacion, 'refresh');
				} else {
					$this->load->view('includes/template_app', $data);
				}
			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
}
?>
