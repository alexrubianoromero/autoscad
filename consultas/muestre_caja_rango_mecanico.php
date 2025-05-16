<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
//  Tener en cuenta que en el flujo de caja tambien debe incluir la suma de las ventas 
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

//exit();

/*
$_POST['fechain']='2016-03-01';
$_POST['fechafin']='2016-03-02';
$_POST['mecanico']='627';
*/

$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."'  and idcliente = '".$_POST['mecanico']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);
$datos_mecanico = mysql_fetch_assoc($consulta_operarios);
?>


<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php

		$fechapan = date ( "Y/m/j");
	          /*
	            echo '<pre>';
				print_r($_POST);
				echo '</pre>';
			*/	

					$sql_caja = "select f.numero_factura as documento,f.fecha,f.placa,f.total_factura as total,id_factura  ,f.id_factura   
					from $tabla11 as f
					inner join $tabla14 as   o on (o.id = f.id_orden)
					inner join $tabla21 as   t on (t.idcliente = o.mecanico)
					where  f.fecha between    '".$_POST['fechain']."' and  '".$_POST['fechafin']."'    and f.id_empresa = '".$_SESSION['id_empresa']."'   
					and f.anulado  < 1
					 ";
					
						if($_POST['mecanico']!= '')	 
						 	{
					 			$sql_caja .= "  and  o.mecanico = '".$_POST['mecanico']."'  ";
							}
					
					//$sql_caja  .= " order by id_factura ";
				 
				 echo '<br>consulta1<br>'.$sql_caja;
				 ////////////////////////////////////////////////////
					$aviso = "ENTRE EL DIA  ".$_POST['fechain'].' Y EL DIA '.$_POST['fechafin'];
					if($_POST['mecanico']!='')
						{  $aviso .= " <br>PARA EL  TECNICO ".$datos_mecanico['nombre']; }

          echo '<br> INFORME DE DOCUMENTOS '.$aviso;
    
	$consulta_diario = mysql_query($sql_caja,$conexion);
	$filas = mysql_num_rows($consulta_diario);
	//echo '<br>'.$filas.'<br>';

			if ($filas > 0)
					{	
						//$datos = get_table_assoc($consulta_diario);
						echo '<BR><BR>';
						//draw_table($datos);
						echo '<table border = "1" width = "95%">';
						echo '<tr><td>DOCUMENTO</td><td>FECHA</td><td>PLACA</td><td>TOTAL FACTURA</td>';
						if($_POST['mecanico']!= '')	 
						{ echo '<td>TOTAL PARA NOMINA</td>';}
						echo '<td>ACCION</td>';
						echo '</tr>';
						$total_documentos = 0;
						$total_para_nomina = 0;
						while ($consulta = mysql_fetch_assoc($consulta_diario))
							{
							    echo '<tr>';
								echo '<td>'.$consulta['documento'].'</td>';
								echo '<td>'.$consulta['fecha'].'</td>';
								echo '<td>'.$consulta['placa'].'</td>';
								echo '<td><div align="right">'.number_format($consulta['total'], 0, ',', '.').'</div></td>';
								if($_POST['mecanico']!='')
										{
											$sql_suma_items = "
												select sum(i.total_item) as suma_nomina from $tabla15 as i 
												inner join $tabla12 as p on (p.codigo_producto = i.codigo and p.id_empresa = i.id_empresa) 
												inner join $tabla14 as o on (o.id = i.no_factura)
												inner join $tabla11 as f on (f.id_orden = o.id)
												where f.id_factura = '".$consulta['id_factura']."' and p.nomina = '1' and i.anulado= '0'
											 ";
											//echo '<br>consulta suma items</br>'.$sql_suma_items; 
											$consulta_suma_nomina = mysql_query($sql_suma_items,$conexion);
											$suma_nomina = mysql_fetch_assoc( $consulta_suma_nomina);
											$suma_nomina = $suma_nomina['suma_nomina'];
											echo '<td><div align="right">'.number_format($suma_nomina, 0, ',', '.').'</div></td>';	
											
										}
								echo '<td> <div align="center"><a href="../facturas/factura_imprimir.php?id_factura='.$consulta['id_factura'].'"   target = "_blank"   >Vista Impresion</a></div></td>';
								echo '</tr>';
								$total_documentos = $total_documentos + $consulta['total'];
								$total_para_nomina = $total_para_nomina + $suma_nomina;
								
							}
						echo '</table>';

						//$suma = mysql_query($sql_total_factura,$conexion) ;
						//$suma = mysql_fetch_assoc($suma);
						echo '<BR>TOTAL FACTURAS =  '.number_format($total_documentos, 0, ',', '.');
									if($_POST['mecanico']!='')
										{ echo '<BR>TOTAL PARA NOMINA =  '.number_format($total_para_nomina, 0, ',', '.'); }

					}		
			else { echo '<BR>NO SE ENCONTRARON RESULTADOS DE LA BUSQUEDA <BR>'; 
					
				 }			
echo '<br><br><br>';
echo '<h2><a href = "index.php"    >Menu Consultas</a></h2>'; 
echo '<h2><a href = "../menu_principal.php"    >Menu Principal</a></h2>'; 
/*
function sumar_items_nomina($conexion)
  	{
		$sql_suma_items = "
				select sum(i.total_item) from $tabla15 as i 
				inner join $tabla12 as p on (p.codigo_producto = i.codigo and p.id_empresa = i.id_empresa) 
		  	inner join $tabla14 as o on (o.id = i.no_factura)
		  	inner join $tabla11 as f on (f.id_orden = o.id)
		  	where f.id_factura = '268' and p.nomina = '1' and i.anulado= '0'
		 ";
		 $consulta_items = mysql_query($sql_items,$conexion); 
		 while($items = mysql_fetch_assoc($consulta_items))
		 	{
				
			}//fin de while
	}// fin de funcion
	*/
?>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
