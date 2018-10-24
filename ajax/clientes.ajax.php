<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}

	//Mostrar clientes
	public $idDelCliente;
	public function ajaxMostarCliente(){

		$item = null;
		$valor = $this->idDelCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}	
}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idDelCliente"])){

	$mostrarCliente = new AjaxClientes();
	$mostrarCliente -> idDelCliente = $_POST["idDelCliente"];
	$mostrarCliente -> ajaxMostarCliente();

}