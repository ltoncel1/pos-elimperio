/*==================================================
=            Subir foto del usuario                =
==================================================*/
$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

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

/*==================================================
=            Editar usuario                        =
==================================================*/
$(".tablas").on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	console.log(idUsuario);
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			console.log(respuesta);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarPerfil").html(respuesta["perfil"]);
			$("#editarPerfil").val(respuesta["perfil"]);
			$("#fotoActual").val(respuesta["foto"]);

			$("#passwordActual").val(respuesta["password"]);

			if(respuesta["foto"] != ""){

				$(".previsualizar").attr("src", respuesta["foto"]);

			}

		}

	});

})

/*==================================================
=           Activar usuario                        =
==================================================*/
$(".tablas").on("click", ".btnActivar", function(){


	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	if (window.matchMedia("(max-width:767px)").matches) {

		console.log("dispositivos pequeños")
		if($('#' + idUsuario).prop('checked')) {
			console.log("esta checked");
			var checkbox = $(this).parent().parent();
			console.log("checkbox:", checkbox);
			var checkbox2 = checkbox.children().children();
			console.log("checkbox2:", checkbox2);
			checkbox2.removeAttr('checked');
		} else {
			console.log("no esta checked");
			var checkbox = $(this).parent().parent();
			var checkbox2 = checkbox.children().children();
			checkbox2.attr('checked', true);
		}
	}

	var datos = new FormData();
 	datos.append("activarId", idUsuario);
  	datos.append("activarUsuario", estadoUsuario);

  	$.ajax({

	  url:"ajax/usuarios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      }

  	})

  	if(estadoUsuario == 0){
  		$(this).attr('estadoUsuario',1);

  	}else{
  		$(this).attr('estadoUsuario',0);

  	}

})

/*==================================================================
=            Revisar si el usuario esta registrado en la db         =
===================================================================*/

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after(
	    			'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Este usuario ya existe en la base de datos</div>');
	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})
})

/*==================================================
=           Eliminar usuario                       =
==================================================*/
$(".tablas").on("click", ".btnEliminarUsuario", function(){

  var idUsuario = $(this).attr("idUsuario");
  var fotoUsuario = $(this).attr("fotoUsuario");
  var usuario = $(this).attr("usuario");

  swal({
    title: '¿Está seguro de borrar el usuario?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;

    }

  })

})

// cambiar el icono del boton para expandir el div para agregar la foto del usuario
$("button.foto").on("click", function () {
  var icono = $(this).attr("icono");
  if (icono == "angle-left") {
    $(".icon").removeClass("fa-angle-left");
    $(".icon").addClass("fa-angle-down");
    $(this).attr("icono", "angle-down");
  } else {
    $(".icon").removeClass("fa-angle-down");
    $(".icon").addClass("fa-angle-left");
    $(this).attr("icono", "angle-left");
  }
})




