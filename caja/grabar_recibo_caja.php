<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
$sql_grabar_salida = "insert into $tabla23 (fecha_recibo,dequienoaquin,porconceptode,lasumade,observaciones,tipo_recibo,numero_recibo,id_empresa,id_usuario_creacion) 
values (
'".$_POST['fecha']."'
,'".$_POST['dequienoaquin']."' 
,'".$_POST['porconceptode']."'
,'".$_POST['lasumade']."'
,'".$_POST['observaciones']."'
,'".$_POST['tipo_recibo']."'
,'".$_POST['numero_recibo']."'
,'".$_SESSION['id_empresa']."'
,'".$_SESSION['id_usuario']."'
) ";
$consulta_grabar = mysql_query($sql_grabar_salida,$conexion);
//////////////////////////////////
//////////////grabar una trazabilidad del recibo una copia de respaldo automatica para saber que pasa con los recibos 
////
$sql_grabar_salida_traz = "insert into $tabla50 (fecha_recibo,dequienoaquin,porconceptode,lasumade,observaciones,tipo_recibo,numero_recibo,id_empresa,id_usuario_creacion) 
values (
'".$_POST['fecha']."'
,'".$_POST['dequienoaquin']."' 
,'".$_POST['porconceptode']."'
,'".$_POST['lasumade']."'
,'".$_POST['observaciones']."'
,'".$_POST['tipo_recibo']."'
,'".$_POST['numero_recibo']."'
,'".$_SESSION['id_empresa']."'
,'".$_SESSION['id_usuario']."'
) ";
$consulta_grabar_traz = mysql_query($sql_grabar_salida_traz,$conexion);

//////traer el valor actual del saldo
$sql_traer_saldo_caja = "select saldocajamenor from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_traer_saldo = mysql_query($sql_traer_saldo_caja,$conexion);
$traer_saldo = mysql_fetch_assoc($consulta_traer_saldo);
$saldo_actual_caja = $traer_saldo['saldocajamenor'];
//echo '<br>saldo_actual<br>'.$saldo_actual_caja;
//calcular el valor del nuevo saldo 

if($_POST['tipo_recibo'] == 1) { 
	echo 'pasooooo11111 es recibo tipo1 ';
	$nuevo_saldo =  $saldo_actual_caja + $_POST['lasumade'];
}
//echo '<br>nuevo saldo<br>'.$nuevo_saldo;
if($_POST['tipo_recibo'] == 2) { $nuevo_saldo =  $saldo_actual_caja - $_POST['lasumade'];}
//echo '<br>nuevo saldo<br>'.$nuevo_saldo;

/////////actualizar el valor del saldo 
$sql_actualizar_saldo  = "update $tabla10   set saldocajamenor = '".$nuevo_saldo."'     
 where id_empresa = '".$_SESSION['id_empresa']."' ";
 //echo '<br>consulta actulizar saldo<br>'.$sql_actualizar_saldo;
$consulta_actualizar = mysql_query($sql_actualizar_saldo,$conexion);

//actulizar el numero del recibo utilizado 

$sql_actulizar_recibo = "update $tabla10 set contarecicaja = '".$_POST['numero_recibo']."'  where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_actualizar_recibo = mysql_query($sql_actulizar_recibo,$conexion);
echo '<br>
<br>';
echo '<h2>RECIBO GRADADO SATISFACTORIAMENTE Y SALDO DE CAJA ACTUALIZADO</h2>';
echo '<br>';
echo '<h2>EL NUEVO SALDO ES DE $'.number_format($nuevo_saldo, 0, ',', '.').' </h2>';
echo '<br>';
echo  '<h2><a href="recibo_imprimir.php?numero='.$_POST['numero_recibo'].'" target = "_blank" >VISTA IMPRESION DE RECIBO</a></h2>';
include('../colocar_links2.php');

?>