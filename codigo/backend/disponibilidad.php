<?php
include('funcionesREST.php');

$paseador = strip_tags(addslashes($_POST['paseador']));
$fecha = strip_tags(addslashes($_POST['fecha']));
$horas = obtenerDisponibilidad($paseador,$fecha);

$totalHoras = count($horas);

if ( $totalHoras > 0){

	$resultado = "<div class=\"container\">
				  <table class=\"table\">
		        	<thead>
		        		<td>Hora</td>
		        		<td>Seleccionar</td>
		        	</thead>
		        	<tbody>";


	for ( $i  = 0; $i < $totalHoras; $i++ ){
		$resultado.= "<tr>
		        		<td>".$horas[$i]['hora']."</td>
		        		<td><input type=\"radio\" name=\"hora\" value=\"".$horas[$i]['hora']."\">
	        		</td>";
	}

	$resultado.= "</tbody>
        		</table></div>";

    echo $resultado;
}else{
	echo "No hay horarios disponibles.";
}


?>