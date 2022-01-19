<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Productos_model extends CI_Model
{

	public function categorias()
	{
        $query = $this->db->get('categorias');
        if($query->num_rows()){
        	return $query->result();
        }else{
        	return array();
        }
	}

	public function guardar($data)
	{
		$this->db->insert('productos', $data);
		$idInsert = $this->db->insert_id();
		if($idInsert>0){
			return true;
		}else{
			return false;
		}
	}

	public function listaproductos()
	{
		$sql = 	"SELECT p.*,c.categoria_nombre as categoria FROM productos p
				LEFT JOIN categorias c ON c.categoria_id=p.categoria_id
				WHERE p.producto_estado =1 ";		
		$query = $this->db->query($sql);
		
        if($query->num_rows()){
        	return $query->result();
        }else{
        	return array();
        }
	}

	public function editar($data,$id)
	{
		$this->db->where('producto_id',$id);
		if ($this->db->update('productos',$data)) {
			return	1;	
		}else{
			return 0;
		}
	}

	public function validaStock($idproducto,$cantidad)
	{
		$sql = 	"SELECT * FROM productos 
					WHERE producto_estado =1 AND producto_id=".$idproducto." AND producto_stock>".$cantidad."";		
		$query = $this->db->query($sql);
		
        if($query->num_rows()){
        	return 1;
        }else{
        	return 0;
        }
	}

	public function comprar($idproducto,$cantidad,$totalPago)
	{
		$this->db->trans_begin();
		$dataVenta = array(
			'producto_id'=>$idproducto,
			'venta_cantidad'=>$cantidad,
			'venta_soles'=>$totalPago
		);
		$this->db->insert('ventas', $dataVenta);
		$idInsert = $this->db->insert_id();
		if($idInsert>0){
			//buscamos producto
			$sql = 	"SELECT * FROM productos WHERE producto_id= ".$idproducto;		
			$query = $this->db->query($sql)->row();

			$nuevoStock =$query->producto_stock - $cantidad;

			//ACTUALIZAMOS
			$dataUpdate=array(
				'producto_stock'=>$nuevoStock,
			);
			$this->db->where('producto_id',$idproducto);
			$this->db->update('productos',$dataUpdate);
		}


		if ($this->db->trans_status() === FALSE){
		    $this->db->trans_rollback();
		    return 0;
		}else{
		    $this->db->trans_commit();
		    return 1;
		}
	}

	public function conMasStock()
	{
		$sql='SELECT producto_nombre,MAX(producto_stock)producto_stock FROM productos';
		$query = $this->db->query($sql);
		if($query->num_rows()){
        	return $query->row();
        }else{
        	return array();
        }
	}

	public function masVendido()
	{
		$sql='SELECT v.producto_id,p.producto_nombre,COUNT(v.producto_id)AS cant,SUM(v.venta_soles)AS soles FROM ventas v
			LEFT JOIN  productos p ON p.producto_id=v.producto_id
			GROUP BY v.producto_id
			ORDER BY cant DESC LIMIT 1';
		$query = $this->db->query($sql);
		if($query->num_rows()){
        	return $query->row();
        }else{
        	return array();
        }
	}
}