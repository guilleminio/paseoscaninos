<?php
session_start();
include('funcionesBD.php');

$error = null;
$resultado = null;

if (isset($_POST)){

	$perro['nombre']      = strip_tags(addslashes($_POST['nombre']));
	$perro['edad']   	= strip_tags(addslashes($_POST['edad']));
	$perro['tamanio']       = strip_tags(addslashes($_POST['tamanio']));
	$perro['raza']    = strip_tags(addslashes($_POST['raza']));
	$perro['detalles']   = strip_tags(addslashes($_POST['detalles']));
	$perro['duenio'] = $_SESSION['cliente_actual']['id_cliente'];

	
	$conexion = conectarBD();

	if ( $conexion['resultado'] != null ){

		$nuevoPerro = agregarPerro($conexion['resultado'],$perro);

		if ( $nuevoPerro['resultado'] != null){
			
			$nuevoPerroId = $nuevoPerro['resultado'];
			
			$resultado = 'ok';
					
			$perro = obtenerPerro($conexion['resultado'],$nuevoPerroId);

			$_SESSION['perro_actual'] = $perro['resultado'];

		}else{
			$error = $nuevoPerro['error'];
		}


	}else{
		$error = $conexion['error'];
	}

}else{
	$error = "No se enviaron datos.";
}
 

 echo json_encode(array('resultado' => $resultado,'error' => $error));


?>