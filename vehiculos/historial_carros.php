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
	<?php
		$sql_consutla_carros = "select car.idcarro,car.placa,car.tipo,car.marca
					from $tabla4  as car 
					
					where   car.id_empresa = '".$_SESSION['id_empresa']."' ";
					
		$consulta_carros = mysql_query($sql_consutla_carros,$conexion)
	//cli.nombre,cli.telefono,car.color
	//inner join $tabla3  as cli on (cli.idcliente  = car.propietario) 
	?>
	<br>
	<br>
	<table width="95%" border="1">
  <tr>
    <td><div align="center">PLACA</div></td>
    <td><div align="center">TIPO</div></td>
    <td><div align="center">MARCA</div></td>
    <td><div align="center">COLOR</div></td>
    <td><div align="center">NOMBRE</div></td>
    <td><div align="center">TELEFONO</div></td>
  </tr>


<?php
while($row = mysql_fetch_array($consulta_carros))
	{
		echo '<tr>';
		echo '<td>'.$row[1].'</td>';
		echo '<td>'.$row[2].'</td>';
		echo '<td>'.$row[3].'</td>';
		echo '<td>'.$row[6].'</td>';
		echo '<td>'.$row[4].'</td>';
		echo '<td>'.$row[5].'</td>';
		
		echo '</tr>';
		
	}
echo '</table>';
include('../colocar_links2.php');
?>


</Div>
	
</body>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   
</html>




