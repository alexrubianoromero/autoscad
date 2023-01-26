<?php
session_start();
include('../valotablapc.php');
//echo '<br>';
//echo 'ACCIONES ASIGNADAS ';
//$sql_accciones_perfil = "select * from $tabla31   where  id_empresa = '".$_SESSION['id_empresa']."' ";

$sql_accciones_perfil = "
select s.id_subcategoria ,id_menu_perfil,c.nombre as categoria,s.nombre  as accion, c.nombre,p.nombre_perfil
from $tabla2 s 
inner join $tabla1 c on (c.id_categoria = s.id_categoria)
inner join $tabla31 mp on (mp.id_menu = s.id_subcategoria)
inner join $tabla30 p on (p.id_perfil = mp.id_perfil) 
where c.id_empresa = '".$_SESSION['id_empresa']."'
and p.id_perfil = '".$_REQUEST['id_perfil']."'
and s.activo = '1'
order by c.orden,s.orden
";
//echo '<br>'.$sql_accciones_perfil;


$sql_acciones_disponibles = "
";
$consulta_acciones = mysql_query($sql_accciones_perfil,$conexion);

echo '<h3><a href = "agregar_accion.php" >AGREGAR ACCION </a></h3>';
echo '<BR>ACCIONES ACTUALMENTE ASIGNADAS <BR>';

echo '<div id ="muestre_aciones_actuales">'; 
echo '<table border = "1" width = "65%">';
echo '<tr><td>CATEGORIA</td><td>ACCION</td><td>ESTADO</td></tr>';

$asignados = ''; //aqui se almacenan los id de las subcategorias que ya estan asignados 
$i=1;
while($acciones = mysql_fetch_assoc($consulta_acciones))
{
	
	$asignados[$i]= $acciones['id_subcategoria'];
	echo '<tr>';
	//echo '<td>'.$acciones['id_subcategoria'].'</td>';
	echo '<td>'.$acciones['categoria'].'</td>';
	echo '<td>'.$acciones['accion'].'</td>';
	echo '<td>AGREGADA</td>';
	//echo '<td><a href="" >'.$acciones['id_menu_perfil'].'ELIMINAR</a></td>';
	echo '</tr>';
	$i++;
}

echo '</table>';
echo '</div>';

echo '<div id = "accciones_disponibles">';

$j=1;
$sqlnoasig = " select s.id_subcategoria,c.nombre as catnombre,s.nombre  as subnombre 
from subcategorias s 
inner join categorias c on (c.id_categoria = s.id_categoria)
where s.id_empresa = '".$_SESSION['id_empresa']."' 
and s.activo = '1'
and s.id_subcategoria not in ";

$sqlnoasig .= '(';
while($j< $i+1)
	{        
		     $sqlnoasig .=  "'".$asignados[$j]."'";
			 if($j == $i){}
			 else {$sqlnoasig .= ',';} 			
		$j++;
	}
$sqlnoasig .= ')';

//$sqlnoasig.= " order by c.orden,s.id_categoria, s.orden";
//echo '<br>slnoasig<br>'.$sqlnoasig;
$consulta_disponibles = mysql_query($sqlnoasig,$conexion);
echo '<BR>ACCIONES DISPONIBLES PARA SER ASIGNADAS<BR><BR>';
echo '<form name = "hojas" method="post" action = "grabar_asignar_accion.php" >';
echo '<tr><td><input type = "submit"  value = "ASIGNAR ACCIONES" ></td></tr>';		
echo '<table border = "1" width = "65%"> ';
echo '<tr>';
echo '<td>CATEGORIA</td>';
echo '<td>ACCION</td>';
echo '<td>AGREGAR</td>';
echo '</tr>';

$g= 1;
while($dispo = mysql_fetch_assoc($consulta_disponibles))
		{
			echo '<tr>';
			echo '<td>'.$dispo['catnombre'].'</td>';
			echo '<td>'.$dispo['subnombre'].'<input type = "hidden" name = "id_subcategoria_'.$g.'"  value = "'.$dispo['id_subcategoria'].'" ></td>';
			echo '<td><input type ="checkbox"  name = "checkbox_'.$g.'"  value = "1" ></td>';
			echo '</tr>';
			$g++;
		}
echo '<tr><td><input type = "hidden"   name = "filas" value = "'.$g.'"> </td></tr>';
echo '<tr><td><input type = "hidden"   name = "id_perfil_asignar" value = "'.$_REQUEST['id_perfil'].'"> </td></tr>';
echo '</table>';	
echo '</form>';

echo '<div>';

?>
