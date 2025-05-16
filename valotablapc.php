<?php

$tabla1 = "categorias";

$tabla2 = "subcategorias";

$tabla3 ="cliente0";

$tabla4 ="carros";

//$tabla5 ="parametros";

$tabla10 = "empresa"; 

$tabla11 = "facturas";

$tabla12 = "productos";

$tabla13 = "item_factura";

$tabla14 = "ordenes";

$tabla15 = "item_orden";

$tabla16 = "usuarios";

$tabla17 = "iva";

$tabla18 = "item_temporal";

$tabla19 = "movimientos_inventario";

$tabla20 = "retefuente";

$tabla21 = "tecnicos";

$tabla22 = "salin_salfin_caja";

$tabla23 = "recibos_de_caja";

$tabla24 = "nombres_items_carros";

$tabla25 = "relacion_orden_inventario";

$tabla26 = "estados_ordenes";

$tabla30 = "perfiles";

$tabla31 = "menu_perfil";

$tablafacinv = "facturas_inventario";

$tablaitemfacinv = "item_facturas_inventario";
$tipo_item  = "tipo_item"; 

$cotizaciones = "cotizaciones";
$item_orden_cotizaciones ="item_orden_cotizaciones";
/*valores para pc*/

/*
$servidor = "localhost";

$usuario = "root";

$clave  = "peluche2016";

$nombrebase = "autoscad";
*/



/*
$servidor = "localhost";

$usuario = "ctwtvsxj_admin";

$clave  = "ElMejorProgramador***";

$nombrebase = "ctwtvsxj_base_autoscad_pruebas";
*/



$servidor = "localhost";

$usuario = "ctwtvsxj_admin";

$clave  = "ElMejorProgramador***";

$nombrebase = "ctwtvsxj_autoscad";





$conexion =mysql_connect($servidor,$usuario,$clave);

$la_base =mysql_select_db($nombrebase,$conexion);









?>

