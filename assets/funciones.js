$(document).ready(function() { 
	tablaproductos();
})

$("#btnAgregar").click(function() { 
	datastring = $("#formNuevoProducto").serialize();
    $.ajax({
        url: base_url + '/productos/registrar',
        type: "POST",
        data:datastring,
        dataType: "json",
        success: function (data) {           
            html='';
            if(data.error ==0){ 
            $("#nuevoproducto").modal("hide");           
                ohSnap(data.msn, {color: 'green'});
                tablaproductos();
            }else{
                ohSnap(data.msn, {color: 'red'});
            }            
        }  
    });
  })

function tablaproductos() {
	botones =function (data, type, row) {
       
        var strData =JSON.stringify(row);      
        return  "<button type='button' class='btn btn-primary btn-sm' onclick='editar("+strData+")'>Editar</button>"+
				"<button type='button' class='btn btn-danger btn-sm' onclick='eliminar("+row.producto_id+")'>Eliminar</button>";
    }
	$('#tblProductos').DataTable({     
            "bDestroy": true, 
            "bSort": true, 
            "searching": true,
            "lengthChange":true,
            "ajax": {
              "url": base_url+"/productos/listaproductos",
              "type": "POST", 
              "dataType": "json"        
            },  
            "sAjaxDataProp": "",
            "columns": [
                  {"data": "producto_nombre",className: "text-center", "title": "NOMBRE"},
                  {"data": "producto_referencia",className: "text-center", "title": "REFERENCIA"},
                  {"data": "producto_precio",className: "text-center", "title": "PRECIO",},
                  {"data": "producto_peso",className: "text-center", "title": "PESO"},
                  {"data": "categoria",className: "text-center", "title": "CATEGORIA"},
                  {"data": "producto_stock",className: "text-center", "title": "STOCK"},                
                  {"data": "producto_id",className: "text-center", "title": "","render":botones},                
            ]
    });
}

function editar(json) {console.log(json);
	$("#idproducto").val(json.producto_id);
	$("#nombre_edit").val(json.producto_nombre);
	$("#referencia_edit").val(json.producto_referencia);
	$("#precio_edit").val(json.producto_precio);
	$("#peso_edit").val(json.producto_peso);
	$("#stock_edit").val(json.producto_stock);
	$("#categoria_edit").val(json.categoria_id);
	$("#editarproducto").modal("show");
}

$("#btnEditar").click(function() { 
	datastring = $("#formEditaProducto").serialize();
    $.ajax({
        url: base_url + '/productos/editar',
        type: "POST",
        data:datastring,
        dataType: "json",
        success: function (data) {           
            html='';
            if(data.error ==0){ 
            $("#editarproducto").modal("hide");           
                ohSnap(data.msn, {color: 'green'});
                tablaproductos();
            }else{
                ohSnap(data.msn, {color: 'red'});
            }            
        }  
    });
})

function eliminar(id){ 
    $.ajax({
        url: base_url + '/productos/elimina',
        type: "POST",
        data:{id:id},
        dataType: "json",
        success: function (data) {           
            html='';
            if(data.error ==0){ 
            $("#editarproducto").modal("hide");           
                ohSnap(data.msn, {color: 'green'});
                tablaproductos();
            }else{
                ohSnap(data.msn, {color: 'red'});
            }            
        }  
    });
}

function comprar(id,tot,cantidad) {
	let producto_id = id;
	let cant =cantidad;
	let total =tot;
	if(cant>0){
		$.ajax({
	        url: base_url + '/carrito/comprar',
	        type: "POST",
	        data:{producto_id:producto_id,cant:cant,total:total},
	        dataType: "json",
	        success: function (data) {
	        	$("#detalleModalproducto").modal("hide");           
	            html='';
	            if(data.error ==0){	
	                ohSnap(data.msn, {color: 'green'});
	                location.reload();
	            }else{
	                ohSnap(data.msn, {color: 'red'});
	            }            
	        }  
	    });
	}else{
		ohSnap("Ingrese una cantidad", {color: 'red'});
	}
	console.log(cant);
}

function detalleCompra(data) {
	var html='';
	let cant =$(".producto"+data.producto_id).val();
	if(cant>0){
		let total =cant * data.producto_precio;
		let id=data.producto_id;
		html=`
		<h4>DETALLE DE COMPRA</h4>
		<p><strong>Producto: </strong>${data.producto_nombre}</p>
		<p><small><strong>Detalle: </strong>${data.producto_referencia}</small></p>
		<p><strong>Precio: </strong>${data.producto_precio}</p>
		<p><strong>Cantidad: </strong>${cant}</p>
		<p><strong>Precio a pagar: S/ ${total.toFixed(2)}</strong></p>
		<button type="button" class="btn btn-primary" id="comprar" onclick="comprar(${id},'${total}',${cant})">Finalizar compra</button>
		`;
		$("#datamodal").html(html);
		$("#detalleModalproducto").modal("show");
		$('#detalleModalproducto').modal({backdrop: 'static', keyboard: false})  

	}else{
		ohSnap("Ingrese una cantidad", {color: 'red'});
	}
	
}


