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

$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' and idcliente = '".$datos[0]['mecanico']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);
$nombre_operario = mysql_fetch_assoc($consulta_operarios);
$nombre_operario = $nombre_operario['nombre'];
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
    <table border = "1" width="75%">
      <tr>
        <td colspan="2" rowspan="4"><img src="<?php  echo $ruta_imagen  ?>" width="335" height="102"></td>
        <td colspan="2"><h3>ORDEN DE TRABAJO</h3></td>
        <td >
            <input name="orden" id = "orden" type="text" size="20" value = "<? echo $datos[0]['orden']  ?>"  >
          <input name="orden_numero" id = "orden_numero" type="hidden" size="20" value = "<? echo $_GET['idorden']  ?>"  >
        </td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">NIT <?php  echo $datos_empresa['identi'] ?> </div></td>
        <td>CLAVE</td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Tels<?php  echo $datos_empresa['telefonos'] ?></div></td>
        <td><input name="clave" id = "clave" type="text" size="20" ></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><?php  echo $datos_empresa['direccion'] ?>  </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="85">FECHA</td>
        <td colspan="2"><input size=10 name=fecha id = "fecha"  value= <? echo $datos[0]['fecha']  ;?>></td>
        <td width="123">MARCA</td>
        <td width="141"><input name="marca" id = "marca" type="text"  value = "<? echo $datos[0]['marca']  ?>"></td>
      </tr>
      <tr>
        <td>NOMBRE</td>
        <td colspan="2"><input name="nombre"  id = "nombre" type="text"  value = "<?php echo $datos[0]['nombre']; ?> "></td>
        <td>TIPO</td>
        <td><input name="tipo" type="text"  value = "<? echo $datos[0]['tipo']  ?>"></td>
      </tr>
      <tr>
        <td>CC/NIT</td>
        <td colspan="2"><input name="identificacion" type="text"  value = "<?php echo $datos[0]['identi']; ?> "></td>
        <td>MODELO</td>
        <td><input name="modelo" type="text"  value = "<? echo $datos[0]['modelo']  ?>"></td>
      </tr>
      <tr>
        <td>DIRECCION</td>
        <td colspan="2"><input name="direccion" type="text" size="50" value = "<? echo $datos[0]['direccion']  ?>"  ></td>
        <td>PLACA</td>
        <td><input name="placa" id = "placa" type="text" size="10" value = "<? echo $datos[0]['placa']  ?>"  ></td>
      </tr>
      <tr>
        <td>TELEFONO</td>
        <td colspan="2"><input name="telefono" type="text" size="40" value = "<? echo $datos[0]['telefono']  ?>"></td>
        <td>COLOR</td>
        <td><input name="color" type="text" size="20" value = "<? echo $datos[0]['color']  ?>" ></td>
      </tr>
	  <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	  <td>KILOMETRAJE</td>
	  <td><input name="color" type="text" size="20" value = "<? echo $datos[0]['kilometraje']  ?>" ></td></tr>
	  <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	  <td>OPERARIO</td>
	  <td><input name="color" type="text" size="20" value = "<? echo $nombre_operario;  ?>" ></td></tr>
      <tr>
        <td colspan="11"><div align="center">TRABAJO A REALIZAR </div></td>
      </tr>
      <tr>
        <td height="80" colspan="11"><label>
          <textarea name="descripcion"  id = "descripcion" cols="90" rows="4"> <?php  echo $datos[0]['observaciones']?>
    </textarea>
        </label></td>
      </tr>
      <tr>
        <td colspan="11"><div align="center">PARTES Y RESPUESTOS </div></td>
      </tr>
      <tr>
        <td><div align="center">ITEM</div></td>
        <td ><div align="center">COD </div></td>
        <td ><div align="center">DESCRIPCION</div></td>
        <td><div align="center">VR Unit </div></td>
        <td>CANT.</td>
        <td >TOTAL</td>
        <td ><div align="center"></div></td>
      </tr>
      <?php
     $no_item = 0 ;
	 $subtotal  = 0;
     while($items = mysql_fetch_array($consulta_items))
	 		 {
			 $i++;
	 			echo '<tr>
				<td width="34">'.$i.'</td>
                <td width="38">'.$items['codigo'].'</td>
    			<td width="149">'.$items['descripcion'].'</td>
    			<td width="82">'.$items['valor_unitario'].'</td>
    			<td width="87">'.$items['cantidad'].'</td>
   			    <td width="85">'.$items['total_item'].'</td>
   				 <td width="77"></td>
					</tr>
				';
				$subtotal = $subtotal + $items['total_item'];
			 } 
      
			 echo '<tr><td></td><td></td><td></td><td></td><td><h4>SUBTOTAL</h4></td><td><h4>'.$subtotal.'</h4></td><td></td></tr>';
  ?>
      <!--
  <tr>
    <td width="34">&nbsp;</td>
   
    <td width="38"><label>
      <input name="codigopan" type="text" id = "codigopan" size="5" />
    </label></td>
    <td width="149"><input type="text" name="descripan" id = "descripan" />
    <div id = "descripcion"></div></td>
    <td width="82"><input type="text" name="valor_unit" id = "valor_unit" size = "10" /></td>
    <td width="87"><input name="exispan" type="text" id = "exispan" size="10" /></td>
    <td width="85"><input name="cantipan" type="text" id = "cantipan"  size ="10"/></td>
    <td width="77"><input name="totalpan" type="text" id = "totalpan" size="15" /></td>
    <td width="75"><button type = "button" id = "agregar_item">Agregar</button></td>
  </tr>
  -->
      <tr>
        <td colspan="7"><div align="center">INVENTARIO</div></td>
      </tr>
      <tr>
        <td width="85">RADIO</td>
        <td width="144"><?  if ($datos[0]['radio']=="1"){echo '<input name = "radio" id="radio"  type="checkbox" checked>';} else {echo '<input  name = "radio" id="radio"  type="checkbox" unchecked>';}  ?></td>
        <td width="199">HERRAMIENTA</td>
        <td colspan="4"><label>
     
		  <?  if ($datos[0]['herramienta']=="1"){echo '<input name = "herramienta" id="herramienta"  type="checkbox" checked>';} else {echo '<input  name = "herramienta" id="herramienta"  type="checkbox" unchecked>';}  ?>
        </label></td>
      </tr>
      <tr>
        <td>ANTENA</td>
        <td><label><?  if ($datos[0]['antena']=="1"){echo '<input name = "antena" id="antena"  type="checkbox" checked>';} else {echo '<input  name = "antena" id="antena"  type="checkbox" unchecked>';}  ?>
        </label></td>
        <td colspan="5" rowspan="2">OTROS
          <label>
            <textarea name="otros" id = "otros" cols="50" rows="2"> <?php  echo $datos[0]['otros']?></textarea>
          </label></td>
      </tr>
      <tr>
        <td>REPUESTO</td>
        <td><label><?  if ($datos[0]['repuesto']=="1"){echo '<input name = "repuesto" id="repuesto"  type="checkbox" checked>';} else {echo '<input  name = "repuesto" id="repuesto"  type="checkbox" unchecked>';}  ?>
		  
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="123">&nbsp;</td>
        <td width="141">&nbsp;</td>
        <td width="48">&nbsp;</td>
        <td width="-1">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td colspan="7">* Esta no es una factura solo es orden de trabajo los precios no tienen iva y es valida solo por 30 dias</td>
      </tr>
    </table>
  </form>

 <h2><a href="../menu_principal.php">Menu Principal</a> <h2>
  
 <a href="index.php">Menu Ordenes</a> 
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

