<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-gray-light navbar-light border-bottom">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#">
        <i class="fa fa-bars"></i>
      </a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto user-panel" style="overflow: visible;">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <?php
          if ($_SESSION["foto"] != "") {
              echo '<img src="' . $_SESSION["foto"] . '" alt="User Image" class="img-size-50 mr-3 img-circle">';
          } else {
              echo '<img src="vistas/images/usuarios/default/anonymous.png" alt="User Image" class="img-size-50 mr-3 img-circle">';
          }
        ?>
        <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right bg-gray-light">
        <div class="dropdown" style="padding: 1rem; font-family: 'ubuntu' sans-serif;">
          <!-- información del usuario -->
          <div class="media">
            <?php
              if ($_SESSION["foto"] != "") {
                echo '<img src="' . $_SESSION["foto"] . '" alt="User Image" class="img-size-50 mr-3 img-circle">';
              }
              else {
                echo '<img src="vistas/images/usuarios/default/anonymous.png" alt="User Image" class="img-size-50 mr-3 img-circle">';
              }
            ?>
            <div class="media-body">
              <h3 class="dropdown-item-title">
                <?php echo $_SESSION["nombre"]; ?>
              </h3>
              <p class="text-sm text-right"><?php echo $_SESSION["perfil"]; ?></p>
              <p class="text-sm text-muted text-right">Ultima sesión: <i class="fal fa-user-clock mr-1"></i>
                <?php $_SESSION["ultimo_login"]="2018-06-06 17:34:30"; echo $_SESSION["ultimo_login"]; ?>
              </p>
            </div>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="row">
          <div class="col-4"></div>
          <!-- salir del sistema -->
          <div class="col-4">
            <a href="salir" class="dropdown-footer float-left"><i class="fal fa-times-circle"></i> Cerrar</a>  
          </div>
          <!-- bloquear sesion -->
          <div class="col-4">
            <a href="bloquear" class="dropdown-footer float-right"><i class="fal fa-user-lock"></i> Bloquear</a>  
          </div>
        </div>
      </div> 
    </li>
  </ul>
</nav>
<!-- /.navbar -->