<?php
session_start();
include('../valotablapc.php');  
include('../funciones.php');  
$sql = "select * from productos where id_codigo = '".$_REQUEST['id_codigo']."' "; 
// die($sql); 
$consulta = mysql_query($sql,$conexion);
$infoProducto = mysql_fetch_assoc($consulta);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>
<body>
    <div id="div_producto_minimo" class="container mt-3">
        <table class="table">
            <tr>
                <td>Codigo</td>
                <td>Descripcion</td>
                <td>Stock Minimo</td>
            </tr>
            <tr>
                <td><?php   echo $infoProducto['codigo_producto'];    ?></td>
                <td><?php   echo $infoProducto['descripcion'];    ?></td>
                <td><input class="form-control " type="text" id="prodminimimo"  value = "<?php   echo $infoProducto['producto_minimo'];    ?>" ></td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-primary btn-lg " onclick="actualizarCodigo('<?php   echo $infoProducto['id_codigo'];    ?>');">Actualizar</button>
        </div>
        
    </div>
        
</body>
</html>
<script>
    function actualizarCodigo(idCodigo)
    {
          var prodminimimo = document.getElementById('prodminimimo').value;
            const http=new XMLHttpRequest();
            const url = '../inventario_codigos/actprodomincodigo.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    console.log(this.responseText);
                    document.getElementById("div_producto_minimo").innerHTML = this.responseText;
                }
            };
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=validarIdenti"
                    + "&idCodigo="+idCodigo
                    + "&prodminimimo="+prodminimimo
            );
    }
</script>