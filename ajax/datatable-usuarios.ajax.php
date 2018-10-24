<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaUsuarios
{

    /*=============================================
    MOSTRAR LA TABLA DE USUARIOS
    =============================================*/

  public function mostrarTabla() {

    $item  = null;
    $valor = null;
    $orden = "id";

    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $orden);

        echo 
        '{
          "data": [';

            for ($i = 0; $i < count($usuarios) - 1; $i++) {
              echo '[
                      "' . ($i + 1) . '",
                      "' . $usuarios[$i]["foto"] . '",
                      "' . $usuarios[$i]["nombre"] . '",
                      "' . $usuarios[$i]["usuario"] . '",
                      "' . $usuarios[$i]["perfil"] . '",
                      "' . $usuarios[$i]["estado"] . '",
                      "' . $usuarios[$i]["ultimo_login"] . '",
                      "' . $usuarios[$i]["id"] . '"
                    ],';
            }

            echo '[
                "' . count($usuarios) . '",
                "' . $usuarios[count($usuarios) - 1]["foto"] . '",
                "' . $usuarios[count($usuarios) - 1]["nombre"] . '",
                "' . $usuarios[count($usuarios) - 1]["usuario"] . '",
                "' . $usuarios[count($usuarios) - 1]["perfil"] . '",
                "' . $usuarios[count($usuarios) - 1]["estado"] . '",
                "' . $usuarios[count($usuarios) - 1]["ultimo_login"] . '",
                "' . $usuarios[count($usuarios) - 1]["id"] . '"
              ]
          ]
        }';
  }
}

/*=============================================
ACTIVAR TABLA DE USUARIOS
=============================================*/
$activar = new TablaUsuarios();
$activar->mostrarTabla();
