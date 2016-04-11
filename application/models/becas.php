<?php
Class Becas extends CI_Model {

	function update($datos) {
		$data = array(
			'AlumnosBeca'  => $datos['AlumnosBeca'],
			'TotalAlumnos' => $datos['TotalAlumnos'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Becas', $data);

	}

}
?>
