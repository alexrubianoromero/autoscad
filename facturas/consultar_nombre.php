<!DOCTYPE html>

<head>
<meta charset="UTF-8"/>
</head>
</html>
<body>
<?php
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');
//$sql_busqueda_placa = "select placa,marca,modelo,color from $tabla4 where placa like '%".$_REQUEST['placa']."%' ";
$sql_busqueda_nombre = "select identi,nombre,idcliente,direccion from $tabla3 where nombre like '%".$_REQUEST['nombre']."%'";
//echo '<br>'.$sql_busqueda_placa.'<br>';
$consulta = mysql_query($sql_busqueda_nombre,$conexion);
//echo '<H3>RESULTADOS BUSQUEDA '.$_REQUEST['nombre'].'</H3>';
echo '<br>';
echo '<table border="1" width ="40%">';
echo '<tr>';
echo '<td>NOMBRE</td>';
echo '<td>IDENTIDAD</td>';
echo '<td>DIRECCION</td>';
echo '<td>COTIZACION</td>';

echo '<tr>';
while($carros = mysql_fetch_assoc($consulta))
	{
	 echo '<tr>';
	 echo '<td>'.$carros['nombre'].'</td>';
	 echo '<td>'.$carros['identi'].'</td>';
	  echo '<td>'.$carros['direccion'].'</td>';
	 echo  '<td>';
	 echo '<a href=nueva_cotizacion.php?idcliente='.$carros['idcliente'].'" >COTIZACION</a>';
	 echo '</td>'; 
	 
	 echo '<tr>';
	}
echo '</table>';
?>
</body>
</html>