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

}
?>
