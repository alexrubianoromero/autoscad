<?php
include('../valotablapc.php');
$sql_eliminar_item_cotizacion = "delete from $item_orden_cotizaciones  where id_item = '".$_REQUEST['eliminar']."'  ";
//echo '<br>'.$sql_eliminar_item_cotizacion;

$consulta_eliminar = mysql_query($sql_eliminar_item_cotizacion,$conexion);

include('mostrar_items.php');

mostrar_items($_REQUEST['id_cotizacion']);

?>