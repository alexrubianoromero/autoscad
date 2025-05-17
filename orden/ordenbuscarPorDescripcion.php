<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$sql = "select * from productos where descripcion like '%".$_REQUEST['descripcion']."%' ";
// die($sql);
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
<?php
echo '<table>'; 
echo '<tr>';
echo '<td>Codigo</td>'; 
echo '<td>Descripcion</td>'; 
echo '</tr>';
foreach($productos as $producto){
    
    echo '<tr>'; 
        // echo '<td><button onclick="asignaracodigopan123('.$producto['codigo_producto'].');">'.$producto['codigo_producto'].'</button></td>'; 
       ?>
        <!-- <td><button onclick="asignaracodigopan123(<?php  echo $producto['codigo_producto']; ?>);"><?php  echo $producto['codigo_producto']; ?></button></td>  -->
        <td><input type="button" id="elcodigo" onclick="asignaracodigopan123(<?php  echo $producto['codigo_producto']; ?>);"
        value="<?php  echo $producto['codigo_producto']; ?>"></td> 
      <?php  
        echo '<td>'.$producto['descripcion'].'</td>'; 
    echo '</tr>';
}
echo '</table>';
?>

</body>
</html>
<script>
    //   function asignaracodigopan123(codigo){
	//   event.preventDefault();
	//   alert('buenas '+codigo); 
	//   document.getElementById('codigopan').value='12345678';
  } 
</script>
