<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

session_start();//we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		if ($this->session->userdata('logged_in')) {
			$data['datos']     = $this->session->userdata('logged_in');
			$data['main_cont'] = 'home/index';
			$this->load->view('includes/template_app', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
}
?>
