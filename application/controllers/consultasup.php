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



}
