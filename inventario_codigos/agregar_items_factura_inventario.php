<?php
session_start();
include('../valotablapc.php'); 
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
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
<br />
AGREGAR ITEMS A FACTURA <?php echo $_REQUEST['no_factura']; ?><input name="id_factura" id = "id_factura" type="hidden"  value = "<?php echo $_REQUEST['id_factura'] ?>"/>

<br />
<br />

 <table width="75%" border = "1">
      <tr>
        <td colspan="11"><div align="center">PARTES Y RESPUESTOS </div></td>
      </tr>
      <tr>
    <td><div align="center">COD </div></td>
    <td><div align="center">DESCRIPCION</div></td>

	
    <td><div align="center">PRECIO PROVEEDOR </div></td>
    <td>EXIS</td>
    <td>CANT A CARGAR</td>
    <td>TOTAL</td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
   
    <td width="38"><label>
      <input name="codigopan" type="text" id = "codigopan" size="5" />
	  <input name="id_codigo" type="hidden" id = "id_codigo" size="5" />
    </label></td>
    <td width="149"><input type="text" name="descripan" id = "descripan" /> <div id = "descripcion"></div></td>
    <td width="82"><input type="text" name="valor_unit" id = "valor_unit" size = "10" /></td>
    <td width="87"><input name="exispan" type="text" id = "exispan" size="10" /></td>
    <td width="85"><input name="cantipan" type="text" id = "cantipan"  size ="10"/></td>
    <td width="77"><input name="totalpan" type="text" id = "totalpan" size="15" /></td>
    <td width="75"><button type = "button" id = "agregar_item">Agregar</button></td>
  </tr>
    </table>
	 <div id = "nuevodiv">
				 <?php 
				  include('mostrar_items_factura_inventario.php');
				  $_SESSION['id_orden'] = $_REQUEST['id_factura'];
				  mostrar_items($_SESSION['id_orden']);
				  //$factupan = $_GET['idorden'];
				?>
		 </div>
 





</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
						//////////////////
			   $("#codigopan").keyup(function(e){
					//$("#cosito").html( $("#nombrepan").val() );
					if (e.which == 13)
					{
							//alert('digito enter');
							var data1 ='codigopan=' + $("#codigopan").val();
							//$.post('buscarelnombre.php',data1,function(b){
							$.post('traer_codigo_descripcion.php',data1,function(b){
							        //  $("#descripan").val() =  descripcion;
									$("#descripan").val(b[0].descripcion);
									//$("#valor_unit").val(b[0].valor_unit);
									$("#exispan").val(b[0].existencias);
									$("#id_codigo").val(b[0].id_codigo);
									$("#cantipan").val('');
									$("#cantipan").focus();
									$("#totalpan").val(0);
									
							 //(data1);
							},
							'json');
					}// fin del if 		
			   });//finde codigopan
			  //////////////////////////////////
				/////////////////////////////////	
						$("#agregar_item").click(function(){
							var data =  'codigopan =' + $("#codigopan").val();
							data += '&descripan=' + $("#descripan").val();
							data += '&valor_unit=' + $("#valor_unit").val();
							data += '&cantipan=' + $("#cantipan").val();
							data += '&totalpan=' + $("#totalpan").val();
							data += '&exispan=' + $("#exispan").val();
							//data += '&id_mecanico=' + $("#id_mecanico").val();
							data += '&orden_numero=' + $("#id_factura").val();
							data += '&id_codigo=' + $("#id_codigo").val();
							$.post('procesar_items.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
				
					///////////////////////////////////para eliminar items
					$(".eliminar").click(function(){
			
							var data =  'eliminar =' + $(this).attr('value');
							data += '&factupan=' + $("#orden_numero").val();
							$.post('eliminar_items.php',data,function(a){
								$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
					//////////////////////////////////
						$('#cantipan').keyup(function(b){
					if (b.which == 13)
					{

				         resultado = '78910';
						 resultado2 = $('#cantipan').val() *  $('#valor_unit').val() ;
						$('#totalpan').val(resultado2);  
					}	
						
					});
					
					/////////////////////////
					$("#actualizar_orden").click(function(){
							var data =  'orden_numero=' + $("#orden_numero").val();
							data += '&clave=' + $("#clave").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&placa=' + $("#placa").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&iva=' + $("#iva").val();
							data += '&kilometraje=' + $("#kilometraje").val();
							data += '&mecanico=' + $("#mecanico").val();
							data += '&kilometraje_cambio=' + $("#kilometraje_cambio").val();
							data += '&cambiar_mecanico=' + $("#cambiar_mecanico:checked").val();
							data += '&estado=' + $("#estado").val();
							data += '&ultimo_estado=' + $("#ultimo_estado").val();
							$.post('actualizar_orden_honda.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#divorden").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					


			
			});		////finde la funcion principal de script
			
			
			


			
			
</script>

<script>
function valida_envia(){ 
   	//valido el nombre 
	/*
   	if (document.actualizarorden.abono.value.length==0){ 
      	alert("Tiene que escribir su kilometraje_cambio") 
      	document.actualizarorden.kilometraje_cambio.focus() 
      	return 0; 
   	} 
	*/
	
//el formulario se envia 
   	alert("Muchas gracias por enviar el formulario"); 
   	document.actualizarorden.submit(); 
}
</script>

