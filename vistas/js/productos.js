/*=============================================
CARGAR LA TABLA DINÁMICA
=============================================*/

if($(".perfilUsuario").val() != "Administrador"){
	var botonesTabla = '<div class="btn-group"><button class="btn btn-outline-warning  btnEditarProducto" idProducto data-toggle="modal" data-target="#modalEditarProducto"><i class="fal fa-edit"></i></button></div>';


	}else{

	var botonesTabla = '<div class="btn-group"><button class="btn btn-outline-warning  btnEditarProducto" idProducto data-toggle="modal" data-target="#modalEditarProducto"><i class="fal fa-edit"></i></button><button class="btn btn-outline-danger  btnEliminarProducto" idProducto codigo imagen><i class="fal fa-times-circle"></i></button></div>';

}

if (window.matchMedia("(max-width: 768px)").matches) {

	var table = $('.tablaProductos').DataTable({
    
		"ajax":"ajax/datatable-productos.ajax.php",
		"columnDefs": [

			{
				"targets": -10,
				"className": "uniqueClassName"
			},

			{
				"targets": -9,
				"data": null,
				"defaultContent": '<img class="img-thumbnail imgTabla" width="40px">',
				"className": "uniqueClassName"

			},

			{
				"targets": -8,
				"className": "uniqueClassName"
			},			

			{
				"targets": -6,
				"className": "uniqueClassName"
      },			
      
      
			{
				"targets": -4,
				"className": "uniqueClassName"
			},			

			{
				"targets": -3,
				"className": "uniqueClassName"
			},

			{
				"targets": -1,
				"data": null,
				"defaultContent": botonesTabla,
				"className": "uniqueClassName"

			}

		],
"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros.",
		"sZeroRecords":    "No se encontraron resultados.",
		"sEmptyTable":     "No hay datos disponibles en la tabla.",
		"sInfo":           "Mostrar del _START_ al _END_ de un total de _TOTAL_",
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
	"lengthMenu":		[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
	"iDisplayLength":	5,			


	})

}else{

	var table = $('.tablaProductos').DataTable({

		"ajax":"ajax/datatable-productos.ajax.php",
		"columnDefs": [

			{
				"targets": -10,
				"className": "uniqueClassName"
			},			

			{
				"targets": -9,
				 "data": null,
				 "defaultContent": '<img class="img-thumbnail imgTabla" width="40px">',
				 "className": "uniqueClassName"

			},

			{
				"targets": -8,
				"className": "uniqueClassName"
			},

			{
				"targets": -6,
				"className": "uniqueClassName"
			},			

			{
				"targets": -5,
				 "data": null,
				 "defaultContent": '<h4><span class="badge badge-pill limiteStock" style="white:30px; height:30px;"></span></h4>',
				 "className": "uniqueClassName"

			},

			{
				"targets": -4,
				"className": "uniqueClassName"
			},			

			{
				"targets": -3,
				"className": "uniqueClassName"
			},			

			{
				"targets": -1,
				 "data": null,
				 "defaultContent": botonesTabla,
				 "className": "uniqueClassName"

			}

		],

"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros.",
		"sZeroRecords":    "No se encontraron resultados.",
		"sEmptyTable":     "No hay datos disponibles en la tabla.",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando 0 registros de un total de 0.",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"search":			"Buscar:",
		"sSearchPlaceholder":		"Buscar producto",
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
	"lengthMenu":		[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
	"iDisplayLength":	10,		


	})



}

/*=============================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
=============================================*/

$('.tablaProductos tbody').on( 'click', 'button', function () {

	if(window.matchMedia("(min-width:992px)").matches){
	
		var data = table.row( $(this).parents('tr') ).data();

	}else{

		var data = table.row( $(this).parents('tbody tr ul li')).data();

	}
	
  $(this).attr("idProducto", data[9])
  console.log("idProducto:", $(this).attr("idProducto"));
	$(this).attr("codigo", data[2])
	$(this).attr("imagen", data[1])

} );

/*=============================================
FUNCIÓN PARA CARGAR LAS IMÁGENES
=============================================*/

function cargarImagenes(){

	var imgTabla = $(".imgTabla");
  console.log("imgTabla: ", imgTabla);
	var limiteStock = $(".limiteStock");

	for(var i = 0; i < imgTabla.length; i ++){

		var data = table.row( $(imgTabla[i]).parents("tr")).data();	
    console.log("tablaProductos: ", table);
    
    //console.log("tablaProductos: ", data);
		$(imgTabla[i]).attr("src", data[1]);

		if(data[5] <= 10){

	    	$(limiteStock[i]).addClass("badge-danger");
	    	$(limiteStock[i]).html(data[5]);

	    }else if(data[5] > 11 && data[5] <= 15){

	    	$(limiteStock[i]).addClass("badge-warning");
	    	$(limiteStock[i]).html(data[5]);
	    
	    }else{

	    	$(limiteStock[i]).addClass("badge-success");
	    	$(limiteStock[i]).html(data[5]);
	    }

	}

}

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO ENTRAMOS A LA PÁGINA POR PRIMERA VEZ
=============================================*/

$('.tablaProductos').on( 'draw.dt', function () {

	cargarImagenes();

	if($(".perfilUsuario").val() != "Administrador"){

		$('.btnEliminarProducto').remove();

	}

})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL PAGINADOR
=============================================*/

$(".dataTables_paginate").click(function(){

	cargarImagenes();

	if($(".perfilUsuario").val() != "Administrador"){

		$('.btnEliminarProducto').remove();

	}


})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL BUSCADOR
=============================================*/
$("input[aria-controls='DataTables_Table_0']").focus(function(){

	$(document).keyup(function(event){

		event.preventDefault();

		cargarImagenes();

		if($(".perfilUsuario").val() != "Administrador"){

			$('.btnEliminarProducto').remove();

		}


	})


})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE CANTIDAD
=============================================*/

$("select[name='DataTables_Table_0_length']").change(function(){

	cargarImagenes();

	if($(".perfilUsuario").val() != "Administrador"){

		$('.btnEliminarProducto').remove();

	}


})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE ORDENAR
=============================================*/

$(".sorting").click(function(){

	cargarImagenes();

	if($(".perfilUsuario").val() != "Administrador"){

		$('.btnEliminarProducto').remove();

	}


})

/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
$("#nuevaCategoria").change(function(){

	var idCategoria = $(this).val();

	var datos = new FormData();
  	datos.append("idCategoria", idCategoria);

  	$.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

      	if(!respuesta){

      		var nuevoCodigo = idCategoria+"01";
      		$("#nuevoCodigo").val(nuevoCodigo);

      	}else{

      		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
          	$("#nuevoCodigo").val(nuevoCodigo);

      	}
                
      }

  	})
  	$("#nuevaDescripcion").focus();

})

