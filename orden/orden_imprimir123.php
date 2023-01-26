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

<script src="../js/jquery.js" type="text/javascript"></script>

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





$sql_placas = "select cli.nombre as nombre ,cli.identi as identi ,cli.direccion as direccion,cli.telefono as telefono ,car.placa as placa,car.marca,car.modelo,car.color,car.tipo,

 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.kilometraje_cambio

from $tabla4 as car

inner join $tabla3 as cli on (cli.idcliente = car.propietario)

inner join $tabla14 as o  on (o.placa = car.placa) 

 where o.id = '".$_GET['idorden']."' ";

 

 //echo '<br>'.$sql_placas;

$datos = mysql_query($sql_placas,$conexion);

$datos = get_table_assoc($datos);





$sql_items_orden = "select * from $tabla15 where no_factura = '".$_GET['idorden']."' order by id_item ";

$consulta_items = mysql_query($sql_items_orden,$conexion);



$sql_mecanico = "select nombre from $tabla21 where idcliente = '".$datos[0]['mecanico']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";

$nombre_mecanico = mysql_query($sql_mecanico,$conexion);

$nombre_mecanico = mysql_fetch_assoc($nombre_mecanico);

$nombre_mecanico = $nombre_mecanico['nombre'];





/*

echo '<pre>';

print_r($datos);

echo '</pre>';

exit();

*/







//$fechapan =  time();
$ancho_tabla = "90%";
$tamano_letra = "12px";
?>

<br>

<div  id = "imprimir">
<table width="<?php  echo $ancho_tabla;  ?>" border="1">
  <tr>
    <td><img src="<?php  echo $ruta_imagen    ?>" width="187" height="61"></td>
    <td>DOCTOR MOTO<BR>
    NIT: <?php echo $datos_empresa['identi'] ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>

</body>

</html>

<script src="../js/modernizr.js"></script>   

<script src="../js/prefixfree.min.js"></script>

<script src="../js/jquery-2.1.1.js"></script>   

