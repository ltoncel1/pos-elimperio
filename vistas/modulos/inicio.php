<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Escritorio</h1>
          <!-- <small>Panel de control</small> -->
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <i class="nav-icon fa fa-home"></i>
              Inicio
            </li>
            <li class="breadcrumb-item active">Escritorio</li>
          </ol>
        </div>
      </div>
      </div>
    </section>
    <section class="content">
      
      <!-- Cajas superiores de Ventas, Categorías, Clientes y Productos -->
      <div class="row">
        <?php
       
          if($_SESSION["perfil"] == "Administrador"){
            include "inicio/cajas-superiores.php";
          }
        ?>
      </div>
      <!-- Grafico de ventas -->
      <div class="row">
        <div class="col-lg-12">
          <?php
            if($_SESSION["perfil"] == "Administrador"){ 
              include "reportes/grafico-ventas.php";
            }
          ?>
        </div>
        <!-- Productos mas vendidos -->
         <div class="col-lg-6">
          <?php
            if($_SESSION["perfil"] == "Administrador"){
              include "reportes/productos-mas-vendidos.php";
            }
          ?>
        </div>
        <!-- Productos mas recientes -->
         <div class="col-lg-6">
          <?php
            if($_SESSION["perfil"] == "Administrador"){
              include "inicio/productos-recientes.php";
            }
          ?>
        </div>
        <!-- Bienvenida al usuario si no es Administrador -->
        <?php
          if($_SESSION["perfil"] == "Inventario" || $_SESSION["perfil"] == "Mesero"){
            echo '<div class="col-12">
                    <div class="card card-widget widget-user-2">
                      <div class="widget-user-header bg-success">
                        <div class="widget-user-image">';
        ?>
                <img class="img-circle elevation-2" src="<?php echo $_SESSION["foto"]?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo $_SESSION["nombre"]?></h3>
              <h5 class="widget-user-desc"><?php echo $_SESSION["perfil"]?></h5>
            </div>
            <div class="card-footer p-0">
              <p class="d-inline h1">Bienvenid@ al sistema</p>
              <div  class="d-none d-sm-inline-block">
                <img class="img-size-50 " src="vistas/images/plantilla/saiv.svg" alt="saiv.svg" ><small> Sistema Administrador de Inventarios y Ventas</small>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
          <!-- /.widget-user -->
      </div>

    </section>
  </div>