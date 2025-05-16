<?PHP
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';


exit();

*/
///////////////////////////
//$factupan = '1234567';
//$factupan = $_POST['factupan'];
/*
$db = "prueba_facturacion";
include('access_facturacion.php');
*/
include('../valotablapc.php');
$factupan = $_SESSION['id_orden'];  //este es el id de la factura de la tabla facturas_inventario
$fechapan_movimiento =  time();
$fechapan_movimiento =  date ( "Y/m/j" , $fechapan_movimiento );
?>
<input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "<? echo $_REQUEST['id_factura'] ?>"  >
<?php
// en no_factura ira el id de la factura creada de inventario 
$sql_grabar_item = "insert into $tablaitemfacinv (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado)
values ('".$_POST['orden_numero']."','".$_POST['codigopan_']."','".$_POST['descripan']."','".$_POST['cantipan']."',
'".$_POST['totalpan']."','".$_POST['valor_unit']."','".$_SESSION['id_empresa']."','0')";
//echo '<br>consulta<br>'.$sql_grabar_item;
$consulta_grabar_item  = mysql_query($sql_grabar_item,$conexion);

$valor_final_inventario = $_POST['exispan']+$_POST['cantipan'];

$sql_actualizar_inventario = "update $tabla12 set cantidad = '".$valor_final_inventario."'   
 where codigo_producto = '".$_POST['codigopan_']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$actualizar_inventario = mysql_query($sql_actualizar_inventario,$conexion);  
include('mostrar_items_factura_inventario.php');
//echo '<br>valor de $factupan<br>'.$factupan;


////////////////traer el numero del id de item_facturas_inventario
$sql_maximo_id_item = "select max(id_item) as maximo from $tablaitemfacinv  where id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_maximo = mysql_query($sql_maximo_id_item,$conexion);
$arreglo_maximo = mysql_fetch_assoc($consulta_maximo);
$maximo = $arreglo_maximo['maximo'];
//////////////////////////////////////////////////////////grabar movimiento inventario

$sql_grabar_movimiento_inventario = "insert into $tabla19  (fecha_movimiento,cantidad,observaciones,tipo_movimiento,facturacompra,id_codigo_producto,id_empresa,id_item_factura_compra)  
 values ('".$fechapan_movimiento."','".$_POST['cantipan']."','FACTURA_PROVEEDOR','5','".$_POST['orden_numero']."'
 ,'".$_POST['id_codigo']."'   
 ,'".$_SESSION['id_empresa']."' 
 ,'".$maximo."'
 )";

//echo '<br>'.$sql_grabar_movimiento_inventario.'<br>';
$consulta_grabar_movimiento = mysql_query($sql_grabar_movimiento_inventario,$conexion);
//////////////
mostrar_items($factupan);
?>
<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
			
			$(".eliminar").click(function(){
			
							var data =  'eliminar =' + $(this).attr('value');
							data += '&factupan=' + $("#orden_numero").val();
							$.post('eliminar_items.php',data,function(a){
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
