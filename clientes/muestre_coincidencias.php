<?php
session_start();
include('../valotablapc.php');
/*
				echo '<pre>';
				print_r($_POST);
				echo '</pre>';
				*/
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

<Div id="contenidos">
		
	<?php
	$sql_clientes = "select * from $tabla3    where  nombre like '%".$_POST['nombre']."%'  and id_empresa = '".$_SESSION['id_empresa']."'  "; 
	//echo '<br>'.$sql_clientes ;
	$consulta_nombres = mysql_query($sql_clientes,$conexion);
	echo '<br>';

	echo '<table border = "1">'; 
	echo '<tr><td>NOMBRE</td></tr>';
	while($clientes = mysql_fetch_assoc($consulta_nombres))
		{
		   	echo '<tr>';
			echo '<td><a href ="muestre_datos_cliente.php?idcliente='.$clientes['idcliente'].'"  ><h6>'.$clientes['nombre'].'</h6></a></td>';
			echo '</tr>';
		}
	echo '</table>';
	?>
	
	
	
	
</Div>
	
</body>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
</html>




 



