<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}
class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {

		if ($this->session->userdata('logged_in')) {
			$data['datos']     = $this->session->userdata('logged_in');
			$data['main_cont'] = 'home/index';
			$this->load->view('includes/template_app', $data);
			//Se determina la actividad del rol
			// if($session_data['rol']==1){
			//         //Admin
			// }else{
			//
			// }

		} else {
			$this->load->helper(array('form'));//Carga ldap_add(link_identifier, dn, entry)s sesiones
			$data['main_cont'] = 'login/index';
			$this->load->view('includes/template_login', $data);
		}

	}
}
