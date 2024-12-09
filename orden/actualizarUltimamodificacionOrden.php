<?php
// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();
include('../valotablapc.php');
$sql = "update ordenes set
usuario_modificacion = '".$_SESSION['usuario']."' 
,hora_modif = now()
where id = '".$_REQUEST['id_orden']."'  ";
$consulta = mysql_query($sql,$conexion);

?>