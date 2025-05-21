<?php
$raiz = dirname(dirname(__file__));
//   die($raiz);
require_once($raiz.'/valotablapc.php');
require_once($raiz.'/funciones.php');
require_once($raiz.'/orden/EnviarCorreoPhpMailer.class.php');

$sql= "select * from ordenes where id = '".$_REQUEST['idOrden']."'  ";
// die($sql); 

$consulta = mysql_query($sql,$conexion);
$infoOrden = mysql_fetch_assoc($consulta); 

$sql = "select * from carros where placa = '".$infoOrden['placa']."'   ";

$consulta = mysql_query($sql,$conexion);
$infoCarro = mysql_fetch_assoc($consulta); 

$sql="select * from cliente0 where idcliente = '".$infoCarro['propietario']."'";
$consulta = mysql_query($sql,$conexion);
$infoCliente = mysql_fetch_assoc($consulta); 
// die($sql);

$body = "Atentamente enviamos el avance de tu orden de reparacion 

Puedes consultarla en el siguiente link <br><br>

https://alexrubiano.com/autoscad/ordendetrabajo/".$_REQUEST['idOrden']." <br><br>

Atentamente <br>

Autoscad<br>
";
$email = $infoCliente['email'];
// $email="alexrubianoromero@gmail.com";

// die($infoCliente['email']);

$correo = new EnviarCorreoPhpMailer($email,$body);


?>