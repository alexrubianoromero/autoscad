<?php
session_start();
include('../valotablapc.php');  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div align = "center"

<br />
<h3><a href="captura_nueva_factura.php">NUEVA FACTURA</a>
 </h3>
<h3>FACTURAS EXISTENTES </h3>

<?php  

$sql_facturas ="select f.no_factura,f.fecha,c.nombre from $tablafacinv f 
inner join $tabla3 c on (c.idcliente = f.proveedor)
 where f.id_empresa = '".$_SESSION['id_empresa']."'  order by f.id_factura_inventario";
//echo '<br>'.$sql_facturas;
echo '<h3>';
echo '	<div align = "center">	';	

echo '<table border = "1" >';
echo '<tr>';
echo '<td>No Factura</td>';
echo '<td>Proveedor </td>';
echo '<td>Fecha</td>';
echo '</tr>';
echo '</h3>';

$consulta_facturas_inventario = mysql_query($sql_facturas,$conexion);
while($facturas = mysql_fetch_assoc($consulta_facturas_inventario))
	{
		echo '<tr>';
		echo '<td><a href="agregar_items_factura_inventario.php?id_factura='.$facturas['id_factura_inventario'].'&no_factura='.$facturas['no_factura'].'">'.$facturas['no_factura'].'</a></td>';
		echo '<td>'.$facturas['nombre'].'</td>';
		echo '<td>'.$facturas['fecha'].'</td>';
		echo '</tr>';
	}
echo '<table>';

echo '</div>';

?>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
