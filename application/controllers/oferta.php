<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oferta extends CI_Controller {

        public function index(){
                $data['main_cont']             = 'oferta/index';
                $this->load->view('includes/template_principal',$data);
        }
}