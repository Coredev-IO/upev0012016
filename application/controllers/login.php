<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct(){
      parent::__construct();
  }


  public function index()
  {

    if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['main_cont'] = 'home';
     $data['username'] = $session_data['username'];
     $this->load->view('includes/template_mascotasApp', $data);
     
     
   }
   else
   {
    $this->load->helper(array('form'));//Carga las sesiones 
    $data['main_cont'] = 'login';
    $this->load->view('includes/template_login', $data);
   }

    
  }
}
