<?php
session_start();
?>

<!DOCTYPE html>
<!-- <html lang="es"  class"no-js"> -->
<html lang="es" >
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">
<!--
.style2 {font-weight: bold}

#mostrar_placas{
display:none;
}
.style3 {color:#6666FF}
-->
</style>
</head>
<body>
<?php


/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

//echo 'valor de id orden '.$_REQUEST['id_orden'];
//exit();

include('../valotablapc.php');  
include('../funciones.php'); 

$sql_placas = "select placa from $tabla4 where id_empresa = ".$_SESSION['id_empresa']." ";
$consulta_placas = mysql_query($sql_placas);
$sql_empresa = "select * from $tabla10 where id_empresa = ".$_SESSION['id_empresa']." ";
$consulta_empresa = mysql_query($sql_empresa,$conexion); 
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
$ruta_imagen = '../logos/'.$datos_empresa['ruta_imagen'];
if($datos_empresa['tipo_taller'] == '1') // OSEA SI ES TALLER DE VEHICULOS
      { $palabra_inventario1  = 'RADIO' ; 
	  $palabra_inventario2  = 'ANTENA' ; 
	  $palabra_inventario3  = 'REPUESTO' ; 
	  } 
else  { $palabra_inventario1  = 'CASCO' ; 
	  $palabra_inventario2  = 'MALETERO' ; 
	  $palabra_inventario3  = 'TANK BAG' ; } 




/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();

$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);



