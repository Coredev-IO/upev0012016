<?php
Class User extends CI_Model {
	function login($username, $password) {
		$this->db->select('');
		$this->db->from('Usuarios');
		$this->db->where('Username', $username);
		$this->db->where('Password', $password);
		$this->db->join('Unidad', 'Unidad.idUnidad = Usuarios.idUnidad');
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}



        function getRegMS() {
		$this->db->select('');
		$this->db->from('Usuarios');
                $this->db->where('idRoles', "2");
                $this->db->join('Unidad', 'Unidad.idUnidad = Usuarios.idUnidad');
                $this->db->where('Unidad.Nivel', "MED");

		$query = $this->db->get();

		return $query->result();

	}


        function getRegSup() {
		$this->db->select('');
		$this->db->from('Usuarios');
                $this->db->where('idRoles', "2");
                $this->db->join('Unidad', 'Unidad.idUnidad = Usuarios.idUnidad');
                $this->db->where('Unidad.Nivel', "SUP");

		$query = $this->db->get();

		return $query->result();

	}


        function getRevMS() {
		$this->db->select('');
		$this->db->from('Usuarios');
                $this->db->where('idRoles', "3");

		$query = $this->db->get();

		return $query->result();

	}


        function getRevSup() {
		$this->db->select('');
		$this->db->from('Usuarios');
                $this->db->where('idRoles', "4");

		$query = $this->db->get();

		return $query->result();

	}


        function getAdmin() {
		$this->db->select('');
		$this->db->from('Usuarios');
                $this->db->where('idRoles', "1");

		$query = $this->db->get();

		return $query->result();

	}

}
?>
