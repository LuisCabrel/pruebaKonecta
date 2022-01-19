<?php include('head.php') ?>

  <div class="bg-light p-5 rounded">
    <h1>Productos</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoproducto">Nuevo Producto</button>
    <div id="ohsnap"></div>
    <hr>
    <div class="col-md-12">
      <table class="table table-striped" id="tblProductos"></table>
    </div>
    


    <!-- Modal -->
  <div class="modal fade" id="nuevoproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formNuevoProducto">
            <div class="mb-3">
              <label for="" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombre" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">referencias</label>
              <input type="text" class="form-control" name="referencia" id="referencia" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">precio</label>
              <input type="text" class="form-control" name="precio" id="precio" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Peso</label>
              <input type="text" class="form-control" name="peso" id="peso" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Stock</label>
              <input type="number" class="form-control" name="stock" id="stock" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Categoria</label>
              <select class="form-select" aria-label="" id="categoria" name="categoria" required>
                <option selected>Seleccione</option>
                <?php foreach ($categoria as $key) { ?>
                    <option value="<?php echo $key->categoria_id?>"><?php echo $key->categoria_nombre?></option>
                <?php } ?>
              </select>
            </div>
            <button type="button" class="btn btn-primary" id="btnAgregar">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!--edit Modal -->
  <div class="modal fade" id="editarproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formEditaProducto">
            <input type="hidden" name="idproducto" id="idproducto" value="">
            <div class="mb-3">
              <label for="" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">referencias</label>
              <input type="text" class="form-control" name="referencia_edit" id="referencia_edit" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">precio</label>
              <input type="text" class="form-control" name="precio_edit" id="precio_edit" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Peso</label>
              <input type="text" class="form-control" name="peso_edit" id="peso_edit" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Stock</label>
              <input type="number" class="form-control" name="stock_edit" id="stock_edit" value="" required>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Categoria</label>
              <select class="form-select" aria-label="" id="categoria_edit" name="categoria_edit" required>
                <option selected>Seleccione</option>
                <?php foreach ($categoria as $key) { ?>
                    <option value="<?php echo $key->categoria_id?>"><?php echo $key->categoria_nombre?></option>
                <?php } ?>
              </select>
            </div>
            <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
    
  </div>




  <?php include('foot.php') ?>

