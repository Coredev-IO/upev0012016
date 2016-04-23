<?php
Class Alumnos extends CI_Model {

	function getAlumnosEval($id) {
		$this->db->select('');
		$this->db->from('Alumnos');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function update_Alumnos($datos) {
		$data = array(
			'AlumnosInscritos'           => $datos['AlumnosInscritos'],
			'AlumnosTotalesCohorte'      => $datos['AlumnosTotalesCohorte'],
			'AlumnosEgresadosGeneracion' => $datos['AlumnosEgresadosGeneracion'],
			'AlumnosExamenNSIPN'         => $datos['AlumnosExamenNSIPN'],
			'comprobante1'               => $datos['comprobante1'],
			'comprobante2'               => $datos['comprobante2'],
			'comprobante3'               => $datos['comprobante3'],
			'comprobante4'               => $datos['comprobante4'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Alumnos', $data);

	}

}
?>
