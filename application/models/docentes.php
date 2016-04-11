<?php
Class Docentes extends CI_Model {

	function update_Docentes($datos) {
		$data = array(
			'TotalHorasReglamento'               => $datos['TotalHorasReglamento'],
			'TotalDocentesContratadosAsignatura' => $datos['TotalDocentesContratadosAsignatura'],
			'TotalProfesores'                    => $datos['TotalProfesores'],
			'DocentesPertenecientes'             => $datos['DocentesPertenecientes'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Docentes', $data);

	}

}
?>
