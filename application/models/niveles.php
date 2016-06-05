<?php
Class Niveles extends CI_Model {

	function nivel1($id) {
		$this->db->select('');
		$this->db->from('Indicador1');
		$this->db->where('idIndicador1', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function nivel1Sup($id) {
		$this->db->select('');
		$this->db->from('Indicador1Sup');
		$this->db->where('idIndicador1Sup', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function nivel2($id) {
		$this->db->select('');
		$this->db->from('Indicador2');
		$this->db->where('idIndicador1', $id);

		$query = $this->db->get();

		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function nivel2Sup($id) {
		$this->db->select('');
		$this->db->from('Indicador2Sup');
		$this->db->where('idIndicador1Sup', $id);

		$query = $this->db->get();

		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function nivel3($id, $idn) {
		$this->db->select('');
		$this->db->from('Indicador3');
		$this->db->where('idIndicador1', $id);
		$this->db->where('idIndicador2', $idn);

		$query = $this->db->get();

		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function nivel3Sup($id, $idn) {
		$this->db->select('');
		$this->db->from('Indicador3Sup');
		$this->db->where('idIndicador1Sup', $id);
		$this->db->where('idIndicador2Sup', $idn);

		$query = $this->db->get();

		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}

}
?>
