<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
<div id="div_clave_reinicio" class="container">	
	<h1>POR FAVOR DIGITE LA CLAVE DE REINICIO </h1>
		
			<div class = "form-group">
  				<input type="text" id="clave_reinicio" class= "form-control" placeholder= "DIgite Aqui la Clave de Reinicio">
				<br><br>
				<button id="btn_enviar" class="btn btn-primary btn-lg btn-block">PROCEDER CON EL RENICIO DE LOS CONTADORES</button>
			</div>
		
</div>

</body>
</html>

<script src="../js/jquery-2.1.1.js"></script>   
<script src="../js/bootstrap.min.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	$("#btn_enviar").click(function(){


		 if($("#clave_reinicio").val() == '1234')
        { 

        		var data =  'reiniciar =' + '1';
							//data += '&descripan=' + $("#descripan").val();
							
						
							$.post('../contadores/realizar_reinicio_contadores.php',data,function(a){
							$("#div_clave_reinicio").html(a);
								//alert(data);
							});	
               //$(cedula).focus();
               // return false;
         }
         else
         {
         	alert('Clave Incorrecta');

         
        				
		 } //fin de else					

	});


});
</script>	

