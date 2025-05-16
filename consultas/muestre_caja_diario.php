<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
//  Tener en cuenta que en el flujo de caja tambien debe incluir la suma de las ventas 
/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
*/
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


				if($_GET['control']==1)
				{
					//echo 'valor igual a 1';		
					$sql_caja = "select numero_factura as documento,fecha,placa,total_factura  as total 
					from $tabla11 where  fecha =  '".$fechapan."'    and id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0' order by id_factura  ";
					
					$sql_total_factura = "select sum(total_factura) as suma from  $tabla11   where  fecha =  '".$fechapan."'   
					 and id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0' ";
					
					//echo '<br>'.$sql_total_factura.'<br>';
					$aviso = "DEL DIA DE HOY ";

				}

				if($_GET['control']==2)
				{
					$sql_caja = "select numero_factura as documento,fecha,placa,total_factura  as total from $tabla11 where  fecha between    '".$fechain."' and  '".$fechafin."'    and id_empresa = '".$_SESSION['id_empresa']."' order by id_factura  ";
					$sql_total_factura = "select sum(total_factura) as suma from  $tabla11    
					 where  fecha between    '".$fechain."' and  '".$fechafin."'    and id_empresa = '".$_SESSION['id_empresa']."'";
					$aviso = "ENTRE EL DIA  ".$fechain.' Y EL DIA '.$fechafin;

                }


          echo '<br> INFORME DE CAJA '.$aviso;
    
	$consulta_diario = mysql_query($sql_caja,$conexion);
	$filas = mysql_num_rows($consulta_diario);
	//echo '<br>'.$filas.'<br>';

			if ($filas > 0)
					{	
						$datos = get_table_assoc($consulta_diario);
						echo '<BR><BR>';
						draw_table($datos);

						$suma = mysql_query($sql_total_factura,$conexion) ;
						$suma = mysql_fetch_assoc($suma);
						echo '<BR>TOTAL  ='.$suma['suma'];

					}		
			else { echo '<BR>NO SE ENCONTRARON RESULTADOS DE LA BUSQUEDA <BR>'; 
					
				 }			
echo '<br><br><br>';
echo '<h2><a href = "index.php"    >Menu Consultas</a></h2>'; 
echo '<h2><a href = "../menu_principal.php"    >Menu Principal</a></h2>'; 

?>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
