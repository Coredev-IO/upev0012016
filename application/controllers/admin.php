<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
                //SE VERIFICA LA SESION
                $data['datos'] = $this->session->userdata('logged_in');
                $this->load->library('verify');
                $this->verify->seccion(1, $data['datos']['idRoles']);
	}



        public function index() {
                echo "Modulo de administracion";
        }



}
