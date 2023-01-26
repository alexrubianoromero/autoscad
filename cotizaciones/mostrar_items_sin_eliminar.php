<?php

function mostrar_items_sin_eliminar($factupan)

				{		

					
						$ancho_tabla= "90%";
						//$db="prueba_facturacion";

						include('../valotablapc.php');

						include_once('../funciones.php');

						//echo '<br> valor de factupan.<br>'.$factupan;

						$sql_mostrar_items ="select * from $item_orden_cotizaciones where no_factura = '".$factupan."'  
						order by repman desc ,id_item asc
						";



						$consulta_mostrar_item  = mysql_query($sql_mostrar_items,$conexion);



						$numero_filas = mysql_num_rows($consulta_mostrar_item);

						echo '<br>';

						echo '<table width="'.$ancho_tabla.'" border="1">';

						echo '<tr>';

						echo '<td>	ITEM </td>';

						echo '<td>	REP/MAN </td>';

						echo '<td>	DESCRIPCION </td>';
						echo '<td>	VALOR</td>';

						echo '<td>	CANTIDAD</td>';

						echo '<td>	VALOR</td>';

						//echo '<td>	ACCION..</td>';

						$subtotal_remision =0;

						$total_remision = 0;

						
						$suma_manos_obra =0;
						$suma_repuestos=0;
						$suma_aceites=0;


						if ($numero_filas > 0 )
						{
							$datos = get_table_assoc($consulta_mostrar_item);
							$num = 1;
							foreach ($datos as $d)

							{

							echo '<tr>';

								echo '<td>'.$num.'</td>';
								echo '<td>'.$d['repman'].'</td>';
							  // echo '<td>'.$d['codigo'].'</td>';

							  echo '<td>'.$d['descripcion'].'</td>';
							  echo '<td align="right" >'.$d['valor_unitario'].'</td>';

						
							  echo '<td align="center">'.$d['cantidad'].'</td>';

							  echo '<td align="right">'.$d['total_item'].'</td>';

							  echo '<input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "'.$d['id_item'].'"  >';

							  //echo '<td><button type = "button" id = "eliminar" class="eliminar" value = "'.$d['id_item'].'" > Eliminar Item</button></td>';


							  echo '<input type="hidden" id="factupan" value="'.$factupan.'">';
							  echo '</tr>';
							  if($d['repman']=='M')
							  	{$suma_manos_obra =$suma_manos_obra + $d['total_item'];}
							     if($d['repman']=='A')
							  	{$suma_aceites =$suma_aceites + $d['total_item'];}

							   if($d['repman']=='R')
							  	{$suma_repuestos =$suma_repuestos + $d['total_item'];}

							


							    $subtotal_remision = $subtotal_remision + $d['total_item'];

							  $num++;

							  }
							  $suma_repuestos_y_aceites  = $suma_repuestos + $suma_aceites;
							  $suma_repuestos_manos_obra_sin_aceite  =  $suma_repuestos + $suma_manos_obra;
							  $total_iva = ($suma_repuestos_manos_obra_sin_aceite * 19)/100;
							  $total_remision = $subtotal_remision+ $total_iva;
							  //echo '<tr><td></td><td></td><td></td><td>TOTAL</td><td>'.$total_remision.'</td></tr></table>';
							  echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
							  echo '<tr><td></td><td></td><td></td><td></td><td>Subtotal Manos de Obra</td><td align="right">'.$suma_manos_obra.'</td></tr>';
							  echo '<tr><td></td><td></td><td></td><td></td><td>Subtotal Repuestos</td><td align="right">'.$suma_repuestos_y_aceites.'</td></tr>';
							  
							   echo '<tr><td></td><td></td><td></td><td></td><td>Total Iva</td><td align="right">'.$total_iva.'</td></tr>';
							  echo '<tr><td></td><td></td><td></td><td></td><td>TOTAL</td><td align="right">'.$total_remision.'</td></tr></table>';
							  
							  /*echo '<br>Subtotal Repuestos'.$suma_repuestos;
							  echo'<br>Subtotal Manos de Obra '.$suma_manos_obra;
							  echo '<br>Subtotal General'.$total_remision;
							  */
							  echo '</table>';
						}// fin del if numero filas >0 



				}// fin de la funcion 

?>


<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../jquery-2.1.1.js"></script>  
<script src="jquery-2.1.1.js"></script>   
<script>
  $(document).ready(function(){
$("#prueba").click(function(){
		 alert('asdasdadasdadas');
		});
  //////////////////////////////
	$(".eliminar").click(function(){

			

							var data =  'eliminar=' + $(this).attr('value');
							data += '&id_cotizacion=' + $("#factupan").val();

							$.post('eliminar_items_cotizacion.php',data,function(a){

								$("#div_items").html(a);

								//alert(data);

							});	

						 });
  //////////////////////////
    });
</script>
