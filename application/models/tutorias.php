<?php
Class Tutorias extends CI_Model {

	function update($datos) {
		$data = array(
			'TotalAlumnos' => $datos['TotalAlumnos'],
			'comprobante1'      => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Tutorias', $data);

	}

}
?>
