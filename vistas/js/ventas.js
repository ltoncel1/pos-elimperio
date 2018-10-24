var arrayImagenes = [];
var a = 0;
var estadoProducto = false;
/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if (localStorage.getItem("capturarRango") != null) {

  $("#daterange-btn span").html(localStorage.getItem("capturarRango"));

} else {

  $("#daterange-btn span").html('<i class="fal fa-calendar-alt"></i> Fecha')

}
//botón para guardar el cliente desde la vista 'crear-venta'
$("#btnSaveCliente").on("click", function () {

  guardarCliente($("#nuevoCliente").val(), $("#nuevoDocumentoId").val(), $("#nuevoEmail").val(), $("#nuevoTelefono").val(), $("#nuevaDireccion").val(), $("#nuevaFechaNacimiento").val());
})

//botón para cerrar el formulario modal
$(".cerrarModal").on("click", function () {
  limpiar();
})

// funcion para agragar un unevo cliente desde la vista crear-venta
function guardarCliente(xnuevoCliente, xnuevoDocumentoId, xnuevoEmail, xnuevoTelefono, xnuevaDireccion, xnuevaFechaNacimiento) {

  var datosCliente = {
    nuevoCliente: xnuevoCliente,
    nuevoDocumentoId: xnuevoDocumentoId,
    nuevoEmail: xnuevoEmail,
    nuevoTelefono: xnuevoTelefono,
    nuevaDireccion: xnuevaDireccion,
    nuevaFechaNacimiento: xnuevaFechaNacimiento
  };

  $.ajax({
    type: 'post',
    url: 'ajax/agregarCliente.ajax.php',
    async: true,
    data: datosCliente,
    success: function (respuesta) {
      var xrespusta = $.parseJSON(respuesta);
      if (xrespusta == "ok") {
        swal({
          type: 'success',
          title: '¡El cliente ha sido guardado!',
          showConfirmButton: false,
          timer: 2000
        })
        $('#seleccionarCliente').children('option:not(:first)').remove();
        cargarCliente();
        limpiar();
      } else {
        swal({
          type: "error",
          title: "¡Los campos con (*) son requeridos y no deben contener caracteres especiales!",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        })
        $("#nuevoCliente").focus();
      }
    }
  })
}

// Limpiar controles & cerrar formulario (agregar Cliente)
function limpiar() {
  $("#nuevoCliente").val("");
  $("#nuevoDocumentoId").val("");
  $("#nuevoEmail").val("");
  $("#nuevoTelefono").val("");
  $("#nuevaDireccion").val("");
  $("#nuevaFechaNacimiento").val("");
  $("#modalAgregarCliente").modal("hide");
}

// crarga select con los clientes
function cargarCliente() {

  var valor = null;
  var datos = new FormData();
  datos.append("idDelCliente", valor);

  $.ajax({

    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      var cont = 0;
      $.each(respuesta, function (i, item) {
        cont++;
        $("#seleccionarCliente").append('<option id="' + cont + '" value="' + item["id"] + '">' + item["nombre"] + '</option>');
      });
      $('#' + cont).attr("selected", true);
    }

  })
}


/*=============================================
CARGAR LA TABLA DINÁMICA PRODUCTOS
=============================================*/

