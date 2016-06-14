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

	function getLastEvaluacionSup($unidad) {
		$this->db->select('');
		$this->db->from('EvaluacionSup');
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

	//Evaluaciones subnivel de bloque Superior
	function getEvaluacionSubnivelSup($unidad) {
		$this->db->select('');
		$this->db->from('IndicadorSup');
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

	function getEvaluacionSubnivelFiltroSup($unidad, $evaluacion) {
		$this->db->select('');
		$this->db->from('IndicadorSup');
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

	//Se insertan datos de subnivel Superior
	function insert_subnivelSup($datos) {
		$data = array(
			'idUnidad'     => $datos['idUnidad'],
			'idBloque'     => $datos['idBloque'],
			'idEvaluacion' => $datos['idEvaluacion'],
			'idCampo'      => $datos['idCampo'],
		);
		$this->db->insert('IndicadorSup', $data);

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

	function getEvaluacionIdSup($id, $unidad) {
		$this->db->select('');
		$this->db->from('EvaluacionSup');
		$this->db->where('idEvaluacionSup', $id);
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

	function getAlumnosSup($id) {
		$this->db->select('');
		$this->db->from('AlumnosSup');
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

	function getDocentesSup($id) {
		$this->db->select('');
		$this->db->from('DocentesSup');
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

	function getProgramasAcademicosSup($id) {
		$this->db->select('');
		$this->db->from('ProgramasAcademicosSup');
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

	function getInfraestructuraSup($id) {
		$this->db->select('');
		$this->db->from('InfraestructuraSup');
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

	function getBecasSup($id) {
		$this->db->select('');
		$this->db->from('BecasSup');
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

	function getTutoriasSup($id) {
		$this->db->select('');
		$this->db->from('TutoriasSup');
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

	function getServiciosSup($id) {
		$this->db->select('');
		$this->db->from('ApoyoEducativoSup');
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

	function getServicioSocialSup($id) {
		$this->db->select('');
		$this->db->from('ServicioSocialSup');
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

	function getVisitasEscolaresSup($id) {
		$this->db->select('');
		$this->db->from('PracticasProfesionalesSup');
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

	function getProyectosVinculadosSup($id) {
		$this->db->select('');
		$this->db->from('ProyectosVinculadosSup');
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

	function getApoyoDocenciaSup($id) {
		$this->db->select('');
		$this->db->from('InvestigacionDocenciaSup');
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

		function getParticipacionAlmunnosSup($id) {
		$this->db->select('');
		$this->db->from('InnovacionEducativaSup');
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

	function getGestionSup($id) {
		$this->db->select('');
		$this->db->from('RecursosAutogeneradosSup');
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

	function update_BAlumnosRegularesSup($datos) {
		$data = array(
			'BAlumnosRegulares' => $datos['BAlumnosRegulares'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BAlumnosRegularesTSup($datos) {
		$data = array(
			'BAlumnosRegularesT' => $datos['BAlumnosRegularesT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BEficienciaTerminalSup($datos) {
		$data = array(
			'BEficienciaTerminal' => $datos['BEficienciaTerminal'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BEficienciaTerminalTSup($datos) {
		$data = array(
			'BEficienciaTerminalT' => $datos['BEficienciaTerminalT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BAlumnosRiesgoAbandonoSup($datos) {
		$data = array(
			'BAlumnosRiesgoAbandono' => $datos['BAlumnosRiesgoAbandono'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BAlumnosRiesgoAbandonoTSup($datos) {
		$data = array(
			'BAlumnosRiesgoAbandonoT' => $datos['BAlumnosRiesgoAbandonoT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BRecienEgresadosSup($datos) {
		$data = array(
			'BRecienEgresados' => $datos['BRecienEgresados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BRecienEgresadosTSup($datos) {
		$data = array(
			'BRecienEgresadosT' => $datos['BRecienEgresadosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BAlumnosTituladosSup($datos) {
		$data = array(
			'BAlumnosTitulados' => $datos['BAlumnosTitulados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BAlumnosTituladosTSup($datos) {
		$data = array(
			'BAlumnosTituladosT' => $datos['BAlumnosTituladosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BHorasFrenteGrupoSup($datos) {
		$data = array(
			'BHorasFrenteGrupo' => $datos['BHorasFrenteGrupo'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BHorasFrenteGrupoTSup($datos) {
		$data = array(
			'BHorasFrenteGrupoT' => $datos['BHorasFrenteGrupoT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BProfesoresActivosSup($datos) {
		$data = array(
			'BProfesoresActivos' => $datos['BProfesoresActivos'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BProfesoresActivosTSup($datos) {
		$data = array(
			'BProfesoresActivosT' => $datos['BProfesoresActivosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BProfesoresActualizadosSup($datos) {
		$data = array(
			'BProfesoresActualizados' => $datos['BProfesoresActualizados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BProfesoresActualizadosTSup($datos) {
		$data = array(
			'BProfesoresActualizadosT' => $datos['BProfesoresActualizadosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BEvaluacionesIndividualesSup($datos) {
		$data = array(
			'BEvaluacionesIndividuales' => $datos['BEvaluacionesIndividuales'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BEvaluacionesIndividualesTSup($datos) {
		$data = array(
			'BEvaluacionesIndividualesT' => $datos['BEvaluacionesIndividualesT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BProgramasAcademicosSup($datos) {
		$data = array(
			'BProgramasAcedAcred' => $datos['BProgramasAcedAcred'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BProgramasAcademicosTSup($datos) {
		$data = array(
			'BProgramasAcedAcredT' => $datos['BProgramasAcedAcredT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BProgramasAcademicosActSup($datos) {
		$data = array(
			'BProgramasAcualizados' => $datos['BProgramasAcualizados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}
	function update_BProgramasAcademicosActTSup($datos) {
		$data = array(
			'BProgramasAcualizadosT' => $datos['BProgramasAcualizadosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BBecas($datos) {
		$data = array(
			'BBecas' => $datos['BBecas'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BBecasT($datos) {
		$data = array(
			'BBecasT' => $datos['BBecasT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BAlumnosTutorados($datos) {
		$data = array(
			'BAlumnosTutorados' => $datos['BAlumnosTutorados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BAlumnosTutoradosSup($datos) {
		$data = array(
			'BAlumnosTutorados' => $datos['BAlumnosTutorados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BAlumnosTutoradosT($datos) {
		$data = array(
			'BAlumnosTutoradosT' => $datos['BAlumnosTutoradosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BAlumnosTutoradosTSup($datos) {
		$data = array(
			'BAlumnosTutoradosT' => $datos['BAlumnosTutoradosT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	// +++++++++++Campos Superior que no estan en Medio Superior++++++++++

	function update_BTitulosAct($datos) {
		$data = array(
			'BTitulosAct' => $datos['BTitulosAct'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BTitulosActT($datos) {
		$data = array(
			'BTitulosActT' => $datos['BTitulosActT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	function update_BCumplimientoMant($datos) {
		$data = array(
			'BCumplimientoMant' => $datos['BCumplimientoMant'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BCumplimientoMantT($datos) {
		$data = array(
			'BCumplimientoMantT' => $datos['BCumplimientoMantT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}
	// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	function update_BCumplimientoProgLimp($datos) {
		$data = array(
			'BCumplimientoProgLimp' => $datos['BCumplimientoProgLimp'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BCumplimientoProgLimpT($datos) {
		$data = array(
			'BCumplimientoProgLimpT' => $datos['BCumplimientoProgLimpT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}
	// ++++++++++++++++++Termina Campos Superior+++++++++++++++++++++++++


	function update_BlibrosTitulosEditados($datos) {
		$data = array(
			'BlibrosTitulosEditados' => $datos['BlibrosTitulosEditados'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BlibrosTitulosEditadosT($datos) {
		$data = array(
			'BlibrosTitulosEditadosT' => $datos['BlibrosTitulosEditadosT'],
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

	function update_BTotalEjemplaresT($datos) {
		$data = array(
			'BTotalEjemplaresT' => $datos['BTotalEjemplaresT'],
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

	function update_BAlumnosServicioSocialSup($datos) {
		$data = array(
			'BAlumnosSerSoc' => $datos['BAlumnosSerSoc'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BAlumnosServicioSocialT($datos) {
		$data = array(
			'BAlumnosServicioSocialT' => $datos['BAlumnosServicioSocialT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BAlumnosServicioSocialTSup($datos) {
		$data = array(
			'BAlumnosSerSocT' => $datos['BAlumnosSerSocT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

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

	function update_BALumnosVisitasSup($datos) {
		$data = array(
			'BAlumnosPractProf' => $datos['BAlumnosPractProf'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

	function update_BALumnosVisitasT($datos) {
		$data = array(
			'BALumnosVisitasT' => $datos['BALumnosVisitasT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorMs', $data);

	}

	function update_BALumnosVisitasTSup($datos) {
		$data = array(
			'BAlumnosPractProfT' => $datos['BAlumnosPractProfT'],
		);
		$this->db->where('idUnidad', $datos['idUnidad']);
		$this->db->where('idBloque', $datos['idBloque']);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('IndicadorSup', $data);

	}

}
?>
