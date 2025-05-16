<?php
session_start();
include("../empresa.php");
include("../valotablapc.php");
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
$fechapan =  time();
$fechapan = date ( "Y/m/j" , $fechapan );

if ($_POST['nomina']== 'undefined'){$_POST['nomina'] = 0;}
//traer la informacion que esta en la base de datos antes de cambios
$sql_traer_informacion = "select * from $tabla12 where id_codigo = '".$_POST['id_codigo']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_anterior = mysql_query($sql_traer_informacion,$conexion);
$info_ant = mysql_fetch_assoc($consulta_anterior);
/*
echo '<pre>';
print_r($info_ant);
echo '</pre>';
echo '<br>prueba '.$info_ant['codigo_producto'];
*/
//comparar los valores anteriores con los que vienen ahora para establecer cual de ellos cambio 
$valores_anteriores = 
 '/codigo_producto:'.$info_ant['codigo_producto']
.'/descripcion:'.$info_ant['descripcion']
.'/valor_unit:'.$info_ant['valor_unit']
.'/valorventa:'.$info_ant['valorventa']
.'/cantidad:'.$info_ant['cantidad']
.'/nomina:'.$info_ant['nomina'];

//echo '<br>anteriores<br>'.$valores_anteriores;

$nuevos_valores = 
 '/codigo_producto:'.$_POST['codigo']
.'/descripcion:'.$_POST['descripcion']
.'/valor_unit:'.$_POST['valor_unit']
.'/valorventa:'.$_POST['valorventa']
.'/cantidad:'.$_POST['cantidad']
.'/nomina:'.$_POST['nomina'];

//echo '<br>nuevos<br>'.$nuevos_valores;
$anteriores_nuevos = 'modificacion /anteriores'.$valores_anteriores.'nuevos'.$nuevos_valores;


$sql_atualizar_datos_codigos = "update $tabla12 set 
codigo_producto =  '".$_POST['codigo']."',
descripcion  = '".$_POST['descripcion']."',
valor_unit  = '".$_POST['valor_unit']."',      
valorventa  = '".$_POST['valorventa']."',  
iva  = '".$_POST['iva']."', 
nomina  = '".$_POST['nomina']."', 
cantidad  = '".$_POST['cantidad']."' 
where id_codigo = '".$_POST['id_codigo']."'  
and id_empresa = '".$_SESSION['id_empresa']."'
";
//echo 'consulta<br>'.$sql_atualizar_datos_codigos;
$consulta_actualizar = mysql_query($sql_atualizar_datos_codigos,$conexion);
///registrar movimiento en movimientos de invetario este tipo de actualizacion se registra con 4
$sql_registrar_modificacion = "insert into $tabla19 (fecha_movimiento,tipo_movimiento,observaciones,id_empresa,id_codigo_producto) values ('".$fechapan."','4','".$anteriores_nuevos."','".$_SESSION['id_empresa']."','".$_POST['id_codigo']."');";
$consulta_registar_cambio = mysql_query($sql_registrar_modificacion,$conexion);


echo '<h2>CODIGO ACTUALIZADO<h2>';
include('../colocar_links2.php');

?>