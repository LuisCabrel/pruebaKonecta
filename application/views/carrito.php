<?php include('head.php') ?>

  <div class="bg-light p-5 rounded">
    <h1>CARRITO</h1>
    
    <div id="ohsnap"></div>
    <hr>
    <div class="row">
      <?php foreach ($productos as $key) { ?>
        <div class="card" style="width: 18rem; margin: 5px;">
          <img src="https://plantillasdememes.com/img/plantillas/imagen-no-disponible01601774755.jpg" class="card-img-top" alt="..." style="margin-top: 5px;">
          <div class="card-body">
            <h5 class="card-title"><?php echo $key->producto_nombre?></h5>
            <p class="card-text"><?php echo $key->producto_referencia?></p>           
            <p class="card-text"><strong>S/<?php echo $key->producto_precio?></strong></p>           
            <div class="row">
              <div class="col-md-6">
              Cant:<input type="number" name="cantidad" id="cantidad" class="producto<?php echo $key->producto_id?> form-control" placeholder="0" >
              </div>
              <div class="col-md-6"><br>
              <button onclick="comprar(<?php echo $key->producto_id?>)" class="btn btn-primary d-none">Comprar</button>
              <button onclick='detalleCompra(<?php echo json_encode($key) ?> )' class='btn btn-primary'>Comprar</button>
            </div>
            </div>
          </div>
        </div>
      <?php } ?>
      
    </div>
    

     <div class="modal fade" id="detalleModalproducto" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detalle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="datamodal">
          
        </div>
      </div>
    </div>
  </div>



    
  </div>




  <?php include('foot.php') ?>

