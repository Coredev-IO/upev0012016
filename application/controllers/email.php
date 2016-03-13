<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index($var)
  {
    $dbconnect = $this->load->database();
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
    $pass = $str;
    /***********************************************/
    //VERIFICAR SI EL CORREO YA EXISTE
    $this->load->model('usuarios_mascotas');
    $result = $this->usuarios_mascotas->verif_user($var);
    if($result)
     {
        $data['main_cont'] = 'registra_mascota';
        $this->load->view('includes/template_mascotas', $data);
     }
     else
     {
        /***********************************************/
        //MANDAR EL CORREO
        $this->load->helper(array('form'));//Carga las sesiones 
        $this->load->library('email','','correo');//Preparo para mandar correos
        $this->correo->from('petcloud@coredev.com.mx', 'petCloud');
        $this->correo->to($var);
        $this->correo->subject('petCloud');
        $this->correo->message('Usuario: '.$var.' Contraseña: '.$pass);
        if($this->correo->send())//Se envia correo
            {
              /***********************************************/
              //SI EL CORREO SE MANDA SE INSERTA EN LA BASE EL USUARIO
               $this->usuarios_mascotas->insert_user($var,$pass);
               $data['main_cont'] = 'invitacion_mascota';
               $this->load->view('includes/template_mascotas', $data);
            }
            else //No se envia
            {
             /***********************************************/
             //SE REDIRECCIONA A QUE SE INGRESE DE NUEVO EL CORREO
             //show_error($this->correo->print_debugger());
             $data['main_cont'] = 'error_mascota';
              $this->load->view('includes/template_mascotas', $data);
            }  
     }
    

   

    
  

  }



  public function vet($var)
  {

    
    $dbconnect = $this->load->database();
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
    $pass = $str;
    /***********************************************/
    //VERIFICAR SI EL CORREO YA EXISTE
    $this->load->model('usuarios_vet');
    $result = $this->usuarios_vet->verif_user($var);
    if($result)
     {
        $data['usuario']=$var;
        $data['main_cont'] = 'registra_mascota';
        $this->load->view('includes/template_mascotas', $data);
     }
     else
     {
        /***********************************************/
        //MANDAR EL CORREO
        $this->load->helper(array('form'));//Carga las sesiones 
        $this->load->library('email','','correo');//Preparo para mandar correos
        $this->correo->from('petcloud@coredev.com.mx', 'petCloud');
        $this->correo->to($var);
        $this->correo->subject('petCloud');
        $this->correo->message('Usuario: '.$var.' Contraseña: '.$pass);
        if($this->correo->send())//Se envia correo
            {
              /***********************************************/
              //SI EL CORREO SE MANDA SE INSERTA EN LA BASE EL USUARIO
               $this->usuarios_vet->insert_user($var,$pass);
               $data['main_cont'] = 'invitacion_mascota';
               $this->load->view('includes/template_mascotas', $data);
            }
            else //No se envia
            {
             /***********************************************/
             //SE REDIRECCIONA A QUE SE INGRESE DE NUEVO EL CORREO
             //show_error($this->correo->print_debugger());
             $data['main_cont'] = 'error_mascota';
              $this->load->view('includes/template_mascotas', $data);
            }  
     }
    

   

    
  

  }



  public function usersCliente($var)
  {

    
    $dbconnect = $this->load->database();
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
    $pass = $str;
    /***********************************************/
    //VERIFICAR SI EL CORREO YA EXISTE
    $this->load->model('usuarios_mascotas');
    $result = $this->usuarios_mascotas->verif_user($var);
    if($result)
     {
        $data['usuario']=$var;
        $data['main_cont'] = 'registra_cliente';
        $this->load->view('includes/template_clientes', $data);
     }
     else
     {
        /***********************************************/
        //MANDAR EL CORREO
        $this->load->helper(array('form'));//Carga las sesiones 
        $this->load->library('email','','correo');//Preparo para mandar correos
        $this->correo->from('petcloud@coredev.com.mx', 'petCloud');
        $this->correo->to($var);
        $this->correo->subject('petCloud');
        $this->correo->message('Usuario: '.$var.' Contraseña: '.$pass);
        if($this->correo->send())//Se envia correo
            {
              /***********************************************/
              //SI EL CORREO SE MANDA SE INSERTA EN LA BASE EL USUARIO
               $this->usuarios_mascotas->insert_user($var,$pass);
               $data['main_cont'] = 'invitacion_mascota';
               $this->load->view('includes/template_clientes', $data);
            }
            else //No se envia
            {
             /***********************************************/
             //SE REDIRECCIONA A QUE SE INGRESE DE NUEVO EL CORREO
             //show_error($this->correo->print_debugger());
             $data['main_cont'] = 'error_mascota';
              $this->load->view('includes/template_clientes', $data);
            }  
     }
    

   

    
  

  }

  

}


        



/* End of file email.php */
/* Location: ./application/controllers/email.php */