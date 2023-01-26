<?php
/*
echo '<pre>';
print_r($_REQUEST);
echo '<pre>';
*/
include('../valotablapc.php');

$sql_actualizar = "update $tabla11   set  kilometraje = '".$_REQUEST['kilometraje']."'
,observaciones =  '".$_REQUEST['observaciones']."'
,fecha =  '".$_REQUEST['fecha']."'

where  id_factura = '".$_REQUEST['id_cotizacion']."'

";
$con_actualizar = mysql_query($sql_actualizar,$conexion);
echo '<br>'.$sql_actualizar;

?>