<?php 

function conectarBD(){

	$conexion = new mysqli('localhost','root','','paseos_caninos');

	$resultado = null;
	$error = null;

	if ( $conexion->connect_error)
		$error = "Problemas al conectar con la base de datos: ".$conexion->connect_error;
	else
		$resultado = $conexion;

	return array('resultado'=> $resultado,'error'=>$error);
}

/*--------------------------------------------------------------------------------*/
function existeCliente($conexion,$email){

	$sentencia = $conexion->prepare("SELECT id_cliente FROM cliente WHERE email_cliente = ?");

	$resultado = null;
	$error = null;
	if ($sentencia){
		if ( $sentencia->bind_param('s',$email)){

			if ( $sentencia->execute()){
				
				$fila = $sentencia->get_result();

				if ( $fila->num_rows > 0)
					$error = "Ya existe un cliente registrado con ese email.";
				else
					$resultado = "ok";
				$sentencia->close();

			}else{
				$error = "E";
			}

		}else{
			$error = "B";
		}
	}else{
		$error = "P";
	}

	return array('resultado'=> $resultado,'error'=>$error);
}

function obtenerCliente($conexion,$id){

	$sentencia = $conexion->prepare("SELECT * FROM cliente WHERE id_cliente = ?");

	$resultado = null;
	$error = null;
	if ($sentencia){
		if ( $sentencia->bind_param('i',$id)){

			if ( $sentencia->execute()){
				
				$cliente = $sentencia->get_result();
				$resultado = $cliente->fetch_assoc();
				$sentencia->close();

			}else{
				$error = "E";
			}

		}else{
			$error = "B";
		}
	}else{
		$error = "P";
	}

	return array('resultado'=> $resultado,'error'=>$error);
}

function agregarCliente($conexion,$cliente){

	$sentencia = $conexion->prepare('INSERT INTO cliente(nombre_cliente,apellido_cliente,email_cliente,telefono_cliente,domicilio_cliente,contrasenia_cliente)VALUES(?,?,?,?,?,?)');

	$resultado = null;
	$error = null;
	if ($sentencia){
		if ( $sentencia->bind_param('ssssss',$cliente['nombre'],$cliente['apellido'],$cliente['email'],$cliente['telefono'],$cliente['domicilio'],$cliente['contrasenia'])){

			if ( $sentencia->execute()){
				
				$resultado = $conexion->insert_id;
				$sentencia->close();

			}else{
				$error = "E - ".$sentencia->error;
			}

		}else{
			$error = "B";
		}
	}else{
		$error = "P";
	}

	return array('resultado'=> $resultado,'error'=>$error);
}

