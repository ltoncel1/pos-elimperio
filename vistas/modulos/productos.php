<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar productos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <i class="nav-icon fa fa-home"></i>
              <a href="inicio">Inicio</a>
            </li>
            <li class="breadcrumb-item active">Administrar productos</li>
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
            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregarProducto">
              <i class="fal fa-box-open"></i> Agregar </button>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped dt-responsive tablaProductos" style="width: 100%;">
              <!-- cabezara de la tabla -->
              <thead>
                <tr>
                  <th class="text-center" style="width: 10px;">#</th>
                  <th class="text-center">Imagen</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Categoría</th>
                  <th class="text-center">Stock</th>
                  <th class="text-center">Precio de compra</th>
                  <th class="text-center">Precio de venta</th>
                  <th>Agregado</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <!-- pie de pagina tabla -->
              <tfoot>
                <tr>
                  <th class="text-center" style="width: 10px;">#</th>
                  <th class="text-center">Imagen</th>
                  <th>Código</th>
                  <th>Descripción</th>
                  <th>Categoría</th>
                  <th class="text-center">Stock</th>
                  <th class="text-center">Precio de compra</th>
                  <th class="text-center">Precio de venta</th>
                  <th>Agregado</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </tfoot>
            </table>
            <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" class="perfilUsuario">
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!--====================================================================
=            Formulario modal para agregar un nuevo producto           =
=====================================================================-->
<!-- The Modal -->
<div class="modal fade" id="modalAgregarProducto">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header" style="background: rgba(52,58,64,.85); color: #d2d6de;">
          <h4 class="modal-title">Agregar nuevo producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <!-- Categoría del producto -->
          <div class="input-group  form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px;">
                <i class="fal fa-clipboard-list"></i>
              </span>
            </div>
            <select class="form-control" id="nuevaCategoria" name="nuevaCategoria" required tabindex="0">
              <option disabled selected>Seleccione la categoría</option>
              <?php
                $item       = null;
                $valor      = null;
                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                foreach ($categorias as $key => $value) {
                  echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                }
              ?>
            </select>
          </div>
          <!-- Código -->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-code"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Código" readonly
              required>
          </div>
          <!-- Descripción del (producto) -->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-box-open"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="nuevaDescripcion" name="nuevaDescripcion" placeholder="Descripción del producto"
              required tabindex="1">
          </div>
          
          <!-- Fila para visualizar el Precio de compra y venta del producto  -->
          <div class="form-group row">
            <div class="col-sm-6">
              <!-- Precio de compra del producto -->
              <div class="input-group  has-feedback form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                    <i class="fal fa-usd-circle"></i>
                  </span>
                </div>
                <input type="number" class="form-control input-group-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" placeholder="Precio de compra"
                  required tabindex="2">
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <!-- Stock de productos -->
                  <div class="input-group  has-feedback form-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                        <i class="fal fa-boxes"></i>
                      </span>
                    </div>
                    <input type="number" class="form-control input-group-lg" name="nuevoStock" min="0" placeholder="Stock" required tabindex="4">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <!-- Precio de venta del producto -->
              <div class="input-group  has-feedback form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                    <i class="fal fa-usd-circle"></i>
                  </span>
                </div>
                <input type="number" class="form-control input-group-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" placeholder="Precio de venta"
                  required>
              </div>
              <div class="form-group row">
                <!-- checkbox para el porcentaje de utilidades -->
                <div class="col-sm-6">
                  <div class="form-group mb-0">
                    <label>
                      <input type="checkbox" class="minimal porcentaje" checked> Porcentaje de utilidades
                    </label>
                  </div>
                </div>
                <!-- entrada para el porcentaje -->
                <div class="col-sm-6">
                  <div class="input-group">
                    <input type="number" class="form-control input-group-lg input-l nuevoPorcentaje" name="nuevoPorcentaje" min="0" value="40"
                      required>
                    <div class="input-group-append">
                      <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                        <i class="fal fa-percent"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <!-- cc -->
              </div>
            </div>
          </div>
          <!-- código de barras -->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-barcode-alt"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="codigoBarras" name="codigoBarras" placeholder="Código de barras"
              tabindex="7">
          </div>
          <!-- Foto del producto -->
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fal fa-images"></i> Imagen del producto</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group row">
                <div class="col-12 col-sm-4">
                  <input type="file" class="nuevaImagen" name="nuevaImagen" tabindex="8">
                  <p class="h6">
                    <small>Peso máximo de la foto 2 MB</small>
                  </p>
                  <img src="vistas/images/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="120px">
                </div>
                <div class="col-sm-8 text-center mt-5 d-none d-lg-block">
                  <!-- barcode -->
                  <div id="print ">
                    <svg id="barcode"></svg>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-outline-primary">Guardar Producto</button>
        </div>
        <?php
          $crearProducto = new ControladorProductos();
          $crearProducto->ctrCrearProducto();
        ?>
      </form>
    </div>
  </div>
