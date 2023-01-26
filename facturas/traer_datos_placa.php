<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$sql_buscar_codigo = "
select ca.idcarro,ca.tipo,ca.marca,ca.modelo,ca.color,cli.identi,cli.nombre,cli.direccion,cli.telefono,cli.email,cli.idcliente from $tabla4 ca
inner join $tabla3 cli on (cli.idcliente = ca.propietario)
 where ca.placa = '".$_REQUEST['placa']."' 
";
//select * from $tabla12 where codigo_producto  = '".$_POST['codigopan']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_codigo = mysql_query($sql_buscar_codigo,$conexion);
if (mysql_num_rows($consulta_codigo) > 0)
		{			
				$datos123 = get_table_assoc($consulta_codigo);
    	} 			
//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"tipo":"'.$datos123[0]['tipo'].'",
"identi":"'.$datos123[0]['identi'].'",
"nombre":"'.$datos123[0]['nombre'].'"
,"marca":"'.$datos123[0]['marca'].'"
,"modelo":"'.$datos123[0]['modelo'].'"
,"color":"'.$datos123[0]['color'].'"
,"direccion":"'.$datos123[0]['direccion'].'"
,"telefono":"'.$datos123[0]['telefono'].'"
,"email":"'.$datos123[0]['email'].'"
,"idcarro":"'.$datos123[0]['idcarro'].'"
,"idcliente":"'.$datos123[0]['idcliente'].'"

}]';


?>
