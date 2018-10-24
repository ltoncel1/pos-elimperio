<?php
  session_start();

  if(isset($_COOKIE['nombre']) && isset($_COOKIE['foto']) && isset($_COOKIE['usuario']) && isset($_COOKIE['pantallaBloqueo'])) {
    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
      // Creo las cookie´s correspondientes al nombre, usuario, foto y estado de la pantalla de bloqueo cada una caduca en un año 
      setcookie('nombre', $_COOKIE['nombre'] = $_SESSION["nombre"], time() + (365 * 24 * 60 * 60), "/");
      setcookie('usuario', $_COOKIE['usuario'] = $_SESSION["usuario"], time() + (365 * 24 * 60 * 60), "/");
      setcookie('foto', $_COOKIE['foto'] = $_SESSION["foto"], time() + (365 * 24 * 60 * 60), "/");
      setcookie('pantallaBloqueo', $_COOKIE['pantallaBloqueo'] = $_SESSION["pantallaBloqueo"], time() + (365 * 24 * 60 * 60), "/");
    }
  }
  else {
    if (!isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] != "ok") {
      // Creo las cookie´s correspondientes al nombre, usuario, foto y estado de la pantalla de bloqueo cada una caduca en un año
      setcookie('nombre', "nombre", time() + (365 * 24 * 60 * 60), "/");
      setcookie('usuario', "usuario", time() + (365 * 24 * 60 * 60), "/");
      setcookie('foto', "foro", time() + (365 * 24 * 60 * 60), "/");
      setcookie('pantallaBloqueo', "false", time() + (365 * 24 * 60 * 60), "/");
    }
  }
?>

<!DOCTYPE html>
<html>
	<head>

	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">

	  <title>SAIV | El Imperio</title>

	  <!-- Tell the browser to be responsive to screen width -->
	  <meta name="viewport" content="width=device-width, initial-scale=1">

	  <!-- Icono del sistema -->
	  <link rel="icon" href="vistas/images/plantilla/logo-imperio-mini-black.png">

	  <!--=====================================
	  Plugins de CSS
	  ======================================-->
	  <!-- Font Awesome -->
    <link rel="stylesheet" href="vistas/plugins/fontawesome/css/all.css">
	  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"> -->
	  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

	  <!-- Fuente para el login -->
	  <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">

	  <!-- Ionicons -->
    <link rel="stylesheet" href="vistas/plugins/ionicons/ionicons.min.css">
	  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

	  <!-- DataTables -->
	  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
    <!-- <link rel="stylesheet" href="vistas/plugins/datatables/dataTables.bootstrap4.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
    <!-- <link rel="stylesheet" href="vistas/plugins/datatables/responsive.bootstrap4.min.css"> -->

	  <!-- Theme style -->
	  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">

	  <!-- animate -->
	  <link rel="stylesheet" href="vistas/dist/css/animate.css">

    <!-- error page 404.css -->
	  <link rel="stylesheet" href="vistas/css/404.css">

	  <!-- sidebar-dark-primary -->
	  <link rel="stylesheet" href="vistas/css/sidebar-dark-primary.css">

	  <!-- Google Font: Source Sans Pro -->
	  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Google Font: Page 404 -->
    <link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>

	  <!-- iCheck for checkboxes and radio inputs -->
  	  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

	  <!-- Select2 -->
      <link rel="stylesheet" href="vistas/plugins/select2/select2.min.css">
    
    <!-- daterangepicker -->
      <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker-bs3.css">

    <!-- Morris Chart -->
    <link rel="stylesheet" href="vistas/plugins/morris/morris.css">

		<!--=====================================
		Plugins de JAVASCRIPT
		======================================-->
		<!-- jQuery -->
		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
		<script src="vistas/plugins/jquery/jquery.min.js"></script>
    
		<!-- jQueryNumber -->
		<script src="vistas/plugins/jquery/jquery.number.js"></script>

		<!-- Bootstrap 4 -->
		<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- FastClick -->
		<script src="vistas/plugins/fastclick/fastclick.js"></script>

		<!-- AdminLTE App -->
		<script src="vistas/dist/js/adminlte.min.js"></script>
    <script src="vistas/dist/js/demo.js"></script>

		<!-- DataTables -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
    
    <!-- <script type="text/javascript" src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="vistas/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="vistas/plugins/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="vistas/plugins/datatables/responsive.bootstrap4.min.js"></script> -->
    
    

        <!-- console.logas -->

		<!-- Bootbox -->
    	<script src="vistas/plugins/bootstrap/js/bootbox.min.js"></script>

		<!-- bootstrap-notify -->
    	<script src="vistas/plugins/bootstrap/js/bootstrap-notify.min.js"></script>

		<!-- sweetalert2 -->
    	<script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

    	<!-- iCheck 1.0.1 -->
		<script src="vistas/plugins/iCheck/icheck.min.js"></script>
		<!-- Select2 -->
		<script src="vistas/plugins/select2/select2.full.min.js"></script>
		<!-- JsBarcode -->
		<script src="vistas/plugins/JsBarcode/JsBarcode.all.min.js"></script>
		<!-- jquery.PrintArea -->
		<script src="vistas/plugins/jquery.PrintArea/jquery.PrintArea.js"></script>
		<!-- InputMask -->
		<script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
		<script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <!-- <script src="vistas/plugins/moment.js/moment.min.js"></script> -->
    <script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Morris Chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!-- <script src="vistas/plugins/raphael/raphael-min.js"></script> -->
    <script src="vistas/plugins/morris/morris.js"></script>
    <!-- ChartJS 1.0.2 -->
    <script src="vistas/plugins/chartjs-old/Chart.min.js"></script>

    <script>
      localStorage.removeItem("capturarRango");
      localStorage.clear();
    </script>

	</head>

	<!--==========================================
	=            Cuerpo del Documento            =
	===========================================-->
	<body class="hold-transition sidebar-collapse sidebar-mini login-page" style="line-height: .8">
		<!-- Site wrapper -->
		  <?php
if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
  
    echo '<div class="wrapper">';

    /*=====================================
    =            Cabezera (Header)        =
    ======================================*/
    include "modulos/cabezera.php";

    /*=====================================
    =            Menu-lateral             =
    ======================================*/
    include "modulos/menu.php";

    /*=====================================
    =            modulos                  =
    ======================================*/
    if (isset($_GET["ruta"])) {
      if ($_GET["ruta"] == "inicio" ||
          $_GET["ruta"] == "usuarios" ||
          $_GET["ruta"] == "categorias" ||
          $_GET["ruta"] == "productos" ||
          $_GET["ruta"] == "clientes" ||
          $_GET["ruta"] == "ventas" ||
          $_GET["ruta"] == "crear-venta" ||
          $_GET["ruta"] == "editar-venta" ||
          $_GET["ruta"] == "reportes" ||
          $_GET["ruta"] == "salir" ||
          $_GET["ruta"] == "bloquear") {

          include "modulos/" . $_GET["ruta"] . ".php";
      } else {
            include "modulos/404.php";
        }
    } 
    else {
      include "modulos/inicio.php";
    }
    /*=====================================
    =            Footer                   =
    ======================================*/
    include "modulos/footer.php";
    echo '</div>';
}
else if (isset($_GET["ruta"]) && $_GET["ruta"] == "bloqueado") {
  $_COOKIE['pantallaBloqueo'] = "true";
  include "modulos/pantalla-de-bloqueo.php";
} 
else if ($_COOKIE['pantallaBloqueo'] != "true") {
    include "modulos/login.php";
  }
  else {
    include "modulos/pantalla-de-bloqueo.php";  
  }

?>

<!-- scripts perzonalizados para el proyecto -->
    	<script src="vistas/js/plantilla.js"></script>
    	<script src="vistas/js/usuarios.js"></script>
    	<script src="vistas/js/categorias.js"></script>
    	<script src="vistas/js/productos.js"></script>
    	<script src="vistas/js/clientes.js"></script>
    	<script src="vistas/js/ventas.js"></script>
      <script src="vistas/js/reportes.js"></script>

	</body>
<!--====  End of Cuerpo del Documento  ====-->
</html>

