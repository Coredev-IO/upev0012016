<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Investigacion extends CI_Controller {

        public function index(){
                $data['main_cont']             = 'investigacion/index';
                $this->load->view('includes/template_principal',$data);
        }
}