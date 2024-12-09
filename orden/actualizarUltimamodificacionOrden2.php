<?php
// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();
include('../valotablapc.php');
$sql = "update ordenes set
usuario_modificacion = '".$_REQUEST['nombreUsuarioLogueado']."' 
,hora_modif = now()
where id = '".$_REQUEST['idOrden']."'  ";
$consulta = mysql_query($sql,$conexion);

?>