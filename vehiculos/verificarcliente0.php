<?
include('../valotablapc.php');	

 if($identipan!="")

{


		$tabla =  $tabla3;
		$username = $usuario;
		$password1 = $clave;
		$dbName   = $nombrebase;
		$hostname = $servidor;
		
mysql_connect($hostname,$username,$password1) or
print "Error en la Conexión";

mysql_select_db($dbName) or
print "Error en la Base de datos";

$consulta = "select * from $tabla where identi='".$identipan."'";
$resultado=mysql_query($consulta);
$numregistros=mysql_numrows($resultado);
$j=mysql_num_fields($resultado);
$row=mysql_fetch_row($resultado);



         
		$i=0;
		while ($i < $numregistros)
	 	{
      	$identipan=	mysql_result($resultado,$i,identi);
		$nompan=	mysql_result($resultado,$i,nombre);
		$telepan=	mysql_result($resultado,$i,telefono);
		$dirpan=	mysql_result($resultado,$i,direccion);
		$obseasegpan=	mysql_result($resultado,$i,observaci);
	    $emailpan=	mysql_result($resultado,$i,email);
	     $i++;
	    }
}
 ?>

