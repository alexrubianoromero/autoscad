<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
//exit();
// tipo movimiento 1 es saldo inicial 
// tipo movimiento 2 es entrada
// tipo movimiento 3 es salida 
include('../valotablapc.php');  
$nueva_cantidad = $_POST['cantidad_actual'] + $_POST['cantidad'];

//primero grabar el movimiento enb la tabla de movimientos 
$sql_grabar_movimiento = "insert into $tabla19 (fecha_movimiento,cantidad,observaciones,tipo_movimiento,facturacompra,id_codigo_producto,id_empresa) 
values ('".$_POST['fecha']."','".$_POST['cantidad']."','".$_POST['observaciones']."','2','".$_POST['facturacompra']."',
'".$_POST['id_codigo']."','".$_SESSION['id_empresa']."'
)";
//echo '<br>consulta '. $sql_grabar_movimiento;
//exit();
$grabar_movimiento = mysql_query($sql_grabar_movimiento,$conexion);

//segundo actualizar las existencias del iventario 
$sql_actualizar_codigo = "update $tabla12 set cantidad =  '".$nueva_cantidad ."'
   where    id_codigo = '".$_POST['id_codigo']."'    and id_empresa =  '".$_SESSION['id_empresa']."'     " ;
 //echo '<br>consulta '. $sql_actualizar_codigo;
$consulta_grabar_codigo = mysql_query($sql_actualizar_codigo,$conexion);

echo '<br>CODIGO ACTUALIZADO';
//include('../colocar_links2.php');
//echo '<br><a href="index.php">Menu Anterior</a>';

?>



