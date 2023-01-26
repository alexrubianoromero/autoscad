<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ventas Hoy </title>
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
	
</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
