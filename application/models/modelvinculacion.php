<?php
Class Modelvinculacion extends CI_Model {

	function update_ss($datos) {
		$data = array(
			'AlumnosServicioAnterior' => $datos['AlumnosServicioAnterior'],
			'comprobante1'               => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('ServicioSocial', $data);

	}

	function update_vs($datos) {
		$data = array(
			'TotalMatricula' => $datos['TotalMatricula'],
			'comprobante1'               => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('VisitasEscolares', $data);

	}

	function update_pv($datos) {
		$data = array(
			'ProyectosVinculadosAct' => $datos['ProyectosVinculadosAct'],
			'ProyectosVinculadosAnt' => $datos['ProyectosVinculadosAnt'],
			'comprobante1'               => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('ProyectosVinculados', $data);

	}

}
?>
