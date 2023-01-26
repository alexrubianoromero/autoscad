<?php
session_start();
include('../valotablapc.php');
$sql_grabar_saldo = "insert into $tabla22   (fecha,saldo_inicial,tipo,id_empresa,observaciones)   
values ('".$_POST['fecha']."','".$_POST['saldo_inicial']."','1','".$_POST['id_empresa']."','SALDO INICIAL')";
//echo '<br>consulta<br>'.$sql_grabar_saldo,'<br>';
$consulta_grabar = mysql_query($sql_grabar_saldo,$conexion);

///actulizar saldo en la tabla empresa 
$sql_actulizar_saldo_empresa = "update $tabla10 set saldocajamenor  = '".$_REQUEST['saldo_inicial']."'   where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_actulizar_saldo = mysql_query($sql_actulizar_saldo_empresa,$conexion);

echo '<H2>SALDO INICIAL GRABADO POR VALOR DE <BR> '.$_POST['saldo_inicial'].'</H2>';
include('../colocar_links2.php');
?>
