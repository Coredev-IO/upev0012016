<?php
Class Recursos extends CI_Model {

	function update($datos) {
		$data = array(
			'RecursosEjercidos'     => $datos['RecursosEjercidos'],
			'RecursosAutogenerados' => $datos['RecursosAutogenerados'],
			'comprobante1'               => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('RecursosAutogenerados', $data);

	}

	function updateSup($datos) {
		$data = array(
			'RecursosEjercidos'     => $datos['RecursosEjercidos'],
			'RecursosAutogenerados' => $datos['RecursosAutogenerados'],
			'comprobante1'               => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('RecursosAutogeneradosSup', $data);

	}

	function getRecursosSup($id) {
		$this->db->select('');
		$this->db->from('RecursosAutogeneradosSup');
                $this->db->where('idEvaluacion', $id);

                $query = $this->db->get();

                return $query->result();

	}

}
?>
