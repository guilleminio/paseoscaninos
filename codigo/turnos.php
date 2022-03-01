<?php 
session_start();
if ( !isset($_SESSION['cliente_actual'])){
	header('Location:login.php');
	exit();
}
include('backend/funcionesBD.php');
include('backend/config.php');
$conexion = conectarBD();

$turnos = null;
$totalTurnos = 0;
if ( $conexion['resultado']!=null){
	$turnos = obtenerTurnos($conexion['resultado'],$_SESSION['perro_actual']['id_perro']);
	$totalTurnos = count($turnos['resultado']);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo TITULO_SITIO?> - Turnos</title>

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
		
		<?php include('menu.php'); ?>

	  	<section>
			<div class="container">
				<h1>Turnos para pasear</h1>
				<?php
					if ( $totalTurnos >0 ){
						echo "<h3>Estos son los próximos paseos de ".$_SESSION['perro_actual']['nombre_perro']."</h3>";

				
						echo "<table class=\"table table-striped table-hover \">
								<thead>
									<tr>
										<th>Fecha</th>
										<th>Hora</th>
										<th>Paseador</th>
										<th>Cancelar</th>
									</tr>
								</thead>
								<tbody>";


						for ( $i = 0; $i < $totalTurnos; $i++ ){
							
							$paseador = obtenerPaseador($conexion['resultado'],$turnos['resultado'][$i]['id_paseador']);
							echo "<tr>
									<th scope=\"row\">".$turnos['resultado'][$i]['fecha_paseo']."</th>
									<td>".$turnos['resultado'][$i]['hora_paseo']."</td>
									<td>".$paseador['resultado']['nombre_paseador']."</td>
									<td><button class=\"btn btn-outline-danger\" id=\"".$turnos['resultado'][$i]['id_paseo']."\"data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">Cancelar</button></td>
								  </tr>";
						}

						echo "</tbody>
						      </table>";


						
					}else
						echo "<h3>".$_SESSION['perro_actual']['nombre_perro']." aún no tiene paseos resevados. ¿Reservamos uno? <a href=\"reservar_turno.php\">Click aquí</a></h3>";
				?>

			</div>
		</section>
	</main>

	<!------------ Mensaje de confirmación ------------------------>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel">Atención</h5>
      			</div>
      			<div class="modal-body">
   					¿En verdad quierés cancelar el paseo?
      			</div>
      			<div class="modal-footer">
      				<button type="button" id="btnNo" class="btn btn-secondary">No</button>
        			<button type="button" id="btnSi" class="btn btn-primary botonActivo">Si</button>
      			</div>
    		</div>
  		</div>
	</div>
	<!----------- Fin mensaje de confirmación ---------------------->



</body>
</html>

<script type="text/javascript">
	
	$(document).ready(function(){

		var turno;
		var modalAlerta = document.getElementById('exampleModal')
		modalAlerta.addEventListener('shown.bs.modal', function (evento) {
	  			
	    	var botonQueAbrioModal = evento.relatedTarget;
	    	turno = botonQueAbrioModal.getAttribute('id');
	    	modalAlerta.querySelector('.modal-body div').value = turno;

		})

		$('#btnSi').click(function() {
				
			$.post('backend/procesar_cancelacion.php',{turno:turno},function(resultado){
				console.log(resultado);
				if ( resultado.error != null){
					alert(resultado.error);
				}else{
					$('#exampleModal').modal('hide');
					location.reload();

				}

			},'json')
		})



		$('#btnCerrarSesion').click(function () {
			$.post('backend/cerrarsesion.php',function(){
				location.href='index.php';
			});
		})
	})


</script>
