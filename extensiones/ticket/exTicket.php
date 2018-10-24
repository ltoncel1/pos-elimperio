<?php
require_once "../../controladores/ventas.controlador.php";
require_once "../../modelos/ventas.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

require_once "../../controladores/productos.controlador.php";
require_once "../../modelos/productos.modelo.php";
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="css/ticket.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php
class imprimirTicket{

public $codigo;

public function traerImpresionTicket(){
//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
$nombreCliente = $respuestaCliente["nombre"];
$cedulaCliente = $respuestaCliente["documento"];

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);
$nombreVendedor = $respuestaVendedor["nombre"];

//Establecemos los datos de la empresa
$empresa = "El Imperio";
$documento = "71.759.963-9";
$direccion = "Calle 44B 92-11";
$telefono = "(300) 646-3189";
$email = "ventas@elimperio.com.co";

?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        .::<strong> <?php echo $empresa; ?></strong>::.<br>
        <?php echo "NIT: ".$documento; ?><br>
        <?php echo $direccion .' - '.$telefono; ?><br>
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo $fecha; ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td>Cliente: <?php echo $nombreCliente; ?></td>
    </tr>
    <tr>
        <td><?php echo "Cedula: ".$cedulaCliente; ?></td>
    </tr>
    <tr>
        <td>Factura No: <?php echo $valorVenta; ?></td>
    </tr>    
</table>
<br>
<!-- Mostramos los detalles de la venta en el documento HTML -->
<table border="0" align="center" width="300px">
    <tr>
        <td>Producto</td>
        <td>Cantidad</td>
        <!-- <td>Valor Unit.</td> -->
        <td align="right">Valor Total</td>
    </tr>
    <tr>
      <td colspan="3">==========================================</td>
    </tr>
    <?php
    $cantidad=0;
    foreach ($productos as $key => $item) {
      $itemProducto = "descripcion";
      $valorProducto = $item["descripcion"];
      $orden = null;

      $respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

      $valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

      $precioTotal = number_format($item["total"], 2);
      
      echo "<tr>";
      echo "<td>".$item["descripcion"]."</td>";
      echo "<td>".$item["cantidad"]."</td>";
      //echo "<td>".$valorUnitario."</td>";
      echo "<td align='right'>$ ".$precioTotal."</td>";
      echo "</tr>";
      $cantidad+=$item["cantidad"];
    }
  
    echo '<!-- Mostramos los totales de la venta en el documento HTML -->
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <td colspan="3">-------------------------------------------------------------------------</td>';
    echo '<tr>
    <!-- Neto -->
    <td>&nbsp;</td>
    <td align="right"><b>Neto:</b></td>
    <td align="right">$ '.$neto.'</td>
    </tr>
    <tr>
    <!-- Impuesto -->
    <td>&nbsp;</td>
    <td align="right"><b>Impuesto:</b></td>
    <td align="right">$ '.$impuesto.'</td>
    </tr>
    <!-- line -->
    
    <td colspan="3">==========================================</td>
    </tr>
    <tr>
    <!-- Total -->
    <td>&nbsp;</td>
    <td align="right"><b>TOTOAL:</b></td>
    <td align="right"><b>$ '.$total.'</b></td>
    </tr>
    <tr>
      <td colspan="3">Nº de artículos: '.$cantidad.'</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>      
    <tr>
      <td colspan="3" align="center">¡Gracias por su compra!</td>
    </tr>
    <tr>
      <td colspan="3" align="center">Vendedor: '.$nombreVendedor.'</td>
    </tr>
    <tr>
      <td colspan="3" align="center">Fonseca, La Guajira - Colombia</td>
    </tr>
    
</table>';
}
}
?>
<br>
</div>
<p>&nbsp;</p>

</body>
<?php 
$ticket = new imprimirTicket();
$ticket -> codigo = $_GET["codigo"];
$ticket -> traerImpresionTicket();
?>
</html>