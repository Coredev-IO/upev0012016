<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}
class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('evaluacion', '', TRUE);
	}

	public function index() {

		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');

                        //SE DEFINE EL ROL DEL USUARIO
                        $rol_user = $data['datos']['idRoles'];

                        switch ($rol_user) {
                                case 1:
                                        redirect('admin', 'refresh');
                                        break;
                                case 2:
                                        //Registro de accion
                                        redirect('home', 'refresh');
                                        break;
                                case 3:
                                        redirect('consultams', 'refresh');
                                        break;
                                case 4:
                                        redirect('consultasup', 'refresh');
                                        break;
                                default:
                                        redirect('home', 'refresh');
                        }





			// if ($data['datos']['idRoles'] == 1) {
			// 	//Admin
			// 	echo "Permiso denegado";
                        //
			// } else {
                        //
			// 	$data['AllEvaluacionesUnidad'] = $this->evaluacion->getEvaluacionUnidad($data['datos']['idUnidad']);
			// 	$data['main_cont']             = 'home/index';
			// 	// $this->load->view('includes/template_app', $data);
			// 	redirect('home', 'refresh');
			// }

		} else {
			$this->load->helper(array('form'));//Carga ldap_add(link_identifier, dn, entry)s sesiones
			$data['main_cont'] = 'login/index';
			$this->load->view('includes/template_login', $data);
		}

	}
}
