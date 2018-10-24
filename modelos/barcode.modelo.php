<?php

	require_once "conexion.php";

	class ModeloBarCode {

		/*=============================================
    	MOSTRAR PRODUCTOS por BarCode
    	=============================================*/

    	public static function mdlMostrarProductoPorBarCode($tabla, $item, $valor, $orden){
			
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");
        	$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        	$stmt->execute();
        	return $stmt->fetch();

        	$stmt->close();

        	$stmt = null;
    	}	
	}