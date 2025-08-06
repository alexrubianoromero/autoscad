<?php

$raiz = dirname(dirname(dirname(__file__)));

require_once($raiz.'/conexion/Conexion.php');



class itemsOrdenModelo extends Conexion
{
       
    public function __construct()
    {
    }
    
    public function sumarItemsIdOrden($idOrden)
    {
        $conexion = $this->connectMysql();
        $sql = "select sum(total_item) as suma from item_orden where 1=1  and anulado = '0' and no_factura = '".$idOrden."' "; 
        $consulta = mysql_query($sql,$conexion);
        $arr = mysql_fetch_assoc($consulta); 
        return $arr['suma']; 
    }

    public function verifiqueCodigo($codigo)
    {
        $conexion = $this->connectMysql();
        $sql = "select * from productos where codigo_producto = '".$codigo."' limit 1 "; 
        $consulta = mysql_query($sql,$conexion);
        $filas = mysql_num_rows($consulta);
        if($filas > 0)
        {
            $arregloCodigo = mysql_fetch_assoc($consulta); 
            $result['filas'] = $filas;
            $result['data'] = $arregloCodigo;
        }else{
            $result['filas'] = 0;
            $result['data'] = '';
        }  
        return $result;
    }

    public function traerItemsOrdenId($id)
    {
                // die('llego al modelo ');
                $conexion = $this->connectMysql();
                $sql = "SELECT i.no_factura,i.id_item, i.codigo,i.descripcion,i.cantidad,i.total_item,i.valor_unitario
                FROM item_orden i 
                LEFT OUTER JOIN  productos p on p.codigo_producto = i.codigo 
                WHERE  i.no_factura = '".$id."'  order by id_item asc";
                $consulta = mysql_query($sql,$conexion);
                $filas = mysql_num_rows($consulta);
                $arreglo= '';
                $i=0;
                while($resul = mysql_fetch_assoc($consulta)){
                    $arreglo[$i]['no_factura'] = $resul['no_factura'];
                    $arreglo[$i]['id_item'] = $resul['id_item'];
                    $arreglo[$i]['codigo'] = $resul['codigo'];
                    $arreglo[$i]['descripcion'] = $resul['descripcion'];
                    $arreglo[$i]['cantidad'] = $resul['cantidad'];
                    $arreglo[$i]['valor_unitario'] = $resul['valor_unitario'];
                    $arreglo[$i]['total_item'] = $resul['total_item'];
                    $i++;
             }
             $resultado['datos'] = $arreglo; 
             $resultado['filas'] = $filas;  
             return $resultado; 
    }

    public function grabarNuevoItem($request)
    {
        $totalItem = $request['valorUnit'] *  $request['cantidad'];
        $conexion = $this->connectMysql();
        $sql="insert into item_orden (fecha,no_factura,codigo,descripcion,cantidad,total_item,valor_unitario)   
              values(now()
              ,'".$request['idOrden']."'
              ,'".$request['codigo']."'
              ,'".$request['descripcion']."'
              ,'".$request['cantidad']."'
              ,'".$totalItem."'
              ,'".$request['valorUnit']."'
              )  ";
        $consulta = mysql_query($sql,$conexion);
        // echo 'Item Grabado ';           
    }
    
    public function eliminarItem($idItem)
    {
        $sql = "delete from item_orden where id_item =  '".$idItem."'   ";
        $consulta = mysql_query($sql,$this->connectMysql());
        echo 'Item Eliminado'; 
    }
    
    public function traerInfoItemConIdItem($idItem)
    {
        $sql = "select * from item_orden where id_item = '".$idItem."' "; 
        $consulta = mysql_query($sql,$this->connectMysql());
        $result = mysql_fetch_assoc($consulta);
        return $result;
    }
    public function traerIdUltimoItemGrabado()
    {
        $sql = "select max(id_item) as id from item_orden ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $result = mysql_fetch_assoc($consulta);
        return $result['id'];
    }

    public function traerItemsOrdenManoObraIdOrden($idOrden,$tipoCod)
    {
        $sql = "select it.codigo as codigo ,it.total_item as valor
                from item_orden it   
                inner join productos p on p.codigo_producto = it.codigo
                where it.no_factura =  '".$idOrden."'
                and p.repman = '".$tipoCod."'
                ";
        $consulta = mysql_query($sql,$this->connectMysql());    
        $result = mysql_fetch_assoc($consulta);
        return $result;
    }

}



?>