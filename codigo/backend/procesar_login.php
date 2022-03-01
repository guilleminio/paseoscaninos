<?php
session_start();
include('funcionesBD.php');

$error = null;
$resultado = null;

if (isset($_POST)){

	$email        = strip_tags(addslashes($_POST['email']));
	$contrasenia  = strip_tags(addslashes($_POST['contrasenia']));
	$captcha      = strip_tags(addslashes($_POST['captcha']));


	if ($captcha == $_SESSION['captchaactual'] ){

		$conexion = conectarBD();

		if ( $conexion['resultado'] != null ){

			$cliente = iniciarSesion($conexion['resultado'],$email);
			
			if ( ($cliente['resultado'] != null) ){
		
				if (password_verify($contrasenia, $cliente['resultado']['contrasenia_cliente']) ){

					$perro = obtenerPerro($conexion['resultado'],$cliente['resultado']['id_cliente']);

					if ( $perro['resultado'] != null ){

						$resultado = 'ok';
						$_SESSION['cliente_actual'] = $cliente['resultado'];
						$_SESSION['cliente_actual']['pass'] = $contrasenia;
						$_SESSION['perro_actual'] = $perro['resultado'];

					}else{
						$error = 'Problemas, no encontramos a tu perr@';
					}

				}else{

					$error = 'Usuario y/o contrasenia incorrectos';
				}
				
			}else{

				$error = 'Usuario y/o contrasenia incorrectos';
			}

		}else{
			$error = $conexion['error'];
		}


	}else{
		$error = 'Captcha incorrecto';
	}

}else{
	 $error = "No se enviaron datos.";
}


 echo json_encode(array('resultado' => $resultado,'error' => $error));


?>