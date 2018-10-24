/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("capturarRango2") != null){

	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));


}else{

	$("#daterange-btn2 span").html('<i class="fal fa-calendar-alt"></i> Fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn2').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    opens: 'center',
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-M-D');

    var fechaFinal = end.format('YYYY-M-D');

    var capturarRango = $("#daterange-btn2 span").html();
   
   	localStorage.setItem("capturarRango2", capturarRango);

   	window.location = "index.php?ruta=reportes&Inicial="+fechaInicial+"&Final="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.openscenter .range_inputs .cancelBtn").on("click", function(){
	localStorage.removeItem("capturarRango2");
	localStorage.clear();
	window.location = "reportes";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.openscenter .ranges li").on("click", function(){

	var textoHoy = $(this).val();

	if(textoHoy == 0){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		var fechaInicial = año+"-"+mes+"-"+dia;

    	var fechaFinal = año+"-"+mes+"-"+dia;

    	localStorage.setItem("capturarRango2", "Hoy");

    window.location = "index.php?ruta=reportes&Inicial="+fechaInicial+"&Final="+fechaFinal;

	}

})


/*=============================================
MOSTRAR DETALLES DEL PRODUCTO
=============================================*/
//
$(".is-product").on('click', function () {
  var idProducto = $(this).attr("idProducto");
    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({

      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        var descripcionProducto = respuesta["descripcion"];
        var image = respuesta["imagen"];
        var precio_compra = respuesta["precio_compra"];
        var precio_venta = respuesta["precio_venta"];
        var ventas = respuesta["ventas"];
        var ganancias = (precio_venta - precio_compra)*ventas;
        ganancias = (ganancias).toCurrency();
        swal({
          title: descripcionProducto,
          html: '<hr>Unidades vendidas: ' + '<strong>' + ventas + '</strong>'+ '<br><hr>' + 'Ganancias generadas por el producto: ' + ganancias,
          imageUrl: image,
          imageWidth: 200,
          imageAlt: descripcionProducto,
          animation: false,
          customClass: 'animated fadeInLeftBig'
        })
      }
    })
})
//
// Takes a Number and returns a US/CAN currency string.
function toCurrency(amount) {
  return "$ " + amount.toFixed(2);
};

// Adds a .toCurrency() method to Numbers.
Number.prototype.toCurrency = function () {
  return toCurrency(this);
};



