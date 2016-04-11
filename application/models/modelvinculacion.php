<?php
Class Modelvinculacion extends CI_Model {

	function update_ss($datos) {
		$data = array(
			'AlumnosServicioAnterior' => $datos['AlumnosServicioAnterior'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('ServicioSocial', $data);

	}

	function update_vs($datos) {
		$data = array(
			'TotalMatricula' => $datos['TotalMatricula'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('VisitasEscolares', $data);

	}

	function update_pv($datos) {
		$data = array(
			'ProyectosVinculadosAct' => $datos['ProyectosVinculadosAct'],
			'ProyectosVinculadosAnt' => $datos['ProyectosVinculadosAnt'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('ProyectosVinculados', $data);

	}

}
?>
