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

include("../empresa.php"); ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
		<nav>
		<ul class="menu">
	    <li><a href="muestre_caja_diario.php?control=1" class="menu"> CONSULTA CAJA HOY </a></li>
		<li><a href="pregunte_fechas_mecanico.php?control=2" class="menu"> CONSULTA CAJA RANGO FECHAS </a></li>
		<li><a href="../menu_principal.php" class="menu"> MENU PRINCIPAL </a></li>
		
		</ul>
	</nav>



<section>
<article>
<br>

  <div id = "tabla">
  <form action="muestre_caja_diario.php" method="post">
  </form>
  </div>   
</article>
</section>
</Div>
			<?php
echo '<br><br><br><br><br><br>';
include('../colocar_links2.php');
?>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 

<script language="JavaScript" type="text/JavaScript">
            
		
			
			});		////finde la funcion principal de script
			
</script>

  
