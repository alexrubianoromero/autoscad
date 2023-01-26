<?php
session_start();
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




include('../valotablapc.php');  
include('../funciones.php'); 

$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);

$sql_datos_empresa = "select ruta_imagen,nombre,tipo_taller,identi,telefonos,direccion from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_datos_empresa,$conexion);
$datos_empresa = mysql_fetch_assoc($consulta_empresa);

if($datos_empresa['tipo_taller'] == '1') // OSEA SI ES TALLER DE VEHICULOS
      { $palabra_inventario1  = 'RADIO' ; 
	  $palabra_inventario2  = 'ANTENA' ; 
	  $palabra_inventario3  = 'REPUESTO' ; 
	  } 
else  { $palabra_inventario1  = 'CASCO' ; 
	  $palabra_inventario2  = 'MALETERO' ; 
	  $palabra_inventario3  = 'TANK BAG' ; } 


//$sql_numero_factura = "select * from $tabla14  ";
//$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
//$filas = mysql_num_rows($consulta_facturas);
//echo 'filas ='.$filas;
//if ($filas == 0)
	//	{       $ordenpan = '1'; 
				//echo 'no hay valores en tabla factura';
	//	}
	//else  
	//	{ //echo 'si hay valores ';
/*
		     $sql_maxima_remision  = "select max(id) as maximo from $tabla14 where id_empresa = '".$_SESSION['id_empresa']."'  ";
			   $maximoid = mysql_query($sql_maxima_remision,$conexion);
			   $maximoid = mysql_fetch_assoc($maximoid);
*/
         $sql_maxima_remision  = "select contaor from $tabla10  where id_empresa = '".$_SESSION['id_empresa']."'  ";
         $maximoid = mysql_query($sql_maxima_remision,$conexion);
         $maximoid = mysql_fetch_assoc($maximoid);
			   	/*
				echo '<pre>';
				print_r($maximoid);
				echo '</pre>';
				echo '<br>muestre maximo'.$maximoid['contaor'];
				exit();
        */
        
				$ordenpan = $maximoid['contaor'] + 1 ;  
				$_SESSION['ordenpan']= $ordenpan;

        //echo '<br>'.$ordenpan;
     

			   
		//}	
//exit();

$sql_placas = "select nombre,identi,direccion,telefono,placa,marca,modelo,color,tipo  from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
 where car.placa = '".$_GET['placa123']."' 
  and cli.id_empresa = '".$_SESSION['id_empresa']."'
 ";
 
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);
/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/



$fechapan =  time();
include('../colocar_links2.php');
?>

