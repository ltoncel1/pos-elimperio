<?php

$item = null;
$valor = null;
$orden = "id";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

 ?>


 <!-- LISTA DE PRODUCTOS AGREGADOS RECIENTEMENTE -->
<div class="card card-primary card-outline" id="collapse">
  <div class="card-header">
    <h3 class="card-title">Productos agregados recientemente</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool productos-recientes" icono2="angle-left" data-widget="collapse">
        <i class="fa fa-angle-left right icon2"></i>
      </button>
      <!-- <button type="button" class="btn btn-tool" data-widget="collapse">
        <i class="fa fa-minus"></i>
      </button> -->
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0 d-none d-lg-block ver-p">
    <ul class="products-list product-list-in-card pl-2 pr-2">
      <?php
        for($i = 0; $i < 8; $i++){
          echo '<li class="item">
                  <div class="product-img">
                    <img src="'.$productos[$i]["imagen"].'" alt="'.$productos[$i]["descripcion"].'" class="img-size-50 img-thumbnail">
                  </div>
                  <div class="product-info">
                    <p class="product-title text-primary">
                    '.$productos[$i]["descripcion"].'
                      <span class="badge badge-warning float-right">$ '.number_format($productos[$i]["precio_venta"],2).'</span>
                    </p>
                    <span class="product-description">
                      Stock: '.$productos[$i]["stock"].'
                    </span>
                  </div>
                </li>
                <!-- /.item -->';
        }
      ?>
      
    </ul>
  </div>
  <!-- /.card-body -->
  <div class="card-footer text-center d-none d-lg-block ver-p">
    <a href="productos" class="uppercase">Ver todos los productos</a>
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->