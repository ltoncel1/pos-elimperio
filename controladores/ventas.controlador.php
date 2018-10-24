<?php

class ControladorVentas
{

    /*=============================================
    MOSTRAR VENTAS
    =============================================*/

    public static function ctrMostrarVentas($item, $valor)
    {

        $tabla = "ventas";
        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    CREAR VENTA
    =============================================*/

    public static function ctrCrearVenta()
    {

        if (isset($_POST["nuevaVenta"])) {

            /*=============================================
            ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
            =============================================*/

            $listaProductos = json_decode($_POST["listaProductos"], true);
            
            $totalProductosComprados = array();

            foreach ($listaProductos as $key => $value) {

                array_push($totalProductosComprados, $value["cantidad"]);

                $tablaProductos = "productos";

                $item  = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a  = "ventas";
                $valor1a = $value["cantidad"] + $traerProducto["ventas"];

                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b  = "stock";
                $valor1b = $value["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

            }

            $tablaClientes = "clientes";

            $item  = "id";
            $valor = $_POST["seleccionarCliente"];

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);



            $item1a  = "compras";
            $valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

            $item1b = "ultima_compra";

            date_default_timezone_set('America/Bogota');

            $fecha   = date('Y-m-d');
            $hora    = date('H:i:s');
            $valor1b = $fecha . ' ' . $hora;

            $fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

            /*=============================================
            GUARDAR LA COMPRA
            =============================================*/

            $tabla = "ventas";

            $datos = array("id_vendedor" => $_POST["idVendedor"],
                "id_cliente"                 => $_POST["seleccionarCliente"],
                "codigo"                     => $_POST["nuevaVenta"],
                "productos"                  => $_POST["listaProductos"],
                "impuesto"                   => $_POST["nuevoPrecioImpuesto"],
                "neto"                       => $_POST["nuevoPrecioNeto"],
                "total"                      => $_POST["totalVenta"],
                "metodo_pago"                => $_POST["listaMetodoPago"]);

            $respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

            }

        }

    }

    /*=============================================
    EDITAR VENTA
    =============================================*/

