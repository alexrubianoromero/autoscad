<?php
session_start();
				/*
				echo '<pre>';
				print_r($_GET);
				echo '</pre>';
				*/

?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	<style>	
		#div_tabla_datos_tecnico{
			width: 50%;
		}
	</style>	

</head>
<body>
<? 
include("../empresa.php");
include('../valotablapc.php');
include('../funciones.php');
//include('../colocar_links2.php');

$sql_clientes = "select * from $tabla21 where idcliente = '".$_GET['idcliente']."'   and  id_empresa = '".$_SESSION['id_empresa']."'   ";
//echo '<br>'.$sql_clientes;

$consulta_clientes = mysql_query($sql_clientes,$conexion);

$filas = mysql_num_rows($consulta_clientes); 

//echo '<br>'.$filas;
if ($filas  > 0)
			{   
			 $datos = get_table_assoc($consulta_clientes);
			 	/*
				echo '<pre>';
				print_r($datos);
				echo '</pre>';
				*/
			 
?>
<div id="div_muestre_informacion_detallada" >
	<div  id="div_tabla_datos_tecnico"> 
		<br>
			 <!-- <form name = "formu1"  action = "actualize_datos_cliente.php"  method = "post"> -->
			<table width="572" border="1" class="table">
  <tr>
    <td width="248">&nbsp;</td>
    <td width="308">&nbsp;</td>
  </tr>
  <tr>
    <td>IDENTIFICACION</td>
    <td><input name="identi" id  = "identi" type="text"  value = "<?php  echo $datos[0]['identi']?> " > </td>
  </tr>
  <tr>
    <td>NOMBRE</td>
    <td><input name="nombre" id  = "nombre" type="text"  value = "<?php  echo $datos[0]['nombre'] ?> "   ></td>
  </tr>
  <tr>
    <td>DIRECCION</td>
    <td><input name="direccion" id  = "direccion" type="text"  value = "<?php  echo $datos[0]['direccion']?> "></td>
  </tr>
  <tr>
    <td>TELEFONO</td>
    <td><input name="telefono" id  = "telefono" type="telefono"  value = "<?php  echo $datos[0]['telefono']?> "></td>
  </tr>
  <tr>
    <td>EMAIL</td>
    <td><input name="email" id  = "email" type="text"  value = "<?php  echo $datos[0]['email']?> "></td>
  </tr>
  <tr>
    <td>OBSERVACIONES </td>
    <td><input name="observaci" id  = "observaci" type="text"  value = "<?php  echo $datos[0]['observaci']?> "></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="idcliente" id  = "idcliente" type="hidden"  value = "<?php  echo $datos[0]['idcliente']?> "></td>
  </tr>
  <tr>
    <td ><button type ="submit"  id = "actualizar_cliente" class="btn btn-primary btn-block btn-lg">Actualizar</td>
    	<td >
    		<?php
    		if($_SESSION['id_perfil'] > 6)
    			echo '<button type ="submit"  id = "eliminar_cliente123" class="btn btn-primary btn-block btn-lg">Eliminar_Tecnico</button>';
    		?>
    	</td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</div>
></div>
<!-- </form> -->

			
			<?php
			 }
 else      { echo '<br> NO EXISTE INFORMACION ACERCA DE ESTA PERSONA';}			
			  
 ?>


</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
<script type="text/javascript" src="../bootstrap.min.js"></script>

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
			   
			   /////////////////
			  
			   ////////////////
			   
			   
			  
						// $("#actualizar_cliente").click(function(){
						// 	var data =  'idcliente=' + $("#idcliente").val();
						// 		data += '&identi=' + $("#identi").val();
						// 		data += '&nombre=' + $("#nombre").val();
						// 		data += '&telefono=' + $("#telefono").val();
						// 		data += '&direccion=' + $("#direccion").val();
						// 		data += '&email=' + $("#email").val();
						// 		data += '&observaci=' + $("#observaci").val();

						// 	$.post('../tecnicos/actualize_datos_cliente.php',data,function(a){
						// 	//$(window).attr('location', '../index.php);
						// 	$("#muestre").html(a);
						// 		//alert(data);
						// 	});	
						//  });
					////////////////////////

						$("#eliminar_cliente123").click(function(){
							//alert('enrto a eliminar ');
							var data =  'idcliente=' + $("#idcliente").val();
							$.post('../tecnicos/elimine_datos_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							   $("#div_muestre_informacion_detallada").html(a);
								//alert(data);
							});	
						 });
					////////////////////////ss\\\\\

		
					
		 });	//fin de la funcion principal 		
          	
</script>


