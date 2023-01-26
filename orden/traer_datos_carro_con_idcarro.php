<?php

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit();
*/
include('../valotablapc.php');
include('../funciones.php');
$sql_buscar_codigo = "select tipo,modelo,marca,color from $tabla4 where idcarro  = '".$_POST['codigopan']."' ";
$consulta_codigo = mysql_query($sql_buscar_codigo,$conexion);
if (mysql_num_rows($consulta_codigo) > 0)
		{			
				$datos123 = get_table_assoc($consulta_codigo);
    	} 	
//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"tipo":"'.$datos123[0]['tipo'].'",
"modelo":"'.$datos123[0]['modelo'].'",
"marca":"'.$datos123[0]['marca'].'",
"color":"'.$datos123[0]['color'].'"
}]';
?>
