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
                                $data['unidades'] = $this->unidades->getUnidades('MED');
                                $data['rol'] = $this->uri->segment(3);
                                $data['plantilla'] = "Nuevo usuario para registro de información nivel Medio Superior";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        case "newsupcap":
                                $data['rol'] = $this->uri->segment(3);
                                $data['unidades'] = $this->unidades->getUnidades('SUP');
                                $data['plantilla'] = "Nuevo usuario para registro de información nivel Superior";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        case "newmscon":
                                $data['rol'] = $this->uri->segment(3);
                                $data['unidades'] = [];
                                $data['plantilla'] = "Nuevo usuario para revisión de información nivel Medio Superior";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        case "newsupcon":
                                $data['rol'] = $this->uri->segment(3);
                                $data['unidades'] = [];
                                $data['plantilla'] = "Nuevo usuario para revisión de información nivel Superior";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        case "newadmin":
                                $data['rol'] = $this->uri->segment(3);
                                $data['unidades'] = [];
                                $data['plantilla'] = "Nuevo usuario Administrador";
                                $data['main_cont'] = 'admin/newuser';
                                $this->load->view('includes/template_admin', $data);
                                break;
                        default:
                                redirect('admin', 'refresh');
                }

        }

        public function confirmar($datos){

                $data['datos'] = $this->session->userdata('logged_in');
                $data['form'] = $datos;
                $data['main_cont'] = 'admin/confirm';
                $this->load->view('includes/template_admin', $data);

        }


        public function finalizar(){

                $data['datos'] = $this->session->userdata('logged_in');


                switch ($this->input->post('perfil')) {
                        case "newmscap":
                                redirect('admin/index', 'refresh');
                                break;
                        case "newsupcap":
                                redirect('admin/users_reg_sup', 'refresh');
                                break;
                        case "newmscon":
                                redirect('admin/users_rev_med', 'refresh');
                                break;
                        case "newsupcon":
                                redirect('admin/users_rev_sup', 'refresh');
                                break;
                        case "newadmin":
                                redirect('admin/users_admin', 'refresh');
                                break;
                        default:
                                redirect('admin', 'refresh');
                }

        }



        public function insert_admin() {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('user_name', 'Userdisplay', 'required');
                $this->form_validation->set_rules('nombre', 'Nombre', 'required');
                $this->form_validation->set_rules('apPaterno', 'ApellidoPaterno', 'required');
                $this->form_validation->set_rules('apMaterno', 'ApellidoMaterno', 'required');
                $this->form_validation->set_rules('tel', 'Telefono', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('idUnidad', 'idUnidad', 'required');
                $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]|matches[pass2]');
                $this->form_validation->set_rules('pass2', 'PasswordConfir', 'trim|required');
                $data['datos'] = $this->session->userdata('logged_in');
                $data['usuarios'] = $this->user->getAdmin();
                // Insert
                $datos = array(
                        'Nombre' => $this->input->post('nombre'),
                        'ApellidoPaterno' => $this->input->post('apPaterno'),
                        'ApellidoMaterno' => $this->input->post('apMaterno'),
                        'Userdisplay' => $this->input->post('user_name'),
                        'Password' => md5($this->input->post('pass')),
                        'Email' => $this->input->post('email'),
                        'Telefono' => $this->input->post('tel'),
                        'Username' => md5($this->input->post('user_name')),
                        'idUnidad' => $this->input->post('idUnidad'),
                        'idRoles' => $this->input->post('idRoles'),
                );
                //Transfering data to Model
                $this->user->form_insertAdmin($datos);

                $datos['perfil'] = $this->input->post('perfil');


                $this->confirmar($datos);

        }
        
         public function showUser() {
                $data['datos'] = $this->session->userdata('logged_in');
                $data['usuarios'] = $this->user->getUser($this->uri->segment(3));

                $data['main_cont'] = 'admin/edituser';
                $this->load->view('includes/template_admin', $data);

        }


}




