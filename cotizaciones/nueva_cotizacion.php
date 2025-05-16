<!DOCTYPE html>
<head>
<meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<title>Untitled Document</title>
<style>
#btn_crear_cotizacion{
	display:none;
}

#div_encabezado_items{
	display:none;
}
</style>
<?php
include('../valotablapc.php');
$sql_numero_cotizacion ="select contador_cotizaciones from $tabla10 ";
$consulta_cot = mysql_query($sql_numero_cotizacion,$conexion);
$arreglo_contador=mysql_fetch_assoc($consulta_cot);
$numero_cot = $arreglo_contador['contador_cotizaciones'] +1;

if(isset($_REQUEST['idcliente']))
		{
		    echo 'se envio el id del cliente';
			$sql_traer_cliente = "select * from $tabla3 where idcliente =  '".$_REQUEST['idcliente']."'  ";
			$consulta_cliente = mysql_query($sql_traer_cliente,$conexion);
			$arreglo_cliente = mysql_fetch_assoc($consulta_cliente);                  
		}
$ancho_tabla= "90%";
$fechapan =  time();
$fechapan = date ( "Y/m/j" , $fechapan );
?>
<body>
<div id = "datos_cotizacion"  >
<table width="<?php echo $ancho_tabla ?>" border="1">
  <tr>
    <td><img src="../logos/autoscad.png" width="162" height="108"></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2" align="center"> FECHA: <?php echo $fechapan; ?>
    <input type="hidden" id="fecha"  name ="fecha" value ="<?php echo $fechapan;  ?>">
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><!--Buscar Empresa
      <input name="casilla_empresa" id="casilla_empresa" type="checkbox" value="1"> -->
	  DIGITE LA PLACA Y LUEGO ENTER
	  </td>
  </tr>
</table>
<div id="buscarcliente">
</div>
<table width="<?php echo $ancho_tabla ?>" border="1">
  <tr>
    <td>Empresa</td>
    <td><input name="empresa" id="empresa" type="text" onfocus="blur();"></td>
	  <td>ID</td>
	    <td colspan="3"><label>
	      <input type="text" name="identi" id="identi" value = "<?php echo $arreglo_cliente['identi']; ?>" onfocus="blur();">
		  <input type="hidden" name="idcliente" id="idcliente" value = "<?php echo $arreglo_cliente['idcliente']; ?>">
	    </label>
       COT No <input type="text" id="no_cotizacion" value= "<?php echo $numero_cot;  ?>" onfocus="blur();">
       <input type="hidden" id="id_cotizacion" name = "id_cotizacion" >
	</td>
  </tr>
	 <tr>
    <td>Direccion</td>
    <td><label>
      <input type="text" name="direccion" id="direccion" value = "<?php echo $arreglo_cliente['direccion']; ?>" onfocus="blur();">
    </label></td>
	  <td>Telefono</td>
	    <td><input type="text" name="telefono" id="telefono" value = "<?php echo $arreglo_cliente['telefono']; ?>" onfocus="blur();"></td>
	    <td>Marca</td>
	    <td><input type="text" name="marca" id="marca" onfocus="blur();" ></td>
    </tr>
	 <tr>
	   <td>Nombre</td>
	   <td><input type="text" name="nombre" id="nombre" value = "<?php echo $arreglo_cliente['nombre']; ?>" onfocus="blur();"></td>
	   <td>Kilome</td>
	   <td><input type="text" name="kilometraje" id="kilometraje" class="fila_llenar"></td>
	   <td>Modelo</td>
	   <td><input type="text" name="modelo" id="modelo" onfocus="blur();"></td>
  </tr>
	 <tr>
	   <td>Mail</td>
	   <td><input type="text" name="email" id="email"  value = "<?php echo $arreglo_cliente['email']; ?>" onfocus="blur();"></td>
	   <td>Color</td>
	   <td><input type="text" name="color" id="color" onfocus="blur();"></td>
	   <td>Placas</td>
	   <td><input  type="text" name="placa" id="placa" class="fila_llenar" placeholder="Placa Y Enter"><input type="hidden" name="idcarro" id="idcarro" ></td>
  </tr>
</table>
	<button id="btn_crear_cotizacion" type ="submit">CREAR COTIZACION</button>
</div>	
<div id="div_encabezado_items">
	<table width="<?php echo $ancho_tabla ?>" border="1">
		<tr>
			<td>ITEM</td>
			<td> R/M</td>
			<td>Codigo</td>
			<td>Descripcion</td>
			<td>Valor</td>
			<td>Cantidad</td>
			<td>Total Item</td>
			<td>ACCION</td>
		</tr>
		<tr>
			<td>ITEM</td>
			<td><select id ="repman" class="fila_llenar">
			<option value ="...">Escojer Tipo</option>
			<option value ="R">REPUESTO</option>
			<option value ="M">MANO DE OBRA</option>
			<option value ="A">ACEITES</option>
			</select>
			</td>
			<td><input type="text" id="codigopan" name = "codigopan" class="fila_llenar" placeholder="CODIGO Y ENTER"></td>
			<td><input type="text" id="descripan"  id="descripan" class="fila_llenar"></td>
			<td><input type="text" id="valor_unit"  name="valor_unit"class="fila_llenar"></td>
			<td><input type="text" id="cantipan" id="cantipan" class="fila_llenar" placeholder="CANTIDAD Y ENTER"></td>
			<td><input type="text" id="totalpan" id="totalpan" onfocus="blur();"></td>
			<td><button type = "button" id = "agregar_item">Agregar</button></td>
		</tr>	
	</table>
	<div id="div_items">
       
	</div>

	<div id="finalizar" align="center">
		<br>
		<button id="finalizar_cotizacion">FINALIZAR COTIZACION</button>
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
						 if($("#kilometraje").val().length < 1)
					        { alert('digite kilometraje ');
					      $(kilometraje).focus();
					          return false;
					         }

						var data ='no_cotizacion=' + $("#no_cotizacion").val();
						data += '&idcarro=' + $("#idcarro").val();
						data += '&fecha=' + $("#fecha").val();
						data += '&kilometraje=' + $("#kilometraje").val();

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
					var data =  'id_cotizacion=' + $("#id_cotizacion").val();;
							$.post('muestre_cotizaciones.php',data,function(a){
							$("#datos_cotizacion").html(a);
								//alert(data);
							});		
						$("#div_encabezado_items").css("display","none");		
						$("#div_items").css("display","none");	

		});

	//////////////////////
    });
</script>

