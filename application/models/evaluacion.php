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

	//Evaluaciones subnivel de bloque y evaluacion en especifico
	function getEvaluacionSubnivelFiltro($unidad, $evaluacion) {
		$this->db->select('');
		$this->db->from('IndicadorMs');
		$this->db->where('idUnidad', $unidad);
		$this->db->where('idEvaluacion', $evaluacion);

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

	function getBecas($id) {
		$this->db->select('');
		$this->db->from('Becas');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}
	function getTutorias($id) {
		$this->db->select('');
		$this->db->from('Tutorias');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}
	function getServicios($id) {
		$this->db->select('');
		$this->db->from('ApoyoEducativo');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function getServicioSocial($id) {
		$this->db->select('');
		$this->db->from('ServicioSocial');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function getVisitasEscolares($id) {
		$this->db->select('');
		$this->db->from('VisitasEscolares');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function getProyectosVinculados($id) {
		$this->db->select('');
		$this->db->from('ProyectosVinculados');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function getApoyoDocencia($id) {
		$this->db->select('');
		$this->db->from('InvestigacionDocencia');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}
	function getParticipacionAlmunnos($id) {
		$this->db->select('');
		$this->db->from('AlumnosInvestigacion');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	function getGestion($id) {
		$this->db->select('');
		$this->db->from('RecursosAutogenerados');
		$this->db->where('idEvaluacion', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		return $query->result();

	}

	// --- **************
	function update_BAlumnosRegulares($datos) {
		$data = array(
			'BAlumnosRegulares' => $datos['BAlumnosRegulares'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

        function update_BAlumnosRegularesT($datos) {
                $data = array(
                        'BAlumnosRegularesT' => $datos['BAlumnosRegularesT'],
                );
                $this->db->where('idUnidad', $datos['idUnidad']);
                $this->db->where('idBloque', $datos['idBloque']);
                $this->db->where('idEvaluacion', $datos['idEvaluacion']);
                $this->db->update('IndicadorMs', $data);

        }

	function update_BEficienciaTerminal($datos) {
		$data = array(
			'BEficienciaTerminal' => $datos['BEficienciaTerminal'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

        function update_BEficienciaTerminalT($datos) {
		$data = array(
			'BEficienciaTerminalT' => $datos['BEficienciaTerminalT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BAlumnosTitulados($datos) {
		$data = array(
			'BAlumnosTitulados' => $datos['BAlumnosTitulados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

        function update_BAlumnosTituladosT($datos) {
		$data = array(
			'BAlumnosTituladosT' => $datos['BAlumnosTituladosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BPromocionNS($datos) {
		$data = array(
			'BPromocionNS' => $datos['BPromocionNS'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

        function update_BPromocionNST($datos) {
                $data = array(
                        'BPromocionNST' => $datos['BPromocionNST'],
                );
                $this->db->where('idUnidad', $datos['idUnidad']);
                $this->db->where('idBloque', $datos['idBloque']);
                $this->db->where('idEvaluacion', $datos['idEvaluacion']);
                $this->db->update('IndicadorMs', $data);

        }

	function update_BHorasFrenteGrupo($datos) {
		$data = array(
			'BHorasFrenteGrupo' => $datos['BHorasFrenteGrupo'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BHorasFrenteGrupoT($datos) {
		$data = array(
			'BHorasFrenteGrupoT' => $datos['BHorasFrenteGrupoT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BProfesoresActivos($datos) {
		$data = array(
			'BProfesoresActivos' => $datos['BProfesoresActivos'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BProfesoresActivosT($datos) {
		$data = array(
			'BProfesoresActivosT' => $datos['BProfesoresActivosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BProfesoresActualizados($datos) {
		$data = array(
			'BProfesoresActualizados' => $datos['BProfesoresActualizados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BProfesoresActualizadosT($datos) {
		$data = array(
			'BProfesoresActualizadosT' => $datos['BProfesoresActualizadosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BEvaluacionesIndividuales($datos) {
		$data = array(
			'BEvaluacionesIndividuales' => $datos['BEvaluacionesIndividuales'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BEvaluacionesIndividualesT($datos) {
		$data = array(
			'BEvaluacionesIndividualesT' => $datos['BEvaluacionesIndividualesT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	// ------------*******
	function update_BProgramasAcademicos($datos) {
		$data = array(
			'BProgramasAcademicos' => $datos['BProgramasAcademicos'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BProgramasAcademicosT($datos) {
		$data = array(
			'BProgramasAcademicosT' => $datos['BProgramasAcademicosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BLaboratoriosEquipados($datos) {
		$data = array(
			'BLaboratoriosEquipados' => $datos['BLaboratoriosEquipados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BLaboratoriosEquipadosT($datos) {
		$data = array(
			'BLaboratoriosEquipadosT' => $datos['BLaboratoriosEquipadosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	// ----------- ***
	function update_BAlumnosTutorados($datos) {
		$data = array(
			'BAlumnosTutorados' => $datos['BAlumnosTutorados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BlibrosTitulosEditados($datos) {
		$data = array(
			'BlibrosTitulosEditados' => $datos['BlibrosTitulosEditados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BTotalEjemplares($datos) {
		$data = array(
			'BTotalEjemplares' => $datos['BTotalEjemplares'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	// -------------- ***
	function update_BAlumnosServicioSocial($datos) {
		$data = array(
			'BAlumnosServicioSocial' => $datos['BAlumnosServicioSocial'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BALumnosVisitas($datos) {
		$data = array(
			'BALumnosVisitas' => $datos['BALumnosVisitas'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

}
?>
