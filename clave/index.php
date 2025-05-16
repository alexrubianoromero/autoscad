<?php
session_start();
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
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
<br>
<h2>CAMBIO DE CLAVE</h2>
</br>
<div id = "clave">
<table width="95%" border="1">
  <tr>
    <td>Clave actual </td>
    <td><label>
      <input type="password" name="anterior" id = "anterior">
    </label></td>
  </tr>
  <tr>
    <td>Nueva Clave </td>
    <td><input type="password" name="nueva1" id = "nueva1"></td>
  </tr>
  <tr>
    <td>Confirmar Nueva Clave </td>
    <td><input type="password" name="nueva2" id = "nueva2"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><button type ="button"  id = "cambiar_clave" ><h4 align="center">Cambiar Clave</h4>
    </button></td>
    </tr>
</table>
<?php include('../colocar_links2.php');  ?>
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
					$("#cambiar_clave").click(function(){
							var data =  'anterior=' + $("#anterior").val();
							data += '&nueva1=' + $("#nueva1").val();
							data += '&nueva2=' + $("#nueva2").val();
							$.post('cambiar_clave.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#clave").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
				
			
			
});		////finde la funcion principal de script			
</script>




