<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('expedientesvet', 'expedientesvet', true);
 }

 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['main_cont'] = 'home';
     $data['username'] = $session_data['username'];
     $this->load->view('includes/template_mascotasApp', $data);
     
     
   }
   else
   {
     //If no session, redirect to login page
     redirect('clientesAppLogin', 'refresh');
   }
 }

 function hojaClinica()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $result = $this->expedientesvet->consultaExpedientes();
     $data['expedientes'] = $result;
     $data['main_cont'] = 'expClinica';
     $data['username'] = $session_data['username'];
     $this->load->view('includes/template_mascotasApp', $data);



     
     
   }
   else
   {
     //If no session, redirect to login page
     redirect('clientesAppLogin', 'refresh');
   }
 }


 function newExpediente()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['main_cont'] = 'newExpediente';
     $data['username'] = $session_data['username'];
     $this->load->view('includes/template_mascotasApp', $data);
     
     
   }
   else
   {
     //If no session, redirect to login page
     redirect('clientesAppLogin', 'refresh');
   }
 }


function updateExpediente()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $id = $this->uri->segment(3);
     $datos = $this->expedientesvet->simpleExpedientes($id);
     $data['id'] = $id;
     $data['expediente'] = $datos;
     $data['main_cont'] = 'updateExpClinico';
     $data['username'] = $session_data['username'];
     $this->load->view('includes/template_mascotasApp', $data);
     
     
   }
   else
   {
     //If no session, redirect to login page
     redirect('clientesAppLogin', 'refresh');
   }
 }



function eliminarExpediente()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $id = $this->uri->segment(3);
     $delete = $this->expedientesvet->eliminarExp($id);
     $data['main_cont'] = 'expClinica';
     $data['username'] = $session_data['username'];
     //$this->load->view('includes/template_mascotasApp', $data);
     redirect(base_url().'index.php/home/hojaClinica');
     
     
   }
   else
   {
     //If no session, redirect to login page
     redirect('clientesAppLogin', 'refresh');
   }
 }


 function eliminarHistorial()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $id = $this->uri->segment(3);
     $id2 = $this->uri->segment(4);
     $delete = $this->expedientesvet->eliminarHistorial($id2);
     $data['main_cont'] = 'expClinica';
     $data['username'] = $session_data['username'];
     //$this->load->view('includes/template_mascotasApp', $data);
     redirect('expedientes/historialExpedientes/'.$id, 'refresh');
     
     
   }
   else
   {
     //If no session, redirect to login page
     redirect('clientesAppLogin', 'refresh');
   }
 }





 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('clientesAppLogin', 'refresh');
 }

}

?>