<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_mascotas extends CI_Model {

    public $variable;

    public function __construct()
    {
        parent::__construct();
        
    }


    function insert_user($user, $pass){
        $data = array(
                        'username' => $user,
                        'password' => MD5($pass)
                        );
        $this->db->insert('users',$data);

        }

    function verif_user($username)
     {
           $this -> db -> select('id, username');
           $this -> db -> from('users');
           $this -> db -> where('username', $username);
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

}

/* End of file usuarios_mascotas.php */
/* Location: ./application/models/usuarios_mascotas.php */

