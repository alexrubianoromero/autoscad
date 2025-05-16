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
$factupan = $_POST['orden_numero'];
$sql_grabar_item = "insert into $tabla18 (no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado)
values ('".$_POST['orden_numero']."','".$_POST['codigopan_']."','".$_POST['descripan']."','".$_POST['cantipan']."',
'".$_POST['totalpan']."','".$_POST['valor_unit']."','".$_SESSION['id_empresa']."','0')";
$consulta_grabar_item  = mysql_query($sql_grabar_item,$conexion);

$valor_final_inventario = $_POST['exispan']-$_POST['cantipan'];
/*
$sql_actualizar_inventario = "update $tabla12 set cantidad = '".$valor_final_inventario."'   
 where codigo_producto = '".$_POST['codigopan_']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$actualizar_inventario = mysql_query($sql_actualizar_inventario,$conexion);  
*/
include('mostrar_items_temporal.php');
mostrar_items_temporal($factupan);
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
