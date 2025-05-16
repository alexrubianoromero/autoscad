<?php
session_start();
include('../valotablapc.php');  
// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br>
    <div id="div_eliminacion">
        Clave Eliminacion:<input type="hidden" id = "id_codigo" value="<?php  echo $_REQUEST['id_codigo'];  ?>">
        <input type="password" id = "claveDeEliminar">
        <button onclick="confirmarEliminar();">Verificar clave</button>
    </div>
</body>
</html>
<script>
    function confirmarEliminar()
    {
        // var claveLiminar = prompt('Por favor digite la clave para eliminacion ');
        var claveLiminar = document.getElementById('claveDeEliminar').value;
        var id_codigo = document.getElementById('id_codigo').value;
        if(claveLiminar=='1313')
        {
            // alert('La clave es correcta ');
            const http=new XMLHttpRequest();
            const url = '../inventario_codigos/eliminarcodigo.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    console.log(this.responseText);
                    document.getElementById("div_eliminacion").innerHTML = this.responseText;
                }
            };
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=validarIdenti"
                    + "&claveLiminar="+claveLiminar
                    + "&id_codigo="+id_codigo
            );

        }else {
            alert('clave incorrecta');
        }
    }
</script>