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
<? include("../empresa.php"); ?>
<Div id="contenidos">
		<header>
		<h1><? echo $empresa; ?></h1>
<h2><? echo $slogan; ?><h2>
	</header>
<br>
<? include("../valotablapc.php"); 
$sql_traer_saldo_actual = "select saldocajamenor from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_saldo_actual = mysql_query($sql_traer_saldo_actual,$conexion);
$saldo_actual = mysql_fetch_assoc($consulta_saldo_actual);


$traer_movimientos_por_dia = "select * from $tabla22  where id_empresa = '".$_SESSION['id_empresa']."' order by id_dia_caja desc ";
$consulta_saldos_dia = mysql_query($traer_movimientos_por_dia,$conexion);

echo '<br>';
echo  '<h2>SALDO DE CAJA  $'.number_format($saldo_actual['saldocajamenor'], 0, ',', '.').'</h2>';
echo '<br>';


echo '<table border = "1"   width = "95%" >';
echo '<tr align="center">';
echo '<td  align="center"><h4>Fecha</h4></td>';
echo '<td  align="center"><h4>Saldo Inicial</h4> </td>';
echo '<td  align="center"><h4>Saldo Final</h4></td>';
echo '<td  align="center"><h4>Estado</h4></td>';

echo '<tr>';


while($movimientos = mysql_fetch_assoc($consulta_saldos_dia))
	{
	   echo '<tr>';
		echo '<td>'.$movimientos['fecha'].'</td>';
		echo '<td align="right">'.number_format($movimientos['saldo_inicial'], 0, ',', '.').'</td>';
		echo '<td  align="right">'.number_format($movimientos['saldo_final'], 0, ',', '.').'</td>';
		if($movimientos['cerrado'] == '0')
		{  $estado = 'Abierto'; }
		else 
		{ $estado = 'Cerrado';}
		echo '<td  align="center"> '.$estado.'</td>';
		echo '<tr>';
	}
echo '</table>';	

include('../colocar_links2.php');



?>


</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   





 


