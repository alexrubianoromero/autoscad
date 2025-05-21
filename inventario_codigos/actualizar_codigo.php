<?php
session_start();

// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();
//exit();
// tipo movimiento 1 es saldo inicial 
// tipo movimiento 2 es entrada
// tipo movimiento 3 es salida 
include('../valotablapc.php');  
$nueva_cantidad = $_REQUEST['cantidad_actual'] + $_REQUEST['cantidad'];
$_SESSION['id_empresa'] = '94';
//primero grabar el movimiento enb la tabla de movimientos 
$sql_grabar_movimiento = "insert into $tabla19 
(fecha_movimiento,cantidad,observaciones,tipo_movimiento,facturacompra,id_codigo_producto,id_empresa,costoUnitario) 
values (
          '".$_REQUEST['fecha']."'
          ,'".$_REQUEST['cantidad']."'
          ,'".$_REQUEST['observaciones']."'
          ,'2'
          ,'".$_REQUEST['facturacompra']."'
          ,'".$_REQUEST['id_codigo']."'
          ,'".$_SESSION['id_empresa']."'
          ,'".$_REQUEST['costoUnitario']."'
)";
//echo '<br>consulta '. $sql_grabar_movimiento;
//exit();
$grabar_movimiento = mysql_query($sql_grabar_movimiento,$conexion);

//segundo actualizar las existencias del iventario 
$sql_actualizar_codigo = 
"update $tabla12 
set cantidad =  '".$nueva_cantidad ."'
    ,valor_unit =  '".$_REQUEST['costoUnitario']."'   
  where    id_codigo = '".$_REQUEST['id_codigo']."'    
  and id_empresa =  '".$_SESSION['id_empresa']."'  " ;
//  die($sql_actualizar_codigo);
$consulta_grabar_codigo = mysql_query($sql_actualizar_codigo,$conexion);

echo '<div style="font-size:25px;">';
echo 'CODIGO ACTUALIZADO';
echo '<br>Ahora el costo unitario es :'.$_REQUEST['costoUnitario'];
echo '<br>Ahora la cantidad es  : '.$nueva_cantidad;
echo '</div>';
//include('../colocar_links2.php');
//echo '<br><a href="index.php">Menu Anterior</a>';

?>



