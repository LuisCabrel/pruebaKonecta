<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {
	public function index()
	{
		$this->load->model('productos_model');
		$data['productos']=$this->productos_model->listaproductos();
		$this->load->view('carrito',$data);
	}

	public function comprar()
	{
		$this->load->model('productos_model');

		$idproducto=$this->input->post('producto_id');
		$cantidad=$this->input->post('cant');
		$totalPago=$this->input->post('total');
		if($cantidad>0 && $idproducto>0){
			$validaStock = $this->productos_model->validaStock($idproducto,$cantidad); 
			if($validaStock >0){
				$res = $this->productos_model->comprar($idproducto,$cantidad,$totalPago);
				if($res){
					$resp['error'] =0;
					$resp['msn'] ='Su compra se realizó con éxito';
				}else{
					$resp['error'] =1;
					$resp['msn'] ='ERROR, intente nuevamente';
				}
			}else{
				$resp['error'] =1;
				$resp['msn'] ='Disculpe No contamos con el stock suficiente';
			}
			
		}else{
			$resp['error'] =1;
			$resp['msn'] ='Hay campos vacios';
		}
		echo json_encode($resp);
	}
}