<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	
	public function index()
	{
		$this->load->model('productos_model');
		$data['categoria']=$this->productos_model->categorias();
		$this->load->view('productos',$data);
	}

	public function registrar()
	{
		$this->load->model('productos_model');

		$nombre=$this->input->post('nombre');
		$referencia=$this->input->post('referencia');
		$precio=$this->input->post('precio');
		$peso=$this->input->post('peso');
		$stock=$this->input->post('stock');
		$categoria=$this->input->post('categoria');

		if($nombre !='' && $referencia !='' && $precio !='' && $peso !='' && $stock !='' && $categoria !=''){
			$valores =array(
				'producto_nombre'=>$nombre,
				'producto_referencia'=>$referencia,
				'producto_precio'=>$precio,
				'producto_peso'=>$peso,
				'categoria_id'=>$categoria,
				'producto_stock'=>$stock,
			);
			$res = $this->productos_model->guardar($valores);
			if($res){
				$resp['error'] =0;
				$resp['msn'] ='Datos guardado correctamente';
			}else{
				$resp['error'] =1;
				$resp['msn'] ='ERROR, intente nuevamente';
			}
		}else{
			$resp['error'] =1;
			$resp['msn'] ='Hay campos vacios';
		}
		echo json_encode($resp);
	}

	public function listaproductos()
	{
		$this->load->model('productos_model');
		$productos=$this->productos_model->listaproductos();
		echo json_encode($productos);
	}

	public function editar()
	{
		$this->load->model('productos_model');

		$idproducto=$this->input->post('idproducto');
		$nombre=$this->input->post('nombre_edit');
		$referencia=$this->input->post('referencia_edit');
		$precio=$this->input->post('precio_edit');
		$peso=$this->input->post('peso_edit');
		$stock=$this->input->post('stock_edit');
		$categoria=$this->input->post('categoria_edit');

		if($nombre !='' && $referencia !='' && $precio !='' && $peso !='' && $stock !='' && $categoria !=''){
			$valores =array(
				'producto_nombre'=>$nombre,
				'producto_referencia'=>$referencia,
				'producto_precio'=>$precio,
				'producto_peso'=>$peso,
				'categoria_id'=>$categoria,
				'producto_stock'=>$stock,
			);
			$res = $this->productos_model->editar($valores,$idproducto);
			if($res){
				$resp['error'] =0;
				$resp['msn'] ='Datos editado correctamente';
			}else{
				$resp['error'] =1;
				$resp['msn'] ='ERROR, intente nuevamente';
			}
		}else{
			$resp['error'] =1;
			$resp['msn'] ='Hay campos vacios';
		}
		echo json_encode($resp);
	}

	public function elimina()
	{
		$this->load->model('productos_model');

		$idproducto=$this->input->post('id');

		if($idproducto !=''){
			$valores =array(
				'producto_estado'=>'0',
			);
			$res = $this->productos_model->editar($valores,$idproducto);
			if($res){
				$resp['error'] =0;
				$resp['msn'] ='Dato eliminado correctamente';
			}else{
				$resp['error'] =1;
				$resp['msn'] ='ERROR, intente nuevamente';
			}
		}else{
			$resp['error'] =1;
			$resp['msn'] ='Hay campos vacios';
		}
		echo json_encode($resp);
	}

	
}
