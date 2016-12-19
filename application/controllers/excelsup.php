
<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Excelsup extends CI_Controller {
  	function __construct() {
      parent::__construct();
          $this->load->model('unidades', '', TRUE);
          $this->load->library('excel');
    }


  public function index() {
    $this->load->view('test');

  }


  public function download(){
    $data = $this->unidades->getUnidades('MED');
    $this->excel->to_excel($data, 'unidades');

  }



}
