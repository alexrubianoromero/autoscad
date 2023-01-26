<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

include('../valotablapc.php');
$fechaFFase= $_REQUEST['fecha_cierre'];
//$fechaFFase='2013-08-31';
// podes sumar 1 dia o su equivalente en segundos (tenes que borrar una de las 2 lineas):
 $nuevafecha = date('Y-m-d', strtotime($fechaFFase) + 86400);
 $nuevafecha = date('Y-m-d', strtotime("$fechaFFase + 1 day"));
 
//echo $nuevafecha;


$sql_cerra_caja_dia  = "update $tabla22 set cerrado = '1' ,saldo_final = '".$_REQUEST['saldo_final_dia']."'   where id_dia_caja = '".$_REQUEST['id_dia_caja']."'  and id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_cerrar_dia = mysql_query($sql_cerra_caja_dia,$conexion);

//crear el saldo inicial del siguiente dia 

$sql_crear_saldo_siguiente_dia = "insert into $tabla22  (fecha,saldo_inicial,tipo,id_empresa ) 
 values ('".$nuevafecha."','".$_REQUEST['saldo_final_dia']."','1','".$_SESSION['id_empresa']."') ";
 $consulta_crear_saldo_siguiente_dia = mysql_query($sql_crear_saldo_siguiente_dia,$conexion);
 
 echo '<br>Se realizo el cierre del dia solicitado de forma satisfactoria<br> ';
 
 include('../colocar_links2.php');
 
 
 
 



?>
