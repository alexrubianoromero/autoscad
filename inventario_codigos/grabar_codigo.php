<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/
include('../valotablapc.php');  
if ($_POST['nomina']== 'undefined'){$_POST['nomina'] = 0;}

//verificar que el codigo no esxita en la base de datos 
$sql_verificar_si_existe_codigo = "select * from  $tabla12  where  codigo_producto = '".$_REQUEST['codigo']."' and id_empresa =   '".$_SESSION['id_empresa']."' ";

$consulta_verificar_codigo = mysql_query($sql_verificar_si_existe_codigo,$conexion);
$filas_verificar = mysql_num_rows($consulta_verificar_codigo);

if($filas_verificar < 1)
	{  // realizar las accciones de crearlo

			$sql_grabar_codigo ="insert into $tabla12 		(codigo_producto,descripcion,valor_unit,cantidad,id_empresa,valorventa,iva,nomina,cantidad_inicial)   
			values (
			'".$_POST['codigo']."',
			'".$_POST['descripcion']."',
			'".$_POST['valorunit']."',
			'".$_POST['cantidad']."',
			'94',
			'".$_POST['valorventa']."',
			'".$_POST['iva']."',
			'".$_POST['nomina']."',
			'".$_POST['cantidad']."'
			)  ";
			$consulta_grabar_codigo = mysql_query($sql_grabar_codigo,$conexion);
			
			/////////////////////
			//debo obtener el id del producto 
			$sql_traer_id_producto = "select id_codigo from $tabla12 where codigo_producto = '".$_REQUEST['codigo']."'    and id_empresa = '".$_SESSION['id_empresa']."'      "; 
			$consulta_id_producto  =  mysql_query($sql_traer_id_producto,$conexion);
			$id_producto = mysql_fetch_assoc($consulta_id_producto);
			/*
			echo '<pre>';
			print_r($id_producto);
			echo '</pre>';
			*/
			$id_codigo_producto = $id_producto['id_codigo'];
			
			/////////////////////////////
			//ahora debe grabar el moviento en la tabla de movimientos 
			$sql_grabar_movimiento = "insert into $tabla19 (fecha_movimiento,cantidad,tipo_movimiento,id_codigo_producto,id_empresa,observaciones,facturacompra) 
			values (
			'".$_REQUEST['fecha']."','".$_REQUEST['cantidad']."','1'
			,'".$id_codigo_producto = $id_producto['id_codigo']."'
			,'".$_SESSION['id_empresa']."'
			,'Saldo Inicial'
			,'".$_REQUEST['factura_compra']."'
			)";
			
			$grabar_movimiento = mysql_query($sql_grabar_movimiento,$conexion); 
			////////////////
			//echo '<br>consulta<br>'.$sql_grabar_movimiento;
			echo '<br><h3>CODIGO GRABADO</h3>';
	} // frin de si el codigo no existe
else {  echo 'ESTE CODIGO YA EXISTE NO SE PUEDE GRABAR COMO CODIGO NUEVO <BR> SI DESEA AUMENTAR CANTIDAD DE EXISTENCIAS SE DEBE REALIZAR POR<BR>
ADICIONAR EXISTENCIAS';}
//include('../colocar_links2.php');
/*
echo '<br><a href="index.php">Menu Codigos</a>';
echo '<br><a href="../menu_principal.php">Menu Principal</a>';
*/
?>



