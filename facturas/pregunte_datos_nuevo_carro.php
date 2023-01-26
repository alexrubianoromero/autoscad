<?php
session_start();
?>
<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<?php
include('../valotablapc.php');
include('../funciones.php');
$sql_clientes = "select idcliente,nombre,identi from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."'  order by nombre ";
$clientes = mysql_query($sql_clientes,$conexion);

?>

<body>
<table width="875" height="54" border="1">
  <tr>
    <td width="244" height="48">PROPIETARIO</td>
    <td width="297"><?php
	echo "<select name='propietario' id='propietario'>";
	echo "<option value='' selected>...</option>";     
	while($row = mysql_fetch_array($clientes))
			{
             echo "<h2><option value= ".$row[0].">".$row[2].'-'.$row[1]."</h2></option>";
     		}
	 echo "</select>";
	
	?>
      
    </td>
    <td width="312"><h3><input type="checkbox" name="casilla_clientes"  id = "casilla_clientes" value="checkbox">
    <label   for = "casilla_clientes">NUEVO CLIENTE   </label>
    <h3></td>
  </tr>
</table>
<div id = "datos_cliente"></div>
 <table width="876" height="95" border="1"> 
  <tr>
    <td width="178">PLACA</td>
    <td width="682"><label>
      <input type="text" name="placa" id = "placa">
    </label></td>
  </tr>
  <tr>
    <td>MARCA</td>
    <td><input type="text" name="marca" id = "marca"></td>
  </tr>
  <tr>
    <td>LINEA</td>
    <td><input type="text" name="tipo" id = "tipo"></td>
  </tr>
  <tr>
    <td>MODELO</td>
    <td><input type="text" name="modelo" id = "modelo"></td>
  </tr>
   
  <tr>
    <td>COLOR</td>
    <td><input type="text" name="color" id = "color"></td>
  </tr>
  <tr>
    <td>CHASIS</td>
    <td><input type="text" name="chasis" id = "chasis"></td>
  </tr>
  <tr>
    <td>MOTOR</td>
    <td><input type="text" name="motor" id = "motor"></td>
  </tr>
    <tr>
    <td>SOAT  </td>
    <td><input type="text" name="soat" id = "soat">
    AAAA/MM/DD</td>
  </tr>
    <tr>
    <td>TECNOMECANICA</td>
    <td><input type="text" name="revision" id = "revision">
    AAAA/MM/DD</td>
  </tr>
    <tr>
      <td>ID</td>
      <td><input type="text" name="id" id = "id"></td>
    </tr>
   <tr>
    <td colspan="2"> <button id = "grabar_datos_vehiculo"  type = "button">Grabar Datos Vehiculo </button></td>
   </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<script language="JavaScript" type="text/JavaScript">
$(document).ready(function(){
							$("#casilla_clientes").click(function(event) {
															if($(this).is(":checked")) 
															{ 
																	 $("#datos_cliente").load('pregunte_datos_nuevo_cliente.php');
																	//alert('Se hizo check en el checkbox.');
														  
														  
															} else {
																	//alert('Se destildo el checkbox');
																	$("#datos_cliente").html('');
														  }
															  
														  
												  });
												  
												  
							$("#grabar_datos_vehiculo").click(function(){
						var data =  'placa1=' + $("#placa").val();
						data += '&marca=' + $("#marca").val();
						data += '&tipo=' + $("#tipo").val();
						data += '&modelo=' + $("#modelo").val();
						data += '&chasis=' + $("#chasis").val();
						data += '&motor=' + $("#motor").val();
						data += '&color=' + $("#color").val();
						data += '&placa=' + $("#placa").val();
						data += '&soat=' + $("#soat").val();
						data += '&revision=' + $("#revision").val();
						data += '&idcliente=' + $("#propietario").find(':selected').val();
						data += '&id=' + $("#id").val();
						$.post('grabar_datos_vehiculo.php',data,function(a){
							 $("#contenidos").load('muestreplacas2_honda.php');
							$("#carros123").html('');
							//alert(data);
						});	
					});

												  
												  
												  
												  
			 }); // fin de total 									  
			 
					
</script>