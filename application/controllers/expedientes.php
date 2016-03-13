<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Expedientes extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }


  public function index()
  {
    # code...
  }




  public function newExpedientes()
  {
    


    if($this->session->userdata('logged_in')){
     $session_data = $this->session->userdata('logged_in');
     $this->load->model('expedientesVet');
     $this->load->helper('form');
     $this->load->library('form_validation');
     
     $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
     $this->form_validation->set_rules('responsable', 'Responsable', 'required|valid_email');
     $this->form_validation->set_rules('especie', 'Especie', 'required|min_length[0]');
     $this->form_validation->set_rules('raza', 'Raza', 'required|min_length[0]');
     $this->form_validation->set_rules('sexo', 'Sexo', 'required|min_length[0]');
     $this->form_validation->set_rules('edad', 'Edad', 'required|min_length[0]');
     $this->form_validation->set_rules('color', 'Color', 'required|min_length[0]');


     /*Datos*/
     $datos = array(
        "username" => $session_data['username'],
        "nombre" => $this->input->post('nombre'),
        "responsable" => $this->input->post('responsable'),
        "especie" => $this->input->post('especie'),
        "raza" => $this->input->post('raza'),
        "sexo" => $this->input->post('sexo'),
        "edad" => $this->input->post('edad'),
        "color" => $this->input->post('color')
     );

     if($this->form_validation->run() === true){  

       
  
        $this->expedientesVet->insert_expediente($datos);
        $data['username'] = $session_data['username'];
        redirect('home/hojaClinica', 'refresh');


         
     }else{
        $data['main_cont'] = 'newExpediente';
        $data['username'] = $session_data['username'];
        $this->load->view('includes/template_mascotasApp', $data);
     }
     
     
   }
   else
   {
    redirect('clientesAppLogin', 'refresh');
    // $this->load->helper(array('form'));//Carga las sesiones 
    // $data['main_cont'] = 'clientesAppLogin';
    // $this->load->view('includes/template_mascotasApp', $data);
   }
  }



   


    public function actuExpedientes($id)
  {
    


    if($this->session->userdata('logged_in')){
     $session_data = $this->session->userdata('logged_in');
     $this->load->model('expedientesVet');
     $this->load->helper('form');
     $this->load->library('form_validation');
     
     $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
     $this->form_validation->set_rules('responsable', 'Responsable', 'required|valid_email');
     $this->form_validation->set_rules('especie', 'Especie', 'required|min_length[0]');
     $this->form_validation->set_rules('raza', 'Raza', 'required|min_length[0]');
     $this->form_validation->set_rules('sexo', 'Sexo', 'required|min_length[0]');
     $this->form_validation->set_rules('edad', 'Edad', 'required|min_length[0]');
     $this->form_validation->set_rules('color', 'Color', 'required|min_length[0]');


     /*Datos*/
     $datos = array(
        "id" => $id,
        "username" => $session_data['username'],
        "nombre" => $this->input->post('nombre'),
        "responsable" => $this->input->post('responsable'),
        "especie" => $this->input->post('especie'),
        "raza" => $this->input->post('raza'),
        "sexo" => $this->input->post('sexo'),
        "edad" => $this->input->post('edad'),
        "color" => $this->input->post('color')
     );

     if($this->form_validation->run() === true){    
         $this->expedientesVet->update_expediente($datos);
         $data['username'] = $session_data['username'];
         //$data['main_cont'] = 'expClinica';
         //$this->load->view('includes/template_mascotasApp', $data);
         //header('Location:'.base_url().'index.php/home/');
         redirect('home/hojaClinica', 'refresh');
     }else{
         $result = $this->expedientesVet->simpleExpedientes($id);
         $data['id'] = $id;
         $data['expediente'] = $result;
        $data['main_cont'] = 'updateExpClinico';
        $data['username'] = $session_data['username'];
        $this->load->view('includes/template_mascotasApp', $data);
     }
     
     
   }
   else
   {
    redirect('clientesAppLogin', 'refresh');
    // $this->load->helper(array('form'));//Carga las sesiones 
    // $data['main_cont'] = 'clientesAppLogin';
    // $this->load->view('includes/template_mascotasApp', $data);
   }
  }



public function historialExpedientes($id)
  {
    


    if($this->session->userdata('logged_in')){
     $session_data = $this->session->userdata('logged_in');
     $this->load->model('expedientesVet');

     $result = $this->expedientesVet->simpleExpedientes($id);
     $data['expediente'] = $result;
        $data['id']=$id;
        $data['main_cont'] = 'historiaClinica';
        $data['username'] = $session_data['username'];

        $result2 = $this->expedientesVet->simpleHistorial($data);
        $data['historial'] = $result2;

        $this->load->view('includes/template_mascotasApp', $data);
     
     
     
   }
   else
   {
    redirect('clientesAppLogin', 'refresh');
    // $this->load->helper(array('form'));//Carga las sesiones 
    // $data['main_cont'] = 'clientesAppLogin';
    // $this->load->view('includes/template_mascotasApp', $data);
   }
  }


  public function newhistorialExpedientes()
  {
    


    if($this->session->userdata('logged_in')){
     $session_data = $this->session->userdata('logged_in');
     $this->load->model('expedientesVet');
     $this->load->helper('form');
     $this->load->library('form_validation');
     $id= $this->input->post('id');

     $this->form_validation->set_rules('Anamnesis', 'Anamnesis', 'required');

   

     /*Datos*/
     $datos = array(
        "username" => $session_data['username'],
        "userResponsable" => $this->input->post('userResponsable'),
        "idMascota" => $id,
        "Anamnesis" => $this->input->post('Anamnesis'),
        "Temperatura" => $this->input->post('Temperatura'),
        "FC" => $this->input->post('FC'),
        "FR" => $this->input->post('FR'),
        "ExamenClinico" => $this->input->post('ExamenClinico'),
        "Dx" => $this->input->post('Dx'),
        "Tratamiento" => $this->input->post('Tratamiento'),
        "Estudios" => $this->input->post('Estudios')
     );


     if($this->form_validation->run() === true){    
         $this->expedientesVet->insert_HistorialClinico($datos);
         $data['username'] = $session_data['username'];
         //$data['main_cont'] = 'expClinica';
         //$this->load->view('includes/template_mascotasApp', $data);
         //header('Location:'.base_url().'index.php/home/');
         redirect('expedientes/historialExpedientes/'.$id, 'refresh');
     }else{

        $result = $this->expedientesVet->simpleExpedientes($id);
        $data['expediente'] = $result;
        $data['id']=$id;
        $data['main_cont'] = 'historiaClinica';
        $data['username'] = $session_data['username'];
        $this->load->view('includes/template_mascotasApp', $data);


     }

     
     
   }
   else
   {
    redirect('clientesAppLogin', 'refresh');
    // $this->load->helper(array('form'));//Carga las sesiones 
    // $data['main_cont'] = 'clientesAppLogin';
    // $this->load->view('includes/template_mascotasApp', $data);
   }
  }






 





}

/* End of file mascotas.php */
/* Location: ./application/controllers/mascotas.php */