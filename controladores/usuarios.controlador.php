<?php

class ControladorUsuarios
{

    /*==================================================
    =            Ingreso usuario                       =
    ==================================================*/
    public static function ctrIngresoUsuario()
    {
        if (isset($_POST["ingUsuario"])) {

          

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {

                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";

                $item  = "usuario";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {

                    if ($respuesta["estado"] == 1) {

                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["pantallaBloqueo"] = "false";
                        $_SESSION["id"]            = $respuesta["id"];
                        $_SESSION["nombre"]        = $respuesta["nombre"];
                        $_SESSION["usuario"]       = $respuesta["usuario"];
                        $_SESSION["foto"]          = $respuesta["foto"];
                        $_SESSION["perfil"]        = $respuesta["perfil"];
                        $_SESSION["ultimo_login"]  = $respuesta["ultimo_login"];

                        $perfil = $_SESSION["perfil"];

                      if(isset($_COOKIE['nombre']) && isset($_COOKIE['foto']) && isset($_COOKIE['usuario']) && isset($_COOKIE['pantallaBloqueo'])) {

                        // Creo las cookie´s correspondientes al nombre, usuario, foto y estado de la pantalla de bloqueo cada una caduca en un día 
                          setcookie('nombre', $_COOKIE['nombre'] = $_SESSION["nombre"], time() + (365 * 24 * 60 * 60), "/");
                          setcookie('usuario', $_COOKIE['usuario'] = $_SESSION["usuario"], time() + (365 * 24 * 60 * 60), "/");
                          setcookie('foto', $_COOKIE['foto'] = $_SESSION["foto"], time() + (365 * 24 * 60 * 60), "/");
                          setcookie('pantallaBloqueo', $_COOKIE['pantallaBloqueo'] = $_SESSION["pantallaBloqueo"], time() + (365 * 24 * 60 * 60), "/");
                      }
                      else {
                        // Creo las cookie´s correspondientes al nombre, usuario, foto y estado de la pantalla de bloqueo cada una caduca en un día 
                          setcookie('nombre', $_COOKIE['nombre'] = $_SESSION["nombre"], time() + (365 * 24 * 60 * 60), "/");
                          setcookie('usuario', $_COOKIE['usuario'] = $_SESSION["usuario"], time() + (365 * 24 * 60 * 60), "/");
                          setcookie('foto', $_COOKIE['foto'] = $_SESSION["foto"], time() + (365 * 24 * 60 * 60), "/");
                          setcookie('pantallaBloqueo', $_COOKIE['pantallaBloqueo'] = $_SESSION["pantallaBloqueo"], time() + (365 * 24 * 60 * 60), "/");
                      }
                      
                        /**
                         *
                         * Registrar fecha y hora del último login del usuario
                         *
                         */

                        date_default_timezone_set('America/Bogota');

                        $fecha = date('Y-m-d');
                        $hora  = date('H:i:s');

                        $fechaActual = $fecha . ' ' . $hora;

                        $item1  = "ultimo_login";
                        $valor1 = $fechaActual;

                        $item2  = "id";
                        $valor2 = $respuesta["id"];

                        $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                        if ($ultimoLogin == "ok") {

                            echo '<script>

                                window.location = "inicio";

                            </script>';
                        }

                    } else {
                        echo "<script>

						$.notify({
								icon: 'fa fa-meh',
								title: ' <strong";
                        echo ' style="font-size:1.8rem;">';
                        echo " Este ususario no esta activo.</strong>',
								message: '<br><br>Consulte con el administrador para activar su usuario.'
							},{
								type: 'warning',
								placement: {
                  from: 'bottom',
                  align: 'center'
								},
								timer: 1000,
								animate:{
									enter: 'animated fadeInUp',
									exit: 'animated fadeOutDown'
								}
							});
                     </script>";
                    }

                } else {

                    echo "<script>

						$.notify({
								icon: 'fa fa-frown',
								title: ' <strong";
                    echo ' style="font-size:1.8rem">';
                    echo " Error al ingresar al sistema.</strong>',
								message: '<br><br>Verifique que su usuario y contraseña estén bien escritos.'
							},{
								type: 'danger',
								placement: {
                  from: 'bottom',
                  align: 'center'
                },
                
								timer: 1000,
								animate:{
									enter: 'animated fadeInUp',
									exit: 'animated fadeOutDown'
								}
							});
                     </script>";
                }
            }
        }

    }

    /*==================================================
    =            Reguistrar usuarios a la db            =
    ==================================================*/

