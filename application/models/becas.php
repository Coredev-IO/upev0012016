<?php
Class Becas extends CI_Model {

	function update($datos) {
		$data = array(
			'AlumnosBeca'  => $datos['AlumnosBeca'],
			'TotalAlumnos' => $datos['TotalAlumnos'],
			'comprobante1'      => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Becas', $data);

	}

	function updateBecSup($datos) {
		$data = array(
			'comprobante1'      => $datos['comprobante1'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('BecasSup', $data);

	}

	function getBecasMed($id) {
		$this->db->select('');
		$this->db->from('Becas');
                $this->db->where('idEvaluacion', $id);

                $query = $this->db->get();

                return $query->result();

	}

}
?>
