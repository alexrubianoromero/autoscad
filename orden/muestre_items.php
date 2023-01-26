<?php
include('../valotablapc.php');
$sql_traer_items = "select * from $tabla15 where no_factura = '".$_REQUEST['idorden']."'  order by id_item ";
$consulta_items = mysql_query($sql_traer_items,$conexion);
echo '<br>'.$sql_traer_items;


echo '<table border = "1">';
  while($items = mysql_fetch_assoc($consulta_items))
{
   $sql_operarios_item = "select  nombre from $tabla21 where  idcliente = '".$d['id_mecanico']."'  ";

							$consulta_operariositem =  mysql_query($sql_operarios_item,$conexion);

							$operario = mysql_fetch_assoc($consulta_operariositem);

							$nombre_operario = $operario['nombre'];


   echo '<tr>';
    echo '<td>'.$items['codigo'].'</td>';
    echo '<td>'.$items['descripcion'].'</td>';
     echo '<td>'.$nombre_operario.'</td>';
      echo '<td>'.$items['cantidad'].'</td>';
       echo '<td>'.$items['total_item'].'</td>';
 echo '</tr>';
   
}
echo '</table>';
?>
