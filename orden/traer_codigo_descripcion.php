<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$sql_buscar_codigo = "select * from $tabla12 where codigo_producto  = '".$_POST['codigopan']."' and id_empresa = '".$_SESSION['id_empresa']."'   ";
$consulta_codigo = mysql_query($sql_buscar_codigo,$conexion);
if (mysql_num_rows($consulta_codigo) > 0)
		{			
				$datos123 = get_table_assoc($consulta_codigo);
    	} 	
//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'",
"descripcion":"'.$datos123[0]['descripcion'].'",
"valor_unit":"'.$datos123[0]['valorventa'].'",
"existencias":"'.$datos123[0]['cantidad'].'"
}]';
?>
