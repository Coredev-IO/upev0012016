<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Consultams extends CI_Controller {

	function __construct() {
		parent::__construct();
        //SE VERIFICA LA SESION
        $data['datos'] = $this->session->userdata('logged_in');
        $this->load->library('verify');
        $this->load->library('limites');
        $this->verify->seccion(3, $data['datos']['idRoles']);
        $this->load->model('unidades', '', TRUE);
        $this->load->model('evaluacion', '', TRUE);

        $this->load->model('niveles', '', TRUE);
				$this->load->model('alumnos', '', TRUE);
				$this->load->model('docentes', '', TRUE);
				$this->load->helper(array('form', 'url'));

				$this->load->model('programas', '', TRUE);
				$this->load->model('infraestructura', '', TRUE);

				$this->load->model('becas', '', TRUE);
				$this->load->model('tutorias', '', TRUE);
				$this->load->model('apoyoserv', '', TRUE);

				$this->load->model('modelvinculacion', '', TRUE);
        $this->load->model('investigacionmodel', '', TRUE);
        $this->load->model('recursos', '', TRUE);


	}



        public function index() {
                $data['datos'] = $this->session->userdata('logged_in');
                $data['unidades'] = $this->unidades->getUnidades('MED');
								// $data['evaluaciones'] = $this->evaluacion->getEvaluaciones
								//Unidades con su ultima evaluacion
								$unidadesEv =  array();
								foreach ($data['unidades'] as $row) {
									$puente =  array();
									$puente['idUnidad'] = $row->idUnidad;
									$puente['NombreUnidad'] = $row->NombreUnidad;
									$puente['Siglas'] = $row->Siglas;
									$evaluacion = $this->evaluacion->getLastEvaluacion($row->idUnidad);
									if(count($evaluacion)>0){
										$puente['idEvaluacion'] = $evaluacion[0]->idEvaluacion;
										$puente['fechaEvaluacion'] = $evaluacion[0]->CreateDate;
										$estado = "";
										switch ($evaluacion[0]->estado) {
														case "ACT":
																		$estado = "Proceso de captura";
																		break;
														case "REV":
																		$estado = "Activa para revisión";
																		break;
														case "FIN":
																		$estado = "Finalizada, generar resultados";
																		break;
														case "RES":
																		$estado = "Revisar resultados";
																		break;
														case "CAN":
																		$estado = "La evaluación ha sido cancelada";
																		break;
														default:
																		$estado =  "ERROR";
																		break;



										}
										$puente['estatusEvaluacion'] = $estado;
										$puente['estado'] = $evaluacion[0]->estado;
									}else{
										$puente['idEvaluacion'] = 0;
										$puente['fechaEvaluacion'] = "";
										$puente['estado'] = $evaluacion[0]->estado;
										$puente['estatusEvaluacion'] = "No hay evaluaciones";
									}
									array_push($unidadesEv,$puente);
								}
								// print_r($unidadesEv[10]);
								$data['unidadesEv'] = $unidadesEv;


                $data['main_cont'] = 'consultams/index';
                $this->load->view('includes/template_consultams', $data);
        }

        //CALCULO DE INDICADORES
	public function calculo() {
		$data['datos'] = $this->session->userdata('logged_in');
		$evaluacionid  = $this->uri->segment(3);
		$data['evaluacionid']  = $this->uri->segment(3);
		$genTipo  = $this->uri->segment(4);
		$data['urldata'] = $this->uri->segment(2).'/'.$this->uri->segment(3);
		// echo $evaluacionid;
		// echo "<br>";
		$idUnidad = $this->evaluacion->getIdUnidadMed($evaluacionid);
		$carreras = $this->evaluacion->getBloque($idUnidad);


		//SE CREA OBJETO CONTENEDOR
		$calculo = array();

		//**************************************************************************************************************************************************************************************************//

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "DESEMPEÑO";
		$nivel['porcentaje'] = 25;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "ALUMNOS";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos en situación escolar regular";
		$tercer['porcentaje']   = 35;
		$tercer['descripcion']  = "Porcentaje de alumnos que han aprobado todas las unidades de aprendizaje en las que han estado inscritos por Unidad  académica";
		$tercer['metodo']       = "(Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos  / Total de matrícula inscrita)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos en la unidad adadémica";
		$tercer['var2'] = "Total de matrícula inscrita";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BAlumnosRegulares;
			$tercer['val2'] = $tercer['val2']+$row->BAlumnosRegularesT;

			$objPuente['calculo'] = 0;
			$objPuente['var1'] = $row->BAlumnosRegulares;
			$objPuente['var2'] = $row->BAlumnosRegularesT;
			if($row->BAlumnosRegulares>0){
				$objPuente['calculo'] = (($row->BAlumnosRegulares)/($row->BAlumnosRegularesT))*100;
				$pre       = ($pre+((($row->BAlumnosRegulares)/($row->BAlumnosRegularesT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}
		$tercer['variables'] = $objCalculosIngresados;

        $objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	29.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
        $objeto[1][0]=	30	; $objeto[1][1]=	39.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
        $objeto[2][0]=	40	; $objeto[2][1]=	49.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
        $objeto[3][0]=	50	; $objeto[3][1]=	59.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
        $objeto[4][0]=	60	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

        $tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);


		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Eficiencia  terminal";
		$tercer['porcentaje']   = 25;
		$tercer['descripcion']  = "Porcentaje de alumnos que egresan por cohorte generacional por programa académico";
		$tercer['metodo']       = "( Ʃ 1 n Número de alumnos del cohorte A que egresan  en el año n / total de alumnos en el cohorte A)";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos del cohorte A que egresan  en el año";
		$tercer['var2'] = "Total de alumnos en el cohorte A";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BEficienciaTerminal;
			$tercer['val2'] = $tercer['val2']+$row->BEficienciaTerminalT;
			$objPuente['var1'] = $row->BEficienciaTerminal;
			$objPuente['var2'] = $row->BEficienciaTerminalT;
			$objPuente['calculo'] = 0;
			if($row->BEficienciaTerminalT>0){
				$objPuente['calculo'] = ((($row->BEficienciaTerminal)/($row->BEficienciaTerminalT)));
				$pre       = ($pre+((($row->BEficienciaTerminal)/($row->BEficienciaTerminalT))));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2']);}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

                $objeto = array();
                $objeto[0] = array();
                $objeto[1] = array();
                $objeto[2] = array();
                $objeto[3] = array();
                $objeto[4] = array();

                $objeto[0][0]=	0.1	; $objeto[0][1]=	24.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
                $objeto[1][0]=	25	; $objeto[1][1]=	34.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
                $objeto[2][0]=	35	; $objeto[2][1]=	44.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
                $objeto[3][0]=	45	; $objeto[3][1]=	59.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
                $objeto[4][0]=	60	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

                $tercer['limites'] = $objeto;


                $tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
                $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos titulados";
		$tercer['porcentaje']   = 5;
		$tercer['descripcion']  = "Porcentaje de alumnos titulados hasta tres años después de egresar por programa académico";
		$tercer['metodo']       = "(Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico /total de la matrícula de egreso del mismo periodo por programa académico)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico";
		$tercer['var2'] = "Total de la matrícula de egreso del mismo periodo por programa académico";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BAlumnosTitulados;
			$tercer['val2'] = $tercer['val2']+$row->BAlumnosTituladosT;
			$objPuente['var1'] = $row->BAlumnosTitulados;
			$objPuente['var2'] = $row->BAlumnosTituladosT;
			$objPuente['calculo'] = 0;
			if($row->BAlumnosTituladosT>0){
				$objPuente['calculo'] = ((($row->BAlumnosTitulados)/($row->BAlumnosTituladosT))*100);
				$pre       = ($pre+((($row->BAlumnosTitulados)/($row->BAlumnosTituladosT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	29.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	30	; $objeto[1][1]=	39.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	40	; $objeto[2][1]=	49.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	50	; $objeto[3][1]=	59.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	60	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Promoción  de alumnos por nivel educativo";
		$tercer['porcentaje']   = 35;
		$tercer['descripcion']  = "Porcentaje de alumnos de NMS del IPN que concluyeron el último semestre y presentaron examen de admision  y ocuparon un lugar en NS del IPN";
		$tercer['metodo']       = "(Número de alumnos de NMS del IPN que concluyeron el último semestre y presentaron examen de admision  y ocuparon un lugar en NS del IPN por programa académico / Total de alumnos del NMS del IPN que presentaron examen de ingreso al NS del IPN)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos de NMS del IPN que concluyeron el último semestre y presentaron examen de admisión  y ocuparon un lugar en NS del IPN por programa académico";
		$tercer['var2'] = "Total de alumnos del NMS del IPN que presentaron examen de ingreso al NS del IPN";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BPromocionNS;
			$tercer['val2'] = $tercer['val2']+$row->BPromocionNST;
			$objPuente['calculo'] = 0;
			if($row->BPromocionNST>0){
				$pre       = ($pre+((($row->BPromocionNS)/($row->BPromocionNST))*100));
				$objPuente['calculo'] = ((($row->BPromocionNS)/($row->BPromocionNST))*100);
			}
			$objPuente['var1'] = $row->BPromocionNS;
			$objPuente['var2'] = $row->BPromocionNST;

			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	49.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	50	; $objeto[1][1]=	59.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	60	; $objeto[2][1]=	69.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	70	; $objeto[3][1]=	84.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	85	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "DESEMPEÑO";
		$nivel['porcentaje'] = 25;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "PERFIL DOCENTE";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Aprovechamiento de la Planta Docente";
		$tercer['porcentaje']   = 20;
		$tercer['descripcion']  = "Total de horas frente a grupo por profesores de base por academia  25%";
		$tercer['metodo']       = "(Total de horas frente a grupo por profesores de base por periodo semestral por academia/  cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia)";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Total de horas frente a grupo por profesores de base por periodo semestral por academia";
		$tercer['var2'] = "Cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BHorasFrenteGrupo;
			$tercer['val2'] = $tercer['val2']+$row->BHorasFrenteGrupoT;

			$objPuente['var1'] = $row->BHorasFrenteGrupo;
			$objPuente['var2'] = $row->BHorasFrenteGrupoT;
			$objPuente['calculo'] = 0;
			if($row->BHorasFrenteGrupoT>0){
				$objPuente['calculo'] = ((($row->BHorasFrenteGrupo)/($row->BHorasFrenteGrupoT))*100);
				$pre       = ($pre+((($row->BHorasFrenteGrupo)/($row->BHorasFrenteGrupoT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	69.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	70	; $objeto[1][1]=	74.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	75	; $objeto[2][1]=	79.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	80	; $objeto[3][1]=	84.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	85	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Docentes de Asignatura activos en el Sector Productivo";
		$tercer['porcentaje']   = 15;
		$tercer['descripcion']  = "Porcentaje de docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen 25%";
		$tercer['metodo']       = "(Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica/total de docentes contratados por asignatura  por unidad académica)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica";
		$tercer['var2'] = "Total de docentes contratados por asignatura  por unidad académica";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->BProfesoresActivos;
$tercer['val2'] = $tercer['val2']+$row->BProfesoresActivosT;

			$objPuente['var1'] = $row->BProfesoresActivos;
			$objPuente['var2'] = $row->BProfesoresActivosT;
			$objPuente['calculo'] = 0;
			if($row->BProfesoresActivosT>0){
				$objPuente['calculo'] = ((($row->BProfesoresActivos)/($row->BProfesoresActivosT))*100);
				$pre       = ($pre+((($row->BProfesoresActivos)/($row->BProfesoresActivosT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	49.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	50	; $objeto[1][1]=	59.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	60	; $objeto[2][1]=	69.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	70	; $objeto[3][1]=	79.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	80	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Docentes actualizados en el Área Disciplinar";
		$tercer['porcentaje']   = 25;
		$tercer['descripcion']  = "Porcentaje de profesores con por  lo menos una acción de actualización en su área disciplinar en los últimos dos años 25%";
		$tercer['metodo']       = "(Número de profesores con por  lo menos una acción de actualización en su área disciplinar  / total de los profesores)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de profesores con por  lo menos una acción de actualización en su área disciplinar";
		$tercer['var2'] = "Total de los profesores";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->BProfesoresActualizados;
$tercer['val2'] = $tercer['val2']+$row->BProfesoresActualizadosT;

			$objPuente['var1'] = $row->BProfesoresActualizados;
			$objPuente['var2'] = $row->BProfesoresActualizadosT;
			$objPuente['calculo'] = 0;
			if($row->BProfesoresActualizadosT>0){
				$objPuente['calculo'] = ((($row->BProfesoresActualizados)/($row->BProfesoresActualizadosT))*100);
				$pre       = ($pre+((($row->BProfesoresActualizados)/($row->BProfesoresActualizadosT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	29.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	30	; $objeto[1][1]=	39.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	40	; $objeto[2][1]=	49.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	50	; $objeto[3][1]=	59.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	60	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Desempeño Docente";
		$tercer['porcentaje']   = 40;
		$tercer['descripcion']  = "promedio de las evaluaciones individuales del cuestionario de apreciación estudiantil 25%";
		$tercer['metodo']       = "(la suma de la evaluación individual del cuestionario de apreciación estudiantil por docente por periodo semestral  por unidad académica/ entre el total del número docentes perteneciente, por periodo semestral por unidad académica)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "La suma de la evaluación individual del cuestionario de apreciación estudiantil por docente por periodo semestral  por unidad académica";
		$tercer['var2'] = "Total del número docentes perteneciente, por periodo semestral por unidad académica";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BEvaluacionesIndividuales;
			$tercer['val2'] = $tercer['val2']+$row->BEvaluacionesIndividualesT;

			$objPuente['var1'] = $row->BEvaluacionesIndividuales;
			$objPuente['var2'] = $row->BEvaluacionesIndividualesT;
			$objPuente['calculo'] = 0;
			if($row->BEvaluacionesIndividualesT>0){
				$objPuente['calculo'] = ((($row->BEvaluacionesIndividuales)/($row->BEvaluacionesIndividualesT))*100);
				$pre       = ($pre+((($row->BEvaluacionesIndividuales)/($row->BEvaluacionesIndividualesT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	59.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	60	; $objeto[1][1]=	79.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	80	; $objeto[2][1]=	84.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	85	; $objeto[3][1]=	89.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	90	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//
                $resumenBloques = array();
                $resumenBloques['bloque'] = array();

                $obtest = array();
                $obtest['nombre'] = 'DESEMPEÑO';
                $obtest['suma'] = $calculo[0]['segundobloque']['calculoDimension']+$calculo[1]['segundobloque']['calculoDimension'];
                $obtest['total'] = ($calculo[0]['segundobloque']['calculoDimension']+$calculo[1]['segundobloque']['calculoDimension'])*(0.25);
                array_push($resumenBloques['bloque'],$obtest);



		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "OFERTA EDUCATIVA";
		$nivel['porcentaje'] = 25;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "PROGRAMAS ACADEMICOS";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Programas Académicos Evaluados";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Porcentaje de   programas académicos con evaluación favorable en los últimos 4 años ";
		$tercer['metodo']       = "(Número de programas académicos evaluados/Total de programas académicos de la Unidad Académica) *100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de programas académicos evaluados";
		$tercer['var2'] = "Total de programas académicos de la unidad académica";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->BProgramasAcademicos;
$tercer['val2'] = $tercer['val2']+$row->BProgramasAcademicosT;

			$objPuente['var1'] = $row->BProgramasAcademicos;
			$objPuente['var2'] = $row->BProgramasAcademicosT;
			$objPuente['calculo'] = 0;
			if($row->BProgramasAcademicosT>0){
				$objPuente['calculo'] = ((($row->BProgramasAcademicos)/($row->BProgramasAcademicosT))*100);
				$pre       = ($pre+((($row->BProgramasAcademicos)/($row->BProgramasAcademicosT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	49.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	50	; $objeto[1][1]=	59.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	60	; $objeto[2][1]=	79.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	80	; $objeto[3][1]=	89.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	90	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "OFERTA EDUCATIVA";
		$nivel['porcentaje'] = 25;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "INFRAESTRUCTURA";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Capacidad de atención alumnos en relación a talleres y laboratorios";
		$tercer['porcentaje']   = 35;
		$tercer['descripcion']  = "Capacidad de atención a alumnos por talleres y laboratorios por unidad académica y semestre
Suma de Capacidad instalada de atención en laboratorios y talleres por el total de semestres, identificando la capacidad del taller o laboratotio con menor capacidad de cada semestre
 30¨%";
		$tercer['metodo']       = "(Total de alumnos inscritos por Unidad Académica/(Capacidad instalada))*100 ";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Total de alumnos inscritos por unidad académica";
		$tercer['var2'] = "Capacidad instalada";

		// EL INDICADOR NO APLICA

		$bloque = $this->infraestructura->getInfraMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->AlumnosInscritos;
$tercer['val2'] = $tercer['val2']+$row->CapacidadInstalada;

			$objPuente['var1'] = $row->AlumnosInscritos;
			$objPuente['var2'] = $row->CapacidadInstalada;
			$objPuente['calculo'] = 0;
			if($row->CapacidadInstalada>0){
				$objPuente['calculo'] = ((($row->AlumnosInscritos)/($row->CapacidadInstalada))*100);
				$pre       = ($pre+((($row->AlumnosInscritos)/($row->CapacidadInstalada))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	74.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Muy Malo	";
		$objeto[1][0]=	75	; $objeto[1][1]=	94.99	; $objeto[1][2]=	3	; $objeto[1][3] = "	Regular	";
		$objeto[2][0]=	95	; $objeto[2][1]=	105	; $objeto[2][2]=	5	; $objeto[2][3] = "	Muy Bueno	";
		$objeto[3][0]=	105.01	; $objeto[3][1]=	120	; $objeto[3][2]=	2	; $objeto[3][3] = "	Malo	";
		$objeto[4][0]=	120.01	; $objeto[4][1]=	200	; $objeto[4][2]=	1	; $objeto[4][3] = "	Muy Malo	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Aulas Equipadas";
		$tercer['porcentaje']   = 35;
		$tercer['descripcion']  = "Aulas equipadas conforme al modelo ideal por unidad académica (Cañon, Internet, CPU, Pantalla, Pizarron, Butacas, Escritorio) 35%";
		$tercer['metodo']       = "(Número de aulas equipadas por unidad académica/el total de aulas)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de aulas equipadas por unidad académica";
		$tercer['var2'] = "Total de aulas";

		// EL INDICADOR NO APLICA

		$bloque = $this->infraestructura->getInfraMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->AulasEquipadas;
$tercer['val2'] = $tercer['val2']+$row->TotalAulas;

			$objPuente['var1'] = $row->AulasEquipadas;
			$objPuente['var2'] = $row->TotalAulas;
			$objPuente['calculo'] = 0;
			if($row->TotalAulas>0){
				$objPuente['calculo'] = ((($row->AulasEquipadas)/($row->TotalAulas))*100);
				$pre       = ($pre+((($row->AulasEquipadas)/($row->TotalAulas))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	49.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	50	; $objeto[1][1]=	59.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	60	; $objeto[2][1]=	69.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	70	; $objeto[3][1]=	84.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	85	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Laboratorios Equipado";
		$tercer['porcentaje']   = 30;
		$tercer['descripcion']  = "Laboratorios equipados conforme currícula por programa académico por unidad académica y año 35%";
		$tercer['metodo']       = "(Número de laboratorios equipados conforme currícula por programa académico / total de laboratorios por programa académico)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de laboratorios equipados conforme currícula por programa académico";
		$tercer['var2'] = "Total de laboratorios por programa académico";

		// EL INDICADOR APLICA

		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->BLaboratoriosEquipados;
$tercer['val2'] = $tercer['val2']+$row->BLaboratoriosEquipadosT;

			$objPuente['var1'] = $row->BLaboratoriosEquipados;
			$objPuente['var2'] = $row->BLaboratoriosEquipadosT;
			$objPuente['calculo'] = 0;
			if($row->BLaboratoriosEquipadosT>0){
				$objPuente['calculo'] = ((($row->BLaboratoriosEquipados)/($row->BLaboratoriosEquipadosT))*100);
				$pre       = ($pre+((($row->BLaboratoriosEquipados)/($row->BLaboratoriosEquipadosT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	79.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	80	; $objeto[1][1]=	84.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	85	; $objeto[2][1]=	89.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	90	; $objeto[3][1]=	94.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	95	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

                $obtest = array();
                $obtest['nombre'] = 'OFERTA EDUCATIVA';
                $obtest['suma'] = $calculo[2]['segundobloque']['calculoDimension']+$calculo[3]['segundobloque']['calculoDimension'];
                $obtest['total'] = ($calculo[2]['segundobloque']['calculoDimension']+$calculo[3]['segundobloque']['calculoDimension'])*(0.25);
                array_push($resumenBloques['bloque'],$obtest);

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "APOYO";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "BECAS";
		$nivel['segundobloque']['porcentaje'] = 33;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Becas";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Porcentaje de alumnos que cuentan con algun tipo de beca registrada en el SIBA por año por unidad académca";
		$tercer['metodo']       = "(Número de alumnos que cuentan con beca registrada en el SIBA por año por unidad académica/matrícula total por unidad académica)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos que cuentan con beca registrada en el SIBA por año por unidad académica";
		$tercer['var2'] = "Matrícula total por unidad académica";

		// EL INDICADOR NO APLICA

		$bloque = $this->becas->getBecasMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->AlumnosBeca;
$tercer['val2'] = $tercer['val2']+$row->TotalAlumnos;

			$objPuente['var1'] = $row->AlumnosBeca;
			$objPuente['var2'] = $row->TotalAlumnos;
			$objPuente['calculo'] = 0;
			if($row->TotalAlumnos>0){
				$objPuente['calculo'] = ((($row->AlumnosBeca)/($row->TotalAlumnos))*100);
				$pre       = ($pre+((($row->AlumnosBeca)/($row->TotalAlumnos))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	19	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	20	; $objeto[1][1]=	29	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	30	; $objeto[2][1]=	39	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	40	; $objeto[3][1]=	49	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	50	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "APOYO";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "TUTORIAS";
		$nivel['segundobloque']['porcentaje'] = 33;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos Tutorados";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Porcentaje de alumnos tutorados por periodo semestral y  programa académico";
		$tercer['metodo']       = "(Número de alumnos tutorados por periodo semestral / matrícula total)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos tutorados por periodo semestre";
		$tercer['var2'] = "Matrícula total";

		// EL INDICADOR APLICA

		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->BAlumnosTutorados;
$tercer['val2'] = $tercer['val2']+$row->BAlumnosTutoradosT;

			$objPuente['var1'] = $row->BAlumnosTutorados;
			$objPuente['var2'] = $row->BAlumnosTutoradosT;
			$objPuente['calculo'] = 0;
			if($row->BAlumnosTutoradosT>0){
				$objPuente['calculo'] = ((($row->BAlumnosTutorados)/($row->BAlumnosTutoradosT))*100);
				$pre       = ($pre+((($row->BAlumnosTutorados)/($row->BAlumnosTutoradosT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	19	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	20	; $objeto[1][1]=	29	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	30	; $objeto[2][1]=	39	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	40	; $objeto[3][1]=	49	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	50	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "APOYO";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "SERVICIO DE APOYO EDUCATIVO";
		$nivel['segundobloque']['porcentaje'] = 34;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Títulos Actualizados 50%";
		$tercer['porcentaje']   = 50;
		$tercer['descripcion']  = "Porcentaje de títulos impresos y/o digitales que han sido editados en un tiempo no mayor a 5 años a la fecha 50%";
		$tercer['metodo']       = "(Número de títulos actualizados impresos o digitales por semestre / Total del acervo bibliográfico por semestre)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de títulos actualizados impresos o digitales por semestre";
		$tercer['var2'] = "Total del acervo bibliográfico por semestre";

		// EL INDICADOR APLICA

		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BlibrosTitulosEditados;
			$tercer['val2'] = $tercer['val2']+$row->BlibrosTitulosEditadosT;

			$objPuente['var1'] = $row->BlibrosTitulosEditados;
			$objPuente['var2'] = $row->BlibrosTitulosEditadosT;
			$objPuente['calculo'] = 0;
			if($row->BlibrosTitulosEditadosT>0){
				$objPuente['calculo'] = ((($row->BlibrosTitulosEditados)/($row->BlibrosTitulosEditadosT))*100);
				$pre       = ($pre+((($row->BlibrosTitulosEditados)/($row->BlibrosTitulosEditadosT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	19	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	20	; $objeto[1][1]=	29	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	30	; $objeto[2][1]=	39	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	40	; $objeto[3][1]=	49	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	50	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Número de libros por alumno 50%";
		$tercer['porcentaje']   = 50;
		$tercer['descripcion']  = "Total de ejemplares por programa académico 50%";
		$tercer['metodo']       = "(Número de ejemplares disponibles en sala por semestre/ total de matricula por semestre)";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de ejemplares disponibles en sala por semestre";
		$tercer['var2'] = "Total de matricula por semestre";

		// EL INDICADOR APLICA

		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BTotalEjemplares;
			$tercer['val2'] = $tercer['val2']+$row->BTotalEjemplaresT;

			$objPuente['var1'] = $row->BTotalEjemplares;
			$objPuente['var2'] = $row->BTotalEjemplaresT;
			$objPuente['calculo'] = 0;
			if($row->BTotalEjemplaresT>0){
				$objPuente['calculo'] = ((($row->BTotalEjemplares)/($row->BTotalEjemplaresT)))*100;
				$pre       = ($pre+((($row->BTotalEjemplares)/($row->BTotalEjemplaresT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	1.9	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	2	; $objeto[1][1]=	3.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	4	; $objeto[2][1]=	7.9	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	8	; $objeto[3][1]=	11.9	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	12	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Cobertura de Acceso a Internet";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Capacidad instalada de acceso a internet en la unidad académica";
		$tercer['metodo']       = "(Capacidad instalada de acceso a internet / número de usuarios del turno con mayor número de personas de la unidad académica)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Capacidad instalada de acceso a internet";
		$tercer['var2'] = "Número de usuarios del turno con mayor número de personas de la unidad académica";

		// EL INDICADOR APLICA

		$bloque = $this->apoyoserv->getApoyoMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->CapacidadInternet;
$tercer['val2'] = $tercer['val2']+$row->UsuariosInternet;

			$objPuente['var1'] = $row->CapacidadInternet;
			$objPuente['var2'] = $row->UsuariosInternet;
			$objPuente['calculo'] = 0;
			if($row->UsuariosInternet>0){
				$objPuente['calculo'] = ((($row->CapacidadInternet)/($row->UsuariosInternet))*100);
				$pre       = ($pre+((($row->CapacidadInternet)/($row->UsuariosInternet))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	54	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	55	; $objeto[1][1]=	64	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	65	; $objeto[2][1]=	74	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	75	; $objeto[3][1]=	84	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	85	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "CUMPLIMIENTO DEL PROGRAMA DE MANTENIMIENTO 50%";
		$tercer['porcentaje']   = 50;
		$tercer['descripcion']  = "Porcentaje de cumpliemito del programa de mantenimiento 50%";
		$tercer['metodo']       = "(Número de servicios atendidos / Total servicios solicitados o programados por semestre)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de servicios atendidos";
		$tercer['var2'] = "Total servicios solicitados o programados por semestre";

		// EL INDICADOR APLICA

		$bloque = $this->apoyoserv->getApoyoMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->MantenimientoAtendido;
$tercer['val2'] = $tercer['val2']+$row->MantenimientoSolicitado;

			$objPuente['var1'] = $row->MantenimientoAtendido;
			$objPuente['var2'] = $row->MantenimientoSolicitado;
			$objPuente['calculo'] = 0;
			if($row->MantenimientoSolicitado>0){
				$objPuente['calculo'] = ((($row->MantenimientoAtendido)/($row->MantenimientoSolicitado))*100);
				$pre       = ($pre+((($row->MantenimientoAtendido)/($row->MantenimientoSolicitado))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	59.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	60	; $objeto[1][1]=	69.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	70	; $objeto[2][1]=	79.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	80	; $objeto[3][1]=	89.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	90	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "CUMPLIMIENTO DEL PROGRAMA DE LIMPIEZA 50%";
		$tercer['porcentaje']   = 50;
		$tercer['descripcion']  = "Porcentaje de cumpliemito del programa de limpieza 50%";
		$tercer['metodo']       = "(Número de servicios atendidos / Total servicios programados por semestre)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de servicios atendidos ";
		$tercer['var2'] = "Total servicios programados por semestre";

		// EL INDICADOR APLICA

		$bloque = $this->apoyoserv->getApoyoMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->LimpiezaAtendida;
$tercer['val2'] = $tercer['val2']+$row->LimpiezaProgramada;

			$objPuente['var1'] = $row->LimpiezaAtendida;
			$objPuente['var2'] = $row->LimpiezaProgramada;
			$objPuente['calculo'] = 0;
			if($row->LimpiezaProgramada>0){
				$objPuente['calculo'] = ((($row->LimpiezaAtendida)/($row->LimpiezaProgramada))*100);
				$pre       = ($pre+((($row->LimpiezaAtendida)/($row->LimpiezaProgramada))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	1.9	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	2	; $objeto[1][1]=	3.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	4	; $objeto[2][1]=	7.9	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	8	; $objeto[3][1]=	11.9	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	12	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

                $obtest = array();
                $obtest['nombre'] = 'APOYO';
                $obtest['suma'] = $calculo[4]['segundobloque']['calculoDimension']+$calculo[5]['segundobloque']['calculoDimension']+$calculo[6]['segundobloque']['calculoDimension'];
                $obtest['total'] = ($calculo[4]['segundobloque']['calculoDimension']+$calculo[5]['segundobloque']['calculoDimension']+$calculo[6]['segundobloque']['calculoDimension'])*(0.15);
                array_push($resumenBloques['bloque'],$obtest);

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "VINCULACION";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "SERVICIO SOCIAL";
		$nivel['segundobloque']['porcentaje'] = 30;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos Inscritos Participando en Servicio Social";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Número de alumnos inscritos en alguno de los programas de servicio social por unidad académica ";
		$tercer['metodo']       = "(Número de alumnos inscritos realizando servicio social por unidad académica por año  / Número de alumnos inscritos realizando servicio social por unidad académica en el año inmediato anterior) -1)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos inscritos realizando servicio social por unidad académica por año";
		$tercer['var2'] = "Número de alumnos inscritos realizando servicio social por unidad académica en el año inmediato anterior";

		// EL INDICADOR APLICA

		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BAlumnosServicioSocial;
			$tercer['val2'] = $tercer['val2']+$row->BAlumnosServicioSocialT;

			$objPuente['var1'] = $row->BAlumnosServicioSocial;
			$objPuente['var2'] = $row->BAlumnosServicioSocialT;
			$objPuente['calculo'] = 0;
			if($row->BAlumnosServicioSocialT>0){
				$objPuente['calculo'] = ((($row->BAlumnosServicioSocial)/($row->BAlumnosServicioSocialT)-1)*100);
				$pre       = ($pre+((($row->BAlumnosServicioSocial)/($row->BAlumnosServicioSocialT)-1)*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = (($tercer['val1']/$tercer['val2'])-1)*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	-100	; $objeto[0][1]=	-0.1	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	0.1	; $objeto[1][1]=	0.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	1	; $objeto[2][1]=	4.9	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	5	; $objeto[3][1]=	14.9	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	15	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

                // SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "VINCULACION";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "VISITAS ESCOLARES";
		$nivel['segundobloque']['porcentaje'] = 35;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Porcentaje de Alumnos en Visitas Escolares";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Número de alumnos  realizando visitas escolares por unidad académica por semestre";
		$tercer['metodo']       = "(Número de alumnos realizando visitas escolares por unidad académica por semestre  / .total de la matrícula)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos realizando visitas escolares por unidad académica por semestre";
		$tercer['var2'] = "Total de la matrícula";

		// EL INDICADOR APLICA

		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BALumnosVisitas;
			$tercer['val2'] = $tercer['val2']+$row->BALumnosVisitasT;

			$objPuente['var1'] = $row->BALumnosVisitas;
			$objPuente['var2'] = $row->BALumnosVisitasT;
			$objPuente['calculo'] = 0;
			if($row->BALumnosVisitasT>0){
				$objPuente['calculo'] = ((($row->BALumnosVisitas)/($row->BALumnosVisitasT))*100);
				$pre       = ($pre+((($row->BALumnosVisitas)/($row->BALumnosVisitasT))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	9.9	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	10	; $objeto[1][1]=	19.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	20	; $objeto[2][1]=	29.9	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	30	; $objeto[3][1]=	39.9	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	40	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//
                // SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "VINCULACION";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "PROYECTOS VINCULADOS";
		$nivel['segundobloque']['porcentaje'] = 35;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Proyectos Vinculados";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Número de proyectos vinculados por unidad académica";
		$tercer['metodo']       = "(Número de proyectos vinculados por unidad académica por año  / Número de proyectos vinculados por unidad académica en el año inmediato anterior)-1)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de proyectos vinculados por unidad académica por año";
		$tercer['var2'] = "Número de proyectos vinculados por unidad académica en el año inmediato anterior";

		// EL INDICADOR NO APLICA

		$bloque = $this->modelvinculacion->getVinculadosMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->ProyectosVinculadosAct;
			$tercer['val2'] = $tercer['val2']+$row->ProyectosVinculadosAnt;
			$objPuente['var1'] = $row->ProyectosVinculadosAct;
			$objPuente['var2'] = $row->ProyectosVinculadosAnt;
			$objPuente['calculo'] = 0;
			if($row->ProyectosVinculadosAnt>0){
				$objPuente['calculo'] = ((($row->ProyectosVinculadosAct)/($row->ProyectosVinculadosAnt)-1)*100);
				$pre       = ($pre+((($row->ProyectosVinculadosAct)/($row->ProyectosVinculadosAnt)-1)*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = (($tercer['val1']/$tercer['val2'])-1)*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	-100	; $objeto[0][1]=	-0.1	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	0.1	; $objeto[1][1]=	0.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	1	; $objeto[2][1]=	100	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	100.1	; $objeto[3][1]=	200	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	200.1	; $objeto[4][1]=	1000	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//
                $obtest = array();
                $obtest['nombre'] = 'VINCULACIÓN';
                $obtest['suma'] = $calculo[7]['segundobloque']['calculoDimension']+$calculo[8]['segundobloque']['calculoDimension']+$calculo[9]['segundobloque']['calculoDimension'];
                $obtest['total'] = ($calculo[7]['segundobloque']['calculoDimension']+$calculo[8]['segundobloque']['calculoDimension']+$calculo[9]['segundobloque']['calculoDimension'])*(0.15);
                array_push($resumenBloques['bloque'],$obtest);


		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "INVESTIGACION";
		$nivel['porcentaje'] = 10;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "APOYO DE LA INVESTIGACION A LA DOCENCIA";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Profesores de carrera realizando investigación";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Profesores contratados con dictamén de carrera (1/2, 3/4 y T.Completo) que participan en Proyectos de Investigación avalados por la SIP";
		$tercer['metodo']       = "(Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP/Total de Profesoress de carrera de la Unidad Académica)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP";
		$tercer['var2'] = "Total de Profesores de carrera de la unidad académica";

		// EL INDICADOR NO APLICA

		$bloque = $this->investigacionmodel->getInnovacionMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->DocentesInvestigacion;
$tercer['val2'] = $tercer['val2']+$row->TotalDocentes;

			$objPuente['var1'] = $row->DocentesInvestigacion;
			$objPuente['var2'] = $row->TotalDocentes;
			$objPuente['calculo'] = 0;
			if($row->TotalDocentes>0){
				$objPuente['calculo'] = ((($row->DocentesInvestigacion)/($row->TotalDocentes))*100);
				$pre       = ($pre+((($row->DocentesInvestigacion)/($row->TotalDocentes))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	4.9	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	5	; $objeto[1][1]=	9.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	10	; $objeto[2][1]=	19.9	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	20	; $objeto[3][1]=	29.9	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	30	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

                // SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "INVESTIGACION";
		$nivel['porcentaje'] = 10;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "PARTICIPACIÓN DE LOS ALUMNOS EN INVESTIGACIONES";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Profesores que presentan trabajos en eventos de investigación con la participación de alumnos";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Profesores que presentan trabajos en congresos, coloquios, siposiums, entre otros con la participación de alumnos como coautores";
		$tercer['metodo']       = "(Número de profesores que presentan trabajos en congresos, coloquios, siposiums, entre otros con la participación de alumnos como coautores / total de profesores que tienen proyectos registrados en la SIP)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de profesores que presentan trabajos en congresos, coloquios, siposiums, entre otros con la participación de alumnos como coautores";
		$tercer['var2'] = "Total de profesores que tienen proyectos registrados en la SIP";

		// EL INDICADOR NO APLICA

		$bloque = $this->investigacionmodel->getAlumnosInvesMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->AlumnosCoautores;
$tercer['val2'] = $tercer['val2']+$row->ProfesoresConProyectos;
			$objPuente['var1'] = $row->AlumnosCoautores;
			$objPuente['var2'] = $row->ProfesoresConProyectos;
			$objPuente['calculo'] = 0;
			if($row->ProfesoresConProyectos>0){
				$objPuente['calculo'] = ((($row->AlumnosCoautores)/($row->ProfesoresConProyectos))*100);
				$pre       = ($pre+((($row->AlumnosCoautores)/($row->ProfesoresConProyectos))*100));
			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	59.9	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	60	; $objeto[1][1]=	69.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	70	; $objeto[2][1]=	79.9	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	80	; $objeto[3][1]=	89.9	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	90	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

                $obtest = array();
                $obtest['nombre'] = 'INVESTIGACIÓN';
                $obtest['suma'] = $calculo[10]['segundobloque']['calculoDimension']+$calculo[11]['segundobloque']['calculoDimension'];
                $obtest['total'] = ($calculo[10]['segundobloque']['calculoDimension']+$calculo[11]['segundobloque']['calculoDimension'])*(0.10);
                array_push($resumenBloques['bloque'],$obtest);

		//PRIMER NIVEL
		//ELEMNTO POR NIVEL
		$nivel               = array();
		$nivel['nombre']     = "GESTION ADMINISTRATIVA";
		$nivel['porcentaje'] = 10;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - ALUMNOS
		$nivel['segundobloque']['nombre']     = "RECURSOS AUTOGENERADOS";
		$nivel['segundobloque']['porcentaje'] = 100;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$bloque                = $this->evaluacion->getEvaluacionesMed($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "% de  Recursos autogenerados dedicados al  mantenimiento del inmueble y mantenimiento del equipo ";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Monto de los recursos netos autogenerados que se destinan al pago de Servicios de mantenimiento del inmueble y mantenimiento del equipo";
		$tercer['metodo']       = "(Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo / total de los recursos autogenerados anualmente)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo";
		$tercer['var2'] = "Total de los recursos autogenerados anualmente";

		// EL INDICADOR NO APLICA

		$bloque = $this->recursos->getRecursosMed($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
$tercer['val1'] = $tercer['val1']+$row->RecursosEjercidos;
$tercer['val2'] = $tercer['val2']+$row->RecursosAutogenerados;
			$objPuente['var1'] = $row->RecursosEjercidos;
			$objPuente['var2'] = $row->RecursosAutogenerados;
			$objPuente['calculo'] = 0;
			if($row->RecursosAutogenerados>0){
				$objPuente['calculo'] = ((($row->RecursosEjercidos)/($row->RecursosAutogenerados))*100);
				$pre       = ($pre+((($row->RecursosEjercidos)/($row->RecursosAutogenerados))*100));

			}
			array_push($objCalculosIngresados, $objPuente);
		}
		if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;} $tercer['variables'] = $objCalculosIngresados;

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.1	; $objeto[0][1]=	39.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	40	; $objeto[1][1]=	49.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	60	; $objeto[2][1]=	79.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	80	; $objeto[3][1]=	89.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	90	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

        $tercer['limites'] = $objeto;

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		$obtest = array();
                $obtest['nombre'] = 'GESTION ADMINISTRATIVA';
                $obtest['suma'] = $calculo[12]['segundobloque']['calculoDimension'];
                $obtest['total'] = ($calculo[12]['segundobloque']['calculoDimension'])*(0.10);
                array_push($resumenBloques['bloque'],$obtest);

		//AL FINAL SE IMPRIME

								$data['calculo'] = $calculo;
                $data['resumen'] = $resumenBloques;
								$escolar = array();
								$escolar['unidad'] = $this->unidades->getUnidad($idUnidad);
								$escolar['carreras'] = $carreras;
                $data['unidad']       = $escolar;

                $resultaSuma = 0;
                foreach ($resumenBloques as $row) {
                        # code...
                        // print_r($row[0]['total']);
                        $resultaSuma = $resultaSuma+ $row[0]['total'];
                }

                switch ($resultaSuma) {
                    case ($resultaSuma>= 0 ||  $resultaSuma < 50):
                        $data['resTexto'] = 'DEFICIENTE';
                        $data['resComentario'] = 'Se identifican areas de atención urgente';
                        break;
                    case ($resultaSuma>= 50 ||  $resultaSuma < 75):
                        $data['resTexto'] = 'REGULAR';
                        $data['resComentario'] = 'Se necesitan mejorar controles';
                        break;
                    case ($resultaSuma>= 75 ||  $resultaSuma < 85):
                        $data['resTexto'] = 'BUENO';
                        $data['resComentario'] = 'Se sugiere implemetar acciones de mejora continua';
                        break;
                    case ($resultaSuma>= 85 ||  $resultaSuma < 95):
                        $data['resTexto'] = 'MUY BUENO';
                        $data['resComentario'] = 'Tomar medidas que permitan consolidar el aspecto';
                        break;
                    case ($resultaSuma>= 95 ||  $resultaSuma <= 100):
                        $data['resTexto'] = 'EXCELENTE';
                        $data['resComentario'] = 'Felicidades - compartir buenas practicas';
                        break;
                    default:
                        $data['resTexto'] = 'SIN CLASIFICACIÓN';
                        $data['resComentario'] = '';
                        break;
                }

								if($genTipo=="consulta"){
									$data['main_cont'] = 'consultams/resultados';
									$this->load->view('includes/template_consultams2', $data);
								}

								if($genTipo=="previos"){
									$data['main_cont'] = 'consultams/previos';
									$this->load->view('includes/template_consultams2', $data);
								}


								if($genTipo=="reportedetallado"){
									$data['main_cont'] = 'reportes/ms/detallado';
									$html=$this->load->view('includes/template_reportes2', $data, true);
									$pdfFilePath = "detallado.pdf";
									$this->load->library('m_pdf');
									// $this->m_pdf->pdf->AddPage('L','', '', '', '',5);
									$this->m_pdf->pdf->WriteHTML($html);
									$this->m_pdf->pdf->Output($pdfFilePath, "D");
								}

								if($genTipo=="reporteconsolidado"){
									$data['main_cont'] = 'reportes/ms/consolidados';
									$html=$this->load->view('includes/template_reportes', $data, true);
									$pdfFilePath = "consolidados.pdf";
									$this->load->library('m_pdf');
									$this->m_pdf->pdf->WriteHTML($html);
									$this->m_pdf->pdf->Output($pdfFilePath, "D");
								}

								if($genTipo=="reportefunciones"){
									$data['main_cont'] = 'reportes/ms/funciones';
									$html=$this->load->view('includes/template_reportes', $data, true);
									$pdfFilePath = "funciones.pdf";
									$this->load->library('m_pdf');
									$this->m_pdf->pdf->WriteHTML($html);
									$this->m_pdf->pdf->Output($pdfFilePath, "D");
								}

                                if($genTipo=="data"){
                                    //load our new PHPExcel library
                                    // name the worksheet
                                    // print_r($data['calculo']);
                                    print_r($data['resumen']['bloque']);
                                    // foreach ($data['calculo'] as $key => $value) {
                                    //     // echo $value['nombre']." ".$value['porcentaje']." ".$value['segundobloque']['nombre']." ".$value['segundobloque']['porcentaje'];
                                    //
                                    //
                                    //
                                    //     foreach ($value['tercerbloque'] as $key => $value2) {
                                    //         echo $value['nombre']." -- ".$value['segundobloque']['nombre']." --  ".$value2['nombre'];
                                    //         echo "<br>";
                                    //         print_r($value2['calculo']);
                                    //         echo "<br>";
                                    //         print_r($value2['calificacion']);
                                    //         echo "<br>";
                                    //         print_r($value2['calculoIndicador']);
                                    //         echo "<br>";
                                    //         print_r($value2['resultado']);
                                    //         echo "<br>";
									// 		foreach ($value2['limites'] as $key => $value3) {
									// 			// echo $value3[0]." -- ".$value3[1]." -- ".$value3[2]."  -- "$value3[3];
									// 			// print_r($value3);
									// 			foreach ($value3 as $key => $value4) {
									// 				echo $value4."  ";
									// 			}
									// 			echo "<br>";
									// 		}
									// 		echo "<br>";
									// 		echo '<hr>';
                                    //     }
                                    //     // print_r($value['segundobloque']);
                                    //     echo "<br>";
                                    // }
                                }

                                if($genTipo=="excel"){
                                    //load our new PHPExcel library
                                    $this->load->library('excel');
                                    // name the worksheet
                                    // print_r($data['calculo']);

                                    $this->excel->getProperties()->setCreator("");
                                    $this->excel->getProperties()->setLastModifiedBy("");
                                    $this->excel->getProperties()->setTitle("");
                                    $this->excel->getProperties()->setSubject("");
                                    $this->excel->getProperties()->setDescription("");
                                    $this->excel->getActiveSheet()->setTitle($escolar['unidad'][0]->Siglas);
                                    // //activate worksheet number 1
                                    $this->excel->setActiveSheetIndex(0);
                                    // //set cell A1 content with some text
                                    $this->excel->getActiveSheet()->SetCellValue('A1', 'FUNCIÓN');
                                    $this->excel->getActiveSheet()->SetCellValue('B1', 'DIMENSIÓN');
                                    $this->excel->getActiveSheet()->SetCellValue('C1', 'CÁLCULO DE DIMENSIÓN %');
                                    $this->excel->getActiveSheet()->SetCellValue('D1', 'ELEMENTOS');
                                    $this->excel->getActiveSheet()->SetCellValue('E1', 'CÁLCULO ELEMENTO %');
                                    $this->excel->getActiveSheet()->SetCellValue('F1', 'INDICADORES');
                                    $this->excel->getActiveSheet()->SetCellValue('G1', 'DESCRIPCIÓN DEL INDICADOR');
                                    $this->excel->getActiveSheet()->SetCellValue('H1', 'MÉTODO DE CÁLCULO');
                                    $this->excel->getActiveSheet()->SetCellValue('I1', 'VARIABLE 1');
                                    $this->excel->getActiveSheet()->SetCellValue('J1', 'VARIABLE 2');
                                    $this->excel->getActiveSheet()->SetCellValue('K1', 'V1');
                                    $this->excel->getActiveSheet()->SetCellValue('L1', 'V2');
                                    $this->excel->getActiveSheet()->SetCellValue('M1', 'CÁLCULO DE INDICADOR');
                                    $this->excel->getActiveSheet()->SetCellValue('N1', 'VALOR');
                                    $this->excel->getActiveSheet()->SetCellValue('O1', 'CALIFICACIÓN');
                                    $this->excel->getActiveSheet()->SetCellValue('P1', 'LIMITES');
                                    $this->excel->getActiveSheet()->mergeCells('P1:S1');

                                    $this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(60);
                                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
                                    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
                                    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
                                    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
                                    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
                                    $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
                                    $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
                                    $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
                                    $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);

                                    $this->excel->getActiveSheet()->getStyle('A1:S1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '792a55'))));
                                    $style = array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                    $this->excel->getActiveSheet()->getStyle('A1:S1')->applyFromArray($style);


                                    $this->excel->getActiveSheet()->getStyle('A1:S999')->getAlignment()->setWrapText(true);


                                    $this->excel->getActiveSheet()->getStyle('A1:S999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                                    $this->excel->getActiveSheet()->getStyle('A1:S999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $this->excel->getActiveSheet()->getStyle('A1:S1')->getFont()->setSize(14);
                                    $this->excel->getActiveSheet()->getStyle('A1:S1')->getFont()->setBold(true);

                                    $rowex = 2;
                                    $rowex2 = 2;//mantiene el estatus de en que rengln va cada bloque
                                    $rowex3 = 2;//mantiene el estatus de en que rengln va cada bloque

                                    $contadorseg = 0;
                                    $sumaseccion = 0;

                                    foreach ($data['calculo'] as $key => $value) {
                                        // print_r($value['nombre']);
                                        $contadorseg = $contadorseg+1;
                                        $contadorExc = 0;
                                        $contadorExc = count($value['tercerbloque']);

                                        $sumacalculo =0;


                                        $mergeall1 = $rowex;
                                        $mergeallFin1 = 0;

                                        $mergeall = 0;
                                        $mergeallFin = 0;

                                        foreach ($value['tercerbloque'] as $key => $value2) {
                                            $mergeall = $rowex;
                                            $this->excel->getActiveSheet()->SetCellValue('A'.$rowex, $value['nombre']." ".$value['porcentaje']."%");
                                            $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, $value['segundobloque']['nombre']." ".$value['segundobloque']['porcentaje']."%");
                                            $this->excel->getActiveSheet()->SetCellValue('C'.$rowex, $value['segundobloque']['calculoDimension']."%");
                                            $this->excel->getActiveSheet()->SetCellValue('F'.$rowex, $value2['nombre']);
                                            $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, $value2['nombre']." ".$value2['porcentaje']."%");
                                            $this->excel->getActiveSheet()->SetCellValue('G'.$rowex, $value2['descripcion']);
                                            $this->excel->getActiveSheet()->SetCellValue('H'.$rowex, $value2['metodo']);
                                            $this->excel->getActiveSheet()->SetCellValue('I'.$rowex, $value2['var1']);
                                            $this->excel->getActiveSheet()->SetCellValue('J'.$rowex, $value2['var2']);
                                            $this->excel->getActiveSheet()->SetCellValue('K'.$rowex, $value2['val1']);
                                            $this->excel->getActiveSheet()->SetCellValue('L'.$rowex, $value2['val2']);
                                            $this->excel->getActiveSheet()->SetCellValue('M'.$rowex, $value2['calculoIndicador']."%");
                                            $this->excel->getActiveSheet()->SetCellValue('E'.$rowex, $value2['calculoIndicador']."%");
                                            $this->excel->getActiveSheet()->SetCellValue('N'.$rowex, $value2['calculo']);
                                            $this->excel->getActiveSheet()->SetCellValue('O'.$rowex, $value2['calificacion']);
                                            $sumacalculo= $sumacalculo+$value2['calculoIndicador'];

                                            foreach ($value2['limites'] as $key => $value3) {
												// echo $value3[0]." -- ".$value3[1]." -- ".$value3[2]."  -- "$value3[3];
												// print_r($value3);
                                                $limitevar = 1;
												foreach ($value3 as $key => $value4) {
                                                    if ($limitevar==1) {
                                                        $this->excel->getActiveSheet()->SetCellValue('P'.$rowex, $value4);
                                                    }
                                                    if ($limitevar==2) {
                                                        $this->excel->getActiveSheet()->SetCellValue('Q'.$rowex, $value4);
                                                    }
                                                    if ($limitevar==3) {
                                                        $this->excel->getActiveSheet()->SetCellValue('R'.$rowex, $value4);
                                                    }
                                                    if ($limitevar==4) {
                                                        $this->excel->getActiveSheet()->SetCellValue('S'.$rowex, $value4);
                                                        if ($value2['resultado']==$value4) {
                                                            $this->excel->getActiveSheet()->getStyle('P'.$rowex.':'.'S'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '792a55'))));
                                                            $style = array('font' => array('bold' => true,'color' => array('rgb' => 'ffffff')));
                                                            $this->excel->getActiveSheet()->getStyle('P'.$rowex.':'.'S'.$rowex)->applyFromArray($style);
                                                        }
                                                    }
                                                    $mergeallFin = $rowex;

                                                    $limitevar=$limitevar+1;

												}
                                                $rowex=$rowex+1;
											}
                                            // echo $value2['nombre'];
                                            // echo "<br>";
                                            $this->excel->getActiveSheet()->mergeCells('D'.$mergeall.':D'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('E'.$mergeall.':E'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('F'.$mergeall.':F'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('G'.$mergeall.':G'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('H'.$mergeall.':H'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('I'.$mergeall.':I'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('J'.$mergeall.':J'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('K'.$mergeall.':K'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('L'.$mergeall.':L'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('M'.$mergeall.':M'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('N'.$mergeall.':N'.$mergeallFin);
                                            $this->excel->getActiveSheet()->mergeCells('O'.$mergeall.':O'.$mergeallFin);

                                            // $rowex=$rowex+1;//nuevo renglon
                                        }



                                        $r = $contadorExc+$rowex2-1;

                                        // $this->excel->getActiveSheet()->mergeCells('B'.$rowex2.':B'.$r);

                                        $mergeallFin1 = $rowex-1;


                                        $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "TOTAL ".$value['segundobloque']['nombre']);
                                        $this->excel->getActiveSheet()->mergeCells('B'.$mergeall1.':B'.$mergeallFin1);
                                        $this->excel->getActiveSheet()->mergeCells('C'.$mergeall1.':C'.$mergeallFin1);
                                        $style = array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => '000000')));
                                        $style2 = array('font' => array('size' => 14,'bold' => true,'color' => array('rgb' => '000000')));
                                        $this->excel->getActiveSheet()->getStyle('B'.$mergeall1.':'.'B'.$mergeallFin1)->applyFromArray($style2);
                                        $this->excel->getActiveSheet()->getStyle('C'.$mergeall1.':'.'C'.$mergeallFin1)->applyFromArray($style);

                                        $sumaseccion = $sumaseccion+$value['segundobloque']['calculoDimension'];


                                        $this->excel->getActiveSheet()->SetCellValue('E'.$rowex, $sumacalculo."%");
                                        $this->excel->getActiveSheet()->mergeCells('B'.$rowex.':D'.$rowex);
                                        $style = array('font' => array('size' => 17,'bold' => true,'color' => array('rgb' => '000000')));
                                        $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray($style);
                                        $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(30);
                                        $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'dedede'))));




                                        $rowex2 = $rowex2+$contadorExc+1;

                                        $rowex=$rowex+1;//nuevo renglon

                                        //ESto varia de superior a medio superior RENGLON DE TotalES

                                        if ($contadorseg==2) {
                                            $this->excel->getActiveSheet()->SetCellValue('A'.$rowex, "TOTAL DESEMPEÑO");
                                            $this->excel->getActiveSheet()->SetCellValue('E'.$rowex, $sumaseccion."%");
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex.':D'.$rowex);
                                            $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '393939'))));
                                            $style = array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray($style);
                                            $finbloque = $rowex-1;
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex3.':A'.$finbloque);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->getAlignment()->setTextRotation(90);
                                            $style = array('font' => array('size' => 22,'bold' => true));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->applyFromArray($style);
                                            $rowex=$rowex+1;
                                            $rowex2=$rowex2+1;
                                            $rowex3=$finbloque+2;
                                            $sumaseccion = 0;
                                        }
                                        if ($contadorseg==4) {
                                            $this->excel->getActiveSheet()->SetCellValue('A'.$rowex, "TOTAL OFERTA EDUCATIVA");
                                            $this->excel->getActiveSheet()->SetCellValue('E'.$rowex, $sumaseccion."%");
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex.':D'.$rowex);
                                            $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '393939'))));
                                            $style = array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray($style);
                                            $finbloque = $rowex-1;
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex3.':A'.$finbloque);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->getAlignment()->setTextRotation(90);
                                            $style = array('font' => array('size' => 22,'bold' => true));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->applyFromArray($style);
                                            $rowex=$rowex+1;
                                            $rowex2=$rowex2+1;
                                            $rowex3=$finbloque+2;
                                            $sumaseccion = 0;

                                        }
                                        if ($contadorseg==7) {
                                            $this->excel->getActiveSheet()->SetCellValue('A'.$rowex, "TOTAL APOYO");
                                            $this->excel->getActiveSheet()->SetCellValue('E'.$rowex, $sumaseccion."%");
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex.':D'.$rowex);
                                            $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '393939'))));
                                            $style = array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray($style);
                                            $finbloque = $rowex-1;
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex3.':A'.$finbloque);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->getAlignment()->setTextRotation(90);
                                            $style = array('font' => array('size' => 22,'bold' => true));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->applyFromArray($style);
                                            $rowex=$rowex+1;
                                            $rowex2=$rowex2+1;
                                            $rowex3=$finbloque+2;
                                            $sumaseccion = 0;

                                        }
                                        if ($contadorseg==10) {
                                            $this->excel->getActiveSheet()->SetCellValue('A'.$rowex, "TOTAL VINCULACIÓN");
                                            $this->excel->getActiveSheet()->SetCellValue('E'.$rowex, $sumaseccion."%");
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex.':D'.$rowex);
                                            $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '393939'))));
                                            $style = array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray($style);
                                            $finbloque = $rowex-1;
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex3.':A'.$finbloque);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->getAlignment()->setTextRotation(90);
                                            $style = array('font' => array('size' => 22,'bold' => true));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->applyFromArray($style);
                                            $rowex=$rowex+1;
                                            $rowex2=$rowex2+1;
                                            $rowex3=$finbloque+2;
                                            $sumaseccion = 0;

                                        }
                                        if ($contadorseg==12) {
                                            $this->excel->getActiveSheet()->SetCellValue('A'.$rowex, "TOTAL INVESTIGACIÓN");
                                            $this->excel->getActiveSheet()->SetCellValue('E'.$rowex, $sumaseccion."%");
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex.':D'.$rowex);
                                            $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '393939'))));
                                            $style = array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray($style);
                                            $finbloque = $rowex-1;
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex3.':A'.$finbloque);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->getAlignment()->setTextRotation(90);
                                            $style = array('font' => array('size' => 22,'bold' => true));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->applyFromArray($style);
                                            $rowex=$rowex+1;
                                            $rowex2=$rowex2+1;
                                            $rowex3=$finbloque+2;
                                            $sumaseccion = 0;

                                        }
                                        if ($contadorseg==13) {
                                            $this->excel->getActiveSheet()->SetCellValue('A'.$rowex, "TOTAL GESTIÓN ADMINISTRATIVA");
                                            $this->excel->getActiveSheet()->SetCellValue('E'.$rowex, $sumaseccion."%");
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex.':D'.$rowex);
                                            $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '393939'))));
                                            $style = array('font' => array('size' => 16,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex.':S'.$rowex)->applyFromArray($style);
                                            $finbloque = $rowex-1;
                                            $this->excel->getActiveSheet()->mergeCells('A'.$rowex3.':A'.$finbloque);
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->getAlignment()->setTextRotation(90);
                                            $style = array('font' => array('size' => 22,'bold' => true));
                                            $this->excel->getActiveSheet()->getStyle('A'.$rowex3)->applyFromArray($style);
                                            $rowex=$rowex+1;
                                            $rowex2=$rowex2+1;
                                            $rowex3=$finbloque+2;
                                            $sumaseccion = 0;

                                        }



                                    }


                                    //IMPRIME RESULTADO

                                    $rowex = $rowex+4;
                                    $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "FUNCIONES");
                                    $this->excel->getActiveSheet()->mergeCells('B'.$rowex.':C'.$rowex);
                                    $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, "TOTAL");
                                    $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '393939'))));
                                    $style = array('font' => array('size' => 19,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);
                                    $rowex = $rowex+1;
                                    $total = 0;
                                    $valrow = true;
                                    foreach ($data['resumen']['bloque'] as $row) {
                                            $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, $row['nombre']);
                                            $this->excel->getActiveSheet()->mergeCells('B'.$rowex.':C'.$rowex);
                                            $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, $row['total'].'%');
                                            $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(30);
                                            if($valrow==true){
                                                $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffffff'))));
                                                $valrow = false;
                                            }else{
                                                $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'dedede'))));
                                                $valrow = true;
                                            }
                                            $style = array('font' => array('size' => 17,'bold' => true));
                                            $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);
                                            $total = $total+$row['total'];
                                            $rowex = $rowex+1;
                                    }
                                    $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "TOTAL");
                                    $this->excel->getActiveSheet()->mergeCells('B'.$rowex.':C'.$rowex);
                                    $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, $total."%");
                                    $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '792a55'))));
                                    $style = array('font' => array('size' => 19,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);


                                    //IMPRIME PLAN DE ACCION

                                    $rowex = $rowex+4;
                                    $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "Plan de acciones de acuerdo con el resultado");
                                    $this->excel->getActiveSheet()->mergeCells('B'.$rowex.':D'.$rowex);
                                    $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(40);
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '393939'))));
                                    $style = array('font' => array('size' => 19,'bold' => true,'color' => array('rgb' => 'ffffff')));
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);
                                    $rowex = $rowex+1;
                                    $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "0-50");
                                    $this->excel->getActiveSheet()->SetCellValue('C'.$rowex, "DEFICIENTE");
                                    $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, "Identificar áreas de atención urgente y  a través del análisis de causa efecto,  implementar acciones correctivas a corto plazo.");
                                    $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(100);
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
                                    $style = array('font' => array('size' => 15,'bold' => false,'color' => array('rgb' => '393939')));
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);
                                    $rowex = $rowex+1;
                                    $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "50-75");
                                    $this->excel->getActiveSheet()->SetCellValue('C'.$rowex, "REGULAR");
                                    $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, "Identificar desviaciones y  a través del análisis de causa efecto, implementar acciones correctivas.");
                                    $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(100);
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
                                    $style = array('font' => array('size' => 15,'bold' => false,'color' => array('rgb' => '393939')));
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);
                                    $rowex = $rowex+1;
                                    $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "75-85");
                                    $this->excel->getActiveSheet()->SetCellValue('C'.$rowex, "BUENO");
                                    $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, "Identificar posibles desviaciones y a través del análisis de causa efecto  implementar acciones preventivas.");
                                    $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(100);
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
                                    $style = array('font' => array('size' => 15,'bold' => false,'color' => array('rgb' => '393939')));
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);
                                    $rowex = $rowex+1;
                                    $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "85-95");
                                    $this->excel->getActiveSheet()->SetCellValue('C'.$rowex, "MUY BUENO");
                                    $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, "Identificar áreas de oportunidad y  través del análisis de causa efecto implementar acciones de mejora.");
                                    $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(100);
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
                                    $style = array('font' => array('size' => 15,'bold' => false,'color' => array('rgb' => '393939')));
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);
                                    $rowex = $rowex+1;
                                    $this->excel->getActiveSheet()->SetCellValue('B'.$rowex, "95-100");
                                    $this->excel->getActiveSheet()->SetCellValue('C'.$rowex, "EXCELENTE");
                                    $this->excel->getActiveSheet()->SetCellValue('D'.$rowex, "Continuar con el seguimiento y mejora continua. ");
                                    $this->excel->getActiveSheet()->getRowDimension($rowex)->setRowHeight(100);
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FFFFFF'))));
                                    $style = array('font' => array('size' => 15,'bold' => false,'color' => array('rgb' => '393939')));
                                    $this->excel->getActiveSheet()->getStyle('B'.$rowex.':D'.$rowex)->applyFromArray($style);
                                    $rowex = $rowex+1;








                                    // $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setTextRotation(90);
                                    // $this->excel->getActiveSheet()->mergeCells('A2:A7');
                                    //
                                    $filename=$escolar['unidad'][0]->Siglas.'.xls'; //save our workbook as this file name
                                    header('Content-Type: application/vnd.ms-excel'); //mime type
                                    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                                    header('Cache-Control: max-age=0'); //no cache

                                    // //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                                    // //if you want to save it as .XLSX Excel 2007 format
                                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                                    // //force user to download the Excel file without writing it to server's HD
                                    $objWriter->save('php://output');
								}


		//**************************************************************************************************************************************************************************************************//

	}



        public function check() {
                $data['datos'] = $this->session->userdata('logged_in');
                $urlRed = "consultams/rev/".$this->input->post('idUnidad');
                redirect($urlRed, 'refresh');
        }


        public function rev() {
                $data['datos'] = $this->session->userdata('logged_in');
                $data['evaluaciones'] = $this->evaluacion->getEvaluacionUnidad($this->uri->segment(3));
                $data['unidad'] = $this->unidades->getUnidad($this->uri->segment(3));
                $data['main_cont'] = 'consultams/rev';
                $this->load->view('includes/template_consultams', $data);
        }


        public function consulta1() {

		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "MED";
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				//Escuela
				//Se obtiene id de la url
				$idUrl         = $this->uri->segment(4);
				$data['idUrl'] = $idUrl;

				//SE DEFINE SI LA EVALAUCION ES SUP O MED
				if ($data['datos']['Nivel'] == "MED") {
					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						// Obtener informacion de las tablas
						$data['Alumnos']  = $this->evaluacion->getAlumnos($idUrl);
						$data['Docentes'] = $this->evaluacion->getDocentes($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1(1)) {
							$nivel = $this->niveles->nivel1(1);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2(1)) {
							$nivel = $this->niveles->nivel2(1);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								array_push($a, $array);
								$data["nivel2"] = $a;
							}
						}

						//Nivel 3 Alumnos
						if ($this->niveles->nivel3(1, 1)) {
							$nivel = $this->niveles->nivel3(1, 1);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["nivelAlumnos"] = $a;
							}
						}

						//Nivel 3 Docentes
						if ($this->niveles->nivel3(1, 2)) {
							$nivel = $this->niveles->nivel3(1, 2);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["nivelDocentes"] = $a;
							}
						}

						//Bloque
						if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$a      = array();
							foreach ($bloque as $row) {
								$array = array(
									'idBloques' => $row->idBloques,
									'Nombre'    => $row->Nombre,
								);
								array_push($a, $array);
								$data["bloques"] = $a;
							}
						}

						//Se obtine el registro de los valores del subnivel
						$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltro($data['datos']['idUnidad'], $idUrl);

						$data['main_cont'] = 'desempeno/consultams';
						$this->load->view('includes/template_consulta_rev', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					//SUPERIOR
					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						// Obtener informacion de las tablas
						$data['Alumnos']  = $this->evaluacion->getAlumnosSup($idUrl);
						$data['Docentes'] = $this->evaluacion->getDocentesSup($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(1)) {
							$nivel = $this->niveles->nivel1Sup(1);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(1)) {
							$nivel = $this->niveles->nivel2Sup(1);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								array_push($a, $array);
								$data["nivel2"] = $a;
							}
						}

						//Nivel 3 Alumnos
						if ($this->niveles->nivel3Sup(1, 1)) {
							$nivel = $this->niveles->nivel3Sup(1, 1);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["nivelAlumnos"] = $a;
							}
						}

						//Nivel 3 Docentes
						if ($this->niveles->nivel3Sup(1, 2)) {
							$nivel = $this->niveles->nivel3Sup(1, 2);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["nivelDocentes"] = $a;
							}
						}

						//Bloque
						if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$a      = array();
							foreach ($bloque as $row) {
								$array = array(
									'idBloques' => $row->idBloques,
									'Nombre'    => $row->Nombre,
								);
								array_push($a, $array);
								$data["bloques"] = $a;
							}
						}

						//Se obtine el registro de los valores del subnivel
						$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

						// print_r($data['IndicadorMs']);

						$data['main_cont'] = 'desempeno/consultasup';
						$this->load->view('includes/template_consulta_rev', $data);
					} else {
						redirect('login', 'refresh');
					}
				}

			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}

	}


        public function consulta2() {
                if ($this->session->userdata('logged_in')) {
                        $data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "MED";
                        if ($data['datos']['idRoles'] == 1) {
                                //Admin
                                echo "Permiso denegado";

                        } else {
                                //Escuela
                                //Se obtiene id de la url
                                $idUrl         = $this->uri->segment(4);
                                $data['idUrl'] = $idUrl;

                                //SE DEFINE SI LA EVALAUCION ES SUP O MED
                                if ($data['datos']['Nivel'] == "MED") {

                                        //Se valida si el registro pertenece a la unidad
                                        $result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

                                        //Si existe lo deja continuar
                                        if ($result) {
                                                // Obtener informacion de las tablas
                                                $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
                                                $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

                                                //Obtiene informacion de los titulos
                                                // Nivel 1
                                                if ($this->niveles->nivel1(2)) {
                                                        $nivel = $this->niveles->nivel1(2);
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre' => $row->Nombre,
                                                                        'Valor'  => $row->Valor,
                                                                );
                                                                $data["nivel1"] = $array;
                                                        }
                                                }

                                                //Nivel 2
                                                if ($this->niveles->nivel2(2)) {
                                                        $nivel = $this->niveles->nivel2(2);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre' => $row->Nombre,
                                                                        'Valor'  => $row->Valor,
                                                                );
                                                                array_push($a, $array);
                                                                $data["nivel2"] = $a;
                                                        }
                                                }

                                                //Nivel 3 ProgramasAcademicos
                                                if ($this->niveles->nivel3(2, 3)) {
                                                        $nivel = $this->niveles->nivel3(2, 3);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["nivelProgramasAcademicos"] = $a;
                                                        }
                                                }

                                                //Nivel 3 Infraestructura
                                                if ($this->niveles->nivel3(2, 4)) {
                                                        $nivel = $this->niveles->nivel3(2, 4);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["nivelInfraestructura"] = $a;
                                                        }
                                                }
                                                //Bloque
                                                if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
                                                        $bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
                                                        $a      = array();
                                                        foreach ($bloque as $row) {
                                                                $array = array(
                                                                        'idBloques' => $row->idBloques,
                                                                        'Nombre'    => $row->Nombre,
                                                                );
                                                                array_push($a, $array);
                                                                $data["bloques"] = $a;
                                                        }
                                                }
                                                //Se obtine el registro de los valores del subnivel
                                                $data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltro($data['datos']['idUnidad'], $idUrl);

                                                $data['main_cont'] = 'oferta/consultams';
                                                $this->load->view('includes/template_consulta_rev', $data);
                                        } else {
                                                redirect('login', 'refresh');
                                        }
                                } else {
                                        // SUPERIOR
                                        //Se valida si el registro pertenece a la unidad
                                        $result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

                                        //Si existe lo deja continuar
                                        if ($result) {
                                                // Obtener informacion de las tablas
                                                $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicosSup($idUrl);
                                                $data['Infraestructura']     = $this->evaluacion->getInfraestructuraSup($idUrl);

                                                //Obtiene informacion de los titulos
                                                // Nivel 1
                                                if ($this->niveles->nivel1Sup(2)) {
                                                        $nivel = $this->niveles->nivel1Sup(2);
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre' => $row->Nombre,
                                                                        'Valor'  => $row->Valor,
                                                                );
                                                                $data["nivel1"] = $array;
                                                        }
                                                }

                                                //Nivel 2
                                                if ($this->niveles->nivel2Sup(2)) {
                                                        $nivel = $this->niveles->nivel2Sup(2);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre' => $row->Nombre,
                                                                        'Valor'  => $row->Valor,
                                                                );
                                                                array_push($a, $array);
                                                                $data["nivel2"] = $a;
                                                        }
                                                }

                                                //Nivel 3 ProgramasAcademicos
                                                if ($this->niveles->nivel3Sup(2, 3)) {
                                                        $nivel = $this->niveles->nivel3Sup(2, 3);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["nivelProgramasAcademicos"] = $a;
                                                        }
                                                }

                                                //Nivel 3 Infraestructura
                                                if ($this->niveles->nivel3Sup(2, 5)) {
                                                        $nivel = $this->niveles->nivel3Sup(2, 5);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["nivelInfraestructura"] = $a;
                                                        }
                                                }
                                                //Bloque
                                                if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
                                                        $bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
                                                        $a      = array();
                                                        foreach ($bloque as $row) {
                                                                $array = array(
                                                                        'idBloques' => $row->idBloques,
                                                                        'Nombre'    => $row->Nombre,
                                                                );
                                                                array_push($a, $array);
                                                                $data["bloques"] = $a;
                                                        }
                                                }
                                                //Se obtine el registro de los valores del subnivel
                                                $data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

                                                $data['main_cont'] = 'oferta/indexSup';
                                                $this->load->view('includes/template_principal', $data);
                                        } else {
                                                redirect('login', 'refresh');
                                        }
                                }
                        }
                } else {
                        //If no session, redirect to login page
                        redirect('login', 'refresh');
                }

        }

        public function consulta3() {
                if ($this->session->userdata('logged_in')) {
                        $data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "MED";
                        if ($data['datos']['idRoles'] == 1) {
                                //Admin
                                echo "Permiso denegado";

                        } else {
                                //Escuela
                                //Se obtiene id de la url
                                $idUrl         = $this->uri->segment(4);
                                $data['idUrl'] = $idUrl;

                                if ($data['datos']['Nivel'] == "MED") {
                                        //Se valida si el registro pertenece a la unidad
                                        $result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

                                        //Si existe lo deja continuar
                                        if ($result) {

                                                $data['BecasArr']  = $this->evaluacion->getBecas($idUrl);
                                                $data['Tutorias']  = $this->evaluacion->getTutorias($idUrl);
                                                $data['Servicios'] = $this->evaluacion->getServicios($idUrl);

                                                //Obtiene informacion de los titulos
                                                // Nivel 1
                                                if ($this->niveles->nivel1(3)) {
                                                        $nivel = $this->niveles->nivel1(3);
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre' => $row->Nombre,
                                                                        'Valor'  => $row->Valor,
                                                                );
                                                                $data["nivel1"] = $array;
                                                        }
                                                }

                                                //Nivel 2
                                                if ($this->niveles->nivel2(3)) {
                                                        $nivel = $this->niveles->nivel2(3);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre' => $row->Nombre,
                                                                        'Valor'  => $row->Valor,
                                                                );
                                                                array_push($a, $array);
                                                                $data["nivel2"] = $a;
                                                        }
                                                }

                                                //Nivel 3 Becas
                                                if ($this->niveles->nivel3(3, 5)) {
                                                        $nivel = $this->niveles->nivel3(3, 5);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["Becas"] = $a;
                                                        }
                                                }

                                                //Nivel 3 Tutoría
                                                if ($this->niveles->nivel3(3, 6)) {
                                                        $nivel = $this->niveles->nivel3(3, 6);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["Tutoria"] = $a;
                                                        }
                                                }

                                                //Nivel 3 Servicio de apoyo educativo
                                                if ($this->niveles->nivel3(3, 7)) {
                                                        $nivel = $this->niveles->nivel3(3, 7);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["ServicioApoyo"] = $a;
                                                        }
                                                }
                                                //Bloque
                                                if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
                                                        $bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
                                                        $a      = array();
                                                        foreach ($bloque as $row) {
                                                                $array = array(
                                                                        'idBloques' => $row->idBloques,
                                                                        'Nombre'    => $row->Nombre,
                                                                );
                                                                array_push($a, $array);
                                                                $data["bloques"] = $a;
                                                        }
                                                }

                                                //Se obtine el registro de los valores del subnivel
                                                $data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltro($data['datos']['idUnidad'], $idUrl);

                                                $data['main_cont'] = 'apoyo/consultams';
                                                $this->load->view('includes/template_consulta_rev', $data);
                                        } else {
                                                redirect('login', 'refresh');
                                        }
                                } else {

                                        // ++++++++++++++++++++++++++++++SUPERIOR+++++++++++++++++++++++++++++++++++++++++++
                                        $result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        $eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
                                        // if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

                                        //Si existe lo deja continuar
                                        if ($result) {

                                                $data['BecasArr']  = $this->evaluacion->getBecasSup($idUrl);
                                                $data['Tutorias']  = $this->evaluacion->getTutoriasSup($idUrl);
                                                $data['Servicios'] = $this->evaluacion->getServiciosSup($idUrl);

                                                //Obtiene informacion de los titulos
                                                // Nivel 1
                                                if ($this->niveles->nivel1Sup(3)) {
                                                        $nivel = $this->niveles->nivel1Sup(3);
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre' => $row->Nombre,
                                                                        'Valor'  => $row->Valor,
                                                                );
                                                                $data["nivel1"] = $array;
                                                        }
                                                }

                                                //Nivel 2
                                                if ($this->niveles->nivel2Sup(3)) {
                                                        $nivel = $this->niveles->nivel2Sup(3);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre' => $row->Nombre,
                                                                        'Valor'  => $row->Valor,
                                                                );
                                                                array_push($a, $array);
                                                                $data["nivel2"] = $a;
                                                        }
                                                }

                                                //Nivel 3 Becas
                                                if ($this->niveles->nivel3Sup(3, 6)) {
                                                        $nivel = $this->niveles->nivel3Sup(3, 6);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["Becas"] = $a;
                                                        }
                                                }

                                                //Nivel 3 Tutoría
                                                if ($this->niveles->nivel3Sup(3, 7)) {
                                                        $nivel = $this->niveles->nivel3Sup(3, 7);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["Tutoria"] = $a;
                                                        }
                                                }

                                                //Nivel 3 Servicio de apoyo educativo
                                                if ($this->niveles->nivel3Sup(3, 8)) {
                                                        $nivel = $this->niveles->nivel3Sup(3, 8);
                                                        $a     = array();
                                                        foreach ($nivel as $row) {
                                                                $array = array(
                                                                        'Nombre'      => $row->Nombre,
                                                                        'Indicadores' => $row->Indicadores,
                                                                        'Descripcion' => $row->Descripcion,
                                                                        'Valor'       => $row->Valor,
                                                                        'campo1'      => $row->campo1,
                                                                        'campo1id'    => $row->campo1id,
                                                                        'campo2'      => $row->campo2,
                                                                        'campo2id'    => $row->campo2id,
                                                                        'Despegable'  => $row->Despegable
                                                                );
                                                                array_push($a, $array);
                                                                $data["ServicioApoyo"] = $a;
                                                        }
                                                }
                                                //Bloque
                                                if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
                                                        $bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
                                                        $a      = array();
                                                        foreach ($bloque as $row) {
                                                                $array = array(
                                                                        'idBloques' => $row->idBloques,
                                                                        'Nombre'    => $row->Nombre,
                                                                );
                                                                array_push($a, $array);
                                                                $data["bloques"] = $a;
                                                        }
                                                }

                                                //Se obtine el registro de los valores del subnivel
                                                $data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

                                                $data['main_cont'] = 'apoyo/consultasup';
                                                // print_r($data['BecasArr']);
                                                $this->load->view('includes/template_consulta_rev_sup', $data);
                                        } else {
                                                redirect('login', 'refresh');
                                        }
                                }
                        }
                } else {
                        //If no session, redirect to login page
                        redirect('login', 'refresh');
                }

        }

        public function consulta4() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "MED";
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				//Escuela
				//Se obtiene id de la url
				$idUrl         = $this->uri->segment(4);
				$data['idUrl'] = $idUrl;

				if ($data['datos']['Nivel'] == "MED") {

					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocial($idUrl);
						$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolares($idUrl);
						$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculados($idUrl);
						// Obtener informacion de las tablas
						// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
						// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1(4)) {
							$nivel = $this->niveles->nivel1(4);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2(4)) {
							$nivel = $this->niveles->nivel2(4);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								array_push($a, $array);
								$data["nivel2"] = $a;
							}
						}

						//Nivel 3 ServicioSocial
						if ($this->niveles->nivel3(4, 8)) {
							$nivel = $this->niveles->nivel3(4, 8);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["ServicioSocial"] = $a;
							}
						}

						//Nivel 3 VisitasEscolares
						if ($this->niveles->nivel3(4, 9)) {
							$nivel = $this->niveles->nivel3(4, 9);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["VisitasEscolares"] = $a;
							}
						}

						//Nivel 3 ProyectosVinculados
						if ($this->niveles->nivel3(4, 10)) {
							$nivel = $this->niveles->nivel3(4, 10);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["ProyectosVinculados"] = $a;
							}
						}
						//Bloque
						if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$a      = array();
							foreach ($bloque as $row) {
								$array = array(
									'idBloques' => $row->idBloques,
									'Nombre'    => $row->Nombre,
								);
								array_push($a, $array);
								$data["bloques"] = $a;
							}
						}

						//Se obtine el registro de los valores del subnivel
						$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltro($data['datos']['idUnidad'], $idUrl);

						$data['main_cont'] = 'vinculacion/consultams';
						$this->load->view('includes/template_consulta_rev', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					// ++++++++++++++++++++++++++++++++++++++++++SUPERIOR++++++++++++++++++++++++++++++++++
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					if ($result) {
						$data['ServicioSocialServ']      = $this->evaluacion->getServicioSocialSup($idUrl);
						$data['VisitasEscolaresServ']    = $this->evaluacion->getVisitasEscolaresSup($idUrl);
						$data['ProyectosVinculadosServ'] = $this->evaluacion->getProyectosVinculadosSup($idUrl);
						// Obtener informacion de las tablas
						// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
						// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(4)) {
							$nivel = $this->niveles->nivel1Sup(4);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(4)) {
							$nivel = $this->niveles->nivel2Sup(4);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								array_push($a, $array);
								$data["nivel2"] = $a;
							}
						}

						//Nivel 3 ServicioSocial
						if ($this->niveles->nivel3Sup(4, 9)) {
							$nivel = $this->niveles->nivel3Sup(4, 9);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["ServicioSocial"] = $a;
							}
						}

						//Nivel 3 VisitasEscolares
						if ($this->niveles->nivel3Sup(4, 10)) {
							$nivel = $this->niveles->nivel3Sup(4, 10);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["VisitasEscolares"] = $a;
							}
						}

						//Nivel 3 ProyectosVinculados
						if ($this->niveles->nivel3Sup(4, 11)) {
							$nivel = $this->niveles->nivel3Sup(4, 11);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["ProyectosVinculados"] = $a;
							}
						}
						//Bloque
						if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$a      = array();
							foreach ($bloque as $row) {
								$array = array(
									'idBloques' => $row->idBloques,
									'Nombre'    => $row->Nombre,
								);
								array_push($a, $array);
								$data["bloques"] = $a;
							}
						}

						//Se obtine el registro de los valores del subnivel
						$data['IndicadorMs'] = $this->evaluacion->getEvaluacionSubnivelFiltroSup($data['datos']['idUnidad'], $idUrl);

						$data['main_cont'] = 'vinculacion/consultasup';
						$this->load->view('includes/template_consulta_rev_sup', $data);
					} else {
						redirect('login', 'refresh');
					}
				}
			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}

	}

        public function consulta5() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "MED";
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				//Escuela
				//Se obtiene id de la url
				$idUrl         = $this->uri->segment(4);
				$data['idUrl'] = $idUrl;
				if ($data['datos']['Nivel'] == "MED") {//++++++++++++++++++++MEDIO SUPERIOR++++++++++++++++++++

					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						// Obtener informacion de las tablas
						// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
						// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
						$data['ApoyoDocenciaServ']         = $this->evaluacion->getApoyoDocencia($idUrl);
						$data['ParticipacionAlmunnosServ'] = $this->evaluacion->getParticipacionAlmunnos($idUrl);
						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1(5)) {
							$nivel = $this->niveles->nivel1(5);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2(5)) {
							$nivel = $this->niveles->nivel2(5);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								array_push($a, $array);
								$data["nivel2"] = $a;
							}
						}

						//Nivel 3 Apoyo de la investigacion a la docencia
						if ($this->niveles->nivel3(5, 11)) {
							$nivel = $this->niveles->nivel3(5, 11);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["ApoyoDocencia"] = $a;
							}
						}

						//Nivel 3 Participación de los alumnos en investigaciones
						if ($this->niveles->nivel3(5, 12)) {
							$nivel = $this->niveles->nivel3(5, 12);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["ParticipacionAlmunnos"] = $a;
							}
						}
						//Bloque
						if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$a      = array();
							foreach ($bloque as $row) {
								$array = array(
									'idBloques' => $row->idBloques,
									'Nombre'    => $row->Nombre,
								);
								array_push($a, $array);
								$data["bloques"] = $a;
							}
						}

						$data['main_cont'] = 'investigacion/consultams';
						$this->load->view('includes/template_consulta_rev', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {//++++++++++++++++++++++++++SUPERIOR++++++++++++++++++++++++++++++++++++
					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						$data['ApoyoDocenciaServ']         = $this->evaluacion->getApoyoDocenciaSup($idUrl);
						$data['ParticipacionAlmunnosServ'] = $this->evaluacion->getParticipacionAlmunnosSup($idUrl);
						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(5)) {
							$nivel = $this->niveles->nivel1Sup(5);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(5)) {
							$nivel = $this->niveles->nivel2Sup(5);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								array_push($a, $array);
								$data["nivel2"] = $a;
							}
						}

						//Nivel 3 Apoyo de la investigacion a la docencia
						if ($this->niveles->nivel3Sup(5, 12)) {
							$nivel = $this->niveles->nivel3Sup(5, 12);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["ApoyoDocencia"] = $a;
							}
						}

						//Nivel 3 Participación de los alumnos en investigaciones
						if ($this->niveles->nivel3Sup(5, 13)) {
							$nivel = $this->niveles->nivel3Sup(5, 13);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["ParticipacionAlmunnos"] = $a;
							}
						}
						//Bloque
						if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$a      = array();
							foreach ($bloque as $row) {
								$array = array(
									'idBloques' => $row->idBloques,
									'Nombre'    => $row->Nombre,
								);
								array_push($a, $array);
								$data["bloques"] = $a;
							}
						}

						$data['main_cont'] = 'investigacion/consultasup';
						$this->load->view('includes/template_consulta_rev_sup', $data);
					} else {
						redirect('login', 'refresh');
					}
				}
			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}

	}

        public function consulta6() {
		if ($this->session->userdata('logged_in')) {
			$data['datos'] = $this->session->userdata('logged_in');
                        $data['datos']['idUnidad']=$this->uri->segment(3);
                        $data['datos']['idEvaluacion']=$this->uri->segment(4);
                        $data['datos']['Nivel'] = "MED";
			if ($data['datos']['idRoles'] == 1) {
				//Admin
				echo "Permiso denegado";

			} else {
				//Escuela
				//Se obtiene id de la url
				$idUrl         = $this->uri->segment(4);
				$data['idUrl'] = $idUrl;
				if ($data['datos']['Nivel'] == "MED") {

					//Se valida si el registro pertenece a la unidad
					$result = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacion;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

					//Si existe lo deja continuar
					if ($result) {
						// Obtener informacion de las tablas
						// $data['ProgramasAcademicos'] = $this->evaluacion->getProgramasAcademicos($idUrl);
						// $data['Infraestructura']     = $this->evaluacion->getInfraestructura($idUrl);
						$data['gestion'] = $this->evaluacion->getGestion($idUrl);
						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1(6)) {
							$nivel = $this->niveles->nivel1(6);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2(6)) {
							$nivel = $this->niveles->nivel2(6);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								array_push($a, $array);
								$data["nivel2"] = $a;
							}
						}

						//Nivel 3 Recursos autogenerados
						if ($this->niveles->nivel3(6, 14)) {
							$nivel = $this->niveles->nivel3(6, 14);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["Recursos"] = $a;
							}
						}
						//Bloque
						if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$a      = array();
							foreach ($bloque as $row) {
								$array = array(
									'idBloques' => $row->idBloques,
									'Nombre'    => $row->Nombre,
								);
								array_push($a, $array);
								$data["bloques"] = $a;
							}
						}

						$data['main_cont'] = 'gestion/consultams';
						$this->load->view('includes/template_consulta_rev', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					// SUPERIOR
					$result = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval   = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
                                        $idUrl            = $eval[0]->idEvaluacionSup;
                                        $data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}
					//Si existe lo deja continuar
					if ($result) {
						$data['gestion'] = $this->evaluacion->getGestionSup($idUrl);

						//Obtiene informacion de los titulos
						// Nivel 1
						if ($this->niveles->nivel1Sup(6)) {
							$nivel = $this->niveles->nivel1Sup(6);
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								$data["nivel1"] = $array;
							}
						}

						//Nivel 2
						if ($this->niveles->nivel2Sup(6)) {
							$nivel = $this->niveles->nivel2Sup(6);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre' => $row->Nombre,
									'Valor'  => $row->Valor,
								);
								array_push($a, $array);
								$data["nivel2"] = $a;
							}
						}

						//Nivel 3 Recursos autogenerados
						if ($this->niveles->nivel3Sup(6, 14)) {
							$nivel = $this->niveles->nivel3Sup(6, 14);
							$a     = array();
							foreach ($nivel as $row) {
								$array = array(
									'Nombre'      => $row->Nombre,
									'Indicadores' => $row->Indicadores,
									'Descripcion' => $row->Descripcion,
									'Valor'       => $row->Valor,
									'campo1'      => $row->campo1,
									'campo1id'    => $row->campo1id,
									'campo2'      => $row->campo2,
									'campo2id'    => $row->campo2id,
									'Despegable'  => $row->Despegable
								);
								array_push($a, $array);
								$data["Recursos"] = $a;
							}
						}
						//Bloque
						if ($this->evaluacion->getBloque($data['datos']['idUnidad'])) {
							$bloque = $this->evaluacion->getBloque($data['datos']['idUnidad']);
							$a      = array();
							foreach ($bloque as $row) {
								$array = array(
									'idBloques' => $row->idBloques,
									'Nombre'    => $row->Nombre,
								);
								array_push($a, $array);
								$data["bloques"] = $a;
							}
						}

						$data['main_cont'] = 'gestion/consultasup';
						$this->load->view('includes/template_consulta_rev_sup', $data);
					} else {
						redirect('login', 'refresh');
					}

				}
			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}

	}

        public function updatecomentario(){

                $objeto = array(
                        'tabla'           => $this->input->post('tabla'),
                        'idEvaluacion'           => $this->input->post('idEvaluacion'),
                        'idUnidad'           => $this->input->post('idUnidad'),
                        'comentarios'           => $this->input->post('comentarios'),
                );

                $this->evaluacion->update_comentarios($objeto);


                $longitud =  strlen(str_replace(' ', '', $this->input->post('comentarios')));

                if($longitud==0){
                        $objeto2 = array(
                                'columna'           => $this->input->post('comentario'),
                                'idEvaluacion'           => $this->input->post('idEvaluacion'),
                                'cn' => 1
                        );
                        $this->evaluacion->update_cn($objeto2);
                }else{
                        $objeto2 = array(
                                'columna'           => $this->input->post('comentario'),
                                'idEvaluacion'           => $this->input->post('idEvaluacion'),
                                'cn' => 2
                        );
                        $this->evaluacion->update_cn($objeto2);
                }


                redirect($this->input->post('redirect'),'refresh');
        }



        public function updateEstadoMed(){

                $data = array(
			'idEvaluacion'     =>  $this->uri->segment(3),
                        'estado'     =>  'ACT'
		);

                print_r($data);

                $this->evaluacion->update_ev_med($data);

                redirect('consultams', 'refresh');
        }


        public function finalizarEstadoMed(){

                $data = array(
			'idEvaluacion'     =>  $this->uri->segment(3),
                        'estado'     =>  'FIN'
		);

                print_r($data);

                $this->evaluacion->update_ev_med($data);

                redirect('consultams', 'refresh');
        }




}
