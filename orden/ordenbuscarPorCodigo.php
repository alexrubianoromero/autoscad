<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$sql = "select * from productos where codigo_producto like '%".$_REQUEST['codigo']."%' ";
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
echo '<table border ="1">'; 
echo '<tr>';
echo '<td>Existencias</td>'; 
echo '<td>Codigo</td>'; 
echo '<td>Descripcion</td>'; 
echo '</tr>';
foreach($productos as $producto){
    
    echo '<tr>'; 
      echo '<td>'.$producto['cantidad'].'</td>'; 
       ?>
        <td><input type="button" id="elcodigo" onclick="asignaracodigopan123('<?php  echo $producto['codigo_producto']; ?>');"
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
  // } 

  //   function asignaracodigopan123(codigo){
	//   event.preventDefault();
	//   /* alert('buenas');  */
	//   /* document.getElementById('codigopan').value='12345678'; */
	//   document.getElementById('codigopan').value=codigo;
  // } 
</script>
