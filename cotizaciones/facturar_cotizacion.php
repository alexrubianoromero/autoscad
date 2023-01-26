<!DOCTYPE html><head>
<meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<title>Untitled Document</title>
<?php
include('../valotablapc.php');

$sql_iva = "select iva from $tabla17 ";
$consulta_iva = mysql_query($sql_iva,$conexion);
$arr_iva = mysql_fetch_assoc($consulta_iva);
$iva = $arr_iva['iva'];
$sql_numero_cotizacion ="select cot.id_cotizacion,cot.no_cotizacion,
cot.kilometraje,
cli.identi,cli.direccion,cli.nombre,cli.email,cli.telefono,c.color,c.marca,c.placa,c.modelo 
from $cotizaciones cot
inner join $tabla4 c on (c.idcarro = cot.idcarro)
inner join $tabla3 cli on (cli.idcliente = c.propietario)
where 
id_cotizacion = '".$_REQUEST['id_cotizacion']."'  ";
$consulta_cotizacion = mysql_query($sql_numero_cotizacion,$conexion);
$arr_cot = mysql_fetch_assoc($consulta_cotizacion);
$ancho_tabla= "90%";
?>


<div id = "datos_cotizacion"  align="center">
<table width="<?php echo $ancho_tabla ?>" border="1">
  <tr>
    <td><div align="center"><img src="../logos/autoscad.png" width="162" height="108"></div></td>
    <td><div id="titulos">
      <div align="center">COTIZACION No: <?php echo  $arr_cot['no_cotizacion']; ?>
      	<input type="hidden" id="id_cotizacion" name = "id_cotizacion" value ="<?php echo  $_REQUEST['id_cotizacion']; ?>" >
      	<br>
        NIT: 900.790.844-2 <BR>
        CLL 128B 53 25</div>
    </div></td>
  </tr>
  <tr>
    <td colspan="2" align="center"> FECHA: <?php echo $arr_cot['fecha']; ?></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla ?>" border="1">
  <tr>
    <td>Empresa</td>
    <td><?php  echo $arr_cot['nombre']  ?></td>
	  <td>ID</td>
      <td colspan="3"><label><?php  echo $arr_cot['identi']  ?>
      </label></td>
	</tr>
	 <tr>
    <td>Direccion</td>
    <td><label><?php  echo $arr_cot['direccion']  ?></label></td>
	  <td>Telefono</td>
	    <td><?php  echo $arr_cot['telefono']  ?></td>
	    <td>Marca</td>
	    <td><?php  echo $arr_cot['marca']  ?></td>
    </tr>
	 <tr>
	   <td>Nombre</td>
	   <td><?php echo $arr_cot['nombre']; ?></td>
	   <td>Kilome</td>
	   <td><?php echo $arr_cot['kilometraje']   ?>"</td>
	   <td>Modelo</td>
	   <td><?php  echo $arr_cot['modelo']  ?></td>
	 </tr>
	 <tr>
	   <td>Mail</td>
	   <td><?php echo $arr_cot['email']; ?></td>
	   <td>Color</td>
	   <td><?php echo $arr_cot['color']; ?></td>
	   <td>Placas</td>
	   <td><?php  echo $arr_cot['placa']  ?><input type="hidden" name="idcarro" id="idcarro" ></td>
  </tr>
  </table>

<div id="div_encabezado_items">

	


	<div id="div_items">
		<?php
        include('mostrar_items_sin_eliminar.php');

		mostrar_items_sin_eliminar($_REQUEST['id_cotizacion']);
?>
	</div>

<div id="finalizar" align="center">
		<br>
		<button id="finalizar_cotizacion">CREAR FACTURA PARA ESTA COTIZACION</button>
	</div>	

	
 </div>


</div>
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../jquery-2.1.1.js"></script>  
<script src="jquery-2.1.1.js"></script>   

