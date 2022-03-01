<?php include('backend/config.php');?>
<!DOCTYPE html>
<html class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo TITULO_SITIO?> - Registro</title>
	
	<?php include('librerias/librerias.php');?>
	
	<!----------------- CSS PROPIOS --------------------------->
	<link rel="stylesheet" type="text/css" href="css/registro.css">
	<!--------------------------------------------------------->

</head>
<body>

	<header class="py-1" id="cabeceraRegistro">
	    <div class="container d-flex flex-wrap justify-content-center">
	      <a href="index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto  text-decoration-none">
	        <span class="fs-5"><?php echo TITULO_SITIO?></span>
	      </a>
	      <div class="col-12 col-lg-auto mb-3 mb-lg-0">
        	<a href="index.php" class="btn btn-primary btn-lg botonActivo">Volver</a>
      	 </div>
    </header>

    <section class="flex-shrink-0">
		<div class="container" id="formularioRegistro">
	        <h2>CREA TU CUENTA</h2>
	        
	        <div class="form-group">
	            <label for="nombre">Nombre</label>
	            <input type="text" class="form-control" placeholder="Nombre" id="nombre">
	        </div>
	        <div class="form-group">
	            <label for="apellido">Apellido</label>
	            <input type="text" class="form-control" placeholder="Apellido" id="apellido">
	        </div>
	        <div class="form-group">
	            <label for="email">Email</label>
	            <input type="email" class="form-control" placeholder="Email" id="email">
	        </div>
	        <div class="form-group">
	            <label for="telefono">Teléfono</label>
	            <input type="phone" class="form-control" placeholder="Teléfono" id="telefono">
	        </div>
	        <div class="form-group">
	            <label for="domicilio">Domicilio:</label>
	            <input type="text" class="form-control" placeholder="Domicilio" id="domicilio">
	        </div>
	        <div class="form-group row">
	            <label for="contrasenia" class="col-sm-2 col-form-label">Contraseña:</label>
	            <div class="col-sm-8">
	            	<input type="password" class="form-control" placeholder="Contraseña" id="contrasenia" maxlength="15">
	             </div>
	        </div>
	        <div class="form-group row">
	            <label for="repetircontraseña" class="col-sm-2 col-form-label">Repetir contraseña:</label>
	            <div class="col-sm-8">
	            	<input type="password" class="form-control" placeholder="Repetir contraseña" id="repetircontrasenia" maxlength="15">
	        	</div>
	        </div>
	        <div class="form-group">
	        	<p>*La contraseña debe contener entre 8 y 15 caracteres<br>
	        	   *Los campos son obligatorios</p>
	        </div>
	        <div class="clearfix"></div>
	        <button class="btn btn-primary btn-lg botonActivo" id="btnContinuar"> Continuar</button>	       
	    </div>
	</section>

    <footer class="footer mt-auto py-3 background footer">
  		<div class="container">
    		<span >&copy; <?php echo TITULO_SITIO?>. Todos los derechos reservados.</span>
  		</div>
	</footer>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function() {
		
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



		$('#btnContinuar').click(function(){


			if (formularioCompleto()){

				let nombre      = $('#nombre').val();
				let apellido    = $('#apellido').val();
				let email       = $('#email').val();
				let telefono    = $('#telefono').val();
				let domicilio   = $('#domicilio').val();
				let contrasenia = $('#contrasenia').val();
				let repetircontrasenia = $('#repetircontrasenia').val();

				$.post('backend/procesar_resgistro.php',{nombre:nombre,apellido:apellido,email:email,telefono:telefono,domicilio:domicilio,contrasenia:contrasenia,repetircontrasenia:repetircontrasenia},function (resultado) {
						//console.log(resultado);
						if ( resultado.error != null)
							alert(resultado.error);
						else
							location.href='registro_segundo_paso.php';
				},'json')
			}
			

		})


	})

</script>