
<?php

function get_table_assoc($datos)
		{
		 				$arreglo_assoc='';
							$i=0;	
							while($row = mysql_fetch_assoc($datos)){		
								$arreglo_assoc[$i] = $row;
								$i++;
							}
						return $arreglo_assoc;
		}
function draw_table($datos)
					{
					
								echo '<table border = "1">';
									$titulos = array_keys($datos[0]);
										echo '<tr>';
										foreach   ($titulos as $d ) { 
											echo "<td>".strtoupper($d)."</TD>"; 
										} 
										
										
										echo '</tr>';
										foreach   ($datos as $d ) {   
											echo '<tr>';
											foreach   ($d as $r ) {
											echo "<td>$r</TD>";
											}
											echo '</tr>';		
										}
										echo '</table>';

					
					}

// esta funcion la utilizo cuando se va a facturar por esto ya tiene un formato predefinido para que cuadre al momento de mostrar la factura e imprimirla 
function muestre_items($orden,$tabla,$conexion,$id_empresa)
		{
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			echo '<tr>
			     
                <td width="38"><h7>'.$items['codigo'].'</h7></td>
    			<td width="60" colspan = "4"><h7> '.$items['descripcion'].'</h7></td>
				<td width="87"><h7><div align = "right"> '.$items['cantidad'].'</div></h7></td>
    			<td width="82"><h7><div align = "right">'.$items['valor_unitario'].'</div></h7></td>
   			    <td width="85"><h7><div align = "right">'.$items['total_item'].'</div></h7></td>
					</tr>
				';
				//<td width="34">'.$i.'</td>
				$subtotal = $subtotal + $items['total_item'];
			 }
			 return $subtotal; 
		}
///////////////////////////
//function actualizar_inventario()

function maximo_valor($campo,$conexion,$tabla,$idempresa)
		 {
		 		$sql_valor ="select $campo as valor  from $tabla  where id_empresa =  '".$idempresa."'   ";
		 		//echo '<br>'.$sql_valor.'<br>';
		 		$maximo_valor  = mysql_query($sql_valor,$conexion);
		 		$maximo_valor = mysql_fetch_assoc($maximo_valor); 
		  		return $maximo_valor['valor'];
		 } 	

function regimen ($id_empresa,$tabla,$conexion)
		{
				$sql_regimen = "select regimen  from $tabla  where id_empresa = '".$id_empresa."' ";
				//echo '<br>'.$sql_regimen.'<br>';
				$regimen = mysql_query($sql_regimen,$conexion);
				$regimen = mysql_fetch_assoc($regimen);
				return $regimen['regimen']; 

		}

function pasar_items_temporal_definitivo ($numero,$id_orden,$conexion,$tabla_temporal,$tabla_definitiva,$tabla_codigos )
			{
						///////////////////////////////////////
						$sql_traer_items_temporal = "select * from $tabla_temporal   where  no_factura =  '".$numero."'   and id_empresa = '".$_SESSION['id_empresa']."' order by id_item ";
						$consulta_temporal_definitivo = mysql_query($sql_traer_items_temporal,$conexion);
						while($items  =  mysql_fetch_array($consulta_temporal_definitivo))
								{

									//echo '<br>'.$items[3];
									$sql_grabar_items = " insert into $tabla_definitiva   (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado) 
									values ('".$id_orden."','".$items[2]."','".$items[3]."','".$items[4]."','".$items[5]."','".$items[7]."','".$items[8]."','0')";
									$consulta_trasladar_item = mysql_query($sql_grabar_items,$conexion);
									//falta actualizar los valores de inventario;
									//tengo que traer el valor existente en la base 
									$sql_valor_existente = "select codigo_producto,cantidad from $tabla_codigos where codigo_producto =  '".$items[2]."'   and id_empresa = '".$_SESSION['id_empresa']."'    ";	
									//echo '<br>'.$sql_valor_existente;
									$consulta_valor_inventario = mysql_query($sql_valor_existente,$conexion); 
									$valor_actual_inventario = mysql_fetch_assoc($consulta_valor_inventario);
									$valor_final_inventario = $valor_actual_inventario['cantidad']  -  $items[4];
									

									$sql_actualizar_inventario = "update $tabla_codigos set cantidad = '".$valor_final_inventario."'   
											 where codigo_producto = '".$items[2]."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
											
						      		//echo '<br>consulta '.$sql_actualizar_inventario;

									$actualizar_inventario = mysql_query($sql_actualizar_inventario,$conexion);  

									///////////////////


								} // temina el proceso de los items
						///////////////////////////////////////////////////////////
								
						//////////////////////////////////////

								
			}// fin de la funcion pasar_items_temporal_definitivo

 function borrar_items_temporal($numero,$conexion,$tabla_temporal)
           			{
					            $sql_borrar_temporal = "delete from $tabla_temporal where id_empresa = '".$_SESSION['id_empresa']."' and no_factura = '".$numero."' ";
								$consulta_borrar = mysql_query($sql_borrar_temporal,$conexion);	
					}		