$sql_placas = "select cli.nombre,cli.identi as clidenti,cli.direccion as direccioncli,cli.telefono as telefonocli,car.placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id,
 e.identi,e.telefonos as telefonos_empresa ,e.direccion as direccion_empresa,o.kilometraje_cambio,e.tipo_taller,o.fecha_entrega,o.abono,o.estado 
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa)
inner join $tabla10 as e on  (e.id_empresa = o.id_empresa) 
 where o.id = '".$_REQUEST['idorden']."'   and   o.id_empresa = '".$_SESSION['id_empresa']."'  and o.estado < 20 ";
 
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
if ($filas == 0 ) 
{
echo '<BR><BR>ESTA ORDEN NO SE PUEDE MODIFICAR 	<br>
SE ENCUENTRA EN ESTADO FINALIZADA';

}
else 
{
//echo '<br>filas =='.$filas;

 $datos = get_table_assoc($datos); 

//echo '<br>mecanico'.$datos[0]['mecanico'];
//$id_orden['id']
$sql_items_orden = "select * from $tabla15 where no_factura = '".$_REQUEST['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);
$factupan = $_REQUEST['idorden'];
if($datos[0]['mecanico']== '')
	{
		$nombre_mecanico = 'MECANICO NO ASIGNADO';
	}
else {
        $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$datos[0]['mecanico']."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
	}
/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/

$sql_traer_estados = "select * from $tabla26 where id_empresa = '".$_SESSION['id_empresa']."'";
//echo'<br>consulta'.$sql_traer_estados;
$consulta_estados_almacenados = mysql_query($sql_traer_estados,$conexion);


//$fechapan =  time();
include('../colocar_links2.php');
?>
<div id = "divorden">

  <form name = "actualizarorden" action="actualizar_orden_honda.php" method="post">
  <input type="hidden" id="nombreUsuarioLogueado" value="<?php   echo $_SESSION['usuario'] ?>">
    <table border = "1"  width = "75%">
      <tr>
        <td colspan="2" rowspan="4"><img src="<?php  echo $ruta_imagen    ?>" width="318" height="104"></td>
        <td colspan="2"><h3>ORDEN DE REPARACION </h3></td>
        <td >
                 <input name="orden" id = "orden" type="text" size="20" value = "<? echo $datos[0]['orden']  ?>" onfocus = "blur()" >
                <input name="orden_numero" id = "orden_numero"  type="hidden" size="20" value = "<? echo $_REQUEST['idorden']  ?>"  >  
				 <input name="id_orden" id = "id_orden"  type="hidden" size="20" value = "<? echo $datos[0]['id']  ?>"  >         </td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><?php  echo $datos[0]['identi']   ?> </div></td>
        <td>CLAVE</td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">TELS <?php  echo $datos[0]['telefonos_empresa']   ?> </div></td>
        <td><input name="clave" id = "clave" type="text" size="20" ></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center"><?php  echo $datos[0]['direccion_empresa']   ?> </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="85">FECHA</td>
        <td><input size=10 name=fecha id = "fecha"  value= <? echo $datos[0]['fecha']  ;?> onfocus = "blur()"> 
        fecha entrega </td>
        <td><input size=10 name=fecha_entrega id = "fecha_entrega"  value= <? echo $datos[0]['fecha_entrega']  ;?>></td>
        <td width="243">MARCA</td>
        <td width="219"><input name="marca" id = "marca" type="text"  value = "<? echo $datos[0]['marca']  ?>"></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>NOMBRE</td>
        <td colspan="2"><input name="nombre"  id = "nombre" type="text"  value = "<?php echo $datos[0]['nombre']; ?> " onfocus = "blur()"></td>
        <td>LINEA</td>
        <td><input name="tipo" type="text"  value = "<? echo $datos[0]['tipo']  ?>" onfocus = "blur()"></td>
      </tr>
      <tr>
        <td>CC/NIT</td>
        <td colspan="2"><input name="identificacion" type="text"  value = "<?php echo $datos[0]['clidenti']; ?> " onfocus = "blur()"></td>
        <td>MODELO</td>
        <td><input name="modelo" type="text"  value = "<? echo $datos[0]['modelo']  ?>" onfocus = "blur()"></td>
      </tr>
      <tr>
        <td>DIRECCION</td>
        <td colspan="2"><input name="direccion" type="text" size="50" value = "<? echo $datos[0]['direccioncli']  ?>" onfocus = "blur()" ></td>
        <td>PLACA</td>
        <td><input name="placa" id = "placa" type="text" size="10" value = "<? echo $datos[0]['placa']  ?>" onfocus = "blur()" ></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td><label>
          <input type="checkbox" name="cambiar_placa" id="cambiar_placa" value="1" placeholder="PLACA">
       <label for ="cambiar_placa"> <span class="style3">CAMBIAR PLACA</span> </label> </td>
        <td><div id="mostrar_placas">
		<select name="nueva_placa" id = "nueva_placa" class = "fila_llenar">
		  <option value = ""   >   </option>
		
		<?php
		while($placas = mysql_fetch_assoc($consulta_placas))
			{
			     echo  '<option value = "'.$placas['placa'].'"   > '.$placas['placa'].'  </option>';
			}
		?>
	  </select>
		</div>
		</td>
      </tr>
      <tr>
        <td>TELEFONO</td>
        <td colspan="2"><input name="telefono" type="text" size="40" value = "<? echo $datos[0]['telefonocli']  ?>" onfocus = "blur()"></td>
        <td>COLOR</td>
        <td><input name="color" type="text" size="20" value = "<? echo $datos[0]['color']  ?>"  onfocus = "blur()"></td>
      </tr>
	   <tr><td>&nbsp;</td><td width="214">&nbsp;</td>
	   <td width="40">&nbsp;</td>
	  <td>KILOMETRAJE</td>
	  <td><input name="kilometraje"  id = "kilometraje"  type="text" size="20" value = "<? echo $datos[0]['kilometraje']  ?>" ></td></tr>
	   <tr>
	     <td>&nbsp;</td>
	     <td>&nbsp;</td>
	     <td>&nbsp;</td>
	     <td><span style="color: rgb(0, 0, 0); font-family: sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;">Kms Prox. Cambio</span></td>
	     <td><input name="kilometraje_cambio"  id = "kilometraje_cambio"  type="text" size="20" value = "<? echo $datos[0]['kilometraje_cambio']  ?>" ></td>
      </tr>
      <tr><td><input type ="hidden" name = "factupan" id = "factupan" value = "<?php echo $factupan;  ?>"></td>
      <td><strong>OPERARIO ACTUAL:</strong>  <input type ="hidden" name = "mecanico"  id = "mecanico"  value ="<?php echo  $datos[0]['mecanico']; ?>" >
        <span class="style2">
        <strong><?php  echo $nombre_mecanico; ?></strong>        </span></td>
      <td></td>
	  <td><label for="cambiar_mecanico">CAMBIAR OPERARIO
	    <label>
	   
	    <input type="checkbox" name="cambiar_mecanico" id = "cambiar_mecanico" value="1">
	    </label></td>
	  <td>
	  		<select name="mecanico_nuevo" id = "mecanico_nuevo">
		  <option value = ""   >   </option>
		
		<?php
		while($mecanicos = mysql_fetch_assoc($consulta_operarios))
			{
			     echo  '<option value = "'.$mecanicos['idcliente'].'"   > '.$mecanicos['nombre'].'  </option>';
			}
		?>
	  </select>	  </td></tr>
      <tr>
        <td colspan="11"></td>
      </tr>
      <tr>
	  <td colspan="11"><div align="center">TRABAJO A REALIZAR </div></td>
      </tr>
      <tr>
	  <td height="80" colspan="11"><label>
	  <textarea name="descripcion"  id = "descripcion" cols="90" rows="4"> <?php  echo $datos[0]['observaciones']?>
	  </textarea>
	  </label></td>
      </tr>
	  </table>
	  
	  <script>
	  
	  function asignaracodigopan123(codigo){
		  event.preventDefault();
		  /* alert(codigo); */
		  document.getElementById("div_buscar_codigo").innerHTML='';
		  document.getElementById("div_buscar_codigo").style.display='none';
		  document.getElementById('codigopan').value=codigo;
		  buscarInfoCodigo(codigo);
	} 

	function buscarInfoCodigo(codigo)
	{
			/* alert(identi); */
			const http=new XMLHttpRequest();
			const url = 'ordenbuscarInfoCodigo.php';
			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200){
					console.log(this.responseText);
					  var  resp = JSON.parse(this.responseText); 
					/* document.getElementById("infoVerificaciones").innerHTML = this.responseText; */
					document.getElementById("descripan").value= resp.descripcion;
					document.getElementById("exispan").value= resp.cantidad;
					document.getElementById("cantipan").focus();

				}
			};
			http.open("POST",url);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send("opcion=validarIdenti"
					+ "&codigo="+codigo
			);
	}

	function pantallaBuscarCodigo(){
		/* alert('buenas ');  */
		event.preventDefault();
		const miDiv = document.getElementById('div_buscar_codigo');
		miDiv.style.backgroundColor = 'lightblue'; 
		miDiv.style.border = '3px solid black';
		const http=new XMLHttpRequest();
		const url = 'ordenformulariobuscarCodigo.php';
		http.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				console.log(this.responseText);
				document.getElementById("div_buscar_codigo").style.display = 'block';
				document.getElementById("div_buscar_codigo").innerHTML = this.responseText;
				/* document.getElementById('codigopan').value='';
				document.getElementById('descripan').value='';
				document.getElementById('valor_unit').value='';
				document.getElementById('exispan').value='';
				document.getElementById('cantipan').value='';
				document.getElementById('totalpan').value='0'; */
			}
		};
		http.open("POST",url);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send("opcion=validarIdenti"
		/* + "&identi="+identi */
		);
		
	} 
	
	
	
	function limpiarpantallaBuscarCodigo()
	{
		event.preventDefault();
		document.getElementById("div_buscar_codigo").innerHTML = '';
		document.getElementById("div_buscar_codigo").style.display='none';
   }
     function buscardescripcionCodigo()
    {
		 event.preventDefault();
    	var descripcion = document.getElementById('descripcionabuscar').value;
        /* alert(descripcion); */
             const http=new XMLHttpRequest();
			 const url = 'ordenbuscarPorDescripcion.php';
			 http.onreadystatechange = function(){
			 	if(this.readyState == 4 && this.status ==200){
			 		console.log(this.responseText);
			 		document.getElementById("div_resultadosbusquedaCodigo").innerHTML = this.responseText;
			 	}
			 };
			 http.open("POST",url);
			 http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			 http.send("opcion=validarIdenti"
			 		+ "&descripcion="+descripcion 
				);
    }
     function buscarElCodigo()
    {
		 event.preventDefault();
    	var codigo = document.getElementById('codigoabuscar').value;
        /* alert(descripcion); */
             const http=new XMLHttpRequest();
			 const url = 'ordenbuscarPorCodigo.php';
			 http.onreadystatechange = function(){
			 	if(this.readyState == 4 && this.status ==200){
			 		console.log(this.responseText);
			 		document.getElementById("div_resultadosbusquedaCodigo").innerHTML = this.responseText;
			 	}
			 };
			 http.open("POST",url);
			 http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			 http.send("opcion=validarIdenti"
			 		+ "&codigo="+codigo 
				);
    }



  </script>
   <table width="75%" border = "1">
   <tr>
		<td>
			<div style="background-color: #4E94AB;">
			<button onclick="pantallaBuscarCodigo();" >Buscar Descripcion</button>
				<button onclick="limpiarpantallaBuscarCodigo();" >Cerrar Buscar</button>
			</div>
		</td>
	</tr>
	<tr>	
		<td>
			<div id="div_buscar_codigo" style="padding:10px;" width="500px;" height= "100px;"></div>
		</td>
   </tr>
   </table>

  <br>
	  <table width="75%" border = "1">
      <tr>
        <td colspan="11"><div align="center">PARTES Y RESPUESTOS 
	
		</div></td>
      </tr>
      <tr>
    <td><div align="center">ITEM</div></td>
    <td><div align="center">COD </div></td>
    <td><div align="center">DESCRIPCION</div></td>
	<td><div align="center">MECANICO</div></td>
	
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
    <td width="149"><input type="text" name="descripan" id = "descripan" /> <div id = "descripcion"></div></td>
	 <td width="82"><select name="id_mecanico" id = "id_mecanico">
		  <option value = ""   >   </option>
		<?php
		$sql_operarios123 = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' ";
		$consulta_operarios123 =  mysql_query($sql_operarios123,$conexion);
		while($mecanicos123 = mysql_fetch_assoc($consulta_operarios123))
			{
			     echo  '<option value = "'.$mecanicos123['idcliente'].'"   > '.$mecanicos123['nombre'].'  </option>';
			}
		?>
	  </select>	</td>
    <td width="82"><input type="text" name="valor_unit" id = "valor_unit" size = "10" /></td>
    <td width="87"><input name="exispan" type="text" id = "exispan" size="10" /></td>
    <td width="85"><input name="cantipan" type="text" id = "cantipan"  size ="10"/></td>
    <td width="77"><input name="totalpan" type="text" id = "totalpan" size="15" /></td>
    <td width="75"><button type = "button" id = "agregar_item">Agregar</button></td>
  </tr>
    </table>
  
		  <div id = "nuevodiv">
				 <?php 
				  include('mostrar_items.php');
				  $_SESSION['id_orden'] = $_REQUEST['idorden'];
				  mostrar_items($_SESSION['id_orden']);
				  //$factupan = $_GET['idorden'];
				?>
		 </div>
		 <br>
  
	</table>
  <br>

	 <BR>
  <table border = "1" width = "75%" class="color_borde_tabla">
      <tr>
        <td colspan="7"><div align="center">INVENTARIO  <input name="iva" type="hidden" id = "iva"  value = "<?php echo $datos[0]['iva']; ?>"</div></td>
      </tr>
	  
	  <?php mostrar_inventario_moto($conexion,$tabla24,$datos[0]['tipo_taller'],$tabla25,$_SESSION['id_empresa'],$_REQUEST['idorden']);
	 
		$nombre_estado = busque_estado($tabla26,$datos[0]['estado'],$_SESSION['id_empresa'],$conexion);
		
	  ?>
    </table>
	<br>
	<table border = "1" width = "75%">
	<tr>
	<td>ESTADO ACTUAL ORDEN : <?php echo ' <strong>'.$nombre_estado.'</strong>' ?><input type ="hidden"  name = "estado" id= "estado" value = "<?php  echo $datos[0]['estado']; ?>"></td>
	
	<td>CAMBIAR ESTADO
	<select name = "ultimo_estado" id = "ultimo_estado">
	
	<option value="...">...</option>

	<?php  		
		while($estados = mysql_fetch_assoc($consulta_estados_almacenados))
			{
				echo '<br>'.$estados['descripcion_estado'];
				echo '<option value= '.$estados['valor_estado'].'>'.$estados['descripcion_estado'].'</option>';
			}
	?>	
	</select>
	 </td>
	</tr>
	</table>
	<br>
		<table border = "1"  width = "75%">
