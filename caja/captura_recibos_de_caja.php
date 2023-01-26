<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

//$tipo_recibo = '0';
if($_POST['tipo_recibo']== '1'){ $tipo_recibo = 'INGRESO DINERO';} 
if($_POST['tipo_recibo']== '2'){ $tipo_recibo = 'EGRESO (SALIDA DE DINERO)';} 
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
$sql_numero_recibo = "select contarecicaja,saldocajamenor  from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_numero_recibo = mysql_query($sql_numero_recibo,$conexion);
$numero_actual = mysql_fetch_assoc($consulta_numero_recibo);
/*
echo '<pre>';
print_r($numero_actual);
echo '</pre>';
*/
$siguiente_numero = $numero_actual['contarecicaja'] + 1;

?>
<Div id="contenidos2">
		<header>
		<h1><? echo $empresa; ?></h1>
<h2><? echo $slogan; ?><h2>
	</header>
    
    <section>
<?php
if ($tipo_recibo == ''  )
{
   echo 'NO SE DEFINIO UN TIPO DE RECIBO VALIDO ';
}
else
{//	
echo '<H2>RECIBO DE '.$tipo_recibo.'</H2>';
?>

<table width="95%" border="1">
  <tr>
    <td>Saldo caja_actual </td>
    <td> <input name="saldo_actual" type="text"  id = "saldo_actual" value = "<?php  echo $numero_actual['saldocajamenor'] ?>" onFocus="blur()" ></td>
  </tr>
  <tr>
    <td>RECIBO NUMERO </td>
    <td> <input name="numero_recibo" type="text"  id = "numero_recibo" value = "<?php echo ' '.$siguiente_numero   ?>"   onFocus="blur()">
	  <input name="tipo_recibo" type="hidden"  id = "tipo_recibo" value = "<?php  echo $_POST['tipo_recibo'];?>"></td>
  </tr>
  <tr>
    <td width="22%">FECHA:</td>
    <td width="78%"><input size=10 name=fecha id = "fecha"  value=" <? echo date ( "Y/m/j" , $fechapan );?>"  onFocus="blur()" ></td>
  </tr>
  <tr>
    <td>
	 <?php
	 if($_POST['tipo_recibo']== '1'){$recibidopagado =  'RECIBIDO DE';}
	  if($_POST['tipo_recibo']== '2'){$recibidopagado= 'PAGADO A';}
	  echo $recibidopagado;
	 ?>	</td>
    <td><label>
      <input name="dequienoaquin" type="text"  id = "dequienoaquin" size="60%">
    </label></td>
  </tr>
  <tr>
    <td>LA SUMA DE (numeros sin puntos)</td>
    <td><input type="text" name="lasumade"  id = "lasumade" size="60%"></td>
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
    <td colspan="2"><button type ="button"  id = "grabar_recibo" >
			      <h4>GRABAR_RECIBO</h4>
	      </button></td>
    </tr>
</table>
<?php 
}// fin de si es un tipo de recibo valido

include('../colocar_links2.php');
?>
</section>

</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
					/////////////////////////
					$("#grabar_recibo").click(function(){
							var data =  'fecha=' + $("#fecha").val();
							data += '&dequienoaquin=' + $("#dequienoaquin").val();
							data += '&porconceptode=' + $("#porconceptode").val();
							data += '&lasumade=' + $("#lasumade").val();
							data += '&observaciones=' + $("#observaciones").val();
							data += '&tipo_recibo=' + $("#tipo_recibo").val();
							data += '&numero_recibo=' + $("#numero_recibo").val();
							$.post('grabar_recibo_caja.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#contenidos2").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
			});		////finde la funcion principal de script		
</script>
  





 


