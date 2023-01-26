<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura renault</title>
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
$sql_placas = "select nombre,identi,direccion,telefono,placa,marca,modelo,color,tipo  from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
 where car.placa = '".$_GET['placa123']."' 
  and cli.id_empresa = '".$_SESSION['id_empresa']."'
 ";
 
$datos = mysql_query($sql_placas,$conexion);
$datos = get_table_assoc($datos);


$sql_nombres_items_inventarios = "select * from $tabla24  where decarroomoto = '".$datos_empresa['tipo_taller']."'   and id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_nombres_items = mysql_query($sql_nombres_items_inventarios,$conexion);
$filas_nombres_items = mysql_num_rows($consulta_nombres_items);
$nombres2_items = get_table_assoc($consulta_nombres_items);
/*
echo '<pre>';
print_r($nombres2_items);
echo '</pre>';
*/


echo '<br>numero de items 123<br>'.$filas_nombres_items;
$fechapan =  time();
include('../colocar_links2.php');
?>


<div id ="divorden">
<form name = "formu" method = "post"  action ="grabar_orden_renault.php">
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
          <textarea name="descripcion"  id = "descripcion" cols="130" rows="7"></textarea>
        </label></td>
      </tr>
    </table>
	<br>
	<br>
	


	<table width="75%" border="1">
	

	<?php
	echo '<tr><td colspan = "6" align ="center">INENTARIO</td></tr>';
	echo '<tr>';
	echo '<td>ACCESORIO</td>';
	echo '<td>SI</td>';
	echo '<td>NO</td>';
	echo '<td>ACCESORIO</td>';
	echo '<td>SI</td>';
	echo '<td>NO</td>';

	
	echo '</tr>';
    $items_por_columna = $filas_nombres_items/2;
	$contador = 0 ;
	
	while($contador <  $items_por_columna )
	{
		echo '<tr>';
		echo '<td>'.$nombres2_items[$contador]['nombre'].'</td>';
		echo '<td><input type ="radio"  name = "'.$nombres2_items[$contador]['id_nombre_inventario'].'"   value = "0" ></td>';
		echo '<td><input type ="radio"  name = "'.$nombres2_items[$contador]['id_nombre_inventario'].'"   value = "1" ></td>';
		
		$segunda_fila = $contador + $items_por_columna;
		echo '<td>'.$nombres2_items[$segunda_fila]['nombre'].'</td>';
		echo '<td><input type ="radio"  name = "'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'"   value = "0" ></td>';
		echo '<td><input type ="radio"  name = "'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'"   value = "1" ></td>';
		
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
	<input name="enviar_informacion " type="submit"  value = "ENVIAR_INFORMACION">
	</table>

</form>
	
</div>  <!--  de divorden -->


</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   