<?php
session_start();
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
include('../valotablapc.php');
$sql_traer_clave_actual = "select * from $tabla16   where id_usuario = '".$_SESSION['id_usuario']."' ";
$consulta_traer_informacion = mysql_query($sql_traer_clave_actual,$conexion);
$datos_usuario = mysql_fetch_assoc($consulta_traer_informacion);


if($datos_usuario['clave']==$_POST['anterior'])
	{
			//echo 'la clave si coincide';
			if($_POST['nueva1']==$_POST['nueva2'])
				{
					$actualizar_clave = "update $tabla16 set clave = '".$_POST['nueva1']."'  where id_usuario = '".$_SESSION['id_usuario']."' ";
					$consulta_cambio_clave = mysql_query($actualizar_clave,$conexion);
					echo 'CLAVE ACTUALIZADA EXITOSAMENTE ';
				}
			else 
				{
				   echo 'LAS NUEVAS CLAVES NO COINCIDEN';
				}	
				
	}
else
	{
			echo 'LA CLAVE ANTERIOR NO COINCIDE';
	}
include('../colocar_links2.php');


?>