<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->helper(array('form'));//Carga las sesiones 
    $data['main_cont'] = 'inicio/index';
    $this->load->view('includes/template_index',$data);
  }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */