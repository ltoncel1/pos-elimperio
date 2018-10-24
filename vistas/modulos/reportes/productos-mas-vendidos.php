<?php

$item = null;
$valor = null;
$orden = "ventas";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

$colores = array("danger","success","warning","info","primary","secondary","purple","brown","violet","gold");
$colors = array("#DC3545","#28A745","#FFC207","#53B2D6","#007BFF","#");

$totalVentas = ControladorProductos::ctrMostrarSumaVentas();


?>

<!--=====================================
PRODUCTOS MÁS VENDIDOS
======================================-->
<div class="card card-info card-outline">
  <div class="card-header no-border">
    <h3 class="card-title">Productos mas vendidos</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      <div class="col-md-8">
        <div class="chart-responsive">
          <canvas id="pieChart" height="150"></canvas>
        </div>
        <!-- ./chart-responsive -->
      </div>
      <!-- /.col -->
      <div class="col-md-4">
        <ul class="chart-legend clearfix">
          <?php

					for($i = 0; $i < 5; $i++){

					echo ' <li><i class="fa fa-genderless text-'.$colores[$i].'"></i> '.$productos[$i]["descripcion"].'</li>';

					}
		  	 	?>
        </ul>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.card-body -->
  <div class="card-footer  p-0">
    <ul class="nav nav-pills flex-column">
        <?php
          	for($i = 0; $i <5; $i++){
              echo '<li class="nav-item">
                      <a class="nav-link is-product" style="cursor: pointer;" idProducto="'.$productos[$i]["id"].'">
                        <img src="'.$productos[$i]["imagen"].'" class="img-thumbnail" width="60px" style="margin-right:10px">
                        '.$productos[$i]["descripcion"].'
                        <span class="float-right text-'.$colores[$i].'">   
						            '.ceil($productos[$i]["ventas"]*100/$totalVentas["total"]).'%
						            </span>
						          </a>
      				      </li>';
			      }
			  ?>
    </ul>
  </div>
  <!-- /.footer -->
</div>
<!-- /.card -->

<script>
	

  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [

  <?php

  for($i = 0; $i < 5; $i++){

  	echo "{
      value    : '".$productos[$i]["ventas"]."',
      color    : '".$colors[$i]."',
      highlight: '".$colors[$i]."',
      label    : '".$productos[$i]["descripcion"]."'
    },";

  }
    
   ?>
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------


</script>