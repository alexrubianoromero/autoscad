<html>
<head><title>Actualizacion Poliza</title>
</head>
<body>
<?php

   echo $identipan;
    

function Conectarse()
{
   if (!($link=mysql_connect("localhost","root","peluche")))
   {
      echo "Error conectando a la base de datos .";
      exit();
   }
   if (!mysql_select_db("edelcar",$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}


$link=Conectarse();

   mysql_query("update cliente0 set 
   
  
		nombre     = '$nompan',
		telefono   = '$telepan',
		email      = '$emailpan', 	
		direccion  = '$dirpan',
		observaci  = '$obseasegpan'
	
   
   
   where identi = '$identipan'",$link);
   
   //header("Location: ./listardatos.php");
   mysql_close($link); //cierra la conexion
   
   
include('modificado.htm');
?>

</body>
</html>