<tr>
<td><h2>
<!--<input type = "submit"  value = "ACTUALIZAR ORDEN"> -->
<input type="button" value="ACTUALIZAR_INFORMACION" onClick="valida_envia()">
</h2>  </td>
</tr>
</table>
  </form>
<?php
}// fin de si la orden si se deja modificar osea else de si filas = 0
?>


 <h2><a href="../menu_principal.php">Menu Principal</a> <h2>
  
 <a href="index.php">Menu Ordenes</a> 
</div>
</body>
</html>

<?php
function mostrar_inventario_moto($conexion,$tabla24,$tipo_taller,$tabla25,$id_empresa,$id_orden)
{

//$sql_nombres_items_inventarios_ante = "select * from $tabla24  where decarroomoto = '".$tipo_taller."'   and id_empresa = '".$_SESSION['id_empresa']."' ";
$sql_nombres_items_inventarios = "
select * from $tabla25 r
inner join $tabla24 ic on (r.id_nombre_inventario = ic.id_nombre_inventario)
where r.id_empresa = '".$id_empresa."'
and r.id_orden = '".$id_orden."'
order by r.id_relacion_orden_inventario
";
//echo '<br>'.$sql_nombres_items_inventarios;
$consulta_nombres_items = mysql_query($sql_nombres_items_inventarios,$conexion);
$filas_nombres_items = mysql_num_rows($consulta_nombres_items);
$nombres2_items = get_table_assoc($consulta_nombres_items);
/*
echo '<pre>';
print_r($nombres2_items);
echo '</pre>';
*/

//echo '<br>consulta'.$sql_nombres_items_inventarios.'<br>';
	echo '<tr>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	echo '</td>';
		echo '<td>';
	echo '<td>DESCRIPCION</td>';
	echo '<td>ESTADO</td>';
	
	echo '</tr>';


  $items_por_columna = $filas_nombres_items/2;
	$contador = 0 ;
	
	while($contador <  $items_por_columna )
	{
		//echo 'paso222';
		echo '<tr>';
		echo '<td>';
		echo $nombres2_items[$contador]['nombre'];
		echo '</td>';
		echo '<td>';
		echo '<input type="text"  name = "'.$nombres2_items[$contador]['id_nombre_inventario'].'" id = "" value ="'.$nombres2_items[$contador]['valor'].'" size="2"> '; 
		//$nombres2_items[$contador]['valor'];	
		echo '</td>';
		echo '<td>';
		/*
		echo ' <input  type = "text" name = "cantidad_'.$nombres2_items[$contador]['id_nombre_inventario'].'" size="2" 
		 value = "'.$nombres2_items[$contador]['cantidad'].'">';
		 */
		 echo '</td>';
		$segunda_fila = $contador + $items_por_columna;
		echo '<td>'.$nombres2_items[$segunda_fila]['nombre'].'</td>';
		echo '<td>';
		echo '<input type="text"  name = "'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'" id = "" 
		value ="'.$nombres2_items[$segunda_fila]['valor'].'" size="2"> ';
		echo '</td>';
		echo '<td>';
		/*
		echo ' <input  type = "text" name = "cantidad_'.$nombres2_items[$segunda_fila]['id_nombre_inventario'].'" size="2" 
		 value = "'.$nombres2_items[$segunda_fila]['cantidad'].'">';
		 */
		//echo $nombres2_items[$segunda_fila]['cantidad'];
			echo '</td>';
		
		echo '</tr>';
		$contador++;
		
	} // fin del while
}// fin del a funcion 


