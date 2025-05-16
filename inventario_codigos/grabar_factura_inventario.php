<?php
session_start();
include('../valotablapc.php'); 
/*
echo '<pre>';
print_r($_REQUEST); 
echo '</pre>';
*/

$sql_grabar_factura = "insert into $tablafacinv  (no_factura,fecha,proveedor,id_empresa) values ('".$_REQUEST['no_factura']."','".$_REQUEST['fecha']."','".$_REQUEST['proveedor']."',
'".$_SESSION['id_empresa']."')";
$consulta_grabar = mysql_query($sql_grabar_factura,$conexion);

echo '<h3>LA FACTURA FUE GRABADA SATISFACTORIAMENTE </h3>';
echo '<br>';

//AGREGAR ITEMS A LA FACTURA 
$sql_facturas ="select * from $tablafacinv   where id_empresa = '".$_SESSION['id_empresa']."'  order by id_factura_inventario";
//echo 'consulta<br>'.$sql_facturas;
echo '	<div align = "center">	';	
		echo '<table border = "1" >';
		echo '<tr>';
		echo '<td>No Factura</td>';
		echo '<td>Fecha</td>';
		echo '</tr>';
		$consulta_facturas_inventario = mysql_query($sql_facturas,$conexion);
		while($facturas = mysql_fetch_assoc($consulta_facturas_inventario))
			{
				echo '<tr>';
				echo '<td><a href="agregar_items_factura_inventario.php?id_factura='.$facturas['id_factura_inventario'].'&no_factura='.$facturas['no_factura'].'">'.$facturas['no_factura'].'</a></td>';echo '<td>'.$facturas['fecha'].'</td>';
				echo '</tr>';
			}
		echo '<table>';
echo '</div>';		


?>
