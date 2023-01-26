<?php
session_start();
include('../valotablapc.php');  
include('../funciones.php'); 
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>imprimir orden</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:160px;
	height:20px;
	z-index:1;
	left: 154px;
	top: 205px;
}
#Layer2 {
	position:absolute;
	width:245px;
	height:22px;
	z-index:2;
	left: 467px;
	top: 206px;
}
#Layer3 {
	position:absolute;
	width:155px;
	height:22px;
	z-index:3;
	left: 732px;
	top: 209px;
}
#Layer4 {
	position:absolute;
	width:169px;
	height:19px;
	z-index:1;
	left: 120px;
	top: 243px;
}
#Layer5 {
	position:absolute;
	width:190px;
	height:23px;
	z-index:2;
	left: 348px;
	top: 240px;
}
#Layer6 {
	position:absolute;
	width:128px;
	height:25px;
	z-index:4;
	left: 544px;
	top: 242px;
}
#Layer7 {
	position:absolute;
	width:123px;
	height:22px;
	z-index:5;
	left: 734px;
	top: 241px;
}
#Layer8 {
	position:absolute;
	width:100px;
	height:26px;
	z-index:6;
	left: 101px;
	top: 281px;
}
#Layer9 {
	position:absolute;
	width:126px;
	height:26px;
	z-index:7;
	left: 305px;
	top: 280px;
}
#Layer10 {
	position:absolute;
	width:128px;
	height:26px;
	z-index:8;
	left: 715px;
	top: 277px;
}
#Layer11 {
	position:absolute;
	width:136px;
	height:27px;
	z-index:9;
	left: 328px;
	top: 317px;
}
#Layer12 {
	position:absolute;
	width:200px;
	height:27px;
	z-index:10;
	left: 534px;
	top: 317px;
}
#Layer13 {
	position:absolute;
	width:200px;
	height:27px;
	z-index:11;
	left: 105px;
	top: 353px;
}
#Layer14 {
	position:absolute;
	width:593px;
	height:224px;
	z-index:12;
	left: 115px;
	top: 432px;
}
-->
</style>
</head>
<body>
<?php

include('../numerosALetras.class.php');
  $n = new numerosALetras ( 159 ) ; 
//echo $n -> resultado ;
//$letras = $n -> resultado ;
//echo '<br>letras'.$letras; 

/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
*/

//exit();






/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();
$sql_empresa = "select * from $tabla10 where id_empresa = ".$_SESSION['id_empresa']." ";
$consulta_empresa = mysql_query($sql_empresa,$conexion); 
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
$ruta_imagen = '../logos/'.$datos_empresa['ruta_imagen'];
/*
echo '<pre>';
print_r($datos_empresa);
echo '</pre>';
exit(); 
*/


$sql_placas = "select cli.nombre as nombrecli ,cli.identi as identicli ,cli.direccion as direccion,cli.telefono as telefono ,cli.email,
car.placa as placa,car.marca,car.modelo,car.color,car.tipo,car.chasis,car.motor,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.kilometraje_cambio,
 t.nombre as nombre_mecanico
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
inner join $tabla21 as t on (t.idcliente = o.mecanico) 
 where o.id = '".$_GET['idorden']."' ";
 
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);


$sql_items_orden = "select * from $tabla15 where no_factura = '".$_GET['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);

/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/




//$fechapan =  time();
?>
<br>
<br>
<div id="Layer1">
<h8><?php  echo $datos[0]['fecha'];  ?></h8></div>
  <div id="Layer4">
  <h8><?php  echo $datos[0]['nombrecli'];  ?></h8></div>
  <div id="Layer5"><?php  echo $datos[0]['direccion'];  ?></div>
<div id="Layer2">
<h8><?php  echo $datos[0]['nombre_mecanico'];  ?></h8></div>
<div id="Layer3"><h8><?php  echo $datos[0]['tipo'];  ?></h8></div>
<div id="Layer6"><?php  echo $datos[0]['telefono'];  ?></div>
<div id="Layer7"><?php  echo $datos[0]['identicli'];  ?></div>
<div id="Layer8"><?php  echo $datos[0]['modelo'];  ?></div>
<div id="Layer9"><?php  echo $datos[0]['chasis'];  ?></div>
<div id="Layer10"><?php  echo $datos[0]['color'];  ?></div>
<div id="Layer11"><?php  echo $datos[0]['kilometraje'];  ?></div>
<div id="Layer12"><?php  echo $datos[0]['motor'];  ?></div>
<div id="Layer13"><?php  echo $datos[0]['email'];  ?></div>
<div id="Layer14"><?php  echo $datos[0]['observaciones'];  ?></div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
