<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '/<pre>';
exit();
*/


include('../valotablapc.php');	

		$tabla =  $tabla3;
		$username = $usuario;
		$password1 = $clave;
		$dbName   = $nombrebase;
		$hostname = $servidor;



$consulta = "select * from $tabla where idcliente= '$propi1' ";
$resultado=mysql_query($consulta);
$numregistros=mysql_numrows($resultado);
$j=mysql_num_fields($resultado);
$row=mysql_fetch_row($resultado);



         
		$i=0;
		while ($i < $numregistros)
	 	{
      	$propipan=	mysql_result($resultado,$i,identi);
	     $i++;
	    }

$sql_grabar_carro = "insert into $tabla4 (placa,marca,modelo,cilindraje,aseguradora,propietario,observaciones,id_empresa) 
   values ('".$_POST['placapan']."','".$_POST['marcapan']."','".$_POST['modelopan']."',
   '".$_POST['cilinpan']."','".$_POST['asegpan']."','".$_POST['propi1']."','".$_POST['obsevehipan']."','".$_SESSION['id_empresa']."')";
   mysql_query($sql_grabar_carro,$conexion);
  include("grabadocarro.php");

    
?>


