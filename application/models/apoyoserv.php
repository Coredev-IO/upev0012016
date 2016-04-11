<?php
Class Apoyoserv extends CI_Model {

	function update($datos) {
		$data = array(
			'TotalAcervoLibros'       => $datos['TotalAcervoLibros'],
			'TotalLibrosFisicos'      => $datos['TotalLibrosFisicos'],
			'CapacidadInternet'       => $datos['CapacidadInternet'],
			'UsuariosInternet'        => $datos['UsuariosInternet'],
			'MantenimientoAtendido'   => $datos['MantenimientoAtendido'],
			'MantenimientoSolicitado' => $datos['MantenimientoSolicitado'],
			'LimpiezaAtendida'        => $datos['LimpiezaAtendida'],
			'LimpiezaProgramada'      => $datos['LimpiezaProgramada'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('ApoyoEducativo', $data);

	}
}
?>
