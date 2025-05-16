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
	<nav>
	<ul class="menu">

		   <li><a href=./saldo_inicial_caja.php    class="menu">SALDO INICIAL CAJA  </a></li>
		   <li><a href=./cerrar_caja.php    class="menu">CIERE DE CAJA  </a>DIARIO</li>
		   <li><a href=./crear_recibo_de_caja.php    class="menu">CREAR RECIBO DE CAJA </a></li>
		   <li><a href=./consulta_general_recibos_de_caja.php    class="menu">CON / MOD / ANU DE RECIBOS </a></li>
		   <li><a href=./consultar_saldos_por_dia.php    class="menu">CONSULTAR SALDOS </a></li>
		   <li><a href=./consultar_movimientos.php    class="menu">CONSULTAR MOVIMIENTOS </a></li>
		  	<li><a href="../menu_principal.php" class="menu"> MENU PRINCIPAL </a></li>


	</ul>
</nav>
</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   





 


