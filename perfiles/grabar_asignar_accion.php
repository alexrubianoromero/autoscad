<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$i = 1;

while($i< $_REQUEST['filas']+1)
		{
			$nombre_variable = 'checkbox_'.$i;
			$id_subcategoria = 'id_subcategoria_'.$i;

			if(isset($_REQUEST[$nombre_variable]))	
				{
					//echo '<br>si existe este numero ';
					$sql_grabar_menu_perfil = "insert into $tabla31 (id_perfil,id_menu)  
					values ('".$_REQUEST['id_perfil_asignar']."','".$_REQUEST[$id_subcategoria]."')";
					//echo '<br>'.$sql_grabar_menu_perfil;
					$consulta_grabar_accion = mysql_query($sql_grabar_menu_perfil,$conexion);

				}
			else {	//echo '<br>no existe';
				 }
		$i++;		


		}

	echo '<BR>SE REALIZO LA ACTUALIZACION DEL PERFIL SOLICITADA<BR>';	
?>