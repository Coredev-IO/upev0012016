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
			'comprobante1'      => $datos['comprobante1'],
			'comprobante2'      => $datos['comprobante2'],
			'comprobante3'      => $datos['comprobante3'],
			'comprobante4'      => $datos['comprobante4'],
			'comprobante5'      => $datos['comprobante5'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('ApoyoEducativo', $data);

	}

	function update_ApoyoSup($datos) {
		$data = array(
			'LibrosActualizados'       => $datos['LibrosActualizados'],
			'TotalAcervoLibros'      => $datos['TotalAcervoLibros'],
			'MantenimientoAtendido'   => $datos['MantenimientoAtendido'],
			'MantenimientoSolicitado' => $datos['MantenimientoSolicitado'],
			'LimpiezaAtendida'        => $datos['LimpiezaAtendida'],
			'LimpiezaProgramada'      => $datos['LimpiezaProgramada'],
			'comprobante1'      => $datos['comprobante1'],
			'comprobante2'      => $datos['comprobante2'],
			'comprobante3'      => $datos['comprobante3'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('ApoyoEducativoSup', $data);

	}

	function getApoyoSup($id) {
		$this->db->select('');
		$this->db->from('ApoyoEducativoSup');
                $this->db->where('idEvaluacion', $id);

                $query = $this->db->get();

                return $query->result();

	}

	function getApoyoMed($id) {
		$this->db->select('');
		$this->db->from('ApoyoEducativo');
                $this->db->where('idEvaluacion', $id);

                $query = $this->db->get();

                return $query->result();

	}
}
?>
