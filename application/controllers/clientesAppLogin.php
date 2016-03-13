<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class ClientesAppLogin extends CI_Controller {

  public function __construct()
  {
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
    $data['main_cont'] = 'clientesAppLogin';
    $this->load->view('includes/template_mascotasLogin', $data);
   }
  }








    public function logout()
  {
    

$this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('clientesAppLogin', 'refresh');


  }




 





}

/* End of file mascotas.php */
/* Location: ./application/controllers/mascotas.php */