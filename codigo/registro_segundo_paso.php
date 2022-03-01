<?php
session_start();
if ( !isset($_SESSION['cliente_actual'])){
	header('Location:login.php');
	exit();
}
include('backend/config.php');
?>
<!DOCTYPE html>
<html class="h-100">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo TITULO_SITIO?> - Regista a tu amig@!</title>

	<?php include('librerias/librerias.php'); ?>
	<!----------------- CSS PROPIOS --------------------------->
	<link rel="stylesheet" type="text/css" href="css/registro.css">
	<link rel="stylesheet" type="text/css" href="css/registro2.css">
	<!--------------------------------------------------------->
</head>
<body>
	<header class="py-1" id="cabeceraRegistro">
	    <div class="container d-flex flex-wrap justify-content-center">
	      <a href="index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto  text-decoration-none">
	        <span class="fs-5"><?php echo TITULO_SITIO?></span>
	      </a>
	      <div class="col-12 col-lg-auto mb-3 mb-lg-0">
        	<a class="btn btn-primary btn-lg botonActivo" href="registro.php">Volver</a>
      	 </div>
      	</div>
    </header>

    <section class="flex-shrink-0">
		<div class="container" id="formularioRegistro">
	        <h2>CONTANOS ALGO SOBRE TU AMIG@</h2>
	        
	        <div class="form-group">
	            <label for="nombre">Nombre</label>
	            <input type="text" class="form-control" placeholder="Nombre" id="nombre">
	        </div>
	        <div class="form-group">
	            <label for="edad">Edad (aproximada):</label>
	            <input type="number" min="1" max="12" class="form-control" placeholder="Edad" id="edad">
	        </div>
	        <div class="form-group">
	            <label for="tamanio">Tamaño:</label>
	            <select class="form-control" id="tamanio">
	            	<option value="0">Elige un tamaño...</option>
	            	<option value="1">Chico</option>
	            	<option value="2">Mediano</option>
	            	<option value="3">Grande</option>
	            </select>
	        </div>
	        <div class="form-group">
	            <label for="raza">Raza:</label>
	            <input type="text" class="form-control" placeholder="Raza" id="raza">
	        </div>
	        <div class="form-group">
	            <label for="detalles">Características:</label>
	            <textarea class="form-control" rows="3" id="detalles" placeholder="Descríbelo un poco..."></textarea>
	        </div>
	        <div class="clearfix"></div>
	        <button class="btn btn-primary btn-lg botonActivo" id="btnConfirmar"> Confirmar</button>	       
	    </div>
	</section>

    <footer class="footer mt-auto py-3 background footer">
  		<div class="container">
    		<span >&copy;<?php echo TITULO_SITIO?>. Todos los derechos reservados.</span>
  		</div>
	</footer>

	<!------------ Mensaje de registro exitoso ------------------------>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel">¡Genial!</h5>
      			</div>
      			<div class="modal-body">
   					<p><span>Ya son miembros de la hermosa pandilla de Paseos Caninos :)</span><br>
  		   			Ahora, te invitamos a que reserves un turno para el primer paseo!</p>
      			</div>
      			<div class="modal-footer">
        			<button type="button" id="btnAceptar" class="btn btn-primary botonActivo">Aceptar</button>
      			</div>
    		</div>
  		</div>
	</div>
	<!----------- Fin mensaje de registro exitoso ---------------------->

</body>
</html>
<script type="text/javascript">
	
	$(document).ready(function() {
			
		var exampleModal = document.getElementById('exampleModal');

		function mostrarMensaje(data,input){
			alert(data);
			$('#'+input).focus();
		}

		function formularioCompleto(){

			if ( $('#nombre').val().length == 0){
				mostrarMensaje('Debes indicar el nombre','nombre');
				return false;
			}

			if ( $('#edad').val().length == 0){
				mostrarMensaje('Debes indicar su edad','edad');
				return false;
			}

			if ( $('#tamanio').val() == 0){
				mostrarMensaje('Debes indicar su tamaño','tamaño');
				return false;
			}

			if ( $('#raza').val().length == 0){
				mostrarMensaje('Debes indicar su raza','raza');
				return false;
			}

			if ( $('#detalles').val().length == 0){
				mostrarMensaje('Debes contarnos algo mas','detalles');
				return false;
			}

			return true;
		}

		$('#btnAceptar').click(function() {
			$('#exampleModal').modal('hide');
			location.href = 'reservar_turno.php';
		})

		$('#btnConfirmar').click(function(){


			if (formularioCompleto()){

				let nombre = $('#nombre').val();
				let edad = $('#edad').val();
				let tamanio = $('#tamanio').val();
				let raza = $('#raza').val();
				let detalles = $('#detalles').val();


				$.post('backend/procesar_registro_2.php',{nombre:nombre,edad:edad,tamanio:tamanio,raza:raza,detalles:detalles},function (resultado) {
						console.log(resultado);
						if ( resultado.error != null)
							alert(resultado.error);
						else{
							$('#exampleModal').modal('show');
							}
				},'json')
			}

		})
	})

</script>