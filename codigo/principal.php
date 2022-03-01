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
	<title><?php echo TITULO_SITIO?> - Página principal</title>

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
				<h1>Hola <?php echo $_SESSION['cliente_actual']['nombre_cliente']?>!</h1>
				<h2>¿Qué aventura quieres para <?php echo $_SESSION['perro_actual']['nombre_perro'];?>?</h2>
			</div>
		</section>
	</main>

</body>
</html>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#btnCerrarSesion').click(function () {
			$.post('backend/cerrarsesion.php',function(){
				location.href='index.php';
			});
		})
	})


</script>
