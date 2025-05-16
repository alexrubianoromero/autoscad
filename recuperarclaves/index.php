<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body{
            position:relative;
            width: 90%;
            height: 90%;
            color:white;
            /* text-align: center; */
            font-size: 25px;
        }
        #div_recuperar{
            position:relative; 
            width: 50%;
            height: 50%;
            border:1px solid white;
            padding: 50px;
        }
        #usuario{
            padding:10px;
            margin:2% auto;
        }
        #cuadro{
            position: relative;
            top:30px; 
            left: 5%;
            /* border:1px solid grey; */
        }
        #avisito,#avisodigiteusuario,#avisofaltousuario{
            display:none;
        }
    </style>
</head>
<body  background="../imagenes/fondo.jpg" align="center">

<div class="alert alert-danger" role="alert" id="avisofaltousuario">
    <strong>Cuidado!!</strong> No se digito un nombre de usuario
    <button id="cerraraviso">x</button>
</div>

<div class="container" align="center" id="cuadro">
<img src = "../imagenes/logo.png" width="400"  high="220">
<div id="div_recuperar" align="center">
    <h3>RECUPERACION DE CLAVE</h3>
<div class = "form-group">
 <label for ="usuario" > Usuario: </label><input type="text" id="usuario" name = "usuario" class = "form-control"  placeholder="Usuario">
<button id="btn_recordar_contrasena" name = "btn_recordar_contrasena" class="btn btn-primary btn-block">ENVIAR CORREO CON LA CLAVE</button>
</div>
<div id="div_recuperar_clave">
</div>
<a href="../index.php">REGRESAR MENU INGRESO</a>
</div>
</div>
</body>
</html>
<script src="../js/jquery-2.1.1.js"></script> 
<script src="../js/app.js"></script>  