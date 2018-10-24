<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Crear venta</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <i class="nav-icon fa fa-home"></i>
              <a href="inicio">Inicio</a>
            </li>
            <li class="breadcrumb-item active">Crear venta</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <!--========================
      =     Formulario           =
      =========================-->
      <div class="col-lg-6">
        <div class="card card-success card-outline">
          <div class="card-header">
            <h3 class="card-title">Información de la venta</h3>
          </div>
          <form role="form" method="post" class="formularioVenta">
            <div class="card-body">
              <div class="form-group">
                <!-- Información del Vendedor -->
                <div class="input-group  has-feedback form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control input-group-lg" readonly value="<?php echo $_SESSION["nombre"]; ?>">
                  <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                </div>
                <!-- Código de la venta -->
                <div class="input-group  has-feedback form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-shopping-cart"></i></span>
                  </div>
                  <?php
                  $item   = null;
                  $valor  = null;
                  $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                  $codigos = array();
                  if (!$ventas) {
                  echo '<input type="number" class="form-control input-group-lg" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                  } else {
                  foreach ($ventas as $key => $value) {
                    array_push($codigos, $value);
                  }
                  $codigo = array_values($codigos)[0][1] + 1;
                  echo '<input type="number" class="form-control input-group-lg" id="nuevaVenta" name="nuevaVenta" value="' . $codigo . '" readonly>';
                  }
                  ?>
                </div>
                <!-- cliente -->
                <div class="input-group  has-feedback form-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-users"></i></span>
                  </div>
                  <!-- Select cliente -->
                  <select class="form-control mr-1" id="seleccionarCliente" name="seleccionarCliente" required >
                    <option value="" disabled selected>Seleccione el cliente</option>
                    <?php
                      $item       = null;
                      $valor      = null;
                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);
                      foreach ($categorias as $key => $value) {
                        echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                      }
                    ?>
                  </select>
                  <input type="hidden" id="listaProductos" name="listaProductos">
                  <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalAgregarCliente"><i class="fal fa-user-plus"></i></button>
                </div>
                <!-- Contenedor para agregar productos a la venta -->
                <div class="form-group row nuevoProducto"></div>
                 <!-- Botón para agregar producto en pantallas sm-md -->
                <div class="row d-sm-block d-lg-none">
                    <div class="col-12">
                      <button type="button" class="btn btn-outline-secondary btn-sm d-sm-block d-lg-none btnAgregarProducto"><i class="fal fa-box-open"></i> Agregar producto</button>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <!-- Impuesto & Total -->
                <div class="form-group row">
                  
                  <div class="col-12 col-sm-8 ">
                    <table class="table">
                      <thead>
                        <tr>
                         <th class="text-center">
                           <label>
                             <input type="checkbox" class="minimal impuesto" >
                            Impuesto
                           </label>
                         </th>
                         <th class="text-center">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <!-- Impuesto -->
                          <td style="width: 45%">
                            <div class="input-group">
                              <input type="number" class="form-control input-group-lg form-control-lg imp-total" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" min="0" value="" required>
                              <!-- Ocultos -->
                              <input type="hidden" id="nuevoPrecioImpuesto" name="nuevoPrecioImpuesto" required>
                              <input type="hidden" id="nuevoPrecioNeto" name="nuevoPrecioNeto" required>
                              <!-- ------- -->
                              <div class="input-group-append">
                                <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-percent"></i></span>
                              </div>
                            </div>
                          </td>
                          <!-- Precio de venta -->
                          <td style="width: 55%">
                            <div class="input-group  has-feedback form-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-usd-circle"></i></span>
                              </div>
                              <input type="text" class="form-control input-group-lg form-control-lg imp-total" id="nuevoTotalVenta" name="nuevoTotalVenta" total placeholder="0.00" readonly required >
                            </div>
                            <input type="hidden" id="totalVenta" name="totalVenta" required>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- foto del producto -->
                  <div class="col-sm-4 text-center fotoProducto d-none d-lg-block">
                    <img src="vistas/images/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="180" hidden>
                    <input type="hidden" id="imagenActual" name="imagenActual">
                  </div>
                </div>
                <!-- </div> -->
                <!-- <div class="col-sm-4 float-left">esto va a la izquierda</div> -->
                <input type="hidden" id="item" value="0">
                <input type="hidden" id="iStock" value="0">
                <hr>
                <br>
                <!-- Modo de pago -->
                <div class="form-group row">
                  <div class="col-12 col-sm-6">
                    <div class="input-group  has-feedback form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-credit-card"></i></span>
                      </div>
                      <!-- Select Medio de pago -->
                      <select class="form-control input-group-sm" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="" disabled selected >Medio de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>
                      </select>
                    </div>
                  </div>
                  <div class="cajasMetodoPago"></div>
                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-success float-right">Guardar venta</button>
            </div>
          </form>
         <?php 
           
           $guardarVenta = new ControladorVentas();
           $guardarVenta -> ctrCrearVenta();
         
         ?>
        </div>
      </div>
      <!--========================
      =     Tabla de productos   =
      =========================-->
      <div class="col-lg-6 d-none d-lg-block">
        <div class="card card-warning card-outline">
          <div class="card-header">
            <h3 class="card-title">Tabla de Productos</h3>
          </div>
          <div class="card-body">
            <!-- Código de barras-->
            <div class="input-group  has-feedback form-group">
              <div class="input-group-prepend">
                <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff;"><i class="fal fa-barcode-alt"></i></span>
              </div>
              <input type="text" class="form-control input-group-lg txtNumbers" id="barcode" name="barcode" placeholder="Ingrese código de barras">
              <input type="hidden" id="codigoProducto" name="codigoProducto" >
              <input type="hidden" id="estadoProducto">
            </div>
            <table class="table table-bordered table-striped dt-responsive tablaVentas" style="width: 100%;">
              <!-- cabezara de la tabla -->
              <thead>
                <tr>
                  <th class="text-center" style="width: 10px;">#</th>
                  <th class="text-center">Imagen</th>
                  <th>Descripción</th>
                  <th class="text-center">Stock</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <!-- pie de pagina tabla -->
              <tfoot>
              <tr>
                <th class="text-center" style="width: 10px;">#</th>
                <th class="text-center">Imagen</th>
                <th>Descripción</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Acciones</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--====================================================================
