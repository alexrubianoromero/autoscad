<?php
include('../valotablapc.php');
$sql_reiniciar = "update $tabla10  set     contafac= '0', contaor= '0', contacot='0', contador_cotizaciones= '0'  ";
$con_reiniciar = mysql_query($sql_reiniciar,$conexion);

?>
<html>
<head>
	<title></title>

</head>
<body>
     <div id="div_reiniciado">
       <h1>LOS CONTADORES HAN SIDO REINICIADOS </h1>
     </div>  
</body>
</html>