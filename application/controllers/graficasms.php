<?php
if ( ! defined('BASEPATH'))
	exit('No direct script access allowed');

class Graficasms extends CI_Controller
{

	function __construct() {
		parent::__construct();
		//SE VERIFICA LA SESION
		$data['datos'] = $this->session->userdata('logged_in');
		$this->load->library('verify');
		$this->load->library('limites');
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
		$data['home'] = strtolower(__CLASS__).'/';
		$this->load->vars($data);
	}


function index()
	{
		$data['datos']     = $this->session->userdata('logged_in');
		$data['unidades']  = $this->unidades->getUnidades('MED');

		$graph_data = $this->_data();

		$data['promedioGeneral'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADOS GENERALES %'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}


		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['chartsG'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************

		$graph_data = $this->_indicador(0,0);

		$data['nombre'] = $graph_data['nombre'];
		$data['promedio'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************


		$graph_data = $this->_indicador(0,1);

		$data['nombre1'] = $graph_data['nombre'];
		$data['promedio1'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts1'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************

		$graph_data = $this->_indicador(0,2);

		$data['nombre2'] = $graph_data['nombre'];
		$data['promedio2'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts2'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************


		$graph_data = $this->_indicador(0,3);

		$data['nombre3'] = $graph_data['nombre'];
		$data['promedio3'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts3'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************








		$graph_data = $this->_indicador(1,0);

		$data['nombre4'] = $graph_data['nombre'];
		$data['promedio4'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts4'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************










		$graph_data = $this->_indicador(1,1);

		$data['nombre5'] = $graph_data['nombre'];
		$data['promedio5'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts5'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************



		$graph_data = $this->_indicador(1,2);

		$data['nombre6'] = $graph_data['nombre'];
		$data['promedio6'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts6'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************


		$graph_data = $this->_indicador(1,3);

		$data['nombre7'] = $graph_data['nombre'];
		$data['promedio7'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts7'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************









		$graph_data = $this->_indicador(2,0);

		$data['nombre8'] = $graph_data['nombre'];
		$data['promedio8'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts8'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************









		$graph_data = $this->_indicador(3,0);

		$data['nombre9'] = $graph_data['nombre'];
		$data['promedio9'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts9'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************


		$graph_data = $this->_indicador(3,1);

		$data['nombre10'] = $graph_data['nombre'];
		$data['promedio10'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts10'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************












		$graph_data = $this->_indicador(3,2);

		$data['nombre11'] = $graph_data['nombre'];
		$data['promedio11'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts11'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************





		$graph_data = $this->_indicador(4,0);

		$data['nombre12'] = $graph_data['nombre'];
		$data['promedio12'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts12'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************

		$graph_data = $this->_indicador(5,0);

		$data['nombre13'] = $graph_data['nombre'];
		$data['promedio13'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts13'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************




		$graph_data = $this->_indicador(6,0);

		$data['nombre14'] = $graph_data['nombre'];
		$data['promedio14'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts14'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************






		$graph_data = $this->_indicador(6,1);

		$data['nombre15'] = $graph_data['nombre'];
		$data['promedio15'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts15'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************








		$graph_data = $this->_indicador(6,2);

		$data['nombre16'] = $graph_data['nombre'];
		$data['promedio16'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts16'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************

		$graph_data = $this->_indicador(6,3);

		$data['nombre17'] = $graph_data['nombre'];
		$data['promedio17'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts17'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************

		$graph_data = $this->_indicador(6,4);

		$data['nombre18'] = $graph_data['nombre'];
		$data['promedio18'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
			$this->highcharts->set_serie($graph_data[$row->Siglas]);
		}

		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts18'] = $this->highcharts->render(); // we render js and div in same time

		// **************************************************************************************************************************








				$graph_data = $this->_indicador(7,0);

				$data['nombre19'] = $graph_data['nombre'];
				$data['promedio19'] = $graph_data['promedio'];

				$this->load->library('highcharts');

				$this->highcharts->set_type('column'); // drauwing type
				$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
				$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

				$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
				foreach ($data['unidades'] as $row) {
					// print_r($row->Siglas);
					$this->highcharts->set_serie($graph_data[$row->Siglas]);
				}

				@$credits->text = "";
				$this->highcharts->set_credits($credits);

				// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

				$data['charts19'] = $this->highcharts->render(); // we render js and div in same time

				// **************************************************************************************************************************










						$graph_data = $this->_indicador(8,0);

						$data['nombre20'] = $graph_data['nombre'];
						$data['promedio20'] = $graph_data['promedio'];

						$this->load->library('highcharts');

						$this->highcharts->set_type('column'); // drauwing type
						$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
						$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

						$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
						foreach ($data['unidades'] as $row) {
							// print_r($row->Siglas);
							$this->highcharts->set_serie($graph_data[$row->Siglas]);
						}

						@$credits->text = "";
						$this->highcharts->set_credits($credits);

						// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

						$data['charts20'] = $this->highcharts->render(); // we render js and div in same time

						// **************************************************************************************************************************













								$graph_data = $this->_indicador(9,0);

								$data['nombre21'] = $graph_data['nombre'];
								$data['promedio21'] = $graph_data['promedio'];

								$this->load->library('highcharts');

								$this->highcharts->set_type('column'); // drauwing type
								$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
								$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

								$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
								foreach ($data['unidades'] as $row) {
									// print_r($row->Siglas);
									$this->highcharts->set_serie($graph_data[$row->Siglas]);
								}

								@$credits->text = "";
								$this->highcharts->set_credits($credits);

								// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

								$data['charts21'] = $this->highcharts->render(); // we render js and div in same time

								// **************************************************************************************************************************




								$graph_data = $this->_indicador(10,0);

								$data['nombre22'] = $graph_data['nombre'];
								$data['promedio22'] = $graph_data['promedio'];

								$this->load->library('highcharts');

								$this->highcharts->set_type('column'); // drauwing type
								$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
								$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

								$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
								foreach ($data['unidades'] as $row) {
									// print_r($row->Siglas);
									$this->highcharts->set_serie($graph_data[$row->Siglas]);
								}

								@$credits->text = "";
								$this->highcharts->set_credits($credits);

								// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

								$data['charts22'] = $this->highcharts->render(); // we render js and div in same time

								// **************************************************************************************************************************




								$graph_data = $this->_indicador(11,0);

								$data['nombre23'] = $graph_data['nombre'];
								$data['promedio23'] = $graph_data['promedio'];

								$this->load->library('highcharts');

								$this->highcharts->set_type('column'); // drauwing type
								$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
								$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

								$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
								foreach ($data['unidades'] as $row) {
									// print_r($row->Siglas);
									$this->highcharts->set_serie($graph_data[$row->Siglas]);
								}

								@$credits->text = "";
								$this->highcharts->set_credits($credits);

								// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

								$data['charts23'] = $this->highcharts->render(); // we render js and div in same time

								// **************************************************************************************************************************






								$graph_data = $this->_indicador(12,0);

								$data['nombre24'] = $graph_data['nombre'];
								$data['promedio24'] = $graph_data['promedio'];

								$this->load->library('highcharts');

								$this->highcharts->set_type('column'); // drauwing type
								$this->highcharts->set_title('RESULTADO POR INDICADOR'); // set chart title: title, subtitle(optional)
								$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

								$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
								foreach ($data['unidades'] as $row) {
									// print_r($row->Siglas);
									$this->highcharts->set_serie($graph_data[$row->Siglas]);
								}

								@$credits->text = "";
								$this->highcharts->set_credits($credits);

								// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

								$data['charts24'] = $this->highcharts->render(); // we render js and div in same time

								// **************************************************************************************************************************






		$data['main_cont'] = 'consultams/graficas';
		$this->load->view('includes/template_consultams3', $data);
	}





	// REPORTE GENERAL
	function _data()
	{
		$data['unidades']  = $this->unidades->getUnidades('MED');
		$promedio = 0;
		$contador = 0;
		foreach ($data['unidades'] as $row) {
			$datos = $this->_calculo($row->idUnidad);
			if($datos['res']==1){
				$contador = $contador+1;
				// print_r($datos['std']['calculo'][0]['segundobloque']);
				// print_r($datos['std']['calculo'][1]['segundobloque']);
				$acumulado = 0;
				foreach ($datos['std']['resumen']['bloque'] as  $row2) {
					$acumulado = $acumulado+$row2['total'];
				}
				$promedio = $promedio+$acumulado;
				$data[$row->Siglas]['data'] = array($acumulado);
				$data[$row->Siglas]['name'] = $row->Siglas;

			}else{
				$data[$row->Siglas]['data'] = array(0);
				$data[$row->Siglas]['name'] = $row->Siglas;

			}

		}


		if($contador>0){
			$data['promedio'] = $promedio/$contador;
		}else{
			$data['promedio'] = "NO HAY DATOS QUE PROMEDIAR";
		}
		$data['axis']['categories'] = array('Indicador');

		return $data;
	}




		// REPORTE INDICADOR
		function _indicador($v1, $v2)
		{
			$data['unidades']  = $this->unidades->getUnidades('MED');
			$promedio = 0;
			$contador = 0;
			foreach ($data['unidades'] as $row) {
				$datos = $this->_calculo($row->idUnidad);
				// print_r($datos['std']['calculo'][$v1]['tercerbloque'][$v2]['nombre']);
				$data['nombre'] = $datos['std']['calculo'][$v1]['tercerbloque'][$v2]['nombre'];
				// echo "<hr>";
				if($datos['res']==1){
					$contador = $contador+1;
					// print_r($datos['std']['calculo'][$v1]['tercerbloque'][$v2]);
					$data['nombre'] = $datos['std']['calculo'][$v1]['tercerbloque'][$v2]['nombre'];
					// echo "<hr>";
					$promedio = $promedio+$datos['std']['calculo'][$v1]['tercerbloque'][$v2]['calificacion'];
					$data[$row->Siglas]['data'] = array($datos['std']['calculo'][$v1]['tercerbloque'][$v2]['calificacion']);
					$data[$row->Siglas]['name'] = $row->Siglas;

				}else{
					// $data['nombre'] = $datos['std']['calculo'][$v1]['tercerbloque'][$v2]['nombre'];
					$data[$row->Siglas]['data'] = array(0);
					$data[$row->Siglas]['name'] = $row->Siglas;

				}

			}


			if($contador>0){
				$data['promedio'] = $promedio/$contador;
			}else{
				$data['promedio'] = "NO HAY DATOS QUE PROMEDIAR";
			}
			$data['axis']['categories'] = array('UNIDAD');

			return $data;
		}





	//CALCULO DE INDICADORES
function _calculo($idEscuela) {
	$datos["res"] = 1;
	$data['datos'] = $this->session->userdata('logged_in');
	$evaluacionObj = $this->evaluacion->getLastEvaluacion($idEscuela);
	$evaluacionid  = 0;
	if(count($evaluacionObj)>0){
		$evaluacionid = $evaluacionObj[0]->idEvaluacion;
	}else {
		$datos["res"] = 0;
	}


	switch ($evaluacionObj[0]->estado) {
					case "ACT":
									$datos["res"] = 0;
									break;
					case "REV":
									$datos["res"] = 1;
									break;
					case "FIN":
									$datos["res"] = 1;
									break;
					case "RES":
									$datos["res"] = 1;
									break;
					case "CAN":
									$datos["res"] = 0;
									break;
					default:
									$datos["res"] = 0;
									break;



	}


	// echo "<br>";
	$idUnidad = $idEscuela;
	$carreras = $this->evaluacion->getBloque($idUnidad);
// echo $evaluacionid;
// echo "<br>";



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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;}
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
	$objPuente['calculo'] = ((($row->BEficienciaTerminal)/($row->BEficienciaTerminalT))*100);
	$pre       = ($pre+((($row->BEficienciaTerminal)/($row->BEficienciaTerminalT))*100));
}
array_push($objCalculosIngresados, $objPuente);
}
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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


					$datos['std'] = $data;

					return $datos;




//**************************************************************************************************************************************************************************************************//

}



}
