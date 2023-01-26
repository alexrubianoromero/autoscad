<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php
include('../valotablapc.php');
include('../funciones.php');
$sql_placa = "select * from carros where placa = '".$_REQUEST['placa']."'  and  id_empresa = '".$_SESSION['id_empresa']."'  ";
//echo $sql_placa;
$consulta_placa = mysql_query($sql_placa,$conexion);
$filas_placa = mysql_num_rows($consulta_placa);
//echo 'filas ='.$filas_placa;
if($filas_placa == 0)
	{
	 echo '<h2>PLACA '.$_REQUEST['placa'].'NO EXISTE</h2>';
	}
else
	{
	 echo '<h2>PLACA '.$_REQUEST['placa'].' SI EXISTE</h2>';
	}

?>


</body>
</html>
