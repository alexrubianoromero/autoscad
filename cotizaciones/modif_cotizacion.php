<?php
include('../valotablapc.php');

$sql_actualizar = "update $cotizaciones   set  kilometraje = '".$_REQUEST['kilometraje']."'

where  id_cotizacion = '".$_REQUEST['id_cotizacion']."'

";
$con_actualizar = mysql_query($sql_actualizar,$conexion);

?>