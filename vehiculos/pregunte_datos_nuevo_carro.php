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
$sql_clientes = "select idcliente,nombre,identi from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."'   ";
$clientes = mysql_query($sql_clientes,$conexion);

?>

<body>

  
    <td width="244" height="48">PROPIETARIO</td>
    <td width="297"><?php
	echo "<select name='propietario' id='propietario'>";
	echo "<option value='' selected>...</option>";     
	while($row = mysql_fetch_array($clientes))
			{
             echo "<h2><option value= ".$row[0].">".$row[1]."-".$row[2]."</h2></option>";
     		}
	 echo "</select>";
	
	?>
      
    </td>
  
  


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
						data += '&color=' + $("#color").val();
						data += '&placa=' + $("#placa").val();
						data += '&idcliente=' + $("#propietario").find(':selected').val();
					
						$.post('grabar_datos_vehiculo.php',data,function(a){
							 $("#contenidos").load('muestreplacas2.php');
							$("#carros123").html('');
							//alert(data);
						});	
					});

												  
												  
												  
												  
			 }); // fin de total 									  
			 
					
</script>