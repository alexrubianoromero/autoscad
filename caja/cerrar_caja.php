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
		<h2>CERRAR_CAJA </h2>
<?php
$traer_registros_sin_cerrar = "select * from $tabla22 where id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0' and cerrado = '0'  ";
$consulta_abiertos = mysql_query($traer_registros_sin_cerrar,$conexion);
echo '<table border = "1" align = "center">';
echo '<tr><td><h3>DIAS NO CERRADOS</h3></td></tr>';
while($abiertos = mysql_fetch_assoc($consulta_abiertos))
	{
	  	echo '<tr>';
		echo '<td><h2><a href="mostrar_dia_para_cerrar.php?id_dia_caja='.$abiertos['id_dia_caja'].'">'.$abiertos['fecha'].'</a></h2></td>';
		echo '</tr>';
	}
echo '</table>';	
	
?>	
	

</Div>
	
</body>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   
</html>




 