function modificarCliente($conexion,$id,$cliente){

	$sentencia = $conexion->prepare('UPDATE cliente SET nombre_cliente = ?,apellido_cliente = ?,email_cliente = ?,telefono_cliente = ?,domicilio_cliente = ?,contrasenia_cliente = ? WHERE id_cliente=?');

	$resultado = null;
	$error = null;
	if ($sentencia){
		if ( $sentencia->bind_param('ssssssi',$cliente['nombre'],$cliente['apellido'],$cliente['email'],$cliente['telefono'],$cliente['domicilio'],$cliente['contrasenia'],$id)){

			if ( $sentencia->execute()){
				
				$resultado = 'ok';
				$sentencia->close();

			}else{
				$error = "E - ".$sentencia->error;
			}

		}else{
			$error = "B- ".$sentencia->error;
		}
	}else{
		$error = "P- ".$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

/*--------------------------------------------------------------------------------*/
function agregarPerro($conexion,$perro){

	$sentencia = $conexion->prepare('INSERT INTO perros(nombre_perro,edad_perro,tamanio_perro,raza_perro,descripcion_perro,duenio_perro)VALUES(?,?,?,?,?,?)');

	$resultado = null;
	$error = null;
	if ($sentencia){
		if ( $sentencia->bind_param('sisssi',$perro['nombre'],$perro['edad'],$perro['tamanio'],$perro['raza'],$perro['detalles'],$perro['duenio'])){

			if ( $sentencia->execute()){

				$resultado = $conexion->insert_id;
				$sentencia->close();

			}else{
				$error = "E - error: ".$sentencia->error;
			}

		}else{
			$error = "B - error: ".$sentencia->error;
		}
	}else
		$error = "P - error: ".$conexion->error;

	return array('resultado'=> $resultado,'error'=>$error);
}

function obtenerPerro($conexion,$duenio){

	$sentencia = $conexion->prepare('SELECT * FROM perros WHERE duenio_perro = ?');

	$error = null;
	$resultado = null;

	if ( $sentencia ){

		if ( $sentencia->bind_param('i',$duenio)){

			if ( $sentencia->execute()){
				$perro = $sentencia->get_result();
				$resultado = $perro->fetch_assoc();
				$sentencia->close();
			}else{
				$error = 'E - Problemas al buscar al perro: '.$sentencia->error;
			}

		}else{
			$error = 'B - Problemas al buscar al perro: '.$sentencia->error;	
		}

	}else{
		$error = 'P - Problemas al buscar al perro: '.$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

function modificarPerro($conexion,$perro){

	$sentencia = $conexion->prepare('UPDATE perros SET nombre_perro = ?,edad_perro = ?,tamanio_perro = ?,raza_perro = ?,descripcion_perro = ? WHERE id_perro=?');

	$resultado = null;
	$error = null;
	if ($sentencia){
		if ( $sentencia->bind_param('sisssi',$perro['nombre'],$perro['edad'],$perro['tamanio'],$perro['raza'],$perro['detalles'],$perro['id'])){

			if ( $sentencia->execute()){

				$resultado = 'ok';
				$sentencia->close();

			}else{
				$error = "E - ".$sentencia->error;
			}

		}else{
			$error = "B- ".$sentencia->error;
		}
	}else{
		$error = "P- ".$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

/*--------------------------------------------------------------------------------*/
function iniciarSesion($conexion,$email){

	$sentencia = $conexion->prepare('SELECT * FROM cliente WHERE email_cliente = ?');

	$error = null;
	$resultado = null;

	if ( $sentencia ){

		if ( $sentencia->bind_param('s',$email)){

			if ( $sentencia->execute()){
				$cliente = $sentencia->get_result();
				$resultado = $cliente->fetch_assoc();
				$sentencia->close();
			}else{
				$error = 'E - Problemas al iniciar sesión: '.$sentencia->error;
			}

		}else{
			$error = 'B - Problemas al iniciar sesión: '.$sentencia->error;	
		}

	}else{
		$error = 'P - Problemas al iniciar sesión: '.$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

/*--------------------------------------------------------------------------------*/
function obtenerPaseadores($conexion){

	$sentencia = $conexion->prepare('SELECT * FROM paseadores');

	$error = null;
	$resultado = null;

	if ( $sentencia ){

			if ( $sentencia->execute()){

				$paseadores = $sentencia->get_result();
				$resultado  = $paseadores->fetch_all(MYSQLI_ASSOC);

				$sentencia->close();

			}else{
				$error = 'E - Problemas al obtener paseadores: '.$sentencia->error;
			}

	}else{
		$error = 'P - Problemas al obtener paseadores: '.$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

function obtenerPaseador($conexion,$idpaseador){

	$sentencia = $conexion->prepare('SELECT nombre_paseador FROM paseadores WHERE id_paseador=?');

	$error = null;
	$resultado = null;

	if ( $sentencia ){

		if ( $sentencia->bind_param('i',$idpaseador)){

			if ( $sentencia->execute()){

				$paseador = $sentencia->get_result();
				$resultado  = $paseador->fetch_assoc();

				$sentencia->close();

			}else{
				$error = 'E - Problemas al obtener paseador: '.$sentencia->error;
			}


		}else{
			$error = 'B - Problemas al obtener paseador: '.$conexion->error;
		}
	}else{
		$error = 'P - Problemas al obtener paseador: '.$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

function agregarTurno($conexion,$turno){

	$sentencia = $conexion->prepare('INSERT INTO paseos(id_paseador,id_perro,fecha_paseo,hora_paseo)VALUES(?,?,?,?)');

	$resultado = null;
	$error = null;
	if ($sentencia){
		if ( $sentencia->bind_param('iiss',$turno['paseador'],$turno['perro'],$turno['fecha'],$turno['hora'])){

			if ( $sentencia->execute()){

				$resultado = "ok";
				$sentencia->close();

			}else{
				$error = "E - error: ".$sentencia->error;
			}

		}else{
			$error = "B - error: ".$sentencia->error;
		}
	}else
		$error = "P - error: ".$conexion->error;

	return array('resultado'=> $resultado,'error'=>$error);
}

function cancelarTurno($conexion,$turno){

	$sentencia = $conexion->prepare('DELETE FROM paseos WHERE id_paseo = ?');

	$error = null;
	$resultado = null;

	if ( $sentencia ){

		if ( $sentencia->bind_param('i',$turno)){

			if ( $sentencia->execute()){
		
				$resultado  = 'ok';

				$sentencia->close();

			}else{
				$error = 'E - Problemas al eliminar el turno: '.$sentencia->error;
			}

		}else{
			$error = 'B - Problemas al eliminar el turno: '.$conexion->error;
		}
	}else{
		$error = 'P - Problemas al eliminar el turno: '.$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

function obtenerTurnos($conexion,$perro){

	$sentencia = $conexion->prepare('SELECT * FROM paseos WHERE id_perro = ?');

	$error = null;
	$resultado = null;

	if ( $sentencia ){

		if ( $sentencia->bind_param('i',$perro)){

			if ( $sentencia->execute()){

				$turnos = $sentencia->get_result();
				$resultado  = $turnos->fetch_all(MYSQLI_ASSOC);

				$sentencia->close();

			}else{
				$error = 'E - Problemas al obtener los turnos: '.$sentencia->error;
			}

		}else{
			$error = 'B - Problemas al obtener los turnos: '.$conexion->error;
		}
	}else{
		$error = 'P - Problemas al obtener los turnos: '.$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

function obtenerTurno($conexion,$id){

	$sentencia = $conexion->prepare('SELECT * FROM paseos WHERE id_paseo = ?');

	$error = null;
	$resultado = null;

	if ( $sentencia ){

		if ( $sentencia->bind_param('i',$id)){

			if ( $sentencia->execute()){

				$turnos = $sentencia->get_result();
				$resultado  = $turnos->fetch_assoc();

				$sentencia->close();

			}else{
				$error = 'E - Problemas al obtener turno: '.$sentencia->error;
			}

		}else{
			$error = 'B - Problemas al obtener turno: '.$conexion->error;
		}
	}else{
		$error = 'P - Problemas al obtener turno: '.$conexion->error;
	}

	return array('resultado'=> $resultado,'error'=>$error);

}

?>