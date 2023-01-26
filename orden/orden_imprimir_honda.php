<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$ancho_tabla = '95%';

$sql_placas = "select cli.nombre as nombrecli,cli.identi,cli.direccion,cli.telefono,car.placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id,
 e.identi,e.telefonos as telefonos_empresa ,e.direccion as direccion_empresa,o.kilometraje_cambio,e.tipo_taller,cli.email,e.condiciones_orden,
 o.fecha_entrega, o.fecha_salida , e.email_empresa,e.razon_social
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa)
inner join $tabla10 as e on  (e.id_empresa = o.id_empresa) 
 where o.id = '".$_REQUEST['idorden']."'   and   o.id_empresa = '".$_SESSION['id_empresa']."'   ";
 //echo '<br>'.$sql_placas.'<br>';
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
$datos_orden = mysql_fetch_assoc($datos);
/*
echo '<pre>';
print_r($datos_orden);
echo '</pre>';
*/

if($datos_orden['mecanico']== '')
	{
		$nombre_mecanico = 'MECANICO NO ASIGNADO';
	}
else {
        $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$datos_orden['mecanico']."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
	}
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<!--<meta charset="UTF-8">-->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
    <style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:510px;
	height:85px;
	z-index:1;
	left: 936px;
	top: 3px;
}
#Layer2 {
	position:absolute;
	width:418px;
	height:93px;
	z-index:2;
	left: -503px;
	top: 2px;
}
#Layer3 {
	position:absolute;
	width:416px;
	height:89px;
	z-index:2;
}
-->
    </style>
</head>
<body>
<div id="Layer3">

	<?php 
		echo '<h2>'.$datos_orden['razon_social'].'<BR>NIT. '.$datos_orden['identi'].'  </h2>';
		
		
		 
  	?>
</div>

<div id="Layer1">
<div id="Layer2">
  <table width="95%" border="0">
    <tr>
      <td width="29%"><img src="../imagenes/honda_orden/logo_honda.jpg" width="82" height="80"></td>
      <td width="48%"><img src="../imagenes/honda_orden/yamaha.jpg" width="158" height="26"></td>
      <td width="23%"><img src="../imagenes/honda_orden/zuzuki_logo.jpg" width="150" height="65"></td>
    </tr>
  </table>
</div>

<br>
<h14>ORDEN DE ENTRADA </h14>
<BR>
<h14>CENTRO DE SERVICIO AUTORIZADO  HONDA</h14>
<h80>
<table width="26%" border="1">
  <tr>
    <td width="42%">FECHA</td>
    <td width="58%"><h80><?php echo $datos_orden['fecha']  ?></h80></td>
  </tr>
  <tr>
    <td>OT</td>
    <td><h80><?php echo $datos_orden['orden']  ?></h80></td>
  </tr>
</table>
</h80>
</div>
<div = "contenidos">


<br><br>
<br>
<br>
<br>
<br>
<h80>
<table width="<?php echo $ancho_tabla; ?>" border="1">
  <tr>
    <td>CLIENTE</td>
    <td><?php echo $datos_orden['nombrecli']  ?></td>
    <td>CC.o NIT</td>
    <td><?php echo $datos_orden['identi']  ?></td>
    <td>DIRECCION</td>
    <td><?php echo $datos_orden['direccion']  ?></td>
  </tr>
  <tr>
    <td>TELS</td>
    <td><?php echo $datos_orden['telefono']  ?></td>
    <td>EMAIL</td>
    <td><?php echo $datos_orden['email']  ?></td>
    <td>TECNICO</td>
    <td><?php echo $nombre_mecanico ?></td>
  </tr>
  <tr>
    <td>FECHA DE INGRESO </td>
    <td><?php echo $datos_orden['fecha']  ?></td>
    <td>FECHA PROMETIDA </td>
    <td><?php echo $datos_orden['fecha_entrega']  ?></td>
    <td>FECHA SALIDA </td>
    <td><?php echo $datos_orden['fecha_salida']  ?></td>
  </tr>