    public static function ctrCrearUsuario()
    {

        if (isset($_POST["nuevoUsuario"])) {

            /*=============================================
            VALIDAR IMAGEN
            =============================================*/

            $ruta = "vistas/images/usuarios/default/anonymous.png";

            if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

                echo '<script>console.log("siEntra: valadando(nuevaFoto)")</script>';

                list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                $nuevoAncho = 500;
                $nuevoAlto  = 500;

                /*=============================================
                CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                =============================================*/

                $directorio = "vistas/images/usuarios/" . $_POST["nuevoUsuario"];

                mkdir($directorio, 0755);

                /*=============================================
                DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                =============================================*/

                if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

                    /*=============================================
                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                    =============================================*/

                    $aleatorio = mt_rand(100, 999);

                    $ruta = "vistas/images/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";

                    $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);

                }

                if ($_FILES["nuevaFoto"]["type"] == "image/png") {

                    // ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===
                    // GUARDAMOSLAIMAGENENELDIRECTORIO
                    // ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  ===

                    $aleatorio = mt_rand(100, 999);

                    $ruta = "vistas/images/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".png";

                    $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);

                }

            }

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])) {

                $tabla = "usuarios";

                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("nombre" => $_POST["nuevoNombre"],
                    "usuario"               => $_POST["nuevoUsuario"],
                    "password"              => $encriptar,
                    "perfil"                => $_POST["nuevoPerfil"],
                    "foto"                  => $ruta);

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

			        swal({

			            type: "success",
			            title: "¡El usuario ha sido guardado correctamente!",
			            showConfirmButton: true,
			            confirmButtonText: "Cerrar"

			        }).then(function(result){

			            if(result.value){

			                window.location = "usuarios";

			            }

			        });
			        </script>';
                }

            } else {

                echo '<script>

			    swal({

			        type: "error",
			        title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
			        showConfirmButton: true,
			        confirmButtonText: "Cerrar"

			    }).then(function(result){

			        if(result.value){

			            window.location = "usuarios";

			        }

			    });
			    </script>';
            }
        }
    }

    /*==================================================
    =            Mostrar usuario  de la db             =
    ==================================================*/
    public static function ctrMostrarUsuarios($item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    /*==================================================
    =            Editar usuario de la db               =
    ==================================================*/

    public static function ctrEditarUsuario()
    {

        if (isset($_POST["editarUsuario"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

                /*=============================================
                VALIDAR IMAGEN
                =============================================*/

                $ruta = $_POST["fotoActual"];

                if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto  = 500;

                    /*=============================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    =============================================*/

                    $directorio = "vistas/images/usuarios/" . $_POST["editarUsuario"];

                    /*=============================================
                    PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
                    =============================================*/

                    if (!empty($_POST["fotoActual"])) {

                        unlink($_POST["fotoActual"]);

                    } else {

                        mkdir($directorio, 0755);

                    }

                    /*=============================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    =============================================*/

                    if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/images/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if ($_FILES["editarFoto"]["type"] == "image/png") {

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/images/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }

                }

                $tabla = "usuarios";

                if ($_POST["editarPassword"] != "") {

                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    } else {

                        echo '<script>

                                swal({
                                      type: "error",
                                      title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
                                      showConfirmButton: true,
                                      confirmButtonText: "Cerrar"
                                      }).then(function(result) {
                                        if (result.value) {

                                        window.location = "usuarios";

                                        }
                                    })

                            </script>';

                    }

                } else {

                    $encriptar = $_POST["passwordActual"];

                }

                $datos = array("nombre" => $_POST["editarNombre"],
                    "usuario"               => $_POST["editarUsuario"],
                    "password"              => $encriptar,
                    "perfil"                => $_POST["editarPerfil"],
                    "foto"                  => $ruta);

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
                          type: "success",
                          title: "El usuario ha sido editado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result) {
                                    if (result.value) {

                                    window.location = "usuarios";

                                    }
                                })

                    </script>';

                }

            } else {

                echo '<script>

                    swal({
                          type: "error",
                          title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result) {
                            if (result.value) {

                            window.location = "usuarios";

                            }
                        })

                </script>';

            }

        }

    }

    /*==================================================
    =            Borrar usuario de la db               =
    ==================================================*/

    public static function ctrBorrarUsuario()
    {

        if (isset($_GET["idUsuario"])) {

            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];

            if ($_GET["fotoUsuario"] != "") {

                unlink($_GET["fotoUsuario"]);
                rmdir('vistas/images/usuarios/' . $_GET["usuario"]);

            }

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                swal({
                      type: "success",
                      title: "El usuario ha sido borrado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                      }).then(function(result) {
                                if (result.value) {

                                window.location = "usuarios";

                                }
                            })

                </script>';

            }

        }

    }
}
