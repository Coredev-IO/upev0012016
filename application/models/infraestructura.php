<?php
Class Infraestructura extends CI_Model {

	function update($datos) {
		$data = array(
			'AlumnosInscritos'   => $datos['AlumnosInscritos'],
			'CapacidadInstalada' => $datos['CapacidadInstalada'],
			'AulasEquipadas'     => $datos['AulasEquipadas'],
			'TotalAulas'         => $datos['TotalAulas'],
			'TotalLaboratorios'  => $datos['TotalLaboratorios'],
			'comprobante1'  => $datos['comprobante1'],
			'comprobante2'  => $datos['comprobante2'],
			'comprobante3'  => $datos['comprobante3'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('Infraestructura', $data);

	}


	function updateSup($datos) {
		$data = array(
			'CapacidadInstalada'   => $datos['CapacidadInstalada'],
			'NumeroAulas' => $datos['NumeroAulas'],
			'TotalAulas'     => $datos['TotalAulas'],
			'NumeroLaboratorios'         => $datos['NumeroLaboratorios'],
			'TotalLaboratorios'  => $datos['TotalLaboratorios'],
			'comprobante1'  => $datos['comprobante1'],
			'comprobante2'  => $datos['comprobante2'],
			'comprobante3'  => $datos['comprobante3'],
		);
		$this->db->where('idEvaluacion', $datos['idEvaluacion']);
		$this->db->update('InfraestructuraSup', $data);

	}

	    function getInfraSup($id) {
		$this->db->select('');
		$this->db->from('InfraestructuraSup');
                $this->db->where('idEvaluacion', $id);

                $query = $this->db->get();

                return $query->result();

	}

	    function getInfraMed($id) {
		$this->db->select('');
		$this->db->from('Infraestructura');
                $this->db->where('idEvaluacion', $id);

                $query = $this->db->get();

                return $query->result();

	}

}
?>
