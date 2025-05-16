<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura </title>
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
*/

include('../valotablapc.php');  
include('../funciones.php'); 

$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);

$sql_datos_empresa = "select ruta_imagen,nombre,tipo_taller,identi,telefonos,direccion from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."'  ";  
$consulta_empresa = mysql_query($sql_datos_empresa,$conexion);
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
//////////////////////////
$sql_maxima_remision  = "select contaor from $tabla10  where id_empresa = '".$_SESSION['id_empresa']."'  ";
         $maximoid = mysql_query($sql_maxima_remision,$conexion);
         $maximoid = mysql_fetch_assoc($maximoid);
		 
		 $ordenpan = $maximoid['contaor'] + 1 ;  
				$_SESSION['ordenpan']= $ordenpan;
$sql_placas = "select nombre,identi,direccion,telefono,placa,marca,modelo,color,tipo,chasis,motor  from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
 where car.placa = '".$_GET['placa123']."' 
  and cli.id_empresa = '".$_SESSION['id_empresa']."'
 ";
 
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);


$sql_nombres_items_inventarios = "select * from $tabla24  where decarroomoto = '".$datos_empresa['tipo_taller']."'   and id_empresa = '".$_SESSION['id_empresa']."' ";
//echo '<br>'.$sql_nombres_items_inventarios.'<br>';
$consulta_nombres_items = mysql_query($sql_nombres_items_inventarios,$conexion);
$filas_nombres_items = mysql_num_rows($consulta_nombres_items);
$nombres2_items = get_table_assoc($consulta_nombres_items);
/*
echo '<pre>';
print_r($nombres2_items);
echo '</pre>';
*/


//echo '<br>numero de items 123<br>'.$filas_nombres_items;
$fechapan =  time();
include('../colocar_links2.php');
?>


<div id ="divorden">
<form name = "capturaordenonda" method = "post"  action ="grabar_orden_honda.php">
    <table border = "1" width = "95%">
      <tr>
        <td colspan="5" rowspan="4"></td>
        <td colspan="2"><h3>ORDEN </h3></td>
        <td><input name="orden_numero" id = "orden_numero" type="text" size="20" value = "<? echo $ordenpan  ?>"  ></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Nit. <?php  echo $datos_empresa['identi'] ?> </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Tels<?php  echo $datos_empresa['telefonos'] ?></div></td>
        <td><!--<input name="clave" id = "clave" type="text" size="20" > --></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><?php  echo $datos_empresa['direccion'] ?> </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="20%">FECHA INGRESO </td>
        <td><input size=10 name=fecha id = "fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?>></td>
        <td>&nbsp;</td>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="172">MARCA</td>
        <td width="295"><input name="marca" id = "marca" type="text"  value = "<? echo $datos[0]['marca']  ?>"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5"><label></label></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>NOMBRE</td>
        <td colspan="5"><?php echo $datos[0]['nombre']; ?></td>
        <td>LINEA</td>
        <td><? echo $datos[0]['tipo']  ?></td>
      </tr>
      <tr>
        <td>CC/NIT</td>
        <td colspan="5"><?php echo $datos[0]['identi']; ?></td>
        <td>MODELO</td>
        <td><? echo $datos[0]['modelo']  ?></td>
      </tr>
      <tr>
        <td>DIRECCION</td>
        <td colspan="5"><? echo $datos[0]['direccion']  ?></td>
        <td>PLACA</td>
        <td><input type = "text" name = "placa" id="placa" value ="<? echo $datos[0]['placa']  ?>"></td>
      </tr>
      <tr>
        <td>TELEFONO</td>
        <td colspan="5"><? echo $datos[0]['telefono']  ?></td>
        <td>COLOR</td>
        <td><? echo $datos[0]['color']  ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td>CHASIS</td>
        <td><label>
       <? echo $datos[0]['chasis']  ?>
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td>KILOMETRAJE ACTUAL </td>
        <td><input name="kilometraje" id = "kilometraje" type="text" size="20" class="fila_llenar" ></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td>KILOMETRAJE PROXIMOCAMBIO ACEITE </td>
        <td><input name="kilometraje_cambio" id = "kilometraje_cambio" type="text" size="20" class="fila_llenar" ></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5">&nbsp;</td>
        <td>OPERARIO</td>
        <td>
		  <select name="mecanico" id = "mecanico" class="fila_llenar" >
		  <option value = ""   >   </option>
		
		<?php
		while($mecanicos = mysql_fetch_assoc($consulta_operarios))
			{
			     echo  '<option value = "'.$mecanicos['idcliente'].'"   > '.$mecanicos['nombre'].'  </option>';
			}
		?>
		</select>		</td>
      </tr>
    </table>
	
<br>

</table>
	 <table border = "1" width = "95%">
      <tr>
        <td colspan="11"><div align="center">TRABAJO A REALIZAR </div></td>
      </tr>
      <tr>
        <td height="134" colspan="11"><label>
          <textarea name="descripcion"  id = "descripcion" cols="130" rows="7" class="fila_llenar" ></textarea>
        </label></td>
      </tr>
    </table>
	<br>
