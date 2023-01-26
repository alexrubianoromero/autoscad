<?php
session_start();
//$idorden = '124';
include('../valotablapc.php');  
//include('../funciones.php'); 
//echo '<br>orden '.$idorden;
$sql_items_orden = "select * from $tabla15 where no_factura = '".$idorden."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);
$traer_iva = "select iva from $tabla17 ";
$consulta_iva = mysql_query($traer_iva); 
$iva = mysql_fetch_assoc($consulta_iva);
$iva = $iva['iva'];

$sql_retefuente = "select * from $tabla20";
$consulta_iva = mysql_query($sql_retefuente,$conexion);
$datos_retefuente = mysql_fetch_assoc($consulta_iva);

//echo '<br>'.$datos_retefuente['porcentaje'].' '.$datos_retefuente['monto_minimo'];
//exit();
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="./js/jquery.js" type="text/javascript"></script>
</head>
<body>
<div id = "div_items">
<?php	
		//echo '<form name = "formu"  method ="post"  action = "mostrar_arreglo.php"> ';
		echo '<input type = "hidden"  name = "iva"  id = "iva"  value = "'.$iva.'"   >';
		echo '<input type = "hidden"  name = "idorden"  id = "idorden"  value = "'.$idorden.'"   >';
		echo '<table border = "1"   width ="95%">';
		echo '<tr><td><h8>CANT.</h8></td><td><h8>DESCRIPCION</h8></td><td><h8>PRECIO UNI</h8></td><td><h8>PRECION TOTAL </h8></td><td><h8>IVA</h8></td>
		<td><h8>TOTAL </h8></td></tr>'	;
		$i = 0;			 
		$subtotal_factura = 0;
		$suma_total_iva = 0;
		$total_final_factura = 0;
		while($items = mysql_fetch_array($consulta_items))
			{
				//$items_finales[$i][]=$items[1];  
				//$items_finales[$i][]=$items[3];  
				
				
				//echo '<br>posicion <br>'.$items_finales[$i][0];
				//echo '<br>items_finales '.$items_finales[0];
				echo '<tr>';
				echo '<td>';
				echo '<input type = "hidden"  name = "id_item_'.$i.'"  id = "id_item_'.$i.'"  value = "'.$items[1].'"   >';
				echo $items[4];
				echo '</td>';
				echo '<td>'.$items[3].'</td>';
				echo '<td>'.$items[7].'</td>';
				echo '<td>'.$items[5].'</td>';
				if($items[10]=='1')
				  { $valor_porcentaje_iva = $iva;  }
				else   
					{ $valor_porcentaje_iva = 0;  }
					
				echo '<td> <input type = "text"  id = "porcentaje_'.$i.'" name = "porcentaje_'.$i.'"  value =  "'.$valor_porcentaje_iva.'"   ></td>';
				
				$valor_iva =  ($items[5]* $valor_porcentaje_iva)/100;
				$valor_total_con_iva = $items[5] + $valor_iva;
				echo '<td>'.$valor_total_con_iva.'</td>';
				echo '</tr>';
				$subtotal_factura = $subtotal_factura + $items[5];
				$suma_total_iva = $suma_total_iva + $valor_iva ;
				$i++;
			} 		
		echo '<input type ="hidden" name = "control" id = "control"  value = "'.$i.'">';	
		
	
	
		?>
	<table width="95%" border="1">
  <tr>
    <td width="62%">&nbsp;</td>
    <td width="18%"><h8>Subtotal</h8></td>
    <td width="15%" ><h8><input type = "text" nombre = "subtotal_factura"  id = "subtotal_factura"    value= "<?php echo $subtotal_factura ?>"   onfocus="blur()"></h8></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><h8>Iva</h8></td>
    <td ><h8><input type = "text" nombre = "suma_total_iva"  id = "suma_total_iva"    value= "<?php echo $suma_total_iva ?>"   onfocus="blur()"></h8></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><h8>Retefuente</h8></td>
	<?php  if($subtotal_factura > $datos_retefuente['monto_minimo'] && $suma_total_iva > 0 ) 
				{
					$valor_retefuente = ($subtotal_factura * $datos_retefuente['porcentaje']  )/100;
				}
			else {   $valor_retefuente = 0;   }
	  ?>
    <td ><h8><input type = "text" nombre = "valor_retefuente"  id = "valor_retefuente"    value= "<?php echo $valor_retefuente ?>" onfocus="blur()" ></h8></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Total</td>
	<?php  $total_final_factura = ($subtotal_factura +  $suma_total_iva) -$valor_retefuente;   ?>
    <td ><h8><input type = "text" nombre = "total_final_factura"  id = "total_final_factura"    value= "<?php echo $total_final_factura?>"   onfocus="blur()"></h8></td>
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
									$("#exispan").val(b[0].existencias);
									$("#cantipan").val('');
									$("#cantipan").focus();
									$("#totalpan").val(0);
							 //(data1);
							},
							'json');
					}// fin del if 		
			   });//finde codigopan
			  
				/////////////////////////////////	
						$("#agregar_item").click(function(){
							var data =  'codigopan =' + $("#codigopan").val();
							data += '&descripan=' + $("#descripan").val();
							data += '&valor_unit=' + $("#valor_unit").val();
							data += '&cantipan=' + $("#cantipan").val();
							data += '&totalpan=' + $("#totalpan").val();
							data += '&exispan=' + $("#exispan").val();
							data += '&orden_numero=' + $("#orden_numero").val();
							$.post('procesar_items.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
					//////////////////////////////////
					$("#recalcular_items").click(function(){
							//var data =  'orden_numero=' + $("#orden_numero").val();
							var data =  'id_item_0=' + $("#id_item_0").val();
							data += '&id_item_1=' + $("#id_item_1").val();
							data += '&id_item_2=' + $("#id_item_2").val();
							data += '&id_item_3=' + $("#id_item_3").val();
							data += '&id_item_4=' + $("#id_item_4").val();
							data += '&id_item_5=' + $("#id_item_5").val();
							data += '&id_item_6=' + $("#id_item_6").val();
							data += '&id_item_7=' + $("#id_item_7").val();
							data += '&porcentaje_0=' + $("#porcentaje_0").val();
							data += '&porcentaje_1=' + $("#porcentaje_1").val();
							data += '&porcentaje_2=' + $("#porcentaje_2").val();
							data += '&porcentaje_3=' + $("#porcentaje_3").val();
							data += '&porcentaje_4=' + $("#porcentaje_4").val();
							data += '&porcentaje_5=' + $("#porcentaje_5").val();
							data += '&porcentaje_6=' + $("#porcentaje_6").val();
							data += '&porcentaje_7=' + $("#porcentaje_7").val();
							data += '&control=' + $("#control").val();
							data += '&iva=' + $("#iva").val();
							data += '&idorden=' + $("#idorden").val();
							
							//data += '&items_finales=' + $("#id_item_2").val();
							
							$.post('preparar_items_factura_final.php',data,function(a){
							$("#div_items").html(a);
								//alert(data);
							});	
						 });
					///////////////////////////////////
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
							////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
</script>


