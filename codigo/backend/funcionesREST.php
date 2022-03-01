<?php
define('URL_REST', 'http://localhost/INTERFACES_PROGRAMACION_VISUAL/TP_FINAL/PASEOS_CANINOS/REST/rest.php');


function obtenerDisponibilidad($paseador,$fecha){
	return json_decode(file_get_contents(URL_REST."?id=$paseador&fecha=$fecha"),true);
}

function eliminarDisponibilidad($turno){

	$url = URL_REST."?id=".$turno['paseador']."&fecha=".$turno['fecha']."&hora=".$turno['hora'];

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    $result = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
   
}

function agregarDisponibilidad($turno){

	$url = URL_REST;
	
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL,$url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS,
            "id=".$turno['paseador']."&fecha=".$turno['fecha']."&hora=".$turno['hora']);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($curl);

	curl_close ($curl);
   
}

?>