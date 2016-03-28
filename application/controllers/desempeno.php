<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Desempeno extends CI_Controller {

        public function index(){
                $data['main_cont']             = 'desempeno/index';
                $this->load->view('includes/template_principal',$data);
        }
}
