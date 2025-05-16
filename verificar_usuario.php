<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

include('valotablapc.php');

$sql_usuarios ="select * from $tabla16 where login = '".$_POST['usuario']."' ";
//echo '<br>consulta'.$sql_usuarios;
$consulta_usuario = mysql_query($sql_usuarios,$conexion);
$datos_base = mysql_fetch_assoc($consulta_usuario);


$filas = mysql_num_rows($consulta_usuario);
//echo 'idempresa = '.$datos_base['idempresa'];
//echo 'la clave de la base '.$datos_base['clave'];
//exit();

//echo '<br>numero de filas'.$filas ;

if($filas == 0 )
		{
		  //echo "<br><h2>USUARIO NO EXISTE</h2><br>";
		  session_destroy();
       //echo "Has cerrado la sesion";
		  include('index.php');
		}  
		else
		{
		   
		   if($_POST['clave'] ==  $datos_base['clave'] )
		     		{
					  //echo "<br>CLAVE CORRRECTA";
					  $_SESSION['usuario']=$_REQUEST['usuario'];
					  $_SESSION['id_empresa']=$datos_base['idempresa'];
					  $_SESSION['id_usuario']=$datos_base['id_usuario'];
					  $_SESSION['id_perfil']=$datos_base['id_perfil'];
					  $login = traer_nombre_usuario($_SESSION['id_usuario']);
					  $nombre_perfil = traer_nombre_perfil($_SESSION['id_perfil']);
					  
					  $_SESSION['nombre_usuario'] = $login;
					  $_SESSION['nombre_perfil'] =  $nombre_perfil;
					  include('menu_principal.php');
					}
					
			else {
			        echo "<br>CLAVE INCORRRECTA";
				 	include('index.php');
					session_destroy();
       				//echo "Has cerrado la sesion";
				}		
		   
		}
//////////////////////////
function traer_nombre_usuario($id_usuario)
{
			include('valotablapc.php');
			$sql_usuarios ="select login from $tabla16 where id_usuario = '".$id_usuario."' ";
			//echo '<br>'.$sql_usuarios.'<br>';
			//exit();
			$consulta_login = mysql_query($sql_usuarios,$conexion);
			$login = mysql_fetch_assoc($consulta_login);	
			$login = $login['login'];
			return $login;
}
function traer_nombre_perfil($id_perfil)
	{
				
				include('valotablapc.php');
				$sql_nombre_perfil = "select * from $tabla30 where id_perfil = '".$id_perfil."'  " ;
				//echo '<br>'.$sql_nombre_perfil.'<br>';
				
				$consulta_perfil = mysql_query($sql_nombre_perfil,$conexion);
				
				$nombre_perfil= mysql_fetch_assoc($consulta_perfil);
				$nombre_perfil = $nombre_perfil['nombre_perfil'];
				return $nombre_perfil;
				
	}
?>
