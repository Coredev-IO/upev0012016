<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

session_start();//we need to call PHP's session object to access it through CI
class Nuevaevaluacion extends CI_Controller {

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

			} else {
				$data['main_cont'] = 'evaluaciones/nueva';
				$this->load->view('includes/template_app', $data);
			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	// ***********************************

	function crear() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				$this->load->helper('form');

				// Validaciones de los campos
				$this->form_validation->set_rules('Nombre', 'Nombre', 'required|min_length[0]');
				$this->form_validation->set_rules('Descripcion', 'Descripcion', 'required|min_length[0]');

				if ($this->form_validation->run() === true) {
					//Se crea arreglo a insertar
					$array = array(
						"idUnidad"    => $data['datos']['idUnidad'],
						"Nombre"      => $this->input->post('Nombre'),
						"Descripcion" => $this->input->post('Descripcion'));
					$this->evaluacion->crearEvaluacion($array);
					$lasEvaluacion = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);

					foreach ($lasEvaluacion as &$Evaluacion) {
						$data['lastEvaluacion'] = $Evaluacion->idEvaluacion;
					}

					// $data['main_cont'] = 'desempeno/index';
					// $this->load->view('includes/template_principal', $data);
					redirect(base_url().'index.php/desempeno/reg/'.$data['lastEvaluacion']);

				} else {
					$data['main_cont'] = 'evaluaciones/nueva';
					$this->load->view('includes/template_app', $data);
				}

				// $data['main_cont'] = 'evaluaciones/nueva';
				// $this->load->view('includes/template_app', $data);

			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}

	}
}
?>
