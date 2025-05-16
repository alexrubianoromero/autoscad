<?php
session_start();
include ("valotablapc.php"); 
$sql_empresa = "select * from $tabla10 where id_empresa = ".$_SESSION['id_empresa']." ";
//echo '<br>'.$sql_empresa.'<br>';
$consulta_empresa = mysql_query($sql_empresa,$conexion);
while($datos_empresa = mysql_fetch_array($consulta_empresa))

		{
				$empresa = $datos_empresa[0];
				$nit = $datos_empresa[4];
				$direccion = $datos_empresa[1];
				$telefono   = $datos_empresa[2];
				$slogan = $datos_empresa[3];
		}
?>