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
$sql_carros ="select idcarro,placa from $tabla4";
$consulta_placas = mysql_query($sql_carros,$conexion);
?>
<Div id="contenidos">
		<header>
			<h2>POR FAVOR ESCOJA LA PLACA </h2>
		</header>


	<table width="700" border="1">
  <tr>
    <td width="310"><h2>PLACA</h2></td>
    <td width="144"><h2>
      <input type="placa"  id = "placa123" name="textfield">
    </h2></td>
    <td width="124"><h2>
      <label>      </label>
    </h2></td>
  </tr>
  <tr>
    <td> <button type ="button"  id = "crear_orden" ><h3>SIGUIENTE</h3></button></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="87" colspan="3"><h2><label  for="casilla_carros" > NUEVA PLACA </label> 
	<input type="checkbox" name="casilla_carros" id = "casilla_carros"  value="checkbox" /></h2></td>
    </tr>
  <tr>
    <td height="87" colspan="3"><?php  include('../colocar_links2.php');  ?></td>
  </tr>
</table>

	
</Div>

<div id = "carros123">
</div>
	
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
				
					$("#casilla_carros").click(function(event) {
							    if($(this).is(":checked")) 
								{ 
										 $("#carros123").load('pregunte_datos_nuevo_carro.php');
										//alert('Se hizo check en el checkbox.');
							  
							  
							  	} else {
										//alert('Se destildo el checkbox');
										$("#carros123").html('');
							  }	  
					  });
					  //////////////////////////
					  
					  $("#crear_orden").click(function(){
								var placa123 =$("#placa123").val();
								$(window).attr('location', 'ordencaptura.php?placa123='+placa123);
									//alert(data);
								});	
							//});
							
					  /////////////////////////
					  
					
					
		 });			
          	
</script>