<?php
include('../valotablapc.php');
include('mostrar_items.php');


$sql_actualizar_item = "update $tabla15  set descripcion = '".$_REQUEST['descripcion']."' 
where id_item = '".$_REQUEST['id_item']."'  ";
//echo '<br>'.$sql_actualizar_item;
$consulta_ac_item = mysql_query($sql_actualizar_item,$conexion);

mostrar_items($_REQUEST['id_orden']);


?>