var table2 = $('.tablaVentas').DataTable({

  "ajax": "ajax/datatable-ventas.ajax.php",
  "columnDefs": [

    {
      "targets": -5,
      "className": "uniqueClassName"

    },

    {
      "targets": -4,
      "data": null,
      "defaultContent": '<img class="img-thumbnail imgTablaVenta" width="40px">',
      "className": "uniqueClassName"

    },

    {
      "targets": -2,
      "data": null,
      "defaultContent": '<h4><span class="badge badge-pill limiteStock" style="white:30px; height:30px;"></span></h4>',
      "className": "uniqueClassName"

    },

    {
      "targets": -1,
      "data": null,
      "defaultContent": '<div class="btn-group"><button class="btn btn-outline-success btn-sm agregarProducto recuperarBoton" idProducto><i class="fal fa-plus-circle"></button></div>',
      "className": "uniqueClassName"

    }

  ],

  "language": {

    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros.",
    "sZeroRecords": "No se encontraron resultados.",
    "sEmptyTable": "No hay datos disponibles en la tabla.",
    "sInfo": "Mostrar del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty": "0 registros de un total de 0.",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "search": "Buscar:",
    "sSearchPlaceholder": "Buscar produsto",
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
  "iDisplayLength": 5,

})

/*=============================================
ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
=============================================*/

$(".tablaVentas tbody").on('click', 'button.agregarProducto', function () {

  var data = table2.row($(this).parents('tr')).data();

  $(this).attr("idProducto", data[4]);

})


/*=============================================
FUNCIÓN PARA CARGAR LAS IMÁGENES CON EL PAGINADOR Y EL FILTRO
=============================================*/

function cargarImagenesProductos() {

  var imgTabla = $(".imgTablaVenta");

  var limiteStock = $(".limiteStock");

  for (var i = 0; i < imgTabla.length; i++) {

    var data = table2.row($(imgTabla[i]).parents('tr')).data();

    $(imgTabla[i]).attr("src", data[1]);

    if (data[4] <= 10) {

      $(limiteStock[i]).addClass("btn-danger");
      $(limiteStock[i]).html(data[3]);

    } else if (data[4] > 11 && data[3] <= 15) {

      $(limiteStock[i]).addClass("btn-warning");
      $(limiteStock[i]).html(data[3]);

    } else {

      $(limiteStock[i]).addClass("btn-success");
      $(limiteStock[i]).html(data[3]);
    }

  }


}

$('.tablaVentas').on('draw.dt', function () {

  cargarImagenesProductos()

})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL PAGINADOR
=============================================*/

$(".dataTables_paginate").click(function () {

  cargarImagenesProductos()
})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL BUSCADOR
=============================================*/
$("input[aria-controls='DataTables_Table_0']").focus(function () {

  $(document).keyup(function (event) {

    event.preventDefault();

    cargarImagenesProductos()

    if (localStorage.getItem("quitarProducto") != null) {

      var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

      for (var i = 0; i < listaIdProductos.length; i++) {

        $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").removeClass('btn-default');

        $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").addClass('btn-primary agregarProducto');

      }

    }

  })


})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE CANTIDAD
=============================================*/

$("select[name='DataTables_Table_0_length']").change(function () {

  cargarImagenesProductos()

  if (localStorage.getItem("quitarProducto") != null) {

    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for (var i = 0; i < listaIdProductos.length; i++) {

      $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").removeClass('btn-default');

      $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").addClass('btn-primary agregarProducto');

    }

  }

})

/*=============================================
CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE ORDENAR
=============================================*/

$(".sorting").click(function () {

  cargarImagenesProductos()

  if (localStorage.getItem("quitarProducto") != null) {

    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for (var i = 0; i < listaIdProductos.length; i++) {

      $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").removeClass('btn-default');

      $("button.recuperarBoton[idProducto='" + listaIdProductos[i]["idProducto"] + "']").addClass('btn-primary agregarProducto');

    }

  }

})

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA CON LECTOR DE CODÍGO DE BARRAS
=============================================*/
var arrayProductos = [];
var r = 0;
var item = 0;
var codigoBarra = [];
var estaBarCode = false;

//creo una función, que esperara a que se termine de ingresar el código de barras a la caja, para poder ser ejecutara
$.fn.delayPasteKeyUp = function (fn, ms) {
  var timer = 0;
  $(this).on("propertychange input", function () {
    clearTimeout(timer);
    timer = setTimeout(fn, ms);
  });
};

//ahora, usamos este funcion en el on("ready") de jquery:
$(document).ready(function () {

  $("#barcode").delayPasteKeyUp(function () {

    var barCode = $("#barcode").val();
    var datos = new FormData();
    datos.append("barcode", barCode);
    $.ajax({

      url: "ajax/barcode.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        var idProducto = respuesta["id"];
        var descripcion = respuesta["descripcion"];
        var stock = respuesta["stock"];
        var precio = respuesta["precio_venta"];
        var barcode = respuesta["barcode"];
        var ruta = respuesta["imagen"];

        if (barcode != null) {

          /*------*/
          if (stock == 0) {

            swal({
              title: descripcion + "<br>Se encuentra agotad@",
              text: "¡No es posible agragar este producto a la venta",
              type: "error",
              showConfirmButton: false,
              timer: 2000
            });
          } //Fin if (stock==0)
          else {

            for (var j = 0; j < r; j++) {

              if (barcode == codigoBarra[j]) {

                estaBarCode = true;
              } else if (idProducto == codigoBarra[j]) {
                estaBarCode = true;
              }
            }
            if (estaBarCode != true) {

              if ((barcode == null) || (barcode == 0)) {
                codigoBarra.push(idProducto);
              } else {
                codigoBarra.push(barcode);
              }

              $(".nuevoProducto").append(

                '<div class="row">' +
                '<!-- Información del producto -->' +
                '<div class="col-12 col-sm-6 pr-0">' +
                '<!-- Descripción del producto -->' +
                '<div class="input-group  has-feedback form-group desP">' +
                '<div class="input-group-prepend">' +
                '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; "><button type="button" class="btn btn-tool text-danger quitarProducto" idProducto="' + idProducto + '" index="' + a + '" style="padding: 1px; font-size:1.2em; text-align: center; line-height: 0.5;"><i class="fa fa-times-circle"></i></button></span>' +
                  '</div>' +
                  '<input type="text" class="form-control input-group-lg nuevaDescripcionProducto" idProducto="' + idProducto + '" name="agregarProducto" value="' + descripcion + '" required>' +
                  '</div>' +
                  '</div>' +
                  '<!-- Cantidad -->' +
                  '<div class="col-6 col-sm-3">' +
                  '<div class="input-group  has-feedback form-group">' +
                  '<div class="input-group-prepend">' +
                  '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-boxes"></i></span>' +
                  '</div>' +
                  '<input type="number" class="form-control input-group-lg txtNumbers nuevaCantidadProducto" id="' + idProducto + '" name="nuevaCantidadProducto" min="1" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required>' +
                  '</div>' +
                  '</div>' +
                  '<!-- Precio -->' +
                  '<div class="col-6 col-sm-3 pl-0 ingresoPrecio">' +
                  '<div class="input-group  has-feedback form-group">' +
                  '<div class="input-group-prepend">' +
                  '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-usd-circle"></i></span>' +
                  '</div>' +
                  '<input type="text" class="form-control input-group-lg nuevoPrecioProducto" precioReal="' + precio + '" name="nuevoPrecioProducto" value="' + precio + '" disabled required >' +
                  '</div>' +
                  '</div>' +
                  '<input type="hidden" value="' + ruta + '">' +
                  '</div>'
              )

              // imagen del producto
              arrayImagenes.push(ruta);
              a = Number(a) + 1;
              $(".previsualizar").attr("src", ruta);
              $(".previsualizar").attr("hidden", false);

              // SUMAR TOTAL DE PRECIOS
              sumarTotalPrecios()

              // AGREGAR IMPUESTO
              agregarImpuesto()

              // AGRUPAR PRODUCTOS EN FORMATO JSON
              listarProductos()

              // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
              $(".nuevoPrecioProducto").number(true, 2);

              /*----------  variables  ----------*/
              var descripcion = $(".nuevaDescripcionProducto");
              var cantidad = $(".nuevaCantidadProducto");
              var precio = $(".nuevoPrecioProducto");
              var items = $("#items").val();
              var iStock = $("#iStock").val();

              /*--------------------------------------------*/
              arrayProductos.push({
                "id": $(descripcion[r]).attr("idProducto"),
                "descripcion": $(descripcion[r]).val(),
                "cantidad": $(cantidad[r]).val(),
                "barcode": barcode,
                "stock": $(cantidad[r]).attr("nuevoStock"),
                "precio": $(precio[r]).attr("precioReal"),
                "total": $(precio[r]).val()
              })

              r = Number(r) + 1;
              $("#item").val(Number(r) - 1);
              item = Number(item) + Number($("#item").val());

            } //Fin if (estaBarCode != true)
            else {

              for (var j = 0; j < r; j++) {

                if (barcode == arrayProductos[j].barcode) {

                  iStock = $('#' + arrayProductos[j].id).val();
                  var idPro = arrayProductos[j].id;

                  iStock = Number(iStock) + 1;
                  $("#iStock").val(iStock);
                  $('#' + arrayProductos[j].id).val(iStock);

                  /*modificar la contidad*/
                  var precio = $('#' + arrayProductos[j].id).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
                  var precioFinal = iStock * precio.attr("precioreal");

                  precio.val(precioFinal);

                  var nuevoStock = Number($('#' + arrayProductos[j].id).attr("stock")) - $('#' + arrayProductos[j].id).val();

                  $('#' + arrayProductos[j].id).attr("nuevoStock", nuevoStock);

                  if (Number($('#' + arrayProductos[j].id).val()) > Number($('#' + arrayProductos[j].id).attr("stock"))) {

                    $('#' + arrayProductos[j].id).val(1);

                    swal({
                      title: "La cantidad supera el Stock",
                      text: "¡Sólo hay " + $('#' + arrayProductos[j].id).attr("stock") + " unidades!",
                      type: "error",
                      showConfirmButton: false,
                      timer: 2000
                    });
                  }
                }
              }


              // SUMAR TOTAL DE PRECIOS

              sumarTotalPrecios()

              // AGREGAR IMPUESTO

              agregarImpuesto()

              // AGRUPAR PRODUCTOS EN FORMATO JSON

              listarProductos()
            } // Fin else (estaBarCode != true)
          } //Fin else (stock==0)
          estaBarCode = false;

        } else {
          swal({
            title: "Código de barras no encontrado",
            text: "¡Agregue este producto desde la tabla(Productos)!",
            type: "error",
            showConfirmButton: false,
            timer: 2000
          });
        }

      }
    })

    estaBarCode = false;
    $("#barcode").val("");

  }, 200);
  if ($("#nuevoImpuestoVenta").val() != "") {

    $(".impuesto").prop('checked', true);
  }

  if ($(".impuesto").prop('checked')) {
    $("#nuevoImpuestoVenta").prop("readonly", false);
  } else {
    $("#nuevoImpuestoVenta").val(0);
    $("#nuevoImpuestoVenta").prop("readonly", true);
  }

  //



  // cargar la foto del ultimo procducto guardado en la venta a edictar
  if ($("#seleccionarCliente").val() != "") {

    $(".previsualizar").attr("src", $("#imgProducto").val());
    $(".previsualizar").attr("hidden", false);
  }

  // console.log('/**');
  // console.log('	Copyright:');
  // console.log('	- © 2018 LTsoft. Todos los derechos reservados.');
  // console.log('	- SAIV v.1.0');
  // console.log('*/');

});

