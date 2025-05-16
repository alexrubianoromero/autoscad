<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Menu cxc</title>
	<link rel="stylesheet" href="../../css/normalize.css">
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<? include("../../empresa.php"); ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
		<nav>
		RESUMEN CUENTAS POR COBRAR
	</nav>
	<br>
	<table width="815" border="1">
  <tr>
    <td width="117">FECHA</td>
    <td width="160">VALOR CUENTA </td>
    <td width="183">ABONOS</td>
    <td width="114">SALDO</td>
    <td width="207">DETALLE</td>
  </tr>
  <tr>
    <td>15/11/2015</td>
    <td>2000000</td>
    <td>300000</td>
    <td>1700000</td>
    <td><a href="recibo_cxc.php">Crear Recibo Abono</a></td>
  </tr>
  <tr>
    <td>20/12/2015</td>
    <td>1500000</td>
    <td>200000</td>
    <td>700000</td>
    <td><a href="recibo_cxc.php">Crear Recibo Abono</a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>Total CxC </td>
    <td>2400000</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>

<?php  
include('../../colocar_links2.php');
?>	
</Div>
	
</body>
</html>
<script src="../../js/modernizr.js"></script>   
<script src="../../js/prefixfree.min.js"></script>
<script src="../../js/jquery-2.1.1.js"></script>   
