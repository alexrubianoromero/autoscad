<?php
session_start();
// include('../colocar_links2.php');
include('../valotablapc.php');  
include('../funciones.php'); 
// $sql_muestre_codigos = "select codigo_producto as CODIGO_PRODUCTO, 
// descripcion as DESCRIPCION , valor_unit as VALOR_UNITARIO , 
// cantidad as EXISTENCIAS, id_codigo,valorventa,producto_minimo   
// from $tabla12  
// where 1=1 
// order by id_codigo desc
// ";
// $consulta_codigos = mysql_query($sql_muestre_codigos,$conexion);
// $filas = mysql_num_rows($consulta_codigos);
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
<br>
<div class="row">
	<div  class="col-lg-3" style="font-size:22px;">
		<a role="button" href="../inventario_codigos/traer_info_codigos_excel.php?excel=1" >Generar Informe Productos Excel</a>

	</div>
	<div align="right">
		*Cuando la fila salga en color amarillo siginifica que queda menos existencias que el stock minimo
	</div>
</div>
<div id="div_mostrar_codigos_inventario">
	   <?php  include('../inventario_codigos/traer_info_codigos.php');  ?>
</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
