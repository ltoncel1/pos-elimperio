<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reporte de ventas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <i class="nav-icon fa fa-home"></i>
              <a href="inicio">Inicio</a>
            </li>
            <li class="breadcrumb-item active">Reporte de ventas</li>
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
            <div class="row">
              <!-- Date and time range -->
              <div class="col-6 col-sm-4">
                <button type="button" class="btn btn-default float-left" id="daterange-btn2">
                  <span>
                    <i class="fal fa-calendar-alt"></i> Fecha
                  </span>
                  <i class="fa fa-caret-down"></i>
                </button>
              </div>
              <!-- boton para exportar reporte de ventas en excel -->
              <div class="col-6 col-sm-8">
                <?php

                  if(isset($_GET["Inicial"])){
                    echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&Inicial='.$_GET["Inicial"].'&Final='.$_GET["Final"].'>';

                  }
                  else{
                    echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';
                  }
                ?>
                  <button type="button" class="btn btn-outline-success float-right">
                    <span>
                      <i class="fa fa-file-excel"></i> Reporte
                    </span>
                  </button>
                  </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- grafico de ventas -->
              <div class="col-sm-12">
                <?php
                  include "reportes/grafico-ventas.php";
                ?>
              </div>
              <!-- grafico de los productos mas vendidos -->
              <div class="col-md-6 col-sm-12">
                <?php
                  include "reportes/productos-mas-vendidos.php";
                ?>
              </div>
              <!-- grafico de los vendedores que mas productos han vendido -->
              <div class="col-md-6 col-sm-12">
                <?php
                  include "reportes/vendedores.php";
                ?>
              </div>
              <!-- grafico de los clientes que mas productos han comprado -->
              <div class="col-md-6 col-sm-12">
                <?php
                  include "reportes/clientes.php";
                ?>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </section>
</div>