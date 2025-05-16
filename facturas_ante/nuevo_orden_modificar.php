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
/*
$sql_numero_factura = "select * from $tabla14 where id = '".$_GET['idorden']."' ";
$consulta_facturas = mysql_query($sql_numero_factura,$conexion);
$filas = mysql_num_rows($consulta_facturas);
*/
//echo 'filas ='.$filas;
//exit();

$sql_placas = "select cli.nombre,cli.identi,cli.direccion,cli.telefono,car.placa,car.marca,car.modelo,car.color,car.tipo,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa) 
 where o.id = '".$_GET['idorden']."'   and   o.id_empresa = '".$_SESSION['id_empresa']."'  and o.estado = '0' ";
 
 //echo '<br>'.$sql_placas;
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
//echo '<br>filas =='.$filas;

 $datos = get_table_assoc($datos); 

$traer_iva = "select iva from $tabla17 ";
$consulta_iva = mysql_query($traer_iva); 
$iva = mysql_fetch_assoc($consulta_iva);
$iva = $iva['iva'];

$sql_items_orden = "select * from $tabla15 where no_factura = '".$_GET['idorden']."' order by id_item ";
$consulta_items = mysql_query($sql_items_orden,$conexion);

$factupan = $_GET['idorden'];
/*
echo '<pre>';
print_r($datos);
echo '</pre>';
exit();
*/



