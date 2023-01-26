<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ordenes</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<? 
include('../colocar_links2.php');
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');
$sql_muestre_ordenes = "select f.numero_factura,f.fecha,f.placa,f.id_factura,e.prefijo_factura,f.tipo_factura,f.anulado,f.resolucion,f.forma_pago 
from $tabla11 as f
left  join $tabla10 as e on (e.id_empresa = f.id_empresa)
where f.id_empresa = '".$_SESSION['id_empresa']."'
order by id_factura desc
";
//echo '<br>'.$sql_muestre_ordenes;
$consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);

?>
<Div id="contenidos">
		<header>
			<h2>CONSULTA FACTURAS </h2>
		</header>

	
<?php
echo '<table border= "1">';
	echo '<td><h3>No FACTURA<h3></td><td><h3>PAGO/DEBE<h3></td><td><h3>TIPO FACTURA<h3></td><td><h3>ANULADO<h3></td><td><h3>Fecha</h3></td><td><h3>Placa/Identidad</h3></td><td><h3>modificar</h3></td>'; 
		while($ordenes = mysql_fetch_array($consulta_ordenes))
			{ 
				$identificacion = $ordenes['2'];
				echo '<tr>';
				if($ordenes['5']==2) // osea si es factura de venta 
							{ 	$sql_traer_nombre = "select nombre from $tabla3 where idcliente = '".$ordenes['2']."' " ;
								$consulta_nombre = 	mysql_query($sql_traer_nombre,$conexion);
								$consulta_nombre = mysql_fetch_assoc($consulta_nombre);
								$nombre = $consulta_nombre['nombre'];
								$identificacion = $nombre;
						 	 }
				if($ordenes['resolucion']==1) // osea si es factura con iva 
						{
							$documento = 'FACTURA';
						}
				if($ordenes['resolucion']==0)	
						{
							$documento = 'COTIZACION';
						}
					
				echo '<td><h3>'.$ordenes['0'].'</h3></td>';
				if($ordenes['8']>0){$pagodebe = 'CONTADO';}
				else {$pagodebe = 'CREDITO';   }
				
				echo '<td><h3>'.$pagodebe.'</h3></td>';
				echo '<td><h3>'.$documento.'</h3></td>';
				echo '<td><h3>'.$ordenes['6'].'</h3></td>';
				echo'<td><h3>'.$ordenes['1'].'</h3></td>';
				echo '<td><h3>'.$identificacion.'</h3></td>';
			    

				echo  '<td><h3>';
				echo '<a href="factura_imprimir.php?id_factura='.$ordenes['3'].'"  target = "_blank" >Vista Impresion</a>';
				echo '</h3></td>'; 
				echo '<tr>';
			}
echo '<table border= "1">';

?>
	</Div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
