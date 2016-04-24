<?php
Class Programas extends CI_Model {

	function update($datos) {
		$data = array(
			'TotalProgramas' => $datos['TotalProgramas'],
			'comprobante1'   => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('ProgramasAcademicos', $data);

	}

}
?>