$(".impuesto").on("ifChecked", function () {
  if ($(".impuesto").prop('checked')) {

    $("#nuevoImpuestoVenta").val(19);
    $("#nuevoImpuestoVenta").prop("readonly", false);
    if ($("#nuevoTotalVenta").val() != "") {
      sumarTotalPrecios()
      // AGREGAR IMPUESTO
      agregarImpuesto()
    }
  }
});

$(".impuesto").on("ifUnchecked", function () {
  if ($(".impuesto").prop('checked')) {

  } else {
    if ($("#nuevoTotalVenta").val() != "") {
      sumarTotalPrecios()
    }
    $("#nuevoImpuestoVenta").val(0);
    $("#nuevoImpuestoVenta").prop("readonly", true);
  }
});


/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentas tbody").on("click", "button.agregarProducto", function () {

  var idProducto = $(this).attr("idProducto");

  $(this).removeClass("btn-outline-success agregarProducto");

  $(this).addClass("btn-light");
  $(this).css({
    'cursor': 'not-allowed'
  }); //css({'cursor': 'pointer'});

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

      var descripcion = respuesta["descripcion"];
      var stock = respuesta["stock"];
      var precio = respuesta["precio_venta"];
      var barcode = respuesta["barcode"];
      var ruta = respuesta["imagen"];

      /*------*/
      if (stock == 0) {

        swal({
          title: descripcion + "<br>Se encuentra agotad@",
          text: "¡No es posible agragar este producto a la venta",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });
      } //Fin if (stock==0)
      else {

        for (var j = 0; j < r; j++) {

          if (barcode == codigoBarra[j]) {

            estaBarCode = true;
          } else if (idProducto == codigoBarra[j]) {
            estaBarCode = true;
          }
        }
        if (estaBarCode != true) {

          if ((barcode == null) || (barcode == 0)) {
            codigoBarra.push(idProducto);
          } else {
            codigoBarra.push(barcode);
          }
          a = Number(a) + 1;
          $(".nuevoProducto").append(

            '<div class="row">' +
            '<!-- Información del producto -->' +
            '<div class="col-12 col-sm-6 pr-0">' +
            '<!-- Descripción del producto -->' +
            '<div class="input-group  has-feedback form-group desP">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; "><button type="button" class="btn btn-tool text-danger quitarProducto" idProducto="' + idProducto + '" index="' + a + '" style="padding: 1px; font-size:1.2em; text-align: center; line-height: 0.5;"><i class="fa fa-times-circle"></i></button></span>' +
            '</div>' +
            '<input type="text" class="form-control input-group-lg nuevaDescripcionProducto" idProducto="' + idProducto + '" name="agregarProducto" value="' + descripcion + '" required>' +
            '</div>' +
            '</div>' +
            '<!-- Cantidad -->' +
            '<div class="col-6 col-sm-3">' +
            '<div class="input-group  has-feedback form-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-boxes"></i></span>' +
            '</div>' +
            '<input type="number" class="form-control input-group-lg txtNumbers nuevaCantidadProducto" id="' + idProducto + '" name="nuevaCantidadProducto" min="1" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required>' +
            '</div>' +
            '</div>' +
            '<!-- Precio -->' +
            '<div class="col-6 col-sm-3 pl-0 ingresoPrecio">' +
            '<div class="input-group  has-feedback form-group">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-usd-circle"></i></span>' +
            '</div>' +
            '<input type="text" class="form-control input-group-lg nuevoPrecioProducto" precioReal="' + precio + '" name="nuevoPrecioProducto" value="' + precio + '" disabled required >' +
            '</div>' +
            '</div>' +
            '<input type="hidden" value="' + ruta + '">' +
            '</div>'
          )

          // imagen del producto
          arrayImagenes.push(ruta);

          $(".previsualizar").attr("src", ruta);
          $(".previsualizar").attr("hidden", false);

          // SUMAR TOTAL DE PRECIOS
          sumarTotalPrecios()

          // AGREGAR IMPUESTO
          agregarImpuesto()

          // AGRUPAR PRODUCTOS EN FORMATO JSON
          listarProductos()

          // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
          $(".nuevoPrecioProducto").number(true, 2);

          /*----------  variables  ----------*/
          var descripcion = $(".nuevaDescripcionProducto");
          var cantidad = $(".nuevaCantidadProducto");
          var precio = $(".nuevoPrecioProducto");
          var items = $("#items").val();
          var iStock = $("#iStock").val();

          /*--------------------------------------------*/
          arrayProductos.push({
            "id": $(descripcion[r]).attr("idProducto"),
            "descripcion": $(descripcion[r]).val(),
            "cantidad": $(cantidad[r]).val(),
            "barcode": barcode,
            "stock": $(cantidad[r]).attr("nuevoStock"),
            "precio": $(precio[r]).attr("precioReal"),
            "total": $(precio[r]).val()
          })

          r = Number(r) + 1;
          $("#item").val(Number(r) - 1);
          item = Number(item) + Number($("#item").val());

        } //Fin if (estaBarCode != true)
        else {

          for (var j = 0; j < r; j++) {

            if (barcode == arrayProductos[j].barcode) {

              iStock = $('#' + arrayProductos[j].id).val();
              var idPro = arrayProductos[j].id;

              iStock = Number(iStock) + 1;
              $("#iStock").val(iStock);
              $('#' + arrayProductos[j].id).val(iStock);

              /*modificar la contidad*/
              var precio = $('#' + arrayProductos[j].id).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
              var precioFinal = iStock * precio.attr("precioreal");

              precio.val(precioFinal);

              var nuevoStock = Number($('#' + arrayProductos[j].id).attr("stock")) - $('#' + arrayProductos[j].id).val();

              $('#' + arrayProductos[j].id).attr("nuevoStock", nuevoStock);

              if (Number($('#' + arrayProductos[j].id).val()) > Number($('#' + arrayProductos[j].id).attr("stock"))) {

                $('#' + arrayProductos[j].id).val(1);

                swal({
                  title: "La cantidad supera el Stock",
                  text: "¡Sólo hay " + $('#' + arrayProductos[j].id).attr("stock") + " unidades!",
                  type: "error",
                  showConfirmButton: false,
                  timer: 2000
                });
              }
            }
          }

          // SUMAR TOTAL DE PRECIOS
          sumarTotalPrecios()

          // AGREGAR IMPUESTO
          agregarImpuesto()

          // AGRUPAR PRODUCTOS EN FORMATO JSON
          listarProductos()
        } // Fin else (estaBarCode != true)
      } //Fin else (stock==0)
      estaBarCode = false;
    }
  })

});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function () {
  var idProducto = $(this).attr("idProducto");
  var rutaImagen;
  var index = $(this).attr("index");
  index = Number(index) - 1;
  $(this).parent().parent().parent().parent().parent().remove();
  delete arrayImagenes[index];
  delete codigoBarra[index];
  $.grep(arrayImagenes, function (value, items) {
    if (value != null) {
      rutaImagen = value;
    }

  })
  // actualizar imagen del producto
  $(".previsualizar").attr("src", rutaImagen);

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarProducto") == null) {

    idQuitarProducto = [];

  } else {

    idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
  }

  idQuitarProducto.push({
    "idProducto": idProducto
  });

  localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

  $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass('btn-light');

  $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass('btn-outline-success agregarProducto');
  $("button.recuperarBoton[idProducto='" + idProducto + "']").css({
    'cursor': 'pointer'
  });

  if ($(".nuevoProducto").children().length == 0) {

    $("#nuevoImpuestoVenta").val(0);
    $("#nuevoTotalVenta").val(0.00);
    $("#totalVenta").val(0.00);
    $("#nuevoTotalVenta").attr("total", 0.00);
    $(".previsualizar").attr("hidden", true);
    arrayImagenes = [];
    codigoBarra = [];
    a = 0;

  } else {

    // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios()

    // AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

  }

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

