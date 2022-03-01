<?php
session_start();
include('funcionesBD.php');

$error = null;
$resultado = null;

if (isset($_POST)){

	$perro['nombre']   = strip_tags(addslashes($_POST['nombre']));
	$perro['edad']     = strip_tags(addslashes($_POST['edad']));
	$perro['tamanio']  = strip_tags(addslashes($_POST['tamanio']));
	$perro['raza']     = strip_tags(addslashes($_POST['raza']));
	$perro['detalles'] = strip_tags(addslashes($_POST['detalles']));
	$perro['duenio']   = $_SESSION['cliente_actual']['id_cliente'];
	$perro['id']	   = $_SESSION['perro_actual']['id_perro'];
	
	$conexion = conectarBD();

	if ( $conexion['resultado'] != null ){

		$perroActualizado = modificarPerro($conexion['resultado'],$perro);

		if ( $perroActualizado['resultado'] != null){
			
			$resultado = 'ok';
					
			$perro = obtenerPerro($conexion['resultado'],$_SESSION['perro_actual']['id_perro']);

			$_SESSION['perro_actual'] = $perro['resultado'];

		}else{
			$error = $perroActualizado['error'];
		}


	}else{
		$error = $conexion['error'];
	}

}else{
	$error = "No se enviaron datos.";
}
 

 echo json_encode(array('resultado' => $resultado,'error' => $error));


?>