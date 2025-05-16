<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<h1>REALMENTE DESEA REINICIAR LOS CONTADORES ??</h1>

<div id="div_reinicio23">
<button class="btn btn-success btn-lg" id="btn_si">SI_REINICIARLOS</button>
<button  class="btn btn-secondary btn-lg" id="btn_no">NO_REINICIAR</button>

</div>
</body>
</html>

<script src="../js/jquery-2.1.1.js"></script>   
<script src="../js/bootstrap.min.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	$("#btn_si").click(function(){
							var data =  'reiniciar =' + '1';
							//data += '&descripan=' + $("#descripan").val();
							
						
							$.post('../contadores/reiniciar_contadores.php',data,function(a){
							$("#div_reinicio").html(a);
								//alert(data);
							});	
	});


});
</script>	