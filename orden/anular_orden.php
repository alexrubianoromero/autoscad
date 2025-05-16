<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php
/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
*/
include('../valotablapc.php');


///////////////////////////////////////////////////
$sql_anular_orden = "update $tabla14 set anulado = '1' ,estado = '3' where id = '".$_GET['id_orden']."'   ";
//$consulta_anular= mysql_query($sql_anular_orden,$conexion);
$consulta_anular_orden = mysql_query($sql_anular_orden,$conexion);

//// ahora los items hay que reversarlos 
////  tener en cuenta que en los totales solamente se tienen en cuenta las ordenes que no este anuladas y en general para todo 
$sql_anular_items_orden = "update  $tabla15 set anulado = '1'   where no_factura = '".$_GET['id_orden']."'   ";
$consulta_nular_items = mysql_query($sql_anular_items_orden,$conexion);

//devolver los valores de inventario cuando se anule la orden 
//%tabla15 es itemorden 
$sql_traer_items_orden = "select * from $tabla15  where no_factura = '".$_GET['id_orden']."'   ";
$consulta_items = mysql_query($sql_traer_items_orden,$conexion);
$numero_de_items = mysql_num_rows($consulta_items);
if($numero_de_items > 0)
{
	recorre_items_devuelve_cantidad($consulta_items,$conexion,$tabla12);
} 
/////////////////
echo '<h1>ORDEN_ANULADA</h1>';
echo '<br>';
include('../colocar_links2.php');

/////////////////////////////////////////////

function recorre_items_devuelve_cantidad ($consulta_items,$conexion,$tabla12)
{
			
		while ($items = mysql_fetch_assoc($consulta_items))
		{
							
			echo '<br>'.$items[1];
			if ($items['codigo']== '9999')
				{ 				    
				//no se realiza accion 
				}
			else {
					//tabla12 es productos 
					$consulta_traer_valor_actual_item = "select id_codigo,codigo_producto,cantidad  from $tabla12   where codigo_producto = '".$items['codigo']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
					$consulta_cantidad_actual = mysql_query($consulta_traer_valor_actual_item,$conexion);
					$cantidad_actual = mysql_fetch_assoc($consulta_cantidad_actual);
					$cantidad_actual = $cantidad_actual['cantidad'];
					//echo '<br>cantidad_actual'.$cantidad_actual;
					$nueva_cantidad = $cantidad_actual + $items['cantidad'];
					$actualizar_cantidad = "update  $tabla12 set  cantidad = '".$nueva_cantidad."'    where   codigo_producto = '".$items['codigo']."'  and id_empresa = '".$_SESSION['id_empresa']."' ";
					 $consulta_devolver_producto = mysql_query($actualizar_cantidad,$conexion);
					 //faltaria colocar tambien anulado los items_orden  
									
				}	
							
							
		} // fin del ciclo que recorre los items de la orden	
}// fin de la funcion de recorre_items

?>
</body>
</html>
