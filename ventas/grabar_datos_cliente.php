<?php
session_start();

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/


include('../valotablapc.php');

$sql_grabar_cliente = "insert into $tabla3  (identi,nombre,direccion,telefono,email,id_empresa) 
values (
'".$_POST['identi']."',
'".$_POST['nombre']."',
'".$_POST['direccion']."',
'".$_POST['telefono']."',
'".$_POST['email']."',
'".$_SESSION['id_empresa']."'
)

";
$consulta_grabar = mysql_query($sql_grabar_cliente,$conexion);
echo 'CLIENTE '.$_POST['nombre'].' GRABADO';



?>