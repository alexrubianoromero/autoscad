
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript" src="js/cssrefresh.js"></script>
</head>
<body>
<div id="fondo">
<div id="fechas" align="center">
<p id="titulo2">POR FAVOR INDIQUE LAS FECHAS SOLICITADAS </p>
<label for="fechain" >Fecha Inicial  </label><input name="fechain" id = "fechain" type="date" class="fila_llenar_fecha" >
<label for="fechafin" >Fecha Final  </label><input name="fechafin" id = "fechafin" type="date"  class="fila_llenar_fecha" >
<input type ="button" id="consultar"  value = "consultar" class="boton" >
</div>
<div id="muestre_resultados"  align="center">
</div>
</div>
</body>
</html>
<scrip>
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
<script type="text/javascript" >
 $(document).ready(function(){

 			$("#consultar").click(function(){
 				var data =  'fechain=' + $("#fechain").val();
 				data += '&fechafin=' + $("#fechafin").val();
 					$.post('muestre_ordenes_rango_fechas.php',data,function(a){
							$("#muestre_resultados").html(a);

					});	
 				//alert("consultar_fechas");	
 			});
 			//
 })
</script>