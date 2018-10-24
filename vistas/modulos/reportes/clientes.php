<?php

$item = null;
$valor = null;
$contarClientes = 0;
// array de colores para las ballas de los graficos
$colors = array("#DC3545","#28A745","#FFC207","#53B2D6","#007BFF","#C2C7D0");

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

$arrayClientes = array();
$arraylistaClientes = array();

foreach ($ventas as $key => $valueVentas) {
  
  foreach ($clientes as $key => $valueClientes) {
    
      $contarClientes = $key + 1;
      if($valueClientes["id"] == $valueVentas["id_cliente"]){

        #Capturamos los Clientes en un array
        array_push($arrayClientes, $valueClientes["nombre"]);

        #Capturamos las nombres y los valores netos en un mismo array
        $arraylistaClientes = array($valueClientes["nombre"] => $valueVentas["neto"]);

      }

  }
  #Sumamos los netos de cada cliente
    foreach ($arraylistaClientes as $key => $value) {
      
      $sumaTotalClientes[$key] += $value;
    
    }
}
#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayClientes);

?>


<!--=====================================
CLIENTES
======================================-->
<div class="card card-success card-outline">
  <div class="card-header no-border">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Clientes</h3>
    </div>
  </div>
  <div class="card-body">
    <div class="position-relative mb-4">
      <!-- <canvas id="sales-chart" height="200"></canvas> -->
      <div class="chart" id="bar-chart2" style="height: 300px;"></div>
    </div>
  </div>
</div>
<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart2',
  resize: true,
  data: [

  <?php
    
    foreach($noRepetirNombres as $value){

      echo "{y: '".$value."', a: '".$sumaTotalClientes[$value]."'},";

    }

  ?>
  ],
  barColors: ['#28A745'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>