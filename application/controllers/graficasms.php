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

		$graph_data = $this->_data();

		$this->load->library('highcharts');

		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('INDICADOR TEST'); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('Calificación', 'RRESULTADOS'); // axis titles: x axis,  y axis

		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		$this->highcharts->set_serie($graph_data['Escuela1']); // the first serie
		$this->highcharts->set_serie($graph_data['Escuela2']); // second serie
		$this->highcharts->set_serie($graph_data['Escuela3']); // second serie
		$this->highcharts->set_serie($graph_data['Escuela4']); // the first serie
		$this->highcharts->set_serie($graph_data['Escuela5']); // second serie
		$this->highcharts->set_serie($graph_data['Escuela6']); // second serie
		$this->highcharts->set_serie($graph_data['Escuela7']); // the first serie
		$this->highcharts->set_serie($graph_data['Escuela8']); // second serie
		$this->highcharts->set_serie($graph_data['Escuela9']); // second serie


		@$credits->text = "";
		$this->highcharts->set_credits($credits);

		// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

		$data['charts'] = $this->highcharts->render(); // we render js and div in same time

$data['charts2'] = "hola";

$graph_data = $this->_data2();
$this->highcharts->set_type('column'); // drauwing type
$this->highcharts->set_title('INDICADOR TEST'); // set chart title: title, subtitle(optional)
$this->highcharts->set_axis_titles('Calificación', 'RRESULTADOS'); // axis titles: x axis,  y axis

$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
$this->highcharts->set_serie($graph_data['Escuela1']); // the first serie
$this->highcharts->set_serie($graph_data['Escuela2']); // second serie
$this->highcharts->set_serie($graph_data['Escuela3']); // second serie
$this->highcharts->set_serie($graph_data['Escuela4']); // the first serie
$this->highcharts->set_serie($graph_data['Escuela5']); // second serie
$this->highcharts->set_serie($graph_data['Escuela6']); // second serie
$this->highcharts->set_serie($graph_data['Escuela7']); // the first serie
$this->highcharts->set_serie($graph_data['Escuela8']); // second serie
$this->highcharts->set_serie($graph_data['Escuela9']); // second serie


@$credits->text = "";
$this->highcharts->set_credits($credits);

// $this->highcharts->render_to('my_div'); // choose a specific div to render to graph

$data['charts3'] = $this->highcharts->render(); // we render js and div in same time




		$data['main_cont'] = 'consultams/graficas';
		$this->load->view('includes/template_consultams3', $data);
	}



	// HELPERS FUNCTIONS
	/**
	 * _data function.
	 * data for examples
	 */
	function _data()
	{
		$data['Escuela1']['data'] = array(536564837);
		$data['Escuela1']['name'] = 'Escuela1';
		$data['Escuela2']['data'] = array(1277528133);
		$data['Escuela2']['name'] = 'Escuela2';
		$data['Escuela3']['data'] = array(536564837);
		$data['Escuela3']['name'] = 'Escuela3';
		$data['Escuela4']['data'] = array(1277528133);
		$data['Escuela4']['name'] = 'Escuela4';
		$data['Escuela5']['data'] = array(536564837);
		$data['Escuela5']['name'] = 'Escuela5';
		$data['Escuela6']['data'] = array(1277528133);
		$data['Escuela6']['name'] = 'Escuela6';
		$data['Escuela7']['data'] = array(536564837);
		$data['Escuela7']['name'] = 'Escuela7';
		$data['Escuela8']['data'] = array(1277528133);
		$data['Escuela8']['name'] = 'Escuela8';
		$data['Escuela9']['data'] = array(536564837);
		$data['Escuela9']['name'] = 'Escuela9';
		$data['axis']['categories'] = array('Indicador');

		return $data;
	}



	function _data2()
	{
		$data['Escuela1']['data'] = array(10);
		$data['Escuela1']['name'] = 'Escuela1';
		$data['Escuela2']['data'] = array(3);
		$data['Escuela2']['name'] = 'Escuela2';
		$data['Escuela3']['data'] = array(5);
		$data['Escuela3']['name'] = 'Escuela3';
		$data['Escuela4']['data'] = array(9);
		$data['Escuela4']['name'] = 'Escuela4';
		$data['Escuela5']['data'] = array(13);
		$data['Escuela5']['name'] = 'Escuela5';
		$data['Escuela6']['data'] = array(2);
		$data['Escuela6']['name'] = 'Escuela6';
		$data['Escuela7']['data'] = array(7);
		$data['Escuela7']['name'] = 'Escuela7';
		$data['Escuela8']['data'] = array(4);
		$data['Escuela8']['name'] = 'Escuela8';
		$data['Escuela9']['data'] = array(9);
		$data['Escuela9']['name'] = 'Escuela9';
		$data['axis']['categories'] = array('Indicador');

		return $data;
	}



}
