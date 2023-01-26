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
session_start();
include('../valotablapc.php');  
$fechapan =  time();

$sql_traer_proveedores = "select * from $tabla3 where rol = '4' ";
$consulta_proveedores = mysql_query($sql_traer_proveedores,$conexion);
?>
<div id = "factura">
<H2>INGRESO NUEVA FACTURA INVENTARIO</H2>
<BR />
<table width="503" border="1">
  <tr>
    <td width="303">FECHA</td>
    <td width="184"><label>
      <input type="text" name="fecha" id = "fecha"   value= <?php echo date ( "Y/m/j" , $fechapan );?> />
    </label></td>
  </tr>
  <tr>
    <td>FACTURA</td>
    <td><input type="text" name="no_factura" id = "no_factura" /></td>
  </tr>
 
  <tr>
    <td>PROVEEDOR</td>
    <td><select name="proveedor" id = "proveedor">
		<option  value = "" >...</option>
		<?php
			 while($proveedores = mysql_fetch_assoc($consulta_proveedores))
			 {
			 	echo '<option value="'.$proveedores['idcliente'].'">'.$proveedores['identi'].'-'.$proveedores['nombre'].'</option>';
			 }
		?>
		</select>
	</td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><button type ="button"  id = "grabar_factura" ><h4>CREAR_FACTURA</h4></button></td>
  </tr>
</table>
</div>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
						//////////////////
			   
					/////////////////////////
					$("#grabar_factura").click(function(){
							var data =  'fecha=' + $("#fecha").val();
							data += '&no_factura=' + $("#no_factura").val();
							data += '&proveedor=' + $("#proveedor").val();
							$.post('grabar_factura_inventario.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#factura").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>