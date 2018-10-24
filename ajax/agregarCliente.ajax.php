<?php

	//require_once "../controladores/clientes.controlador.php";
	require_once "../modelos/clientes.modelo.php";
	
	/**
	 * 
	 */
	class agregarCliente {

		/*=============================================
		CREAR CLIENTES
		=============================================*/
	    public static function ctrCrearCliente()
	    {

	        if (isset($_POST["nuevoCliente"])) {

	            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
	                preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
	                preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"])) {

	                $tabla = "clientes";

	                $datos = array("nombre" => $_POST["nuevoCliente"],
	                    "documento"             => $_POST["nuevoDocumentoId"],
	                    "email"                 => $_POST["nuevoEmail"],
	                    "telefono"              => $_POST["nuevoTelefono"],
	                    "direccion"             => $_POST["nuevaDireccion"],
	                    "fecha_nacimiento"      => $_POST["nuevaFechaNacimiento"]);

	                $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

	                echo json_encode($respuesta);
	        	}
	    	}	
		}

		/*=============================================
	    MOSTRAR CLIENTES
	    =============================================*/
	    public $id;
		/*$item = "id";
	    $valor = $this->id;		*/
	    public static function ctrMostrarClientes($item, $valor)
	    {

	        $tabla = "clientes";

	        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

	      	return $respuesta;
	    }		
	}

if (isset($_POST["nuevoCliente"])) {
	$crearCliente = new agregarCliente();
    $crearCliente->ctrCrearCliente(); 	
}

if (isset($_POST["id"])) {
	$cargarClientes = new agregarCliente();
	$cargarClientes->id=$_POST["id"];
    $cargarClientes->ctrMostrarClientes(); 	
}


