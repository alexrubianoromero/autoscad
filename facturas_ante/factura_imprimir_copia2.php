<?php

session_start();
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
	width:200px;
	height:67px;
	z-index:1;
	left: 533px;
	top: 115px;
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
//echo
/*
 '<pre>';
print_r($_GET);
echo '</pre>';
*/


//exit();





include('../valotablapc.php');  
include('../funciones.php'); 
include('../num2letras.php'); 

/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();
/*
$sql_placas = "select cli.nombre as nombre ,cli.identi as identi ,cli.direccion as direccion,cli.telefono as telefono ,car.placa as placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva 
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
 where o.id = '".$_GET['idorden']."' ";
 */
$sql_ruta_imagen = "select ruta_imagen,nombre from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_ruta_imagen,$conexion);
$ruta_imagen = mysql_fetch_assoc($consulta_empresa);
/*
echo  '<pre>';
print_r($ruta_imagen);
echo '</pre>';
echo '<br>'.$ruta_imagen;
exit();  
*/
$nombre_empresa = $ruta_imagen['nombre'];
$ruta_imagen = '../logos/'.$ruta_imagen['ruta_imagen'];






///////////////////////////debo verificar que tiop de factura es si es normal 1o es de ventas 2 de cuerdo a esto se genera el formato 
$sql_tipo_factura = "select tipo_factura from $tabla11 where id_factura = '".$_GET['id_factura']."' ";
$consulta_tipo_factura = mysql_query($sql_tipo_factura,$conexion);
$tipo_factura = mysql_fetch_assoc($consulta_tipo_factura);
$tipo_factura = $tipo_factura['tipo_factura'];
//echo '<br>tipo_factura'.$tipo_factura ;
//exit(); 

///////////////////////////////

                $sql_placas = "select cli.nombre as nombre ,cli.identi as identicli ,cli.direccion as direccioncli,cli.telefono as telefonocli ,car.placa as placa,
                car.marca,car.modelo,car.color,car.tipo,
                 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.kilometraje,o.mecanico
                 ,f.numero_factura as numero_factura,f.fecha as fecha_factura,f.sumaitems as subtotalfac ,
                 f.valor_iva as ivafac ,f.total_factura as totalfac ,f.id_orden as id_orden,f.valor_retefuente as retefuentefac,f.resolucion as resolucion,
                  f.elaborado_por,f.tipo_factura
                 , e.resolucion as empreresolucion
                 , e.prefijo_factura as prefijo ,e.nombre as empresa ,e.identi,e.direccion,e.telefonos
                 
                from $tabla4 as car
                inner join $tabla3 as cli on (cli.idcliente = car.propietario)
                inner join $tabla14 as o  on (o.placa = car.placa) 
                inner join $tabla11 as f  on (f.id_orden = o.id)
                inner join $tabla10  as e on (e.id_empresa = f.id_empresa) 
                 where f.id_factura = '".$_GET['id_factura']."' 
                and  f.id_empresa = '".$_SESSION['id_empresa']."'  ";
                ////////////////////////
         

 
if($tipo_factura==2)  // si es factura de venta 
              {
                  $sql_placas = "select cli.nombre as nombre ,cli.identi as identicli ,cli.direccion as direccioncli,cli.telefono as telefonocli

                 ,f.numero_factura as numero_factura,f.fecha as fecha_factura,f.sumaitems as subtotalfac ,
                 f.valor_iva as ivafac ,f.total_factura as totalfac ,f.id_orden as id_orden,f.valor_retefuente as retefuentefac,f.resolucion as resolucion,
                  f.elaborado_por,f.tipo_factura
                 , e.resolucion as empreresolucion
                 , e.prefijo_factura as prefijo ,e.nombre as empresa ,e.identi,e.direccion,e.telefonos
                from $tabla11 as f
                inner join $tabla14 as o  on (o.id = f.id_orden) 
                inner join $tabla3 as cli on (cli.idcliente = f.placa)
                inner join $tabla10  as e on (e.id_empresa = f.id_empresa) 
                 where f.id_factura = '".$_GET['id_factura']."' 
                and  f.id_empresa = '".$_SESSION['id_empresa']."'  ";

              } // fin de if($tipo_factura==2)  


 //echo '<br>'.$sql_placas;
 //exit();
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);

$sql_items_orden = "select * from $tabla11 where id_factura = '".$_GET['idorden']."' order by id_item ";
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

<br>
<div  id = "imprimir">
<table width="92%" border="1">
  <tr>
    <td width="11%"><h8>
      <div align="center">CANT.</div>
    </h8></td>
    <td width="38%"><h8>
      <div align="center">DESCRIPCION</div>
    </h8></td>
    <td width="13.8%"><h8>
      <div align="center">PRECIO UNI </div>
    </h8></td>
    <td width="13.3%"><h8>
      <div align="center">PRECIO TOTAL </div>
    </h8></td>
    <td width="5%"><h8>
      <div align="center">IVA</div>
    </h8></td>
    <td width="13.8%"><h8>
      <div align="center">TOTAL</div>
    </h8></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
    $id_empresa = $_SESSION['id_empresa'];
    $subtotal =  muestre_items_nuevo($datos[0]['id_orden'],$tabla15,$conexion,$id_empresa); 
  //$valoriva = ($subtotal * $datos[0]['iva'])/100;
  if($subtotal > 750000)
	  			{
					$porcentaje_retencion = 4;
				}
	  else 		{
	  				$porcentaje_retencion = 0;
	  			}			
	  $retencion = ($valoriva * $porcentaje_retencion)/100;
	  $total = $subtotal + $valoriva  + $retencion ;
    /*
	  $n = new numerosALetras($datos[0]['totalfac']) ; 
	  $letras = $n -> resultado ;
    */
    $letras = num2letras($datos[0]['totalfac']);
	  

      //echo '<br>valor de conversion a letras <br>'.$n -> resultado ;
	  //include('../num2letras.php');
    //$resultadoletras = new num2letras($datos[0]['totalfac']);


   ?>
  
</table>



</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
