<?php
session_start();
/*
echo '<pres>';
print_r($_REQUEST);
echo '<pres>';
*/
include('../valotablapc.php');
include('../funciones.php');
//echo '<br>valor de mecanico<br>'.$_REQUEST['mecanico'];
/*
$sql_ordenes = "select mecanico from $tabla14 where fecha between '".$_REQUEST['fechain']."'   and   '".$_REQUEST['fechafin']."'   and id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0'  group by mecanico  ";
*/
$sql_ordenes = "select mecanico from $tabla14 where fecha between '".$_REQUEST['fechain']."'   and   '".$_REQUEST['fechafin']."'   and id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0'
and estado in (1,2)  group by mecanico  ";

//echo 'consulta<br>'.$sql_ordenes.'<br>';
/*
if($_REQUEST['mecanico']=='...')
{
	echo 'no se escogio mecanico ';
}
else
{
	echo 'siiiiiiiiiiiiiiiii escogio mecanico ';
	$sql_ordenes .= " and mecanico = '".$_REQUEST['mecanico']."' ";
}
*/
//echo '<br>consulta<br>'.$sql_ordenes;
echo '<h3>RESUMEN NOMINA GENERAL MOTOS DEL '.$_REQUEST['fechain'].'  AL '.$_REQUEST['fechafin'].'</h3> ';

 $gran_total = 0;
$consulta_ordenes_fecha = mysql_query($sql_ordenes,$conexion);
while($mecanicos = mysql_fetch_assoc($consulta_ordenes_fecha))
	{
	   
	   echo '<table border = "1" width = "90%"> ';
//echo '<tr><td></td><td>NOMBRE MECANICO</td><td>VALOR MANOS DE OBRA </td></tr>';
	   //tener en cuenta si esta en blanco el nombre del macanico 
	   //echo '<br>'.$mecanicos['mecanico'];
	   
	 
	   $traer_nombre_mecanico = "select nombre from $tabla21  where  id_empresa = '".$_SESSION['id_empresa']."'  and idcliente = '".$mecanicos['mecanico']."' ";
	   $nombre_mecanico = mysql_query($traer_nombre_mecanico,$conexion);
	   $nombre_mecanico  = mysql_fetch_assoc($nombre_mecanico); 
	   $nombre_mecanico =$nombre_mecanico['nombre'];
	   
	     echo '<tr>';
	   echo '<td width ="20%">TECNICO</td>'; 
	   
	   if($mecanicos['mecanico']=='')
	   		{
			echo '<td width ="40%">MECANICO NO ASIGNADO</td>'; 
			}
			else
			{
	      	 echo '<td width ="40%">'.$nombre_mecanico.'</td>'; 
	   		}
		 echo '<td WIDTH = "40%" align = "center"> VALOR MANO DE OBRA</td>';	
	    echo '</tr>';
	   ///////// calculo de manos de obra 
	   //////// buscar todas las ordenes dentro de esas fechas asignadas al mencanico y revisar cada item de esa orden y traer los que sean de codigo de nomina
	   ////////traer los id de las ordenes de ese mecanico 
	   $sql_id_ordenes_mecanico = "select orden,id,placa  from $tabla14 where fecha between '".$_REQUEST['fechain']."'  and   '".$_REQUEST['fechafin']."'    and id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0'  and mecanico = '".$mecanicos['mecanico']."' and estado in (1,2)";
	  // echo '<br>consulta_mecanicos'.
	   $consulta_id_ordenes = mysql_query($sql_id_ordenes_mecanico,$conexion);
	   $suma_parcial_items = 0;
	   ////////////////////////////////////////////////
	   while($id_ordenes = mysql_fetch_assoc($consulta_id_ordenes))
	   {
	       
		   ///  ahora se debe sumar los items que ssean de nomina de acuerdo al id de la orden 
			$suma_item_nomina_por_orden = "
						select sum(io.total_item) as suma from $tabla15 io
							inner join $tabla12 p on (p.codigo_producto=io.codigo )
								where io.no_factura = '".$id_ordenes['id']."'
								and p.nomina = '1'
								and p.id_empresa = '".$_SESSION['id_empresa']."'
								";
			$consulta_items = mysql_query($suma_item_nomina_por_orden,$conexion);					
			$suma_item_nomina = mysql_fetch_assoc($consulta_items);
			$suma_item_nomina = $suma_item_nomina['suma'];
		   
		   $tipo_moto = traer_tipo_moto($tabla4,$id_ordenes['placa'],$conexion,$_SESSION['id_empresa']);
		   
		   echo  '<tr>';
		    echo '<td >ORDEN</td>';
		   echo '<td width = "40%"><a href="../orden/orden_imprimir_honda_cero.php?idorden='.$id_ordenes['id'].'"  target = "_blank">'.$id_ordenes['orden'].'</a>'.' placa '.$id_ordenes['placa'].' linea '.$tipo_moto.'</td>';
		   //echo '<td><td>';
		  
		   echo '<td align= "right"  width = "40%">'.number_format($suma_item_nomina, 0, ',', '.').'</td>';
		   
		    echo  '</tr>';
		 	$suma_parcial_items = $suma_parcial_items +  $suma_item_nomina;
			
			
	   }// fin de while($id_ordenes = mysql_fetch_assoc($consulta_id_ordenes))
	   /////////////////////////////////////////////////////////////
	   
	   		echo '<tr>';
			echo '<td width = "20%"></td><td width = "40%">TOTAL</td><td  align= "right" width ="40%">'.number_format($suma_parcial_items, 0, ',', '.').'</td>';
			echo '</tr>';
	 $gran_total =  $gran_total + $suma_parcial_items;
	   
echo '</table>';
	   echo '<br><br>';
	}// fin del ciclo de los nombres encontrados en las ordenes 
echo '<table border = "1" width = "80%"> ';
echo '<tr>';
echo '<td></td><td>GRAN TOTAL MANOS DE OBRA </td><td  align= "right">'.number_format($gran_total, 0, ',', '.').'</td>';
echo '</tr>';
echo '</table>';

//
/*
		$sql_ordenes_mecanico = "select * from $tabla14 where fecha between '2016-08-01'   and   '2016-08-15'   and id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0'  and mecanico = '".$mecanicos['mecanico']."'  ";
		$consulta_solo_mecanico = mysql_query($sql_ordenes_mecanico,$conexion);
		while($orden_mecanico)
		{
		
		}// fin de 

*/

function traer_tipo_moto($tabla4,$placa,$conexion,$id_empresa)
	{
		$sql_traer_linea = "select tipo from $tabla4  where placa = '".$placa."' and id_empresa = '".$id_empresa."' ";	
		//echo '<br>'.$sql_traer_linea.'<br>';
		$consulta_placa =  mysql_query($sql_traer_linea,$conexion);
		$tipo = mysql_fetch_assoc($consulta_placa);
		$tipo = $tipo['tipo'];
		return $tipo;
	}
?>