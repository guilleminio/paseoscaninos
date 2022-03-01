<?php 
session_start();
if ( !isset($_SESSION['cliente_actual'])){
	header('Location:login.php');
	exit();
}
include('backend/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo TITULO_SITIO?> - Mi cuenta</title>

	<?php include('librerias/librerias.php'); ?>

	<!----------------- CSS BOOTSTAP --------------------------->
	<link rel="stylesheet" type="text/css" href="css/sidebars.css">
	<!--------------------------------------------------------->

	<!----------------- CSS PROPIOS --------------------------->
	<link rel="stylesheet" type="text/css" href="css/menu_lateral.css">
	<!--------------------------------------------------------->
</head>
<body>

	<main class="scrollarea">
		<?php include('menu.php');?>

	  	<!-- Datos de la cuenta -->
	  	<section>
			<div class="container">
				<h1>Mi cuenta</h1>
			</div>
			<div class="container">
				<div class="row  mb-3">
					 <div class="row mb-3">
    					<label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
    					<div class="col-sm-8">
     				 		<input type="text" class="form-control" id="nombre" value="<?php echo $_SESSION['cliente_actual']['nombre_cliente']?>">
    					</div>
  					</div>
					<div class="row mb-3">
					    <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="apellido" value="<?php echo $_SESSION['cliente_actual']['apellido_cliente']?>">
					    </div>
					</div>
				  	<div class="row mb-3">
					    <label for="email" class="col-sm-2 col-form-label">Email</label>
					    <div class="col-sm-8">
					      <input type="email" class="form-control" id="email" value="<?php echo $_SESSION['cliente_actual']['email_cliente']?>">
					    </div>
					</div>
					<div class="row mb-3">
					    <label for="contrasenia" class="col-sm-2 col-form-label">Contrasenia</label>
					    <div class="col-sm-8">
					      <input type="password" class="form-control" id="contrasenia" value="<?php echo $_SESSION['cliente_actual']['pass']?>">
					    </div>
					</div>
					<div class="row mb-3">
					    <label for="repetircontrasenia" class="col-sm-2 col-form-label">Repetir contraseña:</label>
					    <div class="col-sm-8">
					      <input type="password" class="form-control" id="repetircontrasenia">
					    </div>
					</div>
					<div class="row mb-3">
					    <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="telefono" value="<?php echo $_SESSION['cliente_actual']['telefono_cliente']?>">
					    </div>
					</div>
					<div class="row mb-3">
					    <label for="domicilio" class="col-sm-2 col-form-label">Domicilio</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="domicilio" value="<?php echo $_SESSION['cliente_actual']['domicilio_cliente']?>">
					    </div>
					</div>
				  	<div class="col-10 botonesDerecha">
				  		<button id="btnCancelar" class="btn btn-secondary">Cancelar</button>
				  		<button id="btnActualizar" class="btn btn-primary botonActivo">Actualizar</button>
				  	</div>
				</div>
			</div>
		</section>
		<!-- Fin datos de la cuenta -->
	</main>

</body>
</html>

<script type="text/javascript">
	
	$(document).ready(function(){

		function mostrarMensaje(data,input){
			alert(data);
			$('#'+input).focus();
		}

		function formularioCompleto(){

			if ( $('#nombre').val().length == 0){
				mostrarMensaje('Debes indicar tu nombre','nombre');
				return false;
			}

			if ( $('#apellido').val().length == 0){
				mostrarMensaje('Debes indicar tu apellido','apellido');
				return false;
			}

			if ( $('#email').val().length == 0){
				mostrarMensaje('Debes indicar un email','email');
				return false;
			}

			if ( $('#telefono').val().length == 0){
				mostrarMensaje('Debes indicar un telefono','telefono');
				return false;
			}

			if ( $('#domicilio').val().length == 0){
				mostrarMensaje('Debes indicar un domicilio','domicilio');
				return false;
			}

			if ( $('#contrasenia').val().length == 0){
				mostrarMensaje('Debes indicar una contrasenia','contrasenia');
				return false;
			}

			if ( $('#repetircontrasenia').val().length == 0){
				mostrarMensaje('Debes confirmar la contrasenia','repetircontrasenia');
				return false;
			}

			return true;
		}


		$('#btnCerrarSesion').click(function () {
			$.post('backend/cerrarsesion.php',function(){
				location.href='index.php';
			});
		})


		$('#btnCancelar').click(function() {
			location.href='principal.php';
		})

		$('#btnActualizar').click(function(){

			if (formularioCompleto()){

				let nombre      = $('#nombre').val();
				let apellido    = $('#apellido').val();
				let email       = $('#email').val();
				let telefono    = $('#telefono').val();
				let domicilio   = $('#domicilio').val();
				let contrasenia = $('#contrasenia').val();
				let repetircontrasenia = $('#repetircontrasenia').val();

				$.post('backend/procesar_cuenta.php',{nombre:nombre,apellido:apellido,email:email,telefono:telefono,domicilio:domicilio,contrasenia:contrasenia,repetircontrasenia:repetircontrasenia},function (resultado) {
						//console.log(resultado);
						if ( resultado.error != null)
							alert(resultado.error);
						else{
							alert('Tus datos han sido actualizados correctamente!');
							location.href='principal.php';
						}
				},'json')
			}



		})


	})


</script>
