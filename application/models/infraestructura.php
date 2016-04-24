<?php
Class Infraestructura extends CI_Model {

	function update($datos) {
		$data = array(
			'AlumnosInscritos'   => $datos['AlumnosInscritos'],
			'CapacidadInstalada' => $datos['CapacidadInstalada'],
			'AulasEquipadas'     => $datos['AulasEquipadas'],
			'TotalAulas'         => $datos['TotalAulas'],
			'TotalLaboratorios'  => $datos['TotalLaboratorios'],
			'comprobante1'  => $datos['comprobante1'],
			'comprobante2'  => $datos['comprobante2'],
			'comprobante3'  => $datos['comprobante3'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Infraestructura', $data);

	}

}
?>