$(".btnAgregarProducto").click(function () {

  var datos = new FormData();
  datos.append("traerProductos", "ok");

  $.ajax({

    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {

      $(".nuevoProducto").append(

        '<div class="row">' +

        '<!-- Información del producto -->' +
        '<div class="col-12 col-sm-6 pr-0">' +
        '<!-- Descripción del producto -->' +
        '<div class="input-group  has-feedback form-group">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; "><button type="button" class="btn btn-tool text-danger quitarProducto" idProducto style="padding: 1px; font-size:1.2em; text-align: center; line-height: 0.5;"><i class="fa fa-times-circle"></i></button></span>' +
        '</div>' +
        '<!-- Select producto -->' +
        '<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>' +
        '<option disabled selected>Productos</option>' +
        '</select>' +
        '</div>' +
        '</div>' +
        '<!-- Cantidad -->' +
        '<div class="col-6 col-sm-3 ingresoCantidad">' +
        '<div class="input-group  has-feedback form-group">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-boxes"></i></span>' +
        '</div>' +
        '<input type="number" class="form-control input-group-lg txtNumbers nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock required>' +
        '</div>' +
        '</div>' +
        '<!-- Precio -->' +
        '<div class="col-6 col-sm-3 pl-0 ingresoPrecio">' +
        '<div class="input-group  has-feedback form-group">' +
        '<div class="input-group-prepend">' +
        '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-usd-circle"></i></span>' +
        '</div>' +
        '<input type="text" class="form-control input-group-lg nuevoPrecioProducto" precioReal name="nuevoPrecioProducto" value disabled required >' +
        '</div>' +
        '</div>' +
        '</div>'

      );


      // AGREGAR LOS PRODUCTOS AL SELECT 

      respuesta.forEach(funcionForEach);

      function funcionForEach(item, index) {

        $(".nuevaDescripcionProducto").append(

          '<option idProducto="' + item.id + '" value="' + item.descripcion + '">' + item.descripcion + '</option>'
        )

      }

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPrecios()

      // AGREGAR IMPUESTO

      agregarImpuesto()

      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto").number(true, 2);

    }


  })

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function () {

  var nombreProducto = $(this).val();

  var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

  var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

  var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children().children(".nuevaCantidadProducto");

  var datos = new FormData();
  datos.append("nombreProducto", nombreProducto);

  $.ajax({

    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"]) - 1);
      $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductos()

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPrecios()

      // AGREGAR IMPUESTO

      agregarImpuesto()

      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto").number(true, 2);

    }



  })


})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function () {

  var precio = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  var precioFinal = $(this).val() * precio.attr("precioreal");

  precio.val(precioFinal);

  var nuevoStock = Number($(this).attr("stock")) - $(this).val();

  if (Number($(this).val()) > Number($(this).attr("stock"))) {

    $(this).val(1);

    swal({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
      type: "error",
      confirmButtonText: "¡Cerrar!"
    });

  }
  else {
    $(this).attr("nuevoStock", nuevoStock);
  }

  // SUMAR TOTAL DE PRECIOS

  sumarTotalPrecios()

  // AGREGAR IMPUESTO

  agregarImpuesto()

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductos()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios() {

  var precioItem = $(".nuevoPrecioProducto");
  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {

    arraySumaPrecio.push(Number($(precioItem[i]).val()));

  }

  function sumaArrayPrecios(total, numero) {

    return total + numero;

  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

  $("#nuevoTotalVenta").val(sumaTotalPrecio);
  $("#totalVenta").val(sumaTotalPrecio);
  $("#nuevoTotalVenta").attr("total", sumaTotalPrecio);


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto() {

  var impuesto = $("#nuevoImpuestoVenta").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");

  var precioImpuesto = Number(precioTotal * impuesto / 100);

  var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

  $("#nuevoTotalVenta").val(totalConImpuesto);

  $("#totalVenta").val(totalConImpuesto);

  $("#nuevoPrecioImpuesto").val(precioImpuesto);

  $("#nuevoPrecioNeto").val(precioTotal);

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function () {
  agregarImpuesto();
});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function () {

  var metodo = $(this).val();

  if (metodo == "Efectivo") {

    $(this).parent().parent().removeClass("col-12 col-sm-6");
    $(this).parent().parent().addClass("col-12 col-sm-5");

    $(this).parent().parent().parent().children('.cajasMetodoPago').addClass('col-12 col-sm-7');

    $(this).parent().parent().parent().children(".cajasMetodoPago").html(

      '<div class="form-group row">' +
      '<div class="col-12 col-sm-6">' +
      '<div class="input-group  has-feedback form-group">' +
      '<div class="input-group-prepend">' +
      '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-usd-circle"></i></span>' +
      '</div>' +
      '<input type="text" class="form-control input-group-lg" id="nuevoValorEfectivo" placeholder="0.000,00" required >' +
      '</div>' +
      '</div>' +

      '<div class="col-12 col-sm-6" id="capturarCambioEfectivo">' +
      '<div class="input-group  has-feedback form-group">' +
      '<div class="input-group-prepend">' +
      '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-money-bill-alt"></i></span>' +
      '</div>' +
      '<input type="text" class="form-control input-group-lg" id="nuevoCambioEfectivo" placeholder="0.000,00" readonly required >' +
      '</div>' +
      '<!-- icono cambio -->' +
      '<div class="row">' +
      '<div class="col-12">' +
      '<h5><span class="badge badge-dark float-right badge-cambio">Cambio</span></h5>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>'
    )

    // Agregar formato al precio

    $('#nuevoValorEfectivo').number(true, 2);
    $('#nuevoCambioEfectivo').number(true, 2);


    // Listar método en la entrada
    listarMetodos();

  } else {

    $(this).parent().parent().removeClass('col-12 col-sm-5');

    $(this).parent().parent().addClass('col-12 col-sm-6');


    $(this).parent().parent().parent().children('.cajasMetodoPago').removeClass('col-12 col-sm-7');

    $(this).parent().parent().parent().children('.cajasMetodoPago').addClass('col-12 col-sm-6');

    $(this).parent().parent().parent().children('.cajasMetodoPago').html(
      '<div class="form-group row">' +
      '<div class="col-12">' +
      '<div class="input-group  has-feedback form-group">' +
      '<div class="input-group-prepend">' +
      '<span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-lock"></i></span>' +
      '</div>' +
      '<input type="text" class="form-control input-group-lg" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" data-toggle="tooltip" data-placement="top" title="Ejemplos: Tarjeta credito: TC-00001; Tarjeta debito: TD-00001 " required>' +
      '</div>' +
      '</div>' +
      '</div>'
    )

  }
})

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("keyup", "input#nuevoValorEfectivo", function () {

  var efectivo = $(this).val();

  if ($("#nuevoValorEfectivo").val().length > 1) {

    var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

    var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

    nuevoCambioEfectivo.val(cambio);

    if (cambio < 0) {
      $(".badge-cambio").removeClass("badge-dark");
      $(".badge-cambio").addClass("badge-danger");
    } else if (cambio > 0) {
      $(".badge-cambio").removeClass("badge-danger");
      $(".badge-cambio").addClass("badge-success");
    }
  } else {
    $(".badge-cambio").removeClass("badge-danger");
    $(".badge-cambio").addClass("badge-dark");
  }
})


/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function () {

  // Listar método en la entrada
  listarMetodos();


})


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos() {

  var listaProductos = [];

  var descripcion = $(".nuevaDescripcionProducto");

  var cantidad = $(".nuevaCantidadProducto");

  var precio = $(".nuevoPrecioProducto");

  for (var i = 0; i < descripcion.length; i++) {

    listaProductos.push({
      "id": $(descripcion[i]).attr("idProducto"),
      "descripcion": $(descripcion[i]).val(),
      "cantidad": $(cantidad[i]).val(),
      "stock": $(cantidad[i]).attr("nuevoStock"),
      "precio": $(precio[i]).attr("precioReal"),
      "total": $(precio[i]).val()
    })

  }

  $("#listaProductos").val(JSON.stringify(listaProductos));
}

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos() {

  var listaMetodos = "";

  if ($("#nuevoMetodoPago").val() == "Efectivo") {

    $("#listaMetodoPago").val("Efectivo");

  } else {

    $("#listaMetodoPago").val($("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val());

  }

}

/*=============================================
BOTON EDITAR VENTA
=============================================*/

$(".tablas").on("click", ".btnEditarVenta", function () {

  var idVenta = $(this).attr("idVenta");
  // console.log("idVenta", idVenta);

  window.location = "index.php?ruta=editar-venta&idVenta=" + idVenta;


})


/*=============================================
BORRAR VENTA
=============================================*/

$(".tablas").on("click", ".btnEliminarVenta", function () {

  var idVenta = $(this).attr("idVenta");

  swal({
    title: '¿Está seguro de borrar la venta?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar venta!'
  }).then(function (result) {
    if (result.value) {

      window.location = "index.php?ruta=ventas&idVenta=" + idVenta;
    }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/
$(".tablas").on("click", ".btnImprimirFactura", async function () {

  var codigoVenta = $(this).attr("codigoVenta");

  // inputOptions can be an object or Promise
  var inputOptions = new Promise((resolve) => {
    setTimeout(() => {
      resolve({
        'ticket': 'Ticket',
        'factura': 'Factura'
      })
    }, 1000)
  })

  const {
    value: tipoImprecion
  } = await swal({
    title: '¿Seleccione que desea imprimir?',
    type: 'question',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '<i class="fal fa-print"></i> Imprimir',
    input: 'radio',
    showCancelButton: true,
    inputOptions: inputOptions,
    inputValidator: (value) => {
      return !value && 'Debe seleccionar una opción!'
    }
  })

  if (tipoImprecion == "ticket") {
    window.open("extensiones/ticket/exTicket.php?codigo=" + codigoVenta, "_blank");
  } else if (tipoImprecion == "factura") {
    window.open("extensiones/tcpdf/pdf/factura.php?codigo=" + codigoVenta, "_blank");
  }

});

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn').daterangepicker({
    ranges: {
      'Hoy': [moment(), moment()],
      'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes': [moment().startOf('month'), moment().endOf('month')],
      'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate: moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');
    var capturarRango = $("#daterange-btn span").html();
    localStorage.setItem("capturarRango", capturarRango);

    window.location = "index.php?ruta=ventas&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;


  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function () {

  localStorage.removeItem("capturarRango");
  localStorage.clear();
  window.location = "ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensright .ranges li").on("click", function () {

  var textoHoy = $(this).val();

  if (textoHoy == 0) {

    var d = new Date();

    var dia = d.getDate();
    var mes = d.getMonth() + 1;
    var año = d.getFullYear();

    if (mes < 10) {

      var fechaInicial = año + "-0" + mes + "-" + dia;

      var fechaFinal = año + "-0" + mes + "-" + dia;

    } else if (dia < 10) {

      var fechaInicial = año + "-" + mes + "-0" + dia;

      var fechaFinal = año + "-" + mes + "-0" + dia;


    } else if (mes < 10 && dia < 10) {

      var fechaInicial = año + "-0" + mes + "-0" + dia;

      var fechaFinal = año + "-0" + mes + "-0" + dia;

    } else {

      var fechaInicial = año + "-" + mes + "-" + dia;

      var fechaFinal = año + "-" + mes + "-" + dia;

    }

    localStorage.setItem("capturarRango", "Hoy");

    window.location = "index.php?ruta=ventas&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;

  }

})

if (window.matchMedia("(max-width:767px)").matches) {
  $(".imp-total").removeClass("form-control-lg");
  $(".imp-total").css("font-size", 10);
}
else{
  $(".imp-total").addClass("form-control-lg");
  $(".imp-total").css("font-size", 16);
}