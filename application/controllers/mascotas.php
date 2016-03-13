<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mascotas extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->helper(array('form'));//Carga las sesiones 
    $data['main_cont'] = 'mascotas';
    $data['usuario']="";
    $this->load->view('includes/template_mascotas', $data);
  }

  public function mapas()
  {
    $this->load->helper(array('form'));//Carga las sesiones 
    $data['main_cont'] = 'mapa_mascotas';
    $data['usuario']="";
    $this->load->view('includes/template_mascotas', $data);
  }


 





}

/* End of file mascotas.php */
/* Location: ./application/controllers/mascotas.php */