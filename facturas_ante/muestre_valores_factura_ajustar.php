<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>

<body>
<?php
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
include('../valotablapc.php');
$sql_factura = "select cli.nombre,f.sumaitems,  f.valor_iva,f.valor_retefuente,f.total_factura,f.id_factura,f.numero_factura
from $tabla11  as f  
inner join $tabla14 o on (o.id = f.id_orden)
inner join $tabla4 as car on (car.placa = o.placa)
inner join $tabla3 as cli on (cli.idcliente  = car.propietario)
 where f.numero_factura = '".$_POST['nofactura']."'  and f.id_empresa = '".$_SESSION['id_empresa']."'   ";
//echo '<br>sql<br> '.$sql_factura;
$consulta_factura = mysql_query($sql_factura,$conexion);
$datos_factura = mysql_fetch_assoc($consulta_factura);

?>
<br />
<br />
<h3>CORRECCION DE VALORES DE RETEFUENTE EN FACTURAS YA GENERADAS</h3>
<br />
<br />
<div id = "datos_factura" >
<h4>
<table width="47%" border="1">
  <tr>
    <td>FACTURA No </td>
    <td><label>
       <?php   echo $_POST['nofactura'] ;?>  
       <input type="hidden" name="id_factura" id = "id_factura"  value = "<?php  echo $datos_factura['id_factura']; ?>" />
	   <input type="hidden" name="id_empresa" id = "id_empresa"  value = "<?php  echo $_SESSION['id_empresa']; ?>" />
	   <input type="hidden" name="numero_factura" id = "numero_factura"  value = "<?php   echo $datos_factura['numero_factura']; ?>" />
    </label></td>
	
  </tr>
  <tr>
    <td>SE&Ntilde;ORES</td>
    <td><?php  echo $datos_factura['nombre']  ?></td>
  </tr>
  <tr>
    <td width="26%">SUBTOTAL</td>
    <td width="74%"><?php  echo $datos_factura['sumaitems']  ?></td>
  </tr>
  <tr>
    <td>IVA</td>
    <td><?php  echo $datos_factura['valor_iva']  ?></td>
  </tr>
  <tr>
    <td>RETEFUENTE</td>
    <td><input type="text" name="valor_retefuente" id = "valor_retefuente"  value = "<?php echo $datos_factura['valor_retefuente']  ?>"   /> </td>
  </tr>
  <tr>
    <td>TOTAL </td>
    <td><?php  echo $datos_factura['total_factura']  ?></td>
  </tr>
  </table>
 </h4>
</div>
  <table width="47%" border="1">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><button type ="button"  id = "actualizar_retefuente_factura" >
		 <h4>CORREGIR RETEFUENTE </h4>
		 </button></td>
    </tr>
</table>
<br />
<br />
<?php
include('../colocar_links2.php');
?>








</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
						//////////////////
			  
				/////////////////////////////////	
					///////////////////////////////////
					
					
					/////////////////////////
					$("#actualizar_retefuente_factura").click(function(){
							var data =  'id_factura=' + $("#id_factura").val();
							data += '&valor_retefuente=' + $("#valor_retefuente").val();
							data += '&id_empresa=' + $("#id_empresa").val();
							data += '&numero_factura=' + $("#numero_factura").val();
								$.post('corregir_retefuente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#datos_factura").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
</script>




