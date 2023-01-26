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
include("../valotablapc.php"); 
$fechapan =  time();
$sql_buscar_saldo_inicial = "select * from $tabla22 where id_empresa = '".$_SESSION['id_empresa']."'  and observaciones = 'SALDO INICIAL'  ";
$consulta_saldo_inicial = mysql_query($sql_buscar_saldo_inicial,$conexion);
$valor_saldo_inicial = mysql_fetch_assoc($consulta_saldo_inicial);

$filas_fecha = mysql_num_rows($consulta_saldo_inicial);

$sql_buscar_saldo_de_hoy = "select * from $tabla22 where fecha = '".date ( "Y/m/j" , $fechapan )."' and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo '<br>consulta<br>'.$sql_buscar_saldo_de_hoy;
$consulta_saldo = mysql_query($sql_buscar_saldo_de_hoy,$conexion);

$valor_saldo = mysql_fetch_assoc($consulta_saldo);
?>
<Div id="contenidos">
		<header>
		<h1><? echo $empresa; ?></h1> 
<h2><? echo $slogan; ?><h2>
	</header>
	<?php 
	echo '<div id = "saldo">';
	if ($filas_fecha > 0)
		{ // lo que hace si ya hay un saldo creado
		
			echo '<h2>YA EXISTE UN SALDO INICIAL POR VALOR DE<br> '.$valor_saldo_inicial['saldo_inicial'].'</h2> ';
			if ($filas_fecha == 1)
			{echo '<h2>Los otros saldos se generan cuando se realiza cierre de caja</h2>';}
		
		}// fin de si hay un saldo creado
	else
		{ // osea si no hay saldo creado para ese dia
	 ?>			 		
			<table width="95%" border="1">
			  <tr>
				<td colspan="2"><h3>SALDO INICIAL DEL SISTEMA DE CONTROL DE CAJA</h3> </td>
			  </tr>
			  <tr>
				<td width="42%">FECHA</td>
				<td width="58%"><input size=10 name=fecha id = "fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?>  ></td>
			  </tr>
			  <tr>
				<td>SALDO INICIAL </td>
				<td><label>
				  <input type="text" name="saldo_inicial" id ="saldo_inicial" >
				  <input type="hidden" name="id_empresa" id ="id_empresa" value = "<?php   echo $_SESSION['id_empresa']; ?>" >
				</label></td>
			  </tr>
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
		      </tr>
			  <tr>
			    <td colspan="2" ><button type ="button"  id = "grabar_saldo_inicial" >
			      <h4>GRABAR_SALDO_INCIAL</h4>
			    </button></td>
		      </tr>
			</table>
	<?php		
	}	// fin de si no hay saldo creado para ese dia 	
	include('../colocar_links2.php');
	?>
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
					$("#grabar_saldo_inicial").click(function(){
							var data =  'fecha=' + $("#fecha").val();
							data += '&saldo_inicial=' + $("#saldo_inicial").val();
							data += '&id_empresa=' + $("#id_empresa").val();
							$.post('grabar_saldo_inicial.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#saldo").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
			});		////finde la funcion principal de script		
</script>





 


