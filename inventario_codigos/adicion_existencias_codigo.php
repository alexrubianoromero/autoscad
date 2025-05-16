<?php
session_start();
/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
*/

include("../valotablapc.php");
include("../funciones.php");
$sql_traer_datos_codigo = "select * from $tabla12 where id_codigo = '".$_GET['id_codigo']."' ";
$consulta_codigo = mysql_query($sql_traer_datos_codigo,$conexion); 
$datos_codigo = mysql_fetch_assoc($consulta_codigo);
$fechapan =  time();
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
			<h1><? echo $empresa; ?> </h1>
			<h2><? echo $slogan; ?>  <h2>
		</header>
	<section>
	<article>
      
	  <table width="767" border="1">
  <tr>
    <td width="107"><h3>CODIGO</h3></td>
    <td width="247"><h3>DESCRIPCION</h3></td>
    <td width="181"><h3>VALOR _UNIT</h3> </td>
    <td width="204"><h3>CANTIDAD ACTUAL </h3></td>
  </tr>
  <tr>
    <td><h3><?php echo $datos_codigo['codigo_producto'] ?></h3></td>
    <td><h3><?php echo $datos_codigo['descripcion'] ?></h3></td>
    <td><h3><?php echo $datos_codigo['valor_unit'] ?></h3></td>
    <td><h3><?php echo $datos_codigo['cantidad'] ?></h3></td>
  </tr>
</table>
<br>

<div id = "datos">
<table width="603" border="1">
  <tr>
    <td width="179">FECHA</td>
    <td width="408"><input size=10 name=fecha id = "fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?>></td>
  </tr>
  <tr>
    <td>FACTURA COMPRA </td>
    <td><label>
      <input type="text" name="facturacompra"  id = "facturacompra"  >
    </label></td>
  </tr>
  <tr>
    <td>CANTIDAD A CARGAR </td>
    <td><input type="text" name="cantidad"  id = "cantidad"  ></td>
  </tr>
  <tr>
    <td>OBSERVACIONES </td>
    <td><label>
      <textarea name="observaciones" id = "observaciones" cols="60" rows="4"></textarea>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="hidden" name="id_codigo"  id = "id_codigo" value = "<?php   echo $_GET['id_codigo']  ?>  "  >
	<input type="hidden" name="cantidad_actual"  id = "cantidad_actual" value = "<?php   echo $datos_codigo['cantidad']  ?>  "  ></td>
  </tr>
  <tr>
    <td colspan="2"><label><button type ="button"  id = "actualizar_codigo" >
      <h3>ACTUALIZAR_INVENTARIO_CODIGO</h3>
    </button></label></td>
    </tr>
</table>
</div>
<BR>

<?php 
include('../colocar_links2.php');
?>
	<p>&nbsp;</p>
	</article>
	</section>
	
</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
					
					/////////////////////////
					$("#actualizar_codigo").click(function(){
							var data =  'id_codigo=' + $("#id_codigo").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&facturacompra=' + $("#facturacompra").val();
							data += '&cantidad=' + $("#cantidad").val();
							data += '&observaciones=' + $("#observaciones").val();
							data += '&cantidad_actual=' + $("#cantidad_actual").val();
							$.post('actualizar_codigo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#datos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

  