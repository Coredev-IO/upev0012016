<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expedientesvet extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        
    }


     function insert_expediente($datos){
        $data = array(
                        'username' => $datos['username'],
                        'usermail' => $datos['responsable'],
                        'paciente' => $datos['nombre'],
                        'especie' => $datos['especie'],
                        'raza' => $datos['raza'],
                        'sexo' => $datos['sexo'],
                        'edad' => $datos['edad'],
                        'color' => $datos['color'],
                        'foto' => 'nombreFoto',
                        'fotoRuta' => 'Ruta'
                        );
       $this->db->insert('expedientes',$data);

        }



    function insert_HistorialClinico($datos){

       $this->db->insert('historialClinico',$datos);

        }


     function consultaExpedientes()
     {
       $this -> db -> select('id,paciente, usermail');
       $this -> db -> from('expedientes');
       $query = $this -> db -> get();
        
       return $query->result();
       
     }


     function consultaExpedientesUser($usuario)
     {
       $this -> db -> select('id,paciente, usermail');
       $this -> db -> from('expedientes');
       $this->db->where('usermail',$usuario);
       $query = $this -> db -> get();

        
       return $query->result();
       
     }



     function simpleExpedientes($id)
     {
       $this -> db -> select('id,paciente, usermail, especie, raza, sexo, edad,color,foto,fotoRuta');
       $this -> db -> from('expedientes');
       $this->db->where('id',$id);
       $query = $this -> db -> get();
        
       return $query->result();
       
     }

     function simpleHistorial($datos)
     {
        foreach ($datos['expediente'] as $expedientes){
          $responsable   = $expedientes->usermail;
        }

       $this -> db -> select('id,username, userResponsable, ,idMascota, ExamenClinico, fecha');
       $this -> db -> from('historialClinico');
       $this->db->where('username',$datos['username']);
       $this->db->where('userResponsable',$responsable);
       $this->db->where('idMascota',$datos['id']);
       $this->db->limit(5);
       $this->db->order_by("fecha", "desc");
       $query = $this -> db -> get();
        
       return $query->result();
       
     }

     function eliminarExp($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('expedientes');
    }

     function eliminarHistorial($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('historialClinico');
    }

    function update_expediente($datos){
        $data = array(
                        'username' => $datos['username'],
                        'usermail' => $datos['responsable'],
                        'paciente' => $datos['nombre'],
                        'especie' => $datos['especie'],
                        'raza' => $datos['raza'],
                        'sexo' => $datos['sexo'],
                        'edad' => $datos['edad'],
                        'color' => $datos['color'],
                        'foto' => 'Brownie',
                        'fotoRuta' => 'Brownie'
                        );
        $this->db->where('id', $datos['id']);
       $this->db->update('expedientes',$data);

        }


}

/* End of file usuarios_mascotas.php */
/* Location: ./application/models/usuarios_mascotas.php */

