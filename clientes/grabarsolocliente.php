<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '/<pre>';
exit();
*/

include('../valotablapc.php'); 
$sql_grabar_cliente = "insert into $tabla3 (identi,nombre,telefono,email,direccion,observaci,id_empresa) 
values ('".$_POST['identipan']."','".$_POST['nompan']."','".$_POST['telepan']."','".$_POST['emailpan']."','".$_POST['dirpan']."',
	'".$_POST['obseasegpan']."','".$_SESSION['id_empresa']."')";

   mysql_query($sql_grabar_cliente,$conexion);
  include("clientegrabado.php");
  //".$_POST['obseasegpan']."
  
?>


