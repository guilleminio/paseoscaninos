<?php include('backend/config.php');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo TITULO_SITIO?> - Inicio de sesión</title>
	<?php include('librerias/librerias.php');?>
	<!----------------- CSS PROPIOS --------------------------->
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<!--------------------------------------------------------->
</head>
<body>

	<section class="login fullscreen">
		<div class="content">
			<h1>INICIAR SESIÓN</h1>
			<div class="form">	
				<div>
					<div>
						<label for="email">Email:</label>
					</div>
					<div>
						<input class="form-control" type="email" id="email">
					</div>
				</div>
				
				<div>	
					<div>
						<label for="contrasenia">Contraseña:</label>
					</div>
					<div>
						<input class="form-control" type="password" id="contrasenia" maxlength="15">
					</div>
				</div>

				<div id="seccionCaptcha">
					<div>
						<img src="backend/captcha.php" alt="captcha" title="captcha">
					</div>
					<div>
						<input class="form-control" placeholder="Ingrese el texto de la imagen" type="text" id="captcha">
					</div>
				</div>
				
				<div class="divBoton">
					<button id="btnIngresar" class="btn btn-primary botonActivo">INGRESAR</button>
				</div>	
			</div>
		</div>
		<div class="image">
			<img src="imagenes/pagina/login.jpg" alt="" />
		</div>
	</section>

</body>
</html>
<script type="text/javascript">

	$(document).ready(function() {
		
		function mostrarMensaje(data,input){
			alert(data);
			$('#'+input).focus();
		}

		function formularioCompleto(){

			if ( $('#email').val().length == 0){
				mostrarMensaje('Debes indicar el email','email');
				return false;
			}

			if ( $('#contrasenia').val().length == 0){
				mostrarMensaje('Debes indicar una contrasenia','contrasenia');
				return false;
			}

			if ( $('#captcha').val().length == 0){
				mostrarMensaje('Debes ingresar el texto que se visualiza en la imagen','captcha');
				return false;
			}

			return true;
		}


		$('#btnIngresar').click(function(){


			if (formularioCompleto()){

				let email       = $('#email').val();
				let contrasenia = $('#contrasenia').val();
				let captcha     = $('#captcha').val();

				$.post('backend/procesar_login.php',{email:email,contrasenia:contrasenia,captcha:captcha},function (resultado) {
						//console.log(resultado);
						
						if ( resultado.error != null)
							alert(resultado.error);
						else
							location.href='principal.php';
				},'json')
			}

		})
	})

</script>