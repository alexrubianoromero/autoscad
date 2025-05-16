<?php
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_item = "select * from $tabla15   where id_item = '".$_REQUEST['id_item']."'   ";
$con_item = mysql_query($sql_item,$conexion);
$arr_item = mysql_fetch_assoc($con_item);
//echo '<br>'.$sql_item;
?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<style>
.formato_tabla	td{
  padding: 10px;
}
.formato_tabla	,th,td {
   border-collapse: collapse;
   border: 1px solid black;
}
.formato_tabla thead{
	background-color: orange;
	text-align: center;
}
#btn_actulizar_item,input{
	color:black;
}
</style>
</head>
<body>
	<input type="hidden" id = "id_item"  value = "<?php echo $_REQUEST['id_item'];  ?>">
	<input type="hidden" id = "id_orden"  value = "<?php echo $_REQUEST['no_factura'];  ?>">
<table class = "formato_tabla"  width="100%">
	<thead>
		<tr>
			<th>CODIGO</th>
			<th>DESCRIPCION</th>
			<th>MODIFICAR </th>

		</tr>	
	</thead>
	     <tr>
	     	<td><?php  echo $arr_item['codigo'] ?></td>
	     	<td><input type="text"  id="descripcioncita"   value ="<?php  echo $arr_item['descripcion'] ?>" size="70px"></td>
	     	<td align="center"><button  id="btn_actulizar_item" >ACTUALIZAR</button></td>
	     </tr>	
	<tbody>
	</tbody>	
</table>	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
<script language="JavaScript" type="text/JavaScript">
$(document).ready(function(){
	
	$("#btn_actulizar_item").click(function(){
							var data =  'id_item=' + $("#id_item").val();
							data += '&descripcion=' + $("#descripcioncita").val();
							data += '&id_orden=' + $("#id_orden").val();
							$.post('actualizar_item.php',data,function(a){
							$("#nuevodiv").html(a);
								//alert(data);
							});	
							//$("#div_modificar_item").css("display","none");					

	 });

            
 }); //duncion principal 
</script>
				               


