<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Categorías</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <i class="nav-icon fa fa-home"></i>
              <a href="inicio">Inicio</a>
            </li>
            <li class="breadcrumb-item active">Administrar Categorías</li>
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
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
              <i class="fal fa-clipboard-list"></i> Agregar
            </button>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped dt-responsive tablas" style="width: 100%;">
              <!-- cabezara de la tabla -->
              <thead>
                <tr>
                  <th class="text-center" style="width: 10px;">#</th>
                  <th>Categoria</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <!-- cuerpo de la tabla -->
              <tbody>
                <?php
                  $item       = null;
                  $valor      = null;
                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                  // Mostramos las categorias en la tabla
                  foreach ($categorias as $key => $value) {
                    echo ' <tr>
                    <td class="text-center">' . ($key + 1) . '</td>
                    <td >' . $value["categoria"] . '</td>
                    <td class="text-center">
                    <div class="btn-group">
                    <button class="btn btn-outline-warning  btnEditarCategoria" idCategoria="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fal fa-edit"></i></button>';
                    if ($_SESSION["perfil"] == "Administrador") {
                      echo '<button class="btn btn-outline-danger  btnEliminarCategoria" categoriaABorrar="' . $value["categoria"] . '" idCategoria="' . $value["id"] . '"><i class="fal fa-times-circle"></i></button>';
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
                  <th>Categoria</th>
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
=            Formulario modal para agregar una nueva Categoria         =
=====================================================================-->
<!-- The Modal -->
<div class="modal fade" id="modalAgregarCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <!-- Modal Header -->
        <div class="modal-header" style="background: rgba(52,58,64,.85); color: #d2d6de;">
          <h4 class="modal-title">Agregar nueva Categoría</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <!-- Nombre -->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; height:42px;">
                <i class="fal fa-clipboard-list"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" name="nuevaCategoria" placeholder="Categoría:" required>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-outline-primary">Guardar Categoria</button>
        </div>
        <?php
          $crearCategoria = new ControladorCategorias();
          $crearCategoria->ctrCrearCategoria();
        ?>
      </form>
    </div>
  </div>
</div>
<!--====  End of Formulario modal para agregar una nueva Categoria  ====-->

<!--====================================================================
=            Formulario modal para editar un Categoria                 =
=====================================================================-->
<!-- The Modal -->
<div class="modal fade" id="modalEditarCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <!-- Modal Header -->
        <div class="modal-header" style="background: rgba(52,58,64,.85); color: #d2d6de;">
          <h4 class="modal-title">Editar Categoría</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <!-- Nombre -->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width:42px;  height:42px;">
                <i class="fal fa-clipboard-list"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="editarCategoria" name="editarCategoria" required>
            <input type="hidden" id="idCategoria" name="idCategoria">
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer ">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-outline-primary">Editar categoria</button>
        </div>
        <?php
          $editarCategoria = new ControladorCategorias();
          $editarCategoria->ctrEditarCategoria();
        ?>
      </form>
    </div>
  </div>
</div>
<!--====  End of Formulario modal para agregar un nuevo Categoria  ====-->
<?php
  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria->ctrBorrarCategoria();
?>