<?php include('backend/config.php');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo TITULO_SITIO?> - Bienvenidos</title>

	<?php include('librerias/librerias.php');?>

	<!----------------- CSS PROPIOS --------------------------->
	<link rel="stylesheet" type="text/css" href="css/inicio.css">
	<!--------------------------------------------------------->
</head>
<body>
	<header>
		<div class="px-3 py-2 bg-dark text-white">
	      <div class="container">
	        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
	          <a href="#" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
	          </a>

	          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
	            <li>
	            	<a href="login.php" class="btn  me-2 botonActivo">Iniciar sesión</a>
	            </li>
	          </ul>
	        </div>
	      </div>
	    </div>
	</header>


	<section>
		<!-- Presentación -->
		<article id="presentacion" class="contenedor presentacion">
			<div class="container">
				<div class="row">
					<div class="col-6 col-5-large col-12-small">
						<h1 style="color:white;"><strong><?php echo TITULO_SITIO?></strong></h1>
						<p><strong>Haz que tu mejor amig@ disfrute de un gran momento</strong></p>
						<a href="registro.php" class="btn  btn-primary btn-lg botonActivo">Crea tu cuenta</a>
					</div>
				</div>
			</div>
		</article>

		<!-- fin presentación -->


		<!-- Servicios -->
		<article class="contenedor servicios">
			<div class="container">
				<header>
					<h2>SERVICIOS</h2>
					<p>Estas son algunas de las cosas que hacemos para que ell@s se sientan muy bien</p>
				</header>
				<div class="row aln-center">
					<div class="col-4 col-6-medium col-12-small">
						<section class="caja">
							<h3>ENTRENAMIENTO</h3>
							<p>El entrenamiento y el ejercicio son vitales para el desarrollo de tu amig@. ¡Conocé más!</p>
						</section>
					</div>
					<div class="col-4 col-6-medium col-12-small">
						<section class="caja">
							<h3>PASEOS</h3>
							<p>Caminatas de una hora y media por nuestra bella costa junto a nuestro amigos. Gupos limitados para que todos tengan la atención que merecen.</p>
						</section>
					</div>
					<div class="col-4 col-6-medium col-12-small">
						<section class="caja">
							<h3>GUARDERÍA</h3>
							<p>Cuidamos de ellos cuando no pueden acompañarte. Se divertirán tanto que ni cuenta se darán.</p>
						</section>
					</div>
				</div>
				
			</div>
		</article>

		<!-- fin servicios -->

		<!-- Amig@s -->
		<article class="contenedor amigos">
			<div class="container">
				<header>
					<h2>Algunos de nuestros amig@s!</h2>
				</header>
				<div class="row">
					<div class="col-4 col-6-medium col-12-small">
						<article class="caja amigos">
							<a href="#" class="imagen tarjeta"><img src="imagenes/amigos/ruffo.jpg" alt="" /></a>
							<h3><a href="#">Ruffo</a></h3>
							<p>Siempre listo para pasear. Juguetón pero super obediente</p>
						</article>
					</div>
					<div class="col-4 col-6-medium col-12-small">
						<article class="caja amigos">
							<a href="#" class="imagen tarjeta"><img src="imagenes/amigos/lola.jpg" alt="" /></a>
							<h3><a href="#">Lola</a></h3>
							<p>Una alegría que contagia. Le encanta pasear y es muy sociable</p>
						</article>
					</div>
					<div class="col-4 col-6-medium col-12-small">
						<article class="caja amigos">
							<a href="#" class="imagen tarjeta"><img src="imagenes/amigos/aldo.jpg" alt="" /></a>
							<h3><a href="#">Aldo Bonzi</a></h3>
							<p>Se llama así porque fue encontrado en la ciudad de Aldo Bonzi</p>
						</article>
					</div>
					<div class="col-4 col-6-medium col-12-small">
						<article class="caja amigos">
							<a href="#" class="imagen tarjeta"><img src="imagenes/amigos/lopez.jpg" alt="" /></a>
							<h3><a href="#">Sr. Lopez</a></h3>
							<p>Tremendo comprador!</p>
						</article>
					</div>
					<div class="col-4 col-6-medium col-12-small">
						<article class="caja amigos">
							<a href="#" class="imagen tarjeta"><img src="imagenes/amigos/dominga.jpg" alt="" /></a>
							<h3><a href="#">Dominga</a></h3>
							<p>A ella si que no le pasan los añor :)</p>
						</article>
					</div>
					<div class="col-4 col-6-medium col-12-small">
						<article class="caja amigos">
							<a href="#" class="imagen tarjeta"><img src="imagenes/amigos/faustina.jpg" alt="" /></a>
							<h3><a href="#">Faustina</a></h3>
							<p>Nuesta más coqueta amiga</p>
						</article>
					</div>
				</div>
				<footer>
					<p>Querés que tu amig@ sea una a esta hermosa pandilla?</p>
					<a href="registro.php" id="btnReservar" class="btn me-2 botonActivo">Reserva su turno!</a>
				</footer>
			</div>
		</article>

		<!-- fin amig@s -->

	</section>

	<footer>
		<article class="contenedor contacto">
			<div class="container medium">
				<div class="col-12">
					<hr />
					<h3>Encuéntranos en...</h3>
					<ul class="social">
						<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon brands fa-youtube"><span class="label">Youtube</span></a></li>
					</ul>
					<hr />
				</div>
			</div>
			<footer>
					<ul id="copyright">
						<li>&copy; <?php echo TITULO_SITIO?>. Todos los derechos reservados.</li>
					</ul>
			</footer>
		</article>
	</footer>

</body>
</html>