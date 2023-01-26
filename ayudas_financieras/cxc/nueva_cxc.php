<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Menu cxc</title>
	<link rel="stylesheet" href="../../css/normalize.css">
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<? include("../../empresa.php"); ?>
<Div id="contenidos">
		<header>
			<h1><? echo $empresa; ?></h1>
			<h2><? echo $slogan; ?><h2>
		</header>
		<nav>
		REGISTRO NUEVA CUENTA POR COBRAR
	</nav>
	<br>
	<table width="461" border="1">
  <tr>
    <td width="250">FECHA</td>
    <td width="195">&nbsp;</td>
  </tr>
  <tr>
    <td>VALOR </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>NOMBRE/PLACA </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>OBSERVACIONES </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <div align="center">
        <input type="submit" name="Submit" value="Grabar">
        </div>
    </label></td>
    </tr>
</table>

	<br>

<?php  
include('../../colocar_links2.php');
?>	
</Div>
	
</body>
</html>
<script src="../../js/modernizr.js"></script>   
<script src="../../js/prefixfree.min.js"></script>
<script src="../../js/jquery-2.1.1.js"></script>   
