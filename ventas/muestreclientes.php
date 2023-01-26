<?php
session_start();
?>
<!DOCTYPE html>
<html >
<!-- <html lang="es"  class"no-js">
-->

<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
<? 
include('../valotablapc.php');
$sql_clientes ="select idcliente,nombre from $tabla3 where id_empresa = '".$_SESSION['id_empresa']."'";
//echo '<br>consulta<br>'.$sql_clientes;
$consulta_clientes = mysql_query($sql_clientes,$conexion);

?>
<Div id="contenidos">
		<header>
			<h2>POR FAVOR ESCOJA EL CLIENTE </h2>
		</header>


	<table width="700" border="1">
  <tr>
    <td width="310"><h2>NOMBRE</h2></td>
    <td width="144"><h3>
      <select name="idcliente" id = "idcliente">
	  <option>Escoja el cliente...</option>
	      <?php
		  		while ($row_cliente = mysql_fetch_array($consulta_clientes))
						{
						    echo '<option value = "'.$row_cliente[0].'"  >'.$row_cliente[1].'</option>';
						}
		  
		  ?>
	  </select>
    </h3></td>
    <td width="124"><h2>
      <label>      </label>
    </h2></td>
  </tr>
  <tr>
    <td> <button type ="button"  id = "formulario_venta" ><h3>SIGUIENTE</h3></button></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="87" colspan="3"><h3><label  for="casilla_clientes" > NUEVO CLIENTE </label> 
	<input type="checkbox" name="casilla_clientes" id = "casilla_clientes"  value="1" /></h3></td>
    </tr>

	 <tr>
    <td height="87" colspan="3">	<div id = "carros123">
</div></td>
  </tr>
  <tr>
    <td height="87" colspan="3"><?php  include('../colocar_links2.php');  ?></td>
  </tr>
</table>

	
</Div>


</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
			   /*
			    $("#empresapan").change(function(event){
                    var cod = $("#empresapan").find(':selected').val();
                    $("#resultados").load('muestre_datos_cliente.php?cod='+cod );
                });
				*/
	
						///////////////////////
			           ///////////////////////
				
				
				///////////////////////////////////
				
					$("#casilla_clientes").click(function(event) {
							    if($(this).is(":checked")) 
								{ 
										 $("#carros123").load('pregunte_datos_nuevo_cliente.php');
										//alert('Se hizo check en el checkbox.');
							  
							  
							  	} else {
										//alert('Se destildo el checkbox');
										$("#carros123").html('');
							  }	  
					  });
					  //////////////////////////
					  
					  $("#formulario_venta").click(function(){
								var idcliente =$("#idcliente").val();
								$(window).attr('location', 'nueva_venta.php?idcliente='+idcliente);
									//alert(data);
								});	
							//});
							
					  /////////////////////////
					  
					
					
		 });			
          	
</script>