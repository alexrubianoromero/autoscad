<?php
session_start();
include('../valotablapc.php');  
include('../funciones.php'); 
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
  <meta charset="UTF-8">
  <title>NUEVA VENTA</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
</head>
<body>
  <?php   
  //recuperar la informacion del cliente
  $sql_clientes ="select idcliente,nombre from $tabla3 where  idcliente = '".$_GET['idcliente']."'";
  $consulta_clientes = mysql_query($sql_clientes,$conexion);
  $cliente = mysql_fetch_assoc($consulta_clientes);
 //echo '<br>consulta<br>'.$sql_clientes;
  //////////////////////////////
         $regimen = regimen($_SESSION['id_empresa'],$tabla10,$conexion);
         //echo '<br>regimen de la empresa '.$regimen.'<br>';
         if($regimen == 1 )
                {$campo = 'contafac';$documento = 'FACTURA' ;} 
          else  {$campo ='contacot';$documento = 'DOCUMENTO' ;}
         $maximo_valor = maximo_valor($campo,$conexion,$tabla10,$_SESSION['id_empresa']);
         //echo '<br>regimen'.$regimen.'maxima numeracion='.$maximo_valor,'<br>';
         $siguiente_numero = $maximo_valor+ 1 ;
		 $factupan = $siguiente_numero ;
  ?>
<br>
<br>
	<div id= "datos_persona"> 
	<table width="568" border="1">
  <tr>
    <td><?php echo $documento; ?></td>
    <td><input type ="text" id="factupan" name = "factupan" value = "<?php  echo $siguiente_numero  ?>"> </td>
  </tr>
  <tr>
    <td  width="176">Nombre</td>
    <td width="376"><input type="text" name="nombre" id = "nombre" value ="<?php echo $cliente['nombre']  ?>"  ><input type="hidden" name="idcliente" id = "idcliente" value ="<?php echo $_GET['idcliente']  ?>"  ></td>
  </tr>
  <tr>
    <td>Elaborado por:</td>
    <td><input name="elaborado_por" type="text" id = "elaborado_por" maxlength="40" ></td>
  </tr>
</table>

	</div>

<br>

<div id = "divfactura">

    <table width="679" border = "1">
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
						
	  					</div>
      <table>
          <tr> <td colspan="7"><button type ="button"  id = "grabar_factura_venta" >
          <h4>FINALIZAR_DOCUMENTO</h4>
          </button></td></tr>

      </table> 
	 <?php include('../colocar_links2.php');  ?> 
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
              data += '&orden_numero=' + $("#factupan").val();
              $.post('procesar_items_temporal.php',data,function(a){
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
          $("#grabar_factura_venta").click(function(){
              var data =  'factupan=' + $("#factupan").val();
			  data += '&idcliente=' + $("#idcliente").val();
			  data += '&elaborado_por=' + $("#elaborado_por").val();
              $.post('grabar_factura_venta.php',data,function(a){
              //$(window).attr('location', '../index.php);
              $("#divfactura").html(a);
                //alert(data);
              }); 
             });
          ////////////////////////
          

      });   ////finde la funcion principal de script
      
      
     </script> 