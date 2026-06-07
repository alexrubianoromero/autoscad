<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <!-- <button onclick="exportarClientesExcel();">Exportar Clientes</button> -->
    <div class="col-lg-3 offset-1 form-group mt-3 row">
         <h1>Exportar Clientes</h1>
         <form method="post" action="realizarExporteClientes.php"> 
                <span class="col-lg-1"  >Clave:</span>
                <input class="form-control col-lg-1 mt-2" type="password" name="clave" id="clave" >

                <button class="btn btn-primary mt-3 " type="submit">Enviar</button>
         </form>
        <!-- <a href="realizarExporteClientes.php">Exportar Clientes</a> -->

     </div>
</body>
</html>
<script src="clientes/js/clientesjs.js"></script>