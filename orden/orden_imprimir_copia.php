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
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
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
<div  id = "imprimir">
<table width="90%" border="0">
  <tr>
    <td colspan="2" rowspan="2"><img src="<?php  echo $ruta_imagen  ?>" width="335" height="102"></td>
    <td colspan="2">&nbsp;</td>
    <td width="124">&nbsp;</td>
    <td colspan="2">ORDEN  No </td>
    <td colspan="2"><?php  echo $datos[0]['orden'] ?></td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="115">&nbsp;</td>
    <td width="89">&nbsp;</td>
    <td width="105">&nbsp;</td>
    <td width="122">&nbsp;</td>
  </tr>
  <tr>
    <td width="150">FECHA</td>
    <td width="132"><?php echo $datos[0]['fecha']  ?></td>
    <td colspan="2">&nbsp;</td>
    <td>MARCA</td>
    <td colspan="2"><?php echo $datos[0]['marca']  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>CLIENTE</td>
    <td><?php echo $datos[0]['nombre']  ?></td>
    <td colspan="2">&nbsp;</td>
    <td>TIPO</td>
    <td colspan="2"><?php echo $datos[0]['tipo']  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>NIT</td>
    <td><?php echo $datos[0]['identi']  ?></td>
    <td colspan="2">&nbsp;</td>
    <td>MODELO</td>
    <td colspan="2"><?php echo $datos[0]['modelo']  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DIRECCION</td>
    <td><?php echo $datos[0]['direccion']  ?></td>
    <td colspan="2">&nbsp;</td>
    <td>PLACA</td>
    <td colspan="2"><?php echo $datos[0]['placa']  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>TELEFONO</td>
    <td><?php echo $datos[0]['telefono']  ?></td>
    <td colspan="2">&nbsp;</td>
    <td>COLOR</td>
    <td colspan="2"><?php echo $datos[0]['color']  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>PLACA</td>
    <td><?php echo $datos[0]['placa']  ?></td>
    <td colspan="2">&nbsp;</td>
    <td>KILOMETRAJE</td>
    <td colspan="2"><?php echo $datos[0]['kilometraje']  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>OPERARIO</td>
    <td colspan="2"><?php echo $datos[0]['mecanico']  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">REFERENCIA</div></td>
    <td colspan="5"><div align="center">DESCRIPCION</div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div></td>
    <td><div align="center">CANT</div></td>
    <td><div align="center">VR. UNIDAD </div></td>
    <td><div align="center">VR. TOTAL </div></td>
  </tr>
  <!--  aqui se insertan los items -->
  <?php  $subtotal =  muestre_items($_GET['idorden'],$tabla15,$conexion); 
  $valoriva = ($subtotal * $datos[0]['iva'])/100;
  if($subtotal > 750000)
	  			{
					$porcentaje_retencion = 4;
				}
	  else 		{
	  				$porcentaje_retencion = 0;
	  			}			
	  $retencion = ($valoriva * $porcentaje_retencion)/100;
	  $total = $subtotal + $valoriva  + $retencion ;
	  $n = new numerosALetras($total) ; 
	  $letras = $n -> resultado ;
	  
      //echo '<br>valor de conversion a letras <br>'.$n -> resultado ;
	  

   ?>
  
  <tr>
    <td>SON:</td>
    <td colspan = "8"><?php echo  $letras.' pesos';   ?> </td>
    </tr>
  <tr>
    <td colspan="3" rowspan="3"></td>
    <td colspan="3" rowspan="3">&nbsp;</td>
    <td>SUBTOTAL</td>
    <td>&nbsp;</td>
    <td><div align = "right"><?php  echo $subtotal  ?></div></td>
  </tr>
  <?php
  
   
  ?>
<!--
  <tr>
    <td>IVA</td>
    <td>&nbsp;</td>
    <td><div align = "right">
      <?php  echo $valoriva ;
	  	  ?>
    </div></td>
  </tr>
  <tr>
    <td>RETENCION</td>
    <td>&nbsp;</td>
    <td><div align ="right"  ><?php  echo $retencion  ?></div></td>
  </tr>
  <tr>
    <td>TOTAL</td>
    <td>&nbsp;</td>
    <td><div align = "right"><?php  echo $total  ?></div></td>
  </tr>
  -->
  <tr>
    <td colspan="3" rowspan="6">&nbsp;</td>
  </tr>
  <tr>    </tr>
  
 
  <tr>
    <td colspan="3"><div align="left"> <?php echo $datos_empresa['nombre'];  ?> </div></td>
    <td colspan="3">Recibi Firma Autorizada </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Firma Autorizada </td>
    <td colspan="3">Firma y Sello del Cliente </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
  <tr>
    <td colspan="9">* Esta es la orden de trabajo no una factura *no esta incluido el iva * valida solo por 30 dias </td>
    </tr>
</table>


</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
