<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Consultams extends CI_Controller {

	function __construct() {
		parent::__construct();
                //SE VERIFICA LA SESION
                $data['datos'] = $this->session->userdata('logged_in');
                $this->load->library('verify');
                $this->verify->seccion(3, $data['datos']['idRoles']);
	}



        public function index() {
                echo "Consulta medio superior";
        }



}
