<?php
session_start();
include('valotablapc.php');
$sql_ruta_logo = "select ruta_imagen from $tabla10  where id_empresa = '".$_SESSION['id_empresa']."'   ";
$consulta_ruta = mysql_query($sql_ruta_logo,$conexion);
$arreglo_ruta = mysql_fetch_assoc($consulta_ruta);
$ruta_imagen =  $arreglo_ruta['ruta_imagen'];
?>

<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1">
<title>Untitled Document</title> 
<link rel="stylesheet" href="css/normalize.css">
 <link rel="stylesheet" href="css/style_menu_navegacion.css"> 
  <link rel="stylesheet" href="css/style.css"> 
<style>
#contenidos{
	width: 100%;
	position:relative;
	border: 1px solid black;
}
.enlinea{
	display: inline;
}
#div_imagen{
	width: 100%;
	height: 120px;
	position:relative;
	/*border: 1px solid black;*/
}
#mensaje{
	top:0px;
	left:65%;
	width: 35%;
	height: 90%;
	position:absolute;
	border: 1px solid black;
	background-color: #C0C0C0;
	/*background-image: url('logos/aniversario.jpeg');*/
	  background-image: url("logos/aniversario.png");
}
#informacion{
	position:absolute;
	bottom :0px;
	left:0px;
	width: 40%;
	height: 20%;
	/*border: 1px solid black;*/

}
</style>
</head>

<body>
<div id ="contenidos">

 <div width ="30" height="30"  align="center" id="div_imagen"><img src="logos/<?php echo $ruta_imagen;  ?>" />

  <div id="mensaje" align="justtify">
  	<p>
  	Su amplia visión y su tenacidad han producido los frutos de la victoria. Continúen así, mejorando cada día y las recompensas serán mayores. Felicidades de Kaymo en su aniversario
  </p>

 
  </div>
   <div id="informacion" align="left">
  	<?php  
//echo '<div id ="informacion_usuario">';
echo 'Usuario Actual:  '.$_SESSION['nombre_usuario'].'  Perfil: '.$_SESSION['nombre_perfil'] ; 
//echo  '</div>';
 ?> 
  </div>	
 </div>

<!--
<div align="center"><img src="logos/arsolution.jpg"  WIDTH="300px"  HEIGHT ="150px"/></div>

-->
</div>

	<header>

				<nav class="menu">
					<?php
					 include('pintar_menu_categorias.php');	
					?>
				</nav>
				
</header>




<iframe name = "cuadro_principal" width="100%" height="800" scrolling="si">

</iframe>
</body>
</html>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   