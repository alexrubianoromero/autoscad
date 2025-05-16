<?php
header('Content-Type:text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="Reporte Productos.xls"');

include('../valotablapc.php');  
include('../funciones.php');  
$sql ="select * from productos order by id_codigo desc"; 
$consulta = mysql_query($sql,$conexion); 
$productos = get_table_assoc($consulta);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <table>
        <tr>
            <td>id</td>
            <td>Codigo</td>
            <td>Descripcion</td>
            <td>Vr Compra</td>
            <td>Existencias</td>
            <td>Prod Min</td>
        </tr>
        <?php   
       foreach($productos as $producto)
       {
           echo '<tr>';
              echo '<td>'.$producto['id_codigo'].'</td>';   
              echo '<td>'.$producto['codigo_producto'].'</td>';   
              echo '<td>'.$producto['descripcion'].'</td>';   
              echo '<td>'.$producto['valor_unit'].'</td>';   
              echo '<td>'.$producto['cantidad'].'</td>';   
              echo '<td>'.$producto['producto_minimo'].'</td>';   
             echo ' </tr>';
       }
      ?>
       
    </table>
</body>
</html>