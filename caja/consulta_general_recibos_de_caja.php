<?php
session_start();

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
<? 
include("../empresa.php"); 
include("../valotablapc.php"); 
?>
<Div id="contenidos">
		<header>
		<h1><? echo $empresa; ?></h1>
	</header>
<h2>CONSULTA GENERAL RECIBOS DE CAJA</h2> 
<?php
include('../colocar_links2.php');
$sql_traer_recibos_caja = "select * from  $tabla23  where id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0'  order by id_recibo desc";
$consulta_recibos = mysql_query($sql_traer_recibos_caja,$conexion);

echo '<table border = "1" width ="95%">';

echo '<tr align= "center" >';
echo '<td>NUMERO</td>';
echo '<td>FECHA</td>';
echo '<td>TIPO RECIBO</td>';
echo '<td>NOMBRE</td>';
echo '<td>VALOR</td>';
echo '<td>MODIFICAR</td>';
echo '<td>ANULAR</td>';
echo '<td>VER RECIBO</td>';
echo '</tr>';



while($recibos = mysql_fetch_assoc($consulta_recibos))
	{
		echo '<tr>';
		echo '<td>'.$recibos['numero_recibo'].'</td>';
		echo '<td>'.$recibos['fecha_recibo'].'</td>';
		if ($recibos['tipo_recibo']=='1')
		    {$nombre_tipo = 'INGRESO';}
		else {	$nombre_tipo = 'SALIDA';}
		echo '<td>'.$nombre_tipo.'</td>';
		echo '<td>'.$recibos['dequienoaquin'].'</td>';
		echo '<td align= "right">'.number_format($recibos['lasumade'], 0, ',', '.').'</td>';
		echo '<td><a href="modificar_recibo.php?numero='.$recibos['numero_recibo'].'">MODIFICAR</a></td>';
		echo '<td><a href="preguntar_anular.php?numero='.$recibos['numero_recibo'].'" >ANULAR</a></td>';
		echo '<td><a href="recibo_imprimir.php?numero='.$recibos['numero_recibo'].'">VER RECIBO</a></td>';
		
		echo '</tr>';
	}

echo '</table>';
?>

	
	
	
	</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   





 


