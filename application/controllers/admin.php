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
                $this->load->model('unidades', '', TRUE);
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



        public function user_reg() {
                $data['datos'] = $this->session->userdata('logged_in');
                $data['usuarios'] = $this->user->getAdmin();

                switch ($this->uri->segment(3)) {
                        case "newmscap":
                                $data['plantilla'] = "Nuevo usuario para registro de información nivel Medio Superior";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        case "newsupcap":
                                $data['plantilla'] = "Nuevo usuario para registro de información nivel Superior";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        case "newmscon":
                                $data['plantilla'] = "Nuevo usuario para revisión de información nivel Medio Superior";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        case "newsupcon":
                                $data['plantilla'] = "Nuevo usuario para revisión de información nivel Superior";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        case "newadmin":
                                $data['plantilla'] = "Nuevo usuario Administrador";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        default:
                                redirect('admin', 'refresh');
                }


                // $data['main_cont'] = 'admin/users_admin';
                // $this->load->view('includes/template_admin', $data);

        }



}