<table border = "1" width = "95%">
<!--
<tr>
  <td ALIGN="CENTER">INVENTARIO123</td>
  <td></td>
  <td></td>
</tr>

<tr>
<td>GASOLINA<select name="gasolina" class="fila_llenar" >
<option value = "">...</option>
<option value = "1/4">1/4</option>
<option value = "1/2">1/2</option>
<option value = "3/4">3/4</option>
<option value = "FULL">FULL</option>
</select></td><td>
</td>
<td></td>
</tr>
-->
	<br>
</table>	


	<table width="95%" border="1">
	

	<?php
	echo '<tr><td colspan = "6" align ="center">INVENTARIO</td></tr>';
	echo '<tr>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	//echo '<td>CANT</td>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	//echo '<td>CANT</td>';
	echo '</tr>';
    $items_por_columna = $filas_nombres_items/2;
	$contador = 0 ;
	
	while($contador <  $items_por_columna )
	{
		echo '<tr>';
		echo '<td>';
		echo $nombres2_items[$contador]['nombre'];
		echo '</td>';
		echo '<td>';
		if($nombres2_items[$contador]['id_nombre_inventario']==25 || $nombres2_items[$contador]['id_nombre_inventario']== 26)
		{ 
				echo '<select name  = "'.$nombres2_items[$contador]['id_nombre_inventario'].'" >';
				echo '<option value = "" >...</option>';
				echo '<option value = "SI" >SI</option>';
				echo '<option value = "NO" >NO</option>';
				echo '<select>';
		}
		else
		{
				echo '<select name  = "'.$nombres2_items[$contador]['id_nombre_inventario'].'" >';
				echo '<option value = "" >...</option>';
				echo '<option value = "SI" >SI</option>';
				echo '<option value = "NO" >NO</option>';
				
				echo '<select>';
		}		
		
		echo '</td>';
		//echo '<td><input  type = "text" name = "cantidad_'.$nombres2_items[$contador]['id_nombre_inventario'].'" size="2"></td>';
		
		
		
		/*
		echo '<td><input type =""  name = "'.$nombres2_items[$contador]['id_nombre_inventario'].'"   value = "0" ></td>';
		echo '<td><input type ="radio"  name = "'.$nombres2_items[$contador]['id_nombre_inventario'].'"   value = "1" ></td>';
		*/
		
		$segunda_fila = $contador + $items_por_columna;
		echo '<td>'.$nombres2_items[$segunda_fila]['nombre'].'</td>';
		echo '<td>';
		echo '<select name  = "'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'" >';
		echo '<option value = "" >...</option>';
		echo '<option value = "SI" >SI</option>';
				echo '<option value = "NO" >NO</option>';
		
		echo '<select>';
		echo '</td>';
		
		//echo '<td><input  type = "text" name =  "cantidad_'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'" size="2"></td>';
		/*
		echo '<td><input type ="radio"  name = "'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'"   value = "0" ></td>';
		echo '<td><input type ="radio"  name = "'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'"   value = "1" ></td>';
		*/
		echo '</tr>';
		$contador++;
		
	} 
	/*
	while($nombres_items = mysql_fetch_assoc($consulta_nombres_items ))
		{
		echo '<tr>';
		
		echo '<td>'.$nombres_items['nombre'].'</td>';
		echo '<td><input type ="radio"  name = "item_'.$nombres_items['id_nombre_inventario'].'"   value = "1" ></td>';
		echo '<td><input type ="radio"  name = "item_'.$nombres_items['id_nombre_inventario'].'"   value = "1" ></td>';
		
		
		echo '<tr>';
		$contador++;
		}
	
	*/
	?>
	</table>
	<table width="75%" border="1">
	<h1>
	<!-- <input name="enviar_informacion " type="submit"  value = "ENVIAR_INFORMACION"  > -->
	<input type="button" value="ENVIAR_INFORMACION" onClick="valida_envia()"></h1>
	</table>

</form>
	
</div>  <!--  de divorden -->


</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script>
function valida_envia(){ 
	//valido fecha de entrega 
   /*
   	if (document.capturaordenonda.fecha_entrega.value.length==0){ 
      	alert("Tiene que escribir fecha entrega") 
      	document.capturaordenonda.fecha_entrega.focus() 
      	return 0; 
   	} 
*/
   	//valido el nombre 
   	if (document.capturaordenonda.kilometraje.value.length==0){ 
      	alert("Tiene que escribir kilometraje") 
      	document.capturaordenonda.kilometraje.focus() 
      	return 0; 
   	} 
		//valido el nombre 
   	if (document.capturaordenonda.mecanico.value.length==0){ 
      	alert("Tiene que seleccionar mecanico") 
      	document.capturaordenonda.mecanico.focus() 
      	return 0; 
   	} 
		//valido el gasolina 
		/*
   	if (document.capturaordenonda.gasolina.value.length==0){ 
      	alert("Tiene que seleccionar nivel de  gasolina") 
      	document.capturaordenonda.gasolina.focus() 
      	return 0; 
   	} 
	*/

   	////////////////////////////el formulario se envia 
   	alert("Muchas gracias por enviar el formulario"); 
   	document.capturaordenonda.submit(); 
	
	
}
</script>

