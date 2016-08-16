<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Consultams extends CI_Controller {

	function __construct() {
		parent::__construct();
                //SE VERIFICA LA SESION
                $data['datos'] = $this->session->userdata('logged_in');
                $this->load->library('verify');
                $this->verify->seccion(3, $data['datos']['idRoles']);
                $this->load->model('unidades', '', TRUE);
                $this->load->model('evaluacion', '', TRUE);
	}



        public function index() {
                $data['datos'] = $this->session->userdata('logged_in');
                $data['unidades'] = $this->unidades->getUnidades('MED');
                $data['main_cont'] = 'consultams/index';
                $this->load->view('includes/template_consultams', $data);
        }



        public function check() {
                $data['datos'] = $this->session->userdata('logged_in');
                $urlRed = "consultams/rev/".$this->input->post('idUnidad');
                redirect($urlRed, 'refresh');
        }


        public function rev() {
                $data['datos'] = $this->session->userdata('logged_in');
                $data['evaluaciones'] = $this->evaluacion->getEvaluacionUnidad($this->uri->segment(3));
                $data['unidad'] = $this->unidades->getUnidad($this->uri->segment(3));
                $data['main_cont'] = 'consultams/rev';
                $this->load->view('includes/template_consultams', $data);
        }



}
