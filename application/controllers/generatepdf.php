<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generatepdf extends CI_Controller {

    public function index()
    {
        $data = [];
        $html=$this->load->view('permiso', $data, true);
        $pdfFilePath = "output_pdf_name.pdf";
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
}
