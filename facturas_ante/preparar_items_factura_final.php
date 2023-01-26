<?php
session_start();
include('../valotablapc.php');

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="./js/jquery.js" type="text/javascript"></script>
</head>
<body>

<?php
//$sql_traer_item = "select * from tabla15 where no_factura = ''_";
//$sql_update_items= "update $tabla15 set    where  id_item = '' " ;
//echo 'fffffffffffffffffffffffffffffffffff';
for ($i = 0 ;$i<= $_POST['control'];$i++)

		{
		   //echo '<br>id'.$_POST["id_item_$i"].'porcentaje '.$_POST["porcentaje_$i"];
		   $sql_traer_item = "select * from $tabla15 where id_item  = '".$_POST["id_item_$i"]."'";
		   //echo '<br>'.$sql_traer_item;
		   //exit();
		   $consulta_item = mysql_query($sql_traer_item,$conexion);  
		   $item_informacion = mysql_fetch_assoc($consulta_item);

		   $total_iva = ($item_informacion['total_item'] * $_POST["porcentaje_$i"])/100;
		   $total_item_con_iva = $item_informacion['total_item'] + $total_iva;
		   if($_POST["porcentaje_$i"] > 0)
			   	{

			   		$indicador = 1;;	
			   	} 
			 else {$indicador = 0;}  	

		   $sql_update_items= "update $tabla15 set  iva = '".$indicador."' , total_item_con_iva = '".$total_item_con_iva."'    where  id_item = '".$_POST["id_item_$i"]."' " ;
		   $consulta_actualizar_item = mysql_query($sql_update_items,$conexion);


		}

include('prueba_items.php');

?>


</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   