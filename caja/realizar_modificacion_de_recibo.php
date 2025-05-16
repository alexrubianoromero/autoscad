<?php
session_start();
?>
<?php
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

include('../valotablapc.php');
$sql_actulizar = "update $tabla23  set 

dequienoaquin = '".$_REQUEST['dequienoaquin']."'
,lasumade = '".$_REQUEST['lasumade']."'
,porconceptode = '".$_REQUEST['porconceptode']."'
,observaciones = '".$_REQUEST['observaciones']."'

where id_recibo = '".$_REQUEST['id_recibo']."'
and id_empresa = '".$_SESSION['id_empresa']."'
";
//echo '<br>'.$sql_actulizar;
$consulta_actulizar = mysql_query($sql_actulizar,$conexion);

//traer el saldo de la tabla empresa 
$sql_saldo_actual = "select saldocajamenor  from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_saldo = mysql_query($sql_saldo_actual,$conexion);
$consulta_saldo = mysql_fetch_assoc($consulta_saldo);
//verificar el tipo de recibo 

if($_REQUEST['tipo_recibo']== '1')
		{  	// osea es recibo de ingreso 
			// se resta la cantidad anterior y se suma la nueva 
			$nuevo_saldo = 	($consulta_saldo['saldocajamenor'] -  $_REQUEST['lasumade_anterior'])+ $_REQUEST['lasumade'];
		  
		}
else 	{ //osea si es de egreso 
			$nuevo_saldo = 	($consulta_saldo['saldocajamenor'] +  $_REQUEST['lasumade_anterior'])- $_REQUEST['lasumade'];
		}
		
//actulizar saldo 
$sql_actualizar_saldo = "update $tabla10 set saldocajamenor  = '".$nuevo_saldo."'  where id_empresa = '".$_SESSION['id_empresa']."'  ";	
$consulta_actualizar_saldo = mysql_query($sql_actualizar_saldo,$conexion);	
echo '	<h2>RECIBO ACTUALIZADO</h2>';
include('../colocar_links2.php');
?>