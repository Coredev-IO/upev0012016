<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apoyo extends CI_Controller {

        public function index(){
                $data['main_cont']             = 'apoyo/index';
                $this->load->view('includes/template_principal',$data);
        }
}