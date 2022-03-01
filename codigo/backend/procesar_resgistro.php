<?php
session_start();
include('funcionesBD.php');

$error = null;
$resultado = null;

if (isset($_POST)){

	$cliente['nombre']      = strip_tags(addslashes($_POST['nombre']));
	$cliente['apellido']   	= strip_tags(addslashes($_POST['apellido']));
	$cliente['email']       = strip_tags(addslashes($_POST['email']));
	$cliente['telefono']    = strip_tags(addslashes($_POST['telefono']));
	$cliente['domicilio']   = strip_tags(addslashes($_POST['domicilio']));
	$contrasenia = strip_tags(addslashes($_POST['contrasenia']));
	$repetircontrasenia = strip_tags(addslashes($_POST['repetircontrasenia']));

	if (strcmp($contrasenia,$repetircontrasenia) == 0){

		$conexion = conectarBD();

		if ( $conexion['resultado'] != null ){

			$clienteExistente = existeCliente($conexion['resultado'],$cliente['email']);

			if ( $clienteExistente['resultado'] != null){

				$cliente['contrasenia'] = password_hash($contrasenia, PASSWORD_DEFAULT);

				$nuevoCliente = agregarCliente($conexion['resultado'],$cliente);

				if ( $nuevoCliente['resultado'] != null){
					$resultado = 'ok';
					$cliente['id'] = $nuevoCliente['resultado'];
					
					$cliente = obtenerCliente($conexion['resultado'],$cliente['id']);

					$_SESSION['cliente_actual'] = $cliente['resultado'];
					$_SESSION['cliente_actual']['pass'] = $contrasenia;

				}else{
					$error = $nuevoCliente['error'];
				}

			}else{
				$error = $clienteExistente['error'];
			}

		}else{
			$error = $conexion['error'];
		}

	}else{
		$error = "Las contraseñas no coinciden";
	}

}else
 $error = "No se enviaron datos.";

 echo json_encode(array('resultado' => $resultado,'error' => $error));


?>