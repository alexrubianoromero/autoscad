<?php
session_start();
/*
echo '<pre>';
print_r($_GET);
echo '</pre>';
*/

include("../valotablapc.php");
include("../funciones.php");
$sql_traer_datos_codigo = "select * from $tabla12 where id_codigo = '".$_GET['id_codigo']."' ";
$consulta_codigo = mysql_query($sql_traer_datos_codigo,$conexion); 
$datos_codigo = mysql_fetch_assoc($consulta_codigo);
$fechapan =  time();
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- <link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>
<body>
<? include("../empresa.php"); ?>
<Div id="contenidos" class="container mt-3">
	

      
	  <!-- <table width="767" border="1" > -->
	<table class="table" >
  <tr>
    <th >CODIGO</th>
    <th >DESCRIPCION</th>
    <th >VALOR _UNIT </th>
    <th >CANTIDAD ACTUAL</th>
  </tr>
  <tr>
    <td><?php echo $datos_codigo['codigo_producto'] ?></td>
    <td><?php echo $datos_codigo['descripcion'] ?></td>
    <td><?php echo $datos_codigo['valor_unit'] ?></td>
    <td><?php echo $datos_codigo['cantidad'] ?></td>
  </tr>
</table>
<br>

<div id = "div_datos" class="container row">
  <!-- <div class="col-lg-3">
     <label>Fecha:</label>
     <input size=10 name=fecha id = "fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?>>
  </div> -->
<table width="603" border="1">
  <tr>
    <td width="179">FECHA</td>
    <td width="408"><input class="form-control" size=10 name=fecha id = "fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?>></td>
  </tr>
  <tr>
    <td>FACTURA COMPRA </td>
    <td><label>
      <input class="form-control" type="text" name="facturacompra"  id = "facturacompra"  >
    </label></td>
  </tr>
  <tr>
    <td>CANTIDAD A CARGAR </td>
    <td><input class="form-control" type="text" name="cantidad"  id = "cantidad"  ></td>
  </tr>
  <tr>
    <td>COSTO UNITARIO </td>
    <td><input class="form-control" type="text" name="costoUnitario"  id = "costoUnitario"  ></td>
  </tr>

  <tr>
    <td>OBSERVACIONES </td>
    <td><label>
      <textarea class="form-control" name="observaciones" id = "observaciones" cols="60" rows="4"></textarea>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="hidden" name="id_codigo"  id = "id_codigo" value = "<?php   echo $_GET['id_codigo']  ?>  "  >
	<input type="hidden" name="cantidad_actual"  id = "cantidad_actual" value = "<?php   echo $datos_codigo['cantidad']  ?>  "  ></td>
  </tr>
  <tr>
    <!-- <td colspan="2"><label><button type ="button"  id = "actualizar_codigo" onclick="actualizarCodigoNuevo();" > -->
    <td colspan="2" align="center">
      <button class="btn btn-primary " style="margin:5px;" type ="button"   onclick="actualizarCodigoNuevo('<?php   echo  $_REQUEST['id_codigo'] ?>');" >
      ACTUALIZAR_INVENTARIO_CODIGO
    </button></td>
    </tr>
</table>
</div>
</Div>
	
</body>
</html>
<!-- <script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script> -->
<!-- <script src="../js/jquery-2.1.1.js"></script>  -->

<script>

    function actualizarCodigoNuevo(id_codigo)
    {
      event.preventDefault();
      var validacion = validacionCampos();
      if(validacion)
      {
        // alert(idCodigo);
                var fecha = document.getElementById('fecha').value;
                var facturacompra = document.getElementById('facturacompra').value;
                var cantidad = document.getElementById('cantidad').value;
                var observaciones = document.getElementById('observaciones').value;
                var costoUnitario = document.getElementById('costoUnitario').value;
                var cantidad_actual = document.getElementById('cantidad_actual').value;
                const http=new XMLHttpRequest();
                const url = 'actualizar_codigo.php';
                http.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status ==200){
                        document.getElementById("div_datos").innerHTML = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send("opcion=1"
                + "&id_codigo="+id_codigo
                + "&fecha="+fecha
                + "&facturacompra="+facturacompra
                + "&cantidad="+cantidad
                + "&observaciones="+observaciones
                + "&costoUnitario="+costoUnitario
                + "&cantidad_actual="+cantidad_actual
                );
      }
      
    }

    function validacionCampos()
    {
       if(document.getElementById("facturacompra").value == '')
        {
          alert("Digite facturacompra") ;  
          document.getElementById("facturacompra").focus();
          return 0;
        }

       if(document.getElementById("cantidad").value == '')
        {
          alert("Digite cantidad") ;  
          document.getElementById("cantidad").focus();
          return 0;
        }
       if(document.getElementById("costoUnitario").value == '')
        {
          alert("Digite costoUnitario") ;  
          document.getElementById("costoUnitario").focus();
          return 0;
        }
       if(document.getElementById("observaciones").value == '')
        {
          alert("Digite observaciones") ;  
          document.getElementById("observaciones").focus();
          return 0;
        }


        return 1
    }

            
			// $(document).ready(function(){

        // $("#actualizar_codigo").click(function(){
        //     var valida = validarInfo()
        //     if(valida);
        //     {
        //       var data =  'id_codigo=' + $("#id_codigo").val();
				// 			data += '&fecha=' + $("#fecha").val();
				// 			data += '&facturacompra=' + $("#facturacompra").val();
				// 			data += '&cantidad=' + $("#cantidad").val();
				// 			data += '&observaciones=' + $("#observaciones").val();
				// 			data += '&costoUnitario=' + $("#costoUnitario").val();
				// 			data += '&cantidad_actual=' + $("#cantidad_actual").val();
				// 			$.post('actualizar_codigo.php',data,function(a){
        //         //$(window).attr('location', '../index.php);
        //         $("#datos").html(a);
				// 			});	
        //     }
				// 	});
				// 	////////////////////////
        // });		////finde la funcion principal de script
        
           
        
			
</script>

  