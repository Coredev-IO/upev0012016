<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
                //SE VERIFICA LA SESION
                $data['datos'] = $this->session->userdata('logged_in');
                $this->load->library('verify');
                $this->verify->seccion(1, $data['datos']['idRoles']);
                $this->load->model('user', '', TRUE);
	}



        public function index() {
                $data['datos'] = $this->session->userdata('logged_in');

                $data['usuarios'] = $this->user->getRegMS();

                $data['main_cont'] = 'admin/index';
                $this->load->view('includes/template_admin', $data);

        }


        public function users_reg_sup() {
                $data['datos'] = $this->session->userdata('logged_in');

                $data['usuarios'] = $this->user->getRegSup();

                $data['main_cont'] = 'admin/users_reg_sup';
                $this->load->view('includes/template_admin', $data);

        }


        public function users_rev_med() {
                $data['datos'] = $this->session->userdata('logged_in');

                $data['usuarios'] = $this->user->getRevMS();

                $data['main_cont'] = 'admin/users_rev_med';
                $this->load->view('includes/template_admin', $data);

        }


        public function users_rev_sup() {
                $data['datos'] = $this->session->userdata('logged_in');

                $data['usuarios'] = $this->user->getRevSup();

                $data['main_cont'] = 'admin/users_rev_sup';
                $this->load->view('includes/template_admin', $data);

        }


        public function users_admin() {
                $data['datos'] = $this->session->userdata('logged_in');

                $data['usuarios'] = $this->user->getAdmin();

                $data['main_cont'] = 'admin/users_admin';
                $this->load->view('includes/template_admin', $data);

        }



}
