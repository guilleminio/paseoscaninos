<?php
include('funcionesBD.php');
include('funcionesREST.php');

$resultado = null;
$error = null;
if ( isset($_POST)){

	$turno['paseador'] = strip_tags(addslashes($_POST['paseador']));
	$turno['perro'] = strip_tags(addslashes($_POST['perro']));
	$turno['fecha'] = strip_tags(addslashes($_POST['fecha']));
	$turno['hora'] = strip_tags(addslashes($_POST['hora']));

	$conexion = conectarBD();

	if ( $conexion['resultado']!=null){

		$nuevoTurno = agregarTurno($conexion['resultado'],$turno);

		if ( $nuevoTurno['resultado'] != null){

			//ACTUALIZO EL SERVICIO PARA ELIMINAR LA DISPONIBILIDAD DEL PASEADOR
			eliminarDisponibilidad($turno);

			$resultado = 'Turno agendado exitosamente!';

		}else{
			$error = $nuevoTurno['error'];
		}


	}else{
		$error = 'Problemas al conectar con la base de datos';
	}


}else{
	$error = 'No se han enviado datos';
}

echo json_encode(array('resultado'=>$resultado,'error'=>$error));
?>