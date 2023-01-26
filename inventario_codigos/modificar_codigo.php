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
<? include("../empresa.php");
include("../valotablapc.php");
/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
*/

$sql_codigos = "select * from $tabla12 where id_codigo = '".$_GET['id_codigo']."' ";
$consulta_codigos = mysql_query($sql_codigos,$conexion);
$codigos = mysql_fetch_assoc($consulta_codigos);
/*
echo '<pre>';
print_r($codigos);
echo '</pre>';
*/
 ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
		<div id = "modificacion">
	<table width="532" border="1">
  <tr>
    <td width="308"><h3>CODIGO</h3></td>
    <td width="208"><label>
     <h3> <input type="text" name="codigo"  id="codigo"  value = "<?php echo $codigos['codigo_producto']  ?>" >
	 <h3>
    </label></td>
  </tr>
  <tr>
    <td><h3>DESCRIPCION</h3></td>
    <td><h3><input type="text" name="descripcion"  id="descripcion"  value = "<?php echo $codigos['descripcion']  ?>"></h3></td>
  </tr><tr>
    <td><h3>CANTIDAD</h3></td>
    <td><h3><input type="text" name="cantidad"  id="cantidad"  value = "<?php echo $codigos['cantidad']  ?>"></h3></td>
  </tr>
  <tr>
    <td><h3>PRECIO DE COMPRA </h3></td>
    <td><h3><input type="text" name="valor_unit"  id="valor_unit"  value = "<?php echo $codigos['valor_unit']  ?>"></h3></td>
  </tr>
    <tr>
    <td><h3>PRECIO DE VENTA (Sin Iva)</h3></td>
    <td><h3><input type="text" name="valorventa"  id="valorventa"  value = "<?php echo $codigos['valorventa']  ?>"></h3></td>
  </tr>
  <!--
	  <tr>
		<td><h3>CANTIDAD INICIAL	</h3></td>
		<td><h3><input type="text" name="cantidad"  id="cantidad" value = "<?php echo $codigos['cantidad']  ?>" ></h3></td>
	  </tr>
	-->   
  <tr>
    <td><h3>IVA	</h3></td>
    <td><h3><input type="text" name="iva"  id="iva"  value = "<?php echo $codigos['iva']  ?>"></h3></td>
  </tr>
   <tr>
     <td><h3><label for = "nomina">CODIGO DE NOMINA</label></h3></td>
     <td><?  if ($codigos['nomina']=="1"){echo '<input name = "nomina" id="nomina"  type="checkbox" checked  value = "1" >';} 
		    else {echo '<input  name = "nomina" id="nomina"  type="checkbox" unchecked   value = "1"  >';}  ?><input type="hidden" name="id_codigo"  id="id_codigo" value = "<?php echo $codigos['id_codigo']  ?>" ></td>
   </tr>
  <tr>
    <td colspan="2"><button type ="button"  id = "actualizar_codigo" >
    <h3>ACTUALIZAR_CODIGO</h3>
    </button></td>
    </tr>
</table>
</div>
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
							var data =  'codigo=' + $("#codigo").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&valor_unit=' + $("#valor_unit").val();
							data += '&cantidad=' + $("#cantidad").val();
							data += '&valorventa=' + $("#valorventa").val();
							data += '&iva=' + $("#iva").val();
							data += '&id_codigo=' + $("#id_codigo").val();
							data += '&nomina=' + $("#nomina:checked").val();
							$.post('actaulizar_datos_codigos.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#modificacion").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

   
