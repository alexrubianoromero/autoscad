<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
  </head>
  <style>
    #linksiguiente{
      font-size:25px;
      color:white;
    }
  </style>
<body  background="imagenes/fondo.jpg">
<br />
<br />

<Div id="contenidos">
<form action="verificar_usuario.php" method="post">
  <div align="center">
    <table width="797" border="0">
      <tr>
        <td colspan="2" align= "center" ><img src = "imagenes/logo.png" width="400"  high="220"></td>
      </tr>
      
      <tr>
        <td width="208"><img src="imagenes/usuario.png" width="60" height="72"></td>
        <td width="573"><label><h2>
          <input type="text" name="usuario" id="usuario" /></h2>
        </label></td>
      </tr>
      <tr>
        <td><img src="imagenes/clave.png" width="60" height="30"></td>
        <td><h2><input type="password" name="clave" /></h2></td>
      </tr>
      <tr>
        <td colspan="2"><h2><label>
          <div align="center">
            <!-- <input type="image" name="Submit" value="Enviar" src="imagenes/boton_enviar.png" width ="200" heigh = "20" /> -->
            <input type="image" name="btn_enviar_informacion" id= "btn_enviar_informacion" value="Enviar" src="imagenes/boton_enviar.png" width ="200" heigh = "20"/>
            </div>
        </label></h2></td>
        </tr>
      
      <tr>
        <td colspan="2"><img src="imagenes/texto_final.png" width="750" height="80"></td>
       </tr>
    </table>
    <div id="div_recordar_clave">
      <!-- <BUTTON id ="btn_recordar_contrasena"> ENVIAR_CORREO_RECORDAR_CLAVES</BUTTON> -->
      <!-- <a id="linksiguiente" href="recuperarclaves/index.php">ENVIAR CLAVE</a> -->
    </div>
  </div>
</form>
</div>
</body>
</html>
<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script> 
<script src="js/app.js"></script>  

