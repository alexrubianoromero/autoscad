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
#Layer2 {
	position:absolute;
	width:296px;
	height:88px;
	z-index:1;
	left: 175px;
	top: 6px;
}
#Layer3 {
	position:absolute;
	width:301px;
	height:37px;
	z-index:2;
	left: 792px;
	top: 25px;
}
#Layer4 {
	position:absolute;
	width:133px;
	height:45px;
	z-index:3;
	left: 626px;
	top: 26px;
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
$ruta_imagen2 = '../logos/tarjetas3.jpg';






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
                 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.kilometraje,o.mecanico,o.kilometraje_cambio
                 ,f.numero_factura as numero_factura,f.fecha as fecha_factura,f.sumaitems as subtotalfac ,
                 f.valor_iva as ivafac ,f.total_factura as totalfac ,f.id_orden as id_orden,f.valor_retefuente as retefuentefac,f.resolucion as resolucion,
                  f.elaborado_por,f.tipo_factura
                 , e.resolucion as empreresolucion
                 , e.prefijo_factura as prefijo ,e.nombre as empresa ,e.identi,e.direccion,e.telefonos,e.razon_social,e.horario,e.email_empresa,e.recibe_tarjetas
                 
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
                 , e.prefijo_factura as prefijo ,e.nombre as empresa ,e.identi,e.direccion,e.telefonos,o.kilometraje,o.kilometraje_cambio,e.razon_social,e.recibe_tarjetas
                from $tabla11 as f
                inner join $tabla14 as o  on (o.id = f.id_orden) 
                inner join $tabla3 as cli on (cli.idcliente = f.placa)
                inner join $tabla10  as e on (e.id_empresa = f.id_empresa) 
                 where f.id_factura = '".$_GET['id_factura']."' 
                and  f.id_empresa = '".$_SESSION['id_empresa']."'  ";

              } // fin de if($tipo_factura==2)  


// echo '<br>'.$sql_placas;
 //exit();
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);
/*
echo  '<pre>';
print_r($datos);
echo '</pre>';
*/
$sql_items_orden = "select * from $tabla11 where id_factura = '".$_GET['idorden']."' order by id_item ";
//echo '<br>id_orden '.$datos[0]['id_orden'];
$consulta_items = mysql_query($sql_items_orden,$conexion);

$sql_numero_items ="select count(*) as total from $tabla15 where no_factura = '".$datos[0]['id_orden']."'  ";
$consulta_numero_items = mysql_query($sql_numero_items,$conexion);
$numero_items = mysql_fetch_assoc($consulta_numero_items);

//echo '<br>items '.$numero_items['total'];

/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/


//$fechapan =  time();



?>
<?php
  //$prefijo = '';
	   if( $datos[0]['resolucion'] == 1)
			  {  
          $nombre_documento = 'FACTURA No'; 
		  //$razon_social = 'GRUPO EMPRESARIAL BALCAZAR S.A.S. NIT: 900861474-6';
		  //$razon_social = 'SERVI-MARTHA NIT. 52.297.022-6';
		   $razon_social =   $datos[0]['razon_social'].' NIT. '.$datos[0]['identi'];
		  $palabra_iva = 'IVA';
		  $palabra_retefuente = 'RETEFUENTE';
		
		 
         // $prefijo = $datos[0]['prefijo'];
        }
      else { 
	  		$nombre_documento  =  'DOCUMENTO  No ';
	  		  $razon_social =   $datos[0]['razon_social'].' NIT. '.$datos[0]['identi'];	
			  $palabra_iva = '';
			   $palabra_retefuente = '';
			} 
	?> 
<br>

<div id="Layer2"><img src="<?php  echo $ruta_imagen    ?>" width="241" height="70"></div>

<br>

<?php
if($datos[0]['recibe_tarjetas'] == 1)
	{
	echo '
		<div id="Layer4">
		  <h7>
			<div align="center">RECIBIMOS TARJETAS DEBITO Y CREDITO</div>
		  </h7>
		</div>
		<div id="Layer3"><img src="'.$ruta_imagen2.'" width="235" height="32"></div>
		';
	}	
?>


<br>
<br><br>
<table width="95%" border="0">
  <tr>
    <td width="0%"><h8></h8></td>
    <td width="50%">
      <h9>
      <div align="center">
        <?php  if( $datos[0]['resolucion'] == 1)
			 {   
			     //echo $datos[0]['empreresolucion']; 
				 $linea1 = substr($datos[0]['empreresolucion'],0,25);
				  $linea2 = substr($datos[0]['empreresolucion'],26,36);
				   $linea3 = substr($datos[0]['empreresolucion'],61,14);
			 }  ?>
			
        <?php  echo $linea1;  ?>
     
      </div>
    </h9></td>
  </tr>
  <tr>
    <td><h9>
      <div align="center">
	    <?php
		
	  		echo $razon_social;
			
						
			?>		
	  
	   </div>
    </h9></td>
    <td><h9>
      <div align="center">
        <?php  echo $linea2;  ?>
      </div>
    </h8></td>
  </tr>
  <tr>
    <td><h9>
      <div align="center"><?php echo $datos[0]['direccion'].' - '.$datos[0]['telefonos']   ?></div>
    </h9></td>
    <td><h9><div align="center">
        <?php  echo $linea3;  ?>
        </div></h9></td>
  </tr>
  <tr>
    <td><h9>
      <div align="center"><?php echo '<h9>'.$datos[0]['horario'].'</h9>'; //LUNES A SABADO DE 8:00 AM A 6:00 PM DOMINGOS Y FESTIVOS DE 9:00 AM  A 1:00 PM    ?></div>
    </h9></td>
    <td><h9>
      <div align="center"> 
        
        <?php  echo  $nombre_documento.' '.$datos[0]['numero_factura'] ?>
        </div>
    </h9></td>
  </tr>
  <tr>
    <td><h9>
      <div align="center"><?php  echo $datos[0]['email_empresa'] //servi-martha@hotmail.com   ?></div>
    </h9></td>
    <td><h9>
      <div align="center">FECHA <?php echo $datos[0]['fecha_factura']  ?></div>
    </h9></td>
  </tr>
</table>

<br>
<table width="95%" border="1">
  <tr>
    <td width="12%" ><h8>SEÑOR(ES)</h8></td>
    <td><h8><?php echo substr($datos[0]['nombre'],0,30)?></h8></td>
    <td width="10%"><h8>NIT/CC</h8></td>
    <td><h8><?php echo substr($datos[0]['identicli'],0,30)?></h8></td>
  </tr>
  <tr>
    <td width="12%"> <h8>DIRECCION</h8></td>
    <td><h8><?php echo substr($datos[0]['direccioncli'],0,30)?></h8></td>
    <td width="10%"><h8>TEL</h8></td>
    <td><h8><?php echo substr($datos[0]['telefonocli'],0,30)?></h8></td>
  </tr>
</table>


<table width="95%" border="1">
  <tr>
    <td width="12%"><h8>MARCA</h8></td>
    <td width="12%"><?php echo substr($datos[0]['marca'],0,30)?></h8></td>
    <td width="12%"><h8>MODELO</h8></td>
    <td width="12%"><H8><?php echo substr($datos[0]['modelo'],0,30)?></h8></td>
    <td width="12%"><h8>PLACA</h8></td>
    <td width="12%"><?php echo substr($datos[0]['placa'],0,30)?></h8></td>
  </tr>
  <tr>
    <td>TIPO</td>
    <td><?php echo substr($datos[0]['tipo'],0,30)?></td>
    <td><h8>Kms Actual </h8></td>
    <td><H8><?php echo $datos[0]['kilometraje'] ?></h8></td>
    <td><h8>Kms Prox. Cambio </h8></td>
    <td><H8><?php echo $datos[0]['kilometraje_cambio'] ?></h8></td>
  </tr>
</table>

<br>

<table width="95%" border="1">
  <tr>
    <td width="11%"><h8>
      <div align="center">CANT.</div>
    </h8></td>
    <td width="38%"><h8>
      <div align="center">DESCRIPCION</div>
    </h8></td>
    <td width="13%"><h8>
      <div align="center">PRECIO UNI </div>
    </h8></td>
    <td width="13%"><h8>
      <div align="center">PRECIO TOTAL </div>
    </h8></td>
    <td width="5%"><h8>
      <div align="center"><?php  echo $palabra_iva ?></div>
    </h8></td>
    <td width="13%"><h8>
      <div align="center">TOTAL</div>
    </h8></td>
  </tr>
  <?php
    $id_empresa = $_SESSION['id_empresa'];
    $subtotal =  muestre_items_nuevo($datos[0]['id_orden'],$tabla15,$conexion,$id_empresa,$datos['0']['resolucion']); 
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

 $completar = completar_espacios($numero_items);
 
   ?>
<tr>
    <td colspan="3" rowspan="4"><h8>
	<?php if( $datos[0]['resolucion'] == 1)  
	echo 'Esta factura de venta se 
      asimila en todos sus efectos legales a una letra de cambio segun el articulo 774 al 779 del codigo de comercio ';
	?>
	</h8></td>
    <td width="13%"><h8>
      &nbsp;
    </h8></td>
    <td width="5%"><h8>&nbsp;
      
    </h8></td>
    <td width="13%"><h8>
	<div align = "right">
    <?php  
        if( $datos[0]['resolucion'] == 1)  

            { echo '$'.number_format($datos[0]['subtotalfac'], 0, ',', '.'); }
         else
          {echo '$'.number_format($total, 0, ',', '.'); } 

    ?>
	</div>
    </h8></td>
  </tr>
<tr>
  <td>
  <h8><div align="center"><?php echo $palabra_iva  ?></div></h8>
  </td>
    <td width="5%"><h8>
	</td>
  <td><h8>
	<div align = "right">
    <?php 
         if( $datos[0]['resolucion'] == 1)  
             { echo '$'.number_format($datos[0]['ivafac'], 0, ',', '.'); }
           else{   echo '$0';    }
      ?>
	</div>
    </h8></td>
  
</tr>
<tr>
  <td> <h8><div align="center"><?php echo $palabra_retefuente ?> </div></h8></td>
  <td>&nbsp;</td>
  <td><h8>
	<div align = "right">
    <?php  echo '$'.number_format($datos[0]['retefuentefac'], 0, ',', '.') ?>
	</div>
    </h8></td>
</tr>
<tr>
  <td> <h8><div align="center">TOTAL </div></h8></td>
  <td>&nbsp;</td>
  <td><h8>
	<div align = "right">
    <?php  echo '$'.number_format($datos[0]['totalfac'], 0, ',', '.') ?>
	</div>
    </h8></td>
</tr>
</table>






</body>

<?php

function completar_espacios($numero_items)
	{    
	     $repeticiones = 7-$numero_items['total'];
				for ($i = 1 ; $i<= $repeticiones;$i++)
						{							  
						 echo '
							  <tr>
								<td width="11%"><h8>
								  <div align="center">&nbsp;</div>
								</h8></td>
								<td width="38%"><h8>
								  <div align="center">&nbsp;</div>
								</h8></td>
								<td width="13%"><h8>
								  <div align="center">&nbsp; </div>
								</h8></td>
								<td width="13%"><h8>
								  <div align="center">&nbsp; </div>
								</h8></td>
								<td width="5%"><h8>
								  <div align="center">&nbsp;</div>
								</h8></td>
								<td width="13%"><h8>
								  <div align="center">&nbsp;</div>
								</h8></td>
							  </tr>';
							}// fin de ciclo for 
	}// fin de la funcion
?>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

