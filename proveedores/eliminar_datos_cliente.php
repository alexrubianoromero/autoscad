<?php

include('../valotablapc.php');
//revisar que este cliente no tenga ligado ningun vehiculo 

$sql_revisar_ciente = "select  cli.identi,cli.nombre,c.placa  from $tabla3 as cli 
inner join $tabla4 as c on (c.propietario = cli.idcliente)
where cli.idcliente = '".$_REQUEST['idcliente']."'
";

//echo '<br>'.$sql_revisar_ciente;

$consulta_revision = mysql_query($sql_revisar_ciente,$conexion);
$filas_revision = mysql_num_rows($consulta_revision);

if($filas_revision < 1)
{
$sql_eliminar_cliente = "delete from $tabla3 where idcliente = '".$_REQUEST['idcliente']."'  ";
$consulta_eliminar= mysql_query($sql_eliminar_cliente);
echo 'INFORMACION ELIMINADA ';
}



?>  