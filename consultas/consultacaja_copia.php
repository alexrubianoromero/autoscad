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
<? 

include("../empresa.php"); ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
		<?php
include('../colocar_links2.php');

?>


<section>
<article>
<br>
  <div id = "tabla">
  <form action="muestre_caja_diario.php" method="post">
  <table width="30%" border="1">
  <tr>
    <td width="39%"><label  for="radiobutton" ><h2>HOY</h2></label> </td>
    <td width="61%">
      <input name="radiobutton" id = "radiobutton" type="radio" value="1"></td>
  </tr>
  <tr>
    <td><label  for="radiobutton" ><h2>RANGO </h2></label></td>
    <td><input name="radiobutton"  id= "radiobutton" type="radio" value="2"></td>
  </tr>
  <tr>
    <td>Fecha Inicial  AAAA-MM-DD</td>
    <td>
 <input type="text" name = "fechain" id="fechain"  />
  </td>
  </tr>
  <tr>
    <td>Fecha Final  AAAA-MM-DD</td>
    <td>
         <input type="text" name = "fechafin" id="fechafin"  />
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td><input type ="submit" value =  "enviar">   </td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
  </div>   
</article>
</section>
</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 

<script language="JavaScript" type="text/JavaScript">
            
		
			
			});		////finde la funcion principal de script
			
</script>

  
