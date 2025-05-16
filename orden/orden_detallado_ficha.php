<?php
session_start();
include('../valotablapc.php');  
include('../funciones.php'); 
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
</head>
<body>
<?php


/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
exit();
*/





/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();
$sql_empresa = "select * from $tabla10 where id_empresa = ".$_SESSION['id_empresa']." ";
$consulta_empresa = mysql_query($sql_empresa,$conexion); 
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
$ruta_imagen = '../logos/'.$datos_empresa['ruta_imagen'];


///////////////////////
if($datos_empresa['tipo_taller'] == '1') // OSEA SI ES TALLER DE VEHICULOS
      { $palabra_inventario1  = 'RADIO' ; 
	  $palabra_inventario2  = 'ANTENA' ; 
	  $palabra_inventario3  = 'REPUESTO' ; 
	  } 
else  { $palabra_inventario1  = 'CASCO' ; 
	  $palabra_inventario2  = 'MALETERO' ; 
	  $palabra_inventario3  = 'TANK BAG' ; } 

//////////////////////////

$sql_placas = "select cli.nombre,cli.identi,cli.direccion,cli.telefono,car.placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.orden  as orden,o.kilometraje,o.mecanico
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
 where o.id = '".$_GET['idorden']."' ";
/* 
 echo '<br>'.$sql_placas;
exit();
*/
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);


