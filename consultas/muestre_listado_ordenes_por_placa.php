<?php

session_start();

?>

<!DOCTYPE html>

<html >

<!-- <html lang="es"  class"no-js">

-->



<head>

<meta charset="UTF-8">

<title>Document</title>

	<link rel="stylesheet" href="../css/normalize.css">

	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery.modal.css">

	

</head>

<body>

<? 

// include('../colocar_links2.php');

include('../valotablapc.php');



$sql_listado_ordenes = "select id,fecha,orden,estado,kilometraje,kilometraje_cambio,anulado from $tabla14 where placa = '".$_REQUEST['placa123']."' and id_empresa = '".$_SESSION['id_empresa']."' order by id desc ";



$traer_vencimientos  = "select vencisoat,revision,chasis,motor    from  $tabla4   where placa = '".$_REQUEST['placa123']."' ";

//echo '<br>'.$traer_vencimientos;

$consulta_vencimientos = mysql_query($traer_vencimientos,$conexion);

$vencimientos = mysql_fetch_assoc($consulta_vencimientos);



//echo '<br>'.$sql_listado_ordenes;

$consulta_ordenes = mysql_query($sql_listado_ordenes,$conexion);

echo '<H2>LISTADO DE ORDENES DE LA PLACA   </H2'.'<h2>'.$_REQUEST['placa123'].'</h2>';

echo '<div id = "mostrar">';



echo '<table border = "1" align="center" >';

echo '<tr><td><h3>VENCIMIENTO SOAT</h3></td><td><h3>VENCIMIENTO TECNOMECANICA</h3></td><td><h3>CHASIS</h3></td><td><h3>MOTOR</h3></td></tr>';

echo '<tr><td><h3>'.$vencimientos['vencisoat'].'</h3></td><td><h3>'.$vencimientos['revision'].'</h3></td><td><h3>'.$vencimientos['chasis'].'</h3></td>

<td><h3>'.$vencimientos['motor'].'</h3></td>

</tr>';

echo '</table>';





echo '<table border = "1" align="center">';

echo '<tr><td><h2>ORDEN NO</h2></td><td><h2>FECHA</h2></td><td><h2>KILOMETRAJE</h2></td><td><h2>PROXIMO CAMBIO</h2><td><h2>ESTADO</h2></td><td><h2>DOCUMENTO </h2></td><td><h2>MODIFICAR </h2></td><td><h2>IMPRIMIR </h2></td></tr>';


//<button id="ventana" class="ventana"  value ="'.$ordenes[0].'">Ver</button>
while($ordenes = mysql_fetch_array($consulta_ordenes))

{

	 echo '<tr>';

	 echo '<td><h2>'.$ordenes[2].'<h2></td><td><h2> <a target="_blank"href="../orden/orden_detallado.php?idorden='.$ordenes[0].' ">'.$ordenes[1].'</a></h2></td>';

	  echo '<td><h2>'.$ordenes[4].'</h2></td>'; 

	   echo '<td><h2>'.$ordenes[5].'</h2></td>';

	   			/*

				if($ordenes[3]=='3') {  $estado = 'ANULADA';    $factura = ''; $id_factura ='';}

			 	if($ordenes[3]=='0' ) {  $estado = 'EN PROCESO';    $factura = ''; $id_factura ='';}

	  			if($ordenes[3]=='1'  )

	  					 {  

	  					 	$estado = 'FINALIZADA';

	  					 	$sql_factura =	"select id_factura,numero_factura  from $tabla11 where id_orden = '".$ordenes[0]."' ";

	  					 	$consulta_factura = mysql_query($sql_factura,$conexion);

	  					 	$datos_factura = mysql_fetch_assoc($consulta_factura);

	  					 	$factura = $datos_factura['numero_factura']; 

	  					 	$id_factura = $datos_factura['id_factura'];

	  						//echo $id_factura;



	  					  }

					*/	  

				$nombre_estado = busque_estado($tabla26,$ordenes[3],$_SESSION['id_empresa'],$conexion);		  

	 echo '<td><h2>'.$nombre_estado.'</h2></td>'; 
	 echo '<td><h2><a href="../facturas/factura_imprimir.php?id_factura='.$id_factura.' " target = "blank">'.$factura.'</a></h2></td>'; 
      
	 //AQUI DEBE IR 
	 echo '<td><h2><a href="../orden/orden_modificar_honda.php?idorden='.$ordenes[0].'">Modificar</a></h2></td>';
	 echo '<td><h2><a href="../orden/orden_imprimir_honda_cero.php?idorden='.$ordenes[0].' " target = "blank">Imprimir</a></h2></td>';
	  echo '</tr>';

}

echo '</table>';

echo '<div>';

///////////////////////////

function busque_estado($tabla26,$id_estado,$id_empresa,$conexion)

	{

	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";

	  $consulta_estados = mysql_query($sql_estados,$conexion);

	  $resultado = mysql_fetch_assoc($consulta_estados);

	  $nombre_estado = $resultado['descripcion_estado'];

	  return $nombre_estado;

	}

////////////////////////////



?>	

<div style="display:none" id="modal">
  hola prueba de modal 

</div>
<div id="otro"></div>
</body>

</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>

<script src="../js/jquery-2.1.1.js" ></script>

<script src="../js/jquery.modal.min.js" ></script>

<script type="text/javascript">
   $(".ventana").click(function(){
   	var valor = $(this).attr('value');
   //alert( valor);
   
   	  //$("#modal").modal();
   	  
   	  	var data =  'idorden=' + $(this).attr('value');
							//data += '&descripan=' + $("#descripan").val();
			$.post('../orden/orden_detallado.php',data,function(a){

			$("#otro").html(a);

								//alert(data);
		});	



   });
</script>





