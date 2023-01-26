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
//buscar el saldo inicial de hoy 
$fechapan =  time();
$fechapan = date ( "Y/m/j" , $fechapan );
//echo 'valor de fecha<br>'.$fechapan;
$traer_registro_del_dia = "select * from $tabla22 where  fecha = '".$fechapan."' and   id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_fecha = mysql_query($traer_registro_del_dia,$conexion);
$filas_fecha = mysql_num_rows($consulta_fecha);
//echo '<br>filas_fecha'.$filas_fecha.'<br>';
 ?>
<Div id="contenidos">


		<header>
		<h1><? echo $empresa; ?></h1>
<h2><? echo $slogan; ?><h2>
	</header>
	
	
<?php   
if($filas_fecha > 0 )
{ // si existe saldo inicial del dia 
?>	
<h2>TIPO DE RECIBO</h2>

<table width="77%" border="1">
  <tr>
    <td width="39%"><h4>TIPO DE RECIBO</h4> </td>
    <td width="61%"><label>
	<select id = "tipo_recibo">
	<option value = "" ></option>
	<option value = "1" >INGRESO</option>
	<option value = "2" >SALIDA</option>
	</select>
	</label></td>
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
    <td colspan="2"><button type ="button"  id = "enviar_tipo" >
			      <h4>ENVIAR</h4>
	      </button></td>
    </tr>
</table>
<?php
}//fin del si exsite el saldo 
else 
	{
	    echo '<br><h2>NO  ES POSIBLE CREAR RECIBOS PARA EL DIA DE  HOY</h2> <br>';
		echo '<br><h2>NO SE ENCUENTRA EL SALDO INICIAL DEL DIA DE HOY AL PARECER NO SE HA REALIZADO CIERRE DE CAJA DEL DIA ANTERIOR</h2><BR>';
	}

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
					$("#enviar_tipo").click(function(){
							var data =  'tipo_recibo=' + $("#tipo_recibo").val();
							//data += '&pagadoa=' + $("#pagadoa").val();
							$.post('captura_recibos_de_caja.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#contenidos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
			});		////finde la funcion principal de script		
</script>
  
 





 


