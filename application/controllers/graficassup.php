<?php
if ( ! defined('BASEPATH'))
	exit('No direct script access allowed');

class Graficassup extends CI_Controller
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
		$data['unidades']  = $this->unidades->getUnidades('SUP');


		$graph_data = $this->_data();

		$data['promedioGeneral'] = $graph_data['promedio'];

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('RESULTADOS GENERALES %'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		foreach ($data['unidades'] as $row) {
			// print_r($row->Siglas);
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


		$graph_data = $this->_indicador(0,4);

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










		$graph_data = $this->_indicador(1,0);

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



		$graph_data = $this->_indicador(1,1);

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


		$graph_data = $this->_indicador(1,2);

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


		$graph_data = $this->_indicador(1,3);

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









		$graph_data = $this->_indicador(2,0);

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


		$graph_data = $this->_indicador(2,1);

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












		$graph_data = $this->_indicador(3,0);

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

		$graph_data = $this->_indicador(3,1);

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

		$graph_data = $this->_indicador(3,2);

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




		$graph_data = $this->_indicador(4,0);

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






		$graph_data = $this->_indicador(5,0);

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








		$graph_data = $this->_indicador(6,0);

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

		$graph_data = $this->_indicador(6,1);

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

		$graph_data = $this->_indicador(6,2);

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






		$data['main_cont'] = 'consultasup/graficas';
		$this->load->view('includes/template_consultasup3', $data);
	}



	// REPORTE GENERAL
	function _data()
	{
		$data['unidades']  = $this->unidades->getUnidades('SUP');
		$promedio = 0;
		$contador = 0;
		foreach ($data['unidades'] as $row) {
			$datos = $this->_calculo($row->idUnidad);
			if($datos['res']==1){
				$contador = $contador+1;
				// print_r($datos['std']['calculo'][0]['tercerbloque']);
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
		$data['unidades']  = $this->unidades->getUnidades('SUP');
		$promedio = 0;
		$contador = 0;
		foreach ($data['unidades'] as $row) {
			$datos = $this->_calculo($row->idUnidad);
			$data['nombre'] = $datos['std']['calculo'][$v1]['tercerbloque'][$v2]['nombre'];
			if($datos['res']==1){
				$contador = $contador+1;
				// print_r($datos['std']['calculo'][$v1]['tercerbloque'][$v2]);
				$data['nombre'] = $datos['std']['calculo'][$v1]['tercerbloque'][$v2]['nombre'];
				// echo "<hr>";
				$promedio = $promedio+$datos['std']['calculo'][$v1]['tercerbloque'][$v2]['calificacion'];
				$data[$row->Siglas]['data'] = array($datos['std']['calculo'][$v1]['tercerbloque'][$v2]['calificacion']);
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
		$data['axis']['categories'] = array('UNIDAD');

		return $data;
	}









	//CALCULO DE INDICADORES
	function _calculo($idEscuela) {
		$datos["res"] = 1;
		$data['datos'] = $this->session->userdata('logged_in');
		$evaluacionObj = $this->evaluacion->getLastEvaluacionSup($idEscuela);
		$evaluacionid  = 0;
		if(count($evaluacionObj)>0){
			$evaluacionid = $evaluacionObj[0]->idEvaluacionSup;
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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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
		if($tamanoRow>0){$tercer['calculo'] = $pre/$tamanoRow;} $tercer['variables'] = $objCalculosIngresados;

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

								$datos['std'] = $data;

								return $datos;


		//**************************************************************************************************************************************************************************************************//

	}



}