=            Formulario modal para agregar un nuevo Cliente            =
=====================================================================-->
<!-- The Modal -->
<div class="modal fade" id="modalAgregarCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <!-- Modal Header -->
        <div class="modal-header" style="background: rgba(52,58,64,.85); color: #d2d6de;">
          <h4 class="modal-title">Agregar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <!-- Nombre del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-users"></i></span>
            </div>
            <input type="text" class="form-control input-group-lg" id="nuevoCliente" name="nuevoCliente" placeholder="Nombre del cliente *" required>
          </div>
          <!-- cedula del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-address-card"></i></span>
            </div>
            <input type="number" class="form-control input-group-lg" id="nuevoDocumentoId" name="nuevoDocumentoId" placeholder="Numero de cedula *" required>
          </div>
          <!-- Teléfono del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-phone"></i></span>
            </div>
            <input type="text" class="form-control input-group-lg" id="nuevoTelefono" name="nuevoTelefono" placeholder="Teléfono *" data-inputmask='"mask": "(999) 999-9999"' data-mask >
          </div>
          <!-- E-mail del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control input-group-lg" id="nuevoEmail" name="nuevoEmail" placeholder="E-mail *" >
          </div>
          <!-- Dirección del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-map-marker-alt"></i></span>
            </div>
            <input type="text" class="form-control input-group-lg" id="nuevaDireccion" name="nuevaDireccion" placeholder="Dirección" >
          </div>
          <!-- Fecha de nacimiento del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; "><i class="fal fa-calendar-alt"></i></span>
            </div>
            <input type="text" class="form-control input-group-lg" id="nuevaFechaNacimiento" name="nuevaFechaNacimiento" placeholder="Fecha de nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask >
          </div>
          <input type="hidden" name="esUnaVenta">
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger cerrarModal" data-dismiss="modal">Salir</button>
          <button type="button" class="btn btn-outline-primary" id="btnSaveCliente" data-dismiss>Guardar cliente</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--====  End of Formulario modal para agregar un nuevo Cliente  ====-->