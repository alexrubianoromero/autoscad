<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$sql = "select * from productos where codigo_producto = '".$_REQUEST['codigo']."' ";
$consulta = mysql_query($sql,$conexion);
$infoCodigo = mysql_fetch_assoc($consulta);
echo json_encode($infoCodigo); 
exit();
?>