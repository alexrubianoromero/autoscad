<?php
function mostrar_items($factupan)
				{		
					
						//$db="prueba_facturacion";
						include('../valotablapc.php');
						include_once('../funciones.php');
						//echo '<br> valor de factupan.<br>'.$factupan;
						$sql_mostrar_items ="select * from $tablaitemfacinv where no_factura = '".$factupan."'";

						$consulta_mostrar_item  = mysql_query($sql_mostrar_items,$conexion);

						$numero_filas = mysql_num_rows($consulta_mostrar_item);
						echo '<br>';
						echo '<table border = 1 width = "75%">';
						echo '<tr>';
						echo '<td>	ITEM... </td>';
						echo '<td>	CODIGO </td>';
						echo '<td>	DESCRIPCION </td>';
						echo '<td>	CANTIDAD</td>';
						echo '<td>	VALOR</td>';
						echo '<td>	ACCION..</td>';
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
							  echo '<input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "'.$d['id_item'].'"  >';
							  echo '<td><button type = "button" id = "eliminar" class="eliminar" value = "'.$d['id_item'].'" > Eliminar Item</button></td>';
							  echo '</tr>';
							  $total_remision = $total_remision + $d['total_item'];
							  $num++;
							  }
							  echo '<tr><td></td><td></td><td></td><td>TOTAL</td><td>'.$total_remision.'</td></tr></table>';
						}// fin del if numero filas >0 

				}// fin de la funcion 
?>
