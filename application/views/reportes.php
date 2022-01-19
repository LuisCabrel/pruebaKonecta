<?php include('head.php') ?>
<div class="bg-light p-5 rounded">
    <h1>REPORTES</h1><hr>
    <div class="col-md-12">
    	<h5>PRODUCTO CON MAS STOCK</h5>
    	<h5><?php echo $conMasStock->producto_nombre ?></h5>
    	Stock:<?php echo $conMasStock->producto_stock ?>
    </div>
    <br>
    <hr>
    <div class="col-md-12">
    	<h5>PRODUCTO MAS VENDIDO EN CANTIDAD</h5>
    	<h5><?php echo $masVendido->producto_nombre ?></h5>
    	Cantidad:<?php echo $masVendido->cant ?> <BR>
    	Soles: <?php echo $masVendido->soles ?>
    </div>
</div>

<?php include('foot.php') ?>