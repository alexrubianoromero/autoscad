<?php
include('../valotablapc.php');
// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
$sql = "select * from $tabla16  where login = '".$_REQUEST['usuario']."'   ";
$consulta_usuario = mysql_query($sql,$conexion);
$numfilas = mysql_num_rows($consulta_usuario);
$aviso = "La informacion se ha enviado al correo registrado para su usuario";
if($numfilas > 0){
 $datos_usuario = mysql_fetch_assoc($consulta_usuario);
 $headers .= "From: Soporte Kaymo  <ventas@alexrubiano.com>\r\n"; 
 $body = "
 De acuerdo a su solicitud se procede a informar la clave de su usuario 
 clave:  ".$datos_usuario['clave'] ;
 mail($datos_usuario['email'],"Contrasena Kaymo",$body,$headers); 
}
else {
    $aviso = 'NO EXISTE EL USUARIO INDICADO ';
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            body,h3{
                color:white;
            }
    </style>
</head>
<body>
    <H3><?php  echo $aviso; ?></H3>
</body>
</html>