<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Error extends CI_Controller {

	function __construct() {
		parent::__construct();
	}



        public function index() {
                $data['main_cont'] = 'permiso';
                $this->load->view('includes/template_app',$data);
        }



}