<script>
  $(document).ready(function(){
        
		
		//////////////////
			   $("#placa").keyup(function(e){
					//$("#cosito").html( $("#nombrepan").val() );
					if (e.which == 13)
					{
							var data1 ='placa=' + $("#placa").val();
							//$.post('buscarelnombre.php',data1,function(b){
							$.post('traer_datos_placa.php',data1,function(b){
							        //  $("#descripan").val() =  descripcion;
									$("#tipo").val(b[0].tipo);
									$("#identi").val(b[0].identi);
									$("#nombre").val(b[0].nombre);
									$("#marca").val(b[0].marca);
									$("#modelo").val(b[0].modelo);
									$("#color").val(b[0].color);
									$("#direccion").val(b[0].direccion);
									$("#telefono").val(b[0].telefono);
									$("#email").val(b[0].email);
									$("#idcarro").val(b[0].idcarro);
									$("#idcliente").val(b[0].idcliente);
									$("#empresa").val(b[0].nombre);


							 //(data1);
							},
							'json');
						$("#btn_crear_cotizacion").css("display","block");	

						
					}// fin del if 		
			   });//finde placapan
			  
			/////////////////////////////////
			
				$("#btn_crear_cotizacion").click(function(event) {
					//alert("asdasda");
					
						var data ='no_cotizacion=' + $("#no_cotizacion").val();
						data += '&idcarro=' + $("#idcarro").val();
						data += '&fecha=' + $("#fecha").val();


							$.post('grabar_encabezado_cotizacion.php',data,function(b){
							//$(window).attr('location', '../index.php);
							$("#div_items").html(b);
							$("#id_cotizacion").val(b[0].id_cotizacion);
							
								//alert(data);
							},
							'json');
					$("#btn_crear_cotizacion").css("display","none");	
					$("#div_encabezado_items").css("display","block");	
		
				

				});
			
			/////////////////////////////////
		
    $("#concepto").change(function(event){
            var id = $("#concepto").find(':selected').val();
            $("#producto1").load('genera-select.php?id='+id);
            $("#producto2").load('genera-select.php?id='+id);
            $("#producto3").load('genera-select.php?id='+id);
        });
    /*
    $("#select2").change(function(event){
            var id = $("#select2").find(':selected').val();
            $("#select3").load('genera-select2.php?id='+id);
        });
       */ 
    ///////////////////////////
	///////////////////////////////////
				
					$("#casilla_empresa").click(function(event) {
							    if($(this).is(":checked")) 
								{ 
										 $("#buscarcliente").load('pregunte_datos_nuevo_carro.php');
										//alert('Se hizo check en el checkbox.');
							  	} else {
										//alert('Se destildo el checkbox');
										$("#buscarcliente").html('');
							  }	  
					  });
					  //////////////////////////
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
									$("#valor_unit").val(b[0].valor_unit);
									$("#valor_unit").focus();
									$("#cantipan").val('');
									//$("#cantipan").focus();
									$("#totalpan").val(0);
							 //(data1);
							},
							'json');
					}// fin del if 		
			   });//finde codigopan
			  //////////////////////////////////
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
	/////////////////////////
	/////////////////////////////////	
						$("#agregar_item").click(function(){
							var data =  'codigopan =' + $("#codigopan").val();
							data += '&descripan=' + $("#descripan").val();
							data += '&valor_unit=' + $("#valor_unit").val();
							data += '&cantipan=' + $("#cantipan").val();
							data += '&totalpan=' + $("#totalpan").val();
							data += '&id_cotizacion=' + $("#id_cotizacion").val();
							data += '&repman=' + $("#repman").val();
							$.post('procesar_items.php',data,function(a){
							$("#div_items").html(a);
								//alert(data);
							});	
						 });
	////////////////////////
			$('#cantipan').keyup(function(b){
					if (b.which == 13)
					{

				         resultado = '78910';
						 resultado2 = $('#cantipan').val() *  $('#valor_unit').val() ;
						$('#totalpan').val(resultado2);  
					}	
						
					});
					
	///////////////////////
	
	///////////////////
		$(".eliminar").click(function(){
							var data =  'eliminar=' + $(this).attr('value');
							$.post('eliminar_items_cotizacion.php',data,function(a){
							$("#div_items").html(a);
								//alert(data);
							});	

						 });

	//////////////////

		$("#finalizar_cotizacion").click(function(){

					var data =  'id_cotizacion=' + $("#id_cotizacion").val();
						//data += '&kilometraje=' + $("#kilometraje").val();
							$.post('crear_factura_cotizacion.php',data,function(a){
							$("#datos_cotizacion").html(a);
								//alert(data);
							});	


					/*		
					var data =  'id_cotizacion=' + $("#id_cotizacion").val();
						data += '&kilometraje=' + $("#kilometraje").val();
						*/

							/*
							$.post('muestre_cotizaciones.php',data,function(a){
							$("#datos_cotizacion").html(a);
								//alert(data);
							});		
							*/


		});

	//////////////////////
    });
</script>


