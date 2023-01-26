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

		   <li><a href=./crear_saldo_inicial_caja.php    class="menu">CREAR SALDO INICIAL  </a></li>
	
		  	<li><a href="../menu_principal.php" class="menu"> MENU PRINCIPAL </a></li>


	</ul>
</nav>
</Div>
	
</body>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   
</html>




 


