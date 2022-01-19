<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	public function index()
	{
		$this->load->model('productos_model');
		$data['conMasStock']=$this->productos_model->conMasStock();
		$data['masVendido']=$this->productos_model->masVendido();
		$this->load->view('reportes',$data);
	}

}