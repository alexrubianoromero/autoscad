<?php
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$fechapan =  time();
$fechapan = date ( "Y/m/j" , $fechapan );

include('../valotablapc.php');

$datos_orden =  consulta_assoc($tabla14,'id',$_REQUEST['idorden'],$conexion);
$datos_carro = consulta_assoc($tabla4,'placa',$datos_orden['placa'],$conexion);

$sql_no_items = "select * from $tabla15   where no_factura =  '".$_REQUEST['idorden']."'   ";
$con_items = mysql_query($sql_no_items,$conexion);
$filas_items = mysql_num_rows($con_items);

///actualizar repman
while($items = mysql_fetch_assoc($con_items))
{
	//echo '<br>'.$items['id_item'];
    $nombre = 'repman_'.$items['id_item']; 
    $valor_123 =  'valor_'.$items['id_item']; 

	$sql_actualizar_item = "update $tabla15   set  
	repman = '".$_REQUEST[$nombre]."' ,
	total_item = '".$_REQUEST[$valor_123]."' ,
	valor_unitario = '".$_REQUEST[$valor_123]."' 

	where id_item = '".$items['id_item']."'  ";
	//echo '<br>'.$sql_actualizar_item;
	$con_repman = mysql_query($sql_actualizar_item,$conexion);
}
///verificar que el ide de la orden no este relacionado con alguna 
////factura creada 
///esto lo soluciono simplemente en las ordenes ya no aparecera la opcion de crear factura solo ver si 
////ya tiene una factura creada 
///////////////////////crear la factura 
/////traer ultimo numero de factura 
$sql_numero_actual_factura = "select contafac from $tabla10";
$con_num_factura= mysql_query($sql_numero_actual_factura,$conexion);
$arr_num_fact= mysql_fetch_assoc($con_num_factura);

$siguiente_numero = $arr_num_fact['contafac'] + 1;
//echo '<br>'.$siguiente_numero;

$sql_crear_factura = "insert into $tabla11  (numero_factura,fecha,id_empresa,kilometraje,idcarro)   
values (
'".$siguiente_numero."'
,'".$fechapan."'
,'94'
,'".$datos_orden['kilometraje']."'
,'".$datos_carro['idcarro']."'
	)";
//echo '<br>'.$sql_crear_factura;
$con_crear_factura = mysql_query($sql_crear_factura,$conexion);
///////////////////////////////////////////////////

////////////////actualizr el numero de factura en la tabla de empresa 
$sql_actualizar_empresa = "update $tabla10 set contafac = '".$siguiente_numero."'   where id_empresa = '94' ";
$con_actu_fact=mysql_query($sql_actualizar_empresa,$conexion);
//////////////////////////////// obtener el id de la factura que se creo
$sql_max_id_factura = "select max(id_factura) as maximoid from $tabla11  ";
$con_max_id_factura = mysql_query($sql_max_id_factura,$conexion);
$arr_id_factura = mysql_fetch_assoc($con_max_id_factura);
//echo '<br>'.$arr_id_factura['maximoid'];
$id_factura = $arr_id_factura['maximoid'];
//////////////////////////////////asignar el id_factura a la orden
$sql_asignar_id_factura = "update $tabla14 set  factura =  '".$siguiente_numero."' , id_factura  =   '".$arr_id_factura['maximoid']."'   where id = '".$_REQUEST['idorden']."'    ";
//echo '<br>'.$sql_asignar_id_factura;
$con_asignar_id = mysql_query($sql_asignar_id_factura,$conexion);

//////////////////trasladar los items de cotizacion a items de factura
/////////////////traer los items de la cotizacion e irlos pasando uno a uno 
$sql_items_cot = "select * from $tabla15  where no_factura = '".$_REQUEST['idorden']."' ";
$con_items_cot = mysql_query($sql_items_cot,$conexion);
//echo '<br>--------------------------<br>';
while($items_cot = mysql_fetch_assoc($con_items_cot))
{
	//echo '<br>'.$items_cot['repman'];
	$sql_inser_item_factura = "insert into $tabla13(no_factura,codigo,descripcion,cantidad,total_item,valor_unitario,
		id_empresa,estado,anulado,repman)   
	values('".$id_factura."','".$items_cot['codigo']."','".$items_cot['descripcion']."','".$items_cot['cantidad']."'
		,'".$items_cot['total_item']."'
		,'".$items_cot['valor_unitario']."'
		,'94'
		,'0'
		,'0'
		,'".$items_cot['repman']."'
		)";
//	echo '<br>',$sql_inser_item_factura;
	$consulta_trasladar_items = mysql_query($sql_inser_item_factura,$conexion);
}//fin de while

  ///////////////////////////////////////////////////

  echo '<br>LA FACTURA No '.$siguiente_numero.' SE CREO CON EXITO <BR>';
  echo '<br>';
  echo '<a href="../facturas/imprimir_cotizacion?id_cotizacion='.$id_factura.'   " target="_blank">VER FACTURA </a>';
?>



<?php
//funciones
 function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }



?>