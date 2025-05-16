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
$fechapan =  time();
$sql_numero_recibo = "select contarecicaja  from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
?>
<Div id="contenidos">
		<header>
		<h1><? echo $empresa; ?></h1>
<h2><? echo $slogan; ?><h2>
	</header>
    <input type="text" name="lasumade"  id = "lasumade">
    <section>
<h4>
<table width="95%" border="1">
  <tr>
    <td width="22%">FECHA:</td>
    <td width="78%"><input size=10 name=fecha id = "fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?>></td>
  </tr>
  <tr>
    <td>PAGADO A: </td>
    <td><label>
      <input type="text" name="pagadoa"  id = "pagadoa">
    </label></td>
  </tr>
  <tr>
    <td>LA SUMA DE </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>POR CONCEPTO DE : </td>
    <td><textarea name="porconceptode" id = "porconceptode" cols="80%" rows="2"></textarea></td>
  </tr>
  <tr>
    <td>OBSERVACIONES</td>
    <td><textarea name="observaciones" id = "observaciones" cols="80%" rows="2"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><button type ="button"  id = "grabar_salida" >
			      <h4>GRABAR_SALIDA DE CAJA</h4>
	      </button></td>
    </tr>
</table>
</h4>
</section>

</Div>
	
</body>
</html>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script> 
<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
					/////////////////////////
					$("#grabar_salida").click(function(){
							var data =  'fecha=' + $("#fecha").val();
							data += '&pagadoa=' + $("#pagadoa").val();
							data += '&porconceptode=' + $("#porconceptode").val();
							data += '&lasumade=' + $("#lasumade").val();
							data += '&observaciones=' + $("#observaciones").val();
							
							$.post('grabar_salida_caja.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#saldo").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
			});		////finde la funcion principal de script		
</script>
  





 


