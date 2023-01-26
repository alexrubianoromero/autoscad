<!DOCTYPE html>
<html >
<!-- <html lang="es"  class"no-js">
-->

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
<? 
include('../valotablapc.php');
$sql_carros ="select idcarro,placa from $tabla4";
$consulta_placas = mysql_query($sql_carros,$conexion);
?>
<Div id="contenidos">
		<header>
			<h2>POR FAVOR ESCOJA LA PLACA .. </h2>
		</header>

<form action="muestre_facturas_placa.php" method="post">
	<table width="700" border="1">
  <tr>
    <td width="310"><h2>PLACA</h2></td>
    <td width="144"><h2>
      <input type="placa"  id = "placa123" name="placa123">
    </h2></td>
    <td width="124"><h2>
      <label>      </label>
    </h2></td>
  </tr>
  <tr>
    <td colspan="3"> <div align="center">
   <h2><input name="Enviar" type="submit" value = "CONSULTAR"></h2>
    </div>   </td>
    </tr>
</table>
</form>
	
</Div>

<div id = "carros123">
</div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
            		  
					  $("#crear_orden").click(function(){
								var placa123 =$("#placa123").val();
								$(window).attr('location', 'muestre_facturas_placa.php?placa123='+placa123);
									//alert(data);
								});	
								
					
		 });			
          	
</script>