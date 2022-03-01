<?php
$conexion = new mysqli('localhost','root','','turnos_paseadores');

if ( $conexion->connect_error)
	die('PROBLEMAS');



if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']) && isset($_GET['fecha']))
    {
       $sentencia = $conexion->prepare('SELECT hora FROM disponibilidad WHERE idpaseador = ? && fecha=?');

       if ($sentencia){
       		if ( $sentencia->bind_param('is',$_GET['id'],$_GET['fecha'])){
       			if ( $sentencia->execute()){

       				if ( $disponibilidad = $sentencia->get_result()){
	       				header("HTTP/1.1 200 OK");
	       				echo json_encode($disponibilidad->fetch_All(MYSQLI_ASSOC));
	       				exit();
       				}
       			}
       		}
       }
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){

	if (isset($_GET['id']) && isset($_GET['fecha']) && isset($_GET['hora']))
    {
       $sentencia = $conexion->prepare('DELETE FROM disponibilidad WHERE idpaseador = ? && fecha=? && hora=?');

       if ($sentencia){
       		if ( $sentencia->bind_param('iss',$_GET['id'],$_GET['fecha'],$_GET['hora'])){
       			if ( $sentencia->execute()){

       				if ( $disponibilidad = $sentencia->get_result()){
	       				header("HTTP/1.1 200 OK");
	       				exit();
       				}
       			}
       		}
       }
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	if (isset($_POST['id']) && isset($_POST['fecha']) && isset($_POST['hora']))
    {
       $sentencia = $conexion->prepare('INSERT INTO disponibilidad(idpaseador,fecha,hora)VALUES(?,?,?)');

       if ($sentencia){
       		if ( $sentencia->bind_param('iss',$_POST['id'],$_POST['fecha'],$_POST['hora'])){
       			if ( $sentencia->execute()){

       				if ( $disponibilidad = $sentencia->get_result()){
	       				header("HTTP/1.1 200 OK");
	       				exit();
       				}
       			}
       		}
       }
	}
}

header("HTTP/1.1 404 SOLICITUD NO ENCONTRADA");

?>