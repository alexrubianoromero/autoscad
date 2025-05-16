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
		<h2><? echo $slogan; ?> <h2>
	</header>
	<table width="413" border="1">
  <tr>
    <td width="170">&nbsp;</td>
    <td width="227">&nbsp;</td>
  </tr>
  <tr>
    <td>Digite la placa </td>
    <td><input type="text" id = "placa" name="placa"></td>
  </tr>
  <tr>
    <td> <button type ="button"  id = "muestre_datos_carro" ><h3>SIGUIENTE</h3></button></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</Div>
<div id = "muestre">
</div>	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
			  
						$("#muestre_datos_carro").click(function(){
							var data =  'placa=' + $("#placa").val();
							$.post('muestre_datos_carro.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
		
					
		 });	//fin de la funcion principal 		
          	
</script>




