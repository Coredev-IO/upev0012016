<?php
Class Unidades extends CI_Model {
	//Obtine Datos de unidad de un usuario
        function getUnidades($tipo) {
		$this->db->select('');
		$this->db->from('Unidad');
                $this->db->where('Nivel', $tipo);
                $this->db->order_by("Siglas", "asc");

		$query = $this->db->get();

		return $query->result();

	}

}
?>
