<?php
  echo '<script>console.log("Datos: '.$_COOKIE['nombre'].', '.$_COOKIE['usuario'].', '.$_COOKIE['foto'].', '.$_COOKIE['pantallaBloqueo'].'")</script>';
?>
<div id="back" ></div>
<div class="lockscreen-wrapper" style="font-family: 'Source Sans Pro', sans-serif;">
  <div class="lockscreen-logo">
    <img src="vistas/images/plantilla/logo-imperio-MAX.svg" class="w-50 p-3" >
  </div>
  <!-- /.login-logo -->

  <!-- Nombre de usuario -->
  <div class="lockscreen-name text-center text-secondary h3" ><?php echo $_COOKIE['nombre'];?></div>
  
  <!-- Bloqueo de pantalla -->
  <div class="lockscreen-item" >
    
      <div class="lockscreen-image">
        <img class="img-size-50" src="<?php echo $_COOKIE['foto'];?>" alt="User Image">
      </div>
      
      <form class="lockscreen-credentials" method="post">
        <div class="input-group">
          <input type="hidden" name="ingUsuario" value="<?php echo $_COOKIE['usuario'];?>" required>
          <input type="password" class="form-control" placeholder="Contraseña:" name="ingPassword" required>

          <div class="input-group-append">
            <button type="submit" class="btn" id="btnLogin"><i class="fa fa-arrow-right text-muted"></i></button>
          </div>
        </div>
        <?php
          $login = new ControladorUsuarios();
          $login->ctrIngresoUsuario();
        ?>
      </form>
      
  </div>
  <div class="help-block text-center" style="color: #FFF; font-weight: 400;line-height: 1.5;">
      Ingrese su contraseña para recuperar su sesión
    </div>
    <div class="text-center">
      <a href="salir">O inicia sesión como un usuario diferente</a>
    </div>
    <div class="lockscreen-footer text-center" style="color: #FFF; font-weight: 400;line-height: 1.5;">
      Copyright &copy; 2018 <b><a href="#!" class="text-black"> LTsoft.</a></b><br>
      Todos los derechos reservados.
    </div>
</div>

<!-- /.login-box -->