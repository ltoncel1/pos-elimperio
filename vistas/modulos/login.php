  <div id="back"></div>
<div class="login-box mt-0">
  <div class="login-logo mb-0">
    <img src="vistas/images/plantilla/logo-imperio-MAX.svg" class="w-75 p-3" >
  </div>
  <!-- /.login-logo -->
  <div class="card" style="background: rgba(0,0,0,.5); color: #fff; font-family: 'Ubuntu', sans-serif; font-size: 1.5rem">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingreso al sistema</p>
      <form method="post">
        <!-- Usuario -->
        <div class="input-group has-feedback form-group">
          <div class="input-group-prepend">
            <span class="input-group-text" style="background-color: #fff; border: 1px solid #fff";><i class="fa fa-user"></i></span>
          </div>
          <input type="text" class="form-control" placeholder="Usuario:" name="ingUsuario" required>
        </div>
        <!-- Contraseña -->
        <div class="input-group has-feedback form-group">
          <div class="input-group-prepend">
            <span class="input-group-text" style="background-color: #fff; border: 1px solid #fff";><i class="fa fa-key"></i></span>
          </div>
          <input type="password" class="form-control" placeholder="Contraseña:" name="ingPassword" required>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-8" style="font-size:12px; line-height:1.5;">
            <strong>Copyright &copy; 2018</strong>
            <br>Todos los derechos reservados.
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-sm float-right" id="btnLogin">Ingresar <i class="fal fa-chevron-circle-right"></i></button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-sm-12" style="font-size:12px; line-height:1.5;">
              <small>Diseñado por 
                <a style="color: #F4D601;" href="#!" target="_blank" rel="noopener"> | LT-Soft</a> 
                <!-- http://lt-soft.co/ -->
              </small>
          </div>
        </div>
        <?php
          $login = new ControladorUsuarios();
          $login->ctrIngresoUsuario();
        ?>
      </form>
    </div>
  </div>
</div>
<!-- /.login-box -->