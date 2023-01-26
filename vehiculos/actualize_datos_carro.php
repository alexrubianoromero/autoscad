<?php
include('../valotablapc.php');
include('../funciones.php');
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

if ($_POST['cambiopropietario']== 'undefined'){$_POST['cambiopropietario'] = 0;}
if ($_POST['cambio_placa']== 'undefined'){$_POST['cambio_placa'] = 0;}



$sql_act_carro = "update $tabla4   set  
marca = '".$_POST['marca']."',     
tipo = '".$_POST['tipo']."',
modelo = '".$_POST['modelo']."',
color = '".$_POST['color']."',
vencisoat = '".$_POST['vencisoat']."',
revision = '".$_POST['revision']."',
chasis = '".$_POST['chasis']."',
motor = '".$_POST['motor']."'
";

if($_POST['cambiopropietario'] ==1) 
		{
			  $sql_act_carro .=  ", propietario = '".$_POST['nuevopropietario']."'  ";
		}
 
if($_POST['cambio_placa'] ==1) 
		{
			  $sql_act_carro .=  ", placa = '".$_POST['nueva_placa']."'  ";
		}
$sql_act_carro  .=   " where idcarro = '".$_POST['idcarro']."'   ";  

//echo '<br>'.$sql_act_carro;
$consulta = mysql_query($sql_act_carro,$conexion);

//si se solicito cambio de placa tambien se debe actualizar en ordenes y en facturas 

if($_POST['cambio_placa'] ==1) {
$sql_actulizar_ordenes = "update $tabla14 set  placa ='".$_REQUEST['nueva_placa']."'   where placa = '".$_REQUEST['placa']."'  ";
$consulta_actualizar_placa_ordenes = mysql_query($sql_actulizar_ordenes,$conexion);

$sql_actualizar_facturas = "update $tabla11 set placa = '".$_REQUEST['nueva_placa']."'   where placa ='".$_REQUEST['placa']."' ";
$consulta_actualizar = mysql_query($sql_actualizar_facturas,$conexion);
}
echo '<H2>MODIFICACION REALIZADA</H2>';
include('../colocar_links2.php');

?>
