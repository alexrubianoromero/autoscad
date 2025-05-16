<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Codigos</title>
 <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php
include('../colocar_links2.php');
include('../valotablapc.php');  
include('../funciones.php'); 

$sql_muestre_codigos = "select codigo_producto as CODIGO_PRODUCTO, 
descripcion as DESCRIPCION , valor_unit as VALOR_UNITARIO , 
cantidad as EXISTENCIAS, id_codigo,valorventa,producto_minimo   
from $tabla12  
where id_empresa = '".$_SESSION['id_empresa']."'
order by id_codigo desc
";
$consulta_codigos = mysql_query($sql_muestre_codigos,$conexion);
$filas = mysql_num_rows($consulta_codigos);
//echo '<br>filas'.$filas;   
if($filas == 0 )
		{
			echo "NO EXISTEN CODIGOS EN LAS BASES DE DATOS ";
		}
	else
	 	{
			
			//$codigos = get_table_assoc($consulta_codigos);
			
			//draw_table($codigos);
	 		echo '<table border = "1">';
	 		 echo '<tr>';
	 		 echo '<td><h3>CODIGO</td><td><h3>DESCRIPCION</h3></td><td><h3>VR.COMPRA</h3></td>';
			//  echo '<td><h3>VALOR VENTA(Sin Iva)</h3></td>';
			//  echo '<td><h3>UTILIDAD</h3></td>'; 
			 echo '<td><h3>EXISTENCIAS </h3>'; 
			 echo '<td><h3>PROD.MIN </h3></td>'; 
			 echo '<td><h3>Eliminar </h3></td><td><h3>COMPRAS</h3></td><td><h3>MODIFICAR</h3></td><td><h3>ACCION</h3></td>';
	 		 echo '</tr>';
			  while($codigos = mysql_fetch_array ($consulta_codigos))
			  		{
			  			$utilidad =$codigos[5]- $codigos[2] ;
						echo '<tr>';
			  				echo '<td><h3>'.$codigos[0].'</h3></td><td><h3>'.$codigos[1].'</h3></td><td><h3>'.$codigos[2].'</h3></td>';
							// echo '<td><h3>'.$codigos[5].'</h3></td>';
							// echo '<td><h3>'.$utilidad.'</h3></td>';							
							echo '<td><h3>'.$codigos[3].'</h3></td>';
							echo '<td><h3><a href="preguntarProductoMinimo.php?id_codigo='.$codigos[4].'">'.$codigos[6].'</a></h3></td>';

			  				echo '<td><h3><a href = "preguntar_eliminar_codigo.php?id_codigo='.$codigos[4].'"     >ELIMINAR</a></h3></td>';
			  				echo '<td><h3><a href = "adicion_existencias_codigo.php?id_codigo='.$codigos[4].'"     >ADICIONAR EXISTENCIAS</a></h3></td>';
							echo '<td><h3><a href = "modificar_codigo.php?id_codigo='.$codigos[4].'"     >MODIFICAR CODIGO</a></h3></td>';
							echo '<td><h3><a href = "reporte_movimientos_codigo.php?id_codigo='.$codigos[4].'"     >MOVIMIENTOS</a></h3></td>';
			  			echo '</tr>';

			  		}
			  echo '</table>';		
		}  


?>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
