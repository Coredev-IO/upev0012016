<?php
Class Infraestructura extends CI_Model {

	function update($datos) {
		$data = array(
			'AlumnosInscritos'   => $datos['AlumnosInscritos'],
			'CapacidadInstalada' => $datos['CapacidadInstalada'],
			'AulasEquipadas'     => $datos['AulasEquipadas'],
			'TotalAulas'         => $datos['TotalAulas'],
			'TotalLaboratorios'  => $datos['TotalLaboratorios'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Infraestructura', $data);

	}

}
?>