<div id ="divorden">
  <form action="" method="post">
    <table border = "1" width = "75%">
      <tr>
        <td colspan="2" rowspan="4"></td>
        <td colspan="2"><h3>ORDEN DE TRABAJO</h3></td>
        <td><input name="orden_numero" id = "orden_numero" type="text" size="20" value = "<? echo $ordenpan  ?>"  ></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Nit. <?php  echo $datos_empresa['identi'] ?> </div></td>
        <td>CLAVE</td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Tels<?php  echo $datos_empresa['telefonos'] ?></div></td>
        <td><input name="clave" id = "clave" type="text" size="20" ></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><?php  echo $datos_empresa['direccion'] ?> </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="85">FECHA</td>
        <td colspan="2"><input size=10 name=fecha id = "fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?>></td>
        <td width="172">MARCA</td>
        <td width="295"><input name="marca" id = "marca" type="text"  value = "<? echo $datos[0]['marca']  ?>"></td>
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
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>KILOMETRAJE ACTUAL </td>
        <td><input name="kilometraje" id = "kilometraje" type="text" size="20" ></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>KILOMETRAJE CAMBIO </td>
        <td><input name="kilometraje_cambio" id = "kilometraje_cambio" type="text" size="20" ></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>OPERARIO</td>
        <td>
		  <select name="mecanico" id = "mecanico">
		  <option value = ""   >   </option>
		
		<?php
		while($mecanicos = mysql_fetch_assoc($consulta_operarios))
			{
			     echo  '<option value = "'.$mecanicos['idcliente'].'"   > '.$mecanicos['nombre'].'  </option>';
			}
		?>
		</select>
		</td>
      </tr>
    </table>
	 <br>
	 <table border = "1" width = "75%">
      <tr>
        <td colspan="11"><div align="center">TRABAJO A REALIZAR </div></td>
      </tr>
      <tr>
        <td height="134" colspan="11"><label>
          <textarea name="descripcion"  id = "descripcion" cols="100" rows="7"></textarea>
        </label></td>
      </tr>
    </table>
	  <br>
	  
    <table width="75%" border = "1">
      <tr>
        <td colspan="11"><div align="center">PARTES Y RESPUESTOS </div></td>
      </tr>
      <tr>
    <td><div align="center">ITEM</div></td>
    <td><div align="center">COD </div></td>
    <td><div align="center">DESCRIPCION</div></td>
    <td><div align="center">VR Unit </div></td>
    <td>EXIS</td>
    <td>CANT.</td>
    <td>TOTAL</td>
    <td><div align="center"></div></td>
  </tr>
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
    </table>
    

      <div id = "nuevodiv">
	  <?php 
	  	//include('mostrar_items_temporal.php');
		//mostrar_items_temporal($_SESSION['ordenpan']);
	  ?>
	  </div>
	  
	  <?php
	 // echo 'esta es la parte que no se esta imprimiendo';
	  
	  ?>
	  <br>
	  <br>
	  <table border = "1"  width = "75%">
      <tr>
        <td colspan="7"><div align="center">INVENTARIO</div></td>
      </tr>
      <tr>
        <td width="85"><label  for= "radio" ><?php echo $palabra_inventario1; ?></label></td>
        <td width="146"><input type="checkbox" name="radio" id="radio" value="1"></td>
        <td width="201"><label for ="herramienta"> HERRAMIENTA</label></td>
        <td colspan="4"><label>
          <input type="checkbox" name="herramienta" id = "herramienta" value="1">
        </label></td>
        </tr>
      <tr>
        <td><label  for = "antena"><?php echo $palabra_inventario2; ?></label></td>
        <td><label>
          <input type="checkbox" name="antena"  id = "antena" value="1">
        </label></td>
        <td colspan="5" rowspan="2">OTROS
          <label>
            <textarea name="otros" id = "otros" cols="50" rows="3"></textarea>
          </label></td>
      </tr>
      <tr>
        <td><label for="repuesto"  ><?php echo $palabra_inventario3; ?></label></td>
        <td><label>
          <input type="checkbox" name="repuesto"  id = "repuesto" value="1">
        </label></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="36">&nbsp;</td>
        <td width="3">&nbsp;</td>
        <td width="3">&nbsp;</td>
        <td width="117">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7"><button type ="button"  id = "grabar_orden" ><h4>GRABAR_ORDEN</h4></button></td>
        </tr>
      <tr>
        <td colspan="7">&nbsp;</td>
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
							$.post('procesar_items_temporal.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
					///////////////////////////////////
						$(".eliminar").click(function(){
			
							var data =  'eliminar =' + $(this).attr('value');
							$.post('eliminar_items_temporal.php',data,function(a){
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
              				data += '&radio=' + $("#radio:checked").val();
							data += '&herramienta=' + $("#herramienta:checked").val();
             				data += '&antena=' + $("#antena:checked").val();
              				data += '&repuesto=' + $("#repuesto:checked").val();
							data += '&otros=' + $("#otros").val();
							data += '&kilometraje=' + $("#kilometraje").val();
							data += '&mecanico=' + $("#mecanico").val();
							data += '&kilometraje_cambio=' + $("#kilometraje_cambio").val();
							$.post('grabar_orden.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#divorden").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

