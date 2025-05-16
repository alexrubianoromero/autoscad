<?php
function mostrar_items_temporal($factupan)
				{		
					
						//$db="prueba_facturacion";
						include('../valotablapc.php');
						include_once('../funciones.php');
						$sql_mostrar_items ="select * from $tabla18 where no_factura = '".$factupan."' and id_empresa =  '".$_SESSION['id_empresa']."' ";

						$consulta_mostrar_item  = mysql_query($sql_mostrar_items,$conexion);

						$numero_filas = mysql_num_rows($consulta_mostrar_item);
						//echo '<br>numero de items =<br>'.$numero_filas;
						echo '<br>';
						echo '<table border ="1" width = "75%">';
						echo '<tr>';
						echo '<td>	ITEM </td>';
						echo '<td>	CODIGO </td>';
						echo '<td>	DESCRIPCION </td>';
						echo '<td>	CANTIDAD</td>';
						echo '<td>	VALOR</td>';
						echo '<td>	ACCION</td>';
						echo '</tr>';
						$total_remision = 0;
						
						
						if ($numero_filas > 0 )
						{
							$datos = get_table_assoc($consulta_mostrar_item);
							$num = 1;
							foreach ($datos as $d)
							{
							echo '<tr>';
									echo '<td>'.$num.'</td>';
							  		echo '<td>'.$d['codigo'].'</td>';
							  		echo '<td>'.$d['descripcion'].'</td>';
							  		echo '<td>'.$d['cantidad'].'</td>';
							  		echo '<td>'.$d['total_item'].'</td>';
							  		echo '<td><button type = "button" id = "eliminar" class="eliminar" value = "'.$d['id_item'].'" > Eliminar Item</button></td>';
							  echo '</tr>';
							  $total_remision = $total_remision + $d['total_item'];
							  $num++;
							  }
							  echo '<tr><td></td><td></td><td></td><td>TOTAL.</td><td>'.$total_remision.'</td></tr></table>';
						}// fin del if numero filas >0 

				}// fin de la funcion 
?>

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
			
			$(".eliminar").click(function(){
			
							var data =  'eliminar =' + $(this).attr('value');
							$.post('eliminar_items_temporal.php',data,function(a){
								$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
            });	
			
			function prueba(codigo)
			{
				alert(codigo);
			}
</script>			
