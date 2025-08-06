<?php
session_start();

date_default_timezone_set('America/Bogota');

require_once('../valotablapc.php');  

require_once('../funciones/funciones.class.php'); 

require_once('../vehiculos/controlador/vehiculoControlador.php');

$vehiculo = new vehiculoControlador($conexion);