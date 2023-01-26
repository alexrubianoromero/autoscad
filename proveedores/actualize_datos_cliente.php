<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
//exit();



$sql_act_cliente = "update $tabla3   set  
identi = '".$_POST['identi']."',     
nombre = '".$_POST['nombre']."',
direccion = '".$_POST['direccion']."',
telefono = '".$_POST['telefono']."',
email = '".$_POST['email']."',
observaci = '".$_POST['observaci']."'
 where idcliente = '".$_POST['idcliente']."' and id_empresa =  '".$_SESSION['id_empresa']." '  ";  
//echo '<br>'.$sql_act_cliente;
$consulta = mysql_query($sql_act_cliente,$conexion);
$sql_cliente = "select nombre,telefono,email,direccion from $tabla3 where idcliente = '".$_POST['idcliente']."'  "; 
$consulta_cliente = mysql_query($sql_cliente,$conexion );
$datos = get_table_assoc($consulta_cliente);
echo '<br>';
echo 'LOS DATOS DEL CLIENTE QUEDARON DE LA SIGUIENTE MANERA';
draw_table($datos);
echo '<br>';
include('../colocar_links2.php');


?>
