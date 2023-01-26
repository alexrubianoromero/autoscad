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
<?php 

include("../empresa.php");
include('../valotablapc.php');  
include('../funciones.php'); 

$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);
 ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
<section>
<article>
<br>

  <div id = "datos">
 <table width="95%" border="1">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>FECHA INICIAL AAAA-MM-DD </td>
    <td><label>
      <input type="text" name="fechain"  id = "fechain"  >
    </label></td>
  </tr>
  <tr>
    <td>FECHA FINAL AAAA-MM-DD </td>
    <td><label>
      <input type="text" name="fechafin"  id = "fechafin"  >
    </label></td>
  </tr>
  <tr>
    <td>TECNICO</td>
    <td><select name="mecanico" id = "mecanico">
		  <option value = ""   >   </option>
		
		<?php
		while($mecanicos = mysql_fetch_assoc($consulta_operarios))
			{
			     echo  '<option value = "'.$mecanicos['idcliente'].'"   > '.$mecanicos['nombre'].'  </option>';
			}
		?>
		</select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><button type ="button"  id = "consultar_caja" ><h4>CONSULTAR</h4></button></td>
    <td>&nbsp;</td>
  </tr>
</table>

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
            
			$(document).ready(function(){
               
					
					/////////////////////////
					$("#consultar_caja").click(function(){
							var data =  'fechain=' + $("#fechain").val();
							data += '&fechafin=' + $("#fechafin").val();
							data += '&mecanico=' + $("#mecanico").val();
							$.post('muestre_caja_rango_mecanico.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#datos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