    public static function ctrEditarVenta()
    {

        if (isset($_POST["editarVenta"])) {

            /*=============================================
            FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
            =============================================*/
            $tabla = "ventas";

            $item  = "codigo";
            $valor = $_POST["editarVenta"];

            $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

            $productos = json_decode($traerVenta["productos"], true);

            $totalProductosComprados = array();

            foreach ($productos as $key => $value) {

                array_push($totalProductosComprados, $value["cantidad"]);

               $tablaProductos = "productos";

                $item  = "id";
                $valor = $value["id"];
                $orden = "id";

                 $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a  = "ventas";
                $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b  = "stock";
                $valor1b = $value["cantidad"] + $traerProducto["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

            }

            $tablaClientes = "clientes";

            $itemCliente  = "id";
            $valorCliente = $_POST["seleccionarCliente"];

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);
            $item1a  = "compras";
            $valor1a = intval($traerCliente["compras"]) - array_sum($totalProductosComprados);
            
            $valor = $traerCliente["id"];
           
           $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

            /*=============================================
            ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
            =============================================*/

            $Productos = json_decode($_POST["listaProductos"], true);

            $totalProductosComprados_2 = array();

            foreach ($Productos as $key => $value) {

                array_push($totalProductosComprados_2, $value["cantidad"]);

                $tablaProductos_2 = "productos";

                $item_2  = "id";
                $valor_2 = $value["id"];
                $orden   = "id";

                $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

                $item1a_2  = "ventas";
                $valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

                $nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

                $item1b_2  = "stock";
                $valor1b_2 = $value["stock"];

                $nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

            }

            $tablaClientes_2 = "clientes";

            $item_2  = "id";
            $valor_2 = $_POST["seleccionarCliente"];

            $traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

            $item1a_2  = "compras";
            $valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

            $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

            $item1b_2 = "ultima_compra";

            date_default_timezone_set('America/Bogota');

            $fecha     = date('Y-m-d');
            $hora      = date('H:i:s');
            $valor1b_2 = $fecha . ' ' . $hora;

            $fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

            /*=============================================
            GUARDAR CAMBIOS DE LA COMPRA
            =============================================*/

            $datos = array("id_vendedor" => $_POST["idVendedor"],
                "id_cliente"                 => $_POST["seleccionarCliente"],
                "codigo"                     => $_POST["editarVenta"],
                "productos"                  => $_POST["listaProductos"],
                "impuesto"                   => $_POST["nuevoPrecioImpuesto"],
                "neto"                       => $_POST["nuevoPrecioNeto"],
                "total"                      => $_POST["totalVenta"],
                "metodo_pago"                => $_POST["listaMetodoPago"]);

            $respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

            }

        }

    }

    /*=============================================
    ELIMINAR VENTA
    =============================================*/

    public static function ctrEliminarVenta()
    {

        if (isset($_GET["idVenta"])) {

            $tabla = "ventas";

            $item  = "id";
            $valor = $_GET["idVenta"];

            $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

            /*=============================================
            ACTUALIZAR FECHA ÚLTIMA COMPRA
            =============================================*/

            $tablaClientes = "clientes";

            $itemVentas  = null;
            $valorVentas = null;

            $traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

            $guardarFechas = array();

            foreach ($traerVentas as $key => $value) {

                if ($value["id_cliente"] == $traerVenta["id_cliente"]) {

                    array_push($guardarFechas, $value["fecha"]);

                }

            }

            if (count($guardarFechas) > 1) {

                if ($traerVenta["fecha"] > $guardarFechas[count($guardarFechas) - 2]) {

                    $item           = "ultima_compra";
                    $valor          = $guardarFechas[count($guardarFechas) - 2];
                    $valorIdCliente = $traerVenta["id_cliente"];

                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

                } else {

                    $item           = "ultima_compra";
                    $valor          = $guardarFechas[count($guardarFechas) - 1];
                    $valorIdCliente = $traerVenta["id_cliente"];

                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

                }

            } else {

                $item           = "ultima_compra";
                $valor          = "0000-00-00 00:00:00";
                $valorIdCliente = $traerVenta["id_cliente"];

                $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

            }

            /*=============================================
            FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
            =============================================*/

            $productos = json_decode($traerVenta["productos"], true);

            $totalProductosComprados = array();

            foreach ($productos as $key => $value) {

                array_push($totalProductosComprados, $value["cantidad"]);

                $tablaProductos = "productos";

                $item  = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a  = "ventas";
                $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b  = "stock";
                $valor1b = $value["cantidad"] + $traerProducto["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

            }

            $tablaClientes = "clientes";

            $itemCliente  = "id";
            $valorCliente = $traerVenta["id_cliente"];

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

            $item1a  = "compras";
            $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

            /*=============================================
            ELIMINAR VENTA
            =============================================*/

            $respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

            }
        }

    }

    /*=============================================
    RANGO FECHAS
    =============================================*/

    public static function ctrRangoFechasVentas($fechaInicial, $fechaFinal)
    {

        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);
        
        return $respuesta;

    }

    /*=============================================
    DESCARGAR REPORTE DE VENTAS EN EXCEL
    =============================================*/

    public function ctrDescargarReporte()
    {
        if (isset($_GET["reporte"])) {

            $tabla = "ventas";
            if (isset($_GET["Inicial"])) {
                $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["Inicial"], $_GET["Final"]);
            } else {
                $item  = null;
                $valor = null;

                $ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
            }

            // SUMAMOS EL TOTAL DE TODAS LAS VENTAS

            $arrayFechas = array();
            $arrayVentas = array();
            $sumaPagosMes = array();

            foreach ($ventas as $key => $value) {

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

            if($noRepetirFechas != null){
              foreach($noRepetirFechas as $key){
                $sumaTotal += $sumaPagosMes[$key];
              }
            }

            //

            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            $Name = $_GET["reporte"] . '.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'>

					<tr>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>CÓDIGO</td>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>CLIENTE</td>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>VENDEDOR</td>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>CANTIDAD</td>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>PRODUCTOS</td>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>IMPUESTO</td>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>NETO</td>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>TOTAL</td>
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>METODO DE PAGO</td
					<td class='text-center' style='font-weight:bold; border:0.8px solid #3B4048;'>FECHA</td>
					</tr>");

            foreach ($ventas as $row => $item) {

                $cliente  = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
                $vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

                echo utf8_decode("<tr>
                <td style='border:0.8px solid #3B4048;'>" . $item["codigo"] . "</td>
                <td style='border:0.8px solid #3B4048;'>" . $cliente["nombre"] . "</td>
                <td style='border:0.8px solid #3B4048;'>" . $vendedor["nombre"] . "</td>
                <td style='border:0.8px solid #3B4048;'>");

                $productos = json_decode($item["productos"], true);

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["cantidad"] . "<br>");
                }

                echo utf8_decode("</td><td style='border:0.8px solid #3B4048;'>");

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["descripcion"] . "<br>");

                }

                echo utf8_decode("</td>
					<td style='border:0.8px solid #3B4048;'>$ " . number_format($item["impuesto"], 2) . "</td>
					<td style='border:0.8px solid #3B4048;'>$ " . number_format($item["neto"], 2) . "</td>
					<td style='border:0.8px solid #3B4048;'>$ " . number_format($item["total"], 2) . "</td>
					<td style='border:0.8px solid #3B4048;'>" . $item["metodo_pago"] . "</td>
					<td style='border:0.8px solid #3B4048;'>" . substr($item["fecha"], 0, 10) . "</td>
		 			</tr>");

            }

            echo("<tr></tr>");
            echo("<tr></tr>");
            echo("<tr></tr>");
            echo utf8_decode("</td>
					<td ></td>
					<td ></td>
          <td ></td>
          <td ></td>
					<td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
					<td class='text-center' style='font-weight:bold; font-style: italic;'>TOTAL VENTAS =></td>
					<td >$ " . number_format($sumaTotal, 2) . "</td>
		 			</tr>");
            echo "</table>";

        }

    }

    /*=============================================
    SUMA TOTAL VENTAS
    =============================================*/

    public function ctrSumaTotalVentas()
    {

        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

        return $respuesta;

    }

}
