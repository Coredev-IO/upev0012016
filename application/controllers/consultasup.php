<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Consultasup extends CI_Controller {

	function __construct() {
		parent::__construct();
		//SE VERIFICA LA SESION
		$data['datos'] = $this->session->userdata('logged_in');
		$this->load->library('verify');
		$this->load->library('limites');
		$this->verify->seccion(4, $data['datos']['idRoles']);
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
		$data['datos']     = $this->session->userdata('logged_in');
		$data['unidades']  = $this->unidades->getUnidades('SUP');
		// $data['evaluaciones'] = $this->evaluacion->getEvaluaciones
		//Unidades con su ultima evaluacion
		$unidadesEv =  array();
		foreach ($data['unidades'] as $row) {
			$puente =  array();
			$puente['idUnidad'] = $row->idUnidad;
			$puente['NombreUnidad'] = $row->NombreUnidad;
			$puente['Siglas'] = $row->Siglas;
			$evaluacion = $this->evaluacion->getLastEvaluacionSup($row->idUnidad);
			if(count($evaluacion)>0){
				$puente['idEvaluacion'] = $evaluacion[0]->idEvaluacionSup;
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
				$puente['estado'] = $evaluacion[0]->estado;
				$puente['fechaEvaluacion'] = "";
				$puente['estatusEvaluacion'] = "No hay evaluaciones";
			}
			array_push($unidadesEv,$puente);
		}
		// print_r($unidadesEv[10]);
		$data['unidadesEv'] = $unidadesEv;
		$data['main_cont'] = 'consultasup/index';
		$this->load->view('includes/template_consultasup', $data);
	}

	//CALCULO DE INDICADORES
	public function calculo() {
		$data['datos'] = $this->session->userdata('logged_in');
		$evaluacionid  = $this->uri->segment(3);
		$data['evaluacionid']  = $this->uri->segment(3);
		$genTipo  = $this->uri->segment(4);
		$data['urldata'] = $this->uri->segment(2).'/'.$this->uri->segment(3);
		// echo "<br>";
		$idUnidad = $this->evaluacion->getIdUnidadSup($evaluacionid);
		$carreras = $this->evaluacion->getBloque($idUnidad);
		// $idUnidad  = 12;

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
		$bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);
		$nivel['tercerbloque'] = array();
		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos en situación escolar regular";
		$tercer['porcentaje']   = 20;
		$tercer['descripcion']  = "Porcentaje de alumnos que han aprobado todas las unidades de aprendizaje en las que han estado inscritos por Programa Académico, en un periodo determinado";
		$tercer['metodo']       = "(Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos  / Total de matrícula por programa académico)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos que han acreditado todas las unidades de aprendizaje en las que han estado inscritos por programa académico " ;
		$tercer['var2'] = "Total de matrícula inscrita por programa académico";

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
			if($row->BAlumnosRegularesT>0){
				$pre       = ($pre+((($row->BAlumnosRegulares)/($row->BAlumnosRegularesT))*100));
				$objPuente['calculo'] = ((($row->BAlumnosRegulares)/($row->BAlumnosRegularesT))*100);
			}
			$objPuente['var1'] = $row->BAlumnosRegulares;
			$objPuente['var2'] = $row->BAlumnosRegularesT;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	29.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	30	; $objeto[1][1]=	39.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	40	; $objeto[2][1]=	49.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	50	; $objeto[3][1]=	59.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	60	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Eficiencia  terminal";
		$tercer['porcentaje']   = 20;
		$tercer['descripcion']  = "Porcentaje de alumnos que egresan por cohorte generacional en cada programa académico.";
		$tercer['metodo']       = "( Ʃ 1 n   Número de alumnos del cohorte A que egresan  en el año n / total de alumnos en el cohorte A)";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos del cohorte A que egresan  en el año por programa académico";
		$tercer['var2'] = "Total de alumnos admitidos al programa académico en el cohorte A";

		// EL INDICADOR APLICA
                $bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);
		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BEficienciaTerminal;
			$tercer['val2'] = $tercer['val2']+$row->BAlumnosRegularesT;
			$objPuente['calculo'] = 0;
			if($row->BAlumnosRegularesT>0){
				$pre       = ($pre+((($row->BEficienciaTerminal)/($row->BAlumnosRegularesT))*100));
				$objPuente['calculo'] = ((($row->BEficienciaTerminal)/($row->BAlumnosRegularesT))*100);
			}
			$objPuente['var1'] = $row->BEficienciaTerminal;
			$objPuente['var2'] = $row->BAlumnosRegularesT;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	31.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	32	; $objeto[1][1]=	48.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	49	; $objeto[2][1]=	59.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	60	; $objeto[3][1]=	69.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	70	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;


        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos titulados.";
		$tercer['porcentaje']   = 20;
		$tercer['descripcion']  = "Porcentaje de alumnos titulados hasta tres años después de egresar por programa académico.";
		$tercer['metodo']       = "(Número de alumnos  titulados hasta tres años después de egresar  por programa académico en un periodo determinado /Total de la matrícula de egreso por programa académico de tres años atrás )*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos  titulados hasta tres años después de egresar de un periodo determinado por programa académico";
		$tercer['var2'] = "Total de la matrícula de egreso del mismo periodo por programa académico";

		// EL INDICADOR APLICA
                $bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);
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
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	29.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	30	; $objeto[1][1]=	39.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	40	; $objeto[2][1]=	49.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	50	; $objeto[3][1]=	59.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	60	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumno en riesgo de abandono por situación académica.";
		$tercer['porcentaje']   = 20;
		$tercer['descripcion']  = "Porcentaje de alumnos con unidades de aprendizaje con adeudo, desfasadas por 2 o más periodos escolares. ";
		$tercer['metodo']       = "(Número de alumnos con unidades de aprendizaje con adeudo, desfasadas por 2 0 más periodos escolares / Total de matrícula inscrita por programa académico) *100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos con unidades de aprendizaje defasadas por 2 o más periodos escolares";
		$tercer['var2'] = "Total de matrícula inscrita por programa académico por semestre";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BAlumnosRiesgoAbandono;
			$tercer['val2'] = $tercer['val2']+$row->BAlumnosRiesgoAbandonoT;
			$objPuente['var1'] = $row->BAlumnosRiesgoAbandono;
			$objPuente['var2'] = $row->BAlumnosRiesgoAbandonoT;
			$objPuente['calculo'] = 0;
			if($row->BAlumnosRiesgoAbandonoT>0){
				$objPuente['calculo'] = ((($row->BAlumnosRiesgoAbandono)/($row->BAlumnosRiesgoAbandonoT))*100);
				$pre       = ($pre+((($row->BAlumnosRiesgoAbandono)/($row->BAlumnosRiesgoAbandonoT))*100));

			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	4.99	; $objeto[0][2]=	5	; $objeto[0][3] = "	Muy Bueno	";
		$objeto[1][0]=	5	; $objeto[1][1]=	9.99	; $objeto[1][2]=	4	; $objeto[1][3] = "	Bueno 	";
		$objeto[2][0]=	10	; $objeto[2][1]=	14.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	15	; $objeto[3][1]=	19.99	; $objeto[3][2]=	2	; $objeto[3][3] = "	Suficiente	";
		$objeto[4][0]=	20	; $objeto[4][1]=	100	; $objeto[4][2]=	1	; $objeto[4][3] = "	Malo	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Recién egresados en inserción laboral.";
		$tercer['porcentaje']   = 20;
		$tercer['descripcion']  = "Porcentaje de egresados que se insertan al mercado laboral en coincidencia con el programa académico de formación, en 1 año posterior a su egreso.";
		$tercer['metodo']       = "(Número de alumnos que se insertan al mercado laboral en coincidencia con el programa académico de egreso en un tiempo máximo de un 1 año/total de alumnos de egreso del programa académico del mismo periodo)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos que se insertan al mercado laboral en coincidencia con el programa académico de egreso en un tiempo máximo de un 1 año";
		$tercer['var2'] = "Total de alumnos de egreso del programa académico del mismo periodo";

		// EL INDICADOR APLICA

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BRecienEgresados;
			$tercer['val2'] = $tercer['val2']+$row->BRecienEgresadosT;
			$objPuente['calculo'] = 0;
			if($row->BRecienEgresadosT>0){
				$pre       = ($pre+((($row->BRecienEgresados)/($row->BRecienEgresadosT))*100));
				$objPuente['calculo'] = ((($row->BRecienEgresados)/($row->BRecienEgresadosT))*100);
			}
			$objPuente['var1'] = $row->BRecienEgresados;
			$objPuente['var2'] = $row->BRecienEgresadosT;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	39.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	40	; $objeto[1][1]=	49.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	50	; $objeto[2][1]=	59.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	60	; $objeto[3][1]=	69.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	70	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
                // $nivel['segundobloque']['porcentaje'] = 50;
                $sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);



		//**************************************************************************************************************************************************************************************************//

		$nivel               = array();
		$nivel['nombre']     = "DESEMPEÑO";
		$nivel['porcentaje'] = 25;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "PERFIL DOCENTE";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Aprovechamiento de la Planta Docente.";
		$tercer['porcentaje']   = 25;
		$tercer['descripcion']  = "Total de horas frente a grupo por profesores de base por academia.";
		$tercer['metodo']       = "( total de horas frente a grupo por profesores de base por periodo semestral por academia/  cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia)";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Total de horas frente a grupo por profesores de base por periodo semestral por academia";
		$tercer['var2'] = "Cantidad de horas frente a grupo por profesores de base por reglamento  por periodo semestral por academia";

		// EL INDICADOR NO APLICA

		$bloque = $this->docentes->getDocentesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->TotalHorasBase;
			$tercer['val2'] = $tercer['val2']+$row->TotalHorasReglamento;
			$objPuente['var1'] = $row->TotalHorasBase;
			$objPuente['var2'] = $row->TotalHorasReglamento;
			$objPuente['calculo'] = 0;
			if($row->TotalHorasReglamento>0){
				$objPuente['calculo'] = ((($row->TotalHorasBase)/($row->TotalHorasReglamento))*100);
				$pre       = ($pre+((($row->TotalHorasBase)/($row->TotalHorasReglamento))*100));

			}

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	69.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	70	; $objeto[1][1]=	74.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	75	; $objeto[2][1]=	79.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	80	; $objeto[3][1]=	84.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	85	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Docentes de Asignatura activos en el Sector Productivo.";
		$tercer['porcentaje']   = 25;
		$tercer['descripcion']  = "Porcentaje de docentes de asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen.";
		$tercer['metodo']       = "(Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica/total de docentes contratados por asignatura  por unidad académica)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número docentes contratados por asignatura activos en el sector productivo en coincidencia con el programa académico en el que intervienen, por unidad académica";
		$tercer['var2'] = "Total de docentes contratados por asignatura  por unidad académica";

		// EL INDICADOR NO APLICA

		$bloque = $this->docentes->getDocentesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->DocentesActivosProductivo;
			$tercer['val2'] = $tercer['val2']+$row->TotalDocentesContratadosAsignatura;
			$objPuente['calculo'] = 0;
			if($row->TotalDocentesContratadosAsignatura>0){
				$pre       = ($pre+((($row->DocentesActivosProductivo)/($row->TotalDocentesContratadosAsignatura))*100));
				$objPuente['calculo'] = ((($row->DocentesActivosProductivo)/($row->TotalDocentesContratadosAsignatura))*100);
			}
			$objPuente['var1'] = $row->DocentesActivosProductivo;
			$objPuente['var2'] = $row->TotalDocentesContratadosAsignatura;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	49.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	50	; $objeto[1][1]=	59.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	60	; $objeto[2][1]=	69.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	70	; $objeto[3][1]=	79.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	80	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Profesores formados para la docencia y/o en educación continua para la docencia en los últimos 5 años.";
		$tercer['porcentaje']   = 25;
		$tercer['descripcion']  = "Porcentaje de profesores actualizados  para la docencia con al menos una acción formativa por año en la unidad académica.";
		$tercer['metodo']       = "(Número de profesores formados para la docencia con por lo menos una acción de formación   por año por unidad académica / total de la planta docente)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de profesores formados para la docencia con por lo menos una acción de formación   por año por unidad académica";
		$tercer['var2'] = "Total de la planta docente";

		// EL INDICADOR NO APLICA

		$bloque = $this->docentes->getDocentesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->ProfesoresParaDocencias;
			$tercer['val2'] = $tercer['val2']+$row->TotalProfesores;
			$objPuente['var1'] = $row->ProfesoresParaDocencias;
			$objPuente['var2'] = $row->TotalProfesores;
			$objPuente['calculo'] = 0;
			if($row->TotalProfesores>0){
				$objPuente['calculo'] = ((($row->ProfesoresParaDocencias)/($row->TotalProfesores))*100);
				$pre       = ($pre+((($row->ProfesoresParaDocencias)/($row->TotalProfesores))*100));


			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	29.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	30	; $objeto[1][1]=	39.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	40	; $objeto[2][1]=	49.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	50	; $objeto[3][1]=	59.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	60	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Docentes actualizados en el Área Disciplinar en los últimos 2 años.";
		$tercer['porcentaje']   = 25;
		$tercer['descripcion']  = "Porcentaje de profesores con por  lo menos una acción de actualización en su área disciplinar.";
		$tercer['metodo']       = "(Número de profesores con por  lo menos una acción de actualización en su área disciplinar  / total de los profesores)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de profesores con por  lo menos una acción de actualización en su área disciplinar";
		$tercer['var2'] = "Total de los profesores";

		// EL INDICADOR NO APLICA

		$bloque = $this->docentes->getDocentesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->ProfesoresActualizados;
			$tercer['val2'] = $tercer['val2']+$row->TotalPrefesores;
			$objPuente['var1'] = $row->ProfesoresActualizados;
			$objPuente['var2'] = $row->TotalPrefesores;
			$objPuente['calculo'] = 0;
			if($row->TotalPrefesores>0){
				$objPuente['calculo'] = ((($row->ProfesoresActualizados)/($row->TotalPrefesores))*100);
				$pre       = ($pre+((($row->ProfesoresActualizados)/($row->TotalPrefesores))*100));


			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	29.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	30	; $objeto[1][1]=	39.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	40	; $objeto[2][1]=	49.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	50	; $objeto[3][1]=	59.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	60	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

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



		$nivel               = array();
		$nivel['nombre']     = "OFERTA EDUCATIVA";
		$nivel['porcentaje'] = 25;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "PROGRAMAS ACADEMICOS";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Programas Académicos Acreditados.";
		$tercer['porcentaje']   = 50;
		$tercer['descripcion']  = "Porcentaje de programas académicos acreditados por organismos externos.";
		$tercer['metodo']       = "(Número de programas académicos acreditados por organismos externos por unidad académica/Número de programas académicos ofertados por Unidad Académica) *100 ";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de programas académicos acreditados por organismos externos por unidad académica";
		$tercer['var2'] = "Número de programas académicos ofertados por unidad académica";

		// EL INDICADOR SI APLICA
		$bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BProgramasAcedAcred;
			$tercer['val2'] = $tercer['val2']+$row->BProgramasAcedAcredT;
			$objPuente['var1'] = $row->BProgramasAcedAcred;
			$objPuente['var2'] = $row->BProgramasAcedAcredT;
			$objPuente['calculo'] = 0;
			if($row->BProgramasAcedAcredT>0){
				$objPuente['calculo'] = ((($row->BProgramasAcedAcred)/($row->BProgramasAcedAcredT))*100);
				$pre       = ($pre+((($row->BProgramasAcedAcred)/($row->BProgramasAcedAcredT))*100));


			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	74.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	""	; $objeto[1][1]=	""	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	75	; $objeto[2][1]=	99.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	""	; $objeto[3][1]=	""	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	100	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Programas Académicos Actualizados o Rediseñados.";
		$tercer['porcentaje']   = 50;
		$tercer['descripcion']  = "Porcentaje de   programas de estudio  actualizados por programa académico en los últimos 4 años";
		$tercer['metodo']       = "(Número de programas de estudio actualizados/Total de programas de estudio de los programas académicos de la Unidad Académica) *100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de programas de estudio actualizados";
		$tercer['var2'] = "Total de programas de estudio de los programas académicos de la unidad académica";

		// EL INDICADOR SI APLICA
		$bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BProgramasAcualizados;
			$tercer['val2'] = $tercer['val2']+$row->BProgramasAcualizadosT;
			$objPuente['calculo'] = 0;
			if($row->BProgramasAcualizadosT>0){
				$pre       = ($pre+((($row->BProgramasAcualizados)/($row->BProgramasAcualizadosT))*100));
				$objPuente['calculo'] = ((($row->BProgramasAcualizados)/($row->BProgramasAcualizadosT))*100);
			}
			$objPuente['var1'] = $row->BProgramasAcualizados;
			$objPuente['var2'] = $row->BProgramasAcualizadosT;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	49.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	50	; $objeto[1][1]=	59.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	60	; $objeto[2][1]=	79.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	80	; $objeto[3][1]=	89.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	90	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		$nivel               = array();
		$nivel['nombre']     = "OFERTA EDUCATIVA";
		$nivel['porcentaje'] = 25;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "INFRAESTRUCTURA";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Capacidad de atención a alumnos en relación a talleres y laboratorios.";
		$tercer['porcentaje']   = 30;
		$tercer['descripcion']  = "Capacidad de atención a alumnos por talleres y laboratorios por unidad académica y semestre.";
		$tercer['metodo']       = "(Capacidad instalada de atención en laboratorios y talleres por el total de semestres, identificando la capacidad del taller o laboratorio con menor capacidad)";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Capacidad instalada de atención en laboratorios y talleres por el total de semestres, identificando la capacidad del taller o laboratorio con menor capacidad";
		$tercer['var2'] = "";

		// EL INDICADOR SI APLICA
		$bloque = $this->infraestructura->getInfraSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->CapacidadInstalada;
			$tercer['val2'] = 0;
			$pre       = ($pre+((($row->CapacidadInstalada))));
			$objPuente['var1'] = $row->CapacidadInstalada;
			$objPuente['var2'] = 0;
			$objPuente['calculo'] = ((($row->CapacidadInstalada)));
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	74.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Muy Malo	";
		$objeto[1][0]=	75	; $objeto[1][1]=	94.99	; $objeto[1][2]=	3	; $objeto[1][3] = "	Regular	";
		$objeto[2][0]=	95	; $objeto[2][1]=	105	; $objeto[2][2]=	5	; $objeto[2][3] = "	Muy Bueno	";
		$objeto[3][0]=	105.01	; $objeto[3][1]=	120	; $objeto[3][2]=	2	; $objeto[3][3] = "	Malo	";
		$objeto[4][0]=	120.01	; $objeto[4][1]=	200	; $objeto[4][2]=	1	; $objeto[4][3] = "	Muy Malo	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Aulas Equipadas";
		$tercer['porcentaje']   = 35;
		$tercer['descripcion']  = "Aulas equipadas conforme al modelo ideal por unidad académica (Cañón, Internet, Pantalla, Pizarrón, Butacas, Escritorio)";
		$tercer['metodo']       = "(Número de aulas equipadas por unidad académica/el total de aulas)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de aulas equipadas por unidad académica";
		$tercer['var2'] = "Total de aulas";

		// EL INDICADOR SI APLICA
		$bloque = $this->infraestructura->getInfraSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->NumeroAulas;
			$tercer['val2'] = $tercer['val2']+$row->TotalAulas;
			$objPuente['var1'] = $row->NumeroAulas;
			$objPuente['var2'] = $row->TotalAulas;
			$objPuente['calculo'] = 0;
			if($row->TotalAulas>0){
				$objPuente['calculo'] = ((($row->NumeroAulas)/($row->TotalAulas))*100);
				$pre       = ($pre+((($row->NumeroAulas)/($row->TotalAulas))*100));


			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	49.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	50	; $objeto[1][1]=	59.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	60	; $objeto[2][1]=	69.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	70	; $objeto[3][1]=	84.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	85	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Laboratorios Equipado.";
		$tercer['porcentaje']   = 35;
		$tercer['descripcion']  = "Laboratorios equipados conforme currícula por programa académico por unidad académica y año.";
		$tercer['metodo']       = "(Número de laboratorios equipados conforme currícula por programa académico / total de laboratorios por programa académico)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de laboratorios equipados conforme currícula por programa académico";
		$tercer['var2'] = "Total de laboratorios por programa académico";

		// EL INDICADOR SI APLICA
		$bloque = $this->infraestructura->getInfraSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->NumeroLaboratorios;
			$tercer['val2'] = $tercer['val2']+$row->TotalLaboratorios;
			$objPuente['var1'] = $row->NumeroLaboratorios;
			$objPuente['var2'] = $row->TotalLaboratorios;
			$objPuente['calculo'] = 0;
			if($row->TotalLaboratorios>0){
				$objPuente['calculo'] = ((($row->NumeroLaboratorios)/($row->TotalLaboratorios))*100);
				$pre       = ($pre+((($row->NumeroLaboratorios)/($row->TotalLaboratorios))*100));


			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	79.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	80	; $objeto[1][1]=	84.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	85	; $objeto[2][1]=	89.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	90	; $objeto[3][1]=	94.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	95	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

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



		$nivel               = array();
		$nivel['nombre']     = "APOYO";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "BECAS";
		$nivel['segundobloque']['porcentaje'] = 33;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Becas de Manutención";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Porcentaje de alumnos beneficiados con algún tipo  de beca registrada en el SIBA, por año y unidad académica";
		$tercer['metodo']       = "(Número de alumnos beneficiados con  algún tipo de beca  registrada en el SIBA, por año y unidad académica/matrícula total por unidad académica)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos beneficiados con  algun tipo de beca  rgistrada den el SIBA, por año y unidad académica";
		$tercer['var2'] = "Matrícula total por unidad académica";

		// EL INDICADOR SI APLICA
		$bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BBecas;
			$tercer['val2'] = $tercer['val2']+$row->BBecasT;
			$objPuente['calculo'] = 0;
			if($row->BBecasT>0){
				$pre       = ($pre+((($row->BBecas)/($row->BBecasT))*100));
				$objPuente['calculo'] = ((($row->BBecas)/($row->BBecasT))*100);
			}
			$objPuente['var1'] = $row->BBecas;
			$objPuente['var2'] = $row->BBecasT;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	19	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	20	; $objeto[1][1]=	29	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	30	; $objeto[2][1]=	39	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	40	; $objeto[3][1]=	49	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	50	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		$nivel               = array();
		$nivel['nombre']     = "APOYO";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "TUTORIAS";
		$nivel['segundobloque']['porcentaje'] = 33;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos Tutorados";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Porcentaje de alumnos tutorados por periodo escolar y  programa académico.";
		$tercer['metodo']       = "(Número de alumnos tutorados por periodo escolar / matrícula total )*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos tutorados por periodo escolar";
		$tercer['var2'] = "Matrícula total";

		// EL INDICADOR SI APLICA
		$bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BALumnosTutorados;
			$tercer['val2'] = $tercer['val2']+$row->BALumnosTutoradosT;
			$objPuente['calculo'] = 0;
			if(($row->BALumnosTutoradosT)>0){
				$pre       = ($pre+((($row->BALumnosTutorados)/($row->BALumnosTutoradosT))*100));
				$objPuente['calculo'] = ((($row->BALumnosTutorados)/($row->BALumnosTutoradosT))*100);

			}
			$objPuente['var1'] = $row->BALumnosTutorados;
			$objPuente['var2'] = $row->BALumnosTutoradosT;
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	19	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	20	; $objeto[1][1]=	29	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	30	; $objeto[2][1]=	39	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	40	; $objeto[3][1]=	49	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	50	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		$nivel               = array();
		$nivel['nombre']     = "APOYO";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "SERVICIO DE APOYO EDUCATIVO";
		$nivel['segundobloque']['porcentaje'] = 34;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Títulos Actualizados.";
		$tercer['porcentaje']   = 50;
		$tercer['descripcion']  = "Porcentaje de alumnos tutorados por periodo escolar y  programa académico.";
		$tercer['metodo']       = "(Número de títulos actualizados impresos o digitales por programa académico / Total del acervo bibliográfico por programa académico)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de títulos actualizados impresos o digitales por programa académico";
		$tercer['var2'] = " Total del acervo bibliográfico por programa académico";

		// EL INDICADOR NO APLICA

		$bloque = $this->apoyoserv->getApoyoSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->LibrosActualizados;
			$tercer['val2'] = $tercer['val2']+$row->TotalAcervoLibros;
			$objPuente['var1'] = $row->LibrosActualizados;
			$objPuente['var2'] = $row->TotalAcervoLibros;
			$objPuente['calculo'] = 0;
			if($row->TotalAcervoLibros>0){
				$objPuente['calculo'] = ((($row->LibrosActualizados)/($row->TotalAcervoLibros))*100);
				$pre       = ($pre+((($row->LibrosActualizados)/($row->TotalAcervoLibros))*100));

			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	19	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	20	; $objeto[1][1]=	29	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	30	; $objeto[2][1]=	39	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	40	; $objeto[3][1]=	49	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	50	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "CUMPLIMIENTO DEL PROGRAMA DE MANTENIMIENTO.";
		$tercer['porcentaje']   = 25;
		$tercer['descripcion']  = "Porcentaje de cumplimento del programa de mantenimiento.";
		$tercer['metodo']       = "(Número de servicios atendidos / Total servicios solicitados o programados por semestre)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de servicios atendidos";
		$tercer['var2'] = "Total servicios solicitados o programados por semestre";

		// EL INDICADOR NO APLICA

		$bloque = $this->apoyoserv->getApoyoSup($evaluacionid);

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
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	79	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	80	; $objeto[1][1]=	84	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	85	; $objeto[2][1]=	89	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	90	; $objeto[3][1]=	94	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	95	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "CUMPLIMIENTO DEL PROGRAMA DE LIMPIEZA.";
		$tercer['porcentaje']   = 25;
		$tercer['descripcion']  = "Porcentaje de cumplimento del programa de limpieza";
		$tercer['metodo']       = "(Número de servicios atendidos / Total servicios programados por semestre)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de servicios atendidos";
		$tercer['var2'] = "Total servicios programados por semestre";

		// EL INDICADOR NO APLICA

		$bloque = $this->apoyoserv->getApoyoSup($evaluacionid);

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
			$pre       = 0;
			if($row->LimpiezaProgramada>0){
				$objPuente['calculo'] = ((($row->LimpiezaAtendida)/($row->LimpiezaProgramada))*100);
				$pre       = ($pre+((($row->LimpiezaAtendida)/($row->LimpiezaProgramada))*100));


			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	79	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	80	; $objeto[1][1]=	84	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	85	; $objeto[2][1]=	89	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	90	; $objeto[3][1]=	94	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	95	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

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



		$nivel               = array();
		$nivel['nombre']     = "VINCULACION";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "SERVICIO SOCIAL";
		$nivel['segundobloque']['porcentaje'] = 35;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos Participando en Servicio Social";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Porcentaje  de alumnos  en alguno de los programas de servicio social por unidad académica.";
		$tercer['metodo']       = "(Número de alumnos participando en servicio social  por programa académico por año  / total de alumnos que deben hacer servicio social por programa académico)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos participando en sevicio social  por programa académico por año";
		$tercer['var2'] = "Total de alumnos que deben hacer servicio social por programa académico";

		// EL INDICADOR SI APLICA
		$bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BAlumnosSerSoc;
			$tercer['val2'] = $tercer['val2']+$row->BAlumnosSerSocT;
			$objPuente['calculo'] = 0;
			if($row->BAlumnosSerSocT>0){
				$pre       = ($pre+((($row->BAlumnosSerSoc)/($row->BAlumnosSerSocT))*100));
				$objPuente['calculo'] = ((($row->BAlumnosSerSoc)/($row->BAlumnosSerSocT))*100);
			}
			$objPuente['var1'] = $row->BAlumnosSerSoc;
			$objPuente['var2'] = $row->BAlumnosSerSocT;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	20	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	21	; $objeto[1][1]=	40	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	41	; $objeto[2][1]=	50	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	51	; $objeto[3][1]=	60	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	61	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		$nivel               = array();
		$nivel['nombre']     = "VINCULACION";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "PRACTICAS PROFESIONALES";
		$nivel['segundobloque']['porcentaje'] = 35;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Alumnos  Realizando Prácticas Profesionales.";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Porcentaje  de alumnos realizando prácticas profesionales por programa académico por año.";
		$tercer['metodo']       = "(Número de alumnos realizando prácticas profesionales  por programa académico por año/total de alumnos que deben hacer prácticas profesionales por programa académico)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de alumnos realizando prácticas profesionales  por programa académico por año";
		$tercer['var2'] = "Total de alumnos que deben hacer prácticas profesionales por programa académico";

		// EL INDICADOR SI APLICA
		$bloque                = $this->evaluacion->getEvaluacionesSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->BAlumnosPractProf;
			$tercer['val2'] = $tercer['val2']+$row->BAlumnosPractProfT;
			$objPuente['calculo'] = 0;
			if(($row->BAlumnosPractProfT)>0){
				$pre       = ($pre+((($row->BAlumnosPractProf)/($row->BAlumnosPractProfT))*100));
				$objPuente['calculo'] = ((($row->BAlumnosPractProf)/($row->BAlumnosPractProfT))*100);
			}
			$objPuente['var1'] = $row->BAlumnosPractProf;
			$objPuente['var2'] = $row->BAlumnosPractProfT;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	20	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	21	; $objeto[1][1]=	40	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	41	; $objeto[2][1]=	50	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	51	; $objeto[3][1]=	60	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	61	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		$nivel               = array();
		$nivel['nombre']     = "VINCULACION";
		$nivel['porcentaje'] = 15;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "PROYECTOS VINCULADOS";
		$nivel['segundobloque']['porcentaje'] = 30;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Proyectos Vinculados";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Tasa de variación del número de  proyectos vinculados por unidad académica.";
		$tercer['metodo']       = "(Número de proyectos vinculados por unidad académica por año/ Número de proyectos vinculados por unidad académica en el año inmediato anterior)-1)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de proyectos vinculados por unidad académica por año";
		$tercer['var2'] = "Número de proyectos vinculados por unidad académica en el año inmediato anterior";

		// EL INDICADOR NO APLICA
		$bloque = $this->modelvinculacion->getVinculadosSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->ProyectosVinculadosAct;
			$tercer['val2'] = $tercer['val2']+$row->ProyectosVinculadosAnt;
			$objPuente['calculo'] = 0;
			if(($row->ProyectosVinculadosAnt)>0){
				$pre       = ($pre+((($row->ProyectosVinculadosAct)/($row->ProyectosVinculadosAnt)-1)*100));
				$objPuente['calculo'] = ((($row->ProyectosVinculadosAct)/($row->ProyectosVinculadosAnt)-1)*100);
			}
			$objPuente['var1'] = $row->ProyectosVinculadosAct;
			$objPuente['var2'] = $row->ProyectosVinculadosAnt;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	-100	; $objeto[0][1]=	-0.1	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	0	; $objeto[1][1]=	0	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	1	; $objeto[2][1]=	100	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	100.1	; $objeto[3][1]=	200	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	200.1	; $objeto[4][1]=	1000	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

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




		$nivel               = array();
		$nivel['nombre']     = "INVESTIGACION";
		$nivel['porcentaje'] = 10;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "APOYO DE LA INVESTIGACION A LA DOCENCIA";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Profesores de carrera realizando investigación.";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Profesores  con dictamen de carrera (1/2, 3/4 y T.Completo) que participan en Proyectos de Investigación avalados por la SIP.";
		$tercer['metodo']       = "(Profesores contratados con dictamen de carrera que participan en Proyectos de Investigación avalados por la SIP/Total de Profesores de carrera de la Unidad Académica)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Profesores contratados con dictamén de carrera que participan en Proyectos de Investigación avalados por la SIP";
		$tercer['var2'] = "Total de Profesoress de carrera de la Unidad Académica";

		// EL INDICADOR NO APLICA
		$bloque = $this->investigacionmodel->getInvestigacionSup($evaluacionid);

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
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	4.9	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	5	; $objeto[1][1]=	9.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	10	; $objeto[2][1]=	19.9	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	20	; $objeto[3][1]=	29.9	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	30	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

		$tercer['calificacion'] = $this->limites->calcula($objeto, $tercer['calculo']); $tercer['calculoIndicador'] = (($tercer['calificacion']*($tercer['porcentaje']/100))/5)*100;
        $tercer['resultado'] = $this->limites->texto($objeto, $tercer['calculo']);

		// SE AGREGA EL TERCER BLOQUE A CADA NIVEL
		array_push($nivel['tercerbloque'], $tercer);

		//**************************************************************************************************************************************************************************************************//

		// SE AGREGA AL OBJETO PRINCIPAL
		$sumatoria = 0;foreach ($nivel['tercerbloque'] as $row) {$sumatoria= $sumatoria+$row['calculoIndicador'];}$nivel['segundobloque']['TotalDimension'] =  $sumatoria;$nivel['segundobloque']['calculoDimension'] =  ($sumatoria)*($nivel['segundobloque']['porcentaje']/100);array_push($calculo, $nivel);

		//**************************************************************************************************************************************************************************************************//

		$nivel               = array();
		$nivel['nombre']     = "INVESTIGACION";
		$nivel['porcentaje'] = 10;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "INNOVACION E INVESTIGACION EDUCATIVA";
		$nivel['segundobloque']['porcentaje'] = 50;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//


		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "Innovaciones Educativas.";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Tasa de variación del  número de Innovaciones educativas identificadas, incubadas o escaladas por unidad académica.";
		$tercer['metodo']       = "(Número de innovaciones educativas identificadas,  incubadas o escaladas por unidad académica y por año/ el total de innovaciones educativas identificadas, incubadas o escaladas por unidad académica del año inmediato anterior) -1)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Número de innovaciones educativas identificadas,  incubadas o escaladas por unidad académica y por año";
		$tercer['var2'] = "El total de innovaciones educativas identificadas, incubadas o escaladas por unidad académica del año inmediato anterior";

		// EL INDICADOR NO APLICA
		$bloque = $this->investigacionmodel->getInnovacionSup($evaluacionid);

		// EL CALCULO SE PROMEDIA
		$tercer['val1'] = 0; $tercer['val2'] = 0;
		$pre       = 0;
		$tamanoRow = 0;$objCalculosIngresados = array();$objPuente = array();
		foreach ($bloque as $row) {
			$tamanoRow = count($bloque);
			$tercer['val1'] = $tercer['val1']+$row->InnovacionesIncubadas;
			$tercer['val2'] = $tercer['val2']+$row->InnovacionesIncubadasAnt;

			$objPuente['calculo'] = 0;
			if(($row->InnovacionesIncubadasAnt)>0){
				$pre       = ($pre+((($row->InnovacionesIncubadas)/($row->InnovacionesIncubadasAnt)-1)*100));
				$objPuente['calculo'] = ((($row->InnovacionesIncubadas)/($row->InnovacionesIncubadasAnt)-1)*100);
			}
			$objPuente['var1'] = $row->InnovacionesIncubadas;
			$objPuente['var2'] = $row->InnovacionesIncubadasAnt;

			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	-100	; $objeto[0][1]=	19.99	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	20	; $objeto[1][1]=	29.99	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	30	; $objeto[2][1]=	39.99	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	40	; $objeto[3][1]=	49.99	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	50	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

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




		$nivel               = array();
		$nivel['nombre']     = "GESTION ADMINISTRATIVA";
		$nivel['porcentaje'] = 10;
		//SEGUNDO NIVEL
		$nivel['segundobloque'] = array();

		//PRIMER INDICADOR - Docentes
		$nivel['segundobloque']['nombre']     = "RECURSOS AUTOGENERADOS";
		$nivel['segundobloque']['porcentaje'] = 100;
		//SE OBTIENEN OBJETO COMPLETO DE ALUMNOS
		$nivel['tercerbloque'] = array();

		$tercer = array();

		//**************************************************************************************************************************************************************************************************//

		//SE CREA ARRAY PARA TERCER BLOQUE
		$tercer['nombre']       = "% de  Recursos autogenerados netos dedicados al  mantenimiento del inmueble y mantenimiento del equipo";
		$tercer['porcentaje']   = 100;
		$tercer['descripcion']  = "Monto de los recursos autogenerados que se destinan al pago de servicios de mantenimiento del inmueble y mantenimiento del equipo.";
		$tercer['metodo']       = "(Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo / total de los recursos autogenerados anualmente)*100";
		$tercer['calculo']      = 0;
		$tercer['calificacion'] = 0;
		$tercer['var1'] = "Recursos ejercidos en las partidas de mantenimiento de inmuebles y equipo";
		$tercer['var2'] = "Total de los recursos autogenerados anualmente";

		// EL INDICADOR NO APLICA
		$bloque = $this->recursos->getRecursosSup($evaluacionid);

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
			if($row->RecursosAutogenerados){
				$objPuente['calculo'] = ((($row->RecursosEjercidos)/($row->RecursosAutogenerados))*100);
				$pre       = ($pre+((($row->RecursosEjercidos)/($row->RecursosAutogenerados))*100));


			}
			array_push($objCalculosIngresados, $objPuente);
		}
		$tercer['variables'] = $objCalculosIngresados; if($tercer['val2']>0){$tercer['calculo'] = ($tercer['val1']/$tercer['val2'])*100;}else{$tercer['calculo']=0;}

		$objeto = array();
        $objeto[0] = array();
        $objeto[1] = array();
        $objeto[2] = array();
        $objeto[3] = array();
        $objeto[4] = array();

        $objeto[0][0]=	0.01	; $objeto[0][1]=	9.9	; $objeto[0][2]=	1	; $objeto[0][3] = "	Malo	";
		$objeto[1][0]=	10	; $objeto[1][1]=	14.9	; $objeto[1][2]=	2	; $objeto[1][3] = "	Suficiente	";
		$objeto[2][0]=	15	; $objeto[2][1]=	19.9	; $objeto[2][2]=	3	; $objeto[2][3] = "	Regular	";
		$objeto[3][0]=	20	; $objeto[3][1]=	24.9	; $objeto[3][2]=	4	; $objeto[3][3] = "	Bueno 	";
		$objeto[4][0]=	25	; $objeto[4][1]=	100	; $objeto[4][2]=	5	; $objeto[4][3] = "	Muy Bueno	";

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
		// pegar aqui la linea de 5

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
									$data['main_cont'] = 'consultasup/resultados';
									$this->load->view('includes/template_consultasup2', $data);
								}


								if($genTipo=="previos"){
									$data['main_cont'] = 'consultasup/previos';
									$this->load->view('includes/template_consultasup2', $data);
								}


								if($genTipo=="reportedetallado"){
									$data['main_cont'] = 'reportes/sup/detallado';
									$html=$this->load->view('includes/template_reportes2', $data, true);
									$pdfFilePath = "detallado.pdf";
									$this->load->library('m_pdf');
									// $this->m_pdf->pdf->AddPage('L','', '', '', '',5);
									$this->m_pdf->pdf->WriteHTML($html);
									$this->m_pdf->pdf->Output($pdfFilePath, "D");
								}

								if($genTipo=="reporteconsolidado"){
									$data['main_cont'] = 'reportes/sup/consolidados';
									$html=$this->load->view('includes/template_reportes', $data, true);
									$pdfFilePath = "consolidados.pdf";
									$this->load->library('m_pdf');
									$this->m_pdf->pdf->WriteHTML($html);
									$this->m_pdf->pdf->Output($pdfFilePath, "D");
								}

								if($genTipo=="reportefunciones"){
									$data['main_cont'] = 'reportes/sup/funciones';
									$html=$this->load->view('includes/template_reportes', $data, true);
									$pdfFilePath = "funciones.pdf";
									$this->load->library('m_pdf');
									$this->m_pdf->pdf->WriteHTML($html);
									$this->m_pdf->pdf->Output($pdfFilePath, "D");
								}


		//**************************************************************************************************************************************************************************************************//

	}

	public function check() {
		$data['datos'] = $this->session->userdata('logged_in');
		$urlRed        = "consultasup/rev/".$this->input->post('idUnidad');
		redirect($urlRed, 'refresh');
	}

	public function rev() {
		$data['datos']        = $this->session->userdata('logged_in');
		$data['evaluaciones'] = $this->evaluacion->getEvaluacionesSuperiorEscuela($this->uri->segment(3));
		$data['unidad']       = $this->unidades->getUnidad($this->uri->segment(3));
		$data['main_cont']    = 'consultasup/rev';
		$this->load->view('includes/template_consultasup', $data);
	}

	public function consulta1() {

		if ($this->session->userdata('logged_in')) {
			$data['datos']                 = $this->session->userdata('logged_in');
			$data['datos']['idUnidad']     = $this->uri->segment(3);
			$data['datos']['idEvaluacion'] = $this->uri->segment(4);
			$data['datos']['Nivel']        = "SUP";
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
					$result                = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacion;
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

						$data['main_cont'] = 'desempeno/index';
						$this->load->view('includes/template_principal', $data);
					} else {
						redirect('login', 'refresh');
					}
				} else {
					//SUPERIOR
					//Se valida si el registro pertenece a la unidad
					$result                = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
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

	public function consulta2() {
		if ($this->session->userdata('logged_in')) {
			$data['datos']                 = $this->session->userdata('logged_in');
			$data['datos']['idUnidad']     = $this->uri->segment(3);
			$data['datos']['idEvaluacion'] = $this->uri->segment(4);
			$data['datos']['Nivel']        = "SUP";
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
					$result                = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacion;
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
					$result                = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacionSup;
					$data['evaluacionObj'] = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					// if(count($eval)>0){$this->verify->evaluacion($eval[0]->estado);}

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

						$data['main_cont'] = 'oferta/consultasup';
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

	public function consulta3() {
		if ($this->session->userdata('logged_in')) {
			$data['datos']                 = $this->session->userdata('logged_in');
			$data['datos']['idUnidad']     = $this->uri->segment(3);
			$data['datos']['idEvaluacion'] = $this->uri->segment(4);
			$data['datos']['Nivel']        = "SUP";
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
					$result                = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacion;
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
					$result                = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacionSup;
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
			$data['datos']                 = $this->session->userdata('logged_in');
			$data['datos']['idUnidad']     = $this->uri->segment(3);
			$data['datos']['idEvaluacion'] = $this->uri->segment(4);
			$data['datos']['Nivel']        = "SUP";
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
					$result                = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacion;
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
					$result                = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacionSup;
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
			$data['datos']                 = $this->session->userdata('logged_in');
			$data['datos']['idUnidad']     = $this->uri->segment(3);
			$data['datos']['idEvaluacion'] = $this->uri->segment(4);
			$data['datos']['Nivel']        = "SUP";
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
					$result                = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacion;
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
					$result                = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacionSup;
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
			$data['datos']                 = $this->session->userdata('logged_in');
			$data['datos']['idUnidad']     = $this->uri->segment(3);
			$data['datos']['idEvaluacion'] = $this->uri->segment(4);
			$data['datos']['Nivel']        = "SUP";
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
					$result                = $this->evaluacion->getEvaluacionId($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacion($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacion;
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
					$result                = $this->evaluacion->getEvaluacionIdSup($idUrl, $data['datos']['idUnidad']);
					$eval                  = $this->evaluacion->getLastEvaluacionSup($data['datos']['idUnidad']);
					$idUrl                 = $eval[0]->idEvaluacionSup;
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

	public function updatecomentario() {

		$objeto = array(
			'tabla'        => $this->input->post('tabla'),
			'idEvaluacion' => $this->input->post('idEvaluacion'),
			'idUnidad'     => $this->input->post('idUnidad'),
			'comentarios'  => $this->input->post('comentarios'),
		);

		$this->evaluacion->update_comentarios($objeto);

		$longitud = strlen(str_replace(' ', '', $this->input->post('comentarios')));

		if ($longitud == 0) {
			$objeto2 = array(
				'columna'      => $this->input->post('comentario'),
				'idEvaluacion' => $this->input->post('idEvaluacion'),
				'cn'           => 1,
			);
			$this->evaluacion->update_cn_sup($objeto2);
		} else {
			$objeto2 = array(
				'columna'      => $this->input->post('comentario'),
				'idEvaluacion' => $this->input->post('idEvaluacion'),
				'cn'           => 2,
			);
			$this->evaluacion->update_cn_sup($objeto2);
		}

		redirect($this->input->post('redirect'), 'refresh');
	}

	public function updateEstadoSup() {

		$data = array(
			'idEvaluacionSup' => $this->uri->segment(3),
			'estado'          => 'ACT',
		);

		print_r($data);

		$this->evaluacion->update_ev_sup($data);

		redirect('consultasup', 'refresh');
	}

	public function finalizarEstadoSup() {

		$data = array(
			'idEvaluacionSup' => $this->uri->segment(3),
			'estado'          => 'FIN',
		);

		print_r($data);

		$this->evaluacion->update_ev_sup($data);

		redirect('consultasup', 'refresh');
	}

}
