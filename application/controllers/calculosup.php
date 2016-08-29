<?php

if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

session_start();

class Calculosup extends CI_Controller {

        public function index() {
                $evaluacion = $this->uri->segment(2);
                echo $evaluacion;
        }


}


?>
