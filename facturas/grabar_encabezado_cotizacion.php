<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

echo 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrr';
*/
include('../valotablapc.php');
$insertar_cotizacion = "insert into $tabla11(numero_factura,idcarro,id_empresa,fecha,kilometraje,observaciones)
values('".$_REQUEST['no_cotizacion']."','".$_REQUEST['idcarro']."','".$_SESSION['id_empresa']."'
	,'".$_REQUEST['fecha']."'
	,'".$_REQUEST['kilometraje']."'
	,'".$_REQUEST['observaciones']."'
	);";
//echo '<br>'.$insertar_cotizacion;
$consulta_grabar = mysql_query($insertar_cotizacion,$conexion);

//actualizar contador de cotizaciones en empresa 

$sql_actualizar = "update  $tabla10 set contafac = '".$_REQUEST['no_cotizacion']."' ";
$consulta_act=mysql_query($sql_actualizar,$conexion);

$sql_traer_id = "select max(id_factura) as id_cotizacion from $tabla11";
$consulta_id = mysql_query($sql_traer_id,$conexion);
$arreglo_id=mysql_fetch_assoc($consulta_id); 
$id_cotizacion = $arreglo_id['id_cotizacion'];
//echo '<br>'.$id_cotizacion.'<br>';

echo '[{"id_cotizacion":"'.$id_cotizacion.'"}]';

?>