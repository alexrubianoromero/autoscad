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


$sql_verificar_cierre_dia = "select * from $tabla22 where id_empresa = '".$_SESSION['id_empresa']."' and cerrado = '1' and fecha = '".$datos_recibo['fecha_recibo']."'  ";
$consulta_verificacion_cierre = mysql_query($sql_verificar_cierre_dia,$conexion);
$filas_cierre = mysql_num_rows($consulta_verificacion_cierre);
//  no arroja registros se puede modificar el recibo 
// si arrojo resultado la consulta significa que ya esta cerrado del dia y no se puede modificar 
//echo '<br>consulta verificacion cierre<br>'.$filas_cierre;
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
    <td><input name="dequienoaquin" id ="dequienoaquin"  type="text" value = "<?php echo $datos_recibo['dequienoaquin'] ?>" ></td>
  </tr>
  <tr>
    <td>LA SUMA DE (numeros) </td>
    <td><input name="lasumade" id ="lasumade"  type="text" value = "<?php echo $datos_recibo['lasumade'] ?>" ></td>
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
    <td><input name="id_recibo" id = "id_recibo" type="hidden" value = "<?php  echo $datos_recibo['id_recibo'] ?>">
	<input name="lasumade_anterior" id = "lasumade_anterior" type="hidden" value = "<?php  echo $datos_recibo['lasumade'] ?>">
	<input name="tipo_recibo" id = "tipo_recibo" type="hidden" value = "<?php  echo $datos_recibo['tipo_recibo'] ?>">
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
		<?php
		if ($filas_cierre == 0) 
		      { echo '<button type ="button"  id = "modificar_recibo" ><h4>MODIFICAR RECIBO </h4></button>';}
			  else 
			  { echo 'YA SE  REALIZAO CIERRE DE CAJA PARA ESTE DIA NO SE PUEDEN REALIZAR MODIFICACIONES AL RECIBO';}
			  
		?>	</td>
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

<?php 
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
					$("#modificar_recibo").click(function(){
							var data =  'id_recibo=' + $("#id_recibo").val();
							data += '&dequienoaquin=' + $("#dequienoaquin").val();
							data += '&lasumade=' + $("#lasumade").val();
							data += '&porconceptode=' + $("#porconceptode").val();
							data += '&observaciones=' + $("#observaciones").val();
							data += '&lasumade_anterior=' + $("#lasumade_anterior").val();
							data += '&tipo_recibo=' + $("#tipo_recibo").val();
							
							$.post('realizar_modificacion_de_recibo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#contenidos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
			});		////finde la funcion principal de script		
</script>
  
 






 