/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){

	if($(".porcentaje").prop("checked")){

		var valorPorcentaje = $(".nuevoPorcentaje").val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function(){

	if($(".porcentaje").prop("checked")){

		var valorPorcentaje = $(this).val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);

	}

})

$(".porcentaje").on("ifUnchecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",false);
	$("#editarPrecioVenta").prop("readonly",false);
	$(".nuevoPorcentaje").prop("readonly",true);

})

$(".porcentaje").on("ifChecked",function(){

	var valorPorcentaje = $(".nuevoPorcentaje").val();
	
	var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

	var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

	$("#nuevoPrecioVenta").val(porcentaje);
	$("#nuevoPrecioVenta").prop("readonly",true);

	$("#editarPrecioVenta").val(editarPorcentaje);
	$("#editarPrecioVenta").prop("readonly",true);	

	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);
	$(".nuevoPorcentaje").prop("readonly",false);

})

/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarCategoria").val(respuesta["id"]);
                  $("#editarCategoria").html(respuesta["categoria"]);

              }

          })

           $("#editarCodigo").val(respuesta["codigo"]);
           $("#editarDescripcion").val(respuesta["descripcion"]);
           $("#editarStock").val(respuesta["stock"]);
           $("#editarCodigoBarra").val(respuesta["barcode"]);

           if((respuesta["barcode"] !="") && (respuesta["barcode"] !=0)){

           		$("#editarCodigoBarra").attr("readonly", true);
				//función para generar el código de barras
				codigoBarras=$("#editarCodigoBarra").val();
				JsBarcode("#barcode", codigoBarras);
				$("#print").attr("hidden", false);
				console.log("si hay barcade");           	
           }
           else{
           	console.log("no hay barcade");
           	$("#editarCodigoBarra").attr("readonly", false);
           	$("#print").attr("hidden", true);
           }

           $("#editarPrecioCompra").val(respuesta["precio_compra"]);
           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           if(respuesta["imagen"] != ""){

	           	$("#imagenActual").val(respuesta["imagen"]);
	           	$(".previsualizar").attr("src",  respuesta["imagen"]);
           	}

      }

  })

})

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");
	
	swal({

		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

        }


	})

})

//función para generar el código de barras
$("#codigoBarras").keyup(function(){

	if ($("#codigoBarras").val().length != 0){

		codigoBarras=$("#codigoBarras").val();
		JsBarcode("#barcode", codigoBarras);
		$("#print").show();
	}else{$("#print").attr("hidden", true);}
})

//función para generar el código de barras
$("#editarCodigoBarra").keyup(function(){

	if ($("#editarCodigoBarra").val().length != 0){

		codigoBarras=$("#editarCodigoBarra").val();
		JsBarcode("#barcode", codigoBarras);
		$("#print").attr("hidden", false);
	}else{$("#print").attr("hidden", true);}
})

//función para generar el código de barras
$("#editarCodigoBarra").change(function () {

  if ($("#editarCodigoBarra").val().length != 0) {

    codigoBarras = $("#editarCodigoBarra").val();
    JsBarcode("#barcode", codigoBarras);
    $("#print").attr("hidden", false);
  } else {
    $("#print").attr("hidden", true);
  }
})

//Función para imprimir el Código de barras
function imprimir()
{
	$("#print").printArea();
}
	
