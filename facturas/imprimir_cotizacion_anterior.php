<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<title>Untitled Document</title>

<style type="text/css">
#tablita td{
height:20px;
}
#tabla_final
td{
height:20px;
}

#tabla_items td {
height:12px;
}
#inicial td{
height:1px;
}
#espacio_medio td {
height:1px;
}

#espacio_final td {
height:1px;
}
#Layer1 {
	position:absolute;
	width:94%;
	height:115px;
	z-index:1;
	left: 11px;
	/*border: 1px solid black;*/
}
</style>
</head>
<?php
include('../valotablapc.php');
include('../num2letras.php'); 

$sql_iva = "select iva from $tabla17 ";
$consulta_iva = mysql_query($sql_iva,$conexion);
$arr_iva = mysql_fetch_assoc($consulta_iva);
$iva = $arr_iva['iva'];
$sql_numero_cotizacion ="select cot.fecha,cot.id_factura,cot.numero_factura,
cot.kilometraje,cot.observaciones,
cli.identi,cli.direccion,cli.nombre,cli.email,cli.telefono,c.color,c.marca,c.placa,c.modelo,c.tipo 
from $tabla11 cot
inner join $tabla4 c on (c.idcarro = cot.idcarro)
inner join $tabla3 cli on (cli.idcliente = c.propietario)
where 
id_factura = '".$_REQUEST['id_cotizacion']."'  ";
//echo '<br>'.$sql_numero_cotizacion;
$consulta_cotizacion = mysql_query($sql_numero_cotizacion,$conexion);
$arr_cot = mysql_fetch_assoc($consulta_cotizacion);




$solo_sumar_mano = solo_sumar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'M',$conexion,$ancho_tabla);
$solo_sumar_repuestos = solo_sumar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'R',$conexion,$ancho_tabla);
$solo_sumar_aceites = solo_sumar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'A',$conexion,$ancho_tabla);
$sumar_repuestos213 = $solo_sumar_repuestos + $solo_sumar_aceites;
$subtotales123 = $solo_sumar_mano + $sumar_repuestos213;




$tamano_letra = '12px';
$ancho_tabla= "95%";
$tamano_inicial = '24px';
$tamano_medio = '24px';
$tamano_letra_items = '12px';
$ancho_tabla_items = '95%';
$tamano_final = '14px';

?>

<body>
<br><br><br><br><br><br>
<table id="inicial" width="29" border="0"   style="font-size:<?php echo $tamano_inicial; ?>">
  <tr>
    <td height="38" >&nbsp;</td>
  </tr>
</table>

<table id="tablita"
 width="<?php   echo $ancho_tabla; ?>" border="0" cellspacing="1" cellpadding="1" 
 style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td width="20%">&nbsp;</td>
    <td colspan="4"><?php  
	$longitud_nombre = strlen($arr_cot['nombre']); 
	
	echo $arr_cot['nombre'];  ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4"><?php  echo $arr_cot['direccion']  ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="25%"><?php  echo $arr_cot['telefono']  ?></td>
    <td width="15%">&nbsp;</td>
    <td width="20%"><?php  echo $arr_cot['color']  ?></td>
    <td width="20%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php  echo $arr_cot['identi']  ?></td>
    <td>&nbsp;</td>
    <td><?php  echo $arr_cot['tipo']  ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php  echo $arr_cot['marca']  ?></td>
    <td>&nbsp;</td>
    <td><?php  echo $arr_cot['placa']  ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php  echo $arr_cot['modelo']  ?></td>
    <td>&nbsp;</td>
    <td><?php  echo $arr_cot['kilometraje']  ?></td>
    <td><?
	$fecha2=date("d-m-Y",strtotime($arr_cot['fecha'] ));
	$dia = substr($fecha2,0,2);
	$mes = substr($fecha2,3,2);
	$ano  = substr($fecha2,6,4);
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp'.$dia,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$mes.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ano;
	
	 //echo   $fecha2;?> 
	 <?php  //echo $arr_cot['fecha']  ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table id="espacio_medio" width="29" border="0"   style="font-size:<?php echo $tamano_medio; ?>">
  <tr>
    <td height="38" >&nbsp;</td>
  </tr>
</table>
<table  width="<?php   echo $ancho_tabla; ?>" border="0" cellspacing="2" cellpadding="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td height="192">
	<div id="Layer1">
	<?php
	$suma_mano 
	=mostrar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'M',$conexion,$ancho_tabla_items,$tamano_letra_items);
	$suma_aceites 
	=mostrar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'A',$conexion,$ancho_tabla_items,$tamano_letra_items);
	$suma_repuestos 
	=mostrar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'R',$conexion,$ancho_tabla_items,$tamano_letra_items);
	

$suma_repuestos_aceites = $suma_aceites + $suma_repuestos;
$subtotales = $suma_mano  + $suma_repuestos + $suma_aceites; 
$valor_iva = ( ($suma_mano +$suma_repuestos) * $iva)/100;
$total = $subtotales + $valor_iva;	

 $letras = num2letras($total);
    ?>
	</div>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	</td>
  </tr>
</table>
<table id="espacio_final" width="29" border="0"   style="font-size:<?php echo $tamano_final; ?>">
  <tr>
    <td  >&nbsp;</td>
  </tr>
</table>
<table  id="tabla_final" width="<?php   echo $ancho_tabla; ?>" border="0" cellspacing="2" cellpadding="1" style="font-size:<?php echo $tamano_letra; ?>" >
  <tr>
    <td width="10%" rowspan="4">&nbsp;</td>
    <td width="60%" rowspan="4"><BR><?php  echo $letras.' Pesos M/cte';  ?></td>
    <td width="10%">&nbsp;</td>
    <td width="15%" align="right"><?php echo '$'.number_format($solo_sumar_mano, 0, ',', '.'); ?></td>
    <td width="5%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><?php echo '$'.number_format($sumar_repuestos213, 0, ',', '.'); ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><?php echo '$'.number_format($subtotales123, 0, ',', '.'); ?></td>
    <td></td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2"><br><?php  echo $arr_cot['observaciones'];  ?> </td>
    <td>&nbsp;</td>
    <td align="right"><?php echo '$'.number_format($valor_iva, 0, ',', '.'); ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><?php echo '$'.number_format($total, 0, ',', '.'); ?></td>
    <td>&nbsp;</td>
  </tr>
</table>


</body>
</html>
<?php
function mostrar_items_parametro($tabla,$id_cotizacion,$parametro,$conexion,$ancho_tabla,$tamano_letra_items){
  $sql_items = "select * from $tabla  where no_factura = '".$id_cotizacion."'  
   and repman = '".$parametro."'       ";
	 //
  //echo'<br>consulta'.$sql_items;
  $consulta_items_cotizacion =mysql_query($sql_items,$conexion);
  $filas = mysql_num_rows($consulta_items_cotizacion);
  
 //echo '<br>'.$filas;
  $no_item =1;
  $suma_item = 0;
  //echo '<table border="1"  width="'.$ancho_tabla.'">';
  if($parametro == 'M'){$nombre_bloque = '<strong><em>MANO DE OBRA</em></strong>';}
  /*else {$nombre_bloque = 'ACEITES Y REPUESTOS';}*/
  
    if($parametro == 'A'){$nombre_bloque = '<strong><em>ACEITE EXCENTO DE IVA</em></strong>';}
	 if($parametro == 'R'){$nombre_bloque = '<strong><em>REPUESTOS</em></strong>';}
	 
 ?>
<table id="tabla_items"
 width="<?php   echo $ancho_tabla; ?>" border="0" 
 style="font-size:<?php echo $tamano_letra_items; ?>">
 <?php
  echo '<tr>';
echo '<td  width= "10%"></td>';
echo '<td width= "80%"></td>';
echo '<td width= "15%" align ="right"></td>';
 echo '</tr>';
 echo '<tr>';
echo '<td  width= "10%"></td>';
echo '<td width= "80%">'.$nombre_bloque.'</td>';
echo '<td width= "15%" align ="right"></td>';
 echo '</tr>';
   echo '<tr>';
echo '<td  width= "10%"></td>';
echo '<td width= "80%"></td>';
echo '<td width= "15%" align ="right"></td>';
 echo '</tr>';
 while ($item = mysql_fetch_assoc($consulta_items_cotizacion))
 {
        echo '<tr>'; 
		echo '<td  width= "10%"></td>';
      //echo '<td align="center">'.$no_item.'</td>';
      echo '<td width= "80%">'.$item['descripcion'].'</td>';
      echo '<td width= "15%" align ="right">'.'$'.number_format($item['total_item'], 0, ',', '.').'</td>';
     echo '<td width= "5%"></td>';
	  echo '</tr>';
      $no_item ++;
      $suma_item = $suma_item + $item['total_item'];
	  //echo '<br>qweqeqw'.$suma_item;
  }//fin de while
  ?>
  </table>
  <?php
  // if($parametro != 'A'){
   //completar_espacios_cotiza($filas);}
 return $suma_item;
  //echo '</table>';
  
}

function completar_espacios_cotiza($filas){
  $no_filas_pintar = 12 - $no_filas;
  for( $i=1; $i <= $no_filas_pintar;$i++)
  {
    echo '<tr>';
    echo '<td>&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
  }

}//fin de funcion completar_espacios_cotiza


//////////////////////////////////////
function solo_sumar_items_parametro($tabla,$id_cotizacion,$parametro,$conexion,$ancho_tabla){
  $sql_items = "select * from $tabla  where no_factura = '".$id_cotizacion."'  
   and repman = '".$parametro."'       ";
	 //
  //echo'<br>consulta'.$sql_items;
  $consulta_items_cotizacion =mysql_query($sql_items,$conexion);
  $filas = mysql_num_rows($consulta_items_cotizacion);
  
 //echo '<br>'.$filas;
  $no_item =1;
  $suma_item = 0;
  //echo '<table border="1"  width="'.$ancho_tabla.'">';
  
 while ($item = mysql_fetch_assoc($consulta_items_cotizacion))
 {
     /*
	  echo '<tr>';
      echo '<td align="center">'.$no_item.'</td>';
      echo '<td>'.$item['descripcion'].'</td>';
      echo '<td align ="right">'.'$'.number_format($item['total_item'], 0, ',', '.').'</td>';
      echo '</tr>';
	  
      $no_item ++;
	  */
      $suma_item = $suma_item + $item['total_item'];
	  //echo '<br>qweqeqw'.$suma_item;
  }//fin de while
  // if($parametro != 'A'){
   //completar_espacios_cotiza($filas);}
 return $suma_item;
  //echo '</table>';
  
}

//////////////////////////////////
?>