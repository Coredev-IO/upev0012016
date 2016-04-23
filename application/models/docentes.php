<?php
Class Docentes extends CI_Model {

	function update_Docentes($datos) {
		$data = array(
			'TotalHorasReglamento'               => $datos['TotalHorasReglamento'],
			'TotalDocentesContratadosAsignatura' => $datos['TotalDocentesContratadosAsignatura'],
			'TotalProfesores'                    => $datos['TotalProfesores'],
			'DocentesPertenecientes'             => $datos['DocentesPertenecientes'],
			'comprobante1'               => $datos['comprobante1'],
			'comprobante2'               => $datos['comprobante2'],
			'comprobante3'               => $datos['comprobante3'],
			'comprobante4'               => $datos['comprobante4'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Docentes', $data);

	}

}
?>
