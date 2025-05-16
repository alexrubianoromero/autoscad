<?php
session_start();

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/
include('../valotablapc.php');

if ($_POST['radio']== 'undefined'){$_POST['radio'] = 0;}
if ($_POST['antena']== 'undefined'){$_POST['antena'] = 0;}
if ($_POST['repuesto']== 'undefined'){$_POST['repuesto'] = 0;}
if ($_POST['herramienta']== 'undefined'){$_POST['herramienta'] = 0;}



$sql_grabar_orden = "insert into $tabla14 (orden,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros,
	iva,id_empresa,estado,kilometraje,mecanico,tipo_orden,kilometraje_cambio) 
values (
'".$_POST['orden_numero']."',
'".$_POST['placa']."',
'".$_POST['clave']."',
'".$_POST['fecha']."',
'".$_POST['descripcion']."',
'".$_POST['radio']."',
'".$_POST['antena']."',
'".$_POST['repuesto']."',
'".$_POST['herramienta']."',
'".$_POST['otros']."',
'16',
'".$_SESSION['id_empresa']."',
'0',
'".$_POST['kilometraje']."',
'".$_POST['mecanico']."',
'1',
'".$_POST['kilometraje_cambio']."'
)";
// el  que se graba en tipo_orden de ordenes indica que es una orden normal 
//porque cuando se graba una venta ya se indica un tipo de orden 2 
//esto para evitar confucion entre un numero de orden normal y un numero de orden de venta que se crea con el numero de factura
//echo '<br>'.$sql_grabar_orden;

$consulta_grabar = mysql_query($sql_grabar_orden,$conexion); 
$sql_actualizar_contaor = "update $tabla10 set  contaor = '".$_POST['orden_numero']."'  where   id_empresa = '".$_SESSION['id_empresa']."' "; 
$consulta = mysql_query($sql_actualizar_contaor,$conexion);


//ahora se debe actulizar el numero del consecutivo del campo contaor de  la tabla empresa 
//ahora despues de grabar la orden con el consecutivo que se trae de empresa 
///se debe actualizar el numero del id de la orden para los items creados para que los items queden bien creados con el numero del id de la orden
$sql_traer_id_orden = "select max(id) as id  from $tabla14 where placa = '".$_POST['placa']."'   and id_empresa = '".$_SESSION['id_empresa']."'  ";
//echo '<br>'.$sql_traer_id_orden;
$consulta_id_orden = mysql_query($sql_traer_id_orden,$conexion);
$id_orden = mysql_fetch_assoc($consulta_id_orden);
/*
echo '<pre>';
print_r($id_orden);
echo '</pre>';
*/

//echo "<br>id orden asignado= ".$id_orden['id'];
//despues de obtener el id vamoa a actulizarlo para los items de la orden  osea lo reemplazamos para todos los items que 
//tengan el numero de la orden $_POST['orden_numero']  ny de la empresa respectiva y les colocamnos el id de la orden   en el campo no_factura porque  como el programa 
//es multicliente la idea es que todos los clientes tendras su numeroacion de ordenes y de facturas pero el progrma se basara en los id respectivos

/*
$sql_actualizar_id_orden_item = "update $tabla15  set     no_factura = '".$id_orden['id']."'  where   no_factura = '".$_POST['orden_numero']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo '<br>'.$sql_actualizar_id_orden_item;
$consulta_actualizar_items = mysql_query($sql_actualizar_id_orden_item,$conexion) ;
*/
///////////////////////////////////////////////////////// TRANSLADAR ITEMS DE TEMPORAL A DEFINITIVO
////CONSULTA PARA TRAER LOS ITEMS DE TEMPORAL Y LUEGO CON UN CICLO LOS VAMOS GUARDANDO UNO A UNO EN LA UBICACION DEFINITIVA