$sql_items_orden = "select * from $tabla15 where no_factura = '".$_GET['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);

/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/



//$fechapan =  time();
?>
<div id = "divorden">
  <form action="" method="post">
    <table border = "1">
      <tr>
        <td colspan="4"><img src="<?php  echo $ruta_imagen  ?>" width="150" height="40">
		  
        <div align="center"></div>          <div align="center"></div></td>
        <td ><h5 align="center">ORDEN DE TRABAJO
          <? echo $datos[0]['orden']  ?></h5></td>
      </tr>
     
      <tr>
        <td width="111"><h8>FECHA</h8></td>
        <td colspan="2"> <h8><? echo $datos[0]['fecha']  ;?></h8></td>
        <td width="75"><h8>MARCA</h8></td>
        <td width="108"><h8><? echo $datos[0]['marca']  ?></h8></td>
      </tr>
      <tr>
        <td><h8>NOMBRE</h8></td>
        <td colspan="2"><h8><?php echo $datos[0]['nombre']; ?></h8></td>
        <td><h8>TIPO</h8></td>
        <td><h8><? echo $datos[0]['tipo']  ?></h8></td>
      </tr>
      <tr>
        <td><h8>CC/NIT</h8></td>
        <td colspan="2"><h8><?php //echo $datos[0]['identi']; ?></h8></td>
        <td><h8>MODELO</h8></td>
        <td><h8><? echo $datos[0]['modelo']  ?></h8></td>
      </tr>
      <tr>
        <td><h8>DIRECCION</h8></td>
        <td colspan="2"><h8><? //echo $datos[0]['direccion']  ?></h8></td>
        <td><h8>PLACA</h8></td>
        <td><h8><? echo $datos[0]['placa']  ?></h8></td>
      </tr>
      <tr>
        <td><h8>TELEFONO</h8></td>
        <td colspan="2"><h8><? //echo $datos[0]['telefono']  ?></h8></td>
        <td><h8>COLOR</h8></td>
        <td><h8><? echo $datos[0]['color']  ?></h8></td>
      </tr>
	  <tr><td>&nbsp;</td><td colspan="2">&nbsp;</td><td><h8>KILOMETRAJE</h8></td>
	  <td><h8><? echo $datos[0]['kilometraje']  ?></h8></td></tr>
	  <tr><td>&nbsp;</td><td colspan="2">&nbsp;</td><td><h8>OPERARIO</h8></td>
	  <td><h8><? echo $datos[0]['mecanico']  ?></h8></td></tr>
      <tr>
        <td colspan="11"><div align="center"><h8>TRABAJO A REALIZAR </h8></div></td>
      </tr>
      <tr>
        <td height="80" colspan="11"><label><h8>
          <textarea name="descripcion"  id = "descripcion" cols="50" rows="4"> <?php  echo $datos[0]['observaciones']?>
    </textarea>
        </h8></label></td>
      <tr>
        <td width="111"><h8><?php echo $palabra_inventario1;  ?></h8></td>
        <td width="51"><?  if ($datos[0]['radio']=="1"){echo '<input name = "radio" id="radio"  type="checkbox" checked>';} else {echo '<input  name = "radio" id="radio"  type="checkbox" unchecked>';}  ?></td>
        
        <td colspan="4"></td>
      </tr>
      <tr>
        <td><h8><?php echo $palabra_inventario2  ?> </h8></td>
        <td><label><?  if ($datos[0]['antena']=="1"){echo '<input name = "antena" id="antena"  type="checkbox" checked>';} else {echo '<input  name = "antena" id="antena"  type="checkbox" unchecked>';}  ?>
        </label></td>
        <td colspan="5"></td>
      </tr>
      <tr>
        <td><h8><?php echo $palabra_inventario3  ?></h8></td>
        <td><label><?  if ($datos[0]['repuesto']=="1"){echo '<input name = "repuesto" id="repuesto"  type="checkbox" checked>';} else {echo '<input  name = "repuesto" id="repuesto"  type="checkbox" unchecked>';}  ?>
		  
        </label></td>
        <td colspan="5"></td>
      </tr>
      <tr>
        <td><h8>HERRAMIENTA</h8></td>
        <td><label>
     
		  <?  if ($datos[0]['herramienta']=="1"){echo '<input name = "herramienta" id="herramienta"  type="checkbox" checked>';} else {echo '<input  name = "herramienta" id="herramienta"  type="checkbox" unchecked>';}  ?>
        </label></td>
        <td colspan="5"></td>
      </tr>
    </table>

  </form>


</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
               
						//////////////////
			   $("#codigopan").keyup(function(e){
					//$("#cosito").html( $("#nombrepan").val() );
					if (e.which == 13)
					{
							//alert('digito enter');
							var data1 ='codigopan=' + $("#codigopan").val();
							//$.post('buscarelnombre.php',data1,function(b){
							$.post('traer_codigo_descripcion.php',data1,function(b){
							        //  $("#descripan").val() =  descripcion;
									$("#descripan").val(b[0].descripcion);
									$("#valor_unit").val(b[0].valor_unit);
									$("#exispan").val(b[0].existencias);
									$("#cantipan").val('');
									$("#cantipan").focus();
									$("#totalpan").val(0);
							 //(data1);
							},
							'json');
					}// fin del if 		
			   });//finde codigopan
			  
				/////////////////////////////////	
						$("#agregar_item").click(function(){
							var data =  'codigopan =' + $("#codigopan").val();
							data += '&descripan=' + $("#descripan").val();
							data += '&valor_unit=' + $("#valor_unit").val();
							data += '&cantipan=' + $("#cantipan").val();
							data += '&totalpan=' + $("#totalpan").val();
							data += '&exispan=' + $("#exispan").val();
							data += '&orden_numero=' + $("#orden_numero").val();
							$.post('procesar_items.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
				
					///////////////////////////////////
						$('#cantipan').keyup(function(b){
					if (b.which == 13)
					{

				         resultado = '78910';
						 resultado2 = $('#cantipan').val() *  $('#valor_unit').val() ;
						$('#totalpan').val(resultado2);  
					}	
						
					});
					
					/////////////////////////
					$("#grabar_orden").click(function(){
							var data =  'orden_numero=' + $("#orden_numero").val();
							data += '&clave=' + $("#clave").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&placa=' + $("#placa").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&radio=' + $("#radio").val();
							data += '&herramienta=' + $("#herramienta").val();
							data += '&antena=' + $("#antena").val();
							data += '&repuesto=' + $("#repuesto").val();
							data += '&otros=' + $("#otros").val();
							$.post('grabar_orden.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#divorden").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

