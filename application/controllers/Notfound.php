<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notfound extends CI_Controller {

        function __construct() {
		parent::__construct();
                //SE VERIFICA LA SESION
                $data['datos'] = $this->session->userdata('logged_in');
                $this->load->library('verify');
                $this->verify->refresh404($data['datos']['idRoles']);
	}


        public function index(){
                $data['main_cont'] = 'Notfound';
                $this->load->view('includes/template_app',$data);
        }
}
