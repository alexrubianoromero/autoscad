<?php
session_start();
include('../valotablapc.php');

$sql_grabar_persona  = "insert into $tabla21 (identi,nombre,telefono,direccion,id_empresa)   values('".$_POST['cedula']."','".$_POST['nombre']."','".$_POST['telefono']."','".$_POST['direccion']."','".$_SESSION['id_empresa']."')"; 
$consulta_grabar= mysql_query($sql_grabar_persona,$conexion);

echo 'TECNICO GRABADO';

include('../colocar_links2.php');

?>