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
	<!--
    <li><a href=capturacarro.php class="menu" >INGRESO </a></li>
    <li><a href=consulta_carro.php class="menu">CONSULTA</a></li>
	 <li><a href=modificarro.php class="menu">MODIFICACION</a></li>
	 -->
	  <li><a href=consulta_carros_general.php class="menu">INGRESO CONSULTA MODIF </a></li>
		<li><a href=../menu_principal.php class="menu" >MENU PRINCIPAL</a></li>
	</ul>
</nav>
</Div>
	
</body>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   
</html>




