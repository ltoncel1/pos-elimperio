<?php

$item = null;
$valoe = null;
$contarVendedores = 0;
$sumaTotal = 0;
// array de colores para las ballas de los graficos
$colors = array("#DC3545","#28A745","#FFC207","#53B2D6","#007BFF","#");

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

$arrayVendedores = array();
$arraylistaVendedores = array();

foreach ($ventas as $key => $valueVentas) {

  foreach ($usuarios as $key => $valueUsuarios) {

    if($valueUsuarios["id"] == $valueVentas["id_vendedor"]){

        #Capturamos los vendedores en un array
        array_push($arrayVendedores, $valueUsuarios["nombre"]);

        #Capturamos los nombres y los valores netos en un mismo array
        $arraylistaVendedores = array($valueUsuarios["nombre"] => $valueVentas["neto"]);
    }
  }
  #Sumamos los netos de cada vendedor
    foreach ($arraylistaVendedores as $key => $value) {

        $sumaTotalVendedores[$key] += $value;
     }
   $sumaTotal += $valueVentas["neto"];
}

$sumaTotal = number_format($sumaTotal,2);
#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayVendedores);

?>


<!--=====================================
VENDEDORES
======================================-->
<div class="card card-warning card-outline">
  <div class="card-header no-border">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Vendedores</h3>
    </div>
  </div>
  <div class="card-body">
    <div class="d-flex">
      <p class="d-flex flex-column">
        Total ventas <hr>
        <span class="text-bold text-lg">$ <?php echo $sumaTotal?></span>
      </p>
    </div>
    <!-- /.d-flex -->

    <div class="position-relative mb-4">
      <!-- <canvas id="sales-chart" height="200"></canvas> -->
      <div class="chart" id="bar-chart1" style="height: 300px;"></div>
    </div>

    <!-- <div class="d-flex flex-row justify-content-end">
      <span class="mr-2">
        <i class="fa fa-square text-primary"></i> This year
      </span>

      <span>
        <i class="fa fa-square text-gray"></i> Last year
      </span>
    </div> -->
  </div>
</div>
<!-- /.card -->
<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

  <?php
    
    foreach($noRepetirNombres as $value){

      echo "{y: '".$value."', a: '".$sumaTotalVendedores[$value]."'},";

    }

  ?>
  ],
  barColors: ['#FFC207'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>