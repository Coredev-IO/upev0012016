<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Octavio Martinez
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class mascotas extends REST_Controller
{




    //Trae todos las mascotas
    function getMascotas_post()
    {
       $this->load->model('expedientesvet','',TRUE);
        $array = array('username' => $this->post('username'));
        $result = $this->expedientesvet->consultaExpedientesUser($array['username']);


        if($result)
       {
         $this->response(array('success' => 1,'mascota' => $result), 200); 
       }
       else
       {
         $this->response(array('success' => 0), 200);
       }
    }




    function getKardex_post(){
      $this->load->model('','',TRUE);
      $array = array('username' => $this->post('username'),'usermascota' => $this->post('usermascota'),'idmascota' => $this->post('idmascota'));
    }


}








