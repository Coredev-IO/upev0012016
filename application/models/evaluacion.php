<?php
Class Evaluacion extends CI_Model {

	function getEvaluaciones() {
		$this->db->select('');
		$this->db->from('Evaluacion');

		$query = $this->db->get();
		return $query->result();

	}

	function getEvaluacionUnidad($unidad) {
		$this->db->select('');
		$this->db->from('Evaluacion');
		$this->db->where('idUnidad', $unidad);

		$query = $this->db->get();
		return $query->result();

	}

	function crearEvaluacion($data) {
		$this->db->insert('Evaluacion', $data);

	}

	function getLastEvaluacion($unidad) {
		$this->db->select('');
		$this->db->from('Evaluacion');
		$this->db->where('idUnidad', $unidad);
		$this->db->order_by("CreateDate", "desc");
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function getEvaluacionId($id, $unidad) {
		$this->db->select('');
		$this->db->from('Evaluacion');
		$this->db->where('idEvaluacion', $id);
		$this->db->where('idUnidad', $unidad);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function getAlumnos($id) {
		$this->db->select('');
		$this->db->from('Alumnos');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}
	function getDocentes($id) {
		$this->db->select('');
		$this->db->from('Docentes');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function getProgramasAcademicos($id) {
		$this->db->select('');
		$this->db->from('ProgramasAcademicos');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}
	function getInfraestructura($id) {
		$this->db->select('');
		$this->db->from('Infraestructura');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

}
?>
