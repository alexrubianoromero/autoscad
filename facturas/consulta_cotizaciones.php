<!DOCTYPE html>

<head>
<meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<title>Untitled Document</title>
</head>
<?php
include('../valotablapc.php');
$sql_traer_cotizaciones = "select * from $cotizaciones ";
$consulta_cotizaciones = mysql_query($sql_traer_cotizaciones,$conexion);
$tamano_letra="14px";
?>
<body>
<div id="cotizaciones">
<h3>MODULO COTIZACIONES</h3>
<br><a href="nueva_cotizacion.php">NUEVA COTIZACION</a><br><br>
<table width="200" border="1"  style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>No Cotizacion </td>
    <td>Placa</td>
    <td>Linea</td>
    <td>Fecha </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