function busque_estado($tabla26,$id_estado,$id_empresa,$conexion)
	{
	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";
	  $consulta_estados = mysql_query($sql_estados,$conexion);
	  $resultado = mysql_fetch_assoc($consulta_estados);
	  $nombre_estado = $resultado['descripcion_estado'];
	  return $nombre_estado;
	}
?>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
function actualizarUsuarioHoraModif(){
	var data =  'idOrden=' + $("#orden_numero").val();
		data += '&nombreUsuarioLogueado=' + $("#nombreUsuarioLogueado").val();
	$.post('../orden/actualizarUltimamodificacionOrden2.php',data,function(a){
				/* $("#nuevodiv").html(a); */
			});
}
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
			  //////////////////////////////////
				/////////////////////////////////	
						$("#agregar_item").click(function(){
							var data =  'codigopan =' + $("#codigopan").val();
							data += '&descripan=' + $("#descripan").val();
							data += '&valor_unit=' + $("#valor_unit").val();
							data += '&cantipan=' + $("#cantipan").val();
							data += '&totalpan=' + $("#totalpan").val();
							data += '&exispan=' + $("#exispan").val();
							data += '&id_mecanico=' + $("#id_mecanico").val();
							data += '&orden_numero=' + $("#orden_numero").val();
							$.post('procesar_items.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
							actualizarUsuarioHoraModif();
						 });
				
					///////////////////////////////////para eliminar items
					$(".eliminar").click(function(){
			
						    actualizarUsuarioHoraModif();
							var data =  'eliminar =' + $(this).attr('value');
							data += '&factupan=' + $("#orden_numero").val();
							$.post('eliminar_items.php',data,function(a){
								$("#nuevodiv").html(a);
								//alert(data);
							});	
						 });
					//////////////////////////////////
					$('#cantipan').keyup(function(b){
					if (b.which == 13)
					{

				         resultado = '78910';
						 resultado2 = $('#cantipan').val() *  $('#valor_unit').val() ;
						$('#totalpan').val(resultado2);  
					}	
						
					});
					
					/////////////////////////
					$("#actualizar_orden").click(function(){
							var data =  'orden_numero=' + $("#orden_numero").val();
							data += '&clave=' + $("#clave").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&placa=' + $("#placa").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&iva=' + $("#iva").val();
							data += '&kilometraje=' + $("#kilometraje").val();
							data += '&mecanico=' + $("#mecanico").val();
							data += '&kilometraje_cambio=' + $("#kilometraje_cambio").val();
							data += '&cambiar_mecanico=' + $("#cambiar_mecanico:checked").val();
							data += '&estado=' + $("#estado").val();
							data += '&ultimo_estado=' + $("#ultimo_estado").val();
							$.post('actualizar_orden_honda.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#divorden").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
						///////////////////////////////////
				
					$("#cambiar_placa").click(function(event) {
							    if($(this).is(":checked")) 
								{ 
										 $("#mostrar_placas").css("display","block");
										//alert('Se hizo check en el checkbox.');
							  
							  
							  	} else {
										//alert('Se destildo el checkbox');
										$("#mostrar_placas").css("display","none");
							  }	  
					  });
					  //////////////////////////
					


			
			});		////finde la funcion principal de script
			
			
			


			
			
</script>

<script>
function valida_envia(){ 
   	//valido el nombre 
	/*
   	if (document.actualizarorden.abono.value.length==0){ 
      	alert("Tiene que escribir su kilometraje_cambio") 
      	document.actualizarorden.kilometraje_cambio.focus() 
      	return 0; 
   	} 
	*/
	
//el formulario se envia 
   	/* alert("Muchas gracias por enviar el formulario");  */
   	document.actualizarorden.submit(); 
}
</script>


