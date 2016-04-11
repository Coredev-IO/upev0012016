<?php
Class Tutorias extends CI_Model {

	function update($datos) {
		$data = array(
			'TotalAlumnos' => $datos['TotalAlumnos'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Tutorias', $data);

	}

}
?>
