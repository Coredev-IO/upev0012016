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

	//Evaluaciones subnivel de bloque
	function getEvaluacionSubnivel($unidad) {
		$this->db->select('');
		$this->db->from('IndicadorMs');
		$this->db->where('idUnidad', $unidad);

		$query = $this->db->get();
		return $query->result();

	}

	//Bloque de unidad
	function getBloque($unidad) {
		$this->db->select('');
		$this->db->from('Bloques');
		$this->db->where('idUnidad', $unidad);

		$query = $this->db->get();
		return $query->result();

	}

	//Se insertan datos de subnivel
	function insert_subnivel($datos) {
		$data = array(
			'idUnidad'     => $datos['idUnidad'],
			'idBloque'     => $datos['idBloque'],
			'idEvaluacion' => $datos['idEvaluacion'],
			'idCampo'      => $datos['idCampo'],
		);
		$this->db->insert('IndicadorMs', $data);

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
