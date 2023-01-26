<?php
session_start();
$fechapan = date ( "Y/m/j");
include('../valotablapc.php');  
include('../funciones.php'); 
/*
echo 'asdasdasasdas<pre>';
print_r($_POST);
echo '</pre>';
echo 'paso 1111111';
*/
// se debe crear la orden en la tabla de ordenes y grabar los items el la tabla de items bajo el id de la orden 
//se puede crear la factura y luego la orden  numero de la factura 

// grabar factura 
//por el momento la factura se guarda facturas solo de empresas de regimen simplificado
// despues se debe cuadrar para las empresas de regimen comun porque ya implica que se afecta el numero de la factura 
//en este omento todas las facturas de venta quedan con el consecutivo de cotizaciones no se cobra iva  

//sumar el valor de los items 
$sql_suma_items = "select sum(total_item) as  total from $tabla18 where no_factura = '".$_POST['factupan']."' and id_empresa = '".$_SESSION['id_empresa']."'  ";

$suma_items = mysql_query($sql_suma_items,$conexion);

$total_items = mysql_fetch_assoc($suma_items);
$sumaitems = $total_items['total'];
//////////////////////echo '<br>qweqweqweqwqwqweqwtotal '.$total_items;
///creacion de la factura 
//el campo reolusion indica si es factura con iva  en este caso se creara con vlor cero no es con iva 
$resolucion = 0;
//tambien se inicializan los valores relacionados con el iva 
$valor_iva = 0;
$valor_retefuente = 0;
//en placa se puede guaardar el id del cliente 

$valor_total = $sumaitems + $valor_iva;
$sql_crear_factura = "insert into $tabla11 (numero_factura,fecha, sumaitems,id_empresa,resolucion,placa,valor_iva,total_factura,valor_retefuente,
	elaborado_por,tipo_factura)
 values (
 '".$_POST['factupan']."','".$fechapan."','".$sumaitems."','".$_SESSION['id_empresa']."','".$resolucion."'
 ,'".$_POST['idcliente']."'
  ,'".$valor_iva."'
  ,'".$valor_total."'
  ,'".$valor_retefuente."'
   ,'".$_POST['elaborado_por']."',
   '2'
 )"; 
 $crear_factura = mysql_query($sql_crear_factura,$conexion); 

 //el numero 2 es porque es factura de venta 
//queda pendiente despues de crear la orden traer el id de la orden para colocarselo a la factura 
//////////////echo '<br>slq crear factura <br>'.$sql_crear_factura;
// al eliminra los itesm de temporal solo se deben eliminar los de idempresa del usuario 
// se debe actulizar el cotador de contacot de la empresa 
$sql_actualizar_contacot = "update $tabla10 set contacot = '".$_POST['factupan']."'   where id_empresa = '".$_SESSION['id_empresa']."'   ";
$con_actulizar_contacot = mysql_query($sql_actualizar_contacot,$conexion);
//traer el id de la factura 
$sql_traer_id_factura = "select max(id_factura) as id_factura   
from $tabla11 where id_empresa = '".$_SESSION['id_empresa']."'  and  sumaitems = '".$sumaitems."' and  numero_factura = '".$_POST['factupan']."' 
and tipo_factura = '2'  ";
$id_factura = mysql_query($sql_traer_id_factura,$conexion); 
$id_factura = mysql_fetch_assoc($id_factura);
$id_factura = $id_factura['id_factura'];
$numero_orden = 'V'.$id_factura;
//echo 'id factura <br>'.$id_factura;
//se le colca una V al id de la factura para grabarlo en la orden para diferenciarlo del numero de orden normal 
//crear la orden tener en cuenta que la rden debe quedar con estado ya facturada 

