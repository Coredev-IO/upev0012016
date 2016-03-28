<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion extends CI_Controller {

        public function index(){
                $data['main_cont']             = 'gestion/index';
                $this->load->view('includes/template_principal',$data);
        }
}