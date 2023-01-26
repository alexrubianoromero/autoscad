<!DOCTYPE html>

<head>
<meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<body>
<?php

include('../valotablapc.php');

$sql_cotizaciones = "select cot.id_factura,cot.numero_factura,cot.fecha , c.placa,cli.nombre   
from  $tabla11  cot
inner join $tabla4 c on  (c.idcarro = cot.idcarro)
inner join $tabla3 cli on (cli.idcliente = c.propietario)
order by id_factura desc";
//echo '<br>'.$sql_cotizaciones;

$consulta_cotizaciones = mysql_query($sql_cotizaciones,$conexion);

echo '<div id="cotizaciones" align="center">';
echo '<h2>FACTURAS</h2>';
echo '<table border = "1">';
echo '<tr>';
echo '<td>No Factura</td>';
echo '<td>No FECHA</td>';
echo '<td>NOMBRE</td>';
echo '<td>CARRO</td>';
echo '<td>MODIFICAR</td>';
echo '<td>IMPRIMIR</td>';
echo '</tr>';
while ($coti =mysql_fetch_assoc($consulta_cotizaciones))
{
	echo '<tr>';
	echo '<td>'.$coti['numero_factura'].'</td>';
	echo '<td>'.$coti['fecha'].'</td>';
	echo '<td>'.$coti['nombre'].'</td>';
	echo '<td>'.$coti['placa'].'</td>';
	echo '<td><a href ="modificar_cotizacion.php?id_cotizacion='.$coti['id_factura'].'" >Modificar</a></td>';
	echo '<td><a href="imprimir_cotizacion.php?id_cotizacion='.$coti['id_factura'].'" target="_blank">Imprimir</a></td>';
	echo '<tr>';
}
echo '</table>';
echo '<div>';
?>


</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../jquery-2.1.1.js"></script>  
<script src="jquery-2.1.1.js"></script>   