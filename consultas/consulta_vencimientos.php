<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
include('../valotablapc.php');
$sql_traer_vencimientos =
	 "
		select c.placa,c.vencisoat,cli.nombre,cli.telefono from $tabla4 c
		inner join cliente0 cli  on (cli.idcliente = c.propietario)
		  where month(vencisoat)  = '".$_POST['mes']."' and  year(vencisoat)  = '".$_POST['ano']."'  and c.id_empresa = '".$_SESSION['id_empresa']."'
		  
	";
	
	//echo '<br>'.$sql_traer_vencimientos;
$consulta_vencimientos = mysql_query($sql_traer_vencimientos,$conexion);

$sql_traer_vencimientos_revision =
	 "
		select c.placa,c.revision,cli.nombre,cli.telefono from $tabla4 c
		inner join cliente0 cli  on (cli.idcliente = c.propietario)
		  where month(revision)  = '".$_POST['mes']."' and  year(revision)  = '".$_POST['ano']."' and c.id_empresa = '".$_SESSION['id_empresa']."'
		  
	";
	
	//echo '<br>'.$sql_traer_vencimientos_revision;
$consulta_vencimientos_revision = mysql_query($sql_traer_vencimientos_revision,$conexion);



echo '<br>';
echo 'LISTADO DE VENCIMIENTOS SOAT '.$_POST['mes'].'ANO '	.$_POST['ano'];
echo '<br>';
echo '<br>';
echo '<table border = "1">';
echo '<tr><td>Placa</td><td>Vencimiento SoaT</td><td>Nombre</td><td>Telefono</td></tr>';
while($carros=mysql_fetch_array($consulta_vencimientos))
		{
			echo '<tr>';
			echo '<td>'.$carros['placa'].'</td>';
			echo '<td>'.$carros['vencisoat'].'</td>';
			echo '<td>'.$carros['nombre'].'</td>';
				echo '<td>'.$carros['telefono'].'</td>';
			echo '<tr>';
		}

echo '</table>';

/////////////////////////////////

echo '<br>';
echo 'LISTADO DE VENCIMIENTOS REVISION '.$_POST['mes'].'ANO '	.$_POST['ano'];
echo '<br>';
echo '<br>';
echo '<table border = "1">';
echo '<tr><td>Placa</td><td>Vencimiento Revision</td><td>Nombre</td><td>Telefono</td></tr>';
while($carros2=mysql_fetch_array($consulta_vencimientos_revision))
		{
			echo '<tr>';
			echo '<td>'.$carros2['placa'].'</td>';
			echo '<td>'.$carros2['revision'].'</td>';
			echo '<td>'.$carros2['nombre'].'</td>';
				echo '<td>'.$carros2['telefono'].'</td>';
			echo '<tr>';
		}

echo '</table>';

?>


</body>
</html>
