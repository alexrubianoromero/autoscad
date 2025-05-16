<?php
include('../valotablapc.php');
$tamano_letra ="15px"; 
function mostrar_items_orden($tabla,$idorden,$conexion){
     $sql_items = "select * from $tabla   where no_factura = '".$idorden."'   ";
     $con_items = mysql_query($sql_items,$conexion);
   
     echo '<table border = "1"   class="table table-hover">';
     echo '<thead>';
     echo '<tr>';
     echo '<td>ITEM</td>';
      echo '<td>R/M/A</td>';
     echo '<td>CODIGO</td>';
     echo '<td>DESCRIPCION</td>';
     //echo '<td>MECANICO</td>';
     echo '<td>CANTIDAD</td>';
     echo '<td>VALOR</td>';
   
     echo '</tr>';
     echo '</thead>';
     echo '<tbody>';
     $conta = 1;
     $suma_items= 0;
     while($it = mysql_fetch_assoc($con_items)) 
     {
     	 echo '<tr>';
     	 echo '<td>'. $conta.'</td>';
            echo '<td>';
           if($it['repman']=='0')
           {
     	 echo'
     	 <select id="repman_'.$it['id_item'].'"  name="repman_'.$it['id_item'].'"  class="form-control">
     	<option value ="0">Escojer Tipo</option>
			<option value ="R">REPUESTO</option>
			<option value ="M">MANO DE OBRA</option>
			<option value ="A">ACEITES</option>
		</select>';

     	//echo '<input type="text" id="tipo_'.$it['id_item'].'"  name="tipo_'.$it['id_item'].'" value ="'.$item.'" >';
     	
          }
          else{
               echo '<input type="text" id="repman_'.$it['id_item'].'"  name="repman_'.$it['id_item'].'" value ="'.$it['repman'].'" >';
          
          }     	 
          echo '<input type="hidden" id="id_item_'.$it['id_item'].'"  name="id_item_'.$it['id_item'].'" value ="'.$it['id_item'].'">';

           echo'</td>';


     	  echo '<td>'. $it['codigo'].'</td>';
     	   echo '<td>'. $it['descripcion'].'</td>';
     	   //echo '<td>'. $it['id_mecanico'].'</td>';
     	   echo '<td>'. $it['cantidad'].'</td>';
           //preguntar si es codigo mano de obra  

           if($it['codigo']=='MO' || $it['codigo']=='mo'  || $it['codigo']=='REP' || $it['codigo']=='rep'   ){
            $valor_del_item = round($it['total_item']/1.19);
            echo '<td align="right">';
            echo 'Con Iva '.$it['total_item'];
            echo '<input id="valor_'.$it['id_item'].'"  name="valor_'.$it['id_item'].'"    align="right" type="text" value="'.$valor_del_item.'"  style="text-align:right;" size="10px">';
            echo '</td>';
           }
           else
           {
            $valor_del_item = $it['total_item'];
            echo '<td align="right">';
            echo number_format($valor_del_item, 0, ',', '.');
             echo '<input id="valor_'.$it['id_item'].'"  name="valor_'.$it['id_item'].'"   align="right" type="hidden" value="'.$valor_del_item.'"  style="text-align:right;" size="10px">';
            echo '</td>';
           }
     	  
     	   //}
           //else
           //{echo '<td align="right">'. number_format($it['total_item'], 0, ',', '.').'</td>';
  // }
           //echo '<td><button id="actualizar" class="actualizar" value = "">Actualizar</button></td>';
     	echo '</tr>';
     	 $conta++;
           $suma_items_con_iva += $it['total_item'];
         $suma_items += $valor_del_item;
     }//fin de while 
     echo '<tr>';
     echo '<td></td><td></td><td></td><td></td><td>Total</td><td align="right"></td>';
     //'./*number_format($suma_items, 0, ',', '.')*/.'
     echo '<tr>';
     echo '</tbody>';
     echo '</table>';

}//fin de funcion mostrar items
?>
<html>
<head>
	<title></title>

     <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
     <script src="../js/jquery-2.1.1.js"></script>   
     <script src="../js/bootstrap.min.js"></script>   

	<style>
	body{
		background-color: #c0c0c0;
	}
	</style>

</head>
<body>
<div class = "container" align="center">
     <h1>FACTURACION DE ORDENES</h1>

<div id="div_muestre_items_orden">
<form name = "formu" method="post" action="actualizar_repman_items.php" >	
	<input type="hidden"  name = "idorden" value = "<?php  echo $_REQUEST['idorden']; ?>">
<?php
	mostrar_items_orden($tabla15,$_REQUEST['idorden'],$conexion);
?>
<br>
<button type="submit" class="btn btn-primary"><h3>CREAR LA FACTURA PARA ESTA ORDEN</h3></button>
</form>

</div>
</div>
</body>
</html>

<script language="JavaScript" type="text/JavaScript">
$(document).ready(function(){
   //alert('asdasd');


});
</script>
