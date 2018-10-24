<?php

class ControladorBarCode{
	/*=============================================
    MOSTRAR PRODUCTOS por BarCade
    =============================================*/

    public static function ctrMostrarProductoPorBarCode($item, $valor, $orden)
    {

        $tabla = "productos";

        $respuesta = ModeloBarCode::mdlMostrarProductoPorBarCode($tabla, $item, $valor, $orden);

        return $respuesta;

    }     
}