<!DOCTYPE html>

<head>
<meta charset="UTF-8"/>
   <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<title>Untitled Document</title>
</head>

<body>
<div align="center" style="font-size:20px"><BR />
  DIGITE EL NOMBRE
  <BR />
  
   <input type="text"  id = "nombre" name="nombre" class="fila_llenar" size="50" >
</div>
<div id="muestre_nombres"  align="center">
</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../jquery-2.1.1.js"></script>  
<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){
						/////////////////////////////////////
						  $("#nombre").keypress(function(e){
					     	var data =  'nombre=' + $("#nombre").val();
							//data += '&fechain=' + $("#fechain").val();
							//data += '&fechafin=' + $("#fechafin").val();
						  //$("#replica").val($("#mitexto").val());
							$.post('consultar_nombre.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#muestre_nombres").html(a);
													//alert(data);
							});	
	 
   });
						/////////////////////////////////////		
					
		 });			
          	
</script>

