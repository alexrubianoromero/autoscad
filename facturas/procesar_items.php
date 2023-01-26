<?PHP

session_start();

include('../valotablapc.php');

$sql_grabar_item = "insert into $tabla13 
(no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,id_empresa,estado,repman)

values ('".$_POST['id_cotizacion']."','".$_POST['codigopan_']."','".$_POST['descripan']."','".$_POST['cantipan']."',

'".$_POST['totalpan']."','".$_POST['valor_unit']."','".$_SESSION['id_empresa']."','0','".$_POST['repman']."')";

$consulta_grabar_item  = mysql_query($sql_grabar_item,$conexion);

//echo '<br>'.$sql_grabar_item;
include('mostrar_items.php');

mostrar_items($_REQUEST['id_cotizacion']);

?>
