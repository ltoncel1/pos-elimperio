<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Ventas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <i class="nav-icon fa fa-home"></i>
              <a href="inicio">Inicio</a>
            </li>
            <li class="breadcrumb-item active">Administrar Ventas</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="crear-venta">
            <button class="btn btn-outline-primary"><i class="fal fa-shopping-cart"></i> Agregar</button>
          </a>
          <!-- Date and time range -->
          <button type="button" class="btn btn-default float-right" id="daterange-btn">
            <span>
              <i class="fal fa-calendar-alt"></i> Fecha
            </span>
            <i class="fal fa-caret-down"></i>
          </button>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped dt-responsive tablas" style="width: 100%;">
            <!-- cabezara de la tabla -->
            <thead>
              <tr>
                <th class="text-center" style="width: 10px;">#</th>
                <th class="text-center">No. factura</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Vendedor</th>
                <th class="text-center">Forma de pago</th>
                <th class="text-center">Valor neto</th>
                <th class="text-center">Total venta</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <!-- cuerpo de la tabla -->
            <tbody>
              <?php
                if(isset($_GET["fechaInicial"])){
                    $fechaInicial = $_GET["fechaInicial"];
                    $fechaFinal = $_GET["fechaFinal"];
                  }
                  else{
                    $fechaInicial = null;
                    $fechaFinal = null;
                  }
                $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
                foreach ($respuesta as $key => $value) {
                  echo '<tr>
                    <td class="text-center">'.($key+1).'</td>
                    <td class="text-center">'.$value["codigo"].'</td>';
                    $itemCliente = "id";
                    $valorCliente = $value["id_cliente"];
                    $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
                    echo '<td>'.$respuestaCliente["nombre"].'</td>';
                    $itemUsuario = "id";
                    $valorUsuario = $value["id_vendedor"];
                    $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
                    echo '<td>'.$respuestaUsuario["nombre"].'</td>
                    <td class="text-center">'.$value["metodo_pago"].'</td>
                    <td class="text-center">$ '.number_format($value["neto"],2).'</td>
                    <td class="text-center">$ '.number_format($value["total"],2).'</td>
                    <td class="text-center">'.$value["fecha"].'</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-outline-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'"><i class="fal fa-print"></i></button>';
                        if($_SESSION["perfil"] == "Administrador"){
                          echo'<button class="btn btn-outline-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fal fa-edit"></i></button>
                          <button class="btn btn-outline-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fal fa-times-circle"></i></button>';
                        }
                      echo'</div>
                    </td>                  
                  </tr>';
                }
              ?>
            </tbody>
            <!-- pie de pagina tabla -->
            <tfoot>
            <tr>
              <th class="text-center" style="width: 10px;">#</th>
              <th class="text-center">No. factura</th>
              <th class="text-center">Cliente</th>
              <th class="text-center">Vendedor</th>
              <th class="text-center">Forma de pago</th>
              <th class="text-center">Valor neto</th>
              <th class="text-center">Total venta</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Acciones</th>
            </tr>
            </tfoot>
          </table>
          <?php
          $eliminarVenta = new ControladorVentas();
          $eliminarVenta -> ctrEliminarVenta();
          ?>
        </div>
      </div>
    </div>
  </div>
  </section>
</div>