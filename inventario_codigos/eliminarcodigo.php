<?php  
  session_start();
  include('../valotablapc.php');  
//   echo '<pre>';
//   print_r($_REQUEST);
//   echo '</pre>';

  $sql = "delete  from productos where id_codigo = '".$_REQUEST['id_codigo']."'   ";
//   die($sql);
  $consulta = mysql_query($sql,$conexion);
//   echo 'codigo eliminado ';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        Codigo Eliminado
</body>
</html>