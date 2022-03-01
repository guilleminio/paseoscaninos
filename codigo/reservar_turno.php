<?php 
session_start();
if ( !isset($_SESSION['cliente_actual'])){
	header('Location:login.php');
	exit();
}

include('backend/funcionesBD.php');
include('backend/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo TITULO_SITIO?> - Paseadores</title>

	<?php include('librerias/librerias.php'); ?>



	<!----------------- CSS PROPIOS --------------------------->
	<link rel="stylesheet" type="text/css" href="css/paseadores.css">
	<!--------------------------------------------------------->
	
	<!----------------- CSS BOOTSTAP --------------------------->
	<link rel="stylesheet" type="text/css" href="css/sidebars.css">
	<!--------------------------------------------------------->

	<!----------------- CSS PROPIOS --------------------------->
	<link rel="stylesheet" type="text/css" href="css/menu_lateral.css">
	<!--------------------------------------------------------->

</head>
<body>
	
	<main class="scrollarea">

		<?php include('menu.php'); ?>


		<section class="container">
			<div id="titulo" class="container">
				<h2>Elegí un paseador y reserva un turno</h2>
			</div>
			<div class="contenidoFlotante">

			<?php 
				$conexion = conectarBD();
				if ( $conexion['resultado'] != null){
					$paseadores = obtenerPaseadores($conexion['resultado']);

					$totalPaseadores = count($paseadores['resultado']);

					for ( $i=0;$i<$totalPaseadores;$i++){

						echo "<div class=\"card tarjetaPaseador\" >
		  						<img src=\"imagenes/paseadores/".$paseadores['resultado'][$i]['id_paseador'].".jpg\" class=\"card-img-top\" alt=\"".$paseadores['resultado'][$i]['nombre_paseador']."\">
		  						<div class=\"card-body\">
		    						<h5 class=\"card-title\">".$paseadores['resultado'][$i]['nombre_paseador']."</h5>
		    						<p class=\"card-text\">".$paseadores['resultado'][$i]['descripcion_paseador']."</p>
		    						<button type=\"button\" id=\"".$paseadores['resultado'][$i]['id_paseador']."\" class=\"btn btn-primary botonActivo\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">Ver disponibilidad</button>
		  						</div>
							 </div>";

					}

				}else{
					echo $conexion['error'];
				}
				
			?>
			</div>	
		</section>

	<!-- Disponibilidad -->
	<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Horarios</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
		      	Elige una fecha:
		      	<input type="date" name="fecha" id="fecha" >
		      	<button id="btnBuscar" class="btn btn-primary botonActivo">Buscar</button>
	      		<div id="horarios"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="button" id="btnReservar" class="btn btn-primary botonActivo">Reservar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Fin disponibilidad --> 
	</main>

</body>
</html>
<script type="text/javascript">
	
	$(document).ready(function(){

		var paseador;

		var modalHorarios = document.getElementById('exampleModal')
		modalHorarios.addEventListener('shown.bs.modal', function (evento) {
	  			
	    	var botonQueAbrioModal = evento.relatedTarget;
	    	paseador = botonQueAbrioModal.getAttribute('id');
	    	modalHorarios.querySelector('.modal-body div').value = paseador;

		})

		modalHorarios.addEventListener('hidden.bs.modal', function (event) {
  			$('#disponibilidad option:eq(0)').prop('selected', true)
  			$('#horarios').empty();
		})

		$('#btnBuscar').click(function(){

			let fecha = $('#fecha').val();
			
			$.post('backend/disponibilidad.php',{paseador:paseador,fecha:fecha},function(horarios_disponibles){
					//console.log(data);
					$('#horarios').empty();
					$('#horarios').append(horarios_disponibles);
				})

		})


		$('#btnCerrarSesion').click(function () {
			$.post('backend/cerrarsesion.php',function(){
				location.href='index.php';
			});
		})

		$('#btnReservar').click(function(){
			
			let hora = $('input[name=hora]:checked').val();
			if ( hora == null){
				alert('Debes indicar un horario');
			}
			else{
				let fecha = $('#fecha').val();
				let perro = '<?php echo $_SESSION['perro_actual']['id_perro']; ?>';
				let cliente = '<?php echo $_SESSION['cliente_actual']['id_cliente'];?>';

				$.post('backend/procesar_turno.php',{paseador:paseador,perro:perro,fecha:fecha,hora:hora},function(resultado){
						console.log(resultado);
						if ( resultado.error != null ){
								alert(resultado.error);
						}else{
							alert("Perfecto!  <?php echo $_SESSION['perro_actual']['nombre_perro'];?> ya tiene su turno reservado para el " +  fecha + " a las " + hora + ". Gracias por confiar en nosotros :)");
						
							location.href = 'principal.php';		
						}
						

				},'json')


				
			}
			
		})

	})

</script>
