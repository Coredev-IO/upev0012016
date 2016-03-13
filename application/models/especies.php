<?php
Class Especies extends CI_Model
{
     function insert_Especie($datos){
        $data = array(
                        'nombreEspecie' => $datos
                        );
       $this->db->insert('especies',$data);
       return true;

        }


    function insert_Subespecie($datos){
        $data = array(
                        'nombreEspecie' => $datos['nombreEspecie'],
                        'nombreSubEspecie' => $datos['nombreSubEspecie']
                        );
       $this->db->insert('subespecies',$data);

        }

 





 function todosEspecies()
 {
   $this -> db -> select('id, nombreEspecie');
   $this -> db -> from('especies');

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }



 function todosSubEspecies()
 {
   $this -> db -> select('id, nombreEspecie, nombreSubEspecie');
   $this -> db -> from('subespecies');

   $query = $this -> db -> get();

   if($query -> num_rows() > 0)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }






}
?>