//$fechapan =  time();
include('../colocar_links2.php');
?>
<div id = "divorden">
  <form action="" method="post">
    <table border = "1" width="95%">
      <tr>
        <td colspan="2" rowspan="4"></td>
        <td colspan="2"><h3>ORDEN DE TRABAJO</h3></td>
        <td >
           <input name="orden" id = "orden" type="text" size="20" value = "<? echo $datos[0]['orden']  ?>"  >
             <input name="orden_numero" id = "orden_numero" type="hidden" size="20" value = "<? echo $_GET['idorden']  ?>"  >
        </td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">NIT 8300507711-7 </div></td>
        <td>CLAVE</td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">TELS 4056244/3114977845 </div></td>
        <td><input name="clave" id = "clave" type="text" size="20" ></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">CRA 53 # 5B-69 </div></td>
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
	  <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>KILOMETRAJE</td>
        <td><input name="kilometraje" id = "kilometraje" type="text" size="20" value = "<? echo $datos[0]['kilometraje']  ?>" ></td>
      </tr>
	  <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>MECANICO</td>
        <td><input name="mecanico" id = "mecanico" type="text" size="20" value = "<? echo $datos[0]['mecanico']  ?>" ></td>
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
     <!-- 
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
	  -->
	  
	  
      <?php
	  /*
     $no_item = 0 ;
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
				
			 } 
  */			 
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
  
  <br>
	  <table width="95%" border = "1">
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
					  
						
							 
		<br>
		
		<div id = "div_items">
		<?php	
		echo '<form name = "formu"  method ="post"  action = "mostrar_arreglo.php"> ';
		echo '<table border = "1"   width ="95%">';
		echo '<tr><td><h8>CANT.</h8></td><td><h8>DESCRIPCION</h8></td><td><h8>PRECIO UNI</h8></td><td><h8>PRECION TOTAL </h8></td><td><h8>IVA</h8></td>
		<td><h8>TOTAL </h8></td></tr>'	;
		$i = 0;			 
		while($items = mysql_fetch_array($consulta_items))
			{
				$items_finales[$i][]=$items[1];  
				$items_finales[$i][]=$items[3];  
				
				echo '<br>posicion <br>'.$items_finales[$i][0];
				//echo '<br>items_finales '.$items_finales[0];
				echo '<tr>';
				echo '<td>';
				echo '<input type = "text"  name = "id_item_'.$i.'"  id = "id_item_'.$i.'"  value = "'.$items[1].'"   >';
				echo $items[4];
				echo '</td>';
				echo '<td>'.$items[3].'</td>';
				echo '<td>'.$items[7].'</td>';
				echo '<td>'.$items[5].'</td>';
				if($items[10]=='1')
				  { $valor_porcentaje_iva = $iva;  }
				else   
					{ $valor_porcentaje_iva = 0;  }
					
				echo '<td> <input type = "text"  id = "porcentaje_'.$i.'" name = "porcentaje_'.$i.'"  value =  "'.$valor_porcentaje_iva.'"   ></td>';
				
				$valor_iva =  ($items[5]* $valor_porcentaje_iva)/100;
				$valor_total_con_iva = $items[5] + $valor_iva;
				echo '<td>'.$valor_total_con_iva.'</td>';
				echo '</tr>';
				$i++;
			} 		
		echo '<input type ="text" name = "control" id = "control"  value = "'.$i.'">';	
		echo '</table>';			
		echo '<table border = "1">';
				echo '<tr>';
				 echo  '<td colspan="7"><button type ="button"  id = "recalcular_items" ><h4>RECALCULAR ITEMS</h4></button></td>';
				echo '</tr>';
				echo '<input name="envia" type="submit">';
		echo '</table>';
		echo '</form>';
		echo '<pre>arrrrrrreeeeeeeeggggllllllllllllllllo';
		print_r($items_finales);
		echo '</pre>';
		?>					 
 </div>  
  
 <!-- ////////////////////////////////////////////////////////////-->
  <table border = "1" width ="95%">
      <tr>
        <td colspan="7"><div align="center">INVENTARIO</div></td>
      </tr>
      <tr>
        <td width="85"><label  for= "radio" >RADIO</label></td>
        <td width="144">
		<?  if ($datos[0]['radio']=="1"){echo '<input name = "radio" id="radio"  type="checkbox" checked  value = "1" >';} 
		    else {echo '<input  name = "radio" id="radio"  type="checkbox" unchecked   value = "1"  >';}  ?>		</td>
        <td width="199"><label for ="herramienta"> HERRAMIENTA</label></td>
        <td colspan="4"><label>
     
		  <?  if ($datos[0]['herramienta']=="1"){echo '<input name = "herramienta" id="herramienta"  type="checkbox" checked value = "1" >';} else {echo '<input  name = "herramienta" id="herramienta"  type="checkbox" unchecked value = "1" >';}  ?>
        </label></td>
      </tr>
      <tr>
        <td><label  for = "antena">ANTENA</label></td>
        <td><label><?  if ($datos[0]['antena']=="1"){echo '<input name = "antena" id="antena"  type="checkbox" checked value = "1"  >';} else {echo '<input  name = "antena" id="antena"  type="checkbox" unchecked value = "1" >';}  ?>
        </label></td>
        <td colspan="5" rowspan="2">OTROS
          <label>
            <textarea name="otros" id = "otros" cols="50" rows="2"> <?php  echo $datos[0]['otros']?></textarea>
          </label></td>
      </tr>
      <tr>
        <td><label for="repuesto"  >REPUESTO</label></td>
        <td><label><?  if ($datos[0]['repuesto']=="1"){echo '<input name = "repuesto" id="repuesto"  type="checkbox" checked value = "1" >';} else {echo '<input  name = "repuesto" id="repuesto"  type="checkbox" unchecked value = "1" >';}  ?>
		  
        </label></td>
      </tr>
      <tr>
          <?php  
             $regimen = regimen($_SESSION['id_empresa'],$tabla10,$conexion);
          ?>


        <td> 
             <?php   if($regimen=='1'){echo '<label for ="resolucion" >CON RESOLUCION</label>';}   ?>
        </td>
        <td> 
             <?php 
                if($regimen=='1'){echo '
                 <label>
                 <input type="checkbox" name="resolucion"  id =  "resolucion"  value = "1">
                 </label>';}
             ?>   
      </td>
        <td>Elaborado Por </td>
        <td width="123"><input  type = "text" name = "elaborado_por"  id = "elaborado_por" ></td>
        <td width="141">&nbsp;</td>
        <td width="48">&nbsp;</td>
        <td width="-1">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td colspan="7"><button type ="button"  id = "actualizar_orden" ><h4>CREAR FACTURA</h4></button></td>
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
					//////////////////////////////////
					$("#recalcular_items").click(function(){
							//var data =  'orden_numero=' + $("#orden_numero").val();
							var data =  'id_item_0=' + $("#id_item_0").val();
							data += '&id_item_1=' + $("#id_item_1").val();
							data += '&id_item_2=' + $("#id_item_2").val();
							data += '&control=' + $("#control").val();
							data += '&id_item_3=' + $("#id_item_3").val();
							//data += '&items_finales=' + $("#id_item_2").val();
							
							$.post('preparar_items_factura_final.php',data,function(a){
							$("#div_items").html(a);
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
					
					/////////////////////////
					$("#actualizar_orden").click(function(){
							var data =  'orden_numero=' + $("#orden_numero").val();
							data += '&clave=' + $("#clave").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&placa=' + $("#placa").val();
							data += '&descripcion=' + $("#descripcion").val();
							data += '&radio=' + $("#radio:checked").val();
							data += '&herramienta=' + $("#herramienta:checked").val();
							data += '&antena=' + $("#antena:checked").val();
							data += '&repuesto=' + $("#repuesto:checked").val();
							data += '&resolucion=' + $("#resolucion:checked").val();
							data += '&otros=' + $("#otros").val();
							data += '&iva=' + $("#iva").val();
							data += '&placa=' + $("#placa").val();
              data += '&elaborado_por=' + $("#elaborado_por").val();
			  data += '&kilometraje=' + $("#kilometraje").val();
			  data += '&mecanico=' + $("#mecanico").val();
			  
							$.post('actualizar_orden.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#divorden").html(a);
								//alert(data);
							});	
						 });
					////////////////////////
					
			
			});		////finde la funcion principal de script
			
			
			
</script>

