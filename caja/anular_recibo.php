<?php
session_start();

include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
//exit();

$sql_anular = "update $tabla23 set anulado = '1'   where numero_recibo = '".$_REQUEST['numero_recibo']."'   and  id_empresa = '".$_SESSION['id_empresa']."'   ";

$consulta_anular = mysql_query($sql_anular,$conexion);
//traer el saldo de la tabla empresa 
$sql_saldo_actual = "select saldocajamenor  from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_saldo = mysql_query($sql_saldo_actual,$conexion);
$consulta_saldo = mysql_fetch_assoc($consulta_saldo);
////////verificar el tipo de recibo
if($_REQUEST['tipo_recibo'] == 1)
		{  	// osea es recibo de ingreso 
			// se resta la cantidad anterior y se suma la nueva 
			$nuevo_saldo = 	$consulta_saldo['saldocajamenor'] - $_REQUEST['lasumade'];
		  
		}
else 	{ //osea si es de egreso 
			$nuevo_saldo = 	$consulta_saldo['saldocajamenor'] + $_REQUEST['lasumade'];
		}

/////////////////
//actulizar saldo 
$sql_actualizar_saldo = "update $tabla10 set saldocajamenor  = '".$nuevo_saldo."'  where id_empresa = '".$_SESSION['id_empresa']."'  ";	
$consulta_actualizar_saldo = mysql_query($sql_actualizar_saldo,$conexion);	


echo '<h2>RECIBO ANULADO</h2> ';
include('../colocar_links2.php');
?>
