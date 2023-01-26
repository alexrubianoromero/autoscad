<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? include("../empresa.php"); ?>
<Div id="contenidos">
		<header>
			<h2><? echo $empresa; ?></h2>
			<h3><? echo $slogan; ?><h3>
		</header>
	
</Div>
<?php
$sql_movimientos = "select fecha_movimiento , cantidad,observaciones,facturacompra,id_factura_venta,id_codigo_producto,tipo_movimiento  from $tabla19 
where id_codigo_producto = '".$_GET['id_codigo']."' and id_empresa = '".$_SESSION['id_empresa']."'  and anulado < 1  order by fecha_movimiento ";


echo '<br><br>consulta<br>'.$sql_movimientos;

$consulta_movimientos = mysql_query($sql_movimientos,$conexion);
$filas_movimientos = mysql_num_rows($consulta_movimientos);
//$datos= get_table_assoc($consulta_movimientos);

//draw_table($datos);
include('../colocar_links2.php');

echo '<table border = "1"  width="95%" >';
echo '<tr>';
echo '<td>CODIGO PRODUCTO</td><td>DESCRIPCION</td><td>FECHA MOVIMIENTO</td><td>CANTIDAD</td><td>OBSERVACIONES</td><td>FACTURA COMPRA</td><td>REMISION </td>';
echo '</tr>';
if ($filas_movimientos  > 0 )
{ 
 while($mov = mysql_fetch_assoc($consulta_movimientos))
 	{
	   $sql_traer_numero_factura ="select numero_factura,id_orden from $tabla11 where id_factura = '".$mov['id_factura_venta']."' ";
	   $consulta_factura_venta = mysql_query($sql_traer_numero_factura,$conexion);
	   $numero_factura = mysql_fetch_assoc($consulta_factura_venta);
	   $id_orden = $numero_factura['id_orden'];
	   $numero_factura = $numero_factura['numero_factura'];
	   $sql_traer_codigo_producto = "select codigo_producto,descripcion from $tabla12 where id_codigo = '".$mov['id_codigo_producto']."' ";
	   $consulta_codigo = mysql_query($sql_traer_codigo_producto,$conexion);
	   $codigo_producto = mysql_fetch_assoc($consulta_codigo);
	   
	
	   $descripcion = $codigo_producto['descripcion'];
	   $codigo_producto = $codigo_producto['codigo_producto'];
	  
	//echo $descripcion;
	 echo '<tr>';
	 echo '<td>'.$codigo_producto.'</td>';
	 echo '<td>'.$descripcion.'</td>';
	 echo '<td>'.$mov['fecha_movimiento'].'</td>';
	 echo '<td>'.$mov['cantidad'].'</td>';
	 echo '<td>'.$mov['observaciones'].'</td>';
	   if( $mov['tipo_movimiento']==5){   $factura_compra= traer_factura_compra($mov['facturacompra'],$conexion,$tablafacinv); }
	  else { $factura_compra =  $mov['facturacompra'];}	
		echo '<td>'.$factura_compra.'</td>';
	 
	 
	  echo '<td>'.$numero_factura.'</td>';
	 echo '</tr>';
	 
	 
	}// fin de while 
}// fin de if filas_movimientos 
echo '<table>';

function traer_factura_compra($id_factura,$conexion,$tabla){
    $sql_traer_factuar_compra = "select  no_factura from  $tabla  where id_factura_inventario = '".$id_factura."'  ";
	$consulta_factura = mysql_query($sql_traer_factuar_compra,$conexion);
	$arreglo_factura = mysql_fetch_assoc($consulta_factura);
	return   $arreglo_factura['no_factura'];

}//fin de funcion de traer factura de compra 
?>	
	
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
