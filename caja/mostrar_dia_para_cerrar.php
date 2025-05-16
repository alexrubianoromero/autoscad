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
<? include("../empresa.php"); ?>
<Div id="contenidos">
		<header>
		<h1><? echo $empresa; ?></h1>
<h2><? echo $slogan; ?><h2>
	</header>
<?php
$traer_registros_sin_cerrar = "select * from $tabla22 where id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0' and cerrado = '0' and id_dia_caja = '".$_REQUEST['id_dia_caja']."' ";
$consulta_abiertos = mysql_query($traer_registros_sin_cerrar,$conexion);
$abiertos = mysql_fetch_assoc($consulta_abiertos);
//suma de las entradas del dia 
$traer_suma_entradas_dia = "select sum(lasumade) as suma from $tabla23 where fecha_recibo = '".$abiertos['fecha']."' and  id_empresa = '".$_SESSION['id_empresa']."'
 and anulado = '0' and tipo_recibo = '1'  group by fecha_recibo  ";
 //echo '<br>consulta<br>'.$traer_suma_entradas_dia.'<br>';
 $total_entradas = mysql_query($traer_suma_entradas_dia,$conexion);
 $total_entradas = mysql_fetch_assoc($total_entradas);
 //suma de las salidas del dia
 $traer_suma_salidas_dia = "select sum(lasumade) as suma from $tabla23 where fecha_recibo = '".$abiertos['fecha']."' and  id_empresa = '".$_SESSION['id_empresa']."'
 and anulado = '0' and tipo_recibo = '2'  group by fecha_recibo  "; 
 $total_salidas = mysql_query($traer_suma_salidas_dia,$conexion); 
  $total_salidas = mysql_fetch_assoc($total_salidas);
 ///////////////////////////
 //////saldo final seria
 $saldo_final_dia = ($abiertos['saldo_inicial']  +   $total_entradas['suma']) -  $total_salidas['suma'];
 //////////////////////////
 /*
 echo '<pre>total_entradas';
print_r($total_entradas);
echo '</pre>';
 
 

echo '<pre>abiertos';
print_r($abiertos);
echo '</pre>';
*/
//echo 'saldo inicial del dia '.$abiertos['saldo_inicial'].'<br>';
echo '<table border = "1" width= "95%">';
echo '<h4><tr align= "center"><td>FECHA</td><td>SALDO INICIAL</td><td>TOTAL ENTRADAS</td><td>TOTAL SALIDAS</td><td>SALDO FINAL</td><tr></h4>';
echo '<tr><td align="center">'.$abiertos['fecha'].'</td><td align="right">'.$abiertos['saldo_inicial'].'</td><td align="right">'.number_format($total_entradas['suma'], 0, ',', '.').'</td><td align="right">'.number_format($total_salidas['suma'], 0, ',', '.').'</td><td align="right">'. number_format($saldo_final_dia, 0, ',', '.') .'</td><tr>';
echo '</table>';
echo '<br>';

echo 'DETALLE ENTRADAS<BR>';
echo '<table border = "1" width= "95%">';
echo '<tr><td>FECHA</td><td>RECIBIDO DE </td><td>CONCEPTO</td><td>VALOR</td></tr>';
$traer_recibos_del_dia = "select * from $tabla23 where id_empresa = '".$_SESSION['id_empresa']."' and fecha_recibo = '".$abiertos['fecha']."' and anulado = '0'  ";

$consulta_recibos = mysql_query($traer_recibos_del_dia,$conexion);
while($recibos = mysql_fetch_assoc($consulta_recibos))
		{
			if($recibos['tipo_recibo'] < 2 )
			{
			echo '<tr>';
			echo '<td>'.$recibos['fecha_recibo'].'</td>';
			echo '<td>'.$recibos['dequienoaquin'].'</td>';
			echo '<td>'.$recibos['porconceptode'].'</td>';
			echo '<td align="right">'.number_format($recibos['lasumade'], 0, ',', '.').'</td>';
			echo '</tr>';
			}
		}

echo '</table>';

//////////////////////////////////

echo '<BR>';
echo 'DETALLE SALIDAS<BR>';
echo '<table border = "1" width= "95%">';
echo '<tr><td>FECHA</td><td>PAGADO A  </td><td>CONCEPTO</td><td>VALOR</td></tr>';
$traer_recibos_del_dia = "select * from $tabla23 where id_empresa = '".$_SESSION['id_empresa']."' and fecha_recibo = '".$abiertos['fecha']."' and anulado = '0'  ";

$consulta_recibos = mysql_query($traer_recibos_del_dia,$conexion);
while($recibos = mysql_fetch_assoc($consulta_recibos))
		{
			if($recibos['tipo_recibo'] > 1)
			{
			echo '<tr>';
			echo '<td>'.$recibos['fecha_recibo'].'</td>';
			echo '<td>'.$recibos['dequienoaquin'].'</td>';
			echo '<td>'.$recibos['porconceptode'].'</td>';
			echo '<td align="right" > '.number_format($recibos['lasumade'], 0, ',', '.').'</td>';
			echo '</tr>';
			}
		}
echo '</table>';

	if($abiertos['cerrado'] > 0)
	{
	  echo 'ESTE DIA YA ESTA CERRADO ';
	}
else
	{ // osea si el dia esta abierto haga
?>	
   
			<BR><BR>
			SI ESTA DE ACUERDO PUEDE PROCEDER AL CIERRE DEL DIA <?php   echo $abiertos['fecha'];  ?> 
			<BR> 
			CON ESTO SE PROCEDERA A CREAR EL SALDO PARA EL SIGUIENTE DIA POR VALOR DE  <?php  echo number_format($saldo_final_dia, 0, ',', '.');  ?>
			<BR>
			<button type ="button"  id = "cerrar_caja" ><h4>CERRAR CAJA  PARA EL DIA <?php   echo $abiertos['fecha'];  ?> </h4></button>
			<input name="id_dia_caja"   id = "id_dia_caja" type="hidden"   value="<?php  echo $_REQUEST['id_dia_caja'];  ?>">
			<input name="$saldo_final_dia"   id = "saldo_final_dia" type="hidden"   value="<?php  echo $saldo_final_dia;  ?>">
			<input name="$fecha_cierre"   id = "fecha_cierre" type="hidden"   value="<?php  echo $abiertos['fecha'];  ?>">
  <?php
  
  } // fin de si el dia esta abierto
  include('../colocar_links2.php');
  ?>			
</Div>
	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
					/////////////////////////
					$("#cerrar_caja").click(function(){
							var data =  'id_dia_caja=' + $("#id_dia_caja").val();
							data += '&saldo_final_dia=' + $("#saldo_final_dia").val();
							data += '&fecha_cierre=' + $("#fecha_cierre").val();
							$.post('realizar_cierre_de_caja.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#contenidos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
			});		////finde la funcion principal de script		
</script>
  





 


