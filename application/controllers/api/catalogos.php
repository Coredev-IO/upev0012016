<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package   CodeIgniter
 * @subpackage  Rest Server
 * @category  Controller
 * @author    Octavio Martinez
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Catalogos extends REST_Controller
{


    //Trae todos los especies
    function todosEspecies_post()
    {
       $this->load->model('especies','',TRUE);
        $result = $this->especies->todosEspecies();


        if($result)
       {
         $this->response($result, 200); 
         
       }
       else
       {
         $this->response(False, 200);
       }
    }

    //Trae todos los subespecies
    function todosSubEspecies_post()
    {
       $this->load->model('especies','',TRUE);
        $result = $this->especies->todosSubEspecies();


        if($result)
       {
         $this->response($result, 200); 
         
       }
       else
       {
         $this->response(False, 200);
       }
    }

 
    //Crea una nueva cuenta 
    function newespecie_post(){
      $array = array('nombreEspecie' => $this->post('nombreEspecie'));
      $var = $array['nombreEspecie'];
       $this->load->model('especies');
            $result = $this->especies->insert_Especie($var);
            if($result)
             {
                //El Usuario ya existe
                $this->response(array('success' => 0, 'error_message' => 'Se inserto'), 200); 
             }
             else
             {

              $this->response(array('success' => 0, 'error_message' => 'Error'), 200);

              } 
    }





    //Crea una nueva cuenta con cuenta aletoria
    function newAccountAleatorio_post(){
      $array = array('username' => $this->post('username'));
       /***********************************************/
    //GENERAR CLAVES ALEATORIAS
    $long = 8; //longitud
    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $salt .= strlen($salt)?'2345679':'0123456789';
    if (strlen($salt)==0){
      $str = '';
    }

    $i=0;
    $str='';
    srand((double)microtime()*1000000);

    while ($i < $long){
      $num = rand(0,strlen($salt)-1);
      $str .=substr($salt, $num, 1);
      $i++;
    }

            $dbconnect = $this->load->database();
            $var = $array['username'];
            $pass = $str;
            /***********************************************/
            //VERIFICAR SI EL CORREO YA EXISTE
            $this->load->model('usuarios_mascotas');
            $result = $this->usuarios_mascotas->verif_user($var);
            if($result)
             {
                //El Usuario ya existe
                $this->response(array('success' => 0, 'error_message' => 'El Mail que intenta registrar ya esta relacionado a una cuenta'), 200); 
             }
             else
             {
                /***********************************************/
                //MANDAR EL CORREO
                $this->load->helper(array('form'));//Carga las sesiones 
                $this->load->library('email','','correo');//Preparo para mandar correos
                $this->correo->from('petcloud@coredev.com.mx', 'petCloud');
                //$this->correo->from('octavio150@gmail.com', 'petCloud');
                $this->correo->to($var);
                $this->correo->subject('petCloud');
                $this->correo->message('Usuario: '.$var.' Contraseña: '.$pass);
                if($this->correo->send())//Se envia correo
                    {
                      /***********************************************/
                      //SI EL CORREO SE MANDA SE INSERTA EN LA BASE EL USUARIO
                       $this->usuarios_mascotas->insert_user($var,$pass);
                       //Correcto

                       $this->response(array('success' => 1, 'error_message' => 'Usuario Registrado'), 200); 

                    }
                    else //No se envia
                    {
                     /***********************************************/
                     //No se mando el correo verificar informacion

                      $this->response(array('success' => 0, 'error_message' => 'Ocurrio un problema al registrar el usuario verifique su información y vuelva a intentarlo'), 200);

                    }  
             }
    
      


    }




    //Recuperar Contraseña
    function recoveryAccountAleatorio_post(){
      $array = array('username' => $this->post('username'));
       /***********************************************/
    //GENERAR CLAVES ALEATORIAS
    $long = 8; //longitud
    $salt = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $salt .= strlen($salt)?'2345679':'0123456789';
    if (strlen($salt)==0){
      $str = '';
    }

    $i=0;
    $str='';
    srand((double)microtime()*1000000);

    while ($i < $long){
      $num = rand(0,strlen($salt)-1);
      $str .=substr($salt, $num, 1);
      $i++;
    }

            $dbconnect = $this->load->database();
            $var = $array['username'];
            $pass = $str;
            /***********************************************/
            //VERIFICAR SI EL CORREO YA EXISTE
            $this->load->model('usuarios_vet');
       
                /***********************************************/
                //MANDAR EL CORREO
                $this->load->helper(array('form'));//Carga las sesiones 
                $this->load->library('email','','correo');//Preparo para mandar correos
                $this->correo->from('petcloud@coredev.com.mx', 'petCloud');
                //$this->correo->from('octavio150@gmail.com', 'petCloud');
                $this->correo->to($var);
                $this->correo->subject('petCloud');
                $this->correo->message('Usuario: '.$var.' Contraseña: '.$pass);
                if($this->correo->send())//Se envia correo
                    {
                      /***********************************************/
                      //SI EL CORREO SE MANDA SE INSERTA EN LA BASE EL USUARIO
                       $this->usuarios_vet->update_pass($var,$pass);
                       //Correcto

                       $this->response(array('success' => 1, 'success' => $pass, 'error_message' => 'Contraseña Cambiada'), 200); 

                    }
                    else //No se envia
                    {
                     /***********************************************/
                     //No se mando el correo verificar informacion

                      $this->response(array('success' => 0, 'error_message' => 'Ocurrio un problema al cambiar contraseña'), 200);

                    }  
             


    }




}