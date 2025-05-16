<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
$sql_facturas_placa ="select id,placa, fecha,observaciones,estado,anulado 
from $tabla14 where placa = '".$_POST['placa123']."'
 and  id_empresa = '".$_SESSION['id_empresa']."' 
  and anulado = '0'
  ";

// echo $sql_facturas_placa;
$facturas_placa = mysql_query($sql_facturas_placa,$conexion);

//echo '1111';

echo '<br>';
echo '<H1>ANULACION DE FACTURAS  </H1>';
echo '<br>';
echo '<H2>LISTADO DE FACTURAS PLACA '.$_POST['placa123'].'</H2>';
echo '<br>';
echo '<table border = "1">';
echo '<tr>
<td><h2>NUMERO_FACTURA</h2></td>
<td><h2>PLACA</h2></td>
<td><h2>FECHA</h2></td>
<td><h2>VALOR FACTURA</h2></td>
<td><h2>ACCION</h2></td>
</tr>';
while($fac = mysql_fetch_array($facturas_placa))
		{
			echo '<tr>';
				echo '<td><h2>'.$fac[4].'</h2></td>';
				echo '<td><h2>'.$fac[1].'</h2></td>';
				echo '<td><h2>'.$fac[2].'</h2></td>';
				echo '<td><h2>'.$fac[3].'</h2></td>';
				if ($fac[5]=='1')
					{
						echo '<td><h2>ANULADA</h2></td>';
					}	
				else {
						echo '<td><h2><a href = "anular_factura.php?id_factura='.$fac[0].'"  >Anular_factura</a></h2></td>';
					}	
				   
				
			echo '<tr>';

		}
echo '</table>';
include('../colocar_links2.php');

?>