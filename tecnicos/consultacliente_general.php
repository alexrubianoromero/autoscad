<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');

$sql_clientes = "select nombre,telefono,email,direccion,observaci,idcliente 
from $tabla21 as cli  where  cli.id_empresa = '".$_SESSION['id_empresa']."'   ";

//inner join $tabla4 car  on (car.propietario = cli.idcliente)
//,placa,marca,color,modelo
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container" align="center">
<?php

echo '<h3>CONSULTA GENERAL </h3> ';

echo '<table border = "1" width = "95%" class="table table-striped" >';
echo '<tr><td>NOMBRE</td><td>TELEFONO</td><td>EMAIL</td><td>DIRECCION</td><td>OBSERVACIONES</td></tr>';
$consulta_clientes = mysql_query($sql_clientes,$conexion);
while($clientes = mysql_fetch_array($consulta_clientes))
	{
			echo '<tr>';	
			echo '<td><a href = "../tecnicos/muestre_datos_cliente.php?idcliente='.$clientes[5].' " >'.$clientes[0].'</a></td>';
			echo '<td>'.$clientes[1].'</td>';
			echo '<td>'.$clientes[2].'</td>';
			echo '<td>'.$clientes[3].'</td>';
			echo '<td>'.$clientes[4].'</td>';
			
			echo '</tr>';
	}
echo '</table>';

?>
</div>
</body>
</html>
<script type="text/javascript" src="../bootstrap.min.js"></script>