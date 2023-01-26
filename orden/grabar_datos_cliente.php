<?php
session_start();

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/



include('../valotablapc.php');
/*
$sql_verificar_cedula = "select * from $tabla3 where identi = '".$_REQUEST['cedula']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_cedula = mysql_query($sql_verificar_cedula,$conexion);
$filas_cedula = mysql_num_rows($consulta_cedula);
if($filas_cedula < 1)
	{	

	*/		
			$sql_grabar_cliente = "insert into $tabla3  (identi,nombre,direccion,telefono,email,id_empresa) 
			values (
			'".$_REQUEST['identi']."',
			'".$_REQUEST['nombre']."',
			'".$_REQUEST['direccion']."',
			'".$_REQUEST['telefono']."',
			'".$_REQUEST['email']."',
			'".$_SESSION['id_empresa']."'
			)
			
			";
			$consulta_grabar = mysql_query($sql_grabar_cliente,$conexion);
	//}
/*
else
	{
			echo 'ESTA CEDULA YA EXISTE NO SE PUEDE GRABAR MAS DE UNA VEZ';
	}
	*/
?>