////////////////////////////////////////////////////////////////////
function muestre_items_nuevo($orden,$tabla,$conexion,$id_empresa,$resolucion)
		{
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			echo '<tr>
			     
                <td width="38"><div align="center"><h8>'.$items['cantidad'].'</h8></div></td>
    			<td width="60" ><h8> '.$items['descripcion'].'</h7></td>
				<td width="87"><h8><div align = "right"> '.'$'.number_format($items['valor_unitario'], 0, ',', '.').'</div></h8></td>';
				
				 $total_del_item = $items['total_item'];
				if($resolucion == '0')
						{
								//$total_del_item = $items['total_item_con_iva'];
						}	

    			echo '<td width="82"><h8><div align = "right">'.'$'. number_format($total_del_item, 0, ',', '.').'</div></h8></td>';
				if ($items['iva']==1)
						{ $valor_iva = '16'; }
						else {$valor_iva = '0';}
				 echo '<td width="82"><h8><div align = "right">'; 
				 
			    if ($resolucion == 1)		
					{  echo $valor_iva.'%';
					       
						 if ($items['iva']==1) 
						  {
						    echo '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item_con_iva'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							}
						else 	
							{
								echo '</div></h8></td>
   			    		     <td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						    </tr>
						    ';
							}
				    }
				else
					{
					echo '</div></h8></td>
   			    		<td width="85"><h8><div align = "right">'.'$'.number_format($items['total_item'], 0, ',', '.').'</div></h8></td>
						</tr>
						';	
					}			
				//<td width="34">'.$i.'</td>
				if($resolucion =='0')
					{ $subtotal = $subtotal + $total_del_item;}
				else			
					{ $subtotal = $subtotal + $items['total_item'];}
			 }
			 return $subtotal; 
		}


/////////////////////////////////////
////FUNCION ACTUALIZAR INVENTARIO DE RECIBO 

function actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$id_empresa,$id_orden,$conexion)
{
   $sql_nombres_inventario = "select * from $tabla24 where id_empresa = '".$id_empresa."' order by id_nombre_inventario";
   //echo '<br>'.$sql_nombres_inventario.'<br>';
   $consulta_nombres_inventario = mysql_query($sql_nombres_inventario,$conexion);
   while ($nombres_items = mysql_fetch_assoc($consulta_nombres_inventario))
   		{
			//echo 'pasooooooo1';
			//echo '<br>1 '.$nombres_items['id_nombre_inventario'];
			$id_de_nombre = $nombres_items['id_nombre_inventario'];
			//echo '<br>idnombre'.$id_de_nombre;
			$cantidad = 'cantidad_'.$id_de_nombre;
			//echo '<br>cantidad123 '.$cantidad;
			
			$consulta_actualizar_valor_cantidad ="update $tabla25  set   
					valor = '".$_REQUEST[$id_de_nombre]."',
					cantidad = '".$_REQUEST[$cantidad]."'
					where id_nombre_inventario = '".$id_de_nombre."'   
					and id_orden = '".$_REQUEST['id_orden']."' 
					and id_empresa = '".$_SESSION['id_empresa']."' ";
					//echo '<br>'.$consulta_actualizar_valor_cantidad.'<br>';
			$consulta_actulizar_valores = mysql_query($consulta_actualizar_valor_cantidad,$conexion);		
		}// fin del while 
   
   

}// fin de la funcion de actualizar_inventario_estado_vehiculo

