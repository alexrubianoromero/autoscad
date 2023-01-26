<?PHP

session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/



//$factupan = '1234567';
$factupan = $_SESSION['ordenpan'];
//$db = "prueba_facturacion";
include('../valotablapc.php');

$sql_traer_datos_item = "select  item.cantidad  as item ,prod.codigo_producto as codigo ,prod.cantidad as inventario,
item.no_factura  from $tabla18  item 
inner join $tabla12 prod on (prod.codigo_producto = item.codigo)
				where item.id_item = '".$_POST['eliminar_']."'  ";

//echo $sql_traer_datos_item;
//exit();

$cantidades = mysql_query($sql_traer_datos_item,$conexion);
$cantidades = mysql_fetch_assoc($cantidades);
/*
echo '<pre>';
print_r($cantidad);
echo '</pre>';
*/
$lo_que_queda = $cantidades['inventario'] + $cantidades['item'] ;

//echo '<br>'.$lo_que_queda;  
//echo 'cantidad ='.$cantidad['cantidad'];
//echo '<br>query actualizar'.$sql_actualizar_inventario;
//exit();
$sql_eliminar_items = "delete from  $tabla18  where id_item = '".$_POST['eliminar_']."'";
$consulta_eliminar  = mysql_query($sql_eliminar_items,$conexion);
/*
$sql_actualizar_inventario = "update $tabla12 set cantidad   =  '".$lo_que_queda."'    
where  codigo_producto = '".$cantidades['codigo']."'  and id_empresa = '".$_SESSION['id_empresa']."'  "; 
$actualizar_inventario = mysql_query($sql_actualizar_inventario,$conexion);
*/
include('mostrar_items_temporal.php');
mostrar_items_temporal($_SESSION['ordenpan']);
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
			
</script>		