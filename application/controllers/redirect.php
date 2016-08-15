<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Redirect extends CI_Controller {
	public function revision() {
		$data['datos']     = $this->session->userdata('logged_in');
		$data['main_cont'] = 'home/revision';
		$this->load->view('includes/template_app', $data);

	}

	public function finalizada() {
		$data['datos']     = $this->session->userdata('logged_in');
		$data['main_cont'] = 'home/finalizada';
		$this->load->view('includes/template_app', $data);

	}

	public function resultados() {
		$data['datos']     = $this->session->userdata('logged_in');
		$data['main_cont'] = 'home/resultados';
		$this->load->view('includes/template_app', $data);

	}
}