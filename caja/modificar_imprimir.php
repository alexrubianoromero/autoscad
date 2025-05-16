<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
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
<? include("../empresa.php");
//echo '<br>empresa <br>'.$empresa.'<br>' ; 
$sql_traer_datos_recibo   = "select *  from $tabla23  where  numero_recibo = '".$_REQUEST['numero']."'  and id_empresa = '".$_SESSION['id_empresa']."'  and anulado = '0' ";
$consulta_datos_recibo = mysql_query($sql_traer_datos_recibo,$conexion);
$datos_recibo = mysql_fetch_assoc($consulta_datos_recibo);
/*
echo '<pre>';
print_r($datos_recibo);
echo '</pre>';
*/
 if($datos_recibo['tipo_recibo']== '1')
	 		{
				$recibidopagado =  'RECIBIDO DE';
				$ingresoegreso  = 'INGRESO';	
			}
	  if($datos_recibo['tipo_recibo']== '2'){$recibidopagado= 'PAGADO A';$ingresoegreso  = 'EGRESO';	}
?>
<Div id="contenidos">
<h4>
<table width="95%" border="1">
  <tr>
    <td colspan="2"><div align="center">
      <h3><?php echo $empresa ?></h3>
    </div></td>
    </tr>
  <tr>
    <td>RECIBO <?php echo $ingresoegreso ?> NUMERO </td>
    <td><?php echo $datos_recibo['numero_recibo'] ?></td>
  </tr>
  <tr>
    <td width="45%">FECHA:</td>
    <td width="55%"><?php echo $datos_recibo['fecha_recibo'] ?></td>
  </tr>
  <tr>
    <td>
	 <?php
	
	  echo $recibidopagado;
	 ?>	</td>
    <td><?php echo $datos_recibo['dequienoaquin'] ?></td>
  </tr>
  <tr>
    <td>LA SUMA DE (numeros) </td>
    <td><?php echo $datos_recibo['lasumade'] ?></td>
  </tr>
  <tr>
    <td>Valor en letras </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>POR CONCEPTO DE : </td>
    <td><textarea name="porconceptode" id = "porconceptode" cols="80%" rows="2"><?php echo $datos_recibo['porconceptode'] ?></textarea></td>
  </tr>
  <tr>
    <td>OBSERVACIONES</td>
    <td><textarea name="observaciones" id = "observaciones" cols="80%" rows="2"><?php echo $datos_recibo['observaciones'] ?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>FIRMA</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>

</h4>
</Div>
	
</body>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   
</html>




 


