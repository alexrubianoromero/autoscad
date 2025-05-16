<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_POST);
echo '<pre>';
*/

$sql_grabar_persona  = "insert into $tabla30 (nombre_perfil,descripcion,id_empresa)  
 values(
 	'".$_POST['nombre_perfil']."'
 	,'".$_POST['descripcion']."'
	,'".$_SESSION['id_empresa']."'
 	)"; 
$consulta_grabar= mysql_query($sql_grabar_persona,$conexion);

//echo '<br>'.$sql_grabar_persona.'<br>';

echo '<H3>GRABACION EXITOSA</H3>';

include('../colocar_links2.php');

?>