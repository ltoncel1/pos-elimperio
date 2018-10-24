<?php

error_reporting(0);

if(isset($_GET["Inicial"])){

    $fechaInicial = $_GET["Inicial"];
    $fechaFinal = $_GET["Final"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {

	#Capturamos sólo el año y el mes
	$fecha = substr($value["fecha"],0,7);

	#Introducir las fechas en arrayFechas
	array_push($arrayFechas, $fecha);

	#Capturamos las ventas
	$arrayVentas = array($fecha => $value["neto"]);

	#Sumamos los pagos que ocurrieron el mismo mes
	foreach ($arrayVentas as $key => $value) {
		
		$sumaPagosMes[$key] += $value;
	}

}


$noRepetirFechas = array_unique($arrayFechas);


?>

<!--=====================================
GRÁFICO DE VENTAS
======================================-->
 <!-- solid sales graph -->
<div class="card bg-info-gradient">
  <div class="card-header no-border">
    <h3 class="card-title">
      <i class="fa fa-th mr-1"></i>
      Gráfico de Ventas
    </h3>

    <!-- <div class="card-tools">
      <button type="button" class="btn bg-info btn-sm" data-widget="collapse">
        <i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn bg-info btn-sm" data-widget="remove">
        <i class="fa fa-times"></i>
      </button>
    </div> -->
  </div>
  <div class="card-body nuevoGraficoVentas">
    <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->


<script>
	
 var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";


	    }

	    echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";

    }else{

       echo "{ y: '0', ventas: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });

</script>