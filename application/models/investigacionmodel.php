<?php
Class InvestigacionModel extends CI_Model {

	function update_id($datos) {
		$data = array(
			'DocentesInvestigacion' => $datos['DocentesInvestigacion'],
			'TotalDocentes'         => $datos['TotalDocentes'],
			'comprobante1'      => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('InvestigacionDocencia', $data);

	}

	function update_ia($datos) {
		$data = array(
			'AlumnosCoautores'       => $datos['AlumnosCoautores'],
			'ProfesoresConProyectos' => $datos['ProfesoresConProyectos'],
			'comprobante1'      => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('AlumnosInvestigacion', $data);

	}

	function update_idSup($datos) {
		$data = array(
			'DocentesInvestigacion' => $datos['DocentesInvestigacion'],
			'TotalDocentes'         => $datos['TotalDocentes'],
			'comprobante1'      => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('InvestigacionDocenciaSup', $data);

	}

	function update_iaSup($datos) {
		$data = array(
			'InnovacionesIncubadas'       => $datos['InnovacionesIncubadas'],
			'InnovacionesIncubadasAnt' => $datos['InnovacionesIncubadasAnt'],
			'comprobante1'      => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('InnovacionEducativaSup', $data);

	}

}
?>
