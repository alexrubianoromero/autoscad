<!DOCTYPE html>

<head>
<meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<body>
<?php

include('../valotablapc.php');

$sql_cotizaciones = "select cot.id_cotizacion,cot.no_cotizacion,cot.fecha , c.placa,cli.nombre,cot.id_factura   
from  $cotizaciones  cot
inner join $tabla4 c on  (c.idcarro = cot.idcarro)
inner join $tabla3 cli on (cli.idcliente = c.propietario)


order by id_cotizacion desc";
$consulta_cotizaciones = mysql_query($sql_cotizaciones,$conexion);

echo '<div id="cotizaciones" align="center">';
echo '<h2>COTIZACIONES</h2>';
echo '<table border = "1">';
echo '<tr>';
echo '<td>No Cotizacion</td>';
echo '<td>No Factura</td>';
echo '<td>FECHA</td>';
echo '<td>NOMBRE</td>';
echo '<td>CARRO</td>';
echo '<td>MODIFICAR</td>';
echo '<td>IMPRIMIR</td>';
echo '</tr>';
while ($coti =mysql_fetch_assoc($consulta_cotizaciones))
{
	echo '<tr>';

	echo '<td>'.$coti['no_cotizacion'].'</td>';


	if($coti['id_factura'] > 0 )
	{
		$sql_factura = "select * from $tabla11 where id_factura =  '".$coti['id_factura']."'  ";
		$con_nofactura = mysql_query($sql_factura,$conexion);
		$arr_nofactura = mysql_fetch_assoc($con_nofactura);
		$nofactura = $arr_nofactura['numero_factura'];
	   echo '<td align="center">'.$nofactura.'</td>';
    }
    else
    {
    	echo '<td><a href="../cotizaciones/facturar_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'">FACTURAR</a></td>';
    }	


	echo '<td>'.$coti['fecha'].'</td>';
	echo '<td>'.$coti['nombre'].'</td>';
	echo '<td>'.$coti['placa'].'</td>';
	echo '<td><a href ="modificar_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'" >Modificar</a></td>';
	echo '<td><a href="imprimir_cotizacion.php?id_cotizacion='.$coti['id_cotizacion'].'" target="_blank">Imprimir</a></td>';
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