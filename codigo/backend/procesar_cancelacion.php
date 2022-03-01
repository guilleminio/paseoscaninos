<?php 
include('funcionesBD.php');
include('funcionesREST.php');

$error = null;
$resultado = null;
if ( isset($_POST)){
	
	$paseo = strip_tags(addslashes($_POST['turno']));

	$conexion = conectarBD();

	if ( $conexion['resultado'] != null ){

		$turnoPorCancelar = obtenerTurno($conexion['resultado'],$paseo);
		$cancelado = cancelarTurno($conexion['resultado'],$paseo);
		
		if ( $cancelado['resultado'] != null ){
			$resultado = 'Turno cancelado exitosamente';
			
			$turno['paseador'] = $turnoPorCancelar['resultado']['id_paseador'];
			$turno['fecha'] = $turnoPorCancelar['resultado']['fecha_paseo'];
			$turno['hora'] = $turnoPorCancelar['resultado']['hora_paseo'];
			
			//ACTUALIZO EL SERVICIO PARA INSERTAR LA DISPONIBILIDAD LIBERADA
			agregarDisponibilidad($turno);

		}else{
			$error = $cancelado['error'];
		}


	}else{
		$error = $conexion['error'];
	}


}else
	$error = 'No hay datos';

echo json_encode(array('resultado'=>$resultado,'error'=>$error));
?>