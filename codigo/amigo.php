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
	<title><?php echo TITULO_SITIO?> - Mi amig@</title>

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

	  	<!-- Datos del amig@ -->
	  	<section>
			<div class="container">
				<h1>Mi amig@</h1>
			</div>
			<div class="container">
				<div class="row  mb-3">
					 <div class="row mb-3">
    					<label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
    					<div class="col-sm-8">
     				 		<input type="text" class="form-control" id="nombre" value="<?php echo $_SESSION['perro_actual']['nombre_perro']?>">
    					</div>
  					</div>
					<div class="row mb-3">
					    <label for="edad" class="col-sm-2 col-form-label">Edad</label>
					    <div class="col-sm-8">
					      <input type="number" class="form-control" id="edad" value="<?php echo $_SESSION['perro_actual']['edad_perro']?>">
					    </div>
					</div>
				  	<div class="row mb-3">
					    <label for="tamanio" class="col-sm-2 col-form-label">Tamaño:</label>
					    <div class="col-sm-8">
					      	<select class="form-control" id="tamanio">
	            				<option value="1" <?php if($_SESSION['perro_actual']['tamanio_perro']==1){echo 'selected';}?>>Chico</option>
	            				<option value="2" <?php if($_SESSION['perro_actual']['tamanio_perro']==2){echo 'selected';}?>>Mediano</option>
	            				<option value="3" <?php if($_SESSION['perro_actual']['tamanio_perro']==3){echo 'selected';}?>>Grande</option>
	            			</select>
					    </div>
					</div>
					<div class="row mb-3">
					    <label for="raza" class="col-sm-2 col-form-label">Raza</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="raza" value="<?php echo $_SESSION['perro_actual']['raza_perro']?>">
					    </div>
					</div>
					<div class="row mb-3">
					    <label for="detalles" class="col-sm-2 col-form-label">Descripción:</label>
					    <div class="col-sm-8">
					      <textarea class="form-control" rows="3" id="detalles" placeholder="Descríbelo un poco..."><?php echo $_SESSION['perro_actual']['descripcion_perro'];?></textarea>
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

				let nombre   = $('#nombre').val();
				let edad     = $('#edad').val();
				let tamanio  = $('#tamanio').val();
				let raza     = $('#raza').val();
				let detalles = $('#detalles').val();


				$.post('backend/procesar_amigo.php',{nombre:nombre,edad:edad,tamanio:tamanio,raza:raza,detalles:detalles},function (resultado) {
						console.log(resultado);
						if ( resultado.error != null)
							alert(resultado.error);
						else{
							alert('Los datos de tu amig@ han sido actualizados correctamente!');
							location.href='principal.php';
							}
				},'json')
			}

		})

	})

</script>
