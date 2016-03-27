<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}
class VerifyLogin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user', '', TRUE);
	}

	function index() {
		//Se valida si existe una session
		if ($this->session->userdata('logged_in')) {
			$data['datos']     = $this->session->userdata('logged_in');
			$data['main_cont'] = 'home/index';
			$this->load->view('includes/template_app', $data);
		} else {
			//This method will have the credentials validation
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

			if ($this->form_validation->run() == FALSE) {
				//Field validation failed.&nbsp; User redirected to login page
				$data['main_cont'] = 'login/index';
				$this->load->view('includes/template_login', $data);
			} else {
				//Go to private area
				redirect('home', 'refresh');
			}
		}

	}

	function check_database($password) {
		//Field validation succeeded.&nbsp; Validate against database
		$username = $this->input->post('username');
		//query the database
		$result = $this->user->login($username, md5($password));
		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {

				$sess_array = array(
					'idUsuarios'      => $row->idUsuarios,
					'Username'        => $row->Username,
					'idRoles'         => $row->idRoles,
					'idUnidad'        => $row->idUnidad,
					'Nombre'          => $row->Nombre,
					'ApellidoPaterno' => $row->ApellidoPaterno,
					'ApellidoMaterno' => $row->ApellidoMaterno,
					'Email'           => $row->Email,
					'Telefono'        => $row->Telefono,
					'NombreUnidad'    => $row->NombreUnidad,
					'Nivel'           => $row->Nivel
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		} else {
			$this->form_validation->set_message('check_database', 'Usuario y/o Contraseña incorrectos');
			return false;
		}
	}
}
?>
