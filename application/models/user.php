<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('id, username, password');
   $this -> db -> from('users_vet');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', $password);
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 


 function loginUserCliente($username, $password)
 {
   $this -> db -> select('id, username, password');
   $this -> db -> from('users_vet');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', $password);
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }



 function todosCliente()
 {
   $this -> db -> select('id, username, password');
   $this -> db -> from('users');

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