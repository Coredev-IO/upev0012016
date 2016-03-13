<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notfound extends CI_Controller {

  public function index()
  {
    $data['main_cont'] = 'Notfound';
    $this->load->view('includes/template_index',$data);
  }
}
