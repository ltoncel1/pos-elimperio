<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Clientes</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <i class="nav-icon fa fa-home"></i>
              <a href="inicio">Inicio</a>
            </li>
            <li class="breadcrumb-item active">Administrar Clientes</li>
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
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregarCliente">
              <i class="fal fa-users"></i> Agregar</button>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped dt-responsive tablas" style="width: 100%;">
              <!-- cabezara de la tabla -->
              <thead>
                <tr>
                  <th class="text-center" style="width: 10px;">#</th>
                  <th>Nombre</th>
                  <th class="text-center">ID</th>
                  <th class="text-center">Teléfono</th>
                  <th class="text-center">Total compras</th>
                  <th class="text-center">Última compra</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <!-- cuerpo de la tabla -->
              <tbody>
                <?php
                  $item     = null;
                  $valor    = null;
                  $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                  foreach ($clientes as $key => $value) {
                      echo '<tr>
                                <td class="text-center">' . ($key + 1) . '</td>
                                <td>' . $value["nombre"] . '</td>
                                <td class="text-center">' . $value["documento"] . '</td>
                                <td class="text-center">' . $value["telefono"] . '</td>
                                <td class="text-center">' . $value["compras"] . '</td>
                                <td class="text-center">' . $value["ultima_compra"] . '</td>
                                <td class="text-center">
                                  <div class="btn-group">
                                    <button class="btn btn-outline-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fal fa-edit"></i></button>';
                      if ($_SESSION["perfil"] == "Administrador") {
                          echo '<button class="btn btn-outline-danger btnEliminarCliente" idCliente="' . $value["id"] . '"><i class="fal fa-user-times"></i></button>';
                      }
                      echo '</div>
                                </td>
                              </tr>';
                  }
                ?>
              </tbody>
              <!-- pie de pagina tabla -->
              <tfoot>
                <tr>
                  <th class="text-center" style="width: 10px;">#</th>
                  <th>Nombre</th>
                  <th class="text-center">ID</th>
                  <th class="text-center">Teléfono</th>
                  <th class="text-center">Total compras</th>
                  <th class="text-center">Última compra</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </tfoot>
            </table>
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
          <h4 class="modal-title">Agregar nuevo Cliente</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <!-- Nombre del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-users"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" name="nuevoCliente" placeholder="Nombre *" required>
          </div>
          <!-- cedula del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-address-card"></i>
              </span>
            </div>
            <input type="number" class="form-control input-group-lg" name="nuevoDocumentoId" placeholder="ID *" required>
          </div>
          <!-- E-mail del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-envelope"></i>
              </span>
            </div>
            <input type="email" class="form-control input-group-lg" name="nuevoEmail" placeholder="E-mail">
          </div>
          <!-- Teléfono del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-phone"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" name="nuevoTelefono" placeholder="Teléfono" data-inputmask='"mask": "(999) 999-9999"'
              data-mask>
          </div>
          <!-- Dirección del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-map-marker-alt"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" name="nuevaDireccion" placeholder="Dirección">
          </div>
          <!-- Fecha de nacimiento del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" name="nuevaFechaNacimiento" placeholder="Fecha de nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'"
              data-mask>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-outline-primary">Guardar cliente</button>
        </div>
        <?php
          $crearCliente = new ControladorClientes();
          $crearCliente->ctrCrearCliente();
        ?>
      </form>
    </div>
  </div>
</div>
<!--====  End of Formulario modal para agregar un nuevo Cliente  ====-->

<!--====================================================================
=            Formulario modal para editar un nuevo Cliente             =
=====================================================================-->
<!-- The Modal -->
<div class="modal fade" id="modalEditarCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <!-- Modal Header -->
        <div class="modal-header" style="background: rgba(52,58,64,.85); color: #d2d6de;">
          <h4 class="modal-title">Editar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <!-- Nombre del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-users"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="editarCliente" name="editarCliente" placeholder="Nombre *" required>
            <input type="hidden" id="idCliente" name="idCliente">
          </div>
          <!-- cedula del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-address-card"></i>
              </span>
            </div>
            <input type="number" class="form-control input-group-lg" id="editarDocumentoId" name="editarDocumentoId" placeholder="ID *"
              required>
          </div>
          <!-- E-mail del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-envelope"></i>
              </span>
            </div>
            <input type="email" class="form-control input-group-lg" id="editarEmail" name="editarEmail" placeholder="E-mail">
          </div>
          <!-- Teléfono del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-phone"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="editarTelefono" name="editarTelefono" placeholder="Teléfono" data-inputmask='"mask": "(999) 999-9999"'
              data-mask>
          </div>
          <!-- Dirección del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-map-marker-alt"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="editarDireccion" name="editarDireccion" placeholder="Dirección">
          </div>
          <!-- Fecha de nacimiento del Cliente-->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="editarFechaNacimiento" name="editarFechaNacimiento" placeholder="Fecha de nacimiento"
              data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-outline-primary">Editar cliente</button>
        </div>
        <?php
          $editarCliente = new ControladorClientes();
          $editarCliente->ctrEditarCliente();
        ?>
      </form>
    </div>
  </div>
</div>
<!--====  End of Formulario modal para editar un Cliente  ====-->
<?php
  $borrarCliente = new ControladorClientes();
  $borrarCliente->ctrEliminarCliente();
?>