$sql_traer_items_temporal = "select * from $tabla18    where  no_factura =  '".$_POST['orden_numero']."'   and id_empresa = '".$_SESSION['id_empresa']."' order by id_item ";
$consulta_temporal_definitivo = mysql_query($sql_traer_items_temporal,$conexion);
while($items  =  mysql_fetch_array($consulta_temporal_definitivo))
		{

			//echo '<br>'.$items[3];
			$sql_grabar_items = " insert into $tabla15   (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado) 
			values ('".$id_orden['id']."','".$items[2]."','".$items[3]."','".$items[4]."','".$items[5]."','".$items[7]."','".$items[8]."','0')";
			$consulta_trasladar_item = mysql_query($sql_grabar_items,$conexion);
			//falta actualizar los valores de inventario;
			//tengo que traer el valor existente en la base 
			$sql_valor_existente = "select codigo_producto,cantidad from $tabla12 where codigo_producto =  '".$items[2]."'   and id_empresa = '".$_SESSION['id_empresa']."'    ";	
			//echo '<br>'.$sql_valor_existente;
			$consulta_valor_inventario = mysql_query($sql_valor_existente,$conexion); 
			$valor_actual_inventario = mysql_fetch_assoc($consulta_valor_inventario);
			
/*
			echo '<pre>';
			print_r($valor_actual_inventario);
			echo '</pre>';	
			*/
	// echo '<br>cantidad base'.$valor_actual_inventario['cantidad'];
  // echo '<br>cantidad item '.$items[4];


			$valor_final_inventario = $valor_actual_inventario['cantidad']  -  $items[4];
			$sql_actualizar_inventario = "update $tabla12 set cantidad = '".$valor_final_inventario."'   
					 where codigo_producto = '".$items[2]."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
					
      //echo '<br>consulta '.$sql_actualizar_inventario;

					$actualizar_inventario = mysql_query($sql_actualizar_inventario,$conexion);  
		} // temina el proceso de los items
///////////////////////////////////////////////////////////
		
		
////////////////////////////////////////////////////////
		///////////////////////hay que borrar la tabla temporal 
		$sql_borrar_temporal = "delete from $tabla18 where id_empresa = '".$_SESSION['id_empresa']."' ";
		$consulta_borrar = mysql_query($sql_borrar_temporal,$conexion);
//////////////////////////////////////////////////////////////
////////ahora para las ordenes de renault debo guardar los valores adicionales de los inventarios 
////////traemos el numero de items adicionales de la empresa 
/////revisamos los datos de la empresa 

$sql_datos_empresa = "select ruta_imagen,nombre,tipo_taller,identi,telefonos,direccion from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_datos_empresa,$conexion);
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
$sql_nombres_items_inventarios = "select * from $tabla24  where decarroomoto = '".$datos_empresa['tipo_taller']."'   and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo 'consulta<br>'.$sql_nombres_items_inventarios.'<br>';
$consulta_nombres_items = mysql_query($sql_nombres_items_inventarios,$conexion);
$filas_nombres_items = mysql_num_rows($consulta_nombres_items);
//$nombres2_items = get_table_assoc($consulta_nombres_items);
$contador = 0;
//$id_orden['id'];
//echo 'pasooooo11111111111111111111111';
while ($nombres2_items = mysql_fetch_assoc($consulta_nombres_items))
{
	//echo 'pasooooo11111111111111111111111';
	//echo '<br>'.$nombres2_items['nombre'];
	$id_item = $nombres2_items['id_nombre_inventario'];
	//echo '<br>valor del id_item'.$id_item.'fin de valor ';

				//echo '<br>id_nombre_inventario'.$nombres2_items['id_nombre_inventario'].'valor  de post en id_item'.$_POST[$id_item];
				
				$sql_grabar_item_inventario = "insert into $tabla25 
				(id_empresa,id_orden,id_nombre_inventario,valor) 
				values ('".$_SESSION['id_empresa']."','".$id_orden['id']."','".$id_item."','".$_POST[$id_item]."')";
				//echo '<br>la consulta'.$sql_grabar_item_inventario.'<br>';
				//echo '<br>123post'. $_POST[$id_item].'valor del nombre'.$nombres2_items['nombre'];
				// si existe este itemen el post pues grabelo en la tabla  de relacion de orden con el inventario
				$consulta_grabar_valores_items = mysql_query($sql_grabar_item_inventario,$conexion);
				
			
}//// fin de while ($contador <  $filas_nombres_items)
//////////////////////////////////////////////////////////////////	
			
		
echo "<br><br><br>ORDEN No ".$_POST['orden_numero']."   GRABADA";
echo "<br><a href='../menu_principal.php' >Pagina Principal</a>";
echo "<br><a href='index.php' >Menu Ordenes</a>";
//<a href="#">#</a>
?>