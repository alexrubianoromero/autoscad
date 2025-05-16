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

		$sql_consutla_carros = "select car.idcarro,car.placa,car.tipo,car.marca,car.color,car.propietario,car.modelo  

					from $tabla4  as car 

					 

					where   car.id_empresa = '".$_SESSION['id_empresa']."' ";

					

		$consulta_carros = mysql_query($sql_consutla_carros,$conexion)

		//cli.nombre,cli.telefono

		//inner join $tabla3  as cli on (cli.idcliente  = car.propietario)

	?>



	<?php include('../colocar_links2.php'); 

	?>

	<h2><a href = "captura_datos_nuevo_carro_2.php" >NUEVO REGISTRO</a></h2>

	<table width="95%" border="1">

  <tr>

    <td><div align="center">PLACA</div></td>

    <td><div align="center">TIPO</div></td>

    <td><div align="center">MARCA</div></td>

    <td><div align="center">COLOR</div></td>
     <td><div align="center">MODELO</div></td>

    <td><div align="center">NOMBRE</div></td>

    <td><div align="center">TELEFONO</div></td>

  </tr>





<?php

while($row = mysql_fetch_assoc($consulta_carros))

	{

		echo '<tr>';

		echo '<td><a href = "muestre_datos_carro.php?placa='.$row['placa'].'&idcarro='.$row['idcarro'].'"> '.$row['placa'].'</a></td>';
		echo '<td>'.$row['tipo'].'</td>';
		echo '<td>'.$row['marca'].'</td>';
		echo '<td>'.$row['color'].'</td>';
		echo '<td>'.$row['modelo'].'</td>';

		$sql_propietario = "select nombre,telefono from  $tabla3  where idcliente= '".$row['propietario']."' ";

		$consulta_propietario = mysql_query($sql_propietario,$conexion);

		$filas_propietario = mysql_num_rows($consulta_propietario);

		if ($filas_propietario > 0)

				{

					$propietario = mysql_fetch_assoc($consulta_propietario);

					$nombre = $propietario['nombre'];

					$telefono = $propietario['telefono'];

				}	

			else

				{

					$nombre = 'NO TIENE ASIGNADO';

					$telefono = 'NO TIENE ASIGNADO';

				}	

					echo '<td>'.$nombre.'</td>';

					echo '<td>'.$telefono.'</td>';

				

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