/////////////////////////////////////
////funcion pintar inventario 


function pintar_inventario_estado_vehiculo($tabla24,$tabla25,$id_empresa,$id_orden,$conexion,$ancho_tabla)
{
	$sql_nombres_items_inventarios = "
select * from $tabla25 r
inner join $tabla24 ic on (r.id_nombre_inventario = ic.id_nombre_inventario)
where 1=1  and  r.id_empresa = '".$id_empresa."'
and r.id_orden = '".$id_orden."'
order by r.id_relacion_orden_inventario
";
   //echo '<br>--------------------'.$sql_nombres_items_inventarios.'<br>';
   $consulta_nombres_inventario = mysql_query($sql_nombres_items_inventarios,$conexion);
   
   	$consulta_nombres_items = mysql_query($sql_nombres_items_inventarios,$conexion);
	$filas_nombres_items = mysql_num_rows($consulta_nombres_items);
	$nombres2_items = get_table_assoc($consulta_nombres_items);
   
   $ancho_inventario = $ancho_tabla -5;
	//echo '<table border = "1" width = "'.$ancho_inventario.'" > ';
	echo '<tr><td colspan = "6" align ="center"><strong>INVENTARIO</strong></td></tr>';
	echo '<tr>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	echo '<td></td>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	echo '<td></td>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	echo '</tr>';
    $items_por_columna = $filas_nombres_items/3;
	$contador = 0 ;
	
	while($contador <  $items_por_columna )
	{
		echo '<tr>';
		echo '<td>';
		echo $nombres2_items[$contador]['nombre'];
		echo '</td>';
		echo '<td>';
		echo '<input type="text"  name = "otro1" id = "otro1" value =" " size="2"> '; 
		echo '<input type="text"  name = "otro"  id = "otro" value =" " size="2"> ';		
		echo '</td>';
		echo '<td>';
		echo '</td>';


		$segunda_fila = $contador + $items_por_columna;
		echo '<td>'.$nombres2_items[$segunda_fila]['nombre'].'</td>';
			echo '<td>';
		echo '<input type="text"  name = "otro11" id = "otro11" value =" " size="2"> '; 
		echo '<input type="text"  name = "otro0"  id = "otro0" value =" " size="2"> ';
		echo '</td>';
		
		echo '<td>';
			echo '</td>';
		
		//////tercera parte 
		$tercera_fila = $contador + ($items_por_columna*2);
		echo '<td>'.$nombres2_items[$tercera_fila]['nombre'].'</td>';
			echo '<td>';
		echo '<input type="text"  name = "otro111" id = "otro111" value =" " size="2"> '; 
		echo '<input type="text"  name = "otro00"  id = "otro00" value =" " size="2"> ';
		echo '</td>';
		
		echo '<td>';
			echo '</td>';
		////////////////////
		echo '</tr>';
		$contador++;
		
		
		
	} // fin del while 
  //echo '</table>';
}// fin de la funcion de actualizar_inventario_estado_vehiculo

/////////////////////

/////////////////////

function suma_items_local($orden,$tabla,$conexion,$id_empresa)
		{
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
				

				
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			/*
				echo '<tr>
			     
                <td >'.$items['codigo'].'</td>
    			<td  > '.$items['descripcion'].'</td>
				<td align="center"> '.$items['cantidad'].'</td>
    			<td align="right">'.$items['valor_unitario'].'</td>
   			    <td align="right">'.$items['total_item'].'</td>
					</tr>
				';
				*/
				//<td width="34">'.$i.'</td>
				$subtotal = $subtotal + $items['total_item'];
			 }
			
			 return $subtotal; 
		}
//////////////////////
?>