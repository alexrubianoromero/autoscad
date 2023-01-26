<?php
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
//exit();

/*
'".$_POST['orden_numero']."',
'".$_POST['placa']."',
'".$_POST['clave']."',
'".$_POST['fecha']."',
'".$_POST['descripcion']."',
'".$_POST['radio']."',
'".$_POST['antena']."',
'".$_POST['repuesto']."',
'".$_POST['herramienta']."',
'".$_POST['otros']."'
*/
if ($_POST['radio']== 'undefined'){$_POST['radio'] = 0;}
if ($_POST['antena']== 'undefined'){$_POST['antena'] = 0;}
if ($_POST['repuesto']== 'undefined'){$_POST['repuesto'] = 0;}
if ($_POST['herramienta']== 'undefined'){$_POST['herramienta'] = 0;}
if ($_POST['cambiar_mecanico']== 'undefined'){$_POST['cambiar_mecanico'] = 0;}

if($_POST['cambiar_mecanico'] == 1)
{$_POST['mecanico'] = $_POST['mecanico_nuevo'];}

//echo '<br>valor de cambiar_mecanico'.$_POST['cambiar_mecanico'];

include('../valotablapc.php');
//$sql_actualizar_orden = "update  $tabla14  set (factura,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros) 
$sql_actualizar_orden = "update  $tabla14  set 
observaciones = '".$_POST['descripcion']."',
radio = '".$_POST['radio']."',
antena= '".$_POST['antena']."',
repuesto = '".$_POST['repuesto']."',
herramienta = '".$_POST['herramienta']."',
otros = '".$_POST['otros']."',
iva = '".$_POST['iva']."'
,kilometraje = '".$_POST['kilometraje']."'
,mecanico = '".$_POST['mecanico']."'
,kilometraje_cambio = '".$_POST['kilometraje_cambio']."'

where id = '".$_POST['orden_numero']."'
";

//echo '<br>'.$sql_actualizar_orden;
//exit();

$consulta_grabar = mysql_query($sql_actualizar_orden,$conexion); 
echo "<br><br><h2>ORDEN ACTUALIZADA</h2>";
include('../colocar_links2.php');

//<a href="#">#</a>
?>