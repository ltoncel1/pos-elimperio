var esCollapse = false;
/*=================================
=            dataTable            =
=================================*/
if (window.matchMedia("(max-width: 768px)").matches) {
  $(".tablas").DataTable({

    "language": {

      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros.",
      "sZeroRecords":    "No se encontraron resultados.",
      "sEmptyTable":     "No hay datos disponibles en la tabla.",
      "sInfo": "Mostrar del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando 0 registros de un total de 0.",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "search":			"Buscar:",
      "sSearchPlaceholder":		"Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Odenar de manera ascendente",
        "sSortDescending": ": Odenar de manera descendente"
      }

    },
    "lengthMenu":		[[5, 10, 20, 25, 50, -1], 
                    [5, 10, 20, 25, 50, "Todos"]],
    "iDisplayLength":	5,

  });
}
else {
  $(".tablas").DataTable({

    "language": {

      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros.",
      "sZeroRecords": "No se encontraron resultados.",
      "sEmptyTable": "No hay datos disponibles en la tabla.",
      "sInfo": "Mostrando registros _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando 0 registros de un total de 0.",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "search": "Buscar:",
      "sSearchPlaceholder": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Odenar de manera ascendente",
        "sSortDescending": ": Odenar de manera descendente"
      }

    },
    "lengthMenu": [
      [5, 10, 20, 25, 50, -1],
      [5, 10, 20, 25, 50, "Todos"]
    ],
    "iDisplayLength": 10,

  });
}

/*========================================
//iCheck for checkbox and radio inputs
========================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	checkboxClass: 'icheckbox_minimal-blue',
  	radioClass   : 'iradio_minimal-blue'
})

/*========================================
//inputmask
========================================*/
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()


/*========================================
//Text´s solo numeros
========================================*/
$(document).ready(function(){
	$(".txtNumbers").keydown(function(event) {
		if(event.shiftKey){
			event.preventDefault();
		}

	   if (event.keyCode == 46 || event.keyCode == 8){
	   }
	   else {
	        if (event.keyCode < 95) {
	          if (event.keyCode < 48 || event.keyCode > 57) {
	                event.preventDefault();
	          }
	        } 
	        else {
	              if (event.keyCode < 96 || event.keyCode > 105) {
	                  event.preventDefault();
	              }
	        }
	      }
	   });
	});
  if (window.matchMedia("(max-width:768px)").matches) {
    $(".text-small").css("font-size", 18);
    $(".ver-p").addClass("d-none d-lg-block");
    $("#collapse").addClass("collapsed-card");
    $(".icon2").removeClass("fa-angle-down");
    $(".icon2").addClass("fa-angle-left");
    $(".productos-recientes").attr("icono2", "angle-left");
  }
  else if(esCollapse == false) {
    $(".text-small").css("font-size", 38);
    $(".icon2").removeClass("fa-angle-left");
    $(".icon2").addClass("fa-angle-down");
    $(".productos-recientes").attr("icono2", "angle-down");
  }
  // cambiar el icono del boton para expandir el div para agregar la foto del usuario
  $("button.productos-recientes").on("click", function () {
    $(".ver-p").removeClass("d-none d-lg-block");
    var icono = $(this).attr("icono2");
    if (icono == "angle-left") {
      esCollapse = true;
      $(".icon2").removeClass("fa-angle-left");
      $(".icon2").addClass("fa-angle-down");
      $(this).attr("icono2", "angle-down");
    } else {
      esCollapse = false;
      $(".icon2").removeClass("fa-angle-down");
      $(".icon2").addClass("fa-angle-left");
      $(this).attr("icono2", "angle-left");
    }
  })