<?php

session_start();
include('../valotablapc.php');

$sql ="delete from $tabla21 where idcliente = '".$_POST['idcliente']."'   ";
// echo 'consulta<br>'.$sql;
$final = mysql_query($sql,$conexion);

echo '<h1>Tecnico eliminado</h1> ';
?>