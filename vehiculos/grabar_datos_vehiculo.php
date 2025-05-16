<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

include('../valotablapc.php');
$sql_carros = "select * from $tabla4 where placa = '".$_REQUEST['placa']."'  and id_empresa = '".$_SESSION['id_empresa']."'   ";
//echo '<br>'.$sql_carros.'<br>';
$consulta_carro = mysql_query($sql_carros,$conexion);
$filas_carro = mysql_num_rows($consulta_carro);
//echo 'filas carro <br>'.$filas_carro;
if($filas_carro < 1);
		{			
			$sql_grabar_carro = "insert into $tabla4  (placa,marca,tipo,modelo,color,id_empresa,vencisoat,revision,propietario,chasis,motor) 
			values (
			'".$_POST['placa']."',
			'".$_POST['marca']."',
			'".$_POST['tipo']."',
			'".$_POST['modelo']."',
			'".$_POST['color']."',
			'".$_SESSION['id_empresa']."',
			'".$_POST['vencisoat']."',
			'".$_POST['revision']."',
			'".$_POST['propietario']."',
			'".$_POST['chasis']."',
			'".$_POST['motor']."'
			)";
			//echo '<br>'.$sql_grabar_carro.'<br>';
			//exit();
			$consulta_grabar_carros = mysql_query($sql_grabar_carro,$conexion);
			echo '<H2>GRABACION EXITOSA..</H2>';
		}
		
if($filas_carro > 0);
		{
			echo 'ESTA PLACA YA EXISTE NO SE PUEDE GRABAR MAS DE UNA VEZ';
		}

?>