</table>

<table width="<?php echo $ancho_tabla; ?>" border="1">
  <tr>
    
    <td>MARCA</td>
    <td><?php echo $datos_orden['marca']  ?> </td>
    <td>MODELO</td>
    <td><?php echo $datos_orden['modelo']  ?></td>
    <td>CHASIS No </td>
    <td><?php echo $datos_orden['chasis']  ?></td>
    <td>COLOR</td>
    <td><?php echo $datos_orden['color']  ?></td>
    <td>PLACA</td>
    <td><?php echo $datos_orden['placa']  ?></td>
  </tr>
</table>
<?php   
pintar_inventario_estado_vehiculo($tabla24,$tabla25,$_SESSION['id_empresa'],$_REQUEST['idorden'],$conexion,$ancho_tabla);
?>
<table width = "<?php echo $ancho_tabla; ?>" border="1">
  <tr>
    <td>OBSERVACIONES</td>
  </tr>
   <tr>
    <td><textarea name="descripcion"  id = "descripcion" cols="80" rows="4"> <?php  echo $datos_orden['observaciones']?>
    </textarea></td>
  </tr>
   <tr>
    <td><h81><?php   echo $datos_orden['condiciones_orden'] ?></h81></td>
  </tr>
</table>
<table width = "<?php echo $ancho_tabla; ?>" border="1">
<tr>
    <td colspan = "5"  align="center">PARTES Y RESPUESTOS</td>
  </tr>
	
<tr>
    <td>REFERENCIA</td>
    <td>DESCRIPCION</td>
    <td>CANTIDAD</td>
    <td>VALOR UN.</td>
    <td>TOTAL </td>
  </tr>
 


<?php
$subtotal = muestre_items_local($_REQUEST['idorden'],$tabla15,$conexion,$_SESSION['id_empresa']);

?>
</table>

<table width = "<?php echo $ancho_tabla; ?>" border="1">
  <tr>
    <td>&nbsp;</td>
    <td>COTIZACION</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>ABONO</td>
    <td>FECHA</td>
    <td>SALDO</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>TOTAL</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<table width = "<?php echo $ancho_tabla; ?>" border="0">
  <tr>
    <td>RECIBIDO</td>
    <td>ENTREGADO</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>--------------</td>
    <td>-------------------</td>
  </tr>
  <tr>
    <td>TALLER</td>
    <td>CLIENTE</td>
  </tr>
</table>
<br>
<table width = "<?php echo $ancho_tabla; ?>" border="0">
  <tr>
   <td align = "center"><?php echo $datos_orden['direccion_empresa'].'-'.$datos_orden['telefonos_empresa'].'-'. $datos_orden['email_empresa']  ?> </td>
  </tr>
</table>

</h80>

</div>
 
<?php

//////////////////////////////
// esta funcion la utilizo cuando se va a facturar por esto ya tiene un formato predefinido para que cuadre al momento de mostrar la factura e imprimirla 
function muestre_items_local($orden,$tabla,$conexion,$id_empresa)
		{
				$subtotal = 0;
				//echo 'pasooooooooooooooooo3333333333333333333'.$orden;
				$sql_items_orden = "select * from  $tabla where no_factura = '".$orden."' and id_empresa = '".$id_empresa."'  order by id_item ";
				//echo '<br>'.$sql_items_orden.'<br>';
				$consulta_items = mysql_query($sql_items_orden,$conexion);
				$no_item = 0 ;
				

				
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			echo '<tr>
			     
                <td >'.$items['codigo'].'</td>
    			<td  > '.$items['descripcion'].'</td>
				<td > '.$items['cantidad'].'</td>
    			<td >'.$items['valor_unitario'].'</td>
   			    <td >'.$items['total_item'].'</td>
					</tr>
				';
				//<td width="34">'.$i.'</td>
				$subtotal = $subtotal + $items['total_item'];
			 }
			
			 return $subtotal; 
		}
///////////////////////////


?>
<br>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>  
