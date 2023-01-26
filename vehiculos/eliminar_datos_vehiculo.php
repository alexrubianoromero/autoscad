<?php
include('../valotablapc.php');

$revisar_vechiculo ="select * from $tabla14  where placa = '".$_REQUEST['placa']."'   ";
//echo '<br>'.$revisar_vechiculo;
$consulta_revision = mysql_query($revisar_vechiculo,$conexion);
$filas_carros = mysql_num_rows($consulta_revision);

if($filas_carros < 1)
	{
		$sql_eliminar_carro = "delete from $tabla4 where idcarro = '".$_REQUEST['idcarro']."'    ";
		$consulta_eliminar = mysql_query($sql_eliminar_carro,$conexion);
		echo '<BR>DATOS ELIMINADOS<BR> ';
	}



?>