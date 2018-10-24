<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="inicio" class="brand-link text-center">
    <img src="vistas/images/plantilla/logo-imperio-MAX.svg" alt="saiv Logo" class="img-fluid" style="opacity: .9; width:130px">
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
          if($_SESSION["perfil"]== "Administrador"){
            echo 
            '<li class="nav-item has-treeview menu-open">
              <a href="inicio" class="nav-link active">
                <i class="nav-icon fal fa-home"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>
            <!--====  Boton para gestionar usuarios  ====-->
            <li class="nav-item has-treeview">
              <a href="usuarios" class="nav-link">
                <i class="nav-icon fal fa-user"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>';
          }
          if($_SESSION["perfil"]== "Administrador" || $_SESSION["perfil"]== "Inventario"){
            echo 
            '<!--====  Boton para gestionar categorias  ====-->
            <li class="nav-item has-treeview">
              <a href="categorias" class="nav-link">
                <i class="nav-icon fal fa-clipboard-list"></i>
                <p>
                  Categorías
                </p>
              </a>
            </li>
            <!--====  Boton para gestionar productos  ====-->
            <li class="nav-item has-treeview">
              <a href="productos" class="nav-link">
                <i class="nav-icon fal fa-box-open"></i>
                <p>
                  Productos
                </p>
              </a>
            </li>';
          }
          if($_SESSION["perfil"]== "Administrador" || $_SESSION["perfil"]== "Mesero") {
            echo 
            '<!--====  Boton para gestionar clientes  ====-->
            <li class="nav-item has-treeview">
              <a href="clientes" class="nav-link">
                <i class="nav-icon fal fa-users"></i>
                <p>
                  Clientes
                </p>
              </a>
            </li>
            <!--====  Boton para gestionar ventas  ====-->
            <li class="nav-item has-treeview">
              <a href="#!" class="nav-link">
                <i class="nav-icon fal fa-shopping-cart"></i>
                <p>
                  Ventas
                  <i class="fa fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="ventas" class="nav-link">
                    <i class="fa fa-genderless nav-icon"></i>
                    <p>Administar ventas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="crear-venta" class="nav-link">
                    <i class="fa fa-genderless nav-icon"></i>
                    <p>Crear venta</p>
                  </a>
                </li>';
            
          }
                if($_SESSION["perfil"]== "Administrador"){
                  echo 
                  '<li class="nav-item">
                    <a href="reportes" class="nav-link">
                      <i class="fa fa-genderless nav-icon"></i>
                      <p>Reporte de ventas</p>
                    </a>
                  </li>';
                }
          echo'</ul>';
        ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>