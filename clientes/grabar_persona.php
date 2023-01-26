<?php
session_start();
include('../valotablapc.php');

/*
echo '<pre>';
print_r($_POST);
echo '<pre>';
*/

$sql_verificar_cedula = "select * from $tabla3 where identi = '".$_REQUEST['cedula']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_cedula = mysql_query($sql_verificar_cedula,$conexion);
$filas_cedula = mysql_num_rows($consulta_cedula);
if($filas_cedula < 1)
	{		
		$sql_grabar_persona  = "insert into $tabla3 (identi,nombre,telefono,direccion,id_empresa,email,observaci)  
		 values(
			'".$_POST['cedula']."'
			,'".$_POST['nombre']."'
			,'".$_POST['telefono']."'
			,'".$_POST['direccion']."'
			,'".$_SESSION['id_empresa']."'
			,'".$_POST['email']."'
			,'".$_POST['observaciones']."'
			)"; 
		$consulta_grabar= mysql_query($sql_grabar_persona,$conexion);
		
		//echo '<br>'.$sql_grabar_persona.'<br>';
		
		echo '<H3>GRABACION EXITOSA</H3>';
	} //fin de si existe la cedula 
else 
	{
		echo 'ESTA CEDULA YA EXISTE NO SE PUEDE GRABAR NUEVAMENTE ';	
	}	
include('../colocar_links2.php');

?>