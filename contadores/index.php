<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container" align="center">
	<div id="div_mayor">
        <h1>REINICIO DE CONTADORES DE COTIZACIONES ORDENES FACTURAS</h1>
        <div id="div_reinicio">
         <button class="btn btn-primary btn-lg" id="btn_reiniciar_contadores">REINICIAR CONTADORES</button>
         </div>

     </div>
</div>

</body>
</html>

<script src="../js/jquery-2.1.1.js"></script>   
<script src="../js/bootstrap.min.js"></script>   
<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	$("#btn_reiniciar_contadores").click(function(){
							var data =  'reiniciar =' + '1';
							//data += '&descripan=' + $("#descripan").val();
							
						
							$.post('confirmar_reinicio.php',data,function(a){
							$("#div_reinicio").html(a);
								//alert(data);
							});	
	});


});
</script>				