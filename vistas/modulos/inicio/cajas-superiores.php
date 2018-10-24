<?php

$item = null;
$valor = null;
$orden = "id";

$ventas = ControladorVentas::ctrSumaTotalVentas();

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>

<!-- Ventas -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-info">
    <div class="inner">
      <h3 class="text-small">$ <?php echo number_format($ventas["total"],2); ?></h3>

      <p>Ventas</p>
    </div>
    <div class="icon">
      <i class="fal fa-shopping-cart"></i>
    </div>
    <a href="ventas" class="small-box-footer"> Más Info <i class="fal fa-arrow-circle-right"></i></a>
  </div>
</div>

<!-- Categorías -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3 class="text-small"><?php echo number_format($totalCategorias); ?></h3>

      <p>Categorías</p>
    </div>
    <div class="icon">
      <i class="fal fa-clipboard-list"></i>
    </div>
    <a href="categorias" class="small-box-footer">Más info <i class="fal fa-arrow-circle-right"></i></a>
  </div>
</div>

<!-- Clientes -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-warning">
    <div class="inner">
      <h3 class="text-small"><?php echo number_format($totalClientes); ?></h3>

      <p>Clientes</p>
    </div>
    <div class="icon">
      <i class="fal fa-users"></i>
    </div>
    <a href="clientes" class="small-box-footer">Más info <i class="fal fa-arrow-circle-right"></i></a>
  </div>
</div>

<!-- Productos -->
<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-danger">
    <div class="inner">
      <h3 class="text-small"><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>
    </div>
    <div class="icon">
      <i class="fal fa-box-open"></i>
    </div>
    <a href="productos" class="small-box-footer">Más info <i class="fal fa-arrow-circle-right"></i></a>
  </div>
</div>