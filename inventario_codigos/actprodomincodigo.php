<?php
    session_start();
    include('../valotablapc.php');  
    
     $sql="update productos 
            set producto_minimo = '".$_REQUEST['prodminimimo']."'   
            where id_codigo = '".$_REQUEST['idCodigo']."'
     ";
    //  die($sql); 
    $consulta = mysql_query($sql,$conexion);

    echo 'Producto minimo actualizado '; 

?>