$sql_grabar_orden = "insert into $tabla14 (orden,fecha,
id_empresa,estado,tipo_orden,factura) 
values (
'".$numero_orden."',
'".$fechapan."',
'".$_SESSION['id_empresa']."',
'1',
'2',
'".$id_factura."'
)";
//echo '<br>slq crear orden  <br>'.$sql_grabar_orden;
//se graba el numero de la orden 
$consulta_grabar_orden  = mysql_query($sql_grabar_orden,$conexion); 

//tipo de orden 2 porque es factura de venta que crea una orden 
//estao 1 porque es una orden ya facturada 
//en el campo de factura de la orden se almacena el id de la factura 

// ahora debemos tomar el numero del id de la orden y agregarselo a la factura 
$sql_id_orden = "select max(id) as id  from $tabla14  where  orden  =  '".$numero_orden."'  
and   factura  = '".$id_factura."'  and  id_empresa = '".$_SESSION['id_empresa']."'  and tipo_orden = '2' ";
$consulta_taer_id = mysql_query($sql_id_orden,$conexion);
$id_orden = mysql_fetch_assoc($consulta_taer_id);
$id_orden = $id_orden['id'];
///////////////////echo '<br> id de la orden '.$id_orden;

// ahora colocar este id de la orden a la factura 
$sql_colocar_id_orden = "update $tabla11  set  id_orden = '".$id_orden."'  where id_factura = '".$id_factura."'    ";

$consulta_actualizar_id =  mysql_query($sql_colocar_id_orden,$conexion);

//ahora se deben pasar los items de la tabla temporal a la tabla  item_orden 
$pasar = pasar_items_temporal_definitivo($_POST['factupan'],$id_orden,$conexion,$tabla18,$tabla15,$tabla12);
$borrar= borrar_items_temporal($_POST['factupan'],$conexion,$tabla18);

////////////////////////////////////////////////////////////////////////////////////////////////////registrar movimientos 
////////////////////////////////////
////ahora se deben registrar los movimientos de inventario en la tabla de movimientos 
///primero se deben traer los items respectivos de la factura 

$sql_traer_items_factura = "select * from $tabla15 where no_factura = '".$id_orden."' and id_empresa = '".$_SESSION['id_empresa']."' "; 
$consulta_items = mysql_query($sql_traer_items_factura,$conexion);
while($items_factura = mysql_fetch_array($consulta_items)) 
		{
		    //conseguir el id del codigo del producto se busca con el codigo y la empresa en productos
			$sql_id_producto = "select  p.id_codigo  from $tabla15 as i
			inner join $tabla12 as p on (i.codigo = p.codigo_producto)
			inner join $tabla11 as f on (f.id_orden = i.no_factura)
			where p.codigo_producto = '".$items_factura[2]."' 
			and p.id_empresa =  '".$_SESSION['id_empresa']."'
			and i.no_factura = '".$id_orden."'
			";
			
			//echo '<br>'.$sql_id_producto;
			
			$consulta_id_producto  = mysql_query($sql_id_producto,$conexion);
			$id_producto = mysql_fetch_assoc($consulta_id_producto);
			/*
			echo '<pre>';
			print_r($id_producto);
			echo '</pre>';
			*/
			
			//echo '<br>'.$items_factura[0] ;
			$sql_registrar_movimiento = "insert into $tabla19 (fecha_movimiento,cantidad,observaciones,tipo_movimiento,id_factura_venta,id_empresa,id_codigo_producto)     
			values ('".$fechapan."','".$items_factura[4]."','Salida_Inventario','3','".$id_factura."','".$_SESSION['id_empresa']."','".$id_producto['id_codigo']."' ) ";
			//echo '<br>'.$sql_registrar_movimiento;
			$consulta_registrar_movimiento = mysql_query($sql_registrar_movimiento,$conexion) ;
			
		}
///////////////////////////////////
///////////////////////////////////////////
echo "<br><br><br><h2>FACTURA CREADA</h2>";
echo "<br><a href='../facturas/factura_imprimir.php?id_factura=".$id_factura."'  target='_blank' ><h2>Vista Impresion Factura</h2></a>";	
include('../colocar_links2.php');	
?>