</div>
<!--====  End of Formulario modal para agregar un nuevo producto  ====-->

<!--====================================================================
=            Formulario modal para editar un producto                  =
=====================================================================-->
<!-- The Modal -->
<div class="modal fade" id="modalEditarProducto">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header" style="background: rgba(52,58,64,.85); color: #d2d6de;">
          <h4 class="modal-title">Editar producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <!-- Categoría del producto -->
          <div class="input-group  form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px;">
                <i class="fal fa-clipboard-list"></i>
              </span>
            </div>
            <select class="form-control" name="editarCategoria" readonly required>
              <option id="editarCategoria"></option>
            </select>
          </div>
          <!-- Código -->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-code"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="editarCodigo" name="editarCodigo" readonly required>
          </div>
          <!-- Descripción del (producto) -->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-box-open"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="editarDescripcion" name="editarDescripcion" required tabindex="0">
          </div>
          <!-- Fila para visualizar el Precio de compra y venta del producto  -->
          <div class="form-group row">
            <div class="col-sm-6">
              <!-- Precio de compra del producto -->
              <div class="input-group  has-feedback form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                    <i class="fal fa-usd-circle"></i>
                  </span>
                </div>
                <input type="number" class="form-control input-group-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" required
                  tabindex="1">
              </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <!-- Stock de productos -->
                  <div class="input-group  has-feedback form-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                        <i class="fal fa-boxes"></i>
                      </span>
                    </div>
                    <input type="number" class="form-control input-group-lg" id="editarStock" name="editarStock" min="0" required tabindex="2">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <!-- Precio de venta del producto -->
              <div class="input-group  has-feedback form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                    <i class="fal fa-usd-circle"></i>
                  </span>
                </div>
                <input type="number" class="form-control input-group-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" required>
              </div>
              <div class="form-group row">
                <!-- checkbox para el porcentaje de utilidades -->
                <div class="col-sm-6">
                  <div class="form-group mb-0">
                    <label>
                      <input type="checkbox" class="minimal porcentaje" checked> Porcentaje de utilidades
                    </label>
                  </div>
                </div>
                <!-- entrada para el porcentaje -->
                <div class="col-sm-6">
                  <div class="input-group">
                    <input type="number" class="form-control input-group-lg input-l nuevoPorcentaje" name="nuevoPorcentaje" min="0" value="40"
                      required>
                    <div class="input-group-append">
                      <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                        <i class="fal fa-percent"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <!-- cc -->
              </div>
            </div>
          </div>
          <!-- código de barras -->
          <div class="input-group  has-feedback form-group">
            <div class="input-group-prepend">
              <span class="input-group-text" style="background-color: #fff; border: 1px solid #ff; width: 42px; ">
                <i class="fal fa-barcode-alt"></i>
              </span>
            </div>
            <input type="text" class="form-control input-group-lg" id="editarCodigoBarra" name="editarCodigoBarra" readonly tabindex="3">
          </div>
          <!-- Foto del producto -->
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fal fa-images"></i> Imagen del producto</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group row">
                <div class="col-12 col-sm-4">
                  <input type="file" class="nuevaImagen" name="editarImagen" tabindex="4">
                  <p class="h6">
                    <small>Peso máximo de la foto 2 MB</small>
                  </p>
                  <img src="vistas/images/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="120px">
                  <input type="hidden" name="imagenActual" id="imagenActual">
                </div>
                <div class="col-sm-8 text-center mt-5  d-none d-lg-block">
                  <!-- barcode -->
                  <div id="print">
                    <svg id="barcode"></svg>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-outline-primary">Editar Producto</button>
        </div>
        <?php
          $editarProducto = new ControladorProductos();
          $editarProducto->ctrEditarProducto();
        ?>
      </form>
    </div>
  </div>
</div>
<!--====  End of Formulario modal para agregar un nuevo producto  ====-->


<!--====  sentencia para eliminar productos  ====-->
<?php
  $eliminarProducto = new ControladorProductos();
  $eliminarProducto->ctrEliminarProducto();
?>