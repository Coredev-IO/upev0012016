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
