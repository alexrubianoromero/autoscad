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
$sql_traer_datos_recibo   = "select *  from $tabla23  where  numero_recibo = '".$_REQUEST['numero']."'  and id_empresa = '".$_SESSION['id_empresa']."'  and anulado = '0' ";
$consulta_datos_recibo = mysql_query($sql_traer_datos_recibo,$conexion);
$datos_recibo = mysql_fetch_assoc($consulta_datos_recibo);

/////verificar cierre 
$sql_verificar_cierre_dia = "select * from $tabla22 where id_empresa = '".$_SESSION['id_empresa']."' and cerrado = '1' and fecha = '".$datos_recibo['fecha_recibo']."'  ";
$consulta_verificacion_cierre = mysql_query($sql_verificar_cierre_dia,$conexion);
$filas_cierre = mysql_num_rows($consulta_verificacion_cierre);
?>
<Div id="contenidos">
		<header>
		<h1><? echo $empresa; ?></h1>
<h2><? echo $slogan; ?><h2>
	</header>

<BR><h2>ESTA REALMENTE SEGURO DE ANULAR EL RECIBO NUMERO <?php echo $_REQUEST['numero'].' ?';?> </h2> 
<BR>
<BR>
<input name="numero_recibo" id = "numero_recibo"   type="hidden"  value = "<?php echo $_REQUEST['numero'];?> " >
<input name="tipo_recibo" id = "tipo_recibo"   type="hidden"  value = "<?php echo $datos_recibo['tipo_recibo'];?> " >
<input name="lasumade" id = "lasumade"   type="hidden"  value = "<?php echo $datos_recibo['lasumade'];?> " >

<?php
          if ($filas_cierre == 0) 
		      {
		  echo '<button type ="button"  id = "anular_recibo" >
			      <h3>ANULAR RECIBO</h3></button>';
			}
			else 
			{
			{ echo '<h2>YA SE  REALIZAO CIERRE DE CAJA PARA ESTE DIA NO SE PUEDEN REALIZAR MODIFICACIONES AL RECIBO</h2>';}
			}	  

?>	  

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
					$("#anular_recibo").click(function(){
							var data =  'numero_recibo=' + $("#numero_recibo").val();
							data += '&tipo_recibo=' + $("#tipo_recibo").val();
							data += '&lasumade=' + $("#lasumade").val();
							$.post('anular_recibo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#contenidos").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
			});		////finde la funcion principal de script		
</script>
  
 





 


