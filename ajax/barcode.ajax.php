<?php

	require_once "../controladores/barcode.controlador.php";
	require_once "../modelos/barcode.modelo.php";

	class AjaxbarCode{

		public $barcode;

		public function ajaxMostrarProductoPorBarCode(){
    		$item = "barcode";
    		$valor = "$this->barcode";
    		$orden = "id";
    		$respuesta = ControladorBarCode::ctrMostrarProductoPorBarCode($item, $valor, $orden);

    		echo json_encode($respuesta);    
  		}
		
	}

	if(isset($_POST["barcode"])){
		$codigoBarra = new AjaxbarCode();
		$codigoBarra -> barcode = $_POST["barcode"];
		$codigoBarra -> ajaxMostrarProductoPorBarCode();
	}