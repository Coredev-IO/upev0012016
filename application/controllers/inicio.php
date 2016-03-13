<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->helper(array('form'));//Carga las sesiones 
    $data['main_cont'] = 'inicio';
    $this->load->view('includes/template_inicio', $data);
    
  }

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */