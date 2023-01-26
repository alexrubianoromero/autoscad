<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<title>Untitled Document</title>

<style type="text/css">
.parametros{
font-size:12px;
}
<!--

#Layer1{
	position:absolute;
	width:272px;
	height:19px;
	z-index:1;
	left: 189px;
	top: 179px;
	font-size:12px;
	
}
#Layer2 {
	position:absolute;
	width:289px;
	height:22px;
	z-index:2;
	top: 211px;
	left: 188px;
	font-size:12px;
}
#Layer3 {
	position:absolute;
	width:200px;
	height:13px;
	z-index:3;
	top: 241px;
	left: 190px;
	font-size:12px;
}
#Layer4 {
	position:absolute;
	width:200px;
	height:15px;
	z-index:4;
	left: 190px;
	top: 267px;
	font-size:12px;
}
#Layer5 {
	position:absolute;
	width:200px;
	height:18px;
	z-index:5;
	left: 188px;
	top: 292px;
	font-size:12px;
}
#Layer6 {
	position:absolute;
	width:200px;
	height:22px;
	z-index:6;
	left: 581px;
	top: 296px;
		font-size:12px;
}
#Layer7 {
	position:absolute;
	width:200px;
	height:20px;
	z-index:7;
	left: 188px;
	top: 322px;
}
#Layer8 {
	position:absolute;
	width:200px;
	height:18px;
	z-index:8;
	left: 580px;
	top: 321px;
}
#Layer9 {
	position:absolute;
	width:200px;
	height:1560px;
	z-index:9;
	left: 40px;
	top: 591px;
}
#Layer10 {
	position:absolute;
	width:200px;
	height:22px;
	z-index:1;
	left: 580px;
	top: 243px;
}
#Layer11 {
	position:absolute;
	width:200px;
	height:22px;
	z-index:1;
	left: 391px;
	top: 92px;
}
#Layer12 {
	position:absolute;
	width:200px;
	height:20px;
	z-index:10;
	left: 794px;
	top: 323px;
}
#Layer13 {
	position:absolute;
	width:741px;
	height:115px;
	z-index:11;
	left: 194px;
	top: 405px;
}
#Layer14 {
	position:absolute;
	width:197px;
	height:26px;
	z-index:12;
	left: 869px;
	top: 991px;
}
#Layer15 {
	position:absolute;
	width:200px;
	height:25px;
	z-index:1;
	left: 676px;
	top: 617px;
}
#Layer16 {
	position:absolute;
	width:200px;
	height:25px;
	z-index:13;
	left: 871px;
	top: 1051px;
}
#Layer17 {
	position:absolute;
	width:200px;
	height:21px;
	z-index:14;
	left: 872px;
	top: 1079px;
}
#Layer18 {
	position:absolute;
	width:200px;
	height:21px;
	z-index:15;
	left: 874px;
	top: 1105px;
}
#Layer19 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:2;
	top: 566px;
	left: 248px;
}
-->
</style>
</head>
<?php
include('../valotablapc.php');

$sql_iva = "select iva from $tabla17 ";
$consulta_iva = mysql_query($sql_iva,$conexion);
$arr_iva = mysql_fetch_assoc($consulta_iva);
$iva = $arr_iva['iva'];
$sql_numero_cotizacion ="select cot.fecha,cot.id_factura,cot.numero_factura,
cot.kilometraje,
cli.identi,cli.direccion,cli.nombre,cli.email,cli.telefono,c.color,c.marca,c.placa,c.modelo,c.tipo 
from $tabla11 cot
inner join $tabla4 c on (c.idcarro = cot.idcarro)
inner join $tabla3 cli on (cli.idcliente = c.propietario)
where 
id_factura = '".$_REQUEST['id_cotizacion']."'  ";
//echo '<br>'.$sql_numero_cotizacion;
$consulta_cotizacion = mysql_query($sql_numero_cotizacion,$conexion);
$arr_cot = mysql_fetch_assoc($consulta_cotizacion);
$ancho_tabla= "90%";


$solo_sumar_mano = solo_sumar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'M',$conexion,$ancho_tabla);
$solo_sumar_repuestos = solo_sumar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'R',$conexion,$ancho_tabla);
$solo_sumar_aceites = solo_sumar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'A',$conexion,$ancho_tabla);
$sumar_repuestos213 = $solo_sumar_repuestos + $solo_sumar_aceites;
$subtotales123 = $solo_sumar_mano + $sumar_repuestos213;
?>

<body>
<div id="Layer1" >
  <?php  echo $arr_cot['nombre'].'22222'  ?>
  <div id="Layer11"><?php  echo $arr_cot['tipo']  ?></div>
</div>

<div id="Layer2"><?php  echo $arr_cot['direccion']  ?></div>
<div id="Layer3"><?php  echo $arr_cot['telefono']  ?></div>
  <div id="Layer10"><?php  echo $arr_cot['color']  ?></div>
</div>
<div id="Layer7"><?php  echo $arr_cot['modelo']  ?></div>
<div id="Layer4"><?php  echo $arr_cot['identi']  ?></div>
<div id="Layer5"><?php  echo $arr_cot['marca']  ?></div>
<div id="Layer6"><?php  echo $arr_cot['placa']  ?></div>
<div id="Layer8"><?php  echo $arr_cot['kilometraje']  ?></div>
<div id="Layer16"><?php echo '$'.number_format($subtotales123, 0, ',', '.'); ?></div>
<div id="Layer14"><?php echo '$'.number_format($solo_sumar_mano, 0, ',', '.'); ?></div>
<div id="Layer12"><?php  echo $arr_cot['fecha']  ?></div>
<div id="Layer13">
  <div id="Layer15"><?php echo '$'.number_format($sumar_repuestos213, 0, ',', '.'); ?></div>
<table width="<?php echo $ancho_tabla ?>" border="0">
<?php
$suma_mano =mostrar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'M',$conexion,$ancho_tabla);
//echo '<br>234534'.$suma_mano;
 $suma_aceites=mostrar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'A',$conexion,$ancho_tabla);
$suma_repuestos=mostrar_items_parametro($tabla13,$_REQUEST['id_cotizacion'],'R',$conexion,$ancho_tabla);

$suma_repuestos_aceites = $suma_aceites + $suma_repuestos;
$subtotales = $suma_mano  + $suma_repuestos + $suma_aceites; 
$valor_iva = ( ($suma_mano +$suma_repuestos) * $iva)/100;
$total = $subtotales + $valor_iva;

?>
</table>
</div>
<div id="Layer17"><?php echo '$'.number_format($valor_iva, 0, ',', '.'); ?></div>
<div id="Layer18"><?php echo '$'.number_format($total, 0, ',', '.'); ?></div>
</body>
</html>
<?php
function mostrar_items_parametro($tabla,$id_cotizacion,$parametro,$conexion,$ancho_tabla){
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
      echo '<tr>';
      echo '<td align="center">'.$no_item.'</td>';
      echo '<td>'.$item['descripcion'].'</td>';
      echo '<td align ="right">'.'$'.number_format($item['total_item'], 0, ',', '.').'</td>';
      echo '</tr>';
      $no_item ++;
      $suma_item = $suma_item + $item['total_item'];
	  //echo '<br>qweqeqw'.$suma_item;
  }//fin de while
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